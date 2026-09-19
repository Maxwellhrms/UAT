        <div class="tab-content">
            <!-- PF Master Tab -->
            <div id="pf_master" class="pro-overview tab-pane fade show active">
                <!-- Data Tables -->
                <div class="row" >
                    <div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0"><?php echo $dtblleavehist[0]->mxemp_leave_history_short_name; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Date & Time </th>
                                                <th>Accumulate</th>
                                                <th>Detect</th>
                                                <th>Before </th>
                                                <th>After </th>
                                                <th>Type</th>
                                                <th>Created By</th>
                                                <th>Ip</th>
                                               </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $padding='';
                                            $pminus='';
                                            $precrntbal ='';
                                            $sno = 1;
                                            foreach($dtblleavehist as $lehtp){ 
                                                $padding  += $lehtp->mxemp_leave_histroy_present_adding;
                                                $pminus += $lehtp->mxemp_leave_histroy_present_minus;
                                                $precrntbal += $lehtp->mxemp_leave_history_crnt_bal;
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $lehtp->mxemp_leave_history_createdtime . '</td>';
                                                echo '<td>' . $lehtp->mxemp_leave_histroy_present_adding . '</td>';
                                                echo '<td>' . $lehtp->mxemp_leave_histroy_present_minus . '</td>';
                                                echo '<td>' . $lehtp->mxemp_leave_histroy_previous_bal . '</td>';
                                                echo '<td>' . $lehtp->mxemp_leave_history_crnt_bal . '</td>';
                                                echo '<td>' . strtoupper($lehtp->mxemp_leave_history_process_type). '</td>';
                                                echo '<td>' . strtoupper($lehtp->mxemp_leave_history_createdby). '</td>';
                                                echo '<td>' . strtoupper($lehtp->mxemp_leave_history_created_ip). '</td>';
                                                echo '</tr>';
                                                $sno++;
                                           } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $padding; ?></td>
                                            <td><?php echo $pminus; ?></td>
                                            <td>Current - </td>
                                            <td><?php echo ($padding-$pminus); ?> </td>
                                            <td></td>
                                            </tr>
                                           </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Tables -->
            </div>
            <!-- /PF Master Tab -->
		</div>
