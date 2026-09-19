<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">View Recruitment Deatils</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
					<li class="breadcrumb-item active">Recruitment List</li>
				</ul>
			</div>
			<div class="col-auto float-right ml-auto">
				<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Counts</button>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<br>
	<div id="demo" class="collapse">
		<div class="row">
			<?php foreach($portalscount as $key1 => $value1){ 
				?>
			<div class="col-md-3">
				<div class="stats-info">
					<h6><?php echo $value1->mx_rec_refrence_type; ?></h6>
					<h4><?php echo $value1->count; ?></h4>
				</div>
			</div> 
		<?php } ?>
		</div>
	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Filter Recruitment</h4>
					</div>
					<div class="card-body">
						<form id="processcmpdetails" method="post" action="<?php echo base_url() ?>/recruitment/viewrecruitmentdetails">
							<div class="row">
								<div class="col-md-12">
									<div class="row">

										<div class="col-md-4">
											<div class="form-group">
												<label>From Date:</label>
												<input type="text" name="fromdate" id="fromdate" class="form-control datetimepicker" value="<?php  echo date('d-m-Y',strtotime($userinfo['fromdate'])); ?>" required="">
												<span class="formerror" id="fromdateerror"></span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>To Date:</label>
												<input type="text" name="todate" id="todate" class="form-control datetimepicker" value="<?php  echo date('d-m-Y',strtotime($userinfo['todate'])); ?>" required="">
												<span class="formerror" id="todateerror"></span>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label>Filter:</label>
												<select name="filterdata" id="filterdata" class="form-control">
												    <option value="ALL" <?php if($userinfo['filterdata'] == "ALL"){ echo 'selected'; }else{ echo ''; } ?> >ALL</option>
												    <option value="DATES" <?php if($userinfo['filterdata'] == "DATES"){ echo 'selected'; }else{ echo ''; } ?> >Dates</option>
                                                </select>
											</div>
										</div>
                                    <?php $processstatus = array("1"=> "Pending", "2"=>"In Process", "3"=> "Proceed For Next Round", "4"=> "Rejected", "5"=> "HR", "6"=> "Selected", "7" => "Scheduled", "8" => "Back Ground Verification", "9" => "Black List", "10" => "Selected But Rejected By Candidate"); ?>
										<div class="col-md-4">
											<div class="form-group">
												<label>Process Status:</label>
                                    			<select name="processstatus" id="processstatus" class="form-control select2" style="width: 100%;" autocomplete="off">
                                    				<option value="">Select Status</option>
                                    				<?php foreach($processstatus as $key1 => $value1){ 
                                    					if($key1 == $userinfo['processstatus']){
                                    						$sel = "selected";
                                    					}else{
                                    						$sel = "";
                                    					}
                                    				?>
                                    					<option value="<?php echo $key1; ?>" <?php echo $sel; ?> ><?php echo $value1; ?></option>
                                    				<?php } ?>
                                    			</select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Recruitment Type:</label>
                            					<select class="form-control" name="recruitmenttype" id="recruitmenttype" autocomplete="off">
                                                    <?php echo $controller->display_options('ats_recruitmenttype',$userinfo['recruitmenttype']); ?>
                            					</select>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="text-right">
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
					<h4 class="card-title mb-0">Recruitment List</h4>
				</div>
				<div class="card-body">	

					<div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="viewrecruitmentdetails">
							<thead>
								<tr>
								    <th>Status</th>
									<th>Application</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Company</th>
									<th>Division</th>
									<th>State</th>
									<th>Department</th>
									<th>Designation</th>
									<th>Previous Employement</th>
									<!--<th>Academic Records</th>-->
									<!--<th>Family Details</th>-->
									<th>Resume Received Date</th>
									<th>Added Date</th>
									<th>Keywords</th>
									<th>Refrence Type</th>
									<th>Refrence Details</th>
									<th>Refrence Name</th>
									<th>Refrence Mobile</th>
									<th>Refrence Relation</th>
									<th>Refrence Branch</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($info as $key => $value) { ?>
								<tr>
								    <td><a href="<?php echo base_url() ?>recruitment/recruitmentprocess/<?php echo $value->mx_rec_application; ?>">
										<?php 
										$processstatus = array("1"=> "Pending", "2"=>"In Process", "3"=> "Proceed For Next Round", "4"=> "Rejected", "5"=> "HR", "6"=> "Selected", "7" => "Scheduled",  "8" => "Back Ground Verification", "9" => "Black List", "10" => "Selected But Rejected By Candidate");

										if(array_key_exists($value->mx_rec_process_status, $processstatus)){
											echo $processstatus[$value->mx_rec_process_status];
										} ?>
										</a>
									</td>
									<td>
										<?php if(!empty($value->mx_rec_resume_link)){ ?>
										<a href="<?php echo base_url( $value->mx_rec_resume_link ) ?>"><?php echo $value->mx_rec_application ?></a>
										<?php }else{ ?>
										<a><?php echo $value->mx_rec_application ?></a>
										<?php } ?>
									</td>
									<td><?php echo $value->mx_rec_name ?></td>
									<td><?php echo $value->mx_rec_phone_no .' ( Alt Mobile -)'. $value->mx_rec_alt_phn_no ?></td>
									<td><?php echo $value->mx_rec_email ?></td>
									<td><?php echo $value->mxcp_name ?></td>
									<td><?php echo $value->mxd_name ?></td>
									<td><?php echo $value->mxst_state ?></td>
									<td><?php echo $value->mxdpt_name ?></td>
									<td><?php echo $value->mxdesg_name ?></td>
									<td><?php echo $value->previous_employments ?></td>
									<!--<td><?php echo $value->academic_records ?></td>-->
									<!--<td><?php echo $value->family_details ?></td>-->
									<td><?php echo $value->mx_rec_resume_received_date ?></td>
									<td><?php echo date('Y-m-d',strtotime($value->mx_createdtime)); ?></td>
									<td><?php echo $value->mx_rec_keywords ?></td>
									<td><?php echo $value->mx_rec_refrence_type ?></td>
									<td><span style='color:red'>Name :-</span> <?php echo $value->mx_rec_refrence_name ?>, 
									    <span style='color:red'>Mobile :-</span> <?php echo $value->mx_rec_refrence_mobile ?>, 
									    <span style='color:red'>Ref Employee :-</span> <?php echo $value->refrence_employee_name ?>, 
									    <span style='color:red'>Ref Employee Code :-</span> <?php echo $value->refrence_employee_code ?>, 
									    <span style='color:red'>Ref Employee Branch :-</span> <?php echo $value->refrencebranch ?>, 
									    <span style='color:red'>Ref Employee relation :-</span> <?php echo $value->mx_rec_refrence_relation ?>, 
									    <span style='color:red'>Ref Employee type :-</span> <?php echo $value->refrencewebsite_type ?>, 
									    <span style='color:red'>Mobile :-</span> <?php echo $value->mx_rec_refrence_mobile ?>
									</td>
									<td><?php echo $value->mx_rec_refrence_name ?></td>
									<td><?php echo $value->mx_rec_refrence_mobile ?></td>
									<td><?php echo $value->mx_rec_refrence_relation ?></td>
									<td><?php echo $value->refrencebranch ?></td>
									<td>
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo base_url() ?>recruitment/editrecruitmentdetails/<?php echo $value->mx_rec_autouniqueid ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        </div>
										</div>
									</td>
								</tr>
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
<!-- /Page Wrapper