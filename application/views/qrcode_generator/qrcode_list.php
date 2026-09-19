<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employees List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Company</th>
													<th>Division</th>
													<th>State</th>
													<th>Branch</th>
													<th>QR Code</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($qrcodelistdisplay['br'] as $key => $value1) { ?>
												<tr>
												<td><?php echo $qrcodelistdisplay['cp'][0]->mxcp_name ?></td>
												<td><?php echo $qrcodelistdisplay['dv'][0]->mxd_name ?></td>
												<td><?php echo $qrcodelistdisplay['st'][0]->mxst_state ?></td>
												<td><?php echo $value1->mxb_name ?></td>
												<?php 
												$company_id =  trim($qrcodelistdisplay['cp'][0]->mxcp_id);
												$division_id = trim($qrcodelistdisplay['dv'][0]->mxd_id);
												$state_id = trim($qrcodelistdisplay['st'][0]->mxst_id);
												$branch_id = trim($qrcodelistdisplay['br'][$key]->mxb_id);
												// $company_name = trim($qrcodelistdisplay['cp'][0]->mxcp_name);
												// $division_name = trim($qrcodelistdisplay['dv'][0]->mxd_name);
												// $state_name = trim($qrcodelistdisplay['st'][0]->mxst_state);
												// $branch_name = trim($value1->mxb_name);
												// trim($value1->mxb_address);
												?>
												<td><a onclick="sendtoqrcode('<?php echo $company_id ?>','<?php echo $division_id ?>','<?php echo $state_id ?>','<?php echo $branch_id ?>')">View QR</a></td>
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
