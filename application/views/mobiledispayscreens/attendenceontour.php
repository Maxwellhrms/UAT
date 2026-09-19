<?php echo $controller->mastersfilter(); ?>

<div id="attendauthlist"> </div>

<!-- /Page Content -->
</div>


<script>
    
$("form#commonform").submit(function(e) {
    
e.preventDefault();  
        var mnth = $("#attndmonth").val();
        if (mnth == 0 || mnth == "") {
            $("#attndmonth").focus();
            $('#attndmontherror').html("Please Select Month");
            return false;
        } else {
            $('#attndmontherror').html("");
        }
        var year = $("#attndyear").val();
        if (year == 0 || year == "") {
            $("#attndyear").focus();
            $('#attndyearerror').html("Please Select Year");
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
        var approvstatus = $("#approvstatus").val();
        if(mnth.length==1){
            var month = 0 + mnth;
        }else{
            var month = mnth;
        }
        var month_year=year + - + month;
        var mainurl = baseurl+'mobileapidisplay/attendanceontourlist';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'month_year': month_year,'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'filter':'1','approvstatus':approvstatus},
            success: function (data) {
            //  console.log(data);
               $("#attendauthlist").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5', footer: true }
                    ],
                });
            }
        });
    });

       
    $(document).on("click", ".attndreg", function () {
    	// var id = $(this).data('id');
        var ids = $(this).data('id');
    	var x = ids.split("~",6);
    	var id = x[0];
        var authstatus = x[1];
        if(authstatus == 1){
            $('#authbutton').hide();
        }else{        
            $('#authbutton').show();
        }
        $(".modal-body #unid").val(id);
        $(".modal-body #authstatus").val(authstatus);
        $(".modal-body #auth1desc").html(x[2]);
        $(".modal-body #auth2desc").html(x[3]);
        $(".modal-body #auth3desc").html(x[4]);
        $(".modal-body #authfinaldesc").html(x[5]);
        var salesrepBox = $('select[id="approve"]');
        $('select[id="approve"] option').removeAttr('selected').change();
         salesrepBox.find('option[value="' + authstatus + '"]').attr('selected','selected').change();
    
    });
    
    </script>