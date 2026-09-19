


			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Geo Location Attendance</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-0">
									<div class="card-body">
										<form id="googlemap">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Company:</label>
					                                            <select class="form-control select2" name="esi_company_id" id="esi_company_id"  style="width: 100%">
							                                        <option value="">-- Select Company --</option>
							                                        <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
							                                            <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
							                                        <?php } ?>
							                                    </select>
							                                    <span class="formerror" id="cmpnameerror"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<label>Division:</label>
															<select class="select2 form-control"  data-placeholder="Select Division" name="esi_div_id" id="esi_div_id" style="width: 100%;">
															<option value="">Select Division</option>
															</select>
															<span class="formerror" id="esi_div_id_error"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Employee Code:</label>
																<select type="text" name="employeeid" id="employeeid" class="form-control select2" style="width: 100%">
																	
																</select>
																<span class="formerror" id="employeeiderror"></span>
															</div>
														</div>
														<div class="col-md-6">
                        				                    <div class="form-group form-focus select-focus">
                        				                        <label>Attendance Date</label>
                                                            	<input type="text" class="form-control datetimepicker" name="attendance" id="attendance" autocomplete="off" value="15-11-2022">
                        				                        <span class="formerror" id="attendance_error"></span>
                        				                    </div>
                        				                </div>

														
														
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
															<label>State:</label>
	                                                        <select class="form-control select2" name="esi_state_id" id="esi_state_id" style="width: 100%;">
	                                                            <option value="">Select State</option>
	                                                        </select>
	                                                        <span class="formerror" id="esi_state_id_error"></span>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
														    	<label>Branch:</label>
                                                                <select class="form-control select2" name="esi_branch_id" id="esi_branch_id" style="width: 100%;">
                                                                    <option value="">Select Branch</option>
                                                                </select>
                                                                <span class="formerror" id="esi_branch_id_error"></span>
															</div>
														</div>
														
														<div class="col-sm-6">  
														    <label></label>
							                                 <button id="searchemployeefilterdata" class="btn btn-success btn-block" > Search </button>      
							                             </div>

    												</div>
    											</div>
											</div>  
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div id="excellist1"> </div>
			</div>
			<!-- /Page Wrapper -->

            <script src="<?php echo base_url(); ?>/assets/js/formsjs/emploan.js"></script>
            <script>
                
                
$("form#googlemap").submit(function (e) {
    e.preventDefault();
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
    if (esi_div_id == 0 || esi_div_id == "") {
        $("#esi_div_id").focus();
        $('#esi_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#esi_div_id_error').html("");
    }

    var esi_state_id = $("#esi_state_id").val();
    if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    }

    var esi_branch_id = $("#esi_branch_id").val();
    if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }

    var employeeid = $("#employeeid").val();
    if (employeeid == "") {
        $('#employeeiderror').html("Please Select Employee");
        $("#employeeid").focus();
        return false;
    } else {
        $('#employeeiderror').html("");
    }
    
    var mainurl = baseurl + 'Attendance_controller/googlemap_list';
    var formData = new FormData(this);
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            // console.log(data);
                        $("#excellist1").html('');

            $("#excellist1").html(data);


var locations = [
    ['Somajiguda',17.423412,78.4616385,4],
    ['Secunderabad',17.4426187,78.4616385,3],
    ['surya towers',17.4426156,78.4893747,2],
    ['Kalasiguda',17.4426156,78.4893747,1]
];
 
//   var locations = <?php // echo json_encode($locations) ?>;

var map = new google.maps.Map(document.getElementById('map'), {
zoom: 10,
center: new google.maps.LatLng(locations[0][1], locations[0][2]),
mapTypeId: google.maps.MapTypeId.ROADMAP
});

var infowindow = new google.maps.InfoWindow();

var marker, i;
    for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
        });
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        }
        })(marker, i));
    }




        },
        cache: false,
        contentType: false,
        processData: false
    });

});

            </script>
            
      