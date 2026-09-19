$(document).ready(function () {

		
$('#empdob').on('dp.change', function(e){ 
	// var formatedValue = e.date.format(e.date._f);
	var dob = $(this).val();
	var sp = dob.split('-');
	var dob_ymd = sp[2]+'/'+sp[1]+'/'+sp[0];
	// alert('age: ' + getAge("1994/06/19"));
	var age = getAge(dob_ymd);
	$("#empage").val(age);
  })
  function getAge(dateString) { //"1994/06/19"
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
		age--;
	}
	return age;
  }

	// Personal Information
	$("form#updatepersonaldeatils").submit(function (e) {
        e.preventDefault();
        // alert('hi');
        var formData = new FormData(this);
        mainurl = baseurl + 'recruitment/updatepersonaldeatils';
        var resp = ajaxfunction(mainurl,formData);
        alert(resp);
	});
	// End Personal Information

	// Academic Records
// 	$("form#updateacademic").submit(function (e) {
// 		e.preventDefault();
// 	    var formData = new FormData(this);
// 	    mainurl = baseurl + 'recruitment/updaterecruitmentacademicdetails';
// 	    var resp = ajaxfunction(mainurl,formData);
// 	    alert(resp);
// 	});
	// End Academic Records

	// Family Information
// 	$("form#updatefamily").submit(function (e) {
// 		e.preventDefault();
// 	    var formData = new FormData(this);
// 	    mainurl = baseurl + 'recruitment/updaterecruitmentfamily';
// 	    var resp = ajaxfunction(mainurl,formData);
// 	    alert(resp);
// 	});
	// End Family Information

	// Previous Employeement
	$("form#updatepreviousrec").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'recruitment/updatepreviousrecruitment';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Previous Employeement

	// Refrences
	$("form#updaterefrences").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'recruitment/updaterefrences';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Refrences

	// Address
// 	$("form#updateaddress").submit(function (e) {
// 		e.preventDefault();
// 	    var formData = new FormData(this);
// 	    mainurl = baseurl + 'recruitment/updateaddress';
// 	    var resp = ajaxfunction(mainurl,formData);
// 	    alert(resp);
// 	});
	// End Address
	
});

var re = '0';
function ajaxfunction(mainurl,formData){
	$.ajax({
      url: mainurl,
      async: false,
      type: 'POST',
      data: formData,
      success: function (data) {
         if(data == 200){
        	 re = "Success";
        }else{
			 re = "Failed";
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });
    return re;
}

/*
$("form#editjobmangedetails").submit(function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	mainurl = baseurl + 'recruitment/editjobmangedetails';
	$.ajax({
	url: mainurl,
	async: false,
	type: 'POST',
	data: formData,
	success: function (data) {
		if(data == 200){
			alert( "Success");
		}else{
			alert("Failed");
		}
	},
	cache: false,
	contentType: false,
	processData: false
	});
});

*/

	