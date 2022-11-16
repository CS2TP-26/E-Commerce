<?php



$status="";
if (isset($_POST['id']) && $_POST['id']!=""){
require_once ('../connection.php');
$db = connect();
$id = 1;


$sql =  "SELECT * FROM `products` WHERE `id`='$id'";
$result = $db->query($sql);


$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$name = $row['name'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$id=>array(
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
    if(in_array($id,$array_keys)) {
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

<h1>test</h1>

<?php
echo $status . '<br>' . $cartArray;
?>
