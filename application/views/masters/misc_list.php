<!-- Data Tables -->
<div class="table-responsive">
					<table class="datatable table table-stripped mb-0" id="dataTables-example">
						<thead>
							<tr>
								<th>Company Name</th>
								<th>Division</th>
								<th>State</th>
								<th>Branch Name</th>
								<th>Empcode</th>
								<th>EmpName</th>
								<th>MonthYear</th>
								<th>Tds Amount</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($tdsList as $key => $tdsdata) { ?>
								<tr>
									<td><?php echo $tdsdata->mxcp_name ?></td>
									<td><?php echo $tdsdata->mxd_name ?></td>
									<td><?php echo $tdsdata->mxb_state_name ?></td>
									<td><?php echo $tdsdata->mxb_name ?></td>
									<td><?php echo $tdsdata->mxemp_misc_inc_empcode ?></td>
									<td><?php echo $tdsdata->mxemp_emp_fname .' '.$tdsdata->mxemp_emp_lname ?></td>
									<td><?php echo $tdsdata->mxemp_misc_inc_month_year ?></td>
									<td><?php echo $tdsdata->mxemp_misc_inc_tds_amt ?></td>
									<td>
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<?php if($this->session->userdata('user_role_edit') == 1){ ?><a class="dropdown-item" href="<?php echo base_url() ?>admin/edittds/<?php echo $tdsdata->mxemp_misc_inc_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a><?php } ?>
												<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item tdsdelete" data-toggle="modal" data-target="#delete" data-id="<?php echo $tdsdata->mxemp_misc_inc_id . '~' . $tdsdata->mxemp_misc_inc_month_year. '~' . $tdsdata->mxemp_misc_inc_tds_amt; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
											</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
<!-- Data Tables -->