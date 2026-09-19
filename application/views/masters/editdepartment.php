<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Edit Your Department Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Master</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Department Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="processdepartmentdetails">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Company Name</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="cmpname" id="cmpname">
                                                <option value="">-- Select Company --</option>
                                                <?php
                                                foreach ($cmpmaster as $key => $cmpvalue) {
                                                    if ($cmpvalue->mxcp_id == $departmentdetails[0]->mxdpt_comp_id) {
                                                        $sel = 'selected';
                                                    } else {
                                                        $sel = '';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel ?> ><?php echo $cmpvalue->mxcp_name ?></option>
<?php } ?>
                                            </select>
                                            <span class="formerror" id="cmpnameerror"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $departmentdetails[0]->mxdpt_id ?>">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Department Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="departmentname" id="departmentname" value="<?php echo $departmentdetails[0]->mxdpt_name ?>">
                                        </div>
                                        <span class="formerror" id="departmentnameerror"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">	
                                <div class="col-lg-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" name="dept_branchhr" id="dept_branchhr"  value="1" <?php echo ($departmentdetails[0]->mxdpt_is_hr == 1)? "checked":""?>>
                                        <label class="form-check-label">
                                            Is Branch HR
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" name="dept_branchdirector" id="dept_branchdirector"  value="1" <?php echo ($departmentdetails[0]->mxdpt_is_director == 1)? "checked":""?>>
                                        <label class="form-check-label">
                                            Is Director
                                        </label>
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
</div>
<!-- /Main Wrapper -->
<script>
    var dp = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/department.js"></script>