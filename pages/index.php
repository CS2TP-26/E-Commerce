<!-- <?php



$status="";

// $id = 1;

require_once ('../connection.php');
$db = connect();
$sql =  "SELECT * FROM `products` WHERE `id`='$id'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $price = $row["price"];
        $image = $row["image"];
    }
}else{
    echo "No results";
}

session_start();

$basketArray = array(
	$id=>array(
    'id'=>$id,
	'name'=>$name,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

// if(empty($_SESSION["basket"])) {
//     $_SESSION["basket"] = $basketArray;
//     $status = "<div class='box'>Watch added to your basket!</div>";
//     }else{
//     $array_keys = array_keys($_SESSION["basket"]);
//     if(in_array($id,$array_keys)) {
// 	$status = "<div class='box' style='color:red;'>
// 	This watch is already added to your basket!</div>";	
//         } else {
//         $_SESSION["basket"] = array_merge(
//         $_SESSION["basket"],
//         $basketArray
//         );
//         $status = "<div class='box'>Watch has been added to your basket!</div>";

// 	    }

// 	}
?>


<?php
echo $_SESSION["basket"];
$basket = $_SESSION["basket"];
$_SESSION["basket"] = array_values($basket);
$basket = array_values($basket);
echo $basket[0]['name'];
echo $basket[0]['price'];
echo $basket[0]['image'];
echo $basket[0]['quantity'];
echo $basket[0]['id'];

echo $status . '<br>' . $basketArray;




?> -->

this is just a placeholder
