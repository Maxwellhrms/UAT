$(document).ready(function () {
	// Personal Information
	$("form#updatepersonaldeatils").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    mainurl = baseurl + 'employee/updateemployeedetails';
    var resp = ajaxfunction(mainurl,formData);
    alert(resp);
	});
	// End Personal Information
	// Academic Records
	$("form#updateacademic").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updateemployeeacademicdetails';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Academic Records
	// Training 
	$("form#updatetraining").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updateemployeetraining';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Training
  // Employee Documents
$("form#addnew_employee_document").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    mainurl = baseurl + 'employee/addemployeedocument';

    var resp = ajaxfunction(mainurl, formData);

    alert(resp);
});
// End Employee Documents
// Update Employee Documents
$("form#updateemployeedocuments").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    mainurl = baseurl + 'employee/updateemployeedocuments';

    var resp = ajaxfunction(mainurl, formData);

    alert(resp);
});
// End Update Employee Documents
	// Family Information
	$("form#updatefamily").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updateemployeefamily';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Family Information
	// updatelanguage
		$("form#updatelanguage").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updatelanguage';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
		// updatelanguage
	// Previous Employeement
	$("form#updatepreviousemp").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updatepreviousemp';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Previous Employeement
	// Refrences
	$("form#updaterefrences").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updaterefrences';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	    window.location.reload();
	});
	// End Refrences
	// Nominee 
	$("form#updatenominee").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updatenominee';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Nominee 
	// Bank
	$("form#updatebank").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updatebank';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Bank
	// Address
	$("form#updateaddress").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/updateaddress';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	});
	// End Address
	
// add new popup
	// Add family
	$("form#addnewfamily").submit(function (e) {
		e.preventDefault();
	    var formData = new FormData(this);
	    mainurl = baseurl + 'employee/addnewfamily';
	    var resp = ajaxfunction(mainurl,formData);
	    alert(resp);
	    window.location.reload()
	});
	// End Add family
// add new popup


	// add new popup
	// Add refrence
	$("form#addnew_refr").submit(function (e) {
		e.preventDefault();
		var formData = new FormData(this);
		mainurl = baseurl + "employee/addnew_refr";
		var resp = ajaxfunction(mainurl, formData);
		alert(resp);
		window.location.reload();
	});
	// End Add refrence
	
		
	$("form#addnew_academic").submit(function (e) {
		e.preventDefault();
		var formData = new FormData(this);
		mainurl = baseurl + "employee/addnew_academic";
		var resp = ajaxfunction(mainurl, formData);
		alert(resp);
		window.location.reload();
	});
	
	$("form#addnew_training").submit(function (e) {
		e.preventDefault();
		var formData = new FormData(this);
		mainurl = baseurl + "employee/addnew_training";
		var resp = ajaxfunction(mainurl, formData);
		alert(resp);
		window.location.reload();
	});
	
	$("form#addnew_previous_employment").submit(function (e) {
		e.preventDefault();
		var formData = new FormData(this);
		mainurl = baseurl + "employee/addnew_previous_employment";
		var resp = ajaxfunction(mainurl, formData);
		alert(resp);
		window.location.reload();
	});

	
	// add new popup

	
	//-------NEW BY SHABABU(21-12-2021)
	//AUTHORISATION 
   
    
	   $(".auth_type").change(function () {
    var attr_id = $(this).attr("id");
    var auth_type_id = $(this).val();
    var sp = attr_id.split('_');
    var id_no = sp[1];
    var branch_name = $("#brname").val();
    var comp_id = $("#cmpname").val();
    //    if(auth_type_id == 1){//----->BRANCH
    //        
    ////        if(branch_name != "" && branch_name != null && comp_id != "" && comp_id != null){
    //////            alert(branch_name);
    ////              $.ajax({
    ////                url: baseurl + 'admin/get_departments_based_on_auth_type',
    ////                type: 'POST',
    ////                data: {comp_id: comp_id,branch_id:branch_name,auth_type:auth_type_id},
    ////                success: function (data) {
    ////                    console.log(data);
    ////                    var parse_data = JSON.parse(data);
    ////                }
    ////            });
    ////        }else{
    ////            
    ////        }
    //    }else if(auth_type_id == 2){//----->HEAD OFFICE
    //        
    //    }else if(auth_type_id == 3){//-----> HR
    //        
    //    }else if(auth_type_id == 4){//------>DIRECTOR
    //        
    //    }

    if (branch_name != "" && branch_name != null && comp_id != "" && comp_id != null) {
      //            alert(branch_name);
      if (auth_type_id != "") {
        $.ajax({
          url: baseurl + 'admin/get_departments_based_on_auth_type',
          type: 'POST',
          data: { comp_id: comp_id, branch_id: branch_name, auth_type: auth_type_id },
          success: function (data) {
            console.log(data);
            var parse_data = JSON.parse(data);
            if (parse_data.length > 0) {
              $("#authdept_" + id_no).empty();
              $("#empname_" + id_no).empty();
              $("#authdept_" + id_no).append('<option value="">Select Department</option>');
              for (index in parse_data) {
                var dept_data = parse_data[index];
                var dept_code = dept_data['mxdpt_id'];
                var dept_name = dept_data['mxdpt_name'];
                $("#authdept_" + id_no).append('<option value="' + dept_code + '">' + dept_name + '</option>');
              }

            } else {
              $("#authdept_" + id_no).empty();
              $("#empname_" + id_no).empty();
              if (auth_type_id == 1) {//Branch
                alert("No Departments Found In the Selected Branch");
                return false;
              } else if (auth_type_id == 2) {//----->HEAD OFFICE
                alert("No Departments Found In the Head Office Branch");
                return false;
              } else if (auth_type_id == 3) {//-----> HR
                alert("There Is No HR Departments Found In the Head Office Branch");
                return false;
              } else if (auth_type_id == 4) {//------>DIRECTOR
                alert("There Is No Director Department Found In the Head Office Branch");
                return false;
              }
            }
          }
        });
      } else {
        $("#authdept_" + id_no).empty();
        $("#empname_" + id_no).empty();
      }
    } else {
      alert("Please Select Branch....");
      $("#authdept_" + id_no).empty();
      $("#empname_" + id_no).empty();
    }

  });
  
  
      //----------END GET DEPARTMENTS
      //----------GET EMPLOYEES BASED ON THE DEPT NAME
      $(".auth_dept").change(function () {
        var dept_id = $(this).val();
    
        var branch_name = $("#brname").val();
        var comp_id = $("#cmpname").val();
        //        alert(dept_id);
        var dept_attr_id = $(this).attr("id");
        var sp = dept_attr_id.split('_');
        var id_no = sp[1];
        var emp_name_id = "#empname_" + id_no;
        var auth_type_id = $("#authtype_" + id_no).val();
    
        if (branch_name != "" && branch_name != null && comp_id != "" && comp_id != null) {
          if (dept_id != "" && dept_id != null) {
            $.ajax({
              url: baseurl + 'admin/get_employee_info_based_on_departments',
              type: 'POST',
              data: { comp_id: comp_id, branch_id: branch_name, dept_id: dept_id, auth_type: auth_type_id },
              success: function (data) {
                console.log(data);
                var parse_data = JSON.parse(data);
                if (parse_data.length > 0) {
                  $(emp_name_id).empty();
                  $(emp_name_id).append('<option value="">Select Authorisation</option>');
                  for (index in parse_data) {
                    var auth_data = parse_data[index];
                    var auth_emp_code = auth_data['mxemp_emp_id'];
                    var auth_emp_name = auth_data['mxemp_emp_lname'] + " " + auth_data['mxemp_emp_fname'];
                    var auth_comp_code = auth_data['mxemp_emp_comp_code'];
                    var auth_comp_name = auth_data['mxcp_name'];
                    var auth_branch_code = auth_data['mxemp_emp_branch_code'];
                    var auth_branch_name = auth_data['mxb_name'];
                    var auth_dept_code = auth_data['mxemp_emp_dept_code'];
                    var auth_dept_name = auth_data['mxdpt_name'];
                    var auth_desg_code = auth_data['mxemp_emp_desg_code'];
                    var auth_desg_name = auth_data['mxdesg_name'];
                    var auth_state_id = auth_data['mxemp_emp_state_code'];
                    var auth_state_name = auth_data['mxst_state'];
                    var auth_div_id = auth_data['mxemp_emp_division_code'];
                    var auth_div_name = auth_data['mxd_name'];
                    var opt_data = auth_emp_code + " - " + auth_emp_name + " - " + auth_desg_name
                    var opt_val = auth_emp_code + "~" + auth_comp_code + "~" + auth_comp_name + "~" + auth_branch_code + "~" + auth_branch_name + "~" + auth_dept_code + "~" + auth_dept_name + '~' + auth_state_id + '~' + auth_state_name + '~' + auth_div_id + '~' + auth_div_name
                    $(emp_name_id).append('<option value="' + opt_val + '">' + opt_data + '</option>');
                  }
    
                } else {
                  //$("#authdept_" + id_no).empty();
                  $("#empname_" + id_no).empty();
                  if (auth_type_id == 1) {//Branch
                    alert("No Employees Found In the Selected Branch");
                    return false;
                  } else if (auth_type_id == 2) {//----->HEAD OFFICE
                    alert("No Employees Found In the Head Office Branch");
                    return false;
                  } else if (auth_type_id == 3) {//-----> HR
                    alert("There Is No Employees in HR Departments In the Head Office Branch");
                    return false;
                  } else if (auth_type_id == 4) {//------>DIRECTOR
                    alert("There Is No Employees in Director Department In the Head Office Branch");
                    return false;
                  }
                }
              }
            });
          } else {
            $("#authdept_" + id_no).empty();
            $("#empname_" + id_no).empty();
          }
        } else {
          alert("Please Select Branch....");
          $("#authdept_" + id_no).empty();
          $("#empname_" + id_no).empty();
        }
      });
      //----------END GET EMPLOYEES BASED ON THE DEPT NAME
      //----------IF DIRECTOR DEPARTMENT DISABLE THE AUTHORISATION
    
      $("#departmentname").change(function () {
        var is_director = $(this).find(":selected").data("is_director");
        if (is_director == 1) {//---------> For Directors No Need Of Having Authorisations
          $("#authorizationinformation").removeClass("active");
          $("#authorizationinformation").addClass("isDisabled");
          $("#authorizationinformation").attr("href", "#");
          $("#solid-justified-tab8").removeClass("active");
    
        } else {
          $("#authorizationinformation").removeClass("isDisabled");
          $("#authorizationinformation").attr("href", "#solid-justified-tab8");
        }
    
      });
      //----------END IF DIRECTOR DEPARTMENT DISABLE THE AUTHORISATION
      
      $("form#updateAuthorisation").submit(function (e) {
		e.preventDefault();
		// validations
        var cmpname = $("#cmpname").val();
        var company_name = $("#cmpname option:selected").text();
        if (cmpname == "" || cmpname == 0) {
          $("#cmpname").focus();
          $('#cmpnameerror').html("Please Select Company Name");
          return false;
        } else { $('#cmpnameerror').html(""); }
    
        var divname = $("#divname").val();
        var division_name = $("#divname option:selected").text();
        if (divname == "" || divname == 0) {
          $("#divname").focus();
          $('#divnameerror').html("Please Enter Division");
          return false;
        } else { $('#divnameerror').html(""); }
    
        var brname = $("#brname").val();
        var branch_name = $("#brname option:selected").text();
        if (brname == "" || brname == 0) {
          $("#brname").focus();
          $('#brnameerror').html("Please Enter Branch Name");
          return false;
        } else { $('#brnameerror').html(""); }
    
        var emptype = $("#emptype").val();
        if (emptype == "" || emptype == 0) {
          $("#emptype").focus();
          $('#emptypeerror').html("Please Select Employee Type");
          return false;
        } else { $('#emptypeerror').html(""); }
    
        var departmentname = $("#departmentname").val();
        if (departmentname == "" || departmentname ==0) {
          $("#departmentname").focus();
          $('#departmentnameerror').html("Please Select Department");
          return false;
        } else { $('#departmentnameerror').html(""); }
    
        var gradename = $("#gradename").val();
        if (gradename == "" || gradename == 0) {
          $("#gradename").focus();
          $('#gradenameerror').html("Please Select Grade");
          return false;
        } else { $('#gradenameerror').html(""); }
    
        var designationname = $("#designationname").val();
        if (designationname == "" || designationname == 0) {
          $("#designationname").focus();
          $('#designationnameerror').html("Please Select Designation");
          return false;
        } else { $('#designationnameerror').html(""); }
    
        var cmpstate = $("#cmpstate").val();
        var state_name = $("#cmpstate option:selected").text();
        if (cmpstate == "" || cmpstate == 0) {
          $("#cmpstate").focus();
          $('#cmpstateerror').html("Please Select Company State");
          return false;
        } else { $('#cmpstateerror').html(""); }
        cmpstate_array = cmpstate.split('@~@');
        cmp_state_id = cmpstate_array[0];
        // alert(cmpstate_array[0]);return false;
        
        var empdoj = $("#empdoj").val();
        if (empdoj == "") {
          $("#empdoj").focus();
          $('#personalinformation').trigger("click");
          $('#empdojerror').html("Please Select Employee Date Of Joining");
          return false;
        } else { $('#empdojerror').html(""); }
        
        
        if(is_director != 1 && is_hr != 1){
            var is_flag = 0;
            var authorizationtype = document.getElementsByName('authorizationtype[]');
            for (i = 0; i < authorizationtype.length; i++) {
              if (authorizationtype[i].value == 3) {
                is_flag = 1;
              }
            }
            if(is_flag == 0){
                $('#authorizationinformation').trigger("click");
                alert('Hr Authorization Type is mandatory except directors and HR');
                return false;
            }
        }
        
        var emp_id = $("#employeeid").val();
		
		var formData = new FormData(this);
        formData.append("cmpname",cmpname);
        formData.append("divname",divname);
        formData.append("brname",brname);
        formData.append("cmpstate",cmp_state_id);
        formData.append("employeeid",emp_id);
        formData.append("empdoj",empdoj);
        mainurl = baseurl + 'admin/update_authorisations';
        
        $.ajax({
          url: mainurl,
          type: 'POST',
          data: formData,
          success: function (data) {
            console.log(data);
            if (data == 200) {
              alert('Successfully Updated Authorisation');
              setTimeout(function () {
                window.location.reload();
              }, 1000);
            } else if(data == 132){
                alert("Create Employees Attendance Table First......");
                return false;
            }else {
              alert('Failed To Save Please TryAgain later');
            }
          },
          cache: false,
          contentType: false,
          processData: false
        });
    		
      });
      
      
	//END AUTHORISATION 
	//-------END NEW BY SHABABU(21-12-2021)
	
});
var re = '0';
function ajaxfunction(mainurl,formData){
	$.ajax({
      url: mainurl,
      async: false,
      type: 'POST',
      data: formData,
      success: function (data) {
        //   console.log(data);
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