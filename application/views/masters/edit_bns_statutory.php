
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">ENTER BONUS DETAILS</h4>
                </div>
                <?php // print_r($bns_statutory);?>
                <div class="card-body">
                    <form id="bns_statutory_form">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="bns_affect_date" id="bns_affect_date" class="form-control yearmonth" value="<?php echo date('m-Y', strtotime($bns_statutory[0]->mxbns_affect_from)) ?>" autocomplete="off">
                                        <span class="formerror" id="bns_affect_date_error"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                    <div class="col-lg-9">
                                        <select class="select2" name="bns_cmp_id" id="bns_cmp_id" style="width:100%">
                                            <option value="">-- Select Company --</option>
                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                <?php
                                                if ($bns_statutory[0]->mxbns_comp_id == $cmpvalue->mxcp_id) {
                                                    echo "<option value='" . $cmpvalue->mxcp_id . "' selected>" . $cmpvalue->mxcp_name . "</option>";
                                                } else {
                                                    echo "<option value='" . $cmpvalue->mxcp_id . "'>" . $cmpvalue->mxcp_name . "</option>";
                                                }
                                                ?>

                                            <?php } ?>
                                        </select>
                                        <span class="formerror" id="bns_cmp_id_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Division</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control"  data-placeholder="Select Division" name="bns_div_id" id="bns_div_id" style="width: 100%;">
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
                                        <select class="select2" name="bns_emp_type[]" id="bns_emp_type" multiple style="width:100%">
                                            <!--<option value="">Select Employement Type</option>-->
                                            <!--<option value="1" selected>ON ROll</option>-->
                                            
                                                <?php foreach ($emptype as $key => $emp_type) { 
                                                    $flag = 0;
                                                    $sp = explode(',', $bns_statutory[0]->mxbns_employement_type);
                                                    for ($i = 1; $i < count($sp); $i++) {
                                                        if ($sp[$i] == $emp_type->mxemp_ty_id) {
                                                            $flag = 1;
                                                            echo '<option value="' . $emp_type->mxemp_ty_id . '" selected>' . $emp_type->mxemp_ty_name . '</option>';
                                                        }
                                                    }
                                                    if($flag ==0){
                                                            echo '<option value="' . $emp_type->mxemp_ty_id . '" >' . $emp_type->mxemp_ty_name . '</option>';
                                                        
                                                    }


                                                 } ?>
                                            
                                        </select>
                                        <span class="formerror" id="bns_emp_type_error"></span>
                                    </div>
                                </div>



                            </div>

                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bonus Applicability</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" placeholder="21000" name="bns_applicability" id="bns_applicability" value="<?php echo $bns_statutory[0]->mxbns_bonus_applicability ?>">
                                        <span class="formerror" id="bns_applicability_error"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bonus %</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" placeholder="12" name="bns_perc" id="bns_perc" value="<?php echo $bns_statutory[0]->mxbns_bonus_perc ?>">
                                        <span class="formerror" id="bns_perc_error"></span>
                                    </div>
                                </div>


                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label">Max Bonus Limit</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" placeholder="7000" name="max_bns_limit" id="max_bns_limit" value="<?php echo $bns_statutory[0]->mxbns_max_bns ?>">
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
                                            <input type="radio" name="bns_perc_round" value="1" <?php echo ($bns_statutory[0]->mxbns_bonus_perc_round_type == 1) ? "checked" : "" ?>> Above
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="bns_perc_round" value="2" <?php echo ($bns_statutory[0]->mxbns_bonus_perc_round_type == 2) ? "checked" : "" ?>> Middle
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="bns_perc_round" value="3" <?php echo ($bns_statutory[0]->mxbns_bonus_perc_round_type == 3) ? "checked" : "" ?>> Below
                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                        </label>
                                        <label style=" margin: 0 2px 0;">
                                            <input type="radio" name="bns_perc_round" value="4" <?php echo ($bns_statutory[0]->mxbns_bonus_perc_round_type == 4) ? "checked" : "" ?>> No Rounding
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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/bonus_statutory.js"></script>
<script>
    var selected_comp_id = '<?php echo $bns_statutory[0]->mxbns_comp_id ?>';
    var selected_div_id = '<?php echo $bns_statutory[0]->mxbns_div_id ?>';

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_bns_divisions(selected_comp_id, selected_div_id)




</script>
