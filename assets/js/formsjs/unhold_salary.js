$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
        //        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);
        load_emp_type(esi_comp_id, 0)
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        var option = "<option value=0>Select Emp Type</option>";
        $("#emptype").empty().append(option);
    }
});

//------------------LOAD DIVISIONS
var esi_div_array = [];
var esi_selected_div;
function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'type': "ESI" },
        success: function (data) {
            esi_div_array = JSON.parse(data);
        }
    });

    var option;
    //        console.log(states_array);
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
            //                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (esi_selected_div == esi_div_array_index.mxd_id) {
                option += "<option value=" + esi_div_array_index.mxd_id + " selected>" + esi_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + esi_div_array_index.mxd_id + ">" + esi_div_array_index.mxd_name + "</option>"
            }
            //                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#esi_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#esi_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}
//------------------END LOAD DIVISIONS

//---------------LOAD EMPLOYEE TYPE
var incentive_selected_emp_type;
function load_emp_type(cmp_id, incentive_selected_emp_type) {

    var option = '<option value="0">Select Emp Type</option>';
    if (cmp_id != 0 && cmp_id != "") {
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if (emp_type_parse_data.length > 0) {
                    for (index in emp_type_parse_data) {
                        var emp_type_index = emp_type_parse_data[index];
                        if (incentive_selected_emp_type == emp_type_index.mxemp_ty_id) {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' selected>' + emp_type_index.mxemp_ty_name + '</option>';
                        } else {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' >' + emp_type_index.mxemp_ty_name + '</option>';
                        }
                    }
                }

            }
        });
    }
    $("#emptype").html(option);
}
//---------------END LOAD EMPLOYEE TYPE

$("#esi_div_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $(this).val();
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        // var option = "<option value=0>Select Emp Type</option>";
        // $("#emptype").empty().append(option);        
    }
});
//----------------LOAD STATES
var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
    //    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI" },
        success: function (data) {
            esi_states_array = JSON.parse(data);
        }
    });

    var option;
    //        console.log(states_array);
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
            //                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
            //                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#esi_state_id").empty().append(option);

    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);

    // var option = "<option value=0>Select Emp Type</option>";
    // $("#emptype").empty().append(option);    
}
//------------End Load States

$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0);
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        // var option = "<option value=0>Select Emp Type</option>";
        // $("#emptype").empty().append(option);

    }
});
//-----------------LOADING BRANCHES
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI' },
        success: function (data) {
            //                    console.log(data);
            esi_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (esi_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in esi_branches_array) {
            var esi_branches_array_index = esi_branches_array[index];
            if (esi_selected_branch == esi_branches_array_index.mxb_id) {
                option += "<option value=" + esi_branches_array_index.mxb_id + " selected>" + esi_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + esi_branches_array_index.mxb_id + ">" + esi_branches_array_index.mxb_name + "</option>"
            }
            //                   console.log(option);
        }
        // load_emp_type(esi_comp_id, 0);
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);
}
//-----------------END LOADING BRANCHES



//-----------------paysheeet generate
function getUnholdSal() {

    // var yearmonth = $("#yearmonth").val();
    // if (yearmonth == 0 || yearmonth == "") {
    //     $("#yearmonth").focus();
    //     $('#yearmontherror').html("Please Select Date");
    //     return false;
    // } else {
    //     $('#yearmontherror').html("");
    // }
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
    // if (esi_div_id == 0 || esi_div_id == "") {
    //     $("#esi_div_id").focus();
    //     $('#esi_div_id_error').html("Please Select Division Name");
    //     return false;
    // } else {
    //     $('#esi_div_id_error').html("");
    // }

    var esi_state_id = $("#esi_state_id").val();
    // if (esi_state_id == 0 || esi_state_id == "") {
    //     $("#esi_state_id").focus();
    //     $('#esi_state_id_error').html("Please Select State");
    //     return false;
    // } else {
    //     $('#esi_state_id_error').html("");
    // }

    var esi_branch_id = $("#esi_branch_id").val();
    // if (esi_branch_id == 0 || esi_branch_id == "") {
    //     $("#esi_branch_id").focus();
    //     $('#esi_branch_id_error').html("Please Select Branch");
    //     return false;
    // } else {
    //     $('#esi_branch_id_error').html("");
    // }

    var emptype = $("#emptype").val();
    if (emptype == 0 || emptype == "") {
        $("#emptype").focus();
        $('#emptypeerror').html("Please Select Employee Type");
        return false;
    } else {
        $('#emptypeerror').html("");
    }
    var emp_code = $("#emp_code").val().trim();
    
    
    
    
    //  ----------------------------added chandana 24-04-2021 --------------------

    mainurl = baseurl + 'salaries_controller/getUnholdSalary';
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: { company: esi_company_id, divison: esi_div_id, state: esi_state_id, branch: esi_branch_id, emptype: emptype, emp_code:emp_code},
        success: function (data) {
            //console.log(data);
            if(data == 402){
                alert("NO DATA FOUND.....");
                return false;
            }
            $("#table_div").html(data);
            var table = $('#dataTables-example').DataTable({
                dom: 'Bfrtip',
                "destroy": true, //use for reinitialize datatable
                lengthChange: false,
                buttons: [
                    'excel'
                ]
                // buttons: [
                //     'excel', 'pdf', 'csv'
                // ]
            });
        },
    });
}
$(document).on("click", ".unhold_data", function () {
    var id = $(this).data('id');
    $(".modal-body #unholdid").val(id);
});

$(document).off('click','#processUnholdData').on('click','#processUnholdData',function() {
  event.preventDefault();
  var unholdid = $('#unholdid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : unholdid},
      url: baseurl + 'salaries_controller/unhold_specific_data',
      datatype: "html",
      success: function (data) {
          if (data == 200) {
            alert('Success');
            window.location.reload();
          }else {
            alert('Try Again Later');
          }
      }
  });

});
//--------------end paysheeet generate
