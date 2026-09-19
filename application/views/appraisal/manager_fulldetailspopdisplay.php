<div class="card-body">
	<div class="row">
		<div class="col-md-12">
			<div class="profile-view">
				<div class="profile-img-wrap">
					<div class="profile-img">
						<a href="#"><img alt="" src="<?php echo base_url() . $empinfo[0]->mxemp_emp_img ?>"></a>
					</div>
				</div>
				<div class="profile-basic">
					<div class="row">
						<div class="col-md-3">
							<div class="profile-info-left">
								<h3 class="user-name m-t-0 mb-0">
									<a href="#">
									<?php echo $empinfo[0]->mxemp_emp_fname .' '. $empinfo[0]->mxemp_emp_lname ?>
								</a>
								</h3>
								<div class="staff-id"><a href="#">Employee ID : <?php echo $empinfo[0]->mxemp_emp_id ?></a></div>
								<div class="staff-id">Mobile : <?php echo $empinfo[0]->mxemp_emp_phone_no ?></div>
								<div class="staff-id">Alt Mobile : <?php echo $empinfo[0]->mxemp_emp_alt_phn_no ?></div>
								<div class="staff-id">Date of Join : <?php echo $empinfo[0]->mxemp_emp_date_of_join ?></div>
								<div class="staff-id">Gender : <?php echo $empinfo[0]->mxemp_emp_gender ?></div>
								<div class="staff-id">Age : <?php echo $empinfo[0]->mxemp_emp_age ?></div>
								<div class="staff-id">Salary : <?php echo $empinfo[0]->mxemp_emp_current_salary ?></div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="profile-info-left">
							<ul class="personal-info">
								<li>
									<div class="title">Company:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxcp_name ?></a></div>
								</li>
								<li>
									<div class="title">Division:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxd_name ?></a></div>
								</li>
								<li>
									<div class="title">State:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxst_state ?></a></div>
								</li>
								<li>
									<div class="title">Branch:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxb_name ?></a></div>
								</li>
								<li>
									<div class="title">Department:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxdpt_name ?></a></div>
								</li>
								<li>
									<div class="title">Grade:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxgrd_name ?></a></div>
								</li>
								<li>
									<div class="title">Service:</div>
									<?php
									$date1 = $empinfo[0]->mxemp_emp_date_of_join;
							        $date2 = date("Y-m-d");
							        $diff = abs(strtotime($date2) - strtotime($date1));
							        $years = floor($diff / (365*60*60*24));
							        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
									?>
									<div class="text"><a href="#"><?php printf("%d years, %d months, %d days\n", $years, $months, $days); ?></a></div>
								</li>
							</ul>
							</div>
						</div>
						<div class="col-md-4">
							<ul class="personal-info">
								<li>
									<div class="title">Monthly:</div>
									<div class="text"><a href="#"><?php echo 11000000 ?></a></div>
								</li>
								<li>
									<div class="title">Months:</div>
									<div class="text"><a href="#"><?php echo 8 ?></a></div>
								</li>
								<li>
									<div class="title">Accounts:</div>
									<div class="text"><a href="#"><?php echo 1 ?></a></div>
								</li>
<!-- 								<li>
									<div class="title">Branch:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxb_name ?></a></div>
								</li>
								<li>
									<div class="title">Department:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxdpt_name ?></a></div>
								</li>
								<li>
									<div class="title">Grade:</div>
									<div class="text"><a href="#"><?php echo $empinfo[0]->mxgrd_name ?></a></div>
								</li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="tab-box">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-solid">
									<?php 
							            $employees = $userdata['employeeid'];
							            // $quecategory = $userdata['quecategory'];
							            $department = $userdata['department'];
							            $year = $userdata['year'];
							            $months = $userdata['month'];
									?>
									<li class="nav-item"><a onclick="getkralist('<?php echo $employees ?>','<?php echo '1' ?>','<?php echo $department ?>','<?php echo $year ?>','<?php echo $months ?>')" href="#appr_technical" data-toggle="tab" class="nav-link active">KRA</a></li>
									<li class="nav-item"><a onclick="getkpalist('<?php echo $employees ?>','<?php echo '2' ?>','<?php echo $department ?>','<?php echo $year ?>','<?php echo $months ?>')" href="#appr_organizational" data-toggle="tab" class="nav-link">KEY COMPENTENCIES</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-content">
						<div id="appr_technical" class="pro-overview tab-pane fade show active">
							<div class="row">
								<div class="col-sm-12">
									<div class="bg-white" id="display_kra">

									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="appr_organizational">
							<div class="row">
								<div class="col-sm-12">
									<div class="bg-white" id="display_kpa">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- 	<div class="submit-section">
		<button class="btn btn-primary submit-btn">Submit</button>
	</div> -->
</form>
<script>
	function getkralist(empid,quecategory,department,year,months){
		var mainurl ='<?php echo base_url() ?>Performanceappraisal/getmgemployeekradata';
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: {employees : empid, quecategory : quecategory, department : department, year : year, month : months},
		    success: function (data) {
		        $('#display_kra').html(data);
	        		var table = $('#kra_datatable').removeAttr('width').DataTable({
	                    dom: 'Bfrtip',
	                    "destroy": true, //use for reinitialize datatable
	                    // lengthChange: false,
	                    buttons: [
	                        { extend: 'excelHtml5', footer: true }
	                    ],
	              //       scrollX: true,
	              //       scrollCollapse: true,
			            // columnDefs: [
			            //     { width: 200, targets: 2 },
			            //     { width: 200, targets: 3 },
			            //     { width: 200, targets: 5 },
			            //     { width: 600, targets: 10 },
			            //     { width: 600, targets: 11 },
			            //     { width: 600, targets: 12 },
			            // ],
			            // fixedColumns: true
	            });

		    },
		});
	}


function getkpalist(empid,quecategory,department,year,months){
		var mainurl ='<?php echo base_url() ?>Performanceappraisal/getmgemployeekpadata';
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: {employees : empid, quecategory : quecategory, department : department, year : year, month : months},
		    success: function (data) {
		        $('#display_kpa').html(data);
		        $("#display_kra").html();
	        		var table = $('#kpa_datatable').removeAttr('width').DataTable({
	                    dom: 'Bfrtip',
	                    // "destroy": true, //use for reinitialize datatable
	                    // // lengthChange: false,
	                    // buttons: [
	                    //     { extend: 'excelHtml5', footer: true }
	                    // ],
	                     buttons: [
							  { 
							    extend : 'excel',
							    exportOptions : {
							      format: {
							        body: function( data, row, col, node ) {
							        	console.log(col)
							          if (col == 3) {
							            return table
							              .cell( {row: row, column: col} )
							              .nodes()
							              .to$()
							              .find(':selected')
							              .text()
							           } else {
							              return data;
							           }
							        }
							      }
							    },
							    
							  }
							],
	                    // scrollX: true,
	                    // scrollCollapse: true,
			            // columnDefs: [
			            //     { width: 200, targets: 2 },
			            //     { width: 200, targets: 3 },
			            //     { width: 200, targets: 5 },
			            //     { width: 600, targets: 10 },
			            //     { width: 600, targets: 11 },
			            //     { width: 600, targets: 12 },
			            // ],
			            // fixedColumns: true
	            });
		    },
		});
	}
</script>
   