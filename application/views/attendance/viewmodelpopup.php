<script>  
	var firsthalfdbval='<?php echo $attnd[0]['mx_attendance_first_half']   ?>';
    var secondhalfdbval='<?php echo $attnd[0]['mx_attendance_second_half']  ?>';
</script>


<?php


// print_r($attnd); 
$leavearray = array( 'AB' => 'AB', 'PR' => 'PR' ,'WO' => 'WO' ,
					 'PH'=>'PH', 'OPH'=>'OPH', 'ML'=>'ML','PL'=>'PL','CMPL'=>'CMPL',
				     'CL'=>'CL', 'EL'=>'EL','SL'=>'SL', 'SHRT'=>'SHRT', 'HAPL'=>'HAPL','LOP'=>'LOP','AR' => 'AR','OH' => 'OH','OCH' => 'OCH','OD'=>'OD','OT'=>'OT','LTD'=>'LTD' );
$leavearray_first = array( 'AB' => 'AB', 'PR' => 'PR' ,'WO' => 'WO' ,
					 'PH'=>'PH', 'OPH'=>'OPH', 'ML'=>'ML','PL'=>'PL','CMPL'=>'CMPL',
				     'CL'=>'CL', 'EL'=>'EL','SL'=>'SL', 'SHRT'=>'SHRT', 'HAPL'=>'HAPL','LOP'=>'LOP','AR' => 'AR','OH' => 'OH','OCH' => 'OCH','OD'=>'OD','OT'=>'OT','LTD'=>'LTD' );
$danger = array('CL','EL','SL','AR','OH','OCH','OT');
?>
								<div class="row">
									<div class="col-md-12">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title">Manual Modify To<small class="text-muted" id="dateofattendance"></small> <span style="color:red"><?php echo $attnd[0]['fullname'] .' - '. $attnd[0]['mx_attendance_emp_code'] .' For Date - '.$attnd[0]['mx_attendance_date']; ?></span></h5>
												<div class="row filter-row">
													<div class="col-sm-6 col-md-3">  
														<!-- <div class="form-group form-focus"> -->
															<label class="focus-label">Attendance Date</label>
															<input type="text" class="form-control floating" name="editempdate" id="editempdate" value="<?php echo $attnd[0]['mx_attendance_date'] ?>" readonly="">
														<!-- </div> -->
													</div>
						<div class="col-sm-6 col-md-3">  
							<!-- <div class="form-group form-focus"> -->
								<label class="focus-label">Employee Code</label>
								<input type="text" class="form-control floating" name="editempid" id="editempid" value="<?php echo $attnd[0]['mx_attendance_emp_code']  ?>" readonly="">
							<!-- </div> -->
						</div>
						<!-- <div class="col-sm-6 col-md-3">   -->
							<!-- <div class="form-group form-focus"> -->
								<!-- <label class="focus-label">Employee Row Id</label> -->
								<input type="hidden" class="form-control floating" name="editempmainid" id="editempmainid" value="<?php echo $attnd[0]['mx_attendance_id']  ?>"  readonly="">
							<!-- </div> -->
						<!-- </div> -->
						<div class="col-sm-6 col-md-3"> 
							<!-- <div class="form-group form-focus select-focus"> -->
								<label class="focus-label">Select Firsthalf</label>
								<select class="form-control" style="width: 100%" name="Firsthalf" id="Firsthalf" 
								<?php  if(in_array($attnd[0]['mx_attendance_first_half'],$danger)){ echo 'disabled'; } ?> >
								<?php  
								    foreach($leavearray_first as $key => $val){ 
										if($attnd[0]['mx_attendance_first_half'] == $key){ $sel='selected';}else{$sel = '';}
										if(in_array($key,$danger)){ $disiable = 'disabled'; }else{ $disiable=''; }	?>
									    	<option <?php echo $sel.'  '; ?><?php echo $disiable ?>  value="<?php echo $key ?>"><?php  echo $key ?></option>
								<?php } ?>	
								</select>
							<!-- </div> -->
							<span class="formerror" id="Firsthalferror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<!-- <div class="form-group form-focus select-focus"> -->
								<label class="focus-label">Select Secondhalf</label>
								<select class="form-control" style="width: 100%" name="Secondhalf" id="Secondhalf"
								<?php if(in_array($attnd[0]['mx_attendance_second_half'],$danger)){ echo 'disabled'; } ?> >
								<?php  //print_r($attnd[0]['mx_attendance_second_half']);
								    foreach($leavearray as $keys=>$vals){ 
										if($attnd[0]['mx_attendance_second_half'] == $keys){ $sel='selected';}else{$sel = '';}
										if(in_array($keys,$danger)){ $disiable = 'disabled'; }else{ $disiable=''; }

										?>
									
										<option <?php echo $sel.'  '; ?><?php echo $disiable ?>  value="<?php echo $keys ?>"><?php  echo $keys ?></option>

								<?php } ?>	
							</select>
							<!-- </div> -->
							<span class="formerror" id="Secondhalferror"></span>
						</div>
						<div class="col-sm-6 col-md-6"> 
							<!-- <div class="form-group form-focus select-focus"> -->
								<label class="focus-label">Select Reason For Manual Update</label>
								<textarea class="form-control" style="width: 100%" name="reason" id="reason" rows="5" cols="5"><?php echo $attnd[0]['mx_attendance_reason']; ?></textarea>
							<!-- </div> -->
							<span class="formerror" id="reasonerror"></span>
						</div>
					</div>
											</div>
						<?php $user_id = $this->session->userdata('user_id'); 
						// if( ($this->session->userdata('user_role_edit' ) == 1 || in_array($user_id, ['888666', 'M0009']) ) && ($attnd[0]['mxemp_emp_resignation_status'] != 'R') ){ 

						if (in_array($user_id, ['888666', 'M0009']) || ($this->session->userdata('user_role_edit') == 1 && $attnd[0]['mxemp_emp_resignation_status'] != 'R')) {
							?>
						<div class="text-right">
							<?php
							$salarystatus = checkSalaryExists(array('employeeid' => $userdata['empid'], 'attendancedate' => $userdata['attedancedate']));
							?>
							<?php if($salarystatus == false) { ?>
						    <button class="btn btn-primary" data-toggle="modal" data-target="#validatepassword">Update</button>
                            <?php }else{
								echo '<span style="color:red;">Salary already processed for this month, So attendance can not be updated.</span>';
							} ?>
                        </div>
                        <?php } ?>
										</div>
									</div>


			<!-- Password Protection Modal -->
            <?php require('passwordprotection.php'); ?>
			<!-- Password Protection Modal -->

									<!-- Punch Details -->
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
						<?php if(!empty($value)){ echo date('h:i:s A', strtotime($value)) ;} ?>.
					</p>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>




									<!-- <span class="display_punches row col-md-12"></span> -->
									<!-- Punch Details -->
								</div>
							
				<!-- /Attendance Modal -->