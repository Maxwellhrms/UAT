$( document ).ready(function() {
    
    $(".dir_hr").click(function(){
        var count = 0
        $(".dir_hr").each(function(){
            var is_checked = $(this).prop("checked");
            if(is_checked == true){
                count = count + 1
                if(count == 2){
                    $(this).prop("checked",false);
                    alert("You Cant Check Both isHR & isDirector for One Department");
                }
            }
        });
        
//        return false;
    });
  
$("form#processdepartmentdetails").submit(function(e) {
e.preventDefault();  

var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Select Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

var departmentname = $("#departmentname").val();
if(departmentname ==""){
  $("#departmentname").focus();
  $('#departmentnameerror').html("Please Enter Department Name");
  return false;
}else{$('#departmentnameerror').html("");}


if(dp == 1){
  mainurl = baseurl+'admin/savedepartmentdetails';
}else if(dp == 2){
  mainurl = baseurl+'admin/saveeditdepartmentdetails';
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
  var delid = $('#deldpid').val();

  $.ajax({
      async: false,
      type: "POST",
      data: {id : delid},
      url: baseurl + 'admin/deletedepartment',
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
$(".modal-body #deldpname").html(companyname);
$(".modal-body #deldpid").val(id);
});