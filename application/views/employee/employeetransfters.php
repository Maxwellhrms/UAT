<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Employee Transfers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transfer</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
<form method="post" id="processtransfer">
        <div class="row">
            

                <div class="col-md-12">
                    <div class="card mb-0">
                    </div>
                    <div class="card-body">
                        <!-- filter -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">                                    
                                    <div class="card-body">                                        
                                        <div class="row">
                                                <div class="form-group">
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
                                                <div class="form-group">
                                                    <label class="col-lg-12 col-form-label">Division</label>
                                                    <div class="col-lg-12">
                                                        <select class="select2 form-control"  data-placeholder="Select Division" name="div_id" id="div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                         
                                                        </select>
                                                        <span class="formerror" id="div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-12 col-form-label">State:</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2" name="state_id" id="state_id" style="width: 100%;">
                                                            <option value="0">Select State</option>
                                         
                                                        </select>
                                                    </div>
                                                    <span class="formerror" id="state_id_error"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-12 col-form-label">Branch</label>
                                                    <div class="col-lg-12">
                                                        <select class="form-control select2" name="branch_id" id="branch_id" style="width: 100%;">
                                                            <option value="0">Select Branch</option>                    
                                                        </select>
                                                        <span class="formerror" id="branch_id_error"></span>
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 col-form-label">Employee Id</label>
                                                <div class="col-lg-12">
                                                    <select class="form-control select2" name="employeeid" id="employeeid" style="width: 100%;"></select>
                                                    <span class="formerror" id="employeeiderror"></span>
                                                </div>

                                            </div>
<!--                                            <div class="form-group">
                                                <label class="col-lg-12 col-form-label">Emp Name</label>
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" name="emp_name" id="emp_name" readonly>

                                                </div>
                                            </div>-->
                                        </div>
<!--                                        <div class="form-group">
                                            <label class="col-lg-12 col-form-label">Remarks</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" name="remarks" id="remarks" autocomplete="off">
                                                <span class="formerror" id="remarks_error"></span>
                                            </div>
                                        </div>-->
                                    </div>

<!--                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <div class="text-right">
                                                <button type="button" id="search_emp_id_btn" class="btn btn-primary">Search Emp</button>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!--</form>-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- filter -->
                            <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                <li class="nav-item"><a class="nav-link active" id="authorizationinformation" href="#solid-justified-tab9" data-toggle="tab">Transfers</a></li>
                                <li class="nav-item"><a class="nav-link" id="authorizationinformation" href="#solid-justified-tab8" data-toggle="tab">Authorization</a></li>
                            </ul>     
               
                    <!--authorization-->
<div class="tab-content">
<div class="tab-pane" id="solid-justified-tab8">
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
                    <div class="tab-pane show active" id="solid-justified-tab9">
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
                                            <select class="form-control select2" name="cmpname_trnasfer_from" id="cmpname_trnasfer_from">
                                                <option value="">-- Select Company --</option>

                                            </select>
                                            <span class="formerror" id="cmpname_trnasfer_from_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label">Division</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="divname_trnasfer_from" id="divname_trnasfer_from">
                                                <option value="">-- Select Division --</option>

                                            </select>
                                            <span class="formerror" id="divname_trnasfer_from_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label">State</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="cmpstate_trnasfer_from" id="cmpstate_trnasfer_from">
                                                <option value="">Select State</option>

                                            </select>
                                            <span class="formerror" id="cmpstate_trnasfer_from_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label">Branch</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="brname_trnasfer_from" id="brname_trnasfer_from">
                                                <option value="">Select Branch</option>                                                    
                                            </select>
                                            <span class="formerror" id="brname_trnasfer_from_error"></span>
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
                                            <select class="form-control select2" name="divname_trnasfer_to" id="divname_trnasfer_to">
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
                                            <select class="form-control select2" name="cmpstate_trnasfer_to" id="cmpstate_trnasfer_to">
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
                                            <select class="form-control select2" name="brname_trnasfer_to" id="brname_trnasfer_to">
                                                <option value="">Select Branch</option>
                                                <?php // foreach ($branchmaster as $keybr => $brvalue) { ?>
                                                    <!--<option value="<?php // echo $brvalue->mxb_id  ?>"><?php // echo $brvalue->mxb_name  ?></option>-->
                                                <?php // } ?>															
                                            </select>
                                            <span class="formerror" id="brname_trnasfer_to_error"></span>
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
                </div>
                    <!--</form>-->
                    <!-- Transfer screen -->
                </div>
            
        </div>
</form>
    </div>
</div>



</div>			
</div>

<!-- /Main Wrapper -->
<script src="<?php echo base_url(); ?>assets/js/formsjs/emp_transfers.js"></script>



