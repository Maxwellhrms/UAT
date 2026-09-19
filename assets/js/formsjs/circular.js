$( document ).ready(function() {
	
$("form#processholidaydetails").submit(function(e) {
e.preventDefault();

var circularno = $("#circularno").val();
if(circularno ==""){
  $("#circularno").focus();
  $('#circularnoerror').html("Please Enter Circular No");
  return false;
}else{$('#circularnoerror').html("");}

var circulartitle = $("#circulartitle").val();
if(circulartitle ==""){
  $("#circulartitle").focus();
  $('#circulartitleerror').html("Please Enter Circular Title");
  return false;
}else{$('#circulartitleerror').html("");}


var desc = $("#desc").val();
if(desc ==""){
  $("#desc").focus();
  $('#descerror').html("Please Enter Description");
  return false;
}else{$('#descerror').html("");}

if(cr == 1){
mainurl = baseurl+'admin/savecirculardetails';
}else if(cr ==2){
mainurl = baseurl+'admin/editcirculardetails';
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