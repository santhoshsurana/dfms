<?php require_once("db.class.php");

	$employee_id=$_GET['employee_id'];
	$password=md5($_GET['password']);
	$role=$_GET['role'];
	if ($_GET['password']!='') {
		$sql = "UPDATE `employees` SET `password` = '$password', `employee_role`='$role' WHERE `employees`.`employee_id` = $employee_id;";
		echo $sql;
	}else{
		$sql = "UPDATE `employees` SET `employee_role`='$role' WHERE `employees`.`employee_id` = $employee_id;";
		echo $sql;
	}
	mysqli_query($CON, $sql);
	
	
?>