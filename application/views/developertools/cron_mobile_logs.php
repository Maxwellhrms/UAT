<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Mobile Logs</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Mobile Log Details</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<ul class="nav nav-tabs nav-tabs-top">
				<!--<li class="nav-item"><a class="nav-link " href="#top-tab1" data-bs-toggle="tab">Cron list</a></li>-->
				<li class="nav-item"><a class="nav-link active" href="#top-tab2" data-bs-toggle="tab">Mobile App Operations</a></li>
				<!--<li class="nav-item"><a class="nav-link" href="#top-tab3" data-bs-toggle="tab">Messages</a></li>-->
			</ul>
			<div class="tab-content">
				<div class="tab-pane show active" id="top-tab2">
                    <!-- Notes log Tables -->
                    					<div style="margin-top: 10px;">
                    								<div class="card-header">
                    									<h4 class="card-title mb-0">Mobile App Operations List </h4>
                                    <div class="row filter-row">
                    					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    							<div class="form-group form-focus">
                    								<input type="text" class="form-control floating" name="notesemp" id="notesemp">
                    								<label class="focus-label">Employee Code</label>
                    							</div>
                    					   </div>
                    
                    						<div class="col-sm-6 col-md-3 col-xl-2 col-12"> 
                    							<div class="form-group form-focus select-focus">
                    								<select class="select2 floating" name="notescategory" id="notescategory"><?php echo $controller->display_options('notes',''); ?></select>
                    								<label class="focus-label">Category</label>
                    							</div>
                                            </div>
                    
                    					   
                    					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    							<div class="form-group form-focus">
                    								<div class="cal-icon">
                    									<input class="form-control floating datetimepicker" type="text" name="notesdate" id="notesdate">
                    								</div>
                    								<label class="focus-label">Notes Date</label>
                    							</div>
                    						</div>
                    
                    					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    							<button class="btn btn-success w-100" onclick="getnotes()">Filter</button>  
                    					   </div>     
                                        </div>
                    								</div>
                    								<div class="card-body">	
                                                        <div id="notes_display"></div>
                    								</div>
                    						
                    					</div>
                    <!-- Notes log Tables -->
				</div>
				<div class="tab-pane" id="top-tab3">
					Tab content 3
				</div>
			</div>
		</div>
	</div>
</div>

	
	</div>
	<!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
<script>
function getnotes(){
var nemp = $('#notesemp').val();
var ncg = $('#notescategory').val();
var ndt = $('#notesdate').val();
var mainurl ='<?php echo base_url() ?>Developertools/getmobilenoteslist';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: {employeeid : nemp, category : ncg, date : ndt},
    success: function (data) {
    	// console.log(data);
        $('#notes_display').html(data);
    		var table = $('#notes_datatable').DataTable({
                 dom: 'Bfrtip',
                 "destroy": true, //use for reinitialize datatable
                 lengthChange: false,
                 buttons: [
                     { extend: 'excelHtml5', footer: true }
                 ],
         });
    },
});
}
</script>