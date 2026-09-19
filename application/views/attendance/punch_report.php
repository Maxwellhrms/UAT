<div class="col-md-6">
	<div class="card punch-status">
		<div class="card-body">
			<h5 class="card-title">Timesheet <small class="text-muted"><?php echo date('d M Y',strtotime($punchhistory['attendance'])); ?></small></h5>
			<div class="punch-det">
				<h6>Punch In at</h6>
				<p><?php if(!empty($punchhistory['firstpunch'])){echo date("l jS  F Y h:i:s A", strtotime($punchhistory['attendance'] . $punchhistory['firstpunch']));} ?></p>
			</div>
			<div class="punch-info">
				<div class="punch-hours">
					<span><?php echo $punchhistory['total']; ?> hrs</span>
				</div>
			</div>
			<div class="punch-det">
				<h6>Punch Out at</h6>
			<p><?php if(!empty($punchhistory['lastpunch'])){echo date("l jS  F Y h:i:s A", strtotime($punchhistory['attendance'] . $punchhistory['lastpunch']));} ?></p>
			</div>
			<div class="statistics">
				<div class="row">
<!-- 					<div class="col-md-6 col-6 text-center">
						<div class="stats-box">
							<p>Break</p>
							<h6>1.21 hrs</h6>
						</div>
					</div> -->
					<div class="col-md-6 col-6 text-center">
						<div class="stats-box">
							<p>Overtime</p>
							<h6><?php echo $punchhistory['ot']; ?> hrs</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="card recent-activity">
		<div class="card-body">
			<h5 class="card-title">Activity</h5>
			<ul class="res-activity-list">
				<?php foreach ($punchhistory['punches'] as $key => $value) { ?>
				
				<li>
					<p class="mb-0">Punch - <?php echo $punchhistory['type'][$key]; ?></p>
					<p class="res-activity-time">
						<i class="fa fa-clock-o"></i>
						<?php if(!empty($value)){echo date('h:i:s A', strtotime($value));} ?>.
					</p>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>