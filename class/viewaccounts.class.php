<?php session_start();
require_once("db.class.php");
$employee_role = $_SESSION['employee_role'];
if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 0;
}
if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $from_date = $_GET['fromDate'];
    $to_date   = $_GET['toDate'];
    $loan_type   = $_GET['loan_type'];

} else {
    $from_date = date('m/d/Y');
    $from_date = date('m/d/Y', strtotime($from_date . ' -1 month'));
    $to_date   = date('m/d/Y');
    $loan_type   = '0';
}
$temp           = explode('/', $from_date);
$from_date_time = $temp[2] . $temp[0] . $temp[1] . '000000';
$temp           = explode('/', $to_date);
$to_date_time   = $temp[2] . $temp[0] . $temp[1] . '235959';
$page_back      = $page - 10;
if ($page_back < 0) {
    $page_back       = 0;
    $page_back_limit = 0;
} else {
    $page_back_limit = 1;
}
$page_next       = $page + 10;
$sql             = "SELECT l.*, c.customer_first_name,c.customer_last_name FROM loans l, customers c WHERE l.cin=c.cin AND l.loan_type=".$loan_type." AND  l.loan_date  BETWEEN " . $from_date_time . " AND " . $to_date_time . " ORDER BY `loan_date` DESC LIMIT " . $page_back . ", " . $page_back_limit;
$conn=new dbConnect; 
$result          = $conn->db($sql);
$back_page_count = mysqli_num_rows($result);
$sql             = "SELECT l.*, c.customer_first_name,c.customer_last_name FROM loans l, customers c WHERE l.cin=c.cin AND l.loan_type=".$loan_type." AND  l.loan_date  BETWEEN " . $from_date_time . " AND " . $to_date_time . " ORDER BY `loan_date` DESC LIMIT " . $page_next . ", 1";
$conn=new dbConnect; 
$result          = $conn->db($sql);
$next_page_count = mysqli_num_rows($result);
?>
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
    <option value="2">monthly Finance</option>
</select>
<button onClick="viewReports('class/viewaccounts.class.php?');" style="margin:0px 5px;" class="btn btn-inverse pull">Results</button>
<?php
$sql        = "SELECT l.*, c.customer_first_name,c.customer_last_name FROM loans l, customers c WHERE l.cin=c.cin AND l.loan_type=".$loan_type." AND  l.loan_date  BETWEEN " . $from_date_time . " AND " . $to_date_time . " ORDER BY l.loan_date DESC ";
$conn=new dbConnect; 
$result=$conn->db($sql);
$page_count = mysqli_num_rows($result);
if ($page_count != 0) {
?>
 <h3>Loan List</h3>
<!-- start of View customer tab  -->
              <table class='table table-hover table-bordered' id="accountsTable">
              <thead>
                  <tr>
                    <th>Loan A/C No.</th>
                    <th>customer Name</th>
                    <th>Loan Type</th>
                    <th>Loan duraion</th>
                    <th>Loan Amount</th>
                    <th>Rate of interest</th>
                    <th>guatantor</th>
                    <th>commission</th>
                    <th>Date </th>
                    <th>Add</th>
                    <th>Edit</th>
                    <?php
    if ($employee_role == 0) {
?>
         <th>Delete</th>
         <?php
    }
?>
               </tr>
                </thead>
                <tbody>
<?php
    while ($data = mysqli_fetch_array($result)) {
        $data['loan_date'] = date("d-m-Y h:i:a", strtotime($data['loan_date']));
?>
       <tr>
         <td><?php
        echo $data['loan_id'];
?></td>    
         <td><?php
        echo $data['customer_first_name']." ".$data['customer_last_name'];
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
        echo $data['loan_duration'];
?></td>
         <td><?php
        echo $data['loan_amount'];
?></td>
		<td><?php
        echo $data['loan_roi']."%";
?></td>
         <td><?php
        echo $data['guarantor'];
?></td>
         <td><?php
        echo $data['commission']."%";;
?></td>
		<td><?php
        echo $data['loan_date'];
?></td>
         <td><button class='btn' onClick='transactions
(<?php
        echo $data['loan_id'];
?>)'><i class='icon-list-alt'></i></button></td>
         <td><button class='btn' onClick='editAccount(<?php
        echo $data['cin'].",".$data['loan_id'];
?>)'><i class='icon-edit'></i></button></td>
         <?php
        if ($employee_role == 0) {
?>
        <td><button class='btn' onClick='deleteAccount(<?php
            echo $data['loan_id'];
?>)'><i class='icon-remove'></i></button></td>
         <?php
        }
?>
       </tr>
 <?php
    }
?>
</tbody>
</table>
<!-- end of View customer tab  -->
<?php
} else {
    echo "<h3 align='center'>No Records Found!</h3>";
}
?>
          <script> 
          $('.date-picker').datepicker();  
$(data).ready( function () {
    $('#accountsTable').DataTable();
} );


     </script> 