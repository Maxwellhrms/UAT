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

			<form id="processapprisalquestions">
					<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Edit Appraisal Questions</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Assign Appraisal Questions</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<div class="row filter-row">

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="quecategory" id="quecategory" onchange="getemp();"> 
									<option value="">Select Category</option>
									<?php foreach($catg as $ckey => $cval){ 
										echo "<option value=".$ckey." >".$cval."</option>";
									} ?>
								</select>
								<label class="focus-label">Select Category</label>
							</div>
							<span class="formerror" id="quecategoryerror"></span>
							
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="department" id="department" onchange="getemp();"> 
									<option value="">Select Department</option>
							        <?php foreach ($depart as $key => $value) {
							            echo "<option value=".$value->mxdpt_id.">".$value->mxdpt_name."</option>";
							        } ?>
								</select>
								<label class="focus-label">Select Department</label>
							</div>
							<span class="formerror" id="departmenterror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2 displayoptions" style="width: 100%" name="employees" id="employees" > 
								</select>
								<label class="focus-label">Select Employees</label>
							</div>
							<span class="formerror" id="employeeserror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="year" id="year"> 
									<option value="">Select Year</option>
									<?php 
									  $currently_selected = date('Y'); 
									  $earliest_year = 2021; 
									  $latest_year = (date('Y')+1); 
									  foreach ( range( $latest_year, $earliest_year ) as $i ) {
									    echo '<option value="'.$i.'">'.$i.'</option>';
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
										    $month = date('F', mktime(0, 0, 0, $i, 10));  ?>
										    <option value="<?php echo $i ?>"><?php echo $month; ?></option>
										<?php } ?>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
							<span class="formerror" id="montherror"></span>
							
						</div>


						<div class="col-sm-6 col-md-3">  
							<button type="button" id="searchemployeefilterdata" class="btn btn-success btn-block" onclick="getquestiondetails()"> Search </button>  
						</div> 

                    </div>

					<!-- /Search Filter -->
					
					<div id="displayappersialquestions"></div>


					<section class="review-section">
<!-- 						<div class="review-header text-center">
							<h3 class="review-title">Professional Goals Achieved for last year</h3>
							<p class="text-muted">Lorem ipsum dollar</p>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-review review-table mb-0">
										<thead>
											<tr>
												<th>#</th>
												<th>Assigned KRA</th>
												<th>Assign</th>
												<th>Objective</th>
												<th>Unit&nbspOf&nbspMeasure</th>
												<th>Weightage Marks %</th>
									            <th>Monthly&nbspTargets</th>
									            <th>View</th>
											</tr>
										</thead>
										<tbody id="displaydata">

								        <tfoot>
								            <tr>
								                <th colspan='7' style='text-align:right'><button type="submit" class="btn btn-success">Save</button>
								                <!-- <a class='btn btn-info' data-toggle='modal' data-target='#assign_new_appraisal' onclick="addnewquestions()" style="color: #fff;">Assign More Questions</a> -->
								                <a class='btn btn-info' onclick="addnewquestions()" style="color: #fff;">Assign More Questions</a>
								            </th>
								                <th></th>
								            </tr>
								        </tfoot>
										</tbody>
									</table>

									<br>
								</div>
							</div>
						</div>
					</section>


                </div>
				</form>
				<!-- /Page Content -->	

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
	function addnewquestions() {
	    var quecategory = $("#quecategory").val();
	    if (quecategory ==  "") {
	        $("#quecategory").focus();
	        $('#quecategoryerror').html("Please Select Category...");
	        return false;
	    } else {
	        $('#quecategoryerror').html("");
	    }

	    var department = $("#department").val();
	    if (department ==  "") {
	        $("#department").focus();
	        $('#departmenterror').html("Please Select Department...");
	        return false;
	    } else {
	        $('#departmenterror').html("");
	    }

	    var employees = $("#employees").val();
	    if (employees ==  "") {
	        $("#employees").focus();
	        $('#employeeserror').html("Please Select Employees...");
	        return false;
	    } else {
	        $('#employeeserror').html("");
	    }

	    var year = $("#year").val();
	    if (year ==  "") {
	        $("#year").focus();
	        $('#yearerror').html("Please Select Year...");
	        return false;
	    } else {
	        $('#yearerror').html("");
	    }

	    var month = $("#month").val();
	    if (month ==  "") {
	        $("#month").focus();
	        $('#montherror').html("Please Select Months...");
	        return false;
	    } else {
	        $('#montherror').html("");
	    }
		var mainurl ='<?php echo base_url() ?>Performanceappraisal/getassignedandunassignedquestion?employeeid='+employees+'&quecategory='+quecategory+'&department='+department+'&year='+year+'&month='+month;
	    	window.location.href = mainurl;
	}
</script>
<script>
	function getempprofile(empid,quecategory,department,year,months){
	var mainurl ='<?php echo base_url() ?>Performanceappraisal/getempfulldetails';
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: {employeeid : empid, quecategory : quecategory, department : department, year : year, month : months},
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
$(document).ready(function(){


	$("form#processapprisalquestions").submit(function (e) {
    e.preventDefault();   
    var quecategory = $("#quecategory").val();
    if (quecategory ==  "") {
        $("#quecategory").focus();
        $('#quecategoryerror').html("Please Select Category...");
        return false;
    } else {
        $('#quecategoryerror').html("");
    }

    var department = $("#department").val();
    if (department ==  "") {
        $("#department").focus();
        $('#departmenterror').html("Please Select Department...");
        return false;
    } else {
        $('#departmenterror').html("");
    }

    var employees = $("#employees").val();
    if (employees ==  "") {
        $("#employees").focus();
        $('#employeeserror').html("Please Select Employees...");
        return false;
    } else {
        $('#employeeserror').html("");
    }

    var year = $("#year").val();
    if (year ==  "") {
        $("#year").focus();
        $('#yearerror').html("Please Select Year...");
        return false;
    } else {
        $('#yearerror').html("");
    }

    var month = $("#month").val();
    if (month ==  "") {
        $("#month").focus();
        $('#montherror').html("Please Select Months...");
        return false;
    } else {
        $('#montherror').html("");
    }

    
		var mainurl = baseurl + 'Performanceappraisal/editsaveassignedquestion';
      	var formData = new FormData(this);
    	$.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        async:false,
        success: function (data) {
            if (data == 200) {
                alert('Successfully Updated');
        	}
        },
        cache: false,
        contentType: false,
        processData: false
    });

  	});
});
function getquestiondetails(){
	var department = $("#department").val();
	var quecategory = $("#quecategory").val();
	var employees = $("#employees").val();
	var year = $("#year").val();
	var month = $("#month").val();
	
	if(employees == "" || employees == null){
		return false;
	}
	if(department != "" && quecategory != "" && year != "" && month != ""){

	var mainurl ='<?php echo base_url() ?>Performanceappraisal/editfilterappraisalquestion_details';
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: {department : department, quecategory : quecategory, employees : employees, year : year, month : month},
	    success: function (data) {
	    	// console.log(data);
	        $('#displaydata').html(data);
	    },
	});

	}else{
		return false;
	}
}

function getemp(){
	var department = $("#department").val();
	var quecategory = $("#quecategory").val();
	if(department != "" && quecategory != ""){
		var mainurl ='<?php echo base_url() ?>Performanceappraisal/getappremployeeslist';
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: {department : department, quecategory : quecategory},
		    success: function (data) {
		        $('.displayoptions').html(data);
		    },
		});
	}	
}
</script>