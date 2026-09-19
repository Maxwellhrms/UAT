<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Mobile_Permissions extends Common {
	protected $imglink = 'uploads/';
    public function __construct() {
        parent::__construct();
        $this->load->model('Mobile_Permissionsmodel');
    }

    public function index(){
        echo 'Welcome';
    }
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function mobile_createmenupermission(){
        $this->header();
        $data['alluserroles'] = $this->Mobile_Permissionsmodel->mobile_getallroles();
        $this->load->view('mobile_permissions/mobile_createmenupermission', $data);
        $this->footer();   
    }

    public function mobile_saverolespermissions(){
        $userdata = $this->input->post();
        // print_r($userdata);exit();
        $res = $this->Mobile_Permissionsmodel->mobile_saverolespermissions($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_getallmenus(){
        $userdata = $this->input->post();
        $data['mainmenus'] = $this->Mobile_Permissionsmodel->mobile_getallmenus();
        $data['submenus'] = $this->Mobile_Permissionsmodel->mobile_getallsubmenus();
        $data['existdata'] = $this->Mobile_Permissionsmodel->mobile_getallmenusassigedtorole($userdata);
        $data['subexistdata'] = $this->Mobile_Permissionsmodel->mobile_getallsubmenusassigedtorole($userdata);
        $this->load->view('mobile_permissions/mobile_menupermissions', $data);
    }

    public function mobile_addnewroles(){
        $userdata = $this->input->post();
        $res = $this->Mobile_Permissionsmodel->mobile_addmenuroles($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_updatecreatecheck(){
        $userdata = $this->input->post();
        $res = $this->Mobile_Permissionsmodel->mobile_updatecreatecheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_updateeditcheck(){
        $userdata = $this->input->post();
        $res = $this->Mobile_Permissionsmodel->mobile_updateeditcheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_updatedeletecheck(){
        $userdata = $this->input->post();
        $res = $this->Mobile_Permissionsmodel->mobile_updatedeletecheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_addmenupermissionstoemployees(){
        $this->header();
        $this->load->view('mobile_permissions/mobile_addmenupermissionstoemployees');
        $this->footer();     
    }

    public function mobile_searchemployeelgdetails(){
        $userdata = $this->input->post();
        $data['employeedetails'] = $this->Mobile_Permissionsmodel->mobile_searchemployeelgdetails($userdata);
        $data['alluserroles'] = $this->Mobile_Permissionsmodel->mobile_getallroles();
        // echo '<pre>'; print_r($data);exit;
        $this->load->view('mobile_permissions/mobile_updateemployeelogininfo', $data);
    }

    public function mobile_updateemployeelgdetails(){
        $userdata = $this->input->post();
        $res = $this->Mobile_Permissionsmodel->mobile_updateemployeelgdetails($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function mobile_employeeloginlist(){
        $this->header();
        $data['info'] = $this->Mobile_Permissionsmodel->mobile_employeeloginlist();
        $data['alluserroles'] = $this->Mobile_Permissionsmodel->mobile_getallroles();
        $this->load->view('mobile_permissions/mobile_employeesloginlist', $data);
        $this->footer();   
    }
}?>