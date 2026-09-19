<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">EDIT PAY STRUCTURE DETAILS</h4>
                </div>
                <?php // print_r($esi_statutory); ?>
                <div class="card-body">
                    <form method="post" action="#" id="pay_structure_form">
                                <div class="row">
                                    <div class="col-xl-4">


                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Affected Date</label>
                                            <div class="col-lg-8">
                                                <input class="form-control yearmonth" name="pay_str_affect_date" id="pay_str_affect_date" autocomplete="off" value="<?php echo date('m-y',strtotime($pay_structure[0]->mxps_affect_from)); ?>">
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
                                                                if($companies->mxcp_id == $pay_structure[0]->mxps_comp_id){
                                                                    echo "<option value=" . $companies->mxcp_id . "~" . $companies->mxcp_name . " data-cmp_id=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                                }else{
                                                                    echo "<option value=" . $companies->mxcp_id . "~" . $companies->mxcp_name . " data-cmp_id=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                                }
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
                                                    foreach ($emptype as $emp_type_data) {
                                                        if($emp_type_data->mxemp_ty_id == $pay_structure[0]->mxps_emptype_id){
                                                            echo"<option value=" . $emp_type_data->mxemp_ty_id . " data-emp_type_id=" . $emp_type_data->mxemp_ty_id . " selected>" . $emp_type_data->mxemp_ty_name . "</option>";
                                                            
                                                        }else{
                                                            echo"<option value=" . $emp_type_data->mxemp_ty_id . " data-emp_type_id=" . $emp_type_data->mxemp_ty_id . ">" . $emp_type_data->mxemp_ty_name . "</option>";
                                                            
                                                        }
                                                    }
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
                                                                        <?php $sno = 1;
                                                                        foreach($pay_structure_child as $pay_child){
                                                                            ?>
                                                                            <tr id="employer_tr_1">
                                                                            <td>
                                                                                <select class="select2 form-control employer_inc_head" name="employer_inc_head_<?php echo $sno; ?>" id="employer_inc_head_<?php echo $sno; ?>" style="width: 100%;">
                                                                                    <option value="">Select Income Head</option>
                                                                                    <?php foreach($income_types as $inc_type){
                                                                                        if($inc_type->mxincm_id == $pay_child->mxpsc_inc_head_id){
                                                                                            echo "<option value='".$inc_type->mxincm_id."~".str_replace(' ', '_', $inc_type->mxincm_name)." data-inc_head_id='".$inc_type->mxincm_id."' selected>".$inc_type->mxincm_name."</option>";
                                                                                            
                                                                                        }else{
                                                                                            echo "<option value='".$inc_type->mxincm_id."~".str_replace(' ', '_', $inc_type->mxincm_name)." data-inc_head_id='".$inc_type->mxincm_id."'>".$inc_type->mxincm_name."</option>";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <input type="hidden" name="employer_hid[]" value="<?php echo $sno; ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form- control employer_perc" name="employer_perc_<?php echo $sno; ?>" id="employer_perc_<?php echo $sno; ?>" class="employer_perc" value="<?php echo $pay_child->mxpsc_percentage; ?>">
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_vh_<?php echo $sno; ?>" id="employer_vh_<?php echo $sno; ?>" class="employer_vh" <?php echo ($pay_child->mxpsc_isvariable_head == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_pf_<?php echo $sno; ?>" id="employer_pf_<?php echo $sno; ?>" class="employer_pf" <?php echo ($pay_child->mxpsc_ispf == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_esi_<?php echo $sno; ?>" id="employer_esi_<?php echo $sno; ?>" class="employer_esi" <?php echo ($pay_child->mxpsc_isesi == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_pt_<?php echo $sno; ?>" id="employer_pt_<?php echo $sno; ?>" class="employer_pt" <?php echo ($pay_child->mxpsc_ispt == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_bns_<?php echo $sno; ?>" id="employer_bns_<?php echo $sno; ?>" class="employer_bns" <?php echo ($pay_child->mxpsc_isbns == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_lwf_<?php echo $sno; ?>" id="employer_lwf_<?php echo $sno; ?>" class="employer_lwf" <?php echo ($pay_child->mxpsc_islwf == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_gratuity_<?php echo $sno; ?>" id="employer_gratuity_<?php echo $sno; ?>" class="employer_gratuity" <?php echo ($pay_child->mxpsc_isgratuity == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_lta_<?php echo $sno; ?>" id="employer_lta_<?php echo $sno; ?>" class="employer_lta" <?php echo ($pay_child->mxpsc_islta == 0)?"":"checked"; ?>>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox" align="center">
                                                                                    <label>
                                                                                        <input type="checkbox" name="employer_mediclaim_<?php echo $sno; ?>" id="employer_mediclaim_<?php echo $sno; ?>" class="employer_mediclaim" <?php echo ($pay_child->mxpsc_ismediclaim == 0)?"":"checked"; ?>>
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
                                                                            <?php
                                                                            $sno = $sno + 1;
                                                                        }
                                                                            ?>
                                                                        

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
<script src="<?php echo base_url(); ?>/assets/js/formsjs/inc_ded_type.js"></script>
<?php // echo $gratuity_statutory[0]->mxgratuity_comp_id;exit; ?>
<script>
    var employer_sno = "<?php echo $sno; ?>";
    var income_type = '<?php echo json_encode($income_types); ?>';
    // console.log(income_type);
     income_heads_array = JSON.parse(income_type);
</script>