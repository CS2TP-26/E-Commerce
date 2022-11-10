<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kongolian - Contact</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/contactMe.css">
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
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="projects.php">Portfolios</a></li>
            <li><a class="active" href="contact.php">Contact</a></li>
            <!-- adds login and logout button to page -->
            <?php if (!isset($_SESSION['username'])) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <li><a class="active" href="logout.php">Logout</a></li>
                
            <?php } ?>
        </ul>
    </nav>

</body>




<!-- Main -->

<body style="z-index: -1;">
<div class="padder">
<div class="Infomation">
    <div class="Box1">
        <div class="ImageText">
            <span class="headerText"><strong>Contact Infomation!</strong></span>
            <em> 
                <!-- opens up a mailing service -->
                <br> Zeeshan <br> <a href="mailto:Zeeshan@Kongolian.tech">Zeeshan@Kongolian.tech</a><br> 
                <a href="https://discord.gg/cYCsDfyPAv">My Discord!</a>
                <br>
                <a href="Privacy.html">Privacy Policy!</a>

            </em>
        </div>
    </div>
</div>



<?php
    require_once '../../connection.php';
    $db = connect();

    // get the data from the form and update the database

    $error = "🦍";
    $success = "";




    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $query = $_POST['query'];
        // get the current data and Time
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $dateTime = $time . ' - ' . $date;

        // check if the email is already in the database
        $t = "SELECT * FROM Quries WHERE email = '$email'";
        $result = mysqli_query($db, $t);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $error = "You've already sent a query!";
        } else {
            // insert the data into the database
            $sql = "INSERT INTO Quries (email, query, name, datetime) VALUES ('$email', '$query', '$name', '$dateTime')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                $error = "";
                $success = "Your query has been sent successfully! 🦍";
            } else {
                $error = "Query not sent";
            }
        }


        
        

        
    }




?>



<div class="contactMe">
    <div class="Box2">
        <div class="">
            <form action="contact.php" method="post" class="contact-me">
                <span class="headerText"><strong>Contact Us!</strong></span>
                <input type="text" class="input-field" placeholder="Name" id="firstName" name="name" required>
                <input type="email" class="input-field" placeholder="Email" id="email" name="email" required>
                <br><br>
                <h4>Please Enter Enquiry:</h4>
                <textarea class="input-field query" placeholder="Query" id="query" name="query" required></textarea>
                <input type="submit" class="submit" name="submit" id="submit" value="Submit">
                <br>
                <br>

                <label for="Errors" class="error" style="color: red;">
                    <?php echo $error; ?>
                </label>


                <label for="Errors" class="error" style="color: lightgreen;">
                    <?php echo $success; ?>
                </label>

            </form>


        </div>
    </div>
</div>






<div class="hideme" >
    <div class="Box3">
        <div class="End">
            <!-- this is for when you press the submit button and all of the validations have gone through -->
            <div class="ImageText">
                <span class="headerText"><strong>Confirmation!</strong></span>
                <h4 id="1">Name: </h4>
                <h4 id="2">Email: </h4>
                <p id="3">query: </p>
                <h3 id="4"></h3>

            </div>
        </div>
    </div>


</div>
</div>
</body>





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