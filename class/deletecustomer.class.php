<?php require_once("db.class.php");
$customerId=$_POST['cin'];
	$sql = "DELETE FROM `customers` WHERE `cin`=".$customerId;
	$conn->db($sql);
	echo"customer account deleted";
	
?>