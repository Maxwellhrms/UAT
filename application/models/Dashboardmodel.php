<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Dashboardmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    function cleanInput($val){
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }

    function get_client_ip(){
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
    
    public function dashboardsummary(){
        
        $res['employeescount'] = $this->employeescount_summary();
        
        $res['latepunch'] = $this->todayslate_summary();

        $res['singlepunch'] = $this->yesturday_summary();
        
        $res['lateearly'] = $this->yesturdaylateearly_summary();
        
        $res['dob'] = $this->birthdays_summary();
        
        $res['holiday'] = $this->holiday_summary();
        
        $res['joinresign'] = $this->join_resign_summary();
        
        $res['loanscount'] = $this->loanscount_summary();
        
        $res['leavesapplied'] = $this->leavesapplied_summary();
        
        $res['inleaves'] = $this->inleaves_summary();
        
        $res['joined_resigned_details'] = $this->joined_resigned_details_summary();

        $res['currentmonthleaves'] = $this->currentmonthleaves_summary();
        
        $res['currentmonthregulation'] = $this->regulation_summary();
        
        $res['absentsummary'] = $this->absents_summary();
        
        $res['servicesummary'] = $this->service_history();
        
        $res['crondetailslist'] = $this->cronlist();
        
        $res['ondutysummary'] = $this->todayonduty_summary();
        
        $res['pastseventdaysabsent_summary'] = $this->pastseventdaysabsent_summary();

        return $res;
        
    }
    
    public function pastseventdaysabsent_summary(){
        $year = date('Y');
        $month = date('m');
        $yearm = $year.'_'.$month;
        $qec ="SELECT mx_attendance_emp_code AS employeecode,mxemp_emp_fname AS name, mxb_name AS branchname, mxemp_emp_img AS image, mxemp_emp_phone_no AS phone, mxemp_emp_email_id AS email,
    SUM(CASE WHEN mx_attendance_first_half = 'AB' AND mx_attendance_second_half = 'AB' THEN 1 ELSE 0 END) AS Absent,
    SUM(CASE WHEN mx_attendance_first_half = 'AB' AND mx_attendance_second_half != 'AB' THEN 0.5 ELSE 0 END) AS First_Half_Absent,
    SUM(CASE WHEN mx_attendance_second_half = 'AB' AND mx_attendance_first_half != 'AB' THEN 0.5 ELSE 0 END) AS Second_Half_Absent,
    SUM(CASE WHEN mx_attendance_first_half = 'WO' AND mx_attendance_second_half = 'WO' THEN 1 ELSE 0 END) AS WO,
    SUM(CASE WHEN mx_attendance_first_half = 'WO' AND mx_attendance_second_half != 'WO' THEN 0.5 ELSE 0 END) AS First_Half_WO,
    SUM(CASE WHEN mx_attendance_second_half = 'WO' AND mx_attendance_first_half != 'WO' THEN 0.5 ELSE 0 END) AS Second_Half_WO,
    SUM(
        CASE 
            WHEN mx_attendance_first_half = 'AB' AND mx_attendance_second_half = 'AB' THEN 1
            WHEN mx_attendance_first_half = 'AB' AND mx_attendance_second_half != 'AB' THEN 0.5
            WHEN mx_attendance_second_half = 'AB' AND mx_attendance_first_half != 'AB' THEN 0.5
            WHEN mx_attendance_first_half = 'WO' AND mx_attendance_second_half = 'WO' THEN 1
            WHEN mx_attendance_first_half = 'WO' AND mx_attendance_second_half != 'WO' THEN 0.5
            WHEN mx_attendance_second_half = 'WO' AND mx_attendance_first_half != 'WO' THEN 0.5
            ELSE 0
        END
    ) AS total_absent_days FROM maxwell_attendance_$yearm 
    INNER JOIN maxwell_employees_info ON mxemp_emp_id = mx_attendance_emp_code 
    INNER JOIN maxwell_branch_master ON mxb_id = mxemp_emp_branch_code 
    inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
    inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
    WHERE mxemp_emp_resignation_status != 'R' AND mx_attendance_date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() ";
    if($this->session->userdata('user_limiteddropdowns') == 1){
        $bruser = $this->session->userdata('user_branch');
        $brselected = $this->session->userdata('user_custom_branches');
        if(isset($brselected) && !empty($brselected)){
            $br = explode(',',$brselected);
            if(count($br)>0){
                $bruser_assigned_br = $br;
            }else{
                $bruser_assigned_br = array($brselected);
            }
        }else{
            $bruser_assigned_br = array($bruser);
        }
        $divisionid = $this->session->userdata('user_division');
        $stateid = $this->session->userdata('user_state');
        $qec .=" and mxemp_emp_division_code = $divisionid";
        $qec .=" and mxemp_emp_state_code = $stateid";
        $qec .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
    }
    $qec .=" GROUP BY mx_attendance_emp_code HAVING total_absent_days >= 7";
        $queryec = $this->db->query($qec);
        return $queryec->result_array();
    }
    
    public function employeescount_summary(){
        $qec ="select mxd_name as divisionname, mxemp_emp_gender, mxemp_emp_resignation_status, COUNT(*) AS employee_count from maxwell_employees_info 
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qec .=" where mxemp_emp_division_code = $divisionid";
            $qec .=" and mxemp_emp_state_code = $stateid";
            $qec .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qec .=" GROUP BY mxemp_emp_gender, mxemp_emp_resignation_status,mxemp_emp_division_code order by mxemp_emp_resignation_status desc";
        $queryec = $this->db->query($qec);
        return $queryec->result_array();
    }
    
    public function loanscount_summary(){
        $qlo ="select COUNT(mxemploan_load_id) AS total_loans_applied, SUM(mxemploan_emp_loan_amt_approved) AS total_loan_amount, SUM(mxemploan_emp_loan_outstanding_amt) AS total_outstanding_amount, (SUM(mxemploan_emp_loan_outstanding_amt) / SUM(mxemploan_emp_loan_amt_approved)) * 100 AS percentage_needto_recovered, 100 - ((SUM(mxemploan_emp_loan_outstanding_amt) / SUM(mxemploan_emp_loan_amt_approved)) * 100) AS recovered_percentage from maxwell_emp_loan_master where mxemploan_status = 1 and mxemploan_emp_information !='CLOSED'";
        $querylo = $this->db->query($qlo);
        return $querylo->result_array();
    }
    
    public function birthdays_summary(){
        $qb ="select mxemp_emp_id as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_date_of_birth, mxemp_emp_email_id as email, mxb_name as Branch_Name, mxb_bremail as Branch_Email from maxwell_employees_info 
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        where MONTH(mxemp_emp_date_of_birth) = MONTH(CURDATE()) and DAY(mxemp_emp_date_of_birth) >= DAY(CURDATE()) and mxemp_emp_resignation_status !='R'";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qb .=" and mxemp_emp_division_code = $divisionid";
            $qb .=" and mxemp_emp_state_code = $stateid";
            $qb .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qb .=" ORDER BY DAY(mxemp_emp_date_of_birth)";
        $queryb = $this->db->query($qb);
        return $queryb->result_array();
    }
    
    public function holiday_summary(){
        $qh ="select mxd_name as divisionname,COALESCE(mxst_state, 'ALL STATES') as state,mxb_name as branchname,mx_holiday_name as holidayname, mx_holiday_date as holidaydate, CASE WHEN mx_holiday_type = '1' THEN 'PH' WHEN mx_holiday_type = '2' THEN 'OCH' WHEN mx_holiday_type = '3' THEN 'OPH' ELSE 'Unknown Type' END AS holiday_type from maxwell_holiday_master inner join maxwell_division_master on mxd_id = mx_holiday_division_id left join maxwell_state_master on mxst_id = mx_holiday_state_id inner join maxwell_branch_master on mxb_id = mx_holiday_branch_id where YEAR(mx_holiday_date) = YEAR(CURRENT_DATE) AND MONTH(mx_holiday_date) = MONTH(CURRENT_DATE) and mx_holiday_date >= CURRENT_DATE and mx_holiday_status = 1 order by mx_holiday_date,mxd_name,state,mxb_name asc";
        $queryh = $this->db->query($qh);
        return $queryh->result_array();
    }
    
    public function join_resign_summary(){
        $currentdate = date('Y-m-d');
        $qrj ="select year,month,monthname, SUM(joined_count) AS joined_count, SUM(resigned_count) AS resigned_count from (select YEAR(mxemp_emp_date_of_join) AS year, MONTH(mxemp_emp_date_of_join) AS month, MONTHNAME(mxemp_emp_date_of_join) as monthname, COUNT(*) AS joined_count, 0 AS resigned_count from maxwell_employees_info
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        where date(mxemp_emp_date_of_join) BETWEEN '2023-08-01' AND '$currentdate' ";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qrj .=" and mxemp_emp_division_code = $divisionid";
            $qrj .=" and mxemp_emp_state_code = $stateid";
            $qrj .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qrj .=" GROUP BY YEAR(mxemp_emp_date_of_join), MONTH(mxemp_emp_date_of_join) UNION select YEAR(mxemp_emp_resignation_date) AS year, MONTH(mxemp_emp_resignation_date) AS month, MONTHNAME(mxemp_emp_date_of_join) as monthname, 0 AS joined_count, COUNT(*) AS resigned_count from maxwell_employees_info where date(mxemp_emp_resignation_date) BETWEEN '2023-08-01' AND '$currentdate' AND mxemp_emp_resignation_date IS NOT NULL and mxemp_emp_resignation_date !='0000-00-00 00:00:00' GROUP BY YEAR(mxemp_emp_resignation_date), MONTH(mxemp_emp_resignation_date)) AS subquery GROUP BY year, month ORDER BY year desc";
        $queryrj = $this->db->query($qrj);
        return $queryrj->result_array();
    }
    
    public function joined_resigned_details_summary(){
        $qrjd ="select mxemp_emp_id as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, CASE WHEN mxemp_emp_resignation_status = 'W' THEN 'WORKING' WHEN mxemp_emp_resignation_status = 'R' THEN 'RESIGNED' WHEN mxemp_emp_resignation_status = 'N' THEN 'NOTICE PERIOD' WHEN mxemp_emp_resignation_status = 'WN' THEN ' WITH OUT NOTICE PERIOD' ELSE 'Unknown Type' END AS status, mxemp_emp_date_of_join as date_of_join, date(mxemp_emp_resignation_date) as resign_dt from maxwell_employees_info 
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        where (MONTH(mxemp_emp_date_of_join) = MONTH(CURDATE()) AND YEAR(mxemp_emp_date_of_join) = YEAR(CURDATE())) OR (MONTH(mxemp_emp_resignation_date) = MONTH(CURDATE()) AND YEAR(mxemp_emp_resignation_date) = YEAR(CURDATE()))";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qrjd .=" and mxemp_emp_division_code = $divisionid";
            $qrjd .=" and mxemp_emp_state_code = $stateid";
            $qrjd .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $queryrjd = $this->db->query($qrjd);
        return $queryrjd->result_array();
    }
    
    public function regulation_summary(){
        $qrlmreg ="select mxemp_emp_fname as name, mxemp_emp_img as image, mxar_appliedby_emp_code AS employeecode, 
             mxar_type AS type,
             SUM(CASE WHEN mxar_authfinal_status = 9 THEN mxar_attend_countdays ELSE 0 END) AS pending,
             SUM(CASE WHEN mxar_authfinal_status = 3 THEN mxar_attend_countdays ELSE 0 END) AS revert, 
             SUM(CASE WHEN mxar_authfinal_status = 1 THEN mxar_attend_countdays ELSE 0 END) AS approved, 
             SUM(CASE WHEN mxar_authfinal_status = 2 THEN mxar_attend_countdays ELSE 0 END) AS rejected,
             SUM(mxar_attend_countdays) AS total_days 
             from attendance_regulation 
             inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id
             inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
             inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
             inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
             where MONTH(mxar_from) = MONTH(CURDATE()) AND YEAR(mxar_from) = YEAR(CURDATE()) and MONTH(mxar_to) = MONTH(CURDATE()) AND YEAR(mxar_to) = YEAR(CURDATE()) and mxar_status =1 ";
            if($this->session->userdata('user_limiteddropdowns') == 1){
                $bruser = $this->session->userdata('user_branch');
                $brselected = $this->session->userdata('user_custom_branches');
                if(isset($brselected) && !empty($brselected)){
                    $br = explode(',',$brselected);
                    if(count($br)>0){
                        $bruser_assigned_br = $br;
                    }else{
                        $bruser_assigned_br = array($brselected);
                    }
                }else{
                    $bruser_assigned_br = array($bruser);
                }
                $divisionid = $this->session->userdata('user_division');
                $stateid = $this->session->userdata('user_state');
                $qrlmreg .=" and mxemp_emp_division_code = $divisionid";
                $qrlmreg .=" and mxemp_emp_state_code = $stateid";
                $qrlmreg .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
            }
             $qrlmreg.=" GROUP BY mxar_appliedby_emp_code, mxar_type
             order by mxar_createdtime desc";
        $querylmreg = $this->db->query($qrlmreg); 
        return $querylmreg->result_array();
    }
    
    public function currentmonthleaves_summary(){
        $qrlm ="select mxemp_emp_fname as name, mxemp_emp_img as image, mxar_appliedby_emp_code AS employeecode, mxar_leave_type AS leave_type, SUM(CASE WHEN mxar_final_accept_status = 9 THEN mxar_noofdays ELSE 0 END) AS pending, SUM(CASE WHEN mxar_final_accept_status = 3 THEN mxar_noofdays ELSE 0 END) AS hrapproved, SUM(CASE WHEN mxar_final_accept_status = 1 THEN mxar_noofdays ELSE 0 END) AS approved, SUM(CASE WHEN mxar_final_accept_status = 2 THEN mxar_noofdays ELSE 0 END) AS rejected,SUM(mxar_noofdays) AS total_days from attendance_user_leaveadjust 
        inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where MONTH(mxar_from) = MONTH(CURDATE()) AND YEAR(mxar_from) = YEAR(CURDATE()) and MONTH(mxar_to) = MONTH(CURDATE()) AND YEAR(mxar_to) = YEAR(CURDATE()) and mxar_status =1";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qrlm .=" and mxemp_emp_division_code = $divisionid";
            $qrlm .=" and mxemp_emp_state_code = $stateid";
            $qrlm .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qrlm.=" GROUP BY mxar_appliedby_emp_code, mxar_leave_type order by mxar_createdtime desc";
        $querylm = $this->db->query($qrlm);
        return $querylm->result_array();
    }
    
    public function absents_summary(){
        $year = date('Y');
        $month = date('m');
        $yearm = $year.'_'.$month;
        $q = "select mx_attendance_emp_code as employeecode,mxemp_emp_fname as name, mxb_name as branchname,mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email from maxwell_attendance_$yearm
        inner join maxwell_employees_info on mxemp_emp_id = mx_attendance_emp_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where (mx_attendance_first_half_punch = '' and mx_attendance_second_half_punch ='') and (mx_attendance_first_half = 'AB' and mx_attendance_second_half = 'AB') and mx_attendance_date=CURDATE() and mxemp_emp_resignation_status !='R'";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $q .=" and mxemp_emp_division_code = $divisionid";
            $q .=" and mxemp_emp_state_code = $stateid";
            $q .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $query = $this->db->query($q); 
        return $query->result_array();
    }

    public function todayslate_summary(){
        $year = date('Y');
        $currentdate = date('Y-m-d');
        $ql = "select mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, employee_code as employeecode, mxb_name as branchname, attendance_date, MIN(attendance_time) AS late_attendance from employee_punches_$year 
        inner join maxwell_employees_info on employee_code = mxemp_emp_id 
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where DATE(attendance_date) = '$currentdate' ";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $ql .=" and mxemp_emp_division_code = $divisionid";
            $ql .=" and mxemp_emp_state_code = $stateid";
            $ql .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $ql .=" GROUP BY employee_code HAVING MIN(attendance_time) > '09:39:59' order by attendance_time desc";
        $queryl = $this->db->query($ql);
        return $queryl->result_array();
    }
    
    public function yesturday_summary(){
        $year = date('Y');
        $yesturdaysdate = date('Y-m-d' ,strtotime('-1 day'));
        $qs ="select mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, employee_code as employeecode, mxb_name as branchname, attendance_date,attendance_time, MAX(attendance_time) AS latest_attendance from employee_punches_$year 
        inner join maxwell_employees_info on employee_code = mxemp_emp_id
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where DATE(attendance_date) = '$yesturdaysdate' ";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qs .=" and mxemp_emp_division_code = $divisionid";
            $qs .=" and mxemp_emp_state_code = $stateid";
            $qs .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qs .=" GROUP BY employee_code HAVING COUNT(*) = 1 order by attendance_time desc";
        $querys = $this->db->query($qs);
        return $querys->result_array();
    }
    public function yesturdaylateearly_summary(){
        $year = date('Y');
        $yesturdaysdate = date('Y-m-d' ,strtotime('-1 day'));
        $qle ="select mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, employee_code as employeecode,mxb_name as branchname, attendance_date, COUNT(*) AS punches_count,MIN(attendance_time) AS first_punch, MAX(attendance_time) as last_punch from employee_punches_$year 
        inner join maxwell_employees_info on employee_code = mxemp_emp_id 
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where DATE(attendance_date) = '$yesturdaysdate'";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qle .=" and mxemp_emp_division_code = $divisionid";
            $qle .=" and mxemp_emp_state_code = $stateid";
            $qle .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qle .=" GROUP BY employee_code HAVING punches_count >= 2 AND MIN(TIME(attendance_time)) >= '09:40:00' AND MAX(TIME(attendance_time)) <= '17:59:59'";
        $queryle = $this->db->query($qle);
        return $queryle->result_array();
    }
    
    public function leavesapplied_summary(){
        $currentdate = date('Y-m-d');
        $qcl = "select DISTINCT( mxar_appliedby_emp_code) as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, mxar_leave_type as leavetype,mxar_createdtime as createtime,CASE WHEN mxar_final_accept_status = 9 THEN 'PENDING' WHEN mxar_final_accept_status = 1 THEN 'APPROVED' WHEN mxar_final_accept_status = 2 THEN 'REJECTED' WHEN mxar_final_accept_status = 3 THEN 'HR APPROVED' ELSE 'Unknown Leave Type' END AS leave_status,mxar_desc as description, mxar_from as fromdate, mxar_to as todate, mxar_noofdays as noofdays from attendance_user_leaveadjust 
        inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where DATE(mxar_createdtime) = '$currentdate' ";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qcl .=" and mxemp_emp_division_code = $divisionid";
            $qcl .=" and mxemp_emp_state_code = $stateid";
            $qcl .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $qcl .=" order by mxar_createdtime desc";
        $querycl = $this->db->query($qcl);
        return $querycl->result_array();
    }
    
    public function inleaves_summary(){
        $currentdate = date('Y-m-d');
        $qcl = "select DISTINCT( mxar_appliedby_emp_code) as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, mxar_leave_type as leavetype,mxar_createdtime as createtime,CASE WHEN mxar_final_accept_status = 9 THEN 'PENDING' WHEN mxar_final_accept_status = 1 THEN 'APPROVED' WHEN mxar_final_accept_status = 2 THEN 'REJECTED' WHEN mxar_final_accept_status = 3 THEN 'HR APPROVED' ELSE 'Unknown Leave Type' END AS leave_status,mxar_desc as description, mxar_from as fromdate, mxar_to as todate, mxar_noofdays as noofdays from attendance_user_leaveadjust 
        inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where mxar_from <= '$currentdate' AND mxar_to >= '$currentdate'";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $qcl .=" and mxemp_emp_division_code = $divisionid";
            $qcl .=" and mxemp_emp_state_code = $stateid";
            $qcl .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $querycl = $this->db->query($qcl);
        return $querycl->result_array();
    }
    
    public function todayonduty_summary(){
        $year = date('Y');
        $month = date('m');
        $yearm = $year.'_'.$month;
        $day = date('Y-m-d');
        $q = "select mx_attendance_emp_code as employeecode,mxemp_emp_fname as name, mxb_name as branchname,mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email,
        (select MIN(attendance_time) as firstpunch FROM employee_punches_$year WHERE employee_code = mxemp_emp_id and attendance_date = '$day' and islocation ='NO') as firstpunch,
        (select Max(attendance_time) as lastpunch FROM employee_punches_$year WHERE employee_code = mxemp_emp_id and attendance_date = '$day' and islocation ='NO' ) as lastpunch
        from maxwell_attendance_$yearm
        inner join maxwell_employees_info on mxemp_emp_id = mx_attendance_emp_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where (mx_attendance_first_half = 'OD' or mx_attendance_second_half = 'OD') and mx_attendance_date=CURDATE() and mxemp_emp_resignation_status !='R'";
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $divisionid = $this->session->userdata('user_division');
            $stateid = $this->session->userdata('user_state');
            $q .=" and mxemp_emp_division_code = $divisionid";
            $q .=" and mxemp_emp_state_code = $stateid";
            $q .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        }
        $query = $this->db->query($q); 
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    public function service_history(){
        $qcl = "SELECT
    CASE
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 365 THEN 'Less than 1 year'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 2 * 365 THEN '1 year'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 3 * 365 THEN '2 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 4 * 365 THEN '3 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 5 * 365 THEN '4 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 6 * 365 THEN '5 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 7 * 365 THEN '6 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 8 * 365 THEN '7 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 9 * 365 THEN '8 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 10 * 365 THEN '9 years'
        WHEN TIMESTAMPDIFF(DAY, mxemp_emp_date_of_join, NOW()) < 11 * 365 THEN '10 years'
        ELSE 'More than 10 years'
    END AS service_category,
    SUM(CASE WHEN mxemp_emp_resignation_status != 'R' THEN 1 ELSE 0 END) AS working_count,
    SUM(CASE WHEN mxemp_emp_resignation_status = 'R' THEN 1 ELSE 0 END) AS resigned_count,
    SUM(CASE WHEN mxemp_emp_resignation_status IN ('W', 'R') THEN 1 ELSE 0 END) AS total_count
FROM
    maxwell_employees_info
    inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
    inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
    inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
WHERE
    mxemp_emp_resignation_status IN ('W', 'R')";
    if($this->session->userdata('user_limiteddropdowns') == 1){
        $bruser = $this->session->userdata('user_branch');
        $brselected = $this->session->userdata('user_custom_branches');
        if(isset($brselected) && !empty($brselected)){
            $br = explode(',',$brselected);
            if(count($br)>0){
                $bruser_assigned_br = $br;
            }else{
                $bruser_assigned_br = array($brselected);
            }
        }else{
            $bruser_assigned_br = array($bruser);
        }
        $divisionid = $this->session->userdata('user_division');
        $stateid = $this->session->userdata('user_state');
        $qcl .=" and mxemp_emp_division_code = $divisionid";
        $qcl .=" and mxemp_emp_state_code = $stateid";
        $qcl .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
    }
$qcl.=" GROUP BY
    service_category
    ORDER BY
    CASE
        WHEN service_category = 'Less than 1 year' THEN 1
        WHEN service_category = '1 year' THEN 2
        WHEN service_category = '2 years' THEN 3
        WHEN service_category = '3 years' THEN 4
        WHEN service_category = '4 years' THEN 5
        WHEN service_category = '5 years' THEN 6
        WHEN service_category = '6 years' THEN 7
        WHEN service_category = '7 years' THEN 8
        WHEN service_category = '8 years' THEN 9
        WHEN service_category = '9 years' THEN 10
        WHEN service_category = '10 years' THEN 11
        WHEN service_category = 'More than 10 years' THEN 12
        ELSE 13
    END
    ";
        $querycl = $this->db->query($qcl);
        return $querycl->result_array();
    }
    
    public function prepareformailingsendmail($data){
        $year = date('Y');
        $day = date('Y-m-d');
        if($data['type'] == 'SINGLE PUNCH' || $data['type'] == 'Late In & Early Exit'){
           $day = date('Y-m-d', strtotime("-1 day"));
            if($day == date('Y-01-01')){
                $year = date('Y', strtotime("-1 Year"));
            }
        }
        $employeecode = $data['empcode'];
        $templateid = $data['templateid'];
        $this->db->select("mxemp_emp_id as employeecode,mxemp_emp_fname as name,mxemp_emp_email_id as email, email_body as templateinfo,(select MIN(attendance_time) as firstpunch FROM employee_punches_$year WHERE employee_code = mxemp_emp_id and attendance_date = '$day') as firstpunch,(select Max(attendance_time) as lastpunch FROM employee_punches_$year WHERE employee_code = mxemp_emp_id and attendance_date = '$day') as lastpunch, (select attendance_date as attendancedate FROM employee_punches_$year WHERE employee_code = mxemp_emp_id and attendance_date = '$day' limit 1) as attendancedate,mxemp_emp_division_code,email_division,email_title,email_subject,email_cc,email_bc,id as templateid, mxb_bremail as branchemail");
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_email_templates', 'email_division = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        $this->db->where_in('mxemp_emp_id', $employeecode);
         $this->db->where_in('id', $templateid);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }
    
    public function cronlist(){
        $fromdate = date('Y-m-d').' 00:00:00';
        $todate = date('Y-m-d'). ' 23:59:59';
        $this->db->select("name,Url,entry_dt");
        $this->db->from("cron_log");
        $this->db->where('entry_dt >=', $fromdate);
        $this->db->where('entry_dt <=', $todate);
        $this->db->order_by("entry_dt", "DESC");
        $emp_type_qry = $this->db->get();
        // echo $this->db->last_query();exit;
       return $emp_type_qry->result();
    }
    
}