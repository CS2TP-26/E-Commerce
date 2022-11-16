<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/QueryChecker.css">
    <link rel="icon" href="assets/Icon.png">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    
    <title>Stockade - QueryChecker</title>
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

                    <li class="nav-link active">
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



                    <li class="nav-link">
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
            <div class="text">QueryChecker</div>



            <?php
               if(!isset($_GET['edit'])){ // if edit is false it means that the user did not click on their "more info"

                ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Query</th>
                        <th>Reply</th>
                    </tr>
                </thead>

            <?php
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `Quries`";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                            <!-- a table that shows all of the quries -->

                                <tbody>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['datetime'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['query'];?></td>
                                        <td>
                                            <!-- when the button is pressed open a form that lets you reply to the message -->
                                            
                                            <!-- <button class="btn btn-primary" onclick="reply">Reply</button> -->

                                            <button class="btn btn-primary" type="button"><a href="QueryChecker.php?edit=<?php echo $row['email']; ?>">Reply </a></button>
                                            
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
                } elseif(isset($_GET['edit'])){ // if edit is true it means that the user clicked on their "more info"
                ?>

                    <!-- get the name of the user -->
                    <?php
                        $email = $_GET['edit'];

                        // start a session and add email to it
                        $_SESSION['Email_to'] = $email;
                        require_once '../connection.php';
                        $db = connect();
                        $sql = "SELECT * FROM `Quries` WHERE `email` = '$email'";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?>
                                <div class="Reply-box">

                                    <div class="reply_id">
                                        Reply to <?php echo $row['name'];?> - <?php echo $row['id'];?>

                                    </div>
                                <?php
                            }
                        }
                    ?>

                    <div class="query-container">
                        
                        <label for="" class="query-display">
                            <?php
                                require_once '../connection.php';
                                $db = connect();
                                $sql = "SELECT * FROM `Quries` WHERE `email` = '$email'";
                                $result = $db->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        ?>
                                            <?php echo $row['query'];?>
                                        <?php
                                    }
                                }
                            ?>
                        </label>

                    </div>
                    <form action="send_email.php" method="post">
                        <!-- add imput for a subject -->
                        <label class="form-label" for="subject">Subject</label>
                        <input class="inp-subject" type="text" class="form-control" id="subject" name="subject" placeholder="Subject"
                        value="Kongolian inquiry - ID: <?php 
                        require_once '../connection.php';
                        $db = connect();
                        $sql = "SELECT * FROM `Quries` WHERE `email` = '$email'";
                        $result = $db->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?><?php echo $row['id'];?><?php
                            }
                        }
                        ?>" 
                        ?>
                        <label class="form-label" for="subject">Reply</label>
                        <textarea name="reply" id="reply" cols="30" rows="10">
<?php
    require_once '../connection.php';
    $db = connect();
    $sql = "SELECT * FROM `Quries` WHERE `email` = '$email'";
    $result = $db->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            ?>Hello <?php echo $row['name'];?>! <br><br><?php
        }
    }
?>




<br><br>
Thanks again for reaching out to us!<br>
<?php echo $_SESSION['Admin_Username'] ?><br>
<?php echo $_SESSION['Admin_Email'] ?><br>
Kongolian<br>
                        </textarea>
                        <input class="inp-reply" type="submit" name="submit" value="Reply">
                    </form>
                        
                    </div>
                
                <?php
                    if(isset($_POST['submit'])){


                    }
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