<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kongolian</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="assets/images/Icon8.png">
    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Buy me a coffee link -->
        <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="ZeeshanM" data-description="Support me on Buy me a coffee!" data-message="Thanks for visiting!" data-color="#40DCA5" data-position="Right" data-x_margin="18" data-y_margin="18"></script>

</head>



<body>

    <?php
        session_start();
    ?>

    <?php
        // require_once '../phpscripts/visitor_counter.php';
        // incrementVisitors();
        // $visitors = getVisitors();
    ?>

    <style>
        body {
            background-image: url('assets/images/grayPolygon.png');
        }
    </style>

    <!-- background image -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <!--  add a logo to the navbar-->
        <img class="icon" src="assets/images/Icon8.png" alt="logo" class="logo">
        <label class="logo">Kongolian</label>

        <!-- only show this when logged in and you have a portfolio -->
        <?php
            if (isset($_SESSION['username'])) {
                $dir = "/home/zeeshan/Kongolian/www/html/Portfolios/" . $_SESSION['username'];
                if (is_dir($dir)) {
        ?>
        <label class="icon">
            <a href="../ControlPanel/index.php" class="btn active logo">
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
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="pages/about.php">About</a></li>
            <li><a href="pages/services.php">Services</a></li>
            <li><a href="pages/projects.php">Portfolios</a></li>
            <li><a href="pages/contact.php">Contact</a></li>
            <!-- adds login and logout button to page -->
            <?php if (!isset($_SESSION['username'])) { ?>
                <li><a href="pages/login.php">Login</a></li>
            <?php } else { ?>
                <li><a class="active" href="pages/logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </nav>

</body>


<!-- welcome message -->
<div class="welcome">
            <?php if (!isset($_SESSION['username'])) { ?>
                <h1>Welcome to Kongolian</h1>

            <?php } else { ?>
                <h1>Welcome to Kongolian, <?php echo $_SESSION['username']; ?>!</h1>
                
            <?php } ?>




    <br>
</div>


<div class="info">
    <p>Webpage & Webapp Hosting</p>

    <button class="btn">
        <a href="pages/services.php">
            <i class="fas fa-arrow-right"></i>
            <span> Get Started</span>
        </a>
    </button>
</div>




<div class="motto" z-index="0">
    <h2>We are a collection of developers who make websites and web applications.</h2>

</div>





<!-- <?php if (isset($_SESSION['username'])) { ?>
        <p class="copyright">
            Logged in as, <?php echo $_SESSION['username']; ?>
        </p>
<?php } ?> -->


<footer class="footer">
    <div class="social">
        <a href="https://github.com/Kongolian" target="_blank"><i class="fab fa-github"></i></a>
        <a href="https://discord.gg/cYCsDfyPAv" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="https://twitter.com/Kongolian_" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://zees.dev/" target="_blank"><i class="fab fa-periscope"></i></a>
        <a href="https://play.google.com/store/apps/developer?id=Drkongy" target="_blank"><i class="fab fa-google-play"></i></a>
    </div>

    <!-- indication that a user is logged in -->
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