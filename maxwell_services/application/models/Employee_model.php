<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Employee_model extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getemployeecompletedetails($employeeid)
    {
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
        empmaritaldate as employee_marital_date,mxemp_emp_present_since as employee_present_since,mxemp_emp_fixed_present_since as employee_permanent_since,mxemp_ty_name as employee_typename');
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
        $returnarray['employee_details'] = $qry1;
        // Employee Info
         
        // Academic Records
        $this->db->select('mxemp_emp_acr_id,mxemp_emp_acr_employee_id,mxemp_emp_acr_type,mxemp_emp_acr_yop,mxemp_emp_acr_institution,mxemp_emp_acr_subject,mxemp_emp_acr_university,
                            mxemp_emp_acr_marks,"maxwell_employees_academic_records" as tblname');
        $this->db->from('maxwell_employees_academic_records');
        $this->db->where('mxemp_emp_acr_employee_id', $qry1[0]->mxemp_emp_id);
        // $this->db->where('maxemp_emp_acr_status', 1);
        $query2 = $this->db->get();
        $returnarray['employee_academic_records'] = $query2->result();
        // Academic Records

        // Training
        $this->db->select('mxemp_emp_tr_id,mxemp_emp_tr_employee_id,mxemp_emp_tr_employee_id,mxemp_emp_tr_nameofcourse,mxemp_emp_tr_nameofinstutions,mxemp_emp_tr_fromdate,
                          mxemp_emp_tr_todate,"maxwell_employees_training" as tblname');
        $this->db->from('maxwell_employees_training');
        $this->db->where('mxemp_emp_tr_employee_id', $qry1[0]->mxemp_emp_id);
        $query3 = $this->db->get();
        $returnarray['employee_training'] = $query3->result();
        // Training

        // Family
        $this->db->select('mxemp_emp_fm_id,mxemp_emp_fm_employee_id,mxemp_emp_fm_relation,mxemp_emp_fm_name,mxemp_emp_fm_age,mxemp_emp_fm_occupation,"maxwell_employees_family" as tblname');
        $this->db->from('maxwell_employees_family');
        $this->db->where('mxemp_emp_fm_employee_id', $qry1[0]->mxemp_emp_id);
        $query4 = $this->db->get();
        $returnarray['employee_family'] = $query4->result();
        // Family

        // Previous Employments
        $this->db->select('mxemp_emp_pe_id,mxemp_emp_pe_employee_id,mxemp_emp_pe_periodfromto,mxemp_emp_pe_nameandorg,mxemp_emp_pe_desgjointime,mxemp_emp_pe_desgleavingtime,
                           mxemp_emp_pe_desgreportedto,mxemp_emp_pe_monthlysalary,mxemp_emp_pe_otherbenfits,mxemp_emp_pe_reasonforchange');
        $this->db->from('maxwell_employees_previousemployments');
        $this->db->where('mxemp_emp_pe_employee_id', $qry1[0]->mxemp_emp_id);
        $query5 = $this->db->get();
        $returnarray['employee_previousemployments'] = $query5->result();
        // Previous Employments

        // Nominee Details
        $this->db->select('mxemp_emp_nm_id,mxemp_emp_nm_employee_id,mxemp_emp_nm_type,mxemp_emp_nm_relation,mxemp_emp_nm_relationname,mxemp_emp_nm_relationage,mxemp_emp_nm_relationmobile,
                           mxemp_emp_nm_relationaddress,mxemp_emp_nm_relationpercent,mxemp_emp_nm_relationimage');
        $this->db->from('maxwell_employees_nominee');
        $this->db->where('mxemp_emp_nm_employee_id', $qry1[0]->mxemp_emp_id);
        $query6 = $this->db->get();
        $returnarray['employee_nominee'] = $query6->result();
        // Nominee Details

        // Refrences Details
        $this->db->select('mxemp_emp_rf_id,mxemp_emp_rf_employee_id,mxemp_emp_rf_type,mxemp_emp_rf_relation,mxemp_emp_rf_relationname,mxemp_emp_rf_relationmobile');
        $this->db->from('maxwell_employees_refrence');
        $this->db->where('mxemp_emp_rf_employee_id', $qry1[0]->mxemp_emp_id);
        $query7 = $this->db->get();
        $returnarray['employee_refrence'] = $query7->result();
        // Refrences Details

        // Languages Details
        $this->db->select('mxemp_emp_lng_id,mxemp_emp_lng_employee_id,mxemp_emp_lng,mxemp_emp_lng_speak,mxemp_emp_lng_read,mxemp_emp_lng,mxemp_emp_lng_write,
                           mxlg_name,"maxwell_employees_lanaguages" as tblangname');
        $this->db->from('maxwell_employees_lanaguages');
        $this->db->join('maxwell_languages_master', 'mxemp_emp_lng = mxlg_id', 'INNER');
        $this->db->where('mxemp_emp_lng_employee_id', $qry1[0]->mxemp_emp_id);
        $query8 = $this->db->get();
        $returnarray['employee_lanaguages'] = $query8->result();
        // Languages Details

        // Transfers Details
        $this->db->select('mxemp_trs_comp_name_from,mxemp_trs_comp_name_to,mxemp_trs_div_name_from,mxemp_trs_div_name_to,mxemp_trs_state_name_from,mxemp_trs_state_name_to,
                           mxemp_trs_branch_name_from,mxemp_trs_branch_name_to,mxemp_trs_type,mxemp_trs_from_dt,mxemp_trs_to_dt,mxemp_trs_esi_relieaving_date,
                           mxemp_trs_esi_joining_date,mxemp_trs_emp_releaving_date,mxemp_trs_emp_joining_date,mxemp_trs_remark');
        $this->db->from('maxwell_emp_trasfers');
        $this->db->where('mxemp_trs_emp_code', $qry1[0]->mxemp_emp_id);
        $query9 = $this->db->get();
        $returnarray['employee_transfers'] = $query9->result();
        // Transfers Details

        // Authorizations
        $this->db->select('mxauth_id,mxauth_auth_type,mxauth_div_id,mxauth_emp_code,mxauth_comp_id,');
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_emp_code', $qry1[0]->mxemp_emp_id);
        $this->db->where('mxauth_status',1);
        $query10 = $this->db->get();
        $returnarray['employee_authorizations'] = $query10->result();
        // Authorizations
        if(!empty($returnarray)){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_details'] = $qry1;
            $data1['employee_academic_records'] = $query2->result();
            $data1['employee_training'] = $query3->result();
            $data1['employee_family'] = $query4->result();
            $data1['employee_previousemployments'] = $query5->result();
            $data1['employee_nominee'] = $query6->result();
            $data1['employee_refrence'] = $query7->result();
            $data1['employee_lanaguages'] = $query8->result();
            $data1['employee_transfers'] = $query9->result();
            $data1['employee_authorizations'] = $query10->result();
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
    $returnarray1[]=$returnarray;
        return $returnarray1;
    }
    public function api_updateemployeepassword($employeeid,$oldpswd,$cnfpswd,$newpswd){
        if ($oldpswd == "") {
            $message="Failed";
            $statuscode="500";
            $desc = "Old Password Should Not Be Empty";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }elseif($newpswd == ""){
            $desc="New Password Should Not Be Empty";
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }elseif ($cnfpswd == "") {
            $desc="Conform Password Should Not Be Empty";
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }elseif ($newpswd != $cnfpswd) {
            $desc="Missmatch New Password And Conform Password";
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        else{
            $this->db->select('mxemp_emp_lg_password,mxemp_emp_lg_employee_id,mxemp_emp_lg_id');
            $this->db->from('maxwell_employees_login');
            $this->db->where('mxemp_emp_lg_employee_id',$employeeid);
            $query = $this->db->get();
            $qry = $query->result();
            if($qry[0]->mxemp_emp_lg_password != $oldpswd){
                $desc = "invalid_oldpassword";
                $message="Failed";
                $statuscode="500";
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']=$desc;
                return $data1;
            }else{
                $uparray = array(
                    "mxemp_emp_lg_password" => $cnfpswd
                );
                $this->db->where('mxemp_emp_lg_id', $qry[0]->mxemp_emp_lg_id);
                $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
                $res= $this->db->update('maxwell_employees_login', $uparray);
                if($res ==1){
                    $qry = array('statusmsg'=>"Password Updated");
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data['update_password'] = $qry;
                    return $data1;
                }else{
                    $desc = "Something went wrong";
                    $message="Failed";
                    $statuscode="500";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
            }
        }
    }

    public function api_apprasiallist($employeeid,$departmentid,$quecategory,$year,$month,$flag){
            if ($month < 10 && strlen($month) == 1) {
                $month_updated = "0" . $month;
            } else {
                $month_updated = $month;
            }
        $yearmonth = $year.'_'.$month_updated;
        $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;
        // ------------- 07-01-2022 -------------
        $this->db->distinct();
        $this->db->select('mxauth_reporting_head_emp_code,mxauth_emp_code');
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $this->db->where('mxauth_auth_type = 1');
        $query = $this->db->get();
        $cnt = $query->result();
        $mainemployees = array();
        if(count($cnt) > 0){
            $ismanager =1;
        }else{
            $ismanager =0;
        }
        $this->db->select('mxhod_branch_id,mxhod_dept_id,mxhod_div_id,mxhod_emp_code,mxhod_emp_name');
        $this->db->from('maxwell_hods');
        $this->db->where('mxhod_emp_code', $employeeid);
        $this->db->where('mxhod_status = 1');
        $query = $this->db->get();
        $cnt = $query->result();
        if(count($cnt) > 0){
            $ishod =1;
        }else{
            $ishod =0;
        }
        // --------------07-1-2022---------------
       
        
        $this->db->select('mxap_question as question,mxap_assign_id as autouniqueid,mxap_assign_year_month as yearmonth,mxap_assign_dep as departmentid,mxap_assign_catg as quecategoryid,mxap_assign_queid as questionid,mxap_assign_employee_code as employeeid,mxap_assign_unitmeasure as unitmeasure,mxap_assign_weightage as weightage,mxap_assign_monthlytarget as monthlytarget,mxap_assign_emp_noofaccounts as employee_form_noofaccounts,mxap_assign_emp_client_name as employee_form_client_name,mxap_assign_emp_description as employee_form_description,mxap_assign_emp_achievement as employee_form_achivement,mxap_assign_emp_createdtime as employee_createdtime,mxap_assign_emp_modifiedtime as employee_modifiedtime,mxap_assign_manager_noofaccounts as manager_form_noofaccounts,mxap_assign_manager_client_name as manager_form_client_name,mxap_assign_manager_review as manager_form_description,mxap_assign_manager_actual_assesment as manager_form_achievement,mxap_assign_manager_createdtime as manager_createdtime,mxap_assign_manager_modifiedtime as manager_modifiedtime,mxap_assign_hod_noofaccounts as hod_form_noofaccounts,mxap_assign_hod_client_name as hod_form_client_name,mxap_assign_hod_review as hod_form_description,mxap_assign_hod_actual_assesment as hod_form_achievement,mxap_assign_hod_createdtime as hod_createdtime,mxap_assign_hod_modifiedtime as hod_modifiedtime');
        $this->db->from($tablename);
        $this->db->join('maxwell_apprasial_questions', 'mxap_id = mxap_assign_queid', 'INNER');
        $this->db->where('mxap_assign_status = 1');
        $this->db->where('mxap_assign_employee_code', $employeeid);
        $this->db->where('mxap_assign_dep', $departmentid);
        $this->db->where('mxap_assign_catg', $quecategory);
        if($flag == 1){
            $this->db->where('mxap_assign_que_show = 1');
        }
        $query = $this->db->get();
        if($quecategory == 2){
            for($i=0 ; $i<=count($qry) ; $i++){
              unset($qry[$i]['employee_form_client_name']);
              unset($qry[$i]['employee_form_description']);
              unset($qry[$i]['employee_form_achivement']);
              if($ismanager == 0){
                unset($qry[$i]['manager_form_noofaccounts']);
                unset($qry[$i]['manager_form_description']);
                unset($qry[$i]['manager_form_client_name']);
                unset($qry[$i]['manager_form_achievement']);
                unset($qry[$i]['manager_createdtime']);
                unset($qry[$i]['manager_modifiedtime']);
              }else{
                unset($qry[$i]['manager_form_client_name']);
                unset($qry[$i]['manager_form_achievement']);
              }
             if($ishod == 0){
              unset($qry[$i]['hod_form_noofaccounts']);
              unset($qry[$i]['hod_form_client_name']);
              unset($qry[$i]['hod_form_description']);
              unset($qry[$i]['hod_form_achievement']);
              unset($qry[$i]['hod_createdtime']);
              unset($qry[$i]['hod_modifiedtime']);
             }else{
              // unset($qry[$i]['hod_form_noofaccounts']);
              unset($qry[$i]['hod_form_client_name']);
              // unset($qry[$i]['hod_form_description']);
              unset($qry[$i]['hod_form_achievement']);
              unset($qry[$i]['hod_createdtime']);
              unset($qry[$i]['hod_modifiedtime']);
             
             }
        } }
        $qry = $query->result_array();
        if(count($qry)>0){
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['apprasial_list']=$qry;
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
    
    public function api_apprasialmanagerlist($employeeid,$year,$month){
            if ($month < 10 && strlen($month) == 1) {
                $month_updated = "0" . $month;
            } else {
                $month_updated = $month;
            }
            if(!isset($year) && empty($year)){
                $year = date('Y');
            }
            if(!isset($month) && empty($month)){
                $month_updated = date('m');
            }
            $yearmonth = $year.'_'.$month_updated;
            $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;

            $this->db->distinct();
            $this->db->select('mxauth_reporting_head_emp_code,mxauth_emp_code');
            $this->db->from('maxwell_emp_authorsations');
            $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
            $this->db->where('mxauth_status = 1');
            $this->db->where('mxauth_auth_type = 1');
            $query = $this->db->get();
            $cnt = $query->result();
            $mainemployees = array();
            if(count($cnt) > 0){
                foreach ($cnt as $key => $value) {
                    array_push($mainemployees,$value->mxauth_emp_code);
                }
            }
            $employees = array_values($mainemployees);
            if(count($cnt) > 0){
                $this->db->select('mxemp_emp_id as employeeid,mxemp_emp_fname as employeefirstname,mxemp_emp_lname as employeelastname,mxap_assign_employee_code as assign_employeeid,mxap_assign_year_month as yearmonth,mxap_assign_dep as departmentid,mxap_assign_catg as quecategoryid,mxap_assign_emp_createdtime as employee_createdtime,mxap_assign_emp_modifiedtime as employee_modifiedtime,mxap_assign_manager_createdtime as manager_createdtime,mxap_assign_manager_modifiedtime as manager_modifiedtime');
                $this->db->from('maxwell_employees_info');
                $this->db->join($tablename,"mxap_assign_employee_code = mxemp_emp_id","INNER");
                $this->db->where_in('mxap_assign_employee_code',$employees);
                $this->db->where_not_in('mxemp_emp_id', $employeeid);
                $this->db->group_by('mxap_assign_employee_code');
                $query_e = $this->db->get();
                $qry = $query_e->result();
                $message="Success";
                $statuscode="200";
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']='';
                $data1['manager_apprasial_list']=$qry;
            }else{
                $message="Failed";
                $statuscode="500";
                $desc = "No Data Exist";
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']=$desc;
            }
            return $data1;
    }

    public function api_hodappraisaltoemplist($employeeid,$year,$month){
            if ($month < 10 && strlen($month) == 1) {
                $month_updated = "0" . $month;
            } else {
                $month_updated = $month;
            }
            if(!isset($year) && empty($year)){
                $year = date('Y');
            }
            if(!isset($month) && empty($month)){
                $month_updated = date('m');
            }
            $yearmonth = $year.'_'.$month_updated;
            $tablename = 'maxwell_apprasial_assign_employees_'.$yearmonth;

            $this->db->select('mxhod_branch_id,mxhod_dept_id,mxhod_div_id,mxhod_emp_code,mxhod_emp_name');
            $this->db->from('maxwell_hods');
            $this->db->where('mxhod_emp_code', $employeeid);
            $this->db->where('mxhod_status = 1');
            $query = $this->db->get();
            $cnt = $query->result();
            if(count($cnt) > 0){
                $this->db->select('mxemp_emp_id as employeeid,mxemp_emp_fname as employeefirstname,mxemp_emp_lname as employeelastname,mxap_assign_employee_code as assign_employeeid,mxap_assign_year_month as yearmonth,mxap_assign_dep as departmentid,mxap_assign_catg as quecategoryid,mxap_assign_emp_createdtime as employee_createdtime,mxap_assign_emp_modifiedtime as employee_modifiedtime,mxap_assign_manager_createdtime as manager_createdtime,mxap_assign_manager_modifiedtime as manager_modifiedtime');
                $this->db->from('maxwell_employees_info');
                $this->db->join($tablename,"mxap_assign_employee_code = mxemp_emp_id","INNER");
                $this->db->where_not_in('mxemp_emp_id', $employeeid);
                $this->db->group_by('mxap_assign_employee_code');
                $query_e = $this->db->get();
                $qry = $query_e->result();   
                if(count($qry) > 0){
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['hod_apprasial_list']=$qry;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "No Data Exist";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                }
            }else{
                $message="Failed";
                $statuscode="500";
                $desc = "No Data Exist";
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']=$desc;
            }
            return $data1;
    }
    
    public function api_applyforloan($employeeid,$companyid,$divisionid,$stateid,$branchid,$loantype,$tenuremonths,$appliedamount,$desc,$category){
        $attachementurl = '';
        $inarray = array(
          "mx_loan_empcode" => $employeeid,
          "mx_loan_comp_id" => $companyid,
          "mx_loan_div_id" => $divisionid,
          "mx_loan_state_id" => $stateid,
          "mx_loan_branch_id" => $branchid,
          "mx_loan_emp_loan_type" => $loantype,
          "mx_loan_tenure_months" => $tenuremonths,
          "mx_loan_amount_appliedby_employee" => $appliedamount,
          "mx_loan_reasonfor_loan" => $desc,
          "mx_loan_attachement_employee" => $attachementurl,
          "mx_loan_category" => $category,
          "mx_loan_applied_date" => DBDT,
          "mx_loan_createdby" => $employeeid,
          "mx_loan_createdtime" => DBDT,
          "mx_loan_created_ip" => '',
        );
        $this->db->insert('maxwell_emp_loan_applied', $inarray);
        $res = ($this->db->affected_rows() != 1) ? false : true;
        if($res == 1){
            $qry[]=array('statusmsg'=>'Sucessfully applied ');
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['applyloan']=$qry;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "Please check onceagain";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }
    
    public function getloandetailsmobilepp($cmp_id,$div_id,$state_id,$branch_id,$emp_code,$category,$uniqueid,$status,$applieddt)
    {
        $btn='';
        //                   mx_loan_amount_appliedby_employee,mx_loan_reasonfor_loan,
        //                   mx_loan_attachement_employee,mx_loan_approvedby,mx_loan_amt_approved,mx_loan_approved_date,mx_loan_status,mx_loan_createdby,mx_loan_createdtime,
        //                   mxemploan_emp_start_from,
        //                   mxcp_name,mxb_name,mxd_name,mxst_state,mx_loan_pri_id,
        
        // mxemploan_emp_loan_outstanding_amt, mxemploan_emp_loan_amt_approved,  mxemploan_emp_loan_monthly_emi_amt,  mxemploan_pri_id
        
        $this->db->select("mx_loan_pri_id as uniqid ,mx_loan_id as loanid,CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,
                           mx_loan_empcode as employeeid,
                           mx_loan_comp_id as companyid ,mx_loan_div_id as divisionid,mx_loan_state_id as stateid,mx_loan_branch_id as branchid ,
                           mx_loan_emp_loan_type as loan type,mx_loan_tenure_months as tenure month,mx_loan_amount_appliedby_employee as applied amount,
                           mx_loan_applied_date as applied by,mx_loan_applied_date as applied date ,mx_loan_category as category,mx_loan_status as statusloan,
                           mxemploan_emp_loan_outstanding_amt as outstandingamount,mxemploan_emp_loan_amt_approved as loanamtapproved");
        $this->db->from('maxwell_emp_loan_applied');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_loan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_loan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_loan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_loan_state_id', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_loan_empcode', 'INNER');
        $this->db->join('maxwell_emp_loan_master', 'mxemploan_load_id = mx_loan_id', 'LEFT');
        //$this->db->where('mx_loan_status',1);
        if($cmp_id != ''){
            $this->db->where("mx_loan_comp_id",$cmp_id);
        }
        if(!empty($div_id)){
            $this->db->where("mx_loan_div_id",$div_id);
        }
        if(!empty($state_id)){
            $this->db->where("mx_loan_state_id",$state_id);
        }
        if(!empty($branch_id)){
            $this->db->where("mx_loan_branch_id",$branch_id);
        }
        if(!empty($emp_code)){
            $this->db->where("mx_loan_empcode",$emp_code);
        }
        if(!empty($uniqueid)){
            $this->db->where("mx_loan_pri_id",$uniqueid);
        }
        if(!empty($status)){
            $this->db->where("mx_loan_status", $status);
        }
        if(!empty($applieddt)){
            $applied = date('Y-m-d', strtotime($applieddt));
            $this->db->where("date(mx_loan_applied_date)", $applied);
        }
        $this->db->order_by('mx_loan_createdtime', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $result = $query->result_array();
        
        foreach($result as $key=>$val)
        {
            if( $val['statusloan'] == 3 ){
                $btn ='History';
            }else{
                $btn = 'Edit';
            }
            
            if($val['statusloan']== 1){
               $result[$key]['loanstatus'] = 'PENDING';
            }else if($val['statusloan'] == 2){
               $result[$key]['loanstatus'] = 'REJECTED';
            }else{
               $result[$key]['loanstatus'] = 'APPROVED';
            }
            $result[$key]['Approvebutton'] =$btn;
            unset($result[$key]['statusloan']);
        }
        return $result;
    }

    public function getloantransactioninformation($companyid,$divisionid,$stateid,$branchid,$empid,$id,$loanid){
        // print_r($loanid); exit;
        // $id = $data['id'];
        // $empid = $data['empid'];
        // $loanid = $data['loanid'];
        // $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxemp_emp_gender,mxemp_emp_phone_no,mxemp_emp_alt_phn_no,mxemp_emp_age,mxemp_emp_current_salary,mxemp_emp_date_of_join');
        // $this->db->from('maxwell_employees_info');
        // $this->db->where('mxemp_emp_id', $empid);
        // $query = $this->db->get();
        // $result['employeeinfo'] = $query->result();

        $this->db->select('mxemploan_load_id,mxemploan_emp_loan_type,mxemploan_emp_loan_approvedby,mxemploan_emp_reasonfor_loan,mxemploan_emp_loan_amt_appliedby_employee,mxemploan_emp_loan_amt_approved,mxemploan_emp_loan_tenure_months,mxemploan_emp_loan_monthly_emi_amt,mxemploan_emp_attachements,mxemploan_emi_startdate,mxemploan_emi_enddate,mxemploan_applied_date,mxemploan_approved_date,mxcp_name,mxb_name,mxd_name,mxst_state,mxemploan_createdtime');
        $this->db->from('maxwell_emp_loan_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemploan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemploan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemploan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemploan_state_id', 'INNER');
        $this->db->where('mxemploan_load_id', $loanid);
        $query1 = $this->db->get();
        $loanmst = $query1->result_array();
        
        // $result['loandetails'] = $query1->result();
        // print_r($loanmst[0]->mxemploan_createdtime); exit;
        // echo $this->db->last_query();  exit;

        $this->db->select('mxemploan_load_id as loanid,mxemploan_modifiedtime as modifiedtime,mxemploan_emp_loan_current_paid_amt as currentpaidamount,mxemploan_emp_loan_debited_amt as debitamount,
                           mxemploan_emp_loan_advance_pay_amt as advancepayamount,mxemploan_emp_loan_forecloser_pay_amt as forecloseamt,mxemploan_emp_loan_outstanding_amt as outstandingamt,
                           mxemploan_emp_information as empinfo,mxemploan_emp_loan_amt_approved as approvedamt');
        $this->db->from('maxwell_emp_loan_master_transaction');
        $this->db->where('mxemploan_load_id', $loanid);
        $query2 = $this->db->get();
        // $result['loanhistorytransactions'] = $query2->result();
        $result = $query2->result_array();
        $numItems = count($result);

        foreach($result as $key=>$loanval){
            if($key == 0){
                $dateval = date('d-M-Y H:i:s A', strtotime($loanmst[0]['mxemploan_createdtime']));
                $result[$key]['paymentdate']=$dateval;
            }else{
                $dateval = date('d-M-Y H:i:s A', strtotime($loanval['modifiedtime']));
                $result[$key]['paymentdate']= $dateval;
            }
        	$current += $loanval['currentpaidamount'];
			$debit += $loanval['debitamount'];
			$advance += $loanval['advancepayamount'];
			$foreclosure += $loanval['forecloseamt'];
		    if(++$i === $numItems) {
			    $outstanding = $loanval['outstandingamt'];
		    }
		    
		    if( ($outstanding < $loanval['approvedamt']) && $outstanding == '0.00'){
				$info =  'SETTLED';
			}else{
				$info = 'PROCESS';
			}
            unset($result[$key]['modifiedtime']);
            unset($result[$key]['approvedamt']);
            $a =$key;
        }
        $result[$key+1]['loanid'] ='';
        $result[$key+1]['currentpaidamount']=$current;
        $result[$key+1]['debitamount'] = $debit;
        $result[$key+1]['advancepayamount'] = $advance;
        $result[$key+1]['forecloseamt'] = $foreclosure;
        $result[$key+1]['outstandingamt'] = $outstanding;
        $result[$key+1]['empinfo'] = $info;
        $result[$key+1]['paymentdate']= '';
        return $result;
    }
    
    public function editloantransaction($companyid,$divisionid,$stateid,$branchid,$employeeid,$loantype,$tenuremonths,$appliedamount,$category,$desc,$uniqid){
        /*  mx_loan_pri_id as uniqid ,mx_loan_id as loanid,CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,
                           mx_loan_empcode as employeeid,
                           mx_loan_comp_id as companyid ,mx_loan_div_id as divisionid,mx_loan_state_id as stateid,mx_loan_branch_id as branchid ,
                           mx_loan_emp_loan_type as loan type,mx_loan_tenure_months as tenure month,mx_loan_amount_appliedby_employee as applied amount,
                           mx_loan_applied_date as applied by,mx_loan_applied_date as applied date ,mx_loan_category as category,mx_loan_status as statusloan,
                           mxemploan_emp_loan_outstanding_amt as outstandingamount,mxemploan_emp_loan_amt_approved as loanamtapproved */
        $this->db->select("mx_loan_status as statusloan");
        $this->db->from('maxwell_emp_loan_applied');
        $this->db->where('mx_loan_pri_id', $uniqid);
        $query2 = $this->db->get();
        $result = $query2->result_array();
        // print_r($result); exit;
        
        if($result[0]['statusloan'] != 3){
            $uparray = array(
            "mx_loan_emp_loan_type" => $loantype,
            "mx_loan_tenure_months" => $tenuremonths,
            "mx_loan_amount_appliedby_employee" => $appliedamount,
            "mx_loan_reasonfor_loan" => $desc,
            "mx_loan_attachement_employee" => $attachementurl,
            "mx_loan_category" => $category,
            // "mx_loan_applied_date" => DBDT,
            "mx_loan_modifyby" => $employeeid,
            "mx_loan_modifiedtime" => DBDT,
            "mx_loan_modified_ip" => ''
            
        );
            $this->db->where('mx_loan_pri_id', $uniqid);
            $res = $this->db->update('maxwell_emp_loan_applied',$uparray);
            if($res==1){
                    $qry=array('statusmsg'=> 'Sucessfully Updated');
                    $data['status']=200;
                    $data['msg']='Success';
                    $data['description']='';
                    $data['editloan']=$qry;
                return $data;
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='Something went wrong';
                return $data;
            }

        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "Already Approved";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }
    
}
    
    
    
    
