<?php

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

    if ($basket_length = 0){
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




<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
</head>
<body>
  <h2>Contents of basket</h2>
  <div class="basket">
	<?php

	if (isset($_SESSION["basket"])) {
		$total_price = 0;
	?>
		<table class="table">
			<tbody>
				<tr>
					<td>Image</td>
					<td>Name </td>
					<td>Price (£) </td>
					<td>Total</td>
				</tr>
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
					<td><?php echo "£" . $product["price"] * $product["quantity"]; ?></td>
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
  <h3>Details</h3>
  <form method = "post" action="checkout.php">
  <div>Details</div>
    
    <label>Name on card</label>
    <input id = "textbox" type="name" name="name" required><br><br>
    <label>Card number</label>
    <input id = "textbox" type="card" name="card number" required><br><br>
    <label>Security number</label>
    <input id = "textbox" type="text" name="Security number" required><br><br>
    <!-- submit button -->
    <button type="submit" name="checkout">Checkout</button>

	<input type="hidden" name="submitted" value="true"/>
  </form>  
  <!-- <p> Checkout<a href="my_orders.php">Checkout</a>  </p> -->

</body>
</html>