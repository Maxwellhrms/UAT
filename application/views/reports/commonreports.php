<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Common Reports</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
					<li class="breadcrumb-item active">Reports List</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<br>
	<?php
// 		print_r($managerappraisaltoemp);
// 		print_r($userdata['year']);
	 ?>
<!-- Data Tables -->
	<div class="row" style="margin-top: 10px;">
		<div class="col-sm-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Common Reports List</h4>
				</div>
				<div class="card-body">	

					<!-- Search Filter -->
						<form method="post" action="<?php echo base_url() ?>Performanceappraisal/managerappraisaltoemp">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="tables" id="tables" onchange="getcolumns()"> 
									<option value="">Select Table</option>
									<option value="maxwell_employees_info">Employee Info</option>
									<option value="maxwell_emp_trasfers">Employee Transfers</option>
									<option value="maxwell_employees_login">Employee Login</option>
									<option value="maxwell_emp_authorsations">Employee Authorsations</option>
								</select>
								<label class="focus-label">Select Table</label>
							</div>
							<span class="formerror" id="tableserror"></span>
						</div>

						<div class="col-sm-12 col-md-12"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" multiple style="width: 100%" name="columns" id="columns"> 
								</select>
							</div>
							<span class="formerror" id="montherror"></span>
							
						</div>


						<div class="col-sm-2 col-md-2">  
							<button type="button" class="btn btn-success btn-block" onclick="getfulldetails()"> Filter </button>  
						</div> 
                    </div>
						</form>

					<!-- /Search Filter -->
					<br>
					<div id="display_filterdata"></div>
				</div>
			</div>
		</div>
	</div>
<!-- Data Tables -->

</div>
</div>
<!-- /Page Wrapper -->


<script>

	function getcolumns(){
		var table = $("#tables").val();
		var mainurl ='<?php echo base_url() ?>Commonreports/getcolumns';
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: {tablename : table},
		    success: function (data) {
		    	// console.log(data);
		        $('#columns').html(data);
		    },
		});
	}

	function getfulldetails(){
		var table = $("#tables").val();
		if(table == ''){
			alert("Please Select Tables");
			return false;
		}
		var column = $("#columns").val();
		if(column == ''){
			alert("Please Select Columns");
			return false;
		}
		var mainurl ='<?php echo base_url() ?>Commonreports/viewuserselecteddata';
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: {tablename : table, columnnames : column},
		    success: function (data) {
		    	// console.log(data);
		    	$('#display_filterdata').html(data);
	        		var table = $('#dataTables-example').DataTable({
	                    dom: 'Bfrtip',
	                    "destroy": true, //use for reinitialize datatable
	                    lengthChange: false,
	                    buttons: [
	                        { extend: 'excelHtml5', footer: true }
	                    ],
	            });
		    },
		});
	}
	function getempprofile(empid,department,year,months){
	var mainurl ='<?php echo base_url() ?>Performanceappraisal/getmgempfulldetails';
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: {employeeid : empid, department : department, year : year, month : months},
	    success: function (data) {
	    	// console.log(data);
	        $('#display_filterdata').html(data);
        		// var table = $('#kra_datatable').DataTable({
          //           dom: 'Bfrtip',
          //           "destroy": true, //use for reinitialize datatable
          //           lengthChange: false,
          //           buttons: [
          //               { extend: 'excelHtml5', footer: true }
          //           ],
          //   });
	    },
	});
	}
</script>