var pay_stucture_array = [];


$(document).ready(function () {
  //---NEW BY SHABABU

  //   $('#empdob').datetimepicker().on('dp.change', function (event) {
  //     alert('!!!');
  // });
  // $("#dateOfBirth").datetimepicker("change", function(){
  //     alert();
  //     console.log(dob);
  // })
  $('#empdob').on('dp.change', function (e) {
    // var formatedValue = e.date.format(e.date._f);
    var dob = $(this).val();
    var sp = dob.split('-');
    var dob_ymd = sp[2] + '/' + sp[1] + '/' + sp[0];
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

  $("#cmpname").change(function () {
    event.preventDefault();
    var cmpid = $("#cmpname").val();
    $.ajax({
      url: baseurl + 'test/getdivision',
      type: 'POST',
      data: { companyid: cmpid },
      success: function (data) {
        $("#divname").html(data);
      },
    });

    $.ajax({
      url: baseurl + 'test/getdepartment',
      type: 'POST',
      data: { companyid: cmpid },
      success: function (data) {
        $("#departmentname").html(data);
      },
    });

    $.ajax({
      url: baseurl + 'test/getgrade',
      type: 'POST',
      data: { companyid: cmpid },
      success: function (data) {
        $("#gradename").html(data);
      },
    });
    
    $.ajax({
      url: baseurl + 'test/gratuity',
      type: 'POST',
      data: { companyid: cmpid },
      success: function (data) {
        // console.log(data);
        $("#gratuity").html(data);
      },
    });

  });

  //   $( "#divname" ).change(function() {
  //       event.preventDefault();
  //       var comp_id = $("#cmpname").val();
  //       var divid = $("#divname").val();
  //       if (comp_id != 0 && comp_id != "" && divid != 0 && divid != "") {
  // //        load_esi_states(esi_comp_id, 0)
  //         load_states(comp_id, divid, 0);
  //     } else {
  //         var option = "<option value=0>Select State</option>";
  //         $("#cmpstate").empty().append(option);

  //         var option = "<option value=0>Select Branch</option>";
  //         $("#esi_branch_id").empty().append(option);
  //     }
  //     // $.ajax({
  //     //     url: baseurl+'test/getbranch',
  //     //     type: 'POST',
  //     //     data: {divisionid : divid},
  //     //     success: function (data) {
  //     //       $("#brname").html(data);
  //     //     },
  //     // });
  //   });
  //------Load States
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
      data: { 'comp_id': comp_id, 'div_id': div_id },
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
      data: { 'comp_id': comp_id, 'div_id': div_id, 'state_id': state_id },
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
  //------End Load Branches
  // $( "#brname" ).change(function() {
  //     event.preventDefault();
  //     var brid = $("#brname").val();
  //   $.ajax({
  //       url: baseurl+'test/getsubbranch',
  //       type: 'POST',
  //       data: {branchid : brid},
  //       success: function (data) {
  //         $("#subbrname").html(data);
  //       },
  //   });

  // });

  $("#gradename").change(function () {
    event.preventDefault();
    var grid = $("#gradename").val();
    $.ajax({
      url: baseurl + 'test/getdesignations',
      type: 'POST',
      data: { gradeid: grid },
      success: function (data) {
        $("#designationname").html(data);
      },
    });

  });

  $("#emptype").change(function () {
    event.preventDefault();

    var emtype = $("#emptype").val();
    //---------------GET EMPLOYEE ID
    $.ajax({
      url: baseurl + 'test/getemployeeid',
      type: 'POST',
      data: { employeetypeid: emtype },
      success: function (data) {
        $("#employeeid").val(data);
      },
    });
    //---------------END GET EMPLOYEE ID
    
  });


  $('.marital').change(function (e) {
    var mr = $('#empmarital').val();
    if (mr == "Married") {
      $(".openmrd").show();
    } else {
      $(".openmrd").hide();
    }
  });


  $('.hvvehicle').click(function (e) {
    var vh = $('.hvvehicle').val();
    if (vh == "HAVING VEHICLE") {
      $(".enableifhavingvehicle").show();
    }
  });

  $('.ntvehicle').click(function (e) {
    var nvh = $('.ntvehicle').val();
    $(".enableifhavingvehicle").hide();
  });

  $("form#processemployeedetails").submit(function (e) {
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

    // Personalinformation
    var empfname = $("#empfname").val();
    if (empfname == "") {
      $("#empfname").focus();
      $('#personalinformation').trigger("click");
      $('#empfnameerror').html("Please Enter Employee First Name");
      return false;
    } else { $('#empfnameerror').html(""); }

    /*var emplname = $("#emplname").val();
    if (emplname == "") {
      $("#emplname").focus();
      $('#personalinformation').trigger("click");
      $('#emplnameerror').html("Please Enter Employee Last Name");
      return false;
    } else { $('#emplnameerror').html(""); }*/

    var empbloodgroup = $("#empbloodgroup").val();
    if (empbloodgroup == "") {
      $("#empbloodgroup").focus();
      $('#personalinformation').trigger("click");
      $('#empbloodgrouperror').html("Please Select Employee Blood Group");
      return false;
    } else { $('#empbloodgrouperror').html(""); }

    var empmobile = $("#empmobile").val();
    if (empmobile == "") {
      $("#empmobile").focus();
      $('#personalinformation').trigger("click");
      $('#empmobileerror').html("Please Enter Employee Mobile");
      return false;
    } else { $('#empmobileerror').html(""); }

    var empaltmobile = $("#empaltmobile").val();
    if (empaltmobile == "") {
      $("#empaltmobile").focus();
      $('#personalinformation').trigger("click");
      $('#empaltmobileerror').html("Please Enter Employee Alternative Mobile");
      return false;
    } else { $('#empaltmobileerror').html(""); }

    var empmtongue = $("#empmtongue").val();
    if (empmtongue == "") {
      $("#empmtongue").focus();
      $('#personalinformation').trigger("click");
      $('#empmtongueerror').html("Please Enter Employee Mother Tongue");
      return false;
    } else { $('#empmtongueerror').html(""); }

    // var empguarantorsdetails = $("#empguarantorsdetails").val();
    // if (empguarantorsdetails == "") {
    //   $("#empguarantorsdetails").focus();
    //   $('#personalinformation').trigger("click");
    //   $('#empguarantorsdetailserror').html("Please Enter Employee Guarantors Details");
    //   return false;
    // } else { $('#empguarantorsdetailserror').html(""); }

    var empage = $("#empage").val();

    if (empage == "") {

      $("#empage").focus();
      $('#personalinformation').trigger("click");
      $('#empageerror').html("Please Enter Employee Age");
      return false;
    } else { $('#empageerror').html(""); }

    if (parseInt(empage) < 18) {
      $("#empage").focus();
      $('#personalinformation').trigger("click");
      $('#empageerror').html("Minor Candidates Not Allowed...");
      return false;
    } else {
      $('#empageerror').html("");
    }

    var empdoj = $("#empdoj").val();
    if (empdoj == "") {
      $("#empdoj").focus();
      $('#personalinformation').trigger("click");
      $('#empdojerror').html("Please Select Employee Date Of Joining");
      return false;
    } else { $('#empdojerror').html(""); }

    // cc
    var empemail = $("#empemail").val().trim();
    
    if (empemail == "") {
        alert();
      $("#empemail").focus();
      $('#personalinformation').trigger("click");
      $('#empemailerror').html("Please Enter Email");
      return false;
    } else { 
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
        if(!regex.test(empemail)){    
              $("#empemail").focus();
              $('#personalinformation').trigger("click");
              $('#empemailerror').html("Please Enter Valid Email");
              return false;    
        }else{
            $('#empemailerror').html(""); 
        }
    }

    var empdob = $("#empdob").val();
    if (empdob == "") {
      $("#empdob").focus();
      $('#personalinformation').trigger("click");
      $('#empdoberror').html("Please Enter Employee Date Of Birth");
      return false;
    } else { $('#empdoberror').html(""); }

    var empcaste = $("#empcaste").val();
    if (empcaste == "") {
      $("#empcaste").focus();
      $('#personalinformation').trigger("click");
      $('#empcasteerror').html("Please Select Employee Caste");
      return false;
    } else { $('#empcasteerror').html(""); }

    // var emplicense = $("#emplicense").val();
    // if(emplicense ==""){
    //   $("#emplicense").focus();
    //   $('#personalinformation').trigger("click");
    //   $('#emplicenseerror').html("Please Enter Employee License");
    //   return false;
    // }else{$('#emplicenseerror').html("");}

    var empmarital = $("#empmarital").val();
    if (empmarital == "") {
      $("#empmarital").focus();
      $('#personalinformation').trigger("click");
      $('#empmaritalerror').html("Please Select Employee Marital");
      return false;
    } else { $('#empmaritalerror').html(""); }

    var empsalary = $("#empsalary").val();
    if (empsalary == "") {
      $("#empsalary").focus();
      $('#personalinformation').trigger("click");
      $('#empsalaryerror').html("Please Enter Employee Salary");
      return false;
    } else { $('#empsalaryerror').html(""); }

    /*var emplanguage = $("#emplanguage").val();
    if(emplanguage ==""){
      $("#emplanguage").focus();
      $('#personalinformation').trigger("click");
      $('#emplanguageerror').html("Please Select Language1");
      return false;
    }else{$('#emplanguageerror').html("");}
    
    var lgtypes = document.getElementsByName('lgtypes[]');
    for (i=0; i<lgtypes.length; i++){
       if (lgtypes[i].value == ""){
        $('#personalinformation').trigger("click");
        $('#lgtypeserror').html("Please Select Language Type1");
         return false;
        }else{ $('#lgtypeserror').html(""); }
      }
    
    var emplanguage2 = $("#emplanguage2").val();
    if(emplanguage2 ==""){
      $("#emplanguage2").focus();
      $('#personalinformation').trigger("click");
      $('#emplanguage2error').html("Please Select Language2");
      return false;
    }else{$('#emplanguage2error').html("");}
    
    var lgtypes2 = document.getElementsByName('lgtypes2[]');
    for (i=0; i<lgtypes2.length; i++){
       if (lgtypes2[i].value == ""){
        $('#personalinformation').trigger("click");
        $('#lgtypes2error').html("Please Select Language Type2");
         return false;
        }else{ $('#lgtypes2error').html(""); }
      }
    
    var emplanguage3 = $("#emplanguage3").val();
    if(emplanguage3 ==""){
      $("#emplanguage3").focus();
      $('#personalinformation').trigger("click");
      $('#emplanguage3error').html("Please Select Language3");
      return false;
    }else{$('#emplanguage3error').html("");}
    
    var lgtypes3 = document.getElementsByName('lgtypes3[]');
    for (i=0; i<lgtypes3.length; i++){
       if (lgtypes3[i].value == ""){
        $('#personalinformation').trigger("click");
        $('#lgtypes3error').html("Please Select Language Type3");
         return false;
        }else{ $('#lgtypes3error').html(""); }
      }
    */
    // Personalinformation
    // Academic Records
    var empacrtype = document.getElementsByName('empacrtype[]');
    for (i = 0; i < empacrtype.length; i++) {
      if (empacrtype[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Select Academic Records Type');
        return false;
      }
    }

    var empacryop = document.getElementsByName('empacryop[]');
    for (i = 0; i < empacryop.length; i++) {
      if (empacryop[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Enter Academic Records Year of Passing');
        return false;
      }
    }

    var empacrinstitution = document.getElementsByName('empacrinstitution[]');
    for (i = 0; i < empacrinstitution.length; i++) {
      if (empacrinstitution[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Enter Academic Records Institution');
        return false;
      }
    }

    var empacrsubject = document.getElementsByName('empacrsubject[]');
    for (i = 0; i < empacrsubject.length; i++) {
      if (empacrsubject[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Enter Academic Records Subject');
        return false;
      }
    }

    var empacruniversity = document.getElementsByName('empacruniversity[]');
    for (i = 0; i < empacruniversity.length; i++) {
      if (empacruniversity[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Enter Academic Records University');
        return false;
      }
    }

    var empacrmarks = document.getElementsByName('empacrmarks[]');
    for (i = 0; i < empacrmarks.length; i++) {
      if (empacrmarks[i].value == "") {
        $('#personalinformation').trigger("click");
        alert('Please Enter Academic Records Marks');
        return false;
      }
    }
    // Academic Records
    // Training 
    // var emptrcourse = document.getElementsByName('emptrcourse[]');
    // for (i = 0; i < emptrcourse.length; i++) {
    //   if (emptrcourse[i].value == "") {
    //     $('#personalinformation').trigger("click");
    //     alert('Please Enter Training Course');
    //     return false;
    //   }
    // }

    // var emptrinstitution = document.getElementsByName('emptrinstitution[]');
    // for (i = 0; i < emptrinstitution.length; i++) {
    //   if (emptrinstitution[i].value == "") {
    //     $('#personalinformation').trigger("click");
    //     alert('Please Enter Training Institution');
    //     return false;
    //   }
    // }

    // var emptrfrom = document.getElementsByName('emptrfrom[]');
    // for (i = 0; i < emptrfrom.length; i++) {
    //   if (emptrfrom[i].value == "") {
    //     $('#personalinformation').trigger("click");
    //     alert('Please Enter Training From');
    //     return false;
    //   }
    // }

    // var emptrto = document.getElementsByName('emptrto[]');
    // for (i = 0; i < emptrto.length; i++) {
    //   if (emptrto[i].value == "") {
    //     $('#personalinformation').trigger("click");
    //     alert('Please Enter Training To');
    //     return false;
    //   }
    // }
    // Training  
    // Bank & Statutory
    var empbankname = $("#empbankname").val();
    if (empbankname == "") {
      $("#empbankname").focus();
      $('#bankinformation').trigger("click");
      $('#empbanknameerror').html("Please Enter Bank Name");
      return false;
    } else { $('#empbanknameerror').html(""); }

    var empbankbranch = $("#empbankbranch").val();
    if (empbankbranch == "") {
      $("#empbankbranch").focus();
      $('#bankinformation').trigger("click");
      $('#empbankbrancherror').html("Please Enter Bank Branch");
      return false;
    } else { $('#empbankbrancherror').html(""); }

    var empbankaccno = $("#empbankaccno").val();
    if (empbankaccno == "") {
      $("#empbankaccno").focus();
      $('#bankinformation').trigger("click");
      $('#empbankaccnoerror').html("Please Enter Bank Account No");
      return false;
    } else { $('#empbankaccnoerror').html(""); }

    var empbankifsci = $("#empbankifsci").val();
    if (empbankifsci == "") {
      $("#empbankifsci").focus();
      $('#bankinformation').trigger("click");
      $('#empbankifscierror').html("Please Enter Bank IFSCI");
      return false;
    } else { $('#empbankifscierror').html(""); }

    // var emppanno = $("#emppanno").val();
    // if (emppanno == "") {
    //   $("#emppanno").focus();
    //   $('#bankinformation').trigger("click");
    //   $('#emppannoerror').html("Please Enter PanNo");
    //   return false;
    // } else { $('#emppannoerror').html(""); }

    // var empesino = $("#empesino").val();
    // if (empesino == "") {
    //   $("#empesino").focus();
    //   $('#bankinformation').trigger("click");
    //   $('#empesinoerror').html("Please Enter ESI NO");
    //   return false;
    // } else { $('#empesinoerror').html(""); }

    // var emppfno = $("#emppfno").val();
    // if (emppfno == "") {
    //   $("#emppfno").focus();
    //   $('#bankinformation').trigger("click");
    //   $('#emppfnoerror').html("Please Enter PF No");
    //   return false;
    // } else { $('#emppfnoerror').html(""); }

    // var empuanno = $("#empuanno").val();
    // if (empuanno == "") {
    //   $("#empuanno").focus();
    //   $('#bankinformation').trigger("click");
    //   $('#empuannoerror').html("Please Enter UAN No");
    //   return false;
    // } else { $('#empuannoerror').html(""); }


    var empaadharno = $("#empaadharno").val();
    if (empaadharno == "") {
      $("#empaadharno").focus();
      $('#bankinformation').trigger("click");
      $('#empaadharno').html("Please Enter Aadhar No");
      return false;
    } else { $('#empaadharno').html(""); }
    // Bank & Statutory

    // Family Information
    var empfmrelation = document.getElementsByName('empfmrelation[]');
    for (i = 0; i < empfmrelation.length; i++) {
      if (empfmrelation[i].value == "") {
        $('#familyinformation').trigger("click");
        alert('Please Select Family Relation');
        return false;
      }
    }

    var empfmname = document.getElementsByName('empfmname[]');
    for (i = 0; i < empfmname.length; i++) {
      if (empfmname[i].value == "") {
        $('#familyinformation').trigger("click");
        alert('Please Enter Family Relation Name');
        return false;
      }
    }

    var empfmage = document.getElementsByName('empfmage[]');
    for (i = 0; i < empfmage.length; i++) {
      if (empfmage[i].value == "") {
        $('#familyinformation').trigger("click");
        alert('Please Enter Family Relation Age');
        return false;
      }
    }

    var empfmoccupation = document.getElementsByName('empfmoccupation[]');
    for (i = 0; i < empfmoccupation.length; i++) {
      if (empfmoccupation[i].value == "") {
        $('#familyinformation').trigger("click");
        alert('Please Enter Family Relation Occupation');
        return false;
      }
    }
    // Family Information
    // Address
    var emppreaddress1 = $("#emppreaddress1").val();
    if (emppreaddress1 == "") {
      $("#emppreaddress1").focus();
      $('#addressinformation').trigger("click");
      $('#emppreaddress1error').html("Please Enter Present Address1");
      return false;
    } else { $('#emppreaddress1error').html(""); }

    var empprecity = $("#empprecity").val();
    if (empprecity == "") {
      $("#empprecity").focus();
      $('#addressinformation').trigger("click");
      $('#empprecityerror').html("Please Enter Present City");
      return false;
    } else { $('#empprecityerror').html(""); }

    var empprestate = $("#empprestate").val();
    if (empprestate == "") {
      $("#empprestate").focus();
      $('#addressinformation').trigger("click");
      $('#empprestateerror').html("Please Enter Present State");
      return false;
    } else { $('#empprestateerror').html(""); }

    var empprecountry = $("#empprecountry").val();
    if (empprecountry == "") {
      $("#empprecountry").focus();
      $('#addressinformation').trigger("click");
      $('#empprecountryerror').html("Please Enter Present Country");
      return false;
    } else { $('#empprecountryerror').html(""); }

    var empprepostalcode = $("#empprepostalcode").val();
    if (empprepostalcode == "") {
      $("#empprepostalcode").focus();
      $('#addressinformation').trigger("click");
      $('#empprepostalcodeerror').html("Please Enter Present POSTAl CODE");
      return false;
    } else { $('#empprepostalcodeerror').html(""); }

    var emppresince = $("#emppresince").val();
    if (emppresince == "") {
      $("#emppresince").focus();
      $('#addressinformation').trigger("click");
      $('#emppresinceerror').html("Please Enter Present Address Since");
      return false;
    } else { $('#emppresinceerror').html(""); }

    var empfixedaddress1 = $("#empfixedaddress1").val();
    if (empfixedaddress1 == "") {
      $("#empfixedaddress1").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedaddress1error').html("Please Enter Premanent Address1");
      return false;
    } else { $('#empfixedaddress1error').html(""); }

    var empfixedcity = $("#empfixedcity").val();
    if (empfixedcity == "") {
      $("#empfixedcity").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedcityerror').html("Please Enter Premanent City");
      return false;
    } else { $('#empfixedcityerror').html(""); }

    var empfixedstate = $("#empfixedstate").val();
    if (empfixedstate == "") {
      $("#empfixedstate").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedstateerror').html("Please Enter Premanent State");
      return false;
    } else { $('#empfixedstateerror').html(""); }

    var empfixedcountry = $("#empfixedcountry").val();
    if (empfixedcountry == "") {
      $("#empfixedcountry").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedcountryerror').html("Please Enter Premanent Country");
      return false;
    } else { $('#empfixedcountryerror').html(""); }

    var empfixedpostalcode = $("#empfixedpostalcode").val();
    if (empfixedpostalcode == "") {
      $("#empfixedpostalcode").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedpostalcodeerror').html("Please Enter Premanent POSTAl CODE");
      return false;
    } else { $('#empfixedpostalcodeerror').html(""); }

    var empfixedpresince = $("#empfixedpresince").val();
    if (empfixedpresince == "") {
      $("#empfixedpresince").focus();
      $('#addressinformation').trigger("click");
      $('#empfixedpresinceerror').html("Please Enter Premanent Residencey Date");
      return false;
    } else { $('#empfixedpresinceerror').html(""); }
    // Address
    
    // Previous Employment
    // var emppreviousprediofromto = document.getElementsByName('emppreviousprediofromto[]');
    // for (i = 0; i < emppreviousprediofromto.length; i++) {
    //   if (emppreviousprediofromto[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Period From To');
    //     return false;
    //   }
    // }

    // var emppreviousorgnation = document.getElementsByName('emppreviousorgnation[]');
    // for (i = 0; i < emppreviousorgnation.length; i++) {
    //   if (emppreviousorgnation[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Name & Orgnation');
    //     return false;
    //   }
    // }

    // var emppreviousdesgjointime = document.getElementsByName('emppreviousdesgjointime[]');
    // for (i = 0; i < emppreviousdesgjointime.length; i++) {
    //   if (emppreviousdesgjointime[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Desg.. Jointime');
    //     return false;
    //   }
    // }

    // var emppreviousleavingtime = document.getElementsByName('emppreviousleavingtime[]');
    // for (i = 0; i < emppreviousleavingtime.length; i++) {
    //   if (emppreviousleavingtime[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Desg.. Leavingtime');
    //     return false;
    //   }
    // }

    // var emppreviousreportedto = document.getElementsByName('emppreviousreportedto[]');
    // for (i = 0; i < emppreviousreportedto.length; i++) {
    //   if (emppreviousreportedto[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Reportedto');
    //     return false;
    //   }
    // }

    // var empprevioussalarypermonth = document.getElementsByName('empprevioussalarypermonth[]');
    // for (i = 0; i < empprevioussalarypermonth.length; i++) {
    //   if (empprevioussalarypermonth[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Salarypermonth');
    //     return false;
    //   }
    // }

    // var emppreviousotherbenfits = document.getElementsByName('emppreviousotherbenfits[]');
    // for (i = 0; i < emppreviousotherbenfits.length; i++) {
    //   if (emppreviousotherbenfits[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous OtherBenfits');
    //     return false;
    //   }
    // }

    // var emppreviousreasonchange = document.getElementsByName('emppreviousreasonchange[]');
    // for (i = 0; i < emppreviousreasonchange.length; i++) {
    //   if (emppreviousreasonchange[i].value == "") {
    //     $('#previousempinformation').trigger("click");
    //     alert('Please Enter Previous Reasonchange');
    //     return false;
    //   }
    // }
    // Previous Employment
    
    // AUTHORISATIONS
    // let is_director = $("#departmentname").find(":selected").data('is_director');
    // let is_hr = $("#departmentname").find(":selected").data('is_hr');
    // // alert("is_director= "+ is_director + ", is_hr= " + is_hr);
    // if(is_director != 1 && is_hr != 1){
    //     var is_flag = 0;
    //     var authorizationtype = document.getElementsByName('authorizationtype[]');
    //     for (i = 0; i < authorizationtype.length; i++) {
    //       if (authorizationtype[i].value == 3) {
    //         is_flag = 1;
    //       }
    //     }
    //     if(is_flag == 0){
    //         $('#authorizationinformation').trigger("click");
    //         alert('Hr Authorization Type is mandatory Except directors and HR');
    //         return false;
    //     }
    // }
    
    // END AUTHORISATIONS

    // Nominee Details
    var esinomineerelationtype = document.getElementsByName('esinomineerelationtype[]');
    for (i = 0; i < esinomineerelationtype.length; i++) {
      if (esinomineerelationtype[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Select Nominee Types');
        return false;
      }
    }

    var esinomineerelation = document.getElementsByName('esinomineerelation[]');
    for (i = 0; i < esinomineerelation.length; i++) {
      if (esinomineerelation[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Select Nominee Relation');
        return false;
      }
    }

    var esinomineename = document.getElementsByName('esinomineename[]');
    for (i = 0; i < esinomineename.length; i++) {
      if (esinomineename[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Enter Nominee Name');
        return false;
      }
    }

    var esinomineeage = document.getElementsByName('esinomineeage[]');
    for (i = 0; i < esinomineeage.length; i++) {
      if (esinomineeage[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Enter Nominee Age');
        return false;
      }
    }

    var esinomineemobile = document.getElementsByName('esinomineemobile[]');
    for (i = 0; i < esinomineemobile.length; i++) {
      if (esinomineemobile[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Enter Nominee Mobile');
        return false;
      }
    }

    var esinomineeaddress = document.getElementsByName('esinomineeaddress[]');
    for (i = 0; i < esinomineeaddress.length; i++) {
      if (esinomineeaddress[i].value == "") {
        $('#nomineeinformation').trigger("click");
        alert('Please Enter Nominee Address');
        return false;
      }
    }
    // Nominee Details

    // validations


    if (emp == 1) {
      mainurl = baseurl + 'admin/saveemployeedetails';
    } else if (emp == 2) {
      mainurl = baseurl + 'admin/saveeditemployeedetailsdetails';
    }

    var formData = new FormData(this);
    formData.append("company_name",company_name);
    formData.append("division_name",division_name);
    formData.append("branch_name",branch_name);
    formData.append("state_name",state_name);
    $.ajax({
      url: mainurl,
      type: 'POST',
      data: formData,
      success: function (data) {
        if (data == 200) {
          alert('Successfully Created Employee You will be Redirecting to Review Page');
        //   setTimeout(function () {
        //     window.location.reload();
        //   }, 1000);
          window.location.href = baseurl + 'Developertools/employeedetailinfo';
        } else if(data == 132){
            alert("Create Employees Attendance Table First......");
            return false;
        }else if(data == 133){
            alert("Employee id already exist..");
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
  //---------------------------NEW BY SHABABU(25-01-2021)
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
  //---------------------------END NEW BY SHABABU(25-01-2021)
  


  
});





