<!-- PF Master Tab -->
<div class="page-wrapper">
    <!--<div id="pf_master" class="pro-overview tab-pane fade show active">-->
    <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#pfaddnew">Add New</button>-->
    <!--<div id="pfaddnew" class="collapse">-->
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
                                        <?php
                                        // print_r($pf_statutory); 
//                                                        echo date('d-m-Y',strtotime($pf_statutory[0]->mxpf_affect_from))
                                        ?>
                                        <input type="text" name="pf_affectdate" id="pf_affectdate" class="form-control yearmonth" value="<?php echo date('m-Y', strtotime($pf_statutory[0]->mxpf_affect_from)) ?>" autocomplete="off">
                                        <span class="formerror" id="pf_affectdate_error"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Company</label>
                                    <div class="col-lg-9">
                                        <select class="select2 form-control"  data-placeholder="Select Company" name="pf_company_id" id="pf_company_id" style="width: 100%;">
                                            <option value="0">Select Company</option>
                                            <?php
                                            foreach ($cmpmaster as $companies) {
                                                if ($companies->mxcp_id == $pf_statutory[0]->mxpf_comp_id) {
                                                    echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                } else {
                                                    echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                }
                                            }
                                            ?>
                                            <!--<option value="1">New Text</option>-->
                                            <!--<option value="2">Old Text</option>-->
                                        </select>
                                        <span class="formerror" id="pf_cmpid_error"></span>
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label">PF Limit on Basic Sal</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pf_bssalary_limit" id="pf_bssalary_limit" class="form-control m-b-20" value="<?php echo $pf_statutory[0]->mxpf_basic_sal_limit; ?>">
                                        <span class="formerror" id="pf_bssalary_limit_error"></span>
                                        <?php
                                        if ($pf_statutory[0]->mxpf_basic_sal_limit_above == 1) {
                                            $chk_attr = "checked";
                                        } else {
                                            $chk_attr = "";
                                        }
                                        ?>
                                        <input type="checkbox" name="pf_eligibility_on_above_pf_limit" id="pf_eligibility_on_above_pf_limit" value="1" <?php echo $chk_attr; ?>>
                                        For above Basic Salary
                                        <a href="#" title="company Wish" data-toggle="popover" data-trigger="hover" data-content="if you check these field pf will cut on the above pf limit"><i class="la la-info"></i>Hint</a><br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PF Emp.Cont %</label>
                                    <div class="col-lg-9">
                                        <!--class percentinput-->
                                        <input type="text" name="pfempcnt" id="pfempcnt" class="form-control" placeholder="12%" value="<?php echo $pf_statutory[0]->mxpf_pf_emp_cont; ?>">
                                        <span class="formerror" id="pfempcnt_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PF Comp Cont %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pfcompcnt" id="pfcompcnt" class="form-control" placeholder="3.67%" value="<?php echo $pf_statutory[0]->mxpf_pf_comp_cont; ?>">
                                        <span class="formerror" id="pfcompcnt_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PF Pension Cont(EPS) %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pfpens_cont" id="pfpens_cont" class="form-control" placeholder="8.33%" value="<?php echo $pf_statutory[0]->mxpf_pf_pension_cont; ?>">
                                        <span class="formerror" id="pfpens_cont_error"></span>
                                    </div>
                                </div>






                            </div>

                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">EPS Wages Limit</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pf_epswageslimit" id="pf_epswageslimit" class="form-control m-b-20" placeholder="1500" value="<?php echo $pf_statutory[0]->mxpf_pf_eps_wages_limit; ?>">
                                        <span class="formerror" id="pf_epswageslimit_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">EDLI Wages Limit</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pf_edlisalarylimit" id="pf_edlisalarylimit" class="form-control m-b-20" placeholder="1500" value="<?php echo $pf_statutory[0]->mxpf_pf_edli_wages_limit; ?>">
                                        <span class="formerror" id="pf_edlisalarylimit_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">EDLI %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pf_edli" id="pf_edli" class="form-control" placeholder="0.5%" value="<?php echo $pf_statutory[0]->mxpf_pf_edli_perc; ?>">
                                        <span class="formerror" id="pf_edli_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PF Admin %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pfadmin" id="pfadmin" class="form-control" placeholder="0.5%" value="<?php echo $pf_statutory[0]->mxpf_pf_admin_perc; ?>">
                                        <span class="formerror" id="pfadmin_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label">Age limit</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pf_agelimit" id="pf_agelimit" class="form-control m-b-20" placeholder="Enter Age Limit" value="<?php echo $pf_statutory[0]->mxpf_pf_age_limit; ?>">
                                        <span class="formerror" id="pf_agelimit_error"></span>
                                    </div>
                                </div>
<?php // print_r($emptype); ?>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                    <div class="col-lg-9">
                                        <select class="select2" name="pf_emp_type[]" id="pf_emp_type" multiple style="width:100%">
                                            <!--<option value="0">Select Employement Type</option>-->
                                            <!--<option value="1">ON ROll</option>-->
                                            <!--<option value="1">Directors</option>-->
                                            <?php
                                            foreach ($emptype as $key => $emp_type) {
                                                $flag = 0;
                                                $sp = explode(',', $pf_statutory[0]->mxpf_emp_types);
                                                for ($i = 1; $i < count($sp); $i++) {
                                                    if ($sp[$i] == $emp_type->mxemp_ty_id) {
                                                        $flag = 1;
                                                        echo '<option value="' . $emp_type->mxemp_ty_id . '" selected>' . $emp_type->mxemp_ty_name . '</option>';
                                                    }
                                                }


                                                if ($flag == 0) {
                                                    echo '<option value="' . $emp_type->mxemp_ty_id . '" >' . $emp_type->mxemp_ty_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="formerror" id="pf_emp_type_error"></span>
                                    </div>
                                </div>





                                <!--                                                <div class="form-group row" style="margin-top: 10px;">
                                                                                    <label class="col-lg-3 col-form-label">Basic Salary</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="text" name="pf_bssalary" id="bssalary" class="form-control m-b-20">
                                                                                        <input type="radio" name="radio" value="1">
                                                                                        For above Basic Salary
                                                                                    </div>
                                                                                </div>-->

                            </div>
                        </div>



                        <hr>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row card mb-0 col-md-12">
                                    <p align="center">Employee Contrubution</p>
                                    <div class="radio" align="center">
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employee_cont_round_type" value="1" <?php echo ($pf_statutory[0]->mxpf_pf_emp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employee_cont_round_type" value="2" <?php echo ($pf_statutory[0]->mxpf_pf_emp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employee_cont_round_type" value="3" <?php echo ($pf_statutory[0]->mxpf_pf_emp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employee_cont_round_type" value="4" <?php echo ($pf_statutory[0]->mxpf_pf_emp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row card mb-0 col-md-12">
                                    <p align="center">Employer Contrubution</p>
                                    <div class="radio" align="center">
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employer_cont_round_type" value="1" <?php echo ($pf_statutory[0]->mxpf_pf_comp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employer_cont_round_type" value="2" <?php echo ($pf_statutory[0]->mxpf_pf_comp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employer_cont_round_type" value="3" <?php echo ($pf_statutory[0]->mxpf_pf_comp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_employer_cont_round_type" value="4" <?php echo ($pf_statutory[0]->mxpf_pf_comp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row card mb-0 col-md-12">
                                    <p align="center">pension Contrubution</p>
                                    <div class="radio" align="center">
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_pens_cont_round_type" value="1" <?php echo ($pf_statutory[0]->mxpf_pf_pension_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_pens_cont_round_type" value="2" <?php echo ($pf_statutory[0]->mxpf_pf_pension_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_pens_cont_round_type" value="3" <?php echo ($pf_statutory[0]->mxpf_pf_pension_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_pens_cont_round_type" value="4" <?php echo ($pf_statutory[0]->mxpf_pf_pension_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                    </div>
                                </div>
                            </div>





                            <div class="col-xl-6">
                                <div class="form-group row card mb-0">
                                    <p align="center">EDLI %</p>
                                    <div class="radio" align="center">
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_edli_perc_round_type" value="1" <?php echo ($pf_statutory[0]->mxpf_pf_edli_perc_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_edli_perc_round_type" value="2" <?php echo ($pf_statutory[0]->mxpf_pf_edli_perc_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_edli_perc_round_type" value="3" <?php echo ($pf_statutory[0]->mxpf_pf_edli_perc_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_edli_perc_round_type" value="4" <?php echo ($pf_statutory[0]->mxpf_pf_edli_perc_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row card mb-0">
                                    <p align="center">Admin %</p>
                                    <div class="radio" align="center">
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_admin_perc_round_type" value="1" <?php echo ($pf_statutory[0]->mxpf_pf_admin_perc_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_admin_perc_round_type" value="2" <?php echo ($pf_statutory[0]->mxpf_pf_admin_perc_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_admin_perc_round_type" value="3" <?php echo ($pf_statutory[0]->mxpf_pf_admin_perc_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="pf_admin_perc_round_type" value="4" <?php echo ($pf_statutory[0]->mxpf_pf_admin_perc_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
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
    <!--</div>-->




    <!--</div>-->
</div>
<!-- /PF Master Tab -->
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pf_statutory.js"></script>