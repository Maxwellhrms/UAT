<?php
$type = array('1'=>'Appoinment','2'=>'Manager Appoinment','3'=>'Offer Letter','4'=>'Confirmation Letter');
$app_status = array('1'=>'Issued','2'=>'Joined','3'=>'Rejected','4'=>'Confirmed');
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Type Of Letter</label>
            <select class="select select2 form-control" name="typeofletter" id="typeofletter" style="width: 100%;" onchange="lettertypes()">
                <option value="">Select Letter Type</option>
                <?php foreach ($type as $key => $stvalue) { ?>
                    <option value="<?php echo $key ?>" <?php if($key == $list[0]->typeofletter){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $stvalue ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Status</label>
            <select class="select select2 form-control" name="letter_status" id="letter_status" style="width: 100%;">
                <option value="">Select Status</option>
                <?php foreach ($app_status as $apkey => $apstvalue) { ?>
                    <option value="<?php echo $apkey ?>" <?php if($apkey == $list[0]->letter_status){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $apstvalue ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Name of Person</label>
            <input class="form-control" type="text" name="personname" id="personname" value="<?php echo $list[0]->personname ?>">
        </div>
    </div>
    <div class="col-md-3" id="emp_dis">
        <div class="form-group">
            <label>Employee ID</label>
            <input class="form-control" type="text" name="employeecode" id="employeecode" value="<?php echo $list[0]->employeecode ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>TemplateID</label>
                <select class="select select2 form-control"  name="templateid" id="templateid" style="width: 100%;">
                <option value="">Select Template</option>
                <?php foreach ($templates as $tkey => $tvalue) { ?>
                    <option value="<?php echo $tvalue->id ?>" <?php if($tvalue->id == $list[0]->templateid){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $tvalue->email_title ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Letter No</label>
            <input class="form-control" type="text" name="letterno" id="letterno" value="<?php echo $list[0]->letterno ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Application Date</label>
            <input class="form-control datetimepicker" type="text" name="appdate" id="appdate" value="<?php echo $list[0]->appdate ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6" id="eff_dis">
        <div class="form-group">
            <label>Effective / Joining / Appoinment Date</label>
            <input class="form-control datetimepicker" type="text" name="effectivedate" id="effectivedate" value="<?php echo $list[0]->effectivedate ?>">
        </div>
    </div>
    <div class="col-md-6" id="intreview_dis">
        <div class="form-group">
            <label>Intreview Date</label>
            <input class="form-control datetimepicker" type="text" name="interviewdate" id="interviewdate" value="<?php echo $list[0]->interviewdate ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6" id="designation_dis">
        <div class="form-group">
            <label>Designation</label>
            <select class="select select2 form-control" name="designation" id="designation" style="width: 100%;">
                <option value="">Select designation</option>
                <?php foreach ($des as $dkey => $dvalue) { ?>
                    <option value="<?php echo $dvalue->mxdesg_name ?>" <?php if($dvalue->mxdesg_name == $list[0]->designation){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $dvalue->mxdesg_name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6" id="department_dis">
        <div class="form-group">
            <label>Department</label>
            <select class="select select2 form-control" name="department" id="department" style="width: 100%;">
                <option value="">Select branch</option>
                <?php foreach ($dep as $bkey => $bvalue) { ?>
                    <option value="<?php echo $bvalue->mxdpt_name ?>" <?php if($bvalue->mxdpt_name == $list[0]->department){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $bvalue->mxdpt_name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-6" id="branch_dis">
        <div class="form-group">
            <label>Branch</label>
            <select class="select select2 form-control" name="branch" id="branch" style="width: 100%;" onchange="getbranchaddress()">
                <option value="">Select branch</option>
                <?php foreach ($branch as $bkey => $bvalue) { ?>
                    <option value="<?php echo $bvalue->mxb_name ?>" <?php if($bvalue->mxb_name == $list[0]->branch){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $bvalue->mxb_name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="col-md-6" id="placeofposting_dis">
        <div class="form-group">
            <label>Place of Posting</label>
            <input class="form-control" type="text" name="placeofposting" id="placeofposting" value="<?php echo $list[0]->placeofposting ?>">
        </div>
    </div>
    <div class="col-md-6" id="sal_dis">
        <div class="form-group">
            <label>Salary</label>
            <input class="form-control" type="text" name="salary" id="salary" value="<?php echo $list[0]->salary ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6" id="basic_dis">
        <div class="form-group">
            <label>Basic</label>
            <input class="form-control" type="text" name="basic" id="basic" value="<?php echo $list[0]->basic ?>">
        </div>
    </div>
    <div class="col-md-6" id="hra_dis">
        <div class="form-group">
            <label>HRA</label>
            <input class="form-control" type="text" name="hra" id="hra" value="<?php echo $list[0]->hra ?>">
        </div>
    </div>
</div>
<div class="row" id="reporting_dis">
    <div class="col-md-6">
        <div class="form-group">
            <label>Reporting To</label>
            <input class="form-control" type="text" name="reportingto" id="reportingto" value="<?php echo $list[0]->reportingto ?>">
        </div>
    </div>
</div>
<div class="row" id="desc_dis">
    <div class="col-md-12">
        <div class="form-group">
            <label>Employee Address</label>
            <textarea class="form-control" id="desc" name="desc"><?php echo $list[0]->address ?></textarea>
        </div>
    </div>
</div>
<div class="row" id="bdesc_dis">
    <div class="col-md-12">
        <div class="form-group">
            <label>Branch Address</label>
            <textarea class="form-control" id="bdesc" name="bdesc"><?php echo $list[0]->branchaddress ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>PDF</label>
            <textarea class="form-control" id="pdfdata" name="pdfdata"><?php echo $list[0]->pdfdata ?></textarea>
        </div>
    </div>
</div>
<input type="hidden" name="id" id="trnsid" value="<?php echo $list[0]->id ?>">
<div class="submit-section">
    <button class="btn btn-primary submit-btn">Submit</button>
    <?php if(!empty($list[0]->pdfdata)){ ?>
    <a target="_blank" href="<?php echo base_url().'Recruitment/openletterpdf?id='.$list[0]->id ?>" class="btn btn-info submit-btn">PDF</a>
    <?php } ?>
</div>
<script type="text/javascript">
lettertypes();
    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            format: 'DD-MM-YYYY',
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down",
                next: 'fa fa-angle-right',
                previous: 'fa fa-angle-left'
            }
        });
    }
    
    function lettertypes(){
        var lettertype =  $("#typeofletter").val();
        if(lettertype == 1 || lettertype == 2){
            if($("#letterno").val() == ''){
                $("#letterno").val('MAXWELL/SBD/PER & HR/APT/');
            }
            $("#eff_dis").hide();
            $("#intreview_dis").hide();
            $("#emp_dis").show();
            $("#sal_dis").show();
            $("#basic_dis").show();
            $("#hra_dis").show();
            $("#reporting_dis").hide();
            $("#designation_dis").show();
            $("#department_dis").show();
            $("#branch_dis").show();
            $("#placeofposting_dis").show();
            $("#desc_dis").show();
            $("#bdesc_dis").show();
        }else if(lettertype == 3){
            if($("#letterno").val() == ''){
            $("#letterno").val('MAXWELL/SBD/PER & HR/OFFER/');
            }
            $("#eff_dis").show();
            $("#intreview_dis").show();
            $("#reporting_dis").show();
            $("#emp_dis").hide();
            $("#sal_dis").hide();
            $("#basic_dis").hide();
            $("#hra_dis").hide();
            $("#designation_dis").show();
            $("#department_dis").show();
            $("#branch_dis").show();
            $("#placeofposting_dis").show();
            $("#desc_dis").show();
            $("#bdesc_dis").show();
        }else if(lettertype == 4){
            if($("#letterno").val() == ''){
                $("#letterno").val('MAXWELL/SBD/PER & HR/CNF/');
            }
            $("#eff_dis").show();
            $("#intreview_dis").show();
            $("#reporting_dis").hide();
            $("#emp_dis").show();
            $("#sal_dis").hide();
            $("#basic_dis").hide();
            $("#hra_dis").hide();
            $("#designation_dis").hide();
            $("#department_dis").hide();
            $("#branch_dis").show();
            $("#placeofposting_dis").hide();
            $("#desc_dis").hide();
            $("#bdesc_dis").hide();
        }
    }
    
    function getbranchaddress(){
        var branchname =  $("#branch").val();
        mainurl = baseurl+'Recruitment/getbranchaddress';
        $.ajax({
         url: mainurl,
         type: 'POST',
         data: {"branchname":branchname},
         success: function (data) {
            $("#bdesc").html(data);
            },
        }); 
    }
</script>
<script>
	$(function() {
// 		$('.select2').select2({dropdownAutoWidth: 'true',width: 'auto'});
// 		dropdownParent: $("#add_client_popup")
$('.select2').each(function () {
    $(this).select2({
        // theme: 'bootstrap-5',
        dropdownAutoWidth: 'true',
        width: 'auto',
        dropdownParent: $(this).parent(),
    });
});
	})
</script>