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
    <link rel="stylesheet" href="css/stockade.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="assets/Icon.png">
    <!-- bumua -->

    <link href='./css/main.css' rel='stylesheet'>





    <title>Stockade - Orders</title>
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

                    <li class="nav-link ">
                        <a href="stockade.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Stockade</span>
                        </a>
                    </li>
                    <li class="nav-link active">
                        <a href="orders.php">
                            <i class='bx bx-basket icon'></i>
                            <span class="text nav-text">Orders</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="Tickets.php">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Tickets</span>
                        </a>
                    </li>



                    <li class="nav-link ">
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
                    <i class='bx bx-basket icon'></i>
                    <span class="text">Orders</span>
                </div>
                <?php

                if(empty($_GET)){ 

?>

<table class="table">
<thead>
    <tr>
        <th>ID</th>
        <th>USER ID</th>
        <th>PRODUCT ID</th>
        <th>Cost (£)</th>
        <!-- <th>Current Stock</th> -->
        <th>Status</th>
        <th>Edit</th>

    </tr>
</thead>

<?php
require_once '../connection.php';
$db = connect();
$sql = "SELECT * FROM `orders`";
$result = $db->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
            <!-- a table that shows all of the quries -->

                <tbody>
                    <tr>
                        <td><?php echo $row['ID'];?></td>
                        <td><?php echo $row['user_ID'];?></td>
                        <td><?php echo $row['product_ID'];?></td>
                        <td><?php 
                        $sql3 = "SELECT * FROM `products` WHERE `id` = '".$row['product_ID'];?>."'";
                        $result3 = $db->query($sql3);
                        if($result3->num_rows > 0){
                            while($row3 = $result3->fetch_assoc()){
                                echo $row3['price'];
                            }
                        }
                        
                        ?></td>
                        <td><?php echo $row['status'];?></td>

                        <td>
                            <button class="btn btn-primary" type="button"><a href="orders.php?edit=<?php echo $row['ID']; ?>">More Info </a></button>
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
$sql = "SELECT * FROM `orders` WHERE `ID` = '".$_GET['edit']."'";
$result = $db->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
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
                        <th>Order ID:</th>
                        <td><?php echo $row['ID'];?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>
                    <tr>
                        <th>User ID:</th>
                        <td><?php
                        $user_id = $row['user_ID'];
                        echo $row['user_ID'];
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>
                    <tr>
                        <th>Users Name:</th>
                        <td><?php 
                            $sql2 = "SELECT * FROM `users` WHERE `id` = '".$user_id."'";
                            $result2 = $db->query($sql2);
                            if($result2->num_rows > 0){
                                while($row2 = $result2->fetch_assoc()){
                                    echo $row2['name'];
                                }
                            }
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>

                    <tr>
                        <th>Users Email:</th>
                        <td><?php 
                        $sql2 = "SELECT * FROM `users` WHERE `id` = '".$user_id."'";
                        $result2 = $db->query($sql2);
                        if($result2->num_rows > 0){
                            while($row2 = $result2->fetch_assoc()){
                                echo $row2['email'];
                            }
                        }
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>

                    <tr>
                        <th>Product ID:</th>
                        <td><?php 
                        $product_id = $row['product_ID'];
                        echo $row['product_ID'];
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>

                    
                    <tr>
                        <th>Product Name:</th>
                        <td><?php 
                        $sql3 = "SELECT * FROM `products` WHERE `id` = '".$product_id."'";
                        $result3 = $db->query($sql3);
                        if($result3->num_rows > 0){
                            while($row3 = $result3->fetch_assoc()){
                                echo $row3['name'];
                            }
                        }
                        
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>

                    <tr>
                        <th>Cost (£):</th>
                        <td><?php 
                        $sql3 = "SELECT * FROM `products` WHERE `id` = '".$product_id."'";
                        $result3 = $db->query($sql3);
                        if($result3->num_rows > 0){
                            while($row3 = $result3->fetch_assoc()){
                                echo $row3['price'];
                            }
                        }
                        
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>
                    </tr>

                    <tr>
                        <th>Stock Count:</th>
                        <td><?php 
                        $sql3 = "SELECT * FROM `products` WHERE `id` = '".$_GET['edit']."'";
                        $result3 = $db->query($sql3);
                        if($result3->num_rows > 0){
                            while($row3 = $result3->fetch_assoc()){
                                echo $row3['stock'];
                            }
                        }
                        
                        ?></td>
                        <td><i class='bx bx-lock icon'></i></td>

                    </tr>

                    <tr>
                        <th>Status:</th>
                        <td><?php echo $row['status'];?></td>
                        <td><button class="btn btn-primary" type="button"><a href="orders.php?status=<?php echo $row['ID']; ?>">Edit   </a></button></td>

                    </tr>

        
                </tbody>
            </table>


            <button class="btn btn-primary" type="button"><a href="stockade.php">Back</a></button>
        
            
        <?php
    } 
  




}
} 



?>
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









