 <?php require_once("class/db.class.php");
 	$employeeId=$_GET['employeeId'];
	$sql = "SELECT * FROM `employees` WHERE `employee_id`=".$employeeId;
	$result=mysqli_query($CON, $sql);
	$data=mysqli_fetch_array($result);
  if ($data['employee_role']=='1') {
    $flag1='selected';
    $flag2='';
  }else
  {
    $flag1='';
    $flag2='selected';
  }
?>
 <!-- start of create employee tab  -->
 <button onClick="display('class/viewemployees.class.php?p=0');" class="btn" ><i class="icon-circle-arrow-left"></i>back</button>
              <form class="form-horizontal">
                <div class="control-group">
                <label class="control-label" for="employeename">employeename</label>
                	<div class="controls">
                	<input type="text" id="employeename"  name="employeename" readonly value="<?php echo $data['employeename'];?>"/>
                    </div>
  				</div>
                <div class="control-group">
                <label class="control-label" for="password">New Password</label>
                	<div class="controls">
                	<input type="password" id="password"  name="password" placeholder="********"/>
                    </div>
  				</div>
                <div class="control-group">
                <label class="control-label" for="repassword">Retype-Password</label>
                	<div class="controls">
                	<input type="password" id="repassword"  name="repassword" placeholder="********"/>
                    </div>
  				</div>
                  <?php if( $data['employeename']!='root'){

                  echo "<div class='control-group'>
                      <input type='hidden' id='hid_role'  name='hid_role' placeholder='********'/>
                  <label class='control-label' for='role'>Role</label>
                    <div class='controls'>
                    <select name='role' id='role' >
                        <option value='1' $flag1>Administrator</option>
                        <option value='2' $flag2>Employee</option>
                    </select>
                    </div>
          </div>";
          }
          ?>
                  <div class="control-group">
                    <div class="controls">
                      <input type="button" name="eemployee" value="submit" class="btn" onClick="updateemployee(<?php echo $_GET['employeeId'];?>)">
                    </div>
                  </div>
              </form>
          <!-- end of create employee tab  -->