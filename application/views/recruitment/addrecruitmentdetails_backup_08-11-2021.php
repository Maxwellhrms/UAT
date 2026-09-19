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
<?php 
if(isset($_GET) && !empty($_GET)){
    $name = $_GET['name'];
    $email = $_GET['email'];
    $mobile = $_GET['mobile'];
    $resumedate = $_GET['resumedate'];
    $division = $_GET['divison'];
    $resume = $_GET['resume'];
    $jobid = $_GET['jobid'];
    $resume = $_GET['resume'];
    $uniquejobid = $_GET['uniquejobid'];
}else{
    $name = '';
    $email = '';
    $mobile = '';
    $resumedate = '';
    $division = '';
    $resume = '';
    $jobid = '';
    $uniquejobid = '';
}
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
<div class="content container-fluid">

<!-- Page Header -->
<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Add Application Details</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
<li class="breadcrumb-item active">Add Application Details </li>
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
<option value="">-- Select Company --</option>
<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
	<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
<?php } ?>
</select>
<span class="formerror" id="cmpnameerror"></span>
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label">Division</label>
<div class="col-lg-9">
<select class="form-control select2" name="divname" id="divname">
</select>
<span class="formerror" id="divnameerror"></span>
<?php if(isset($division) && !empty($division)){ echo "<p style='color:red'> Candidate Applied For <b>$division</b> </p>";} ?>
</div>

</div>

<div class="form-group row">
<label class="col-lg-3 col-form-label">State</label>
<div class="col-lg-9">
<select class="form-control select2" name="cmpstate" id="cmpstate">
<option value="">Select State</option>
<?php foreach ($states as $key => $stvalue) { ?>
	<option value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
<?php } ?>
</select>
<span class="formerror" id="cmpstateerror"></span>
</div>
</div>

<div class="form-group row">
	<label class="col-lg-3 col-form-label"></label>
	<div class="col-lg-9">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" id ="inoutid1" name="inoutid" value="1" >
			<label class="form-check-label">
				In Branch
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" id ="inoutid2" name="inoutid" value="2">
			<label class="form-check-label">
				Outside Branch 
			</label>
		</div>
		<span class="formerror" id="inoutiderror"></span>
	</div>
</div>
														
<div class="form-group row altbranch">
<label class="col-lg-3 col-form-label">Alternate Branch</label>
<div class="col-lg-9">
<input type="text" class="form-control" name="altbranch" id="altbranch" autocomplete="off">
<span class="formerror" id="altbrancherror"></span>
</div>
</div>

<div class="form-group row branch">
<label class="col-lg-3 col-form-label">Branch</label>
<div class="col-lg-9">
<select class="form-control select2" name="brname[]" id="brname" multiple style="width:100%" >
</select>
<span class="formerror" id="brnameerror"></span>
</div>
</div>

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
</select>
<span class="formerror" id="departmentnameerror"></span>
</div>
</div>



<div class="form-group row">
<label class="col-lg-3 col-form-label">Designation</label>
<div class="col-lg-9">
<select class="form-control select2" name="designationname" id="designationname" >
<option value="">-- Select Designation  --</option>
<?php foreach ($designationdetails as $key => $desgvalue) { ?>
	<option value="<?php echo $desgvalue->mxdesg_id ?>"><?php echo $desgvalue->mxdesg_name ?></option>
<?php } ?>

</select>
<span class="formerror" id="designationnameerror"></span>
</div>
</div>


<div class="form-group row">
<label class="col-lg-3 col-form-label">Keywords</label>
<div class="col-lg-9">
<input type="text" class="form-control" name="keywords" id="keywords" >
<span class="formerror" id="keywordserror"></span>
</div>
</div>


</div>

</div>


<ul class="nav nav-tabs nav-tabs-solid nav-justified">
<!--<li class="nav-item"><a class="nav-link active" id="personalinformation" href="#solid-justified-tab1" data-toggle="tab">Personal Information</a></li>-->
<!--<li class="nav-item"><a class="nav-link" id="familyinformation" href="#solid-justified-tab2" data-toggle="tab">Family Details</a></li>-->
<!--<li class="nav-item"><a class="nav-link" id="previousempinformation" href="#solid-justified-tab3" data-toggle="tab">Previous Employment</a></li>-->

<!--<li class="nav-item"><a class="nav-link" id="addressinformation" href="#solid-justified-tab4" data-toggle="tab">Address</a></li>-->
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
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label>Candidate Name:</label>
						<input type="text" class="form-control" name="empfname" id="empfname" autocomplete="off" value=<?php echo $name; ?>>
						<span class="formerror" id="empfnameerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Email:</label>
					<input type="email" class="form-control" name="empemail" id="empemail" autocomplete="off" value=<?php echo $email; ?>>
					<span class="formerror" id="empemailerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Mobile:</label>
					<input type="number" class="form-control" name="empmobile" id="empmobile" autocomplete="off" value=<?php echo $mobile; ?>>
					<span class="formerror" id="empmobileerror"></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>ALT Mobile:</label>
					<input type="number" class="form-control" name="empaltmobile" id="empaltmobile" autocomplete="off" value=<?php echo $mobile; ?>>
					<span class="formerror" id="empaltmobileerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Gender</label><br>
				
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="empgender" value="Male" checked>
						<label class="form-check-label">
							Male
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="empgender" value="Female">
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
					<?php foreach ($language as $key1 => $lgvalue1) { ?>
									<option value="<?php echo $lgvalue1->mxlg_id ?>"><?php echo $lgvalue1->mxlg_name ?></option>
								<?php } ?>
							</select>
					<span class="formerror" id="empmtongueerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Date Of Birth:</label>
					<input type="text" class="form-control datetimepicker" name="empdob" id="empdob" autocomplete="off">
					<span class="formerror" id="empdoberror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Age:</label>
					<input type="text" class="form-control" name="empage" id="empage" autocomplete="off" readonly>
					<span class="formerror" id="empageerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Marital Status:</label>
					<select class="form-control select2 marital" name="empmarital" id="empmarital">
						<option value="">Select Marital Status</option>
						<option value="Married">Married</option>
						<option value="UnMarried">UnMarried</option>
					</select>
					<span class="formerror" id="empmaritalerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Native:</label>
					<input type="text" class="form-control" name="empnative" id="empnative" autocomplete="off">
					<span class="formerror" id="empnativeerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Expected Salary:</label>
					<input type="number" class="form-control" name="empsalary" id="empsalary" placeholder=" Salary Expected " autocomplete="off">
					<span class="formerror" id="empsalaryerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Resume Received Date:</label>
					<input type="text" class="form-control datetimepicker" name="empresumedate" id="empresumedate" autocomplete="off" value=<?php echo $resumedate; ?>>
					<span class="formerror" id="empresumedateerror"></span>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>Candidate Resume:</label>
					<input type="file" class="form-control" name="candidateresume" id="candidateresume" autocomplete="off">
					<span class="formerror" id="candidateresumeerror"></span>
				
					
					</div>
				</div>
				
					<div class="col-md-1">
					<div class="form-group" style='margin-top: 40px;'>
					<?php if(isset($resume) && !empty($resume)){ echo "<a class='link attach-icon' target='_blank' href='$resume'><img src='https://maxwelllogistics.net/maxwellhrms/assets/img/attachment.png'></a>";} ?>	    
					</div>
					</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<label>Prefered Location:</label>
					<input type="text" class="form-control" name="candidatepreferedlocation" id="candidatepreferedlocation" autocomplete="off">
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
			<!--<div class="col-md-12" class="lang_div" id="lang_div">-->
			<!--	<div class="row" id="div_1">-->
			<!--		<div class="col-md-3">-->
			<!--			<div class="form-group">-->
			<!--				<label>Language1:</label>-->
			<!--				<select class="form-control select2" name="emplanguage_1" id="emplanguage_1">-->
			<!--					<option value="">Select Language</option>-->
			<!--					<?php foreach ($language as $key => $lgvalue) { ?>-->
			<!--						<option value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>-->
			<!--					<?php } ?>-->
			<!--				</select>-->
			<!--				<span class="formerror" id="emplanguageerror_1"></span>-->
			<!--			</div>-->
			<!--		</div>-->

			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Speak:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empspeak_speak_1" id="empspeak_speak_1" value="1">-->
			<!--			</div>-->
			<!--		</div>-->
			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Read:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empread_read_1" id="empread_read_1" value="1">-->
			<!--			</div>-->
			<!--		</div>-->
			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Write:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empwrite_write_1" id="empwrite_write_1" value="1">-->
			<!--			</div>-->
			<!--		</div>-->

			<!--	</div>-->


			<!--	<div class="row" id="div_1">-->
			<!--		<div class="col-md-3">-->
			<!--			<div class="form-group">-->
			<!--				<label>Language2:</label>-->
			<!--				<select class="form-control select2" name="emplanguage_2" id="emplanguage_2">-->
			<!--					<option value="">Select Language</option>-->
			<!--					<?php foreach ($language as $key => $lgvalue) { ?>-->
			<!--						<option value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>-->
			<!--					<?php } ?>-->
			<!--				</select>-->
			<!--				<span class="formerror" id="emplanguageerror_2"></span>-->
			<!--			</div>-->
			<!--		</div>-->

			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Speak:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empspeak_speak_2" id="empspeak_speak_2" value="1">-->
			<!--			</div>-->
			<!--		</div>-->
			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Read:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empread_read_2" id="empread_read_2" value="1">-->
			<!--			</div>-->
			<!--		</div>-->
			<!--		<div class="col-md-2">-->
			<!--			<div class="form-group">-->
			<!--				<label>Write:</label>-->
			<!--				<input class="form-control col-md-2" type="checkbox" name="empwrite_write_2" id="empwrite_write_2" value="1">-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
		</div>
	</div>
	<!-------------END LANGUAGES---------------->

</div>
</div>
</div>
</div>

<!-- Accademic deatils -->
<!--<div class="row">-->
<!--<div class="col-md-12">-->
<!--<div class="card mb-0">-->
<!--<div class="card-header">-->
<!--	<h4 class="card-title mb-0">Academic Records</h4>-->
<!--</div>-->
<!--<div class="card-body">-->
<!--	<div class="row">-->
<!--		<div class="col-xl-12">-->
<!--			<div class="row">-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>Type:</label>-->
<!--						<select class="form-control" name="empacrtype[]" id="empacrtype">-->
<!--							<option value="">Select</option>-->
<!--							<option value="General">General</option>-->
<!--							<option value="Professional">Professional</option>-->
<!--							<option value="NON Mertic">NON Mertic</option>-->
<!--							<option value="Mertic">Mertic</option>-->
<!--							<option value="SSC">SSC</option>-->
<!--							<option value="Inter">Inter</option>-->
<!--							<option value="Degree">Degree</option>-->
<!--							<option value="Diploma">Diploma</option>-->
<!--							<option value="PHD">PHD</option>-->
<!--							<option value="Senior Secondary">Senior Secondary</option>-->
<!--						</select>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>Year of Passing:</label>-->
<!--						<input type="text" class="form-control" name="empacryop[]" id="empacryop" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>Institution:</label>-->
<!--						<input type="text" class="form-control" name="empacrinstitution[]" id="empacrinstitution" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>Subject:</label>-->
<!--						<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>University:</label>-->
<!--						<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-1">-->
<!--					<div class="form-group">-->
<!--						<label>Marks%:</label>-->
<!--						<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->

<!--				<div class="col-md-1">-->
<!--					<div class="form-group">-->
<!--						<label>&nbsp;</label>-->
<!--						<button type="button" class="form-control btn btn-info add_ar_file"><i class="fa fa-plus"></i></button>-->
<!--					</div>-->
<!--				</div>-->


<!--			</div>-->
<!--			<span class="addardetails"></span>-->

<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
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

	<div class="row">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Company Type:</label>
						<select class="form-control" name="refrencecmptype" id="refrencecmptype">
                            <?php echo $controller->display_options('ats_refrencecmptype',''); ?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Refrence Name:</label>
						<input type="text" class="form-control" name="refrencename" id="refrencename" autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Relation With Candidate:</label>
						<input type="text" class="form-control" name="refrencenwcnd" id="refrencenwcnd" autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Mobile:</label>
						<input type="number" class="form-control" name="refrencemobile" id="refrencemobile" autocomplete="off">
					</div>
				</div>

			</div>

		</div>
	</div>

</div>
</div>
</div>
</div>
<!-- Refrence Details -->
<br>
<!-- Previous Employment -->
<div class="row">
<div class="col-md-12">
<div class="card mb-0">
<div class="card-header">
	<h4 class="card-title mb-0">Previous Employment</h4>
</div>
<div class="card-body">
	<div class="row">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Period From - To:</label>
						<input type="text" class="form-control" name="emppreviousprediofromto[]" id="emppreviousprediofromto" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Name & Orgination:</label>
						<textarea class="form-control" name="emppreviousorgnation[]" id="emppreviousorgnation"></textarea>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Desg Joining Time:</label>
						<input type="text" class="form-control" name="emppreviousdesgjointime[]" id="emppreviousdesgjointime" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Desg Leaving Time:</label>
						<input type="text" class="form-control" name="emppreviousleavingtime[]" id="emppreviousleavingtime" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Reported To (Desgn):</label>
						<input type="text" class="form-control" name="emppreviousreportedto[]" id="emppreviousreportedto" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Salary per month:</label>
						<input type="text" class="form-control" name="empprevioussalarypermonth[]" id="empprevioussalarypermonth" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Other Benfits:</label>
						<input type="text" class="form-control" name="emppreviousotherbenfits[]" id="emppreviousotherbenfits" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Reason For Change:</label>
						<input type="text" class="form-control" name="emppreviousreasonchange[]" id="emppreviousreasonchange" autocomplete="off">
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>&nbsp;</label>
						<input type="hidden" name="mx_rec_jobid" id="mx_rec_jobid" value="<?php echo $jobid; ?>">
                        <input type="hidden" name="mx_rec_jobunique_id" id="mx_rec_jobunique_id" value="<?php echo $uniquejobid; ?>">
						<button type="button" class="form-control btn btn-info add_pre_file"><i class="fa fa-plus"></i></button>
					</div>
				</div>

			</div>
			<span class="addpredetails"></span>
		</div>
	</div>
<div class="text-right">
	<button type="submit" class="btn btn-primary" id="processempdata">Submit</button>
</div>

</div>
</div>
</div>
</div>
<!-- Previous Employment -->

</div>
<!-- Personal Details -->

<!-- Address -->
<!--<div class="tab-pane" id="solid-justified-tab4">-->
<!-- Address -->
<!--<div class="row">-->
<!--<div class="col-xl-6 d-flex">-->
<!--<div class="card flex-fill">-->
<!--<div class="card-header">-->
<!--	<h4 class="card-title mb-0">Present Address</h4>-->
<!--</div>-->
<!--<div class="card-body">-->

<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address 1</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="emppreaddress1" id="emppreaddress1" autocomplete="off">-->
<!--			<span class="formerror" id="emppreaddress1error"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address 2</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="emppreaddress2" id="emppreaddress2" autocomplete="off">-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">City</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empprecity" id="empprecity" autocomplete="off">-->
<!--			<span class="formerror" id="empprecityerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">State</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empprestate" id="empprestate" autocomplete="off">-->
<!--		</div>-->
<!--		<span class="formerror" id="empprestateerror"></span>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Country</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empprecountry" id="empprecountry" autocomplete="off">-->
<!--			<span class="formerror" id="empprecountryerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Postal Code</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empprepostalcode" id="empprepostalcode" autocomplete="off">-->
<!--			<span class="formerror" id="empprepostalcodeerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address Since</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="emppresince" id="emppresince" autocomplete="off">-->
<!--			<span class="formerror" id="emppresinceerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="text-right">-->
<!--		<div class="form-group">-->
<!--			<label>Click On Below To Copy Persent Details As Permanent Details:</label>-->
<!--			<input class="form-control col-md-1 text-right copyaddress" onclick="CopyAddress()" id="copyaddress" type="checkbox">-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

<!--<div class="col-xl-6 d-flex">-->
<!--<div class="card flex-fill">-->
<!--<div class="card-header">-->
<!--	<h4 class="card-title mb-0">Permanent Address</h4>-->
<!--</div>-->
<!--<div class="card-body">-->

<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address 1</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedaddress1" id="empfixedaddress1" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedaddress1error"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address 2</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedaddress2" id="empfixedaddress2" autocomplete="off">-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">City</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedcity" id="empfixedcity" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedcityerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">State</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedstate" id="empfixedstate" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedstateerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Country</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedcountry" id="empfixedcountry" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedcountryerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Postal Code</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedpostalcode" id="empfixedpostalcode" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedpostalcodeerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="form-group row">-->
<!--		<label class="col-lg-3 col-form-label">Address Since</label>-->
<!--		<div class="col-lg-9">-->
<!--			<input type="text" class="form-control" name="empfixedpresince" id="empfixedpresince" autocomplete="off">-->
<!--			<span class="formerror" id="empfixedpresinceerror"></span>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!-- Address -->
<!--</div>-->
<!-- Address -->
<!-- Family Information -->
<!--<div class="tab-pane" id="solid-justified-tab2">-->
<!--<div class="row">-->
<!--<div class="col-md-12">-->
<!--<div class="card mb-0">-->
<!--<div class="card-header">-->
<!--	<h4 class="card-title mb-0">Family Information</h4>-->
<!--</div>-->
<!--<div class="card-body">-->

<!--	<div class="row">-->
<!--		<div class="col-xl-12">-->
<!--			<div class="row">-->
<!--				<div class="col-md-3">-->
<!--					<div class="form-group">-->
<!--						<label>Relation:</label>-->
<!--						<select class="form-control" name="empfmrelation[]" id="empfmrelation">-->
<!--							<option value="">Select Relation</option>-->
<!--							<option value="Father">Father</option>-->
<!--							<option value="Mother">Mother</option>-->
<!--							<option value="Brother">Brother</option>-->
<!--							<option value="Sister">Sister</option>-->
<!--							<option value="Husband">Husband</option>-->
<!--							<option value="Wife">Wife</option>-->
<!--							<option value="Children">Children</option>-->
<!--						</select>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<div class="form-group">-->
<!--						<label>Name:</label>-->
<!--						<input type="text" class="form-control" name="empfmname[]" id="empfmname" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-1">-->
<!--					<div class="form-group">-->
<!--						<label>Age:</label>-->
<!--						<input type="text" class="form-control" name="empfmage[]" id="empfmage" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<div class="form-group">-->
<!--						<label>Occupation:</label>-->
<!--						<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" autocomplete="off">-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<div class="form-group">-->
<!--						<label>&nbsp;</label>-->
<!--						<button type="button" class="form-control btn btn-info add_project_file">Add More</button>-->
<!--					</div>-->
<!--				</div>-->


<!--			</div>-->
<!--			<span class="addfmdetails"></span>-->
<!--		</div>-->
<!--	</div>-->

<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!-- Family Information -->


</div>
</div>
</div>
</div>
</div>

</form>

</div>
</div>
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

// <script>
// var languages = '<?php echo json_encode($language); ?>';
// languages = JSON.parse(languages);
// </script>

<script src="<?php echo base_url() ?>assets/js/formsjs/recuirtmenthtml.js"></script>
<script>
var emp = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/recuruitment.js"></script>

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

// <script>
// function CopyAddress() {
// var cpaddress = $('.copyaddress').is(':checked');
// if (cpaddress == true) {
// var add1 = $("#emppreaddress1").val();
// $("#empfixedaddress1").val(add1);
// var add12 = $("#emppreaddress2").val();
// $("#empfixedaddress2").val(add12);
// var addcity = $("#empprecity").val();
// $("#empfixedcity").val(addcity);
// var addstate = $("#empprestate").val();
// $("#empfixedstate").val(addstate);
// var addcountry = $("#empprecountry").val();
// $("#empfixedcountry").val(addcountry);
// var addemppstcode = $("#empprepostalcode").val();
// $("#empfixedpostalcode").val(addemppstcode);
// } else {
// $("#empfixedaddress1").val('');
// $("#empfixedaddress2").val('');
// $("#empfixedcity").val('');
// $("#empfixedstate").val('');
// $("#empfixedcountry").val('');
// $("#empfixedpostalcode").val('');

// }
// }
// </script>

