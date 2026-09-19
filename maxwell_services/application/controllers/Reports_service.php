<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Reports_service extends Common {

    public function __construct(){
        parent::__construct();
       $this->load->model('Reports_model');
    }

	public function index(){
		echo IP;
	}
  
    public function api_employee_attendance_history(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'day'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data = $this->Reports_model->api_employee_attendance_history($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day);
        echo $this->api_encodecheck($data);
       
    }

    public function api_employee_attendance_punch_report(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'day'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data = $this->Reports_model->api_employee_attendance_punch_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day);
        echo $this->api_encodecheck($data);
       
    }

    public function api_employee_attendance_absent_report(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'day'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data = $this->Reports_model->api_employee_attendance_absent_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day);
        echo $this->api_encodecheck($data);
    }


    public function api_employee_attendance_present_report(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'day'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data = $this->Reports_model->api_employee_attendance_present_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day);
        echo $this->api_encodecheck($data);
    }

    public function api_employee_attendance_latecomming_report(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'day'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }

        $data = $this->Reports_model->api_employee_attendance_latecomming_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$attendance_category,$day);
        echo $this->api_encodecheck($data);
       
    }

    public function api_employee_attendance_regulation_report(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $attendance_category = $this->cleanInput($obj->{'attnd_category'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data= $this->Reports_model->api_employee_attendance_regulation_report($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$attendance_category,$from,$to);
        echo $this->api_encodecheck($data);      
    }

    public function api_joiningandleaving(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $filter = $this->cleanInput($obj->{'filter'});
        // $monthyear = $this->cleanInput($obj->{'month_year'});
        //$gradeid = $this->cleanInput($obj->{'gradeid'});
        $departmentid = $this->cleanInput($obj->{'departmentid'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $joining_leaving = $this->cleanInput($obj->{'joining_leaving'});

        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $monthyear = $year.'-'.$month;
        $data = $this->Reports_model->getjoiningandleaving($employeeid,$companyid,$divisionid,$stateid,$branchid,$gradeid,$departmentid,$joining_leaving,$from,$to,$filter);
        echo $this->api_encodecheck($data);
    }
    
    public function api_employee_attendance_punch_details(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $day = $this->cleanInput($obj->{'attendancedate'});
        $my = explode('-',$monthyear);
        if(strlen($my[0]) == 1){
            $year = $my[1];
            $month = '0'.$my[0];
        }else{
            $year = $my[1];
            $month = $my[0];
        }
        $data= $this->Reports_model->api_employee_attendance_punch_details($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$day);
        echo $this->api_encodecheck($data);      
    }

}