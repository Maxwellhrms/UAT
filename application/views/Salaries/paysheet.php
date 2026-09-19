<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Paysheet</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Paysheet</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

    </div>
    <div class="tab-content content">
        <!-- Incentives -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Paysheet</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="#" id="incentive_type_form">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input class="form-control yearmonth" placeholder="Month-Year" name="yearmonth" id="yearmonth" autocomplete="off">
                                            <span class="formerror" id="yearmontherror"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="esi_company_id" id="esi_company_id">
                                            <option value=""> Select Company </option>
                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="focus-label">Select Company</label>
                                    </div>
                                    <span class="formerror" id="cmpnameerror"></span>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="esi_div_id" id="esi_div_id">
                                            <option value="">Select Division</option>
                                        </select>
                                        <label class="focus-label">Select Division</label>
                                    </div>
                                    <span class="formerror" id="esi_div_id_error"></span>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="esi_state_id" id="esi_state_id">
                                            <option value="">Select State</option>
                                        </select>
                                        <label class="focus-label">Select State</label>
                                    </div>
                                    <span class="formerror" id="esi_state_id_error"></span>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="esi_branch_id" id="esi_branch_id">
                                            <option value="">Select Branch</option>
                                        </select>
                                        <label class="focus-label">Select Branch</label>
                                    </div>
                                    <span class="formerror" id="esi_branch_id_error"></span>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="emptype" id="emptype">
                                            <option value="">Select Employee Type</option>
                                            <?php
                                            foreach ($emptypedetails as $emp_type) {
                                                echo "<option value=" . $emp_type->mxemp_ty_id . ">" . $emp_type->mxemp_ty_name . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label class="focus-label">Select Employee Type</label>
                                    </div>
                                    <span class="formerror" id="emptypeerror"></span>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group form-focus select-focus">
                                        <select class="select select2" style="width: 100%" name="saltype" id="saltype">
                                            <option value="" selected>ALL</option>
                                            <option value="1">PAID</option>
                                            <option value="0">UNPAID</option>
                                        </select>
                                        <label class="focus-label">Select Salary Type</label>
                                    </div>
                                    <span class="formerror" id="emptypeerror"></span>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group row">
										<div class="col-lg-9">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="paysheet" value="paysheet" checked="">
												<label class="form-check-label">
												Paysheet
												</label>
											</div>
											<br>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="paysheet" value="supplementary_paysheet">
												<label class="form-check-label">
											    Supplementary Paysheet
												</label>
											</div>
											<br>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="paysheet" value="payslip">
												<label class="form-check-label">
											    Payslip
												</label>
											</div>
										</div>
									</div>
                                </div>																		

                            </div>
                            <div class="text-right">
                                <button type="button" onclick="processpaysheet()" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div id="table_div">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="emp_display_info" class="font-weight-bold text-muted"></p>
                    <input type="hidden" id="edit_mxsal_id">
                    <input type="hidden" id="edit_emp_type"> <div class="form-group">
                        <label>Payment Status</label>
                        <select id="new_pay_status" class="form-control">
                            <option value="1">PAID</option>
                            <option value="0">UNPAID</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updateStatusBtn" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Data -->

    <!-- Incentives -->

</div>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/paysheet.js"></script>