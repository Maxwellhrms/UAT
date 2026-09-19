<?php
// echo '<pre>';
// print_r($rec); die;
?>
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
<h3 class="page-title">Edit Application Details</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
<li class="breadcrumb-item active">Edit Application Details </li>
</ul>
</div>
</div>
</div>
<!-- /Page Header -->
<form id="processemployeedetails">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-xl-6">
<div class="form-group row">
<label class="col-lg-3 col-form-label">Company</label>
<div class="col-lg-9">
<select class="form-control select2" name="cmpname" id="cmpname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_comp_code; ?>"><?php echo $rec['recinfo'][0]->mxcp_name ?></option>
</select>
<span class="formerror" id="cmpnameerror"></span>
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label">Division</label>
<div class="col-lg-9">
<select class="form-control select2" name="divname" id="divname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_division_code; ?>"><?php echo $rec['recinfo'][0]->mxd_name ?></option>
</select>
<span class="formerror" id="divnameerror"></span>
</div>
</div>

<div class="form-group row">
<label class="col-lg-3 col-form-label">State</label>
<div class="col-lg-9">
<select class="form-control select2" name="cmpstate" id="cmpstate">
<option value="<?php  echo $rec['recinfo'][0]->mxst_id . '@~@' . $rec['recinfo'][0]->mxst_state ?>"><?php  echo $rec['recinfo'][0]->mxst_state ?></option>
</select>
<span class="formerror" id="cmpstateerror"></span>
</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label"></label>
	<div class="col-lg-9">
		<?php  if($rec['recinfo'][0]->mx_rec_branch_or_not == 1 ){ 
			$inbrsel="checked";
			$sel='selected';
		} ?>
		<?php  if($rec['recinfo'][0]->mx_rec_branch_or_not == 2 ){ 
			$outbrsel="checked";
			$sel='selected';
		 } ?>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" id ="inoutid1" name="inoutid" <?php echo $inbrsel ?> value="1" >
			<label class="form-check-label">
				In Branch
			</label>
		</div>
		
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" id ="inoutid2" name="inoutid"  <?php echo $outbrsel ?> value="2">
			<label class="form-check-label">
				Outside Branch 
			</label>
		</div>
		<span class="formerror" id="inoutiderror"></span>
	</div>
</div>
<?php  if(isset($outbrsel) ){ ?>														
<div class="form-group row altbranch">
<label class="col-lg-3 col-form-label">Alternate Branch</label>
<div class="col-lg-9">
<input type="text" class="form-control" name="altbranch" id="altbranch" value="<?php  echo $rec['recinfo'][0]->mx_rec_manual_branch ?>" autocomplete="off">
<span class="formerror" id="altbrancherror"></span>
</div>
</div>
<?php   } ?>

<?php  if(isset($inbrsel) ){ ?>	
<div class="form-group row branch">
<label class="col-lg-3 col-form-label">Branch  </label>
<div class="col-lg-9">
	<select class="form-control select2" name="brname[]" id="brname" multiple style="width:100%"  >
		<?php  	if(strpos($rec['recinfo'][0]->mx_rec_branch_code , ',') != false ){
				$i=0;
				$brid=explode(',',$rec['recinfo'][0]->mx_rec_branch_code);
				foreach($branchid as $key=>$val){
					if($val->mxb_id == $brid[$i]){
						$i++;	?>
					<option <?php echo $sel; ?> value="<?php echo $val->mxb_id; ?>"><?php echo $val->mxb_name ?></option>
		<?php } } }else{ ?>
					<option <?php echo $sel; ?> value="<?php echo $rec['recinfo'][0]->mx_rec_branch_code; ?>"><?php echo $rec['recinfo'][0]->mxb_name ?></option>
		<?php } ?>
	</select>
<span class="formerror" id="brnameerror"></span>
</div>
</div>
<?php  } ?>

<div class="form-group row" style="display:none">
<label class="col-lg-3 col-form-label">Sub Branch</label>
<div class="col-lg-9">
<select class="form-control select2" name="subbrname" id="subbrname">
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
<select class="form-control select2" name="departmentname" id="departmentname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_dept_code; ?>"><?php echo $rec['recinfo'][0]->mxdpt_name ?></option>
</select>
<span class="formerror" id="departmentnameerror"></span>
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label">Designation</label>
<div class="col-lg-9">
<select class="form-control select2" name="designationname" id="designationname" >
	<option value="<?php echo $rec['recinfo'][0]->mx_rec_desg_code; ?>"><?php echo $rec['recinfo'][0]->mxdesg_name ?></option>
</select>
<span class="formerror" id="designationnameerror"></span>
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label">Keywords</label>
<div class="col-lg-9">
<input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $rec['recinfo'][0]->mx_rec_keywords ?>">
<span class="formerror" id="keywordserror"></span>
</div>
</div>
</div>
</div>
</form>
<ul class="nav nav-tabs nav-tabs-solid nav-justified">
<li class="nav-item"><a class="nav-link active" id="personalinformation" href="#solid-justified-tab1" data-toggle="tab">Personal Information</a></li>
<li class="nav-item"><a class="nav-link" id="familyinformation" href="#solid-justified-tab2" data-toggle="tab">Family Details</a></li>
<li class="nav-item"><a class="nav-link" id="previousempinformation" href="#solid-justified-tab3" data-toggle="tab">Previous Employment</a></li>
<li class="nav-item"><a class="nav-link" id="addressinformation" href="#solid-justified-tab4" data-toggle="tab">Address</a></li>
</ul>
<div class="tab-content">

<!-- Personal Details -->
<div class="tab-pane show active" id="solid-justified-tab1">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
	<h4 class="card-title mb-0">Personal Information</h4>
</div>
<div class="card-body">
	<div class="row">
	<form id="updatepersonaldeatils">
		<input type="hidden" name="perrecid" id="perrecid" value="<?php echo $rec['recinfo'][0]->mx_rec_application ?>">
		<input type="hidden" name="uniqueid" id="uniqueid" value="<?php echo $rec['recinfo'][0]->mx_rec_autouniqueid ?>">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label>Candidate Name:</label>
						<input type="text" class="form-control" name="empfname" id="empfname" value="<?php echo $rec['recinfo'][0]->mx_rec_name; ?>" autocomplete="off">
						<span class="formerror" id="empfnameerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Email:</label>
					<input type="email" class="form-control" name="empemail" id="empemail" value="<?php echo $rec['recinfo'][0]->mx_rec_email; ?>" autocomplete="off">
					<span class="formerror" id="empemailerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Mobile:</label>
					<input type="number" class="form-control" name="empmobile" id="empmobile" value="<?php echo $rec['recinfo'][0]->mx_rec_phone_no; ?>" autocomplete="off">
					<span class="formerror" id="empmobileerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>ALT Mobile:</label>
					<input type="number" class="form-control" name="empaltmobile" id="empaltmobile" value="<?php echo $rec['recinfo'][0]->mx_rec_alt_phn_no; ?>" autocomplete="off">
					<span class="formerror" id="empaltmobileerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Gender</label><br>
						<?php 
							if( $rec['recinfo'][0]->mx_rec_gender =='Male'){
							  $male='checked';
							}else if($rec['recinfo'][0]->mx_rec_gender =='Female'){
							 $female='checked';
							} ?>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="empgender" value="Male" <?php echo  $male; ?> >
						<label class="form-check-label">
							Male
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="empgender" value="Female" <?php echo $female; ?> >
						<label class="form-check-label">
							Female
						</label>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Mother Tongue:</label>
					<select class="form-control select2" name="empmtongue" id="empmtongue" autocomplete="off">
					<?php foreach ($language as $keys => $lgmgvalue) {
									if($emp['employeeinfo'][0]->mx_rec_mother_tongue == $lgmgvalue){
										$sel = "selected";
									}else{
										$sel = "";
									} ?>
									<option value="<?php echo $lgmgvalue->mxlg_id?>" <?php echo $sel; ?> ><?php echo $lgmgvalue->mxlg_name ?></option>
								<?php } ?>		</select>
					<span class="formerror" id="empmtongueerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Date Of Birth:</label>
					<input type="text" class="form-control datetimepicker" name="empdob" id="empdob" value="<?php echo date('d-m-Y',strtotime($rec['recinfo'][0]->mx_rec_date_of_birth)); ?> autocomplete="off">
					<span class="formerror" id="empdoberror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Age:</label>
						<input type="text" class="form-control" name="empage" id="empage" autocomplete="off" value="<?php echo $rec['recinfo'][0]->mx_rec_age ?>" readonly>
						<span class="formerror" id="empageerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Marital Status:</label>
					<select class="form-control select2 marital" name="empmarital" id="empmarital">
						<option value="">Select Marital Status</option>
						<option value="Married" <?php if($rec['recinfo'][0]->mx_rec_marital_status == 'Married'){ echo 'selected'; }else{ echo '';} ?>>Married</option>
						<option value="UnMarried" <?php if($rec['recinfo'][0]->mx_rec_marital_status == 'UnMarried'){ echo 'selected'; }else{ echo '';} ?>>UnMarried</option>
					</select>
					<span class="formerror" id="empmaritalerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Native:</label>
					<input type="text" class="form-control" name="empnative" id="empnative" value="<?php echo $rec['recinfo'][0]->mx_rec_native ?>" autocomplete="off">
					<span class="formerror" id="empnativeerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Expected Salary:</label>
					<input type="number" class="form-control" name="empsalary" id="empsalary" placeholder=" Salary Expected " value="<?php echo $rec['recinfo'][0]->mx_rec_expected_salary; ?>" autocomplete="off">
					<span class="formerror" id="empsalaryerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Resume Received Date:</label>
					<input type="text" class="form-control datetimepicker" name="empresumedate" id="empresumedate" value="<?php echo  date('d-m-Y', strtotime($rec['recinfo'][0]->mx_rec_resume_received_date)) ?>"autocomplete="off">
					<span class="formerror" id="empresumedateerror"></span>
					</div>
				</div>
			    <div class="col-md-3">
					<div class="form-group">
						<label>Candidate Resume:</label>
					<input type="file" class="form-control" name="candidateresume" id="candidateresume"  autocomplete="off">
					<span class="formerror" id="candidateresumeerror"></span>
					</div>
				</div> 
				
				<div class="col-md-3">
					<div class="form-group">
						<label>Prefered Location:</label>
					<input type="text" class="form-control" name="candidatepreferedlocation" id="candidatepreferedlocation" autocomplete="off" value="<?php echo $rec['recinfo'][0]->mx_rec_prefered_location; ?>" >
					<span class="formerror" id="candidatepreferedlocationerror"></span>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<hr>
	<div class="col-md-12">
		<div class="row">
			<!-------------LANGUAGES---------------->
			<div class="col-md-12" class="lang_div" id="lang_div">
				<div class="row" id="div_1">
					<div class="col-md-3">
						<div class="form-group">
							<label>Language1:</label>
							<select class="form-control select2" name="emplanguage_1" id="emplanguage_1">
								<option value="">Select Language</option>
								<?php foreach ($language as $key => $lgvalue) { 
									if($lgvalue->mxlg_id == $rec['recinfo'][0]->mx_rec_language_1 ){ ?>
									<option selected  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo  $lgvalue->mxlg_name ?></option>
									<?php
									$speck = $rec['recinfo'][0]->mx_rec_speak_1;
									$read = $rec['recinfo'][0]->mx_rec_read_1;
									$write = $rec['recinfo'][0]->mx_rec_write_1;	
									}else{ ?>
									<option  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>
									<?php } } ?>
							</select>
							<span class="formerror" id="emplanguageerror_1"></span>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label>Speak:</label>
							<input class="form-control col-md-2" type="checkbox"  <?php if(!empty($speck)){ echo 'checked'; } ?> name="empspeak_speak_1" id="empspeak_speak_1" value="1">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Read:</label>
							<input class="form-control col-md-2" type="checkbox"  <?php if(!empty($read)){ echo 'checked'; } ?> name="empread_read_1" id="empread_read_1" value="1">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Write:</label>
							<input class="form-control col-md-2" type="checkbox"  <?php if(!empty($write)){ echo 'checked'; } ?>name="empwrite_write_1" id="empwrite_write_1" value="1">
						</div>
					</div>
				</div>
				<div class="row" id="div_1">
					<div class="col-md-3">
						<div class="form-group">
							<label>Language2:</label>
							<select class="form-control select2" name="emplanguage_2" id="emplanguage_2">
								<option value="">Select Language</option>
								<?php foreach ($language as $key => $lgvalue) { 
									if($lgvalue->mxlg_id == $rec['recinfo'][0]->mx_rec_language_2 ){ ?>
									<option selected  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo  $lgvalue->mxlg_name ?></option>
									<?php
									$speck = $rec['recinfo'][0]->mx_rec_speak_2;
									$read = $rec['recinfo'][0]->mx_rec_read_2;
									$write = $rec['recinfo'][0]->mx_rec_write_2;	
									}else{ ?>
									<option  value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>
									<?php } } ?>
							
							</select>
							<span class="formerror" id="emplanguageerror_2"></span>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label>Speak:</label>
							<input class="form-control col-md-2" type="checkbox" <?php if(!empty($speck)){ echo 'checked'; } ?> name="empspeak_speak_2" id="empspeak_speak_2" value="1">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Read:</label>
							<input class="form-control col-md-2" type="checkbox" <?php if(!empty($read)){ echo 'checked'; } ?> name="empread_read_2" id="empread_read_2" value="1">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Write:</label>
							<input class="form-control col-md-2" type="checkbox"  <?php if(!empty($write)){ echo 'checked'; } ?> name="empwrite_write_2" id="empwrite_write_2" value="1">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-------------END LANGUAGES---------------->
	<div class="text-right">
		<button type="submit" class="btn btn-info" style="color: #fff;">Update Personal Information</button>
	</div>
</div>
</form>	
</div>
</div>
</div>

<!-- Accademic deatils -->
<div class="row">
<div class="col-md-12">
<div class="card mb-0">
<div class="card-header">
	<h4 class="card-title mb-0">Academic Records</h4>
</div>
<div class="card-body">
	<div class="row">
	<form id="updateacademic">
		<div class="col-xl-12">
		<?php foreach($rec['recacr'] as $dbacrkey => $dbacrvalue){  ?>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Type:</label>
						<select class="form-control" name="empacrtype[]" id="empacrtype">
							<option value="">Select</option>
							<?php foreach($academy as $ackey => $asvalue){
								if($ackey == $dbacrvalue->mx_rec_acr_type){
									$sel = "selected";
								}else{
									$sel = "";
								}   ?>
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
						<input type="text" class="form-control" name="empacryop[]" id="empacryop" value = "<?Php echo $dbacrvalue->mx_rec_acr_yop ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Institution:</label>
						<input type="text" class="form-control" name="empacrinstitution[]" id="empacrinstitution" value = "<?Php echo $dbacrvalue->mx_rec_acr_institution ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Subject:</label>
						<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" value = "<?Php echo $dbacrvalue->mx_rec_acr_subject ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>University:</label>
						<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" value = "<?Php echo $dbacrvalue->mx_rec_acr_university; ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>Marks%:</label>
						<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" value = "<?Php echo $dbacrvalue->mx_rec_acr_marks ?>" autocomplete="off">
					</div>
				</div>
				<input type="hidden" class="form-control" name="empacruniqid[]" id="empacruniqid" value="<?php echo $dbacrvalue->mx_rec_acr_id; ?>" autocomplete="off">
				<input type="hidden" class="form-control" name="empacremployeeid[]" id="empacremployeeid" value="<?php echo $dbacrvalue->mx_rec_acr_application_id; ?>" autocomplete="off">
							
			</div>
			<?php } ?>
			<!-- <span class="addardetails"></span> -->
			<div class="text-right">
				<button type="submit" class="btn btn-info" style="color: #fff;">Update Academic</button>
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
<!-- Refrence Details -->
<div class="row">
<div class="col-md-12">
<div class="card mb-0">
<div class="card-header">
	<h4 class="card-title mb-0">Refrences Information</h4>
</div>
<div class="card-body">
<form id="updaterefrences" > 
	<div class="row">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Company Type:</label>
						<select class="form-control" name="refrencecmptype" id="refrencecmptype">
							<?php
								foreach($cmptypeval as $ckey=>$ctval){
									if($ctval == $rec['recinfo'][0]->mx_rec_refrence_type){
										$sel='selected';
									}else{
										$sel=''; 
									} ?>
								<option <?php echo $sel; ?> value="<?php echo $ckey; ?>"><?php echo $ctval; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Refrence Name:</label>
						<input type="text" class="form-control" name="refrencename" id="refrencename" value="<?php echo $rec['recinfo'][0]->mx_rec_refrence_name; ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Relation With Candidate:</label>
						<input type="text" class="form-control" name="refrencenwcnd" id="refrencenwcnd" value="<?php echo $rec['recinfo'][0]->mx_rec_refrence_relation; ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Mobile:</label>
						<input type="number" class="form-control" name="refrencemobile" id="refrencemobile"  value="<?php echo $rec['recinfo'][0]->mx_rec_refrence_mobile; ?>" autocomplete="off">
					</div>
				</div>
				<input type="hidden" class="form-control" name="emprfuniqid" id="emprfuniqid" value="<?php echo $rec['recinfo'][0]->mx_rec_autouniqueid; ?>" autocomplete="off">
				<input type="hidden" class="form-control" name="emprfemployeeid" id="emprfemployeeid" value="<?php echo $rec['recinfo'][0]->mx_rec_application; ?>" autocomplete="off">

			</div>

		</div>
	</div>
	<div class="text-right">
		<button type="submit" class="btn btn-info" style="color: #fff;">Update Refrences Information</button>
	</div>
	</form>
</div>
</div>
</div>
</div>
<!-- Refrence Details -->

</div>
<!-- Personal Details -->


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
					<label class="col-lg-3 col-form-label">Address 1</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="emppreaddress1" id="emppreaddress1" value="<?php echo $rec['recinfo'][0]->mx_rec_present_address1; ?>" autocomplete="off">
						<span class="formerror" id="emppreaddress1error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address 2</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="emppreaddress2" id="emppreaddress2" value="<?php echo $rec['recinfo'][0]->mx_rec_present_address2; ?>" autocomplete="off">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">City</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprecity" id="empprecity" value="<?php echo $rec['recinfo'][0]->mx_rec_present_city; ?>" autocomplete="off">
						<span class="formerror" id="empprecityerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">State</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprestate" id="empprestate" value="<?php echo $rec['recinfo'][0]->mx_rec_present_state; ?>" autocomplete="off">
					</div>
					<span class="formerror" id="empprestateerror"></span>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Country</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprecountry" id="empprecountry" value="<?php echo $rec['recinfo'][0]->mx_rec_present_country; ?>" autocomplete="off">
						<span class="formerror" id="empprecountryerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Postal Code</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empprepostalcode" id="empprepostalcode" value="<?php echo $rec['recinfo'][0]->mx_rec_present_postalcode; ?>" autocomplete="off">
						<span class="formerror" id="empprepostalcodeerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address Since</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="emppresince" id="emppresince" value="<?php echo $rec['recinfo'][0]->mx_rec_present_since; ?>" autocomplete="off">
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
					<label class="col-lg-3 col-form-label">Address 1</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedaddress1" id="empfixedaddress1" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_address1; ?>" autocomplete="off">
						<span class="formerror" id="empfixedaddress1error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address 2</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedaddress2" id="empfixedaddress2" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_address2;  ?>" autocomplete="off">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">City</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedcity" id="empfixedcity" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_city; ?>" autocomplete="off">
						<span class="formerror" id="empfixedcityerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">State</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedstate" id="empfixedstate" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_state; ?>" autocomplete="off">
						<span class="formerror" id="empfixedstateerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Country</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedcountry" id="empfixedcountry" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_country; ?>" autocomplete="off">
						<span class="formerror" id="empfixedcountryerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Postal Code</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedpostalcode" id="empfixedpostalcode" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_postalcode; ?>" autocomplete="off">
						<span class="formerror" id="empfixedpostalcodeerror"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address Since</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="empfixedpresince" id="empfixedpresince" value="<?php echo $rec['recinfo'][0]->mx_rec_fixed_present_since; ?>" autocomplete="off">
						<span class="formerror" id="empfixedpresinceerror"></span>
					</div>
				</div>
					<input type="hidden" name="employeeidaddress" id="employeeidaddress" value="<?php echo $rec['recinfo'][0]->mx_rec_application ?>">
					<input type="hidden" name="uniqueidaddress" id="uniqueidaddress" value="<?php echo $rec['recinfo'][0]->mx_rec_autouniqueid ?>">
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
				<?php 		
				//print_r($rec['recfm']); die;
				foreach($rec['recfm'] as $keyfa=>$efmly){ ?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Relation:</label>
									<select class="form-control" name="empfmrelation[]" id="empfmrelation">
										<option value="">Select Relation</option>
										<?php
											foreach($relation as $rel){
												if($rel == $efmly->mx_rec_fm_relation ){
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
									<input type="text" class="form-control" name="empfmname[]" id="empfmname" value="<?php echo $efmly->mx_rec_fm_name; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>Age:</label>
									<input type="text" class="form-control" name="empfmage[]" id="empfmage" value="<?php echo $efmly->mx_rec_fm_age; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Occupation:</label>
									<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" value="<?php echo $efmly->mx_rec_fm_occupation; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger" ></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="empafmuniqid[]" id="empafmuniqid" value="<?php echo $efmly->mx_rec_fm_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empafmemployeeid[]" id="empafmemployeeid" value="<?php echo $efmly->mx_rec_fm_application_id; ?>" autocomplete="off">

						</div>
						<!-- <span class="addfmdetails"></span> -->
					</div>
				</div>
				<?php } ?>
						<div class="text-right">
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Family</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
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
				<form id="updatepreviousrec">
				<?php foreach($rec['recpe'] as $keyprem=>$employ){ ?>
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Period From - To:</label>
									<input type="text" class="form-control" name="emppreviousprediofromto[]" id="emppreviousprediofromto" value="<?php echo $employ->mx_rec_pe_periodfromto; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Name & Orgination:</label>
									<textarea class="form-control" name="emppreviousorgnation[]" id="emppreviousorgnation"><?php echo $employ->mx_rec_pe_nameandorg;?></textarea>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desg Joining Time:</label>
									<input type="text" class="form-control" name="emppreviousdesgjointime[]" id="emppreviousdesgjointime" value="<?php echo $employ->mx_rec_pe_desgjointime; ?>"  autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desg Leaving Time:</label>
									<input type="text" class="form-control" name="emppreviousleavingtime[]" id="emppreviousleavingtime" value="<?php echo $employ->mx_rec_pe_desgleavingtime; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Reported To (Desgn):</label>
									<input type="text" class="form-control" name="emppreviousreportedto[]" id="emppreviousreportedto" value="<?php echo $employ->mx_rec_pe_desgreportedto; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Salary per month:</label>
									<input type="text" class="form-control" name="empprevioussalarypermonth[]" id="empprevioussalarypermonth" value="<?php echo $employ->mx_rec_pe_monthlysalary ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Other Benfits:</label>
									<input type="text" class="form-control" name="emppreviousotherbenfits[]" id="emppreviousotherbenfits" value="<?php echo $employ->mx_rec_pe_otherbenfits; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Reason For Change:</label>
									<input type="text" class="form-control" name="emppreviousreasonchange[]" id="emppreviousreasonchange" value="<?php echo $employ->mx_rec_pe_reasonforchange; ?>" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>&nbsp;</label>
									<!-- <button type="button" class="form-control btn"><i class="fa fa-close text-danger"></i></button> -->
								</div>
							</div>
	<input type="hidden" class="form-control" name="emppreuniqid[]" id="emppreuniqid" value="<?php echo $employ->mx_rec_pe_id; ?>" autocomplete="off">
	<input type="hidden" class="form-control" name="empapreemployeeid[]" id="empapreemployeeid" value="<?php echo $employ->mx_rec_pe_application_id; ?>" autocomplete="off">
						</div>
						<!-- <span class="addpredetails"></span> -->
					</div>
				</div>

				<?php } ?>
						<div class="text-right">
							<button type="submit" class="btn btn-info" style="color: #fff;">Update Previous Employeement</button>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Previous Employment -->
</div>
</div>
</div>
</div>
</div>

</form>

</div>
</div>
<script>

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


<!--<script>-->
<!--var languages = '<?php echo json_encode($language); ?>';-->
<!--languages = JSON.parse(languages);-->
<!--</script>-->

<script src="<?php echo base_url() ?>assets/js/formsjs/recuirtmenthtml.js"></script>
<script>
var emp = 1;
</script>

<script src="<?php echo base_url() ?>assets/js/formsjs/editrecruitment.js"></script>
<!--
<script src="<?php echo base_url() ?>assets/js/formsjs/recuruitment.js"></script> -->

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


$('input[type="radio"]').click(function(){
    var bid = $(this).attr("value");
	  if(bid == 1){
        $("div.altbranch").hide();
        $("div.branch").show();
	  }else if(bid == 2) {
        $("div.branch").hide();
        $("div.altbranch").show();
	  }
    });
});


</script>

<!--<script>-->
<!--function CopyAddress() {-->
<!--var cpaddress = $('.copyaddress').is(':checked');-->
<!--if (cpaddress == true) {-->
<!--var add1 = $("#emppreaddress1").val();-->
<!--$("#empfixedaddress1").val(add1);-->
<!--var add12 = $("#emppreaddress2").val();-->
<!--$("#empfixedaddress2").val(add12);-->
<!--var addcity = $("#empprecity").val();-->
<!--$("#empfixedcity").val(addcity);-->
<!--var addstate = $("#empprestate").val();-->
<!--$("#empfixedstate").val(addstate);-->
<!--var addcountry = $("#empprecountry").val();-->
<!--$("#empfixedcountry").val(addcountry);-->
<!--var addemppstcode = $("#empprepostalcode").val();-->
<!--$("#empfixedpostalcode").val(addemppstcode);-->
<!--} else {-->
<!--$("#empfixedaddress1").val('');-->
<!--$("#empfixedaddress2").val('');-->
<!--$("#empfixedcity").val('');-->
<!--$("#empfixedstate").val('');-->
<!--$("#empfixedcountry").val('');-->
<!--$("#empfixedpostalcode").val('');-->

<!--}-->
<!--}-->
<!--</script>-->

