<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="dataTables-example">
		<thead>
			<tr>
				<th>Sub Menu Id</th>
				<th>Sub Menu Name</th>
				<th>Sub Menu Link</th>
				<th>Sub Menu Status</th>
				<th>Sub Menu Order</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sno = 1; foreach ($displaymenulist as $key => $grvalue) { ?>
			<tr>
				<td><?php echo $grvalue->maxpg_id ?></td>
				<td><?php echo $grvalue->maxpg_name ?></td>
				<td><?php echo $grvalue->maxpg_link; ?></td>
				<td>
					<?php if($grvalue->maxpg_status == 1 ){ echo "Active";} else{ echo 'INActive';} ?>
				</td>
				<td><?php echo $grvalue->maxpg_order ?></td>
				<td>
					<div class="dropdown dropdown-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        	<div class="dropdown-menu dropdown-menu-right">
                                <!-- <a class="dropdown-item" href="<?php echo base_url() ?>admin/editcircular/<?php echo $grvalue->mx_cr_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                <a class="dropdown-item editmodal" data-toggle="modal" data-target="#edit" data-id="<?php echo $userdata['menutype'] .'~'. $grvalue->maxpg_id .'~'. $grvalue->maxpg_name .'~'. $grvalue->maxpg_link .'~'. $grvalue->maxpg_order .'~'. $grvalue->maxpg_status .'~'. $grvalue->maxpg_is_report ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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
					<h3>Edit Sub Menu</h3>
				</div>

						<div class="row">
							<input type="hidden" name="editsubmenutype" id="editsubmenutype">
							<input type="hidden" name="editsubmenuuniqueid" id="editsubmenuuniqueid">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Sub Menu Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="editsubmenuname" id="editsubmenuname" autocomplete="off">
									<span class="formerror" id="editsubmenunameerror"></span>
							   </div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Sub Menu Link <span class="text-danger">*</span></label>
									<input name="editsubmenulink" id="editsubmenulink" class="form-control" autocomplete="off">
									<span class="formerror" id="editsubmenulinkerror"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Sub Menu Order <span class="text-danger">*</span></label>
									<input name="editsubmenuorder" id="editsubmenuorder" class="form-control" autocomplete="off">
									<span class="formerror" id="editsubmenuordererror"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Sub Menu Status <span class="text-danger">*</span></label>
									<input name="editsubmenustatus" id="editsubmenustatus" class="form-control" autocomplete="off">
									<span class="formerror" id="editsubmenustatuserror"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Move Sub Menu To <span class="text-danger"></span></label>
									<select class="form-control select2" name="mov_menuname" id="mov_menuname" autocomplete="off" style="width: 100%" ></select>
									<span class="formerror" id="move_menunameerror"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-form-label">Sub Menu Is Report <span class="text-danger">*</span></label>
									<input name="editsubmenuisreport" id="editsubmenuisreport" class="form-control" autocomplete="off">
									<span class="formerror" id="editsubmenuisreporterror"></span>
								</div>
							</div>
						</div>
				<div class="modal-btn edit-action">
					<div class="row">
						<div class="col-6">
							<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="editsubmainmenudetails">Save</a>
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
	$("#editsubmainmenudetails").click(function () {
    event.preventDefault();
var mov_menuname = $("#mov_menuname").val();
var editsubmenutype = $("#editsubmenutype").val();
if(editsubmenutype ==""){
  $("#editsubmenutype").focus();
  $('#editsubmenutypeerror').html("Please Select Sub Menu Type ID");
  return false;
}else{$('#editsubmenutypeerror').html("");}

var editsubmenuuniqueid = $("#editsubmenuuniqueid").val();
if(editsubmenuuniqueid ==""){
  $("#editsubmenuuniqueid").focus();
  $('#editsubmenuuniqueiderror').html("Please Enter Sub Menu Unique ID");
  return false;
}else{$('#editsubmenuuniqueiderror').html("");}

var editsubmenuname = $("#editsubmenuname").val();
if(editsubmenuname ==""){
  $("#editsubmenuname").focus();
  $('#editsubmenunameerror').html("Please Enter Sub Menu Name");
  return false;
}else{$('#editsubmenunameerror').html("");}


var editsubmenulink = $("#editsubmenulink").val();
if(editsubmenulink ==""){
  $("#editsubmenulink").focus();
  $('#editsubmenulinkerror').html("Please Enter Sub Menu Link");
  return false;
}else{$('#editsubmenulinkerror').html("");}


var editsubmenuorder = $("#editsubmenuorder").val();
if(editsubmenuorder ==""){
  $("#editsubmenuorder").focus();
  $('#editsubmenuordererror').html("Please Enter Sub Menu Order");
  return false;
}else{$('#editsubmenuordererror').html("");}

var editsubmenustatus = $("#editsubmenustatus").val();
if(editsubmenustatus ==""){
  $("#editsubmenustatus").focus();
  $('#editsubmenustatuserror').html("Please Enter Sub Menu Status");
  return false;
}else{$('#editsubmenustatuserror').html("");}

var editsubmenuisreport = $("#editsubmenuisreport").val();
if(editsubmenuisreport ==""){
  $("#editsubmenuisreport").focus();
  $('#editsubmenuisreporterror').html("Please Enter Sub Menu Is Report");
  return false;
}else{$('#editsubmenuisreporterror').html("");}


    $.ajax({
      async: false,
      type: "POST",
      data: { editsubmenutype: editsubmenutype, editsubmenuuniqueid : editsubmenuuniqueid, editsubmenuname : editsubmenuname, editsubmenulink : editsubmenulink, editsubmenuorder : editsubmenuorder, editsubmenustatus : editsubmenustatus, mov_menuname : mov_menuname, editsubmenuisreport : editsubmenuisreport},
      url: baseurl + 'developertools/editsavesubmenudetails',
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
<script>
	var menutype=<?php echo $menutype;?>;
	var menuname=<?php echo $menuname;?>;
	  $.ajax({
        url: baseurl+'developertools/getmenuslist',
        type: 'POST',
        data: {menutype : menutype,submenu : 'Yes',menuname:menuname},
        success: function (data) {
          $("#mov_menuname").html(data);
        }
    });
</script>