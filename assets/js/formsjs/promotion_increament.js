$(document).ready(function () {
    //------Load DIVISIONS
    $("#promotion_company_id").change(function () {
        var prm_comp_id = $(this).val();
            // alert(prm_comp_id);
        if (prm_comp_id != 0 && prm_comp_id != "") {
            //load_esi_states(prm_comp_id, 0)
            load_prmotion_divisions(prm_comp_id, 0);
        } else {
            var option = "<option value=0>Select Division</option>";
            $("#promotion_div_id").empty().append(option);
    
            var option = "<option value=0>Select State</option>";
            $("#promotion_state_id").empty().append(option);
    
    
            var option = "<option value=0>Select Branch</option>";
            $("#promotion_branch_id").empty().append(option);
        }
    });

    var prm_div_array = [];
    var prm_selected_div;
    function load_prmotion_divisions(prm_comp_id, prm_selected_div) {
        $.ajax({
            url: baseurl + "admin/getdivisions_based_on_branch_master",
            type: "post",
            async: false,
            data: {'comp_id': prm_comp_id},
            success: function (data) {
    //                    console.log("ESI DIVISIONS");
    //                    console.log(data);
    //                    console.log("END ESI DIVISIONS");
                prm_div_array = JSON.parse(data);
    //                            console.log(states_array);
    
            }
        });
    
        var option;
    //        console.log(states_array);
        if (prm_div_array.length > 0) {
            option = "<option value=0>Select Division</option>";
            for (index in prm_div_array) {
                var prm_div_array_index = prm_div_array[index];
    //                console.log(prm_selected_div +'---'+ prm_div_array_index.mxd_id);
                if (prm_selected_div == prm_div_array_index.mxd_id) {
                    option += "<option value=" + prm_div_array_index.mxd_id + " selected>" + prm_div_array_index.mxd_name + "</option>"
                } else {
                    option += "<option value=" + prm_div_array_index.mxd_id + ">" + prm_div_array_index.mxd_name + "</option>"
                }
    //                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Division</option>";
        }
    
        $("#promotion_div_id").empty().append(option);
    
        var option = "<option value=0>Select State</option>";
        $("#promotion_state_id").empty().append(option);
    
    
        var option = "<option value=0>Select Branch</option>";
        $("#promotion_branch_id").empty().append(option);
    }
    //------END Load DIVISIONS
    
    //------Load States
    $("#promotion_div_id").change(function () {
        var prm_comp_id = $("#promotion_company_id").val();
        var prm_div_id = $(this).val();
        //        alert(comp_id);
        if (prm_comp_id != 0 && prm_comp_id != "" && prm_div_id != 0 && prm_div_id != "") {
        //  load_esi_states(prm_comp_id, 0)
            load_prm_states(prm_comp_id, prm_div_id, 0);
        } else {
            var option = "<option value=0>Select State</option>";
            $("#promotion_state_id").empty().append(option);
    
            var option = "<option value=0>Select Branch</option>";
            $("#promotion_branch_id").empty().append(option);
        }
    });
    var prm_states_array = [];
    var prm_selected_state;
    function load_prm_states(prm_comp_id, prm_div_id, prm_esi_selected_state) {
//    alert(div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': prm_comp_id, 'div_id': prm_div_id},
        success: function (data) {
//            console.log("ESI STATES");
//            console.log(data);
//            console.log("END ESI STATES");
            prm_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (prm_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in prm_states_array) {
            var prm_states_array_index = prm_states_array[index];
//                console.log(selected_state +'---'+ prm_states_array_index.mxst_id);
            if (prm_esi_selected_state == prm_states_array_index.mxst_id) {
                option += "<option value=" + prm_states_array_index.mxst_id + " selected>" + prm_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + prm_states_array_index.mxst_id + ">" + prm_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#promotion_state_id").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#promotion_branch_id").empty().append(option);
}
    //------End Load States
    
    //------Load Branches
    $("#promotion_state_id").change(function () {
        var prm_comp_id = $("#promotion_company_id").val();
        var prm_div_id = $("#promotion_div_id").val();
        var prm_state_id = $(this).val();
        if (prm_comp_id != 0 && prm_comp_id != "" && prm_div_id != 0 && prm_div_id != "" && prm_state_id != 0 && prm_state_id != "") {
            load_esi_branches(prm_comp_id, prm_div_id, prm_state_id, 0)
        } else {
            var option = "<option value=0>Select Branch</option>";
            $("#promotion_branch_id").empty().append(option);
        }
    });
    var prm_branches_array = [];
    var prm_selected_branch;
    function load_esi_branches(prm_comp_id, prm_div_id, prm_state_id, prm_selected_branch) {
    
        $.ajax({
            url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
            type: "post",
            async: false,
            data: {'comp_id': prm_comp_id, 'div_id': prm_div_id, 'state_id': prm_state_id},
            success: function (data) {
    //                    console.log(data);
                prm_branches_array = JSON.parse(data);
    
            }
        });
    
    
        var option;
        if (prm_branches_array.length > 0) {
            option = "<option value=0>Select Branch</option>";
            for (index in prm_branches_array) {
                var prm_branches_array_index = prm_branches_array[index];
                if (prm_selected_branch == prm_branches_array_index.mxb_id) {
                    option += "<option value=" + prm_branches_array_index.mxb_id + " selected>" + prm_branches_array_index.mxb_name + "</option>"
                } else {
                    option += "<option value=" + prm_branches_array_index.mxb_id + ">" + prm_branches_array_index.mxb_name + "</option>"
                }
    //                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Branch</option>";
        }
    
        $("#promotion_branch_id").empty().append(option);
    }
    //------End Load Branches
    //------LOAD EMP

	//------END LOAD EMP
	$("#promotion_branch_id").change(function(){
			var comp_id = $("#promotion_company_id").val();
			var div_id = $("#promotion_div_id").val();
			var state_id = $("#promotion_state_id").val();
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
                                
                                $("#promotion_employeeid").append('<option value="' + opt_val + '">' + opt_data + '</option>');
                            }

                        } else {
                            $("#promotion_employeeid").empty();
                            $("#promotion_employeeid").append('<option value="">Select Employee</option>');
                            alert("No Employees Found In the Selected Branch");
                            return false;                            
                        }
                    }
                });	
			}else{
				$("#promotion_employeeid").empty();
                $("#promotion_employeeid").append('<option value="">Select Employee</option>');
                alert("No Employees Found In the Selected Branch");
                return false;        
			}
		});
    //-------GET EMPLOYEE DATA
    //$("#search_emp_id_btn").click(function () {
	$("#promotion_employeeid").change(function(){		
        $("#employeeiderror").html(' ');
        var emp_id_data = $("#promotion_employeeid").val();
		var sp = emp_id_data.split('~');
		var emp_id = sp[0];		
		get_promotion_inc_table(emp_id);
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
                        // var emp_name = parse_data[0].mxemp_emp_fname + " " + parse_data[0].mxemp_emp_lname;
                        // $("#emp_name").val(emp_name);

                        $("#cmpname_prm_from").empty();
                        $("#cmpname_prm_from").append("<option value=" + parse_data[0].mxemp_emp_comp_code + "@~@" + parse_data[0].mxcp_name.replace(' ', '_') + " selected>" + parse_data[0].mxcp_name + "</option>");
                        $("#divname_prm_from").empty();
                        $("#divname_prm_from").append("<option value=" + parse_data[0].mxemp_emp_division_code + "@~@" + parse_data[0].mxd_name.replace(' ', '_') + " selected>" + parse_data[0].mxd_name + "</option>");
                        $("#cmpstate_prm_from").empty();
                        $("#cmpstate_prm_from").append("<option value=" + parse_data[0].mxemp_emp_state_code + "@~@" + parse_data[0].mxst_state.replace(' ', '_') + " selected>" + parse_data[0].mxst_state + "</option>");
                        $("#brname_prm_from").empty();
                        $("#brname_prm_from").append("<option value=" + parse_data[0].mxemp_emp_branch_code + "@~@" + parse_data[0].mxb_name.replace(' ', '_') + " selected>" + parse_data[0].mxb_name + "</option>");
                        $("#desgname_prm_from").empty();
                        $("#desgname_prm_from").append("<option value=" + parse_data[0].mxemp_emp_desg_code + "@~@" + parse_data[0].mxdesg_name.replace(' ', '_') + " selected>" + parse_data[0].mxdesg_name + "</option>");
                        $("#deptname_prm_from").empty();
                        $("#deptname_prm_from").append("<option value=" + parse_data[0].mxemp_emp_dept_code + "@~@" + parse_data[0].mxdpt_name.replace(' ', '_') + " selected>" + parse_data[0].mxdpt_name + "</option>");
                        $("#gradename_prm_from").empty();
                        $("#gradename_prm_from").append("<option value=" + parse_data[0].mxemp_emp_grade_code + "@~@" + parse_data[0].mxgrd_name.replace(' ', '_') + " selected>" + parse_data[0].mxgrd_name + "</option>");
                        
                    }

                }

            });
            var comp_id = $("#promotion_company_id").val();
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
        
                $("#deptname_prm_to").empty().append(option);
              },
            });
        //} else {

          //  // alert(emp_code);
            //$("#employeeiderror").html("Emp Code Length Should be Greather Or equal to 5 letters");
        //}

    });
	//-------END GET EMPLOYEE DATA
	
    $("#divname_prm_to").change(function () {
        var divname_prm_to = $(this).val();
        var cmpname_prm_from = $("#cmpname_prm_from").val();
//        alert(cmpname_prm_from);
        if (cmpname_prm_from != 0 && cmpname_prm_from != "" && divname_prm_to != 0 && divname_prm_to != "") {
//        load_esi_states(trns_comp_id, 0)
            load_prm_to_states(cmpname_prm_from, divname_prm_to, 0);
        } else {
            var option = "<option value=''>Select State</option>";
            $("#cmpstate_prm_to").empty().append(option);

            var option = "<option value=''>Select Branch</option>";
            $("#brname_prm_to").empty().append(option);
        }
    });

    var prm_states_array = [];
    var prm_selected_state;
    function load_prm_to_states(cmpname_prm_from, divname_prm_to, prm_selected_state) {
//    alert(cmpname_trnasfer_from);
        $.ajax({
            url: baseurl + "admin/getstates_based_on_branch_master",
            type: "post",
            async: false,
            data: {'comp_id': cmpname_prm_from, 'div_id': divname_prm_to, 'type': ""},
            success: function (data) {
                prm_states_array = JSON.parse(data);
                console.log(prm_states_array);

            }
        });

        var option;

        if (prm_states_array.length > 0) {
            option = "<option value=''>Select State</option>";
            for (index in prm_states_array) {
                var prm_states_array_index = prm_states_array[index];

                if (prm_selected_state == prm_states_array_index.mxst_id) {
                    option += "<option value=" + prm_states_array_index.mxst_id + "@~@" + prm_states_array_index.mxst_state.replace(' ', '_') + " selected>" + prm_states_array_index.mxst_state + "</option>"
                } else {
                    option += "<option value=" + prm_states_array_index.mxst_id + "@~@" + prm_states_array_index.mxst_state.replace(' ', '_') +">" + prm_states_array_index.mxst_state + "</option>"
                }

            }
        } else {
            option = "<option value=''>Select State</option>";
        }
        // console.log(option);
        $("#cmpstate_prm_to").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#brname_prm_to").empty().append(option);
    }
    //------End Load States
//------Load Branches
    $("#cmpstate_prm_to").change(function () {
        var cmpname_prm_from = $("#cmpname_prm_from").val();
        var divname_prm_to = $("#divname_prm_to").val();
        var cmpstate_prm_to = $(this).val();
        if (cmpname_prm_from != 0 && cmpname_prm_from != "" && divname_prm_to != 0 && divname_prm_to != "" && cmpstate_prm_to != 0 && cmpstate_prm_to != "") {
            load_trnasfer_branches(cmpname_prm_from, divname_prm_to, cmpstate_prm_to, 0)
            load_prm_desg(cmpname_prm_from,0,"#desg_prm_to")
            load_prm_grades(cmpname_prm_from,0,"#grade_prm_to")
        } else {
            var option = "<option value=''>Select Branch</option>";
            $("#brname_trnasfer_to").empty().append(option);
            
            var option = "<option value=''>Select Designation</option>";
            $("#desg_prm_to").empty().append(option);
            
            var option = "<option value=''>Select Grade</option>";
            $("#grade_prm_to").empty().append(option);
        }
    });
    var prm_branches_array = [];
    var prm_selected_branch;
    function load_trnasfer_branches(prm_comp_id, div_id, cmpstate_prm_to, prm_selected_branch) {

        $.ajax({
            url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
            type: "post",
            async: false,
            data: {'comp_id': prm_comp_id, 'div_id': div_id, 'state_id': cmpstate_prm_to, 'type': ''},
            success: function (data) {
//                    console.log(data);
                prm_branches_array = JSON.parse(data);

            }
        });


        var option;
        if (prm_branches_array.length > 0) {
            option = "<option value=''>Select Branch</option>";
            for (index in prm_branches_array) {
                var prm_branches_array_index = prm_branches_array[index];
                if (prm_selected_branch == prm_branches_array_index.mxb_id) {
                    option += "<option value=" + prm_branches_array_index.mxb_id + "@~@" + prm_branches_array_index.mxb_name.replace(' ', '_') +" selected>" + prm_branches_array_index.mxb_name + "</option>"
                } else {
                    option += "<option value=" + prm_branches_array_index.mxb_id + "@~@" + prm_branches_array_index.mxb_name.replace(' ', '_') +">" + prm_branches_array_index.mxb_name + "</option>"
                }
//                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Branch</option>";
        }

        $("#brname_prm_to").empty().append(option);
    }
//------End Load Branches

//-------DESIGNATION
    var prm_desg_array = [];
    var prm_selected_desg;
    function load_prm_desg(cmpname_prm_from,prm_selected_desg,id){
        $.ajax({
            url: baseurl + "admin/getdesignationdetails",
            type: "post",
            async: false,
            data: {'cmp_id': cmpname_prm_from, 'flag': 'json'},
            success: function (data) {
                    console.log(data);
                prm_desg_array = JSON.parse(data);

            }
        });


        var option;
        if (prm_desg_array.length > 0) {
            option = "<option value=''>Select Branch</option>";
            for (index in prm_desg_array) {
                var prm_desg_array_index = prm_desg_array[index];
                if (prm_selected_desg == prm_desg_array.mxdesg_id) {
                    option += "<option value=" + prm_desg_array_index.mxdesg_id + "@~@" + prm_desg_array_index.mxdesg_name.replace(' ', '_') +" selected>" + prm_desg_array_index.mxdesg_name + "</option>"
                } else {
                    option += "<option value=" + prm_desg_array_index.mxdesg_id + "@~@" + prm_desg_array_index.mxdesg_name.replace(' ', '_') +">" + prm_desg_array_index.mxdesg_name + "</option>"
                }
//                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Designation</option>";
        }

        $(id).empty().append(option);
    }
//-------END DESIGNATION

//-------GRADES
var prm_grades_array = [];
var prm_selected_grade;
function load_prm_grades(cmpname_prm_from,prm_selected_grade,id){
        $.ajax({
            url: baseurl + "admin/getgradedetails",
            type: "post",
            async: false,
            data: {'cmp_id': cmpname_prm_from, 'flag': 'json'},
            success: function (data) {
                    console.log(data);
                prm_grades_array = JSON.parse(data);

            }
        });


        var option;
        if (prm_grades_array.length > 0) {
            option = "<option value=''>Select Branch</option>";
            for (index in prm_grades_array) {
                var prm_grades_array_index = prm_grades_array[index];
                if (prm_selected_grade == prm_grades_array.mxgrd_id) {
                    option += "<option value=" + prm_grades_array_index.mxgrd_id + "@~@" + prm_grades_array_index.mxgrd_name.replace(' ', '_') +" selected>" + prm_grades_array_index.mxgrd_name + "</option>"
                } else {
                    option += "<option value=" + prm_grades_array_index.mxgrd_id + "@~@" + prm_grades_array_index.mxgrd_name.replace(' ', '_') +">" + prm_grades_array_index.mxgrd_name + "</option>"
                }
//                   console.log(option);
            }
        } else {
            option = "<option value=0>Select Grade</option>";
        }

        $(id).empty().append(option);
    }
//-------END GRADES

//--------GET EMPLOYEE DATA
function get_promotion_inc_table(emp_code){
    var mainurl = baseurl + 'admin/getPromotionIncreamnent';
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: {"emp_code":emp_code},
        success: function (data) {
            console.log(data);
            $("#promotion_inc_table").html(data);
            // return false;
            
        }
        
    });
}
//--------END GET EMPLOYEE DATA

//------AUTHORISATIONS
//---------------------------NEW BY SHABABU(25-01-2021)
    $(".prom_auth_type").change(function () {
        var attr_id = $(this).attr("id");
        var auth_type_id = $(this).val();
        var sp = attr_id.split('_');
        var id_no = sp[2];
        var branch_name = $("#brname_prm_to").val();
        var comp_id = $("#cmpname_prm_from").val();


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
                            $("#prom_authdept_" + id_no).empty();
                            $("#prom_empname_" + id_no).empty();
                            $("#prom_authdept_" + id_no).append('<option value="">Select Department</option>');
                            for (index in parse_data) {
                                var dept_data = parse_data[index];
                                var dept_code = dept_data['mxdpt_id'];
                                var dept_name = dept_data['mxdpt_name'];
                                // alert("#prom_authdept_" + id_no);
                                $("#prom_authdept_" + id_no).append('<option value="' + dept_code + '">' + dept_name + '</option>');
                            }

                        } else {
                            $("#prom_authdept_" + id_no).empty();
                            $("#prom_empname_" + id_no).empty();
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
                $("#prom_authdept_" + id_no).empty();
                $("#prom_empname_" + id_no).empty();
            }
        } else {
            alert("Please Select Promotion From Company OR Promotion To Branch....");
            $("#prom_authdept_" + id_no).empty();
            $("#prom_empname_" + id_no).empty();
        }

    });
    //----------END GET DEPARTMENTS
    //----------GET EMPLOYEES BASED ON THE DEPT NAME
    $(".prom_auth_dept").change(function () {
        var dept_id = $(this).val();

        var branch_name = $("#brname_prm_to").val();
        var comp_id = $("#cmpname_prm_from").val();
//        alert(dept_id);
        var dept_attr_id = $(this).attr("id");
        var sp = dept_attr_id.split('_');
        var id_no = sp[2];
        var emp_name_id = "#prom_empname_" + id_no;
        var auth_type_id = $("#prom_authtype_" + id_no).val();

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
                            $("#prom_authdept_" + id_no).empty();
                            $("#prom_empname_" + id_no).empty();
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
                $("#prom_authdept_" + id_no).empty();
                $("#prom_empname_" + id_no).empty();
            }
        } else {
            alert("Please Select Company Name Promotion From AND Branch Promotion To....");
            $("#prom_authdept_" + id_no).empty();
            $("#prom_empname_" + id_no).empty();
        }
    });
    //----------END GET EMPLOYEES BASED ON THE DEPT NAME
//---------------------------END NEW BY SHABABU(25-01-2021)
//---------END AUTHORISATIONS


//-----SAVE
    $("form#promotion_increament_form").submit(function (e) {
        e.preventDefault();

        var promotion_company_id = $("#promotion_company_id").val();
        if (promotion_company_id == "" || promotion_company_id == 0) {
            $("#promotion_company_id").focus();
            $('#promotion_company_id_error').html("Please Select Company Id...");
            return false;
        } else {
            $('#promotion_company_id_error').html("");
        }
        var promotion_div_id = $("#promotion_div_id").val();
        if (promotion_div_id == "" || promotion_div_id == 0) {
            $("#promotion_div_id").focus();
            $('#promotion_div_id_error').html("Please Select Division Id...");
            return false;
        } else {
            $('#promotion_div_id_error').html("");
        }
        var promotion_state_id = $("#promotion_state_id").val();
        if (promotion_state_id == "" || promotion_state_id == 0) {
            $("#promotion_state_id").focus();
            $('#promotion_state_id_error').html("Please Select State Id...");
            return false;
        } else {
            $('#promotion_state_id_error').html("");
        }
        var promotion_branch_id = $("#promotion_branch_id").val();
        if (promotion_branch_id == "" || promotion_branch_id == 0) {
            $("#promotion_branch_id").focus();
            $('#promotion_branch_id_error').html("Please Select Branch Id...");
            return false;
        } else {
            $('#promotion_branch_id_error').html("");
        }
        var promotion_employeeid = $("#promotion_employeeid").val();
        if (promotion_employeeid == "" || promotion_employeeid == 0) {
            $("#promotion_employeeid").focus();
            $('#promotion_employeeid_error').html("Please Select Employee Id...");
            return false;
        } else {
            $('#promotion_employeeid_error').html("");
        }


        // var promotion_start_date = $("#promotion_start_date").val().trim();
        // if (promotion_start_date == "") {
        //     $("#promotion_start_date").focus();
        //     $('#promotion_start_date_error').html("Please Select Start Date");
        //     return false;
        // } else {
        //     $('#promotion_start_date_error').html("");
        // }
        var promotion_affect_date = $("#promotion_affect_date").val().trim();
        if (promotion_affect_date == "") {
            $("#promotion_affect_date").focus();
            $('#promotion_affect_date_error').html("Please Select Affect Date");
            return false;
        } else {
            $('#promotion_affect_date_error').html("");
        }
        var promotion_amount = $("#promotion_amount").val().trim();
        if (promotion_amount == "") {
            $("#promotion_amount").focus();
            $('#promotion_amount_error').html("Please Enter Amount");
            return false;
        } else {
            $('#promotion_amount_error').html("");
        }

        var cmpname_prm_from = $("#cmpname_prm_from").val();
        if (cmpname_prm_from == "" || cmpname_prm_from ==0) {
            $("#cmpname_prm_from").focus();
            $('#cmpname_prm_from_error').html("Please Select Company Promotion From");
            return false;
        } else {
            $('#cmpname_prm_from_error').html("");
        }

        var divname_prm_from = $("#divname_prm_from").val();
        if (divname_prm_from == "" || divname_prm_from == 0) {
            $("#divname_prm_from").focus();
            $('#divname_prm_from_error').html("Please Select Division Promotion From");
            return false;
        } else {
            $('#divname_prm_from_error').html("");
        }

        var cmpstate_prm_from = $("#cmpstate_prm_from").val();
        if (cmpstate_prm_from == "" || cmpstate_prm_from == 0) {
            $("#cmpstate_prm_from").focus();
            $('#cmpstate_prm_from_error').html("Please Select State Promotion From");
            return false;
        } else {
            $('#cmpstate_prm_from_error').html("");
        }

        var brname_prm_from = $("#brname_prm_from").val();
        if (brname_prm_from == "" || brname_prm_from ==0) {
            $("#brname_prm_from").focus();
            $('#brname_prm_from_error').html("Please Select Promotion Branch From");
            return false;
        } else {
            $('#brname_prm_from_error').html("");
        }

        var desgname_prm_from = $("#desgname_prm_from").val();
        if (desgname_prm_from == "" || desgname_prm_from == 0) {
            $("#desgname_prm_from").focus();
            $('#desgname_prm_from_error').html("Please Select Designation From");
            return false;
        } else {
            $('#desgname_prm_from_error').html("");
        }
        var deptname_prm_from = $("#desgname_prm_from").val();
        if (deptname_prm_from == "" || deptname_prm_from == 0) {
            $("#deptname_prm_from").focus();
            $('#deptname_prm_from_error').html("Please Select Department From");
            return false;
        } else {
            $('#deptname_prm_from_error').html("");
        }
        var gradename_prm_from = $("#gradename_prm_from").val();
        if (gradename_prm_from == "" || gradename_prm_from ==0) {
            $("#gradename_prm_from").focus();
            $('#gradename_prm_from_error').html("Please Select Grade From");
            return false;
        } else {
            $('#gradename_prm_from_error').html("");
        }
//-------------END FROM
//-------------TO
        var divname_prm_to = $("#divname_prm_to").val();
        if (divname_prm_to == "" || divname_prm_to == 0) {
            $("#divname_prm_to").focus();
            $('#divname_prm_to_error').html("Please Select Division Promotion To");
            return false;
        } else {
            $('#divname_prm_to_error').html("");
        }

        var cmpstate_prm_to = $("#cmpstate_prm_to").val();
        if (cmpstate_prm_to == "" || cmpstate_prm_to == 0) {
            $("#cmpstate_prm_to").focus();
            $('#cmpstate_prm_to_error').html("Please Select State Promotion To");
            return false;
        } else {
            $('#cmpstate_prm_to_error').html("");
        }

        var brname_prm_to = $("#brname_prm_to").val();
        if (brname_prm_to == "" || brname_prm_to ==0) {
            $("#brname_prm_to").focus();
            $('#brname_prm_to_error').html("Please Select Promotion Branch To");
            return false;
        } else {
            $('#brname_prm_to_error').html("");
        }

        var desg_prm_to = $("#desg_prm_to").val();
        if (desg_prm_to == "" || desg_prm_to == 0) {
            $("#desg_prm_to").focus();
            $('#desg_prm_to_error').html("Please Select Designation To");
            return false;
        } else {
            $('#desg_prm_to_error').html("");
        }
        
        var deptname_prm_to = $("#deptname_prm_to").val();
        if (deptname_prm_to == "" || deptname_prm_to == 0) {
            $("#deptname_prm_to").focus();
            $('#deptname_prm_to_error').html("Please Select Department To");
            return false;
        } else {
            $('#deptname_prm_to_error').html("");
        }
        
        var grade_prm_to = $("#grade_prm_to").val();
        if (grade_prm_to == "" || grade_prm_to ==0) {
            $("#grade_prm_to").focus();
            $('#grade_prm_to_error').html("Please Select Grade To");
            return false;
        } else {
            $('#grade_prm_to_error').html("");
        }
        
//-------------END TO


        if (brname_prm_from == brname_prm_to && desgname_prm_from == desg_prm_to) {
            alert('Employee Promotion Branch From and To  && Designation From and To Should Not be Same');
            return false;
        }
        
        //#AUTHORISATION VALIDATION
        var auth_type_error_count = 0;
        var auth_dept_error_count = 0;
        var auth_emp_name_error_count = 0;
        
        if($("#is_authorisation").prop("checked") == true){
            $(".prom_auth_type").each(function(){
                var auth_type_check = $(this).val();
                if(auth_type_check != 0 && auth_type_check != ""){
                    auth_type_error_count = 1;
                }
            });
            $(".prom_auth_dept").each(function(){
                var auth_dept_check = $(this).val();
                if(auth_dept_check != 0 && auth_dept_check != ""){
                    auth_dept_error_count = 1;
                }
            });
            $(".prom_emp_name").each(function(){
                var auth_emp_name_check = $(this).val();
                if(auth_emp_name_check != 0 && auth_emp_name_check != ""){
                    auth_emp_name_error_count = 1;
                }
            });
            if(auth_type_error_count != 1 || auth_dept_error_count != 1 || auth_emp_name_error_count != 1){
                alert("Please Select Atleast One Authorisation...");
                return false;
            }
        }
        //#END AUTHORISATION VALIDATION
        
        
        mainurl = baseurl + 'admin/save_promotion_increament';
        var formData = new FormData(this);
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                var parsedData = JSON.parse(data);
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



