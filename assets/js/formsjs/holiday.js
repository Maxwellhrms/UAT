$( document ).ready(function() {
	$("#hd_state_id").change(function () {
	var hd_selected_branch = 0;
    var hd_comp_id = $("#hd_company_id").val();

    var hd_state_id = $(this).val();
    if (hd_comp_id != "" && hd_state_id != "" && hd_state_id != "1001") {
    	$(".hldbrn").show();
        hd_load_branches(hd_comp_id,hd_state_id, hd_selected_branch)
    } else {
        var option = "<option value=''>Select Branch</option>";
        $("#hd_branch_id").empty().append(option);
        $(".hldbrn").hide();
    }
});
var hd_branches_array = [];
function hd_load_branches(hd_comp_id,hd_state_id, hd_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id':hd_comp_id,'state_id': hd_state_id},
        success: function (data) {
            // console.log(data);
            hd_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (hd_branches_array.length > 0) {
        option = "<option value=''>Select Branch</option>";
        for (index in hd_branches_array) {
            var hd_branches_array_index = hd_branches_array[index];
            if (hd_selected_branch == hd_branches_array_index.mxb_id) {
                option += "<option value=" + hd_branches_array_index.mxb_id + " selected>" + hd_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + hd_branches_array_index.mxb_id + ">" + hd_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=''>Select Branch</option>";
    }

    $("#hd_branch_id").empty().append(option);
}
	

	
$("form#processholidaydetails").submit(function(e) {
e.preventDefault();

var cmptype = $("#cmptype").val();
if(cmptype ==""){
  $("#cmptype").focus();
  $('#cmptypeerror').html("Please Select Holiday Type");
  return false;
}else{$('#cmptypeerror').html("");}


var hd_company_id = $("#hd_company_id").val();
if(hd_company_id ==""){
  $("#hd_company_id").focus();
  $('#hd_company_iderror').html("Please Select Company Name");
  return false;
}else{$('#hd_company_iderror').html("");}


var hd_divsion_name = $("#hd_divsion_name").val();
if(hd_divsion_name ==""){
  $("#hd_divsion_name").focus();
  $('#hd_divsion_nameerror').html("Please Select Division Name");
  return false;
}else{$('#hd_divsion_nameerror').html("");}

var hd_state_id = $("#hd_state_id").val();
if(hd_state_id ==""){
  $("#hd_state_id").focus();
  $('#hd_state_iderror').html("Please Select Holiday State");
  return false;
}else{$('#hd_state_iderror').html("");}

if(hd_state_id != 1001){
    var hd_branch_id = $("#hd_branch_id").val();
    if(hd_branch_id ==""){
      $("#hd_branch_id").focus();
      $('#hd_branch_iderror').html("Please Select Branch Name");
      return false;
    }else{$('#hd_branch_iderror').html("");}
}

var cmpholiday = $("#cmpholiday").val();
if(cmpholiday ==""){
  $("#cmpholiday").focus();
  $('#cmpholidayerror').html("Please Enter Holiday Date");
  return false;
}else{$('#cmpholidayerror').html("");}

var cmpholidayname = $("#cmpholidayname").val();
if(cmpholidayname ==""){
  $("#cmpholidayname").focus();
  $('#cmpholidaynameerror').html("Please Enter Holiday Name");
  return false;
}else{$('#cmpholidaynameerror').html("");}


// if(emp == 1){
  mainurl = baseurl+'admin/saveholidaydetails';
// }else if(emp == 2){
  // mainurl = baseurl+'admin/saveeditemployeedetailsdetails';
// }

var formData = new FormData(this);
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
      console.log(data);
        if (data == 200) {
            alert('Successfully');
            setTimeout(function(){
            window.location.reload();
            }, 1000); 
        }else if(data == 3){//---->current date <= applying date
            alert("You Cant Feed Holiday Date Less Than Current Date..");
        }else if(data == 4){//---->Salary Already Generated for the selected month and year
            alert("You Cant Feed Holiday Because Already Salary Generated for the selected Month and Year");
        }else{
        	alert('Failed To Save Please TryAgain later');
        }
    },
    cache: false,
    contentType: false,
    processData: false
});
});
});


$(document).on("click", ".deletemodal", function () {
var deletedetails = $(this).data('id');
var x = deletedetails.split("~",3);
var id = x[0];
var holidayname = x[1];
$(".modal-body #hldname").html(holidayname);
$(".modal-body #holidayid").val(id);
});

$( "#processdeletedata" ).click(function() {
  event.preventDefault();
  var holidayid = $('#holidayid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : holidayid},
      url: baseurl + 'admin/deleteholiday',
      datatype: "html",
      success: function (data) {
          console.log(data);
          if (data == 200) {
            alert('Success');
            window.location.reload();
          }else if(data == 3){//---->current date <= applying date
            alert("You Cant Delete Holiday Date Less Than Current Date..");
          }else if(data == 4){//---->Salary Already Generated for the selected month and year
            alert("You Cant Delete Holiday Because Already Salary Generated for the selected Month and Year");
          }else {
            alert('Try Again Later');
          }
      }
  });

});
