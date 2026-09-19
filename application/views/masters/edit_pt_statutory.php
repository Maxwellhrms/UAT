<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">ENTER PT DETAILS</h4>
                </div>
                <?php
//                echo '<pre>';
                // print_r($pt_statutory);                
//                print_r($pt_slab_statutory); 
                ?>
                <div class="card-body">
                    <form id="pt_statutory_form">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Affect Date</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pt_affectdate" id="pt_affectdate" class="form-control yearmonth" value = "<?php echo date('m-Y', strtotime($pt_statutory[0]->mxpt_affect_from)); ?>" autocomplete="off">
                                        <span class="formerror" id="pt_affectdate_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Division</label>
                                    <div class="col-lg-9">
                                        <select class="select2 form-control"  data-placeholder="Select Division" name="pt_div_id" id="pt_div_id" style="width: 100%;">
                                            <option value="0">Select Division</option>
                                        </select>
                                        <span class="formerror" id="pt_div_id_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">State</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select2" name="pt_state_id" id="pt_state_id" style="width: 100%;">
                                            <option value="0">Select State</option>
                                        </select>                                                        
                                        <span class="formerror" id="pt_state_id_error"></span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Branch</label>
                                    <div class="col-lg-9">
                                        <select class="select2" name="pt_branch_id" id="pt_branch_id" style="width: 100%;">
                                            <option value="0">Select Branch</option>
                                        </select>
                                        <span class="formerror" id="pt_branch_id_error"></span>
                                    </div>
                                </div>



                            </div>



                            <div class="col-xl-6">

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Company</label>
                                    <div class="col-lg-9">
                                        <select class="select2 form-control"  data-placeholder="Select Company" name="pt_company_id" id="pt_company_id" style="width: 100%;">
                                            <option value="0">Select Company</option>
                                            <?php
                                            foreach ($cmpmaster as $companies) {
                                                if ($companies->mxcp_id == $pt_statutory[0]->mxpt_comp_id) {
                                                    echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                } else {
                                                    echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <span class="formerror" id="pt_company_id_error"></span>
                                </div>
                                <div class="form-group row" style="margin-top: 10px;">
                                    <label class="col-lg-3 col-form-label">PT in No</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="pt_in_no" id="pt_in_no" class="form-control m-b-20" value="<?php echo $pt_statutory[0]->mxpt_pt_in_no; ?>">
                                        <span class="formerror" id="pt_in_no_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Select Emp Type</label>
                                    <div class="col-lg-9">
                                        <select class="select2" name="pt_emp_type[]" id="pt_emp_type" multiple style="width:100%">
                                            <?php
                                            foreach ($emptype as $key => $emp_type) {
                                                $flag = 0;
                                                $sp = explode(',', $pt_statutory[0]->mxpt_emp_types);
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
                                        <span class="formerror" id="pt_emp_type_error"></span>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PT Type:</label>
                                    <div class="col-lg-9">
                                        <select class="select select2" name="pt_type_id" id="pt_type_id" style="width:100%">
                                            <option value="0">Select PT Type</option>
                                            <option value="1" <?php echo ($pt_statutory[0]->mxpt_pt_type == 1) ? "selected" : ""; ?>>Monthly</option>
                                            <option value="2" <?php echo ($pt_statutory[0]->mxpt_pt_type == 2) ? "selected" : ""; ?>>Quaterly</option>
                                            <option value="3" <?php echo ($pt_statutory[0]->mxpt_pt_type == 3) ? "selected" : ""; ?>>Half Yearly</option>
                                            <option value="4" <?php echo ($pt_statutory[0]->mxpt_pt_type == 4) ? "selected" : ""; ?>>Yearly</option>
                                            <?php // foreach ($states as $key => $stvalue) {   ?>
                                                <!--<option value="<?php // echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state         ?>"><?php // echo $stvalue->mxst_state         ?></option>-->
                                            <?php // }  ?>
                                        </select>
                                    </div>
                                    <span class="formerror" id="pt_type_id_error"></span>
                                </div>


                            </div>
                        </div>

                        <hr>
                        <?php
//                        echo $pt_slab_statutory[1]->mxpt_slb_end_range;exit;
                        if ($pt_statutory[0]->mxpt_pt_type == 1) {//---->monthly
                            if (isset($pt_slab_statutory[0]->mxpt_slb_start_range) && $pt_slab_statutory[0]->mxpt_slb_start_range != "") {
                                $m_y_from_1 = $pt_slab_statutory[0]->mxpt_slb_start_range;
                                $m_y_to_1 = $pt_slab_statutory[0]->mxpt_slb_end_range;
                                $m_y_amnt_1 = $pt_slab_statutory[0]->mxpt_slb_amount;
                            } else {
                                $m_y_from_1 = "";
                                $m_y_to_1 = "";
                                $m_y_amnt_1 = "";
                            }
                            if (isset($pt_slab_statutory[1]->mxpt_slb_start_range) && $pt_slab_statutory[1]->mxpt_slb_start_range != "") {
                                $m_y_from_2 = $pt_slab_statutory[1]->mxpt_slb_start_range;
                                $m_y_to_2 = $pt_slab_statutory[1]->mxpt_slb_end_range;
                                $m_y_amnt_2 = $pt_slab_statutory[1]->mxpt_slb_amount;
                            } else {
                                $m_y_from_2 = "";
                                $m_y_to_2 = "";
                                $m_y_amnt_2 = "";
                            }
                            if (isset($pt_slab_statutory[2]->mxpt_slb_start_range) && $pt_slab_statutory[2]->mxpt_slb_start_range != "") {
                                $m_y_from_3 = $pt_slab_statutory[2]->mxpt_slb_start_range;
                                $m_y_to_3 = $pt_slab_statutory[2]->mxpt_slb_end_range;
                                $m_y_amnt_3 = $pt_slab_statutory[2]->mxpt_slb_amount;
                            } else {
                                $m_y_from_3 = "";
                                $m_y_to_3 = "";
                                $m_y_amnt_3 = "";
                            }
                            if (isset($pt_slab_statutory[3]->mxpt_slb_start_range) && $pt_slab_statutory[3]->mxpt_slb_start_range != "") {
                                $m_y_from_4 = $pt_slab_statutory[3]->mxpt_slb_start_range;
                                $m_y_to_4 = $pt_slab_statutory[3]->mxpt_slb_end_range;
                                $m_y_amnt_4 = $pt_slab_statutory[3]->mxpt_slb_amount;
                            } else {
                                $m_y_from_4 = "";
                                $m_y_to_4 = "";
                                $m_y_amnt_4 = "";
                            }
                            if (isset($pt_slab_statutory[4]->mxpt_slb_start_range) && $pt_slab_statutory[4]->mxpt_slb_start_range != "") {
                                $m_y_from_5 = $pt_slab_statutory[4]->mxpt_slb_start_range;
                                $m_y_to_5 = $pt_slab_statutory[4]->mxpt_slb_end_range;
                                $m_y_amnt_5 = $pt_slab_statutory[4]->mxpt_slb_amount;
                            } else {
                                $m_y_from_5 = "";
                                $m_y_to_5 = "";
                                $m_y_amnt_5 = "";
                            }
                            if (isset($pt_slab_statutory[5]->mxpt_slb_start_range) && $pt_slab_statutory[5]->mxpt_slb_start_range != "") {
                                $m_y_from_6 = $pt_slab_statutory[5]->mxpt_slb_start_range;
                                $m_y_to_6 = $pt_slab_statutory[5]->mxpt_slb_end_range;
                                $m_y_amnt_6 = $pt_slab_statutory[5]->mxpt_slb_amount;
                            } else {
                                $m_y_from_6 = "";
                                $m_y_to_6 = "";
                                $m_y_amnt_6 = "";
                            }
                        } else if ($pt_statutory[0]->mxpt_pt_type == 2) {//------>Quaterly
                            //-------GET SEPERATE ARRAYS
                            $first_quarter_array = [];
                            $second_quarter_array = [];
                            $third_quarter_array = [];
                            $fourth_quarter_array = [];
                            for ($i = 0; $i < count($pt_slab_statutory); $i++) {
                                if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 1) {//---->Q1
                                    $first_quarter_array[] = $pt_slab_statutory[$i];
                                } else if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 2) {//---->Q2
                                    $second_quarter_array[] = $pt_slab_statutory[$i];
                                } else if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 3) {//---->Q3
                                    $third_quarter_array[] = $pt_slab_statutory[$i];
                                } else if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 4) {//---->Q4
                                    $fourth_quarter_array[] = $pt_slab_statutory[$i];
                                }
//                                print_r($pt_slab_stat);exit;
                            }
//                            print_r($first_half_array);
                            //-------END GET SEPERATE ARRAYS
                            //------Q1
                            if (isset($first_quarter_array[0]->mxpt_slb_start_range) && $first_quarter_array[0]->mxpt_slb_start_range != "") {
                                $q1_from_1 = $first_quarter_array[0]->mxpt_slb_start_range;
                                $q1_to_1 = $first_quarter_array[0]->mxpt_slb_end_range;
                                $q1_amnt_1 = $first_quarter_array[0]->mxpt_slb_amount;
                            } else {
                                $q1_from_1 = "";
                                $q1_to_1 = "";
                                $q1_amnt_1 = "";
                            }
                            if (isset($first_quarter_array[1]->mxpt_slb_start_range) && $first_quarter_array[1]->mxpt_slb_start_range != "") {
                                $q1_from_2 = $first_quarter_array[1]->mxpt_slb_start_range;
                                $q1_to_2 = $first_quarter_array[1]->mxpt_slb_end_range;
                                $q1_amnt_2 = $first_quarter_array[1]->mxpt_slb_amount;
                            } else {
                                $q1_from_2 = "";
                                $q1_to_2 = "";
                                $q1_amnt_2 = "";
                            }
                            if (isset($first_quarter_array[2]->mxpt_slb_start_range) && $first_quarter_array[2]->mxpt_slb_start_range != "") {
                                $q1_from_3 = $first_quarter_array[2]->mxpt_slb_start_range;
                                $q1_to_3 = $first_quarter_array[2]->mxpt_slb_end_range;
                                $q1_amnt_3 = $first_quarter_array[2]->mxpt_slb_amount;
                            } else {
                                $q1_from_3 = "";
                                $q1_to_3 = "";
                                $q1_amnt_3 = "";
                            }
                            if (isset($first_quarter_array[3]->mxpt_slb_start_range) && $first_quarter_array[3]->mxpt_slb_start_range != "") {
                                $q1_from_4 = $first_quarter_array[3]->mxpt_slb_start_range;
                                $q1_to_4 = $first_quarter_array[3]->mxpt_slb_end_range;
                                $q1_amnt_4 = $first_quarter_array[3]->mxpt_slb_amount;
                            } else {
                                $q1_from_4 = "";
                                $q1_to_4 = "";
                                $q1_amnt_4 = "";
                            }
                            if (isset($first_quarter_array[4]->mxpt_slb_start_range) && $first_quarter_array[4]->mxpt_slb_start_range != "") {
                                $q1_from_5 = $first_quarter_array[4]->mxpt_slb_start_range;
                                $q1_to_5 = $first_quarter_array[4]->mxpt_slb_end_range;
                                $q1_amnt_5 = $first_quarter_array[4]->mxpt_slb_amount;
                            } else {
                                $q1_from_5 = "";
                                $q1_to_5 = "";
                                $q1_amnt_5 = "";
                            }
                            if (isset($first_quarter_array[5]->mxpt_slb_start_range) && $first_quarter_array[5]->mxpt_slb_start_range != "") {
                                $q1_from_6 = $first_quarter_array[5]->mxpt_slb_start_range;
                                $q1_to_6 = $first_quarter_array[5]->mxpt_slb_end_range;
                                $q1_amnt_6 = $first_quarter_array[5]->mxpt_slb_amount;
                            } else {
                                $q1_from_6 = "";
                                $q1_to_6 = "";
                                $q1_amnt_6 = "";
                            }
                            //------END Q1
                            //------Q2
                            if (isset($second_quarter_array[0]->mxpt_slb_start_range) && $second_quarter_array[0]->mxpt_slb_start_range != "") {
                                $q2_from_1 = $second_quarter_array[0]->mxpt_slb_start_range;
                                $q2_to_1 = $second_quarter_array[0]->mxpt_slb_end_range;
                                $q2_amnt_1 = $second_quarter_array[0]->mxpt_slb_amount;
                            } else {
                                $q2_from_1 = "";
                                $q2_to_1 = "";
                                $q2_amnt_1 = "";
                            }
                            if (isset($second_quarter_array[1]->mxpt_slb_start_range) && $second_quarter_array[1]->mxpt_slb_start_range != "") {
                                $q2_from_2 = $second_quarter_array[1]->mxpt_slb_start_range;
                                $q2_to_2 = $second_quarter_array[1]->mxpt_slb_end_range;
                                $q2_amnt_2 = $second_quarter_array[1]->mxpt_slb_amount;
                            } else {
                                $q2_from_2 = "";
                                $q2_to_2 = "";
                                $q2_amnt_2 = "";
                            }
                            if (isset($second_quarter_array[2]->mxpt_slb_start_range) && $second_quarter_array[2]->mxpt_slb_start_range != "") {
                                $q2_from_3 = $second_quarter_array[2]->mxpt_slb_start_range;
                                $q2_to_3 = $second_quarter_array[2]->mxpt_slb_end_range;
                                $q2_amnt_3 = $second_quarter_array[2]->mxpt_slb_amount;
                            } else {
                                $q2_from_3 = "";
                                $q2_to_3 = "";
                                $q2_amnt_3 = "";
                            }
                            if (isset($second_quarter_array[3]->mxpt_slb_start_range) && $second_quarter_array[3]->mxpt_slb_start_range != "") {
                                $q2_from_4 = $second_quarter_array[3]->mxpt_slb_start_range;
                                $q2_to_4 = $second_quarter_array[3]->mxpt_slb_end_range;
                                $q2_amnt_4 = $second_quarter_array[3]->mxpt_slb_amount;
                            } else {
                                $q2_from_4 = "";
                                $q2_to_4 = "";
                                $q2_amnt_4 = "";
                            }
                            if (isset($second_quarter_array[4]->mxpt_slb_start_range) && $second_quarter_array[4]->mxpt_slb_start_range != "") {
                                $q2_from_5 = $second_quarter_array[4]->mxpt_slb_start_range;
                                $q2_to_5 = $second_quarter_array[4]->mxpt_slb_end_range;
                                $q2_amnt_5 = $second_quarter_array[4]->mxpt_slb_amount;
                            } else {
                                $q2_from_5 = "";
                                $q2_to_5 = "";
                                $q2_amnt_5 = "";
                            }
                            if (isset($second_quarter_array[5]->mxpt_slb_start_range) && $second_quarter_array[5]->mxpt_slb_start_range != "") {
                                $q2_from_6 = $second_quarter_array[5]->mxpt_slb_start_range;
                                $q2_to_6 = $second_quarter_array[5]->mxpt_slb_end_range;
                                $q2_amnt_6 = $second_quarter_array[5]->mxpt_slb_amount;
                            } else {
                                $q2_from_6 = "";
                                $q2_to_6 = "";
                                $q2_amnt_6 = "";
                            }
                            //------END Q2
                            //------Q3
                            if (isset($third_quarter_array[0]->mxpt_slb_start_range) && $third_quarter_array[0]->mxpt_slb_start_range != "") {
                                $q3_from_1 = $third_quarter_array[0]->mxpt_slb_start_range;
                                $q3_to_1 = $third_quarter_array[0]->mxpt_slb_end_range;
                                $q3_amnt_1 = $third_quarter_array[0]->mxpt_slb_amount;
                            } else {
                                $q3_from_1 = "";
                                $q3_to_1 = "";
                                $q3_amnt_1 = "";
                            }
                            if (isset($third_quarter_array[1]->mxpt_slb_start_range) && $third_quarter_array[1]->mxpt_slb_start_range != "") {
                                $q3_from_2 = $third_quarter_array[1]->mxpt_slb_start_range;
                                $q3_to_2 = $third_quarter_array[1]->mxpt_slb_end_range;
                                $q3_amnt_2 = $third_quarter_array[1]->mxpt_slb_amount;
                            } else {
                                $q3_from_2 = "";
                                $q3_to_2 = "";
                                $q3_amnt_2 = "";
                            }
                            if (isset($third_quarter_array[2]->mxpt_slb_start_range) && $third_quarter_array[2]->mxpt_slb_start_range != "") {
                                $q3_from_3 = $third_quarter_array[2]->mxpt_slb_start_range;
                                $q3_to_3 = $third_quarter_array[2]->mxpt_slb_end_range;
                                $q3_amnt_3 = $third_quarter_array[2]->mxpt_slb_amount;
                            } else {
                                $q3_from_3 = "";
                                $q3_to_3 = "";
                                $q3_amnt_3 = "";
                            }
                            if (isset($third_quarter_array[3]->mxpt_slb_start_range) && $third_quarter_array[3]->mxpt_slb_start_range != "") {
                                $q3_from_4 = $third_quarter_array[3]->mxpt_slb_start_range;
                                $q3_to_4 = $third_quarter_array[3]->mxpt_slb_end_range;
                                $q3_amnt_4 = $third_quarter_array[3]->mxpt_slb_amount;
                            } else {
                                $q3_from_4 = "";
                                $q3_to_4 = "";
                                $q3_amnt_4 = "";
                            }
                            if (isset($third_quarter_array[4]->mxpt_slb_start_range) && $third_quarter_array[4]->mxpt_slb_start_range != "") {
                                $q3_from_5 = $third_quarter_array[4]->mxpt_slb_start_range;
                                $q3_to_5 = $third_quarter_array[4]->mxpt_slb_end_range;
                                $q3_amnt_5 = $third_quarter_array[4]->mxpt_slb_amount;
                            } else {
                                $q3_from_5 = "";
                                $q3_to_5 = "";
                                $q3_amnt_5 = "";
                            }
                            if (isset($third_quarter_array[5]->mxpt_slb_start_range) && $third_quarter_array[5]->mxpt_slb_start_range != "") {
                                $q3_from_6 = $third_quarter_array[5]->mxpt_slb_start_range;
                                $q3_to_6 = $third_quarter_array[5]->mxpt_slb_end_range;
                                $q3_amnt_6 = $third_quarter_array[5]->mxpt_slb_amount;
                            } else {
                                $q3_from_6 = "";
                                $q3_to_6 = "";
                                $q3_amnt_6 = "";
                            }
                            //------END Q3
                            //------Q4
                            if (isset($fourth_quarter_array[0]->mxpt_slb_start_range) && $fourth_quarter_array[0]->mxpt_slb_start_range != "") {
                                $q4_from_1 = $fourth_quarter_array[0]->mxpt_slb_start_range;
                                $q4_to_1 = $fourth_quarter_array[0]->mxpt_slb_end_range;
                                $q4_amnt_1 = $fourth_quarter_array[0]->mxpt_slb_amount;
                            } else {
                                $q4_from_1 = "";
                                $q4_to_1 = "";
                                $q4_amnt_1 = "";
                            }
                            if (isset($fourth_quarter_array[1]->mxpt_slb_start_range) && $fourth_quarter_array[1]->mxpt_slb_start_range != "") {
                                $q4_from_2 = $fourth_quarter_array[1]->mxpt_slb_start_range;
                                $q4_to_2 = $fourth_quarter_array[1]->mxpt_slb_end_range;
                                $q4_amnt_2 = $fourth_quarter_array[1]->mxpt_slb_amount;
                            } else {
                                $q4_from_2 = "";
                                $q4_to_2 = "";
                                $q4_amnt_2 = "";
                            }
                            if (isset($fourth_quarter_array[2]->mxpt_slb_start_range) && $fourth_quarter_array[2]->mxpt_slb_start_range != "") {
                                $q4_from_3 = $fourth_quarter_array[2]->mxpt_slb_start_range;
                                $q4_to_3 = $fourth_quarter_array[2]->mxpt_slb_end_range;
                                $q4_amnt_3 = $fourth_quarter_array[2]->mxpt_slb_amount;
                            } else {
                                $q4_from_3 = "";
                                $q4_to_3 = "";
                                $q4_amnt_3 = "";
                            }
                            if (isset($fourth_quarter_array[3]->mxpt_slb_start_range) && $fourth_quarter_array[3]->mxpt_slb_start_range != "") {
                                $q4_from_4 = $fourth_quarter_array[3]->mxpt_slb_start_range;
                                $q4_to_4 = $fourth_quarter_array[3]->mxpt_slb_end_range;
                                $q4_amnt_4 = $fourth_quarter_array[3]->mxpt_slb_amount;
                            } else {
                                $q4_from_4 = "";
                                $q4_to_4 = "";
                                $q4_amnt_4 = "";
                            }
                            if (isset($fourth_quarter_array[4]->mxpt_slb_start_range) && $fourth_quarter_array[4]->mxpt_slb_start_range != "") {
                                $q4_from_5 = $fourth_quarter_array[4]->mxpt_slb_start_range;
                                $q4_to_5 = $fourth_quarter_array[4]->mxpt_slb_end_range;
                                $q4_amnt_5 = $fourth_quarter_array[4]->mxpt_slb_amount;
                            } else {
                                $q4_from_5 = "";
                                $q4_to_5 = "";
                                $q4_amnt_5 = "";
                            }
                            if (isset($fourth_quarter_array[5]->mxpt_slb_start_range) && $fourth_quarter_array[5]->mxpt_slb_start_range != "") {
                                $q4_from_6 = $fourth_quarter_array[5]->mxpt_slb_start_range;
                                $q4_to_6 = $fourth_quarter_array[5]->mxpt_slb_end_range;
                                $q4_amnt_6 = $fourth_quarter_array[5]->mxpt_slb_amount;
                            } else {
                                $q4_from_6 = "";
                                $q4_to_6 = "";
                                $q4_amnt_6 = "";
                            }
                            //------END Q4
                        } else if ($pt_statutory[0]->mxpt_pt_type == 3) {//--->half yearly
                            //-------GET SEPERATE ARRAYS
                            $first_half_array = [];
                            $second_half_array = [];
                            for ($i = 0; $i < count($pt_slab_statutory); $i++) {
                                if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 1) {//---->H1
                                    $first_half_array[] = $pt_slab_statutory[$i];
                                } else if ($pt_slab_statutory[$i]->mxpt_slb_pt_type_sno == 2) {//---->H2
                                    $second_half_array[] = $pt_slab_statutory[$i];
                                }
//                                print_r($pt_slab_stat);exit;
                            }
//                            print_r($first_half_array);
                            //-------END GET SEPERATE ARRAYS
                            //------H1
                            if (isset($first_half_array[0]->mxpt_slb_start_range) && $first_half_array[0]->mxpt_slb_start_range != "") {
                                $h1_from_1 = $first_half_array[0]->mxpt_slb_start_range;
                                $h1_to_1 = $first_half_array[0]->mxpt_slb_end_range;
                                $h1_amnt_1 = $first_half_array[0]->mxpt_slb_amount;
                            } else {
                                $h1_from_1 = "";
                                $h1_to_1 = "";
                                $h1_amnt_1 = "";
                            }
                            if (isset($first_half_array[1]->mxpt_slb_start_range) && $first_half_array[1]->mxpt_slb_start_range != "") {
                                $h1_from_2 = $first_half_array[1]->mxpt_slb_start_range;
                                $h1_to_2 = $first_half_array[1]->mxpt_slb_end_range;
                                $h1_amnt_2 = $first_half_array[1]->mxpt_slb_amount;
                            } else {
                                $h1_from_2 = "";
                                $h1_to_2 = "";
                                $h1_amnt_2 = "";
                            }
                            if (isset($first_half_array[2]->mxpt_slb_start_range) && $first_half_array[2]->mxpt_slb_start_range != "") {
                                $h1_from_3 = $first_half_array[2]->mxpt_slb_start_range;
                                $h1_to_3 = $first_half_array[2]->mxpt_slb_end_range;
                                $h1_amnt_3 = $first_half_array[2]->mxpt_slb_amount;
                            } else {
                                $h1_from_3 = "";
                                $h1_to_3 = "";
                                $h1_amnt_3 = "";
                            }
                            if (isset($first_half_array[3]->mxpt_slb_start_range) && $first_half_array[3]->mxpt_slb_start_range != "") {
                                $h1_from_4 = $first_half_array[3]->mxpt_slb_start_range;
                                $h1_to_4 = $first_half_array[3]->mxpt_slb_end_range;
                                $h1_amnt_4 = $first_half_array[3]->mxpt_slb_amount;
                            } else {
                                $h1_from_4 = "";
                                $h1_to_4 = "";
                                $h1_amnt_4 = "";
                            }
                            if (isset($first_half_array[4]->mxpt_slb_start_range) && $first_half_array[4]->mxpt_slb_start_range != "") {
                                $h1_from_5 = $first_half_array[4]->mxpt_slb_start_range;
                                $h1_to_5 = $first_half_array[4]->mxpt_slb_end_range;
                                $h1_amnt_5 = $first_half_array[4]->mxpt_slb_amount;
                            } else {
                                $h1_from_5 = "";
                                $h1_to_5 = "";
                                $h1_amnt_5 = "";
                            }
                            if (isset($first_half_array[5]->mxpt_slb_start_range) && $first_half_array[5]->mxpt_slb_start_range != "") {
                                $h1_from_6 = $first_half_array[5]->mxpt_slb_start_range;
                                $h1_to_6 = $first_half_array[5]->mxpt_slb_end_range;
                                $h1_amnt_6 = $first_half_array[5]->mxpt_slb_amount;
                            } else {
                                $h1_from_6 = "";
                                $h1_to_6 = "";
                                $h1_amnt_6 = "";
                            }
                            //------END H1
                            //------H2
                            if (isset($second_half_array[0]->mxpt_slb_start_range) && $second_half_array[0]->mxpt_slb_start_range != "") {
                                $h2_from_1 = $second_half_array[0]->mxpt_slb_start_range;
                                $h2_to_1 = $second_half_array[0]->mxpt_slb_end_range;
                                $h2_amnt_1 = $second_half_array[0]->mxpt_slb_amount;
                            } else {
                                $h2_from_1 = "";
                                $h2_to_1 = "";
                                $h2_amnt_1 = "";
                            }
                            if (isset($second_half_array[1]->mxpt_slb_start_range) && $second_half_array[1]->mxpt_slb_start_range != "") {
                                $h2_from_2 = $second_half_array[1]->mxpt_slb_start_range;
                                $h2_to_2 = $second_half_array[1]->mxpt_slb_end_range;
                                $h2_amnt_2 = $second_half_array[1]->mxpt_slb_amount;
                            } else {
                                $h2_from_2 = "";
                                $h2_to_2 = "";
                                $h2_amnt_2 = "";
                            }
                            if (isset($second_half_array[2]->mxpt_slb_start_range) && $second_half_array[2]->mxpt_slb_start_range != "") {
                                $h2_from_3 = $second_half_array[2]->mxpt_slb_start_range;
                                $h2_to_3 = $second_half_array[2]->mxpt_slb_end_range;
                                $h2_amnt_3 = $second_half_array[2]->mxpt_slb_amount;
                            } else {
                                $h2_from_3 = "";
                                $h2_to_3 = "";
                                $h2_amnt_3 = "";
                            }
                            if (isset($second_half_array[3]->mxpt_slb_start_range) && $second_half_array[3]->mxpt_slb_start_range != "") {
                                $h2_from_4 = $second_half_array[3]->mxpt_slb_start_range;
                                $h2_to_4 = $second_half_array[3]->mxpt_slb_end_range;
                                $h2_amnt_4 = $second_half_array[3]->mxpt_slb_amount;
                            } else {
                                $h2_from_4 = "";
                                $h2_to_4 = "";
                                $h2_amnt_4 = "";
                            }
                            if (isset($second_half_array[4]->mxpt_slb_start_range) && $second_half_array[4]->mxpt_slb_start_range != "") {
                                $h2_from_5 = $second_half_array[4]->mxpt_slb_start_range;
                                $h2_to_5 = $second_half_array[4]->mxpt_slb_end_range;
                                $h2_amnt_5 = $second_half_array[4]->mxpt_slb_amount;
                            } else {
                                $h2_from_5 = "";
                                $h2_to_5 = "";
                                $h2_amnt_5 = "";
                            }
                            if (isset($second_half_array[5]->mxpt_slb_start_range) && $second_half_array[5]->mxpt_slb_start_range != "") {
                                $h2_from_6 = $second_half_array[5]->mxpt_slb_start_range;
                                $h2_to_6 = $second_half_array[5]->mxpt_slb_end_range;
                                $h2_amnt_6 = $second_half_array[5]->mxpt_slb_amount;
                            } else {
                                $h2_from_6 = "";
                                $h2_to_6 = "";
                                $h2_amnt_6 = "";
                            }
                            //------END H2
                        } else if ($pt_statutory[0]->mxpt_pt_type == 4) {//--->yearly
                            if (isset($pt_slab_statutory[0]->mxpt_slb_start_range) && $pt_slab_statutory[0]->mxpt_slb_start_range != "") {
                                $m_y_from_1 = $pt_slab_statutory[0]->mxpt_slb_start_range;
                                $m_y_to_1 = $pt_slab_statutory[0]->mxpt_slb_end_range;
                                $m_y_amnt_1 = $pt_slab_statutory[0]->mxpt_slb_amount;
                            } else {
                                $m_y_from_1 = "";
                                $m_y_to_1 = "";
                                $m_y_amnt_1 = "";
                            }
                            if (isset($pt_slab_statutory[1]->mxpt_slb_start_range) && $pt_slab_statutory[1]->mxpt_slb_start_range != "") {
                                $m_y_from_2 = $pt_slab_statutory[1]->mxpt_slb_start_range;
                                $m_y_to_2 = $pt_slab_statutory[1]->mxpt_slb_end_range;
                                $m_y_amnt_2 = $pt_slab_statutory[1]->mxpt_slb_amount;
                            } else {
                                $m_y_from_2 = "";
                                $m_y_to_2 = "";
                                $m_y_amnt_2 = "";
                            }
                            if (isset($pt_slab_statutory[2]->mxpt_slb_start_range) && $pt_slab_statutory[2]->mxpt_slb_start_range != "") {
                                $m_y_from_3 = $pt_slab_statutory[2]->mxpt_slb_start_range;
                                $m_y_to_3 = $pt_slab_statutory[2]->mxpt_slb_end_range;
                                $m_y_amnt_3 = $pt_slab_statutory[2]->mxpt_slb_amount;
                            } else {
                                $m_y_from_3 = "";
                                $m_y_to_3 = "";
                                $m_y_amnt_3 = "";
                            }
                            if (isset($pt_slab_statutory[3]->mxpt_slb_start_range) && $pt_slab_statutory[3]->mxpt_slb_start_range != "") {
                                $m_y_from_4 = $pt_slab_statutory[3]->mxpt_slb_start_range;
                                $m_y_to_4 = $pt_slab_statutory[3]->mxpt_slb_end_range;
                                $m_y_amnt_4 = $pt_slab_statutory[3]->mxpt_slb_amount;
                            } else {
                                $m_y_from_4 = "";
                                $m_y_to_4 = "";
                                $m_y_amnt_4 = "";
                            }
                            if (isset($pt_slab_statutory[4]->mxpt_slb_start_range) && $pt_slab_statutory[4]->mxpt_slb_start_range != "") {
                                $m_y_from_5 = $pt_slab_statutory[4]->mxpt_slb_start_range;
                                $m_y_to_5 = $pt_slab_statutory[4]->mxpt_slb_end_range;
                                $m_y_amnt_5 = $pt_slab_statutory[4]->mxpt_slb_amount;
                            } else {
                                $m_y_from_5 = "";
                                $m_y_to_5 = "";
                                $m_y_amnt_5 = "";
                            }
                            if (isset($pt_slab_statutory[5]->mxpt_slb_start_range) && $pt_slab_statutory[5]->mxpt_slb_start_range != "") {
                                $m_y_from_6 = $pt_slab_statutory[5]->mxpt_slb_start_range;
                                $m_y_to_6 = $pt_slab_statutory[5]->mxpt_slb_end_range;
                                $m_y_amnt_6 = $pt_slab_statutory[5]->mxpt_slb_amount;
                            } else {
                                $m_y_from_6 = "";
                                $m_y_to_6 = "";
                                $m_y_amnt_6 = "";
                            }
                        }
                        ?>
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
                                                <td><input type="text" name="month_year_from[]"  class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_1; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_1; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_1; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_2; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_2; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_2; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_3; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_3; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_3; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="month_year_from[]"  class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_4; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_4; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_4; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_5; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_5; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_5; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="month_year_from[]" class="form-control m-b-10 month_year_from" value="<?php echo $m_y_from_6; ?>"></td>
                                                <td><input type="text" name="month_year_to[]" class="form-control m-b-10 month_year_to" value="<?php echo $m_y_to_6; ?>"></td>
                                                <td><input type="text" name="month_year_amnt[]" class="form-control m-b-10 month_year_amnt" value="<?php echo $m_y_amnt_6; ?>"></td>
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
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="quater_1_date" id="quater_1_date" class="form-control m-b-10 datetimepicker" placeholder="Quater-1 Date">
                                    </div>
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
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_1; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_1; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_2; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_2; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_3; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_3; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_4; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_4; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_5; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_5; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q1_from[]" class="form-control m-b-10 q1_from" value="<?php echo $q1_from_6; ?>"></td>
                                                    <td><input type="text" name="q1_to[]" class="form-control m-b-10 q1_to" value="<?php echo $q1_to_6; ?>"></td>
                                                    <td><input type="text" name="q1_amnt[]" class="form-control m-b-10 q1_amnt" value="<?php echo $q1_amnt_6; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="quater_2_date" id="quater_2_date" class="form-control m-b-10 datetimepicker" placeholder="Date">
                                    </div>
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
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_1; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_1; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_2; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_2; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_3; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_3; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_4; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_4; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_5; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_5; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q2_from[]" class="form-control m-b-10 q2_from" value="<?php echo $q2_from_6; ?>"></td>
                                                    <td><input type="text" name="q2_to[]" class="form-control m-b-10 q2_to" value="<?php echo $q2_to_6; ?>"></td>
                                                    <td><input type="text" name="q2_amnt[]" class="form-control m-b-10 q2_amnt" value="<?php echo $q2_amnt_6; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 

                            </div>

                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="quater_3_date" id="quater_3_date" class="form-control m-b-10 datetimepicker" placeholder="Date">
                                    </div>
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
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_1; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_1; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_2; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_2; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_3; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_3; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_4; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_4; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_5; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_5; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q3_from[]" class="form-control m-b-10 q3_from" value="<?php echo $q3_from_6; ?>"></td>
                                                    <td><input type="text" name="q3_to[]" class="form-control m-b-10 q3_to" value="<?php echo $q3_to_6; ?>"></td>
                                                    <td><input type="text" name="q3_amnt[]" class="form-control m-b-10 q3_amnt" value="<?php echo $q3_amnt_6; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="quater_4_date" id="quater_4_date" class="form-control m-b-10 datetimepicker" placeholder="Date">
                                    </div>
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
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_1; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_1; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_2; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_2; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_3; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_3; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_4; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_4; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_5; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_5; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="q4_from[]" class="form-control m-b-10 q4_from" value="<?php echo $q4_from_6; ?>"></td>
                                                    <td><input type="text" name="q4_to[]" class="form-control m-b-10 q4_to" value="<?php echo $q4_to_6; ?>"></td>
                                                    <td><input type="text" name="q4_amnt[]" class="form-control m-b-10 q4_amnt" value="<?php echo $q4_amnt_6; ?>"></td>
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
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="halfyearly_1_date" id="halfyearly_1_date" class="form-control m-b-10 datetimepicker" placeholder="Date">
                                    </div>
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
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_1; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_1; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_2; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_2; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_3; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_3; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_4; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_4; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_5; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_5; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h1_from[]" class="form-control m-b-10 h1_from" value="<?php echo $h1_from_6; ?>"></td>
                                                    <td><input type="text" name="h1_to[]" class="form-control m-b-10 h1_to" value="<?php echo $h1_to_6; ?>"></td>
                                                    <td><input type="text" name="h1_amnt[]" class="form-control m-b-10 h1_amnt" value="<?php echo $h1_amnt_6; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <label class="col-lg-3 col-form-label">From Date</label>
                                    <div class="col-lg-9 row">
                                        <input type="text" name="halfyearly_2_date" id="halfyearly_2_date" class="form-control m-b-10 datetimepicker" placeholder="Date">
                                    </div>
                                    <div class="table-responsive" id="Monthly">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_1; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_1; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_2; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_2; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_3; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_3; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_4; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_4; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_5; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_5; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="h2_from[]" class="form-control m-b-10 h2_from" value="<?php echo $h2_from_6; ?>"></td>
                                                    <td><input type="text" name="h2_to[]" class="form-control m-b-10 h2_to" value="<?php echo $h2_to_6; ?>"></td>
                                                    <td><input type="text" name="h2_amnt[]" class="form-control m-b-10 h2_amnt" value="<?php echo $h2_amnt_6; ?>"></td>
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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pt_statutory.js"></script>

<!---------------PT------------>
<script>
    var pt_type_id = '<?php echo $pt_statutory[0]->mxpt_pt_type; ?>'
//    $(document).ready(function () {
    if (pt_type_id == 1) {//--->monthly
        $("#monthly_and_yearly_tab").show();
        $("#quaterly_tab").hide();
        $("#halfyearly_tab").hide();
    } else if (pt_type_id == 2) {//---->quaterly
        $("#quaterly_tab").show();
        $("#monthly_and_yearly_tab").hide();
        $("#halfyearly_tab").hide();
    } else if (pt_type_id == 3) {//---->halfyearly
        $("#halfyearly_tab").show();
        $("#monthly_and_yearly_tab").hide();
        $("#quaterly_tab").hide();
    } else if (pt_type_id == 4) {//---->yearly
        $("#monthly_and_yearly_tab").show();
        $("#quaterly_tab").hide();
        $("#halfyearly_tab").hide();
    }

//    });

</script>
<!---------------END PT------------>
<script>
    var selected_comp_id = '<?php echo $pt_statutory[0]->mxpt_comp_id ?>';
    var selected_div_id = '<?php echo $pt_statutory[0]->mxpt_div_id ?>';
    var selected_state_id = '<?php echo $pt_statutory[0]->mxpt_state_id ?>';
    var selected_branch_id = '<?php echo $pt_statutory[0]->mxpt_branch_id ?>';

//    console.log(selected_comp_id +'---'+selected_state_id+'---'+selected_branch_id);
    load_pt_divisions(selected_comp_id, selected_div_id)
    pt_load_states(selected_comp_id, selected_div_id, selected_state_id)
    pt_load_branches(selected_comp_id, selected_div_id,selected_state_id,selected_branch_id);



</script>