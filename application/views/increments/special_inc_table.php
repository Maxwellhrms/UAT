<div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">SPECIAL INCREAMENT LIST</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Empcode</th>
                                                <th>Company Name</th>
                                                <th>Division Name</th>
                                                <th>State Name</th>
                                                <th>Branch Name</th>
                                                <th>Affect Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            foreach ($special_inc as $spc_inc) {
                                                echo '<tr>';
                                                echo '<td>' . $sno . '</td>';
                                                echo '<td>' . $spc_inc->mxemp_spl_inc_emp_code . '</td>';
                                                echo '<td>' . $spc_inc->mxcp_name . '</td>';
                                                echo '<td>' . $spc_inc->mxd_name . '</td>';
                                                echo '<td>' . $spc_inc->mxst_state . '</td>';
                                                echo '<td>' . $spc_inc->mxb_name . '</td>';
                                                echo '<td>' . $spc_inc->mxemp_spl_inc_affect_dt  . '</td>';
                                                echo '<td>' . $spc_inc->mxemp_spl_inc_amount  . '</td>';
                                                echo '<td>';
                                                echo '<div class="dropdown dropdown-action">';
                                                echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                                echo '<div class="dropdown-menu dropdown-menu-right">';
                                                echo '<a class="dropdown-item" href="' . base_url() . 'admin/bns_statutorymaster_edit/' . $bns_stat->mxbns_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                                echo '<a class="dropdown-item deletemodal bns_delete" data-toggle="modal" data-target="#bns_delete" data-id="' . $bns_stat->mxbns_id . '~' . $bns_stat->mxcp_name . '~' . date('d/m/Y', strtotime($bns_stat->mxbns_affect_from)) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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