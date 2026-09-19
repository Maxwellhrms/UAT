<!-- LEFT -->
<div class="col-md-8">

	<!-- STATS -->
	<div class="row mb-3">
		<div class="col-md-3">
			<div class="mgr-stat-card">
				<div class="mgr-bar mgr-purple"></div>
				<div>
					<div class="mgr-stat-title">Late arrivals</div>
					<div class="mgr-stat-value"><?php echo $dashboardLeavesRegulations['ontimeLatecomming']['late']; ?></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="mgr-stat-card">
				<div class="mgr-bar mgr-green"></div>
				<div>
					<div class="mgr-stat-title">On time</div>
					<div class="mgr-stat-value"><?php echo $dashboardLeavesRegulations['ontimeLatecomming']['ontime']; ?></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="mgr-stat-card">
				<div class="mgr-bar mgr-orange"></div>
				<div>
					<div class="mgr-stat-title">Leaves</div>
					<div class="mgr-stat-value"><?php echo count($dashboardLeavesRegulations['managerleavesdetails']); ?></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="mgr-stat-card">
				<div class="mgr-bar mgr-violet"></div>
				<div>
					<div class="mgr-stat-title">Regulations</div>
					<div class="mgr-stat-value"><?php echo count($dashboardLeavesRegulations['manageremployeeRegulations']); ?></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Leaves -->
	<div class="mgr-card">
		<h6 class="mb-3">Pending Leaves Requests (<?php echo count($dashboardLeavesRegulations['managerleavesdetails']); ?>)</h6>

		<div class="mgr-ot-scroll">
			<div class="row">
				<?php foreach($dashboardLeavesRegulations['managerleavesdetails'] as $mngleavekey => $mngleavevalue){ ?>
				<div class="col-md-4">
					<div class="mgr-ot-card">
						<div class="d-flex align-items-center mb-2">
							<img src="<?php echo HRADMINROOTDOCUMENT.$mngleavevalue->empimg; ?>" height="40px" width="40px" class="mgr-avatar">
							<div>
								<strong><?php echo $mngleavevalue->employeename; ?></strong><br>
								<span class="mgr-small"><?php echo $mngleavevalue->desginationname; ?></span>
							</div>
						</div>
						<div class="mgr-approve"><?php echo $mngleavevalue->employeeid; ?> </div>
						<div class="mgr-small">Date</div>
						<div><?php if($mngleavevalue->from == $mngleavevalue->to){
									echo date('M j', strtotime($mngleavevalue->from));
								}else{
									echo date('M j', strtotime($mngleavevalue->from)) . ' - ' . date('M j', strtotime($mngleavevalue->to));
								} ?>
						</div>
						<div class="mgr-small mt-2">Reason</div>
						<div class="mgr-small"><?php echo $mngleavevalue->emp_description; ?> </div>
						<!-- <div class="text-right mt-2">
							<span class="mgr-reject">Reject</span> |
							<span class="mgr-approve">Approve</span>
						</div> -->
					</div>
				</div>
				<?php } ?>

			</div>
		</div>

	</div>

</div>

<!-- RIGHT -->
<div class="col-md-4">
<!-- manageremployeeRegulations -->
	<div class="mgr-card">
		<h6 class="mb-3">Pending Regulations Requests (<?php echo count($dashboardLeavesRegulations['manageremployeeRegulations']); ?>)</h6>
		<div class="mgr-time-scroll">
			<?php foreach($dashboardLeavesRegulations['manageremployeeRegulations'] as $mngregkey => $mngregvalue){ ?>

				<div class="mgr-req">
				    
				    <div class="d-flex align-items-center">

				        <img src="<?php echo HRADMINROOTDOCUMENT.$mngregvalue->pimage; ?>" height="50px" width="50px" class="mgr-avatar">

				        <div class="mgr-user-details">

				            <strong><?php echo $mngregvalue->employeename; ?></strong>

							<div class="mgr-small">

							    <span class="mgr-approve">
							        <?php echo $mngregvalue->employeeid; ?>
							    </span>

							    <span class="mgr-date">
							        <?php echo date('M j', strtotime($mngregvalue->from)); ?>
							    </span>

							</div>

				            <span class="mgr-badge mgr-medical">
				                <?php echo $mngregvalue->emp_description; ?>
				            </span>

				        </div>

				    </div>

				</div>
			<?php } ?>
		</div>

	</div>

</div>