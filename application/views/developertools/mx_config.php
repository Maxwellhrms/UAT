<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Config</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Config</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Config</h4>
				</div>
				<div class="card-body">
  <!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#ntf">Notification</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#regulation">Regulations</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#leaves">Leaves</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#email">SMTP Emails Setup</a>
    </li>
  </ul>
  
  <form id="updateconfig">
    <!-- Tab panes -->
  <div class="tab-content">
    <div id="ntf" class="container tab-pane active"><br>
      <h3>Notification</h3>
		<section class="review-section professional-excellence">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered review-table mb-0">
							<thead>
								<tr>
									<th style="width:40px;">#</th>
									<th>Column</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							    $ntf_columns= array('notification_reminder','notification_list','notification_months');
							    $text = array('google_api_key');
							    $sno = 1; foreach($cnf as $key => $val){ 
							    foreach($val as $kex => $xval){
							    if(!in_array($kex,$ntf_columns)){continue;}
							    if($kex == 'id') { continue; } if(in_array($kex,$text)){ $typecast = 'text'; }else{ $typecast = 'number'; } ?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php $column = str_replace("_"," ",$kex); echo ucwords($column); ?></td>
									<td><input type="<?php echo $typecast; ?>" class="form-control" name="<?php echo $kex; ?>" value="<?php echo $xval ?>"></td>
								</tr>
								<?php $sno++; } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
    </div>
    <div id="regulation" class="container tab-pane fade"><br>
      <h3>Regulations</h3>
		<section class="review-section professional-excellence">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered review-table mb-0">
							<thead>
								<tr>
									<th style="width:40px;">#</th>
									<th>Column</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							    $reg_columns = array('regularize_day');
							    $text = array('google_api_key');
							    $sno = 1; foreach($cnf as $key => $val){ 
							    foreach($val as $kex => $xval){
							    if(!in_array($kex,$reg_columns)){continue;}
							    if($kex == 'id') { continue; } if(in_array($kex,$text)){ $typecast = 'text'; }else{ $typecast = 'number'; } ?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php $column = str_replace("_"," ",$kex); echo ucwords($column); ?></td>
									<td><input type="<?php echo $typecast; ?>" class="form-control" name="<?php echo $kex; ?>" value="<?php echo $xval ?>"></td>
								</tr>
								<?php $sno++; } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
    </div>
    <div id="leaves" class="container tab-pane fade"><br>
      <h3>Leaves</h3>
		<section class="review-section professional-excellence">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered review-table mb-0">
							<thead>
								<tr>
									<th style="width:40px;">#</th>
									<th>Column</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							    $lv_columns = array('applications_leave_day');
							    $text = array('google_api_key');
							    $sno = 1; foreach($cnf as $key => $val){ 
							    foreach($val as $kex => $xval){
							    if(!in_array($kex,$lv_columns)){continue;}
							    if($kex == 'id') { continue; } if(in_array($kex,$text)){ $typecast = 'text'; }else{ $typecast = 'number'; } ?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php $column = str_replace("_"," ",$kex); echo ucwords($column); ?></td>
									<td><input type="<?php echo $typecast; ?>" class="form-control" name="<?php echo $kex; ?>" value="<?php echo $xval ?>"></td>
								</tr>
								<?php $sno++; } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
    </div>
    <div id="email" class="container tab-pane fade"><br>
      <h3>Setup Email Credentials</h3>
		<section class="review-section professional-excellence">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered review-table mb-0">
							<thead>
								<tr>
									<th style="width:40px;">#</th>
									<th>Column</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							    $lv_columns = array('smtp_hosturl','smtp_hostport','smtp_hostusername','smtp_hostpassword');
							    $text = array('smtp_hosturl','smtp_hostport','smtp_hostusername','smtp_hostpassword');
							    $sno = 1; foreach($cnf as $key => $val){ 
							    foreach($val as $kex => $xval){
							    if(!in_array($kex,$lv_columns)){continue;}
							    if($kex == 'id') { continue; } if(in_array($kex,$text)){ $typecast = 'text'; }else{ $typecast = 'number'; } ?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php $column = str_replace("_"," ",$kex); echo ucwords($column); ?></td>
									<td><input type="<?php echo $typecast; ?>" class="form-control" name="<?php echo $kex; ?>" value="<?php echo $xval ?>"></td>
								</tr>
								<?php $sno++; } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
    </div>
  </div>
					<button type="submit" class="btn btn-primary">Update Details</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>			
</div>
<!-- /Main Wrapper -->
<script>
    $("form#updateconfig").submit(function(e) {
	e.preventDefault();  

	mainurl = baseurl+'developertools/updateconfig';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
	       //console.log(data);
	        if (data == 200) {
	            alert('Successfully');
	            setTimeout(function(){
	            window.location.reload();
	            }, 1000); 
	        } else {
	        	alert('Failed To Save Please TryAgain later');
	        }
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});

});	
</script>