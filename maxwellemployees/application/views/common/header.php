<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Employee ESSL Portal</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/favicon.gif">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/line-awesome.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css">

		<!-- Tagsinput CSS -->
		<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"> -->
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">

        <!-- Data Tables -->
	    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/buttons.dataTables.min.css">

        <!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/select2/css/select2.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
			window.baseurl = "<?php echo base_url() ?>";
			window.POLICY_DATA = {
			    acknowledgedIds: [],
			    totalPolicies: 0,
			    acknowledgeUrl: "",
			    redirectUrl: "",
			    viewpage: 0
			};
		</script>
		<style>
			/* UAT Marquee */
			.uat-marquee {
				position: absolute;
				left: 500px;
				right: 475px;
				top: 0;
				height: 74px;

				display: flex;
				align-items: center;

				overflow: hidden;
				white-space: nowrap;

				z-index: 1;
				pointer-events: none;
			}

			.uat-marquee-text {
				display: inline-block;

				padding-left: 100%;

				color: #dc3545;
				font-size: 14px;
				font-weight: 700;

				white-space: nowrap;

				animation: uat-marquee 18s linear infinite;
			}

			@keyframes uat-marquee {
				from {
					transform: translateX(0);
				}

				to {
					transform: translateX(-100%);
				}
			}

			/* Keep header menu above marquee */
			.header .user-menu,
			.header .mobile-user-menu {
				position: relative;
				z-index: 5;
			}

			.header .page-title-box {
				position: relative;
				z-index: 5;
			}


			/* Tablet */
			@media (max-width: 1200px) {

				.uat-marquee {
					left: 400px;
					right: 280px;
				}

				.uat-marquee-text {
					font-size: 13px;
				}
			}


			/* Mobile */
			@media (max-width: 767px) {

				.uat-marquee {
					display: none;
				}
			}
		</style>
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Loader -->
			<div id="loader-wrapper">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div>
			<!-- /Loader -->
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left" class="logo">
                    <a href="<?php echo base_url() ?>/Employee/employeedashboard" class="logo">
						<img src="<?php echo base_url() ?>assets/img/logo.png" width="140" height="50" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>MAXWELL ESS</h3>
                </div>
				<!-- /Header Title -->

				<!-- UAT Marquee -->
				<div class="uat-marquee">
					<div class="uat-marquee-text">
						⚠️ UAT ENVIRONMENT — YOU ARE CURRENTLY USING THE TESTING SERVER. PLEASE DO NOT ENTER OR PROCESS PRODUCTION DATA.
					</div>
				</div>
				<!-- /UAT Marquee -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
					<!-- Flag -->
					<li class="nav-item dropdown flag-nav">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
							<span>Last Login <?php echo formatLastLogin($this->session->userdata('session_loginperson_id')); ?></span>
						</a>
					</li>
					<!-- /Flag -->
				
	
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img"><img src="<?php echo $this->session->userdata('session_img'); ?>" width="30px" height="30px" alt="">
							<span class="status online"></span></span>
							<span><?php echo $this->session->userdata('session_name');  ?></span>
						</a>
						<div class="dropdown-menu">
<!-- 							<a class="dropdown-item" href="profile.html">My Profile</a>
							<a class="dropdown-item" href="settings.html">Settings</a> -->
							<a class="dropdown-item" href="<?php echo base_url() ?>Employee/logout">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
<!-- 						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a> -->
						<a class="dropdown-item" href="<?php echo base_url() ?>Employee/logout">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			<div id="alert-container"></div>