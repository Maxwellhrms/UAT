	<div class="row">
		<div class="col-md-12">
			
			<div class="card mb-0">
				<div class="card-body">
					<div class="container">
						  <div class="card" style="width:400px">
						    <img class="card-img-top" src="<?php echo base_url() . $respdata['Employee_Details'][0]->employee_image ?>" alt="Employee Image" style="width:100%">
						    <div class="card-body">
						      <h4 class="card-title"><?php echo $respdata['Employee_Details'][0]->employee_firstname.' '.$respdata['Employee_Details'][0]->employee_lastname ?></h4>
						      <p class="card-text">Phone : <?php echo $respdata['Employee_Details'][0]->employee_phone_no ?> 
						      <br> Email : <?php echo $respdata['Employee_Details'][0]->employee_emailid ?>
						      <br> Status : <?php echo $respdata['Employee_Details'][0]->employee_resignationstatus ?>
						      <?php if($respdata['Employee_Details'][0]->employee_resignationstatus != 'W'){ ?>
						      	<br> Resignation : <?php echo $respdata['Employee_Details'][0]->employee_resignation_date ?>
						      	<br> Relieving : <?php echo $respdata['Employee_Details'][0]->employee_relieving_date ?>
						      <?php } ?>
						    </p>
						      <a href="<?php echo base_url() ?>admin/employeesprofile/<?php echo $respdata['Employee_Details'][0]->autouniqueid ?>" class="btn btn-primary stretched-link">See Profile</a>
						    </div>
						  </div>
					</div>
				</div>
			</div>

		</div>
	</div>
		
<!-- Data Tables -->

<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Info</h4>
			</div>
			<?php //echo '<pre>'; echo print_r($respdata); ?>
<br>
<div class="container-fluid">
  <div id="accordion">
	<!-- Employee info -->
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#employeeinfo">
          <?php echo $respdata['Employee_Details'][0]->employee_firstname.' '.$respdata['Employee_Details'][0]->employee_lastname ?>
        </a>
      </div>
      <div id="employeeinfo" class="collapse" data-parent="#accordion">
        <div class="card-body">
        	<table class="table table-hover">
        	    <tbody>
					      <tr class="table-primary">
					        <td>Company</td>
					        <td>Division</td>
					        <td>State</td>
					        <td>Branch</td>
					        <td>Department</td>
					        <td>Designation</td>
					        <td>Grade</td>
					      </tr>
					      <tr class="table-success">
					        <td><?php echo $respdata['Employee_Details'][0]->companyname;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->divisionname;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->statename;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->branchname;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->departmentname;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->designationname;?></td>
					        <td><?php echo $respdata['Employee_Details'][0]->gradename;?></td>
					      </tr>
					    </tbody>
					  </table>
        </div>
      </div>
    </div>
	<!-- Employee info -->
	<!-- Leaves -->
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#leaves">
        Leaves
      </a>
      </div>
      <div id="leaves" class="collapse" data-parent="#accordion">
        <div class="card-body">
        	<table class="table table-hover">
        	    <tbody>
					      <tr class="table-primary">
					        <td>Company</td>
					        <td>Division</td>
					        <td>State</td>
					        <td>Branch</td>
					        <td>Department</td>
					        <td>Designation</td>
					        <td>Grade</td>
					      </tr>
					      <?php foreach ($respdata['Employee_Leaves'] as $key => $leaves) { ?>
					      <tr class="table-success">
					        <td><?php echo $leaves->mxcp_name;?></td>
					        <td><?php echo $leaves->mxd_name; ?></td>
					        <td><?php echo $leaves->mxst_state; ?></td>
					        <td><?php echo $leaves->mxb_name; ?></td>
					        <td><?php echo $leaves->mxdpt_name; ?></td>
					        <td><?php echo $leaves->mxdesg_name; ?></td>
					        <td><?php echo $leaves->mxgrd_name; ?></td>
					      </tr>
					      <?php } ?>
					      <tr class="table-primary">
					        <td>Leave Type</td>
					        <td>Leaves Current</td>
					      </tr>
					      <?php foreach ($respdata['Employee_Leaves'] as $key1 => $leavestype) { ?>
					      <tr class="table-success">
					        <td><?php echo $leavestype->mxemp_leave_bal_leave_type_name .' - '. $leavestype->mxemp_leave_bal_leave_type_shrt_name;?></td>
					        <td><?php echo $leavestype->mxemp_leave_bal_crnt_bal; ?></td>
					      </tr>
					      <?php } ?>
					    </tbody>
					  </table>
        </div>
      </div>
    </div>
	<!-- Leaves -->
	<!-- Attendance -->
	<?php //echo '<pre>';print_r($respdata['Employee_Attendance']); ?>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#attendance">
          Attendance
        </a>
      </div>
      <div id="attendance" class="collapse" data-parent="#accordion">
        <div class="card-body">
        	<table class="table table-hover">
        	    <tbody>
					      <tr class="table-primary">
					        <td>Company</td>
					        <td>Division</td>
					        <td>State</td>
					        <td>Branch</td>
					        <td>Month days</td>
									<td>Attendance Created days</td>
					      </tr>
					      <?php foreach ($respdata['Employee_Attendance'] as $atkey => $atvalue) { 			      	
					      	foreach ($atvalue as $keyats => $valats) { ?>
					      <tr class="table-success">
					        <td><?php echo $valats->companyname .' - id='. $valats->mx_attendance_cmp_id;?></td>
					        <td><?php echo $valats->divisionname .' - id='. $valats->mx_attendance_division_id;?></td>
					        <td><?php echo $valats->statename .' - id='. $valats->mx_attendance_state_id;?></td>
					        <td><?php echo $valats->branchname .' - id='. $valats->mx_attendance_branch_id;?></td>
					        <td><?php echo $valats->actualsdays;?></td>
					        <td><?php echo $valats->days;?></td>
					      </tr>
					      <?php } }?>
					    </tbody>
					  </table>
        </div>
      </div>
	    </div>
	<!-- Attendance -->
	<!-- Employee Auth -->
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#employeeauth">
          Authorization
        </a>
      </div>
      <div id="employeeauth" class="collapse" data-parent="#accordion">
        <div class="card-body">
        <div class="table-responsive">
        	<table class="table table-hover">
        	    <tbody>
					      <tr class="table-primary">
					      	<td>Employeeid</td>
					        <td>Company</td>
					        <td>Division</td>
					        <td>State</td>
					        <td>Branch</td>
					        <td>Department</td>
					        <td>Auth Category</td>
					      	<td>Auth Employeeid</td>
					        <td>Auth Company</td>
					        <td>Auth Division</td>
					        <td>Auth State</td>
					        <td>Auth Branch</td>
					        <td>Auth Department</td>
					        <td>Status</td>
					      </tr>
					      <?php foreach ($respdata['Employee_Authorsations'] as $authskey => $authvalue) { ?>
					      <tr class="table-success">
					      	<td><?php echo $authvalue->mxauth_emp_code;?></td>
					        <td><?php echo $authvalue->companyname;?></td>
					        <td><?php echo $authvalue->divisionname;?></td>
					        <td><?php echo $authvalue->statename;?></td>
					        <td><?php echo $authvalue->branchname;?></td>
					        <td><?php echo $authvalue->departmentname;?></td>

									<td><?php if($authvalue->mxauth_auth_type == '1'){ echo 'Branch';}elseif($authvalue->mxauth_auth_type == '2'){ echo'Head Office';}elseif($authvalue->mxauth_auth_type == '3'){ echo 'HR';}elseif($authvalue->mxauth_auth_type == '4'){ echo 'Director';}?></td>
					      	<td><?php echo $authvalue->mxauth_reporting_head_emp_code;?> <?php echo $authvalue->authfname .' '. $authvalue->authlanme ?></td>
					        <td><?php echo $authvalue->authcompanyname;?></td>
					        <td><?php echo $authvalue->authdivisionname;?></td>
					        <td><?php echo $authvalue->authstatename;?></td>
					        <td><?php echo $authvalue->authbranchname;?></td>
					        <td><?php echo $authvalue->authdepartmentname;?></td>
					        <td><?php if($authvalue->mxauth_status == 1){ echo 'Active'; }else{ echo 'InActive';}?></td>
					      </tr>
					      <?php } ?>
					    </tbody>
					  </table>
                </div>
        </div>
      </div>
    </div>
	<!-- Employee Auth -->
		<!-- Employee Login -->
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#employeelogin">
          Login
        </a>
      </div>
      <div id="employeelogin" class="collapse" data-parent="#accordion">
        <div class="card-body">
        	<table class="table table-hover">
        	    <tbody>
					      <tr class="table-primary">
					        <td>Login Id</td>
					        <td>Name</td>
					        <td>Password</td>
					        <td>Mobile Role</td>
					        <td>Mobile Permission</td>
					        <td>Hr Role</td>
					        <td>Hr Permission</td>
					      </tr>
									<?php
									$hrroles = array();
										foreach ($alluserroles as $key => $value) {
											$hrroles[$value->maxuser_roles_id] = $value->maxuser_roles_name;
										}
										$hrroles["0"] = "N/A";

										$mbroles = array();
											foreach ($mobilealluserroles as $mbkey => $mbvalue) {
												$mbroles[$mbvalue->maxuser_roles_id] = $mbvalue->maxuser_roles_name;
											}
											$mbroles["0"] = "N/A";

											$status = array("" =>"N/A", "1" => "ACTIVE", "0" => "INACTIVE");
										 ?>
					      <tr class="table-success">
					        <td><?php echo $respdata['Employee_Login'][0]->loginid;?></td>
					        <td><?php echo $respdata['Employee_Login'][0]->name;?></td>
					        <td><?php echo $respdata['Employee_Login'][0]->password;?></td>
					        <td>
					        	<?php if(array_key_exists($respdata['Employee_Login'][0]->mobilerole, $mbroles)){
										echo $mbroles[$respdata['Employee_Login'][0]->mobilerole];
									} ?>
					        </td>
					        <td>
					        	<?php if(array_key_exists($respdata['Employee_Login'][0]->mobilepermissions, $status)){
										echo $status[$respdata['Employee_Login'][0]->mobilepermissions];
										}?>	
					        </td>
					        <td>
					        	<?php
									if(array_key_exists($respdata['Employee_Login'][0]->hradminrole, $hrroles)){
										echo $hrroles[$respdata['Employee_Login'][0]->hradminrole];
									} ?>
					        </td>
					        <td>
					        	<?php if(array_key_exists($respdata['Employee_Login'][0]->hrpermissions, $status)){
										echo $status[$respdata['Employee_Login'][0]->hrpermissions];
										}?>	
					        </td>
					      </tr>
					    </tbody>
					  </table>
        </div>
      </div>
    </div>
	<!-- Employee Login -->
  </div>
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
	function getmenuslist(){
  var menutype = $("#menutype").val();
  if(menutype ==""){
    $("#menutype").focus();
    $('#menutypeerror').html("Please Select Menu Type");
    return false;
  }else{$('#menutypeerror').html("");} 

    $.ajax({
        url: baseurl+'developertools/getmenuslist',
        type: 'POST',
        data: {menutype : menutype,submenu : 'No'},
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

$(document).on("click", ".editmodal", function () {
	var editdetails = $(this).data('id');
	var x = editdetails.split("~",6);
	var menutype = x[0];
	var uniqueid = x[1];
	var menuname = x[2];
	var menuicon = x[3];
	var menuorder = x[4];
	var menustatus = x[5];

	$(".modal-body #editmenuuniqueid").val(uniqueid);
	$(".modal-body #editmenutype").val(menutype);
	$(".modal-body #editmenuicon").val(menuicon);
	$(".modal-body #editmenuname").val(menuname);
	$(".modal-body #editmenuorder").val(menuorder);
	$(".modal-body #editmenustatus").val(menustatus);
	
});

</script>