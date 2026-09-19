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
                        <li class="breadcrumb-item active">Update Income</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#income_tab" data-toggle="tab" class="nav-link active" id="income_li">Income</a></li>
                        <!--<li class="nav-item"><a href="#deduction_tab" data-toggle="tab" class="nav-link" id="deduction_li">Deduction</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="incomeaddnew" class="collapse show active">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ENTER INCOME TYPE</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="income_type_form">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="income_cmp_id" id="income_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            if($income_types[0]->mxincm_comp_id == $companies->mxcp_id){
                                                                
                                                            echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                            }else{
                                                            echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                                
                                                            }
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="income_cmp_id_error"></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Emp Type</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="income_emp_type_id" id="income_emp_type_id" style="width: 100%;">
                                                        <option value="0">Select Emp Type</option>
                                                        <?php
                                                        foreach ($emptypedetails as $emp_type) {
                                                            if($income_types[0]->mxincm_emp_type_id == $emp_type->mxemp_ty_id){                                                                
                                                                echo"<option value=" . $emp_type->mxemp_ty_id . " selected>" . $emp_type->mxemp_ty_name . "</option>";
                                                            }else{
                                                                echo"<option value=" . $emp_type->mxemp_ty_id . ">" . $emp_type->mxemp_ty_name . "</option>";                                                                
                                                            }
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="income_emp_type_id_error"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Income Type</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="income_name" id="income_name" value="<?php echo $income_types[0]->mxincm_name; ?>" class="form-control m-b-20">
                                                    <input type="hidden" name="income_id" id="income_id" value="<?php echo $income_types[0]->mxincm_id; ?>" class="form-control m-b-20">
                                                    <span class="formerror" id="income_name_error"></span>

                                            
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_earning" value="1" <?php echo ($income_types[0]->mxincm_is_earning == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is Earnings
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_ctc" value="1" <?php echo ($income_types[0]->mxincm_is_ctc == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is CTC
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_variablepay" value="1" <?php echo ($income_types[0]->mxincm_is_variablepay == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is Variable Pay
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_basic" value="1" <?php echo ($income_types[0]->mxincm_is_basic == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is Basic
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_hra" value="1" <?php echo ($income_types[0]->mxincm_is_hra == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is HRA
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input inc_type" type="checkbox" name="inc_is_tsp" value="1" <?php echo ($income_types[0]->mxincm_is_tsp == 1)?"checked":""?>>
                                                <label class="form-check-label">
                                                    Is Trainees Staipand
                                                </label>
                                            </div>
                                            <span class="formerror" id="inc_type_error"></span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="inc_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
<script>
    var page_type = 2;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/inc_ded_type.js"></script>
