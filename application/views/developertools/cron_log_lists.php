<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="dataTables-example">
		<thead>
			<tr>
				<th>Employee Id</th>
				<th>Cron Type</th>
				<th>Cron Run Date</th>
				<th>Cron Description</th>
				<th>Cron Query</th>
				<th>Cron Status</th>
				<th>Cron Created By</th>
				<th>Cron Created Date</th>
				<th>Cron Ip</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sno = 1; foreach ($displaymenulist as $key => $grvalue) { ?>
			<tr>
				<td><?php echo $grvalue->mx_empcode; ?></td>
				<td><?php echo $grvalue->mx_cron; ?></td>
				<td><?php echo $grvalue->mx_run_date; ?></td>
				<td><?php echo $grvalue->mx_desc; ?></td>
				<td><?php echo $grvalue->mx_query; ?></td>
				<td><?php echo $grvalue->mx_status; ?></td>
                <td><?php echo $grvalue->mx_createdby; ?></td>
                <td><?php echo $grvalue->mx_createdtime; ?></td>
                <td><?php echo $grvalue->mx_created_ip; ?></td>
			</tr>
			<?php $sno++; } ?>
		</tbody>
	</table>
</div>