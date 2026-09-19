
<?php
$emp = array();
foreach($allemployeedetails as $key => $m){
    $emp[$m->mxemp_emp_id] = $m->mxemp_emp_fname .' '. $m->mxemp_emp_lname . ' ('.$m->mxemp_emp_id.')';
}
$emp['888666'] = 'Developers Login (888666)';
?>
<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Schedule Interviews</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
					<li class="breadcrumb-item active">Schedule Interviews</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<br>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Schedule Interview to ( Mr/Ms : <span style="color:red;"><?php echo $rcinfo[0]->mx_rec_name ?></span>, Application : <span style="color:red;"><?php echo $rcinfo[0]->mx_rec_application ?> )</span></h4>
					</div>
					<div class="card-body">
						<form id="processrecruitment">
							<div class="row">
								<div class="col-md-6">
									<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Scheduled Date:</label>
												<input type="text" name="scheduleddate" id="scheduleddate" class="form-control datetimepicker" required="">
												<span class="formerror" id="scheduleddateerror"></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Interview Date:</label>
												<input type="text" name="interviewdate" id="interviewdate" class="form-control datetimepicker" required="">
												<span class="formerror" id="interviewdateerror"></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Interviewer:</label>
												<select name="interviewer" id="interviewer" class="form-control select2" required=""></select>
												<span class="formerror" id="interviewererror"></span>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label>Type Of Interview:</label>
												<select name="interviewetype" id="interviewetype" class="form-control select2" required="">
													<option value="">Select Interview Type</option>
													<option value="Walk_In">Walk In</option>
													<option value="Telephonic">Telephonic</option>
													<option value="Skype_Call">Skype Call</option>
													<option value="Zoom_Call">Zoom Call</option>
												</select>
												<span class="formerror" id="interviewetypeerror"></span>
											</div>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Division:</label>
												<select name="divison" id="divison" class="form-control select2" required="">
     													<option value="">Select Division</option>
													<?php 
    												foreach ($divisions as $key => $value) {
        											echo "<option value=".$value->mxd_id.">".$value->mxd_name."</option>";
    												}
													?>
												</select>
												<span class="formerror" id="divisonerror"></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Branch:</label>
												<select name="branch" id="branch" class="form-control select2" required=""></select>
												<span class="formerror" id="brancherror"></span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>Recruitment Stages:</label>
												<select name="interviewstage" id="interviewstage" class="form-control select2" required="">
                                                <?php echo $controller->display_options('ats_recruitmentstages',''); ?>
												</select>
												<span class="formerror" id="interviewetypeerror"></span>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="text-right">
								<input type="hidden" name="reccompanyid" value="<?php echo $rcinfo[0]->mx_rec_comp_code ?>">
								<input type="hidden" name="recapplicationid" value="<?php echo $rcinfo[0]->mx_rec_application ?>">
								<input type="hidden" name="recname" value="<?php echo $rcinfo[0]->mx_rec_name ?>">
								<input type="hidden" name="recemail" value="<?php echo $rcinfo[0]->mx_rec_email ?>">
								<input type="hidden" name="recphone" value="<?php echo $rcinfo[0]->mx_rec_phone_no ?>">
								<input type="hidden" name="recaltphone" value="<?php echo $rcinfo[0]->mx_rec_alt_phn_no ?>">
								<input type="hidden" name="recprocessstatus" value="<?php echo $rcinfo[0]->mx_rec_process_status ?>">
								<button type="submit" class="btn btn-primary">Get Details</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<!-- Data Tables -->
	<div class="row" style="margin-top: 10px;">
		<div class="col-sm-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Intreviewer Status</h4>
				</div>
				<div class="card-body">	

					<div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
							<thead>
								<tr>
								    <th>Application</th>
								    <th>Scheduled From</th>
								    <th>Intreview Stage</th>
									<th>Edit</th>
									
									<th>Status</th>
									
									
									<th>Interviewer</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Scheduled</th>
									<th>Interview</th>
									<th>Division</th>
									<th>Branch</th>
									<th>Company</th>
								</tr>
							</thead>
							<tbody>
								<?php if(count($resumedetails) > 0){ ?>
									<?php foreach ($resumedetails as $key => $value) { ?>
								<tr>
								    <td><?php echo $value->mx_rec_process_application_id ?></td>
								    <td><?php //echo $value->mx_rec_process_createdby
								    	if(array_key_exists($value->mx_rec_process_createdby, $emp)){
											echo $emp[$value->mx_rec_process_createdby];
										}
								    ?></td>
								    <td><?php echo $value->mx_rec_intreview_stages ?></td>
									<td>
									<a class="btn btn-info" data-target="#updateinfo" data-toggle="modal" style="color: #fff;" onclick="getdetails('<?php echo $value->mx_rec_process_application_id ?>','<?php echo $value->mx_rec_process_id ?>')">Review</a>
									</td>
									
									<td>
									<?php $processstatus = array("1"=> "Pending", "2"=>"In Process", "3"=> "Proceed For Next Round", "4"=> "Rejected", "5"=> "HR", "6"=> "Selected", "7" => "Scheduled",  "8" => "Back Ground Verification", "9" => "Black List", "10" => "Selected But Rejected By Candidate");

										if(array_key_exists($value->mx_rec_process_interviewe_status, $processstatus)){
											echo $processstatus[$value->mx_rec_process_interviewe_status];
										}
									 ?>		
									</td>
									
									
									<td><?php echo $value->mx_rec_process_interviewer_name .' - '. $value->mx_rec_process_interviewer_employee_code ?></td>
									<td><?php echo $value->mx_rec_process_recname ?></td>
									<td><?php echo $value->mx_rec_process_recphone ?></td>
									<td><?php echo $value->mx_rec_process_recemail ?></td>
									<td><?php echo $value->mx_rec_process_scheduleddate ?></td>
									<td><?php echo $value->mx_rec_process_interviewdate ?></td>
									<td><?php echo $value->mxd_name ?></td>
									<td><?php echo $value->mxb_name ?></td>
									<td><?php echo $value->mxcp_name ?></td>
								</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Data Tables -->

</div>
</div>
<!-- /Page Wrapper -->

				<div id="updateinfo" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Interview Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<div class="modal-body">
								<div id="openrviewscreen"></div>
							</div>


						</div>
					</div>
				</div>

<script>
	$( "#divison" ).change(function() {
	    event.preventDefault();
	  	var divid = $("#divison").val();

	    $.ajax({
	        url: baseurl+'recruitment/getbranch',
	        type: 'POST',
	        data: {divisionid : divid},
	        success: function (data) {
	        $("#branch").html(data);
	    	},
		});
	});

	$( "#branch" ).change(function() {
		event.preventDefault();
	  	var divid = $("#divison").val();
	  	var brid = $("#branch").val();
	  	var cmpid = '<?php echo $rcinfo[0]->mx_rec_comp_code ?>';
	    $.ajax({
	        url: baseurl+'recruitment/getrecemployees',
	        type: 'POST',
	        data: {divisionid : divid, branchid : brid, companyid : cmpid},
	        success: function (data) {
	        $("#interviewer").html(data);
	    	},
		});
	});

$("form#processrecruitment").submit(function(e) {
	e.preventDefault();  

	mainurl = baseurl+'recruitment/saverecruitmentprocess';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
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

function getdetails(app, id){
	event.preventDefault();
	    $.ajax({
	        url: baseurl+'recruitment/getintreviewprocessdetails',
	        type: 'POST',
	        data: {applicationid : app, uniqueid : id},
	        success: function (data) {
	        	// console.log(data);
	        $("#openrviewscreen").html(data);
	    	},
		});
}										
</script>