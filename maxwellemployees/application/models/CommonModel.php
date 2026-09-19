<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class CommonModel extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getCompanyfilter(){
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_id','1');
        $query = $this->db->get();
        return $qury = $query->result();
    }

    public function grademaster($id){
        $this->db->select('mxgrd_id,mxgrd_name');
        $this->db->from('maxwell_grade_master');
        $this->db->where('mxgrd_status = 1');
        $this->db->where('mxgrd_comp_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    } 

    public function getdivisions_based_on_branch_master($cmp_id = null, $type = null){
        //--------------SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('distinct(mxb_div_id)');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }
        // BASED ON PERMISSION WE WILL DISPLAY DIVISIONS ACCORDINGLY
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
            $this->db->where_in('mxb_id',$bruser_assigned_br);
        }

        if ($type != null) {
            if ($type == "ESI") {
                $this->db->where('mxb_esi_eligibility', 1);
            } else if ($type == "LWF") {
                $this->db->where('mxb_lwf_eligibility', 1);
            } else if ($type == "PT") {
                $this->db->where('mxb_pt_eligibility', 1);
            }
        }

        $this->db->order_by('mxb_div_id');
        $sub_query = $this->db->get_compiled_select();

        //--------------END SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('mxd_id,mxd_name')->from('maxwell_division_master');
        $this->db->where("mxd_id in($sub_query)");
        $this->db->order_by('mxd_id');
        $query = $this->db->get();
                // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }

    public function getemployeetypemasterdetails($id = null, $cmp_id = null){
        // print_r($cmp_id);exit;
        $this->db->select('mxemp_ty_id,mxemp_ty_cmpid,mxcp_name,mxemp_ty_name,mxemp_ty_short_name,mxemp_ty_table_name,mxemp_ty_is_director,mxemp_ty_is_professionals,mxemp_ty_is_trainees,mxemp_ty_supplementry_table_name');
        $this->db->from('maxwell_employee_type_master');
        $this->db->join('maxwell_company_master', 'mxcp_id=mxemp_ty_cmpid');
        $this->db->where('mxemp_ty_status = 1');
        if ($id != null) {
            $this->db->where('mxemp_ty_id', $id);
        }
        if ($cmp_id != null) {
            $this->db->where('mxemp_ty_cmpid', $cmp_id);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }

    public function getstates_based_on_branch_master($cmp_id = null, $div_id = null, $type = null){
        //--------------SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('distinct(mxb_state_id)');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        // BASED ON PERMISSION WE WILL DISPLAY DIVISIONS ACCORDINGLY
        if($this->session->userdata('user_limiteddropdowns') == 1){
            // $this->db->where('mxb_id',$this->session->userdata('user_branch'));
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
            $this->db->where_in('mxb_id',$bruser_assigned_br);
        }
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }
        if ($div_id != null) {
            $this->db->where('mxb_div_id', $div_id);
        }

        if ($type != null) {
            if ($type == "ESI") {
                $this->db->where('mxb_esi_eligibility', 1);
            } else if ($type == "LWF") {
                $this->db->where('mxb_lwf_eligibility', 1);
            } else if ($type == "PT") {
                $this->db->where('mxb_pt_eligibility', 1);
            }
        }

        $this->db->order_by('mxb_state_id');
        $sub_query = $this->db->get_compiled_select();

        //--------------END SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('mxst_id,mxst_state')->from('maxwell_state_master');
        $this->db->where("mxst_id in($sub_query)");
        $this->db->order_by('mxst_id');
        $query = $this->db->get();
                // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }

    public function getbranches_based_on_eligibility_state_wise($cmp_id = null, $div_id = null, $state_id = null, $type = null, $is_headoffice = null){

        $this->db->select('mxb_id,mxb_name,mxb_is_head_office');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        // BASED ON PERMISSION WE WILL DISPLAY DIVISIONS ACCORDINGLY
        if($this->session->userdata('user_limiteddropdowns') == 1){
            // $this->db->where('mxb_id',$this->session->userdata('user_branch'));
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
            $this->db->where_in('mxb_id',$bruser_assigned_br);
        }
        if ($type == "ESI") {
            $this->db->where('mxb_esi_eligibility', 1);
        } else if ($type == "LWF") {
            $this->db->where('mxb_lwf_eligibility', 1);
        } else if ($type == 'PT') {
            $this->db->where('mxb_pt_eligibility', 1);
        }
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }
        if ($div_id != null) {
            $this->db->where('mxb_div_id', $div_id);
        }
        if ($state_id != null) {
            $this->db->where('mxb_state_id', $state_id);
        }
        if ($is_headoffice != null) {
            $this->db->where('mxb_is_head_office', 1);
        }
        $this->db->order_by('mxb_id');
        $query = $this->db->get();
                // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
    
    public function cms_getcompany_data($fieldname){
        // $company_id = $this->session->userdata('user_company');
        $this->db->select('comapny_reg_id,company_reg_name');
        $this->db->from('work_company');
        // $this->db->where('comapny_reg_id',$company_id);
        $this->db->where('company_reg_status','1');
        $this->db->Order_by('company_reg_name');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function employeeLeaveMasterTypes($leaves){
        // $company_id = $this->session->userdata('user_company');
        $this->db->select('mxlt_leave_name,mxlt_leave_short_name,mxlt_id');
        $this->db->from('maxwell_leave_type_master');
        $this->db->where('mxlt_status','1');
        $this->db->where_in('mxlt_id',$leaves);
        $this->db->Order_by('mxlt_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = ''){
        $employeecode = $this->session->userdata('session_loginperson_id');
        $this->db->select('mxauth_emp_code,mxemp_emp_fname');
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_emp_code','inner');
        $this->db->where('mxauth_reporting_head_emp_code', $employeecode);
        $this->db->where('mxauth_status', 1);
        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->where('mxauth_emp_code !=', '');
        $this->db->order_by('mxauth_emp_code', 'ASC');
        $query = $this->db->get();
        return $empids = $query->result_array();
    }

    public function displayOptions($leaves){
        // $company_id = $this->session->userdata('user_company');
        
        $ids = explode(',', $leaves['customvalue']['Ids']); // convert string to array
        switch ($leaves['customvalue']['Type']) {
            case 'LeaveType':
            $this->db->select('mxlt_leave_name as descr,mxlt_id as field_value');
            $this->db->from('maxwell_leave_type_master');
            $this->db->where('mxlt_status','1');
            $this->db->where_in('mxlt_id',$ids);
            $this->db->Order_by('mxlt_id');
            $query = $this->db->get();
                // echo $this->db->last_query(); //exit;
            $qury = $query->result();
            break;
            default:
            $this->db->select('field_value,descr');
            $this->db->from('options_table');
            $this->db->where('field_name',$leaves);
            $this->db->where('options_status','1');
            $this->db->Order_by('descr');
            $query = $this->db->get();
            $qury = $query->result();
            break;
        }
        return $qury;
    }

    public function manageremployeesleaveList($data){
            $company = $data['esi_company_id'];
            $division = $data['esi_div_id'];
            $state = $data['esi_state_id'];
            $branch = $data['esi_branch_id'];
            $employeecode = $this->session->userdata('session_loginperson_id');
            $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,mxemp_emp_img as empimg,
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
                END AS leavestatuss,
                CASE 
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 0 THEN 'Pending'
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 1 THEN 'Approved'
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 2 THEN 'Rejected'
                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 0 THEN 'Pending'
                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 1 THEN 'Approved'
                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 2 THEN 'Rejected'
                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 0 THEN 'Pending'
                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 1 THEN 'Approved'
                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 2 THEN 'Rejected'
                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 0 THEN 'Pending'
                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 1 THEN 'Approved'
                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 2 THEN 'Rejected'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 9 THEN 'Pending'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 3 THEN 'HR Approved'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 1 THEN 'Approved'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 2 THEN 'Rejected'
                ELSE ''
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
                AND b.mxar_final_accept_status = 3                                   
                ) AS total_used,mxdesg_name as desginationname
                ");
                                // AND b.mxar_from >= '$formattedfrom'
                                // AND b.mxar_to <= '$formattedto'
    $this->db->from('attendance_user_leaveadjust');
    $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
    $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'Inner');
    $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'Inner');
    $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'Inner');
    $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'Inner');
    $this->db->join('maxwell_leave_type_master', 'mxlt_id = mxar_leavetypeid', 'Inner');
    $this->db->join('maxwell_emp_leave_balance', 'mxemp_leave_bal_emp_id = mxemp_emp_id and mxemp_leave_bal_leave_type =mxar_leavetypeid', 'Inner');
    $this->db->where('mxar_status','1');
    $this->db->where_In('mxar_appliedby_emp_code', $data['employee_ids']);
    if($data['leavestatus'] != 'ALL'){
        $this->db->where("
            (
            CASE 
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 0 THEN '0'
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 1 THEN '1'
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 2 THEN '2'

            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 0 THEN '0'
            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 1 THEN '1'
            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 2 THEN '2'

            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 0 THEN '0'
            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 1 THEN '1'
            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 2 THEN '2'

            WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 0 THEN '0'
            WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 1 THEN '1'
            WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 2 THEN '2'

            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 9 THEN '0'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 3 THEN '3'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 1 THEN '1'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_final_accept_status = 2 THEN '2'

            ELSE ''
            END
            ) = '".$data['leavestatus']."'
            ");
    }
    if($data['customoption'] != 'ALL' && $data['customoption'] != '' ){
        $this->db->where('mxar_leavetypeid', $data['customoption']);
    }
    if (!empty($data['fromdate'])) {                               
        $this->db->where('mxar_from >=', $data['fromdate']);
    }
    if (!empty($data['todate'])) {  
        $this->db->where('mxar_to <=', $data['todate']);
    }
    if(!empty($company)){
        $this->db->where('mxar_comp_id', $company);
    }
    if(!empty($division)){
        $this->db->where('mxar_div_id', $division);
    }
    if(!empty($state)){
        $this->db->where('mxar_state_id', $state);
    }
    if(!empty($branch)){
         $this->db->where('mxar_branch_id', $branch);
    }                            
    $this->db->order_by("mxar_createdtime", "desc");
    $query= $this->db->get();
    $result = $query->result();
                                // echo $this->db->last_query();  exit;
    return $result;
    }

    public function manageremployeesregulationList($data){
        $company = $data['esi_company_id'];
        $division = $data['esi_div_id'];
        $state = $data['esi_state_id'];
        $branch = $data['esi_branch_id'];
        $employeecode = $this->session->userdata('session_loginperson_id');
        $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename, mxemp_emp_img as pimage,
            mxar_appliedby_emp_code as employeeid,mxar_from as from,mxdesg_name as desginationname,
            mxar_to as to,mxar_desc as emp_description,
            mxar_attend_countdays as countdays,
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
            CASE 
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 0 THEN 'Pending'
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 1 THEN 'Approved'
            WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 2 THEN 'Rejected'
            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 0 THEN 'Pending'
            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 1 THEN 'Approved'
            WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 2 THEN 'Rejected'
            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 0 THEN 'Pending'
            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 1 THEN 'Approved'
            WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 2 THEN 'Rejected'
            WHEN mxar_auth4_empname = '$employeecode' and mxar_auth4_status = 0 THEN 'Pending'
            WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 1 THEN 'Approved'
            WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 2 THEN 'Rejected'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 9 THEN 'Pending'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 3 THEN 'HR Approved'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 1 THEN 'Approved'
            WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 2 THEN 'Rejected'
            ELSE ''
            END AS regulation_status,mxar_reason as reason,mxar_type as regulationtype");
        $this->db->from('attendance_regulation');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
        $this->db->join('maxwell_division_master', 'mxd_id = mxar_div_id', 'Inner');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxar_branch_id', 'Inner');
        $this->db->join('maxwell_state_master', 'mxst_id = mxar_state_id', 'Inner');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'Inner');
                                // $this->db->where('mxar_status','1');   
        $this->db->where_In('mxar_appliedby_emp_code', $data['employee_ids']);   
        if($data['leavestatus'] != 'ALL'){
            $this->db->where("
                (
                CASE 
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 0 THEN '0'
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 1 THEN '1'
                WHEN mxar_auth1_empcode = '$employeecode' and mxar_auth1_status = 2 THEN '2'

                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 0 THEN '0'
                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 1 THEN '1'
                WHEN mxar_auth2_empcode = '$employeecode' and mxar_auth2_status = 2 THEN '2'

                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 0 THEN '0'
                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 1 THEN '1'
                WHEN mxar_auth3_empcode = '$employeecode' and mxar_auth3_status = 2 THEN '2'

                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 0 THEN '0'
                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 1 THEN '1'
                WHEN mxar_auth4_empcode = '$employeecode' and mxar_auth4_status = 2 THEN '2'

                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 9 THEN '0'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 3 THEN '3'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 1 THEN '1'
                WHEN mxar_authfinal_empcode = '$employeecode' and mxar_authfinal_status = 2 THEN '2'
                ELSE ''
                END
                ) = '".$data['leavestatus']."'
                ");
        }
        if (!empty($data['fromdate'])) {                               
            $this->db->where('mxar_from >=', $data['fromdate']);
        }
        if (!empty($data['todate'])) {  
            $this->db->where('mxar_to <=', $data['todate']);
        }       
        if($data['regulationtype'] != 'ALL' && $data['regulationtype'] != ''){
            $this->db->where('mxar_type', $data['regulationtype']);
        }
        if(!empty($company)){
        $this->db->where('mxar_comp_id', $company);
        }
        if(!empty($division)){
            $this->db->where('mxar_div_id', $division);
        }
        if(!empty($state)){
            $this->db->where('mxar_state_id', $state);
        }
        if(!empty($branch)){
             $this->db->where('mxar_branch_id', $branch);
        } 
        $this->db->order_by("mxar_createdtime", "desc");
        $query= $this->db->get();
        $result = $query->result();
                                // echo $this->db->last_query();
                                // exit;
        return $result;
    }

    public function getAssignedAppraisalEmployees($employeeid = ''){
        if (empty($employeeid)) {
            $employeeid = $this->session->userdata('session_loginperson_id');
        }

    return $this->db->select('mxauth_assigned_employeeid as employeecode, mxemp_emp_fname as employeename')
        ->from('maxwell_emp_appraisal_authorizations')
        ->join('maxwell_employees_info', 'mxemp_emp_id = mxauth_assigned_employeeid', 'INNER')
        ->where('mxauth_employeeid', $employeeid)
        ->where('mxauth_status', 1)
        ->group_by('mxauth_assigned_employeeid')
        ->get()
        ->result_array();
    }
}