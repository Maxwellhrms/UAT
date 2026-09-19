<?php
// echo '<pre>'; print_r($emp['employeeinfo'][0]);exit;
?>		
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
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
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
												<img alt="Employee image" src="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_img ?>" width="160px" height="160px">
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
														<?php if($this->session->userdata('user_role_edit') == 1){ ?>
														<div class="staff-msg text-right">
														    <a href="<?php echo base_url() ?>employee/employeecard/<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>" class="btn btn-custom m-t-0 mb-0">Employee Card</a>
								                            <a href="<?php echo base_url() ?>employee/editemployeesprofile/<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>" class="btn btn-custom m-t-0 mb-0">Edit Employee Details</a>
							                            </div>
							                            <?php } ?>
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
                                                                    // $date2 = date("Y-m-d");
                                                                    // $diff = abs(strtotime($date2) - strtotime($date1));
                                                                    // $years = floor($diff / (365*60*60*24));
                                                                    // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                                    // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                                    // printf("%d years, %d months, %d days\n", $years, $months, $days);
                                                                    $bday=new DateTime($date1);
                                                                    $relivingdate = new DateTime($date2);
                                                                    $age=$bday->diff($relivingdate);
                                                                    $re = array("years" => $age->y,"months" => $age->m,"days" => $age->d);
                                                                    printf("$age->y years, $age->m months,$age->d days\n");
															 ?></div>
														</li>
<!-- 														<li>
															<div class="title">Reports to:</div>
															<div class="text">
															   <div class="avatar-box">
																  <div class="avatar avatar-xs">
																	 <img src="assets/img/profiles/avatar-16.jpg" alt="">
																  </div>
															   </div>
															   <a href="profile.html">
																	Jeffery Lalor
																</a>
															</div>
														</li> -->

							
														<?php
														    if ($emp['employeeinfo'][0]->mxemp_emp_status == 1 && $emp['employeeinfo'][0]->mxemp_emp_resignation_status != 'R' && $emp['employeeinfo'][0]->mxemp_emp_resignation_status != 'N') { 
															$resign = "Add Resignation";
												 		    echo '<div class="staff-msg text-right"><a class="btn btn-info" data-target="#resign_modal" data-toggle="modal" style="color: #fff;">'.$resign.'</a></div>';
												 			}elseif($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'N' || $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 1){
												 			$resign = "Update Resignation";	
												 		    echo '<div class="staff-msg text-right"><a class="btn btn-info" data-target="#resign_modal" data-toggle="modal" style="color: #fff;">'.$resign.'</a></div>';
												 		    }elseif($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'R' || $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 0){
												 		    $resign = "Resigned";	
												 		    echo '<div class="staff-msg text-right"><a class="btn btn-info" data-target="#resign_modal" data-toggle="modal" style="color: #fff;">'.$resign.'</a></div>';  
												 		    }
														?>
													</ul>
												</div>
											</div>
										</div>
										<!-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card tab-box">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom">
									<li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
									<li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Transfers History</a></li>
									<li class="nav-item"><a href="#emp_prom_inc" data-toggle="tab" class="nav-link">Promotion Increments</a></li>
									<li class="nav-item"><a href="#emp_inc" data-toggle="tab" class="nav-link">Increments</a></li>
									<li class="nav-item"><a href="#emp_arr_inc" data-toggle="tab" class="nav-link">Arrears Increments</a></li>
									<li class="nav-item"><a href="#emp_auth" data-toggle="tab" class="nav-link">Authorization Under You</a></li>
									<li class="nav-item"><a href="#emp_letters" data-toggle="tab" class="nav-link">Letters</a></li>
									<!-- <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li> -->
								</ul>
							</div>
						</div>
					</div>
					
					<div class="tab-content">
					
						<!-- Profile Info Tab -->
						<div id="emp_profile" class="pro-overview tab-pane fade show active">

<!-- Company information -->
							<div class="row">
								<div class="col-md-12 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title"  align="center" style="color: #ff9b44">Employee Company Information
											 <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<div class="table-responsive">
												<table class="table table-nowrap">
													<thead>
														<tr>
															<th>Company Name</th>
															<th>Division</th>
															<th>Branch</th>
															<th>Departements</th>
															<th>Grade</th>
															<th>Designation</th>
															<th>State</th>
															<th>Employee Type</th>
														</tr>
													</thead>
													<tbody>

														<tr>
															<td><?php echo $emp['employeeinfo'][0]->mxcp_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxd_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxb_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxdpt_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxgrd_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxdesg_name ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxst_state ?></td>
															<td><?php echo $emp['employeeinfo'][0]->mxemp_ty_name ?></td>
														</tr>
<!-- 															<td class="text-right">
																<div class="dropdown dropdown-action">
																	<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																		<a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
																	</div>
																</div>
															</td> -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
<!-- Company information -->
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title" align="center" style="color: #ff9b44">Personal Informations 
<!-- 												<a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
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
<?php } ?>                                                                                                        <div class="text">
</div>
                                                                                                </li>

<hr>
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
											<h3 class="card-title" align="center" style="color: #ff9b44">Address 
												<!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
											<h5 class="section-title" align="center" style="color: #ff9b44">Present Address</h5>
											<hr>
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
											<h5 class="section-title"  align="center" style="color: #ff9b44">Permanent</h5>
											<hr>
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
											<h3 class="card-title"  align="center" style="color: #ff9b44">Bank information</h3>
											<hr>
											<ul class="personal-info">
											    <li>
													<div class="title">Employee Name As Per Bank</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_nameasperbank ?></div>
												</li>
												<li>
													<div class="title">Bank name</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_name ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_bankimage)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_bankimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">Bank Branch</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_branch_name ?></div>
												</li>
												<li>
													<div class="title">Bank account No.</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_acc_no ?></div>
												</li>
												<li>
													<div class="title">IFSC Code</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_bank_ifsci_no ?></div>
												</li>
												<li>
													<div class="title">PAN No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_panno ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_panimage)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_panimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
                                                    </div>
												</li>
												<li>
													<div class="title">ESI No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_esi_number ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_esiimage)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_esiimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">PF No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_pf_number ?></div>
												</li>
												<li>
													<div class="title">UAN No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_uan_number ?></div>
												</li>
												<li>
													<div class="title">LIC No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_employee_lic_no ?></div>
												</li>
												<li>
													<div class="title">Gratuity</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_gratuity ?></div>
												</li>
												<li>
													<div class="title">Aadhar Card No</div>
													<div class="text"><?php echo $emp['employeeinfo'][0]->mxemp_emp_aadhar ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_aadharimage)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_aadharimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">Mediclaim File 1</div>
													<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info1 ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info1)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_lic_info1 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">Mediclaim File 2</div>
													<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info2 ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info2)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_lic_info2 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">Mediclaim File 3</div>
													<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info3 ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info3)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_lic_info3 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
													<?php } ?>
													</div>
												</li>
												<li>
													<div class="title">Mediclaim File 4</div>
													<div class="text"><?php #echo $emp['employeeinfo'][0]->mxemp_emp_lic_info4 ?>
													<?php if(!empty($emp['employeeinfo'][0]->mxemp_emp_lic_info4)){ ?>
														<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_lic_info4 ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
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
											<h3 class="card-title"  align="center" style="color: #ff9b44">Family Informations
											 <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a> -->
											</h3>
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
														</tr>
														<?php } ?>
<!-- 															<td class="text-right">
																<div class="dropdown dropdown-action">
																	<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																		<a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
																	</div>
																</div>
															</td> -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Education Informations -->
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title" align="center" style="color: #ff9b44">Education Informations
											 <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
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
								<!-- Education Informations -->
								<!-- Experience -->
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title" align="center" style="color: #ff9b44">Experience
										<!-- 	 <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
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
								<!-- Experience -->
							</div>
							<!-- Training Details -->
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title" align="center" style="color: #ff9b44">Training Informations
											 <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
											<div class="experience-box">
												<ul class="experience-list">
													<?php foreach ($emp['employeetr'] as $key => $atrvalue) { ?>
													<li>
														<div class="experience-user">
															<div class="before-circle"></div>
														</div>
														<div class="experience-content">
															<div class="timeline-content">
																<a href="#" class="name"><?php echo $atrvalue->mxemp_emp_tr_nameofinstutions ?></a>
																<div><?php echo $atrvalue->mxemp_emp_tr_nameofcourse ?></div>
																<span class="time"><?php echo $atrvalue->mxemp_emp_tr_fromdate ?> - <?php echo $atrvalue->mxemp_emp_tr_todate ?></span>
															</div>
														</div>
													</li>
												<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Training Details -->
								<!-- Refrence -->
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title" align="center" style="color: #ff9b44">Refrence
										<!-- 	 <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a> -->
											</h3>
											<hr>
											<div class="experience-box">
												<ul class="experience-list">
													<?php foreach ($emp['employeerefrence'] as $key => $refrencevalue) { ?>
													<li>
														<div class="experience-user">
															<div class="before-circle"></div>
														</div>
														<div class="experience-content">
															<div class="timeline-content">
																<a href="#" class="name"><?php echo $refrencevalue->mxemp_emp_rf_relation ?> - (<?php echo $refrencevalue->mxemp_emp_rf_type ?>)</a>
																<span class="time"><?php echo $refrencevalue->mxemp_emp_rf_relationname ?> (<?php echo $refrencevalue->mxemp_emp_rf_relationmobile ?>)</span>
															</div>
														</div>
													</li>
												<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Refrence -->
							</div>
							<!-- Training Details -->

							<div class="row">
								<div class="col-md-12 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title"  align="center" style="color: #ff9b44">Nominee Informations
											 <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a> -->
											</h3>
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
<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $nomineevalue->mxemp_emp_nm_relationimage ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
<?php } ?>
</td>
														</tr>
														<?php } ?>
<!-- 															<td class="text-right">
																<div class="dropdown dropdown-action">
																	<a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																		<a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
																	</div>
																</div>
															</td> -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- /Profile Info Tab -->
						
						<!-- Projects Tab -->
						<div class="tab-pane fade" id="emp_projects">
							<div class="row">

								
							<div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
							<div class="card">
							<div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Type</th>
                                            <th>From Company</th>
                                            <th>To Company</th>
                                            <th>From Division</th>
                                            <th>To Division</th>
                                            <th>From State</th>
                                            <th>To State</th>
                                            <th>From Branch</th>
                                            <th>To Branch</th>
                                            <th>From date</th>
                                            <th>To Date</th>
                                            <th>Esi Join</th>
                                            <th>Esi Relieaving</th>
                                            <!--<th>Employee Join</th>-->
                                            <th>Employee Relieaving</th> 
                                            <th>From Amount</th> 
                                            <th>To Amount</th> 
                                            <!-- <th>Edit</th>                                            -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php $sno = 1; foreach ($emp['employeetransfers'] as $keyemptrf => $valueemptrf) { ?>

                                            <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_type ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_comp_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_comp_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_div_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_div_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_state_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_state_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_branch_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_branch_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_from_dt ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_to_dt ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_esi_joining_date ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_esi_relieaving_date ?></td>
                                            <!--<td><?php //echo $valueemptrf->mxemp_trs_emp_joining_date ?></td>-->
                                            <td><?php echo $valueemptrf->mxemp_trs_emp_releaving_date ?></td>
                                            <td><?php echo $valueemptrf->maxwell_emp_from_amount ?></td>
                                            <td><?php echo $valueemptrf->maxwell_emp_to_amount ?></td>
<!--                                             <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td> -->
                                        </tr>
                                    	<?php $sno++; } ?>

                                    </tbody>
                                </table>
                            </div>
										</div>
									</div>
								</div>
								

							</div>
						</div>
						<!-- /Projects Tab -->
						
						<!--PROMOTION INC-->
						<div class="tab-pane fade" id="emp_prom_inc">
							<div class="row">
							    <div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
    							<div class="card">
        							<div class="card-body">
                                        <div class="table-responsive">
                                            <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>EmpId</th>
                                                        <th>EmpName</th>
                                                        <th>Amount</th>
                                                        <th>Affect Date</th>
                                                        <th>From Cmp Name</th>
                                                        <th>From Div Name</th>
                                                        <th>From State Name</th>
                                                        <th>From Branch Name</th>
                                                        <th>From Desig Name</th>
                                                        <th>From Grade Name</th>
                                                        <th>To Cmp Name</th>
                                                        <th>To Div Name</th>
                                                        <th>To State Name</th>
                                                        <th>To Branch Name</th>
                                                        <th>To Desig Name</th>
                                                        <th>To Grade Name</th>
                                                        <!--<th>Edit</th>-->
                                        </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sno = 1;foreach($emp['promotion_inc'] as $prom_inc){ ?>
                                                    <tr>
                                                        <td><?php echo $sno; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_emp_code; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_emp_fname.' '.$prom_inc->mxemp_emp_lname; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_amount; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_joining_date; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_comp_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_div_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_state_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_branch_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_desg_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_grade_name_from; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_comp_name_to; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_div_name_to; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_state_name_to; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_branch_name_to; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_desg_name_to; ?></td>
                                                        <td><?php echo $prom_inc->mxemp_prm_grade_name_to; ?></td>
                                                        <?php $sno++; ?>
                                                    </tr>
                                                    <?php }?>
                                    </tbody>
                                            </table>
                                        </div>
									</div>
								</div>
							</div>
							</div>
						</div>
						<!--END PROMOTION INC-->
						
						<!--INCREMENT INC-->
						<div class="tab-pane fade" id="emp_inc">
							<div class="row">
    							<div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
        							<div class="card">
            							<div class="card-body">
                                            <div class="table-responsive">
                                                <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sno</th>
                                                            <th>EmpId</th>
                                                            <th>EmpName</th>
                                                            <th>Amount</th>
                                                            <th>Affect Date</th>
                                                            <th>Comp Name</th>
                                                            <th>Div Name</th>
                                                            <th>State Name</th>
                                                            <th>Branch Name</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php $sno = 1; foreach($emp['special_inc'] as $inc){ ?>
                                                         <tr>
                                                             <td> <?php echo $sno; ?> </td>
                                                             <td> <?php echo $inc->mxemp_spl_inc_emp_code; ?> </td>
                                                             <td> <?php echo $inc->mxemp_emp_fname .' '.$inc->mxemp_emp_lname; ?> </td>
                                                             <td> <?php echo $inc->mxemp_spl_inc_amount; ?> </td>
                                                             <td> <?php echo $inc->mxemp_spl_inc_affect_dt_ymd; ?> </td>
                                                             <td> <?php echo $inc->mxcp_name; ?> </td>
                                                             <td> <?php echo $inc->mxd_name; ?> </td>
                                                             <td> <?php echo $inc->mxb_state_name; ?> </td>
                                                             <td> <?php echo $inc->mxb_name; ?> </td>
                                                         </tr>
                                                     <?php $sno++; }?>
                
                                                </tbody>
                                                </table>
                                            </div>
										</div>
									</div>
								</div>
								

							</div>
						</div>
						<!--END INCREMENT-->
						
						<!--ARREAR INC-->
						<div class="tab-pane fade" id="emp_arr_inc">
							<div class="row">
							    <div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
    							    <div class="card">
        							    <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                                                 <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>EmpId</th>
                                                        <th>EmpName</th>
                                                        <th>Amount</th>
                                                        <th>Start Date</th>
                                                        <th>Affect Date</th>
                                                        <th>Comp Name</th>
                                                        <th>Div Name</th>
                                                        <th>State Name</th>
                                                        <th>Branch Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sno = 1; foreach($emp['arear_inc'] as $arr_inc){ ?>
                                                     <tr>
                                                         <td> <?php echo $sno; ?> </td>
                                                         <td> <?php echo $arr_inc->mxemp_arears_emp_code; ?> </td>
                                                         <td> <?php echo $arr_inc->mxemp_emp_fname .' '.$inc->mxemp_emp_lname; ?> </td>
                                                         <td> <?php echo $arr_inc->mxemp_arears_amount; ?> </td>
                                                         <td> <?php echo $arr_inc->mxemp_arears_start_dt; ?> </td>
                                                         <td> <?php echo $arr_inc->mxemp_arears_affect_dt; ?> </td>
                                                         <td> <?php echo $arr_inc->mxcp_name; ?> </td>
                                                         <td> <?php echo $arr_inc->mxd_name; ?> </td>
                                                         <td> <?php echo $arr_inc->mxb_state_name; ?> </td>
                                                         <td> <?php echo $arr_inc->mxb_name; ?> </td>
                                                     </tr>
                                                 <?php $sno++; }?>
            
                                                </tbody>
                                            </table>
                                            </div>
        							    </div>
    							    </div>
							    </div>
							</div>
						</div>
						<!--END ARREAR INC-->

						<!--Authorization -->
						<div class="tab-pane fade" id="emp_auth">
							<div class="row">
							    <div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
    							    <div class="card">
        							    <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                                 <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>EmpId</th>
                                                        <th>EmpName</th>
                                                        <th>Authorized Employee</th>
                                                        <th>Status</th>
                                                        <th>Created Time</th>
                                                        <th>Modified Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sno = 1; foreach($emp['authorizationemployees_underyou'] as $authz){ ?>
                                                     <tr>
                                                         <td> <?php echo $sno; ?> </td>
                                                         <td> <?php echo $authz->mxauth_emp_code; ?> </td>
                                                         <td> <?php echo $authz->mxemp_emp_fname .' '.$inc->mxemp_emp_lname; ?> </td>
                                                         <td> <?php echo $authz->mxauth_reporting_head_emp_code; ?> </td>
                                                         <td> <?php if($authz->mxauth_status == 1){ echo 'Active';}else{ echo 'Inactive';} ?> </td>
                                                         <td> <?php echo $authz->mxauth_createdtime; ?> </td>
                                                         <td> <?php echo $authz->mxauth_modifiedtime; ?> </td>
                                                     </tr>
                                                 <?php $sno++; }?>
            
                                                </tbody>
                                            </table>
                                            </div>
        							    </div>
    							    </div>
							    </div>
							</div>
						</div>
						<!--END Authorization -->

						<!--Employee Letters -->
	<div class="tab-pane fade" id="emp_letters">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-4 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="datatable table table-stripped mb-0">

                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Document Type</th>
                                    <th>Document Name</th>
                                    <th>Issued Date</th>
                                    <th>Employee Approved Date</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $sno = 1;

                                foreach ($emp['employeedocuments'] as $doc) {
                                ?>

                                    <tr>

                                        <td>
                                            <?php echo $sno; ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo isset($documenttype[$doc->document_type])
                                                ? $documenttype[$doc->document_type]
                                                : '';
                                            ?>
                                        </td>

                                        <td>
                                            <?php echo $doc->document_name; ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo !empty($doc->issued_date)
                                                ? date('d-m-Y', strtotime($doc->issued_date))
                                                : '';
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo !empty($doc->employee_approved_date)
                                                ? date('d-m-Y', strtotime($doc->employee_approved_date))
                                                : '';
                                            ?>
                                        </td>

                                        <td>
                                            <?php if (!empty($doc->file_path)) { ?>

                                                <a href="<?php echo base_url($doc->file_path); ?>"
                                                   target="_blank"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i> View
                                                </a>

                                            <?php } else { ?>

                                                <span class="text-muted">
                                                    No Document
                                                </span>

                                            <?php } ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($doc->status == 1) {
                                                echo 'Active';
                                            } else {
                                                echo 'Inactive';
                                            }
                                            ?>
                                        </td>

                                    </tr>

                                <?php
                                    $sno++;
                                }
                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
						<!--END Employee Letters -->
						
						<!-- Bank Statutory Tab -->
						<div class="tab-pane fade" id="bank_statutory">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title"> Basic Salary Information</h3>
									<form>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select salary basis type</option>
														<option>Hourly</option>
														<option>Daily</option>
														<option>Weekly</option>
														<option>Monthly</option>
													</select>
											   </div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">$</span>
														</div>
														<input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Payment type</label>
													<select class="select">
														<option>Select payment type</option>
														<option>Bank transfer</option>
														<option>Check</option>
														<option>Cash</option>
													</select>
											   </div>
											</div>
										</div>
										<hr>
										<h3 class="card-title"> PF Information</h3>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">PF contribution</label>
													<select class="select">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">PF No. <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Employee PF rate</label>
													<select class="select">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select additional rate</option>
														<option>0%</option>
														<option>1%</option>
														<option>2%</option>
														<option>3%</option>
														<option>4%</option>
														<option>5%</option>
														<option>6%</option>
														<option>7%</option>
														<option>8%</option>
														<option>9%</option>
														<option>10%</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Total rate</label>
													<input type="text" class="form-control" placeholder="N/A" value="11%">
												</div>
											</div>
									   </div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Employee PF rate</label>
													<select class="select">
														<option>Select PF contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select additional rate</option>
														<option>0%</option>
														<option>1%</option>
														<option>2%</option>
														<option>3%</option>
														<option>4%</option>
														<option>5%</option>
														<option>6%</option>
														<option>7%</option>
														<option>8%</option>
														<option>9%</option>
														<option>10%</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Total rate</label>
													<input type="text" class="form-control" placeholder="N/A" value="11%">
												</div>
											</div>
										</div>
										
										<hr>
										<h3 class="card-title"> ESI Information</h3>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">ESI contribution</label>
													<select class="select">
														<option>Select ESI contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select ESI contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Employee ESI rate</label>
													<select class="select">
														<option>Select ESI contribution</option>
														<option>Yes</option>
														<option>No</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
													<select class="select">
														<option>Select additional rate</option>
														<option>0%</option>
														<option>1%</option>
														<option>2%</option>
														<option>3%</option>
														<option>4%</option>
														<option>5%</option>
														<option>6%</option>
														<option>7%</option>
														<option>8%</option>
														<option>9%</option>
														<option>10%</option>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label">Total rate</label>
													<input type="text" class="form-control" placeholder="N/A" value="11%">
												</div>
											</div>
									   </div>
										
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" type="submit">Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- /Bank Statutory Tab -->
						
					</div>
                </div>
				<!-- /Page Content -->

<!-- MODAL START FORM HERE -->
				<!-- Resign Modal -->
				<div id="resign_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Resign Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" id="processresigndata">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Resign Status</label>
												<select class="form-control" name="resign_status">
												            <?php //if($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'W'){
												            ?>
												                <option value="W"  <?php if(isset($emp['employeeinfo'][0]->mxemp_emp_resignation_status) && $emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'W'){ echo "selected"; } ?>>Working</option>';

												                <option value="N"  <?php if(isset($emp['employeeinfo'][0]->mxemp_emp_resignation_status) && $emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'N'){ echo "selected"; } ?>>Notice Period</option>';
															    <option value="WN" <?php if(isset($emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period) && $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 1){ echo "selected"; } ?>>Without Notice Period</option>';
															<?php
												            //}
												            ?>
															
												</select>
												<span class="formerror" id="resign_statuserror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Resign Reason</label>
												<select name="resignreason" id="resignreason" class="form-control select2" style="width:100%">
												<?php echo $controller->display_options('resign_reasons',$emp['employeeinfo'][0]->mxemp_emp_resignation_reason); ?>
												</select>
												<span class="formerror" id="resignreasonerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Resign PF Reason</label>
												<select name="resignpfreason" id="resignpfreason" class="form-control select2" style="width:100%">
												<?php $sql4 = " SELECT * FROM maxwell_pf_reasons    ";
	$result4 = $this->db->query($sql4);
	$lastrowofareq4=$result4->result_array();
	$oldLead_id4=$result4->num_rows() ;
	if($oldLead_id4>0){
		//$class_name=$lastrowofareq4['0']['class_name'];		
		foreach ($lastrowofareq4 as $row4) {           
			$mxpf_rsn_name = $row4['mxpf_rsn_name'];
			?>
			<option value="<?php echo $mxpf_rsn_name; ?>"  <?php if($emp['employeeinfo'][0]->mxemp_emp_resignation_pf_reason==$mxpf_rsn_name){ echo "selected";} ?>><?php echo $mxpf_rsn_name; ?></option>
			<?php 

		}
	}?>
												</select>
												<span class="formerror" id="resignreasonerror"></span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>Resign Date</label>
												<div class="cal-icon">
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_date) && $emp['employeeinfo'][0]->mxemp_emp_resignation_date != '0000-00-00 00:00:00'){
													 $mxemp_emp_resignation_date = date('d-m-Y', strtotime($emp['employeeinfo'][0]->mxemp_emp_resignation_date));
													}else{
														$mxemp_emp_resignation_date = '';
													}
													  ?>
													<input class="form-control datea" name="resigndate" id="resigndate" type="text" autocomplete="off" value="<?php echo $mxemp_emp_resignation_date ?>">
													<span class="formerror" id="resigndateerror"></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Relieving Date</label>
												<div class="cal-icon">
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_date) && $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_date != '0000-00-00 00:00:00'){
													 $mxemp_emp_resignation_relieving_date = date('d-m-Y', strtotime($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_date));
													}else{
														$mxemp_emp_resignation_relieving_date = '';
													}
													  ?>
												<input class="form-control datea" name="relievingdate" id="relievingdate" type="text" autocomplete="off" value="<?php echo $mxemp_emp_resignation_relieving_date ?>">
												<span class="formerror" id="relievingdateerror"></span>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="unpay_sal_month">
											    <?php
											    if($emp['employeeinfo'][0]->mxemp_emp_unpay_sal_months != ""){
											      ?>
											      <label>Unpay Salary Months</label>
													<div class="form-group row">
													        <!--MONTH LOOP -->
													        <?php
													        $decode_unpay_sal_array = json_decode($emp['employeeinfo'][0]->mxemp_emp_unpay_sal_months);
													        if(count($decode_unpay_sal_array) > 0){
													            foreach($decode_unpay_sal_array as $dec_unpay_sal){
													            ?>
													                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input inc_type" type="checkbox" name="unpay_months[]" value="<?php echo $dec_unpay_sal ?>" checked>
                                                                        <label class="form-check-label">
                                                                            <?php echo date('m-Y',strtotime($dec_unpay_sal)); ?>
                                                                        </label>
                                                                    </div>        
													                <?php
													            }
													        }
													        ?>
                                                            
                                                            <!--END MONTH LOOP-->
                                                            <span class="formerror" id="variablepay_error"></span>
                                                    </div>
											      <?php
											    }
											    ?>
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Relieving Settlement Date</label>
												<div class="cal-icon">
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_settlement_date) && $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_settlement_date != '0000-00-00 00:00:00'){
													 $mxemp_emp_resignation_relieving_settlement_date = date('d-m-Y', strtotime($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_settlement_date));
													}else{
														$mxemp_emp_resignation_relieving_settlement_date = '';
													}
													  ?>
												<input class="form-control datetimepicker" name="relievingsettlementdate" id="relievingsettlementdate" type="text" autocomplete="off" value="<?php echo $mxemp_emp_resignation_relieving_settlement_date ?>">
												<span class="formerror" id="relievingsettlementdateerror"></span>
												</div>
											</div>
										</div>
										<?php
										$esiGrossSalLimit = isset($emp['esi_master'][0]->mxesi_gross_sal_limit) ? $emp['esi_master'][0]->mxesi_gross_sal_limit : 0;
										$empCurrentSal    = $emp['employeeinfo'][0]->mxemp_emp_current_salary;
										if(intVal($empCurrentSal) > intVal($esiGrossSalLimit)){
										?>
										<div class="col-md-6">
											<div class="form-group">
												<label>ESI Reason</label>
												<select name="esireason" id="esireason" class="form-control select2" style="width:100%">
												<?php echo $controller->display_options('esiReasons',$emp['employeeinfo'][0]->mxemp_emp_esi_reason); ?>
												</select>
												<span class="formerror" id="esireasonerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Relieving Esi Settlement Date</label>
												<div class="cal-icon">
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_esi_settlement_date) && $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_esi_settlement_date != '0000-00-00 00:00:00'){
													 $mxemp_emp_resignation_relieving_esi_settlement_date = date('d-m-Y', strtotime($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_esi_settlement_date));
													}else{
														$mxemp_emp_resignation_relieving_esi_settlement_date = '';
													}
													  ?>
												<input class="form-control datetimepicker" name="relievingesisettlementdate" id="relievingesisettlementdate" type="text" autocomplete="off" value="<?php echo $mxemp_emp_resignation_relieving_esi_settlement_date ?>">
												<span class="formerror" id="relievingesisettlementdateerror"></span>
												</div>
											</div>
										</div>
										<?php } ?>
										<div class="col-md-6">
											<div class="form-group">
												<label>Relieving Pf Settlement Date</label>
												<div class="cal-icon">
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_pf_settlement_date) && $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_pf_settlement_date != '0000-00-00 00:00:00'){
													 $mxemp_emp_resignation_relieving_pf_settlement_date = date('d-m-Y', strtotime($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_pf_settlement_date));
													}else{
														$mxemp_emp_resignation_relieving_pf_settlement_date = '';
													}
													  ?>
												<input class="form-control datetimepicker" name="relievingpfsettlementdate" id="relievingpfsettlementdate" type="text" autocomplete="off" value="<?php echo $mxemp_emp_resignation_relieving_pf_settlement_date ?>">
												<span class="formerror" id="relievingpfsettlementdateerror"></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Relieving Settlement Amount</label>
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_settlement_amount)){
													 $mxemp_emp_resignation_relieving_settlement_amount = $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_settlement_amount;
													}else{
														$mxemp_emp_resignation_relieving_settlement_amount = '';
													}
													  ?>
												<input class="form-control" name="relievingsettlementamount" id="relievingsettlementamount" type="number" autocomplete="off" value="<?php echo $mxemp_emp_resignation_relieving_settlement_amount ?>">
												<span class="formerror" id="relievingsettlementamounterror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Resignation Letter</label>
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_resignationletter)){
													 $mxemp_emp_resignationletter = $emp['employeeinfo'][0]->mxemp_emp_resignationletter;
													}else{
														$mxemp_emp_resignationletter = '';
													}
													  ?>
												<input class="form-control" name="resignationletter" id="resignationletter" type="file">
												<span class="formerror" id="resignationlettererror"></span>
											</div>
										</div>
										<div class="col-md-6"><?php if($mxemp_emp_resignationletter !=''){ ?>
										<a class="link attach-icon" target="_blank" href="<?php echo base_url() . $mxemp_emp_resignationletter ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
										 <?php } ?></div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Joining Orgination</label>
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_joiningorgination)){
													 $mxemp_emp_joiningorgination = $emp['employeeinfo'][0]->mxemp_emp_joiningorgination;
													}else{
														$mxemp_emp_joiningorgination = '';
													}
													  ?>
												<input class="form-control" name="joiningorgination" id="joiningorgination" type="text" value="<?php echo $mxemp_emp_joiningorgination; ?>">
												<span class="formerror" id="joiningorginationerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Joining Orgination Offer Package</label>
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_joiningorginationofferpackage)){
													 $mxemp_emp_joiningorginationofferpackage = $emp['employeeinfo'][0]->mxemp_emp_joiningorginationofferpackage;
													}else{
														$mxemp_emp_joiningorginationofferpackage = '';
													}
													  ?>
												<input class="form-control" name="joiningorginationofferpackage" id="joiningorginationofferpackage" type="text" value="<?php echo $mxemp_emp_joiningorginationofferpackage; ?>">
												<span class="formerror" id="joiningorginationofferpackageerror"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Joining Orgination Designation</label>
													<?php
													if(!empty($emp['employeeinfo'][0]->mxemp_emp_joiningorginationdesignation)){
													 $mxemp_emp_joiningorginationdesignation = $emp['employeeinfo'][0]->mxemp_emp_joiningorginationdesignation;
													}else{
														$mxemp_emp_joiningorginationdesignation = '';
													}
													  ?>
												<input class="form-control" name="joiningorginationdesignation" id="joiningorginationdesignation" type="text" value="<?php echo $mxemp_emp_joiningorginationdesignation; ?>">
												<span class="formerror" id="joiningorginationdesignationerror"></span>
											</div>
										</div>
										<input type="hidden" name="empresignautouniqueid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>">
										<input type="hidden" name="empresignid" value="<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>">
									</div>
									<?php if($this->session->userdata('user_role_edit') == 1 && $this->session->userdata('user_role') == 1){ ?>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit">Submit</button>
										<!--<div class="staff-msg text-right"><a class="btn btn-info" data-target="#unpay_sal_modal" data-toggle="modal" style="color: #fff;">Add Unpaid Sal For Months</a></div>-->

										<?php 
										$status = $emp['employeeinfo'][0]->mxemp_emp_resignation_status;
										$isAdminUser = $this->session->userdata('user_id') == '888666';

										if ((in_array($status, ['N', 'R']) && $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 0) || $isAdminUser) { 
										?>
										    <button class="btn btn-warning submit-btn" type="button" onclick="cancelresignation('<?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?>','<?php echo $emp['employeeinfo'][0]->mxemp_emp_autouniqueid ?>')">
										        Cancel Resignation
										    </button>
										<?php } ?>
										
										<script>
										window.onload = function(){
								            $(".datea").datetimepicker({
                                                format: 'DD-MM-YYYY',
                                    			icons: {
                                    				up: "fa fa-angle-up",
                                    				down: "fa fa-angle-down",
                                    				next: 'fa fa-angle-right',
                                    				previous: 'fa fa-angle-left'
                                    			}
                                        	}).on('dp.change', function (e) { display_unpay_sal()  });
										}
										  
                                          function display_unpay_sal() {
                                                let resign_date = $("#resigndate").val().trim();
    									        let relieve_date = $("#relievingdate").val().trim();
    									        let resign_status = $("select[name=resign_status]").val().trim();
                                                // alert(resign_status);
    									        
    									        if(resign_date == '' || relieve_date == '' || resign_status != 'N'){
    									            $("#unpay_sal_month").html('');
    									        }else{
    									          //  alert(resign_date + '---' + relieve_date);
    									            $.ajax({
    											      url: baseurl + 'Admin/build_unpay_sal_month',
    											      type: 'POST',
    											      data: { resign_date: resign_date, relieve_date : relieve_date ,resign_status:resign_status},
    											      success: function (data) {
    											          $("#unpay_sal_month").html(data);    
    											      },
    											    });
    									        }                       
    									  }
    									  //-------------NEW BY SHABABU(23-04-2022)
    									  $('select[name=resign_status]').change(function(){
    									      let resign_status = $(this).val().trim();
    									      if(resign_status != 'N'){
    									          $("#unpay_sal_month").html('');
    									      }else{
    									          display_unpay_sal();
    									      }
    									  });
    									  //-------------END NEW BY SHABABU(23-04-2022)
                                              
                //                            										  
											function cancelresignation(empcode,empuniqueid){
											    $.ajax({
											      url: baseurl + 'Employee/updateemployeeresignationdetails',
											      type: 'POST',
											      data: { employeecode: empcode, empid : empuniqueid },
											      success: function (data) {
											        if (data == 200) {
											            alert('Successfully');
											            setTimeout(function(){
											            window.location.reload();
											            }, 1000); 
											        } else {
											        	alert('Failed Please TryAgain later');
											        }
											      },
											    });
											}
										</script>
									</div>
									<?php } ?>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				
				
<script>
$("form#processresigndata").submit(function(e) {
e.preventDefault();
var resignreason = $("#resignreason").val();
	if(resignreason ==""){
	$("#resignreason").focus();
	$('#resignreasonerror').html("Please Enter Resign Reason");
	return false;
	}else{$('#resignreasonerror').html("");}

var resigndate = $("#resigndate").val();
	if(resigndate ==""){
	$("#resigndate").focus();
	$('#resigndateerror').html("Please Enter Resign Date");
	return false;
	}else{$('#resigndateerror').html("");}
var esi_max_gross_sal = '<?php echo $esiGrossSalLimit ?>';
var emp_sal             = '<?php echo $empCurrentSal ?>';
// if(parseInt(emp_sal) > parseInt(esi_max_gross_sal)){
    var relievingdate = $("#relievingdate").val();
	if(relievingdate ==""){
	$("#relievingdate").focus();
	$('#relievingdateerror').html("Please Enter Relieving Date");
	return false;
	}else{$('#relievingdateerror').html("");}
// }


// var relievingsettlementdate = $("#relievingsettlementdate").val();
// 	if(relievingsettlementdate ==""){
// 	$("#relievingsettlementdate").focus();
// 	$('#relievingsettlementdateerror').html("Please Enter Relieving Settlement Date");
// 	return false;
// 	}else{$('#relievingsettlementdateerror').html("");}

// var relievingesisettlementdate = $("#relievingesisettlementdate").val();
// 	if(relievingesisettlementdate ==""){
// 	$("#relievingesisettlementdate").focus();
// 	$('#relievingesisettlementdateerror').html("Please Enter Relieving Settlement ESI Date");
// 	return false;
// 	}else{$('#relievingesisettlementdateerror').html("");}

// var relievingpfsettlementdate = $("#relievingpfsettlementdate").val();
// 	if(relievingpfsettlementdate ==""){
// 	$("#relievingpfsettlementdate").focus();
// 	$('#relievingpfsettlementdateerror').html("Please Enter Relieving Settlement PF Date");
// 	return false;
// 	}else{$('#relievingpfsettlementdateerror').html("");}

// var relievingsettlementamount = $("#relievingsettlementamount").val();
// 	if(relievingsettlementamount ==""){
// 	$("#relievingsettlementamount").focus();
// 	$('#relievingsettlementamounterror').html("Please Enter Settlement Amount");
// 	return false;
// 	}else{$('#relievingsettlementamounterror').html("");}

var formData = new FormData(this);
mainurl = baseurl+'admin/saveemployeefndfresigndata';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
        if (data == 200) {
            alert('Successfully');
            setTimeout(function(){
            window.location.reload();
            }, 1000); 
        } else {
        	alert('Failed To Save Please TryAgain later');
        }
    },
    cache: false,
    contentType: false,
    processData: false
});


	});
</script>
<?php// if($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 1){ ?>
<?php if($emp['employeeinfo'][0]->mxemp_emp_resignation_status == 'N' && $emp['employeeinfo'][0]->mxemp_emp_is_without_notice_period == 0){ ?>
<script>
// Set the date we're counting down to
var relevingdate = "<?php echo $emp['employeeinfo'][0]->mxemp_emp_resignation_relieving_date; ?>";
var countDownDate = new Date(relevingdate).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("resigncountdown").innerHTML = "/ Relieving " + days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("resigncountdown").innerHTML = "Relieving";
  }
}, 1000);
</script>
<?php } ?>
				<!-- /Resign Modal -->


	
				<!-- Profile Modal -->
				<div id="profile_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Profile Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-md-12">
											<div class="profile-img-wrap edit-img">
												<img class="inline-block" src="assets/img/profiles/avatar-02.jpg" alt="user">
												<div class="fileupload btn">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>First Name</label>
														<input type="text" class="form-control" value="John">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Last Name</label>
														<input type="text" class="form-control" value="Doe">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Birth Date</label>
														<div class="cal-icon">
															<input class="form-control datetimepicker" type="text" value="05/06/1985">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Gender</label>
														<select class="select form-control">
															<option value="male selected">Male</option>
															<option value="female">Female</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" value="4487 Snowbird Lane">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>State</label>
												<input type="text" class="form-control" value="New York">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>
												<input type="text" class="form-control" value="United States">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Pin Code</label>
												<input type="text" class="form-control" value="10523">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" class="form-control" value="631-889-3206">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Department</option>
													<option>Web Development</option>
													<option>IT Management</option>
													<option>Marketing</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Designation <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Designation</option>
													<option>Web Designer</option>
													<option>Web Developer</option>
													<option>Android Developer</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Reports To <span class="text-danger">*</span></label>
												<select class="select">
													<option>-</option>
													<option>Wilmer Deluna</option>
													<option>Lesley Grauer</option>
													<option>Jeffery Lalor</option>
												</select>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Profile Modal -->
				
				<!-- Personal Info Modal -->
				<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Personal Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Passport No</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Passport Expiry Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Tel</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Nationality <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Religion</label>
												<div class="cal-icon">
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Marital status <span class="text-danger">*</span></label>
												<select class="select form-control">
													<option>-</option>
													<option>Single</option>
													<option>Married</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Employment of spouse</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>No. of children </label>
												<input class="form-control" type="text">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Personal Info Modal -->
				
				<!-- Family Info Modal -->
				<div id="family_info_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"> Family Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Name <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Relationship <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Date of birth <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Phone <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Name <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Relationship <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Date of birth <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Phone <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Family Info Modal -->
				
				<!-- Emergency Contact Modal -->
				<div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Personal Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Primary Contact</h3>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Relationship <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone 2</label>
														<input class="form-control" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Primary Contact</h3>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Relationship <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone 2</label>
														<input class="form-control" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Emergency Contact Modal -->
				
				<!-- Education Modal -->
				<div id="education_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"> Education Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Oxford University" class="form-control floating">
															<label class="focus-label">Institution</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Computer Science" class="form-control floating">
															<label class="focus-label">Subject</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Starting Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Complete Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="BE Computer Science" class="form-control floating">
															<label class="focus-label">Degree</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Grade A" class="form-control floating">
															<label class="focus-label">Grade</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Oxford University" class="form-control floating">
															<label class="focus-label">Institution</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Computer Science" class="form-control floating">
															<label class="focus-label">Subject</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Starting Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Complete Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="BE Computer Science" class="form-control floating">
															<label class="focus-label">Degree</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Grade A" class="form-control floating">
															<label class="focus-label">Grade</label>
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Education Modal -->
				
				<!-- Experience Modal -->
				<div id="experience_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Experience Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Experience Modal -->
				
            </div>
            <?php //echo "<pre>";print_r($emp); ?>
            <script>
               
            </script>
			<!-- /Page Wrapper -->
