<?php
session_start();
include('connection.php');
$status="";
    if (isset($_POST['id']) && $_POST['id']!=""){
    $id = $_POST['id'];
    $result = mysqli_query(
    $con,
    "SELECT * FROM `products` WHERE `id`='$id'"
    );

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$name = $row['name'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
    'id'=>$id,
	'name'=>$name,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["basket"])) {
    $_SESSION["basket"] = $cartArray;
    $status = "<div class='box'>Watch added to your basket!</div>";
    }else{
    $array_keys = array_keys($_SESSION["basket"]);
    if(in_array($code,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	This watch is already added to your basket!</div>";	
        } else {
        $_SESSION["basket"] = array_merge(
        $_SESSION["basket"],
        $cartArray
        );
        $status = "<div class='box'>Watch has been added to your basket!</div>";
	    }

	}
}
?>