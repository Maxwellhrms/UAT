			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Employeement Type</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Employeement Type Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employeement Type Details</h4>
								</div>
								<div class="card-body">
									<form id="employeement_form">
										<div class="row">
										<div class="col-xl-4">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Company</label>
                                                <div class="col-lg-8">
                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="emp_type_cmpid" id="emp_type_cmpid" style="width: 100%;">                                                        
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="formerror" id="emp_type_cmpid_error"></span>
                                                </div>
                                            </div>
                                        </div>
											<div class="col-xl-4">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Employee Type Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="emptyname" id="emptyname">
													</div>
													<span class="formerror" id="emptynameerror"></span>
												</div>
											</div>

											<div class="col-xl-4">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Employee Short Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="empshrtname" id="empshrtname">
													</div>
													<span class="formerror" id="empshrtnameerror"></span>
												</div>
											</div>
										</div>
										<div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="inc_is_trainees" value="1">
                                                <label class="form-check-label">
                                                    Is Trainees
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="inc_is_professionals" value="1">
                                                <label class="form-check-label">
                                                    Is Professionals
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="inc_is_directors" value="1">
                                                <label class="form-check-label">
                                                    Is Directors
                                                </label>
                                            </div>
                                            <span class="formerror" id="emp_type_error"></span>
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
				
<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employeement Type List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company Name</th>
													<th>Employee Name</th>
													<th>Employee Short Name</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($emptypedetails as $key => $descvalue) { ?>
												<tr>
													<td><?php echo $descvalue->mxcp_name ?></td>
													<td><?php echo $descvalue->mxemp_ty_name ?></td>
													<td><?php echo $descvalue->mxemp_ty_short_name ?></td>
													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url() ?>admin/editemployeementtypemaster/<?php echo $descvalue->mxemp_ty_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $descvalue->mxemp_ty_id .'~'. $descvalue->mxemp_ty_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
			<!-- /Main Wrapper -->
			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Branch</h3>
								<h3 style="color: red" id="deldesname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="deletemainid" id="deldesid">
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
	var emptype = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/employeementtype.js"></script>