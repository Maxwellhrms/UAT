			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Your Designation Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Designation Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Edit Designation Details</h4>
								</div>
								<div class="card-body">
									<form id="processdesignationdetails">
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Company Name</label>
													<div class="col-lg-9">
												<select class="form-control select2" name="cmpname" id="cmpname">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) {
														if($cmpvalue->mxcp_id == $designationdetails[0]->mxdesg_comp_id){
															$sel = 'selected';
														}else{
															$sel = '';
														}
													 ?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel ?> ><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="cmpnameerror"></span>
													</div>
												</div>
											</div>
											<input type="hidden" name="id" value="<?php echo $designationdetails[0]->mxdesg_id ?>">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Grade Name</label>
													<div class="col-lg-9">
														<select class="form-control select select2" name="gradename" id="gradename">
															<option value="">Select Grade Name</option>
															<?php foreach ($grademaster as $key => $grvalue) {
														if($grvalue->mxgrd_id == $designationdetails[0]->mxdesg_grade_id){
															$sel = 'selected';
														}else{
															$sel = '';
														}
															 ?>
															<option value="<?php echo $grvalue->mxgrd_id .'~'. $grvalue->mxgrd_name ?>" <?php echo $sel ?> ><?php echo $grvalue->mxgrd_name ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="gradenameerror"></span>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Designation Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="designationname" id="designationname" value="<?php echo $designationdetails[0]->mxdesg_name ?>" >
													</div>
													<span class="formerror" id="designationnameerror"></span>
												</div>
											</div>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>			
			</div>
			<!-- /Main Wrapper -->

<script>
	var des = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/designation.js"></script>