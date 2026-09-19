<style>
    .dt-buttons {
        margin-left: 10px !important;
        float: left !important;
    }
    .dataTables_length {
        float: left !important;
    }
    .filter-btn-group {
        display: flex;
        gap: 10px;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Wage Master Configuration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Wage Master</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <?php if($this->session->userdata('user_role_add') == 1){ ?>
                        <button type="button" class="btn add-btn" data-toggle="collapse" data-target="#wage_form_panel"><i class="fa fa-plus"></i> Register New Wage Config</button>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <div id="wage_form_panel" class="collapse">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Wage Configuration Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="processwagedetails">
                            <input type="hidden" name="mxwm_id" id="mxwm_id">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Company</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="company_id" id="company_id">
                                                <option value="">-- Select Company --</option>
                                                <?php foreach ($cmpmaster as $cmp) { ?>
                                                    <option value="<?php echo $cmp->mxcp_id ?>"><?php echo $cmp->mxcp_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="company_id_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Division</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="division_id" id="division_id">
                                                <option value="">-- Select Division --</option>
                                                <?php foreach ($divmaster as $div) { ?>
                                                    <option value="<?php echo $div->mxd_id ?>"><?php echo $div->mxd_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="division_id_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">State</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="state_id" id="state_id">
                                                <option value="">-- Select State --</option>
                                                <?php foreach ($states as $st) { ?>
                                                    <option value="<?php echo $st->mxst_id ?>"><?php echo $st->mxst_state ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="state_id_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Branch</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="branch_id" id="branch_id">
                                                <option value="">-- Select Branch (Select State First) --</option>
                                            </select>
                                            <span class="formerror" id="branch_id_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Zone</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="zone" id="zone">
                                                <option value="">Select Zone</option>
                                                <option value="1">Zone 1</option>
                                                <option value="2">Zone 2</option>
                                            </select>
                                            <span class="formerror" id="zone_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">State Min Wage (%)</label>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" name="state_wage" id="state_wage" placeholder="0.00">
                                            <span class="formerror" id="state_wage_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">National Floor Wage (%)</label>
                                        <div class="col-lg-8">
                                            <input type="number" step="0.01" class="form-control" name="national_wage" id="national_wage" placeholder="0.00">
                                            <span class="formerror" id="national_wage_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">WEF Date</label>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" name="wef_date" id="wef_date">
                                            <span class="formerror" id="wef_date_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Valid Till</label>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" name="valid_till" id="valid_till">
                                            <span class="formerror" id="valid_till_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Status</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="mxwm_status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span class="formerror" id="status_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="reset" class="btn btn-secondary">Reset Fields</button>
                                <button type="submit" class="btn btn-primary" id="submit_btn">Submit Wage Config</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php  } ?>

        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="form-control select2" id="filter_status">
                        <option value="">-- All Status --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <label class="focus-label">Status</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="date" class="form-control" id="filter_date_from">
                    <label class="focus-label">From Date (WEF)</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="date" class="form-control" id="filter_date_till">
                    <label class="focus-label">To Date (Till)</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="filter-btn-group">
                    <button type="button" id="btn_search" class="btn btn-success btn-block" style="margin-top:0;"> SEARCH </button>
                    <button type="button" id="btn_reset_filter" class="btn btn-light btn-block" style="margin-top:0;"> RESET </button>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Wage Configuration History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-nowrap custom-table mb-0" id="wage_table">
                                <thead>
                                <tr>
                                    <th>State</th>
                                    <th>Branch</th>
                                    <th>Zone</th>
                                    <th>State Wage</th>
                                    <th>National Wage</th>
                                    <th>WEF Date</th>
                                    <th>Valid Till</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($wagedetails)) {
                                    foreach ($wagedetails as $wage) { ?>
                                        <tr>
                                            <td><?php echo $wage->mxst_state; ?></td>
                                            <td><?php echo $wage->mxb_name; ?></td>
                                            <td>Zone <?php echo $wage->mxwm_zone; ?></td>
                                            <td><?php echo number_format($wage->mxwm_state_min_wage, 0); ?></td>
                                            <td><?php echo number_format($wage->mxwm_national_floor_wage, 0); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($wage->mxwm_wef_date)); ?></td>
                                            <td>
                                                <?php echo ($wage->mxwm_valid_till) ? date('d-m-Y', strtotime($wage->mxwm_valid_till)) : 'Ongoing'; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($wage->mxwm_status == 1) {
                                                    echo '<span class="badge badge-pill badge-success">Active</span>';
                                                } elseif ($wage->mxwm_status == 0) {
                                                    echo '<span class="badge badge-pill badge-warning">Inactive</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if ($this->session->userdata('user_role_edit') == 1) { ?>
                                                            <a class="dropdown-item editwagemaster" href="javascript:void(0);"
                                                               data-id="<?php echo $wage->mxwm_id; ?>"
                                                               data-cmp="<?php echo $wage->mxwm_cmp_id; ?>"
                                                               data-div="<?php echo $wage->mxwm_div_id; ?>"
                                                               data-state="<?php echo $wage->mxwm_state_id; ?>"
                                                               data-br="<?php echo $wage->mxwm_branch_id; ?>"
                                                               data-zone="<?php echo $wage->mxwm_zone; ?>"
                                                               data-swage="<?php echo $wage->mxwm_state_min_wage; ?>"
                                                               data-nwage="<?php echo $wage->mxwm_national_floor_wage; ?>"
                                                               data-wef="<?php echo $wage->mxwm_wef_date; ?>"
                                                               data-till="<?php echo $wage->mxwm_valid_till; ?>"
                                                               data-status="<?php echo $wage->mxwm_status; ?>">
                                                                <i class="fa fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                        <?php } ?>

                                                        <?php if ($this->session->userdata('user_role_delete') == 1) { ?>
                                                            <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete"
                                                               data-id="<?php echo $wage->mxwm_id . '~' . $wage->mxb_name; ?>">
                                                                <i class="fa fa-trash-o m-r-5"></i> Delete
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Wage Configuration</h3>
                    <p>Are you sure you want to delete the configuration for <span id="delbrname" style="font-weight:bold;"></span>?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <input type="hidden" id="delbrid">
                        <div class="col-6">
                            <a href="javascript:void(0);" id="processdeletedata" class="btn btn-primary continue-btn">Delete</a>
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

<script src="<?php echo base_url() ?>assets/js/formsjs/wage.js"></script>