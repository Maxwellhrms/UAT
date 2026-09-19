<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create Income & Deduction</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Income & Deduction</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#income_tab" data-toggle="tab" class="nav-link active" id="income_li">Income</a></li>
                        <li class="nav-item"><a href="#deduction_tab" data-toggle="tab" class="nav-link" id="deduction_li">Deduction</a></li>
                        <li class="nav-item"><a href="#pay_tab" data-toggle="tab" class="nav-link" id="pay_li">Pay Structure</a></li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="tab-content">

        <!-- INCOME Tab -->
        <div id="income_tab" class="pro-overview tab-pane fade show active">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#incomeaddnew">Add New</button>
            <div id="incomeaddnew" class="collapse">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ENTER INCOME TYPE</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="income_type_form">
                                    <div class="row">
                                        <div class="col-xl-4">


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="income_cmp_id" id="income_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="income_cmp_id_error"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Emp Type</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="income_emp_type_id" id="income_emp_type_id" style="width: 100%;">
                                                        <option value="0">Select Emp Type</option>
                                                        <?php
                                                        // foreach ($emptypedetails as $emp_type) {
                                                        // echo "<option value=" . $emp_type->mxemp_ty_id . ">" . $emp_type->mxemp_ty_name . "</option>";
                                                        // }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="income_emp_type_id_error"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Income Type</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="income_name" id="income_name" class="form-control m-b-20">
                                                    <span class="formerror" id="income_name_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_earning" value="1">
                                                <label class="form-check-label">
                                                    Is Earnings
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_ctc" value="1">
                                                <label class="form-check-label">
                                                    Is CTC
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_variablepay" value="1">
                                                <label class="form-check-label">
                                                    Is Variable Pay
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_basic" value="1">
                                                <label class="form-check-label">
                                                    Is Basic
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_hra" value="1">
                                                <label class="form-check-label">
                                                    Is HRA
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_tsp" value="1">
                                                <label class="form-check-label">
                                                    Is Trainees Staipand
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_prof_charges" value="1">
                                                <label class="form-check-label">
                                                    Is Professional Charges
                                                </label>
                                            </div>
                                            <span class="formerror" id="variablepay_error"></span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="inc_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Data Tables -->
            <div class="row" style="margin-top: 10px;">
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
                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Company Name</th>
                                            <th>Emp Type Name</th>
                                            <th>Income Name</th>
                                            <th>Income Type</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($income_types as $inc_type) {
                                            echo '<tr>';
                                            echo '<td>' . $sno . '</td>';
                                            echo '<td>' . $inc_type->mxcp_name . '</td>';
                                            echo '<td>' . $inc_type->mxemp_ty_name . '</td>';
                                            echo '<td>' . $inc_type->mxincm_name . '</td>';
                                            if ($inc_type->mxincm_is_ctc == 1) {
                                                $inc_type_data = "CTC";
                                            } else {
                                                $inc_type_data = "EARNING";
                                            }
                                            echo '<td>' . $inc_type_data  . '</td>';
                                            echo '<td>';
                                            echo '<div class="dropdown dropdown-action">';
                                            echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            echo '<div class="dropdown-menu dropdown-menu-right">';
                                            
                                            if($this->session->userdata('user_role_edit') == 1){
                                            echo '<a class="dropdown-item" href="' . base_url() . 'admin/income_type_edit/' . $inc_type->mxincm_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if($this->session->userdata('user_role_delete') == 1){ 
                                            echo '<a class="dropdown-item deletemodal income_delete" data-toggle="modal" data-target="#income_del_tab" data-id="' . $inc_type->mxincm_id . '~' . $inc_type->mxcp_name . '~' . $inc_type->mxincm_name . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            } 
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';

                                            $sno++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data Tables -->

            <!-- Delete PF Statutory Modal -->
            <div class="modal custom-modal fade" id="income_del_tab" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Company</h3>
                                <h3 style="color: red" id="inc_del_comp"></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <input type="hidden" name="inc_id_hidden" id="inc_id_hidden">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_income">Delete</a>
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
            <!-- /Delete Income Modal -->


        </div>
        <!-- /Income Tab -->
        <!-- DEDUCTION Tab -->
        <div id="deduction_tab" class="pro-overview tab-pane fade">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#deductionaddnew">Add New</button>
            <div id="deductionaddnew" class="collapse">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ENTER DEDUCTION TYPE</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="deduction_type_form">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="deduction_cmp_id" id="deduction_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="formerror" id="deduction_cmp_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Emp Type</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="deduction_emp_type_id" id="deduction_emp_type_id" style="width: 100%;">
                                                        <option value="0">Select Emp Type</option>
                                                        <?php
                                                        // foreach ($emptypedetails as $emp_type) {
                                                        //     echo "<option value=" . $emp_type->mxemp_ty_id . ">" . $emp_type->mxemp_ty_name . "</option>";
                                                        // }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="deduction_emp_type_id_error"></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Deduction Type</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="deduction_name" id="deduction_name" class="form-control m-b-20">
                                                    <span class="formerror" id="deduction_name_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input ded_type" type="checkbox" name="ded_is_tds" value="1">
                                                <label class="form-check-label">
                                                    Is TDS
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="esi_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Data Tables -->
            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">DEDUCTION LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Company Name</th>
                                            <th>Emp Type Name</th>
                                            <th>Deduction Name</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($deduction_types as $ded_type) {
                                            echo '<tr>';
                                            echo '<td>' . $sno . '</td>';
                                            echo '<td>' . $ded_type->mxcp_name . '</td>';
                                            echo '<td>' . $ded_type->mxemp_ty_name . '</td>';
                                            echo '<td>' . $ded_type->mxded_name . '</td>';
                                            echo '<td>';
                                            echo '<div class="dropdown dropdown-action">';
                                            echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            echo '<div class="dropdown-menu dropdown-menu-right">';
                                            if($this->session->userdata('user_role_edit') == 1){
                                            echo '<a class="dropdown-item" href="' . base_url() . 'admin/deduction_type_edit/' . $ded_type->mxded_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if($this->session->userdata('user_role_delete') == 1){
                                            echo '<a class="dropdown-item deletemodal deduction_del" data-toggle="modal" data-target="#deduction_delete_tab" data-id="' . $ded_type->mxded_id . '~' . $ded_type->mxcp_name . '~' . $ded_type->mxded_name . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            }
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';

                                            $sno++;
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data Tables -->

            <!-- Deduction -->
            <div class="modal custom-modal fade" id="deduction_delete_tab" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Company</h3>
                                <h3 style="color: red" id="ded_del_comp"></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <input type="hidden" name="ded_id_hidden" id="ded_id_hidden">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_deduction">Delete</a>
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
            <!-- /Delete Deduction  -->


        </div>
        <!-- /Deduction Tab -->
        <!-- Pay Structure -->
        <div id="pay_tab" class="pro-overview tab-pane fade">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#paystructure_addnew">Add New</button>
            <div id="paystructure_addnew" class="collapse">
                <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Salary Components</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" id="pay_structure_form">
                                <div class="row">
                                    <div class="col-xl-4">


                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Affected Date</label>
                                            <div class="col-lg-8">
                                                <input class="form-control yearmonth" name="pay_str_affect_date" id="pay_str_affect_date" autocomplete="off">
                                                <span class="formerror" id="pay_str_affect_date_error"></span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Company</label>
                                            <div class="col-lg-8">
                                                <select class="select2 form-control" data-placeholder="Select Company" name="pay_str_cmpid" id="pay_str_cmpid" style="width: 100%;">
                                                    <option value="0" data-cmp_id=0>Select Company</option>
                                                    <?php
                                                    foreach ($cmpmaster as $companies) {
                                                        echo "<option value=" . $companies->mxcp_id . "~" . $companies->mxcp_name . " data-cmp_id=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <span class="formerror" id="pay_str_cmpid_error"></span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Emp Type</label>
                                            <div class="col-lg-8">
                                                <select class="select2 form-control" data-placeholder="Select Emp Type" name="emp_type_name" id="emp_type_name" style="width: 100%;">
                                                    <option value="0" data-emp_type_id="0">Select Emp Type</option>
                                                    <?php
                                                    // foreach ($emptypedetails as $emp_type) {
                                                    //     echo"<option value=" . $emp_type->mxemp_ty_id . ">" . $emp_type->mxemp_ty_name . "</option>";
                                                    // }
                                                    ?>
                                                </select>
                                                <span class="formerror" id="emp_type_name_error"></span>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- Main Data -->


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-0">

                                            <div class="card-body">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <h4 class="card-title">Employer Contribution
                                                                <div class="col-auto float-right ml-auto employer_cont_add_more">
                                                                    <a href="#" class="btn add-btn"><i class="fa fa-plus"></i> Add More</a>
                                                                </div>
                                                            </h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped custom-table table-nowrap mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Income Head</th>
                                                                            <th>Percent %</th>
                                                                            <th>VH</th>
                                                                            <th>PF</th>
                                                                            <th>ESI</th>
                                                                            <th>PT</th>
                                                                            <th>BONUS</th>
                                                                            <th>LWF</th>
                                                                            <th>GRATITUTY</th>
                                                                            <th>LTA</th>
                                                                            <th>MEDICLAIM</th>
                                                                            <!--<th>STAIPEND</th>-->
                                                                            <!-- <th>STATUS</th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="employer_cont_tbody">
                                                                        <tr id="employer_tr_1">
                                                                            <td>
                                                                                <select class="select2 form-control employer_inc_head" name="employer_inc_head_1" id="employer_inc_head_1" style="width: 100%;">
                                                                                    <option value="">Select Income Head</option>
                                                                                </select>
                                                                                <input type="hidden" name="employer_hid[]" value="1">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form- control numbersonly_with_dot employer_perc" name="employer_perc_1" id="employer_perc_1" class="employer_perc">
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_vh_1" id="employer_vh_1" class="employer_vh">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_pf_1" id="employer_pf_1" class="employer_pf">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_esi_1" id="employer_esi_1" class="employer_esi">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_pt_1" id="employer_pt_1" class="employer_pt">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_bns_1" id="employer_bns_1" class="employer_bns">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_lwf_1" id="employer_lwf_1" class="employer_lwf">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_gratuity_1" id="employer_gratuity_1" class="employer_gratuity">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_lta_1" id="employer_lta_1" class="employer_lta">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_mediclaim_1" id="employer_mediclaim_1" class="employer_mediclaim">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <!--<td>-->
                                                                            <!--    <div class="checkbox" align="center">-->
                                                                            <!--        <label>-->
                                                                            <!--            <input type="checkbox" name="employer_staipend_1" id="employer_staipend_1" class="employer_staipend">-->
                                                                            <!--        </label>-->
                                                                            <!--    </div>-->
                                                                            <!--</td>-->
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-xl-6"> -->
                                                            <!-- <h4 class="card-title">Employee Contribution
                                                                <div class="col-auto float-right ml-auto employee_cont_add_more">
                                                                    <a href="#" class="btn add-btn"><i class="fa fa-plus"></i> Add More</a>
                                                                </div>
                                                            </h4> -->

                                                            <!-- <div class="table-responsive">
                                                                <table class="table table-striped custom-table table-nowrap mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Income Head</th>
                                                                            <th>Percent %</th>
                                                                            <th>VH</th>
                                                                            <th>PF</th>
                                                                            <th>ESI</th>
                                                                            <th>PT</th>
                                                                            <th>BONUS</th>
                                                                            <th>LWF</th>
                                                                            <th>GRATITUTY</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="employee_cont_tbody">
                                                                        <tr>
                                                                            <td>
                                                                                <select class="select2 form-control" style="width: 100%;" id="employee_inc_head_1" class="employee_inc_head" name="employee_inc_head_1">
                                                                                    <option value="">Select Income Head</option>
                                                                                </select>
                                                                            </td>
                                                                            <input type="hidden" name="employee_hid[]" value="1">
                                                                            <td>
                                                                                <input class="form-control" type="text" name="employee_perc_1" id="employee_perc_1" class="employee_perc">
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_vh_1" id="employee_vh_1" class="employee_vh">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_pf_1" id="employee_pf_1" class="employee_pf">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_esi_1" id="employee_esi_1" class="employee_esi">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_pt_1" id="employee_pt_1" class="employee_pt">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_bns_1" id="employee_bns_1" class="employee_bns">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_lwf_1" id="employee_lwf_1" class="employee_lwf">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employee_gratituty_1" id="employee_gratituty_1" class="employee_gratituty">
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div> -->
                                                        <!-- </div> -->
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Main Data -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php } ?>
            <!-- Data Tables -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">PayStructure List</h4>
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
                                                <th>Company Name</th>
                                                <th>Employement Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Pay Structure Data</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            if(count($pay_structure) > 0){
                                                if($pay_structure[0]->mxps_id != ""){
                                                    foreach ($pay_structure as $pay_struc) {
                                                        // print_r($pay_struc);exit;
                                                        
                                                        echo '<tr>';
                                                        echo '<td>' . $sno . '</td>';
                                                        echo '<td>' . $pay_struc->mxcp_name . '</td>';
                                                        echo '<td>' . $pay_struc->mxemp_ty_name . '</td>';
                                                        echo '<td>' . date('d/m/Y', strtotime($pay_struc->mxps_affect_from)) . '</td>';
                                                        echo '<td>' . date('d/m/Y', strtotime($pay_struc->mxps_affect_to)) . '</td>';
                                                        echo '<td>' . $pay_struc->concatinated_data . '</td>';
                                                        echo '<td>';
                                                        echo '<div class="dropdown dropdown-action">';
                                                        echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                        echo '<div class="dropdown-menu dropdown-menu-right">';
                                                        if($this->session->userdata('user_role_edit') == 1){
                                                        echo '<a class="dropdown-item" href="' . base_url() . 'admin/pay_structure_edit/' . $pay_struc->mxps_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                        }
                                                        if($this->session->userdata('user_role_delete') == 1){
                                                        echo '<a class="dropdown-item deletemodal pay_struc_delete" data-toggle="modal" data-target="#pay_structure_delete" data-id="' . $pay_struc->mxps_id . '~' . $pay_struc->mxcp_name . '~' . date('d/m/Y', strtotime($pay_struc->mxps_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                        }
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</td>';
                                                        echo '</tr>';
        
                                                        $sno++;
                                                    }
                                               }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Tables -->

                <!-- Delete PF Statutory Modal -->
                <div class="modal custom-modal fade" id="pay_structure_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="pay_stru_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="pay_stru_id_hidden" id="del_pay_stru_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_pay_struc">Delete</a>
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
                <!-- /Delete PF STATUTORY Modal -->
        </div>
        <!-- End Pay Structure -->
       


    </div>
    </div>
</div>
<script>
    var income_type = "<?php echo $this->uri->segment(3); ?>"

    if (income_type == "deduction_type") {
        $("#income_li").removeClass("active");
        $("#income_tab").removeClass("show active");

        $("#deduction_li").addClass("active");
        $("#deduction_tab").addClass("show active");

    }
</script>
<script>
    var page_type = 1;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/inc_ded_type.js"></script>
