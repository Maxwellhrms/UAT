<!--<link rel="stylesheet" href="<?php //echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.css">-->
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Job Details</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active">Job Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-8">
							<div class="job-info job-widget">
								<h3 class="job-title"><?php echo $jobsdata[0]->mxrc_job_title ?></h3>
								<span class="job-dept"><?php echo $jobsdata[0]->mxrc_department ?></span>
								<ul class="job-post-det">
									<li><i class="fa fa-calendar"></i> Post Date: <span class="text-blue"><?php echo date('d-M-Y',strtotime($jobsdata[0]->mxrc_job_start_date)); ?></span></li>
									<li><i class="fa fa-calendar"></i> Last Date: <span class="text-blue"><?php echo date('d-M-Y',strtotime($jobsdata[0]->mxrc_job_end_date)); ?></span></li>
								</ul>
							</div>
							<div class="job-content job-widget">
								<div class="job-desc-title"><h4>Job Description</h4></div>
								<div class="job-description">
									<p><?php echo $jobsdata[0]->mxrc_job_description ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="job-det-info job-widget">
								
								<div class="info-list">
									<span><i class="fa fa-bar-chart"></i></span>
									<h5>Job Type</h5>
									<p><?php echo $jobsdata[0]->mxrc_job_type ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-money"></i></span>
									<h5>Salary</h5>
									<p><?php echo $jobsdata[0]->mxrc_salary_from .'-'. $jobsdata[0]->mxrc_salary_to ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-suitcase"></i></span>
									<h5>Experience</h5>
									<p><?php echo $jobsdata[0]->mxrc_job_experience ?></p>
								</div>
								<div class="info-list">
									<span><i class="fa fa-ticket"></i></span>
									<h5>Vacancy</h5>
									<p><?php echo $jobsdata[0]->mxrc_job_vacancies ?></p>
								</div>
								<a class="btn job-btn" href="#" data-toggle="modal" data-target="#edit_job">Edit</a>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Edit Job Modal -->
				<div id="edit_job" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Job </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form id="jobeditmanage" method="POST">
								    <div class="row">
								         <div class="col-md-3"></div>
								        <div class="col-md-6">
											<div class="form-group">
											 	<select class="select2 form-control" style="width: 100%;" name="division" id="division">
													<?php 
														foreach($divisionjob as $keyv=>$asvalue){   
															if($keyv == $jobsdata[0]->mxrc_division_type){
            														$sel = "selected";
            													}else{
            														$sel = "";
            													}	?>
        													<option <?php echo $sel; ?> value="<?php echo $keyv; ?>" > <?php echo $asvalue; ?></option>
        											<?php	}	?>
												</select>
												<span class="formerror" id="divisionerror"></span>
											</div>
										</div>
										 <div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Title</label>
												<input class="form-control" type="text" name="jobtitle" value="<?php echo $jobsdata[0]->mxrc_job_title; ?>">
												<input class="form-control" type="hidden" name="jobid" value="<?php echo $jobsdata[0]->mxrc_id; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department</label>
												<select class="select2" name="department">
												<option value="">Select Department</option>
												<?php
												foreach($deprtjob as $asvalue){ 
													if(str_replace(' ','_',$asvalue->mxdpt_name) == str_replace(' ','_',$jobsdata[0]->mxrc_department)){
														$sel = "selected";
													}else{
														$sel = "";
													} ?>
													<option <?php echo $sel; ?> value="<?php echo str_replace(' ','_',$asvalue->mxdpt_name) ?>" > <?php echo $asvalue->mxdpt_name ?></option>
											<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Location</label>
												<input class="form-control" type="text" name="joblocation" value="<?php echo $jobsdata[0]->mxrc_job_location; ?>" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>No of Vacancies</label>
												<input class="form-control" type="text" name="novacancies" value="<?php echo $jobsdata[0]->mxrc_job_vacancies; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Experience</label>
												<input class="form-control" type="text" name="experience" value="<?php echo $jobsdata[0]->mxrc_job_experience; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Age</label>
												<input class="form-control" type="text" name="age" value="<?php echo $jobsdata[0]->mxrc_age; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary From</label>
												<input type="text" class="form-control"  name="salaryfrom" value="<?php echo $jobsdata[0]->mxrc_salary_from; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Salary To</label>
												<input type="text" class="form-control" name="salaryto" value="<?php echo $jobsdata[0]->mxrc_salary_to; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Job Type</label>
												<select class="select2" name="jobtype">
													<?php foreach($jobtp as $asvalue1){
														if($asvalue1 == $jobsdata[0]->mxrc_job_type){
															$sel = "selected";
														}else{
															$sel = "";
														} ?>
													<option <?php echo $sel; ?> value="<?php echo $asvalue1 ?>" > <?php echo $asvalue1 ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select class="select2" name="status" >
													<?php foreach($status as $asvalue2){
														if($asvalue2 == $jobsdata[0]->mxrc_job_status){
															$sel = "selected";
														}else{
															$sel = "";
														} ?>
													<option <?php echo $sel; ?> name="<?php echo $asvalue2 ?>" > <?php echo $asvalue2 ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Start Date</label>
												<input type="text" class="form-control datetimepicker" name="stdate" value="<?php echo date('d-m-Y', strtotime($jobsdata[0]->mxrc_job_start_date)); ?>" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Expired Date</label>
												<input type="text" class="form-control datetimepicker" name="expdate" value="<?php echo date('d-m-Y', strtotime($jobsdata[0]->mxrc_job_end_date)); ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>TemplateID</label>
												<input type="text" name="templateid" id="templateid" value="<?php echo $jobsdata[0]->mxrc_templateid ?>" class="form-control">
												<span class="formerror" id="templateiderror"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control " id="desc" name="description"><?php echo $jobsdata[0]->mxrc_job_description; ?></textarea>
											</div>
										</div>
									</div>
									<div class="submit-section">
									    <input type="hidden" name="mxrc_type_id" id="mxrc_type_id" value="<?php echo $jobsdata[0]->mxrc_type_id; ?>" >
									    <input type="hidden" name="divisionid" id="divisionid" value="<?php echo $jobsdata[0]->mxrc_division_type ?>" >
										<button type="submit" class="btn btn-primary edit_job_manage">Save</button>
									</div>
									</form>
								</div>
						</div>
					</div>
				</div>
				<!-- /Edit Job Modal -->
            </div>
			<!-- /Page Wrapper -->
			
<!--<script src="<?php //echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>-->
			<script>
			CKEDITOR.replace( "desc" );
 $( document ).ready(function() {
  $("form#jobeditmanage").submit(function(e) {
      	e.preventDefault(); 
  for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
  }
		var formData = new FormData(this);
		mainurl = baseurl+'recruitment/editjobmangedetails';
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
				}, 100); 
				
        	} else {
        		alert('Failed To Save Please TryAgain later');
        	}
			},
			cache: false,
			contentType: false,
			processData: false
		});		
});
 });

</script>

