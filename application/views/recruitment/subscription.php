<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Subscription</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Subscription Details</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Subscription Details</h4>
				</div>
				<div class="card-body">
                    <form id="updateconfig">
					<div class="form-group row">
						
						<div class="col-lg-3">
						    <label class="form-label">Type</label>
							<select class="form-control" name="type" id="type" style="width:100%">
								<option value="All"> All </option>
								<option value="RELOCATIONS">RELOCATIONS</option>
								<option value="LOGISTICS">LOGISTICS</option>
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
						
						<div class="col-lg-3">
						    <label class="form-label">Current Location</label>
							<select class="form-control" name="currentlocation" id="currentlocation" style="width:100%">
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
						
						<div class="col-lg-3">
						    <label class="form-label">Preferred Location</label>
							<select class="form-control" name="preferredlocation" id="preferredlocation" style="width:100%">
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
						
					</div>
					<button type="submit" class="btn btn-primary">Search Details</button>
					</form>
					<br>
					<div id="Subscription_list"></div>
				</div>
			</div>
		</div>
	</div>
	</div>			
</div>
<!-- /Main Wrapper -->
<script>
 $("form#updateconfig").submit(function(e) {
	e.preventDefault();  

	mainurl = baseurl+'recruitment/subscriptiondetails_list';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
	        $('#Subscription_list').html(data);
	        		var table = $('#employee_json_datatable').removeAttr('width').DataTable({
	                    dom: 'Bfrtip',
	                    // "destroy": true, //use for reinitialize datatable
	                    // // lengthChange: false,
	                    // buttons: [
	                    //     { extend: 'excelHtml5', footer: true }
	                    // ],
	                     buttons: [
							  { 
							    extend : 'excel',
							 //   exportOptions : {
							     // format: {
							     //   body: function( data, row, col, node ) {
							        	// console.log(col)
							         // if (col == 3) {
							         //   return table
							         //     .cell( {row: row, column: col} )
							         //     .nodes()
							         //     .to$()
							         //     .find(':selected')
							         //     .text()
							         //  } else {
							         //     return data;
							         //  }
							     //   }
							     // }
							 //   },
							    
							  }
							],
	                    // scrollX: true,
	                    // scrollCollapse: true,
			            // columnDefs: [
			            //     { width: 200, targets: 2 },
			            //     { width: 200, targets: 3 },
			            //     { width: 200, targets: 5 },
			            //     { width: 600, targets: 10 },
			            //     { width: 600, targets: 11 },
			            //     { width: 600, targets: 12 },
			            // ],
			            // fixedColumns: true
	            });
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});

});	


function deleteemailtemplateinfobyid(deleteid){
    var confirmSubmit = confirm('Are you sure you want to Delete');
    if (!confirmSubmit) {
        return false;
    }
    mainurl = baseurl+'Recruitment/deletesubscriptiondetails';
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: {'id':deleteid},
     success: function (data) {
         if(data == 200){
            alert('Successfully');
            setTimeout(function(){
               window.location.reload();
            }, 100); 
         } else {
            alert('Failed Please TryAgain Later');
         }
     }
    }); 
}

$( document ).ready(function() {

    $( "#type" ).on( "change", function() {
      event.preventDefault();
      var cmpid = $("#type").val();
	    $.ajax({
	        url: baseurl+'Recruitment/getsubscurrentlocation',
	        type: 'POST',
	        data: {'type' : cmpid},
	        success: function (data) {
	          $("#currentlocation").html(data);
	        },
	    });
	});

 $( "#type" ).on( "change", function() {
      event.preventDefault();
      var divid = $("#type").val();
    $.ajax({
        url: baseurl+'Recruitment/getsubspreferredlocation',
        type: 'POST',
        data: {'type' : divid},
        success: function (data) {
          $("#preferredlocation").html(data);
        },
    });
  });
  
});
</script>