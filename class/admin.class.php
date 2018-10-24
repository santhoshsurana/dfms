<?php session_start();
	require_once("db.class.php");
	$employeename=$_SESSION['employeename'];
	$sql = "SELECT `employee_role` FROM `employees` WHERE `employeename`= '$employeename' ";
	$conn=new dbConnect;
	$conn=new dbConnect; 	$result=$conn->db($sql);
	$data=mysqli_fetch_array($result);
	echo $data['employee_role'];
	
?>