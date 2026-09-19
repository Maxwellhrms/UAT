<!-- Page Wrapper --> -->
<div class="page-wrapper">

<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Admin Notification</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active">Admin Notification</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<br>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<div class="card-header">
						<h4 class="card-title mb-0">Admin Notifications Entry</span></h4>
					</div>
					<div class="card-body">
						<form id="addlegalform">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="category" id="category"> 
				                                    <option value=""> Category </option>
				                                    <?php echo $controller->display_options('notifications_category_legal',''); ?>
												</select>
												<label class="focus-label">Select Category</label>
											</div>
											<span class="formerror" id="categoryerror"></span>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="esi_company_id" id="esi_company_id"> 
				                                    <option value=""> Select Company </option>
				                                    <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
				                                        <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
				                                    <?php } ?>
												</select>
												<label class="focus-label">Select Company</label>
											</div>
											<span class="formerror" id="cmpnameerror"></span>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="esi_div_id" id="esi_div_id"> 
													<option value="">Select Division</option>
												</select>
												<label class="focus-label">Select Division</label>
											</div>
											<span class="formerror" id="esi_div_id_error"></span>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="esi_state_id" id="esi_state_id"> 
													<option value="">Select State</option>
												</select>
												<label class="focus-label">Select State</label>
											</div>
											<span class="formerror" id="esi_state_id_error"></span>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="esi_branch_id" id="esi_branch_id"> 
													<option value="">Select Branch</option>
												</select>
												<label class="focus-label">Select Branch</label>
											</div>
											<span class="formerror" id="esi_branch_id_error"></span>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<input class="form-control" type="text" name="from" id="from"> 
												<label class="focus-label">Filed BY</label>
												<span class="formerror" id="from_error"></span>
											</div>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<input class="form-control" type="text" name="to" id="to"> 
												<label class="focus-label">Filed To</label>
												<span class="formerror" id="to_error"></span>
											</div>
										</div>
										
										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<input class="form-control datetimepicker" name="hearingdate" id="hearingdate"> 
												<label class="focus-label">Hearing Date</label>
												<span class="formerror" id="hearingdate_error"></span>
											</div>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<input class="form-control" type="text" name="referenceno" id="referenceno"> 
												<label class="focus-label">Reference No</label>
												<span class="formerror" id="referenceno_error"></span>
											</div>
										</div>
										
										<div class="col-md-6"> 
											<div class="form-group form-focus select-focus">
												<textarea class="form-control" name="msg" id="msg" rows="4" cols="50"> </textarea>
												<label class="focus-label">Message</label>
												<span class="formerror" id="msg_error"></span>
											</div>
										</div>

										<div class="col-md-3"> 
											<div class="form-group form-focus select-focus">
												<select class="select select2" style="width: 100%" name="ym" id="ym"> 
				                                    <option value=""> Year/Monthly </option>
				                                    <option value="13">Every Monthly</option>
									                <option value="14">Every Yearly</option>
												</select>
												<label class="focus-label">Select Year/Monthly</label>
											</div>
											<span class="formerror" id="ymerror"></span>
										</div>

									</div>
						<section class="row col-md-6">
						<div class="col-sm-10">
							<div class="form-group">
								<label>Upload Files</label>
								<input class="form-control filetypeschecker" type="file" name="file[]" id="file_1" onclick="checkfiles('1')">
								<span id="display_1"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="button" id="add_newfile" class="form-control btn btn-info add_lang_btn"><i class="fa fa-plus" style="color:#fff;"></i></button>
							</div>
						</div>
						</section>
						<div class="add_new_details"></div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary">Save Details</button>
										<button type="button" onclick="filter()" class="btn btn-primary">Filter</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<!-- Data Tables -->
	<div class="row" style="margin-top: 10px;">
		<div class="col-sm-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Hrms Admin Notifications List</h4>
				</div>
				<div class="card-body">	

					<div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="custom_dataTables">
							<thead>
								<tr>
								    <th>Application ID</th>
								    <th>Category</th>
								    <!--<th>Company</th>-->
									<th>Division</th>
									<th>State</th>
									<th>Branch</th>
									<th>Refrence</th>
									<th>Hearing Date</th>
									<th>Reminder Date</th>
									<th>Follow up Date</th>
									<th>Filed By</th>
									<th>Filed To</th>
									<th>Message</th>
									<th>Edit</th>
									<th>Add Files</th>
								</tr>
							</thead>
							<tbody>
							    <?php //print_r($info); ?>
							    <?php foreach($info as $key => $val){ ?>
								<tr>
									<td><a style="color:red;cursor: progress;" data-target="#historyinfo" data-toggle="modal" onclick="getfullinfo('<?php echo $val->mx_ntf_appid ?>','<?php echo $val->mx_ntf_id ?>')"><?php echo $val->mx_ntf_appid ?></button></td>
									<td><?php echo $val->mx_ntf_category ?></td>
									<!--<td><?php #echo $val->mxcp_name ?></td>-->
									<td><?php echo $val->mxd_name ?></td>
									<td><?php echo $val->mxst_state ?></td>
									<td><?php echo $val->mxb_name ?></td>
									<td><?php echo $val->mx_ntf_refrencce  ?></td>
									<td>
									    <?php 
									    if(empty($val->mx_ntf_followup_date)){
									    echo $val->mx_ntf_hearing_date;
									    }else{ 
									    echo $val->mx_ntf_followup_date;
									    } ?>
									</td>
									<?php $reminder = config('notification_reminder'); if($val->mx_ntf_followup_date == ''){$rm = $val->mx_ntf_hearing_date;}else{ $rm = $val->mx_ntf_followup_date; } ?>
									<td><?php echo date('d-m-Y', strtotime($rm. ' -'. $reminder[0]->notification_reminder .'days')); ?></td>
									<td><?php echo $val->mx_ntf_followup_date ?></td>
									<td><?php echo $val->mx_ntf_filedby ?></td>
									<td><?php echo $val->mx_ntf_filedto ?></td>
									<td><?php echo $val->mx_ntf_description ?></td>
									<td>
									<a class="btn btn-info" data-target="#updateinfo" data-toggle="modal" style="color: #fff;" onclick="getdetails('<?php echo $val->mx_ntf_appid ?>','<?php echo $val->mx_ntf_id ?>')">Edit</a>
									</td>
									<td><a href="#" data-id="<?php echo $val->mx_ntf_appid; ?>" class="btn btn-white float-end ms-2 addnew_casefiles" data-bs-toggle="modal" data-bs-target="#add_new_files"><i class="fa fa-plus"></i></a></td>
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
</div>
</div>
<!-- /Page Wrapper -->

				<div id="updateinfo" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Legal Notifications</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<div class="modal-body">
								 <div id="openrviewscreen"></div> 
							</div>


						</div>
					</div>
				</div>
				
				
				<div id="historyinfo" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Notifications History</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<div class="modal-body">
								 <div id="getallhistory"></div> 
							</div>


						</div>
					</div>
				</div>


			<div id="add_new_files" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Upload New Documents</h4>
							<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form id="addnewfilestodocument" method="POST" enctype='multipart/form-data'>
								<input type="hidden" name="editticketid" id="editticketid">
								<div>
								<section class="row">
								<div class="col-sm-10">
									<div class="form-group">
										<label>Upload Files</label>
										<input class="form-control filetypeschecker" type="file" name="neweditfile[]" id="neweditfile_1" onclick="editcheckfiles('1')">
										<span id="neweditdisplay_1"></span>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="button" id="add_neweditfile" class="form-control btn btn-info add_lang_btn"><i class="fa fa-plus" style="color:#fff;"></i></button>
									</div>
								</div>
								</section>
								</div>
								<div class="add_newedit_details"></div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary btn-lg">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
//------Load Division
$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
});

var esi_div_array = [];
var esi_selected_div;
function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'type': "ESI"},
        success: function (data) {
//                    console.log("ESI DIVISIONS");
//                    console.log(data);
//                    console.log("END ESI DIVISIONS");
            esi_div_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
//                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (esi_selected_div == esi_div_array_index.mxd_id) {
                option += "<option value=" + esi_div_array_index.mxd_id + " selected>" + esi_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + esi_div_array_index.mxd_id + ">" + esi_div_array_index.mxd_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#esi_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#esi_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}

$("#esi_div_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $(this).val();
//        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
//        load_esi_states(esi_comp_id, 0)
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
});

var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
//    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI"},
        success: function (data) {
//            console.log("ESI STATES");
//            console.log(data);
//            console.log("END ESI STATES");
            esi_states_array = JSON.parse(data);
//                            console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
//                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#esi_state_id").empty().append(option);
    
    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}
//------End Load States
//------Load Branches
$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0)
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);
    }
});
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI'},
        success: function (data) {
//                    console.log(data);
            esi_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (esi_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in esi_branches_array) {
            var esi_branches_array_index = esi_branches_array[index];
            if (esi_selected_branch == esi_branches_array_index.mxb_id) {
                option += "<option value=" + esi_branches_array_index.mxb_id + " selected>" + esi_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + esi_branches_array_index.mxb_id + ">" + esi_branches_array_index.mxb_name + "</option>"
            }
//                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);
}

$("form#addlegalform").submit(function(e) {
	e.preventDefault();  

    var category = $("#category").val();
    if (category == 0 || category == "") {
        $("#category").focus();
        $('#categoryerror').html("Please Select Category");
        return false;
    } else {
        $('#categoryerror').html("");
    }
    
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    
    
    var esi_div_id = $("#esi_div_id").val();
    if (esi_div_id == 0 || esi_div_id == "") {
        $("#esi_div_id").focus();
        $('#esi_div_id_error').html("Please Select Division");
        return false;
    } else {
        $('#esi_div_id_error').html("");
    }
    
    var esi_state_id = $("#esi_state_id").val();
    if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    }
    
    var esi_branch_id = $("#esi_branch_id").val();
    if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }
    
    var hearingdate = $("#hearingdate").val();
    if (hearingdate == 0 || hearingdate == "") {
        $("#hearingdate").focus();
        $('#hearingdate_error').html("Please Select Hearing Date");
        return false;
    } else {
        $('#hearingdate_error').html("");
    }

	mainurl = baseurl+'admin/savelegalnotifications';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
	        //console.log(data);
	        if (data == 200) {
	            alert('Successfully');
	            setTimeout(function(){
	            window.location.reload();
	            }, 1000); 
	        } else {
	        	alert('Failed To Save Please TryAgain later');
	        }
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});

});	

function getdetails(app, id){
	event.preventDefault();
	    $.ajax({
	        url: baseurl+'admin/getlegalnotifications',
	        type: 'POST',
	        data: {applicationid : app, uniqueid : id},
	        success: function (data) {
	       // 	console.log(data);
	        $("#openrviewscreen").html(data);
	    	},
		});
}

function filter(){
    var category = $("#category").val();
    var esi_company_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $("#esi_state_id").val();
    var esi_branch_id = $("#esi_branch_id").val();
    window.location.href = "<?php echo base_url() ?>admin/legalnotification?category=" + category + "&esi_company_id=" + esi_company_id +
               "&esi_div_id=" + esi_div_id + "&esi_state_id=" + esi_state_id + "&esi_branch_id=" + esi_branch_id;
}

function getfullinfo(app,id){
	event.preventDefault();
	    $.ajax({
	        url: baseurl+'admin/getlegalnotifications_log',
	        type: 'POST',
	        data: {applicationid : app, uniqueid : id},
	        success: function (data) {
	       // 	console.log(data);
	        $("#getallhistory").html(data);
	        		var table = $('#dataTables-example1').DataTable({
                        dom: 'Bfrtip',
                        "destroy": true, //use for reinitialize datatable
                        lengthChange: false,
                        buttons: [
                            // { extend: 'copyHtml5', footer: true },
                            { extend: 'excelHtml5', footer: true },
                            { extend: 'csvHtml5', footer: true },
                            // { extend: 'pdfHtml5', footer: true }
                        ],
                    });
	    	},
		});
}

   var snrfno = 2;
   $('#add_newfile').click(function(e) {
    e.preventDefault();
    $(".add_new_details").append(
         
         '<section class="row col-md-6" id="del_'+snrfno+'">'
         +'<div class="col-sm-10">'
         +'   <div class="form-group">'
         +'      <label>Upload Files</label>'
         +'      <input class="form-control filetypeschecker" type="file" name="file[]" id="file_'+snrfno+'" onclick="checkfiles('+snrfno+')">'
         +'     <span id="display_'+snrfno+'"></span>'
         +'   </div>'
         +'</div>'
         +'<div class="col-sm-2">'
         +'   <div class="form-group">'
         +'      <label>&nbsp;</label>'
         +'      <button type="button" class="form-control btn btn-danger removerefdetails" id="'+snrfno+'"><i class="fa fa-minus" style="color:#fff;"></i></button>'
         +'   </div>'
         +'</div>'
         +'</section>'
    );
       snrfno++;
       $('.removerefdetails').click(function(e) {
       e.preventDefault();
       var id = $(this).attr("id");
       $("#del_" + id).remove();
       snrfno--;
      });
   });

function checkfiles(id){
var fileid = id;
  $('#file_'+fileid).on('change', function() {
      var displaysize = formatBytes(this.files[0].size);
      // console.log(displaysize);
      if (this.files[0].size > 2097152) {
          alert("Try to upload file less than 2MB!");
          $('#display_'+fileid).html('Error Invalid File Size '+displaysize);
      } else {
          $('#display_'+fileid).html(displaysize);
          // console.log(this.files[0].size);
          // $('#GFG_DOWN').text(this.files[0].size + "bytes");
      }
  });
}

function editcheckfiles(id){
        // e.preventDefault();
        // console.log(id);
    var fileid = id;
$('#neweditfile_'+fileid).on('change', function() {
    var displaysize = formatBytes(this.files[0].size);
    // console.log(displaysize);
    if (this.files[0].size > 2097152) {
        alert("Try to upload file less than 2MB!");
        $('#neweditdisplay_'+fileid).html('Error Invalid File Size '+displaysize);
    } else {
        $('#neweditdisplay_'+fileid).html(displaysize);
        // console.log(this.files[0].size);
        // $('#GFG_DOWN').text(this.files[0].size + "bytes");
    }
});
}

function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

$(document).on("click", ".addnew_casefiles", function () {
  var id = $(this).data('id');
  $(".modal-body #editticketid").val(id);
});

   var editsnrfno = 2;
   $('#add_neweditfile').click(function(e) {
       e.preventDefault();
       $(".add_newedit_details").append(
            
            '<section class="row" id="del_'+editsnrfno+'">'
            +'<div class="col-sm-10">'
            +'   <div class="form-group">'
            +'      <label>Upload Files</label>'
            +'      <input class="form-control filetypeschecker" type="file" name="neweditfile[]" id="neweditfile_'+editsnrfno+'" onclick="editcheckfiles('+editsnrfno+')">'
            +'     <span id="neweditdisplay_'+editsnrfno+'"></span>'
            +'   </div>'
            +'</div>'
            +'<div class="col-sm-2">'
            +'   <div class="form-group">'
            +'      <label>&nbsp;</label>'
            +'      <button type="button" class="form-control btn btn-danger removerefdetails" id="'+editsnrfno+'"><i class="fa fa-minus" style="color:#fff;"></i></button>'
            +'   </div>'
            +'</div>'
            +'</section>'
       );
       editsnrfno++;
       $('.removerefdetails').click(function(e) {
       e.preventDefault();
       var id = $(this).attr("id");
       $("#del_" + id).remove();
       editsnrfno--;
      });
   });

    $("form#addnewfilestodocument").submit(function(e) {
         e.preventDefault(); 
         var formData = new FormData(this);
         mainurl = baseurl+'admin/addnewfilestodocument';
         $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            success: function (data) {
           var result = $.parseJSON(data);
                 // console.log(data);
            if(result.respone == 200){
               alert('Successfully');
               setTimeout(function(){
                  window.location.reload();
               }, 100); 
            } else {
               alert('Failed To Save Please TryAgain Later');
            }
            },
            cache: false,
            contentType: false,
            processData: false
         });      
      });
      

			
</script>	