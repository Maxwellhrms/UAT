				<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Employee</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<form id="filterdata" method="post">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="cmpname" id="cmpname"> 
									<option value="">Select Company</option>
									<?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
										<option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
									<?php } ?>
								</select>
								<label class="focus-label">Company</label>
								<span class="formerror" id="cmpnameerror"></span>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="divname" id="divname"> 

								</select>
								<label class="focus-label">Division</label>
								<span class="formerror" id="divnameerror"></span>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="brname" id="brname"> 

								</select>
								<label class="focus-label">Branch</label>
								<span class="formerror" id="brnameerror"></span>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="emptype" id="emptype"> 
									<option value="">Select Employee Type</option>
									<?php foreach ($emptype as $key21 => $emtype) { ?>
									<option value="<?php echo $emtype->mxemp_ty_id ?>"><?php echo $emtype->mxemp_ty_name ?></option>
									<?php } ?>
								</select>
								<label class="focus-label">Employee Type</label>
								<span class="formerror" id="emptypeerror"></span>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="cmpstate" id="cmpstate"> 
									<option value="">Select State</option>
									<?php foreach ($states as $key => $stvalue) { ?>
										<option value="<?php echo $stvalue->mxst_id ?>"><?php echo $stvalue->mxst_state ?></option>
									<?php } ?>
								</select>
								<label class="focus-label">State</label>
								<span class="formerror" id="cmpstateerror"></span>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="empstatus" id="empstatus"> 
									<option value="ALL">Select Status</option>
									<option value="ALL">ALL</option>
									<option value="W">WORKING</option>
									<option value="N">NOTICE PERIOD</option>
									<option value="RNP">RESIGNED(With Notice Period)</option>
									<option value="RWNP">RESIGNED(Without Notice Period)</option>
									<option value="R">RESIGNED</option>
								</select>
								<label class="focus-label">Status</label>
								<span class="formerror" id="empstatuserror"></span>
							</div>
						</div>
                                                <div class="col-sm-6 col-md-3">
                                                        <div class="form-group form-focus select-focus">
                                                                <select class="select2 form-control" name="empgender" id="empgender">
                                                                        <option value="">Select Gender</option>
                                                                        <option value="Male">MALE</option>
                                                                        <option value="Female">FEMALE</option>
                                                                </select>
                                                                <label class="focus-label">Gender</label>
                                                                <span class="formerror" id="empgendererror"></span>
                                                        </div>
                                                </div>

                        <div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="empmonth" id="empmonth"> 
									<option value="">Select Month</option>
									<?php 
										date_default_timezone_set('Asia/Kolkata');
										for($i=1; $i<=12; $i++){ 
										    $month = date('F', mktime(0, 0, 0, $i, 10));  ?>
										    <option value="<?php echo $i ?>"><?php echo $month; ?></option>
										<?php } ?>
								</select>
								<label class="focus-label">Month</label>
								<span class="formerror" id="empmontherror"></span>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select2 form-control" name="empyear" id="empyear"> 
									<option value="">Select Year</option>
									<?php 
									  $currently_selected = date('Y'); 
									  $earliest_year = 2020; 
									  $latest_year = date('Y'); 
									  foreach ( range( $latest_year, $earliest_year ) as $i ) {
									    echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
									  }
									?>
								</select>
								<label class="focus-label">Year</label>
								<span class="formerror" id="empyearerror"></span>
							</div>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<input class="form-control" type="text" name="emp_id" id="emp_id"> 
								<label class="focus-label">Employee ID</label>
								<span class="formerror" id="emp_iderror"></span>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">  
							<button type="submit" class="btn btn-success btn-block"> Search </button>  
						</div>
                    </div>
					</form>
					<!-- Search Filter -->
					
					<div class="row staff-grid-row" id="displayfilterdata">


					</div>
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->

<script>
$( document ).ready(function() {

  	$( "#cmpname" ).change(function() {
    //   event.preventDefault();
      var cmpid = $("#cmpname").val();
	    $.ajax({
	        url: baseurl+'test/getdivision',
	        type: 'POST',
	        data: {companyid : cmpid},
	        success: function (data) {
	          $("#divname").html(data);
	        },
	    });
	});

  $( "#divname" ).change(function() {
      event.preventDefault();
      var divid = $("#divname").val();
    $.ajax({
        url: baseurl+'test/getbranch',
        type: 'POST',
        data: {divisionid : divid},
        success: function (data) {
          $("#brname").html(data);
        },
    });
  });

$("form#filterdata").submit(function(e) {
e.preventDefault();

var cmpname = $("#cmpname").val();
if(cmpname ==""){
  $("#cmpname").focus();
  $('#cmpnameerror').html("Please Select Company Name");
  return false;
}else{$('#cmpnameerror').html("");}

/*var divname = $("#divname").val();
if(divname ==""){
  $("#divname").focus();
  $('#divnameerror').html("Please Enter Division");
  return false;
}else{$('#divnameerror').html("");}

var brname = $("#brname").val();
if(brname ==""){
  $("#brname").focus();
  $('#brnameerror').html("Please Enter Branch Name");
  return false;
}else{$('#brnameerror').html("");}

var emptype = $("#emptype").val();
if(emptype ==""){
  $("#emptype").focus();
  $('#emptypeerror').html("Please Select Employee Type");
  return false;
}else{$('#emptypeerror').html("");}

var cmpstate = $("#cmpstate").val();
if(cmpstate ==""){
  $("#cmpstate").focus();
  $('#cmpstateerror').html("Please Select Company State");
  return false;
}else{$('#cmpstateerror').html("");}

var empstatus = $("#empstatus").val();
if(empstatus ==""){
  $("#empstatus").focus();
  $('#empstatuserror').html("Please Select Status");
  return false;
}else{$('#empstatuserror').html("");}
*/
var formData = new FormData(this);
mainurl = baseurl+'admin/employeefliterdata';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
        $('#displayfilterdata').html(data);
    },
    cache: false,
    contentType: false,
    processData: false
});

});

});
</script>
<script>
$(document).ready(function() {
    $('#cmpname').val('1').trigger('change');
    cmp();
    function cmp(){
        var cmpid = $("#cmpname").val();
	    $.ajax({
	        url: baseurl+'test/getdivision',
	        type: 'POST',
	        data: {companyid : cmpid},
	        success: function (data) {
	          $("#divname").html(data);
	        },
	    });
    }
});
</script>
