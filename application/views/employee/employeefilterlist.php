<?php if(count($employeelist > 0) && !empty($employeelist)){ ?>
<?php foreach($employeelist as $key => $empval){ ?>
<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
	<div class="profile-widget">
		<div class="profile-img">
			<a href="<?php echo base_url() ?>admin/employeesprofile/<?php echo $empval->mxemp_emp_autouniqueid ?>" class="avatar"><img src="<?php echo base_url() . $empval ->mxemp_emp_img ?>" alt="" style="width: 80px; height: 80px;"></a>
		</div>
		<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#"><?php echo $empval->mxemp_emp_fname .' '. $empval->mxemp_emp_lname ?></a></h4>
		<div class="small text-muted">Empid:- <?php echo $empval->mxemp_emp_id ?></div>
		<div class="small text-muted">Desg:-<?php echo $empval->mxdesg_name ?></div>
		<div class="small text-muted">Dep:-<?php echo $empval->mxdpt_name ?></div>
		<div class="small text-muted">Branch:-<?php echo $empval->mxb_name ?></div>
		
		<div class="small text-muted">Status:-<b>
		<?php if($empval->mxemp_emp_resignation_status == 'R' && $empval->mxemp_emp_is_without_notice_period == 0){
		echo "<span style='color: #fc030f'> RESIGNED<span style='color: #4287f5'>(With Notice Period)</span></span>";
		}if($empval->mxemp_emp_resignation_status == 'R' && $empval->mxemp_emp_is_without_notice_period == 1){
		echo "<span style='color: #fc030f'> RESIGNED<span style='color: #42f5e9'>(With Out Notice Period)</span> </span>";
		}else if($empval->mxemp_emp_resignation_status == 'W'){
		echo "<span style='color: #1e7e34'> WORKING</span>";
		}else if($empval->mxemp_emp_resignation_status == 'N'){
		echo "<span style='color: #A52A2A'> NOTICE PERIOD</span>";
		}?></b></div>
		<div class="small text-muted">Experience:-<b><span style='color: #1e7e34'>
		<?php
		$date1 = $empval->mxemp_emp_date_of_join;
		$date2 = $empval->mxemp_emp_resignation_relieving_date;
		date_default_timezone_set("Asia/Calcutta");
        
        if($date2 != '0000-00-00 00:00:00' && $date2 !=''){
            $date2 = date('Y-m-d', strtotime($date2));
        }else{
            $date2 = date("Y-m-d");
        }
				
        // $diff = abs(strtotime($date2) - strtotime($date1));
        // $years = floor($diff / (365*60*60*24));
        // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        // printf("%d years, %d months, %d days\n", $years, $months, $days);

        $bday=new DateTime($date1);
        $relivingdate = new DateTime($date2);
        $age=$bday->diff($relivingdate);
        $re = array("years" => $age->y,"months" => $age->m,"days" => $age->d);
        printf("$age->y years, $age->m months,$age->d days\n");
        
		?>
		</span></b></div>
		<div class="small text-muted">Salary:- <b><span style='color: #1e7e34'><?php echo number_format($empval->mxemp_emp_current_salary,2) ?></span></b></div>
	</div>
</div>
<?php } ?>
<?php }else{
	echo '<center><h2>No Data With Above Filter Search</h2></center>';
} ?>
