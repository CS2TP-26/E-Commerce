<!doctype html>
<html>

<head>
    <link rel='stylesheet' type='text/css' href='css/nav.css' />
    <link rel='stylesheet' type='text/css' href='css/my_orders.css' />
    <link rel='stylesheet' type='text/css' href='css/scroll.css' />



    <link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="utf-8">
    <link rel="icon" href="../Assets/icon.png">

    <title>Mason De Versa - My Orders</title>
</head>

<body>
    <div class="topnav">
        <a href="index.php">
            <img src="img/text only no bg-01.png" width="397" height="227" alt="" />
        </a>


        <?php
        session_start();
        if (!isset($_SESSION['id'])) { ?>
            <form>
                <button type="submit" formaction="login.php">Login</button>
            </form>
        <?php
        } else { ?>
            <form>
                <button type="submit" formaction="logout.php">Logout</button>
            </form>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['id'])) { ?>
            <form>
                <button type="submit" formaction="my_orders.php">My Orders</button>
            </form>
        <?php
        }
        ?>



        <a href="basket.php">Basket</a>
        <a href="contact.php">Contact Us</a>
        <a href="about.php">About Us</a>
        <a href="shop.php">Shop</a>
    </div>

    <div class="middle">
        <!-- <br> -->

        <table class="table">
            <h1 class="h1_orders">My Orders</h1>

            <thead>
                <tr>
                    <th>MPN</th>
                    <th>COST (£)</th>
                    <th>STATUS</th>
                    <th>Cancelate Order</th>

                </tr>
            </thead>

            <?php
            session_start();
            $id = $_SESSION['id'];
            require_once '../connection.php';
            $db = connect();
            $sql = "SELECT * FROM `orders` WHERE `user_ID` = '" . $_SESSION['id'] . "'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_ID'];
                    $order_id = $row['ID'];
                    // only show pending products
                    if ($row['status'] == "Pending") {

            ?>
                        <tbody>
                            <tr>
                                <td><?php
                                    $sql3 = "SELECT * FROM `products` WHERE `id` = '" . $product_id . "'";
                                    $result3 = $db->query($sql3);
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {

                                            echo $row3['MDN'];
                                        }
                                    }

                                    ?></td>

                                <td><?php
                                    $sql3 = "SELECT * FROM `products` WHERE `id` = '" . $product_id . "'";
                                    $result3 = $db->query($sql3);
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {

                                            echo $row3['price'];
                                        }
                                    }

                                    ?></td>
                                <td><?php echo $row['status']; ?></td>

                                <td>
                                    <form action="my_orders.php" method="post">
                                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                                        <button class="btn btn-primary" name="cancel" type="submit">Cancel Order</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
            <?php
                    }
                }
            }
            ?>
        </table>

        <!-- If the cancel order button is clicked  -->
        <?php
        if (isset($_POST['cancel'])) {
            $order_id = $_POST['order_id'];
            $sql = "UPDATE `orders` SET `status` = 'Cancelled' WHERE `id` = '" . $order_id . "'";
            // $sql = "UPDATE `orders` SET `status` = 'Cancelled' WHERE `ID` = '".$_GET['status']."'";

            $result = $db->query($sql);
            if ($result) {
                echo "<script>alert('Order Cancelled');</script>";
                echo "<script>window.location.href='my_orders.php';</script>";
            } else {
                echo "<script>alert('Error');</script>";
            }
        }



        ?>





        <br>

        <table class="table">
            <h1 class="p_orders">Previous Orders</h1>

            <thead>
                <tr>
                    <th>MPN</th>
                    <th>COST (£)</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <?php
            session_start();
            $id = $_SESSION['id'];
            require_once '../connection.php';
            $db = connect();
            $sql = "SELECT * FROM `orders` WHERE `user_ID` = '" . $_SESSION['id'] . "'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_ID'];
                    // only show pending products
                    // IF ITS = COMPLETE OR Complete or complete
                    if ($row['status'] == "Complete" || $row['status'] == "complete" || $row['status'] == "COMPLETE") {
            ?>
                        <tbody>
                            <tr>
                                <td><?php
                                    $sql3 = "SELECT * FROM `products` WHERE `id` = '" . $product_id . "'";
                                    $result3 = $db->query($sql3);
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {

                                            echo $row3['MDN'];
                                        }
                                    }

                                    ?></td>

                                <td><?php
                                    $sql3 = "SELECT * FROM `products` WHERE `id` = '" . $product_id . "'";
                                    $result3 = $db->query($sql3);
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {

                                            echo $row3['price'];
                                        }
                                    }

                                    ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        </tbody>
            <?php
                    }
                }
            }
            ?>
        </table>

    </div>








    <div class="bottomNav">
        <img src="img/logo no bg-01.png" width="200" height="200" alt="" />
        <hr>
        </hr>
        <div class="copyright">
            <p>© Mason De Versa LTD, 2022</p>
        </div>
        <a class="shopLink" href="shop.php">Shop</a>
        <a class="aboutLink" href="about.php">About</a>
        <a class="contactLink" href="contact.php">Contact</a>





        <?php
        if (!isset($_SESSION['id'])) { ?>
            <form>
                <button type="submit" formaction="login.php">Login</button>
            </form>
        <?php
        } else { ?>
            <form>
                <button type="submit" formaction="logout.php">Logout</button>
            </form>
        <?php
        }
        ?>




        <div class="social">
            <p>Follow Us:</p>
            <div class="facebook">
                <a href="https://www.facebook.com/" target="_blank">
                    <i class='bx bxl-facebook  bx-sm'></i>
                </a>
            </div>
            <div class="twitter">
                <a href="https://www.twitter.com/" target="_blank">
                    <i class='bx bxl-twitter bx-sm'></i>
                </a>
            </div>
            <div class="tiktok">
                <a href="https://www.tiktok.com/" target="_blank">
                    <i class='bx bxl-tiktok bx-sm'></i>
                </a>
            </div>
            <div class="instagram">
                <a href="https://www.instagram.com/" target="_blank">
                    <i class='bx bxl-instagram bx-sm'></i>
                </a>
            </div>
        </div>
    </div>




</html>