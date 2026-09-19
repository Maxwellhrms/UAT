<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Qrcode_generator extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Qrcode_generator_model'); 
        $this->verifylogin();
    }
    
        public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }
    public function index(){
        

    }
    
        public function qrcode_filter(){
		$this->header();
		$data['cmpmaster'] = $this->Qrcode_generator_model->qrcode_getcompany_master();
		$data['emptypedetails'] = $this->Qrcode_generator_model->qrcode_getemployeetypemasterdetails($id = '');
		$this->load->view('qrcode_generator/qrcode_filter',$data);
		$this->footer();	
	}
    public function qrcode_getdivisions_based_on_branch_master()
    {
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }

        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        $data = $this->Qrcode_generator_model->qrcode_getdivisions_based_on_branch_master($comp_id, $type);
        if (isset($_REQUEST['comp_id'])) {
            echo json_encode($data);
        } else {
            return $data;
        }
    }
    
    public function qrcode_getstates_based_on_branch_master()
    {
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }
        if (isset($_REQUEST['div_id'])) {
            $div_id = $_REQUEST['div_id'];
        } else {
            $div_id = null;
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        $data = $this->Qrcode_generator_model->qrcode_getstates_based_on_branch_master($comp_id, $div_id, $type);
        if (isset($_REQUEST['comp_id'])) {
            echo json_encode($data);
        } else {
            return $data;
        }
    }
    
    public function qrcode_getbranches_based_on_eligibility_state_wise()
    {
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }
        if (isset($_REQUEST['div_id'])) {
            $div_id = $_REQUEST['div_id'];
        } else {
            $div_id = null;
        }
        if (isset($_REQUEST['state_id'])) {
            $state_id = $_REQUEST['state_id'];
        } else {
            $state_id = null;
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        if (isset($_REQUEST['is_headoffice'])) {
            $is_headoffice = $_REQUEST['is_headoffice'];
        } else {
            $is_headoffice = null;
        }
        $data = $this->Qrcode_generator_model->qrcode_getbranches_based_on_eligibility_state_wise($comp_id, $div_id, $state_id, $type, $is_headoffice);
        echo json_encode($data);
    }

    public function processqrcode(){
		$userdata = $this->input->post();
        $this->load->helper('pdf_helper');
        $data['qrcodelistdisplay'] = $this->Qrcode_generator_model->processqrcode($userdata);
        $this->load->view('qrcode_generator/qrcode_list',$data);
    }


}