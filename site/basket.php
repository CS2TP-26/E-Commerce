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
	<link rel='stylesheet' type='text/css' href='css/scroll.css' />



	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
    <link rel="icon" href="../Assets/icon.png">
	<title>Mason De Versa - Basket</title>
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
				<br><br><br><br>
				<table>
					<thead>
						<tr>
							<th>Image</th>
							<th>Name </th>
							<th>Price (£) </th>
							<th>Remove</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($_SESSION["basket"] as $product) {
						?>
							<tr>

								<td>
									<img src='<?php echo $product["image"]; ?>' width="75" height="65" />
								</td>
								<td><?php echo $product["name"]; ?></td>

								<td><?php echo "£" . $product["price"]; ?></td>


								<td>
									<form method='post' action=''>
										<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
										<input type='hidden' name='action' value="remove" />
										<button type='submit' class='remove'>Remove Item</button>
									</form>
								</td>
							</tr>


						<?php
							$total_price += ($product["price"] * $product["quantity"]);
						}
						?>


					</tbody>
				</table>
			<?php
			} else {
				echo "<h3>Your basket is empty!</h3>";
			}
			?>



		</div>
		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;"></div>


		<h3><?php echo $status; ?></h3>



		<?php
		if (isset($_SESSION["basket"])) {

		?>
			<!-- button to go to checkout page -->
			<div class="checkout_">
				<strong>TOTAL: <?php echo "£" . $total_price; ?></strong>

				<button class="btn btn-primary checkout" type="button"><a href="checkout.php">Checkout </a></button>
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