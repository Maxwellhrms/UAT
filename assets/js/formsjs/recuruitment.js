
$( document ).ready(function() {
        $("div.branch").hide();
        $("div.altbranch").hide();



$('input[type="radio"]').click(function(){
    var bid = $(this).attr("value");
	  if(bid == 1){
        $("div.altbranch").hide();
        $("div.branch").show();

	  }else if(bid == 2) {
        $("div.branch").hide();
        $("div.altbranch").show();

	  }
    });
   
		
$('#empdob').on('dp.change', function(e){ 
  // var formatedValue = e.date.format(e.date._f);
  var dob = $(this).val();
  var sp = dob.split('-');
  var dob_ymd = sp[2]+'/'+sp[1]+'/'+sp[0];
  // alert('age: ' + getAge("1994/06/19"));
  var age = getAge(dob_ymd);
  $("#empage").val(age);
  
})
function getAge(dateString) {//"1994/06/19"
  var today = new Date();
  var birthDate = new Date(dateString);
  var age = today.getFullYear() - birthDate.getFullYear();
  var m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
  }
  return age;
}

  //---NEW BY SHABABU

  $( "#cmpname" ).change(function() {
      event.preventDefault();
      var cmpid = $("#cmpname").val();
    $.ajax({
        url: baseurl+'test/getdivision',
        type: 'POST',
        data: {companyid : cmpid},
        success: function (data) {
          $("#divname").html(data);
        },
    });

    $.ajax({
        url: baseurl+'test/getdepartment',
        type: 'POST',
        data: {companyid : cmpid},
        success: function (data) {
          $("#departmentname").html(data);
        },
    });


  });

  $("#divname").change(function () {
    var comp_id = $("#cmpname").val();
    var div_id = $(this).val();
//        alert(comp_id);
    if (comp_id != 0 && comp_id != "" && div_id != 0 && div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_states(comp_id, div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#cmpstate").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#brname").empty().append(option);
    }
});

var states_array = [];
var esi_selected_state;
function load_states(comp_id, div_id, selected_state) {
//    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': comp_id, 'div_id': div_id},
        success: function (data) {
            states_array = JSON.parse(data);
        }
    });

    var option;
//        console.log(states_array);
    if (states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in states_array) {
            var states_array_index = states_array[index];
//                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (esi_selected_state == states_array_index.mxst_id) {
                option += "<option value=" + states_array_index.mxst_id + " selected>" + states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + states_array_index.mxst_id + ">" + states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#cmpstate").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#brname").empty().append(option);
}
//------End Load States
//------Load Branches
$("#cmpstate").change(function () {
    var comp_id = $("#cmpname").val();
    var div_id = $("#divname").val();
    var state_id = $(this).val();
    if (comp_id != 0 && comp_id != "" && div_id != 0 && div_id != "" && state_id != 0 && state_id != "") {
        load_branches(comp_id, div_id, state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#brname").empty().append(option);
    }
});
var branches_array = [];
var selected_branch;
function load_branches(comp_id, div_id, state_id, selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id': comp_id, 'div_id': div_id, 'state_id': state_id},
        success: function (data) {
//                    console.log(data);
            branches_array = JSON.parse(data);

        }
    });


    var option;
    if (branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in branches_array) {
            var branches_array_index = branches_array[index];
            if (selected_branch == branches_array_index.mxb_id) {
                option += "<option value=" + branches_array_index.mxb_id + " selected>" + branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + branches_array_index.mxb_id + ">" + branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#brname").empty().append(option);
}
 

$("form#processemployeedetails").submit(function(e) {
e.preventDefault();  

// validations
var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Select Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

var divname = $("#divname").val();
if(divname ==""){
  $("#divname").focus();
  $('#divnameerror').html("Please Enter Division");
  return false;
}else{$('#divnameerror').html("");}

var cmpstate = $("#cmpstate").val();
if(cmpstate =="" || cmpstate == '0'){
  $("#cmpstate").focus();
  $('#cmpstateerror').html("Please Select Company State");
  return false;
}else{$('#cmpstateerror').html("");}

// ------------------added 23-5-2021----------
if ($('input[name=inoutid]:checked').length <= 0) {      
  $("#inoutid").focus();
  $('#inoutiderror').html("Please Select radio button");
  return false;
}else {
  var rdval1= $('input[id=inoutid1]:checked').val();
  var rdval2 = $('input[id=inoutid2]:checked').val();
  $('#inoutiderror').html("");
  if(rdval1 == 1){
    var brname1 = $("#brname").val();
    if(brname1 ==''){
      $("#divname").focus();
      $('#brnameerror').html("Please Select Branch ");
      return false;    
    }else{ $('#brnameerror').html("");}
  }else if(rdval2 == 2){
    var brname2 = $("#altbranch").val();
   // var brname2 = document.getElementsByName('altbranch'),val();
    if (brname2 ==''){
      $("#altbranch").focus();
      $('#altbrancherror').html("Please Enter Alternate Branch ");
      return false;    
    }else{
      $('#altbrancherror').html(""); }
  }
}

// ------------------ end added 23-5-2021----------

var departmentname = $("#departmentname").val();
if(departmentname ==""){
  $("#departmentname").focus();
  $('#departmentnameerror').html("Please Select Department");
  return false;
}else{$('#departmentnameerror').html("");}

var designationname = $("#designationname").val();
if(designationname ==""){
  $("#designationname").focus();
  $('#designationnameerror').html("Please Select Designation");
  return false;
}else{$('#designationnameerror').html("");}

// Personalinformation
var empfname = $("#empfname").val();
if(empfname ==""){
  $("#empfname").focus();
  $('#personalinformation').trigger("click");
  $('#empfnameerror').html("Please Enter First Name");
  return false;
}else{$('#empfnameerror').html("");}

// var empemail = $("#empemail").val();
// if(empemail ==""){
//   $("#empemail").focus();
//   $('#personalinformation').trigger("click");
//   $('#empemailerror').html("Please Enter Email");
//   return false;
// }else{$('#empemailerror').html("");}

var empmobile = $("#empmobile").val();
if(empmobile ==""){
  $("#empmobile").focus();
  $('#personalinformation').trigger("click");
  $('#empmobileerror').html("Please Enter Mobile");
  return false;
}else{$('#empmobileerror').html("");}

var empaltmobile = $("#empaltmobile").val();
if(empaltmobile ==""){
  $("#empaltmobile").focus();
  $('#personalinformation').trigger("click");
  $('#empaltmobileerror').html("Please Enter Alternative Mobile");
  return false;
}else{$('#empaltmobileerror').html("");}


var empmtongue = $("#empmtongue").val();
if(empmtongue ==""){
  $("#empmtongue").focus();
  $('#personalinformation').trigger("click");
  $('#empmtongueerror').html("Please Enter Mother Tongue");
  return false;
}else{$('#empmtongueerror').html("");}

var empage = $("#empage").val();

if(empage ==""){

  $("#empage").focus();
  $('#personalinformation').trigger("click");
  $('#empageerror').html("Please Enter Age");
  return false;
}else{$('#empageerror').html("");}

if(parseInt(empage) <18){
  $("#empage").focus();
  $('#personalinformation').trigger("click");
  $('#empageerror').html("Minor Candidates Not Allowed...");
  return false;
}else{
  $('#empageerror').html("");
}

var empmarital = $("#empmarital").val();
if(empmarital ==""){
  $("#empmarital").focus();
  $('#personalinformation').trigger("click");
  $('#empmaritalerror').html("Please Select Marital");
  return false;
}else{$('#empmaritalerror').html("");}

var empnative = $("#empnative").val();
if(empnative ==""){
  $("#empnative").focus();
  $('#personalinformation').trigger("click");
  $('#empnativeerror').html("Please Select Native");
  return false;
}else{$('#empnativeerror').html("");}

var empsalary = $("#empsalary").val();
if(empsalary ==""){
  $("#empsalary").focus();
  $('#personalinformation').trigger("click");
  $('#empsalaryerror').html("Please Enter Expected Salary");
  return false;
}else{$('#empsalaryerror').html("");}



var empresumedate = $("#empresumedate").val();
if(empresumedate ==""){
  $("#empresumedate").focus();
  $('#personalinformation').trigger("click");
  $('#empresumedateerror').html("Please Enter Resume Received Date");
  return false;
}else{$('#empsalaryerror').html("");}

// Academic Records
// var empacrtype = document.getElementsByName('empacrtype[]');
// for (i=0; i<empacrtype.length; i++){
//   if (empacrtype[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Select Academic Records Type');
//      return false;
//     }
//   }

// var empacryop = document.getElementsByName('empacryop[]');
// for (i=0; i<empacryop.length; i++){
//   if (empacryop[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Enter Academic Records Year of Passing');
//      return false;
//     }
//   }

// var empacrinstitution = document.getElementsByName('empacrinstitution[]');
// for (i=0; i<empacrinstitution.length; i++){
//   if (empacrinstitution[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Enter Academic Records Institution');
//      return false;
//     }
//   }

// var empacrsubject = document.getElementsByName('empacrsubject[]');
// for (i=0; i<empacrsubject.length; i++){
//   if (empacrsubject[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Enter Academic Records Subject');
//      return false;
//     }
//   }

// var empacruniversity = document.getElementsByName('empacruniversity[]');
// for (i=0; i<empacruniversity.length; i++){
//   if (empacruniversity[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Enter Academic Records University');
//      return false;
//     }
//   }

// var empacrmarks = document.getElementsByName('empacrmarks[]');
// for (i=0; i<empacrmarks.length; i++){
//   if (empacrmarks[i].value == ""){
//     $('#personalinformation').trigger("click");
//      alert('Please Enter Academic Records Marks');
//      return false;
//     }
//   }  
  // Academic Records

// Family Information
// var empfmrelation = document.getElementsByName('empfmrelation[]');
// for (i=0; i<empfmrelation.length; i++){
//   if (empfmrelation[i].value == ""){
//     $('#familyinformation').trigger("click");
//      alert('Please Select Family Relation');
//      return false;
//     }
//   }

// var empfmname = document.getElementsByName('empfmname[]');
// for (i=0; i<empfmname.length; i++){
//   if (empfmname[i].value == ""){
//     $('#familyinformation').trigger("click");
//      alert('Please Enter Family Relation Name');
//      return false;
//     }
//   }

// var empfmage = document.getElementsByName('empfmage[]');
// for (i=0; i<empfmage.length; i++){
//   if (empfmage[i].value == ""){
//     $('#familyinformation').trigger("click");
//      alert('Please Enter Family Relation Age');
//      return false;
//     }
//   }

// var empfmoccupation = document.getElementsByName('empfmoccupation[]');
// for (i=0; i<empfmoccupation.length; i++){
//   if (empfmoccupation[i].value == ""){
//     $('#familyinformation').trigger("click");
//      alert('Please Enter Family Relation Occupation');
//      return false;
//     }
//   }
// Family Information
// Address
// var emppreaddress1 = $("#emppreaddress1").val();
// if(emppreaddress1 ==""){
//   $("#emppreaddress1").focus();
//   $('#addressinformation').trigger("click");
//   $('#emppreaddress1error').html("Please Enter Present Address1");
//   return false;
// }else{$('#emppreaddress1error').html("");}

// var empprecity = $("#empprecity").val();
// if(empprecity ==""){
//   $("#empprecity").focus();
//   $('#addressinformation').trigger("click");
//   $('#empprecityerror').html("Please Enter Present City");
//   return false;
// }else{$('#empprecityerror').html("");}

// var empprestate = $("#empprestate").val();
// if(empprestate ==""){
//   $("#empprestate").focus();
//   $('#addressinformation').trigger("click");
//   $('#empprestateerror').html("Please Enter Present State");
//   return false;
// }else{$('#empprestateerror').html("");}

// var empprecountry = $("#empprecountry").val();
// if(empprecountry ==""){
//   $("#empprecountry").focus();
//   $('#addressinformation').trigger("click");
//   $('#empprecountryerror').html("Please Enter Present Country");
//   return false;
// }else{$('#empprecountryerror').html("");}

// var empprepostalcode = $("#empprepostalcode").val();
// if(empprepostalcode ==""){
//   $("#empprepostalcode").focus();
//   $('#addressinformation').trigger("click");
//   $('#empprepostalcodeerror').html("Please Enter Present POSTAl CODE");
//   return false;
// }else{$('#empprepostalcodeerror').html("");}

// var emppresince = $("#emppresince").val();
// if(emppresince ==""){
//   $("#emppresince").focus();
//   $('#addressinformation').trigger("click");
//   $('#emppresinceerror').html("Please Enter Present Address Since");
//   return false;
// }else{$('#emppresinceerror').html("");}

// var empfixedaddress1 = $("#empfixedaddress1").val();
// if(empfixedaddress1 ==""){
//   $("#empfixedaddress1").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedaddress1error').html("Please Enter Premanent Address1");
//   return false;
// }else{$('#empfixedaddress1error').html("");}

// var empfixedcity = $("#empfixedcity").val();
// if(empfixedcity ==""){
//   $("#empfixedcity").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedcityerror').html("Please Enter Premanent City");
//   return false;
// }else{$('#empfixedcityerror').html("");}

// var empfixedstate = $("#empfixedstate").val();
// if(empfixedstate ==""){
//   $("#empfixedstate").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedstateerror').html("Please Enter Premanent State");
//   return false;
// }else{$('#empfixedstateerror').html("");}

// var empfixedcountry = $("#empfixedcountry").val();
// if(empfixedcountry ==""){
//   $("#empfixedcountry").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedcountryerror').html("Please Enter Premanent Country");
//   return false;
// }else{$('#empfixedcountryerror').html("");}

// var empfixedpostalcode = $("#empfixedpostalcode").val();
// if(empfixedpostalcode ==""){
//   $("#empfixedpostalcode").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedpostalcodeerror').html("Please Enter Premanent POSTAl CODE");
//   return false;
// }else{$('#empfixedpostalcodeerror').html("");}

// var empfixedpresince = $("#empfixedpresince").val();
// if(empfixedpresince ==""){
//   $("#empfixedpresince").focus();
//   $('#addressinformation').trigger("click");
//   $('#empfixedpresinceerror').html("Please Enter Premanent Residencey Date");
//   return false;
// }else{$('#empfixedpresinceerror').html("");}
// Address
// Previous Employment
var emppreviousprediofromto = document.getElementsByName('emppreviousprediofromto[]');
for (i=0; i<emppreviousprediofromto.length; i++){
   if (emppreviousprediofromto[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Period From To');
     return false;
    }
  }

  var emppreviousorgnation = document.getElementsByName('emppreviousorgnation[]');
for (i=0; i<emppreviousorgnation.length; i++){
   if (emppreviousorgnation[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Name & Orgnation');
     return false;
    }
  }

  var emppreviousdesgjointime = document.getElementsByName('emppreviousdesgjointime[]');
for (i=0; i<emppreviousdesgjointime.length; i++){
   if (emppreviousdesgjointime[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Desg.. Jointime');
     return false;
    }
  }

  var emppreviousleavingtime = document.getElementsByName('emppreviousleavingtime[]');
for (i=0; i<emppreviousleavingtime.length; i++){
   if (emppreviousleavingtime[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Desg.. Leavingtime');
     return false;
    }
  }

var emppreviousreportedto = document.getElementsByName('emppreviousreportedto[]');
for (i=0; i<emppreviousreportedto.length; i++){
   if (emppreviousreportedto[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Reportedto');
     return false;
    }
  }

  var empprevioussalarypermonth = document.getElementsByName('empprevioussalarypermonth[]');
for (i=0; i<empprevioussalarypermonth.length; i++){
   if (empprevioussalarypermonth[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Salarypermonth');
     return false;
    }
  }

  var emppreviousotherbenfits = document.getElementsByName('emppreviousotherbenfits[]');
for (i=0; i<emppreviousotherbenfits.length; i++){
   if (emppreviousotherbenfits[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous OtherBenfits');
     return false;
    }
  }

var emppreviousreasonchange = document.getElementsByName('emppreviousreasonchange[]');
for (i=0; i<emppreviousreasonchange.length; i++){
   if (emppreviousreasonchange[i].value == ""){
    $('#previousempinformation').trigger("click");
     alert('Please Enter Previous Reasonchange');
     return false;
    }
  }
// Previous Employment


if(emp == 1){
  mainurl = baseurl+'Recruitment/saveaddrecruitmentdetails';
}else if(emp == 2){
  mainurl = baseurl+'admin/saveeditemployeedetailsdetails';
}

var formData = new FormData(this);
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
       //console.log(data);
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
