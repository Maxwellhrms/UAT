   <!-- Search Filter -->
   <form method="post" id="<?php echo $selectedFilter['FormId']; ?>" class="applymultiselect">
       <div class="row filter-row">
          <?php if($selectedFilter['fromdatefilter'] == 'Y'){ ?>
              <div class="col-sm-6 col-md-2"> 
                 <div class="form-group form-focus select-focus">
                    <input type="text" class="form-control datetimepicker1" name="fromdate" id="fromdate" autocomplete="off">
                    <label class="focus-label">From Date</label> 
                </div>
            </div>
        <?php } ?>

        <?php if($selectedFilter['todatefilter'] == 'Y'){ ?>
          <div class="col-sm-6 col-md-2"> 
             <div class="form-group form-focus select-focus">
                <input type="text" class="form-control datetimepicker1" name="todate" id="todate" autocomplete="off">
                <label class="focus-label">To Date</label> 
            </div>
        </div>
    <?php } ?>


    <?php if($selectedFilter['monthyearfilter'] == 'Y'){ ?>
      <div class="col-sm-4 col-md-3 attndyear_div"> 
         <div class="form-group form-focus select-focus">
            <input type="text" class="form-control monthyearselect" name="monthyear" id="monthyear" autocomplete="off">
            <label class="focus-label">Month Year</label> 
        </div>
    </div>
<?php } ?>

<?php if($selectedFilter['yearfilter'] == 'Y'){ ?>
    <div class="col-sm-6 col-md-3"> 
        <div class="form-group form-focus select-focus">
            <select class="select select2" style="width: 100%" name="year" id="year"> 
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

    <?php if($selectedFilter['daysfilter'] == 'Y'){ ?>
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus">
                <select class="select select2" style="width: 100%" name="days" id="days"> 
                    <option value="">Select Day </option>
                    <?php for($i=1; $i<=31 ; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
                <label class="focus-label">Select Day</label>
            </div>
            <span class="formerror" id="categeory_error"></span>
        </div>
    <?php } ?>

    <?php if($selectedFilter['companyfilter'] == 'Y'){ ?>
      <div class="col-sm-6 col-md-3"> 
         <div class="form-group form-focus select-focus">
            <select class="select select2" style="width: 100%" name="esi_company_id" id="esi_company_id"> 
                <option value=""> Select Company </option>
                <?php foreach ($companyFilter as $key => $cmpvalue) { ?>
                    <option value="<?php echo $cmpvalue->mxcp_id ?>"><?php echo $cmpvalue->mxcp_name ?></option>
                <?php } ?>
            </select>
            <label class="focus-label">Select Company</label>
        </div>
        <span class="formerror" id="cmpnameerror"></span>
    </div>
<?php } ?>


<?php if($selectedFilter['divisionfilter'] == 'Y'){ ?>         
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

<?php if($selectedFilter['statefilter'] == 'Y'){ ?>
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

<?php if($selectedFilter['branchfilter'] == 'Y'){ ?>
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

               <?php if($selectedFilter['employeecodeFilter'] == 'Y'){ ?>
                  <div class="col-sm-6 col-md-3">  
                     <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="employeecode" id="employeecode">
                        <label class="focus-label">Employee Code</label>
                    </div>
                </div>
            <?php } ?>

            <?php if($selectedFilter['customoption'] == 'Y'){ ?>
               <div class="col-sm-6 col-md-2"> 
                    <div class="form-group form-focus select-focus">
                        <!-- <select class="select select2" style="width: 100%"  name="customoption_<?php //echo $selectedFilter['customvalue']['Type']; ?>" id="customoption_<?php echo $selectedFilter['customvalue']['Type']; ?>">  -->
                        <select class="select select2" style="width: 100%"  name="customoption" id="customoption"> 
                        <option value="ALL"> ALL </option>
                            <?php foreach ($customOptions as $custkey => $custvalue) { ?>
                                <option value="<?php echo $custvalue->field_value ?>"><?php echo strtoupper($custvalue->descr); ?></option>
                            <?php } ?>
                        </select>
                        <label class="focus-label">Select <?php echo $selectedFilter['customvalue']['Type']; ?></label>
                    </div>
                    <span class="formerror" id="customoption_<?php echo $selectedFilter['customvalue']['Type']; ?>error" ></span>
                </div>
           <?php } ?>

            <?php if($selectedFilter['leavestatus'] == 'Y'){ ?>
            <div class="col-sm-6 col-md-2"> 
                <div class="form-group form-focus select-focus">
                    <select class="select select2" style="width: 100%" name="leavestatus" id="leavestatus"> 
                        <option value="ALL"> ALL </option>
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                            <option value="3">HR Approved</option>
                    </select>
                    <label class="focus-label">Select Status</label>
                </div>
                <span class="formerror" id="leavestatuserror"></span>
            </div>
            <?php } ?>


            <?php if($selectedFilter['customregulation'] == 'Y'){ ?>
            <div class="col-sm-6 col-md-2"> 
                <div class="form-group form-focus select-focus">
                    <select class="select select2" style="width: 100%" name="regulationtype" id="regulationtype"> 
                        <option value="ALL"> ALL </option>
                            <option value="AR">AR</option>
                            <option value="OT">OT</option>
                          
                    </select>
                    <label class="focus-label">Select Regulation</label>
                </div>
                <span class="formerror" id="regulationtypeerror"></span>
            </div>
            <?php } ?>

            <?php if($selectedFilter['issynced'] == 'Y'){ ?>
                <div class="col-sm-6 col-md-3">  
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                           Is Synced &nbsp;
                       </label>
                       <input type="checkbox" name="issynced" id="issynced" value="1">
                       <span class="formerror" id="issyncederror"></span>
                   </div>
               </div>
           <?php } ?>
           <div class="col-sm-6 col-md-3">  
             <button id="searchemployeefilterdata" class="btn btn-success btn-block" type="button" onclick="buildDynamicTable('<?php echo $selectedFilter['FormId']; ?>', '<?php echo $selectedFilter['CallFunction']; ?>','<?php echo $selectedFilter['displayrptlocation']; ?>')"> Search </button>  
         </div>     
     </div>
 </form>
<!-- /Search Filter -->	

 <hr>   
 <div class="row">
    <div class="col-md-12">
        <div class="table-responsive" id="display_datatables">
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Attendance</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Your content here
            </div>

        </div>
    </div>
</div>
<!-- Modal -->

<script>
$(window).on('load', function () {
    setTimeout(function () {
        $('#searchemployeefilterdata').trigger('click');
    }, 800);
});
</script>