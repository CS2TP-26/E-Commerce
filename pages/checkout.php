<?php

session_start();
require_once '../connection.php';
$db = connect();





if (isset($_POST['Checkout'])) {
  $sql = "INSERT INTO orders (user_ID, product_ID) VALUES ('$_SESSION['id']', '$product["id"]')";
   $result = mysqli_query($db, $sql);

   foreach($basketArray as $product) {
    echo $item['id'];
    
  
    // To know what's in $product
    echo '<pre>'; var_dump($product);
  

}

if(empty($_SESSION["basket"]))
  echo "Your basket is empty!";

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
     echo $_SESSION["basket"];
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