			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Create Your Zonal Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Zonal Master</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Zonal Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="processzonaldetails">
                        <input type="hidden" name="id" value="<?php echo $zonaldetails[0]->mxz_id;?>">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Company Name</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="cmpname" id="cmpname">
                                                <option value="">-- Select Company --</option>
                                                <?php foreach ($cmpmaster as $key => $cmpvalue) { 
                                                    if($zonaldetails[0]->mxz_comp_id == $cmpvalue->mxcp_id){
                                                        echo'<option value="'.$cmpvalue->mxcp_id.'" selected>'.$cmpvalue->mxcp_name.'</option>';
                                                    }else{
                                                        echo'<option value="'.$cmpvalue->mxcp_id.'">'.$cmpvalue->mxcp_name.'</option>';
                                                    }
                                                    
                                                 } ?>
                                            </select>
                                            <span class="formerror" id="cmpnameerror"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Division Name</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="divname" id="divname">
                                                <option value="">-- Select Division --</option>
                                                <?php foreach ($divisiondetails as $key => $divvalue) { 
                                                    if($zonaldetails[0]->mxz_div_id == $divvalue->mxd_id){
                                                        echo'<option value="'.$divvalue->mxd_id .'" selected>'.$divvalue->mxd_name.'</option>';
                                                    }else{
                                                        echo'<option value="'.$divvalue->mxd_id .'">'.$divvalue->mxd_name.'</option>';
                                                    
                                                 }} ?>
                                            </select>
                                            <span class="formerror" id="divnameerror"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">zonal Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="zonalname" id="zonalname" value="<?php echo $zonaldetails[0]->mxz_name;?>">
                                        </div>
                                        <span class="formerror" id="zonalnameerror"></span>
                                    </div>
                                </div>
                            </div>                            

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        

    </div>	
			</div>
			<!-- /Main Wrapper -->

<script>
	var dp = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/zonal_master.js"></script>