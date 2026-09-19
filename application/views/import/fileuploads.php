			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Import Your Excel Files</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Import Your Excel Files</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
						
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h4 class="card-title mb-0">Import Your Excel Files</h4>
									</div>
									<div class="card-body">
										<form id="fileuploads">
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
																<label>Attachement (xlsx|xls):</label>
																<input type="file" name="uploadFile" id="uploadFile" class="form-control">
																<span class="formerror" id="uploadFileerror"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="display" style="color:red"></div>
											</div>
											<div class="text-right" id="processimport">
												<button type="submit" class="btn btn-primary">Import</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<!-- /Page Wrapper -->

<script>
	$("form#fileuploads").submit(function (e) {
    e.preventDefault();

	//$(':button[type="submit"]').prop('disabled', true);

    var tablename = $("#tablename").val();
    if (tablename == "") {
        $('#tablenameerror').html("Please Select Table");
        $("#tablename").focus();
        $(':button[type="submit"]').prop('disabled', false);
        return false;
    } else {
        $('#tablenameerror').html("");
    }

    var mainurl = baseurl + 'import/saveuploadfile';
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            if (data == 200) {
                alert('Successfully');
                window.location.reload();
            }else{
            	$(':button[type="submit"]').prop('disabled', false);
                $("#display").html(data);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
</script>
