<?php require_once("db.class.php");
$loan_id=$_POST['loan_id'];
	$sql = "DELETE FROM `loans` WHERE `loan_id` =".$loan_id;
	mysqli_query($CON, $sql);
	echo "Loan account deleted";
	
?>