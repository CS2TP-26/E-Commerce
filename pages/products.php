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

<?php
    
    if(empty($_GET)){ // if edit is false it means that the user did not click on their "more info"

     ?>
<!-- list of products  from database-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Products</h1>
        </div>
    </div>
    <div class="row">
        <?php
            require_once '../connection.php';
            $db = connect();
            $sql = "SELECT * FROM products";
            $result = $db->query($sql);
            while($row = $result->fetch_assoc()){
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $row['image']; ?>" class="card-img-top"
                style="width: 100%; height: 100px; object-fit: scale-down;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['name']; ?></h5>
                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>
                    <p class="card-text">
                        <?php echo "£" . $row['price']; ?>
                    </p>
                    <button class="btn btn-primary" type="button"><a href="products.php?view=<?php echo $row['id']; ?>">View </a></button>

                    <button class="btn btn-primary" type="button"><a href="products.php?add=<?php echo $row['id']; ?>">Add to Basket </a></button>

                </div>
            </div>
        </div>
        <?php
            }
        } elseif(isset($_GET['view'])){ // if edit is true it means that the user clicked on their "view" button
            // show the product and its details in
            require_once '../connection.php';
            $db = connect(); 
            $id = $_GET['view'];
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
        ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $row['image']; ?>" class="card-img-top"
                style="width: auto; height: 250px; object-fit: scale-down;" alt="...">
                <div class="card-body">
                    <h5 class="card-title
                    ">
                        <?php echo $row['name']; ?></h5>
                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>
                    <p class="card-text">
                        <?php echo "£" . $row['price']; ?>
                    </p>
                    <button class="btn btn-primary" type="button"><a href="products.php?add=<?php echo $row['id']; ?>">Add to Basket </a></button>
                    <!-- back button -->
                    <button class="btn btn-primary" type="button"><a href="products.php">Back </a></button>
                </div>
            </div>
        </div>
        <?php
        
        } elseif(isset($_GET['add'])){ // if edit is true it means that the user clicked on their "add to basekt" button
            require_once ('../connection.php');
            $db = connect();
            $sql =  "SELECT * FROM `products` WHERE `id`='$id'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name = $row["name"];
                    $price = $row["price"];
                    $image = $row["image"];
                }
            }else{
                echo "No results";
            }

            session_start();

            $basketArray = array(
                $id=>array(
                'id'=>$id,
                'name'=>$name,
                'price'=>$price,
                'quantity'=>1,
                'image'=>$image)
            );

            if(empty($_SESSION["basket"])) {
                $_SESSION["basket"] = $basketArray;
                $status = "<div class='box'>Watch added to your basket!</div>";
                }else{
                $array_keys = array_keys($_SESSION["basket"]);
                if(in_array($id,$array_keys)) {
                $status = "<div class='box' style='color:red;'>
                This watch is already added to your basket!</div>";	
                    } else {
                    $_SESSION["basket"] = array_merge(
                    $_SESSION["basket"],
                    $basketArray
                    );
                    $status = "<div class='box'>Watch has been added to your basket!</div>";

                    }

                }
            echo "Item added to basket";
        }

        ?>



    </div>
</div>


<!-- view basket btn -->
<!-- make it at the bottom of the page -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" type="button"><a href="basket.php">View Basket </a></button>
        </div>
    </div>
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