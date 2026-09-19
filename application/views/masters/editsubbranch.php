			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Your Sub Branch Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Edit Branch Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Sub Branch Master Details</h4>
								</div>
								<div class="card-body">
									<form id="processsubbrndetails">
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Company Name</label>
													<div class="col-lg-9">
												<select class="form-control select2" name="cmpname" id="cmpname">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) {
														if($cmpvalue->mxcp_id == $subbranchdetails[0]->mxsb_comp_id){
															$sel = 'selected';
														}else{
															$sel ='';
														}
													 ?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel ?> ><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="cmpnameerror"></span>
													</div>
												</div>
												<input type="hidden" name="id" value="<?php echo $subbranchdetails[0]->mxsb_id ?>">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Division</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="divname" id="divname">
															<option value="">Select Division</option>
													<?php foreach ($divmaster as $key => $divvalue) { 
														if($divvalue->mxd_id == $subbranchdetails[0]->mxsb_div_id){
															$sel = 'selected';
														}else{
															$sel ='';
														}
													?>
														<option value="<?php echo $divvalue->mxd_id ?>" <?php echo $sel ?> ><?php echo $divvalue->mxd_name ?></option>
													<?php } ?>
														</select>
														<span class="formerror" id="divnameerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Branch</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="brname" id="brname">
															<option value="">Select Branch</option>
															<?php foreach ($branchmaster as $key => $brvalue) { 
														if($brvalue->mxb_id == $subbranchdetails[0]->mxsb_main_branch_id){
															$sel = 'selected';
														}else{
															$sel ='';
														}
																?>
																<option value="<?php echo $brvalue->mxb_id ?>" <?php echo $sel ?> ><?php echo $brvalue->mxb_name ?></option>
															<?php } ?>
														</select>
														<span class="formerror" id="brnameerror"></span>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="subbrname" id="subbrname" value="<?php echo $subbranchdetails[0]->mxsb_name ?>">
														<span class="formerror" id="subbrnameerror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Address</label>
													<div class="col-lg-9">
														<textarea rows="5" cols="5" class="form-control" name="subbraddress" id="subbraddress" placeholder="Enter Address"><?php echo $subbranchdetails[0]->mxsb_address ?></textarea>
														<span class="formerror" id="subbraddresserror"></span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sub Branch Short Code</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="subbrshortcode" id="subbrshortcode" value="<?php echo $subbranchdetails[0]->mxsb_short_code ?>">
													</div>
													<span class="formerror" id="subbrshortcodeerror"></span>
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
	var brn = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/subbranch.js"></script>