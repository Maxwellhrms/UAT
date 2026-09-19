			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Job Applicants</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Job Applicants</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable" id="appliedjobdetails">
									<thead>
										<tr>
											<th>#</th>
											<th>Division</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Apply Date</th>
											<th>Resume</th>
											<th>Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
									    <?php $sno =1; foreach($applied as $key => $val){ ?>
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $val->mxrap_received_from; ?></td>
											<td><?php echo $val->mxrap_name; ?></td>
											<td><?php echo $val->mxrap_email; ?></td>
											<td><?php echo $val->mxrap_mobile; ?></td>
											<td><?php echo date('d-M-Y H:i:s',strtotime($val->mxrap_createdtime)); ?></td>
											<td><a href="<?php echo $val->mxrap_resume; ?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Download</a></td>
											<td>
            										<div class="form-group">
            											<select name="revalentstatus" id="revalentstatus" onchange="saverevalentstatus('<?php echo $val->mxrap_id ?>','<?php echo $val->mxrap_job_id ?>')">
            												<option value="">Status</option>
            												<!--<option value="1" <?php if($val->mxrap_revalent_status == 1){ echo 'selected'; }else{ echo ''; } ?>>Revalent</option>-->
            												<!--<option value="2" <?php if($val->mxrap_revalent_status == 2){ echo 'selected'; }else{ echo ''; } ?>>Not Revalent</option>-->
            												<option value="3" <?php if($val->mxrap_revalent_status == 3){ echo 'selected'; }else{ echo ''; } ?>>Database</option>
            											</select>
            										</div>
											</td>
											<?php if(empty($val->processstatus)){ ?>
											<?php if($val->mxrap_revalent_status != 2){ ?>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="<?php echo base_url() ?>recruitment/addrecruitmentdetails?name=<?php echo $val->mxrap_name; ?>&email=<?php echo $val->mxrap_email ?>&mobile=<?php echo $val->mxrap_mobile; ?>&resumedate=<?php echo date('d-m-Y',strtotime($val->mxrap_createdtime)); ?>&divison=<?php echo $val->mxrap_received_from; ?>&resume=<?php echo $val->mxrap_resume; ?>&jobid=<?php echo $val->mxrap_job_id; ?>&uniquejobid=<?php echo $val->mxrap_id; ?>"><i class="fa fa-clock-o m-r-5"></i> Schedule Interview</a>
														<a class="dropdown-item" onclick="del('<?php echo $val->mxrap_id ?>','<?php echo $val->mxrap_job_id ?>')"><i class="fa fa-clock-o m-r-5"></i> Delete</a>
														<?php if($val->mxrap_application_view == 1){ ?>
														<a class="dropdown-item" onclick="viewresume('<?php echo $val->mxrap_id ?>','<?php echo $val->mxrap_job_id ?>')"><i class="fa fa-clock-o m-r-5"></i> Resume Viewed</a>
														<?php } ?>
													</div>
												</div>
											</td>
											<?php } ?>
											<?php }else{ ?>
											<td>
											    <?php $processstatus = array("1"=> "Pending", "2"=>"In Process", "3"=> "Proceed For Next Round", "4"=> "Rejected", "5"=> "HR", "6"=> "Selected", "7" => "Scheduled",  "8" => "Back Ground Verification", "9" => "Black List");
            										if(array_key_exists($val->processstatus, $processstatus)){
            											echo $processstatus[$val->processstatus]; echo '<br>';
            											echo $val->mx_rec_application;
            										}
            									 ?>		
											</td>
											<?php } ?>
										</tr>
										<?php $sno++;} ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			<script>
			    function saverevalentstatus(id,jobid){
			        var currentstatus = $("#revalentstatus").val();
			        var result = confirm("Want to Update Status?");
                    if (result) {
                        $.ajax({
                	        url: baseurl+'recruitment/updaterevalentstatus',
                	        type: 'POST',
                	        data: {revstatus : currentstatus, id : id, jobid : jobid},
                	        success: function (data) {
                	            if(data == 200){
                	                alert('Sucessfully Update');
                	            }else{
                	                alert('Failed Please Try Again');
                	            }
                	    	},
                		});
                    }else{
                        return false;
                    }

			    }
			    function del(id,jobid){
			        var result = confirm("Want to Delete");
                    if (result) {
                        $.ajax({
                	        url: baseurl+'recruitment/deleteappliedjobstatus',
                	        type: 'POST',
                	        data: {id : id, jobid : jobid},
                	        success: function (data) {
                	            if(data == 200){
                	                alert('Sucessfully Deleted please reload the page');
                	            }else{
                	                alert('Failed Please Try Again');
                	            }
                	    	},
                		});
                    }
			    }
			    function viewresume(id,jobid){
			        var result = confirm("Have You Viewed");
                    if (result) {
                        $.ajax({
                	        url: baseurl+'recruitment/appliedjobsreviewed',
                	        type: 'POST',
                	        data: {id : id, jobid : jobid},
                	        success: function (data) {
                	            if(data == 200){
                	                alert('Sucessfully Viewed please reload the page');
                	            }else{
                	                alert('Failed Please Try Again');
                	            }
                	    	},
                		});
                    }
			    }
			</script>
			