$(document).ready(function () {
    
    $("#company_id").change(function () {
    var trns_comp_id = $(this).val();
       // alert(trns_comp_id);
    if (trns_comp_id != 0 && trns_comp_id != "") {
//        load_esi_states(trns_comp_id, 0)
        load_trns_divisions(trns_comp_id, 0);
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#branch_id").empty().append(option);
    }
});

var trns_div_array = [];
var trns_selected_div;
function load_trns_divisions(trns_comp_id, trns_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': trns_comp_id},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            trns_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (trns_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in trns_div_array) {
            var trns_div_array_index = trns_div_array[index];
//                console.log(trns_selected_div +'---'+ trns_div_array_index.mxd_id);
            if (trns_selected_div == trns_div_array_index.mxd_id) {
                option += "<option value=" + trns_div_array_index.mxd_id + " selected>" + trns_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + trns_div_array_index.mxd_id + ">" + trns_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#branch_id").empty().append(option);
}

$("#div_id").change(function () {
    var trns_comp_id = $("#company_id").val();
    var div_id = $(this).val();
//        alert(comp_id);
    if (trns_comp_id != 0 && trns_comp_id != "" && div_id != 0 && div_id != "") {
//        load_esi_states(trns_comp_id, 0)
        load_esi_states(trns_comp_id, div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#branch_id").empty().append(option);
    }
});

var esi_states_array = [];
var esi_selected_state;
function load_esi_states(trns_comp_id, div_id, esi_selected_state) {
//    alert(div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': trns_comp_id, 'div_id': div_id},
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

    $("#state_id").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#branch_id").empty().append(option);
}
//------End Load States
//------Load Branches
$("#state_id").change(function () {
    var trns_comp_id = $("#company_id").val();
    var div_id = $("#div_id").val();
    var state_id = $(this).val();
    if (trns_comp_id != 0 && trns_comp_id != "" && div_id != 0 && div_id != "" && state_id != 0 && state_id != "") {
        load_esi_branches(trns_comp_id, div_id, state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#branch_id").empty().append(option);
    }
});
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(trns_comp_id, div_id, state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id': trns_comp_id, 'div_id': div_id, 'state_id': state_id},
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

    $("#branch_id").empty().append(option);
}
//------End Load Branches
    //------LOAD EMP

	//------END LOAD EMP
		$("#branch_id").change(function(){
			var comp_id = $("#company_id").val();
			var div_id = $("#div_id").val();
			var state_id = $("#state_id").val();
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
                            $("#employeeid").empty();
                            $("#employeeid").append('<option value="">Select Employee</option>');
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
                                $("#employeeid").append('<option value="' + opt_val + '">' + opt_data + '</option>');
                            }

                        } else {
                            $("#employeeid").empty();
                            $("#employeeid").append('<option value="">Select Employee</option>');
                            alert("No Employees Found In the Selected Branch");
                            return false;                            
                        }
                    }
                });	
			}else{
				$("#employeeid").empty();
                $("#employeeid").append('<option value="">Select Employee</option>');
                alert("No Employees Found In the Selected Branch");
                return false;        
			}
		});
    //-------GET EMPLOYEE DATA
    //$("#search_emp_id_btn").click(function () {
	$("#employeeid").change(function(){		
        $("#employeeiderror").html(' ');
        var emp_id_data = $("#employeeid").val();
		var sp = emp_id_data.split('~');
		var emp_id = sp[0];		
        //if (emp_id.length >= 5) {
//            alert(emp_id)

            $.ajax({
                url: baseurl + 'admin/checkemployeeexists',
                type: 'POST',
                data: {emp_id: emp_id},
                success: function (data) {
                    var parse_data = JSON.parse(data);
//						      console.log(parse_data);
                    if (parse_data.length <= 0) {
                        alert("Invalid Employee Id");
                        return false;
                    } else {

                        console.log(parse_data);
                        var emp_name = parse_data[0].mxemp_emp_fname + " " + parse_data[0].mxemp_emp_lname;
                        $("#emp_name").val(emp_name);

                        $("#cmpname_trnasfer_from").empty();
                        $("#cmpname_trnasfer_from").append("<option value=" + parse_data[0].mxemp_emp_comp_code + "@~@" + parse_data[0].mxcp_name.replace(' ', '_') + " selected>" + parse_data[0].mxcp_name + "</option>");
                        $("#divname_trnasfer_from").empty();
                        $("#divname_trnasfer_from").append("<option value=" + parse_data[0].mxemp_emp_division_code + "@~@" + parse_data[0].mxd_name.replace(' ', '_') + " selected>" + parse_data[0].mxd_name + "</option>");
                        $("#cmpstate_trnasfer_from").empty();
                        $("#cmpstate_trnasfer_from").append("<option value=" + parse_data[0].mxemp_emp_state_code + "@~@" + parse_data[0].mxst_state.replace(' ', '_') + " selected>" + parse_data[0].mxst_state + "</option>");
                        $("#brname_trnasfer_from").empty();
                        $("#brname_trnasfer_from").append("<option value=" + parse_data[0].mxemp_emp_branch_code + "@~@" + parse_data[0].mxb_name.replace(' ', '_') + " selected>" + parse_data[0].mxb_name + "</option>");
                        $("#deptname_trnasfer_from").empty();
                        $("#deptname_trnasfer_from").append("<option value=" + parse_data[0].mxemp_emp_dept_code + "@~@" + parse_data[0].mxdpt_name.replace(' ', '_') + " selected>" + parse_data[0].mxdpt_name + "</option>");
                    }

                }

            });
            
             var comp_id = $("#company_id").val();
             $.ajax({
              url: baseurl + 'Admin/getdepartmentData',
              type: 'POST',
              data: { companyid: comp_id },
              success: function (data) {
                    var parse_data = JSON.parse(data);
                 if (parse_data.length > 0) {
                    option = "<option value=''>Select Department</option>";
                    for (index in parse_data) {
                        var prm_dept_array_index = parse_data[index];
                        // console.log(prm_dept_array_index);
                        option += "<option value=" + prm_dept_array_index.mxdpt_id + "@~@" + prm_dept_array_index.mxdpt_name.replace(' ', '_') +">" + prm_dept_array_index.mxdpt_name + "</option>"
                        
        //                   console.log(option);
                    }
                } else {
                    option = "<option value=0>Select Department</option>";
                }
        
                $("#deptname_trnasfer_to").empty().append(option);
              },
            });
        //} else {

          //  // alert(emp_code);
            //$("#employeeiderror").html("Emp Code Length Should be Greather Or equal to 5 letters");
        //}

    });
	//-------END GET EMPLOYEE DATA
    $("#divname_trnasfer_to").change(function () {

		
        var divname_trnasfer_to = $("#divname_trnasfer_to").val();
        var divname_trnasfer_to = $(this).val();

        var cmpname_trnasfer_from = $("#cmpname_trnasfer_from").val();

//        alert(cmpname_trnasfer_from);
        if (cmpname_trnasfer_from != 0 && cmpname_trnasfer_from != "" && divname_trnasfer_to != 0 && divname_trnasfer_to != "") {
//        load_esi_states(trns_comp_id, 0)
            load_trnasfer_to_states(cmpname_trnasfer_from, divname_trnasfer_to, 0);
        } else {
            var option = "<option value=''>Select State</option>";
            $("#cmpstate_trnasfer_to").empty().append(option);

            var option = "<option value=''>Select Branch</option>";
            $("#brname_trnasfer_to").empty().append(option);
        }
    });

    var transfer_states_array = [];
    var transfer_selected_state;
    function load_trnasfer_to_states(cmpname_trnasfer_from, divname_trnasfer_to, transfer_selected_state) {
//    alert(cmpname_trnasfer_from);
        $.ajax({
            url: baseurl + "admin/getstates_based_on_branch_master",
            type: "post",
            async: false,
            data: {'comp_id': cmpname_trnasfer_from, 'div_id': divname_trnasfer_to, 'type': ""},
            success: function (data) {
                transfer_states_array = JSON.parse(data);
                console.log(transfer_states_array);

            }
        });

        var option;

        if (transfer_states_array.length > 0) {
            option = "<option value=''>Select State</option>";
            for (index in transfer_states_array) {
                var transfer_states_array_index = transfer_states_array[index];

                if (transfer_selected_state == transfer_states_array_index.mxst_id) {
                    option += "<option value=" + transfer_states_array_index.mxst_id + "@~@" + transfer_states_array_index.mxst_state.replace(' ', '_') + " selected>" + transfer_states_array_index.mxst_state + "</option>"
                } else {
                    option += "<option value=" + transfer_states_array_index.mxst_id + "@~@" + transfer_states_array_index.mxst_state.replace(' ', '_') +">" + transfer_states_array_index.mxst_state + "</option>"
                }

            }
        } else {
            option = "<option value=''>Select State</option>";
        }

        $("#cmpstate_trnasfer_to").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#brname_trnasfer_to").empty().append(option);
    }
//------End Load States
//------Load Branches
    $("#cmpstate_trnasfer_to").change(function () {
        var cmpname_trnasfer_from = $("#cmpname_trnasfer_from").val();
        var divname_trnasfer_to = $("#divname_trnasfer_to").val();
        var cmpstate_trnasfer_to = $(this).val();
        if (cmpname_trnasfer_from != 0 && cmpname_trnasfer_from != "" && divname_trnasfer_to != 0 && divname_trnasfer_to != "" && cmpstate_trnasfer_to != 0 && cmpstate_trnasfer_to != "") {
            load_trnasfer_branches(cmpname_trnasfer_from, divname_trnasfer_to, cmpstate_trnasfer_to, 0)
        } else {
            var option = "<option value=''>Select Branch</option>";
            $("#brname_trnasfer_to").empty().append(option);
        }
    });
    var transfer_branches_array = [];
    var transfer_selected_branch;
    function load_trnasfer_branches(trns_comp_id, div_id, cmpstate_trnasfer_to, transfer_selected_branch) {

        $.ajax({
            url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
            type: "post",
            async: false,
            data: {'comp_id': trns_comp_id, 'div_id': div_id, 'state_id': cmpstate_trnasfer_to, 'type': ''},
            success: function (data) {
//                    console.log(data);
                transfer_branches_array = JSON.parse(data);

            }
        });


        var option;
        if (transfer_branches_array.length > 0) {
            option = "<option value=''>Select Branch</option>";
            for (index in transfer_branches_array) {
                var transfer_branches_array_index = transfer_branches_array[index];
                if (transfer_selected_branch == transfer_branches_array_index.mxb_id) {
                    option += "<option value=" + transfer_branches_array_index.mxb_id + "@~@" + transfer_branches_array_index.mxb_name.replace(' ', '_') +" selected>" + transfer_branches_array_index.mxb_name + "</option>"
                } else {
                    option += "<option value=" + transfer_branches_array_index.mxb_id + "@~@" + transfer_branches_array_index.mxb_name.replace(' ', '_') +">" + transfer_branches_array_index.mxb_name + "</option>"
                }
//                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Branch</option>";
        }

        $("#brname_trnasfer_to").empty().append(option);
    }
//------End Load Branches

//------AUTHORISATIONS
//---------------------------NEW BY SHABABU(25-01-2021)
    $(".auth_type").change(function () {
        var attr_id = $(this).attr("id");
        var auth_type_id = $(this).val();
        var sp = attr_id.split('_');
        var id_no = sp[1];
        var branch_name = $("#brname_trnasfer_to").val();
        var comp_id = $("#cmpname_trnasfer_from").val();


        if (branch_name != "" && branch_name != null && comp_id != "" && comp_id != null) {
//            alert(branch_name);
            if (auth_type_id != "") {
                $.ajax({
                    url: baseurl + 'admin/get_departments_based_on_auth_type',
                    type: 'POST',
                    data: {comp_id: comp_id, branch_id: branch_name, auth_type: auth_type_id},
                    success: function (data) {
                        console.log(data);
                        var parse_data = JSON.parse(data);
                        if (parse_data.length > 0) {
                            $("#authdept_" + id_no).empty();
                            $("#empname_" + id_no).empty();
                            $("#authdept_" + id_no).append('<option value="">Select Department</option>');
                            for (index in parse_data) {
                                var dept_data = parse_data[index];
                                var dept_code = dept_data['mxdpt_id'];
                                var dept_name = dept_data['mxdpt_name'];
                                $("#authdept_" + id_no).append('<option value="' + dept_code + '">' + dept_name + '</option>');
                            }

                        } else {
                            $("#authdept_" + id_no).empty();
                            $("#empname_" + id_no).empty();
                            if (auth_type_id == 1) {//Branch
                                alert("No Departments Found In the Selected Branch");
                                return false;
                            } else if (auth_type_id == 2) {//----->HEAD OFFICE
                                alert("No Departments Found In the Head Office Branch");
                                return false;
                            } else if (auth_type_id == 3) {//-----> HR
                                alert("There Is No HR Departments Found In the Head Office Branch");
                                return false;
                            } else if (auth_type_id == 4) {//------>DIRECTOR
                                alert("There Is No Director Department Found In the Head Office Branch");
                                return false;
                            }
                        }
                    }
                });
            } else {
                $("#authdept_" + id_no).empty();
                $("#empname_" + id_no).empty();
            }
        } else {
            alert("Please Select Transfer From Company OR Trnasfer To Branch....");
            $("#authdept_" + id_no).empty();
            $("#empname_" + id_no).empty();
        }

    });
    //----------END GET DEPARTMENTS
    //----------GET EMPLOYEES BASED ON THE DEPT NAME
    $(".auth_dept").change(function () {
        var dept_id = $(this).val();

        var branch_name = $("#brname_trnasfer_to").val();
        var comp_id = $("#cmpname_trnasfer_from").val();
//        alert(dept_id);
        var dept_attr_id = $(this).attr("id");
        var sp = dept_attr_id.split('_');
        var id_no = sp[1];
        var emp_name_id = "#empname_" + id_no;
        var auth_type_id = $("#authtype_" + id_no).val();

        if (branch_name != "" && branch_name != null && comp_id != "" && comp_id != null) {
            if (dept_id != "" && dept_id != null) {
                $.ajax({
                    url: baseurl + 'admin/get_employee_info_based_on_departments',
                    type: 'POST',
                    data: {comp_id: comp_id, branch_id: branch_name, dept_id: dept_id, auth_type: auth_type_id},
                    success: function (data) {
                        console.log(data);
                        var parse_data = JSON.parse(data);
                        if (parse_data.length > 0) {
                            $(emp_name_id).empty();
                            $(emp_name_id).append('<option value="">Select Authorisation</option>');
                            for (index in parse_data) {
                                var auth_data = parse_data[index];
                                var auth_emp_code = auth_data['mxemp_emp_id'];
                                var auth_emp_name = auth_data['mxemp_emp_lname'] + " " + auth_data['mxemp_emp_fname'];
                                var auth_comp_code = auth_data['mxemp_emp_comp_code'];
                                var auth_comp_name = auth_data['mxcp_name'];
                                var auth_branch_code = auth_data['mxemp_emp_branch_code'];
                                var auth_branch_name = auth_data['mxb_name'];
                                var auth_dept_code = auth_data['mxemp_emp_dept_code'];
                                var auth_dept_name = auth_data['mxdpt_name'];
                                var auth_desg_code = auth_data['mxemp_emp_desg_code'];
                                var auth_desg_name = auth_data['mxdesg_name'];
                                var auth_state_id = auth_data['mxemp_emp_state_code'];
                                var auth_state_name = auth_data['mxst_state'];
                                var auth_div_id = auth_data['mxemp_emp_division_code'];
                                var auth_div_name = auth_data['mxd_name'];
                                var opt_data = auth_emp_code + " - " + auth_emp_name + " - " + auth_desg_name
                                var opt_val = auth_emp_code + "~" + auth_comp_code + "~" +auth_comp_name+ "~" + auth_branch_code+ "~" +auth_branch_name + "~" + auth_dept_code+ "~" +auth_dept_name+'~'+auth_state_id+'~'+auth_state_name+'~'+auth_div_id+'~'+auth_div_name
                                $(emp_name_id).append('<option value="' + opt_val + '">' + opt_data + '</option>');
                            }

                        } else {
                            $("#authdept_" + id_no).empty();
                            $("#empname_" + id_no).empty();
                            if (auth_type_id == 1) {//Branch
                                alert("No Employees Found In the Selected Branch");
                                return false;
                            } else if (auth_type_id == 2) {//----->HEAD OFFICE
                                alert("No Employees Found In the Head Office Branch");
                                return false;
                            } else if (auth_type_id == 3) {//-----> HR
                                alert("There Is No Employees in HR Departments In the Head Office Branch");
                                return false;
                            } else if (auth_type_id == 4) {//------>DIRECTOR
                                alert("There Is No Employees in Director Department In the Head Office Branch");
                                return false;
                            }
                        }
                    }
                });
            } else {
                $("#authdept_" + id_no).empty();
                $("#empname_" + id_no).empty();
            }
        } else {
            alert("Please Select Company Name Transfer From AND Branch Transfer To....");
            $("#authdept_" + id_no).empty();
            $("#empname_" + id_no).empty();
        }
    });
    //----------END GET EMPLOYEES BASED ON THE DEPT NAME
//---------------------------END NEW BY SHABABU(25-01-2021)
//---------END AUTHORISATIONS

//-----SAVE
    $("form#processtransfer").submit(function (e) {
        e.preventDefault();

        var employeeid = $("#employeeid").val();
        if (employeeid == "") {
            $("#employeeid").focus();
            $('#employeeiderror').html("Please Enter Employee Id...");
            return false;
        } else {
            $('#employeeiderror').html("");
        }
        
        // var transfer_affect_date = $("#transfer_affect_date").val();
        // if (transfer_affect_date == "") {
        //     $("#transfer_affect_date").focus();
        //     $('#transfer_affect_date_error').html("Please Select Affect Date...");
        //     return false;
        // } else {
        //     $('#transfer_affect_date_error').html("");
        // }


        var remarks = $("#remarks").val();
        if (remarks == "") {
            $("#remarks").focus();
            $('#remarks_error').html("Please Enter Remarks");
            return false;
        } else {
            $('#remarks_error').html("");
        }

        var cmpname_trnasfer_from = $("#cmpname_trnasfer_from").val();
        if (cmpname_trnasfer_from == "") {
            $("#cmpname_trnasfer_from").focus();
            $('#cmpname_trnasfer_from_error').html("Please Select Company Transfer From");
            return false;
        } else {
            $('#cmpname_trnasfer_from_error').html("");
        }

        var divname_trnasfer_from = $("#divname_trnasfer_from").val();
        if (divname_trnasfer_from == "") {
            $("#divname_trnasfer_from").focus();
            $('#divname_trnasfer_from_error').html("Please Select Division Transfer From");
            return false;
        } else {
            $('#divname_trnasfer_from_error').html("");
        }

        var cmpstate_trnasfer_from = $("#cmpstate_trnasfer_from").val();
        if (cmpstate_trnasfer_from == "") {
            $("#cmpstate_trnasfer_from").focus();
            $('#cmpstate_trnasfer_from_error').html("Please Select State Transfer From");
            return false;
        } else {
            $('#cmpstate_trnasfer_from_error').html("");
        }

        var brname_trnasfer_from = $("#brname_trnasfer_from").val();
        if (brname_trnasfer_from == "") {
            $("#brname_trnasfer_from").focus();
            $('#brname_trnasfer_from_error').html("Please select Transfer Branch Name");
            return false;
        } else {
            $('#brname_trnasfer_from_error').html("");
        }
       
        var deptname_trnasfer_from = $("#deptname_trnasfer_from").val();
        if (deptname_trnasfer_from == "") {
            $("#deptname_trnasfer_from").focus();
            $('#deptname_trnasfer_from_error').html("Please select Transfer Department Name");
            return false;
        } else {
            $('#deptname_trnasfer_from_error').html("");
        }

        var emprelievingdate = $("#emprelievingdate").val();
        if (emprelievingdate == "") {
            $("#emprelievingdate").focus();
            $('#emprelievingdateerror').html("Please Enter Enter Employee Relieving Date");
            return false;
        } else {
            $('#emprelievingdateerror').html("");
        }
        var esi_relievingdate = $("#esi_relievingdate").val();
        if (esi_relievingdate == "") {
            $("#esi_relievingdate").focus();
            $('#esi_relievingdate_error').html("Please Enter Enter ESI Relieving Date");
            return false;
        } else {
            $('#esi_relievingdate_error').html("");
        }
//-------------END FROM
//-------------TO
        var divname_trnasfer_to = $("#divname_trnasfer_to").val();
        if (divname_trnasfer_to == "") {
            $("#divname_trnasfer_to").focus();
            $('#divname_trnasfer_to_error').html("Please Select Division Transfer TO");
            return false;
        } else {
            $('#divname_trnasfer_to_error').html("");
        }

        var cmpstate_trnasfer_to = $("#cmpstate_trnasfer_to").val();
        if (cmpstate_trnasfer_to == "") {
            $("#cmpstate_trnasfer_to").focus();
            $('#emptransferstateerror').html("Please Select State Transfer To");
            return false;
        } else {
            $('#emptransferstateerror').html("");
        }

        var brname_trnasfer_to = $("#brname_trnasfer_to").val();
        if (brname_trnasfer_to == "") {
            $("#brname_trnasfer_to").focus();
            $('#brname_trnasfer_to_error').html("Please Select Branch Transfer To");
            return false;
        } else {
            $('#brname_trnasfer_to_error').html("");
        }
        
        var deptname_trnasfer_to = $("#deptname_trnasfer_to").val();
        if (deptname_trnasfer_to == "") {
            $("#deptname_trnasfer_to").focus();
            $('#deptname_trnasfer_to_error').html("Please Select Department Transfer To");
            return false;
        } else {
            $('#deptname_trnasfer_to_error').html("");
        }
        var empjoiningdate = $("#empjoiningdate").val();
        if (empjoiningdate == "") {
            $("#empjoiningdate").focus();
            $('#empjoiningdateerror').html("Please Enter Employee Joining Date");
            return false;
        } else {
            $('#empjoiningdateerror').html("");
        }

        var esi_joiningdate = $("#esi_joiningdate").val();
        if (esi_joiningdate == "") {
            $("#esi_joiningdate").focus();
            $('#esi_joiningdate_error').html("Please Enter Enter ESI Joining Date");
            return false;
        } else {
            $('#esi_joiningdate_error').html("");
        }
        
//-------------END TO


        if (brname_trnasfer_from == brname_trnasfer_to) {
            alert('Employee Transfer Branch From and Transfer Branch To Should Not be Same');
            return false;
        }
        mainurl = baseurl + 'admin/saveemployeetransferdetails';
        var formData = new FormData(this);
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                if (data == 200) {
                    alert('Successfully');
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }else if(data == 240){
                    alert("No Employee Details Found In The Transfers Table");
                    return false;
                } else {
                    alert('Failed To Save Please TryAgain later');
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
//-----END SAVE


//-----NEW BY SHABABU(25-01-2021)
function get_branch_emp_details(){
    var branch_id = $("#brname").val();
    var auth_branch_id = $("#authorizationbr").val();
    if(branch_id != "" && auth_branch_id != ""){
        
    }
}
//-----END NEW BY SHABABU(25-01-2021)






});



