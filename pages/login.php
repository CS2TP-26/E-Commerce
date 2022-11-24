<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/login.css">

    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
    <!-- <link rel="icon" href="../assets/images/Icon8.png"> -->

</head>



<body>
    <style>
        body {
            /* background-image: url('../assets/images/grayPolygon.png'); */
        }
    </style>

    <!-- background image -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
        <!--  add a logo to the navbar-->
         <!-- <img class="icon" src="../assets/images/Icon8.png" alt="logo" class="logo">  --> 
        <label class="logo">Maison De Versa</label>
        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</body>

<?php
    require_once '../connection.php';
    $db = connect();
    $error = "";

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];



        


        $passCheck = password_verify($password, $db->query("SELECT password FROM users WHERE email = '$email'")->fetch_assoc()['password']);
        if($passCheck){
            session_start();
            // get name
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


            if($acc_type == 'staff'){
                header("Location: ../stockade/ControlPanel.php");
            }else{
                header("Location: ../index.php");
            }
            
        }else{
            $error = "Invalid username or password";
        }


    }








?>


<!-- login form -->
<div class="login-form">
        <div class="login">
            <div class="box1">
                <div class="login-header">
                    <h1>Login</h1>
                </div>
                <div class="login-body">
                    <form action="login.php" method="post">
                        <div class="form-group"> <input type="text" name="email" id="email" class="control" placeholder="Email" required> </div>
                        <div class="form-group"> <input type="password" name="password" id="password" class="form-control" placeholder="Password" required> </div>
                        <div class="form-group"> <input type="submit" name="submit" id="submit" value="Login"> </div>
                        <br>
                        <div class="form-group"> <a href="registration.php">Signup Here!</a> </div>
                        <br>
                        <div class="error"> 
                            <label for="Errors" class="errorMsg" style="color: red"> 
                                <?php echo $error; ?> 
                            </label>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<!-- footer -->

<footer class="footer">
    <div class="social">
        <a href="https://github.com/CS2TP-26/E-Commerce" target="_blank"><i class="fab fa-github"></i></a>
        <!-- Remake the footer -->
    </div>

    <p class="copyright">
        &copy; Copyright 2022 Maison De Verce
    </p>

</footer>

</html>