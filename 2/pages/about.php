<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Kongolian - About</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/aboutme.css">
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
            background-color: #202020;
            height: 100vh;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            font-weight: bold;
            transition: 2s ease;
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
            <li><a class="active" href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="projects.php">Portfolios</a></li>
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


<!-- about me -->
<!-- flexbox that automatically resizes with page -->
<div class="flex-container">
    <div class="flex-item">
        <h1>Hi, I'm Zeeshan!</h1>

        <p>

            I'm a computer science student at the Aston University, tho i'm primarily self-taught. 
            <br>
            I am currently working on a web project, that will allow people to host their own mini portfolios on my website.
            <br>
            There is a huge range of technologies and programming languages that I’ve learned over the years. 
            <br>
            I am currently learning to code in HTML, CSS, JavaScript, PHP, SQL and Python.
            <br>
            I am also trying to progress my knowledge in C# and Java.
            <br>
            I've been developing software for the past 2 years. I have worked on a wide variety of projects, projects such as Games, Websites, Windows Applications, and even a Discord Bot Application.    
            <br>
            <!-- make a href to zees.dev -->
            <a href="https://www.zees.dev">Zees.dev</a>
        </p>
    </div>


    <div class="flex-item">
        <h1>About Kongolian</h1>

        <h2>What is Kongolian?</h2> 
        <h3>Kongolian is a website that allows you to host your own mini portfolios on Kongolian.tech Domain. </h3>
        <br>
        <h2>What is a portfolio?</h2>
        <h3>A small website thats shows work your projects, as well as your skills and experiences. <a href="http://kongolian.tech/1/index.html" target="_blank">Example</a></h3>
        <br>
        <h2>How does it work?</h2>
        <h3>You send me your portfolio and I'll host it for you. (Control Panel Work In Progress) </h3>
        <br>
        <h2>How do I get started?</h2>
        <h3>You can sign up for a free account, and then you can upload your portfolio.</h3>
        <br>
        <h2>How do I upload my portfolio?</h2>
        <h3>You can upload your portfolio by clicking the upload button in the control panel.<h3>
        <br>
        <h2>How do I get my portfolio?</h2>
        <h3>Once you've uploaded your portfolio, A custon link will be made for you!</h3>
        <br>
    </div>


    <div class="flex-item">
        <h1>Host Details</h1>
        <p>
        OS: Ubuntu 20.04 focal
        <br>
        Kernel: x86_64 Linux 5.13.0-41-generic
        <br>
        Shell: bash 5.0.17
        <br>
        Disk: 2TB 
        <br>
        CPU: Intel Pentium N3710 @ 4x 2.56GHz
        <br>
        GPU: Intel Corporation Atom/Celeron/Pentium Processor x5-E8000/J3xxx/N3xxx Integrated Graphics Controller (rev 35)
        <br>
        RAM: 8GB (1x8GB)
        </p>

        <p id:"UptimeL">

        <?php
            // get uptime of the apache server
            $str   = @file_get_contents('/proc/uptime');
            $num   = floatval($str);
            $secs  = fmod($num, 60); $num = intdiv($num, 60);
            $mins  = $num % 60;      $num = intdiv($num, 60);
            $hours = $num % 24;      $num = intdiv($num, 24);
            $days  = $num;

            // convert secs to whole number
            $secs = round($secs);

            // echo the results
            echo 'UPTIME: ' . $days . ' days,      ' . $hours . ' hours,      ' . $mins . ' minutes,      ' . $secs .  ' seconds';
        ?>
        </p>
    </div>

    <div class="flex-image">
       <div class="item">
            <i class="devicon-java-plain-wordmark"></i>
       </div>
       <div class="item">
            <i class="devicon-csharp-plain"></i>
       </div>
       <div class="item">
            <i class="devicon-python-plain"></i>
       </div>
       <div class="item">
            <i class="devicon-nodejs-plain-wordmark"></i>
       </div>
       <div class="item">
            <i class="devicon-javascript-plain"></i>
       </div>
       <div class="item">
            <i class="devicon-html5-plain-wordmark"></i>
       </div>
       <div class="item">
            <i class="devicon-css3-plain-wordmark"></i>
        </div>
        <div class="item">
            <i class="devicon-php-plain"></i>
        </div>
        <div class="item">
            <i class="devicon-mysql-plain"></i>
        </div>
        <div class="item">
            <i class="devicon-unity-original"></i>
        </div>
        <div class="item">
            <i class="devicon-linux-plain"></i>
        </div> 
        <div class="item">
            <i class="devicon-git-plain"></i>
        </div>  
        <div class="item">
            <i class="devicon-dotnetcore-plain"></i>
        </div>  
        <div class="item">
            <i class="devicon-arduino-plain-wordmark"></i>
        </div>  
        <div class="item">
            <i class="devicon-ssh-original-wordmark"></i>
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