	<div class="table-responsive">
        <table class="datatable table table-stripped mb-0" id="notes_datatable">
			<thead>
				<tr style="background:black;color:#fff">
					<th>id</th>
					<th>Category</th>
					<th>Employee Code</th>
					<th>Employee</th>
					<th>Date</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
				
					<?php $sno = 1; foreach ($notes as $key => $listview) { ?>
                <tr>
					<td><?php echo $sno; ?></td>
					<td><?php echo $getoptions[$listview->mxn_category]; ?></td>
					<td><?php echo $listview->mxn_emplyeeid ?></td>
					<td><?php echo $listview->mxemp_emp_fname.' '.$listview->mxemp_emp_lname ?></td>
					<td><?php echo $listview->mxn_createdtime ?></td>
					<td><?php echo $listview->mxn_desc ?></td>
				</tr>
					<?php $sno++; } ?>
			</tbody>
		</table>
	</div>