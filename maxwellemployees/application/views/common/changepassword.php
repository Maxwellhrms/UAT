<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
		
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?php echo $title ;?></h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
						<li class="breadcrumb-item active"><?php echo $title ;?></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
	
		<div class="row">
		<div class="col-xl-6 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h4 class="card-title mb-0">Hello <span style="color:#00a3d3"><?php echo $this->session->userdata('session_name'); ?> </span> Please Update The Password</h4>
				</div>
				<div class="card-body">
					<form id="changeemployeepassword">
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Old Password</label>
							<div class="col-lg-9">
								<input type="password" name="oldpassword" id="oldpassword" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Password</label>
							<div class="col-lg-9">
								<input type="password" name="newpassword" id="newpassword" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Repeat Password</label>
							<div class="col-lg-9">
								<input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
							</div>
						</div>
						<div class="text-end">
							<button type="button" class="btn btn-primary" onclick="processForm('changeemployeepassword','UpdatePassword','Common/logout')">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
		
	</div>
	<!-- /Page Content -->