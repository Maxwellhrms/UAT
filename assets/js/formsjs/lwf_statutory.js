//$(document).ready(function () {
//------Load States
$("#lwf_company_id").change(function () {
    var lwf_comp_id = $(this).val();
//        alert(comp_id);
    if (lwf_comp_id != 0 && lwf_comp_id != "") {
//        lwf_load_states(lwf_comp_id, 0)
          load_lwf_divisions(lwf_comp_id,0);
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#lwf_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#lwf_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#lwf_branch_id").empty().append(option);
    }
    $.ajax({
        url: baseurl + 'test/getgrade',
        type: 'POST',
        data: { companyid: lwf_comp_id },
        success: function (data) {
          $("#gradename").html(data);
        },
      });
});

var lwf_div_array = [];
var lwf_selected_div;
function load_lwf_divisions(lwf_comp_id, lwf_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': lwf_comp_id, 'type': "LWF"},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            lwf_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (lwf_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in lwf_div_array) {
            var lwf_div_array_index = lwf_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (lwf_selected_div == lwf_div_array_index.mxd_id) {
                option += "<option value=" + lwf_div_array_index.mxd_id + " selected>" + lwf_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + lwf_div_array_index.mxd_id + ">" + lwf_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#lwf_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#lwf_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#lwf_branch_id").empty().append(option);
}
//END DIVISION
//START STATES
$("#lwf_div_id").change(function () {
    var lwf_comp_id = $("#lwf_company_id").val();
    var lwf_div_id = $(this).val();
//        alert(comp_id);
    if (lwf_comp_id != 0 && lwf_comp_id != "" && lwf_div_id != 0 && lwf_div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        lwf_load_states(lwf_comp_id, lwf_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#lwf_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#lwf_branch_id").empty().append(option);
    }
});

var lwf_states_array = [];
var lwf_selected_state;
function lwf_load_states(lwf_comp_id,lwf_div_id, lwf_selected_state) {
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': lwf_comp_id,'div_id':lwf_div_id, 'type': "LWF"},
        success: function (data) {
//                    console.log(data);
            lwf_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (lwf_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in lwf_states_array) {
            var lwf_states_array_index = lwf_states_array[index];
//                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (lwf_selected_state == lwf_states_array_index.mxst_id) {
                option += "<option value=" + lwf_states_array_index.mxst_id + " selected>" + lwf_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + lwf_states_array_index.mxst_id + ">" + lwf_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#lwf_state_id").empty().append(option);
        
    option = "<option value=0>Select Branch</option>";
    $("#lwf_branch_id").empty().append(option);
}
//------End Load States
//------Load Branches
$("#lwf_state_id").change(function () {
    var lwf_comp_id = $("#lwf_company_id").val();
    var lwf_div_id = $("#lwf_div_id").val();
    var lwf_state_id = $(this).val();
    if (lwf_comp_id != 0 && lwf_comp_id != "" && lwf_div_id != 0 && lwf_div_id != "" && lwf_state_id != 0 && lwf_state_id != "") {
        lwf_load_branches(lwf_comp_id,lwf_div_id,lwf_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#lwf_branch_id").empty().append(option);
    }
});
var lwf_branches_array = [];
var lwf_selected_branch;
function lwf_load_branches(lwf_comp_id,lwf_div_id,lwf_state_id, lwf_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id':lwf_comp_id,'div_id':lwf_div_id,'state_id': lwf_state_id, 'type': 'LWF'},
        success: function (data) {
//                    console.log(data);
            lwf_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (lwf_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in lwf_branches_array) {
            var lwf_branches_array_index = lwf_branches_array[index];
            if (lwf_selected_branch == lwf_branches_array_index.mxb_id) {
                option += "<option value=" + lwf_branches_array_index.mxb_id + " selected>" + lwf_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + lwf_branches_array_index.mxb_id + ">" + lwf_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#lwf_branch_id").empty().append(option);
}
//------End Load Branches
$("form#lwf_statutory_form").submit(function (e) {
    e.preventDefault();
    var lwf_affectdate = $("#lwf_affectdate").val();
    if (lwf_affectdate == "") {
        $('#lwf_affectdate_error').html("Please Select Affect Date");
        $("#lwf_affectdate").focus();
        return false;
    } else {
        $('#lwf_affectdate_error').html("");
    }
//alert(affect_date);
//return false;
    var lwf_company_id = $("#lwf_company_id").val();
    if (lwf_company_id == 0 || lwf_company_id == "") {
        $("#lwf_company_id").focus();
        $('#lwf_company_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#lwf_company_id_error').html("");
    }
    var lwf_div_id = $("#lwf_div_id").val();
    if (lwf_div_id == 0 || lwf_div_id == "") {
        $("#lwf_div_id").focus();
        $('#lwf_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#lwf_div_id_error').html("");
    }

    var lwf_state_id = $("#lwf_state_id").val();
    if (lwf_state_id == 0 || lwf_state_id == "") {
        $("#lwf_state_id").focus();
        $('#lwf_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#lwf_state_id_error').html("");
    }

    var lwf_branch_id = $("#lwf_branch_id").val();
    if (lwf_branch_id == 0 || lwf_branch_id == "") {
        $("#lwf_branch_id").focus();
        $('#lwf_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#lwf_branch_id_error').html("");
    }

    var lwf_deduct_date = $("#lwf_deduct_date").val();
    if (lwf_deduct_date == "") {
        $("#lwf_deduct_date").focus();
        $('#lwf_deduct_date_error').html("Please Select Deduct Date");
        return false;
    } else {
        $('#lwf_deduct_date_error').html("");
    }

    var lwf_emp_cont = $("#lwf_emp_cont").val();
    if (lwf_emp_cont == "") {
        $("#lwf_emp_cont").focus();
        $('#lwf_emp_cont_error').html("Please Enter Emp Cont");
        return false;
    } else {
        $('#lwf_emp_cont_error').html("");
    }

    var lwf_comp_cont = $("#lwf_comp_cont").val();
    if (lwf_comp_cont == "") {
        $("#lwf_comp_cont").focus();
        $('#lwf_comp_cont_error').html("Please Enter Comp Cont");
        return false;
    } else {
        $('#lwf_comp_cont_error').html("");
    }

    var lwf_no = $("#lwf_no").val();
    if (lwf_no == "") {
        $("#lwf_no").focus();
        $('#lwf_no_error').html("Please Enter LWF No");
        return false;
    } else {
        $('#lwf_no_error').html("");
    }




    var lwf_emp_type = $("#lwf_emp_type").val();
    if (lwf_emp_type == "" || lwf_emp_type == 0) {
        $("#lwf_emp_type").focus();
        $('#lwf_emp_type_error').html("Please Select LWF Emp Type");
        return false;
    }



    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_lwf_statutory';
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
//      return false;
            if (data == 200) {
                alert('Successfully Saved The LWF Statutory....');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/lwf_master_li";

                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company,Division,State,Branch....');
                return false;
            } else if(data == "LESS"){
                alert("You Cant Save Affect Date Less Than The Previous Existing Records");
                return false;
            }else if(data == 222){
                alert("Dedut Date Should Not Be Less Than The Affect Date...");
                return false;
            }
            // else if(data == "same"){
            //     alert("You Cant Feed The Affect Date As the Same Month And Year Of Previous Record");
            //     return false;
            // }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$("#processdeletedata_lwf").click(function () {
    event.preventDefault();
    var del_lwf_id = $('#del_lwf_id').val();
//alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {lwf_id: del_lwf_id},
        url: baseurl + 'admin/delete_lwf_statutory',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/statutorymaster/lwf_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".lwf_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #lwf_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_lwf_id").val(id);
});


//});
