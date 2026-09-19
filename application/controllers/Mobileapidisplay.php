<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Mobileapidisplay extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel');
        $this->load->model('Common_model');
    }

    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function attendanceregulation(){
        $this->header();
        $this->verifylogin();
        $data['titlehead']="Attendance Regulation";
        $data['controller'] = $this;
        $this->load->view('mobiledispayscreens/attendenceregulation',$data);
        $this->footer();

	} 

    public function attendancesregulationlist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        // print_r($userdata); exit;
        $res['authresult'] =  $this->Adminmodel->allattendancelist($userdata);
        $this->load->view('mobiledispayscreens/attendanceregulationlist',$res);
    }
    
    public function approveauthreguattendance(){
        $this->verifylogin();
        $userdata = $this->input->post();
        // print_r($userdata); EXIT;
        // Harish Added to update it from back end
        /* $q = "SELECT mxar_id as uniqid FROM attendance_regulation 
        INNER JOIN maxwell_employees_info ON mxemp_emp_id = mxar_appliedby_emp_code 
        INNER JOIN maxwell_division_master ON mxd_id = mxar_div_id 
        INNER JOIN maxwell_branch_master ON mxb_id = mxar_branch_id 
        INNER JOIN maxwell_state_master ON mxst_id = mxar_state_id 
        WHERE mxar_status = '1' AND mxar_type = 'AR' AND mxar_comp_id = '1' AND mxar_authfinal_status = '9' AND DATE_FORMAT(mxar_from,'%Y-%m') = '2024-04' -- and mxar_appliedby_emp_code = 'M0799'
        ORDER BY mxar_createdtime DESC";
        $query = $this->db->query($q);
        $qury = $query->result();
        foreach($qury as $key => $val){
            $userdata = array();
            $userdata = array(
                'uniqid' => $val->uniqid,
                'approve' => 1,
                'remarks' => 'Updated From Back End As Requested By Sandeep',
            );
            $data =  $this->Adminmodel->admin_regulation_hraccept_approval($userdata);
            echo $data;
        } */
        // Harish Added to update it from back end
        $data =  $this->Adminmodel->admin_regulation_hraccept_approval($userdata);
        echo $data;
    }
    
    public function authrevert(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data =  $this->Adminmodel->adminauthrevert($userdata);
        echo $data;
    }


//   ------------------  added 05-11-2022  --------------------
    
    public function attendanceontour(){
        $this->verifylogin();
        $this->header();
        $data['titlehead']="On Tour Regulation";
        $data['controller'] = $this;
        $this->load->view('mobiledispayscreens/attendenceontour',$data);
        $this->footer();

	} 

    public function attendanceontourlist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res['authresult'] =  $this->Adminmodel->allattendanceontourlist($userdata);
        $this->load->view('mobiledispayscreens/attendanceontourlist',$res);
    }
    
    public function approveauthregulationontour(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data =  $this->Adminmodel->admin_ontour_hraccept_approval($userdata);
        echo $data;
    }
    
    public function authrevertontour(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data =  $this->Adminmodel->adminauthrevertontour($userdata);
        echo $data;
    }
    
//   ------------------  end added 05-11-2022 ----------------
    
    public function leaveapprovals(){
        $this->verifylogin();
        $this->header();
        $data['titlehead']="Leave Approvals";
        $data['controller'] = $this;
        $this->load->view('mobileleavedispayscreens/attendenceleave',$data);
        $this->footer();
	} 

 /*   public function attendanceleavelist(){
        $userdata = $this->input->post();
        // print_r($userdata); exit;
        $url="Employee_leave_service/api_all_leavesapply_list";
        $res['authresult'] = $this->curl($userdata,$url);
        $this->load->view('mobileleavedispayscreens/attendanceleavelist',$res);
    } */
    
    public function attendanceleavelist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res['authresult'] =  $this->Adminmodel->api_all_leavesapply_list($userdata);
        // print_r($res); exit;
        $this->load->view('mobileleavedispayscreens/attendanceleavelist',$res);
    }
    
    public function approveauthleaveattendance(){
        $this->verifylogin();
        $userdata = $this->input->post();
        // print_r($userdata); exit;
        $data =  $this->Adminmodel->admin_leave_hraccept_approval($userdata);
        echo $data;
    }
    
    public function finalleaveapprovals(){
        $this->verifylogin();
        $this->header();
        $data['titlehead']="Leave Approvals For Final Process";
        $data['controller'] = $this;
        $this->load->view('mobileleavedispayscreens/hrattendenceleave',$data);
        $this->footer();
    }
    
    /*
    public function finalleavelist(){
        $userdata = $this->input->post();
        $url="Employee_leave_service/api_all_leavesapply_list";
        $res['authresult'] = $this->curl($userdata,$url);
        $this->load->view('mobileleavedispayscreens/hrattendanceleavelist',$res);
    } */
    
    public function finalleavelist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        // print_r($userdata); exit;
        // $url="Employee_leave_service/api_all_leavesapply_list";
        // $res['authresult'] = $this->curl($userdata,$url);
        $res['authresult'] =  $this->Adminmodel->api_all_leavesapply_list($userdata);
        $this->load->view('mobileleavedispayscreens/hrattendanceleavelist',$res);
    }
    
    // public function hrapproveleave(){
    //     $userdata = $this->input->post();
    //     $data =  $this->Adminmodel->admin_leave_hraccept_approval($userdata);
    //     echo $data;
    // }
    
    
    public function hrfinalapproveleaveaccept(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data =  $this->Adminmodel->admin_hr_final_accept($userdata);
        echo $data;
    }

}
