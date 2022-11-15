<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="assets/Icon.png">
    <!-- bumua -->
    <link rel="stylesheet" href="./Bulma/bulma.min.css">
    <link href='./BoxIcons/css/boxicons.min.css' rel='stylesheet'>
    <link href='./css/main.css' rel='stylesheet'>

    <!-- JS -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.js"
        integrity="sha512-5m2r+g00HDHnhXQDbRLAfZBwPpPCaK+wPLV6lm8VQ+09ilGdHfXV7IVyKPkLOTfi4vTTUVJnz7ELs7cA87/GMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="./js/charts.js"></script>



    <title>Admin - ControlPanel</title>
</head>
<body>

<!-- start a session -->
<?php
    session_start();
    if ($_SESSION['acc_type'] != 'staff') {
        header("Location: index.php");
    }else{
        if ($_SESSION['acc_type'] == 'admin' || $_SESSION['acc_type'] == 'staff') {
?>


<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="assets/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Maison De Versa</span>

                    <?php



                    // if the role is 'Owner'
                    if($_SESSION['name'] == 'Zeeshan Mohammed'){
                    ?>
                        <style>
                            .profession{
                                color: red;
                            }
                            
                        </style>

                    <?php
                    }
                    ?>



                    <span class="profession"><?php echo $_SESSION['name'];?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link active">
                        <a href="ControlPanel.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">DashBoard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="QueryChecker.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Stockade</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="Tickets.php">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Tickets</span>
                        </a>
                    </li>



                    <li class="nav-link">
                        <a href="Users.php">
                            <i class='bx bx-user-circle icon'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="profile.php">
                            <i class='bx bx-user-check icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                </ul>   
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>


            </div>
        </div>

    </nav>

    <section class="home">

        <div class="padder">
        <div class="content">

            <div class="dashboard">


                <!-- Host Machine -->
                <div class="item-header">
                    <i class='bx bx-server icon'></i>
                    <span class="text">Host Machine</span>
                </div>
                <div class="items">


                    <div class="item box">
                        <div class="icon bx bx-chip"></div>
                        <div class="info">CPU</div>
                        <div class="value" id="cpu"></div>
                        <?php
                        $cpu = shell_exec('top -bn1 | grep "Cpu(s)" | awk \'{print $2 + $4}\'');
                        $cpu = intval($cpu);

                        ?>
                        <progress class="progress" value="<?php echo $cpu; ?>" max="100"></progress>
                    </div>

                    <div class="item box">
                        <div class="icon bx bx-microchip"></div>
                        <div class="info">RAM</div>
                        <div class="value" id='ram'></div>
                        <?php
                            $ram = shell_exec('free -m | grep Mem | awk \'{print $3}\'');
                            $ram = ($ram / 1000) * 100;
                            $ram = intval($ram);
                        ?>
                        <progress class="progress" id="pb1" value="<?php echo $ram; ?>" max="100"></progress>
                    </div>

                    <div class="item box">
                        <div class="icon bx bx-data"></div>
                        <div class="info">HDD</div>
                        <div class="value">
                        <?php
                        $hdd = shell_exec('df -h | grep /dev/sda2 | awk \'{print $5}\'');
                        $hdd = intval($hdd);
                        echo $hdd . "%";


                        ?>
                        </div>
                        <div class="sm-value">
                        <?php

                            $used= shell_exec('df -h | grep /dev/sda2 | awk \'{print $3}\'');
                            $used = intval($used);
                            $total =  64; // shell_exec('df -h | grep /dev/sda2 | awk \'{print $2}\'');
                            // $free = $total - $used;
                            echo $used . "GB / " .  $total .  " GB";


                        ?>
                        </div>
                        <progress class="progress" value="<?php echo $hdd; ?>" max="100"></progress>
                    </div>


                    <script>
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("cpu").innerHTML = this.responseText;
                                let pb1 = document.getElementById("pb1").innerHTML;


                                pb1.setAttribute = this.responseText;
                                
                            }
                        };
                        setInterval(function() {
                            xhttp.open("GET", "getPHP/getCPU.php", true);
                            xhttp.send();
                        }, 1000);

                    </script>

                    <script>
                        var xhtt = new XMLHttpRequest();
                        xhtt.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("ram").innerHTML = this.responseText;
                            }
                        };
                        setInterval(function() {
                            xhtt.open("GET", "getPHP/getRAM.php", true);
                            xhtt.send();
                        }, 1000);

                    </script>

                </div>

                <!-- User Information -->
                <div class="item-header">
                    <i class='bx bx-user icon'></i>
                    <span class="text">User Information</span>
                </div>

                <div class="items">

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-user"></div>
                        <div class="info">Users</div>
                        <div class="lr-value" style="padding-top: 50px;">
                        <?php
                            // connect to database
                            require_once '../connection.php';
                            $db = connect();
                            // get the amount  of users
                            $sql = "SELECT * FROM users";
                            $result = $db->query($sql);
                            $count = $result->num_rows;
                            echo $count;
                        ?>
                    
                    
                    
                    
                        </div>
                    </div>

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-user-plus"></div>
                        <div class="info">Daily</div>
                        <!-- <div class="value" style="color: rgb(0,0,0,0)">100%</div> -->
                        <div class="lr-value" style="padding-top: 50px;">+ 0 Today</div>
                    </div>


                        <!-- this  -->
                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-user-plus"></div>
                        <div class="info">Weekly</div>
                        <br>
                        <canvas id="users-weekly" width="100%" height="40vh"></canvas>
                        <!--<progress class="progress" value="76.23" max="100"></progress>-->
                    </div>




                </div>

                <!-- Revenue Section -->
                <div class="item-header">
                    <i class='bx bx-pound icon'></i>
                    <span class="text">Revenue</span>
                </div>

                <div class="items">

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-dollar-circle"></div>
                        <div class="info" style="font-size: 22px; font-style: italic;">Revenue</div>
                        <div class="value" style="color: rgb(0,0,0,0)">100%</div>
                        <div class="sm-value"><b>Today</b></div>
                        <div class="lr-value" style="padding-top: 30px;">£3.69</div>
                    </div>

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-dollar-circle"></div>
                        <div class="info" style="font-size: 22px; font-style: italic;">Revenue</div>
                        <div class="value" style="color: rgb(0,0,0,0)">100%</div>
                        <div class="sm-value"><b>This Month</b></div>
                        <canvas id="revenue-this-month" width="280" height="190"></canvas>
                    </div>

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-dollar-circle"></div>
                        <div class="info" style="font-size: 22px; font-style: italic;">Revenue</div>
                        <div class="value" style="color: rgb(0,0,0,0)">100%</div>
                        <div class="sm-value"><b>All Time</b></div>
                        <canvas id="revenue-all-time" width="280" height="190"></canvas>
                    </div>

                </div>

                <!-- User Information -->
                <div class="item-header">
                    <i class='icon bx bx-bar-chart-alt-2 icon'></i>
                    <span class="text">Statistics</span>
                </div>

                <div class="items">

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bx-bar-chart-alt"></div>
                        <div class="info">No of Quries</div>
                        <div class="lr-value" style="padding-top: 50px;">
                        <?php
                            // connect to database
                            require_once '../connection.php';
                            $db = connect();
                            $sql = "SELECT * FROM Quries";
                            $result = $db->query($sql);
                            $count = $result->num_rows;
                            echo $count;
                        ?>
                    
                        </div>
                    </div>

                    <div class="item box" style="height: 100%;">
                        <div class="icon bx bx-support"></div>
                        <div class="info">No of Tickets</div>
                        <div class="lr-value" style="padding-top: 50px;">
                        <?php
                            // connect to database
                            require_once '../connection.php';
                            $db = connect();
                            $sql = "SELECT * FROM Tickets";
                            $result = $db->query($sql);
                            $count = $result->num_rows;
                            echo $count;
                        ?>
                    
                        </div>
                    </div>

                    <!-- <div class="item box" style="height: 100%;">
                        <div class="icon bx bxs-user-plus"></div>
                        <div class="info">Subscriptions</div>
                        <div class="lr-value" style="padding-top: 50px;">
                        <?php
                            // connect to database
                            // require_once '../connection.php';
                            // $db = connect();
                            // // search all the Users and check of they have a subscription
                            // $sql = "SELECT * FROM Users";
                            // $result = $db->query($sql);
                            // $count = $result->num_rows;
                            // $subCount = 0;
                            // while($row = $result->fetch_assoc()){
                            //     if($row['subscription'] == 1){
                            //         $subCount++;
                            //     }
                            // }
                            // echo $subCount;

                            
                        ?>
                    
                        </div>
                    </div> -->









            </div>



        </div>


        </div>
    </section>

    <script src="js/navbar.js"></script>

<?php
        }
        
    }
?> 
</body>
</html>









