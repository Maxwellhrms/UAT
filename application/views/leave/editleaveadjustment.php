			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title"><?php echo $absentdays[0]->EmployeeName ?> Leaves</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active"><?php echo $absentdays[0]->EmployeeName ?> Total Leaves</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><?php echo date('Y M', strtotime(str_replace("_", "-", $this->input->get('ym')))); ?> / <?php 
								$mnth = date('m', strtotime(str_replace("_", "-", $this->input->get('ym'))));
								$mnth1 = date('M', strtotime(str_replace("_", "-", $this->input->get('ym'))));
								$year = date('Y', strtotime(str_replace("_", "-", $this->input->get('ym'))));
								echo cal_days_in_month(CAL_GREGORIAN,$mnth,$year); ?> days</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<!-- Leave Statistics -->
						<h3 align="center">Current Leaves</h3>
					<div class="row">
						<div class="col-md-2">
							<div class="stats-info">
								<h6>CL</h6>
								<h4><?php echo $currentleaves[0]->CurrentCL; ?></h4>
							</div>
						</div>
						+
						<div class="col-md-2">
							<div class="stats-info">
								<h6>SL</h6>
								<h4><?php echo $currentleaves[0]->CurrentSL; ?></h4>
							</div>
						</div>
						+
						<div class="col-md-2">
							<div class="stats-info">
								<h6>EL</h6>
								<h4><?php echo $currentleaves[0]->CurrentEL; ?></h4>
							</div>
						</div>
						+
						<div class="col-md-2">
							<div class="stats-info">
								<h6>OH</h6>
								<h4><?php echo $currentleaves[0]->CurrentOH; ?></h4>
							</div>
						</div>
						+
						<div class="col-md-2">
							<div class="stats-info">
								<h6>OCH</h6>
								<h4><?php echo $currentleaves[0]->CurrentOCH; ?></h4>
							</div>
						</div>
<!-- 						-
						<div class="col-md-2">
							<div class="stats-info">
								<h6>Used Leaves</h6>
								<h4>32</h4>
							</div>
						</div> -->
						=
						<div class="col-md-1">
							<div class="stats-info">
								<h6>Total</h6>
								<h4><?php echo ($currentleaves[0]->CurrentCL + $currentleaves[0]->CurrentSL + $currentleaves[0]->CurrentEL + $currentleaves[0]->CurrentOH + $currentleaves[0]->CurrentOCH) ?></h4>
							</div>
						</div>
					</div>
					<div class="row">
						
							<div class="col-auto float-right ml-auto">
							    <!--  ---- added 16-07-21 -------->
							    <button type="submit" onclick=leavehistroydetail('<?php echo $absentdays[0]->mx_attendance_emp_code ?>') class="btn btn-primary" data-toggle="modal" data-target="#addletype">Detail Leave History</button>
							    <!-- ----- end added 16-07-2021 -------->
								<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Attendance History</button>
							</div>
					</div>
					<br>
					<div id="demo" class="collapse">
					<div class="row">
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total Present</h6>
								<h4><?php echo ($currentleaves[0]->Present + $currentleaves[0]->First_Half_Present + $currentleaves[0]->Second_Half_Present + $currentleaves[0]->First_Half_Present_Cl_Applied + $currentleaves[0]->Second_Half_Present_Cl_Applied + $currentleaves[0]->First_Half_Present_Sl_Applied + $currentleaves[0]->Second_Half_Present_Sl_Applied + $currentleaves[0]->First_Half_Present_El_Applied + $currentleaves[0]->Second_Half_Present_El_Applied); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total Sundays</h6>
								<h4><?php echo $currentleaves[0]->Week_Off; ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Public/Optional Holidays</h6>
								<h4><?php echo ($currentleaves[0]->Public_Holiday + $currentleaves[0]->Optional_Holiday); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total Absent</h6>
								<h4><?php echo ($currentleaves[0]->Absent + $currentleaves[0]->First_Half_Absent + $currentleaves[0]->Second_Half_Absent); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total Cl Applied</h6>
								<h4><?php echo ($currentleaves[0]->Casualleave + $currentleaves[0]->First_Half_Casualleave + $currentleaves[0]->Second_Half_Casualleave); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total Sl Applied</h6>
								<h4><?php echo ($currentleaves[0]->Sickleave + $currentleaves[0]->First_Half_Sickleave + $currentleaves[0]->Second_Half_Sickleave); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
						<div class="col-md-3">
							<div class="stats-info">
								<h6>Total El Applied</h6>
								<h4><?php echo ($currentleaves[0]->Earnedleave + $currentleaves[0]->First_Half_Earnedleave + $currentleaves[0]->Second_Half_Earnedleave); ?> <span><?php echo $mnth1 ?> <?php echo $year ?></span></h4>
							</div>
						</div>
					</div>
				</div>
					<!-- /Leave Statistics -->
					<h3>Adjust Leaves</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable" id="myTable">
									<thead>
										<tr>
											<th>Sno</th>
											<th>Employee</th>
											<th>First Half</th>
											<th>second Half</th>
											<th>Absent Date</th>
											<th>Modify</th>
										</tr>
									</thead>
									<tbody>
										<?php $sno =1; foreach ($absentdays as $abkey => $absdates) { ?>
										<tr id="table_<?php echo $sno ?>">
											<td><?php echo $sno; ?></td>
											<td>
												<h2 class="table-avatar">
													<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-25.jpg"></a>
													<a><?php echo $absdates->EmployeeName ?> <span><?php echo $absdates->mxdesg_name ?></span><span><?php echo $absdates->mx_attendance_emp_code ?></span></a>
												</h2>
											</td>
											<td><?php echo $absdates->mx_attendance_first_half; ?></td>
											<td><?php echo $absdates->mx_attendance_second_half; ?></td>
											<td><?php echo date('d-M-Y',strtotime($absdates->mx_attendance_date)); ?></td>
											<td>
											    <?php //if(date('YMdHis',strtotime($absdates->mx_attendance_date)) < date('YMdHis')){ ?>
												<div class="dropdown dropdown-action">
                                                    <a onclick="getdetails('<?php echo $absdates->mx_attendance_date ?>','<?php echo $absdates->mx_attendance_emp_code ?>','<?php echo $absdates->mx_attendance_first_half ?>','<?php echo $absdates->mx_attendance_second_half ?>','<?php echo $absdates->mx_attendance_id ?>','<?php echo $this->input->get('ym'); ?>')" class="dropdown-item editleavedetails" href="#" data-toggle="modal" data-target="#editleavedetails" data-id=" .'~'.  .'~'.  .'~'.  .'~'. ; ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                </div>
                                                <?php //} ?>
											</td>

										</tr>

									<?php $sno++; } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
<script type="text/javascript">
	function getdetails(date,empcode,first,second,attndid,table){
	$("#placehtmldata").empty();
	mainurl = baseurl+'admin/getemployeedatewiseattnd';
		$.ajax({
	        url: mainurl,
	        type: 'POST',
	        data: {date : date, empid : empcode, uniqueid : attndid, firsthalf : first, secondhalf : second, tablename : table},
	        success: function (data) {
	        	$("#placehtmldata").html(data);
	        },
    	});
	}
</script>			
				
            </div>
			<!-- /Page Wrapper -->
<script>
// $(document).on("click", ".editleavedetails", function () {
    // $('#Firsthalf').prop('selectedIndex','');
    // $('#Secondhalf').prop('selectedIndex','');
// 	var getvalues = $(this).data('id');
// 	var x = getvalues.split("~",6);
// 	var date = x[0];
// 	var employeecode = x[1];
// 	var firsthalf = x[2];
// 	var secondhalf = x[3];
// 	// alert(firsthalf);
// 	// alert(secondhalf);
// 	var id = x[4];
// 	$(".modal-body #usercode").html(employeecode);
// 	$(".modal-body #editempdate").val(date);
// 	$(".modal-body #editempid").val(employeecode);
// 	$(".modal-body #editempmainid").val(id);


// 	$('#Firsthalf option').map(function () {
// 	if ($(this).text() == firsthalf) return this;
// 	}).attr('selected', 'selected');

// 	$('#Secondhalf option').map(function () {
// 	if ($(this).text() == secondhalf) return this;
// 	}).attr('selected', 'selected'); 

// });
</script>
<!-- EDit Modal -->
<div class="modal custom-modal fade" id="editleavedetails" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-header">
					<h3>Leave Adjustment</h3>
					<h3 style="color: red" id="username"><?php echo $absentdays[0]->EmployeeName ?></h3>
					<p id="usercode"></p>
				</div>

				<div id="placehtmldata"></div>

			</div>
		</div>
	</div>
</div>
<!-- EDit Modal -->

<!-- ------------ added 16-07-21 popup model for deatail leave history  ---------------------->


   <div class="modal custom-modal fade" id="addletype" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
			    <div id="leavedethist"> </div> 
            </div>
        </div>
	</div>


<!--  ------------- end added 16-07-2021 ------------->


<script type="text/javascript">
	function processemployeeadjustment(){
		var empattid = $("#editempmainid").val();
		var editempdate = $("#editempdate").val();
		var empcode = $("#editempid").val();
		var firsthalf = $("#Firsthalf").val();
		var firsthalfdisabled = $('#Firsthalf').is('[disabled]')
		var secondhalf = $("#Secondhalf").val();
		var secondhalfdisabled = $('#Secondhalf').is('[disabled]')
		if(firsthalfdisabled == true){
			firsthalf = '';
		}
		if(secondhalfdisabled == true){
			secondhalf = '';
		}
        if( (firsthalf == 'CL' && secondhalf == 'EL') || (firsthalf == 'EL' && secondhalf == 'CL') ){
            alert("Please check CL and EL combination will not work");
            return false;
        }else if( (firsthalf == 'SL' && secondhalf == 'EL') || (firsthalf == 'EL' && secondhalf == 'SL') ){
            alert("Please check SL and EL combination will not work");
            return false;
        }else if( (firsthalf == 'CL' && secondhalf == 'SL') || (firsthalf == 'SL' && secondhalf == 'CL') ){
            alert("Please check CL and SL combination will not work");
            return false;
        }


		$.ajax({
		    async: false,
		    type: "POST",
		    data: {id : empattid, attdate : editempdate, employeecode : empcode, firhalf : firsthalf, sechalf : secondhalf},
		    url: baseurl + 'admin/updateempleaveadjustment',
		    datatype: "html",
		      success: function (data) {
		          if (data == 200) {
		            alert('Success');
		            window.location.reload();
		          }else if(data == 400) {
		            alert('Try Again Later');
		          }else{
		      		$("#returnerror").html(data);
		          }
		    }
		});
	}

    function leavehistroydetail(empid){
    	$.ajax({
		    type: "POST",
		    data: {empid : empid },
		    url: baseurl + 'admin/leavehistroydetail',
		    datatype: "html",
		      success: function (data) {
				  $('#leavedethist').html(data);
		    }
		});
   }

    function leavedethist(empid,leavetypeid){
			var mainurl = baseurl + 'admin/leavetypehistorydet';
			$.ajax({
				url: mainurl,
				type: 'POST',
				data: { 'empid':empid,'leavetypeid':leavetypeid},
				success: function (data) {
					$('#dtbl').html(data);
					var table = $('#dataTables-example').DataTable({
                        dom: 'Bfrtip',
                        "destroy": true, //use for reinitialize datatable
                        lengthChange: false,
                        buttons: [
                            // { extend: 'copyHtml5', footer: true },
                            { extend: 'excelHtml5', footer: true },
                            { extend: 'csvHtml5', footer: true },
                            { extend: 'pdfHtml5', footer: true }
                        ],
                    });
				},
			});
		}
	</script>
























