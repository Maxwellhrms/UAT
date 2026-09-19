		<!-- Page Wrapper -->
          <div class="page-wrapper">
					
			<!-- Page Content -->
              <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Mobile Permissions</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Mobile User Permissions</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
<form id="processrolesdata">

				<!-- Search Filter -->
				
				<div class="row filter-row">

					<div class="col-sm-6 col-md-3"> 
						<div class="form-group form-focus select-focus">
							<select class="select2 form-control" name="roles" id="roles">
							<option value="">Select Roles</option> 
							<?php foreach ($alluserroles as $key => $value) { ?>
								<option value="<?php echo $value->maxuser_roles_id ?>"><?php echo $value->maxuser_roles_name ?></option>
							<?php } ?>
							</select>
							<label class="focus-label">User Roles</label>
							<span class="formerror" id="roleerror"></span>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">  
						<button type="submit" class="btn btn-success btn-block"> Save </button>  
					</div>
					<div class="col-sm-6 col-md-3"></div>
					<div class="col-sm-3 col-md-3">  
						<a class="btn btn-info text-right" href="#" data-toggle="modal" data-target="#addroles"> Add Roles </a>  
					</div>
        </div>
				
				<!-- Search Filter -->
				<div id="displaymenus"></div>
</form>
              </div>
			<!-- /Page Content -->
</div>
<script type="text/javascript">
  $("#roles").change(function () {
    event.preventDefault();
    var roles = $("#roles").val();
    $.ajax({
      url: baseurl + 'Mobile_Permissions/mobile_getallmenus',
      type: 'POST',
      data: { roleid: roles },
      success: function (data) {
      	// console.log(data);
        $("#displaymenus").html(data);
      },
    });
  });
$("form#processrolesdata").submit(function (e) {
	e.preventDefault();

    var menu = $('input[name="menu[]"]:checked').length;

		if (!menu){
		    alert("Please check at least one Menu To Proceed");
		    return false;
		}

    var submenu = $('.sub_menu_checkbox:checked').length;

		if (!submenu){
		    alert("Please check at least one Submenu");
		    return false;
		}

  mainurl = baseurl + 'Mobile_Permissions/mobile_saverolespermissions';

  var formData = new FormData(this);
  $.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
      if (data == 200) {
        alert('Successfull');
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }else {
        alert('Failed To Save Please TryAgain later');
      }
    },
    cache: false,
    contentType: false,
    processData: false
  });
			});

  // $("#roles").change(function () {
  //   event.preventDefault();
  //   var roles = $("#roles").val();
  //   		if(roles == 4){
  //   			$('.menu_checkbox').trigger('click');
  //   			$('.sub_menu_checkbox').trigger('click');
  //   		}else{
  //   			$(".menu_checkbox").prop("checked", false);
  //   			$(".sub_menu_checkbox").prop("checked", false);
  //   		}
  //   });
		</script>
<div class="modal custom-modal fade" id="addroles" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<div class="modal-body">
<div class="form-header">
	<h3>Add User Roles</h3>
</div>
<div class="col-sm-12 col-md-12">  
	<div class="form-group form-focus">
		<input type="text" class="form-control floating" name="addnewrole" id="addnewrole">
		<label class="focus-label">ADD ROLES</label>
	</div>

</div>
<div class="modal-btn addroles-action">
	<div class="row">
		<div class="col-6">
			<a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processaddnewroles">Save</a>
		</div>
		<div class="col-6">
			<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
		</div>
	</div>

	<div class="row">
		<div class="table-responsive m-t-15">
			<table class="table table-striped custom-table">
				<thead>
					<tr>
						<th class="text-center">Sno</th>
						<th class="text-center">Role</th>
					
						<!-- <th class="text-center">Edit</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $dno = 1;foreach ($alluserroles as $keys => $val) { ?>
					<tr>
						<td class="text-center"><?php echo $dno; ?></td>
						<td class="text-center"><?php echo $val->maxuser_roles_name; ?></td>
						<!-- <td class="text-center"></td> -->
					</tr>
				<?php $dno++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
<script>
  $('#processaddnewroles').click(function (e) {
    var create_new = 0;
  	var update_new = 0;
  	var delete_new = 0;
    var addrolename = $('#addnewrole').val();
    if (addrolename == "") {
      alert("Please Enter Role To Proceed");
      return false;
    }
    if($('input[name="create_new"]').is(':checked')){
    	create_new = 1;
	}
	if($('input[name="update_new"]').is(':checked')){
    	update_new = 1;
	}
	if($('input[name="delete_new"]').is(':checked')){
    	delete_new = 1;
	}
    $.ajax({
      url: baseurl + 'Mobile_Permissions/mobile_addnewroles',
      type: 'POST',
      data: { rolename: addrolename, rolecreate: create_new, roleupdate: update_new, roledelete: delete_new },
      success: function (data) {
      if (data == 200) {
        alert('Successfully Created');
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }else {
        alert('Failed To Save Please TryAgain later');
      }
      },
    });
  });
  
  var respone = '';
  function create(id){
  	var create_new = 0;
  	var createname = 'create_'+id;
    if($('input[name='+createname+']').is(':checked')){
    	create_new = 1;
		}
		var mainurl = "Mobile_Permissions/mobile_updatecreatecheck";
		var res = ajaxfunction(create_new,id,mainurl);
		alert(res);
  }

  function edit(id){
  	var update_new = 0;
  	var updatename = 'update_'+id;
    if($('input[name='+updatename+']').is(':checked')){
    	update_new = 1;
		}
		var mainurl = "Mobile_Permissions/mobile_updateeditcheck";
		var res = ajaxfunction(update_new,id,mainurl);
		alert(res);
  }

  function deleter(id){
  	var delete_new = 0;
  	var deletename = 'delete_'+id;
    if($('input[name='+deletename+']').is(':checked')){
    	delete_new = 1;
		}
		var mainurl = "Mobile_Permissions/mobile_updatedeletecheck";
		var res = ajaxfunction(delete_new,id,mainurl);
		alert(res);
  }

  function ajaxfunction(param,id,mainurl){
    $.ajax({
      url: baseurl + mainurl,
      async: false,
      type: 'POST',
      data: {role: param, roleid: id },
      success: function (data) {
      if (data == 200) {
        respone = 'Successfully Updated';
      }else {
        respone = 'Failed To Update Please TryAgain later';
      }
      },
    });
    return respone;
  }
</script>