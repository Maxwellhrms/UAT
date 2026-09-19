<?php 
   if( $authresult['status'] !=200){
    //   echo $authresult['description']; exit;
    //  echo $data = "<b> No Data Found </b>"; die;
 } ?>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <div class="card mb-0">					
                                <div class="card-header">
									<h4 class="card-title mb-0">Employees List</h4>
								</div>
                                <div class="card-body">	
									<div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example1">
											<thead>
												<tr>
													<th>Employee ID</th>
													<th>Name</th>
													<th>Category Type</th>
													<th>Division</th>
													<th>State</th>
													<th>Branch</th>
													<th>From </th>
													<th>To</th>
													<th>Auto Time</th>
													<th>Manual Time</th>
													<th>Applied By</th>
													<th>Applied Date</th>
                                                    <th>Desc</th>
													<th>Apply Type </th>
													<th>Client Company</th>
													<th>Client Name</th>
													<th>Client Email</th>
													<th>Client Mobile</th>
													<th>Client Desc</th>
													<th>Status</th>
                                                    <th>Auth1</th>
                                                    <th>Auth1 Approved Date</th>
                                                    <th>Auth2</th>
                                                    <th>Auth2 Approved Date</th>
                                                    <th>Auth3</th>
                                                    <th>Auth3 Approved Date</th>
                                                    <th>Auth4</th>
                                                    <th>Auth4 Approved Date</th>
                                                    <th>HR</th>
                                                    <th>Auth Final Approved Date</th>
                                                    <th>Edit</th>
                                                    <th>Revert</th>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php  // echo '<pre>';   print_r($authresult['attendancelist']);exit;                                         
                                                // foreach($authresult['userdata'][1] as $val){
                                                    if(sizeof($authresult['attendancelist']) > 0 ){
                                                    foreach($authresult['attendancelist'] as $authv){
                                                    ?>
                                            <tr>
													<td><?php echo $authv['employeeid']; ?></td>
													<td><?php echo $authv['employeename']; ?></td>
                                                    <?php if($authv['category_type'] == 1){ 
                                                            $catyp = "First Half";
                                                    }elseif($authv['category_type'] == 2){
                                                            $catyp = "Second Half";
                                                    }elseif($authv['category_type'] == 3){ 
                                                            $catyp = "Full Day";
                                                    }?>
                                                    
                                                    <td><?php echo $catyp; ?></td>
                                                    <td><?php echo $authv['divisionname']; ?></td>
                                                    <td><?php echo $authv['statename']; ?></td>
													<td><?php echo $authv['branchname']; ?></td>
													<td><?php echo $authv['from']; ?></td>
													<td><?php echo $authv['to']; ?></td>
													<td><?php $autotimes = getemployeefirstandlastpunches($authv['from'],$authv['employeeid']); echo $autotimes[0]['first_punch'].'<br>'.$autotimes[0]['last_punch'];?></td>
													<td><?php echo $authv['intime'].'<br>'.$authv['outtime']?></td>
													<td><?php echo $authv['mxar_createdby']; ?></td>
													<td><?php echo $authv['mxar_createdtime']; ?></td>
                                                    <td><?php echo $authv['emp_description']; ?></td>
													<td><?php echo $authv['reason']; ?></td>
													<td><?php echo $authv['mxar_client_company']; ?></td>
													<td><?php echo $authv['mxar_client_contact_person']; ?></td>
													<td><?php echo $authv['mxar_client_contact_no']; ?></td>
													<td><?php echo $authv['mxar_client_contact_email']; ?></td>
													<td><?php echo $authv['mxar_client_desc']; ?></td>
													<td>
													    <?php if($authv['authfinalstatus'] == 1){ ?>
    													          <span style="color:#00802b">Approved </span>
            											<?php }elseif($authv['authfinalstatus'] == 2){ ?>
            													  <span style="color:#e62e00">Rejected </span>
            											<?php }else{ ?>
            													  <span style="color:#0066ff">Pending for approval </span>
            											<?php } ?>
            										</td>
													<td><?php echo $authv['authemp1']; ?> </td>
													<td><?php echo $authv['mxar_auth1_approve_date']; ?> </td>
													<td><?php echo $authv['authemp2']; ?></td>
													<td><?php echo $authv['mxar_auth2_approve_date']; ?> </td>
													<td><?php echo $authv['authemp3']; ?></td>
													<td><?php echo $authv['mxar_auth3_approve_date']; ?> </td>
                                                    <td><?php echo $authv['authdirector']; ?></td>
													<td><?php echo $authv['mxar_auth4_approve_date']; ?> </td>
													<td><?php echo $authv['authfinalhr']; ?></td>
													<td><?php echo $authv['mxar_authfinal_approve_date']; ?> </td>
													<td> 
													<?php //if($authv['status2'] == 'Approval'){ ?> 
                                                        <button class ="btn btn-primary attndreg" data-toggle="modal" data-target="#attreg" data-id="<?php echo $authv['uniqid'] .'~'.$authv['authfinalstatus'].'~'.$authv['auth1desc'].'~'.$authv['auth2desc'] .'~'.$authv['auth3desc'] .'~'.$authv['authfinaldesc']  ?>">Approve</button>
                                                    <?php //} ?>
                                                    </td>
                                                     <td>
                                                        <?php if($authv['authfinalstatus'] == 1){  $uniqid = $authv['uniqid'] ?> 
                                                         <button class="btn btn-primary continue-btn " onclick = "revertbutton('<?php echo $uniqid ?>')" id="authrevertbutton" type="submit">Revert</button>
                                                       <?php } ?>
                                                    </td>
												</tr>
                                                <?php } } ?>
                                            <tbody>
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>

                <!-- Add new Leave Type -->
                <div class="modal custom-modal fade" id="attreg" role="dialog">
                <form id="addendregulmodel">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Attendance Regulation Accept</h3>
							</div> 
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-form-label">Select Status</label>
                                        <div class="col-lg-7">
                                            <input type="hidden" name="uniqid" id="unid" >
                                            <select class="form-control select2" name="approve" id="approve" style="width:100%">
                                                <option value="0">-- Select  --</option>
                                                <option value="1">Accepted</option>
                                                <option value="2">Rejected</option>
                                            </select>
                                            <span class="formerror" id="remarkserror"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                      Remarks
                                    </div>
                                </div>
                               <div class="col-xl-12">
                                    <div class="form-group row">
                                      <textarea class="form-control" name="remarks" id="authfinaldesc"  rows="5"></textarea>
                                    </div>
                                </div>  
                                <table class="datatable table table-stripped mb-0" id="dataTables-example1">
											<thead>
												<tr>
													<th>Auth1</th>
													<th>Auth2</th>
													<th>Auth3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>    <td id="auth1desc"></td>
                                                        <td id="auth2desc"></td>
                                                        <td id="auth3desc"></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                <div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary ">Close</a>
									</div>
									<div class="col-6">
										<button class="btn btn-primary continue-btn" id="authbutton" type="submit">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                </form>
			</div>
                        
			<!-- /Add new Leave Type -->

            <script>
            
$("form#addendregulmodel").submit(function (e) {
    // alert('dvbhjv')
    e.preventDefault();
    var mainurl = baseurl+'mobileapidisplay/approveauthreguattendance';
    var formData = new FormData(this);
   
    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            //  console.log(data);
            //  alert(data);
            // if (data == 200) {
            //     alert('Successfully');
        
            // window.location.reload();
            // }else{
            //     alert('Failed');
            // }
            $('#attreg').modal('hide');
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

    function revertbutton(uniqid){
        var ck = confirm("Do You Want To reverted this record will be removed permanently" );
        if(ck ==1){
            var mainurl = baseurl+'mobileapidisplay/authrevert';   
            $.ajax({
                url: mainurl,
                type: 'POST',
                data: {'uniqid':uniqid},
                success: function (data) {
                    if (data == 200) {
                        alert('Successfully updated');
                        // window.location.reload();
                        $( "#searchemployeefilterdata" ).trigger( "click" );
                    }else{
                        alert('Failed');
                    }
                },
            });
        }
    }
    
</script>

                    