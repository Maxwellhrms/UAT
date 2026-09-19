<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Activities_model extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getcircularmaster($companyid,$divisionid,$stateid,$branchid,$employeeid,$departmentid,$filter){
        $ym = date('Y-m');
        $this->db->select('mx_cr_application as applicationno,mx_cr_no as circular_no,mx_cr_title as circular_title,mx_cr_tags_desc as circular_description,CONCAT("https://maxwellhrms.in/",mx_cr_file) as circular_file');
        $this->db->from('maxwell_circular_master');
        $this->db->where('mx_cr_status = 1');
        if($departmentid == 9999){
          $this->db->where_in('mx_cr_department','9999'); 
        }else if(!empty($departmentid)){
            $this->db->where_in('mx_cr_department',$departmentid);
        }
        if(!empty($filter)){
        $this->db->where("DATE_FORMAT(mx_cr_createdtime,'%Y-%m')", $filter);
        }else{
        $this->db->where("DATE_FORMAT(mx_cr_createdtime,'%Y-%m')", $ym);  
        }
        $this->db->order_by('mx_cr_id desc');
        $query6 = $this->db->get();
         //echo $this->db->last_query();exit;
        $qry1 = $query6->result();
         if(count($qry1)>0){
            $data1=$qry1;
            return $data1;
        }else{
            return $data1 = array();
        }
    }

    public function getnotificationmaster($companyid,$divisionid,$stateid,$branchid,$employeeid,$departmentid,$filter){
        $ym = date('Y-m');
        $this->db->select('mx_ntf_title as notification_title,mx_ntf_tags_desc as notification_description,mx_ntf_file as notification_file, mx_ntf_createdtime as notificationcreateddate');
        $this->db->from('maxwell_notification_master');
        $this->db->where('mx_ntf_status = 1');
        // $ntf = array('9999',$departmentid);
        // $this->db->where_in('mx_ntf_department',$ntf);
        if($departmentid == 9999){
           $this->db->where_in('mx_ntf_department','9999'); 
        }else if(!empty($departmentid)){
            $this->db->where_in('mx_ntf_department',$departmentid);
        }
        if(!empty($filter)){
        $this->db->where("DATE_FORMAT(mx_ntf_createdtime,'%Y-%m')", $filter);
        }else{
        $this->db->where("DATE_FORMAT(mx_ntf_createdtime,'%Y-%m')", $ym);  
        }
        $this->db->order_by('mx_ntf_createdtime desc');
        $query6 = $this->db->get();
        $qry1 = $query6->result();
        if(count($qry1)>0){
            // $message="Success";
            // $statuscode="200";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']='';
            $data1 = $qry1;
            return $data1;
        }else{
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
            return $data1 = array();
        }
        
    }
    
        public function insertemprequesttype($companyid,$divisionid,$stateid,$branchid,$employeeid,$requesttype,$description,$parcel_type,$parcel_companyid,$parcel_divisionid,$parcel_stateid,$parcel_branchid,$parcel_company_name_info,$parcel_contact_person_info,$parcel_mobile_info,$parcel_emailid_info,$parcel_address_info,$parcel_pincode_info,$parcel_material_type,$parcel_current_transpoter_info){
            $uparray = array(
            "mxemp_req_comp_code" => $companyid,
            "mxemp_req_division_id" => $divisionid,
            "mxemp_req_state_code" => $stateid,
            "mxemp_req_branch_code" => $branchid,
            "mxemp_req_emp_code" => $employeeid,
            "mxemp_req_req_name" => $requesttype,
            "mxemp_req_desc" => $description,
            "mxemp_req_createdby" =>$employeeid,
            "mxemp_req_createdtime" => DBDT,
            "mxemp_req_created_ip" => IP,
            "parcel_type" => $parcel_type,
            "parcel_companyid" => $parcel_companyid,
            "parcel_divisionid" => $parcel_divisionid,
            "parcel_stateid" => $parcel_stateid,
            "parcel_branchid" => $parcel_branchid,
            "parcel_company_name_info" => $parcel_company_name_info,
            "parcel_contact_person_info" => $parcel_contact_person_info,
            "parcel_mobile_info" => $parcel_mobile_info,
            "parcel_emailid_info" => $parcel_emailid_info,
            "parcel_address_info"=> $parcel_address_info,
            "parcel_pincode_info" => $parcel_pincode_info,
            "parcel_material_type" => $parcel_material_type,
            "parcel_current_transpoter_info" => $parcel_current_transpoter_info,
        );
        $res = $this->db->insert('maxwell_employee_request_type', $uparray);
         if($res == 1){
            $qry=array('statusmsg'=>'Successfully Inserted');
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['empreq']= $qry;
            return $data1;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "Un-Successfully";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
    }

    public function emprequestlist($companyid,$divisionid,$stateid,$branchid,$employeeid){
        $this->db->select('mxemp_req_emp_code as employeeid,mxemp_req_req_name as requesttype,mxemp_req_desc as description,mxemp_req_id as uniqueid,
                       ms.mxst_state as statename,mc.mxcp_name as companyname,md.mxd_name as divisionname,mb.mxb_name as branchname,mxemp_emp_fname as firstname,mxemp_emp_lname as lastname,mxemp_req_status_process as company_process,mxemp_req_status_cmt as company_comments,mxemp_req_createdtime as createddate,parcel_type,parcel_companyid,parcel_divisionid,parcel_stateid,parcel_branchid,parcel_company_name_info,parcel_contact_person_info,parcel_mobile_info,parcel_emailid_info,parcel_address_info,parcel_pincode_info,parcel_material_type,parcel_current_transpoter_info,cp.mxcp_name as parcel_companyname,dp.mxd_name as parcel_divisionname, sp.mxst_state as parcel_statename,bp.mxb_name as parcel_branchname
');
        $this->db->from('maxwell_employee_request_type');
        $this->db->join('maxwell_company_master as mc' , 'mc.mxcp_id = mxemp_req_comp_code', 'INNER');
        $this->db->join('maxwell_division_master as md' , 'md.mxd_id = mxemp_req_division_id' , 'INNER');
        $this->db->join('maxwell_state_master as ms' ,'ms.mxst_id=mxemp_req_state_code','INNER');
        $this->db->join('maxwell_branch_master as mb','mb.mxb_id=mxemp_req_branch_code','INNER');
        $this->db->join('maxwell_company_master as cp' , 'cp.mxcp_id = parcel_companyid', 'LEFT');
        $this->db->join('maxwell_division_master as dp' , 'dp.mxd_id = parcel_divisionid' , 'LEFT');
        $this->db->join('maxwell_state_master as sp' ,'sp.mxst_id=parcel_stateid','LEFT');
        $this->db->join('maxwell_branch_master as bp','bp.mxb_id=parcel_branchid','LEFT');
        $this->db->join('maxwell_employees_info','mxemp_emp_id=mxemp_req_emp_code','LEFT');
        $this->db->where('mxemp_req_status',1); 
        $this->db->where('mxemp_req_comp_code',$companyid); 
        $this->db->where('mxemp_req_division_id',$divisionid); 
        $this->db->where('mxemp_req_branch_code',$branchid); 
        $this->db->where('mxemp_req_state_code',$stateid); 
        $this->db->where('mxemp_req_emp_code',$employeeid);
        $this->db->where('mxemp_req_req_name !=', 'GRIEVANCE_ISSUE');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $count= count($query->row());
        $qry = $query->result();
        if($count>0){
            // $message="Success";
            // $statuscode="200";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']='';
            $data1=$qry;
            return $qry;
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
    
    public function distinctofdepartmentntf(){
        $id = 1;
        $this->db->distinct();
        $this->db->select('mx_ntf_department');
        $this->db->from('maxwell_notification_master');
        $this->db->where('mx_ntf_status = 1'); 
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        $unique = array();
        if($count>0){
            foreach($qry as $key => $val){
                array_push($unique,$val->mx_ntf_department);
            }
            $q1=array((object) array('departmentid'=>'0','departmentname'=>'All','departmenthr'=>'0','departmentdirector'=>'0'), array('departmentid'=>'9999','departmentname'=>'Consolidated Notifications','departmenthr'=>'0','departmentdirector'=>'0'));
            $this->db->select('mxdpt_id as departmentid,mxdpt_name as departmentname,mxdpt_is_hr as departmenthr,mxdpt_is_director as departmentdirector');
            $this->db->from('maxwell_department_master');
            $this->db->where('mxdpt_status = 1');
            if ($id != null){
            $this->db->where('mxdpt_comp_id',$id);
            }
            $this->db->where_in('mxdpt_id',$unique);
            $query = $this->db->get();
            $count= count($query->row());
            $qry = $query->result();
            if($count>0){
                $a= array_merge($q1,$qry);
                return $a; 
            }else{
                return $qry;
            }
        }else{
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
            // return $data1;
        }
    }
    
    public function distinctofdepartment_circulars(){
        $id = 1;
        $this->db->distinct();
        $this->db->select('mx_cr_department');
        $this->db->from('maxwell_circular_master');
        $this->db->where('mx_cr_status = 1'); 
        $query = $this->db->get();
        $count= count($query->row());
        $qry = $query->result();
        $unique = array();
        if($count>0){
            foreach($qry as $key => $val){
                array_push($unique,$val->mx_cr_department);
            }
            $q1=array((object) array('departmentid'=>'0','departmentname'=>'ALL','departmenthr'=>'0','departmentdirector'=>'0'), array('departmentid'=>'9999','departmentname'=>'Consolidated Circulars','departmenthr'=>'0','departmentdirector'=>'0'));
            $this->db->select('mxdpt_id as departmentid,mxdpt_name as departmentname,mxdpt_is_hr as departmenthr,mxdpt_is_director as departmentdirector');
            $this->db->from('maxwell_department_master');
            $this->db->where('mxdpt_status = 1');
            if ($id != null){
            $this->db->where('mxdpt_comp_id',$id);
            }
            $this->db->where_in('mxdpt_id',$unique);
            $query = $this->db->get();
            $count= count($query->row());
            $qry = $query->result();
            if($count>0){
                $a= array_merge($q1,$qry);
                return $a; 
            }else{
                return $qry;
            }
        }else{
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
            // return $data1;
        }
    }
    
    public function documentslist($companyid,$divisionid,$stateid,$branchid,$employeeid,$documenttype,$year,$month){
        $docdata = array();
        if (strlen($month) === 1) {
            $month = "0" . $month;
        }
        
        clearstatcache();

        if($documenttype == "PAYSLIPS"){
            
            $folderPath = "../uploads/payslips";
            $yearFilter = isset($year) ? $year : null;
            $monthFilter = isset($month) ? $month : null;
            
            if ($employeeid) {
                $docdata = $this->getPayslips($folderPath, $employeeid, $yearFilter, $monthFilter);
            }
            
        }
        return $docdata;
    }
    

    
    function getMonthName($monthNumber) {
        $dateObj = DateTime::createFromFormat('!m', $monthNumber);
        return $dateObj ? $dateObj->format('F') : '';
    }
    
    function getPayslips($folderPath, $employeeCode, $yearFilter = null, $monthFilter = null) {
        $files = scandir($folderPath);
        $payslips = [];
        
        foreach ($files as $file) {
            // if (strpos($file, $employeeCode) !== false && preg_match('/(\d{2})-(\d{4})-' . preg_quote($employeeCode, '/') . '\.pdf/', $file, $matches)) {
                
            if (strpos($file, $employeeCode) !== false && preg_match('/(\d{2})-(\d{4})-' . preg_quote($employeeCode, '/') . '\.(pdf|jpg|jpeg|png|gif|mp4|avi|mov|mkv|xls|xlsx|csv)$/i', $file, $matches)){
                $monthNumber = $matches[1];
                $year = $matches[2];
                $monthName = $this->getMonthName($monthNumber);
                
                if (($yearFilter && $yearFilter != $year) || ($monthFilter && $monthFilter != $monthNumber)) {
                    continue;
                }
                
                $payslips[] = [
                    "type" => $monthName."-(".$year.")",
                    "filename" => $file,
                    "url" => "https://maxwellhrms.in/uploads/payslips/$file"
                ];
            }
        }
        
        return $payslips;
    }

}
