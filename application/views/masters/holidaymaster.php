			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Holiday Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Holiday Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Register New Holiday</button>
<?php } ?>
<div id="demo" class="collapse">
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Create Holiday Master</h4>
								</div>
								<div class="card-body">
									<form id="processholidaydetails">

                                        <div class="row">
                                            <div class="col-xl-3"></div>
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="hld_day" value="3" checked> Full Day
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="hld_day" value="1"> First Half
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="hld_day" value="2"> Second Half
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Holiday Type <span class="text-danger">*</span></label>
												<select class="form-control select2 hldtype" name="cmptype" id="cmptype" style="width:100%">
                                                <?php echo $controller->display_options('adm_holiday_types',''); ?>
												</select>
												<span class="formerror" id="cmptypeerror"></span>
											   </div>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Company <span class="text-danger">*</span></label>
												<select class="form-control select2" name="hd_company_name" id="hd_company_id" style="width:100%">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="hd_company_iderror"></span>
											   </div>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Division <span class="text-danger">*</span></label>
												<select class="form-control select2" name="hd_divsion_name" id="hd_divsion_name" style="width:100%">
													<option value="">-- Select Division --</option>
													<?php foreach ($divisiondetails as $key => $divvalue) { ?>
														<option value="<?php echo $divvalue->mxd_id ?>"><?php echo $divvalue->mxd_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="hd_divsion_nameerror"></span>
											   </div>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">State <span class="text-danger">*</span></label>
													<select class="form-control select2 hldstate" name="hd_state_name" id="hd_state_id" style="width:100%">
														<option value="">Select State</option>
														<option value="1001">ALL STATES</option>
														<?php foreach ($states as $key => $stvalue) { ?>
															<option value="<?php echo $stvalue->mxst_id ?>"><?php echo $stvalue->mxst_state ?></option>
														<?php } ?>
													</select>
													<span class="formerror" id="hd_state_iderror"></span>
											   </div>
											</div>


											<div class="col-sm-4 hldbrn" style="display: none;">
												<div class="form-group">
													<label class="col-form-label">Branch <span class="text-danger">*</span></label>
													<select class="form-control select2" name="hd_branch_name[]" id="hd_branch_id" style="width: 100%;" multiple>
													</select>
													<span class="formerror" id="hd_branch_iderror"></span>
											   </div>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Holiday Date <span class="text-danger">*</span></label>
													<input class="form-control datetimepicker" type="text" name="cmpholiday" id="cmpholiday">
													<span class="formerror" id="cmpholidayerror"></span>
											   </div>
											</div>

											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Holiday Name <span class="text-danger">*</span></label>
													<textarea class="form-control" name="cmpholidayname" id="cmpholidayname"></textarea>
													<span class="formerror" id="cmpholidaynameerror"></span>
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
<!-- Data Tables -->

					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Holiday Master List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Holiday Type</th>
													<th>Company</th>
													<th>Division</th>
													<th>State</th>
													<th>Branch</th>
													<th>Holiday Name</th>
													<th>Date</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
											    <?php #echo '<pre>'; print_r($displayholidaymaster); ?>
												<?php foreach ($displayholidaymaster as $key => $grvalue) { ?>
												<tr>
													<td><?php if($grvalue->mx_holiday_type == 1){
														echo 'Public Holiday';
													}elseif ($grvalue->mx_holiday_type == 2) {
														echo 'Occational Holiday';
													}elseif ($grvalue->mx_holiday_type == 3) {
														echo 'Optional Holiday';
													}
													 ?></td>
													<td><?php echo $grvalue->mxcp_name ?></td>
													<td><?php echo $grvalue->mxd_name ?></td>
													<td><?php echo $grvalue->mxst_state ? : 'ALL STATES' ?></td>
													<td><?php echo $grvalue->mxb_name ? : 'ALL BRANCHES'?></td>
													<td><?php echo $grvalue->mx_holiday_name ?></td>
													<td><?php echo $grvalue->mx_holiday_date ?></td>
 													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--<a class="dropdown-item" href="<?php echo base_url() ?>admin/editgrade/<?php echo $grvalue->mxgrd_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                                                    <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $grvalue->mx_holiday_id .'~'. $grvalue->mx_holiday_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
								<h3>Delete Holiday</h3>
								<h3 style="color: red" id="hldname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="holidayid" id="holidayid">
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
	var hl = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/holiday.js"></script>
