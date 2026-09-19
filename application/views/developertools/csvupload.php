<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Upload Csv</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Upload Csv</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Upload Your CSV </h4>
				</div>
				<div class="card-body">
					<form id="csvupload">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">CSV <span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="file" id="file" autocomplete="off">
									<span class="formerror" id="menunameerror"></span>
							   </div>
							</div>

						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
					<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">CSV List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Type</th>
													<th>From Date</th>
													<th>To Date</th>
													<th>Effective Date</th>
													<th>Current Branch</th>
													<th>Transfer Branch</th>
													<th>Department</th>
													<th>Current Designation</th>
													<th>Promoted Designation</th>
													<th>Increment Amount</th>
													<th>Remarks</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												
													<?php foreach ($respdata as $key => $listview) { ?>
													<tr>
													<td><?php echo $listview->mx_employee_id ?></td>
													<td><?php echo $listview->mx_category ?></td>
													<td><?php echo ($listview->mx_fromdate == '0000-00-00') ? "" : $listview->mx_fromdate ?></td>
													<td><?php echo ($listview->mx_todate == '0000-00-00') ? "" : $listview->mx_todate ?></td>
													<td><?php echo ($listview->mx_effectivedate == '0000-00-00') ? "" : $listview->mx_effectivedate ?></td>
													<td><?php echo $listview->mx_current_branch ?></td>
													<td><?php echo $listview->mx_transfer_branch ?></td>
													<td><?php echo $listview->mx_department ?></td>
													<td><?php echo $listview->mx_current_designation ?></td>
													<td><?php echo $listview->mx_promoted_designation ?></td>
													<td><?php echo $listview->mx_increment_amount ?></td>
													<td><?php echo $listview->mx_remarks ?></td>
													<td><button type="button" class="btn btn-danger" onclick="deletecsv('<?php echo $listview->mx_id ?>')">Delete</button></td>
												</tr>
													<?php } ?>
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
		</div>
	</div>
		

	</div>			
</div>
<!-- /Main Wrapper -->
<script>
	$( document ).ready(function() {

$("form#csvupload").submit(function(e) {
e.preventDefault();


mainurl = baseurl+'developertools/processcsvupload';

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
        // 	console.log(data);
            if (data == 200) {
                alert('Successfully');
                setTimeout(function(){
                window.location.reload();
                }, 1000); 
            } else {
            	alert('Failed To Save Please TryAgain later');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
});

function deletecsv(id){
    var r=confirm("Do you want to delete");
  if (r==true){
     $.ajax({
      async: false,
      type: "POST",
      data: {delid:id},
      url: baseurl + 'developertools/deletecsvdata',
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
  }
}
</script>