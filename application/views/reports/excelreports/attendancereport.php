<?php echo $controller1->mastersfilter1($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='N',$day='Y'); ?>
<!--  7 variables -->
<div id="excellist"> </div>
<!-- /Page Content -->
<!-- </div> -->
<script>
   
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        var mnth = $("#attndyear").val();
        if (mnth == 0 || mnth == "") {
            $("#attndyear").focus();
            $('#attndmontherror').html("Please Select Month");
            return false;
        } else {
            $('#attndmontherror').html("");
        }
        var month_year = mnth;
        
        var company_id = $("#esi_company_id").val();
        if (company_id == 0 || company_id == "") {
            $("#esi_company_id").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }
        
        var div_id = $("#esi_div_id").val();
        if (div_id == 0 || div_id == "") {
            $("#esi_div_id").focus();
            // $('#esi_div_id_error').html("Please Select Division Name");
            // return false;
        } else {
            $('#esi_div_id_error').html("");
        }
        
	    var state_id = $("#esi_state_id").val();
	    if (state_id == 0 || state_id == "") {
            $("#esi_state_id").focus();
            // $('#esi_state_id_error').html("Please Select State Name");
            // return false;
        } else {
            $('#esi_state_id_error').html("");
        }
        
	    var branch_id = $("#esi_branch_id").val();
	    if (branch_id == 0 || branch_id == "") {
            $("#esi_branch_id").focus();
            // $('#esi_branch_id_error').html("Please Select Branch Name");
            // return false;
        } else {
            $('#esi_branch_id_error').html("");
        }
        
        var grade = $("#grade").val();
        var day = $("#day").val();
        var radiotype = $("#radiotype").val();
        var categeory = $("#categeory").val();
        var empid = $("#attndempid").val();
        var mainurl = baseurl+'export/attendancereportlist';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'month_year': month_year,'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','attnd_category':categeory,'day':day},
            success: function (data) {
            //    console.log(data);
               $("#excellist").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5',title:'<?php echo $titlehead ?>', messageTop: '<?php echo $excelheading; ?>',footer: true }
                    ],
            });
            }
        });
    });

</script>

                    