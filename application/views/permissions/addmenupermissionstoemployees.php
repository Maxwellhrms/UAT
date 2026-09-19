		<!-- Page Wrapper -->
          <div class="page-wrapper">
					
			<!-- Page Content -->
              <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Create Logins</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Logins</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

				<!-- Search Filter -->
				
<form id="checkemp">
				<div class="row filter-row">

					<div class="col-sm-6 col-md-3"> 
						<div class="form-group form-focus select-focus">
							<input class="form-control" name="empcode" id="empcode" autocomplete="off">
							<label class="focus-label">Employee Code</label>
							<span class="formerror" id="empcodeerror"></span>
						</div>
					</div>

					<div class="col-sm-6 col-md-3">  
						<button type="submit" class="btn btn-success btn-block"> Search Employee </button>  
					</div>
        </div>
</form>
				<!-- Search Filter -->
				<div id="displayemployeedata"></div>
              </div>
			<!-- /Page Content -->
</div>
<script type="text/javascript">

$("form#checkemp").submit(function (e) {
	e.preventDefault();

var empcode = $("#empcode").val();

if(empcode == ""){
	alert("Please Enter Employee Code");
	return false;
}

    $.ajax({
      url: baseurl + 'Permissions/searchemployeelgdetails',
      type: 'POST',
      data: { employeeid: empcode },
      success: function (data) {
      	// console.log(data);
      	$("#displayemployeedata").html(data);
      },
    });
});
</script>