<?php  
    if(count($common[0])>0){
    $final_fields = array_keys($common[0]); ?>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <div class="card mb-0">					
                                <div class="card-header">
									<h4 class="card-title mb-0">Preview List</h4>
								</div>
                                <div class="card-body">	
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example1">
											<thead>
												<tr>
                                                    <?php foreach($final_fields as $key) { ?>
												        	<th><?php echo str_replace('_', ' ' ,strtoupper($key) ) ?></th>
                                                    <?php } ?>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php 
                                                for($i=0; $i<sizeof($common);$i++) {  ?> 
                                                    <tr>
                                                        <?php foreach($common[$i] as $key =>$val){ ?>
                                                                <td><?php 
                                                                    if($key == 'first_punch' && strpos($val,",")){
                                                                        $finfo = explode(',',$val);
                                                                        foreach($finfo as $firstpunch){
                                                                            echo date('h:i:s a ', strtotime($firstpunch)).'<br>';
                                                                            
                                                                        }
                                                                    }elseif($key == 'second_punch' && strpos($val,",")){
                                                                        $linfo = explode(',',$val);
                                                                        foreach($linfo as $lastpunch){
                                                                            echo date('h:i:s a ', strtotime($lastpunch)) .'<br>';
                                                                        }
                                                                    }elseif($key == 'entry_type' && strpos($val,",")){
                                                                        $etype = explode(',',$val);
                                                                        foreach($etype as $typeofpunch){
                                                                            echo $typeofpunch .'<br>';
                                                                        }
                                                                    }elseif($key == 'latitude' && strpos($val,",")){
                                                                        $latitude = explode(',',$val);
                                                                        foreach($latitude as $typeofpunch){
                                                                            echo $typeofpunch .'<br>';
                                                                        }
                                                                    }elseif($key == 'longitude' && strpos($val,",")){
                                                                        $longitude = explode(',',$val);
                                                                        foreach($longitude as $typeofpunch){
                                                                            echo $typeofpunch .'<br>';
                                                                        }
                                                                    }elseif($key == $function_column && $function_popup = 'Y'){
                                                                        $etd = explode('[#-#]',$val);
                                                                        if(count($etd)>0){$display_value = $etd[0];}else{$display_value = $val;}
                                                                        echo "<a style='text-decoration:underline; color:blue;' onclick=".$function_name."('$val')  data-toggle='modal' data-target='#popup_type'>".$display_value."</a>";
                                                                    }else{
                                                                        echo $val;
                                                                    }
                                                                ?>
                                                                </td>
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
 <?php }else{
     echo 'No Data Exist'; exit;
 } ?>
<style>
.modal-dialog.modal-dialog-centered.modal-lg {
    max-width: 75%;
}
</style>
<div class="modal custom-modal fade" id="popup_type" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
		    <div id="popup_details"> </div> 
        </div>
    </div>
</div>
<script>
        function getpopupinfo(empid){
    	$.ajax({
		    type: "POST",
		    data: {empid : empid },
		    url: baseurl + 'export/getpopupinfo',
		    datatype: "html",
		      success: function (data) {
				  $('#popup_details').html(data);
				  	var table = $('#dataTables-example').DataTable({
                        dom: 'Bfrtip',
                        "destroy": true, //use for reinitialize datatable
                        lengthChange: false,
                        buttons: [
                            // { extend: 'copyHtml5', footer: true },
                            { extend: 'excelHtml5', footer: true },
                            { extend: 'csvHtml5', footer: true },
                            { extend: 'pdfHtml5', footer: true }
                        ],
                    });
		    }
		});
   }
</script>