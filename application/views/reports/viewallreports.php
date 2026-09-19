<style>
    .mainhead {
    background: linear-gradient(to right, #ff9b44 0%, #fc6075 100%);
}
.mainlink{
      color :#fff;  
}
table, th, td {
 color :#fff;
}
</style>
<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">View All Reports</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active">All Reports List</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Hrms Reports List</span> <span class="pull-right"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Summary</button></span></h4>
					</div>
					<div class="card-body">
<div id="demo" class="collapse">
<div class="container">        
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Sno</th>
        <th>Name</th>
        <th>Count</th>
      </tr>
    </thead>
    <tbody>
        <?php $overallcount = 0; $sr = 1; foreach($reoptscnt as $key => $val){ ?>
      <tr>
        <td><?php echo $sr; ?></td>
        <td><?php echo $val->maxper_menuname ?></td>
        <td><?php echo $val->reportcount ?></td>
      </tr>
      <?php $overallcount += $val->reportcount; $sr++; } ?>
    </tbody>
      <tfoot>
    <tr>
      <td></td>
      <td><b>Total</b></td>
      <td><b><?php echo $overallcount; ?></b></td>
    </tr>
  </tfoot>
  </table>
</div>
</div>
							
  <div id="accordion">
      <?php $sno = 1; foreach ( $groups as $res ) {  ?>
    <div class="card">
      <div class="card-header mainhead">
        <a class="card-link mainlink" data-toggle="collapse" href="#collapseOne_<?php echo $sno ?>">
          <?php echo Ucfirst($res->maxper_menuname) ?> <span class="pull-right">Count - <?php $count = getreportscount($res->maxper_menuid, $this->session->userdata('user_role')); echo $count[0]->count ?></span>
        </a>
      </div>
      <div id="collapseOne_<?php echo $sno ?>" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div class="list-group">
            <?php  $i = 1; foreach($pages as $row){
            if($res->maxper_menuid == $row->maxsubwise_menu_id){
            ?>
            <a href="<?php echo base_url() . $row->maxsubwise_link ?>" target="_blank" class="list-group-item list-group-item-primary"><span><?php echo $i; ?>) </span><?php echo Ucfirst($row->maxsubwise_name); ?></a>
            <?php 
            $i++; 
            }else{
            $i= 1;
            }
            }  ?>
          </div>
        </div>
      </div>
    </div>
    <?php $sno++; } ?>
  </div>

					</div>
				</div>
			</div>
		</div>


</div>
</div>
<!-- /Page Wrapper -->