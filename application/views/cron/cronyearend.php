
<!-- Data Tables -->
<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Cron Year End List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee ID</th>
													<!-- <th>Name</th> -->
													<th>Leave Type</th>
													<th>Previous</th>
													<th>Current</th>
													<th>Process Type</th>
												</tr>
											</thead>
										<?php /*  */?>
											<tbody>
												<?php 
												// echo '<pre>';
												// print_r($cnlist); die;
												foreach ($cnlist as $key => $value1) { ?>
												<tr>
													<td><?php echo $value1->mxemp_leave_cron_emp_id ?></td>
													<!-- <td><?php // echo $value1->mxemp_emp_fname . ' ' . $value1->mxemp_emp_lname ?></td> -->
													<td><?php echo $value1->mxemp_leave_cron_short_name ?></td>
													<td><?php echo $value1->mxemp_leave_cron_previous_bal ?></td>
													<td><?php echo $value1->mxemp_leave_cron_crnt_bal ?></td>
													<td><?php echo $value1->mxemp_leave_cron_process_type ?></td>
												</tr>
												<?php } ?>
											</tbody>

                                        <?php /*    */ ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
<!-- Data Tables -->