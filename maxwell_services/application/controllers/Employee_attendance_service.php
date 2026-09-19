<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Employee_attendance_service extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('Employee_attendance_model');
    }

	public function index(){
		echo IP;
	}

    public function api_employee_attendance_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $month = $this->cleanInput($obj->{'month'});
        $year = $this->cleanInput($obj->{'year'});
        if(empty($month) || empty($year)){
            $month = MONTHNUMBER;
            $year = YEARNUMBER;
        }

        $data = $this->Employee_attendance_model->api_employee_attendance_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year);
        echo $this->api_encodecheck($data);
        
    }
    //--------------NEW BY SHABABU(11-05-2022)
    public function api_employee_attendance_list_by_date(){
        $obj = $this->api_decode(); 
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        // $month = $this->cleanInput($obj->{'month'});
        // $year = $this->cleanInput($obj->{'year'});
        
        $date = $this->cleanInput($obj->{'date'});
        if(!empty($date)){
            $ex = explode('-',$date);
            $month = (strlen($ex[1]) == 1) ? '0'.$ex[1] : $ex[1];
            $year = $ex[2];
            $final_date = $year.'-'.$month.'-'.$ex[0];
        }else{
            $month = MONTHNUMBER;
            $year = YEARNUMBER;
            $final_date = date('Y-m-d');
        }
        
        
        if($final_date > date('Y-m-d')){
            $message="Your Selected Date Should Not be Greater than Current Date";
            $statuscode="500";
            $desc = "No Data Exist";
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']='';
            echo $this->api_encodecheck($data);
            exit;
            
        }
        $data = $this->Employee_attendance_model->api_employee_attendance_list_date($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$final_date);
        echo $this->api_encodecheck($data);
        
    }
    //--------------END NEW BY SHABABU(11-05-2022)

    public function api_employee_manual_attendance(){
        $obj = $this->api_decode();
        $checkkeys = array_keys((array)$obj);
        $validatekeys = array("attendance_uniqid","employeeid","attendancedate","companyid","divisionid","stateid","branchid","entrytype");
        $difference = array_diff($validatekeys,$checkkeys);
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $attendance_uniqid = $this->cleanInput($obj->{'attendance_uniqid'});
        $attendancedate = $this->cleanInput($obj->{'attendancedate'});
        $entrytype = $this->cleanInput($obj->{'entrytype'});
        $latitude = $this->cleanInput($obj->{'latitude'});
        $longitude = $this->cleanInput($obj->{'longitude'});
        $location = $this->cleanInput($obj->{'location'});
        $islocation = $this->cleanInput($obj->{'islocation'});
        $qrresult = $this->cleanInput($obj->{'qrresult'});
        $radius = $this->cleanInput($obj->{'radius'});
        #$radius = "36";
        $data = $this->Employee_attendance_model->api_employee_manual_attendance($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid,$entrytype,$difference,$latitude,$longitude,$location,$qrresult,$radius,$islocation);
        echo $this->api_encodecheck($data);
    }
    
    public function api_pomtop_attendance(){
        $obj = $this->api_decode();
        $checkkeys = array_keys((array)$obj);
        $validatekeys = array("employeeid","attendancedate","entrytype");
        $difference = array_diff($validatekeys,$checkkeys);
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $attendancedate = $this->cleanInput($obj->{'attendancedate'});
        $entrytype = $this->cleanInput($obj->{'entrytype'});
        $companyid = 1;
        $data = $this->Employee_attendance_model->api_pomtop_attendance($employeeid,$attendancedate,$entrytype,$difference,$companyid);
        echo $this->api_encodecheck($data);
    }
    
    public function api_employee_sync_attendance(){
        $obj = $this->api_decode();
        $checkkeys = array_keys((array)$obj);
        $validatekeys = array("attendance_uniqid","employeeid","attendancedate","companyid","divisionid","stateid","branchid","entrytype","timestamp");
        $difference = array_diff($validatekeys,$checkkeys);
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $attendance_uniqid = $this->cleanInput($obj->{'attendance_uniqid'});
        $attendancedate = $this->cleanInput($obj->{'attendancedate'});
        $entrytype = $this->cleanInput($obj->{'entrytype'});
        $latitude = $this->cleanInput($obj->{'latitude'});
        $longitude = $this->cleanInput($obj->{'longitude'});
        $location = $this->cleanInput($obj->{'location'});
        $qrresult = $this->cleanInput($obj->{'qrresult'});
        $timestamp = $this->cleanInput($obj->{'timestamp'});
        $radius = $this->cleanInput($obj->{'radius'});
        $islocation = $this->cleanInput($obj->{'islocation'});
        $data = $this->Employee_attendance_model->api_employee_sync_attendance($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid,$entrytype,$difference,$latitude,$longitude,$location,$qrresult,$timestamp,$radius,$islocation);
        echo $this->api_encodecheck($data);
    }
    
    public function api_employee_daywise_punches(){
        $obj = $this->api_decode();
        $checkkeys = array_keys((array)$obj);
        $validatekeys = array("attendance_uniqid","employeeid","attendancedate","companyid","divisionid","stateid","branchid");
        $difference = array_diff($validatekeys,$checkkeys);
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $attendance_uniqid = $this->cleanInput($obj->{'attendance_uniqid'});
        $attendancedate = $this->cleanInput($obj->{'attendancedate'});
        $data = $this->Employee_attendance_model->api_employee_daywise_punches($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data);
    }
/*
    public function api_attendance_regulation(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $reason = $this->cleanInput($obj->{'reason'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];
        if((date('m',strtotime($from))) != (date('m',strtotime($to) ) )){
            $data['attendance_regulation']=[];
            $desc='To different months cannot be applied'; 
            echo $this->api_encode($data,$desc);  
            exit;      
        }
        if ($from > $to) {
            $data['attendance_regulation']=[];
            $desc='Please check from date to date correct'; 
            echo $this->api_encode($data,$desc);    
            exit;    
        }
        //  1 ->First Half  2 ->Secondhalf  3 -> fullday
        if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
            $data['attendance_regulation']=[];
            $desc='We are unable to apply half day with two dates different dates';
            echo $this->api_encode($data,$desc);        
            exit;
        }
        $err_dates=array();
        $attendance_check_count=0;
        $attendance_regulation_checker_count=0;
            $attendance_regulation_checker = $this->Employee_attendance_model->attendance_regulation_checker($employeeid,$from,$to,$companyid,$divisionid,$stateid,$branchid);
            if(count($attendance_regulation_checker) > 0){
                $data['attendance_regulation']=[];
                $desc='Already applied onduty for those days'; 
                echo $this->api_encode($data,$desc);        
                exit;
            }else{
                $data['attendance_regulation'] = $this->Employee_attendance_model->attendance_regulation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc );
                if($data['attendance_regulation'] == 1){
                    $desc = "Sucessfully applied onduty ";
                }else{
                    $desc = "Please check onceagain";
                }
            }
        echo $this->api_encode($data,$desc);        
    }
    */
    
    public function api_attendance_regulation(){
        $obj = $this->api_decode();
        // echo "hi"; exit;
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $reason = $this->cleanInput($obj->{'reason'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $div_ot = $this->cleanInput($obj->{'divisonid_ot'});
        $state_ot = $this->cleanInput($obj->{'stateid_ot'});
        $branch_ot = $this->cleanInput($obj->{'branchid_ot'});
        
        $cl_company = $this->cleanInput($obj->{'cl_company'});
        $cl_contact_person = $this->cleanInput($obj->{'cl_contact_person'});
        $cl_contact_number = $this->cleanInput($obj->{'cl_contact_number'});
        $cl_contact_email = $this->cleanInput($obj->{'cl_contact_email'});
        $cl_description = $this->cleanInput($obj->{'cl_description'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];
        $from = date('Y-m-d',strtotime($from));
        $to = date('Y-m-d',strtotime($to));
        $datechk=date('Y-m-d');
        // print_r($from); exit;
        if ($datechk < $to) {
              echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'To date must not be greater than current date'));exit; 
        }
        if ($datechk < $from) {
              echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'From date must not be greater than current date'));exit; 
        }
        
        $type = $this->cleanInput($obj->{'type'});
        if( $type !=''){
                    $type = $this->cleanInput($obj->{'type'});
        }else{
             $type ='AR';
        }
        $doj_check = $this->Employee_attendance_model->validate_doj($from,$employeeid);//---->check apply date should be greater than or equal to doj

        if($doj_check == 0){
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Your Apply Date Should Be Greater Than the DOJ'));exit; 
        }else{
            $data = $this->Employee_attendance_model->attendance_regulation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$type,$div_ot,$state_ot,$branch_ot,$cl_company,$cl_contact_person,$cl_contact_number,$cl_contact_email,$cl_description);
            echo $this->api_encodecheck($data);        
        }
    }
    
    public function api_editattendance_regulation(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $attendance_date = $this->cleanInput($obj->{'attendance_date'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $reason = $this->cleanInput($obj->{'reason'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $customdropdown = $this->cleanInput($obj->{'customdropdown'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];
        $attend_regu_uniqid = $this->cleanInput($obj->{'uniqid'});
        $cl_company = $this->cleanInput($obj->{'cl_company'});
        $cl_contact_person = $this->cleanInput($obj->{'cl_contact_person'});
        $cl_contact_number = $this->cleanInput($obj->{'cl_contact_number'});
        $cl_contact_email = $this->cleanInput($obj->{'cl_contact_email'});
        $cl_description = $this->cleanInput($obj->{'cl_description'});
       
        $type = $this->cleanInput($obj->{'type'});
        if( $type !=''){
            $type = $this->cleanInput($obj->{'type'});
        }else{
            $type ='AR';
        }
        
        $div_ot = $this->cleanInput($obj->{'divisonid_ot'});
        $state_ot = $this->cleanInput($obj->{'stateid_ot'});
        $branch_ot = $this->cleanInput($obj->{'branchid_ot'});
        
        $first_half_punch = $this->cleanInput($obj->{'first_half_punch'});
        $second_half_punch = $this->cleanInput($obj->{'second_half_punch'});
        
        
        $datechk=date('Y-m-d');
        if ($datechk < $to) {
              echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'To date must not be greater than current date'));exit; 
        }
        if ($datechk < $from) {
              echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'From date must not be greater than current date'));exit; 
        }
        
        $data=$this->Employee_attendance_model->editattendance_regulation($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$type,$div_ot,$state_ot,$branch_ot,$cl_company,$cl_contact_person,$cl_contact_number,$cl_contact_email,$cl_description);  
        echo $this->api_encodecheck($data);
    }
    
    public function api_deleteattendance_regulation(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $attend_regu_uniqid = $this->cleanInput($obj->{'uniqid'});
        $data=$this->Employee_attendance_model->deleteattendance_regulation($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data);
    }
    
    public function api_regulation_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $filter = $this->cleanInput($obj->{'filter'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        if($monthyear == ''){ $monthyear =''; }
        $status_type = $this->cleanInput($obj->{'status_type'});
        if($status_type == ''){
            $status_type ='';
        }
        $type = $this->cleanInput($obj->{'type'});
        if(isset($obj->{'type'})){
            $type = $this->cleanInput(trim($obj->{'type'}));
        }else{
            $type = 'AR';
        }
        $filteremployeeid = $this->cleanInput(trim($obj->{'filteremployeeid'}));

        // if(isset($obj->{'searchempid'})){
        //     $searchempid = $this->cleanInput(trim($obj->{'searchempid'}));
        // }else{
        //     $searchempid = 0;
        // }
        
        $data=$this->Employee_attendance_model->allattendancelist($employeeid,$companyid,$divisionid,$stateid,$branchid,$filter,$monthyear,$filteremployeeid,$type,$status_type);

        echo $this->api_encodecheck($data);        
    }

    public function api_authemployeelist()
    {
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $data['authattendance_list']=$this->Employee_attendance_model->authemployeelist($employeeid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encode($data,$desc);
    }
    
    public function api_authattendance_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $approve = $this->cleanInput($obj->{'approve'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $data=$this->Employee_attendance_model->authattendance_accept($employeeid,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    }
    
    public function adminallattendancelist(){
        $obj = $this->api_decode();
        // print_r($obj); exit;
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $approvstatus = $this->cleanInput($obj->{'approvstatus'});
        $type = $this->cleanInput($obj->{'type'});
        $data=$this->Employee_attendance_model->adminallattendancelist($companyid,$divisionid,$stateid,$branchid,$monthyear,$approvstatus,$employeeid,$deviceid,$type);
        echo $this->api_encodecheck($data,$desc);
    }
    
    public function api_adminauthattendance_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $approve = $this->cleanInput($obj->{'approve'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeename = $this->cleanInput($obj->{'employeename'});
        $data=$this->Employee_attendance_model->admin_regulation_hraccept_approval($employeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    } 
    
    //  ---------------------- start 28-07-2022 onduty apis ----------------
    
    
        public function api_onduty_apply(){
        $obj = $this->api_decode();  
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $reason = $this->cleanInput($obj->{'reason'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $odcompanyid = $this->cleanInput($obj->{'odcompanyid'});
        $oddivisonid = $this->cleanInput($obj->{'oddivisonid'});
        $odstateid = $this->cleanInput($obj->{'odstateid'});
        $odbranchid = $this->cleanInput($obj->{'odbranchid'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];
        $doj_check = $this->Employee_attendance_model->validate_doj($from,$employeeid);//---->check apply date should be greater than or equal to doj
        // echo $doj_check;exit;
        if($doj_check == 0){
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Your Apply Date Should Be Greater Than the DOJ'));exit; 
        }else{
            $data = $this->Employee_attendance_model->onduty_apply($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$odcompanyid,$oddivisonid,$odstateid,$odbranchid);
            echo $this->api_encodecheck($data);        
        }
    }

    public function api_edit_onduty(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $attendance_date = $this->cleanInput($obj->{'attendance_date'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $reason = $this->cleanInput($obj->{'reason'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $customdropdown = $this->cleanInput($obj->{'customdropdown'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];
        $attend_regu_uniqid = $this->cleanInput($obj->{'uniqid'});
        $data=$this->Employee_attendance_model->edit_onduty($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc);  
        echo $this->api_encodecheck($data);        
    }   
    
    public function api_delete_onduty(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $attend_regu_uniqid = $this->cleanInput($obj->{'uniqid'});
        $data=$this->Employee_attendance_model->delete_onduty($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data);
    }

    public function api_onduty_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $filter = $this->cleanInput($obj->{'filter'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $data=$this->Employee_attendance_model->all_onduty_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$filter,$monthyear);
        echo $this->api_encodecheck($data);        
    }

    public function api_auth_onduty_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $approve = $this->cleanInput($obj->{'approve'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $data=$this->Employee_attendance_model->auth_onduty_accept($employeeid,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    }
    
    public function adminall_onduty_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $approvstatus = $this->cleanInput($obj->{'approvstatus'});
        $data=$this->Employee_attendance_model->adminall_onduty_list($companyid,$divisionid,$stateid,$branchid,$monthyear,$approvstatus,$employeeid,$deviceid);
        echo $this->api_encodecheck($data,$desc);
    }

    public function api_admin_onduty_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $approve = $this->cleanInput($obj->{'approve'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeename = $this->cleanInput($obj->{'employeename'});
        $data=$this->Employee_attendance_model->admin_onduty_hraccept_approval($employeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    }

    //  -------------------  END 28-07-2022 onduty apis ---------------------
    
    
    
    
    
    
}
