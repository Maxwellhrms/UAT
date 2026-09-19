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
                        <h3 class="page-title"><?php echo $title; ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?php echo $title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        </div>

        <div class="dashboard-card">
            <div class="row no-gutters">
                 <?php foreach($regulationsummary as $leavekey => $leavevalue){
                    $color = array('blue-text','orange-text','green-text','purple-text','pink-text','teal-text','red-text');
                    $ring = array('blue-ring','orange-ring','green-ring','purple-ring','pink-ring','teal-ring','red-ring'); 
                ?>
                <div class="col-lg-2 col-md-6">
                    <div class="leave-box">                
                        <div class="leave-title explain-link <?php echo $color[$leavekey] ?>"><?php echo $leavevalue->regulationtype; ?></div>
                        <div class="circle <?php echo $ring[$leavekey]; ?>">
                            <div class="circle-content">
                                <div class="circle-value <?php echo $color[$leavekey] ?>"><?php echo $leavevalue->total_days; ?>d</div>
                                <div class="circle-text <?php echo $color[$leavekey] ?>">USED</div>
                            </div>
                        </div>
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
    'customregulation' => 'Y',
    'leavestatus' => 'Y',
    'FormId' => 'employeesRegulations',
    'CallFunction' => 'employeesRegulationsList'
)); 
?>
<!-- Search Filter -->



