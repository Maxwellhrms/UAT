$(document).ready(function () {

    // 1. Initialize Month-Year Picker
    if ($.isFunction($.fn.datepicker)) {
        $('.yearmonth').datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
    }

    // 2. Reset Button Logic
    $("#btn_global_reset").click(function () {
        $("#global_yearmonth").val('');
        $("#global_company_id").val('0').trigger('change');
        $(".error-msg").html('');
        alert("Filters have been reset.");
    });

    // 3. Global Delete Trigger
    $("#btn_global_delete").click(function () {
        // Clear previous errors
        $(".error-msg").html('');

        var yearmonth = $("#global_yearmonth").val();
        var company_id = $("#global_company_id").val();

        // Basic Validation
        var hasError = false;
        if (yearmonth == "") {
            $("#global_yearmonth_error").html("Please select a Month and Year.");
            hasError = true;
        }
        if (company_id == "0" || company_id == "") {
            $("#global_company_id_error").html("Please select a Company.");
            hasError = true;
        }

        if (hasError) return false;

        // Double Confirmation Protocol
        var confirm1 = confirm("CRITICAL WARNING: You are about to delete ALL salary records (Employees, Trainees, Professionals, and Directors) for " + yearmonth + ". Do you wish to proceed?");

        if (confirm1) {
            var confirm2 = confirm("FINAL CHECK: This will also reverse loan EMI logs and restore outstanding balances. This action cannot be easily undone. Are you absolutely sure?");

            if (confirm2) {
                // Execute Global Delete
                $.ajax({
                    url: baseurl + "admin/process_global_salary_delete",
                    type: "POST",
                    data: {
                        yearmonth: yearmonth,
                        company_id: company_id
                    },
                    beforeSend: function() {
                        $("#btn_global_delete").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function (response) {
                        var res = JSON.parse(response);
                        alert(res.message);

                        if (res.status == 1) {
                            window.location.reload();
                        } else {
                            $("#btn_global_delete").prop('disabled', false).html('<i class="fa fa-trash"></i> Global Delete');
                        }
                    },
                    error: function () {
                        alert("A system error occurred. Deletion aborted.");
                        $("#btn_global_delete").prop('disabled', false).html('<i class="fa fa-trash"></i> Global Delete');
                    }
                });
            }
        }
    });
});