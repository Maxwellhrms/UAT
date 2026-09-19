<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Create Menus</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Create New Menus</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Create New Menus</h4>
				</div>
				<div class="card-body">
					<form id="menudetails">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Menu Type <span class="text-danger">*</span></label>
									<select name="menutype" id="menutype" class="form-control select2" style="width: 100%" onChange="getmenuslist();">
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
									<input class="form-control" type="text" name="menuname" id="menuname" autocomplete="off">
									<span class="formerror" id="menunameerror"></span>
							   </div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Menu Icons <span class="text-danger">*</span></label>
									<input name="menuicon" id="menuicon" class="form-control" autocomplete="off">
									<span class="formerror" id="menuiconerror"></span>
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
				<h4 class="card-title mb-0">Menu List</h4>
			</div>
			<div class="card-body" id="displaymenushere">	


			</div>
		</div>
	</div>
</div>
<!-- Data Tables -->

	</div>			
</div>
<!-- /Main Wrapper -->
<script>var menu = 1;</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/menu.js"></script>
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
        data: {menutype : menutype,submenu : 'No'},
        success: function (data) {
          $("#displaymenushere").html(data);
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

	$(".modal-body #editmenuuniqueid").val(uniqueid);
	$(".modal-body #editmenutype").val(menutype);
	$(".modal-body #editmenuicon").val(menuicon);
	$(".modal-body #editmenuname").val(menuname);
	$(".modal-body #editmenuorder").val(menuorder);
	$(".modal-body #editmenustatus").val(menustatus);
	$(".modal-body #editmenuisreport").val(menuisreport);
});

</script>
