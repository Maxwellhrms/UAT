
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
													<th>T0</th>
                                                    <th>Desc</th>
													<th>Apply Type </th>
                                                    <th>Auth1</th>
                                                    <th>Auth2</th>
                                                    <th>Auth3</th>
                                                    <th>Auth4</th>
                                                    <th>HR</th>
                                                    <th>Final Hr</th>
                                                </tr>
											</thead>
                                            <tbody>
                                                <?php             
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
                                                    <td><?php echo $authv['emp_description']; ?></td>
													<td><?php echo $authv['leavetypename']; ?></td>
                                                    <td>
                                                    <?php echo $authv['authemp1'];
                                                     if($authv['auth1status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth1status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth1'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }  ?> </td>
                                                    <td><?php echo $authv['authemp2']; 
                                                    if($authv['auth2status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth2status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{if(!empty($authv['auth2'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php }  } ?>
                                                    </td>
                                                    
                                                    <td><?php echo $authv['authemp3']; 
                                                    if($authv['auth3status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth3status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth3'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }   ?></td>

                                                    <td><?php echo $authv['authemp4']; 
                                                    if($authv['auth4status'] == 1){ ?>
                                                        <span style="color:#00802b">Approved </span>
                                                    <?php }elseif($authv['auth4status'] == 2){ ?>
                                                        <span style="color:#e62e00">Rejected </span>
                                                   <?php  }else{ if(!empty($authv['auth4'])){ ?>
                                                          <span style="color:#0066ff">Wating for approval </span>
                                                   <?php  } }   ?></td>

                                                   <td>
                                                   <?php echo $authv['authfinalemp'] ?>
                                                  <?php   if($authv['authfinalstatus'] == 1){ ?>
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
                                                  <?php if($authv['finalacceptstatus'] == 1){ ?>
                                                       <td><a type="button" class="btn btn-info" style="color:#fff" onclick="finalhraccept('<?php echo $authv["uniqid"] ?>','<?php echo $authv["employeeid"] ?>')" >Approve</a></td>
                                                    <?php  }else{ ?>
                                                         <td></td>
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
                    
<script type="text/javascript">
    function finalhraccept(uniqid,empid){
        var ck = confirm("Do You Want To Accept the leave for employeeid "  + empid);
        if(ck == true){
    		mainurl = baseurl+'mobileapidisplay/hrfinalapproveleaveaccept';
    		$.ajax({
    	        url: mainurl,
    	        type: 'POST',
    	        data: {uniqid : uniqid, empid : empid },
    	        success: function (data) {
    				// console.log(data);
    				alert(data);
    	            //if (data == 200) {
    				// 	alert('Success');
    		        //  window.location.reload();
                    //  } else if (data == 420) {
                    //  alert('Failed To Adjuest Leave Rollback Please Try  later');
                    //   return false;
                    //    } 
    	        },
        	});
        }
    }
</script>		
               
</script>

                    