$("form#idcard_form").submit(function (e) {
    e.preventDefault();

    var idcard_cmp_id = $("#idcard_cmp_id").val();
    if (idcard_cmp_id == 0 || idcard_cmp_id == "") {
        $("#idcard_cmp_id").focus();
        $('#idcard_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#idcard_cmp_id_error').html("");
    }
    
    // var email_from = $("#email_from").val().trim();
    // if (email_from == "") {
    //     $("#email_from").focus();
    //     $('#email_from_error').html("Please Enter Email Id From Which u want to send email");
    //     return false;
    // } else {
    //     $('#email_from_error').html("");
    // }
    var msg_subject = $("#msg_subject").val().trim();
    if (msg_subject == "") {
        $("#msg_subject").focus();
        $('#msg_subject_error').html("Please Enter Message Subject");
        return false;
    } else {
        $('#msg_subject_error').html("");
    }

    var msg_desc = $("#msg_desc").val().trim();
    if (msg_desc == "") {
        $("#msg_desc").focus();
        $('#msg_desc_error').html("Please Enter Message Description.");
        return false;
    } else {
        $('#msg_desc_error').html("");
    }
    var email_subject = $("#email_subject").val().trim();
    if (email_subject == "") {
        $("#email_subject").focus();
        $('#email_subject_error').html("Please Enter Email Subject");
        return false;
    } else {
        $('#email_subject_error').html("");
    }

    var email_desc = $("#email_desc").val().trim();
    if (email_desc == "") {
        $("#email_desc").focus();
        $('#email_desc_error').html("Please Enter Email Description.");
        return false;
    } else {
        $('#email_desc_error').html("");
    }

    // if(page_type == 1){
    //     var image = $("#pic").val()
    //     if(image == ""){
    //         $('#pic_error').html("Please Select Idcard Image.");
    //         return false;
    //     }else{
    //         $('#pic_error').html("");
    //     }
    // }
 

    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }



    if (page_type == 1) {
        var mainurl = baseurl + 'admin/save_idcard';
        var msg = "saved";
    } else if (page_type == 2) {
        var mainurl = baseurl + 'admin/update_idcard';
        var msg = "updated"
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
               
                alert('Successfully '+ msg +' ID Card Details');
                setTimeout(function () {
                     if (page_type == 1) {
                        window.location.reload();
                     }else{
                        window.location.href = baseurl + "admin/add_idcard";
                     }
                }, 1000);
            } else if (data == 420) {
                alert('Failed To Save Please TryAgain later');
                return false;
            }else if(data == 567){
                alert('You cant Add More than one ID Card Details for a company');
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
    var id = $(this).data('id');
    $(".modal-body #inc_id_hidden").val(id);
});

$("#processdeletedata_idcard").click(function () {
    event.preventDefault();
    var inc_id_hidden = $('#inc_id_hidden').val();

    $.ajax({
        async: false,
        type: "POST",
        data: { income_id: inc_id_hidden },
        url: baseurl + 'admin/delete_idcard',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
                window.location.reload();
                // window.location.href = baseurl + "admin/income_deduction_reasons/income_type";

                //                window.location.href = baseurl + "admin/statutorymaster/esi_master_li";

            } else {
                alert('Try Again Later');
            }
        }
    });

});
//END DELETE