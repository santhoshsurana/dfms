<?php session_start();
require_once("class/db.class.php");
$employee_role = $_SESSION['employee_role'];
if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $from_date = $_GET['fromDate'];
    $to_date   = $_GET['toDate'];
    $loan_type   = $_GET['loan_type'];
} else {
    $from_date = date('m/d/Y');
    $to_date   = date('m/d/Y');
    $loan_type   = '0';
}
$temp           = explode('/', $from_date);
$from_date_time = $temp[2] . $temp[0] . $temp[1] . '000000';
$temp           = explode('/', $to_date);
$to_date_time   = $temp[2] . $temp[0] . $temp[1] . '235959';

?>
<dir class="row-fluid">


<label for="from_date" class="pull-left" style="margin:5px">From</label>
<input name="from_date" id="from_date" class="date-picker pull-left" type="text" value="<?php
echo $from_date;
?>" />
<label for="to_date" class="pull-left" style="margin:5px">To</label>
<input name="to_date" id="to_date" class="date-picker pull-left" type="text" value="<?php
echo $to_date;
?>" />
<label for="loan_type" class="pull-left" style="margin:5px">Loan Type</label>
<select class="pull-left" name="loan_type" id="loan_type"> 
    <option value="0">Daily Finance</option>
    <option value="1">Weekly Finance</option>
</select>
<button onClick="viewReports('reports.php?');" style="margin:0px 5px;" class="btn btn-inverse pull-left">Results</button>
</dir>
<?php

$sql        = "SELECT t.*, l.*, c.customer_first_name, c.customer_last_name, c.customer_mobile, c.customer_address FROM transactions t, loans l, customers c WHERE t.txn_amount<((l.loan_amount)/(l.loan_duration))  AND l.loan_id=t.loan_id and l.cin=c.cin and l.loan_type=".$loan_type." AND t.txn_date BETWEEN " . $from_date_time . " AND " . $to_date_time . " ORDER BY l.cin DESC ";
$result     = mysqli_query($CON, $sql);
$page_count = mysqli_num_rows($result);
if ($page_count != 0) {
?>

<div class="row-fluid"><h3>Today Dues List</h3></div>
 
<!-- start of View customer tab  -->
<div class="table-responsive">
              <table class="table table-bordered" id="reportsTable">
              <thead>
                  <tr>
                    <th>Loan A/C No.</th>
                    <th>Loan type</th>
                    <th>customer Name</th>
                    <th>customer mobile</th>
                    <th>today due</th>
                    <th>Loan Amount</th>
                    <th>Paid Amount</th>
                    <th>total Due</th>
                    <th>total days left</th>
                    <th>Emi Date</th>
                    <th>Emi pay</th>
               </tr>
                </thead>
                <tbody>
<?php
    while ($data = mysqli_fetch_array($result)) {

        $sql = "SELECT SUM(txn_amount) FROM `transactions` WHERE loan_id=".$data['loan_id'];
        $txn_sum_result = mysqli_query($CON, $sql);
        $txn_sum = mysqli_fetch_array($txn_sum_result);

        $sql = "SELECT COUNT(txn_amount) FROM `transactions` WHERE loan_id=".$data['loan_id']." AND txn_amount='0'";
        $txn_count_result = mysqli_query($CON, $sql);
        $txn_count = mysqli_fetch_array($txn_count_result);

        $data['loan_date'] = date("d-m-Y h:i:a", strtotime($data['loan_date']));
?>
       <tr>
         <td><?php
        echo $data['loan_id'];
?></td>    
        <td><?php
         switch ($data['loan_type']) {
             case 0:
                 echo "daily finance";
                 break;
             case 1:
                 echo "weekly finance";
                 break;
             case 2:
                 echo "monthly finance";
                 break;
         }
?></td>
         <td><?php
        echo $data['customer_first_name']." ".$data['customer_last_name'];
?></td>
         
         <td><?php
        echo $data['customer_mobile'];
?></td>
        
        <td><?php
        echo round(($data['loan_amount']/$data['loan_duration'])-$data['txn_amount']);
?></td>
         <td><?php
        echo $data['loan_amount']; 
?></td>
 <td><?php
        echo $txn_sum[0]; 
?></td>
 <td><?php
        echo $data['loan_amount'] - $txn_sum[0]; 
?></td>
      <td><?php
        echo $txn_count[0]; 
?></td>
 <td><?php
        echo $data['txn_date'];; 
?></td>
 <td> <input type='number' id='<?php echo $data['txn_id'];?>' required name='collectionAmount' maxlength='5' placeholder='enter collection amount' onblur='reportTransaction("<?php echo $data['txn_id'];?>");' 
                  value='<?php echo $data['txn_amount'];?>' onKeyPress='charChk(event,'num');' /></td>
       </tr>
 <?php
    }
?>
</tbody>
</table>
</div>
<!-- end of View customer tab  -->
<?php
} else {
    echo "<div class='row-fluid'><h3 align='center'>No Records Found!</h3></div>";
}
?>
    <script>    $('.date-picker').datepicker();  
$(data).ready( function () {
    $('#reportsTable').DataTable();
} );


     </script> 
