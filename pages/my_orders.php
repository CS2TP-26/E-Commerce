<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!---Fontawesome CDN Link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!----Custom CSS Filw Link--->
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/login.css">
    <!-- <link rel="stylesheet" href="../css/products.css"> -->



    <!-- mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website Icon -->
    <!-- <link rel="icon" href="../assets/images/Icon8.png"> -->

</head>



<body>
    <style>
        body {
            /* background-image: url('../assets/images/grayPolygon.png'); */
        }
    </style>

    <!-- background image -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
        <!--  add a logo to the navbar-->
         <!-- <img class="icon" src="../assets/images/Icon8.png" alt="logo" class="logo">  --> 
        <label class="logo">Maison De Versa</label>
        <ul class="ul">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</body>

<!-- show the current orders placed for the specific user -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">My Orders</h1>
        </div>
    </div>
    <div class="row">
        <?php
            // start the session
            session_start();
            // get the user id
            $user_id = $_SESSION['id'];

            
            require_once '../connection.php';
            $db = connect();
            $sql = "SELECT * FROM orders WHERE user_id = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $_SESSION['id']);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($orders as $order) {
                $sql = "SELECT * FROM orders WHERE order_id = :order_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':order_id', $order['id']);
                $stmt->execute();
                $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $total = 0;
                foreach ($order_items as $order_item) {
                    $sql = "SELECT * FROM products WHERE id = :product_id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':product_id', $order_item['product_id']);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total += $product['price'] * $order_item['quantity'];
                }
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Order ID: " . $order['id'] . "</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>Total: $" . $total . "</h6>";
                echo "<p class='card-text'>Date: " . $order['date'] . "</p>";
                echo "<a href='order_details.php?id=" . $order['id'] . "' class='card-link'>View Details</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    </div>













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