<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Commonreports extends Common {  

    public function __construct() {
        parent::__construct();
        $this->load->model('Commonreportsmodel');        
    }
	
    public function verifylogin(){
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }
    
    public function index(){
	$this->verifylogin();
    }

    public function commonreports(){
        $this->verifylogin();
        $this->header();
        $this->load->view('reports/commonreports');
        $this->footer();
    }

    public function getcolumns(){
        $this->verifylogin();
       $userdata = $this->input->post(); 
       $data = $this->Commonreportsmodel->getcolumns($userdata);
       if(count($data) > 0) {
        $def = '<option value="*">ALL</option>';
            foreach ($data as $key => $value) {
                $re = str_replace("mxemp_emp_", "", $value->Field);
                $fld = str_replace("_", " ", $re);
                $def .= "<option value=".$value->Field.">".$fld."</option>";
            }
        echo $def;
       }else{
        echo '';
       }
    }

    public function viewuserselecteddata(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['report'] = $this->Commonreportsmodel->viewuserselecteddata($userdata);
        $employeemaster = $this->Commonreportsmodel->getemployeenamesfrommaster();
        $tablename = $userdata['tablename'];
        $employeemaster['888666'] = 'ADMIN';
        $employeemaster[''] = '';
        $employeenameadding = array("mxemp_emp_id","mxemp_createdby","mxemp_modifyby","mxemp_trs_emp_code","mxemp_trs_createdby","mxemp_trs_modifyby","mxauth_emp_code","mxauth_reporting_head_emp_code","mxauth_createdby","mxauth_modifyby");
        $sno = 1; 
        foreach ($data['report'] as $key => $value) {
            foreach ($value as $keys => $values) {
                if(in_array($keys, $employeenameadding)){
                    if(array_key_exists($values, $employeemaster)){
                        $info = $keys."_"."info"."_".$sno;
                        $data['report'][$key][$info] = $employeemaster[$values];
                        $sno++;
                    }else{
                        $info = $keys."_"."info"."_".$sno;
                        $data['report'][$key][$info] = $employeemaster[$values];
                        $sno++; 
                    }
                }
            }
        }
        $data['department'] = $this->Commonreportsmodel->departmentmaster();
        $data['designation'] = $this->Commonreportsmodel->designationmaster();
        $data['company'] = $this->Commonreportsmodel->companymaster();
        $data['branch'] = $this->Commonreportsmodel->branchmaster();
        $data['division'] = $this->Commonreportsmodel->divisionmaster();
        $data['states'] = $this->Commonreportsmodel->statesmaster();
        $data['grades'] = $this->Commonreportsmodel->grademaster();
        $data['employeetypemaster'] = $this->Commonreportsmodel->employeetypemaster();
        $data['authtype'] = array('1'=>'Branch','2'=>'Head Office','3'=>'HR','4'=>'Director');
        $data['status'] = array('1'=>'Active','0'=>'InActive');
        $this->load->view('reports/viewcommonreports',$data);
    }

}
