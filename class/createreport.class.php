<?php require_once("db.class.php");
	if($test_type!=0){
		$sql = "INSERT INTO `loans` (`loan_id`, `loan_amount`, `loan_date`, `loan_duration`, `loan_type`, `loan_roi`, `guarantor`, `commission`, `cin`) VALUES (NULL, '1000', CURRENT_TIMESTAMP, '100', '0', '20', 'santhosh surana', '20', '30') ";
	$conn=new dbConnect; 	$result=$conn->db($sql);
	$data=mysqli_fetch_array($result);
	$reportid=$data[0];
		
		}
	
?>