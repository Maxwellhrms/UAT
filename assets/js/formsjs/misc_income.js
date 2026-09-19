//$(document).ready(function () {
//------Load Division
$("#cmpname").change(function () {
    var esi_comp_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);
        
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#divname").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#cmpstate").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#brname").empty().append(option);
    }
    load_emp_type(esi_comp_id, 0)
    getemployeesinfo()
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

    $("#divname").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#cmpstate").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#brname").empty().append(option);
}

$("#divname").change(function () {
    var esi_comp_id = $("#cmpname").val();
    var esi_div_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#cmpstate").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#brname").empty().append(option);
    }
    getemployeesinfo()
});

var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
//    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI"},
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

    $("#cmpstate").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#brname").empty().append(option);
}
//------End Load States
//------Load Branches
$("#cmpstate").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#brname").empty().append(option);
    }
    getemployeesinfo()
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
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#brname").empty().append(option);
}
//------End Load Branches

$("#brname").change(function () {
    getemployeesinfo()
});
$("#emptype").change(function () {
    getemployeesinfo()
});

//---------------LOAD EMPLOYEE TYPE
var incentive_selected_emp_type;
function load_emp_type(cmp_id, incentive_selected_emp_type) {

    var option = '<option value="">Select Emp Type</option>';
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
}
//---------------END LOAD EMPLOYEE TYPE


$('#tds_amount').keypress(function (e) {
    var regex = new RegExp("^[0-9.]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});


function getemployeesinfo(){
    var cmpname = $("#cmpname").val();
    var divname = $("#divname").val();
    var cmpstate = $("#cmpstate").val();
    var brname = $("#brname").val();
    var emptype = $("#emptype").val();
    
    
    if(cmpname != "" && cmpname !=0 && divname != "" && divname !=0 && cmpstate != "" && cmpstate !=0 && brname != "" && brname !=0 && emptype != "" && emptype !=0){
        // var formData = ; 
        var mainurl = baseurl + 'admin/getemployeesinfo';  
        var option;
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: {"comp_id":cmpname,"div_id":divname,"state_id":cmpstate,"branch_id":brname,"emptype":emptype},
            success: function (data) {
                // console.log(data);
                var parsedData = JSON.parse(data);
                if(parsedData.length > 0){
                    option = "<option value=\"\">Select Emp Code</option>";
                    for(index in parsedData){
                        var index_data = parsedData[index];
                        // console.log(index_data);
                        //   option += "<option>"+index_data.mxemp_emp_id+"</option>"
                        option += "<option value="+index_data.mxemp_emp_id+">"+index_data.mxemp_emp_id+"-"+index_data.mxemp_emp_fname+" "+ index_data.mxemp_emp_lname +"</option>"
                    }
                }else{
                    option = "";
                    option = "<option value=\"\">No Data Found</option>"
                }
                    $("#emp_code").html(option);            
            }
            // cache: false,
            // contentType: false,
            // processData: false
        });
    }else{
        var option = "<option value=\"\">Select Emp Code</option>"
        $("#emp_code").html(option);
        
    }
}

$("form#misc_income_form").submit(function (e) {
    e.preventDefault();
    var cmpname = $("#cmpname").val().trim();
    if (cmpname == "" || cmpname == 0) {
        $('#cmpnameerror').html("Please Select Company Name...");
        $("#cmpname").focus();
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
//alert(affect_date);
//return false;
    var divname = $("#divname").val();
    if (divname == 0 || divname == "") {
        $("#divname").focus();
        $('#divnameerror').html("Please Select Division Name");
        return false;
    } else {
        $('#divnameerror').html("");
    }
    

    var cmpstate = $("#cmpstate").val();
    if (cmpstate == 0 || cmpstate == "") {
        $("#cmpstate").focus();
        $('#cmpstateerror').html("Please Select State");
        return false;
    } else {
        $('#cmpstateerror').html("");
    }

    var brname = $("#brname").val();
    if (brname == 0 || brname == "") {
        $("#brname").focus();
        $('#brnameerror').html("Please Select Branch");
        return false;
    } else {
        $('#brnameerror').html("");
    }

    var emptype = $("#emptype").val();
    if (emptype == 0 || emptype == "") {
        $("#emptype").focus();
        $('#emptypeerror').html("Please Select Employement Type");
        return false;
    } else {
        $('#emptypeerror').html("");
    }
    
    var misc_month_year = $("#misc_month_year").val().trim();
    if (misc_month_year == "") {
        $("#misc_month_year").focus();
        $('#misc_month_year_error').html("Please Select Month & Year");
        return false;
    } else {
        $('#misc_month_year_error').html("");
    }

    var emp_code = $("#emp_code").val().trim();
    if (emp_code == "") {
        $("#emp_code").focus();
        $('#emp_code_error').html("Please Enter Employee Code");
        return false;
    } else {
        $('#emp_code_error').html("");
    }

    var tds_amount = $("#tds_amount").val().trim();
    if (tds_amount == "") {
        $("#tds_amount").focus();
        $('#tds_amount_error').html("Please Enter TDS Amount");
        return false;
    } else {
        $('#tds_amount_error').html("");
    }
    
    var regex = new RegExp("^[0-9.]+$");
    if (regex.test(tds_amount) == false) {
        $('#tds_amount_error').html("Please Enter Numeric Values");
        return false;
    }else{
        $('#tds_amount_error').html("");
    }

    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_misc_income';
//}else if(page_type == 2){
//  var mainurl = baseurl+'admin/save_edit_pf_statutory';
//}

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
            var parsedData = JSON.parse(data);
            // console.log(parsedData);
            if(parsedData.status == 0){
                alert(parsedData.message);
                return false;
            }else if(parsedData.status == 1){
                alert(parsedData.message);
                window.location.reload();
                return false;
            }else{
                alert("Some Error Getting Contact Developer...");
                return false;
            }
           
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

// SHOW TDS LIST DATA
 $(document).on("click", ".show_list", function () {
    var cmpname = $("#cmpname_list").val().trim();
    if (cmpname == "" || cmpname == 0) {
        $('#cmpname_listerror').html("Please Select Company Name...");
        $("#cmpname_list").focus();
        return false;
    } else {
        $('#cmpname_listerror').html("");
    }
    var misc_month_year_list = $("#misc_month_year_list").val().trim();
    var emp_code_list = $("#emp_code_list").val().trim();
    
     $.ajax({
        url: baseurl + 'admin/get_misc_income',
        type: 'POST',
        data: {'cmpname':cmpname, 'monthyear':misc_month_year_list, 'emp_code':emp_code_list},
        success: function (data) {
            $("#displayTDSfilterdata").html(data);
            var table = $('#dataTables-example').DataTable({
                dom: 'Bfrtip',
                "destroy": true, //use for reinitialize datatable
                lengthChange: false,
                buttons: [
                    'excel'
                ]
                // buttons: [
                //     'excel', 'pdf', 'csv'
                // ]
            });
           
        }
    });
    
 });

//DELETE
$(document).on("click", ".tdsdelete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    // $(".modal-body #esi_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #deltdsid").val(id);
});
$("#processdeletedata_tds").click(function () {
    event.preventDefault();
    var deltdsid = $('#deltdsid').val();

    $.ajax({
        async: false,
        type: "POST",
        data: {tdsid: deltdsid},
        url: baseurl + 'admin/delete_misc_income',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                    window.location.reload();

            }else if(data == "4"){
                alert("Paysheet already generated for selected TDS");
            } else {
                alert('Try Again Later');
            }
        }
    });

});

// //END DELETE

// //});
