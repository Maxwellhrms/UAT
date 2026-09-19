<style>
    .nav-tabs .nav-link{
    color:#6c757d;
    font-weight:600;
    border:none;
}

.nav-tabs .nav-link.active{
    color:#0d6efd;
    border-bottom:3px solid #0d6efd;
    background:transparent;
}

.tab-content{
    padding-top:10px;
}
</style>
<div class="container-fluid p-4">
    <!-- PAGE TITLE -->
<!--     <div class="hrms_page_title">
        Detailed Dashboard
    </div> -->

    <div class="row g-4">
        <div class="col-xl-3 col-lg-4">
            <div class="hrms_dashboard_card">
                <div class="hrms_card_title">
                   Approved Attendance Statistics
                </div>
                <div id="hrms_attendance_chart"></div>
                <div class="text-center mt-3">
                    <h6>Total Employees Under You</h6>
                    <h2 class="fw-bold">
                        <?php echo $dashboarddetails['totalemployees']; ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4">
            <div class="hrms_dashboard_card">
                <div class="hrms_card_title">
                    Approved Leave Statistics
                </div>
                <div id="hrms_leave_chart"></div>
                <div class="text-center mt-3">
                    <h6>Total Leave Requests</h6>
                    <h2 class="fw-bold">
                        <?php 
                            echo 
                                $dashboarddetails['CL']['total'] +
                                $dashboarddetails['SL']['total'] +
                                $dashboarddetails['EL']['total'] +
                                $dashboarddetails['ML']['total'] +
                                $dashboarddetails['SHRT']['total'];
                        ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4">
            <div class="hrms_dashboard_card">
                <div class="hrms_card_title">
                    Pending Leave/Regulations
                </div>
                <div id="hrms_pendingleave_chart"></div>
                <div class="text-center mt-3">
                    <h6>Total Leave/Regulations Requests</h6>
                    <h2 class="fw-bold">
                        <?php 
                            echo 
                                $dashboarddetails['OT']['pending']['total'] +
                                $dashboarddetails['AR']['pending']['total'] +
                                $dashboarddetails['CL']['pending']['total'] +
                                $dashboarddetails['SL']['pending']['total'] +
                                $dashboarddetails['EL']['pending']['total'] +
                                $dashboarddetails['ML']['pending']['total'] +
                                $dashboarddetails['SHRT']['pending']['total'];
                        ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>

   <!-- INCREMENTS -->
<!-- <div class="row g-4 mt-1">
    <div class="col-lg-12">
        <div class="hrms_dashboard_card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div class="hrms_card_title mb-0">
                    Employees Increments
                </div>
            </div>
            <div id="hrms_increments_chart"></div>
        </div>
    </div>
</div> -->
<div class="row g-4 mt-1">
    <div class="col-lg-12">
        <div class="hrms_dashboard_card">

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="hrmsDashboardTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            id="movement-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#movement"
                            type="button">
                        Join / Resign
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="increment-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#increment"
                            type="button">
                        Increments
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="branchsalary-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#branchsalary"
                            type="button">
                        Branch Wise Salaries
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="employeesservice-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#employeesservice"
                            type="button">
                        Employees Service Summary
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">

                <!-- Employee Movement -->
                <div class="tab-pane fade show active" id="movement" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="fa fa-user-plus text-success"></i>
                            /
                            <i class="fa fa-minus text-danger"></i>
                            All India Employee Movement
                        </h5>
                    </div>
                    <div id="employee_movement_chart"></div>
                </div>

                <!-- Increment Chart -->
                <div class="tab-pane fade"
                     id="increment"
                     role="tabpanel">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="fas fa-money-bill-wave text-primary"></i>
                            Employees Increments
                        </h5>
                    </div>

                    <div id="hrms_increments_chart"></div>
                </div>

                <!-- Branch Wise Salaries -->
                <div class="tab-pane fade" id="branchsalary" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">

                            All India Branch Salaries
                        </h5>
                    </div>
                    <div id="branch_salary_chart"></div>
                </div>

                <!-- Employees Service Summary -->
                <div class="tab-pane fade" id="employeesservice" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            All India Employees Service Summary
                        </h5>
                    </div>
                    <div id="employees_service_chart"></div>
                </div>

            </div>

        </div>
    </div>
</div>



<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="hrms_dashboard_card">
            <div class="hrms_card_title">
                Attendance Summary
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_present_bg">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    On Time
                                </h6>
                                <small class="text-muted">
                                    Employees
                                </small>
                            </div>
                        </div>

                        <div class="hrms_single_count_box">
                            <div class="hrms_single_count_label">
                                Total Employees Count
                            </div>
                            <div class="hrms_single_count_value text-success">
                                <?php echo $dashboarddetails['ontime']['count']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_late_bg">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Late Coming
                                </h6>
                                <small class="text-muted">
                                    Employees 
                                </small>
                            </div>
                        </div>

                        <div class="hrms_single_count_box">
                            <div class="hrms_single_count_label">
                                Total Employees Count
                            </div>
                            <div class="hrms_single_count_value text-danger">
                                <?php echo $dashboarddetails['late']['count']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_present_bg">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Present
                                </h6>
                                <small class="text-muted">
                                    PR
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <!-- APPROVED -->
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['PR']['total']; ?>
                                </span>
                            </div>

                            <!-- PENDING -->
                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['PR']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_absent_bg">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Absent
                                </h6>
                                <small class="text-muted">
                                    AB
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-danger">
                                    <?php echo $dashboarddetails['AB']['total']; ?>
                                </span>
                            </div>
                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['AB']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_onduty_bg">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    On Duty
                                </h6>
                                <small class="text-muted">
                                    OD
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>

                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['OD']['total']; ?>
                                </span>
                            </div>

                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                     <?php echo $dashboarddetails['OD']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_ontour_bg">
                                <i class="bi bi-airplane-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    On Tour
                                </h6>
                                <small class="text-muted">
                                    OT
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['OT']['total']; ?>
                                </span>
                            </div>

                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['OT']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_regulation_bg">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>

                            <div>
                                <h6 class="mb-0">
                                    Regulations
                                </h6>
                                <small class="text-muted">
                                    AR
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['AR']['total']; ?>
                                </span>
                            </div>

                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['AR']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="hrms_dashboard_card">
            <div class="hrms_card_title">
                Leave Summary
            </div>
            <div class="row g-3">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_cl_bg">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Casual Leave
                                </h6>
                                <small class="text-muted">
                                    CL
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                   <?php echo $dashboarddetails['CL']['total']; ?>
                                </span>
                            </div>

                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['CL']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_sl_bg">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Sick Leave
                                </h6>
                                <small class="text-muted">
                                    SL
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['SL']['total']; ?>
                                </span>
                            </div>

                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['SL']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_el_bg">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Earn Leave
                                </h6>
                                <small class="text-muted">
                                    EL
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['EL']['total']; ?>
                                </span>
                            </div>
                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['EL']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

<!--                 <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_ml_bg">
                                <i class="bi bi-person-hearts"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Maternity Leave
                                </h6>
                                <small class="text-muted">
                                    ML
                                </small>
                            </div>
                        </div>
                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['ML_APPROVED']; ?>
                                </span>
                            </div>
                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['ML_PENDING']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hrms_leave_card">
                        <div class="hrms_leave_header">
                            <div class="hrms_leave_icon hrms_shrt_bg">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">
                                    Short Leave
                                </h6>
                                <small class="text-muted">
                                    SHRT
                                </small>
                            </div>
                        </div>

                        <div class="hrms_leave_body">
                            <div class="hrms_leave_row">
                                <span>
                                    Approved
                                </span>
                                <span class="badge bg-success">
                                    <?php echo $dashboarddetails['SHRT']['total']; ?>
                                </span>
                            </div>
                            <div class="hrms_leave_row">
                                <span>
                                    Pending
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <?php echo $dashboarddetails['SHRT']['pending']['total']; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
    <div class="row hrms_dashboard_card">
    <div class="table-responsive">
        <table id="attendanceTable" class="table align-middle nowrap">

            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee Code</th>
                    <th>PR</th>
                    <th>AB</th>
                    <th>CL</th>
                    <th>CL Pending</th>
                    <th>CL Rejected</th>
                    <th>SL</th>
                    <th>SL Pending</th>
                    <th>SL Rejected</th>                    
                    <th>EL</th>
                    <th>EL Pending</th>
                    <th>EL Rejected</th>   
                    <th>SHRT</th>
                    <th>SHRT Pending</th>
                    <th>SHRT Rejected</th>
                    <th>OH</th>        
                    <th>ML</th>
                    <th>LOP</th>
                    <th>LOP Pending</th>
                    <th>LOP Rejected</th>
                    <th>OT</th>
                    <th>OT Pending</th>
                    <th>OT Rejected</th>
                    <th>AR</th>
                    <th>AR Pending</th>
                    <th>AR Rejected</th>                    
                    <th>WO</th>
                    <th>PH</th>
                    <th>Late</th>
                    <th>On Time</th>
                    <th>Total Days</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dashboarddetails['employee_wise_count'] as $empcode=>$row){ ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo HRADMINROOTDOCUMENT.$row['employeeimage']; ?>" alt="Employee"style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:1px solid #ddd;">
                            <span>
                                <?php echo $row['employeename']; ?>
                            </span>
                        </div>
                    </td>
                    <td><?php echo $empcode; ?></td>
                    <td><span class="hrms-badge bg-pr"><?php echo $row['PR']; ?></span></td>
                    <td><span class="hrms-badge bg-ab"><?php echo $row['AB']; ?></span></td>
                    <td><span class="hrms-badge bg-cl"><?php echo $row['CL']; ?></span></td>
                    <td><span class="hrms-badge bg-clp"><?php echo $row['CL_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-clr"><?php echo $row['CL_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-sl"><?php echo $row['SL']; ?></span></td>
                    <td><span class="hrms-badge bg-slp"><?php echo $row['SL_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-slr"><?php echo $row['SL_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-el"><?php echo $row['EL']; ?></span></td>
                    <td><span class="hrms-badge bg-slp"><?php echo $row['EL_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-slr"><?php echo $row['EL_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-el"><?php echo $row['SHRT']; ?></span></td>
                    <td><span class="hrms-badge bg-slp"><?php echo $row['SHRT_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-slr"><?php echo $row['SHRT_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-el"><?php echo $row['OH']; ?></span></td>
                    <td><span class="hrms-badge bg-ml"><?php echo $row['ML']; ?></span></td>
                    <td><span class="hrms-badge bg-lop"><?php echo $row['LOP']; ?></span></td>
                    <td><span class="hrms-badge bg-slp"><?php echo $row['LOP_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-slr"><?php echo $row['LOP_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['OT']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['OT_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['OT_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['AR']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['AR_pending']; ?></span></td>
                    <td><span class="hrms-badge bg-ot"><?php echo $row['AR_rejected']; ?></span></td>
                    <td><span class="hrms-badge bg-wo"><?php echo $row['WO']; ?></span></td>
                    <td><span class="hrms-badge bg-ph"><?php echo $row['PH']; ?></span></td>
                    <td><span class="hrms-badge bg-late"><?php echo $row['late']; ?></span></td>
                    <td><span class="hrms-badge bg-ontime"><?php echo $row['ontime']; ?></span></td>

                    <td>
                        <strong>
                            <?php echo $row['totaldays']; ?>
                        </strong>
                    </td>

                </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>
    </div> 
</div>


<div class="modal fade" id="hrmsEmployeeModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hrmsModalTitle">
                    Employee Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="hrmsEmployeeTableBody">

            </div>
        </div>
    </div>
</div>

<script>
var attendanceChart = new ApexCharts(
    document.querySelector("#hrms_attendance_chart"),{
        series:[
            <?php echo $dashboarddetails['PR']['total']; ?>,
            <?php echo $dashboarddetails['AB']['total']; ?>,
            <?php echo $dashboarddetails['OD']['total']; ?>,
            <?php echo $dashboarddetails['OT']['total']; ?>,
            <?php echo $dashboarddetails['AR']['total']; ?>,
            <?php echo $dashboarddetails['WO']['total']; ?>,
            <?php echo $dashboarddetails['ontime']['count']; ?>,
            <?php echo $dashboarddetails['late']['count']; ?>
        ],
        chart:{
            type:'donut',
            height:320,
            events:{
                dataPointSelection:function(
                    event,
                    chartContext,
                    config
                ){
                    let label =
                        config.w.config.labels[
                            config.dataPointIndex
                        ];
                    let type = '';
                    let employeecodes = [];
                    switch(label){
                        case 'Present':
                            type = 'PR';
                            employeecodes = <?php echo json_encode($dashboarddetails['PR']['employeecodes']); ?>;
                        break;
                        case 'Absent':
                            type = 'AB';
                            employeecodes = <?php echo json_encode($dashboarddetails['AB']['employeecodes']); ?>;
                        break;
                        case 'On Duty':
                            type = 'OD';
                            employeecodes = <?php echo json_encode($dashboarddetails['OD']['employeecodes']); ?>;
                        break;
                        case 'On Tour':
                            type = 'OT';
                            employeecodes = <?php echo json_encode($dashboarddetails['OT']['employeecodes']); ?>;

                        break;
                        case 'Regulations':
                            type = 'AR';
                            employeecodes = <?php echo json_encode($dashboarddetails['AR']['employeecodes']); ?>;
                        break;
                        case 'Week Off':
                            type = 'WO';
                            employeecodes = <?php echo json_encode($dashboarddetails['WO']['employeecodes']); ?>;
                        break;
                        case 'On Time':
                            type = 'ONTIME';
                            employeecodes = <?php echo json_encode($dashboarddetails['ontime']['employeecodes']); ?>;
                        break;
                        case 'Late Coming':
                            type = 'LATE';
                            employeecodes = <?php echo json_encode($dashboarddetails['late']['employeecodes']); ?>;
                        break;
                    }
                    showAttendanceEmployeeDetails(
                        type,
                        employeecodes,
                        companyid = '<?php echo $userfilters['esi_company_id']; ?>',
                        divisionid = '<?php echo $userfilters['esi_div_id']; ?>',
                        stateid = '<?php echo $userfilters['esi_state_id']; ?>',
                        branchid = '<?php echo $userfilters['esi_branch_id']; ?>',
                        fromdate = '<?php echo $userfilters['fromdate']; ?>',
                        todate = '<?php echo $userfilters['todate']; ?>',
                        categories = 'APPROVED'
                    );
                }
            }
        },
        labels:[
            'Present',
            'Absent',
            'On Duty',
            'On Tour',
            'Regulations',
            'Week Off',
            'On Time',
            'Late Coming'
        ],
        colors:[
            '#22c55e',
            '#ef4444',
            '#3b82f6',
            '#06b6d4',
            '#f59e0b',
            '#6b7280',
            '#10b981',
            '#f97316'
        ],
        legend:{
            position:'bottom',
            fontSize:'14px'
        },
        dataLabels:{
            enabled:true
        },
        stroke:{
            width:2
        }
    }
);
attendanceChart.render();

var leaveOptions = {
    series: [
        <?php echo $dashboarddetails['CL']['total']; ?>,
        <?php echo $dashboarddetails['SL']['total']; ?>,
        <?php echo $dashboarddetails['EL']['total']; ?>,
        <?php echo $dashboarddetails['ML']['total']; ?>,
        <?php echo $dashboarddetails['SHRT']['total']; ?>
    ],
    chart: {
        type: 'donut',
        height: 320,
        events: {
            dataPointSelection: function (
                event,
                chartContext,
                config
            ){
                let label =
                    config.w.config.labels[
                        config.dataPointIndex
                    ];
                let type = '';
                let employeecodes = [];
                switch(label){
                    case 'Casual Leave':
                        type = 'CL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['CL']['employeecodes']); ?>;
                    break;
                    case 'Sick Leave':
                        type = 'SL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['SL']['employeecodes']); ?>;
                    break;
                    case 'Earn Leave':
                        type = 'EL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['EL']['employeecodes']); ?>;
                    break;
                    case 'Maternity Leave':
                        type = 'ML';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['ML']['employeecodes']); ?>;
                    break;
                    case 'Short Leave':
                        type = 'SHRT';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['SHRT']['employeecodes']); ?>;
                    break;
                }
                showAttendanceEmployeeDetails(
                    type,
                    employeecodes,
                    companyid = '<?php echo $userfilters['esi_company_id']; ?>',
                    divisionid = '<?php echo $userfilters['esi_div_id']; ?>',
                    stateid = '<?php echo $userfilters['esi_state_id']; ?>',
                    branchid = '<?php echo $userfilters['esi_branch_id']; ?>',
                    fromdate = '<?php echo $userfilters['fromdate']; ?>',
                    todate = '<?php echo $userfilters['todate']; ?>',
                    categories = 'APPROVED'
                );
            }
        }
    },
    labels: [
        'Casual Leave',
        'Sick Leave',
        'Earn Leave',
        'Maternity Leave',
        'Short Leave'
    ],
    colors: [
        '#3b82f6',
        '#ef4444',
        '#22c55e',
        '#a855f7',
        '#f59e0b'
    ],
    legend: {
        position: 'bottom'
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: '100%'
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};
var leaveChart = new ApexCharts(
    document.querySelector("#hrms_leave_chart"),
    leaveOptions
);
leaveChart.render();


var pendingleaveOptions = {
    series: [
        <?php echo $dashboarddetails['OT']['pending']['total']; ?>,
        <?php echo $dashboarddetails['AR']['pending']['total']; ?>,
        <?php echo $dashboarddetails['CL']['pending']['total']; ?>,
        <?php echo $dashboarddetails['SL']['pending']['total']; ?>,
        <?php echo $dashboarddetails['EL']['pending']['total']; ?>,
        <?php echo $dashboarddetails['ML']['pending']['total']; ?>,
        <?php echo $dashboarddetails['SHRT']['pending']['total']; ?>
    ],
    chart: {
        type: 'donut',
        height: 320,
        events: {
            dataPointSelection: function (
                event,
                chartContext,
                config
            ){
                let label =
                    config.w.config.labels[
                        config.dataPointIndex
                    ];
                let type = '';
                let employeecodes = [];
                switch(label){
                     case 'On Tour':
                        type = 'OT';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['OT']['pending']['employeecodes']); ?>;
                    break;
                    case 'Regulations':
                        type = 'AR';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['AR']['pending']['employeecodes']); ?>;
                    break;
                    case 'Casual Leave':
                        type = 'CL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['CL']['pending']['employeecodes']); ?>;
                    break;
                    case 'Sick Leave':
                        type = 'SL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['SL']['pending']['employeecodes']); ?>;
                    break;
                    case 'Earn Leave':
                        type = 'EL';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['EL']['pending']['employeecodes']); ?>;
                    break;
                    case 'Maternity Leave':
                        type = 'ML';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['ML']['pending']['employeecodes']); ?>;
                    break;
                    case 'Short Leave':
                        type = 'SHRT';
                        employeecodes =
                            <?php echo json_encode($dashboarddetails['SHRT']['pending']['employeecodes']); ?>;
                    break;
                }
                showAttendanceEmployeeDetails(
                    type,
                    employeecodes,
                    companyid = '<?php echo $userfilters['esi_company_id']; ?>',
                    divisionid = '<?php echo $userfilters['esi_div_id']; ?>',
                    stateid = '<?php echo $userfilters['esi_state_id']; ?>',
                    branchid = '<?php echo $userfilters['esi_branch_id']; ?>',
                    fromdate = '<?php echo $userfilters['fromdate']; ?>',
                    todate = '<?php echo $userfilters['todate']; ?>',
                    categories = 'PENDING'
                );
            }
        }
    },
    labels: [
        'On Tour',
        'Regulations',
        'Casual Leave',
        'Sick Leave',
        'Earn Leave',
        'Maternity Leave',
        'Short Leave'
    ],
    colors: [
        '#6b7280',
        '#06b6d4',
        '#3b82f6',
        '#ef4444',
        '#22c55e',
        '#a855f7',
        '#f59e0b'
    ],
    legend: {
        position: 'bottom'
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: '100%'
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};
var pendingleaveChart = new ApexCharts(
    document.querySelector("#hrms_pendingleave_chart"),
    pendingleaveOptions
);
pendingleaveChart.render();






var incrementMonths =
    <?php echo json_encode(array_column($incrementData, 'month')); ?>;

var incrementCounts =
    <?php echo json_encode(array_column($incrementData, 'count')); ?>;

var incrementEmployeeCodes =
    <?php echo json_encode(array_column($incrementData, 'employeecodes')); ?>;

var incrementAmounts =
    <?php echo json_encode(array_column($incrementData, 'totalamount')); ?>;

function openIncrementPopup(index){
    let month = incrementMonths[index];
    let selectedEmployeeCodes = incrementEmployeeCodes[index];
    if(!selectedEmployeeCodes || selectedEmployeeCodes.length == 0){
        return;
    }
    showAttendanceEmployeeDetails(
        'INCREMENT',
        selectedEmployeeCodes,
        '<?php echo $userfilters['esi_company_id']; ?>',
        '<?php echo $userfilters['esi_div_id']; ?>',
        '<?php echo $userfilters['esi_state_id']; ?>',
        '<?php echo $userfilters['esi_branch_id']; ?>',
        month,
        month,
        categories = ''
    );
}

var onIncrementChart = new ApexCharts(
    document.querySelector("#hrms_increments_chart"),
    {
        series:[{
            name:'Employees',
            data: incrementCounts.map(function(val){
                if(val > 0 && val < 5){
                    return 5;
                }
                return val;
            })
        }],
        chart:{
            type:'bar',
            height:420,
            toolbar:{
                show:false
            },
            events:{
                dataPointSelection:function(
                    event,
                    chartContext,
                    config
                ){
                    if(
                        typeof config.dataPointIndex === 'undefined'
                        ||
                        config.dataPointIndex < 0
                    ){
                        return;
                    }
                    openIncrementPopup(
                        config.dataPointIndex
                    );
                }
            }
        },
        colors:[

            '#3b82f6',
            '#06b6d4',
            '#10b981',
            '#22c55e',
            '#f59e0b',
            '#f97316',
            '#ef4444',
            '#8b5cf6',
            '#6366f1',
            '#14b8a6',
            '#84cc16',
            '#eab308'
        ],
        legend:{
            position:'bottom'
        },
        plotOptions:{
            bar:{
                borderRadius:8,
                columnWidth:'45%',
                distributed:true,
                dataLabels:{
                    position:'top'
                }
            }
        },
        dataLabels:{
            enabled:true,
            offsetY:-18,
            style:{
                fontSize:'13px',
                fontWeight:'700',
                colors:['#111']
            },
            formatter:function(val, opts){
                var count = incrementCounts[opts.dataPointIndex];
                var amount = incrementAmounts[opts.dataPointIndex];
                return count + '\n (₹' + Number(amount).toLocaleString('en-IN') + ')';
                // return incrementCounts[
                //     opts.dataPointIndex
                // ];
            }
        },
        xaxis:{
            categories:incrementMonths,
            labels:{
                rotate:0,
                style:{
                    fontSize:'13px',
                    fontWeight:600
                }
            }
        },
        yaxis:{
            min:0,
            max:300,
            tickAmount:6,
            title:{
                text:'Employees Count'
            }
        },
        tooltip:{
            y:{
                formatter:function(val, opts){
                    // return incrementCounts[
                    //     opts.dataPointIndex
                    // ] + ' Employees';
                    var count = incrementCounts[opts.dataPointIndex];
                    var amount = incrementAmounts[opts.dataPointIndex] || 0;

                    return count +
                    ' Employees | ₹' +
                    Number(amount).toLocaleString('en-IN');
                }
            }
        },
        grid:{
            borderColor:'#e5e7eb'
        }
    }
);
onIncrementChart.render();
setTimeout(function(){
    $('#hrms_increments_chart .apexcharts-xaxis-texts-g text').each(function(index){
        $(this).css({
            cursor:'pointer'
        });
        $(this).on('click', function(){
            openIncrementPopup(index);
        });
    });

    $('#hrms_increments_chart .apexcharts-legend-series').each(function(index){
        $(this).css({
            cursor:'pointer'
        });
        $(this).on('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            openIncrementPopup(index);
            return false;
        });
    });
    $('#hrms_increments_chart .apexcharts-bar-area').css({
        cursor:'pointer'
    });
}, 1000);


function showAttendanceEmployeeDetails(type,employeecodes,companyid,divisionid,stateid,branchid,fromdate,todate,categories=''){
    $('#hrmsModalTitle').html(type + ' Employee Details');
    $('#hrmsEmployeeTableBody').html(`
        <tr>
            <td colspan="7" class="text-center p-5">
                <div class="spinner-border text-primary"></div>
            </td>
        </tr>
    `);
    let employeeModal = new bootstrap.Modal(
        document.getElementById('hrmsEmployeeModal')
    );
    employeeModal.show();
    $.ajax({
        url: baseurl + 'Employee/getAllEmployeesAttendance',
        type:'POST',
        data:{
            type:type,
            employeecodes:employeecodes,
            companyid:companyid,
            divisionid:divisionid,
            stateid:stateid,
            branchid:branchid,
            fromdate:fromdate,
            todate:todate,
            categories : categories
        },
        success:function(response){
            $('#hrmsEmployeeTableBody').html(response);
            // Destroy existing DataTable
            if ($.fn.DataTable.isDataTable('#hrmsEmployeeTable')) {
                $('#hrmsEmployeeTable').DataTable().destroy();
            }
            // Initialize DataTable
            $('#hrmsEmployeeTable').DataTable({
                responsive: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        className: 'btn btn-success btn-sm',
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) {
                                    // Remove HTML tags
                                    return $('<div>').html(data).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        className: 'btn btn-primary btn-sm',
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) {
                                    // Remove HTML tags
                                    return $('<div>').html(data).text().trim();
                                }
                            }
                        }
                    }
                ]
            });
        },
        error:function(){
            $('#hrmsEmployeeTableBody').html(`
                <tr>
                    <td colspan="7" class="text-danger text-center p-4">
                        Failed to load data
                    </td>
                </tr>
            `);
        }
    });
}

$(document).ready(function(){

    if($.fn.DataTable.isDataTable('#attendanceTable')){
        $('#attendanceTable').DataTable().destroy();
    }

    $('#attendanceTable').DataTable({
        responsive:true,
        scrollX:true,
        autoWidth:false,
        processing:true,
        pageLength:10,
        lengthMenu:[
            [10,25,50,100,-1],
            [10,25,50,100,'All']
        ],
        dom:"<'row mb-3'<'col-md-6 d-flex gap-2 align-items-center'B l><'col-md-6 text-end'f>>"+
            "<'row'<'col-12'tr>>"+
            "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",

        buttons:[
            {
                extend:'excelHtml5',
                text:'Export Excel',
                className:'btn btn-success btn-sm',
                title:'Employee_Attendance_Report'
            },
            {
                extend:'csvHtml5',
                text:'Export CSV',
                className:'btn btn-primary btn-sm',
                title:'Employee_Attendance_Report'
            }
        ],

        columnDefs:[
            {
                targets:'_all',
                className:'text-center align-middle'
            },
            {
                targets:0,
                className:'text-start'
            }
        ],

        language:{
            search:'',
            searchPlaceholder:'Search Employee...',
            lengthMenu:'_MENU_ Records Per Page',
            info:'Showing _START_ to _END_ of _TOTAL_ Employees',
            paginate:{
                first:'First',
                last:'Last',
                next:'›',
                previous:'‹'
            }
        }

    });

});
</script>
<!-- JoinResignSummary -->
<script>

var joinResignDetails = <?php echo json_encode($joinResign['details']); ?>;

var JoinResign = {
    series: [
        {
            name: 'Joined',
            data: <?php echo json_encode($joinResign['joined']); ?>
        },
        {
            name: 'Resigned',
            data: <?php echo json_encode($joinResign['resigned']); ?>
        }
    ],
    chart: {
        type: 'bar',
        height: 350,
        toolbar: {
            show: false
        },
        events: {
            dataPointSelection: function(event, chartContext, config) {

                var monthData = joinResignDetails[config.dataPointIndex];

                var seriesIndex = config.seriesIndex;

                var employeecodes = '';
                var categoryName = '';

                if(seriesIndex == 0){
                    categoryName = 'Joined';
                    employeecodes = monthData.joined_employees.join(',');
                }else{
                    categoryName = 'Resigned';
                    employeecodes = monthData.resigned_employees.join(',');
                }

                // Example: "Apr 2026"
                var monthYear = monthData.monthname;

                var dateObj = new Date('01 ' + monthYear);

                var year = dateObj.getFullYear();
                var month = dateObj.getMonth() + 1;

                var fromdate =
                    year + '-' +
                    String(month).padStart(2,'0') +
                    '-01';

                var lastDay = new Date(year, month, 0);

                var todate =
                    year + '-' +
                    String(month).padStart(2,'0') +
                    '-' +
                    String(lastDay.getDate()).padStart(2,'0');

                showAttendanceEmployeeDetails(
                    'JoinResign',
                    employeecodes,
                    '<?php echo $userfilters['esi_company_id']; ?>',
                    '<?php echo $userfilters['esi_div_id']; ?>',
                    '<?php echo $userfilters['esi_state_id']; ?>',
                    '<?php echo $userfilters['esi_branch_id']; ?>',
                    fromdate,
                    todate,
                    categoryName
                );
            }
        }
    },
    colors: ['#28a745', '#dc3545'],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '50%',
            borderRadius: 6
        }
    },
    dataLabels: {
        enabled: true
    },
    stroke: {
        show: true,
        width: 1
    },
    legend: {
        position: 'top'
    },
    xaxis: {
        categories: <?php echo json_encode($joinResign['months']); ?>
    },
    yaxis: {
        title: {
            text: 'Employees'
        }
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return val + ' Employee(s)';
            }
        }
    }
};

var joinResignChart = new ApexCharts(
    document.querySelector("#employee_movement_chart"),
    JoinResign
);

joinResignChart.render();

</script>
<script>

var salaryData = <?php echo json_encode($branchwisesalary); ?>;

if(window.salaryChart){
    window.salaryChart.destroy();
}

var options = {

    // series: salaryData.series,

    series: salaryData.series.map(function(series){

    return {
        name: series.name,
        data: series.data,
        hidden: series.name !== 'HEAD OFFICE'
    };

}),

    chart: {
        type: 'bar',
        height: 450,
        toolbar:{
            show:false
        },

        events: {

            // Keep mounted empty
            // mounted: function(){},

            dataPointSelection: function(
                event,
                chartContext,
                config
            ){

                var branchName =
                    config.w.config.series[
                        config.seriesIndex
                    ].name;

                if(
                    !salaryData.details[branchName] ||
                    !salaryData.details[branchName][config.dataPointIndex]
                ){
                    return false;
                }

                var detail =
                    salaryData.details[branchName][
                        config.dataPointIndex
                    ];

                var employeecodes =
                    detail.employees.join(',');

                var yearMonth =
                    detail.yearmonth.toString();

                var year =
                    yearMonth.substring(0,4);

                var month =
                    yearMonth.substring(4,6);

                var fromdate =
                    year + '-' +
                    month + '-01';

                var lastDay =
                    new Date(
                        parseInt(year),
                        parseInt(month),
                        0
                    ).getDate();

                var todate =
                    year + '-' +
                    month + '-' +
                    String(lastDay).padStart(2,'0');

                // showAttendanceEmployeeDetails(
                //     'Salary',
                //     employeecodes,
                //     '<?php echo $userfilters['esi_company_id']; ?>',
                //     '<?php echo $userfilters['esi_div_id']; ?>',
                //     '<?php echo $userfilters['esi_state_id']; ?>',
                //     detail.branchcode,
                //     fromdate,
                //     todate,
                //     branchName
                // );

            }
        }
    },

    plotOptions:{
        bar:{
            columnWidth:'50%',
            borderRadius:5
        }
    },

    dataLabels:{
        enabled:true,
        formatter:function(val){

            return (
                val / 100000
            ).toFixed(1) + 'L';

        }
    },

    xaxis:{
        categories: salaryData.months
    },

    yaxis:{
        labels:{
            formatter:function(val){

                return (
                    val / 100000
                ).toFixed(1) + 'L';

            }
        }
    },

    tooltip:{
        y:{
            formatter:function(val){

                return '₹ ' +
                    Number(val)
                    .toLocaleString('en-IN');

            }
        }
    },

    legend:{
        show:true,
        position:'top',
        horizontalAlign:'left'
    },

    title:{
        text:'Branch Salary Trend'
    }

};

window.salaryChart =
new ApexCharts(
    document.querySelector(
        "#branch_salary_chart"
    ),
    options
);
window.salaryChart.render();
</script>

<!-- Employee Services Status -->
<script>

var serviceSummary =
    <?php echo json_encode($servicesummary); ?>;

var categories = [];
var workingData = [];
var resignedData = [];

$.each(serviceSummary,function(index,row){

    categories.push(row.service_category);

    workingData.push(
        parseInt(row.working_count)
    );

    resignedData.push(
        parseInt(row.resigned_count)
    );

});

if(window.serviceCategoryChart){
    window.serviceCategoryChart.destroy();
}

var options = {

    series: [
        {
            name: 'Working',
            data: workingData
        },
        {
            name: 'Resigned',
            data: resignedData
        }
    ],

    chart: {

        type: 'bar',

        height: 450,

        toolbar:{
            show:false
        },

        events: {

            dataPointSelection: function(
                event,
                chartContext,
                config
            ){

                var detail =
                    serviceSummary[
                        config.dataPointIndex
                    ];

                var employeeCodes = [];
                var popupTitle = '';
                var categories = 'ServiceSummary';

                // Working Bar
                if(config.seriesIndex == 0){

                    employeeCodes =
                        detail.working_employee_codes;

                    popupTitle =
                        detail.service_category +
                        ' - Working Employees';
                }else{
                    employeeCodes =
                        detail.resigned_employee_codes;

                    popupTitle =
                        detail.service_category +
                        ' - Resigned Employees';
                }

                if(
                    !employeeCodes ||
                    employeeCodes.length == 0
                ){
                    return;
                }


                showAttendanceEmployeeDetails(
                    popupTitle,
                    employeeCodes.join(','),
                    '<?php echo $userfilters['esi_company_id']; ?>',
                    '<?php echo $userfilters['esi_div_id']; ?>',
                    '<?php echo $userfilters['esi_state_id']; ?>',
                    '<?php echo $userfilters['esi_branch_id']; ?>',
                    '',
                    '',
                    categories
                );
            }
        }
    },

    colors: [
        '#28a745',
        '#dc3545'
    ],

    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '45%',
            borderRadius: 4
        }
    },

    dataLabels: {
        enabled: true
    },

    stroke: {
        show: true,
        width: 1
    },

    xaxis: {
        categories: categories
    },

    yaxis: {
        title: {
            text: 'Employees'
        }
    },

    legend: {
        position: 'top'
    },

    tooltip: {
        shared: false,
        intersect: true
    }
};

window.serviceCategoryChart =
    new ApexCharts(
        document.querySelector(
            "#employees_service_chart"
        ),
        options
    );

window.serviceCategoryChart.render();

</script>
</div>