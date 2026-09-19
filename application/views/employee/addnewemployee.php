			<!----NEW BY SHABABU-->
			<style>
				.isDisabled {
					cursor: not-allowed;
					opacity: 0.5;
				}

				.isDisabled>a {
					color: currentColor;
					display: inline-block;
					/* For IE11/ MS Edge bug */
					pointer-events: none;
					text-decoration: none;
				}
			</style>
			<!----END NEW BY SHABABU-->
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Add New Employee</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Add New Employee To Your Orgination</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<form id="processemployeedetails">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">

										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Company Name</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="cmpname" id="cmpname" style="width:100%">
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
														<select class="form-control select2" name="divname" id="divname" style="width:100%">
														</select>
														<span class="formerror" id="divnameerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">State</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="cmpstate" id="cmpstate" style="width:100%">
															<option value="">Select State</option>
															<?php foreach ($states as $key => $stvalue) { ?>
																<option value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="cmpstateerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="brname" id="brname" style="width:100%">

														</select>
														<span class="formerror" id="brnameerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Date Of Join</label>
													<div class="col-lg-9">
														<input type="text" class="form-control datetimepicker" name="empdoj" id="empdoj" autocomplete="off">
														<span class="formerror" id="empdojerror"></span>
													</div>
												</div>

												<div class="form-group row" style="display:none">
													<label class="col-lg-3 col-form-label">Sub Branch</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="subbrname" id="subbrname" style="width:100%">

														</select>
													</div>
												</div>

												<div class="form-group row" style="display:none">
													<div class="col-lg-9">
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" name="branchhr" value="1">
															<label class="form-check-label">
																Is Branch HR
															</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="checkbox" name="branchdirector" value="1">
															<label class="form-check-label">
																Is Director
															</label>
														</div>
													</div>
												</div>


											</div>


											<div class="col-xl-6">

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Departements</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="departmentname" id="departmentname" style="width:100%">
														</select>
														<span class="formerror" id="departmentnameerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Grade</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="gradename" id="gradename" style="width:100%">
														</select>
														<span class="formerror" id="gradenameerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Designation</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="designationname" id="designationname" style="width:100%">

														</select>
														<span class="formerror" id="designationnameerror"></span>
													</div>
												</div>



												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Employee Type</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="emptype" id="emptype" style="width:100%">
															<option value="">Select Employee Type</option>
															<?php foreach ($emptype as $key21 => $emtype) { ?>
																<option value="<?php echo $emtype->mxemp_ty_id ?>"><?php echo $emtype->mxemp_ty_name ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="emptypeerror"></span>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Employee Id</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="employeeid" id="employeeid" autocomplete="off" >
													</div>
												</div>

											</div>

										</div>


										<ul class="nav nav-tabs nav-tabs-solid nav-justified">
											<li class="nav-item"><a class="nav-link active" id="personalinformation" href="#solid-justified-tab1" data-toggle="tab">Personal Information</a></li>
											<li class="nav-item"><a class="nav-link" id="familyinformation" href="#solid-justified-tab2" data-toggle="tab">Family Details</a></li>
											<li class="nav-item"><a class="nav-link" id="previousempinformation" href="#solid-justified-tab3" data-toggle="tab">Previous Employment</a></li>
											<li class="nav-item"><a class="nav-link" id="bankinformation" href="#solid-justified-tab5" data-toggle="tab">Bank & Statutory</a></li>
											<li class="nav-item"><a class="nav-link" id="addressinformation" href="#solid-justified-tab4" data-toggle="tab">Address</a></li>
											<li class="nav-item"><a class="nav-link" id="refrenceinformation" href="#solid-justified-tab7" data-toggle="tab">Refrence</a></li>
											<li class="nav-item"><a class="nav-link" id="authorizationinformation" href="#solid-justified-tab8" data-toggle="tab">Authorization</a></li>
											<li class="nav-item"><a class="nav-link" id="nomineeinformation" href="#solid-justified-tab6" data-toggle="tab">Nominee</a></li>
										</ul>

										<div class="tab-content">
											<!-- Personal Details -->
											<div class="tab-pane show active" id="solid-justified-tab1">
												<div class="row">
													<div class="col-md-12">
														<div class="card">
															<div class="card-header">
																<h4 class="card-title mb-0">Personal Information</h4>
															</div>
															<div class="card-body">
																<!-- <h4 class="card-title">Personal Information</h4> -->

																<div class="row">
																	<div class="col-xl-6">
																	    <div class="form-group row">
																			<label class="col-lg-3 col-form-label">Employee Name As Per Aadhar</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="empfname" id="empfname" autocomplete="off">
																				<span class="formerror" id="empfnameerror"></span>
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Employee Name As Per Bank</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="empnameasperbank" id="empnameasperbank" autocomplete="off">
																				<span class="formerror" id="empnameasperbankerror"></span>
																			</div>
																		</div>

																	    <div class="form-group row">
																			<label class="col-lg-3 col-form-label">Employee Relation</label>
																			<div class="col-lg-9">
																				<select class="select2 form-control" name="emprelation" id="emprelation" style="width:100%">
                                                                                    <?php echo $controller->display_options('employee_relation',''); ?>
																				</select>
																				<span class="formerror" id="emprelationerror"></span>
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Employee Relation Person</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="emprelation_name" id="emprelation_name" autocomplete="off">
																				<span class="formerror" id="emprelation_nameerror"></span>
																			</div>
																		</div>

																		<div class="form-group row" style="display:none;">
																			<label class="col-lg-3 col-form-label">Last Name</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="emplname" id="emplname" autocomplete="off">
																				<span class="formerror" id="emplnameerror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Gender</label>
																			<div class="col-lg-9">
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="empgender" value="Male" checked>
																					<label class="form-check-label">
																						Male
																					</label>
																				</div>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="empgender" value="Female">
																					<label class="form-check-label">
																						Female
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Blood Group</label>
																			<div class="col-lg-9">
																				<select class="select2 form-control" name="empbloodgroup" id="empbloodgroup" style="width:100%">
																					<option value="">Select</option>
																					<option value="A+">A+</option>
																					<option value="B+">B+</option>
																					<option value="AB+">AB+</option>
																					<option value="O+">O+</option>
																					<option value="A-">A-</option>
																					<option value="B-">B-</option>
																					<option value="AB-">AB-</option>
																					<option value="O-">O-</option>
																				</select>
																				<span class="formerror" id="empbloodgrouperror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Mobile</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control numbersonly" name="empmobile" id="empmobile" autocomplete="off">
																				<span class="formerror" id="empmobileerror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Alt Mobile</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control numbersonly" name="empaltmobile" id="empaltmobile" autocomplete="off">
																				<span class="formerror" id="empaltmobileerror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Mother Tongue</label>
																			<div class="col-lg-9">
																				<select type="text" class="form-control" name="empmtongue" id="empmtongue" autocomplete="off">
																				<?php foreach ($language as $keys => $lgmgvalue) { ?>
																					<option value="<?php echo $lgmgvalue->mxlg_name ?>"><?php echo $lgmgvalue->mxlg_name ?></option>
																				<?php } ?>
																				</select>
																				<span class="formerror" id="empmtongueerror"></span>
																			</div>
																		</div>
																		<!--<div class="form-group row">-->
																		<!--	<label class="col-lg-3 col-form-label">Employee Age</label>-->
																		<!--	<div class="col-lg-9">-->
																		<!--		<input type="text" class="form-control" name="empage" id="empage" autocomplete="off" readonly>-->
																		<!--		<span class="formerror" id="empageerror"></span>-->
																		<!--	</div>-->
																		<!--</div>-->
																		<div class="form-group row">
																			<!--<label class="col-lg-3 col-form-label">Salary Approved</label>-->
																			<label class="col-lg-3 col-form-label">Per Month Gross Salary</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control numbersonly_with_dot" name="empsalary" id="empsalary" placeholder="Employee Gross Salary" autocomplete="off">
																				<span class="formerror" id="empsalaryerror"></span>
																			</div>
																		</div>
																		<div class="form-group row" style="display:none">
																			<label class="col-lg-3 col-form-label">Guarantors Details</label>
																			<div class="col-lg-9">
																				<textarea class="form-control" name="empguarantorsdetails" id="empguarantorsdetails"></textarea>
																				<span class="formerror" id="empguarantorsdetailserror"></span>
																			</div>
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<!-- <div class="form-group row">
																			<label class="col-lg-3 col-form-label">Date Of Join</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control datetimepicker" name="empdoj" id="empdoj" autocomplete="off">
																				<span class="formerror" id="empdojerror"></span>
																			</div>
																		</div> -->
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Image</label>
																			<div class="col-lg-9">
																				<img id="blah1" src="<?php echo base_url() . 'assets/img/160x160.png' ?>" hieght="160px" width="160px">
																				<input id="pic" name="file" class='pis' onchange="readURL(this,'img1');" type="file">
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Email</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="empemail" id="empemail" autocomplete="off">
																				<span class="formerror" id="empemailerror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Company Email</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="cmp_empemail" id="cmp_empemail" autocomplete="off">
																				<span class="formerror" id="cmp_empemailerror"></span>
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Date Of Birth</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control datetimepicker" name="empdob" id="empdob" autocomplete="off">
																				<span class="formerror" id="empdoberror"></span>
																			</div>
																		</div>
																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Employee Age</label>
																			<div class="col-lg-9">
																				<input type="text" class="form-control" name="empage" id="empage" autocomplete="off" readonly>
																				<span class="formerror" id="empageerror"></span>
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Caste</label>
																			<div class="col-lg-9">
																				<select class="form-control select2" name="empcaste" id="empcaste" style="width:100%">
																					<option value="">Select Caste</option>
																					<option value="Forward">Forward</option>
																					<option value="Backward">Backward</option>
																					<option value="SC">SC</option>
																					<option value="ST">ST</option>
																					<option value="OC">OC</option>
																					<option value="GENERAL">General</option>
																				</select>
																				<span class="formerror" id="empcasteerror"></span>
																			</div>
																		</div>

																		<div class="form-group row">
																			<label class="col-lg-3 col-form-label">Marital</label>
																			<div class="col-lg-9">
																				<select class="form-control select2 marital" name="empmarital" id="empmarital" style="width:100%">
																					<option value="">Select Marital Status</option>
																					<option value="Married">Married</option>
																					<option value="UnMarried">UnMarried</option>
																					<option value="Divorced">Divorced</option>

																				</select>
																				<span class="formerror" id="empmaritalerror"></span>
																			</div>
																		</div>


																		<div class="form-group row openmrd" style="display:none">
																			<label class="col-lg-3 col-form-label">Marriage Date</label>
																			<div class="col-lg-9">
																				<input class="form-control datetimepicker" type="text" name="empmaritaldate" id="empmaritaldate">
																				<span class="formerror" id="empmaritaldateerror"></span>
																			</div>
																		</div>

																		<!--<div class="form-group row">-->
																		<!--	<label class="col-lg-3 col-form-label">Salary Approved</label>-->
																		<!--	<div class="col-lg-9">-->
																		<!--		<input type="number" class="form-control" name="empsalary" id="empsalary" placeholder="Employee Salary" autocomplete="off">-->
																		<!--		<span class="formerror" id="empsalaryerror"></span>-->
																		<!--	</div>-->
																		<!--</div>-->

																	</div>
																</div>


																<div class="col-md-12">
																	<div class="row">

																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Do You Have Vehicle:</label>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input vechicledetails hvvehicle" type="radio" name="vehicle" value="HAVING VEHICLE">
																					<label class="form-check-label">
																						Yes
																					</label>
																				</div>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input vechicledetails ntvehicle" type="radio" name="vehicle" value="NOT HAVING VEHICLE">
																					<label class="form-check-label">
																						No
																					</label>
																				</div>
																			</div>
																		</div>

																		<div class="col-md-12 enableifhavingvehicle" style="display: none">
																			<div class="form-group">
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="wheeler" value="(2) TWO WHEELER">
																					<label class="form-check-label">
																						TWO WHEELER
																					</label>
																				</div>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="wheeler" value="(4) FOUR WHEELER">
																					<label class="form-check-label">
																						FOUR WHEELER
																					</label>
																				</div>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="wheeler" value="(2 + 4) FOUR WHEELER">
																					<label class="form-check-label">
																						TWO + FOUR WHEELER
																					</label>
																				</div>
																			</div>
																		</div>

																		<div class="col-md-12">
																			<div class="form-group">
																				<div class="form-group row">
																					<label class="col-lg-2 col-form-label">License No</label>
																					<div class="col-lg-4">
																						<input type="text" class="form-control" name="emplicense" id="emplicense" autocomplete="off">
																						<span class="formerror" id="emplicenseerror"></span>
																					</div>
																				</div>
																			</div>
																		</div>
																		<hr>

																		<!-------------LANGUAGES---------------->
																		<div class="col-md-12" class="lang_div" id="lang_div">
																			<div class="row" id="div_1">
																				<div class="col-md-3">
																					<div class="form-group">
																						<label>Language:</label>
																						<select class="form-control select2" name="emplanguage_1" id="emplanguage" style="width:100%">
																							<option value="">Select Language</option>
																							<?php foreach ($language as $key => $lgvalue) { ?>
																								<option value="<?php echo $lgvalue->mxlg_id ?>"><?php echo $lgvalue->mxlg_name ?></option>
																							<?php } ?>
																						</select>
																						<span class="formerror" id="emplanguageerror_1"></span>
																					</div>
																				</div>

																				<div class="col-md-2">
																					<div class="form-group">
																						<label>Speak:</label>
																						<input class="form-control col-md-2" type="checkbox" name="empspeak_1" id="empspeak_1" value="1">
																					</div>
																				</div>
																				<div class="col-md-2">
																					<div class="form-group">
																						<label>Read:</label>
																						<input class="form-control col-md-2" type="checkbox" name="empread_1" id="empread_1" value="1">
																					</div>
																				</div>
																				<div class="col-md-2">
																					<div class="form-group">
																						<label>Write:</label>
																						<input class="form-control col-md-2" type="checkbox" name="empwrite_1" id="empwrite_1" value="1">
																					</div>
																				</div>
																				<input type="hidden" name="lang_array[]" value="1">
																				<div class="col-md-1">
																					<div class="form-group">
																						<label>&nbsp;</label>
																						<button type="button" id="add_remove_1" class="form-control btn btn-info add_lang_btn"><i class="fa fa-plus"></i></button>
																					</div>
																				</div>
																			</div>

																			<span class="addknlgdetails"></span>
																		</div>
																	</div>
																</div>
																<!-------------END LANGUAGES---------------->

															</div>
														</div>
													</div>
												</div>

												<!-- Accademic deatils -->
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
															<div class="card-header">
																<h4 class="card-title mb-0">Academic And Training Records</h4>
															</div>
															<div class="card-body">
																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">
																		    <!--
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Type:</label>
																					<select class="form-control" name="empacrtype[]" id="empacrtype">
																						<option value="">Select</option>
																						<option value="General">General</option>
																						<option value="Professional">Professional</option>
																						<option value="NON Mertic">NON Mertic</option>
																						<option value="Mertic">Mertic</option>
																						<option value="SSC">SSC</option>
																						<option value="Inter">Inter</option>
																						<option value="Degree">Degree</option>
																						<option value="Diploma">Diploma</option>
																						<option value="PHD">PHD</option>
																						<option value="Senior Secondary">Senior Secondary</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Year of Passing:</label>
																					<input type="text" class="form-control" name="empacryop[]" id="empacryop" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Institution:</label>
																					<input type="text" class="form-control" name="empacrinstitution[]" id="empacrinstitution" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Subject:</label>
																					<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>University:</label>
																					<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-1">
																				<div class="form-group">
																					<label>Marks%:</label>
																					<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" autocomplete="off">
																				</div>
																			</div>

																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Image</label>
																					<input type="file" class="form-control" name="empacrimage[]" id="empacrimage" autocomplete="off">
																				</div>
																			</div> -->
                                                                            <div class="col-md-4"> </div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_ar_file"><i class="fa fa-plus"></i> Add Academic Records</button>
																				</div>
																			</div>


																		</div>
																		<span class="addardetails"></span>
																		<div class="row" style="margin-top: 10px;">
																		<!--  	<h4 class="col-md-12" align="center">Training in Computer and Other Short term Courses</h4>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Name of the Course:</label>
																					<input type="text" class="form-control" name="emptrcourse[]" id="emptrcourse" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Name of the Institution:</label>
																					<input type="text" class="form-control" name="emptrinstitution[]" id="emptrinstitution" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>From:</label>
																					<input type="text" class="form-control datetimepicker" name="emptrfrom[]" id="emptrfrom" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>To:</label>
																					<input type="text" class="form-control datetimepicker" name="emptrto[]" id="emptrto" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Image:</label>
																					<input type="file" class="form-control" name="emptrimage[]" id="emptrimage" autocomplete="off">
																				</div>
																			</div>  -->
																			<div class="col-md-3"> </div>
																			<div class="col-md-5">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_tr_file"><i class="fa fa-plus"></i> Training in Computer and Other Short term Courses</button>
																				</div>
																			</div>
																		</div>

																		<span class="addtrdetails"></span>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Accademic details -->
													<!-- PreviousNext -->
												<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab2" data-toggle="tab" type = "button" class="btn btn-info" data-current_id = "#personalinformation" data-next_id="#familyinformation" id="next"> Next </a>
												</div>
												<!-- PreviousNext -->

											</div>
											<!-- Personal Details -->
											<!-- Bank -->
											<div class="tab-pane" id="solid-justified-tab5">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Bank Name <span class="text-danger">*</span></label>
															<select class="form-control select2" placeholder="Bank Name" name="empbankname" id="empbankname" autocomplete="off" style="width:100%">
															    <?php echo $controller->display_options('bank_names',''); ?>
															</select>
															<span class="formerror" id="empbanknameerror"></span>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Bank Branch <span class="text-danger">*</span></label>
															<input type="text" class="form-control" placeholder="Bank Branch" name="empbankbranch" id="empbankbranch" autocomplete="off">
															<span class="formerror" id="empbankbrancherror"></span>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Bank Account No <span class="text-danger">*</span></label>
															<input type="text" class="form-control" placeholder="Account No" name="empbankaccno" id="empbankaccno" autocomplete="off">
															<span class="formerror" id="empbankaccnoerror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Bank Image</label>
															<input type="file" class="form-control" name="bankimg" id="bankimg" autocomplete="off">
															<span class="formerror" id="bankimgerror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">IFSCI No <span class="text-danger">*</span></label>
															<input type="text" class="form-control alphanumeric" placeholder="IFSCI No" name="empbankifsci" id="empbankifsci" autocomplete="off">
															<span class="formerror" id="empbankifscierror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Pancard No</label>
															<input type="text" class="form-control" placeholder="Pancard No" name="emppanno" id="emppanno" autocomplete="off">
															<span class="formerror" id="emppannoerror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">PanCard Image</label>
															<input type="file" class="form-control" name="pancardimg" id="pancardimg" autocomplete="off">
															<span class="formerror" id="pancardimg"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">ESI No</label>
															<input type="text" class="form-control numbersonly" placeholder="ESI No" name="empesino" id="empesino" autocomplete="off">
															<span class="formerror" id="empesinoerror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">ESI Image</label>
															<input type="file" class="form-control" name="empesinoimg" id="empesinoimg" autocomplete="off">
															<span class="formerror" id="empesinoimg"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">PF No</label>
															<input type="text" class="form-control alphanumeric" placeholder="PF No" name="emppfno" id="emppfno" autocomplete="off">
															<span class="formerror" id="emppfnoerror"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">UAN</label>
															<input type="text" class="form-control numbersonly" placeholder="UAN No" name="empuanno" id="empuanno" autocomplete="off">
															<span class="formerror" id="empuannoerror"></span>
														</div>
													</div>
													<div class="form-group">
			<label class="col-form-label">pf joining date</label>
			<input type="date" class="form-control" placeholder="" name="pfjoindate" id="pfjoindate" value= "" autocomplete="off">
			<span class="formerror" id="pfjoindateerr"></span>
		</div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">eps joining date</label>
                <input type="date" class="form-control" placeholder="" name="epsjoindate" id="epsjoindate" value= "" autocomplete="off">
                <span class="formerror" id="epsjoindateerr"></span>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label class="col-lg-12 col-form-label">EPS Non-Contribution</label>
                &nbsp;&nbsp;<input type="checkbox" name="is_eps_to_pf" id="is_eps_to_pf" value="1">
                &nbsp;&nbsp;(Check to add EPS amount to PF and set EPS Wage to Zero)
                <span class="formerror" id="epstopferr"></span>
            </div>
        </div>
    </div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="col-form-label">esi joining date</label>
			<input type="date" class="form-control" placeholder="" name="esijoindate" id="esijoindate" value= "" autocomplete="off">
			<span class="formerror" id="esijoindateerr"></span>
		</div>
	</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Aadhar Card</label>
															<input type="text" class="form-control numbersonly" placeholder="Aadhar No" name="empaadharno" id="empaadharno" autocomplete="off">
															<span class="formerror" id="empaadharno"></span>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="form-group">
															<label class="col-form-label">Aadhar Image</label>
															<input type="file" class="form-control" name="empaadharnoimg" id="empaadharnoimg" autocomplete="off">
															<span class="formerror" id="empaadharnoimg"></span>
														</div>
													</div>

												<div class="col-sm-4" style="display:none">
												<div class="form-group">
													<label class="col-form-label">Gratuity Name</label>
														<input type="text" class="form-control" name="gratuityname" id="gratuityname" autocomplete="off">
												</div>
												</div>

    											<div class="col-sm-4">
    												<div class="form-group">
    													<label class="col-form-label">Gratuity </label>
    														<select class="form-control select2" name="gratuity" id="gratuity" style="width:100%">
    														</select>
    														<span class="formerror" id="gratuitynameerror"></span>
    												</div>
    										    </div>
    										    <div class="col-sm-4">
    										       <div class="form-group">
													<label class="col-form-label">LIC No</label>
														<input type="text" class="form-control" name="employeelicdetails" id="employeelicdetails" autocomplete="off">
												</div>
    										    </div>
												</div>
												<!-- PreviousNext -->
												<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab3" data-toggle="tab" type = "button" class="btn btn-warning" data-previous_id = "#previousempinformation" data-current_id = "#bankinformation" id="previous"> Previous </a>
													<a href="#solid-justified-tab4" data-toggle="tab" type = "button" class="btn btn-info" data-current_id = "#bankinformation" data-next_id="#addressinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->
											</div>
											<!-- Bank -->



											<!-- Address -->
											<div class="tab-pane" id="solid-justified-tab4">
												<!-- Address -->
												<div class="row">
													<div class="col-xl-6 d-flex">
														<div class="card flex-fill">
															<div class="card-header">
																<h4 class="card-title mb-0">Present Address</h4>
															</div>
															<div class="card-body">

																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">H.no / Flat.no / Door.no</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="emppreaddress1" id="emppreaddress1" autocomplete="off">
																		<span class="formerror" id="emppreaddress1error"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Address 2</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="emppreaddress2" id="emppreaddress2" autocomplete="off">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">City</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empprecity" id="empprecity" autocomplete="off">
																		<span class="formerror" id="empprecityerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">State</label>
																	<div class="col-lg-9">
																		<!--<input type="text" class="form-control" name="empprestate" id="empprestate" autocomplete="off">-->
																		<select class="form-control select2" name="empprestate" id="empprestate" style="width:100%">
                															<option value="">Select State</option>
                															<?php foreach ($states as $key => $stvalue) { ?>
                																<option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
                															<?php } ?>
                														</select>
																	</div>
																	<span class="formerror" id="empprestateerror"></span>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Country</label>
																	<div class="col-lg-9">
																		<select class="form-control select2" name="empprecountry" id="empprecountry" autocomplete="off" style="width:100%">
																		    <?php foreach($countries as $ckey => $cval){ ?>
																		        <option value="<?php echo $cval->country_name ?>" <?php if($cval->country_name == 'India'){ echo 'selected'; } ?> ><?php echo $cval->country_name ?></option>
																		    <?php } ?>
																		    </select>
																		<span class="formerror" id="empprecountryerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Postal Code</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empprepostalcode" id="empprepostalcode" autocomplete="off">
																		<span class="formerror" id="empprepostalcodeerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Address Since</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control numbersonly" name="emppresince" id="emppresince" autocomplete="off">
																		<span class="formerror" id="emppresinceerror"></span>
																	</div>
																</div>
																<div class="text-right">
																	<div class="form-group">
																		<label>Click On Below To Copy Persent Details As Permanent Details:</label>
																		<input class="form-control col-md-1 text-right copyaddress" onclick="CopyAddress()" id="copyaddress" type="checkbox">
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xl-6 d-flex">
														<div class="card flex-fill">
															<div class="card-header">
																<h4 class="card-title mb-0">Permanent Address</h4>
															</div>
															<div class="card-body">

																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">H.no / Flat.no / Door.no</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empfixedaddress1" id="empfixedaddress1" autocomplete="off">
																		<span class="formerror" id="empfixedaddress1error"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Address 2</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empfixedaddress2" id="empfixedaddress2" autocomplete="off">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">City</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empfixedcity" id="empfixedcity" autocomplete="off">
																		<span class="formerror" id="empfixedcityerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">State</label>
																	<div class="col-lg-9">
																		<!--<input type="text" class="form-control" name="empfixedstate" id="empfixedstate" autocomplete="off">-->
																		<select class="form-control select2" name="empfixedstate" id="empfixedstate" style="width:100%">
                															<option value="">Select State</option>
                															<?php foreach ($states as $key => $stvalue) { ?>
                																<option data-state_id="<?php echo $stvalue->mxst_id; ?>" value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
                															<?php } ?>
                														</select>
																		<span class="formerror" id="empfixedstateerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Country</label>
																	<div class="col-lg-9">
																		<select class="form-control select2" name="empfixedcountry" id="empfixedcountry" autocomplete="off" style="width:100%">
																		    <?php foreach($countries as $ckey => $cval){ ?>
																		        <option value="<?php echo $cval->country_name ?>" <?php if($cval->country_name == 'India'){ echo 'selected'; } ?> ><?php echo $cval->country_name ?></option>
																		    <?php } ?>
																		</select>
																		<span class="formerror" id="empfixedcountryerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Postal Code</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control" name="empfixedpostalcode" id="empfixedpostalcode" autocomplete="off">
																		<span class="formerror" id="empfixedpostalcodeerror"></span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-lg-3 col-form-label">Address Since</label>
																	<div class="col-lg-9">
																		<input type="text" class="form-control numbersonly" name="empfixedpresince" id="empfixedpresince" autocomplete="off">
																		<span class="formerror" id="empfixedpresinceerror"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Address -->
												<!-- PreviousNext -->
												<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab5" data-toggle="tab"  type = "button" class="btn btn-warning "  data-previous_id = "#bankinformation" data-current_id = "#addressinformation"  id="previous" > Previous </a>
													<a href="#solid-justified-tab7" data-toggle="tab"  type = "button" class="btn btn-info " data-current_id = "#addressinformation" data-next_id="#refrenceinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->

											</div>
											<!-- Address -->
											<!-- Family Information -->
											<div class="tab-pane" id="solid-justified-tab2">
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
															<div class="card-header">
																<h4 class="card-title mb-0">Family Information</h4>
															</div>
															<div class="card-body">

																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Title:</label>
																					<select class="form-control" name="emptitle[]" id="emptitle">
                                                                                <?php echo $controller->display_options('titles',''); ?>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Relation:</label>
																					<select class="form-control" name="empfmrelation[]" id="empfmrelation">
																						<option value="">Select Relation</option>
																						<option value="Father">Father</option>
																						<option value="Mother">Mother</option>
																						<option value="Brother">Brother</option>
																						<option value="Sister">Sister</option>
																						<option value="Husband">Husband</option>
																						<option value="Wife">Wife</option>
																						<option value="Children">Children</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Name As Per Aadhar:</label>
																					<input type="text" class="form-control" name="empfmname[]" id="empfmname" autocomplete="off" placeholder="As per Aadhar">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Date of Birth:</label>
																					<input type="text" class="form-control datetimepicker" name="empfmage[]" id="empfmage" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Occupation:</label>
																					<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-1">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_project_file">Add</button>
																				</div>
																			</div>


																		</div>
																		<span class="addfmdetails"></span>
																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>
											<!-- PreviousNext -->
											<div>&nbsp</div>
												<div class="text-right">
													<a  href="#solid-justified-tab1" data-toggle="tab" type = "button" class="btn btn-warning " data-previous_id = "#personalinformation" data-current_id = "#familyinformation" id="previous"> Previous </a>
													<a  href="#solid-justified-tab3" data-toggle="tab" type = "button" class="btn btn-info " data-current_id = "#familyinformation" data-next_id="#previousempinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->

											</div>
											<!-- Family Information -->
											<!-- Previous Employment -->
											<div class="tab-pane" id="solid-justified-tab3">
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
														<!-- 	<div class="card-header">
																<h4 class="card-title mb-0">Previous Employment</h4>
															</div> -->
															<div class="card-body">
																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">
																		    <!--
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Period From - To:</label>
																					<input type="text" class="form-control" name="emppreviousprediofromto[]" id="emppreviousprediofromto" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Name & Orgination:</label>
																					<textarea class="form-control" name="emppreviousorgnation[]" id="emppreviousorgnation"></textarea>
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Desg Joining Time:</label>
																					<input type="text" class="form-control" name="emppreviousdesgjointime[]" id="emppreviousdesgjointime" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Desg Leaving Time:</label>
																					<input type="text" class="form-control" name="emppreviousleavingtime[]" id="emppreviousleavingtime" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Reported To (Desgn):</label>
																					<input type="text" class="form-control" name="emppreviousreportedto[]" id="emppreviousreportedto" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Salary per month:</label>
																					<input type="text" class="form-control" name="empprevioussalarypermonth[]" id="empprevioussalarypermonth" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Other Benfits:</label>
																					<input type="text" class="form-control" name="emppreviousotherbenfits[]" id="emppreviousotherbenfits" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Reason For Change:</label>
																					<input type="text" class="form-control" name="emppreviousreasonchange[]" id="emppreviousreasonchange" autocomplete="off">
																				</div>
																			</div> -->
																			<div class="col-md-3"></div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_pre_file"><i class="fa fa-plus"></i>Previous Employment</button>
																				</div>
																			</div>

																		</div>
																		<span class="addpredetails"></span>
																	</div>
																</div>


															</div>
														</div>
													</div>
												</div>
												 <!-- PreviousNext -->
											<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab2" data-toggle="tab" type = "button" class="btn btn-warning " data-previous_id = "#familyinformation" data-current_id = "#previousempinformation" id="previous"> Previous </a>
													<a href="#solid-justified-tab5" data-toggle="tab" type = "button" class="btn btn-info " data-current_id = "#previousempinformation" data-next_id="#bankinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->
											</div>
											<!-- Previous Employment -->
											<!-- Authorizations -->
											<div class="tab-pane" id="solid-justified-tab8">
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
															<div class="card-header">
																<h4 class="card-title mb-0">Authorization</h4>
															</div>
															<div class="card-body">

																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">
																			<!-------------LINE 1---->
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Authorization Type:</label>
																					<select class="form-control auth_type" name="authorizationtype[]" id="authtype_1">
																						<option value="">Select Auth Type</option>
																						<option value="1">Branch</option>
																						<option value="2">Head Office</option>
																						<option value="3">HR</option>
																						<option value="4">Director</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Department Name:</label>
																					<!--<input type="text" class="form-control" name="authorizationdepartmentbr" id="authorizationdepartmentbr" autocomplete="off">-->
																					<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_1" style="width:100%">

																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Employee Name:</label>
																					<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_1" autocomplete="off" ></select>
																				</div>
																			</div>


																			<!-------------END LINE 1--------->
																			<!-------------LINE 2--------->
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Authorization Type:</label>
																					<select class="form-control auth_type" name="authorizationtype[]" id="authtype_2">
																						<option value="">Select Auth Type</option>
																						<option value="1">Branch</option>
																						<option value="2">Head Office</option>
																						<option value="3">HR</option>
																						<option value="4">Director</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Department Name:</label>
																					<!--<input type="text" class="form-control" name="authorizationdepartmenthr" id="authorizationdepartmenthr" autocomplete="off">-->
																					<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_2" style="width:100%">
																						<!--<option value="">Type</option>-->
																						<!--<option value="3">Hr</option>-->
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Employee Name:</label>
																					<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_2" autocomplete="off"></select>
																				</div>
																			</div>

																			<!-------------END LINE 2--------->
																			<!-------------LINE 3--------->

																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Authorization Type:</label>
																					<select class="form-control auth_type" name="authorizationtype[]" id="authtype_3">
																						<option value="">Select Auth Type</option>
																						<option value="1">Branch</option>
																						<option value="2">Head Office</option>
																						<option value="3">HR</option>
																						<option value="4">Director</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Department Name:</label>
																					<!--<input type="text" class="form-control" name="authorizationdepartmentdirector" id="authorizationdepartmentdirector" autocomplete="off">-->
																					<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_3" style="width:100%">
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Employee Name:</label>
																					<select type="text" class="form-control select2 emp_name" name="emp_name[]" style="width: 100%" id="empname_3" autocomplete="off"></select>
																				</div>
																			</div>
																			<!-------------END LINE 3--------->
																			<!-------------LINE 4--------->
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Authorization Type:</label>
																					<select class="form-control auth_type" name="authorizationtype[]" id="authtype_4">
																						<option value="">Select Auth Type</option>
																						<option value="1">Branch</option>
																						<option value="2">Head Office</option>
																						<option value="3">Hr</option>
																						<option value="4">Director</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Department Name:</label>
																					<!--<input type="text" class="form-control" name="authorizationdepartment[]" id="authorizationdepartment[]" autocomplete="off">-->
																					<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_4" style="width:100%">
																						<!--<option value="">Type</option>-->
																						<!--<option value="3">Hr</option>-->
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Employee Name:</label>
																					<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_4" autocomplete="off"> </select>
																				</div>
																			</div>
																			<!-------------END LINE 4--------->
																			<!-------------LINE 5--------->
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Authorization Type:</label>
																					<select class="form-control auth_type" name="authorizationtype[]" id="authtype_5">
																						<option value="">Select Auth Type</option>
																						<option value="1">Branch</option>
																						<option value="2">Head Office</option>
																						<option value="3">Hr</option>
																						<option value="4">Director</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Department Name:</label>
																					<!--<input type="text" class="form-control" name="authorizationdepartment[]" id="authorizationdepartment[]" autocomplete="off">-->
																					<select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_5" style="width:100%">
																						<!--<option value="">Type</option>-->
																						<!--<option value="3">Hr</option>-->
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>Employee Name:</label>
																					<select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_5" autocomplete="off"> </select>
																				</div>
																			</div>
																			<!-------------END LINE 5--------->
																			<div class="col-md-2"></div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div
												<!-- PreviousNext -->
											<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab7" data-toggle="tab" type = "button" class="btn btn-warning " data-previous_id = "#refrenceinformation" data-current_id = "#authorizationinformation"  id="previous"> Previous </a>
													<a href="#solid-justified-tab6" data-toggle="tab" type = "button" class="btn btn-info " data-current_id = "#authorizationinformation" data-next_id="#nomineeinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->
											</div>
											<!-- Authorizations -->
											<!-- Refrences -->
											<div class="tab-pane" id="solid-justified-tab7">
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
															<div class="card-header">
																<h4 class="card-title mb-0">Refrences Information</h4>
															</div>
															<div class="card-body">

																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">
																		    <!--
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Company Type:</label>
																					<select class="form-control" name="refrencecmptype[]" id="refrencecmptype">
																						<option value="">Type</option>
																						<option value="MAXWELL">MAXWELL</option>
																						<option value="ARC">ARC</option>
																						<option value="OTHERS">OTHERS</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Refrence Name:</label>
																					<input type="text" class="form-control" name="refrencename[]" id="refrencename" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Relation With Candidate:</label>
																					<input type="text" class="form-control" name="refrencenwcnd[]" id="refrencenwcnd" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Mobile:</label>
																					<input type="number" class="form-control" name="refrencemobile[]" id="refrencemobile" autocomplete="off">
																				</div>
																			</div> -->
																			<div class="col-md-4"> </div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_refrence_file">Add Reference Information</button>
																				</div>
																			</div>


																		</div>
																		<span class="addrefrencedetails"></span>

																		<!-- Guarantors documents -->
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Guarantors Documents:</label>
																				<input type="file" class="form-control" name="guarantors" id="guarantors" autocomplete="off">
																			</div>
																		</div>

																		<!-- Guarantor documents -->

																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>
												 <!-- PreviousNext -->
											<div>&nbsp</div>
											    <div class="text-right">
													<a href="#solid-justified-tab4" data-toggle="tab" type = "button" class="btn btn-warning " data-previous_id = "#addressinformation" data-current_id = "#refrenceinformation"  id="previous"> Previous </a>
													<a href="#solid-justified-tab8" data-toggle="tab" type = "button" class="btn btn-info " data-current_id = "#refrenceinformation" data-next_id="#authorizationinformation" id="next"> Next </a>
												</div>
											<!-- PreviousNext -->

											</div>
											<!-- Refrences -->
											<!-- Nominee Details -->
											<div class="tab-pane" id="solid-justified-tab6">
												<div class="row">
													<div class="col-md-12">
														<div class="card mb-0">
															<div class="card-header">
																<h4 class="card-title mb-0">Nominee Information</h4>
															</div>
															<div class="card-body">

																<div class="row">
																	<div class="col-xl-12">
																		<div class="row">

																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Nominee Type:</label>
																					<select class="form-control" name="esinomineerelationtype[]" id="esinomineerelationtype">
																						<option value="">Type</option>
																						<option value="ESI">ESI</option>
																						<option value="PF">PF</option>
																						<option value="GRATUITY">GRATUITY</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Nominee Relation:</label>
																					<select class="form-control" name="esinomineerelation[]" id="esinomineerelation">
																						<option value="">Relation</option>
																						<option value="Father">Father</option>
																						<option value="Mother">Mother</option>
																						<option value="Brother">Brother</option>
																						<option value="Sister">Sister</option>
																						<option value="Husband">Husband</option>
																						<option value="Wife">Wife</option>
																						<option value="Children">Children</option>
																						<option value="Others">Others</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Name:</label>
																					<input type="text" class="form-control" name="esinomineename[]" id="esinomineename" autocomplete="off">
																				</div>
																			</div>
																			<div class="col-md-1">
																				<div class="form-group">
																					<label>Age:</label>
																					<input type="text" class="form-control" name="esinomineeage[]" id="esinomineeage" autocomplete="off">
																				</div>
																			</div>

																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Mobile:</label>
																					<input type="text" class="form-control numbersonly" name="esinomineemobile[]" id="esinomineemobile" autocomplete="off">
																				</div>
																			</div>

																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Address</label>
																					<textarea class="form-control" name="esinomineeaddress[]" id="esinomineeaddress"></textarea>
																				</div>
																			</div>

																			<div class="col-md-2">
																				<div class="form-group">
																					<label>Nominee %:</label>
																					<input type="text" class="form-control numbersonly_with_dot" name="esinomineepercent[]" id="esinomineepercent" autocomplete="off">
																				</div>
																			</div>

																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Image</label>
																					<input type="file" class="form-control" name="esinomineeimage[]" id="esinomineeimage" autocomplete="off">
																				</div>
																			</div>

																			<div class="col-md-2">
																				<div class="form-group">
																					<label>&nbsp;</label>
																					<button type="button" class="form-control btn btn-info add_esi_file">Add More</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<span class="addesidetails"></span>
																<div class="text-right">
																	<button type="submit" class="btn btn-primary" id="processempdata">Submit</button>
																</div>
															</div>
														</div>
													</div>
												</div>

											   <!-- PreviousNext -->
											<div>&nbsp</div>
												<div class="text-right">
													<a href="#solid-justified-tab8" data-toggle="tab" type = "button" class="btn btn-warning " data-previous_id = "#authorizationinformation" data-current_id = "#nomineeinformation" id="previous"> Previous </a>
												</div>
											<!-- PreviousNext -->
											</div>
											</div>
											<!-- Nominee Details -->

										</div>
									</div>
								</div>
							</div>
						</div>

					</form>

				</div>
			</div>
			<script>
				// $('input').on('paste', function (event) {
				//   if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
				//     event.preventDefault();
				//   }
				// });

				// $("input").on("keypress",function(event){
				//     if(event.which <= 48 || event.which >=57){
				//         return false;
				//     }
				// });
				function readURL(input, img) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						reader.onload = function(e) {
							if (img == 'img1') {
								$('#blah1').attr('src', e.target.result);
							}
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
			</script>

			<script>
				var languages = '<?php echo json_encode($language); ?>';
				languages = JSON.parse(languages);
			</script>
			<script src="<?php echo base_url() ?>assets/js/formsjs/employeehtml.js"></script>
			<script>
				var emp = 1;
			</script>
			<script src="<?php echo base_url() ?>assets/js/formsjs/employee.js"></script>

			<script>

				$(document).on("click","#next",function(){
					var next_id = $(this).data("next_id");
					var current_id = $(this).data("current_id");
					$(next_id).trigger('click');
					var hash = window.location.hash;
					hash && $('ul.nav a[href="' + hash + '"]').tab('show');
					$(this).tab('show');
						var scrollmem = $('body').scrollTop();
						window.location.hash = this.hash;
						$('html,body').scrollTop(scrollmem);
						$(next_id).addClass("active");
					    $(current_id).removeClass("active");
				});

				$(document).on("click","#previous",function(){
					var current_id = $(this).data("current_id");
					var previous_id = $(this).data("previous_id");
					$(previous_id).trigger('click');
					var hash = window.location.hash;
					hash && $('ul.nav a[href="' + hash + '"]').tab('show');
					$(this).tab('show');
						var scrollmem = $('body').scrollTop();
						window.location.hash = this.hash;
						$('html,body').scrollTop(scrollmem);
						$(previous_id).addClass("active");
				    	$(current_id).removeClass("active");
				});

				$(function() {
					var hash = window.location.hash;
					hash && $('ul.nav a[href="' + hash + '"]').tab('show');

					$('.nav-item a').click(function(e) {
						$(this).tab('show');
						var scrollmem = $('body').scrollTop();
						window.location.hash = this.hash;
						$('html,body').scrollTop(scrollmem);
					});
				});
			</script>

			<script>
				function CopyAddress() {
					var cpaddress = $('.copyaddress').is(':checked');
					if (cpaddress == true) {
						var add1 = $("#emppreaddress1").val();
						$("#empfixedaddress1").val(add1);
						var add12 = $("#emppreaddress2").val();
						$("#empfixedaddress2").val(add12);
						var addcity = $("#empprecity").val();
						$("#empfixedcity").val(addcity);
						var addstate = $("#empprestate").val();
        				$('#empfixedstate').val(addstate).trigger("change");
				// 		$("#empfixedstate").val(addstate);
						var addcountry = $("#empprecountry").val();
						$("#empfixedcountry").val(addcountry);
						var addemppstcode = $("#empprepostalcode").val();
						$("#empfixedpostalcode").val(addemppstcode);
						var emppresince = $("#emppresince").val();
						$("#empfixedpresince").val(emppresince);
					} else {
						$("#empfixedaddress1").val('');
						$("#empfixedaddress2").val('');
						$("#empfixedcity").val('');
						$("#empfixedstate").val('').trigger("change");
						$("#empfixedcountry").val('');
						$("#empfixedpostalcode").val('');
						$("#empfixedpresince").val('');

					}
				}
			</script>