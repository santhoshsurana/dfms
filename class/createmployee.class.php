<?php require_once("db.class.php");

	$employeename=$_POST['employeename'];
	$password=md5($_POST['password']);
	$role=$_POST['role'];
	$sql = "INSERT INTO `employees` (`employee_id`, `employeename`, `password`, `employee_role`) VALUES (NULL, '$employeename', '$password', '$role');";
	$conn=new dbConnect; 	$result=$conn->db($sql);
	if(!$result){
		echo "0";
	}
	else{
		echo "1";
	}

	
?>