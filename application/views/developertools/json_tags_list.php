<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="employee_json_datatable">
		<thead>
			<tr>
				<th>Tag</th>
				<th>Tag Value</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sno = 1; foreach ($tags_list as $key => $grvalue) { ?>
			<tr>
				<td><?php echo $key ?></td>
				<td><?php echo $grvalue ?></td>
			</tr>
			<?php $sno++; } ?>
		</tbody>
	</table>
</div>