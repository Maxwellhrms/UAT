<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Create Circular</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Create New Circular</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Create New Circular</button>
<?php } ?>
<div id="demo" class="collapse">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Create New Circular</h4>
				</div>
				<div class="card-body">
					<form id="processholidaydetails">
						<div class="row">
							<div class="col-sm-4" >
							    <label class="col-form-label">Departement  <span class="text-danger">*</span></label>
								<select class="form-group select2" name="departement" id="department" style="width:100%">
									<option value="">Departements</option>
									<option value="9999">ALL</option>
								        <?php foreach ($depart as $key => $value) {
								            echo "<option value=".$value->mxdpt_id.">".$value->mxdpt_name."</option>";
								        } ?>
								</select>
								<span id="departementerror"></span>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Circular No <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="circularno" id="circularno" autocomplete="off">
									<span class="formerror" id="circularnoerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Circular Title <span class="text-danger">*</span></label>
									<textarea class="form-control" name="circulartitle" id="circulartitle"></textarea>
									<span class="formerror" id="circulartitleerror"></span>
							   </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Attachement:</label>
									<input type="file" name="crfile" id="crfile" class="form-control">
									<span class="formerror" id="crfileerror"></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Circular Description <span class="text-danger">*</span></label>
									<textarea class="form-control summernote" name="desc" id="desc" cols="10" rows="10"></textarea>
									<span class="formerror" id="descerror"></span>
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
<!-- Data Tables -->

<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Circular List</h4>
			</div>
			<div class="card-body">	

				<div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Application</th>
								<th>Department</th>
								<th>Circular No</th>
								<th>Title</th>
								<th>Description</th>
								<th>File</th>
								<th>Created</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1; foreach ($displaycircularmaster as $key => $grvalue) { ?>
							<tr>
								<td><?php echo $sno ?></td>
								<td><?php echo $grvalue->mx_cr_application ?></td>
								<td><?php if($grvalue->mx_cr_department == '9999'){ echo 'ALL'; }else{ echo $grvalue->mxdpt_name; } ?></td>
								<td><?php echo $grvalue->mx_cr_no ?></td>
								<td><?php echo $grvalue->mx_cr_title?></td>
								<td><?php $y=substr($grvalue->mx_cr_tags_desc,0,25) . '...';
    									echo $y; ?></td>
								<td>
									<?php if(isset($grvalue->mx_cr_file) && !empty($grvalue->mx_cr_file)){ echo "<a class='link attach-icon' target='_blank' href='".base_url().$grvalue->mx_cr_file."'><img src='https://maxwelllogistics.net/maxwellhrms/assets/img/attachment.png'></a>";} ?>
								</td>
								<td><?php echo $grvalue->mx_cr_createdtime ?></td>
								<td>
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        	<div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url() ?>admin/editcircular/<?php echo $grvalue->mx_cr_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            </div>
									</div>
								</td>
							</tr>
							<?php $sno++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Data Tables -->

	</div>			
</div>
<!-- /Main Wrapper -->
<script>var cr = 1;</script>
<script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/formsjs/circular.js"></script>
