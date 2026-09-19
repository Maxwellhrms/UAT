//------Load Division
$("#bns_cmp_id").change(function () {
    var bns_comp_id = $(this).val();
//        alert(comp_id);
    if (bns_comp_id != 0 && bns_comp_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_bns_divisions(bns_comp_id, 0);
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#bns_div_id").empty().append(option);        
    }
});

var bns_div_array = [];
var bns_selected_div;
function load_bns_divisions(bns_comp_id, bns_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': bns_comp_id, 'type': "BNS"},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            bns_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (bns_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in bns_div_array) {
            var bns_div_array_index = bns_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (bns_selected_div == bns_div_array_index.mxd_id) {
                option += "<option value=" + bns_div_array_index.mxd_id + " selected>" + bns_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + bns_div_array_index.mxd_id + ">" + bns_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#bns_div_id").empty().append(option);

    
}

$("form#bns_statutory_form").submit(function (e) {
    e.preventDefault();
    var affect_date = $("#bns_affect_date").val();
    if (affect_date == "") {
        $('#bns_affect_date_error').html("Please Select Affect Date");
        $("#bns_affect_date").focus();
        return false;
    } else {
        $('#bns_affect_date_error').html("");
    }
//alert(affect_date);
//return false;
    var bns_cmp_id = $("#bns_cmp_id").val();
    if (bns_cmp_id == 0 || bns_cmp_id == "") {
        $("#bns_cmp_id").focus();
        $('#bns_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#bns_cmp_id_error').html("");
    }
    var bns_div_id = $("#bns_div_id").val();
    if (bns_div_id == 0 || bns_div_id == "") {
        $("#bns_div_id").focus();
        $('#bns_div_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#bns_div_id_error').html("");
    }

    var bns_emp_type = $("#bns_emp_type").val();
    if (bns_emp_type == 0 || bns_emp_type == "") {
        $("#bns_emp_type").focus();
        $('#bns_emp_type_error').html("Please Select Emp Type");
        return false;
    } else {
        $('#bns_emp_type_error').html("");
    }



    var bns_applicability = $("#bns_applicability").val();
    if (bns_applicability == "") {
        $("#bns_applicability").focus();
        $('#bns_applicability_error').html("Please Enter Bonus Applicability");
        return false;
    } else {
        $('#bns_applicability_error').html("");
    }

    var bns_perc = $("#bns_perc").val();
    if (bns_perc == "") {
        $("#bns_perc").focus();
        $('#bns_perc_error').html("Please Enter Bonus %");
        return false;
    } else {
        $('#bns_perc_error').html("");
    }

    var max_bns_limit = $("#max_bns_limit").val();
    if (max_bns_limit == "") {
        $("#max_bns_limit").focus();
        $('#max_bns_limit_error').html("Please Enter Bonus Limit");
        return false;
    } else {
        $('#max_bns_limit_error').html("");
    }
//
//        var esi_comp_cont = $("#esi_comp_cont").val();
//        if (esi_comp_cont == "") {
//            $("#esi_comp_cont").focus();
//            $('#esi_comp_cont_error').html("Please Enter PF Pension Cont");
//            return false;
//        } else {
//            $('#esi_comp_cont_error').html("");
//        }

    var bns_emp_type = $("#bns_emp_type").val();
    if (bns_emp_type == "" || bns_emp_type == 0) {
        $("#bns_emp_type").focus();
        $('#bns_emp_type_error').html("Please Select PF Emp Type");
        return false;
    }






    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_bns_statutory';
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
                alert('Successfully Saved The Bonus Statutory....');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/bns_master_li";

                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company & Division....');
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

$("#processdeletedata_bns").click(function () {
    event.preventDefault();
    var del_bns_id = $('#del_bns_id').val();


    $.ajax({
        async: false,
        type: "POST",
        data: {bns_id: del_bns_id},
        url: baseurl + 'admin/delete_bns_statutory',
        datatype: "html",
        success: function (data) {
            console.log(data);
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/statutorymaster/bns_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".bns_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #bns_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_bns_id").val(id);
});


//});
