<?php
error_reporting(0);
defined('BASEPATH') OR EXIT('No Direct Script Acesses Allowed');

class Commonreportsmodel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

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

    function cleanInput($val)
    {
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }

    public function departmentmaster(){
        $this->db->select('mxdpt_id,mxdpt_name');
        $this->db->from('maxwell_department_master');
        $this->db->where('mxdpt_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $dep[$value->mxdpt_id] =  $value->mxdpt_name;
            }
        }else{
         $dep = array();   
        }
        return $dep;
    }

    public function designationmaster(){
        $this->db->select('mxdesg_id,mxdesg_name');
        $this->db->from('maxwell_designation_master');
        $this->db->where('mxdesg_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $desig[$value->mxdesg_id] =  $value->mxdesg_name;
            }
        }else{
         $desig = array();   
        }
        return $desig;
    }

    public function companymaster(){
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $cmp[$value->mxcp_id] =  $value->mxcp_name;
            }
        }else{
         $cmp = array();   
        }
        return $cmp;
    }

    public function divisionmaster(){
        $this->db->select('mxd_id,mxd_name');
        $this->db->from('maxwell_division_master');
        $this->db->where('mxd_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $div[$value->mxd_id] =  $value->mxd_name;
            }
        }else{
         $div = array();   
        }
        return $div;
    }

    public function statesmaster(){
        $this->db->select('mxst_id,mxst_state');
        $this->db->from('maxwell_state_master');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $stt[$value->mxst_id] =  $value->mxst_state;
            }
        }else{
         $stt = array();   
        }
        return $stt;
    }

    public function grademaster(){
        $this->db->select('mxgrd_id,mxgrd_name');
        $this->db->from('maxwell_grade_master');
        $this->db->where('mxgrd_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $grd[$value->mxgrd_id] =  $value->mxgrd_name;
            }
        }else{
         $grd = array();   
        }
        return $grd;
    }

    public function employeetypemaster()
    {
        $this->db->select('mxemp_ty_id,mxemp_ty_name');
        $this->db->from('maxwell_employee_type_master');
        $this->db->where('mxemp_ty_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $empty[$value->mxemp_ty_id] =  $value->mxemp_ty_name;
            }
        }else{
         $empty = array();   
        }
        return $empty;
    }

    public function branchmaster(){
        $this->db->select('mxb_id,mxb_name');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        // echo $this->db->get_compiled_select(); exit;
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $brm[$value->mxb_id] =  $value->mxb_name;
            }
        }else{
         $brm = array();   
        }
        return $brm;
    }

    public function getemployeenamesfrommaster(){
        $this->db->select("mxemp_emp_id,concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename");
        $this->db->from('maxwell_employees_info');
        // echo $this->db->get_compiled_select(); exit;
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $empname[$value->mxemp_emp_id] =  $value->employeename;
            }
        }else{
         $empname = array();   
        }
        return $empname;   
    }

    public function getcolumns($data){
        $table = $data['tablename'];
        $table = $this->db->escape_str($table);
        $sql = "DESCRIBE $table";
        return $desc = $this->db->query($sql)->result();
    }

    public function viewuserselecteddata($data){
        $table = $data['tablename'];
        $columns = $data['columnnames'];
        if(count($columns) == 1){
            $columnnames = $columns[0];
        }else if(count($columns) > 0){
            if(($key = array_search("*", $columns)) !== false) {
                unset($columns[$key]);
                $columnnames = implode(",",$columns);
            }else{
                $columnnames = implode(",",$columns);
            }
        }
        $this->db->select("$columnnames");
        $this->db->from($table);
        $query = $this->db->get();
        $qry = $query->result_array();
        // print_r($qry);
        return $qry;
    }
    // public function filterappraisalquestion($data){
    //     $department = $data['department'];
    //     $category = $data['quecategory'];
    //     $this->db->select('mxap_id,mxap_question');
    //     $this->db->from('maxwell_apprasial_questions');
    //     $this->db->where('mxap_status = 1');
    //     $this->db->where('mxap_dep', $department);
    //     $this->db->where('mxap_catg', $category);
    //     $query = $this->db->get();
    //     $qry = $query->result_array();
    //     return $qry;
    // }

}
?>