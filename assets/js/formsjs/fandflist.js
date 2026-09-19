$(document).ready(function(){
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
});

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
}

$(".search_btn").click(function(){
    filter_emp_resign_data();
});


function filter_emp_resign_data(){
    
	var mnth = $("#attndmonth").val();
    if (mnth == 0 || mnth == "") {
        mnth = null;
        // $("#attndmonth").focus();
        // $('#attndmontherror').html("Please Select Month");
        // return false;
    } 
    // else {
    //     $('#attndmontherror').html("");
    // }
	
	
	
	var year = $("#attndyear").val();
    if (year == 0 || year == "") {
        year = null;
        // $("#attndyear").focus();
        // $('#attndyearerror').html("Please Select Year");
        // return false;
    } 
    // else {
    //     $('#attndyearerror').html("");
    // }
	
	
	if(mnth!= null && year == null){
	    $("#attndyear").focus();
        $('#attndyearerror').html("Please Select Year");
        return false;
	}
	
    
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        esi_company_id = null;
        // $("#esi_company_id").focus();
        // $('#cmpnameerror').html("Please Select Company Name");
        // return false;
    } 
    // else {
    //     $('#cmpnameerror').html("");
    // }
	var emp = $("#attndempid").val();
	
// 	if(emp.length < 5 && emp.length > 0){
	    var esi_div_id = $("#esi_div_id").val();
	    if (esi_div_id == 0 || esi_div_id == "") {
	        esi_div_id = null;
	       // $("#esi_div_id").focus();
	       // $('#esi_div_id_error').html("Please Select Division Name");
	       // return false;
	    }
	   // else {
	   //     $('#esi_div_id_error').html("");
	   // }

	    var esi_state_id = $("#esi_state_id").val();
	    if (esi_state_id == 0 || esi_state_id == "") {
	        esi_state_id = null;
	       // $("#esi_state_id").focus();
	       // $('#esi_state_id_error').html("Please Select State");
	       // return false;
	    } 
	   // else {
	   //     $('#esi_state_id_error').html("");
	   // }

	    var esi_branch_id = $("#esi_branch_id").val();
	    if (esi_branch_id == 0 || esi_branch_id == "") {
	        esi_branch_id = null;
	       // $("#esi_branch_id").focus();
	       // $('#esi_branch_id_error').html("Please Select Branch");
	       // return false;
	    }
	   // else {
	   //     $('#esi_branch_id_error').html("");
	   // }
// 	}else{
// 		var esi_branch_id = 0;
// 		var esi_state_id = 0;
// 		var esi_div_id = 0;
// 	//	var esi_company_id = 0;
// 	}
    
    var status_type = $("#status_type").val();
	   // if (status_type == 2)  {
	   //     resign_status = 'R';
	       
	   // }else {
	   //     resign_status = 'N';
	     
	   // }

    
            

	var mainurl = baseurl+'admin/get_notice_peiod_employees';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: {employeecode : emp, month : mnth, year : year, company:esi_company_id, divison:esi_div_id, state:esi_state_id, branch:esi_branch_id,resign_status:status_type},
    success: function (data) {
        if(data == 220){
            $('#displaynotice_period_employees').html("");
            alert("No Data Found.....");
            return false;
        }
	   // console.log(data);
        $('#displaynotice_period_employees').html(data);
    },
});
}

// $(document).on("click", ".editattendance", function () {
// var getvalues = $(this).data('id');
// var x = getvalues.split("~",6);
// var date = x[0];
// var employeecode = x[1];
// var firsthalf = x[2];
// var secondhalf = x[3];
// var id = x[4];
// $(".modal-body #dateofattendance").html(date);
// $(".modal-body #editempdate").val(date);
// $(".modal-body #editempid").val(employeecode);
// $(".modal-body #editempmainid").val(id);

// $('#Firsthalf option').map(function () {
// if ($(this).text() == firsthalf) return this;
// }).attr('selected', 'selected');

// $('#Secondhalf option').map(function () {
// if ($(this).text() == secondhalf) return this;
// }).attr('selected', 'selected'); 

// });
});