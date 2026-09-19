<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Edit Circular</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Edit Circular</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Edit Circular <?php echo $displaycircularmaster[0]->mx_cr_application ?></h4>
				</div>
				<div class="card-body">
					<form id="processholidaydetails">
						<div class="row">
							<div class="col-sm-4" >
							    <label class="col-form-label">Departement  <span class="text-danger">*</span></label>
								<select class="form-group select2" name="departement" id="department" style="width:100%">
									<option value="">Departements</option>
									<option value="9999" <?php  if($displaycircularmaster[0]->mx_cr_department == '9999'){ echo 'selected'; }else{ echo ''; }?>>ALL</option>
								        <?php foreach ($depart as $key => $value) {
								            if($displaycircularmaster[0]->mx_cr_department == $value->mxdpt_id){
								                $dsel = 'selected';
								            }else{
								                $dsel = '';
								            }
								            echo "<option value=".$value->mxdpt_id."  $dsel >".$value->mxdpt_name."</option>";
								        } ?>
								</select>
								<span id="departementerror"></span>
							</div>
							<input type="hidden" name="application_no" value="<?php echo $displaycircularmaster[0]->mx_cr_application ?>">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Circular No <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="circularno" id="circularno" value="<?php echo $displaycircularmaster[0]->mx_cr_no ?>" autocomplete="off">
									<span class="formerror" id="circularnoerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Circular Title <span class="text-danger">*</span></label>
									<textarea class="form-control" name="circulartitle" id="circulartitle"><?php echo $displaycircularmaster[0]->mx_cr_title ?></textarea>
									<span class="formerror" id="circulartitleerror"></span>
							   </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Attachement:</label>
									<input type="file" name="crfile" id="crfile" class="form-control">
									<span class="formerror" id="crfileerror"></span>
									<span><?php if(isset($displaycircularmaster[0]->mx_cr_file) && !empty($displaycircularmaster[0]->mx_cr_file)){ echo "<a class='link attach-icon' target='_blank' href='".base_url().$displaycircularmaster[0]->mx_cr_file."'><img src='https://maxwelllogistics.net/maxwellhrms/assets/img/attachment.png'></a>";} ?></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Circular Description <span class="text-danger">*</span></label>
									<textarea class="form-control summernote" name="desc" id="desc" cols="10" rows="10"><?php echo $displaycircularmaster[0]->mx_cr_tags_desc ?></textarea>
									<span class="formerror" id="descerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Circular Status <span class="text-danger">*</span></label>

									<select class="form-control" name="status" id="status">
										<option value="1" <?php if($displaycircularmaster[0]->mx_cr_status == 1){ echo 'selected';}else{ echo '';} ?>>Active</option>
										<option value="0" <?php if($displaycircularmaster[0]->mx_cr_status == 0){ echo 'selected';}else{ echo '';} ?>>DeActive</option>
											<
										</select>
									<span class="formerror" id="statuserror"></span>
							   </div>
							</div>

							<input type="hidden" name="id" value="<?php echo $displaycircularmaster[0]->mx_cr_id ?>">
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
<script>var cr = 2;</script>
<script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/formsjs/circular.js"></script>
