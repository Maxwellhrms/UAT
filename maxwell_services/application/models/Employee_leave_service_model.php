<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Employee_leave_service_model extends Common_model
{
    public $sucessmsg='success have great day';
    
    public function api_current_leaves($employeecode)
    { 
        #$leave_types = array('CL', 'SL', 'EL', 'OH', 'OCH', 'SHRT','LOP');
        $leave_types = array();
        $leave_types_query = $this->db->query("select mxemp_leavetypes from maxwell_employees_login where mxemp_emp_lg_employee_id = '$employeecode'");
        $allleave_types = $leave_types_query->result_array();
        $leave_types = explode(",",$allleave_types[0]['mxemp_leavetypes']);
        foreach ($leave_types as $type) {
            $extrasql .= ", max(case when mxemp_leave_bal_leave_type_shrt_name = '$type' then mxemp_leave_bal_crnt_bal end) as $type";
            $columns .= "$type,";
            $sumcolumns .= "sum($type)+";
        }
        $dynamic_columns =rtrim($columns, ',');
        $dynamic_sum = "(".rtrim($sumcolumns,'+').") as Total";
        
        $sql = "select $dynamic_columns,$dynamic_sum from (select mxemp_leave_bal_emp_id as employeeid";
        $sql .= $extrasql;
        $sql .=" from maxwell_emp_leave_balance where mxemp_leave_bal_emp_id = '$employeecode' group by mxemp_leave_bal_emp_id)as current_leaves";
        // echo $sql;exit;
        $query = $this->db->query($sql);
        $count= count($query->row());
        $qry = $query->result_array(); 
        // echo $this->db->last_query(); exit;
        if($count > 0){
            $shrej=0;
            $shrej=0;
            $shrtcount=1;
            $shrtcountap=0;
            $i = 0;
            foreach($qry as $xkey => $data){
                foreach($data as $key => $val){
                    if($key == 'SHRT'){
                    /*
                    $sql1 ="SELECT * FROM maxwell_emp_leave_detailed_history WHERE mxemp_leave_history_short_name ='SHRT' and mxemp_leave_history_process_type != 'NEW ENTRY' and mxemp_leave_history_emp_id = '$employeecode'";
                    $query1 = $this->db->query($sql1);
                    $count1= count($query1->row());
                    $qry1 = $query1->result_array(); 
                    $query1 = $this->db->query($sql1);
                        if($count1 > 0){
                            $previous = 0.5;
                            $val = ($previous - 1);
                        }else{
                            $val = '1';
                        }*/
                    $curr_month = date('Y-m');
                    //  $curr_month = date('2022-10');

                    $fromcmd=$curr_month.'-01';
                    $tocmd=$curr_month.'-31';
                    $categort_tp=array(1,2,3);
                                
                    $this->db->select('mxar_category_type,mxar_noofdays,mxar_final_accept_status,mxar_final_accept_status');
                    $this->db->from('attendance_user_leaveadjust');
                    $this->db->where('mxar_appliedby_emp_code',$employeecode);
                    $this->db->where("mxar_from BETWEEN '$fromcmd' AND '$tocmd' ");
                    $this->db->where("mxar_to BETWEEN '$fromcmd' AND '$tocmd' ");
                    $this->db->where('mxar_leave_type', 'SHRT');
                    $this->db->where_in('mxar_category_type',$categort_tp);
                    $this->db->where('mxar_status','1');
                    $query= $this->db->get();
                    $shresult = $query->result();  
                    // print_r(count($shresult)); exit;
                    if(count($shresult) >0){
                        foreach($shresult as $shkey => $shval){
                            if(($shval-> mxar_final_accept_status == 9)||($shval-> mxar_final_accept_status == 3)){
                                $shrtcountap+=$shval->mxar_noofdays;
                                // $shrej+=$shval->mxar_noofdays;
                            // }else{
                            //     $shaccept+=$shval->mxar_noofdays;
                            //      $shrtcount-=$shval->mxar_noofdays;
                            }
                        }
                        $accptshrt=$shaccept;
                        $rejectshrt=$shrej;
                        $qwe=$shrtcount-$shrtcountap;
                        $val =$qwe;
                    }else{
                        $val = '1';
                    }
                        
                    }
                    $aa[$i]['title'] = $key;
                    $aa[$i]['id'] = '0';
                    $aa[$i]['count'] = strval($val);
                    $aa[$i]['total'] = '';
                    $i++;
                    if($key == 'Total'){
                        $overallleavescount = strval($val);
                    }
                }
                $x = 0;
                foreach($aa as $akey => $aval){
                    $aa[$x]['total'] = strval($overallleavescount);
                    $x++;
                }
            }
            
            // --------------- added on 24-05-2024 -------------
            // $empidin=array('M0009','M00143');
            // $t = $aa[count($aa)-1]['total'];
            // $qw = count($aa);
            // if(in_array($employeecode,$empidin)){
            //     $aa[$qw]['title'] = 'LOP';
            //     $aa[$qw]['id'] = '0';
            //     $aa[$qw]['count'] = '0';
            //     $aa[$qw]['total'] = $t;
            // } 
            // --------------- end on 24-05-2024 -------------
            
            return $aa;
        }else{
            return $qry;
        }
    }
    
    
// -------------------- added 20-02-2022-----------



    public function leavevalidation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$device_status,$emp_desc,$leave_cateory,$noofdays){

    // ------- checking aplying with not set date and month ---------
    if( ((date('Y-m-d',strtotime($from))) == '0000-00-00') || ( (date('Y-m-d',strtotime($to))) == '0000-00-00') ){
        create_notes($employeeid,'4','Date must not empty '.$from. ' to '.$to ,$employeeid);
        return $desc='Please select Date.Date must not empty';            
    }

    // ------- checking aplying with two different months ---------
    if((date('m',strtotime($from))) != (date('m',strtotime($to) ) )){
        create_notes($employeeid,'4','Different months cannot be applied '.$from. ' to '.$to ,$employeeid);
        return $desc='To different months cannot be applied';            
    }

    //   ------ checking  from date greater than to date ------
    if ($from > $to) {
        create_notes($employeeid,'4','check from date must not be greater than to date '.$from. ' to '.$to ,$employeeid);
        return $desc='Please check from date to date correct';   
    }

    //    ------------ applying leave half day with two diffent days ------ 
     //  1 ->First Half  2 ->Secondhalf  3 -> fullday
    if(($category_type == 1 || $category_type == 2) && ($noofdays > 1)){
        create_notes($employeeid,'4','half day with two different dates cannot be applied '.$from. ' to '.$to ,$employeeid);
        return $desc='We are unable to apply half day with two different dates';
    }

    //    ----------- checking leave to apply more than 2 days 
    if(($noofdays > 2) && ($leave_cateory != 'EL') && ($leave_cateory != 'LOP') ){
        create_notes($employeeid,'4',$leave_cateory .' more than two days leaves cannot be applied '.$from.' to '.$to,$employeeid);
        return $desc='Unable to apply more than two days leaves';
    }
    
    // ---------------------- added on 26-05-2024 --------------
    
    $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                       mxemp_leave_bal_division,mxemp_leave_bal_leave_type');
    $this->db->from('maxwell_emp_leave_balance');
    $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
    $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leave_cateory);
    $this->db->where('mxemp_leave_bal_status = 1');
    $query = $this->db->get();
    $balance = $query->result();

    // -------- cheacking leaves avaliable or not to apply leave
    if($leave_cateory != 'SHRT' &&  $leave_cateory != 'LOP'){
        $cntbal = $balance[0]->mxemp_leave_bal_crnt_bal;
        if($noofdays > $cntbal ){
            create_notes($employeeid,'4',$leave_cateory .' Applying '.$noofdays. ' days leaves more than balance. Avaliable balance is '.$cntbal.' ',$employeeid);
            return $desc ='Applying leaves more than balance avaliable';
        }
    }

    // ------------------------ end added on 26-05-2024 --------------
    
    
    // -----------------  checking the from date and to date are same dates  for short leave combination applying  -----------

    $this->db->select('mxar_appliedby_emp_code,mxar_noofdays,mxar_leave_type,mxar_category_type');
    $this->db->from('attendance_user_leaveadjust');
    $this->db->where('mxar_appliedby_emp_code', $employeeid);
    $this->db->where('mxar_from',$from);
    $this->db->where('mxar_from',$to);
    $this->db->where('mxar_to', $from);
    $this->db->where('mxar_to', $to);
    $this->db->where('mxar_status','1');
    $this->db->where('mxar_category_type !=','SHRT');
    $this->db->where('mxar_final_accept_status !=', '2');
    // $this->db->where('mxar_category_type !=','OH');
    $query= $this->db->get();
    $result = $query->result();  
    // echo $this->db->last_query(); exit;
    if(count($result) >0){ 
        // ( $result[0]->mxar_leave_type != 'SHRT' ) &&
        if( (  ( $result[0]->mxar_category_type == $category_type )  ) ){ // || ( $category_type == 3 )
            create_notes($employeeid,'5',' Please select different half day '.$from.' to '.$to ,$employeeid);
            return $desc = "Already ".  $result[0]->mxar_leave_type  ." applied for $from you can't apply or modify leave again "; 
        }
    }
    
    
    //------------------ check previous day leave not equal means not apply the leave ----------------
    
    
    $fromdt =date("Y-m-d",strtotime($from));
    $from1=  $date = date("Y-m-d", strtotime('-24 hours', strtotime($fromdt)));
    // print_r($from1);

    $todt =date("Y-m-d",strtotime($to));
    $to1=  $date = date("Y-m-d", strtotime('+24 hours', strtotime($todt)));
    // print_r($to1);

    $this->db->select('mxar_appliedby_emp_code,mxar_noofdays,mxar_leave_type');
    $this->db->from('attendance_user_leaveadjust');
    $this->db->where('mxar_appliedby_emp_code', $employeeid);
    $this->db->where("mxar_from BETWEEN '$from1' AND '$to1' ");
    $this->db->where("mxar_to BETWEEN '$from1' AND '$to1' ");
    $this->db->where('mxar_leave_type !=','SHRT');
    $this->db->where('mxar_leave_type !=','OH');
    $this->db->where('mxar_final_accept_status !=','2');
    $this->db->where('mxar_status','1');
    
    $query= $this->db->get();
    $result1 = $query->result();  
    // echo $this->db->last_query(); exit;
    // echo "kjhk"; exit;
    if(count($result1) >0){ 
        if(($result1[0]->mxar_leave_type != $leave_cateory) && ($leave_cateory != 'SHRT' ) ){  
            create_notes($employeeid,'4','Different Leave types is not allowed to apply Leave' ,$employeeid);
            return $desc = " Different Leave types is not allowed to apply ";
        }
    }
    
    
       // ---------------------------Start  LOP checking regulation is applied or not  26-05-2024--------------------
    if($leave_cateory == 'LOP')
    {
        $this->db->select('mxar_appliedby_emp_code');
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_from',$from);
        $this->db->where('mxar_from',$to);
        $this->db->where('mxar_to', $from);
        $this->db->where('mxar_to', $to);
        $this->db->where('mxar_status','1');
        $query= $this->db->get();
        $result_reg = $query->result(); 
        // echo $this->db->last_query(); exit;
        if(count($result_reg) > 0)
        {
            create_notes($employeeid,'4',$leave_cateory .' Applying '.$noofdays. ' days already regulation is applied',$employeeid);
            return $desc = "To apply LOP already regulation is applied ";
        }

        $att_from = date('Y_m',strtotime($from));
        $this->db->select('mx_attendance_emp_code');
        $this->db->from('maxwell_attendance_'.$att_from);
        $this->db->where('mx_attendance_emp_code', $employeeid);
        $this->db->where("mx_attendance_date BETWEEN '$from' AND '$to' ");
        $this->db->where("mx_attendance_date BETWEEN '$from' AND '$to' ");
        $this->db->where('mx_attendance_first_half','AB');
        $this->db->where('mx_attendance_second_half','AB');
        $query= $this->db->get();
        $result_att = $query->result(); 
        // echo $this->db->last_query(); exit;
        if(count($result_att) < 1)
        {
            create_notes($employeeid,'4',$leave_cateory .' Applying '.$noofdays. ' days already attendance or leave is applied',$employeeid);
            return $desc = " Already attendance is there ";
        }

    }
    // --------------------------- End LOP checking regulation is applied or not 26-05-2024  --------------------
    

    // $fromdt =date("Y-m-d",strtotime($from));
    // $from1=  $date = date("Y-m-d", strtotime('-24 hours', strtotime($fromdt)));
    // // print_r($from1);

    // $todt =date("Y-m-d",strtotime($to));
    // $to1=  $date = date("Y-m-d", strtotime('+24 hours', strtotime($todt)));
    // // print_r($to1);

    /*$this->db->select('mxar_appliedby_emp_code,mxar_noofdays,mxar_leave_type');
    $this->db->from('attendance_user_leaveadjust');
    $this->db->where('mxar_appliedby_emp_code', $employeeid);
    $this->db->where("mxar_from BETWEEN '$from1' AND '$to1' ");
    $this->db->where("mxar_to BETWEEN '$from1' AND '$to1' ");
    $this->db->where('mxar_leave_type !=','SHRT');
    $this->db->where('mxar_status','1');
    $query= $this->db->get();
    $result = $query->result();  
    if(count($result) >0){ 
        if($result[0]->mxar_leave_type != $leave_cateory){
            create_notes($employeeid,'4','Different Leave types is not allowed to apply Leave' ,$employeeid);
            return $desc = " Different Leave types is not allowed to apply ";
        }
    }*/


    // --------- check previous date any leave is applied --------
    
    $fromdt =date("Y-m-d",strtotime($from));
    $from1=  $date = date("Y-m-d", strtotime('-24 hours', strtotime($fromdt)));
    // print_r($from1);

    $todt =date("Y-m-d",strtotime($to));
    $to1=  $date = date("Y-m-d", strtotime('+24 hours', strtotime($todt)));
    // print_r($to1);

    $this->db->select('mxar_appliedby_emp_code,mxar_noofdays,mxar_category_type,mxar_leave_type');
    $this->db->from('attendance_user_leaveadjust');
    $this->db->where('mxar_appliedby_emp_code',$employeeid);
    $this->db->where("mxar_from BETWEEN '$from1' AND '$to1' ");
    $this->db->where("mxar_to BETWEEN '$from1' AND '$to1' ");
    // $this->db->where_not_in('mxar_id ',$attend_regu_uniqid);
    $this->db->where('mxar_leave_type !=','SHRT');
    $this->db->where('mxar_leave_type !=','OH');
    $this->db->where('mxar_final_accept_status !=','2');
    $this->db->where('mxar_status','1');
    $query= $this->db->get();
    $result = $query->result();  
    // echo $this->db->last_query();  exit;
    if(count($result) >0){
        if(($leave_cateory != 'SHRT' ) && ($result[0]->mxar_leave_type != $leave_cateory ) && ($result[0]->mxar_category_type != 3 ) ){ #3 is fullday comming from mobile drop down 1 is first half 2 second half
        // if($result[0]->mxar_leave_type != 'SHRT'){
            create_notes($employeeid,'4','Already with this '.$from1.' or '.$to1.'  days leave '.$result[0]->mxar_leave_type.' is applied' ,$employeeid);
            return $desc = "Different types of leaves cannot be acceptable in continuation";
        // }
        }
    }  
    
    // ----------- OH before day or after day need be present or else we must not process to apply the leave
    
    
    
    
    // -------------- to apply OH and OCH chech wether in holiday master table ------------
    
    if((($leave_cateory == 'OH') || ($leave_cateory == 'OCH')) && ($noofdays <= 1)){
        $this->db->select('mx_holiday_date');
        $this->db->from('maxwell_holiday_master');
        $this->db->where('mx_holiday_status = 1');
        $this->db->where('mx_holiday_date = ',$from);
        $this->db->where('mx_holiday_date = ',$to);
        $query = $this->db->get();
        $result = $query->result();
        // print_r(count($result)); exit;
        // echo $this->db->last_query(); exit;
        if(count($result) <= 0){  
            create_notes($employeeid,'4','Cannot be applied because not an optinal holiday  '.$from.' to '.$to ,$employeeid);
            return $desc = "Cannot be applied because not an optinal holiday "; 
        } 
    }
    
      //   ---------------------- to apply short leave ------------------
      
    if($leave_cateory == 'SHRT'){
        $fromdtch = date('m',strtotime($from));
        $fromdtchyear = date('Y',strtotime($from));
        if(strlen($fromdtch)==1){ $shmonthyear = '0'.$fromdtch; }else{ $shmonthyear = $fromdtch;  }
        $shfrom = $fromdtchyear.'-'.$shmonthyear.'-01';
        $shto = $fromdtchyear.'-'.$shmonthyear.'-31';

        $this->db->select('mxar_appliedby_emp_code,mxar_noofdays,mxar_category_type,mxar_from,mxar_to');
        $this->db->from('attendance_user_leaveadjust');
        $this->db->where('mxar_appliedby_emp_code',$employeeid);
        // $this->db->like('mxar_from', $shfrom); 
        // $this->db->like('mxar_to', $shfrom); 
        $this->db->where("mxar_from BETWEEN '$shfrom' AND '$shto' ");
        $this->db->where("mxar_to BETWEEN '$shfrom' AND '$shto' ");
        $this->db->where('mxar_leave_type', $leave_cateory);
        $this->db->where('mxar_status','1');
        $query= $this->db->get();
        $shresult = $query->result();  
        // echo $this->db->last_query(); exit; 
        $shrtcnt=0;
        if(count($shresult) >0){  
            foreach($shresult as $shkey=>$shval){
                // if(($shval->mxar_category_type == 3)&&($shval->mxar_noofdays == 2)  && ($shval->mxar_final_accept_status != 2) ){
                //     $shrtcnt = $shrtcnt+2;
                if( ($shval->mxar_category_type == 3)&&($shval->mxar_noofdays >= 1) && ($shval->mxar_final_accept_status != 2) ){
                    $shrtcnt = $shrtcnt+1;
                }elseif( ( ($shval->mxar_category_type == 1) || ($shval->mxar_category_type == 2) ) && ($shval->mxar_final_accept_status != 2) ){
                    $shrtcnt = $shrtcnt+0.5;
                }
            }
            
            if($shrtcnt >= 1 ){
                create_notes($employeeid,'4','Already Finished Short Leave',$employeeid);
                return $desc = "Already Finished Short Leave ";
            }elseif(($shrtcnt == 0.5)&&($noofdays >= 1)){
                create_notes($employeeid,'4','Can apply only Half Day Short Leave' ,$employeeid);
                return $desc = "Can apply only Half Day Short Leave ";
            }elseif(($shrtcnt == 0 )&&($noofdays >= 1)){
                create_notes($employeeid,'4','Can apply only one Day Short Leave' ,$employeeid);
                return $desc = "Can apply only one Day Short Leave ";
            }
            
            // if($shrtcnt >=2){
            //     create_notes($employeeid,'4','Already Finished Short Leave',$employeeid);
            //     return $desc = "Already Finished Short Leave ";
            // }elseif(($shrtcnt == 1.5)&&($noofdays >= 1) ){
            //     create_notes($employeeid,'4','Can apply only Half Day Short Leave' ,$employeeid);
            //     return $desc = "Can apply only Half Day Short Leave ";
            // }elseif(($shrtcnt == 1)&&($noofdays > 1) ){
            //     create_notes($employeeid,'4','Can apply only one Day Short Leave' ,$employeeid);
            //     return $desc = "Can apply only one Day Short Leave ";
            // }elseif(($shrtcnt == 0.5)&&($noofdays > 1.5) ){
            //     create_notes($employeeid,'4','Can apply only one Half Day Short Leave' ,$employeeid);
            //     return $desc = "Can apply only one Half Day Short Leave ";
            // }  
            
        }
    }
    //   ---------------------- end  to apply short leave ------------------
}

    public function api_user_leavesapply($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$device_status,$emp_desc,$leave_cateory,$noofdays,$intime,$outtime,$leave_address){
        $date_test = $this->validation_check_days($from,$to,'applications_leave_day','Leave');
        if($date_test == 0){
            $message="Failed";
            $statuscode="500";
            $desc='Leaves closed from the date '.$from; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        // print_r($date_test); exit;
        
         // -------- cheacking leaves avaliable or not to apply leave
   
        $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                           mxemp_leave_bal_division,mxemp_leave_bal_leave_type');
        $this->db->from('maxwell_emp_leave_balance');
        $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
        $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leave_cateory);
        $this->db->where('mxemp_leave_bal_status = 1');
        $query = $this->db->get();
        $balance = $query->result();
    
        if($leave_cateory != 'SHRT' && $leave_cateory != 'LOP'){
            $cntbal = $balance[0]->mxemp_leave_bal_crnt_bal;
            if($noofdays > $cntbal ){
                create_notes($employeeid,'4',$leave_cateory .' Applying '.$noofdays. ' days leaves more than balance. Avaliable balance is '.$cntbal.' ',$employeeid);
                $desc ='Applying leaves more than balance avaliable';
                $message="Failed";
                $statuscode="500";
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
        }
       
       
        $resleave = $this->leavevalidation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$device_status,$emp_desc,$leave_cateory,$noofdays);
        $qry1=[];
        if(!empty($resleave)){
            $message = "Failed";
            $statuscode = "500";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']=$resleave;
            return $leavedata1;
        }
  
        if($leave_cateory != 'SHRT'  && $leave_cateory != 'LOP'){
            $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                               mxemp_leave_bal_division,mxemp_leave_bal_leave_type');
            $this->db->from('maxwell_emp_leave_balance');
            $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
            $this->db->where('mxemp_leave_bal_status = 1');
            $query = $this->db->get();
            $balance = $query->result();
        
            foreach ($balance as $key => $value) {
                if($value->mxemp_leave_bal_leave_type_shrt_name == $leave_cateory ){
                    $leavetypeid = $value->mxemp_leave_bal_leave_type;
                    $cntbal = $value->mxemp_leave_bal_crnt_bal;
                    $leavuniqid = $value->mxemp_leave_bal_id;
                    $lebal = $cntbal-$noofdays;
                }
            }
        
            $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
            $this->db->from('maxwell_emp_authorsations');
            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
            $this->db->where('mxauth_emp_code',$employeeid);
            $this->db->where('mxauth_status',1);
            $query= $this->db->get();
            $result = $query->result_array();
            if($cntbal >= $noofdays){
                    $this->db->trans_begin();  
                    $data = array(
                        'mxar_comp_id'=>$companyid,
                        'mxar_div_id'=>$divisionid,
                        'mxar_state_id'=>$stateid,
                        'mxar_branch_id'=>$branchid,
                        'mxar_category_type'=>$category_type,
                        'mxar_appliedby_emp_code'=>$employeeid,
                        'mxar_from'=> $from,
                        'mxar_to'=> $to,
                        'mxar_noofdays'=> $noofdays,
                        'mxar_leave_type'=> $leave_cateory,
                        'mxar_leavetypeid'=> $leavetypeid,
                        'mxar_desc'=> $emp_desc,
                        'mxar_device_status'=> $device_status,
                        'mxar_minusleaves'=> $noofdays,
                        'mxar_createdby'=>$employeeid,
                        'mxar_createdtime'=>DBDT,
                        'mxar_created_ip'=>'',
                        'leave_address'=>$leave_address
                    );
                    
                    /*
                    foreach($result as $key =>$authval){
                        if($key == 0){  
                            if($authval['mxauth_auth_type'] == 3){
                                $data['mxar_authfinal_empcode']=$authval['employeeid'];
                                $data['mxar_authfinal_empname']=$authval['employeename'];
                            }else{
                                $data['mxar_auth1_empcode'] = $authval['employeeid'];
                                $data['mxar_auth1_empname'] = $authval['employeename'];
                            }
                        }elseif($key ==1 ){
                            if($authval['mxauth_auth_type'] == 3){
                                $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                                $data['mxar_authfinal_empname'] = $authval['employeename'];
                            }else{
                                $data['mxar_auth2_empcode'] = $authval['employeeid'];
                                $data['mxar_auth2_empname'] = $authval['employeename'];
                            }
                        }elseif($key == 2){
                            if($authval['mxauth_auth_type'] == 3){
                                $data['mxar_authfinal_empcode']=$authval['employeeid'];
                                $data['mxar_authfinal_empname']=$authval['employeename'];
                            }else{
                            $data['mxar_auth3_empcode'] = $authval['employeeid'];
                            $data['mxar_auth3_empname'] = $authval['employeename'];
                            }
                        }elseif($key == 3){
                            if($authval['mxauth_auth_type'] == 3){
                                $data['mxar_authfinal_empcode']=$authval['employeeid'];
                                $data['mxar_authfinal_empname']=$authval['employeename'];
                            }else{
                                $data['mxar_auth4_empcode'] = $authval['employeeid'];
                                $data['mxar_auth4_empname'] = $authval['employeename'];
                            }
                        }
                    }
                    */
                    $authCounter = 1;
                    foreach ($result as $authval) {
                        if ($authval['mxauth_auth_type'] == 3) {
                            $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                            $data['mxar_authfinal_empname'] = $authval['employeename'];
                        } else {
                            $data['mxar_auth' . $authCounter . '_empcode'] = $authval['employeeid'];
                            $data['mxar_auth' . $authCounter . '_empname'] = $authval['employeename'];
                            $authCounter++;
                        }
                    }
                    $resusrleave =$this->db->insert('attendance_user_leaveadjust',$data);
            
                    $this->db->select_max('mxar_id');
                    $this->db->from('attendance_user_leaveadjust');
                    $query = $this->db->get();
                    $mainuniq = $query->result();
                    
            
                    $datalog=array(
                        'mxar_leaveadjust_unique_id'=>$mainuniq[0]->mxar_id,
                        'mxar_roll_status'=>'Insert',
                        'mxar_comp_id'=>$companyid,
                        'mxar_div_id'=>$divisionid,
                        'mxar_state_id'=>$stateid,
                        'mxar_branch_id'=>$branchid,
                        'mxar_category_type'=>$category_type,
                        'mxar_leave_type_id'=>$leavetypeid,
                        'mxar_leave_type'=>$leave_cateory,
                        'mxar_appliedby_emp_code'=>$employeeid,
                        'mxar_from'=>$from,
                        'mxar_to'=>$to,
                        'mxar_noofdays'=>$noofdays,
                        'mxar_desc'=>$emp_desc,
                        'mxar_minus_leaves'=>$noofdays,
                        'mxar_previous_bal'=>$cntbal,
                        'mxar_current_bal'=>$lebal,
                        'mxar_device_status'=> $device_status,
                        'mxar_createdby'=>$employeeid,
                        'mxar_createdtime'=>DBDT,
                        'mxar_created_ip'=>''
                     );
            
                    $reslogleave = $this->db->insert('attendance_user_leaveadjust_log',$datalog);
            
                    $cluparray = array(
                        "mxemp_leave_bal_crnt_bal" => $lebal
                    );
                    $this->db->where('mxemp_leave_bal_id', $leavuniqid);
                    $this->db->where('mxemp_leave_bal_emp_id', $employeeid);
                    $resleavbal= $this->db->update('maxwell_emp_leave_balance', $cluparray);
                    
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        create_notes($employeeid,'3','Failed To Apply Leave of type '.$leave_cateory.' from date '.$from.' to date '.$to ,$employeeid);
                        $message="Failed";
                        $statuscode="500";
                        $desc = "Failed To Apply Leave";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        // $leavedata1['msg']=$sucessmsg;
                        $leavedata1['description']=$desc;
                        return $leavedata1;
                    } else {
                        $this->db->trans_commit();
                            create_notes($employeeid,'3','Applied  Leave of type '.$leave_cateory.' from date '.$from.' to date '.$to.'successfully' ,$employeeid);
                            $message = "Success";
                            $statuscode = "200";
                            $leavedata1['status']=$statuscode;
                            // $leavedata1['msg']=$message;
                            // $leavedata1['msg']=$sucessmsg;
                            $leavedata1['msg']=$message;
                            $leavedata1['description']='';
                            $qry1 = array('statusmsg'=>'success have great day');
                            $leavedata1['leave_apply']=$qry1;
                            return $leavedata1;
                    }
                }else{
                        create_notes($employeeid,'4',$leave_cateory .'No sufficient balance to apply. Applying '.$noofdays. ' days leaves more than balance. Avaliable balance is '.$cntbal.' ',$$employeeid);
                        $message="Failed";
                        $statuscode="500";
                        $desc = "No sufficient balance to apply leaves";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']=$desc;
                        return $leavedata1;
                }
        }elseif($leave_cateory == 'SHRT'  && $leave_cateory != 'LOP'){
            $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
            $this->db->from('maxwell_emp_authorsations');
            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
            $this->db->where('mxauth_emp_code',$employeeid);
            $this->db->where('mxauth_status',1);
            $query= $this->db->get();
            $result = $query->result_array();
            // echo $this->db->last_query(); die;
        
            $this->db->trans_begin();  
                $data = array(
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=> $from,
                    'mxar_to'=> $to,
                    'mxar_noofdays'=> $noofdays,
                    'mxar_leave_type'=> $leave_cateory,
                    'mxar_leavetypeid'=> 11,
                    'mxar_desc'=> $emp_desc,
                    'mxar_device_status'=> $device_status,
                    'mxar_minusleaves'=> 0,
                    'mxar_createdby'=>$employeeid,
                    'mxar_createdtime'=>DBDT,
                    'mxar_created_ip'=>''
                );
                
                foreach($result as $key =>$authval){
                    if($key == 0){  
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth1_empcode'] = $authval['employeeid'];
                            $data['mxar_auth1_empname'] = $authval['employeename'];
                        }
                    }elseif($key ==1 ){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                            $data['mxar_authfinal_empname'] = $authval['employeename'];
                        }else{
                            $data['mxar_auth2_empcode'] = $authval['employeeid'];
                            $data['mxar_auth2_empname'] = $authval['employeename'];
                        }
                    }elseif($key == 2){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                        $data['mxar_auth3_empcode'] = $authval['employeeid'];
                        $data['mxar_auth3_empname'] = $authval['employeename'];
                        }
                    }elseif($key == 3){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth4_empcode'] = $authval['employeeid'];
                            $data['mxar_auth4_empname'] = $authval['employeename'];
                        }
                    }
                }
                $resusrleave =$this->db->insert('attendance_user_leaveadjust',$data);
        
                $this->db->select_max('mxar_id');
                $this->db->from('attendance_user_leaveadjust');
                $query = $this->db->get();
                $mainuniq = $query->result();
                
        
                $datalog=array(
                    'mxar_leaveadjust_unique_id'=>$mainuniq[0]->mxar_id,
                    'mxar_roll_status'=>'Insert',
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_leave_type_id'=>10,
                    'mxar_leave_type'=>$leave_cateory,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=>$from,
                    'mxar_to'=>$to,
                    'mxar_noofdays'=>$noofdays,
                    'mxar_desc'=>$emp_desc,
                    'mxar_minus_leaves'=>0,
                    'mxar_previous_bal'=>0,
                    'mxar_current_bal'=>0,
                    'mxar_device_status'=> $device_status,
                    'mxar_createdby'=>$employeeid,
                    'mxar_createdtime'=>DBDT,
                    'mxar_created_ip'=>''
                );        
                $reslogleave = $this->db->insert('attendance_user_leaveadjust_log',$datalog);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message="Failed";
                    $statuscode="500";
                    $desc = "Failed To Apply SHRT Leave";
                    $leavedata1['status']=$statuscode;
                    $leavedata1['msg']=$message;
                    $leavedata1['description']=$desc;
                    return $leavedata1;
                } else {
                    $this->db->trans_commit();
                        $message = "Success";
                        $statuscode = "200";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='';
                        $qry1[] = array('statusmsg'=>'Sucessfully SHRT Leave Applied');
                        $leavedata1['leave_apply']=$qry1;
                        return $leavedata1;
                }
        }elseif($leave_cateory == 'LOP'){
            $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
            $this->db->from('maxwell_emp_authorsations');
            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
            $this->db->where('mxauth_emp_code',$employeeid);
            $this->db->where('mxauth_status',1);
            $query= $this->db->get();
            $result = $query->result_array();
            // echo $this->db->last_query(); die;
        
            $this->db->trans_begin();  
                $data = array(
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=> $from,
                    'mxar_to'=> $to,
                    'mxar_noofdays'=> $noofdays,
                    'mxar_leave_type'=> $leave_cateory,
                    'mxar_leavetypeid'=> 13,
                    'mxar_desc'=> $emp_desc,
                    'mxar_device_status'=> $device_status,
                    'mxar_minusleaves'=> 0,
                    'mxar_createdby'=>$employeeid,
                    'mxar_createdtime'=>DBDT,
                    'mxar_created_ip'=>''
                );
                
                foreach($result as $key =>$authval){
                    if($key == 0){  
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth1_empcode'] = $authval['employeeid'];
                            $data['mxar_auth1_empname'] = $authval['employeename'];
                        }
                    }elseif($key ==1 ){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                            $data['mxar_authfinal_empname'] = $authval['employeename'];
                        }else{
                            $data['mxar_auth2_empcode'] = $authval['employeeid'];
                            $data['mxar_auth2_empname'] = $authval['employeename'];
                        }
                    }elseif($key == 2){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                        $data['mxar_auth3_empcode'] = $authval['employeeid'];
                        $data['mxar_auth3_empname'] = $authval['employeename'];
                        }
                    }elseif($key == 3){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth4_empcode'] = $authval['employeeid'];
                            $data['mxar_auth4_empname'] = $authval['employeename'];
                        }
                    }
                }
                $resusrleave =$this->db->insert('attendance_user_leaveadjust',$data);
        
                $this->db->select_max('mxar_id');
                $this->db->from('attendance_user_leaveadjust');
                $query = $this->db->get();
                $mainuniq = $query->result();                
        
                $datalog=array(
                    'mxar_leaveadjust_unique_id'=>$mainuniq[0]->mxar_id,
                    'mxar_roll_status'=>'Insert',
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_leave_type_id'=>10,
                    'mxar_leave_type'=>$leave_cateory,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=>$from,
                    'mxar_to'=>$to,
                    'mxar_noofdays'=>$noofdays,
                    'mxar_desc'=>$emp_desc,
                    'mxar_minus_leaves'=>0,
                    'mxar_previous_bal'=>0,
                    'mxar_current_bal'=>0,
                    'mxar_device_status'=> $device_status,
                    'mxar_createdby'=>$employeeid,
                    'mxar_createdtime'=>DBDT,
                    'mxar_created_ip'=>''
                );        
                $reslogleave = $this->db->insert('attendance_user_leaveadjust_log',$datalog);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message="Failed";
                    $statuscode="500";
                    $desc = "Failed To Apply LOP Leave";
                    $leavedata1['status']=$statuscode;
                    $leavedata1['msg']=$message;
                    $leavedata1['description']=$desc;
                    return $leavedata1;
                } else {
                    $this->db->trans_commit();
                        $message = "Success";
                        $statuscode = "200";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='';
                        $qry1[] = array('statusmsg'=>'Sucessfully LOP Leave Applied');
                        $leavedata1['leave_apply']=$qry1;
                        return $leavedata1;
                }
        }
    }

    public function api_user_authleaveaccept($employeeid,$companyid,$divisionid,$stateid,$branchid,$approve,$remarks,$uniqid,$deviceid)
    {
        $qry1=[];
        $this->db->distinct();
        $this->db->select("mxauth_emp_code as empid , mxauth_auth_type as authtype,concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ");  //mxauth_reporting_head_emp_code
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        $authtype ='';
        $this->db->select('mxar_id as mxid,mxar_appliedby_emp_code as uiempid');
        $this->db->from('attendance_user_leaveadjust');
        $this->db->where('mxar_id',$uniqid);
        $query1 = $this->db->get();
        $uniqry = $query1->result_array(); 
                
        foreach($cnt as $atype){
            if($atype['empid']== $uniqry[0]['uiempid']){ 
                $authtype = $atype['authtype'];
            }
        }
        
        if(count($cnt) > 0){
            $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_noofdays as noofdays,
                               mxar_from as from,mxar_to as to,mxar_desc as desc,mxar_auth1_empcode as auth1,
                               mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinalemp,
                               mxar_status as status,mxar_authfinal_status as authfinal,mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename,
                               mxar_comp_id as compid,mxar_div_id as divid,mxar_state_id as stateid,mxar_branch_id as branchid');
            $this->db->from('attendance_user_leaveadjust');
            $this->db->where('mxar_status',1);
            $this->db->where('mxar_id', $uniqid);
            $query = $this->db->get();
            $res = $query->result_array();
            if($approve == 1){
                if( ($authtype == 3) && ($res[0]['authfinalemp'] == $employeeid) ){   
                    $autharry= array(
                            // "mxar_authfinal_empcode"=>$employeeid,
                            // "mxar_authfinal_empname"=>$cnt[0]['employeename'],
                            "mxar_hrfinal_accept"=>$employeeid,
                            "mxar_hrfinal_acceptdate"=>DBDT, //date('Y-m-d H:i:s'),
                            "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                            "mxar_hrfinal_acceptname"=>$cnt[0]['employeename'],
                            "mxar_authfinal_remarks"=>$remarks,
                            "mxar_final_accept_status"=>1,
                            "mxar_authfinal_status"=>$approve,
                            "mxar_authfinal_createdby"=>$employeeid,
                            "mxar_authfinal_createdtime"=>DBDT,
                            "mxar_emp_modifyby" => $employeeid,
                            "mxar_emp_modifiedtime" => DBDT,
                            "mxar_authfinal_deviceid"=>$deviceid
                        );
                          // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_authfinal_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_authfinal_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                        $this->db->where('mxar_id', $uniqid);
                        $res = $this->db->update('attendance_user_leaveadjust',$autharry);
                        // echo $this->db->last_query(); exit;
                        if($res==1){
                            create_notes($employeeid,'3','Sucessfully Leave accepted by '.$employeeid ,$employeeid);
                            $message = "Success";
                            $statuscode = "200";
                            $leavedata1['status']=$statuscode;
                            $leavedata1['msg']=$message;
                            $leavedata1['description']='';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $leavedata1['leave_apply']=$qry1;
                            return $leavedata1;
                        }else{
                            create_notes($employeeid,'3','Failed to accept by '.$employeeid ,$employeeid);
                            $message = "Failed";
                            $statuscode = "500";
                            $leavedata1['status']=$statuscode;
                            $leavedata1['msg']=$message;
                            $leavedata1['description']='Failed To Accept';
                            // $leavedata1['leave_apply']="Failed To Accept";
                            return $leavedata1;
                        }
                        
                }else{
                    if($res[0]['auth1'] == $employeeid ){ 
                        $autharry= array(
                            "mxar_auth1_remarks"=>$remarks,
                            "mxar_auth1_createdby"=>$employeeid,
                            "mxar_auth1_status"=>$approve,
                            "mxar_auth1_createdtime"=>DBDT,
                            "mxar_auth1_deviceid"=>$deviceid
                        );
                        // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_auth1_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_auth1_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                    }elseif($res[0]['auth2'] == $employeeid){ 
                        $autharry= array(
                            "mxar_auth2_remarks"=>$remarks,
                            "mxar_auth2_createdby"=>$employeeid,
                            "mxar_auth2_status"=>$approve,
                            "mxar_auth2_createdtime"=>DBDT,
                            "mxar_auth2_deviceid"=>$deviceid
                        );
                        // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_auth2_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_auth2_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                    }elseif($res[0]['auth3'] == $employeeid){ 
                        $autharry= array(
                            "mxar_auth3_remarks"=>$remarks,
                            "mxar_auth3_createdby"=>$employeeid,
                            "mxar_auth3_status"=>$approve,
                            "mxar_auth3_createdtime"=>DBDT,
                            "mxar_auth3_deviceid"=>$deviceid
                        );
                         // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_auth3_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_auth3_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                    }elseif($res[0]['auth4'] == $employeeid){ 
                        $autharry= array(
                            "mxar_auth4_remarks"=>$remarks,
                            "mxar_auth4_createdby"=>$employeeid,
                            "mxar_auth4_status"=>$approve,
                            "mxar_auth4_createdtime"=>DBDT,
                            "mxar_auth4_deviceid"=>$deviceid
                        );
                        // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_auth4_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_auth4_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                    }
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_user_leaveadjust',$autharry);
                    if($res==1){
                        create_notes($employeeid,'3','Sucessfully Leave accepted by '.$employeeid ,$employeeid);
                        $message = "Success";
                        $statuscode = "200";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='';
                        $qry1[] = array('statusmsg'=>'Sucessfully Updated');
                        $leavedata1['leave_apply']=$qry1;
                        return $leavedata1;
                    }else{
                        create_notes($employeeid,'3','Failed to accept by '.$employeeid ,$employeeid);
                        $message = "Failed";
                        $statuscode = "500";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='Failed To Accept';
                        // $leavedata1['leave_apply']="Failed To Accept";
                        return $leavedata1;
                    }
                }
            }else{  
                if($res[0]['authfinal'] != 2){
                    $leavetypeid = $res[0]['leavetypeid'];
                    $leavetypename = $res[0]['leavetypename'];
                    $employeeidval = $res[0]['employeeid'];
                    
                    $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                                       mxemp_leave_bal_division,mxemp_leave_bal_leave_type,mxemp_leave_bal_id');
                    $this->db->from('maxwell_emp_leave_balance');
                    $this->db->where('mxemp_leave_bal_emp_id',$employeeidval);
                    $this->db->where('mxemp_leave_bal_leave_type',$leavetypeid);
                    $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leavetypename);
                    $this->db->where('mxemp_leave_bal_status = 1');
                    $query = $this->db->get();
                    $balance = $query->result_array();  
                    // echo $this->db->last_query(); exit;
                    $this->db->trans_begin();
                    $autharry= array(
                            "mxar_authfinal_remarks"=>$remarks,
                            "mxar_hrfinal_accept"=>$employeeid,
                            "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                            "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                            "mxar_hrfinal_acceptname"=>$employeeid,
                            "mxar_final_accept_status"=>2,
                            // "mxar_status"=>0,
                            "mxar_authfinal_status"=>$approve,
                            "mxar_authfinal_createdtime"=>DBDT,
                            "mxar_authfinal_createdby"=>$employeeid,
                            // "mxar_emp_modifyby" => $employeeid,
                            // "mxar_emp_modifiedtime" => DBDT,
                            "mxar_authfinal_deviceid"=>$deviceid
                        );
                         // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_authfinal_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_authfinal_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                    $this->db->where('mxar_id', $uniqid);
                    $res1 = $this->db->update('attendance_user_leaveadjust',$autharry);
                    $calbal = $res[0]['noofdays'] + $balance[0]['mxemp_leave_bal_crnt_bal'];

                    //if($leavetypeid == 11){ $calbal=0; }
                    $updata=array(
                                    'mxemp_leave_bal_crnt_bal'=>$calbal
                                 );
                    $updatawhere= array(
                                   'mxemp_leave_bal_emp_id'=>$employeeidval,
                                   'mxemp_leave_bal_leave_type'=>$leavetypeid,
                                   'mxemp_leave_bal_leave_type_shrt_name'=>$leavetypename,
                                   'mxemp_leave_bal_id'=>$balance[0]['mxemp_leave_bal_id']
                                );
                    $this->db->where($updatawhere);
                    $res2 = $this->db->update('maxwell_emp_leave_balance',$updata);
        
                    $datalog=array(
                        'mxar_leaveadjust_unique_id'=>$uniqid,
                        'mxar_roll_status'=>'Reject',
                        'mxar_comp_id'=>$res[0]['compid'],
                        'mxar_div_id'=>$res[0]['divid'],
                        'mxar_state_id'=>$res[0]['stateid'],
                        'mxar_branch_id'=>$res[0]['branchid'],
                        'mxar_category_type'=>$res[0]['category_type'],
                        'mxar_leave_type_id'=>$res[0]['leavetypeid'],
                        'mxar_leave_type'=>$res[0]['leavetypename'],
                        'mxar_appliedby_emp_code'=>$res[0]['employeeid'],
                        'mxar_from'=>$res[0]['from'],
                        'mxar_to'=>$res[0]['to'],
                        'mxar_noofdays'=>$res[0]['noofdays'],
                        'mxar_desc'=>$res[0]['emp_desc'],
                        'mxar_minus_leaves'=>$res[0]['noofdays'],
                        'mxar_previous_bal'=>$balance[0]['mxemp_leave_bal_crnt_bal'],
                        'mxar_current_bal'=>$calbal,
                        'mxar_device_status'=> $deviceid,
                        'mxar_createdby'=>$employeeid,
                        'mxar_createdtime'=>DBDT
                        // 'mxar_authfinal_deviceid'=>$deviceid
                        // 'mxar_created_ip'=>''
                     );
                    $reslogleavedel = $this->db->insert('attendance_user_leaveadjust_log',$datalog);
                            
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        create_notes($employeeid,'3','Failed to Leave accepted by '.$employeeid ,$employeeid);
                        $message="Failed";
                        $statuscode="500";
                        $desc = "Failed To Acceept Leave";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']=$desc;
                        return $leavedata1;
                    } else {
                            $this->db->trans_commit();
                            create_notes($employeeid,'3','Sucessfully to Leave Rejected by '.$employeeid ,$employeeid);
                            $message = "Success";
                            $statuscode = "200";
                            $leavedata1['status']=$statuscode;
                            $leavedata1['msg']=$message;
                            $leavedata1['description']='';
                            $qry1[] = array('statusmsg'=>'Sucessfully Updated');
                            $leavedata1['leave_apply']=$qry1;
                            return $leavedata1;
                    }
                }else{
                        $statuscode="500";
                        $desc = "Already rejected";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']=$desc;
                        // $leavedata1['leave_apply']=$desc;
                        return $leavedata1;
                }
            }
        }else{
            $statuscode="500";
            $desc = "You are not authorized person";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']=$desc;
            // $leavedata1['leave_apply']=$desc;
            return $leavedata1;
        }
    }


    public function api_all_leavesapply_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$monthyear,$filter,$finalhraccept,$uniqid)
    {
        $this->db->distinct();
        $this->db->select('mxauth_emp_code as empid'); 
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        // echo $this->db->last_query(); exit;
        $a=[];
        if(count($cnt) > 0){
            array_push($a,$employeeid);
            foreach($cnt as $key=>$val){  
                array_push($a,$val['empid']);
            }
        $employeeid = array_values($a);
        }else{
            $employeeid = $employeeid;
        }                   
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_desc as emp_description,  
                            mxar_status as status ,mxar_leave_type as leavetypename,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,mxar_final_accept_status as finalacceptstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname ,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc,mxar_hrfinal_accept as finalhracceptid,mxar_hrfinal_acceptname as finalhracceptname, mxar_intime as intime, mxar_outtime as outtime
                             ");
                            $this->db->from('attendance_user_leaveadjust');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)&& ($filter==1) ){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid)&& ($filter==1) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid)&& ($filter==1) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            if(!empty($monthyear)&& ($filter==1) ){
                                $my = explode('-',$monthyear);
                                $len = strlen($my[1]);
                                if($len == 1){
                                    $monthyears = $my[0].'-'.'0'.$my[1];
                                }else{
                                    $monthyears =$my[0].'-'.$my[1];
                                }
                                $this->db->where("DATE_FORMAT(mxar_from,'%Y-%m')", $monthyears);
                            }
                            if($employeeid !=''){
                                $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            if(($finalhraccept !='')&&($finalhraccept !=9)){
                                $this->db->where('mxar_final_accept_status',1);
                            }
                            // if(($finalhraccept == 1)&&($uniqid !='')&&($uniqid !=0)){
                            //     $this->db->where('mxar_id',$uniqid);
                            // }
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                            // echo $this->db->last_query();exit;
        $naval='';
        foreach($result as $key=>$val)
        {
                if($val['auth1status']== 1){
                    $result[$key]['authemp1'] =$val['authempname1'];
                    $result[$key]['editbuttonauth1'] = "Disable";
                }elseif($val['auth1status']== 2){
                    $result[$key]['authemp1'] =$val['authempname1'];
                    $result[$key]['editbuttonauth1'] = "Enable";
                }else{
                    if(!empty($result[$key]['auth1'])){
                        $result[$key]['authemp1'] = $val['authempname1'];
                        $result[$key]['editbuttonauth1'] = "Enable";
                    }else{
                        $result[$key]['authemp1'] = '';
                        $result[$key]['editbuttonauth1'] = "Disable";
                    }
                }
                if($val['auth2status']== 1){
                    $result[$key]['authemp2']= $val['authempname2'];
                     $result[$key]['editbuttonauth2'] = "Disable";
                }elseif($val['auth2status']== 2){
                    $result[$key]['authemp2']=$val['authempname2'];
                    $result[$key]['editbuttonauth2'] = "Enable";
                }else{
                    if(!empty($result[$key]['auth2'])){
                        $result[$key]['authemp2'] =$val['authempname2'];
                        $result[$key]['editbuttonauth2'] = "Enable";
                    }else{
                        $result[$key]['authemp2'] = '';
                        $result[$key]['editbuttonauth2'] = "Disable";
                    }                }
                if($val['auth3status']== 1){ 
                    $result[$key]['authemp3']=$val['authempname3'];
                    $result[$key]['editbuttonauth3'] = "Disable";
                }elseif($val['auth3status']== 2){
                    $result[$key]['authemp3'] =$val['authempname3'];
                    $result[$key]['editbuttonauth3'] = "Enable";
                }else{
                    if(!empty($result[$key]['auth3'])){
                        $result[$key]['authemp3'] =$val['authempname3'];
                        $result[$key]['editbuttonauth3'] = "Enable";
                    }else{
                        $result[$key]['authemp3'] = '';
                        $result[$key]['editbuttonauth3'] = "Disable";
                    }
                }
                if($val['auth4status']== 1){
                    $result[$key]['authemp4']= $val['authempname4'];
                     $result[$key]['editbuttonauth4'] = "Disable";
                }elseif($val['auth4status']== 2){
                    $result[$key]['authemp4'] =$val['authempname4'];
                    $result[$key]['editbuttonauth4'] = "Enable";
                }else{
                    if(!empty($result[$key]['auth4'])){
                        $result[$key]['authemp4'] =$val['authempname4'];
                        $result[$key]['editbuttonauth4'] = "Enable";
                    }else{
                        $result[$key]['authemp4'] = '';
                        $result[$key]['editbuttonauth4'] = "Disable";
                    }                }
                if($val['authfinalstatus']== 1){
                    $result[$key]['authfinalemp'] =$val['authfinalempname'] ;
                    $result[$key]['editbuttonfinal'] = "Disable";
                }elseif($val['authfinalstatus']== 2){
                    $result[$key]['authfinalemp']=$val['authfinalempname'];
                    $result[$key]['editbuttonfinal'] = "Enable";
                }else{
                    if(!empty($result[$key]['authfinal'])){
                        $result[$key]['authempfinal'] = $val['authfinalempname'];
                        $result[$key]['editbuttonfinal'] = "Enable";
                    }else{
                        $result[$key]['authempfinal'] ='';
                        $result[$key]['editbuttonfinal'] = "Enable";
                    }
                }
                $result[$key]['status1']='Approval';
                $result[$key]['status2']=  $naval; 
                unset($result[$key]['authempname1']);
                unset($result[$key]['authempname2']);
                unset($result[$key]['authempname3']);
                unset($result[$key]['authempname4']);
                unset($result[$key]['authfinalempname']);
                unset($result[$key]['authfinalname']);
        }
        $d['status']=200;
        $d['msg']='sucess';
        $d['desc']='';
        $d['attendancelist']=$result;
        return $d;
    }
    
    public function api_all_leaves_apply_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$monthyear,$filter,$finalhraccept,$searchempid,$status_type)
    {
        if($status_type =='Approved'){
            $status_type = 1;
        }elseif($status_type =='Rejected'){
            $status_type = 2;
        }elseif($status_type =='Pending'){
            $status_type = 0;
        }elseif($status_type =='Final_Hr_Accepted'){
            $status_type = 3;
        }else{
            $status_type = '';
        }
        
        if($monthyear == ''){
            $monthyear=date('Y-m');
        }else{
            $monthyear= date('Y-m',strtotime($monthyear));
        }

        $this->db->distinct();
        $this->db->select('mxauth_emp_code as empid'); 
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        // print_r($cnt); exit;
        $a=[];
        $employeeidval = $employeeid;
        if(count($cnt) > 0){
            array_push($a,$employeeid);
            foreach($cnt as $key=>$val){  
                array_push($a,$val['empid']);
            }
        $employeeid = array_values($a);
        }else{
             $employeeid = $employeeid;
        }                   
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_desc as emp_description,  
                            mxar_status as status ,mxar_leave_type as leavetypename,mxar_noofdays as noofdays,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,mxar_final_accept_status as finalacceptstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,
                            concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,
                            concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname ,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,
                            if(mxar_authfinal_remarks IS NULL,'',mxar_authfinal_remarks) as authfinaldesc
                            ,
                            mxar_hrfinal_accept as finalhracceptid,if(mxar_hrfinal_acceptname IS NULL ,' ',mxar_hrfinal_acceptname ) as finalhracceptname,
                            mxb_name as branchname, if(leave_address IS NULL,'',leave_address) as leave_address, mxar_intime as intime, mxar_outtime as outtime");
                            $this->db->from('attendance_user_leaveadjust');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_branch_master','mxb_id=mxemp_emp_branch_code','Left');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)&& ($filter==1) ){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid)&& ($filter==1) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid)&& ($filter==1) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            if($monthyear != ''){
                                // $my = explode('-',$monthyear);
                                // $len = strlen($my[1]);
                                // if($len == 1){
                                //     $monthyear = $my[0].'-'.'0'.$my[1];
                                // }else{
                                //     $monthyear =$my[0].'-'.$my[1];
                                // }
                                $this->db->where("DATE_FORMAT(mxar_createdtime,'%Y-%m')", $monthyear);
                            }
                            
                            if( $employeeid != ''){
                                $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            
                            if(($finalhraccept !='')&&($finalhraccept !=0)){
                                $this->db->where('mxar_final_accept_status',1);
                            }

                            if($searchempid !=''){
                               $this->db->where('mxar_appliedby_emp_code', $searchempid);
                            }
                            if($status_type !== ''){
                                $this->db->where("
                                    (
                                    CASE 
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 0 THEN '0'
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 1 THEN '1'
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 2 THEN '2'

                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 0 THEN '0'
                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 1 THEN '1'
                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 2 THEN '2'

                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 0 THEN '0'
                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 1 THEN '1'
                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 2 THEN '2'

                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 0 THEN '0'
                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 1 THEN '1'
                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 2 THEN '2'

                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_final_accept_status = 9 THEN '0'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_final_accept_status = 3 THEN '3'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_final_accept_status = 1 THEN '1'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_final_accept_status = 2 THEN '2'

                                    when mxar_appliedby_emp_code = '$employeeidval' then 
                                    (
                                        CASE 
                                            WHEN mxar_final_accept_status = 9 THEN '0'
                                            WHEN mxar_final_accept_status = 3 THEN '3'
                                            WHEN mxar_final_accept_status = 1 THEN '1'
                                            WHEN mxar_final_accept_status = 2 THEN '2'
                                            ELSE ''
                                        END
                                    )

                                    ELSE ''
                                    END
                                    ) = '".$status_type."'
                                    ");
                            }

                            // if($status_type != ''){
                            //     $this->db->where('mxar_final_accept_status',$status_type);
                            // }
                            // if(($finalhraccept == 1)&&($uniqid !='')&&($uniqid !=0)){
                            //     $this->db->where('mxar_id',$uniqid);
                            // }
                            $this->db->order_by("mxar_final_accept_status", "asc");
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                            // echo $this->db->last_query();exit;
        // $naval = 0;
        // $editbtn = 0;
        $authempidstatus = '0';
        $authempiddesc = '';
        $countlist = count($result);
        foreach($result as $key=>$val)
        {
            $naval = 0;
            $editbtn = 0;
        
                // 1 enable  2 disable 
                if($val['finalhracceptid'] != $val['authfinal'] ){
                    $hrfinalnane =$val['hrfinalempname'];
                }else{
                    $hrfinalnane ='';
                }
                if($val['auth1status']== 1){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Approved)';
                    if($val['auth1'] == $employeeidval ){
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn =  2;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth1status'];
                        $authempiddesc = $val['auth1desc'];
                        
                    }
                }elseif($val['auth1status']== 2){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Rejected)';
                    if($val['auth1']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn =1;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth1status'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth1'])){
                        $result[$key]['authemp1'] = $val['authempname1'].'(Wating for approval)';
                        if($val['auth1']== $employeeidval ){
                                                    
                            if($val['finalacceptstatus'] ==2){
                                $editbtn =  0;
                                $naval=0;
                            }
                             elseif($val['finalacceptstatus'] !=3){
                                    $editbtn = 1;
                                    $naval=2;
    
                            // elseif(($val['finalacceptstatus'] !=3) || ($val['finalacceptstatus'] == 9)){
                            //         $editbtn = 1;
                            //         $naval=1;
                                }
                                $authempidstatus =$val['auth1status'];
                                $authempiddesc = $val['auth1desc'];
                            }
                    }else{
                        $result[$key]['authemp1'] = '';
                    }
                }
                
                if($val['auth2status']== 1){
                    $result[$key]['authemp2']= $val['authempname2'].'(Approved)';
                    if($val['auth2']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 2;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth2status'];
                        $authempiddesc = $val['auth2desc'];
                    }
                }elseif($val['auth2status']== 2){
                    $result[$key]['authemp2']=$val['authempname2'].'(Rejected)';
                    if($val['auth2']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 1;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth2status'];
                        $authempiddesc = $val['auth2desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth2'])){
                        $result[$key]['authemp2'] =$val['authempname2'].'(Wating for approval)';
                        if($val['auth2']== $employeeidval ){
                                                    
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                                $editbtn =1;
                                $naval=2;
                            }
                            $authempidstatus =$val['auth2status'];
                            $authempiddesc = $val['auth2desc'];
                        }
                    }else{
                        $result[$key]['authemp2'] = '';
                    }                }
                    
                if($val['auth3status']== 1){ 
                    $result[$key]['authemp3']=$val['authempname3'].'(Approved)';
                    if($val['auth3']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn =2;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth3status'];
                        $authempiddesc = $val['auth3desc'];
                    }
                }elseif($val['auth3status']== 2){
                    $result[$key]['authemp3'] =$val['authempname3'].'(Rejected)';
                    if($val['auth3']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 1;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth3status'];
                        $authempiddesc = $val['auth3desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth3'])){
                        $result[$key]['authemp3'] =$val['authempname3'].'(Wating for approval)';
                        if($val['auth3']== $employeeidval ){
                                                    
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                                $editbtn = 1;
                                $naval=2;
                            }
                            $authempidstatus =$val['auth3status'];
                            $authempiddesc = $val['auth3desc'];
                        }
                    }else{
                        $result[$key]['authemp3'] = '';
                    }
                }
                
                if($val['auth4status']== 1){
                    $result[$key]['authdirector']= $val['authempname4'].'(Approved)';
                    if($val['auth4']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 2;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth4status'];
                        $authempiddesc = $val['auth4desc'];
                    }
                }elseif($val['auth4status']== 2){
                    $result[$key]['authdirector'] =$val['authempname4'].'(Rejected)';
                    if($val['auth4']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 1;
                            $naval=2;
                        }
                        $authempidstatus =$val['auth4status'];
                        $authempiddesc = $val['auth4desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth4'])){
                        $result[$key]['authdirector'] =$val['authempname4'].'(Wating for approval)';
                        if($val['auth4']== $employeeidval ){
                            if($val['finalacceptstatus'] !=3){
                                $editbtn = 1;
                                $naval=2;
                            }
                            $authempidstatus =$val['auth4status'];
                            $authempiddesc = $val['auth4desc'];
                        }
                    }else{
                        $result[$key]['authdirector'] = '';
                    }              
                }
                
                if($val['authfinalstatus']== 1){
                    $result[$key]['authfinalhr'] =$val['authfinalempname'].' '.$hrfinalnane.'(Approved)';
                    if($val['authfinal']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 2;
                        $naval=2;
                        }
                        $authempidstatus =$val['authfinalstatus'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }elseif($val['authfinalstatus']== 2){
                    $result[$key]['authfinalhr']=$val['authfinalempname'].' '.$hrfinalnane.'(Rejected)';
                    if($val['authfinal']== $employeeidval ){
                                                
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                            $editbtn = 1;
                        $naval=2;
                        }
                        $authempidstatus =$val['authfinalstatus'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }else{
                    if(!empty($result[$key]['authfinal'])){
                        $result[$key]['authfinalhr'] = $val['authfinalempname'].' '.$hrfinalnane.'(Wating for approval)';
                        if($val['authfinal']== $employeeidval ){
                                                    
                        if($val['finalacceptstatus'] ==2){
                            $editbtn =  0;
                            $naval=0;
                        }
                        elseif($val['finalacceptstatus'] !=3){
                                $editbtn = 1;
                                $naval=2;
                        // elseif(($val['finalacceptstatus'] !=3)||($val['finalacceptstatus']==9)){
                        //         $editbtn = 1;
                        //         $naval=1;
                        
                            }
                            $authempidstatus =$val['authfinal'];
                            $authempiddesc = $val['authfinaldesc'];
                        }
                    }else{
                        $result[$key]['authfinalhr'] ='';
                    }
                }
                
                if( ($val['employeeid'] == $employeeidval) && ($val['status'] == 1) &&  ( ($val['auth1status'] == 0)&&($val['auth2status'] == 0) && ($val['auth3status'] ==0 )&&($val['auth4status'] ==0)&&($val['authfinalstatus'] ==0) ) ){
                    $editbtn = 1;
                    $naval =1;
                }else if(($val['employeeid'] == $employeeidval) && ($val['status'] == 0) && (  ($val['auth1status'] == 0)&&($val['auth2status'] == 0) && ($val['auth3status'] ==0 )&&($val['auth4status'] ==0)&&($val['authfinalstatus'] ==0)  )){
                    $editbtn = 2;
                    $naval = 1;
                }else{
                    $editbtn=$editbtn;
                    $naval =$naval;
                }

                // $result[$key]['status1']='Approval';
                $result[$key]['countlist']=  $countlist;
                $result[$key]['status2']=  $naval;              // 2-- (approval button) ,1-- (edit button) ,0-- (No button)   
                $result[$key]['editstatusval']=$editbtn;        // 2-- hide button  ,1-- show button   ,0-- no buttons
                $result[$key]['authempidstatus']=$authempidstatus;
                $result[$key]['authempiddesc']=$authempiddesc;

               
                unset($result[$key]['authempname1']);
                unset($result[$key]['authempname2']);
                unset($result[$key]['authempname3']);
                unset($result[$key]['authempname4']);
                unset($result[$key]['authfinalempname']);
                unset($result[$key]['authfinalname']);
                unset($result[$key]['finalhracceptid']);
                unset($result[$key]['auth1status']);
                unset($result[$key]['hrfinalempname']);
                unset($result[$key]['auth2status']);
                unset($result[$key]['auth3status']);
                unset($result[$key]['auth4status']);
                unset($result[$key]['authfinalstatus']);
                unset($result[$key]['auth1']);
                unset($result[$key]['auth2']);
                unset($result[$key]['auth3']);
                unset($result[$key]['auth4']);
                unset($result[$key]['authfinal']);
                unset($result[$key]['status']);
             // unset($result[$key]['finalhracceptname']);
                
        }
        $x=array();
        if(($searchempid !=0) || ($searchempid !='')){
            foreach($result as $rkey=>$rval){
                if($rval['employeeid']==$searchempid){
                    array_push($x,$result[$rkey]);
                }else{
                    continue;
                }
            }
           $res19= $x;
        }else{
            $res19=$result;
        }
        $d['status']=200;
        $d['msg']='sucess';
        $d['desc']='';
        $d['attendancelist']=$res19;
        return $res19;
    }

    public function api_delete_leavesapply($employeeid,$uniqid,$companyid,$divisionid,$stateid,$branchid,$device_status)
    {
        $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                            mxar_noofdays as noofdays,mxar_from as from,mxar_to as to,mxar_desc as desc,
                            mxar_auth1_empcode as auth1empcode,mxar_auth2_empcode as auth2empcode,
                            mxar_auth3_empcode as auth3empcode,mxar_auth4_empcode as auth4empcode,
                            mxar_authfinal_empcode as authfinalempcode,mxar_hrfinal_accept as hrfinalempcode,
                            mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
                            mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
                            mxar_status as status,mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename,
                            mxar_comp_id as compid,mxar_div_id as divid,mxar_state_id as stateid,mxar_branch_id as branchid ');
        $this->db->from('attendance_user_leaveadjust');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        if($result[0]['status'] != 0 ){
            $leavetypeid = $result[0]['leavetypeid'];
            $leavetypename = $result[0]['leavetypename'];
            
            $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                               mxemp_leave_bal_division,mxemp_leave_bal_leave_type,mxemp_leave_bal_id');
            $this->db->from('maxwell_emp_leave_balance');
            $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
            $this->db->where('mxemp_leave_bal_leave_type',$leavetypeid);
            $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leavetypename);
            $this->db->where('mxemp_leave_bal_status = 1');
            $query = $this->db->get();
            $balance = $query->result_array();  
    
            if(count($result)>0){
                if(($result[0]['auth1'] !=0) || ($result[0]['auth2'] != 0) || ($result[0]['auth3'] != 0 ) || ($result[0]['auth4'] != 0 ) || ($result[0]['authfinal'] != 0) ){
                    if($result[0]['auth1'] != 0 ){ $naval = $result[0]['auth1empcode'];}
                    if($result[0]['auth2'] != 0 ){ $naval .= $result[0]['auth2empcode'];}
                    if($result[0]['auth3'] != 0 ){ $naval .= $result[0]['auth3empcode'];}
                    if($result[0]['auth4'] != 0){ $naval .= $result[0]['auth4empcode'];}
                    if($result[0]['authfinal'] != 0){ $naval .= $result[0]['authfinalempcode'];}
                     $message="Failed";
                     $statuscode="500";
                     $leavedata1['status']=$statuscode;
                     $leavedata1['msg']=$message;
                     $leavedata1['description']="Already accepted by " .$naval . " so that unable delete ";
                     return $leavedata1 ;
                }else{
                    $this->db->trans_begin();  
                    $data = array(
                        'mxar_status'=>0,
                        'mxar_emp_modifyby'=> $employeeid,
                        'mxar_emp_modifiedtime'=> DBDT
                    );
                    $this->db->where('mxar_id', $uniqid);
                    $this->db->where('mxar_appliedby_emp_code', $employeeid);
                    $res = $this->db->update('attendance_user_leaveadjust',$data);
                    if($result[0]['leavetypename'] != 'SHRT' ){
                        $calbal = $result[0]['noofdays'] + $balance[0]['mxemp_leave_bal_crnt_bal'];
                        $updata=array(
                                        'mxemp_leave_bal_crnt_bal'=>$calbal
                                     );
                        $updatawhere= array(
                                       'mxemp_leave_bal_emp_id'=>$employeeid,
                                       'mxemp_leave_bal_leave_type'=>$leavetypeid,
                                       'mxemp_leave_bal_leave_type_shrt_name'=>$leavetypename,
                                       'mxemp_leave_bal_id'=>$balance[0]['mxemp_leave_bal_id']
                                    );
                        $this->db->where($updatawhere);
                        $res = $this->db->update('maxwell_emp_leave_balance',$updata);
                    }else{
                        $calbal = 0;
                    }
                    $datalog=array(
                        'mxar_leaveadjust_unique_id'=>$uniqid,
                        'mxar_roll_status'=>'delete',
                        'mxar_comp_id'=>$result[0]['compid'],
                        'mxar_div_id'=>$result[0]['divid'],
                        'mxar_state_id'=>$result[0]['stateid'],
                        'mxar_branch_id'=>$result[0]['branchid'],
                        'mxar_category_type'=>$result[0]['category_type'],
                        'mxar_leave_type_id'=>$result[0]['leavetypeid'],
                        'mxar_leave_type'=>$result[0]['leavetypename'],
                        'mxar_appliedby_emp_code'=>$result[0]['employeeid'],
                        'mxar_from'=>$result[0]['from'],
                        'mxar_to'=>$result[0]['to'],
                        'mxar_noofdays'=>$result[0]['noofdays'],
                        'mxar_desc'=>$result[0]['emp_desc'],
                        'mxar_minus_leaves'=>$noofdays,
                        'mxar_previous_bal'=>$balance[0]['mxemp_leave_bal_crnt_bal'],
                        'mxar_current_bal'=>$calbal,
                        'mxar_device_status'=> $device_status,
                        'mxar_createdby'=>$employeeid,
                        'mxar_createdtime'=>DBDT,
                        'mxar_created_ip'=>''
                     );
            
                    $reslogleavedel = $this->db->insert('attendance_user_leaveadjust_log',$datalog);
                    
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $message="Failed";
                        $statuscode="500";
                        $desc = "Failed To Apply Leave";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']=$desc;
                        return $leavedata1;
                    } else {
                        $this->db->trans_commit();
                        $message = "Success";
                        $statuscode = "200";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='';
                        $qry1 = array('statusmsg'=>'Sucessfully Updated');
                        $leavedata1['leave_apply']=$qry1;
                        return $leavedata1;
                    }
                  
                }
            }else{
                $message = "Failed";
                $statuscode = "500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='No Data Found to delete record';
                // $leavedata1['leave_apply']=" No Data Found to delete record";
                return $leavedata1;
            }
        }else{
            $message = "Failed";
            $statuscode = "500";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']='Already Deleted';
            // $leavedata1['leave_apply']="Already Deleted";
            return $leavedata1;
        }
    }
   
    public function api_edit_leavesapply($employeeid,$uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$noofdays,$device_status,$emp_desc,$leave_cateory,$leave_address)
    {
        // -------------- to apply OH and OCH chech wether in holiday mastr table ------------
         
        if((($leave_cateory == 'OH')||($leave_cateory == 'OCH')) && ($noofdays <= 1)){
            $this->db->select('mx_holiday_date');
            $this->db->from('maxwell_holiday_master');
            $this->db->where('mx_holiday_status = 1');
            $this->db->where('mx_holiday_date = ',$from);
            $this->db->where('mx_holiday_date = ',$to);
            $query = $this->db->get();
            $result = $query->result();
            // print_r(count($result)); exit;
            // echo $this->db->last_query(); exit;
            if(count($result) <= 0){  
                $desc = "Cannot be applied because not an optinal holiday "; 
                $message = "Failed";
                $statuscode = "500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$desc;
                // $leavedata1['leave_apply']="Sucessfully Leave Applied";
                return $leavedata1;
            }
        }
        
        if($leave_cateory == 'SHRT'){  
            $desc = "Cannot be modify to SHRT leave"; 
            $message = "Failed";
            $statuscode = "500";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']=$desc;
            // $leavedata1['leave_apply']="Sucessfully Leave Applied";
            return $leavedata1;
        }
        
        // -------------- to apply OH and OCH chech wether in holiday mastr table ------------

        // $dayscountrange = $this->date_rangewith_days($from,$to,category_type);
        $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_noofdays as noofdays,
                            mxar_from as from,mxar_to as to,mxar_desc as desc,
                            mxar_auth1_empcode as auth1empcode,mxar_auth2_empcode as auth2empcode,mxar_auth3_empcode as auth3empcode,mxar_auth4_empcode as auth4empcode,
                            mxar_authfinal_empcode as authfinalempcode,mxar_hrfinal_accept as hrfinalempcode,
                            mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
                            mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
                            mxar_status as status,mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename');
        $this->db->from('attendance_user_leaveadjust');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        $leavetypeid = $result[0]['leavetypeid'];
        $leavetypename = $result[0]['leavetypename'];
        
        if($leavetypename == 'SHRT'){
            $desc = "Cannot be modified once SHRT is applied"; 
            $message = "Failed";
            $statuscode = "500";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']=$desc;
            return $leavedata1;
        }

        if(($result[0]['auth1'] != 0) || ($result[0]['auth2']!= 0) || ($result[0]['auth3']!= 0) || ($result[0]['auth4']!= 0) || ($result[0]['authfinal']!= 0) ){
            if($result[0]['auth1']!= 0){ $naval = $result[0]['auth1empcode'];}
            if($result[0]['auth2']!= 0){ $naval .= $result[0]['auth2empcode'];}
            if($result[0]['auth3']!= 0){ $naval .= $result[0]['auth3empcode'];}
            if($result[0]['auth4']!= 0){ $naval .= $result[0]['auth4empcode'];}
            if($result[0]['authfinal']!= 0){ $naval .= $result[0]['authfinalempcode'];}
             $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']="Already accepted or rejected by " .$naval ;
                // $leavedata1['leave_apply']="Already accepted or rejected by " .$naval ;
            return $leavedata1 ; 
        }

        $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                           mxemp_leave_bal_division,mxemp_leave_bal_leave_type');
        $this->db->from('maxwell_emp_leave_balance');
        $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
        $this->db->where('mxemp_leave_bal_leave_type',$leavetypeid);
        $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leavetypename);
        $this->db->where('mxemp_leave_bal_status = 1');
        $query = $this->db->get();
        $balance = $query->result_array();  
        

        if($leave_cateory != 'SHRT'){
            $current_ballea = $result[0]['noofdays'] + $balance[0]['mxemp_leave_bal_crnt_bal'];
            $catg_tp= $balance[0]['mxemp_leave_bal_leave_type_shrt_name'];
            // print_r($leave_cateory.'==='.$catg_tp .'--'.$noofdays .' > '. $current_ballea); exit;
            $cntbal = $balance[0]->mxemp_leave_bal_crnt_bal;
            // if($noofdays > $cntbal ){
            if(($noofdays > $current_ballea) && ($catg_tp == $leave_cateory)){
                create_notes($employeeid,'4',$leave_cateory .' Applying '.$noofdays. ' days leaves more than balance. Avaliable balance is '.$current_ballea.' ',$employeeid);
                $desc ='Applying leaves more than balance avaliable';
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$desc;
                return $leavedata1;
                
            }
        }
        

            $daysrange = $this->date_rangewith_days($from,$to,$category_type);
            $noofdays=$daysrange['noofday'];
            if((date('m',strtotime($from))) != (date('m',strtotime($to) ) )){
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='To different months cannot be applied';
                // $leavedata1['leave_apply']="To different months cannot be applied";
                return $leavedata1;
            }
            if ($from > $to) {
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='Please check from date to date correct';
                // $leavedata1['leave_apply']="Please check from date to date correct";
                return $leavedata1;
            }
            //  1 ->First Half  2 ->Secondhalf  3 -> fullday
            if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
                 $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='We are unable to apply half day with two dates different dates';
                // $leavedata1['leave_apply']="We are unable to apply half day with two dates different dates";
                return $leavedata1;
            }
            
            $resleave = $this->leavevalidation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$device_status,$emp_desc,$leave_cateory,$noofdays);
            // print_r($resleave); exit;
            if(!empty($resleave)){
                $message = "Failed";
                $statuscode = "500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$resleave;
                // $leavedata1['leave_apply']="Sucessfully Leave Applied";
                return $leavedata1;
            }
  
            $this->db->trans_begin();
            $calbal = $result[0]['noofdays'] + $balance[0]['mxemp_leave_bal_crnt_bal'];
            $datalog=array(
                'mxar_leaveadjust_unique_id'=>$uniqid,
                'mxar_roll_status'=>'Edit',
                'mxar_comp_id'=>$companyid,
                'mxar_div_id'=>$divisionid,
                'mxar_state_id'=>$stateid,
                'mxar_branch_id'=>$branchid,
                'mxar_category_type'=>$category_type,
                'mxar_leave_type_id'=>$leavetypeid,
                'mxar_leave_type'=>$leavetypename,
                'mxar_appliedby_emp_code'=>$employeeid,
                'mxar_from'=>$result[0]['from'],
                'mxar_to'=>$result[0]['to'],
                'mxar_noofdays'=>$result[0]['noofdays'],
                'mxar_plus_leaves'=>$result[0]['noofdays'],
                'mxar_previous_bal'=>$balance[0]['mxemp_leave_bal_crnt_bal'],
                'mxar_current_bal'=>$calbal,
                'mxar_device_status'=> $device_status,
                'mxar_createdby'=>$employeeid,
                'mxar_createdtime'=>DBDT,
                'mxar_created_ip'=>''
             );
    
            $resleavlog = $this->db->insert('attendance_user_leaveadjust_log',$datalog);

            $updata=array(
                            'mxemp_leave_bal_crnt_bal'=>$calbal
                         );
                         
            $updatawhere= array(
                           'mxemp_leave_bal_emp_id'=>$employeeid,
                           'mxemp_leave_bal_leave_type'=>$leavetypeid,
                           'mxemp_leave_bal_leave_type_shrt_name'=>$leavetypename,
                           'mxemp_leave_bal_id'=>$balance[0]['mxemp_leave_bal_id']
                        );
            $this->db->where($updatawhere);
            $res = $this->db->update('maxwell_emp_leave_balance',$updata);

            $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                               mxemp_leave_bal_division,mxemp_leave_bal_leave_type');
            $this->db->from('maxwell_emp_leave_balance');
            $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
            $this->db->where('mxemp_leave_bal_status = 1');
            $query = $this->db->get();
            $balanceinfo = $query->result();

            foreach ($balanceinfo as $key => $value) {
                if($value->mxemp_leave_bal_leave_type_shrt_name == $leave_cateory ){
                    $leavetypeid1 = $value->mxemp_leave_bal_leave_type;
                    $cntbal1 = $value->mxemp_leave_bal_crnt_bal;
                    $leavuniqid1 = $value->mxemp_leave_bal_id;
                    $lebal1 = $cntbal1-$noofdays;
                }
            }

           $data = array(
                'mxar_comp_id'=>$companyid,
                'mxar_div_id'=>$divisionid,
                'mxar_state_id'=>$stateid,
                'mxar_branch_id'=>$branchid,
                'mxar_category_type'=>$category_type,
                'mxar_appliedby_emp_code'=>$employeeid,
                'mxar_from'=>$from,
                'mxar_to'=>$to,
                'mxar_leave_type'=> $leave_cateory,
                'mxar_leavetypeid'=> $leavetypeid1,
                'mxar_noofdays'=>$noofdays,
                'mxar_minusleaves'=>$noofdays,
                'mxar_desc'=>$emp_desc,
                'mxar_device_status'=>$device_status,
                'leave_address'=>$leave_address
            );
            $this->db->where('mxar_id', $uniqid);
            $res1 = $this->db->update('attendance_user_leaveadjust',$data);

            $datalog=array(
                'mxar_leaveadjust_unique_id'=>$uniqid,
                'mxar_roll_status'=>'Edit',
                'mxar_comp_id'=>$companyid,
                'mxar_div_id'=>$divisionid,
                'mxar_state_id'=>$stateid,
                'mxar_branch_id'=>$branchid,
                'mxar_category_type'=>$category_type,
                'mxar_leave_type_id'=>$leavetypeid1,
                'mxar_leave_type'=>$leave_cateory,
                'mxar_appliedby_emp_code'=>$employeeid,
                'mxar_from'=>$from,
                'mxar_to'=>$to,
                'mxar_noofdays'=>$noofdays,
                'mxar_minus_leaves'=>$noofdays,
                'mxar_previous_bal'=>$cntbal1,
                'mxar_current_bal'=>$lebal1,
                'mxar_device_status'=> $device_status,
                'mxar_createdby'=>$employeeid,
                'mxar_createdtime'=>DBDT,
                'mxar_created_ip'=>''
             );
    
           $resinslevlog= $this->db->insert('attendance_user_leaveadjust_log',$datalog);

            $cluparray1 = array(
                "mxemp_leave_bal_crnt_bal" => $lebal1
            );
            $this->db->where('mxemp_leave_bal_id', $leavuniqid1);
            $this->db->where('mxemp_leave_bal_emp_id', $employeeid);
            $reslevbal = $this->db->update('maxwell_emp_leave_balance', $cluparray1);
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='Failed To Update';
                // $leavedata1['leave_apply']="Failed To Update";
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message="Success";
                $statuscode="200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                // $qry1 = array('statusmsg'=>'Sucessfully Updated');
                $qry1 = array('statusmsg'=>'success have great day');
                $leavedata1['leave_apply']=$qry1;
                return $leavedata1;
            }
    }

    function date_rangewith_days($fromdate,$todate,$category_type){
        $begin = new DateTime( $fromdate );
        $end   = new DateTime( $todate );
        $dayscount=0;
        $result=array();
        $dates = array();
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            array_push($result,$i->format("Y-m-d"));
            $dayscount+=1;
        }
        if( ($category_type == 1) || ($category_type == 2) ){ 
             $dates['noofday'] = 0.5;
        }else{  $dates['noofday'] = $dayscount; }
            $dates['attnddates'] = $result;
        return $dates;
    }
    
    
    public function api_hr_final_accept($authemployeeid,$companyid,$divisionid,$stateid,$branchid,$uniqid)
    {
        $this->db->distinct();
        $this->db->select("mxauth_emp_code as empid , mxauth_auth_type as authtype,concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ");  //mxauth_reporting_head_emp_code
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
        $this->db->where('mxauth_reporting_head_emp_code', $authemployeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        if(count($cnt) > 0){
            $this->db->select('mxar_id as mxid,mxar_comp_id as companyid,mxar_div_id as divisionid ,mxar_leavetypeid as leaveid,
                                mxar_leave_type as leavetype,mxar_noofdays as noleavedays,mxar_category_type as category_type,
                                mxar_appliedby_emp_code as employeeid,mxar_from as from ,mxar_to as to,
                                mxar_desc as desc,mxar_final_accept_status as finalstatus,mxar_status as status,
                                mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename');
            $this->db->from('attendance_user_leaveadjust');
            $this->db->where('mxar_id', $uniqid);
            $this->db->where('mxar_status',1);
            $query= $this->db->get();
            $result = $query->result();
        
            $this->db->select('mxar_previous_bal as previous_bal,mxar_current_bal as current_bal,');
            $this->db->from('attendance_user_leaveadjust_log');
            $this->db->where('mxar_leaveadjust_unique_id', $uniqid);
            $this->db->where('mxar_appliedby_emp_code', $result[0]->employeeid);
            $this->db->order_by("mxar_id", "desc");
            $this->db->limit(1);
            $query= $this->db->get();
            $result1 = $query->result();
                
            $this->db->trans_begin();
        /*    
            if($result[0]->leavetype == 'SHRT'){
                if(($result[0]->noleavedays >= 1) && ($result[0]->category_type == 3)){
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                                        "mxar_emp_modifyby" => $empid,
                                        "mxar_emp_modifiedtime" => DBDT
                                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                            'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                            'mxemp_leave_history_division_id' => $result[0]->divisionid,
                            'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                            'mxemp_leave_history_short_name' => $result[0]->leavetype,
                            'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                            'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                            'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                            'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                            'mxemp_leave_history_process_type' => 'MobileApi',
                            'mxemp_leave_history_createdby' => $authemployeeid,
                            'mxemp_leave_history_createdtime' =>DBD
                            // 'mxemp_leave_history_created_ip' => $ip
                        );
                    $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    $days=$result[0]->noleavedays;
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                            
                    for($i=1;$i<=$days;$i++){
                        $this->db->select('mx_attendance_id as attenduniqueid');
                        $this->db->from('maxwell_attendance_'.$dateym);
                        $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                        $this->db->where('mx_attendance_date', $dateymd);
                        $query= $this->db->get();
                        $result2 = $query->result();
        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
        
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.0,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.0,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $authemployeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
        
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.0,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.0,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $authemployeeid,
                                'mxemp_leave_adjust_createdtime' => DBD
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
                        
                        $repeat = strtotime("+1 day",strtotime($dateymd));
                        $dateymd = date('Y-m-d',$repeat);
                    }
                
                    // if(($resdethist == 1)&&($resattend == 1)&&($resrollbck ==1)){
                    //     return "sucessfully updated";
                    // }else{
                    //     return "something went wrong";
                    // }
                    
                }elseif( $result[0]->noleavedays == 0.5){
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                        "mxar_emp_modifyby" => $empid,
                        "mxar_emp_modifiedtime" => DBDT
                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                        'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                        'mxemp_leave_history_division_id' => $result[0]->divisionid,
                        'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                        'mxemp_leave_history_short_name' => $result[0]->leavetype,
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                        'mxemp_leave_history_process_type' => 'MobileApi',
                        'mxemp_leave_history_createdby' => $result[0]->employeeid,
                        'mxemp_leave_history_createdtime' =>DBD
                        // 'mxemp_leave_history_created_ip' => $ip
                    );
                    $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                                                
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();
            
                    if($result[0]->category_type == 1){
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.0,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.0,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $employeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                    
                        // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                        //     return "sucessfully updated";
                        // }else{
                        //     return "something went wrong";
                        // }
                        
                    }elseif($result[0]->category_type == 2){
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.0,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.0,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $employeeid,
                                'mxemp_leave_adjust_createdtime' => DBD
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
            
                        $cluparray1 = array(
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                        
                        // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                        //     return "sucessfully updated";
                        // }else{
                        //     return "something went wrong";
                        // }                   
                    }
                }
            }elseif($result[0]->leavetype != 'SHRT'){  
        */
                if(($result[0]->noleavedays >= 1) && ($result[0]->category_type == 3)){
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                                        "mxar_emp_modifyby" => $empid,
                                        "mxar_emp_modifiedtime" => DBDT
                                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                            'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                            'mxemp_leave_history_division_id' => $result[0]->divisionid,
                            'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                            'mxemp_leave_history_short_name' => $result[0]->leavetype,
                            'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                            'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                            'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                            'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                            'mxemp_leave_history_process_type' => 'MobileApi',
                            'mxemp_leave_history_createdby' => $authemployeeid,
                            'mxemp_leave_history_createdtime' =>DBD
                            // 'mxemp_leave_history_created_ip' => $ip
                        );
                    $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    $days=$result[0]->noleavedays;
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                            
                    for($i=1;$i<=$days;$i++){
                        $this->db->select('mx_attendance_id as attenduniqueid');
                        $this->db->from('maxwell_attendance_'.$dateym);
                        $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                        $this->db->where('mx_attendance_date', $dateymd);
                        $query= $this->db->get();
                        $result2 = $query->result();
        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
        
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $authemployeeid,
                            'mxemp_leave_adjust_createdtime' => DBD,
                            'mxar_leave_unique_id'=>$uniqid
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
        
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.5,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.5,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $authemployeeid,
                                'mxemp_leave_adjust_createdtime' => DBD,
                                'mxar_leave_unique_id'=>$uniqid
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
                        
                        $repeat = strtotime("+1 day",strtotime($dateymd));
                        $dateymd = date('Y-m-d',$repeat);
                    }
                
                    // if(($resdethist == 1)&&($resattend == 1)&&($resrollbck ==1)){
                    //     return "sucessfully updated";
                    // }else{
                    //     return "something went wrong";
                    // }
                    
                }elseif( $result[0]->noleavedays == 0.5){
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                                        "mxar_emp_modifyby" => $empid,
                                        "mxar_emp_modifiedtime" => DBDT,
                                        "mxar_hr_final_accept_date" => DBDT
                                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                        'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                        'mxemp_leave_history_division_id' => $result[0]->divisionid,
                        'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                        'mxemp_leave_history_short_name' => $result[0]->leavetype,
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                        'mxemp_leave_history_process_type' => 'MobileApi',
                        'mxemp_leave_history_createdby' => $result[0]->employeeid,
                        'mxemp_leave_history_createdtime' =>DBD
                        // 'mxemp_leave_history_created_ip' => $ip
                    );
                    $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                                                
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();
            
                    if($result[0]->category_type == 1){
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $employeeid,
                            'mxemp_leave_adjust_createdtime' => DBD,
                            'mxar_leave_unique_id'=>$uniqid
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                    
                        // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                        //     return "sucessfully updated";
                        // }else{
                        //     return "something went wrong";
                        // }
                        
                    }elseif($result[0]->category_type == 2){
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.5,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.5,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $employeeid,
                                'mxemp_leave_adjust_createdtime' => DBD,
                                'mxar_leave_unique_id'=>$uniqid
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
            
                        $cluparray1 = array(
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                                         
                    }
                }
        //    }
            
            /*
            if(($result[0]->noleavedays >= 1) && ($result[0]->category_type == 3)){
                $cldata = array(
                        'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                        'mxemp_leave_history_division_id' => $result[0]->divisionid,
                        'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                        'mxemp_leave_history_short_name' => $result[0]->leavetype,
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                        'mxemp_leave_history_process_type' => 'MobileApi',
                        'mxemp_leave_history_createdby' => $authemployeeid,
                        'mxemp_leave_history_createdtime' =>DBD
                        // 'mxemp_leave_history_created_ip' => $ip
                    );
                $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                $days=$result[0]->noleavedays;
                $dateymd = date('Y-m-d',strtotime($result[0]->from));
                $dateym = date('Y_m',strtotime($result[0]->from));
                        
                for($i=1;$i<=$days;$i++){
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();
    
                    $cluparray1 = array(
                        "mx_attendance_first_half" => $result[0]->leavetype,
                        "mx_attendance_second_half" => $result[0]->leavetype
                    );
                    $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                    $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                    $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
    
                    $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                           'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                           'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                           'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                           'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                           'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                           'mxemp_leave_adjust_first_half_minus' => 0.5,
                           'mxemp_leave_adjust_attendance_date' => $dateymd,
                           'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                           'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                           'mxemp_leave_adjust_present_minus' => 0.5,
                           'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                           'mxemp_leave_adjust_createdby' => $authemployeeid,
                           'mxemp_leave_adjust_createdtime' => DBD
                        // 'mxemp_leave_adjust_created_ip' => $ip
                        );
                    $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
    
                    $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_second_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                            'mxemp_leave_adjust_createdby' => $authemployeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                        //  'mxemp_leave_adjust_created_ip' => $ip
                        );
                    $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
                    
                    $repeat = strtotime("+1 day",strtotime($dateymd));
                    $dateymd = date('Y-m-d',$repeat);
                }
               
                // if(($resdethist == 1)&&($resattend == 1)&&($resrollbck ==1)){
                //     return "sucessfully updated";
                // }else{
                //     return "something went wrong";
                // }
                
            }elseif( $result[0]->noleavedays == 0.5){
                $cldata = array(
                    'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                    'mxemp_leave_history_division_id' => $result[0]->divisionid,
                    'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                    'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                    'mxemp_leave_history_short_name' => $result[0]->leavetype,
                    'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                    'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                    'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                    'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                    'mxemp_leave_history_process_type' => 'MobileApi',
                    'mxemp_leave_history_createdby' => $result[0]->employeeid,
                    'mxemp_leave_history_createdtime' =>DBD
                    // 'mxemp_leave_history_created_ip' => $ip
                );
                $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
               
                $dateymd = date('Y-m-d',strtotime($result[0]->from));
                $dateym = date('Y_m',strtotime($result[0]->from));
                                             
                $this->db->select('mx_attendance_id as attenduniqueid');
                $this->db->from('maxwell_attendance_'.$dateym);
                $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                $this->db->where('mx_attendance_date', $dateymd);
                $query= $this->db->get();
                $result2 = $query->result();
        
                if($result[0]->category_type == 1){
                    $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                        'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                        'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                        'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                        'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                        'mxemp_leave_adjust_first_half_minus' => 0.5,
                        'mxemp_leave_adjust_attendance_date' => $dateymd,
                        'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                        'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                        'mxemp_leave_adjust_present_minus' => 0.5,
                        'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                        'mxemp_leave_adjust_createdby' => $employeeid,
                        'mxemp_leave_adjust_createdtime' => DBD
                        // 'mxemp_leave_adjust_created_ip' => $ip
                        );
                    $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                    $cluparray1 = array(
                        "mx_attendance_first_half" => $result[0]->leavetype,
                    );
                    $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                    $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                    $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                   
                    // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                    //     return "sucessfully updated";
                    // }else{
                    //     return "something went wrong";
                    // }
                    
                }elseif($result[0]->category_type == 2){
                    $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_second_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                            'mxemp_leave_adjust_createdby' => $employeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                        //  'mxemp_leave_adjust_created_ip' => $ip
                        );
                    $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
        
                    $cluparray1 = array(
                        "mx_attendance_second_half" => $result[0]->leavetype
                    );
                    $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                    $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                    $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                    
                    // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                    //     return "sucessfully updated";
                    // }else{
                    //     return "something went wrong";
                    // }                   
                }
            }*/
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='Failed To Update';
                // $leavedata1['leave_apply']="Failed To Update";
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message="Success";
                $statuscode="200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                $qry1 = array('statusmsg'=>'Sucessfully Updated');
                $leavedata1['leave_apply']=$qry1;
                return $leavedata1;
            }
            
        }else{
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='You are not an authorized person to accept';
                // $leavedata1['leave_apply']="You are not an authorized person to accept ";
                return $leavedata1;
        }
            
    } 
    
    
    public function admin_leave_hraccept_approval($adminemployeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid)
    {
            $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                mxar_noofdays as noofdays,mxar_from as from,mxar_to as to,mxar_desc as desc,
                mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
                mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
                mxar_status as status,mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename,
                mxar_comp_id as compid,mxar_div_id as divid,mxar_state_id as stateid,mxar_branch_id as branchid ');
            $this->db->from('attendance_user_leaveadjust');
            $this->db->where('mxar_id', $uniqid);
            $query = $this->db->get();
            $result = $query->result_array();
           // echo $this->db->last_query();exit;
            if(count($result)>0){
                if($approve == 1){
                    $autharry= array(
                            "mxar_authfinal_remarks"=>$remarks,
                            "mxar_hrfinal_accept"=>$adminemployeeid,  //$this->session->userdata('user_id'),
                            "mxar_hrfinal_acceptdate"=>DBD, //date('Y-m-d H:i:s'),
                            "mxar_hrfinal_acceptcreatedby"=>$adminemployeeid, //$this->session->userdata('user_id'),
                            "mxar_hrfinal_acceptname"=>$employeename, //$this->session->userdata('user_name'),
                            "mxar_final_accept_status"=>1,
                            "mxar_authfinal_status"=>$approve,
                            "mxar_authfinal_createdtime"=>DBD, //date('Y-m-d H:i:s'),
                            "mxar_authfinal_deviceid"=>'Mobile',
                            "mxar_emp_modifyby" => $employeeid,
                            "mxar_emp_modifiedtime" => DBDT
                        );
                        // ========================  added on 24-08-2024 ===================
                        if($approve == 1){
                            $autharry['mxar_authfinal_approve_date']=DBDT;
                        }elseif($approve==2){
                            $autharry['mxar_authfinal_reject_date']=DBDT;
                        }
                        // ========================  end on 24-08-2024 =====================
                        
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_user_leaveadjust',$autharry);
                    // echo $this->db->last_query(); exit;
                    if($res == 1){
                        // return "Sucessfully Updated ";
                                    $message="Sucess";
                                    $statuscode="200";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='';
                                    $qry1 = array('statusmsg'=>'Sucessfully Updated');
                                    $leavedata1['leave_apply']=$qry1;
                                    return $leavedata1;
                    }else{
                        // return "something went wrong ";
                        $message="Failed";
                        $statuscode="500";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='No data exist to upadte';
                        // $leavedata1['leave_apply']="Nodata exist with update";
                        return $leavedata1;
                        
                    }
                }else{
                    if($result[0]['authfinal'] != 2){
                            $leavetypeid = $result[0]['leavetypeid'];
                            $leavetypename = $result[0]['leavetypename'];
                            $employeeid = $result[0]['employeeid'];
                            
                            $this->db->select('mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxemp_leave_bal_emp_id,mxemp_leave_bal_id,mxemp_leave_bal_comp,
                                               mxemp_leave_bal_division,mxemp_leave_bal_leave_type,mxemp_leave_bal_id');
                            $this->db->from('maxwell_emp_leave_balance');
                            $this->db->where('mxemp_leave_bal_emp_id',$employeeid);
                            $this->db->where('mxemp_leave_bal_leave_type',$leavetypeid);
                            $this->db->where('mxemp_leave_bal_leave_type_shrt_name',$leavetypename);
                            $this->db->where('mxemp_leave_bal_status = 1');
                            $query = $this->db->get();
                            $balance = $query->result_array();  
                            $this->db->trans_begin();  
                            $autharry= array(
                                    "mxar_authfinal_remarks"=>$remarks,
                                    "mxar_hrfinal_accept"=> $adminemployeeid, //$this->session->userdata('user_id'),
                                    "mxar_hrfinal_acceptdate"=> DBD, //date('Y-m-d H:i:s'),
                                    "mxar_hrfinal_acceptcreatedby"=>$adminemployeeid, //$this->session->userdata('user_id'),
                                    "mxar_hrfinal_acceptname"=> $employeename, //$this->session->userdata('user_name'),
                                    "mxar_final_accept_status"=>2, //2 reject ,3 accept 
                                    // "mxar_status"=>0,
                                    "mxar_authfinal_status"=>$approve,
                                    "mxar_authfinal_createdtime"=>DBD, //date('Y-m-d H:i:s'),
                                    "mxar_authfinal_deviceid"=>'Mobile',
                                    "mxar_emp_modifyby" => $employeeid,
                                    "mxar_emp_modifiedtime" => DBDT
                                );
                                // ========================  added on 24-08-2024 ===================
                                if($approve == 1){
                                    $autharry['mxar_authfinal_approve_date']=DBDT;
                                }elseif($approve==2){
                                    $autharry['mxar_authfinal_reject_date']=DBDT;
                                }
                                // ========================  end on 24-08-2024 =====================
                            $this->db->where('mxar_id', $uniqid);
                            $resleavadj = $this->db->update('attendance_user_leaveadjust',$autharry);
                            
                            $calbal = $result[0]['noofdays'] + $balance[0]['mxemp_leave_bal_crnt_bal'];
                            //if($leavetypeid == 11){ $calbal=0; }
                            $updata=array(
                                            'mxemp_leave_bal_crnt_bal'=>$calbal
                                         );
                            $updatawhere= array(
                                           'mxemp_leave_bal_emp_id'=>$employeeid,
                                           'mxemp_leave_bal_leave_type'=>$leavetypeid,
                                           'mxemp_leave_bal_leave_type_shrt_name'=>$leavetypename,
                                           'mxemp_leave_bal_id'=>$balance[0]['mxemp_leave_bal_id']
                                        );
                            $this->db->where($updatawhere);
                            $resleavbal = $this->db->update('maxwell_emp_leave_balance',$updata);
                
                            $datalog=array(
                                'mxar_leaveadjust_unique_id'=>$uniqid,
                                'mxar_roll_status'=>'Reject',
                                'mxar_comp_id'=>$result[0]['compid'],
                                'mxar_div_id'=>$result[0]['divid'],
                                'mxar_state_id'=>$result[0]['stateid'],
                                'mxar_branch_id'=>$result[0]['branchid'],
                                'mxar_category_type'=>$result[0]['category_type'],
                                'mxar_leave_type_id'=>$result[0]['leavetypeid'],
                                'mxar_leave_type'=>$result[0]['leavetypename'],
                                'mxar_appliedby_emp_code'=>$result[0]['employeeid'],
                                'mxar_from'=>$result[0]['from'],
                                'mxar_to'=>$result[0]['to'],
                                'mxar_noofdays'=>$result[0]['noofdays'],
                                'mxar_desc'=>$result[0]['emp_desc'],
                                'mxar_minus_leaves'=>$result[0]['noofdays'],
                                'mxar_previous_bal'=>$balance[0]['mxemp_leave_bal_crnt_bal'],
                                'mxar_current_bal'=>$calbal,
                                'mxar_device_status'=> $deviceid,
                                'mxar_createdby'=> $adminemployeeid, //$this->session->userdata('user_id'),
                                'mxar_createdtime'=>DBD, //date('Y-m-d H:i:s'),
                                // 'mxar_authfinal_deviceid'=>'Mobile'
                                // 'mxar_created_ip'=>''
                             );
                            $reslogleavedel = $this->db->insert('attendance_user_leaveadjust_log',$datalog);
                            if ($this->db->trans_status() === FALSE) {
                                    $this->db->trans_rollback();
                                    // return "Failed To Update ";
                                    $message="Failed";
                                    $statuscode="500";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='Failed to update';
                                    // $leavedata1['leave_apply']="Failed To Update";
                                    return $leavedata1;
                            }else{
                                 $this->db->trans_commit();
                                //  return "Sucessfully Updated"; 
                                    $message="Sucess";
                                    $statuscode="200";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='';
                                    $qry1 = array('statusmsg'=>'Sucessfully Updated');
                                    $leavedata1['leave_apply']=$qry1;
                                    return $leavedata1;
                            }
                    }else{
                        $message="Failed";
                        $statuscode="500";
                        $leavedata1['status']=$statuscode;
                        $leavedata1['msg']=$message;
                        $leavedata1['description']='Already Rejected';
                        // $leavedata1['leave_apply']="Already rejected'";
                        return $leavedata1;
                        //  return 'Already rejected'; 
                    }
                }  
            }else{
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='No data exist to update';
                // $leavedata1['leave_apply']="Nodata exist with update";
                return $leavedata1;
                //  return 'Nodata exist with update'; 
            }
    }
        
    public function admin_hr_final_accept($empid,$uniqid,$deviceid,$companyid,$divisionid,$stateid,$branchid)
    {  
        $this->db->select('mxar_id as mxid,mxar_comp_id as companyid,mxar_div_id as divisionid ,mxar_leavetypeid as leaveid,
                            mxar_leave_type as leavetype,mxar_noofdays as noleavedays,mxar_category_type as category_type,
                            mxar_appliedby_emp_code as employeeid,mxar_from as from ,mxar_to as to,mxar_authfinal_status as authfinalstatus,
                            mxar_desc as desc,mxar_final_accept_status as finalstatus,mxar_status as status,mxar_leavetypeid as leavetypeid');
        $this->db->from('attendance_user_leaveadjust');
        $this->db->where('mxar_id', $uniqid);
        $this->db->where('mxar_status',1);
        $query= $this->db->get();
        $result = $query->result();
        // echo $this->db->last_query(); die;
        // print_r(($result[0]->finalstatus == 1) .'&&'. ($result[0]->authfinalstatus ==1).' &&'. ($result[0]->status ==1)); exit;
        
       if( ($result[0]->finalstatus ==1) && ($result[0]->authfinalstatus ==1) && ($result[0]->status ==1) ){
            $this->db->select('mxar_previous_bal as previous_bal,mxar_current_bal as current_bal,');
            $this->db->from('attendance_user_leaveadjust_log');
            $this->db->where('mxar_leaveadjust_unique_id', $uniqid);
            $this->db->where('mxar_appliedby_emp_code', $result[0]->employeeid);
            $this->db->order_by("mxar_id", "desc");
            $this->db->limit(1);
            $query= $this->db->get();
            $result1 = $query->result();
            $this->db->trans_begin();
        /*    if($result[0]->leavetype == 'SHRT'){
                if(($result[0]->noleavedays >= 1) && ($result[0]->category_type == 3)){

                    $leadimain = array( 'mxar_final_accept_status' =>3,
                        "mxar_emp_modifyby" => $empid,
                        "mxar_emp_modifiedtime" => DBDT
                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                            'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                            'mxemp_leave_history_division_id' => $result[0]->divisionid,
                            'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                            'mxemp_leave_history_short_name' => $result[0]->leavetype,
                            'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                            'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                            'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                            'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                            'mxemp_leave_history_process_type' => 'MobileApi',
                            'mxemp_leave_history_createdby' => $authemployeeid,
                            'mxemp_leave_history_createdtime' =>DBD
                            // 'mxemp_leave_history_created_ip' => $ip
                        );
                    $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    
                    $days=$result[0]->noleavedays;
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                            
                    for($i=1;$i<=$days;$i++){
                        $this->db->select('mx_attendance_id as attenduniqueid');
                        $this->db->from('maxwell_attendance_'.$dateym);
                        $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                        $this->db->where('mx_attendance_date', $dateymd);
                        $query= $this->db->get();
                        $result2 = $query->result();
        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
        
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.0,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.0,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $authemployeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
        
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.0,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.0,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $authemployeeid,
                                'mxemp_leave_adjust_createdtime' => DBD
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
                        
                        $repeat = strtotime("+1 day",strtotime($dateymd));
                        $dateymd = date('Y-m-d',$repeat);
                    }
                }elseif( $result[0]->noleavedays == 0.5){
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                        "mxar_emp_modifyby" => $empid,
                        "mxar_emp_modifiedtime" => DBDT
                    );  // 3 accept, 2 reject ,1 acceptby auth hr 
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                        'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                        'mxemp_leave_history_division_id' => $result[0]->divisionid,
                        'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                        'mxemp_leave_history_short_name' => $result[0]->leavetype,
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                        'mxemp_leave_history_process_type' => 'MobileApi',
                        'mxemp_leave_history_createdby' => $result[0]->employeeid,
                        'mxemp_leave_history_createdtime' =>DBD
                        // 'mxemp_leave_history_created_ip' => $ip
                    );
                    $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                                                
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();
            
                    if($result[0]->category_type == 1){
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.0,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.0,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $employeeid,
                            'mxemp_leave_adjust_createdtime' => DBD
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                    
                        // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                        //     return "sucessfully updated";
                        // }else{
                        //     return "something went wrong";
                        // }
                        
                    }elseif($result[0]->category_type == 2){
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                'mxemp_leave_adjust_second_half_minus' => 0.0,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                'mxemp_leave_adjust_present_minus' => 0.0,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => $employeeid,
                                'mxemp_leave_adjust_createdtime' => DBD
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
            
                        $cluparray1 = array(
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                        
                        // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                        //     return "sucessfully updated";
                        // }else{
                        //     return "something went wrong";
                        // }                   
                    }
                }
            }elseif($result[0]->leavetype != 'SHRT'){   */
                if(($result[0]->noleavedays >= 1) && ($result[0]->category_type == 3)){ 
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                        "mxar_emp_modifyby" => $empid,
                        "mxar_emp_modifiedtime" => DBDT,
                        "mxar_hr_final_accept_date" => DBDT
                    );  // 3 accept, 2 reject ,1 acceptby auth hr 
                    
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                            'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                            'mxemp_leave_history_division_id' => $result[0]->divisionid,
                            'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                            'mxemp_leave_history_short_name' => $result[0]->leavetype,
                            'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                            'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                            'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                            'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                            'mxemp_leave_history_process_type' => 'MobileApi',
                            'mxemp_leave_history_createdby' => $empid, //$this->session->userdata('user_id'),
                            'mxemp_leave_history_createdtime' => DBDT, //date('Y-m-d H:i:s'),
                            'mxemp_leave_history_created_ip' => ''
                        );
                    $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    
                    $days=$result[0]->noleavedays;
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                        
                    for($i=1;$i<=$days;$i++){
                        $this->db->select('mx_attendance_id as attenduniqueid');
                        $this->db->from('maxwell_attendance_'.$dateym);
                        $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                        $this->db->where('mx_attendance_date', $dateymd);
                        $query= $this->db->get();
                        $result2 = $query->result();
                        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                            "mx_attendance_second_half" => $result[0]->leavetype
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);

                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                                        'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                        'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                        'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                        'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                                        'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                                        'mxemp_leave_adjust_first_half_minus' => 0.5,
                                        'mxemp_leave_adjust_attendance_date' => $dateymd,
                                        'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                        'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                        'mxemp_leave_adjust_present_minus' => 0.5,
                                        'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                                        'mxemp_leave_adjust_createdby' => $empid,  //$this->session->userdata('user_id'),
                                        'mxemp_leave_adjust_createdtime' => DBDT, // date('Y-m-d H:i:s'),
                                        'mxemp_leave_adjust_created_ip' => ''
                            );
                        $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);

                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                            'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                            'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                            'mxemp_leave_adjust_second_half_minus' => 0.5,
                                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                            'mxemp_leave_adjust_present_minus' => 0.5,
                                            'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                            'mxemp_leave_adjust_createdby' =>$empid, // $this->session->userdata('user_id'),
                                            'mxemp_leave_adjust_createdtime' => DBDT, //date('Y-m-d H:i:s'),
                                            'mxemp_leave_adjust_created_ip' => '' // $ip
                                );
                        $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);

                        $repeat = strtotime("+1 day",strtotime($dateymd));
                        $dateymd = date('Y-m-d',$repeat);
                    }
                    // if(($resdethist == 1)&&($resattend == 1)&&($resrollbck ==1) && ($resleadimain ==1 )){
                        // return "sucessfully updated";
                            if($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $message="Failed";
                                $statuscode="500";
                                $leavedata1['status']=$statuscode;
                                $leavedata1['msg']=$message;
                                $leavedata1['description']='Something went wrong';
                                // $leavedata1['leave_apply']="something went wrong";
                                return $leavedata1;
                            }else{
                                $this->db->trans_commit();
                                $message="Sucess";
                                $statuscode="200";
                                $leavedata1['status']=$statuscode;
                                $leavedata1['msg']=$message;
                                $leavedata1['description']='';
                                $qry1 = array('statusmsg'=>'Sucessfully Updated');
                                $leavedata1['leave_apply']=$qry1;
                                return $leavedata1;
                            // return "something went wrong";
                            }
                }elseif( $result[0]->noleavedays == 0.5){
                    
                    $leadimain = array( 'mxar_final_accept_status' =>3,
                                        "mxar_emp_modifyby" => $employeeid,
                                        "mxar_emp_modifiedtime" => DBDT,
                                        "mxar_hr_final_accept_date" => DBDT);
                    $this->db->where('mxar_id', $uniqid);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    
                    $cldata = array(
                        'mxemp_leave_history_comp_id'=> $result[0]->companyid,
                        'mxemp_leave_history_division_id' => $result[0]->divisionid,
                        'mxemp_leave_history_emp_id' => $result[0]->employeeid,
                        'mxemp_leave_history_leavetype' => $result[0]->leaveid, 
                        'mxemp_leave_history_short_name' => $result[0]->leavetype,
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $result[0]->from .'-'. $result[0]->to,
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $result[0]->noleavedays,
                        'mxemp_leave_history_process_type' => 'MobileApi',
                        'mxemp_leave_history_createdby' =>$empid, //$this->session->userdata('user_id'),
                        'mxemp_leave_history_createdtime' => DBDT, //date('Y-m-d H:i:s'),
                        'mxemp_leave_history_created_ip' => ''
                    );
                    $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
        
                    $dateymd = date('Y-m-d',strtotime($result[0]->from));
                    $dateym = date('Y_m',strtotime($result[0]->from));
                                            
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $result[0]->employeeid);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();

                    if($result[0]->category_type == 1){
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                            'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                            'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                            'mxemp_leave_adjust_first_half_id' => $result[0]->leaveid, 
                            'mxemp_leave_adjust_first_half_short_name' => $result[0]->leavetype,
                            'mxemp_leave_adjust_first_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'mobilefirsthalf',
                            'mxemp_leave_adjust_createdby' => $empid, $this->session->userdata('user_id'),
                            'mxemp_leave_adjust_createdtime' => DBDT, //date('Y-m-d H:i:s'),
                            'mxemp_leave_adjust_created_ip' => ''
                            );
                        $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $result[0]->leavetype,
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                        $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                        //if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                            if($this->db->trans_status() === FALSE) {
                                    $this->db->trans_rollback();
                                    $message="Failed";
                                    $statuscode="500";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='Something went wrong';
                                    // $leavedata1['leave_apply']="something went wrong";
                                    return $leavedata1;
                                // return "sucessfully updated";
                            }else{
                                    $this->db->trans_commit();
                                    $message="Sucess";
                                    $statuscode="200";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='';
                                    $qry1 = array('statusmsg'=>'Sucessfully Updated');
                                    $leavedata1['leave_apply']=$qry1;
                                    return $leavedata1;
                            }
                        }elseif($result[0]->category_type == 2){
                            $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                    'mxemp_leave_adjust_comp_id' => $result[0]->companyid,
                                    'mxemp_leave_adjust_division_id' => $result[0]->divisionid,
                                    'mxemp_leave_adjust_emp_id' => $result[0]->employeeid,
                                    'mxemp_leave_adjust_second_half_id' => $result[0]->leaveid, 
                                    'mxemp_leave_adjust_second_half_short_name' => $result[0]->leavetype,
                                    'mxemp_leave_adjust_second_half_minus' => 0.5,
                                    'mxemp_leave_adjust_attendance_date' => $dateymd,
                                    'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                    'mxemp_leave_adjust_leavetype' => $result[0]->leaveid,
                                    'mxemp_leave_adjust_present_minus' => 0.5,
                                    'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                    'mxemp_leave_adjust_createdby' => $empid,// $this->session->userdata('user_id'),
                                    'mxemp_leave_adjust_createdtime' => DBDT, //date('Y-m-d H:i:s'),
                                    'mxemp_leave_adjust_created_ip' => ''
                                );
                            $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);

                            $cluparray1 = array(
                                "mx_attendance_second_half" => $result[0]->leavetype,
                            );
                            $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                            $this->db->where('mx_attendance_emp_code',$result[0]->employeeid);
                            $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                            if($this->db->trans_status() === FALSE) {
                                    $this->db->trans_rollback();
                                    $message="Failed";
                                    $statuscode="500";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='Something went wrong';
                                    // $leavedata1['leave_apply']="something went wrong";
                                    return $leavedata1;
                            }else{
                                    $this->db->trans_commit();
                                    $message="Sucess";
                                    $statuscode="200";
                                    $leavedata1['status']=$statuscode;
                                    $leavedata1['msg']=$message;
                                    $leavedata1['description']='';
                                    $qry1 = array('statusmsg'=>'Sucessfully Updated');
                                    $leavedata1['leave_apply']=$qry1;
                                    return $leavedata1;
                            }
                            // if(($resdethis == 1)&&($resfrstatt == 1)&&($resrllbck ==1)){
                            //     // return "sucessfully updated";
                            //     $message="Sucess";
                            //             $statuscode="200";
                            //             $leavedata1['status']=$statuscode;
                            //             $leavedata1['msg']=$message;
                            //             $leavedata1['description']='';
                            //             $leavedata1['leave_apply']="updated sucessfully";
                            //             return $leavedata1;
                            // }else{
                            //      $this->db->trans_commit();
                            //     // return "something went wrong";
                            //         $message="Failed";
                            //         $statuscode="500";
                            //         $leavedata1['status']=$statuscode;
                            //         $leavedata1['msg']=$message;
                            //         $leavedata1['description']='';
                            //         $leavedata1['leave_apply']="something went wrong";
                            //         return $leavedata1;
                            // }                   
                        }
                }
        //    }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='Failed to update';
                // $leavedata1['leave_apply']="Failed To Update";
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message="Sucess";
                $statuscode="200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                $qry1 = array('statusmsg'=>'Sucessfully Updated');
                $leavedata1['leave_apply']=$qry1;
                return $leavedata1;
            }
        }else{
            $message="Failed";
            $statuscode="500";
            $leavedata1['status']=$statuscode;
            $leavedata1['msg']=$message;
            $leavedata1['description']='Auth person should accept are reject';
            // $leavedata1['leave_apply']="Auth person should accept are reject";
            return $leavedata1;

            //return "Auth person should accept are reject";
        }
    } 
        
    // --------------------------------------- added 14-6-22 c --------------------    
    public function emp_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory)
    {
        if ($month < 10 && strlen($month) == 1) {
            $month_updated = "0" . $month;
        } else {
            $month_updated = $month;
        }
        $yearmonth = $year.'_'.$month_updated;

        $this->db->trans_begin();
        $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;

        $this->db->select('mxap_assign_id,mxap_assign_employee_code,mxap_assign_emp_noofaccounts,mxap_assign_emp_client_name,
                        mxap_assign_emp_description,mxap_assign_emp_achievement,mxap_assign_emp_createdtime,
                        mxap_assign_emp_modifiedtime,mxap_assign_catg');
        $this->db->from($tablename);
        $this->db->where('mxap_assign_id',$uniqid);
        // $this->db->where('mxemp_leave_bal_status = 1');
        $query = $this->db->get();
        $empapp = $query->result();
            $inarray = array(
            "mxap_assign_emp_noofaccounts" => $empnoacnt,
            // "mxap_assign_emp_client_name" => $empclientnam,
            // "mxap_assign_emp_description" => $empformdesc,
            // "mxap_assign_emp_achievement" => $emplachivement,
            "mxap_assign_modifyby" => $employeeid,
            //   "mxap_assign_emp_createdtime" => 
            //   "mxap_assign_emp_modifiedtime" =>
            "mxap_assign_modifiedtime" => DBDT,
            "mxap_assign_modified_ip" => ''
            ); 

            if($empapp[0]->mxap_assign_catg == 1){
                $inarray['mxap_assign_emp_client_name'] = $empclientnam;
                $inarray['mxap_assign_emp_achievement'] = $emplachivement;
                $inarray['mxap_assign_emp_description'] = $empformdesc;
            }
            // else{
            //     $inarray['mxap_assign_manager_noofaccounts'] = $empclientnam;
            //     $inarray['mxap_assign_manager_review'] = $empclientnam;
            // }
            if(empty($empapp[0]->mxap_assign_emp_createdtime) || ($empapp[0]->mxap_assign_emp_createdtime == '') || ($empapp[0]->mxap_assign_emp_createdtime == NULL) || ($empapp[0]->mxap_assign_emp_createdtime == '0000-00-00 00:00:00') ){
                $inarray['mxap_assign_emp_createdtime'] = DBDT;
            }else{
                $inarray['mxap_assign_emp_modifiedtime'] = DBDT;
            }
            $this->db->where('mxap_assign_id', $uniqid);
            $this->db->update($tablename, $inarray);  
            // echo $this->db->last_query(); exit;       
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $desc = "Failed updated";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$desc;
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message = "Success";
                $statuscode = "200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                $qry1 = array('statusmsg'=>'Sucessfully Updated');
                $leavedata1['emp_apprisal']=$qry1;
                return $leavedata1;
            }      
    }

    public function manager_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory)
    {
        if ($month < 10 && strlen($month) == 1) {
            $month_updated = "0" . $month;
        } else {
            $month_updated = $month;
        }
        $yearmonth = $year.'_'.$month_updated;

        $this->db->trans_begin();
        $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;

        $this->db->select('mxap_assign_id,mxap_assign_employee_code,mxap_assign_manager_noofaccounts,mxap_assign_manager_client_name,
                           mxap_assign_manager_review,mxap_assign_manager_actual_assesment,mxap_assign_manager_createdtime,
                           mxap_assign_manager_modifiedtime');
        $this->db->from($tablename);
        $this->db->where('mxap_assign_id',$uniqid);
        // $this->db->where('mxemp_leave_bal_status = 1');
        $query = $this->db->get();
        $empapp = $query->result();
            $inarray = array(
                "mxap_assign_manager_noofaccounts" => $empnoacnt,
                // "mxap_assign_manager_client_name" => $empclientnam,
                "mxap_assign_manager_review" => $empformdesc,
                // "mxap_assign_manager_actual_assesment" => $emplachivement,
                "mxap_manager_approvedby" => $employeeid,
                "mxap_assign_modifyby" => $employeeid,
                "mxap_assign_modifiedtime" => DBDT,
                "mxap_assign_modified_ip" => ''
            ); 

            if($empapp[0]->mxap_assign_catg == 1){
                $inarray['mxap_assign_manager_client_name'] = $empclientnam;
                $inarray['mxap_assign_manager_actual_assesment'] = $emplachivement;
            }

            if(empty($empapp[0]->mxap_assign_manager_createdtime) || ($empapp[0]->mxap_assign_manager_createdtime == '') || ($empapp[0]->mxap_assign_manager_createdtime == NULL) || ($empapp[0]->mxap_assign_manager_createdtime == '0000-00-00 00:00:00') ){
                $inarray['mxap_assign_manager_createdtime'] = DBDT;
            }else{
                $inarray['mxap_assign_manager_modifiedtime'] = DBDT;
            }
            $this->db->where('mxap_assign_id', $uniqid);
            $this->db->update($tablename, $inarray);  
            // echo $this->db->last_query(); exit;       
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $desc = "Failed updated";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$desc;
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message = "Success";
                $statuscode = "200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                $leavedata1['manager_apprisal']=" Sucessfully Updated ";
                return $leavedata1;
            }      
    }

    public function hod_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory)
    {
        if ($month < 10 && strlen($month) == 1) {
            $month_updated = "0" . $month;
        } else {
            $month_updated = $month;
        }
        $yearmonth = $year.'_'.$month_updated;

        $this->db->trans_begin();
        $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;

        $this->db->select('mxap_assign_id,mxap_assign_employee_code,mxap_assign_hod_noofaccounts,mxap_assign_hod_client_name,
                           mxap_assign_hod_review,mxap_assign_hod_actual_assesment,mxap_assign_hod_createdtime,
                           mxap_assign_hod_modifiedtime,mxap_assign_catg');
        $this->db->from($tablename);
        $this->db->where('mxap_assign_id',$uniqid);
        // $this->db->where('mxemp_leave_bal_status = 1');
        $query = $this->db->get();
        $empapp = $query->result();
            $inarray = array(
            "mxap_assign_hod_noofaccounts" => $empnoacnt,
            // "mxap_assign_hod_client_name" => $empclientnam,
            "mxap_assign_hod_review" => $empformdesc,
            // "mxap_assign_hod_actual_assesment" => $emplachivement,
            "mxap_assign_modifyby" => $employeeid,
            "mxap_hod_approvedby" => $employeeid,
            "mxap_assign_modifiedtime" => DBDT,
            "mxap_assign_modified_ip" => ''
            ); 

            if($empapp[0]->mxap_assign_catg == 1){
                $inarray['mxap_assign_hod_client_name'] = $empclientnam;
                $inarray['mxap_assign_hod_actual_assesment'] = $emplachivement;
            }

            if(empty($empapp[0]->mxap_assign_hod_createdtime) || ($empapp[0]->mxap_assign_hod_createdtime == '') || ($empapp[0]->mxap_assign_hod_createdtime == NULL) || ($empapp[0]->mxap_assign_hod_createdtime == '0000-00-00 00:00:00') ){
                $inarray['mxap_assign_hod_createdtime'] = DBDT;
            }else{
                $inarray['mxap_assign_hod_modifiedtime'] = DBDT;
            }
            $this->db->where('mxap_assign_id', $uniqid);
            $this->db->update($tablename, $inarray);  
            // echo $this->db->last_query(); exit;       
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message="Failed";
                $statuscode="500";
                $desc = "Failed updated";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']=$desc;
                return $leavedata1;
            } else {
                $this->db->trans_commit();
                $message = "Success";
                $statuscode = "200";
                $leavedata1['status']=$statuscode;
                $leavedata1['msg']=$message;
                $leavedata1['description']='';
                $leavedata1['emp_apprisal']=" Sucessfully Updated ";
                return $leavedata1;
            }      
    }
}