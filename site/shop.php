<!doctype html>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='styles.css' />
	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
	<title>Mason De Versa - Shop</title>
</head>

<body>
	<div class="topnav">
		<a href="index.php">
			<img src="img/text only no bg-01.png" width="397" height="227" alt="" />
		</a>
		<form>
			<button type="submit" formaction="login.php">Login</button>
		</form>
		<a href="basket.php">Basket</a>
		<a href="contact.php">Contact Us</a>
		<a href="about.php">About Us</a>
		<a href="shop.php">Shop</a>
	</div>
	<div class="shopHero">
		<img src="img/placeholder hero.jpg" width="1920" height="1281" alt="" />
		<h1>Recieve and extra special <b><i>free gift</i></b> with your luxury watch!</h1>
		<p><i>With watch purchases £2,000 or more, choose between the new free leather valet tray or the watch box to store up to five watches. And with watch purchases between £1,000 and £1,999, you’ll receive a free watch roll. Just consider it a gift from us to you.</i></p>
	</div>
	<div class="products">
		<h1>Shop All Watches</h1>
		<?php

		require_once '../connection.php';
		$db = connect();
		$id = $_GET['view'];
		$sql = "SELECT * FROM products WHERE id = $id";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		?>
		<div class="col-md-4">
			<div class="card">
				<img src="<?php echo $row['image']; ?>" class="card-img-top" style="width: auto; height: 250px; object-fit: scale-down;" alt="...">
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
	</div>
	<div class="topPicks">
		<h1>Our top picks</h1>

	</div>
	<div class="preOwned">
		<h1>Our limited Pre-Owned Watches</h1>

	</div>
	<div class="creditBanner">
		<h1>Spread the cost with up to 4 years interest free credit* Subject to T&Cs</h1>
		<p>Shop watches from £14.07 per month*. 0% finance is available on all purchases over £99.</p>
	</div>
	<div class="highlights">


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
		<form>
			<button type="submit" formaction="login.php">Login</button>
		</form>
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