<?php session_start();
require_once("db.class.php");

	$employeename=$_POST['employeename'];
	$password=md5($_POST['password']);
	$sql = "SELECT `employee_id`,`employee_role` FROM `employees` WHERE `employeename`='$employeename' AND `password`='$password'";
	$result=mysqli_query($CON, $sql);
	$data=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$_SESSION['employeename']=$employeename;
		$_SESSION['employee_id']=$data[0];
		$_SESSION['employee_role']=$data[1];
		echo "1";
	}
	else{
		echo "0";
	}
	
?>