<!doctype html>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='css/login.css' />
	<link rel='stylesheet' type='text/css' href='css/nav.css' />

	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
	<title>Mason De Versa - Shop</title>
</head>

<body>
	<div class="topnav">
		<a href="index.php">
			<img src="img/text only no bg-01.png" width="397" height="227" alt="" />
		</a>
		<form>
			<button type="submit" formaction="login.php">Login</button>
		</form>
		<a href="basket.php">Basket</a>
		<a href="contact.php">Contact Us</a>
		<a href="about.php">About Us</a>
		<a href="shop.php">Shop</a>
	</div>


<?php
require_once '../connection.php';


$db = connect();

$loginError = "";
$loginNow = "";


if (isset($_POST['Register'])) {
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
        $registerError = "Passwords do not match";
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
        if (!$emailUsed && !$usernameUsed && !$username_format) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password, creation, role) VALUES ('$name', '$email', '$hashed_password', '$date', '$acc_type')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                $sql = "SELECT * FROM Users WHERE email = '$email'";
                $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $result = mysqli_query($db, $sql);
                }
                $registerError = "User created successfully! ";
                $loginNow = "Login Here ⌚";
            } else {
                $registerError = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        } else {
            if ($emailUsed) {
                $registerError = "Email already in use";
            } else if ($usernameUsed) {
                $registerError = "Username already in use";
            }
            else if ($username_format) {
                $registerError = "Username must be alphanumeric";
            }
        }
    }
}
?>

<?php
    require_once '../connection.php';
    $db = connect();
    $error = "";

    if(isset($_POST['Login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passCheck = password_verify($password, $db->query("SELECT password FROM users WHERE email = '$email'")->fetch_assoc()['password']);
        if($passCheck){
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

            if($acc_type == 'staff'){
                header("Location: ../stockade/ControlPanel.php");
            }else{
                header("Location: index.php");
            }
        }else{
            $loginError = "Invalid username or password";
        }
    }
?>


    <div class="panel">
        <div class="login">
            <h1>Login</h1>
            <form action="login.php" method="post">
                <input type="text" name="email" placeholder="email" required="required" />
                <input type="password" name="password" placeholder="Password" required="required" />
                <label for="Errors" class="errorMsg" style="color: red;">
                    <?php echo $loginError; ?> 
                </label>
                <label for="Errors" class="successMsg" style="color: red;">
                    <?php echo $loginNow; ?> 
                </label>
                <button type="submit" name="Login" class="btn btn-primary btn-block btn-large">Login</button>
            </form>
            
        </div>

        <div class="register">
            <h1>Register</h1>
            <form action="login.php" method="post">
                <input type="text" name="name" placeholder="Name" required="required" />
                <input type="text" name="email" placeholder="Email" required="required" />
                <input type="password" name="password" placeholder="Password" required="required" />
                <input type="password" name="confirm-password" placeholder="Confirm Password" required="required" />
                <br>
                <label for="Errors" class="errorMsg" style="color: red;">
                    <?php echo $registerError; ?> 
                </label>
                <button type="submit" name="Register" class="btn btn-primary btn-block btn-large">Register</button>
            </form>
            
        </div>
    </div>

    
	

</html>