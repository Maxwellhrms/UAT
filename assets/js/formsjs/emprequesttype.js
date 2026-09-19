//$(document).ready(function () {
//------Load Division
$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    var emp_code_html = "<option value='0'>No Data Found</option>";
    $("#employeeid").empty().append(emp_code_html);
});

var esi_div_array = [];
var esi_selected_div;
function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'type': "ESI"},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            esi_div_array = JSON.parse(data);
//                            console.log(states_array);

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

$("#esi_div_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    var emp_code_html = "<option value='0'>No Data Found</option>";
    $("#employeeid").empty().append(emp_code_html);
});

// Emi Calculations
$("#tenuremnts").change(function () {
    var totalamt = 0;
    var tenuremnts = $("#tenuremnts").val();
    var loanamountapproved = $("#loanamountapproved").val();
    if(tenuremnts != ""){
        if(loanamountapproved != "" && loanamountapproved > 0){
            var totalamt = loanamountapproved/tenuremnts;
            $(".emiamountidentyfier").html('Monthly Emi Debit Will be ' + totalamt);
        }else{
            alert("Please Enter Loan Amount");
            $("option:selected").prop("selected", false)
        }
    }else{
        $(".emiamountidentyfier").html('');
    }
});
// Emi Calculations

var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
//    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI"},
        success: function (data) {
//            console.log("ESI STATES");
//            console.log(data);
//            console.log("END ESI STATES");
            esi_states_array = JSON.parse(data);
//                            console.log(states_array);

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
}
//------End Load States
//------Load Branches
$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
    var emp_code_html = "<option value='0'>No Data Found</option>";
    $("#employeeid").empty().append(emp_code_html);
});
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI'},
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
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);

    var emp_code_html = "<option value='0'>No Data Found</option>";
    $("#employeeid").empty().append(emp_code_html);
}
$("#esi_branch_id").change(function () {
    var comp_id = $("#esi_company_id").val();
    var div_id = $("#esi_div_id").val();
    var state_id = $("#esi_state_id").val();
    var branch_id = $("#esi_branch_id").val();
if(comp_id !=0 && div_id !=0 && state_id !=0 && branch_id !=0){
    $.ajax({
        url: baseurl + "loan_controller/getemployeelistforloans",
        type: "post",
        async: false,
        // data: {'comp_id': comp_id, 'div_id': div_id, 'state_id': state_id, 'branch_id': branch_id},
        data: { cmpname: comp_id, divname: div_id, cmpstate: state_id, brname: branch_id },
        success: function (data) {
                   console.log(data);
            $("#employeeid").html(data);

        }
    });
}else{
    var html = "<option value='0'>No Data Found</option>";
    $("#employeeid").html(html);
}
});    


$("form#emp_requesttype_form").submit(function (e) {
    e.preventDefault();
     var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
    if (esi_div_id == 0 || esi_div_id == "") {
        $("#esi_div_id").focus();
        $('#esi_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#esi_div_id_error').html("");
    }

    var esi_state_id = $("#esi_state_id").val();
    if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    }

    var esi_branch_id = $("#esi_branch_id").val();
    if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }

    var employeeid = $("#employeeid").val();
    if (employeeid == "") {
        $('#employeeiderror').html("Please Select Employee");
        $("#employeeid").focus();
        return false;
    } else {
        $('#employeeiderror').html("");
    }

    var loantype = $("#requesttype").val();
    if (loantype == "") {
        $('#loantypeerror').html("Please Select Request Type");
        $("#requesttype").focus();
        return false;
    } else {
        $('#loantypeerror').html("");
    }

    
    var tenuremnts = $("#desc").val();
    if (tenuremnts == "") {
        $('#tenuremntserror').html("Please Enter Description");
        $("#tenuremnts").focus();
        return false;
    } else {
        $('#tenuremntserror').html("");
    }
if(page_type == 1){
    var mainurl = baseurl + 'admin/saveemployeerequesttype';
}else if(page_type == 2){
    var mainurl = baseurl+'admin/editemployeerequesttype';
}
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
           // console.log(data);
            // return false;
        if (data == 200) {
                alert('Successfully Saved');
                window.location.reload();
            }else if(data == 300){
                alert('Successfully Updated');
                window.location.reload();
            }else if(data == 444){
                alert('not inserted');
            }else{
                alert('Failed');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$(document).on("click", ".deletemodal", function () {
	var deletedetails = $(this).data('id');
	$(".modal-body #delbrid").val(deletedetails);
});

$("#emprequesttype").click(function () {
    event.preventDefault();
    var delid = $('#delbrid').val();
    $.ajax({
      async: false,
      type: "POST",
      data: { id: delid },
      url: baseurl + 'admin/deleteemprequesttype',
      datatype: "html",
      success: function (data) {
		  console.log(data);
        if (data == 200) {
          alert('Success');
          window.location.reload();
        } else {
          alert('Try Again Later');
        }
      }
    });

  });

 
$("#esi_branch_id").change(function () {
    var branchid = $('#esi_branch_id').val();
    var compid = $("#esi_company_id").val();
    var divid = $("#esi_div_id").val();
	var stateid = $("#esi_state_id").val();
    var mainurl = baseurl + 'admin/getemprequesttype';
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: { 'branchid' : branchid, 'compid' : compid, 'divid' : divid, 'stateid': stateid },
            success: function (data) {
               $('#reuesttypelist').html(data);
			   $('#reqlist').hide();
            }
        });
});

//---------------------   end added 11-12-2021 ---------------