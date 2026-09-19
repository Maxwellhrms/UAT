<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->

    <div class="container-fluid mt-3">
<!-- HEADER -->
<div class="mgr-header">
    <h5>Detailed Dashboard</h5>
    <div class="row">
    <!-- Search Filter -->
    <form method="post" id="regulationsleaves">
        <div class="row filter-row">
            <!-- Search Filter -->
            <?php 
            $controller->commonFiltersWithoutForm(array(
                'fromdatefilter' => array('Y', 'fromdate', 'default' => date('d-m-Y')),
                'todatefilter' => array('Y', 'todate', 'default' => date('d-m-Y')),
                'manageremployees' => array('Y', 'employecodes'),
                'companyfilter' => 'Y',
                'divisionfilter' => 'Y',
                'statefilter' => 'Y',
                'branchfilter' => 'Y',
                'attendanceSection' => 'Y'
            )); 
            ?>
            <!-- Search Filter -->
           <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                <a class="btn btn-success w-100" id="getdashboarddeatiledsumary" type="button">Search</a>
           </div>     
        </div>
    </form>
    <!-- /Search Filter -->
    </div>
</div>

 <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/detaileddashboard.css' ?>">


<!-- HTML Load Container -->
<div id="detailedListsumary"></div>

<script>
$(document).ready(function(){

    $('#getdashboarddeatiledsumary').on('click', function(e){

        e.preventDefault();

        var companyid   = $('#esi_company_id').val();
        var divisionid  = $('#esi_div_id').val();
        var stateid     = $('#esi_state_id').val();
        var branchid    = $('#esi_branch_id').val();
        var employecode = $('#employecodes').val();
        var fromdate    = $('#fromdate').val();
        var todate      = $('#todate').val();
        var attendanceSection = $('#attendanceSection').val();

        // Validation
        if(fromdate == '' || todate == ''){
            alert('Please select From Date and To Date');
            return false;
        }

        // Parse dd-mm-yyyy format
        function parseDate(dateString){

            if(!dateString){
                return null;
            }

            var parts = dateString.split('-');

            if(parts.length !== 3){
                return null;
            }

            return new Date(
                parseInt(parts[2]), // Year
                parseInt(parts[1]) - 1, // Month
                parseInt(parts[0]) // Day
            );
        }

        let fromDateObj = parseDate(fromdate);
        let toDateObj   = parseDate(todate);

        // Invalid Date Check
        if(!fromDateObj || !toDateObj || isNaN(fromDateObj) || isNaN(toDateObj)){
            alert('Invalid Date Format');
            return false;
        }

        // Same month and year validation
        if(
            fromDateObj.getMonth() !== toDateObj.getMonth() ||
            fromDateObj.getFullYear() !== toDateObj.getFullYear()
        ){
            alert('From Date and To Date should be in the same month');
            return false;
        }

        $.ajax({
            url: baseurl + 'Employee/employeedeatiledsummaryList',
            type: 'POST',
            data: {
                esi_company_id : companyid,
                esi_div_id     : divisionid,
                esi_state_id   : stateid,
                esi_branch_id  : branchid,
                employecode    : employecode,
                fromdate       : fromdate,
                todate         : todate,
                attendanceSection : attendanceSection
            },

            beforeSend:function(){

                $('#detailedListsumary').html(`
                    <div class="text-center p-3">
                        <i class="fa fa-spinner fa-spin"></i> Loading...
                    </div>
                `);

            },

            success:function(response){

                $('#detailedListsumary').html(response);

            },

            error:function(xhr){

                $('#detailedListsumary').html(`
                    <div class="alert alert-danger">
                        Something went wrong
                    </div>
                `);

                console.log(xhr.responseText);

            }
        });

    });

});
</script>
<script>
$(document).ready(function () {
    $('#getdashboarddeatiledsumary').trigger('click');
});
</script>