<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Reports_model extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // public function calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate){
    //     $firstpunch = $attendancedate.' '.$userfirstpunch;
    //     $lastpunch = $attendancedate.' '.$userlastpunch;
    //     // $d1 = strtotime($firstpunch);
    //     // $d2 = strtotime($lastpunch);
    //     // $totalSecondsDiff = abs($d1-$d2); //42600225
    //     // $totalMinutesDiff = $totalSecondsDiff/60; //710003.75
    //     // $totalHoursDiff   = $totalSecondsDiff/60/60;//11833.39
    //     // $totalDaysDiff    = $totalSecondsDiff/60/60/24; //493.05
    //     // $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30; //16.43
    //     // $totalYearsDiff   = $totalSecondsDiff/60/60/24/365; //1.35  
    //     // return abs($totalHoursDiff);
    //     $d1 = new DateTime($firstpunch);
    //     $d2 = new DateTime($lastpunch);
    //     $interval = $d1->diff($d2);
    //     $diffInSeconds = $interval->s; //45
    //     $diffInMinutes = $interval->i; //23
    //     $diffInHours   = $interval->h; //8
    //     $diffInDays    = $interval->d; //21
    //     $diffInMonths  = $interval->m; //4
    //     $diffInYears   = $interval->y; //1
    //     return $diffInHours;
    // }
    
    public function calculatetotalworkinghours($userfirstpunch, $userlastpunch, $attendancedate) {
        $firstpunch = $attendancedate . ' ' . $userfirstpunch;
        $lastpunch = $attendancedate . ' ' . $userlastpunch;
    
        $d1 = new DateTime($firstpunch);
        $d2 = new DateTime($lastpunch);
    
        $interval = $d1->diff($d2);
    
        $diffInHours = $interval->h + ($interval->days * 24); // Includes days as hours
        $diffInMinutes = $interval->i; // Minutes
        $diffInSeconds = $interval->s; // Seconds
    
        return sprintf('%02d:%02d:%02d', $diffInHours, $diffInMinutes, $diffInSeconds);
    }

    public function api_employee_attendance_history($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day){
        $this->db->select("mx_attendance_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,mxcp_name as company_name, 
                           mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, mxdesg_name as designation_name,
                           mx_attendance_date as attendance_date,mx_attendance_first_half as first_half,mx_attendance_second_half as second_half");
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $this->db->where('mx_attendance_branch_id', $branchid);
        }
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        if(!empty($attendance_category)){
            $where = '(mx_attendance_first_half= "'.$attendance_category.'" OR mx_attendance_second_half = "'.$attendance_category.'")';
            $this->db->where( $where);
        }
        $query = $this->db->get();
        $qry= $query->result_array();
        if(count($qry)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$qry;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function api_employee_attendance_punch_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day){
        // $current_date = date('Y-m-d');
        $this->db->select("mx_attendance_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,mxcp_name as company_name,
                           mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, mxdesg_name as designation_name,
                           mx_attendance_date as attendance_date,mx_attendance_first_half as first_half,mx_attendance_second_half as second_half,
                           mx_attendance_first_half_punch as first_punch, mx_attendance_second_half_punch as second_punch");
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        # $this->db->where("mxemp_emp_resignation_relieving_date >=",$current_date);
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $this->db->where('mx_attendance_branch_id', $branchid);
        }
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        // echo $this->db->last_query(); exit;
        $firstlast ='';
        $lastlast ='';
        foreach ($result as $key => $value) {
            $firstlast ='';
            $lastlast ='';
            if(empty($value['first_punch'])){
                $result[$key]['first_punch'] = 'No Punch';
                $firstpunch = '';
            }else{
                $firstpunchtime = $value['first_punch'];
                $getallpunches = explode(',', $firstpunchtime);
                if(count($getallpunches) > 1){
                    $result[$key]['first_punch'] = implode(',',$getallpunches);
                    $firstlast = $getallpunches[count($getallpunches) - 1];
                }else{
                    $result[$key]['first_punch'] = $getallpunches[0];
                }
                $firstpunch = $getallpunches[0];
            }
            if(empty($value['second_punch'])){
                $result[$key]['second_punch'] = 'No Punch';
                $lastpunch = '';
            }else{
                $lastpunchtime = $value['second_punch'];
                $getallpunches = explode(',', $lastpunchtime);
                if(count($getallpunches) > 1){
                    $result[$key]['second_punch'] = implode(',',$getallpunches);
                    $lastpunch = $getallpunches[count($getallpunches) - 1];
                    $lastlast = $lastpunch;
                }else{
                    $result[$key]['second_punch'] = $getallpunches[0];
                    $lastpunch = $getallpunches[0];
                }
            }
            if(!empty($firstpunch) && !empty($lastpunch)){
                $result[$key]['working_hours'] = $this->calculatetotalworkinghours($firstpunch,$lastpunch,$value['attendance_date']);
            }elseif(!empty($firstpunch) && empty($lastpunch) && !empty($firstlast)){
                $result[$key]['working_hours'] = $this->calculatetotalworkinghours($firstpunch,$firstlast,$value['attendance_date']);
            }elseif(!empty($lastpunch) && empty($firstpunch) && !empty($firstlast)){
                $result[$key]['working_hours'] = $this->calculatetotalworkinghours($firstpunch,$lastlast,$value['attendance_date']);
            }else{
                $result[$key]['working_hours'] = '';
            }
        }
        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$result;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function api_employee_attendance_absent_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day){
        $this->db->select("mx_attendance_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,
                           mxcp_name as company_name, mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, mxdesg_name as designation_name,
                           sum(case when mx_attendance_first_half = 'AB' AND mx_attendance_second_half = 'AB' then 1 else 0 end) AS Full_Absent,
                           sum(case when mx_attendance_first_half = 'AB' AND mx_attendance_second_half != 'AB' then 0.5 else 0 end) AS First_Half_Absent,
                           sum(case when mx_attendance_second_half = 'AB' AND mx_attendance_first_half != 'AB' then 0.5 else 0 end) AS Second_Half_Absent");        
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $branchid = explode(',', $branchid);
            $this->db->where_in('mx_attendance_branch_id', $branchid);
        }
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        $where = '(mx_attendance_first_half= "AB" OR mx_attendance_second_half = "AB")';
        $this->db->where( $where);
        $this->db->group_by('employee_id');
        $query = $this->db->get();
        $result = $query->result_array();
        foreach($result as $key => $value){
            $result[$key]['Total_Absents'] = ($value['Full_Absent'] + $value['First_Half_Absent'] + $value['Second_Half_Absent']);
        }
        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$result;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function api_employee_attendance_present_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day){
        $this->db->select("mx_attendance_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,mxcp_name as company_name,
                           mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, mxdesg_name as designation_name,
                           sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half = 'PR' then 1 else 0 end) AS Full_Present,
                           sum(case when mx_attendance_first_half = 'PR' AND mx_attendance_second_half != 'PR' then 0.5 else 0 end) AS First_Half_Present,
                           sum(case when mx_attendance_second_half = 'PR' AND mx_attendance_first_half != 'PR' then 0.5 else 0 end) AS Second_Half_Present");        
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $this->db->where('mx_attendance_branch_id', $branchid);
        }
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        $where = '(mx_attendance_first_half= "PR" OR mx_attendance_second_half = "PR")';
        $this->db->where( $where);
        $this->db->group_by('employee_id');
        $query = $this->db->get();
        $result = $query->result_array();
       
        foreach($result as $key => $value){
            $result[$key]['Full_Presents'] = ($value['Full_Present'] + $value['First_Half_Present'] + $value['Second_Half_Present']);
        }
        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$result;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function api_employee_attendance_latecomming_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day){
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();

        $officestarttime = $qry[0]->mxcp_firsthalf_time;
        $officesecondtime = $qry[0]->mxcp_secondhalf_time;
        $officestartend = $qry[0]->mxcp_logoff_time;
        $firsthalf_gracetime = '05';

        $this->db->select("mx_attendance_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,
                           mxcp_name as company_name, mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, 
                           mxdesg_name as designation_name,mx_attendance_date as attendance_date,mx_attendance_first_half_punch as first_punch");
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $branchid = explode(',', $branchid);
            $this->db->where_in('mx_attendance_branch_id', $branchid);
        }
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        $where = '(mx_attendance_first_half_punch != "" )';
        $this->db->where( $where);

        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as $key => $value) {
        $ontime = '';
            if(!empty($value['first_punch'])){
                $firstpunchtime = $value['first_punch'];
                $getallpunches = explode(',', $firstpunchtime);
                if(strtotime($officestarttime) < strtotime($getallpunches[0])){
                    $gracetime = $this->grace_calculator($firsthalf_gracetime,$getallpunches[0]);
                    if(strtotime($officestarttime) < strtotime($gracetime)){
                        $result[$key]['first_punch_status'] = 'Late';
                        $result[$key]['first_punch'] = $getallpunches[0];
                    }else{
                        $result[$key]['first_punch'] = $getallpunches[0];
                        $result[$key]['first_punch_status'] = 'Grace Activated';
                    }
                }else{
                    $result[$key]['first_punch'] = $getallpunches[0];
                    $result[$key]['first_punch_status'] = $getallpunches[0] .' ontime';
                    $ontime = 1;
                }
            }else{
                $result[$key]['first_punch_status'] = '';
                $ontime = 1;
            }
            if($ontime == 1){
                unset($result[$key]);
                continue;
            }
        }
        $res = array_values($result);
        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$res;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function grace_calculator($gracetime,$userfirstpunch){
        $grace=$gracetime;
        $gracetime = "-".$grace." minutes";
        $userfirstpunch = strtotime($userfirstpunch);
        return $finaltime= date("H:i:s", strtotime($gracetime, $userfirstpunch));
    }

    
    public function api_employee_attendance_regulation_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$attendance_category,$from,$to){
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $this->db->select("mxar_appliedby_emp_code as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,
                           mxcp_name as company_name, mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, 
                           mxar_reason as Applied_category, mxar_category_type as category_type, CONCAT(mxar_intime, ' - ', mxar_outtime) as Time,
                           CONCAT(mxar_from, ' - ', mxar_to) as Applied_date, mxar_attend_countdays as applied_dates, mxar_desc as employee_desc");
        $this->db->from('attendance_regulation');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxar_appliedby_emp_code', 'inner');
        //$this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxar_comp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mxar_appliedby_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mxar_comp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mxar_div_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mxar_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $branchid = explode(',', $branchid);
            $this->db->where_in('mxar_branch_id', $branchid);
        }
        if(!empty($attendance_category)){
            $this->db->where('mxar_reason',$attendance_category);
        }
        if(!empty($from)){
            $this->db->where('mxar_from >=',$from);
        }
        if(!empty($to)){
            $this->db->where('mxar_to <=',$to);
        }
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        $result = $query->result_array();
        foreach($result as $key => $value){
            if($value['category_type'] == 1){
                $result[$key]['category_type'] = 'First Half';
            }elseif($value['category_type'] == 2){
                $result[$key]['category_type'] = 'Second Half';
            }elseif($value['category_type'] == 3){
                $result[$key]['category_type'] = 'Full Day';
            }
        }
        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$result;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function getjoiningandleaving($employeeid,$companyid,$divisionid,$stateid,$branchid,$gradeid,$departmentid,$joining_leaving,$from,$to,$filter)
    {
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $this->db->select("mxemp_emp_id as employeeid , concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,
                           mxemp_emp_date_of_join as joining_date ,mxemp_emp_resignation_date as resignation_date,mxemp_emp_resignation_relieving_date as leaving_date,mxdpt_name as department, mxdesg_name as designation,
                           mxb_name as branchname, mxgrd_name as grade");
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'inner');
        $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'inner');
        $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'inner');
        // $this->db->where('mx_attendance_emp_code', $employeeid);
        if (!empty($employeeid) && ($employeeid !=0)) {
            $this->db->where('mxemp_emp_id', $employeeid);
        }
        if (!empty($companyid) && ($companyid !=0) ) {
            $this->db->where('mxemp_emp_comp_code', $companyid);
        }
        if (!empty($branchid) && ($branchid != 0)) {
            $this->db->where('mxemp_emp_branch_code', $branchid);
        }     
         if (!empty($divisionid)  && ($divisionid !=0) ) {
            $this->db->where('mxemp_emp_division_code', $divisionid);
        }
        if (!empty($stateid)  && ($stateid !=0) ) {
            $this->db->where('mxemp_emp_state_code', $stateid);
        }
        
        if($joining_leaving == 1 ){
             // $this->db->where("DATE_FORMAT(mxemp_emp_date_of_join,'%Y-%m')",$monthyear);
             $this->db->where('mxemp_emp_date_of_join >=',$from);
             $this->db->where('mxemp_emp_date_of_join <=',$to);

        }elseif($joining_leaving == 2){
             // $this->db->where("DATE_FORMAT(mxemp_emp_resignation_relieving_date,'%Y-%m')",$monthyear);
             $this->db->where('mxemp_emp_resignation_relieving_date >=',$from);
             $this->db->where('mxemp_emp_resignation_relieving_date <=',$to);
        }elseif($joining_leaving == 3){
            $this->db->group_start()->where('mxemp_emp_date_of_join >=', $from)->where('mxemp_emp_date_of_join <=', $to)->group_end();
            $this->db->or_group_start()->where('mxemp_emp_resignation_relieving_date >=', $from)->where('mxemp_emp_resignation_relieving_date <=', $to)->group_end();
        }
        $this->db->order_by("grade", "asc");
       
        $query = $this->db->get();
        $qry =  $query->result_array(); 
        if(count($qry)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$qry;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
   
    }
    
    public function api_employee_attendance_punch_details($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$day){
        $this->db->select("CONCAT(mx_attendance_emp_code ,'[#-#]', mx_attendance_date) as employee_id,CONCAT(mxemp_emp_fname , ' ' , mxemp_emp_lname) as employee_name,
                           mxcp_name as company_name, mxd_name as division_name, mxst_state as state_name, mxb_name as branch_name, 
                           mxdesg_name as designation_name,mx_attendance_date as attendance_date,mx_attendance_first_half_punch as first_punch, mx_attendance_second_half_punch as second_punch, mx_attendance_entry_type as entry_type, mx_attendance_location as location, mx_attendance_latitude as latitude,mx_attendance_longitude as longitude,mxemp_emp_present_postalcode as residence_pincode");
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'inner');
        if (!empty($employeeid)) {
            $this->db->where('mx_attendance_emp_code', $employeeid);
        }
        if (!empty($companyid)) {
            $this->db->where('mx_attendance_cmp_id', $companyid);
        }
        if (!empty($divisionid)) {
            $this->db->where('mx_attendance_division_id', $divisionid);
        }
        if (!empty($stateid)) {
            $this->db->where('mx_attendance_state_id', $stateid);
        }
        if (!empty($branchid)) {
            $this->db->where('mx_attendance_branch_id', $branchid);
        }
        
        if(!empty($day)) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year .'-'. $month . '-' . $day;  
            $this->db->where('mx_attendance_date', $date);
        }
        $query = $this->db->get();
    
        $result = $query->result_array();

        if(count($result)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']=$result;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        
          
    }

}