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
                    <li class="nav-link">
                        <a href="ControlPanel.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">DashBoard</span>
                        </a>
                    </li>

                    <li class="nav-link active">
                        <a href="stockade.php">
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


                </ul>   
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../index.php">
                        <i class='bx bx-arrow-back icon'></i>
                        <span class="text nav-text">Maison De Versa</span>
                    </a>
                </li>
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
                    <i class='bx bx-data icon'></i>
                    <span class="text">Stockade</span>
                </div>


   
            


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









