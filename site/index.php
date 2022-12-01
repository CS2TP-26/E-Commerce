<!doctype html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='css/styles.css' />
	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	 <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta charset="utf-8">
    <link rel="icon" href="Assets/icon.png">

	<title>Maison De Versa - Home</title>
</head>

<body>
	<div class="topnav">
		<a href="index.php">
			<img src="img/text only no bg-01.png" width="397" height="227" alt=""/>
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
	<div class="hero">
		<img class="logo" src="img/logo no bg-01.png" width="835" height="835" alt=""/>
	</div>
	<div class="btn">
		<form>
			<button type="submit" formaction="shop.php">Shop Now</button>
		</form>
	</div>
	<div class="reviews">
		<h1 class="title">See What Our Customers Have <br>To Say</h1>
		<h4 class="reviewTitle1">Quality And Value</h4>
		<p class="review1">Purchased this watch at fantastic sale price, arrived quickly in quality presentation box - 24 October 2022</p>
		<h4 class="reviewTitle2">Great Gifts</h4>
		<p class="review2">Such a fantastic quality watch, good weight, looks expensive. Came in a big watch box. I purchased 2 of these, one for my partner and one for my son-in-law and they both loved them. – 27 August 2022</p>
		<h4 class="reviewTitle3">Excellent Customer Service </h4>
		<p class="review3">Nice watch, well packaged. From the time of placing the order, I was kept informed all along the way of the parcel's progress and was able to meet the delivery on the doorstep. Great buying experience! – 10 November 2022</p>
		<h4 class="reviewTitle4">Fast Delivery </h4>
		<p class="review4">Looking for Christmas presents and came across this site, what a wonderful find! The choice was extensive, the prices fantastic and the service speedy and professional. Best of all, no delivery charges. Have already used it twice and will use it again. Cannot recommend highly enough! – 2nd November 2022</p>
	</div>
	<div class="feature1">
    	<img src="img/feature1.webp" width="750px" height="440px" alt=""/> 
		<h4>Jacob and Co. Astronomia Casino Roulette Skeleton</h4>
		<p>Feeling lucky? Luxury watches are not just about telling the time anymore. A case in point, acclaimed timepiece and diamond jewelry house Jacob and Co.'s Astronomia Casino, which features a fully-operational miniature roulette wheel beneath the watch's sapphire crystal dome case. The Astronomia Casino's wheel, rendered in a spectacular array of green, red, and black enamel with mahogany inlays, is set in motion by a button at the eight o'clock position (which also winds the power reserve for the animation). </p>
	</div>
	<div class="feature2">
		<img src="img/feature2.webp" width="750px" height="440px" alt=""/> 
		<h4>Omega James Bond 60th Anniversary Seamaster Diver 300m</h4>
		<p>Launched in 2022, to celebrate 60 years of James Bond, this 42 mm Seamaster Diver 300M in Canopus Gold™ has a dial made from natural grey silicon. A nod to the sands of 007’s Caribbean hideaway. Circling the dial is a unidirectional rotating bezel with a paving of shaded green and yellow treated diamonds, with two diamonds at 12 o’clock.The iconic movie opening sequence, featuring Bond in silhouette and spinning gun barrel, plays out on the caseback, beneath a sapphire decorated with micro-structured metallisation. The “moiré” effect animation is linked to the spinning of the lollipop seconds hand.</p>
	</div>
	<div class="findOutMore">
  		<h1>Find Out More</h1>
			<div class="pics">
    			<img src="img/placeholder_hero.jpg" width="173" height="76" alt=""/>
				<img src="img/About_pic_1.jpg" width="173" height="76" alt=""/>
				<img src="img/About_pic_2.jpg" width="173" height="76" alt=""/>
				<img src="img/About_pic_3.jpg" width="173" height="76" alt=""/>
			</div>
  	<div class="aboutButton">
				<form>
					<button type="submit" formaction="about.php">About Us</button>
				</form>
			</div>
		<p>Maison De Versa makes sourcing and buying luxury time pieces easy and convenient to find out more click the button below. </p>
	</div>
	<div class="bottomNav">
    	<img src="img/logo no bg-01.png" width="200" height="200" alt=""/> 
		<hr></hr>
		<div class="copyright">
			<p>© Maison De Versa LTD, 2022</p>
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
</body>
</html>