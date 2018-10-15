<?php require_once("db.class.php");
	
	$employeeId=$_POST['employeeId'];
	$sql = "DELETE FROM `employees` WHERE `employee_id`='$employeeId'";
	mysqli_query($CON, $sql);
	echo"employee account has been deleted!";
	
?>