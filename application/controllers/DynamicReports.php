<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(0);
 require 'Common.php';
class DynamicReports extends Common {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('DynamicReportsModel');
        $this->load->model('Adminmodel');
        $this->load->model('Common_model');
        $titlehead = 'MAXWELL LOGISTICS PRIVATE LIMITED';
    }   
    
    public function employeelatereporting(){
        $this->header();
        $data['title']= "Employee Late Comings ";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Late Comings";
        $data['check']="";
        $data['controller'] = $this;
        $this->load->view('dynamicreports/EmployeesLateComing3plusdays',$data);
        $this->footer();    
    }

    public function employeelatereporting_list(){
        $userdata = $this->input->post();
        // print_r($userdata);exit;
        echo $this->DynamicReportsModel->employeelatereporting($userdata);
    }
}