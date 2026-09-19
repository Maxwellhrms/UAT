<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Create Your Salary</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Salary</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Salary Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="sal_assign_form">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Company Name</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="cmpname" id="cmpname">
                                                <option value="">-- Select Company --</option>
                                                <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                    <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="cmpnameerror"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Employeement Type</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="emptype" id="emptype">
                                                <option value="">-- Select Emp Type --</option>

                                            </select>
                                            <span class="formerror" id="emptype_error"></span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Year & Month</label>
                                        
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control datepicker_M_Y" name="sal_month_year" id="sal_month_year" autocomplete="off">
                                        </div>
                                        <span class="formerror" id="sal_month_year_error"></span>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Employees</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="unpaid_empids[]" id="unpaid_empids" multiple style="width:100%">
                                                <option value="">-- Select Unpaid Employees --</option>

                                            </select>
                                            <span class="formerror" id="emptype_error"></span>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <div class="text-right">
                                <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                                <button type="submit" id="salary_submit_btn" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>
<!-- /Main Wrapper -->
<!-- Delete salary Modal -->
<div class="modal custom-modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete salary</h3>
                    <h3 style="color: red" id="deldpname"></h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <input type="hidden" name="deletemainid" id="deldpid">
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
<!-- /Delete salary Modal -->
<script>
    var dp = 1;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/salary_assign.js"></script>