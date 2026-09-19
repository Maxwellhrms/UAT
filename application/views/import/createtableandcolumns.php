			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Create Tables and Columns</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Tables and Columns</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
	<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#tb">Register New Create Tables</button>
	<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#cc">Register New Create Columns</button>				
<!-- Table Creation -->						
<div id="tb" class="collapse">
	<br>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Create Tables</h4>
			</div>
			<div class="card-body">
				<form id="createtable">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Table Name:</label>
										<input type="text" name="userdefinedtable" id="userdefinedtable" class="form-control" autocomplete="off">
										<span class="formerror" id="userdefinedtableerror"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Create Table</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<br>

<!-- End Table Creation -->

<!-- Columns Creations -->
<div id="cc" class="collapse">
	<br>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Create Columns</h4>
			</div>
			<div class="card-body">
				<form id="createcolumns">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Table Name:</label>
                                        <select class="form-control select2" name="tablename" id="tablename"  style="width: 100%">
	                                        <option value="">Select Table</option>
	                                        <?php foreach ($tables as $key => $value) { ?>
	                                            <option value="<?php echo $value->tablenames ?>"><?php echo strtoupper(str_replace("maxwell_self_", "", $value->tablenames)); ?></option>
	                                        <?php } ?>
	                                    </select>
	                                    <span class="formerror" id="tablenameerror"></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Column Name:</label>
										<input type="text" name="userdefinedcolumns" id="userdefinedcolumns" class="form-control"  autocomplete="off">
										<span class="formerror" id="userdefinedcolumnserror"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Create Columns</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Columns Creations -->
				</div>
			</div>
			<!-- /Page Wrapper -->

<script>
	$("form#createtable").submit(function (e) {
    e.preventDefault();

		// $(':button[type="submit"]').prop('disabled', true);

    var userdefinedtable = $("#userdefinedtable").val();
    if (userdefinedtable == "") {
        $('#userdefinedtableerror').html("Please Enter Table");
        $("#userdefinedtable").focus();
        $(':button[type="submit"]').prop('disabled', false);
        return false;
    } else {
        $('#userdefinedtableerror').html("");
    }

    var mainurl = baseurl + 'import/savecreatetable';
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            if (data == 200) {
                alert('Successfully');
                window.location.reload();
            }else{
            	$(':button[type="submit"]').prop('disabled', false);
             	alert(data);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
</script>

<script>
	$("form#createcolumns").submit(function (e) {
    e.preventDefault();

		$(':button[type="submit"]').prop('disabled', true);

    var tablename = $("#tablename").val();
    if (tablename == "") {
        $('#tablenameerror').html("Please Select Table");
        $("#tablename").focus();
        $(':button[type="submit"]').prop('disabled', false);
        return false;
    } else {
        $('#tablenameerror').html("");
    }

    var userdefinedcolumns = $("#userdefinedcolumns").val();
    if (userdefinedcolumns == "") {
        $('#userdefinedcolumnserror').html("Please Enter Column Name");
        $("#userdefinedcolumns").focus();
        $(':button[type="submit"]').prop('disabled', false);
        return false;
    } else {
        $('#userdefinedcolumnserror').html("");
    }

    var mainurl = baseurl + 'import/savecreatecolumns';
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            if (data == 200) {
                alert('Successfully');
                window.location.reload();
            }else{
            	$(':button[type="submit"]').prop('disabled', false);
                alert(data);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
</script>