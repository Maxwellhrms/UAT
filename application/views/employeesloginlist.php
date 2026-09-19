<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Employee Login Deatils</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Employee Login List</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<br>
	<?php
	$roles = array();
		foreach ($alluserroles as $key => $value) {
			$roles[$value->maxuser_roles_id] = $value->maxuser_roles_name;
		}
		$roles["0"] = "N/A";
	 ?>
<!-- Data Tables -->
	<div class="row" style="margin-top: 10px;">
		<div class="col-sm-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Login List</h4>
				</div>
				<div class="card-body">	

					<div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
							<thead>
								<tr>
								    <th>Sno</th>
									<th>Employee Code</th>
									<th>Name</th>
									<th>Role</th>
									<th>Login Permission Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$status = array("" =>"N/A", "1" => "ACTIVE", "0" => "INACTIVE");
								 $sno = 1; foreach ($info as $key => $value) { 	
									?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php echo $value->mxemp_emp_lg_employee_id ?></td>
									<td><?php echo $value->mxemp_emp_lg_fullname ?></td>
									<td><?php
									if(array_key_exists($value->mxemp_emp_lg_role, $roles)){
										echo $roles[$value->mxemp_emp_lg_role];
									}
									  ?></td>
									<td>
									<?php if(array_key_exists($value->mxemp_emp_lg_desktop_permissions, $status)){
										echo $status[$value->mxemp_emp_lg_desktop_permissions];
									}?>	
									</td>
								</tr>
								<?php $sno++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Data Tables -->

</div>
</div>
<!-- /Page Wrapper