<style>
    .font_msg{
        color:red;
    }
</style>
<?php 
$utility = array('1' => 'Company', '2' => 'Personal');
if(count($employeedetails) > 0){ ?>
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

										<div class="col-md-6">
											<div class="form-group">
												<label>Mobile Type:</label>
													<select class="select2 form-control" name="mobiletype" id="mobiletype">
													    <option value=''>Select Type</option>
														<?php foreach ($utility as $keys => $values) {
															if($keys == $employeedetails[0]->mxemp_emp_lg_mobile_type){
																$sel = "selected";
															}else{
																$sel = "";
															}?>
															<option value="<?php echo $keys ?>" <?php echo $sel ?>><?php echo $values ?></option>
														<?php } ?>

													</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Mobile No:</label>
												<input type="text" name="mobileno" id="mobileno" class="form-control datetimepicker" value="<?php  echo $employeedetails[0]->mxemp_emp_lg_mobile_no; ?>" required="">
												<span class="formerror" id="mobilenoerror"></span>
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
														if($employeedetails[0]->mxemp_emp_lg_app_role == $value->maxuser_roles_id){
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
												<label>Mobile Login Permission Status:</label>
													<select class="select2 form-control" name="lgstatus" id="lgstatus">
														<?php foreach ($status as $key => $value) {
															if($key == $employeedetails[0]->mxemp_emp_lg_app_permissions){
																$sel = "selected";
															}else{
																$sel = "";
															}?>
															<option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
														<?php } ?>

													</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Email ID:</label>
												<input type="text" name="email" id="email" class="form-control datetimepicker" value="<?php  echo $employeedetails[0]->mxemp_emp_lg_email; ?>" required="">
												<span class="formerror" id="emailerror"></span>
											</div>
										</div>

									</div>
								</div>
							<div class="table-responsive">
								<table class="table table-striped custom-table">
									<thead>
									    <tr class="text-center"> Mobile Permissions</tr>
										<tr>
											<td>Facial Scan</td>
											<td>
											<input name="display_facialscan" id="display_facialscan" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_lg_app_facialscan == 1){ echo 'checked';} ?>>
											</td>
											<td></td>
										</tr>
										<tr>
											<td>Auto Sync Punch</td>
											<td>
											<input name="display_sync_punches" id="display_sync_punches" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_lg_app_sync_punches  == 1){ echo 'checked';} ?>>
											</td>
											<td></td>
										</tr>
										<tr>
											<td>Logout</td>
											<td>
											<input name="display_logout" id="display_logout" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_lg_app_is_logout  == 1){ echo 'checked';} ?>>
											</td>
											<td class="font_msg">(Will enabled when checked)</td>
										</tr>
										<tr>
											<td>Resignation</td>
											<td>
											<input name="display_resigned" id="display_resigned" value="1" type="checkbox" <?php if($employeedetails[0]->mxemp_emp_lg_app_is_resigned  == 1){ echo 'checked';} ?>>
											</td>
											<td class="font_msg">(check hear when employee got resigned)</td>
										</tr>
										<tr>
											<td>Mobile Device ID</td>
											<td>
											<input class="form-control" name="deviceid" id="deviceid" type="text" value="<?php echo $employeedetails[0]->mxemp_emp_lg_device_id ?>">
											</td>
											<td class="font_msg">(This locks only for one device)</td>
										</tr>
										<tr>
											<td>Mobile FCM Device ID</td>
											<td>
											<input class="form-control" name="fcmid" id="fcmid" type="text" value="<?php echo $employeedetails[0]->mxemp_emp_lg_fcm_id ?>">
											</td>
											<td class="font_msg">(This locks only for one fcmid)</td>
										</tr>
										<tr>
											<td>Assign Leave Type</td>
											<td>
												<select class="select select2" multiple style="width: 100%" name="leave_types" id="leave_types"> 
                									<option value="">Select Leave types</option>
                									<?php 
                									$assignedlv = explode(",",$employeedetails[0]->mxemp_leavetypes);
                									$leavetypes = getallleavetypescompanywise($employeedetails[0]->mxemp_emp_comp_code);
                									foreach($leavetypes as $key => $val){
                									    if(in_array($val->mxlt_leave_short_name,$assignedlv)){ $sel= 'selected';}else{ $sel= '';}
                									?>
                									<option value="<?php echo $val->mxlt_leave_short_name ?>" <?php echo $sel; ?>><?php echo $val->mxlt_leave_short_name ?></option>
                									<?php } ?>
                								</select>
											</td>
											<td class="font_msg">(Employees leave drop down will show these data)</td>
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

var display_facialscan = 0;
if ($("#display_facialscan").prop("checked")) {
display_facialscan = 1;
}

var display_sync_punches = 0;
if ($("#display_sync_punches").prop("checked")) {
display_sync_punches = 1;
}

var display_logout = 0;
if ($("#display_logout").prop("checked")) {
display_logout = 1;
}

var display_resigned = 0;
if ($("#display_resigned").prop("checked")) {
display_resigned = 1;
}

var reg = $("#leaves_list").val();

var roles = $("#roles").val();
var lgstatus = $("#lgstatus").val();
var uniqueid = $("#uniqueid").val();

var mobiletype = $("#mobiletype").val();
var mobileno = $("#mobileno").val();
var email = $("#email").val();

var deviceid = $("#deviceid").val();
var fcmid = $("#fcmid").val();
var leave_types = $("#leave_types").val();

    $.ajax({
      url: baseurl + 'mobile_Permissions/mobile_updateemployeelgdetails',
      type: 'POST',
      data: { employeeid: employeecode, employeepassword : password, employeerole : roles, employeeloginstatus : lgstatus, empid : uniqueid, mobiletype : mobiletype, mobileno : mobileno, email : email, facial_scan : display_facialscan, syncpunches : display_sync_punches, display_logout: display_logout, deviceid : deviceid, fcmid : fcmid, resigned : display_resigned,leave_types:leave_types },
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