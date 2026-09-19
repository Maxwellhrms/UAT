$( document ).ready(function() {

$("form#menudetails").submit(function(e) {
e.preventDefault();

var menutype = $("#menutype").val();
if(menutype ==""){
  $("#menutype").focus();
  $('#menutypeerror').html("Please Select Menu Type");
  return false;
}else{$('#menutypeerror').html("");}

var menuname = $("#menuname").val();
if(menuname ==""){
  $("#menuname").focus();
  $('#menunameerror').html("Please Enter Menu Name");
  return false;
}else{$('#menunameerror').html("");}


var menuicon = $("#menuicon").val();
if(menuicon ==""){
  $("#menuicon").focus();
  $('#menuiconerror').html("Please Enter Menu Icon");
  return false;
}else{$('#menuiconerror').html("");}

mainurl = baseurl+'developertools/savemenudetails';

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
});