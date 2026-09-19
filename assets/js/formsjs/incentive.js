$("#emptype").change(function () {
    var emptype = $(this).val();
    var comp_id = $('#esi_company_id').val();
    var division_id = $('#esi_div_id').val();
    var state_id = $('#esi_state_id').val();
    var branch_id = $('#esi_branch_id').val();
    $.ajax({
        url: baseurl + "admin/getvariablepayemployeementtype",
        type: "post",
        async: false,
        data: { employeetype: emptype, company: comp_id, division: division_id, state: state_id, branch: branch_id },
        success: function (data) {
            $("#variablepay").html(data);
        }
    });

    $.ajax({
        url: baseurl + "admin/getemployesfrominfoforincentive",
        type: "post",
        async: false,
        data: { emptype: emptype, cmpname: comp_id, divname: division_id, cmpstate: state_id, brname: branch_id },
        success: function (data) {
            $("#incentiveemployeecode").html(data);
        }
    });

});
//------Load Division
$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
        //        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);

    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        var option = "<option value=0>Select Emp Type</option>";
        $("#emptype").empty().append(option);

        var option = "<option value=0>Select Employee</option>";
        $("#incentiveemployeecode").empty().append(option);
    }
});

var esi_div_array = [];
var esi_selected_div;
function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'type': "ESI" },
        success: function (data) {
            //                    console.log("ESI DIVISIONS");
            //                    console.log(data);
            //                    console.log("END ESI DIVISIONS");
            esi_div_array = JSON.parse(data);
            //                            console.log(states_array);

        }
    });

    var option;
    //        console.log(states_array);
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
            //                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (esi_selected_div == esi_div_array_index.mxd_id) {
                option += "<option value=" + esi_div_array_index.mxd_id + " selected>" + esi_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + esi_div_array_index.mxd_id + ">" + esi_div_array_index.mxd_name + "</option>"
            }
            //                   console.log(option);
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
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
        //        load_esi_states(esi_comp_id, 0)
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        var option = "<option value=0>Select Emp Type</option>";
        $("#emptype").empty().append(option);

        var option = "<option value=0>Select Employee</option>";
        $("#incentiveemployeecode").empty().append(option);
    }
});

var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
    //    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI" },
        success: function (data) {
            //            console.log("ESI STATES");
            //            console.log(data);
            //            console.log("END ESI STATES");
            esi_states_array = JSON.parse(data);
            //                            console.log(states_array);

        }
    });

    var option;
    //        console.log(states_array);
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
            //                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
            //                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#esi_state_id").empty().append(option);

    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);

    var option = "<option value=0>Select Emp Type</option>";
    $("#emptype").empty().append(option);

    var option = "<option value=0>Select Employee</option>";
    $("#incentiveemployeecode").empty().append(option);
}
//------End Load States
//------Load Branches
$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0);
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        var option = "<option value=0>Select Emp Type</option>";
        $("#emptype").empty().append(option);

        var option = "<option value=0>Select Employee</option>";
        $("#incentiveemployeecode").empty().append(option);
    }
});
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI' },
        success: function (data) {
            //                    console.log(data);
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
            //                   console.log(option);
        }
        load_emp_type(esi_comp_id, 0);
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);
}

var incentive_selected_emp_type;
function load_emp_type(cmp_id, incentive_selected_emp_type) {

    var option = '<option value="0">Select Emp Type</option>';
    if (cmp_id != 0 && cmp_id != "") {
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if (emp_type_parse_data.length > 0) {
                    for (index in emp_type_parse_data) {
                        var emp_type_index = emp_type_parse_data[index];
                        if (incentive_selected_emp_type == emp_type_index.mxemp_ty_id) {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' selected>' + emp_type_index.mxemp_ty_name + '</option>';
                        } else {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' >' + emp_type_index.mxemp_ty_name + '</option>';
                        }
                    }
                }

            }
        });
    }
    $("#emptype").html(option);

    var option = "<option value=0>Select Employee</option>";
    $("#incentiveemployeecode").empty().append(option);

}

$("#esi_branch_id").change(function () {
    cmp_id = $("#esi_company_id").val();
    load_emp_type(cmp_id, 0);

});

function processincentive() {

    var yearmonth = $("#yearmonth").val();
    if (yearmonth == 0 || yearmonth == "") {
        $("#yearmonth").focus();
        $('#yearmontherror').html("Please Select Date");
        return false;
    } else {
        $('#yearmontherror').html("");
    }
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

    var emptype = $("#emptype").val();
    if (emptype == 0 || emptype == "") {
        $("#emptype").focus();
        $('#emptypeerror').html("Please Select Employee Type");
        return false;
    } else {
        $('#emptypeerror').html("");
    }
    //  ----------------------------added chandana 24-04-2021 --------------------
    var insetypselval = $("#insetypsel").val();
    if (insetypselval == 1) {
        //  ----------------------------end added chandana 24-04-2021 --------------------
        var variablepay = $("#variablepay").val();
        if (variablepay == 0 || variablepay == "") {
            $("#variablepay").focus();
            $('#variablepayerror').html("Please Select Variable Pay");
            return false;
        } else {
            $('#variablepayerror').html("");
        }

        var amount = $("#amount").val();
        if (amount == 0 || amount == "") {
            $("#amount").focus();
            $('#amounterror').html("Please Enter Amount");
            return false;
        } else {
            $('#amounterror').html("");
        }

        var istds = '';
        if ($('#istds').is(":checked")) {
            istds = 1;
        } else {
            istds = 0;
        }
    } else if (insetypselval == 2) {
        var variablepay = $("#mis_variablepay").val();
        if (variablepay == 0 || variablepay == "") {
            $("#mis_variablepay").focus();
            $('#mis_variablepayerror').html("Please Select Variable Pay");
            return false;
        } else {
            $('#mis_variablepayerror').html("");
        }

        var amount = $("#mis_amount").val();
        if (amount == 0 || amount == "") {
            $("#mis_amount").focus();
            $('#mis_amounterror').html("Please Enter Amount");
            return false;
        } else {
            $('#mis_amounterror').html("");
        }

        var istds = '';
        if ($('#mis_istds').is(":checked")) {
            istds = 1;
        } else {
            istds = 0;
        }
    }
    var emcode = $("#incentiveemployeecode").val();

    mainurl = baseurl + 'admin/saveincentive';
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: {date : yearmonth, company:esi_company_id, divison:esi_div_id, state:esi_state_id, branch:esi_branch_id, emptype : emptype, variablepay : variablepay, amount : amount, istds : istds, empcode : emcode , insetypselval : insetypselval},
        success: function (data) {
            if (data == 200) {
                alert('Success');
                window.location.reload();
            } else if(data == 221){
                alert("Variable pay Already Exist For these Employee For These Month....");
                return false;
            }else if(data == 222){
                alert("Miscelleneous Deductions Already Exist For these Employee For These Month....");
                return false;
            }else {
                alert('Try Again Later');
            }
        },
    });
}
$(function () {
    $('#miscellaneousdiv').hide();
    $('#miscdivdatb').hide();
    $('#insetypsel').change(function () {
        if ($('#insetypsel').val() == 1) {
            $('#incentivediv').show();
            $('#incdivdatb').show();
            $('#miscdivdatb').hide();
            $('#miscellaneousdiv').hide();
            $('#miscellaneousdiv').css('display', 'none')
        } else if ($('#insetypsel').val() == 2) {
            $('#miscellaneousdiv').show();
            $('#miscdivdatb').show();
            $('#incdivdatb').hide();
            $('#incentivediv').hide();
            $('#incentivediv').css('display', 'none')
        }
    });
});