<h5 class="modal-title">
    Edit <?php echo strtoupper($pageTitleName); ?>
</h5>
<form method="post" id="<?php echo strtoupper($pageTitleName) .'ID'; ?>">
	<div class="form-scroll">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Title</label>
							<select class="form-control" name="emptitle" id="emptitle">
								<?php echo $controller->display_options('titles',$details[0]->mxemp_emp_fm_title); ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Relationship</label>
							<select class="form-control" name="empfmrelation" id="empfmrelation">
								<option value="">Select Relation</option>
								<?php
									foreach($relation as $rel){
										if($rel == $details[0]->mxemp_emp_fm_relation ){
											$sel='selected';
										}else{
								 			$sel='';
										}
								?>
								<option <?php echo $sel; ?> value="<?php echo $rel ?>"><?php echo $rel; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" name="empfmname" id="empfmname" type="text" value="<?php echo $details[0]->mxemp_emp_fm_name ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date of birth</label>
							<input class="form-control datetimepicker1" name="empdob" id="empdob" value="<?php echo !empty($details[0]->mxemp_emp_fm_age) ? date('d-m-Y', strtotime($details[0]->mxemp_emp_fm_age)) : ''; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Occupation</label>
							<input class="form-control" name="empfmoccupation" id="empfmoccupation" type="text" value="<?php echo $details[0]->mxemp_emp_fm_occupation ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="submit-section">
		<input type="hidden" name="employeeId" value="<?php echo $details[0]->mxemp_emp_fm_employee_id ?>">
		<input type="hidden" name="Id" value="<?php echo $details[0]->mxemp_emp_fm_id ?>">
		<input type="hidden" name="updatetype" value="<?php echo $pageTitleName; ?>">
		<button type="button" onclick="processForm('<?php echo strtoupper($pageTitleName) .'ID'; ?>', '<?php echo base_url() ?>Employee/updateemployeeinfo','Employee/employeesprofile')" class="btn btn-primary submit-btn">Submit</button>
	</div>
</form>