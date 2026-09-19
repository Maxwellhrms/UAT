			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Loan Request From Employees</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Loan Request</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
<!-- filters -->
					<div class="row filter-row">

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_company_id" id="esi_company_id"> 
                                    <option value=""> Select Company </option>
                                    <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                        <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                    <?php } ?>
								</select>
								<label class="focus-label">Select Company</label>
							</div>
							<span class="formerror" id="cmpnameerror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_div_id" id="esi_div_id"> 
									<option value="">Select Division</option>
								</select>
								<label class="focus-label">Select Division</label>
							</div>
							<span class="formerror" id="esi_div_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_state_id" id="esi_state_id"> 
									<option value="">Select State</option>
								</select>
								<label class="focus-label">Select State</label>
							</div>
							<span class="formerror" id="esi_state_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_branch_id" id="esi_branch_id"> 
									<option value="">Select Branch</option>
								</select>
								<label class="focus-label">Select Branch</label>
							</div>
							<span class="formerror" id="esi_branch_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="category" id="category"> 
									<option value="">Select Category</option>
									<?php echo $controller->display_options('loan_reasons',''); ?>
								</select>
								<label class="focus-label">Select Category</label>
							</div>
							<span class="formerror" id="categoryerror"></span>
						</div>


						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="status" id="status"> 
									<option value="">ALL</option>
								    <option value='1'>PENDING</option>
								    <option value='2'>REJECTED</option>
								    <option value='3'>APPROVED</option>
								</select>
								<label class="focus-label">Select status</label>
							</div>
							<span class="formerror" id="statuserror"></span>
						</div>

						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="attndempid" id="attndempid">
								<label class="focus-label">Employee Code</label>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating datetimepicker" name="applieddt" id="applieddt">
								<label class="focus-label">Applied Date</label>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">  
							<button id="searchemployeefilterdata" class="btn btn-success btn-block" onclick="filterattnd()"> Search </button>  
						</div>     
                    </div>
<!-- filters -->

<!-- Data Tables -->
<div id="displaydata"></div>
<!-- Data Tables -->

				</div>
			</div>
			<!-- /Page Wrapper -->


<script src="<?php echo base_url(); ?>/assets/js/formsjs/emploan.js"></script>
<script>
	function filterattnd(){
	var emp = $("#attndempid").val();
	
	
	    var esi_div_id = $("#esi_div_id").val();
	    var esi_state_id = $("#esi_state_id").val();
	    var esi_branch_id = $("#esi_branch_id").val();
    var esi_company_id = $("#esi_company_id").val();
    var applieddts = $("#applieddt").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var stat = $("#status").val();
	var mainurl = baseurl+'Loan_controller/filteremployeeappliedloandetails';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: {employeecode : emp, company:esi_company_id, divison:esi_div_id, state:esi_state_id, branch:esi_branch_id,status:stat,applieddt :applieddts},
    success: function (data) {
		//console.log(data);
        $('#displaydata').html(data);
            var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title:'<?php echo 'Regulation' ?>',
                        messageTop: '<?php echo $excelheading; ?>'
                    },
                    { 
                        extend: 'excelHtml5',
                        title:'<?php echo 'Regulation' ?>',
                        messageTop: '<?php echo $excelheading; ?>',
                        footer: true 
                    }
                ],
            });
    },
});
}
</script>
