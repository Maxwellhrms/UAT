<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">           
            <!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Loan Setup</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Employee Request Type </li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Employee Request Type <span style="color:red"><?php echo $emprequestdetails[0]->mxemp_emp_fname.$emprequestdetails[0]->mxemp_emp_lname; ?></span></h4>
									</div>
									<div class="card-body">
										<form id="emp_requesttype_form">
											<div class="row">
												<div class="col-md-6">
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
					                                            <select class="form-control select2 all"  name="esi_company_id" id="esi_company_id"  style="width: 100%">
							                                        <option value="">-- Select Company --</option>
                                                                    <?php foreach ($cmpmaster as $key => $cmpvalue) {
                                                                        print_r($emprequestdetails[0]->mxemp_req_comp_code .'=='. $cmpvalue->mxcp_id);
                                                                        if ($emprequestdetails[0]->mxemp_req_comp_code == $cmpvalue->mxcp_id) {
                                                                            $sel = 'selected';
                                                                        } else {   $sel = ''; }  ?>
                                                                    <option  value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel; ?> ><?php echo $cmpvalue->mxcp_name ?></option>
                                                                    <?php } ?>
                                                                </select>
							                                    <span class="formerror" id="cmpnameerror"></span>
															</div>
														</div>
														<div class="col-md-6">
                                                        <input type="hidden" name="id" value="<?php echo $emprequestdetails[0]->mxemp_req_id ?>">
															<div class="form-group">
															<label>Division:</label>
															<select class="select2 form-control all"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															<option value="">Select Division</option>
                                                            <?php foreach ($divmaster as $key => $divvalue) {
                                                                if ($emprequestdetails[0]->mxemp_req_division_id == $divvalue->mxd_id) {
                                                                    $sel = 'selected';
                                                                } else {
                                                                    $sel = '';
                                                                }
                                                            ?>
                                                            <option value="<?php echo $divvalue->mxd_id ?>" <?php echo $sel; ?>><?php echo $divvalue->mxd_name ?></option>
                                                        <?php } ?>
                                                    </select>
															<span class="formerror" id="esi_div_id_error"></span>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Code:</label>
																<select type="text" name="employeeid" id="employeeid" class="form-control select2 all" style="width: 100%">
																	<option value="<?php echo $emprequestdetails[0]->mxemp_req_emp_code ?>" <?php echo $sel; ?> ><?php echo $emprequestdetails[0]->mxemp_req_emp_code ?></option>
																</select>
																<span class="formerror" id="employeeiderror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Request Type:</label>
																<select type="text" name="requesttype" id="requesttype" class="form-control select2 " style="width: 100%">
                                                                <option value=""> Select Option </option>
                                                                <?php echo $controller->display_options('act_suggestionandgrievancebox',$emprequestdetails[0]->mxemp_req_req_name); ?>
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
	                                                        <select class="form-control select2 all" name="esi_state_id" id="esi_state_id" style="width: 100%;">
	                                                            <option value="">Select State</option>
                                                                <?php foreach ($states as $key => $stvalue) {
                                                                        if ($emprequestdetails[0]->mxemp_req_state_code == $stvalue->mxst_id) {
                                                                            $sel = 'selected ';  } else {$sel = ''; } ?>                                                                    								                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
						                                            <option value="<?php echo $stvalue->mxst_id ?>" <?php echo $sel; ?> ><?php echo $stvalue->mxst_state ?></option>
                                                                    <?php } ?>
	                                                        </select>
	                                                        <span class="formerror" id="esi_state_id_error"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
															<label>Branch:</label>
                                                        <select class="form-control select2 all" name="esi_branch_id" id="esi_branch_id"  style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                            <?php foreach ($branchmaster as $key => $branchvalue) {
                                                                        if ($emprequestdetails[0]->mxemp_req_branch_code == $branchvalue->mxb_id) {
                                                                            $sel = 'selected';  } else { $sel = ''; } ?>                                                                    								                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
						                                            <option value="<?php echo $branchvalue->mxb_id ?>" <?php echo $sel; ?> ><?php echo $branchvalue->mxb_name ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="esi_branch_id_error"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
															<label>Status:</label>
                                                        <select class="form-control select2" name="st_status" id="st_status"  style="width: 100%;">
                                                            <option value="">Select Status</option>
                                                            <option value="1" <?php if($emprequestdetails[0]->mxemp_req_status_process == 1){ echo 'selected';}else{ echo '';} ?>>Open</option>
                                                            <option value="2" <?php if($emprequestdetails[0]->mxemp_req_status_process == 2){ echo 'selected';}else{ echo '';} ?>>Close</option>
                                                        </select>
                                                        <span class="formerror" id="st_statuserror"></span>
															</div>
														</div>

												</div>
												
											</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Description <span class="text-danger">*</span></label>
									<textarea class="form-control summernote" name="desc" id="desc" cols="10" rows="10" >  <?php  echo $emprequestdetails[0]->mxemp_req_desc; ?></textarea>
									<span class="formerror" id="descerror"></span>
							   </div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Your Comments <span class="text-danger">*</span></label>
									<textarea class="form-control" name="cmdesc" id="cmdesc" cols="10" rows="10" >  <?php  echo $emprequestdetails[0]->mxemp_req_status_cmt; ?></textarea>
									<span class="formerror" id="descerror"></span>
							   </div>
							</div>
							<?php if(!empty($emprequestdetails[0]->parcel_type)){ ?>
							<div class="col-sm-12">
                              <div id="accordion">
                                <div class="card">
                                  <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                      Parcel Information
                                    </a>
                                  </div>
                                  <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
  <table class="table">
    <tbody>
<tr>
<td>Parcel type</td>
<td><?php echo $emprequestdetails[0]->parcel_type ?></td>
</tr>
<tr>
<td>Parcel Companyid</td>
<td><?php echo $emprequestdetails[0]->parcel_companyname ?></td>
</tr>
<tr>
<td>Parcel Divisionid</td>
<td><?php echo $emprequestdetails[0]->parcel_divisionname ?></td>
</tr>
<tr>
<td>Parcel Stateid</td>
<td><?php echo $emprequestdetails[0]->parcel_statename ?></td>
</tr>
<tr>
<td>Parcel Branchid</td>
<td><?php echo $emprequestdetails[0]->parcel_branchname ?></td>
</tr>
<tr>
<td>Parcel Company Name info</td>
<td><?php echo $emprequestdetails[0]->parcel_company_name_info ?></td>
</tr>
<tr>
<td>Parcel Contact Person info</td>
<td><?php echo $emprequestdetails[0]->parcel_contact_person_info ?></td>
</tr>
<tr>
<td>Parcel Mobile info</td>
<td><?php echo $emprequestdetails[0]->parcel_mobile_info ?></td>
</tr>
<tr>
<td>Parcel Emailid info</td>
<td><?php echo $emprequestdetails[0]->parcel_emailid_info ?></td>
</tr>
<tr>
<td>Parcel Address info</td>
<td><?php echo $emprequestdetails[0]->parcel_address_info ?></td>
</tr>
<tr>
<td>Parcel Pincode info</td>
<td><?php echo $emprequestdetails[0]->parcel_pincode_info ?></td>
</tr>
<tr>
<td>Parcel Material Type</td>
<td><?php echo $emprequestdetails[0]->parcel_material_type ?></td>
</tr>
<tr>
<td>Parcel Current transpoter info</td>
<td><?php echo $emprequestdetails[0]->parcel_current_transpoter_info ?></td>
</tr>
    </tbody>
  </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
							</div>
							<?php } ?>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Update</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
                        <script>
                        var page_type = 2;
                        $(".all").prop("disabled", true);

                        </script>
                        <script src="<?php echo base_url(); ?>/assets/js/formsjs/emprequesttype.js"></script>
                        <script src="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
                      