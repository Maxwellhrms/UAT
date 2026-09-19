<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Update ESI Reasons</h3>
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
            <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#esi_reason_addnew">Add New</button>-->
            <div id="esi_reason_addnew" class="collapse show active">
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
                                                            if($esi_reasons[0]->mxesi_rsn_cmp_id == $companies->mxcp_id){
                                                                
                                                            echo"<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                            }else{
                                                                
                                                            echo"<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
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
                                                    <input type="text" name="esi_reason_name" id="esi_reason_name" value="<?php echo $esi_reasons[0]->mxesi_rsn_name; ?>" class="form-control m-b-20">
                                                    <input type="hidden" name="esi_reason_id" id="esi_reason_id" value="<?php echo $esi_reasons[0]->mxesi_rsn_id; ?>" class="form-control m-b-20">
                                                    <span class="formerror" id="esi_reason_name_error"></span>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">ESI Reason Code</label>
                                                <div class="col-lg-9">
                                                    <input type="number" name="esi_reason_code" id="esi_reason_code" value="<?php echo $esi_reasons[0]->mxesi_rsn_code; ?>" class="form-control m-b-20">
                                                    <span class="formerror" id="esi_reason_code_error"></span>
                                                </div>
                                            </div>      
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">ESI Reason Note</label>
                                                <div class="col-lg-9">
                                                    <textarea type="text" name="esi_reason_note" id="esi_reason_note" class="form-control m-b-20"><?php echo $esi_reasons[0]->mxesi_rsn_note; ?></textarea>
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

            

            


        </div>
        <!-- /ESI Master Tab -->


    </div>
</div>
<script>
    var page_type = 2;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/esi_reason.js"></script>
