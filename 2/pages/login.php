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
    <link rel="icon" href="../assets/images/Icon8.png">
        <!-- Buy me a coffee link -->
        <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="ZeeshanM" data-description="Support me on Buy me a coffee!" data-message="Thanks for visiting!" data-color="#40DCA5" data-position="Right" data-x_margin="18" data-y_margin="18"></script>

</head>



<body>
    <style>
        body {
            background-image: url('../assets/images/grayPolygon.png');
        }
    </style>

    <!-- background image -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
        <!--  add a logo to the navbar-->
        <img class="icon" src="../assets/images/Icon8.png" alt="logo" class="logo">
        <label class="logo">Kongolian</label>
        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="projects.php">Portfolios</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</body>

<?php
    require_once '../../connection.php';
    $db = connect();
    $error = "";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];



        


        $passCheck = password_verify($password, $db->query("SELECT password FROM Users WHERE username = '$username'")->fetch_assoc()['password']);
        if($passCheck){
            session_start();
            $acc_type = $db->query("SELECT acc_type FROM Users WHERE username = '$username'")->fetch_assoc()['acc_type'];
            $email = $db->query("SELECT email FROM Users WHERE username = '$username'")->fetch_assoc()['email'];
            $id = $db->query("SELECT id FROM Users WHERE username = '$username'")->fetch_assoc()['id'];
            $subscription = $db->query("SELECT subscription FROM Users WHERE username = '$username'")->fetch_assoc()['subscription'];
            $_SESSION['username'] = $username;
            $_SESSION['acc_type'] = $acc_type;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;
            $_SESSION['subscription'] = $subscription;
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
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
                        <div class="form-group"> <input type="text" name="username" id="username" class="control" placeholder="Username" required> </div>
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
        <a href="https://github.com/Kongolian" target="_blank"><i class="fab fa-github"></i></a>
        <a href="https://discord.gg/cYCsDfyPAv" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="https://twitter.com/Kongolian_" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://zees.dev/" target="_blank"><i class="fab fa-periscope"></i></a>
        <a href="https://play.google.com/store/apps/developer?id=Drkongy" target="_blank"><i class="fab fa-google-play"></i></a>
    </div>

    <p class="copyright">
        &copy; Copyright 2022 Kongolian
    </p>

</footer>

</html>