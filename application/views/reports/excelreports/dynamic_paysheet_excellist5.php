<?php
 //echo "<pre>------>";print_r($common);
    if(count($common)>0){ 
    
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
											
                                            
                                            <?php
											
                                            if(count($footer_column_names) > 0){
                                                echo "<tfoot>";
                                                echo "<tr>";
												$month_year=$userdata['month_year'];
                                                foreach($footer_column_names as $key => $value){
													//echo "<pre>";  echo $key."-->".$value;
													
													
													switch ($key) {
                case 0: $value = '1'; break;
                case 1: $value = $month_year; break;
                case 11: $value = '15-' . $month_year; break;
                case 12: $value = '<input type="date" name="paiddate" id="paiddate" />'; break;
                case 13: $value = '<input type="file" name="ecr_upload" id="ecr_upload" /><br><button type="button" id="upload_btn">Upload</button>'; break;
                case 14:
                    $file_path = '';
                    $result5 = $this->db->query("SELECT * FROM ecr_attachments WHERE attndyear = '$month_year'");
                    if ($result5->num_rows() > 0) {
                        $file_path = $result5->row()->file_path;
                        $value = "<a href='" . $file_path . "' target='_blank'>View File</a>";
                    } else {
                        $value = "No file uploaded";
                    }
                    break;
            }
			
													
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
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#upload_btn').on('click', function(e) {
        e.preventDefault();

        var file_data = $('#ecr_upload').prop('files')[0];
		var attndyear = $('#attndyear').val();
		var paiddate = $('#paiddate').val();
        var form_data = new FormData();
        form_data.append('ecr_upload', file_data);
		form_data.append('attndyear', attndyear);
		form_data.append('paiddate', paiddate);

        $.ajax({
            url: '<?= base_url("export/do_upload") ?>', // Update to your controller/method
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response); // Handle success
            },
            error: function(xhr, status, error) {
                alert("Upload failed: " + xhr.responseText);
            }
        });
    });
});
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables Core CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Buttons Extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!-- JSZip for Excel Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- Optional: pdfmake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

