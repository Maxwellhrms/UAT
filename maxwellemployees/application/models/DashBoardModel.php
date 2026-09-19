<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class DashBoardModel extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getReportingManager(){
        $year = date('Y');
        $today = date('Y-m-d');
        $tablename = 'employee_punches_' . $year;
        $employeecode = $this->session->userdata('session_loginperson_id');
        $this->db->select("
            mxauth_emp_code,
            mxauth_reporting_head_emp_code,
            mxemp_emp_fname,
            mxemp_emp_lname,
            mxemp_emp_img,
            mxauth_auth_dept_name,

            CASE 
                WHEN EXISTS (
                    SELECT 1 
                    FROM $tablename p
                    WHERE p.employee_code = mxauth_reporting_head_emp_code
                    AND (
                        DATE(p.attendance_date) = '$today'
                    )
                    LIMIT 1
                ) THEN 'Working'

                WHEN EXISTS (
                    SELECT 1 
                    FROM attendance_user_leaveadjust l
                    WHERE l.mxar_appliedby_emp_code = mxauth_reporting_head_emp_code
                    AND '$today' BETWEEN l.mxar_from AND l.mxar_to
                    LIMIT 1
                ) THEN 'Leave'

                ELSE 'Absent'
            END AS working_status
        ");

        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxauth_reporting_head_emp_code', 'INNER');
        $this->db->where('mxauth_status', '1');
        $this->db->where('mxauth_emp_code', $employeecode);
        $this->db->order_by("mxauth_status", "desc");

        $query1 = $this->db->get();
         return $query1->result();
    }


    public function getAttendanceSummary(){
        $employee_code = $this->session->userdata('session_loginperson_id');
        $year = date('Y');
        $month = date('m');
        $tablename = 'employee_punches_' . $year;
        $sql = "
        SELECT 
            DATE_FORMAT(attendance_date, '%M') AS month_name,
            MONTH(attendance_date) AS month_no,
            COUNT(*) AS working_days,

            -- First punch before 09:35
            SUM(
                CASE 
                    WHEN first_punch <= '09:35:00' THEN 1 
                    ELSE 0 
                END
            ) AS ontime_days,

            ROUND(
                (
                    SUM(
                        CASE 
                            WHEN first_punch <= '09:35:00' THEN 1 
                            ELSE 0 
                        END
                    ) / COUNT(*)
                ) * 100, 0
            ) AS ontime_percent,

            SEC_TO_TIME(AVG(work_seconds)) AS avg_hours_day,

            -- compare with 8h30m = 30600 sec
            CASE
                WHEN AVG(work_seconds) >= 30600 
                THEN 'Completed'
                ELSE 'Below Target'
            END AS status

        FROM
        (
            SELECT 
                attendance_date,

                MIN(attendance_time) AS first_punch,

                TIMESTAMPDIFF(
                    SECOND,
                    MIN(attendance_time),
                    MAX(attendance_time)
                ) AS work_seconds

            FROM $tablename
            WHERE employee_code = '$employee_code'
            AND YEAR(attendance_date) = '$year'
            AND MONTH(attendance_date) = '$month'

            GROUP BY attendance_date
        ) x

        GROUP BY MONTH(attendance_date)
        ORDER BY month_no
        ";
        // echo $sql;exit;
        $query1 = $this->db->query($sql);
        return $query1->result_array();
    }

    public function leaveBalanceSummary(){
        $employeeid = $this->session->userdata('session_loginperson_id');

        $this->db->select("
            mxemp_leave_bal_emp_id,

            SUM(mxemp_leave_bal_crnt_bal) AS total_leaves,

            SUM(
                CASE 
                    WHEN mxemp_leave_bal_leave_type_shrt_name = 'EL' 
                    THEN mxemp_leave_bal_crnt_bal 
                    ELSE 0 
                END
            ) AS paid_leaves

        ", false);

        $this->db->from('maxwell_emp_leave_balance');
        $this->db->where('mxemp_leave_bal_emp_id', $employeeid);
        $this->db->group_by('mxemp_leave_bal_emp_id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function holiday_summary(){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $companyid = $this->session->userdata('session_company');
        $divisionid = $this->session->userdata('session_division');
        $stateid = $this->session->userdata('session_state');
        $branchid = $this->session->userdata('session_branch');

        $qh ="select mxd_name as divisionname,COALESCE(mxst_state, 'ALL STATES') as state,mxb_name as branchname,mx_holiday_name as holidayname, mx_holiday_date as holidaydate, CASE WHEN mx_holiday_type = '1' THEN 'Public Holiday' WHEN mx_holiday_type = '2' THEN 'Occational Holiday' WHEN mx_holiday_type = '3' THEN 'Optional Holiday' ELSE 'Unknown Type' END AS holiday_type from maxwell_holiday_master inner join maxwell_division_master on mxd_id = mx_holiday_division_id left join maxwell_state_master on mxst_id = mx_holiday_state_id inner join maxwell_branch_master on mxb_id = mx_holiday_branch_id where YEAR(mx_holiday_date) = YEAR(CURRENT_DATE) AND MONTH(mx_holiday_date) >= MONTH(CURRENT_DATE) and mx_holiday_date >= CURRENT_DATE and mx_holiday_status = 1 and mx_holiday_company_id = '$companyid' and mx_holiday_division_id = '$divisionid' and mx_holiday_state_id = '$stateid' and mx_holiday_branch_id = '$branchid'  order by mx_holiday_date,mxd_name,state,mxb_name asc";
        $queryh = $this->db->query($qh);
        return $queryh->result_array();
    }

    public function inleaves_summary(){
        $currentdate = date('Y-m-d');
        $companyid = $this->session->userdata('session_company');
        $divisionid = $this->session->userdata('session_division');
        $stateid = $this->session->userdata('session_state');
        $branchid = $this->session->userdata('session_branch');
        $qcl = "select DISTINCT( mxar_appliedby_emp_code) as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_phone_no as phone, mxemp_emp_email_id as email, mxar_leave_type as leavetype,mxar_createdtime as createtime,CASE WHEN mxar_final_accept_status = 9 THEN 'PENDING' WHEN mxar_final_accept_status = 1 THEN 'APPROVED' WHEN mxar_final_accept_status = 2 THEN 'REJECTED' WHEN mxar_final_accept_status = 3 THEN 'HR APPROVED' ELSE 'Unknown Leave Type' END AS leave_status,mxar_desc as description, mxar_from as fromdate, mxar_to as todate, mxar_noofdays as noofdays from attendance_user_leaveadjust 
        inner join maxwell_employees_info on mxar_appliedby_emp_code = mxemp_emp_id
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        where mxar_from >= '$currentdate' AND mxar_to <= '$currentdate'";
        // if($this->session->userdata('user_limiteddropdowns') == 1){
        //     $bruser = $this->session->userdata('user_branch');
        //     $brselected = $this->session->userdata('user_custom_branches');
        //     if(isset($brselected) && !empty($brselected)){
        //         $br = explode(',',$brselected);
        //         if(count($br)>0){
        //             $bruser_assigned_br = $br;
        //         }else{
        //             $bruser_assigned_br = array($brselected);
        //         }
        //     }else{
        //         $bruser_assigned_br = array($bruser);
        //     }
        //     $divisionid = $this->session->userdata('user_division');
        //     $stateid = $this->session->userdata('user_state');
        //     $qcl .=" and mxemp_emp_division_code = $divisionid";
        //     $qcl .=" and mxemp_emp_state_code = $stateid";
        //     $qcl .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        // }

            $qcl .=" and mxemp_emp_division_code = $divisionid";
            $qcl .=" and mxemp_emp_state_code = $stateid";
            $qcl .=" and mxemp_emp_branch_code = $branchid";
        $querycl = $this->db->query($qcl);
        return $querycl->result_array();
    }

    public function getcircular_summary(){
        $departmentid = $this->session->userdata('session_department');

        $this->db->select('
            mx_cr_application as applicationno,
            mx_cr_no as circular_no,
            mx_cr_title as circular_title,
            mx_cr_tags_desc as circular_description,
            mx_cr_file as circular_file,
            mxemp_emp_fname,mx_cr_createdtime,mx_cr_createdby,mxemp_emp_img
        ');

        $this->db->from('maxwell_circular_master');
        $this->db->join('maxwell_employees_info', 'mx_cr_createdby = mxemp_emp_id', 'LEFT');
        $this->db->where('mx_cr_status', 1);

        $this->db->group_start();
            $this->db->where('mx_cr_department', '9999');
            $this->db->or_where('mx_cr_department', $departmentid);
        $this->db->group_end();

        $this->db->order_by('mx_cr_id', 'desc');

        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function getnotification_summary(){
        $departmentid = $this->session->userdata('session_department');

        $this->db->select('
            mx_ntf_title as notification_title,
            mx_ntf_tags_desc as notification_description,
            mx_ntf_file as notification_file,
            mx_ntf_createdtime as notificationcreateddate,
            mxemp_emp_fname,mx_ntf_createdby,mxemp_emp_img
        ');

        $this->db->from('maxwell_notification_master');
        $this->db->join('maxwell_employees_info', 'mx_ntf_createdby = mxemp_emp_id', 'LEFT');
        $this->db->where('mx_ntf_status', 1);

        $this->db->group_start();
            $this->db->where('mx_ntf_department', '9999');
            $this->db->or_where('mx_ntf_department', $departmentid);
        $this->db->group_end();

        $this->db->order_by('mx_ntf_createdtime', 'desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function birthdays_summary(){
        $companyid = $this->session->userdata('session_company');
        $divisionid = $this->session->userdata('session_division');
        $stateid = $this->session->userdata('session_state');
        $branchid = $this->session->userdata('session_branch');
        $qb ="select mxemp_emp_id as employeecode, mxemp_emp_fname as name, mxemp_emp_img as image, mxemp_emp_date_of_birth, mxemp_emp_email_id as email from maxwell_employees_info 
        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
        where MONTH(mxemp_emp_date_of_birth) = MONTH(CURDATE()) and DAY(mxemp_emp_date_of_birth) >= DAY(CURDATE()) and mxemp_emp_resignation_status !='R'";
        // if($this->session->userdata('user_limiteddropdowns') == 1){
        //     $bruser = $this->session->userdata('user_branch');
        //     $brselected = $this->session->userdata('user_custom_branches');
        //     if(isset($brselected) && !empty($brselected)){
        //         $br = explode(',',$brselected);
        //         if(count($br)>0){
        //             $bruser_assigned_br = $br;
        //         }else{
        //             $bruser_assigned_br = array($brselected);
        //         }
        //     }else{
        //         $bruser_assigned_br = array($bruser);
        //     }
        //     $divisionid = $this->session->userdata('user_division');
        //     $stateid = $this->session->userdata('user_state');
        //     $qb .=" and mxemp_emp_division_code = $divisionid";
        //     $qb .=" and mxemp_emp_state_code = $stateid";
        //     $qb .= " and mxemp_emp_branch_code in ('" . implode("','", $bruser_assigned_br) . "')";
        // }
            $qb .=" and mxemp_emp_division_code = $divisionid";
            $qb .=" and mxemp_emp_state_code = $stateid";
            $qb .=" and mxemp_emp_branch_code = $branchid";
        $qb .=" ORDER BY DAY(mxemp_emp_date_of_birth)";
        $queryb = $this->db->query($qb);
        return $queryb->result_array();
    }

    public function paysheet_summary(){

        $yearmonth = date('Ym', strtotime('-1 month'));
        $employeecode   = $this->session->userdata('session_loginperson_id');
        $employeetypeid = $this->session->userdata('session_typeid');
        $companyid      = $this->session->userdata('session_company');

        // STEP 1: Get dynamic table name
        $this->db->select('mxemp_ty_table_name');
        $this->db->from('maxwell_employee_type_master');
        $this->db->where('mxemp_ty_cmpid', $companyid);
        $this->db->where('mxemp_ty_id', $employeetypeid);
        $this->db->where('mxemp_ty_status', 1);

        $query = $this->db->get();
        $result = $query->row_array();

        if(empty($result)){
            return array(
                'workingdays' => 0,
                'monthyear' => '',
                'salarystatus' => 'Not Disbursed'
            );
        }

        $tableName = $result['mxemp_ty_table_name'];

        // STEP 2: Get salary data
        $this->db->select('mxsal_present_days, mxsal_year_month');
        $this->db->from($tableName);
        $this->db->where('mxsal_emp_code', $employeecode);
        $this->db->where('mxsal_year_month', $yearmonth);

        $query2 = $this->db->get();
        $row = $query2->row_array();

        // STEP 3: Format response
        if(!empty($row)){

            $ym = $row['mxsal_year_month'];

            $monthYear = date('F Y', strtotime($ym . '01'));

            return array(
                'workingdays'  => (int)$row['mxsal_present_days'],
                'monthyear'    => $monthYear,
                'salarystatus' => 'Disbursed'
            );

        } else {

            return array(
                'workingdays'  => 0,
                'monthyear' => date('F Y', strtotime('-1 month')),
                'salarystatus' => 'Not Disbursed'
            );
        }
    }

    # Manager Dash Board Start
    public function get_employee_attendance_calendar($employee_codes = [], $month = null, $year = null, $company = null, $division = null, $state = null, $branch = null){
        if(empty($employee_codes)){
            return [];
        }

        $month = $month ?: date('m');
        $year  = $year ?: date('Y');

        $table = 'maxwell_attendance_' . $year . '_' . sprintf('%02d', $month);

        $this->db->select('
            mxemp_emp_fname,
            mxemp_emp_img,
            mx_attendance_emp_code,
            mx_attendance_date,
            mx_attendance_first_half,
            mx_attendance_second_half,
            mx_attendance_first_half_punch,
            mx_attendance_second_half_punch,
            mxcp_name as companyname,
            mxd_name as divisionname,
            mxst_state as statename,
            mxb_name as branchname
        ');

        $this->db->from($table);
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mx_attendance_emp_code','inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->where_in('mx_attendance_emp_code', $employee_codes);
        if(!empty($company)){
            $this->db->where('mx_attendance_cmp_id', $company);
        }
        if(!empty($division)){
            $this->db->where('mx_attendance_division_id', $division);
        }
        if(!empty($state)){
            $this->db->where('mx_attendance_state_id', $state);
        }
        if(!empty($branch)){
             $this->db->where('mx_attendance_branch_id', $branch);
        }
        $this->db->order_by('mx_attendance_emp_code,mx_attendance_date', 'ASC');

        $query = $this->db->get();
        #echo $this->db->last_query();exit;
        $result = $query->result_array();


        $leaveTypes = ['SHRT', 'CL', 'EL', 'ML', 'SL'];
        $abesnt = ['AB','LOP'];
        $regulations = ['AR','OT','OD'];
        $weekoff = ['WO'];


        $calendar = [];

        foreach($result as $row){

            $empCode = $row['mx_attendance_emp_code'];
            $empName = $row['mxemp_emp_fname'];
            $empImage = $row['mxemp_emp_img'];
            $date    = date('j', strtotime($row['mx_attendance_date']));

            // DEFAULT STATUS
            $status = 'present';
            $class  = 'green';

            // CHECK HALF STATUS
            $firstHalf  = trim($row['mx_attendance_first_half']);
            $secondHalf = trim($row['mx_attendance_second_half']);

            // ABSENT
            if(in_array(strtoupper($firstHalf), $abesnt) || in_array(strtoupper($secondHalf), $abesnt)){
                $status = 'absent';
                $class  = 'red';
            }

            // LEAVE
            elseif (in_array(strtoupper($firstHalf), $leaveTypes) || in_array(strtoupper($secondHalf), $leaveTypes)) {
                $status = 'leave';
                $class  = 'orange';
            }

            // HALF DAY
            elseif($firstHalf != $secondHalf){
                $status = 'halfday';
                $class  = 'purple';
            }

            // regulations
            elseif(in_array(strtoupper($firstHalf), $regulations) || in_array(strtoupper($secondHalf), $regulations)){
                $status = 'wfh';
                $class  = 'blue';
            }
            elseif(in_array(strtoupper($firstHalf), $weekoff) || in_array(strtoupper($secondHalf), $weekoff)){
                $status = 'wfh';
                $class  = 'weekend';
            }

            $allPunches = array();

            // FIRST HALF PUNCHES
            if (!empty($row['mx_attendance_first_half_punch'])) {

                $firstHalfPunches = explode(',', $row['mx_attendance_first_half_punch']);

                $allPunches = array_merge($allPunches, $firstHalfPunches);
            }

            // SECOND HALF PUNCHES
            if (!empty($row['mx_attendance_second_half_punch'])) {

                $secondHalfPunches = explode(',', $row['mx_attendance_second_half_punch']);

                $allPunches = array_merge($allPunches, $secondHalfPunches);
            }

            // REMOVE EMPTY VALUES
            $allPunches = array_filter($allPunches);

            // SORT TIME
            sort($allPunches);

            // FIRST & LAST PUNCH
            $firstPunch = !empty($allPunches) ? reset($allPunches) : '';
            $lastPunch  = !empty($allPunches) ? end($allPunches) : '';

            $calendar[$empCode][$date] = [
                'employeeCode' => $empCode,
                'name' => $empName,
                'img' => $empImage,
                'day'          => $date,
                'status'       => $status,
                'class'        => $class,
                'first_half'   => $row['mx_attendance_first_half'],
                'second_half'  => $row['mx_attendance_second_half'],
                'first_punch'  => $firstPunch,
                'second_punch' => $lastPunch,
                'year' => $year,
                'month' => $month,
                'companyname' => $row['companyname'],
                'divisionname' => $row['divisionname'],
                'statename' => $row['statename'],
                'branchname' => $row['branchname'],
            ];
        }

        return $calendar;
    }

    public function get_employee_attendance_Regulations($employee_codes = [], $month = null, $year = null){
        if (empty($employee_codes)) {
            return [];
        }

        $month = $month ?: date('m');
        $year  = $year ?: date('Y');

        // Date range
        $start_date = "$year-$month-01";
        $end_date   = date("Y-m-t", strtotime($start_date));

        // Create placeholders for employee codes
        $employee_codes_str = "'" . implode("','", $employee_codes) . "'";

        $qrlmreg = "
            SELECT 
                mxemp_emp_fname AS name, 
                mxemp_emp_img AS image, 
                mxar_appliedby_emp_code AS employeecode, 
                mxar_type AS type,
                SUM(CASE WHEN mxar_authfinal_status = 9 THEN mxar_attend_countdays ELSE 0 END) AS pending,
                SUM(CASE WHEN mxar_authfinal_status = 3 THEN mxar_attend_countdays ELSE 0 END) AS revert, 
                SUM(CASE WHEN mxar_authfinal_status = 1 THEN mxar_attend_countdays ELSE 0 END) AS approved, 
                SUM(CASE WHEN mxar_authfinal_status = 2 THEN mxar_attend_countdays ELSE 0 END) AS rejected,
                SUM(mxar_attend_countdays) AS total_days 
            FROM attendance_regulation 
            INNER JOIN maxwell_employees_info ON mxar_appliedby_emp_code = mxemp_emp_id
            INNER JOIN maxwell_branch_master ON mxb_id = mxemp_emp_branch_code
            INNER JOIN maxwell_state_master ON mxst_id = mxemp_emp_state_code
            INNER JOIN maxwell_division_master ON mxd_id = mxemp_emp_division_code
            WHERE 
                mxar_from >= '$start_date' 
                AND mxar_to <= '$end_date'
                AND mxar_appliedby_emp_code IN ($employee_codes_str)
                AND mxar_status = 1
            GROUP BY mxar_appliedby_emp_code, mxar_type
            ORDER BY mxar_createdtime DESC";
            // echo $qrlmreg; exit;
        $query = $this->db->query($qrlmreg);
        return $query->result_array();
    }

    # Manager Dash Board Ends

}