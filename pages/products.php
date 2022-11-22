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
                style="width: 100%; height: 100px; object-fit: cover;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['name']; ?></h5>
                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>
                    <p class="card-text">
                        <?php echo $row['price']; ?>
                    </p>
                    <button class="btn btn-primary" type="button"><a href="products.php?view=<?php echo $row['id']; ?>">View </a></button>

                    <button class="btn btn-primary" type="button"><a href="products.php?add=<?php echo $row['id']; ?>">Add to Basket </a></button>

                </div>
            </div>
        </div>
        <?php
            }
        } elseif(isset($_GET['view'])){ // if edit is true it means that the user clicked on their "view" button
            echo "test for viewing items";
        } elseif(isset($_GET['add'])){ // if edit is true it means that the user clicked on their "add to basekt" button
            echo "test for basket add";
        }

        ?>



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