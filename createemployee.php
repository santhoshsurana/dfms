 <!-- start of create employee tab  -->
              <form class="form-horizontal">
				<div class="control-group">
              	<label class="control-label" for="employeename">employeename</label>
                    <div class="controls">
                    <input type="text" id="employeename" required name="employeename" placeholder="enter employeename"  onKeyPress="charChk(event,'alpha');"  />
                    </div>
  				</div>	
                <div class="control-group">
                <label class="control-label" for="password">Password</label>
                	<div class="controls">
                	<input type="password" id="password" required name="password" placeholder="********"/>
                    </div>
  				</div>
                <div class="control-group">
                <label class="control-label" for="re-password">Retype-Password</label>
                	<div class="controls">
                	<input type="password" id="repassword" required name="repassword" placeholder="********"/>
                    </div>
  				</div>
                <div class="control-group">
                	<label class="control-label" for="role">Role</label>
                    <div class="controls">
                    <select name="role" id="role" >
                        <option value="1">Administrator</option>
                        <option value="2" selected>Employee</option>
                    </select>
                    </div>
  				</div>
                  <div class="control-group">
                    <div class="controls">
                      <input type="button" name="cemployee" value="submit" class="btn btn-inverse" onClick="createemployee()">
                    </div>
                  </div>
              </form>
          <!-- end of create employee tab  -->