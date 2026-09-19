
<!-- Data Tables -->
<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Employee Request List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee Code</th>
													<th>Employee Name</th>
													<th>Company Name</th>
													<th>Division Name</th>
													<th>State Name</th>
													<th>Branch Name</th>
													<th>Request Name</th>
													<th>Description</th>
													<th>Status</th>
													<th>Created by</th>
													<th>Parcel type</th>
													<th>Parcel Companyid</th>
													<th>Parcel Divisionid</th>
													<th>Parcel Stateid</th>
													<th>Parcel Branchid</th>
													<th>Parcel Company Name info</th>
													<th>Parcel Contact Person info</th>
													<th>Parcel Mobile info</th>
													<th>Parcel Emailid info</th>
													<th>Parcel Address info</th>
													<th>Parcel Pincode info</th>
													<th>Parcel Material Type</th>
													<th>Parcel Current transpoter info</th>
													<th>More</th>
												</tr>
											</thead>
											<tbody>
                                            <?php if(count($emprequestdata)>0){ ?>
												<tr>
													<?php foreach ($emprequestdata as $key => $listview) { ?>
                                                    <td><?php echo $listview->mxemp_req_emp_code ?></td>
													<td><?php echo $listview->mxemp_emp_fname .' '.$listview->mxemp_emp_lname;  ?></td>
													<td><?php echo $listview->mxcp_name ?></td>
													<td><?php echo $listview->mxd_name ?></td>
													<td><?php echo $listview->mxst_state ?></td>
													<td><?php echo $listview->mxb_name ?></td>
													<td><?php echo $listview->mxemp_req_req_name ?></td>
													<td><?php  echo strip_tags(substr($listview->mxemp_req_desc,0,25)) . '...'; ?></td>
													<td><?php if($listview->mxemp_req_status == 1)
                                                    { echo 'Active'; }else{ echo 'In-Active'; } ?></td>
                                                    <td><?php echo $listview->mxemp_req_createdtime; ?></td>
													<td><?php echo $listview->parcel_type ?></td>
													<td><?php echo $listview->parcel_companyname ?></td>
													<td><?php echo $listview->parcel_divisionname ?></td>
													<td><?php echo $listview->parcel_statename ?></td>
													<td><?php echo $listview->parcel_branchname ?></td>
													<td><?php echo $listview->parcel_company_name_info ?></td>
													<td><?php echo $listview->parcel_contact_person_info ?></td>
													<td><?php echo $listview->parcel_mobile_info ?></td>
													<td><?php echo $listview->parcel_emailid_info ?></td>
													<td><?php echo $listview->parcel_address_info ?></td>
													<td><?php echo $listview->parcel_pincode_info ?></td>
													<td><?php echo $listview->parcel_material_type ?></td>
													<td><?php echo $listview->parcel_current_transpoter_info ?></td>
													<td>
													
													<div class="dropdown dropdown-action">
																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																<div class="dropdown-menu dropdown-menu-right">
																	<?php if($this->session->userdata('user_role_edit') == 1){ ?><a class="dropdown-item" href="<?php echo base_url() ?>admin/editemprequest/<?php echo $listview->mxemp_req_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a><?php } ?>
																	<?php if($this->session->userdata('user_role_delete') == 1){ ?><a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="<?php echo $listview->mxemp_req_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a><?php } ?>
																</div>
															</div>		</td>
												</tr>
													<?php } ?>
													<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

<!-- Data Tables -->
