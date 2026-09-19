<div class="page-wrapper">
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
                                        <input type="text" name="lwf_affectdate" id="lwf_affectdate" class="form-control yearmonth" value="<?php echo date('m-Y', strtotime($lwf_statutory[0]->mxlwf_affect_from)) ?>" autocomplete="off">
                                        <span class="formerror" id="lwf_affectdate_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Company</label>
                                    <div class="col-lg-9">
                                        <select class="select2 form-control"  data-placeholder="Select Company" name="lwf_company_id" id="lwf_company_id" style="width: 100%;">
                                            <option value="0">Select Company</option>
                                            <?php
                                            foreach ($cmpmaster as $companies) {
                                                if ($lwf_statutory[0]->mxlwf_comp_id == $companies->mxcp_id) {
                                                    echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                } else {
                                                    echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                }
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
                                        <select class="select2 form-control"  data-placeholder="Select Division" name="lwf_div_id" id="lwf_div_id" style="width: 100%;">
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

                                        </select>

                                    </div>
                                    <span class="formerror" id="lwf_state_id_error"></span>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Branch</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" name="lwf_branch_id" id="lwf_branch_id" style="width: 100%;">
                                            <option value="">Select Branch</option>

                                        </select>
                                        <span class="formerror" id="lwf_branch_id_error"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Deduct Date</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="lwf_deduct_date" id="lwf_deduct_date" class="form-control yearmonth" value="<?php echo date('m-Y', strtotime($lwf_statutory[0]->mxlwf_deduct_date)) ?>" autocomplete="off">
                                        <span class="formerror" id="lwf_deduct_date_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LWF Emp.Cont %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="lwf_emp_cont" id="lwf_emp_cont" class="form-control" placeholder="12" value="<?php echo $lwf_statutory[0]->mxlwf_emp_contr ?>">
                                        <span class="formerror" id="lwf_emp_cont_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LWF Comp Cont %</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="lwf_comp_cont" id="lwf_comp_cont" class="form-control" placeholder="3.67" value="<?php echo $lwf_statutory[0]->mxlwf_comp_contr ?>">
                                        <span class="formerror" id="lwf_comp_cont_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">LWF No</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" placeholder="Enter LWF No" name="lwf_no" id="lwf_no" value="<?php echo $lwf_statutory[0]->mxlwf_lwf_no ?>">
                                        <span class="formerror" id="lwf_no_error"></span>
                                    </div>
                                </div>
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
                                                $sp = explode(',', $lwf_statutory[0]->mxlwf_emp_types);
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
                                        <span class="formerror" id="lwf_emp_type_error"></span>
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
                                            <input type="radio" name="lwf_employee_cont_round" value="1" <?php echo ($lwf_statutory[0]->mxlwf_emp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employee_cont_round" value="2" <?php echo ($lwf_statutory[0]->mxlwf_emp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employee_cont_round" value="3" <?php echo ($lwf_statutory[0]->mxlwf_emp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employee_cont_round" value="4" <?php echo ($lwf_statutory[0]->mxlwf_emp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
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
                                            <input type="radio" name="lwf_employer_cont_round" value="1" <?php echo ($lwf_statutory[0]->mxlwf_comp_cont_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employer_cont_round" value="2" <?php echo ($lwf_statutory[0]->mxlwf_comp_cont_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employer_cont_round" value="3" <?php echo ($lwf_statutory[0]->mxlwf_comp_cont_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="lwf_employer_cont_round" value="4" <?php echo ($lwf_statutory[0]->mxlwf_comp_cont_round_type == 4) ? "checked" : "" ?>> No Rounding
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                    </div>
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

<script src="<?php echo base_url(); ?>/assets/js/formsjs/lwf_statutory.js"></script>
<?php // echo $esi_statutory[0]->mxesi_comp_id;exit; ?>
<script>
    var selected_comp_id = '<?php echo $lwf_statutory[0]->mxlwf_comp_id ?>';
    var selected_div_id = '<?php echo $lwf_statutory[0]->mxlwf_div_id ?>';
    var selected_state_id = '<?php echo $lwf_statutory[0]->mxlwf_state_id ?>';
    var selected_branch_id = '<?php echo $lwf_statutory[0]->mxlwf_branch_id ?>';

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_lwf_divisions(selected_comp_id, selected_div_id)
    lwf_load_states(selected_comp_id, selected_div_id, selected_state_id);
    lwf_load_branches(selected_comp_id, selected_div_id,selected_state_id, selected_branch_id);



</script>