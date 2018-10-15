<?php session_start();
	require_once("db.class.php");
		$txn_id=$_POST['txn_id'];
		$transaction_amount=$_POST['transaction_amount'];
		$sql = "UPDATE `transactions` SET `txn_amount` = '$transaction_amount' WHERE `transactions`.`txn_id` = '$txn_id'";
		$result=mysqli_query($CON, $sql);
		echo $sql;
	
?>