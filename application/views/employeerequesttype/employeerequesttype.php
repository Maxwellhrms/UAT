<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">           
            <!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Employee Request Type</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Employee Request Type</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Employee Request</button>

<div id="demo" class="collapse">	
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Employee Request Type</h4>
									</div>
									<div class="card-body">
										<form id="emp_requesttype_form">
											<div class="row">
												<div class="col-md-6">
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
					                                            <select class="form-control select2" name="esi_company_id" id="esi_company_id"  style="width: 100%">
							                                        <option value="">-- Select Company --</option>
							                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
							                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
							                                        <?php } ?>
							                                    </select>
							                                    <span class="formerror" id="cmpnameerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<label>Division:</label>
															<select class="select2 form-control"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															<option value="">Select Division</option>
															</select>
															<span class="formerror" id="esi_div_id_error"></span>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Code:</label>
																<select type="text" name="employeeid" id="employeeid" class="form-control select2" style="width: 100%">
																	
																</select>
																<span class="formerror" id="employeeiderror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Request Type:</label>
																<select type="text" name="requesttype" id="requesttype" class="form-control select2" style="width: 100%">
                                                                <option value=""> Select Option </option>
																<?php echo $controller->display_options('act_suggestionandgrievancebox',''); ?>
                                                                    <?php /* foreach ($options_table as $key => $opt_table) { ?>
                                                                        <option value="<?php echo $opt_table->field_name ?>"><?php echo $opt_table->field_name ?></option>
                                                                    <?php } */ ?>
	                                                            </select>
																<span class="formerror" id="loantypeerror"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">

														<div class="col-md-6">
															<div class="form-group">
															<label>State:</label>
	                                                        <select class="form-control select2" name="esi_state_id" id="esi_state_id" style="width: 100%;">
	                                                            <option value="">Select State</option>
	                                                        </select>
	                                                        <span class="formerror" id="esi_state_id_error"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
															<label>Branch:</label>
                                                        <select class="form-control select2" name="esi_branch_id" id="esi_branch_id" style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                        </select>
                                                        <span class="formerror" id="esi_branch_id_error"></span>
															</div>
														</div>

														<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Description <span class="text-danger">*</span></label>
									<textarea class="form-control summernote" name="desc" id="desc" cols="10" rows="10"></textarea>
									<span class="formerror" id="descerror"></span>
							   </div>
							</div>

												</div>
											</div>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Apply</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
</div>
<?php } ?>
<!-- Data Tables -->
<div id="reuesttypelist" ></div>
					<div class="row" id="reqlist"  style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employee Request List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee Code</th>
													<th>Employee Name</th>
													<th>Main Status</th>
													<th>Company Name</th>
													<th>Division Name</th>
													<th>State Name</th>
													<th>Branch Name</th>
													<th>Request Name</th>
													<th>Description</th>
													<th>Status</th>
													<th>Created by</th>
													<th>Parcel type</th>
													<th>Parcel Companyid</th>
													<th>Parcel Divisionid</th>
													<th>Parcel Stateid</th>
													<th>Parcel Branchid</th>
													<th>Parcel Company Name info</th>
													<th>Parcel Contact Person info</th>
													<th>Parcel Mobile info</th>
													<th>Parcel Emailid info</th>
													<th>Parcel Address info</th>
													<th>Parcel Pincode info</th>
													<th>Parcel Material Type</th>
													<th>Parcel Current transpoter info</th>
													<th>More</th>
												</tr>
											</thead>
											<tbody>
                                            <?php if(count($emprequestdata)>0){ ?>
												<tr>
													<?php foreach ($emprequestdata as $key => $listview) { ?>
                                                    <td><?php echo $listview->mxemp_req_emp_code ?></td>
													<td><?php echo $listview->mxemp_emp_fname .' '.$listview->mxemp_emp_lname;  ?></td>
													<td><?php if($listview->mxemp_req_status_process == 1){ echo 'OPEN'; }elseif($listview->mxemp_req_status_process == 2){echo 'CLOSED';} ?></td>
													<td><?php echo $listview->mxcp_name ?></td>
													<td><?php echo $listview->mxd_name ?></td>
													<td><?php echo $listview->mxst_state ?></td>
													<td><?php echo $listview->mxb_name ?></td>
													<td><?php echo $listview->mxemp_req_req_name ?></td>
													<td><?php  echo strip_tags(substr($listview->mxemp_req_desc,0,25)) . '...'; ?></td>
													<td><?php if($listview->mxemp_req_status == 1)
                                                    { echo 'Active'; }else{ echo 'In-Active'; } ?></td>
                                                    <td><?php echo $listview->mxemp_req_createdtime; ?></td>
													<td><?php echo $listview->parcel_type ?></td>
													<td><?php echo $listview->parcel_companyname ?></td>
													<td><?php echo $listview->parcel_divisionname ?></td>
													<td><?php echo $listview->parcel_statename ?></td>
													<td><?php echo $listview->parcel_branchname ?></td>
													<td><?php echo $listview->parcel_company_name_info ?></td>
													<td><?php echo $listview->parcel_contact_person_info ?></td>
													<td><?php echo $listview->parcel_mobile_info ?></td>
													<td><?php echo $listview->parcel_emailid_info ?></td>
													<td><?php echo $listview->parcel_address_info ?></td>
													<td><?php echo $listview->parcel_pincode_info ?></td>
													<td><?php echo $listview->parcel_material_type ?></td>
													<td><?php echo $listview->parcel_current_transpoter_info ?></td>
													<td>
													<div class="dropdown dropdown-action">
																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<?php if($this->session->userdata('user_role_edit') == 1){ ?><a class="dropdown-item" href="<?php echo base_url() ?>admin/editemprequest/<?php echo $listview->mxemp_req_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a><?php } ?>
																	<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $listview->mxemp_req_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
																</div>
															</div>		</td>
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
	<!-- Delete Department Modal -->
    <div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Employee Request Type</h3>
								<h3 style="color: red" id="delbrname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
							<input type="hidden" name="deletemainid" id="delbrid">
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="emprequesttype">Delete</a>
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
                var page_type = 1;
            </script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/emprequesttype.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
