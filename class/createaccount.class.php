<?php session_start();
	require_once("db.class.php");
	$cin=$_POST['cin'];
	$loan_amount=$_POST['loan_amount'];
	$loan_duration=$_POST['loan_duration'];
	$emi_start_date=$_POST['emi_start_date'];
	$date= date("Y-m-d", strtotime($emi_start_date));
	$roi=$_POST['roi'];
	$loan_type=$_POST['loan_type'];
	$commission=$_POST['commission'];
	$guarantor=$_POST['guarantor'];
	$sql = "INSERT INTO `loans` 
	(`loan_id`, `loan_amount`, `loan_date`, `loan_duration`, `loan_type`, `loan_roi`, `guarantor`, `commission`, `cin`) VALUES 	(NULL, '$loan_amount', '$date', '$loan_duration', '$loan_type', '$roi', '$guarantor', '$commission', '$cin') ";
		$result=mysqli_query($CON, $sql);
    	$loan_id = mysqli_insert_id($CON);
    	
    		switch ($loan_type) {
             case 0:
                 $loan_type= "day";
                 break;
                 $date= date("Y-m-d", strtotime($emi_start_date . ' +1 '.$loan_type));
             case 1:
                 $loan_type="week";
                 $date = date('Y-m-d', strtotime("next monday", strtotime($emi_start_date)));
                 break;
             case 2:
                 $loan_type="month";
                 break;
         }
for ($loan_duration;$loan_duration!=0;$loan_duration--)
{
 $sql = "INSERT INTO `transactions` (`txn_id`, `txn_date`, `txn_amount`, `loan_id`) VALUES (NULL, '$date', NULL, $loan_id)";
 $result=mysqli_query($CON, $sql);
 $date = date('Y-m-d', strtotime($date . ' +1 '.$loan_type));
}
		
?>