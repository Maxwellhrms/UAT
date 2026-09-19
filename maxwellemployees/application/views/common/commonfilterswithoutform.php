   <!-- Search Filter -->
    <?php if($selectedFilter['fromdatefilter'][0] == 'Y'){ ?>
          <div class="col-sm-6 col-md-2"> 
             <div class="form-group form-focus select-focus">
                <input type="text" class="form-control datetimepicker1" name="<?php echo $selectedFilter['fromdatefilter'][1]; ?>" id="<?php echo $selectedFilter['fromdatefilter'][1]; ?>" value="<?php echo !empty($selectedFilter['fromdatefilter']['default']) ? $selectedFilter['fromdatefilter']['default'] : ''; ?>" autocomplete="off">
                <label class="focus-label">From Date</label> 
            </div>
        </div>
    <?php } ?>

    <?php if($selectedFilter['todatefilter'][0] == 'Y'){ ?>
      <div class="col-sm-6 col-md-2"> 
         <div class="form-group form-focus select-focus">
            <input type="text" class="form-control datetimepicker1" name="<?php echo $selectedFilter['todatefilter'][1]; ?>" id="<?php echo $selectedFilter['todatefilter'][1]; ?>" value="<?php echo !empty($selectedFilter['todatefilter']['default']) ? $selectedFilter['todatefilter']['default'] : ''; ?>" autocomplete="off">
            <label class="focus-label">To Date</label> 
        </div>
    </div>
    <?php } ?>
    <?php if($selectedFilter['monthyearfilter'][0] == 'Y'){ ?>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
            <div class="form-group form-focus">
                <div class="cal-icon">
                    <input class="form-control floating monthyearpicker" name="<?php echo $selectedFilter['monthyearfilter'][1]; ?>" id="<?php echo $selectedFilter['monthyearfilter'][1]; ?>" type="text" value="<?php echo !empty($selectedFilter['monthyearfilter']['default']) ? $selectedFilter['monthyearfilter']['default'] : ''; ?>">
                </div>
                <label class="focus-label">Month Year</label>
            </div>
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
  <div class="col-sm-6 col-md-2"> 
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
  <div class="col-sm-6 col-md-2"> 
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
  <div class="col-sm-6 col-md-2"> 
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
        <?php if($selectedFilter['manageremployees'][0] == 'Y'){ ?>
           <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                <div class="form-group form-focus select-focus">
                    <select class="select2 floating" name="<?php echo $selectedFilter['manageremployees'][1]; ?>" id="<?php echo $selectedFilter['manageremployees'][1]; ?>"> 
                        <option value="ALL"> ALL </option>
                        <?php foreach ($assignedemployees as $key => $val) { ?>
                            <option value="<?php echo $val['mxauth_emp_code'] ?>"> <?php echo $val['mxemp_emp_fname'].' ('.$val['mxauth_emp_code'].')'; ?> </option>
                        <?php } ?>
                    </select>
                    <label class="focus-label">Employees</label>
                </div>
           </div>
        <?php } ?>
            <?php if($selectedFilter['attendanceSection'] == 'Y'){ ?>
            <div class="col-sm-6 col-md-2"> 
                <div class="form-group form-focus select-focus">
                    <select class="select select2" style="width: 100%" name="attendanceSection" id="attendanceSection">
                            <option value="1" selected>First Half</option>
                            <option value="2">Second Half</option>
                            <option value="3">Full Day</option>
                    </select>
                    <label class="focus-label">Select Attendance Section</label>
                </div>
                <span class="formerror" id="attendanceSectionerror"></span>
            </div>
            <?php } ?>
            <?php if($selectedFilter['appraisalcategory'][0] == 'Y'){ ?>
            <div class="col-sm-6 col-md-2"> 
                <div class="form-group form-focus select-focus">
                    <select class="select select2" style="width: 100%" name="<?php echo $selectedFilter['appraisalcategory'][1]; ?>" id="<?php echo $selectedFilter['appraisalcategory'][1]; ?>">
                            <option value="1" selected>KRA</option>
                            <option value="2">KEY COMPENTENCIES</option>
                    </select>
                    <label class="focus-label">Select Appraisal Category</label>
                </div>
                <span class="formerror" id="<?php echo $selectedFilter['appraisalcategory'][1].'error'; ?>"></span>
            </div>
            <?php } ?>
            <?php if($selectedFilter['appraisaltype'][0] == 'Y'){ ?>
            <div class="col-sm-6 col-md-2"> 
                <div class="form-group form-focus select-focus">
                    <select class="select select2" style="width: 100%" name="<?php echo $selectedFilter['appraisaltype'][1]; ?>" id="<?php echo $selectedFilter['appraisaltype'][1]; ?>">
                            <option value="1" selected>Self</option>
                            <option value="2">Reviewer</option>
                    </select>
                    <label class="focus-label">Select Appraisal Type</label>
                </div>
                <span class="formerror" id="<?php echo $selectedFilter['appraisaltype'][1].'error'; ?>"></span>
            </div>
            <?php } ?>
        <?php if($selectedFilter['appraisalemployees'][0] == 'Y'){ ?>
           <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                <div class="form-group form-focus select-focus">
                    <select class="select2 floating" name="<?php echo $selectedFilter['appraisalemployees'][1]; ?>" id="<?php echo $selectedFilter['appraisalemployees'][1]; ?>"> 
                        <option value=""> Select Employee </option>
                        <?php foreach ($appraisalemployees as $key => $val) { ?>
                            <option value="<?php echo $val['employeecode'] ?>"> <?php echo $val['employeename'].' ('.$val['employeecode'].')'; ?> </option>
                        <?php } ?>
                    </select>
                    <label class="focus-label">Employees</label>
                </div>
           </div>
        <?php } ?>
<!-- /Search Filter -->	