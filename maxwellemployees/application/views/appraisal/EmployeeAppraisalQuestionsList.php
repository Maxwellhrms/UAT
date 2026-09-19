<style>

.appraisal-item{
    border:none;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 3px 15px rgba(0,0,0,.08);
    margin-bottom:20px;
}

.question-btn{
    background:#fff;
    font-weight:600;
    font-size:16px;
}

.question-btn:not(.collapsed){
    background:#f8fafc;
    color:#0d6efd;
}

.role-accordion{
    margin-bottom:12px;
}

.employee-btn{
    background:#eef5ff;
    border-left:5px solid #0d6efd;
}

.manager-btn{
    background:#fff8ef;
    border-left:5px solid #fd7e14;
}

.hod-btn{
    background:#eefcf4;
    border-left:5px solid #198754;
}

.role-card{
    background:#fff;
    border-radius:10px;
    padding:20px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#495057;
}

.form-control{
    border-radius:8px;
}

.question-meta{
    font-size:12px;
}
.hr-btn{
    background:#f3e8ff;
    border-left:5px solid #6f42c1;
}
.is-invalid{
    border:2px solid #dc3545 !important;
}
</style>
<?php
$employeeName = '';
$managerName  = '';
$hodName      = '';
$reviewerName = '';
$hrName       = '';

foreach($assigned['authorizationinfo'] as $auth){

    switch($auth['role']){
        case 'EMPLOYEE':
            $employeeName = $auth['employee_name'].' ('. $auth['employee_code'].')';
            break;

        case 'MANAGER':
            $managerName = $auth['employee_name'].' ('. $auth['employee_code'].')';
            break;

        case 'HOD':
            $hodName = $auth['employee_name'].' ('. $auth['employee_code'].')';
            break;

        case 'HR':
            $hrName = $auth['employee_name'].' ('. $auth['employee_code'].')';
            break;

        case 'REVIEWER':
            $reviewerName = $auth['employee_name'].' ('. $auth['employee_code'].')';
            break;
    }
}


$access = $assigned['currentaccess'];

$role   = $access['role'];
$action = $access['action'];

$showEmployee = true;
$showManager  = false;
$showHOD      = false;
$showHR       = false;

$employeeReadonly = true;
$managerReadonly  = true;
$hodReadonly      = true;
$hrReadonly       = true;

$showReviewer = false;
$reviewerReadonly = true;

switch($role){

    case 'EMPLOYEE':
        $employeeReadonly = false;
        break;

    case 'MANAGER':
        $showManager = true;
        $managerReadonly = ($action != 'ADD');
        break;

    case 'HOD':
        $showManager = true;
        $showHOD = true;
        $hodReadonly = ($action != 'ADD');
        break;

    case 'HR':
        $showManager = true;
        $showHOD = true;
        $showHR = true;
        $hrReadonly = ($action != 'ADD');
        break;

    case 'REVIEWER':
        $showManager = true;
        $showHOD = true;
        $showHR = true;
        $showReviewer = true;

        $managerReadonly = true;
        $hodReadonly = true;
        $hrReadonly = true;

        $reviewerReadonly = ($action != 'ADD');
        break;
}
?>

<?php
if(count($assigned['questions']) <= 0){
$appraisalName = ($userdata['appraisalcategory'] == 1)
    ? 'KRA (Key Result Areas)'
    : 'Key Competencies';
?>

<div class="alert alert-info text-center mt-4">
    <h5>
        <i class="fa fa-info-circle"></i>
        No Appraisal Records Found
    </h5>

    <p class="mb-0">
        <?php echo $appraisalName; ?> has not been assigned, activated, or configured for this employee for the selected month.
        Please contact HR, Manager, or the Appraisal Administrator.
    </p>
</div>
<?php exit;} ?>

    <?php if($userdata['appraisaltype'] == 1){ ?>
        <div class="alert alert-info">
            <strong>Hi <?php echo $this->session->userdata('session_name').' ('.$this->session->userdata('session_loginperson_id').')'; ?>!</strong>
            Please complete your Self Appraisal for the current appraisal period and submit it for review.
        </div>
    <?php }else if($userdata['appraisaltype'] == 2){ ?>
        <div class="alert alert-info">
            <strong>Hi <?php echo $this->session->userdata('session_name').' ('.$this->session->userdata('session_loginperson_id').')'; ?>!</strong>
            you have been assigned to review <strong><?php echo $employeeName; ?></strong> appraisal. Please complete your review and submit your feedback.
        </div>
    <?php } ?>
<div class="accordion mb-4" id="summaryAccordion">

    <div class="accordion-item border-0 shadow-sm">

        <h2 class="accordion-header">

            <button class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#summaryCollapse">

                📊 Appraisal Summary Dashboard

            </button>

        </h2>

        <div id="summaryCollapse"
             class="accordion-collapse collapse show">

            <div class="accordion-body">

                <div class="row">

                    <!-- Employee -->
                    <div class="col-md-3">
                        <div class="card border-primary h-100">
                            <div class="card-header bg-primary text-white text-center">
                               <span> 👤 Employee</span><br>
                                <span><?php echo $employeeName; ?></span>
                            </div>

                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-between">
                                    <span>Target</span>
                                    <strong id="empTotalTarget">0</strong>
                                </div> -->
                                
                                <div class="d-flex justify-content-between">
                                    <span>Total Questions</span>
                                    <strong id="empTotalQuestions">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Filled Questions</span>
                                    <strong id="empFilledQuestions">0 / 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achieved Weightage</span>
                                    <strong id="empAchievedWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Weightage</span>
                                    <strong id="empTotalWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achievement</span>
                                    <div id="empTotalAchievement">0</div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <h4 class="text-primary"
                                        id="empOverallScore">0%</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if($showManager) { ?>
                    <!-- Manager -->
                    <div class="col-md-3">
                        <div class="card border-warning h-100">
                            <div class="card-header bg-warning text-dark text-center">
                                <span> 👨‍💼 Manager</span> <br>
                                <span><?php echo $managerName; ?></span>
                            </div>

                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-between">
                                    <span>Target</span>
                                    <strong id="managerTotalTarget">0</strong>
                                </div> -->

                                <div class="d-flex justify-content-between">
                                    <span>Total Questions</span>
                                    <strong id="managerTotalQuestions">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Filled Questions</span>
                                    <strong id="managerFilledQuestions">0 / 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achieved Weightage</span>
                                    <strong id="managerAchievedWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Weightage</span>
                                    <strong id="managerTotalWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Assessment</span>
                                    <div id="managerTotalAchievement">0</div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <h4 class="text-warning"
                                        id="managerOverallScore">0%</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- HOD -->
                    <?php if($showHOD) { ?>
                    <div class="col-md-3">
                        <div class="card border-success h-100">
                            <div class="card-header bg-success text-white text-center">
                               <span> 🏢 HOD</span> <br>
                               <span><?php echo $hodName; ?></span>
                            </div>

                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-between">
                                    <span>Target</span>
                                    <strong id="hodTotalTarget">0</strong>
                                </div> -->

                                <div class="d-flex justify-content-between">
                                    <span>Total Questions</span>
                                    <strong id="hodTotalQuestions">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Filled Questions</span>
                                    <strong id="hodFilledQuestions">0 / 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achieved Weightage</span>
                                    <strong id="hodAchievedWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Weightage</span>
                                    <strong id="hodTotalWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Assessment</span>
                                    <div id="hodTotalAchievement">0</div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <h4 class="text-success"
                                        id="hodOverallScore">0%</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- HR -->
                    <?php if($showHR) { ?>
                    <div class="col-md-3">
                        <div class="card border-secondary h-100">
                            <div class="card-header text-white text-center"
                                 style="background:#6f42c1;">
                                <span>👨‍💼 HR</span> <br>
                                <span><?php echo $hrName; ?></span>
                            </div>

                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-between">
                                    <span>Target</span>
                                    <strong id="hrTotalTarget">0</strong>
                                </div> -->

                                <div class="d-flex justify-content-between">
                                    <span>Total Questions</span>
                                    <strong id="hrTotalQuestions">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Filled Questions</span>
                                    <strong id="hrFilledQuestions">0 / 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achieved Weightage</span>
                                    <strong id="hrAchievedWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Weightage</span>
                                    <strong id="hrTotalWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Assessment</span>
                                    <div id="hrTotalAchievement">0</div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <h4 style="color:#6f42c1;"
                                        id="hrOverallScore">0%</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- Reviewer -->
                    <?php if($showReviewer){ ?>
                    <div class="col-md-3">
                        <div class="card border-secondary h-100">
                            <div class="card-header text-white text-center"
                                 style="background:#b1a068;">
                                <span>👨‍💼 Reviewer</span> <br>
                                <span><?php echo $reviewerName; ?></span>
                            </div>

                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-between">
                                    <span>Target</span>
                                    <strong id="reviewerTotalTarget">0</strong>
                                </div> -->

                                <div class="d-flex justify-content-between">
                                    <span>Total Questions</span>
                                    <strong id="reviewerTotalQuestions">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Filled Questions</span>
                                    <strong id="reviewerFilledQuestions">0 / 0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Achieved Weightage</span>
                                    <strong id="reviewerAchievedWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Weightage</span>
                                    <strong id="reviewerTotalWeightage">0</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Assessment</span>
                                    <div id="reviewerTotalAchievement">0</div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <h4 style="color:#6f42c1;"
                                        id="reviewerOverallScore">0%</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>

        </div>

    </div>

</div>

<form id="appraisalForm" method="post">
<div class="accordion" id="mainAccordion">

<?php foreach($assigned['questions'] as $key => $row){ ?>

<div class="accordion-item appraisal-item">

    <!-- Question Header -->

    <h2 class="accordion-header">

        <button class="accordion-button question-btn <?php echo ($key>0?'collapsed':''); ?>"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question_<?php echo $row['mxap_assign_id']; ?>">

            <div class="w-100 d-flex justify-content-between align-items-center">

                <div>
                    <div>
                        <?php echo ($key+1); ?>.
                        <?php echo $row['mxap_question']; ?>
                    </div>

                    <small class="question-meta text-muted">
                        Objective :
                        <?php echo $row['mxap_assign_objective']; ?></br>
                        Kpi : 
                        <?php echo $row['mxap_kpi']; ?>
                    </small>
                </div>
            </div>

        </button>

    </h2>

    <div id="question_<?php echo $row['mxap_assign_id']; ?>"
         class="accordion-collapse collapse <?php echo ($key==0?'show':''); ?>">

        <div class="accordion-body">

            <!-- Employee -->

            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button" class="accordion-button employee-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#emp_<?php echo $row['mxap_assign_id']; ?>">

                            <div class="d-flex justify-content-between align-items-center w-100">

                                <span>👤 Self Assessment</span>

                                <span class="ml-auto mr-3">
                                    <?php echo $employeeName; ?>
                                </span>

                            </div>

                        </button>

                    </h2>

                    <div id="emp_<?php echo $row['mxap_assign_id']; ?>"
                         class="accordion-collapse collapse show">

                        <div class="accordion-body role-card">
                             <input type="hidden" class="formula-type" value="<?php echo $row['mxap_formula_type']; ?>">
                             <input type="hidden" class="achievement-type" value="<?php echo strtolower($row['mxap_type']); ?>">
                            <div class="row g-3">

                                <input type="hidden" name="assignid[]" value="<?php echo $row['mxap_assign_id']; ?>">

                                <div class="col-md-1">
                                    <label class="form-label">Target</label>
                                    <input type="hidden" class="target-value" value="<?php echo $row['mxap_assign_monthlytarget']; ?>">
                                    <p class="form-label">
                                        <?php
                                        if($userdata['appraisalcategory'] == 2){
                                            echo $kc[$row['mxap_assign_monthlytarget']] ?? '-';
                                        }else{
                                            echo $row['mxap_assign_monthlytarget'];
                                        }
                                        ?>
                                        <br>(<?php echo $row['mxap_type']; ?>)
                                    </p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Weightage</label>
                                    <input type="hidden" class="weightage-value" value="<?php echo $row['mxap_assign_weightage']; ?>">
                                    <p class="form-label"><?php echo $row['mxap_assign_weightage']; ?></p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Achieved Target</label>
                                     <p class="form-label employee-achieved-percent">0%</p>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Achieved Weightage</label>
                                     <p class="form-label employee-weight-score">0</p>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Achievement</label>
                                     <?php if($userdata['appraisalcategory'] == 2){ ?>
                                        <select name="empachivement[]" class="form-control employee-achievement" <?php echo $employeeReadonly ? 'disabled' : ''; ?>>
                                            <?php foreach($kc as $key => $value){ ?>
                                                <option value="<?php echo $key; ?>"
                                                    <?php echo ($row['mxap_assign_emp_achievement'] == $key ? 'selected' : ''); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                     <?php } else { ?>
                                    <input type="number" min="0" step="0.01" name="empachivement[]" <?php if($row['mxap_type'] == 'clients') { ?> readonly <?php } ?> class="form-control employee-achievement updateclientcount_<?php echo $row['mxap_assign_id']; ?>" value="<?php echo $row['mxap_assign_emp_achievement']; ?>" <?php echo $employeeReadonly ? 'readonly' : ''; ?> autocomplete="off">
                                    <?php } ?>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="desc[]" class="form-control" rows="3"  <?php echo $employeeReadonly ? 'readonly' : ''; ?>><?php echo $row['mxap_assign_emp_description']; ?></textarea>
                                </div>


                                <?php if($row['mxap_type'] == 'clients') {?>
                                    <button type="button"
                                            class="btn btn-primary col-md-2"
                                            onclick="openDetailsModal(
                                                '<?php echo $row['mxap_assign_id']; ?>',
                                                '<?php echo $row['mxap_assign_employee_code']; ?>',
                                                '<?php echo $role; ?>'
                                            )">
                                        Add Details
                                    </button>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Manager -->
            <?php if($showManager) { ?>
            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button collapsed manager-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#mgr_<?php echo $row['mxap_assign_id']; ?>">

                            <div class="d-flex justify-content-between align-items-center w-100">

                                <span>
                                    👨‍💼 Manager Review
                                </span>

                                <span class="ml-auto mr-3">
                                    <?php echo $managerName; ?>
                                </span>

                            </div>

                        </button>

                    </h2>

                    <div id="mgr_<?php echo $row['mxap_assign_id']; ?>"
                         class="accordion-collapse collapse">

                        <div class="accordion-body role-card">
                             <input type="hidden" class="formula-type" value="<?php echo $row['mxap_formula_type']; ?>">
                             <input type="hidden" class="achievement-type" value="<?php echo strtolower($row['mxap_type']); ?>">
                            <div class="row g-3">

                                <div class="col-md-1">
                                    <label class="form-label">Target</label>
                                    <input type="hidden" class="target-value" value="<?php echo $row['mxap_assign_monthlytarget']; ?>">
                                    <p class="form-label">
                                        <?php
                                        if($userdata['appraisalcategory'] == 2){
                                            echo $kc[$row['mxap_assign_monthlytarget']] ?? '-';
                                        }else{
                                            echo $row['mxap_assign_monthlytarget'];
                                        }
                                        ?>
                                        <br>(<?php echo $row['mxap_type']; ?>)
                                    </p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Weightage</label>
                                    <input type="hidden" class="weightage-value" value="<?php echo $row['mxap_assign_weightage']; ?>">
                                    <p class="form-label"><?php echo $row['mxap_assign_weightage']; ?></p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Achieved Target</label>
                                     <p class="form-label manager-achieved-percent">0%</p>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Achieved Weightage</label>
                                     <p class="form-label manager-weight-score">0</p>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Assessment</label>
                                     <?php if($userdata['appraisalcategory'] == 2){ ?>
                                        <select name="managerachivement[]" class="form-control manager-achievement" <?php echo $managerReadonly ? 'disabled' : ''; ?>>
                                            <?php foreach($kc as $key => $value){ ?>
                                                <option value="<?php echo $key; ?>"
                                                    <?php echo ($row['mxap_assign_manager_actual_assesment'] == $key ? 'selected' : ''); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                     <?php } else { ?>
                                     <input type="number" min="0" step="0.01" name="managerachivement[]" <?php if($row['mxap_type'] == 'clients') { ?> readonly <?php } ?> class="form-control manager-achievement updatemanagercount_<?php echo $row['mxap_assign_id']; ?>" value="<?php echo $row['mxap_assign_manager_actual_assesment']; ?>" <?php echo $managerReadonly ? 'readonly' : ''; ?> autocomplete="off">
                                    <?php } ?>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Review</label>
                                    <textarea name="managerdesc[]" class="form-control" rows="3"  <?php echo $managerReadonly ? 'readonly' : ''; ?>><?php echo $row['mxap_assign_manager_review']; ?></textarea>
                                </div>
                                <?php if($row['mxap_type'] == 'clients') {?>
                                    <button type="button"
                                            class="btn btn-primary col-md-2"
                                            onclick="openDetailsModal(
                                                '<?php echo $row['mxap_assign_id']; ?>',
                                                '<?php echo $row['mxap_assign_employee_code']; ?>',
                                                '<?php echo $role; ?>'
                                            )">
                                        View/Add Details
                                    </button>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <?php } ?>
            <!-- HOD -->
            <?php if($showHOD) { ?>
            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button collapsed hod-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#hod_<?php echo $row['mxap_assign_id']; ?>">

                            <div class="d-flex justify-content-between align-items-center w-100">

                                <span>
                                    🏢 HOD Review
                                </span>

                                <small class="ml-auto mr-3">
                                    <?php echo $hodName; ?>
                                </small>

                            </div>

                        </button>

                    </h2>

                    <div id="hod_<?php echo $row['mxap_assign_id']; ?>"
                         class="accordion-collapse collapse">

                        <div class="accordion-body role-card">
                             <input type="hidden" class="formula-type" value="<?php echo $row['mxap_formula_type']; ?>">
                             <input type="hidden" class="achievement-type" value="<?php echo strtolower($row['mxap_type']); ?>">
                            <div class="row g-3">

                                <div class="col-md-1">
                                    <label class="form-label">Target</label>
                                    <input type="hidden" class="target-value" value="<?php echo $row['mxap_assign_monthlytarget']; ?>">
                                    <p class="form-label">
                                        <?php
                                        if($userdata['appraisalcategory'] == 2){
                                            echo $kc[$row['mxap_assign_monthlytarget']] ?? '-';
                                        }else{
                                            echo $row['mxap_assign_monthlytarget'];
                                        }
                                        ?>
                                        <br>(<?php echo $row['mxap_type']; ?>)
                                    </p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Weightage</label>
                                    <input type="hidden" class="weightage-value" value="<?php echo $row['mxap_assign_weightage']; ?>">
                                    <p class="form-label"><?php echo $row['mxap_assign_weightage']; ?></p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Achieved Target</label>
                                     <p class="form-label hod-achieved-percent">0%</p>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Achieved Weightage</label>
                                     <p class="form-label hod-weight-score">0</p>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Final Assessment</label>
                                     <?php if($userdata['appraisalcategory'] == 2){ ?>
                                        <select name="hodachivement[]" class="form-control hod-achievement" <?php echo $hodReadonly ? 'disabled' : ''; ?>>
                                            <?php foreach($kc as $key => $value){ ?>
                                                <option value="<?php echo $key; ?>"
                                                    <?php echo ($row['mxap_assign_hod_actual_assesment'] == $key ? 'selected' : ''); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                     <?php } else { ?>
                                     <input type="number" min="0" step="0.01" name="hodachivement[]" <?php if($row['mxap_type'] == 'clients') { ?> readonly <?php } ?> class="form-control hod-achievement updatehodcount_<?php echo $row['mxap_assign_id']; ?>" value="<?php echo $row['mxap_assign_hod_actual_assesment']; ?>" <?php echo $hodReadonly ? 'readonly' : ''; ?> autocomplete="off">
                                    <?php } ?>
                                </div>
                            
                                <div class="col-md-3">
                                    <label class="form-label">Review</label>
                                    <textarea name="hoddesc[]" class="form-control" rows="3"  <?php echo $hodReadonly ? 'readonly' : ''; ?>><?php echo $row['mxap_assign_hod_review']; ?></textarea>
                                </div>
                                <?php if($row['mxap_type'] == 'clients') {?>
                                    <button type="button"
                                            class="btn btn-primary col-md-2"
                                            onclick="openDetailsModal(
                                                '<?php echo $row['mxap_assign_id']; ?>',
                                                '<?php echo $row['mxap_assign_employee_code']; ?>',
                                                '<?php echo $role; ?>'
                                            )">
                                        View/Add Details
                                    </button>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <?php } ?>
            <?php if($showHR) { ?>
                <div class="accordion role-accordion">

                    <div class="accordion-item border-0">

                        <h2 class="accordion-header">

                            <button type="button"
                                    class="accordion-button collapsed hr-btn"
                                    style="background:#f3e8ff;border-left:5px solid #6f42c1;"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#hr_<?php echo $row['mxap_assign_id']; ?>">

                                <div class="d-flex justify-content-between align-items-center w-100">

                                    <span>
                                        👨‍💼 HR Review
                                    </span>

                                    <small class="ml-auto mr-3">
                                        <?php echo $hrName; ?>
                                    </small>

                                </div>

                            </button>

                        </h2>

                        <div id="hr_<?php echo $row['mxap_assign_id']; ?>"
                            class="accordion-collapse collapse">

                            <div class="accordion-body role-card">
                                 <input type="hidden" class="formula-type" value="<?php echo $row['mxap_formula_type']; ?>">
                                 <input type="hidden" class="achievement-type" value="<?php echo strtolower($row['mxap_type']); ?>">
                                <div class="row g-3">

                                    <div class="col-md-1">
                                        <label class="form-label">Target</label>
                                        <input type="hidden" class="target-value" value="<?php echo $row['mxap_assign_monthlytarget']; ?>">
                                        <p class="form-label">
                                        <?php
                                        if($userdata['appraisalcategory'] == 2){
                                            echo $kc[$row['mxap_assign_monthlytarget']] ?? '-';
                                        }else{
                                            echo $row['mxap_assign_monthlytarget'];
                                        }
                                        ?>
                                        <br>(<?php echo $row['mxap_type']; ?>)
                                        </p>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Weightage</label>
                                        <input type="hidden" class="weightage-value" value="<?php echo $row['mxap_assign_weightage']; ?>">
                                        <p class="form-label">
                                            <?php echo $row['mxap_assign_weightage']; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Achieved Target</label>
                                        <p class="form-label hr-achieved-percent">0%</p>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Achieved Weightage</label>
                                        <p class="form-label hr-weight-score">0</p>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Final Assessment</label>
                                        <?php if($userdata['appraisalcategory'] == 2){ ?>
                                            <select name="hrachivement[]" class="form-control hr-achievement" <?php echo $hrReadonly ? 'disabled' : ''; ?>>
                                                <?php foreach($kc as $key => $value){ ?>
                                                    <option value="<?php echo $key; ?>"
                                                        <?php echo ($row['mxap_assign_hr_actual_assesment'] == $key ? 'selected' : ''); ?>>
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        <?php } else { ?>
                                        <input type="number" min="0" step="0.01" name="hrachivement[]" <?php if($row['mxap_type'] == 'clients') { ?> readonly <?php } ?> class="form-control hr-achievement updatehrcount_<?php echo $row['mxap_assign_id']; ?>" value="<?php echo $row['mxap_assign_hr_actual_assesment']; ?>"  <?php echo $hrReadonly ? 'readonly' : ''; ?> autocomplete="off">
                                        <?php } ?>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Review</label>
                                        <textarea name="hrdesc[]" class="form-control" rows="3"  <?php echo $hrReadonly ? 'readonly' : ''; ?>><?php echo $row['mxap_assign_hr_review']; ?></textarea>
                                    </div>
                                    <?php if($row['mxap_type'] == 'clients') {?>
                                        <button type="button"
                                                class="btn btn-primary col-md-2"
                                                onclick="openDetailsModal(
                                                    '<?php echo $row['mxap_assign_id']; ?>',
                                                    '<?php echo $row['mxap_assign_employee_code']; ?>',
                                                    '<?php echo $role; ?>'
                                                )">
                                            View/Add Details
                                        </button>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <?php } ?>
            <?php if($showReviewer){ ?>

            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button collapsed"
                                style="background:#fff3cd;border-left:5px solid #ffc107;"
                                data-bs-toggle="collapse"
                                data-bs-target="#reviewer_<?php echo $row['mxap_assign_id']; ?>">

                            <div class="d-flex justify-content-between align-items-center w-100">

                                <span>
                                    👀 Reviewer Review
                                </span>

                                <small class="ml-auto mr-3">
                                    <?php echo $reviewerName; ?>
                                </small>

                            </div>

                        </button>

                    </h2>

                    <div id="reviewer_<?php echo $row['mxap_assign_id']; ?>"
                        class="accordion-collapse collapse">

                        <div class="accordion-body role-card">
                             <input type="hidden" class="formula-type" value="<?php echo $row['mxap_formula_type']; ?>">
                             <input type="hidden" class="achievement-type" value="<?php echo strtolower($row['mxap_type']); ?>">
                            <div class="row g-3">

                                <div class="col-md-1">
                                    <label class="form-label">Target</label>
                                    <input type="hidden" class="target-value" value="<?php echo $row['mxap_assign_monthlytarget']; ?>">
                                    <p class="form-label">
                                        <?php
                                        if($userdata['appraisalcategory'] == 2){
                                            echo $kc[$row['mxap_assign_monthlytarget']] ?? '-';
                                        }else{
                                            echo $row['mxap_assign_monthlytarget'];
                                        }
                                        ?>
                                        <br>(<?php echo $row['mxap_type']; ?>)
                                    </p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Weightage</label>
                                    <input type="hidden" class="weightage-value" value="<?php echo $row['mxap_assign_weightage']; ?>">
                                    <p class="form-label">
                                        <?php echo $row['mxap_assign_weightage']; ?>
                                    </p>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Achieved Target</label>
                                    <p class="form-label reviewer-achieved-percent">0%</p>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Achieved Weightage</label>
                                    <p class="form-label reviewer-weight-score">0</p>
                                </div>

                                <div class="col-md-3">
                                    <label>Assessment</label>
                                    <?php if($userdata['appraisalcategory'] == 2){ ?>
                                        <select name="reviewerachivement[]" class="form-control reviewer-achievement" <?php echo $reviewerReadonly ? 'disabled' : ''; ?>>
                                            <?php foreach($kc as $key => $value){ ?>
                                                <option value="<?php echo $key; ?>"
                                                    <?php echo ($row['mxap_assign_reviewer_actual_assesment'] == $key ? 'selected' : ''); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                    <input type="number" min="0" step="0.01" name="reviewerachivement[]" <?php if($row['mxap_type'] == 'clients') { ?> readonly <?php } ?> class="form-control reviewer-achievement updatereviewercount_<?php echo $row['mxap_assign_id']; ?>" value="<?php echo $row['mxap_assign_reviewer_actual_assesment']; ?>" <?php echo $reviewerReadonly ? 'readonly' : ''; ?>>
                                    <?php } ?>
                                </div>

                                <div class="col-md-3">
                                    <label>Review</label>
                                    <textarea name="reviewerdesc[]" rows="3" class="form-control" <?php echo $reviewerReadonly ? 'readonly' : ''; ?>><?php echo $row['mxap_assign_reviewer_review']; ?></textarea>
                                </div>
                                <?php if($row['mxap_type'] == 'clients') {?>
                                    <button type="button"
                                            class="btn btn-primary col-md-2"
                                            onclick="openDetailsModal(
                                                '<?php echo $row['mxap_assign_id']; ?>',
                                                '<?php echo $row['mxap_assign_employee_code']; ?>',
                                                '<?php echo $role; ?>'
                                            )">
                                        View/Add Details
                                    </button>
                                <?php } ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>
        </div>

    </div>

</div>

<?php } ?>

</div>
<?php if($assigned['currentaccess']['action'] != 'VIEW') { ?>
<button type="button" id="saveAppraisalBtn" class="btn btn-primary" onclick="saveAppraisal()">Save Appraisal</button>
<?php } ?>
<input type="hidden" name="filterdata" value='<?php echo htmlspecialchars(json_encode($userdata), ENT_QUOTES, "UTF-8"); ?>'>
</form>

<!-- Modal -->
<div class="modal fade" id="addDetailsModal" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Client Details</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="clientDetailsForm">
                    <input type="hidden" id="modal_assignid" name="modal_assignid">
                    <input type="hidden" id="modal_empcode" name="modal_empcode">
                    <input type="hidden" id="modal_currentrole" name="modal_currentrole">
                    <div id="detailsContainer">

                        <div class="row g-3 detail-row mb-3">

                            <!-- <div class="col-md-5">
                                <label>Name</label>
                                <input type="text" name="client_name[]" class="form-control">
                            </div>

                            <div class="col-md-5">
                                <label>Description</label>
                                <textarea name="client_description[]" class="form-control"></textarea>
                            </div> -->

                            <input type="hidden" id="modal_assignid" name="modal_assignid">
                            <input type="hidden" id="modal_empcode" name="modal_empcode">
                            <input type="hidden" id="deletedIds" name="deletedIds" value="">
                            <input type="hidden" id="modal_currentrole" name="modal_currentrole">

                            <!-- <div class="col-md-2 d-flex align-items-end">
                                <button type="button"
                                        class="btn btn-danger removeRow">
                                    Remove
                                </button>
                            </div> -->

                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success mt-2" id="addMoreRow">+ Add More </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveClientDetailsBtn" onclick="saveClientDetails()">Save Details</button>
            </div>

        </div>

    </div>

</div>
<!-- Modal -->
<script>
function saveAppraisal() {

    if(!validateAppraisalForm()){
        return false;
    }

    var $btn = $("#saveAppraisalBtn");

    $.ajax({
        url: "<?php echo base_url('Employee/saveemployeekra'); ?>",
        type: "POST",
        data: $("#appraisalForm").serialize(),
        dataType: "json",

        beforeSend: function () {

            $btn.prop("disabled", true);

            $btn.html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Saving...'
            );

        },

        success: function (response) {

            $btn.prop("disabled", false);
            $btn.html('Save Appraisal');

            if(response.status == 1){

                alert(response.message);

            }else{

                alert(response.message);

            }

        },

        error: function (xhr) {

            $btn.prop("disabled", false);
            $btn.html('Save Appraisal');

            alert('Something went wrong.');

            console.log(xhr.responseText);

        }

    });

}

function validateAppraisalForm(){

    let valid = true;

    $('.is-invalid').removeClass('is-invalid');

    if(currentRole == 'EMPLOYEE'){

        $('.employee-achievement').each(function(){

            if($(this).val() == '' || $(this).val() == '0'){

                valid = false;

                $(this).addClass('is-invalid');

                // Open Question Accordion
                $(this)
                    .closest('.appraisal-item')
                    .find('.accordion-collapse:first')
                    .collapse('show');

                // Open Employee Accordion
                $(this)
                    .closest('.role-accordion')
                    .find('.accordion-collapse')
                    .collapse('show');

                $(this).focus();

                alert('Please fill Employee Achievement.');

                return false;
            }

        });

    }else if(currentRole == 'MANAGER'){

        $('.manager-achievement').each(function(){

            if($(this).val() == '' || $(this).val() == '0'){

                valid = false;

                $(this).addClass('is-invalid');

                $(this)
                    .closest('.appraisal-item')
                    .find('.accordion-collapse:first')
                    .collapse('show');

                $('#'+$(this).closest('.accordion-collapse').attr('id'))
                    .collapse('show');

                $(this).focus();

                alert('Please fill Manager Assessment.');

                return false;
            }

        });

    }else if(currentRole == 'HOD'){

        $('.hod-achievement').each(function(){

            if($(this).val() == '' || $(this).val() == '0'){

                valid = false;

                $(this).addClass('is-invalid');

                $(this)
                    .closest('.appraisal-item')
                    .find('.accordion-collapse:first')
                    .collapse('show');

                $('#'+$(this).closest('.accordion-collapse').attr('id'))
                    .collapse('show');

                $(this).focus();

                alert('Please fill HOD Assessment.');

                return false;
            }

        });

    }else if(currentRole == 'HR'){

        $('.hr-achievement').each(function(){

            if($(this).val() == '' || $(this).val() == '0'){

                valid = false;

                $(this).addClass('is-invalid');

                $(this)
                    .closest('.appraisal-item')
                    .find('.accordion-collapse:first')
                    .collapse('show');

                $('#'+$(this).closest('.accordion-collapse').attr('id'))
                    .collapse('show');

                $(this).focus();

                alert('Please fill HR Assessment.');

                return false;
            }

        });

    }else if(currentRole == 'REVIEWER'){

        $('.reviewer-achievement').each(function(){

            if($(this).val() == '' || $(this).val() == '0'){

                valid = false;

                $(this).addClass('is-invalid');

                $(this)
                    .closest('.appraisal-item')
                    .find('.accordion-collapse:first')
                    .collapse('show');

                $('#'+$(this).closest('.accordion-collapse').attr('id'))
                    .collapse('show');

                $(this).focus();

                alert('Please fill Reviewer Assessment.');

                return false;
            }

        });

    }

    return valid;
}

$(document).on(
    'change keyup',
    '.employee-achievement,.manager-achievement,.hod-achievement,.hr-achievement,.reviewer-achievement',
    function(){

        $(this).removeClass('is-invalid');

    }
);

var showManager = <?php echo $showManager ? 'true' : 'false'; ?>;
var showHOD = <?php echo $showHOD ? 'true' : 'false'; ?>;
var showHR = <?php echo $showHR ? 'true' : 'false'; ?>;
var showReviewer = <?php echo $showReviewer ? 'true' : 'false'; ?>;

var managerReadonly = <?php echo $managerReadonly ? 'true' : 'false'; ?>;
var hodReadonly = <?php echo $hodReadonly ? 'true' : 'false'; ?>;
var hrReadonly = <?php echo $hrReadonly ? 'true' : 'false'; ?>;
var reviewerReadonly = <?php echo $reviewerReadonly ? 'true' : 'false'; ?>;
var appraisalType = '<?php echo $userdata['appraisaltype'] ?? 1; ?>';
var currentRole = '<?php echo $role; ?>';
var currentAction = '<?php echo $action; ?>';
var employeeReadonly = <?php echo $employeeReadonly ? 'true' : 'false'; ?>;

var canDelete = false;

if((currentRole == 'EMPLOYEE') || (currentRole == 'MANAGER' && currentAction == 'ADD') || (currentRole == 'HOD' && currentAction == 'ADD') || (currentRole == 'HR' && currentAction == 'ADD') || (currentRole == 'REVIEWER' && currentAction == 'ADD')){
    canDelete = true;
}

var clientCounter = 1;
$(document)
    .off('click', '#addMoreRow')
    .on('click', '#addMoreRow', function(e){

        e.preventDefault();
        addClientRow();
        clientCounter++;

    });

function openDetailsModal(assignid, empcode, role){

    $('#modal_assignid').val(assignid);
    $('#modal_empcode').val(empcode);
    $('#modal_currentrole').val(role);

    $('#detailsContainer').html('');

    $.ajax({

        url : "<?php echo base_url('Employee/getClientDetails'); ?>",
        type : "POST",
        dataType : "json",

        data : {
            assignid : assignid,
            empcode  : empcode,
            modal_currentrole : role
        },

        success : function(response){
        $('#detailsContainer').html('');
            if(response.status == 1){

                $.each(response.data,function(index,row){
                    addClientRow(
                        row.macd_id,
                        row.macd_client_name,
                        row.macd_description,
                        row.macd_client_email,
                        row.macd_client_mobile,
                        row.macd_ismanager,
                        row.macd_manager_description,
                        row.macd_ishod,
                        row.macd_hod_description,
                        row.macd_ishr,
                        row.macd_hr_description,
                        row.macd_isreviewer,
                        row.macd_reviewer_description,
                        row.macd_created_role
                    );

                });

            }else{
                // $('#addMoreRow').trigger('click');
                // addClientRow('', '', '','',''); // Add an empty row if no data
                // addClientRow('', '', '', '', '',0, '',0, '',0, '',0, '');
            }

            var modal = new bootstrap.Modal(
                document.getElementById('addDetailsModal')
            );

            modal.show();

        }

    });

}

function addClientRow(
    id = '',
    name = '',
    description = '',
    email = '',
    mobile = '',

    ismanager = 0,
    managerdesc = '',

    ishod = 0,
    hoddesc = '',

    ishr = 0,
    hrdesc = '',

    isreviewer = 0,
    reviewerdesc = '',
    createdRole=''
){

    var clientNo = $('.detail-row').length + 1;
    var canDelete = false;

    if(createdRole == '' || createdRole == currentRole){
        canDelete = true;
    }

    var canEditOwnRecord = false;

    if(id == ''){
        // New row
        canEditOwnRecord = true;
    }
    else if(createdRole == currentRole){
        // Existing row created by same role
        canEditOwnRecord = true;
    }
    var html = `
    <div class="detail-row card mb-4 shadow-sm">

        <div class="card-header bg-info text-white">
            <strong>Client - ${clientNo}</strong>
        </div>

        <div class="card-body">

            <input type="hidden" name="detailid[]" value="${id}">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Name</label>
                    <input type="text"
                           name="client_name[]"
                           class="form-control"
                           value="${name}" ${!canEditOwnRecord ? 'readonly' : ''}>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="client_email[]"
                           class="form-control"
                           value="${email}" ${!canEditOwnRecord ? 'readonly' : ''}>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Mobile</label>
                    <input type="text"
                           name="client_mobile[]"
                           class="form-control"
                           value="${mobile}" ${!canEditOwnRecord ? 'readonly' : ''}>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Description</label>
                    <textarea name="client_description[]"
                              class="form-control" ${!canEditOwnRecord ? 'readonly' : ''}>${description}</textarea>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h6 class="text-primary">
                        Appraisal Authorization Details
                    </h6>
                </div>

                ${showManager ? `
                <div class="col-md-2 mb-3">
                    <label>Manager</label>
                    <select name="is_manager[]"
                            class="form-control"
                            ${managerReadonly ? 'disabled' : ''}>
                        <option value="0" ${ismanager == 0 ? 'selected' : ''}>No</option>
                        <option value="1" ${ismanager == 1 ? 'selected' : ''}>Yes</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Manager Description</label>
                    <textarea name="manager_description[]"
                              class="form-control"
                              ${managerReadonly ? 'readonly' : ''}>${managerdesc}</textarea>
                </div>
                ` : ''}

                ${showHOD ? `
                <div class="col-md-2 mb-3">
                    <label>HOD</label>
                    <select name="is_hod[]"
                            class="form-control"
                            ${hodReadonly ? 'disabled' : ''}>
                        <option value="0" ${ishod == 0 ? 'selected' : ''}>No</option>
                        <option value="1" ${ishod == 1 ? 'selected' : ''}>Yes</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>HOD Description</label>
                    <textarea name="hod_description[]"
                              class="form-control"
                              ${hodReadonly ? 'readonly' : ''}>${hoddesc}</textarea>
                </div>
                ` : ''}

                ${showHR ? `
                <div class="col-md-2 mb-3">
                    <label>HR</label>
                    <select name="is_hr[]"
                            class="form-control"
                            ${hrReadonly ? 'disabled' : ''}>
                        <option value="0" ${ishr == 0 ? 'selected' : ''}>No</option>
                        <option value="1" ${ishr == 1 ? 'selected' : ''}>Yes</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>HR Description</label>
                    <textarea name="hr_description[]"
                              class="form-control"
                              ${hrReadonly ? 'readonly' : ''}>${hrdesc}</textarea>
                </div>
                ` : ''}

                ${showReviewer ? `
                <div class="col-md-2 mb-3">
                    <label>Reviewer</label>
                    <select name="is_reviewer[]"
                            class="form-control"
                            ${reviewerReadonly ? 'disabled' : ''}>
                        <option value="0" ${isreviewer == 0 ? 'selected' : ''}>No</option>
                        <option value="1" ${isreviewer == 1 ? 'selected' : ''}>Yes</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Reviewer Description</label>
                    <textarea name="reviewer_description[]"
                              class="form-control"
                              ${reviewerReadonly ? 'readonly' : ''}>${reviewerdesc}</textarea>
                </div>
                ` : ''}

                ${canDelete ? `
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button"
                            class="btn btn-danger removeRow"
                            data-id="${id}">
                        Delete
                    </button>
                </div>
                ` : ''}

            </div>

        </div>

    </div>
    `;

    $('#detailsContainer').append(html);
}

$(document).off('click', '.removeRow').on('click', '.removeRow', function(){
    if(!confirm('Are you sure you want to delete this record?')){
        return;
    }
    var detailid = $(this).data('id');
    var currentRow = $(this).closest('.detail-row');

    // New row not yet saved
    if(detailid == '' || detailid == undefined){

        currentRow.remove();
        return;

    }
    $('.detail-row').each(function(index){
        $(this).find('.card-header strong')
               .text('Client - ' + (index + 1));
    });

    clientCounter = $('.detail-row').length + 1;
    $.ajax({

        url : "<?php echo base_url('Employee/deleteClientDetail'); ?>",
        type : "POST",
        dataType : "json",

        data : {
            detailid : detailid,
            currentrole : currentRole
        },

        success : function(response){

            if(response.status == 1){

                currentRow.remove();

                switch(currentRole){

                    case 'EMPLOYEE':

                        var obj = $('.updateclientcount_' + response.assignid);
                        obj.val(Math.max(0, parseInt(obj.val() || 0) - 1));
                        break;

                    case 'MANAGER':

                        var obj = $('.updatemanagercount_' + response.assignid);
                        obj.val(Math.max(0, parseInt(obj.val() || 0) - 1));
                        break;

                    case 'HOD':

                        var obj = $('.updatehodcount_' + response.assignid);
                        obj.val(Math.max(0, parseInt(obj.val() || 0) - 1));
                        break;

                    case 'HR':

                        var obj = $('.updatehrcount_' + response.assignid);
                        obj.val(Math.max(0, parseInt(obj.val() || 0) - 1));
                        break;

                    case 'REVIEWER':

                        var obj = $('.updatereviewercount_' + response.assignid);
                        obj.val(Math.max(0, parseInt(obj.val() || 0) - 1));
                        break;
                }
                    calculateAllSummaries();
                    alert(response.message);
                    saveAppraisal();
            }else{

                alert(response.message);

            }

        },

        error : function(xhr){

            console.log(xhr.responseText);

            alert('Unable to delete record.');

        }

    });

});


function saveClientDetails(){
    var rowCount = $('.detail-row').length;
    var assignId = $('#modal_assignid').val();

    var $btn = $("#saveClientDetailsBtn");

    $.ajax({

        url : "<?php echo base_url('Employee/saveClientDetails'); ?>",
        type : "POST",
        data : $("#clientDetailsForm").serialize(),
        dataType : "json",

        beforeSend : function(){

            $btn.prop("disabled", true);
            $btn.text("Saving...");

        },

        success : function(response){

            $btn.prop("disabled", false);
            $btn.text("Save Details");

            if(response.status == 1){
                switch(currentRole){

                    case 'EMPLOYEE':

                        $('.updateclientcount_' + response.assignid)
                            .val(response.employeecount);
                        break;

                    case 'MANAGER':

                        $('.updatemanagercount_' + response.assignid)
                            .val(response.managercount);
                        break;

                    case 'HOD':

                        $('.updatehodcount_' + response.assignid)
                            .val(response.hodcount);
                        break;

                    case 'HR':

                        $('.updatehrcount_' + response.assignid)
                            .val(response.hrcount);
                        break;

                    case 'REVIEWER':

                        $('.updatereviewercount_' + response.assignid)
                            .val(response.reviewercount);
                        break;
                }
                calculateAllSummaries();
                alert(response.message);
                saveAppraisal();
                $('#addDetailsModal').modal('hide');

                $('#clientDetailsForm')[0].reset();

            }else{

                alert(response.message);

            }

        },

        error : function(xhr){

            $btn.prop("disabled", false);
            $btn.text("Save Details");

            console.log(xhr.responseText);

            alert("Something went wrong.");

        }

    });

}


// function calculateSummary(
//     inputClass,
//     achievedPercentClass,
//     weightScoreClass,
//     targetId,
//     weightageId,
//     achievementId,
//     scoreId
// )
// {
//     let totalTarget = 0;
//     let totalWeightage = 0;
//     let totalAchievement = 0;
//     let totalWeightScore = 0;

//     $(inputClass).each(function(){

//         let roleCard = $(this).closest('.role-card');

//         let target =
//             parseFloat(
//                 roleCard.find('.target-value').first().val()
//             ) || 0;

//         let weightage =
//             parseFloat(
//                 roleCard.find('.weightage-value').first().val()
//             ) || 0;

//         let achievement =
//             parseFloat($(this).val()) || 0;

//         totalTarget += target;
//         totalWeightage += weightage;
//         totalAchievement += achievement;

//         let achievedPercent = 0;

//         if(target > 0){
//             achievedPercent = (achievement / target) * 100;
//         }

//         let weightScore =
//             (achievedPercent * weightage) / 100;

//         totalWeightScore += weightScore;

//         roleCard.find(achievedPercentClass)
//             .text(achievedPercent.toFixed(2) + '%');

//         roleCard.find(weightScoreClass)
//             .text(weightScore.toFixed(2));
//     });

//     $(targetId).text(totalTarget.toFixed(2));
//     $(weightageId).text(totalWeightage.toFixed(2));
//     $(achievementId).text(totalAchievement.toFixed(2));

//     let overallScore = 0;

//     if(totalWeightage > 0){
//         overallScore =
//             (totalWeightScore / totalWeightage) * 100;
//     }

//     $(scoreId).text(
//         overallScore.toFixed(2) + '%'
//     );
// }


function calculateSummary(
    inputClass,
    achievedPercentClass,
    weightScoreClass,
    questionCountId,
    filledCountId,
    achievedWeightageId,
    targetId,
    weightageId,
    achievementId,
    scoreId
)
{
    let totalTarget = 0;
    let totalWeightage = 0;
    let totalAchievement = 0;
    let totalWeightScore = 0;

    let totalQuestions = 0;
    let filledQuestions = 0;

    $(inputClass).each(function(){

        totalQuestions++;

        let roleCard = $(this).closest('.role-card');

        let target =
            parseFloat(
                roleCard.find('.target-value').first().val()
            ) || 0;

        let weightage =
            parseFloat(
                roleCard.find('.weightage-value').first().val()
            ) || 0;

        let achievement =
            parseFloat($(this).val()) || 0;

        let formulaType =
            $(this)
                .closest('.appraisal-item')
                .find('.formula-type')
                .first()
                .val() || 'DIRECT';

        formulaType = formulaType.toUpperCase();

        if($(this).val() !== ''){
            filledQuestions++;
        }

        totalTarget += target;
        totalWeightage += weightage;
        totalAchievement += achievement;

        let achievedPercent = 0;

        if (formulaType == 'DIRECT') {

            if (target > 0) {
                achievedPercent = (achievement / target) * 100;
            }

        } else if (formulaType == 'INDIRECT') {

            if (achievement > 0) {
                achievedPercent = (target / achievement) * 100;
            }
        }
        // Cap maximum achievement to 100%
        // Restrict between 0 and 100
        achievedPercent = Math.max(0, Math.min(achievedPercent, 100));
        let weightScore =
            (achievedPercent * weightage) / 100;

        totalWeightScore += weightScore;

        roleCard.find(achievedPercentClass)
            .text(achievedPercent.toFixed(2) + '%');

        roleCard.find(weightScoreClass)
            .text(weightScore.toFixed(2));
    });

    $(questionCountId).text(totalQuestions);

    $(filledCountId).text(
        filledQuestions + ' / ' + totalQuestions
    );

    $(achievedWeightageId).text(
        totalWeightScore.toFixed(2)
    );

    $(targetId).text(
        totalTarget.toFixed(2)
    );

    $(weightageId).text(
        totalWeightage.toFixed(2)
    );

    $(achievementId).text(
        totalAchievement.toFixed(2)
    );

    let overallScore = 0;

    if(totalWeightage > 0){

        overallScore =
            (totalWeightScore / totalWeightage) * 100;
    }

    $(scoreId).text(
        overallScore.toFixed(2) + '%'
    );
}

function calculateAllSummaries()
{
    // Employee
    calculateSummary(
        '.employee-achievement',
        '.employee-achieved-percent',
        '.employee-weight-score',
        '#empTotalQuestions',
        '#empFilledQuestions',
        '#empAchievedWeightage',
        '#empTotalTarget',
        '#empTotalWeightage',
        '#empTotalAchievement',
        '#empOverallScore'
    );

    // Manager
    calculateSummary(
        '.manager-achievement',
        '.manager-achieved-percent',
        '.manager-weight-score',
        '#managerTotalQuestions',
        '#managerFilledQuestions',
        '#managerAchievedWeightage',
        '#managerTotalTarget',
        '#managerTotalWeightage',
        '#managerTotalAchievement',
        '#managerOverallScore'
    );

    // HOD
    calculateSummary(
        '.hod-achievement',
        '.hod-achieved-percent',
        '.hod-weight-score',
        '#hodTotalQuestions',
        '#hodFilledQuestions',
        '#hodAchievedWeightage',
        '#hodTotalTarget',
        '#hodTotalWeightage',
        '#hodTotalAchievement',
        '#hodOverallScore'
    );

    // HR
    calculateSummary(
        '.hr-achievement',
        '.hr-achieved-percent',
        '.hr-weight-score',
        '#hrTotalQuestions',
        '#hrFilledQuestions',
        '#hrAchievedWeightage',
        '#hrTotalTarget',
        '#hrTotalWeightage',
        '#hrTotalAchievement',
        '#hrOverallScore'
    );

    // Reviewer
    calculateSummary(
        '.reviewer-achievement',
        '.reviewer-achieved-percent',
        '.reviewer-weight-score',
        '#reviewerTotalQuestions',
        '#reviewerFilledQuestions',
        '#reviewerAchievedWeightage',
        '#reviewerTotalTarget',
        '#reviewerTotalWeightage',
        '#reviewerTotalAchievement',
        '#reviewerOverallScore'
    );
}

$(document).on(
    'keyup change',
    '.employee-achievement,.manager-achievement,.hod-achievement,.hr-achievement,.reviewer-achievement',
    function(){
        calculateAllSummaries();
    }
);

$(document).ready(function(){
    calculateAllSummaries();
});

function calculateAchievementSummary(inputClass, outputId)
{
    var summary = {};

    $(inputClass).each(function(){

        var roleCard = $(this).closest('.role-card');

        var achieved = parseFloat($(this).val()) || 0;

        var target = parseFloat(
            roleCard.find('.target-value').val()
        ) || 0;

        var type = roleCard.find('.achievement-type').val();

        if(!type){
            return;
        }

        if(summary[type] == undefined){

            summary[type] = {
                target : 0,
                achieved : 0
            };

        }

        summary[type].target += target;
        summary[type].achieved += achieved;

    });

    var html = '';

    $.each(summary,function(type,item){

        switch(type){

            case 'amount':
                html += '<div><b>Amount :</b> ₹'
                      + Number(item.target).toLocaleString()
                      + ' / ₹'
                      + Number(item.achieved).toLocaleString()
                      + '</div>';
            break;

            case 'percentage':
                html += '<div><b>Percentage :</b> '
                      + item.target
                      + '% / '
                      + item.achieved
                      + '%</div>';
            break;

            default:

                html += '<div><b>'
                      + type.charAt(0).toUpperCase()+type.slice(1)
                      + ' :</b> '
                      + item.target
                      + ' / '
                      + item.achieved
                      + '</div>';

        }

    });

    if(html == ''){
        html = '0';
    }

    $(outputId).html(html);
}

$(document).on('keyup change',
'.employee-achievement,.manager-achievement,.hod-achievement,.hr-achievement,.reviewer-achievement',
function(){


    calculateAchievementSummary('.employee-achievement', '#empTotalAchievement');

    calculateAchievementSummary('.manager-achievement', '#managerTotalAchievement');

    calculateAchievementSummary('.hod-achievement', '#hodTotalAchievement');

    calculateAchievementSummary('.hr-achievement', '#hrTotalAchievement');

    calculateAchievementSummary('.reviewer-achievement', '#reviewerTotalAchievement');

});

$(document).ready(function () {

    $('#empTotalAchievement').html('');
    $('#managerTotalAchievement').html('');
    $('#hodTotalAchievement').html('');
    $('#hrTotalAchievement').html('');
    $('#reviewerTotalAchievement').html('');

    calculateAchievementSummary('.employee-achievement', '#empTotalAchievement');
    calculateAchievementSummary('.manager-achievement', '#managerTotalAchievement');
    calculateAchievementSummary('.hod-achievement', '#hodTotalAchievement');
    calculateAchievementSummary('.hr-achievement', '#hrTotalAchievement');
    calculateAchievementSummary('.reviewer-achievement', '#reviewerTotalAchievement');
});
</script>