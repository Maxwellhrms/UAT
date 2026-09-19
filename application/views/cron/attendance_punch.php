<!-- Page Wrapper -->
				<div class="page-wrapper">
				    <!-- Page Content -->
				    <div class="content container-fluid">
					<!-- <div class="spinner-border text-muted"></div> -->
				        <!-- Page Header -->
				        <div class="page-header">
				            <div class="row align-items-center">
				                <div class="col">
				                    <h3 class="page-title">Attendance Accumulation</h3>
				                    <ul class="breadcrumb">
				                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
				                        <li class="breadcrumb-item active">Attendance Accumulation Cron</li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				        <!-- /Page Header -->

				        <!-- Search Filter -->
				        <form id="attnd">
				            <div class="row filter-row">	                				                
				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
                                    <?php  $current = date('d-m-Y'); ?>
										<input type="text" class="form-control datetimepicker" name="attendance" id="attendance" autocomplete="off" value="<?php echo $current; ?>">
				                        <label class="focus-label">Attendance Date</label>
				                        <span class="formerror" id="attendance_error"></span>
				                    </div>
				                </div>

				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
										<input type="text" class="form-control" name="employeeid" id="employeeid" autocomplete="off" >
				                        <label class="focus-label">Employee Code</label>
				                        <span class="formerror" id="employeeid_error"></span>
				                    </div>
				                </div>

				                <div class="col-sm-6 col-md-3">
				                	<input type="hidden" class="form-control" name="printable" id="printable" value="Y" autocomplete="off" >
				                    <button type="submit" class="btn btn-success btn-block"> Process </button>
				                </div>
				            </div>
				        </form>
				        <!-- Search Filter -->
						<div id="display_attnd"></div>
				    </div>
				    <!-- /Page Content -->
				</div>
				<!-- /Page Wrapper -->

				
                    <script>
                        //--------FOR SUBMIT 
$(document).ready(function(){
 
$("form#attnd").submit(function (e) {
    e.preventDefault();   
    var attendance = $("#attendance").val();
    if (attendance ==  "") {
        $("#attendance").focus();
        $('#attendance_error').html("Please Enter Attendance Date");
        return false;
    } 

	var employeeid = $("#employeeid").val();
    if(employeeid != ""){
    	alert('Attendance Process Will Be Runed for the Selected Employee Only');

    }

	var result = confirm("Do You Wish To Process");
    if (result == true) {
    	var mainurl = baseurl + 'cron/attendance_cron'; 
	    var formData = new FormData(this);
	    $.ajax({
	        url: mainurl,
	        type: 'POST',
	        data: formData,
	        async:false,
	        success: function (data) {
	        	$('#display_attnd').html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title:'<?php echo $titlehead ?>',
                        messageTop: '<?php echo $excelheading; ?>'
                    },
                    { 
                        extend: 'excelHtml5',
                        title:'<?php echo $titlehead ?>',
                        messageTop: '<?php echo $excelheading; ?>',
                        footer: true 
                    }
                ],
            });
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	}

});   

});
</script>
                    
                    
                    