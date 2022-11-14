<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="icon" href="assets/Icon.png">
    <link rel="stylesheet" href="css/index.css">

    <title>Admin - Login</title>
</head>
<body>

<!-- make a session -->
<?php
    session_start();
    if (isset($_SESSION['Admin_Username'])) {
        header("Location: ControlPanel.php");
    }


?>
<?php
    require_once '../connection.php';
    $db = connect();
    $error = "";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];



        


        $passCheck = password_verify($password, $db->query("SELECT password FROM staff WHERE username = '$username'")->fetch_assoc()['password']);
        if($passCheck){
            session_start();
            $role = $db->query("SELECT role FROM staff WHERE username = '$username'")->fetch_assoc()['role'];
            $email = $db->query("SELECT email FROM staff WHERE username = '$username'")->fetch_assoc()['email'];
            $id = $db->query("SELECT id FROM staff WHERE username = '$username'")->fetch_assoc()['id'];
            $description = $db->query("SELECT description FROM staff WHERE username = '$username'")->fetch_assoc()['description'];
            $_SESSION['Admin_Username'] = $username;
            $_SESSION['Admin_Role'] = $role;
            $_SESSION['Admin_Email'] = $email;
            $_SESSION['Admin_ID'] = $id;
            $_SESSION['Admin_Description'] = $description;


            header("Location: ControlPanel.php");
        }else{

            //* extra steps to check if the username is wrong or if the passwords is wrong.
            // if($db->query("SELECT username FROM staff WHERE username = '$username'")->fetch_assoc()['username'] == null){
            //     $error = "Username does not exist";
            // }else{
            //     $error = "Password is incorrect";
            // }
            $error = "Username or Password is incorrect";

        }


    }

?>



    <!-- login form -->
<div class="login-form">
        <div class="login">
            <div class="box1">
                <div class="login-header">
                    <h1>Admin Login</h1>
                </div>
                <div class="login-body">
                    <form action="index.php" method="post">
                        <div class="form-group"> <input type="text" name="username" id="username" class="control" placeholder="Username" required> </div>
                        <div class="form-group"> <input type="password" name="password" id="password" class="form-control" placeholder="Password" required> </div>
                        <div class="form-group"> <input type="submit" name="submit" id="submit" value="Login"> </div>
                        <br>
                        <br>
                        <div class="error"> 
                            <label for="Errors" class="errorMsg"> 
                                <?php echo $error; ?> 
                            </label>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>



    
</body>
</html>