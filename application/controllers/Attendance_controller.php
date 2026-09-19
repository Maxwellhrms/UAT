<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Common.php';
class Attendance_controller extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Adminmodel');
    }
    public function add_attendance()
    {
        $this->verifylogin();
        $this->header();
        $this->load->view('attendance/add_attendance');
        $this->footer();
    }
    public function create_attandance_tables()
    {
        // echo "hi";exit;
        if (isset($_REQUEST['attendance_year'])) {
            $attendance_year = $_REQUEST['attendance_year'];
        } else {
            $attendance_year = null;
        }
        // print_r($_REQUEST);exit;
        return $this->Adminmodel->create_attandance_tables($attendance_year);
    }
    public function attendancemonthyear(){
        $this->verifylogin();
        $yeardt = $this->input->post();
        $data =  $this->Adminmodel->attendancemonthyear($yeardt);
        echo json_encode($data);
    }
    public function add_employee_records_in_attendance()
    {
        $this->verifylogin();
        $this->header();
        $this->load->view('attendance/add_employee_records_in_attendance');
        $this->footer();
    }
    public function add_employee_attandance_tables_in_db()
    {
        if (isset($_REQUEST['attendance_year'])) {
            $attendance_year = $_REQUEST['attendance_year'];
        } else {
            $attendance_year = null;
        }
        return $this->Adminmodel->add_employee_attandance_tables_in_db($attendance_year);
    }
    public function getattendancetable()
    {
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['att'] =  $this->Adminmodel->getattendancetable($userdata);
        return $this->load->view('attendance/attendance_table_check', $data);
    }

    public function createspecificattendancetable()
    {
        $this->verifylogin();
        $yeardt = $this->input->post();
        $data =  $this->Adminmodel->createspecificattendancetable($yeardt);
        echo json_encode($data);
    }
    
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }
    
    public function attendancemonthly(){
        $this->verifylogin();
        $this->header();
        $this->load->view('attendance/employee_monthly_attendance');
        $this->footer();
    }

    public function attendancemonthly_list(){
        $userdata = $this->input->post();
        $data['list'] =  $this->Adminmodel->attendancemonthly_list($userdata);
        $this->load->view('attendance/append_empmonthly_attenddesc',$data);
    }
    
    
    public function googlemap(){
        $this->verifylogin();
        $this->header();
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();        
        $this->load->view('attendance/google_map_select',$data);
        $this->footer();
    }
    
    
     public function googlemap_polyln(){
        $this->verifylogin();
        $this->header();
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();        
        $this->load->view('attendance/google_map_select_polyline',$data);
        $this->footer();
    }
   
    public function googlemap_polylines(){
        
    //  $userdata = $this->input->post();
    //  $date=$userdata['attendance'];
    // 	$employeeid=$userdata['employeeid'];
    	
        $this->verifylogin();
        $this->header();
        $date='2022-10-12';
        $employeeid='M0736';
        // $data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);

        $data['locations'] = [
            ['Somajiguda',17.423412,78.4616385,4],
            ['Secunderabad',17.4426187,78.4616385,3],
            ['surya towers',17.4426156,78.4893747,2],
            ['Kalasiguda',17.4426156,78.4893747,1]
        ];
        
        $a=[];
        $b=[];
        foreach($data['locations'] as $key => $val){
            $a[$key]= array('lat' => $val[2], 'lng' =>$val[1]);
            $b=$a;
        }
        
        $data['locations1']=$b;
        $this->load->view('attendance/google_map_polylines',$data);
        $this->footer();
    }

    public function polylinetest(){
        $this->verifylogin();
        $this->header();
        $date='2022-10-12';
        $employeeid='M0736';
        $data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);
        $data['locations1'] = [
            ['Somajiguda',17.423412,78.4616385,4],
            ['Secunderabad',17.4426187,78.4616385,3],
            ['surya towers',17.4426156,78.4893747,2],
            ['Kalasiguda',17.4426156,78.4893747,1]
        ];
        $this->load->view('attendance/polylinetest',$data);
        $this->footer();
    }
    
    public function polylines()
    {
        $this->verifylogin();
        $this->header();
        $date='2022-10-12';
        $employeeid='M0736';
        $data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);
        $this->load->view('attendance/polylines',$data);
        $this->footer();
    }
    
    public function attendance_google_map()
    {
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->get();

        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        
        /*
        if(!empty($userdata)){
            // print_r($userdata); exit;
            // Array ( [esi_company_id] => 1 [esi_div_id] => 1 [employeeid] => M0009 [attendance] => 03-01-2023 [esi_state_id] => 36 [esi_branch_id] => 1 )
            
            $esi_company_id=$userdata['esi_company_id'];
        	$data['cmpmaster']= $this->Adminmodel->getcompany_master_selected($esi_company_id);
            $esi_div_id=$userdata['esi_div_id'];
            $esi_state_id=$userdata['esi_state_id'];
            $esi_branch_id=$userdata['esi_branch_id'];
            $date=$userdata['attendance'];
        	$employeeid=$userdata['employeeid'];
        	$data['company_id']=$esi_company_id;
        	$data['sel_date']=$date;
        	
        	$data['load_division']= $this->Adminmodel->load_division($esi_company_id,$esi_div_id);
        	$data['div_id']=$esi_div_id;
        	
        	$data['state_id']=$esi_state_id;
        	$data['load_state']= $this->Adminmodel->load_state($esi_company_id,$esi_div_id);

        	$data['branch_id']=$esi_branch_id;
        	$data['load_branch']= $this->Adminmodel->load_branch($esi_company_id,$esi_div_id,$esi_state_id);
        
        	$data['employee_id']=$employeeid;
            $data['load_employee']= $this->Adminmodel->load_employeeslist($esi_company_id,$esi_div_id,$esi_state_id,$esi_branch_id);
        	$data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);
        }*/
        
        
        if(count($data['locations'])<=0){
            $data['message']='No Data Found';
        }
        $this->load->view('attendance/attendance_google_map',$data);
        $this->footer();
    }
    
     public function getemployeelistforattandance_googlemap(){
        $userdata = $this->input->post();
        $data['list'] = $this->Adminmodel->getemployeeslist_attendance_google_map($userdata);
        $data['userdata'] = $userdata;     
        $this->load->view('attendance/attendance_google_map_employeelis',$data);

    }
    
  
  public function googlepinpoints(){
      $this->verifylogin();
      $this->header();
      $employeeid = $this->input->get('employeeid');
      $date = $this->input->get('date');
      $data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);
      $this->load->view('attendance/googlemap_pinpoints',$data);
      $this->footer();
  }
    
    
    public function googlemap_list(){
        $this->verifylogin();
        $this->header();
    	$userdata = $this->input->post();
    	$date=$userdata['attendance'];
    	$employeeid=$userdata['employeeid'];
    	$data['locations'] = $this->Adminmodel->googlemap($employeeid,$date);
    	$this->load->view('attendance/google_map',$data);
        $this->footer();
    }
    
    // =============  PolyLines  =================
    
    public function attendance_google_map_poly()
    {
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->get();
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        if(count($data['locations'])<=0){
            $data['message']='No Data Found';
        }
        $this->load->view('attendance/attendance_google_map_poly',$data);
        $this->footer();
    }
    
     public function getemployeelistforattandance_googlemap_poly(){
        $userdata = $this->input->post();
        $data['list'] = $this->Adminmodel->getemployeeslist_attendance_google_map_poly($userdata);
        $data['userdata'] = $userdata;     
        $this->load->view('attendance/attendance_google_map_employeelis_poly',$data);

    }
    
    public function googlepinpoints_poly(){
      $this->verifylogin();
      $this->header();
      $employeeid = $this->input->get('employeeid');
      $date = $this->input->get('date');
      $data['locations'] = $this->Adminmodel->googlemap_poly($employeeid,$date);
      $this->load->view('attendance/googlemap_pinpoints_poly',$data);
      $this->footer();
  }
  
   public function googlemap_list_poly(){
        $this->verifylogin();
        $this->header();
    	$userdata = $this->input->post();
    	$date=$userdata['attendance'];
    	$employeeid=$userdata['employeeid'];
    	$data['locations'] = $this->Adminmodel->googlemap_poly($employeeid,$date);
    	$this->load->view('attendance/google_map',$data);
        $this->footer();
    }
   
    
}
