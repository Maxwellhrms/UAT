<?php $months = date('m');   ?>
                <!-- Page Wrapper -->
                    <div class="page-wrapper">
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"> <?php echo $title ;?>  </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active"> <?php echo $title ;?>  </li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
                    <form id="commonform" >
				    	<div class="row filter-row">
					     <?php if($from == 'Y'){ ?>
    						<div class="col-sm-6 col-md-3"> 
    							<div class="form-group form-focus select-focus">
                                    <input type="text" class="form-control datetimepicker1" name="fromdate" id="fromdate" autocomplete="off">
    							    <label class="focus-label">From Date</label> 
                                </div>
    						</div>
						<?php } ?>
                        <?php if($to == 'Y'){ ?>
    						<div class="col-sm-6 col-md-3"> 
    							<div class="form-group form-focus select-focus">
                                    <input type="text" class="form-control datetimepicker1" name="todate" id="todate" autocomplete="off">
    							    <label class="focus-label">To Date</label> 
                                </div>
    						</div>
                        <?php } ?>
					    
					    
                        <?php if($ym == 'Y'){ ?>
						<div class="col-sm-4 col-md-3 attndyear_div"> 
							<div class="form-group form-focus select-focus">
                                <input type="text" class="form-control monthyearselect" name="attndyear" id="attndyear" autocomplete="off">
							    <label class="focus-label">Month Year</label> 
                            </div>
						</div>
                        <?php }elseif($ym == 'Year'){ ?>
                            <div class="col-sm-6 col-md-3"> 
                                <div class="form-group form-focus select-focus">
                                    <select class="select select2" style="width: 100%" name="attndyear" id="attndyear"> 
                                        <option value="">Select Year</option>
                                        <?php 
                                        $currently_selected = date('Y'); 
                                        $earliest_year = 2020; 
                                        $latest_year = date('Y'); 
                                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                            if($i == $currently_selected ){
                                                $sel ="selected"; }else{ $sel = "";   }
                                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <label class="focus-label">Select Year</label>
                                </div>
                                <span class="formerror" id="attndyearerror"></span>
						    </div>
                        <?php } ?>
                        
                        <?php if($cmd == 'Y'){ ?>
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
                        <?php } ?>

                        <?php if($div == 'Y'){ ?>         
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_div_id" id="esi_div_id"> 
									<option value="">Select Division</option>
								</select>
								<label class="focus-label">Select Division</label>
							</div>
							<span class="formerror" id="esi_div_id_error"></span>
						</div>
                        <?php } ?>

                        <?php if($stateid == 'Y'){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_state_id" id="esi_state_id"> 
									<option value="">Select State</option>
								</select>
								<label class="focus-label">Select State</label>
							</div>
							<span class="formerror" id="esi_state_id_error"></span>
						</div>
                        <?php } ?>

                        <?php if($branch == 'Y'){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="esi_branch_id" id="esi_branch_id"> 
									<option value="">Select Branch</option>
								</select>
								<label class="focus-label">Select Branch</label>
							</div>
							<span class="formerror" id="esi_branch_id_error"></span>
						</div>
                        <?php } ?>

                        <?php if($grade == 'Y'){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="grade" id="grade"> 
                                    <option value=""> Select Grade </option>
                                </select>
								<label class="focus-label">Select Grade </label>
							</div>
							<span class="formerror" id="cmpnameerror"></span>
						</div>
                        <?php } ?>
                         <?php if($categ == 'Y'){ 
                            foreach($check as $key=>$val){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2 <?php echo $val ?>" style="width: 100%" name="categeory_<?php echo $key ?>" id="categeory_<?php echo $key ?>"> 
									<option value="">Select </option>
                                    <?php  echo $controller1->display_options($val,''); ?>
                                    <!-- <option value="PR">PR</option>
									<option value="AB">AB</option> -->
								</select>
								<label class="focus-label">Select Category</label>
							</div>
							<span class="formerror" id="categeory_error"></span>
						</div>
                        <?php } } ?>

                        <?php if($day == 'Y'){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="day" id="day"> 
									<option value="">Select Day </option>
                                    <?php for($i=1; $i<=31 ; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
								<label class="focus-label">Select Day</label>
							</div>
							<span class="formerror" id="categeory_error"></span>
						</div>
                        <?php }   ?>

                        <?php if($empjoin == 'Y'){ ?>
                        <div class="col-sm-6 col-md-3">  
                            <div class="form-group row card mb-0 col-md-12">
                                <p align="center">Employee</p>
                                <div class="radio" align="center">
                                    <label style=" margin: 0 2px 0;">
                                        <input type="radio" name="radiotype"  id="radiotype" value="1" checked > Joining
                                    </label>
                                    <label style=" margin: 0 2px 0;">
                                        <input type="radio" name="radiotype" id="radiotype" value="2"> Leaving
                                    </label>
                                    <label style=" margin: 0 2px 0;">
                                        <input type="radio" name="radiotype" id="radiotype" value="3"> Both
                                    </label>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                       <?php if($emp_type == 'Y'){ ?>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="emptype" id="emptype"> 
									<option value="">Select Emp Type </option>
                                    
                                </select>
								<label class="focus-label">Select Emp Type</label>
							</div>
							<span class="formerror" id="emptype_error"></span>
						</div>
                        <?php }   ?>

                        <?php if($emplid == 'Y'){ ?>
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="attndempid" id="attndempid">
								<label class="focus-label">Employee Code</label>
							</div>
                            <span class="formerror" id="attndempiderror"></span>
						</div>

                        <?php } ?>
						<div class="col-sm-6 col-md-3">  
							<button id="searchemployeefilterdata" class="btn btn-success btn-block" > Search </button>  
						</div>     
                    </div>
                    </form>
					<!-- /Search Filter -->				
					<!-- <div id="displayattend"></div> -->
                
<script type="text/javascript">

//------Load Division
$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "") {
        load_esi_divisions(esi_comp_id, 0);
        load_emp_type(esi_comp_id, 0)
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

    }

    $.ajax({
      url: baseurl + 'test/getgrade',
      type: 'POST',
      data: { companyid: esi_comp_id },
      success: function (data) {
        $("#grade").html(data);
      },
    });
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

//---------------LOAD EMPLOYEE TYPE
var incentive_selected_emp_type;
function load_emp_type(cmp_id, incentive_selected_emp_type) {

    var option = '<option value="0">Select Emp Type</option>';
    if (cmp_id != 0 && cmp_id != "") {
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if (emp_type_parse_data.length > 0) {
                    for (index in emp_type_parse_data) {
                        var emp_type_index = emp_type_parse_data[index];
                        if (incentive_selected_emp_type == emp_type_index.mxemp_ty_id) {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' selected>' + emp_type_index.mxemp_ty_name + '</option>';
                        } else {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' >' + emp_type_index.mxemp_ty_name + '</option>';
                        }
                    }
                }

            }
        });
    }
    $("#emptype").html(option);
}
//---------------END LOAD EMPLOYEE TYPE


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
