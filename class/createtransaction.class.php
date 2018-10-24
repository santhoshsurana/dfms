<?php session_start();
	require_once("db.class.php");
	if ($_POST['loan_id']!="") {
		$date=date('Y-m-d', strtotime($_POST['date']));
	$loan_id=$_POST['loan_id'];
	$transaction_amount=$_POST['transaction_amount'];
	$sql = "INSERT INTO `transactions` (`txn_id`, `txn_date`, `txn_amount`, `loan_id`) VALUES (NULL, '".$date."', '".$transaction_amount."', '".$loan_id."')";
	$conn=new dbConnect; 	$result=$conn->db($sql);
	echo 1;
	}
	else {
		echo 0;
	}
	
	
?>