$(document).ready(function () {
    var brn = 1;

    // --- 1. DATATABLES INITIALIZATION ---
    var table = $('#wage_table').DataTable({
        "order": [[5, "desc"]],
        // SYNC: Matches your screenshot layout
        "dom": '<"row"<"col-sm-12 col-md-6"lB><"col-sm-12 col-md-6"f>>rtip',
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-orange btn-sm',
                title: 'Wage Master Configuration Report',
                filename: 'Wage_Master_Config_' + new Date().getTime(),
                // exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                exportOptions: { columns: ':not(:last-child)' }
            },
            /*{
                extend: 'csv',
                text: '<i class="fa fa-file-text-o"></i> CSV',
                className: 'btn btn-orange btn-sm',
                title: 'Wage Master Configuration Report',
                filename: 'Wage_Master_Config_' + new Date().getTime(),
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn btn-orange btn-sm',
                title: 'Wage Master Configuration Report',
                filename: 'Wage_Master_Config_' + new Date().getTime(),
                // exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                exportOptions: { columns: ':not(:last-child)' }
            }
            */
        ],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    // --- 2. CUSTOM FILTER LOGIC (THE SEARCH BUTTON) ---

    // Custom Filter Gatekeeper
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var fromDate = $('#filter_date_from').val();
            var tillDate = $('#filter_date_till').val();
            var statusFilter = $('#filter_status').val();

            var rowWefStr = data[5]; // WEF Date column
            var rowStatus = data[7]; // Status column

            // 1. Status Check
            if (statusFilter !== "" && rowStatus.indexOf(statusFilter) === -1) {
                return false;
            }

            // 2. Date Range Check
            if (fromDate || tillDate) {
                var parts = rowWefStr.split("-");
                var rowDate = new Date(parts[2], parts[1] - 1, parts[0]);
                var min = fromDate ? new Date(fromDate) : null;
                var max = tillDate ? new Date(tillDate) : null;

                if (min && rowDate < min) return false;
                if (max && rowDate > max) return false;
            }

            return true;
        }
    );

    // --- LOGIC FOR btn_search CLICK ---
    $('#btn_search').on('click', function () {
        // This triggers the Gatekeeper logic above
        table.draw();
    });

    // Reset Button
    $('#btn_reset_filter').on('click', function () {
        $('#filter_status').val('').trigger('change');
        $('#filter_date_from').val('');
        $('#filter_date_till').val('');
        table.search('').columns().search('').draw();
    });

    // --- 3. CASCADING & EDIT LOGIC ---
    $("#division_id").change(function () {
        get_zonal($("#company_id").val(), $(this).val(), 0);
    });

    $("#state_id").change(function () {
        var state_id = $(this).val();
        if (state_id != "") {
            $.ajax({
                type: "POST",
                url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
                data: { 'state_id': state_id },
                success: function (data) {
                    var branch_data = JSON.parse(data);
                    var option = '<option value="">Select Branch</option>';
                    $.each(branch_data, function (i, item) {
                        option += '<option value="' + item.mxb_id + '">' + item.mxb_name + '</option>';
                    });
                    $("#branch_id").html(option);
                }
            });
        }
    });

    $(document).on("click", ".editwagemaster", function () {
        brn = 2;
        $("#wage_form_panel").collapse('show');
        $("#mxwm_id").val($(this).data('id'));
        $("#company_id").val($(this).data('cmp')).trigger('change');
        $("#division_id").val($(this).data('div')).trigger('change');
        $("#state_id").val($(this).data('state')).trigger('change');
        $("#status").val($(this).data('status')).trigger('change');

        var branch_id = $(this).data('br');
        setTimeout(function() {
            $("#branch_id").val(branch_id).trigger('change');
        }, 500);

        $("#zone").val($(this).data('zone')).trigger('change');
        $("#state_wage").val($(this).data('swage'));
        $("#national_wage").val($(this).data('nwage'));
        $("#wef_date").val($(this).data('wef'));
        $("#valid_till").val($(this).data('till'));
        $('#submit_btn').text('Update Wage Config');
        $('html, body').animate({ scrollTop: $("#wage_form_panel").offset().top - 100 }, 500);
    });

    // --- 4. FORM SUBMISSION ---
    $("form#processwagedetails").submit(function (e) {
        e.preventDefault();
        var mainurl = (brn == 1) ? baseurl + 'admin/wagemaster/save_wage_config' : baseurl + 'admin/wagemaster/update_wage_config';
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: new FormData(this),
            cache: false, contentType: false, processData: false,
            success: function (data) {
                if (data == 200) { window.location.reload(); }
                else if (data == 400) { alert('Valid Till cannot be before Effective Date'); }
                else { alert('Failed'); }
            }
        });
    });

    // --- 5. DELETE ---
    $(document).on("click", ".deletemodal", function () {
        var val = $(this).data('id').split("~");
        $("#delbrid").val(val[0]);
        $("#delbrname").html(val[1]);
    });

    $("#processdeletedata").click(function () {
        $.post(baseurl + 'admin/deletewagemaster', { id: $('#delbrid').val() }, function (data) {
            if (data == 200) { window.location.reload(); }
        });
    });
});

function get_zonal(cmp_id, div_id, selected_zone_id) {
    if (div_id != "" && cmp_id != "") {
        $.post(baseurl + 'admin/getzonaldetails', { "cmp_id": cmp_id, "div_id": div_id }, function(data) {
            var zonal_data = JSON.parse(data);
            var option = '<option value="">Select Zone</option>';
            $.each(zonal_data, function(i, zon) {
                var sel = (selected_zone_id == zon.mxz_id) ? "selected" : "";
                option += '<option value="' + zon.mxz_id + '" ' + sel + '>' + zon.mxz_name + '</option>';
            });
            $("#zonal_id").html(option);
        });
    }
}