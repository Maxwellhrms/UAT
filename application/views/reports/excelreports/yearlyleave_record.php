<?php echo $controller1->mastersfilter1($ym='Year',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='N',$day='N',$from='N',$to='N'); ?>
<!--  7 variables -->

<div id="excellist"> </div>

<script>

    
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        var attndyear = $("#attndyear").val();
        if (attndyear == 0 || attndyear == "") {
            $("#attndyear").focus();
            $('#attndyearerror').html("Please Select Month and Year");
            return false;
        } else {
            $('#attndyearerror').html("");
        }

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
        var empid = $("#attndempid").val();
        var mainurl = baseurl+'export/yearlyleave_list';
        
        var emp = $("#attndempid").val();
        var esi_company_id = $("#esi_company_id").val();
        if (esi_company_id == 0 || esi_company_id == "") {
            $("#esi_company_id").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }

        var esi_div_id = $("#esi_div_id").val();
	    var esi_state_id = $("#esi_state_id").val();
	    var esi_branch_id = $("#esi_branch_id").val();

        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'monthyear':attndyear,'filter':'1' },
            success: function (data) {
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
                        title:'<?php echo $titlehead  ?>',
                        messageTop: '<?php echo $excelheading; ?>'
                    },
                    { 
                        extend: 'excelHtml5',
                        title:'<?php echo $titlehead; ?>',
                        messageTop: '<?php echo $excelheading; ?>',
                        footer: true 
                    }
                ],
            });
            }
        });
    });

</script>