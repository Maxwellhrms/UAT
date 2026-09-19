$( document ).ready(function() {
  
    $("form#fandfdetails_form").submit(function(e) {
        e.preventDefault();  
        // alert();
        // return false;
        var pf_emp_share = $("#pf_emp_share").val().trim();
        if(pf_emp_share ==""){
          $("#pf_emp_share").focus();
          $('#pf_emp_share_error').html("Please Enter PF Emp Share");
          return false;
        }else{$('#pf_emp_share_error').html("");}
        
        var esi_emp_share = $("#esi_emp_share").val();
        if(esi_emp_share ==""){
          $("#esi_emp_share").focus();
          $('#esi_emp_share_error').html("Please Enter ESI Emp Share");
          return false;
        }else{$('#esi_emp_share_error').html("");}
        
        // if(div == 1){
        //   mainurl = baseurl+'admin/savedivisondetails';
        // }else if(div == 2){
        //   mainurl = baseurl+'admin/saveeditdivisondetails';
        // }
          mainurl = baseurl+'Salaries_controller/save_fandf_data';
        
        var formData = new FormData(this);
        formData. append("emp_code", emp_code);

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
              console.log(data);
              
                if (data == 200) {
                    alert('Successfully Saved The F&F Details...');
                    setTimeout(function(){
                    window.location.reload();
                    }, 1000); 
                } else {
                	alert('Failed To Save Please TryAgain later');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

$("#process_bank_data").click(function(){
    var bank_status = $("#bank_status").is(":checked");
    if(bank_status == false){
        $("#bank_status_error").html("Please Check The Transfered To Bank..");
        return false;
    }else{
        $("#bank_status_error").html("");
    }
    // alert(bank_status);
    // return false;
    mainurl = baseurl+'Salaries_controller/update_fandf_bank_status';
        
        // var formData = new FormData(this);
        // formData. append("emp_code", emp_code);
        // alert(emp_code);return false;
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: {emp_code:emp_code},
            success: function (data) {
              console.log(data);
              
                if (data == 200) {
                    alert('Successfully Updated The Bank Status');
                    setTimeout(function(){
                    window.location.href = baseurl + 'Fullandfinalsettlement/resignedlist';
                    }, 1000); 
                } else {
                	alert('Failed To Save Please TryAgain later');
                }
            }
            // cache: false,
            // contentType: false,
            // processData: false
        });
});



});

