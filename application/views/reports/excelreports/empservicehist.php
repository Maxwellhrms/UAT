<?php echo $controller1->mastersfilter1($ym='',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='',$empjoin='',$categ='Y',$day=''); ?>
<!--  7 variables -->

<div id="excellist1"> </div>
<!-- /Page Content -->
</div>
<script>

    
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        // var mnth = $("#attndyear").val();
        // if (mnth == 0 || mnth == "") {
        //     $("#attndyear").focus();
        //     $('#attndmontherror').html("Please Select Month");
        //     return false;
        // } else {
        //     $('#attndmontherror').html("");
        // }
        var month_year = '';
        
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
        var day = $("#day").val();
        var radiotype = $("#radiotype").val();
        var categeory = $(".attendance_type").val();
        var empid = $("#attndempid").val();
        var mainurl = baseurl+'export/employeeservicehistory_list';

        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'companyid': company_id, 'divisionid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1'},
            success: function (data) {
                // console.log(data);
               $("#excellist1").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    // buttons: [
                    //     { extend: 'excelHtml5',title:'<?php echo $titlehead ?>', messageTop: '<?php echo $excelheading; ?>',footer: true }
                    // ],
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
                ],
            });
            }
        });
    });

</script>

                    