<tr class="details-row">

<td colspan="12">

<table class="table table-bordered table-sm childTable" id="__TABLE_ID__">

<thead>

<tr>

<th>Question</th>

<th>Target</th>

<th>Employee</th>

<th>Manager</th>

<th>HOD</th>

<th>HR</th>

<th>Reviewer</th>

</tr>

</thead>

<tbody>

<?php foreach($questions as $row){ ?>

<tr>

<td>

<?php echo $row['mxap_question'];?>

</td>

<td>

<?php echo $row['mxap_assign_monthlytarget'];?>

</td>

<td>

<?php echo $row['mxap_assign_emp_achievement'];?>

<br>

<span class="badge bg-<?php echo $row['mxap_assign_emp_status']=='COMPLETED'?'success':'warning';?>">

<?php echo $row['mxap_assign_emp_status'];?>

</span>

</td>

<td>

<?php echo $row['mxap_assign_manager_actual_assesment'];?>

<br>

<span class="badge bg-<?php echo $row['mxap_assign_manager_status']=='COMPLETED'?'success':'warning';?>">

<?php echo $row['mxap_assign_manager_status'];?>

</span>

</td>

<td>

<?php echo $row['mxap_assign_hod_actual_assesment'];?>

<br>

<span class="badge bg-<?php echo $row['mxap_assign_hod_status']=='COMPLETED'?'success':'warning';?>">

<?php echo $row['mxap_assign_hod_status'];?>

</span>

</td>

<td>

<?php echo $row['mxap_assign_hr_actual_assesment'];?>

<br>

<span class="badge bg-<?php echo $row['mxap_assign_hr_status']=='COMPLETED'?'success':'warning';?>">

<?php echo $row['mxap_assign_hr_status'];?>

</span>

</td>

<td>

<?php echo $row['mxap_assign_reviewer_actual_assesment'];?>

<br>

<span class="badge bg-<?php echo $row['mxap_assign_reviewer_status']=='COMPLETED'?'success':'warning';?>">

<?php echo $row['mxap_assign_reviewer_status'];?>

</span>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</td>

</tr>