$(document).ready(function () {
    $("form#increment_cron_form").submit(function (e) {
        e.preventDefault();
        var cmp_id = $("#cmpname").val();
        if (cmp_id == 0 || cmp_id == "") {
            $("#cmpname").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }
        // var emptype = $("#emptype").val();
        // if (emptype == 0 || emptype == "") {
        //     $("#emptype").focus();
        //     $('#emptype_error').html("Please Select Emplyement Type");
        //     return false;
        // } else {
        //     $('#emptype_error').html("");
        // }

        var sal_month_year = $("#sal_month_year").val();
        if (sal_month_year == "") {
            $("#sal_month_year").focus();
            $('#sal_month_year_error').html("Please Select Month and Year");
            return false;
        } else {
            $('#sal_month_year_error').html("");
        }

        $.ajax({
            async: false,
            type: "POST",
            async:false,
            data: { cmp_id: cmp_id, cron_month_year: sal_month_year },
            url: baseurl + 'Cron/increments_cron',
            datatype: "html",
            beforeSend: function(){
                    // $('.ajax-loader').css("visibility", "visible");
                    $('.ajax-loader-hide').addClass("ajax-loader");
                    $('.ajax-loader').removeClass("ajax-loader-hide");
            },
            success: function (data) {
                console.log(data);
                    $('.ajax-loader').addClass("ajax-loader-hide");
                    $('.ajax-loader-hide').removeClass("ajax-loader");
                // $('.ajax-loader').css("visibility", "hidden");
                var parsedData = JSON.parse(data);
                // console.log(parsedData);
                if(parsedData.status == 0){
                    alert(parsedData.message);
                    return false;
                }else if(parsedData.status == 1){
                    alert(parsedData.message);
                    window.location.reload();
                    return false;
                }else{
                    alert("Some Error Getting Contact Developer...");
                    return false;
                }
            }
        });

    });
    
});