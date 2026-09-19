			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Geo Location Attendance</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-body">
										<form id="googlemap"  action=<?php echo base_url() ?>attendance_controller/attendance_google_map> 
										<!--method="get"-->
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
					                                            <select class="form-control select2" name="esi_company_id" id="esi_company_id"  style="width: 100%" required>
							                                        <option value="">-- Select Company --</option>
							                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
							                                        <?php if( (count($locations)>0 ) &&  ($key == $cmpmaster[0]->mxcp_id) ){ ?>
    							                                        <option  selected value="<?php echo $cmpvalue->mxcp_id ?>" ><?php echo $cmpvalue->mxcp_name ?></option>
							                                        <?php }else{ ?>
							                                            <option value="<?php echo $cmpvalue->mxcp_id ?>" ><?php echo $cmpvalue->mxcp_name ?></option>
							                                        <?php }  } ?>
							                                    </select>
							                                    <span class="formerror" id="cmpnameerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<label>Division:</label>
															<select class="select2 form-control"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															<option value="">Select Division</option>
															  <?php if(count($locations)>0 ){
															    foreach($load_division as $divkey =>$divval){ 
															               if($divval->mxd_id == $div_id){ $select ='selected'; }else{ $select =''; } ?>
    							                                        <option <?php echo $select  ?>  value="<?php echo $divval->mxd_id ?>" ><?php echo $divval->mxd_name ?></option>
							                                  <?php }  } ?>
															</select>
															<span class="formerror" id="esi_div_id_error"></span>
															</div>
														</div>
														<div class="col-md-6">
                        				                    <div class="form-group form-focus select-focus">
                        				                        <label>Attendance Date</label>
                                                            	<input type="text" class="form-control datetimepicker11" name="attendance" id="attendance" autocomplete="off" required >
                        				                        <span class="formerror" id="attendance_error"></span>
                        				                    </div>
                        				                </div>
                        				                
                        				                <div class="col-md-6">
                        				                    <div class="form-group form-focus select-focus">
                        				                        <label>Employee Code</label>
                                                            	<input type="text" class="form-control" name="employee_code" id="employee_code" autocomplete="off" >
                        				                        <span class="formerror" id="employee_code_err"></span>
                        				                    </div>
                        				                </div>

														
														
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
															<label>State:</label>
	                                                        <select class="form-control select2" name="esi_state_id" id="esi_state_id" style="width: 100%;" >
	                                                            <option value="">Select State</option>
	                                                            <?php if(count($locations)>0 ){
															    foreach($load_state as $stakey =>$staval){ 
															     if($staval->mxst_id == $state_id){ $select ='selected'; }else{ $select =''; } ?>
    							                                 <option <?php echo $select  ?>  value="<?php echo $staval->mxst_id ?>" ><?php echo $staval->mxst_state ?></option>
							                                  <?php }  } ?>
	                                                        </select>
	                                                        <span class="formerror" id="esi_state_id_error"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
														    	<label>Branch:</label>
                                                                <select class="form-control select2" name="esi_branch_id" id="esi_branch_id" style="width: 100%;" >
                                                                    <option value="">Select Branch</option>
                                                                    <?php if(count($locations)>0 ){
        															    foreach($load_branch as $brankey =>$branval){ 
        															         if($branval->mxb_id == $branch_id){ $select ='selected'; }else{ $select =''; } ?>
            							                                          <option <?php echo $select  ?>  value="<?php echo $branval->mxb_id ?>" ><?php echo $branval->mxb_name ?></option>
    							                                  <?php }  } ?>
                                                                </select>
                                                                <span class="formerror" id="esi_branch_id_error"></span>
															</div>
														</div>
														
														<div class="col-sm-6">  
														    <label></label>
							                                 <button id="searchemployeefilterdata1" class="btn btn-success btn-block" > Search </button>      
							                             </div>

    												</div>
    											</div>
											</div>  
										</form>
									</div>
								</div>
							</div>
						</div>
						
	<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="card mb-0">					
            <div class="card-header">
                <h4 class="card-title mb-0"> Employees List</h4>
            </div>
            <div class="card-body">	
                <div class="table-responsive" id="employeeid">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

				</div>

			</div>
			<!-- /Page Wrapper -->


<script src="<?php echo base_url(); ?>/assets/js/formsjs/google_map.js"></script>