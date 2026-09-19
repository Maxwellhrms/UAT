</div>
<!-- /Main Wrapper -->

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<!-- Slimscroll JS -->
<script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<!-- <script src="assets/js/select2.min.js"></script> -->

<!-- Datetimepicker JS -->
<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo base_url() ?>assets/js/app.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/datatable/buttons.colVis.min.js"></script>
<!-------------NEW BY SHABABU FOR COMMON FUNCTIONS (09-10-2021)-------->
<script src="<?php echo base_url() ?>assets/js/formsjs/common.js"></script>
<!-------------NEW BY SHABABU FOR COMMON FUNCTIONS (09-10-2021)-------->

<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
	    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script> -->
<script>
	$(document).ready(function() {
	    
		// customdatatables currently using for admin notification only
		if($('#custom_dataTables').length > 0){
		    var table_custom = $('#custom_dataTables').removeAttr('width').DataTable({
    			//lengthChange: false,
    			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    			// buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
    			buttons: ['excel'],
     			//scrollY:        "300px",
                 scrollX:        true,
                 scrollCollapse: true,
    //             paging:         false,
                columnDefs: [
                    { width: 150, targets: 0 },
                    { width: 150, targets: 1 },
                    { width: 110, targets: 2 },
                    { width: 110, targets: 3 },
                    { width: 110, targets: 4 },
                    { width: 300, targets: 5 },
                    { width: 60, targets: 6 },
                    { width: 60, targets: 7 },
                    { width: 60, targets: 8 },
                    { width: 120, targets: 9 },
                    { width: 120, targets: 10 },
                    { width: 400, targets: 11 },
                    { width: 20, targets: 12 },
                    { width: 20, targets: 13 },
                ],
                fixedColumns: true
    		});
    		table_custom.buttons().container()
    			.appendTo('#custom_dataTables_wrapper .col-sm-6:eq(0)');
		}
		// customdatatables currently using for admin notification only    

        if($('#dataTables-example').length > 0){
    		var table = $('#dataTables-example').DataTable({
    			//lengthChange: false,
    			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    			 //  dom: 'Bfrtip',
    			// buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
    		    //	 buttons: ['csv','pdf', $.extend(true, {}, buttonCommon, { extend: 'excel' }), 
    			buttons: ['excel','csv','pdf']
    		});
    
    		table.buttons().container()
    			.appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)');
        }
			
		//----NEW BY SHABABU(25-06-2022)
        if($('.table.dataTables-example').length > 0){
        	var sno = 0;
    		$('.table.dataTables-example').each(function(){
    		    var table_multi = $(this).DataTable({
        			//lengthChange: false,
        			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        			 //  dom: 'Bfrtip',
        			//buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
        		    //	 buttons: ['csv','pdf', $.extend(true, {}, buttonCommon, { extend: 'excel' }), 
        			buttons: ['excel','csv']
        		});
        		table_multi.buttons().container()
    			    .appendTo('#DataTables_Table_'+sno+'_wrapper .col-sm-6:eq(0)');
        		sno++;
    		});
        }




// 		var table = $('table.dataTables-example').DataTable({
// 			//lengthChange: false,
// 			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
// 			 //  dom: 'Bfrtip',
// 			buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
// 		    //	 buttons: ['csv','pdf', $.extend(true, {}, buttonCommon, { extend: 'excel' }), 
// // 			buttons: ['excel','csv','pdf']
// 		});

// 		table.buttons().container()
// 			.appendTo('#dataTables-example_wrapper .col-sm-6:eq(0)');
		//----END NEW BY SHABABU(25-06-2022)

        //------DATATABLE FOR MULTIPLE TABLES
        if($('.common_dataTables').length > 0){
    		var table0 = $('.common_dataTables').DataTable({
    			//lengthChange: false,
    			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    			 //  dom: 'Bfrtip',
    			// buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
    		    //	 buttons: ['csv','pdf', $.extend(true, {}, buttonCommon, { extend: 'excel' }), 
    			buttons: ['excel','csv','pdf']
    		});
        }
        //------DATATABLE FOR MULTIPLE TABLES
		
		
		if($('#viewrecruitmentdetails').length > 0){
    	    var table1 = $('#viewrecruitmentdetails').removeAttr('width').DataTable({
			//lengthChange: false,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			// buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
			buttons: ['excel'],
 			//scrollY:        "300px",
             scrollX:        true,
             scrollCollapse: true,
//             paging:         false,
            columnDefs: [
                { width: 200, targets: 2 },
                { width: 200, targets: 3 },
                { width: 200, targets: 5 },
                { width: 600, targets: 10 },
                { width: 600, targets: 15 },
                // { width: 600, targets: 12 },
            ],
            fixedColumns: true
		});
    		table1.buttons().container()
    			.appendTo('#viewrecruitmentdetails_wrapper .col-sm-6:eq(0)');
    		}


	   // table1 = $('#viewrecruitmentdetails').removeAttr('width').DataTable({
    //         scrollY:        "300px",
    //         scrollX:        true,
    //         scrollCollapse: true,
    //         paging:         false,
    //         columnDefs: [
    //             { width: 200, targets: 0 }
    //         ],
    //         fixedColumns: true
    //     } );


		
			


	});
	$(function() {
	    if(	$('.datetimepicker2').length > 0){
    		$('.datetimepicker2').datetimepicker({
    			format: 'HH:mm'
    		});
	    }
	    
		if($('.datepicker_y_m_d').length > 0){
    		$('.datepicker_y_m_d').datepicker({
    			format: 'Y-m-d'
    		});
		}
	});

    // FOR ALL AJAX CALLS CHECKING SESSION IF SESSION EXPIRES GOING TO LOGIN PAGE
    $(document).ajaxSend(function(event, jqxhr, settings) {
       // Check if the URL is a CodeIgniter controller method
        if (settings.url.indexOf('check_session_expired') == -1) {
            // Call the check_session_expired function in your CodeIgniter controller\
            
            $.ajax({
                type:"POST",
                url:baseurl+"admin/check_session_expired",
                success:function(response){
                    var parsedData = JSON.parse(response);
                    // If the session has expired, show an error message and redirect to the login page
                    if (parsedData.status == 'error') {
                        
                        swal({
                          title: "",
                          text: parsedData.message,
                          icon: "warning",
                          showCancelButton: false,
                          showConfirmButton: false, // hide the OK button
                          cancelButtonText: "Cancel",
                        })
                        setTimeout(function(){
                            window.location.href = '<?php echo base_url(); ?>' + 'admin/logout';
                        },800);
                    }
                }
            });
          
        }
    });
   
</script>

<script>
if($('#appliedjobdetails').length > 0){
    var table = $('#appliedjobdetails').removeAttr('width').DataTable({
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: 'Bfrtip',
     buttons: [
		  { 
		    extend : 'excel',
		    exportOptions : {
		      format: {
		        body: function( data, row, col, node ) {
		      //  	console.log(col)
		          if (col == 7) {
		            return table
		              .cell( {row: row, column: col} )
		              .nodes()
		              .to$()
		              .find(':selected')
		              .text()
		           } else {
		              return data;
		           }
		        }
		      }
		    },
		    
		  }
		],
});
}

</script>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/select2/js/select2.full.min.js"></script>
<script>
	$(function() {
		$('.select2').select2({dropdownAutoWidth: 'true',width: 'auto'});
	})
</script>
</body>

</html>