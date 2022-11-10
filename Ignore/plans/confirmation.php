<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to css -->
    <link rel="stylesheet" href="css/conf.css">
    <!-- Website Icon -->
    <link rel="icon" href="../assets/images/Icon8.png">

    <title>Confirmation</title>
</head>
<body>


<!-- Make this look nicer then it's done and you can work on the control panel. -->

<?php
// get the current session data
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../pages/login.php');
    exit();
}else{

    // check if the user already has a directory in the Portfolios folder
    $dir = "/home/zeeshan/Kongolian/www/html/Portfolios/" . $_SESSION['username'];
    if (is_dir($dir)) {
        header('Location: ../../ControlPanel/index.php');
        exit();
        $error = "You already have a portfolio";
    } else {
        // if the user does not have a directory, create one
        $username = $_SESSION['username'];
        $curdir = getcwd();
        $old = umask(0000);
        $error = "";
        $success = "";
        $dirs = "";

        





        //* Adds the user to the database
        require_once '../../connection.php';
        $db = connect();
        // add the new domain to the database
        $sql = "INSERT INTO domains (domain, user) VALUES ('$username', '$username')";
        $sql2 = "SELECT * FROM Users";
        $result = $db->query($sql2);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["username"] == $username) {
                    $port_no = $row["port_no"];
                    $port_no++;
                    $sql2 = "UPDATE Users SET port_no = '$port_no' WHERE username = $username";
                    $db->query($sql2);
                }
            }
        }

        //* copiest he directory to the user's directory
        recurseCopy("/home/zeeshan/Kongolian/www/html/Template", "/home/zeeshan/Kongolian/www/html/Portfolios" . "/" . $_SESSION['username'] );
        $dirs = "Copying /home/zeeshan/Kongolian/www/html/Template ...  <br>";
        $success = "Directory copied successfully to " . "/home/zeeshan/Kongolian/www/html/Portfolios" . "/" . $_SESSION['username'] . "<br>";




        // echo "Directory Being copied";
        $result = mysqli_query($db, $sql);
        if ($result) {
            $success = $success .  "<br> Database updated successfully... Redirecting to Control Panel";
            // go to control panel in 3 seconds
            header("refresh:3;url=../../ControlPanel/index.php");
            exit();
        } else {
            $error = "Directory creation failed. You either already have a directory or you do not have permission to create one. <br> Please contact an administrator, or leave a query to <a href='../../pages/contact.php'>Here</a> <br>Retrying in 5 seconds";
            
            // refresh the page in 3 seconds to give the user time to read the error message
            header("refresh:5;url=confirmation.php");
            
        }
        umask($old);
        $error = "Directory creation failed. You either already have a directory or you do not have permission to create one. <br> Please contact an administrator, or leave a query to <a href='../../pages/contact.php'>Here</a>";
        umask($old);
            
    
    }
}


// Copying directories and files function
function recurseCopy(
    string $sourceDirectory,
    string $destinationDirectory
): void {
    $directory = opendir($sourceDirectory);
    $old = umask(0000);


    if (is_dir($destinationDirectory) === false) {
        mkdir($destinationDirectory, 0777, true);
        umask($old);

    }


    while (($file = readdir($directory)) !== false) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        if (is_dir("$sourceDirectory/$file") === true) {
            recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
            chmod("$destinationDirectory/$file", 0777);
            continue;

        }
        else {
            copy("$sourceDirectory/$file", "$destinationDirectory/$file");
            chmod("$destinationDirectory/$file", 0777);
            continue;
        }

        umask($old);

    }

    closedir($directory);

}
    
    






?>


<h1>Loading... Please wait while directory is being checked and Copied.</h1>
<div class="pad">
    <h3 class="dirs"><?php echo $dirs ?></h3>
    <h3 class="error"><?php echo $error ?></h3>
    <h3 class="success"><?php echo $success ?></h3>
</div>




<!-- loading logo -->
<div class="loading loading--full-height"></div>







    
</body>
</html>