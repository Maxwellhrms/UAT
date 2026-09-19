			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Modify Employee Loan Details</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Modify Employee Loan Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Loan Setup Details For <span style='color:red'><?php echo $loandata[0]->employeename ?> - (<?php echo $loandata[0]->mx_loan_empcode ?>)</span></h4>
									</div>
									<div class="card-body">
										<form id="emploan_form">
											<div class="row">
												<div class="col-md-6">
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
																<p><?php echo $loandata[0]->mxcp_name ?></p>
					                                            <input type='hidden' value='<?php echo $loandata[0]->mx_loan_comp_id ?>' class="form-control" name="esi_company_id" id="esi_company_id"  style="width: 100%">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<label>Division:</label>
															<p><?php echo $loandata[0]->mxd_name ?></p>
															<input type='hidden' value='<?php echo $loandata[0]->mx_loan_div_id ?>' class="form-control" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Code:</label>
																<input type='text' readonly='' value='<?php echo $loandata[0]->mx_loan_empcode ?>' name="employeeid" id="employeeid" class="form-control" style="width: 100%">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Loan Type:</label>
																<select type="text" name="loantype" id="loantype" class="form-control select2" style="width: 100%">
																	<option value="">Select Loan Type</option>
																	<option value="LOAN" <?php if($loandata[0]->mx_loan_emp_loan_type == 'LOAN'){ echo 'selected'; }else{ echo '';} ?> >Loan</option>
																	<option value="SALARY-ADVANCE" <?php if($loandata[0]->mx_loan_emp_loan_type == 'SALARY-ADVANCE'){ echo 'selected'; }else{ echo '';} ?> >Advance</option>
																</select>
																<span class="formerror" id="loantypeerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Reason For Loan:</label>
																<input type="text" name="rsloanamount" id="rsloanamount" class="form-control" readonly='' value='<?php echo $loandata[0]->mx_loan_reasonfor_loan ?>'>
																<span class="formerror" id="rsloanamounterror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Applied Date:</label>
																<input type="text" readonly ='' name="loanamountapplied" id="loanamountapplied" class="form-control datetimepicker" value='<?php echo date('d-m-Y',strtotime($loandata[0]->mx_loan_applied_date)); ?>'>
																<span class="formerror" id="loanamountappliederror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<?php if(!empty($loandata[0]->mx_loan_approved_date)) { $appdate = date('d-m-Y', strtotime($loandata[0]->mx_loan_approved_date)); } else{$appdate = ''; }?>
																<label style="color:red">Approved Date:</label>
																<input type="text" name="loanamountappdate" id="loanamountappdate" class="form-control datetimepicker" value='<?php echo $appdate ?>' autocomplete="off">
																<span class="formerror" id="loanamountappdateerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label style="color:red">Loan Amount Approved:</label>
																<input type="number" name="loanamountapproved" id="loanamountapproved" value='<?php echo $loandata[0]->mx_loan_amt_approved ?>' class="form-control">
																<span class="formerror" id="loanamountapprovederror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label style="color:red">Emi Start From:</label>
																<input type="text" name="emiloanamount" id="emiloanamount" value='<?php echo $loandata[0]->mxemploan_emp_start_from ?>' class="form-control yearmonth" placeholder="Month-Year">
																<span class="formerror" id="emiloanamounterror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Loan Status:</label>
																<select name="loanstatus" id="loanstatus" class="form-control select2" style="width: 100%;">
																    <option value='1' <?php if($loandata[0]->mx_loan_status == '1'){ echo 'selected'; }else{ echo '';} ?> >PENDING</option>
																    <option value='2' <?php if($loandata[0]->mx_loan_status == '2'){ echo 'selected'; }else{ echo '';} ?> >REJECTED</option>
																    <option value='3' <?php if($loandata[0]->mx_loan_status == '3'){ echo 'selected'; }else{ echo '';} ?> >APPROVED</option>
																</select>
																<span class="formerror" id="loanstatuserror"></span>
															</div>
														</div>

													</div>
												</div>
												<div class="col-md-6">
													<div class="row">

														<div class="col-md-6">
															<div class="form-group">
															<label>State:</label>
															<p><?php echo $loandata[0]->mxst_state ?></p>
	                                                        <input type='hidden' value='<?php echo $loandata[0]->mx_loan_state_id ?>' class="form-control" name="esi_state_id" id="esi_state_id" style="width: 100%;">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
															<label>Branch:</label>
															<p><?php echo $loandata[0]->mxb_name ?></p>
                                                        <input type='hidden' value='<?php echo $loandata[0]->mx_loan_branch_id ?>' class="form-control" name="esi_branch_id" id="esi_branch_id" style="width: 100%;">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Tenure Months:</label>
																<select type="text" name="tenuremnts" id="tenuremnts" class="form-control select2" style="width: 100%">
																<option value="">Select Months</option> 
																	<option value="1" <?php if($loandata[0]->mx_loan_tenure_months == '1'){ echo 'selected'; }else{ echo '';} ?> >1 Month</option>
																	<option value="5" <?php if($loandata[0]->mx_loan_tenure_months == '5'){ echo 'selected'; }else{ echo '';} ?> >5 Months</option>
																	<option value="10" <?php if($loandata[0]->mx_loan_tenure_months == '10'){ echo 'selected'; }else{ echo '';} ?> >10 Months</option>
																</select>
																<span class="formerror" id="tenuremntserror"></span>
																<span class="formerror emiamountidentyfier"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Loan Amount Applied:</label>
																<input type="number" name="emploanamountapplied" id="emploanamountapplied" class="form-control numbersonly_with_dot" value='<?php echo $loandata[0]->mx_loan_amount_appliedby_employee ?>' readonly=''>
																<span class="formerror" id="emploanamountappliederror"></span>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Document:</label>
                                                                <p>Downloaddoc</p>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Loan Applied Category:</label>
																<select name="loancategory" id="loancategory" class="form-control select2" style="width: 100%;" >
																	<?php echo $controller->display_options('loan_reasons',$loandata[0]->mx_loan_category); ?>
																</select>
																<span class="formerror" id="loancategoryerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label style="color:red">loan Approved By:</label>
																<input type="text" name="loanamountapprovedby" id="loanamountapprovedby" value='<?php echo $loandata[0]->mx_loan_approvedby ?>' class="form-control">
																<span class="formerror" id="loanamountapprovedbyerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label style="color:red">Attachement:</label>
																<input type="file" name="loandoc" id="loandoc" class="form-control">
																<span class="formerror" id="loandocerror"></span>
															</div>
														</div>
												</div>
											</div>
											</div>
											<div class="text-right">
											    <input type='hidden' name='uniqueid' id='uniqueid' value='<?php echo $loandata[0]->mx_loan_pri_id ?>'>
											    <input type='hidden' name='empid' id='empid' value='<?php echo $loandata[0]->mx_loan_empcode ?>'>
											    <input type="hidden" name="attachements_byemployee" id="attachements_byemployee" value="<?php echo $loandata[0]->mx_loan_attachement_employee ?>">
											    <?php if($loandata[0]->mx_loan_status != 3){ ?>
												<button type="submit" class="btn btn-primary">Process</button>
												<?php }else{ echo '<span style="color:green"><b>Already APPROVED</b></span>'; } ?>
												
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>


				</div>
			</div>
			<!-- /Page Wrapper -->




<script src="<?php echo base_url(); ?>/assets/js/formsjs/emploan_accept.js"></script>
