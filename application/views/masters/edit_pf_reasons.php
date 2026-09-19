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
            <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#pf_reason_addnew">Add New</button>-->
            <div id="pf_reason_addnew" class="collapse show active">
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
                                                            if ($pf_reasons[0]->mxpf_rsn_cmp_id == $companies->mxcp_id) {
                                                                echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                            } else {
                                                                echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
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
                                                    <input type="text" name="pf_reason_name" id="pf_reason_name" value="<?php echo $pf_reasons[0]->mxpf_rsn_name; ?>" class="form-control m-b-20">
                                                    <input type="hidden" name="pf_reason_id" id="pf_reason_name" value="<?php echo $pf_reasons[0]->mxpf_rsn_id; ?>" class="form-control m-b-20">
                                                    <span class="formerror" id="pf_reason_name_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">PF Reason Code</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="pf_reason_code" id="pf_reason_code" value="<?php echo $pf_reasons[0]->mxpf_rsn_code; ?>" class="form-control m-b-20">
                                                    <span class="formerror" id="pf_reason_code_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">PF Reason Note</label>
                                                <div class="col-lg-9">
                                                    <textarea type="text" name="pf_reason_note" id="pf_reason_note" class="form-control m-b-20"><?php echo $pf_reasons[0]->mxpf_rsn_note; ?></textarea>
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


        </div>
    </div>
</div>

<script>
    var page_type = 2;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/pf_reason.js"></script>
