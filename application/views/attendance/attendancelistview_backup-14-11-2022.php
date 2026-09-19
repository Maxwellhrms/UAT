               
                    <?php
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
											<th style="color:red">PR</th>
                                              <th style="color:red">AB</th>
                                              <th style="color:red">WO</th>
                                              <th style="color:red">PH</th>
                                              <th style="color:red">OH</th>
                                              <th style="color:red">OCH</th>
                                              <th style="color:red">CL</th>
                                              <th style="color:red">SL</th>
                                              <th style="color:red">EL</th>
                                              <th style="color:red">SHRT</th>
                                              <th style="color:red">ML</th>
                                              <th style="color:red">AR</th>
                                              <th style="color:red">OD</th>
                                              <th style="color:red">OT</th>
                                              
          <?php  $d = cal_days_in_month(CAL_GREGORIAN,$mnth,$year); for ($i=1; $i <= $d; $i++) {  ?>
        <th> <?php $datesm = $i .'-'. $mnth .'-'. $year; echo date("D-d", strtotime($datesm) ); ?></th>
          <?php } ?>

										</tr>
									</thead>
									<tbody>
										<tr>
<?php $sno =1; foreach ($attnd as $key => $values) { $dates = explode('~*~',$values['dates']); ?>
<td><?php echo $sno; ?></td>
<td>
	<h2 class="table-avatar">
		<a class="avatar avatar-xs" href="<?php echo base_url().'admin/employeesprofile/'.$values['mxemp_emp_autouniqueid'] ?>" target="_blank"><img alt="" src="<?php echo base_url().$values['mxemp_emp_img'] ?>" width="24px" height="24px"></a>
		<a href="#"><?php echo $values['mx_attendance_emp_code']; ?></a>
		&nbsp;-&nbsp; <a href="#"><?php echo $values['fullname']; ?></a>
	</h2>
</td>
          <td><?php echo $values['mxb_name']; ?></td>
          <td><span style="color:red"><?php echo $d ?>/</span><?php echo $values['total_OD']+$values['total_PR']+$values['total_AB']+$values['total_WO']+$values['total_PH']+$values['total_OH']+$values['total_OCH']+$values['total_CL']+$values['total_SL']+$values['total_EL']+$values['total_SHRT']+$values['total_ML']+$values['total_AR']; ?></td>
          <td><?php echo $values['total_PR']; ?></td>
          <td><?php echo $values['total_AB']; ?></td>
          <td><?php echo $values['total_WO']; ?></td>
          <td><?php echo $values['total_PH']; ?></td>
          <td><?php echo $values['total_OH']; ?></td>
          <td><?php echo $values['total_OCH']; ?></td>
          <td><?php echo $values['total_CL']; ?></td>
          <td><?php echo $values['total_SL']; ?></td>
          <td><?php echo $values['total_EL']; ?></td>
          <td><?php echo $values['total_SHRT']; ?></td>
          <td><?php echo $values['total_ML']; ?></td>
          <td><?php echo $values['total_AR']; ?></td>
          <td><?php echo $values['total_OD']; ?></td>
          <td><?php echo $values['total_OT']; ?></td>
		<?php 
		 $qw=0;
		foreach ($dates as $key2 => $value1) {  $qw++;   
		    if($qw <= $d){		?>
		<?php $dd = explode('~',$value1); 
		  $pr = explode('-',str_replace("'","",$dd[0]));
          $pr0 = str_replace(",", "", $pr[0]);
          $pr1 = str_replace(",", "", $pr[1]);
		  ?>
	   <!-- Conditions -->
	 
	   <?php // ----------------------  Added chandana 30-12-2021 --------- ?>
	    <?php
	         $firsthalf = array(  'AB' => 'text-danger', 'PR' => 'text-success' ,'WO' => 'WO' , 'PH'=>'PH', 'OPH'=>'OPH', 'ML'=>'ML','PL'=>'PL','CMPL'=>'CMPL',
				     'CL'=>'CL', 'EL'=>'EL','SL'=>'SL', 'SHRT'=>'SHRT', 'HAPL'=>'HAPL','LOP'=>'LOP','AR' => 'AR','OH' => 'OH','OCH' => 'OCH','OD'=>'OD','OT'=>'OT');

                 $danger = array('CL','EL','SL','LOP','AR','OH','OCH','OT');
	   ?>
	   		<td>
	   		    <a onclick= "employeeattendanceinfo('<?php echo $dd['1'] ?>','<?php echo $values['mx_attendance_emp_code']?>','<?php echo $dd[2] ?>')"  data-toggle="modal" data-target="#attendance_info" >
			  	   <?php if($pr0 == $pr1){
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
	   
	   	   <?php // ---------------------- end  Added chandana 30-12-2021 --------- ?>
	   	   
		  

		<?php } } ?>
										
										<!--<tr><td></td><td><?php #echo $values['mx_attendance_emp_code']; ?></td></tr>-->
										</tr>
<?php $sno++; } ?>
											
										

									</tbody>
								</table>
							</div>
                        </div>
                    </div>