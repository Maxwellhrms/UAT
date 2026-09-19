			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
                    <form id="fandfdetails_left_form">
					    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title">F&F LEFT EMPLOYEES SETTLEMENT DETAILS</h4>
									<div class="row">
										<div class="col-sm-6 m-b-20">
											<ul class="list-unstyled mb-0">
												<li><?php echo $emp_data[0]->mxcp_name; ?></li>
												<li>Floor, F-1, Surya Towers, 7th, 105, Sardar Patel Rd,</li>
												<li>Secunderabad, Telangana 500003</li>
											</ul>
										</div>
										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase"><?php echo $emp_data[0]->mxcp_name; ?></h3>
												<ul class="list-unstyled">
													<li>F&F Month: <span><?php echo date('F');?>,<?php echo date('Y');?></span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 m-b-20">
											<ul class="list-unstyled">
												<li><h5 class="mb-0"><strong>Name : <?php echo $emp_data[0]->mxemp_emp_fname . " ". $emp_data[0]->mxemp_emp_lname ?></strong></h5></li>
												<li><span><?php echo $emp_data[0]->mxdesg_name; ?></span></li>
												<li>Employee ID: <?php echo $emp_data[0]->mxemp_emp_id; ?></li>
												<li>Joining Date: <?php echo date('d M Y',strtotime($emp_data[0]->mxemp_emp_resignation_date));?></li>
												<li>Releving Date: <?php echo date('d M Y',strtotime($emp_data[0]->mxemp_emp_resignation_relieving_date));?></li>
											</ul>
										</div>
									</div>
									<div class="row">
									    
									    
										
										<!-----EARNINGS--------->
										<?php //echo "<pre>";print_r($fandf_emp_data);die;?>
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Earning</strong></h4>
												<table class="table table-bordered">
													<tbody>
													    <tr>
													        <th>Earning Details</th>
													        <th>CBS Date</th>
													        <th>Amount</th>
													    </tr>
														<tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_1" id="earn_det_1" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_1)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_1 : " ";  ?>"></td>
															
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_1" class="datepicker_y_m_d" id="earn_cbs_dt_1" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_1)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_1 : " ";  ?>"></td>
															
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_1" id="earn_amount_1" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_1)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_1 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_2" id="earn_det_2" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_2)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_2 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_2" class="datepicker_y_m_d" id="earn_cbs_dt_2" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_2)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_2 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_2" id="earn_amount_2" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_2)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_2 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_3" id="earn_det_3" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_3)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_3 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_3" id="earn_cbs_dt_3" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_3)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_3 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_3" id="earn_amount_3" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_3)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_3 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_4" id="earn_det_4" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_4)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_4 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_4" id="earn_cbs_dt_4" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_4)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_4 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_4" id="earn_amount_4" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_4)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_4 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_5" id="earn_det_5" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_5)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_5 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_5" id="earn_cbs_dt_5" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_5)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_5 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_5" id="earn_amount_5" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_5)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_5 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_6" id="earn_det_6" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_6)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_6 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_6" id="earn_cbs_dt_6" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_6)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_6 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_6" id="earn_amount_6" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_6)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_6 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_7" id="earn_det_7" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_7)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_7 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_7" id="earn_cbs_dt_7" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_7)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_7 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_7" id="earn_amount_7" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_7)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_7 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_8" id="earn_det_8" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_8)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_8 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_8" id="earn_cbs_dt_8" class="datepicker_y_m_d" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_8)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_8 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_8" id="earn_amount_8" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_8)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_8 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_9" id="earn_det_9" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_9)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_9 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_9" class="datepicker_y_m_d" id="earn_cbs_dt_9" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_9)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_9 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_9" id="earn_amount_9" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_9)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_9 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="earn_det_10" id="earn_det_10" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_details_10)) ? $fandf_emp_data[0]->mxfandf_left_earnings_details_10 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" name="earn_cbs_dt_10" class="datepicker_y_m_d" id="earn_cbs_dt_10" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_10)) ? $fandf_emp_data[0]->mxfandf_left_earnings_cbs_date_10 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ear" name="earn_amount_10" id="earn_amount_10" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_earnings_amount_10)) ? $fandf_emp_data[0]->mxfandf_left_earnings_amount_10 : " ";  ?>"></td>
													    </tr>
													</tbody>
												</table>
											</div>
										</div>
										<!-----END EARNINGS----->
										
										<!-------TOTAL DEDUCTIONS------->
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Total Deductions</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
													        <th>Deduction Details</th>
													        <th>Amount</th>
													    </tr>
														<tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_1" id="dedu_det_1" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_1)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_1 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_1" id="dedu_amount_1" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_1)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_1 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_2" id="dedu_det_2" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_2)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_2 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_2" id="dedu_amount_2" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_2)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_2 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_3" id="dedu_det_3" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_3)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_3 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_3" id="dedu_amount_3" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_3)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_3 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_4" id="dedu_det_4" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_4)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_4 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_4" id="dedu_amount_4" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_4)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_4 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_5" id="dedu_det_5" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_5)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_5 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_5" id="dedu_amount_5" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_5)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_5 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_6" id="dedu_det_6" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_6)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_6 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_6" id="dedu_amount_6" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_6)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_6 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_7" id="dedu_det_7" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_7)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_7 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_7" id="dedu_amount_7" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_7)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_7 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_8" id="dedu_det_8" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_8)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_8 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_8" id="dedu_amount_8" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_8)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_8 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_9" id="dedu_det_9" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_9)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_9 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_9" id="dedu_amount_9" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_9)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_9 : " ";  ?>"></td>
													    </tr>
													    <tr>
														    <td><input type="text" style="height: 30px;width: 300px;" name="dedu_det_10" id="dedu_det_10" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_details_10)) ? $fandf_emp_data[0]->mxfandf_left_deduction_details_10 : " ";  ?>"></td>
														    <td><input type="text" style="height: 30px; width: 100px;" class="amount_ded" name="dedu_amount_10" id="dedu_amount_10" onkeypress="return isNumber1(event,this.value)" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_deduction_amount_10)) ? $fandf_emp_data[0]->mxfandf_left_deduction_amount_10 : " ";  ?>"></td>
													    </tr>
													</tbody>
												</table>
											</div>
										</div>
										<!-------END TOTAL DEDUCTIONS--->
										<!---------TOTAL-->
										<div class="col-sm-3">
											<div>
												<!--<h4 class="m-b-10"><strong>Total</strong></h4>-->
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Total Earnings</strong> <span class="float-right"><td><input type="text" id="total_earnings" name="total_earnings" style="height: 25px; width:130px; " value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_total_earnings)) ? $fandf_emp_data[0]->mxfandf_left_total_earnings : "0";  ?>" readonly></td></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-3">
											<div>
												<!--<h4 class="m-b-10"><strong>Total</strong></h4>-->
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Total Deductions</strong> <span class="float-right"><td><input type="text" id="total_deductons" name="total_deductions" style="height: 25px; width:130px; " value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_total_deductions)) ? $fandf_emp_data[0]->mxfandf_left_total_deductions : "0";  ?>" readonly></td></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-3">
											<div>
												<!--<h4 class="m-b-10"><strong>Total</strong></h4>-->
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Net Payable</strong> <span class="float-right"><td><input type="text" id="net_payable" name="net_payable" style="height: 25px; width:130px; " value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_total_net_pay)) ? $fandf_emp_data[0]->mxfandf_left_total_net_pay : "0";  ?>" readonly></td></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-3">
											<div>
												<!--<h4 class="m-b-10"><strong>Total</strong></h4>-->
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><span class="float-right"><td><input type="text" style="display: none;" id="payable_flag" name="payable_flag" value="<?php echo (isset($fandf_emp_data[0]->mxfandf_left_payable_flag)) ? $fandf_emp_data[0]->mxfandf_left_payable_flag : "0";  ?>" readonly><strong id="payable_flag_span" style="color: red;">Net Payable</strong></td></span> </td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<!---------TOTAL-->
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Company Benifites</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Previous Year Bonus</strong> <span class="float-right" style="color: green;">
                                                                 <?php
                                                                 $lastYearBonus = $salary_structure['previousYearBonus'];
                                                                 $loanAmount = $loan_array['emi_amount'];

                                                                 $advRecovery = 0;
                                                                 /* If bonus >= Loan Amount, 50 % of Loan to be recovered as Staff Advance */
                                                                 if($lastYearBonus >= $loanAmount) {
                                                                     $advRecovery_temp =   round(($loanAmount * 50)/100, 2);
                                                                     if($loanAmount < $advRecovery_temp) {
                                                                         $advRecovery = $loanAmount;
                                                                     } else {
                                                                         $advRecovery = $advRecovery_temp;
                                                                     }
                                                                 }

                                                                 /* if its Bonus < Staff Adv, 50% of Bonus to be recovered as Staff Advance*/
                                                                 if($lastYearBonus < $loanAmount) {
                                                                     $advRecovery =   round(($lastYearBonus * 50)/100,2);
                                                                 }
                                                                 if($advRecovery>0) {
                                                                     $advRecovery = $advRecovery;
                                                                 }else{
                                                                     $advRecovery = 0;
                                                                 }

                                                                 if( $lastYearBonus>0)
                                                                 {
                                                                     $lastYearDiffrence_tot = $lastYearBonus-$advRecovery;
                                                                     $lastYearDiffrence_tot =  ($lastYearDiffrence_tot > 0) ? $lastYearDiffrence_tot : 0;
                                                                 }else{
                                                                     $lastYearDiffrence_tot = 0;
                                                                 }

                                                                 echo $lastYearDiffrence_tot;
                                                                 ?>
                                                                </span></td>
														</tr>
														<tr>														
															<td><strong>Bonus Payable</strong> <span class="float-right" style="color: green;">
                                                                    <?php
                                                                    $currentYearBonus = $salary_structure_fandf[0]['total_bonus'];
                                                                    $loanAmount = $loan_array['emi_amount'];

                                                                    $advRecovery = 0;
                                                                    /* If bonus >= Loan Amount, 50 % of Loan to be recovered as Staff Advance */
                                                                    if($currentYearBonus >= $loanAmount) {
                                                                        $advRecovery_temp =   round(($loanAmount * 50)/100, 2);
                                                                        if($loanAmount < $advRecovery_temp) {
                                                                            $advRecovery = $loanAmount;
                                                                        } else {
                                                                            $advRecovery = $advRecovery_temp;
                                                                        }
                                                                    }

                                                                    /* if its Bonus < Staff Adv, 50% of Bonus to be recovered as Staff Advance*/
                                                                    if($currentYearBonus < $loanAmount) {
                                                                        $advRecovery =   round(($currentYearBonus * 50)/100,2);
                                                                    }
                                                                    if($advRecovery>0) {
                                                                        $advRecovery = $advRecovery;
                                                                    }else{
                                                                        $advRecovery = 0;
                                                                    }

                                                                    if( $currentYearBonus>0)
                                                                    {
                                                                        $currentYearDiffrence_tot = $currentYearBonus-$advRecovery;
                                                                        $currentYearDiffrence_tot =  ($currentYearDiffrence_tot > 0) ? $currentYearDiffrence_tot : 0;
                                                                    }else{
                                                                        $currentYearDiffrence_tot = 0;
                                                                    }

                                                                    echo $currentYearDiffrence_tot;
                                                                    ?>
                                                                </span></td>
														</tr>
                                                        <?php
                                                        // Calculation for Is Gratuity Applicable
                                                        $doj_obj = new DateTime($emp_data[0]->mxemp_emp_date_of_join);
                                                        $today_date = date('Y-m-d H:i:s');
                                                        $today_obj = new DateTime($today_date);
                                                        $grat_applicable_interval = $doj_obj->diff($today_obj);
                                                        $grat_applicable_years = $grat_applicable_interval->y;
                                                        ?>
														<tr>
															<td><strong>Gratuity</strong>
                                                                <span class="float-right" style="color: green;">
                                                                    <?php
                                                                    $finalGratuityAmount =  ($grat_applicable_years >=5)? $salary_structure['mxsal_gratuity_amount'] : 0;
                                                                    echo $finalGratuityAmount?>
                                                                </span></td>
														</tr>
														<tr>
														<td><strong>Loan (<?php echo $loan_array['loan_approved']; ?>/ <?php echo $loan_array['outstanding_amount']; ?>) (<?php echo $loan_array['completed_tenure_months']; ?>/<?php echo $loan_array['total_tenure_months']; ?>) (Pending - <?php echo $loan_array['remaining_tenure_months']; ?>)</strong> <span class="float-right" style="color: red;"><?php echo $salary_structure['mxsal_loan_amount'];?></span></td>
														</tr>
														<tr>
                                                            <td><strong>Total</strong> <span class="float-right"><strong>
                                                                    <?php
                                                                    echo $lastYearDiffrence_tot + $currentYearDiffrence_tot + $finalGratuityAmount - $salary_structure['mxsal_loan_amount'];
                                                                    ?>
                                                                    </strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Leaves</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>EL - (<?php echo $leave_bal[0]->CurrentEL; ?>)</strong> <span class="float-right"><?php echo $salary_structure['mxsal_el_amount']; ?></span></td>
														</tr>
														<tr>
															<td><strong>CL - (<?php echo $leave_bal[0]->CurrentCL; ?>)</strong> <span class="float-right"></span></td>
														</tr>
														<tr>
															<td><strong>SL - (<?php echo $leave_bal[0]->CurrentSL; ?>)</strong> <span class="float-right"></span></td>
														</tr>
														<tr>
															<td><strong>Total</strong> <span class="float-right"><strong><?php echo $salary_structure['mxsal_el_amount']; ?></strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<?php
										
								// 		$net_sal = $salary_structure['mxsal_net_sal'];
                                        // $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                        // echo $f->format($myNumber);exit;
										?>
										<div class="col-sm-12">
											<!---<p><strong>Total Payable: $<?php //echo $net_sal;?></strong> (<?php //echo ucfirst(numberTowords($net_sal)); ?> only.)</p>-->
										</div>
										
										
										
					
					<div class="col-sm-12">
											<div>
												<h4 class="m-b-10"><strong>Payment Details</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td>Payment mode</td>
<td>
<select name="payment_mode" id="payment_mode" > 
<option value="" > select</option>
<option value="cheque" <?php if($fandf_emp_data[0]->payment_mode=='cheque'){echo "selected";} ?> > cheque</option>
<option value="rtgs" <?php if($fandf_emp_data[0]->payment_mode=='rtgs'){echo "selected";} ?> > rtgs</option>
<option value="unpaid_salary" <?php if($fandf_emp_data[0]->payment_mode=='unpaid_salary'){echo "selected";} ?> > unpaid_salary</option>
</select>
<!--<input type="text" name="payment_mode" id="payment_mode" value="<?php echo (isset($fandf_emp_data[0]->payment_mode)) ? $fandf_emp_data[0]->payment_mode : " ";  ?>">-->
</td>
														</tr>
														<tr>
															<td>Paymetn Date</td>
															<td><input type="date" style="" class="" name="payment_date" id="payment_date" onkeypress="" value="<?php echo (isset($fandf_emp_data[0]->payment_date)) ? $fandf_emp_data[0]->payment_date : " ";  ?>"></td>
														</tr>
														<tr>
															<td>payment amount </td>
															<td><input type="number" style="" class="" name="payment_amount" id="payment_amount" onkeypress="" value="<?php echo (isset($fandf_emp_data[0]->payment_amount)) ? $fandf_emp_data[0]->payment_amount : " ";  ?>"></td>
														</tr>
														<tr>
															<td>cheque no</td>
															<td><input type="number" style="" class="" name="payment_no" id="payment_no" onkeypress="" value="<?php echo (isset($fandf_emp_data[0]->payment_no)) ? $fandf_emp_data[0]->payment_no : " ";  ?>"></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
					
					
					
										
										<div class="col-sm-12">
										    <?php
										if(isset($fandf_emp_data[0])){
											echo '<button type="submit" id="update_fandf_btn" class="btn btn-success">Update FandF</button>';
											echo '<input type="hidden" name="btn_flag" value="update">';
											
										}else{
											echo '<button type="submit" id="generate_fandf_btn" class="btn btn-success">Generate</button>';
											echo '<input type="hidden" name="btn_flag" value="insert">';
										}
										?>
										
										<button type="button" onclick="processpaysheet()" class="btn btn-primary"> Print Page </button>
										</div>
										<!-- Delete Department Modal -->
                            			<div class="modal custom-modal fade" id="update_bank_info_model" role="dialog">
                            				<div class="modal-dialog modal-dialog-centered">
                            					<div class="modal-content">
                            						<div class="modal-body">
                            							<div class="form-header">
                            								<h3>UPDATE BANK STATUS</h3>
                            								<!--<h3 style="color: red" id="delcmpname"></h3>-->
                            								<!--<p>Are you sure want to delete?</p>-->
                            							</div>
                            							
                            								<input type="checkbox" name="bank_status" id="bank_status" checked>
                            								<label>Transfered To Bank</label>
                            								<span class="formerror" id="bank_status_error"></span>
                            								<!--<input type="hidden" name="deletemainid" id="delcmpid">-->
                            							<div class="modal-btn delete-action">
                            								<div class="row">
                            									<div class="col-6">
                            										<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="process_bank_data">Update</a>
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
										<!--<a class="dropdown-item deletemodal" href="#" data-toggle="modal" data-target="#delete" data-id="<?php //echo $listview->mxcp_id .'~'. $listview->mxcp_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
                    </form>
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			<script>
			
			
			
			function processpaysheet() {
    var emp_code = "<?php echo $this->uri->segment(3);?>";
    var resign_status = "<?php echo $this->uri->segment(4);?>";

    var mainurl = baseurl + 'salaries_controller/getfandf?emp_code=' + emp_code + '&resign_status=' + resign_status;

    // Open in new tab
    window.open(mainurl, '_blank');
}


			/*function processpaysheet() 
			{
				
				var emp_code = "<?php echo $this->uri->segment(3);?>";
			    var resign_status = "<?php echo $this->uri->segment(4);?>";

   

    mainurl = baseurl + 'salaries_controller/getfandf';
    $.ajax({
        url: mainurl,
        type: 'get',
        data: { emp_code: emp_code, resign_status: resign_status },
        success: function (data) {
            //console.log(data);
            if(data == 402){
                alert("NO DATA FOUND.....");
                return false;
            }            
        },
    });
}*/






			var emp_code = "<?php echo $this->uri->segment(3);?>";
			var resign_status = "<?php echo $this->uri->segment(4);?>";
// 			alert(emp_code);

			</script>
			<script src="<?php echo base_url();?>/assets/js/formsjs/fandfdetails_left.js"></script>
			
			
			
			
			