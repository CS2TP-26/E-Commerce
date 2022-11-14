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
    <link rel="stylesheet" href="css/TIckets.css"> 
    <title>Admin - Tickets</title>
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

                    <li class="nav-link active">
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
        <div class="content">

            <!-- <div class="text">Tickets</div> -->
            <div class="item">
            

            <?php
                if(!isset($_GET['View']) && !isset($_GET['Close']) && !isset($_GET['Open'])){ // if edit is false it means that the user did not click on their "more info"
            ?>

            <div class="item-header">
                <i class='bx bx-paperclip icon'></i>
                <span class="text">Pending Tickets</span>
                <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>
                </thead>
                <?php
                    require_once '../connection.php';
                    $db = connect();
                    $sql = "SELECT * FROM `Tickets`";
                    $result = $db->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){ 
                            if($row['Closed'] == 0){?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['subject'];?></td>
                        <td><?php echo $row['infomation'];?></td>
                        <td>
                            <button class="btn btn-primary " type="button"><a href="Tickets.php?View=<?php echo $row['id']; ?>">View</a></button>
                        </td>
                    </tr>
                </tbody>
                <?php } } }?>
                </table>
            </div>
            </div>

            <div class="item">
            <div class="item-header">
                <i class='bx bx-box icon'></i>
                <span class="text">Archived Tickets</span>

                <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>
                </thead>
                <?php
                    require_once '../connection.php';
                    $db = connect();
                    // $sql = "SELECT * FROM `Tickets`";
                    // show the tickets that the user has made only
                    $sql = "SELECT * FROM `Tickets`";
                    $result = $db->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){ 
                            if($row['Closed'] == 1){?>
                        
                <tbody>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['subject'];?></td>
                        <td><?php echo $row['infomation'];?></td>
                        <td>
                            <button class="btn btn-primary " type="button"><a href="Tickets.php?View=<?php echo $row['id']; ?>">View</a></button>
                        </td>
                    </tr>
                </tbody>
                <?php } } }?>
                </table>
            </div>
            </div>
            <?php } else if(isset($_GET['View'])){
                require_once '../connection.php';
                $db = connect();
                $id = $_GET['View'];
                $sql = "SELECT * FROM `Tickets` WHERE id = '$id'";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                ?>
                <div class="items">

                <div class="item">
                    <div class="item-header">
                        <i class='bx bx-paperclip icon'></i>
                        <span class="text">Ticket <?php echo $row['id'] ?></span>
                    </div>
                    <div class="item-content">

                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['name']; ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['email']; ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Date Opened</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['OpenedDate']; ?>" disabled>
                            </div>
                        </div>

                        <?php if($row['Closed'] == 1){ ?>

                        <div class="field">
                            <label class="label">Date Closed</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['ClosedDate']; ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Closed By</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['ClosedBy']; ?>" disabled>
                            </div>
                        </div>

                        <?php } ?>

                        <div class="field">
                            <label class="label">Status</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php if($row['Closed'] == 0){echo "Pending";} else {echo "Closed";} ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Subject</label>
                            <div class="control">
                                <input class="input" type="text" name="subject" value="<?php echo $row['subject']; ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <textarea class="textarea" name="description" disabled><?php echo $row['infomation']; ?></textarea>
                            </div>
                        </div>

                        <?php if($row['Reply'] != null){ ?>
                        <div class="field">
                            <label class="label">Reply</label>
                            <div class="control">
                                <textarea class="textarea" name="description" disabled><?php echo $row['Reply']; ?></textarea>
                            </div>
                        </div>
                        <?php } ?>



                        
                    </div>
                    <br>

                </div>
                </div>
<!-- if the ticket is archived dont show this -->
                <?php if($row['Closed'] == 0){ ?>
                <div class="items">
                <div class="item">
                    <div class="item-header">
                        <i class='bx bx-reply icon'></i>
                        <span class="text">Reply to Ticked No:  <?php echo $row['id'] ?></span>
                    </div>
                    <div class="item-content">

                        <?php 
                            require_once '../connection.php';
                            $db = connect();
                            $mess = "";
                            $errmess = "";
                            if(isset($_POST['submit'])){
                                $reply = $_POST['reply'];
                                $sql = "UPDATE `Tickets` SET `Reply` = '$reply' WHERE `Tickets`.`id` = '$id'";
                                $result = $db->query($sql);
                                if($result){
                                    $mess = "Reply Sent Successfully 🦍";
                                    header("Refresh:2; url=Tickets.php");
                                    

                                } else {
                                    $errmess = "Error Sending Reply";
                                } 

                                header("Refresh:2; url=Tickets.php");

                            }

                        ?>

                        <div class="field">
                            <label class="label">Reply</label>
                            <div class="control">
                                <form action="Tickets.php?View=<?php echo $row['id']; ?>" method="POST">
                                    <textarea class="textarea" name="reply" placeholder="Reply to the ticket" required></textarea>
                                    <br>
                                    <button class="btn btnreply" name="submit" type="submit" >Submit</button>
                                    <br>
                                
                                </form>

                                <div class="mess"><?php echo $mess ?></div>
                                <div class="errmess"><?php echo $errmess ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>


                    <!-- button to close the ticket -->
                    <div class="items">
                    <div class="item">
                        <div class="item-header">
                            <i class='bx bx-archive-in icon'></i>
                            <span class="text">Close Ticket</span>
                        </div>
                        <div class="item-content">
                            <div class="field">
                                <div class="control">
                                    <form action="Tickets.php?Close=<?php echo $row['id']; ?>" method="POST">
                                    <!-- submit input -->
                                    <button class="btn btnclose" name="close" type="submit" >Close Ticket</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    </div>


                    <?php } else{?>
                    <!-- button to open the ticket -->
                    <div class="items">
                    <div class="item">
                        <div class="item-header">
                            <i class='bx bx-archive-in icon'></i>
                            <span class="text">Open Ticket</span>
                        </div>
                        <div class="item-content">
                            <div class="field">
                                <div class="control">
                                    <form action="Tickets.php?Open=<?php echo $row['id']; ?>" method="POST">
                                        <button class="btn btnreply" name="open" type="submit" value = >Re-Open Ticket</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    </div>

                    
                    




                        


                <?php }}}} else if(isset($_GET['Close'])){
                        $id = $_GET['Close'];
                        // echo $id;

                        require_once '../connection.php';
                        $db = connect();
                        $username = $_SESSION['Admin_Username'];
                        // close the ticket and change the username of the user who closed the ticket
                        $sql = "UPDATE `Tickets` SET `Closed` = '1', `ClosedBy` = '$username' WHERE `Tickets`.`id` = '$id'";
                        // $sql = "UPDATE `Tickets` SET `Closed` = '1' WHERE `Tickets`.`id` = '$id'";
                        $result = $db->query($sql);
                        if($result){
                            header("Refresh:2; url=Tickets.php");
                            echo "Ticket Closed";
                        } else {
                            echo "Error";
                        }

                        ?>
                        <div class="items">
                        <div class="item">
                            <div class="item-header">
                                <i class='bx bx-archive-in icon'></i>
                                <span class="text">Ticket Closed - <?php echo $id; ?> </span>
                            </div>
                            <div class="item-content">
                                <div class="field">
                                    <div class="control">
                                        <!-- redirect button -->
                                        <a href="Tickets.php"><button class="btn btnreply" name="close" type="submit" >Back to Tickets</button></a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php

                    } elseif (isset($_GET['Open'])) {
                        $id = $_GET['Open'];
                        require_once '../connection.php';
                        $db = connect();
                        $sql = "UPDATE `Tickets` SET `Closed` = '0' WHERE `Tickets`.`id` = '$id'";
                        $result = $db->query($sql);
                        if($result){
                            header("Refresh:2; url=Tickets.php?View=$id");
                        } else {
                            echo "Error";
                        }

                        ?>
                        <div class="items">
                        <div class="item">
                            <div class="item-header">
                                <i class='bx bx-archive-in icon'></i>
                                <span class="text">Ticket Re-Opened - <?php echo $id; ?></span>
                            </div>
                            <div class="item-content">
                                <div class="field">
                                    <div class="control">
                                        <a href="Tickets.php?View=<?php echo $row['id']; ?>"><button class="btn btnreply" name="close" type="submit" >Redirecting...</button></a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php
                    }
                ?>

            
                


        </div>
        </div>

    </section>
    <script src="js/uploadIcon.js"></script>

    <script src="js/navbar.js"></script>


    






            










    


































<?php
        }
        
    }
?>




    
</body>
</html>