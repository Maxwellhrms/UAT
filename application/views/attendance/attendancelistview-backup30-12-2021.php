                    <?php
                    $mnth = $userdata['month'];
                    if(strlen($mnth) == 1){
				        $mnth = '0'.$userdata['month'];
				    }
                    $year = $userdata['year'];
                     ?>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table table-nowrap mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Employee</th>
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
		<a class="avatar avatar-xs" href="#"><img alt="" src="#"></a>
		<a href="#"><?php echo $values['mx_attendance_emp_code']; ?></a>
		&nbsp;-&nbsp; <a href="#"><?php echo $values['fullname']; ?></a>
	</h2>
</td>
		<?php foreach ($dates as $key2 => $value1) { //print_r($value1); echo '<br>'; ?>
		<?php $dd = explode('~',$value1); 
		  $pr = explode('-',str_replace("'","",$dd[0]));
          $pr0 = str_replace(",", "", $pr[0]);
          $pr1 = str_replace(",", "", $pr[1]);
		  ?>
	   <!-- Conditions -->
		  <!---------------------  Added chandana 18-04-2021 ------------------ -->
		  <?php if($pr0 == 'AB' && $pr1 == 'AB'){ ?>
		  	<td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a> </td>
		  <?php }elseif($pr0 == 'PR' && $pr1 == 'PR'){ ?>
			<td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
		  <?php }elseif($pr0 == 'AB' && $pr1 == 'PR'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
					<span class="first-off"><i class="fa fa-check text-success"></i></span>
				</div>
				</a>
			</td>
		  <?php }elseif($pr0 == 'PR' && $pr1 == 'AB'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
					<span class="first-off"><i class="fa fa-close text-danger"></i></span>
				</div>
				</a>
			</td>
		  <?php }elseif($pr0 == 'WO' && $pr1 == 'WO'){ ?>
			<td>
			    <a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<i class="fa fa-wikipedia-w text-danger"></i> 
				<i class="fa fa-opera text-danger"></i>
				</a>
			</td>
		  <?php }elseif($pr0 == 'PH' && $pr1 == 'PH'){ ?>
			<td>
				<i class="fa fa-pinterest-p text-danger"></i>
				<i class="fa fa-header text-danger"></i>
			</td>
         <?php }elseif($pr0 == 'OPH' && $pr1 == 'OPH'){ ?>
				<td>
					<!-- <a href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $values['mx_attendance_id']; ?>" data-target="#attendance_info"> -->
						<i class="fa fa-opera text-danger"></i>
						<i class="fa fa-pinterest-p text-danger"></i>
						<i class="fa fa-header text-danger"></i>
					<!-- </a> -->
				</td>		  
		  <?php }else if($pr0 == 'OPH' && $pr1 != 'OPH'){ ?>
		       <td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<i class="fa fa-opera text-danger"></i>
						<i class="fa fa-pinterest-p text-danger"></i>
						<i class="fa fa-header text-danger"></i>
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
		  <?php }else if($pr0 != 'OPH' && $pr1 == 'OPH'){ ?>
		        <td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
						<i class="fa fa-opera text-danger"></i>
						<i class="fa fa-pinterest-p text-danger"></i>
						<i class="fa fa-header text-danger"></i>
					</div>
					</a>
				</td>
		<?php }else if($pr0 == 'PH' && $pr1 != 'PH'){ ?>
		       <td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<i class="fa fa-pinterest-p text-danger"></i>
						<i class="fa fa-header text-danger"></i>
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
		  <?php }else if($pr0 != 'PH' && $pr1 == 'PH'){ ?>
		        <td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
						<i class="fa fa-pinterest-p text-danger"></i>
						<i class="fa fa-header text-danger"></i>
					</div>
					</a>
				</td>
		  <?php }elseif($pr0 == 'OCH' && $pr1 == 'OCH'){  ?>
				<td>
					<!-- <a href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $values['mx_attendance_id']; ?>" data-target="#attendance_info"> -->
						<i class="fa fa-opera text-danger"></i>
						<i class="fa fa-codiepie text-danger"></i>
						<i class="fa fa-header text-danger"></i>
					<!-- </a> -->
				</td>
		<?php }elseif($pr0 == 'ML' && $pr1 == 'ML'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'ML' ?></a></td>	  	
		<?php }elseif($pr0 == 'PL' && $pr1 == 'PL'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'PL' ?></a></td>	  	
		<?php }elseif($pr0 == 'CMPL' && $pr1 == 'CMPL'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL' ?></a></td>	  	
		<?php }elseif($pr0 == 'CL' && $pr1 == 'CL'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL' ?></a></td>	  	
		<?php }elseif($pr0 == 'CL' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'AB' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'CL' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'PR' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			   <?php }elseif($pr0 == 'CL' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td> 
				<?php }elseif($pr0 == 'CL' && $pr1 == 'SL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
					<span class="first-off"><?php echo 'SL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'CL' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH' ;?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CL' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CL' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'CL' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>	
				<?php }elseif($pr0 == 'CL' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'LOP'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'EL'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL' ?></a></td>	  	
			<?php }elseif($pr0 == 'EL' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'PR' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'SL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL'; ?></a></span> 
						<span class="first-off"><?php echo 'SL'; ?></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'EL' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'EL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'EL' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CL'; ?></a></span> 
						<span class="first-off"><?php echo 'LOP'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'SL'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL' ?></a></td>	  	
			   <?php }elseif($pr0 == 'SL' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'SL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'SL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'PR' && $pr1 == 'SL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'SL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'EL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
					<span class="first-off"><?php echo 'EL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'SHRT'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
					<span class="first-off"><?php echo 'EL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'OPH'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
					<span class="first-off"><?php echo 'EL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'SL' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SL' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'SHRT'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT' ?></a></td>	  	
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'PR' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'EL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
					<span class="first-off"><?php echo 'EL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'SL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
				<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 					
				<span class="first-off"><?php echo 'SL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'SHRT' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'SHRT' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'SHRT'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'CMPL' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'PR' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>
				<?php }elseif($pr0 == 'CMPL' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			   <?php }elseif($pr0 == 'CMPL' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td> 
				<?php }elseif($pr0 == 'CMPL' && $pr1 == 'SL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
					<span class="first-off"><?php echo 'SL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH' ;?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'CMPL'){ ?>
				<td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL' ?></a></td>	  		
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'CMPL' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'CMPL'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'HAPL'){ ?>
				<td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL' ?></a></td>	  		
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'PR' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td> 
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'SL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
					<span class="first-off"><?php echo 'SL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH' ;?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'HAPL' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'HAPL'; ?></a></span> 
						<span class="first-off"><?php echo 'LOP'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'LOP'){ ?>
				<td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP' ?></a></td>	  		
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'AB'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><i class="fa fa-close text-danger"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'AB' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></span> 
						<span class="first-off"><?php echo 'LOP'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'PR'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><i class="fa fa-check text-success"></i></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'PR' && $pr1 == 'LOP'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
						<span class="first-off"><?php echo 'LOP'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'EL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'EL'; ?></span>
					</div>
					</a>
				</td> 
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'SL'){ ?>
			<td>
				<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
				<div class="half-day">
					<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
					<span class="first-off"><?php echo 'SL'; ?></span>
				</div>
				</a>
			</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'OPH'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'OPH' ;?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'SHRT'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'SHRT'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'CMPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'CMPL'; ?></span>
					</div>
					</a>
				</td>	
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'CL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'CL'; ?></span>
					</div>
					</a>
				</td>
			<?php }elseif($pr0 == 'LOP' && $pr1 == 'HAPL'){ ?>
				<td>
					<a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info">
					<div class="half-day">
						<span class="first-off"><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'LOP'; ?></a></span> 
						<span class="first-off"><?php echo 'HAPL'; ?></span>
					</div>
					</a>
				</td>






			<?php }elseif($pr0 == 'OPH' && $pr1 == 'OPH'){ ?>
			   <td><a class="editattendance" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $dd['1'] .'~'. $values['mx_attendance_emp_code'] .'~'. $pr0 .'~'. $pr1 .'~'. $dd['2']; ?>" data-target="#attendance_info"><?php echo 'OPH' ?></a></td>	 


		   <?php } ?>
		   <!-- -------------- End 18-4-2021 ---------------------- -->
		  <!-- Conditions -->

		  
		  
		  

		<?php } ?>
										</tr>
<?php $sno++; } ?>
											
										

									</tbody>
								</table>
							</div>
                        </div>
                    </div>
