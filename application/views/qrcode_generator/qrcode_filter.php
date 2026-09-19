					<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">QRcode List</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Leave Adjustment</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
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
								<select class="select select2" multiple style="width: 100%" name="esi_branch_id" id="esi_branch_id"> 
									<option value="">Select Branch</option>
								</select>
								<label class="focus-label">Select Branch</label>
							</div>
							<span class="formerror" id="esi_branch_id_error"></span>
						</div>

						<div class="col-sm-6 col-md-3">  
							<button id="searchemployeefilterdata" class="btn btn-success btn-block" onclick="filterattnd()"> Search </button>  
						</div>     
                    </div>

					<!-- /Search Filter -->
					
					<div id="displayattend"></div>


                </div>
				<!-- /Page Content -->
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
        url: baseurl + "Qrcode_generator/qrcode_getdivisions_based_on_branch_master",
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
        url: baseurl + "Qrcode_generator/qrcode_getstates_based_on_branch_master",
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
        url: baseurl + "Qrcode_generator/qrcode_getbranches_based_on_eligibility_state_wise",
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
function filterattnd(){

	    var esi_div_id = $("#esi_div_id").val();
	    if (esi_div_id == 0 || esi_div_id == "") {
	        $("#esi_div_id").focus();
	        $('#esi_div_id_error').html("Please Select Division Name");
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
            var esi_company_id = $("#esi_company_id").val();
        if (esi_company_id == 0 || esi_company_id == "") {
            $("#esi_company_id").focus();
            $('#cmpnameerror').html("Please Select Company Name");
            return false;
        } else {
            $('#cmpnameerror').html("");
        }

	var mainurl = baseurl+'Qrcode_generator/processqrcode';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: {company:esi_company_id, divison:esi_div_id, state:esi_state_id, branch:esi_branch_id},
    success: function (data) {
        $('#displayattend').html(data);
    },
});
}
</script>
<script>
    function sendtoqrcode(company_id,division_id,state_id,branch_id){
        window.location=baseurl + 'Reports/viewqrcode?company='+company_id+'&divison='+division_id+'&state='+state_id+'&branch='+branch_id;
    }
</script>