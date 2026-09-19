			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<!--<h3 class="page-title">Performance Appraisal</h3>-->
								<h3 class="page-title">Manage Your Files</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="file-wrap">
								<div class="file-cont-wrap" style="margin-left: 0px; width: 100%;">
									<div class="file-cont-inner">
										<form  id="processappdetails">
										<div class="file-cont-header">
											<div class="file-options"></div>
											<span>File Manager</span>
											<div class="file-options"></div>
										</div>
										<div class="file-content">
											<div class="file-search">
									    <?php if($this->session->userdata('user_id') == '888666'){ ?>
										<div class="input-group col-md-4" style="float: left;">
											<select class="form-control select2" name="departement" id="department" onchange="getemployees()">
												<option value="">Departements</option>
											        <?php foreach ($depart as $key => $value) {
											            echo "<option value=".$value->mxdpt_id.">".$value->mxdpt_name."</option>";
											        } ?>
											</select>
											<span id="departementerror"></span>
										</div>
										<div class="input-group col-md-4" style="float: left;">
											<select class="form-control select2" name="employee" id="employee">
											</select>
											<span id="employeeerror"></span>
										</div>
										<?php } ?>
										<div class="input-group col-md-4">
											<input type="text" class="form-control" name="filename" id="filename" placeholder="File Name">
											<br><span id="filenameerror"></span>
										</div><br>
										<div class="input-group col-md-4">
											<input type="file" class="form-control" name="fileupload" id="fileupload" placeholder="File Name">
											<br><span id="fileuploaderror"></span>
										</div>
										<br>
										<div class="col-md-2">
                                            <button type="button" class="form-control btn btn-info" id="filterinfo" onclick="filterdetails()">Filter Details</button>
                                            <span>To Filter only enter the File Name</span>
										</div>
										<br>
										<div class="offset-md-10 col-md-2">
											<button type="submit" class="form-control btn btn-info" >Save</button>
										</div>
											</div>
											<div id="displayfiles">
												<?php //include 'performanceappraisalfilterdata.php'; ?>		
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
<script>
$( document ).ready(function() {
  
$("form#processappdetails").submit(function(e) {
e.preventDefault();  
var empx = '<?php echo $this->session->userdata('user_id') ?>';
if(empx == '888666'){
    var department = $("#department").val();
    if(department ==""){
      $("#department").focus();
      $('#departementerror').html("Please Select Departement");
      return false;
    }else{$('#departementerror').html("");}
    
    var employee = $("#employee").val();
    if(employee ==""){
      $("#employee").focus();
      $('#employeeerror').html("Please Select Employee");
      return false;
    }else{$('#employeeerror').html("");}
}

var filename = $("#filename").val();
if(filename ==""){
  $("#filename").focus();
  $('#filenameerror').html("Please Enter Filename");
  return false;
}else{$('#filenameerror').html("");}


  var mainurl = baseurl+'performanceappraisal/saveappraisal';


var formData = new FormData(this);
$.ajax({
    url: mainurl,
    type: 'POST',
    data: formData,
    success: function (data) {
    	// console.log(data);
        if (data == 200) {
            alert('Successfully');
            setTimeout(function(){
            window.location.reload();
            }, 1000); 
        }else if(data == 404){
        	alert("Please Upload File");
        } else {
        	alert('Failed To Save Please TryAgain later');
        }
    },
    cache: false,
    contentType: false,
    processData: false
});

});


 $('#designation').change(function(e) {
        var designation = $('#designation').val();
        var department = $('#department').val();
        if(designation == ''){
        	alert("Please Select Designation");
        	return false;
        }
        if(department == ''){
        	alert("Please Select Departement");
        	return false;
        }
        $.ajax({
		    url: baseurl+'performanceappraisal/fileterthedata',
		    type: 'POST',
		    data: {deg : designation, dep : department},
		    success: function (data) {
		    	$("#displayfiles").html(data);
		    },
		});

    }); 

});

function deletefiles(id){
    $.ajax({
	    url: baseurl+'performanceappraisal/deletefiles',
	    type: 'POST',
	    data: {id : id},
	    success: function (data) {
	       // console.log(data);
        if (data == 200) {
            alert('Successfully Deleted');
            setTimeout(function(){
            window.location.reload();
            }, 1000); 
        }else {
        	alert('Failed To Delete Please TryAgain later');
        }
	    },
	});
}

function getemployees(){
 var departmentid = $("#department").val();  
      $.ajax({
	    url: baseurl+'performanceappraisal/getappremployeeslist',
	    type: 'POST',
	    data: {department : departmentid},
	    success: function (data) {
	       $("#employee").html(data);
	    },
	});
}

function filterdetails(){
         var employee = $('#employee').val();
        var department = $('#department').val();
        var filename = $('#filename').val();
        var empx = '<?php echo $this->session->userdata('user_id') ?>';
        if(empx == '888666'){
            if(employee == ''){
            	alert("Please Select Employee");
            	return false;
            }
            if(department == ''){
            	alert("Please Select Departement");
            	return false;
            }
        }
        $.ajax({
		    url: baseurl+'performanceappraisal/fileterthedata',
		    type: 'POST',
		    data: {emp : employee, dep : department, file : filename},
		    success: function (data) {
		    	$("#displayfiles").html(data);
		    },
		});
}
</script>
<script> $(document).ready(function() { $('#filterinfo').trigger('click'); });</script>
