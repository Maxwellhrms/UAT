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
									<li class="breadcrumb-item active">Create Your Loan Setup</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Register New Loan</button>

<div id="demo" class="collapse">	
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Create Your Loan Setup Details</h4>
									</div>
									<div class="card-body">
										<form id="emploan_form">
											<div class="row">
												<div class="col-md-6">
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
					                                            <select class="form-control select2" name="esi_company_id" id="esi_company_id"  style="width: 100%">
							                                        <option value="">-- Select Company --</option>
							                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
							                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
							                                        <?php } ?>
							                                    </select>
							                                    <span class="formerror" id="cmpnameerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<label>Division:</label>
															<select class="select2 form-control"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															<option value="">Select Division</option>
															</select>
															<span class="formerror" id="esi_div_id_error"></span>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Code:</label>
																<select type="text" name="employeeid" id="employeeid" class="form-control select2" style="width: 100%">
																	
																</select>
																<span class="formerror" id="employeeiderror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Loan Type:</label>
																<select type="text" name="loantype" id="loantype" class="form-control select2" style="width: 100%">
																	<option value="">Select Loan Type</option>
																	<option value="LOAN">Loan</option>
																	<option value="SALARY-ADVANCE">Advance</option>
																</select>
																<span class="formerror" id="loantypeerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Loan Amount Applied:</label>
																<input type="number" name="emploanamountapplied" id="emploanamountapplied" class="form-control numbersonly_with_dot">
																<span class="formerror" id="emploanamountappliederror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Loan Amount Approved:</label>
																<input type="number" name="loanamountapproved" id="loanamountapproved" class="form-control">
																<span class="formerror" id="loanamountapprovederror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Emi Start From:</label>
																<input type="text" name="emiloanamount" id="emiloanamount" class="form-control yearmonth" placeholder="Month-Year">
																<span class="formerror" id="emiloanamounterror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Tenure Months:</label>
																<select type="text" name="tenuremnts" id="tenuremnts" class="form-control select2" style="width: 100%">
																<option value="">Select Months</option> 
																	<!--<option value="1">1 Month</option>-->
																	<!--<option value="5">5 Months</option>-->
																	<!--<option value="10">10 Months</option>-->
																	<?php for ($i =1; $i<=60; $i++){ ?>
																	    <option value="<?php echo $i; ?>"><?php echo $i; ?> Months </options>
																	<?php } ?>
																</select>
																<span class="formerror" id="tenuremntserror"></span>
																<span class="formerror emiamountidentyfier"></span>
															</div>
														</div>

													</div>
												</div>
												<div class="col-md-6">
													<div class="row">

														<div class="col-md-6">
															<div class="form-group">
															<label>State:</label>
	                                                        <select class="form-control select2" name="esi_state_id" id="esi_state_id" style="width: 100%;">
	                                                            <option value="">Select State</option>
	                                                        </select>
	                                                        <span class="formerror" id="esi_state_id_error"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
															<label>Branch:</label>
                                                        <select class="form-control select2" name="esi_branch_id" id="esi_branch_id" style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                        </select>
                                                        <span class="formerror" id="esi_branch_id_error"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>loan Approvred By:</label>
																<input type="text" name="loanamountapprovedby" id="loanamountapprovedby" class="form-control">
																<span class="formerror" id="loanamountapprovedbyerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Reason For Loan:</label>
																<input type="text" name="rsloanamount" id="rsloanamount" class="form-control">
																<span class="formerror" id="rsloanamounterror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Applied Date:</label>
																<input type="text" name="loanamountapplied" id="loanamountapplied" class="form-control datetimepicker">
																<span class="formerror" id="loanamountappliederror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Approved Date:</label>
																<input type="text" name="loanamountappdate" id="loanamountappdate" class="form-control datetimepicker">
																<span class="formerror" id="loanamountappdateerror"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label>Attachement:</label>
																<input type="file" name="loandoc" id="loandoc" class="form-control">
																<span class="formerror" id="loandocerror"></span>
															</div>
														</div>
												</div>
											</div>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Apply</button>
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
									<h4 class="card-title mb-0">Loan List</h4>
								</div>
								<div class="card-body">	
<?php //echo '<pre>'; print_r($loandata); ?>
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee</th>
													<th>Branch</th>
													<th>Division</th>
													<th>State</th>
													<th>Loan ID</th>
													<th>Tenure Months</th>
													<th>Start Year Month</th>
													<th>End Year Month</th>
													<th>Approved Amount</th>
													<th>OutStanding Amount</th>
													<th>Status</th>
													<th>More</th>
												</tr>
											</thead>
											<tbody>
											<?php if(count($loandata)>0){ ?>
												<tr>
													<?php foreach ($loandata as $key => $listview) { ?>

													<td><?php echo $listview->employeename . '(' . $listview->mxemploan_empcode .')' ?></td>
													<td><?php echo $listview->mxb_name ?></td>
													<td><?php echo $listview->mxd_name ?></td>
													<td><?php echo $listview->mxst_state ?></td>
													<td><?php echo $listview->mxemploan_load_id ?></td>
													<td><?php echo $listview->mxemploan_emp_loan_tenure_months ?></td>
													<td><?php echo $listview->mxemploan_emi_startdate ?></td>
													<td><?php echo $listview->mxemploan_emi_enddate ?></td>
													<td><?php echo $listview->mxemploan_emp_loan_amt_approved ?></td>
													<td><?php echo $listview->mxemploan_emp_loan_outstanding_amt ?></td>
													<td><?php if($listview->mxemploan_status == 1){ echo 'PROCESSING'; }else{ echo 'CLOSED'; } ?></td>
													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                	<?php if($listview->mxemploan_status != 0) { ?>
                                                   <?php if($this->session->userdata('user_role_edit') == 1){ ?> <a class="dropdown-item deletemodal" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $listview->mxemploan_pri_id .'~'. $listview->mxemploan_empcode .'~'. $listview->mxemploan_load_id; ?>"><i class="fa fa-pencil m-r-5"></i>Payments</a> <a class="dropdown-item loandeletemodal" href="#" data-toggle="modal" data-target="#loandelete" data-id="<?php echo $listview->mxemploan_pri_id .'~'. $listview->mxemploan_empcode .'~'. $listview->mxemploan_load_id; ?>"><i class="fa fa-pencil m-r-5"></i>Delete loan</a><?php } ?>
                                                <?php } ?>
                                                    <a class="dropdown-item historymodal" data-target="#profile_info" data-toggle="modal" data-id="<?php echo $listview->mxemploan_pri_id .'~'. $listview->mxemploan_empcode .'~'. $listview->mxemploan_load_id; ?>"><i class="fa fa-pencil m-r-5" ></i> Transaction History</a>
                                                </div>
												</div>
													</td>
												</tr>
													<?php } ?>
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
			<!-- /Page Wrapper -->

			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
								<form method="post" id="savenewadvancedata">
						<div class="modal-body">
							<div class="form-header">
								<h3>Loan Payment for <span id="loanidsmain" style="color: red"></span></h3>
								<h3 style="color: red" id="delcmpname"></h3>
							</div>

								<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Payment Type</label>
												<select class="form-control" name="newpytm" id="newpytm">
													<option value="">Select Mode of Payment</option>
													<option value="AD1">ADVANCE PAYMENT</option>
													<option value="FC1">Fore Closure</option>
												</select>
												<span class="formerror" id="newpytmerror"></span>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Amount </label>
												<input class="form-control" type="number" name="newamt" id="newamt">
												<span class="formerror" id="newamterror"></span>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label">Mode of Payment Details</label>
												<textarea class="form-control" name="newtrdetails" id="newtrdetails"></textarea>
												<span class="formerror" id="newtrdetailserror"></span>
											</div>
										</div>
										<input type="hidden" name="primaryid" id="primaryid">
										<input type="hidden" name="loanempid" id="loanempid">
									</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Close</a>
									</div>
									<div class="col-6">
										<button class="btn btn-primary continue-btn" id="processaddata" type="submit">Save</button>
									</div>
								</div>
							</div>
						</div>
								</form>
					</div>
				</div>
			</div>
			<!-- /Delete Department Modal -->

				<!-- Profile Modal -->
				<div id="profile_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width:900px">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Transaction Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="loanledger">

						<!-- Detailed Transaction histroy -->
							</div>
						</div>
					</div>
				</div>
				<!-- /Profile Modal -->	

				<!-- Delete loan -->
			<div class="modal custom-modal fade" id="loandelete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Loan</h3>
								<h3 style="color: red" id="employeecd"></h3>
								<h4 style="color: red" id="emploaniddisplay"></h4>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="delloanid" id="delloanid">
								<input type="hidden" name="loanemployee" id="loanemployee">
								<input type="hidden" name="emploanid" id="emploanid">
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
			<script type="text/javascript">
				$(document).on("click", ".loandeletemodal", function () {
				var deletedetails = $(this).data('id');
				var x = deletedetails.split("~",4);
				var id = x[0];
				var employeecode = x[1];
				var emploanid = x[2]
				$(".modal-body #employeecd").html(employeecode);
				$(".modal-body #emploaniddisplay").html(emploanid);
				$(".modal-body #loanemployee").val(employeecode);
				$(".modal-body #delloanid").val(id);
				$(".modal-body #emploanid").val(emploanid);
				});

				$( "#processdeletedata" ).click(function() {
				  event.preventDefault();
				  var delloanid = $('#delloanid').val();
				  var loanemployee = $('#loanemployee').val();
				  var emploanid = $('#emploanid').val();
                  var user = '<?php echo $this->session->userdata('user_id'); ?>';
                  var conf = confirm('You Logged with: ' + user +' Do u wish to Delete');
                  if (conf === true) {
        
    				  $.ajax({
    				      async: false,
    				      type: "POST",
    				      data: {id : delloanid, loanid : emploanid, empid : loanemployee},
    				      url: baseurl + 'Loan_controller/deleteloandetails',
    				      datatype: "html",
    				      success: function (data) {
    				      	// console.log(data);
    				          if (data == 200) {
    				            alert('Success');
    				            window.location.reload();
    				          }else if(data == 300){
    				          	alert('You Cant Delete Loan Already Some Process Hasbeen Done');
    				          }else {
    				            alert('Try Again Later');
    				          }
    				      }
    				  });
                  }
				});
			</script>
				<!-- Delete loan -->	
<!-- Company Validation -->


<script src="<?php echo base_url(); ?>/assets/js/formsjs/emploan.js"></script>
