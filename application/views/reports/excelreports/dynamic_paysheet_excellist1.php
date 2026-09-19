<?php
// print_r($common);exit;
    if(count($common[0])>0){ 
    
    ?>
    
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <div class="card mb-0">					
                                <div class="card-header">
									<h4 class="card-title mb-0">Preview List</h4>
								</div>
                                <div class="card-body">	
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example2">
											<thead>
												<tr>
                                                    <?php for($i=0; $i < count($headings); $i++) { ?>
												        	<th><?php echo str_replace('_', ' ' ,strtoupper($headings[$i]) ) ?></th>
                                                    <?php } ?>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php 
                                                for($i=0; $i<sizeof($common);$i++) { ?> 
                                                    <tr>
                                                        <?php 
                                                        // print_r($common[$i]);exit;
                                                        foreach($common[$i] as $key =>$val){ 
                                                            // echo $val;exit;
                                                        ?>
                                                                <td><?php 
                                                                    echo $val;
                                                                ?>
                                                                </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>   
                                            </tbody>
                                            <?php
                                            if(count($footer_column_names) > 0){
                                                echo "<tfoot>";
                                                echo "<tr>";
                                                foreach($footer_column_names as $key => $value){
                                                    echo "<th>$value</th>";
                                                    
                                                }
                                                echo "</tr>";
                                                echo "</tfoot>";    
                                            }
                                            ?>
                                            
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
 <?php }else{
     echo 'No Data Exist'; exit;
 } ?>
