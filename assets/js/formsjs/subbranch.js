$( document ).ready(function() {
  
$("form#processsubbrndetails").submit(function(e) {
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
  $('#divnameerror').html("Please Select Division");
  return false;
}else{$('#divnameerror').html("");}


var brname = $("#brname").val();
if(brname ==""){
  $("#brname").focus();
  $('#brnameerror').html("Please Select Branch Name");
  return false;
}else{$('#brnameerror').html("");}

var subbrname = $("#subbrname").val();
if(subbrname ==""){
  $("#subbrname").focus();
  $('#subbrnameerror').html("Please Enter SubBranch Name");
  return false;
}else{$('#subbrnameerror').html("");}

var subbraddress = $("#subbraddress").val();
if(subbraddress ==""){
  $("#subbraddress").focus();
  $('#subbraddresserror').html("Please Enter Branch Address");
  return false;
}else{$('#subbraddresserror').html("");}

var subbrshortcode = $("#subbrshortcode").val();
if(subbrshortcode ==""){
  $("#subbrshortcode").focus();
  $('#subbrshortcodeerror').html("Please Enter Branch Code");
  return false;
}else{$('#subbrshortcodeerror').html("");}

if(brn == 1){
  mainurl = baseurl+'admin/savesubbranchdetails';
}else if(brn == 2){
  mainurl = baseurl+'admin/saveeditsubbranchdetails';
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
  var delid = $('#delsubbrid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delid},
      url: baseurl + 'admin/deletesubbranch',
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
$(".modal-body #delsubbrname").html(companyname);
$(".modal-body #delsubbrid").val(id);
});