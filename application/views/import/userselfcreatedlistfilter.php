<?php
$value = array_values($tables);
?>
<!-- Data Tables -->
<div class="row">
<div class="col-sm-12">
<div class="card mb-0">
<div class="card-body">	

<div class="table-responsive">
<table class="datatable table table-stripped mb-0" id="dataTables-example">
		<thead>
			<tr>
				<?php foreach ($columns as $key => $val) { ?>
				<th><?php echo $val['COLUMN_NAME']; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($value as $ckey => $va) { ?>
			<tr>
				<?php $x = 1; foreach($va as $d){ ?>
				<td><?php
					if($x == 2){
						echo 'button';
						$x = 0;	
					}else{
						echo $d;
					}
				  ?></td>
				<?php $x++;} ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>
</div>
</div>
<!-- Data Tables -->