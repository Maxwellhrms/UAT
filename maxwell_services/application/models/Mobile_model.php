<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Mobile_model extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('Authorization_Token');
    }

    public function api_getcompany_master(){
        $q1=array((object) array('companyid'=>'0','companyname'=>'Select Company'));
        $this->db->select('mxcp_id as companyid,mxcp_name as companyname');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        
        if($count>0){
            $a= array_merge($q1,$qry);
            return $a;
        }else{
            return $qry;
        }
    }
    
    public function api_divisionmaster($id=null){
        $q1=array((object) array('divisionid'=>'0','divisionname'=>'Select Division'));
        $this->db->select('mxd_id as divisionid,mxd_name as divisionname');
        $this->db->from('maxwell_division_master');
        $this->db->where('mxd_status = 1');
        if ($id != null) {
        $this->db->where('mxd_comp_id',$id);
        }
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
            $a= array_merge($q1,$qry);
            return $a;
        }else{
            return $qry;
        }
    }

    public function api_getstates_based_on_branch_master($cmp_id = null, $div_id = null, $type = null){
        //--------------SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('distinct(mxb_state_id)');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
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
        $q1=array((object) array('stateid'=>'0','statename'=>'Select State'));
        $this->db->select('mxst_id as stateid,mxst_state as statename')->from('maxwell_state_master');
        $this->db->where("mxst_id in($sub_query)");
        $this->db->order_by('mxst_id');
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
          $a= array_merge($q1,$qry);
          return $a;
        }else{
            return $qry;
        }    
    }

    public function api_branchmaster($id=null,$stid){
        $q1=array((object) array('branchid'=>'0','branchname'=>'Select Branch'));
        $this->db->select('mxb_id as branchid,mxb_name as branchname');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        if ($id != null){
            $this->db->where('mxb_div_id',$id);
        }
        $this->db->where('mxb_state_id',$stid);
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
           $a= array_merge($q1,$qry);
           return $a;
        }else{
            return $qry;
        }
    }
    
    public function api_departmentmaster($id=null){
        $q1=array((object) array('departmentid'=>'0','departmentname'=>'Select Department','departmenthr'=>'0','departmentdirector'=>'0'), array('departmentid'=>'9999','departmentname'=>'ALL','departmenthr'=>'0','departmentdirector'=>'0'));
        $this->db->select('mxdpt_id as departmentid,mxdpt_name as departmentname,mxdpt_is_hr as departmenthr,mxdpt_is_director as departmentdirector');
        $this->db->from('maxwell_department_master');
        $this->db->where('mxdpt_status = 1');
        if ($id != null){
        $this->db->where('mxdpt_comp_id',$id);
        }
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
            $a= array_merge($q1,$qry);
            return $a; 
        }else{
            return $qry;
        }
    }

    public function api_grademaster($id=null){
        $q1=array((object) array('gradeid'=>'0','gradename'=>'Select Grade'));
        $this->db->select('mxgrd_id as gradeid,mxgrd_name as gradename');
        $this->db->from('maxwell_grade_master');
        $this->db->where('mxgrd_status = 1');
        if ($id != null){
        $this->db->where('mxgrd_comp_id',$id);
        }
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
         if($count>0){
            $a= array_merge($q1,$qry);
            return $a;
        }else{
            return $qry;
        }
    } 
    
    public function api_designationmaster($id=null){
        $q1=array((object) array('designationid'=>'0','designationname'=>'Select Designation'));
        $this->db->select('mxdesg_id as designationid ,mxdesg_name as designationname');
        $this->db->from('maxwell_designation_master');
        $this->db->where('mxdesg_status = 1');
        if ($id != null){
        $this->db->where('mxdesg_grade_id',$id);
        }
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
            $a= array_merge($q1,$qry);
            return $a;
        }else{
            return $qry;
        }
    }
/*
    public function api_checkvaliduser1($employeeid, $userpassword){   
        $this->db->select('mxemp_emp_lg_employee_id as employeeid,mxemp_emp_lg_fullname as employeefullname,mxemp_emp_lg_app_role as roleid,mxemp_emp_lg_app_permissions as apppermission,mxemp_emp_lg_password,mxemp_emp_resignation_status as resignationstatus');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        $this->db->where('mxemp_emp_resignation_status !=', 'R');
        $this->db->where('mxemp_emp_lg_app_status = 1');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        $query = $this->db->get();
        $count= count($query->row());
        if ($count >0){
            $qry = $query->result();
            if ($qry[0]->apppermission != '1'){   
                $qry = "premission_denied";
            }else if($qry[0]->mxemp_emp_lg_password != $userpassword){
               $qry = "invalid_pass";
            }else{
                $qry = $query->result_array();
                // sending employee info as well
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
                    empmaritaldate as employee_marital_date,mxemp_emp_present_since as employee_present_since,mxemp_emp_fixed_present_since as employee_permanent_since,mxemp_ty_name as employee_typename,mxemp_emp_jwt_token as jwt_token');
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
                    
                //-----------NEW BY SHABABU(13-02-2022)
                # JWT TOKEN 
                // print_r($qry1);exit;
                
                if(!empty($qry1[0]->jwt_token)){
                    $qry1[0]->jwt_token = $qry1[0]->jwt_token; 
                }else{
                     $issuedAtTime = time(); //token creation time
                        $payload = array(
                            "iat" => $issuedAtTime,
                            "mxemp_emp_id" => $employeeid
                        );
                        $token = $this->authorization_token->generateToken($payload);
                        $qry1[0]->jwt_token = $token;
                        $update_array = array("mxemp_emp_jwt_token"=>$token,"mxemp_emp_jwt_token_date" => date('Y-m-d H:i:s'));                       
                        
                        $this->db->where("mxemp_emp_id",$employeeid);
                        $this->db->update("maxwell_employees_info",$update_array);
                }
                # END JWT TOKEN 
                //-----------END NEW BY SHABABU(13-02-2022)
                $qry[0]['employee_details'] = $qry1;
                // sending employee info as well
                unset($qry[0]['mxemp_emp_lg_password']);
            }
        }else{
            $qry = "invalid_emp";
        }
        $qry1[]=$qry;
        return $qry1;
    } 
    */


    public function api_checkvaliduser($employeeid, $userpassword, $deviceid, $fcmid){  
        $qry=[]; 
        $this->db->select('mxemp_emp_lg_employee_id as employeeid,mxemp_emp_lg_fullname as employeefullname,mxemp_emp_lg_app_role as roleid,mxemp_emp_lg_app_permissions as apppermission,mxemp_emp_lg_password,mxemp_emp_resignation_status as resignationstatus,mxemp_emp_lg_app_facialscan as is_facial_scan,mxemp_emp_lg_app_is_logout as is_logout,mxemp_emp_lg_device_id as deviceid,mxemp_emp_lg_fcm_id as fcmid');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        $this->db->where('mxemp_emp_resignation_status', 'W');
        $this->db->where('mxemp_emp_lg_app_status = 1');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        $query = $this->db->get();
        $count= count($query->row());
        if ($count >0){
            $qry12 = $query->result();
            $dbdeviceid = trim($qry12[0]->deviceid);
            $dbfcmid = trim($qry12[0]->fcmid);
            if ($qry12[0]->apppermission != '1'){   
                $desc1 = "Sorry you dont have permission.Please Contact Admin ";
            }else if($qry12[0]->mxemp_emp_lg_password != $userpassword){
               $desc1 = "invalid_pass";
            }else{
                // sending employee info as well
                    $this->db->select('mxemp_emp_autouniqueid as autouniqueid,mxemp_emp_date_of_join as dateofjoin,mxemp_emp_comp_code as companyid,mxemp_emp_division_code as divisionid,mxemp_emp_branch_code as branchid,mxemp_emp_sub_branch_code as subbranchid,
                                        mxemp_emp_dept_code as departmentid,mxemp_emp_grade_code as gradeid,mxgrd_name as gradename,mxemp_emp_desg_code as designationid,mxemp_emp_state_code as stateid,mxemp_emp_type employement_type_id,mxemp_emp_type_name as employement_type_name,mxemp_emp_id as employeeid,mxemp_emp_fname as employee_firstname,
                                        mxemp_emp_lname as employee_lastname,mxemp_emp_img as employee_image,mxemp_emp_gender as employee_gender,mxemp_emp_marital_status as employee_marital_status,mxemp_emp_bloodgroup as employee_bloodgroup,mxemp_emp_phone_no as employee_phone_no,mxemp_emp_alt_phn_no as employee_alternate_no,mxemp_emp_email_id as employee_emailid,
                                        mxemp_emp_date_of_birth as employee_date_of_birth,mxemp_emp_mother_tongue as employee_mothertongue,mxemp_emp_caste as employee_caste,mxemp_emp_age as employee_age,mxemp_emp_empguarantorsdetails as employee_guarantorsdetails,mxemp_emp_license as employee_license,mxemp_emp_present_address1 as employee_presentaddress_1,
                                        mxemp_emp_present_address2 as employee_presentaddress2,mxemp_emp_present_city as employee_preserntcity,mxemp_emp_present_state as employee_presentstate,mxemp_emp_present_country as employee_presentcountry,mxemp_emp_present_postalcode as employee_present_postalcode,mxemp_emp_fixed_address1 as employee_permanent_address1,
                                        mxemp_emp_fixed_address2 as employee_permanent_address2,mxemp_emp_fixed_city as employee_permanent_city,mxemp_emp_fixed_state as employee_permanent_state,mxemp_emp_fixed_country as employee_permanent_country,mxemp_emp_fixed_postalcode as employee_permanent_postalcode,mxemp_emp_current_salary as employee_current_salary,
                                        mxemp_emp_bank_name as employee_bankname,mxemp_emp_bank_branch_name as employee_bankbranchname,CONCAT("XXXX",RIGHT(mxemp_emp_bank_acc_no, 4)) as employee_bankaccountno,CONCAT("XXXX",RIGHT(mxemp_emp_bank_ifsci_no, 4)) as employee_bank_ifscino,mxemp_emp_panno as employee_panno,mxemp_emp_esi_number as employee_esino,mxemp_emp_esiimage as employee_esi_image,mxemp_emp_pf_number as employee_pfno,
                                        mxemp_emp_uan_number as employee_uan_no,mxemp_emp_status as employee_status,mxcp_name as companyname,mxdesg_name as designationname,mxdpt_name as departmentname,mxd_name as divisionname,mxb_name as branchname,mxgrd_name as gradename,mxemp_emp_having_vehicle as employee_having_vehicle,mxemp_emp_vehicle_type as employee_vehicle_type,
                                        mxemp_emp_resignation_status as employee_resignationstatus,mxemp_emp_resignation_reason as employee_resignation_reason,mxemp_emp_resignation_date as employee_resignation_date,mxemp_emp_resignation_relieving_date as employee_relieving_date,
                                        mxemp_emp_resignation_relieving_settlement_date as employee_resignation_relieving_settlement_date,mxemp_emp_resignation_relieving_settlement_amount as employee_resignation_relieving_settlement_amount,mxemp_emp_resignation_relieving_esi_settlement_date as employee_resignation_relieving_esi_settlement_date,
                                        mxemp_emp_resignation_relieving_pf_settlement_date as employee_resignation_relieving_pf_settlement_date,mxemp_emp_panimage as employee_panimage,mxemp_emp_aadhar as employee_aadhar,mxemp_emp_aadharimage as employee_aadharimage,mxst_state as statename,mxemp_ty_name as employee_typename,mxemp_emp_guarantors_letter as employee_guarantors_letter,
                                        empmaritaldate as employee_marital_date,mxemp_emp_present_since as employee_present_since,mxemp_emp_fixed_present_since as employee_permanent_since,mxemp_ty_name as employee_typename,mxcp_cnt_per_contact_no as company_contact_mobile,mxb_latitude as branch_latitude,mxb_longitude as branch_longitude,mxb_radius as branchradius,,mxemp_emp_lic_info1 as mediclaimfile1,mxemp_emp_lic_info2 as mediclaimfile2,mxemp_emp_lic_info3 as mediclaimfile3,mxemp_emp_lic_info4 as mediclaimfile4');
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

        $this->db->select('DISTINCT(mxauth_auth_type) as authtype');
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_emp_code', $employeeid);
        $query13 = $this->db->get();
     

                    if(count($qry12)>0){ 
                        if(empty($dbdeviceid)){
                            $update_array = array("mxemp_emp_lg_device_id"=>$deviceid,"mxemp_emp_lg_fcm_id" => $fcmid);                       
                            $this->db->where("mxemp_emp_lg_employee_id",$employeeid);
                            $this->db->update("maxwell_employees_login",$update_array);
                        }
                        if(!empty($dbdeviceid)){
                            if($dbdeviceid != $deviceid){
                            $message="Failed";
                            $statuscode="500";
                            $desc = "You Already Logged In Another device";
                            create_notes($employeeid,'8','Already logged In Another Device',$employeeid);
                            }else{
                            $message="Success";
                            $statuscode="200";
                            $desc='';
                            create_notes($employeeid,'7','Logged In To Mobile-App',$employeeid); 
                            }
                        }else{
                            $message="Success";
                            $statuscode="200";
                            $desc='';
                            create_notes($employeeid,'7','Logged In To Mobile-App',$employeeid);
                        }
                    }else{
                        $message="Failed";
                        $statuscode="500";
                        $desc=$desc1;
                        // create_notes($employeeid,'8',$desc1.' Failed to login Mobile-App',$employeeid);
                     }
                     $qry['status']=$statuscode;
                     $qry['msg']=$message;
                     $qry['description']=$desc;    
                    $qry['employee_login'] = $query->result_array();
                    $qry['employee_details'] = $query1->result_array();
                    $qry['employee_authorization'] = $query13->result_array();
                // sending employee info as well
                unset($qry['employee_login'][0]['mxemp_emp_lg_password']);
            }
        }else{
            $qry['status']="500";
            $qry['msg']="Failed";
            $qry['description']="Invalid Employee ID";
            create_notes($employeeid,'8','Invalid Employee ID',$employeeid);
        }
        return $qry;
    }

    public function api_employeeconfig($employeeid){
            $this->db->select('mxb_latitude as branch_latitude,mxb_longitude as branch_longitude,mxb_radius as branchradius');
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
            $message="Success";
            $statuscode="200";
            $desc='';
            $qry['status']=$statuscode;
            $qry['msg']=$message;
            $qry['description']=$desc;    
            $qry['employee_config'] = $query1->result_array();
            return $qry;
    }

public function api_facial_scan($employeeid){  
        $qry=[]; 
        $this->db->select('mxemp_emp_lg_employee_id as employeeid,mxemp_emp_lg_fullname as employeefullname,mxemp_emp_lg_app_role as roleid,mxemp_emp_lg_app_permissions as apppermission,mxemp_emp_lg_password,mxemp_emp_resignation_status as resignationstatus');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        $this->db->where('mxemp_emp_resignation_status', 'W');
        $this->db->where('mxemp_emp_lg_app_status = 1');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        $query = $this->db->get();
        $count= count($query->row());
        if ($count >0){
            $qry12 = $query->result();

                // sending employee info as well
                    $this->db->select('mxemp_emp_autouniqueid as autouniqueid,mxemp_emp_date_of_join as dateofjoin,mxemp_emp_comp_code as companyid,mxemp_emp_division_code as divisionid,mxemp_emp_branch_code as branchid,mxemp_emp_sub_branch_code as subbranchid,
                                        mxemp_emp_dept_code as departmentid,mxemp_emp_grade_code as gradeid,mxgrd_name as gradename,mxemp_emp_desg_code as designationid,mxemp_emp_state_code as stateid,mxemp_emp_type employement_type_id,mxemp_emp_type_name as employement_type_name,mxemp_emp_id as employeeid,mxemp_emp_fname as employee_firstname,
                                        mxemp_emp_lname as employee_lastname,mxemp_emp_img as employee_image,mxemp_emp_gender as employee_gender,mxemp_emp_marital_status as employee_marital_status,mxemp_emp_bloodgroup as employee_bloodgroup,mxemp_emp_phone_no as employee_phone_no,mxemp_emp_alt_phn_no as employee_alternate_no,mxemp_emp_email_id as employee_emailid,
                                        mxemp_emp_date_of_birth as employee_date_of_birth,mxemp_emp_mother_tongue as employee_mothertongue,mxemp_emp_caste as employee_caste,mxemp_emp_age as employee_age,mxemp_emp_empguarantorsdetails as employee_guarantorsdetails,mxemp_emp_license as employee_license,mxemp_emp_present_address1 as employee_presentaddress_1,
                                        mxemp_emp_present_address2 as employee_presentaddress2,mxemp_emp_present_city as employee_preserntcity,mxemp_emp_present_state as employee_presentstate,mxemp_emp_present_country as employee_presentcountry,mxemp_emp_present_postalcode as employee_present_postalcode,mxemp_emp_fixed_address1 as employee_permanent_address1,
                                        mxemp_emp_fixed_address2 as employee_permanent_address2,mxemp_emp_fixed_city as employee_permanent_city,mxemp_emp_fixed_state as employee_permanent_state,mxemp_emp_fixed_country as employee_permanent_country,mxemp_emp_fixed_postalcode as employee_permanent_postalcode,mxemp_emp_current_salary as employee_current_salary,
                                        mxemp_emp_bank_name as employee_bankname,mxemp_emp_bank_branch_name as employee_bankbranchname,mxemp_emp_bank_acc_no  as employee_bankaccountno,mxemp_emp_bank_ifsci_no as employee_bank_ifscino,mxemp_emp_panno as employee_panno,mxemp_emp_esi_number as employee_esino,mxemp_emp_pf_number as employee_pfno,
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

                    $currentdate = DBD;
                    $year = date('Y');
                    $month = date('m');
                    $this->db->select('mx_attendance_id as attendance_uniqid, mx_attendance_emp_code as employeeid, mx_attendance_date as attendancedate, CONCAT(mxemp_emp_fname," ", mxemp_emp_lname) as fullname, mx_attendance_first_half as firsthalf, mx_attendance_second_half as secondhalf, mx_attendance_cmp_id as companyid, mx_attendance_division_id as divisionid, mx_attendance_state_id as stateid, mx_attendance_branch_id as branchid,mx_attendance_first_half_punch as first_half_punch,mx_attendance_second_half_punch as second_half_punch');
                    $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
                    $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
                    $this->db->where('mx_attendance_emp_code', $employeeid);
                    $this->db->where('mx_attendance_date =', $currentdate);
                    $query2 = $this->db->get();
                    $qry2 = $query2->result(); 

                    if(count($qry12)>0){ 
                        $message="Success";
                        $statuscode="200";
                        $desc='';
                    }else{
                        $message="Failed";
                        $statuscode="500";
                        $desc=$desc1;
                     }
                     $qry['status']=$statuscode;
                     $qry['msg']=$message;
                     $qry['description']=$desc;    
                        $qry['employee_login'] = $query->result_array();
                        $qry['employee_details'] = $query1->result_array();
                        $qry['attendance_info'] = $query2->result_array();
                // sending employee info as well
                unset($qry['employee_login'][0]['mxemp_emp_lg_password']);
            }else{
            $qry['status']="500";
            $qry['msg']="Failed";
            $qry['description']="Invalid Employee ID";    
        }
        return $qry;
    }

    public function api_sidemenu($employeeid,$roleid){   
        $this->db->select('mxemp_emp_lg_employee_id as employeeid');
        $this->db->from('maxwell_employees_login');
        $this->db->where('mxemp_emp_lg_app_status = 1');
        $this->db->where('mxemp_emp_lg_app_permissions = 1');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        $this->db->where('mxemp_emp_lg_app_role', $roleid);
        $query = $this->db->get();
        $count= count($query->row());
        if ($count >0){
                $this->db->select("maxper_roleid as menuroleid,maxper_menuid as menuid,LOWER(maxper_menuname) as title, maxper_menuicon as icon ");
                $this->db->from('maxwell_menu_user_wise_table_mobile');
                $this->db->where('maxper_menustatus', 1);
                $this->db->where('maxper_roleid', $roleid);
                $this->db->order_by('maxper_order', 'ASC');
                $query1 = $this->db->get();
                $qry['menus'] = $query1->result();
        }else{
            $qry = "menu_premission_denied";
        }
        return $qry;
    }

    public function api_submenus($menuid,$roleid){
        $this->db->select("LOWER(maxsubwise_name) as title,maxsubwise_link as submenulink, maxsubwise_icon as icon, CONCAT('/',REPLACE(LOWER(maxsubwise_name) ,' ', '-')) as state ");
        $this->db->from('maxwell_submenu_user_wise_table_mobile');
        $this->db->where('maxsubwise_status', 1);
        $this->db->where('maxsubwise_menu_id',$menuid);
        $this->db->where('maxsubwise_role_id', $roleid);
        $query2 = $this->db->get();
        $qry = $query2->result();
        return $qry;
    }
    
    public function api_holiday($stateid, $branchid, $companyid,$options,$div_id){
        $statesarray = array("1001",$stateid);
        $branchsarray = array("0",$branchid);
        $this->db->select('mx_holiday_type as holidaytype,mx_holiday_company_id as companyid,mx_holiday_state_id as stateid,mx_holiday_branch_id as branchid,mx_holiday_date as holidaydate,mx_holiday_name as holidayname,mxst_state as statename,mxcp_name as companyname,mxb_name as branchname,mxd_name as divisionname');
        $this->db->from('maxwell_holiday_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_holiday_company_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_holiday_state_id', 'LEFT OUTER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_holiday_branch_id', 'LEFT OUTER');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_holiday_division_id', 'INNER');
        if ($stateid != null && $branchid){
        $this->db->where_in("mx_holiday_state_id",$statesarray);
        $this->db->where_in("mx_holiday_branch_id",$branchsarray);
        }
        // $this->db->where_in("mx_holiday_division_id",$div_id);
        $this->db->where("mxcp_id",$companyid);
        $this->db->where("YEAR(mx_holiday_date) = YEAR(CURRENT_DATE())");
        $this->db->where('mx_holiday_status','1');
        $this->db->order_by('mx_holiday_date','asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry1= $query->result();
        if(count($qry1)>0){
            foreach ($qry1 as $key => $value) {
                $qry1[$key]->holidaytype = trim($options[$value->holidaytype]);
            }
            $data1 = $qry1;
        }else{   
            $data1 = array();
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
        }
        return $data1;
    }
    
    public function api_custom_permissions($employeeid){  
        $qry=[]; 
        $this->db->select('mxemp_emp_lg_app_facialscan as is_facial_scan,mxemp_emp_lg_app_sync_punches as is_sync_punches, mxemp_emp_lg_app_is_resigned as is_resigned,mxemp_emp_lg_app_is_logout as is_logout,mxemp_emp_lg_device_id as deviceid,mxemp_emp_lg_fcm_id as fcmid');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        $query = $this->db->get();
        $count= count($query->row());
        if ($count >0){
            $qry12 = $query->result();
                    if(count($qry12)>0){ 
                        $message="Success";
                        $statuscode="200";
                        $desc='';
                        // create_notes($employeeid,'7','Logged In To Mobile-App',$employeeid);
                    }else{
                        $message="Failed";
                        $statuscode="500";
                        $desc='No Data Exist';
                        // create_notes($employeeid,'8',$desc1.' Failed to login Mobile-App',$employeeid);
                     }
                     $qry['status']=$statuscode;
                     $qry['msg']=$message;
                     $qry['description']=$desc;    
                    $qry['employee_permissions'] = $query->result_array();
                // sending employee info as well
                unset($qry['employee_login'][0]['mxemp_emp_lg_password']);
            
        }else{
            $qry['status']="500";
            $qry['msg']="Failed";
            $qry['description']="Invalid Employee ID";
            create_notes($employeeid,'8','Invalid Employee ID',$employeeid);
        }
        return $qry;
    }

}
