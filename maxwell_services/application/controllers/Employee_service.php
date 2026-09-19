<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Employee_service extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('Employee_model');
    }

	public function index(){
		echo IP;
	}

    public function api_employeeinfo(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $data = $this->Employee_model->getemployeecompletedetails($employeeid);
        echo $this->api_encodecheck($data);
        
    }
    
    public function api_updateemployeepassword(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $oldpswd = $this->cleanInput($obj->{'oldpswd'});
        $newpswd = $this->cleanInput($obj->{'newpswd'});
        $cnfpswd = $this->cleanInput($obj->{'cnfpswd'});
        // if ($oldpswd == "") {
        //     $desc="Old Password Should Not Be Empty";
        //     $data['update_password'] = []; 
        // }elseif($newpswd == ""){
        //     $desc="New Password Should Not Be Empty";
        //     $data['update_password'] = [];
        // }elseif ($cnfpswd == "") {
        //     $desc="Conform Password Should Not Be Empty";
        //     $data['update_password'] = [];
        // }elseif ($newpswd != $cnfpswd) {
        //     $desc="Missmatch New Password And Conform Password";
        //     $data['update_password'] = [];
        // }
        // else{
            $data = $this->Employee_model->api_updateemployeepassword($employeeid,$oldpswd,$cnfpswd,$newpswd);
            // if ($data['update_password'] == 'invalid_oldpassword') {
            //     $desc = 'Invalid Old Password';
            //     $data['update_password'] = [];
            // } else {
            //     $desc = '';
            // }
        // }
        echo $this->api_encodecheck($data);
    }

    public function api_apprasiallist(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $departmentid = $this->cleanInput($obj->{'departmentid'});
        $quecategory = $this->cleanInput($obj->{'quecategory'});
        $year  = $this->cleanInput($obj->{'year'});
        $month  = $this->cleanInput($obj->{'month'});
        $flag = 1;
        $data = $this->Employee_model->api_apprasiallist($employeeid,$departmentid,$quecategory,$year,$month,$flag);
        echo $this->api_encodecheck($data);
    }
    
    public function api_managerappraisaltoemp(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $year  = $this->cleanInput($obj->{'year'});
        $month  = $this->cleanInput($obj->{'month'});
        $flag = 1;
        $data = $this->Employee_model->api_apprasialmanagerlist($employeeid,$year,$month);
        echo $this->api_encodecheck($data);
    }

    public function api_hodappraisaltoemp(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $year  = $this->cleanInput($obj->{'year'});
        $month  = $this->cleanInput($obj->{'month'});
        $flag = 1;
        $data = $this->Employee_model->api_hodappraisaltoemplist($employeeid,$year,$month);
        echo $this->api_encodecheck($data);
    }
    
    public function api_applyforloan(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $loantype = $this->cleanInput($obj->{'loantype'});
        $tenuremonths = $this->cleanInput($obj->{'tenuremonths'});
        $appliedamount = $this->cleanInput($obj->{'appliedamount'});
        $category = $this->cleanInput($obj->{'category'});
        $desc = $this->cleanInput($obj->{'desc'});
        $data = $this->Employee_model->api_applyforloan($employeeid,$companyid,$divisionid,$stateid,$branchid,$loantype,$tenuremonths,$appliedamount,$desc,$category);
        echo $this->api_encodecheck($data);
    }
    
    public function getloandetailsmobilepp(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category = $this->cleanInput($obj->{'category'});
        $status = $this->cleanInput($obj->{'status'});
        $applieddt = $this->cleanInput($obj->{'applieddt'});
        $uniqueid = '';
                
        $data = $this->Employee_model->getloandetailsmobilepp($companyid,$divisionid,$stateid,$branchid,$employeeid,$category,$uniqueid,$status,$applieddt);
        echo $this->api_encodecheck($data);
    }
    
    public function getloantransactioninformation(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $id = $this->cleanInput($obj->{'id'});
        $loanid = $this->cleanInput($obj->{'loanid'});
        $data = $this->Employee_model->getloantransactioninformation($companyid,$divisionid,$stateid,$branchid,$employeeid,$id,$loanid);
        echo $this->api_encodecheck($data);
    }
    
    public function editloantransaction(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $loantype = $this->cleanInput($obj->{'loantype'});
        $tenuremonths = $this->cleanInput($obj->{'tenuremonths'});
        $appliedamount = $this->cleanInput($obj->{'appliedamount'});
        $category = $this->cleanInput($obj->{'category'});
        $desc = $this->cleanInput($obj->{'desc'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $data = $this->Employee_model->editloantransaction($companyid,$divisionid,$stateid,$branchid,$employeeid,$loantype,$tenuremonths,$appliedamount,$category,$desc,$uniqid);
        echo $this->api_encodecheck($data);
    }
    
    // ---------------------  added 14-06-2022 c -------------
    
    public function api_emp_apprasial(){
        $obj = $this->api_decode();
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $quecategory = $this->cleanInput($obj->{'quecategory'});
        $year = $this->cleanInput($obj->{'year'});
        $month = $this->cleanInput($obj->{'month'});
        $empnoacnt= $this->cleanInput($obj->{'employee_form_noofaccounts'});
        $empclientnam = $this->cleanInput($obj->{'employee_form_client_name'});
        $empformdesc = $this->cleanInput($obj->{'employee_form_description'});
        $emplachivement = $this->cleanInput($obj->{'employee_form_achivement'});
        $data = $this->Employee_model->emp_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory);
        echo $this->api_encodecheck($data);
    }

    public function api_manager_apprasial(){
        $obj = $this->api_decode();
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $quecategory = $this->cleanInput($obj->{'quecategory'});
        $year = $this->cleanInput($obj->{'year'});
        $month = $this->cleanInput($obj->{'month'});
        $empnoacnt= $this->cleanInput($obj->{'manager_form_noofaccounts'});
        $empclientnam = $this->cleanInput($obj->{'manager_form_client_name'});
        $empformdesc = $this->cleanInput($obj->{'manager_form_description'});
        $emplachivement = $this->cleanInput($obj->{'manager_form_achievement'});
        $data = $this->Employee_model->manager_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory);
        echo $this->api_encodecheck($data);
    }

    public function api_hod_apprasial(){
        $obj = $this->api_decode();
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $quecategory = $this->cleanInput($obj->{'quecategory'});
        $year = $this->cleanInput($obj->{'year'});
        $month = $this->cleanInput($obj->{'month'});
        $empnoacnt= $this->cleanInput($obj->{'hod_form_noofaccounts'});
        $empclientnam = $this->cleanInput($obj->{'hod_form_client_name'});
        $empformdesc = $this->cleanInput($obj->{'hod_form_description'});
        $emplachivement = $this->cleanInput($obj->{'hod_form_achievement'});
        $data = $this->Employee_model->hod_apprasial_save($uniqid,$employeeid,$year,$month,$empnoacnt,$empclientnam,$empformdesc,$emplachivement,$quecategory,$quecategory);
        echo $this->api_encodecheck($data);
    }

    // ---------------------- end 14-6-22 c ----------
    
 
}
