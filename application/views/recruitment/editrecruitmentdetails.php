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
<div class="col-md-3">
<div class="form-group">
<label>Company</label>
<select class="form-control select2" name="cmpname" id="cmpname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_comp_code; ?>"><?php echo $rec['recinfo'][0]->mxcp_name ?></option>
</select>
<span class="formerror" id="cmpnameerror"></span>
</div>
</div>

<div class="col-md-3">
<div class="form-group row">
<label>Division</label>
<select class="form-control select2" name="divname" id="divname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_division_code; ?>"><?php echo $rec['recinfo'][0]->mxd_name ?></option>
</select>
<span class="formerror" id="divnameerror"></span>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>State</label>
<select class="form-control select2" name="cmpstate" id="cmpstate">
<option value="<?php  echo $rec['recinfo'][0]->mxst_id . '@~@' . $rec['recinfo'][0]->mxst_state ?>"><?php  echo $rec['recinfo'][0]->mxst_state ?></option>
</select>
<span class="formerror" id="cmpstateerror"></span>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
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
</div>

<div class="col-md-6">
<div class="form-group altbranch">
<label>Alternate Branch</label>
<input type="text" class="form-control" name="altbranch" id="altbranch" value="<?php  echo $rec['recinfo'][0]->mx_rec_manual_branch ?>" autocomplete="off">
<span class="formerror" id="altbrancherror"></span>
</div>
</div>


<div class="col-md-6">
<div class="form-group branch">
<label>Branch  </label>
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

		 <?php
		 if($outbrsel == 'checked'){
		     echo '<script>$(".altbranch").css("display", "block");$(".branch").css("display", "none");</script>';
		 }elseif($inbrsel == 'checked'){
		     echo '<script>$(".branch").css("display", "block");$(".altbranch").css("display", "none");</script>';
		 }
		 ?>

<div class="col-md-3">
<div class="form-group">
<label>Departements</label>
<select class="form-control select2" name="departmentname" id="departmentname">
<option value="<?php echo $rec['recinfo'][0]->mx_rec_dept_code; ?>"><?php echo $rec['recinfo'][0]->mxdpt_name ?></option>
</select>
<span class="formerror" id="departmentnameerror"></span>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Designation</label>
<select class="form-control select2" name="designationname" id="designationname" >
	<option value="<?php echo $rec['recinfo'][0]->mx_rec_desg_code; ?>"><?php echo $rec['recinfo'][0]->mxdesg_name ?></option>
</select>
<span class="formerror" id="designationnameerror"></span>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Keywords</label>
<input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $rec['recinfo'][0]->mx_rec_keywords ?>">
<span class="formerror" id="keywordserror"></span>
</div>
</div>
</div>
</div>
</div>

</form>
<ul class="nav nav-tabs nav-tabs-solid nav-justified">
<li class="nav-item"><a class="nav-link active" id="personalinformation" href="#solid-justified-tab1" data-toggle="tab">Personal Information</a></li>
<li class="nav-item"><a class="nav-link" id="previousempinformation" href="#solid-justified-tab3" data-toggle="tab">Previous Employment</a></li>
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
				
								<div class="col-md-3">
					<div class="form-group">
						<label>Current Location:</label>
					<input type="text" class="form-control" name="candidatecurrentlocation" id="candidatecurrentlocation" autocomplete="off" value="<?php echo $rec['recinfo'][0]->candidatecurrentlocation; ?>">
					<span class="formerror" id="candidatecurrentlocationerror"></span>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label>Total Experience:</label>
					<input type="text" class="form-control" name="totalexperience" id="totalexperience" autocomplete="off" value="<?php echo $rec['recinfo'][0]->totalexperience; ?>">
					<span class="formerror" id="totalexperienceerror"></span>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label>Recruitment Type:</label>
					<select class="form-control" name="recruitmenttype" id="recruitmenttype" autocomplete="off">
                        <?php echo $controller->display_options('ats_recruitmenttype',$rec['recinfo'][0]->recruitmenttype); ?>
					</select>
					<span class="formerror" id="recruitmenttypeerror"></span>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<hr>
	<div class="text-right">
		<button type="submit" class="btn btn-info" style="color: #fff;">Update Personal Information</button>
	</div>
</div>
</form>	
</div>
</div>
</div>


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
						<?php echo $controller->display_options('ats_refrencecmptype',$rec['recinfo'][0]->mx_rec_refrence_type); ?>
						</select>
					</div>
				</div>
				<div class="col-md-2" id="nau_link_remove">
					<div class="form-group">
						<label>Refrence Name:</label>
						<input type="text" class="form-control" name="refrencename" id="refrencename" value="<?php echo $rec['recinfo'][0]->mx_rec_refrence_name; ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2" style="display:none" id="nau_link_open">
					<div class="form-group">
						<label>Refrence Name:</label>
						<select class="form-control" name="refrencename_website" id="refrencename_website" autocomplete="off">
						    <?php echo $controller->display_options('ats_refrencename_customwebsites',$rec['recinfo'][0]->mx_rec_refrence_name); ?>
						</select>
					</div>
				</div>
				<div class="col-md-4" style="display:none" id="open_maxwell">
					<div class="form-group">
						<label>Refrence Name:</label>
						<select class="form-control select2" style="width: 100%;" name="refrencename_maxwell" id="refrencename_maxwell" autocomplete="off">
							<?php 
							    $def = '<option value="">Select Employee</option>';
							    foreach ($allemployeedetails as $key => $value) {
							        if($rec['recinfo'][0]->refrence_employee_code == $value->mxemp_emp_id){
							            $sel = "selected";
							        }else{
							            $sel = "";
							        }
							        $name = $value->mxemp_emp_fname .' '. $value->mxemp_emp_lname;
							        $def .= "<option value=".$value->mxemp_emp_id. '~@~' . str_replace(" ", "_", $name)."  ".$sel.">".$name.' ('.$value->mxemp_emp_id.')'."</option>";
							    }
    							echo $def;
							?>
						</select>
					</div>
				</div>
				<div class="col-md-2" style="display:none" id="arc_open">
					<div class="form-group">
						<label>Refrence Branch:</label>
						<input type="text" class="form-control" name="refrencebranch" id="refrencebranch" value="<?php echo $rec['recinfo'][0]->refrencebranch ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Relation With Candidate:</label>
						<input type="text" class="form-control" name="refrencenwcnd" id="refrencenwcnd" value="<?php echo $rec['recinfo'][0]->mx_rec_refrence_relation; ?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-2" style="display:none" id="website_open">
					<div class="form-group">
						<label>Refrence Wedsite:</label>
						<select class="form-control" name="refrencewebsite_type" id="refrencewebsite_type" autocomplete="off">
						    <?php echo $controller->display_options('ats_refrencewebsite_type',$rec['recinfo'][0]->refrencewebsite_type); ?>
						</select>
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
<script>
	$("#refrencecmptype").on('change', function(){
		var va = this.value;
		if(va == 'MAXWELL'){
		    $("#open_maxwell").show();
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").hide();
		}else if(va == 'ARC'){
			$("#arc_open").show();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}else if(va == 'NAUKRI' || va == 'LINKEDIN'){
			$("#nau_link_open").show();
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_remove").hide();
			$("#open_maxwell").hide();
		}else if(va == 'WEBSITES'){
			$("#website_open").show();
			$("#arc_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}else{
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}
	});
</script>
<script>
var vars = "<?php echo $rec['recinfo'][0]->mx_rec_refrence_type ?>";
		if(vars == 'MAXWELL'){
		    $("#open_maxwell").show();
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").hide();
		}else if(vars == 'ARC'){
			$("#arc_open").show();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}else if(vars == 'NAUKRI' || vars == 'LINKEDIN'){
			$("#nau_link_open").show();
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_remove").hide();
			$("#open_maxwell").hide();
		}else if(vars == 'WEBSITES'){
			$("#website_open").show();
			$("#arc_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}else{
			$("#arc_open").hide();
			$("#website_open").hide();
			$("#nau_link_open").hide();
			$("#nau_link_remove").show();
			$("#open_maxwell").hide();
		}
</script>