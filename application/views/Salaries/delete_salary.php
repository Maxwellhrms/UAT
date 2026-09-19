<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Delete Employee Salary</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Salary Generate</a></li>
                        <li class="breadcrumb-item active">Delete Salary</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        

        <div class="tab-content">

            
            <div id="promotons_tab" class="tab-pane fade show active">
                
                <div id="promotionaddnew" class="collapse show">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">DELETE SALARY DETAILS</h4>
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
                                                                                <label class="col-lg-12 col-form-label">MonthYear</label>
                                                                                <div class="col-lg-12">
                                                                                    <input class="form-control yearmonth" placeholder="Month-Year" name="yearmonth" id="yearmonth" autocomplete="off">
                                                                                    <span class="formerror" id="yearmontherror"></span>
                                                                                </div>
                                                                            </div>
                                
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
                                                                                <label class="col-lg-12 col-form-label">Employee Type</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="form-control select2" name="emptype" id="emptype" style="width: 100%;"></select>
                                                                                    <span class="formerror" id="emptype_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label">Employee Id</label>
                                                                                <div class="col-lg-12">
                                                                                    <select class="form-control select2" name="promotion_employeeid" id="promotion_employeeid" style="width: 100%;"></select>
                                                                                    <span class="formerror" id="promotion_employeeid_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="col-lg-12 col-form-label"></label>
                                                                                <div class="col-lg-12">
                                                                                    <button type="button" id="delete_sal" class="btn btn-primary">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                <div class="row" style="margin-top: 10px;" id="table_div">
                    <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">PAYSHEET LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
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
                                            <th>From Grade Name</th>
                                            <th>To Cmp Name</th>
                                            <th>To Div Name</th>
                                            <th>To State Name</th>
                                            <th>To Branch Name</th>
                                            <th>To Desig Name</th>
                                            <th>To Grade Name</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/delete_salary.js"></script>

