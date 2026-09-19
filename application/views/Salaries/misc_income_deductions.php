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
                        <li class="breadcrumb-item active">Misc Income/Deduction</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Incentives -->
        <div id="incentive_tab" class="pro-overview tab-pane fade show">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Incentive Components</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" id="incentive_type_form">
                                <div class="row">
                                    <!-- -----------added chandana 24-04-2021 -------------- -->
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group form-focus select-focus">
                                            <select class="select select2" style="width: 100%" name="insetypsel" id="insetypsel">
                                                <option value="1"> Incentive </option>
                                                <option value="2"> Miscellaneous </option>
                                            </select>
                                            <label class="focus-label">Select Type</label>
                                        </div>
                                        <span class="formerror" id="Select_Type_error"></span>
                                    </div>
                                    <!-- ----------- end added chandana 24-04-2021 -------------- -->
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input class="form-control yearmonth" placeholder="Month-Year" name="yearmonth" id="yearmonth">
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
                                            <select class="select select2" style="width: 100%" name="incentiveemployeecode" id="incentiveemployeecode">
                                                <option value="">Select Employee</option>
                                            </select>
                                            <label class="focus-label">Select Employee</label>
                                        </div>
                                        <span class="formerror" id="incentiveemployeecode_error"></span>
                                    </div>

                                    <div class="col-sm-12 col-md-12" id="incentivediv">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0 col-md-12">
                                                    <!-- <p align="center">Employee Contrubution</p> -->
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <select type="text" class="form-control" name="variablepay" id="variablepay">
                                                                <option value="">Select Variable Pay</option>
                                                            </select>
                                                        </label>
                                                        <span class="formerror" id="variablepayerror"></span>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="text" class="form-control numbersonly_with_dot" name="amount" id="amount" placeholder="Enter Amount">
                                                        </label>
                                                        <span class="formerror" id="amounterror"></span>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="checkbox" name="istds" id="istds"> TDS
                                                        </label>
                                                        <span class="formerror" id="istdserror"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12" id="miscellaneousdiv" style="display:none">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row card mb-0 col-md-12">
                                                    <!-- <p align="center">Employee Contrubution</p> -->
                                                    <div class="radio" align="center">
                                                        <label style=" margin: 0 2px 0;">
                                                            <select type="text" class="form-control" name="mis_variablepay" id="mis_variablepay">
                                                                <!-- <option value="">Select Variable Pay</option> -->
                                                                <option value="1">Miscellaneous Deduction</option>
                                                            </select>
                                                        </label>
                                                        <span class="formerror" id="mis_variablepayerror"></span>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="text" class="form-control" name="mis_amount" id="mis_amount" placeholder="Enter Amount">
                                                        </label>
                                                        <span class="formerror" id="mis_amounterror"></span>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="checkbox" name="mis_istds" id="mis_istds"> TDS
                                                        </label>
                                                        <span class="formerror" id="mis_istdserror"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" onclick="processincentive()" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <!-- INCENTIVE Datadisplay -->
                            <div class="table-responsive" id='incdivdatb'>
                                <table class="datatable table table-stripped mb-0 dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Emp Type</th>
                                            <th>Employee Code</th>
                                            <th>Company</th>
                                            <th>Division</th>
                                            <th>Branch</th>
                                            <th>State</th>
                                            <th>Date</th>
                                            <th>Payee</th>
                                            <th>Amount</th>
                                            <th>Tds</th>
                                            <!-- <th>Edit</th>                                             -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($incentive as $ince_type) {
                                            echo '<tr>';
                                            echo '<td>' . $sno . '</td>';
                                            echo '<td>' . $ince_type->mxemp_ty_name . '</td>';
                                            echo '<td>' . $ince_type->mxinc_employee_code . '</td>';
                                            echo '<td>' . $ince_type->mxcp_name . '</td>';
                                            echo '<td>' . $ince_type->mxd_name . '</td>';
                                            echo '<td>' . $ince_type->mxb_name . '</td>';
                                            echo '<td>' . $ince_type->mxst_state . '</td>';
                                            echo '<td>' . $ince_type->mxinc_date . '</td>';
                                            echo '<td>' . $ince_type->mxinc_variablepay_name . '</td>';
                                            echo '<td>' . $ince_type->mxinc_variablepay_amount . '</td>';
                                            if ($ince_type->mxinc_variablepay_istds == 1) {
                                                $st = "YES";
                                            } else {
                                                $st = "NO";
                                            }
                                            echo '<td>' . $st . '</td>';
                                            // echo '<td>';
                                            // echo'<div class="dropdown dropdown-action">';
                                            // echo'<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            // echo'<div class="dropdown-menu dropdown-menu-right">';
                                            // echo'<a class="dropdown-item" href="' . base_url() . 'admin/income_type_edit/' . $ince_type->mxincm_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            // echo'<a class="dropdown-item deletemodal income_delete" data-toggle="modal" data-target="#income_del_tab" data-id="' . $ince_type->mxincm_id . '~' . $ince_type->mxcp_name . '~' . $ince_type->mxincm_name . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            // echo'</div>';
                                            // echo'</div>';
                                            // echo '</td>';
                                            echo '</tr>';

                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END INCENTIVE Datadisplay -->
                            
                            <!-- MISCELLANEOUS Datadisplay -->
                            <div class="table-responsive" id='miscdivdatb' style="display:none">
                                <table class="datatable table table-stripped mb-0 dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Emp Type</th>
                                            <th>Employee Code</th>
                                            <th>Company</th>
                                            <th>Division</th>
                                            <th>Branch</th>
                                            <th>State</th>
                                            <th>Date</th>
                                            <th>Payee</th>
                                            <th>Amount</th>
                                            <th>Tds</th>
                                            <!-- <th>Edit</th>                                             -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($miscellaneous as $misc_type) {
                                            echo'<tr>';
                                            echo'<td>' . $sno . '</td>';//sno
                                            echo'<td>' . $misc_type->mxemp_ty_name . '</td>';//emp type
                                            echo'<td>' . $misc_type->mxinc_employee_code. '</td>';
                                            echo'<td>' . $misc_type->mxcp_name . '</td>';
                                            echo'<td>' . $misc_type->mxd_name . '</td>';
                                            echo'<td>' . $misc_type->mxb_name . '</td>';
                                            echo'<td>' . $misc_type->mxst_state . '</td>';
                                            echo'<td>' . $misc_type->mxmsc_ded_date . '</td>';
                                            echo'<td>' . $misc_type->mxmsc_ded_variablepay_name . '</td>';
                                            echo'<td>' . $misc_type->mxmsc_ded_variablepay_amount . '</td>';
                                            if($misc_type->mxmsc_ded_variablepay_istds == 1){$st = "YES";}else{$st = "NO";}
                                            echo'<td>' . $st . '</td>';
                                            // echo'<td>';
                                            // echo'</td>';
                                            echo'</tr>';

                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END MISCELLANEOUS Datadisplay -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Data -->
        <!-- Incentives -->
    </div>
</div>
<script>
    var page_type = 1;
</script>

<script src="<?php echo base_url(); ?>/assets/js/formsjs/incentive.js"></script>