
<div class="modal-body">
	<div class="card tab-box">
		<div class="row user-tabs">
			<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
				<ul class="nav nav-tabs nav-tabs-bottom">
				     <?php $i = 1; foreach( $emphist['leavename'] as $lhist){ ?>
						<li id="btn_<?php echo $i; ?>" class="nav-item"><a onclick = "leavedethist('<?php echo $lhist->mxemp_leave_bal_emp_id?>' , '<?php echo $lhist->mxemp_leave_bal_leave_type ?>')" data-toggle="tab" class="nav-link "><?php echo $lhist->mxemp_leave_bal_leave_type_name; ?></a></li>
						<?php if($i == 1){ ?>
						    <script>leavedethist('<?php echo $lhist->mxemp_leave_bal_emp_id?>' , '<?php echo $lhist->mxemp_leave_bal_leave_type ?>')</script>
						<?php }?>
					  <?php $i++;} ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id=dtbl></div>


