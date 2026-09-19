<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="dataTables-example">
		<thead>
			<tr>
				<th>Menu Id</th>
				<th>Menu Name</th>
				<th>Menu Icon</th>
				<th>Menu Status</th>
				<th>Menu Order</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sno = 1; foreach ($displaymenulist as $key => $grvalue) { ?>
			<tr>
				<td><?php echo $grvalue->maxgp_id ?></td>
				<td><?php echo $grvalue->maxgp_name ?></td>
				<td><i style='font-size: x-large;'class='la <?php echo $grvalue->maxgp_icon; ?>'></i></td>
				<td>
					<?php if($grvalue->maxgp_status == 1 ){ echo "Active";} else{ echo 'INActive';} ?>
				</td>
				<td><?php echo $grvalue->maxgp_order ?></td>
				<td>
					<div class="dropdown dropdown-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        	<div class="dropdown-menu dropdown-menu-right">
                                <!-- <a class="dropdown-item" href="<?php echo base_url() ?>admin/editcircular/<?php echo $grvalue->mx_cr_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                <a class="dropdown-item editmodal" data-toggle="modal" data-target="#edit" data-id="<?php echo $userdata['menutype'] .'~'. $grvalue->maxgp_id .'~'. $grvalue->maxgp_name .'~'. $grvalue->maxgp_icon .'~'. $grvalue->maxgp_order .'~'. $grvalue->maxgp_status .'~'. $grvalue->maxgp_is_report ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            </div>
					</div>
				</td>
			</tr>
			<?php $sno++; } ?>
		</tbody>
	</table>
</div>

<!-- Edit Modal -->
<div class="modal custom-modal fade" id="edit" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Edit Menu</h3>
				</div>

						<div class="row">
							<input type="hidden" name="editmenutype" id="editmenutype">
							<input type="hidden" name="editmenuuniqueid" id="editmenuuniqueid">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Menu Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="editmenuname" id="editmenuname" autocomplete="off">
									<span class="formerror" id="editmenunameerror"></span>
							   </div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Menu Icons <span class="text-danger">*</span></label>
									<input name="editmenuicon" id="editmenuicon" class="form-control" autocomplete="off">
									<span class="formerror" id="editmenuiconerror"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Menu Order <span class="text-danger">*</span></label>
									<input name="editmenuorder" id="editmenuorder" class="form-control" autocomplete="off">
									<span class="formerror" id="editmenuordererror"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Menu Status <span class="text-danger">*</span></label>
									<input name="editmenustatus" id="editmenustatus" class="form-control" autocomplete="off">
									<span class="formerror" id="editmenustatuserror"></span>
								</div>
							</div>
							
						    <div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Menu is Report <span class="text-danger">*</span></label>
									<input name="editmenuisreport" id="editmenuisreport" class="form-control" autocomplete="off">
									<span class="formerror" id="editmenuisreporterror"></span>
								</div>
							</div>
						</div>
				<div class="modal-btn edit-action">
					<div class="row">
						<div class="col-6">
							<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="editmainmenudetails">Save</a>
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
<!-- /Delete Department Modal -->
<script>
	$("#editmainmenudetails").click(function () {
    event.preventDefault();

var editmenutype = $("#editmenutype").val();
if(editmenutype ==""){
  $("#editmenutype").focus();
  $('#editmenutypeerror').html("Please Select Menu Type ID");
  return false;
}else{$('#editmenutypeerror').html("");}

var editmenuuniqueid = $("#editmenuuniqueid").val();
if(editmenuuniqueid ==""){
  $("#editmenuuniqueid").focus();
  $('#editmenuuniqueiderror').html("Please Enter Menu Unique ID");
  return false;
}else{$('#editmenuuniqueiderror').html("");}

var editmenuname = $("#editmenuname").val();
if(menuname ==""){
  $("#editmenuname").focus();
  $('#editmenunameerror').html("Please Enter Menu Name");
  return false;
}else{$('#editmenunameerror').html("");}


var editmenuicon = $("#editmenuicon").val();
if(editmenuicon ==""){
  $("#editmenuicon").focus();
  $('#editmenuiconerror').html("Please Enter Menu Icon");
  return false;
}else{$('#editmenuiconerror').html("");}


var editmenuorder = $("#editmenuorder").val();
if(editmenuorder ==""){
  $("#editmenuorder").focus();
  $('#editmenuordererror').html("Please Enter Menu Order");
  return false;
}else{$('#editmenuordererror').html("");}

var editmenustatus = $("#editmenustatus").val();
if(editmenustatus ==""){
  $("#editmenustatus").focus();
  $('#editmenustatuserror').html("Please Enter Menu Status");
  return false;
}else{$('#editmenustatuserror').html("");}

var editmenuisreport = $("#editmenuisreport").val();
if(editmenuisreport ==""){
  $("#editmenuisreport").focus();
  $('#editmenuisreporterror').html("Please Enter Menu Is Report");
  return false;
}else{$('#editmenuisreporterror').html("");}


    $.ajax({
      async: false,
      type: "POST",
      data: { editmenutype: editmenutype, editmenuuniqueid : editmenuuniqueid, editmenuname : editmenuname, editmenuicon : editmenuicon, editmenuorder : editmenuorder, editmenustatus : editmenustatus, editmenuisreport : editmenuisreport},
      url: baseurl + 'developertools/editsavemenudetails',
      datatype: "html",
      success: function (data) {
        if (data == 200) {
          alert('Success');
          window.location.reload();
        } else {
          alert('Try Again Later');
        }
      }
    });

  });
</script>