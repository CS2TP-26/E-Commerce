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

    <title>Stockade - Login</title>
</head>
<body>

<!-- make a session -->
<?php
    session_start();
    if(isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == 'staff'){
        header('location: ControlPanel.php');
    }


?>
<?php
    require_once '../connection.php';
    $db = connect();
    $error = "";

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];



        

        $passCheck = password_verify($password, $db->query("SELECT password FROM users WHERE email = '$email'")->fetch_assoc()['password']);
        $role = $db->query("SELECT role FROM users WHERE email = '$email'")->fetch_assoc()['role'];
        // if passCheck is true and role is staff
        if ($passCheck && $role == "staff") {
            session_start();
            $name = $db->query("SELECT name FROM users WHERE email = '$email'")->fetch_assoc()['name'];
            $acc_type = $db->query("SELECT role FROM users WHERE email = '$email'")->fetch_assoc()['role'];
            $email = $db->query("SELECT email FROM users WHERE email = '$email'")->fetch_assoc()['email'];
            $id = $db->query("SELECT id FROM users WHERE email = '$email'")->fetch_assoc()['id'];
            $creation = $db->query("SELECT creation FROM users WHERE email = '$email'")->fetch_assoc()['creation'];


            $_SESSION['name'] = $name;
            $_SESSION['acc_type'] = $acc_type;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;
            $_SESSION['creation'] = $creation;


            header("Location: ControlPanel.php");
        }else if ($passCheck && $role != "staff") {
            $error = "You are not authorized to access this page";
        }
        else{
            $error = "Invalid email or password";
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
                        <div class="form-group"> <input type="text" name="email" id="email" class="control" placeholder="Email" required> </div>
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