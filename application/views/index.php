<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Login</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/favicon.gif">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
        <!--<link rel="stylesheet" href="<?php #echo base_url() ?>assets/css/loginanimation.css">-->
        		<script type="text/javascript">
     		 window.baseurl = "<?php echo base_url() ?>";
  		</script>
    </head>
    <body class="account-page" style="background-image: url('<?php echo base_url() ?>assets/hrms.webp');  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
	<?php //include 'loginanimation.php'; ?>
		<!-- Main Wrapper -->
        <div class="main-wrapper" style="position: absolute;">
			<div class="account-content">
				<div class="container">
					
					<div class="account-box" style="background-color:#fff9">
						<div class="account-wrapper">
												<div class="account-logo">
						<a href="#"><img src="<?php echo base_url() ?>assets/img/logo.png" alt="Hrms Logo"></a>
					</div>
							<!-- <h3 class="account-title">Login</h3> -->
							
							<!-- Account Form -->
							<form method="post" id="loginuser">
								<div class="form-group">
									<label>Employee Id</label>
									<input class="form-control" type="text" id="employeeid" name="employeeid" autocomplete="off">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
<!-- 										<div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Forgot password?
											</a>
										</div> -->
									</div>
									<div class="position-relative">
										<input class="form-control" type="password" id="userpassword" name="userpassword" autocomplete="off">
										<span class="fa fa-eye-slash" id="toggle-password"></span>
									</div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" id="process">Login</button>
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
        <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url() ?>assets/js/app.js"></script>

		<script src="<?php echo base_url() ?>assets/js/formsjs/checklogin.js"></script>
		
    </body>
</html>