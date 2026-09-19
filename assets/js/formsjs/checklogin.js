$( document ).ready(function() {
  
$( "#process" ).click(function() {
  event.preventDefault();
  var employeeid = $("#employeeid").val();
  if(employeeid ==''){
  alert("Please Enter Your Employeeid");
  return false;
  }
  var psw = $("#userpassword").val();
  if(psw ==''){
  alert("Please Enter Your Password");
  return false;
  }

  var data = $("#loginuser").serialize();

  $.ajax({
      async: false,
      type: "POST",
      data: data,
      url: baseurl+'admin/logincheck',
      datatype: "html",
      success: function (data) {
        console.log(data);
          if (data == 200) {
            window.location.href = baseurl+"admin/dashboard";
          }else {
            alert('Invalid Creditionals');
          }
      }
  });

});
});