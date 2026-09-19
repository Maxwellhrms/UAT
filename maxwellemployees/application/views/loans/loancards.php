<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
     <!-- Page Header -->
     <div class="page-header">
      <div class="row">
       <div class="col-sm-12">
        <h3 class="page-title"> <?php echo $title ;?>  </h3>
        <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
         <li class="breadcrumb-item active"> <?php echo $title ;?>  </li>
     </ul>
 </div>
</div>
</div>

<style>

/* ===== EXISTING STYLES (SCOPED) ===== */
.loanemployeewise .loan-card {
    position: relative;
    border-radius: 20px;
    padding: 25px;
    color: #fff;
    min-height: 180px;
    overflow: hidden;
    transition: 0.3s;
}

.loanemployeewise .loan-card:hover {
    transform: translateY(-5px);
}

.loanemployeewise .gradient-blue {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
}

.loanemployeewise .gradient-pink {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
}

/* ===== CARD HEADER ===== */
.loanemployeewise .loan-card-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

/* ===== VIEW BUTTON ===== */
.loanemployeewise .view-btn {
    position: absolute;
    bottom: 15px;
    right: 15px;
    border-radius: 20px;
    font-weight: 600;
    padding: 8px 22px;
    background: #fff;
    color: #000;
    border: none;
}

/* ===== STATUS BADGE ===== */
.loanemployeewise .loan-card-status,
.loanemployeewise #loanStatusBadge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    display: inline-block;
    white-space: nowrap;
}

.loanemployeewise .badge-open {
    background: #17a2b8;
    color: #fff;
}

.loanemployeewise .badge-progress {
    background: #f39c12;
    color: #fff;
}

.loanemployeewise .badge-closed {
    background: #28a745;
    color: #fff;
}

/* ===== TOP DETAILS ===== */
.loanemployeewise .loan-details {
    animation: loanFadeIn 0.4s ease-in-out;
}

@keyframes loanFadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.loanemployeewise .btn-primary {
    background: #0072ff;
    border: none;
}

.loanemployeewise .btn-dark {
    background: #2c2c54;
    border: none;
}

/* ===== SCROLLABLE CARDS ===== */
.loanemployeewise .loan-card-scroll {
    max-height: 420px;
    overflow-y: auto;
    padding-right: 5px;
}

.loanemployeewise .loan-card-scroll::-webkit-scrollbar {
    width: 6px;
}

.loanemployeewise .loan-card-scroll::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

/* ===== EMI PROGRESS ===== */
.loanemployeewise .progress-circle {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: conic-gradient(#00c6ff 0deg, #e6e6e6 0deg);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.loanemployeewise .progress-circle::before {
    content: "";
    position: absolute;
    width: 95px;
    height: 95px;
    background: #fff;
    border-radius: 50%;
}

.loanemployeewise .progress-circle span {
    position: absolute;
    font-weight: bold;
    color: #000;
}

</style>

<div class="loanemployeewise">

<div class="container mt-4">

    <!-- ===== FILTER ===== -->
    <form method="post" id="loanformfilters">

        <div class="row mb-3">

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">

                <div class="form-group form-focus select-focus">

                    <select class="select2 floating"
                        name="loanstatus"
                        id="loanstatus">

                        <option value="ALL">ALL</option>
                        <option value="InProgress">InProgress</option>
                        <option value="Closed">Closed</option>

                    </select>

                    <label class="focus-label">
                        Employees Loan Status
                    </label>

                </div>

            </div>

            <div class="col-md-2">

                <button type="button"
                    id="processloandetails"
                    class="btn btn-success" onclick="getLoansList()">

                    Search

                </button>

            </div>

        </div>

    </form>


<div id="employeeloanslistdisplay">
    
</div>

</div>

</div>
<script>
$(document).ready(function () {

    // select2
    $('.select2').select2({
        width: '100%'
    });

    // default load
    getLoansList();
});
function getLoansList() {

    let loanstatus = $('#loanstatus').val();

    $.ajax({

        url: baseurl+'Employee/getEmployeesLoansList',
        type: "POST",

        data: {
            loanstatus: loanstatus,
        },

        beforeSend: function () {

            $('#processloandetails')
                .html('<i class="fa fa-spinner fa-spin"></i> Loading...')
                .addClass('disabled');

            $('#employeeloanslistdisplay').html(`
                <div class="text-center p-4">
                    <i class="fa fa-spinner fa-spin"></i> Loading Attendance...
                </div>
            `);

        },

        success: function (response) {

            $('#employeeloanslistdisplay').html(response);

        },

        error: function (xhr) {

            console.log(xhr.responseText);

            $('#employeeloanslistdisplay').html(`
                <div class="alert alert-danger">
                    Failed to load attendance data.
                </div>
            `);

        },

        complete: function () {

            $('#processloandetails')
                .html('Search')
                .removeClass('disabled');

        }

    });

}
</script>

