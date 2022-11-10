<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kongolian - Projects</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/projects.css">
    <!-- <link rel="stylesheet" href="../css/index.css"> -->

    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
        <!-- Buy me a coffee link -->
        <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="ZeeshanM" data-description="Support me on Buy me a coffee!" data-message="Thanks for visiting!" data-color="#40DCA5" data-position="Right" data-x_margin="18" data-y_margin="18"></script>
    <link rel="icon" href="../assets/images/Icon8.png">

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
            <li><a class="active" href="projects.php">Portfolios</a></li>
            <li><a href="contact.php">Contact</a></li>
            <!-- adds login and logout button to page -->
            <?php if (!isset($_SESSION['username'])) { ?>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <li><a class="active" href="logout.php">Logout</a></li>
                
            <?php } ?>
        </ul>
    </nav>

</body>


<!-- welcome message -->
<div class="welcome">
    <h1>Portfolios</h1>
    <br>
    <p>Want your portfolio to be displayed here? Make a   <a href="../pages/contact.php"> ticket</a> or email <a href="mailto:Zeeshan@kongolian.tech"> Zeeshan@kongolian.tech</a></p>

</div>


<!-- Main -->



<!-- make flex boxes that contains differnt portfolios -->
<div class="flex-container">
    <div class="flex-item">
        <a href="../../Portfolios/Rehan/">
            <h1>Rehan</h1>

            <img src="../assets/images/Rehan.png" alt="Rehan">
            <div class="text">
                <p>Rehan is a web developer who is currently working on forums app.</p>
                <a href="https://github.com/for-i-in-rehan" target="_blank"><i class="fab fa-github"></i></a>
            </div>
        </a>
    </div>

    <div class="flex-item">
        <a href="../../Portfolios/Pinda/">
            <h1>Pinda</h1>

            <img src="../assets/images/Pinda.png" alt="Pinda">
            <div class="text">
                <p>Pinda is a web developer who is currently working a variety of projects.</p>
                <a href="https://github.com/DevPinda" target="_blank"><i class="fab fa-github"></i></a>
            </div>
        </a>
    </div>

    <div class="flex-item">
        <a href="../../1">
            <h1>Zeeshan</h1>

            <img src="../assets/images/Zeeshan.png" alt="Pinda">
            <div class="text">
                <p>Zeeshan is a computer science student working on kongolian.tech.</p>
                <a href="https://github.com/Drkongy" target="_blank"><i class="fab fa-github"></i></a>
                <a href="https://github.com/Kongolian" target="_blank"><i class="fab fa-github"></i></a>

            </div>
        </a>
    </div>
</div>


<div class="padder"></div>





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