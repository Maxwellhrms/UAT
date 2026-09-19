//$(document).ready(function () {
//------Load States
$("#special_cmp_id").change(function () {
    var special_cmp_id = $(this).val();
//        alert(special_cmp_id);
    if (special_cmp_id != 0 && special_cmp_id != "") {
//        spc_inc_load_states(special_cmp_id, 0)
          load_spc_inc_divisions(special_cmp_id,0);
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#special_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#special_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#special_branch_id").empty().append(option);
    }
});

var spc_inc_div_array = [];
var spc_inc_selected_div;
function load_spc_inc_divisions(special_cmp_id, spc_inc_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': special_cmp_id, 'type': ""},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            spc_inc_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (spc_inc_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in spc_inc_div_array) {
            var spc_inc_div_array_index = spc_inc_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (spc_inc_selected_div == spc_inc_div_array_index.mxd_id) {
                option += "<option value=" + spc_inc_div_array_index.mxd_id + " selected>" + spc_inc_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + spc_inc_div_array_index.mxd_id + ">" + spc_inc_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#special_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#special_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#special_branch_id").empty().append(option);
}
//END DIVISION


//START STATES
$("#special_div_id").change(function () {
    var special_cmp_id = $("#special_cmp_id").val();
    var special_div_id = $(this).val();
    //        alert(comp_id);
    if (special_cmp_id != 0 && special_cmp_id != "" && special_div_id != 0 && special_div_id != "") {
    //        load_esi_states(esi_comp_id, 0)
        spc_inc_load_states(special_cmp_id, special_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#special_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#special_branch_id").empty().append(option);
    }
});

var spc_inc_states_array = [];
var spc_inc_selected_state;
function spc_inc_load_states(special_cmp_id,special_div_id, lwf_selected_state) {
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': special_cmp_id,'div_id':special_div_id, 'type': ""},
        success: function (data) {
//                    console.log(data);
            spc_inc_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (spc_inc_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in spc_inc_states_array) {
            var spc_inc_states_array_index = spc_inc_states_array[index];
//                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (spc_inc_selected_state == spc_inc_states_array_index.mxst_id) {
                option += "<option value=" + spc_inc_states_array_index.mxst_id + " selected>" + spc_inc_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + spc_inc_states_array_index.mxst_id + ">" + spc_inc_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#special_state_id").empty().append(option);
        
    option = "<option value=0>Select Branch</option>";
    $("#special_branch_id").empty().append(option);
}
//------End Load States
//------Load Branches
$("#special_state_id").change(function () {
    var special_cmp_id = $("#special_cmp_id").val();
    var special_div_id = $("#special_div_id").val();
    var special_state_id = $(this).val();
    if (special_cmp_id != 0 && special_cmp_id != "" && special_div_id != 0 && special_div_id != "" && special_state_id != 0 && special_state_id != "") {
        spc_inc_load_branches(special_cmp_id,special_div_id,special_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#special_branch_id").empty().append(option);
    }
});
var spc_inc_branches_array = [];
var spc_inc_selected_branch;
function spc_inc_load_branches(special_cmp_id,special_div_id,special_state_id, lwf_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id':special_cmp_id,'div_id':special_div_id,'state_id': special_state_id, 'type': ''},
        success: function (data) {
//                    console.log(data);
            spc_inc_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (spc_inc_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in spc_inc_branches_array) {
            var spc_inc_branches_array_index = spc_inc_branches_array[index];
            if (spc_inc_selected_branch == spc_inc_branches_array_index.mxb_id) {
                option += "<option value=" + spc_inc_branches_array_index.mxb_id + " selected>" + spc_inc_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + spc_inc_branches_array_index.mxb_id + ">" + spc_inc_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#special_branch_id").empty().append(option);
}
//------End Load Branches


//------LOAD EMP
$("#special_branch_id").change(function(){
			var comp_id = $("#special_cmp_id").val();
			var div_id = $("#special_div_id").val();
			var state_id = $("#special_state_id").val();
			var branch_id = $(this).val();
			if (comp_id != 0 && comp_id != "" && div_id != 0 && div_id != "" && state_id != 0 && state_id != "" && branch_id !="" && branch_id != 0) {
				$.ajax({
                    url: baseurl + 'admin/getemployeesinfo',
                    type: 'POST',
                    data: {comp_id: comp_id,div_id:div_id,state_id:state_id, branch_id: branch_id},
                    success: function (data) {
                        console.log(data);
						//return false;
                        var parse_data = JSON.parse(data);
                        if (parse_data.length > 0) {
                            $("#promotion_employeeid").empty();
                            $("#promotion_employeeid").append('<option value="">Select Employee</option>');
                            for (index in parse_data) {
                                var auth_data = parse_data[index];
                                var auth_emp_code = auth_data['mxemp_emp_id'];
                                var auth_emp_name = auth_data['mxemp_emp_lname'] + " " + auth_data['mxemp_emp_fname'];
                                //var auth_comp_code = auth_data['mxemp_emp_comp_code'];
                                //var auth_comp_name = auth_data['mxcp_name'];
                                //var auth_branch_code = auth_data['mxemp_emp_branch_code'];
                                //var auth_branch_name = auth_data['mxb_name'];
                                var auth_dept_code = auth_data['mxemp_emp_dept_code'];
                                var auth_dept_name = auth_data['mxdpt_name'];
                                //var auth_desg_code = auth_data['mxemp_emp_desg_code'];
                                var auth_desg_name = auth_data['mxdesg_name'];
                                //var auth_state_id = auth_data['mxemp_emp_state_code'];
                                //var auth_state_name = auth_data['mxst_state'];
                                //var auth_div_id = auth_data['mxemp_emp_division_code'];
                                //var auth_div_name = auth_data['mxd_name'];
                                var opt_data = auth_emp_code + " - " + auth_emp_name + " - " + auth_desg_name;
                                var opt_val = auth_emp_code +'~'+ auth_emp_name+'~'+ auth_dept_code+'~'+ auth_dept_name;
                                
                                $("#special_emp_code").append('<option value="' + opt_val + '">' + opt_data + '</option>');
                            }

                        } else {
                            $("#special_emp_code").empty();
                            $("#special_emp_code").append('<option value="">Select Employee</option>');
                            alert("No Employees Found In the Selected Branch");
                            return false;                            
                        }
                    }
                });	
			}else{
				$("#special_emp_code").empty();
                $("#special_emp_code").append('<option value="">Select Employee</option>');
                alert("No Employees Found In the Selected Branch");
                return false;        
			}
		});
//------END LOAD EMP

//--------GET EMPLOYEE DATA
$("#special_emp_code").change(function(){
    var emp_code_data = $(this).val();
    var ex = emp_code_data.split("~");
    var emp_code = ex[0];
    
    var mainurl = baseurl + 'admin/getSpeciaIncreamnent';
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: {emp_code:emp_code},
        success: function (data) {
            console.log(data);
            $("#special_inc_table").html(data);
            // return false;
            
        }
        // cache: false,
        // contentType: false,
        // processData: false
    });
});
//--------END GET EMPLOYEE DATA


$("form#special_increament_form").submit(function (e) {
    e.preventDefault();
    // alert();
    var special_cmp_id = $("#special_cmp_id").val();
    if (special_cmp_id == 0 || special_cmp_id == "") {
        $("#special_cmp_id").focus();
        $('#special_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#special_cmp_id_error').html("");
    }
    var special_div_id = $("#special_div_id").val();
    if (special_div_id == 0 || special_div_id == "") {
        $("#special_div_id").focus();
        $('#special_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#special_div_id_error').html("");
    }

    var special_state_id = $("#special_state_id").val();
    if (special_state_id == 0 || special_state_id == "") {
        $("#special_state_id").focus();
        $('#special_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#special_state_id_error').html("");
    }

    var special_branch_id = $("#special_branch_id").val();
    if (special_branch_id == 0 || special_branch_id == "") {
        $("#special_branch_id").focus();
        $('#special_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#special_branch_id_error').html("");
    }
    var special_emp_code = $("#special_emp_code").val();
    if (special_emp_code == 0 || special_emp_code == "") {
        $("#special_emp_code").focus();
        $('#special_emp_code_error').html("Please Select Emp Code");
        return false;
    } else {
        $('#special_emp_code_error').html("");
    }

    

    var special_affect_date = $("#special_affect_date").val();
    if (special_affect_date == "") {
        $("#special_affect_date").focus();
        $('#special_affect_date_error').html("Please Select Affect Date");
        return false;
    } else {
        $('#special_affect_date_error').html("");
    }

    var special_inc_amount = $("#special_inc_amount").val();
    if (special_inc_amount == "") {
        $("#special_inc_amount").focus();
        $('#special_inc_amount_error').html("Please Enter Amount");
        return false;
    } else {
        $('#special_inc_amount_error').html("");
    }

    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_special_increament';
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

$(document).on("click", ".spl_inc_deletemodal", function () {
  var spl_inc_id = $(this).data('id');
  alert(spl_inc_id);
  $(".modal-body #spl_inc_id_hidden").val(spl_inc_id);
});

$("#processdeletedata_spl_inc").click(function () {
    event.preventDefault();
    var spl_inc_id = $('#spl_inc_id_hidden').val();
    //alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {spl_inc_id: spl_inc_id},
        url: baseurl + 'admin/delete_special_increment',
        datatype: "html",
        success: function (data) {
            var parsedData = JSON.parse(data);
                console.log(parsedData);
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
        }
    });

});


//});
