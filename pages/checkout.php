<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
</head>
<body>
  <h2>Details</h2>
  <form method = "post" action="checkout.php">
  <div>Details</div>
     <label>email</label>
    <input id = "textbox" type="email" name="email" required><br><br>
    <label>Name on card</label>
    <input id = "textbox" type="name" name="name" required><br><br>
    <label>Card number</label>
    <input id = "textbox" type="card" name="card number" required><br><br>
    <label>Security number</label>
    <input id = "textbox" type="text" name="Security number" required><br><br>
  
	<input type="submit" value="Register" /> 
	<input type="reset" value="clear"/>
	<input type="hidden" name="submitted" value="true"/>
  </form>  
  <p> Already have an account? <a href="Login.php">Log in</a>  </p>

</body>
</html>