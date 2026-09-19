<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Permissions extends Common {
	protected $imglink = 'uploads/';
    public function __construct() {
        parent::__construct();
        $this->load->model('Permissionsmodel');
    }

    public function index(){
        echo 'Welcome';
    }

    public function createmenupermission(){
        $this->header();
        $data['alluserroles'] = $this->Permissionsmodel->getallroles();
        $this->load->view('permissions/createmenupermission', $data);
        $this->footer();   
    }

    public function saverolespermissions(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->saverolespermissions($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function getallmenus(){
        $userdata = $this->input->post();
        $data['mainmenus'] = $this->Permissionsmodel->getallmenus();
        $data['submenus'] = $this->Permissionsmodel->getallsubmenus();
        $data['existdata'] = $this->Permissionsmodel->getallmenusassigedtorole($userdata);
        $data['subexistdata'] = $this->Permissionsmodel->getallsubmenusassigedtorole($userdata);
        $this->load->view('permissions/menupermissions', $data);
    }

    public function addnewroles(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->addmenuroles($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function updatecreatecheck(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->updatecreatecheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function updateeditcheck(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->updateeditcheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function updatedeletecheck(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->updatedeletecheck($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function addmenupermissionstoemployees(){
        $this->header();
        $this->load->view('permissions/addmenupermissionstoemployees');
        $this->footer();     
    }

    public function searchemployeelgdetails(){
        $userdata = $this->input->post();
        $data['employeedetails'] = $this->Permissionsmodel->searchemployeelgdetails($userdata);
        $data['alluserroles'] = $this->Permissionsmodel->getallroles();
        $data['branchlist'] = $this->Permissionsmodel->getallbrancheslist($data['employeedetails']);
        $this->load->view('permissions/updateemployeelogininfo', $data);
    }

    public function updateemployeelgdetails(){
        $userdata = $this->input->post();
        $res = $this->Permissionsmodel->updateemployeelgdetails($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }

    public function employeeloginlist(){
        $this->header();
        $data['info'] = $this->Permissionsmodel->employeeloginlist();
        $data['alluserroles'] = $this->Permissionsmodel->getallroles();
        $this->load->view('permissions/employeesloginlist', $data);
        $this->footer();   
    }
}?>