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
<!-- Search Filter -->
<?php 
$controller->commonFiltersForm(array(
    'yearfilter' => 'Y',
    'FormId' => 'employeespayslips',
    'CallFunction' => 'employeespayslipsList'
)); 
?>
<!-- Search Filter -->