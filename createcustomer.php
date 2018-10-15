<?php session_start();
require_once ("class/db.class.php");

?>          <!-- start of Create customer tab  -->
             <form class="form-horizontal">
             <div class="control-group">
                <label class="control-label" for="first_name">First name</label>
                <div class="controls">
                <input type="text" required name="first_name" id="firstname" placeholder="Enter first name" onKeyPress="charChk(event,'name');" />
                </div>
              </div>
             <div class="control-group">
                <label class="control-label" for="last_name">Last name</label>
                <div class="controls">
                <input type="text" required name="last_name" id="lastname" placeholder="Enter last name" onKeyPress="charChk(event,'alpha');" />
                </div>
              </div>
             <div class="control-group">
                <label class="control-label" for="gender">Gender</label>
                <div class="controls">
                <label class="pull-left" for="genderM"><input type="radio" name="gender" id="genderM" value="1" checked /> Male</label>
                <label class="pull-left" for="genderF"><input type="radio" name="gender" id="genderF" value="0" /> Female</label>
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="age">Age</label>
                <div class="controls">
                <input type='text' name='age' id='age' placeholder='age' maxlength="2" onKeyPress="charChk(event,'num');"/>
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="occupation">Occupation</label>
                <div class="controls">
                <input type="text" required name="occupation" id="occupation" placeholder="Enter occupation" onKeyPress="charChk(event,'name');" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="mobile">Mobile</label>
                <div class="controls">
                <input type='text' name='mobile' id='mobile' placeholder='Enter mobile number' maxlength="10" onKeyPress="charChk(event,'num');"/>
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="altMobile">Alternate Mobile</label>
                <div class="controls">
                <input type='text' name='altMobile' id='altMobile' placeholder='Enter alter mobile number' maxlength="10" onKeyPress="charChk(event,'num');"/>
                </div>
             </div>
             <div class="control-group">
                <label class="control-label" for="aadhar">Aadhar Number</label>
                <div class="controls">
                <input type='text' name='aadhar' id='aadhar' placeholder='Enter aadhar number' maxlength="12" onKeyPress="charChk(event,'num');"/>
                </div>
             </div>
              <div class="control-group">
                <label class="control-label" for="city">city</label>
                    <div class='controls'>
                        <select name="city" id="city" onblur="getState();">
                  <?php
$sql = "SELECT * FROM `geo_locations` WHERE location_type='subdistrict' ORDER BY name";
$result = mysqli_query($CON, $sql);

while ($city = mysqli_fetch_array($result))
{
     if ($city['id']=='5589'){
    $flag='selected';
  }else{$flag='';}
  echo " <option value='" . $city['id'] . "' $flag >" . $city['name'] . "</option>";
}

?>"
                        </select>
                    </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="phone">District</label>
                    <div class='controls'>
                        <select name="district" id="district" >
                  <?php
$sql = "SELECT * FROM `geo_locations` WHERE location_type='district' ORDER BY name";
$result = mysqli_query($CON, $sql);

while ($dist = mysqli_fetch_array($result))
{
     if ($dist['id']=='570'){
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
   if ($state['id']=='2'){
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
                <textarea type="text" name="address" rows="4" id="address" placeholder="Enter address" > </textarea>
                </div>
              </div>
               <div class="control-group">
                    <div class="controls">
                      <input type="button" class="btn btn-inverse" onClick="createCustomer()" value="Submit">
                    </div>
                  </div>
              </form>
          <!-- end of Create customer tab  -->