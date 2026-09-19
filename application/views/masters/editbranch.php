<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Edit Your Branch Master</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
						<li class="breadcrumb-item active">Branch Master</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->


		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Edit Master Details</h4>
					</div>
					<div class="card-body">
						<form id="processbrndetails">
							<div class="row">
								<div class="col-xl-6">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Company Name</label>
										<div class="col-lg-9">
											<select class="form-control select2" name="cmpname" id="cmpname">
												<option value="">-- Select Company --</option>
												<?php foreach ($cmpmaster as $key => $cmpvalue) {
													if ($branchdetails[0]->mxb_comp_id == $cmpvalue->mxcp_id) {
														$sel = 'selected';
													} else {
														$sel = '';
													}
												?>
													<option value="<?php echo $cmpvalue->mxcp_id ?>" <?php echo $sel; ?>><?php echo $cmpvalue->mxcp_name ?></option>
												<?php } ?>
											</select>
											<span class="formerror" id="cmpnameerror"></span>
										</div>
									</div>
									<input type="hidden" name="id" value="<?php echo $branchdetails[0]->mxb_id ?>">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Division</label>
										<div class="col-lg-9">
											<select class="form-control select2" name="divname" id="divname">
												<option value="">Select Division</option>
												<?php foreach ($divmaster as $key => $divvalue) {
													if ($branchdetails[0]->mxb_div_id == $divvalue->mxd_id) {
														$sel = 'selected';
													} else {
														$sel = '';
													}
												?>
													<option value="<?php echo $divvalue->mxd_id ?>" <?php echo $sel; ?>><?php echo $divvalue->mxd_name ?></option>
												<?php } ?>
											</select>
											<span class="formerror" id="divnameerror"></span>
										</div>
									</div>
									<div class="form-group row">
													<label class="col-lg-3 col-form-label">Zonal</label>
													<div class="col-lg-9">
														<select class="form-control select2" name="zonal_id" id="zonal_id">
															<option value="">Select Zonal</option>
															
														</select>
														<span class="formerror" id="zonal_id_error"></span>
													</div>
												</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Company State</label>
										<div class="col-lg-9">
											<select class="form-control select2" name="cmpstate" id="cmpstate">
												<option value="">Select Company State</option>
												<?php foreach ($states as $key => $stvalue) {
													if ($branchdetails[0]->mxb_state_id == $stvalue->mxst_id) {
														$sel = 'selected';
													} else {
														$sel = '';
													}
												?>
													<option value="<?php echo $stvalue->mxst_id . '@~@' . $stvalue->mxst_state ?>" <?php echo $sel; ?>><?php echo $stvalue->mxst_state ?></option>
												<?php } ?>
											</select>
											<span class="formerror" id="cmpstateerror"></span>
										</div>
									</div>
									<div class="form-group row">
													<div class="col-lg-12">
														<div class="form-check form-check-inline">
														<input type="checkbox" name="headoffice" id="headoffice" 
														<?php if ($branchdetails[0]->mxb_is_head_office == 1) {
																													echo 'checked';
																												} else {
																													echo '';
																												} ?> value="1">
															<label class="form-check-label">
																Is Head Office
															</label>
															<span class="formerror" id="headofficeerror"></span>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input zonal_ofc" type="checkbox" name="is_zonal_ofc" id="is_zonal_ofc" 
															<?php if ($branchdetails[0]->mxb_is_zonal_office == 1) {
																													echo 'checked';
																												} else {
																													echo '';
																												} ?> value="1">
															<label class="form-check-label">
																Is Zonal Office
															</label>
															<span class="formerror" id="is_zonal_ofc_error"></span>
														</div>
														
														<div class="form-check form-check-inline">
															<input class="form-check-input area_ofc" type="checkbox" name="is_area_ofc" id="is_area_ofc" <?php if ($branchdetails[0]->mxb_is_area_office == 1) {
																													echo 'checked';
																												} else {
																													echo '';
																												} ?> value="1">
															<label class="form-check-label">
																Is Area office
															</label>
															<span class="formerror" id="is_area_ofc_error"></span>
														</div>
													</div>
												</div>


									

									<div class="form-group row card mb-0">
										<p align="center">Eligibility Criteria</p>
										<div class="radio" align="center">
											<label style="text-align:center; margin: 0 20px 0;">
												<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
												<input type="checkbox" name="esi_eligibility" value="1" <?php if ($branchdetails[0]->mxb_esi_eligibility == 1) {
																											echo 'checked';
																										} else {
																											echo '';
																										} ?>> ESI
											</label>
											<label style="text-align:center; margin: 0 20px 0;">
												<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
												<input type="checkbox" name="lwf_eligibility" value="2" <?php if ($branchdetails[0]->mxb_lwf_eligibility == 1) {
																											echo 'checked';
																										} else {
																											echo '';
																										} ?>> LWF
											</label>
											<label style="text-align:center; margin: 0 20px 0;">
												<!--<a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>-->
												<input type="checkbox" name="pt_eligibility" value="3" <?php if ($branchdetails[0]->mxb_pt_eligibility == 1) {
																											echo 'checked';
																										} else {
																											echo '';
																										} ?>> PT
											</label>
											<!--                                                                                                    <label>
                                                                                                        <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content"><i class="la la-info"></i>Hint</a><br>
                                                                                                        <input type="checkbox" name="employee_cont" value="4" checked> No Rounding
                                                                                                    </label>-->
										</div>
									</div>




								</div>
								<div class="col-xl-6">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Name</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="brname" id="brname" value="<?php echo $branchdetails[0]->mxb_name ?>">
										</div>
										<span class="formerror" id="brnameerror"></span>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Email</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="bremail" id="bremail" value="<?php echo $branchdetails[0]->mxb_bremail ?>">
										</div>
										<span class="formerror" id="bremailerror"></span>
									</div>


									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Address</label>
										<div class="col-lg-9">
											<textarea rows="5" cols="5" class="form-control" name="braddress" id="braddress" placeholder="Enter Address"><?php echo $branchdetails[0]->mxb_address ?></textarea>
										</div>
										<span class="formerror" id="braddresserror"></span>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Short Code</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="brshortcode" id="brshortcode" value="<?php echo $branchdetails[0]->mxb_short_code ?>">
										</div>
										<span class="formerror" id="brshortcodeerror"></span>
									</div>
									
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Latitude</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="brlatitude" id="brlatitude" value="<?php echo $branchdetails[0]->mxb_latitude ?>">
										</div>
										<span class="formerror" id="brlatitudeerror"></span>
									</div>
									
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Longitude</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="brlongitude" id="brlongitude" value="<?php echo $branchdetails[0]->mxb_longitude ?>">
										</div>
										<span class="formerror" id="brlongitudeerror"></span>
									</div>
									
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Branch Radius</label>
										<div class="col-lg-9">
											<input type="text" class="form-control" name="brraduis" id="brraduis" value="<?php echo $branchdetails[0]->mxb_radius ?>">
										</div>
										<span class="formerror" id="brraduiserror"></span>
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

<script>
	var brn = 2;
	var edit_branch_id = "<?php echo $branchdetails[0]->mxb_id; ?>";	
</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/branch.js"></script>
<script>
$(document).ready(function(){
	var selected_cmp_id = '<?php echo $branchdetails[0]->mxb_comp_id ?>';
	var selected_div_id = '<?php echo $branchdetails[0]->mxb_div_id ?>';
	var selected_zone_id = '<?php echo $branchdetails[0]->mxb_zonal_id ?>';
	get_zonal(selected_cmp_id,selected_div_id,selected_zone_id);
});
</script>