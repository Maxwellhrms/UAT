			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Hod's Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Hod's Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Hod's Master Details</h4>
								</div>
								<!-- <div class="col-auto float-right ml-auto">
									<button class="btn add-btn add_hods"><i class="fa fa-plus"></i> Add More</button>
								</div> -->
								<div class="card-body">
									<form id="eidtprocesshoddetails">
										<div class="row">
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Company <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 cmp_data" placeholder="Company name" name="cmpname[]" id="cmpname_1" autocomplete="off">
														<option value="" data-cmpid="">Select Company</option>
														<!--<option value="<?php echo $hoddetails[0]->mxhod_comp_id ?>" selected ><?php echo $hoddetails[0]->mxhod_comp_name ?></option> -->
														<?php
														foreach ($cmpmaster as $cmp) {
																if ($hoddetails[0]->mxhod_comp_id == $cmp->mxcp_id) {
																	$sel = 'selected';
																} else {
																	$sel = '';
																}		?>													
															<option value="<?php echo $cmp->mxcp_id ?>" <?php echo $sel ?> ><?php echo $cmp->mxcp_name ?></option>
													<?php } ?>
													</select>
													<span class="formerror" id="cmpnameerror_1"></span>
													<input type="hidden" name="id" id="hod_id" value="<?php echo  $hoddetails[0]->mxhod_id ?>">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Division <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 division_data" placeholder="Company Division" name="cmpdivision[]" id="cmpdivision_1" autocomplete="off">
													<option value="" data-cmpid="">Select Division</option>
													<option value="<?php echo $hoddetails[0]->mxhod_div_id.'~'.$hoddetails[0]->mxhod_div_name ?>" selected ><?php echo $hoddetails[0]->mxhod_div_name ?></option></select>
													<span class="formerror" id="cmpdiverror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Branch <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 branch_data" placeholder="Company Branch" name="cmpbranch[]" id="cmpbranch_1" autocomplete="off">
													<option value="" data-cmpid="">Select Branch</option>
													<option value="<?php echo $hoddetails[0]->mxhod_branch_id.'~'.$hoddetails[0]->mxhod_branch_name ?>" selected ><?php echo $hoddetails[0]->mxhod_branch_name ?></option></select>
													<span class="formerror" id="cmpbrancherror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Department <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 dept_data" placeholder="Department" name="department[]" id="department_1" autocomplete="off">
													<option value="" data-cmpid="">Select Department</option>
													<option value="<?php echo $hoddetails[0]->mxhod_dept_id.'~'.$hoddetails[0]->mxhod_dept_name ?>" selected ><?php echo $hoddetails[0]->mxhod_dept_name ?></option></select>
													<span class="formerror" id="departmenterror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Empolyees <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 emp_data" placeholder="Empolyees" name="employees[]" id="employees_1" autocomplete="off">
													<option value="" data-cmpid="">Select Company</option>
													<option value="<?php echo $hoddetails[0]->mxhod_emp_code.'~'.$hoddetails[0]->mxhod_emp_name.'~'.$hoddetails[0]->mxhod_comp_id.'~'.$hoddetails[0]->mxhod_comp_name ?>" selected ><?php echo $hoddetails[0]->mxhod_emp_name ?></option></select>
													<span class="formerror" id="employeeserror_1"></span>
												</div>
											</div>
											<div class="col-sm-3"></div>
										</div>
										<span class="addhodsdetails"></span>
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
			<script>
				var cmp_master = '<?php echo json_encode($cmpmaster); ?>'
			</script>
			<script src="<?php echo base_url(); ?>assets/js/formsjs/hod.js"></script>