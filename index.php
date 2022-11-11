<h1>Maison De Verce</h1>
Maison De Verce
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
<a href="pages/login.php">Login</a> ✅ ❌ Zeeshan - Anish
<br>
<a href="pages/registration.php">registration</a> ✅ ❌Zeeshan - Anish
<br>
<a href="pages/.php">Basket</a> ❌ ❌ Jac - Anish
<br>
<a href="pages/.php">Checkout</a> ❌❌Jac - Anish
<br>
<a href="pages/.php">Quries / Support</a> ❌ ❌Zeeshan -Anish
<br>
<a href="pages/.php">About</a> ❌ ❌ Zeeshan - Anish
<br>
<a href="pages/.php">Watches - Different sub catergories</a> ❌ ❌ Zeeshan - Anish
<br>
<a href="pages/.php">Admin Panel</a> ❌ ❌ Zeeshan - Anish
<br>




<br><br><br>
<!-- logout -->

<a href="pages/logout.php">Log out of sesssion here!!!</a> 