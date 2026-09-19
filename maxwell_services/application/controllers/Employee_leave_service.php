<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Employee_leave_service extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('Employee_leave_service_model');
        $this->load->model('Common_model');
    }

	public function index(){
		echo IP;
	}

    public function api_current_leaves()
    {
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $current_year= YEARNUMBER;
        $current_month= MONTHNUMBER;
        $ym=$current_year.'_'.$current_month;
        $data= $this->Employee_leave_service_model->api_current_leaves($employeeid);
        echo $this->api_encodecheck($data);
    }
    
    // -------------------- added 20-02-2022 ---------------
    
    public function api_user_leavesapply()
    {   
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $leave_cateory = $this->cleanInput($obj->{'leave_cateory_applied'});
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $intime = $this->cleanInput($obj->{'intime'});
        $outtime = $this->cleanInput($obj->{'outtime'});
        $leave_address= $this->cleanInput($obj->{'leave_address'});
        
        if($leave_cateory == 'SHRT'){
            $intime = date("H:i", strtotime($intime));
            $outtime = date("H:i", strtotime($outtime));  
            $itime1 = explode(':', $intime);
            $otime2 = explode(':', $outtime);
        
            $minutes1 = ($itime1[0] * 60 + $itime1[1]);
            $minutes2 = ($otime2[0] * 60 + $otime2[1]);
            $diff = $minutes2 - $minutes1 . ' Minutes';
            if($diff >120)
            {
                echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'More than 2 Hours not possible to SHRT Leave') ); exit;
            }
        }
        
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$from)) {
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Please select date to apply leaves') ); exit;
        } 
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$to)) {
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Please select date to apply leaves') ); exit;
        } 
        
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $daysrange = $this->date_rangewith_days($from,$to);

        //  -----------  added 22-07-2022 ---------------------
        if( (empty($from)) || (empty($to)) ){
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Please select date to apply leaves') ); exit;
        }
        
        if(($category_type == 1 || $category_type ==2) && ($daysrange['noofday'] > 1)){
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>' With half day two different days is not possible')); exit;
        }
        //  -----------  end added 22-07-2022 ---------------------
        
        if($category_type == 1){
            $noofdays=0.5;
        }elseif($category_type == 2){
            $noofdays=0.5;
        }elseif($category_type == 3){
            $noofdays=$daysrange['noofday'];
        }
        
        
        $data= $this->Employee_leave_service_model->api_user_leavesapply($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$device_status,$emp_desc,$leave_cateory,$noofdays,$intime,$outtime,$leave_address);
        echo $this->api_encodecheck($data);
    }

    public function api_user_authleaveaccept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $approve = $this->cleanInput($obj->{'approve'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        // $deviceid = $this->cleanInput($obj->{'deviceid'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $data= $this->Employee_leave_service_model->api_user_authleaveaccept($employeeid,$companyid,$divisionid,$stateid,$branchid,$approve,$remarks,$uniqid,$device_status);
        echo $this->api_encodecheck($data);
    }
    
    public function api_all_leavesapply_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $finalhraccept =$this->cleanInput($obj->{'finalhraccept'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $ym=explode('-',$monthyear);
        if(strlen($ym[1])==1){$monthyear = $ym[0].'-'.'0'.$ym[1]; }else{ $monthyear =$monthyear;  }
        $filter = $this->cleanInput($obj->{'filter'});
        $data= $this->Employee_leave_service_model->api_all_leavesapply_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$monthyear,$filter,$finalhraccept,$uniqid);
        echo $this->api_encodecheck($data);        
    }

    public function api_all_leaves_apply_list(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $finalhraccept =$this->cleanInput($obj->{'finalhraccept'});
        $monthyear = $this->cleanInput($obj->{'month_year'});
        if($monthyear == ''){ $monthyear = '';   }
        $status_type = $this->cleanInput($obj->{'status_type'});
        if($status_type == ''){  $status_type ='';  }
        if(isset($obj->{'searchempid'})){
            $searchempid = $this->cleanInput($obj->{'searchempid'});
        }else{
            $searchempid = 0;
        }
        //$uniqid = $this->cleanInput($obj->{'uniqid'});
        // $ym=explode('-',$monthyear);
        // if(strlen($ym[1])==1){$monthyear = $ym[0].'-'.'0'.$ym[1]; }else{ $monthyear =$monthyear;  }
        $filter = $this->cleanInput($obj->{'filter'});
        $data= $this->Employee_leave_service_model->api_all_leaves_apply_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$monthyear,$filter,$finalhraccept,$searchempid,$status_type);
        echo $this->api_encodecheck($data);        
    }

    public function api_delete_leavesapply(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $data=$this->Employee_leave_service_model->api_delete_leavesapply($employeeid,$uniqid,$companyid,$divisionid,$stateid,$branchid,$device_status);
        echo $this->api_encodecheck($data);
    }

    public function api_edit_leavesapply(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $category_type = $this->cleanInput($obj->{'category_type'}); // firsthalf
        $from = $this->cleanInput($obj->{'from'});
        $to = $this->cleanInput($obj->{'to'});
        $device_status = $this->cleanInput($obj->{'device_status'});
        $emp_desc = $this->cleanInput($obj->{'emp_description'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $leave_cateory = $this->cleanInput($obj->{'leave_cateory_applied'});
        $leave_address = $this->cleanInput($obj->{'leave_address'});
        $daysrange = $this->date_rangewith_days($from,$to);
        $noofdays=$daysrange['noofday'];

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$from)) {
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Please select date to apply leaves') ); exit;
        } 
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$to)) {
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>'Please select date to apply leaves') ); exit;
        } 
       
        //  -----------  added 22-07-2022 ---------------------
        if(($category_type == 1 || $category_type ==2) && ($daysrange['noofday'] > 1)){
            echo $this->api_encodecheck(array('status'=> '500','msg'=>'Failed','description'=>' With half day two different days is not possible')); exit;
        }
        //  -----------  end added 22-07-2022 ---------------------
      
        if($category_type == 1){
            $noofdays=0.5;
        }elseif($category_type == 2){
            $noofdays=0.5;
        }elseif($category_type == 3){
            $noofdays=$daysrange['noofday'];
        }
        $data=$this->Employee_leave_service_model->api_edit_leavesapply($employeeid,$uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$from,$to,$noofdays,$device_status,$emp_desc,$leave_cateory,$leave_address);  
        echo $this->api_encodecheck($data);
    }
    
    // public function api_all_hrleavesapply_list(){
    // $obj = $this->api_decode();
    // $employeeid = $this->cleanInput($obj->{'employeeid'});
    // $companyid = $this->cleanInput($obj->{'companyid'});
    // $divisionid = $this->cleanInput($obj->{'divisonid'});
    // $stateid = $this->cleanInput($obj->{'stateid'});
    // $branchid = $this->cleanInput($obj->{'branchid'});
    // $monthyear = $this->cleanInput($obj->{'month_year'});
    // $finalhraccept =$this->cleanInput($obj->{'finalhraccept'});
    // $ym=explode('-',$monthyear);
    // if(strlen($ym[1])==1){$monthyear = $ym[0].'-'.'0'.$ym[1]; }else{ $monthyear =$$monthyear;  }
    // $filter = $this->cleanInput($obj->{'filter'});
    // $data= $this->Employee_leave_service_model->api_all_hrleavesapply_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$monthyear,$filter,$finalhraccept);
    // echo $this->api_encodecheck($data);        
    // }


    public  function api_hr_final_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $data=$this->Employee_leave_service_model->api_hr_final_accept($employeeid,$companyid,$divisionid,$stateid,$branchid,$uniqid);
        // echo $data; exit;
        echo $this->api_encodecheck($data,$desc);
    }

    public function api_admin_leave_hraccept_approval(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $employeename = $this->cleanInput($obj->{'employeename'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $remarks = $this->cleanInput($obj->{'remarks'});
        $approve = $this->cleanInput($obj->{'approve'});
        $deviceid =  $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $data= $this->Employee_leave_service_model->admin_leave_hraccept_approval($employeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    }
    
    
    public function api_admin_hr_final_accept(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $uniqid = $this->cleanInput($obj->{'uniqid'});
        $deviceid =  $this->cleanInput($obj->{'deviceid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisonid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $data= $this->Employee_leave_service_model->admin_hr_final_accept($employeeid,$uniqid,$deviceid,$companyid,$divisionid,$stateid,$branchid);
        echo $this->api_encodecheck($data,$desc);
    }
    
    // ------------------ end added 20-02-2022 -----------
}
