<?php require_once("db.class.php");
$customerId=$_POST['cin'];
	$sql = "DELETE FROM `customers` WHERE `cin`=".$customerId;
	mysqli_query($CON, $sql);
	echo"customer account deleted";
	
?>