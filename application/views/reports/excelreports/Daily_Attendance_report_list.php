

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <div class="card mb-0">					
                                <div class="card-header">
									<h4 class="card-title mb-0">Daily Attendance Report Of All States & Branch Names dropdown</h4>
								</div>
                                <div class="card-body">	
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example1">
											<thead>
												<tr>
													<th>SNo</th>
													<th>State</th>
													<th>Division</th>
													<th>Branch</th>
													<th>Employee Code</th>
													<th>Name Of Employee</th>
													<th>Designation</th>
													<th>First Punch</th>
													<th>Last Punch </th>
													<th>Absent First Half</th>
													<th>Absent Second Half</th>
                                                    <th>Present First Half</th>
                                                    <th>Present Second Half</th>
													<th>OD /On Duty</th>
                                                    <th>Late-In/AR</th>
													<th>SHRTL</th>
													<th>Leave</th>
													<th>OT/On Tour</th>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php 
                                                    $c=0;
                                                    $count_data = 0;
                                                    $sno=1; 
                                                    $odcnt=0;
                                                    $arcnt=0;
                                                    $shrtcnt=0;
                                                    $leavecnt=0;
                                                    $otcnt=0;
                                                    $abcnt=0;
                                                    $prcnt=0;
                                                    $ltcnt=0;
                                                    if(sizeof($daily_attendance) > 0 ){
                                                    foreach($daily_attendance as $key=> $da_attend){ 
                                                        $max_date='';
                                                        if( ($da_attend['att_punch_time']) != ($da_attend['max_att_punch_time'] )){
                                                            $max_date=$da_attend['max_att_punch_time'];
                                                        }else{
                                                             $max_date='';
                                                        }
                                                        ?>
                                            <tr>
													<td><?php echo $sno; ?></td>
													<td><?php echo $da_attend['state']; ?></td>
                                                    <td><?php echo $da_attend['division']; ?></td>
                                                    <td><?php echo $da_attend['branch']; ?></td>
                                                    <td><?php echo $da_attend['employee_code']; ?></td>
													<td><?php echo $da_attend['name']; ?></td>
													<td><?php echo $da_attend['designation'] ?></td>
													<td><?php echo $da_attend['att_punch_time'] ?></td>
													<td><?php echo $max_date; ?></td>
													<td><?php
													            // echo $da_attend['AB'];
													        if(($da_attend['AB_first'] == 'AB') && ($da_attend['att_punch_time'] >= '09:36:00') && ($da_attend['OD'] =='') && ( $da_attend['OT'] == '') ){
                                                                echo '';
                                                            }elseif(($da_attend['OD'] =='') && ( $da_attend['OT'] == '')){
                                                                echo $da_attend['AB_first']; 
                                                            }
													?></td>
													<td><?php if(($da_attend['OD'] =='') && ( $da_attend['OT'] == '')){ echo $da_attend['AB_second']; } ?></td>
                                                    <td><?php if(($da_attend['OD'] =='') && ( $da_attend['OT'] == '')){ echo $da_attend['PR_first']; } ?></td>
                                                    <td><?php if(($da_attend['OD'] =='') && ( $da_attend['OT'] == '')){ echo $da_attend['PR_second']; } ?></td>
													<td><?php echo $da_attend['OD']; ?></td>
                                                    <td><?php 
                                                              //  echo $da_attend['AR'];
                                                            if(($da_attend['AB'] == 'AB') && ($da_attend['att_punch_time'] >= '09:36:00') && ($da_attend['OD'] =='') && ( $da_attend['OT'] == '')){
                                                                $ltcnt++;
                                                                echo 'LT';
                                                            }else{
                                                                echo $da_attend['AR'];
                                                            }
                                                    ?></td>
													<td><?php echo $da_attend['SHRT']; ?></td>
													<td><?php echo $da_attend['leaves']; ?></td>
													<td><?php echo $da_attend['OT']; ?></td>
                                                  <?php 
                                                    $odcnt += $da_attend['OD_count'];
                                                    $arcnt += $da_attend['AR_count'];
                                                    $shrtcnt += $da_attend['SHRT_count'];
                                                    $leavecnt += $da_attend['leave_count'];
                                                    $otcnt += $da_attend['OT_count'];
                                                    $abcnt += $da_attend['AB_count'];
                                                    $prcnt += $da_attend['PR_count'];
                                                    $count_data = count($daily_attendance);
                                                    $attendate = $da_attend['attendate'];
                                                    $c=$c+1;
                                                    $sno++; 
                                                    ?>
                                            <?php } } ?>
                                            
                                            <?php if($count_data >= $c){  ?>
                                               <!-- <tr> 
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                </tr>
                                                <tr> 
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                </tr> -->
                                                <tr> 
                                                   <td>Current Date :</td>
                                                   <td> <?php echo date("Y-m-d"); ?></td>
                                                   <td>Attendance Date : </td>
                                                   <td><?php echo $attendate; ?></td>
                                                   <td>ABSENT : <?php echo $abcnt; ?></td>
                                                   <td>PRESENT :</td>
                                                   <td> <?php echo $prcnt; ?></td>
                                                   <td></td>
                                                   <td>OT :<?php echo $otcnt; ?></td>
                                                   <td></td>
                                                   <td>AR/Late : <?php echo $arcnt ?></td>
                                                   <td></td>
                                                   <td>SHRTL : <?php echo $shrtcnt; ?></td>
                                                   <td></td>
                                                   <td>Leave : <?php echo $leavecnt; ?></td>
                                                   <td>OD : <?php echo $odcnt; ?></td>
                                                   <td>Total : </td>
                                                   <td><?php echo $odcnt+$arcnt+$shrtcnt+$leavecnt+$otcnt+$abcnt+$prcnt ?></td>
                                                </tr>
                                                <?php } ?>

                                          </tbody>
                                         <?php /*   
                                          <tfooter>
                                                <tr> 
                                                   <td>Current Date :</td>
                                                   <td> <?php echo date("Y-m-d"); ?></td>
                                                   <td>Attendance Date : </td>
                                                   <td><?php echo $attendate; ?></td>
                                                   <td>ABSENT :<?php echo $abcnt; ?></td>
                                                   <td>PRESENT : <?php echo $prcnt; ?></td>
                                                   <td></td>
                                                   <td>OT :<?php echo $otcnt; ?></td>
                                                   <td></td>
                                                   <td>AR/Late :<?php echo $arcnt; ?></td>
                                                   <td></td>
                                                   <td>SHRTL :<?php echo $shrtcnt; ?></td>
                                                   <td></td>
                                                   <td>Leave :<?php echo $leavecnt; ?></td>
                                                   <td>OD :<?php echo $odcnt; ?></td>
                                                   <td>Total :<?php echo $odcnt+$arcnt+$shrtcnt+$leavecnt+$otcnt+$abcnt+$prcnt ?></td>
                                                </tr>
                                            </tfooter>
                                            */ ?>
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>

