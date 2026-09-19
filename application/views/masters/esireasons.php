<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create ESI Reasons</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">ESI Reasons</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#esi_reason" data-toggle="tab" class="nav-link active" id="esi_reason">ESI REASON</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">

        <!-- ESI Master Tab -->
        <div id="esi_reason" class="pro-overview tab-pane fade show active">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#esi_reason_addnew">Add New</button>
            <div id="esi_reason_addnew" class="collapse">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ENTER ESI REASONS</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="esi_reason_frm">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="esi_reason_cmp_id" id="esi_reason_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="esi_reason_cmp_id_error"></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">ESI Reason Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="esi_reason_name" id="esi_reason_name" class="form-control m-b-20">
                                                    <span class="formerror" id="esi_reason_name_error"></span>

                                            
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">ESI Reason Code</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="esi_reason_code" id="esi_reason_code"  class="form-control m-b-20">
                                                    <span class="formerror" id="esi_reason_code_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">ESI Reason Note</label>
                                                <div class="col-lg-9">
                                                    <textarea type="text" name="esi_reason_note" id="esi_reason_note" class="form-control m-b-20"></textarea>
                                                    <span class="formerror" id="esi_reason_note_error"></span>
                                                </div>
                                            </div>      
                                        </div> 

                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="esi_reason_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Data Tables -->
            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">ESI List</h4>
                        </div>
                        <div class="card-body">	
                            <?php
//print_r($pf_statutory);
//exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Company Name</th>
                                            <th>ESI Reason Name</th> 
                                            <th>Esi Code</th>
                                            <th>Esi Notes</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($esi_reasons as $esi_rsn) {
                                            echo'<tr>';
                                            echo'<td>' . $sno . '</td>';
                                            echo'<td>' . $esi_rsn->mxcp_name . '</td>';                                            
                                            echo'<td>' . $esi_rsn->mxesi_rsn_name . '</td>';
                                            echo'<td>' . $esi_rsn->mxesi_rsn_code . '</td>';
                                            echo'<td>' . $esi_rsn->mxesi_rsn_note . '</td>';
                                            echo'<td>';
                                            echo'<div class="dropdown dropdown-action">';
                                            echo'<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            echo'<div class="dropdown-menu dropdown-menu-right">';
                                            echo'<a class="dropdown-item" href="' . base_url() . 'admin/esi_reason_edit/' . $esi_rsn->mxesi_rsn_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            echo'<a class="dropdown-item deletemodal esi_reason_delete" data-toggle="modal" data-target="#esi_reason_del_tab" data-id="' . $esi_rsn->mxesi_rsn_id . '~' . $esi_rsn->mxcp_name . '~' . $esi_rsn->mxesi_rsn_name . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            echo'</div>';
                                            echo'</div>';
                                            echo'</td>';
                                            echo'</tr>';

                                            $sno++;
                                        }
                                        ?>
<!--                                            <tr>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
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
            </div>
            <!-- Data Tables -->

            <!-- Delete ESI REASON DELETE -->
            <div class="modal custom-modal fade" id="esi_reason_del_tab" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete ESI REASON</h3>
                                <h3 style="color: red" id="esi_rsn_del_comp"></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <input type="hidden" name="esi_rsn_id_hidden" id="esi_rsn_id_hidden">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_esi">Delete</a>
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
            <!-- /Delete ESI Modal -->


        </div>
        <!-- /ESI Master Tab -->


    </div>
</div>
<script>
    var page_type = 1;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/esi_reason.js"></script>
