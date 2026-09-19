<!-- Page Wrapper -->
				<div class="page-wrapper">
				    <!-- Page Content -->
				    <div class="content container-fluid">
					<!-- <div class="spinner-border text-muted"></div> -->
				        <!-- Page Header -->
				        <div class="page-header">
				            <div class="row align-items-center">
				                <div class="col">
				                    <h3 class="page-title">Previous Month Leave Accumulation Cron</h3>
				                    <ul class="breadcrumb">
				                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
				                        <li class="breadcrumb-item active">Previous Month Leave Accumulation Cron</li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				        <!-- /Page Header -->

				        <!-- Search Filter -->
				        <form id="yearmonthdate">
				            <div class="row filter-row">	                				                
				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
                                    <?php  //echo $next_year = (date('Y')+1); ?>
				                        <select class="select2 form-control" name="cronid" id="cronid">
				                            <option value="">Select </option>
				                            <option value="1">Earned Leave</option>
				                            <option value="2">Casual Leave</option>
				                            <option value="3">Sick Leave</option>
				                           
				                        </select>
				                        <label class="focus-label">Cron Leave</label>
				                        <span class="formerror" id="cron_Leave_error"></span>
				                    </div>
				                </div>

                                <div class="col-sm-6 col-md-6">
				                    <div class="form-group ">                                 
                                        <div class="col-lg-9">
                                            <input type="text" value ="<?php  print_r($yearcrondate); ?>" class="form-control monthyear" name="month_year" id="month_year">
                                        </div>
                                    </div>
				                </div>

				                <div class="col-sm-6 col-md-3">
				                    <button type="submit" class="btn btn-success btn-block"> Generate Leaves </button>
				                </div>
				            </div>
				        </form>
				        <!-- Search Filter -->
						
				    </div>
				    <!-- /Page Content -->
				</div>
				<!-- /Page Wrapper -->

				
                    <script>
                        //--------FOR SUBMIT 
$(document).ready(function(){

$(".monthyear").prop("disabled", true);
 
$("form#yearmonthdate").submit(function (e) {
    e.preventDefault();   
    var cronid = $("#cronid").val();
    if (cronid ==  "") {
        $("#cronid").focus();
        $('#cron_Leave_error').html("Please Select Leave Type ...");
        return false;
    } 
    if (cronid == 1) {
    var mainurl = baseurl + 'cron/Elcronmodeldatewise';
    } else if (cronid == 2) {
    var mainurl = baseurl + 'cron/Clcronmodeldatewise';
    }else if(cronid == 3){
    var mainurl = baseurl + 'cron/Slcronmodeldatewise';    
    }

    var formData = new FormData(this);
    formData.append("printable",'Y');
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        async:false,
        success: function (data) {
            //  console.log(data);
            //  return false;
            if (data == 200) {
                alert('Successfully Generated Leaves.....');
                setTimeout(function () {                    
                    window.location.reload();
                }, 1000);
            } else {
                alert('Failed To Save Please TryAgain later');
                return false;
            } 
        },
        cache: false,
        contentType: false,
        processData: false
    });

});   

});
</script>
                    
                    
                    