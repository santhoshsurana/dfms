<?php session_start();
	require_once("db.class.php");
	$employeename=$_SESSION['employeename'];
	$sql = "SELECT `employee_id` FROM `employees` WHERE `employeename`= '$employeename' ";
	$result=mysqli_query($CON, $sql);
	$data=mysqli_fetch_array($result);
	$employee_id=$data['employee_id'];
	$cin=$_POST['cin'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$mobile=$_POST['mobile'];
	$altmobile=$_POST['altMobile'];
	$occupation=$_POST['occupation'];
	$address=$_POST['address'];
	$aadhar=$_POST['aadhar'];

	$sql = "UPDATE `customers` SET `customer_first_name` = '$firstname', `customer_last_name` = '$lastname', `customer_age` = '$age',
	 `customer_gender` = '$gender', `customer_occupation` = '$occupation', `customer_mobile` = '$mobile', 
	 `customer_altmobile` = '$altmobile', `customer_aadhar` = '$aadhar', `customer_address` = '$address'
	  WHERE `customers`.`cin` = '$cin'";

	$result=mysqli_query($CON, $sql);
	if(!$result){
		echo "update failed at update module";
	}
	else{
		echo "update successfully executed";
	}
?>