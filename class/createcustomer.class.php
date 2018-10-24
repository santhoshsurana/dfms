<?php session_start();
	require_once("db.class.php");
	$employeename=$_SESSION['employeename'];
	$sql = "SELECT `employee_id` FROM `employees` WHERE `employeename`= '$employeename' ";
	$conn=new dbConnect; 	$result=$conn->db($sql);
	$data=mysqli_fetch_array($result);
	$employee_id=$data['employee_id'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$mobile=$_POST['mobile'];
	$altmobile=$_POST['altMobile'];
	$city=$_POST['city'];
	$district=$_POST['district'];
	$state=$_POST['state'];
	$occupation=$_POST['occupation'];
	$address=$_POST['address'];
	$aadhar=$_POST['aadhar'];
	$sql = "INSERT INTO `customers` (`cin`, `customer_first_name`, `customer_last_name`, `customer_age`, `customer_gender`, 
	`customer_occupation`, `customer_mobile`, `customer_altmobile`, `customer_aadhar`, `customer_address`, `customer_city`,
	 `customer_distrct`, `customer_state`, `customer_since`, `added_by`) 
	VALUES (NULL, '$firstname', '$lastname', '$age', '$gender', '$occupation', '$mobile', '$altmobile', 
	'$aadhar', '$address', '$city', '$district', '$state', CURRENT_TIMESTAMP, '$employee_id');"; 
	$conn=new dbConnect; 	$result=$conn->db($sql);
	if(!$result){
		echo "0";
	}
	else{
		echo "1";
	}
?>