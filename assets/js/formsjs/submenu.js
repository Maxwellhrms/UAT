$( document ).ready(function() {

$("form#submenudetails").submit(function(e) {
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
  $('#menunameerror').html("Please Select Menu Name");
  return false;
}else{$('#menunameerror').html("");}


var submenuname = $("#submenuname").val();
if(submenuname ==""){
  $("#submenuname").focus();
  $('#submenunameerror').html("Please Enter Sub Menu Name");
  return false;
}else{$('#submenunameerror').html("");}

var submenulink = $("#submenulink").val();
if(submenulink ==""){
  $("#submenulink").focus();
  $('#submenulinkerror').html("Please Enter Sub Menu Link");
  return false;
}else{$('#submenulinkerror').html("");}

mainurl = baseurl+'developertools/savesubmenudetails';

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