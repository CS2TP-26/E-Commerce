<h1>Maison De Versa</h1>
Maison De Versa
<?php 
    session_start();
    echo "Quick check to init the session & PHP <br>";
    echo "Session Name: " . session_name() . "<br>";
    echo "Session Status: " . session_status() . "<br>";
    echo "Session Save Path: " . session_save_path() . "<br>";
    echo "Session Cookie Path: " . ini_get("session.cookie_path") . "<br>";
    echo "Sess Name:  " . $_SESSION['name'] . "<br>";
    echo "Sess Email: " . $_SESSION['email'] . "<br>";
    echo "Sess ID: " . $_SESSION['id'] . "<br>";
    echo "Sess Creation: " . $_SESSION['creation'] . "<br>";
    echo "Sess Acc Type: " . $_SESSION['acc_type'] . "<br>";

    

?>
<!-- make a red bold h3 tag -->
<h3 style="color: red; font-weight: bold;">First= backend, second = front end</h3>
<br>
<a href="site/index.php">Main index page</a> ❌ ✅ Zeeshan - Anish
<br>
<a href="site/login.php">Login</a> ✅ ❌ Zeeshan - Anish
<br>
<a href="site/Basket.php">Basket</a> ✅ ❌ Jac - Anish
<br>
<a href="site/checkout.php">Checkout</a> 💼 ❌Jac - Anish
<br>
<!-- <a href="pages/.php">Quries / Support</a> ❌ ❌Zeeshan - Anish -->
<!-- <br> -->
<a href="site/.php">About</a> 💼  Anish
<br>
<a href="site/shop.php">Watches - Different sub catergories</a> ❌ ❌ Zeeshan - Anish <br>
each watch has it's own page, with a link to the basket, and a link to the checkout

<br>
<a href="stockade/index.php">Admin Panel / stockade</a> 💼 ❌ Zeeshan - Anish
<br><br><br>
<br>
<a href="site/logout.php">Log out of sesssion here!!!</a> 


Redirecting to login.php in 5 seconds...
<!-- take to the index of the site in 5 seconds -->
<meta http-equiv="refresh" content="5;url=../site/index.php" />



<?php




?>


