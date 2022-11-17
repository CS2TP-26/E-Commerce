<?php



$status="";
// if (isset($_POST['id']) && $_POST['id']!=""){
require_once ('../connection.php');
$db = connect();
$id = 1;


$sql =  "SELECT * FROM `products` WHERE `id`='$id'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $price = $row["price"];
        $image = $row["image"];
        // echo $name;
        // echo $price;
        // echo $image;
        
    }
}else{
    echo "No results";
}


// $row = mysqli_fetch_assoc($result);

// $id = $row['id'];
// $name = $row['name'];
// $price = $row['price'];
// $image = $row['image'];

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
// }
?>

<h1>test</h1>

<?php
echo $_SESSION["basket"];
// $_SESSION['name'] = $name;

// split the basket array to inidividual arrays
$basket = $_SESSION["basket"];
$_SESSION["basket"] = array_values($basket);
$basket = array_values($basket);
echo $basket[0]['name'];
echo $basket[0]['price'];
echo $basket[0]['image'];
echo $basket[0]['quantity'];
echo $basket[0]['id'];

echo $status . '<br>' . $cartArray;




?>
