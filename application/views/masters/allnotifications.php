<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Notification List</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active">NotificationList</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Notifications List</span></h4>
					</div>
					<div class="card-body">
						<form id="addlegalform">
							
  <div id="accordion">
      <?php $sno = 1; foreach($info['data'] as $key => $val){  //print_r($val);?>
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne_<?php echo $sno ?>">
          <?php echo $val->mx_ntf_appid ?> <span style="float:right"><button type="button" class="btn btn-success"><?php echo $val->mxcp_name ?></button> <button type="button" class="btn btn-info"><?php echo $val->mxd_name ?></button> <button type="button" class="btn btn-secondary"><?php echo $val->mxst_state ?></button> <button type="button" class="btn btn-danger"><?php echo $val->mxb_name ?></button></span>
        </a>
      </div>
      <div id="collapseOne_<?php echo $sno ?>" class="collapse <?php if($sno == 1){ ?> show <?php } ?>" data-parent="#accordion">
        <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>First Hearing</th>
                      <th>Follow up (Next Hearing Date)</th>
                      <th>Filed By</th>
                      <th>Filed To</th>
                      <th>Refrence</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $val->mx_ntf_category ?></td>
                      <td><?php echo $val->mx_ntf_hearing_date ?></td>
                      <td><?php echo $val->mx_ntf_followup_date ?></td>
                      <td><?php echo $val->mx_ntf_filedby ?></td>
                      <td><?php echo $val->mx_ntf_filedto ?></td>
                      <td><?php echo $val->mx_ntf_refrencce ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
           <?php echo $val->mx_ntf_description ?>
        </div>
      </div>
    </div>
    <?php $sno++; } ?>
  </div>
	
						</form>
					</div>
				</div>
			</div>
		</div>


</div>
</div>
<!-- /Page Wrapper -->