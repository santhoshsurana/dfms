<?php

require_once ("class/db.class.php");

$sql = "SELECT cin, customer_first_name, customer_last_name FROM customers ORDER BY customer_since DESC";
$conn=new dbConnect; 
$result = $conn->db($sql);
?>
<!-- start of Create test tab  -->
    <div class='row-fluid'>
    <div class='span4'>
             <form class='form-horizontal'>
             <div class='control-group'>
                	<label class='control-label' for='loan_type'>Loan Type</label>
                    <div class='controls'>
                    <select name='loan_type' id='loan_type' onblur="hideMonth();" >
                    <option value='0' >Daily</option>
                    <option value='1' >Weekly</option>
                    <option value='2' >Monthly</option> 
                    </select>
                    </div>
  				</div>
                
             <div class='control-group'>
                	<label class='control-label' for='cin'>Customer name</label>
                    <div class='controls'>
                    
                    <select name='cin' id='cin' >
                    <option value='0' selected>-- Select customer --</option>
                    <?php

while ($data = mysqli_fetch_array($result))
	{
	echo "
                        <option value='" . $data['cin'] . "'>"  .$data['customer_first_name'] . " " . $data['customer_last_name'] . "-" . $data['cin'] . "</option>
                        ";
	}

?>
                    </select>
                    </div>
  				</div>
                <div class='control-group'>
                <label class='control-label' for='loan_amount'>Loan amount</label>
                	<div class='controls'>
                	<input type='text' id='loan_amount' required name='loan_amount' maxlength="9" placeholder='enter loan amount'   onKeyPress="charChk(event,'num');"/>
                    </div>
  				</div>
                <div class='control-group' id="loanDurGr">
                <label class='control-label' for='loan_duration'>Loan Duration</label>
                	<div class='controls'>
                	<input type='text' id='loan_duration' required name='loan_duration' maxlength="3" placeholder='enter loan duration'   onKeyPress="charChk(event,'num');"/>
                    </div>
  				</div>
                      <div class='control-group' id="loanEmiGr">
                <label class='control-label' for='emi_start_date'>EMI start date</label>
                  <div class='controls'>
                  <input name="emi_start_date" id="emi_start_date" class="date-picker pull-left" type="text" value="<?php echo date('m/d/Y'); ?>" />
                    </div>
          </div>
                <div class='control-group'>
                <label class='control-label' for='roi'>Rate of Interest</label>
                	<div class='controls'>
                	<input type='text' id='roi' required name='roi' maxlength="5" placeholder='enter rate of interest'  onKeyPress="charChk(event,'dec');"/>
                    </div>
  				</div>
                <div class='control-group'>
                <label class='control-label' for='guarantor'>guarantor</label>
                	<div class='controls'>
                	<input type='text' id='guarantor' required name='guarantor' value="None"  placeholder='enter guarantor name'  onKeyPress="charChk(event,'alpha');"/>
                    </div>
  				</div>
                  <div class='control-group'>
                <label class='control-label' for='commission'>commission</label>
                	<div class='controls'>
                	<input type='text' id='commission' required name='commission' maxlength="5" value="0" placeholder='enter commission'  onKeyPress="charChk(event,'dec');"/>
                    </div>
  				</div>
                <div class='control-group'>
                    <div class='controls'>
                      <input class="btn btn-inverse" type='button' value='submit' onClick='createAccount()'>
                    </div>
                  </div>
              </form>
          <!-- end of Create test tab  -->
</div>

    </div>

    <script>$('.date-picker').datepicker(); </script> 


