$( document ).ready(function() {
  
$("form#processdvdetails").submit(function(e) {
e.preventDefault();  

var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Select Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

var divname = $("#divname").val();
if(divname ==""){
  $("#divname").focus();
  $('#divnameerror').html("Please Enter Division");
  return false;
}else{$('#divnameerror').html("");}

if(div == 1){
  mainurl = baseurl+'admin/savedivisondetails';
}else if(div == 2){
  mainurl = baseurl+'admin/saveeditdivisondetails';
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
  var delcmpnameid = $('#deldivid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delcmpnameid},
      url: baseurl + 'admin/deletedivision',
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
$(".modal-body #deldivname").html(companyname);
$(".modal-body #deldivid").val(id);
});