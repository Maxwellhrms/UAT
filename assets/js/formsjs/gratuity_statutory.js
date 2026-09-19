//$(document).ready(function () {
//------Load States
$("#gratuity_cmp_id").change(function () {
    var gratuity_cmp_id = $(this).val();
//        alert(comp_id);
    if (gratuity_cmp_id != 0 && gratuity_cmp_id != "") {
//        lwf_load_states(lwf_comp_id, 0)
          load_gratuity_divisions(gratuity_cmp_id,0);
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#gratuity_div_id").empty().append(option);


    }    
});

var gratuty_div_array = [];
var gratuity_selected_div;
function load_gratuity_divisions(gratuity_cmp_id, gratuity_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': gratuity_cmp_id},
        success: function (data) {
            gratuty_div_array = JSON.parse(data);
                            console.log(gratuty_div_array);

        }
    });

    var option;
//        console.log(states_array);
    if (gratuty_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in gratuty_div_array) {
            var gratuity_div_array_index = gratuty_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (gratuity_selected_div == gratuity_div_array_index.mxd_id) {
                option += "<option value=" + gratuity_div_array_index.mxd_id + " selected>" + gratuity_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + gratuity_div_array_index.mxd_id + ">" + gratuity_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#gratuity_div_id").empty().append(option);

    
}
//END DIVISION




$("form#gratuity_statutory_form").submit(function (e) {
    e.preventDefault();
    var gratuity_affect_date = $("#gratuity_affect_date").val();
    if (gratuity_affect_date == "") {
        $('#gratuity_affect_date_error').html("Please Select Affect Date");
        $("#gratuity_affect_date").focus();
        return false;
    } else {
        $('#gratuity_affect_date_error').html("");
    }
//alert(affect_date);
//return false;
    var gratuity_cmp_id = $("#gratuity_cmp_id").val();
    if (gratuity_cmp_id == 0 || gratuity_cmp_id == "") {
        $("#gratuity_cmp_id").focus();
        $('#gratuity_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#gratuity_cmp_id_error').html("");
    }
    var gratuity_div_id = $("#gratuity_div_id").val();
    if (gratuity_div_id == 0 || gratuity_div_id == "") {
        $("#gratuity_div_id").focus();
        $('#gratuity_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#gratuity_div_id_error').html("");
    }

    var gratuity_emp_type = $("#gratuity_emp_type").val();
    if (gratuity_emp_type == "" || gratuity_emp_type == 0) {
        $("#gratuity_emp_type").focus();
        $('#gratuity_emp_type_error').html("Please Select Gratuity Emp Type");
        return false;
    }else{
        $('#gratuity_emp_type_error').html("");
    }


    var gratuity_age_limit = $("#gratuity_age_limit").val();
    if (gratuity_age_limit == "") {
        $("#gratuity_age_limit").focus();
        $('#gratuity_age_limit_error').html("Age limit Should Not Be Empty");
        return false;
    } else {
        $('#gratuity_age_limit_error').html("");
    }

    var gratuity_service_limit = $("#gratuity_service_limit").val();
    if (gratuity_service_limit == "") {
        $("#gratuity_service_limit").focus();
        $('#gratuity_service_limit_error').html("Service Limit Should Not be Empty..");
        return false;
    } else {
        $('#gratuity_service_limit_error').html("");
    }

    var max_gratuity_limit = $("#max_gratuity_limit").val();
    if (max_gratuity_limit == "") {
        $("#max_gratuity_limit").focus();
        $('#max_gratuity_limit_error').html("Gratuity Max amount Should not be empty");
        return false;
    } else {
        $('#max_gratuity_limit_error').html("");
    }
    var gratuity_per_month_perc = $("#gratuity_per_month_perc").val();
    if (gratuity_per_month_perc == "") {
        $("#gratuity_per_month_perc").focus();
        $('#gratuity_per_month_perc_error').html("Gratuity Month % Should not be empty");
        return false;
    } else {
        $('#gratuity_per_month_perc_error').html("");
    }


    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_gratuity_statutory';
//}else if(page_type == 2){
//  var mainurl = baseurl+'admin/save_edit_pf_statutory';
//}

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            // console.log(data);
            // return false;
            if (data == 200) {
                alert('Successfully Saved The Gratuity Statutory...');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/gratuity_master_li";

                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company & Division....');
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

$("#processdeletedata_gratuity").click(function () {
    event.preventDefault();
    var del_gratuity_id = $('#del_gratuity_id').val();
//alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {gratuity_id: del_gratuity_id},
        url: baseurl + 'admin/delete_gratuity_statutory',
        datatype: "html",
        success: function (data) {
            console.log(data);
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/statutorymaster/gratuity_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".gratuity_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #gratuity_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_gratuity_id").val(id);
});


//});
