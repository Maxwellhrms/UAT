//$(document).ready(function () {
//------Load States
$("#arear_cmp_id").change(function () {
    var arear_cmp_id = $(this).val();
//        alert(arear_cmp_id);
    if (arear_cmp_id != 0 && arear_cmp_id != "") {
//        arear_inc_load_states(arear_cmp_id, 0)
          load_arear_inc_divisions(arear_cmp_id,0);
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#arear_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#arear_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#arear_branch_id").empty().append(option);
    }
});

var arear_inc_div_array = [];
var arear_inc_selected_div;
function load_arear_inc_divisions(arear_cmp_id, arear_inc_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': arear_cmp_id, 'type': ""},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            arear_inc_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (arear_inc_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in arear_inc_div_array) {
            var arear_inc_div_array_index = arear_inc_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (arear_inc_selected_div == arear_inc_div_array_index.mxd_id) {
                option += "<option value=" + arear_inc_div_array_index.mxd_id + " selected>" + arear_inc_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + arear_inc_div_array_index.mxd_id + ">" + arear_inc_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#arear_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#arear_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#arear_branch_id").empty().append(option);
}
//END DIVISION


//START STATES
$("#arear_div_id").change(function () {
    var arear_cmp_id = $("#arear_cmp_id").val();
    var arear_div_id = $(this).val();
    //        alert(comp_id);
    if (arear_cmp_id != 0 && arear_cmp_id != "" && arear_div_id != 0 && arear_div_id != "") {
    //        load_esi_states(esi_comp_id, 0)
        arear_inc_load_states(arear_cmp_id, arear_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#arear_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#arear_branch_id").empty().append(option);
    }
});

var arear_inc_states_array = [];
var arear_inc_selected_state;
function arear_inc_load_states(arear_cmp_id,arear_div_id, lwf_selected_state) {
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': arear_cmp_id,'div_id':arear_div_id, 'type': ""},
        success: function (data) {
//                    console.log(data);
            arear_inc_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (arear_inc_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in arear_inc_states_array) {
            var arear_inc_states_array_index = arear_inc_states_array[index];
//                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (arear_inc_selected_state == arear_inc_states_array_index.mxst_id) {
                option += "<option value=" + arear_inc_states_array_index.mxst_id + " selected>" + arear_inc_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + arear_inc_states_array_index.mxst_id + ">" + arear_inc_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#arear_state_id").empty().append(option);
        
    option = "<option value=0>Select Branch</option>";
    $("#arear_branch_id").empty().append(option);
}
//------End Load States
//------Load Branches
$("#arear_state_id").change(function () {
    var arear_cmp_id = $("#arear_cmp_id").val();
    var arear_div_id = $("#arear_div_id").val();
    var arear_state_id = $(this).val();
    if (arear_cmp_id != 0 && arear_cmp_id != "" && arear_div_id != 0 && arear_div_id != "" && arear_state_id != 0 && arear_state_id != "") {
        arear_inc_load_branches(arear_cmp_id,arear_div_id,arear_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#arear_branch_id").empty().append(option);
    }
});
var arear_inc_branches_array = [];
var arear_inc_selected_branch;
function arear_inc_load_branches(arear_cmp_id,arear_div_id,arear_state_id, lwf_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id':arear_cmp_id,'div_id':arear_div_id,'state_id': arear_state_id, 'type': ''},
        success: function (data) {
//                    console.log(data);
            arear_inc_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (arear_inc_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in arear_inc_branches_array) {
            var arear_inc_branches_array_index = arear_inc_branches_array[index];
            if (arear_inc_selected_branch == arear_inc_branches_array_index.mxb_id) {
                option += "<option value=" + arear_inc_branches_array_index.mxb_id + " selected>" + arear_inc_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + arear_inc_branches_array_index.mxb_id + ">" + arear_inc_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#arear_branch_id").empty().append(option);
}
//------End Load Branches


//------LOAD EMP
$("#arear_branch_id").change(function(){
			var comp_id = $("#arear_cmp_id").val();
			var div_id = $("#arear_div_id").val();
			var state_id = $("#arear_state_id").val();
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
                            $("#area_emp_code").empty();
                            $("#area_emp_code").append('<option value="">Select Employee</option>');
                            for (index in parse_data) {
                                var auth_data = parse_data[index];
                                console.log(auth_data);
                                var auth_emp_code = auth_data['mxemp_emp_id'];
                                var auth_emp_type = auth_data['mxemp_emp_type'];
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
                                var opt_val = auth_emp_code +'~'+ auth_emp_name+'~'+ auth_dept_code+'~'+ auth_dept_name+'~'+ auth_emp_type;
                                
                                $("#area_emp_code").append('<option value="' + opt_val + '">' + opt_data + '</option>');
                            }

                        } else {
                            $("#area_emp_code").empty();
                            $("#area_emp_code").append('<option value="">Select Employee</option>');
                            alert("No Employees Found In the Selected Branch");
                            return false;                            
                        }
                    }
                });	
			}else{
				$("#area_emp_code").empty();
                $("#area_emp_code").append('<option value="">Select Employee</option>');
                alert("No Employees Found In the Selected Branch");
                return false;        
			}
		});
//------END LOAD EMP

//--------GET EMPLOYEE DATA
$("#area_emp_code").change(function(){
    var emp_code_data = $(this).val();
    var ex = emp_code_data.split("~");
    var emp_code = ex[0];
    
    var mainurl = baseurl + 'admin/getArearsIncreamnent';
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: {emp_code:emp_code},
        success: function (data) {
            console.log(data);
            $("#arear_inc_table").html(data);
            // return false;
            
        }
        // cache: false,
        // contentType: false,
        // processData: false
    });
});
//--------END GET EMPLOYEE DATA

$("form#arears_inc_form").submit(function (e) {
    e.preventDefault();
    // alert();
    var arear_cmp_id = $("#arear_cmp_id").val();
    if (arear_cmp_id == 0 || arear_cmp_id == "") {
        $("#arear_cmp_id").focus();
        $('#arear_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#arear_cmp_id_error').html("");
    }
    var arear_div_id = $("#arear_div_id").val();
    if (arear_div_id == 0 || arear_div_id == "") {
        $("#arear_div_id").focus();
        $('#arear_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#arear_div_id_error').html("");
    }

    var arear_state_id = $("#arear_state_id").val();
    if (arear_state_id == 0 || arear_state_id == "") {
        $("#arear_state_id").focus();
        $('#arear_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#arear_state_id_error').html("");
    }

    var arear_branch_id = $("#arear_branch_id").val();
    if (arear_branch_id == 0 || arear_branch_id == "") {
        $("#arear_branch_id").focus();
        $('#arear_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#arear_branch_id_error').html("");
    }
    var area_emp_code = $("#area_emp_code").val();
    if (area_emp_code == 0 || area_emp_code == "") {
        $("#area_emp_code").focus();
        $('#area_emp_code_error').html("Please Select Emp Code");
        return false;
    } else {
        $('#area_emp_code_error').html("");
    }

    var arear_start_date = $("#arear_start_date").val();
    if (arear_start_date == "") {
        $("#arear_start_date").focus();
        $('#arear_start_date_error').html("Please Select Start Date");
        return false;
    } else {
        $('#arear_start_date_error').html("");
    }

    var arear_affect_date = $("#arear_affect_date").val();
    if (arear_affect_date == "") {
        $("#arear_affect_date").focus();
        $('#arear_affect_date_error').html("Please Select Affect Date");
        return false;
    } else {
        $('#arear_affect_date_error').html("");
    }

    var arear_amount = $("#arear_amount").val();
    if (arear_amount == "") {
        $("#arear_amount").focus();
        $('#arear_amount_error').html("Please Enter Amount");
        return false;
    } else {
        $('#arear_amount_error').html("");
    }

    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_arrear_increament';
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
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$(document).on("click", ".arrear_deletemodal", function () {
  var deletedetails = $(this).data('id');
  $(".modal-body #arrear_id").val(deletedetails);
});

$("#processdeletedata_arrear").click(function () {
    event.preventDefault();
    var arrear_id = $('#arrear_id').val();
    //alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {arrear_id: arrear_id},
        url: baseurl + 'admin/delete_arrear',
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
