<?php 
//print_r($loanhistory['loanhistory']);
?>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
												<a href="#"><img alt="" src="<?php echo base_url() . $loanhistory['employeeinfo'][0]->mxemp_emp_img ?>"></a>
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0">
															<a href="#">
															<?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_fname .' '. $loanhistory['employeeinfo'][0]->mxemp_emp_lname ?>
														</a>
														</h3>


<div class="small doj text-muted">Mobile : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_phone_no ?></div>
<div class="small doj text-muted">Alt Mobile : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_alt_phn_no ?></div>

														<div class="staff-id"><a href="#">Employee ID : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_id ?></a></div>
														<div class="small doj text-muted">Date of Join : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_date_of_join ?></div>
														<div class="small doj text-muted">Gender : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_gender ?></div>
														<div class="small doj text-muted">Age : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_age ?></div>
														<div class="small doj text-muted">Salary : <?php echo $loanhistory['employeeinfo'][0]->mxemp_emp_current_salary ?></div>

															<div class="small doj text-muted">Tenure Months : <?php echo $loanhistory['loandetails'][0]->mxemploan_emp_loan_tenure_months ?></div>

															<div class="small doj text-muted">Type : <?php echo $loanhistory['loandetails'][0]->mxemploan_emp_loan_type ?></div>

															<div class="small doj text-muted">Approved By : <?php echo $loanhistory['loandetails'][0]->mxemploan_emp_loan_approvedby ?></div>

															<div class="small doj text-muted">Reason For Loan : <?php echo $loanhistory['loandetails'][0]->mxemploan_emp_reasonfor_loan ?></div>


														<!-- <div class="staff-msg"><a class="btn btn-custom" href="#">Send Message</a></div> -->

													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">LOAN ID:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxemploan_load_id ?></a></div>
														</li>
														<li>
															<div class="title">Company:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxcp_name ?></a></div>
														</li>
														<li>
															<div class="title">Division:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxd_name ?></a></div>
														</li>
														<li>
															<div class="title">State:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxst_state ?></a></div>
														</li>
														<li>
															<div class="title">Branch:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxb_name ?></a></div>
														</li>

														<li>
															<div class="title">Approved:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxemploan_emp_loan_amt_approved ?> 
															<a class="link attach-icon" target="_blank" href="<?php echo base_url().$loanhistory['loandetails'][0]->mxemploan_emp_attachements ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></a>
														</a></div>
														</li>

														<li>
															<div class="title">EMI Date:</div>
															<div class="text">
															    <a href="#">
															    <?php
															    $startdate = $loanhistory['loandetails'][0]->mxemploan_emi_startdate;
															    $year = substr($startdate, 0, 4);
                                                                $month = substr($startdate, 4, 2);
                                                                $date = DateTime::createFromFormat('Ym', $startdate);
                                                                $monthName = $date->format('F');
                                                                $str = $year .'-'. $monthName;
                                                                $enddate = $loanhistory['loandetails'][0]->mxemploan_emi_enddate;
															    $year = substr($enddate, 0, 4);
                                                                $month = substr($enddate, 4, 2);
                                                                $date = DateTime::createFromFormat('Ym', $enddate);
                                                                $monthName = $date->format('F');
															    $end = $year .'-'. $monthName;
															    echo $str.' || '.$end;
															    ?>
															   </a>
															</div>
														</li>
														<li>
															<div class="title">Debit:</div>
															<div class="text"><a href="#"><?php echo $loanhistory['loandetails'][0]->mxemploan_emp_loan_monthly_emi_amt ?></a></div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th>Sno</th>
													<th class="text-center">Payment Date</th>
													<th class="text-center">Current Pay</th>
													<th class="text-center">Debited</th>
													<th class="text-center">Advance Pay</th>
													<th class="text-center">Fore Closure</th>
													<th class="text-center">Outstanding</th>
													<th class="text-center">Loan Status</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$sno=1; 
												$numItems = count($loanhistory['loanhistorytransactions']);
												$i = 0;
												foreach ($loanhistory['loanhistorytransactions'] as $keys => $historyview) {
													//echo  "<pre>";print_r($historyview);
													//echo  "<pre>";print_r($keys);die;
												 ?>

												<tr>
													<td class="text-center"><?php echo $sno; ?></td>
													<td class="text-center">
														<?php
														
														if($keys == 0){
														#echo '<span style="color:red">OPENED</span>'.'<br>'.date('d-M-Y H:i:s A', strtotime($loanhistory['loandetails'][0]->mxemploan_createdtime));
												//echo date('d-M-Y H:i:s A', strtotime($loanhistory['loandetails'][0]->mxemploan_createdtime));
												echo $loanhistory['loandetails'][0]->mxemploan_createdtime;
														}else{
														echo date('d-M-Y H:i:s A', strtotime($historyview->mxemploan_modifiedtime));
														}
														 ?>
													</td>
													<td class="text-center">
														<?php echo $historyview->mxemploan_emp_loan_current_paid_amt ?>
													</td>
													<td class="text-center">
														<?php echo $historyview->mxemploan_emp_loan_debited_amt ?>
													</td>
													<td class="text-center">
														<?php echo $historyview->mxemploan_emp_loan_advance_pay_amt ?>
													</td>
													<td class="text-center">
														<?php echo $historyview->mxemploan_emp_loan_forecloser_pay_amt ?>
													</td>
													<td class="text-center">
														<?php echo $historyview->mxemploan_emp_loan_outstanding_amt ?>
													</td>
													<td class="text-center">
														<?php
														$loan_status = $historyview->mxemploan_emp_payment_type;
														if($historyview->mxemploan_emp_information == 'OPEN' && $loan_status == ''){
														    $loan_status = $historyview->mxemploan_emp_information;
														}elseif($loan_status == 'AD1'){
														    $loan_status = 'Debited ('.$historyview->mxemploan_emp_modeofpayment.')';
														}elseif($loan_status == 'FC1'){
														    $loan_status = 'Forecloser ('.$historyview->mxemploan_emp_modeofpayment.')';
														}
														echo $loan_status;
														?>
													</td>
												</tr>
												<?php 
												$current += $historyview->mxemploan_emp_loan_current_paid_amt;
												$debit += $historyview->mxemploan_emp_loan_debited_amt;
												$advance += $historyview->mxemploan_emp_loan_advance_pay_amt;
												$foreclosure += $historyview->mxemploan_emp_loan_forecloser_pay_amt;
												  if(++$i === $numItems) {
													 $outstanding = $historyview->mxemploan_emp_loan_outstanding_amt;
												  }
												 ?>
											<?php $sno++;} ?>
									<tr>
										<th></th>
													<th class="text-center"></th>
													<th class="text-center"><?php echo $current.'.00'; ?></th>
													<th class="text-center"><?php echo $debit.'.00'; ?></th>
													<th class="text-center"><?php echo $advance.'.00'; ?></th>
													<th class="text-center"><?php echo $foreclosure.'.00'; ?></th>
													<th class="text-center"><?php echo $outstanding ?></th>
													<th class="text-center"><?php
														if($outstanding < $loanhistory['loandetails'][0]->mxemploan_emp_loan_amt_approved && $outstanding == '0.00'){
															echo 'SETTLED';
														}else{
															echo 'PROCESS';
														}
													 ?></th>
												</tr>
											</tbody>
										</table>
</div>
						<!-- Detailed Transaction history -->
