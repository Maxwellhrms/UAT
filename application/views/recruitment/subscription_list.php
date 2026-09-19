<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="employee_json_datatable">
		<thead>
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Current Location</th>
				<th>Preferred Location</th>
				<th>Current Company</th>
				<th>Created</th>
				<th>IP</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sno = 1; foreach ($sub_list as $key => $grvalue) { ?>
			<tr>
				<td><?php echo $grvalue->type ?></td>
				<td><?php echo $grvalue->name ?></td>
				<td><?php echo $grvalue->email ?></td>
				<td><?php echo $grvalue->mobile ?></td>
				<td><?php echo $grvalue->currentlocation ?></td>
				<td><?php echo $grvalue->preferredlocation ?></td>
				<td><?php echo $grvalue->currentcompany ?></td>
				<td><?php echo $grvalue->createddate ?></td>
				<td><?php echo $grvalue->ip ?></td>
				<td><a style="margin-right: 10px;" type="button" onclick="deleteemailtemplateinfobyid('<?php echo $grvalue->id ?>')" class="float-end btn btn-danger btn-sm"><i style="color:#fff;" class="fa fa-trash"></i></a></td>
			</tr>
			<?php $sno++; } ?>
		</tbody>
	</table>
</div>