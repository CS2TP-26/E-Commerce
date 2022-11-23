<?php
session_start();

$status="";
$id = $_POST['id'];

if (isset($_POST['action']) && $_POST['action']=="remove"){
	$id = $_POST['id'];
	if(!empty($_SESSION["basket"])) {
		foreach($_SESSION["basket"] as $key => $value) {
			if($_SESSION["basket"][$key]['id'] == $id){
				unset($_SESSION["basket"][$key]);
				$status = "<div class='box' style
				='color:red;'>
				Product is removed from your basket!</div>";
			}
			if(empty($_SESSION["basket"]))
				unset($_SESSION["basket"]);
		}
	}
}

	



?>


<div class="basket">
<?php

if(isset($_SESSION["basket"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td>Image</td>
<td>Name           </td>
<td>Price (£)            </td>
<td>Total</td>
</tr>	
<?php		
foreach ($_SESSION["basket"] as $product){
?>
<td>
<img src='<?php echo $product["image"]; ?>' width="50" height="40" />
</td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='action' value="change" />
</form>
</td>
<td><?php echo "£".$product["price"]; ?></td>
<td><?php echo "£".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "£".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}else{
	echo "<h3>Your basket is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
</div> 


<h3><?php echo $status; ?></h3>