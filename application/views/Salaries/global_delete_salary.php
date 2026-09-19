<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Global Salary Deletion</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Global Delete</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">WIPE MONTHLY SALARY DATA (ALL EMPLOYEE TYPES)</h4>
                        <p class="text-danger mt-2"><strong>Warning:</strong> This action will delete salary records and reverse loan EMI logs for all employees in the company and period.</p>
                    </div>
                    <div class="card-body">
                        <form id="global_delete_form" method="POST">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Month-Year <span class="text-danger">*</span></label>
                                    <input class="form-control yearmonth" placeholder="MM-YYYY" name="global_yearmonth" id="global_yearmonth" autocomplete="off">
                                    <span class="text-danger error-msg" id="global_yearmonth_error"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="col-form-label">Company <span class="text-danger">*</span></label>
                                    <select class="select2 form-control" data-placeholder="Select Company" name="global_company_id" id="global_company_id" style="width: 100%;">
                                        <option value="0">Select Company</option>
                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger error-msg" id="global_company_id_error"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="col-form-label">&nbsp;</label>
                                    <div class="d-flex">
                                        <button type="button" id="btn_global_delete" class="btn btn-danger mr-2">
                                            <i class="fa fa-trash"></i> Global Delete
                                        </button>
                                        <button type="button" id="btn_global_reset" class="btn btn-secondary">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/mask.js"></script>
<script src="<?php echo base_url(); ?>assets/js/formsjs/global_delete_salary.js"></script>