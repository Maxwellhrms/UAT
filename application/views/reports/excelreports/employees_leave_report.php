



<?php echo $controller1->mastersfilters_paystructure($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='N',$day='N',$from ='N',$to ='N',$emp_type='N',$is_quaterly='N',$emp_status='N'); ?>

<!--  7 variables -->

<div class="row mb-3">
    <div class="col-sm-12 text-right">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btnExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
            <button type="button" class="btn btn-primary ml-2" id="btnPdf"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
        </div>
    </div>
</div>

<div id="excellist"> </div>
<div id="loader_overlay" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; text-align: center; padding-top: 20%;">
    <div class="spinner-border text-primary" role="status">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>
    <div style="margin-top: 10px; font-weight: bold;">Processing Leave Report...</div>
</div>

<script>
    // Initial UI setup
    $(".hidingthecol, .hidingthecol2, .attndyear_div, .finacial_month_year_div_status").css("display", "none");
    $(".finacial_month_year_div").css("display", "block");

    function getFormData() {
        return {
            'companyid': $("#esi_company_id").val(),
            'divisonid': $("#esi_div_id").val(),
            'stateid': $("#esi_state_id").val(),
            'branchid': $("#esi_branch_id").val(),
            'employeeid': $("#attndempid").val().trim(),
            'monthyear': $("#finacial_month_year").val(),
            'filter': '1'
        };
    }

    // 1. Handle VIEW (Ajax HTML)
    $("form#commonform").submit(function(e) {
        e.preventDefault();
        var formData = getFormData();

        // Validation Logic (Kept exactly as yours)
        if (!validateFilters()) return false;

        $.ajax({
            url: baseurl + 'export/employeesleavereport_ajax',
            type: "post",
            data: formData,
            beforeSend: function() {
                $("#loader_overlay").show();
                $("#excellist").html(""); // Clear previous results
            },
            success: function (data) {
                $("#excellist").html(data);
            },
            error: function() {
                alert("An error occurred while fetching the report.");
            },
            complete: function() {
                $("#loader_overlay").hide();
            }
        });
    });

    // Helper function for repetitive validation
    function validateFilters() {
        var attndyear = $("#finacial_month_year").val();
        if (!attndyear) {
            $("#attndmontherror").html("Please Select Financial Year").focus();
            return false;
        } else { $("#attndmontherror").html(""); }

        var company_id = $("#esi_company_id").val();
        if (!company_id) {
            $("#cmpnameerror").html("Please Select Company Name").focus();
            return false;
        } else { $("#cmpnameerror").html(""); }

        var empid = $("#attndempid").val().trim();
        if (empid == "") {
            $("#empiderror").html("Please enter Employee Code").focus();
            return false;
        } else { $("#empiderror").html(""); }

        return true;
    }

    // 2. Handle EXCEL EXPORT
    $(document).on('click', '#btnExcel', function() {
        submitExportForm(baseurl + 'export/employeesleavereport_excel');
    });

    // 3. Handle PDF EXPORT
    $(document).on('click', '#btnPdf', function() {
        submitExportForm(baseurl + 'export/employeesleavereport_pdf');
    });

    function submitExportForm(actionUrl) {
        if (!validateFilters()) return false;

        var formData = getFormData();

        // Show loader briefly to indicate the request started
        $("#loader_overlay").show();

        var form = $('<form>', {
            action: actionUrl,
            method: 'post',
            target: '_blank'
        });

        $.each(formData, function(key, value) {
            form.append($('<input>', { type: 'hidden', name: key, value: value }));
        });

        $('body').append(form);
        form.submit();
        form.remove();

        // Hide loader after a short delay since we can't detect when the file download finishes
        setTimeout(function() {
            $("#loader_overlay").hide();
        }, 2000);
    }
</script>