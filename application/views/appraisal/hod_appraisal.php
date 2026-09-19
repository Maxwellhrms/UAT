<style>
.modal {
padding: 0 !important; // override inline padding-right added from js
}
.modal .modal-dialog {
width: 100%;
max-width: none;
height: 100%;
margin: 0;
}
.modal .modal-content {
height: 100%;
border: 0;
border-radius: 0;
}
.modal .modal-body {
overflow-y: auto;
}
</style>
<!-- Page Wrapper -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Hod Appraisal Deatils</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
					<li class="breadcrumb-item active">Employee Appraisal List</li>
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
					<h4 class="card-title mb-0">Applied Employees Appraisal List</h4>
				</div>
				<div class="card-body">	

					<!-- Search Filter -->
						<form method="post" action="<?php echo base_url() ?>Performanceappraisal/hodappraisaltoemp">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="year" id="year"> 
									<option value="">Select Year</option>
									<?php 
									  $currently_selected = date('Y'); 
									  $earliest_year = 2021; 
									  $latest_year = (date('Y')+1); 
									  foreach ( range( $latest_year, $earliest_year ) as $i ) {
									  	if($userdata['year'] == $i){
									  		$sel = "selected";
									  	}else{
									  		$sel = "";
									  	}
									    echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
									  }
									?>
								</select>
								<label class="focus-label">Select Year</label>
							</div>
							<span class="formerror" id="yearerror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="month" id="month"> 
									<option value="">Select Month</option>
									<?php 
										date_default_timezone_set('Asia/Kolkata');
										for($i=1; $i<=12; $i++){ 
										    $month = date('F', mktime(0, 0, 0, $i, 10)); 
											  	if($userdata['month'] == $i){
											  		$sel = "selected";
											  	}else{
											  		$sel = "";
											  	}
										     ?>
										    <option value="<?php echo $i ?>" <?php echo $sel; ?> ><?php echo $month; ?></option>
										<?php } ?>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
							<span class="formerror" id="montherror"></span>
							
						</div>


						<div class="col-sm-6 col-md-3">  
							<button type="submit" id="searchemployeefilterdata" class="btn btn-success btn-block"> Filter </button>  
						</div> 
                    </div>
						</form>

					<!-- /Search Filter -->

					<div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
							<thead>
								<tr>
								    <th>Sno</th>
									<th>Employee Code</th>
									<th>Name</th>
									<th>Employee Status</th>
									<th>Manager Status</th>
									<th>HOD Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								 $sno = 1; foreach ($managerappraisaltoemp as $key => $value) { 
								 $ym = str_replace("_","-",$value->mxap_assign_year_month);
								 $year = date('Y', strtotime($ym));
								 $month = date('m', strtotime($ym));
									?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php echo $value->mxemp_emp_id ?></td>
									<td><?php echo $value->mxemp_emp_fname .' '. $value->mxemp_emp_lname ?></td>
									<td><?php
									if(!empty($value->mxap_assign_emp_createdtime)){
										echo $value->mxap_assign_emp_createdtime;
									}else{
										echo '<span style="color:red">Pending</span>';
									}  ?></td>
									<td><?php
									if(!empty($value->mxap_assign_manager_createdtime)){
										echo $value->mxap_assign_manager_createdtime;
									}else{
										echo '<span style="color:red">Pending</span>';
									}  ?></td>

									<td><a href='#' onclick="getempprofile('<?php echo $value->mxemp_emp_id ?>','<?php echo $value->mxap_assign_dep ?>', '<?php echo $year ?>', '<?php echo $month ?>')" class='btn' data-toggle='modal' data-target='#add_appraisal'><i class='fa fa-eye'></i></a></td>
								</tr>
								<?php $sno++; } ?>
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
<!-- /Page Wrapper -->


<!-- Add Performance Appraisal Modal -->
<div id="add_appraisal" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Performance Appraisal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="displayempfulldata">
			</div>
		</div>
	</div>
</div>
<!-- /Add Performance Appraisal Modal -->

<script>
	function getempprofile(empid,department,year,months){
	var mainurl ='<?php echo base_url() ?>Performanceappraisal/gethodempfulldetails';
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: {employeeid : empid, department : department, year : year, month : months},
	    success: function (data) {
	    	// console.log(data);
	        $('#displayempfulldata').html(data);
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