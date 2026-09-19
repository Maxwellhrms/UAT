<?php if(count($employeedetails) > 0){ ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Employee Name : <?php echo $employeedetails[0]->mxemp_emp_lg_fullname ?></h4>
							<div class="text-right">
								<button type="button" class="btn btn-primary" id="processlogindetails">Update Details</button>
							</div>
					</div>
					<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
						<input type="hidden" name="uniqueid" id="uniqueid" value="<?php echo $employeedetails[0]->mxemp_emp_lg_id ?>">
										<div class="col-md-6">
											<div class="form-group">
												<label>Employee ID:</label>
												<input type="text" name="employeecode" id="employeecode" class="form-control datetimepicker" value="<?php  echo $employeedetails[0]->mxemp_emp_lg_employee_id; ?>" readonly="">
												<span class="formerror" id="employeecodeerror"></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Password:</label>
												<input type="text" name="password" id="password" class="form-control datetimepicker" value="<?php  echo $employeedetails[0]->mxemp_emp_lg_password; ?>" required="">
												<span class="formerror" id="passworderror"></span>
											</div>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Role Type:</label>
													<select class="select2 form-control" name="roles" id="roles">
													<option value="0">Select Roles</option> 
													<?php foreach ($alluserroles as $key => $value) {
														if($employeedetails[0]->mxemp_emp_lg_role == $value->maxuser_roles_id){
															$sel = "selected";
														}else{
															$sel = "";
														}
													 ?>
														<option value="<?php echo $value->maxuser_roles_id ?>" <?php echo $sel ?> ><?php echo $value->maxuser_roles_name ?></option>
													<?php } ?>
													</select>
											</div>
										</div>

										<?php 
											$status = array(" " =>"Select Status", "1" => "ACTIVE", "0" => "INACTIVE");
										?>
										<div class="col-md-6">
											<div class="form-group">
												<label>Login Permission Status:</label>
													<select class="select2 form-control" name="lgstatus" id="lgstatus">
														<?php foreach ($status as $key => $value) {
															if($key == $employeedetails[0]->mxemp_emp_lg_desktop_permissions){
																$sel = "selected";
															}else{
																$sel = "";
															}?>
															<option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
														<?php } ?>

													</select>
											</div>
										</div>

									</div>
								</div>
									<div class="table-responsive">
								<table class="table table-striped custom-table">
									<thead>
									    <tr class="text-center"> Permissions</tr>
									    <tr>
											<th>Login To Hr Admin Portal</th>
											<th>
											<input name="mxemp_is_hr" id="mxemp_is_hr" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_is_hr  == 1){ echo 'checked';} ?>>
											</th>
										</tr>
										<tr>
											<th>Google Location For Admin List</th>
											<th>
											<input name="display_google_map" id="display_google_map" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_google_map  == 1){ echo 'checked';} ?>>
											</th>
										</tr>
										<tr>
											<th>Display in the Branch</th>
											<th>
											<input name="display_user_branch" id="display_user_branch" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_inbranch  == 1){ echo 'checked';} ?>>
											</th>
											<th>
												<select class="select select2" multiple style="width: 100%" name="custom_branch" id="custom_branch"> 
                									<!--<option value="">Select Branches</option>-->
                									<?php 
                									$assignedbr = explode(",",$employeedetails[0]->mxemp_emp_custom_branch);
                									foreach($branchlist as $key => $val){
                									    if(in_array($val->mxb_id,$assignedbr)){ $sel= 'selected';}else{ $sel= '';}
                									?>
                									<option value="<?php echo $val->mxb_id ?>" <?php echo $sel; ?>><?php echo $val->mxb_name ?></option>
                									<?php } ?>
                								</select>
											</th>
											<th class="font_msg">(Employees state Branches only visible)</th>
										</tr>
									</thead>
								</table>
							</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<script>
$('#processlogindetails').click(function (e) {
	e.preventDefault();

var employeecode = $("#employeecode").val();

if(employeecode == ""){
	alert("Please Enter Employee Code");
	return false;
}

var password = $("#password").val();

if(password == ""){
	alert("Please Enter Employee Password To Login");
	return false;
}

var mxemp_is_hr = 0;
if ($("#mxemp_is_hr").prop("checked")) {
mxemp_is_hr = 1;
}

var display_google_map = 0;
if ($("#display_google_map").prop("checked")) {
display_google_map = 1;
}

var mxemp_emp_inbranch = 0;
if ($("#display_user_branch").prop("checked")) {
mxemp_emp_inbranch = 1;
}

var roles = $("#roles").val();
var lgstatus = $("#lgstatus").val();
var uniqueid = $("#uniqueid").val();

var custom_branch = $("#custom_branch").val();
    $.ajax({
      url: baseurl + 'Permissions/updateemployeelgdetails',
      type: 'POST',
      data: { employeeid: employeecode, employeepassword : password, employeerole : roles, employeeloginstatus : lgstatus, empid : uniqueid, google_map_locations :  display_google_map, mxemp_emp_inbranch : mxemp_emp_inbranch, custom_branch : custom_branch, mxemp_is_hr : mxemp_is_hr },
      success: function (data) {
      	// console.log(data);
      if (data == 200) {
        alert('Successfully Updated');
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }else {
        alert('Failed To Save Please TryAgain later');
      }
      },
    });
});
</script>
<?php }else{
	echo '<h2 style="color:red">INVALID EMPLOYEE CODE</h2>';
} ?>
<script>
	$(function() {
		$('.select2').select2({dropdownAutoWidth: 'true',width: 'auto'});
	})
</script>