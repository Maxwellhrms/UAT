<?php echo $controller1->mastersfilters_paystructure($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='N',$grade='N',$empjoin='N',$categ='N',$day='N',$from ='N',$to ='N',$emp_type='N'); ?>
<!--  7 variables -->

<div id="excellist"> </div>
<!-- /Page Content -->
</div>
<script>
    
$("form#commonform").submit(function(e) {
        e.preventDefault();  
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
            
            
            var div_id = $("#esi_div_id").val();    
    	    var state_id = $("#esi_state_id").val();
    	    var branch_id = $("#esi_branch_id").val();
            var grade = $("#grade").val();
            var day = $("#day").val();
            var radiotype = $('input[name=radiotype]:checked').val();
            var empid = $("#attndempid").val();

            var mainurl = baseurl+'export/staff_record_list';

            var formData = $( "#commonform" ).serialize();
            window.location.href = mainurl +'?'+ formData

    });

</script>

                    