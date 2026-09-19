// FORM SUBMIT
 $("form#pfreason_frm").submit(function (e) {
    e.preventDefault();
    
    var pf_reason_cmp_id = $("#pf_reason_cmp_id").val();
    if (pf_reason_cmp_id == 0 || pf_reason_cmp_id == "") {
        $("#pf_reason_cmp_id").focus();
        $('#pf_reason_cmp_id_error').html("Please Select Company Name");
        return false;
    } else {
        $('#pf_reason_cmp_id_error').html("");
    }
    
    var pf_reason_name = $("#pf_reason_name").val();
    if (pf_reason_name == "") {
        $("#pf_reason_name").focus();
        $('#pf_reason_name_error').html("Please Enter PF Reason Name");
        return false;
    } else {
        $('#pf_reason_name_error').html("");
    }

    
    var final_confirmation = confirm('Are You Sure To Submit Data');
    if (final_confirmation == false) {
        return false;
    }


//alert(page_type);
if(page_type == 1){
    var mainurl = baseurl + 'admin/save_pf_reason';
}else if(page_type == 2){
  var mainurl = baseurl+'admin/update_pf_reason';
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
                    window.location.href = baseurl + "admin/pfreasons";
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
$(document).on("click", ".pf_reason_delete", function () {
    var deletedetails = $(this).data('id');
    var x = deletedetails.split("~");
//alert(x)
    var id = x[0];
    var companyname = x[1];
    var pf_reason_name = x[2];
    $(".modal-body #pf_reason_del_data").html(companyname + '(' + pf_reason_name + ')');
    $(".modal-body #pf_reason_id_hidden").val(id);
});
$("#processdeletedata_pf_reason").click(function () {
    event.preventDefault();
    var pf_reason_id_hidden = $('#pf_reason_id_hidden').val();

    $.ajax({
        async: false,
        type: "POST",
        data: {pf_reason_id: pf_reason_id_hidden},
        url: baseurl + 'admin/delete_pf_reason',
        datatype: "html",
        success: function (data) {
//            console.log(data);
//            alert(data);
//            return false;
            if (data == 200) {
                alert('Success');
//                    window.location.reload();
                window.location.href = baseurl + "admin/pfreasons";

            } else {
                alert('Try Again Later');
            }
        }
    });

});

//END DELETE