<style>
    .filter-box { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e9ecef; }
    .badge-completed { background-color: #d1e7dd; color: #0f5132; }
    .badge-pending { background-color: #fff3cd; color: #664d03; }
    .badge-not-started { background-color: #f8d7da; color: #842029; }
    .custom-badge { padding: 5px 10px; border-radius: 4px; font-size: 0.85em; font-weight: 600; }

    div.dt-buttons { display: inline-block; margin-left: 10px; }
    .dataTables_filter { text-align: right; }
    .view-policy-details-div { display:inline-block; text-align:left; }

    @media (max-width: 767px) {
        body, html { height: auto !important; overflow-x: hidden !important; }
        .page-wrapper { height: auto !important; min-height: 100vh !important; overflow: visible !important; padding-bottom: 150px !important; }
        .page-header h2 { font-size: 1.4rem; text-align: center; margin-bottom: 15px; }

        div.dt-buttons, .dataTables_length, .dataTables_filter { text-align: center; width: 100%; margin: 0 0 10px 0; }
        div.dt-buttons .btn { width: 100%; margin-bottom: 5px; display: block; }

        #policyTable thead { display: none; }
        #policyTable tbody tr {
            display: block; background: #fff; border: 1px solid #e0e0e0;
            border-radius: 8px; margin-bottom: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 0;
        }
        #policyTable tbody td {
            display: flex; justify-content: space-between; align-items: center;
            text-align: right; padding: 12px 15px; border-bottom: 1px solid #f0f0f0;
            width: 100% !important; box-sizing: border-box;
        }
        #policyTable tbody td:last-child { border-bottom: none; }

        #policyTable tbody td:before {
            content: attr(data-label); font-weight: 700; color: #555;
            text-align: left; margin-right: 15px; white-space: nowrap; flex-shrink: 0;
        }

        #policyTable td:nth-of-type(1):before { content: "Employee"; }
        #policyTable td:nth-of-type(2):before { content: "Contact"; }
        #policyTable td:nth-of-type(3):before { content: "Progress"; }
        #policyTable td:nth-of-type(4):before { content: "Last Ack."; }
        #policyTable td:nth-of-type(5):before { content: "Status"; }

        #policyTable td:nth-of-type(6), #policyTable td:nth-of-type(7) { display: none !important; }

        .dataTables_paginate { margin-top: 20px !important; text-align: center !important; display: flex; justify-content: center; flex-wrap: wrap; }
        .dataTables_paginate .pagination .paginate_button a { padding: 4px 8px !important; font-size: 0.8rem !important; }
        .view-policy-details-div { text-align:right !important; }
        .filter-box .col-md-3 + .col-md-3 {margin-top: 15px;}
        #empstatus {margin-top: 5px;}
        label[for="empstatus"],.filter-box div.col-md-3:nth-child(2) label {
            margin-top: 10px;
            display: block;
        }

    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid mt-4">
        <div class="page-header">
            <h2>Employee Policy Acknowledgment Report</h2>
        </div>

        <div class="row">
            <div class="col">
                <div class="filter-box">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3">
                            <label class="fw-bold">Acknowledgment Status:</label>
                            <select id="statusFilter" class="form-select select2 form-control">
                                <option value="">All Progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Pending">Pending</option>
                                <option value="Not Started">Not Started</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="fw-bold employee_lable">Employee Status:</label>
                            <select class="form-control select2" id="empstatus">
                                <option value="ALL">ALL Employees</option>
                                <option value="W">WORKING</option>
                                <option value="N">NOTICE PERIOD</option>
                                <option value="RNP">RESIGNED (With Notice)</option>
                                <option value="RWNP">RESIGNED (Without Notice)</option>
                                <option value="R">RESIGNED (Total)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container-mobile">
            <table id="policyTable" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Contact</th>
                    <th>Progress (Ack/Total)</th>
                    <th>Last Ack. Date</th>
                    <th>Status</th>
                    <th style="display:none;">RawStatus</th> <th style="display:none;">RawNotice</th> </tr>
                </thead>
                <tbody>
                <?php foreach($report as $r): ?>
                    <tr>
                        <td>
                            <div class="view-policy-details-div">
                                <a href="#" class="view-policy-details"
                                   data-emp-id="<?= $r->mxemp_emp_id ?>"
                                   data-emp-name="<?= htmlspecialchars($r->mxemp_emp_fname . ' ' . $r->mxemp_emp_lname) ?>">
                                    <strong><?= $r->mxemp_emp_fname . ' ' . $r->mxemp_emp_lname ?></strong>
                                </a>
                                <div class="text-muted" style="font-size:0.85em;">ID: <?= $r->mxemp_emp_id ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="view-policy-details-div">
                                <?= $r->mxemp_emp_email_id ?><br>
                                <small><?= $r->mxemp_emp_phone_no ?></small>
                            </div>
                        </td>
                        <td>
                            <span><?= $r->ack_count ?> / <?= $r->total_policies ?></span><br>
                            <small class="text-muted"><?= $r->pending_count ?> pending</small>
                        </td>
                        <td>
                            <?= $r->last_ack_date ? date('d M Y', strtotime($r->last_ack_date)) . '<br><small>'.date('h:i A', strtotime($r->last_ack_date)).'</small>' : '-' ?>
                        </td>
                        <td>
                            <?php $badgeClass = ($r->status_label == 'Completed') ? 'badge-completed' : (($r->status_label == 'Pending') ? 'badge-pending' : 'badge-not-started'); ?>
                            <span class="custom-badge <?= $badgeClass ?>"><?= $r->status_label ?></span>
                        </td>
                        <td style="display:none;"><?= $r->mxemp_emp_resignation_status ?></td>
                        <td style="display:none;"><?= $r->mxemp_emp_is_without_notice_period ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="policyDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Policy Status for <span id="employeeName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div id="loadingIndicator" style="text-align:center; padding: 20px; display:none;">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <table class="table table-striped" id="policyBreakdownTable" style="display:none;">
                    <thead><tr><th>Policy Name</th><th>Status</th></tr></thead>
                    <tbody id="policyListBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const isMobile = $(window).width() <= 767;
        const dtDOM = isMobile ?
            "<'row'<'col-12'l><'col-12'B><'col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-12 text-center'i><'col-12'p>>" :
            "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";

        var table = $('#policyTable').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 25,
            "dom": dtDOM,
            buttons: [
                { extend: 'excelHtml5', text: 'Excel', className: 'btn btn-sm btn-default', exportOptions: { columns: [0,1,2,3,4] } },
                { extend: 'pdfHtml5', text: 'PDF', className: 'btn btn-sm btn-default', orientation: 'landscape', exportOptions: { columns: [0,1,2,3,4] } }
            ]
        });

        $('#statusFilter').on('change', function(){
            table.column(4).search($(this).val()).draw();
        });

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var filterVal = $('#empstatus').val();
            if (filterVal === "ALL") return true;

            var rowStatus = data[5]; // Raw Resignation Status column
            var rowNotice = data[6]; // Raw Notice Period bit column

            if (filterVal === "RWNP") {
                return (rowStatus === 'R' && rowNotice === '1');
            } else if (filterVal === "RNP") {
                return (rowStatus === 'R' && rowNotice === '0');
            } else if (filterVal === "R") {
                return (rowStatus === 'R');
            } else {
                return (rowStatus === filterVal);
            }
        });

        $('#empstatus').on('change', function() {
            table.draw();
        });

        $('#policyTable').on('click', '.view-policy-details', function(e) {
            e.preventDefault();
            const empId = $(this).data('emp-id');
            const empName = $(this).data('emp-name');
            $('#policyListBody').empty(); $('#employeeName').text(empName);
            $('#policyBreakdownTable').hide(); $('#loadingIndicator').show();
            var myModal = new bootstrap.Modal(document.getElementById('policyDetailModal'));
            myModal.show();

            $.ajax({
                url: '<?= site_url('admin/get_user_policies_ajax') ?>',
                type: 'POST',
                data: { emp_id: empId },
                dataType: 'json',
                success: function(response) {
                    $('#loadingIndicator').hide();
                    if (response.success && response.policies) {
                        let html = '';
                        response.policies.forEach(p => {
                            let icon = p.status === 'Acknowledged' ? 'fa-check-circle text-success' : 'fa-times-circle text-danger';
                            html += `<tr><td>${p.policy_name}</td><td><i class="fas ${icon} me-2"></i>${p.status}</td></tr>`;
                        });
                        $('#policyListBody').html(html); $('#policyBreakdownTable').show();
                    } else {
                        $('#policyListBody').html('<tr><td colspan="2">No data found.</td></tr>'); $('#policyBreakdownTable').show();
                    }
                }
            });
        });
    });
</script>