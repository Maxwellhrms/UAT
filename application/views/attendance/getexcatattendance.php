<?php 
$ab = (object) array("mxemp_leave_bal_leave_type_shrt_name" => "AB", "mxemp_leave_bal_crnt_bal" => "");
$ab1 = (object) array("mxemp_leave_bal_leave_type_shrt_name" => "PR", "mxemp_leave_bal_crnt_bal" => "");
array_push($exacttypes['leavetypes'], $ab);
array_push($exacttypes['leavetypes'], $ab1);

//print_r($exacttypes['leavetypes']);
?>

<form method="post">
	<div class="row filter-row">
		<div class="col-md-6">
			<label>Frist Half</label>
			<?php 
				if($exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "PR" || $exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "OCH"  || $exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "OH"  || $exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "CL" || $exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "SL" || $exacttypes['daywiseattnd'][0]->mx_attendance_first_half == "EL"){
					$dis = "disabled";
					$sty = "style='display:none'";
				}else{
					$dis = "";
					$sty = "";
				}
			?>
			<select class="form-control" style="width: 100%" name="Firsthalf" id="Firsthalf" <?php echo $dis; ?>> 
				<option value="">Select Firsthalf</option>
				<?php foreach ($exacttypes['leavetypes'] as $key => $value) {
					if($value->mxemp_leave_bal_leave_type_shrt_name == $exacttypes['daywiseattnd'][0]->mx_attendance_first_half){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $value->mxemp_leave_bal_leave_type_shrt_name ?>" <?php echo $sel; ?> ><?php echo $value->mxemp_leave_bal_leave_type_shrt_name ?></option>
				<?php } ?>
			</select>
			<!-- <span id="firstcal" <?php //echo $sty; ?> >0.5 CL Will Debited</span>										 -->
		</div>
		<div class="clear"></div>
		<div class="col-md-6">
			<label>Second Half</label>
			<?php 
				if($exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "PR" || $exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "OCH"  || $exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "OH"  || $exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "CL" || $exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "SL" || $exacttypes['daywiseattnd'][0]->mx_attendance_second_half == "EL"){
					$dis1 = "disabled";
					$sty1 = "style='display:none'";
				}else{
					$dis1 = "";
					$sty1 = "";
				}
			?>
	<select class="form-control" style="width: 100%" name="Secondhalf" id="Secondhalf" <?php echo $dis1; ?>> 
		<option value="">Select Secondhalf</option>
				<?php foreach ($exacttypes['leavetypes'] as $key1 => $value1) {
					if($value1->mxemp_leave_bal_leave_type_shrt_name == $exacttypes['daywiseattnd'][0]->mx_attendance_second_half){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $value1->mxemp_leave_bal_leave_type_shrt_name ?>" <?php echo $sel; ?> ><?php echo $value1->mxemp_leave_bal_leave_type_shrt_name ?></option>
				<?php } ?>
	</select>
			<!-- <span id="secondcal" <?php //echo $sty1; ?> >0.5 EL Will Debited</span>										 -->
		</div>
		<input type="hidden" name="editempmainid" id="editempmainid" value="<?php echo $exacttypes['daywiseattnd'][0]->mx_attendance_id ?>">
		<input type="hidden" name="editempdate" id="editempdate" value="<?php echo $exacttypes['daywiseattnd'][0]->mx_attendance_date ?>">
		<input type="hidden" name="editempid" id="editempid" value="<?php echo $exacttypes['daywiseattnd'][0]->mx_attendance_emp_code ?>">
	</div>
		<center id="returnerror"></center>
</form>
<hr>
<div class="modal-btn delete-action">
	<div class="row">
		<div class="col-6">
			<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processbalance" onclick="processemployeeadjustment();">Process</a>
		</div>
		<div class="col-6">
			<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
		</div>
	</div>
</div>