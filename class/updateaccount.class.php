 <?php session_start();
	require_once("db.class.php");
	$loan_id=$_POST['loan_id'];
	$cin=$_POST['cin'];
	$loan_amount=$_POST['loan_amount'];
	$loan_duration=$_POST['loan_duration'];
	$emi_start_date=$_POST['emi_start_date'];
	$date= date("Y-m-d", strtotime($emi_start_date));
	$roi=$_POST['roi'];
	$loan_type=$_POST['loan_type'];
	$commission=$_POST['commission'];
	$guarantor=$_POST['guarantor'];
	$sql = "UPDATE `loans` SET `loan_amount` = '$loan_amount', `loan_duration` = '$loan_duration', `loan_date` = '$date', `loan_type` = '$loan_type', `loan_roi` = '$roi', `guarantor` = '$guarantor', `commission` = '$commission' WHERE `loans`.`loan_id` = $loan_id";
		$result=mysqli_query($CON, $sql);
		echo $sql;
?>