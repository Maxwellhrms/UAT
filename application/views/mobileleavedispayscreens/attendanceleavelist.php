<?php  
// echo '<pre>'; print_r($authresult);
   if( $authresult['status'] !=200){
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
													<th>Division Name</th>
													<th>State Name</th>
													<th>Branch Name</th>
													<th>From </th>
													<th>TO</th>
													<th>No Of Days</th>
                                                    <th>Desc</th>
													<th>Apply Type </th>
													<th>Applied Date</th>
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
                                                    <th>Final Hr</th>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php             
                                                 
                                                // foreach($authresult['userdata'][1] as $val){
                                                    if(sizeof($authresult['attendancelist']) > 0 ){
                                                    foreach($authresult['attendancelist'] as $authv){ ?>
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
													<td><?php echo $authv['from'].'<br>'.$authv['intime']; ?></td>
													<td><?php echo $authv['to'].'<br>'.$authv['outtime']; ?></td>
													<td><?php echo $authv['mxar_noofdays']; ?></td>
                                                    <td><?php echo $authv['emp_description']; ?></td>
													<td><?php echo $authv['leavetypename']; ?></td>
													<td><?php echo $authv['mxar_createdtime']; ?></td>
													<td> 
    													<?php if($authv['finalacceptstatus'] == 3){  ?>
            													  <span style="color:#00802b"> Final Hr Accepted</span>
            											<?php }elseif($authv['authfinalstatus'] == 1){ ?>
    													          <span style="color:#00802b">Approved </span>
            											<?php }elseif($authv['authfinalstatus'] == 2){  ?>
            													  <span style="color:#e62e00">Rejected </span>
            											<?php }else{ ?>
            													  <span style="color:#0066ff">Pending for approval </span>
            											<?php } ?>
													</td>
                                                    <td>
                                                    <?php echo $authv['authemp1'];
                                                     if($authv['auth1status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth1status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth1'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }  ?> </td>
                                                   <td><?php echo $authv['mxar_auth1_approve_date']; ?> </td>
                                                    <td><?php echo $authv['authemp2']; 
                                                    if($authv['auth2status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth2status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{if(!empty($authv['auth2'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php }  } ?>
                                                    </td>
                                                    <td><?php echo $authv['mxar_auth2_approve_date']; ?> </td>

                                                    <td><?php echo $authv['authemp3']; 
                                                    if($authv['auth3status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth3status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth3'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }   ?></td>
                                                   <td><?php echo $authv['mxar_auth3_approve_date']; ?> </td>

                                                    <td><?php echo $authv['authemp4']; 
                                                    if($authv['auth4status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth4status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth4'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }   ?></td>
                                                   <td><?php echo $authv['mxar_auth4_approve_date']; ?> </td>

                                                   <td>
                                                   <?php  echo $authv['authfinalemp']; ?>
                                                    <?php  if($authv['authfinalstatus'] == 1){ ?>
                                                            <span style="color:#00802b">Accepted </span>
                                                    <?php }elseif($authv['authfinalstatus'] == 2){ ?>
                                                            <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['authfinalstatus'])){ ?>
                                                            <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } } 
                                                       if($authv['authfinal'] != $authv['finalhracceptid']){
                                                           echo $authv['hrfinalempname']; 
                                                        if($authv['authfinalstatus'] == 1){ ?>
                                                            <span style="color:#00802b">Accepted </span>
                                                        <?php }elseif($authv['authfinalstatus'] == 2){ ?>
                                                            <span style="color:#e62e00">Rejected </span>
                                                       <?php  }else{ 
                                                            if(!empty($authv['authfinalstatus'])){ ?>
                                                              <span style="color:#0066ff">Wating for approval </span>
                                                       <?php  } } } ?>
                                                   </td>
                                                   <td><?php echo $authv['mxar_authfinal_approve_date']; ?> </td>
													<td>
                                                        <button class ="btn btn-primary attndreg" data-toggle="modal" data-target="#attreg" data-id="<?php echo $authv['uniqid'] .'~'.$authv['authfinalstatus'].'~'.$authv['auth1desc'].'~'.$authv['auth2desc'] .'~'.$authv['auth3desc'] .'~'.$authv['authfinaldesc']  ?>">Approve</button>
                                                    </td>
                                                    <?php if($authv['finalacceptstatus'] == 1){ ?>
                                                       <td>Watting for final hr accept</td>
                                                    <?php  }else if($authv['finalacceptstatus'] == 3){ ?>
                                                         <td> Final Hr Approved </td>
                                                    <?php }else{ ?>
                                                    <td> </td>
                                                    <?php } ?>
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
								<h3>Attendance Leave Accept</h3>
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
                                                <tr> <td id="auth1desc"></td>
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
    e.preventDefault();
    // var employeeid = '<?php // echo $this->session->userdata('user_id'); ?>';
    var mainurl = baseurl+'mobileapidisplay/approveauthleaveattendance';
    var formData = new FormData(this);
    formData.append("finalhraccept",0);

  //  formData.append("employeeid",employeeid);
  //  formData.append("deviceid","Admin");

    $.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        success: function (data) {
            //  console.log(data);
                alert(data);
            // if (data == 200) {
            //     alert('Successfully');
                window.location.reload();
            // }else{
            //     alert('Failed');
            // }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>

                    