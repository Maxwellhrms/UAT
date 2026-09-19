<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Resigned Employees List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Name</th>
													<th>Company</th>
													<th>Division</th>
													<th>State</th>
													<th>Branch</th>
													<th>Resigned</th>
													<th>Relieving</th>
													<th>View Details</th>
												</tr>
											</thead>
											<tbody>
											    <?php
											        foreach($notice_period_employees as $emp_data){
											         //   print_r($emp_data);exit;
											            echo "<tr>";
													echo "<td>$emp_data->mxemp_emp_id</td>";
													echo "<td>$emp_data->mxemp_emp_fname $emp_data->mxemp_emp_lname</td>";
													echo "<td>$emp_data->mxcp_name</td>";
													echo "<td>$emp_data->mxd_name</td>";
													echo "<td>$emp_data->mxst_state</td>";
													echo "<td>$emp_data->mxb_name</td>";
													echo "<td>".date('d/m/Y',strtotime($emp_data->mxemp_emp_resignation_date))."</td>";
													$start = strtotime(date('Y-m-d'));
                                                    $end = strtotime($emp_data->mxemp_emp_resignation_relieving_date);
                                                    $days_between = ceil(abs($end - $start) / 86400);
													echo "<td>".date('d/m/Y',strtotime($emp_data->mxemp_emp_resignation_relieving_date))." (".$days_between." Days to Relieve)</td>";
													if($emp_data->mxemp_emp_resignation_status == 'N'){//--->With Notice Period
													    echo "<td><a class='btn btn-info' href='".base_url()."Fullandfinalsettlement/fandfdetails/".$emp_data->mxemp_emp_id."/".$emp_data->mxemp_emp_resignation_status."'>View</a></td>";
													}else if($emp_data->mxemp_emp_resignation_status == 'R' && $emp_data->mxemp_emp_is_without_notice_period == 0 ){//---->With Notice Period F&F Completed
													//&& $emp_data->mxemp_emp_is_fandf_completed == 1
													    echo "<td><a class='btn btn-info' href='".base_url()."Fullandfinalsettlement/fandfdetails/".$emp_data->mxemp_emp_id."/R'>View</a></td>";
													}else if($emp_data->mxemp_emp_resignation_status == 'R' && $emp_data->mxemp_emp_is_without_notice_period == 1 && $emp_data->mxemp_emp_is_fandf_completed == 0){//------->Without Notice Period
													    echo "<td><a class='btn btn-info' href='".base_url()."Fullandfinalsettlement/fandfdetails_left/".$emp_data->mxemp_emp_id."/WN'>View</a></td>";
													}else if($emp_data->mxemp_emp_resignation_status == 'R' && $emp_data->mxemp_emp_is_without_notice_period == 1 ){//--->F&F Completed For Without Notice Period
													//&& $emp_data->mxemp_emp_is_fandf_completed == 1
													    echo "<td><a class='btn btn-info' href='".base_url()."Fullandfinalsettlement/fandfdetails_left/".$emp_data->mxemp_emp_id."/R'>View</a></td>";
													}
												    echo "</tr>";
											        }
											    ?>
												<!--<tr>-->
												<!--	<td>EMP0001</td>-->
												<!--	<td>Test</td>-->
												<!--	<td>DIVISION</td>-->
												<!--	<td>STATE</td>-->
												<!--	<td>Branch</td>-->
												<!--	<td>01-08-2021</td>-->
												<!--	<td>01-09-2021 (31 Days to Relieve)</td>-->
												<!--	<td><a class="btn btn-info" href="<?php //echo base_url() ?>Fullandfinalsettlement/fandfdetails">View</a></td>-->
												<!--</tr>-->
													
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <!-- Data Tables -->