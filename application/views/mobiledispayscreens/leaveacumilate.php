
<?php //echo $controller->mastersfilter(); ?>
<?php $months = date('m'); ?>
                <!-- Page Wrapper -->
                    <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"> <?php echo $titlehead; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active"> <?php echo $titlehead; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
                    <form id="commonform" >

					<div class="row filter-row">
						<div class="col-sm-6 col-md-3"> 
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

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_div_id" id="esi_div_id"> 
									<option value="">Select Division</option>
								</select>
								<label class="focus-label">Select Division</label>
							</div>
							<span class="formerror" id="esi_div_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_state_id" id="esi_state_id"> 
									<option value="">Select State</option>
								</select>
								<label class="focus-label">Select State</label>
							</div>
							<span class="formerror" id="esi_state_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_branch_id" id="esi_branch_id"> 
									<option value="">Select Branch</option>
								</select>
								<label class="focus-label">Select Branch</label>
							</div>
							<span class="formerror" id="esi_branch_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="emptype" id="emptype"> 
								    <option value="">Select Employee Type</option>
                                    <?php foreach($emptype as $key=>$val){ ?>
                                        <option value="<?php echo $val->mxemp_ty_id ?>"><?php echo $val->mxemp_ty_name ?></option>
                                    <?php } ?>
								</select>
								<label class="focus-label">Select Employee Type</label>
							</div>
							<span class="formerror" id="approvstatus_error"></span>
						</div>
						
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="empstatus" id="empstatus">
									<option value="ALL">ALL</option>
									<option value="W">WORKING</option>
									<option value="N">NOTICE PERIOD</option>
									<option value="RNP">RESIGNED(With Notice Period)</option>
									<option value="RWNP">RESIGNED(Without Notice Period)</option>
									<option value="R">RESIGNED</option>
								</select>
								<label class="focus-label">Select Employee Status</label>
							</div>
							<span class="formerror" id="approvstatus_error"></span>
						</div>

						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="attndempid" id="attndempid">
								<label class="focus-label">Employee Code</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<button id="searchemployeefilterdata"  class="btn btn-success btn-block"   > Search </button>  
                            <!--  -->
						</div>     
                    </div>

                    </form>
					<!-- /Search Filter -->
					
					<!-- <div id="displayattend"></div> -->


                
<script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }


function leaveacumilate(empid,uniqueid){ 
    var leaveaddval = $("#lv_"+uniqueid).val();
    var ck = confirm("Do You Want To Edit the leave Balance for employeeid "  + empid);
        if(ck == true){
            $.ajax({
                url: baseurl + "admin/leaveaddbalance",
                type: "post",
                async: false,
                data: {'emp_id': empid , 'lbaluid': uniqueid,'laddval' :leaveaddval },
                success: function (data) {
                    // console.log(data);
                    if(data ==1){
                        alert('Sucessfully Updated');
                    }else{
                        alert('Something went wrong');
                    }
                }
            });
        }
}

//------Load Division
$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "") {
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
            esi_div_array = JSON.parse(data);
//           console.log(states_array);

        }
    });

    var option;
//        console.log(states_array);
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
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
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
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
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: {'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI"},
        success: function (data) {
            esi_states_array = JSON.parse(data);
        }
    });

    var option;
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
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
        }
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);
}


$('document').ready(function () {
    $("select#esi_company_id").val("1").trigger('change');
    // $("#searchemployeefilterdata").trigger("click");

});


</script>	

<div id="leaveacumilatelist1"> </div>
<!-- /Page Content -->
</div>


<script>
    
$("form#commonform").submit(function(e) {    
        e.preventDefault();  
        var company_id = $("#esi_company_id").val();
        if (company_id == 0 || company_id == "") {
            $("#esi_company_id").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }
        var div_id = $("#esi_div_id").val();    
	    var state_id = $("#esi_state_id").val();
	    var branch_id = $("#esi_branch_id").val();
        var empid = $("#attndempid").val();
        var emptype = $("#emptype").val();
        var empstatus = $("#empstatus").val();
        var mainurl = baseurl+'admin/leaveacumilatelist';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'companyid': company_id, 'divisonid': div_id,'stateid':state_id,'branchid':branch_id,'employeeid':empid,'emptype':emptype,'empstatus':empstatus},
            success: function (data) {
            // console.log(data);
            $("#leaveacumilatelist1").html(data);
            // var table = $('#dataTables-example1').DataTable({
            //         dom: 'Bfrtip',
            //         "destroy": true, //use for reinitialize datatable
            //         lengthChange: false,
            //         buttons: [
            //             { extend: 'excelHtml5', footer: true }
            //         ],
            // });
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    destroy: true, // Reinitialize DataTable if needed
                    lengthChange: false,
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            footer: true,
                            exportOptions: {
                                format: {
                                    body: function(data, row, column, node) {
                                        // Check if the cell contains an input
                                        var input = $(node).find('input');
                                        if (input.length) {
                                            return input.val(); // Return input value
                                        }
                                        // Exclude buttons and other HTML elements
                                        return $(node).text().trim(); // Fallback to cell text
                                    }
                                }
                            }
                        }
                    ]
                });
            }
        });
    });

    </script>