$( document ).ready(function() {
  
$("form#processdesignationdetails").submit(function(e) {
e.preventDefault();  

var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Select Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

var gradename = $("#gradename").val();
if(gradename ==""){
  $("#gradename").focus();
  $('#gradenameerror').html("Please Select Grade");
  return false;
}else{$('#gradenameerror').html("");}

var designationname = $("#designationname").val();
if(designationname ==""){
  $("#designationname").focus();
  $('#designationnameerror').html("Please Select Designation Name");
  return false;
}else{$('#designationnameerror').html("");}

if(des == 1){
  mainurl = baseurl+'admin/savedesignationdetails';
}else if(des == 2){
  mainurl = baseurl+'admin/saveeditdesignationdetails';
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
            setTimeout(function(){
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

$( "#processdeletedata" ).click(function() {
  event.preventDefault();
  var delid = $('#deldesid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delid},
      url: baseurl + 'admin/deletedesignation',
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

});

$(document).on("click", ".deletemodal", function () {
var deletedetails = $(this).data('id');
var x = deletedetails.split("~",3);
var id = x[0];
var companyname = x[1];
$(".modal-body #deldesname").html(companyname);
$(".modal-body #deldesid").val(id);
});