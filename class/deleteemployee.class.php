<?php require_once("db.class.php");
	
	$employeeId=$_POST['employeeId'];
	$sql = "DELETE FROM `employees` WHERE `employee_id`='$employeeId'";
	$conn->db($sql);
	echo"employee account has been deleted!";
	
?>