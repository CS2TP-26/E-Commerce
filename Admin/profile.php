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
    <link rel="stylesheet" href="css/profile.css">



    
    <title>Admin - Profile</title>
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


                    <li class="nav-link active">
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
            <div class="text">Profile</div>

            <?php

        require_once '../connection.php';
        $db = connect();

        // when the save button is clicked

        if(isset($_POST['submit'])){
            $id = $_SESSION['Admin_ID'];
            $description = $_POST['description'];
            
            $sql = "UPDATE staff SET description = '$description' WHERE id = '$id'";


            $result = $db->query($sql);
            if($result){
                $_SESSION['Admin_Description'] = $description;
            }else{
                echo "Error: " . $sql . "<br>" . $db->error;
            }



        }
        ?>

            <div class="profile-container">
                <div class="profile-header">

                    <div class="profile-image">
                        <img src="assets/Icon.png" alt="assets/Icon.png">
                    </div>
                        

                    <div class="profile-name">
                        <h1> Welcome, <?php echo $_SESSION['Admin_Username'];?>!</h1>

                    </div>
                </div>

                <!-- make a form to upload profile image
                <form action="upload.php" method="post" enctype="multipart/form-data" class="uploader">
                    <input type="file" name="file" id="profile-image" accept="image/*" placeholder="Upload" class="upload">
                    <input type="submit" name="submit" value="Upload" class="submit">
                </form> -->


                <!-- make a form that allows the staff to change there details -->
                
            <div class="formback">
                <form action="profile.php" method="POST">
                    <div class="profile-details">
                        <div class="profile-detail">
                            <label for="">Username</label>
                            <input type="text" name="username" value="<?php echo $_SESSION['Admin_Username'];?>" readonly>
                            <!-- email -->
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?php echo $_SESSION['Admin_Email'];?>" readonly>
                            <!-- role -->
                            <label for="">Role</label>
                            <input type="text" name="role" value="<?php echo $_SESSION['Admin_Role'];?>" readonly>
                            <!-- password -->
                            <label for="">Password</label>
                            <input type="text" name="password" value="Message An Admin" readonly>
                            <!-- description -->
                            <label for="">Description</label>
                            <!-- textbox -->
                            <?php
                                // get the descriotion
                                require_once '../connection.php';
                                $db = connect();
                                $sql = "SELECT * FROM staff WHERE username = '".$_SESSION['Admin_Username']."'";
                                $result = $db->query($sql);
                                $row = $result->fetch_assoc();
                                $description = $row['description'];

                            ?>
                            <textarea name="description" id="" cols="30" rows="10"><?php echo $description ?></textarea>
                            <label for="" class="deletelater">Only Description & avatar can be changed for now!</label>


                            <!--  inpit submit button -->
                            <input type="submit" name="submit" value="Save" class="submit">


                        </div>
                    </div>
                </form>
            </div>
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