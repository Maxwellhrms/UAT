$(document).ready(function () {    
    $(document).on('click','.basic_limit_check',function(){    
        var pf_check = 0;
        $(".basic_limit_check").each(function(){
            if($(this).prop("checked")== true){
                pf_check++;
            }
            if(pf_check > 1){
                 $(this).prop("checked",false);
                 $('#pfcheck_error').html("Please Select Only one...");
                 return false;    
            }else{
                $('#pfcheck_error').html("");
            }
        });
    });




    $("form#pfstatutory").submit(function (e) {
        e.preventDefault();
        var affect_date = $("#pf_affectdate").val();
        if (affect_date == "") {
            $('#pf_affectdate_error').html("Please Select Affect Date");
            $("#pf_affectdate").focus();
            return false;
        } else {
            $('#pf_affectdate_error').html("");
        }
//alert(affect_date);
//return false;
        var pf_company_id = $("#pf_company_id").val();
        if (pf_company_id == 0 || pf_company_id == "") {
            $("#pf_company_id").focus();
            $('#pf_cmpid_error').html("Please Select Company Name");
            return false;
        } else {
            $('#pf_cmpid_error').html("");
        }

        var pf_bssalary_limit = $("#pf_bssalary_limit").val();
        if (pf_bssalary_limit == "") {
            $("#pf_bssalary_limit").focus();
            $('#pf_bssalary_limit_error').html("Please Enter Basic Salry Limit");
            return false;
        } else {
            $('#pf_bssalary_limit_error').html("");
        }

        var pfempcnt = $("#pfempcnt").val();
        if (pfempcnt == "") {
            $("#pfempcnt").focus();
            $('#pfempcnt_error').html("Please Enter PF Emp Cont");
            return false;
        } else {
            $('#pfempcnt_error').html("");
        }

        var pfcompcnt = $("#pfcompcnt").val();
        if (pfcompcnt == "") {
            $("#pfcompcnt").focus();
            $('#pfcompcnt_error').html("Please Enter PF Comp Cont");
            return false;
        } else {
            $('#pfcompcnt_error').html("");
        }

        var pfpens_cont = $("#pfpens_cont").val();
        if (pfpens_cont == "") {
            $("#pfpens_cont").focus();
            $('#pfpens_cont_error').html("Please Enter PF Pension Cont");
            return false;
        } else {
            $('#pfpens_cont_error').html("");
        }

        var pf_epswageslimit = $("#pf_epswageslimit").val();
        if (pf_epswageslimit == "") {
            $("#pf_epswageslimit").focus();
            $('#pf_epswageslimit_error').html("Please Enter EPS Wages Limit");
            return false;
        } else {
            $('#pf_epswageslimit_error').html("");
        }

        var pf_edlisalarylimit = $("#pf_edlisalarylimit").val();
        if (pf_edlisalarylimit == "") {
            $("#pf_edlisalarylimit").focus();
            $('#pf_edlisalarylimit_error').html("Please Enter EDLI Salary Limit");
            return false;
        } else {
            $('#pf_edlisalarylimit_error').html("");
        }

        var pf_edli = $("#pf_edli").val();
        if (pf_edli == "") {
            $("#pf_edli").focus();
            $('#pf_edli_error').html("Please Enter EDLI %");
            return false;
        } else {
            $('#pf_edli_error').html("");
        }

        var pfadmin = $("#pfadmin").val();
        if (pfadmin == "") {
            $("#pfadmin").focus();
            $('#pfadmin_error').html("Please Enter Admin %");
            return false;
        } else {
            $('#pfadmin_error').html("");
        }

        var pf_agelimit = $("#pf_agelimit").val();
        if (pf_agelimit == "") {
            $("#pf_agelimit").focus();
            $('#pf_agelimit_error').html("Please Enter Age Limit");
            return false;
        } else {
            $('#pf_agelimit_error').html("");
        }

        var pf_emp_type = $("#pf_emp_type").val();
        if (pf_emp_type == "" || pf_emp_type == 0) {
            $("#pf_emp_type").focus();
            $('#pf_emp_type_error').html("Please Select PF Emp Type");
            return false;
        }





//-----pf eligibility
        if ($("#pf_eligibility_on_above_pf_limit").prop('checked') == true) {
            var msg = "You Have Selected the PF Eligibility On Above PF Limit";
        } else {
            var msg = "You Have Not Selected the PF Eligibility On Above PF Limit";
        }
        var pf_eligibility_on_above = confirm(msg);
        if (pf_eligibility_on_above == false) {
            return false;
        }
//-----End pf eligibility  


//if(page_type == 1){
        var mainurl = baseurl + 'admin/save_pf_statutory';
//}else if(page_type == 2){
//  var mainurl = baseurl+'admin/save_edit_pf_statutory';
//}

        var formData = new FormData(this);
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);
//      return false;
                if (data == 200) {
                    alert('Successfully Saved The PF Statutory.....');
                    setTimeout(function () {
//                        window.location.reload();
                        window.location.href = baseurl + "admin/statutorymaster/pf_master_li";

                    }, 1000);
                } else if (data == 420) {
                    alert('Failed To Save Please TryAgain later');
                    return false;
                } else if (data == 240) {
                    alert('Affect Date Already Exist For these Company....');
                    return false;
                }else if(data == "LESS"){
                    alert("You Cant Save Affect Date Less Than The Previous Existing Records");
                    return false;
                }else if(data == "same"){
                    alert("You Cant Feed The Affect Date As the Same Month And Year Of Previous Record");
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });

    $("#processdeletedata_pf").click(function () {
        event.preventDefault();
        var del_pf_id = $('#del_pf_id').val();

        $.ajax({
            async: false,
            type: "POST",
            data: {pf_id: del_pf_id},
            url: baseurl + 'admin/delete_pf_statutory',
            datatype: "html",
            success: function (data) {
                if (data == 200) {
                    alert('Success');
//                    window.location.reload();
                    window.location.href = baseurl + "admin/statutorymaster/pf_master_li";
                } else {
                    alert('Try Again Later');
                }
            }
        });

    });



    $(document).on("click", ".pf_delete", function () {
        var deletedetails = $(this).data('id');
        var x = deletedetails.split("~");
//alert(x)
        var id = x[0];
        var companyname = x[1];
        var affect_date = x[2];
        $(".modal-body #pf_del_comp").html(companyname + '(' + affect_date + ')');
        $(".modal-body #del_pf_id").val(id);
    });
    ;

});
