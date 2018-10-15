<?php session_start();
	require_once("db.class.php");
	$employeename=$_SESSION['employeename'];
	$sql = "SELECT `employee_role` FROM `employees` WHERE `employeename`= '$employeename' ";
	$result=mysqli_query($CON, $sql);
	$data=mysqli_fetch_array($result);
	echo $data['employee_role'];
	
?>