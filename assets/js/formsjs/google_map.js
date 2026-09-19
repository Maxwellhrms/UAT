//$(document).ready(function () {
//------Load Division

$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "") {
        load_esi_divisions(esi_comp_id, 0);
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    // var emp_code_html = "<option value='0'>No Data Found</option>";
    // $("#employeeid").empty().append(emp_code_html);
});

var esi_div_array = [];
var esi_selected_div;

function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'type': "ESI"},
        success: function (data) {
            esi_div_array = JSON.parse(data);
        }
    });

    var option;
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
            if (esi_selected_div == esi_div_array_index.mxd_id) {
                option += "<option value=" + esi_div_array_index.mxd_id + " selected>" + esi_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + esi_div_array_index.mxd_id + ">" + esi_div_array_index.mxd_name + "</option>"
            }
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#esi_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#esi_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}

$("#esi_div_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    // var emp_code_html = "<option value='0'>No Data Found</option>";
    // $("#employeeid").empty().append(emp_code_html);
});


var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI"},
        success: function (data) {
            esi_states_array = JSON.parse(data);
        }
    });

    var option;
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#esi_state_id").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}
//------End Load States

//------Load Branches
$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    // var emp_code_html = "<option value='0'>No Data Found</option>";
    // $("#employeeid").empty().append(emp_code_html);
});
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI'},
        success: function (data) {
            esi_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (esi_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in esi_branches_array) {
            var esi_branches_array_index = esi_branches_array[index];
            if (esi_selected_branch == esi_branches_array_index.mxb_id) {
                option += "<option value=" + esi_branches_array_index.mxb_id + " selected>" + esi_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + esi_branches_array_index.mxb_id + ">" + esi_branches_array_index.mxb_name + "</option>"
            }
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);

    // var emp_code_html = "<option value='0'>No Data Found</option>";
    // $("#employeeid").empty().append(emp_code_html);
}



// $("#esi_branch_id").change(function () {
//     var comp_id = $("#esi_company_id").val();
//     var div_id = $("#esi_div_id").val();
//     var state_id = $("#esi_state_id").val();
//     var branch_id = $("#esi_branch_id").val();
//     var attendance = $("#attendance").val();
// if(comp_id !=0 && div_id !=0 && state_id !=0 && branch_id !=0 && attendance !=''){
//     $.ajax({
//         url: baseurl + "attendance_controller/getemployeelistforattandance_googlemap",
//         type: "post",
//         async: false,
//         data: { cmpname: comp_id, divname: div_id, cmpstate: state_id, brname: branch_id,attendance : attendance },
//         success: function (data) {
//             $("#employeeid").html(data);
// 		var table = $('#dataTables-example').DataTable({
// 			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
// 			buttons: ['excel','csv','pdf']
// 		});

// 		table.buttons().container()
// 			.appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)');

//         }
//     });
// }else{
//     var html = "<option value='0'>No Data Found</option>";
//     $("#employeeid").html(html);
// }
// });   


$("form#googlemap").submit(function (e) {
    e.preventDefault();
    var comp_id = $("#esi_company_id").val();
    var div_id = $("#esi_div_id").val();
    var state_id = $("#esi_state_id").val();
    var branch_id = $("#esi_branch_id").val();
    var attendance = $("#attendance").val();
    var employee_code = $("#employee_code").val();
    $.ajax({
        url: baseurl + "attendance_controller/getemployeelistforattandance_googlemap",
        type: "post",
        async: false,
        data: { cmpname: comp_id, divname: div_id, cmpstate: state_id, brname: branch_id,attendance : attendance,empid : employee_code },
        success: function (data) {
            $("#employeeid").html(data);
		var table = $('#dataTables-example').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			buttons: ['excel','csv','pdf']
		});
		table.buttons().container()
			.appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)');
        }
    });
    
});
    
    

$("form#googlemap1").submit(function (e) {
    e.preventDefault();
    var comp_id = $("#esi_company_id").val();
    var div_id = $("#esi_div_id").val();
    var state_id = $("#esi_state_id").val();
    var branch_id = $("#esi_branch_id").val();
    var attendance = $("#attendance").val();
    var employee_code = $("#employee_code").val();
    $.ajax({
        url: baseurl + "attendance_controller/getemployeelistforattandance_googlemap_poly",
        type: "post",
        async: false,
        data: { cmpname: comp_id, divname: div_id, cmpstate: state_id, brname: branch_id,attendance : attendance,empid : employee_code },
        success: function (data) {
            $("#employeeid").html(data);
		var table = $('#dataTables-example').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			buttons: ['excel','csv','pdf']
		});
		table.buttons().container()
			.appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)');
        }
    });
    
});




//------End Load Branches
/*
$("form#emploan_form").submit(function (e) {
    e.preventDefault();
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

    var loanamountapprovedby = $("#loanamountapprovedby").val();
    if (loanamountapprovedby == "") {
        $('#loanamountapprovedbyerror').html("Please Enter Loan Approved By");
        $("#loanamountapprovedby").focus();
        return false;
    } else {
        $('#loanamountapprovedbyerror').html("");
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

    var loanamountapproved = $("#loanamountapproved").val();
    if (loanamountapproved == "") {
        $('#loanamountapprovederror').html("Please Enter loan Approved");
        $("#loanamountapproved").focus();
        return false;
    } else {
        $('#loanamountapprovederror').html("");
    }

    var loanamountapplied = $("#loanamountapplied").val();
    if (loanamountapplied == "") {
        $('#loanamountappliederror').html("Please Enter loan Applied Date");
        $("#loanamountapplied").focus();
        return false;
    } else {
        $('#loanamountappliederror').html("");
    }

    var loanamountappdate = $("#loanamountappdate").val();
    if (loanamountappdate == "") {
        $('#loanamountappdateerror').html("Please Enter loan Approved Date");
        $("#loanamountappdate").focus();
        return false;
    } else {
        $('#loanamountappdateerror').html("");
    }

    var emiloanamount = $("#emiloanamount").val();
    if (emiloanamount == "") {
        $('#emiloanamounterror').html("Please Enter Emi loan Start Date");
        $("#emiloanamount").focus();
        return false;
    } else {
        $('#emiloanamounterror').html("");
    }

    var tenuremnts = $("#tenuremnts").val();
    if (tenuremnts == "") {
        $('#tenuremntserror').html("Please Select Tenure Months");
        $("#tenuremnts").focus();
        return false;
    } else {
        $('#tenuremntserror').html("");
    }
    var final_confirmation = confirm('Are You Sure To Process Loan For ' + employeeid);
    if (final_confirmation == false) {
        return false;
    }
// return false;



    var mainurl = baseurl + 'loan_controller/saveemployeeloandetails';
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

$("form#savenewadvancedata").submit(function (e) {
    e.preventDefault();

    var newamt = $("#newamt").val();
    if (newamt == "") {
        $('#newamterror').html("Please Enter Amount");
        $("#newamt").focus();
        return false;
    } else {
        $('#newamterror').html("");
    }

    var newpytm = $("#newpytm").val();
    if (newpytm == "") {
        $('#newpytmerror').html("Please Select Payment Type");
        $("#newpytm").focus();
        return false;
    } else {
        $('#newpytmerror').html("");
    }

    var newtrdetails = $("#newtrdetails").val();
    if (newtrdetails == "") {
        $('#newtrdetailserror').html("Please Enter mode of Payment Details");
        $("#newtrdetails").focus();
        return false;
    } else {
        $('#newtrdetailserror').html("");
    }
    var mainurl = baseurl + 'loan_controller/saveadvanceemployeeloandetails';
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            if (data == 200) {
                alert('Successfully');
                window.location.reload();
            }else{
                alert('Failed');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$("#newpytm").change(function () {
    var frc = $('#newpytm').val();
    if(frc == 'FC1'){
        var primaryid = $("#primaryid").val();
        var empid = $("#loanempid").val();
        $('#newamt').prop('readonly', true);
        var mainurl = baseurl + 'loan_controller/getforcecloserinfo';
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: { 'id' : primaryid, 'empid' : empid },
            success: function (data) {
                $('#newamt').val(parseFloat(data));
            }
        });
    }else{
        $('#newamt').prop('readonly', false);
        $('#newamt').val('');
    }
});
$(document).on("click", ".deletemodal", function () {
	var deletedetails = $(this).data('id');
	var x = deletedetails.split("~",3);
	var id = x[0];
	var empid = x[1];
	var ldid = x[2];

	$(".modal-body #delcmpname").html(empid);
	$(".modal-body #primaryid").val(id);
	$(".modal-body #loanidsmain").html(ldid);
	$(".modal-body #loanempid").val(empid);
});
$(document).on("click", ".historymodal", function () {
	var history = $(this).data('id');
	var x = history.split("~",3);
	var id = x[0];
	var empid = x[1];
	var ldid = x[2];
	var mainurl = baseurl + 'loan_controller/getdetailedloanhistory';
	$.ajax({
		url: mainurl,
		type: 'POST',
		data: { 'id' : id, 'empid' : empid, 'loanid' : ldid },
		success: function (data) {
			$('#loanledger').html(data);
		}
	});
});


*/




