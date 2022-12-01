<?php
//h
session_start();
require_once '../connection.php';
$db = connect();
$product_id = $basket[$i]['id'];
echo "product id" . $product_id;

// if user is not logged in they will be redirected to the login page
if (!isset($_SESSION['id'])) {
	header('Location: login.php');
}

// if the checkout button is pressed
if (isset($_POST['checkout'])) {
	$user_id = $_SESSION['id'];
	$basket = $_SESSION['basket'];
	$basket_length = count($basket);
	$status = "Pending";

	if ($basket_length = 0) {
		echo "Your basket is empty";
	} else {
		foreach ($_SESSION["basket"] as $product) {
			$product_id = $product['id'];
			$sql = "INSERT INTO `orders` (`user_ID`, `product_ID`, `status`) VALUES ('$user_id', '$product_id', '$status')";
			$result = $db->query($sql);
			echo "result: " . $result;
		}
		unset($_SESSION['basket']);
		echo "result: " . $result;


		// header('Location: my_orders.php'); 
	}
}
?>

<!doctype html>

<head>
	<link rel='stylesheet' type='text/css' href='css/nav.css' />
	<link rel='stylesheet' type='text/css' href='css/checkout.css' />

	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
	<title>Mason De Versa - Shop</title>
</head>

<body>
	<?php session_start(); ?>

	<div class="topnav">
		<a href="index.php">
			<img src="img/text only no bg-01.png" width="397" height="227" alt="" />
		</a>
		<!-- <form>
			<button type="submit" formaction="login.php">Login</button>
		</form> -->
		<a href="basket.php">Basket</a>
		<a href="contact.php">Contact Us</a>
		<a href="about.php">About Us</a>
		<a href="shop.php">Shop</a>
	</div>


	<div class="panel">
		<div class="basket">
			<?php

			if (isset($_SESSION["basket"])) {
				$total_price = 0;
			?>
				<table>
					<thead>
						<tr>
							<th>Image</th>
							<th>Name </th>
							<th>Price (£) </th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($_SESSION["basket"] as $product) {
						?>
							<td>
								<img src='<?php echo $product["image"]; ?>' width="75" height="65" />
							</td>
							<td><?php echo $product["name"]; ?><br />
								<form method='post' action=''>
									<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
									<input type='hidden' name='action' value="remove" />
								</form>
							</td>
							<td><?php echo "£" . $product["price"]; ?></td>
							</tr>
						<?php
							$total_price += ($product["price"] * $product["quantity"]);
						}
						?>
						<tr>
							<td colspan="5" align="right">
								<strong>TOTAL: <?php echo "£" . $total_price; ?></strong>
							</td>
						</tr>
					</tbody>
				</table>
				<form>
					<button type="submit" class="btn btn-primary btn-block btn-large" formaction="basket.php">Return to basket</button>
				</form>
				<!-- <button type="submit" name="Checkout" class="btn btn-primary btn-block btn-large">Return to basket</button> -->


			<?php
			} else {
				echo "<h3>Your basket is empty!</h3>";
			}
			?>
		</div>
	</div>

	<div class='checkout'>
		<h1>Checkout</h1>
		<form action="checkout.php" method="post">
			<input type="text" name="Firstname" placeholder="First Name" required="required" />
			<input type="text" name="Lastname" placeholder="Last Name" required="required" />
			<input type="text" name="Cardname" placeholder="Name on card" required="required" />
			<input type="text" name="Cardnumber" placeholder="Card number" required="required" />
			<input type="text" name="Securitynumber" placeholder="Security number" required="required" />
			<input type="text" name="Addressline1" placeholder="Address line 1" required="required" />
			<input type="text" name="Addressline2" placeholder="Address line 2" required="required" />
			<input type="text" name="City" placeholder="City" required="required" />
			<input type="text" name="Postcode" placeholder="Postcode" required="required" />
			<button type="submit" name="Checkout" class="btn btn-primary btn-block btn-large">Checkout</button>
		</form>
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
</body>

</html>