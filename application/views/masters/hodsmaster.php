			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Hod's Master</h3>
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
								<div class="col-auto float-right ml-auto">
									<button class="btn add-btn add_hods"><i class="fa fa-plus"></i> Add More</button>
								</div>
								<div class="card-body">
									<form id="processhoddetails">

										<div class="row">
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Company <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 cmp_data" placeholder="Company name" name="cmpname[]" id="cmpname_1" autocomplete="off">
														<option value="" data-cmpid="">Select Company</option>
														<?php
														foreach ($cmpmaster as $cmp) {
															echo "<option value=\"$cmp->mxcp_id~$cmp->mxcp_name\" data-cmpid=\"$cmp->mxcp_id\">$cmp->mxcp_name</option>";
														}
														?>

													</select>
													<span class="formerror" id="cmpnameerror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Division <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 division_data" placeholder="Company Division" name="cmpdivision[]" id="cmpdivision_1" autocomplete="off"></select>
													<span class="formerror" id="cmpdiverror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Branch <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 branch_data" placeholder="Company Branch" name="cmpbranch[]" id="cmpbranch_1" autocomplete="off"></select>
													<span class="formerror" id="cmpbrancherror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Department <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 dept_data" placeholder="Department" name="department[]" id="department_1" autocomplete="off"></select>
													<span class="formerror" id="departmenterror_1"></span>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-form-label">Empolyees <span class="text-danger">*</span></label>
													<select type="text" class="form-control select2 emp_data" placeholder="Empolyees" name="employees[]" id="employees_1" autocomplete="off"></select>
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

					<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Hod's List</h4>
								</div>
							   <?php //print_r($hod_master);?>

								<div class="card-body">

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company Name</th>
													<th>Branch Name</th>
													<th>Department</th>
													<th>HOD Emp Code</th>
													<th>HOD Emp Name</th>
													<th>Action</th>
													<th>Edit</th> 
												</tr>
											</thead>
											<tbody>
												<?php foreach ($hod_master as $key => $hod_data) { ?>
													<tr>
														<td><?php echo $hod_data->mxhod_comp_name ?></td>
														<td><?php echo $hod_data->mxhod_branch_name ?></td>
														<td><?php echo $hod_data->mxhod_dept_name ?></td>
														<td><?php echo $hod_data->mxhod_emp_code ?></td>
														<td><?php echo $hod_data->mxhod_emp_name ?></td>
														<?php if($hod_data->mxhod_status == 1){?>
															<td><input type="button" class="submit_btn"  id="submit_<?php echo $hod_data->mxhod_id ?>" value="In_Active" name="<?php echo $hod_data->mxhod_id ?>"></td>
														<?php }else{ ?>
															<td><input type="button" class="submit_btn"  id="submit_<?php echo $hod_data->mxhod_id ?>" value="Active" name="<?php echo $hod_data->mxhod_id ?>"></td>
														<?php } ?>
														 <td>
															<div class="dropdown dropdown-action">
																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item" href="<?php echo base_url() ?>admin/edithod/<?php echo $hod_data->mxhod_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<!--	<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php //echo $hod_data->mxhod_id . '~' . $hod_data->mxhod_emp_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
																</div>
															</div>
														</td>
														<!-- <td>
															<div class="dropdown dropdown-action">
																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item" href="<?php // echo base_url() ?>admin/editbranch/<?php echo $hod_data->mxhod_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																	<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $hod_data->mxhod_id . '~' . $hod_data->mxhod_emp_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
																</div>
															</div>
														</td> -->
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

			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Branch</h3>
								<h3 style="color: red" id="delbrname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
							<input type="hidden" name="deletemainid" id="delbrid">
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata">Delete</a>
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
			<!-- /Delete Department Modal -->
			<script>
				var cmp_master = '<?php echo json_encode($cmpmaster); ?>'
			</script>
			<script src="<?php echo base_url(); ?>assets/js/formsjs/hod.js"></script>