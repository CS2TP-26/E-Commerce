<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="icon" href="assets/Icon.png">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/users.css">
    <title>Admin - Users</title>
</head>
<body>

<!-- start a session -->
<?php
    session_start();
    if (!isset($_SESSION['Admin_Username'])) {
        header("Location: index.php");
    }else{
        // if the role is 'Owner' 
        if ($_SESSION['Admin_Role'] == 'Owner' || $_SESSION['Admin_Role'] == 'staff') {

            ?>


<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="assets/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Kongolian</span>

                    <?php



                    // if the role is 'Owner'
                    if($_SESSION['Admin_Role'] == 'Owner'){
                    ?>
                        <style>
                            .profession{
                                color: red;
                            }
                            
                        </style>

                    <?php
                    }
                    ?>



                    <span class="profession"><?php echo $_SESSION['Admin_Username'];?></span>
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

                    <li class="nav-link">
                        <a href="QueryChecker.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Quries</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="Tickets.php">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Tickets</span>
                        </a>
                    </li>



                    <li class="nav-link active">
                        <a href="Users.php">
                            <i class='bx bx-user-circle icon'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="http://webmail.kongolian.tech/">
                            <i class='bx bx-mail-send icon'></i>
                            <span class="text nav-text">Mail</span>
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
                    
            <div class="text">Users</div>


            <?php
            
               if(empty($_GET)){ // if edit is false it means that the user did not click on their "more info"

                ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>email</th>
                        <th>Subscription</th>
                        <th>Portfolios</th>
                        <th>Edit</th>
                    </tr>
                </thead>

            <?php
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `Users`";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                            <!-- a table that shows all of the quries -->

                                <tbody>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['subscription'];?></td>
                                        <td><?php echo $row['port_no'];?></td>
                                        <td>
                                            <button class="btn btn-primary" type="button"><a href="Users.php?edit=<?php echo $row['email']; ?>">More Info </a></button>
                                        </td>
                                    </tr>
                                </tbody>

                        <?php
                    }
                }



            ?>


        </table>

        <!-- refresh button that refreshes the table -->
        <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>



        <?php
            } elseif(isset($_GET['edit'])){
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['edit']."'";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                            <!-- a table where the first row contains the items, the second the data, and the third the edit button -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Data-Type</th>
                                        <th>Data</th>
                                        <th>Edit</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>User_ID:</th>
                                        <td><?php echo $row['id'];?></td>
                                        <td><i class='bx bx-lock icon'></i></td>
                                    </tr>
                                    <tr>
                                        <th>Username:</th>
                                        <td><?php echo $row['username'];?></td>
                                        <td><i class='bx bx-lock icon'></i></td>

                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?php echo $row['email'];?></td>
                                        <td><i class='bx bx-lock icon'></i></td>

                                    </tr>
                                    <tr>
                                        <th>Subscription:</th>
                                        <td><?php echo $row['subscription'];?></td>
                                        <td><button class="btn btn-primary" type="button"><a href="Users.php?sub=<?php echo $row['email']; ?>">Edit   </a></button></td>
                                    </tr>
                                    <tr>
                                        <th>Portfolios:</th>
                                        <td><?php echo $row['port_no'];?></td>
                                        <td><i class='bx bx-lock icon'></i></td>
                                    </tr>
                                    <tr>
                                        <th>Account Creation:</th>
                                        <td><?php echo $row['acc_creation'];?></td>
                                        <td><i class='bx bx-lock icon'></i></td>
                                    </tr>
                                    <tr>
                                        <th>Account Type:</th>
                                        <td><?php echo $row['acc_type'];?></td>
                                        <td><button class="btn btn-primary" type="button"><a href="Users.php?type=<?php echo $row['email']; ?>">Edit   </a></button></td>
                                    </tr>

                                </tbody>




                            
                        <?php
                    }
                }


                
                


            } elseif (isset($_GET['sub'])){
                ?>


                <?php
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['sub']."'";
                $result = $db->query($sql);


                // when the submit button is pressed
                if(isset($_POST['submit'])){
                    $sub = $_POST['sub'];
                    $sql = "UPDATE `Users` SET `subscription` = '$sub' WHERE `email` = '".$_GET['sub']."'";
                    $result = $db->query($sql);
                    header("Location: Users.php");

                    // get subscription information from users 
                    $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['sub']."'";
                    $result = $db->query($sql);
                    // get subscription
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ?>

                            <?php
                        }
                    }

                }

                
                ?>

                <div class="form">
                    <label class="sub-label" for="sub">Subscription:</label>

                    <?php
                        require_once '../connection.php';
                        $db = connect();
                        $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['sub']."'";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?>
                                <form action="Users.php?sub=<?php echo $row['email']; ?>" method="post">

                                    <input type="text" name="sub" value="<?php echo $row['subscription'];?>">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                 </form>
                                <?php
                            }
                        }

                    ?>


                <h2 class="true">1 = True!</h2>
                <h2 class="false">0 = False</h2>
                <br>

                <label for="" class="importat">Doing this will give the user a free premiun subscription</label>









                <?php   
            } elseif (isset($_GET['type'])){
                    ?>

<?php
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['type']."'";
                $result = $db->query($sql);


                // when the submit button is pressed
                if(isset($_POST['staff'])){
                    $type = $_POST['type'];
                    $sql = "UPDATE `Users` SET `acc_type` = '$type' WHERE `email` = '".$_GET['type']."'";
                    $result = $db->query($sql);
                    header("Location: Users.php");

                    // get subscription information from users 
                    $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['type']."'";
                    $result = $db->query($sql);
                    // get subscription
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ?>

                            <?php
                        }
                    }

                }

                
                ?>

                <div class="form">
                    <label class="sub-label" for="sub">Role:</label>

                    <?php
                        require_once '../connection.php';
                        $db = connect();
                        $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['type']."'";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?>
                                <form action="Users.php?type=<?php echo $row['email']; ?>" method="post">

                                    <input type="text" name="type" value="<?php echo $row['acc_type'];?>">
                                    <button type="submit" name="staff" class="btn btn-primary">Submit</button>
                                 </form>
                                <?php
                            }
                        }

                    ?>


                <h2 class="true">Default = Normal User!</h2>
                <h2 class="false">Staff =  Staff Account Permissions!</h2>
                <br>

                <label for="" class="importat">Doing this will give users access to control panel.</label>

            <?php

            }

        
        
        ?>
        </div>


    </section>

    <script src="js/navbar.js"></script>






            










    


































<?php
        }
        
    }
?>




    
</body>
</html>