$( document ).ready(function() {
  
$("form#processcmpdetails").submit(function(e) {
e.preventDefault();  

var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Enter Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

var cmpstate = $("#cmpstate").val();
if(cmpstate ==""){
  $("#cmpstate").focus();
  $('#cmpstateerror').html("Please Select Company State");
  return false;
}else{$('#cmpstateerror').html("");}

var cmpaddress = $("#cmpaddress").val();
if(cmpaddress ==""){
  $("#cmpaddress").focus();
  $('#cmpaddresserror').html("Please Enter Company Address");
  return false;
}else{$('#cmpaddresserror').html("");}

var cmpweburl = $("#cmpweburl").val();
if(cmpweburl ==""){
  $("#cmpweburl").focus();
  $('#cmpweburlerror').html("Please Enter Company WebSite URL");
  return false;
}else{$('#cmpweburlerror').html("");}

var cmptx = $("#cmptx").val();
if(cmptx ==""){
  $("#cmptx").focus();
  $('#cmptxerror').html("Please Enter Company Tax Deduction No");
  return false;
}else{$('#cmptxerror').html("");}

if($('input[type=checkbox]:checked').length == 0){
    $('#weekofferror').html( "Please Select at least one Week Off" );
    return false;
}else{$('#weekofferror').html("");}

var cmpcpno = $("#cmpcpno").val();
if(cmpcpno ==""){
  $("#cmpcpno").focus();
  $('#cmpcpnoerror').html("Please Enter Company Corporation No");
  return false;
}else{$('#cmpcpnoerror').html("");}

var cmpmtwlicence = $("#cmpmtwlicence").val();
if(cmpmtwlicence ==""){
  $("#cmpmtwlicence").focus();
  $('#cmpmtwlicenceerror').html("Please Enter Company Mtw Licence No");
  return false;
}else{$('#cmpmtwlicenceerror').html("");}

var cmpcity = $("#cmpcity").val();
if(cmpcity ==""){
  $("#cmpcity").focus();
  $('#cmpcityerror').html("Please Enter Company City");
  return false;
}else{$('#cmpcityerror').html("");}

var cmppincode = $("#cmppincode").val();
if(cmppincode ==""){
  $("#cmppincode").focus();
  $('#cmppincodeerror').html("Please Enter Company Pincode");
  return false;
}else{$('#cmppincodeerror').html("");}

var cmpmobile = $("#cmpmobile").val();
if(cmpmobile ==""){
  $("#cmpmobile").focus();
  $('#cmpmobileerror').html("Please Enter Company Mobile No");
  return false;
}else{$('#cmpmobileerror').html("");}

var cmplandline = $("#cmplandline").val();
if(cmplandline ==""){
  $("#cmplandline").focus();
  $('#cmplandlineerror').html("Please Company Landline No");
  return false;
}else{$('#cmplandlineerror').html("");}

var cmpfax = $("#cmpfax").val();
if(cmpfax ==""){
  $("#cmpfax").focus();
  $('#cmpfaxerror').html("Please Enter Company Fax No");
  return false;
}else{$('#cmpfaxerror').html("");}

var cmpemail = $("#cmpemail").val();
if(cmpemail ==""){
  $("#cmpemail").focus();
  $('#cmpemailerror').html("Please Company Email Id");
  return false;
}else{$('#cmpemailerror').html("");}

var cmpfnyyear = $("#cmpfnyyear").val();
if(cmpfnyyear ==""){
  $("#cmpfnyyear").focus();
  $('#cmpfnyyearerror').html("Please Select Company Financial Year Type");
  return false;
}else{$('#cmpfnyyearerror').html("");}

var cmpestdate = $("#cmpestdate").val();
if(cmpestdate ==""){
  $("#cmpestdate").focus();
  $('#cmpestdateerror').html("Please Enter Company Establishment Date");
  return false;
}else{$('#cmpestdateerror').html("");}

var cmpgratuitycode = $("#cmpgratuitycode").val();
if(cmpgratuitycode ==""){
  $("#cmpgratuitycode").focus();
  $('#cmpgratuitycodeerror').html("Please Enter Company Gratuity Code");
  return false;
}else{$('#cmpgratuitycodeerror').html("");}

var cmpgratuitydate = $("#cmpgratuitydate").val();
if(cmpgratuitydate ==""){
  $("#cmpgratuitydate").focus();
  $('#cmpgratuitydateerror').html("Please Enter Company Gratuity Date");
  return false;
}else{$('#cmpgratuitydateerror').html("");}

var cmpcntpermb = $("#cmpcntpermb").val();
if(cmpcntpermb ==""){
  $("#cmpcntpermb").focus();
  $('#cmpcntpermberror').html("Please Enter Company Contact Person Mobile");
  return false;
}else{$('#cmpcntpermberror').html("");}

var cmpcntper = $("#cmpcntper").val();
if(cmpcntper ==""){
  $("#cmpcntper").focus();
  $('#cmpcntpererror').html("Please Enter Company Contact Person Name");
  return false;
}else{$('#cmpcntpererror').html("");}

if(cmp == 1){
  mainurl = baseurl+'admin/savecompanydetails';
}else if(cmp == 2){
  mainurl = baseurl+'admin/saveeditcompanydetails';
}

var formData = new FormData(this);
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
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
  var delcmpnameid = $('#delcmpid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delcmpnameid},
      url: baseurl + 'admin/deletecompany',
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
$(".modal-body #delcmpname").html(companyname);
$(".modal-body #delcmpid").val(id);
});