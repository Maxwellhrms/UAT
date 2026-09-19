<?php
$headings = array_keys($report[0]);
$departmentreplace = array("mxemp_emp_dept_code","mxauth_dept_id","mxauth_auth_dept_id");
$designationreplace = array("mxemp_emp_desg_code");
$companyreplace = array("mxemp_emp_comp_code","mxemp_trs_comp_id_from","mxemp_trs_comp_id_to","mxauth_comp_id","mxauth_auth_comp_id");
$branchreplace = array("mxemp_emp_branch_code","mxemp_trs_branch_id_from","mxemp_trs_branch_id_to","mxauth_branch_id","mxauth_auth_branch_id");
$divisionreplace = array("mxemp_emp_division_code","mxemp_trs_div_id_from","mxemp_trs_div_id_to","mxauth_div_id","mxauth_auth_div_id");
$statesreplace = array("mxemp_emp_state_code","mxemp_trs_state_id_from","mxemp_trs_state_id_to","mxauth_state_id","mxauth_auth_state_id");
$gradesreplace = array("mxemp_emp_grade_code");
$employeetypemasterreplace = array("mxemp_emp_type");
$authtypereplace = array("mxauth_auth_type");
$statusreplace = array("mxauth_status");
?>

<!-- Data Tables -->
<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="dataTables-example">
		<thead>
			<tr>
				<?php foreach ($headings as $hkey => $hvalue) { ?>
			    <th><?php echo str_replace("mxemp_emp_", "", $hvalue); ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
			 $sno = 1; foreach ($report as $key => $value) { ?>
			<tr>
				<?php foreach($value as $keyvalue => $valout){ ?>
				<!-- <td><?php //echo $valout; ?></td> -->
				<td>
					<?php
					if(in_array($keyvalue, $departmentreplace)){
						if(array_key_exists($valout, $department)){
					  		echo $department[$valout];
					  	}
					}else if(in_array($keyvalue, $designationreplace)){
						if(array_key_exists($valout, $designation)){
					  		echo $designation[$valout];
					  	}
					}else if(in_array($keyvalue, $companyreplace)){
					  	if(array_key_exists($valout, $company)){
					  		echo $company[$valout];
					  	}
					}else if(in_array($keyvalue, $branchreplace)){
					  	if(array_key_exists($valout, $branch)){
					  		echo $branch[$valout];
					  	}
					}else if(in_array($keyvalue, $divisionreplace)){
					  	if(array_key_exists($valout, $division)){
					  		echo $division[$valout];
					  	}
					}else if(in_array($keyvalue, $statesreplace)){
					  	if(array_key_exists($valout, $states)){
					  		echo $states[$valout];
					  	}
					}else if(in_array($keyvalue, $gradesreplace)){
					  	if(array_key_exists($valout, $grades)){
					  		echo $grades[$valout];
					  	}
					}else if(in_array($keyvalue, $employeetypemasterreplace)){
					  	if(array_key_exists($valout, $employeetypemaster)){
					  		echo $employeetypemaster[$valout];
					  	}
					}else if(in_array($keyvalue, $authtypereplace)){
					  	if(array_key_exists($valout, $authtype)){
					  		echo $authtype[$valout];
					  	}
					}else if(in_array($keyvalue, $statusreplace)){
					  	if(array_key_exists($valout, $status)){
					  		echo $status[$valout];
					  	}
					}else{
					 echo $valout;
					}

					?></td>
				<?php } ?>
			</tr>
			<?php $sno++; } ?>
		</tbody>
	</table>
</div>
<!-- Data Tables -->