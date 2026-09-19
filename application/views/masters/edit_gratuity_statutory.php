<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">EDIT GRATUITY DETAILS</h4>
                </div>
                <?php // print_r($esi_statutory); ?>
                <div class="card-body">
                    <form id="gratuity_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="gratuity_affect_date" id="gratuity_affect_date" class="form-control yearmonth" autoomplete="off" value="<?php echo date('m-Y',strtotime($gratuity_statutory[0]->mxgratuity_affect_from)); ?>">
                                                        <span class="formerror" id="gratuity_affect_date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Company Name</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2" name="gratuity_cmp_id" id="gratuity_cmp_id" style="width:100%">
                                                            <option value="">-- Select Company --</option>
                                                            <?php foreach ($cmpmaster as $key => $cmpvalue) { 
                                                            if($cmpvalue->mxcp_id == $gratuity_statutory[0]->mxgratuity_comp_id){
                                                                echo "<option value='".$cmpvalue->mxcp_id."' selected>".$cmpvalue->mxcp_name."</option>";
                                                            }else{
                                                                 echo "<option value='".$cmpvalue->mxcp_id."'>".$cmpvalue->mxcp_name."</option>";
                                                            }
                                                            ?>
                                                                
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
                                                            <?php foreach ($emptype as $key => $emp_type) { 
                                                                    $flag = 0;
                                                                    $sp = explode(',', $gratuity_statutory[0]->mxgratuity_emp_types);
                                                                    for ($i = 1; $i < count($sp); $i++) {
                                                                        if ($sp[$i] == $emp_type->mxemp_ty_id) {
                                                                                $flag = 1;
                                                                                echo '<option value="' . $emp_type->mxemp_ty_id . '" selected>' . $emp_type->mxemp_ty_name . '</option>';
                                                                        }
                                                                    }
                                                                    if ($flag == 0) {
                                                                        echo '<option value="' . $emp_type->mxemp_ty_id . '" >' . $emp_type->mxemp_ty_name . '</option>';
                                                                    }
                                                                
                                                            ?>
                                                            
                                                                
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
                                                        <input type="text" class="form-control" placeholder="58" name="gratuity_age_limit" id="gratuity_age_limit" value="<?php echo $gratuity_statutory[0]->mxgratuity_age_limit; ?>">
                                                        <span class="formerror" id="gratuity_age_limit_error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Gratuity Service Limit</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" placeholder="eg : 5" name="gratuity_service_limit" id="gratuity_service_limit" value="<?php echo $gratuity_statutory[0]->mxgratuity_service_limit; ?>">
                                                        <span class="formerror" id="gratuity_service_limit_error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Max Gratuity Amount</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" placeholder="2000000" name="max_gratuity_limit" id="max_gratuity_limit" value="<?php echo $gratuity_statutory[0]->mxgratuity_max_amount; ?>">
                                                        <span class="formerror" id="max_gratuity_limit_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="margin-top: 10px;">
                                                    <label class="col-lg-3 col-form-label">Gratuity Per Month %</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" placeholder="4.81" name="gratuity_per_month_perc" id="gratuity_per_month_perc" value="<?php echo $gratuity_statutory[0]->mxgratuity_month_wise_perc; ?>">
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
                                                            <input type="radio" name="gratuity_perc_round" value="1" <?php echo ($gratuity_statutory[0]->mxgratuity_month_wise_perc_round_type == 1) ? "checked" : "" ?>> Above
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="2" <?php echo ($gratuity_statutory[0]->mxgratuity_month_wise_perc_round_type == 2) ? "checked" : "" ?>> Middle
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="3" <?php echo ($gratuity_statutory[0]->mxgratuity_month_wise_perc_round_type == 3) ? "checked" : "" ?>> Below
                                                            <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i></a><br>
                                                        </label>
                                                        <label style=" margin: 0 2px 0;">
                                                            <input type="radio" name="gratuity_perc_round" value="4" <?php echo ($gratuity_statutory[0]->mxgratuity_month_wise_perc_round_type == 4) ? "checked" : "" ?>> No Rounding
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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/gratuity_statutory.js"></script>
<?php // echo $gratuity_statutory[0]->mxgratuity_comp_id;exit; ?>
<script>
    var selected_comp_id = '<?php echo $gratuity_statutory[0]->mxgratuity_comp_id; ?>';
    var selected_div_id = '<?php echo $gratuity_statutory[0]->mxgratuity_div_id; ?>';
    

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_gratuity_divisions(selected_comp_id, selected_div_id);
</script>