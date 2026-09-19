<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Cron Logs</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">All Crons Logs</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Crons logs list</h4>
				</div>
				<div class="card-body">
					<form id="menudetails">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Cron Type <span class="text-danger">*</span></label>
									<select name="crontype" id="crontype" class="form-control select2" style="width: 100%" >
										<option value="">All</option>
                                        <?php foreach($filtertype as $key => $val){ ?>
                                        <option value="<?php echo $val->mx_cron ?>"><?php echo $val->mx_cron ?></option>
                                        <?php } ?>
									</select>
									<span class="formerror" id="crontypeerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Cron Runned Date <span class="text-danger">*</span></label>
									<input class="form-control datetimepicker" type="text" name="date" id="date" autocomplete="off">
									<span class="formerror" id="dateerror"></span>
							   </div>
							</div>

						</div>
						<div class="text-right">
							<button type="button" onClick="getcronlogslist();" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
		
<!-- Data Tables -->

<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Logs List</h4>
			</div>
			<div class="card-body" id="displaymenushere">	


			</div>
		</div>
	</div>
</div>
<!-- Data Tables -->

	</div>			
</div>
<!-- /Main Wrapper -->
<script>var menu = 1;</script>
<script src="<?php echo base_url() ?>assets/js/formsjs/menu.js"></script>
<script type="text/javascript">
	function getcronlogslist(){
  var crontype = $("#crontype").val();
//   if(crontype ==""){
//     $("#crontype").focus();
//     $('#crontypeerror').html("Please Select Cron Type");
//     return false;
//   }else{$('#crontypeerror').html("");} 
     var crondate = $("#date").val();
    $.ajax({
        url: baseurl+'developertools/getcronlogslist',
        type: 'POST',
        data: {crontypes : crontype,cronrundate : crondate},
        success: function (data) {
          $("#displaymenushere").html(data);
	        var table = $('#dataTables-example').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5', footer: true }
                    ],
            });
        }
    });
}


$( document ).ready(function() {
    getcronlogslist();
});
</script>
