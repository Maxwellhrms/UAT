<!----NEW BY SHABABU-->
<style>
.isDisabled {
cursor: not-allowed;
opacity: 0.5;
}

.isDisabled>a {
color: currentColor;
display: inline-block;
/* For IE11/ MS Edge bug */
pointer-events: none;
text-decoration: none;
}
</style>
<!----END NEW BY SHABABU-->
<!-- Page Wrapper -->
<div class="page-wrapper">
<div class="content container-fluid">

<!-- Page Header -->
<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Edit Employee</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
<li class="breadcrumb-item active">Edit Employee To Your Orgination</li>
</ul>
</div>
</div>
</div>
<!-- /Page Header -->

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">

<div class="row">
<div class="col-xl-6">
<div class="form-group row">
	<label class="col-lg-3 col-form-label">Company Name</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="cmpname" id="cmpname" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_comp_code; ?>"><?php echo $emp['employeeinfo'][0]->mxcp_name ?></option>
		</select>
		<span class="formerror" id="cmpnameerror"></span>
	</div>
</div>
<div class="form-group row">
	<label class="col-lg-3 col-form-label">Division</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="divname" id="divname" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_division_code; ?>"><?php echo $emp['employeeinfo'][0]->mxd_name ?></option>
		</select>
		<span class="formerror" id="divnameerror"></span>
	</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label">State</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="cmpstate" id="cmpstate" style="width:100%">
			<option value="<?php  echo $emp['employeeinfo'][0]->mxemp_emp_state_code . '@~@' . $emp['employeeinfo'][0]->mxst_state ?>"><?php  echo $emp['employeeinfo'][0]->mxst_state ?></option>
		</select>
		<span class="formerror" id="cmpstateerror"></span>
	</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label">Branch</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="brname" id="brname" style="width:100%">
		<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_branch_code; ?>"><?php echo $emp['employeeinfo'][0]->mxb_name ?></option>
		</select>
		<span class="formerror" id="brnameerror"></span>
	</div>
</div>
<div class="form-group row">
	<label class="col-lg-3 col-form-label">Date Of Join</label>
	<div class="col-lg-9">
		<input type="text" class="form-control datetimepicker" name="empdoj" id="empdoj" autocomplete="off" value="<?php echo date('d-m-Y',strtotime($emp['employeeinfo'][0]->mxemp_emp_date_of_join)) ?>" >
		<span class="formerror" id="empdojerror"></span>
	</div>
</div>

<div class="form-group row" style="display:none">
	<label class="col-lg-3 col-form-label">Sub Branch</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="subbrname" id="subbrname" style="width:100%">

		</select>
	</div>
</div>

<div class="form-group row" style="display:none">
	<div class="col-lg-9">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="branchhr" value="1">
			<label class="form-check-label">
				Is Branch HR
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="branchdirector" value="1">
			<label class="form-check-label">
				Is Director
			</label>
		</div>
	</div>
</div>


</div>


<div class="col-xl-6">

<div class="form-group row">
	<label class="col-lg-3 col-form-label">Departements</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="departmentname" id="departmentname" style="width:100%">
		<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_dept_code; ?>"><?php echo $emp['employeeinfo'][0]->mxdpt_name ?></option>
		</select>
		<span class="formerror" id="departmentnameerror"></span>
	</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label">Grade</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="gradename" id="gradename" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_grade_code; ?>"><?php echo $emp['employeeinfo'][0]->mxgrd_name ?></option>
		</select>
		<span class="formerror" id="gradenameerror"></span>
	</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label">Designation</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="designationname" id="designationname" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_desg_code; ?>"><?php echo $emp['employeeinfo'][0]->mxdesg_name ?></option>
		</select>
		<span class="formerror" id="designationnameerror"></span>
	</div>
</div>



<div class="form-group row">
	<label class="col-lg-3 col-form-label">Employee Type</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="emptype" id="emptype" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_type; ?>"><?php echo $emp['employeeinfo'][0]->mxemp_ty_name ?></option>
		</select>
		<span class="formerror" id="emptypeerror"></span>
	</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label">Employee Id</label>
	<div class="col-lg-9">
		<input type="text" class="form-control" name="employeeid" id="employeeid" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>">
	</div>
</div>
<div class="form-group row">
	<label class="col-lg-3 col-form-label">is auditor</label>
	<div class="col-lg-9">
		<select class="form-control select2" name="is_auditor" id="is_auditor" style="width:100%">
			<option value="<?php echo $emp['employeeinfo'][0]->is_auditor; ?>"><?php echo $emp['employeeinfo'][0]->is_auditor ?></option>
			<option value="">select</option>
			<option value="no">no</option>
			<option value="yes">yes</option>
		</select>
	</div>
</div>

</div>

</div>

<script>var is_director = '<?php echo $emp['employeeinfo'][0]->mxdpt_is_director; ?>'</script>
<script>var is_hr = '<?php echo $emp['employeeinfo'][0]->mxdpt_is_hr; ?>'</script>
<ul class="nav nav-tabs nav-tabs-solid nav-justified">
<li class="nav-item"><a class="nav-link active" id="personalinformation" href="#solid-justified-tab1" data-toggle="tab">Personal Information</a></li>
<li class="nav-item"><a class="nav-link" id="familyinformation" href="#solid-justified-tab2" data-toggle="tab">Family Details</a></li>
<li class="nav-item"><a class="nav-link" id="previousempinformation" href="#solid-justified-tab3" data-toggle="tab">Previous Employment</a></li>
<li class="nav-item"><a class="nav-link" id="bankinformation" href="#solid-justified-tab5" data-toggle="tab">Bank & Statutory</a></li>
<li class="nav-item"><a class="nav-link" id="addressinformation" href="#solid-justified-tab4" data-toggle="tab">Address</a></li>
<li class="nav-item"><a class="nav-link" id="refrenceinformation" href="#solid-justified-tab7" data-toggle="tab">Refrence</a></li>
<li class="nav-item"><a class="nav-link <?php echo ($emp['employeeinfo'][0]->mxdpt_is_director == 1)?'isDisabled':''; ?>" id="authorizationinformation" href="<?php echo ($emp['employeeinfo'][0]->mxdpt_is_director == 1)?'#':'#solid-justified-tab8'; ?>" data-toggle="tab">Authorization</a></li>
<li class="nav-item"><a class="nav-link" id="nomineeinformation" href="#solid-justified-tab6" data-toggle="tab">Nominee</a></li>
</ul>

<div class="tab-content">
<!-- Personal Details -->
<div class="tab-pane show active" id="solid-justified-tab1">

<form id="updatepersonaldeatils" method="post">
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title mb-0">Personal Information</h4>
			</div>
			<div class="card-body">
<input type="hidden" name="peremployeeid" id="peremployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>">
<input type="hidden" name="uniqueid" id="uniqueid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>">

				<div class="row">
					<div class="col-xl-6">
					    <div class="form-group row">
							<label class="col-lg-3 col-form-label">Employee Name As Per Aadhar</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="empfname" id="empfname" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fname ?>">
								<span class="formerror" id="empfnameerror"></span>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Employee Name As Per Bank</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="empnameasperbank" id="empnameasperbank" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_nameasperbank ?>">
								<span class="formerror" id="empnameasperbankerror"></span>
							</div>
						</div>
					    
                        <div class="form-group row">
							<label class="col-lg-3 col-form-label">Employee Relation</label>
							<div class="col-lg-9">
								<select class="select2 form-control" name="emprelation" id="emprelation" style="width:100%">
                                <?php echo $controller->display_options('employee_relation',$emp['employeeinfo'][0]->mxemp_emp_relation); ?>
								</select>
								<span class="formerror" id="emprelationerror"></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Employee Relation Person</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="emprelation_name" id="emprelation_name" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_relation_name; ?>">
								<span class="formerror" id="emprelation_nameerror"></span>
							</div>
						</div>

						<div class="form-group row" style="display:none;">
							<label class="col-lg-3 col-form-label">Last Name</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="emplname" id="emplname" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_lname; ?>">
								<span class="formerror" id="emplnameerror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Gender</label>
							<?php 
							if( $emp['employeeinfo'][0]->mxemp_emp_gender =='Male'){
							  $male='checked';
							}else if($emp['employeeinfo'][0]->mxemp_emp_gender =='Female'){
							 $female='checked';
							}
							?>
							<div class="col-lg-9">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="empgender" value="Male" <?php echo $male ?>>
									<label class="form-check-label">
										Male
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="empgender" value="Female" <?php echo $female ?>>
									<label class="form-check-label">
										Female
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Blood Group </label>
							<div class="col-lg-9">
								<select class="select2 form-control" name="empbloodgroup" id="empbloodgroup" style="width:100%">
									<option value="">Select</option>
									<?php foreach($bloodgp as $bgkey => $bgval){ 
									if($bgval == $emp['employeeinfo'][0]->mxemp_emp_bloodgroup ){
										$sel = 'selected';
									  }else{
									   	$sel = ''; 
									} ?>
									<option <?php echo $sel; ?> value="<?php echo $bgval; ?>"><?php echo $bgval; ?></option>
									<?php }?>
								</select>
								<span class="formerror" id="empbloodgrouperror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Mobile</label>
							<div class="col-lg-9">
								<input type="number" class="form-control" name="empmobile" id="empmobile" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_phone_no; ?>">
								<span class="formerror" id="empmobileerror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Alt Mobile</label>
							<div class="col-lg-9">
								<input type="number" class="form-control" name="empaltmobile" id="empaltmobile" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_alt_phn_no ?>">
								<span class="formerror" id="empaltmobileerror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Mother Tongue</label>
							<div class="col-lg-9">
								<select type="text" class="form-control" name="empmtongue" id="empmtongue" autocomplete="off">
								<?php foreach ($language as $keys => $lgmgvalue) {
									if($emp['employeeinfo'][0]->mxemp_emp_mother_tongue == $lgmgvalue){
										$sel = "selected";
									}else{
										$sel = "";
									}
								 ?>
									<option value="<?php echo $lgmgvalue->mxlg_name ?>" <?php echo $sel; ?> ><?php echo $lgmgvalue->mxlg_name ?></option>
								<?php } ?>
								</select>
								<span class="formerror" id="empmtongueerror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Employee Age</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="empage" id="empage" autocomplete="off" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_age; ?>" readonly>
								<span class="formerror" id="empageerror"></span>
							</div>
						</div>
						<div class="form-group row" style="display:none">
							<label class="col-lg-3 col-form-label">Guarantors Details</label>
							<div class="col-lg-9">
								<textarea class="form-control" name="empguarantorsdetails" id="empguarantorsdetails"><?php echo  $emp['employeeinfo'][0]->mxemp_emp_empguarantorsdetails ?></textarea>
								<span class="formerror" id="empguarantorsdetailserror"></span>
							</div>
						</div>
					</div>
					<div class="col-xl-6">

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Image</label>
							<div class="col-lg-9">
								<?php
								if(!empty($emp['employeeinfo'][0]->mxemp_emp_img)){
									$image = $emp['employeeinfo'][0]->mxemp_emp_img;
								}else{
									$image = 'assets/img/160x160.png';
								} ?>
								<img id="blah1" src="<?php echo base_url() . $image ?>" style="width: 160px; height: 160px;">
								<input id="pic" name="file" class='pis' onchange="readURL(this,'img1');" type="file">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Email</label>
							<div class="col-lg-9">
								<input type="email" class="form-control" name="empemail" id="empemail" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_email_id; ?>" autocomplete="off">
								<span class="formerror" id="empemailerror"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Company Email</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="cmp_empemail" id="cmp_empemail" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_company_email_id; ?>" autocomplete="off">
								<span class="formerror" id="cmp_empemailerror"></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Date Of Birth</label>
							<div class="col-lg-9">
								<input type="text" class="form-control datetimepicker" name="empdob" id="empdob" value="<?php echo date('d-m-Y',strtotime($emp['employeeinfo'][0]->mxemp_emp_date_of_birth)); ?>" autocomplete="off">
								<span class="formerror" id="empdoberror"></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Caste</label>
							<div class="col-lg-9">
								<select class="form-control select2" name="empcaste" id="empcaste" style="width:100%">
									<option value="">Select Caste</option>
									<option value="Forward" <?php if($emp['employeeinfo'][0]->mxemp_emp_caste == 'Forward'){ echo 'selected'; }else{ echo '';} ?> >Forward</option>
									<option value="Backward" <?php if($emp['employeeinfo'][0]->mxemp_emp_caste == 'Backward'){ echo 'selected'; }else{ echo '';} ?> >Backward</option>
									<option value="SC" <?php if($emp['employeeinfo'][0]->mxemp_emp_caste == 'SC'){ echo 'selected'; }else{ echo '';} ?> >SC</option>
									<option value="ST" <?php if($emp['employeeinfo'][0]->mxemp_emp_caste == 'ST'){ echo 'selected'; }else{ echo '';} ?>>ST</option>
								</select>
								<span class="formerror" id="empcasteerror"></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Marital</label>
							<div class="col-lg-9">
								<select class="form-control select2 marital" name="empmarital" id="empmarital" style="width:100%">
									<option value="">Select Marital Status</option>
									<option value="Married" <?php if($emp['employeeinfo'][0]->mxemp_emp_marital_status == 'Married'){ echo 'selected'; }else{ echo '';} ?>>Married</option>
									<option value="UnMarried" <?php if($emp['employeeinfo'][0]->mxemp_emp_marital_status == 'UnMarried'){ echo 'selected'; }else{ echo '';} ?>>UnMarried</option>
									<option value="Divorced" <?php if($emp['employeeinfo'][0]->mxemp_emp_marital_status == 'Divorced'){ echo 'selected'; }else{ echo '';} ?>>Divorced</option>
									
								</select>
								<span class="formerror" id="empmaritalerror"></span>
							</div>
						</div>


						<div class="form-group row openmrd" style="display:none">
							<label class="col-lg-3 col-form-label">Marriage Date</label>
							<div class="col-lg-9">
								<input class="form-control datetimepicker" type="text" name="empmaritaldate" id="empmaritaldate" value="<?php echo date('d-m-Y', strtotime($emp['employeeinfo'][0]->empmaritaldate)); ?>">
								<span class="formerror" id="empmaritaldateerror"></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Salary Approved</label>
							<div class="col-lg-9">
								<input type="number" class="form-control" name="empsalary" id="empsalary" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_current_salary; ?>" placeholder="Employee Salary" autocomplete="off">
								<span class="formerror" id="empsalaryerror"></span>
							</div>
						</div>

					</div>
				</div>


				<div class="col-md-12">
					<div class="row">
						<?php
						if($emp['employeeinfo'][0]->mxemp_emp_having_vehicle == 'HAVING VEHICLE'){
							$veh='checked';
						}elseif($emp['employeeinfo'][0]->mxemp_emp_having_vehicle == 'NOT HAVING VEHICLE'){
						   	$noveh='checked';
						} 
						?>
						<div class="col-md-12">
							<div class="form-group">
								<label>Do You Have Vehicle:</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input vechicledetails hvvehicle" type="radio" name="vehicle" value="HAVING VEHICLE" <?php echo $veh; ?> >
									<label class="form-check-label">
										Yes
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input vechicledetails ntvehicle" type="radio" name="vehicle" value="NOT HAVING VEHICLE" <?php echo $noveh; ?> >
									<label class="form-check-label">
										No
									</label>
								</div>
							</div>
						</div>

						<div class="col-md-12 enableifhavingvehicle" style="display: none">
							<div class="form-group">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="wheeler" value="(2) TWO WHEELER" <?php if( $emp['employeeinfo'][0]->mxemp_emp_vehicle_type =='(2) TWO WHEELER'){ echo 'checked';}?> >
									<label class="form-check-label">
										TWO WHEELER
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="wheeler" value="(4) FOUR WHEELER" <?php if( $emp['employeeinfo'][0]->mxemp_emp_vehicle_type =='(4) FOUR WHEELER'){ echo 'checked';}?> >
									<label class="form-check-label">
										FOUR WHEELER
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="wheeler" value="(2 + 4) FOUR WHEELER" <?php if( $emp['employeeinfo'][0]->mxemp_emp_vehicle_type =='(2 + 4) FOUR WHEELER'){ echo 'checked';}?> >
									<label class="form-check-label">
										TWO + FOUR WHEELER
									</label>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">License No</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="emplicense" id="emplicense" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_license; ?>" autocomplete="off">
										<span class="formerror" id="emplicenseerror"></span>
									</div>
								</div>
							</div>
						</div>
						

					</div>
				</div>
<div class="text-right">
	<button type="submit" class="btn btn-info" style="color: #fff;">Update Personal Info</button>
</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- Personal Details -->
<!-------------LANGUAGES---------------->

<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Languages</h4>
			</div>
			<div class="card-body">
				<div class="row">

<div class="col-md-12" class="lang_div" id="lang_div">
<?php $sno=1;
$countlang = count($emp['employeelanaguages']);
foreach($emp['employeelanaguages'] as $key1=>$val1){ ?>
<form id="updatelanguage">
<input type="hidden" name="sid" id="sid" value="<?php echo $val1->mxemp_emp_lng_id  ?>" >
<div class="row divs" id="div_1">
<div class="col-md-3">
<div class="form-group">
<label>Language:</label>
<select class="form-control select2" name="emplanguage" id="emplanguage" style="width:100%">
<?php foreach ($language as $key => $lgvalue) { 
if($lgvalue->mxlg_id == $val1->mxemp_emp_lng ){ ?>
<option selected  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo  $lgvalue->mxlg_name ?></option>
<?php
$speck = $val1->mxemp_emp_lng_speak;
$read = $val1->mxemp_emp_lng_read;
$write = $val1->mxemp_emp_lng_write;	
}else{ ?>
<option  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>
<?php } } ?>
</select>
<span class="formerror" id="emplanguageerror_<?php echo $sno; ?>"></span>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>Speak:</label>
<input class="form-control col-md-2" type="checkbox" <?php if(!empty($speck)){ echo 'checked'; } ?> name="empspeak" id="empspeak" value="1">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Read:</label>
<input class="form-control col-md-2" type="checkbox" <?php if(!empty($read)){ echo 'checked'; } ?> name="empread" id="empread" value="1">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Write:</label>
<input class="form-control col-md-2" type="checkbox" <?php if(!empty($write)){ echo 'checked'; } ?> name="empwrite" id="empwrite" value="1">
</div>
</div>

<div class="col-md-1">
<div class="form-group">
<label>&nbsp;</label>
<!-- <button type="button" id="add_remove_<?php //echo $sno;  ?>"  class="form-control" onclick="delete_btn('<?php //echo $val1->mxemp_emp_lng; ?>','<?php //echo $emp['employeeinfo'][0]->mxemp_emp_id; ?>','<?php //echo $val1->tblangname; ?>')"> <i class="fa fa-close text-danger" ></i></button>   -->
<button type="submit" class="btn btn-info" style="color: #fff;" >Update</button> 
</div>
</div>
</div>
</form>
<?php $sno++; } ?>

<span class="addknlgdetails"></span>
</div>
</div>
	<div class="text-right">
		 <!--<button type="submit" class="btn btn-info" style="color: #fff;" >Update Languages</button> -->
	</div>
</div>
</div>
</div>
</div>
<br>

<!-------------END LANGUAGES---------------->

<!-- Accademic deatils -->
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header text-left">
				<h4 class="card-title mb-0">Academic Records</h4>
			</div>
			
			<div class="card-body">
				<div class="row">
					<form id="updateacademic">
					<div class="col-xl-12">
						<?php foreach($emp['employeeacr'] as $dbacrkey => $dbacrvalue){ 
							//echo $dbacrvalue->mxemp_emp_acr_type;
							?>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>Type:</label>
									<select class="form-control" name="empacrtype[]" id="empacrtype">
										<option value="">Select</option>
										<?php foreach($academy as $ackey => $asvalue){
											if($ackey == $dbacrvalue->mxemp_emp_acr_type){
												$sel = "selected";
											}else{
												$sel = "";
											}
										 ?>
											<option value="<?php echo $ackey ?>" <?php echo $sel; ?> >
												<?php echo $asvalue; ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Year of Passing:</label>
									<input type="text" class="form-control" name="empacryop[]" id="empacryop" value="<?php echo $dbacrvalue->mxemp_emp_acr_yop; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Institution:</label>
									<input type="text" class="form-control" name="empacrinstitution[]" value="<?php echo $dbacrvalue->mxemp_emp_acr_institution; ?>" id="empacrinstitution" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Subject:</label>
									<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" value="<?php echo $dbacrvalue->mxemp_emp_acr_subject; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>University:</label>
									<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" value="<?php echo $dbacrvalue->mxemp_emp_acr_university; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>Marks%:</label>
									<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" value="<?php echo $dbacrvalue->mxemp_emp_acr_marks; ?>" autocomplete="off">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Image</label>
									<input type="file" class="form-control" name="empacrimage[]" id="empacrimage" autocomplete="off">
								</div>
							</div>
							<input type="hidden" class="form-control" name="empacruniqid[]" id="empacruniqid" value="<?php echo $dbacrvalue->mxemp_emp_acr_id; ?>" autocomplete="off">
							<input type="hidden" class="form-control" name="empacremployeeid[]" id="empacremployeeid" value="<?php echo $dbacrvalue->mxemp_emp_acr_employee_id; ?>" autocomplete="off">
							<div class="col-md-1">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn "><i class="fa fa-close text-danger"></i></button> -->
								</div>
							</div>


						</div>
						<?php } ?>
						<!-- <span class="addardetails"></span> -->
            
			<div class="text-right">
			    <?php if(sizeof($emp['employeeacr']) > 0){ ?>
				<button type="submit" class="btn btn-info" style="color: #fff;">Update Academic</button>
				<?php } ?>
				<a style="color:#fff" class="btn add-btn" data-toggle="modal" data-target="#add_acc"><i class="fa fa-plus"></i> Add New</a>
			</div>
			
			<div class="text-right">
	            
            </div>

					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Accademic details -->
<br>
<!-- Training -->
<form id="updatetraining">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header text-left">
				<h4 class="card-title mb-0">Training in Computer and Other Short term Courses</h4>
			</div>
			<div class="card-body">
						<?php //echo '<pre>'; print_r($emp['employeetr']);
						 ?>
<?php foreach ($emp['employeetr'] as $trkey => $trvalue) { ?>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Name of the Course:</label>
				<input type="text" class="form-control" name="emptrcourse[]" id="emptrcourse" value="<?php echo $trvalue->mxemp_emp_tr_nameofcourse ?>" autocomplete="off">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Name of the Institution:</label>
				<input type="text" class="form-control" name="emptrinstitution[]" id="emptrinstitution" value="<?php echo $trvalue->mxemp_emp_tr_nameofinstutions ?>" autocomplete="off">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>From:</label>
				<input type="text" class="form-control datetimepicker" name="emptrfrom[]" id="emptrfrom" value="<?php echo date('d-m-Y',strtotime($trvalue->mxemp_emp_tr_fromdate)); ?>" autocomplete="off">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>To:</label>
				<input type="text" class="form-control datetimepicker" name="emptrto[]" id="emptrto" value="<?php echo date('d-m-Y',strtotime($trvalue->mxemp_emp_tr_todate)); ?>" autocomplete="off">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Image:</label>
				<input type="file" class="form-control" name="emptrimage[]" id="emptrimage" autocomplete="off">
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<label>&nbsp;</label>
				<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger"></i></button> -->
			</div>
		</div>
	<input type="hidden" class="form-control" name="empatruniqid[]" id="empatruniqid" value="<?php echo $trvalue->mxemp_emp_tr_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empatremployeeid[]" id="empatremployeeid" value="<?php echo $trvalue->mxemp_emp_tr_employee_id; ?>" autocomplete="off">
	</div>
<?php } ?>
	<!-- <span class="addtrdetails"></span> -->

	<div class="text-right">
	    <?php if(sizeof($emp['employeetr']) >0){ ?>
		<button type="submit" class="btn btn-info" style="color: #fff;">Update Training</button>
		<?php } ?>
		<a style="color:#fff" class="btn add-btn" data-toggle="modal" data-target="#add_training"><i class="fa fa-plus"></i> Add New</a>
	</div>
	
</div>
</div>
</div>
</div>
</form>
<!-- Training -->
<br>
<!-- Employee Documents -->
<form id="updateemployeedocuments">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header text-left">
				<h4 class="card-title mb-0">Employee Documents</h4>
			</div>
			<div class="card-body">
						<?php //echo '<pre>'; print_r($emp['employeedocuments']);
						 ?>
<?php foreach ($emp['employeedocuments'] as $dockey => $docvalue) { ?>

    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Document Type:</label>
                <select class="form-control" name="empdoc_type[]" id="empdoc_type">
                    <option value="">Select Document</option>

                    <?php foreach ($documenttype as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"
                            <?php echo ($docvalue->document_type == $key) ? 'selected' : ''; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>

                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Document Name:</label>
                <input type="text"
                       class="form-control"
                       name="empdocname[]"
                       id="empdocname"
                       value="<?php echo $docvalue->document_name; ?>"
                       autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label>Issued Date:</label>
                <input type="text"
                       class="form-control datetimepicker"
                       name="empdocissueddate[]"
                       id="empdocissueddate"
                       value="<?php echo !empty($docvalue->issued_date) ? date('d-m-Y', strtotime($docvalue->issued_date)) : ''; ?>"
                       autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label>Employee Approved Date:</label>
                <input type="text" class="form-control datetimepicker" name="empdocapproveddate[]" id="empdocapproveddate" value="<?php echo !empty($docvalue->employee_approved_date) ? date('d-m-Y', strtotime($docvalue->employee_approved_date)) : ''; ?>"
                       autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label>Document:</label>
                <input type="file" class="form-control" name="empdocfile[]" id="empdocfile" autocomplete="off">

                <?php if (!empty($docvalue->file_name)) { ?>
                    <small>
                        Existing:
                        <a href="<?php echo base_url($docvalue->file_path); ?>"
                           target="_blank">
                            <?php echo $docvalue->file_name; ?>
                        </a>
                    </small>
                <?php } ?>
            </div>
        </div>

        <input type="hidden" name="empdocuniqid[]" value="<?php echo $docvalue->id; ?>">
        <input type="hidden" name="empdocemployeeid[]" value="<?php echo $docvalue->employee_code; ?>">

    </div>

<?php } ?>
<div class="text-right">
    <?php if (sizeof($emp['employeedocuments']) > 0) { ?>
        <button type="submit"
                class="btn btn-info"
                style="color: #fff;">
            Update Documents
        </button>
    <?php } ?>

    <a style="color:#fff"
       class="btn add-btn"
       data-toggle="modal"
       data-target="#add_employee_document">
        <i class="fa fa-plus"></i> Add New
    </a>
</div>
	
</div>
</div>
</div>
</div>
</form>
<!-- Employee Documents -->
</div>

<!-- Bank -->
<div class="tab-pane" id="solid-justified-tab5">
	<form id="updatebank">
<div class="row">
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Bank Name <span class="text-danger">*</span></label>
				<select class="form-control select2" placeholder="Bank Name" name="empbankname" id="empbankname" autocomplete="off" style="width:100%">
				    <?php echo $controller->display_options('bank_names',$emp['employeeinfo'][0]->mxemp_emp_bank_name); ?>
				</select>
			<span class="formerror" id="empbanknameerror"></span>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Bank Branch <span class="text-danger">*</span></label>
			<input type="text" class="form-control" placeholder="Bank Branch" name="empbankbranch" id="empbankbranch" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_bank_branch_name;?>" autocomplete="off">
			<span class="formerror" id="empbankbrancherror"></span>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Bank Account No <span class="text-danger">*</span></label>
			<input type="text" class="form-control" placeholder="Account No" name="empbankaccno" id="empbankaccno" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_bank_acc_no;?>"  autocomplete="off">
			<span class="formerror" id="empbankaccnoerror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">IFSCI No <span class="text-danger">*</span></label>
			<input type="text" class="form-control" placeholder="IFSCI No" name="empbankifsci" id="empbankifsci" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_bank_ifsci_no;?>" autocomplete="off">
			<span class="formerror" id="empbankifscierror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Bank Image</label>
			<input type="file" class="form-control" name="bankimg" id="bankimg" autocomplete="off" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_bankimage;?>">
			<span class="formerror" id="bankimgerror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Pancard No</label>
			<input type="text" class="form-control" placeholder="Pancard No" name="emppanno" id="emppanno" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_panno;?>" autocomplete="off">
			<span class="formerror" id="emppannoerror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">PanCard Image</label>
			<input type="file" class="form-control" name="pancardimg" id="pancardimg" autocomplete="off">
			<span class="formerror" id="pancardimg"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">ESI No</label>
			<input type="text" class="form-control" placeholder="ESI No" name="empesino" id="empesino" value= "<?php echo  $emp['employeeinfo'][0]->mxemp_emp_esi_number;?>" autocomplete="off">
			<span class="formerror" id="empesinoerror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
		    	<?php
                if(!empty($emp['employeeinfo'][0]->mxemp_emp_esiimage)){
                        $imageesi = 'Already Uploaded';
                        // link attach-icon
                }else{
                        $imageesi = 'Not Uploded';
                } ?>
			<label class="col-form-label">ESI Image  <span class="text-danger"><?php echo $imageesi ?></span> </label>
			<input type="file" class="form-control" name="empesinoimg" id="empesinoimg" autocomplete="off">
			
			<span class="formerror" id="empesinoimg"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">PF No</label>
			<input type="text" class="form-control" placeholder="PF No" name="emppfno" id="emppfno" value= "<?php echo $emp['employeeinfo'][0]->mxemp_emp_pf_number;?>" autocomplete="off">
			<span class="formerror" id="emppfnoerror"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">UAN</label>
			<input type="text" class="form-control" placeholder="UAN No" name="empuanno" id="empuanno" value= "<?php echo $emp['employeeinfo'][0]->mxemp_emp_uan_number;?>" autocomplete="off">
			<span class="formerror" id="empuannoerror"></span>
		</div>
	</div>
<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">pf joining date</label>
			<input type="text" class="form-control" placeholder="Aadhar No" name="empaadharno" id="empaadharno" value= "<?php echo $emp['employeeinfo'][0]->pfjoindate;?>" autocomplete="off">
			<span class="formerror" id="empaadharno"></span>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">eps joining date</label>
			<input type="text" class="form-control" placeholder="Aadhar No" name="empaadharno" id="empaadharno" value= "<?php echo $emp['employeeinfo'][0]->epsjoindate;?>" autocomplete="off">
			<span class="formerror" id="empaadharno"></span>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group">

            <label class="col-lg-12 col-form-label">EPS Non-Contribution</label>
            &nbsp;&nbsp;<input type="checkbox" name="is_eps_to_pf" id="is_eps_to_pf" value="1"
            <?php echo ($emp['employeeinfo'][0]->mxemp_is_eps_to_pf == 1) ? 'checked' : ''; ?>
           autocomplete="off">
            &nbsp;(Check to add EPS amount to PF and set EPS Wage to Zero)
            <span class="formerror" id="epstopferr"></span>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">esi joining date</label>
			<input type="text" class="form-control" placeholder="Aadhar No" name="empaadharno" id="empaadharno" value= "<?php echo $emp['employeeinfo'][0]->esijoindate;?>" autocomplete="off">
			<span class="formerror" id="empaadharno"></span>
		</div>
	</div>
	
	<?php 
	$every_days_passowrd_change=0;
	 $emp_id = $emp['employeeinfo'][0]->mxemp_emp_id;
	 $sql5 = " SELECT * FROM maxwell_employees_login where mxemp_emp_lg_employee_id = '$emp_id' ";
 $result5 = $this->db->query($sql5);
  $lastrowofareq5=$result5->result_array();
  $oldLead_id5=$result5->num_rows() ;
  if($oldLead_id5>0){ 
	$every_days_passowrd_change=$lastrowofareq5['0']['every_days_passowrd_change'];
  }
	?>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">last password change</label>
			<input type="text" class="form-control" placeholder="Aadhar No" name="empaadharno" id="empaadharno" value= "<?php echo $every_days_passowrd_change;?>" autocomplete="off">
			<span class="formerror" id="empaadharno"></span>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Aadhar Card</label>
			<input type="text" class="form-control" placeholder="Aadhar No" name="empaadharno" id="empaadharno" value= "<?php echo $emp['employeeinfo'][0]->mxemp_emp_aadhar;?>" autocomplete="off">
			<span class="formerror" id="empaadharno"></span>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Aadhar Image</label>
			<input type="file" class="form-control" name="empaadharnoimg" id="empaadharnoimg" autocomplete="off">
			<span class="formerror" id="empaadharnoimg"></span>
		</div>
	</div>
	<div class="col-sm-4" style="display:none">
	<div class="form-group">
		<label class="col-form-label">Gratuity Name</label>
			<input type="text" class="form-control" name="gratuityname" id="gratuityname" autocomplete="off">
	</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Gratuity </label>
				<select class="form-control select2" name="gratuity" id="gratuity" style="width:100%">
				    <option value=''></option>
				    <?php foreach($grautitynos as $gkeys => $vals){ 
				        if($vals == $emp['employeeinfo'][0]->mxemp_emp_gratuity){
				            $ac = 'selected';
				        }else{
				            $ac = '';
				        }
				    ?>
				    <option value='<?php echo $vals ?>' <?php echo $ac; ?>><?php echo $vals ?></option>
				    <?php } ?>
				</select>
				<span class="formerror" id="gratuitynameerror"></span>
		</div>
    </div>
    <div class="col-sm-4">
       <div class="form-group">
		<label class="col-form-label">LIC No</label>
			<input type="text" class="form-control" name="employeelicdetails" id="employeelicdetails" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_employee_lic_no ?>" autocomplete="off">
	</div>
    </div>
    
    <div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Mediclaim File1</label>
			<input type="file" class="form-control" name="licfile1" id="licfile1" autocomplete="off">
			<span class="formerror" id="licfile1"></span>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Mediclaim File2</label>
			<input type="file" class="form-control" name="licfile2" id="licfile2" autocomplete="off">
			<span class="formerror" id="licfile2"></span>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Mediclaim File3</label>
			<input type="file" class="form-control" name="licfile3" id="licfile3" autocomplete="off">
			<span class="formerror" id="licfile3"></span>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">Mediclaim File4</label>
			<input type="file" class="form-control" name="licfile4" id="licfile4" autocomplete="off">
			<span class="formerror" id="licfile4"></span>
		</div>
	</div>
    
    
    
    
    
	<input type="hidden" name="bankemployeeid" id="bankemployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>">
<input type="hidden" name="bankuniqueid" id="bankuniqueid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>">
</div>

						<div class="text-right">
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Bank</button>
						</div>
	</form>
</div>
<!-- Bank -->



<!-- Address -->
<div class="tab-pane" id="solid-justified-tab4">
<!-- Address -->
<form id="updateaddress">
<div class="row">
	<div class="col-xl-6 d-flex">
		<div class="card flex-fill">
			<div class="card-header">
				<h4 class="card-title mb-0">Present Address</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-lg-3 col-form-label">H.no / Flat.no / Door.no</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="emppreaddress1" id="emppreaddress1" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_present_address1; ?>" autocomplete="off">
						<span class="formerror" id="emppreaddress1error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address 2</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="emppreaddress2" id="emppreaddress2" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_present_address2; ?>" autocomplete="off">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">City</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprecity" id="empprecity" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_present_city; ?>" autocomplete="off">
						<span class="formerror" id="empprecityerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">State</label>
					<div class="col-lg-9">
						<!--<input type="text" class="form-control" name="empprestate" id="empprestate" value="<?php //echo $emp['employeeinfo'][0]->mxemp_emp_present_state; ?>" autocomplete="off">-->
						<select class="form-control select2" name="empprestate" id="empprestate" style="width:100%">
							<option value="">Select State</option>
							<?php foreach ($states as $key => $stvalue) { 
							        if($emp['employeeinfo'][0]->mxemp_emp_present_state_id == $stvalue->mxst_id){
							            ?>
								        <option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>" selected><?php echo $stvalue->mxst_state ?></option>
								    <?php }else{ ?>
								        <option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
								    <?php }?>
							<?php } ?>
						</select>
					</div>
					<span class="formerror" id="empprestateerror"></span>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Country</label>
					<div class="col-lg-9">
						<!--<input type="text" class="form-control" name="empprecountry" id="empprecountry" value="<?php //echo $emp['employeeinfo'][0]->mxemp_emp_present_country; ?>" autocomplete="off">-->
						<select class="form-control select2" name="empprecountry" id="empprecountry" autocomplete="off" style="width:100%">
						    <?php foreach($countries as $ckey => $cval){ ?>
						        <option value="<?php echo $cval->country_name ?>" <?php if($cval->country_name == $emp['employeeinfo'][0]->mxemp_emp_present_country){ echo 'selected'; } ?> ><?php echo $cval->country_name ?></option>
						    <?php } ?>
						</select>
						<span class="formerror" id="empprecountryerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Postal Code</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprepostalcode" id="empprepostalcode" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_present_postalcode; ?>" autocomplete="off">
						<span class="formerror" id="empprepostalcodeerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address Since</label>
					<div class="col-lg-9">
						<input type="text" class="form-control numbersonly" name="emppresince" id="emppresince" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_present_since; ?>" autocomplete="off">
						<span class="formerror" id="emppresinceerror"></span>
					</div>
				</div>
				<div class="text-right">
					<div class="form-group">
						<label>Click On Below To Copy Persent Details As Permanent Details:</label>
						<input class="form-control col-md-1 text-right copyaddress" onclick="CopyAddress()" id="copyaddress" type="checkbox">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6 d-flex">
		<div class="card flex-fill">
			<div class="card-header">
				<h4 class="card-title mb-0">Permanent Address</h4>
			</div>
			<div class="card-body">

				<div class="form-group row">
					<label class="col-lg-3 col-form-label">H.no / Flat.no / Door.no</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedaddress1" id="empfixedaddress1" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_address1; ?>" autocomplete="off">
						<span class="formerror" id="empfixedaddress1error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address 2</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedaddress2" id="empfixedaddress2" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_address2;  ?>" autocomplete="off">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">City</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedcity" id="empfixedcity" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_city; ?>" autocomplete="off">
						<span class="formerror" id="empfixedcityerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">State</label>
					<div class="col-lg-9">
						<!--<input type="text" class="form-control" name="empfixedstate" id="empfixedstate" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_state; ?>" autocomplete="off">-->
						<select class="form-control select2" name="empfixedstate" id="empfixedstate" style="width:100%">
							<option value="">Select State</option>
							<?php foreach ($states as $key => $stvalue) { 
							        if($emp['employeeinfo'][0]->mxemp_emp_fixed_state_id == $stvalue->mxst_id){
							        ?>
								        <option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>" selected><?php echo $stvalue->mxst_state ?></option>
								<?php }else{ ?>
								        <option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<span class="formerror" id="empfixedstateerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Country</label>
					<div class="col-lg-9">
						<!--<input type="text" class="form-control" name="empfixedcountry" id="empfixedcountry" value="<?php //echo $emp['employeeinfo'][0]->mxemp_emp_fixed_country; ?>" autocomplete="off">-->
						<select class="form-control select2" name="empfixedcountry" id="empfixedcountry" autocomplete="off" style="width:100%">
						    <?php foreach($countries as $ckey => $cval){ ?>
						        <option value="<?php echo $cval->country_name ?>" <?php if($cval->country_name == $emp['employeeinfo'][0]->mxemp_emp_fixed_country){ echo 'selected'; } ?> ><?php echo $cval->country_name ?></option>
						    <?php } ?>
						</select>
						<span class="formerror" id="empfixedcountryerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Postal Code</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedpostalcode" id="empfixedpostalcode" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_postalcode; ?>" autocomplete="off">
						<span class="formerror" id="empfixedpostalcodeerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address Since</label>
					<div class="col-lg-9">
						<input type="text" class="form-control numbersonly" name="empfixedpresince" id="empfixedpresince" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_present_since; ?>" autocomplete="off">
						<span class="formerror" id="empfixedpresinceerror"></span>
					</div>
				</div>
					<input type="hidden" name="employeeidaddress" id="employeeidaddress" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>">
<input type="hidden" name="uniqueidaddress" id="uniqueidaddress" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>">
						<div class="text-right">
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Address</button>
						</div>
			</div>
		</div>
	</div>
</div>
</form>
<!-- Address -->
</div>
<!-- Address -->
<!-- Family Information -->
<div class="tab-pane" id="solid-justified-tab2">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Family Information</h4>
			</div>
			<div class="card-body">
				<form id="updatefamily">
				<?php //echo '<pre>'; print_r($emp['employeefm']); ?>
				<?php foreach($emp['employeefm'] as $keyfa=>$efmly){ ?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>Title:</label>
									<select class="form-control" name="emptitle[]" id="emptitle">
                                <?php echo $controller->display_options('titles',$efmly->mxemp_emp_fm_title); ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Relation:</label>
									<select class="form-control" name="empfmrelation[]" id="empfmrelation">
										<option value="">Select Relation</option>
										<?php
											foreach($relation as $rel){
												if($rel == $efmly->mxemp_emp_fm_relation ){
													$sel='selected';
												}else{
										 			$sel='';
												}
										?>
										<option <?php echo $sel; ?> value="<?php echo $rel ?>"><?php echo $rel; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Name:</label>
									<input type="text" class="form-control" name="empfmname[]" id="empfmname" value="<?php echo $efmly->mxemp_emp_fm_name; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Date of Birth:</label>
									<input type="date" class="form-control" name="empfmage[]" id="empfmage" value="<?php echo $efmly->mxemp_emp_fm_age; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Occupation:</label>
									<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" value="<?php echo $efmly->mxemp_emp_fm_occupation; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger" ></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="empafmuniqid[]" id="empafmuniqid" value="<?php echo $efmly->mxemp_emp_fm_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empafmemployeeid[]" id="empafmemployeeid" value="<?php echo $efmly->mxemp_emp_fm_employee_id; ?>" autocomplete="off">

						</div>
						<!-- <span class="addfmdetails"></span> -->
					</div>
				</div>
				<?php } ?>
						<div class="text-right">
						    <a style="color:#fff" class="btn add-btn" data-toggle="modal" data-target="#add_new"><i class="fa fa-plus"></i> Add New</a>
							<?php if(sizeof($emp['employeefm'])>0){ ?>
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Family</button>
							<?php } ?>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- new popup -->
<div id="add_new" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Family Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addnewfamily">
					<!-- ddd -->
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Title:</label>
									<select class="form-control" name="emptitleadd" id="emptitleadd">
                                <?php echo $controller->display_options('titles',''); ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Relation:</label>
									<select class="form-control" name="empfmrelationadd" id="empfmrelationadd">
										<option value="">Select Relation</option>
										<?php
											foreach($relation as $rel){ ?>
										<option value="<?php echo $rel ?>"><?php echo $rel; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Name:</label>
									<input type="text" class="form-control" name="empfmnameadd" id="empfmnameadd" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Date of Birth:</label>
									<input type="date" class="form-control" name="empfmageadd" id="empfmageadd" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Occupation:</label>
									<input type="text" class="form-control" name="empfmoccupationadd" id="empfmoccupationadd" autocomplete="off">
								</div>
							</div>
                    	<input type="hidden" class="form-control" name="empafmemployeeidadd" id="empafmemployeeidadd" value="<?php echo $efmly->mxemp_emp_fm_employee_id; ?>" autocomplete="off">

						</div>
						<!-- <span class="addfmdetails"></span> -->
					</div>
				</div>
					<!-- ddd -->
					<div class="submit-section">
						<button type="submit" class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- new popup -->
<!-- Family Information -->
<!-- Previous Employment -->
<div class="tab-pane" id="solid-justified-tab3">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Previous Employment</h4>
			</div>
			<div class="card-body">
				<form id="updatepreviousemp">
				<?php foreach($emp['employeepe'] as $keyprem=>$employ){ ?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Period From - To:</label>
									<input type="text" class="form-control" name="emppreviousprediofromto[]" id="emppreviousprediofromto" value="<?php echo $employ->mxemp_emp_pe_periodfromto; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Name & Orgination:</label>
									<textarea class="form-control" name="emppreviousorgnation[]" id="emppreviousorgnation"><?php echo $employ->mxemp_emp_pe_nameandorg;?></textarea>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desg Joining Time:</label>
									<input type="text" class="form-control" name="emppreviousdesgjointime[]" id="emppreviousdesgjointime" value="<?php echo $employ->mxemp_emp_pe_desgjointime; ?>"  autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desg Leaving Time:</label>
									<input type="text" class="form-control" name="emppreviousleavingtime[]" id="emppreviousleavingtime" value="<?php echo $employ->mxemp_emp_pe_desgleavingtime; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Reported To (Desgn):</label>
									<input type="text" class="form-control" name="emppreviousreportedto[]" id="emppreviousreportedto" value="<?php echo $employ->mxemp_emp_pe_desgreportedto; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Salary per month:</label>
									<input type="text" class="form-control" name="empprevioussalarypermonth[]" id="empprevioussalarypermonth" value="<?php echo $employ->mxemp_emp_pe_monthlysalary ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Other Benfits:</label>
									<input type="text" class="form-control" name="emppreviousotherbenfits[]" id="emppreviousotherbenfits" value="<?php echo $employ->mxemp_emp_pe_otherbenfits; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Reason For Change:</label>
									<input type="text" class="form-control" name="emppreviousreasonchange[]" id="emppreviousreasonchange" value="<?php echo $employ->mxemp_emp_pe_reasonforchange; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger"></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="emppreuniqid[]" id="emppreuniqid" value="<?php echo $employ->mxemp_emp_pe_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empapreemployeeid[]" id="empapreemployeeid" value="<?php echo $employ->mxemp_emp_pe_employee_id; ?>" autocomplete="off">

						</div>
						<!-- <span class="addpredetails"></span> -->
					</div>
				</div>

				<?php } ?>
			    	
						<div class="text-right">
						    <?php if(sizeof($emp['employeepe']) >0){ ?>
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Previous Employeement</button>
							<?php  } ?>
							<a style="color:#fff" class="btn add-btn" data-toggle="modal" data-target="#add_previous_employment"><i class="fa fa-plus"></i> Add New</a>
						</div>
		    		
					</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Previous Employment -->
<!-- Authorizations -->
<div class="tab-pane" id="solid-justified-tab8">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Authorization</h4>
			</div>
			<div class="card-body">
                <form id="updateAuthorisation">
				    <div class="row">
					<div class="col-xl-12">
						<div class="row">
							<!-------------LINE 1---->
							<div class="col-md-4">
								<div class="form-group">
									<label>Authorization Type:</label>
									<select class="form-control auth_type" name="authorizationtype[]" id="authtype_1">
										<option value="">Select Auth Type</option>
										<option value="1" <?php echo (isset($authtypedata[0]->mxauth_auth_type) && $authtypedata[0]->mxauth_auth_type == 1)?"selected ":"" ?> >Branch</option>
										<option value="2" <?php echo (isset($authtypedata[0]->mxauth_auth_type) && $authtypedata[0]->mxauth_auth_type == 2)?"selected ":"" ?> >Head Office</option>
										<option value="3" <?php echo (isset($authtypedata[0]->mxauth_auth_type) && $authtypedata[0]->mxauth_auth_type == 3)?"selected ":"" ?> >HR</option>
										<option value="4" <?php echo (isset($authtypedata[0]->mxauth_auth_type) && $authtypedata[0]->mxauth_auth_type == 4)?"selected ":"" ?> >Director</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Department Name:</label>
									<!--<input type="text" class="form-control" name="authorizationdepartmentbr" id="authorizationdepartmentbr" autocomplete="off">-->
									<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_1" style="width:100%">

									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Employee Name:</label>
									<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_1" autocomplete="off"></select>
								</div>
							</div>

<!-- 							<div class="col-md-2 text-center">
							    <div class="form-group">
							        <label>Approvals (Leave/Regulations):</label><br>
							        <input style="width:18px;height:18px;margin-top:10px;" type="checkbox" class="form-check-input emp_approval" name="emp_approval[]" id="emp_approval_1" autocomplete="off">
							    </div>
							</div> -->
							<!-------------END LINE 1--------->
							<!-------------LINE 2--------->
							<div class="col-md-4">
								<div class="form-group">
									<label>Authorization Type:</label>
									<select class="form-control auth_type" name="authorizationtype[]" id="authtype_2">
										<option value="">Select Auth Type</option>
										<option value="1" <?php echo (isset($authtypedata[1]->mxauth_auth_type) && $authtypedata[1]->mxauth_auth_type == 1)?"selected ":"" ?> >Branch</option>
										<option value="2" <?php echo (isset($authtypedata[1]->mxauth_auth_type) && $authtypedata[1]->mxauth_auth_type == 2)?"selected ":"" ?> >Head Office</option>
										<option value="3" <?php echo (isset($authtypedata[1]->mxauth_auth_type) && $authtypedata[1]->mxauth_auth_type == 3)?"selected ":"" ?> >HR</option>
										<option value="4" <?php echo (isset($authtypedata[1]->mxauth_auth_type) && $authtypedata[1]->mxauth_auth_type == 4)?"selected ":"" ?> >Director</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Department Name:</label>
									<!--<input type="text" class="form-control" name="authorizationdepartmenthr" id="authorizationdepartmenthr" autocomplete="off">-->
									<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_2" style="width:100%">
										<!--<option value="">Type</option>-->
										<!--<option value="3">Hr</option>-->
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Employee Name:</label>
									<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_2" autocomplete="off"></select>
								</div>
							</div>
<!-- 							<div class="col-md-2 text-center">
							    <div class="form-group">
							        <label>Approvals (Leave/Regulations):</label><br>
							        <input style="width:18px;height:18px;margin-top:10px;" type="checkbox" class="form-check-input emp_approval" name="emp_approval[]" id="emp_approval_2" autocomplete="off">
							    </div>
							</div> -->
							<!-------------END LINE 2--------->
							<!-------------LINE 3--------->

							<div class="col-md-4">
								<div class="form-group">
									<label>Authorization Type:</label>
									<select class="form-control auth_type" name="authorizationtype[]" id="authtype_3">
										<option value="">Select Auth Type</option>
										<option value="1" <?php echo (isset($authtypedata[2]->mxauth_auth_type) && $authtypedata[2]->mxauth_auth_type == 1)?"selected ":"" ?> >Branch</option>
										<option value="2" <?php echo (isset($authtypedata[2]->mxauth_auth_type) && $authtypedata[2]->mxauth_auth_type == 2)?"selected ":"" ?> >Head Office</option>
										<option value="3" <?php echo (isset($authtypedata[2]->mxauth_auth_type) && $authtypedata[2]->mxauth_auth_type == 3)?"selected ":"" ?> >HR</option>
										<option value="4" <?php echo (isset($authtypedata[2]->mxauth_auth_type) && $authtypedata[2]->mxauth_auth_type == 4)?"selected ":"" ?> >Director</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Department Name:</label>
									<!--<input type="text" class="form-control" name="authorizationdepartmentdirector" id="authorizationdepartmentdirector" autocomplete="off">-->
									<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_3" style="width:100%">
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Employee Name:</label>
									<select type="text" class="form-control select2 emp_name" name="emp_name[]" style="width: 100%" id="empname_3" autocomplete="off"></select>
								</div>
							</div>
<!-- 							<div class="col-md-2 text-center">
							    <div class="form-group">
							        <label>Approvals (Leave/Regulations):</label><br>
							        <input style="width:18px;height:18px;margin-top:10px;" type="checkbox" class="form-check-input emp_approval" name="emp_approval[]" id="emp_approval_3" autocomplete="off">
							    </div>
							</div> -->
							<!-------------END LINE 3--------->
							<!-------------LINE 4--------->
							<div class="col-md-4">
								<div class="form-group">
									<label>Authorization Type:</label>
									<select class="form-control auth_type" name="authorizationtype[]" id="authtype_4">
										<option value="">Select Auth Type</option>
										<option value="1" <?php echo (isset($authtypedata[3]->mxauth_auth_type) && $authtypedata[3]->mxauth_auth_type == 1)?"selected ":"" ?> >Branch</option>
										<option value="2" <?php echo (isset($authtypedata[3]->mxauth_auth_type) && $authtypedata[3]->mxauth_auth_type == 2)?"selected ":"" ?> >Head Office</option>
										<option value="3" <?php echo (isset($authtypedata[3]->mxauth_auth_type) && $authtypedata[3]->mxauth_auth_type == 3)?"selected ":"" ?> >HR</option>
										<option value="4" <?php echo (isset($authtypedata[3]->mxauth_auth_type) && $authtypedata[3]->mxauth_auth_type == 4)?"selected ":"" ?> >Director</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Department Name:</label>
									<!--<input type="text" class="form-control" name="authorizationdepartment[]" id="authorizationdepartment[]" autocomplete="off">-->
									<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_4" style="width:100%">
										<!--<option value="">Type</option>-->
										<!--<option value="3">Hr</option>-->
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Employee Name:</label>
									<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_4" autocomplete="off"> </select>
								</div>
							</div>
<!-- 							<div class="col-md-2 text-center">
							    <div class="form-group">
							        <label>Approvals (Leave/Regulations):</label><br>
							        <input style="width:18px;height:18px;margin-top:10px;" type="checkbox" class="form-check-input emp_approval" name="emp_approval[]" id="emp_approval_4" autocomplete="off">
							    </div>
							</div> -->
							<!-------------END LINE 4--------->
							<!-------------LINE 5--------->
							<div class="col-md-4">
								<div class="form-group">
									<label>Authorization Type:</label>
									<select class="form-control auth_type" name="authorizationtype[]" id="authtype_5">
										<option value="">Select Auth Type</option>
										<option value="1" <?php echo (isset($authtypedata[4]->mxauth_auth_type) && $authtypedata[4]->mxauth_auth_type == 1)?"selected ":"" ?> >Branch</option>
										<option value="2" <?php echo (isset($authtypedata[4]->mxauth_auth_type) && $authtypedata[4]->mxauth_auth_type == 2)?"selected ":"" ?> >Head Office</option>
										<option value="3" <?php echo (isset($authtypedata[4]->mxauth_auth_type) && $authtypedata[4]->mxauth_auth_type == 3)?"selected ":"" ?> >HR</option>
										<option value="4" <?php echo (isset($authtypedata[4]->mxauth_auth_type) && $authtypedata[4]->mxauth_auth_type == 4)?"selected ":"" ?> >Director</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Department Name:</label>
									<!--<input type="text" class="form-control" name="authorizationdepartment[]" id="authorizationdepartment[]" autocomplete="off">-->
									<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_5" style="width:100%">
										<!--<option value="">Type</option>-->
										<!--<option value="3">Hr</option>-->
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Employee Name:</label>
									<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_5" autocomplete="off"> </select>
								</div>
							</div>
<!-- 							<div class="col-md-2 text-center">
							    <div class="form-group">
							        <label>Approvals (Leave/Regulations):</label><br>
							        <input style="width:18px;height:18px;margin-top:10px;" type="checkbox" class="form-check-input emp_approval" name="emp_approval[]" id="emp_approval_5" autocomplete="off">
							    </div>
							</div> -->
							<!-------------END LINE 5--------->
							<script>
							    $(document).ready(function(){
							        
							    
        							    var comp_id = '<?php echo $emp['employeeinfo'][0]->mxemp_emp_comp_code; ?>';
        							    var branch_id = '<?php echo $emp['employeeinfo'][0]->mxemp_emp_branch_code; ?>';
        							    
        							    var auth_type_1 = '<?php echo (isset($authtypedata[0]->mxauth_auth_type)) ? $authtypedata[0]->mxauth_auth_type: "NO" ?>';
        							    var auth_type_2 = '<?php echo (isset($authtypedata[1]->mxauth_auth_type))? $authtypedata[1]->mxauth_auth_type: "NO" ?>';
        							    var auth_type_3 = '<?php echo (isset($authtypedata[2]->mxauth_auth_type))? $authtypedata[2]->mxauth_auth_type: "NO" ?>';
        							    var auth_type_4 = '<?php echo (isset($authtypedata[3]->mxauth_auth_type))? $authtypedata[3]->mxauth_auth_type: "NO" ?>';
        							    var auth_type_5 = '<?php echo (isset($authtypedata[4]->mxauth_auth_type))? $authtypedata[4]->mxauth_auth_type: "NO" ?>';
        							    
        							    var auth_dept_1 = '<?php echo (isset($authtypedata[0]->mxauth_dept_id)) ? $authtypedata[0]->mxauth_dept_id: "NO" ?>';
        							    var auth_dept_2 = '<?php echo (isset($authtypedata[1]->mxauth_dept_id))? $authtypedata[1]->mxauth_dept_id: "NO" ?>';
        							    var auth_dept_3 = '<?php echo (isset($authtypedata[2]->mxauth_dept_id))? $authtypedata[2]->mxauth_dept_id: "NO" ?>';
        							    var auth_dept_4 = '<?php echo (isset($authtypedata[3]->mxauth_dept_id))? $authtypedata[3]->mxauth_dept_id: "NO" ?>';
        							    var auth_dept_5 = '<?php echo (isset($authtypedata[4]->mxauth_dept_id))? $authtypedata[4]->mxauth_dept_id: "NO" ?>';
        							    
        							    var auth_emp_code_1 = '<?php echo (isset($authtypedata[0]->mxauth_reporting_head_emp_code)) ? $authtypedata[0]->mxauth_reporting_head_emp_code: "NO" ?>';
        							    var auth_emp_code_2 = '<?php echo (isset($authtypedata[1]->mxauth_reporting_head_emp_code))? $authtypedata[1]->mxauth_reporting_head_emp_code: "NO" ?>';
        							    var auth_emp_code_3 = '<?php echo (isset($authtypedata[2]->mxauth_reporting_head_emp_code))? $authtypedata[2]->mxauth_reporting_head_emp_code: "NO" ?>';
        							    var auth_emp_code_4 = '<?php echo (isset($authtypedata[3]->mxauth_reporting_head_emp_code))? $authtypedata[3]->mxauth_reporting_head_emp_code: "NO" ?>';
        							    var auth_emp_code_5 = '<?php echo (isset($authtypedata[4]->mxauth_reporting_head_emp_code))? $authtypedata[4]->mxauth_reporting_head_emp_code: "NO" ?>';
        							    
        							    //   alert("comp_id == " + comp_id + "branch_id == " + branch_id + "auth_type_1 == " + auth_type_1);
        							    //--->LOAD AUTH DEPARTMENTS
        							    if(auth_type_1 != "NO"){ get_departments(comp_id,branch_id,auth_type_1,auth_dept_1,1); } 
        							    if(auth_type_2 != "NO"){ get_departments(comp_id,branch_id,auth_type_2,auth_dept_2,2); }
        							    if(auth_type_3 != "NO"){ get_departments(comp_id,branch_id,auth_type_3,auth_dept_3,3); }
        							    if(auth_type_4 != "NO"){ get_departments(comp_id,branch_id,auth_type_4,auth_dept_4,4); }
        							    if(auth_type_5 != "NO"){ get_departments(comp_id,branch_id,auth_type_5,auth_dept_5,5); }
        							    //--->END LOAD AUTH DEPARTMENTS
        							    
        							    //--->LOAD AUTH EMP CODES
        							    if(auth_emp_code_1 != "NO"){ get_employees(comp_id,branch_id,auth_dept_1,auth_type_1,auth_emp_code_1,1); } 
        							    if(auth_emp_code_2 != "NO"){ get_employees(comp_id,branch_id,auth_dept_2,auth_type_2,auth_emp_code_2,2); }
        							    if(auth_emp_code_3 != "NO"){ get_employees(comp_id,branch_id,auth_dept_3,auth_type_3,auth_emp_code_3,3); }
        							    if(auth_emp_code_4 != "NO"){ get_employees(comp_id,branch_id,auth_dept_4,auth_type_4,auth_emp_code_4,4); }
        							    if(auth_emp_code_5 != "NO"){ get_employees(comp_id,branch_id,auth_dept_5,auth_type_5,auth_emp_code_5,5); }
        							    //--->END LOAD AUTH EMP CODES
							    });
							     //ONLOAD GET AUTHORISATION DEPARTMENTS
                                    function get_departments(comp_id,branch_name,auth_type_id,dept_id,id_no){
                                        // alert("comp_id = " + comp_id + " branch_id = " + branch_name + " id_no = " + id_no);
                                        $.ajax({
                                          url: baseurl + 'admin/get_departments_based_on_auth_type',
                                          type: 'POST',
                                          async:false,
                                          data: { comp_id: comp_id, branch_id: branch_name, auth_type: auth_type_id },
                                          success: function (data) {
                                            // console.log(data);
                                            var parse_data = JSON.parse(data);
                                            if (parse_data.length > 0) {
                                              $("#authdept_" + id_no).empty();
                                              $("#empname_" + id_no).empty();
                                              $("#authdept_" + id_no).append('<option value="">Select Department</option>');
                                              for (index in parse_data) {
                                                var dept_data = parse_data[index];
                                                var dept_code = dept_data['mxdpt_id'];
                                                var dept_name = dept_data['mxdpt_name'];
                                                if(dept_id == dept_code){
                                                    $("#authdept_" + id_no).append('<option value="' + dept_code + '" selected>' + dept_name + '</option>');
                                                }else{
                                                    $("#authdept_" + id_no).append('<option value="' + dept_code + '">' + dept_name + '</option>');
                                                }
                                              }
                                
                                            } else {
                                              $("#authdept_" + id_no).empty();
                                              $("#empname_" + id_no).empty();
                                              if (auth_type_id == 1) {//Branch
                                                alert("No Departments Found In the Selected Branch");
                                                return false;
                                              } else if (auth_type_id == 2) {//----->HEAD OFFICE
                                                alert("No Departments Found In the Head Office Branch");
                                                return false;
                                              } else if (auth_type_id == 3) {//-----> HR
                                                alert("There Is No HR Departments Found In the Head Office Branch");
                                                return false;
                                              } else if (auth_type_id == 4) {//------>DIRECTOR
                                                alert("There Is No Director Department Found In the Head Office Branch");
                                                return false;
                                              }
                                            }
                                          }
                                        });
                                    }
                                //END ONLOAD GET AUTHORISATION DEPARTMENTS
                                
                                //ONLOAD AUTHORISATION EMPLOYEES
                                function get_employees(comp_id,branch_name,dept_id,auth_type_id,auth_emp_code_db,id_no){
                                    // alert(auth_emp_code_db);
                                    $.ajax({
                                      url: baseurl + 'admin/get_employee_info_based_on_departments',
                                      type: 'POST',
                                      async:false,
                                      data: { comp_id: comp_id, branch_id: branch_name, dept_id: dept_id, auth_type: auth_type_id },
                                      success: function (data) {
                                        // console.log(data);
                                        var parse_data = JSON.parse(data);
                                        if (parse_data.length > 0) {
                                            var emp_name_id = "#empname_" + id_no;
                                          $(emp_name_id).empty();
                                          $(emp_name_id).append('<option value="">Select Authorisation</option>');
                                          for (index in parse_data) {
                                            var auth_data = parse_data[index];
                                            var auth_emp_code = auth_data['mxemp_emp_id'];
                                            var auth_emp_name = auth_data['mxemp_emp_lname'] + " " + auth_data['mxemp_emp_fname'];
                                            var auth_comp_code = auth_data['mxemp_emp_comp_code'];
                                            var auth_comp_name = auth_data['mxcp_name'];
                                            var auth_branch_code = auth_data['mxemp_emp_branch_code'];
                                            var auth_branch_name = auth_data['mxb_name'];
                                            var auth_dept_code = auth_data['mxemp_emp_dept_code'];
                                            var auth_dept_name = auth_data['mxdpt_name'];
                                            var auth_desg_code = auth_data['mxemp_emp_desg_code'];
                                            var auth_desg_name = auth_data['mxdesg_name'];
                                            var auth_state_id = auth_data['mxemp_emp_state_code'];
                                            var auth_state_name = auth_data['mxst_state'];
                                            var auth_div_id = auth_data['mxemp_emp_division_code'];
                                            var auth_div_name = auth_data['mxd_name'];
                                            var opt_data = auth_emp_code + " - " + auth_emp_name + " - " + auth_desg_name
                                            var opt_val = auth_emp_code + "~" + auth_comp_code + "~" + auth_comp_name + "~" + auth_branch_code + "~" + auth_branch_name + "~" + auth_dept_code + "~" + auth_dept_name + '~' + auth_state_id + '~' + auth_state_name + '~' + auth_div_id + '~' + auth_div_name
                                            if(auth_emp_code == auth_emp_code_db){
                                                $(emp_name_id).append('<option value="' + opt_val + '" selected>' + opt_data + '</option>');
                                            }else{
                                                $(emp_name_id).append('<option value="' + opt_val + '">' + opt_data + '</option>');
                                            }
                                          }
                            
                                        } else {
                                          //$("#authdept_" + id_no).empty();
                                          $("#empname_" + id_no).empty();
                                          if (auth_type_id == 1) {//Branch
                                            alert("No Employees Found In the Selected Branch");
                                            return false;
                                          } else if (auth_type_id == 2) {//----->HEAD OFFICE
                                            alert("No Employees Found In the Head Office Branch");
                                            return false;
                                          } else if (auth_type_id == 3) {//-----> HR
                                            alert("There Is No Employees in HR Departments In the Head Office Branch");
                                            return false;
                                          } else if (auth_type_id == 4) {//------>DIRECTOR
                                            alert("There Is No Employees in Director Department In the Head Office Branch");
                                            return false;
                                          }
                                        }
                                      }
                                    });
                                }
                                //END ONLOAD AUTHORISATION EMPLOYEES
							</script>
							<div class="col-md-2"></div>
						</div>
					</div>
				</div>
				    <div class="text-right">
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Authorisation</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Authorizations -->
<!-- Refrences -->
<div class="tab-pane" id="solid-justified-tab7">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Refrences Information</h4>
			</div>
			<div class="card-body">
				<form id="updaterefrences">
						<?php foreach($emp['employeerefrence'] as $keyref=>$valref){?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>Company Type:</label>
									<select class="form-control" name="refrencecmptype[]" id="refrencecmptype">
										<option value="">Type</option>
										<?php
										 foreach($cmptypeval as $ckey=>$ctval){
										if($ctval== $valref->mxemp_emp_rf_type){
											$sel='selected';
										}else{
											$sel=''; }
										?>
										<option <?php echo $sel; ?> value="<?php echo $ckey;?>"><?php echo $ctval;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Refrence Name:</label>
									<input type="text" class="form-control" name="refrencename[]" id="refrencename" value="<?php echo $valref->mxemp_emp_rf_relationname; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Relation With Candidate:</label>
									<input type="text" class="form-control" name="refrencenwcnd[]" id="refrencenwcnd" value="<?php echo $valref->mxemp_emp_rf_relation; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Mobile:</label>
									<input type="number" class="form-control" name="refrencemobile[]" id="refrencemobile" value="<?php echo $valref->mxemp_emp_rf_relationmobile; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger" ></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="emprfuniqid[]" id="emprfuniqid" value="<?php echo $valref->mxemp_emp_rf_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="emprfemployeeid[]" id="emprfemployeeid" value="<?php echo $valref->mxemp_emp_rf_employee_id; ?>" autocomplete="off">

						</div>
						<!-- <span class="addrefrencedetails"></span> -->


					</div>
				</div>
						<?php } ?>
						
						<!-- Guarantors documents -->
						<?php if(sizeof($emp['employeerefrence']) > 0){ ?>
 						<div class="col-md-3">
							<div class="form-group">
								<label>Guarantors Documents:</label>
								<input type="file" class="form-control" name="guarantors" id="guarantors" autocomplete="off">
							</div>
						</div> 

						<!-- Guarantor documents -->
						<?php } ?>
						
						<div class="text-right">
						    <a style="color:#fff" class="btn add-btn" data-toggle="modal" data-target="#add_refe"><i class="fa fa-plus"></i> Add New Refrence</a>
						    <?php if(sizeof($emp['employeerefrence']) >0){ ?>
							    <button type="submit" class="btn btn-info" style="color: #fff;">Update Refrence</button>
							<?php } ?>
						</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- new refr popup -->
<div id="add_refe" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addnew_refr">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Relation:</label>
									<select class="form-control" name="refrencecmptype" id="refrencecmptype">
											<option value="">Type</option>
											<option value="MAXWELL">MAXWELL</option>
											<option value="ARC">ARC</option>
											<option value="WEBSITES">WEBSITES</option>
                                    		<option value="NAUKRI">NAUKRI</option>
                                    		<option value="WALKIN">WALKIN</option>
                                    		<option value="JOBPORTAL">JOB PORTAL</option>
                                    		<option value="LINKEDIN">LINKEDIN</option>
                                    		<option value="OTHERS">OTHERS</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Refrence Name:</label>
									<input type="text" class="form-control" name="refrencename" id="refrencename" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Relation With Candidate:</label>
									<input type="text" class="form-control" name="refrencenwcnd" id="refrencenwcnd" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Mobile:</label>
									<input type="text" class="form-control" name="refrencemobile" id="refrencemobile" autocomplete="off">
								</div>
							</div>
							<input type="hidden" class="form-control" name="editemprfemployeeid" id="editemprfemployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ; ?>" autocomplete="off">
						</div>
						<div class="submit-section">
						<button type="submit"  class="btn btn-primary submit-btn">Submit</button>
					</div>
					</div>
				</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- new refr popup -->
<!-- new Academic popup -->
<div id="add_acc" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addnew_academic">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Type:</label>
									<select class="form-control" name="add_empacrtype" id="add_empacrtype">
									    <option value="">Select</option>
									    <option value="General">General</option>
									    <option value="Professional">Professional</option>
									    <option value="NON Mertic">NON Mertic</option>
									    <option value="Mertic">Mertic</option>
									    <option value="SSC">SSC</option>
									    <option value="Inter">Inter</option>
									    <option value="Degree">Degree</option>
									    <option value="Diploma">Diploma</option>
									    <option value="PHD">PHD</option>
									    <option value="Senior Secondary">Senior Secondary</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Year of Passing:</label>
									<input type="text" class="form-control" name="add_empacryop" id="add_empacryop" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Institution:</label>
									<input type="text" class="form-control" name="add_empacrinstitution" id="add_empacrinstitution" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Subject:</label>
									<input type="text" class="form-control" name="add_empacrsubject" id="add_empacrsubject" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>University:</label>
									<input type="text" class="form-control" name="add_empacruniversity" id="add_empacruniversity" autocomplete="off">
								</div>
							</div>
						    <div class="col-md-4">
								<div class="form-group">
									<label>Marks%:</label>
									<input type="text" class="form-control" name="add_empacrmarks" id="add_empacrmarks" autocomplete="off">
								</div>
							</div>
							<input type="hidden" class="form-control" name="editempaccemployeeid" id="editempaccemployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ; ?>" autocomplete="off">
						</div>
						<div class="submit-section">
						<button type="submit"  class="btn btn-primary submit-btn">Submit</button>
					</div>
					</div>
				</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- new Academic popup -->
<!-- new training popup -->
<div id="add_training" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addnew_training">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Name of the Course:</label>
									<input type="text" class="form-control" name="add_emptrcourse" id="add_empcourse" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Name of the Institution:</label>
									<input type="text" class="form-control" name="add_emptrinstitution" id="add_emptrinstitution" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>From:</label>
									<input type="text" class="form-control datetimepicker" name="add_emptrfrom" id="add_emptrfrom" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>To:</label>
									<input type="text" class="form-control datetimepicker" name="add_emptrto" id="add_emptrto" autocomplete="off">
								</div>
							</div>
							<input type="hidden" class="form-control" name="editemptrainingemployeeid" id="editemptrainingemployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ; ?>" autocomplete="off">
						</div>
						<div class="submit-section">
						<button type="submit"  class="btn btn-primary submit-btn">Submit</button>
					</div>
					</div>
				</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- new training popup -->
<!-- new employee document popup -->
<div id="add_employee_document" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Employee Document</h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form id="addnew_employee_document"
                      enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-xl-12">

                            <div class="row">

                                <!-- Document Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document Type:</label>

                                        <select class="form-control"
                                                name="add_empdoc_type"
                                                id="add_empdoc_type">

                                            <option value="">Select Document Type</option>

                                            <?php foreach ($documenttype as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>">
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <!-- Document Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document Name:</label>

                                        <input type="text"
                                               class="form-control"
                                               name="add_empdocname"
                                               id="add_empdocname"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <!-- Issued Date -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Issued Date:</label>

                                        <input type="text"
                                               class="form-control datetimepicker"
                                               name="add_empdocissueddate"
                                               id="add_empdocissueddate"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <!-- Employee Approved Date -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Employee Approved Date:</label>

                                        <input type="text"
                                               class="form-control datetimepicker"
                                               name="add_empdocapproveddate"
                                               id="add_empdocapproveddate"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <!-- Document File -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document:</label>

                                        <input type="file"
                                               class="form-control"
                                               name="add_empdocfile"
                                               id="add_empdocfile"
                                               accept=".pdf,.doc,.docx">
                                    </div>
                                </div>

                                <!-- Employee ID -->
                                <input type="hidden"
                                       name="add_empdocemployeeid"
                                       id="add_empdocemployeeid"
                                       value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id; ?>">

                            </div>

                            <div class="submit-section">
                                <button type="submit"
                                        class="btn btn-primary submit-btn">
                                    Submit
                                </button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- new employee document popup -->
<!-- new Previous Employment popup -->
<div id="add_previous_employment" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addnew_previous_employment">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Period From - To:</label>
									<input type="text" class="form-control" name="add_emppreviousprediofromto" id="add_emppreviousprediofromto" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Name & Orgination:</label>
									<textarea class="form-control" name="add_emppreviousorgnation" id="add_emppreviousorgnation"></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Desg Joining Time:</label>
									<input type="text" class="form-control" name="add_emppreviousdesgjointime" id="add_emppreviousdesgjointime" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Desg Leaving Time:</label>
									<input type="text" class="form-control" name="add_emppreviousleavingtime" id="add_emppreviousleavingtime" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Reported To (Desgn):</label>
									<input type="text" class="form-control" name="add_emppreviousreportedto" id="add_emppreviousreportedto" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Salary per month:</label>
									<input type="text" class="form-control" name="add_empprevioussalarypermonth" id="add_empprevioussalarypermonth" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Other Benfits:</label>
									<input type="text" class="form-control" name="add_emppreviousotherbenfits" id="add_emppreviousotherbenfits" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Reason For Change:</label>
									<input type="text" class="form-control" name="add_emppreviousreasonchange" id="add_emppreviousreasonchange" autocomplete="off">
								</div>
							</div>
							<input type="hidden" class="form-control" name="editemppreviousemploymentemployeeid" id="editemppreviousemploymentemployeeid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ; ?>" autocomplete="off">
						</div>
						<div class="submit-section">
						<button type="submit"  class="btn btn-primary submit-btn">Submit</button>
					</div>
					</div>
				</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- new Previous Employment popup -->
<!-- Refrences -->
<!-- Nominee Details -->
<div class="tab-pane" id="solid-justified-tab6">
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Nominee Information</h4>
			</div>
			<div class="card-body">
				<form id="updatenominee">
				<?php foreach($emp['employeenominee'] as $noimkey=>$noimneval){ ?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>Nominee Type:</label>
									<select class="form-control" name="esinomineerelationtype[]" id="esinomineerelationtype">
										<option value="">Type</option>
									<?php 
									foreach($nomineetyp as $nokeyv=>$nomvalue) { 
									if($nomvalue == $noimneval->mxemp_emp_nm_type){
										$sel = 'selected';
									}else{
									   	$sel = '';
									} 
									?>
									<option <?php echo $sel ?> value="<?php echo $nomvalue ?>"><?php echo $nomvalue; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nominee Relation:</label>
									<select class="form-control" name="esinomineerelation[]" id="esinomineerelation">
										<option value="">Relation</option>
									<?php 
									foreach($nomineerel as $norelkeyv => $nomrelvalue) { 
									if($nomrelvalue == $noimneval->mxemp_emp_nm_relation){
									 $sel = 'selected';
									}else{
									 $sel = '';}
									 ?>
									<option <?php echo $sel ?> value="<?php echo $nomrelvalue ?>"><?php echo $nomrelvalue; ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Name:</label>
									<input type="text" class="form-control" name="esinomineename[]" id="esinomineename" value ="<?php echo $noimneval->mxemp_emp_nm_relationname?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>Age:</label>
									<input type="text" class="form-control" name="esinomineeage[]" id="esinomineeage" value="<?php echo $noimneval->mxemp_emp_nm_relationage ?>" autocomplete="off">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Mobile:</label>
									<input type="number" class="form-control" name="esinomineemobile[]" id="esinomineemobile" value="<?php echo $noimneval->mxemp_emp_nm_relationmobile ?>" autocomplete="off">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" name="esinomineeaddress[]" id="esinomineeaddress"><?php echo $noimneval->mxemp_emp_nm_relationaddress ?></textarea>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label>Nominee %:</label>
									<input type="number" class="form-control" name="esinomineepercent[]" id="esinomineepercent" value="<?php echo $noimneval->mxemp_emp_nm_relationpercent ?>" autocomplete="off">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Image</label>
									<input type="file" class="form-control" name="esinomineeimage[]" id="esinomineeimage" autocomplete="off">
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger" ></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="empnmuniqid[]" id="empnmuniqid" value="<?php echo $noimneval->mxemp_emp_nm_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empnmemployeeid[]" id="empnmemployeeid" value="<?php echo $noimneval->mxemp_emp_nm_employee_id; ?>" autocomplete="off">
						</div>
					</div>
				</div>
				<?php } ?>
				<!-- <span class="addesidetails"></span> -->
				<div class="text-right">
					<button type="submit" class="btn btn-info" style="color: #fff;">Update Nominee</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Nominee Details -->

</div>
</div>
</div>
</div>
</div>


</div>
</div>
		<?php
		if($emp['employeeinfo'][0]->mxemp_emp_having_vehicle == 'HAVING VEHICLE'){
			$veh='checked';
			echo "<script> $('.hvvehicle').trigger('click'); $('.enableifhavingvehicle').show(); </script>";
		}elseif($emp['employeeinfo'][0]->mxemp_emp_having_vehicle == 'NOT HAVING VEHICLE'){
		   	$noveh='checked';
		   	echo "<script> $('.ntvehicle').trigger('click'); $('.enableifhavingvehicle').hide(); </script>";
		} 
		
		if($emp['employeeinfo'][0]->mxemp_emp_marital_status == 'Married'){
		    echo "<script> $('.openmrd').show(); </script>";
		}
		?>
<script>
// $('input').on('paste', function (event) {
//   if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
//     event.preventDefault();
//   }
// });

// $("input").on("keypress",function(event){
//     if(event.which <= 48 || event.which >=57){
//         return false;
//     }
// });
function readURL(input, img) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
if (img == 'img1') {
$('#blah1').attr('src', e.target.result);
}
};
reader.readAsDataURL(input.files[0]);
}
}
</script>

<script>
$('.marital').change(function (e) {
    var mr = $('#empmarital').val();
    if (mr == "Married") {
      $(".openmrd").show();
    } else {
      $(".openmrd").hide();
    }
  });


  $('.hvvehicle').click(function (e) {
    var vh = $('.hvvehicle').val();
    if (vh == "HAVING VEHICLE") {
      $(".enableifhavingvehicle").show();
    }
  });

  $('.ntvehicle').click(function (e) {
    var nvh = $('.ntvehicle').val();
    $(".enableifhavingvehicle").hide();
  });

 $('#empdob').on('dp.change', function (e) {
    // var formatedValue = e.date.format(e.date._f);
    var dob = $(this).val();
    var sp = dob.split('-');
    var dob_ymd = sp[2] + '/' + sp[1] + '/' + sp[0];
    // alert('age: ' + getAge("1994/06/19"));
    var age = getAge(dob_ymd);
    $("#empage").val(age);

  });
  function getAge(dateString) {//"1994/06/19"
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }

</script>

<!-- <script src="<?php //echo base_url() ?>assets/js/formsjs/employee.js"></script> -->
<script src="<?php echo base_url() ?>assets/js/formsjs/editemployee.js"></script>

<script>
$(function() {
var hash = window.location.hash;
hash && $('ul.nav a[href="' + hash + '"]').tab('show');

$('.nav-item a').click(function(e) {
$(this).tab('show');
var scrollmem = $('body').scrollTop();
window.location.hash = this.hash;
$('html,body').scrollTop(scrollmem);
});
});
</script>

<script>
function CopyAddress() {
var cpaddress = $('.copyaddress').is(':checked');
if (cpaddress == true) {
var add1 = $("#emppreaddress1").val();
$("#empfixedaddress1").val(add1);
var add12 = $("#emppreaddress2").val();
$("#empfixedaddress2").val(add12);
var addcity = $("#empprecity").val();
$("#empfixedcity").val(addcity);
var addstate = $("#empprestate").val();
$('#empfixedstate').val(addstate).trigger("change");
// $("#empfixedstate").val(addstate);
var addcountry = $("#empprecountry").val();
$("#empfixedcountry").val(addcountry);
var addemppstcode = $("#empprepostalcode").val();
$("#empfixedpostalcode").val(addemppstcode);
var emppresince = $("#emppresince").val();
$("#empfixedpresince").val(emppresince);
} else {
$("#empfixedaddress1").val('');
$("#empfixedaddress2").val('');
$("#empfixedcity").val('');
$("#empfixedstate").val('').trigger("change");
$("#empfixedcountry").val('');
$("#empfixedpostalcode").val('');
$("#empfixedpresince").val('');

}
}

// Variable to track the original state from the database
var originalEpsStatus = <?php echo $emp['employeeinfo'][0]->mxemp_is_eps_to_pf; ?>;

$('#is_eps_to_pf').on('click', function(e) {
    var checkbox = $(this);

    // If the record is currently "Checked" in DB and user tries to uncheck it
    if (originalEpsStatus == 1 && !checkbox.is(':checked')) {
        e.preventDefault(); // Stop the uncheck action

        var password = prompt("Enter Password to disable EPS Non-Contribution:");

        if (password) {
            verifySuperAdmin(password, checkbox);
        }
    }
});

function verifySuperAdmin(password, checkbox) {
    $.ajax({
        url: baseurl + 'employee/verify_super_admin_access',
        type: "POST",
        data: { password: password },
        dataType: "json",
        success: function(res) {
            if (res.status == 200) {
                // Success: Allow the checkbox to be unchecked
                originalEpsStatus = 0;
                checkbox.prop('checked', false);
                alert("Authorization Successful.");
            } else {
                alert(res.message);
                checkbox.prop('checked', true); // Force keep checked
            }
        },
        error: function() {
            alert("Error in verification. Action denied.");
            checkbox.prop('checked', true);
        }
    });
}
</script>
