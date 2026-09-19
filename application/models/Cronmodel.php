<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

// class Cronmodel extends CI_Model
class Cronmodel extends Adminmodel
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
        #ini_set("memory_limit","999M");// TO INCREASE THE MEMORY LIMIT OF MYSQL
        ini_set('memory_limit', '-1');
    }
    function get_client_ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    //  -------- added 21-01-2024 -----
        public function resignattendance($resdt,$empid,$printable){
            $insertedCount = 0;
            $updatedCount  = 0;
            $failedCount   = 0;
        if($resdt == ''){
            $cntdt=date('Y-m-d');
        }else{
            $this->db->select("mxemp_emp_id,mxemp_emp_resignation_relieving_date,mxemp_emp_resignation_date");
            $this->db->from("maxwell_employees_info");
            $this->db->where("mxemp_emp_resignation_status",'R');
            $this->db->where("mxemp_emp_id",$empid);
            $query = $this->db->get();
            $emp_reli_dt = $query->result();
            if($resdt == 'Resign'){
                $resign_date = $emp_reli_dt[0]->mxemp_emp_resignation_date;
                $cntdt = date('Y-m-d', strtotime('+1 days', strtotime($resign_date)));
            }elseif($resdt == 'Relieving'){
                $relieving_date = $emp_reli_dt[0]->mxemp_emp_resignation_relieving_date;
                $cntdt = date('Y-m-d', strtotime('+1 days', strtotime($relieving_date)));
            }else{
                $cntdt=date('Y-m-d');
            }
        }
        $this->db->trans_begin();
        $minusoneday = date('Y-m-d', strtotime('-1 days', strtotime($cntdt)));
        $this->db->select("mxemp_emp_id,mxemp_emp_resignation_relieving_date");
        $this->db->from("maxwell_employees_info");
        $this->db->where("mxemp_emp_resignation_relieving_date",$minusoneday);
        $this->db->where("mxemp_emp_resignation_status",'R');
        if(!empty($empid)){
            $this->db->where("mxemp_emp_id",$empid);
        }
        $query = $this->db->get();
        $rel_empid = $query->result();
       
        if(!empty($rel_empid)){
            foreach($rel_empid as $rkey=>$rval){
                $empid = $rval->mxemp_emp_id;
                $re_date = $rval->mxemp_emp_resignation_relieving_date;
                $ryear = date('Y',strtotime($re_date));
                $rmnth = date('m',strtotime($re_date));
                $rdate = date('d',strtotime($re_date));
                $montdayscal =cal_days_in_month(CAL_GREGORIAN,$rmnth,$ryear);
                if($rdate != $montdayscal){
                    for($i=$rdate+1; $i<=$montdayscal; $i++){
                        if(strlen($i)==1){ $i = '0'.$i; }
                        if(strlen($rmnth)==1){ $rmnth = '0'.$rmnth; }
                        $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                        $this->db->from("maxwell_attendance_".$ryear."_".$rmnth);
                        $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);
                        $this->db->where("mx_attendance_date",$ryear."-".$rmnth."-".$i);
                        $query = $this->db->get();
                        $atttbl = $query->result();
                        if(count($atttbl)>0){
                            $this->db->where('mx_attendance_id', $atttbl[0]->mx_attendance_id);
                            $this->db->delete("maxwell_attendance_".$ryear."_".$rmnth);
                            $updatedCount++;
                        }
                    }
                } 
               
                for($m=$rmnth+1; $m<=12; $m++){
                    if(strlen($m)==1){ $m = '0'.$m; }
                    if($m <= 12){
                        $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                        $this->db->from("maxwell_attendance_".$ryear."_".$m);
                        $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);   
                        $query = $this->db->get();
                        $attendmthid = $query->result();
                        foreach($attendmthid as $attmtkey=>$attval){
                            $this->db->where('mx_attendance_id', $attval->mx_attendance_id);
                            $this->db->delete("maxwell_attendance_".$ryear."_".$m);
                            $updatedCount++;
                        }
                    }
                }  
                
                $currentyear = date('Y');
                if(($currentyear != $ryear) && ($ryear < $currentyear) ){
                    for($m=1; $m<=12; $m++){
                        if(strlen($m)==1){ $m = '0'.$m; }
                        if($m <= 12){
                            if ($this->db->table_exists("maxwell_attendance_".$currentyear."_".$m)) {
                                $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                                $this->db->from("maxwell_attendance_".$currentyear."_".$m);
                                $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);   
                                $query = $this->db->get();
                                $attendmthid = $query->result();
                                foreach($attendmthid as $attmtkey=>$attval){
                                    $this->db->where('mx_attendance_id', $attval->mx_attendance_id);
                                    $this->db->delete("maxwell_attendance_".$currentyear."_".$m);
                                    $updatedCount++;
                                }
                            }else{
                                break;
                            }
                        }
                    }
                } 
                
                /*
                $currentyear = date('Y');
                if(($currentyear != $ryear) && ( $currentyear > $ryear) ){
                    for($m=1; $m<=12; $m++){
                        if(strlen($m)==1){ $m = '0'.$m; }
                        if($m <= 12){
                            $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                            $this->db->from("maxwell_attendance_".$currentyear."_".$m);
                            $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);   
                            $query = $this->db->get();
                            $attendmthid = $query->result();
                            foreach($attendmthid as $attmtkey=>$attval){
                                $this->db->where('mx_attendance_id', $attval->mx_attendance_id);
                                $this->db->delete("maxwell_attendance_".$currentyear."_".$m);
                            }
                        }
                    }
                }
                */
            }
        }
        
            $array = array('name'=>$nametype ,'Url' => 'https://maxwellhrms.in/cron/cron_resignattendance','cron_refrence_id' => 10);
            $res = $this->db->insert('cron_log',$array);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $statuscode = 500;
        } else {
            $this->db->trans_commit();
            $statuscode =  200;
        }

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;

    }
    //  -------- end added 21-01-2024 ----
    
    /*  
    //  ================  added on 31-01-2023==============
    public function resignattendance($cntdt,$empid,$printable){
        // $cntdt=date('Y-m-d');
        // $currentmnth= date('m');
        // $cntdt='2023-02-11';
        // $currentmnth ='02';
        $cntdt = date('Y-m-d',strtotime($cntdt));
        $currentdt=date('Y-m-d');
        
        if($currentdt < $cntdt){
            return 800;
        }
        
        $currentmnth= date('m',strtotime($cntdt));
        // $cntdt='2023-02-11';
        // $currentmnth ='02';
        $this->db->trans_begin();

        $minusoneday = date('Y-m-d', strtotime('-1 days', strtotime($cntdt)));
        $this->db->select("mxemp_emp_id,mxemp_emp_resignation_relieving_date");
        $this->db->from("maxwell_employees_info");
        // $this->db->where("mxemp_emp_resignation_relieving_date <",$cntdt);
        $this->db->where("mxemp_emp_resignation_status",'R');
        $this->db->where("mxemp_emp_resignation_relieving_date >=",$minusoneday);
        if(!empty($empid)){
            $this->db->where("mxemp_emp_id",$empid);
        }
        $query = $this->db->get();
        $rel_empid = $query->result();

// echo $this->db->last_query(); exit;
        if(!empty($rel_empid)){
            foreach($rel_empid as $rkey=>$rval){
                $empid = $rval->mxemp_emp_id;
                $re_date = $rval->mxemp_emp_resignation_relieving_date;
                $ryear = date('Y',strtotime($re_date));
                $rmnth = date('m',strtotime($re_date));
                $rdate = date('d',strtotime($re_date));
                $montdayscal =cal_days_in_month(CAL_GREGORIAN,$rmnth,$ryear);
            
                if($rdate != $montdayscal){
                    for($i=$rdate+1; $i<=$montdayscal; $i++){
                        if(strlen($i)==1){ $i = '0'.$i; }
                        if(strlen($rmnth)==1){ $rmnth = '0'.$rmnth; }
                        $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                        $this->db->from("maxwell_attendance_".$ryear."_".$rmnth);
                        $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);
                        $this->db->where("mx_attendance_date",$ryear."-".$rmnth."-".$i);
                        $query = $this->db->get();
                        $atttbl = $query->result();
                        if(count($atttbl)>0){
                            $this->db->where('mx_attendance_id', $atttbl[0]->mx_attendance_id);
                            $this->db->delete("maxwell_attendance_".$ryear."_".$rmnth);
                        }
                    }
                } 
                    
                // for($m=$currentmnth+1; $m<=12; $m++){
                   for($m=$rmnth+1; $m<=12; $m++){
                    if(strlen($m)==1){ $m = '0'.$m; }
                        if($m <= 12){
                            $this->db->select("mx_attendance_emp_code,mx_attendance_id,mx_attendance_date");
                            $this->db->from("maxwell_attendance_".$ryear."_".$m);
                            $this->db->where("mx_attendance_emp_code",$rval->mxemp_emp_id);   
                            $query = $this->db->get();
                            $attendmthid = $query->result();
                            foreach($attendmthid as $attmtkey=>$attval){
                                $this->db->where('mx_attendance_id', $attval->mx_attendance_id);
                                $this->db->delete("maxwell_attendance_".$ryear."_".$m);
                            }
                        }
                }
                
              
            }
        }
        
        if($printable == 'Y'){
            $nametype = 'Resignation Relieving CRON MANUAL';
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $array = array('name'=> $nametype,'Url' => $actual_link);
            $res = $this->db->insert('cron_log',$array);
          
        }elseif($printable == 'N'){
            $nametype = 'Resignation Relieving';
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $array = array('name'=>$nametype ,'Url' => $actual_link);
            $res = $this->db->insert('cron_log',$array);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 500;
        } else {
            $this->db->trans_commit();
            return 200;
        }

    }
    //  ================ end added on 31-01-2023==============

    */

//  ================= added 23-april-2023 ============
//  =================== cron manual update previous balance into minus balance ==============

    public function cronleaveadjuest(){
        $this->db->select('mxemp_leave_history_processdate,mxemp_leave_history_id,mxemp_leave_history_emp_id,mxemp_leave_history_leavetype,mxemp_leave_history_short_name,mxemp_leave_histroy_previous_bal,mxemp_leave_histroy_present_minus,mxemp_leave_history_process_type');
        $this->db->from('maxwell_emp_leave_detailed_history');
        $this->db->where('mxemp_leave_history_emp_id','M0260');
        $this->db->where('mxemp_leave_history_leavetype',3);
        $this->db->where('mxemp_leave_history_process_type','CRON-YEAR');
        // $this->db->where('mxemp_leave_history_processdate',2023);
        $this->db->order_by('mxemp_leave_history_emp_id', 'ASC'); 
        // $this->db->limit(4);
        $query = $this->db->get();
        $leavedata = $query->result_array();
        // echo '<pre>';
        // print_r($leavedata);
        // echo $this->db->last_query(); 
        // die;
        
        foreach($leavedata as $key=>$leval){
            
            // print_r($leval['mxemp_leave_history_emp_id']);
            
            $a1=array('mxemp_leave_histroy_present_minus'=>$leval['mxemp_leave_histroy_previous_bal']);
    
            // print_r($a1);
            // $this->db->where('mxemp_leave_history_emp_id',$leval['mxemp_leave_history_emp_id']);  
            // $this->db->where('mxemp_leave_history_id', $leval['mxemp_leave_history_id']);       
            // $this->db->where('mxemp_leave_history_leavetype', $leval['mxemp_leave_history_leavetype']);  
            // $this->db->where('mxemp_leave_history_process_type', 'CRON-YEAR');        
            // // $this->db->where('mxemp_leave_history_processdate',2023);
            // $this->db->update('maxwell_emp_leave_detailed_history',$a1);      
            
            // echo $this->db->last_query();  
            // print_r($key.'=='.$leval->mxemp_leave_history_emp_id);
        }
        
        
    }
    //  =================== cron manual update previous balance into minus balance ==============
//  ================= end added on 23-april-2023 =========

// ----------------------- added 02-12-2021 -----------

    public function clcronmodeldatewise($leavetypeid,$yearmonth,$printable){
        $res=$this->clcronmodel($leavetypeid,$yearmonth,$printable);
        return $res;
    }

 // --------------------- end 02-12-2021 --------

    public function clcronmodel($leavetypeid,$userdate,$printable){
        // $date = '2021-03-31';
        // $yearmnt = '2021_03';
       // $date = date('Y-m-d');
        //$yearmnt = date('Y_m');
        
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $actual_link = '';
        $cron_refrence_id = '';
        
        if($userdate != 0 ){
            //  $date = $userdate;
             $date = date('Y-m-d',strtotime($userdate));
             $yearmnt = date('Y_m',strtotime($date));        
        }else{
             $date = date('Y-m-d');
             $yearmnt = date('Y_m');
        }  
        $createddate = date('Y-m-d H:i:s');
   
        $ip = $this->get_client_ip();
        
        $all_leave_types = array('PR','AR','PH','WO','OH','SHRT','OT');
        
        $this->db->trans_begin();

        // ------------------------- attendance table ---------------------

        
        if($leavetypeid == 2){ //Cl
            $shrtleanm = 'CL';
            $actual_link = 'https://maxwellhrms.in/cron/Clcronmodel';
            $cron_refrence_id = 5;
            $this->db->select("( select max(case when mxemp_leave_bal_leave_type_shrt_name = 'CL' then mxemp_leave_bal_crnt_bal end) 
            from maxwell_emp_leave_balance where mx_attendance_emp_code = mxemp_leave_bal_emp_id group by mxemp_leave_bal_emp_id) as Currentbal ,");
        }elseif($leavetypeid == 1){ //EL
            $shrtleanm = 'EL';
            $actual_link = 'https://maxwellhrms.in/cron/Elcronmodel';
            $cron_refrence_id = 6;
            $this->db->select(" (select max(case when mxemp_leave_bal_leave_type_shrt_name = 'EL' then mxemp_leave_bal_crnt_bal end) 
            from maxwell_emp_leave_balance where mx_attendance_emp_code = mxemp_leave_bal_emp_id group by mxemp_leave_bal_emp_id) as Currentbal,");
        }elseif($leavetypeid == 3){ //SL
            $shrtleanm = 'SL';
            $actual_link = 'https://maxwellhrms.in/cron/Slcronmodel';
            $cron_refrence_id = 7;
            $this->db->select(" ( select max(case when mxemp_leave_bal_leave_type_shrt_name = 'SL' then mxemp_leave_bal_crnt_bal end) 
            from maxwell_emp_leave_balance where mx_attendance_emp_code = mxemp_leave_bal_emp_id group by mxemp_leave_bal_emp_id) as Currentbal, ");
        }
        
        /*
        $this->db->select("(select mxlt_leave_short_name from maxwell_leave_type_master where mxlt_id = $leavetypeid and mxlt_status=1 ) as leavetypeSN, 
        mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_type as emptype,
        CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as EmployeeName,mx_attendance_emp_code as EmployeeID,count(*) AS Totaldays,
        sum(case when mx_attendance_first_half = 'WO' AND mx_attendance_second_half = 'WO' then 1 else 0 end) AS Week_Off,
        sum(case when mx_attendance_first_half = 'PH' AND mx_attendance_second_half = 'PH' then 1 else 0 end) AS Public_Holiday,
        sum(case when mx_attendance_first_half = 'OPH' AND mx_attendance_second_half = 'OPH' then 1 else 0 end) AS Optional_Holiday,
        sum(case when mx_attendance_first_half = 'AB' AND mx_attendance_second_half = 'AB' then 1 else 0 end) AS Absent,
        sum(case when mx_attendance_first_half = 'AB' AND mx_attendance_second_half != 'AB' then 0.5 else 0 end) AS First_Half_Absent,
        sum(case when mx_attendance_second_half = 'AB' AND mx_attendance_first_half != 'AB' then 0.5 else 0 end) AS Second_Half_Absent,
        sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'PR' then 1 else 0 end) AS Present,
        sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'AB' then 0.5 else 0 end) AS First_Half_Present,
        sum(case when mx_attendance_first_half = 'AB' AND mx_attendance_second_half = 'PR' then 0.5 else 0 end) AS Second_Half_Present,
        sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'CL' then 0.5 else 0 end) AS First_Half_Present_Cl_Applied,
        sum(case when mx_attendance_first_half = 'CL' AND mx_attendance_second_half = 'PR' then 0.5 else 0 end) AS Second_Half_Present_Cl_Applied,
        sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'SL' then 0.5 else 0 end) AS First_Half_Present_Sl_Applied,
        sum(case when mx_attendance_first_half = 'SL' AND mx_attendance_second_half = 'PR' then 0.5 else 0 end) AS Second_Half_Present_Sl_Applied,
        sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'EL' then 0.5 else 0 end) AS First_Half_Present_El_Applied,
        sum(case when mx_attendance_first_half = 'EL' AND mx_attendance_second_half = 'PR' then 0.5 else 0 end) AS Second_Half_Present_El_Applied,
        sum(case when mx_attendance_first_half = 'CL' AND mx_attendance_second_half = 'CL' then 1 else 0 end) AS Casualleave,
        sum(case when mx_attendance_first_half = 'CL' AND mx_attendance_second_half != 'CL' then 0.5 else 0 end) AS First_Half_Casualleave,
        sum(case when mx_attendance_first_half != 'CL' AND mx_attendance_second_half = 'CL' then 0.5 else 0 end) AS Second_Half_Casualleave,
        sum(case when mx_attendance_first_half = 'SL' AND mx_attendance_second_half = 'SL' then 1 else 0 end) AS Sickleave,
        sum(case when mx_attendance_first_half = 'SL' AND mx_attendance_second_half != 'SL' then 0.5 else 0 end) AS First_Half_Sickleave,
        sum(case when mx_attendance_first_half != 'SL' AND mx_attendance_second_half = 'SL' then 0.5 else 0 end) AS Second_Half_Sickleave,
        sum(case when mx_attendance_first_half = 'EL' AND mx_attendance_second_half = 'EL' then 1 else 0 end) AS Earnedleave,
        sum(case when mx_attendance_first_half = 'EL' AND mx_attendance_second_half != 'EL' then 0.5 else 0 end) AS First_Half_Earnedleave,
        sum(case when mx_attendance_first_half != 'EL' AND mx_attendance_second_half = 'EL' then 0.5 else 0 end) AS Second_Half_Earnedleave ");
        */
        $this->db->select("(select mxlt_leave_short_name from maxwell_leave_type_master where mxlt_id = $leavetypeid and mxlt_status=1 ) as leavetypeSN, 
        mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_type as emptype,
        CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as EmployeeName,mx_attendance_emp_code as EmployeeID,count(*) AS Totaldays");
        foreach ($all_leave_types as $key => $shortnametype) {
            $type = $shortnametype;
            $subsql .= "sum(case when mx_attendance_first_half = '$type' AND mx_attendance_second_half = '$type' then 1 else 0 end)+";
            $subsql .= "sum(case when mx_attendance_first_half = '$type' AND mx_attendance_second_half != '$type' then 0.5 else 0 end)";
            $subsql .= "+ sum(case when mx_attendance_first_half != '$type' AND mx_attendance_second_half = '$type' then 0.5 else 0 end)+";
            // $leave_type_names .= "({$type}_Full_Day + First_Half_$type + Second_Half_$type) as $type,";
            // $sumoftotaldays .="{$type}_Full_Day + First_Half_$type + Second_Half_$type +"; 
        }
        $sumofpresents = '('.rtrim($subsql,'+').') as total_daytaken';
        $this->db->select("$sumofpresents");
        $this->db->from('maxwell_attendance_'.$yearmnt);
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'INNER');
        $this->db->where('mx_attendance_date <=' ,$date);
        $this->db->group_by('EmployeeID');
        $query = $this->db->get();
        $leavedata = $query->result();
        // echo $this->db->last_query();  die;
               
        // ------------------------- End attendance table ---------------------

        // ---------------------    cron table     ---------------------
       
        $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_leavetype');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->where('mxemp_leave_cron_processdate ' , $yearmnt);
        $this->db->where('mxemp_leave_cron_leavetype ' , $leavetypeid);
        $query1 = $this->db->get();
        $crownro = $query1->num_rows();
        $crondata = $query1->result();
        // echo $this->db->last_query();  die;
        
        // ---------------------- End cron table --------------
 
        // ---------------------- assignment table query-----------

        $this->db->select('mxlass_emp_type_id,mxlass_leave_type_id,mxlass_min_leaves,mxlass_apply_min_leave_days,mxlass_is_max_leave');
        $this->db->from('maxwell_leave_assigning_master');
        $this->db->where('mxlass_status ' , 1 );
        $this->db->where('mxlass_leave_type_id ',$leavetypeid);
        $query2 = $this->db->get();
        //echo $this->db->last_query(); die;
        $assignmastcount = $query2->num_rows();
        $assignmast = $query2->result();
        
        // --------------attendanct table-------end 
        $new = array();
        foreach($crondata as $key => $val){ 
            array_push($new,$val->mxemp_leave_cron_emp_id);
        }
        // $this->db->trans_begin();
            foreach($leavedata as $key => $ltdt){  
                if(!in_array($ltdt->EmployeeID , $new)){
                     
                    foreach($assignmast as $kay1=>$assval){
                        
                            if($assval->mxlass_min_leaves == 0.00){ 
                                   continue;
                            }
                        
                        if($assval->mxlass_emp_type_id == $ltdt->emptype && $assval->mxlass_leave_type_id == $leavetypeid ){
     
                            /*$prstdays=  $ltdt->Week_Off+$ltdt->Public_Holiday+
                            $ltdt->Optional_Holiday+
                            $ltdt->Present + $ltdt->First_Half_Present+$ltdt->Second_Half_Present+
                            $ltdt->First_Half_Present_Cl_Applied+$ltdt->Second_Half_Present_Cl_Applied+
                            $ltdt->First_Half_Present_Sl_Applied+$ltdt->Second_Half_Present_Sl_Applied+
                            $ltdt->First_Half_Present_El_Applied+$ltdt->Second_Half_Present_El_Applied+
                            $ltdt->First_Half_Casualleave+$ltdt->Second_Half_Casualleave+
                            $ltdt->First_Half_Sickleave+$ltdt->Second_Half_Sickleave+
                            $ltdt->First_Half_Earnedleave+$ltdt->Second_Half_Earnedleave+
                            $ltdt->Casualleave+$ltdt->Sickleave+$ltdt->Earnedleave;*/
                            $prstdays=$ltdt->total_daytaken;
        
                                    if($prstdays >= $assval->mxlass_apply_min_leave_days){                                                
                                              $presentbal=$ltdt->Currentbal ;
                                    if(empty( $presentbal)){
                                         $presentbal=0;
                                    }
                                    $currentadding =( $presentbal + $assval->mxlass_min_leaves);
                                    $cntbal =$assval->mxlass_min_leaves;
                                    
                                    $cornarraydata = array(
                                        'mxemp_leave_cron_comp_id'=> $ltdt->mxemp_emp_comp_code,
                                        'mxemp_leave_cron_division_id' => $ltdt->mxemp_emp_division_code,
                                        'mxemp_leave_cron_emp_id' => $ltdt->EmployeeID,
                                        'mxemp_leave_cron_leavetype' => $assval->mxlass_leave_type_id, 
                                        'mxemp_leave_cron_short_name' => $ltdt->leavetypeSN,
                                        'mxemp_leave_cron_previous_bal' =>$presentbal ,
                                        'mxemp_leave_cron_present_adding' =>$cntbal,
                                        'mxemp_leave_cron_crnt_bal' => $currentadding,
                                        'mxemp_leave_cron_process_type' => 'CRON',
                                        'mxemp_leave_cron_entry_type' =>'',
                                        'mxemp_leave_cron_processdate' => $yearmnt,
                                        'mxemp_leave_cron_createdby' => $this->session->userdata('user_id'),
                                        'mxemp_leave_cron_createdtime' => $createddate,
                                        'mxemp_leave_cron_created_ip' => $ip
                                    );
                                   $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                                   //echo $this->db->last_query() .'<br>';
                                    
                                    $cornarraydet = array(
                                        'mxemp_leave_history_comp_id'=> $ltdt->mxemp_emp_comp_code,
                                        'mxemp_leave_history_division_id' => $ltdt->mxemp_emp_division_code,
                                        'mxemp_leave_history_emp_id' => $ltdt->EmployeeID,
                                        'mxemp_leave_history_leavetype' => $assval->mxlass_leave_type_id, 
                                        'mxemp_leave_history_short_name' => '',
                                        'mxemp_leave_histroy_previous_bal' =>$presentbal ,
                                        'mxemp_leave_histroy_present_adding' =>$cntbal,
                                        'mxemp_leave_history_crnt_bal' => $currentadding,
                                        'mxemp_leave_history_process_type' => 'CRON',
                                        'mxemp_leave_history_processdate' => $yearmnt,
                                        'mxemp_leave_history_createdby' =>$this->session->userdata('user_id'),
                                        'mxemp_leave_history_createdtime' =>$createddate,
                                        'mxemp_leave_history_created_ip' => $ip
                                    );
                                    $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                                  // echo $this->db->last_query().'<br>';                      
                                    $insertedCount++;
                                    $mstleavebal = array(
                                        'mxemp_leave_bal_crnt_bal' =>$currentadding,
                                        'mxemp_leave_bal_modifyby' => $this->session->userdata('user_id'),
                                        'mxemp_leave_bal_modifiedtime' =>$createddate,
                                        'mxemp_leave_bal_modified_ip' => $ip
                                    );  
                                  $this->db->where('mxemp_leave_bal_emp_id', $ltdt->EmployeeID);  
                                  $this->db->where('mxemp_leave_bal_leave_type', $leavetypeid );            
                                  $this->db->update('maxwell_emp_leave_balance',$mstleavebal);  
                                  $updatedCount++;                                    
                                 //echo $this->db->last_query().'<br>';

                            }
                        }
                    }
                }elseif($leavetypeid == 1){ // EL id
                    $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_id,mxemp_leave_cron_crnt_bal,mxemp_leave_cron_present_adding');
                    $this->db->from('maxwell_emp_leave_cron_history');
                    $this->db->where('mxemp_leave_cron_emp_id ',$ltdt->EmployeeID);
                    $this->db->where('mxemp_leave_cron_leavetype ',$leavetypeid);
                    $this->db->where('mxemp_leave_cron_processdate ' , $yearmnt);
                    $this->db->where('mxemp_leave_cron_elstatus ',1);
                    $query2 = $this->db->get();
                    // echo $this->db->last_query(); 
                    $checkempdassign  = $query2->num_rows();
                    $checkelcntval = $query2->result();
                    if($checkempdassign>0){
                        foreach($assignmast as $kay1=>$assval){                        
                            if($assval->mxlass_emp_type_id == $ltdt->emptype && $assval->mxlass_leave_type_id == $leavetypeid ){
                                /*$prstdays=  $ltdt->Week_Off+$ltdt->Public_Holiday+
                                $ltdt->Optional_Holiday+
                                $ltdt->Present + $ltdt->First_Half_Present+$ltdt->Second_Half_Present+
                                $ltdt->First_Half_Present_Cl_Applied+$ltdt->Second_Half_Present_Cl_Applied+
                                $ltdt->First_Half_Present_Sl_Applied+$ltdt->Second_Half_Present_Sl_Applied+
                                $ltdt->First_Half_Present_El_Applied+$ltdt->Second_Half_Present_El_Applied+
                                $ltdt->First_Half_Casualleave+$ltdt->Second_Half_Casualleave+
                                $ltdt->First_Half_Sickleave+$ltdt->Second_Half_Sickleave+
                                $ltdt->First_Half_Earnedleave+$ltdt->Second_Half_Earnedleave+
                                $ltdt->Casualleave+$ltdt->Sickleave+$ltdt->Earnedleave;*/
                                $prstdays=$ltdt->total_daytaken;
                                if($prstdays >= 21 ){                                                
                                    $presentbal=$ltdt->Currentbal ;
                                    if(empty( $presentbal)){
                                        $presentbal=0;
                                    }
                                    $additonaleladd = $assval->mxlass_is_max_leave;
                                    $preveladd=$checkelcntval[0]->mxemp_leave_cron_present_adding;
                                    if($assval->mxlass_is_max_leave > $assval->mxlass_min_leaves ){
                                       $toteladd = $additonaleladd - $preveladd;
                                    }else{
                                        $toteladd = 0;
                                    }
                                    $currentadding = ( $presentbal + $toteladd );
                                    $cntbal = $toteladd;
                                    if($toteladd != 0 ){
                                        $cornarraydata = array(
                                            'mxemp_leave_cron_previous_bal' =>$presentbal ,
                                            'mxemp_leave_cron_present_adding' =>$cntbal,
                                            'mxemp_leave_cron_crnt_bal' => $currentadding,
                                            'mxemp_leave_cron_elstatus' => 0,
                                            'mxemp_leave_cron_modifyby' => $this->session->userdata('user_id'),
                                            'mxemp_leave_cron_modifiedtime' => $createddate,
                                            'mxemp_leave_cron_modified_ip' => $ip
                                        );
                                        // echo $this->db->last_query() .'<br>';
                                        
                                        $this->db->where('mxemp_leave_cron_emp_id', $ltdt->EmployeeID);  
                                        $this->db->where('mxemp_leave_cron_leavetype', $leavetypeid );
                                        $this->db->where('mxemp_leave_cron_id', $checkelcntval[0]->mxemp_leave_cron_id );
                                        $this->db->update('maxwell_emp_leave_cron_history',$cornarraydata);
                                        // echo $this->db->last_query() .'<br>';
                                        
                                        $cornarraydet = array(
                                            'mxemp_leave_history_comp_id'=> $ltdt->mxemp_emp_comp_code,
                                            'mxemp_leave_history_division_id' => $ltdt->mxemp_emp_division_code,
                                            'mxemp_leave_history_emp_id' => $ltdt->EmployeeID,
                                            'mxemp_leave_history_leavetype' => $assval->mxlass_leave_type_id, 
                                            'mxemp_leave_history_short_name' => '',
                                            'mxemp_leave_histroy_previous_bal' =>$presentbal ,
                                            'mxemp_leave_histroy_present_adding' =>$cntbal,
                                            'mxemp_leave_history_crnt_bal' => $currentadding,
                                            'mxemp_leave_history_process_type' => 'CRON',
                                            'mxemp_leave_history_processdate' => $yearmnt,
                                            'mxemp_leave_history_createdby' =>$this->session->userdata('user_id'),
                                            'mxemp_leave_history_createdtime' =>$createddate,
                                            'mxemp_leave_history_created_ip' => $ip
                                        );
                                        $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                                        $insertedCount++;
                                        // echo $this->db->last_query().'<br>';                      
                                        
                                        $mstleavebal = array(
                                            'mxemp_leave_bal_crnt_bal' =>$currentadding,
                                            'mxemp_leave_bal_modifyby' => $this->session->userdata('user_id'),
                                            'mxemp_leave_bal_modifiedtime' =>$createddate,
                                            'mxemp_leave_bal_modified_ip' => $ip
                                        );  
                                        $this->db->where('mxemp_leave_bal_emp_id', $ltdt->EmployeeID);  
                                        $this->db->where('mxemp_leave_bal_leave_type', $leavetypeid );            
                                        $this->db->update('maxwell_emp_leave_balance',$mstleavebal); 
                                        $updatedCount++;                                     
                                        // echo $this->db->last_query().'<br>';
                                    }
                                }
                            }
                        }
                    }
                }
        }
        
            $nametype = $shrtleanm;
            $array = array('name'=>$nametype ,'Url' => $actual_link, 'cron_refrence_id' => $cron_refrence_id);
            $res = $this->db->insert('cron_log',$array);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $statuscode = 500;
        } else {
            $this->db->trans_commit();
            $statuscode = 200;
        }

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
}
    //--------------NEW BY SHABABU(06-06-2021)
    public function sat_sun_mon_cron_model(){
        /*
            AUTHOR : SHABABU
            DESC   : MONTH WISE CRON
        */
        $this->db->trans_begin();
        //-------GETTING COMPANY IDS FROM COMPANY MASTER
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status', 1);
        if($this->input->post('cmp_id') && $this->input->post('cmp_id') != null){
            $this->db->where('mxcp_id', $this->input->post('cmp_id'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $cmp_res = $query->result();
        //-------END GETTING COMPANY IDS FROM COMPANY MASTER
        
        if(count($cmp_res) > 0){
            foreach($cmp_res as $cmp_data){
                $cmp_id_cmp_master = $cmp_data->mxcp_id;
                $cmp_name_cmp_master = $cmp_data->mxcp_name;
                // echo $cmp_id_cmp_master;exit;
                // echo $this->input->post('cron_month_year');exit;
                    if($this->input->post('cron_month_year') && $this->input->post('cron_month_year') != null){
                        $ex_1 = explode('-',$this->input->post('cron_month_year'));
                        $ex_date = $ex_1[1].'-'.$ex_1[0].'-01';
                        $year_month = date('Ym',strtotime($ex_date));
                        $current_year = date('Y',strtotime($ex_date));
                        $check_cron_month = date('m',strtotime($ex_date));
                        if(strlen($check_cron_month) == 1){
                            $check_cron_month = "0".$check_cron_month;
                        }
                    }else{
                        $current_year  = date("Y", strtotime("-1 months"));
                        $check_cron_month = date("m", strtotime("-1 months"));
                        
                        if(strlen($check_cron_month) == 1){
                            $check_cron_month = "0".$check_cron_month;
                        }
                        $year_month = date("Ym", strtotime("-1 months"));
                        
                    }
                    // echo "year-month = ".$year_month.", Year = ".$current_year. ", Month = ".$check_cron_month;exit;
                    // echo $current_month;exit;
                    // $year_month = 202106;
                    //  $check_cron_month = '06';$current_year = '2021';
                    // echo $year_month;exit;
                    $history_data = $this->check_sat_sun_mon_cron_history($year_month,$cmp_id_cmp_master);
                    // print_r($history_data);exit;
                    
                        $total_days_of_cron_month = cal_days_in_month(CAL_GREGORIAN, $check_cron_month, $current_year);
                        //NEW BY SHABABU(04-06-2024)
                        if(date('m') == $check_cron_month){// if cron execute month and current date month are equla then we will run upto the current date
                            $total_days_of_cron_month = date('d');
                        }
                        
                        //END NEW BY SHABABU(04-06-2024)
                        // echo $total_days_of_cron_month;exit;
                        //-------------FILTERING SAT,SUN,MON ARRAYS
                        for ($day = 1; $day <= $total_days_of_cron_month; $day++) {
                                
                                if(intval($day) < 10){
                                    $day = "0".$day;
                                }
                                
                                $date = $current_year . "-" . $check_cron_month . "-" . $day;
                                $day_type = date('N', strtotime($date)); //----mon = 1....sun =7
                                
                                if(($day == intval($total_days_of_cron_month)) && ($day_type == 6 || $day_type == 7)){
                                        break;
                                }else if(intval($day) == 1 && $day_type == 7){// day one is sunday skip itteration and dont take monday also
                                        $day = $day + 1;
                                        continue;
                                }else if(intval($day) == 1 && $day_type == 1){//----->For Monday as day one skip
                                    if(intval($check_cron_month) == 1){
                                        $previous_cron_month = 12;
                                        $previous_year = $current_year - 1;
                                    }else{
                                        $previous_cron_month = intval($check_cron_month) - 1;
                                        $previous_year = $current_year;
                                    }
                                    if(strlen($previous_cron_month) == 1){
                                        $previous_cron_month = "0".$previous_cron_month;
                                    }
                                    $total_days_in_previous_month = cal_days_in_month(CAL_GREGORIAN, $previous_cron_month, $previous_year);
                                    $array_data[] = $previous_year . "-" . $previous_cron_month . "-" . (intval($total_days_in_previous_month) - 1);
                                    $array_data[] = $previous_year . "-" . $previous_cron_month . "-" . $total_days_in_previous_month;
                                    $array_data[] = $date;
                                    $final_array[] = $array_data;
                                    $array_data = [];
                                    continue;
                                }else if($day_type == 6 || $day_type == 7 || $day_type == 1){//--->sat(6),sun(7),mon(1)
                                        $array_data[]=$date;
                                }
                                
                                if(count($array_data) == 3){
                                    $final_array[] = $array_data;
                                    $array_data = [];
                                }
                                // echo "current_month_first_day_sun_flag = ".$current_month_first_day_sun_flag.", current_month_first_day_mon_flag =".$current_month_first_day_mon_flag;exit;
                                
                        }
                        //-------------END FILTERING SAT,SUN,MON ARRAYS
                        
                        
                        //---------GETTING EMPLOYEE DATA AND CHECKING
                            // echo "<pre>";
                            // print_r($final_array);exit;
                            $user_data = array("cmpname"=>$cmp_id_cmp_master);
                            // $user_data = array("cmpname"=>$cmp_id_cmp_master,"emp_id"=>'M00143');
                        $employees_array = $this->getemployeesinfo($user_data);
                        // print_r($employees_array);exit;
                        if(count($employees_array) > 0){
                            foreach($employees_array as $emp_data){
                                // print_r($emp_data);exit;
                                $cmp_id = $emp_data->mxemp_emp_comp_code;
                                $div_id = $emp_data->mxemp_emp_division_code;
                                $state_id = $emp_data->mxemp_emp_state_code;
                                $branch_id = $emp_data->mxemp_emp_branch_code;
                                $emp_code = $emp_data->mxemp_emp_id;
                                
                                //---------CHECK SAT,SUN,MON DATA IN ATTENDANCE TABLE    
                                // echo count($final_array);
                                // print_r($final_array);exit;
                                for($i = 0;$i<count($final_array);$i++){
                                        
                                        $sat_sun_mon_array = $final_array[$i];
                                        // echo $current_year . '<br>' . $check_cron_month . '<br>' . $cmp_id . '<br>' . $div_id . '<br>' . $state_id . '<br>' . $branch_id . '<br>' . $emp_code;exit;
                                        // $attendance_sat_sun_mon_data = $this->get_attendance_for_cron($current_year,$current_month,$previous_year,$previous_month,$cmp_id,$div_id,$state_id,$branch_id,$emp_code,$sat_sun_mon_array);
                                        $attendance_sat_sun_mon_data = $this->get_emp_attendence_data($current_year,$check_cron_month,$cmp_id = null,$div_id = null,$state_id = null,$branch_id = null,$emp_code,$date=null,$sat_sun_mon_array);
                                        // if($emp_code == 'M1096'){
                                        //     echo"<pre>";print_r($sat_sun_mon_array);exit;
                                        // }
                                        // echo count($attendance_sat_sun_mon_data);exit;
                                        $sat_flag = "no";
                                        $sun_flag = "no";
                                        $mon_flag = "no";
                                        if(count($attendance_sat_sun_mon_data) > 0){
                                            if(count($attendance_sat_sun_mon_data) == 3){
                                                foreach($attendance_sat_sun_mon_data as $att_sat_sun_mon){
                                                    // print_r($att_sat_sun_mon);exit;
                                                    $att_date = $att_sat_sun_mon->mx_attendance_date;
                                                    if(date('N', strtotime($att_date)) == 6){ //----sat
                                                        
                                                        $sat_flag = "yes";
                                                        $saturday = $att_date;
                                                        $sat_first_half = $att_sat_sun_mon->mx_attendance_first_half;
                                                        $sat_second_half = $att_sat_sun_mon->mx_attendance_second_half;
                                                        // echo $saturday."<--->".$sat_first_half. "<--->".$sat_second_half;exit;
                                                        //------CHECK SAT PH
                                                        if($sat_first_half == "PH" && $sat_second_half == "PH"){
                                                            $sat_ph_so_back_check_array = $this->sat_mon_ph_so_back_check_ab($saturday,$emp_code,'minus');
                                                            // echo "SAT";print_r($sat_ph_so_back_check_array);exit;
                                                            $saturday = $sat_ph_so_back_check_array[0]->mx_attendance_date;
                                                            $sat_first_half = $sat_ph_so_back_check_array[0]->mx_attendance_first_half;
                                                            $sat_second_half = $sat_ph_so_back_check_array[0]->mx_attendance_second_half;
                                                        }
                                                        //------END CHECK SAT PH
                                                        
                                                    
                                                    }else if(date('N', strtotime($att_date)) == 7){//---->sun
                                                        $sun_flag = "yes";
                                                        $attendance_id = $att_sat_sun_mon->mx_attendance_id;
                                                        $attendance_emp_code = $att_sat_sun_mon->mx_attendance_emp_code;
                                                        $sunday = $att_date;
                                                        $sun_first_half = $att_sat_sun_mon->mx_attendance_first_half;
                                                        $sun_second_half = $att_sat_sun_mon->mx_attendance_second_half;
                                                    }else if(date('N', strtotime($att_date)) == 1){//---->mon
                                                        $mon_flag = "yes";
                                                        $monday = $att_date;
                                                        $mon_first_half = $att_sat_sun_mon->mx_attendance_first_half;
                                                        $mon_second_half = $att_sat_sun_mon->mx_attendance_second_half;
                                                        // echo $monday."<--->".$mon_first_half. "<--->".$mon_second_half;exit;
                                                        //------CHECK MON PH
                                                        if($mon_first_half == "PH" && $mon_second_half == "PH"){
                                                            $mon_ph_so_back_check_array = $this->sat_mon_ph_so_back_check_ab($monday,$emp_code,'plus');
                                                            // echo "MON";print_r($mon_ph_so_back_check_array);exit;
                                                            $monday = $mon_ph_so_back_check_array[0]->mx_attendance_date;
                                                            $mon_first_half = $mon_ph_so_back_check_array[0]->mx_attendance_first_half;
                                                            $mon_second_half = $mon_ph_so_back_check_array[0]->mx_attendance_second_half;
                                                        }
                                                        //------END CHECK MON PH
                                                    }
                                                }
                                               
                                                if($sat_flag = "yes" && $sun_flag = "yes" && $mon_flag = "yes"){
                                                    
                                                    if($sat_first_half == "AB" && $sat_second_half == "AB" && $mon_first_half == "AB" && $mon_second_half == "AB" && $sun_first_half != "AB" && $sun_second_half != "AB"){
                                                        // $message = "For The Emp_code = ". $emp_code ." Not Contains Absent for the saturday = (".$saturday."), sunday = (".$sunday."), monday = (".$monday.") ........";
                                                        // getjsondata(0,$message); 
                                                        
                                                         // PRESENT MONTH AND YEAR
                                                        $upd_array = array(
                                                                            "mx_attendance_first_half"  => "AB",
                                                                            "mx_attendance_second_half" => "AB"
                                                                    );
                                                        // $table_name = "maxwell_attendance_".$current_year."_".$check_cron_month;
                                                        // echo $table_name;exit;
                                                        $this->db->where("mx_attendance_id",$attendance_id);
                                                        $this->db->where("mx_attendance_emp_code",$attendance_emp_code);
                                                        $this->db->update('maxwell_attendance_'.$current_year.'_'.$check_cron_month,$upd_array);
                                                        // END PRESENT MONTH AND YEAR
                                                        
                                                        // IF DAY 01 STARTS WITH MONDAY THEN WILL UPDATE PREVIOUS TABLE AS WELL
                                                        $date_new = $current_year . "-" . $check_cron_month . "-01";
                                                        $day_type_new = date('N', strtotime($date_new));
                                                        if($day_type_new == 1){// MONDAY
                                                            // PREVIOUS MONTH AND YEAR
                                                             if(intval($check_cron_month) == 1){
                                                                $previous_cron_month = 12;
                                                                $previous_year = $current_year - 1;
                                                            }else{
                                                                $previous_cron_month = intval($check_cron_month) - 1;
                                                                $previous_year = $current_year;
                                                            }
                                                            if(strlen($previous_cron_month) == 1){
                                                                $previous_cron_month = "0".$previous_cron_month;
                                                            }
                                                            $upd_array = array(
                                                                                "mx_attendance_first_half"  => "AB",
                                                                                "mx_attendance_second_half" => "AB"
                                                                        );
                                                            // $table_name = "maxwell_attendance_".$current_year."_".$check_cron_month;
                                                            // echo $table_name;exit;
                                                            
                                                            
                                                            $this->db->where("mx_attendance_id",$attendance_id);
                                                            $this->db->where("mx_attendance_emp_code",$attendance_emp_code);
                                                            $this->db->update('maxwell_attendance_'.$previous_year.'_'.$previous_cron_month,$upd_array);
                                                            // END PREVIOUS MONTH AND YEAR
                                                        }
                                                        // END IF DAY 01 STARTS WITH MONDAY THEN WILL UPDATE PREVIOUS TABLE AS WELL
                                                        // // NEXT MONTH AND YEAR
                                                        // $upd_array = array(
                                                        //                     "mx_attendance_first_half"  => "AB",
                                                        //                     "mx_attendance_second_half" => "AB"
                                                        //             );
                                                        // // $table_name = "maxwell_attendance_".$current_year."_".$check_cron_month;
                                                        // // echo $table_name;exit;
                                                        // $this->db->where("mx_attendance_id",$attendance_id);
                                                        // $this->db->where("mx_attendance_emp_code",$attendance_emp_code);
                                                        // $this->db->update('maxwell_attendance_'.$current_year.'_'.$check_cron_month,$upd_array);
                                                        // // echo $this->db->last_query();exit;
                                                        // // END NEXT MONTH AND YEAR
                                                    }
                                                    
                                                }else{
                                                    $message = "Something Went Wrong Getting No in one of the sat,sun,mon flag........";
                                                    getjsondata(0,$message);    
                                                }
                                                
                                            }elseif(count($attendance_sat_sun_mon_data) < 3){// if doj is 01-04-2024 u r running cron on april then march data wont exist then for such records do nothing
                                            }else{
                                                // echo $current_year . '<br>' . $check_cron_month . '<br>' . $cmp_id . '<br>' . $div_id . '<br>' . $state_id . '<br>' . $branch_id . '<br>' . $emp_code;exit;
                                                // echo "<pre>";print_r($attendance_sat_sun_mon_data);exit;
                                                $message = "Something Went Wrong Getting More Than 3 Arrays In Attendance Sat,Sunday,Monday Array........";
                                                getjsondata(0,$message);
                                            }
                                        }
                                    
                                }
                            //---------END CHECK SAT,SUN,MON DATA IN ATTENDANCE TABLE    
                           
                        }
                            //--------INSERTING DATA IN CRON HISTORY TABLE
                             $cron_histry_array = array(
                                                    "mxcron_comp_id"=>$cmp_id_cmp_master,  
                                                    "mxcron_year_month "=>$year_month,  
                                                    "mxcron_createdby"=>$this->session->userdata('user_id'),  
                                                    "mxcron_createdtime"=>date('Y-m-d h:m:s'),  
                                                    "mxcron_created_ip"=>$_SERVER['REMOTE_ADDR']
                                                 );
                            $this->db->insert("sat_sun_mon_cron_history",$cron_histry_array);
                            //--------END INSERTING DATA IN CRON HISTORY TABLE
                            
                            if($this->input->post('cron_status') == 'manual'){
                                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $array = array('name'=>'SAT SUN MON CRON MANUAL','Url' => $actual_link);
                                    $res = $this->db->insert('cron_log',$array);
                                    // return $print_array;
                            }else{
                                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $array = array('name'=>'SAT SUN MON','Url' => $actual_link);
                                    $res = $this->db->insert('cron_log',$array);
                            }
                        }
                        
                    
                    //---------END GETTING EMPLOYEE DATA AND CHECKING\
                    
            }
            if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 $message = "Something Went Wrong........";
                 getjsondata(0,$message);
            } else {
                 $this->db->trans_commit();
                 $message = "Successfully Executed The Cron........";
                 getjsondata(1,$message);
            }
            // echo "end";exit;    
        }else{
            $message = "No Companies Found To Run The Cro......";
            getjsondata(0,$message);
        }    
}

    public function public_holiday_absent_cron(){
        $this->db->trans_begin();
        //-------GETTING COMPANY IDS FROM COMPANY MASTER
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status', 1);
        if($this->input->post('cmp_id') && $this->input->post('cmp_id') != null){
            $this->db->where('mxcp_id', $this->input->post('cmp_id'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $cmp_res = $query->result();
        //-------END GETTING COMPANY IDS FROM COMPANY MASTER
        
        if(count($cmp_res) > 0){
            foreach($cmp_res as $cmp_data){
                $cmp_id_cmp_master = $cmp_data->mxcp_id;
                $cmp_name_cmp_master = $cmp_data->mxcp_name;
                // echo $cmp_id_cmp_master;exit;
                // $this->input->post('cron_month_year') = '12-2022';
                // echo $this->input->post('cron_month_year');exit;
                    if($this->input->post('cron_month_year') && $this->input->post('cron_month_year') != null){
                        $inp_data = $this->input->post('cron_month_year');
                        // $inp_data = '05-2022';
                        $ex_1 = explode('-',$inp_data);
                        $ex_date = $ex_1[1].'-'.$ex_1[0].'-01';
                        $year_month = date('Ym',strtotime($ex_date));
                        $current_year = date('Y',strtotime($ex_date));
                        $check_cron_month = date('m',strtotime($ex_date));
                        if(strlen($check_cron_month) == 1){
                            $check_cron_month = "0".$check_cron_month;
                        }
                    }else{
                        $current_year  = date("Y", strtotime("-1 months"));
                        $check_cron_month = date("m", strtotime("-1 months"));
                        
                        if(strlen($check_cron_month) == 1){
                            $check_cron_month = "0".$check_cron_month;
                        }
                        $year_month = date("Ym", strtotime("-1 months"));
                        
                    }
                    
                
                    // echo "year-month = ".$year_month.", Year = ".$current_year. ", Month = ".$check_cron_month;exit;
                    $table_name = "maxwell_attendance_".$current_year."_".$check_cron_month;
                    // echo $table_name;exit;
                    if($this->db->table_exists($table_name) == true){
                        #CHECK PREVIOUS MONTH AND NEXT MONTH TABLE
                        $dummy_date = $current_year."-".$check_cron_month."-01";
                        $dummy_previous_month = date('m',strtotime($dummy_date.'-1 Months'));
                        $dummy_previous_year = date('Y',strtotime($dummy_date.'-1 Months'));
                        $dummy_next_month = date('m',strtotime($dummy_date.'+1 Months'));
                        $dummy_next_year = date('Y',strtotime($dummy_date.'+1 Months'));
                        if($this->db->table_exists("maxwell_attendance_".$dummy_previous_year."_".$dummy_previous_month) == false){//--->previous month and year table check
                           $message = "Previous MONTH Attendance Table Not Exist Please Create ie year($dummy_previous_year) & month($dummy_previous_month)........";
                           getjsondata(0,$message); 
                        }
                        if($this->db->table_exists("maxwell_attendance_".$dummy_next_year."_".$dummy_next_month) == false){//--->previous month and year table check
                           $message = "NEXT MONTH Attendance Table Not Exist Please Create ie year($dummy_next_year) & month($dummy_next_month)........";
                           getjsondata(0,$message); 
                        }
                        #END CHECK PREVIOUS MONTH AND NEXT MONTH TABLE
                        $history_data = $this->check_public_holiday_absent_cron_history($year_month,$cmp_id_cmp_master);
                        // print_r($history_data);exit;
                    
                        $total_days_of_cron_month = cal_days_in_month(CAL_GREGORIAN, $check_cron_month, $current_year);
                        // echo $total_days_of_cron_month;exit;
                        //-------------FILTERING SAT,SUN,MON ARRAYS
                        for ($day = 1; $day <= $total_days_of_cron_month; $day++) {
                            
                            
                            if(intval($day) < 10){
                                $day = "0".$day;
                            }
                            $current_date = $current_year . "-" . $check_cron_month . "-" . $day;
                            $current_day_type = date('N', strtotime($current_date)); //----mon = 1....sun =7
                            
                            
                            
                            
                            $single_quote = "'";
                            $this->db->select("mx_attendance_emp_code,concat(\"$single_quote\",mx_attendance_emp_code,\"$single_quote\") as emp_code_quote,mx_attendance_first_half,mx_attendance_second_half");
                            $this->db->from($table_name);
                            $this->db->where('date(mx_attendance_date)', $current_date);
                            $this->db->where('mx_attendance_first_half', 'PH');
                            $this->db->where('mx_attendance_second_half', 'PH');
                            $this->db->order_by('mx_attendance_emp_code', 'ASC');
                            $this->db->where('mx_attendance_status', 1);
                            $query = $this->db->get();
                            // echo $this->db->last_query();exit;
                            $res = $query->result_array();
                            // print_r($res);exit;
                            
                            if(count($res) > 0){
                            $specific_user_id_array= implode(',',array_column($res, 'emp_code_quote'));
                            // print_r($specific_user_id_array);exit;
                            
                            // echo $current_day_type;exit;
                            if($current_day_type == 1){//----if monday -2days ie take sat ignore sun
                                $previous_day = date('Y-m-d',strtotime($current_date .'-2 day'));
                                $next_day = date('Y-m-d',strtotime($current_date .'+1 day'));
                            }else if($current_day_type == 6){//-->for sat next day +2days and prev day -1day
                                $previous_day = date('Y-m-d',strtotime($current_date .'-1 day'));
                                $next_day = date('Y-m-d',strtotime($current_date .'+2 day'));
                            }else{//---->For all remaining days prev -1 & for nextday +1day
                                $previous_day = date('Y-m-d',strtotime($current_date .'-1 day'));
                                $next_day = date('Y-m-d',strtotime($current_date .'+1 day'));
                            }
                            
                            
                            // if($day == 18){
                            //     echo "current_day_type = ".$current_day_type."<br>";
                            //     echo "previous_day = ".$previous_day.", current_date = ".$current_date.", next_day = ".$next_day;exit;
                            // }
                            
                            
                            
                            #YEAR & MONTH OF PREV & NEXT DAYS
                            $prev_year = date('Y',strtotime($previous_day));
                            $prev_month = date('m',strtotime($previous_day));
                            if(strlen($prev_month) == 1){
                                $prev_month = "0".$prev_month;
                            }
                            
                            $next_year = date('Y',strtotime($next_day));
                            $next_month = date('m',strtotime($next_day));
                            if(strlen($next_month) == 1){
                                $next_month = "0".$next_month;
                            }
                            #YEAR & MONTH OF PREV & NEXT DAYS
                            
                            
                            //----CHECK IF IT IS DIFFERENT TABLE
                            $other_table = "";
                            if($current_year != $prev_year || $check_cron_month != $prev_month){//previous year & month
                                 $other_table = "maxwell_attendance_".$prev_year."_".$prev_month;
                            }else if($current_year != $next_year || $check_cron_month != $next_month){//Next year & month
                                 $other_table = "maxwell_attendance_".$next_year."_".$next_month;
                            }
                            //----END CHECK IF IT IS DIFFERENT TABLE
                            
                            
                            
                            // if($day == 01){
                            //     echo "prev other_table = ".$other_table;exit;
                            // }
                            // if($day == $total_days_of_cron_month){
                            //     echo "next other_table = ".$other_table;exit;
                            // }
                            
                            
                            // echo "table_name = ".$table_name.", other_table =".$other_table;exit;
                            $sub_query = "SELECT mx_attendance_emp_code,mx_attendance_date,mx_attendance_first_half,mx_attendance_second_half,mx_attendance_status FROM $table_name 
                                    where
                                    mx_attendance_emp_code in($specific_user_id_array)
                                    and mx_attendance_status = 1";
                            if($other_table){
                                $sub_query .= " union all 
                                    SELECT mx_attendance_emp_code,mx_attendance_date,mx_attendance_first_half,mx_attendance_second_half,mx_attendance_status FROM $other_table 
                                    where 
                                    mx_attendance_emp_code in($specific_user_id_array)";
                            }
                                $sub_query .= " order by mx_attendance_emp_code asc";
                            
                            // echo $sub_query;exit;
                            
                            /*
                                if first half and second half for previous & next day is AB then will get count 2
                            */
                            $qry = "select count(mx_attendance_date) as attendance_ph_count,mx_attendance_emp_code from (select mx_attendance_emp_code,mx_attendance_date,mx_attendance_first_half,mx_attendance_second_half,mx_attendance_status from ($sub_query) as z
                                    where z.mx_attendance_date in ('$previous_day','$next_day')) as x
                                    where mx_attendance_first_half = 'AB' and mx_attendance_second_half = 'AB'
       		                        group by(mx_attendance_emp_code) 
       		                        having attendance_ph_count >= 2 
       		                        ORDER by mx_attendance_emp_code ASC";
                            $final_res = $this->db->query($qry)->result();
                            // $query = $this->db->get();
                            // echo $this->db->last_query();exit; 
                            // print_r($final_res);exit;
                                if(count($final_res) > 0){
                                    $emp_codes_array = array_column($final_res, 'mx_attendance_emp_code');
                                    // echo "emp_codes_array = ".$emp_codes_array;exit;
                                    $up_array = array(
                                                    "mx_attendance_first_half"=>"AB",
                                                    "mx_attendance_second_half"=>"AB",
                                                );
                                    $this->db->where_in('mx_attendance_emp_code',$emp_codes_array);
                                    $this->db->where('mx_attendance_date',$current_date);
                                    $this->db->update($table_name,$up_array);
                                    // echo $this->db->last_query();exit; 
                                
                                }
                            
                            }
                            
                            
                            
                            
                                
                        }
                        //-------------END FILTERING SAT,SUN,MON ARRAYS
                     
                    
                        //--------INSERTING DATA IN CRON HISTORY TABLE
                         $cron_histry_array = array(
                                                "mxcron_comp_id"=>$cmp_id_cmp_master,  
                                                "mxcron_year_month "=>$year_month,  
                                                "mxcron_createdby"=>$this->session->userdata('user_id'),  
                                                "mxcron_createdtime"=>date('Y-m-d h:m:s'),  
                                                "mxcron_created_ip"=>$_SERVER['REMOTE_ADDR']
                                             );
                        $this->db->insert("public_holiday_absent_history",$cron_histry_array);
                        //--------END INSERTING DATA IN CRON HISTORY TABLE
                        if($this->input->post('cron_status') == 'manual'){
                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $array = array('name'=>'PUBLIC HOLIDAY CRON MANUAL','Url' => $actual_link);
                                $res = $this->db->insert('cron_log',$array);
                                // return $print_array;
                        }else{
                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $array = array('name'=>'PUBLIC HOLIDAY','Url' => $actual_link);
                                $res = $this->db->insert('cron_log',$array);
                        }
                    }else{
                        $message = "Current Attendance Table Not Exist ie year($current_year) & month($check_cron_month)........";
                        getjsondata(0,$message);
                    }
                    
                    
            }
            if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 $message = "Something Went Wrong........";
                 getjsondata(0,$message);
            } else {
                 $this->db->trans_commit();
                 $message = "Successfully Executed The Cron........";
                 getjsondata(1,$message);
            }
            // echo "end";exit;    
        }else{
            $message = "No Companies Found To Run The Cro......";
            getjsondata(0,$message);
        }    
}
    //----------------GET EMPLOYEE ATTENDANCE
    public function get_emp_attendence_data($year,$month,$cmp_id=null,$div_id=null,$state_id = null,$branch_id = null,$emp_code =null,$date=null,$attendaces_dates_array = null){
        
        if(strlen($month) == 1){
            $month = "0".$month;
        }
        // echo $year;exit;
        
        //---- MINUS MONTH & YEAR
        if(intval($month) == 1){
            $previous_month = '12';
            $previous_year = intval($year) - 1;
        }else{
            $previous_month = intval($month) - 1;
            $previous_year  = $year;
        }
        if(strlen($previous_month) == 1){
            $previous_month = "0".$previous_month;
        }
        
        //---- PLUS MONTH & YEAR
        if(intval($month) == 12){
            $next_month = '01';
            $next_year = intval($year) + 1;
        }else{
            $next_month = intval($month) + 1;
            $next_year = $year;
        }
        if(strlen($next_month) == 1){
            $next_month = "0".$next_month;
        }
        
        $previous_table_name = "maxwell_attendance_".$previous_year."_".$previous_month;
        $table_name = "maxwell_attendance_".$year."_".$month;
        $next_table_name = "maxwell_attendance_".$next_year."_".$next_month;
        // echo "previous = " .$previous_table_name. ", current = ".$table_name. ", Next = " .$next_table_name;exit;
        // var_dump($this->db->table_exists($table_name));exit;
        if($this->db->table_exists($previous_table_name) == true && $this->db->table_exists($table_name) == true && $this->db->table_exists($next_table_name) == true){
            //   QUERY 1
            $this->db->select();
            $this->db->from($previous_table_name);
            $this->db->where("mx_attendance_status",1);
            if(!empty($cmp_id) && $cmp_id !=null){
                $this->db->where("mx_attendance_cmp_id",$cmp_id);
            }
            if(!empty($div_id) && $div_id !=null){
                $this->db->where("mx_attendance_division_id",$div_id);
            }
            if(!empty($state_id) && $state_id !=null){
                $this->db->where("mx_attendance_state_id",$state_id);
            }
            if(!empty($branch_id) && $branch_id !=null){
                $this->db->where("mx_attendance_branch_id",$branch_id);
            }
            if(!empty($emp_code) && $emp_code !=null){
                $this->db->where("mx_attendance_emp_code",$emp_code);
            }
            if(!empty($date) && $date !=null){
                $this->db->where("mx_attendance_date",$date);
            }
            if(!empty($attendaces_dates_array) && $attendaces_dates_array !=null){
                $this->db->where_in("mx_attendance_date",$attendaces_dates_array);
            }
            $qry1 = $this->db->get();
            $res1 = $qry1->result();
            //   END QUERY 1
            //   QUERY 2
            $this->db->select();
            $this->db->from($table_name);
            $this->db->where("mx_attendance_status",1);
            if(!empty($cmp_id) && $cmp_id !=null){
                $this->db->where("mx_attendance_cmp_id",$cmp_id);
            }
            if(!empty($div_id) && $div_id !=null){
                $this->db->where("mx_attendance_division_id",$div_id);
            }
            if(!empty($state_id) && $state_id !=null){
                $this->db->where("mx_attendance_state_id",$state_id);
            }
            if(!empty($branch_id) && $branch_id !=null){
                $this->db->where("mx_attendance_branch_id",$branch_id);
            }
            if(!empty($emp_code) && $emp_code !=null){
                $this->db->where("mx_attendance_emp_code",$emp_code);
            }
            if(!empty($date) && $date !=null){
                $this->db->where("mx_attendance_date",$date);
            }
            if(!empty($attendaces_dates_array) && $attendaces_dates_array !=null){
                $this->db->where_in("mx_attendance_date",$attendaces_dates_array);
            }
            $qry2 = $this->db->get();
            $res2 = $qry2->result();
            //   END QUERY 2
            //   QUERY 3
            $this->db->select();
            $this->db->from($next_table_name);
            $this->db->where("mx_attendance_status",1);
            if(!empty($cmp_id) && $cmp_id !=null){
                $this->db->where("mx_attendance_cmp_id",$cmp_id);
            }
            if(!empty($div_id) && $div_id !=null){
                $this->db->where("mx_attendance_division_id",$div_id);
            }
            if(!empty($state_id) && $state_id !=null){
                $this->db->where("mx_attendance_state_id",$state_id);
            }
            if(!empty($branch_id) && $branch_id !=null){
                $this->db->where("mx_attendance_branch_id",$branch_id);
            }
            if(!empty($emp_code) && $emp_code !=null){
                $this->db->where("mx_attendance_emp_code",$emp_code);
            }
            if(!empty($date) && $date !=null){
                $this->db->where("mx_attendance_date",$date);
            }
            if(!empty($attendaces_dates_array) && $attendaces_dates_array !=null){
                $this->db->where_in("mx_attendance_date",$attendaces_dates_array);
            }
            $qry3 = $this->db->get();
            //   END QUERY 3
            $res3 = $qry3->result();
            // echo $this->db->last_query();exit;
            // $res = $qry->result();
            $result = array_merge($res1, $res2, $res3);
            // if($emp_code == 'M0005'){
            //     echo "ss";print_r($result);exit;
            // }
            // print_r($result);exit;
            return $result;
        }else{
            $message = "No Attendance Table Exist Please Create one of the Table First for the year of ($previous_year or $year or $next_year)  & month = ($previous_month or $month or $next_month)";
            getjsondata(0,$message);
        }
    }
    //----------------END GET EMPLOYEE ATTENDANCE
    //----------------CHECK CRON HISTORY
    public function check_sat_sun_mon_cron_history($year_month,$cmp_id){
        $this->db->select();
        $this->db->from("sat_sun_mon_cron_history");
        $this->db->where("mxcron_comp_id",$cmp_id);
        $this->db->where("mxcron_status",1);
        $this->db->where("mxcron_year_month",$year_month);
        $qry = $this->db->get();
        // echo $this->db->last_query();exit;
        $res = $qry->result();
        return $res;
    }
    //----------------END CHECK CRON HISTORY
    //----------------CHECK CRON HISTORY
    public function check_public_holiday_absent_cron_history($year_month,$cmp_id){
        $this->db->select();
        $this->db->from("public_holiday_absent_history");
        $this->db->where("mxcron_comp_id",$cmp_id);
        $this->db->where("mxcron_status",1);
        $this->db->where("mxcron_year_month",$year_month);
        $qry = $this->db->get();
        // echo $this->db->last_query();exit;
        $res = $qry->result();
        return $res;
    }
    //----------------END CHECK CRON HISTORY
    //---------------EMPLOYEE INFO
    public function getemployeesinfo($data)
    {
        $this->db->select('mxemp_emp_autouniqueid,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_comp_code,mxcp_name,mxemp_emp_division_code,mxd_name,mxemp_emp_state_code,mxst_state,mxemp_emp_branch_code,mxb_name,mxemp_emp_desg_code,mxdesg_name,mxemp_emp_dept_code,mxdpt_name,mxemp_emp_type,mxemp_ty_name,mxemp_emp_current_salary,mxemp_emp_grade_code,mxemp_emp_date_of_birth');
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        //--------NEW BY SHABABU
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
        $this->db->join('maxwell_employee_type_master',"mxemp_ty_id = mxemp_emp_type","inner");
        //--------END NEW BY SHABABU
        if (!empty($data['cmpname'])) {
            $this->db->where('mxemp_emp_comp_code', $data['cmpname']);
        }
        if (!empty($data['divname'])) {
            $this->db->where('mxemp_emp_division_code', $data['divname']);
        }
        if (!empty($data['brname'])) {
            $this->db->where('mxemp_emp_branch_code', $data['brname']);
        }
        if (!empty($data['emptype'])) {
            $this->db->where('mxemp_emp_type', $data['emptype']);
        }
        if (!empty($data['cmpstate'])) {
            $this->db->where('mxemp_emp_state_code', $data['cmpstate']);
        }
        if (!empty($data['emp_id'])) {
            $this->db->where('mxemp_emp_id', $data['emp_id']);
        }
        //----------NEW BY SHABABU(29-01-2021)
        if (isset($data['dept_code']) && !empty($data['dept_code'])) {
            $this->db->where('mxemp_emp_dept_code', $data['dept_code']);
        }
        //----------NEW BY SHABABU(29-01-2021)

        // $this->db->where('mxemp_emp_id', 'ORM0021');
        $this->db->where('mxemp_emp_status', 1);
        // $this->db->where('mxemp_emp_resignation_status', 0);
        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->order_by('mxemp_emp_type,mxemp_emp_comp_code');
        $query = $this->db->get();
            // echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }
    //---------------EMPLOYEE INFO
//--------------END NEW BY SHABABU(06-06-2021)

    /* public function transfer_cron(){
        $this->db->trans_begin();
        //-------GETTING COMPANY IDS FROM COMPANY MASTER
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status', 1);
        if($this->input->post('cmp_id') && $this->input->post('cmp_id') != null){
            $this->db->where('mxcp_id', $this->input->post('cmp_id'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $cmp_res = $query->result();
        //-------END GETTING COMPANY IDS FROM COMPANY MASTER
        // print_r($cmp_res);exit;
        if(count($cmp_res) > 0){
            foreach($cmp_res as $cmp_data){
                $cmp_id_cmp_master = $cmp_data->mxcp_id;
                $cmp_name_cmp_master = $cmp_data->mxcp_name;
                // echo $cmp_id_cmp_master;exit;
                // echo $this->input->post('cron_month_year');exit;
                    if($this->input->post('cron_month_year') && $this->input->post('cron_month_year') != null){
                        $ex_1 = explode('-',$this->input->post('cron_month_year'));
                        $ex_date = $ex_1[1].'-'.$ex_1[0].'-01';
                        $year_month = date('Ym',strtotime($ex_date));
                        $year = date('Y',strtotime($ex_date));
                        $month = date('m',strtotime($ex_date));
                        if($year == date('Y') && $month == date('m')){
                            $day_end = date('d');
                        }else{
                            $day_end = cal_days_in_month(CAL_GREGORIAN, $month, $year); //---->Get no of days in a month
                        }
                    }else{
                        $year_month = date("Ym");
                        $day_year_month = date("Y-m-d");
                        $year = date('Y');
                        $month = date('m');
                        $day_end = cal_days_in_month(CAL_GREGORIAN, $month, $year); //---->Get no of days in a month
                        
                    }//echo $year_month;exit;
                    for($i = 01;$i<=$day_end;$i++){//$i=11;echo strlen($i);exit;
                        $day = $i;
                        if(strlen($day) == 1){
                            $day = "0".$i;
                        }
                        $date = $year."-".$month."-".$day;
                        // echo $date."<br>";
                        //--------PROMOTION TABLE
                            $this->db->select("mxemp_parent_log_id,mxemp_prm_joining_date,mxemp_prm_emp_code,mxemp_prm_is_authorisations,mxemp_prm_comp_id_to,mxemp_prm_div_id_to,mxemp_prm_state_id_to,mxemp_prm_branch_id_to");
                            $this->db->from("maxwell_emp_promotion");
                            $this->db->where("mxemp_prm_joining_date",$date);
                            $qry_prom = $this->db->get();
                            $prom_res = $qry_prom->result();
                            if(count($prom_res) > 0){
                                foreach($prom_res as $promo_result){
                                    
                                    // print_r($promo_result);exit;
                                    $prom_parent_id = $promo_result->mxemp_parent_log_id;
                                    $prom_emp_cod = $promo_result->mxemp_prm_emp_code;
                                    $prom_is_auth = $promo_result->mxemp_prm_is_authorisations;//---->IF IT IS 1 THEN WE WILL CHANG AUTHORIATIONS ELSE WE WONT CHANGE AUTHORISATIONS
                                    $prom_join_date = $promo_result->mxemp_prm_joining_date;
                                    
                                    //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                    $promotion_update_master_array = array(
                                                                        'mxemp_emp_comp_code' => $promo_result->mxemp_prm_comp_id_to,
                                                                        'mxemp_emp_division_code' => $promo_result->mxemp_prm_div_id_to,
                                                                        'mxemp_emp_state_code' => $promo_result->mxemp_prm_state_id_to,
                                                                        'mxemp_emp_branch_code' => $promo_result->mxemp_prm_branch_id_to,
                                                                    );
                                    $this->db->where('mxemp_emp_id',$prom_emp_cod);
                                    $res_master =  $this->db->update('maxwell_employees_info',$promotion_update_master_array);
                                    //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                    
                                    // $res_master = true;
                                    if($res_master){
                                        # Update Authorisations
                                        if($prom_is_auth == 1){
                                           $this->update_authorisations($prom_parent_id,$prom_emp_cod);
                                        }
                                        # UPDATING ATTENDANCE TABLE
                                        $update_attendance_array = array(
                                            'mx_attendance_cmp_id' => $promo_result->mxemp_prm_comp_id_to,
                                            'mx_attendance_division_id' => $promo_result->mxemp_prm_div_id_to,
                                            'mx_attendance_state_id' => $promo_result->mxemp_prm_state_id_to,
                                            'mx_attendance_branch_id' => $promo_result->mxemp_prm_branch_id_to
                                        );
                                        // print_r($update_attendance_array);exit;
                                        $this->update_emp_attendance($prom_join_date,$prom_emp_cod,$update_attendance_array);
                                        # END UPDATING ATTENDANCE TABLE
                                    }
                                }
                            }
                            
                        //--------END PROMOTION TABLE
                        
                        
                        //--------TRANSFER TABLE
                            $this->db->select("mxemp_parent_log_id,mxemp_trs_emp_code,mxemp_trs_emp_joining_date,mxemp_trs_comp_id_to,mxemp_trs_div_id_to,mxemp_trs_state_id_to,mxemp_trs_branch_id_to");
                            $this->db->from("maxwell_emp_trasfers");
                            $this->db->where("mxemp_trs_emp_joining_date",$date);
                            $qry_trns = $this->db->get();
                            $trns_res = $qry_trns->result();
                            if(count($trns_res) > 0){
                                foreach($trns_res as $trns_result){
                                    // print_r($trns_result);exit;
                                    $trns_parent_id = $trns_result->mxemp_parent_log_id;
                                    $trns_emp_cod = $trns_result->mxemp_trs_emp_code;
                                    $trns_join_date = $trns_result->mxemp_trs_emp_joining_date;
                                    //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                    $transfer_update_master_array = array(
                                                                        'mxemp_emp_comp_code' => $trns_result->mxemp_trs_comp_id_to,
                                                                        'mxemp_emp_division_code' => $trns_result->mxemp_trs_div_id_to,
                                                                        'mxemp_emp_state_code' => $trns_result->mxemp_trs_state_id_to,
                                                                        'mxemp_emp_branch_code' => $trns_result->mxemp_trs_branch_id_to,
                                                                    );
                                    $this->db->where('mxemp_emp_id',$trns_emp_cod);
                                    $res_master =  $this->db->update('maxwell_employees_info',$transfer_update_master_array);
                                    //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                    // $res_master = true;
                                    if($res_master){
                                        # Update Authorisations
                                        // $prom_is_auth = $trns_result->mxemp_prm_is_authorisations;
                                        $this->update_authorisations($trns_parent_id,$trns_emp_cod);
                                        # UPDATING ATTENDANCE TABLE
                                        $update_attendance_array = array(
                                            'mx_attendance_cmp_id' => $trns_result->mxemp_trs_comp_id_to,
                                            'mx_attendance_division_id' => $trns_result->mxemp_trs_div_id_to,
                                            'mx_attendance_state_id' => $trns_result->mxemp_trs_state_id_to,
                                            'mx_attendance_branch_id' => $trns_result->mxemp_trs_branch_id_to
                                        );
                                        // print_r($update_attendance_array);exit;
                                        $this->update_emp_attendance($trns_join_date,$trns_emp_cod,$update_attendance_array);
                                        # END UPDATING ATTENDANCE TABLE
                                    }
                                }
                            }
                            
                        //--------END TRANSFER TABLE
                    }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message = "Something Went Wrong........";
            getjsondata(0,$message);
        } else {
            $this->db->trans_commit();
            $message = "Successfully Executed The Cron........";
            getjsondata(1,$message);
        }
    } */
    
    public function increments_cron(){
        /*
            AUTHOR : SHABABU
            DESC : THESE CRON RUNS MONTH WISE
                    FOR BOTH : PRMOTION & SPECIAL INCREMENT
        */
        $this->db->trans_begin();
        //-------GETTING COMPANY IDS FROM COMPANY MASTER
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status', 1);
        if($this->input->post('cmp_id') && $this->input->post('cmp_id') != null){
            $this->db->where('mxcp_id', $this->input->post('cmp_id'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $cmp_res = $query->result();
        //-------END GETTING COMPANY IDS FROM COMPANY MASTER
        // print_r($cmp_res);exit;
        if(count($cmp_res) > 0){
            foreach($cmp_res as $cmp_data){
                $cmp_id_cmp_master = $cmp_data->mxcp_id;
                $cmp_name_cmp_master = $cmp_data->mxcp_name;
                // echo $cmp_id_cmp_master;exit;
                // echo $this->input->post('cron_month_year');exit;
                    if($this->input->post('cron_month_year') && $this->input->post('cron_month_year') != null){ //----->FROM FRONT END RUNNING CRON FOR MONTH WISE
                            $ex_1 = explode('-',$this->input->post('cron_month_year'));
                            $ex_date = $ex_1[1].'-'.$ex_1[0].'-01';
                            $year_month = date('Ym',strtotime($ex_date));
                            // echo $year_month;exit;
                            
                            // echo $date."<br>";
                            #--------PROMOTION TABLE
                                $this->db->select("mxemp_prm_id,mxemp_parent_log_id,mxemp_prm_affect_dt,mxemp_prm_joining_date,mxemp_prm_emp_code,mxemp_prm_is_authorisations,mxemp_prm_comp_id_to,mxemp_prm_div_id_to,mxemp_prm_state_id_to,mxemp_prm_branch_id_to,mxemp_prm_amount,mxemp_prm_desg_id_to,mxemp_prm_grade_id_to,mxemp_prm_dept_id_to");
                                $this->db->from("maxwell_emp_promotion");
                                $this->db->where("mxemp_prm_affect_dt",$year_month);
                                $this->db->where("mxemp_prm_cron_status_flag", 0); // means taking without cron executed records
                                $this->db->where("mxemp_prm_status",1);
                                $qry_prom = $this->db->get();
                                // echo $this->db->last_query();exit;
                                $prom_res = $qry_prom->result();
                                if(count($prom_res) > 0){
                                    foreach($prom_res as $promo_result){
                                        
                                        // print_r($promo_result);exit;
                                        $prom_id = $promo_result->mxemp_prm_id;
                                        $prom_parent_id = $promo_result->mxemp_parent_log_id;
                                        $prom_emp_cod = $promo_result->mxemp_prm_emp_code;
                                        $prom_is_auth = $promo_result->mxemp_prm_is_authorisations;//---->IF IT IS 1 THEN WE WILL CHANG AUTHORIATIONS ELSE WE WONT CHANGE AUTHORISATIONS
                                        $prom_join_date = $promo_result->mxemp_prm_joining_date;
                                        $prom_affect_date = $promo_result->mxemp_prm_affect_dt;
                                        
                                        $this->db->select('mxemp_emp_current_salary');
                                        $this->db->from('maxwell_employees_info');
                                        $this->db->where('mxemp_emp_status', 1);
                                        $this->db->where('mxemp_emp_id', $prom_emp_cod);
                                        $emp_query = $this->db->get();
                                        // echo $this->db->last_query();exit;
                                        $emp_res = $emp_query->row();
                                        // print_r($emp_res);exit;
                                        //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                        $promotion_update_master_array = array(
                                                                            'mxemp_emp_comp_code' => $promo_result->mxemp_prm_comp_id_to,
                                                                            'mxemp_emp_division_code' => $promo_result->mxemp_prm_div_id_to,
                                                                            'mxemp_emp_state_code' => $promo_result->mxemp_prm_state_id_to,
                                                                            'mxemp_emp_branch_code' => $promo_result->mxemp_prm_branch_id_to,
                                                                            'mxemp_emp_desg_code' => $promo_result->mxemp_prm_desg_id_to,
                                                                            'mxemp_emp_dept_code' => $promo_result->mxemp_prm_dept_id_to,
                                                                            'mxemp_emp_grade_code' => $promo_result->mxemp_prm_grade_id_to,
                                                                            'mxemp_emp_current_salary' => $emp_res->mxemp_emp_current_salary + $promo_result->mxemp_prm_amount,
                                                                        );
                                                                        
                                        // print_r($promotion_update_master_array);exit;
                                        // $this->db->set('mxemp_emp_current_salary',"mxemp_emp_current_salary + $promo_result->mxemp_prm_amount",false);
                                        $this->db->where('mxemp_emp_id',$prom_emp_cod);
                                        $res_master =  $this->db->update('maxwell_employees_info',$promotion_update_master_array);
                                        // echo $this->db->last_query();exit;
                                        //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                        
                                        // $res_master = true;
                                        if($res_master){
                                            # Update Authorisations
                                            if($prom_is_auth == 1){
                                               //  UPDATE THE PREVIOUS AUTHORISATION IN PROMOTION TABLE
                                               $this->db->select('mxauth_id');
                                               $this->db->from('maxwell_emp_authorsations');
                                               $this->db->where('mxauth_emp_code',$prom_emp_cod);
                                               $this->db->where('mxauth_status',1);
                                               $auth_query = $this->db->get();
                                               $res_auth = $auth_query->result();
                                               $json_data = json_encode($res_auth);
                                                 $promotion_update_array1 = array(
                                                                            'mxemp_prm_authorisations_ids' => $json_data
                                                                          );
                                                $this->db->where('mxemp_prm_id',$prom_id);
                                                $this->db->update('maxwell_emp_promotion',$promotion_update_array1);
                                               //  UPDATE THE PREVIOUS AUTHORISATION IN PROMOTION TABLE
                                               //  UPDATE STATUS OF NEW AUTHORISATIONS
                                               $this->update_authorisations($prom_parent_id,$prom_emp_cod);
                                            }
                                            # UPDATING ATTENDANCE TABLE
                                            $update_attendance_array = array(
                                                'mx_attendance_cmp_id' => $promo_result->mxemp_prm_comp_id_to,
                                                'mx_attendance_division_id' => $promo_result->mxemp_prm_div_id_to,
                                                'mx_attendance_state_id' => $promo_result->mxemp_prm_state_id_to,
                                                'mx_attendance_branch_id' => $promo_result->mxemp_prm_branch_id_to
                                            );
                                            // print_r($update_attendance_array);exit;
                                            $this->update_emp_attendance($prom_join_date,$prom_emp_cod,$update_attendance_array);
                                            # END UPDATING ATTENDANCE TABLE
                                            
                                            #UPDATE CRON STATUS
                                            //-------UPDATING CRON STATUS IN LOG TABLE
                                            $promotion_update_log_array = array(
                                                                            'mxtrns_prm_cron_status_flag' => 1
                                                                          );
                                            $this->db->where('mxtrns_prm_id',$prom_parent_id);
                                            $res_master =  $this->db->update('maxwell_emp_trans_prom_log',$promotion_update_log_array);
                                            
                                            //-------UPDATING CRON STATUS TO 1 in PROMOTION TABLE
                                            $promotion_update_array = array(
                                                                            'mxemp_prm_cron_status_flag' => 1
                                                                          );
                                            $this->db->where('mxemp_prm_id',$prom_id);
                                            $res_master =  $this->db->update('maxwell_emp_promotion',$promotion_update_array);
                                            #END UPDATE CRON STATUS
                                        }
                                    }
                                }
                                
                            //--------END PROMOTION TABLE
                            
                            #--------SPECIAL INCREMENT TABLE
                                $this->db->select("mxemp_spl_inc_id,mxemp_spl_inc_parent_log_id,mxemp_spl_inc_emp_code,mxemp_spl_inc_affect_dt,mxemp_spl_inc_affect_dt_ymd,mxemp_spl_inc_amount");
                                $this->db->from("maxwell_emp_special_increaments");
                                $this->db->where("mxemp_spl_inc_affect_dt",$year_month);
                                $this->db->where("mxemp_spl_inc_cron_status", 0); // means taking without cron executed records
                                $this->db->where("mxemp_spl_inc_status",1);
                                $qry_spcl_inc = $this->db->get();
                                // echo $this->db->last_query();exit;
                                $spcl_inc_res = $qry_spcl_inc->result();
                                if(count($spcl_inc_res) > 0){
                                    foreach($spcl_inc_res as $inc_result){
                                        
                                        // print_r($inc_result);exit;
                                        $spcl_inc_id = $inc_result->mxemp_spl_inc_id;
                                        $spcl_inc_parent_id = $inc_result->mxemp_spl_inc_parent_log_id;
                                        $spcl_inc_emp_cod = $inc_result->mxemp_spl_inc_emp_code;
                                        $spcl_inc_affect_date = $inc_result->mxemp_spl_inc_affect_dt;
                                        $spcl_inc_amount = $inc_result->mxemp_spl_inc_amount;
                                        
                                        //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                        
                                        $this->db->set('mxemp_emp_current_salary',"mxemp_emp_current_salary + $spcl_inc_amount",false);
                                        $this->db->where('mxemp_emp_id',$spcl_inc_emp_cod);
                                        $res_spcl_inc =  $this->db->update('maxwell_employees_info');
                                        
                                        // echo $this->db->last_query();exit;
                                        //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                        
                                        // $res_spcl_inc = true;
                                        if($res_spcl_inc){
                                            
                                            
                                            #UPDATE CRON STATUS
                                            //-------UPDATING CRON STATUS IN LOG TABLE
                                            $spcl_inc_update_log_array = array(
                                                                            'mxtrns_prm_cron_status_flag' => 1
                                                                          );
                                            $this->db->where('mxtrns_prm_id',$spcl_inc_parent_id);
                                            $res_master =  $this->db->update('maxwell_emp_trans_prom_log',$spcl_inc_update_log_array);
                                            
                                            //-------UPDATING CRON STATUS TO 1 in PROMOTION TABLE
                                            $spcl_inc_update_array = array(
                                                                            'mxemp_spl_inc_cron_status' => 1
                                                                          );
                                            $this->db->where('mxemp_spl_inc_id',$spcl_inc_id);
                                            $res_master =  $this->db->update('maxwell_emp_special_increaments',$spcl_inc_update_array);
                                            #END UPDATE CRON STATUS
                                        }
                                    }
                                }
                                
                            //--------END SPECIAL INCREMENT TABLE
                            
                            
                            
                    }else{
                        $year_month = date("Ym");
                        $day_year_month = date("Y-m-d");
                        $year = date('Y');
                        $month = date('m');
                        $day_end = cal_days_in_month(CAL_GREGORIAN, $month, $year); //---->Get no of days in a month
                        
                    }//echo $year_month;exit;
                    
                    
            }
            if($this->input->post('cron_status') == 'manual'){
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $array = array('name'=>'INCREMENT CRON MANUAL','Url' => $actual_link);
                    $res = $this->db->insert('cron_log',$array);
                    // return $print_array;
            }else{
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $array = array('name'=>'INCREMENT','Url' => $actual_link);
                    $res = $this->db->insert('cron_log',$array);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message = "Something Went Wrong........";
            getjsondata(0,$message);
        } else {
            $this->db->trans_commit();
            $message = "Successfully Executed The Cron........";
            getjsondata(1,$message);
        }
    }
    
    public function transfer_cron(){ //---->DAY WISE AND MONTH WISE CRON CODE
        /*
            Author : S.C.SHABABU
            DESCRIPTION : ONCE PER DAY AT NYT 12 ADDED ALREADY IN CRON
        */
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $this->db->trans_begin($data);
        //-------GETTING COMPANY IDS FROM COMPANY MASTER
        // $emp_code = $this->input->post('emp_code');//---.NEW BY SHABABU(19-08-2022)
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status', 1);
        if($this->input->post('cmp_id') && $this->input->post('cmp_id') != null){
            $this->db->where('mxcp_id', $this->input->post('cmp_id'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $cmp_res = $query->result();
        //-------END GETTING COMPANY IDS FROM COMPANY MASTER
        // print_r($cmp_res);exit;
        if(count($cmp_res) > 0){
            foreach($cmp_res as $cmp_data){
                $cmp_id_cmp_master = $cmp_data->mxcp_id;
                $cmp_name_cmp_master = $cmp_data->mxcp_name;
                // echo $cmp_id_cmp_master;exit;
                // echo $this->input->post('cron_month_year');exit;
                    if($this->input->post('cron_month_year') && $this->input->post('cron_month_year') != null){ //----->FROM FRONT END RUNNING CRON FOR MONTH WISE
                            $ex_1 = explode('-',$this->input->post('cron_month_year'));
                            $ex_date = $ex_1[1].'-'.$ex_1[0].'-01';
                            $year_month = date('Ym',strtotime($ex_date));
                            // echo $year_month;exit;
                            
                            // echo $date."<br>";
                            
                            
                            //--------TRANSFER TABLE
                                $this->db->select("mxemp_trs_id,mxemp_parent_log_id,mxemp_trs_emp_code,mxemp_trs_joining_date,mxemp_trs_joining_date,mxemp_trs_emp_joining_date,mxemp_trs_comp_id_to,mxemp_trs_div_id_to,mxemp_trs_state_id_to,mxemp_trs_branch_id_to,mxemp_trs_dept_id_to");
                                $this->db->from("maxwell_emp_trasfers");
                                $this->db->where("mxemp_trs_joining_date",$year_month);
                                $this->db->where("mxemp_trs_emp_joining_date <=",date('Y-m-d'));
                                $this->db->where("mxemp_trs_type",'TRANSFERED');
                                $this->db->where("maxwell_emp_cron_status_flag",0);
                                // if($emp_code){//---.NEW BY SHABABU(19-08-2022)
                                //     $this->db->where("mxemp_trs_emp_code",$emp_code);
                                // }
                                $this->db->where("mxemp_trs_status",1);
                                $qry_trns = $this->db->get();
                                // echo $this->db->last_query();exit;
                                $trns_res = $qry_trns->result();
                                // print_r($trns_res);exit;
                                if(count($trns_res) > 0){
                                    // echo "hello";exit;
                                    foreach($trns_res as $trns_result){
                                        // print_r($trns_result);exit;
                                        $trns_id = $trns_result->mxemp_trs_id;
                                        $trns_parent_id = $trns_result->mxemp_parent_log_id;
                                        $trns_emp_cod = $trns_result->mxemp_trs_emp_code;
                                        $trns_join_date_ymd = $trns_result->mxemp_trs_emp_joining_date;
                                        $trns_join_date_ym = $trns_result->mxemp_trs_joining_date;
                                        if($trns_join_date_ymd <= date('Y-m-d')){
                                            // echo "hello123";exit;
                                            //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                            $transfer_update_master_array = array(
                                                                                'mxemp_emp_comp_code' => $trns_result->mxemp_trs_comp_id_to,
                                                                                'mxemp_emp_division_code' => $trns_result->mxemp_trs_div_id_to,
                                                                                'mxemp_emp_state_code' => $trns_result->mxemp_trs_state_id_to,
                                                                                'mxemp_emp_branch_code' => $trns_result->mxemp_trs_branch_id_to,
                                                                                'mxemp_emp_dept_code' => $trns_result->mxemp_trs_dept_id_to
                                                                            );
                                                                            // echo "<pre>";print_r($transfer_update_master_array);exit;
                                            $this->db->where('mxemp_emp_id',$trns_emp_cod);
                                            $res_master =  $this->db->update('maxwell_employees_info',$transfer_update_master_array);
                                            $updatedCount++;
                                            // echo $this->db->last_query();exit;
                                            //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                            // $res_master = true;
                                            if($res_master){
                                                # Update Authorisations
                                                // $prom_is_auth = $trns_result->mxemp_prm_is_authorisations;
                                                $this->update_authorisations($trns_parent_id,$trns_emp_cod);
                                                $updatedCount++;
                                                # UPDATING ATTENDANCE TABLE
                                                $update_attendance_array = array(
                                                    'mx_attendance_cmp_id' => $trns_result->mxemp_trs_comp_id_to,
                                                    'mx_attendance_division_id' => $trns_result->mxemp_trs_div_id_to,
                                                    'mx_attendance_state_id' => $trns_result->mxemp_trs_state_id_to,
                                                    'mx_attendance_branch_id' => $trns_result->mxemp_trs_branch_id_to
                                                );
                                                // print_r($update_attendance_array);exit;
                                                $this->update_emp_attendance($trns_join_date_ymd,$trns_emp_cod,$update_attendance_array);
                                                $updatedCount++;
                                                # END UPDATING ATTENDANCE TABLE
                                                
                                                //-------UPDATING CRON STATUS IN LOG TABLE
                                                $transfers_update_log_array = array(
                                                                                'mxtrns_prm_cron_status_flag' => 1
                                                                              );
                                                $this->db->where('mxtrns_prm_id',$trns_parent_id);
                                                $res_master =  $this->db->update('maxwell_emp_trans_prom_log',$transfers_update_log_array);
                                                $updatedCount++;
                                                //-------UPDATING CRON STATUS TO 1 in PROMOTION TABLE
                                                $transfers_update_array = array(
                                                                                'maxwell_emp_cron_status_flag' => 1
                                                                              );
                                                $this->db->where('mxemp_trs_id',$trns_id);
                                                $res_master =  $this->db->update('maxwell_emp_trasfers',$transfers_update_array);
                                                $updatedCount++;
                                                #END UPDATE CRON STATUS
                                            }
                                        }
                                    }
                                }else{
                                    $message = "No Transfers Found To Execute.......";
                                    getjsondata(0,$message);
                                }
                                
                            //--------END TRANSFER TABLE
                    
                        
                    }else{ //-------->EVERY DAY CRON RUNS
                        $year_month = date("Ym");
                        $day_year_month = date("Y-m-d");
                        
                        
                        //--------TRANSFER TABLE
                                $this->db->select("mxemp_trs_id,mxemp_parent_log_id,mxemp_trs_emp_code,mxemp_trs_joining_date,mxemp_trs_joining_date,mxemp_trs_emp_joining_date,mxemp_trs_comp_id_to,mxemp_trs_div_id_to,mxemp_trs_state_id_to,mxemp_trs_branch_id_to,mxemp_trs_dept_id_to");
                                $this->db->from("maxwell_emp_trasfers");
                                $this->db->where("mxemp_trs_emp_joining_date",$day_year_month);
                                $this->db->where("mxemp_trs_type",'TRANSFERED');
                                $this->db->where("maxwell_emp_cron_status_flag",0);
                                $this->db->where("mxemp_trs_status",1);
                                $qry_trns = $this->db->get();
                                // echo $this->db->last_query();exit;
                                $trns_res = $qry_trns->result();
                                if(count($trns_res) > 0){
                                    foreach($trns_res as $trns_result){
                                        // print_r($trns_result);exit;
                                        $trns_id = $trns_result->mxemp_trs_id;
                                        $trns_parent_id = $trns_result->mxemp_parent_log_id;
                                        $trns_emp_cod = $trns_result->mxemp_trs_emp_code;
                                        $trns_join_date_ymd = $trns_result->mxemp_trs_emp_joining_date;
                                        $trns_join_date_ym = $trns_result->mxemp_trs_joining_date;
                                        //----------UPDATING MASTER TABLE EMPLOYEE INFO
                                        $transfer_update_master_array = array(
                                                                            'mxemp_emp_comp_code' => $trns_result->mxemp_trs_comp_id_to,
                                                                            'mxemp_emp_division_code' => $trns_result->mxemp_trs_div_id_to,
                                                                            'mxemp_emp_state_code' => $trns_result->mxemp_trs_state_id_to,
                                                                            'mxemp_emp_branch_code' => $trns_result->mxemp_trs_branch_id_to,
                                                                            'mxemp_emp_dept_code' => $trns_result->mxemp_trs_dept_id_to
                                                                        );
                                        $this->db->where('mxemp_emp_id',$trns_emp_cod);
                                        $res_master =  $this->db->update('maxwell_employees_info',$transfer_update_master_array);
                                        $updatedCount++;
                                        //----------END UPDATING MASTER TABLE EMPLOYEE INFO
                                        // $res_master = true;
                                        if($res_master){
                                            # Update Authorisations
                                            // $prom_is_auth = $trns_result->mxemp_prm_is_authorisations;
                                            $this->update_authorisations($trns_parent_id,$trns_emp_cod);
                                            $updatedCount++;
                                            # UPDATING ATTENDANCE TABLE
                                            $update_attendance_array = array(
                                                'mx_attendance_cmp_id' => $trns_result->mxemp_trs_comp_id_to,
                                                'mx_attendance_division_id' => $trns_result->mxemp_trs_div_id_to,
                                                'mx_attendance_state_id' => $trns_result->mxemp_trs_state_id_to,
                                                'mx_attendance_branch_id' => $trns_result->mxemp_trs_branch_id_to
                                            );
                                            // print_r($update_attendance_array);exit;
                                            $this->update_emp_attendance($trns_join_date_ymd,$trns_emp_cod,$update_attendance_array);
                                            $updatedCount++;
                                            # END UPDATING ATTENDANCE TABLE
                                            
                                            //-------UPDATING CRON STATUS IN LOG TABLE
                                            $transfers_update_log_array = array(
                                                                            'mxtrns_prm_cron_status_flag' => 1
                                                                          );
                                            $this->db->where('mxtrns_prm_id',$trns_parent_id);
                                            $res_master =  $this->db->update('maxwell_emp_trans_prom_log',$transfers_update_log_array);
                                            $updatedCount++;
                                            //-------UPDATING CRON STATUS TO 1 in PROMOTION TABLE
                                            $transfers_update_array = array(
                                                                            'maxwell_emp_cron_status_flag' => 1
                                                                          );
                                            $this->db->where('mxemp_trs_id',$trns_id);
                                            $res_master =  $this->db->update('maxwell_emp_trasfers',$transfers_update_array);
                                            $updatedCount++;
                                            #END UPDATE CRON STATUS
                                        }
                                    }
                                }
                                
                            //--------END TRANSFER TABLE
                        
                        
                    }//echo $year_month;exit;
                    
                    
            }

            $array = array('name'=>'TRANSFER','Url' => 'https://maxwellhrms.in/cron/transfer_cron','cron_refrence_id' => 9);
            $res = $this->db->insert('cron_log',$array);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message = "Something Went Wrong........";
            $statuscode = 500;
            // getjsondata(0,$message);
        } else {
            $this->db->trans_commit();
            $message = "Successfully Executed The Cron........";
            $statuscode = 200;
            // getjsondata(1,$message);
        }

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $message,
        ];
        return $response;
    }
    
    //--------NEW BY SHABABU(20-03-2022)
    public function update_emp_attendance($join_date,$emp_code,$update_attendance_array){
        
        $ex_join_date = explode('-',$join_date);
                                        
        $year_join_transfer = $ex_join_date[0];
        $month_join_transfer = $ex_join_date[1];
        $date_join_transfer = $ex_join_date[2];
        
        
        # Months Loop                            
        for($month_tr = $month_join_transfer; $month_tr <= 12; $month_tr++){
            
            
            $month_tr  = (strlen($month_tr) == 1)?'0'.$month_tr:$month_tr;
            
            $days_in_a_month_tr = cal_days_in_month(CAL_GREGORIAN, $month_tr, $year_join_transfer); //---->Get no of days in a month
            $attendance_table = 'maxwell_attendance_'.$year_join_transfer.'_'.$month_tr;
            // echo $attendance_table .'<br>';exit;
            # DAYS LOOP
            // echo "date_join_transfer".$date_join_transfer;
            for($day_tr = $date_join_transfer; $day_tr <= $days_in_a_month_tr; $day_tr++){
                $day_tr = (strlen($day_tr) == 1)?'0'.$day_tr:$day_tr;
                $attendace_date = $year_join_transfer .'-'.$month_tr.'-'.$day_tr;
                // echo "---".$attendace_date;
                $this->db->where('mx_attendance_emp_code',$emp_code);
                $this->db->where('mx_attendance_date',$attendace_date);
                $this->db->update($attendance_table,$update_attendance_array);
            }
            # END DAYS LOOP
            $date_join_transfer = 1; //----FOR NEXT ITTERATION DAY MAKING AS 1;
            // echo "<------------------->";
        }
        # END Months Loop                            
                                        
    }
    //--------END NEW BY SHABABU(20-03-2022)
    
    public function update_authorisations($parent_id,$emp_code){
        $auth_array = array(
                        "mxauth_status"=>0,
                        "mxauth_modifyby"=>$this->session->userdata('user_id'),
                        "mxauth_modifiedtime"=>date('Y-m-d h:m:s'),
                        "mxauth_modified_ip"=>$_SERVER['REMOTE_ADDR']
                      );
        $this->db->where("mxauth_status",1);
        $this->db->where("mxauth_emp_code",$emp_code);
        $res = $this->db->update("maxwell_emp_authorsations",$auth_array);
        if($res){
            $auth_data_array = array(
                        "mxauth_status"=>1,
                        "mxauth_modifyby"=>$this->session->userdata('user_id'),
                        "mxauth_modifiedtime"=>date('Y-m-d h:m:s'),
                        "mxauth_modified_ip"=>$_SERVER['REMOTE_ADDR']
                      );
            $this->db->where("mxauth_parent_log_id",$parent_id);
            $this->db->where("mxauth_emp_code",$emp_code);
            $res_auth = $this->db->update("maxwell_emp_authorsations",$auth_data_array);
        }
    }
    
    // ------------------------ added 13-08-2021 -------------
    
    public function cronyearlist($data){
        $this->db->select('*');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->where('mxemp_leave_cron_processdate',$data);
        $this->db->where('mxemp_leave_cron_process_type','CRON-YEAR');
        $this->db->order_by('mxemp_leave_cron_id', 'desc');
        $query = $this->db->get();
        $crondata = $query->result();
        //echo $this->db->last_query(); die;
        return $crondata;    
    }

    public function year_end_corn($year,$printable){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $actual_link = 'https://maxwellhrms.in/cron/yearendcorn';
        $cron_refrence_id = 14;

        $this->db->select('mxemp_leave_cron_createdtime');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->where('mxemp_leave_cron_processdate',$year);
        $this->db->order_by('mxemp_leave_cron_id', 'desc');
        $query = $this->db->get();
        $crondata = $query->result();
        $crownnorows = $query->num_rows();
        if($crownnorows > 0 ){
            $desc = 'It seems that the year end cron has already been executed for the year '.$year.' on '.date('d-m-Y',strtotime($crondata[0]->mxemp_leave_cron_createdtime)).' at '.date('h:i:s A',strtotime($crondata[0]->mxemp_leave_cron_createdtime)).'. So, the cron is not executing again for the same year to avoid data duplication. If you want to execute the cron again for the same year, please contact your system administrator.';
            $response = [
                "status" => true,
                'statusCode' => 800,
                "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
                "message" => "Data Processed",
                'description' => $desc,
            ];
            return $response;
        }else{
            $currentdate = date('Y');
            $cronmonth = date('m');
            $cronday = date('d');
            $cronyear = date('Y');
            // $cronmonth = 4;
            // $cronday = 1;
        }
        $this->db->select('mxemp_leave_cron_createdtime');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->order_by('mxemp_leave_cron_id', 'desc');
        $this->db->limit(1);
        $query1 = $this->db->get();
        $crondata1 = $query1->result();
        
        $dbdateyear = date('Y' , strtotime($crondata1[0]->mxemp_leave_cron_createdtime));
        
        // $dbdateyear = '2020';
        // if( ($dbdateyear != $currentdate)  ){
        if(($cronmonth == 4) && ($cronday <= 10) && ($dbdateyear == $currentdate)){
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
            // echo $this->db->last_query(); 
            $this->db->trans_begin();
            foreach($cronyear as $cykey=>$cyear){
                // if( ($cyear->mxemp_emp_id == 'M00143') || ($cyear->mxemp_emp_id == 'M00144') ){
                    if($cyear->mxlass_is_carry_forward_year == 1 ){
                        if( $cyear->mxemp_leave_bal_crnt_bal > $cyear->mxlass_max_leaves_carry_forward ){
                           $carryfwdminus = $cyear->mxemp_leave_bal_crnt_bal - $cyear->mxlass_max_leaves_carry_forward;
                           $cuntbal= $cyear->mxlass_max_leaves_carry_forward;
                           $presentbal = $cyear->mxemp_leave_bal_crnt_bal;
                        }else{
                            $carryfwdminus=0.00;
                            $cuntbal = $cyear->mxemp_leave_bal_crnt_bal;
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
                                            $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                                        
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
                                            // echo '<pre>';
                                            // print_r($cornarraydet);
                                            // echo 'cndet';
                                            $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                                            $insertedCount++;
                                            // echo $this->db->last_query().'<br>';                      
                                            $mstleavebal = array(
                                                'mxemp_leave_bal_crnt_bal' =>$cuntbal,
                                                'mxemp_leave_bal_modifyby' => $this->session->userdata('user_id'),
                                                'mxemp_leave_bal_modifiedtime' => date('Y-m-d h:m:s'),
                                                'mxemp_leave_bal_modified_ip' => $ip
                                            );                                              
                                           $this->db->where('mxemp_leave_bal_emp_id', $cyear->mxemp_emp_id);  
                                           $this->db->where('mxemp_leave_bal_leave_type' , $cyear->mxlass_leave_type_id);            
                                           $this->db->update('maxwell_emp_leave_balance' , $mstleavebal);
                                           $updatedCount++;
            }
                                   
            if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $statuscode = 500;
                    $desc = 'There was an error while executing the year end cron for the year '.$year.'. The transaction has been rolled back to maintain data integrity. Please review the error logs and try executing the cron again. If the issue persists, please contact your system administrator for further assistance.';
            } else {
                    $this->db->trans_commit();
                    $statuscode = 200;
                    $desc = 'Year end cron executed successfully for the year '.$year.'. All the leave balances have been updated and carried forward as per the leave policy. Please review the leave balances and carry forward details in the leave balance section. If you have any questions or concerns regarding the year end cron execution, please contact your system administrator.';
            }

            $nametype = 'YEARLY_CARRY_FORWARD_CRON';
            $array = array('name'=>$nametype ,'Url' => $actual_link, 'cron_refrence_id' => $cron_refrence_id);
            $res = $this->db->insert('cron_log',$array);

            $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
    }else{
            $response = [
            "status" => true,
            'statusCode' => 700,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
    }
}

    // ------------------------- end added 13-08-2021 -----------
 
   /* public function attendance_cron($companyid,$attendancedate,$employeeid,$printable){
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();
        // rolback
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        // $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
        // $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
        $firsthalf_gracetime = '05';
        $secondhalf_gracetime = '05';

        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
        $this->db->select('mx_attendance_id,mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_first_half,mx_attendance_second_half');
        $this->db->from($tablename);
        $this->db->where('mx_attendance_cmp_id', $companyid);
        if($employeeid != ''){
        $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        $where = '(mx_attendance_first_half_punch != "" OR mx_attendance_second_half_punch != "")';
        $this->db->where($where);
        $this->db->where('mx_attendance_date', $attendancedate);
        $query1 = $this->db->get();

        if($query1->num_rows() > 0){
            $qry1 = $query1->result();
            $print_array = array();
            $skip = array('CL','EL','SL','SHRT','WO','PH','OPH','CMPL','AR');
            foreach ($qry1 as $key => $val) {
                
                if(!empty($val->mx_attendance_first_half_punch) && empty($val->mx_attendance_second_half_punch)){// Only First Punch
                    if(in_array($val->mx_attendance_first_half, $skip)){
                        if($printable == 'Y'){
                            array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                        }
                        continue;
                    }
                    $getallpunches = explode(',', $val->mx_attendance_first_half_punch);
                    if(count($getallpunches) > 1){ // Greater than one punch
                            $userfirstpunch = strtotime($getallpunches[0]);
                            $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                            $officestarttime = strtotime($officetime);
                            if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                                $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
                            }else{ // Employee late time take first punch
                                $userfirstpunch = $getallpunches[0];
                            }
                            $userlastpunch = $getallpunches[count($getallpunches) - 1];
                            $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                            if($totalhours >= 4){
                                $firsthalf = 'PR';
                            }else{
                                $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
                                $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                if($totalhoursgr >= 4){
                                    $firsthalf = 'PR';
                                    $farray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
                                }else{
                                    $firsthalf = 'AB';
                                }
                            }
                    }else{ // less than or equal to one punch here
                        $firsthalf = 'AB';
                    }   
                        $farray['mx_attendance_first_half'] = $firsthalf;
                        $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                        $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $resf = $this->db->update($tablename, $farray);
                        if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                        }
                }elseif(empty($val->mx_attendance_first_half_punch) && !empty($val->mx_attendance_second_half_punch)){ // Only Second Punch
                    if(in_array($val->mx_attendance_second_half, $skip)){
                        if($printable == 'Y'){
                            array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                        }
                        continue;
                    }
                    $punchtime = $val->mx_attendance_second_half_punch;
                    $getallpunches = explode(',', $punchtime);
                    if(count($getallpunches) > 1){
                        $userfirstpunch = strtotime($getallpunches[0]);
                        $officetime = $qry[0]->mxcp_secondhalf_time.':00';
                        $officestarttime = strtotime($officetime);
                        if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                            $userfirstpunch = $qry[0]->mxcp_secondhalf_time;
                        }else{ // Employee late time take first punch
                            $userfirstpunch = $getallpunches[0];
                        }
                        $userlastpunch = $getallpunches[count($getallpunches) - 1];
                        $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                        if($totalhours >= 4){
                            $secondhalf = 'PR';
                        }else{
                            $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
                            $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                            if($totalhoursgr >= 4){
                                $secondhalf = 'PR';
                                $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
                            }else{
                                $secondhalf = 'AB';
                            }
                        }
                    }else{
                        $secondhalf = 'AB';
                    }
                        $psarray['mx_attendance_second_half'] = $secondhalf;
                        $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                        $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $reps = $this->db->update($tablename, $psarray);
                        if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                        }
                }elseif(!empty($val->mx_attendance_first_half_punch) && !empty($val->mx_attendance_second_half_punch)){ // First and Second Punch
                        $punchtime = $val->mx_attendance_first_half_punch .','.$val->mx_attendance_second_half_punch;
                        $getallpunches = explode(',', $punchtime);
                        $userfirstpunch = strtotime($getallpunches[0]);
                        $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                        $officestarttime = strtotime($officetime);
                        if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                            $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
                        }else{ // Employee late time take first punch
                            $userfirstpunch = $getallpunches[0];
                        }
                        $userlastpunch = strtotime($getallpunches[count($getallpunches) - 1]);
                        $officeend = $qry[0]->mxcp_logoff_time.':00';
                        $officeendtime = strtotime($officeend);
                            if($officeendtime <= $userlastpunch){ // Checking The Employee Last Punch Ontime Or Overtime
                            // Check For First Half Punch
                            $breakstarttime = $qry[0]->mxcp_secondbreak_time.':00';
                            $officestarttime = $qry[0]->mxcp_firsthalf_time.':00';
                            if (strtotime($userfirstpunch) <= strtotime($breakstarttime) && strtotime($userfirstpunch) >= strtotime($officestarttime)){ // Checking The First Punch Should Be In First Half Or Not
                                $userlastpunch = $breakstarttime;
                                $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                if($totalhours >= 4){
                                    $firsthalf = 'PR';
                                }else{
                                    // $firsthalf = 'AB';
                                    $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
                                    $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                    if($totalhoursgr >= 4){
                                        $firsthalf = 'PR';
                                        $parray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
                                    }else{
                                        $firsthalf = 'AB';
                                    }
                                }
                            }
                            // Check For First Half Punch
                            // Check For The Second Half Punch 
                            $breakendtime = $qry[0]->mxcp_secondbreak_endtime;
                            $userlastpunch = $getallpunches[count($getallpunches) - 1];
                            if(strtotime($userfirstpunch) <= strtotime($breakendtime) && strtotime($userlastpunch) >= $officeendtime){
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                                if($officeendtime < strtotime($userlastpunch)){ 
                                    $userlastpunch = $qry[0]->mxcp_logoff_time.':00';
                                    $userfirstpunch = $qry[0]->mxcp_secondhalf_time.':00';
                                    $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                    if($totalhours >= 4){
                                        $secondhalf = 'PR';
                                    }else{
                                        $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
                                        $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                        if($totalhoursgr >= 4){
                                            $secondhalf = 'PR';
                                            $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
                                        }else{
                                            $secondhalf = 'AB';
                                        }
                                    }
                                }
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                            }
                            // Check For The Second Half Punch
                            if($firsthalf == 'AB' || $firsthalf == 'PR'){
                                $parray['mx_attendance_first_half'] = $firsthalf;

                            }
                            if($secondhalf == 'AB' || $secondhalf == 'PR'){
                                $parray['mx_attendance_second_half'] = $secondhalf;
                            }


                            if(in_array($val->mx_attendance_first_half, $skip)){
                                if($printable == 'Y'){
                                    array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }
                                unset($parray['mx_attendance_first_half']);
                                $fsk = "C";
                                //continue;
                            }

                            if(in_array($val->mx_attendance_second_half, $skip)){
                                if($printable == 'Y'){
                                    array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }
                                unset($parray['mx_attendance_second_half']);
                                $ssk = "C";
                                //continue;
                            }

                            if($ssk == 'C' && $fsk == 'C'){
                                continue;
                            }
                            $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                            $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                            $this->db->where("mx_attendance_date", $attendancedate);
                            $ress = $this->db->update($tablename, $parray);
                            if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                            }
                        }else{
                          // Need to add first half present in this case if employee want to leave after the office grean than the breakend time

                            // Start of First Half Section
                            $punchtime = $val->mx_attendance_first_half_punch;
                            $getallpunches = explode(',', $punchtime);
                            $userfirstpunch = $getallpunches[0];

                            $punchtime2 = $val->mx_attendance_second_half_punch;
                            $getallpunches2 = explode(',', $punchtime2);
                            $userlastpunch = $getallpunches2[count($getallpunches2) - 1];

                            $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                            $gracetime = "+".$firsthalf_gracetime." minutes";
                            $officesttime = strtotime($officetime);
                            $officestarttime = date("H:i:s", strtotime($gracetime, $officesttime));
                            $officeopentime = $officestarttime;

                            if(strtotime($officeopentime) >= strtotime($userfirstpunch)){
                                $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                if($totalhours >= 4){
                                    $firsthalf = 'PR';
                                }else{
                                    $firsthalf = 'AB';
                                }    
                            }else{
                                $firsthalf = 'AB';
                            }
                            if(in_array($val->mx_attendance_first_half, $skip)){
                                if($printable == 'Y'){
                                    array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }
                            }else{
                                $pfsarray['mx_attendance_first_half'] = $firsthalf; 
                                $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                                $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                                $this->db->where("mx_attendance_date", $attendancedate);
                                $ress = $this->db->update($tablename, $pfsarray);
                                if($printable == 'Y'){
                                    array_push($print_array,$this->db->last_query());
                                }                                  
                            }
                            // End of First Half Section
                            // Second Half Section Starts
                            $breakendtime = $qry[0]->mxcp_secondbreak_endtime;
                            $punchtime = $val->mx_attendance_first_half_punch .','.$val->mx_attendance_second_half_punch;
                            $getallpunches = explode(',', $punchtime);
                            $userlastpunch = $getallpunches[count($getallpunches) - 1];

                            $secondofficetime = $qry[0]->mxcp_secondhalf_time.':00';
                            $secondgraceadd = "+".$secondhalf_gracetime." minutes";
                            $seconfhalf_officetime = strtotime($secondofficetime);
                            $secondhalf_offcie_start = date("H:i:s", strtotime($secondgraceadd, $seconfhalf_officetime));


                        $officeend = $qry[0]->mxcp_logoff_time.':00';
                        $officeendtime = strtotime($officeend);
                            if(strtotime($userfirstpunch) <= strtotime($secondhalf_offcie_start) && strtotime($userlastpunch) <= $officeendtime){
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                                if($officeendtime > strtotime($userlastpunch)){ 
                                    if(strtotime($userfirstpunch) <= strtotime($secondofficetime)){ // Employee on time take office starting hour
                                        $userfirstpunch = $qry[0]->mxcp_secondhalf_time.':00';
                                    }else{ // Employee late time take first punch
                                        $userfirstpunch = $getallpunches[0];
                                    }
                                    $userlastpunch = $getallpunches[count($getallpunches) - 1];

                                    $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                    if($totalhours >= 4){
                                        $secondhalf = 'PR';
                                    }else{
                                        $secondhalf = 'AB';
                                    }
                                }else{
                                    $secondhalf = 'AB';
                                }
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                            }else{
                                $secondhalf = 'AB';
                            }

                            if(in_array($val->mx_attendance_second_half, $skip)){
                                if($printable == 'Y'){
                                    array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }
                            }else{
                                $pfsrarray['mx_attendance_second_half'] = $secondhalf; 
                                $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                                $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                                $this->db->where("mx_attendance_date", $attendancedate);
                                $ress = $this->db->update($tablename, $pfsrarray);
                                if($printable == 'Y'){
                                    array_push($print_array,$this->db->last_query());
                                }                                  
                            }
                            // End of Second Half Section Starts


                        }
                }
                
            } // foreachloopends here
                if($printable == 'Y'){
                    return $print_array;
                }
        }else{
            return 'No Modifications Found For - ' . $attendancedate;
        }

    }
*/

    public function attendance_cron($companyid,$attendancedate,$employeeid,$printable){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime,mxcp_firsthalf_gracetime,mxcp_secondhalf_gracetime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();
        // rolback
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
        $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
        
        // $firsthalf_gracetime = '05';
        // $secondhalf_gracetime = '05';
        
        // echo $firsthalf_gracetime; echo '<br>';
        //  echo $secondhalf_gracetime; echo '<br>';exit;

        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
        $this->db->select('mx_attendance_id,mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_first_half,mx_attendance_second_half');
        $this->db->from($tablename);
        $this->db->where('mx_attendance_cmp_id', $companyid);
        if($employeeid != ''){
        $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        $where = '(mx_attendance_first_half_punch != "" OR mx_attendance_second_half_punch != "")';
        $this->db->where($where);
        $this->db->where('mx_attendance_date', $attendancedate);
        $query1 = $this->db->get();

        if($query1->num_rows() > 0){
            $qry1 = $query1->result();
            $print_array = array();
            $skip = array('CL','EL','SL','SHRT','WO','PH','OPH','CMPL','AR','OD','LTD');
            foreach ($qry1 as $key => $val) {
                
                if(!empty($val->mx_attendance_first_half_punch) && empty($val->mx_attendance_second_half_punch)){// Only First Punch
                    if(in_array($val->mx_attendance_first_half, $skip)){
                        if($printable == 'Y'){
                            $desc = array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                        }else{
                            $desc = array($val->mx_attendance_second_half,$skip);
                        }
                        #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                        continue;
                    }
                    $getallpunches = explode(',', $val->mx_attendance_first_half_punch);
                    if(count($getallpunches) > 1){ // Greater than one punch
                            $userfirstpunch = strtotime(getMin($getallpunches));
                            $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                            $officestarttime = strtotime($officetime);
                            if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                                $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
                            }else{ // Employee late time take first punch
                                $userfirstpunch = getMin($getallpunches);
                            }
                            $userlastpunch = getMax($getallpunches);
                            $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                            if($totalhours >= 4){
                                $firsthalf = 'PR';
                            }else{
                                $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
                                $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                if($totalhoursgr >= 4){
                                    $firsthalf = 'PR';
                                    $farray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
                                }else{
                                    $firsthalf = 'AB';
                                }
                            }
                    }else{ // less than or equal to one punch here
                        $firsthalf = 'AB';
                    }   
                        $farray['mx_attendance_first_half'] = $firsthalf;
                        $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                        $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $resf = $this->db->update($tablename, $farray);
                        $updatedCount++;
                        if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                        }
                       # crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$ress,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                }elseif(empty($val->mx_attendance_first_half_punch) && !empty($val->mx_attendance_second_half_punch)){ // Only Second Punch
                    if(in_array($val->mx_attendance_second_half, $skip)){
                        if($printable == 'Y'){
                           $desc =  array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                        }else{
                            $desc = array($val->mx_attendance_second_half,$skip);
                        }
                        #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                        continue;
                    }
                    $punchtime = $val->mx_attendance_second_half_punch;
                    $getallpunches = explode(',', $punchtime);
                    if(count($getallpunches) > 1){
                        $userfirstpunch = strtotime(getMin($getallpunches));
                        $officetime = $qry[0]->mxcp_secondhalf_time.':00';
                        $officestarttime = strtotime($officetime);
                        if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                            $userfirstpunch = $qry[0]->mxcp_secondhalf_time;
                        }else{ // Employee late time take first punch
                            $userfirstpunch = getMin($getallpunches);
                        }
                        $userlastpunch = getMax($getallpunches);
                        $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                        if($totalhours >= 4){
                            $secondhalf = 'PR';
                        }else{
                            $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
                            $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                            if($totalhoursgr >= 4){
                                $secondhalf = 'PR';
                                $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
                            }else{
                                $secondhalf = 'AB';
                            }
                        }
                    }else{
                        $secondhalf = 'AB';
                    }
                        $psarray['mx_attendance_second_half'] = $secondhalf;
                        $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                        $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $reps = $this->db->update($tablename, $psarray);
                        $updatedCount++;
                        if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                        }
                        #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$ress,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                }elseif(!empty($val->mx_attendance_first_half_punch) && !empty($val->mx_attendance_second_half_punch)){ // First and Second Punch
                $ssk = '';  $fsk = '';
                        $punchtime = $val->mx_attendance_first_half_punch .','.$val->mx_attendance_second_half_punch;
                        $getallpunches = explode(',', $punchtime);
                        $userfirstpunch = strtotime(getMin($getallpunches));
                        $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                        $officestarttime = strtotime($officetime);
                        if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
                            $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
                        }else{ // Employee late time take first punch
                            $userfirstpunch = getMin($getallpunches);
                        }
                        $userlastpunch = strtotime(getMax($getallpunches));
                        $officeend = $qry[0]->mxcp_logoff_time.':00';
                        $officeendtime = strtotime($officeend);
                            if($officeendtime <= $userlastpunch){ // Checking The Employee Last Punch Ontime Or Overtime
                            // Check For First Half Punch
                            $breakstarttime = $qry[0]->mxcp_secondbreak_time.':00';
                            $officestarttime = $qry[0]->mxcp_firsthalf_time.':00';
                            if (strtotime($userfirstpunch) <= strtotime($breakstarttime) && strtotime($userfirstpunch) >= strtotime($officestarttime)){ // Checking The First Punch Should Be In First Half Or Not
                                $userlastpunch = $breakstarttime;
                                $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                if($totalhours >= 4){
                                    $firsthalf = 'PR';
                                }else{
                                    // $firsthalf = 'AB';
                                    $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
                                    $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                    if($totalhoursgr >= 4){
                                        $firsthalf = 'PR';
                                        $parray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
                                    }else{
                                        $firsthalf = 'AB';
                                    }
                                }
                            }
                            // Check For First Half Punch
                            // Check For The Second Half Punch 
                            $breakendtime = $qry[0]->mxcp_secondbreak_endtime;
                            $userlastpunch = getMax($getallpunches);
                            if(strtotime($userfirstpunch) <= strtotime($breakendtime) && strtotime($userlastpunch) >= $officeendtime){
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                                if($officeendtime < strtotime($userlastpunch)){ 
                                    $userlastpunch = $qry[0]->mxcp_logoff_time.':00';
                                    $userfirstpunch = $qry[0]->mxcp_secondhalf_time.':00';
                                    $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                    if($totalhours >= 4){
                                        $secondhalf = 'PR';
                                    }else{
                                        $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
                                        $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
                                        if($totalhoursgr >= 4){
                                            $secondhalf = 'PR';
                                            $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
                                        }else{
                                            $secondhalf = 'AB';
                                        }
                                    }
                                }
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                            }
                            // Check For The Second Half Punch
                            if($firsthalf == 'AB' || $firsthalf == 'PR'){
                                $parray['mx_attendance_first_half'] = $firsthalf;

                            }
                            if($secondhalf == 'AB' || $secondhalf == 'PR'){
                                $parray['mx_attendance_second_half'] = $secondhalf;
                            }


                            if(in_array($val->mx_attendance_first_half, $skip)){
                                if($printable == 'Y'){
                                    $desc = array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }else{
                                    $desc = array($val->mx_attendance_first_half,$skip);
                                }
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                                unset($parray['mx_attendance_first_half']);
                                $fsk = "C";
                                //continue;
                            }

                            if(in_array($val->mx_attendance_second_half, $skip)){
                                if($printable == 'Y'){
                                    $desc = array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }else{
                                    $desc = array($val->mx_attendance_second_half,$skip);
                                }
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                                unset($parray['mx_attendance_second_half']);
                                $ssk = "C";
                                //continue;
                            }

                            if($ssk == 'C' && $fsk == 'C'){
                                continue;
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON','Skipped',$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                            }
                            $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                            $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                            $this->db->where("mx_attendance_date", $attendancedate);
                            $ress = $this->db->update($tablename, $parray);
                            $updatedCount++;
                            if($printable == 'Y'){
                            array_push($print_array,$this->db->last_query());
                            }
                            #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$ress,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                        }else{
                          // Need to add first half present in this case if employee want to leave after the office grean than the breakend time

                            // Start of First Half Section
                            $punchtime = $val->mx_attendance_first_half_punch;
                            $getallpunches = explode(',', $punchtime);
                            $userfirstpunch = getMin($getallpunches);

                            $punchtime2 = $val->mx_attendance_second_half_punch;
                            $getallpunches2 = explode(',', $punchtime2);
                            $userlastpunch = getMax($getallpunches2);

                            $officetime = $qry[0]->mxcp_firsthalf_time.':00';
                            $gracetime = "+".$firsthalf_gracetime." minutes";
                            $officesttime = strtotime($officetime);
                            $officestarttime = date("H:i:s", strtotime($gracetime, $officesttime));
                            $officeopentime = $officestarttime;

                            if(strtotime($officeopentime) >= strtotime($userfirstpunch)){
                                $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                if($totalhours >= 4){
                                    $firsthalf = 'PR';
                                }else{
                                    $firsthalf = 'AB';
                                }    
                            }else{
                                $firsthalf = 'AB';
                            }
                            if(in_array($val->mx_attendance_first_half, $skip)){
                                if($printable == 'Y'){
                                    $desc = array_push($print_array,"Skiped First Half Due To Leave Addjustment of <span style='color:red'> " . $val->mx_attendance_first_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }else{
                                    $desc = array($val->mx_attendance_first_half,$skip);
                                }
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                            }else{
                                $pfsarray['mx_attendance_first_half'] = $firsthalf; 
                                $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                                $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                                $this->db->where("mx_attendance_date", $attendancedate);
                                $ress = $this->db->update($tablename, $pfsarray);
                                $updatedCount++;
                                if($printable == 'Y'){
                                    array_push($print_array,$this->db->last_query());
                                }
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$ress,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                            }
                            // End of First Half Section
                            // Second Half Section Starts
                            $breakendtime = $qry[0]->mxcp_secondbreak_endtime;
                            $punchtime = $val->mx_attendance_first_half_punch .','.$val->mx_attendance_second_half_punch;
                            $getallpunches = explode(',', $punchtime);
                            $userlastpunch = getMax($getallpunches);

                            $secondofficetime = $qry[0]->mxcp_secondhalf_time.':00';
                            $secondgraceadd = "+".$secondhalf_gracetime." minutes";
                            $seconfhalf_officetime = strtotime($secondofficetime);
                            $secondhalf_offcie_start = date("H:i:s", strtotime($secondgraceadd, $seconfhalf_officetime));


                        $officeend = $qry[0]->mxcp_logoff_time.':00';
                        $officeendtime = strtotime($officeend);
                            if(strtotime($userfirstpunch) <= strtotime($secondhalf_offcie_start) && strtotime($userlastpunch) <= $officeendtime){
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                                if($officeendtime > strtotime($userlastpunch)){ 
                                    if(strtotime($userfirstpunch) <= strtotime($secondofficetime)){ // Employee on time take office starting hour
                                        $userfirstpunch = $qry[0]->mxcp_secondhalf_time.':00';
                                    }else{ // Employee late time take first punch
                                        $userfirstpunch = getMin($getallpunches);
                                    }
                                    $userlastpunch = getMax($getallpunches);

                                    $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
                                    if($totalhours >= 4){
                                        $secondhalf = 'PR';
                                    }else{
                                        $secondhalf = 'AB';
                                    }
                                }else{
                                    $secondhalf = 'AB';
                                }
                                // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
                            }else{
                                $secondhalf = 'AB';
                            }

                            if(in_array($val->mx_attendance_second_half, $skip)){
                                if($printable == 'Y'){
                                    $desc = array_push($print_array,"Skiped Second Half Due To Leave Addjustment of <span style='color:red'> = " . $val->mx_attendance_second_half . "</span> <span style='color:red'>For Attendance Date</span> =" .$attendancedate." <span style='color:red'>For Employee Code</span> =" . $val->mx_attendance_emp_code);
                                }else{
                                    $desc = array($val->mx_attendance_second_half,$skip);
                                }
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                            }else{
                                $pfsrarray['mx_attendance_second_half'] = $secondhalf; 
                                $this->db->where("mx_attendance_id", $val->mx_attendance_id);
                                $this->db->where("mx_attendance_emp_code", $val->mx_attendance_emp_code);
                                $this->db->where("mx_attendance_date", $attendancedate);
                                $ress = $this->db->update($tablename, $pfsrarray);
                                if($printable == 'Y'){
                                    array_push($print_array,$this->db->last_query());
                                }                                  
                                #crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$ress,$this->db->last_query(),$ress,(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
                            }
                            // End of Second Half Section Starts


                        }
                }
                
            } // foreachloopends here
                if($printable == 'Y'){
                    $array = array('name'=>'ATTENDANCE CRON MANUAL','Url' => 'https://maxwellhrms.in/cron/attendance_cron','cron_refrence_id' => 3);
                    $res = $this->db->insert('cron_log',$array);
                    // return $print_array;
                }else{
                    $array = array('name'=>'ATTENDANCE','Url' => 'https://maxwellhrms.in/cron/attendance_cron','cron_refrence_id' => 3);
                    $res = $this->db->insert('cron_log',$array);
                }
                
        }else{
            $desc = 'No Modifications Found For - ' . $attendancedate;
            crons_log($val->mx_attendance_emp_code,'ATTENDANCE CRON',$desc,$this->db->last_query(),'NO Modification Found',(isset($_SESSION['user_id'])) ? $this->session->userdata('user_id') : '',$attendancedate);
        }

        $response = [
            "status" => true,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
    }

    public function calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate){
        $firstpunch = $attendancedate.' '.$userfirstpunch;
        $lastpunch = $attendancedate.' '.$userlastpunch;
        // $d1 = strtotime($firstpunch);
        // $d2 = strtotime($lastpunch);
        // $totalSecondsDiff = abs($d1-$d2); //42600225
        // $totalMinutesDiff = $totalSecondsDiff/60; //710003.75
        // $totalHoursDiff   = $totalSecondsDiff/60/60;//11833.39
        // $totalDaysDiff    = $totalSecondsDiff/60/60/24; //493.05
        // $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30; //16.43
        // $totalYearsDiff   = $totalSecondsDiff/60/60/24/365; //1.35  
        // return abs($totalHoursDiff);
        $d1 = new DateTime($firstpunch);
        $d2 = new DateTime($lastpunch);
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1
        return $diffInHours;
    }
    
    public function grace_calculator($gracetime,$userfirstpunch){
        $grace=$gracetime;
         $gracetime = "-".$grace." minutes";
         $userfirstpunch = strtotime($userfirstpunch);
        return $finaltime= date("H:i:s", strtotime($gracetime, $userfirstpunch));
    } 
    
        // ----------------------  added 09-04-2022 ------------
    public function ohcronmodel($leavetypeid,$userdate=0,$printable){

        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $actual_link = '';
        $cron_refrence_id = '';

        $date = date('Y-m-d');
        $yearmnt = date('Y');
        $yearmnt =$yearmnt.'_00';  // to apply only year yearly collapse cron is running so that appended 00 for year
        $createddate = date('Y-m-d H:i:s');
        $ip = $this->get_client_ip();
        if($leavetypeid == 4 ){
            $actual_link = 'https://maxwellhrms.in/cron/ohcronmodel';
            $cron_refrence_id = 15;
            $shrtleanm = ' OH';
        }else if($leavetypeid == 12 ){
            $actual_link = 'https://maxwellhrms.in/cron/ochcronmodel';
            $cron_refrence_id = 16;
            $shrtleanm =' OCH';
        }
        $this->db->trans_begin();

        $this->db->select("(select mxlt_leave_short_name from maxwell_leave_type_master where mxlt_id = $leavetypeid and mxlt_status=1 ) as leavetypeSN, 
                            mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_type as emptype,mxemp_emp_id as EmployeeID,mxemp_leave_bal_leave_type_shrt_name as leavetypeSN ");
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_emp_leave_balance','mxemp_emp_id = mxemp_leave_bal_emp_id', 'INNER');
        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->where('mxemp_leave_bal_leave_type',$leavetypeid);
        $this->db->group_by('EmployeeID');
        $query1 = $this->db->get();
        $crownro = $query1->num_rows();
        $leavedata = $query1->result();
        // echo $this->db->last_query();  exit; 
        // --------------------- cron table ---------------------
        $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_leavetype');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->where('mxemp_leave_cron_processdate' , $yearmnt);
        $this->db->where('mxemp_leave_cron_leavetype' , $leavetypeid);
        $query1 = $this->db->get();
        $crownro = $query1->num_rows();
        $crondata = $query1->result();

        // ---------------------- End cron table --------------

        // ---------------------- assignment table query-----------

        $this->db->select('mxlass_emp_type_id,mxlass_leave_type_id,mxlass_min_leaves,mxlass_apply_min_leave_days');
        $this->db->from('maxwell_leave_assigning_master');
        $this->db->where('mxlass_status' , 1 );
        $this->db->where('mxlass_leave_type_id ',$leavetypeid);
        $query2 = $this->db->get();
        // echo $this->db->last_query(); die;
        $assignmastcount = $query2->num_rows();
        $assignmast = $query2->result();
        // -------------- attendanct table -------end 
        $new = array();
        foreach($crondata as $key => $val){ 
            array_push($new,$val->mxemp_leave_cron_emp_id);
        }  
        // print_r($new);exit;
        foreach($leavedata as $key => $ltdt){  
            if(!in_array($ltdt->EmployeeID , $new)){                     
                foreach($assignmast as $kay1=>$assval){
                    if($assval->mxlass_emp_type_id == $ltdt->emptype && $assval->mxlass_leave_type_id == $leavetypeid ){
                        $cornarraydata = array(
                            'mxemp_leave_cron_comp_id'=> $ltdt->mxemp_emp_comp_code,
                            'mxemp_leave_cron_division_id' => $ltdt->mxemp_emp_division_code,
                            'mxemp_leave_cron_emp_id' => $ltdt->EmployeeID,
                            'mxemp_leave_cron_leavetype' => $assval->mxlass_leave_type_id, 
                            'mxemp_leave_cron_short_name' => $ltdt->leavetypeSN,
                            'mxemp_leave_cron_previous_bal' =>0,
                            'mxemp_leave_cron_present_adding' =>$assval->mxlass_min_leaves,
                            'mxemp_leave_cron_crnt_bal' => $assval->mxlass_min_leaves,
                            'mxemp_leave_cron_process_type' => 'CRON',
                            'mxemp_leave_cron_entry_type' =>'',
                            'mxemp_leave_cron_processdate' => $yearmnt,
                            'mxemp_leave_cron_createdby' => $this->session->userdata('user_id'),
                            'mxemp_leave_cron_createdtime' => $createddate,
                            'mxemp_leave_cron_created_ip' => $ip
                        );
                       $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                        // echo $this->db->last_query() .'<br>';
                        // print_r($cornarraydata);
                        $cornarraydet = array(
                            'mxemp_leave_history_comp_id'=> $ltdt->mxemp_emp_comp_code,
                            'mxemp_leave_history_division_id' => $ltdt->mxemp_emp_division_code,
                            'mxemp_leave_history_emp_id' => $ltdt->EmployeeID,
                            'mxemp_leave_history_leavetype' => $assval->mxlass_leave_type_id, 
                            'mxemp_leave_history_short_name' => $ltdt->leavetypeSN,
                            'mxemp_leave_histroy_previous_bal' =>0,
                            'mxemp_leave_histroy_present_adding' =>$assval->mxlass_min_leaves,
                            'mxemp_leave_history_crnt_bal' => $assval->mxlass_min_leaves,
                            'mxemp_leave_history_process_type' => 'CRON',
                            'mxemp_leave_history_processdate' => $yearmnt,
                            'mxemp_leave_history_createdby' =>$this->session->userdata('user_id'),
                            'mxemp_leave_history_createdtime' =>$createddate,
                            'mxemp_leave_history_created_ip' => $ip
                        );
                        $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                        $insertedCount++;
                        // echo $this->db->last_query().'<br>';                      
                        // print_r($cornarraydet);
                        $mstleavebal = array(
                            'mxemp_leave_bal_crnt_bal' =>$assval->mxlass_min_leaves,
                            'mxemp_leave_bal_modifyby' => $this->session->userdata('user_id'),
                            'mxemp_leave_bal_modifiedtime' =>$createddate,
                            'mxemp_leave_bal_modified_ip' => $ip
                        );  
                        $this->db->where('mxemp_leave_bal_emp_id', $ltdt->EmployeeID);  
                        $this->db->where('mxemp_leave_bal_leave_type', $leavetypeid );            
                        $this->db->update('maxwell_emp_leave_balance',$mstleavebal);   
                        $updatedCount++;
                        // print_r($mstleavebal); 
                    } 
                }
            } 
        }  // exit;

        $nametype = $shrtleanm;
        $array = array('name'=>$nametype ,'Url' => $actual_link, 'cron_refrence_id' => $cron_refrence_id);
        $res = $this->db->insert('cron_log',$array);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $statuscode = 500;
            $desc = 'Data Not Processed';
        } else {
            $this->db->trans_commit();
            $statuscode = 200;
            $desc = 'Data Processed';
        }

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
                
        
    }
    // -------------------- end added 09-04-2022 -----------

   public function notification_datesupdate(){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $cdate = date('Y-m-d');
        $reminder = config('notification_months');
        $ids = array('13','14');
        $this->db->select("mx_ntf_followup_date,mx_ntf_cron_status,mx_ntf_id,mx_ntf_ym,mx_ntf_hearing_date");
        $this->db->from('maxwell_legal_notifications');
        $this->db->where('mx_ntf_status', '1');
        $this->db->where('mx_ntf_notallow_cron != 1');
        $this->db->where_in('mx_ntf_ym',$ids);
        $query1 = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry = $query1->result();
        foreach($qry as $key => $val){
            if(empty($val->mx_ntf_followup_date) || $val->mx_ntf_followup_date == '0000-00-00'){
                if(date('Ymd',$val->mx_ntf_hearing_date) > date('Ymd')){
                    if($val->mx_ntf_ym == 13){
                        $date = DateTime::createFromFormat('d', $reminder[0]->notification_months)->add(new DateInterval('P1M'));
                        $next_followup_date = $date->format('Y-m-d');
                        $uparray = array(
                            "mx_ntf_followup_date" => $next_followup_date,
                            "mx_ntf_cron_status" => date('Ym')
                            );
                        $this->db->where('mx_ntf_id', $val->mx_ntf_id );            
                        $this->db->update('maxwell_legal_notifications',$uparray);
                        $updatedCount++;  
                    }elseif($val->mx_ntf_ym == 14){
                        $date = DateTime::createFromFormat('d', $reminder[0]->notification_months)->add(new DateInterval('P1Y'));
                        $next_followup_date = $date->format('Y-m-d');
                        $uparray = array(
                            "mx_ntf_followup_date" => $next_followup_date,
                            "mx_ntf_cron_status" => date('Ym')
                            );
                        $this->db->where('mx_ntf_id', $val->mx_ntf_id );            
                        $this->db->update('maxwell_legal_notifications',$uparray);
                        $updatedCount++;    
                    }
                }
            }else{
                if(date('Ymd',$val->mx_ntf_followup_date) > date('Ymd')){
                    if($val->mx_ntf_ym == 13){
                        $date = DateTime::createFromFormat('d', $reminder[0]->notification_months)->add(new DateInterval('P1M'));
                        $next_followup_date = $date->format('Y-m-d');
                        $uparray = array(
                            "mx_ntf_followup_date" => $next_followup_date,
                            "mx_ntf_cron_status" => date('Ym')
                            );
                        $this->db->where('mx_ntf_id', $val->mx_ntf_id );            
                        $this->db->update('maxwell_legal_notifications',$uparray);
                        $updatedCount++;  
                    }elseif($val->mx_ntf_ym == 14){
                        $date = DateTime::createFromFormat('d', $reminder[0]->notification_months)->add(new DateInterval('P1Y'));
                        $next_followup_date = $date->format('Y-m-d');
                        $uparray = array(
                            "mx_ntf_followup_date" => $next_followup_date,
                            "mx_ntf_cron_status" => date('Ym')
                            );
                        $this->db->where('mx_ntf_id', $val->mx_ntf_id );            
                        $this->db->update('maxwell_legal_notifications',$uparray);
                        $updatedCount++;    
                    }
                }else{
                    $desc = 'No follow updates found';
                }
                
            }
        }
        $nametype = 'ADMIN NOTIFICATIONS';
        $actual_link ="https://maxwellhrms.in/cron/notification_datesupdate";
        $array = array('name'=> $nametype,'Url' => $actual_link,'cron_refrence_id' => 8);
        $res = $this->db->insert('cron_log',$array);
        $response = [
            "status" => true,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
   } 
   
   public function SHRTcronmodel($leavetypeid,$userdate,$printable){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $desc = '';
        $actual_link = 'https://maxwellhrms.in/cron/SHRTcronmodel';
        $cron_refrence_id = 13;
        $shrtleanm = 'SHRT';

        if($userdate != 0 ){
             $date = date('Y-m-d',strtotime($userdate));
             $yearmnt = date('Y_m',strtotime($date));        
        }else{
            $date = date('Y-m-d');
            $yearmnt = date('Y_m');
        }  
        $createddate = date('Y-m-d H:i:s');
   
        $ip = $this->get_client_ip();
        $this->db->trans_begin();
        
        // ---------------------    cron table     ---------------------
       
        $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_leavetype');
        $this->db->from('maxwell_emp_leave_cron_history');
        $this->db->where('mxemp_leave_cron_processdate ' , $yearmnt);
        $this->db->where('mxemp_leave_cron_leavetype ' , $leavetypeid);
        $query1 = $this->db->get();
        $crownro = $query1->num_rows();
        $crondata = $query1->result();
        // echo $this->db->last_query();  die;
        $new = array();
        foreach($crondata as $key => $val){ 
            array_push($new,$val->mxemp_leave_cron_emp_id);
        }
         
        // ---------------------- End cron table --------------
        // and mxemp_leave_bal_crnt_bal !='1.00'
        $sql1 = "SELECT mxemp_leave_bal_id,mxemp_leave_bal_emp_id,mxemp_leave_bal_leave_type_shrt_name,
                 mxemp_emp_comp_code,mxemp_emp_division_code  FROM maxwell_emp_leave_balance 
                 inner join maxwell_employees_info on mxemp_emp_id = mxemp_leave_bal_emp_id
                 where mxemp_leave_bal_leave_type =  $leavetypeid  ";
        $query1 = $this->db->query($sql1);
        $count1= count($query1->row());
        if($count1 > 0){
            $qry1 = $query1->result(); 
            foreach($qry1 as $key => $val){
                if(!in_array($val->mxemp_leave_bal_emp_id , $new)){
                    // $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_leavetype');
                    // $this->db->from('maxwell_emp_leave_cron_history');
                    // $this->db->where('mxemp_leave_cron_processdate ' , $yearmnt);
                    // $this->db->where('mxemp_leave_cron_leavetype ' , $leavetypeid);
                    // $this->db->where('mxemp_leave_cron_emp_id', $val->mxemp_leave_bal_emp_id);
                    // $query1 = $this->db->get();
                    // $crownro = $query1->num_rows();
                    // $crondata = $query1->result();  
                    // if($crownro <= 0){
                        $mstleavebal = array("mxemp_leave_bal_crnt_bal" => 2);
                        $this->db->where('mxemp_leave_bal_emp_id', $val->mxemp_leave_bal_emp_id);  
                        $this->db->where('mxemp_leave_bal_leave_type', $leavetypeid );            
                        $this->db->update('maxwell_emp_leave_balance',$mstleavebal); 
                        // print_r($mstleavebal);
                            $cornarraydata = array(
                                'mxemp_leave_cron_comp_id'=> $val->mxemp_emp_comp_code,
                                'mxemp_leave_cron_division_id' => $val->mxemp_emp_division_code,
                                'mxemp_leave_cron_emp_id' => $val->mxemp_leave_bal_emp_id,
                                'mxemp_leave_cron_leavetype' => $leavetypeid, 
                                'mxemp_leave_cron_short_name' => $val->mxemp_leave_bal_leave_type_shrt_name,
                                'mxemp_leave_cron_previous_bal' =>0,
                                'mxemp_leave_cron_present_adding' =>2,
                                'mxemp_leave_cron_crnt_bal' => 2,
                                'mxemp_leave_cron_process_type' => 'CRON',
                                'mxemp_leave_cron_entry_type' =>'',
                                'mxemp_leave_cron_processdate' => $yearmnt,
                                'mxemp_leave_cron_createdby' => $this->session->userdata('user_id'),
                                'mxemp_leave_cron_createdtime' => $createddate,
                                'mxemp_leave_cron_created_ip' => $ip
                            );
                          $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                             // echo $this->db->last_query() .'<br>';
                            // print_r($cornarraydata);
                        
                            $cornarraydet = array(
                                'mxemp_leave_history_comp_id'=> $val->mxemp_emp_comp_code,
                                'mxemp_leave_history_division_id' => $val->mxemp_emp_division_code,
                                'mxemp_leave_history_emp_id' => $val->mxemp_leave_bal_emp_id,
                                'mxemp_leave_history_leavetype' =>$leavetypeid, 
                                'mxemp_leave_history_short_name' =>  $val->mxemp_leave_bal_leave_type_shrt_name,
                                'mxemp_leave_histroy_previous_bal' =>0,
                                'mxemp_leave_histroy_present_adding' =>2,
                                'mxemp_leave_history_crnt_bal' => 2,
                                'mxemp_leave_history_process_type' => 'CRON',
                                'mxemp_leave_history_processdate' => $yearmnt,
                                'mxemp_leave_history_createdby' =>$this->session->userdata('user_id'),
                                'mxemp_leave_history_createdtime' =>$createddate,
                                'mxemp_leave_history_created_ip' => $ip
                            );
                            $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                            // print_r($cornarraydet);
                            $insertedCount++;
                    }
            }
        }else{
            echo 'No one found may be upto date updated'; exit;
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $statuscode = 500;
            $desc = 'Data Not Processed for SHRT Leave Type';
        } else {
            $this->db->trans_commit();
            $statuscode = 200;
            $desc = 'Data Processed for SHRT Leave Type';
        }
            $nametype = $shrtleanm;
            $array = array('name'=>$nametype ,'Url' => $actual_link, 'cron_refrence_id' => $cron_refrence_id);
            $res = $this->db->insert('cron_log',$array);

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $desc,
        ];
        return $response;
   }
    
  
  /* 
   public function SHRTcronmodel($leavetypeid,$userdate,$printable){
        if($userdate != 0 ){
             $date = date('Y-m-d',strtotime($userdate));
             $yearmnt = date('Y_m',strtotime($date));        
        }else{
             $date = date('Y-m-d');
             $yearmnt = date('Y_m');
        }  
        $createddate = date('Y-m-d H:i:s');
   
        $ip = $this->get_client_ip();
        
        $sql1 = "SELECT mxemp_leave_bal_id,mxemp_leave_bal_emp_id,mxemp_leave_bal_leave_type_shrt_name FROM maxwell_emp_leave_balance where mxemp_leave_bal_leave_type ='11' and mxemp_leave_bal_crnt_bal !='1.00'";
        $query1 = $this->db->query($sql1);
        $count1= count($query1->row());
        if($count1 > 0){
            $qry1 = $query1->result(); 
            foreach($qry1 as $key => $val){
                $this->db->select('mxemp_leave_cron_emp_id,mxemp_leave_cron_leavetype');
                $this->db->from('maxwell_emp_leave_cron_history');
                $this->db->where('mxemp_leave_cron_processdate ' , $yearmnt);
                $this->db->where('mxemp_leave_cron_leavetype ' , $leavetypeid);
                $this->db->where('mxemp_leave_cron_emp_id', $val->mxemp_leave_bal_emp_id);
                $query1 = $this->db->get();
                $crownro = $query1->num_rows();
                $crondata = $query1->result();  
                if($crownro <= 0){
                    $mstleavebal = array("mxemp_leave_bal_crnt_bal" => '1');
                    $this->db->where('mxemp_leave_bal_emp_id', $val->mxemp_leave_bal_emp_id);  
                    $this->db->where('mxemp_leave_bal_leave_type', $leavetypeid );            
                    $this->db->update('maxwell_emp_leave_balance',$mstleavebal); 
                    
                    //     $cornarraydata = array(
                    //         'mxemp_leave_cron_comp_id'=> $ltdt->mxemp_emp_comp_code,
                    //         'mxemp_leave_cron_division_id' => $ltdt->mxemp_emp_division_code,
                    //         'mxemp_leave_cron_emp_id' => $ltdt->EmployeeID,
                    //         'mxemp_leave_cron_leavetype' => $assval->mxlass_leave_type_id, 
                    //         'mxemp_leave_cron_short_name' => $ltdt->leavetypeSN,
                    //         'mxemp_leave_cron_previous_bal' =>0,
                    //         'mxemp_leave_cron_present_adding' =>$assval->mxlass_min_leaves,
                    //         'mxemp_leave_cron_crnt_bal' => $assval->mxlass_min_leaves,
                    //         'mxemp_leave_cron_process_type' => 'CRON',
                    //         'mxemp_leave_cron_entry_type' =>'',
                    //         'mxemp_leave_cron_processdate' => $yearmnt,
                    //         'mxemp_leave_cron_createdby' => $this->session->userdata('user_id'),
                    //         'mxemp_leave_cron_createdtime' => $createddate,
                    //         'mxemp_leave_cron_created_ip' => $ip
                    //     );
                    //   $this->db->insert('maxwell_emp_leave_cron_history',$cornarraydata);
                    //     // echo $this->db->last_query() .'<br>';
                    //     // print_r($cornarraydata);
                    
                    //     $cornarraydet = array(
                    //         'mxemp_leave_history_comp_id'=> $ltdt->mxemp_emp_comp_code,
                    //         'mxemp_leave_history_division_id' => $ltdt->mxemp_emp_division_code,
                    //         'mxemp_leave_history_emp_id' => $ltdt->EmployeeID,
                    //         'mxemp_leave_history_leavetype' => $assval->mxlass_leave_type_id, 
                    //         'mxemp_leave_history_short_name' => $ltdt->leavetypeSN,
                    //         'mxemp_leave_histroy_previous_bal' =>0,
                    //         'mxemp_leave_histroy_present_adding' =>$assval->mxlass_min_leaves,
                    //         'mxemp_leave_history_crnt_bal' => $assval->mxlass_min_leaves,
                    //         'mxemp_leave_history_process_type' => 'CRON',
                    //         'mxemp_leave_history_processdate' => $yearmnt,
                    //         'mxemp_leave_history_createdby' =>$this->session->userdata('user_id'),
                    //         'mxemp_leave_history_createdtime' =>$createddate,
                    //         'mxemp_leave_history_created_ip' => $ip
                    //     );
                    //     $this->db->insert('maxwell_emp_leave_detailed_history',$cornarraydet);
                }
            }
        }else{
            echo 'No one found may be upto date updated';
        } 

   }
   */
    public function latecomming_details(){
        $cdate = date('Y-m-d');
        $year = date('Y');
        $this->db->select('employee_code as Employee_Code,mxemp_emp_fname as Employee_Name,mxcp_name as Company,mxd_name as Division,mxb_name as Branch,mxst_state as State,attendance_date as Attendance_Date,attendance_time as Punch_Time,entry_type,location,latitudes,longitudes,mxcp_firsthalf_gracetime as firstHalfGraceTime,mxcp_secondhalf_gracetime as secondHalfGraceTime'); 
        $this->db->from('employee_punches_'.$year);
        $this->db->join('maxwell_employees_info', 'employee_code = mxemp_emp_id', 'INNER');
        $this->db->join('maxwell_company_master', 'mxcp_id = company', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = division', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = state', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = branch', 'INNER');
        $this->db->where('attendance_date', $cdate);
        $this->db->where('attendance_time >', '09:40:00');
        $query = $this->db->get();
        $qry = $query->result_array();
        $reportname = 'latecomming_'.DBD;
        // HRD@MAXWELLPACKERS.COM
        $maildata = array('to'=>'developerhkumar@gmail.com','bcc' => '','templates' =>'','subject' => 'this is testing subject','mdesc' => 'HI Please Find the information');
        $fileinfo = array('sheetname' => $reportname,'folderpath' => 'uploads/latecomming/');
        // if(count($db) > 0 && !empty($db)){
        $sendmail = true;
        dynamicexcel($qry,$maildata,$fileinfo,$sendmail,$type = 'cron');
        $nametype =  'CRON LATE PUNCH';
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $array = array('name'=> $nametype,'Url' => $actual_link);
        $res = $this->db->insert('cron_log',$array);
        // }
    }
    
    public function leave_cron_accept(){
        $cdate = date('Y-m-d');
        $year = date('Y');
        if($cdate == $year.'-03-31'){
            $this->db->trans_begin();
            $this->db->select('mxar_id as mxid,mxar_final_accept_status,mxar_status,mxar_category_type as category_type,
                               mxar_comp_id as companyid,mxar_div_id as divisionid ,
                               mxar_appliedby_emp_code as employeeid,mxar_noofdays as noleavedays,
                               mxar_from as from,mxar_to as to,mxar_desc as desc,mxar_authfinal_status as authfinal,
                               mxar_leavetypeid as leavetypeid,mxar_leave_type as leavetypename');
            $this->db->from('attendance_user_leaveadjust');
            $this->db->where('mxar_status',1);
            // $this->db->where('mxar_id', $uniqid);
            // $this->db->where('mxar_appliedby_emp_code', 'M00143');
            $this->db->where('mxar_final_accept_status', 9);
            $this->db->order_by("mxar_id", "desc");
            $query = $this->db->get();
            $res = $query->result_array();
        //     echo '<pre>';
        //   print_r($res); exit;
        
        foreach($res as $keyleave =>$keyval){
            
            $this->db->select('mxar_previous_bal as previous_bal,mxar_current_bal as current_bal,');
            $this->db->from('attendance_user_leaveadjust_log');
            $this->db->where('mxar_leaveadjust_unique_id', $keyval['mxid']);
            $this->db->where('mxar_appliedby_emp_code', $keyval['employeeid']);
            $this->db->order_by("mxar_id", "desc");
            $this->db->limit(1);
            $query= $this->db->get();
            $result1 = $query->result();
                        
                if(($keyval['noleavedays'] >= 1) && ($keyval['category_type'] == 3)){
                    $leadimain = array(
                                        "mxar_hrfinal_accept"=>'888666',
                                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                                        "mxar_hrfinal_acceptcreatedby"=>'888666',
                                        "mxar_hrfinal_acceptname"=>'Cron',
                                        // "mxar_authfinal_remarks"=>$remarks,
                                        "mxar_final_accept_status"=>3,
                                        "mxar_authfinal_status"=>1,
                                        "mxar_authfinal_createdby"=>'888666',
                                        "mxar_authfinal_createdtime"=>date('Y-m-d H:i:s'),
                                        "mxar_emp_modifyby" =>'888666',
                                        "mxar_emp_modifiedtime" => date('Y-m-d H:i:s'),
                                        "mxar_authfinal_deviceid"=>''
                                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $keyval['mxid']);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    // print_r('$leadimain');
                    // print_r($leadimain);
                    
                    $cldata = array(
                            'mxemp_leave_history_comp_id'=> $keyval['companyid'],
                            'mxemp_leave_history_division_id' => $keyval['divisionid'],
                            'mxemp_leave_history_emp_id' => $keyval['employeeid'],
                            'mxemp_leave_history_leavetype' => $keyval['leavetypeid'], 
                            'mxemp_leave_history_short_name' => $keyval['leavetypename'],
                            'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                            'mxemp_leave_history_processdate' => $keyval['from'] .'-'. $keyval['to'],
                            'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                            'mxemp_leave_histroy_present_minus' => $keyval['noleavedays'],
                            'mxemp_leave_history_process_type' => 'Cron',
                            'mxemp_leave_history_createdby' => '888666',
                            'mxemp_leave_history_createdtime' => date('Y-m-d H:i:s')
                            // 'mxemp_leave_history_created_ip' => $ip
                        );
                    $resdethist = $this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    // print_r('$cldata');
                    // print_r($cldata);
                    
                    $days=$keyval['noleavedays'];
                    $dateymd = date('Y-m-d',strtotime($keyval['from']));
                    $dateym = date('Y_m',strtotime($keyval['from']));
                            
                    for($i=1;$i<=$days;$i++){
                        $this->db->select('mx_attendance_id as attenduniqueid');
                        $this->db->from('maxwell_attendance_'.$dateym);
                        $this->db->where('mx_attendance_emp_code', $keyval['employeeid']);
                        $this->db->where('mx_attendance_date', $dateymd);
                        $query= $this->db->get();
                        $result2 = $query->result();
        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $keyval['leavetypename'],
                            "mx_attendance_second_half" => $keyval['leavetypename']
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$keyval['employeeid']);
                        $resattend = $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
        // print_r('$cluparray1');
        // print_r($cluparray1);
        
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $keyval['companyid'],
                            'mxemp_leave_adjust_division_id' => $keyval['divisionid'],
                            'mxemp_leave_adjust_emp_id' => $keyval['employeeid'],
                            'mxemp_leave_adjust_first_half_id' => $keyval['leavetypeid'], 
                            'mxemp_leave_adjust_first_half_short_name' => $keyval['leavetypename'],
                            'mxemp_leave_adjust_first_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $keyval['leavetypeid'],
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'Cronfirsthalf',
                            'mxemp_leave_adjust_createdby' => '888666',
                            'mxemp_leave_adjust_createdtime' => date('Y-m-d H:i:s'),
                            'mxar_leave_unique_id'=>$keyval['mxid']
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
        
                        // print_r('$resrollbck');
                        // print_r($resrollbck);
        
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $keyval['companyid'],
                                'mxemp_leave_adjust_division_id' => $keyval['divisionid'],
                                'mxemp_leave_adjust_emp_id' => $keyval['employeeid'],
                                'mxemp_leave_adjust_second_half_id' => $keyval['leavetypeid'], 
                                'mxemp_leave_adjust_second_half_short_name' => $keyval['leavetypename'],
                                'mxemp_leave_adjust_second_half_minus' => 0.5,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $keyval['leavetypeid'],
                                'mxemp_leave_adjust_present_minus' => 0.5,
                                'mxemp_leave_adjust_process_type' => 'Mobilesecondhalf',
                                'mxemp_leave_adjust_createdby' => '888666',
                                'mxemp_leave_adjust_createdtime' => date('Y-m-d H:i:s'),
                                'mxar_leave_unique_id'=>$keyval['mxid']
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $ressecrollbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
                        
                        // print_r('$secondhalf');
                        // print_r($secondhalf);
                        
                        $repeat = strtotime("+1 day",strtotime($dateymd));
                        $dateymd = date('Y-m-d',$repeat);
                    }
                
                }elseif( $keyval['noleavedays'] == 0.5){
                    $leadimain = array(
                                        
                                        "mxar_hrfinal_accept"=>'888666',
                                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                                        "mxar_hrfinal_acceptcreatedby"=>'888666',
                                        "mxar_hrfinal_acceptname"=>'Cron',
                                        // "mxar_authfinal_remarks"=>$remarks,
                                        "mxar_final_accept_status"=>3,
                                        "mxar_authfinal_status"=>1,
                                        "mxar_authfinal_createdby"=>'888666',
                                        "mxar_authfinal_createdtime"=>date('Y-m-d H:i:s'),
                                        "mxar_emp_modifyby" =>'888666',
                                        "mxar_emp_modifiedtime" => date('Y-m-d H:i:s'),
                                        "mxar_authfinal_deviceid"=>''
                                        
                                    );  // 3 accept, 2 reject , 1 acceptby auth hr 
                    $this->db->where('mxar_id', $keyval['mxid']);
                    $resleadimain = $this->db->update('attendance_user_leaveadjust', $leadimain);
                    // print_r('$leadimain');
                    // print_r($leadimain);
                    
                    $cldata = array(
                        'mxemp_leave_history_comp_id'=> $keyval['companyid'],
                        'mxemp_leave_history_division_id' => $keyval['divisionid'],
                        'mxemp_leave_history_emp_id' => $keyval['employeeid'],
                        'mxemp_leave_history_leavetype' => $keyval['leavetypeid'], 
                        'mxemp_leave_history_short_name' => $keyval['leavetypename'],
                        'mxemp_leave_histroy_previous_bal' => $result1[0]->previous_bal,
                        'mxemp_leave_history_processdate' => $keyval['from'] .'-'. $keyval['to'],
                        'mxemp_leave_history_crnt_bal' => $result1[0]->current_bal,
                        'mxemp_leave_histroy_present_minus' => $keyval['noleavedays'],
                        'mxemp_leave_history_process_type' => 'CronApi',
                        'mxemp_leave_history_createdby' => $keyval['employeeid'],
                        'mxemp_leave_history_createdtime' =>date('Y-m-d H:i:s')
                        // 'mxemp_leave_history_created_ip' => $ip
                    );
                    $resdethis=$this->db->insert('maxwell_emp_leave_detailed_history',$cldata);
                    // print_r('$cldata');
                    // print_r($cldata);
                
                    $dateymd = date('Y-m-d',strtotime($keyval['from']));
                    $dateym = date('Y_m',strtotime($keyval['from']));
                                                
                    $this->db->select('mx_attendance_id as attenduniqueid');
                    $this->db->from('maxwell_attendance_'.$dateym);
                    $this->db->where('mx_attendance_emp_code', $keyval['employeeid']);
                    $this->db->where('mx_attendance_date', $dateymd);
                    $query= $this->db->get();
                    $result2 = $query->result();
            
                    if($keyval['category_type'] == 1){
                        $firsthalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid,
                            'mxemp_leave_adjust_comp_id' => $keyval['companyid'],
                            'mxemp_leave_adjust_division_id' => $keyval['divisionid'],
                            'mxemp_leave_adjust_emp_id' => $keyval['employeeid'],
                            'mxemp_leave_adjust_first_half_id' => $keyval['leavetypeid'], 
                            'mxemp_leave_adjust_first_half_short_name' => $keyval['leavetypename'],
                            'mxemp_leave_adjust_first_half_minus' => 0.5,
                            'mxemp_leave_adjust_attendance_date' => $dateymd,
                            'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                            'mxemp_leave_adjust_leavetype' => $keyval['leavetypeid'],
                            'mxemp_leave_adjust_present_minus' => 0.5,
                            'mxemp_leave_adjust_process_type' => 'Cronfirsthalf',
                            'mxemp_leave_adjust_createdby' => '888666',
                            'mxemp_leave_adjust_createdtime' => date('Y-m-d H:i:s'),
                            'mxar_leave_unique_id'=>$keyval['mxid']
                            // 'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck = $this->db->insert('maxwell_emp_leave_adjust_rollback',$firsthalf);
                        // print_r('$firsthalf');
                        // print_r($firsthalf);
                        
                        $cluparray1 = array(
                            "mx_attendance_first_half" => $keyval['leavetypename'],
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$keyval['employeeid']);
                        $resfrstatt= $this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                    // print_r('$cluparray1');
                    // print_r($cluparray1);
                        
                    }elseif($keyval['category_type'] == 2){
                        $secondhalf= array( 'Mxemp_leave_adjust_attend_id' => $result2[0]->attenduniqueid, 
                                'mxemp_leave_adjust_comp_id' => $keyval['companyid'],
                                'mxemp_leave_adjust_division_id' => $keyval['divisionid'],
                                'mxemp_leave_adjust_emp_id' => $keyval['employeeid'],
                                'mxemp_leave_adjust_second_half_id' => $keyval['leavetypeid'], 
                                'mxemp_leave_adjust_second_half_short_name' => $keyval['leavetypename'],
                                'mxemp_leave_adjust_second_half_minus' => 0.5,
                                'mxemp_leave_adjust_attendance_date' => $dateymd,
                                'mxemp_leave_adjust_attendance_monthyear'=> $dateym,
                                'mxemp_leave_adjust_leavetype' => $keyval['leavetypeid'],
                                'mxemp_leave_adjust_present_minus' => 0.5,
                                'mxemp_leave_adjust_process_type' => 'Cronsecondhalf',
                                'mxemp_leave_adjust_createdby' => '888666',
                                'mxemp_leave_adjust_createdtime' => date('Y-m-d H:i:s'),
                                'mxar_leave_unique_id'=>$keyval['mxid']
                            //  'mxemp_leave_adjust_created_ip' => $ip
                            );
                        $resrllbck=$this->db->insert('maxwell_emp_leave_adjust_rollback',$secondhalf);
            // print_r('$secondhalf');
            // print_r($secondhalf);
                        $cluparray1 = array(
                            "mx_attendance_second_half" => $keyval['leavetypename']
                        );
                        $this->db->where('mx_attendance_id',$result2[0]->attenduniqueid);
                        $this->db->where('mx_attendance_emp_code',$keyval['employeeid']);
                        $resfrstatt =$this->db->update('maxwell_attendance_'.$dateym, $cluparray1);
                        //   print_r('$cluparray1');
                        //   print_r($cluparray1);
                    }
                }
                        
        }
    }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            // create_notes('888666','3','Failed To Accept Leave Cron' ,'888666');
            return 500;
        } else {
            $this->db->trans_commit();
                // create_notes('888666','3','Leave Cron Accepted Successfully' ,'888666');
                return 200;
        }

        
    }
    
    public function update_resign_status($postData){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;
        $empid = '';
        // print_r($postData);exit;
        $fromDate = $postData['fromDate'];
        $toDate = $postData['toDate'];
        // $date = date('Y-m-d');
        // $minusoneday = date('Y-m-d', strtotime('-1 days', strtotime($date)));
        $this->db->select("mxemp_emp_id");
        $this->db->from("maxwell_employees_info");
        $this->db->where('DATE_FORMAT(mxemp_emp_resignation_relieving_date,"%Y-%m-%d") >= ', $fromDate);
        $this->db->where('DATE_FORMAT(mxemp_emp_resignation_relieving_date,"%Y-%m-%d") <= ', $toDate);
        $this->db->where("mxemp_emp_resignation_status != 'R'");
        if(!empty($empid)){
            $this->db->where("mxemp_emp_id",$empid);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $rel_empid = $query->result();
        if(!empty($rel_empid)){
            foreach($rel_empid as $rkey=>$rval){
                $empid = $rval->mxemp_emp_id;
                $resign_status_array = array("mxemp_emp_resignation_status" => 'R');
                $this->db->where('mxemp_emp_resignation_status !=', 'R');  
                $this->db->where('mxemp_emp_id', $empid);            
                $res = $this->db->update('maxwell_employees_info',$resign_status_array); 
                $updatedCount++;
            }
        }
        if($res){
            // echo "success";
            $nametype = 'RESIGN STATUS UPDATE';
            $array = array('name'=> $nametype,'Url' => 'https://maxwellhrms.in/cron/update_resign_status','cron_refrence_id' => 11);
            $res = $this->db->insert('cron_log',$array);
            $message = "Successfully executed";
            // getjsondata(1,$message);
        }else{
            $message =  "No Resign Employees Found from ".$fromDate ." to ".$toDate."To Update";
            // getjsondata(0,$message);
        }

        $response = [
            "status" => true,
            'statusCode' => $statuscode,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed",
            'description' => $message,
        ];
        return $response;
    }
    
    public function lastmonthleavesappiledsummary(){
        $qrlm ="select mxar_appliedby_emp_code AS employeecode,mxemp_emp_fname as name, mxar_leave_type AS leave_type, SUM(CASE WHEN mxar_final_accept_status = 9 THEN mxar_noofdays ELSE 0 END) AS pending, SUM(CASE WHEN mxar_final_accept_status = 3 THEN mxar_noofdays ELSE 0 END) AS hrapproved, SUM(CASE WHEN mxar_final_accept_status = 1 THEN mxar_noofdays ELSE 0 END) AS approved, SUM(CASE WHEN mxar_final_accept_status = 2 THEN mxar_noofdays ELSE 0 END) AS rejected,SUM(mxar_noofdays) AS total_days from attendance_user_leaveadjust inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id where DATE_FORMAT(mxar_from, '%Y-%m') = DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m') and DATE_FORMAT(mxar_to, '%Y-%m') = DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m') and mxar_status =1 GROUP BY mxar_appliedby_emp_code, mxar_leave_type order by mxar_createdtime desc";
        $querylm = $this->db->query($qrlm);
        $qry = $querylm->result_array();
            
        $reportname = date('F_Y', strtotime('-1 months')).'_Leaves';
        $mailbody = 'Leave Applications Closed For '. date('F Y', strtotime('-1 months'));
        $maildata = array('to'=>'hrd@maxwellpackers.com,sbd.hr@maxwellpackers.com','cc' =>'developerhkumar@gmail.com','bcc' => '','templates' =>'','subject' => $reportname,'mdesc' => $mailbody);
        $fileinfo = array('sheetname' => $reportname,'folderpath' => 'uploads/monthlyleaves/');
        if(count($qry) > 0 && !empty($qry)){
        $sendmail = true;
        dynamicexcel($qry,$maildata,$fileinfo,$sendmail,$type = 'cron');
        $nametype =  'Monthly Leaves Applied';
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $array = array('name'=> $nametype,'Url' => $actual_link);
        $res = $this->db->insert('cron_log',$array);
        }
    }
    
    public function lastmonthregulationsappiledsummary(){
        $qrlm ="select  mxar_appliedby_emp_code AS employeecode,mxemp_emp_fname as name, mxar_type AS type, SUM(CASE WHEN mxar_authfinal_status = 9 THEN mxar_attend_countdays ELSE 0 END) AS pending, SUM(CASE WHEN mxar_authfinal_status = 3 THEN mxar_attend_countdays ELSE 0 END) AS revert, SUM(CASE WHEN mxar_authfinal_status = 1 THEN mxar_attend_countdays ELSE 0 END) AS approved, SUM(CASE WHEN mxar_authfinal_status = 2 THEN mxar_attend_countdays ELSE 0 END) AS rejected, SUM(mxar_attend_countdays) AS total_days from attendance_regulation inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id where DATE_FORMAT(mxar_from, '%Y-%m') = DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m') and DATE_FORMAT(mxar_to, '%Y-%m') = DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m') and mxar_status =1 GROUP BY mxar_appliedby_emp_code, mxar_type order by mxar_createdtime desc";
        $querylm = $this->db->query($qrlm);
        $qry = $querylm->result_array();
            
        $reportname = date('F_Y', strtotime('-1 months')).'_Regulations';
        $mailbody = 'Attendance Regulation Applications Closed For '. date('F Y', strtotime('-1 months'));
        $maildata = array('to'=>'hrd@maxwellpackers.com,sbd.hr@maxwellpackers.com','cc' =>'developerhkumar@gmail.com','bcc' => '','templates' =>'','subject' => $reportname,'mdesc' => $mailbody);
        $fileinfo = array('sheetname' => $reportname,'folderpath' => 'uploads/monthlyregulations/');
        if(count($qry) > 0 && !empty($qry)){
            // print_r($qry); exit;
        $sendmail = true;
        dynamicexcel($qry,$maildata,$fileinfo,$sendmail,$type = 'cron');
        $nametype =  'Monthly Attendance Regulation';
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $array = array('name'=> $nametype,'Url' => $actual_link);
        $res = $this->db->insert('cron_log',$array);
        }
    }
    
    public function essl_attendance_cron($attendancedate,$employeeid){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;

        $countofessldata = 0;
        $companyid = 1;
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        
        $fromdt = $attendancedate . ' 00:00:00';
        $todt   = $attendancedate . ' 23:59:59';
        
        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
        
        $this->db->trans_begin();
        $this->db->select('id,employeecode,punchdatetime,punch,punchtype,deviceid,inserted_at,synced,synceddatetime');
        $this->db->from('essl_attendance_logs');
        $this->db->where('punchdatetime >=', $fromdt);
        $this->db->where('punchdatetime <=', $todt);
        $this->db->where('synced', 0);
        // $this->db->where('employeecode', 'M0009');
        $this->db->order_by('employeecode ASC, punchdatetime ASC');
        
        $query = $this->db->get();
        $eslqr = $query->result();
        // echo $this->db->last_query(); exit;
        if (!empty($eslqr)) {
            
            $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime,mxcp_firsthalf_gracetime,mxcp_secondhalf_gracetime');
            $this->db->from('maxwell_company_master');
            $this->db->where('mxcp_status = 1');
            $this->db->where('mxcp_id',$companyid);
            $querycmp = $this->db->get();
            $qry = $querycmp->result();
            $countofessldata = count($eslqr);
            
            foreach($eslqr as $row){
                
                $currenttime = date('H:i', strtotime($row->punchdatetime));
                $currenttimeseconds = date('H:i:s', strtotime($row->punchdatetime));
                $entrytype = ($row->punchtype .' - '. $row->punch);
                $employeeid = $row->employeecode;
                $attendancedate = date('Y-m-d', strtotime($row->punchdatetime));
                $takeyear = date('Y',strtotime($attendancedate));
                
                $this->db->select('mx_attendance_id,mx_attendance_cmp_id,mx_attendance_division_id,mx_attendance_state_id,mx_attendance_branch_id,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type');
                $this->db->from($tablename);
                $this->db->where('mx_attendance_date', $attendancedate);
                $this->db->where('mx_attendance_emp_code', $employeeid);
                $queryatt = $this->db->get();
                $attqr = $queryatt->result();
                
                foreach($attqr as $attrow){

                    $attendance_uniqid = $attrow->mx_attendance_id;
                    
                    if(strtotime($currenttime) <= strtotime($qry[0]->mxcp_firsthalf_time) || strtotime($currenttime) <= strtotime($qry[0]->mxcp_secondbreak_time)){
                        
                        if(empty($attrow->mx_attendance_first_half_punch)){
                            $punchtime = $currenttimeseconds;
                            $type = $entrytype;
                        }else{
                            $punchtime = $attrow->mx_attendance_first_half_punch .','. $currenttimeseconds;
                            $type = ','. $entrytype;
                        }
                        $entry_type = $attrow->mx_attendance_entry_type . $type .'-'. $currenttimeseconds;
                        
                        $uparray = array("mx_attendance_first_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type);
                        // echo '<pre>';print_r($uparray); echo $row->id;
                        
                        $this->db->where("mx_attendance_id", $attendance_uniqid);
                        $this->db->where("mx_attendance_emp_code", $employeeid);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $res = $this->db->update($tablename, $uparray);
                        
                        $log = array(
                          'employee_code' => $employeeid,
                          'attendance_date' => $attendancedate,
                          'attendance_uniqid' => $attendance_uniqid,
                          'attendance_time' => $currenttimeseconds,
                          'company' => $attrow->mx_attendance_cmp_id,
                          'division' => $attrow->mx_attendance_division_id,
                          'state' => $attrow->mx_attendance_state_id,
                          'branch' => $attrow->mx_attendance_branch_id,
                          'entry_type' => $entrytype,
                          'createdby' => 'AUTO',
                          'createdtime' => DBDT,
                        );
                        
                        $punclogtable = 'employee_punches_'. $takeyear . '';
                        $this->db->insert($punclogtable, $log);
                        $insertedCount++;

                        $esslup = array("synced" => 1, "synceddatetime" => DBDT);
                        $this->db->where("id", $row->id);
                        $res = $this->db->update('essl_attendance_logs', $esslup);
                        $updatedCount++;
                        create_notes($employeeid,'1','Punch Has Been Registered Type- '.$entrytype.' Punch Time- '.$currenttime ,$employeeid);

                        
                    }elseif(strtotime($currenttime) > strtotime($qry[0]->mxcp_secondbreak_time) || strtotime($currenttime) >= strtotime($qry[0]->mxcp_secondhalf_time)){
                        
                        if(empty($attrow->mx_attendance_second_half_punch)){
                        $punchtime = $currenttimeseconds;
                            if(empty($attrow->mx_attendance_entry_type)){
                                $type = $entrytype;
                            }else{
                                $type = ','. $entrytype;
                            }
                        }else{
                            $punchtime = $attrow->mx_attendance_second_half_punch .','. $currenttimeseconds;
                            $type = ','. $entrytype;
                        }
                        $entry_type = $attrow->mx_attendance_entry_type .$type.'-'. $currenttimeseconds;
                        
                        $fparray = array("mx_attendance_second_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type);
                        // echo '<pre>';print_r($fparray); echo $row->id;
                        
                        $this->db->where("mx_attendance_id", $attendance_uniqid);
                        $this->db->where("mx_attendance_emp_code", $employeeid);
                        $this->db->where("mx_attendance_date", $attendancedate);
                        $res = $this->db->update($tablename, $fparray);
                        $updatedCount++;
                        $log = array(
                          'employee_code' => $employeeid,
                          'attendance_date' => $attendancedate,
                          'attendance_uniqid' => $attendance_uniqid,
                          'attendance_time' => $currenttimeseconds,
                          'company' => $attrow->mx_attendance_cmp_id,
                          'division' => $attrow->mx_attendance_division_id,
                          'state' => $attrow->mx_attendance_state_id,
                          'branch' => $attrow->mx_attendance_branch_id,
                          'entry_type' => $entrytype,
                          'createdby' => 'AUTO',
                          'createdtime' => DBDT,
                        );
                        
                        $punclogtable = 'employee_punches_'. $takeyear . '';
                        $this->db->insert($punclogtable, $log);
                        $insertedCount++;

                        $esslup = array("synced" => 1, "synceddatetime" => DBDT);
                        $this->db->where("id", $row->id);
                        $res = $this->db->update('essl_attendance_logs', $esslup);
                        $updatedCount++;
                        create_notes($employeeid,'1','Punch Has Been Registered Type- '.$entrytype.' Punch Time- '.$currenttime ,$employeeid);
                        
                    }
                    
                }
                
            }
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            
            // $data1 = [
            //     'status' => '500',
            //     'msg' => 'Failed',
            //     'description' => 'data_rollback',
            //     'Count' => 0,
            // ];
             $response = [
                "status" => false,
                "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
                "message" => "Data Processed for date: " . $fromDateTime
            ];
            
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $response;
        } else {
            
            $array = array('name'=> 'Essl Attendance Sync','Url' => 'https://maxwellhrms.in/cron/essl_attendance_cron','cron_refrence_id' => 2);
            $res = $this->db->insert('cron_log',$array);
            
            $this->db->trans_commit();
            
            // $data1 = [
            //     'status' => '200',
            //     'msg' => 'Success',
            //     'description' => 'Punch Has Been Processed',
            //     'Count' => $countofessldata,
            // ];
            $response = [
                "status" => true,
                "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
                "message" => "Data Processed for date: " . $fromDateTime,
                'Count' => $countofessldata,
                'description' => 'Punch Has Been Processed',
            ];
            return $response;
        }
    }
    
    public function get_essl_attendance_cron($data,$deviceId,$punchType,$fromDateTime){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;

        if (empty($data['GetTransactionsLogResult'])) {
            $response = [
                "status" => true,
                "data" => [],
                "message" => "No data exists for date: ".$fromDateTime
            ];
            return $response;
        } 
            // Loop data
        foreach ($data['strDataList'] as $log) {
    
            // Check duplicate
            $this->db->where('employeecode', $log['employee_code']);
            $this->db->where('punchdatetime', $log['punchdatetime']);
            $this->db->where('deviceid', $deviceId);
    
            $exists = $this->db->count_all_results('essl_attendance_logs');
            if ($exists == 0) {
    
                $insertData = [
                    'employeecode'   => $log['employee_code'],
                    'punchdatetime' => $log['punchdatetime'],
                    'deviceid'      => $deviceId,
                    'punchtype'     => $punchType,
                    'punch'         => $log['punch']
                ];
    
                $this->db->insert('essl_attendance_logs', $insertData);
                $insertedCount++;
            }
        }
    
        // Final response
        $response = [
            "status" => true,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed for date: " . $fromDateTime
        ];
        
        $array = array('name'=> 'Get Essl Attendance Sync','Url' => 'https://maxwellhrms.in/cron/get_essl_attendance_cron','cron_refrence_id' => 1);
        $res = $this->db->insert('cron_log',$array);
        
      return $response;
        
    }

    public function get_attendance_before_grace_time($attendance_date){
        $insertedCount = 0;
        $updatedCount  = 0;
        $failedCount   = 0;

        // Get company timing details
        $this->db->select('mxcp_firsthalf_time, mxcp_firsthalf_gracetime');
        $company = $this->db->get('maxwell_company_master')->row_array();
        $firsthalf_time      = $company['mxcp_firsthalf_time'];
        $firsthalf_gracetime = $company['mxcp_firsthalf_gracetime'];

        // Create grace datetime
        $grace_datetime = date('Y-m-d H:i:s',strtotime($attendance_date . ' ' . $firsthalf_time .' +' . $firsthalf_gracetime . ' minutes'));

        // Get attendance logs before grace time
        $this->db->select('employeecode,punchdatetime');
        $this->db->from('essl_attendance_logs');
        $this->db->where('DATE(punchdatetime)', $attendance_date);
        $this->db->where('punchdatetime <=', $grace_datetime);
        $query  = $this->db->get();
        $esslqr = $query->result();

        $table = 'maxwell_attendance_' . date('Y', strtotime($attendance_date)) . '_' .date('m', strtotime($attendance_date));

        foreach ($esslqr as $key => $val){
            $attdt = date('Y-m-d', strtotime($val->punchdatetime));
            $this->db->select('mx_attendance_id,mx_attendance_emp_code,mx_attendance_date,mx_attendance_first_half');
            $this->db->from($table);
            $this->db->where('mx_attendance_date', $attdt);
            $this->db->where('mx_attendance_emp_code', $val->employeecode);
            $querymain  = $this->db->get();
            $attendance = $querymain->row_array();
            
            if (!empty($attendance)){
                if ($attendance['mx_attendance_first_half'] != 'PR'){
                    $esslup = array("mx_attendance_first_half" => 'PR');
                    $this->db->where("mx_attendance_id", $attendance['mx_attendance_id']);
                    $this->db->where("mx_attendance_date", $attendance['mx_attendance_date']);
                    $this->db->where("mx_attendance_emp_code", $attendance['mx_attendance_emp_code']);
                    $resup = $this->db->update($table, $esslup);
                    if ($resup){
                        $updatedCount++;
                    }else{
                        $failedCount++;
                    }
                }
            }
        }

        $response = [
            "status" => true,
            "data" => ["updated" => $updatedCount,"failed"  => $failedCount,"inserted" => $insertedCount],
            "message" => "Data Processed for date: " . $attendance_date
        ];
        $array = array('name'=> 'Get Attendance Before Grace Time','Url' => 'https://maxwellhrms.in/cron/cron_get_attendance_before_grace_time','cron_refrence_id' => 12);
        $res = $this->db->insert('cron_log',$array);
        return $response;
    }
}
?>