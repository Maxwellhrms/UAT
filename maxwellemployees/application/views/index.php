<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Maxwell Employees Portal Login">
        <title>Login - Maxwell Employees Portal</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/favicon.gif">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
        <script type="text/javascript">
			window.baseurl = "<?php echo base_url() ?>";
		</script>
    </head>
    <body class="account-page">
	<div id="alert-container"></div>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="admin-dashboard.html"><img style="width: 200px;" src="<?php echo base_url() ?>assets/img/logo.png" alt="Maxwell Employees Portal"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to Your dashboard</p>
							
							<!-- Account Form -->
							<form id="employeeForm">
								<div class="form-group">
									<label>Employee Code</label>
									<input class="form-control" name="employeeCode" autocomplete="off" id="employeeCode" type="text">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<!-- <div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Forgot password?
											</a>
										</div> -->
									</div>
									<div class="position-relative">
										<input class="form-control" name="password" type="password" id="password" autocomplete="off">
										<span class="fa fa-eye-slash" id="toggle-password"></span>
									</div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="button" onclick="processForm('employeeForm','Employee/checkloginaccess','Employee/employeedashboard')">Login</button>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url() ?>assets/js/app.js"></script>
		
    </body>
</html>