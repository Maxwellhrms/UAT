<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->

	<div class="container-fluid mt-3">
<!-- HEADER -->
<div class="mgr-header">
	<h5>Monthly Stats</h5>
	<div class="row">
	<!-- Search Filter -->
	<form method="post" id="appraisalList">
		<div class="row filter-row">
            <!-- Search Filter -->
                <?php
                $otherRoles = array_diff($employeerole['roles'], ['EMPLOYEE']);
                $controller->commonFiltersWithoutForm(array_merge(
                    array(
                        'monthyearfilter' => array('Y', 'monthyear', 'default' => date('m-Y')),
                        'appraisalcategory' => array('Y', 'appraisalcategory', 'default' => '1')
                    ),
                    !empty($otherRoles)? array('appraisaltype' => array('Y', 'appraisaltype', 'default' => '1')): array(),
                    !empty($otherRoles)? array('appraisalemployees' => array('Y', 'appraisalemployees')): array()
                ));
                ?>
            <!-- Search Filter -->
		   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
				<a class="btn btn-success w-100" id="employeeappraisalList" type="button" onclick="loadAppraisalListData()">Search</a>
		   </div>     
	    </div>
    </form>
	<!-- /Search Filter -->
	</div>
</div>

<div class="row" id="appraisalListData"></div>

</div>

<script>

$(document).ready(function () {
    loadAppraisalListData();
});

function loadAppraisalListData() {
    $.ajax({
        url: "<?php echo base_url('Employee/AppraisalQuestionsList'); ?>",
        type: "POST",
        data: $("#appraisalList").serialize(),
        beforeSend: function () {
            $("#appraisalListData").html(
                '<div class="col-12 text-center py-5">' +
                '<div class="spinner-border text-primary"></div>' +
                '<p class="mt-2">Loading...</p>' +
                '</div>'
            );
        },
        success: function (response) {
            $("#appraisalListData").html(response);
        },
        error: function () {
            $("#appraisalListData").html(
                '<div class="col-12">' +
                '<div class="alert alert-danger">' +
                'Unable to load data. Please try again.' +
                '</div>' +
                '</div>'
            );
        }
    });
}

</script>