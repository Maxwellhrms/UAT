$(document).on('change', "#pt_type_id", function () {
    var pt_type_id = $(this).val();
//    alert(pt_type_id);
    if (pt_type_id == 1) {//--->monthly
        $("#monthly_and_yearly_tab").show();
        $("#quaterly_tab").hide();
        $("#halfyearly_tab").hide();
    } else if (pt_type_id == 2) {//---->quaterly
        $("#quaterly_tab").show();
        $("#monthly_and_yearly_tab").hide();
        $("#halfyearly_tab").hide();
    } else if (pt_type_id == 3) {//---->halfyearly
        $("#halfyearly_tab").show();
        $("#monthly_and_yearly_tab").hide();
        $("#quaterly_tab").hide();
    } else if (pt_type_id == 4) {//---->yearly
        $("#monthly_and_yearly_tab").show();
        $("#quaterly_tab").hide();
        $("#halfyearly_tab").hide();
    }
});
//------Load States

$("#pt_company_id").change(function () {
    var pt_comp_id = $(this).val();
//    alert(pt_comp_id);
    if (pt_comp_id != 0 && pt_comp_id != "") {
//        pt_load_states(pt_comp_id, 0)
        load_pt_divisions(pt_comp_id, 0);
    } else {
               
        var option = "<option value=0>Select Division</option>";
        $("#pt_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#pt_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#pt_branch_id").empty().append(option);
    }
});
var pt_div_array = [];
var pt_selected_div;
function load_pt_divisions(pt_comp_id, pt_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': pt_comp_id, 'type': "PT"},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            pt_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (pt_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in pt_div_array) {
            var pt_div_array_index = pt_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (pt_selected_div == pt_div_array_index.mxd_id) {
                option += "<option value=" + pt_div_array_index.mxd_id + " selected>" + pt_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + pt_div_array_index.mxd_id + ">" + pt_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#pt_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#pt_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#pt_branch_id").empty().append(option);
}

//Get States
$("#pt_div_id").change(function () {
    var pt_comp_id = $("#pt_company_id").val();
    var pt_div_id = $(this).val();
//        alert(comp_id);
    if (pt_comp_id != 0 && pt_comp_id != "" && pt_div_id != 0 && pt_div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        pt_load_states(pt_comp_id, pt_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#pt_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#pt_branch_id").empty().append(option);
    }
});
//End Get States


var pt_states_array = [];
var pt_selected_state;
function pt_load_states(pt_comp_id,pt_div_id, pt_selected_state) {
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': pt_comp_id,'div_id':pt_div_id, 'type': "PT"},
        success: function (data) {
            console.log(data);
            pt_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (pt_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in pt_states_array) {
            var pt_states_array_index = pt_states_array[index];
//            console.log(pt_selected_state + '---' + pt_states_array_index.mxst_id);
            if (pt_selected_state == pt_states_array_index.mxst_id) {
                option += "<option value=" + pt_states_array_index.mxst_id + " selected>" + pt_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + pt_states_array_index.mxst_id + ">" + pt_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#pt_state_id").empty().append(option);

    option = "<option value=0>Select Branch</option>";
    $("#pt_branch_id").empty();
}
//------End Load States
//------Load Branches
$("#pt_state_id").change(function () {
    var pt_comp_id = $("#pt_company_id").val();
    var pt_div_id = $("#pt_div_id").val();
    var pt_state_id = $(this).val();
    if (pt_comp_id != 0 && pt_comp_id != "" && pt_div_id != 0 && pt_div_id != "" && pt_state_id != 0 && pt_state_id != "") {
        pt_load_branches(pt_comp_id,pt_div_id,pt_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#pt_branch_id").empty().append(option);
    }
});
var pt_branches_array = [];
var pt_selected_branch;
function pt_load_branches(pt_comp_id,pt_div_id,pt_state_id, pt_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id':pt_comp_id,'div_id':pt_div_id,'state_id': pt_state_id, 'type': 'PT'},
        success: function (data) {
            console.log(data);
            pt_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (pt_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in pt_branches_array) {
            var pt_branches_array_index = pt_branches_array[index];
            if (pt_selected_branch == pt_branches_array_index.mxb_id) {
                option += "<option value=" + pt_branches_array_index.mxb_id + " selected>" + pt_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + pt_branches_array_index.mxb_id + ">" + pt_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#pt_branch_id").empty().append(option);
}
//------End Load Branches
$("form#pt_statutory_form").submit(function (e) {
    e.preventDefault();
    var affect_date = $("#pt_affectdate").val();
    if (affect_date == "") {
        $('#pt_affectdate_error').html("Please Select Affect Date");
        $("#pt_affectdate").focus();
        return false;
    } else {
        $('#pt_affectdate_error').html("");
    }
//alert(affect_date);
//return false;
    var pt_company_id = $("#pt_company_id").val();
    if (pt_company_id == 0 || pt_company_id == "") {
        $("#pt_company_id").focus();
        $('#pt_company_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#pt_company_id_error').html("");
    }
    var pt_div_id = $("#pt_div_id").val();
    if (pt_div_id == 0 || pt_div_id == "") {
        $("#pt_div_id").focus();
        $('#pt_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#pt_div_id_error').html("");
    }

    var pt_state_id = $("#pt_state_id").val();
    if (pt_state_id == 0 || pt_state_id == "") {
        $("#pt_state_id").focus();
        $('#pt_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#pt_state_id_error').html("");
    }

    var pt_branch_id = $("#pt_branch_id").val();
    if (pt_branch_id == 0 || pt_branch_id == "") {
        $("#pt_branch_id").focus();
        $('#pt_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#pt_branch_id_error').html("");
    }

    var pt_in_no = $("#pt_in_no").val();
    if (pt_in_no == "") {
        $("#pt_in_no").focus();
        $('#pt_in_no_error').html("Please Enter PT in No");
        return false;
    } else {
        $('#pt_in_no_error').html("");
    }

    var pt_type_id = $("#pt_type_id").val();
    if (pt_type_id == "" || pt_type_id == "") {
        $("#pt_type_id").focus();
        $('#pt_type_id_error').html("Please Select PT Type");
        return false;
    } else {
        $('#pt_type_id_error').html("");
    }
//--------------CHECK PT TYPE
    if (pt_type_id == 1) {//------------>MONTH
        var pt_mfrom;
        var pt_mto;
        var pt_mamnt;
        var pt_m_from_flag = 0;
        var pt_m_to_flag = 0;
        var pt_m_amnt_flag = 0;
        $(".month_year_from").each(function () {
            pt_mfrom = $(this).val();
            if (pt_mfrom != "") {
                pt_m_from_flag = 1;
            }
        });
        $(".month_year_to").each(function () {
            pt_mto = $(this).val();
            if (pt_mto != "") {
                pt_m_to_flag = 1;
            }
        });
        $(".month_year_amnt").each(function () {
            pt_mamnt = $(this).val();
            if (pt_mamnt != "") {
                pt_m_amnt_flag = 1;
            }
        });
//    console.log("pt_m_from_flag ="+pt_m_from_flag+" pt_m_to_flag="+pt_m_to_flag+"pt_m_amnt_flag = "+pt_m_amnt_flag);
        if (pt_m_from_flag == 0 || pt_m_to_flag == 0 || pt_m_amnt_flag == 0) {
            alert("Please Enter Atleast One Record For PT Month Type");
            return false;
        }

    } else if (pt_type_id == 2) {//------------>Quaterly
        //-------------QUARTER-1
        var pt_q1from;
        var pt_q1to;
        var pt_q1amnt;
        var pt_q1_from_flag = 0;
        var pt_q1_to_flag = 0;
        var pt_q1_amnt_flag = 0;
        $(".q1_from").each(function () {
            pt_q1from = $(this).val();
            if (pt_q1from != "") {
                pt_q1_from_flag = 1;
            }
        });
        $(".q1_to").each(function () {
            pt_q1to = $(this).val();
            if (pt_q1to != "") {
                pt_q1_to_flag = 1;
            }
        });
        $(".q1_amnt").each(function () {
            pt_q1amnt = $(this).val();
            if (pt_q1amnt != "") {
                pt_q1_amnt_flag = 1;
            }
        });
//    console.log(pt_q1_from_flag+pt_q1_to_flag+pt_q1_amnt_flag);
        if (pt_q1_from_flag == 0 || pt_q1_to_flag == 0 || pt_q1_amnt_flag == 0) {
            alert("Please Enter Atleast One Record For Quater-1 Type");
            return false;
        }
        //-------------END QUARTER-1
        //-------------QUARTER-2
        var pt_q2from;
        var pt_q2to;
        var pt_q2amnt;
        var pt_q2_from_flag = 0;
        var pt_q2_to_flag = 0;
        var pt_q2_amnt_flag = 0;
        $(".q2_from").each(function () {
            pt_q2from = $(this).val();
            if (pt_q2from != "") {
                pt_q2_from_flag = 1;
            }
        });
        $(".q2_to").each(function () {
            pt_q2to = $(this).val();
            if (pt_q2to != "") {
                pt_q2_to_flag = 1;
            }
        });
        $(".q2_amnt").each(function () {
            pt_q2amnt = $(this).val();
            if (pt_q2amnt != "") {
                pt_q2_amnt_flag = 1;
            }
        });
        if (pt_q2_from_flag == 0 || pt_q2_to_flag == 0 || pt_q2_amnt_flag == 0) {
            alert("Please Enter Atleast One Record For Quater-2 Type");
            return false;
        }
        //-------------END QUARTER-2
        //-------------QUARTER-3
        var pt_q3from;
        var pt_q3to;
        var pt_q3amnt;
        var pt_q3_from_flag = 0;
        var pt_q3_to_flag = 0;
        var pt_q3_amnt_flag = 0;
        $(".q3_from").each(function () {
            pt_q3from = $(this).val();
            if (pt_q3from != "") {
                pt_q3_from_flag = 1;
            }
        });
        $(".q3_to").each(function () {
            pt_q3to = $(this).val();
            if (pt_q3to != "") {
                pt_q3_to_flag = 1;
            }
        });
        $(".q3_amnt").each(function () {
            pt_q3amnt = $(this).val();
            if (pt_q3amnt != "") {
                pt_q3_amnt_flag = 1;
            }
        });
        if (pt_q3_from_flag == 0 || pt_q3_to_flag == 0 || pt_q3_amnt_flag == 0) {
            alert("Please Enter Atleast One Record For Quater-3 Type");
            return false;
        }
        //-------------END QUARTER-3
        //-------------QUARTER-4
        var pt_q4from;
        var pt_q4to;
        var pt_q4amnt;
        var pt_q4_from_flag = 0;
        var pt_q4_to_flag = 0;
        var pt_q4_amnt_flag = 0;
        $(".q4_from").each(function () {
            pt_q4from = $(this).val();
            if (pt_q4from != "") {
                pt_q4_from_flag = 1;
            }
        });
        $(".q4_to").each(function () {
            pt_q4to = $(this).val();
            if (pt_q4to != "") {
                pt_q4_to_flag = 1;
            }
        });
        $(".q4_amnt").each(function () {
            pt_q4amnt = $(this).val();
            if (pt_q4amnt != "") {
                pt_q4_amnt_flag = 1;
            }
        });
        if (pt_q4_from_flag == 0 || pt_q4_to_flag == 0 || pt_q4_amnt_flag == 0) {
            alert("Please Enter Atleast One Record For Quater-4 Type");
            return false;
        }
        //-------------END QUARTER-4

    }
//--------------END CHECK PT TYPE




    var pt_emp_type = $("#pt_emp_type").val();
    if (pt_emp_type == "" || pt_emp_type == 0) {
        $("#pt_emp_type").focus();
        $('#pt_emp_type_error').html("Please Select PT Emp Type");
        return false;
    }




    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_pt_statutory';
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
                alert('Successfully Saved The PT Statutory...');
                setTimeout(function () {
//                    window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/pt_master_li";
                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company,Division,State,Branch....');
                return false;
            }else if(data == "LESS"){
                alert("You Cant Save Affect Date Less Than The Previous Existing Records");
                return false;
            }else if(data == "same"){
                alert("You Cant Feed The Affect Date As the Same Month And Year Of Previous Record");
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$("#processdeletedata_pt").click(function () {
    event.preventDefault();
    var del_pt_id = $('#del_pt_id').val();

    $.ajax({
        async: false,
        type: "POST",
        data: {pt_id: del_pt_id},
        url: baseurl + 'admin/delete_pt_statutory',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                window.location.reload();
            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".pt_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #pt_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_pt_id").val(id);
});


//});
