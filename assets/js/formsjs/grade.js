$( document ).ready(function() {
  
$("form#processgradedetails").submit(function(e) {
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
  $('#gradenameerror').html("Please Enter Grade");
  return false;
}else{$('#gradenameerror').html("");}


if(gr == 1){
  mainurl = baseurl+'admin/savegradedetails';
}else if(gr == 2){
  mainurl = baseurl+'admin/saveeditgradedetails';
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
  var delid = $('#delgrid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delid},
      url: baseurl + 'admin/deletegrade',
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
$(".modal-body #delgrname").html(companyname);
$(".modal-body #delgrid").val(id);
});