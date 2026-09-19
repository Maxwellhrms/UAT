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
                            <th>Month & Year</th>
                            <th>Emp Code</th>
                            <th>Emp Name</th>
                            <th>Company Name</th>
                            <th>Divison Name</th>
                            <th>State Name</th>
                            <th>Branch Name</th>
                            <th>Net Salairy</th>
                            <th>Gross Salary</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 1;
                        foreach ($unhold_sal_data as $unhold_sal) {
                            // echo"<pre>";print_r($unhold_sal);exit;
                            echo '<tr>';
                            echo '<td>' . $sno . '</td>';
                            echo '<td>' . $unhold_sal->mxsal_year_month  . '</td>';
                            echo '<td>' . $unhold_sal->mxsal_emp_code  . '</td>';
                            echo '<td>' . $unhold_sal->mxemp_emp_fname. ' '. $unhold_sal->mxemp_emp_lname  . '</td>';
                            echo '<td>' . $unhold_sal->mxcp_name  . '</td>';
                            echo '<td>' . $unhold_sal->mxd_name  . '</td>';
                            echo '<td>' . $unhold_sal->mxcp_state_name   . '</td>';
                            echo '<td>' . $unhold_sal->mxb_name . '</td>';
                            echo '<td>' . $unhold_sal->mxsal_net_sal . '</td>';
                            echo '<td>' . $unhold_sal->mxsal_gross_sal . '</td>';
                            echo '<td>';
                            echo '<div class="dropdown dropdown-action">';
                            echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                            echo '<div class="dropdown-menu dropdown-menu-right">';
                            echo '<a class="dropdown-item unholdmodal unhold_data" data-toggle="modal" data-target="#unhold_data" data-id="' . $unhold_sal->mxsal_id . '~' . $emptype.'"><i class="fa fa-pencil m-r-5"></i> Unhold</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';

                            $sno++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="unhold_data" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Unhold Salary</h3>
                    <p>Are you sure want to Unhold?</p>
                </div>
                <input type="hidden" name="unholdid" id="unholdid">
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processUnholdData">Yes Unhold</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>