$(document).ready(function(){
	
	
    
    $(".amount_ear, .amount_ded").keyup(function(){
        
        var total_earnings = get_total_earnings();
        var total_deductions = get_total_deductions();
        var net_payable = parseInt(total_earnings) - parseInt(total_deductions);
        
        if(net_payable > 0){
            $("#payable_flag_span").text("PAYABLE");
            $("#payable_flag").val("0");
        }else if(net_payable < 0){
            $("#payable_flag_span").text("Recoverable");
            $("#payable_flag").val("1");
        }else if(net_payable == 0){
            $("#payable_flag_span").text("");
            $("#payable_flag").val("0");
        }
        $("#net_payable").val(net_payable);
        $("#total_earnings").val(total_earnings);
        $("#total_deductons").val(total_deductions);
        
    });
    function get_total_earnings(){
        var final_total_earnings = 0;
        $(".amount_ear").each(function(){
            var amount_earnings = $(this).val().trim();
            if(amount_earnings != ""){
                final_total_earnings = final_total_earnings + parseInt(amount_earnings);
            }
            
        });
        return final_total_earnings;
    }
    function get_total_deductions(){
        var final_total_deductions = 0;
        $(".amount_ded").each(function(){
            var amount_deductions = $(this).val().trim();
            if(amount_deductions != ""){
                final_total_deductions = final_total_deductions + parseInt(amount_deductions);
            }
            
        });
        return final_total_deductions;
    }
    
	
	get_total_earnings1();
    get_total_deductions1();
	
	function get_total_earnings1(){
        var final_total_earnings = 0;
        $(".amount_ear").each(function(){
            var amount_earnings = $(this).val().trim();
            if(amount_earnings != ""){
                final_total_earnings = final_total_earnings + parseInt(amount_earnings);
            }            
        });
		$("#total_earnings").val(final_total_earnings);	
    }
    function get_total_deductions1(){
        var final_total_deductions = 0;
        $(".amount_ded").each(function(){
            var amount_deductions = $(this).val().trim();
            if(amount_deductions != ""){
                final_total_deductions = final_total_deductions + parseInt(amount_deductions);
            }            
        });
		$("#total_deductons").val(final_total_deductions);
        //return final_total_deductions;
		var final_total_earnings= $("#total_earnings").val();
		
		var net_payable = parseInt(final_total_earnings) - parseInt(final_total_deductions);
        
        if(net_payable > 0){
            $("#payable_flag_span").text("PAYABLE");
            $("#payable_flag").val("0");
        }else if(net_payable < 0){
            $("#payable_flag_span").text("Recoverable");
            $("#payable_flag").val("1");
        }else if(net_payable == 0){
            $("#payable_flag_span").text("");
            $("#payable_flag").val("0");
        }
        $("#net_payable").val(net_payable);
        
        
		
		
    }
    
    $("#fandfdetails_left_form").submit(function(e) {
        e.preventDefault();  
        // alert();
        // return false;
        var final_total_earnings_flag = 0;
        $(".amount_ear").each(function(){
            var amount_earnings = $(this).val().trim();
            if(amount_earnings != ""){
                final_total_earnings_flag = 1;
            }
            
        });
        
        
        //-------DEDUCTION
        var final_total_deductions_flag = 0;
        $(".amount_ded").each(function(){
            var amount_deductions = $(this).val().trim();
            if(amount_deductions != ""){
                final_total_deductions_flag = 1;
            }
        });
        
        if((final_total_earnings_flag == 0 && final_total_deductions_flag == 0) || $("#net_payable").val() == 0){
            alert("You Cant Submit Empty Form....");
            return false;
        }
        // return false;
        
        var final_confirm = confirm("Are You Sure To Submit F&F Left Form..");
        if(final_confirm == false){
            return false;
        }
        
          mainurl = baseurl+'Salaries_controller/save_fandf_left_data';
        
        var formData = new FormData(this);
        formData. append("emp_code", emp_code);

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
            //   console.log(data);
                // return false;
                var parsedData = JSON.parse(data);
                // console.log(parsedData);
                if(parsedData.status == 0){
                    alert(parsedData.message);
                    return false;
                }else if(parsedData.status == 1){
                    alert(parsedData.message);
                    window.location.href = baseurl+'Fullandfinalsettlement/resignedlist/';
                    return false;
                }else{
                    alert("Some Error Getting Contact Developer...");
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});