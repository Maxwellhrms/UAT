			<?php         #echo '<pre>';
			#print_r($controller);
				#print_r($emp); ?>
				<!-- Page Wrapper -->
				<div class="page-wrapper">

					<!-- Page Content -->
					<div class="content container-fluid">

						<!-- Page Header -->
						<div class="page-header">
							<div class="row">
								<div class="col-sm-12">
									<h3 class="page-title">Profile</h3>
									<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
										<li class="breadcrumb-item active">Profile</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /Page Header -->

						<div class="card mb-0">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="profile-view">
											<div class="profile-img-wrap">
												<div class="profile-img">
													<a href="#"><img alt="<?php echo $emp['employeeinfo'][0]->mxemp_emp_fname ?>" src="<?php echo HRADMINROOTDOCUMENT.$emp['employeeinfo'][0]->mxemp_emp_img ?>"></a>
												</div>
											</div>
											<div class="profile-basic">
												<div class="row">
													<div class="col-md-5">
														<div class="profile-info-left">
															<h3 class="user-name m-t-0 mb-0"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fname .' '. $emp['employeeinfo'][0]->mxemp_emp_lname; ?></h3>
															<h6 class="text-muted"><?php echo $emp['employeeinfo'][0]->mxcp_name ?></h6>
															<small class="text-muted"><?php echo $emp['employeeinfo'][0]->mxdesg_name ?></small>
															<div class="staff-id">Employee ID : <?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?></div>
															<div class="small doj text-muted">Date of Join : <?php echo date('d-M-Y',strtotime($emp['employeeinfo'][0]->mxemp_emp_date_of_join)); ?></div>
															<?php 
																// 		$mainstatus = '';
																// 		echo $emp['employeeinfo'][0]->mxemp_emp_resignation_status;exit;
																if($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'R' && $emp['employeeinfo'][0]->mxemp_emp_status == 1 && $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 0){
																	$mainstatus = 'Resigned(Notice Period)';
																}else if($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'R' && $emp['employeeinfo'][0]->mxemp_emp_status == 1 && $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 1){
																	$mainstatus = 'Resigned(Without Notice Period)';
																}elseif ($emp['employeeinfo'][0]->mxemp_emp_status == 1 && $emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'W') {
																	$mainstatus = 'Working';
																}elseif ($emp['employeeinfo'][0]->mxemp_emp_status == 1 && $emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'N') {
																	$mainstatus = 'Notice Period';
																}
																// 		echo $mainstatus;exit;
															?>
															<div class="staff-msg">
																<a class="btn btn-custom m-t-0 mb-0"><?php echo $mainstatus; ?>
																	<span id="resigncountdown"></span>
																</a>
															</div>
														</div>
													</div>
													<div class="col-md-7">
														<ul class="personal-info">

															<li>
																<div class="title">Phone:</div>
																<div class="text"><a href=""><?php echo $emp['employeeinfo'][0]->mxemp_emp_phone_no ?></a></div>
															</li>
															<li>
																<div class="title">Email:</div>
																<div class="text"><a href=""><?php echo $emp['employeeinfo'][0]->mxemp_emp_email_id ?></a></div>
															</li>
															<li>
																<div class="title">Birthday:</div>
																<div class="text"><?php echo date('d-M-Y',strtotime($emp['employeeinfo'][0]->mxemp_emp_date_of_birth)); ?></div>
															</li>
															<li>
																<div class="title">Address:</div>
																<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_address1 .','. $emp['employeeinfo'][0]->mxemp_emp_present_city .','. $emp['employeeinfo'][0]->mxemp_emp_present_state .','. $emp['employeeinfo'][0]->mxemp_emp_present_country .','. $emp['employeeinfo'][0]->mxemp_emp_present_postalcode ?></div>
															</li>
															<li>
																<div class="title">Gender:</div>
																<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_gender ?></div>
															</li>
															<li>
																<div class="title">Experience:</div>
																<div class="text"><?php 
																	$date1 = $emp['employeeinfo'][0]->mxemp_emp_date_of_join;
																	$date2 = $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_date;
																	date_default_timezone_set("Asia/Calcutta");

																	if($date2 != '0000-00-00 00:00:00' && $date2 !=''){
																		$date2 = date('Y-m-d', strtotime($date2));
																	}else{
																		$date2 = date("Y-m-d");
																	}
																	$bday=new DateTime($date1);
																	$relivingdate = new DateTime($date2);
																	$age=$bday->diff($relivingdate);
																	$re = array("years" => $age->y,"months" => $age->m,"days" => $age->d);
																	printf("$age->y years, $age->m months,$age->d days\n");
																?></div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card tab-box">
							<div class="row user-tabs">
								<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
									<ul class="nav nav-tabs nav-tabs-bottom">
										<li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>
										<li class="nav-item"><a href="#emp_reporting" data-bs-toggle="tab" class="nav-link">Reporting To</a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="tab-content">

							<!-- Profile Info Tab -->
							<div id="emp_profile" class="pro-overview tab-pane fade show active">
								<div class="row">
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Personal Informations</h3>
												<ul class="personal-info">
													<li>
														<div class="title">Relation</div>
														<div class="text">(<?php echo $emp['employeeinfo'][0]->mxemp_emp_relation ?>) <?php echo $emp['employeeinfo'][0]->mxemp_emp_relation_name ?></div>
													</li>
													<li>
														<div class="title">Salary Paying</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_current_salary ?></div>
													</li>
													<li>
														<div class="title">Employee Age</div>
														<div class="text"><?php //echo $emp['employeeinfo'][0]->mxemp_emp_age ?>
															<?php
																$date1 = date('d-m-Y',strtotime($emp['employeeinfo'][0]->mxemp_emp_date_of_birth));
																$dob=$day.'-'.$month.'-'.$year;
																$dob = date('d-m-Y', strtotime($date1));
																$bday=new DateTime($dob);
																$age=$bday->diff(new DateTime);
																$today=date('d-m-Y');
																echo $age->y .' years, '.$age->m.' months, '.$age->d.' days';
																// $date2 = date("Y-m-d");
																// $diff = abs(strtotime($date2) - strtotime($date1));
																// $years = floor($diff / (365*60*60*24));
																// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
																// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
																// printf("%d years, %d months, %d days\n", $years, $months, $days); 
															?>
														</div>
													</li>
													<li>
														<div class="title">Mobile No.</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_phone_no ?></div>
													</li>
													<li>
														<div class="title">Alternate Mobile No.</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_alt_phn_no ?></div>
													</li>
													<li>
														<div class="title">Email</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_email_id ?></div>
													</li>
													<li>
														<div class="title">Company Email</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_company_email_id  ?></div>
													</li>

													<li>
														<div class="title">Mother Tongue</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_mother_tongue ?></div>
													</li>

													<li>
														<div class="title">Caste</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_caste ?></div>
													</li>

													<li>
														<div class="title">Vehicle</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_having_vehicle ?></div>
													</li>

													<li>
														<div class="title">Vehicle Type</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_vehicle_type ?></div>
													</li>

													<li>
														<div class="title">License</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_license ?></div>
													</li>
													<li>
														<div class="title">Marital status</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_marital_status ?>(<?php echo $emp['employeeinfo'][0]->empmaritaldate ?>)</div>
													</li>
													<li>
														<div class="title">Guarantors Details</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_empguarantorsdetails ?></div>
													</li>
													<li>
														<div class="title">Guarantors Letter</div>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_guarantors_letter)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_guarantors_letter ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>                                                                                                        
														<div class="text"></div>
													</li>

													<!-- <hr> -->
													<?php foreach($emp['employeelanaguages'] as $lgkey => $lgvalues){ ?>
													<li>
														<div class="title"><?php echo $lgvalues->mxlg_name ?></div>
														<div class="text"><?php echo $lgvalues->mxemp_emp_lng_speak .','. $lgvalues->mxemp_emp_lng_read .','. $lgvalues->mxemp_emp_lng_write ?></div>
													</li>

													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Emergency Contact</h3>
												<h4 class="section-title">Primary</h4>
												<ul class="personal-info">
													<li>
														<div class="title">Address1</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_address1 ?></div>
													</li>
													<li>
														<div class="title">Address2</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_address2 ?></div>
													</li>
													<li>
														<div class="title">City </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_city ?></div>
													</li>
													<li>
														<div class="title">State </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_state ?></div>
													</li>

													<li>
														<div class="title">Country </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_country ?></div>
													</li>

													<li>
														<div class="title">Postal Code </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_present_postalcode ?></div>
													</li>
												</ul>
												<hr>
												<h4 class="section-title">Secondary</h4>
												<ul class="personal-info">
													<li>
														<div class="title">Address1</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_address1 ?></div>
													</li>
													<li>
														<div class="title">Address2</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_address2 ?></div>
													</li>
													<li>
														<div class="title">City </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_city ?></div>
													</li>
													<li>
														<div class="title">State </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_state ?></div>
													</li>

													<li>
														<div class="title">Country </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_country ?></div>
													</li>

													<li>
														<div class="title">Postal Code </div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_fixed_postalcode ?></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Bank information</h3>
												<ul class="personal-info">
												    <li>
														<div class="title">Employee Name As Per Bank</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_nameasperbank ?></div>
													</li>
													<li>
														<div class="title">Bank name</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_name ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_bankimage)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_bankimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
													<li>
														<div class="title">Bank Branch</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_branch_name ?></div>
													</li>
													<li>
													    <div class="title">Bank account No.</div>
													    <div class="text">
													        <span id="bank_account_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_bank_acc_no); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_bank_acc_no)){ ?>
													           	<a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_acc_no; ?>" data-target="#bank_account_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													    </div>
													</li>

													<li>
														<div class="title">IFSC Code</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_ifsci_no ?></div>
													</li>
													<li>
													    <div class="title">PAN No</div>
													    <div class="text">
													        <span id="pan_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_panno); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_panno)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_panno; ?>" data-target="#pan_no">
													            	<i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_panimage)){ ?>
													            <a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_panimage ?>">
													                <img src="<?php echo base_url() ?>assets/img/attachment.png" alt="">
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
														<div class="title">ESI No</div>
														<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_esi_number ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_esiimage)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_esiimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
													<li>
													    <div class="title">PF No</div>
													    <div class="text">
													        <span id="pf_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_pf_number); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_pf_number)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_pf_number; ?>" data-target="#pf_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
													    <div class="title">UAN No</div>
													    <div class="text">
													        <span id="uan_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_uan_number); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_uan_number)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_uan_number; ?>" data-target="#uan_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
													    <div class="title">LIC No</div>
													    <div class="text">
													        <span id="lic_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_employee_lic_no); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_employee_lic_no)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_employee_lic_no; ?>" data-target="#lic_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
													    <div class="title">Gratuity</div>
													    <div class="text">
													        <span id="gratuity_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_gratuity); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_gratuity)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_gratuity; ?>" data-target="#gratuity_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
													    <div class="title">Aadhar Card No</div>
													    <div class="text">
													        <span id="aadhar_no">
													            <?php echo maskNumber($emp['employeeinfo'][0]->mxemp_emp_aadhar); ?>
													        </span>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_aadhar)){ ?>
													            <a href="javascript:void(0)" class="toggleMask ms-2" data-value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_aadhar; ?>" data-target="#aadhar_no">
													                <i class="fa fa-eye"></i>
													            </a>
													        <?php } ?>
													        <?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_aadharimage)){ ?>
													            <a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_aadharimage ?>">
													                <img src="<?php echo base_url() ?>assets/img/attachment.png" alt="">
													            </a>
													        <?php } ?>
													    </div>
													</li>
													<li>
														<div class="title">Mediclaim File 1</div>
														<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info1 ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info1)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_lic_info1 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
													<li>
														<div class="title">Mediclaim File 2</div>
														<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info2 ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info2)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_lic_info2 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
													<li>
														<div class="title">Mediclaim File 3</div>
														<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info3 ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info3)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_lic_info3 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
													<li>
														<div class="title">Mediclaim File 4</div>
														<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info4 ?>
														<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info4)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo HRADMINROOTDOCUMENT . $emp['employeeinfo'][0]->mxemp_emp_lic_info4 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														<?php } ?>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Family Informations</h3>
												<div class="table-responsive">
													<table class="table table-nowrap">
														<thead>
															<tr>
															    <th>Title</th>
																<th>Name</th>
																<th>Relationship</th>
																<th>Birth Date</th>
																<th>Age</th>
																<th>Occupation</th>
																<th>Edit</th>
																<th>Approval Status</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($emp['employeefm'] as $key => $fmvalue) { ?>
															<tr>
															    <td><?php echo $fmvalue->mxemp_emp_fm_title ?></td>
																<td><?php echo $fmvalue->mxemp_emp_fm_name ?></td>
																<td><?php echo $fmvalue->mxemp_emp_fm_relation ?></td>
																<td><?php echo date('d-m-Y', strtotime($fmvalue->mxemp_emp_fm_age)) ?></td>
																<td>    
																    <?php
	                                                                  if($fmvalue->mxemp_emp_fm_age != ''){
	                                                                    $dateOfBirth = date('d-m-Y', strtotime($fmvalue->mxemp_emp_fm_age));
	                                                                    $today = date("Y-m-d");
	                                                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
	                                                                    echo $diff->format('%y');
	                                                                  }else{
	                                                                    echo '';
	                                                                  }
	                                                                ?>
																</td>
																<td><?php echo $fmvalue->mxemp_emp_fm_occupation ?></td>
																<td class="text-end">
																	<div class="dropdown dropdown-action">
																		<a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
																		<div class="dropdown-menu dropdown-menu-right">
																			<a href="#" class="dropdown-item openCommonModal" data-bs-toggle="modal"data-page="familyinfo" data-familyid="<?php echo $fmvalue->mxemp_emp_fm_id; ?>" data-employeeid="<?php echo $fmvalue->mxemp_emp_fm_employee_id; ?>" data-bs-target="#commonModal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																		</div>
																	</div>
																</td>
																<td><?php 
																	if($fmvalue->status == '0'){
																		echo 'Pending';
																	}elseif($fmvalue->status == '1'){
																		echo 'Approved';
																	}elseif($fmvalue->status == '2'){
																		echo 'Rejected';
																	}
																?></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- Family Info Modal -->
<!-- 									<div id="family_info_modal" class="modal custom-modal fade" role="dialog">
									</div> -->
									<div class="modal fade" id="commonModal" tabindex="-1">

									    <div class="modal-dialog modal-lg">
									        <div class="modal-content">
									            <div class="modal-header">
									                <h5 class="modal-title">
									                    Edit
									                </h5>
									                <button type="button"
									                        class="btn-close"
									                        data-bs-dismiss="modal">
									                </button>
									            </div>
									            <div class="modal-body" id="commonModalBody">
									                <div class="text-center p-5">
									                    Loading...
									                </div>
									            </div>
									        </div>
									    </div>
									</div>
									<!-- /Family Info Modal -->
								</div>
								<div class="row">
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Education Informations</h3>
												<div class="experience-box">
													<ul class="experience-list">
														<?php foreach ($emp['employeeacr'] as $key => $acrvalue) { ?>
															<li>
																<div class="experience-user">
																	<div class="before-circle"></div>
																</div>
																<div class="experience-content">
																	<div class="timeline-content">
																		<a href="#" class="name"><?php echo $acrvalue->mxemp_emp_acr_university ?> (<?php echo $acrvalue->mxemp_emp_acr_type ?>)</a>
																		<div><?php echo $acrvalue->mxemp_emp_acr_subject ?></div>
																		<span class="time"><?php echo $acrvalue->mxemp_emp_acr_yop ?></span>
																	</div>
																</div>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 d-flex">
										<div class="card profile-box flex-fill">
											<div class="card-body">
												<h3 class="card-title">Experience</h3>
												<div class="experience-box">
													<ul class="experience-list">
														<?php foreach ($emp['employeepe'] as $key => $prevalue) { ?>
															<li>
																<div class="experience-user">
																	<div class="before-circle"></div>
																</div>
																<div class="experience-content">
																	<div class="timeline-content">
																		<a href="#/" class="name"><?php echo $prevalue->mxemp_emp_pe_nameandorg ?></a>
																		<span class="time"><?php echo $prevalue->mxemp_emp_pe_periodfromto ?> (<?php echo $prevalue->mxemp_emp_pe_reasonforchange ?>)</span>
																	</div>
																</div>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							<div class="row">
								<div class="col-md-12 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title"  align="center">Nominee Informations</h3>
											<div class="table-responsive">
												<table class="table table-nowrap">
													<thead>
														<tr>
															<th>Type</th>
															<th>Relationship</th>
															<th>Name</th>
															<th>Age</th>
															<th>Mobile</th>
															<th>Address</th>
															<th>Prefrence</th>
															<th>Image</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($emp['employeenominee'] as $key => $nomineevalue) { ?>
														<tr>
															<td><?php echo $nomineevalue->mxemp_emp_nm_type ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relation ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relationname ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relationage ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relationmobile ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relationaddress ?></td>
															<td><?php echo $nomineevalue->mxemp_emp_nm_relationpercent ?></td>
															<td>
															<?php if(!empty($nomineevalue->mxemp_emp_nm_relationimage)){ ?>
															<a class="link attach-icon" target="_blank" href="<?php echo  HRADMINROOTDOCUMENT. $nomineevalue->mxemp_emp_nm_relationimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
															<?php } ?>
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
							</div>
							<!-- /Profile Info Tab -->

							<!-- Reporting To Tab -->
							<div class="tab-pane fade" id="emp_reporting">
								<?php #print_r($emp['authorization']); ?>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
										<div class="card">
											<div class="card-body">
												<div class="row staff-grid-row">
													<?php foreach($emp['authorization'] as $mpkey => $reportings){ ?>
													<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
														<div class="profile-widget">
															<div class="profile-img">
																<a class="avatar"><img height="80px" width="80px" src="<?php echo HRADMINROOTDOCUMENT. $reportings->mxemp_emp_img ?>" alt=""></a>
															</div>
															<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#"><?php echo $reportings->mxemp_emp_fname ?></a></h4>
															<div class="small text-muted">Status : <?php echo $reportings->working_status ?> </div>
															<div class="small text-muted"><?php echo $reportings->mxauth_auth_dept_name ?></div>
														</div>
													</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
							<!-- /Reporting To Tab -->

						</div>
					</div>
					<!-- /Page Content -->
				</div>
			<!-- /Page Wrapper -->
<script>
	$(document).on('click', '.openCommonModal', function () {
	    var page       = $(this).data('page');
	    var familyid   = $(this).data('familyid');
	    var employeeid = $(this).data('employeeid');
	    $('#commonModal').modal('show');
	    $('#commonModalBody').html(
	        '<div class="text-center p-5">Loading...</div>'
	    );
	    $.ajax({
	        url: "<?php echo base_url('employee/employeemodalpopup'); ?>",
	        type: "POST",
	        data: {
	            page       : page,
	            familyid   : familyid,
	            employeeid : employeeid
	        },
	        success: function (response) {
	            $('#commonModalBody').html(response);
	                if($('.select').length > 0) {
						$('.select').select2({
					        dropdownParent: $('.applymultiselect'),
					        width: '100%'
					    });
					}
					if($('.datetimepicker1').length > 0) {
						$('.datetimepicker1').datetimepicker({
							format: 'DD-MM-YYYY',
							icons: {
								up: "fa fa-angle-up",
								down: "fa fa-angle-down",
								next: 'fa fa-angle-right',
								previous: 'fa fa-angle-left'
							}
						});
					}
	        }
	    });
	});
	</script>