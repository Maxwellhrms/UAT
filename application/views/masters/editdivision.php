			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Your Division Master</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Edit Division Master</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Edit Division Master Details</h4>
								</div>
								<div class="card-body">
									<form id="processdvdetails">
										<div class="form-group row">
											<label class="col-form-label col-md-2">Company Name</label>
											<div class="col-md-10">
												<select class="form-control select select2" name="cmpname" id="cmpname">
													<option value="">-- Select Company --</option>
													<?php foreach ($cmpmaster as $key => $cmpvalue) { 
														if($cmpvalue->mxcp_id == $divisiondetails[0]->mxd_comp_id){
															$sel = "selected";
														}else{
															$sel = "";
														}
														?>
														<option value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel ?> ><?php echo $cmpvalue->mxcp_name ?></option>
													<?php } ?>
												</select>
												<span class="formerror" id="cmpnameerror"></span>
											</div>
										</div>
										<input type="hidden" name="id" value="<?php echo $divisiondetails[0]->mxd_id ?>">
										<div class="form-group row">
											<label class="col-form-label col-md-2">Division Name</label>
											<div class="col-md-10">
												<input type="text" class="form-control" name="divname" id="divname" value="<?php echo $divisiondetails[0]->mxd_name ?>">
												<span class="formerror" id="divnameerror"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2">Division Image (If any)</label>
											<div class="col-md-10">
												<input class="form-control" type="file" name="divlogo" id="divlogo">
											</div>
											<h4><?php echo $divisiondetails[0]->mxd_pic ?></h4>
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
	var div = 2;
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/division.js"></script>