<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kongolian - Services</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="css/free.css">

    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
    <link rel="icon" href="../assets/images/Icon8.png">
    <!-- Buy me a coffee link -->
    <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="ZeeshanM" data-description="Support me on Buy me a coffee!" data-message="Thanks for visiting!" data-color="#40DCA5" data-position="Right" data-x_margin="18" data-y_margin="18"></script>

</head>



<body>
    <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            header('Location: ../pages/login.php');
            exit();
        }
    ?>



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

        <!-- only show this when logged in and you have a portfolio -->
        <?php
            if (isset($_SESSION['username'])) {
                $dir = "/home/zeeshan/Kongolian/www/html/Portfolios/" . $_SESSION['username'];
                if (is_dir($dir)) {
        ?>
        <label class="icon">
            <a href="../../ControlPanel/index.php" class="btn active logo">
                <span>
                    <i class="fas fa-hdd"></i>
                </span>
                <span class="test">Control Panel</span>
            </a>
        </label>
        <?php
                } 
            }
        ?>

        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pages/about.php">About</a></li>
            <li><a class="" href="../pages/services.php">Services</a></li>
            <li><a href="../pages/projects.php">Portfolios</a></li>
            <li><a href="../pages/contact.php">Contact</a></li>
            <?php if (!isset($_SESSION['username'])) { ?>
                <li><a href="../pages/login.php">Login</a></li>
            <?php } else { ?>
                <li><a class="active" href="../pages/logout.php">Logout</a></li>
                
            <?php } ?>
        </ul>
    </nav>

</body>










<!-- backend? -->
<?php
$taken = false;
// when the submit button is clicked
if (isset($_POST['submit'])) {
    // get the value of the search box
    $search = $_POST['search'];
    // if the search box is empty
    if (empty($search)) {
        $error = "Please enter a url";
    } else {
        // connect to the database
        require_once '../../connection.php';
        $conn = connect();

        // check if the connection is successful
        if (!$conn) {
            // if not show an error message
            echo "<script>alert('Connection failed')</script>";
            // redirect to the same page
            echo "<script>window.open('checker.php','_self')</script>";
        } else {

            // check if the $search is alphanumeric 
            if (!preg_match("/^[a-zA-Z0-9]+$/", $search)) {
                $error = "Please enter a valid url";
            } else{
                // search for the domain in the database
                $query = "SELECT * FROM domains WHERE domain LIKE '%$search%'";
                // get the result of the query
                $result = mysqli_query($conn, $query);
                // check if the result is empty
                if (mysqli_num_rows($result) == 0) {
                    // if the result is empty
                    // show an error message
                    $available = "The domain '". $search ."' is available!";
                    $error = "";
                    $taken = false;
                } else {
                    // if the result is not empty
                    // show the result
                    while ($row = mysqli_fetch_array($result)) {
                        // show the result
                        $taken = true;
                        $domain = $row['domain'];
                        $username = $row['user'];
                        $error = "The domain is not available!";
                        $available = "";

                    ?>

                        
                        <?php


                    }
                }
            }
            
        }
    }
}

?>
















<!-- front end -->


<h1 class="title">Free hosting plan</h1>

<!-- infomation on how it works -->
<p class="description"> Select the url you want, and we'll create an environment where you can statically  edit the files.</p>

<div class="standard">
    <!-- standard url -->
    <label for="" class="standardtxt">Username url ending!</label><br>
    <label for="" class="usernameurl">kongolian.tech/Portfolios/<?php echo $_SESSION['username']; ?></label>
    <br>
    <button class="btn2 confirm" type="submit" name="confirm">Confirm</button>

    <script>
        var btn = document.querySelector('.confirm');
        btn.addEventListener('click', function() {




            

            window.location.href = "http://kongolian.tech/2/plans/confirmation.php";
        });
    </script>

    


    




    



</div>


<div class="search-box">
    <label for="">Custom url ending!</label>
    <form action="free.php" method="post">
        <label for="">kongolian.tech/Portfolios/</label>
        <input class="searcn" type="text" name="search" placeholder="url...">
        <button class="btn2" type="submit" name="submit">Search</button>
    </form>
    <h2 class="error"><?php echo $error; ?> </h2>
    <h2 class="avalible"><?php echo $available; ?> </h2>
    <h5>Custom domains are only for the Pro Plan</h5>
</div>


<?php
if($taken == true ){



?>

<div class="results">
    <h1><?php echo $domain; ?> </h1>
    <p>Domain owned by: <?php echo $username; ?> </p>
</div>


<?php
}

?>







    

                









<!-- footer -->

<footer class="footer">
    <div class="social">
        <a href="https://github.com/Kongolian" target="_blank"><i class="fab fa-github"></i></a>
        <a href="https://discord.gg/cYCsDfyPAv" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="https://twitter.com/Kongolian_" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://zees.dev/" target="_blank"><i class="fab fa-periscope"></i></a>
        <a href="https://play.google.com/store/apps/developer?id=Drkongy" target="_blank"><i class="fab fa-google-play"></i></a>
    </div>
    <?php if (isset($_SESSION['username'])) { ?>
        <p class="copyright">
            Logged in as <?php echo $_SESSION['username']; ?>!
        </p>
    <?php } ?>

    
    <p class="copyright">
        &copy; Copyright 2022 Kongolian
    </p>

</footer>

</html>