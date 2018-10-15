 <?php require_once("class/db.class.php");
 	$cin=$_GET['cin'];
	$sql = "SELECT c.*, g1.name as city, g2.name as district, g3.name as state FROM customers c INNER JOIN geo_locations g1 ON g1.id=c.customer_city INNER JOIN geo_locations g2 ON g2.id=c.customer_distrct INNER JOIN geo_locations g3 ON g3.id=c.customer_state
WHERE `cin`=$cin";
	$result=mysqli_query($CON, $sql);
	$data=mysqli_fetch_array($result);
?>

<button onClick="display('class/viewcustomers.class.php?p=0');" class="btn"><i class="icon-circle-arrow-left"></i>Back</button>
<!-- start of Create customer tab  -->
<form class="form-horizontal">
             <div class="control-group">
              	<label class="control-label" for="first_name">First name</label>
                <div class="controls">
                <input type="text" required name="first_name" id="firstname" placeholder="Enter first name" onKeyPress="charChk(event,'name');" value="<?php echo $data['customer_first_name']; ?>" />
                </div>
              </div>
             <div class="control-group">
                <label class="control-label" for="last_name">Last name</label>
                <div class="controls">
                <input type="text" required name="last_name" id="lastname" placeholder="Enter last name" onKeyPress="charChk(event,'alpha');" value="<?php echo $data['customer_last_name']; ?>" />
                </div>
              </div>
             <div class="control-group">
              	<label class="control-label" for="gender">Gender</label>
                <div class="controls">
                <label class="pull-left" for="genderM"><input type="radio" name="gender" id="genderM" value="1" <?php if($data['customer_gender']==1){echo 'checked';} ?> /> Male</label>
                <label class="pull-left" for="genderF"><input type="radio" name="gender" id="genderF" value="0" <?php if($data['customer_gender']==0){echo 'checked';} ?> /> Female</label>
                <input type="hidden" value="<?php echo $data['customer_gender']; ?>" name='gender_val' id='gender_val'>
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="age">Age</label>
                <div class="controls">
                <input type='text' name='age' id='age' placeholder='age' maxlength="2" onKeyPress="charChk(event,'num');"value="<?php echo $data['customer_age']; ?>" />
                </div>
             </div>
             <div class="control-group">
              	<label class="control-label" for="occupation">Occupation</label>
                <div class="controls">
                <input type="text" required name="occupation" id="occupation" placeholder="Enter occupation" onKeyPress="charChk(event,'name');" value="<?php echo $data['customer_occupation']; ?>" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="mobile">Mobile</label>
                <div class="controls">
                <input type='text' name='mobile' id='mobile' placeholder='Enter mobile number' maxlength="10" onKeyPress="charChk(event,'num');"value="<?php echo $data['customer_mobile']; ?>" />
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="altMobile">Alternate Mobile</label>
                <div class="controls">
                <input type='text' name='altMobile' id='altMobile' placeholder='Enter alter mobile number' maxlength="10" onKeyPress="charChk(event,'num');"value="<?php echo $data['customer_altmobile']; ?>" />
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="aadhar">Aadhar Number</label>
                <div class="controls">
                <input type='text' name='aadhar' id='aadhar' placeholder='Enter aadhar number' maxlength="12" onKeyPress="charChk(event,'num');" value="<?php echo $data['customer_aadhar']; ?>" />
                </div>
             </div>
              <div class="control-group">
                <label class="control-label" for="city">city</label>
                    <div class='controls'>
                        <select name="city" id="city" onblur="getState();" >
                  <?php
$sql = "SELECT * FROM `geo_locations` WHERE location_type='subdistrict' ORDER BY name";
$result = mysqli_query($CON, $sql);

while ($city = mysqli_fetch_array($result))
{
  if ($city['id']==$data['customer_city']){
    $flag='selected';
  }else{$flag='';}
  echo " <option value='" . $city['id'] . "' $flag  >" . $city['name'] . "</option>";
}

?>"
                        </select>
                    </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="district">District</label>
                    <div class='controls'>
                        <select name="district" id="district" >
                  <?php
                  
$sql = "SELECT * FROM `geo_locations` WHERE location_type='district' ORDER BY name";
$result = mysqli_query($CON, $sql);


while ($dist = mysqli_fetch_array($result))
{
    if ($dist['id']==$data['customer_distrct']){
    $flag='selected';
  }else{$flag='';}
  echo " <option value='" . $dist['id'] . "' $flag >" . $dist['name'] . "</option>";
}

?>"
                        </select>
                    </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="phone">state</label>
                <div class='controls'>
                        <select name="state" id="state"  >
                  <?php
$sql = "SELECT * FROM `geo_locations` WHERE location_type='state' ORDER BY name";
$result = mysqli_query($CON, $sql);

while ($state = mysqli_fetch_array($result))
{
    if ($state['id']==$data['customer_state']){
    $flag='selected';
  }else{$flag='';}
  echo " <option value='" . $state['id'] . "' $flag >" . $state['name'] . "</option>";
}

?>"
                        </select>
                    </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="address">Address</label>
                <div class="controls">
                <textarea type="text" name="address" rows="4" id="address" placeholder="Enter address" ><?php echo $data['customer_address']; ?> </textarea>
                </div>
              </div>
               <div class="control-group">
                    <div class="controls">
                      <input type="button" class="btn" onClick="updateCustomer(<?php echo $cin; ?>);" value="Submit">
                    </div>
                  </div>
              </form>
          <!-- end of Create customer tab  -->
