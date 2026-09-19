<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/selfleaves.css"> 
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Employee Self Leaves</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee Self Leaves</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        </div>

        <div class="dashboard-card">
            <div class="row no-gutters">

                <?php
                $color = array(
                    'blue-text',
                    'orange-text',
                    'green-text',
                    'purple-text',
                    'pink-text',
                    'teal-text',
                    'red-text'
                );

                $ringColor = array(
                    '#25a9f5',
                    '#f7a42b',
                    '#11c59d',
                    '#bb93eb',
                    '#e84393',
                    '#1abc9c',
                    '#e74c3c'
                );

                foreach($leavesummary as $leavekey => $leavevalue){

                    $annual  = (float)$leavevalue->Annual;
                    $balance = (float)$leavevalue->CurrentBalance;

                    $percent = ($annual > 0) ? ($balance / $annual) * 100 : 0;

                    if($percent > 100){
                        $percent = 100;
                    }

                    $degree = ($percent / 100) * 360;
                ?>

                <div class="col-lg-2 col-md-6">
                    <div class="leave-box">

                        <div class="leave-title explain-link <?php echo $color[$leavekey]; ?>">
                            <?php echo $leavevalue->leaveName; ?>
                        </div>

                        <div class="circle"
                            style="background: conic-gradient(
                            <?php echo $ringColor[$leavekey]; ?> 0deg,
                            <?php echo $ringColor[$leavekey]; ?> <?php echo $degree; ?>deg,
                            #dce4ea <?php echo $degree; ?>deg,
                            #dce4ea 360deg
                        );">

                            <div class="circle-content">
                                <div class="circle-value <?php echo $color[$leavekey]; ?>">
                                    <?php echo $leavevalue->CurrentBalance; ?>d
                                </div>

                                <div class="circle-text <?php echo $color[$leavekey]; ?>">
                                    <?php echo round($percent); ?>% AVAILABLE
                                </div>
                            </div>
                        </div>

                        <ul class="leave-list">
                            <li>
                                <span>Available</span>
                                <span><?php echo $leavevalue->CurrentBalance; ?> D</span>
                            </li>

                            <li>
                                <span>Consumed</span>
                                <span><?php echo $leavevalue->Used; ?> D</span>
                            </li>

                            <li>
                                <span>Accrued so far</span>
                                <span><?php echo $leavevalue->Accrued; ?> D</span>
                            </li>

                            <li>
                                <span>Annual Quota</span>
                                <span><?php echo $leavevalue->Annual; ?> D</span>
                            </li>
                        </ul>

                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

<!-- Search Filter -->
<?php 
$controller->commonFiltersForm(array(
    'fromdatefilter' => 'Y',
    'todatefilter' => 'Y',
    'customoption' => 'Y',
    'customvalue' => array('Ids' =>'1,2,3,4,11,12', 'Type'=>'LeaveType'),
    'leavestatus' => 'Y',
    'FormId' => 'employeesleaveshistory',
    'CallFunction' => 'employeesleaveshistoryList'
)); 
?>
<!-- Search Filter -->



