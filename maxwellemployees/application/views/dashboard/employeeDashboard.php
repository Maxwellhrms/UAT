<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="welcome-box">
					<div class="welcome-img">
						<img alt="" src="<?php echo $this->session->userdata('session_img'); ?>">
					</div>
					<div class="welcome-det">
						<h3>Welcome, <?php echo $this->session->userdata('session_name'); ?></h3>
						<p><?php echo date('l'); ?>, <?php echo date('d M Y'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="container-fluid p-3">

		<div class="row">

<!-- LEFT SIDE -->
<div class="col-md-6">

	<div class="row">



<!-- Open Actions -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body">

			<h6 class="mb-3">Reporting Team</h6>

			<div class="d-flex align-items-center mb-3">

				<?php foreach ($dashboard['authorization'] as $authkey => $authval) { ?>
					<div class="text-center mr-3 position-relative">
						<img src="<?php echo HRADMINROOTDOCUMENT.$authval->mxemp_emp_img ?>" width="60px" height="60px" class="rounded-circle">
						<span style="position:absolute;top:2px;right:6px;width:10px;height:10px;background:<?php if($authval->working_status == 'Working'){ echo '#55ce63'; }else{ echo '#ff3b3b'; } ?>;border-radius:50%;"></span>
						<div class="mt-2 small font-weight-bold text-truncate" style="max-width:70px;">
							<?php echo $authval->mxemp_emp_fname ?>
						</div>
					</div>
				<?php } ?>
			</div>

			<p class="text-muted mb-0">
				Check your reporting hierarchy and supervisors.
			</p>

		</div>
	</div>
</div>

<!-- Attendance -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body">
			<h6>Attendance</h6>
			<div class="d-flex justify-content-between">
				<div>
					<h4 class="text-primary"><?php echo $dashboard['avgattendance'][0]['ontime_days']; ?></h4>
					<small>On Time Days</small>
				</div>
				<div>
					<h4 class="text-primary"><?php echo $dashboard['avgattendance'][0]['ontime_percent']; ?>%</h4>
					<small>On Time Arrival</small>
				</div>
			</div>
			<hr>
			<small><?php echo date('H:i:s a') ?></small><br>
			<small class="text-muted"><?php echo strtoupper(date('D d, M Y')); ?></small>
		</div>
	</div>
</div>

<!-- Out Today -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body">

			<h6>Out today</h6>

			<div class="d-flex align-items-center mb-2">

				<?php 
				$count = 0; 

				foreach($dashboard['inleavessummary'] as $inleavekey => $todayleaves){  

					if($count == 7){
						break;
					}
				?>

					<img src="<?php echo HRADMINROOTDOCUMENT.$todayleaves['image'] ?>" 
					     width="40px" 
					     height="40px" 
					     class="rounded-circle me-1">

				<?php 
					$count++; 
				} 
				?>

				<div class="rounded-circle border border-primary text-primary d-flex align-items-center justify-content-center"
				     style="width:40px;height:40px; cursor:pointer;"
				     data-bs-toggle="modal"
				     data-bs-target="#outTodayModal">

				    +<?php echo count($dashboard['inleavessummary']); ?>

				</div>

			</div>

			<small class="text-muted">
				<?php echo (count($dashboard['inleavessummary'])); ?> employees are out today.
			</small>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="outTodayModal" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content">
      
      <div class="modal-header">

        <h5 class="modal-title">
        	Employees Out Today
        </h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body">
        
        <div class="table-responsive">

          <table class="table table-bordered table-striped align-middle">

            <thead>

              <tr>
              	<th>Employee Code</th>
                <th>Employee Name</th>
                <th>Leave Status</th>
                <th>Leave Type</th>
                <th>Leave Date</th>
                <th>Days</th>
                <!-- <th>Reason</th> -->
              </tr>

            </thead>

            <tbody>

              <?php foreach($dashboard['inleavessummary'] as $row){ ?>

                <tr>
                	<td><?php echo $row['employeecode']; ?></td>
                  <td>
                    <img src="<?php echo HRADMINROOTDOCUMENT.$row['image']; ?>" 
                         width="35" 
                         height="35" 
                         class="rounded-circle">
                         <?php echo $row['name']; ?>
                  </td>

                  <td>
                  	<?php echo $row['leave_status']; ?>
                  </td>

                  <td>
                  	<?php echo $row['leavetype']; ?>
                  </td>
                  <td>
                  	<?php echo $row['fromdate'].' To '.$row['todate']; ?>
                  </td>
                  <td>
                  	<?php echo $row['noofdays']; ?>
                  </td>
<!--                   <td>
                  	<?php #echo $row['description']; ?>
                  </td> -->

                </tr>

              <?php } ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>


<!-- Leave -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body">
			<h6>Leave Balances</h6>
			<div class="d-flex justify-content-between">
				<div>
					<h4><?php echo $dashboard['avaliableleaves'][0]['total_leaves']; ?></h4>
					<small>Total Leaves</small>
				</div>
				<div>
					<h4><?php echo $dashboard['avaliableleaves'][0]['paid_leaves']; ?></h4>
					<small>Paid Leaves</small>
				</div>
			</div>
			<hr>
			<a href="#" class="text-primary">Total Leaves = All leave types.</a>
		</div>
	</div>
</div>

<!-- Next Holiday -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body d-flex justify-content-between align-items-center">
			<div>
				<h6>Next Holiday</h6>
				<h1 class="mb-0"><?php echo date('d',strtotime($dashboard['hoildaysummary'][0]['holidaydate'])); ?></h1>
				<small><?php echo date('M Y',strtotime($dashboard['hoildaysummary'][0]['holidaydate'])); ?></small>
				<p class="text-muted mb-0"><?php echo $dashboard['hoildaysummary'][0]['holidayname']; ?></p>
				<p style="background: #e6f7ee;color: #1e7e34;border-radius:20px"><?php echo $dashboard['hoildaysummary'][0]['holiday_type']; ?></p>
			</div>
			<i class="la la-umbrella-beach fa-2x text-info"></i>
		</div>
	</div>
</div>

<!-- Salary -->
<div class="col-md-6 mb-3">
	<div class="card shadow-sm h-100">
		<div class="card-body">
			<h6>Salary Update</h6>
			<div class="d-flex justify-content-between mb-2">
				<div>
					<small>WORKING DAYS</small>
					<h5><?php echo $dashboard['paysheetsummary']['workingdays'] ?> Days</h5>
				</div>
				<div>
					<small>PAYROLL STATUS</small>
					<h5><?php echo $dashboard['paysheetsummary']['salarystatus'] ?></h5>
				</div>
			</div>
			<hr>
			<div class="d-flex justify-content-between">
				<small class="text-muted">
					<?php echo $dashboard['paysheetsummary']['monthyear'] ?>
				</small>
				<a href="<?php echo base_url().'Employee/employeepayslips' ?>" class="text-primary">View Payslip</a>
			</div>
		</div>
	</div>
</div>

</div>
</div>

<!-- RIGHT SIDE -->
<div class="col-md-6">

	<div class="card shadow-sm" id="updatesPanel" style="height:656px; overflow-y:auto; display:flex; flex-direction:column; position:relative;">

<!-- Tabs (STICKY NOW) -->
<div class="card-header p-2 bg-white" style="position:sticky; top:0; z-index:10;">

	<div class="d-flex justify-content-between align-items-center">

		<ul class="nav nav-tabs card-header-tabs mb-0" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#circular" role="tab"><i class="fa fa-bullhorn mr-1"></i> Circular <?php echo count($dashboard['circularssummary']); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#notification" role="tab"><i class="fa fa-bell-o"></i> Notification <?php echo count($dashboard['notificationssummary']); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#birthday" role="tab"><i class="fa fa-birthday-cake"></i> Birthdays <?php echo count($dashboard['dobsummary']); ?></a>
			</li>
<!-- 	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#event" role="tab">Event</a>
	</li> -->
</ul>

<!-- NEW BADGE -->
<span class="badge badge-danger" id="newBadge">New</span>

</div>

</div>

<!-- Tab Content -->
<div class="tab-content flex-grow-1">

<!-- UPDATE TAB -->
<div class="tab-pane fade show active h-100" id="circular" role="tabpanel">
	<div style="height:100%; overflow-y:auto; padding:10px;">

<!-- Circular -->
<?php foreach ($dashboard['circularssummary'] as $circularval) { ?>
	<div class="card mb-2 border-left border-primary" style="border-left-width:4px;">
		<div class="card-body p-2">

			<div class="d-flex justify-content-between">
				<div><i class="fa fa-bullhorn mr-1"></i><strong> <?php echo $circularval['circular_no']; ?></strong></div>
				<small class="text-muted"><?php echo time_elapsed_string($circularval['mx_cr_createdtime']); ?></small>
			</div>

			<div class="media mt-2">
				<img src="<?php echo HRADMINROOTDOCUMENT.$circularval['mxemp_emp_img']; ?>"  width="40px" height="40px" class="mr-2 rounded-circle">
				<div class="media-body">
					<h6 class="text-primary mb-1"><?php echo $circularval['mxemp_emp_fname']; ?></h6>

					<div style="max-height:180px; overflow:auto;">
						<strong><?php echo $circularval['circular_title']; ?></strong>
						<p class="mb-0">
							<?php echo strip_tags($circularval['circular_description']); ?>
						</p>
						<a target="_blank" href="<?php echo HRADMINROOTDOCUMENT.$circularval['circular_file']; ?>" class="text-primary">
							<i class="fa fa-file-pdf-o"></i> Document
						</a>
					</div>

				</div>
			</div>

		</div>
	</div>
<?php } ?>

</div>
</div>

<!-- OTHER TABS -->
<div class="tab-pane fade h-100" id="notification">
	<div style="height:100%; overflow-y:auto; padding:10px;">
		<?php foreach ($dashboard['notificationssummary'] as $ntfval) { ?>
			<div class="card mb-2 border-left border-info" style="border-left-width:4px;">
				<div class="card-body p-2">

					<div class="d-flex justify-content-between">
						<div><i class="fa fa-bell-o"></i><strong> <?php echo $ntfval['notification_title']; ?></strong></div>
						<small class="text-muted"><?php echo time_elapsed_string($ntfval['notificationcreateddate']); ?></small>
					</div>

					<div class="media mt-2">
						<img src="<?php echo HRADMINROOTDOCUMENT.$ntfval['mxemp_emp_img']; ?>"  width="40px" height="40px" class="mr-2 rounded-circle">
						<div class="media-body">
							<h6 class="text-info mb-1"><?php echo $ntfval['mxemp_emp_fname']; ?></h6>

							<div style="max-height:180px; overflow:auto;">
								<p class="mb-0">
									<?php echo strip_tags($ntfval['notification_description']); ?>
								</p>
								<a target="_blank" href="<?php echo HRADMINROOTDOCUMENT.$ntfval['notification_file']; ?>" class="text-info">
									<i class="fa fa-file-pdf-o"></i> Document
								</a>
							</div>

						</div>
					</div>

				</div>
			</div>
		<?php } ?>
	</div>
</div>

<div class="tab-pane fade h-100" id="birthday">
	<div style="height:100%; overflow-y:auto; padding:10px;">
		<!-- Birthdays -->
		<div class="card mb-2">
			<div class="card-body p-2">

				<div><i class="fa fa-birthday-cake mr-2"></i> <strong>Birthdays</strong></div>

				<div class="d-flex mt-2 flex-wrap" style="max-height:480px; overflow:auto;">
					<?php 
					$count = 0;
					foreach ($dashboard['dobsummary'] as $dbkey => $dbval) { 
						$count++;
						?>

						<div class="text-center mr-3 mb-2" style="width:100px;">
							<img src="<?php echo HRADMINROOTDOCUMENT.$dbval['image']; ?>" width="40px" height="40px" class="rounded-circle">
							<div><?php echo $dbval['name']; ?></div>
							<div style="font-size:11px;color:#777;">
								<?php echo date('d M',strtotime($dbval['mxemp_emp_date_of_birth'])); ?>
							</div>
						</div>

						<?php 
					// After every 6 items
						if ($count % 6 == 0) {
							echo '<div class="w-100"><hr></div>';
						}
						?>

					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="tab-pane fade h-100" id="event">
	<div style="height:100%; overflow-y:auto; padding:10px;">
		<!-- Work Anniversary -->
		<div class="card mb-2">
			<div class="card-body p-2">

				<div><i class="fa fa-calendar mr-2"></i><strong>Work Anniversaries</strong></div>

				<div class="d-flex mt-2 flex-wrap" style="max-height:100px; overflow:auto;">
					<div class="text-center mr-3" style="width:70px;">
						<img src="https://i.pravatar.cc/40?img=1" class="rounded-circle">
						<div>Jaydeep</div>
						<div style="font-size:11px;color:#777;">2 yrs</div>
					</div>

					<div class="text-center mr-3" style="width:70px;">
						<img src="https://i.pravatar.cc/40?img=2" class="rounded-circle">
						<div>Surendra</div>
						<div style="font-size:11px;color:#777;">2 yrs</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

</div>

</div>
</div>


</div>

</div>

<script>
	var panel = document.getElementById('updatesPanel');
	var badge = document.getElementById('newBadge');

	panel.addEventListener('scroll', function () {
		if (panel.scrollTop > 30) {
			badge.style.display = 'none';
		}
	});

	$('.nav-tabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
</script>
