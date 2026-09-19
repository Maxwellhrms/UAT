<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class EmployeeModel extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('DashBoardModel');
        $this->load->model('CommonModel');
    }
    
    public function checkloginaccess($data){
        $employeeCode = $data['employeeCode'];
        $password = $data['password'];
        $count = 0;
        
        $this->db->select('mxemp_emp_lg_employee_id,mxemp_emp_lg_fullname,mxemp_emp_lg_role,maxuser_roles_add,maxuser_roles_edit,maxuser_roles_delete,mxemp_emp_inbranch,mxemp_emp_custom_branch,mxemp_emp_img,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_state_code,mxemp_emp_branch_code,mxemp_emp_dept_code,mxemp_emp_type');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_user_roles', 'maxuser_roles_id = mxemp_emp_lg_role', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeCode);
        $this->db->where('mxemp_emp_lg_password', $password);
        $this->db->where('mxemp_emp_lg_desktop_status = 1');
        $this->db->where('mxemp_emp_lg_desktop_permissions = 1');
        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->where('mxemp_emp_status', 1);
        $query = $this->db->get();
        $count = count($query->row());
        #echo $this->db->last_query();exit;
        if($count == 1){
            $qry = $query->result();
            if(empty($qry[0]->mxemp_emp_img)){
                $userimg = base_url().'assets/img/user.jpg';
            }else{
                $userimg = HRADMINROOTDOCUMENT.$qry[0]->mxemp_emp_img;
            }
            $this->session->set_userdata('session_loginperson_id', $qry[0]->mxemp_emp_lg_employee_id);
            $this->session->set_userdata('session_company', $qry[0]->mxemp_emp_comp_code);
            $this->session->set_userdata('session_division', $qry[0]->mxemp_emp_division_code);
            $this->session->set_userdata('session_state', $qry[0]->mxemp_emp_state_code);
            $this->session->set_userdata('session_branch', $qry[0]->mxemp_emp_branch_code);
            $this->session->set_userdata('session_name', $qry[0]->mxemp_emp_lg_fullname);
            $this->session->set_userdata('session_types', $qry[0]->mxemp_emp_lg_role);
            $this->session->set_userdata('session_email', $qry[0]->Email);
            $this->session->set_userdata('session_department', $qry[0]->mxemp_emp_dept_code);
            $this->session->set_userdata('is_session_active', 1);
            $this->session->set_userdata('session_img', $userimg);
            $this->session->set_userdata('session_typeid', $qry[0]->mxemp_emp_type);

            $empcount = $this->getemployeeidsassignedtomanagers();
            if(count($empcount) > 0){
                $this->session->set_userdata('is_approvals', 1);
            }else{
                $this->session->set_userdata('is_approvals', 0);
            }

            $loanscount = $this->getloanscount($qry[0]->mxemp_emp_lg_employee_id);
            if($loanscount > 0){
                $this->session->set_userdata('is_loans', 1);
            }else{
                $this->session->set_userdata('is_loans', 0);
            }

            $emp_id=$qry[0]->mxemp_emp_lg_employee_id;
            $insert_date=date('Y-m-d');
            if(IP != '103.152.184.207'){
            $data=$this->db->query("INSERT INTO login_attempts (emp_id, login_date)VALUES ('$emp_id', '$insert_date');"); 
            }
           echo $resp = json_encode(array('statusCode' => 200, 'message' => 'Success'));
            }else{
           echo $resp = json_encode(array('statusCode' => 400, 'errorMsg' => 'Invalid Details or You Dont Have Access'));
        }

    }

    # Start Policy Info
    public function pendingPolicies($emp_id){
        // Total active policies
        $total = $this->db
            ->where('status', 1) // if you have status column
            ->count_all_results('maxwell_employees_policies'); // master policy table

        // Policies acknowledged by employee
        $acknowledged = $this->db
            ->where('mx_emp_id_fk', $emp_id)
            ->count_all_results('maxwell_employees_policy_activity');

        //echo $total."-----".$acknowledged;exit();

        return max(0, $total - $acknowledged);
    }

    public function get_all_policies(){
        return $this->db
            ->where('status', 1)
            ->order_by('id', 'ASC')
            ->get('maxwell_employees_policies')
            ->result();
    }

    public function get_acknowledged_policy_ids($emp_id){
        $sql =  $this->db
            ->select('policy_id_fk')
            ->where('mx_emp_id_fk', $emp_id)
            ->get('maxwell_employees_policy_activity');
        // echo $this->db->last_query();exit();
            return $sql->result_array();

        //return array_column($rows, 'policy_id_fk');
    }
    
    public function is_already_acknowledged($emp_id, $policy_id){
        return $this->db
                ->where('mx_emp_id_fk', $emp_id)
                ->where('policy_id_fk', $policy_id)
                ->count_all_results('maxwell_employees_policy_activity') > 0;
    }

    public function save_acknowledgment($data){
        return $this->db->insert(
            'maxwell_employees_policy_activity',
            $data
        );
    }
    # End Policy Info

    #Attendance History
    public function calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate){
        $firstpunch = $attendancedate.' '.$userfirstpunch;
        $lastpunch = $attendancedate.' '.$userlastpunch;
        $d1 = new DateTime($firstpunch);
        $d2 = new DateTime($lastpunch);
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1
        return $diffInHours . ':' .$diffInMinutes;
    }


public function getAttendanceDashboard(){
    $employeeid = $this->session->userdata('session_loginperson_id');
    $year = date('Y');
    $tablename = 'employee_punches_' . $year;

    $today = date('Y-m-d');
    $week_start = date('Y-m-d', strtotime('monday this week'));
    $month_start = date('Y-m-01');
    $month_end = date('Y-m-t'); //  FULL MONTH END

    // Targets
    $daily_target = 8.5;
    $weekly_target = 8.5 * 6;

    // Fetch data
    $this->db->select('attendance_date, attendance_time');
    $this->db->from($tablename);
    $this->db->where('employee_code', $employeeid);
    $this->db->order_by('attendance_date, attendance_time');

    $allData = $this->db->get()->result();

    $daily = [];

    // FIX: proper datetime handling
    foreach ($allData as $row) {
        $date = $row->attendance_date;

        if (strlen($row->attendance_time) > 8) {
            $time = strtotime($row->attendance_time);
        } else {
            $time = strtotime($row->attendance_date . ' ' . $row->attendance_time);
        }

        if (!isset($daily[$date])) {
            $daily[$date] = ['min' => $time, 'max' => $time];
        } else {
            if ($time < $daily[$date]['min']) $daily[$date]['min'] = $time;
            if ($time > $daily[$date]['max']) $daily[$date]['max'] = $time;
        }
    }

    // Helper: calculate hours
    $calcHours = function ($from, $to) use ($daily) {
        $total = 0;

        foreach ($daily as $date => $d) {
            if ($date >= $from && $date <= $to && $d['min'] != $d['max']) {
                $total += ($d['max'] - $d['min']);
            }
        }

        return $total / 3600;
    };

    $today_hours = $calcHours($today, $today);
    $week_hours  = $calcHours($week_start, $today);
    $month_hours = $calcHours($month_start, $today);

    // FULL MONTH WORKING DAYS (Mon–Sat)
    $workingDays = 0;
    $temp = $month_start;

    while (strtotime($temp) <= strtotime($month_end)) {
        if (date('N', strtotime($temp)) != 7) { // exclude Sunday
            $workingDays++;
        }
        $temp = date('Y-m-d', strtotime($temp . ' +1 day'));
    }

    $monthly_target = $workingDays * $daily_target;

    // OVERTIME
    $total_overtime = 0;

    foreach ($daily as $date => $d) {
        if ($d['min'] != $d['max']) {
            $worked = ($d['max'] - $d['min']) / 3600;

            if ($worked > $daily_target) {
                $total_overtime += ($worked - $daily_target);
            }
        }
    }

    $formatHours = function ($hours) {
        $totalSeconds = floor($hours * 3600); //  no rounding

        $h = floor($totalSeconds / 3600);
        $m = floor(($totalSeconds % 3600) / 60);

        return sprintf('%02d:%02d', $h, $m);
    };
    //  FINAL STATISTICS
    $statistics = [
        'today' => [
            'worked' => $formatHours($today_hours),
            'target' => $formatHours($daily_target),
            'remaining' => $formatHours(max(0, $daily_target - $today_hours)),
            'percentage' => ($daily_target > 0) 
                ? min(100, round(($today_hours / $daily_target) * 100, 2)) 
                : 0
        ],
        'week' => [
            'worked' => $formatHours($week_hours),
            'target' => $formatHours($weekly_target),
            'remaining' => $formatHours(max(0, $weekly_target - $week_hours)),
            'percentage' => ($weekly_target > 0) 
                ? min(100, round(($week_hours / $weekly_target) * 100, 2)) 
                : 0
        ],
        'month' => [
            'worked' => $formatHours($month_hours),
            'target' => $formatHours($monthly_target),
            'remaining' => $formatHours(max(0, $monthly_target - $month_hours)),
            'percentage' => ($monthly_target > 0) 
                ? min(100, round(($month_hours / $monthly_target) * 100, 2)) 
                : 0
        ],
        'overtime' => [
            'worked' => $formatHours($total_overtime),
            'target' => 0,
            'remaining' => 0,
            'percentage' => 0
        ]
    ];

    return [
        'statistics' => $statistics
    ];
}

    public function punch_history(){

        $month = date('m');
        $year = date('Y');
        $empcode = $this->session->userdata('session_loginperson_id');
        $attandace_date = date('Y-m-d');
        //  if (strlen($month) == 1) {
        //     $month = '0' . $this->cleanInput($data['month']);
        // }

        $this->db->select('mx_attendance_cmp_id,mx_attendance_date,mx_attendance_first_half,mx_attendance_second_half,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type');
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->where('mx_attendance_emp_code',$empcode);
        $this->db->where('mx_attendance_date',$attandace_date);
        $query = $this->db->get();
        $qry = $query->result();

        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$qry[0]->mx_attendance_cmp_id);
        $querys = $this->db->get();
        $qry1 = $querys->result();
        if(!empty($qry[0]->mx_attendance_second_half_punch)){
        $employeepunches = $qry[0]->mx_attendance_first_half_punch.','.$qry[0]->mx_attendance_second_half_punch;
        }else{
        $employeepunches = $qry[0]->mx_attendance_first_half_punch;    
        }
        if(!empty($employeepunches)){
            $punchtime = $employeepunches;
            $getallpunches = explode(',', $punchtime);
           
            $userfirstpunch = $getallpunches[0];
            $userlastpunch = $getallpunches[count($getallpunches) - 1];
            $entrytypes = explode(',', $qry[0]->mx_attendance_entry_type);
            
            if(empty($userfirstpunch)){
            $userfirstpunch = $userlastpunch;
            }
            
            $resp['firstpunch'] = $userfirstpunch;
            $resp['lastpunch'] = $userlastpunch;
            $resp['attendance'] = $attandace_date;
            $resp['type'] = $entrytypes;
            if(!empty($userfirstpunch) && !empty($userlastpunch)){
            $resp['total'] = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attandace_date);
            }else{
            $resp['total'] = '';
            }
            $resp['punches'] = $getallpunches;
            if(strtotime($userlastpunch) > strtotime($qry1[0]->mxcp_logoff_time)){
                $userfirstpunch = $qry1[0]->mxcp_logoff_time;
                $resp['ot'] = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attandace_date);
            }
        }else{
            $resp['firstpunch'] = '';
            $resp['lastpunch'] = '';
            $resp['attendance'] = '';
            $resp['total'] = '';
            $resp['punches'] = array();
            $resp['type'] = array();
            $resp['ot'] = '';
        }
        return $resp;       
    }

    public function currentattendanceList($data){
        $employeeid = $this->session->userdata('session_loginperson_id');
        $attendancedate = $data['fromdate'];
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        $tablename = 'employee_punches_' . $year;
        $attendance_table = 'maxwell_attendance_' . $year . '_' . $month;
          
        $this->db->select('id,employee_code,mxemp_emp_fname,mxemp_emp_lname,attendance_date,attendance_time,entry_type, MIN(attendance_time) as first_punch,
    CASE 
        WHEN MIN(attendance_time) = MAX(attendance_time) 
        THEN NULL 
        ELSE MAX(attendance_time) 
    END as last_punch,mx_attendance_first_half,mx_attendance_second_half');
        $this->db->from($tablename);
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = employee_code', 'INNER');
        $this->db->join($attendance_table, 'mx_attendance_emp_code = employee_code AND mx_attendance_date = attendance_date', 'LEFT');
        $this->db->where('employee_code', $employeeid);
        if (!empty($data['fromdate'])) {
            $this->db->where('attendance_date >=', date('Y-m-d',strtotime($data['fromdate'])) . ' 00:00:00');
        }
        if (!empty($data['todate'])) {
            $this->db->where('attendance_date <=', date('Y-m-d',strtotime($data['todate'])) . ' 23:59:59');
        }
        $this->db->group_by('attendance_date');
        $this->db->order_by('attendance_date','DESC');
        $query1 = $this->db->get();
        // echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();

       $retrunarray = array();

        foreach ($qry1 as $key => $val){
            $buldarray = (object)array(
                "employee_code" => $val->employee_code,
                "mxemp_emp_fname" => $val->mxemp_emp_fname.' '.$val->mxemp_emp_lname,
                "attendance_date" => $val->attendance_date,
                "first_punch" => !empty($val->first_punch) ? date('H:i:s', strtotime($val->first_punch)) : 'N/A',
                "mx_attendance_first_half" => $val->mx_attendance_first_half,
                "last_punch" => !empty($val->last_punch) ? date('H:i:s', strtotime($val->last_punch)) : 'N/A',
                "mx_attendance_second_half" => $val->mx_attendance_second_half,
                "id" => $val->id,
                );
            array_push($retrunarray,$buldarray);   
        }
        // return $retrunarray;   
        $columns = [
            'employee_code',
            'mxemp_emp_fname',
            'attendance_date',
            'first_punch',
            'mx_attendance_first_half',
            'last_punch',
            'mx_attendance_second_half',
            // 'id'
        ]; 

        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'attendance_date' => 'Attendance Date',
            'first_punch' => 'First Punch Time',
            'mx_attendance_first_half' => 'First Punch',
            'last_punch' => 'Last Punch Time',
            'mx_attendance_second_half' => 'Last Punch',
            // 'id' => 'Edit'
        ]; 

        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );

        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array('id'); // Columns with edit options
        // $editColumns = array(
        //     'id' => array(
        //         'AddFunction' => 'editAttendance',
        //         'AddModelFunction' => 'loadAttendanceData',
        //         'CallID' => 'attendanceModal'
        //     )
        // );
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Employees Punch History';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        // print_r($processData);exit;
        echo dynamicTable($processData);

    }

    public function getPresentAttendance(){
        $year = date('Y');
        $month = date('m');
        $emp_code = $this->session->userdata('session_loginperson_id');

        $this->db->select("
            SUM(
                (CASE WHEN mx_attendance_first_half = 'PR' THEN 0.5 ELSE 0 END) +
                (CASE WHEN mx_attendance_second_half = 'PR' THEN 0.5 ELSE 0 END)
            ) as total_pr_days
        ");
        $this->db->from("maxwell_attendance_" . $year . "_" . $month);
        $this->db->where("mx_attendance_status", 1);
        $this->db->where("mx_attendance_emp_code", $emp_code);

        $query = $this->db->get();
        $result = $query->row();

        $total_pr_days = $result->total_pr_days ?? 0;

        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $percentage = 0;
        if ($total_days > 0) {
            $percentage = ($total_pr_days / $total_days) * 100;
        }

        return array(
            'totalPR'     => $total_pr_days,
            'totalDays'   => $total_days,
            'percentage'  => round($percentage, 2)
        );
    }
    #Attendance History

    #Payslips
    public function employeespayslipsList($data){

        $employeeid = $this->session->userdata('session_loginperson_id');
        $empname    = $this->session->userdata('session_name');
        $yearFilter = !empty($data['year']) ? $data['year'] : '';

        // ✅ Correct server path
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/payslips/';

        if (!is_dir($path)) {
            echo "Payslip directory not found";
            return;
        }

        $files = scandir($path);

        $retrunarray = [];

        foreach ($files as $file) {

            if ($file == '.' || $file == '..') continue;

            // Match: 04-2025-M0170.pdf
            if (preg_match('/(\d{2})-(\d{4})-(.+)\.pdf$/', $file, $parts)) {

                $month   = $parts[1];
                $year    = $parts[2];
                $empCode = $parts[3];

                if ($empCode != $employeeid) continue;
                if (!empty($yearFilter) && $year != $yearFilter) continue;

                $fileDate = strtotime($year . '-' . $month . '-01');

                $downloadUrl = base_url('Employee/downloadPayslip?file='.$file);

                $retrunarray[] = (object)[
                    "employee_code" => $empCode,
                    "employee_name" => $empname,
                    "payslip_month" => date('F Y', $fileDate),
                    "download" => '<a href="'.$downloadUrl.'" class="btn btn-sm btn-danger" title="Download Payslip"><i class="fa fa-file-pdf-o"></i></a>'
                ];
            }
        }

        // Sort latest first
        usort($retrunarray, function($a, $b){
            return strtotime($b->payslip_month) - strtotime($a->payslip_month);
        });

        $columns = [
            'employee_code',
            'employee_name',
            'payslip_month',
            'download'
        ];

        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'employee_name' => 'Employee Name',
            'payslip_month' => 'Payslip Month',
            'download'      => 'Download'
        ];

        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => [],
            'editColumns' => [],
            'dataMappingColumns' => ['Translate' => []],
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => [],
            'reportName' => 'Employee Payslips',
            'hideInExport' => ['download'],
        );

        echo dynamicTable($processData);
    }
    #Payslips

    #Password
    public function UpdatePassword($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $cnfpswd = trim($data['confirmpassword']);
        $newpswd = trim($data['newpassword']);
        $oldpswd = trim($data['oldpassword']);

        $this->db->select('mxemp_emp_lg_password,mxemp_emp_lg_employee_id,mxemp_emp_lg_id');
        $this->db->from('maxwell_employees_login');
        $this->db->where('mxemp_emp_lg_employee_id',$employeecode);
        $query = $this->db->get();
        $qry = $query->result();

        $newdate=date('Y-m-d');
        if($qry[0]->mxemp_emp_lg_password != $oldpswd){
            $resp = array('statusCode' => 400, 'errorMsg' => 'Entered Oldpassword Not Matching');
        }else if($newpswd != $cnfpswd){
            $resp = array('statusCode' => 400, 'errorMsg' => 'Entered NewPassword and ConfirmPassword Not Matching');
        }else{
            $uparray = array(
                "mxemp_emp_lg_password" => $cnfpswd,
                "first_time_passowrd_change" => '1',
                "every_days_passowrd_change" => $newdate
            );
            $this->db->where('mxemp_emp_lg_id', $qry[0]->mxemp_emp_lg_id);
            $this->db->where('mxemp_emp_lg_employee_id', $employeecode);
            $this->db->update('maxwell_employees_login', $uparray);
            $resp = array('statusCode' => 200, 'message' => 'Success');
        }
        echo json_encode($resp);
    }
    #Password
    public function getemployeecompletedetails(){
        $employeecode = $this->session->userdata('session_loginperson_id');
        // Employee Info
        $this->db->select('mxemp_emp_autouniqueid,mxemp_emp_date_of_join,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_branch_code,mxemp_emp_sub_branch_code,mxemp_emp_dept_code,mxemp_emp_grade_code,mxemp_emp_desg_code,mxemp_emp_state_code,mxemp_emp_type,mxemp_emp_type_name,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxemp_emp_gender,mxemp_emp_marital_status,mxemp_emp_bloodgroup,mxemp_emp_phone_no,mxemp_emp_alt_phn_no,mxemp_emp_email_id,mxemp_emp_company_email_id,mxemp_emp_date_of_birth,mxemp_emp_mother_tongue,mxemp_emp_caste,mxemp_emp_age,mxemp_emp_empguarantorsdetails,mxemp_emp_license,mxemp_emp_present_address1,mxemp_emp_present_address2,mxemp_emp_present_city,mxemp_emp_present_state,mxemp_emp_present_country,mxemp_emp_present_postalcode,mxemp_emp_fixed_address1,mxemp_emp_fixed_address2,mxemp_emp_fixed_city,mxemp_emp_fixed_state,mxemp_emp_fixed_country,mxemp_emp_fixed_postalcode,mxemp_emp_current_salary,mxemp_emp_bank_name,mxemp_emp_bank_branch_name,mxemp_emp_bank_acc_no,mxemp_emp_bank_ifsci_no,mxemp_emp_panno,mxemp_emp_esi_number,mxemp_emp_pf_number,mxemp_emp_uan_number,mxemp_emp_status,mxcp_name,mxdesg_name,mxdpt_name,mxd_name,mxb_name,mxgrd_name,mxemp_emp_having_vehicle,mxemp_emp_vehicle_type,mxemp_emp_resignation_status,mxemp_emp_resignation_reason,mxemp_emp_resignation_date,mxemp_emp_resignation_relieving_date,mxemp_emp_resignation_relieving_settlement_date,mxemp_emp_resignation_relieving_settlement_amount,mxemp_emp_resignation_relieving_esi_settlement_date,mxemp_emp_resignation_relieving_pf_settlement_date,mxemp_emp_panimage,mxemp_emp_aadhar,mxemp_emp_aadharimage,mxst_state,mxemp_ty_name,mxemp_emp_guarantors_letter,empmaritaldate,mxemp_emp_is_without_notice_period,mxemp_emp_unpay_sal_months,mxemp_emp_joiningorgination,mxemp_emp_joiningorginationofferpackage,mxemp_emp_joiningorginationdesignation,mxemp_emp_resignationletter,mxemp_emp_employee_lic_no,mxemp_emp_gratuity,mxemp_emp_esiimage,mxemp_emp_bankimage,mxemp_emp_nameasperbank,mxemp_emp_lic_info1,mxemp_emp_lic_info2,mxemp_emp_lic_info3,mxemp_emp_lic_info4,mxemp_emp_relation_name,mxemp_emp_relation,mxemp_emp_esi_reason,mxemp_emp_resignation_pf_reason');
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->join('maxwell_employee_type_master', 'mxemp_ty_id = mxemp_emp_type', 'INNER');
        $this->db->where('mxemp_emp_id', $employeecode);
        $query1 = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry1 = $query1->result();
        $returnarray['employeeinfo'] = $qry1;
        // Employee Info

        // Academic Records
        $returnarray['employeeacr'] = $this->academicRecords($qry1[0]->mxemp_emp_id);
        // Academic Records

        // Training
        $returnarray['employeetr'] = $this->training($qry1[0]->mxemp_emp_id);
        // Training

        // Family
        $returnarray['employeefm'] = $this->family($qry1[0]->mxemp_emp_id);
        // Family

        // Previous Employments
        $returnarray['employeepe'] = $this->previousEmployments($qry1[0]->mxemp_emp_id);
        // Previous Employments

        // Nominee Details
        $returnarray['employeenominee'] = $this->nomineeDetails($qry1[0]->mxemp_emp_id);
        // Nominee Details

        // Languages Details
        $returnarray['employeelanaguages'] = $this->languagesDetails($qry1[0]->mxemp_emp_id);
        // Languages Details
        
        $year = date('Y');
        $today = date('Y-m-d');
        $tablename = 'employee_punches_' . $year;

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
        $this->db->where('mxauth_emp_code', $qry1[0]->mxemp_emp_id);
        $this->db->order_by("mxauth_status", "desc");

        $query7 = $this->db->get();
        $returnarray['authorization'] = $query7->result();
        return $returnarray;
    }

    public function academicRecords($emp_id, $id = ''){
        $this->db->select('mxemp_emp_acr_id,mxemp_emp_acr_employee_id,mxemp_emp_acr_type,mxemp_emp_acr_yop,mxemp_emp_acr_institution,mxemp_emp_acr_subject,mxemp_emp_acr_university,mxemp_emp_acr_marks');
        $this->db->from('maxwell_employees_academic_records');
        $this->db->where('mxemp_emp_acr_employee_id', $emp_id);
        if(!empty($id)){
        $this->db->where('mxemp_emp_acr_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function training($emp_id, $id = ''){
        $this->db->select('mxemp_emp_tr_id,mxemp_emp_tr_employee_id,mxemp_emp_tr_nameofcourse,mxemp_emp_tr_nameofinstutions,mxemp_emp_tr_fromdate,mxemp_emp_tr_todate');
        $this->db->from('maxwell_employees_training');
        $this->db->where('mxemp_emp_tr_employee_id', $emp_id);
        if(!empty($id)){
        $this->db->where('mxemp_emp_tr_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function family($emp_id, $id = ''){
        $this->db->select("
            f.mxemp_emp_fm_id,
            f.mxemp_emp_fm_employee_id,

            /* TITLE */
            CASE
                WHEN r.status IN (0, 2)
                    AND r.status IS NOT NULL
                    AND (
                        SELECT COUNT(*)
                        FROM maxwell_employee_familyinfo_request r1
                        WHERE r1.reference_id = f.mxemp_emp_fm_id
                        AND r1.field_name = 'mxemp_emp_fm_title'
                        AND r1.status = r.status
                    ) > 0
                THEN (
                    SELECT r1.new_value
                    FROM maxwell_employee_familyinfo_request r1
                    WHERE r1.reference_id = f.mxemp_emp_fm_id
                    AND r1.field_name = 'mxemp_emp_fm_title'
                    AND r1.status = r.status
                    ORDER BY r1.id DESC
                    LIMIT 1
                )
                ELSE f.mxemp_emp_fm_title
            END AS mxemp_emp_fm_title,

            /* RELATION */
            CASE
                WHEN r.status IN (0, 2)
                THEN COALESCE(
                    (
                        SELECT r1.new_value
                        FROM maxwell_employee_familyinfo_request r1
                        WHERE r1.reference_id = f.mxemp_emp_fm_id
                        AND r1.field_name = 'mxemp_emp_fm_relation'
                        AND r1.status = r.status
                        ORDER BY r1.id DESC
                        LIMIT 1
                    ),
                    f.mxemp_emp_fm_relation
                )
                ELSE f.mxemp_emp_fm_relation
            END AS mxemp_emp_fm_relation,

            /* NAME */
            CASE
                WHEN r.status IN (0, 2)
                THEN COALESCE(
                    (
                        SELECT r1.new_value
                        FROM maxwell_employee_familyinfo_request r1
                        WHERE r1.reference_id = f.mxemp_emp_fm_id
                        AND r1.field_name = 'mxemp_emp_fm_name'
                        AND r1.status = r.status
                        ORDER BY r1.id DESC
                        LIMIT 1
                    ),
                    f.mxemp_emp_fm_name
                )
                ELSE f.mxemp_emp_fm_name
            END AS mxemp_emp_fm_name,

            /* AGE / DATE OF BIRTH */
            CASE
                WHEN r.status IN (0, 2)
                THEN COALESCE(
                    (
                        SELECT r1.new_value
                        FROM maxwell_employee_familyinfo_request r1
                        WHERE r1.reference_id = f.mxemp_emp_fm_id
                        AND r1.field_name = 'mxemp_emp_fm_age'
                        AND r1.status = r.status
                        ORDER BY r1.id DESC
                        LIMIT 1
                    ),
                    f.mxemp_emp_fm_age
                )
                ELSE f.mxemp_emp_fm_age
            END AS mxemp_emp_fm_age,

            /* OCCUPATION */
            CASE
                WHEN r.status IN (0, 2)
                THEN COALESCE(
                    (
                        SELECT r1.new_value
                        FROM maxwell_employee_familyinfo_request r1
                        WHERE r1.reference_id = f.mxemp_emp_fm_id
                        AND r1.field_name = 'mxemp_emp_fm_occupation'
                        AND r1.status = r.status
                        ORDER BY r1.id DESC
                        LIMIT 1
                    ),
                    f.mxemp_emp_fm_occupation
                )
                ELSE f.mxemp_emp_fm_occupation
            END AS mxemp_emp_fm_occupation,

            /* APPROVAL STATUS */
            r.status AS status

        ", false);

        $this->db->from('maxwell_employees_family f');

        /*
        * Get only the latest request for each family record.
        * This prevents duplicate family rows.
        */
        $this->db->join(
            '(SELECT r1.*
            FROM maxwell_employee_familyinfo_request r1
            INNER JOIN (
                SELECT reference_id, MAX(id) AS max_id
                FROM maxwell_employee_familyinfo_request
                GROUP BY reference_id
            ) latest
            ON latest.reference_id = r1.reference_id
            AND latest.max_id = r1.id
            ) r',
            'r.reference_id = f.mxemp_emp_fm_id',
            'LEFT',
            false
        );

        $this->db->where(
            'f.mxemp_emp_fm_employee_id',
            $emp_id
        );

        if (!empty($id)) {
            $this->db->where(
                'f.mxemp_emp_fm_id',
                $id
            );
        }

        $query = $this->db->get();

        // echo $this->db->last_query();
        // exit;

        return $query->result();
    }

    public function previousEmployments($emp_id, $id = ''){
        $this->db->select('mxemp_emp_pe_id,mxemp_emp_pe_employee_id,mxemp_emp_pe_periodfromto,mxemp_emp_pe_nameandorg,mxemp_emp_pe_desgjointime,mxemp_emp_pe_desgleavingtime,mxemp_emp_pe_desgreportedto,mxemp_emp_pe_monthlysalary,mxemp_emp_pe_otherbenfits,mxemp_emp_pe_reasonforchange');
        $this->db->from('maxwell_employees_previousemployments');
        $this->db->where('mxemp_emp_pe_employee_id', $emp_id);
        if(!empty($id)){
        $this->db->where('mxemp_emp_pe_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function nomineeDetails($emp_id, $id = ''){
        $this->db->select('mxemp_emp_nm_id,mxemp_emp_nm_employee_id,mxemp_emp_nm_type,mxemp_emp_nm_relation,mxemp_emp_nm_relationname,mxemp_emp_nm_relationage,mxemp_emp_nm_relationmobile,mxemp_emp_nm_relationaddress,mxemp_emp_nm_relationpercent,mxemp_emp_nm_relationimage');
        $this->db->from('maxwell_employees_nominee');
        $this->db->where('mxemp_emp_nm_employee_id', $emp_id);
        if(!empty($id)){
        $this->db->where('mxemp_emp_nm_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function languagesDetails($emp_id, $id = ''){
        $this->db->select('mxemp_emp_lng_id,mxemp_emp_lng_employee_id,mxemp_emp_lng,mxemp_emp_lng_speak,mxemp_emp_lng_read,mxemp_emp_lng_write,mxlg_name');
        $this->db->from('maxwell_employees_lanaguages');
        $this->db->join('maxwell_languages_master', 'mxemp_emp_lng = mxlg_id', 'INNER');
        $this->db->where('mxemp_emp_lng_employee_id', $emp_id);
        if(!empty($id)){
        $this->db->where('mxemp_emp_lng_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function employeeDashboard(){
        $returnarray['authorization'] = $this->DashBoardModel->getReportingManager();
        $returnarray['avgattendance'] = $this->DashBoardModel->getAttendanceSummary();
        $returnarray['avaliableleaves'] = $this->DashBoardModel->leaveBalanceSummary();
        $returnarray['hoildaysummary'] = $this->DashBoardModel->holiday_summary();
        $returnarray['inleavessummary'] = $this->DashBoardModel->inleaves_summary();
        $returnarray['circularssummary'] = $this->DashBoardModel->getcircular_summary();
        $returnarray['notificationssummary'] = $this->DashBoardModel->getnotification_summary();
        $returnarray['dobsummary'] = $this->DashBoardModel->birthdays_summary();
        $returnarray['paysheetsummary'] = $this->DashBoardModel->paysheet_summary();
        return $returnarray;
    }

    public function getHolidaysList(){
        return $returnarray['hoildaysummary'] = $this->DashBoardModel->holiday_summary();
    }

    public function getemployeeidsassignedtomanagers(){
        $employee_ids = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');
        return $employee_ids;
    }

    public function managersAssignedEmployees($data = array()){
        $employee_codes = (!empty($data['employecodes']) && $data['employecodes'] != 'ALL') ? array($data['employecodes']) : array();
        $monthid = '';
        $yearid  = '';

        if (!empty($data['monthyear'])) {
            $monthYear = explode('-', $data['monthyear']);
            $monthid = $monthYear[0];
            $yearid  = $monthYear[1];
        }
        
        
        if(count($employee_codes) > 0){
            $employee_ids = $employee_codes;
        }else{
            $employee_ids = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');
            $employee_ids = array_column($employee_ids, 'mxauth_emp_code');
        }
        // print_r($employee_ids);
        if(!empty($month)){
            $monthid = date('m');
        }

        if(!empty($year)){
            $yearid = date('Y');
        }

        $company = $data['esi_company_id'];
        $division = $data['esi_div_id'];
        $state = $data['esi_state_id'];
        $branch = $data['esi_branch_id'];

        $returnarray['employeeattendance'] = $this->DashBoardModel->get_employee_attendance_calendar($employee_ids, $monthid, $yearid, $company, $division, $state, $branch);
        return $returnarray;
    }

    public function managersAssignedEmployeesRegulationsLeaves($data = array()){
        $employee_codes = (!empty($data['employecodeslr']) && $data['employecodeslr'] != 'ALL') ? array($data['employecodeslr']) : array();
        $monthid = '';
        $yearid  = '';

        if (!empty($data['monthyearlr'])) {
            $monthYear = explode('-', $data['monthyearlr']);
            $monthid = $monthYear[0];
            $yearid  = $monthYear[1];
        }       
        
        if(count($employee_codes) > 0){
            $employee_ids = $employee_codes;
        }else{
            $employee_ids = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');
            $employee_ids = array_column($employee_ids, 'mxauth_emp_code');
        }
        // print_r($employee_ids);
        if(!empty($month)){
            $monthid = date('m');
        }

        if(!empty($year)){
            $yearid = date('Y');
        }
        
        if (!empty($data['monthyearlr'])) {
            $data['fromdate'] = date('Y-m-01', strtotime('01-' . $data['monthyearlr']));
            $data['todate']   = date('Y-m-t', strtotime('01-' . $data['monthyearlr']));
        }else{
            $data['fromdate'] = date('Y-m-01');
            $data['todate'] = date('Y-m-t');
        }

        $data['customoption'] = '';
        $data['leavestatus'] = '0';
        $data['flag'] = 0;
        $data['regulationtype'] = '';
        $data['employee_ids'] =$employee_ids;

        $returnarray['managerleavesdetails'] = $this->CommonModel->manageremployeesleaveList($data);
        $returnarray['manageremployeeRegulations'] = $this->CommonModel->manageremployeesregulationList($data);
        $returnarray['ontimeLatecomming'] = $this->ontimeLatecomming($data);
        // print_r($returnarray['ontimeLatecomming']); exit;
        return $returnarray;
    }

    public function ontimeLatecomming($data){
        $company = $data['esi_company_id'];
        $division = $data['esi_div_id'];
        $state = $data['esi_state_id'];
        $branch = $data['esi_branch_id'];
        $employee_codes = (!empty($data['employecodeslr']) && $data['employecodeslr'] != 'ALL') 
            ? array($data['employecodeslr']) 
            : array();

        $monthid = '';
        $yearid  = '';

        if (!empty($data['monthyearlr'])) {

            $monthYear = explode('-', $data['monthyearlr']);

            $monthid = $monthYear[0];
            $yearid  = $monthYear[1];
        }

        // Default current month/year
        if (empty($monthid)) {
            $monthid = date('m');
        }

        if (empty($yearid)) {
            $yearid = date('Y');
        }

        // Employee IDs
        if(count($employee_codes) > 0){

            $employee_ids = $employee_codes;

        }else{

            $employee_ids = $this->CommonModel
                ->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');

            $employee_ids = array_column($employee_ids, 'mxauth_emp_code');
        }

        // Response
        $resp = array(
            'ontime' => 0,
            'late'   => 0,
            'employee_wise' => array()
        );

        // Start and End Dates of Month
        $from_date = $yearid . '-' . $monthid . '-01';
        $to_date   = date('Y-m-t', strtotime($from_date));

        // Attendance table
        $table_name = 'maxwell_attendance_' . $yearid . '_' . $monthid;

        $this->db->select('
            mx_attendance_emp_code,
            mx_attendance_date,
            mx_attendance_first_half_punch
        ');

        $this->db->from($table_name);

        $this->db->where_in('mx_attendance_emp_code', $employee_ids);
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
        $this->db->where('mx_attendance_date >=', $from_date);
        $this->db->where('mx_attendance_date <=', $to_date);

        $this->db->where('mx_attendance_first_half_punch !=', '');

        $query = $this->db->get();

        // echo $this->db->last_query(); exit;

        $qry = $query->result();

        if(!empty($qry)){

            foreach($qry as $row){

                $empcode = $row->mx_attendance_emp_code;

                // Initialize employee wise counts
                if(!isset($resp['employee_wise'][$empcode])){

                    $resp['employee_wise'][$empcode] = array(
                        'ontime' => 0,
                        'late'   => 0,
                        'total'  => 0
                    );
                }

                if(!empty($row->mx_attendance_first_half_punch)){

                    $punches = explode(',', $row->mx_attendance_first_half_punch);

                    $userfirstpunch = trim($punches[0]);

                    if(!empty($userfirstpunch)){

                        $resp['employee_wise'][$empcode]['total']++;

                        // Late Check
                        if(strtotime($userfirstpunch) > strtotime('09:35:00')){

                            $resp['late']++;

                            $resp['employee_wise'][$empcode]['late']++;

                        }else{

                            $resp['ontime']++;

                            $resp['employee_wise'][$empcode]['ontime']++;
                        }
                    }
                }
            }
        }

        return $resp;
    }

     # Leaves 
    public function getLeaveSummary()
    {
        $employeecode = $this->session->userdata('session_loginperson_id');
        $currentYear = date('Y');
        $currentMonth = date('m');

        // If current month < April → we are in previous financial year
        if ($currentMonth < 4) {
            $startYear = $currentYear - 1;
            $endYear   = $currentYear;
        } else {
            $startYear = $currentYear;
            $endYear   = $currentYear + 1;
        }
        // Financial Year Dates
        $fyStart = $startYear . '-04-01';
        $fyEnd   = $endYear . '-03-31';

        // --- Subquery A (Used Leaves) ---
        $subqueryA = $this->db
            ->select('mxar_appliedby_emp_code, mxar_leavetypeid, SUM(mxar_noofdays) AS Used')
            ->from('attendance_user_leaveadjust')
            ->where('mxar_final_accept_status', 3)
            ->where('mxar_authfinal_status', 1)
            ->where('mxar_from >=', $fyStart)
            ->where('mxar_to <=', $fyEnd)
            ->group_by(['mxar_appliedby_emp_code', 'mxar_leavetypeid'])
            ->get_compiled_select();

        // --- Subquery C (Accrued Leaves) ---
        $subqueryC = $this->db
            ->select('mxemp_leave_cron_emp_id, mxemp_leave_cron_leavetype, SUM(mxemp_leave_cron_present_adding) AS Accrued')
            ->from('maxwell_emp_leave_cron_history')
            ->where('mxemp_leave_cron_createdtime >=', $fyStart)
            ->where('mxemp_leave_cron_createdtime <=', $fyEnd)
            ->where('mxemp_leave_cron_processdate !=', $startYear)
            ->group_by(['mxemp_leave_cron_emp_id', 'mxemp_leave_cron_leavetype'])
            ->get_compiled_select();

        // --- Main Query ---
        // b.mxemp_leave_bal_crnt_bal AS CurrentBalance,
        $this->db->select("
            b.mxemp_leave_bal_leave_type AS leaveId,
            b.mxemp_leave_bal_leave_type_name As leaveName,
            ROUND(b.mxemp_leave_bal_crnt_bal, 1) AS CurrentBalance,
            ROUND(IFNULL(a.Used, 0), 1) AS Used,
            ROUND(IFNULL(c.Accrued, 0), 1) AS Accrued,
            ROUND(
                CASE 
                    WHEN e.mxlass_leave_type_id = 4 
                    THEN IF(e.mxlass_is_max_leave != 0, e.mxlass_is_max_leave, e.mxlass_min_leaves)
                    ELSE IF(e.mxlass_is_max_leave != 0, e.mxlass_is_max_leave, e.mxlass_min_leaves) * 12
                END
            , 1) AS Annual
        ", false);
        $this->db->from('maxwell_emp_leave_balance b');

        $this->db->join(
            'maxwell_employees_info d',
            'd.mxemp_emp_id = b.mxemp_leave_bal_emp_id',
            'left'
        );

        $this->db->join(
            'maxwell_leave_assigning_master e',
            'e.mxlass_emp_type_id = d.mxemp_emp_type 
            AND e.mxlass_leave_type_id = b.mxemp_leave_bal_leave_type',
            'left'
        );
        // OH id is 4

        // Join Subquery A
        $this->db->join("($subqueryA) a",
            'a.mxar_leavetypeid = b.mxemp_leave_bal_leave_type 
            AND a.mxar_appliedby_emp_code = b.mxemp_leave_bal_emp_id',
            'left'
        );

        // Join Subquery C
        $this->db->join("($subqueryC) c",
            'c.mxemp_leave_cron_leavetype = b.mxemp_leave_bal_leave_type 
            AND c.mxemp_leave_cron_emp_id = b.mxemp_leave_bal_emp_id',
            'left'
        );
        $this->db->where('b.mxemp_leave_bal_emp_id', $employeecode);
        return $this->db->get()->result();
    }

    public function employeesleaveshistoryList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $leavefromdate = $data['fromdate'];
        $leavetodate = $data['todate'];
        $leavetype = $data['customoption'];
        $leavestatus = $data['leavestatus'];
         $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,
                            mxar_auth1_empname as auth1emp,
                            mxar_auth2_empname as auth2emp,
                            mxar_auth3_empname as auth3emp,
                            mxar_authfinal_empname as authfinalemp,
                            CASE 
                                WHEN mxar_category_type = 1 THEN 'First Half'
                                WHEN mxar_category_type = 2 THEN 'Second Half'
                                WHEN mxar_category_type = 3 THEN 'Full Day'
                                ELSE ''
                            END AS category_type,

                            CASE 
                                WHEN mxar_final_accept_status = 3 and mxar_authfinal_status =1 THEN 'Hr Approved'
                                WHEN mxar_final_accept_status = 3 THEN 'Final Hr Approved'
                                WHEN mxar_authfinal_status = 1 THEN 'Approved'
                                WHEN mxar_authfinal_status = 2 THEN 'Rejected'
                                ELSE 'Pending'
                            END AS leave_status,

                            mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_desc as emp_description,  
                            mxar_status as status ,mxar_leave_type as leavetypename, mxlt_leave_name,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,mxar_final_accept_status as finalacceptstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname ,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc,mxar_hrfinal_accept as finalhracceptid,mxar_hrfinal_acceptname as finalhracceptname,
                            mxd_name as divisionname,mxb_name as branchname,mxst_state as statename, mxar_auth1_approve_date, mxar_auth2_approve_date, mxar_auth3_approve_date, mxar_auth4_approve_date,mxar_noofdays,mxar_createdtime
                             ");
                            $this->db->from('attendance_user_leaveadjust');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'Inner');
                            $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'Inner');
                            $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'Inner');
                            $this->db->join('maxwell_leave_type_master', 'mxlt_id = mxar_leavetypeid', 'Inner');
                            // $this->db->join ('maxwell_emp_authorsations',' mxemp_emp_id = mxauth_reporting_head_emp_code and mxauth_status = 1','Inner');
                            $this->db->where('mxar_status','1');
                            $this->db->where('mxar_appliedby_emp_code', $employeecode);
                            if($leavetype != 'ALL'){
                                $this->db->where('mxar_leavetypeid', $leavetype);
                            }
                            if($leavestatus == '3'){
                                $this->db->where('mxar_final_accept_status', $leavestatus);
                            }elseif($leavestatus != 'ALL'){
                                $this->db->where('mxar_authfinal_status', $leavestatus);
                            }
                            if (!empty($leavefromdate)) {
                                $datefrom = DateTime::createFromFormat('d-m-Y', $leavefromdate);
                                $formattedfrom = $datefrom->format('Y-m-d');
                                $this->db->where('mxar_from >=', $formattedfrom);
                            }
                            if (!empty($leavetodate)) {
                                $dateto = DateTime::createFromFormat('d-m-Y', $leavetodate);
                                $formattedto = $dateto->format('Y-m-d');
                                $this->db->where('mxar_to <=', $formattedto);
                            }                         
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result();
                            // echo $this->db->last_query();
                            // exit;
                            $retrunarray = array();
                            
                        foreach ($result as $key => $val){
                            $buldarray = (object)array(
                                "employee_code" => $val->employeeid,
                                "mxemp_emp_fname" => $val->employeename,
                                "category_type" => $val->category_type,
                                "leave_from" => $val->from,
                                "leave_to" => $val->to,
                                "days_count" => $val->mxar_noofdays,
                                "leave_name" => $val->leavetypename .' (' . $val->mxlt_leave_name . ')',
                                "leave_description" => $val->emp_description,
                                "status" => $val->leave_status
                            );
                                
                            array_push($retrunarray,$buldarray);   
                        }

                        // print_r($retrunarray); exit;
        $columns = [
            'employee_code',
            'mxemp_emp_fname',
            'category_type',
            'leave_from',
            'leave_to',
            'days_count',
            'leave_name',
            'leave_description',
            'status',
            ]; 
        
        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'category_type' => 'Leave Category',
            'leave_from' => 'From Date',
            'leave_to' => 'To Date',
            'days_count' => 'Total Days',
            'leave_name' => 'Leave Type',
            'leave_description' => 'Reason / Description',
            'status' => 'Approval Status'            
        ]; 

        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );

        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array(); // Columns with edit options
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Leave Details History Report';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        echo dynamicTable($processData);
    }
    
    public function manageremployeesleavesList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $manageremployee = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($employeecode);
        $managerempCodes = array_column($manageremployee, 'mxauth_emp_code');
        $leavefromdate = $data['fromdate'];
        $leavetodate = $data['todate'];
        $leavetype = $data['customoption'];
        $leavestatus = $data['leavestatus'];
        $datefrom = DateTime::createFromFormat('d-m-Y', $leavefromdate);
        $formattedfrom = $datefrom->format('Y-m-d');
        $dateto = DateTime::createFromFormat('d-m-Y', $leavetodate);
        $formattedto = $dateto->format('Y-m-d');

        /*
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,
                            mxar_auth1_empname as auth1emp,
                            mxar_auth2_empname as auth2emp,
                            mxar_auth3_empname as auth3emp,
                            mxar_authfinal_empname as authfinalemp,
                            CASE 
                                WHEN mxar_category_type = 1 THEN 'First Half'
                                WHEN mxar_category_type = 2 THEN 'Second Half'
                                WHEN mxar_category_type = 3 THEN 'Full Day'
                                ELSE ''
                            END AS category_type,
                            CASE 
                                WHEN mxar_final_accept_status = 3 and mxar_authfinal_status =1 THEN 'Hr Approved'
                                WHEN mxar_final_accept_status = 3 THEN 'Final Hr Approved'
                                WHEN mxar_authfinal_status = 1 THEN 'Approved'
                                WHEN mxar_authfinal_status = 2 THEN 'Rejected'
                                ELSE 'Pending'
                            END AS leave_status,
                            mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_desc as emp_description,  
                            mxar_status as status ,mxar_leave_type as leavetypename, mxlt_leave_name,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,mxar_final_accept_status as finalacceptstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname ,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc,mxar_hrfinal_accept as finalhracceptid,mxar_hrfinal_acceptname as finalhracceptname,
                            mxd_name as divisionname,mxb_name as branchname,mxst_state as statename, mxar_auth1_approve_date, mxar_auth2_approve_date, mxar_auth3_approve_date, 
                            mxar_auth4_approve_date,mxar_noofdays,mxar_createdtime,mxemp_leave_bal_crnt_bal as current_balance, 
                                (
                                    SELECT SUM(b.mxar_noofdays)
                                    FROM attendance_user_leaveadjust b
                                    WHERE b.mxar_appliedby_emp_code = attendance_user_leaveadjust.mxar_appliedby_emp_code
                                    AND b.mxar_leavetypeid = attendance_user_leaveadjust.mxar_leavetypeid
                                    AND b.mxar_from >= '$formattedfrom'
                                    AND b.mxar_to <= '$formattedto'
                                    AND b.mxar_final_accept_status = 3
                                ) AS total_used
                            ");
                            $this->db->from('attendance_user_leaveadjust');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'Inner');
                            $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'Inner');
                            $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'Inner');
                            $this->db->join('maxwell_leave_type_master', 'mxlt_id = mxar_leavetypeid', 'Inner');
                            $this->db->join('maxwell_emp_leave_balance', 'mxemp_leave_bal_emp_id = mxemp_emp_id and mxemp_leave_bal_leave_type =mxar_leavetypeid', 'Inner');
                            // $this->db->join ('maxwell_emp_authorsations',' mxemp_emp_id = mxauth_reporting_head_emp_code and mxauth_status = 1','Inner');
                            $this->db->where('mxar_status','1');
                            $this->db->where_In('mxar_appliedby_emp_code', $managerempCodes);
                            if($leavetype != 'ALL'){
                                $this->db->where('mxar_leavetypeid', $leavetype);
                            }
                            if($leavestatus == '3'){
                                $this->db->where('mxar_final_accept_status', $leavestatus);
                            }elseif($leavestatus != 'ALL'){
                                $this->db->where('mxar_authfinal_status', $leavestatus);
                            }
                            if (!empty($leavefromdate)) {
                               
                                $this->db->where('mxar_from >=', $formattedfrom);
                            }
                            if (!empty($leavetodate)) {
                               
                                $this->db->where('mxar_to <=', $formattedto);
                            }                         
                            // $this->db->group_by('mxar_appliedby_emp_code');
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result();
                            // echo $this->db->last_query();
                            // exit;
                            // print_r($result); exit;
                        */
                        $datas['employee_ids'] = $managerempCodes;
                        $datas['leavestatus'] = $leavestatus;
                        $datas['customoption'] = $leavetype;
                        $datas['fromdate'] = $formattedfrom;
                        $datas['todate'] = $formattedto;
                        $result = $this->CommonModel->manageremployeesleaveList($datas);
                        $retrunarray = array();                            
                        foreach ($result as $key => $val){
                            $buldarray = (object)array(
                                "employee_code" => $val->employeeid,
                                "mxemp_emp_fname" => $val->employeename,
                                "category_type" => $val->category_type,
                                "leave_from" => $val->from,
                                "leave_to" => $val->to,
                                "days_count" => $val->mxar_noofdays,
                                "current_balance" => $val->current_balance,
                                "used" => $val->total_used,
                                "leave_name" => $val->leavetypename .' (' . $val->mxlt_leave_name . ')',
                                "leave_description" => $val->emp_description,
                                "status" => $val->leave_status
                            );                                
                            array_push($retrunarray,$buldarray);   
                        }
        $columns = [
            'employee_code',
            'mxemp_emp_fname',
            'category_type',
            'leave_from',
            'leave_to',
            'days_count',
            'current_balance',
            'used',
            'leave_name',
            'leave_description',
            'status',
            ];         
        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'category_type' => 'Leave Category',
            'leave_from' => 'From Date',
            'leave_to' => 'To Date',
            'days_count' => 'Total Days',
            'current_balance' => 'Current Balance',
            'used' => 'Used',
            'leave_name' => 'Leave Type',
            'leave_description' => 'Reason / Description',
            'status' => 'Approval Status'            
        ]; 
        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );
        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array(); // Columns with edit options
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Leave Details History Report';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        echo dynamicTable($processData);
    }
    # End Leaves 

    # Regulations
    public function getRegulationSummary()
    {
        $employeecode = $this->session->userdata('session_loginperson_id');
        $currentYearmonth = date('Y-m-01');
        $currentYearendmonth = date('Y-m-t');
        $this->db->select('mxar_type AS regulationtype, SUM(mxar_attend_countdays) AS total_days', false);
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_appliedby_emp_code', $employeecode);
        //  $this->db->where('mxar_appliedby_emp_code', 'M0386');
        $this->db->where('mxar_type!=','');
        $this->db->where('mxar_from >=', $currentYearmonth);
        $this->db->where('mxar_to <=', $currentYearendmonth);
        $this->db->group_by('mxar_type');
        return $this->db->get()->result();
    }

    public function employeesRegulationsList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $regulationfromdate = $data['fromdate'];
        $regulationtodate = $data['todate'];
        $regulationtype = $data['regulationtype'];
        $leavestatus = $data['leavestatus'];
        if($leavestatus == '0'){ $leavestatus = 9; }
         $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,
                            mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_desc as emp_description,mxar_attend_countdays as countdays,
                            CASE 
                                WHEN mxar_category_type = 1 THEN 'First Half'
                                WHEN mxar_category_type = 2 THEN 'Second Half'
                                WHEN mxar_category_type = 3 THEN 'Full Day'
                                ELSE ''
                            END AS category_type,
                            CASE 
                                WHEN mxar_authfinal_status = 1 THEN 'Approved'
                                WHEN mxar_authfinal_status = 2 THEN 'Rejected'
                                WHEN mxar_authfinal_status = 3 THEN 'Hr Approved'
                                ELSE 'Pending' 
                            END AS finalstatus,
                            mxar_reason as reason,
                            mxar_type as regulationtype");
                            $this->db->from('attendance_regulation');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'Inner');
                            $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'Inner');
                            $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'Inner');
                            // $this->db->where('mxar_status','1');   
                            $this->db->where('mxar_appliedby_emp_code', $employeecode);                       
                            if (!empty($regulationfromdate)) {
                                $datefrom = DateTime::createFromFormat('d-m-Y', $regulationfromdate);
                                $formatfrom = $datefrom->format('Y-m-d');
                                $this->db->where('mxar_from >=', $formatfrom);
                            }
                            if (!empty($regulationtodate)) {
                                $dateto = DateTime::createFromFormat('d-m-Y', $regulationtodate);
                                $formatto = $dateto->format('Y-m-d');
                                $this->db->where('mxar_to <=', $formatto);
                            }          
                            if($leavestatus != 'ALL'){
                                $this->db->where('mxar_authfinal_status', $leavestatus);
                            }
                            if($regulationtype != 'ALL'){
                                $this->db->where('mxar_type', $regulationtype);
                            }
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result();
                            // echo $this->db->last_query();
                            // exit;
                            $retrunarray = array();
                        foreach ($result as $key => $val){
                            $buldarray = (object)array(
                                "employee_code" => $val->employeeid,
                                "mxemp_emp_fname" => $val->employeename,
                                "category_type" => $val->category_type,
                                "leave_from" => $val->from,
                                "leave_to" => $val->to,
                                "days_count" => $val->countdays,
                                "regulation_name" => $val->regulationtype,
                                "regulation_reason" => $val->reason,
                                "regulation_description" => $val->emp_description,
                                "status" => $val->finalstatus
                            );                                
                            array_push($retrunarray,$buldarray);   
                        }
                        // print_r($retrunarray); exit;
        $columns = [
            'employee_code',
            'mxemp_emp_fname',
            'category_type',
            'leave_from',
            'leave_to',
            'days_count',
            'regulation_name',
            'regulation_reason',
            'regulation_description',
            'status',
            ]; 
        
        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'category_type' => 'Regulation Category',
            'leave_from' => 'From Date',
            'leave_to' => 'To Date',
            'days_count' => 'Total Days',
            'regulation_name' => 'Regulation Type',
            'regulation_reason' => 'Regulation Reason',
            'regulation_description' => 'Description',
            'status' => 'Approval Status'            
        ]; 

        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );

        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array(); // Columns with edit options
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Leave Details History Report';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        echo dynamicTable($processData);
    }
    
    public function manageremployeesregulationList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $manageremployee = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($employeecode);
        $datas['employee_ids'] = array_column($manageremployee, 'mxauth_emp_code');
        $leavefromdate = $data['fromdate'];
        $leavetodate = $data['todate'];
        $datas['regulationtype']  = $data['regulationtype'];
        $datas['leavestatus'] = $data['leavestatus'];
        $datefrom = DateTime::createFromFormat('d-m-Y', $leavefromdate);
        $datas['fromdate'] = $datefrom->format('Y-m-d');
        $dateto = DateTime::createFromFormat('d-m-Y', $leavetodate);
        $datas['todate'] = $dateto->format('Y-m-d');
        $datas['flag'] = '';
        $result = $this->CommonModel->manageremployeesregulationList($datas);
            $retrunarray = array();                            
            foreach ($result as $key => $val){
                $buldarray = (object)array(
                    "employee_code" => $val->employeeid,
                    "mxemp_emp_fname" => $val->employeename,
                    "category_type" => $val->category_type,
                    "leave_from" => $val->from,
                    "leave_to" => $val->to,
                    // "days_count" => $val->mxar_noofdays,
                    // "current_balance" => $val->current_balance,
                    // "used" => $val->total_used,
                    // "leave_name" => $val->leavetypename .' (' . $val->mxlt_leave_name . ')',
                    "leave_name" => $val->regulationtype,
                    "leave_description" => $val->emp_description,
                    "status" => $val->regulation_status
                );                                
                array_push($retrunarray,$buldarray);   
            }
        $columns = [
            'employee_code',
            'mxemp_emp_fname',
            'category_type',
            'leave_from',
            'leave_to',
            // 'days_count',
            // 'current_balance',
            // 'used',
            'leave_name',
            'leave_description',
            'status',
        ];    

        $renameHeaderColumns = [
            'employee_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'category_type' => 'Leave Category',
            'leave_from' => 'From Date',
            'leave_to' => 'To Date',
            // 'days_count' => 'Total Days',
            // 'current_balance' => 'Current Balance',
            // 'used' => 'Used',
            'leave_name' => 'Leave Type',
            'leave_description' => 'Reason / Description',
            'status' => 'Approval Status'            
        ]; 
        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );
        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array(); // Columns with edit options
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Employees Regulation Reports';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        echo dynamicTable($processData);
    }
    # End Regulations
    # Employee Loans
    public function getEmployeesLoansList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $loanstatus = $data['loanstatus'];

        if($loanstatus == 'InProgress'){
            $status = array('OPEN','IN PROCESS');
        }elseif($loanstatus == 'Closed'){
            $status = array('CLOSED');
        }else{
            $status = array();
        }

        $this->db->select("
            mxemploan_load_id as loanid,
            mxemploan_empcode as employeecode,
            mxemploan_emp_loan_type as loantype,
            mxemploan_emp_loan_approvedby as loanapproedby,
            mxemploan_emp_reasonfor_loan as loanforreason,
            mxemploan_emp_loan_amt_appliedby_employee as loanamtrequested,
            mxemploan_emp_loan_amt_approved as loanamountapproved,
            mxemploan_emp_loan_outstanding_amt as loanoutstandingamt,
            mxemploan_emp_loan_debited_amt as loandebitedamt,
            mxemploan_emp_loan_current_paid_amt as loancurrentpaidamt,
            mxemploan_emp_loan_advance_pay_amt as loanadvancepayamt,
            mxemploan_emp_loan_forecloser_pay_amt as loanforecloseramt,
            mxemploan_emp_loan_tenure_months as loantenuremonths,
            mxemploan_emp_loan_monthly_emi_amt as loanmonthlyemiamt,
            mxemploan_emp_attachements as loandocument,
            mxemploan_emp_loancategory as loancategory,
            mxemploan_emi_startdate as loanemistartdate,
            mxemploan_emi_enddate as loanemienddate,
            mxemploan_applied_date as loanapplieddate,
            mxemploan_approved_date as loanapproveddate,
            mxemploan_emp_payment_type as loanpaymenttype,
            mxemploan_emp_modeofpayment as loanmodeofpayment,
            mxemploan_status as loanstatusflag,
            mxemploan_emp_information as loanstatus,

            (
                SELECT COUNT(*)
                FROM maxwell_emp_loan_master_transaction t
                WHERE t.mxemploan_load_id = maxwell_emp_loan_master.mxemploan_load_id
                AND t.mxemploan_emp_information != 'OPEN' AND t.mxemploan_status = 1
            ) as emisprocessed
        ");

        $this->db->from('maxwell_emp_loan_master');

        $this->db->where('mxemploan_empcode', $employeecode);

        if(count($status) > 0){
            $this->db->where_in('mxemploan_emp_information', $status);
        }

        $this->db->order_by(
            "CASE 
                WHEN mxemploan_modifiedtime IS NULL 
                THEN mxemploan_createdtime 
                ELSE mxemploan_modifiedtime 
            END",
            "DESC",
            FALSE
        );

        return $this->db->get()->result();
    }

    public function getloanscount($employeecode){
        $this->db->select('COUNT(*) as count');
        $this->db->from('maxwell_emp_loan_master');
        $this->db->where('mxemploan_empcode', $employeecode);

        $result = $this->db->get()->row();

        return $result->count;
    }
    # End Employee Loans
    # Manager Team Members
    public function managerteammembersList($data){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $this->db->select('mxauth_emp_code, mxemp_emp_fname, mxcp_name, mxd_name, mxst_state, mxb_name, mxdpt_name, mxdesg_name, mxemp_ty_name');
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_emp_code','inner');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->join('maxwell_employee_type_master', 'mxemp_ty_id = mxemp_emp_type', 'INNER');
        $this->db->where('mxauth_reporting_head_emp_code', $employeecode);
        $this->db->where('mxauth_status', 1);
        if(!empty($data['esi_company_id'])){
            $this->db->where('mxemp_emp_comp_code', $data['esi_company_id']);
        }
        if(!empty($data['esi_div_id'])){
            $this->db->where('mxemp_emp_division_code', $data['esi_div_id']);
        }
        if(!empty($data['esi_state_id'])){
            $this->db->where('mxemp_emp_state_code', $data['esi_state_id']);
        }
        if(!empty($data['esi_branch_id'])){
            $this->db->where('mxemp_emp_branch_code', $data['esi_branch_id']);
        }

        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->where('mxauth_emp_code !=', '');
        $this->db->order_by('mxauth_emp_code', 'ASC');
        $query1 = $this->db->get();
        // echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();

       $retrunarray = array();

        foreach ($qry1 as $key => $val){
            $buldarray = (object)array(
                "mxauth_emp_code" => $val->mxauth_emp_code,
                "mxemp_emp_fname" => $val->mxemp_emp_fname,
                "mxcp_name" => $val->mxcp_name,
                "mxd_name" => $val->mxd_name,
                "mxst_state" => $val->mxst_state,
                "mxb_name" => $val->mxb_name,
                "mxdpt_name" => $val->mxdpt_name,
                "mxdesg_name" => $val->mxdesg_name,
                "mxemp_ty_name" => $val->mxemp_ty_name,
                );
            array_push($retrunarray,$buldarray);   
        }
        // return $retrunarray;   
        $columns = [
            "mxauth_emp_code",
            "mxemp_emp_fname",
            "mxcp_name",
            "mxd_name",
            "mxst_state",
            "mxb_name",
            "mxdpt_name",
            "mxdesg_name",
            "mxemp_ty_name",
        ]; 

        $renameHeaderColumns = [
            'mxauth_emp_code' => 'Employee Code',
            'mxemp_emp_fname' => 'Employee Name', 
            'mxcp_name' => 'Company',
            'mxd_name' => 'Division',
            'mxst_state' => 'State',
            'mxb_name' => 'Branch',
            'mxdpt_name' => 'Department',
            'mxdesg_name' => 'Designations',
            'mxemp_ty_name' => 'Employee Type'
        ]; 

        // Mapping id and replace with name form masters
        $dataMappingColumns = array(
            'Translate' => array(),
        );

        // Define columns for links and edit actions
        $urllink = '';
        $linkColumns = array(); // Columns where links will be provided
        $editColumns = array(); // Columns with edit options
        // $editColumns = array(
        //     'id' => array(
        //         'AddFunction' => 'editAttendance',
        //         'AddModelFunction' => 'loadAttendanceData',
        //         'CallID' => 'attendanceModal'
        //     )
        // );
        $hideColumn = array();
        $hideInExport = array();
        $reportName = 'Your Team Members';
        $processData = array(
            'retrunarray' => $retrunarray,
            'columns' => $columns,
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'dataMappingColumns' => $dataMappingColumns,
            'renameHeaderColumns' => $renameHeaderColumns,
            'hideColumn' => $hideColumn,
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
        );
        // print_r($processData);exit;
        echo dynamicTable($processData);
    }
    # End Manager Team Members

    # Employee Geo Locations
    public function managerTeamMembersGeoLocationAttendanceList($data){
        $year  = '';
        $employee_codes = (!empty($data['employeecode']) && $data['employeecode'] != 'ALL') ? array($data['employeecode']) : array();

        if(!empty($data['fromdate'])){
            $cdate = date('Y-m-d',strtotime($data['fromdate']));
            $year = date('Y',strtotime($data['fromdate']));  
        }else{
            $cdate = date('Y-m-d');
            $year = date('Y');
        }
        if(!empty($data['todate'])){
            $tdate = date('Y-m-d',strtotime($data['todate']));
            $year = date('Y',strtotime($data['todate']));  
        }else{
            $tdate = date('Y-m-d');
            $year = date('Y');
        }

        // Employee IDs
        if(count($employee_codes) > 0){
            $employee_ids = $employee_codes;
        }else{
            $employee_ids = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');
            $employee_ids = array_column($employee_ids, 'mxauth_emp_code');
        }

        $this->db->select('employee_code, attendance_date, mxemp_emp_autouniqueid,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxdesg_name,mxemp_emp_resignation_status,mxemp_emp_date_of_join,mxemp_emp_is_without_notice_period,mxcp_name,mxd_name,mxb_name,mxst_state,mxemp_ty_name');
        $this->db->from('employee_punches_'.$year);
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = employee_code', 'INNER');
        $this->db->join('maxwell_employees_login', 'mxemp_emp_lg_employee_id = employee_code', 'INNER');
        $this->db->join('maxwell_company_master', 'mxcp_id = company', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = division', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = state', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = branch', 'INNER');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
        $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'INNER');
        $this->db->join('maxwell_employee_type_master', 'mxemp_ty_id = mxemp_emp_type', 'INNER');
        
        $this->db->where('attendance_date >=', $cdate);
        $this->db->where('attendance_date <=', $tdate);
        $this->db->where('latitudes !=','');
        $this->db->where('longitudes !=','');
        // $this->db->where('mxemp_emp_google_map', 1);
        $this->db->where('mxemp_emp_is_without_notice_period', 0); 
        $this->db->where('mxemp_emp_status', 1);
        if(count($employee_ids) > 0){
            $this->db->where_In('employee_code',$employee_ids);
        }

        if (!empty($data['esi_company_id'])) {
            $this->db->where('company', $data['esi_company_id']);
        }
        if (!empty($data['esi_div_id'])) {
            $this->db->where('division', $data['esi_div_id']);
        }
        if (!empty($data['esi_state_id'])) {
            $this->db->where('state', $data['esi_state_id']);
        }
        if (!empty($data['esi_branch_id'])) {
            $this->db->where('branch', $data['esi_branch_id']);
        }

        $this->db->group_by(array('employee_code','attendance_date'));
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        $qry1 = $query->result();
        // $gepemparry=[];

        //     foreach($qry as $geokey =>$geoval){
        //        $gepemparry[]= $geoval['employee_code'];
        //     }   
        //     $gepemparry1=array_values($gepemparry);
        //     if(empty($gepemparry1)){
        //         $gepemparry1 = array('1');
        //     }
        
            // $this->db->select('mxemp_emp_autouniqueid,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxdesg_name,mxemp_emp_resignation_status,mxemp_emp_date_of_join,mxemp_emp_is_without_notice_period,mxcp_name,mxd_name,mxb_name,mxst_state,mxemp_ty_name');
            // $this->db->from('maxwell_employees_info');



            // $this->db->where_In('mxemp_emp_id',$gepemparry1);

            // $query1 = $this->db->get();
            // $qry1 = $query1->result();
            // echo $this->db->last_query(); exit;

           $retrunarray = array();

            foreach ($qry1 as $key => $val){
                $buldarray = (object)array(
                    "attendancedate" => '<a href="'.base_url().'Employee/TeamMembersGeoLocationAttendance?employeeid='.$val->mxemp_emp_id.'&date='.$val->attendance_date.'" target="_blank">' . $val->attendance_date . '</a>',
                    "mxemp_emp_id" => $val->mxemp_emp_id,
                    "mxemp_emp_fname" => $val->mxemp_emp_fname .' '.$val->mxemp_emp_lname,
                    "mxcp_name" => $val->mxcp_name,
                    "mxd_name" => $val->mxd_name,
                    "mxst_state" => $val->mxst_state,
                    "mxb_name" => $val->mxb_name,
                    // "mxdpt_name" => $val->mxdpt_name,
                    "mxdesg_name" => $val->mxdesg_name,
                    "mxemp_ty_name" => $val->mxemp_ty_name,
                    );
                array_push($retrunarray,$buldarray);   
            }
            // return $retrunarray;   
            $columns = [
                "attendancedate",
                "mxemp_emp_id",
                "mxemp_emp_fname",
                "mxcp_name",
                "mxd_name",
                "mxst_state",
                "mxb_name",
                // "mxdpt_name",
                "mxdesg_name",
                "mxemp_ty_name",
            ]; 

            $renameHeaderColumns = [
                'attendancedate' => 'Attendance',
                'mxemp_emp_id' => 'Employee Code',
                'mxemp_emp_fname' => 'Employee Name', 
                'mxcp_name' => 'Company',
                'mxd_name' => 'Division',
                'mxst_state' => 'State',
                'mxb_name' => 'Branch',
                // 'mxdpt_name' => 'Department',
                'mxdesg_name' => 'Designations',
                'mxemp_ty_name' => 'Employee Type'
            ]; 

            // Mapping id and replace with name form masters
            $dataMappingColumns = array(
                'Translate' => array(),
            );

            // Define columns for links and edit actions
            $urllink = '';
            $linkColumns = array(); // Columns where links will be provided
            $editColumns = array(); // Columns with edit options
            // $editColumns = array(
            //     'id' => array(
            //         'AddFunction' => 'editAttendance',
            //         'AddModelFunction' => 'loadAttendanceData',
            //         'CallID' => 'attendanceModal'
            //     )
            // );
            $hideColumn = array();
            $hideInExport = array();
            $reportName = 'Your Team Members Geo Location Attendance';
            $processData = array(
                'retrunarray' => $retrunarray,
                'columns' => $columns,
                'linkColumns' => $linkColumns,
                'editColumns' => $editColumns,
                'dataMappingColumns' => $dataMappingColumns,
                'renameHeaderColumns' => $renameHeaderColumns,
                'hideColumn' => $hideColumn,
                'reportName' => $reportName,
                'hideInExport' => $hideInExport,
            );
            // print_r($processData);exit;
            echo dynamicTable($processData);
        
    }

    public function googlemap($empid,$date){
        
        $cdate = date('Y-m-d',strtotime($date));
        $year = date('Y',strtotime($date));
        $locarrylist= array();
        $locarry=[];
        $this->db->select('location,latitudes,longitudes,attendance_date,attendance_time,mxemp_emp_fname,mxcp_name,mxd_name,mxb_name,mxst_state,employee_code,entry_type,islocation,mxemp_emp_present_postalcode'); 
        $this->db->from('employee_punches_'.$year);
        $this->db->join('maxwell_employees_info', 'employee_code = mxemp_emp_id', 'INNER');
        $this->db->join('maxwell_company_master', 'mxcp_id = company', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = division', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = state', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = branch', 'INNER');
        $this->db->where('employee_code', $empid);
        $this->db->where('attendance_date', $cdate);
        $this->db->where('latitudes !=','');
        $this->db->where('longitudes !=','');
        $this->db->where('entry_type !=','GEOTAG');
        $query = $this->db->get();
        $qry1 = $query->result_array();
        // echo '<pre>';
        // print_r($qry1);
        $i=1;
        foreach($qry1 as $key=>$val){
           $key1= $key+1;
           $locarrylist['lc'][]= [$val['location'],$val['latitudes'],$val['longitudes'],$key1,$val['attendance_date'],$val['attendance_time']];
        }
        $locarrylist['list'] = $qry1;
        return $locarrylist;
    }
    # End Employee Geo Locations

    #Update Employee Info
    public function updateemployeeinfo($data){
        $data = array_map('trim', $data);
        $updatetype = isset($data['updatetype']) ? $data['updatetype']: '';
        switch ($updatetype)
        {
            case 'familyinfo':
                $familyinfo = $this->family($data['employeeId'],$data['Id']);
                // Convert object to array
                $olddata = (array) $familyinfo[0];

                $updatedata = array(
                    'mxemp_emp_fm_title'      => $data['emptitle'],
                    'mxemp_emp_fm_relation'   => $data['empfmrelation'],
                    'mxemp_emp_fm_name'       => $data['empfmname'],
                    'mxemp_emp_fm_age'        => !empty($data['empdob']) ? date('Y-m-d',strtotime($data['empdob'])): NULL,
                    'mxemp_emp_fm_occupation' => $data['empfmoccupation']
                );

                // DIFFERENCE ARRAY
                $changes = $this->getDifferencesChanges($olddata,$updatedata);
                // PRINT DIFFERENCE
                // print_r($changes);exit;

                // NO CHANGES
                if(empty($changes)){
                    echo json_encode(array('statusCode' => 400,'errorMsg' => 'No Changes Found'));exit;
                }
                $update = true;
                foreach($changes as $field => $values){
                    // Escape values
                    $newvalue = $this->db->escape($values['new']);

                    // COLUMN WISE UPDATE QUERY
                    $upquery = "UPDATE maxwell_employees_family SET ".$field." = ".$newvalue." WHERE mxemp_emp_fm_id = '".$data['Id']."' AND mxemp_emp_fm_employee_id = '".$data['employeeId']."'";
                    $logdata = array(
                        'employee_id'     => $data['employeeId'],
                        'reference_id'    => $data['Id'],
                        'update_type'     => $updatetype,
                        'field_name'      => $field,
                        'old_value'       => $values['old'],
                        'new_value'       => $values['new'],
                        'up_query'        => $upquery,
                        'created_date'    => date('Y-m-d H:i:s'),
                        'created_by'      => $this->session->userdata('session_loginperson_id')
                    );
                    $insert = $this->db->insert('maxwell_employee_familyinfo_request',$logdata);
                    if(!$insert){
                        $update = false;
                    }
                }
                if($update){
                    echo $resp = json_encode(array('statusCode' => 200, 'message' => 'Sent For Approval'));
                }
                else{
                    echo $resp = json_encode(array('statusCode' => 400, 'errorMsg' => 'Unable To Update'));
                }

            break;
            default:
                echo $resp = json_encode(array('statusCode' => 400, 'errorMsg' => 'Invalid Type Please Check'));
            break;
        }
    }
    public function getDifferencesChanges($olddata, $newdata){
        $changes = array();

        foreach ($newdata as $key => $newvalue)
        {
            // OLD VALUE
            $oldvalue = isset($olddata[$key])? trim($olddata[$key]): '';
            // NEW VALUE
            $newvalue = trim($newvalue);
            // COMPARE VALUES
            if ($oldvalue != $newvalue)
            {
                $changes[$key] = array(
                    'old' => $oldvalue,
                    'new' => $newvalue
                );
            }
        }
        return $changes;
    }
    #Update Employee Info
    #attendancesummary
    public function allemployeesattendancesummary($data){
        $company=!empty($data['esi_company_id'])?$data['esi_company_id']:'';
        $division=!empty($data['esi_div_id'])?$data['esi_div_id']:'';
        $state=!empty($data['esi_state_id'])?$data['esi_state_id']:'';
        $branch=!empty($data['esi_branch_id'])?$data['esi_branch_id']:'';
        $fromdate=!empty($data['fromdate'])?$data['fromdate']:date('Y-m-01');
        $todate=!empty($data['todate'])?$data['todate']:date('Y-m-d');
        $attendanceSection = !empty($data['attendanceSection'])? (int)$data['attendanceSection']: 3;

        $from_date=date('Y-m-d',strtotime($fromdate));
        $to_date=date('Y-m-d',strtotime($todate));

        $is_current_date =($from_date == date('Y-m-d') && $to_date == date('Y-m-d'));

        $yearid=date('Y',strtotime($from_date));
        $monthid=date('m',strtotime($from_date));

        $table_name='maxwell_attendance_'.$yearid.'_'.$monthid;

        if(!$this->db->table_exists($table_name)){
            return array(
                'status'=>0,
                'message'=>'Attendance table not found'
            );
        }

        $employee_codes=(!empty($data['employecode'])&& $data['employecode']!='ALL')?array($data['employecode']):array();

        if(count($employee_codes)>0){
            $employee_ids=$employee_codes;
        }else{
            $employee_ids=$this->CommonModel->getEmployeesWhoAreAssignToAuthorsations('');
            $employee_ids=array_column($employee_ids,'mxauth_emp_code');
        }

        $attendance_types=array(
            'OD',
            'OT',
            'PR',
            'AB',
            'SHRT',
            'CL',
            'SL',
            'EL',
            'WO',
            'PH',
            'LOP',
            'OH',
            'ML',
            'AR'
        );

        $resp=array(
            'status'=>1,
            'totalemployees'=>0,
            'ontime'=>array(
                'count'=>0,
                'employeecodes'=>array()
            ),
            'late'=>array(
                'count'=>0,
                'employeecodes'=>array()
            ),
            'employee_wise_count'=>array()
        );

        foreach($attendance_types as $type){
            $resp[$type]=array(
                'firsthalf'=>0,
                'secondhalf'=>0,
                'total'=>0,
                'employeecodes'=>array(),
                'pending'=>array(
                    'total'=>0,
                    'employeecodes'=>array()
                ),
                'rejected'=>array(
                    'total'=>0,
                    'employeecodes'=>array()
                )
            );
        }

        $this->db->select('
            mxemp_emp_fname as employeename,
            mxemp_emp_img as employeeimage,
            mx_attendance_emp_code,
            mx_attendance_date,
            mx_attendance_first_half_punch,
            mx_attendance_second_half_punch,
            mx_attendance_first_half,
            mx_attendance_second_half
        ');

        $this->db->from($table_name);
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'INNER');
        $this->db->where_in('mx_attendance_emp_code',$employee_ids);

        if(!empty($company)){
            $this->db->where('mx_attendance_cmp_id',$company);
        }

        if(!empty($division)){
            $this->db->where('mx_attendance_division_id',$division);
        }

        if(!empty($state)){
            $this->db->where('mx_attendance_state_id',$state);
        }

        if(!empty($branch)){
            $this->db->where('mx_attendance_branch_id',$branch);
        }

        $this->db->where('mx_attendance_date >=',$from_date);
        $this->db->where('mx_attendance_date <=',$to_date);

        $query=$this->db->get();

        $qry=$query->result();

        if(!empty($qry)){

            $processedEmployees=array();

            foreach($qry as $row){

                $empcode=$row->mx_attendance_emp_code;

                if(!in_array($empcode,$processedEmployees)){
                    $processedEmployees[]=$empcode;
                    $resp['totalemployees']++;
                }

                if(!isset($resp['employee_wise_count'][$empcode])){

                    $resp['employee_wise_count'][$empcode]=array(
                        'employeename'=>$row->employeename,
                        'employeeimage'=>$row->employeeimage,
                        'late'=>0,
                        'ontime'=>0,
                        'totaldays'=>0
                    );

                    foreach($attendance_types as $type){
                        $resp['employee_wise_count'][$empcode][$type]=0;
                        $resp['employee_wise_count'][$empcode][$type.'_pending']=0;
                        $resp['employee_wise_count'][$empcode][$type.'_rejected']=0;
                    }
                }

                $first_half=trim($row->mx_attendance_first_half);
                $second_half=trim($row->mx_attendance_second_half);

                $first_half_punch=trim($row->mx_attendance_first_half_punch);
                $second_half_punch=trim($row->mx_attendance_second_half_punch);

                $is_ab_lop_valid = (empty($first_half_punch) && empty($second_half_punch));

                if($attendanceSection == 1){

                    if(in_array($first_half,$attendance_types)){

                        if(in_array($first_half,['AB','LOP']) && !$is_ab_lop_valid){
                            // Skip
                        }else{
                            $resp[$first_half]['firsthalf'] += 1;
                            $resp[$first_half]['total'] += 1;

                            $resp['employee_wise_count'][$empcode][$first_half] += 1;
                            $resp['employee_wise_count'][$empcode]['totaldays'] += 1;

                            if(!in_array($empcode,$resp[$first_half]['employeecodes'])){
                                $resp[$first_half]['employeecodes'][] = $empcode;
                            }
                        }
                    }

                }elseif($attendanceSection == 2){

                    if(!$is_current_date && in_array($second_half,$attendance_types)){

                        if(in_array($second_half,['AB','LOP']) && !$is_ab_lop_valid){
                            // Skip
                        }else{
                            $resp[$second_half]['secondhalf'] += 1;
                            $resp[$second_half]['total'] += 1;

                            $resp['employee_wise_count'][$empcode][$second_half] += 1;
                            $resp['employee_wise_count'][$empcode]['totaldays'] += 1;

                            if(!in_array($empcode,$resp[$second_half]['employeecodes'])){
                                $resp[$second_half]['employeecodes'][] = $empcode;
                            }
                        }
                    }

                }else{ // Full Day

                    // First Half
                    if(in_array($first_half,$attendance_types)){

                        if(!(in_array($first_half,['AB','LOP']) && !$is_ab_lop_valid)){

                            $resp[$first_half]['firsthalf'] += 0.5;
                            $resp[$first_half]['total'] += 0.5;

                            $resp['employee_wise_count'][$empcode][$first_half] += 0.5;
                            $resp['employee_wise_count'][$empcode]['totaldays'] += 0.5;

                            if(!in_array($empcode,$resp[$first_half]['employeecodes'])){
                                $resp[$first_half]['employeecodes'][] = $empcode;
                            }
                        }
                    }

                    // Second Half
                    if(!$is_current_date && in_array($second_half,$attendance_types)){

                        if(!(in_array($second_half,['AB','LOP']) && !$is_ab_lop_valid)){

                            $resp[$second_half]['secondhalf'] += 0.5;
                            $resp[$second_half]['total'] += 0.5;

                            $resp['employee_wise_count'][$empcode][$second_half] += 0.5;
                            $resp['employee_wise_count'][$empcode]['totaldays'] += 0.5;

                            if(!in_array($empcode,$resp[$second_half]['employeecodes'])){
                                $resp[$second_half]['employeecodes'][] = $empcode;
                            }
                        }
                    }
                }

                // if(in_array($first_half,$attendance_types)){
                // // AB should be counted only if both punches are empty
                //     if($first_half == 'AB' && !$is_ab_valid){
                //         // Skip AB counting
                //     }else{
                //         $resp[$first_half]['firsthalf']+=0.5;
                //         $resp[$first_half]['total']+=0.5;
                //         $resp['employee_wise_count'][$empcode][$first_half]+=0.5;
                //         $resp['employee_wise_count'][$empcode]['totaldays']+=0.5;
                //         if(!in_array($empcode,$resp[$first_half]['employeecodes'])){
                //             $resp[$first_half]['employeecodes'][]=$empcode;
                //         }
                //     }
                // }

                // if(!$is_current_date && in_array($second_half,$attendance_types)){
                //     // AB should be counted only if both punches are empty
                //     if($second_half == 'AB' && !$is_ab_valid){
                //         // Skip AB counting
                //     }else{
                //         $resp[$second_half]['secondhalf']+=0.5;
                //         $resp[$second_half]['total']+=0.5;
                //         $resp['employee_wise_count'][$empcode][$second_half]+=0.5;
                //         $resp['employee_wise_count'][$empcode]['totaldays']+=0.5;
                //         if(!in_array($empcode,$resp[$second_half]['employeecodes'])){
                //             $resp[$second_half]['employeecodes'][]=$empcode;
                //         }
                //     }
                // }
                // if(in_array($first_half,$attendance_types)){

                //     $resp[$first_half]['firsthalf']+=0.5;
                //     $resp[$first_half]['total']+=0.5;

                //     $resp['employee_wise_count'][$empcode][$first_half]+=0.5;

                //     $resp['employee_wise_count'][$empcode]['totaldays']+=0.5;

                //     if(!in_array($empcode,$resp[$first_half]['employeecodes'])){
                //         $resp[$first_half]['employeecodes'][]=$empcode;
                //     }
                // }

                // if(in_array($second_half,$attendance_types)){

                //     $resp[$second_half]['secondhalf']+=0.5;
                //     $resp[$second_half]['total']+=0.5;

                //     $resp['employee_wise_count'][$empcode][$second_half]+=0.5;

                //     $resp['employee_wise_count'][$empcode]['totaldays']+=0.5;

                //     if(!in_array($empcode,$resp[$second_half]['employeecodes'])){
                //         $resp[$second_half]['employeecodes'][]=$empcode;
                //     }
                // }

                $is_od_or_ot = (
                    in_array($first_half, ['OT','OD']) ||
                    in_array($second_half, ['OT','OD'])
                );

                if(!$is_od_or_ot && !empty($first_half_punch)){
                    $punches = explode(',', $first_half_punch);
                    $userfirstpunch = trim($punches[0]);
                    if(!empty($userfirstpunch)){
                        if(strtotime($userfirstpunch) > strtotime('09:35:00')){
                            $resp['late']['count']++;
                            $resp['employee_wise_count'][$empcode]['late']++;

                            if(!in_array($empcode,$resp['late']['employeecodes'])){
                                $resp['late']['employeecodes'][] = $empcode;
                            }
                        }else{
                            $resp['ontime']['count']++;
                            $resp['employee_wise_count'][$empcode]['ontime']++;
                            if(!in_array($empcode,$resp['ontime']['employeecodes'])){
                                $resp['ontime']['employeecodes'][] = $empcode;
                            }
                        }
                    }
                }
            }
        }

         $login_emp_code=$this->session->userdata('session_loginperson_id');

            /* =========================
            LEAVE QUERY
            ========================= */

            $this->db->select("
                mxar_leave_type AS request_type,
                mxar_appliedby_emp_code,

                SUM(
                    CASE
                        WHEN mxar_final_accept_status = 9
                        THEN mxar_noofdays

                        WHEN (
                            (mxar_auth1_empcode='$login_emp_code' AND mxar_auth1_status=0)
                            OR
                            (mxar_auth2_empcode='$login_emp_code' AND mxar_auth2_status=0)
                            OR
                            (mxar_auth3_empcode='$login_emp_code' AND mxar_auth3_status=0)
                            OR
                            (mxar_auth4_empcode='$login_emp_code' AND mxar_auth4_status=0)
                            OR
                            (mxar_authfinal_empcode='$login_emp_code' AND mxar_authfinal_status=0)
                        )
                        AND mxar_final_accept_status != 3
                        THEN mxar_noofdays

                        ELSE 0
                    END
                ) AS pending_days,

                SUM(
                    CASE
                        WHEN mxar_final_accept_status = 2
                        THEN mxar_noofdays

                        WHEN (
                            (mxar_auth1_empcode='$login_emp_code' AND mxar_auth1_status=2)
                            OR
                            (mxar_auth2_empcode='$login_emp_code' AND mxar_auth2_status=2)
                            OR
                            (mxar_auth3_empcode='$login_emp_code' AND mxar_auth3_status=2)
                            OR
                            (mxar_auth4_empcode='$login_emp_code' AND mxar_auth4_status=2)
                            OR
                            (mxar_authfinal_empcode='$login_emp_code' AND mxar_authfinal_status=2)
                        )
                        AND mxar_final_accept_status != 3
                        THEN mxar_noofdays

                        ELSE 0
                    END
                ) AS rejected_days,

                'Leave' AS request_category
            ", false);

            $this->db->from('attendance_user_leaveadjust');
            $this->db->where('mxar_from >=', $from_date);
            $this->db->where('mxar_to <=', $to_date);
            $this->db->where_in('mxar_appliedby_emp_code', $employee_ids);
            $this->db->group_by('mxar_leave_type');
            $this->db->group_by('mxar_appliedby_emp_code');
            $this->db->having('(pending_days > 0 OR rejected_days > 0)', null, false);
            $leave_query = $this->db->get_compiled_select();

            /* =========================
            REGULATION QUERY
            ========================= */

            $this->db->select("
                mxar_type AS request_type,
                mxar_appliedby_emp_code,

                SUM(
                    CASE
                        WHEN (
                            (mxar_auth1_empcode='$login_emp_code' AND mxar_auth1_status=0)
                            OR
                            (mxar_auth2_empcode='$login_emp_code' AND mxar_auth2_status=0)
                            OR
                            (mxar_auth3_empcode='$login_emp_code' AND mxar_auth3_status=0)
                            OR
                            (mxar_auth4_empcode='$login_emp_code' AND mxar_auth4_status=0)
                            OR
                            (mxar_authfinal_empcode='$login_emp_code' AND mxar_authfinal_status=9)
                        )
                        THEN
                            CASE
                                WHEN mxar_category_type IN (1,2) THEN 0.5
                                WHEN mxar_category_type = 3 THEN 1
                                ELSE mxar_attend_countdays
                            END
                        ELSE 0
                    END
                ) AS pending_days,

                SUM(
                    CASE
                        WHEN (
                            (mxar_auth1_empcode='$login_emp_code' AND mxar_auth1_status=2)
                            OR
                            (mxar_auth2_empcode='$login_emp_code' AND mxar_auth2_status=2)
                            OR
                            (mxar_auth3_empcode='$login_emp_code' AND mxar_auth3_status=2)
                            OR
                            (mxar_auth4_empcode='$login_emp_code' AND mxar_auth4_status=2)
                            OR
                            (mxar_authfinal_empcode='$login_emp_code' AND mxar_authfinal_status=2)
                        )
                        THEN
                            CASE
                                WHEN mxar_category_type IN (1,2) THEN 0.5
                                WHEN mxar_category_type = 3 THEN 1
                                ELSE mxar_attend_countdays
                            END
                        ELSE 0
                    END
                ) AS rejected_days,

                'Regulation' AS request_category
            ", false);

            $this->db->from('attendance_regulation');
            $this->db->where('mxar_from >=', $from_date);
            $this->db->where('mxar_to <=', $to_date);
            $this->db->where_in('mxar_appliedby_emp_code', $employee_ids);
            $this->db->group_by('mxar_type');
            $this->db->group_by('mxar_appliedby_emp_code');
            $this->db->having('(pending_days > 0 OR rejected_days > 0)', null, false);
            $regulation_query = $this->db->get_compiled_select();
            /* =========================
            UNION ALL
            ========================= */
            $final_query = $leave_query . " UNION ALL " . $regulation_query;
            $query = $this->db->query($final_query);
            $result1 = $query->result_array();
            // echo $this->db->last_query(); exit;
            // echo '<pre>';
            // print_r($result1);exit;

            foreach($result1 as $res){
                $empcode = $res['mxar_appliedby_emp_code'];
                $request_type = $res['request_type'];
                 $pending_days  = !empty($res['pending_days']) ? (float)$res['pending_days'] : 0;
                $rejected_days = !empty($res['rejected_days']) ? (float)$res['rejected_days'] : 0;
                if(isset($resp['employee_wise_count'][$empcode])){
                        $resp['employee_wise_count'][$empcode][$request_type.'_pending'] = isset($res['pending_days']) ? $res['pending_days'] : 0;
                        $resp['employee_wise_count'][$empcode][$request_type.'_rejected'] = isset($res['rejected_days']) ? $res['rejected_days'] : 0;
                    }

                if(isset($resp[$request_type])){

                    /* PENDING TOTAL */
                    $resp[$request_type]['pending']['total'] += $pending_days;

                    /* REJECTED TOTAL */
                    $resp[$request_type]['rejected']['total'] += $rejected_days;


                    /* PENDING EMPLOYEE CODES */
                    if($pending_days > 0){ 
                        if(!in_array($empcode,$resp[$request_type]['pending']['employeecodes'])){
                                $resp[$request_type]['pending']['employeecodes'][] = $empcode;
                        }
                    }
                    /* REJECTED EMPLOYEE CODES */
                    if($rejected_days > 0){
                        if(!in_array($empcode,$resp[$request_type]['rejected']['employeecodes'])){
                            $resp[$request_type]['rejected']['employeecodes'][] = $empcode;
                        }
                    }
                }
           }
  
        return $resp;
    }

    public function getEmployeeIncrementChartData($data){

        $company  = !empty($data['esi_company_id']) ? $data['esi_company_id'] : '';
        $division = !empty($data['esi_div_id']) ? $data['esi_div_id'] : '';
        $state    = !empty($data['esi_state_id']) ? $data['esi_state_id'] : '';
        $branch   = !empty($data['esi_branch_id']) ? $data['esi_branch_id'] : '';
        $fromdate = !empty($data['fromdate'])? $data['fromdate']: date('Y-m-01');
        $year     =  date('Y',strtotime($fromdate));

        $employee_codes = (!empty($data['employecode']) && $data['employecode'] != 'ALL') ? array($data['employecode']) : array();

        if(count($employee_codes) > 0){
            $employee_ids = $employee_codes;
        }else{
            $employee_ids =$this->CommonModel->getEmployeesWhoAreAssignToAuthorsations('');
            $employee_ids = array_column($employee_ids,'mxauth_emp_code');
        }

        $wherePromotion = "";
        $whereSpecial   = "";
        $whereArrears   = "";

        /* Employee Condition */
        $employeeConditionPromotion = "";
        $employeeConditionSpecial   = "";
        $employeeConditionArrears   = "";

        if(!empty($employee_ids) && is_array($employee_ids)){
            $employeeCodes = "'" . implode("','", $employee_ids) . "'";
            $employeeConditionPromotion = " AND mxemp_prm_emp_code IN ($employeeCodes) ";
            $employeeConditionSpecial = " AND mxemp_spl_inc_emp_code IN ($employeeCodes) ";
            $employeeConditionArrears = " AND mxemp_arears_emp_code IN ($employeeCodes) ";
        }

        /* Promotion Conditions */
        if(!empty($company)){
            $wherePromotion .= " AND mxemp_prm_comp_id_to = '".$company."' ";
        }

        if(!empty($division)){
            $wherePromotion .= " AND mxemp_prm_div_id_to = '".$division."' ";
        }

        if(!empty($state)){
            $wherePromotion .= " AND mxemp_prm_state_id_to = '".$state."' ";
        }

        if(!empty($branch)){
            $wherePromotion .= " AND mxemp_prm_branch_id_to = '".$branch."' ";
        }

        $wherePromotion .= $employeeConditionPromotion;

        /* Special Increment Conditions */
        if(!empty($company)){
            $whereSpecial .= " AND mxemp_spl_inc_comp_id = '".$company."' ";
        }

        if(!empty($division)){
            $whereSpecial .= " AND mxemp_spl_inc_div_id = '".$division."' ";
        }

        if(!empty($state)){
            $whereSpecial .= " AND mxemp_spl_inc_state_id = '".$state."' ";
        }

        if(!empty($branch)){
            $whereSpecial .= " AND mxemp_spl_inc_branch_id = '".$branch."' ";
        }

        $whereSpecial .= $employeeConditionSpecial;

        /* Arrears Conditions */
        if(!empty($company)){
            $whereArrears .= " AND mxemp_arears_comp_id = '".$company."' ";
        }

        if(!empty($division)){
            $whereArrears .= " AND mxemp_arears_div_id = '".$division."' ";
        }

        if(!empty($state)){
            $whereArrears .= " AND mxemp_arears_state_id = '".$state."' ";
        }

        if(!empty($branch)){
            $whereArrears .= " AND mxemp_arears_branch_id = '".$branch."' ";
        }

        $whereArrears .= $employeeConditionArrears;

        $query = "
            SELECT
                mxemp_prm_amount AS amount,
                mxemp_prm_emp_code AS employeecode,
                mxemp_prm_affect_dt AS affectivedate,
                'Promotional Increment' AS incrementtype
            FROM maxwell_emp_promotion
            WHERE mxemp_prm_status = 1
            ".(!empty($year) ? "AND LEFT(mxemp_prm_affect_dt,4) = '".$year."'" : "")."
            $wherePromotion
            UNION ALL
            SELECT
                mxemp_spl_inc_amount AS amount,
                mxemp_spl_inc_emp_code AS employeecode,
                mxemp_spl_inc_affect_dt AS affectivedate,
                'Current Month Increment' AS incrementtype
            FROM maxwell_emp_special_increaments
            WHERE mxemp_spl_inc_status = 1
            ".(!empty($year) ? "AND LEFT(mxemp_spl_inc_affect_dt,4) = '".$year."'" : "")."
            $whereSpecial
            UNION ALL
            SELECT
                mxemp_arears_amount AS amount,
                mxemp_arears_emp_code AS employeecode,
                mxemp_arears_affect_dt AS affectivedate,
                'Arrears Increment' AS incrementtype
            FROM maxwell_emp_arears_increaments
            WHERE mxemp_arears_status = 1
            ".(!empty($year) ? "AND LEFT(mxemp_arears_affect_dt,4) = '".$year."'" : "")."
            $whereArrears
        ";

        $incrementRecords = $this->db->query($query)->result_array();
        $incrementData = array();
        for($i=1; $i<=12; $i++){
            $monthKey = date('Y-m', strtotime($year.'-'.$i.'-01'));
            $incrementData[$monthKey] = array(
                'month' => date('M Y',strtotime($year.'-'.$i.'-01')),
                'count' => 0,
                'promotionalamount' => 0,
                'currentmonthamount' => 0,
                'arrearsamount' => 0,
                'totalamount' => 0,
                'employeecodes' => array()
            );
        }

        foreach($incrementRecords as $row){
            $monthKey = substr($row['affectivedate'],0,4).'-'.substr($row['affectivedate'],4,2);

            if(isset($incrementData[$monthKey])){
                $incrementData[$monthKey]['count']++;
                if(!in_array($row['employeecode'],$incrementData[$monthKey]['employeecodes'])){
                    $incrementData[$monthKey]['employeecodes'][] = $row['employeecode'];
                }

                if($row['incrementtype'] == 'Promotional Increment'){
                    $incrementData[$monthKey]['promotionalamount'] += (float)$row['amount'];

                }elseif($row['incrementtype'] == 'Current Month Increment'){
                    $incrementData[$monthKey]['currentmonthamount'] += (float)$row['amount'];
                }elseif($row['incrementtype'] == 'Arrears Increment'){
                    $incrementData[$monthKey]['arrearsamount'] += (float)$row['amount'];
                }

                $incrementData[$monthKey]['totalamount'] = $incrementData[$monthKey]['promotionalamount']+$incrementData[$monthKey]['currentmonthamount']+$incrementData[$monthKey]['arrearsamount'];
            }
        }

        return array_values($incrementData);
    }

    public function getAllEmployeesAttendance($data){
        $type = $data['type'];
        $employeecodes = $data['employeecodes'];
        $companyid = $data['companyid'];
        $divisionid = $data['divisionid'];
        $stateid = $data['stateid'];
        $branchid = $data['branchid'];
        $fromdate = $data['fromdate'];
        $todate = $data['todate'];

        $fromdate = !empty($data['fromdate'])? $data['fromdate']: date('Y-m-01');

        $todate = !empty($data['todate'])? $data['todate']: date('Y-m-d');

        $from_date = date('Y-m-d',strtotime($fromdate));

        $to_date = date('Y-m-d',strtotime($todate));

        $yearid = date('Y',strtotime($from_date));

        $monthid = date('m',strtotime($from_date));

        $table_name = 'maxwell_attendance_' . $yearid . '_' . $monthid;

        $this->db->select('
            mxemp_emp_fname as employeename,
            mxemp_emp_img as employeeimage,
            mx_attendance_emp_code,
            mx_attendance_date,
            mx_attendance_first_half_punch,
            mx_attendance_second_half_punch,
            mx_attendance_first_half,
            mx_attendance_second_half,
            mx_attendance_entry_type
        ');

        $this->db->from($table_name);
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'INNER');
        $this->db->where_in('mx_attendance_emp_code',$employeecodes);

        if(!empty($companyid)){
            $this->db->where('mx_attendance_cmp_id',$companyid);
        }

        if(!empty($divisionid)){
            $this->db->where('mx_attendance_division_id',$divisionid);
        }

        if(!empty($stateid)){
            $this->db->where('mx_attendance_state_id',$stateid);
        }

        if(!empty($branchid)){
            $this->db->where('mx_attendance_branch_id',$branchid);
        }

        $this->db->where('mx_attendance_date >=',$from_date);

        $this->db->where('mx_attendance_date <=',$to_date);

        if($type == 'ONTIME'){
            $this->db->where("SUBSTRING_INDEX(mx_attendance_first_half_punch,',',1) <=",'09:35:00');
            $this->db->where('mx_attendance_first_half_punch !=','');
        }else if($type == 'LATE'){
            $this->db->where("SUBSTRING_INDEX(mx_attendance_first_half_punch,',',1) >",'09:35:00');
            $this->db->where('mx_attendance_first_half_punch !=','');
        }else{
            $this->db->group_start();
            $this->db->where('mx_attendance_first_half',$type);
            $this->db->or_where('mx_attendance_second_half',$type);
            $this->db->group_end();
        }

        $query = $this->db->get();

        // echo $this->db->last_query(); exit;

        $qry = $query->result();

        $response = array();

        if(!empty($qry)){

            $sno = 1;

            foreach($qry as $val){
                $allpunches = array();
                if(!empty($val->mx_attendance_first_half_punch)){
                    $firsthalfpunches = explode(',',$val->mx_attendance_first_half_punch);
                    $allpunches = array_merge($allpunches,$firsthalfpunches);
                }

                if(!empty($val->mx_attendance_second_half_punch)){
                    $secondhalfpunches = explode(',',$val->mx_attendance_second_half_punch);
                    $allpunches = array_merge($allpunches,$secondhalfpunches);
                }

                $allpunches = array_filter($allpunches);
                $allpunches = array_values($allpunches);

                $firstpunch = 'N/A';

                if(!empty($allpunches[0])){
                    $firstpunch = trim($allpunches[0]);
                }

                $lastpunch = 'N/A';

                if(!empty($allpunches)){
                    $lastpunch = trim(end($allpunches));
                    if($firstpunch == $lastpunch){
                        $lastpunch = 'N/A';
                    }
                }


                $entrytypes = array();
                if(!empty($val->mx_attendance_entry_type)){
                    $entrytypes = explode(',',$val->mx_attendance_entry_type);
                    $entrytypes = array_filter($entrytypes);
                    $entrytypes = array_values($entrytypes);
                }


                $firstpunchentrytype = 'N/A';

                if(!empty($entrytypes[0])){
                    $firstpunchentrytype = trim($entrytypes[0]);
                }

                $lastpunchentrytype = 'N/A';
                if(!empty($entrytypes)){
                    $lastpunchentrytype = trim(end($entrytypes));
                    if($firstpunchentrytype == $lastpunchentrytype){
                        $lastpunchentrytype = 'N/A';
                    }
                }

                $response[] = array(
                    'Sno' => $sno,
                    'Employee Name' => $val->employeename,
                    'Employee Image' => $val->employeeimage,
                    'Employee Code' => $val->mx_attendance_emp_code,
                    'Attendance Date' => $val->mx_attendance_date,
                    'First Half Punch' => $firstpunch,
                    'Last Half Punch' => $lastpunch,
                    'First Half Entry Type' => $firstpunchentrytype,
                    'Last Half Entry Type' => $lastpunchentrytype,
                    'First Half Status' => $val->mx_attendance_first_half,
                    'Second Half Status' => $val->mx_attendance_second_half,
                );
                $sno++;
            }
        }
        return $response;
    }

    public function getAllEmployeesIncrements($data){
        $type          = !empty($data['type']) ? $data['type'] : '';
        $employeecodes = !empty($data['employeecodes']) ? $data['employeecodes'] : array();
        $company       = !empty($data['companyid']) ? $data['companyid'] : '';
        $division      = !empty($data['divisionid']) ? $data['divisionid'] : '';
        $state         = !empty($data['stateid']) ? $data['stateid'] : '';
        $branch        = !empty($data['branchid']) ? $data['branchid'] : '';
        $fromdate      = !empty($data['fromdate']) ? $data['fromdate'] : '';
        $todate        = !empty($data['todate']) ? $data['todate'] : '';

        /* Example : 202601 */
        $year = !empty($fromdate) ? date('Ym', strtotime($fromdate)) : '';

        $wherePromotion = "";
        $whereSpecial   = "";
        $whereArrears   = "";

        /* Employee Codes Condition */
        $employeeCodeConditionPromotion = "";
        $employeeCodeConditionSpecial   = "";
        $employeeCodeConditionArrears   = "";

        if(!empty($employeecodes) && is_array($employeecodes)){
            $employeeCodes = "'" . implode("','", $employeecodes) . "'";
            $employeeCodeConditionPromotion = " AND mxemp_prm_emp_code IN ($employeeCodes) ";
            $employeeCodeConditionSpecial = " AND mxemp_spl_inc_emp_code IN ($employeeCodes) ";
            $employeeCodeConditionArrears = " AND mxemp_arears_emp_code IN ($employeeCodes) ";
        }

        /* Promotion Conditions */
        if(!empty($company)){
            $wherePromotion .= " AND mxemp_prm_comp_id_to = '".$company."' ";
        }

        if(!empty($division)){
            $wherePromotion .= " AND mxemp_prm_div_id_to = '".$division."' ";
        }

        if(!empty($state)){
            $wherePromotion .= " AND mxemp_prm_state_id_to = '".$state."' ";
        }

        if(!empty($branch)){
            $wherePromotion .= " AND mxemp_prm_branch_id_to = '".$branch."' ";
        }

        $wherePromotion .= $employeeCodeConditionPromotion;

        /* Special Increment Conditions */
        if(!empty($company)){
            $whereSpecial .= " AND mxemp_spl_inc_comp_id = '".$company."' ";
        }

        if(!empty($division)){
            $whereSpecial .= " AND mxemp_spl_inc_div_id = '".$division."' ";
        }

        if(!empty($state)){
            $whereSpecial .= " AND mxemp_spl_inc_state_id = '".$state."' ";
        }

        if(!empty($branch)){
            $whereSpecial .= " AND mxemp_spl_inc_branch_id = '".$branch."' ";
        }

        $whereSpecial .= $employeeCodeConditionSpecial;

        /* Arrears Conditions */
        if(!empty($company)){
            $whereArrears .= " AND mxemp_arears_comp_id = '".$company."' ";
        }

        if(!empty($division)){
            $whereArrears .= " AND mxemp_arears_div_id = '".$division."' ";
        }

        if(!empty($state)){
            $whereArrears .= " AND mxemp_arears_state_id = '".$state."' ";
        }

        if(!empty($branch)){
            $whereArrears .= " AND mxemp_arears_branch_id = '".$branch."' ";
        }

        $whereArrears .= $employeeCodeConditionArrears;

        $query = "
        
            SELECT
                mxemp_prm_amount AS amount,
                mxemp_prm_emp_code AS employeecode,
                mxemp_prm_affect_dt AS affectivedate,
                'Promotional Increment' AS incrementtype,
                mxemp_emp_fname AS employeename,
                mxemp_emp_img AS employeeimage,
                mxemp_emp_current_salary AS currentpay
            FROM maxwell_emp_promotion
            INNER JOIN maxwell_employees_info ON mxemp_emp_id = mxemp_prm_emp_code
            WHERE mxemp_prm_status = 1
            ".(!empty($year) ? " AND mxemp_prm_affect_dt = '".$year."' " : "")."
            $wherePromotion
            UNION ALL
            SELECT
                mxemp_spl_inc_amount AS amount,
                mxemp_spl_inc_emp_code AS employeecode,
                mxemp_spl_inc_affect_dt AS affectivedate,
                'Current Month Increment' AS incrementtype,
                mxemp_emp_fname AS employeename,
                mxemp_emp_img AS employeeimage,
                mxemp_emp_current_salary AS currentpay
            FROM maxwell_emp_special_increaments
            INNER JOIN maxwell_employees_info ON mxemp_emp_id = mxemp_spl_inc_emp_code
            WHERE mxemp_spl_inc_status = 1
            ".(!empty($year) ? " AND mxemp_spl_inc_affect_dt = '".$year."' " : "")."
            $whereSpecial
            UNION ALL
            SELECT
                mxemp_arears_amount AS amount,
                mxemp_arears_emp_code AS employeecode,
                mxemp_arears_affect_dt AS affectivedate,
                'Arrears Increment' AS incrementtype,
                mxemp_emp_fname AS employeename,
                mxemp_emp_img AS employeeimage,
                mxemp_emp_current_salary AS currentpay
            FROM maxwell_emp_arears_increaments
            INNER JOIN maxwell_employees_info ON mxemp_emp_id = mxemp_arears_emp_code
            WHERE mxemp_arears_status = 1
            ".(!empty($year) ? " AND mxemp_arears_affect_dt = '".$year."' " : "")."
            $whereArrears
            ORDER BY affectivedate DESC
        ";

        $query = $this->db->query($query);

        // echo $this->db->last_query(); exit;

        $qry = $query->result();

        $response = array();

        if(!empty($qry)){
            $sno = 1;
            foreach($qry as $val){
                $response[] = array(
                    'Sno'             => $sno,
                    'Employee Name'   => $val->employeename,
                    'Employee Image'  => $val->employeeimage,
                    'Employee Code'   => $val->employeecode,
                    'Amount'          => $val->amount,
                    'Increment Type'  => $val->incrementtype,
                    'Affective Date'  => !empty($val->affectivedate) ? date('M Y', strtotime($val->affectivedate.'01')): '',
                    'Current Salary'  => $val->currentpay,
                );
                $sno++;
            }
        }

        return $response;
    }

    public function getAllEmployeesleaveesrequest($data){
        // print_r($data);
        $type = $data['type'];
        $employeecodes = $data['employeecodes'];
        $companyid = $data['companyid'];
        $divisionid = $data['divisionid'];
        $stateid = $data['stateid'];
        $branchid = $data['branchid'];
        $fromdate = $data['fromdate'];
        $todate = $data['todate'];

        $fromdate = !empty($data['fromdate'])? $data['fromdate']: date('Y-m-01');

        $todate = !empty($data['todate'])? $data['todate']: date('Y-m-d');

        $from_date = date('Y-m-d',strtotime($fromdate));

        $to_date = date('Y-m-d',strtotime($todate));

        $yearid = date('Y',strtotime($from_date));

        $monthid = date('m',strtotime($from_date));

        $login_emp_code=$this->session->userdata('session_loginperson_id');

            /* =========================
            LEAVE QUERY
            ========================= */

            $this->db->select("
                mxar_leave_type AS request_type,
                mxar_appliedby_emp_code as employeecode,
                mxemp_emp_fname as employeename,
                mxemp_emp_img as employeeimage,
                mxar_from,
                mxar_to,
                mxar_noofdays as days,
                mxar_desc as employeedesc,
                CONCAT(
                    COALESCE(mxar_auth1_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth1_empname, 'N/A')
                ) AS auth1_details,
                CASE 
                    WHEN mxar_auth1_status = 0 THEN 'Pending'
                    WHEN mxar_auth1_status = 1 THEN 'Approved'
                    WHEN mxar_auth1_status = 2 THEN 'Rejected'
                    ELSE mxar_auth1_status
                END AS mxar_auth1_status,
                CONCAT(
                    COALESCE(mxar_auth2_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth2_empname, 'N/A')
                ) AS auth2_details,
                CASE 
                    WHEN mxar_auth2_status = 0 THEN 'Pending'
                    WHEN mxar_auth2_status = 1 THEN 'Approved'
                    WHEN mxar_auth2_status = 2 THEN 'Rejected'
                    ELSE mxar_auth2_status
                END AS mxar_auth2_status,
                CONCAT(
                    COALESCE(mxar_auth3_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth3_empname, 'N/A')
                ) AS auth3_details,
                CASE 
                    WHEN mxar_auth3_status = 0 THEN 'Pending'
                    WHEN mxar_auth3_status = 1 THEN 'Approved'
                    WHEN mxar_auth3_status = 2 THEN 'Rejected'
                    ELSE mxar_auth3_status
                END AS mxar_auth3_status,
                CONCAT(
                    COALESCE(mxar_auth4_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth4_empname, 'N/A')
                ) AS auth4_details,
                CASE 
                    WHEN mxar_auth4_status = 0 THEN 'Pending'
                    WHEN mxar_auth4_status = 1 THEN 'Approved'
                    WHEN mxar_auth4_status = 2 THEN 'Rejected'
                    ELSE mxar_auth4_status
                END AS mxar_auth4_status,
                CONCAT(
                    COALESCE(mxar_authfinal_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_authfinal_empname, 'N/A')
                ) AS auth5_details,
                CASE 
                    WHEN mxar_final_accept_status = 9 THEN 'Pending'
                    WHEN mxar_final_accept_status = 3 THEN 'Approved'
                    WHEN mxar_final_accept_status = 1 THEN 'Approved'
                    WHEN mxar_final_accept_status = 2 THEN 'Rejected'
                    ELSE mxar_final_accept_status
                END AS mxar_auth5_status
            ", false);

            $this->db->from('attendance_user_leaveadjust');
            $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxar_appliedby_emp_code', 'INNER');
            $this->db->where('mxar_from >=', $from_date);
            $this->db->where('mxar_to <=', $to_date);
            $this->db->where_in('mxar_appliedby_emp_code', $employeecodes);
            $this->db->where('mxar_leave_type', $type);
           $this->db->where("
            (
            CASE 
            WHEN mxar_auth1_empcode = '$login_emp_code' and mxar_auth1_status = 0 THEN '0'
            WHEN mxar_auth2_empcode = '$login_emp_code' and mxar_auth2_status = 0 THEN '0'
            WHEN mxar_auth3_empcode = '$login_emp_code' and mxar_auth3_status = 0 THEN '0'            
            WHEN mxar_auth4_empcode = '$login_emp_code' and mxar_auth4_status = 0 THEN '0'           
            WHEN mxar_authfinal_empcode = '$login_emp_code' and mxar_final_accept_status = 9 THEN '0'           
            ELSE ''
            END
            ) = '0'
            ");
            // $this->db->group_by('mxar_leave_type');
            // $this->db->group_by('mxar_appliedby_emp_code');

            $leave_query = $this->db->get_compiled_select();

            /* =========================
            REGULATION QUERY
            ========================= */

            $this->db->select("
                mxar_type AS request_type,
                mxar_appliedby_emp_code as employeecode,
                mxemp_emp_fname as employeename,
                mxemp_emp_img as employeeimage,
                mxar_from,
                mxar_to,
               CASE
                    WHEN mxar_category_type IN (1,2) THEN 0.5
                    WHEN mxar_category_type = 3 THEN 1
                    ELSE mxar_attend_countdays
                END as days,
                mxar_desc as employeedesc,
                CONCAT(
                    COALESCE(mxar_auth1_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth1_empname, 'N/A')
                ) AS auth1_details,
                CASE 
                    WHEN mxar_auth1_status = 0 THEN 'Pending'
                    WHEN mxar_auth1_status = 1 THEN 'Approved'
                    WHEN mxar_auth1_status = 2 THEN 'Rejected'
                    ELSE mxar_auth1_status
                END AS mxar_auth1_status,
                CONCAT(
                    COALESCE(mxar_auth2_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth2_empname, 'N/A')
                ) AS auth2_details,
                CASE 
                    WHEN mxar_auth2_status = 0 THEN 'Pending'
                    WHEN mxar_auth2_status = 1 THEN 'Approved'
                    WHEN mxar_auth2_status = 2 THEN 'Rejected'
                    ELSE mxar_auth2_status
                END AS mxar_auth2_status,
                CONCAT(
                    COALESCE(mxar_auth3_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth3_empname, 'N/A')
                ) AS auth3_details,
                CASE 
                    WHEN mxar_auth3_status = 0 THEN 'Pending'
                    WHEN mxar_auth3_status = 1 THEN 'Approved'
                    WHEN mxar_auth3_status = 2 THEN 'Rejected'
                    ELSE mxar_auth3_status
                END AS mxar_auth3_status,
                CONCAT(
                    COALESCE(mxar_auth4_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_auth4_empname, 'N/A')
                ) AS auth4_details,
                CASE 
                    WHEN mxar_auth4_status = 0 THEN 'Pending'
                    WHEN mxar_auth4_status = 1 THEN 'Approved'
                    WHEN mxar_auth4_status = 2 THEN 'Rejected'
                    ELSE mxar_auth4_status
                END AS mxar_auth4_status,
                CONCAT(
                    COALESCE(mxar_authfinal_empcode, 'N/A'),
                    ' - ',
                    COALESCE(mxar_authfinal_empname, 'N/A')
                ) AS auth5_details,
                CASE 
                    WHEN mxar_authfinal_status = 9 THEN 'Pending'
                    WHEN mxar_authfinal_status = 3 THEN 'Approved'
                    WHEN mxar_authfinal_status = 1 THEN 'Approved'
                    WHEN mxar_authfinal_status = 2 THEN 'Rejected'
                    ELSE mxar_authfinal_status
                END AS mxar_auth5_status
            ", false);

            $this->db->from('attendance_regulation');
            $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxar_appliedby_emp_code', 'INNER');
            $this->db->where('mxar_from >=', $from_date);
            $this->db->where('mxar_to <=', $to_date);
            $this->db->where_in('mxar_appliedby_emp_code', $employeecodes);
            $this->db->where('mxar_type', $type);
            $this->db->where("
                (
                CASE 
                WHEN mxar_auth1_empcode = '$login_emp_code' and mxar_auth1_status = 0 THEN '0'
                WHEN mxar_auth2_empcode = '$login_emp_code' and mxar_auth2_status = 0 THEN '0'
                WHEN mxar_auth3_empcode = '$login_emp_code' and mxar_auth3_status = 0 THEN '0'
                WHEN mxar_auth4_empcode = '$login_emp_code' and mxar_auth4_status = 0 THEN '0'
                WHEN mxar_authfinal_empcode = '$login_emp_code' and mxar_authfinal_status = 9 THEN '0'
                ELSE ''
                END
                ) = '0'
            ");
            // $this->db->group_by('mxar_type');
            // $this->db->group_by('mxar_appliedby_emp_code');

            $regulation_query = $this->db->get_compiled_select();
            /* =========================
            UNION ALL
            ========================= */
            $final_query = $leave_query . " UNION ALL " . $regulation_query;
            $query = $this->db->query($final_query);
            $qry = $query->result();
            // echo $this->db->last_query(); exit;

        $response = array();

        if(!empty($qry)){
            $sno = 1;
            foreach($qry as $val){
                $response[] = array(
                    'Sno'             => $sno,
                    'Employee Name'   => $val->employeename,
                    'Employee Image'  => $val->employeeimage,
                    'Employee Code'   => $val->employeecode,
                    'From'            => $val->mxar_from,
                    'To'              => $val->mxar_to,
                    'Applied Days'    => $val->days,
                    'Request Type'    => $val->request_type,
                    'Employee Desc'   => $val->employeedesc,
                    'First Authorization'   => $val->auth1_details,
                    'Status First Authorization' => $val->mxar_auth1_status,
                    'Second Authorization'   => $val->auth2_details,
                    'Status Second Authorization' => $val->mxar_auth2_status,
                    'Third Authorization'   => $val->auth3_details,
                    'Status Third Authorization' => $val->mxar_auth3_status,
                    'Fourth Authorization'   => $val->auth4_details,
                    'Status Fourth Authorization' => $val->mxar_auth4_status,
                    'HR Authorization'   => $val->auth5_details,
                    'Status HR Authorization' => $val->mxar_auth5_status,
                );
                $sno++;
            }
        }

        return $response;
            
    }
    #attedancesummary
    #joinResignsummary
    public function joinResignSummary($data = array()){
        $currentdate = date('Y-m-d');
        $fromdate = date('Y-m-d', strtotime('-1 year'));

        $months = [];
        $joined = [];
        $resigned = [];
        $details = [];

        $qrj = "
            SELECT
                year,
                month,
                monthname,
                SUM(joined_count) AS joined_count,
                SUM(resigned_count) AS resigned_count,
                GROUP_CONCAT(joined_employees) AS joined_employees,
                GROUP_CONCAT(resigned_employees) AS resigned_employees
            FROM
            (
                SELECT
                    YEAR(mxemp_emp_date_of_join) AS year,
                    MONTH(mxemp_emp_date_of_join) AS month,
                    MONTHNAME(mxemp_emp_date_of_join) AS monthname,
                    COUNT(*) AS joined_count,
                    GROUP_CONCAT(mxemp_emp_id) AS joined_employees,
                    0 AS resigned_count,
                    '' AS resigned_employees
                FROM maxwell_employees_info
                INNER JOIN maxwell_division_master
                    ON mxd_id = mxemp_emp_division_code
                INNER JOIN maxwell_state_master
                    ON mxst_id = mxemp_emp_state_code
                INNER JOIN maxwell_branch_master
                    ON mxb_id = mxemp_emp_branch_code
                WHERE DATE(mxemp_emp_date_of_join)
                    BETWEEN '$fromdate' AND '$currentdate'
                GROUP BY
                    YEAR(mxemp_emp_date_of_join),
                    MONTH(mxemp_emp_date_of_join)

                UNION ALL

                SELECT
                    YEAR(mxemp_emp_resignation_date) AS year,
                    MONTH(mxemp_emp_resignation_date) AS month,
                    MONTHNAME(mxemp_emp_resignation_date) AS monthname,
                    0 AS joined_count,
                    '' AS joined_employees,
                    COUNT(*) AS resigned_count,
                    GROUP_CONCAT(mxemp_emp_id) AS resigned_employees
                FROM maxwell_employees_info
                WHERE DATE(mxemp_emp_resignation_date)
                    BETWEEN '$fromdate' AND '$currentdate'
                    AND mxemp_emp_resignation_date IS NOT NULL
                    AND mxemp_emp_resignation_date != '0000-00-00 00:00:00'
                GROUP BY
                    YEAR(mxemp_emp_resignation_date),
                    MONTH(mxemp_emp_resignation_date)
            ) AS subquery
            GROUP BY year, month
            ORDER BY year DESC, month DESC
        ";

        $queryrj = $this->db->query($qrj);
        $result = $queryrj->result_array();

        foreach ($result as $row) {

            $monthLabel = date(
                'M Y',
                strtotime($row['year'] . '-' . $row['month'] . '-01')
            );

            $months[] = $monthLabel;
            $joined[] = (int)$row['joined_count'];
            $resigned[] = (int)$row['resigned_count'];

            $joinedEmployees = [];

            if (!empty($row['joined_employees'])) {
                $joinedEmployees = array_values(
                    array_unique(
                        array_filter(
                            explode(',', $row['joined_employees'])
                        )
                    )
                );
            }

            $resignedEmployees = [];

            if (!empty($row['resigned_employees'])) {
                $resignedEmployees = array_values(
                    array_unique(
                        array_filter(
                            explode(',', $row['resigned_employees'])
                        )
                    )
                );
            }

            $details[] = array(
                'monthname' => $monthLabel,
                'joined' => (int)$row['joined_count'],
                'resigned' => (int)$row['resigned_count'],
                'employees' => array_values(
                    array_unique(
                        array_merge(
                            $joinedEmployees,
                            $resignedEmployees
                        )
                    )
                ),
                'joined_employees' => $joinedEmployees,
                'resigned_employees' => $resignedEmployees
            );
        }

        return array(
            'months' => array_reverse($months),
            'joined' => array_reverse($joined),
            'resigned' => array_reverse($resigned),
            'details' => array_reverse($details)
        );
    }

    public function getAllemployeesJoinResignsummaryList($data){
        // print_r($data);
        $type = $data['type'];
        $employeecodes = $data['employeecodes'];
        $companyid = $data['companyid'];
        $divisionid = $data['divisionid'];
        $stateid = $data['stateid'];
        $branchid = $data['branchid'];
        $fromdate = $data['fromdate'];
        $todate = $data['todate'];
        $categories = $data['categories'];

        $employeeArray = explode(',', $employeecodes);


        $this->db->select('mxemp_emp_id as employeecode,mxemp_emp_fname as employeename,mxemp_emp_img as employeeimage,mxemp_emp_date_of_join as dateofjoin, mxemp_emp_resignation_date as dateofresignation, mxemp_emp_current_salary as employeecurrentsalary, mxcp_name as companyname, mxd_name as divisionname, mxst_state as statename, mxb_name as branchname'); 
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        if(!empty($companyid)){
        $this->db->where('mxemp_emp_comp_code', $companyid);
        }
        if(!empty($divisionid)){
        $this->db->where('mxemp_emp_division_code', $divisionid);
        }
        if(!empty($stateid)){
        $this->db->where('mxemp_emp_state_code', $stateid);
        }
        if(!empty($branchid)){
        $this->db->where('mxemp_emp_branch_code', $branchid);
        }
        if (!empty($employeeArray)) {
        $this->db->where_in('mxemp_emp_id', $employeeArray);
        }
        $query = $this->db->get();
        $qry = $query->result_array();


        $response = [];
        $sno = 1;

        foreach ($qry as $val) {

            $row = array(
                'Sno' => $sno,
                'Employee Name' => $val['employeename'],
                'Employee Image' => $val['employeeimage'],
                'Employee Code' => $val['employeecode'],
                'Current Salary' => $val['employeecurrentsalary'],
            );

            if ($categories == 'Joined') {

                $row['Date Of Join'] = $val['dateofjoin'];

            } elseif ($categories == 'Resigned') {

                $row['Date Of Resignation'] = $val['dateofresignation'];

            } else {

                $row['Date Of Join'] = $val['dateofjoin'];
                $row['Date Of Resignation'] = $val['dateofresignation'];
            }

            $row['Company'] = $val['companyname'];
            $row['Division'] = $val['divisionname'];
            $row['State'] = $val['statename'];
            $row['Branch'] = $val['branchname'];

            $response[] = $row;
            $sno++;
        }

        return $response;

    }
    #joinResignsummary
    #branchwisesalaries
    public function getBranchWiseSalarySummary($data){
        $companyid  = $data['esi_company_id'];
        $divisionid = $data['esi_div_id'];
        $stateid    = $data['esi_state_id'];
        $branchid   = $data['esi_branch_id'];
        $employecode = $data['employecode'];

        // Current month and last 11 months
        $currentYearMonth = date('Ym');
        $fromYearMonth    = date('Ym', strtotime('-12 months'));

        $tables = $this->db->query("
            SELECT DISTINCT mxemp_ty_table_name
            FROM maxwell_employee_type_master
            WHERE mxemp_ty_table_name IS NOT NULL
            AND mxemp_ty_table_name != ''
        ")->result_array();

        $salaryData = [];

        foreach ($tables as $row) {

            $table = trim($row['mxemp_ty_table_name']);

            if (!$this->db->table_exists($table)) {
                continue;
            }

            $where = [];

            // Last 12 months filter
            $where[] = "
                s.mxsal_year_month BETWEEN
                '{$fromYearMonth}' AND '{$currentYearMonth}'  AND mxsal_status = 1
            ";

            if (!empty($companyid) && $companyid != 0) {
                $where[] = "
                    s.mxsal_cmp_id =
                    '".$this->db->escape_str($companyid)."'
                ";
            }

            if (!empty($divisionid) && $divisionid != 0) {
                $where[] = "
                    s.mxsal_div_id =
                    '".$this->db->escape_str($divisionid)."'
                ";
            }

            if (!empty($stateid) && $stateid != 0) {
                $where[] = "
                    s.mxsal_state_code =
                    '".$this->db->escape_str($stateid)."'
                ";
            }

            if (!empty($branchid) && $branchid != 0) {
                $where[] = "
                    s.mxsal_branch_code =
                    '".$this->db->escape_str($branchid)."'
                ";
            }

            $sql = "
                SELECT
                    s.mxsal_year_month,
                    s.mxsal_branch_code,
                    b.mxb_name AS branchname,
                    SUM(s.mxsal_gross_sal) AS gross_salary,
                    GROUP_CONCAT(DISTINCT s.mxsal_emp_code) AS employee_codes
                FROM {$table} s
                INNER JOIN maxwell_branch_master b
                    ON b.mxb_id = s.mxsal_branch_code
            ";

            if (!empty($where)) {
                $sql .= " WHERE " . implode(' AND ', $where);
            }

            $sql .= "
                GROUP BY
                    s.mxsal_year_month,
                    s.mxsal_branch_code
            ";

            $results = $this->db->query($sql)->result_array();

            foreach ($results as $result) {

                $key = $result['mxsal_year_month'] .
                    '_' .
                    $result['mxsal_branch_code'];

                if (!isset($salaryData[$key])) {

                    $salaryData[$key] = [
                        'yearmonth'    => $result['mxsal_year_month'],
                        'branchcode'   => $result['mxsal_branch_code'],
                        'branchname'   => $result['branchname'],
                        'gross_salary' => 0,
                        'employees'    => []
                    ];
                }

                $salaryData[$key]['gross_salary'] +=
                    (float)$result['gross_salary'];

                if (!empty($result['employee_codes'])) {

                    $employees = explode(
                        ',',
                        $result['employee_codes']
                    );

                    $salaryData[$key]['employees'] =
                        array_values(
                            array_unique(
                                array_merge(
                                    $salaryData[$key]['employees'],
                                    $employees
                                )
                            )
                        );
                }
            }
        }

        $salaryData = array_values($salaryData);

        usort($salaryData, function ($a, $b) {
            return strcmp(
                $a['yearmonth'],
                $b['yearmonth']
            );
        });

        $months = [];
        $series = [];
        $details = [];

        foreach ($salaryData as $row) {

            if (!in_array($row['yearmonth'], $months)) {
                $months[] = $row['yearmonth'];
            }
        }

        foreach ($salaryData as $row) {

            $branchName = trim($row['branchname']);

            if (!isset($series[$branchName])) {

                $series[$branchName] = [
                    'name' => $branchName,
                    'data' => array_fill(
                        0,
                        count($months),
                        0
                    )
                ];
            }
        }

        foreach ($salaryData as $row) {

            $monthIndex = array_search(
                $row['yearmonth'],
                $months
            );

            $branchName = trim($row['branchname']);

            $series[$branchName]['data'][$monthIndex] =
                round($row['gross_salary'], 2);

            $details[$branchName][$monthIndex] = [
                'yearmonth'    => $row['yearmonth'],
                'branchcode'   => $row['branchcode'],
                'branchname'   => $row['branchname'],
                'gross_salary' => $row['gross_salary'],
                'employees'    => $row['employees']
            ];
        }

        // Format months
        $formattedMonths = [];

        foreach ($months as $month) {

            $formattedMonths[] = date(
                'M Y',
                strtotime(
                    substr($month, 0, 4)
                    . '-' .
                    substr($month, 4, 2)
                    . '-01'
                )
            );
        }

        return [
            'months'  => $formattedMonths,
            'series'  => array_values($series),
            'details' => $details
        ];
    }
    #branchwisesalaries
    // Service History
    public function getServiceCategorySummary($data){
        $companyid  = $data['esi_company_id'];
        $divisionid = $data['esi_div_id'];
        $stateid    = $data['esi_state_id'];
        $branchid   = $data['esi_branch_id'];
        $employecode = $data['employecode'];

        $query = $this->db->query("
        SELECT *
        FROM (
            SELECT
                mxemp_emp_id,
                mxemp_emp_resignation_status,
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
                END AS service_category
            FROM maxwell_employees_info
            INNER JOIN maxwell_division_master
                ON mxd_id = mxemp_emp_division_code
            INNER JOIN maxwell_state_master
                ON mxst_id = mxemp_emp_state_code
            INNER JOIN maxwell_branch_master
                ON mxb_id = mxemp_emp_branch_code
            WHERE mxemp_emp_resignation_status IN ('W','R')
        ) t
        ORDER BY FIELD(
            service_category,
            'Less than 1 year',
            '1 year',
            '2 years',
            '3 years',
            '4 years',
            '5 years',
            '6 years',
            '7 years',
            '8 years',
            '9 years',
            '10 years',
            'More than 10 years'
        )
        ");

        $rows = $query->result_array();

        $response = [];

        foreach ($rows as $row) {

            $category = $row['service_category'];

            if (!isset($response[$category])) {

                $response[$category] = [
                    'service_category'        => $category,
                    'working_count'           => 0,
                    'resigned_count'          => 0,
                    'total_count'             => 0,
                    'working_employee_codes'  => [],
                    'resigned_employee_codes' => []
                ];
            }

            if ($row['mxemp_emp_resignation_status'] == 'R') {

                $response[$category]['resigned_count']++;

                $response[$category]['resigned_employee_codes'][] =
                    $row['mxemp_emp_id'];

            } else {

                $response[$category]['working_count']++;

                $response[$category]['working_employee_codes'][] =
                    $row['mxemp_emp_id'];
            }

            $response[$category]['total_count']++;
        }

        return array_values($response);
    }

    public function getServiceCategorySummaryList($data){
        // print_r($data);exit;
        $type = $data['type'];
        $employeecodes = $data['employeecodes'];
        $companyid = $data['companyid'];
        $divisionid = $data['divisionid'];
        $stateid = $data['stateid'];
        $branchid = $data['branchid'];
        $fromdate = $data['fromdate'];
        $todate = $data['todate'];
        $categories = $data['categories'];

        $employeeArray = explode(',', $employeecodes);
        // print_r($employeeArray); exit;

        $this->db->select('mxemp_emp_id as employeecode,mxemp_emp_fname as employeename,mxemp_emp_img as employeeimage,mxemp_emp_date_of_join as dateofjoin, mxemp_emp_resignation_date as dateofresignation, mxemp_emp_current_salary as employeecurrentsalary, mxcp_name as companyname, mxd_name as divisionname, mxst_state as statename, mxb_name as branchname'); 
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        if(!empty($companyid)){
        $this->db->where('mxemp_emp_comp_code', $companyid);
        }
        if(!empty($divisionid)){
        $this->db->where('mxemp_emp_division_code', $divisionid);
        }
        if(!empty($stateid)){
        $this->db->where('mxemp_emp_state_code', $stateid);
        }
        if(!empty($branchid)){
        $this->db->where('mxemp_emp_branch_code', $branchid);
        }
        if (!empty($employeeArray)) {
        $this->db->where_in('mxemp_emp_id', $employeeArray);
        }
        $query = $this->db->get();
        $qry = $query->result_array();


        $response = [];
        $sno = 1;

        foreach ($qry as $val) {

            $row = array(
                'Sno' => $sno,
                'Employee Name' => $val['employeename'],
                'Employee Image' => $val['employeeimage'],
                'Employee Code' => $val['employeecode'],
                'Current Salary' => $val['employeecurrentsalary'],
            );

            if ($categories == 'Joined') {

                $row['Date Of Join'] = $val['dateofjoin'];

            } elseif ($categories == 'Resigned') {

                $row['Date Of Resignation'] = $val['dateofresignation'];

            } else {

                $row['Date Of Join'] = $val['dateofjoin'];
                $row['Date Of Resignation'] = $val['dateofresignation'];
            }

            $row['Company'] = $val['companyname'];
            $row['Division'] = $val['divisionname'];
            $row['State'] = $val['statename'];
            $row['Branch'] = $val['branchname'];

            $response[] = $row;
            $sno++;
        }

        return $response;

    }
    // Service History
    #Appraisal
    public function checkismanagerorhodoremployee(){
        $employeeid = $this->session->userdata('session_loginperson_id');

        $response = [
            'roles' => ['EMPLOYEE'],
            'permissions' => []
        ];

        $authData = $this->db
            ->select('mxauth_ismanager,mxauth_ishod,mxauth_ishr,mxauth_action')
            ->where('mxauth_employeeid', $employeeid)
            ->where('mxauth_status', 1)
            ->get('maxwell_emp_appraisal_authorizations')
            ->result_array();

        foreach ($authData as $row) {

            if ($row['mxauth_ismanager'] == 1) {
                $response['roles'][] = 'MANAGER';
            }

            if ($row['mxauth_ishod'] == 1) {
                $response['roles'][] = 'HOD';
            }

            if ($row['mxauth_ishr'] == 1) {
                $response['roles'][] = 'HR';
            }

            // Reviewer
            if (
                $row['mxauth_ismanager'] == 0 &&
                $row['mxauth_ishod'] == 0 &&
                $row['mxauth_ishr'] == 0
            ) {
                $response['roles'][] = 'REVIEWER';
            }

            if (!empty($row['mxauth_action'])) {
                $response['permissions'][] = strtoupper(trim($row['mxauth_action']));
            }
        }

        $response['roles'] = array_unique($response['roles']);
        $response['permissions'] = array_unique($response['permissions']);

        return $response;
    }

    public function getAssignedAppraisalEmployees($employeecode){
        $loginemployeeid = $this->session->userdata('session_loginperson_id');

        $result = $this->db
            ->select("
                e.mxemp_emp_id,
                CONCAT(e.mxemp_emp_fname,' ',e.mxemp_emp_lname) AS employee_name,
                a.mxauth_action,
                a.mxauth_ismanager,
                a.mxauth_ishod,
                a.mxauth_ishr
            ")
            ->from('maxwell_emp_appraisal_authorizations a')
            ->join(
                'maxwell_employees_info e',
                'e.mxemp_emp_id = a.mxauth_assigned_employeeid',
                'inner'
            )
            ->where('a.mxauth_employeeid', $loginemployeeid)
            ->where('a.mxauth_assigned_employeeid', $employeecode)
            ->where('a.mxauth_status', 1)
            ->get()
            ->result_array();

        foreach ($result as &$row) {

            $action = strtoupper(trim($row['mxauth_action']));

            $row['canedit'] = ($action == 'ADD') ? 1 : 0;
            $row['canview'] = in_array($action, ['ADD', 'VIEW']) ? 1 : 0;

            if ($row['mxauth_ismanager'] == 1) {
                $row['role'] = 'MANAGER';
            } elseif ($row['mxauth_ishod'] == 1) {
                $row['role'] = 'HOD';
            } elseif ($row['mxauth_ishr'] == 1) {
                $row['role'] = 'HR';
            } else {
                $row['role'] = 'REVIEWER';
            }
        }

        return $result;
    }

    public function getassignquestionlist($data, $flag){
        $employees = $data['appraisalemployees'];
        if (!isset($employees) || empty($employees)) {
            $employees = $this->session->userdata('session_loginperson_id');
        }
        
        $employeeInfo = $this->db
        ->select("CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) AS employee_name,mxemp_emp_dept_code")
        ->where('mxemp_emp_id', $employees)
        ->get('maxwell_employees_info')
        ->row_array();

        // print_r($employeeInfo); exit;

        $quecategory = $data['appraisalcategory'];

        $department = $employeeInfo['mxemp_emp_dept_code'];

        $year = $data['monthyear']; // 04-2026
        $dateObj = DateTime::createFromFormat('!m-Y', $year);
        $yearmonth = $dateObj->format('Y-m');

        $this->db->select('
            mxap_question,
            mxap_assign_id,
            mxap_assign_year_month,
            mxap_assign_dep,
            mxap_assign_catg,
            mxap_assign_queid,
            mxap_assign_employee_code,
            mxap_assign_unitmeasure,
            mxap_assign_weightage,
            mxap_assign_monthlytarget,
            mxap_assign_emp_noofaccounts,
            mxap_assign_emp_client_name,
            mxap_assign_emp_description,
            mxap_assign_emp_achievement,
            mxap_assign_emp_createdtime,
            mxap_assign_emp_modifiedtime,
            mxap_assign_manager_noofaccounts,
            mxap_assign_manager_client_name,
            mxap_assign_manager_review,
            mxap_assign_manager_actual_assesment,
            mxap_assign_manager_createdtime,
            mxap_assign_manager_modifiedtime,
            mxap_assign_hod_noofaccounts,
            mxap_assign_hod_client_name,
            mxap_assign_hod_review,
            mxap_assign_hod_actual_assesment,
            mxap_assign_hod_createdtime,
            mxap_assign_hod_modifiedtime,
            mxap_assign_hr_noofaccounts,
            mxap_assign_hr_client_name,
            mxap_assign_hr_review,
            mxap_assign_hr_actual_assesment,
            mxap_assign_hr_createdtime,
            mxap_assign_hr_modifiedtime,
            mxap_assign_reviewer_noofaccounts,
            mxap_assign_reviewer_client_name,
            mxap_assign_reviewer_review,
            mxap_assign_reviewer_actual_assesment,
            mxap_assign_reviewer_createdtime,
            mxap_assign_reviewer_modifiedtime,
            mxap_assign_que_show,
            mxap_assign_objective,
            mxap_type,
            mxap_formula_type,
            mxap_kpi
        ');
        $this->db->from('maxwell_apprasial_assign_employees');
        $this->db->join(
            'maxwell_apprasial_questions',
            'mxap_id = mxap_assign_queid',
            'INNER'
        );
        $this->db->where('mxap_assign_status', 1);
        $this->db->where('mxap_assign_employee_code', $employees);
        $this->db->where('mxap_assign_dep', $department);
        $this->db->where('mxap_assign_catg', $quecategory);
        $this->db->where('mxap_assign_year_month', $yearmonth);

        if ($flag == 1) {
            $this->db->where('mxap_assign_que_show', 1);
        }
        $qry = $this->db->get()->result_array();

        // =====================================================
        // Authorization Information
        // =====================================================

        $this->db->select("
            mxauth_employeeid,
            mxauth_action,
            mxauth_ismanager,
            mxauth_ishod,
            mxauth_ishr,
            CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) AS employee_name
        ");
        $this->db->from('maxwell_emp_appraisal_authorizations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_employeeid','inner');
        $this->db->where('mxauth_assigned_employeeid', $employees);
        $this->db->where('mxauth_status', 1);

        $authRows = $this->db->get()->result_array();

        $authorizationinfo = [];

        // Employee always has self access
        $authorizationinfo[$employees] = [
            'role'   => 'EMPLOYEE',
            'action' => 'ADD',
            'employee_name' => $employeeInfo['employee_name'],
            'employee_code' => $employees
        ];

        foreach ($authRows as $row) {

            if ($row['mxauth_ismanager'] == 1) {
                $role = 'MANAGER';
            } elseif ($row['mxauth_ishod'] == 1) {
                $role = 'HOD';
            } elseif ($row['mxauth_ishr'] == 1) {
                $role = 'HR';
            } else {
                $role = 'REVIEWER';
            }

            $authorizationinfo[$row['mxauth_employeeid']] = [
                'role'   => $role,
                'action' => strtoupper(trim($row['mxauth_action'])),
                'employee_name' => $row['employee_name'],
                'employee_code' => $row['mxauth_employeeid']
            ];
        }

        // =====================================================
        // Current Logged-In User Access
        // =====================================================

        $loginemployeeid = $this->session->userdata('session_loginperson_id');

        $currentaccess = [
            'role'   => 'EMPLOYEE',
            'action' => 'ADD'
        ];

        if (isset($authorizationinfo[$loginemployeeid])) {
            $currentaccess = $authorizationinfo[$loginemployeeid];
        }

        return [
            'questions'         => $qry,
            'authorizationinfo' => $authorizationinfo,
            'currentaccess'     => $currentaccess
        ];
    }

    public function getEmployeeAppraisalAccess($selectedEmployee){
        $loginemployeeid = $this->session->userdata('session_loginperson_id');

        // Self Appraisal
        if ($selectedEmployee == $loginemployeeid) {
            return [
                'role' => 'EMPLOYEE',
                'action' => 'ADD'
            ];
        }

        $row = $this->db
            ->select('mxauth_action,mxauth_ismanager,mxauth_ishod,mxauth_ishr')
            ->where('mxauth_employeeid', $loginemployeeid)
            ->where('mxauth_assigned_employeeid', $selectedEmployee)
            ->where('mxauth_status', 1)
            ->get('maxwell_emp_appraisal_authorizations')
            ->row_array();

        if (empty($row)) {
            return [
                'role' => 'VIEWER',
                'action' => 'VIEW'
            ];
        }

        if ($row['mxauth_ismanager'] == 1) {
            $role = 'MANAGER';
        } elseif ($row['mxauth_ishod'] == 1) {
            $role = 'HOD';
        } elseif ($row['mxauth_ishr'] == 1) {
            $role = 'HR';
        } else {
            $role = 'REVIEWER';
        }

        return [
            'role' => $role,
            'action' => strtoupper($row['mxauth_action'])
        ];
    }

    public function saveemployeekra($data){
        // print_r($data);exit;
       
        $selectedEmployee = $this->session->userdata('session_loginperson_id');
        if (isset($data['filterdata']['appraisalemployees']) && !empty($data['filterdata']['appraisalemployees'])) {
            $selectedEmployee = $data['filterdata']['appraisalemployees'];
        }
        //  echo $selectedEmployee; exit;
        $access = $this->getEmployeeAppraisalAccess($selectedEmployee);

        if ($access['action'] != 'ADD') {
            return 0;
        }

        $this->db->trans_begin();

        for ($i = 0; $i < count($data['assignid']); $i++) {
            $uparray = [];

            $currentdata = $this->db
                ->select('
                    mxap_assign_emp_createdtime,
                    mxap_assign_manager_createdtime,
                    mxap_assign_hod_createdtime,
                    mxap_assign_hr_createdtime,
                    mxap_assign_reviewer_createdtime
                ')
                ->where('mxap_assign_id', $data['assignid'][$i])
                ->get('maxwell_apprasial_assign_employees')
                ->row_array();

            $date = date('Y-m-d H:i:s');

            /* ================= EMPLOYEE ================= */

            if ($access['role'] == 'EMPLOYEE') {

                $uparray['mxap_assign_emp_description']
                    = $data['desc'][$i] ?? '';

                $uparray['mxap_assign_emp_achievement']
                    = $data['empachivement'][$i] ?? '';

                if (empty($currentdata['mxap_assign_emp_createdtime'])) {
                    $uparray['mxap_assign_emp_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_emp_modifiedtime'] = $date;
                }

                $uparray['mxap_assign_emp_status'] = 'COMPLETED';
            }

            /* ================= MANAGER / REVIEWER ================= */

            if ($access['role'] == 'MANAGER' && $access['action'] == 'ADD') {
                $uparray['mxap_assign_manager_review']
                    = $data['managerdesc'][$i] ?? '';

                $uparray['mxap_assign_manager_actual_assesment']
                    = $data['managerachivement'][$i] ?? '';

                if (empty($currentdata['mxap_assign_manager_createdtime'])) {
                    $uparray['mxap_assign_manager_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_manager_modifiedtime'] = $date;
                }

                $uparray['mxap_manager_approvedby']
                    = $this->session->userdata('session_loginperson_id');

                $uparray['mxap_assign_manager_status']
                    = 'COMPLETED';
            }

            /* ================= HOD ================= */

            if (
                $access['role'] == 'HOD'
                && $access['action'] == 'ADD'
            ) {

                $uparray['mxap_assign_hod_review']
                    = $data['hoddesc'][$i] ?? '';

                $uparray['mxap_assign_hod_actual_assesment']
                    = $data['hodachivement'][$i] ?? '';

                if (empty($currentdata['mxap_assign_hod_createdtime'])) {
                    $uparray['mxap_assign_hod_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_hod_modifiedtime'] = $date;
                }

                $uparray['mxap_hod_approvedby']
                    = $this->session->userdata('session_loginperson_id');

                $uparray['mxap_assign_hod_status']
                    = 'COMPLETED';
            }

            /* ================= HR ================= */

            if (
                $access['role'] == 'HR'
                && $access['action'] == 'ADD'
            ) {

                $uparray['mxap_assign_hr_review']
                    = $data['hrdesc'][$i] ?? '';

                $uparray['mxap_assign_hr_actual_assesment']
                    = $data['hrachivement'][$i] ?? '';

                if (empty($currentdata['mxap_assign_hr_createdtime'])) {
                    $uparray['mxap_assign_hr_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_hr_modifiedtime'] = $date;
                }

                $uparray['mxap_hr_approvedby']
                    = $this->session->userdata('session_loginperson_id');

                $uparray['mxap_assign_hr_status']
                    = 'COMPLETED';
            }

            if ($access['role'] == 'REVIEWER' && $access['action'] == 'ADD') {
                // print_r($data);exit;
                $uparray['mxap_assign_reviewer_review']
                    = $data['reviewerdesc'][$i] ?? '';

                $uparray['mxap_assign_reviewer_actual_assesment']
                    = $data['reviewerachivement'][$i] ?? '';

                if (empty($currentdata['mxap_assign_reviewer_createdtime'])) {
                    $uparray['mxap_assign_reviewer_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_reviewer_modifiedtime'] = $date;
                }

                $uparray['mxap_reviewer_approvedby']
                    = $this->session->userdata('session_loginperson_id');

                $uparray['mxap_assign_reviewer_status']
                    = 'COMPLETED';
            }

            if (!empty($uparray)) {

                $this->db->where(
                    'mxap_assign_id',
                    $data['assignid'][$i]
                );

                $this->db->update(
                    'maxwell_apprasial_assign_employees',
                    $uparray
                );
                // echo '<pre>';
                // print_r($uparray);
                // echo '</pre>';

                // echo $this->db->last_query();
                // exit;
            }
        }

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();
            return 0;

        } else {

            $this->db->trans_commit();
            return 1;
        }
    }

    public function saveEmployeeKeyCompetencies($data){
        $role = $this->checkismanagerorhodoremployee();

        $this->db->trans_begin();

        for ($i = 0; $i < count($data['question_id']); $i++) {

            $uparray = [];

            $currentdata = $this->db
                ->select('
                    mxap_assign_emp_createdtime,
                    mxap_assign_manager_createdtime,
                    mxap_assign_hod_createdtime
                ')
                ->where('mxap_assign_id', $data['question_id'][$i])
                ->get('maxwell_apprasial_assign_employees')
                ->row_array();

            $date = date('Y-m-d H:i:s');

            /* ================= EMPLOYEE ================= */

            if (in_array('EMPLOYEE', $role)) {

                $uparray['mxap_assign_emp_noofaccounts']
                    = $data['mxap_assign_emp_noofaccounts'][$i] ?? 0;

                if (empty($currentdata['mxap_assign_emp_createdtime'])) {
                    $uparray['mxap_assign_emp_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_emp_modifiedtime'] = $date;
                }

                $uparray['mxap_assign_emp_status'] = 'COMPLETED';
            }

            /* ================= MANAGER ================= */

            if (in_array('MANAGER', $role)) {

                $uparray['mxap_assign_manager_noofaccounts']
                    = $data['mxap_assign_manager_noofaccounts'][$i] ?? 0;

                $uparray['mxap_assign_manager_review']
                    = $data['managerdesc'][$i] ?? '';

                if (empty($currentdata['mxap_assign_manager_createdtime'])) {
                    $uparray['mxap_assign_manager_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_manager_modifiedtime'] = $date;
                }

                $uparray['mxap_assign_manager_status'] = 'COMPLETED';
            }

            /* ================= HOD ================= */

            if (in_array('HOD', $role)) {

                $uparray['mxap_assign_hod_noofaccounts']
                    = $data['mxap_assign_hod_noofaccounts'][$i] ?? 0;

                $uparray['mxap_assign_hod_review']
                    = $data['hoddesc'][$i] ?? '';

                if (empty($currentdata['mxap_assign_hod_createdtime'])) {
                    $uparray['mxap_assign_hod_createdtime'] = $date;
                } else {
                    $uparray['mxap_assign_hod_modifiedtime'] = $date;
                }

                $uparray['mxap_assign_hod_status'] = 'COMPLETED';
            }

            if (!empty($uparray)) {

                $this->db->where(
                    'mxap_assign_id',
                    $data['question_id'][$i]
                );

                $this->db->update(
                    'maxwell_apprasial_assign_employees',
                    $uparray
                );
            }
        }

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();
            return 0;

        } else {

            $this->db->trans_commit();
            return 1;
        }
    }

    public function saveClientDetails($data){
        $date = date('Y-m-d H:i:s');
        $userid = $this->session->userdata('session_loginperson_id');

        foreach($data['client_name'] as $key => $name){
            $detailid = $data['detailid'][$key] ?? '';
            if(!empty($detailid)){
                $uparray = array(
                    'macd_client_name' => $name,
                    'macd_description' => $data['client_description'][$key],
                    'macd_client_email' => $data['client_email'][$key],
                    'macd_client_mobile' => $data['client_mobile'][$key],
                    'macd_ismanager' => $data['is_manager'][$key] ?? 0,
                    'macd_manager_description' => $data['manager_description'][$key] ?? '',
                    'macd_ishod' => $data['is_hod'][$key] ?? 0,
                    'macd_hod_description' => $data['hod_description'][$key] ?? '',
                    'macd_ishr' => $data['is_hr'][$key] ?? 0,
                    'macd_hr_description' => $data['hr_description'][$key] ?? '',
                    'macd_isreviewer' => $data['is_reviewer'][$key] ?? 0,
                    'macd_reviewer_description' => $data['reviewer_description'][$key] ?? '',
                    'macd_modifiedtime' => $date,
                    'macd_modifiedby' => $userid,
                );
                $this->db->where('macd_id', $detailid);
                $this->db->update('maxwell_appraisal_client_details', $uparray);
            }else{
                $ins = array(
                    'macd_assign_id' => $data['modal_assignid'],
                    'macd_employee_code' => $data['modal_empcode'],
                    'macd_client_name' => $name,
                    'macd_description' => $data['client_description'][$key],
                    'macd_client_email' => $data['client_email'][$key],
                    'macd_client_mobile' => $data['client_mobile'][$key],
                    'macd_ismanager' => $data['is_manager'][$key] ?? 0,
                    'macd_manager_description' => $data['manager_description'][$key] ?? '',
                    'macd_ishod' => $data['is_hod'][$key] ?? 0,
                    'macd_hod_description' => $data['hod_description'][$key] ?? '',
                    'macd_ishr' => $data['is_hr'][$key] ?? 0,
                    'macd_hr_description' => $data['hr_description'][$key] ?? '',
                    'macd_isreviewer' => $data['is_reviewer'][$key] ?? 0,
                    'macd_reviewer_description' => $data['reviewer_description'][$key] ?? '',
                    'macd_createdtime' => $date,
                    'macd_createdby' => $userid,
                    'macd_created_role' => $data['modal_currentrole']
                );
                $this->db->insert('maxwell_appraisal_client_details', $ins);
            }
        }

        $assignid = $data['modal_assignid'];

        $employeecount = $this->db
            ->where('macd_assign_id', $assignid)
            ->count_all_results('maxwell_appraisal_client_details');

        $managercount = $this->db
            ->where('macd_assign_id', $assignid)
            ->where('macd_ismanager', 1)
            ->count_all_results('maxwell_appraisal_client_details');

        $hodcount = $this->db
            ->where('macd_assign_id', $assignid)
            ->where('macd_ishod', 1)
            ->count_all_results('maxwell_appraisal_client_details');

        $hrcount = $this->db
            ->where('macd_assign_id', $assignid)
            ->where('macd_ishr', 1)
            ->count_all_results('maxwell_appraisal_client_details');

        $reviewercount = $this->db
            ->where('macd_assign_id', $assignid)
            ->where('macd_isreviewer', 1)
            ->count_all_results('maxwell_appraisal_client_details');

        return array(
            'status' => true,
            'assignid' => $assignid,
            'employeecount' => $employeecount,
            'managercount' => $managercount,
            'hodcount' => $hodcount,
            'hrcount' => $hrcount,
            'reviewercount' => $reviewercount
        );
    }

    public function getClientDetails($assignid,$empcode){
        return $this->db->where('macd_assign_id',$assignid)->where('macd_employee_code',$empcode)->order_by('macd_id','ASC')->get('maxwell_appraisal_client_details')->result_array();
    }

    public function deleteClientDetails($detailid){

        $row = $this->db
            ->where('macd_id', $detailid)
            ->get('maxwell_appraisal_client_details')
            ->row_array();

        if(empty($row)){
            return [
                'status' => 0,
                'message' => 'Record not found.'
            ];
        }

        $currentRole = $this->input->post('currentrole');

        if($row['macd_created_role'] != $currentRole){
            return [
                'status' => 0,
                'message' => 'You are not authorized to delete this record.'
            ];
        }

        $assignid = $row['macd_assign_id'];

        $this->db->where('macd_id', $detailid);

        if($this->db->delete('maxwell_appraisal_client_details')){

            return [
                'status' => 1,
                'message' => 'Details deleted successfully.',
                'assignid' => $assignid
            ];
        }

        return [
            'status' => 0,
            'message' => 'Unable to delete details.'
        ];
    }
    #Appraisal
}