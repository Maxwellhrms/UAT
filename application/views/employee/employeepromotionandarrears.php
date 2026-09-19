<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create Employee Promotions & Arrears</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Promotions & Arrears Master</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#promotons_tab" data-toggle="tab" class="nav-link active" id="promotion_inc_li">PROMOTION INCREMENT</a></li>
                        <li class="nav-item"><a href="#special_inc_tab" data-toggle="tab" class="nav-link" id="bns_master_li">CURRENT MONTH INCREMENTS</a></li>
                        <li class="nav-item"><a href="#arears_tab" data-toggle="tab" class="nav-link" id="bns_master_li">ARREARS INCREMENT</a></li>
                        <li class="nav-item"><a href="#transfer_tab" data-toggle="tab" class="nav-link" id="bns_master_li">TRANSFER</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">

            <!-- PROMOTION INCREAMENT Tab -->
            <div id="promotons_tab" class="tab-pane fade show active">
                <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#lwfaddnew">Add New</button>-->
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#promotionaddnew">Add New</button>
                <div id="promotionaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER PROMOTIONS DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="promotion_increament_form" method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">                                    
                                                                <div class="card-body">                                        
                                                                    <div class="row">
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">Company</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="promotion_company_id" id="promotion_company_id" style="width: 100%;">
                                                                                        <option value="0">Select Company</option>
                                                                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                                                        <?php } ?>                                         
                                                                                    </select>
                                                                                    <span class="formerror" id="promotion_company_id_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">Division</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="select2 form-control"  data-placeholder="Select Division" name="promotion_div_id" id="promotion_div_id" style="width: 100%;">
                                                                                        <option value="0">Select Division</option>
                                                                                    </select>
                                                                                    <span class="formerror" id="promotion_div_id_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">State:</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="form-control select2" name="promotion_state_id" id="promotion_state_id" style="width: 100%;">
                                                                                        <option value="0">Select State</option>
                                                                     
                                                                                    </select>
                                                                                </div>
                                                                                <span class="formerror" id="promotion_state_id_error"></span>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">Branch</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="form-control select2" name="promotion_branch_id" id="promotion_branch_id" style="width: 100%;">
                                                                                        <option value="0">Select Branch</option>                    
                                                                                    </select>
                                                                                    <span class="formerror" id="promotion_branch_id_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">Employee Id</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="form-control select2" name="promotion_employeeid" id="promotion_employeeid" style="width: 100%;"></select>
                                                                                    <span class="formerror" id="promotion_employeeid_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="form-group row col-md-4">-->
                                                                            <!--        <label class="col-lg-3 col-form-label">Start Date</label>-->
                                                                            <!--        <div class="col-lg-9">-->
                                                                            <!--            <input type="text" name="promotion_start_date" id="promotion_start_date" class="form-control yearmonth" autocomplete="off">-->
                                                                            <!--            <span class="formerror" id="promotion_start_date_error"></span>-->
                                                                            <!--        </div>-->
                                                                            <!--</div>-->
                                                                            <div class="form-group row col-md-4">
                                                                                    <label class="col-lg-12 col-form-label">Affect Date</label>
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text" name="promotion_affect_date" id="promotion_affect_date" class="form-control datetimepicker" autocomplete="off">
                                                                                        <span class="formerror" id="promotion_affect_date_error"></span>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="form-group row col-md-4">
                                                                                    <label class="col-lg-12 col-form-label">Amount</label>
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text" name="promotion_amount" id="promotion_amount" class="form-control numbersonly_with_dot" placeholder="Enter Amount" autocomplete="off">
                                                                                        <span class="formerror" id="promotion_amount_error"></span>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                                    <li class="nav-item"><a class="nav-link active" id="authorizationinformation" href="#solid-justified-promotion" data-toggle="tab">Promotion</a></li>
                                                    <li class="nav-item"><a class="nav-link" id="authorizationinformation" href="#solid-justified-prom-auth" data-toggle="tab">Authorization</a></li>
                                                </ul>     
                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="solid-justified-promotion">
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title mb-0">Promotion From</h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Company</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="cmpname_prm_from" id="cmpname_prm_from" style="width:100%">
                                                                                    <option value="">-- Select Company --</option>
                                    
                                                                                </select>
                                                                                <span class="formerror" id="cmpname_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Division</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="divname_prm_from" id="divname_prm_from" style="width:100%">
                                                                                    <option value="">-- Select Division --</option>
                                    
                                                                                </select>
                                                                                <span class="formerror" id="divname_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">State</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="cmpstate_prm_from" id="cmpstate_prm_from" style="width:100%">
                                                                                    <option value="">Select State</option>
                                    
                                                                                </select>
                                                                                <span class="formerror" id="cmpstate_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Branch</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="brname_prm_from" id="brname_prm_from" style="width:100%">
                                                                                    <option value="">Select Branch</option>                                                    
                                                                                </select>
                                                                                <span class="formerror" id="brname_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Designation</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="desgname_prm_from" id="desgname_prm_from" style="width:100%">
                                                                                    <option value="">Select Designation</option>                                                    
                                                                                </select>
                                                                                <span class="formerror" id="desgname_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                        													<label class="col-lg-4 col-form-label">Departement</label>
                        													<div class="col-lg-8">
                        														<select class="form-control select2" name="deptname_prm_from" id="deptname_prm_from" style="width:100%">
                        														    <option value="">Select Departement</option>
                        														</select>
                        														<span class="formerror" id="deptname_prm_from_error"></span>
                        													</div>
                        												</div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Grade</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="gradename_prm_from" id="gradename_prm_from" style="width:100%">
                                                                                    <option value="">Select Grade</option>                                                    
                                                                                </select>
                                                                                <span class="formerror" id="gradename_prm_from_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        
                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title mb-0">Promotion To</h4>
                                                                    </div>
                                                                    <div class="card-body">
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Division</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="divname_prm_to" id="divname_prm_to" style="width:100%">
                                                                                    <option value="">-- Select Division --</option>
                                                                                    <?php foreach ($divisiondetails as $keys => $div_value) { ?>
                                                                                        <option value="<?php echo $div_value->mxd_id . '@~@' . $div_value->mxd_name  ?>"><?php echo $div_value->mxd_name ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                <span class="formerror" id="divname_prm_to_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">State</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="cmpstate_prm_to" id="cmpstate_prm_to" style="width:100%">
                                                                                    <option value="">Select State</option>
                                                                                </select>
                                                                                <span class="formerror" id="cmpstate_prm_to_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Branch</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="brname_prm_to" id="brname_prm_to" style="width:100%">
                                                                                    <option value="">Select Branch</option>
                                                                                </select>
                                                                                <span class="formerror" id="brname_prm_to_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Designation</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="desg_prm_to" id="desg_prm_to" style="width:100%">
                                                                                    <option value="">Select Designation</option>                                                    
                                                                                </select>
                                                                                <span class="formerror" id="desg_prm_to_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                        													<label class="col-lg-4 col-form-label">Departement</label>
                        													<div class="col-lg-8">
                        														<select class="form-control select2" name="deptname_prm_to" id="deptname_prm_to" style="width:100%">
                        														    <option value="">Select Departement</option>
                        														</select>
                        														<span class="formerror" id="deptname_prm_to_error"></span>
                        													</div>
                        												</div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Grade</label>
                                                                            <div class="col-lg-8">
                                                                                <select class="form-control select2" name="grade_prm_to" id="grade_prm_to" style="width:100%">
                                                                                    <option value="">Select Grade</option>                                                    
                                                                                </select>
                                                                                <span class="formerror" id="grade_prm_to_error"></span>
                                                                            </div>
                                                                        </div>
                                    
                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--authorization-->
                                                    <div class="tab-pane" id="solid-justified-prom-auth">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card mb-0">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title mb-0">Authorization</h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-xl-12">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12">
																						<label>Is Authrisations Applicable</label>
																						<input class="form-control col-md-2" type="checkbox" name="is_authorisation" id="is_authorisation" value="1">
																					</div>
                                                                                    <!-------------LINE 1---->
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Authorization Type:</label>
                                                                                            <select class="form-control prom_auth_type" name="prom_authorizationtype[]" id="prom_authtype_1">
                                                                                                <option value="">Select Auth Type</option>
                                                                                                <option value="1">Branch</option>
                                                                                                <option value="2">Head Office</option>
                                                                                                <option value="3">HR</option>
                                                                                                <option value="4">Director</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Department Name:</label>
                                                                                            <!--<input type="text" class="form-control" name="authorizationdepartmentbr" id="authorizationdepartmentbr" autocomplete="off">-->
                                                                                            <select class="form-control select2 prom_auth_dept" name="prom_auth_dept[]" id="prom_authdept_1" style="width:100%">
                                                                                                
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                         <div class="form-group">
                                                                                            <label>Employee Name:</label>
                                                                                            <select type="text" class="form-control select2 prom_emp_name" style="width: 100%" name="prom_emp_name[]" id="prom_empname_1" autocomplete="off"></select>
                                                                                        </div>
                                                                                    </div>
                    
                                                                                    <!-------------END LINE 1--------->
                                                                                    <!-------------LINE 2--------->
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Authorization Type:</label>
                                                                                            <select class="form-control prom_auth_type" name="prom_authorizationtype[]" id="prom_authtype_2">
                                                                                                <option value="">Select Auth Type</option>
                                                                                                <option value="1">Branch</option>
                                                                                                <option value="2">Head Office</option>
                                                                                                <option value="3">HR</option>
                                                                                                <option value="4">Director</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Department Name:</label>
                                                                                            <!--<input type="text" class="form-control" name="authorizationdepartmenthr" id="authorizationdepartmenthr" autocomplete="off">-->
                                                                                            <select class="form-control select2 prom_auth_dept" name="prom_auth_dept[]" id="prom_authdept_2" style="width:100%">
                                                                                                <!--<option value="">Type</option>-->
                                                                                                <!--<option value="3">Hr</option>-->
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Employee Name:</label>
                                                                                            <select type="text" class="form-control select2 prom_emp_name" style="width: 100%" name="prom_emp_name[]" id="prom_empname_2" autocomplete="off"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-------------END LINE 2--------->
                                                                                    <!-------------LINE 3--------->
                    
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Authorization Type:</label>
                                                                                            <select class="form-control prom_auth_type" name="prom_authorizationtype[]" id="prom_authtype_3">
                                                                                                <option value="">Select Auth Type</option>
                                                                                                <option value="1">Branch</option>
                                                                                                <option value="2">Head Office</option>
                                                                                                <option value="3">HR</option>
                                                                                                <option value="4">Director</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Department Name:</label>
                                                                                            <select class="form-control select2 prom_auth_dept" name="prom_auth_dept[]" id="prom_authdept_3" style="width:100%">                                                                                                                                                                                                                            
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Employee Name:</label>
                                                                                            <select type="text" class="form-control select2 prom_emp_name" name="prom_emp_name[]" style="width: 100%" id="prom_empname_3" autocomplete="off"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-------------END LINE 3--------->
                                                                                    <!-------------LINE 4--------->
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Authorization Type:</label>
                                                                                            <select class="form-control prom_auth_type" name="prom_authorizationtype[]" id="prom_authtype_4">
                                                                                                <option value="">Select Auth Type</option>
                                                                                                <option value="1">Branch</option>
                                                                                                <option value="2">Head Office</option>
                                                                                                <option value="3">Hr</option>
                                                                                                <option value="4">Director</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Department Name:</label>
                                                                                            <select class="form-control select2 prom_auth_dept" name="prom_auth_dept[]" id="prom_authdept_4" style="width:100%">
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label>Employee Name:</label>
                                                                                            <select type="text" class="form-control select2 prom_emp_name" style="width: 100%" name="prom_emp_name[]" id="prom_empname_4" autocomplete="off"> </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-------------END LINE 4--------->
                                                                                    <div class="col-md-2"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                    <!--authorization-->
                                                </div>
                                        </div>
                                            <!--<hr>-->
                                            <!--<div class="text-right">-->
                                            <!--    <button type="submit" class="btn btn-primary">Submit</button>-->
                                            <!--</div>-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PROMOTION Data Tables -->
                <div class="row" style="margin-top: 10px;" id="promotion_inc_table">
                    <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">PROMOTIONS LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0 dataTables-example"  >
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
                                            <th>From Dept Name</th>
                                            <th>From Grade Name</th>
                                            <th>To Cmp Name</th>
                                            <th>To Div Name</th>
                                            <th>To State Name</th>
                                            <th>To Branch Name</th>
                                            <th>To Desig Name</th>
                                            <th>To Dept Name</th>
                                            <th>To Grade Name</th>
                                            <!--<th>Edit</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno = 1;foreach($promotion_inc as $prom_inc){ ?>
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
                                            <td><?php echo $prom_inc->mxemp_prm_dept_name_from; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_grade_name_from; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_comp_name_to; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_div_name_to; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_state_name_to; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_branch_name_to; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_desg_name_to; ?></td>
                                            <td><?php echo $prom_inc->mxemp_prm_dept_name_to; ?></td>
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
                <!-- END PROMOTION Data Tables -->
                <!-- Delete PROMOTION Statutory Modal -->
                <div class="modal custom-modal fade" id="promotion_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="lwf_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="lwf_id_hidden" id="del_lwf_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_lwf">Delete</a>
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
                <!-- /Delete PROMOTION STATUTORY Modal -->

            </div>
            <!-- END PROMOTION INCREAMENT Tab -->

            <!--SPECIAL INCREAMENT Tab -->
            <div id="special_inc_tab" class="tab-pane fade">
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#spcl_inc_addnew">Add New</button>
                <div id="spcl_inc_addnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER CURRENT MONTH INCREMENTS DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="special_increament_form" method="POST">
                                        <div class="row">
                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="special_cmp_id" id="special_cmp_id" style="width:100%">
                                                            <option value="">-- Select Company --</option>
                                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                                <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="special_cmp_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="special_div_id" id="special_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                        </select>
                                                        <span class="formerror" id="special_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select State" name="special_state_id" id="special_state_id" style="width: 100%;">
                                                            <option value="0">Select State</option>
                                                        </select>
                                                        <span class="formerror" id="special_state_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Branch" name="special_branch_id" id="special_branch_id" style="width: 100%;">
                                                            <option value="0">Select Branch</option>
                                                        </select>
                                                        <span class="formerror" id="special_branch_id_error"></span>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">EMPLOYEE</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select State" name="special_emp_code" id="special_emp_code" style="width: 100%;">
                                                            <option value="0">Select Employee</option>
                                                        </select>
                                                        <span class="formerror" id="special_emp_code_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="special_affect_date" id="special_affect_date" class="form-control datetimepicker" autocomplete="off">
                                                        <span class="formerror" id="special_affect_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Amount</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="Enter Amount" name="special_inc_amount" id="special_inc_amount">
                                                        <span class="formerror" id="special_inc_amount_error"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php // print_r($bns_statutory);
                ?>
                <!-- Data Tables -->
                <div class="row" style="margin-top: 10px;" id="special_inc_table">
                    <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">INCREMENT LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0 dataTables-example"  >
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
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $sno = 1; foreach($special_inc as $inc){ ?>
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
                                             <td>
                                                <div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php //if($this->session->userdata('user_role_edit') == 1){ ?><!--<a class="dropdown-item" href="<?php echo base_url() ?>admin/editbranch/<?php echo $brvalue->mxb_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>--><?php //} ?>
														<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item spl_inc_deletemodal" data-toggle="modal" data-target="#delete_spcl_inc_modal" data-id="<?php echo $inc->mxemp_spl_inc_id; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
													</div>
												</div>
                                            </td>
                                         </tr>
                                     <?php $sno++; }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Data Tables -->
                <!-- Delete Bonus Statutory Modal -->
                <div class="modal custom-modal fade" id="delete_spcl_inc_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Increment</h3>
                                    <h3 style="color: red" id="bns_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="spl_inc_id_hidden" id="spl_inc_id_hidden">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_spl_inc">Delete</a>
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
                <!-- /Delete Bonus STATUTORY Modal -->



            </div>
            <!--END SPECIAL INCREAMENT Tab -->

            <!--AREARS INCREAMENT Tab -->
            <div id="arears_tab" class="tab-pane fade">
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#arrear_addnew">Add New</button>
                <div id="arrear_addnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER ARREARS DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="arears_inc_form" method='POST'>
                                        <div class="row">
                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="arear_cmp_id" id="arear_cmp_id" style="width:100%">
                                                            <option value="">-- Select Company --</option>
                                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                                <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="arear_cmp_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="arear_div_id" id="arear_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                        </select>
                                                        <span class="formerror" id="arear_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select State" name="arear_state_id" id="arear_state_id" style="width: 100%;">
                                                            <option value="0">Select State</option>
                                                        </select>
                                                        <span class="formerror" id="arear_state_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Branch" name="arear_branch_id" id="arear_branch_id" style="width: 100%;">
                                                            <option value="0">Select Branch</option>
                                                        </select>
                                                        <span class="formerror" id="arear_branch_id_error"></span>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">EMPLOYEE</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Emp Code" name="area_emp_code" id="area_emp_code" style="width: 100%;">
                                                            <option value="0">Select Employee</option>
                                                        </select>
                                                        <span class="formerror" id="area_emp_code_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Start Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="arear_start_date" id="arear_start_date" class="form-control yearmonth_disable_future_dates" autocomplete="off">
                                                        <span class="formerror" id="arear_start_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="arear_affect_date" id="arear_affect_date" class="form-control yearmonth_disable_future_dates" autocomplete="off">
                                                        <span class="formerror" id="arear_affect_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Amount</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="Enter amount" name="arear_amount" id="arear_amount">
                                                        <span class="formerror" id="arear_amount_error"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php // print_r($bns_statutory);
                ?>
                <!-- Data Tables -->
                <div class="row" style="margin-top: 10px;" id="arear_inc_table">
                    <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">AREARS LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0 dataTables-example"  >
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
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno = 1; foreach($arear_inc as $arr_inc){ ?>
                                         <tr>
                                             <td> <?php echo $sno; ?> </td>
                                             <td> <?php echo $arr_inc->mxemp_arears_emp_code; ?> </td>
                                             <td> <?php echo $arr_inc->mxemp_emp_fname .' '.$arr_inc->mxemp_emp_lname; ?> </td>
                                             <td> <?php echo $arr_inc->mxemp_arears_amount; ?> </td>
                                             <td> <?php echo $arr_inc->mxemp_arears_start_dt; ?> </td>
                                             <td> <?php echo $arr_inc->mxemp_arears_affect_dt; ?> </td>
                                             <td> <?php echo $arr_inc->mxcp_name; ?> </td>
                                             <td> <?php echo $arr_inc->mxd_name; ?> </td>
                                             <td> <?php echo $arr_inc->mxb_state_name; ?> </td>
                                             <td> <?php echo $arr_inc->mxb_name; ?> </td>
                                             <td>
                                                <div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php //if($this->session->userdata('user_role_edit') == 1){ ?><!--<a class="dropdown-item" href="<?php echo base_url() ?>admin/editbranch/<?php echo $brvalue->mxb_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>--><?php //} ?>
														<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item arrear_deletemodal" data-toggle="modal" data-target="#delete_arrear_modal" data-id="<?php echo $arr_inc->mxemp_arears_id; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
													</div>
												</div>
                                            </td>
                                         </tr>
                                     <?php $sno++; }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Data Tables -->
                <!-- Delete Bonus Statutory Modal -->
                <div class="modal custom-modal fade" id="delete_arrear_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Arrear</h3>
                                    <h3 style="color: red" id="bns_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="arrear_id" id="arrear_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_arrear">Delete</a>
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
                <!-- /Delete Bonus STATUTORY Modal -->



            </div>
            <!--END AREARS INCREAMENT Tab -->
            
            <!--TRANSFER Tab -->
            <div id="transfer_tab" class="tab-pane fade">
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#transfer_add_new">Add New</button>
                <div id="transfer_add_new" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER TRANSFER DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="processtransfer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card mb-0">
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">                                    
                                                                <div class="card-body">                                        
                                                                    <div class="row">
                                                                        <div class="form-group col-md-4">
                                                                            <label class="col-lg-12 col-form-label">Company</label>
                                                                            <div class="col-lg-12">
                                                                                <select class="select2 form-control"  data-placeholder="Select Company" name="company_id" id="company_id" style="width: 100%;">
                                                                                    <option value="0">Select Company</option>
                                                                                    <?php
                                                                                    foreach ($cmpmaster as $companies) {
                                                                                        echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                                                    }
                                                                                    ?>                                         
                                                                                </select>
                                                                                <span class="formerror" id="company_id_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="col-lg-12 col-form-label">Division</label>
                                                                            <div class="col-lg-12">
                                                                                <select class="select2 form-control"  data-placeholder="Select Division" name="div_id" id="div_id" style="width: 100%;">
                                                                                    <option value="0">Select Division</option>
                                                                 
                                                                                </select>
                                                                                <span class="formerror" id="div_id_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="col-lg-12 col-form-label">State:</label>
                                                                            <div class="col-lg-12">
                                                                                <select class="form-control select2" name="state_id" id="state_id" style="width: 100%;">
                                                                                    <option value="0">Select State</option>
                                                                 
                                                                                </select>
                                                                            </div>
                                                                            <span class="formerror" id="state_id_error"></span>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="col-lg-12 col-form-label">Branch</label>
                                                                            <div class="col-lg-12">
                                                                                <select class="form-control select2" name="branch_id" id="branch_id" style="width: 100%;">
                                                                                    <option value="0">Select Branch</option>                    
                                                                                </select>
                                                                                <span class="formerror" id="branch_id_error"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="col-lg-12 col-form-label">Employee Id</label>
                                                                            <div class="col-lg-12">
                                                                                <select class="form-control select2" name="employeeid" id="employeeid" style="width: 100%;"></select>
                                                                                <span class="formerror" id="employeeiderror"></span>
                                                                            </div>
                                                                        </div>
                                                                        <!--<div class="form-group row col-md-4">-->
                                                                        <!--    <label class="col-lg-12 col-form-label">Affect Date</label>-->
                                                                        <!--    <div class="col-lg-12">-->
                                                                        <!--        <input type="text" name="transfer_affect_date" id="transfer_affect_date" class="form-control datetimepicker" autocomplete="off">-->
                                                                        <!--        <span class="formerror" id="transfer_affect_date_error"></span>-->
                                                                        <!--    </div>-->
                                                                        <!--</div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- filter -->
                                                <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                                    <li class="nav-item"><a class="nav-link active" id="authorizationinformation" href="#solid-justified-transfer" data-toggle="tab">Transfers</a></li>
                                                    <li class="nav-item"><a class="nav-link" id="authorizationinformation" href="#solid-justified-auth" data-toggle="tab">Authorization</a></li>
                                                </ul>     
                                                <div class="tab-content">
                                                    <!--authorization-->
                                                    <div class="tab-pane" id="solid-justified-auth">
                                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Authorization</h4>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="row">
                                                                <!-------------LINE 1---->
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Authorization Type:</label>
                                                                        <select class="form-control auth_type" name="authorizationtype[]" id="authtype_1">
                                                                            <option value="">Select Auth Type</option>
                                                                            <option value="1">Branch</option>
                                                                            <option value="2">Head Office</option>
                                                                            <option value="3">HR</option>
                                                                            <option value="4">Director</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Department Name:</label>
                                                                        <!--<input type="text" class="form-control" name="authorizationdepartmentbr" id="authorizationdepartmentbr" autocomplete="off">-->
                                                                        <select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_1" style="width:100%">
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Employee Name:</label>
                                                                        <select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_1" autocomplete="off"></select>
                                                                    </div>
                                                                </div>

                                                                <!-------------END LINE 1--------->
                                                                <!-------------LINE 2--------->
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Authorization Type:</label>
                                                                        <select class="form-control auth_type" name="authorizationtype[]" id="authtype_2">
                                                                            <option value="">Select Auth Type</option>
                                                                            <option value="1">Branch</option>
                                                                            <option value="2">Head Office</option>
                                                                            <option value="3">HR</option>
                                                                            <option value="4">Director</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Department Name:</label>
                                                                        <!--<input type="text" class="form-control" name="authorizationdepartmenthr" id="authorizationdepartmenthr" autocomplete="off">-->
                                                                        <select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_2" style="width:100%">
                                                                            <!--<option value="">Type</option>-->
                                                                            <!--<option value="3">Hr</option>-->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Employee Name:</label>
                                                                        <select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_2" autocomplete="off"></select>
                                                                    </div>
                                                                </div>
                                                                <!-------------END LINE 2--------->
                                                                <!-------------LINE 3--------->

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Authorization Type:</label>
                                                                        <select class="form-control auth_type" name="authorizationtype[]" id="authtype_3">
                                                                            <option value="">Select Auth Type</option>
                                                                            <option value="1">Branch</option>
                                                                            <option value="2">Head Office</option>
                                                                            <option value="3">HR</option>
                                                                            <option value="4">Director</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Department Name:</label>
                                                                        <!--<input type="text" class="form-control" name="authorizationdepartmentdirector" id="authorizationdepartmentdirector" autocomplete="off">-->
                                                                        <select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_3" style="width:100%">
                                                                            <!--																<option value="">Type</option>
                                                                                                                                                                                                        <option value="3">Hr</option>-->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Employee Name:</label>
                                                                        <select type="text" class="form-control select2 emp_name" name="emp_name[]" style="width: 100%" id="empname_3" autocomplete="off"></select>
                                                                    </div>
                                                                </div>
                                                                <!-------------END LINE 3--------->
                                                                <!-------------LINE 4--------->
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Authorization Type:</label>
                                                                        <select class="form-control auth_type" name="authorizationtype[]" id="authtype_4">
                                                                            <option value="">Select Auth Type</option>
                                                                            <option value="1">Branch</option>
                                                                            <option value="2">Head Office</option>
                                                                            <option value="3">Hr</option>
                                                                            <option value="4">Director</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Department Name:</label>
                                                                        <!--<input type="text" class="form-control" name="authorizationdepartment[]" id="authorizationdepartment[]" autocomplete="off">-->
                                                                        <select class="form-control select2 auth_dept" name="auth_dept[]" id="authdept_4" style="width:100%">
                                                                            <!--<option value="">Type</option>-->
                                                                            <!--<option value="3">Hr</option>-->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Employee Name:</label>
                                                                        <select type="text" class="form-control select2 emp_name" style="width: 100%" name="emp_name[]" id="empname_4" autocomplete="off"> </select>
                                                                    </div>
                                                                </div>
                                                                <!-------------END LINE 4--------->
                                                                <div class="col-md-2"></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary">Transfer</button>
                                                        </div>
                                                    </div>
                                                    <!--authorization-->
                    
                                                    <!-- Transfer screen -->
                                                    <!--<form method="post" id="processtransfer">-->
                                                    <div class="tab-pane show active" id="solid-justified-transfer">
                                                    <div class="row" style="margin-top: 20px;">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title mb-0">Transfer From</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Company</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="cmpname_trnasfer_from" id="cmpname_trnasfer_from" style="width: 100%;">
                                                                                <option value="">-- Select Company --</option>
                                
                                                                            </select>
                                                                            <span class="formerror" id="cmpname_trnasfer_from_error"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Division</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="divname_trnasfer_from" id="divname_trnasfer_from" style="width: 100%;">
                                                                                <option value="">-- Select Division --</option>
                                
                                                                            </select>
                                                                            <span class="formerror" id="divname_trnasfer_from_error"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">State</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="cmpstate_trnasfer_from" id="cmpstate_trnasfer_from" style="width: 100%;">
                                                                                <option value="">Select State</option>
                                
                                                                            </select>
                                                                            <span class="formerror" id="cmpstate_trnasfer_from_error"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Branch</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="brname_trnasfer_from" id="brname_trnasfer_from" style="width: 100%;">
                                                                                <option value="">Select Branch</option>                                                    
                                                                            </select>
                                                                            <span class="formerror" id="brname_trnasfer_from_error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                    													<label class="col-lg-4 col-form-label">Departement</label>
                    													<div class="col-lg-8">
                    														<select class="form-control select2" name="deptname_trnasfer_from" id="deptname_trnasfer_from" style="width:100%">
                    														    <option value="">Select Departement</option>
                    														</select>
                    														<span class="formerror" id="deptname_trnasfer_from_error"></span>
                    													</div>
                    												</div>
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Relieving Date</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" class="form-control datetimepicker" name="emprelievingdate" id="emprelievingdate" autocomplete="off">
                                                                            <span class="formerror" id="emprelievingdateerror"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">ESI Relieving Date</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" class="form-control datetimepicker" name="esi_relievingdate" id="esi_relievingdate" autocomplete="off">
                                                                            <span class="formerror" id="esi_relievingdate_error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label class="col-lg-4 col-form-label">Remarks</label>
                                                                            <div class="col-lg-8">
                                                                                <input type="text" class="form-control" name="remarks" id="remarks" autocomplete="off">
                                                                                <span class="formerror" id="remarks_error"></span>
                                                                            </div>
                                                                    </div>
                                                                    
                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title mb-0">Transfer To</h4>
                                                                </div>
                                                                <div class="card-body">
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Division</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="divname_trnasfer_to" id="divname_trnasfer_to" style="width: 100%;">
                                                                                <option value="">-- Select Division --</option>
                                                                                <?php foreach ($divisiondetails as $keys => $div_value) { ?>
                                                                                    <option value="<?php echo $div_value->mxd_id . '@~@' . $div_value->mxd_name  ?>"><?php echo $div_value->mxd_name ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            <span class="formerror" id="divname_trnasfer_to_error"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">State</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="cmpstate_trnasfer_to" id="cmpstate_trnasfer_to" style="width: 100%;">
                                                                                <option value="">Select State</option>
                                                                                <?php // foreach ($states as $key => $stvalue) { ?>
                                                                                    <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state  ?>"><?php // echo $stvalue->mxst_state  ?></option>-->
                                                                                <?php // } ?>
                                                                            </select>
                                                                            <span class="formerror" id="emptransferstateerror"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Branch</label>
                                                                        <div class="col-lg-8">
                                                                            <select class="form-control select2" name="brname_trnasfer_to" id="brname_trnasfer_to" style="width: 100%;">
                                                                                <option value="">Select Branch</option>
                                                                                <?php // foreach ($branchmaster as $keybr => $brvalue) { ?>
                                                                                    <!--<option value="<?php // echo $brvalue->mxb_id  ?>"><?php // echo $brvalue->mxb_name  ?></option>-->
                                                                                <?php // } ?>															
                                                                            </select>
                                                                            <span class="formerror" id="brname_trnasfer_to_error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                    													<label class="col-lg-4 col-form-label">Departement</label>
                    													<div class="col-lg-8">
                    														<select class="form-control select2" name="deptname_trnasfer_to" id="deptname_trnasfer_to" style="width:100%">
                    														    <option value="">Select Departement</option>
                    														</select>
                    														<span class="formerror" id="deptname_trnasfer_to_error"></span>
                    													</div>
                    												</div>
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">Joining Date</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" class="form-control datetimepicker" name="empjoiningdate" id="empjoiningdate" autocomplete="off">
                                                                            <span class="formerror" id="empjoiningdateerror"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-lg-4 col-form-label">ESI Joining Date</label>
                                                                        <div class="col-lg-8">
                                                                            <input type="text" class="form-control datetimepicker" name="esi_joiningdate" id="esi_joiningdate" autocomplete="off">
                                                                            <span class="formerror" id="esi_joiningdate_error"></span>
                                                                        </div>
                                                                    </div>
                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- Transfer screen -->
                                                </div>
                                                <!--</form>-->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php // print_r($bns_statutory);
                ?>
                <!-- Data Tables -->
                <div class="row" style="margin-top: 10px;" id="arear_inc_table">
                    <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">INCOME LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0 dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Employee Name</th>
                                            <th>Type</th>
                                            <th>From Company</th>
                                            <th>To Company</th>
                                            <th>From Division</th>
                                            <th>To Division</th>
                                            <th>From State</th>
                                            <th>To State</th>
                                            <th>From Branch</th>
                                            <th>To Branch</th>
                                            <th>From Dept</th>
                                            <th>To Dept</th>
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
                                    	<?php $sno = 1; foreach ($emp_transfers['employeetransfers'] as $keyemptrf => $valueemptrf) { ?>

                                            <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $valueemptrf->mxemp_emp_fname." ".$valueemptrf->mxemp_emp_lname ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_type ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_comp_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_comp_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_div_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_div_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_state_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_state_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_branch_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_branch_name_to ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_dept_name_from ?></td>
                                            <td><?php echo $valueemptrf->mxemp_trs_dept_name_to ?></td>
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
                <!-- Data Tables -->
                <!-- Delete Bonus Statutory Modal -->
                <div class="modal custom-modal fade" id="bns_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="bns_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="bns_id_hidden" id="del_bns_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_bns">Delete</a>
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
                <!-- /Delete Bonus STATUTORY Modal -->



            </div>
            <!--END TRANSFER Tab -->
            


        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<script>
    var page_type = 1;
</script>

<!-- Mask JS -->
<script src="<?php echo base_url() ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/mask.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/promotion_increament.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/special_increaments.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/arear_increaments.js"></script>
<script src="<?php echo base_url(); ?>assets/js/formsjs/emp_transfers.js"></script>
