<?php
require_once ("db.class.php");

if (isset($_GET['loan_id']))
{
	$loan_id = $_GET['loan_id'];
	$sql = "SELECT l.*, c.customer_first_name,c.customer_last_name FROM loans l, customers c WHERE l.cin=c.cin AND l.loan_id=".$loan_id;
	$result = mysqli_query($CON, $sql);
	$data = mysqli_fetch_array($result);
	$loan_duration = $data['loan_duration'];
	$loan_type = $data['loan_type'];
	$loan_amount=$data['loan_amount'];
	$roi=$data['loan_roi'];
	$custormer_name=$data['customer_first_name'] . " " . $data['customer_last_name'];
	$commission=$data['commission'];
	$guarantor=$data['guarantor'];
  $sql = "SELECT SUM(txn_amount) FROM `transactions` WHERE loan_id='$loan_id '";
$result = mysqli_query($CON, $sql);
$paid = mysqli_fetch_array($result);
}

if ($loan_type == 0)
{
	$loan_type = 'Daily Finance';
}
else
if ($loan_type == 1)
{
	$loan_type = 'Weekly Finance';
}
else
{
	$loan_type = 'Monthly Finance';
}
?>

<div class="span6"  id="txn_print">
   <button onClick="display('class/viewaccounts.class.php?p=0');" class="btn"><i class="icon-circle-arrow-left"></i>back</button>
  <button onclick="printer()" class="btn"><i class="icon-print"></i>Print</button>
  <button onclick="transactions(<?php echo $loan_id;?>)" class="btn"><i class="icon-print"></i>Reload</button>
<table class='table table-bordered'>
              <tbody>
                <tr>
                  <th>Loan Type</th>
                  <td id='show_loanType'><?php echo $loan_type; ?></td>
                  <th>Customer Name</th>
                  <td id='show_cin'><?php echo $custormer_name; ?></td>
                </tr>
                <tr>
                  <th>Loan amount</th>
                  <td id='show_loanAmount'><?php echo $loan_amount; ?></td>
                  <th>Loan duration</th>
                  <td id='show_loanDuration'><?php echo $loan_duration; ?> </td>
                </tr>
                <tr>
                  <th>rate of interest</th>
                  <td id='show_roi'><?php echo $roi; ?> %</td>
                  <th>To pay Amount</th>
                  <td id='show_payAmount'><?php
                  $toPay = $loan_amount - ($loan_amount * ($roi / 100));
echo $toPay; ?></td>
                </tr>
                <tr>
                  <th>Pending balance</th>
                  <td id='pending'><?php echo $loan_amount- $paid[0];?></td>
                  <th>Emi</th>
                  <td id='emi'><?php echo $loan_amount/$loan_duration; ?></td>
                </tr>
                <tr>
                  <th>Gurantor name</th>
                  <td id='Gurantor'><?php echo $guarantor; ?></td>
                  <th>commission</th>
                  <td id='emi'><?php echo $commission; ?> %</td>
                </tr>
                </tbody>
            </table>
<div id='transactions
'>
             <table class='table table-bordered'>
  
  <tbody>

<?php
$loan_duration = $data['loan_duration'];
$loan_type = $data['loan_type'];

if ($loan_type == 0)
{
  $loan_type = 'day';
}
else
if ($loan_type == 1)
{
  $loan_type = 'week';
}
else
{
  $loan_type = 'month';
}

$sql = "SELECT * FROM `transactions` WHERE loan_id='$loan_id '";
$result = mysqli_query($CON, $sql);

while ($txn_list = mysqli_fetch_array($result))
  {
    $date = date('d-m-Y', strtotime($txn_list['txn_date']));
    echo "<tr>
    <th>
      <label for='date'>" . $date . "</label>
      </th>
            <td colspan='3' id='show_roi'>
                  <input type='number' id='" . $txn_list['txn_id'] . "' required name='collectionAmount' maxlength='5' placeholder='enter collection amount' onblur='updateTransaction(" . $txn_list['txn_id'] . ");' 
                  value=". $txn_list['txn_amount'] . " onKeyPress='charChk(event,'num');' />
            </td>
         </tr>";
    $date = date('d-m-Y', strtotime($date . ' +1 ' . $loan_type));
  }

?>
  </tbody>
</table>
</div>

