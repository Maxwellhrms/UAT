<style>
/* HEADER */
.mgr-header{
	/*display:flex;*/
	justify-content:space-between;
	align-items:center;
	margin-bottom:15px;
}

/*.mgr-filter select{
	border:1px solid #ddd;
	border-radius:8px;
	padding:6px 10px;
	font-size:13px;
}*/

/* STAT CARDS */
.mgr-stat-card{
	background:#fff;
	border-radius:12px;
	padding:14px;
	border:1px solid #eee;
	display:flex;
	align-items:center;
}

.mgr-bar{
	width:4px;
	height:38px;
	border-radius:4px;
	margin-right:10px;
}

.mgr-purple{background:#c084fc;}
.mgr-green{background:#22c55e;}
.mgr-orange{background:#f59e0b;}
.mgr-violet{background:#8b5cf6;}

.mgr-stat-title{font-size:12px;color:#777;}
.mgr-stat-value{font-size:22px;font-weight:600;}

/* MAIN CARD */
.mgr-card{
	background:#fff;
	border-radius:12px;
	padding:16px;
	border:1px solid #eee;
}

/* OVERTIME */
.mgr-ot-scroll{
	max-height:324px;
	overflow-y:auto;
}

.mgr-ot-card{
	background:#f7f8fc;
	border:1px solid #ececf3;
	border-radius:12px;
	padding:14px;
	margin-bottom:12px;
}

.mgr-avatar{
	width:36px;
	height:36px;
	border-radius:50%;
	margin-right:10px;
}

.mgr-small{font-size:12px;color:#8c8c8c;}

.mgr-line{
	height:6px;
	background:#e6e8f0;
	border-radius:4px;
	margin:6px 0;
}

.mgr-short{width:40%;}

.mgr-reject{color:#dc3545;font-size:12px;}
.mgr-approve{color:#7c3aed;font-size:12px;}

/* TIME OFF */
.mgr-time-scroll{
	max-height:420px;
	overflow-y:auto;
}

.mgr-req{
	display:flex;
	justify-content:space-between;
	padding:14px 0;
	border-bottom:1px solid #eee;
}

.mgr-badge{
	padding:4px 10px;
	border-radius:12px;
	font-size:11px;
}

.mgr-medical{background:#e7f7ef;color:#22c55e;}
.mgr-personal{background:#f1ebff;color:#7c3aed;}
.mgr-sick{background:#e6f2ff;color:#3b82f6;}

.mgr-actions{
	display:flex;
	gap:10px;
	margin-top:4px;
}

/* SCROLLBAR */
.mgr-ot-scroll::-webkit-scrollbar,
.mgr-time-scroll::-webkit-scrollbar{
	width:6px;
}
.mgr-ot-scroll::-webkit-scrollbar-thumb,
.mgr-time-scroll::-webkit-scrollbar-thumb{
	background:#ddd;
	border-radius:10px;
}
.mgr-date{
    display: block;
    margin-top: 2px;
}
</style>
<style>
/* CARD */
.cal-card{
    background:#fff;
    border-radius:14px;
    padding:20px;
    border:1px solid #eee;
}

/* HEADER */
.cal-header{
    display:flex;
    align-items:center;
    margin-bottom:15px;
}

.cal-btn{
    width:30px;
    height:30px;
    background:#7c3aed;
    color:#fff;
    border:none;
    border-radius:6px;
    margin-right:8px;
}

/* SCROLL */
.cal-wrapper{
    overflow-x:auto;
}

/* FORCE WIDTH FOR SCROLL */
.cal-table{
    width:max-content;
}

/* GRID (SAME FOR HEADER + ROWS) */
.cal-row{
    display:grid;
    grid-template-columns:220px repeat(30, 60px);
    align-items:center;
    gap:0;
}

/* HEADER ROW */
.cal-head{
    font-size:12px;
    color:#999;
    border-bottom:1px solid #eee;
    padding-bottom:8px;
}

/* NAME COLUMN */
.cal-name{
    display:flex;
    align-items:center;
    height:60px;
}

.cal-avatar{
    width:36px;
    height:36px;
    border-radius:50%;
    margin-right:10px;
}

/* DATA ROW */
.cal-data{
    border-top:1px solid #eee;
    height:60px;
}

/* CELLS */
.cal-day,
.cal-pill{
    width:60px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* DAY */
.cal-day{
    color:#777;
}

/* PILLS */
.cal-pill{
    color:#fff;
}

/* COLORS */
.orange{background:#f59e0b;}
.purple{background:#8b5cf6;}
.green{background:#14b8a6;}

/* CONNECTED */
.start{border-radius:20px 0 0 20px;}
.middle{border-radius:0;}
.end{border-radius:0 20px 20px 0;}
.single{border-radius:20px;}
</style>
<?php #echo '<pre>'; print_r($dashboard['employeeattendance']); exit;?>

<style>
	.cal-card{
    background:#fff;
    border-radius:14px;
    padding:20px;
    border:1px solid #eee;
}

.cal-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.cal-title{
    font-size:20px;
    font-weight:600;
}

.cal-btn{
    width:34px;
    height:34px;
    border:none;
    background:#7c3aed;
    color:#fff;
    border-radius:8px;
}

.cal-wrapper{
    overflow:auto;
    max-height:700px;
}

.cal-table{
    min-width:max-content;
}

/* ROW */
.cal-row{
    display:flex;
}

/* LEFT EMPLOYEE COLUMN */
.cal-name-col{
    width:260px;
    min-width:260px;
    background:#fff;
    position:sticky;
    left:0;
    z-index:5;
    border-right:1px solid #eee;
}

.cal-head-name{
    height:60px;
    display:flex;
    align-items:center;
    padding:0 15px;
    border-bottom:1px solid #eee;
    background:#fafafa;
    font-weight:600;
}

.cal-name{
    min-height:90px;
    display:flex;
    align-items:center;
    padding:10px 15px;
    border-bottom:1px solid #eee;
    background:#fff;
}

.cal-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    object-fit:cover;
    margin-right:10px;
    border:2px solid #f1f1f1;
}

.cal-emp-details{
    overflow:hidden;
}

.emp-name{
    font-size:14px;
    font-weight:600;
    color:#222;
    line-height:18px;
}

.emp-code{
    font-size:12px;
    color:#888;
    margin-top:2px;
}

/* DAYS SECTION */
.cal-days{
    display:flex;
}

.cal-cell{
    width:120px;
    min-width:120px;
    border-right:1px solid #eee;
    border-bottom:1px solid #eee;
    position:relative;
    background:#fff;
}

/* HEADER CELL */
.cal-head{
    background:#fafafa;
    height:60px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    font-size:12px;
    color:#666;
    font-weight:500;
}

.cal-head strong{
    font-size:15px;
    color:#222;
}

/* ATTENDANCE CARD */
.attendance-box{
    height:90px;
    margin:6px;
    border-radius:10px;
    padding:8px;
    color:#fff;
    display:flex;
    flex-direction:column;
    justify-content:center;
    transition:0.2s;
}

.attendance-box:hover{
    transform:scale(1.03);
}

/* STATUS */
.attendance-status{
    font-size:13px;
    font-weight:700;
    text-align:center;
    margin-bottom:5px;
    letter-spacing:0.3px;
}

/* TIME */
.attendance-time{
    font-size:11px;
    line-height:15px;
    text-align:center;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* COLORS */
.green{
    background:#14b8a6;
}

.purple{
    background:#8b5cf6;
}

.orange{
    background:#f59e0b;
}

.red{
    background:#ef4444;
}
.blue{
	background: #0000FF;
}

.default{
    background:#94a3b8;
}

/* WEEKEND */
.weekend{
    background:#91a2a7;
}

/* MOBILE */
@media(max-width:768px){

    .cal-name-col{
        width:190px;
        min-width:190px;
    }

    .cal-cell{
        width:90px;
        min-width:90px;
    }

    .attendance-box{
        height:80px;
        padding:5px;
    }

    .attendance-status{
        font-size:11px;
    }

    .attendance-time{
        font-size:10px;
    }

    .emp-name{
        font-size:13px;
    }
}
</style>
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->

	<div class="container-fluid mt-3">
<!-- HEADER -->
<div class="mgr-header">
	<h5>Monthly Stats</h5>
	<div class="row">
	<!-- Search Filter -->
	<form method="post" id="regulationsleaves">
		<div class="row filter-row">
            <!-- Search Filter -->
            <?php 
            $controller->commonFiltersWithoutForm(array(
                'monthyearfilter' => array('Y', 'monthyear', 'default' => date('m-Y')),
                'manageremployees' => array('Y', 'employecodes'),
                'companyfilter' => 'Y',
                'divisionfilter' => 'Y',
                'statefilter' => 'Y',
                'branchfilter' => 'Y',
            )); 
            ?>
            <!-- Search Filter -->
		   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
				<a class="btn btn-success w-100" id="authempregulationsleaves" type="button" onclick="loadDashboardData()">Search</a>
		   </div>     
	    </div>
    </form>
	<!-- /Search Filter -->
	</div>
</div>

<div class="row">

 <div class="row" id="leavesregulationslistdisplay">
	
</div>



<!-- CALENDAR -->
<!-- CALENDAR -->
<div class="container-fluid mt-4">
	<div id="filterAttendanceList"></div>
</div>
<!-- CALENDAR -->
<!-- CALENDAR -->

</div>

</div>

<script>

$(document).ready(function () {

    // select2
    $('.select2').select2({
        width: '100%'
    });

    // default load
    loadDashboardData();

});


function loadDashboardData() {

    $('#authempregulationsleaves')
        .html('<i class="fa fa-spinner fa-spin"></i> Loading...')
        .addClass('disabled');

    // Load first request then second
    getRegulationsLeaves().done(function () {

        getAttendances();

    }).always(function () {

        $('#authempregulationsleaves')
            .html('Search')
            .removeClass('disabled');

    });

}


function getAttendances() {

    let employecodes = $('#employecodes').val();
    let monthyear    = $('#monthyear').val();
    let esi_company_id = $('#esi_company_id').val();
    let esi_div_id = $('#esi_div_id').val();
    let esi_state_id = $('#esi_state_id').val();
    let esi_branch_id = $('#esi_branch_id').val();

    return $.ajax({

        url: baseurl + 'Employee/getassignedemployeesassignedtomanagerattendanceList',
        type: "POST",

        data: {
            employecodes: employecodes,
            monthyear: monthyear,
            esi_company_id: esi_company_id,
            esi_div_id: esi_div_id,
            esi_state_id: esi_state_id,
            esi_branch_id: esi_branch_id
        },

        timeout: 300000,

        beforeSend: function () {

            $('#filterAttendanceList').html(`
                <div class="text-center p-4">
                    <i class="fa fa-spinner fa-spin"></i> Loading Attendance...
                </div>
            `);

        },

        success: function (response) {

            $('#filterAttendanceList').html(response);

        },

        error: function (xhr, status, error) {

            console.log(xhr.responseText);
            console.log(status);
            console.log(error);

            $('#filterAttendanceList').html(`
                <div class="alert alert-danger">
                    Failed to load attendance data.
                </div>
            `);

        }

    });

}


function getRegulationsLeaves() {

    let employecodeslr = $('#employecodes').val();
    let monthyearlr    = $('#monthyear').val();
    let esi_company_id = $('#esi_company_id').val();
    let esi_div_id = $('#esi_div_id').val();
    let esi_state_id = $('#esi_state_id').val();
    let esi_branch_id = $('#esi_branch_id').val();

    return $.ajax({

        url: baseurl + 'Employee/getRegulationsLeavesList',
        type: "POST",

        data: {
            employecodeslr: employecodeslr,
            monthyearlr: monthyearlr,
            esi_company_id: esi_company_id,
            esi_div_id: esi_div_id,
            esi_state_id: esi_state_id,
            esi_branch_id: esi_branch_id
        },

        beforeSend: function () {

            $('#leavesregulationslistdisplay').html(`
                <div class="text-center p-4">
                    <i class="fa fa-spinner fa-spin"></i> Loading Data...
                </div>
            `);

        },

        success: function (response) {

            $('#leavesregulationslistdisplay').html(response);

        },

        error: function (xhr, status, error) {

            console.log(xhr.responseText);
            console.log(status);
            console.log(error);

            $('#leavesregulationslistdisplay').html(`
                <div class="alert alert-danger">
                    Failed to load data.
                </div>
            `);

        }

    });

}

</script>