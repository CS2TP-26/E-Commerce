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





    <title>Stockade - ControlPanel</title>
</head>

<body>

    <!-- start a session -->
    <?php
    session_start();
    if ($_SESSION['acc_type'] != 'staff') {
        header("Location: ../index.php");
    } else {
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
                            if ($_SESSION['name'] == 'Zeeshan Mohammed') {
                            ?>
                                <style>
                                    .profession {
                                        color: red;
                                    }
                                </style>

                            <?php
                            }
                            ?>



                            <span class="profession"><?php echo $_SESSION['name']; ?></span>
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



                            <li class="nav-link">
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
                                <i class='bx bx-data icon'></i>
                                <span class="text">Stockade</span>
                            </div>
                            <?php

                            if (empty($_GET)) { // if edit is false it means that the user did not click on their "more info"

                            ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>description</th>
                                            <th>Cost (£)</th>
                                            <th>Stock</th>
                                            <th>Sales</th>
                                            <th>Edit</th>

                                        </tr>
                                    </thead>

                                    <?php
                                    require_once '../connection.php';
                                    $db = connect();
                                    $sql = "SELECT * FROM `products`";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <!-- a table that shows all of the quries -->

                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                    <td><?php echo $row['stock']; ?></td>
                                                    <td><?php echo $row['sales']; ?></td>

                                                    <td>
                                                        <button class="btn btn-primary" type="button"><a href="stockade.php?edit=<?php echo $row['id']; ?>">More Info </a></button>
                                                    </td>
                                                </tr>
                                            </tbody>

                                    <?php
                                        }
                                    }



                                    ?>


                                </table>

                                <button class="btn btn-primary" type="button"><a href="stockade.php?add=true">Add Product</a></button>
                                <br>
                                <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>



                                <?php
                            } elseif (isset($_GET['edit'])) {
                                require_once '../connection.php';
                                $db = connect();
                                $sql = "SELECT * FROM `products` WHERE `ID` = '" . $_GET['edit'] . "'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
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
                                                    <th>Product_ID:</th>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><i class='bx bx-lock icon'></i></td>
                                                </tr>
                                                <tr>
                                                    <th>name:</th>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><i class='bx bx-lock icon'></i></td>
                                                </tr>
                                                <tr>
                                                    <th>description:</th>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><i class='bx bx-lock icon'></i></td>
                                                </tr>
                                                <tr>
                                                    <th>image_Url:</th>
                                                    <td><?php echo $row['image']; ?></td>
                                                    <td><i class='bx bx-lock icon'></i></td>
                                                </tr>

                                                <tr>
                                                    <th>Cost (£):</th>
                                                    <td><?php echo $row['price']; ?></td>
                                                    <td><button class="btn btn-primary" type="button"><a href="stockade.php?cost=<?php echo $row['id']; ?>">Edit </a></button></td>

                                                </tr>
                                                <tr>
                                                    <th>Stock Count:</th>
                                                    <td><?php echo $row['stock']; ?></td>
                                                    <td><button class="btn btn-primary" type="button"><a href="stockade.php?stock=<?php echo $row['id']; ?>">Edit </a></button></td>


                                                </tr>
                                                <tr>
                                                    <th>Items Sold / Sales</th>
                                                    <td><?php echo $row['sales']; ?></td>
                                                    <td><i class='bx bx-lock icon'></i></td>

                                                </tr>

                                            </tbody>
                                        </table>


                                        <button class="btn btn-primary" type="button"><a href="stockade.php">Back</a></button>


                                    <?php
                                    }
                                }
                            } elseif (isset($_GET['cost'])) {
                                require_once '../connection.php';
                                $db = connect();
                                $sql = "SELECT * FROM `products` WHERE `id` = '" . $_GET['cost'] . "'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <div class="form">
                                            <form action="stockade.php?cost=<?php echo $row['id']; ?>" method="POST">
                                                <div class="form-group">
                                                    <label class="sub-label" for="cost">Cost (£): </label>
                                                    <input class="sub-input" type="text" class="form-control" name="cost" id="cost" value="<?php echo $row['price']; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                                            </form>
                                            <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>
                                            <label class="alert">Refresh the page so you can see cost update</label>
                                            <br>
                                            <button class="btn btn-primary" type="button"><a href="stockade.php">Back</a></button>
                                        </div>

                                    <?php
                                    }
                                }
                                if (isset($_POST['update'])) {
                                    $cost = $_POST['cost'];
                                    $sql = "UPDATE `products` SET `price` = '$cost' WHERE `id` = '" . $_GET['cost'] . "'";
                                    $result = $db->query($sql);
                                    if ($result) {
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            Product Updated!
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            Error! Cost Not Updated!
                                        </div>
                                    <?php
                                    }
                                }
                            } elseif (isset($_GET['stock'])) {
                                require_once '../connection.php';
                                $db = connect();
                                $sql = "SELECT * FROM `products` WHERE `id` = '" . $_GET['stock'] . "'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <div class="form">
                                            <form action="stockade.php?stock=<?php echo $row['id']; ?>" method="POST">
                                                <div class="form-group">
                                                    <label class="sub-label" for="stock">stock: </label>
                                                    <input class="sub-input" type="text" class="form-control" name="stock" id="stock" value="<?php echo $row['stock']; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="update2">Update</button>
                                            </form>
                                            <button class="btn btn-primary" onclick="window.location.reload()">Refresh</button>
                                            <label class="alert">Refresh the page so you can see cost update</label>
                                            <br>
                                            <button class="btn btn-primary" type="button"><a href="stockade.php">Back</a></button>
                                        </div>

                                    <?php
                                    }
                                }
                                if (isset($_POST['update2'])) {
                                    $stock = $_POST['stock'];
                                    $sql = "UPDATE `products` SET `stock` = '$stock' WHERE `id` = '" . $_GET['stock'] . "'";
                                    $result = $db->query($sql);
                                    if ($result) {
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            stock Updated!
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            Error! stock Not Updated!
                                        </div>
                                <?php
                                    }
                                }

                                // if get is = add
                            } elseif (isset($_GET['add'])) {
                                require_once '../connection.php';
                                $db = connect();
                                ?>
                                <div class="form">
                                    <form action="stockade.php?add" method="POST">
                                        <div class="form-group">
                                            <label class="sub-label" for="name">Name: </label>
                                            <input class="sub-input" type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sub-label" for="description">Description: </label>
                                            <input class="sub-input" type="text" class="form-control" name="description" id="description" placeholder="Enter Description">
                                        </div>
                                        <div class="form-group">
                                            <label class="sub-label" for="image">Image: </label>
                                            <input class="sub-input" type="file" accept="image/*" class="form-control" name="image" id="image" placeholder="Enter Image URL">
                                        </div>

                                        <div class="form-group">
                                            <label class="sub-label" for="cost">Cost (£): </label>
                                            <input class="sub-input" type="text" class="form-control" name="cost" id="cost" placeholder="Enter Cost">
                                        </div>
                                        <div class="form-group">
                                            <label class="sub-label" for="stock">Stock: </label>
                                            <input class="sub-input" type="text" class="form-control" name="stock" id="stock" placeholder="Enter Stock">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                                    </form>

                                    <button class="btn btn-primary" type="button"><a href="stockade.php">Back</a></button>
                                </div>
                                <?php
                                if (isset($_POST['add'])) {
                                    $name = $_POST['name'];
                                    $description = $_POST['description'];
                                    $image = $_POST['image'];
                                    $cost = $_POST['cost'];
                                    $stock = $_POST['stock'];

                                    // call the image upload function
                                    $img_url = uploadImage($image);

                                    if ($uploadOk == 1) {
                                        $sql = "INSERT INTO `products` (`name`, `description`, `image`, `price`, `stock`) VALUES ('$name', '$description', '$img_url', '$cost', '$stock')";
                                        $result = $db->query($sql);
                                        if ($result) {
                                ?>
                                            <div class="alert alert-success" role="alert">
                                                Product Added!
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                Error! Product Not Added!
                                            </div>
                            <?php
                                        }
                                    }
                                }
                            } else {
                                header("Location: stockade.php");
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



<?php
// create an image upload function
function uploadImage($image)
{
    $target_dir = "Assets/Watches/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo "File is an image - " . $check["mime"] . "."; ?>
            </div>
            <?php
            
            $uploadOk = 1;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "File is not an image."; ?>
            </div>
            <?php
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Sorry, file already exists."; ?>
            </div>
        <?php
        $uploadOk = 0;
    }
    // Check file size
    if ($image["size"] > 500000000) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Sorry, your file is too large."; ?>
            </div>
        <?php
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; ?>
            </div>
        <?php
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Sorry, your file was not uploaded."; ?>
            </div>
        <?php
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo "The file " . htmlspecialchars(basename($image["name"])) . " has been uploaded."; ?>
            </div>
            <?php
            // get full image url
            $img_url = "http://20.254.55.178/Assets/Watches/" . basename($image["name"]);
            return $img_url;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Sorry, your file was not uploaded."; ?>
            </div>
        <?php
        }
    }
}


?>