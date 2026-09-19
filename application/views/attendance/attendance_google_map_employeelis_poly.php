<table class="datatable table table-stripped mb-0"  id="dataTables-example">
<thead>
	<tr>
		<th>#</th>
		<th>Attendance Date</th>
		<th>Employee Code</th>
		<th>Employee Name</th>
		<th>Company</th>
		<th>Division</th>
		<th>State</th>
		<th>Branch</th>
	</tr>
</thead>
<tbody>
    <?php $sno = 1; foreach($list as $key => $val){ ?>
	<tr>
	    <td><?php echo $sno; ?></td>
	    <td><a target="_blank" href="<?php echo base_url().'attendance_controller/googlepinpoints_poly?employeeid='.$val->mxemp_emp_id.'&date='.$userdata['attendance'] ?>"><?php echo $userdata['attendance']; ?></a></td>
	    <td><?php echo $val->mxemp_emp_id; ?></td>
	    <td><?php echo $val->mxemp_emp_fname .' '. $val->mxemp_emp_lname; ?></td>
	    <td><?php echo $val->mxcp_name; ?></td>
	    <td><?php echo $val->mxd_name; ?></td>
	    <td><?php echo $val->mxst_state; ?></td>
	    <td><?php echo $val->mxb_name; ?></td>
	</tr>
	<?php $sno++; } ?>
</tbody>
</table>