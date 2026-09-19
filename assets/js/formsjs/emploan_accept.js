

// Emi Calculations
$("#tenuremnts").change(function () {
    var totalamt = 0;
    var tenuremnts = $("#tenuremnts").val();
    var loanamountapproved = $("#loanamountapproved").val();
    if(tenuremnts != ""){
        if(loanamountapproved != "" && loanamountapproved > 0){
            var totalamt = loanamountapproved/tenuremnts;
            $(".emiamountidentyfier").html('Monthly Emi Debit Will be ' + totalamt);
        }else{
            alert("Please Enter Loan Amount");
            $("option:selected").prop("selected", false)
        }
    }else{
        $(".emiamountidentyfier").html('');
    }
});
// Emi Calculations




$("form#emploan_form").submit(function (e) {
    e.preventDefault();
    // alert("sdsd");
    // return false;

//alert(affect_date);
//return false;
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
    if (esi_div_id == 0 || esi_div_id == "") {
        $("#esi_div_id").focus();
        $('#esi_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#esi_div_id_error').html("");
    }

    var esi_state_id = $("#esi_state_id").val();
    if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    }

    var esi_branch_id = $("#esi_branch_id").val();
    if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }

    var employeeid = $("#employeeid").val();
    if (employeeid == "") {
        $('#employeeiderror').html("Please Select Employee");
        $("#employeeid").focus();
        return false;
    } else {
        $('#employeeiderror').html("");
    }

    var loantype = $("#loantype").val();
    if (loantype == "") {
        $('#loantypeerror').html("Please Select Loan Type");
        $("#loantype").focus();
        return false;
    } else {
        $('#loantypeerror').html("");
    }


    var rsloanamount = $("#rsloanamount").val();
    if (rsloanamount == "") {
        $('#rsloanamounterror').html("Please Enter Reason for loan");
        $("#rsloanamount").focus();
        return false;
    } else {
        $('#rsloanamounterror').html("");
    }

    var emploanamountapplied = $("#emploanamountapplied").val();
    if (emploanamountapplied == "") {
        $('#emploanamountappliederror').html("Please Enter loan Applied");
        $("#emploanamountapplied").focus();
        return false;
    } else {
        $('#emploanamountappliederror').html("");
    }


    var loanamountapplied = $("#loanamountapplied").val();
    if (loanamountapplied == "") {
        $('#loanamountappliederror').html("Please Enter loan Applied Date");
        $("#loanamountapplied").focus();
        return false;
    } else {
        $('#loanamountappliederror').html("");
    }


    var tenuremnts = $("#tenuremnts").val();
    if (tenuremnts == "") {
        $('#tenuremntserror').html("Please Select Tenure Months");
        $("#tenuremnts").focus();
        return false;
    } else {
        $('#tenuremntserror').html("");
    }

    var loancategory = $("#loancategory").val();
    if (loancategory == "") {
        $('#loancategoryerror').html("Please Select Loan Category");
        $("#loancategory").focus();
        return false;
    } else {
        $('#tenuremntserror').html("");
    }

    var loanstatus = $("#loanstatus").val();
    if (loanstatus == "") {
        $('#loanstatuserror').html("Please Select Loan Status");
        $("#loanstatus").focus();
        return false;
    } else {
        $('#loanstatuserror').html("");
    }

    if(loanstatus == '3'){
        var loanamountappdate = $("#loanamountappdate").val();
        if (loanamountappdate == "") {
            $('#loanamountappdateerror').html("Please Enter loan Approved Date");
            $("#loanamountappdate").focus();
            return false;
        } else {
            $('#loanamountappdateerror').html("");
        }

        var loanamountapproved = $("#loanamountapproved").val();
        if (loanamountapproved == "") {
            $('#loanamountapprovederror').html("Please Enter loan Approved");
            $("#loanamountapproved").focus();
            return false;
        } else {
            $('#loanamountapprovederror').html("");
        }

        var loanamountapprovedby = $("#loanamountapprovedby").val();
        if (loanamountapprovedby == "") {
            $('#loanamountapprovedbyerror').html("Please Enter Loan Approved By");
            $("#loanamountapprovedby").focus();
            return false;
        } else {
            $('#loanamountapprovedbyerror').html("");
        }

        var emiloanamount = $("#emiloanamount").val();
        if (emiloanamount == "") {
            $('#emiloanamounterror').html("Please Enter Emi loan Start Date");
            $("#emiloanamount").focus();
            return false;
        } else {
            $('#emiloanamounterror').html("");
        }

        var ls = confirm('Are You Sure To Process Loan To ACCEPT FOR ' + employeeid);
        if (ls == false) {
            return false;
        }else{
            var mainurl = baseurl + 'loan_controller/save_approveemployeeloandetails';
        }
    }else{
        var mainurl = baseurl + 'loan_controller/update_loandetailsbystatus';
    }

    var final_confirmation = confirm('Are You Sure To Process Loan For ' + employeeid);
    if (final_confirmation == false) {
        return false;
    }

    

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
        if (data == 200) {
                alert('Successfully Saved');
                window.location.reload();
            }else if(data == 444){
                $("#emiloanamounterror").html("Emi Start Date Should Be Greater Than the Joining Date...");
                $("#emiloanamount").focus();
                return false;
            }else{
                alert('Failed');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});