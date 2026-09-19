<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create PF Reasons</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">PF Reasons</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#pf_reason" data-toggle="tab" class="nav-link active" id="pf_reason_li">PF REASON</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">

        <!-- PF Master Tab -->
        <div id="pf_reason" class="pro-overview tab-pane fade show active">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#pf_reason_addnew">Add New</button>
            <div id="pf_reason_addnew" class="collapse">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ENTER PF REASONS</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="pfreason_frm">
                                    <div class="row">
                                        <div class="col-xl-6">


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <select class="select2 form-control"  data-placeholder="Select Company" name="pf_reason_cmp_id" id="pf_reason_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="pf_reason_cmp_id_error"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">PF Reason Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="pf_reason_name" id="pf_reason_name" class="form-control m-b-20">
                                                    <span class="formerror" id="pf_reason_name_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">PF Reason Code</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="pf_reason_code" id="pf_reason_code" class="form-control m-b-20">
                                                    <span class="formerror" id="pf_reason_code_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">PF Reason Note</label>
                                                <div class="col-lg-9">
                                                    <textarea type="text" name="pf_reason_note" id="pf_reason_note" class="form-control m-b-20"></textarea>
                                                    <span class="formerror" id="pf_reason_note_error"></span>
                                                </div>
                                            </div>      
                                        </div> 
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="pf_submit">Submit</button>
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
                            <h4 class="card-title mb-0">PF List</h4>
                        </div>
                        <div class="card-body">	
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Company Name</th>
                                            <th>PF Reason Name</th>  
                                            <th>Code</th>
                                            <th>Note</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($pf_reasons as $pf_rsn) {
                                            echo'<tr>';
                                            echo'<td>' . $sno . '</td>';
                                            echo'<td>' . $pf_rsn->mxcp_name . '</td>';
                                            echo'<td>' . $pf_rsn->mxpf_rsn_name . '</td>';
                                            echo'<td>' . $pf_rsn->mxpf_rsn_code . '</td>';
                                            echo'<td>' . $pf_rsn->mxpf_rsn_note . '</td>';
                                            echo'<td>';
                                            echo'<div class="dropdown dropdown-action">';
                                            echo'<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            echo'<div class="dropdown-menu dropdown-menu-right">';
                                            if($this->session->userdata('user_role_edit') == 1){
                                            echo'<a class="dropdown-item" href="' . base_url() . 'admin/pf_reason_edit/' . $pf_rsn->mxpf_rsn_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if($this->session->userdata('user_role_delete') == 1){
                                            echo'<a class="dropdown-item deletemodal pf_reason_delete" data-toggle="modal" data-target="#pf_rsn_delete_tab" data-id="' . $pf_rsn->mxpf_rsn_id . '~' . $pf_rsn->mxcp_name . '~'.$pf_rsn->mxpf_rsn_name.'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            }
                                            echo'</div>';
                                            echo'</div>';
                                            echo'</td>';
                                            echo'</tr>';

                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data Tables -->

            <!-- Delete PF Reason -->
            <div class="modal custom-modal fade" id="pf_rsn_delete_tab" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete PF Reason</h3>
                                <h3 style="color: red" id="pf_reason_del_data"></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <input type="hidden" name="pf_reason_id_hidden" id="pf_reason_id_hidden">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_pf_reason">Delete</a>
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
            <!-- /Delete PF Reason -->


        </div>
        <!-- /PF Reason Tab -->


    </div>
</div>
<script>
    var page_type = 1;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pf_reason.js"></script>
