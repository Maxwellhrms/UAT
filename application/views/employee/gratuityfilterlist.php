<style>
    .modal-header {background: #3c8dbc; color: #fff;}
    .table-responsive {width: 100%; margin-bottom: 60px !important; overflow-x: auto; overflow-y: visible !important; height: auto !important; -webkit-overflow-scrolling: touch;}
    .locked-bg {background-color: #f4f4f4 !important; font-style: italic; color: #666;}
    .update-btn {padding: 2px 8px; font-size: 12px;}

    .dt-buttons {display: flex !important;flex-direction: column;gap: 10px;margin-bottom: 15px;
        background: transparent !important;width: 100%;
    }

    button.dt-button.btn-warning {background-image: none !important;background-color: #f39c12 !important;
        border: 1px solid #e08e0b !important;color: white !important;height: 34px;
        display: flex;align-items: center;justify-content: center;
    }

    #filterWrapper {display: flex !important;flex-direction: column;gap: 8px;background: transparent !important;
        border: none !important;width: 100%;
    }

    #filterWrapper label {margin: 5px 0 0 0;font-weight: bold;font-size: 13px;color: #333 !important;
        background: transparent !important;
    }

    #filterWrapper input[type="date"] {
        width: 100% !important;
    }

    #clearDates {height: 34px;display: flex;align-items: center;justify-content: center;width: 100%;}
    .dataTables_filter {display: flex;width: 100%;margin-bottom: 15px;}
    .dataTables_filter label { width: 100%; }
    .dataTables_filter input {width: 100% !important;margin-left: 0 !important;height: 34px;}

    .audit-created, .audit-updated { font-size: 12px; color: #888; white-space: nowrap; }

    @media (min-width: 768px) {
        .dt-buttons {flex-direction: row;align-items: center;width: auto;float: left;}
        #filterWrapper {flex-direction: row;align-items: center;width: auto;}
        #filterWrapper input[type="date"] { width: 140px !important; }
        button.dt-button.btn-warning, #clearDates { width: auto !important; padding: 0 15px; }
        .dataTables_filter { width: auto; float: right; justify-content: flex-end; }
        .dataTables_filter label { width: auto; }
        .dataTables_filter input { width: 200px !important; margin-left: 5px !important; }
    }
</style>

<div class="col-md-12 col-sm-12 col-12">
    <div id="filterWrapper" style="display:none; background:none;">
        <label>Filter Created Date — From:</label>
        <input type="date" id="dateFrom" class="form-control input-sm" style="width: 140px; display: inline-block; margin-left: 5px;">

        <label style="margin-left: 10px;">To:</label>
        <input type="date" id="dateTo" class="form-control input-sm" style="width: 140px; display: inline-block; margin-left: 5px;">

        <button type="button" id="clearDates" class="btn btn-xs btn-default" style="margin-left: 8px; padding: 4px 8px;">
            <i class="fa fa-refresh"></i> Clear
        </button>
    </div>

    <div class="table-responsive">
        <table id="empTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Sl.no</th>
                <th>Employee Name</th>
                <th>Employee ID</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Gender</th>
                <th>Branch</th>
                <th>Division</th>
                <th>State</th>
                <th>Gratuity Policy No.</th>
                <th>DOJ Scheme</th>
                <th>LIC Number</th>
                <th>DOB</th>
                <th>Date of Joining</th>
                <th>Nature of Exit</th>
                <th>Years of Service</th>
                <th>Last Drawn Salary</th>
                <th>Basic (Est.)</th>
                <th>Gratuity Amount</th>
                <th>Is Gratuity Applicable?</th>
                <th>Date of Exit</th>
                <th>Reason</th>
                <th class="locked-bg">Gratuity Amount from LIC</th>
                <th class="locked-bg">LIC Voucher No</th>
                <th class="locked-bg">Voucher Attch</th>
                <th class="locked-bg">Cheque Attch</th>
                <th class="locked-bg">Status (Paid/Payable)</th>
                <th class="locked-bg">Gratuity Amount Disbursed from Maxwell</th>
                <th class="locked-bg">Disbursed On</th>
                <th class="locked-bg">Cheque No</th>
                <th class="locked-bg">Post-Exit Contact</th>
                <th class="locked-bg">Property/System Status</th>
                <th>Created At</th>
                <th>Last Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if (!empty($employeelist) && is_array($employeelist)) {
                foreach ($employeelist as $emp) {
                    $eid = $emp->mxemp_emp_id;
                    $actual_doj = $emp->mxemp_emp_date_of_join;
                    $doj_ts = strtotime($actual_doj);

                    if ($doj_ts <= strtotime('2013-01-31')) { $doj_scheme = '2013-02-01'; $scheme_reason = "Joined before Feb 2013. Adjusted to (01-Feb-2013)."; }
                    elseif ($doj_ts > strtotime('2013-02-01') && $doj_ts < strtotime('2015-02-01')) { $doj_scheme = $actual_doj; $scheme_reason = "Joined between 2013-2015. Using actual joining date."; }
                    elseif ($doj_ts >= strtotime('2015-01-31') && $doj_ts <= strtotime('2022-01-31')) { $doj_scheme = '2015-02-01'; $scheme_reason = "Joined between 2015-2022. Adjusted to (01-Feb-2015)."; }
                    elseif ($doj_ts >= strtotime('2022-02-01')) { $doj_scheme = '2022-02-01'; $scheme_reason = "Joined In/after Feb 2022. Adjusted to (01-Feb-2022)."; }
                    else { $doj_scheme = $actual_doj; $scheme_reason = "Standard calculation based on actual DOJ."; }

                    $doj_obj = new DateTime($actual_doj);
                    $relieving_date = !empty($emp->mxemp_emp_resignation_relieving_date) ? $emp->mxemp_emp_resignation_relieving_date : date('Y-m-d');
                    $doe_obj = new DateTime($relieving_date);
                    $interval = $doj_obj->diff($doe_obj);
                    $actual_years = $interval->y;
                    $actual_months = $interval->m;

                    if ($actual_months < 6) { $years_for_formula = $actual_years; $display_yrs = $actual_years . " Years"; }
                    elseif ($actual_months == 6) { $years_for_formula = $actual_years + 0.5; $display_yrs = $actual_years . " Yrs 06 Mths"; }
                    else { $years_for_formula = $actual_years + 1; $display_yrs = ($actual_years + 1) . " (Rounded Up)"; }

                    $basic_salary = ($emp->mxemp_emp_current_salary * $emp->basic_percentage)/100;
                    $gratuity_amount = round(($basic_salary / 26) * 15 * $years_for_formula);
                    $date_of_exit = !empty($emp->mxemp_emp_resignation_relieving_date) ? $emp->mxemp_emp_resignation_relieving_date : "-";


                    // Calculation for Is Gratuity Applicable
                    $doj_obj = new DateTime($actual_doj);
                    $today_date = date('Y-m-d H:i:s');
                    $today_obj = new DateTime($today_date);
                    $grat_applicable_interval = $doj_obj->diff($today_obj);
                    $grat_applicable_years = $interval->y;

                    ?>
                    <tr id="row_<?php echo $eid; ?>">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $emp->mxemp_emp_fname . ' ' . $emp->mxemp_emp_lname; ?></td>
                        <td><?php echo $eid; ?></td>
                        <td><?php echo $emp->mxdpt_name; ?></td>
                        <td><?php echo $emp->mxdesg_name; ?></td>
                        <td><?php echo $emp->mxemp_emp_gender; ?></td>
                        <td><?php echo $emp->mxb_name; ?></td>
                        <td><?php echo $emp->mxd_name; ?></td>
                        <td><?php echo $emp->mxst_state; ?></td>
                        <td><?php echo $emp->mxemp_emp_gratuity; ?></td>
                        <td data-toggle="tooltip" title="<?php echo $scheme_reason; ?>" style="cursor:help; background-color: #fdf5e6;">
                            <i class="fa fa-info-circle text-info" style="font-size: 10px;"></i>
                            <strong><?php echo date('Y-m-d', strtotime($doj_scheme)); ?></strong>
                        </td>
                        <td><?php echo $emp->mxemp_emp_employee_lic_no; ?></td>
                        <td><?php echo $emp->mxemp_emp_date_of_birth; ?></td>
                        <td><?php echo $emp->mxemp_emp_date_of_join; ?></td>
                        <td><?php echo ($emp->mxemp_emp_resignation_status == 'R') ? 'Resignation' : '-'; ?></td>
                        <td><?php echo $display_yrs; ?></td>
                        <td><?php echo number_format($emp->mxemp_emp_current_salary, 2); ?></td>
                        <td><?php echo number_format($basic_salary, 2); ?></td>
                        <td><?php echo number_format($gratuity_amount, 2); ?></td>
                        <td data-toggle="tooltip" title="<?php echo "Gratuity applicable 5 years past Date of Joining"; ?>" style="cursor:help; background-color: #fdf5e6;">
                                <i class="fa fa-info-circle text-info" style="font-size: 10px;"></i>
                            <?php echo ($grat_applicable_years >=5)? "Yes":"No"; ?>
                        </td>
                        <td><?php echo $date_of_exit; ?></td>
                        <td><?php echo $emp->mxemp_emp_resignation_reason; ?></td>

                        <td class="locked-bg"><span id="txt_lic_amt_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_lic_amt) ? $emp->gratuity_lic_amt : '--'; ?></span></td>
                        <td class="locked-bg"><span id="txt_lic_vch_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_lic_vch) ? $emp->gratuity_lic_vch : '--'; ?></span></td>
                        <td class="locked-bg">
                            <span id="txt_vch_doc_<?php echo $eid; ?>">
                                <?php if (!empty($emp->vch_attachment)): ?>Attached
                                    <a href="<?php echo base_url('uploads/employeegratuity/' . $emp->vch_attachment); ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-paperclip"></i></a>
                                <?php else: ?>None<?php endif; ?>
                            </span>
                        </td>
                        <td class="locked-bg">
                            <span id="txt_chq_doc_<?php echo $eid; ?>">
                                <?php if (!empty($emp->chq_attachment)): ?>Attached
                                    <a href="<?php echo base_url('uploads/employeegratuity/' . $emp->chq_attachment); ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-paperclip"></i></a>
                                <?php else: ?>None<?php endif; ?>
                            </span>
                        </td>
                        <td class="locked-bg"><span id="txt_stat_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_status) ? $emp->gratuity_status : 'Payable'; ?></span></td>
                        <td class="locked-bg"><span id="txt_max_disb_amt_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_amt_disb_from_maxwell) ? $emp->gratuity_amt_disb_from_maxwell : '--'; ?></span></td>
                        <td class="locked-bg"><span id="txt_disb_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_disb_on) ? $emp->gratuity_disb_on : '--'; ?></span></td>
                        <td class="locked-bg"><span id="txt_chq_no_<?php echo $eid; ?>"><?php echo isset($emp->gratuity_chq_no) ? $emp->gratuity_chq_no : '--'; ?></span></td>
                        <td class="locked-bg"><span id="txt_cont_<?php echo $eid; ?>"><?php echo isset($emp->post_exit_cont) ? $emp->post_exit_cont : '--'; ?></span></td>
                        <td class="locked-bg"><span id="txt_prop_<?php echo $eid; ?>"><?php echo !empty($emp->prop_return) ? $emp->prop_return : 'Pending'; ?></span></td>

                        <td class="audit-created"><?php echo isset($emp->gratuity_created) ? $emp->gratuity_created : '--'; ?></td>
                        <td class="audit-updated"><?php echo isset($emp->gratuity_updated) ? $emp->gratuity_updated : '--'; ?></td>
                        <td>
                            <button type="button" class="btn btn-success update-btn" onclick="openEntryModal('<?php echo $eid; ?>', '<?php echo $emp->mxemp_emp_fname; ?>')">Update</button>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="entryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details for <span id="modal_emp_name"></span></h4>
            </div>
            <div class="modal-body">
                <form id="popupForm">
                    <input type="hidden" id="modal_eid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Gratuity Amount received from LIC</label>
                            <input type="number" class="form-control" id="in_amt">
                        </div>
                        <div class="col-md-6">
                            <label>LIC Voucher Number</label>
                            <input type="text" class="form-control" id="in_vch">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-6">
                            <label>Voucher Attachment</label>
                            <input type="file" class="form-control" id="in_vch_file" name="vch_file" accept=".jpg,.jpeg,.png,.pdf">
                            <small id="existing_vch" class="text-muted"></small>
                        </div>
                        <div class="col-md-6">
                            <label>Cheque Attachment</label>
                            <input type="file" class="form-control" id="in_chq_file" name="chq_file" accept=".jpg,.jpeg,.png,.pdf">
                            <small id="existing_chq" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label>Status</label>
                            <select class="form-control" id="in_stat">
                                <option value="Payable">Payable</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label>Gratuity Amount Disbursed from Maxwell</label>
                            <input type="number" class="form-control" id="in_max_disb_amt">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-4">
                            <label>Amount Disburesed on</label>
                            <input type="date" class="form-control" id="in_date">
                        </div>
                        <div class="col-md-8">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" id="in_chq">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <label>Company property return and system access removal</label>
                            <textarea class="form-control" id="in_prop"></textarea>
                        </div>
                        <div class="col-md-12" style="margin-top:10px;">
                            <label>Contact details for post-exit communication</label>
                            <textarea class="form-control" id="in_cont"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitPopupData()">Update Table</button>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(document).ready(function () {
        table = $('#empTable').DataTable({
            responsive: true,
            "pageLength": 25,
            "dom": 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-sm btn-warning',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        format: {
                            body: function (data, row, column, node) {
                                if (typeof data === 'string' && data.includes('fa-paperclip')) return 'Attached';
                                return data.replace(/<[^>]*>?/gm, '').trim();
                            }
                        }
                    }
                }
            ]
        });

        $("#filterWrapper").appendTo(".dt-buttons").show();

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var min = $('#dateFrom').val();
            var max = $('#dateTo').val();
            var createdAtStr = data[31] || "";

            if (min === "" && max === "") return true;

            if (createdAtStr === "--" || createdAtStr === "") return false;

            var createdAt = createdAtStr.split(' ')[0];

            if (min !== "" && createdAt < min) return false;
            if (max !== "" && createdAt > max) return false;

            return true;
        });

        $('#dateFrom, #dateTo').on('change', function() {
            table.draw();
        });

        $('#clearDates').on('click', function() {
            $('#dateFrom, #dateTo').val('');
            table.draw();
        });

        $('[data-toggle="tooltip"]').tooltip();
    });

    function openEntryModal(id, name) {
        $('#modal_eid').val(id);
        $('#modal_emp_name').text(name);
        $('#in_amt').val($('#txt_lic_amt_' + id).text().replace('--', '').trim());
        $('#in_vch').val($('#txt_lic_vch_' + id).text().replace('--', '').trim());
        $('#in_max_disb_amt').val($('#txt_max_disb_amt_' + id).text().replace('--', '').trim());
        $('#in_date').val($('#txt_disb_' + id).text().replace('--', '').trim());
        $('#in_chq').val($('#txt_chq_no_' + id).text().replace('--', '').trim());
        $('#in_cont').val($('#txt_cont_' + id).text().replace('--', '').trim());
        $('#in_prop').val($('#txt_prop_' + id).text().replace('Pending', '').trim());
        $('#in_stat').val($('#txt_stat_' + id).text().trim());

        var vchAttached = $('#txt_vch_doc_' + id).text().trim().includes('Attached');
        var chqAttached = $('#txt_chq_doc_' + id).text().trim().includes('Attached');
        $('#existing_vch').html(vchAttached ? '<i class="fa fa-paperclip"></i> File exists' : 'No file');
        $('#existing_chq').html(chqAttached ? '<i class="fa fa-paperclip"></i> File exists' : 'No file');

        $('#in_vch_file, #in_chq_file').val('');
        $('#entryModal').modal('show');
    }

    function submitPopupData() {
        var id = $('#modal_eid').val();
        var $btn = $('.modal-footer .btn-primary');

        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
        function checkFile(inputSelector) {
            var fileInput = $(inputSelector)[0];
            if (fileInput.files.length > 0 && !allowedExtensions.exec(fileInput.files[0].name)) {
                alert('Invalid file type. Only JPG, PNG, and PDF allowed.');
                return false;
            }
            return true;
        }

        if (!checkFile('#in_vch_file') || !checkFile('#in_chq_file')) return false;

        var formData = new FormData();
        formData.append('emp_id', id);
        formData.append('lic_amt', $('#in_amt').val());
        formData.append('maxwell_disb_amt', $('#in_max_disb_amt').val());
        formData.append('lic_vch', $('#in_vch').val());
        formData.append('status', $('#in_stat').val());
        formData.append('disb_date', $('#in_date').val());
        formData.append('cheque_no', $('#in_chq').val());
        formData.append('contact', $('#in_cont').val());
        formData.append('property', $('#in_prop').val());

        if ($('#in_vch_file')[0].files[0]) formData.append('vch_attach', $('#in_vch_file')[0].files[0]);
        if ($('#in_chq_file')[0].files[0]) formData.append('chq_attach', $('#in_chq_file')[0].files[0]);

        $btn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: '<?php echo base_url("admin/update_gratuity_details"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#txt_lic_amt_' + id).text($('#in_amt').val() || '--');
                    $('#txt_lic_vch_' + id).text($('#in_vch').val() || '--');
                    $('#txt_max_disb_amt_' + id).text($('#in_max_disb_amt').val() || '--');
                    $('#txt_stat_' + id).text($('#in_stat').val());
                    $('#txt_disb_' + id).text($('#in_date').val() || '--');
                    $('#txt_chq_no_' + id).text($('#in_chq').val() || '--');
                    $('#txt_cont_' + id).text($('#in_cont').val() || '--');
                    $('#txt_prop_' + id).text($('#in_prop').val() || 'Pending');

                    var baseUrl = '<?php echo base_url("uploads/employeegratuity/"); ?>';
                    if (res.vch_attachment) {
                        $('#txt_vch_doc_' + id).html('Attached <a href="'+baseUrl+res.vch_attachment+'" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-paperclip"></i></a>');
                    }
                    if (res.chq_attachment) {
                        $('#txt_chq_doc_' + id).html('Attached <a href="'+baseUrl+res.chq_attachment+'" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-paperclip"></i></a>');
                    }

                    var $row = $('#row_' + id);
                    $row.find('.audit-updated').text(res.last_updated);
                    table.row($row).invalidate().draw(false);

                    $('#entryModal').modal('hide');
                    alert('Updated successfully!');
                } else {
                    alert('Error: ' + res.message);
                }
                $btn.prop('disabled', false).text('Update Table');
            }
        });
    }

    function closeModal() { $('#entryModal').modal('hide'); $('#popupForm')[0].reset(); }
</script>