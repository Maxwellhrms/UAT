
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">ENTER ESI DETAILS</h4>
                </div>
                <?php // print_r($esi_statutory); ?>
                <div class="card-body">
                    <form id="esi_statutory_form">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="esi_affectdate" id="esi_affectdate" class="form-control yearmonth" value="<?php echo date('m-Y', strtotime($esi_statutory[0]->mxesi_affect_from)); ?>" autocomplete="off">
                                        <span class="formerror" id="esi_affectdate_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Company</label>
                                    <div class="col-lg-9">
                                        <select class="select2 form-control"  data-placeholder="Select Company" name="esi_company_id" id="esi_company_id" style="width: 100%;">
                                            <option value="0">Select Company</option>
                                            <?php
                                            foreach ($cmpmaster as $companies) {
                                                if ($companies->mxcp_id == $esi_statutory[0]->mxesi_comp_id) {

                                                    echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                } else {
                                                    echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                }
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
                                        <select class="select2 form-control"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
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
                                            <?php // foreach ($states as $key => $stvalue) { ?>
                                                <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state     ?>"><?php echo $stvalue->mxst_state ?></option>-->
                                            <?php // } ?>
                                        </select>
                                    </div>
                                    <span class="formerror" id="esi_state_id_error"></span>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Branch</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" name="esi_branch_id" id="esi_branch_id">
                                            <option value="0">Select Branch</option>
                                            <?php // foreach ($branchmaster as $key => $brvalue) { ?>
                                                <!--<option value="<?php // echo $brvalue->mxb_id     ?>"><?php echo $brvalue->mxb_name ?></option>-->
                                            <?php // } ?>
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
                                        <input type="text" class="form-control m-b-20" name="esi_code" id="esi_code" value="<?php echo $esi_statutory[0]->mxesi_esi_code; ?>">
                                        <span class="formerror" id="esi_code_error"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Gross Salary Limit</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control m-b-20" name="gross_sal_limit" id="gross_sal_limit" value="<?php echo $esi_statutory[0]->mxesi_gross_sal_limit; ?>">
                                        <span class="formerror" id="gross_sal_limit_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">ESI Emp.Cont %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="esi_emp_cont" id="esi_emp_cont" class="form-control" placeholder="0.75%" value="<?php echo $esi_statutory[0]->mxesi_emp_cont; ?>">
                                        <span class="formerror" id="esi_emp_cont_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">ESI Comp Cont %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="esi_comp_cont" id="esi_comp_cont" class="form-control" placeholder="3.25%" value="<?php echo $esi_statutory[0]->mxesi_comp_cont; ?>">
                                        <span class="formerror" id="esi_comp_cont_error"></span>
                                    </div>
                                </div>
                                <?php // print_r($esi_statutory[0]->mxesi_emp_types);?>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                    <div class="col-lg-9">
                                        <select class="select2" name="esi_emp_type[]" id="esi_emp_type" multiple style="width:100%">
                                            <!--<option value="0">Select Employement Type</option>-->
                                            <!--<option value="1">ON ROll</option>-->
                                            <!--<option value="1">Directors</option>-->
                                            <?php
                                            foreach ($emptype as $key => $emp_type) {
                                                $flag = 0;
                                                $sp = explode(',', $esi_statutory[0]->mxesi_emp_types);
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
                                            <input type="radio" name="esi_employee_cont_round" value="1" <?php echo ($esi_statutory[0]->mxesi_emp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employee_cont_round" value="2" <?php echo ($esi_statutory[0]->mxesi_emp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employee_cont_round" value="3" <?php echo ($esi_statutory[0]->mxesi_emp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employee_cont_round" value="4" <?php echo ($esi_statutory[0]->mxesi_emp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
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
                                            <input type="radio" name="esi_employer_cont_round" value="1" <?php echo ($esi_statutory[0]->mxesi_comp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employer_cont_round" value="2" <?php echo ($esi_statutory[0]->mxesi_comp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employer_cont_round" value="3" <?php echo ($esi_statutory[0]->mxesi_comp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="esi_employer_cont_round" value="4" <?php echo ($esi_statutory[0]->mxesi_comp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
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

<script src="<?php echo base_url(); ?>/assets/js/formsjs/esi_statutory.js"></script>
<?php // echo $esi_statutory[0]->mxesi_comp_id;exit; ?>
<script>
    var selected_comp_id = '<?php echo $esi_statutory[0]->mxesi_comp_id ?>';
    var selected_div_id = '<?php echo $esi_statutory[0]->mxesi_div_id ?>';
    var selected_state_id = '<?php echo $esi_statutory[0]->mxesi_state_id ?>';
    var selected_branch_id = '<?php echo $esi_statutory[0]->mxesi_branch_id ?>';

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_esi_divisions(selected_comp_id, selected_div_id);
    load_esi_states(selected_comp_id, selected_div_id, selected_state_id)
    load_esi_branches(selected_comp_id, selected_div_id, selected_state_id, selected_branch_id)




</script>