//$(document).ready(function () {
//------Load States
$("#med_company_id").change(function () {
    var med_company_id = $(this).val();
//        alert(comp_id);
    if (med_company_id != 0 && med_company_id != "") {
//        lwf_load_states(lwf_comp_id, 0)
          load_mediclaim_divisions(med_company_id,0);
          $.ajax({
            url: baseurl + 'test/getgrade',
            type: 'POST',
            data: { companyid: med_company_id },
            success: function (data) {
              $("#med_gradename").html(data);
            },
          });
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#med_div_id").empty().append(option);
        $("#med_gradename").html("");

    }  

});

var med_div_array = [];
var med_selected_div;
function load_mediclaim_divisions(med_company_id, med_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': med_company_id},
        success: function (data) {
            med_div_array = JSON.parse(data);
                        //    console.log(gratuty_div_array);

        }
    });

    var option;
//        console.log(states_array);
    if (med_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in med_div_array) {
            var med_div_array_index = med_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (med_selected_div == med_div_array_index.mxd_id) {
                option += "<option value=" + med_div_array_index.mxd_id + " selected>" + med_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + med_div_array_index.mxd_id + ">" + med_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#med_div_id").empty().append(option);

    
}
//END DIVISION




$("form#mediclaim_statutory_form").submit(function (e) {
    e.preventDefault();
    var med_affectdate = $("#med_affectdate").val();
    if (med_affectdate == "") {
        $('#med_affectdate_error').html("Please Select Affect Date");
        $("#med_affectdate").focus();
        return false;
    } else {
        $('#med_affectdate_error').html("");
    }
//alert(affect_date);
//return false;
    var med_company_id = $("#med_company_id").val();
    if (med_company_id == 0 || med_company_id == "") {
        $("#med_company_id").focus();
        $('#med_company_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#med_company_id_error').html("");
    }
    var med_div_id = $("#med_div_id").val();
    if (med_div_id == 0 || med_div_id == "") {
        $("#med_div_id").focus();
        $('#med_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#med_div_id_error').html("");
    }

    var med_gradename = $("#med_gradename").val();
    if (med_gradename == "" || med_gradename == 0) {
        $("#med_gradename").focus();
        $('#med_gradenameerror').html("Please Select Grade....");
        return false;
    } else {
        $('#med_gradenameerror').html("");
    }

    var med_emp_type = $("#med_emp_type").val();
    if (med_emp_type == "" || med_emp_type ==0) {
        $("#med_emp_type").focus();
        $('#med_emp_type_error').html("Please Select MEDICLAIM Emp Type");
        return false;
    }else{
        $('#med_emp_type_error').html("");
    }


    

    


    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_mediclaim_statutory';
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
            // return false;
            if (data == 200) {
                alert('Successfully Saved The Mediclaim Statutory....');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/mediclaim_master_li";

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

$("#processdeletedata_mediclaim").click(function () {
    event.preventDefault();
    var del_mediclaim_id = $('#del_mediclaim_id').val();
//alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {mediclaim_id: del_mediclaim_id},
        url: baseurl + 'admin/delete_mediclaim_statutory',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/statutorymaster/mediclaim_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".mediclaim_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #mediclaim_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_mediclaim_id").val(id);
});


//});
