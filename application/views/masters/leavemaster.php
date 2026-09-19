<!-- Page Wrapper -->
<div class="page-wrapper">
				<div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Leave Setup</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Your Leave Setup</li>
								</ul>
							</div>
						</div>
						<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Assign New Leaves</button>
						<div class="col-auto float-right ml-auto">
						    <a class="btn add-btn" href="<?php echo base_url() ?>admin/leavetypes" ><i class="fa fa-edit"></i> Edit Leave Type</a>
							<button class="btn add-btn add_new_leave_type" data-toggle="modal" data-target="#addletype"  ><i class="fa fa-plus"></i> Add New Leave Type</button>&nbsp;&nbsp;
                        </div>
                        <?php } ?>
						<br>
					</div>
					<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>			
<div id="demo" class="collapse">
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Create Your Leave Setup Details</h4>
								</div>
								<div class="card-body">
									<form id="leave_assigning_form">
										<div class="row">
											<div class="col-md-12">

												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label>Company:</label>
															<select class="form-control select2" name="cmpname" id="cmpname" style="width: 100%">
																<option value="">-- Select Company --</option>
																<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
																	<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
																<?php } ?>
															</select>
															<span class="formerror" id="cmpnameerror"></span>
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label>Financial Year Type:</label>
															<select class="select2" name="cmpfnyyear" id="cmpfnyyear" style="width: 100%">
																<option value="">Select Financial Year</option>
																<?php foreach ($financial as $key => $fvalue) { ?>
																	<option value="<?php echo $fvalue->mxfny_id ?>"><?php echo $fvalue->mxfny_name ?></option>
																<?php } ?>
															</select>
															<span class="formerror" id="cmpfnyyearerror"></span>
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label>Employeement Type:</label>
															<select class="form-control select2" name="emptype" id="emptype">
																<option value="">Select Employee Type</option>																
															</select>
															<span class="formerror" id="emptypeerror"></span>
														</div>

													</div>

												</div>
											</div>
											<div class="col-auto float-right ml-auto" id="normal_add_more">
												<button type="button" class="btn add-btn add_normal_leaves"><i class="fa fa-plus"></i> Add More</button>
											</div>
										</div>

										<!-- Table Start -->
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-striped custom-table mb-0 datatable">
														<thead>
															<tr>
																<th>Leave</th>
																<th>Type Of Leave</th>
																<th>Min Leaves</th>
																<th>Apply days on Min Leaves</th>
																<th>is Max Leaves Applies Above Min Leave Days</th>
																<th>Max Leaves</th>
																<th>Select Type</th>
																<!-- <th>Days Worked in a month</th> -->
																<!-- <th>Duration of leave earned</th> -->
																<th>C/F Next Month</th>
																<th>C/F Next Year</th>
																<th>Max leaves C/F</th>
																<th>Applicable On</th>
																<th class="text-right">Actions</th>
															</tr>
														</thead>
														<tbody id="normal_tbody">

															<tr id="normal_tr_1">

																<td>
																	<input type="hidden" name="normal_hidddn[]" value="1">
																	<select name="leave_type_1" id="leave_type_1" class="form-control select2" style="width: 100%">
																		<option value="">Select Leave Type</option>																		
																	</select>
																	<span class="formerror" id="leave_type_error_1"></span>
																</td>
																<td width="120">
																	<div class="row">
																		<div class="col-md-12 col-12">
																			<div class="stats-box">
																				<label>Fixed</label>
																				<input type="radio" name="radio_type_1" id="is_fixed_1" value="1">
																				<label>Calculate</label>
																				<input type="radio" name="radio_type_1" id="is_calculate_1" value="2">
																				<span class="formerror" id="type_of_leave_error_1"></span>
																			</div>
																		</div>
																	</div>
																</td>
																<td>
																			<input type="text" name="min_leaves_1" id="min_leaves_1" class="form-control" style="float: left">
																			<span class="formerror" id="min_leaves_error_1"></span>
																</td>
																<td>
																			<input type="text" name="min_leaves_days_1" id="min_leaves_days_1" class="form-control" style="float: left">
																			<span class="formerror" id="min_leaves_days_error_1"></span>
																</td>
																<td>
																	<div class="row">
																		<div class="col-md-6 col-6">
																			<input type="checkbox" name="is_max_days_1" class="form-control" style="float: left">
																			<span class="formerror" id="is_max_days_error_1"></span>
																		</div>
																	</div>
																</td>
																<td>
																			<input type="text" name="max_leaves_1" id="max_leaves_1" class="form-control" style="float: left">
																			<span class="formerror" id="max_leaves_error_1"></span>
																</td>
																<td>
																			<select name="select_type_1" id="select_type_1" class="form-control select2" style="width: 100%">
																				<option value="">Type</option>
																				<option value="1">Monthly</option>
																				<option value="2">Yearly</option>
																			</select>
																			<span class="formerror" id="select_type_error_1"></span>
																</td>

																<!-- <td><input type="text" name="" class="form-control"></td> -->
																<!-- <td><input type="text" name="" class="form-control"></td> -->
																<td>
																	<div class="row">
																		<div class="col-md-3 col-3" style="margin-top: 15px;">
																			<input type="checkbox" name="cf_next_month_1" id="cf_next_month_1" value="1">
																			<span class="formerror" id="cf_next_month_error_1"></span>
																		</div>
																	</div>
																</td>
																<td>
																<div class="row">
																		<div class="col-md-3 col-3" style="margin-top: 15px;">
																			<input type="checkbox" name="cf_next_year_1" id="cf_next_year_1" value="1">
																			<span class="formerror" id="cf_next_year_error_1"></span>
																		</div>
																	</div>
																	<!-- <select name="" id="" class="form-control" style="width: 100%">
																		<option value="">Type</option>
																		<option value="1">Lapse</option>
																		<option value="2">Carry Forward</option>
																	</select> -->
																</td>
																<td>
																	<input type="text" name="max_leaves_cf_1" id="max_leaves_cf_1" class="form-control">
																	<span class="formerror" id="max_leaves_cf_error_1"></span>
																</td>
																<td>
																	<div class="row">
																		<div class="col-md-12 col-12">
																			<div class="stats-box">
																				<label>PH</label>
																				<input type="checkbox" name="applicable_on_ph_1" id="applicable_on_ph_1" value=""><br>
																				<label>WO</label>
																				<input type="checkbox" name="applicable_on_wo_1" id="applicable_on_wo_1" value=""><br>
																				<label>PR</label>
																				<input type="checkbox" name="applicable_on_pr_1" id="applicable_on_pr_1" value="">
																				<span class="formerror" id="applicable_error_1"></span>
																			</div>
																		</div>
																	</div>
																</td>
																<td class="text-right">
																	<!-- <button type="button" name="" class="btn btn-info" id="btn_rmv_1">Remove</button> -->
																</td>
															</tr>


														</tbody>
													</table>
												</div>
											</div>
											<div class="col-auto float-right ml-auto" id="shrt_add_more">
												<button type="button" class="btn add-btn"><i class="fa fa-plus"></i> Add More</button>
											</div><br>
										</div>
										<!-- Table Start -->

										<!-- Short leaves tables -->
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-striped custom-table mb-0 datatable">
														<thead>
															<tr>
																<th>Leave</th>
																<th>Max leaves (in days)</th>
																<th>Slect Type</th>
																<th>Max Durations</th>
																<th>C/F Next Year</th>
																<th>Deduction days if exceeds Maximum leaves</th>
																<th>Ation</th>
															</tr>
														</thead>
														<tbody id="shrt_tbody">

															<tr id="shrt_tr_1">
																<td>
																	<input type="hidden" name="shrt_hidden_array[]" value="1">
																	<select name="shrt_leave_type_1" id="shrt_leave_type_1" class="form-control select2" style="width: 100%">
																		<option value="">Select Leave Type</option>																		
																	</select>
																	<span class="formerror" id="shrt_leave_type_error_1"></span>
																</td>

																<td>
																	<div class="row">
																		<div class="col-md-6 col-6">
																			<input type="text" name="shrt_max_leaves_1" id="shrt_max_leaves_1" class="form-control" style="float: left">
																			<span class="formerror" id="shrt_max_leaves_error_1"></span>
																		</div>
																	</div>
																</td>
																<td>
																			<select name="shrt_max_type_leave_1" id="shrt_max_type_leave_1" class="form-control select2" style="width: 100%">
																				<option value="">Type</option>
																				<option value="1">Monthly</option>
																				<option value="2">Yearly</option>
																			</select>
																			<span class="formerror" id="shrt_max_type_leave_error_1"></span>
																</td>
																<td>
																	<input type="text" name="shrt_max_duration_1" id="shrt_max_duration_1" class="form-control datetimepicker2"><span>HH:MM</span>
																	<span class="formerror" id="shrt_max_duration_error_1"></span>
																</td>
																<td>
																	<input type="checkbox" name="shrt_cf_nxt_year_1" id="shrt_cf_nxt_year_1" class="form-control">
																	<span class="formerror" id="shrt_cf_nxt_year_error_1"></span>
																</td>
																<td>
																	<input type="text" name="shrt_deduct_leave_1" id="shrt_deduct_leave_1" class="form-control"><span>(no of days)</span>
																	<span class="formerror" id="shrt_deduct_leave_error_1"></span>
																</td>
																<td class="text-right">
																	<!-- <button type="button" name="" class="btn btn-info" id="shrt_btn_rmv_1">Remove</button> -->
																</td>
															</tr>


														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- Short leaves tables -->
										<div class="text-right">
											<button type="submit" class="btn btn-primary">Save Leave Details</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
</div>
<?php } ?>
					<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Leave Types List</h4>
								</div>
								<div class="card-body">

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Sno</th>
													<th>Employee Type</th>
													<th>Leave Type</th>
													<th>Leave Type Names</th>
													<th>Financial Year Type</th>
													<th>Monthly Leave accumulation</th>
													<th>Monthly Working Days</th>
													<th>Maximum</th>
													<th>Applicable</th>
												</tr>
											</thead>
											<tbody>
											<?php  $sno=1;
											foreach ($leavelist as $listview) { ?>
												<tr>
												<td><?php echo $sno ?></td>
												<td><?php echo $listview->mxemp_ty_name ?></td>
												<td><?php echo $listview->shortnames ?></td>
												<td><?php echo $listview->leavenames ?></td>
												<td><?php echo $listview->mxfny_name ?></td>
												<td><?php echo $listview->mxlass_min_leaves ?></td>
												<td><?php echo $listview->mxlass_apply_min_leave_days ?></td>
												<td><?php echo $listview->mxlass_is_max_leave ?></td>
												<td><?php if($listview->mxlass_applicable_on_wo == 1){ echo ' WO ';} if($listview->mxlass_applicable_on_ph == 1){ echo ' PH '; } if($listview->mxlass_applicable_on_pr == 1){ echo ' PR';} ?></td>
												</tr>
											<?php $sno++;} ?>
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
								<h3>Delete Company</h3>
								<h3 style="color: red" id="delcmpname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
							<input type="hidden" name="deletemainid" id="delcmpid">
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
                        
                        <!-- Add new Leave Type -->
			<div class="modal custom-modal fade" id="addletype" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Leave Type Details</h3>
							</div>
                                            
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Company Name</label>
                                        <div class="col-lg-7">
                                            <select class="form-control select2" name="cmpname" id="compname" style="width:100%">
                                                <option value="">-- Select Company --</option>
                                                <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                    <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="compnameerror"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Leave Type Name</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="leavetypename" id="leavetypename">
                                        </div>
                                        <span class="formerror" id="leavetypenameerror"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Leave Type ShortName</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="leavetypeshtname" id="leavetypeshtname">
                                        </div>
                                        <span class="formerror" id="leavetypeshtnameerror"></span>
                                    </div>
                                </div>
                                <div class="form-group row">	
                                <div class="col-lg-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="earnedleave" name="earnedleave" value="1">
                                        <label class="form-check-label">
                                            Is Earned Leave
                                        </label>
                                        <span class="formerror" id="checkerror"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="shortleave" name="shortleave" value="1">
                                        <label class="form-check-label">
                                            Is Short Leave
                                        </label>
                                        <span class="formerror" id="checkederror"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="optleave" name="optleave" value="1">
                                        <label class="form-check-label">
                                            Optinal Leave
                                        </label>
                                        <span class="formerror" id="checkederror"></span>
                                    </div>
                                </div>
                            </div>
                                                    
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary addleavetype">Submit</button>
                            </div>
							
						</div>
					</div>
				</div>
			</div>
                        
			<!-- /Add new Leave Type -->
			<!-- Company Validation -->

			<script>
				var cmp = 1;
			</script>
			<script src="<?php echo base_url() ?>assets/js/formsjs/leave_master.js"></script>
