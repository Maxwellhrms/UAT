<?php echo $controller1->mastersfilters_paystructure($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='N',$grade='N',$empjoin='N',$categ='N',$day='N',$from ='N',$to ='N',$emp_type='N'); ?>
<!--  7 variables -->

<div id="excellist"> </div>
<!-- /Page Content -->
</div>
<script>
// alert('<?php //echo $excelheading; ?>');
     $(".hidingthecol").css("display", "none");
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        try{
            var is_finanical = ($("#is_finanical").is(":checked")) ? 1 : 0;
            
            if(is_finanical){
                var mnth = $("#finacial_month_year").val();
                if (mnth == 0 || mnth == "") {
                    $("#finacial_month_year").focus();
                    $('#attndmontherror').html("Please Select FinancialYear");
                    return false;
                } else {
                    $('#attndmontherror').html("");
                }
            }else{
                var mnth = $("#attndyear").val();
                if (mnth == 0 || mnth == "") {
                    $("#attndyear").focus();
                    $('#attndmontherror').html("Please Select Month");
                    return false;
                } else {
                    $('#attndmontherror').html("");
                }
                
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
            
            // alert(is_finanical);
            
            
            // var emp_type = $('#emptype').val().trim();
            // if (emp_type == 0 || emp_type == "") {
            //     $("#emptype").focus();
            //     $('#emptype_error').html("Please Select Employee Type");
            //     return false;
            // } else {
            //     $('#emptype_error').html("");
            // }
            
            
            var div_id = $("#esi_div_id").val();    
    	    var state_id = $("#esi_state_id").val();
    	    var branch_id = $("#esi_branch_id").val();
            var grade = $("#grade").val();
            var day = $("#day").val();
            var radiotype = $('input[name=radiotype]:checked').val();
            var empid = $("#attndempid").val();
            var mainurl = baseurl+'export/pf_report_list';
            show_loader()
            
            $.ajax({
                url: mainurl,
                type: "post",
                async: false,
                data: {'month_year': month_year,'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','day':day,'is_finanical':is_finanical},
                success: function (data) {
                    var isValidJSON = isValidJSONString(data);
                    // alert(isValidJSON);
                    if(!isValidJSON){
                        $("#excellist").html(data);
var table = $('#dataTables-example2').DataTable({
    dom: 'Bfrtip',
    destroy: true, // reinitialize datatable
    lengthChange: false,
    buttons: [
        {
            extend: 'excelHtml5',
            title: '<?php echo $titlehead ?>',
            messageTop: '<?php echo $excelheading; ?>',
            footer: true
        },
        {
            extend: 'csvHtml5',
            title: '<?php echo $titlehead ?>',
            messageTop: '<?php echo $excelheading; ?>',
            footer: true
        },
        {
    text: 'Download TXT',
    action: function (e, dt, node, config) {
        var data = dt.rows({ search: 'applied' }).data().toArray();
        var headers = dt.columns().header().to$().map(function () {
            return $(this).text().trim();
        }).get();

        // Calculate column widths
        var colWidths = headers.map((header, i) => {
            let maxDataLength = Math.max(...data.map(row => (row[i] || '').toString().length), header.length);
            return maxDataLength + 2; // padding
        });

        // Helper to create a row with borders
        function createRow(rowArray) {
            return '| ' + rowArray.map((cell, i) => {
                let cellStr = (cell || '').toString();
                return cellStr.padEnd(colWidths[i] - 1);
            }).join('| ') + '|';
        }

        // Helper to create separator line
        function createSeparator() {
            return '+' + colWidths.map(w => '-'.repeat(w)).join('+') + '+';
        }

        var txtContent = '';
        txtContent += createSeparator() + '\n';
        txtContent += createRow(headers) + '\n';
        txtContent += createSeparator() + '\n';
        data.forEach(function (row) {
            txtContent += createRow(row) + '\n';
        });
        txtContent += createSeparator();

        var blob = new Blob([txtContent], { type: 'text/plain;charset=utf-8;' });
        var link = document.createElement("a");
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "<?php echo $titlehead ?>.txt");
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

    ]
});
   
                    }else{
                        $("#excellist").html('');
                    }
                    hide_loader()
                }
            });
        }catch(err){
            alert("something went wrong catch");
            hide_loader();
        }
    });

</script>
<style>
    .dt-buttons .dt-button {
        margin-right: 10px;
    }
</style>
                    