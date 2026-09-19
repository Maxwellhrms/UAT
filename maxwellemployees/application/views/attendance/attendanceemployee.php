<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
     <!-- Page Header -->
     <div class="page-header">
      <div class="row">
       <div class="col-sm-12">
        <h3 class="page-title"> <?php echo $title ;?>  </h3>
        <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
         <li class="breadcrumb-item active"> <?php echo $title ;?>  </li>
     </ul>
 </div>
</div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card punch-status">
            <div class="card-body" style="height:409px">
                <h5 class="card-title">Timesheet <small class="text-muted"><?php echo date('d M Y',strtotime($punchhistory['attendance'])); ?></small></h5>
                <div class="punch-info">
                    <div class="punch-hours">
                        <span><?php echo $punchhistory['total']; ?> hrs</span>
                    </div>
                </div>
                <div class="punch-det">
                    <h6>Punch In at</h6>
                    <p><?php if(!empty($punchhistory['firstpunch'])){echo date("l jS  F Y h:i:s A", strtotime($punchhistory['attendance'] . $punchhistory['firstpunch']));} ?></p>
                <h6>Punch Out at</h6>
                <p><?php if(!empty($punchhistory['lastpunch'])){echo date("l jS  F Y h:i:s A", strtotime($punchhistory['attendance'] . $punchhistory['lastpunch']));} ?></p>
                </div>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-6 col-6 text-center">
                            <div class="stats-box">
                                <p>Overtime</p>
                                <h6><?php echo $punchhistory['ot']; ?> hrs</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card att-statistics">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <div class="stats-list">
                    <div class="stats-info">
                        <p>Total Present Days (Adjustments Not Included) <strong><?php echo $presentAttendance['totalPR'] ?> <small>/ <?php echo $presentAttendance['totalDays'] ?> days</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $presentAttendance['percentage'].'%' ?>" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Today <strong><?php echo $statistics['statistics']['today']['worked']; ?> <small>/ <?php echo $statistics['statistics']['today']['target']; ?> hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $statistics['statistics']['today']['percentage'].'%';?> " aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>This Week <strong><?php echo $statistics['statistics']['week']['worked']; ?> <small>/ <?php echo $statistics['statistics']['week']['target']; ?> hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $statistics['statistics']['week']['percentage'].'%';?>" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>This Month <strong><?php echo $statistics['statistics']['month']['worked']; ?> <small>/ <?php echo $statistics['statistics']['month']['target']; ?> hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $statistics['statistics']['month']['percentage'].'%';?>" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Overtime <strong><?php echo $statistics['statistics']['overtime']['worked']; ?> hrs</strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card recent-activity">
            <div class="card-body">
                <h5 class="card-title">Today Activity</h5>
                <ul class="res-activity-list">
                <?php foreach ($punchhistory['punches'] as $key => $value) { ?>
                
                <li>
                    <p class="mb-0">Punch - <?php echo $punchhistory['type'][$key]; ?></p>
                    <p class="res-activity-time">
                        <i class="fa fa-clock-o"></i>
                        <?php if(!empty($value)){ echo date('h:i:s A', strtotime($value)) ;} ?>.
                    </p>
                </li>
            <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter -->
<?php 
$controller->commonFiltersForm(array(
    'fromdatefilter' => 'Y',
    'todatefilter' => 'Y',
    'FormId' => 'employeespunchhistory',
    'CallFunction' => 'employeepunchhistoryList'
)); 
?>
<!-- Search Filter -->