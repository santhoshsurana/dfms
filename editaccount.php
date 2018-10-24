<?php
require_once ("class/db.class.php");

$cin = $_GET['cin'];
$loan_id = $_GET['loan_id'];
$sql = "SELECT l.*, c.customer_first_name,c.customer_last_name FROM loans l, customers c WHERE l.cin=c.cin AND l.loan_id=" . $loan_id;
$result = $conn->db($sql);
$data = mysqli_fetch_array($result);
$sql = "SELECT SUM(txn_amount) FROM `transactions` WHERE loan_id='$loan_id '";
$result = $conn->db($sql);
$paid = mysqli_fetch_array($result);
$data['loan_date']= date("m/d/Y", strtotime($data['loan_date']));
?>
<!-- start of Create test tab  -->
    <div class='row-fluid'>
    <div class='span4'>

            <button onClick="display('class/viewaccounts.class.php?p=0');" class="btn"><i class="icon-circle-arrow-left"></i>back</button>
            <button onClick="editAccount(<?php echo $cin.",".$loan_id;?>)" class="btn"><i class="icon-refresh"></i>Reload</button>
             <form class='form-horizontal'>
             <div class='control-group'>
                  <label class='control-label' for='loan_type'>Loan Type</label>
                    <div class='controls'>
                    <select name='loan_type' id='loan_type' disabled="disabled" onblur="showEMI();" >
                    <option value='0' >Daily</option>
                    <option value='1' >Weekly</option>
                    <option value='2' >Monthly</option> 
                    </select>
                    <input type="hidden"  id="temp_loan_type" value="<?php
echo $data['loan_type']; ?>">
                    </div>
          </div>
                
             <div class='control-group'>
                  <label class='control-label' for='cin'>Customer name</label>
                    <div class='controls'>
                    
                    <select name='cin' disabled="disabled" id='cin' onblur="showEMI();">
                    <?php
echo "
                        <option selected value='" . $data['cin'] . "'>" . $data['customer_first_name'] . " " . $data['customer_last_name'] . "-" . $cin . "</option>
                        ";
?>
                    </select>
                    </div>
          </div>
                <div class='control-group'>
                <label class='control-label' for='loan_amount'>Loan amount</label>
                  <div class='controls'>
                  <input type='text' id='loan_amount' required name='loan_amount' maxlength="9" placeholder='enter loan amount' onblur="showEMI();"  onKeyPress="charChk(event,'num');" value="<?php
echo $data['loan_amount'];
?>" />
                    </div>
          </div>
                <div class='control-group'>
                <label class='control-label' for='loan_duration'>Loan Duration</label>
                  <div class='controls'>
                  <input type='text' id='loan_duration' required readonly name='loan_duration' maxlength="3" placeholder='enter loan duration' onblur="showEMI();" onKeyPress="charChk(event,'num');" value="<?php
echo $data['loan_duration'];
?>" />
                    </div>
          </div>
                 <div class='control-group'>
                <label class='control-label' for='emi_start_date'>EMI start date</label>
                  <div class='controls'>
                  <input name="emi_start_date" readonly id="emi_start_date" class="date-picker pull-left" type="text" value="<?php echo $data['loan_date']; ?>" />
                    </div>
                  </div>
                <div class='control-group'>
                <label class='control-label' for='roi'>Rate of Interest</label>
                  <div class='controls'>
                  <input type='text' id='roi' required name='roi' maxlength="5" placeholder='enter rate of interest' onblur="showEMI();" onKeyPress="charChk(event,'dec');" value="<?php
echo $data['loan_roi'];
?>" />
                    </div>
          </div>
                <div class='control-group'>
                <label class='control-label' for='guarantor'>guarantor</label>
                  <div class='controls'>
                  <input type='text' id='guarantor' required name='guarantor'  placeholder='enter guarantor name' onblur="showEMI();" onKeyPress="charChk(event,'alpha');" value="<?php
echo $data['guarantor'];
?>" />
                    </div>
          </div>
                  <div class='control-group'>
                <label class='control-label' for='commission'>commission</label>
                  <div class='controls'>
                  <input type='text' id='commission' required name='commission' maxlength="5" placeholder='enter commission' onblur="showEMI();" onKeyPress="charChk(event,'dec');" value="<?php
echo $data['commission'];
?>" />
                    </div>
          </div>
                <div class='control-group'>
                    <div class='controls'>
                      <input class='btn' type='button' value='submit' onClick='updateAccount(<?php
echo $data['loan_id'];
?>);'>
                    </div>
                  </div>
              </form>
          <!-- end of Create test tab  -->
</div>
<div class='span6'>


<table class="table table-bordered">
              <tbody>
                <tr>
                  <th>Loan Type</th>
                  <td id="show_loanType"><?php
switch ($data['loan_type'])
{
case 0:
  echo "Daily Finance";
  break;

case 1:
  echo "Weekly Finance";
  break;

case 2:
  echo "Monthly Finance";
  break;
}; ?></td>
                  <th>Customer Name</th>
                  <td id="show_cin"> <?php
echo $data['customer_first_name'] . " " . $data['customer_last_name']; ?> </td>
                </tr>
                <tr>
                  <th>Loan amount</th>
                  <td id="show_loanAmount"><?php
echo $data['loan_amount']; ?> </td>
                  <th>Loan duration</th>
                  <td id="show_loanDuration"><?php
echo $data['loan_duration']; ?> </td>
                </tr>
                <tr>
                  <th>rate of interest</th>
                  <td id="show_roi"><?php
echo $data['loan_roi'] . "%"; 
?></td>
                  <th>To pay Amount</th>
                  <td id="show_payAmount"><?php
                  $toPay = $data['loan_amount'] - ($data['loan_amount'] * ($data['loan_roi'] / 100));
echo $toPay; ?></td>
                </tr>
                <tr>
                  <th>Pending balance</th>
                  <td id="pending"><?php
echo $data['loan_amount'] - $paid[0]; ?></td>
                  <th>Emi</th>
                  <td id="emi"><?php
echo $data['loan_amount'] / $data['loan_duration']; ?></td>
                </tr>
                <tr>
                  <th>Gurantor name</th>
                  <td id='Gurantor'><?php
echo $data['guarantor']; ?></td>
                  <th>commission</th>
                  <td id='emi'><?php
echo $data['commission'] ?> %</td>
                </tr>
                </tbody>
            </table>
             <table class="table table-bordered">
  
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
$result = $conn->db($sql);

while ($txn_list = mysqli_fetch_array($result))
  {
    $date = date('d-m-Y', strtotime($txn_list['txn_date']));
    echo "<tr>
    <th>
      <label for='date'>" . $date . "</label>
      </th>
            <td colspan='3' id='show_roi'>
                  <input type='number' id='" . $txn_list['txn_id'] . "' required name='collectionAmount' maxlength='5' placeholder='enter collection amount' onblur='updateTransaction(" . $txn_list['txn_id'] . ");' 
                  value=". $txn_list['txn_amount'] . " onKeyPress='charChk(event,'num');' ></input>
            </td>
         </tr>";
    $date = date('d-m-Y', strtotime($date . ' +1 ' . $loan_type));
  }

?>

  </tbody>
</table>

    </div>
    </div>