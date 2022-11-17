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
<a href="pages/index.php">Main index page</a> ❌ ✅ Zeeshan - Anish
<br>
<a href="pages/login.php">Login</a> ✅ ❌ Zeeshan - Anish
<br>
<a href="pages/registration.php">registration</a> ✅ ❌Zeeshan - Anish
<br>
<a href="pages/.php">Basket</a> ✅ ❌ Jac - Anish
<br>
<a href="pages/.php">Checkout</a> 💼 ❌Jac - Anish
<br>
<a href="pages/.php">Quries / Support</a> ❌ ❌Zeeshan - Anish
<br>
<a href="pages/.php">About</a> 💼  Anish
<br>
<a href="pages/.php">Watches - Different sub catergories</a> ❌ ❌ Zeeshan - Anish <br>
each watch has it's own page, with a link to the basket, and a link to the checkout

<br>
<a href="stockade/index.php">Admin Panel / stockade</a> 💼 ❌ Zeeshan - Anish
<br><br><br>
<br>
<a href="pages/logout.php">Log out of sesssion here!!!</a> 


<?php



    // require_once 'php_scripts/visitor_counter.php';
    // $visitors = getVisitors();
?>


