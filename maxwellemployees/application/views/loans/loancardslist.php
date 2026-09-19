<!-- ===== TOP LOAN DETAILS ===== -->
<div class="container mt-3">

    <div id="loanDetails" class="loan-details d-none">

        <div class="card p-4 shadow-sm">

            <div class="row align-items-center">

                <!-- LEFT -->
                <div class="col-md-4 mb-3">

                    <div class="d-flex align-items-center gap-2 mb-2">

                        <h5 id="loanTitle" class="mb-0"></h5>

                        <span id="loanStatusBadge"></span>

                    </div>

                    <small id="loanId"></small>

                    <p class="mt-3">
                        Loan Amount:
                        <b id="loanAmount"></b>
                    </p>

                    <p>
                        EMI Amount:
                        <b id="emiAmount"></b>
                    </p>

                </div>

                <!-- CENTER -->
                <div class="col-md-2 text-center mb-3">

                    <div class="progress-circle">
                        <span id="emiProgress"></span>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-6">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Approved By
                            </p>

                            <h6 id="loanApprovedBy">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Payment Type
                            </p>

                            <h6 id="loanPaymentType">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                EMI Start Date
                            </p>

                            <h6 id="loanStartDate">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                EMI End Date
                            </p>

                            <h6 id="loanEndDate">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Outstanding Amount
                            </p>

                            <h6 id="loanOutstandingAmt">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Current Paid Amount
                            </p>

                            <h6 id="loanPaidAmt">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Advance Paid
                            </p>

                            <h6 id="loanAdvanceAmt">
                                --
                            </h6>

                        </div>

                        <div class="col-md-6 mb-3">

                            <p class="mb-1 text-muted">
                                Mode Of Payment
                            </p>

                            <h6 id="loanModeOfPayment">
                                --
                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===== LOAN CARDS ===== -->
<div class="loan-card-scroll">

    <div class="row">

        <?php if(!empty($loanslist)){ ?>

            <?php foreach($loanslist as $key => $loan){ ?>

                <?php

                    // STATUS CLASS
                    if($loan->loanstatus == 'OPEN'){
                        $statusclass = 'badge-open';
                    }elseif($loan->loanstatus == 'IN PROCESS'){
                        $statusclass = 'badge-progress';
                    }else{
                        $statusclass = 'badge-closed';
                    }

                    // CARD COLOR
                    $cardclass = ($key % 2 == 0)
                        ? 'gradient-blue'
                        : 'gradient-pink';

                ?>

                <div class="col-md-4 mb-4">

                    <div class="loan-card <?= $cardclass; ?>">

                        <!-- HEADER -->
                        <div class="loan-card-header">

                            <h6 class="mb-0">
                                Available Amount
                            </h6>

                            <span class="loan-card-status <?= $statusclass; ?>">
                                <?= $loan->loanstatus; ?>
                            </span>

                        </div>

                        <!-- AMOUNT -->
                        <h2>
                            ₹ <?= number_format($loan->loanamountapproved); ?>
                        </h2>

                        <!-- LOAN REASON -->
                        <p>
                            <?= $loan->loanforreason; ?>
                        </p>

                        <!-- LOAN ID -->
                        <small>
                            <?= substr($loan->loanid, 0, 25); ?>
                        </small>

                        <!-- VIEW BUTTON -->
                        <button class="view-btn"
                            onclick='showLoanDetails(<?= json_encode($loan); ?>)'>

                            View

                        </button>

                    </div>

                </div>

            <?php } ?>

        <?php } ?>

    </div>

</div>

<script>

function formatLoanMonth(yearMonth){

    if(!yearMonth){
        return '--';
    }

    let value = yearMonth.toString();

    let year = value.substring(0,4);
    let month = value.substring(4,6);

    let months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    return months[parseInt(month) - 1] + ' ' + year;
}

function showLoanDetails(loan){

    // ===== TITLE =====
    document.getElementById("loanTitle").innerText =
        loan.loanforreason;

    // ===== LOAN ID =====
    document.getElementById("loanId").innerText =
        loan.loanid;

    // ===== LOAN AMOUNT =====
    document.getElementById("loanAmount").innerText =
        '₹ ' + parseFloat(loan.loanamountapproved)
        .toLocaleString('en-IN');

    // ===== EMI AMOUNT =====
    document.getElementById("emiAmount").innerText =
        '₹ ' + parseFloat(loan.loanmonthlyemiamt)
        .toLocaleString('en-IN');

    // ===== EMI PROGRESS =====
    document.getElementById("emiProgress").innerText =
        loan.emisprocessed + "/" +
        loan.loantenuremonths + " EMI";

    // ===== EMI CIRCLE =====
    let percentage =
        (loan.emisprocessed / loan.loantenuremonths) * 360;

    let circle =
        document.querySelector(".progress-circle");

    circle.style.background =
        `conic-gradient(#00c6ff ${percentage}deg, #e6e6e6 0deg)`;

    // ===== STATUS =====
    let statusBadge =
        document.getElementById("loanStatusBadge");

    statusBadge.innerText =
        loan.loanstatus;

    statusBadge.classList.remove(
        "badge-open",
        "badge-progress",
        "badge-closed"
    );

    if(loan.loanstatus == 'OPEN'){

        statusBadge.classList.add("badge-open");

    }else if(loan.loanstatus == 'IN PROCESS'){

        statusBadge.classList.add("badge-progress");

    }else{

        statusBadge.classList.add("badge-closed");
    }

    // ===== EXTRA DETAILS =====
    document.getElementById("loanApprovedBy").innerText =
        loan.loanapproedby;

    document.getElementById("loanPaymentType").innerText =
        loan.loanpaymenttype;

    // ===== FORMATTED EMI DATES =====
    document.getElementById("loanStartDate").innerText =
        formatLoanMonth(loan.loanemistartdate);

    document.getElementById("loanEndDate").innerText =
        formatLoanMonth(loan.loanemienddate);

    document.getElementById("loanOutstandingAmt").innerText =
        '₹ ' + parseFloat(loan.loanoutstandingamt)
        .toLocaleString('en-IN');

    document.getElementById("loanPaidAmt").innerText =
        '₹ ' + parseFloat(loan.loancurrentpaidamt)
        .toLocaleString('en-IN');

    document.getElementById("loanAdvanceAmt").innerText =
        '₹ ' + parseFloat(loan.loanadvancepayamt)
        .toLocaleString('en-IN');

    document.getElementById("loanModeOfPayment").innerText =
        loan.loanmodeofpayment;

    // ===== SHOW DETAILS =====
    document.getElementById("loanDetails")
        .classList.remove("d-none");

    // ===== SCROLL TOP =====
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

}

</script>