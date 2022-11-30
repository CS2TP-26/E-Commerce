<?php
session_start();

$status = "";
$id = $_POST['id'];

if (isset($_POST['action']) && $_POST['action'] == "remove") {
	$id = $_POST['id'];
	if (!empty($_SESSION["basket"])) {
		foreach ($_SESSION["basket"] as $key => $value) {
			if ($_SESSION["basket"][$key]['id'] == $id) {
				unset($_SESSION["basket"][$key]);
				$status = "<div class='box' style
				='color:red;'>
				Product is removed from your basket!</div>";
			}
			if (empty($_SESSION["basket"]))
				unset($_SESSION["basket"]);
		}
	}
}
?>



<!doctype html>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='css/nav.css' />
	<link rel='stylesheet' type='text/css' href='css/basket.css' />


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
	<?php

	// this statement is to check if the session is empty or not & makes sure that there are no duplicates in the basket
	if (!empty($_SESSION["basket"])) {
		$basket = $_SESSION["basket"];
		$basket = array_unique($basket, SORT_REGULAR);
		$_SESSION["basket"] = $basket;
		$basket_count = count(array_keys($_SESSION["basket"]));
	}
	?>





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
							<img src='<?php echo $product["image"]; ?>' width="50" height="40" />
						</td>
						<td><?php echo $product["name"]; ?><br />
							<form method='post' action=''>
								<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
								<input type='hidden' name='action' value="remove" />
								<button type='submit' class='remove'>Remove Item</button>
							</form>
						</td>
						<td>
							<form method='post' action=''>
								<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
								<input type='hidden' name='action' value="change" />
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
			<?php
		} else {
		echo "<h3>Your basket is empty!</h3>";
		}
			?>
        </div>
		<div style="clear:both;"></div>

			<div class="message_box" style="margin:10px 0px;">
			</div>


			<h3><?php echo $status; ?></h3>


			<?php
			if (isset($_SESSION["basket"])) {
				
			?>
				<!-- button to go to checkout page -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-primary" type="button"><a href="checkout.php">Checkout </a></button>
						</div>
					</div>
				</div>

			<?php
			}


			?>



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

    
	

</html>