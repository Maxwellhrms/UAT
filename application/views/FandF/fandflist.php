					<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Full And Final Settlement</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Full And Final Settlement</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<div class="row filter-row">

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="attndyear" id="attndyear"> 
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
								<label class="focus-label">Select Year</label>
							</div>
							<span class="formerror" id="attndyearerror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="attndmonth" id="attndmonth"> 
									<option value="">Select Month</option>
									<?php 
										date_default_timezone_set('Asia/Kolkata');
										for($i=1; $i<=12; $i++){ 
										    $month = date('F', mktime(0, 0, 0, $i, 10));  ?>
										    <option value="<?php echo $i ?>"><?php echo $month; ?></option>
										<?php } ?>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
							<span class="formerror" id="attndmontherror"></span>
							
						</div>

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
								<select class="select select2" style="width: 100%" name="status_type" id="status_type"> 
									<option value="" selected>Select</option>
									<option value="N" >Notice Period</option>
									<option value="WN">Resigned(Without Notice Period)</option>
									<option value="R">F&F Completed</option>
								</select>
								<label class="focus-label">Select Status</label>
							</div>
							<span class="formerror" id="esi_div_id_error"></span>
						</div>
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="attndempid" id="attndempid">
								<label class="focus-label">Employee Code</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<!-- <button id="searchemployeefilterdata" class="btn btn-success btn-block" onclick="filterattnd()"> Search </button>  -->
							<button class="btn btn-success btn-block search_btn"> Search </button>  
						</div>     
                    </div>

					<!-- /Search Filter -->
					
					<!-- filterdata -->
					<div id="displaynotice_period_employees">
					<!-- Data Tables -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-sm-12">
							<div class="card mb-0">
								<div class="card-header">
									<h4 class="card-title mb-0">Resigned Employees List</h4>
								</div>
								<div class="card-body">	

									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Name</th>
													<th>Company</th>
													<th>Division</th>
													<th>State</th>
													<th>Branch</th>
													<th>Resigned</th>
													<th>Relieving</th>
													<th>View Details</th>
												</tr>
											</thead>
											<tbody>
											    <?php
											        foreach($notice_period_employees as $emp_data){
											         //   print_r($emp_data);exit;
											            echo "<tr>";
													echo "<td>$emp_data->mxemp_emp_id</td>";
													echo "<td>$emp_data->mxemp_emp_fname $emp_data->mxemp_emp_lname</td>";
													echo "<td>$emp_data->mxcp_name</td>";
													echo "<td>$emp_data->mxd_name</td>";
													echo "<td>$emp_data->mxst_state</td>";
													echo "<td>$emp_data->mxb_name</td>";
													echo "<td>".date('d/m/Y',strtotime($emp_data->mxemp_emp_resignation_date))."</td>";
													$start = strtotime(date('Y-m-d'));
                                                    $end = strtotime($emp_data->mxemp_emp_resignation_relieving_date);
                                                    $days_between = ceil(abs($end - $start) / 86400);
													echo "<td>".date('d/m/Y',strtotime($emp_data->mxemp_emp_resignation_relieving_date))." (".$days_between." Days to Relieve)</td>";
													echo "<td><a class='btn btn-info' href='".base_url()."Fullandfinalsettlement/fandfdetails/".$emp_data->mxemp_emp_id."/".$emp_data->mxemp_emp_resignation_status."'>View</a></td>";
												    echo "</tr>";
											        }
											    ?>
												<!--<tr>-->
												<!--	<td>EMP0001</td>-->
												<!--	<td>Test</td>-->
												<!--	<td>DIVISION</td>-->
												<!--	<td>STATE</td>-->
												<!--	<td>Branch</td>-->
												<!--	<td>01-08-2021</td>-->
												<!--	<td>01-09-2021 (31 Days to Relieve)</td>-->
												<!--	<td><a class="btn btn-info" href="<?php //echo base_url() ?>Fullandfinalsettlement/fandfdetails">View</a></td>-->
												<!--</tr>-->
													
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <!-- Data Tables -->
					</div>
					<!-- filterdata -->

                </div>
				<!-- /Page Content -->
				<script src="<?php echo base_url(); ?>assets/js/formsjs/fandflist.js"></script>



<script type="text/javascript">
// function processeditattedance(){
// 		var editempdate = $("#editempdate").val();
// 		var editempid = $("#editempid").val();
// 		var editempmainid = $("#editempmainid").val();
// 		var Firsthalf = $("#Firsthalf").val();
// 		var Secondhalf = $("#Secondhalf").val();
// 		var reason = $("#reason").val();

// 		if(reason =""){
// 			alert("Please Enter Reason For Modifying The Attendance");
// 			return false;
// 		}

// 		mainurl = baseurl+'admin/editemployeeattendance';
// 		var result = confirm("Want to Modify Attendance For " + editempid + " for date " + editempdate);
// if (result == true) {
//     $.ajax({
//         url: mainurl,
//         type: 'POST',
//         data: {date : editempdate, empid : editempid, uniqueid : editempmainid, firsthalf : Firsthalf, secondhalf : Secondhalf, reason : reason},
//         success: function (data) {
//         	console.log(data);
//           if (data == 200) {
//             alert('Success');
//           $( "#closeattand" ).trigger( "click" );
//           $( "#searchemployeefilterdata" ).trigger( "click" );
//           }else {
//             alert('Try Again Later');
//           }
//         },
//     });
// }
// }
</script>
