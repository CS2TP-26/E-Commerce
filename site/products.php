<!doctype html>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='css/main.css' />
	<link rel='stylesheet' type='text/css' href='css/products.css' />
	<link rel='stylesheet' type='text/css' href='css/scroll.css' />


	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
    <link rel="icon" href="../Assets/icon.png">

	<title>Mason De Versa - Products </title>
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

	<?php

	// if get is = id or add make a varible and add that value
	if (isset($_GET['id'])) {
		$prod_id = $_GET['id'];
	} else {
		$prod_id = $_GET['add'];
	}

	?>

	<div class="main">

		<div class="left">

			<div class="product">

				<?php
				require_once '../connection.php';
				$db = connect();
				$sql = "SELECT * FROM products WHERE id = " . $prod_id;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				

				$description = $row['description'];
				$image = $row['image'];
				$img1 = $row['img1'];
				$img2 = $row['img2'];
				$img3 = $row['img3'];
				


				?>

				<div class="top">
					<a href="<?php echo $row['image']; ?>">

						<img src="<?php echo $row['image']; ?>" width="100" height="100" alt="" />
					</a>
				</div>

				<div class="middle">
					<a href="<?php echo $row['img1']; ?>">
						<img src="<?php echo $row['img1']; ?>" width="100" height="100" alt="" />
					</a>

					<a href="<?php echo $row['img2']; ?>">
						<img src="<?php echo $row['img2']; ?>" width="100" height="100" alt="" />
					</a>

					<a href="<?php echo $row['img3']; ?>">
						<img src="<?php echo $row['img3']; ?>" width="100" height="100" alt="" />
					</a>
				</div>

				<div class="bottom">
					<h1>Product Infomation</h1>
					<p><?php echo $row['description']; ?></p>
				</div>






			</div>

			<div class="recomended">
				<h1>Recommended</h1>
				<div class="products">
					<?php
					$i = 1;

					require_once '../connection.php';
					$db = connect();
					$sql = "SELECT * FROM products";
					$result = $db->query($sql);
					while ($row = $result->fetch_assoc()) {
						if ($i <= 8) {
					?>
							<div class="item">
								<a href="products.php?id=<?php echo $row['id']; ?>">
									<img src="<?php echo $row['image']; ?>" width="100" height="100" alt="" />
								</a>
							</div>

					<?php
							$i++;
						}
					}
					?>


				</div>
			</div>
		</div>


		<!-- getting the product details -->

		<?php
		require_once '../connection.php';
		$db = connect();
		$sql = "SELECT * FROM products WHERE id = " . $prod_id;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		$name = $row['name'];
		$price = $row['price'];
		$MPN = $row['MDN'];

		?>

		<div class="price">
			<h1><?php echo $name ?></h1>
			<p><?php echo $MPN ?></p>
			<h2><?php echo "£" . $price ?></h2>
			<form>
				<button class="add_basket" type="button"><a href="products.php?id=<?php echo $row['id'] . "&add=" . $row['id'];  ?>">Add to Basket </a></button>
			</form>
			<br>
			<br>
			<br>

			<div class="status">
				<?php 
			 	if (isset($_GET['add'])) {
				
				echo $name . "<br>" . "has been added to your basket!";

				?>

				<form>
					<button type="submit" class="add_basket" formaction="basket.php">View Basket</button>
				</form>
				<form>
					<button type="submit" class="add_basket" formaction="shop.php">Continue Shopping...</button>
				</form>


				<?php

				}
				?>
			</div>



			<?php
			 if (isset($_GET['add'])) {
				$id = $prod_id;
				$status = "Added to basket";
				require_once('../connection.php');
				$db = connect();
				$sql =  "SELECT * FROM `products` WHERE `id`='$id'";
				$result = $db->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$name = $row["name"];
						$price = $row["price"];
						$image = $row["image"];
					}
				} else {
					echo "No results";
				}

				session_start();

				$basketArray = array(
					$id => array(
						'id' => $id,
						'name' => $name,
						'price' => $price,
						'quantity' => 1,
						'image' => $image
					)
				);

				if (empty($_SESSION["basket"])) {
					$_SESSION["basket"] = $basketArray;
					$status = "Watch added to your basket!";
				} else {
					$array_keys = array_keys($_SESSION["basket"]);
					if (in_array($id, $array_keys)) {
						$status = "Watch already added to your basket!";
					} else {
						$_SESSION["basket"] = array_merge($_SESSION["basket"], $basketArray);
						$status = "Watch added to your basket!";
					}
					
				}
			}
			?>
		</div>

	</div>







	<div class="shopBottomNav">
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

</html>