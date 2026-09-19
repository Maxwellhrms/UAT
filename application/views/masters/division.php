			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Division Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Division Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Register New Division</button>

<div id="demo" class="collapse">					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Division Master Details</h4>
								</div>
								<div class="card-body">
									<form id="processdvdetails">
										<div class="form-group row">
											<label class="col-form-label col-md-2">Company Name</label>
											<div class="col-md-10">
												<select class="form-control select select2" name="cmpname" id="cmpname">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="cmpnameerror"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Division Name</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="divname" id="divname">
												<span class="formerror" id="divnameerror"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Division Image (If any)</label>
											<div class="col-md-10">
												<input class="form-control" type="file" name="divlogo" id="divlogo">
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
<?php } ?>
<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Division List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company Name</th>
													<th>Division Name</th>
													<th>Logo</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($divisiondetails as $key => $divvalue) { ?>
												<tr>
													<td><?php echo $divvalue->mxcp_name ?></td>
													<td><?php echo $divvalue->mxd_name ?></td>
													<td><?php echo $divvalue->mxd_pic ?></td>
													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if($this->session->userdata('user_role_edit') == 1){ ?><a class="dropdown-item" href="<?php echo base_url() ?>admin/editdivision/<?php echo $divvalue->mxd_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a><?php } ?>
                                                    <?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $divvalue->mxd_id .'~'. $divvalue->mxd_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
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
								<h3>Delete Division</h3>
								<h3 style="color: red" id="deldivname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="deletemainid" id="deldivid">
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
	var div = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/division.js"></script>
