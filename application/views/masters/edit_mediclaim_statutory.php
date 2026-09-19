<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">EDIT MEDICLAIM DETAILS</h4>
                </div>
                <?php // print_r($esi_statutory); ?>
                <div class="card-body">
                    <form id="mediclaim_statutory_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="med_affectdate" id="med_affectdate" class="form-control yearmonth" autocomplete="off" value="<?php echo date('m-Y',strtotime($mediclaim_statutory[0]->mxmediclaim_affect_from)); ?>">
                                                        <span class="formerror" id="med_affectdate_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 c    ol-form-label">Company</label>
                                                    <div class="col-lg-9">
                                                        <select class="select2 form-control" data-placeholder="Select Company" name="med_company_id" id="med_company_id" style="width: 100%;">
                                                            <option value="0">Select Company</option>
                                                            <?php
                                                            foreach ($cmpmaster as $companies) {
                                                                if($companies->mxcp_id == $mediclaim_statutory[0]->mxmediclaim_comp_id){
                                                                    echo "<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                                }else{
                                                                    echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                                }
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
                                                            <?php  foreach ($grades as $grade_data) { 
                                                                    $flag = 0;
                                                                    $sp = explode(',', $mediclaim_statutory[0]->mxmediclaim_applicable_grades);
                                                                    for ($i = 1; $i < count($sp); $i++) {
                                                                        if ($sp[$i] == $grade_data->mxgrd_id) {
                                                                                $flag = 1;
                                                                                echo '<option value="' . $grade_data->mxgrd_id . '" selected>' . $grade_data->mxgrd_name . '</option>';
                                                                        }
                                                                    }
                                                                    if ($flag == 0) {
                                                                        echo '<option value="' . $grade_data->mxgrd_id . '" >' . $grade_data->mxgrd_name . '</option>';
                                                                    }
                                                            }?>
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
                                                            <?php foreach ($emptype as $key => $emp_type) { 
                                                                    $flag = 0;
                                                                    $sp = explode(',', $mediclaim_statutory[0]->mxmediclaim_emp_types);
                                                                    for ($i = 1; $i < count($sp); $i++) {
                                                                        if ($sp[$i] == $emp_type->mxemp_ty_id) {
                                                                                $flag = 1;
                                                                                echo '<option value="' . $emp_type->mxemp_ty_id . '" selected>' . $emp_type->mxemp_ty_name . '</option>';
                                                                        }
                                                                    }
                                                                    if ($flag == 0) {
                                                                        echo '<option value="' . $emp_type->mxemp_ty_id . '" >' . $emp_type->mxemp_ty_name . '</option>';
                                                                    }
                                                            } ?>
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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/mediclaim_statutory.js"></script>
<?php // echo $gratuity_statutory[0]->mxgratuity_comp_id;exit; ?>
<script>
    var selected_comp_id = '<?php echo $mediclaim_statutory[0]->mxmediclaim_comp_id; ?>';
    var selected_div_id = '<?php echo $mediclaim_statutory[0]->mxmediclaim_div_id; ?>';
    

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_mediclaim_divisions(selected_comp_id, selected_div_id);
</script>