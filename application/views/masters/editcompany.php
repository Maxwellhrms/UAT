			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Your Company</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Edit Your Company</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
						
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Edit Your Company Details</h4>
									</div>
									<div class="card-body">
										<form id="processcmpdetails">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Company Name:</label>
														<input type="text" name="cmpname" id="cmpname" class="form-control" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_name ?>">
														<span class="formerror" id="cmpnameerror"></span>
													</div>
													<input type="hidden" name="id" value="<?php echo $cmpdetails[0]->mxcp_id ?>">
													<div class="form-group">
														<label>Company State:</label>
														<select class="select select2" name="cmpstate" id="cmpstate">
															<option value="">Select Company State</option>
															<?php foreach ($states as $key => $stvalue) {
																if($stvalue->mxst_id == $cmpdetails[0]->mxcp_state_id){
																	$sel = "selected";
																}else{
																	$sel = "";
																}
															 ?>
																<option value="<?php echo $stvalue->mxst_id .'@~@'. $stvalue->mxst_state ?>" <?php echo $sel ?>><?php echo $stvalue->mxst_state ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="cmpstateerror"></span>
													</div>
													<div class="form-group">
														<label>Company Address:</label>
														<textarea name="cmpaddress" id="cmpaddress" rows="5" cols="5" class="form-control" placeholder="Enter Company Address"><?php echo $cmpdetails[0]->mxcp_address  ?></textarea>
														<span class="formerror" id="cmpaddresserror"></span>
													</div>
													<div class="form-group">
														<label>Company Website URL</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">https://</span>
															</div>
															<input type="text" name="cmpweburl" id="cmpweburl" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_website ?>" >
														</div>
															<span class="formerror" id="cmpweburlerror"></span>
													</div>
													<div class="form-group">
														<label>Company Tax Deduction Account No:</label>
														<input name="cmptx" id="cmptx" type="text" class="form-control"  value="<?php echo $cmpdetails[0]->mxcp_tax_ded_ac_no ?>">
														<span class="formerror" id="cmptxerror"></span>
													</div>
													<div class="form-group">
														<label>Company Week off Days:</label>
													<div class="checkbox">
														<label>
															<input type="checkbox" name="cmpweekoffmon" id="cmpweekoffmon" value="1" <?php if($cmpdetails[0]->mxcp_wo_mon == 1){ echo 'checked'; }else{ echo ''; } ?> > Monday
														</label>
														<label>
															<input type="checkbox" name="cmpweekofftues" id="cmpweekofftues" value="1" <?php if($cmpdetails[0]->mxcp_wo_tue == 1){ echo 'checked'; }else{ echo ''; } ?> > Tuesday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffwed" id="cmpweekoffwed" value="1" <?php if($cmpdetails[0]->mxcp_wo_wed == 1){ echo 'checked'; }else{ echo ''; } ?> > Wednesday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffthur" id="cmpweekoffthur" value="1" <?php if($cmpdetails[0]->mxcp_wo_thu == 1){ echo 'checked'; }else{ echo ''; } ?> > Thursday
														</label>
														<label>
															<input type="checkbox" name="cmpweekofffri" id="cmpweekofffri" value="1" <?php if($cmpdetails[0]->mxcp_wo_fri == 1){ echo 'checked'; }else{ echo ''; } ?> > Friday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffsat" id="cmpweekoffsat" value="1" <?php if($cmpdetails[0]->mxcp_wo_sat == 1){ echo 'checked'; }else{ echo ''; } ?> > Saturday
														</label>
														<label>
															<input type="checkbox" name="cmpweekoffsun" id="cmpweekoffsun" value="1" <?php if($cmpdetails[0]->mxcp_wo_sun == 1){ echo 'checked'; }else{ echo ''; } ?> > Sunday
														</label>
													</div>
													<span class="formerror" id="weekofferror"></span>
													</div>
													<div class="form-group">
														<label>Company Logo:</label>
														<input type="file" name="cmplogo" id="cmplogo" class="form-control">
														<span class="formerror" id="cmplogoerror"></span>
														<h4><?php echo $cmpdetails[0]->mxcp_pic ?></h4>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>In Corporation No:</label>
																<input type="text" name="cmpcpno" id="cmpcpno" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_reg_no ?>" >
																<span class="formerror" id="cmpcpnoerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Mtw Licence No:</label>
																<input type="text" name="cmpmtwlicence" id="cmpmtwlicence" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_licence_no ?>" >
																<span class="formerror" id="cmpmtwlicenceerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company City:</label>
																<input type="text" name="cmpcity" id="cmpcity" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_city ?>" >
																<span class="formerror" id="cmpcityerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Pincode:</label>
																<input type="text" name="cmppincode" id="cmppincode" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_pincode ?>" >
																<span class="formerror" id="cmppincodeerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Mobile No:</label>
																<input type="number" name="cmpmobile" id="cmpmobile" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_mobile_no ?>" >
																<span class="formerror" id="cmpmobileerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Land line No:</label>
																<input type="text" name="cmplandline" id="cmplandline" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_telphone_no ?>" >
																<span class="formerror" id="cmplandlineerror"></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Fax No:</label>
																<input type="text" name="cmpfax" id="cmpfax" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_fax_no ?>" >
																<span class="formerror" id="cmpfaxerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Email Id:</label>
																<input type="text" name="cmpemail" id="cmpemail" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_email_id ?>" >
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
																	<?php foreach ($financial as $key => $fvalue) {
																	if($fvalue->mxfny_id == $cmpdetails[0]->mxcp_fin_year_type){
																		$sel = "selected";
																	}else{
																		$sel = "";
																	}
																	 ?>
																		<option value="<?php echo $fvalue->mxfny_id ?>" <?php echo $sel ?>><?php echo $fvalue->mxfny_name ?></option>
																	<?php } ?>
																</select>
																<span class="formerror" id="cmpfnyyearerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Establishment Date:</label>
																<input type="text" name="cmpestdate" id="cmpestdate" class="form-control datetimepicker" value="<?php echo date('d-m-Y',strtotime($cmpdetails[0]->mxcp_establishment_date)) ?>">
																<span class="formerror" id="cmpestdateerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Gratuity Code:</label>
																<input type="text" name="cmpgratuitycode" id="cmpgratuitycode" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_gratuity_reg_no ?>">
																<span class="formerror" id="cmpgratuitycodeerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Gratuity Date:</label>
																<input type="text" name="cmpgratuitydate" id="cmpgratuitydate" class="form-control datetimepicker" value="<?php echo date('d-m-Y',strtotime($cmpdetails[0]->mxcp_gratuity_reg_date)) ?>">
																<span class="formerror" id="cmpgratuitydateerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Contact Person Mobile:</label>
																<input type="text" name="cmpcntpermb" id="cmpcntpermb" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_cnt_per_contact_no ?>">
																<span class="formerror" id="cmpcntpermberror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Company Contact Person Name:</label>
																<input type="text" name="cmpcntper" id="cmpcntper" class="form-control" value="<?php echo $cmpdetails[0]->mxcp_name_of_contact_person ?>">
																<span class="formerror" id="cmpcntpererror"></span>
															</div>
														</div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>First Half:</label>
                                                                        <input type="text" name="cmpfirsthalf" id="cmpfirsthalf" class="form-control datetimepicker2" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_firsthalf_time ?>">
                                                                        <span class="formerror" id="cmpfirsthalfrerror"></span>
                                                                </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Second Half:</label>
                                                                        <input type="text" name="cmpsecondhalf" id="cmpsecondhalf" class="form-control datetimepicker2" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_secondhalf_time ?>" >
                                                                        <span class="formerror" id="cmpseconderror"></span>
                                                                </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Break Start Time:</label>
                                                                        <input type="text" name="cmpbreak" id="cmpbreak" class="form-control datetimepicker2" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_secondbreak_time ?>">
                                                                        <span class="formerror" id="cmpbreakerror"></span>
                                                                </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Break End Time:</label>
                                                                        <input type="text" name="cmpbreakend" id="cmpbreakend" class="form-control datetimepicker2" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_secondbreak_endtime ?>">
                                                                        <span class="formerror" id="cmpbreakenderror"></span>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Logoff Time:</label>
                                                                        <input type="text" name="cmpendtime" id="cmpendtime" class="form-control datetimepicker2" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_logoff_time?>">
                                                                        <span class="formerror" id="cmpendtime"></span>
                                                                </div>
                                                        </div>
    
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>First Half Grace Time:</label>
                                                                        <input type="text" name="firstgracetime" id="firstgracetime" class="form-control datetimepicker_minutes" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_firsthalf_gracetime?>">
                                                                        <span class="formerror" id="firstgracetimeerror"></span>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                                <div class="form-group">
                                                                        <label>Second Half Grace Time:</label>
                                                                        <input type="text" name="secondgracetime" id="secondgracetime" class="form-control datetimepicker_minutes" autocomplete="off" value="<?php echo $cmpdetails[0]->mxcp_secondhalf_gracetime?>">
                                                                        <span class="formerror" id="secondgracetimeerror"></span>
                                                                </div>
                                                        </div>

													</div>
												</div>
											</div>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Edit Company Details</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					
				</div>
			</div>
			<!-- /Page Wrapper -->

<!-- Company Validation -->

<script>
	var cmp = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/company.js"></script>
