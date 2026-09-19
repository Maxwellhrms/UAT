$( document ).ready(function() {
	
$("form#processholidaydetails").submit(function(e) {
e.preventDefault();

var notificationtitle = $("#notificationtitle").val();
if(notificationtitle ==""){
  $("#notificationtitle").focus();
  $('#notificationtitleerror').html("Please Enter Circular Title");
  return false;
}else{$('#notificationtitleerror').html("");}


var desc = $("#desc").val();
if(desc ==""){
  $("#desc").focus();
  $('#descerror').html("Please Enter Description");
  return false;
}else{$('#descerror').html("");}

if(nt == 1){
mainurl = baseurl+'admin/savenotificationdetails';
}else if(nt ==2){
mainurl = baseurl+'admin/editnotificationdetails';
}

    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
          // console.log(data);
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