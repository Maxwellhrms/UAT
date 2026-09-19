<?php echo $controller1->mastersfilters_paystructure($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='N',$grade='N',$empjoin='N',$categ='N',$day='N',$from ='N',$to ='N',$emp_type='N',$is_quaterly='N',$emp_status='Y'); ?>
<!--  7 variables -->
<div class="bonus-report-loader"></div>
<div id="excellist"> </div>
<!-- /Page Content -->
</div>
<script>
// alert('<?php //echo $excelheading; ?>');
    $(".hidingthecol").css("display", "none");
    $(".hidingthecol2").css("display", "none");
    $(".finacial_month_year_div").css("display", "block");
    $(".finacial_month_year_div_status").css("display", "none");
    $(".attndyear_div").css("display", "none");
    $(".bonus_status").css("display", "block");
    $(".bonus_sal").css("display", "block");
$("form#commonform").submit(function(e) {
        e.preventDefault();  
        try{
            var is_finanical = ($("#is_finanical").is(":checked")) ? 1 : 0;
            var is_finanical_all = ($("#is_finanical_all").is(":checked")) ? 1 : 0;
            
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
                var mnth = $("#finacial_month_year").val();
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
            
            
            show_loader1();
			//alert("called");
			setTimeout(function() {
  console.log("3 seconds have passed!");
}, 2000);
            
			setTimeout(function () {
				
            var div_id = $("#esi_div_id").val();    
    	    var state_id = $("#esi_state_id").val();
    	    var branch_id = $("#esi_branch_id").val();
            var grade = $("#grade").val();
            var day = $("#day").val();
            var bonus_status = $("#bonus_status").val();
            var bonus_sal = $("#bonus_sal").val();
            var empstatus = $("#empstatus").val();
            var radiotype = $('input[name=radiotype]:checked').val();
            var empid = $("#attndempid").val();
            var mainurl = baseurl+'export/bonus_report_list5';
            
            
            $.ajax({
                url: mainurl,
                type: "post",
                async: false,
                data: {'month_year': month_year,'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','day':day,'is_finanical':is_finanical,'is_finanical_all':is_finanical_all,'bonus_status':bonus_status,'bonus_sal':bonus_sal,'empstatus':empstatus},
                success: function (data) {
                    var isValidJSON = isValidJSONString(data);
                    // alert(isValidJSON);
                    if(!isValidJSON){
                        $("#excellist").html(data);
                          
                    }else{
                        $("#excellist").html('');
                    }
                    hide_loader1()
                }
            });
			
			 }, 3000);
			
        }catch(err){
            alert("something went wrong catch");
            hide_loader1();
        }
		
			
    });



function show_loader1(){
    $('.bonus-report-loader').show();
    //$('.bonus-report-loader').css("display","block");
}

function hide_loader1(){
    $('.bonus-report-loader').css("display","none");
}
$('.bonus-report-loader').css("display","none");
</script>
<style>
/* Scoped only for bonus report loader */
.bonus-report-loader {
    display: block;
    background: url('<?php echo base_url() ?>assets/img/loader.gif') no-repeat center center;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 9999999;
    background-color: rgba(255, 255, 255, 0.6); /* Optional: dim background */
}

</style>

                    