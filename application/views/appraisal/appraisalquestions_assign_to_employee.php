<style>
	.appraisalTabs .nav-link{
    font-weight:600;
    border-radius:10px;
    margin-right:5px;
}

.appraisalTabs .nav-link.active{
    background:#4F46E5;
    color:#fff;
}

.appraisalTabs .nav-link:not(.active){
    background:#f5f5f5;
    color:#333;
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
								<h3 class="page-title">Assign Appraisal Questions</h3>
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
						<input type="hidden" name="quecategory" id="quecategory" value="1">

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="department" id="department" onchange="getquestiondetails();getemp();"> 
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
								<select class="select select2 displayoptions" style="width: 100%" name="employees" id="employees" onchange="getquestiondetails();"> 
								</select>
								<label class="focus-label">Select Employees</label>
							</div>
							<span class="formerror" id="employeeserror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
						    <div class="form-group form-focus select-focus">
						        <select class="select select2" style="width: 100%" name="financialyear" id="financialyear" onchange="getquestiondetails();">
						            <?php
						            // Starting financial year
						            $startYear = 2026;
						            // Current Year & Month
						            $currentYear  = date('Y');
						            $currentMonth = date('n');
						            // Current Financial Year
						            if($currentMonth >= 4){
						                $currentFYStart = $currentYear;
						            }else{
						                $currentFYStart = $currentYear - 1;
						            }
						            // Auto Generate
						            $endYear = $currentYear + 10;
						            for ($fyStart = $startYear; $fyStart <= $endYear; $fyStart++) {
						                $fyEnd = $fyStart + 1;
						                $value = $fyStart . '-04_' . $fyEnd . '-03';
						                $label = 'April ' . $fyStart . ' To March ' . $fyEnd;
						                // Default Selected
						                $selected = ($fyStart == $currentFYStart) ? 'selected' : '';
						                echo '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
						            }
						            ?>
						        </select>
						        <label class="focus-label">Select Year</label>
						    </div>
						    <span class="formerror" id="financialyearerror"></span>
						</div>
                    </div>

					<!-- /Search Filter -->
					
					<div class="col-md-12 mb-3">

						<ul class="nav nav-pills nav-fill appraisalTabs">

							<li class="nav-item">
								<a href="javascript:void(0)"
								class="nav-link active appraisal-tab"
								data-category="1">
									<i class="fa fa-bullseye"></i>
									KRA
								</a>
							</li>

							<li class="nav-item">
								<a href="javascript:void(0)"
								class="nav-link appraisal-tab"
								data-category="2">
									<i class="fa fa-star"></i>
									KEY COMPETENCIES
								</a>
							</li>

							<li class="nav-item">
								<a href="javascript:void(0)"
								class="nav-link authorization-tab"
								data-category="3">
									<i class="fa fa-user-shield"></i>
									AUTHORIZATIONS
								</a>
							</li>
						</ul>

					</div>


					<div id="displaydata"></div>


                </div>
			</form>
				<!-- /Page Content -->	
<script>
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

    var financialyear = $("#financialyear").val();
    if (financialyear ==  "") {
        $("#financialyear").focus();
        $('#financialyearerror').html("Please Select Financial Year...");
        return false;
    } else {
        $('#financialyearerror').html("");
    }

    
		var mainurl = baseurl + 'Performanceappraisal/saveassignedquestion';
      	var formData = new FormData(this);
    	$.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        async:false,
        success: function (data) {
            if (data == 200) {
                alert('Successfully Please Reload By Your Self (OR) If Want Update You Can Now Only');
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
    var financialyear = $("#financialyear").val();

    if(employees == "" || employees == null){
        return false;
    }

    if(department != "" && quecategory != "" && employees != "" && financialyear != ""){

        $('#displaydata').empty(); // Remove existing HTML

        var mainurl ='<?php echo base_url() ?>Performanceappraisal/filterappraisalquestion_details';

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: {
                department : department,
                quecategory : quecategory,
                employees : employees,
                financialyear : financialyear
            },
            beforeSend:function(){
                $('#displaydata').html(
                    '<div class="text-center p-4">' +
                    '<i class="fa fa-spinner fa-spin"></i> Loading...' +
                    '</div>'
                );
            },
            success: function (data) {
                $('#displaydata').empty();
                $('#displaydata').html(data);
            }
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

// $(document).on('click','.appraisal-tab,.authorization-tab',function(){

//     $('.appraisal-tab,.authorization-tab').removeClass('active');

//     $(this).addClass('active');

//     var category = $(this).data('category');

//     $('#quecategory').val(category);

//     if(category == 3){

//         $('#displaydata').hide().empty();
//         $('#authorizationDiv').show();

//     }else{

//         $('#authorizationDiv').hide();
//         $('#displaydata').show().empty();

//         getquestiondetails();
//     }

// });
$(document).on('click','.appraisal-tab,.authorization-tab',function(){

    $('.appraisal-tab,.authorization-tab')
        .removeClass('active');

    $(this).addClass('active');

    var category = $(this).data('category');

    $('#quecategory').val(category);

    $('#displaydata').empty();

    getquestiondetails();

});
</script>


<script>
    $(document).on('click','#copyAprilToAll',function(){

    var aprilMonth = '';

    $('.month-body').each(function(){

        var month = $(this).data('month');

        if(month.indexOf('_04') !== -1){
            aprilMonth = month;
            return false;
        }
    });

    if(aprilMonth == ''){
        alert('April Month Not Found');
        return false;
    }

    $(".month-body[data-month='"+aprilMonth+"'] tr[data-question]").each(function(){

        var questionid = $(this).data('question');

        var objective = $(this).find('.objective-field').val();
        var assign = $(this).find('.assign-field').val();
        var unit = $(this).find('.unit-field').val();
        var weightage = $(this).find('.weightage-field').val();
        var target = $(this).find('.target-field').val();

        $('.month-body').each(function(){

            var currentMonth = $(this).data('month');

            if(currentMonth != aprilMonth){

                var row = $(this).find(
                    "tr[data-question='"+questionid+"']"
                );

                row.find('.objective-field').val(objective);
                row.find('.assign-field').val(assign);
                row.find('.unit-field').val(unit);
                row.find('.weightage-field').val(weightage);
                row.find('.target-field').val(target);
            }
        });
    });

    alert('April Data Copied To All Months');
});

function calculateMonthWeightage(){

    $('.month-body').each(function(){

        var month = $(this).data('month');

        var total = 0;

        $(this).find('tr[data-question]').each(function(){

            var assign = $(this).find('.assign-field').val();

            if(assign == '1'){

                var weightage = parseFloat(
                    $(this).find('.weightage-field').val()
                );

                if(!isNaN(weightage)){
                    total += weightage;
                }
            }

        });

        var badge = $('.weightage-total[data-month="'+month+'"]');

        badge.html('Weightage : '+total+'%');

        if(total == 100){

            badge.removeClass(
                'badge-success badge-warning badge-danger'
            ).addClass('badge-success');

        }else if(total > 100){

            badge.removeClass(
                'badge-success badge-warning badge-danger'
            ).addClass('badge-danger');

        }else{

            badge.removeClass(
                'badge-success badge-warning badge-danger'
            ).addClass('badge-warning');

        }

    });

}
</script>