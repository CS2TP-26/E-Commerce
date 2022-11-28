<?php

session_start();
require_once '../connection.php';
$db = connect();

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
      for ($i = 0; $i < $basket_length; $i++) {
        $product_id = $basket[$i]['id'];
        $sql = "INSERT INTO `orders` (`user_ID`, `product_ID`, `status`) VALUES ('$user_id', '$product_id', '$status')";
        $result = $db->query($sql);
        echo "Order placed";
    }
    unset($_SESSION['basket']);
    // header('Location: orders.php');
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
  <div>
    <?php
     echo $_SESSION["basket"];
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
  
	<input type="Checkout" value="Checkout" /> 
	<input type="clear" value="clear"/>
	<input type="hidden" name="submitted" value="true"/>
  </form>  
  <p> Checkout<a href="my_orders.php">Checkout</a>  </p>

</body>
</html>