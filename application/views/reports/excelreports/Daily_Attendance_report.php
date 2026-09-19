<?php echo $controller1->mastersfilter1($ym='N',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='N',$day='N',$from='Y',$to='N'); ?>
<!--  7 variables -->
<div id="daily_attend_list"> </div>
<!-- /Page Content -->
</div>
<script>

    
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        var company_id = $("#esi_company_id").val();
        if (company_id == 0 || company_id == "") {
            $("#esi_company_id").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }
        var div_id = $("#esi_div_id").val();    
	    var state_id = $("#esi_state_id").val();
	    var branch_id = $("#esi_branch_id").val();
        var grade = $("#grade").val();
        var radiotype = $('input[name=radiotype]:checked').val();
        var empid = $("#attndempid").val();
        // var categeory = $(".attendance_regulation").val();
        var from = $("#fromdate").val();
        // var to = $("#todate").val();
        var mainurl = baseurl+'export/daily_attendance_report_list';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','from':from },
            success: function (data) {
                $("#daily_attend_list").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    ordering: false,
                    buttons: [
                        { 
                            extend: 'excelHtml5',
                            // footer: true, 
                            title:'Maxwell Logistics Private Limited',
                            messageTop: 'Daily Attendance Report Of All States & Branch Names dropdown'
                            }
                    ],
                });
        
            }
        });
    });
    
</script>

                    