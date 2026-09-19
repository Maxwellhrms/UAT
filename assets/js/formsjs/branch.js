$(document).ready(function () {

  //----NEW BY SHABABu
  $("#headoffice").click(function () {
    check_ho();
  });
  $("#is_zonal_ofc").click(function () {
    check_ho();
  });

  $("#is_area_ofc").click(function () {
    check_ho();
  });
  function check_ho() {
    var cmpname = $("#cmpname").val();
    if (cmpname == "") {
      $("#cmpname").focus();
      $('#cmpnameerror').html("Please Select Company Name");
      $("#headoffice").prop("checked", false);
      $("#is_zonal_ofc").prop("checked", false);
      $("#is_area_ofc").prop("checked", false);
      return false;
    } else {
      $('#cmpnameerror').html("");
    }

    var divname = $("#divname").val();
    if (divname == "") {
      $("#divname").focus();
      $('#divnameerror').html("Please Select Division");
      $("#headoffice").prop("checked", false);
      $("#is_zonal_ofc").prop("checked", false);
      $("#is_area_ofc").prop("checked", false);
      return false;
    } else {
      $('#divnameerror').html("");
    }
    //----------------------------HEAD OFFICE CHECK
    var head_ofc_flag = $("#headoffice").prop("checked");

    if (head_ofc_flag == true) {
      $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "POST",
        data: { 'comp_id': cmpname, 'div_id': divname, 'is_headoffice': 1 },
        success: function (data) {
          data = JSON.parse(data);
          console.log(data)
          if (data.length > 0) {
            if (brn == 2) {//edit
              if (data[0].mxb_id == edit_branch_id) {//-->when branch id of headoffice and edit branch are same then no error msg
                $("#headofficeerror").html(" ");
              } else {
                $("#headoffice").prop("checked", false);
                $("#headofficeerror").html("HEAD OFFICE ALREADY EXIST IN THE SELECTED DIVISION....");
                return false;
              }
            } else {//-->for insert
              $("#headoffice").prop("checked", false);
              $("#headofficeerror").html("HEAD OFFICE ALREADY EXIST IN THE SELECTED DIVISION....");
              return false;
            }
          } else {
            $("#headofficeerror").html(" ");
          }

        }
      });
    } else {
      $("#headofficeerror").html(" ");
    }
    //----------------------------END HEAD OFFICE CHECK  


    //-------------BOTH ZONAL & AREA CHECK
    var zonal_ofc = $("#is_zonal_ofc").prop("checked");
    var area_ofc = $("#is_area_ofc").prop("checked");
    if (zonal_ofc == true && area_ofc == true) {
      $("#is_zonal_ofc").prop("checked", false);
      $("#is_area_ofc").prop("checked", false);
      $("#is_area_ofc_error").html("You cant select Both Zonal Office and Area Office For One Branch..");
      return false;
    } else {
      $("#is_zonal_ofc_error").html(" ");
      $("#is_area_ofc_error").html(" ");
    }
    //-------------END BOTH ZONAL & AREA CHECK

    //----------------------------ZONAL OFFICE CHECK

    if (zonal_ofc == true) {
      $.ajax({
        url: baseurl + 'admin/getbranchdetails',
        type: "post",
        data: { cmp_id: cmpname, div_id: divname, is_zonal_ofc: 1 },
        success: function (data) {
          console.log(data);
          var brach_data = JSON.parse(data);
          if (brach_data.length > 0) {
            $("#is_zonal_ofc").prop("checked", false);
            $("#is_zonal_ofc_error").html("Zonal Office Already Exist in the Division..");
            return false;
          }
        }
      });

    } else {
      $("#is_zonal_ofc_error").html(" ");
      $("#is_area_ofc_error").html(" ");
    }
    //----------------------------END ZONAL OFFICE CHECK


  }
  //----NEW BY SHABABu




  $("form#processbrndetails").submit(function (e) {
    e.preventDefault();

    var cmpname = $("#cmpname").val();
    if (cmpname == "") {
      $("#cmpname").focus();
      $('#cmpnameerror').html("Please Select Company Name");
      return false;
    } else { $('#cmpnameerror').html(""); }

    var divname = $("#divname").val();
    if (divname == "") {
      $("#divname").focus();
      $('#divnameerror').html("Please Select Division");
      return false;
    } else { $('#divnameerror').html(""); }

    var zonal_id = $("#zonal_id").val();
    if (zonal_id == "") {
      $("#zonal_id").focus();
      $('#zonal_id_error').html("Please Select Zonal");
      return false;
    } else { $('#zonal_id_error').html(""); }

    var cmpstate = $("#cmpstate").val();
    if (cmpstate == "") {
      $("#cmpstate").focus();
      $('#cmpstateerror').html("Please Select State");
      return false;
    } else { $('#cmpstateerror').html(""); }

    var brname = $("#brname").val();
    if (brname == "") {
      $("#brname").focus();
      $('#brnameerror').html("Please Enter Branch Name");
      return false;
    } else { $('#brnameerror').html(""); }

    var bremail = $("#bremail").val();
    if (bremail == "") {
      $("#bremail").focus();
      $('#bremailerror').html("Please Enter Branch Email");
      return false;
    } else { $('#bremailerror').html(""); }


    var braddress = $("#braddress").val();
    if (braddress == "") {
      $("#braddress").focus();
      $('#braddresserror').html("Please Enter Branch Address");
      return false;
    } else { $('#braddresserror').html(""); }

    var brshortcode = $("#brshortcode").val();
    if (brshortcode == "") {
      $("#brshortcode").focus();
      $('#brshortcodeerror').html("Please Enter Branch Code");
      return false;
    } else { $('#brshortcodeerror').html(""); }
    //---------NEW BY SHABABU TO CHECK HEAD OFFICE
    check_ho();
    //---------NEW BY SHABABU TO CHECK HEAD OFFICE
    
    if (brn == 1) {
      mainurl = baseurl + 'admin/savebranchdetails';
    } else if (brn == 2) {
      mainurl = baseurl + 'admin/saveeditbranchdetails';
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
          alert('Failed To Save Please TryAgain later');
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });

  });

  $("#processdeletedata").click(function () {
    event.preventDefault();
    var delid = $('#delbrid').val();

    $.ajax({
      async: false,
      type: "POST",
      data: { id: delid },
      url: baseurl + 'admin/deletebranch',
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
  $(".modal-body #delbrname").html(companyname);
  $(".modal-body #delbrid").val(id);
});




$(document).ready(function () {
  $("#divname").change(function () {
    var div_id = $(this).val();
    var cmp_id = $("#cmpname").val();
    get_zonal(cmp_id, div_id, 0)
  });
});
function get_zonal(cmp_id, div_id, selected_zone_id) {
  var option = '<option value="">Select Zonal</option>';
  if (div_id != "" && cmp_id != "") {
    $.ajax({
      async: false,
      type: "POST",
      data: { "cmp_id": cmp_id, "div_id": div_id },
      url: baseurl + 'admin/getzonaldetails',
      success: function (data) {
        console.log(data);
        var zonal_data = JSON.parse(data);
        if (zonal_data.length > 0) {
          for (zonal_index in zonal_data) {
            var zon_data = zonal_data[zonal_index];
            if (selected_zone_id == zon_data.mxz_id) {
              option += '<option value="' + zon_data.mxz_id + '" selected>' + zon_data.mxz_name + '</option>';
            } else {
              option += '<option value="' + zon_data.mxz_id + '">' + zon_data.mxz_name + '</option>';
            }

          }
        }
      }
    });
  }
  $("#zonal_id").html(option);
}
// });


