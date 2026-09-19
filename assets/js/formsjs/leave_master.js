var normal_sno = 2;
var shrt_sno = 2;
var normal_leave_type_array = [];
var shrt_leave_type_array = [];

$(document).ready(function () {
    /*
        Cmp Name Change And Get Emp Type
    */
    $("#cmpname").change(function () {
        var cmp_id = $(this).val();
        var option_emptype = "<option value=\"\">Select Employee Type</option>";
        var option_leavetype = "<option value=\"\">Select Leave Type</option>";
        var short_leave_option = "<option value=\"\">Select Leave Type</option>";
        if (cmp_id != "") {
            //------------EMP TYPE
            $.ajax({
                url: "getemployementtype",
                type: "POST",
                data: { "cmp_id": cmp_id },
                async: false,
                success: function (emp_type) {
                    var parsed_data = JSON.parse(emp_type);
                    // console.log(parsed_data);
                    if (parsed_data.length > 0) {
                        for (emp_type_index in parsed_data) {
                            var emp_type_index_data = parsed_data[emp_type_index];
                            option_emptype += "<option value='" + emp_type_index_data.mxemp_ty_id + "'>" + emp_type_index_data.mxemp_ty_name + "</option>"
                        }
                    }

                }
            });
            //--------------END Employement Type
            //--------------Leave Type
            $.ajax({
                url: "getleavetype",
                type: "POST",
                data: { "cmp_id": cmp_id },
                async: false,
                success: function (leave_type) {
                    var parsed_leave_type_data = JSON.parse(leave_type);
                    // console.log(parsed_data);
                    if (parsed_leave_type_data.length > 0) {
                        var shrt_data = {}
                        for (leave_type_index in parsed_leave_type_data) {
                            var leave_type_index_data = parsed_leave_type_data[leave_type_index];
                            if (leave_type_index_data.mxlt_is_short_leave == 0) {
                                option_leavetype += "<option value='" + leave_type_index_data.mxlt_id + "'>" + leave_type_index_data.mxlt_leave_short_name + "</option>";
                            } else {
                                short_leave_option += "<option value='" + leave_type_index_data.mxlt_id + "'>" + leave_type_index_data.mxlt_leave_short_name + "</option>";
                                shrt_data.mxlt_id = leave_type_index_data.mxlt_id;
                                shrt_data.mxlt_leave_short_name = leave_type_index_data.mxlt_leave_short_name;
                                shrt_leave_type_array.push(shrt_data);
                            }
                            normal_leave_type_array = parsed_leave_type_data;
                        }
                    } else {
                        normal_leave_type_array = [];
                        shrt_leave_type_array = [];
                    }

                }
            });
            //--------------END Leave Type
        } else {
            normal_leave_type_array = [];
            shrt_leave_type_array = [];
        }
        //----------REMOVE TRS
        $(".normal_tr").each(function () {
            $(this).remove();
        });
        $(".shrt_tr").each(function () {
            $(this).remove();
        });
        //----------END REMOVE TRS


        // console.log(shrt_leave_type_array);
        $("#emptype").html(option_emptype);
        $("#leave_type_1").html(option_leavetype);
        $("#shrt_leave_type_1").html(short_leave_option);
    });
    /*
        Add More For Normal
    */
    $("#normal_add_more").click(function () {
        var cmp_id = $("#cmpname").val();
        if (cmp_id != "") {
            var normal_row_html = '<tr id="normal_tr_' + normal_sno + '" class="normal_tr">';
            normal_row_html += '<td>';
            normal_row_html += '<input type="hidden" name="normal_hidddn[]" value="' + normal_sno + '">';
            normal_row_html += '<select name="leave_type_' + normal_sno + '" id="leave_type_' + normal_sno + '" class="form-control select2" style="width: 100%">';
            normal_row_html += '<option value="">Select Leave Type</option>';
            for (normal_index in normal_leave_type_array) {
                if (normal_leave_type_array[normal_index].mxlt_is_short_leave == 0) {
                    normal_row_html += '<option value="' + normal_leave_type_array[normal_index].mxlt_id + '">' + normal_leave_type_array[normal_index].mxlt_leave_short_name + '</option>';
                }

            }
            normal_row_html += '</select>';
            normal_row_html += '<span class="formerror" id="leave_type_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td width="120">';
            normal_row_html += '<div class="row">';
            normal_row_html += '<div class="col-md-12 col-12">';
            normal_row_html += '<div class="stats-box">';
            normal_row_html += '<label>Fixed</label>';
            normal_row_html += '<input type="radio" name="radio_type_' + normal_sno + '" id="is_fixed_' + normal_sno + '" value="1">';
            normal_row_html += '<label>Calculate</label>';
            normal_row_html += '<input type="radio" name="radio_type_' + normal_sno + '" id="is_calculate_' + normal_sno + '" value="2">';
            normal_row_html += '<span class="formerror" id="type_of_leave_error_' + normal_sno + '"></span>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<input type="text" name="min_leaves_' + normal_sno + '" id="min_leaves_' + normal_sno + '" class="form-control" style="float: left">';
            normal_row_html += '<span class="formerror" id="min_leaves_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<input type="text" name="min_leaves_days_' + normal_sno + '" id="min_leaves_days_' + normal_sno + '" class="form-control" style="float: left">';
            normal_row_html += '<span class="formerror" id="min_leaves_days_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<div class="row">';
            normal_row_html += '<div class="col-md-6 col-6">';
            normal_row_html += '<input type="checkbox" name="is_max_days_' + normal_sno + '" class="form-control" style="float: left">';
            normal_row_html += '<span class="formerror" id="is_max_days_error_' + normal_sno + '"></span>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<input type="text" name="max_leaves_' + normal_sno + '" id="max_leaves_' + normal_sno + '" class="form-control" style="float: left">';
            normal_row_html += '<span class="formerror" id="max_leaves_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<select name="select_type_' + normal_sno + '" id="select_type_' + normal_sno + '" class="form-control" style="width: 100%">';
            normal_row_html += '<option value="">Type</option>';
            normal_row_html += '<option value="1">Monthly</option>';
            normal_row_html += '<option value="2">Yearly</option>';
            normal_row_html += '</select>';
            normal_row_html += '<span class="formerror" id="select_type_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<div class="row">';
            normal_row_html += '<div class="col-md-3 col-3" style="margin-top: 15px;">';
            normal_row_html += '<input type="checkbox" name="cf_next_month_' + normal_sno + '" id="cf_next_month_' + normal_sno + '" value="1">';
            normal_row_html += '<span class="formerror" id="cf_next_month_error_' + normal_sno + '"></span>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<div class="row">';
            normal_row_html += '<div class="col-md-3 col-3" style="margin-top: 15px;">';
            normal_row_html += '<input type="checkbox" name="cf_next_year_' + normal_sno + '" id="cf_next_year_' + normal_sno + '" value="1">';
            normal_row_html += '<span class="formerror" id="cf_next_year_error_' + normal_sno + '"></span>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<input type="text" name="max_leaves_cf_' + normal_sno + '" id="max_leaves_cf_' + normal_sno + '" class="form-control">';
            normal_row_html += '<span class="formerror" id="max_leaves_cf_error_' + normal_sno + '"></span>';
            normal_row_html += '</td>';
            normal_row_html += '<td>';
            normal_row_html += '<div class="row">';
            normal_row_html += '<div class="col-md-12 col-12">';
            normal_row_html += '<div class="stats-box">';
            normal_row_html += '<label>PH</label>';
            normal_row_html += '<input type="checkbox" name="applicable_on_ph_' + normal_sno + '" id="applicable_on_ph_' + normal_sno + '" value=""><br>';
            normal_row_html += '<label>WO</label>';
            normal_row_html += '<input type="checkbox" name="applicable_on_wo_' + normal_sno + '" id="applicable_on_wo_' + normal_sno + '" value=""><br>';
            normal_row_html += '<label>PR</label>';
            normal_row_html += '<input type="checkbox" name="applicable_on_pr_' + normal_sno + '" id="applicable_on_pr_' + normal_sno + '" value="">';
            normal_row_html += '<span class="formerror" id="applicable_error_' + normal_sno + '"></span>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</div>';
            normal_row_html += '</td>';
            normal_row_html += '<td class="text-right">';
            normal_row_html += '<button type="button" name="" class="btn btn-info normal_btn_rmv" id="btn_rmv_' + normal_sno + '">Remove</button>';
            normal_row_html += '</td>';
            normal_row_html += '</tr>';
            normal_sno++
            $("#normal_tbody").append(normal_row_html);
        } else {
            alert("PLEASE SELECT THE COMPANY NAME");
            return false;
        }
    });
    //-------------------SHORT LEAVE
    $("#shrt_add_more").click(function () {
        console.log(shrt_leave_type_array);
        var cmp_id = $("#cmpname").val();
        if (cmp_id != "") {
            var shrt_row_html = '<tr id="shrt_tr_' + shrt_sno + '" class="shrt_tr">';
            shrt_row_html += '<td>';
            shrt_row_html += '<input type="hidden" name="shrt_hidden_array[]" value="' + shrt_sno + '">';
            shrt_row_html += '<select name="shrt_leave_type_' + shrt_sno + '" id="shrt_leave_type_' + shrt_sno + '" class="form-control select2" style="width: 100%">';
            shrt_row_html += '<option value="">Select Leave Type</option>';
            for (shrt_leave_index in shrt_leave_type_array) {
                shrt_row_html += '<option value="' + shrt_leave_type_array[shrt_leave_index].mxlt_id + '">' + shrt_leave_type_array[shrt_leave_index].mxlt_leave_short_name + '</option>';

            }
            shrt_row_html += '</select>';
            shrt_row_html += '<span class="formerror" id="shrt_leave_type_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</td>';

            shrt_row_html += '<td>';
            shrt_row_html += '<div class="row">';
            shrt_row_html += '<div class="col-md-6 col-6">';
            shrt_row_html += '<input type="text" name="shrt_max_leaves_' + shrt_sno + '" id="shrt_max_leaves_' + shrt_sno + '" class="form-control" style="float: left">';
            shrt_row_html += '<span class="formerror" id="shrt_max_leaves_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</div>';
            shrt_row_html += '</div>';
            shrt_row_html += '</td>';
            shrt_row_html += '<td>';
            shrt_row_html += '<div class="row">';
            shrt_row_html += '<div class="col-md-8 col-8">';
            shrt_row_html += '<select name="shrt_max_type_leave_' + shrt_sno + '" id="shrt_max_type_leave_' + shrt_sno + '" class="form-control" style="width: 100%">';
            shrt_row_html += '<option value="">Type</option>';
            shrt_row_html += '<option value="1">Monthly</option>';
            shrt_row_html += '<option value="2">Yearly</option>';
            shrt_row_html += '</select>';
            shrt_row_html += '<span class="formerror" id="shrt_max_type_leave_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</div>';
            shrt_row_html += '</div>';
            shrt_row_html += '</td>';
            shrt_row_html += '<td>';
            shrt_row_html += '<input type="text" name="shrt_max_duration_' + shrt_sno + '" id="shrt_max_duration_' + shrt_sno + '" class="form-control datetimepicker2"><span>HH:MM</span>';
            shrt_row_html += '<span class="formerror" id="shrt_max_duration_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</td>';
            shrt_row_html += '<td>';
            shrt_row_html += '<input type="checkbox" name="shrt_cf_nxt_year_' + shrt_sno + '" id="shrt_cf_nxt_year_' + shrt_sno + '" class="form-control">';
            shrt_row_html += '<span class="formerror" id="shrt_cf_nxt_year_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</td>';
            shrt_row_html += '<td>';
            shrt_row_html += '<input type="text" name="shrt_deduct_leave_' + shrt_sno + '" id="shrt_deduct_leave_' + shrt_sno + '" class="form-control"><span>(no of days)</span>';
            shrt_row_html += '<span class="formerror" id="shrt_deduct_leave_error_' + shrt_sno + '"></span>';
            shrt_row_html += '</td>';
            shrt_row_html += '<td class="text-right">';
            shrt_row_html += '<button type="button" name="" class="btn btn-info shrt_btn_rmv" id="shrt_btn_rmv_' + shrt_sno + '">Remove</button>';
            shrt_row_html += '</td>';
            shrt_row_html += '</tr>';
            shrt_sno++;
            $("#shrt_tbody").append(shrt_row_html);
        } else {
            alert("PLEASE SELECT THE COMPANY NAME");
            return false;
        }
    });
    //-------------------SHORT LEAVE
    //-----------------------SAVE
    //--------FOR SUBMIT 
    $("form#leave_assigning_form").submit(function (e) {
        e.preventDefault();


        var cmpname = $("#cmpname").val();
        if (cmpname ==  "") {
            $("#cmpname").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }
        var cmpfnyyear = $("#cmpfnyyear").val();
        if (cmpfnyyear ==  "") {
            $("#cmpfnyyear").focus();
            $('#cmpfnyyearerror').html("Please Select Financial Year");
            return false;
        } else {
            $('#cmpfnyyearerror').html("");
        }
        var emptype = $("#emptype").val();
        if (emptype ==  "") {
            $("#emptype").focus();
            $('#emptypeerror').html("Please Select Employement Type");
            return false;
        } else {
            $('#emptypeerror').html("");
        }

        var pay_str_emp_type = $("#emp_type_name").val();
        if (pay_str_emp_type == 0 || pay_str_emp_type == "") {
            $("#emp_type_name").focus();
            $('#emp_type_name_error').html("Please Select Emp Type");
            return false;
        } else {
            $('#emp_type_name_error').html("");
        }




        // if (page_type == 1) {
        var mainurl = baseurl + 'admin/saveleaveassigning_master';
        // } else if (page_type == 2) {
        // var mainurl = baseurl + 'admin/update_deduction_type';
        // }

        var formData = new FormData(this);
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
                // return false;
                if (data == 200) {
                    alert('Successfully');
                    setTimeout(function () {
                        //                        window.location.reload();
                        window.location.href = baseurl + "admin/leavemaster";
                    }, 1000);
                } else if (data == 420) {
                    alert('Failed To Save Please TryAgain later');
                    return false;
                } 
                // else if (data == 240) {
                //     alert('Affect Date Already Exist For these Company AND EMPLOYEMENT TYPE....');
                //     return false;
                // }
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });
    //--------FOR SUBMIT 

    //-----------REMOVE BUTTON NORMAL
      $(document).on("click",".normal_btn_rmv",function(){
            alert("hi this is normal");
            var btn_id = $(this).attr("id");
            var sp = btn_id.split("_");
            var id = sp[2];
            var tr_id = "#normal_tr_"+id;            
            $(tr_id).remove();
        });
    //-----------END REMOVE BUTTON NORMAL




    //-----------REMOVE BUTTON SHORT
    //-----------END REMOVE BUTTON SHORT
    $(document).on("click",".shrt_btn_rmv",function(){
        alert("hi this is Short");
        var btn_id = $(this).attr("id");
        var sp = btn_id.split("_");
        var id = sp[3];
        var tr_id = "#shrt_tr_"+id;            
        $(tr_id).remove();
    });

    //-----------------------END SAVE 


// -------------------------added 06-04-2021----------------------


$(".dir_hr").click(function(){    
     multiple_check_box_check();    
});


function multiple_check_box_check(){
    var checked_data = 0;
    $(".dir_hr").each(function(){
        if($(this).prop("checked")){
            checked_data = checked_data + 1;            
            if(checked_data > 1){
                // alert("Please Choose Only One Checkbox...You cant Choose Multiple Checkbox...");
                $("#checkederror").html("Please Choose Only One Checkbox...You cant Choose Multiple Checkbox...");
                $(this).prop("checked",false);
                return false;
            }else{
                $("#checkederror").html(" ");
            }
        }else{
            $("#checkederror").html(" ");
        };        
    });
}

$(document).on("click",".addleavetype",function(){
    var cmpname = $("#compname").val();
    if(cmpname ==""){
        $("#compname").focus();
        $('#compnameerror').html("Please Select Company Name");
        return false;
    }else{ $('#compnameerror').html("");}

    var leavetyname = $("#leavetypename").val();
    if(leavetyname ==""){
        $("#leavetypename").focus();
        $('#leavetypenameerror').html("Please Enter Leave Type Name");
        return false;
    }else{$('#leavetypenameerror').html("");}

    var leaveshtname = $("#leavetypeshtname").val();
    if(leaveshtname ==""){
        $("#leavetypeshtname").focus();
        $('#leavetypeshtnameerror').html("Please Enter Leave Type Short Name");
        return false;
    }else{$('#leavetypeshtnameerror').html("");}      
   
    var earndle = $("#earnedleave").prop("checked");
    var shortle = $("#shortleave").prop("checked");
    var ophle = $("#optleave").prop("checked");
    
    multiple_check_box_check();

  
  var fdata={compname:cmpname,leavetypename:leavetyname,leavetypeshtname:leaveshtname,earnedleave:earndle,shortleave:shortle,optleave:ophle};
    var mainurl = baseurl + 'admin/saveleavetype_master';
    $.ajax({
        url: mainurl,
        type: "POST",
        data: fdata,
        success: function (data) {
         // console.log(data);
            if (data == 200) {
              alert('Successfully');
              setTimeout(function () {
                window.location.reload();
              }, 100);
            }else if(data == 600){
                alert('Already Leave Name Short Name exist ')
            } else {
              alert('Failed To Save Please TryAgain later');
            }
          },
          cache: false,
          //contentType: false,
         // processData: false
    });

});   

$("form#processeditleavedetls").submit(function(e) {
      e.preventDefault();  
        var cmpname = $("#compname").val();
        if(cmpname ==""){
            $("#compname").focus();
            $('#compnameerror').html("Please Select Company Name");
            return false;
        }else{ $('#compnameerror').html("");}
        //alert(cmpname);
        var leavetyname = $("#leavetypename").val();
        if(leavetyname ==""){
            $("#leavetypename").focus();
            $('#leavetypenameerror').html("Please Enter Leave Type Name");
            return false;
        }else{$('#leavetypenameerror').html("");}
        //alert(leavetyname);
        var leaveshtname = $("#leavetypeshtname").val();
        if(leaveshtname ==""){
            $("#leavetypeshtname").focus();
            $('#leavetypeshtnameerror').html("Please Enter Leave Type Short Name");
            return false;
        }else{$('#leavetypeshtnameerror').html("");}      
        // alert(leaveshtname);
        var earndle = $("#earnedleave").prop("checked");
        var shortle = $("#shortleave").prop("checked");
        var optle = $("#optleave").prop("checked");
        if (earndle == true && shortle == true && optle == true ) {
             $("#earnedleave").prop("checked", false);
             $("#shortleave").prop("checked", false);
             $("#optleave").prop("checked", false);
             $("#checkederror").html("You cant select Both Leave.. ");
             return false;
        } else if(earndle == true){
            earndle = 1;
            shortle = 0;
            optle = 0;
        }else if(shortle == true){
            earndle = 0;
            shortle = 1;
            optle = 0;
        }else if(optle == true){
            earndle = 0;
            shortle = 0;
            optle = 1;
        }else{
             $("#earnedleave").html(" ");
             $("#shortleave").html(" ");
             $("#optleave").html(" ");
        }
  var mainurl = baseurl + 'admin/saveeditleavetypedetails';
  var formData =  $('form#processeditleavedetls').serialize();
  //console.log(formData);return false;
    $.ajax({
        url: mainurl,
        type: 'post',
        data: formData,    
        success: function (data) {
          //console.log(data);
            if (data == 200) {
                alert('Successfully');
                setTimeout(function(){
                    window.location.href = baseurl + "admin/leavetype"; 
                }, 1000);
            } else {
                alert('Failed To Save Please TryAgain later');
            }
        },
        //cache: false,
        //contentType: false,
        //processData: false
         }); 
});

});











