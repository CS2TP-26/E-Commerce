<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">



    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>



<body>


    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
        <label class="logo">Maison De Versa</label>
        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</body>

        <h1 class="text-center">My Orders</h1>

        <h1>

        


        <?php
            session_start();
            $user_id = $_SESSION['id'];
            echo "User ID: ". $user_id . "<br>";
            require_once '../connection.php';
            $db = connect();
            $sql = "SELECT * FROM `orders` WHERE `user_ID` = '".$user_id."'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_ID'];
                    require_once '../connection.php';
                    $db = connect();
                    $sql2 = "SELECT * FROM 'products'"; // WHERE 'product_ID' = '".$product_id."'";
                    $result2 = $db->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $product_name = $row2['name'];
                            $product_image = $row2['image'];
                            $product_description = $row2['description'];
                            $product_price = $row2['cost'];
                            $status = $row2['status'];



                        }
                        echo "ID: " . $product_id . "<br>";
                        echo "Product Name: " . $product_name . "<br>";
                        echo "Product Image: " . $product_image . "<br>";
                        echo "Product Description: " . $product_description . "<br>";
                        echo "Product Price: " . $product_price . "<br>";
                        echo "Order Status: " . $status . "<br>";
                    }





                }
            }
  

        ?>
        </h1>













<!-- footer -->

<footer class="footer">
    <div class="social">
        <a href="https://github.com/CS2TP-26/E-Commerce" target="_blank"><i class="fab fa-github"></i></a>
        <!-- Remake the footer -->
    </div>

    <p class="copyright">
        &copy; Copyright 2022 Maison De Verce
    </p>

</footer>

</html>