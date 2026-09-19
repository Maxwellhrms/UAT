<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">JSON TAGS</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">EMPLOYEE JSON TAGS</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">EMPLOYEE JSON TAGS</h4>
				</div>
				<div class="card-body">
                    <form id="updateconfig">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Employee Code</label>
						<div class="col-lg-3">
							<select class="form-control select2" name="empcode" id="empcode" style="width:100%">
								<option value="">Select Employee Code</option>
								<?php foreach ($empcode as $key21 => $emtype) { ?>
									<option value="<?php echo $emtype->mxemp_emp_id ?>"><?php echo $emtype->mxemp_emp_id .' ( '.$emtype->mxemp_emp_fname.$emtype->mxemp_emp_lname.' )'  ?></option>
								<?php } ?>
							</select>
							<span class="formerror" id="emptypeerror"></span>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Search Details</button>
					</form>
					<br>
					<div id="display_tags_list"></div>
				</div>
			</div>
		</div>
	</div>
	</div>			
</div>
<!-- /Main Wrapper -->
<script>
 $("form#updateconfig").submit(function(e) {
	e.preventDefault();  

	mainurl = baseurl+'developertools/employee_json_list';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
	        $('#display_tags_list').html(data);
	        		var table = $('#employee_json_datatable').removeAttr('width').DataTable({
	                    dom: 'Bfrtip',
	                    // "destroy": true, //use for reinitialize datatable
	                    // // lengthChange: false,
	                    // buttons: [
	                    //     { extend: 'excelHtml5', footer: true }
	                    // ],
	                     buttons: [
							  { 
							    extend : 'excel',
							    exportOptions : {
							      format: {
							        body: function( data, row, col, node ) {
							        	console.log(col)
							          if (col == 3) {
							            return table
							              .cell( {row: row, column: col} )
							              .nodes()
							              .to$()
							              .find(':selected')
							              .text()
							           } else {
							              return data;
							           }
							        }
							      }
							    },
							    
							  }
							],
	                    // scrollX: true,
	                    // scrollCollapse: true,
			            // columnDefs: [
			            //     { width: 200, targets: 2 },
			            //     { width: 200, targets: 3 },
			            //     { width: 200, targets: 5 },
			            //     { width: 600, targets: 10 },
			            //     { width: 600, targets: 11 },
			            //     { width: 600, targets: 12 },
			            // ],
			            // fixedColumns: true
	            });
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});

});	

</script>