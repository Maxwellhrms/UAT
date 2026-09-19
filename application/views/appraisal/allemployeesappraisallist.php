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
								<h3 class="page-title">All Employees Appraisals</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">All Employees Appraisals</li>
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
									<!-- <option value="">Select Category</option> -->
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
                                    date_default_timezone_set('Asia/Kolkata');

                                    $currentYear = date('Y');
                                    $earliest_year = 2026;
                                    $latest_year = date('Y') + 1;

                                    for ($i = $latest_year; $i >= $earliest_year; $i--) {
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($i == $currentYear) ? 'selected="selected"' : ''; ?>>
                                            <?php echo $i; ?>
                                        </option>
                                        <?php
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

                                    // Last month (1 to 12)
                                    $lastMonth = date('n', strtotime('-1 month'));

                                    for($i = 1; $i <= 12; $i++) {

                                        $month = date('F', mktime(0, 0, 0, $i, 10));

                                        $selected = ($i == $lastMonth) ? 'selected' : '';

                                        echo "<option value='$i' $selected>$month</option>";
                                    }
                                    ?>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
							<span class="formerror" id="montherror"></span>
							
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="appstatus" id="appstatus"> 
									<option value="">ALL</option>
                                    <?php foreach($appstatus as $askey => $aspval){ ?>
                                        <option value="<?php echo $askey; ?>" <?php echo ($askey == 'PENDING') ? 'selected' : ''; ?>>
                                            <?php echo $aspval; ?>
                                        </option>
                                    <?php } ?>
								</select>
								<label class="focus-label">Select Status</label>
							</div>
							<span class="formerror" id="appstatuserror"></span>
							
						</div>

                        <div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="appstatustype" id="appstatustype"> 
									<option value="">ALL</option>
									<?php foreach($appstatustype as $astkey => $astval){ 
										echo "<option value=".$astkey." >".$astval."</option>";
									} ?>
								</select>
								<label class="focus-label">Select Type</label>
							</div>
							<span class="formerror" id="appstatustypeerror"></span>
							
						</div>


						<div class="col-sm-6 col-md-3">  
							<button type="button" id="searchemployeefilterdata" class="btn btn-success btn-block" onclick="getallemployeesappraisallistdata()"> Search </button>  
						</div> 

                    </div>

					<!-- /Search Filter -->


					<section class="review-section">
						<div class="row">
							<div class="col-md-12" id="displaydata">
							</div>
						</div>
					</section>


                </div>
				</form>
				<!-- /Page Content -->	

<script>
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

function getallemployeesappraisallistdata(){

    var department = $("#department").val();
    var quecategory = $("#quecategory").val();
    var employees = $("#employees").val();
    var year = $("#year").val();
    var month = $("#month").val();
    var appstatus = $("#appstatus").val();
    var appstatustype = $("#appstatustype").val();

    if(department == "" || department == null){
        alert("Please select department");
        return false;
    }

    if(department != "" && quecategory != "" && year != "" && month != ""){

        var mainurl ='<?php echo base_url() ?>Performanceappraisal/getallemployeesappraisallistdata';

        $.ajax({

            url: mainurl,

            type: 'POST',

            data: {
                department : department,
                quecategory : quecategory,
                employees : employees,
                year : year,
                month : month,
                appstatus : appstatus,
                appstatustype : appstatustype
            },

            success: function (data) {

                $('#displaydata').html(data);

                // Destroy if already initialized
                if ($.fn.DataTable.isDataTable('#appraisalTable')) {
                    $('#appraisalTable').DataTable().destroy();
                }

                // Initialize DataTable
                $('#appraisalTable').DataTable({

                    pageLength:25,

                    responsive:true,

                    dom:'Bfrtip',

                    buttons:[
                        // 'copy',
                        'excel'
                        // 'csv',
                        // 'pdf',
                        // 'print'
                    ]
                });

            }

        });

    }

}


$(document).on("click", ".expandRow", function () {

    var btn = $(this);
    var tr = btn.closest("tr");

    var emp = btn.data("employee");
    var month = btn.data("month");
    var category = btn.data("category");

    if (tr.next().hasClass("details-row")) {
        tr.next().remove();
        btn.html('<i class="fa fa-plus"></i>');
        return;
    }

    $.ajax({
        url: baseurl + "Performanceappraisal/getEmployeeWorkflow",
        type: "POST",
        data: {
            employee: emp,
            month: month,
            category: category
        },
        success: function (html) {

            // Create unique table id
            var tableId = 'childTable_' + Date.now() + '_' + Math.floor(Math.random() * 1000);

            // Replace placeholder in returned HTML
            html = html.replace(/__TABLE_ID__/g, tableId);

            tr.after(html);

            btn.html('<i class="fa fa-minus"></i>');

            $('#' + tableId).DataTable({
                destroy: true,
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                dom: 'Bfrtip',
                buttons: ['excel']
            });

        }
    });

});
</script>