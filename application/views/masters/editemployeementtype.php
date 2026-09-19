			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Your Employeement Type</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
															if($emptypedetails[0]->mxemp_ty_cmpid == $companies->mxcp_id){

																echo "<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
															}else{
																echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
															}
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
														<input type="text" class="form-control" name="emptyname" id="emptyname" value="<?php echo $emptypedetails[0]->mxemp_ty_name ?>">
													</div>
													<span class="formerror" id="emptynameerror"></span>
												</div>
											</div>

											<div class="col-xl-4">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Employee Short Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="empshrtname" id="empshrtname" value="<?php echo $emptypedetails[0]->mxemp_ty_short_name ?>">
													</div>
													<span class="formerror" id="empshrtnameerror"></span>
												</div>
											</div>
											<input type="hidden" name="id" value="<?php echo $emptypedetails[0]->mxemp_ty_id ?>">
										</div>
										<div class="col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="is_trainees" value="1" <?php echo ($emptypedetails[0]->mxemp_ty_is_trainees == 1)?"checked":""; ?>>
                                                <label class="form-check-label">
                                                    Is Trainees
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="is_professionals" value="1" <?php echo ($emptypedetails[0]->mxemp_ty_is_professionals == 1)?"checked":""; ?>>
                                                <label class="form-check-label">
                                                    Is Professionals
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input emp_type" type="checkbox" name="is_directors" value="1" <?php echo ($emptypedetails[0]->mxemp_ty_is_director == 1)?"checked":""; ?>>
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

				</div>			
			</div>
			<!-- /Main Wrapper -->

<script>
	var emptype = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/employeementtype.js"></script>