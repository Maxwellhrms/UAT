<?php echo $controller1->mastersfilter1($ym='N',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='Y',$day='N',$from='Y',$to='Y'); ?>
<!--  7 variables -->
<div id="excellist"> </div>
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
        var categeory = $(".attendance_regulation").val();
        var from = $("#fromdate").val();
        var to = $("#todate").val();
        var mainurl = baseurl+'export/attendance_regulation_report_list';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','attnd_category':categeory,'from':from,'to':to },
            success: function (data) {
            //   console.log(data);
               $("#excellist").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title:'<?php echo $titlehead ?>',
                        messageTop: '<?php echo $excelheading; ?>'
                    },
                    { 
                        extend: 'excelHtml5',
                        title:'<?php echo $titlehead ?>',
                        messageTop: '<?php echo $excelheading; ?>',
                        footer: true 
                    }
                    // { extend: 'excelHtml5',title:'<?php echo $titlehead ?>', messageTop: '<?php echo $excelheading; ?>',footer: true }
                    ],
            });
            }
        });
    });

</script>

                    