<?php if(count($info[0])>0){ $final_fields = array_keys($info[0]);} ?>
<div class="modal-body">
	<div class="card tab-box">
		<div class="row user-tabs">
			<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
				<div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example">
						<thead>
							<tr>
                                <?php foreach($final_fields as $key) { ?>
							        	<th><?php echo str_replace('_', ' ' ,strtoupper($key) ) ?></th>
                                <?php } ?>
                            </tr>
						</thead>
                        <tbody>
                             <?php 
                            for($i=0; $i<sizeof($info);$i++) {  ?> 
                                <tr>
                                    <?php foreach($info[$i] as $key =>$val){ ?>
                                            <td><?php echo $val; ?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>  
                        </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>