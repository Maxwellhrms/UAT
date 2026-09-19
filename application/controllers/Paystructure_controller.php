<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Common.php';
class Paystructure_controller extends Common
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Adminmodel');
        $this->load->model('Paystructure_model');
    }

    public function index()
    {
        if (!$this->session->userdata('logindetails')) {
            $this->load->view('index');
        } else {
            redirect(base_url() . 'admin/dashboard');
        }
    }
    //--------------------GET PAYSTRUCTURE
    public function get_paystructure_child()
    {
        
        if (isset($_REQUEST['date'])) {
            $date = $_REQUEST['date'];
        } else {
            $date = null;
        }

        if (isset($_REQUEST['emp_type'])) {
            $emp_type = $_REQUEST['emp_type'];
        } else {
            $emp_type = null;
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }


        $pay_structure_master_id = $this->Paystructure_model->getpaystructure_master($date,$emp_type);
        $pay_master_count = count($pay_structure_master_id);
        //----------IF WE GET MULTIPLE RECORDS WE WILL THROW ERROR MESSAGE
        if($pay_master_count > 1){
            echo "101";
            exit;
        }else if(count($pay_structure_master_id) == 0){//----------->NO RECORD FOUND IN PAY STRUCTURE MASTER
            echo json_encode($pay_structure_master_id);
            exit;
        }        
        //----------END IF WE GET MULTIPLE RECORDS WE WILL THROW ERROR MESSAGE
        //----------GETTING CHILD TABLE RECORDS
        if($pay_master_count > 0 && $pay_master_count == 1){
            $pay_structure_child = $this->Paystructure_model->getpaystructure_child($pay_structure_master_id[0]->mxps_id,$type);
            echo json_encode($pay_structure_child);
        }
        //----------END GETTING CHILD TABLE RECORDS
        // echo $pay_master_count;
        // print_r($pay_structure_master_id);
    }
    //--------------------END GET PAYSTRUCTURE
}
