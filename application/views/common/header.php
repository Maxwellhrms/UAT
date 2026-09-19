<?php
$currenturl = $this->uri->uri_string();
$url = $this->uri->segment(1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Maxwell Hrms</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/favicon.gif">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/line-awesome.min.css">

	<!-- Select2 CSS -->
	<!-- <link rel="stylesheet" href="assets/css/select2.min.css"> -->

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">

	<!-- Data Tables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/buttons.dataTables.min.css">
<!--	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"> -->
<!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">-->


	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">

	<!-- jQuery -->
	<script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.form-inline{
			    display: flow-root;
			}
			span.select2-selection.select2-selection--single {
    			height: 44px;
			}
			.formerror{
				color: #ff0000;
			}
			.select2-container--default .select2-selection--multiple .select2-selection__choice {
			    background-color: #007bff;
			    border-color: #006fe6;
			    color: #fff;
			    padding: 0 10px;
			    margin-top: .31rem;
			}
			.dt-buttons.btn-group {
    			    background: #ff9b44;
			}
			.pagination > li > a, .pagination > li > span {
    			   color: #0e0e0d;
			   padding: 5px;
			}
			button.btn.btn-default.buttons-excel.buttons-html5 {
    			  color: #fff;
			}
			button.btn.btn-default.buttons-pdf.buttons-html5 {
    			  color: #fff;
			}
			button.btn.btn-default.buttons-csv.buttons-html5 {
    			  color: #fff;
			}
			.cursor-pointer{
              cursor: pointer;
            }
		</style>
		<style type="text/css">
        .ajax-loader {
        	visibility: visible;
            background: url('<?php echo base_url() ?>assets/img/loader.gif') no-repeat center center;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999999;
        }
        .ajax-loader-hide {
        	visibility: hidden;
            background: url('<?php echo base_url() ?>assets/img/loader.gif') no-repeat center center;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999999;
        }
        
        </style>
	<script type="text/javascript">
		window.baseurl = "<?php echo base_url() ?>";
	</script>
</head>

<body>
    <div class="ajax-loader-hide loader"></div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="<?php echo base_url() ?>dashboard" class="logo">
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
				<h3>Maxwell</h3>
			</div>
			<!-- /Header Title -->

			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

			<!-- Header Menu -->
			<?php //print_r($ntf); ?>
			<ul class="nav user-menu">
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<!--<i class="fa fa-bell-o"></i> -->
							<i class="far fa-bell"></i>
							<?php if($ntf['cnt'] > 0){ ?><span class="badge rounded-pill"><?php echo $ntf['cnt']; ?></span> <?php } ?>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="<?php echo base_url() ?>admin/allnotifications" class="clear-noti"> View All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
								    <?php foreach($ntf['data'] as $keyx => $xval){ ?>
									<li class="notification-message">
										<a href="<?php echo base_url() ?>admin/allnotifications?appid=<?php echo $xval->mx_ntf_appid ?>&id=<?php echo $xval->mx_ntf_id ?>">
											<div class="media d-flex">
												<div class="media-body flex-grow-1">
													<p class="noti-details">
													    <span class="noti-title" style="color:red"><?php echo strtoupper($xval->mx_ntf_category); ?></span>
													    Hearing Date / Follow Date on <span style="color:red"><?php if(!empty($xval->mx_ntf_followup_date)){ echo $xval->mx_ntf_followup_date; }else{ echo $xval->mx_ntf_hearing_date; } ?></span>
													    <span class="noti-title"> Filed To <span style="color:red"><?php echo strtoupper($xval->mx_ntf_filedto); ?></span></span>
													</p>
													<!--<p class="noti-time"><span class="notification-time">4 mins ago</span></p>-->
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="<?php echo base_url() ?>admin/allnotifications">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
					    <?php if(empty($this->session->userdata('user_img'))){$userimg = 'assets/img/profiles/user.jpg';}else{$userimg = $this->session->userdata('user_img');}?>
						<span class="user-img"><img src="<?php echo base_url(). $userimg ?>" alt="" width="30px" height="30px">
							<!--<span class="status online"></span></span>-->
						<span><?php echo $this->session->userdata('user_name'); ?> (<?php echo $this->session->userdata('user_id'); ?>)</span>
					</a>
					<div class="dropdown-menu">
					    <a class="dropdown-item" href="<?php echo base_url() ?>dashboard">DashBoard</a>
					    <a class="dropdown-item" href="<?php echo base_url() ?>Employee/changeemployeepassword">Change Password</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>admin/logout">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
				<div class="dropdown-menu dropdown-menu-right">
				    <a class="dropdown-item" href="<?php echo base_url() ?>Employee/changeemployeepassword">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>admin/logout">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
                        <?php foreach ( $groups as $res ) :  ?>
						<li class="submenu">
							<a href="#" class="" id="menuopen_<?php echo $res->maxper_menuid ?>" ><i class="la <?php echo $res->maxper_menuicon ?> "></i> <span> <?php echo Ucfirst($res->maxper_menuname) ?></span> <span class="menu-arrow"></span></a>
							<ul style="display: none;" id="opensubmenu_<?php echo $res->maxper_menuid ?>" >
                            <?php  foreach($pages as $row):
								if($res->maxper_menuid == $row->maxsubwise_menu_id){
								    if($currenturl == $row->maxsubwise_link){ ?>
										<script type="text/javascript">
											var menuid = '<?php echo $res->maxper_menuid ?>';
											$("#opensubmenu_" + menuid).css("display", "block");
											$( "#menuopen_" + menuid ).addClass( "noti-dot subdrop" );
										</script>
									<?php }	?>
								<li><a href="<?php echo base_url() . $row->maxsubwise_link ?>"><?php echo Ucfirst($row->maxsubwise_name); ?></a></li>
							<?php } endforeach ?>
							</ul>
						</li>
                        <?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->