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
    <link rel="stylesheet" href="css/NavBar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="assets/Icon.png">
    <!-- bumua -->

    <link href='./css/main.css' rel='stylesheet'>






    <title>Stockade - ControlPanel</title>
</head>
<body>

<!-- start a session -->
<?php
    session_start();
    if ($_SESSION['acc_type'] != 'staff') {
        header("Location: ../index.php");
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

                    <li class="nav-link ">
                        <a href="stockade.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Stockade</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="orders.php">
                            <i class='bx bx-basket icon'></i>
                            <span class="text nav-text">Orders</span>
                        </a>
                    </li>

                    <!-- <li class="nav-link">
                        <a href="Tickets.php">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Tickets</span>
                        </a>
                    </li> -->



                    <li class="nav-link active">
                        <a href="Users.php">
                            <i class='bx bx-user-circle icon'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>


                </ul>   
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../site/index.php">
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
        <div class="item-header">
            <i class='bx bx-user icon'></i>
            <span class="text">Users</span>
        </div>
    <!-- <div class="text">Users</div> -->


    <?php
    
       if(empty($_GET)){ // if edit is false it means that the user did not click on their "more info"

        ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Creation</th>
                <th>Edit</th>
            </tr>
        </thead>

    <?php
        require_once '../connection.php';
        $db = connect();
        $sql = "SELECT * FROM `users`";
        $result = $db->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                    <!-- a table that shows all of the quries -->

                        <tbody>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['role'];?></td>
                                <td><?php echo $row['creation'];?></td>
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
        $sql = "SELECT * FROM `users` WHERE `email` = '".$_GET['edit']."'";
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
                                <th>name:</th>
                                <td><?php echo $row['name'];?></td>
                                <td><i class='bx bx-lock icon'></i></td>

                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $row['email'];?></td>
                                <td><i class='bx bx-lock icon'></i></td>

                            </tr>
                          
                            
                            <tr>
                                <th>Account Creation:</th>
                                <td><?php echo $row['creation'];?></td>
                                <td><i class='bx bx-lock icon'></i></td>
                            </tr>
                            <tr>
                                <th>Account Type:</th>
                                <td><?php echo $row['role'];?></td>
                                <td><button class="btn btn-primary" type="button"><a href="Users.php?type=<?php echo $row['email']; ?>">Edit   </a></button></td>
                            </tr>

                        </tbody>




                    
                <?php
            }
        }
    } elseif (isset($_GET['type'])){
        require_once '../connection.php';
        $db = connect();
        $sql = "SELECT * FROM `Users` WHERE `email` = '".$_GET['type']."'";
        $result = $db->query($sql);


        // when the submit button is pressed
        

        
        ?>

        <div class="form">
            <label class="sub-label" for="sub">Role:</label>

            <?php
                require_once '../connection.php';
                $db = connect();
                $sql = "SELECT * FROM `users` WHERE `email` = '".$_GET['type']."'";
                $result = $db->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                        <form action="Users.php?type=<?php echo $row['email']; ?>" method="post">

                            <input type="text" name="type" value="<?php echo $row['role'];?>">
                            <button type="submit" name="staff" class="btn btn-primary">Submit</button>
                         </form>
                        <?php
                    }
                }



                if(isset($_POST['staff'])){
                    $type = $_POST['type'];
                    $sql = "UPDATE `users` SET `role` = '$type' WHERE `email` = '".$_GET['type']."'";
                    $result = $db->query($sql);
                    if($result){
                        ?>
                        <div class="alert true" role="alert">
                            User Updated!
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="alert false" role="alert">
                            Error! User Not Updated!
                            <?php echo $db->error; ?>
                        </div>
                        <?php
                    }
        
                }

            ?>

            <!-- refresh button -->
            <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>
            <h2 class="true">customer = Normal User!</h2>
            <h2 class="false">staff =  Staff Account Permissions!</h2>
            <label for="" class="false">Doing this will give users access to control panel.</label>    
            <br>
        </div>


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









