               
                    <?php
                    // $leave_types = ['PR','AB','WO','PH','OH', 'OCH', 'CL', 'SL', 'EL', 'SHRT', 'ML', 'AR', 'OD', 'OT'];
                    $leave_types = getallleavetypescompanywise($userdata['company'],'attendance');
              $firsthalf = array(  'AB' => 'text-danger', 'PR' => 'text-success' ,'WO' => 'WO' , 'PH'=>'PH', 'OPH'=>'OPH', 'ML'=>'ML','PL'=>'PL','CMPL'=>'CMPL',
				     'CL'=>'CL', 'EL'=>'EL','SL'=>'SL', 'SHRT'=>'SHRT', 'HAPL'=>'HAPL','LOP'=>'LOP','AR' => 'AR','OH' => 'OH','OCH' => 'OCH','OD'=>'OD','OT'=>'OT','LTD'=>'LTD');

                 $danger = array('CL','EL','SL','LOP','AR','OH','OCH','OT');
                    $mnth = $userdata['month'];
                    if(strlen($mnth) == 1){
				        $mnth = '0'.$userdata['month'];
				    }
                    $year = $userdata['year'];
                    //  class="table table-striped custom-table table-nowrap mb-0"
                     ?>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="datatable table table-stripped mb-0"  id="dataTables-example">
									<thead>
										<tr>
											<th>#</th>
											<th>Employee</th>
											<th>Branch</th>
											<th style="color:red">Total</th>
											<?php foreach ($leave_types as $key => $shortnametype) { $type = $shortnametype->mxlt_leave_short_name; ?>
												<th style="color:red"><?php echo $type; ?></th>
											<?php } ?>
                                              
          <?php $alldays = array();  $d = cal_days_in_month(CAL_GREGORIAN,$mnth,$year); for ($i=1; $i <= $d; $i++) {  ?>
        <th> <?php $datesm = $i .'-'. $mnth .'-'. $year; echo date("D-d", strtotime($datesm) ); array_push($alldays, date("Y-m-d", strtotime($datesm)));?></th>
          <?php } ?>

										</tr>
									</thead>
									<tbody>
										<tr>
<?php 

$sno =1; foreach ($attnd as $key => $values) { $dates = explode('~*~',$values['dates']); #echo '<pre>'; print_r($dates);?>
<td><?php echo $sno; ?></td>
<td>
	<h2 class="table-avatar">
		<a class="avatar avatar-xs" href="<?php echo base_url().'admin/employeesprofile/'.$values['mxemp_emp_autouniqueid'] ?>" target="_blank"><img alt="" src="<?php echo base_url().$values['mxemp_emp_img'] ?>" width="24px" height="24px"></a>
		<a href="#"><?php echo $values['mx_attendance_emp_code']; ?></a>
		&nbsp;-&nbsp; <a href="#"><?php echo $values['fullname']; ?></a>
	</h2>
</td>
          <td><?php echo $values['mxb_name']; ?></td>
          <td><span style="color:red"><?php echo $d ?>
          <?php if(count($leave_types) > 0){ ?>
          /</span><?php echo $values['totaldays']; ?>
          <?php } ?>
          </td>
		<?php foreach ($leave_types as $key => $shortnametype) { $type = $shortnametype->mxlt_leave_short_name; ?>
			<td><?php echo $values[$type]; ?></td>
		<?php } ?>
		<?php 
		 foreach ($dates as $keys2 => $valuesat) {
		 	$dda = explode('~',$valuesat); 
		 	$pr = explode('-',str_replace("'","",$dda[0]));
      $pr0 = str_replace(",", "", $pr[0]);
      $pr1 = str_replace(",", "", $pr[1]);
		 

		 	if($dda[1] == ''){continue;}
		 	$db_employee_dates1['first'] = $pr0;
		 	$db_employee_dates1['second'] = $pr1;
		 	$db_employee_dates1['attnd_unique_id'] = $dda[2];
		 	$db_employee_dates1['database_date'] = $dda[1];
		 	$db_employee_dates[$dda[1]] = $db_employee_dates1;

		 }
		 #echo "<pre>";print_r($db_employee_dates);exit;
		 foreach ($alldays as $allkey => $allval) {
		 	#echo "<pre>";print_r($db_employee_dates[$allval]);exit;
		 	if(isset($db_employee_dates[$allval])){   #echo "<pre>";print_r($db_employee_dates[$allval]['database_date']);exit;
		 	 ?>

	   		<td>
	   		    <a class="cursor-pointer" onclick= "employeeattendanceinfo('<?php echo $db_employee_dates[$allval]['database_date'] ?>','<?php echo $values['mx_attendance_emp_code']?>','<?php echo $db_employee_dates[$allval]['attnd_unique_id'] ?>')"  data-toggle="modal" data-target="#attendance_info" >
			  	   <?php 
			  	   
							$pr0 = $db_employee_dates[$allval]['first'];
							$pr1 = $db_employee_dates[$allval]['second'];
			  	   if($pr0 == $pr1){
						if(array_key_exists($pr0,$firsthalf) ) {
							if($pr0 == $firsthalf[$pr0]){ ?>
						<?php	echo $pr0; }else{ ?> 
						<span class="<?php echo $firsthalf[$pr0] ?>" ><?php echo $pr0 ?></span>
							<?php } ?>
						<?php }
				 	}else{
						if(array_key_exists($pr0,$firsthalf) ) {
							if($pr0 == $firsthalf[$pr0]){ ?>
								<?php echo $pr0; ?>
							<?php }else{ ?>
								 <span class="<?php echo $firsthalf[$pr0] ?>" ><?php echo $pr0 ?></span>
							<?php } ?>				
						<?php } 
						if(array_key_exists($pr1,$firsthalf) ) {
							if($pr1 == $firsthalf[$pr1]){ ?>
								<?php  echo $pr1; ?>
						<?php } else{ ?>
								<span class="<?php echo $firsthalf[$pr1] ?>" ><?php echo $pr1 ?></span>
						<?php }
				    	}  
					} ?>
			    </a> 
			</td>

		 <?php 	}else{
		 		echo '<td><s>'.$allval.'</s></td>';
		 	}
		 }
		 ?>

			</tr>
<?php $sno++; $db_employee_dates = array(); $db_employee_dates1 = array();} ?>
											
										

									</tbody>
								</table>
							</div>
                        </div>
                    </div>