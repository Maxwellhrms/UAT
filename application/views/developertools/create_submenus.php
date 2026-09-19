<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Create Sub Menus</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Create New Sub Menus</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Create New Sub Menus</h4>
				</div>
				<div class="card-body">
					<form id="submenudetails">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Menu Type <span class="text-danger">*</span></label>
									<select name="menutype" id="menutype" class="form-control select2" style="width: 100%" onChange="getmenuslist();getsubmenuslist()">
										<option value="">Select Menu Type</option>
										<option value="1">HR ADMIN</option>
										<option value="2">MOBILE APP</option>
									</select>
									<span class="formerror" id="menutypeerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Menu Name <span class="text-danger">*</span></label>
									<select class="form-control select2" name="menuname" id="menuname" autocomplete="off" style="width: 100%" onChange="getsubmenuslist()"></select>
									<span class="formerror" id="menunameerror"></span>
							   </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Sub Menu Name <span class="text-danger">*</span></label>
									<input name="submenuname" id="submenuname" class="form-control" autocomplete="off">
									<span class="formerror" id="submenunameerror"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Sub Menu Link <span class="text-danger">*</span></label>
									<input name="submenulink" id="submenulink" class="form-control" autocomplete="off">
									<span class="formerror" id="submenulinkerror"></span>
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
		
<!-- Data Tables -->

<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Sub Menu List</h4>
			</div>
			<div class="card-body" id="displaysubmenushere">	


			</div>
		</div>
	</div>
</div>
<!-- Data Tables -->

	</div>			
</div>
<!-- /Main Wrapper -->
<script src="<?php echo base_url() ?>assets/js/formsjs/submenu.js"></script>
<script type="text/javascript">
	function getmenuslist(){
  var menutype = $("#menutype").val();
  if(menutype ==""){
    $("#menutype").focus();
    $('#menutypeerror').html("Please Select Menu Type");
    return false;
  }else{$('#menutypeerror').html("");} 

    $.ajax({
        url: baseurl+'developertools/getmenuslist',
        type: 'POST',
        data: {menutype : menutype,submenu : 'Yes'},
        success: function (data) {
          $("#menuname").html(data);
        }
    });
}

function getsubmenuslist(){
  var menutype = $("#menutype").val();
  if(menutype ==""){
    $("#menutype").focus();
    $('#menutypeerror').html("Please Select Menu Type");
    return false;
  }else{$('#menutypeerror').html("");} 

  var menuname = $("#menuname").val();
  if(menuname ==""){
    $("#menuname").focus();
    $('#menunameerror').html("Please Select Menu Name");
    return false;
  }else{$('#menunameerror').html("");} 	

  if(menutype != null && menuname != null){
    $.ajax({
        url: baseurl+'developertools/getsubmenuslist',
        type: 'POST',
        data: {menutype : menutype,menuname : menuname},
        success: function (data) {
          $("#displaysubmenushere").html(data);
	        var table = $('#dataTables-example').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5', footer: true }
                    ],
            });
        }
    });
  }
}

$(document).on("click", ".editmodal", function () {
	var editdetails = $(this).data('id');
	var x = editdetails.split("~",7);
	var menutype = x[0];
	var uniqueid = x[1];
	var menuname = x[2];
	var menuicon = x[3];
	var menuorder = x[4];
	var menustatus = x[5];
	var menuisreport = x[6];

	$(".modal-body #editsubmenuuniqueid").val(uniqueid);
	$(".modal-body #editsubmenutype").val(menutype);
	$(".modal-body #editsubmenulink").val(menuicon);
	$(".modal-body #editsubmenuname").val(menuname);
	$(".modal-body #editsubmenuorder").val(menuorder);
	$(".modal-body #editsubmenustatus").val(menustatus);
	$(".modal-body #editsubmenuisreport").val(menuisreport);
	
	
});

</script>
