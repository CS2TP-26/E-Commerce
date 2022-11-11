<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/register.css">


    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
    <link rel="icon" href="../assets/images/Icon8.png">
        <!-- Buy me a coffee link -->

</head>
<body >

    <!-- background image -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
        <!--  add a logo to the navbar-->
        <!-- <img class="icon" src="../assets/images/Icon8.png" alt="logo" class="logo"> -->
        <label class="logo">Maison De Verce</label>

        <!-- only show this when logged in and you have a portfolio -->
        


        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</body>


<!-- welcome message -->


<?php
require_once '../connection.php';


$db = connect();

$error = "";
$loginNow = "";


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $emailUsed = false;
    $usernameUsed = false;
    $hashed_password = "";
    $username_format = false;

    // get the current date in yyyy-mm-dd format
    $date = date('Y-m-d');
    $acc_type = "customer";


    if ($password != $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // check if email is already used
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            $emailUsed = true;
        }


        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $username_format = true;
        }

        // if email and username are not used, hash the password and insert the user into the database
        if (!$emailUsed && !$usernameUsed && !$username_format) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // get the ip of the user to make sure people dont spam accounts
            
            $sql = "INSERT INTO users (name, email, password, creation, role) VALUES ('$name', '$email', '$hashed_password', '$date', '$acc_type')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                $sql = "SELECT * FROM Users WHERE email = '$email'";
                


                $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $result = mysqli_query($db, $sql);
                }


                $error = "User created successfully! ";
                $loginNow = "Press here to login";

            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        } else {
            if ($emailUsed) {
                $error = "Email already in use";
            } else if ($usernameUsed) {
                $error = "Username already in use";
            }
            else if ($username_format) {
                $error = "Username must be alphanumeric";
            }
        }
    }




}
?>


<div class="register-form">
    <div class="register">
        <div class="box1">
            <div class="register-header">
                <h1>Register</h1>
            </div>
            <div class="register-body">
                <form action="registration.php" method="post">
                    <div class="form-group"> <input type="text" name="name" id="name" class="control" placeholder="Name" required> </div>
                    <div class="form-group"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" required> </div>
                    <div class="form-group"> <input type="password" name="password" id="password" class="form-control" placeholder="Password" required> </div>
                    <div class="form-group"> <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required> </div>
                    <div class="form-group"> <input type="submit" name="submit" id="submit" value="Register"> </div>
                    <div class="form-group"> <a href="login.php">Already have an account?</a> </div>
                    <div class="error"> 
                        <label for="Errors" class="errorMsg" style="color: red;">
                            <?php echo $error; ?> 
                        </label>
                        <br> 
                        <a href="login.php"> 
                            <label for="Errors" class="errorMsg" style="cursor: pointer"> 
                                <?php echo $loginNow; ?> 
                            </label> 
                        </a> 
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