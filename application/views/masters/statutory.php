<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create Statutory Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Statutory Master</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#pf_master" data-toggle="tab" class="nav-link active" id="pf_master_li">PF MASTER</a></li>
                        <li class="nav-item"><a href="#esi_master" data-toggle="tab" class="nav-link" id="esi_master_li">ESI MASTER</a></li>
                        <li class="nav-item"><a href="#pt_master" data-toggle="tab" class="nav-link" id="pt_master_li">PT MASTER</a></li>
                        <li class="nav-item"><a href="#lwf_master" data-toggle="tab" class="nav-link" id="lwf_master_li">LWF MASTER</a></li>
                        <li class="nav-item"><a href="#bonus_master" data-toggle="tab" class="nav-link" id="bns_master_li">BONUS MASTER</a></li>
                        <li class="nav-item"><a href="#gratuity_master" data-toggle="tab" class="nav-link" id="gratuity_master_li">GRATUITY</a></li>
                        <li class="nav-item"><a href="#lta_master" data-toggle="tab" class="nav-link" id="lta_master_li">LTA</a></li>
                        <li class="nav-item"><a href="#mediclaim_master" data-toggle="tab" class="nav-link" id="mediclaim_master_li">MEDICLAIM</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">

            <!-- PF Master Tab -->
            <div id="pf_master" class="pro-overview tab-pane fade show active">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#pfaddnew">Add New</button>
                <div id="pfaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER PF DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="#" id="pfstatutory">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_affectdate" id="pf_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="pf_affectdate_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="pf_company_id" id="pf_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="pf_cmpid_error"></span>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="form-group row">
                                                                                                    <label class="col-lg-3 col-form-label">State</label>
                                                                                                    <div class="col-lg-9">
                                                                                                        <select class="select2 form-control"  data-placeholder="Select State" name="pf_state" id="pf_state" style="width: 100%;">
                                                                                                            <option value="0">All states</option>
                                                <?php
                                                //                                                            foreach ($states as $getsates) {
                                                //                                                                echo"<option value=" . $getsates->mxst_id . ">" . $getsates->mxst_state . "</option>";
                                                //                                                            }
                                                ?>
                                                                                                            <option value="1">New Text</option>
                                                                                                            <option value="2">Old Text</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>-->
                                                <!--                                                <div class="form-group row">
                                                                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                                                                    <div class="col-lg-9">
                                                                                                        <select class="select2 form-control"  data-placeholder="Select Branch" name="pf_branches" id="pf_branches" style="width: 100%;">
                                                                                                            <option value="1">New Text</option>
                                                                                                            <option value="2">Old Text</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>-->
                                                <!--                                                <div class="form-group row">
                                                                                                    <label class="col-lg-3 col-form-label">Sub Branch</label>
                                                                                                    <div class="col-lg-9">
                                                                                                        <select class="select2 form-control" multiple="multiple" data-placeholder="Select Sub Branch" name="pf_subbranch[]" id="pf_subbranch" style="width: 100%;">
                                                                                                            <option value="1">New Text</option>
                                                                                                            <option value="2">Old Text</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>-->
                                                <!--                                                <div class="form-group row">
                                                                                                    <label class="col-lg-3 col-form-label">PF Limit</label>
                                                                                                    <div class="col-lg-9">
                                                                                                        <input type="text" name="pflimit" id="pflimit" class="form-control">
                                                                                                    </div>
                                                                                                </div>-->
                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">PF Limit on Basic Sal</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_bssalary_limit" id="pf_bssalary_limit" class="form-control m-b-20 numbersonly_with_dot">
                                                        <span class="formerror" id="pf_bssalary_limit_error"></span>

                                                        <input type="checkbox" class="basic_limit_check" name="pf_eligibility_on_above_pf_limit" id="pf_eligibility_on_above_pf_limit" value="1">
                                                        For above Basic Salary
                                                        <a href="#" title="company Wish" data-toggle="popover" data-trigger="hover" data-content="if you check these field pf will cut on the above pf limit"><i class="la la-info"></i>Hint</a><br>

                                                        <input type="checkbox" class="basic_limit_check" name="pf_eligibility_on_above_basic_limit_as_same" id="pf_eligibility_on_above_basic_limit_as_same" value="1">
                                                        For Above Basic Salary Take Same Basic Sal Limit
                                                        <a href="#" title="company Wish" data-toggle="popover" data-trigger="hover" data-content="if you check these field for Above Basic sal limit it will take same Basic Sal limit"><i class="la la-info"></i>Hint</a><br>

                                                        <span class="formerror" id="pfcheck_error"></span>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">PF Emp.Cont %</label>
                                                    <div class="col-lg-9">
                                                        <!--class percentinput-->
                                                        <input type="text" name="pfempcnt" id="pfempcnt" class="form-control numbersonly_with_dot" placeholder="12%">
                                                        <span class="formerror" id="pfempcnt_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">PF Comp Cont %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pfcompcnt" id="pfcompcnt" class="form-control numbersonly_with_dot" placeholder="3.67%">
                                                        <span class="formerror" id="pfcompcnt_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">PF Pension Cont(EPS) %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pfpens_cont" id="pfpens_cont" class="form-control numbersonly_with_dot" placeholder="8.33%">
                                                        <span class="formerror" id="pfpens_cont_error"></span>
                                                    </div>
                                                </div>






                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">EPS Wages Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_epswageslimit" id="pf_epswageslimit" class="form-control m-b-20 numbersonly_with_dot" placeholder="1500">
                                                        <span class="formerror" id="pf_epswageslimit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">EDLI Wages Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_edlisalarylimit" id="pf_edlisalarylimit" class="form-control m-b-20 numbersonly_with_dot" placeholder="1500">
                                                        <span class="formerror" id="pf_edlisalarylimit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">EDLI %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_edli" id="pf_edli" class="form-control numbersonly_with_dot" placeholder="0.5%">
                                                        <span class="formerror" id="pf_edli_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">PF Admin %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pfadmin" id="pfadmin" class="form-control numbersonly_with_dot" placeholder="0.5%">
                                                        <span class="formerror" id="pfadmin_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Age limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pf_agelimit" id="pf_agelimit" class="form-control m-b-20 numbersonly" placeholder="Enter Age Limit">
                                                        <span class="formerror" id="pf_agelimit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="pf_emp_type[]" id="pf_emp_type" multiple style="width:100%">
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="pf_emp_type_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0 col-md-12">
                                                    <p align="center">Employee Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employee_cont_round_type" value="1"> Above
                                                            <a href="#" title="Above" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 0.1 round to 1, for 0.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employee_cont_round_type" value="2"> Middle
                                                            <a href="#" title="Middle" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 2"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employee_cont_round_type" value="3"> Below
                                                            <a href="#" title="Below" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employee_cont_round_type" value="4" checked> No Rounding
                                                            <a href="#" title="No Rounding" data-toggle="popover" data-trigger="hover" data-content="same as it is no rounding ex: for 0.1 output also 0.1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row card mb-0 col-md-12">
                                                    <p align="center">Employer Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employer_cont_round_type" value="1"> Above
                                                            <a href="#" title="Above" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 0.1 round to 1, for 0.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employer_cont_round_type" value="2"> Middle
                                                            <a href="#" title="Middle" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 2"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employer_cont_round_type" value="3"> Below
                                                            <a href="#" title="Below" data-toggle="popover" data-trigger="hover" data-content=" ex: 1) for 1.1 round to 1, for 1.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_employer_cont_round_type" value="4" checked> No Rounding
                                                            <a href="#" title="No Rounding" data-toggle="popover" data-trigger="hover" data-content=" same as it is no rounding ex: for 0.1 output also 0.1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row card mb-0 col-md-12">
                                                    <p align="center">pension Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_pens_cont_round_type" value="1"> Above
                                                            <a href="#" title="Above" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 0.1 round to 1, for 0.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_pens_cont_round_type" value="2"> Middle
                                                            <a href="#" title="Middle" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 2"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_pens_cont_round_type" value="3"> Below
                                                            <a href="#" title="Below" data-toggle="popover" data-trigger="hover" data-content=" ex: 1) for 1.1 round to 1, for 1.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_pens_cont_round_type" value="4" checked> No Rounding
                                                            <a href="#" title="No Rounding" data-toggle="popover" data-trigger="hover" data-content="same as it is no rounding ex: for 0.1 output also 0.1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">EDLI %</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_edli_perc_round_type" value="1"> Above
                                                            <a href="#" title="Above" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 0.1 round to 1, for 0.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_edli_perc_round_type" value="2"> Middle
                                                            <a href="#" title="Middle" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 2"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_edli_perc_round_type" value="3"> Below
                                                            <a href="#" title="Below" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_edli_perc_round_type" value="4" checked> No Rounding
                                                            <a href="#" title="Rounding" data-toggle="popover" data-trigger="hover" data-content="same as it is no rounding ex: for 0.1 output also 0.1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Admin %</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_admin_perc_round_type" value="1"> Above
                                                            <a href="#" title="Above" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 0.1 round to 1, for 0.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_admin_perc_round_type" value="2"> Middle
                                                            <a href="#" title="Middle" data-toggle="popover" data-trigger="hover" data-content="ex: 1) for 1.1 round to 1, for 1.6 round to 2"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_admin_perc_round_type" value="3"> Below
                                                            <a href="#" title="Below" data-toggle="popover" data-trigger="hover" data-content=" ex: 1) for 1.1 round to 1, for 1.6 round to 1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="pf_admin_perc_round_type" value="4" checked> No Rounding
                                                            <a href="#" title="No Rounding" data-toggle="popover" data-trigger="hover" data-content="same as it is no rounding ex: for 0.1 output also 0.1"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" id="pf_submit">Submit</button>
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
                                <h4 class="card-title mb-0">PF List</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                //print_r($pf_statutory);
                                //exit;
                                ?>
                                <div class="table-responsive">
                                    <!--<table class="datatable table table-stripped mb-0 " id="dataTables-example">-->
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Company Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Emp Cont</th>
                                                <th>Comp Cont</th>
                                                <th>Pen Cont</th>
                                                <th>Edli %</th>
                                                <th>Admin %</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($pf_statutory as $pf_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $pf_stat->mxcp_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($pf_stat->mxpf_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($pf_stat->mxpf_affect_to)) . '</td>';
                                                echo '<td>' . $pf_stat->mxpf_pf_emp_cont . '</td>';
                                                echo '<td>' . $pf_stat->mxpf_pf_comp_cont . '</td>';
                                                echo '<td>' . $pf_stat->mxpf_pf_pension_cont . '</td>';
                                                echo '<td>' . $pf_stat->mxpf_pf_edli_perc . '</td>';
                                                echo '<td>' . $pf_stat->mxpf_pf_admin_perc . '</td>';
                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){                    
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/pf_statutorymaster_edit/' . $pf_stat->mxpf_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal pf_delete" data-toggle="modal" data-target="#delete" data-id="' . $pf_stat->mxpf_id . '~' . $pf_stat->mxcp_name . '~' . date('d/m/Y', strtotime($pf_stat->mxpf_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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
                <div class="modal custom-modal fade" id="delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="pf_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="pf_id_hidden" id="del_pf_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_pf">Delete</a>
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
            <!-- /PF Master Tab -->

            <!-- Esi Master Tab -->
            <div id="esi_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#esiaddnew">Add New</button>
                <div id="esiaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER ESI DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="esi_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="esi_affectdate" id="esi_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="esi_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="esi_company_id" id="esi_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="esi_company_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                            <?php
                                                            //                                                            foreach ($cmpmaster as $companies) {
                                                            //                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            //                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="esi_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="esi_state_id" id="esi_state_id" style="width: 100%;">
                                                            <option value="0">Select State</option>
                                                            <!--<option value="1">test State</option>-->
                                                            <?php // foreach ($states as $key => $stvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state       
                                                                                ?>"><?php echo $stvalue->mxst_state ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <span class="formerror" id="esi_state_id_error"></span>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="esi_branch_id" id="esi_branch_id" style="width: 100%;">
                                                            <option value="0">Select Branch</option>
                                                            <?php // foreach ($branchmaster as $key => $brvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $brvalue->mxb_id       
                                                                                ?>"><?php echo $brvalue->mxb_name ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>
                                                        <span class="formerror" id="esi_branch_id_error"></span>
                                                    </div>
                                                </div>




                                                <!--                                                <div class="form-group row" style="margin-top: 10px;">
                                                                                                    <label class="col-lg-3 col-form-label">Salary Limit</label>
                                                                                                    <div class="col-lg-9">
                                                                                                        <input type="text" class="form-control" placeholder="12%">
                                                                                                    </div>
                                                                                                </div>-->


                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">ESI Code</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control m-b-20" name="esi_code" id="esi_code">
                                                        <span class="formerror" id="esi_code_error"></span>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Gross Salary Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control m-b-20 numbersonly_with_dot" name="gross_sal_limit" id="gross_sal_limit">
                                                        <span class="formerror" id="gross_sal_limit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">ESI Emp.Cont %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="esi_emp_cont" id="esi_emp_cont" class="form-control numbersonly_with_dot" placeholder="0.75%">
                                                        <span class="formerror" id="esi_emp_cont_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">ESI Comp Cont %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="esi_comp_cont" id="esi_comp_cont" class="form-control numbersonly_with_dot" placeholder="3.25%">
                                                        <span class="formerror" id="esi_comp_cont_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="esi_emp_type[]" id="esi_emp_type" multiple>
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="esi_emp_type_error"></span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                        <hr>
                                        <!----------Rounding--->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Employee Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employee_cont_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employee_cont_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employee_cont_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employee_cont_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>


                                            </div>





                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Employer Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employer_cont_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employer_cont_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employer_cont_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="esi_employer_cont_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <!------End Rounding--->
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">ESI List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($esi_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Company Name</th>
                                                <th>State Name</th>
                                                <th>Division Name</th>
                                                <th>Branch Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Esi Code</th>
                                                <th>Gross Sal Limit</th>
                                                <th>Emp Cont</th>
                                                <th>Comp Cont</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($esi_statutory as $esi_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $esi_stat->mxcp_name . '</td>';
                                                echo '<td>' . $esi_stat->mxst_state . '</td>';
                                                echo '<td>' . $esi_stat->mxd_name . '</td>';
                                                echo '<td>' . $esi_stat->mxb_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($esi_stat->mxesi_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($esi_stat->mxesi_affect_to)) . '</td>';
                                                echo '<td>' . $esi_stat->mxesi_esi_code . '</td>';
                                                echo '<td>' . $esi_stat->mxesi_gross_sal_limit . '</td>';
                                                echo '<td>' . $esi_stat->mxesi_emp_cont . '</td>';
                                                echo '<td>' . $esi_stat->mxesi_comp_cont . '</td>';

                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/esi_statutorymaster_edit/' . $esi_stat->mxesi_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal esi_delete" data-toggle="modal" data-target="#esi_delete" data-id="' . $esi_stat->mxesi_id . '~' . $esi_stat->mxcp_name . '~' . date('d/m/Y', strtotime($esi_stat->mxesi_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</td>';
                                                echo '</tr>';

                                                $sno++;
                                            }
                                            ?>

                                            <!--                                            <tr>
                                                <td>Test</td>
                                                <td>Test</td>
                                                <td>Test</td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>-->

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Tables -->
                <!-- Delete ESI Statutory Modal -->
                <div class="modal custom-modal fade" id="esi_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="esi_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="esi_id_hidden" id="del_esi_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_esi">Delete</a>
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
                <!-- /Delete ESI STATUTORY Modal -->
            </div>
            <!-- /Esi Master Tab -->

            <!-- Pt Master Tab -->
            <div id="pt_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#ptaddnew">Add New</button>
                <div id="ptaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER PT DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="pt_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pt_affectdate" id="pt_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="pt_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="pt_div_id" id="pt_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                            <?php
                                                            //                                                            foreach ($cmpmaster as $companies) {
                                                            //                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            //                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="pt_div_id_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="pt_state_id" id="pt_state_id" style="width: 100%;">
                                                            <option value="0">Select State</option>
                                                            <!--                                                            <option value="1">AP</option>
                                                                                                                        <option value="2">Telanagana</option>-->

                                                        </select>
                                                        <span class="formerror" id="pt_state_id_error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="pt_branch_id" id="pt_branch_id" style="width: 100%;">
                                                            <option value="0">Select Branch</option>
                                                            <?php // foreach ($branchmaster as $key => $brvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $brvalue->mxb_id       
                                                                                ?>"><?php echo $brvalue->mxb_name ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>
                                                        <span class="formerror" id="pt_branch_id_error"></span>
                                                    </div>
                                                </div>



                                            </div>



                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="pt_company_id" id="pt_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                    </div>
                                                    <span class="formerror" id="pt_company_id_error"></span>
                                                </div>
                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">PT in No</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="pt_in_no" id="pt_in_no" class="form-control m-b-20 numbersonly_with_dot" placeholder="Enter PT In No">
                                                        <span class="formerror" id="pt_in_no_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="pt_emp_type[]" id="pt_emp_type" multiple style="width:100%">
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="pt_emp_type_error"></span>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">PT Type:</label>
                                                    <div class="col-lg-9">
                                                        <select class="select select2" name="pt_type_id" id="pt_type_id" style="width:100%">
                                                            <option value="0">Select PT Type</option>
                                                            <option value="1">Monthly</option>
                                                            <option value="2">Quaterly</option>
                                                            <option value="3">Half Yearly</option>
                                                            <option value="4">Yearly</option>
                                                            <?php // foreach ($states as $key => $stvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state        
                                                                                ?>"><?php // echo $stvalue->mxst_state        
                                                                                    ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <span class="formerror" id="pt_type_id_error"></span>
                                                </div>


                                            </div>
                                        </div>

                                        <hr>

                                        <!--------------MONTHLY AND YEARLY--------------->
                                        <div id="monthly_and_yearly_tab">
                                            <div class="container-fluid">
                                                <div class="table-responsive" id="Monthly">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Gross From</th>
                                                                <th>Gross To</th>
                                                                <th>PT Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from numbersonly_with_dot">
                                                                </td>
                                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to numbersonly_with_dot"></td>
                                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt numbersonly_with_dot"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--------------END MONTHLY AND YEARLY--------------->

                                        <!---------------------------- Quaterly ------------------------------->
                                        <div id="quaterly_tab">
                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                    <!--    <input type="text" name="quater_1_date" id="quater_1_date" class="form-control m-b-10 yearmonth" placeholder="Quater-1 Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gross From</th>
                                                                    <th>Gross To</th>
                                                                    <th>PT Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                    <!--    <input type="text" name="quater_2_date" id="quater_2_date" class="form-control m-b-10 yearmonth" placeholder="Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gross From</th>
                                                                    <th>Gross To</th>
                                                                    <th>PT Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                    <!--    <input type="text" name="quater_3_date" id="quater_3_date" class="form-control m-b-10 yearmonth" placeholder="Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gross From</th>
                                                                    <th>Gross To</th>
                                                                    <th>PT Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                        <!--<input type="text" name="quater_4_date" id="quater_4_date" class="form-control m-b-10 yearmonth" placeholder="Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gross From</th>
                                                                    <th>Gross To</th>
                                                                    <th>PT Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!------------------------END Quaterly ------------------------------------->
                                        <!------------------------END Half Yearly ------------------------------------->

                                        <div id="halfyearly_tab">
                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                    <!--    <input type="text" name="halfyearly_1_date" id="halfyearly_1_date" class="form-control m-b-10 yearmonth" placeholder="Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive" id="Monthly">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gross From</th>
                                                                    <th>Gross To</th>
                                                                    <th>PT Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!--<label class="col-lg-3 col-form-label">From Date</label>-->
                                                    <!--<div class="col-lg-9 row">-->
                                                    <!--    <input type="text" name="halfyearly_2_date" id="halfyearly_2_date" class="form-control m-b-10 yearmonth" placeholder="Date">-->
                                                    <!--</div>-->
                                                    <div class="table-responsive" id="Monthly">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to numbersonly_with_dot"></td>
                                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt numbersonly_with_dot"></td>
                                                                </tr>
                                                                </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!------------------------END Half Yearly ------------------------------------->



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                    <!-----End pt form--->



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete PT Statutory Modal -->
                <div class="modal custom-modal fade" id="pt_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="pt_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="pt_id_hidden" id="del_pt_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_pt">Delete</a>
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
                <!-- /Delete PT STATUTORY Modal -->
<?php } ?>
                <!-- Data Tables -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">PT List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($pt_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Company Name</th>
                                                <th>State Name</th>
                                                <th>Division Name</th>
                                                <th>Branch Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>PT in No</th>
                                                <th>PT Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($pt_statutory as $pt_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $pt_stat->mxcp_name . '</td>';
                                                echo '<td>' . $pt_stat->mxst_state . '</td>';
                                                echo '<td>' . $pt_stat->mxd_name . '</td>';
                                                echo '<td>' . $pt_stat->mxb_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($pt_stat->mxpt_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($pt_stat->mxpt_affect_to)) . '</td>';
                                                echo '<td>' . $pt_stat->mxpt_pt_in_no . '</td>';
                                                if ($pt_stat->mxpt_pt_type == 1) { //--->Monthly
                                                    $type = "Monthly";
                                                } else if ($pt_stat->mxpt_pt_type == 2) { //---->Quaterly
                                                    $type = "Quaterly";
                                                } else if ($pt_stat->mxpt_pt_type == 3) { //--->Half Yearly
                                                    $type = "Half Yearly";
                                                } else if ($pt_stat->mxpt_pt_type == 4) { //-->Yearly
                                                    $type = "Yearly";
                                                }
                                                echo '<td>' . $type . '</td>';

                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/pt_statutorymaster_edit/' . $pt_stat->mxpt_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal pt_delete" data-toggle="modal" data-target="#pt_delete" data-id="' . $pt_stat->mxpt_id . '~' . $pt_stat->mxcp_name . '~' . date('d/m/Y', strtotime($pt_stat->mxpt_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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

            </div>
            <!-- /Pt Master Tab -->

            <!-- Lwf Master Tab -->
            <div id="lwf_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#lwfaddnew">Add New</button>
                <div id="lwfaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER LWF DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="lwf_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_affectdate" id="lwf_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="lwf_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="lwf_company_id" id="lwf_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="lwf_company_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="lwf_div_id" id="lwf_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                            <?php
                                                            //                                                            foreach ($cmpmaster as $companies) {
                                                            //                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            //                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="lwf_div_id_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_state_id" id="lwf_state_id" style="width: 100%;">
                                                            <option value="">Select State</option>
                                                            <?php // foreach ($states as $key => $stvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state 
                                                                                ?>"><?php // echo $stvalue->mxst_state 
                                                                                    ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <span class="formerror" id="lwf_state_id_error"></span>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_branch_id" id="lwf_branch_id" style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                            <?php // foreach ($branchmaster as $key => $brvalue) { 
                                                            ?>
                                                            <!--<option value="<?php // echo $brvalue->mxb_id 
                                                                                ?>"><?php // echo $brvalue->mxb_name 
                                                                                    ?></option>-->
                                                            <?php // } 
                                                            ?>
                                                        </select>
                                                        <span class="formerror" id="lwf_branch_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Grade</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="gradename[]" multiple id="gradename">
                                                        </select>
                                                        <span class="formerror" id="gradenameerror"></span>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Deduct Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_deduct_date" id="lwf_deduct_date" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="lwf_deduct_date_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">LWF Emp.Rupees</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_emp_cont" id="lwf_emp_cont" class="form-control numbersonly_with_dot" placeholder="2">
                                                        <span class="formerror" id="lwf_emp_cont_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">LWF Comp.Rupees</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_comp_cont" id="lwf_comp_cont" class="form-control numbersonly_with_dot" placeholder="5">
                                                        <span class="formerror" id="lwf_comp_cont_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">LWF No</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" placeholder="Enter LWF No" name="lwf_no" id="lwf_no">
                                                        <span class="formerror" id="lwf_no_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="lwf_emp_type[]" id="lwf_emp_type" multiple style="width:100%">
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="lwf_emp_type_error"></span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <hr>
                                        <!----------Rounding--->
                                        <!-- <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Employee Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employee_cont_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employee_cont_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employee_cont_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employee_cont_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Employer Contrubution</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employer_cont_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employer_cont_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employer_cont_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="lwf_employer_cont_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!----------END  Rounding--->



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">LWF List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($lwf_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Company Name</th>
                                                <th>Divison Name</th>
                                                <th>State Name</th>
                                                <th>Branch Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Deduct Date</th>
                                                <th>LWF No</th>
                                                <th>Emp Cont</th>
                                                <th>Comp Cont</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($lwf_statutory as $lwf_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $lwf_stat->mxcp_name . '</td>';
                                                echo '<td>' . $lwf_stat->mxd_name . '</td>';
                                                echo '<td>' . $lwf_stat->mxst_state . '</td>';
                                                echo '<td>' . $lwf_stat->mxb_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($lwf_stat->mxlwf_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($lwf_stat->mxlwf_affect_to)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($lwf_stat->mxlwf_deduct_date)) . '</td>';
                                                echo '<td>' . $lwf_stat->mxlwf_lwf_no . '</td>';
                                                echo '<td>' . $lwf_stat->mxlwf_emp_contr . '</td>';
                                                echo '<td>' . $lwf_stat->mxlwf_comp_contr . '</td>';


                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/lwf_statutorymaster_edit/' . $lwf_stat->mxlwf_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal lwf_delete" data-toggle="modal" data-target="#lwf_delete" data-id="' . $lwf_stat->mxlwf_id . '~' . $lwf_stat->mxcp_name . '~' . date('d/m/Y', strtotime($lwf_stat->mxlwf_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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
                <!-- Delete LWF Statutory Modal -->
                <div class="modal custom-modal fade" id="lwf_delete" role="dialog">
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
                <!-- /Delete LWF STATUTORY Modal -->

            </div>
            <!-- /Lwf Master Tab -->

            <!-- bns Master Tab -->
            <div id="bonus_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#bsmaddnew">Add New</button>
                <div id="bsmaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER BONUS DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="bns_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="bns_affect_date" id="bns_affect_date" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="bns_affect_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="bns_cmp_id" id="bns_cmp_id" style="width:100%">
                                                            <option value="">-- Select Company --</option>
                                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                                <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="bns_cmp_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="bns_div_id" id="bns_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                            <?php
                                                            //                                                            foreach ($cmpmaster as $companies) {
                                                            //                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            //                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="bns_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Employement Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="bns_emp_type[]" id="bns_emp_type" multiple>
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="bns_emp_type_error"></span>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Bonus Applicability</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="21000" name="bns_applicability" id="bns_applicability">
                                                        <span class="formerror" id="bns_applicability_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Bonus %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="12" name="bns_perc" id="bns_perc">
                                                        <span class="formerror" id="bns_perc_error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Max Bonus Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="7000" name="max_bns_limit" id="max_bns_limit">
                                                        <span class="formerror" id="max_bns_limit_error"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <!----------Rounding--->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Bonus %</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="bns_perc_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="bns_perc_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="bns_perc_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="bns_perc_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <!----------End Rounding--->



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">Bonus List</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Company Name</th>
                                                <th>Division Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Year Type</th>
                                                <th>Bonus Applicability</th>
                                                <th>Max Bonus</th>
                                                <th>Bonus Perc</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($bns_statutory as $bns_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $bns_stat->mxcp_name . '</td>';
                                                echo '<td>' . $bns_stat->mxd_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($bns_stat->mxbns_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($bns_stat->mxbns_affect_to)) . '</td>';
                                                echo '<td>' . $bns_stat->mxfny_name . '</td>';
                                                echo '<td>' . $bns_stat->mxbns_bonus_applicability . '</td>';
                                                echo '<td>' . $bns_stat->mxbns_max_bns . '</td>';
                                                echo '<td>' . $bns_stat->mxbns_bonus_perc . '</td>';


                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/bns_statutorymaster_edit/' . $bns_stat->mxbns_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal bns_delete" data-toggle="modal" data-target="#bns_delete" data-id="' . $bns_stat->mxbns_id . '~' . $bns_stat->mxcp_name . '~' . date('d/m/Y', strtotime($bns_stat->mxbns_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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
            <!-- /bns Master Tab -->

            <!-- GRATUITY Master Tab -->
            <div id="gratuity_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#gratuitynew">Add New</button>
                <div id="gratuitynew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER GRATUITY DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="gratuity_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="gratuity_affect_date" id="gratuity_affect_date" class="form-control yearmonth" autoomplete="off">
                                                        <span class="formerror" id="gratuity_affect_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="gratuity_cmp_id" id="gratuity_cmp_id" style="width:100%">
                                                            <option value="">-- Select Company --</option>
                                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                                <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="gratuity_cmp_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="gratuity_div_id" id="gratuity_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>

                                                        </select>
                                                        <span class="formerror" id="gratuity_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Employement Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="gratuity_emp_type[]" id="gratuity_emp_type" multiple>
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="gratuity_emp_type_error"></span>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Gratuity Age Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly" placeholder="58" name="gratuity_age_limit" id="gratuity_age_limit">
                                                        <span class="formerror" id="gratuity_age_limit_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Gratuity Service Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly" placeholder="eg : 5" name="gratuity_service_limit" id="gratuity_service_limit">
                                                        <span class="formerror" id="gratuity_service_limit_error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Max Gratuity Amount</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="2000000" name="max_gratuity_limit" id="max_gratuity_limit">
                                                        <span class="formerror" id="max_gratuity_limit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Gratuity Per Month %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control numbersonly_with_dot" placeholder="4.81" name="gratuity_per_month_perc" id="gratuity_per_month_perc">
                                                        <span class="formerror" id="gratuity_per_month_perc_error"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <!----------Rounding--->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">GRATUITY PER MONTH %</p>
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="1"> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="2"> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="3"> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="4" checked> No Rounding
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Formulae</p>
                                                    <label class="col-lg-12 col-form-label">GRATUITY = ((LAST DRAWN RATE OF BASIC SALARY)/26)*15*No.Of Years</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!----------End Rounding--->



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">GRATUITY List</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Company Name</th>
                                                <th>Division Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Age Limit</th>
                                                <th>Service Limit</th>
                                                <th>Max Gartuity</th>
                                                <th>Per Month %</th>
                                                <th>Emp Types</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            // print_r($gratuity_statutory);exit;
                                            if (count($gratuity_statutory) > 0) {
                                                foreach ($gratuity_statutory as $gratuity_stat) {
                                                    echo '<tr>';
                                                    echo '<td>' . $sno . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxcp_name . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxd_name . '</td>';
                                                    echo '<td>' . date('d/m/Y', strtotime($gratuity_stat->mxgratuity_affect_from)) . '</td>';
                                                    echo '<td>' . date('d/m/Y', strtotime($gratuity_stat->mxgratuity_affect_to)) . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxgratuity_age_limit . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxgratuity_service_limit . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxgratuity_max_amount . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxgratuity_month_wise_perc . '</td>';
                                                    echo '<td>' . $gratuity_stat->mxgratuity_emp_types . '</td>';


                                                    echo '<td>';
                                                    echo '<div class="dropdown dropdown-action">';
                                                    echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                    echo '<div class="dropdown-menu dropdown-menu-right">';
                                                    if($this->session->userdata('user_role_edit') == 1){
                                                    echo '<a class="dropdown-item" href="' . base_url() . 'admin/bns_gratuity_edit/' . $gratuity_stat->mxgratuity_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                    }
                                                    if($this->session->userdata('user_role_delete') == 1){
                                                    echo '<a class="dropdown-item deletemodal gratuity_delete" data-toggle="modal" data-target="#bns_gratuity_delete" data-id="' . $gratuity_stat->mxgratuity_id . '~' . $gratuity_stat->mxcp_name . '~' . date('d/m/Y', strtotime($gratuity_stat->mxgratuity_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</td>';
                                                    echo '</tr>';

                                                    $sno++;
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
                <!-- Delete Graruity Statutory Modal -->
                <div class="modal custom-modal fade" id="bns_gratuity_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="gratuity_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="gratuity_id_hidden" id="del_gratuity_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_gratuity">Delete</a>
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
                <!-- /Delete GRATUITY STATUTORY Modal -->

    

            </div>
            <!-- /GRATUITY Master Tab -->
            <!-- LTA Master Tab -->
            <div id="lta_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#ltaaddnew">Add New</button>
                <div id="ltaaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER LTA DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="lta_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lta_affectdate" id="lta_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="lta_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="lta_company_id" id="lta_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="lta_company_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="lta_div_id" id="lta_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                        </select>
                                                        <span class="formerror" id="lta_div_id_error"></span>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_state_id" id="lwf_state_id" style="width: 100%;">
                                                            <option value="">Select State</option>
                                                
                                                        </select>

                                                    </div>
                                                    <span class="formerror" id="lwf_state_id_error"></span>
                                                </div> -->





                                            </div>

                                            <div class="col-xl-6">

                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">LTA Comp.Rupees</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_comp_cont" id="lwf_comp_cont" class="form-control" placeholder="5">
                                                        <span class="formerror" id="lwf_comp_cont_error"></span>
                                                    </div>
                                                </div>        -->

                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_branch_id" id="lwf_branch_id" style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                            
                                                        </select>
                                                        <span class="formerror" id="lwf_branch_id_error"></span>
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Grade</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lta_gradename[]" multiple id="lta_gradename">
                                                        </select>
                                                        <span class="formerror" id="lta_gradenameerror"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="lta_emp_type[]" id="lta_emp_type" multiple style="width:100%">
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="lta_emp_type_error"></span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Formulae</p>
                                                    <label class="col-lg-12 col-form-label">LTA = ((LAST DRAWN RATE OF BASIC SALARY)/12)*1</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">LTA List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($lwf_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Company Name</th>
                                                <th>Divison Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Emp Type</th>
                                                <th>Grades</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            if (count($lta_statutory) > 0) {
                                                foreach ($lta_statutory as $lta_stat) {
                                                    echo '<tr>';
                                                    echo '<td>' . $sno . '</td>';
                                                    echo '<td>' . $lta_stat->mxcp_name . '</td>';
                                                    echo '<td>' . $lta_stat->mxd_name . '</td>';
                                                    echo '<td>' . date('d/m/Y', strtotime($lta_stat->mxlta_affect_from)) . '</td>';
                                                    echo '<td>' . date('d/m/Y', strtotime($lta_stat->mxlta_affect_to)) . '</td>';
                                                    echo '<td>' . $lta_stat->mxlta_emp_types . '</td>';
                                                    echo '<td>' . $lta_stat->mxlta_applicable_grades . '</td>';
                                                    echo '<td>';
                                                    echo '<div class="dropdown dropdown-action">';
                                                    echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                    echo '<div class="dropdown-menu dropdown-menu-right">';
                                                    if($this->session->userdata('user_role_edit') == 1){
                                                    echo '<a class="dropdown-item" href="' . base_url() . 'admin/bns_lta_edit/' . $lta_stat->mxlta_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                    }
                                                    if($this->session->userdata('user_role_delete') == 1){
                                                    echo '<a class="dropdown-item deletemodal lta_delete" data-toggle="modal" data-target="#lta_delete" data-id="' . $lta_stat->mxlta_id . '~' . $lta_stat->mxcp_name . '~' . date('d/m/Y', strtotime($lta_stat->mxlta_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                    $sno++;
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
                <!-- Delete LWF Statutory Modal -->
                <div class="modal custom-modal fade" id="lta_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="lta_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="lta_id_hidden" id="del_lta_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_lta">Delete</a>
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
                <!-- /Delete LWF STATUTORY Modal -->

            </div>
            <!-- /LTA Master Tab -->
            <!-- MEDICLAIM Master Tab -->
            <div id="mediclaim_master" class="tab-pane fade">
                <?php if($this->session->userdata('user_role_add') == 1){ ?>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#mediclaimaddnew">Add New</button>
                <div id="mediclaimaddnew" class="collapse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">ENTER MEDICLAIM DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <form id="mediclaim_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="med_affectdate" id="med_affectdate" class="form-control yearmonth" autocomplete="off">
                                                        <span class="formerror" id="med_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="med_company_id" id="med_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="med_company_id_error"></span>
                                                    </div>
                                                </div>


                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">State:</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_state_id" id="lwf_state_id" style="width: 100%;">
                                                            <option value="">Select State</option>
                                                
                                                        </select>

                                                    </div>
                                                    <span class="formerror" id="lwf_state_id_error"></span>
                                                </div> -->


                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Grade</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="med_gradename[]" multiple id="med_gradename">
                                                        </select>
                                                        <span class="formerror" id="med_gradenameerror"></span>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-xl-6">

                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">LTA Comp.Rupees</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="lwf_comp_cont" id="lwf_comp_cont" class="form-control" placeholder="5">
                                                        <span class="formerror" id="lwf_comp_cont_error"></span>
                                                    </div>
                                                </div>        -->
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Division" name="med_div_id" id="med_div_id" style="width: 100%;">
                                                            <option value="0">Select Division</option>
                                                            <?php
                                                            //                                                            foreach ($cmpmaster as $companies) {
                                                            //                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            //                                                            }
                                                            ?>
                                                            <!--<option value="1">New Text</option>-->
                                                            <!--<option value="2">Old Text</option>-->
                                                        </select>
                                                        <span class="formerror" id="med_div_id_error"></span>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Branch</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select2" name="lwf_branch_id" id="lwf_branch_id" style="width: 100%;">
                                                            <option value="">Select Branch</option>
                                                            
                                                        </select>
                                                        <span class="formerror" id="lwf_branch_id_error"></span>
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="med_emp_type[]" id="med_emp_type" multiple style="width:100%">
                                                            <!--<option value="0">Select Employement Type</option>-->
                                                            <!--<option value="1">ON ROll</option>-->
                                                            <!--<option value="1">Directors</option>-->
                                                            <?php foreach ($emptype as $key => $emp_type) { ?>
                                                                <option value="<?php echo $emp_type->mxemp_ty_id ?>"><?php echo $emp_type->mxemp_ty_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="formerror" id="med_emp_type_error"></span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0">
                                                    <p align="center">Formulae</p>
                                                    <label class="col-lg-12 col-form-label">MEDICLAIM = ((LAST DRAWN RATE OF BASIC SALARY)/12)*1</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                <h4 class="card-title mb-0">MEDICLAIM List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($lwf_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0 common_dataTables">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Company Name</th>
                                                <th>Divison Name</th>
                                                <th>Affect From</th>
                                                <th>Affect To</th>
                                                <th>Emp Type</th>
                                                <th>Grades</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($mediclaim_statutory as $med_stat) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $med_stat->mxcp_name . '</td>';
                                                echo '<td>' . $med_stat->mxd_name . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($med_stat->mxmediclaim_affect_from)) . '</td>';
                                                echo '<td>' . date('d/m/Y', strtotime($med_stat->mxmediclaim_affect_to)) . '</td>';
                                                echo '<td>' . $med_stat->mxmediclaim_emp_types . '</td>';
                                                echo '<td>' . $med_stat->mxmediclaim_applicable_grades . '</td>';
                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                if($this->session->userdata('user_role_edit') == 1){
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/bns_mediclaim_edit/' . $med_stat->mxmediclaim_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                }
                                                if($this->session->userdata('user_role_delete') == 1){
                                                echo '<a class="dropdown-item deletemodal mediclaim_delete" data-toggle="modal" data-target="#mediclaim_delete" data-id="' . $med_stat->mxmediclaim_id . '~' . $med_stat->mxcp_name . '~' . date('d/m/Y', strtotime($med_stat->mxmediclaim_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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
                <!-- Delete MEDICLAIM Statutory Modal -->
                <div class="modal custom-modal fade" id="mediclaim_delete" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Company</h3>
                                    <h3 style="color: red" id="mediclaim_del_comp"></h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <input type="hidden" name="mediclaim_id_hidden" id="del_mediclaim_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_mediclaim">Delete</a>
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
                <!-- /Delete MEDICLAIM STATUTORY Modal -->

            </div>
            <!-- /MEDICLAIM Master Tab -->



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
<!---------------PT------------>
<script>
    $(document).ready(function() {
        $("#monthly_and_yearly_tab").hide();
        $("#quaterly_tab").hide();
        $("#halfyearly_tab").hide();
    });
</script>
<!---------------END PT------------>
<!-----To Select The Particular tabs------->
<script>
    ////    $("#esi_master").addClass('active');
    var flag = "<?php echo $this->uri->segment(3); ?>";

    if (flag == "pf_master_li") { //--->PF
        $("#pf_master_li").addClass("active");
        $("#pf_master").addClass("active show");
    } else if (flag == "esi_master_li") { //--->ESI
        $("#esi_master_li").addClass("active");
        $("#esi_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");
    } else if (flag == "pt_master_li") { //--->PT
        $("#pt_master_li").addClass("active");
        $("#pt_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");
    } else if (flag == "lwf_master_li") { //--->LWF
        $("#lwf_master_li").addClass("active");
        $("#lwf_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");
    } else if (flag == "bns_master_li") { //--->Bonus
        $("#bns_master_li").addClass("active");
        $("#bonus_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");

    } else if (flag == "gratuity_master_li") { //--->GRATUITY
        $("#gratuity_master_li").addClass("active");
        $("#gratuity_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");

    }else if (flag == "lta_master_li") { //--->LTA
        $("#lta_master_li").addClass("active");
        $("#lta_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");

    }else if (flag == "mediclaim_master_li") { //--->MEDICLAIM
        $("#mediclaim_master_li").addClass("active");
        $("#mediclaim_master").addClass("active show");
        $("#pf_master_li").removeClass("active");
        $("#pf_master").removeClass("active show");

    }
</script>
<!-----End To Select The Particular tabs--->
<!-- Mask JS -->
<script src="<?php echo base_url() ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/mask.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pf_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/esi_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pt_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/lwf_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/bonus_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/gratuity_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/lta_statutory.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/mediclaim_statutory.js"></script>