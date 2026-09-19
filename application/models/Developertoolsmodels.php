<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Developertoolsmodels extends CI_Model {
 
        public function __construct(){
            $this->load->database();
        }
        
        public function getmenus($data) {
            $menutype = $data['menutype'];
            $this->db->select('*');
            if($menutype == 1){
            $this->db->from('maxwell_menu_group');
            }elseif($menutype == 2) {
            $this->db->from('maxwell_menu_group_mobile');
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function savemenudetails($data){
            $menutype = $data['menutype'];
            $menuname = $data['menuname'];
            $menuicon = $data['menuicon'];
            
                $inarray = array(
                    "maxgp_name" => $menuname,
                    "maxgp_icon" => $menuicon,
                    "maxgp_status" => '1',
                    "maxgp_createdby" => $this->session->userdata('user_id'),
                );
            if($menutype == 1){
                $qry = $this->db->insert('maxwell_menu_group', $inarray);
            }elseif($menutype == 2){
                $qry = $this->db->insert('maxwell_menu_group_mobile', $inarray);
            }
            return $qry;
        }

        public function editsavemenudetails($data){ 
            $menutype = $data['editmenutype'];
            $menuname = $data['editmenuname'];
            $menuicon = $data['editmenuicon'];
            $menuorder = $data['editmenuorder'];
            $menuuniqueid = $data['editmenuuniqueid'];
            $menustatus = $data['editmenustatus'];
            $menuisreport = $data['editmenuisreport'];
           
                $uparray = array(
                    "maxgp_name" => $menuname,
                    "maxgp_icon" => $menuicon,
                    "maxgp_order" => $menuorder,
                    "maxgp_status" => $menustatus,
                    "maxgp_is_report" => $menuisreport,
                );
            if($menutype == 1){
                $this->db->where('maxgp_id', $menuuniqueid);
                $qry = $this->db->update('maxwell_menu_group', $uparray);
            }elseif($menutype == 2){
                $this->db->where('maxgp_id', $menuuniqueid);
                $qry = $this->db->update('maxwell_menu_group_mobile', $uparray);
            }
            return $qry;
        }

        public function savesubmenudetails($data){
            $menutype = $data['menutype'];
            $menuname = $data['menuname'];
            $submenuname = $data['submenuname'];
            $submenulink = $data['submenulink'];
            
                $inarray = array(
                    "maxpg_gp_id" => $menuname,
                    "maxpg_name" => $submenuname,
                    "maxpg_link" => $submenulink,
                    "maxpg_status" => '1',
                    "maxpg_createdby" => $this->session->userdata('user_id'),
                );
            if($menutype == 1){
                $qry = $this->db->insert('maxwell_submenu_page', $inarray);
            }elseif($menutype == 2){
                $qry = $this->db->insert('maxwell_submenu_page_mobile', $inarray);
            }
            return $qry;
        }

        public function getsubmenus($data) {
            $menutype = $data['menutype'];
            $menuname = $data['menuname'];
            $this->db->select('*');
            if($menutype == 1){
            $this->db->from('maxwell_submenu_page');
            }elseif($menutype == 2) {
            $this->db->from('maxwell_submenu_page_mobile');
            }
            $this->db->where('maxpg_gp_id',$menuname);
            $query = $this->db->get();
            return $query->result();
        }

        public function editsavesubmenudetails($data){
            $menutype = $data['editsubmenutype'];
            $menuname = $data['editsubmenuname'];
            $menulink = $data['editsubmenulink'];
            $menuorder = $data['editsubmenuorder'];
            $menuuniqueid = $data['editsubmenuuniqueid'];
            $menustatus = $data['editsubmenustatus'];
            $menuisreport = $data['editsubmenuisreport'];
            $mov_menuname = $data['mov_menuname'];
                $uparray = array(
                    "maxpg_name" => $menuname,
                    "maxpg_link" => $menulink,
                    "maxpg_order" => $menuorder,
                    "maxpg_status" => $menustatus,
                    "maxpg_gp_id" => $mov_menuname,
                    "maxpg_is_report" => $menuisreport,
                );
            if($menutype == 1){
                $this->db->where('maxpg_id', $menuuniqueid);
                $qry = $this->db->update('maxwell_submenu_page', $uparray);
            }elseif($menutype == 2){
                $this->db->where('maxpg_id', $menuuniqueid);
                $qry = $this->db->update('maxwell_submenu_page_mobile', $uparray);
            }
            return $qry;           
        }
        
    public function employeedetails_list($employeeid,$year){
            // Employee Info
            $this->db->select('mxemp_emp_autouniqueid as autouniqueid,mxemp_emp_date_of_join as dateofjoin,mxemp_emp_comp_code as companyid,mxemp_emp_division_code as divisionid,mxemp_emp_branch_code as branchid,mxemp_emp_sub_branch_code as subbranchid,
            mxemp_emp_dept_code as departmentid,mxemp_emp_grade_code as gradeid,mxgrd_name as gradename,mxemp_emp_desg_code as designationid,mxemp_emp_state_code as stateid,mxemp_emp_type employement_type_id,mxemp_emp_type_name as employement_type_name,mxemp_emp_id as employeeid,mxemp_emp_fname as employee_firstname,
            mxemp_emp_lname as employee_lastname,mxemp_emp_img as employee_image,mxemp_emp_gender as employee_gender,mxemp_emp_marital_status as employee_marital_status,mxemp_emp_bloodgroup as employee_bloodgroup,mxemp_emp_phone_no as employee_phone_no,mxemp_emp_alt_phn_no as employee_alternate_no,mxemp_emp_email_id as employee_emailid,
            mxemp_emp_date_of_birth as employee_date_of_birth,mxemp_emp_mother_tongue as employee_mothertongue,mxemp_emp_caste as employee_caste,mxemp_emp_age as employee_age,mxemp_emp_empguarantorsdetails as employee_guarantorsdetails,mxemp_emp_license as employee_license,mxemp_emp_present_address1 as employee_presentaddress_1,
            mxemp_emp_present_address2 as employee_presentaddress2,mxemp_emp_present_city as employee_preserntcity,mxemp_emp_present_state as employee_presentstate,mxemp_emp_present_country as employee_presentcountry,mxemp_emp_present_postalcode as employee_present_postalcode,mxemp_emp_fixed_address1 as employee_permanent_address1,
            mxemp_emp_fixed_address2 as employee_permanent_address2,mxemp_emp_fixed_city as employee_permanent_city,mxemp_emp_fixed_state as employee_permanent_state,mxemp_emp_fixed_country as employee_permanent_country,mxemp_emp_fixed_postalcode as employee_permanent_postalcode,mxemp_emp_current_salary as employee_current_salary,
            mxemp_emp_bank_name as employee_bankname,mxemp_emp_bank_branch_name as employee_bankbranchname,mxemp_emp_bank_acc_no as employee_bankaccountno,mxemp_emp_bank_ifsci_no as employee_bank_ifscino,mxemp_emp_panno as employee_panno,mxemp_emp_esi_number as employee_esino,mxemp_emp_pf_number as employee_pfno,
            mxemp_emp_uan_number as employee_uan_no,mxemp_emp_status as employee_status,mxcp_name as companyname,mxdesg_name as designationname,mxdpt_name as departmentname,mxd_name as divisionname,mxb_name as branchname,mxgrd_name as gradename,mxemp_emp_having_vehicle as employee_having_vehicle,mxemp_emp_vehicle_type as employee_vehicle_type,
            mxemp_emp_resignation_status as employee_resignationstatus,mxemp_emp_resignation_reason as employee_resignation_reason,mxemp_emp_resignation_date as employee_resignation_date,mxemp_emp_resignation_relieving_date as employee_relieving_date,
            mxemp_emp_resignation_relieving_settlement_date as employee_resignation_relieving_settlement_date,mxemp_emp_resignation_relieving_settlement_amount as employee_resignation_relieving_settlement_amount,mxemp_emp_resignation_relieving_esi_settlement_date as employee_resignation_relieving_esi_settlement_date,
            mxemp_emp_resignation_relieving_pf_settlement_date as employee_resignation_relieving_pf_settlement_date,mxemp_emp_panimage as employee_panimage,mxemp_emp_aadhar as employee_aadhar,mxemp_emp_aadharimage as employee_aadharimage,mxst_state as statename,mxemp_ty_name as employee_typename,mxemp_emp_guarantors_letter as employee_guarantors_letter,
            empmaritaldate as employee_marital_date,mxemp_emp_present_since as employee_present_since,mxemp_emp_fixed_present_since as employee_permanent_since,mxemp_ty_name as employee_typename,mxemp_emp_img');
            $this->db->from('maxwell_employees_info');
            $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
            $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
            $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
            $this->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
            $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
            $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'INNER');
            $this->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
            $this->db->join('maxwell_employee_type_master', 'mxemp_ty_id = mxemp_emp_type', 'INNER');
            $this->db->where('mxemp_emp_id', $employeeid);
            $this->db->where('mxemp_emp_status', 1);
            $query1 = $this->db->get();
            $qry1 = $query1->result();
            $returnarray['Employee_Details'] = $qry1;
            // Employee Info
    
            $this->db->select('mxemp_leave_bal_id,mxemp_leave_bal_emp_id,mxemp_leave_bal_comp,mxemp_leave_bal_division,mxemp_leave_bal_branch,mxemp_leave_bal_dept,mxemp_leave_bal_grade,mxemp_leave_bal_desg,mxemp_leave_bal_state,mxemp_leave_bal_leave_type_name,mxemp_leave_bal_leave_type_shrt_name,mxemp_leave_bal_crnt_bal,mxcp_name,mxdesg_name,mxdpt_name,mxb_name,mxst_state,mxgrd_name,mxd_name');
            $this->db->from('maxwell_emp_leave_balance');
            $this->db->join('maxwell_company_master', 'mxcp_id = mxemp_leave_bal_comp', 'LEFT');
            $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_leave_bal_desg', 'LEFT');
            $this->db->join('maxwell_department_master', 'mxdpt_id = mxemp_leave_bal_dept', 'LEFT');
            $this->db->join('maxwell_division_master', 'mxd_id = mxemp_leave_bal_division', 'LEFT');
            $this->db->join('maxwell_branch_master', 'mxb_id = mxemp_leave_bal_branch', 'LEFT');
            $this->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_leave_bal_grade', 'LEFT');
            $this->db->join('maxwell_state_master', 'mxst_id = mxemp_leave_bal_state', 'LEFT');
            $this->db->where('mxemp_leave_bal_emp_id', $employeeid);
            $this->db->where('mxemp_leave_bal_status','1');
            // echo $this->db->get_compiled_select();exit;
            $query2 = $this->db->get();
            //echo $this->db->get_compile_select();
            $returnarray['Employee_Leaves'] = $query2->result();
    
            $this->db->select('mxemp_emp_lg_id,mxemp_emp_lg_employee_id as loginid,mxemp_emp_lg_fullname as name ,mxemp_emp_lg_password as password,mxemp_emp_lg_app_role as mobilerole,mxemp_emp_lg_app_permissions as mobilepermissions,mxemp_emp_lg_role as hradminrole,mxemp_emp_lg_desktop_permissions as hrpermissions');
            $this->db->from('maxwell_employees_login');
            $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
            $query3 = $this->db->get();
            $returnarray['Employee_Login'] = $query3->result();
    
            $returnarray['Employee_Attendance'] = array();
            for ($month = 1; $month <= 12; $month++) {
    
            if ($month < 10) {
                $month_updated = "0" . $month;
            } else {
                $month_updated = $month;
            }
    
            $table_name = "maxwell_attendance_" . $year . "_" . $month_updated;
            $this->db->select('mx_attendance_emp_code,mxcp_name as companyname,mxd_name as divisionname,mxst_state as statename,mxb_name as branchname,count(*) as days,mx_attendance_cmp_id,mx_attendance_division_id,mx_attendance_state_id,mx_attendance_branch_id');
            $this->db->from($table_name);
            $this->db->join('maxwell_company_master', 'mxcp_id = mx_attendance_cmp_id', 'LEFT');
            $this->db->join('maxwell_division_master', 'mxd_id = mx_attendance_division_id', 'LEFT');
            $this->db->join('maxwell_state_master', 'mxst_id = mx_attendance_state_id', 'LEFT');
            $this->db->join('maxwell_branch_master', 'mxb_id = mx_attendance_branch_id', 'LEFT');
            $this->db->where('mx_attendance_emp_code', $employeeid);
            $query4 = $this->db->get();
            $attr = $query4->result();
            $daysinmonth = cal_days_in_month(CAL_GREGORIAN,$month_updated,$year);
            $month_name = date("F", mktime(0, 0, 0, $month_updated, 10));
            $attr[0]->actualsdays = $month_name .' - '.$daysinmonth;
            // echo '<pre>'; print_r($attr);
           
             array_push($returnarray['Employee_Attendance'],$attr);
            }
    
    
            $this->db->select('mxemp_emp_fname as authfname,mxemp_emp_lname as authlanme ,mxauth_auth_type,mxauth_emp_code,empc.mxcp_name as companyname,empdp.mxdpt_name as departmentname,empb.mxb_name as branchname,emps.mxst_state as statename,empd.mxd_name as divisionname,mxauth_reporting_head_emp_code,empcau.mxcp_name as authcompanyname,empdpau.mxdpt_name as authdepartmentname,empbau.mxb_name as authbranchname,empsau.mxst_state as authstatename,empdau.mxd_name as authdivisionname,mxauth_status');
            $this->db->from('maxwell_emp_authorsations');
            $this->db->join('maxwell_company_master empc', 'empc.mxcp_id = mxauth_comp_id', 'LEFT');
            $this->db->join('maxwell_division_master empd', 'empd.mxd_id = mxauth_div_id', 'LEFT');
            $this->db->join('maxwell_state_master emps', 'emps.mxst_id = mxauth_state_id', 'LEFT');
            $this->db->join('maxwell_branch_master empb', 'empb.mxb_id = mxauth_branch_id', 'LEFT');
            $this->db->join('maxwell_department_master empdp', 'empdp.mxdpt_id = mxauth_dept_id', 'LEFT');
            $this->db->join('maxwell_company_master empcau', 'empcau.mxcp_id = mxauth_comp_id', 'LEFT');
            $this->db->join('maxwell_division_master empdau', 'empdau.mxd_id = mxauth_div_id', 'LEFT');
            $this->db->join('maxwell_state_master empsau', 'empsau.mxst_id = mxauth_state_id', 'LEFT');
            $this->db->join('maxwell_branch_master empbau', 'empbau.mxb_id = mxauth_branch_id', 'LEFT');
            $this->db->join('maxwell_department_master empdpau', 'empdpau.mxdpt_id = mxauth_dept_id', 'LEFT');
            $this->db->join('maxwell_employees_info', 'mxauth_reporting_head_emp_code = mxemp_emp_id', 'LEFT');
            $this->db->where('mxauth_emp_code', $employeeid);
            // echo $this->db->get_compiled_select();exit;
            $query5 = $this->db->get();
            $returnarray['Employee_Authorsations'] = $query5->result();
            return $returnarray;
            // echo '<pre>'; print_r($returnarray); exit;
        }
    
        public function getallroles(){
            $this->db->select('maxuser_roles_id,maxuser_roles_name,maxuser_roles_add,maxuser_roles_edit,maxuser_roles_delete');
            $this->db->from('maxwell_user_roles');
            $this->db->where('maxuser_roles_status',1);
            $query = $this->db->get();
            $qury = $query->result();
            return $qury;
        }
    
        public function mobile_getallroles(){
            $this->db->select('maxuser_roles_id,maxuser_roles_name,maxuser_roles_add,maxuser_roles_edit,maxuser_roles_delete');
            $this->db->from('maxwell_user_roles_mobile');
            $this->db->where('maxuser_roles_status',1);
            $query = $this->db->get();
            $qury = $query->result();
            return $qury;
        }
        
        public function processcsvupload($data){
            $this->db->trans_begin();
            $dt = date('Y-m-d h:i:s');
            foreach ($data as $key => $value) {
                $inarray = array(
                  "mx_employee_id" => strtoupper($value[0]),
                  "mx_category" => $value[1],
                  "mx_fromdate" => empty($value[2]) ? "0000-00-00" : date('Y-m-d',strtotime($value[2])),
                  "mx_todate" => empty($value[3]) ? "0000-00-00" : date('Y-m-d',strtotime($value[3])),
                  "mx_effectivedate" => empty($value[4]) ? "0000-00-00" : date('Y-m-d',strtotime($value[4])),
                  "mx_current_branch" => $value[5],
                  "mx_transfer_branch" => $value[6],
                  "mx_department" => $value[7],
                  "mx_current_designation" => $value[8],
                  "mx_promoted_designation" => $value[9],
                  "mx_increment_amount" => empty($value[10]) ? "0" : $value[10],
                  "mx_remarks" => $value[11],
                  "mx_createdby" => $this->session->userdata('user_id'),
                  "mx_createdtime" => $dt,
                );
                $this->db->insert('maxwell_extra_info', $inarray);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 2;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        }
        
        public function getprocesscsvupload(){
            $this->db->select('mx_id,mx_employee_id,mx_category,mx_fromdate,mx_todate,mx_effectivedate,mx_current_branch,mx_transfer_branch,mx_department,mx_current_designation,mx_increment_amount,mx_remarks');
            $this->db->from('maxwell_extra_info');
            $query = $this->db->get();
            $qury = $query->result();
            return $qury;
        }
        
        public function deletecsvdata($data){
            $id = $data['delid'];
            $this->db->where('mx_id', $id);
            $qury = $this->db->delete('maxwell_extra_info');
            return $qury;
        }
        
        public function config_details(){
            $this->db->select('*');
            $this->db->from('maxwell_config');
            $query = $this->db->get();
            $qry = $query->result_array();
            return $qry;
        }
        
        public function updateconfig($data){
            $this->db->where('id', '1');
            return $qry = $this->db->update('maxwell_config', $data);
        }
        
        public function json_employees_code(){
            $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname');
            $this->db->from('maxwell_employees_info');
            $query = $this->db->get();
            $qry = $query->result();
            return $qry;
        }
        
        public function getcronslogs($data) {
            $crontype = $data['crontypes'];
            $crondate = $data['cronrundate'];
            $this->db->select('*');
            $this->db->from('maxwell_crons_log');
            if(!empty($crontype)){
               $this->db->where('mx_cron',$crontype); 
            }
            if(!empty($crondate)){
                $crondate = date('Y-m-d', strtotime($crondate));
               $this->db->where('DATE(mx_createdtime)',$crondate); 
            }else{
                $date = date('Y-m-d');
                $this->db->where('DATE(mx_createdtime)',$date); 
            }
            $query = $this->db->get();
            return $query->result();
        }
        
        public function getdistinctofcrontypes(){
            $this->db->distinct();
            $this->db->select('mx_cron');
            $this->db->from('maxwell_crons_log');
            $query = $this->db->get();
            $qry = $query->result();
            return $qry;
        }
        
        public function getemaillogs($data){
            $id = $data['id'];
            $emailtype = $data['mailtype'];
            $fromdate = $data['fromdate'];
            $todate = $data['todate'];
            $this->db->select('*');
            $this->db->from('maxwell_work_email_sent_log');
            if(!empty($id)){
            $this->db->where('id',$id);   
            }
            if(!empty($emailtype)){
               $this->db->where('email_type',$emailtype); 
            }
            if(!empty($fromdate) && !empty($todate)){
               $fromdate = date('Y-m-d', strtotime($fromdate));
               $todate = date('Y-m-d', strtotime($todate));
               $this->db->where('DATE(createdtime) >=',$fromdate);
               $this->db->where('DATE(createdtime) <=',$todate);
            }else{
                if(empty($id)){
                $date = date('Y-m-d');
                $this->db->where('DATE(createdtime)',$date); 
                }
            }
            $this->db->order_by("createdtime", "desc");
            $query = $this->db->get();
            $qry = $query->result();
            return $qry;
        }
        
        public function getdistinctemailtypes(){
            $this->db->distinct();
            $this->db->select('email_type');
            $this->db->from('maxwell_work_email_sent_log');
            $query = $this->db->get();
            $qry = $query->result();
            return $qry;
        }
        
        public function getallemployeecodes($data){
            $emailid = $data['email'];
            $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_email_id');
            $this->db->from('maxwell_employees_info');
            $query = $this->db->get();
            $qry = $query->result();
            return $qry;
        }
        
        public function getmobilenoteslist($data){
            $category = $data['category'];
            $employeeid = $data['employeeid'];
            $date = $data['date'];
            $this->db->select('mxn_emplyeeid,,mxn_createdtime,mxn_desc,mxemp_emp_fname,mxemp_emp_lname,mxn_category');
            $this->db->from('maxwell_notes');
            $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxn_emplyeeid', 'LEFT OUTER');
            if($category !='' && strlen($category) > 0){
            $this->db->where('mxn_category', $category);
            }
            if(!empty($employeeid)){
            $this->db->where('mxn_emplyeeid', $employeeid);
            }
            if(!empty($date)){
                $from = date('Y-m-d', strtotime($date)).' 00:00:00';
                $to = date('Y-m-d', strtotime($date)).' 23:59:59';
                $this->db->where('mxn_createdtime >= ', $from);
                $this->db->where('mxn_createdtime <= ', $to);
            }else{
                $from = date('Y-m-d').' 00:00:00';
                $to = date('Y-m-d').' 23:59:59';
                $this->db->where('mxn_createdtime >= ', $from);
                $this->db->where('mxn_createdtime <= ', $to);    
            }
            $this->db->where('mxn_status', 1);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            return $result = $query->result();  
        }

        public function dailybackupslist($data)
        {
            $fromDate = '';
            $toDate   = '';

            // Convert dd-mm-yyyy to Y-m-d
            if (!empty($data['fromdate'])) {
                $from = DateTime::createFromFormat('d-m-Y', trim($data['fromdate']));
                $fromDate = $from ? $from->format('Y-m-d') : '';
            }

            if (!empty($data['todate'])) {
                $to = DateTime::createFromFormat('d-m-Y', trim($data['todate']));
                $toDate = $to ? $to->format('Y-m-d') : '';
            }

            // Backup folder path
            $path = $_SERVER['DOCUMENT_ROOT'] . '/backups/';

            if (!is_dir($path)) {
                echo "Backup directory not found";
                return;
            }

            $files = scandir($path);

            $retrunarray = array();

            foreach ($files as $file) {

                // Skip . and ..
                if ($file == '.' || $file == '..') {
                    continue;
                }

                // Match backup file format
                // Example:
                // dbbackup_2026-05-09_13-03-02.sql.gz
                if (preg_match('/dbbackup_(\d{4})-(\d{2})-(\d{2})_(\d{2})-(\d{2})-(\d{2})\.sql\.gz$/', $file, $parts)) {

                    $year   = $parts[1];
                    $month  = $parts[2];
                    $day    = $parts[3];
                    $hour   = $parts[4];
                    $minute = $parts[5];
                    $second = $parts[6];

                    $fileDate = $year . '-' . $month . '-' . $day;
                    $fileTime = $hour . ':' . $minute . ':' . $second;

                    $fileDateTime = $fileDate . ' ' . $fileTime;

                    // Convert to timestamp for comparison
                    $fileTimestamp = strtotime($fileDate);

                    // From Date Filter
                    if (!empty($fromDate)) {

                        $fromTimestamp = strtotime($fromDate);

                        if ($fileTimestamp < $fromTimestamp) {
                            continue;
                        }
                    }

                    // To Date Filter
                    if (!empty($toDate)) {

                        $toTimestamp = strtotime($toDate);

                        if ($fileTimestamp > $toTimestamp) {
                            continue;
                        }
                    }

                    // Download URL
                    $downloadUrl = base_url('Developertools/downloadBackup?file=' . urlencode($file));

                    // Build Row
                    $buldarray = (object)array(

                        "backup_name"      => $file,

                        "backup_date"      => date('d M Y h:i:s A', strtotime($fileDateTime)),

                        "backup_raw_date"  => $fileDateTime,

                        "download"         => '
                            <a href="' . $downloadUrl . '" 
                               class="btn btn-sm btn-success" 
                               title="Download Backup">
                                <i class="fa fa-download"></i>
                            </a>
                        ',
                    );

                    array_push($retrunarray, $buldarray);
                }
            }

            // Sort latest first
            usort($retrunarray, function ($a, $b) {
                return strtotime($b->backup_raw_date) - strtotime($a->backup_raw_date);
            });

            $columns = [
                'backup_name',
                'backup_date',
                'download'
            ];

            $renameHeaderColumns = [
                'backup_name' => 'Backup File',
                'backup_date' => 'Backup Date & Time',
                'download'    => 'Download'
            ];

            // Mapping
            $dataMappingColumns = array(
                'Translate' => array(),
            );

            // Links/Edit columns
            $urllink = '';
            $linkColumns = array();
            $editColumns = array();

            // Hide raw date column
            $hideColumn = array('backup_raw_date');

            $reportName = 'Database Backups';

            // IMPORTANT:
            // If no data found, send empty array properly
            if (empty($retrunarray)) {
                $retrunarray = array();
            }

            echo dynamicTable(
                $retrunarray,
                $columns,
                $linkColumns,
                $editColumns,
                $dataMappingColumns,
                $renameHeaderColumns,
                $hideColumn,
                $reportName
            );
        }

    public function get_cron_jobs(){
        $this->db->select("csm.cron_id,csm.cron_category,csm.cron_name,csm.cron_url,csm.cron_server_url,csm.cron_timing,csm.cron_description,csm.cron_frequency,csm.cron_status,csm.created_at,csm.updated_at,(SELECT GROUP_CONCAT(cl1.entry_dt ORDER BY cl1.entry_dt ASC SEPARATOR ', ') FROM cron_log cl1 WHERE cl1.cron_refrence_id = csm.cron_id AND DATE(cl1.entry_dt) = (SELECT DATE(MAX(cl2.entry_dt)) FROM cron_log cl2 WHERE cl2.cron_refrence_id = csm.cron_id)) AS latest_run_times");
        $this->db->from('cron_schedule_master csm');
        $this->db->where('csm.cron_status', 'Active');
        $this->db->order_by('csm.cron_category', 'ASC');
        $this->db->order_by('csm.cron_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function saveLeaveValidationRule($data)
{

    $existing = $this->db
        ->where('leave_type',$data['leave_type'])
        ->get('leave_validation_master')
        ->row_array();

    if(!empty($existing)){

        $this->db
            ->where('id',$existing['id'])
            ->update(
                'leave_validation_master',
                [
                    'from_days'              => $data['from_days'],
                    'to_days'                => $data['to_days'],
                    'allow_combination'      => $data['allow_combination'],
                    'allow_combination_type' => $data['allow_combination_type'],
                    'status'                 => $data['status']
                ]
            );

    }else{

        $this->db
            ->insert(
                'leave_validation_master',
                $data
            );

    }

    return true;

}

public function getLeaveValidationRules()
{

    $result = $this->db
        ->get('leave_validation_master')
        ->result_array();

    $response = [];

    foreach($result as $row){

        $response[$row['leave_type']] = $row;

    }

    return $response;

}
        
    }
?>