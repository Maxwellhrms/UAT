			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Sub Branch Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">SUB Branch Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Sub Branch Master Details</h4>
								</div>
								<div class="card-body">
									<form id="processsubbrndetails">
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Company Name</label>
													<div class="col-lg-9">
												<select class="form-control select2" name="cmpname" id="cmpname">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="cmpnameerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Division</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="divname" id="divname">
															<option value="">Select Division</option>
													<?php foreach ($divmaster as $key => $divvalue) { ?>
														<option value="<?php echo $divvalue->mxd_id ?>"><?php echo $divvalue->mxd_name ?></option>
													<?php } ?>
														</select>
														<span class="formerror" id="divnameerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="brname" id="brname">
															<option value="">Select Branch</option>
															<?php foreach ($branchmaster as $key => $brvalue) { ?>
																<option value="<?php echo $brvalue->mxb_id ?>"><?php echo $brvalue->mxb_name ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="brnameerror"></span>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="subbrname" id="subbrname">
														<span class="formerror" id="subbrnameerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Address</label>
													<div class="col-lg-9">
														<textarea rows="5" cols="5" class="form-control" name="subbraddress" id="subbraddress" placeholder="Enter Address"></textarea>
														<span class="formerror" id="subbraddresserror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Short Code</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="subbrshortcode" id="subbrshortcode">
													</div>
													<span class="formerror" id="subbrshortcodeerror"></span>
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

<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">SubBranch List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company</th>
													<th>Division</th>
													<th>Branch</th>
													<th>Subbranch Name</th>
													<th>Subbranch Code</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($subbranchdetails as $key => $subbrvalue) { ?>
												<tr>
													<td><?php echo $subbrvalue->mxcp_name ?></td>
													<td><?php echo $subbrvalue->mxd_name ?></td>
													<td><?php echo $subbrvalue->mxb_name ?></td>
													<td><?php echo $subbrvalue->mxsb_name ?></td>
													<td><?php echo $subbrvalue->mxsb_short_code ?></td>
													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url() ?>admin/editsubbranch/<?php echo $subbrvalue->mxsb_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $subbrvalue->mxsb_id .'~'. $subbrvalue->mxsb_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
								<h3 style="color: red" id="delsubbrname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="deletemainid" id="delsubbrid">
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
	var brn = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/subbranch.js"></script>
