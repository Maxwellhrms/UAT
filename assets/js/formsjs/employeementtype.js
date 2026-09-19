$(document).ready(function () {
  $(".emp_type").click(function(){
      var check_flag = 0;
      $(".emp_type").each(function(){
          var data = $(this).prop("checked");
          if(data == true){
              check_flag = check_flag + 1;
          }
          if(check_flag > 1){
              alert("You Cant Check More than one Checkbox....");
              $(this).prop("checked",false);
              return false;
          }
      });
  });
  $("form#employeement_form").submit(function (e) {
    e.preventDefault();
    var emp_type_cmp_id = $("#emp_type_cmpid").val();
    if (emp_type_cmp_id == 0 || emp_type_cmp_id == "") {
      $("#emp_type_cmpid").focus();
      $('#emp_type_cmpid_error').html("Please Select Company Name");
      return false;
    } else {
      $('#emp_type_cmpid_error').html("");
    }
    var emptyname = $("#emptyname").val();
    if (emptyname == "") {
      $("#emptyname").focus();
      $('#emptynameerror').html("Please Enter Employee Type Name");
      return false;
    } else { $('#emptynameerror').html(""); }

    var empshrtname = $("#empshrtname").val();
    if (empshrtname == "") {
      $("#empshrtname").focus();
      $('#empshrtnameerror').html("Please Enter Employee Short Name");
      return false;
    } else { $('#empshrtnameerror').html(""); }


    if (emptype == 1) {
      mainurl = baseurl + 'admin/saveemployeementtypemaster';
    } else if (emptype == 2) {
      mainurl = baseurl + 'admin/editsaveemployeementtypemaster';
    }

    var formData = new FormData(this);
    $.ajax({
      url: mainurl,
      type: 'POST',
      data: formData,
      success: function (data) {
        console.log(data);
        if (data == 200) {
          alert('Successfully');
          setTimeout(function () {
            window.location.reload();
          }, 1000);
        } else {
          alert('Failed To Save Please TryAgain');
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });

  });

  $("#processdeletedata").click(function () {
    event.preventDefault();
    var delid = $('#deldesid').val();
    
    $.ajax({
      async: false,
      type: "POST",
      data: { id: delid },
      url: baseurl + 'admin/delete_employement_type',
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

});

$(document).on("click", ".deletemodal", function () {
  var deletedetails = $(this).data('id');
  var x = deletedetails.split("~", 3);
  var id = x[0];
  var companyname = x[1];
  $(".modal-body #deldesname").html(companyname);
  $(".modal-body #deldesid").val(id);
});