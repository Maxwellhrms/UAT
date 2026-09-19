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


<!-- Search Filter -->
<?php 
$controller->commonFiltersForm(array(

    'fromdatefilter' => 'Y',
    'todatefilter' => 'Y',
    'customregulation' => 'Y',
    'leavestatus' => 'Y',
    'FormId' => 'manageremployeesregulationhistory',
    'CallFunction' => 'manageremployeesregulationhistoryList'
)); 
?>
<!-- Search Filter -->



