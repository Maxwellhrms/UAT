			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Contact Main Row -->
				<div class="chat-main-row">
				
					<!-- Contact Wrapper -->
					<div class="chat-main-wrapper">
						<div class="col-lg-12 message-view">
							<div class="chat-window">
								<div class="fixed-header">
									<div class="row">
										<div class="col-6">
											<h4 class="page-title mb-0">List View</h4>
										</div>
									</div>
								</div>
								<div class="chat-contents">
									<div class="chat-content-wrap">
										<div class="chat-wrap-inner">
											<div class="contact-box">
											<div class="row">
												<div class="contact-cat col-sm-4 col-lg-3">
													<a class="btn btn-primary btn-block" style="color: #fff;">Tables</a>
													<div class="roles-menu">
														<ul>
															<?php foreach ($tables as $key => $value) { ?>
															<li class="<?php echo $value->tablenames ?>"><a onclick="filter('<?php echo $value->tablenames ?>')"><?php echo strtoupper(str_replace("maxwell_self_", "", $value->tablenames)); ?></a></li>
															<?php } ?>
														</ul>
													</div>
												</div>
												<div class="contacts-list col-sm-8 col-lg-9">
													<div id="display"></div>
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Contact Wrapper -->
					
				</div>
				<!-- /Contact Main Row -->
				
			</div>
			<!-- /Page Wrapper -->
<script>
	function filter(tb){
		mainurl = baseurl+'import/filterlist';
		$.ajax({
	        url: mainurl,
	        type: 'POST',
	        data: {tablename : tb},
	        success: function (data) {
	        	$("#display").html(data);
	        	var table = $('#dataTables-example').DataTable({
                dom: 'Bfrtip',
                "destroy": true, //use for reinitialize datatable
                lengthChange: false,
                buttons: [
                    'excel','csv'
                ]
            });
	        },
	    });
	}
</script>