//---NEW BY SHABABU

//INCOME TYPE
$(document).on("click", ".inc_type", function () {
    var count = 0
    $(".inc_type").each(function () {
        var is_checked = $(this).prop("checked");
        if (is_checked == true) {
            count = count + 1
            if (count == 2) {
                $(this).prop("checked", false);
                // alert("You Cant Check Both isCTC & isEarnings for One Income");
                alert("You Cant Check More Than one checkbox...");
                return false;
            }
        }
    });
});
//---END NEW BY SHABABU

// FORM SUBMIT


$("#income_cmp_id").change(function(){
    var inc_cmp_id = $(this).val();
    var option = '<option value="0">Select Emp Type</option>';
    if(inc_cmp_id !=0 && inc_cmp_id != ""){
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: inc_cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if(emp_type_parse_data.length > 0){
                    for(index in emp_type_parse_data){
                        var emp_type_index = emp_type_parse_data[index];
                        option += '<option value=' + emp_type_index.mxemp_ty_id + '~'+emp_type_index.mxemp_ty_table_name+'~'+ emp_type_index.mxemp_ty_supplementry_table_name +' >' + emp_type_index.mxemp_ty_name + '</option>';
                    }
                }
                
            }
        });
    }
    $("#income_emp_type_id").html(option);
});

$("form#income_type_form").submit(function (e) {
    e.preventDefault();

    var income_cmp_id = $("#income_cmp_id").val();
    if (income_cmp_id == 0 || income_cmp_id == "") {
        $("#income_cmp_id").focus();
        $('#income_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#income_cmp_id_error').html("");
    }
    var income_emp_type_id = $("#income_emp_type_id").val();
    if (income_emp_type_id == 0 || income_emp_type_id == "") {
        $("#income_emp_type_id").focus();
        $('#income_emp_type_id_error').html("Please Select Income Type Name");
        return false;
    } else {
        $('#income_emp_type_id_error').html("");
    }

    var income_name = $("#income_name").val();
    if (income_name == "") {
        $("#income_name").focus();
        $('#income_name_error').html("Please Enter Income Name");
        return false;
    } else {
        $('#income_name_error').html("");
    }

    //-------------NEW BY SHABABU(11-02-2021)
    // var flag = 0;
    // $(".inc_type").each(function () {
    //     inc_type = $(this).prop("checked");
    //     if (inc_type == true) {
    //         flag = 1;
    //     }
    // });
    // if (flag == 0) {
    //     $("#inc_type_error").html("Please Select Either CTC or Earnings..");
    //     return false;
    // } else {
    //     $("#inc_type_error").html(" ");
    // }

    //-------------END NEW BY SHABABU(11-02-2021)

    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }



    if (page_type == 1) {
        var mainurl = baseurl + 'admin/save_income_type';
    } else if (page_type == 2) {
        var mainurl = baseurl + 'admin/update_income_type';
    }

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            // console.log(data);
            //      return false;
            if (data == 200) {
                alert('Successfully Saved Income Details');
                setTimeout(function () {
                    //                        window.location.reload();
                    window.location.href = baseurl + "admin/income_deduction_reasons/income_type";
                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company....');
                return false;
            }else if(data == "512"){
                alert("Table Name Not Exist In the Employeement Table Please Create Employeement Again....");
                return false;
            }else if(data == "3024"){
                alert("Coloumn Name Alreay Exist So Please Try To Create Again....");
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
// END FORM SUBMIT


//DELETE
$(document).on("click", ".income_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
    //alert(x)
    var id = x[0];
    var companyname = x[1];
    var Income_name = x[2];
    $(".modal-body #inc_del_comp").html(companyname + '(' + Income_name + ')');
    $(".modal-body #inc_id_hidden").val(id);
});
$("#processdeletedata_income").click(function () {
    event.preventDefault();
    var inc_id_hidden = $('#inc_id_hidden').val();

    $.ajax({
        async: false,
        type: "POST",
        data: { income_id: inc_id_hidden },
        url: baseurl + 'admin/delete_income_type',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                //                    window.location.reload();
                window.location.href = baseurl + "admin/income_deduction_reasons/income_type";

                //                window.location.href = baseurl + "admin/statutorymaster/esi_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});
//END DELETE
//----END INCOME TYPE

//DEDUCTION TYPE
$("#deduction_cmp_id").change(function(){
    var inc_cmp_id = $(this).val();
    var option = '<option value="0">Select Emp Type</option>';
    if(inc_cmp_id !=0 && inc_cmp_id != ""){
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: inc_cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if(emp_type_parse_data.length > 0){
                    for(index in emp_type_parse_data){
                        var emp_type_index = emp_type_parse_data[index];
                        option += '<option value=' + emp_type_index.mxemp_ty_id + '>' + emp_type_index.mxemp_ty_name + '</option>';
                    }
                }
                
            }
        });
    }
    $("#deduction_emp_type_id").html(option);
});
$("form#deduction_type_form").submit(function (e) {
    e.preventDefault();

    var deduction_cmp_id = $("#deduction_cmp_id").val();
    if (deduction_cmp_id == 0 || deduction_cmp_id == "") {
        $("#deduction_cmp_id").focus();
        $('#deduction_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#deduction_cmp_id_error').html("");
    }
    var deduction_emp_type_id = $("#deduction_emp_type_id").val();
    if (deduction_emp_type_id == 0 || deduction_emp_type_id == "") {
        $("#deduction_emp_type_id").focus();
        $('#deduction_emp_type_id_error').html("Please Select Deduction Emp Type");
        return false;
    } else {
        $('#deduction_emp_type_id_error').html("");
    }

    var deduction_name = $("#deduction_name").val();
    if (deduction_name == "") {
        $("#deduction_name").focus();
        $('#deduction_name_error').html("Please Enter Deduction Name");
        return false;
    } else {
        $('#deduction_name_error').html("");
    }


    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }



    if (page_type == 1) {
        var mainurl = baseurl + 'admin/save_deduction_type';
    } else if (page_type == 2) {
        var mainurl = baseurl + 'admin/update_deduction_type';
    }

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            // console.log(data);
            //      return false;
            if (data == 200) {
                alert('Successfully');
                setTimeout(function () {
                    //                        window.location.reload();
                    window.location.href = baseurl + "admin/income_deduction_reasons/deduction_type";
                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company....');
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
// END FORM SUBMIT


//DELETE
$(document).on("click", ".deduction_del", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
    //alert(x)
    var id = x[0];
    var companyname = x[1];
    var deduction_name = x[2];
    $(".modal-body #ded_del_comp").html(companyname + '(' + deduction_name + ')');
    $(".modal-body #ded_id_hidden").val(id);
});

$("#processdeletedata_deduction").click(function () {
    event.preventDefault();
    var ded_id_hidden = $('#ded_id_hidden').val();

    $.ajax({
        async: false,
        type: "POST",
        data: { deduction_id: ded_id_hidden },
        url: baseurl + 'admin/delete_deduction_type',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                //                    window.location.reload();
                window.location.href = baseurl + "admin/income_deduction_reasons/deduction_type";

                //                window.location.href = baseurl + "admin/statutorymaster/esi_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});
//END DELETE
//----END DEDUCTION TYPE

//----------PAY STRUCTURE
var employer_sno = 2;
// var employee_sno = 2;
var income_heads_array = [];


$(document).ready(function () {

    //-------------END EMPLOYER ADD MORE
    $(".employer_cont_add_more").click(function () {
        // console.log(income_heads_array);
        var cmp_id = $("#pay_str_cmpid").find(':selected').data("cmp_id");
        var emp_type_id = $("#emp_type_name").find(':selected').data('emp_type_id');
        
        // alert("employer_sno ="+employer_sno + " -- " + "cmp_id ==" + cmp_id + " ,emp_type_id ="+ emp_type_id)

        if (emp_type_id != 0 && emp_type_id != "" && emp_type_id != undefined && cmp_id != 0 && cmp_id != "" && cmp_id != undefined) {

            var html_data = '<tr id="employer_tr_' + employer_sno + '">';
            html_data += '<td>';
            html_data += '<select class="select2 form-control employer_inc_head" name="employer_inc_head_' + employer_sno + '" id="employer_inc_head_' + employer_sno + '" style="width: 100%;">';
            html_data += '<option value="" data-inc_head_id="">Select Income Head</option>';
            if (income_heads_array.length > 0) {
                for (index in income_heads_array) {
                    income_heads_index = income_heads_array[index];
                    html_data += "<option value=" + income_heads_index.mxincm_id + "~" + income_heads_index.mxincm_name.replace(" ", '-') + " data-inc_head_id=" + income_heads_index.mxincm_id + ">" + income_heads_index.mxincm_name + "</option>";
                }
            }
            html_data += '</select>';

            html_data += '<input type="hidden" name="employer_hid[]" value="' + employer_sno + '">';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<input type="text" class="form- control numbersonly_with_dot employer_perc" name="employer_perc_' + employer_sno + '" id="employer_perc_' + employer_sno + '" class="employer_perc">';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_vh_' + employer_sno + '" id="employer_vh_' + employer_sno + '" class="employer_vh">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_pf_' + employer_sno + '" id="employer_pf_' + employer_sno + '" class="employer_pf">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_esi_' + employer_sno + '" id="employer_esi_' + employer_sno + '" class="employer_esi">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox" align="center">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_pt_' + employer_sno + '" id="employer_pt_' + employer_sno + '" class="employer_pt">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_bns_' + employer_sno + '" id="employer_bns_' + employer_sno + '" class="employer_bns">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox" align="center">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_lwf_' + employer_sno + '" id="employer_lwf_' + employer_sno + '" class="employer_lwf">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox" align="center">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_gratuity_' + employer_sno + '" id="employer_gratuity_' + employer_sno + '" class="employer_gratuity">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox" align="center">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_lta_' + employer_sno + '" id="employer_lta_' + employer_sno + '" class="employer_lta">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            html_data += '<td>';
            html_data += '<div class="checkbox" align="center">';
            html_data += '<label>';
            html_data += '<input type="checkbox" name="employer_mediclaim_' + employer_sno + '" id="employer_mediclaim_' + employer_sno + '" class="employer_mediclaim">';
            html_data += '</label>';
            html_data += '</div>';
            html_data += '</td>';
            // html_data += '<td>';
            // html_data += '<div class="checkbox" align="center">';
            // html_data += '<label>';
            // html_data += '<input type="checkbox" name="employer_staipend_' + employer_sno + '" id="employer_staipend_' + employer_sno + '" class="employer_mediclaim">';
            // html_data += '</label>';
            // html_data += '</div>';
            // html_data += '</td>';
            html_data += '</tr>';
        } else {
            alert("Please Select Company And Emp Type..");
            return false;
        }
        // console.log(html_data);
        $(".employer_cont_tbody").append(html_data);
        employer_sno++;

    });
});
//-------------END EMPLOYER ADD MORE


//-------------EMPLOYEE ADD MORE
/*
$(".employee_cont_add_more").click(function () {
    var cmp_id = $("#pay_str_cmpid").find(':selected').data("cmp_id");
    var emp_type_id = $("#emp_type_name").find(':selected').data('emp_type_id');

    if (emp_type_id != 0 && emp_type_id != "" && emp_type_id != undefined && cmp_id != 0 && cmp_id != "" && cmp_id != undefined) {
        var employee_html_data = '<tr id="employee_tr_' + employee_sno + '">';
        employee_html_data += '<td>';
        employee_html_data += '<select class="select2 form-control" style="width: 100%;" id="employee_inc_head_' + employee_sno + '" class="employee_inc_head" name="employee_inc_head_' + employee_sno + '">';
        employee_html_data += '<option value="" data-inc_head_id="">Select Income Head</option>';
        if (income_heads_array.length > 0) {
            for (index in income_heads_array) {
                income_heads_index = income_heads_array[index];
                employee_html_data += "<option value=" + income_heads_index.mxincm_id + "~" + income_heads_index.mxincm_name.replace(" ", '-') + " data-inc_head_id=" + income_heads_index.mxincm_id + ">" + income_heads_index.mxincm_name + "</option>";
            }
        }
        employee_html_data += '</select>';
        employee_html_data += '</td>';
        employee_html_data += '<input type="hidden" name="employee_hid[]" value="' + employee_sno + '">';
        employee_html_data += '<td>';
        employee_html_data += '<input class="form-control" type="text" name="employee_perc_' + employee_sno + '" id="employee_perc_' + employee_sno + '" class="employee_perc" > ';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_vh_' + employee_sno + '" id="employee_vh_' + employee_sno + '" class="employee_vh">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_pf_' + employee_sno + '" id="employee_pf_' + employee_sno + '" class="employee_pf"> ';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_esi_' + employee_sno + '" id="employee_esi_' + employee_sno + '" class="employee_esi">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_pt_' + employee_sno + '" id="employee_pt_' + employee_sno + '" class="employee_pt">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox" align="center">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_bns_' + employee_sno + '" id="employee_bns_' + employee_sno + '" class="employee_bns">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox" align="center">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_lwf_' + employee_sno + '" id="employee_lwf_' + employee_sno + '" class="employee_lwf">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '<td>';
        employee_html_data += '<div class="checkbox" align="center">';
        employee_html_data += '<label>';
        employee_html_data += '<input type="checkbox" name="employee_gratituty_' + employee_sno + '" id="employee_gratituty_' + employee_sno + '" class="employee_gratituty">';
        employee_html_data += '</label>';
        employee_html_data += '</div>';
        employee_html_data += '</td>';
        employee_html_data += '</tr>';
    } else {
        alert("Please Select Company And Emp Type..");
        return false;
    }
    $('.employee_cont_tbody').append(employee_html_data);
    employee_sno++;
});
*/
//-------------END EMPLOYEE ADD MORE
//------------ADD EMP TYPE
$("#pay_str_cmpid").change(function () {
    var cmp_id = $(this).find(":selected").data("cmp_id");
    var option = "<option value=\"0\" data-emp_type_id=\"0\">Select Emp Type</option>";
    income_heads_array = [];
    if (cmp_id != 0 && cmp_id != "" && cmp_id != undefined) {

        $.ajax({
            async: false,
            type: "POST",
            data: { "cmp_id": cmp_id },
            url: baseurl + 'admin/getemployementtype',
            success: function (data) {
                // console.log(data);
                var emp_type_data = JSON.parse(data);

                if (emp_type_data.length > 0) {
                    for (index in emp_type_data) {
                        emp_type_index = emp_type_data[index];
                        option += "<option value=" + emp_type_index.mxemp_ty_id + "~" + emp_type_index.mxemp_ty_name.replace(" ", '-') + " data-emp_type_id=" + emp_type_index.mxemp_ty_id + ">" + emp_type_index.mxemp_ty_name + "</option>";
                    }

                }

            }
        });
    } else {
        var employer_option = '<option value="" data-inc_head_id="">Select Income Head</option>';
        // var employee_option = '<option value="" data-inc_head_id="">Select Income Head</option>';
        $("#employer_inc_head_1").html(employer_option);
        // $("#employee_inc_head_1").html(employee_option);
    }
    remove_trs();
    $("#emp_type_name").html(option);
});
//------------END ADD EMP TYPE
//-------------EMPTYPE CHANGE
$("#emp_type_name").change(function () {
    income_heads_array = [];
    var cmp_id = $("#pay_str_cmpid").find(':selected').data("cmp_id");
    var emp_type_id = $(this).find(':selected').data('emp_type_id');
    var employer_option = '<option value="" data-inc_head_id="">Select Income Head</option>';
    // var employee_option = '<option value="" data-inc_head_id="">Select Income Head</option>';
    if (emp_type_id != 0 && emp_type_id != "" && emp_type_id != undefined && cmp_id != 0 && cmp_id != "" && cmp_id != undefined) {

        $.ajax({
            async: false,
            type: "POST",
            data: { "cmp_id": cmp_id, "emp_type_id": emp_type_id },
            url: baseurl + 'admin/get_income_types',
            success: function (data) {
                // console.log(data);
                income_heads_array = JSON.parse(data);

                if (income_heads_array.length > 0) {
                    for (index in income_heads_array) {
                        income_heads_index = income_heads_array[index];
                        employer_option += "<option value=" + income_heads_index.mxincm_id + "~" + income_heads_index.mxincm_name.replace(" ", '-') + " data-inc_head_id=" + income_heads_index.mxincm_id + ">" + income_heads_index.mxincm_name + "</option>";
                        // employee_option += "<option value=" + income_heads_index.mxincm_id + "~" + income_heads_index.mxincm_name.replace(" ", '-') + " data-inc_head_id=" + income_heads_index.mxincm_id + ">" + income_heads_index.mxincm_name + "</option>";
                    }

                }

            }
        });
    }
    remove_trs();
    // console.log(employer_option);
    $("#employer_inc_head_1").html(employer_option);
    // $("#employee_inc_head_1").html(employee_option);
});
function remove_trs() {
    // for (i = 2; i < employee_sno; i++) {
    //     $("#employee_tr_" + i).remove();
    // }
    for (i = 2; i < employer_sno; i++) {
        $("#employer_tr_" + i).remove();
    }

}


//-------------END EMPTYPE CHANGE
//--------FOR SUBMIT 
$("form#pay_structure_form").submit(function (e) {
    e.preventDefault();
    
    
    var pay_str_cmp_id = $("#pay_str_cmpid").val();
    if (pay_str_cmp_id == 0 || pay_str_cmp_id == "") {
        $("#pay_str_cmpid").focus();
        $('#pay_str_cmpid_error').html("Please Select Company Name");
        return false;
    } else {
        $('#pay_str_cmpid_error').html("");
    }
    
    var pay_str_emp_type = $("#emp_type_name").val();
    if (pay_str_emp_type == 0 || pay_str_emp_type == "") {
        $("#emp_type_name").focus();
        $('#emp_type_name_error').html("Please Select Emp Type");
        return false;
    } else {
        $('#emp_type_name_error').html("");
    }

   


    // if (page_type == 1) {
        var mainurl = baseurl + 'admin/save_paystructure_type';
    // } else if (page_type == 2) {
        // var mainurl = baseurl + 'admin/update_deduction_type';
    // }

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            // console.log(data);
            //      return false;
            if (data == 200) {
                alert('Successfully Saved The PayStructure...');
                setTimeout(function () {
                    //                        window.location.reload();
                    window.location.href = baseurl + "admin/income_deduction_reasons/deduction_type";
                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company AND EMPLOYEMENT TYPE....');
                return false;
            } else if(data == "LESS"){
                    alert("You Cant Save Affect Date Less Than The Previous Existing Records");
                    return false;
            } else if(data == "same"){
                    alert("You Cant Feed The Affect Date As the Same Month And Year Of Previous Record");
                    return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});
//--------FOR SUBMIT 

$(document).on("click", ".pay_struc_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #pay_stru_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_pay_stru_id").val(id);
});

$("#processdeletedata_pay_struc").click(function () {
    event.preventDefault();
    var del_pay_stru_id = $('#del_pay_stru_id').val();
//alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {pay_struc_id: del_pay_stru_id},
        url: baseurl + 'admin/delete_pay_structure',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                    window.location.reload();
                // window.location.href = baseurl + "admin/statutorymaster/lta_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});




//----------END PAY STRUCTURE
