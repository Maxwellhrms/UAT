				<!-- Page Wrapper -->
				<div class="page-wrapper">

				    <!-- Page Content -->
				    <div class="content container-fluid">
					<!-- <div class="spinner-border text-muted"></div> -->
				        <!-- Page Header -->
				        <div class="page-header">
				            <div class="row align-items-center">
				                <div class="col">
				                    <h3 class="page-title">Cron Leaves</h3>
				                    <ul class="breadcrumb">
				                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
				                        <li class="breadcrumb-item active">Cron Leaves</li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				        <!-- /Page Header -->

				        <!-- Search Filter -->
				        <form id="create_cron_leaves">
				            <div class="row filter-row">	                				                
				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
                                    <?php  //echo $next_year = (date('Y')+1); ?>
				                        <select class="select2 form-control" name="cronid" id="cronid">
				                            <option value="">Select </option>
				                            <option value="1">Earned Leave</option>
				                            <option value="2">Casual Leave</option>
				                            <option value="3">Sick Leave</option>
				                            <option value="4">OH</option>
											<option value="12">OCH</option>
											<option value="11">SHRT</option>
				                        </select>
				                        <label class="focus-label">Cron Leave</label>
				                        <span class="formerror" id="cron_Leave_error"></span>
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


$("form#create_cron_leaves").submit(function (e) {
    e.preventDefault();   
    alert('hi');

    var cronid = $("#cronid").val();
    if (cronid ==  "") {
        $("#cronid").focus();
        $('#cron_Leave_error').html("Please Select Leave Type ...");
        return false;
    } 
    if (cronid == 1) {
    var mainurl = baseurl + 'cron/Elcronmodel';
    } else if (cronid == 2) {
    var mainurl = baseurl + 'cron/Clcronmodel';
    }else if(cronid == 3){
    var mainurl = baseurl + 'cron/Slcronmodel';    
    }else if(cronid == 4){
		var mainurl = baseurl + 'cron/ohcronmodel';
	}else if(cronid == 12){
		var mainurl = baseurl + 'cron/ochcronmodel'; 
    }else if(cronid == 11){
		var mainurl = baseurl + 'cron/shrtcronmodel'; 
    }

    var formData = new FormData(this);
    formData.append("printable",'Y');
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        async:false,
        success: function (data) {
            console.log(data);
            alert(data);
            // return false;
            // if (data == 200) {
            //     alert('Successfully Generated Leaves.....');
            //     setTimeout(function () {                    
            //         window.location.reload();
            //     }, 1000);
            // } else {
            //     alert('Failed To Save Please TryAgain later');
            //     return false;
            // } 
        },
        cache: false,
        contentType: false,
        processData: false
    });

});   

});
</script>
                    
                    
                    