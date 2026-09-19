// FORM SUBMIT
 $("form#esi_reason_frm").submit(function (e) {
    e.preventDefault();
    
    var esi_reason_cmp_id = $("#esi_reason_cmp_id").val();
    if (esi_reason_cmp_id == 0 || esi_reason_cmp_id == "") {
        $("#esi_reason_cmp_id").focus();
        $('#esi_reason_cmp_id_error').html("Please Enter Company Name");
        return false;
    } else {
        $('#esi_reason_cmp_id_error').html("");
    }
    
    var esi_reason_name = $("#esi_reason_name").val();
    if (esi_reason_name == "") {
        $("#esi_reason_name").focus();
        $('#esi_reason_name_error').html("Please Enter ESI Reason Name");
        return false;
    } else {
        $('#esi_reason_name_error').html("");
    }

    
    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }



if(page_type == 1){
    var mainurl = baseurl + 'admin/save_esi_reason';
}else if(page_type == 2){
  var mainurl = baseurl+'admin/update_esi_reason';
}

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            console.log(data);
//      return false;
            if (data == 200) {
                alert('Successfully');
                setTimeout(function () {
//                        window.location.reload();
                    window.location.href = baseurl + "admin/esireasons";
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
$(document).on("click", ".esi_reason_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var esi_reason_name = x[2];
    $(".modal-body #esi_rsn_del_comp").html(companyname + '(' + esi_reason_name + ')');
    $(".modal-body #esi_rsn_id_hidden").val(id);
});
$("#processdeletedata_esi").click(function () {
    event.preventDefault();
    var del_esi_id = $('#esi_rsn_id_hidden').val();

    $.ajax({
        async: false,
        type: "POST",
        data: {esi_reason_id: del_esi_id},
        url: baseurl + 'admin/delete_esi_reason',
        datatype: "html",
        success: function (data) {
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/esireasons";

            } else {
                alert('Try Again Later');
            }
        }
    });

});

//END DELETE