<?php

require '../connection.php';
    $URL = "";
    $KPL = "";
if (isset($_POST['submitted'])){

    $email = isset($_POST['email'])?addslashes($_POST['email']):false;
    if(!preg_match("^/[\w\-]+@[\w\-]+.[\w\-]+$/^", $email))
    {
        $Error = "Please input a valid email";
    }

    $name=  isset($_POST['name'])?addslashes($_POST['name']):false;
    if (!($name)){
        echo "name wrong!";
        exit;
    }

    $password=  isset($_POST['password'])?addslashes(password_hash($_POST['password'],PASSWORD_DEFAULT)):false;
    if (!($password)){
        echo "password wrong!";
    }

    $KPL = isset($_POST['Key'])?addslashes($_POST['Key']):false;
 
    $education =  isset($_POST['education'])?addslashes($_POST['education']):false;
    if (!($education)){
        echo "education wrong!";
        exit;
    }
    
    $URL = isset($_POST['URL'])?addslashes($_POST['URL']):false;
   
    
    $profile = isset($_POST['profile'])?addslashes($_POST['profile']):false;

    try{

         
        $stat=$db->prepare("insert into cvs values(default,?,?,?,?,?,?,?)");
        $stat->execute(array($name,$email, $password, $KPL, $education, $URL, $profile));
        
        $id=$db->lastInsertId();
        echo "Congratulations! You are now registered. Your ID is: $order_id  ";  	
        
     }
     catch (PDOexception $ex){
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>". $ex->getMessage()."</em>";
     }
    
     
}
?>




<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
</head>
<body>
  <h2>Details</h2>
  <form method = "post" action="checkout.php">
  <div>Details</div>
    
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
  <p> Checkout<a href="Login.php">Log in</a>  </p>

</body>
</html>