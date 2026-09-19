			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Your Company</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Your Company</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					  <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Register New Company</button>
					
					<div id="demo" class="collapse">
						
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Create Your Company Details</h4>
									</div>
									<div class="card-body">
										<form id="processcmpdetails">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Company Name:</label>
														<input type="text" name="cmpname" id="cmpname" class="form-control" autocomplete="off">
														<span class="formerror" id="cmpnameerror"></span>
													</div>
													<div class="form-group">
														<label>Company State:</label>
														<select class="select select2" name="cmpstate" id="cmpstate">
															<option value="">Select Company State</option>
															<?php foreach ($states as $key => $stvalue) { ?>
																<option value="<?php echo $stvalue->mxst_id .'@~@'. $stvalue->mxst_state ?>"><?php echo $stvalue->mxst_state ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="cmpstateerror"></span>
													</div>
													<div class="form-group">
														<label>Company Address:</label>
														<textarea name="cmpaddress" id="cmpaddress" rows="5" cols="5" class="form-control" placeholder="Enter Company Address"></textarea>
														<span class="formerror" id="cmpaddresserror"></span>
													</div>
													<div class="form-group">
														<label>Company Website URL</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">https://</span>
															</div>
															<input type="text" name="cmpweburl" id="cmpweburl" class="form-control">
															<span class="formerror" id="cmpweburlerror"></span>
														</div>
													</div>
													<div class="form-group">
														<label>Company Tax Deduction Account No:</label>
														<input name="cmptx" id="cmptx" type="text" class="form-control">
														<span class="formerror" id="cmptxerror"></span>
													</div>
													<div class="form-group">
														<label>Company Week off Days:</label>
													<div class="checkbox">
														<label>
															<input type="checkbox" name="cmpweekoffmon" id="cmpweekoffmon" value="1"> Monday
														</label>
														<label>
															<input type="checkbox" name="cmpweekofftues" id="cmpweekofftues" value="1"> Tuesday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffwed" id="cmpweekoffwed" value="1"> Wednesday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffthur" id="cmpweekoffthur" value="1"> Thursday
														</label>
														<label>
															<input type="checkbox" name="cmpweekofffri" id="cmpweekofffri" value="1"> Friday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffsat" id="cmpweekoffsat" value="1"> Saturday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffsun" id="cmpweekoffsun" value="1"> Sunday
														</label>
													</div>
													<span class="formerror" id="weekofferror"></span>
													</div>
													<div class="form-group">
														<label>Company Logo:</label>
														<input type="file" name="cmplogo" id="cmplogo" class="form-control">
														<span class="formerror" id="cmplogoerror"></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>In Corporation No:</label>
																<input type="text" name="cmpcpno" id="cmpcpno" class="form-control">
																<span class="formerror" id="cmpcpnoerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Mtw Licence No:</label>
																<input type="text" name="cmpmtwlicence" id="cmpmtwlicence" class="form-control">
																<span class="formerror" id="cmpmtwlicenceerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company City:</label>
																<input type="text" name="cmpcity" id="cmpcity" class="form-control">
																<span class="formerror" id="cmpcityerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Pincode:</label>
																<input type="text" name="cmppincode" id="cmppincode" class="form-control">
																<span class="formerror" id="cmppincodeerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Mobile No:</label>
																<input type="number" name="cmpmobile" id="cmpmobile" class="form-control">
																<span class="formerror" id="cmpmobileerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Land line No:</label>
																<input type="text" name="cmplandline" id="cmplandline" class="form-control">
																<span class="formerror" id="cmplandlineerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Fax No:</label>
																<input type="text" name="cmpfax" id="cmpfax" class="form-control">
																<span class="formerror" id="cmpfaxerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Email Id:</label>
																<input type="text" name="cmpemail" id="cmpemail" class="form-control">
																<span class="formerror" id="cmpemailerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Financial Year Type:</label>
																<select class="select2" name="cmpfnyyear" id="cmpfnyyear">
																	<option value="">Select Financial Year</option>
																	<?php foreach ($financial as $key => $fvalue) { ?>
																		<option value="<?php echo $fvalue->mxfny_id ?>"><?php echo $fvalue->mxfny_name ?></option>
																	<?php } ?>
																</select>
																<span class="formerror" id="cmpfnyyearerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Establishment Date:</label>
																<input type="text" name="cmpestdate" id="cmpestdate" class="form-control datetimepicker">
																<span class="formerror" id="cmpestdateerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Gratuity Code:</label>
																<input type="text" name="cmpgratuitycode" id="cmpgratuitycode" class="form-control">
																<span class="formerror" id="cmpgratuitycodeerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Gratuity Date:</label>
																<input type="text" name="cmpgratuitydate" id="cmpgratuitydate" class="form-control datetimepicker">
																<span class="formerror" id="cmpgratuitydateerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Contact Person Mobile:</label>
																<input type="text" name="cmpcntpermb" id="cmpcntpermb" class="form-control">
																<span class="formerror" id="cmpcntpermberror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Contact Person Name:</label>
																<input type="text" name="cmpcntper" id="cmpcntper" class="form-control">
																<span class="formerror" id="cmpcntpererror"></span>
															</div>
														</div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>First Half:</label>
                                                                        <input type="text" name="cmpfirsthalf" id="cmpfirsthalf" class="form-control datetimepicker2" autocomplete="off">
                                                                        <span class="formerror" id="cmpfirsthalfrerror"></span>
                                                                </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Second Half:</label>
                                                                        <input type="text" name="cmpsecondhalf" id="cmpsecondhalf" class="form-control datetimepicker2" autocomplete="off">
                                                                        <span class="formerror" id="cmpseconderror"></span>
                                                                </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Break Start Time:</label>
                                                                        <input type="text" name="cmpbreak" id="cmpbreak" class="form-control datetimepicker2" autocomplete="off">
                                                                        <span class="formerror" id="cmpbreakerror"></span>
                                                                </div>
                                                        </div> 
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Break End Time:</label>
                                                                        <input type="text" name="cmpbreakend" id="cmpbreakend" class="form-control datetimepicker2" autocomplete="off">
                                                                        <span class="formerror" id="cmpbreakenderror"></span>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Logoff Time:</label>
                                                                        <input type="text" name="cmpendtime" id="cmpendtime" class="form-control datetimepicker2" autocomplete="off">
                                                                        <span class="formerror" id="cmpendtime"></span>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>First Half Grace Time:</label>
                                                                        <input type="text" name="firstgracetime" id="firstgracetime" class="form-control datetimepicker_minutes" autocomplete="off">
                                                                        <span class="formerror" id="firstgracetimeerror"></span>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Second Half Grace Time:</label>
                                                                        <input type="text" name="secondgracetime" id="secondgracetime" class="form-control datetimepicker_minutes" autocomplete="off">
                                                                        <span class="formerror" id="secondgracetimeerror"></span>
                                                                </div>
                                                        </div>

													</div>
												</div>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Save Company Details</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					
<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Comapny List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Logo</th>
													<th>Name</th>
													<th>Company Address</th>
													<th>Code</th>
													<th>Licience No</th>
													<th>Establishment Date</th>
													<th>Company Ded Tax No</th>
													<th>Cmp Contact Person</th>
													<th>Cmp Contact Person No</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<?php foreach ($cmpdetailslist as $key => $listview) { ?>

													<td><img src="<?php echo ($listview->mxcp_pic == "")? "#": base_url()."/".$listview->mxcp_pic ?>" width="150px" height="100px"></td>
													<td><?php echo $listview->mxcp_name ?></td>
													<td><?php echo $listview->mxcp_address ?></td>
													<td><?php echo $listview->mxcp_reg_no ?></td>
													<td><?php echo $listview->mxcp_licence_no ?></td>
													<td><?php echo date("d/m/Y",strtotime($listview->mxcp_establishment_date)) ?></td>
													<td><?php echo $listview->mxcp_tax_ded_ac_no ?></td>
													<td><?php echo $listview->mxcp_name_of_contact_person ?></td>
													<td><?php echo $listview->mxcp_cnt_per_contact_no ?></td>
													<td>
													<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url() ?>admin/editcompany/<?php echo $listview->mxcp_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item deletemodal" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $listview->mxcp_id .'~'. $listview->mxcp_name; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
			<!-- /Page Wrapper -->

			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Company</h3>
								<h3 style="color: red" id="delcmpname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
								<input type="hidden" name="deletemainid" id="delcmpid">
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
<!-- Company Validation -->

<script>
	var cmp = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/company.js"></script>
