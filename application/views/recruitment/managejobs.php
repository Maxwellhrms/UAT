		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">-->
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Jobs</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Jobs</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
					    <?php $single = array();
					    foreach($todaysdata as $keyd => $sn){
					        $single[$sn['mxrap_job_id']] = $sn['todayapplied'];
					    }
					    ?>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Job Title</th>
											<th>Job Location</th>
											<th>Department</th>
											<th>Start Date</th>
											<th>Expire Date</th>
											<th class="text-center">Job Type</th>
											<th class="text-center">Status</th>
											<th>Applicants</th>
											<th>Todays Count</th>
											<th>Mail/Preview</th>
										</tr>
									</thead>
									<tbody>
										<?php $sno =1; foreach ($jobsdata as $key1 => $value) { ?>
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php if($value->mxrc_division_type == 1){ echo "LOGISTICS"; }elseif($value->mxrc_division_type == 2){ echo "RELOCATIONS"; } ?></td>
											<td><a href="<?php echo base_url() ?>recruitment/viewjobdetails/<?php echo $value->mxrc_id  ?>"><?php echo $value->mxrc_job_title ?></a></td>
											<td><?php echo $value->mxrc_job_location; ?></td>
											<td><?php echo str_replace('_',' ', $value->mxrc_department); ?></td>
											<td><?php echo date('d-M-Y', strtotime($value->mxrc_job_start_date)); ?></td>
											<td><?php echo date('d-M-Y', strtotime($value->mxrc_job_end_date)); ?></td>
											<td class="text-center">
												<?php echo $value->mxrc_job_type; ?>
											</td>
											<td class="text-center">
												<?php echo $value->mxrc_job_status; ?>
											</td>
											<td><a href="<?php echo base_url() ?>recruitment/appliedcanditates/<?php echo $value->mxrc_type_id; ?>" class="btn btn-sm btn-primary"><?php echo $value->applied_count; ?> Candidates</a></td>
											<td><?php
											if(array_key_exists($value->mxrc_type_id, $single)){
											    echo $single[$value->mxrc_type_id];
											}else{
											    echo '';
											}
											?></td>
											<td>
											    <?php 
											    $type = '';
											    if($value->mxrc_division_type == 1 && !empty($value->mxrc_templateid)){ 
											    $type = "LOGISTICS";
											    }elseif($value->mxrc_division_type == 2 && !empty($value->mxrc_templateid)){ 
											    $type = "RELOCATIONS"; 
											    } ?>
											    <?php if(!empty($type)){ ?>
											    <a href="<?php echo base_url() ?>recruitment/sendmailpreview?templateid=<?php echo $value->mxrc_templateid ?>&type=<?php echo $type; ?>" class="btn btn-sm btn-primary"> Send Mails</a>
											    <?php } ?>
											</td>
										</tr>
										<?php $sno++; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Job Modal -->
				<div id="add_job" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Job</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="addjob">
								    <div class="row">
								        <div class="col-md-3"></div>
								        <div class="col-md-6">
											<div class="form-group">
												<select class="select2 form-control" style="width: 100%;" name="division" id="division">
													<option value="">Select Division</option>
													<?php 
														foreach($divisionjob as $key=>$asvalue){  ?>
        													<option value="<?php echo $key; ?>" > <?php echo $asvalue ?></option>
        											<?php	}	?>
												</select>
												<span class="formerror" id="divisionerror"></span>
											</div>
										</div>
										<div class="col-md-3"></div>
								    </div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Title</label>
												<input class="form-control" type="text" name="jobtitle" id="jobtitle">
												<span class="formerror" id="jobtitleerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department</label>
												<select class="select2 form-control" style="width: 100%;" name="department" id="department">
													<option value="">Select Department</option>
													<?php 
														foreach($deprtjob as $asvalue){ 
        												/*	<option>Web Development</option>
        													<option>Application Development</option>
        													<option>IT Management</option>
        													<option>Accounts Management</option>
        													<option>Support Management</option>
        													<option>Marketing</option> */ ?>
        													<option value="<?php echo str_replace(' ','_',$asvalue->mxdpt_name) ?>" > <?php echo $asvalue->mxdpt_name ?></option>
        											<?php	}	?>
												</select>
												<span class="formerror" id="departmenterror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Location</label>
												<input class="form-control" name="joblocation" id="joblocation" type="text">
												<span class="formerror" id="joblocationerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>No of Vacancies</label>
												<input class="form-control" name="noofvacancies" id="noofvacancies" type="text">
												<span class="formerror" id="noofvacancieserror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Experience</label>
												<input class="form-control" name="experience" id="experience" type="text">
												<span class="formerror" id="experienceerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Age</label>
												<input class="form-control" name="age" id="age" type="text">
												<span class="formerror" id="ageerror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary From</label>
												<input type="text" name="salaryfrom" id="salaryfrom" class="form-control">
												<span class="formerror" id="salaryfromerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary To</label>
												<input type="text" name="salaryto" id="salaryto" class="form-control">
												<span class="formerror" id="salarytoerror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Type</label>
												<select class="select2 form-control" name="jobtype" id="jobtype" style="width: 100%;">
												<?php foreach($jobtp as $asvalue1){ ?>
												 	<option  value="<?php echo $asvalue1 ?>" > <?php echo $asvalue1 ?></option>
											<?php 	/*  <option>Full Time</option>
													<option>Part Time</option>
													<option>Internship</option>
													<option>Temporary</option>
													<option>Remote</option>
													<option>Others</option> */
												} ?>	
												</select>
												<span class="formerror" id="jobtypeerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select class="select2 form-control" name="status" id="status" style="width: 100%;">
												    <?php  foreach($status as $asvalue2){ ?>
												    	<option name="<?php echo $asvalue2 ?>" > <?php echo $asvalue2 ?></option>
    												    <?php 
        												/*	<option>Open</option>
        													<option>Closed</option>
        													<option>Cancelled</option> */
    													} ?>
												</select>
												<span class="formerror" id="statuserror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Start Date</label>
												<input type="text" name="startdate" id="startdate" class="form-control datetimepicker">
												<span class="formerror" id="startdateerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Expired Date</label>
												<input type="text" name="expdate" id="expdate" class="form-control datetimepicker">
												<span class="formerror" id="expdateerror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>TemplateID</label>
												<input type="text" name="templateid" id="templateid" class="form-control">
												<span class="formerror" id="templateiderror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control " name="desc" id="desc" cols="10" rows="10"></textarea>
												<span class="formerror" id="descerror"></span>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
<!--<script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>-->
<script type="text/javascript">
CKEDITOR.replace( "desc" );
	$( document ).ready(function() {
  
$("form#addjob").submit(function(e) {
e.preventDefault();  

  for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
  }

var division = $("#division").val();
if(division ==""){
  $("#division").focus();
  $('#divisionerror').html("Please Enter Division");
  return false;
}else{$('#divisionerror').html("");}

var jobtitle = $("#jobtitle").val();
if(jobtitle ==""){
  $("#jobtitle").focus();
  $('#jobtitleerror').html("Please Enter Job Title");
  return false;
}else{$('#jobtitleerror').html("");}

var department = $("#department").val();
if(department ==""){
  $("#department").focus();
  $('#departmenterror').html("Please Enter Department");
  return false;
}else{$('#departmenterror').html("");}

var joblocation = $("#joblocation").val();
if(joblocation ==""){
  $("#joblocation").focus();
  $('#joblocationerror').html("Please Enter JobLocation");
  return false;
}else{$('#joblocationerror').html("");}

var noofvacancies = $("#noofvacancies").val();
if(noofvacancies ==""){
  $("#noofvacancies").focus();
  $('#noofvacancieserror').html("Please Enter No of Vacancies");
  return false;
}else{$('#noofvacancieserror').html("");}

var experience = $("#experience").val();
if(experience ==""){
  $("#experience").focus();
  $('#experienceerror').html("Please Enter Experience");
  return false;
}else{$('#experienceerror').html("");}

var age = $("#age").val();
if(age ==""){
  $("#age").focus();
  $('#ageerror').html("Please Enter Age");
  return false;
}else{$('#ageerror').html("");}

var salaryfrom = $("#salaryfrom").val();
if(salaryfrom ==""){
  $("#salaryfrom").focus();
  $('#salaryfromerror').html("Please Enter Salary From");
  return false;
}else{$('#salaryfromerror').html("");}

var salaryto = $("#salaryto").val();
if(salaryto ==""){
  $("#salaryto").focus();
  $('#salarytoerror').html("Please Enter Salary To");
  return false;
}else{$('#salarytoerror').html("");}

var jobtype = $("#jobtype").val();
if(jobtype ==""){
  $("#jobtype").focus();
  $('#jobtypeerror').html("Please Enter Job Type");
  return false;
}else{$('#jobtypeerror').html("");}

var status = $("#status").val();
if(status ==""){
  $("#status").focus();
  $('#statuserror').html("Please Enter Status");
  return false;
}else{$('#statuserror').html("");}

var startdate = $("#startdate").val();
if(startdate ==""){
  $("#startdate").focus();
  $('#startdateerror').html("Please Enter Start Date");
  return false;
}else{$('#startdateerror').html("");}

var expdate = $("#expdate").val();
if(expdate ==""){
  $("#expdate").focus();
  $('#expdateerror').html("Please Enter Expire Date");
  return false;
}else{$('#expdateerror').html("");}

var desc = $("#desc").val();
if(desc ==""){
  $("#desc").focus();
  $('#descerror').html("Please Enter Description");
  return false;
}else{$('#descerror').html("");}


// if(div == 1){
  // mainurl = baseurl+'admin/savedivisondetails';
// }else if(div == 2){
  mainurl = baseurl+'recruitment/saverecruitmentmanage';
// }

var formData = new FormData(this);
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
       console.log(data);
        if (data == 200) {
            alert('Successfully');
            setTimeout(function(){
            window.location.reload();
            }, 1000); 
        } else {
        	alert('Failed To Save Please TryAgain later');
        }
    },
    cache: false,
    contentType: false,
    processData: false
});

});

// $( "#processdeletedata" ).click(function() {
//   event.preventDefault();
//   var delcmpnameid = $('#deldivid').val();

//   $.ajax({
//       async: false,
//       type: "POST",
//       data: {id : delcmpnameid},
//       url: baseurl + 'admin/deletedivision',
//       datatype: "html",
//       success: function (data) {
//           if (data == 200) {
//             alert('Success');
//             window.location.reload();
//           }else {
//             alert('Try Again Later');
//           }
//       }
//   });

// });

});

// $(document).on("click", ".deletemodal", function () {
// var deletedetails = $(this).data('id');
// var x = deletedetails.split("~",3);
// var id = x[0];
// var companyname = x[1];
// $(".modal-body #deldivname").html(companyname);
// $(".modal-body #deldivid").val(id);
// });
</script>
				<!-- /Add Job Modal -->
				
				<!-- Edit Job Modal -->
				<div id="edit_job" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Job</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Title</label>
												<input class="form-control" type="text" value="Web Developer">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department</label>
												<select class="select2 form-control" >
													<option>-</option>
													<option selected>Web Development</option>
													<option>Application Development</option>
													<option>IT Management</option>
													<option>Accounts Management</option>
													<option>Support Management</option>
													<option>Marketing</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Location</label>
												<input class="form-control" type="text" value="California">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>No of Vacancies</label>
												<input class="form-control" type="text" value="5">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Experience</label>
												<input class="form-control" type="text" value="2 Years">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Age</label>
												<input class="form-control" type="text" value="-">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary From</label>
												<input type="text" class="form-control" value="32k">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary To</label>
												<input type="text" class="form-control" value="38k">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Type</label>
												<select class="select">
													<option selected>Full Time</option>
													<option>Part Time</option>
													<option>Internship</option>
													<option>Temporary</option>
													<option>Remote</option>
													<option>Others</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select class="select">
													<option selected>Open</option>
													<option>Closed</option>
													<option>Cancelled</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Start Date</label>
												<input type="text" class="form-control datetimepicker" value="3 Mar 2019">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Expired Date</label>
												<input type="text" class="form-control datetimepicker" value="31 May 2019">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control"></textarea>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Job Modal -->

				<!-- Delete Job Modal -->
				<div class="modal custom-modal fade" id="delete_job" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Job</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Job Modal -->
				
            </div>
			<!-- /Page Wrapper -->