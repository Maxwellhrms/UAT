//$(document).ready(function () {
//------Load States
$("#lta_company_id").change(function () {
    var lta_company_id = $(this).val();
        // alert(lta_company_id);
    if (lta_company_id != 0 && lta_company_id != "") {
//        lwf_load_states(lwf_comp_id, 0)
          load_lta_divisionss(lta_company_id,0);
          $.ajax({
            url: baseurl + 'test/getgrade',
            type: 'POST',
            data: { companyid: lta_company_id },
            success: function (data) {
              $("#lta_gradename").html(data);
            },
          });
    } else {
        
        
        var option = "<option value=0>Select Division</option>";
        $("#lta_div_id").empty().append(option);
        $("#lta_gradename").html("");

    }  

});

var lta_div_array = [];
var lta_selected_div;
function load_lta_divisionss(lta_company_id, lta_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': lta_company_id},
        success: function (data) {
            lta_div_array = JSON.parse(data);
                            console.log(lta_div_array);

        }
    });

    var option;
        console.log(lta_div_array);
    if (lta_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in lta_div_array) {
            var lta_div_array_index = lta_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (lta_selected_div == lta_div_array_index.mxd_id) {
                option += "<option value=" + lta_div_array_index.mxd_id + " selected>" + lta_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + lta_div_array_index.mxd_id + ">" + lta_div_array_index.mxd_name + "</option>"
            }
                //   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#lta_div_id").empty().append(option);

    
}
//END DIVISION




$("form#lta_statutory_form").submit(function (e) {
    e.preventDefault();
    var lta_affectdate = $("#lta_affectdate").val();
    if (lta_affectdate == "") {
        $('#lta_affectdate_error').html("Please Select Affect Date");
        $("#lta_affectdate").focus();
        return false;
    } else {
        $('#lta_affectdate_error').html("");
    }
//alert(affect_date);
//return false;
    var lta_company_id = $("#lta_company_id").val();
    if (lta_company_id == 0 || lta_company_id == "") {
        $("#lta_company_id").focus();
        $('#lta_company_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#lta_company_id_error').html("");
    }
    var lta_div_id = $("#lta_div_id").val();
    if (lta_div_id == 0 || lta_div_id == "") {
        $("#lta_div_id").focus();
        $('#lta_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#lta_div_id_error').html("");
    }

    var lta_gradename = $("#lta_gradename").val();
    if (lta_gradename == "" || lta_gradename == 0) {
        $("#lta_gradename").focus();
        $('#lta_gradenameerror').html("Please Select Grade....");
        return false;
    } else {
        $('#lta_gradenameerror').html("");
    }

    var lta_emp_type = $("#lta_emp_type").val();
    if (lta_emp_type == "" || lta_emp_type ==0) {
        $("#lta_emp_type").focus();
        $('#lta_emp_type_error').html("Please Select LTA Emp Type");
        return false;
    }else{
        $('#lta_emp_type_error').html("");
    }


    

    


    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }
//-----End pf eligibility  


//if(page_type == 1){
    var mainurl = baseurl + 'admin/save_lta_statutory';
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
                alert('Successfully Saved The LTA Statutory....');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/lta_master_li";

                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            } else if (data == 240) {
                alert('Affect Date Already Exist For these Company....');
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

$("#processdeletedata_lta").click(function () {
    event.preventDefault();
    var del_lta_id = $('#del_lta_id').val();
//alert(del_lwf_id);
    $.ajax({
        async: false,
        type: "POST",
        data: {lta_id: del_lta_id},
        url: baseurl + 'admin/delete_lta_statutory',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/statutorymaster/lta_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});



$(document).on("click", ".lta_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var affect_date = x[2];
    $(".modal-body #lta_del_comp").html(companyname + '(' + affect_date + ')');
    $(".modal-body #del_lta_id").val(id);
});


//});
