<div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Promotions List</h4>
                            </div>
                            <div class="card-body">
                                <?php // print_r($lwf_statutory);
                                ?>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Emp Code</th>
                                                <!--<th>Start Date</th>-->
                                                <th>Affect Date</th>
                                                <th>To Date</th>
                                                <th>Company Name From</th>
                                                <th>Company Name to</th>
                                                <th>Divison Name From</th>
                                                <th>Divison Name To</th>
                                                <th>State Name From</th>
                                                <th>State Name To</th>
                                                <th>Branch Name From</th>
                                                <th>Branch Name To</th>
                                                <th>Desg From</th>
                                                <th>Desg To</th>
                                                <th>Grade From</th>
                                                <th>Grade To</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($promotion_inc as $prom_inc) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_emp_code  . '</td>';
                                                // echo '<td>' . $prom_inc->mxemp_prm_start_date . '</td>';
                                                echo '<td>' . date("d/m/Y",strtotime($prom_inc->mxemp_prm_affect_dt)) . '</td>';
                                                echo '<td>' . date("d/m/Y",strtotime($prom_inc->mxemp_prm_to_date)) . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_comp_name_from  . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_comp_name_to  . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_div_name_from  . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_div_name_to  . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_state_name_from   . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_state_name_to . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_branch_name_from . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_branch_name_to . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_desg_name_from  . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_desg_name_to   . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_grade_name_from . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_grade_name_to . '</td>';
                                                echo '<td>' . $prom_inc->mxemp_prm_amount . '</td>';


                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/lwf_statutorymaster_edit/' . $lwf_stat->mxlwf_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                echo '<a class="dropdown-item deletemodal lwf_delete" data-toggle="modal" data-target="#lwf_delete" data-id="' . $lwf_stat->mxlwf_id . '~' . $lwf_stat->mxcp_name . '~' . date('d/m/Y', strtotime($lwf_stat->mxlwf_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</td>';
                                                echo '</tr>';

                                                $sno++;
                                            }
                                            ?>


                                            <!--                                            <tr>
                                                <td>Test</td>
                                                <td>Test</td>
                                                <td>Test</td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#delete" data-id="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>