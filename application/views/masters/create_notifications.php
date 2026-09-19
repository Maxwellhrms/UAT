<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.css">
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Create Notification</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Create New Notification</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
<?php if($this->session->userdata('user_role_add') == 1){ ?>
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Create New Notification</button>
<?php } ?>
<div id="demo" class="collapse">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Create New Notification</h4>
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
									<label class="col-form-label">Notification Title <span class="text-danger">*</span></label>
									<textarea class="form-control" name="notificationtitle" id="notificationtitle"></textarea>
									<span class="formerror" id="notificationtitleerror"></span>
							   </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Attachement:</label>
									<input type="file" name="ntfile" id="ntfile" class="form-control">
									<span class="formerror" id="ntfileerror"></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-form-label">Notification Description <span class="text-danger">*</span></label>
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
				<h4 class="card-title mb-0">Notification List</h4>
			</div>
			<div class="card-body">	

				<div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Department</th>
								<th>Title</th>
								<th>Description</th>
								<th>File</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1; foreach ($displaynotificationmaster as $key => $grvalue) { ?>
							<tr>
								<td><?php echo $sno ?></td>
								<td><?php if($grvalue->mx_ntf_department == '9999'){ echo 'ALL'; }else{ echo $grvalue->mxdpt_name; } ?></td>
								<td><?php echo $grvalue->mx_ntf_title?></td>
								<td><?php $y=substr($grvalue->mx_ntf_tags_desc,0,25) . '...';
    									echo $y; ?></td>
								<td>
									<?php if(isset($grvalue->mx_ntf_file) && !empty($grvalue->mx_ntf_file)){ echo "<a class='link attach-icon' target='_blank' href='".base_url().$grvalue->mx_ntf_file."'><img src='https://maxwelllogistics.net/maxwellhrms/assets/img/attachment.png'></a>";} ?>
								</td>
								<td>
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        	<div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo base_url() ?>admin/editnotification/<?php echo $grvalue->mx_ntf_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
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
<script>var nt = 1;</script>
<script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/formsjs/notification.js"></script>
