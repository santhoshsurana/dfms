<?php session_start();
require_once("db.class.php");
$employee_role    = $_SESSION['employee_role'];
if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $from_date = $_GET['fromDate'];
    $to_date   = $_GET['toDate'];
} else {
    $from_date = date('m/d/Y');
    $from_date = date('m/d/Y', strtotime($from_date . ' -1 month'));
    $to_date   = date('m/d/Y');
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
<button onClick="ViewResults('class/viewcustomers.class.php?');" style="margin:0px 5px;" class="btn btn-inverse">Results</button>
</dir>
<?php

$sql        = "SELECT c.*, g1.name as city, g2.name as district, g3.name as state FROM customers c INNER JOIN geo_locations g1 ON g1.id=c.customer_city INNER JOIN geo_locations g2 ON g2.id=c.customer_distrct INNER JOIN geo_locations g3 ON g3.id=c.customer_state
WHERE `customer_since` BETWEEN " . $from_date_time . " AND " . $to_date_time . " ORDER BY `customer_since` DESC ";

$result     = mysqli_query($CON, $sql);
$page_count = mysqli_num_rows($result);
if ($page_count != 0) {
?>
 <dir class="row-fluid"><h3>customers List</h3></dir>
<!-- start of View customer tab  -->
              <table class='table table-hover table-bordered' id="customerTable">
              <thead>
                  <tr>
                    <th>customer ID</th>
                    <th>customer Name</th>
                    <th>Age</th>
                    <th>Gender</th>
					<th>Occupation</th>
                    <th>mobile number</th>
                    <th>alternate mobile number</th>
					<th>Aadhar Number</th>
                    <th>Address</th>
                    <th>customer since</th>
                    <th>New Account</th>
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
        if ($data['customer_gender'] == 1) {
            $data['customer_gender'] = "male";
        } elseif ($data['customer_gender'] == 0) {
            $data['customer_gender'] = "female";
        }
        $data['customer_since'] = date("d-m-Y h:i:a", strtotime($data['customer_since']));
?>
       <tr>
         <td><?php
        echo $data['cin'];
?></td>    
         <td><?php
        echo $data['customer_first_name'];
?> <?php
        echo $data['customer_last_name'];
?></td>
         <td><?php
        echo $data['customer_age'];
?></td>
         <td><?php
        echo $data['customer_gender'];
?></td>
         <td><?php
        echo $data['customer_occupation'];
?></td>
		<td><?php
        echo $data['customer_mobile'];
?></td>
         <td><?php
        echo $data['customer_altmobile'];
?></td>
         <td><?php
        echo $data['customer_aadhar'];
?></td>
		<td><?php
        echo $data['customer_address'].', '.$data['city'].', '.$data['district'].', '.$data['state'];
?></td>
		<td><?php
        echo $data['customer_since'];
?></td>
         <td><button class='btn' onClick='showAccount(<?php
        echo $data['cin'];
?>)'><i class='icon-list-alt'></i></button></td>
         <td><button class='btn' onClick='editCustomer(<?php
        echo $data['cin'];
?>)'><i class='icon-edit'></i></button></td>
         <?php
        if ($employee_role == 0) {
?>
        <td><button class='btn' onClick='deleteCustomer(<?php
            echo $data['cin'];
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
    echo "<dir class='row-fluid'><h3 align='center'>No Records Found!</h3></div>";
}
?>

          <script> 
          $('.date-picker').datepicker();  
$(data).ready( function () {
    $('#customerTable').DataTable();
} );


     </script> 