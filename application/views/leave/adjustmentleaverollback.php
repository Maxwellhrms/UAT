		
			<!-- Page Wrapper -->
            <div class="page-wrapper">		
            	<!-- Page Content -->
                <div class="content container-fluid">	
					<h3>Rollback Leaves</h3>
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable" id="myTable">
									<thead>
										<tr>
											<th>Sno</th>
											<th>Employee</th>
											<th>Rollback Date</th>
											<th>First/second Half</th>
										    <th>Modify</th>
										</tr>
									</thead>
									<tbody>
									<?php $sno =1;
									//  echo '<pre>';
									 // print_r($adjrollback);
									foreach ($adjrollback as $abkey => $absdates) { ?>
										<tr id="table_<?php echo $sno ?>">
											<td><?php echo $sno; ?></td>
											<td>
												<h2 class="table-avatar">
													<a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-25.jpg"></a>
													<a><?php echo $absdates->mxemp_emp_fname.' '.$absdates->mxemp_emp_lname ?> <span><?php echo $absdates->mxdesg_name; ?></span><span><?php echo $absdates->mxemp_leave_adjust_emp_id ?></span></a>
												</h2>
											</td>
											<td><?php echo date('d-M-Y',strtotime($absdates->mxemp_leave_adjust_attendance_date)); ?></td>
											<td><?php if(!empty($absdates->mxemp_leave_adjust_first_half_short_name)){
												 echo 'First Half - <span style="color:red">'. $absdates->mxemp_leave_adjust_first_half_short_name .'</span>'; 
												} 
												 if(!empty($absdates->mxemp_leave_adjust_second_half_short_name)){ 
													 echo 'Second Half - <span style="color:red">'. $absdates->mxemp_leave_adjust_second_half_short_name .'</span>';  
													 } ?></td>
												<td> 
								<a type="button" onclick="rollbackdetails('<?php echo $absdates->mxemp_leave_adjust_id ?>','<?php echo $absdates->mxemp_leave_adjust_emp_id ?>','<?php echo $absdates->mxemp_leave_adjust_attendance_date ?>')" class="dropdown-item editleavedetails" ><i class="fa fa-pencil"></i> Rollback</a>
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
				</div>
			<!-- /Page Wrapper -->
<script type="text/javascript">
// --------  added chandana 16-06-2021 ----------------
  function rollbackdetails(adjstid,empcode,attedate){

var ck = confirm("Do You Want To RollBack the Current " + attedate + " " + empcode);
if(ck == true){
		mainurl = baseurl+'admin/leaveadjustrollback';
		$.ajax({
	        url: mainurl,
	        type: 'POST',
	        data: {date : attedate, empid : empcode, adjstid : adjstid },
	        success: function (data) {
				// console.log(data);
	        	if (data == 200) {
					alert('Success');
		            window.location.reload();
                } else if (data == 420) {
                    alert('Failed To Adjuest Leave Rollback Please Try  later');
                    return false;
                } 
	        },
    	});
}
			  }

// -------- end  added chandana 16-06-2021 ----------------

</script>			
				