<?php 
$checkroll = array();
foreach($rolback as $key => $xval){
	$checkroll[$xval->mxemp_leave_adjust_emp_id] = $xval->count;
}

?>
<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employees List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="absentshistory">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Name</th>
													<th>Branch</th>
													<th>Division</th>
													<th>CL</th>
													<th>SL</th>
													<th>EL</th>
													<!--<th>SHRT</th>-->
													<th>OH</th>
													<th>OCH</th>
													<th>Absent</th>
													<th>Edit</th>
													<th>Revert</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($absentemployees as $key => $value1) { ?>
												<tr>
													<td><?php echo $value1->EmployeeID ?></td>
													<td><?php echo $value1->EmployeeName ?></td>
													<td><?php echo $value1->mxb_name ?></td>
													<td><?php echo $value1->mxd_name ?></td>
													<?php foreach ($currentleaves as $key1 => $value2) {
														if($value2->employeeid == $value1->EmployeeID){
															echo '<td>'.$value2->CL.'</td>';
															echo '<td>'.$value2->SL.'</td>';
															echo '<td>'.$value2->EL.'</td>';
												// 			echo '<td>'.$value2->SHRT.'</td>';
															echo '<td>'.$value2->OH.'</td>';
															echo '<td>'.$value2->OCH.'</td>';
														}else{
															 // echo '<td></td>';
															 // echo '<td></td>';
															 // echo '<td></td>';
															 // echo '<td></td>';
															 // echo '<td></td>';
															 // echo '<td></td>';
														}
													} ?>
													<?php 
													if (preg_match("/^MD\d+/", $value1->EmployeeID)) {
													    		  echo '<td></td>';
															  echo '<td></td>';
															  echo '<td></td>';
															  echo '<td></td>';
															  echo '<td></td>';
															  echo '<td></td>';
													}
													?>
													<td><?php echo ($value1->Absent+$value1->First_Half_Absent+$value1->Second_Half_Absent); ?></td>
													<td><?php if($this->session->userdata('user_role_edit') == 1){ ?><a type="button" class="btn btn-info" href="<?php echo base_url() ?>admin/editleaveadjustment?employeecode=<?php echo $value1->EmployeeID ?>&ym=<?php echo date('Y_m',strtotime($value1->mx_attendance_date)) ?>" >Adjust</a><?php } ?></td>
													<?php if($this->session->userdata('user_role_edit') == 1){ ?>
													<?php if(array_key_exists($value1->EmployeeID, $checkroll) ){
										if($checkroll[$value1->EmployeeID] > 0){ ?>
											<td><a type="button" class="btn btn-info" href="<?php echo base_url() ?>admin/adjustmentleaverollback?employeecode=<?php echo $value1->EmployeeID ?>&ym=<?php echo date('Y_m',strtotime($value1->mx_attendance_date)) ?>" >Revert</a></td>
									<?php	}else{ ?> <td> No Adjustment</td> <?php } ?>
										<?php }else{ ?><td> No Adjustment</td> <?php  } ?>
										<?php } ?>
												</tr>
												<?php } ?>
													
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
<!-- Data Tables -->
