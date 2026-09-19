<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="card mb-0">					
            <div class="card-header">
				<h4 class="card-title mb-0">Preview List</h4>
			</div>
            <div class="card-body">	
				<div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example1">
						<thead>
							<tr>
							     <th>Sno</th>
                                 <th>Process Description</th>
                            </tr>
						</thead>
                        <tbody>
                            <?php 
                            $month = date('m',strtotime($attendancedate));
                            $year = date('Y',strtotime($attendancedate));
                            if (strlen($month) == 1) {
                                $month = '0' . $month;
                            }
                            $tablename = 'UPDATE `maxwell_attendance_' . $year . '_' . $month . '` SET';
                            $sno = 1; foreach ($resp as $key => $val) {
                                $processed = str_replace($tablename, 'Processed', $val);
                                $fgrace = str_replace("`mx_attendance_first_half_grace_time`", "<span style='color:red'>First Half Grace Time Applied</span>", $processed);
                                $firsthalf = str_replace("`mx_attendance_first_half`", "<span style='color:red'>First Half</span>", $fgrace);
                                $secondhalf = str_replace("`mx_attendance_second_half`", "<span style='color:red'>Second Half</span>", $firsthalf);
                                $uniqueid = str_replace("`mx_attendance_id`", "<span style='color:red'>Unique Id</span>", $secondhalf);
                                $employeecode = str_replace("`mx_attendance_emp_code`", "<span style='color:red'>For Employee Code</span>", $uniqueid);
                                $sgrace = str_replace("`mx_attendance_date`", "<span style='color:red'>For Attendance Date</span>", $employeecode);
                                $final = str_replace("`mx_attendance_second_half_grace_time`", "<span style='color:red'>Second Half Grace Time Applied</span>", $sgrace);
                             ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $final; ?></td>
                            </tr>
                            <?php $sno++; } ?>
                        </tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
</div>