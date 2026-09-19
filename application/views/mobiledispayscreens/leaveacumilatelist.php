                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <div class="card mb-0">					
                                <div class="card-header">
									<h4 class="card-title mb-0">Employees Current Leaves List</h4>
								</div>
                                <div class="card-body">	
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example1">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Employee Name</th>
													<th>CL</th>
													<th>EL</th>
													<th>SL</th>
                                                    <th>OH</th>
                                                    <th>OCH</th>
                                                    <th>Status</th>
                                                    <th>Resigned Date</th>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php foreach($leaveacumilatelist as $val){ ?>
                                                    <tr>
                                                        <td><?php echo $val->employeeid; ?></td>
                                                        <td><?php echo $val->empname; ?></td>
                                                        <td>
                                                        <?php  if($val->CL != ''){ ?>
                                                           <input type="text" id="lv_<?php echo $val->CLuniqueid; ?>" name="lv" onkeypress='validate(event)' value="<?php echo $val->CL; ?>">
                                                           <button class="btn btn-primary" onclick="leaveacumilate('<?php echo $val->employeeid ?>','<?php echo $val->CLuniqueid ?>')" id="clbutton" type="button">Save</button>
                                                        <?php }else{ ?>  NA   <?php  } ?></td>
                                                        <td><?php  if($val->EL != ''){ ?>
                                                            <input type="text" id="lv_<?php echo $val->ELuniqueid; ?>" name="lv" onkeypress='validate(event)'  value="<?php echo $val->EL; ?>">
                                                            <button class="btn btn-primary" onclick="leaveacumilate('<?php echo $val->employeeid ?>','<?php echo $val->ELuniqueid ?>')" <?php echo $el ?> id="elbutton" type="button">Save</button>
                                                        <?php }else{ ?>  NA   <?php  } ?></td>
                                                        <td><?php  if($val->SL != ''){ ?>
                                                            <input type="text" id="lv_<?php echo $val->SLuniqueid; ?>" name="lv" onkeypress='validate(event)' value="<?php echo $val->SL; ?>">
                                                            <button class="btn btn-primary" <?php echo $sl ?> id="slbutton"  onclick="leaveacumilate('<?php echo $val->employeeid ?>','<?php echo $val->SLuniqueid ?>')" type="button">Save</button>
                                                        <?php }else{ ?>  NA   <?php  } ?></td>
                                                        <td><?php  if($val->OH != ''){ ?>
                                                            <input type="text" id="lv_<?php echo $val->OHuniqueid; ?>" name="lv" onkeypress='validate(event)'  value="<?php echo $val->OH; ?>">
                                                            <button class="btn btn-primary" id="ohbutton" onclick="leaveacumilate('<?php echo $val->employeeid ?>','<?php echo $val->OHuniqueid ?>')"  type="button">Save</button>
                                                        <?php }else{ ?>  NA   <?php  } ?></td>
                                                        <td><?php  if($val->OCH != ''){ ?>
                                                            <input type="text" id="lv_<?php echo $val->OCHuniqueid; ?>" name="lv" onkeypress='validate(event)' value="<?php echo $val->OCH; ?>">
                                                            <button class="btn btn-primary" id="ochbutton" onclick="leaveacumilate('<?php echo $val->employeeid ?>','<?php echo $val->OCHuniqueid ?>')"  type="button">Save</button>
                                                        <?php }else{ ?> NA   <?php  } ?></td>
                                                        <td><?php echo $val->employeeWorkingStatus; ?></td>
                                                        <td><?php if($val->mxemp_emp_resignation_date == '0000-00-00 00:00:00'){ echo '';}elseif($val->mxemp_emp_resignation_date == ''){ echo '';}else{ echo date('d-M-Y',strtotime($val->mxemp_emp_resignation_date)); } ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <tbody>
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
         

                    