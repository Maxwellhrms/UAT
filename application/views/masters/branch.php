			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Branch Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Branch Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Register New Branch</button>

<div id="demo" class="collapse">
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Branch Master Details</h4>
								</div>
								<div class="card-body">
									<form id="processbrndetails">
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
													<label class="col-lg-3 col-form-label">Zone</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="zonal_id" id="zonal_id">
															<option value="">Select Zone</option>
															
														</select>
														<span class="formerror" id="zonal_id_error"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Company State</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="cmpstate" id="cmpstate">
															<option value="">Select Company State</option>
															<?php foreach ($states as $key => $stvalue) { ?>
																<option value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="cmpstateerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<div class="col-lg-12">
														<div class="form-check form-check-inline">
														<input type="checkbox" name="headoffice" id="headoffice" value="1">
															<label class="form-check-label">
																Is Head Office
															</label>
															<span class="formerror" id="headofficeerror"></span>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input zonal_ofc" type="checkbox" name="is_zonal_ofc" id="is_zonal_ofc" value="1">
															<label class="form-check-label">
																Is Zonal Office
															</label>
															<span class="formerror" id="is_zonal_ofc_error"></span>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input area_ofc" type="checkbox" name="is_area_ofc" id="is_area_ofc" value="1">
															<label class="form-check-label">
																Is divisional office
															</label>
															<span class="formerror" id="is_area_ofc_error"></span>
														</div>
													</div>
												</div>
												<!-- <div class="form-group row">
													<div class="col-lg-9">
														<div class="checkbox">
															<label>
																<input type="checkbox" name="headoffice" id="headoffice" value="1"> Is Head Office
															</label>
														</div>
														<span class="formerror" id="headofficeerror"></span>
													</div>
												</div> -->
												<div class="form-group row card mb-0">
													<p align="center">Eligibility Criteria</p>
													<div class="radio" align="center">
														<label style="text-align:center; margin: 0 20px 0;">
															<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
															<input type="checkbox" name="esi_eligibility" value="1"> ESI
														</label>
														<label style="text-align:center; margin: 0 20px 0;">
															<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
															<input type="checkbox" name="lwf_eligibility" value="2"> LWF
														</label>
														<label style="text-align:center; margin: 0 20px 0;">
															<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
															<input type="checkbox" name="pt_eligibility" value="3"> PT
														</label>
														<!--                                                                                                    <label>
                                                                                                        <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>
                                                                                                        <input type="checkbox" name="employee_cont" value="4" checked> No Rounding
                                                                                                    </label>-->
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="brname" id="brname">
													</div>
													<span class="formerror" id="brnameerror"></span>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch Email</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="bremail" id="bremail">
													</div>
													<span class="formerror" id="bremailerror"></span>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch Address</label>
													<div class="col-lg-9">
														<textarea rows="5" cols="5" class="form-control" name="braddress" id="braddress" placeholder="Enter Address"></textarea>
													</div>
													<span class="formerror" id="braddresserror"></span>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch Short Code</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="brshortcode" id="brshortcode">
													</div>
													<span class="formerror" id="brshortcodeerror"></span>
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
<?php  } ?>
					<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Branch List</h4>
								</div>
								<div class="card-body">

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company Name</th>
													<th>Division</th>
													<th>State</th>
													<th>Is_head Office</th>
													<th>Branch Name</th>
													<th>Branch Code</th>
													<th>Branch GLocation</th>
													<th>Branch Radius</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($branchdetails as $key => $brvalue) { ?>
													<tr>
														<td><?php echo $brvalue->mxcp_name ?></td>
														<td><?php echo $brvalue->mxd_name ?></td>
														<td><?php echo $brvalue->mxb_state_name ?></td>
														<td><?php echo ($brvalue->mxb_is_head_office == 1)?"YES":"NO" ?></td>
														<td><?php echo $brvalue->mxb_name ?></td>
														<td><?php echo $brvalue->mxb_short_code ?></td>
														<td><?php echo 'Latitude - '.$brvalue->mxb_latitude .'<br> Longitude - '.$brvalue->mxb_longitude ?></td>
														<td><?php echo $brvalue->mxb_radius ?></td>
														<td>
															<div class="dropdown dropdown-action">
																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<?php if($this->session->userdata('user_role_edit') == 1){ ?><a class="dropdown-item" href="<?php echo base_url() ?>admin/editbranch/<?php echo $brvalue->mxb_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a><?php } ?>
																	<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $brvalue->mxb_id . '~' . $brvalue->mxb_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
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
				var brn = 1;
			</script>
			<script src="<?php echo base_url() ?>assets/js/formsjs/branch.js"></script>