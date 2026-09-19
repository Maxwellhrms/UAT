<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css">
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
								    <?php if(empty($this->session->userdata('user_img'))){$userimg = 'assets/img/profiles/user.jpg';}else{$userimg = $this->session->userdata('user_img');}?>
									<img alt="" src="<?php echo base_url().$userimg;?>" width="60px" height="60px">
								</div>
								<div class="welcome-det">
									<h3>Welcome, <?php echo $this->session->userdata('user_name'); ?></h3>
									<p><?php echo date('l'); ?>, <?php echo date('d M Y'); ?></p>
								</div>
							</div>
						</div>
					
					<!-- <div>
					    <h3>IN DEVELOPMENT</h3><br>
					    <table>
					         <tr>
					            <th>PaySheet Onroll Design </th>
					            <th><a href="<?php echo base_url(); ?>/Export/paysheetforonrollemployee/" target="_blank">Paysheet</a></th>
					        </tr>
					    </table>
					    
					</div><br> -->

					<?php if(date('Ymd') >= date('Y1226') && date('Ymd') <= date('Y1231')){ ?>
					<div class="container animatecudes">
						    <div class="area">
						        <ul class="squares">
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						            <li></li>
						        </ul>
						    </div>
					  <div class="alert alert-dismissible">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <strong>HR Team Year Ending <?php echo date('d-m-Y'); ?>
					    <marquee behavior=alternate onmouseover="this.stop();" onmouseout="this.start();">
					    	<ul>
					    		<li>Check Holiday list Created for Next Year <a href="<?php echo base_url() ?>admin/holidaymaster">Check Here</a></li>
					    		<li>Check Attendance Tables Created for Next Year <a href="<?php echo base_url() ?>attendance_controller/add_attendance">Check Here</a></li>
					    		<li>Check Attendance Added for each employees for Next Year <a href="<?php echo base_url() ?>attendance_controller/add_employee_records_in_attendance">Check Here</a></li>
					    	</ul>
					    </marquee>
					    </strong>
					  </div>
					</div>
					<?php } ?>
					
					<!-- /Page Header -->
					<div class="row">

<?php #if($this->input->ip_address() == '43.241.123.38'){ ?> <?php #} ?>
<?php $userrole = $this->session->userdata('user_role');
					if($userrole=='1'||$userrole=='2'){?>

						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-body innercontent">
									<h4 class="card-title">Employees Summary <a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=employeescount_summary&name=employeescount_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a></h4>
									<div class="statistics">
										<div class="row">
											<div class="col-md-4 col-4 text-center">
												<div class="stats-box mb-4">
													<p>Total</p>
													<h3 id="total_cnt"></h3>
												</div>
											</div>
											<div class="col-md-4 col-4 text-center">
												<div class="stats-box mb-4">
													<p>Resigned</p>
													<h3 id="resigned_cnt"></h3>
												</div>
											</div>
											<div class="col-md-4 col-4 text-center">
												<div class="stats-box mb-4">
													<p>Total Working</p>
													<h3 id="working_cnt"></h3>
												</div>
											</div>
										</div>
									</div>
									<div>
									    <?php 
									    $working = 0; $resigned = 0; $total_cnt = 0;
									    foreach($att_summary['employeescount'] as $wrkey => $wr){ ?>
										<p>
										    <?php if($wr['mxemp_emp_resignation_status'] == 'W'){ $working += $wr['employee_count']; ?> 
										    <i class="fa fa-dot-circle-o text-success me-2"></i>
										    <?php }elseif($wr['mxemp_emp_resignation_status'] == 'R'){ $resigned += $wr['employee_count']; ?>
										    <i class="fa fa-dot-circle-o text-danger me-2"></i>
										    <?php }else{ $working += $wr['employee_count']; ?>
										    <i class="fa fa-dot-circle-o text-warning me-2"></i>
										    <?php } ?>
										    <?php $total_cnt += $wr['employee_count']; echo $wr['mxemp_emp_gender']; ?> ( <?php echo $wr['mxemp_emp_resignation_status'] ?> ) (<?php echo $wr['divisionname'] ?>) <span style="float:right" class="float-end"><?php echo $wr['employee_count']; ?></span>
										    </p>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
<script>
document.getElementById("working_cnt").innerHTML = "<?php echo $working ?>";
document.getElementById("resigned_cnt").innerHTML = "<?php echo $resigned ?>";
document.getElementById("total_cnt").innerHTML = "<?php echo $total_cnt ?>";
</script>
<?php $userrole = $this->session->userdata('user_role');
					if($userrole=='1'||$userrole=='2'){?>

						<div class="col-md-4 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><i class="fa fa-user-plus" aria-hidden="true"></i> Join / <i class="fas fa-user-times"></i> Resign Employees Summary <a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=join_resign_summary&name=join_resign_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a></h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<th>Year month</th>
													<th>Joined</th>
													<th>Resigned</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($att_summary['joinresign'] as $jrkey => $jrbate){ ?>
												<tr>
													<td><?php echo $jrbate['year'] .' '. $jrbate['monthname']; ?></td>
													<td><?php echo $jrbate['joined_count']; ?></td>
													<td><?php echo $jrbate['resigned_count']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if(count($att_summary['joined_resigned_details']) > 0){ ?>
						<div class="col-md-4 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><?php echo date("F"); ?> Joining / Resigning Employees <a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=joined_resigned_details_summary&name=joined_resigned_details_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a></h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<th>Employee</th>
													<th>Status</th>
													<th>Joined</th>
													<th>Resigned</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($att_summary['joined_resigned_details'] as $jrkey => $jrbate){ ?>
											    <?php if($jrbate['status'] == 'RESIGNED'){ $cap='danger';}else if($jrbate['status'] == 'WORKING'){ $cap='success';}else{ $cap='warning';} ?>
												<tr>
													<td>
													    <h2 class="table-avatar">
															<a href="#" class="avatar"><img alt="" src="<?php echo base_url().$jrbate['image'] ?>" width="38px" height="38px"></a>
															<a> <?php echo $jrbate['employeecode']; ?> <span><?php echo $jrbate['name']; ?></span></a>
														</h2>
													</td>
													<td><span class="badge bg-inverse-<?php echo $cap; ?>"><?php echo $jrbate['status']; ?></span></td>
													<td><?php echo $jrbate['date_of_join']; ?></td>
													<td><?php echo $jrbate['resign_dt']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                        <?php } ?>
                        <?php $userrole = $this->session->userdata('user_role');
					if($userrole=='1'||$userrole=='2'){?>
						<div class="col-md-3">
							<div class="m-b-30">
							
								<div class="card">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-4">
											<div>
												<span class="d-block">Loans </span>
											</div>
											<div>
												<span class="text-success"><?php echo $att_summary['loanscount'][0]['total_loans_applied']; ?></span>&nbsp;&nbsp;<a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=loanscount_summary&name=loanscount_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a>
											</div>
										</div>
										<h3 class="mb-3">INR <?php echo formatIndianCurrency($att_summary['loanscount'][0]['total_loan_amount']); ?></h3>
										<div class="progress mb-2" style="height: 5px;">
											<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo number_format($att_summary['loanscount'][0]['recovered_percentage'],2); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div>
											<span class="text-success">Recovered - <?php echo number_format($att_summary['loanscount'][0]['recovered_percentage'],2); ?>%</span> &nbsp;
											<span class="text-danger">Pending - <?php echo number_format($att_summary['loanscount'][0]['percentage_needto_recovered'],2); ?>%</span>
										</div>
										<p class="mb-0">Out Standing <span class="text-muted">INR <?php echo formatIndianCurrency($att_summary['loanscount'][0]['total_outstanding_amount']); ?></span></p>
									</div>
								</div>
							
							</div>
						</div>
<?php  } ?>
					<div class="col-md-12">
					<div class="row">
				    <?php $userrole = $this->session->userdata('user_role');
					if($userrole=='1'||$userrole=='2'){?>
					    <!--attendance-->
						<div class="col-md-12 col-lg-12 col-xl-12 d-flex">
							<div class="card att-card flex-fill">
								<div class="card-header">
									<h3><i class="fas fa-calendar-alt"></i> Attendance</h3>

									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
										  	<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Today's Late <span style="color:red">(<?php echo count($att_summary['latepunch']); ?>)</span> 
										  	</a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="absent-tab" data-bs-toggle="tab" href="#absent" role="tab" aria-controls="absent" aria-selected="true">Today's Absent <span style="color:red">(<?php echo count($att_summary['absentsummary']); ?>)</span></a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="od-tab" data-bs-toggle="tab" href="#od" role="tab" aria-controls="od" aria-selected="true">Today's OnDuty <span style="color:red">(<?php echo count($att_summary['ondutysummary']); ?>)</span></a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yesturday Single Punch <span style="color:red">(<?php echo count($att_summary['singlepunch']); ?>)</span></a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#late_early" role="tab" aria-controls="late_early" aria-selected="false">Yesturday Late/Early <span style="color:red">(<?php echo count($att_summary['lateearly']); ?>)</span></a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#pastseventdays_absent" role="tab" aria-controls="pastseventdays_absent" aria-selected="false">Past Seven days Absent's <span style="color:red">(<?php echo count($att_summary['pastseventdaysabsent_summary']); ?>)</span></a>
										</li>
									</ul>
									  
								</div>
								
								<div class="card-body pt-0 pb-0 innercards" >
									<div class="tab-content p-0" id="myTabContent">
									    <?php #echo '<pre>'; print_r($att_summary); ?>
										<div class="tab-pane fade show active innercontent" id="home" role="tabpanel" aria-labelledby="home-tab">
										    <div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=todayslate_summary&name=todayslate_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"late_p");'> &nbsp; <button type="button" id="late_p" class="btn btn-primary" onclick="sendmailing('late_p',['7','9'],'LATE COMING')">Send</button> <p style="display:none;" id="late_pbuttondone">Processing check logs... </p><?php } ?></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['latepunch'] as $lkey => $late){ ?>
												<li>
												    <div class="d-flex align-items-center">
												    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
												    <input type="checkbox" name="late_p[]" value="<?php echo $late['employeecode']; ?>"> &nbsp;
												    <?php } ?>
													<img src="<?php echo base_url().$late['image'] ?>" alt="User">
													<p><?php echo $late['employeecode'] .' ('. $late['name'] .')'.' ('.$late['branchname'].')'; ?></p>
													</div>
													<div class="d-flex align-items-center">
													<a style="background-color:#000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php echo '<span style="color:red">'. $late['late_attendance'].'</span> '; ?></a> &nbsp;
													<a href="tel:<?php echo $late['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
													<a href="mailto:<?php echo $late['email']; ?>?subject=Reporting late to the office&body=We are writing this letter to bring to your knowledge that you are reporting to the office lately i.e. ………, that we received through Online attendance. If you’re on duty on office work regularise your attendance immediately or else, it will be treated as a late to the office."><i class="fa fa-mail-forward"></i></a>
												    </div>
												</li>
												<?php } ?>
											</ul>
										</div>
										<div class="tab-pane fade innercontent" id="absent" role="tabpanel" aria-labelledby="absent-tab">
											<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=absents_summary&name=absents_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"absent_p");'> &nbsp; <button type="button" id="absent_p" class="btn btn-primary" onclick="sendmailing('absent_p',['8','10'],'ABSENT')">Send</button> <p style="display:none;" id="absent_pbuttondone">Processing check logs... </p><?php } ?></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['absentsummary'] as $akey => $abate){ ?>
												<li>
												    <div class="d-flex align-items-center">
												    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
												    <input type="checkbox" name="absent_p[]" value="<?php echo $abate['employeecode']; ?>"> &nbsp;
												    <?php } ?>
													<img src="<?php echo base_url().$abate['image'] ?>" alt="User">
													<p><?php echo $abate['employeecode'] .' ('. $abate['name'] .')'.' ('.$abate['branchname'].')'; ?></p>
													</div>
													<div class="d-flex align-items-center">
													<!--<a style="background-color:#000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php #echo '<span style="color:red">'. $abate['latest_attendance'].'</span>'; ?></a> &nbsp;-->
													<a href="tel:<?php echo $abate['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
													<a href="mailto:<?php echo $abate['email']; ?>"><i class="fa fa-mail-forward"></i></a>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
										<div class="tab-pane fade innercontent" id="od" role="tabpanel" aria-labelledby="od-tab">
											<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=todayonduty_summary&name=todayonduty_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"od_p");'> &nbsp; <button type="button" id="od_p" class="btn btn-primary" onclick="sendmailing('od_p',['15','16'],'OnDuty')">Send</button> <p style="display:none;" id="od_pbuttondone">Processing check logs... </p><?php } ?></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['ondutysummary'] as $akey => $odate){ ?>
												<li>
												    <div class="d-flex align-items-center">
												    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
												    <input type="checkbox" name="od_p[]" value="<?php echo $odate['employeecode']; ?>"> &nbsp;
												    <?php } ?>
													<img src="<?php echo base_url().$odate['image'] ?>" alt="User">
													<p><?php echo $odate['employeecode'] .' ('. $odate['name'] .')'.' ('.$odate['branchname'].')'; ?></p>
													</div>
													<div class="d-flex align-items-center">
													<!--<a style="background-color:#000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php #echo '<span style="color:red">'. $odate['latest_attendance'].'</span>'; ?></a> &nbsp;-->
													<a style="background-color: #000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php echo '<span style="color:red">'. $odate['firstpunch'].' - '.$odate['lastpunch'].'</span>'; ?></a> &nbsp;
													<a href="tel:<?php echo $odate['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
													<a href="mailto:<?php echo $odate['email']; ?>"><i class="fa fa-mail-forward"></i></a>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
										<div class="tab-pane fade innercontent" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										    <div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=yesturday_summary&name=yesturday_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"single_punch");'> &nbsp; <button type="button" id="single_punch" class="btn btn-primary" onclick="sendmailing('single_punch',['11','12'],'SINGLE PUNCH')">Send</button> <p style="display:none;" id="single_punchbuttondone">Processing check logs... </p><?php } ?></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['singlepunch'] as $skey => $sate){ ?>
												<li>
												    <div class="d-flex align-items-center">
												    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
												    <input type="checkbox" name="single_punch[]" value="<?php echo $sate['employeecode']; ?>"> &nbsp;
												    <?php } ?>
													<img src="<?php echo base_url().$sate['image'] ?>" alt="User">
													<p><?php echo $sate['employeecode'] .' ('. $sate['name'] .')'.' ('.$sate['branchname'].')'; ?></p>
													</div>
													<div class="d-flex align-items-center">
													<a style="background-color:#000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php echo '<span style="color:red">'. $sate['latest_attendance'].'</span>'; ?></a> &nbsp;
													<a href="tel:<?php echo $sate['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
													<a href="mailto:<?php echo $sate['email']; ?>"><i class="fa fa-mail-forward"></i></a>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
										<div class="tab-pane fade innercontent" id="late_early" role="tabpanel" aria-labelledby="late_early-tab">
										<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=yesturdaylateearly_summary&name=yesturdaylateearly_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"late_early_p");'> &nbsp; <button type="button" id="late_early_p" class="btn btn-primary" onclick="sendmailing('late_early_p',['13','14'],'Late In & Early Exit')">Send</button> <p style="display:none;" id="late_early_pbuttondone">Processing check logs... </p><?php } ?></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['lateearly'] as $lekey => $leate){ ?>
												<li>
												    <div class="d-flex align-items-center">
												    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
												    <input type="checkbox" name="late_early_p[]" value="<?php echo $leate['employeecode']; ?>"> &nbsp;
												    <?php } ?>
													<img src="<?php echo base_url().$leate['image'] ?>" alt="User">
													<p><?php echo $leate['employeecode'] .' ('. $leate['name'] .')'.' ('.$leate['branchname'].')'; ?></p>
													</div>
													<div class="d-flex align-items-center">
													<a style="background-color: #000000" href="#"><i class="fa fa-clock-o"></i> &nbsp;<?php echo '<span style="color:red">'. $leate['first_punch'].' - '.$leate['last_punch'].'</span>'; ?></a> &nbsp;
													<a href="tel:<?php echo $leate['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
													<a href="mailto:<?php echo $leate['email']; ?>"><i class="fa fa-mail-forward"></i></a>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
										
										<div class="tab-pane fade innercontent" id="pastseventdays_absent" role="tabpanel" aria-labelledby="pastseventdays_absent-tab">
										    <p>Please create templates and let developer know to enable mails</p>
                                        	<!--<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=pastseventdaysabsent_summary&name=pastseventdaysabsent_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a> <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?> Select All <input type="checkbox" onclick='select_all(this,"pastsevendaysabsent_p");'> &nbsp; <button type="button" id="pastsevendaysabsent_p" class="btn btn-primary" onclick="sendmailing('pastsevendaysabsent_p',['8','10'],'ABSENT')">Send</button> <p style="display:none;" id="pastsevendaysabsent_pbuttondone">Processing check logs... </p><?php } ?></div>-->
                                        	<ul class="leave-list upcoming-list">
                                        	    <?php foreach($att_summary['pastseventdaysabsent_summary'] as $pakey => $pabate){ ?>
                                        		<li>
                                        		    <div class="d-flex align-items-center">
                                        		    <?php if($this->session->userdata('user_id') == '888666' || $this->session->userdata('user_id') == 'M0009'){ ?>
                                        		    <input type="checkbox" name="pastsevendaysabsent_p[]" value="<?php echo $pabate['employeecode']; ?>"> &nbsp;
                                        		    <?php } ?>
                                        			<img src="<?php echo base_url().$pabate['image'] ?>" alt="User">
                                        			<p><?php echo $pabate['employeecode'] .' ('. $pabate['name'] .')'.' ('.$pabate['branchname'].')'; ?></p>
                                        			</div>
                                        			<div class="d-flex align-items-center">
                                        			<a style="background-color:#000000" href="#">&nbsp;<?php echo '<span style="color:red">'. $pabate['total_absent_days'].' days</span>'; ?></a> &nbsp;
                                        			<a href="tel:<?php echo $pabate['phone']; ?>"><i class="fa fa-phone"></i></a> &nbsp;
                                        			<a href="mailto:<?php echo $pabate['email']; ?>"><i class="fa fa-mail-forward"></i></a>
                                        			</div>
                                        		</li>
                                        		<?php } ?>
                                        	</ul>
                                        </div>
										
									</div>
								</div>
							</div>
						</div>
						<!--attendance-->
                    <?php } ?>

                    <!--Leaves-->
                   <?php if(count($att_summary['leavesapplied']) > 0 || count($att_summary['inleaves']) > 0){ ?>
						<div class="col-md-12 col-lg-12 col-xl-12 d-flex">
							<div class="card att-card flex-fill">
								<div class="card-header">
									<h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Leaves</h3>
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
										  	<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#leavetoday" role="tab" aria-controls="leavetoday" aria-selected="true">Leaves Applied Today <span style="color:red">(<?php echo count($att_summary['leavesapplied']); ?>)</span></a>
										</li>
										<li class="nav-item" role="presentation">
										  	<a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#inleavetoday" role="tab" aria-controls="inleavetoday" aria-selected="true">In Leaves Today <span style="color:red">(<?php echo count($att_summary['inleaves']); ?>)</span></a>
										</li>
									</ul>
									  
								</div>

								<div class="card-body pt-0 pb-0 innercards">
									<div class="tab-content p-0" id="myTabContent">
									    <?php #echo '<pre>'; print_r($att_summary); ?>
										<div class="tab-pane fade show active innercontent" id="leavetoday" role="tabpanel" aria-labelledby="leavetoday">
										<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=leavesapplied_summary&name=leavesapplied_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['leavesapplied'] as $lvkey => $lvate){ ?>
												<li>
												    <div class="d-flex align-items-center">
													<img src="<?php echo base_url().$lvate['image'] ?>" alt="User">
													<p><?php echo $lvate['employeecode'] .' ('. $lvate['name'] .')'; ?>  <a href="#"> <?php echo $lvate['leavetype']; ?></a> <br> 
													<?php echo $lvate['description']; ?>
													</p>
													</div>
													
													<div class="d-flex align-items-center">
													<a style="background-color:#000000" href="#"><i class="fa fa-hourglass-start" aria-hidden="true"></i> &nbsp;<?php echo '<span style="color:red">'. $lvate['leave_status'].'</span> '; ?></a> &nbsp;
													<a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> &nbsp; <?php echo $lvate['fromdate'].' - '.$lvate['todate']; ?></a> &nbsp;
													<a href="#"><i class="fa fa-sun-o" aria-hidden="true"></i> &nbsp; <?php echo $lvate['noofdays']; ?></a>
												    </div>
												</li>
												<?php } ?>
											</ul>
										</div>
										
										<div class="tab-pane fade innercontent" id="inleavetoday" role="tabpanel" aria-labelledby="inleavetoday">
											<div><a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=inleaves_summary&name=inleaves_summary' ?>" ><i class="far fa-file-excel" aria-hidden="true"></i></a></div>
											<ul class="leave-list upcoming-list">
											    <?php foreach($att_summary['inleaves'] as $livkey => $livate){ ?>
												<li>
												    <div class="d-flex align-items-center">
													<img src="<?php echo base_url().$livate['image'] ?>" alt="User">
													<p><?php echo $livate['employeecode'] .' ('. $livate['name'] .')'; ?>  <a href="#"> <?php echo $livate['leavetype']; ?></a> <br> 
													<?php echo $livate['description']; ?>
													</p>
													</div>
													
													<div class="d-flex align-items-center">
													<a style="background-color:#000000" href="#"><i class="fa fa-hourglass-start" aria-hidden="true"></i> &nbsp;<?php echo '<span style="color:red">'. $livate['leave_status'].'</span> '; ?></a> &nbsp;
													<a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> &nbsp; <?php echo $livate['fromdate'].' - '.$livate['todate']; ?></a> &nbsp;
													<a href="#"><i class="fa fa-sun-o" aria-hidden="true"></i> &nbsp; <?php echo $livate['noofdays']; ?></a>
												    </div>
												</li>
												<?php } ?>
											</ul>
										</div>
										
									</div>
								</div>
								
							</div>
						</div>
						<?php } ?>
                    <!--Leaves-->
                    <!--Leaves month wise summary-->
                    <?php if(count($att_summary['currentmonthleaves']) > 0){ ?>
                    <div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><?php echo date("F"); ?> Leaves Applied <span style="color:red">(<?php echo count($att_summary['currentmonthleaves']); ?>)</span>
									<a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=currentmonthleaves_summary&name=currentmonthleaves_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a>
									</h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<th>Employee</th>
													<th>Type</th>
													<th>Total</th>
													<th>Pending</th>
													<th>Hr Approved</th>
													<th>Approved</th>
													<th>Rejected</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($att_summary['currentmonthleaves'] as $clkey => $clbate){ ?>
												<tr>
													<td>
													    <h2 class="table-avatar">
															<a href="#" class="avatar"><img alt="" src="<?php echo base_url().$clbate['image'] ?>" width="38px" height="38px"></a>
															<a> <?php echo $clbate['employeecode']; ?> <span><?php echo $clbate['name']; ?></span></a>
														</h2>
													<td><?php echo $clbate['leave_type']; ?></td>
													<td><?php echo $clbate['total_days']; ?></td>
													<td><?php echo $clbate['pending'];  ?></td>
													<td><?php echo $clbate['hrapproved'];  ?></td>
													<td><?php echo $clbate['approved'];  ?></td>
													<td><?php echo $clbate['rejected'];  ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
                    <!--Leaves month wise summary-->
                    <!--Regulations month wise summary-->
                    <?php if(count($att_summary['currentmonthregulation']) > 0){ ?>
                    <div class="col-md-6 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"><?php echo date("F"); ?> Regulations Applied <span style="color:red">(<?php echo count($att_summary['currentmonthregulation']); ?>)</span>
									<a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=regulation_summary&name=regulation_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a>
									</h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<th>Employee</th>
													<th>Type</th>
													<th>Total</th>
													<th>Pending</th>
													<th>Revert</th>
													<th>Approved</th>
													<th>Rejected</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($att_summary['currentmonthregulation'] as $clkey => $clbate){ ?>
												<tr>
													<td>
													    <h2 class="table-avatar">
															<a href="#" class="avatar"><img alt="" src="<?php echo base_url().$clbate['image'] ?>" width="38px" height="38px"></a>
															<a> <?php echo $clbate['employeecode']; ?> <span><?php echo $clbate['name']; ?></span></a>
														</h2>
													</td>
													<td><?php echo $clbate['type']; ?></td>
													<td><?php echo $clbate['total_days']; ?></td>
													<td><?php echo $clbate['pending'];  ?></td>
													<td><?php echo $clbate['revert'];  ?></td>
													<td><?php echo $clbate['approved'];  ?></td>
													<td><?php echo $clbate['rejected'];  ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					<!--Regulations month wise summary-->
                    <!--Holidays-->
                    <?php if(count($att_summary['holiday']) > 0){ ?>
						<div class="col-md-6 col-lg-6 col-xl-6 d-flex">
							<div class="card att-card flex-fill">
									<div class="card-header">
										<h3><i class="fas fa-home"></i> Upcoming Holidays</h3>
										<a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=holiday_summary&name=holiday_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a>
									</div>
									<div class="card-body pt-0 pb-0 innercontent">
										<ul class="leave-list upcoming-list">
										    <?php foreach($att_summary['holiday'] as $hkey => $hobate){ ?>
											<li>
												<div class="d-flex align-items-center">
													<h3><?php echo  $hobate['divisionname'].' - '.$hobate['state'].' - '.$hobate['branchname']; ?></h3>
												</div>
												<h6><?php echo '<span style="color:red">'.$hobate['holidayname'].' ('.$hobate['holiday_type'] .')</span>'; ?> <?php echo date('M d', strtotime($hobate['holidaydate'])); ?></h6>
											</li>
                                            <?php } ?>
										</ul>
									</div>
							</div>
						</div>
						<?php } ?>
                    <!--Holidays-->

                        <!--birthday-->
                        <?php if(count($att_summary['dob']) > 0){ ?>
						<div class="col-md-6 col-lg-6 col-xl-6 d-flex">
							<div class="card att-card flex-fill">
								<div class="card-header">
									<h3><i class="fas fa-birthday-cake"></i> Birthdays <span style="color:red">(<?php echo count($att_summary['dob']); ?>)</span></h3>
							        <a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=birthdays_summary&name=birthdays_summary' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a>
								</div>
								<div class="card-body pt-0 pb-0 innercontent">
									<ul class="leave-list bday-list">
										<?php foreach($att_summary['dob'] as $dkey => $dobate){ ?>
										<li>
											<div class="wish-info">
												<img src="<?php echo base_url().$dobate['image'] ?>" alt="User">
												<p><?php echo $dobate['employeecode'] .' ('. $dobate['name'] .')'; ?></p>
											</div>
										    <?php if(date('Md') == date('Md', strtotime($dobate['mxemp_emp_date_of_birth']))){ ?>
										    <a href="mailto:<?php echo $dobate['email']; ?>?subject=Birthday Greetings&body=Greetings from HR Dept.…" class="wish-btn">Wish Now <?php echo date('M d', strtotime($dobate['mxemp_emp_date_of_birth'])); ?></a>
											<?php }else{ ?>
											<a href="#"><?php echo date('M d', strtotime($dobate['mxemp_emp_date_of_birth'])); ?></a>
											<?php } ?>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						<!--birthday-->

                        <!--employee service summary-->
                        <?php $userrole = $this->session->userdata('user_role');
					if($userrole=='1'||$userrole=='2'){?>
						<div class="col-md-4 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0"> Employees Service Summary <a href="<?php echo base_url().'dashboard/exporttoexcel?mdfn=service_history&name=service_history' ?>" style="float:right"><i class="far fa-file-excel" aria-hidden="true"></i></a></h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">	
										<table class="table custom-table table-nowrap mb-0">
											<thead>
												<tr>
													<th>Service</th>
													<th>Working</th>
													<th>Resigned</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($att_summary['servicesummary'] as $jrkey => $jrbate){ ?>
												<tr>
													<td><?php echo $jrbate['service_category']; ?></td>
													<td><?php echo $jrbate['working_count']; ?></td>
													<td><?php echo $jrbate['resigned_count']; ?></td>
													<td><?php echo $jrbate['total_count']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
                    <!--employee service summary-->


<!--Cron Summary-->
<?php if($this->session->userdata('user_id') == '888666'){
$crons = array(
	'ATTENDANCE' => array('ATTENDANCE','DAILY','12 AM,5 AM',"<ul class='list-group'><li class='list-group-item'>Runs Daily employees who punches daily and below examples matches then present/absent will be updated </li><ol class='list-group-item'>In any Day if category like ('CL','EL','SL','SHRT','WO','PH','OPH','CMPL','AR','OD') these are done then hr team need to update there attedance either / first half or second half </ol><ol class='list-group-item'>Office Timmings needs to maintain example like below <br> 1) if Employees First Punch is like 08:00 am less than office start time then office start time only we will consider. example 9:30 am as first punch and his/her Last Punch is greather than office end time like 08:00 pm then we will consider office closing time as 06:00 pm. <br>2) if employee first punch is on time and Last punch is after 01:30 pm then it will be Present as first half and same goes for second half aswell. <br>3) if employee is on time First Punch and Last Punch then will be present Full Day. <br>4) if Late comming in morning and First punch is greater than or equal to 09:35:00 then absent for First half and if his second punch is less than 06:00:00 pm then full day absent</ol></ul>","timing" =>array()),
	'EL CRON' => array('EL CRON','DAILY','12 AM,5 AM',"timing" =>array()),
	'SL CRON' => array('SL CRON','DAILY','12 AM,5 AM',"timing" =>array()),
	'OHCRON' => array('OHCRON','DAILY','12 AM,5 AM',"timing" =>array()),
	'OCHCRON' => array('OCHCRON','DAILY','12 AM,5 AM',"timing" =>array()),
	'CL CRON' => array('CL CRON','DAILY','12 AM,5 AM',"timing" =>array()),
	'ADMIN NOTIFICATIONS' => array('ADMIN NOTIFICATIONS','DAILY','12 AM',"timing" =>array()),
    'TRANSFER'=> array('TRANSFER','DAILY','12 AM',"timing" =>array()),
    'Resignation Relieving' => array('Resignation Relieving','DAILY','12 AM',"timing" =>array()),
    'RESIGN STATUS UPDATE' => array('RESIGN STATUS UPDATE','DAILY','12 AM',"<ul class='list-group'><li class='list-group-item'>Employees who in notice period and last working day in example like below <hr><br> Ex:- Relaving date 01-01-2024 - if current date is 02-01-2024 then 01-01-2024 employees status moved to resigend </li></ul>","timing" =>array()),
    'Monthly Leaves Applied' => array('Leaves Summary','MONTHLY','12 AM',"<ul class='list-group'><li class='list-group-item'>Cron running on every month 4th date Last Month Leaves Summary will be sent to Hr Team they need to check and close the pending leaves</li></ul>","timing" =>array()),
    'Monthly Attendance Regulation' => array('Regulation Summary','MONTHLY','12 AM',"<ul class='list-group'><li class='list-group-item'>Cron running on every month 7th date Last Month Regulations Summary will be sent to Hr Team they need to check and close the pending regulations</li></ul>","timing" =>array()),
	array('yearendcorn',"timing" =>array()),
	array('public_holiday_absent_cron',"timing" =>array()),
	array('sat_sun_mon_cron',"timing" =>array()),
	array('leave_cron_accept',"timing" =>array()),
	array('update_resign_status',"timing" =>array()),
);
// echo '<pre>'; print_r($crons);
foreach ($att_summary['crondetailslist'] as $key => $listview){
   array_push($crons[trim($listview->name)]['timing'],$listview->entry_dt);
    // print_r($crons[$listview->name]);
}

?>
<style>
    .popover-header {
    height: 500px;
    overflow-y: auto;
    white-space:pre-wrap;
}
</style>
						<div class="col-md-8 d-flex">
							<div class="card card-table flex-fill">
								<div class="card-header">
									<h3 class="card-title mb-0">Crons</h3>
								</div>
								<div class="card-body innercontent">
									<div class="table-responsive">
										<table class="table table-nowrap custom-table mb-0">
											<thead>
												<tr>
													<th>Name</th>
													<th>Activity</th>
													<th>Duration</th>
													<th>Status</th>
													<th>Info</th>
												</tr>
											</thead>
											<tbody>
											    <?php foreach($crons as $ckey => $cval){ ?>
												<tr>
													<td><?php echo $cval[0]; ?></td>
													<td><?php echo $cval[1]; ?></td>
													<td><?php echo $cval[2]; ?></td>
													<td>
													    <?php foreach($cval['timing'] as $inkey => $invl){ ?>
													    <span class="badge bg-inverse-success"><?php echo $invl; ?></span>
													    <?php } ?>
													</td>
													<td>
													    <a tabindex="0" class="btn btn-sm btn-primary" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="<?php echo $cval[0]; ?> <br> <?php echo $cval[3]; ?>" data-content=""><i class="la la-info"></i></a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
<?php } ?>
<!--Cron Summary-->


					</div>
					</div>


							

					</div>
				
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
<script>
	function select_all(source,keyname) {
        checkboxes = document.getElementsByName(keyname+'[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    
    function sendmailing(keyname,templateid,type){
        var empcode = [];
        var checkboxs=document.getElementsByName(keyname+"[]");
        var okay=false;
        for(var i=0,l=checkboxs.length;i<l;i++)
        {
            if(checkboxs[i].checked)
            {
                var checkedvalue = checkboxs[i].value;
                empcode.push(checkedvalue);
                okay=true;
                // break;
            }else{
            //  empcode.splice($.inArray(checkedvalue, empcode),1);
            }
        }
        if(okay){
        }else{ 
            alert("Please check a checkbox"); return false;
        }
        
        var mainurl = baseurl+'Dashboard/prepareformailingsendmail';
        $("#"+keyname).hide();
        $("#"+keyname+"buttondone").show();
        $.ajax({
            type : 'POST',
            url : mainurl,
            data : {"empcode":empcode,"templateid":templateid,"type":type},
            success: function (data) {
                console.log(data);
                alert('Please check the Mail Responses in the log');
            },
        })
    }
    $(function(){
    // Enables popover
    $("[data-toggle=popover]").popover({ html : true,sanitize: false });
    });


			</script>