				<!-- Page Wrapper -->
				<div class="page-wrapper">
				    <!-- Page Content -->
				    <div class="content container-fluid">
					<!-- <div class="spinner-border text-muted"></div> -->
				        <!-- Page Header -->
				        <div class="page-header">
				            <div class="row align-items-center">
				                <div class="col">
				                    <h3 class="page-title">Cron Year Collapse</h3>
				                    <ul class="breadcrumb">
				                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
				                        <li class="breadcrumb-item active">Cron Year Collapse </li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				        <!-- /Page Header -->

				        <!-- Search Filter -->
				        <form id="create_cron_leaves">
				            <div class="row filter-row">	                				                
				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
                                    <select class="select select2" style="width: 100%" name="cronyear" id="cronyear"> 
                                        <option value="">Select Year</option>
                                        <?php 
                                        $currently_selected = date('Y'); 
                                        $earliest_year = 2020; 
                                        $latest_year = date('Y'); 
                                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                            echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                                        }
                                        ?>
								</select>
				                        <label class="focus-label">Cron Leave</label>
				                        <span class="formerror" id="cron_Leave_error"></span>
				                    </div>
				                </div>
				                <div class="col-sm-6 col-md-3">
				                    <button type="submit" name="cronbtn" 
                                     class="btn btn-success btn-block cronbtn">Generate</button>
				                </div>
				            </div>
				        </form>
				        <!-- Search Filter -->
						<div id="cronyearcron"> </div>
				    </div>
				    <!-- /Page Content -->
				</div>
				<!-- /Page Wrapper -->

				
                    <script>
                        //--------FOR SUBMIT 
//$(document).ready(function(){

    $("form#create_cron_leaves").submit(function(e) {
      e.preventDefault();  
        var cronyear = $("#cronyear").val();
        $.ajax({
            type: 'POST',
            async:false,
            data: {cronyear : cronyear , printable :'Y'},
            url: baseurl + "cron/yearendcorn",
                success: function (data) {
                    //alert(data);
                    if(data == 800){
                        alert('Data alreay exists with the ' + cronyear + ' year');
                        $("#cronbtn").hide();
                        setTimeout(function(){
                            window.location.href = baseurl + "cron/year_end_corn"; 
                        }, 100);
                    }else if(data == 700){
                        alert('Not Possible to generate with  ' + cronyear + ' year');
                        setTimeout(function(){
                          window.location.href = baseurl + "cron/year_end_corn"; 
                        }, 100);
                    }
                },
               //  cache: false,
                // contentType: false,
                // processData: false
            });
    });

$("#cronyear").change(function () {
    //alert('hi');
    var cronyear = $(this).val();
       $.ajax({
            type: 'POST',
            async:false,
            data: {cronyear : cronyear },
            url: baseurl + "cron/cronyearlist",
                success: function (data) {
                    //alert(data);
                    if(data == 800){
                        alert('There No data inserted with the ' + cronyear +' year');
                        $(".cronbtn").show();
                       }else{
                        $(".cronbtn").hide();
                        $("#cronyearcron").html(data);
                    }
                },
                // cache: false,
                // contentType: false,
                // processData: false
            });
});





</script>

    

                    
<?php

/*

// -------------- added 20-07-2021-------------

public function  year_end_corn(){
    $this->verifylogin();
    $this->header();
    $this->load->view('cronyearendleaves');
    $this->footer();
}

public function yearendcorn(){
    $res = $this->Cronmodel->year_end_corn($data=1);
    if($res == 200){
        echo '200'; die();
    }else if($res == 500){
        echo '500'; die();
    }else{
        echo '700'; 
        die();
    }
}

public function cronyearlist(){
    $year = '2020';
    $res = $this->Cronmodel->cronyearlist($year);

}

// -------------- end added 20-07-2021-------------






// -------------------- added 20-07-2021 -----------

public function cronyearlist($data){
    $this->db->select('*');
    $this->db->from('maxwell_emp_leave_cron_history');
    $this->db->where('mxemp_leave_cron_processdate',$data);
    $this->db->where('mxemp_leave_cron_process_type','CRON-YEAR');
    $this->db->order_by('mxemp_leave_cron_id', 'desc');
    $query = $this->db->get();
    $crondata = $query->result();
    echo $this->db->last_query(); die;
   // return $crondata;    
}

public function year_end_corn($data){
    if($x==1){
        $dbdateyear = '2020';
    }else{
            $currentdate = date('Y');
        }
    $currentdate = date('Y');
        $this->db->select('mxemp_leave_cron_createdtime');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->order_by('mxemp_leave_cron_id', 'desc');
        $this->db->limit(1);
        $query1 = $this->db->get();
        $crondata = $query1->result();
        $dbdateyear = date('Y' , strtotime($crondata[0]->mxemp_leave_cron_createdtime));
        $dbdateyear = '2020';
        if( ($dbdateyear != $currentdate)  ){
            $ip = $this->get_client_ip();
            $this->db->select("mxlass_emp_type_id,mxemp_emp_type_name,mxemp_emp_id,mxlass_is_carry_forward_month,mxlass_is_carry_forward_year,mxlass_max_leaves_carry_forward,
                               mxlass_leave_type_id,mxemp_leave_bal_crnt_bal,mxemp_emp_comp_code,mxemp_emp_division_code,mxlt_leave_short_name ");
            $this->db->from('maxwell_employees_info');
            $this->db->join('maxwell_leave_assigning_master', 'mxlass_emp_type_id = mxemp_emp_type', 'INNER');
            $this->db->join('maxwell_emp_leave_balance', 'mxemp_leave_bal_emp_id = mxemp_emp_id and mxemp_leave_bal_leave_type =  mxlass_leave_type_id' , 'INNER');
            $this->db->join ('maxwell_leave_type_master','mxlt_id = mxlass_leave_type_id ', 'INNER');
            $this->db->where('mxemp_emp_status', 1);
            $this->db->where('mxemp_emp_resignation_status !=', 'R');
            $this->db->order_by('mxemp_emp_id');
            $query = $this->db->get();
            $cronyear = $query->result();
             echo $this->db->last_query(); 
            $this->db->trans_begin();
                foreach($cronyear as $cykey=>$cyear){
                    if($cyear->mxlass_is_carry_forward_year == 1 ){
                        if( $cyear->mxemp_leave_bal_crnt_bal > $cyear->mxlass_max_leaves_carry_forward ){
                           $carryfwdminus = $cyear->mxemp_leave_bal_crnt_bal - $cyear->mxlass_max_leaves_carry_forward;
                           $cuntbal= $cyear->mxlass_max_leaves_carry_forward;
                           $presentbal = $cyear->mxemp_leave_bal_crnt_bal;
                        }else{
                            $carryfwdminus=0.00;
                            $cuntbal = $cyear->mxemp_leave_bal_crnt_ba;
                            $presentbal = $cyear->mxemp_leave_bal_crnt_bal;
                        } 
                                   }else{
                            $cuntbal=0.00;
                            $carryfwdminus=0.00;
                            $presentbal = $cyear->mxemp_leave_bal_crnt_bal;
                    }
                                            $cornarraydata = array(
                                                'mxemp_leave_cron_comp_id'=> $cyear->mxemp_emp_comp_code,
                                                'mxemp_leave_cron_division_id' => $cyear->mxemp_emp_division_code,
                                                'mxemp_leave_cron_emp_id' => $cyear->mxemp_emp_id,
                                                'mxemp_leave_cron_leavetype' => $cyear->mxlass_leave_type_id, 
                                                'mxemp_leave_cron_short_name' => $cyear->mxlt_leave_short_name,
                                                'mxemp_leave_cron_previous_bal' => $presentbal,
                                                'mxemp_leave_cron_present_adding' => 0.00,
                                                'mxemp_leave_cron_crnt_bal' => $cuntbal,
                                                'mxemp_leave_cron_process_type' => 'CRON-YEAR',
                                                'mxemp_leave_cron_entry_type' => '',
                                                'mxemp_leave_cron_processdate' => $currentdate,
                                                'mxemp_leave_cron_createdby' => $this->session->userdata('user_id'),
                                                'mxemp_leave_cron_createdtime' => date('Y-m-d h:m:s'),
                                                'mxemp_leave_cron_created_ip' => $ip
                                            );
                                            echo '<pre>';
                                            print_r($cornarraydata);
                                            echo 'cnrnarr';
                                           $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                                           echo $this->db->last_query() .'<br>';
                                           $cornarraydet = array(
                                                'mxemp_leave_history_comp_id'=> $cyear->mxemp_emp_comp_code,
                                                'mxemp_leave_history_division_id' => $cyear->mxemp_emp_division_code,
                                                'mxemp_leave_history_emp_id' => $cyear->mxemp_emp_id,
                                                'mxemp_leave_history_leavetype' => $cyear->mxlass_leave_type_id, 
                                                'mxemp_leave_history_short_name' => $cyear->mxlt_leave_short_name,
                                                'mxemp_leave_histroy_previous_bal' => $presentbal ,
                                                'mxemp_leave_histroy_present_adding' =>0.00,
                                                'mxemp_leave_history_crnt_bal' => $cuntbal,
                                                'mxemp_leave_histroy_present_minus' => $carryfwdminus,
                                                'mxemp_leave_history_process_type' => 'CRON-YEAR',
                                                'mxemp_leave_history_processdate' => $currentdate,
                                                'mxemp_leave_history_createdby' => '888666',
                                                'mxemp_leave_history_createdtime' =>date('Y-m-d h:m:s'),
                                                'mxemp_leave_history_created_ip' => $ip
                                            );
                                            echo '<pre>';
                                            print_r($cornarraydet);
                                            echo 'cndet';
                                            $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                                            echo $this->db->last_query().'<br>';                      
                                            $mstleavebal = array(
                                                'mxemp_leave_bal_crnt_bal' =>$cuntbal,
                                                'mxemp_leave_bal_modifyby' => $this->session->userdata('user_id'),
                                                'mxemp_leave_bal_modifiedtime' => date('Y-m-d h:m:s'),
                                                'mxemp_leave_bal_modified_ip' => $ip
                                            );  
                                            echo '<pre>';
                                            print_r($mstleavebal);
                                            echo 'mstup';
                                           $this->db->where('mxemp_leave_bal_emp_id', $cyear->mxemp_emp_id);  
                                           $this->db->where('mxemp_leave_bal_leave_type' , $cyear->mxlass_leave_type_id);            
                                           $this->db->update('maxwell_emp_leave_balance' , $mstleavebal);                                      
                                           echo $this->db->last_query().'<br>';
         }
             if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return 500;
                } else {
                    $this->db->trans_commit();
                    return 200;
                }

 }else{
        return 700;
        //insert into maxwell_submenu_page values( 38 , 11 ,  'Yearly_Collapse_Cron' , 'cron/year_end_corn','',1,888666,0);

}



}

// ------------------ end added 20-07-2021 --------




*/ ?>