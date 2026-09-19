				<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">TDS Deduction</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">TDS Deduction</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					 <div class="card tab-box">
                        <div class="row user-tabs">
                            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="nav-item"><a href="#indivisual_tab" data-toggle="tab" class="nav-link active" id="indivisual_li">Indivisual TDS</a></li>
                                    <li class="nav-item"><a href="#bulk_tab" data-toggle="tab" class="nav-link" id="bulk_li">Bulk TDS</a></li>
                                    <li class="nav-item"><a href="#list_tab" data-toggle="tab" class="nav-link" id="list_li">TDS List</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					
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
                            					    <div class="row filter-row">
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="cmpname" id="cmpname"> 
                            									<option value="">Select Company</option>
                            									<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                            										<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                            									<?php } ?>
                            								</select>
                            								<label class="focus-label">Company</label>
                            								<span class="formerror" id="cmpnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----DIV NAME------->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="divname" id="divname"> 
                                                                <option value="">Select Division</option>
                            								</select>
                            								<label class="focus-label">Division</label>
                            								<span class="formerror" id="divnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----END DIV NAME--->
                            						<!---------STATE NAME--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="cmpstate" id="cmpstate"> 
                            									<option value="">Select State</option>
                            									<?php foreach ($states as $key => $stvalue) { ?>
                            										<option value="<?php echo $stvalue->mxst_id ?>"><?php echo $stvalue->mxst_state ?></option>
                            									<?php } ?>
                            								</select>
                            								<label class="focus-label">State</label>
                            								<span class="formerror" id="cmpstateerror"></span>
                            							</div>
                            						</div>
                            						<!-----END STATE NAME--->
                            						
                            						<!-----BRANCH NAME--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="brname" id="brname"> 
                                                                <option value="">Select Branch</option>
                            								</select>
                            								<label class="focus-label">Branch</label>
                            								<span class="formerror" id="brnameerror"></span>
                            							</div>
                            						</div>
                            						<!-----END BRANCH NAME--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<select class="select2 form-control" name="emptype" id="emptype"> 
                            									<option value="">Select Employee Type</option>
                            								
                            								</select>
                            								<label class="focus-label">Employee Type</label>
                            								<span class="formerror" id="emptypeerror"></span>
                            							</div>
                            						</div>
                            						
                            						
                                                                            
                                                    <!------MONTH YEAR------->
                                                    <div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<input type="text" name="misc_month_year" id="misc_month_year" class="form-control yearmonth" autocomplete="off">
                            								<label class="focus-label">Month-Year</label>
                            								<span class="formerror" id="misc_month_year_error"></span>
                            							</div>
                            						</div>
                                                    <!------END MONTH YEAR--->
                                                    <!--------EMP CODE--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<!--<input type="text" class="form-control floating" name="emp_code" id="emp_code">-->
                            								<select class="select2 form-control" name="emp_code" id="emp_code"> 
                            									<option value="">Select Emp Code</option>
                            								
                            								</select>
                            								<label class="focus-label">Employee Code</label>
                            								<span class="formerror" id="emp_code_error"></span>
                            							</div>
                            						</div>
                                                    <!--------END EMP CODE--->
                                                    <!--------EMP CODE--->
                            						<div class="col-sm-6 col-md-3"> 
                            							<div class="form-group form-focus select-focus">
                            								<input type="text" class="form-control floating" name="tds_amount" id="tds_amount" onpaste="">
                            								<label class="focus-label">TDS Amount</label>
                            								<span class="formerror" id="tds_amount_error"></span>
                            							</div>
                            						</div>
                                                    <!--------END EMP CODE--->
                            
                            
                            						<div class="col-sm-6 col-md-3">  
                            							<button type="submit" class="btn btn-success btn-block"> Save </button>  
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
				        
				        <!--BULK TDS TAB-->
				        <div id="bulk_tab" class="tab-pane fade">

				            	<div class="row">
        							<div class="col-md-12">
        								<div class="card mb-0">
        									<div class="card-header">
        										<h4 class="card-title mb-0">Import Your Excel Files</h4>
        									</div>
        									<div class="card-body">
        										<form id="fileuploads">
        											<div class="row">
        												<div class="col-md-12">
        													<div class="row">
        														<div class="col-md-3">
        															<div class="form-group">
        																<label>Attachement (xlsx|xls):</label>
        																<input type="file" name="uploadFile" id="uploadFile" class="form-control">
        																<span class="formerror" id="uploadFileerror"></span>
        															</div>
        														</div>
        													</div>
        												</div>
        												<div class="col-md-12" id="display" style="color:red"></div>
        											</div>
        											<div class="text-right" id="processimport">
        												<button type="submit" class="btn btn-primary">Import</button>
        											</div>
        										</form>
        									</div>
        								</div>
                                    </div>
    						    </div>
    						    <div class="mt-2 bg-white">
        				            <div class="card-header">
                                        <h4 class="card-title mb-0">Excel Format to Upload</h4>
                                    </div>
        						    <div class="table-responsive">
                    					<table class="datatable table table-stripped mb-0" id="dataTables-bulk">
                    						<thead>
                    							<tr>
                    								<th></th>
                    								<th></th>
                    								
                    							</tr>
                    						</thead>
                    						<tbody>
                								<tr>
                									<td>MXX01</td>
                									<td>202412</td>
                									<td>1000</td>
                								</tr>
                								<tr>
                									<td>MXX02</td>
                									<td>202405</td>
                									<td>500</td>
                								</tr>
                								<tr>
                									<td>MXX03</td>
                									<td>202312</td>
                									<td>100</td>
                								</tr>
                								<tr>
                									<td>MXX01</td>
                									<td>202306</td>
                									<td>1000</td>
                								</tr>
                    						</tbody>
                    					</table>
                    				</div>
						        </div>
        					
        						<script>
                                	$("form#fileuploads").submit(function (e) {
                                    e.preventDefault();
                                
                                	//$(':button[type="submit"]').prop('disabled', true);
                                
                                    var mainurl = baseurl + 'import/savbulkTds';
                                    var formData = new FormData(this);
                                    $.ajax({
                                        url: mainurl,
                                        type: 'POST',
                                        data: formData,
                                        success: function (data) {
                                            console.log(data);
                                            if (data == 200) {
                                                alert('Successfully saved');
                                                window.location.reload();
                                            }else{
                                            	$(':button[type="submit"]').prop('disabled', false);
                                                $("#display").html(data);
                                            }
                                        },
                                        cache: false,
                                        contentType: false,
                                        processData: false
                                    });
                                
                                });
                                
                                // $(document).ready(function(){
                                //     var table = $('#dataTables-bulk').DataTable({
                                //         dom: 'Bfrtip',
                                //         "destroy": true, //use for reinitialize datatable
                                //         lengthChange: false,
                                //         buttons: [
                                //             'excel'
                                //         ]
                                //         // buttons: [
                                //         //     'excel', 'pdf', 'csv'
                                //         // ]
                                //     });
                                // });
                                
                                </script>
			            </div>
				        <!--END BULK TDS TAB-->
				        
				        <!--TDS LIST TAB-->
				        <div id="list_tab" class="tab-pane fade">
				            <div id="listview" class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-0">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">TDS LIST</h4>
                                            </div>
                                            <div class="card-body">
                            					<!-- Search Filter -->
                            					<form id="misc_income_list_form">
                            					    <div class="row filter-row">
                                						<div class="col-sm-6 col-md-3"> 
                                							<div class="form-group form-focus select-focus">
                                								<select class="select2 form-control" name="cmpname_list" id="cmpname_list"> 
                                									<option value="">Select Company</option>
                                									<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                										<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                									<?php } ?>
                                								</select>
                                								<label class="focus-label">Company</label>
                                								<span class="formerror" id="cmpname_listerror"></span>
                                							</div>
                                		                </div>
                                                        <!------MONTH YEAR------->
                                                        <div class="col-sm-6 col-md-3"> 
                                							<div class="form-group form-focus select-focus">
                                								<input type="text" name="misc_month_year_list" id="misc_month_year_list" class="form-control yearmonth" autocomplete="off">
                                								<label class="focus-label">Month-Year</label>
                                								<span class="formerror" id="misc_month_year_list_error"></span>
                                							</div>
                                		</div>
                                                        <!------END MONTH YEAR--->
                                                        <!--------EMP CODE--->
                                						<div class="col-sm-6 col-md-3"> 
                                							<div class="form-group form-focus select-focus">
                                								<input type="text" class="form-control floating" name="emp_code_list" id="emp_code_list" placeholder="Emp Id">
                                								
                                								<label class="focus-label">Employee Code</label>
                                								<span class="formerror" id="emp_code_list_error"></span>
                                							</div>
                                		</div>
                                                        <!--------END EMP CODE--->
                                                       
                                					
                                
                                						<div class="col-sm-6 col-md-3">  
                                							<button type="button" class="btn btn-success btn-block show_list"> Show </button>  
                                		                </div>
                                                    </div>
                            		            </form>
                            					<!-- Search Filter -->
                            					<div class="mt-2" id="displayTDSfilterdata">
                                                </div>
                            				</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
			            </div>
				        <!--END TDS LIST TAB-->
					    
					 </div>
					    
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
			
			
			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete TDS</h3>
								<h3 style="color: red" id="delbrname"></h3>
								<p>Are you sure want to delete?</p>
							</div>
							<input type="hidden" name="tdsid" id="deltdsid">
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_tds">Delete</a>
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
            <script src="<?php echo base_url(); ?>/assets/js/formsjs/misc_income.js"></script>

