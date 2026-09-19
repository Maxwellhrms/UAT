<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Leave Types</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leave Type Master</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
       

        <!-- Data Tables -->
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Leave Type List</h4>
                    </div>
                    <div class="card-body"> 

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <!--<th>Company Name</th>-->
                                        <th>Leave Type Name</th>
                                        <th>Leave Type Short Name</th>
                                        <th>Is Earned Leave</th>
                                        <th>Is Short Leave</th>
                                        <th>Is optional Leave</th>
                                        <th>Is Attendance</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($leave_type as $key => $dpvalue) { ?>
                                        <tr>
                                            <!--<td><?php #echo $dpvalue->mxcp_name ?></td>-->
                                            <td><?php echo $dpvalue->mxlt_leave_name ?></td>
                                            <td><?php echo $dpvalue->mxlt_leave_short_name ?></td>
                                            <td><?php echo ($dpvalue->mxlt_is_earned_leave == 1)?'Yes':'No' ?></td>
                                            <td><?php echo ($dpvalue->mxlt_is_short_leave == 1)?'Yes':'No' ?></td>
                                            <td><?php echo ($dpvalue->mxlt_is_optional_holiday == 1)?'Yes':'No' ?></td>
                                            <td><?php echo ($dpvalue->mxlt_showinattendance == 1)?'Yes':'No' ?></td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item editleavetypes" data-toggle="modal" data-target="#addletype" data-id="<?php echo $dpvalue->mxlt_id.'~'.$dpvalue->mxlt_leave_name . '~' . $dpvalue->mxlt_leave_short_name. '~' . $dpvalue->mxlt_is_earned_leave. '~' . $dpvalue->mxlt_is_short_leave. '~' . $dpvalue->mxlt_is_optional_holiday. '~' . $dpvalue->mxlt_comp_id.'~'.$dpvalue->mxlt_showinattendance.'~'.$dpvalue->showinattendance_order; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    </div>
                                                </div>
                                            </td>
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
</div>
<!-- /Main Wrapper -->
<!-- Delete leave_typeModal -->
<div class="modal custom-modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Branch</h3>
                    <h3 style="color: red" id="deldpname"></h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <input type="hidden" name="deletemainid" id="deldpid">
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete leave_typeModal -->

            <!-- Add new Leave Type -->
            <div class="modal custom-modal fade" id="addletype" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post">
                            <div class="form-header">
                                <h3>Leave Type Details</h3>
                            </div>
                                            
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Company Name</label>
                                        <div class="col-lg-7">
                                            <select class="form-control" name="cmpname" id="cmpname" style="width:100%">
                                                <option value="">-- Select Company --</option>
                                                <?php foreach ($cmpmaster as $key => $cmpvalue) { ?>
                                                    <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="formerror" id="compnameerror"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Leave Type Name</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="leavetypename" id="leavetypename">
                                        </div>
                                        <span class="formerror" id="leavetypenameerror"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Leave Type ShortName</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="leavetypeshtname" id="leavetypeshtname">
                                        </div>
                                        <span class="formerror" id="leavetypeshtnameerror"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Show in Attendance order</label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="showinattendance_order" id="showinattendance_order">
                                        </div>
                                        <span class="formerror" id="showinattendance_ordererror"></span>
                                    </div>
                                </div>
                                <div class="form-group row">    
                                <div class="col-lg-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="earnedleave" name="earnedleave" value="1">
                                        <label class="form-check-label">
                                            Is Earned Leave
                                        </label>
                                        <span class="formerror" id="checkerror"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="shortleave" name="shortleave" value="1">
                                        <label class="form-check-label">
                                            Is Short Leave
                                        </label>
                                        <span class="formerror" id="checkederror"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="optleave" name="optleave" value="1">
                                        <label class="form-check-label">
                                            Optinal Leave
                                        </label>
                                        <span class="formerror" id="checkederror"></span>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dir_hr" type="checkbox" id="showinattendance" name="showinattendance" value="1">
                                        <label class="form-check-label">
                                            Show in Attendance
                                        </label>
                                        <span class="formerror" id="checkederror"></span>
                                    </div>
                                </div>
                            </div>
                                                    
                            <div class="text-right">
                                <input type="hidden" name="id" id="uniqueid">
                                <button type="button" class="btn btn-primary" onclick="saveeditleavetype()">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                        
            <!-- /Add new Leave Type -->
            <?php echo    $dpvalue->mxlt_is_optional_holiday. '~' . $dpvalue->mxlt_comp_id; ?>
<script type="text/javascript">
$(document).on("click", ".editleavetypes", function () {
    var editdetails = $(this).data('id');
    var x = editdetails.split("~",9);
    var id = x[0];
    var name = x[1];
    var shortname = x[2];
    var isearnedleave = x[3];
    var isshrleave = x[4];
    var isoptionalholiday = x[5];
    var company = x[6];
    var isattendance = x[7];
    var isattendanceorder = x[8];
    $(".modal-body #leavetypename").val(name);
    $(".modal-body #leavetypeshtname").val(shortname);
    $(".modal-body #uniqueid").val(id);
    $(".modal-body #showinattendance_order").val(isattendanceorder);
    
    if(isearnedleave == 1){
        $("#earnedleave").prop("checked", true);
    }else{
        $("#earnedleave").prop("checked", false);
    }
    if(isshrleave == 1){
        $("#shortleave").prop("checked", true);
    }else{
        $("#shortleave").prop("checked", false);
    }
    if(isoptionalholiday == 1){
        $("#optleave").prop("checked", true);
    }else{
        $("#optleave").prop("checked", false);
    }
    if(isattendance == 1){
        $("#showinattendance").prop("checked", true);
    }else{
        $("#showinattendance").prop("checked", false);
    }
    $('#cmpname option[value='+company+']').attr("selected", "selected");
});

function saveeditleavetype(){
    var uniqueid = $("#uniqueid").val();
    if (uniqueid == 0 || uniqueid == "") {
        alert("Error uniqueid is not there unable to process update");
        return false;
    }

    var cmpname = $("#cmpname").val();
    if (cmpname == 0 || cmpname == "") {
        $("#cmpname").focus();
        $('#compnameerror').html("Please Select company");
        return false;
    } else {
        $('#compnameerror').html("");
    }

    var leavetypename = $("#leavetypename").val();
    if (leavetypename == 0 || leavetypename == "") {
        $("#leavetypename").focus();
        $('#leavetypenameerror').html("Please Select leave type name");
        return false;
    } else {
        $('#leavetypenameerror').html("");
    }

    var leavetypeshtname = $("#leavetypeshtname").val();
    if (leavetypeshtname == 0 || leavetypeshtname == "") {
        $("#leavetypeshtname").focus();
        $('#leavetypeshtnameerror').html("Please Select leave type shortname");
        return false;
    } else {
        $('#leavetypeshtnameerror').html("");
    }
    var earnedleave = 0;
    var shortleave = 0;
    var optleave = 0;
    var showinattendance = 0;
    if($('input[name="shortleave"]').is(':checked')){
        shortleave = 1;
    }
    if($('input[name="earnedleave"]').is(':checked')){
        earnedleave = 1;
    }
    if($('input[name="optleave"]').is(':checked')){
        optleave = 1;
    }
    if($('input[name="showinattendance"]').is(':checked')){
        showinattendance = 1;
    }
    var showinattendance_order  = $("#showinattendance_order").val();
    
    var mainurl = baseurl+'admin/saveleavetypes';
$.ajax({
    url: mainurl,
    type: 'POST',
    data: {id : uniqueid, cmpname : cmpname, leavetypename : leavetypename, leavetypeshtname:leavetypeshtname, earnedleave:earnedleave, shortleave:shortleave, optleave:optleave,showinattendance:showinattendance,showinattendance_order:showinattendance_order},
    success: function (data) {
      if (data == 200) {
        alert('Successfully Created');
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }else {
        alert('Failed To Save Please TryAgain later');
      }
    },
});
}
</script>