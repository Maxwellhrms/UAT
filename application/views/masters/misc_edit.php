				<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Edit TDS Deduction</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Edit TDS Deduction</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					 <div class="tab-content">
				        <!-- Indivisual TDS Tab -->
                        <div id="indivisual_tab" class="tab-pane fade show active">
                            
                            <div id="indivisualaddnew" class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-0">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">ENTER PROMOTIONS DETAILS</h4>
                                            </div>
                                            <div class="card-body">
                            					<!-- Search Filter -->
                            					<form id="misc_income_form">
                            					    <input type="hidden" name="tdsid" value="<?php echo $editedTDSid; ?>">
                            					    <input type="hidden" name="org_yearmonth" value="<?php echo $oldMonthYear; ?>">
                            					    <input type="hidden" name="org_compid" value="<?php echo $editedCompid; ?>">
                            					    <input type="hidden" name="org_empid" value="<?php echo $editedEmpid; ?>">
                            					    <div class="row filter-row">
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="cmpname" id="cmpname" disabled> 
                            									<option value="">Select Company</option>
                            									<?php foreach ($cmpmaster as $key => $cmpvalue) { 
                            									    if($editedCompid == $cmpvalue->mxcp_id){ 
                            										    echo '<option value="'.$cmpvalue->mxcp_id.'" selected>'.$cmpvalue->mxcp_name.'</option>';
                            									    }else{
                            										    echo '<option value="'.$cmpvalue->mxcp_id.'">'.$cmpvalue->mxcp_name.'</option>';
                            									    }
                            									 } ?>
                            								</select>
                            								<label class="focus-label">Company</label>
                            								<span class="formerror" id="cmpnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----DIV NAME------->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="divname" id="divname" disabled> 
                                                                <option value="">Select Division</option>
                                                                <?php foreach ($divmaster as $key => $divvalue) { 
                            									    if($editedDivid == $divvalue->mxd_id){ 
                            										    echo '<option value="'.$divvalue->mxd_id.'" selected>'.$divvalue->mxd_name.'</option>';
                            									    }else{
                            										    echo '<option value="'.$divvalue->mxd_id.'">'.$divvalue->mxd_name.'</option>';
                            									    }
                            									 } ?>
                            								</select>
                            								<label class="focus-label">Division</label>
                            								<span class="formerror" id="divnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----END DIV NAME--->
                            						<!---------STATE NAME--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="cmpstate" id="cmpstate" disabled> 
                            									<option value="">Select State</option>
                            									<?php foreach ($states as $key => $statevalue) { 
                            									    if($editedStateid == $statevalue->mxst_id){ 
                            										    echo '<option value="'.$statevalue->mxst_id.'" selected>'.$statevalue->mxst_state.'</option>';
                            									    }else{
                            										    echo '<option value="'.$statevalue->mxst_id.'">'.$statevalue->mxst_state.'</option>';
                            									    }
                            									 } ?>
                            								</select>
                            								<label class="focus-label">State</label>
                            								<span class="formerror" id="cmpstateerror"></span>
                            							</div>
                            						</div>
                            						<!-----END STATE NAME--->
                            						
                            						<!-----BRANCH NAME--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="brname" id="brname" disabled> 
                                                                <option value="">Select Branch</option>
                                                                <?php foreach ($branchdetails as $key => $branchvalue) { 
                            									    if($editedBranchid == $branchvalue->mxb_id){ 
                            										    echo '<option value="'.$branchvalue->mxb_id.'" selected>'.$branchvalue->mxb_name.'</option>';
                            									    }else{
                            										    echo '<option value="'.$branchvalue->mxb_id.'">'.$branchvalue->mxb_name.'</option>';
                            									    }
                            									 } ?>
                            								</select>
                            								<label class="focus-label">Branch</label>
                            								<span class="formerror" id="brnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----END BRANCH NAME--->
                            						
                                                                            
                                                    <!------MONTH YEAR------->
                                                    <div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<input type="text" name="misc_month_year" id="misc_month_year" class="form-control yearmonth" autocomplete="off" value="<?php echo $monthYear; ?>">
                            								<label class="focus-label">Month-Year</label>
                            								<span class="formerror" id="misc_month_year_error"></span>
                            							</div>
                            						</div>
                                                    <!------END MONTH YEAR--->
                                                    <!--------EMP CODE--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<input type="text" class="form-control floating" name="emp_code" id="emp_code" value="<?php echo $tdsData[0]->mxemp_misc_inc_empcode; ?>" disabled>
                            								
                            								<label class="focus-label">Employee Code</label>
                            								<span class="formerror" id="emp_code_error"></span>
                            							</div>
                            						</div>
                                                    <!--------END EMP CODE--->
                                                    <!--------EMP CODE--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<input type="text" class="form-control floating" name="tds_amount" id="tds_amount" onpaste="" value="<?php echo $tdsData[0]->mxemp_misc_inc_tds_amt; ?>">
                            								<label class="focus-label">TDS Amount</label>
                            								<span class="formerror" id="tds_amount_error"></span>
                            							</div>
                            						</div>
                                                    <!--------END EMP CODE--->
                            
                            
                            						<div class="col-sm-6 col-md-3">  
                            							<button type="submit" class="btn btn-success btn-block"> Update </button>  
                            						</div>
                                                </div>
                            		</form>
                            					<!-- Search Filter -->
                            				</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
				        <!-- END Indivisual TDS Tab -->
				        
				       
				        
				      
					    
					 </div>
					    
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
            <script src="<?php echo base_url(); ?>/assets/js/formsjs/misc_income_edit.js"></script>

