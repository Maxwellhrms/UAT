<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Options_table_controller extends Common {
	protected $imglink = 'uploads/';
    public function __construct() {
        parent::__construct();
        $this->load->model('Options_table_model');
    }
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }
    public function index(){
        $this->verifylogin();
        echo 'Welcome';
    }

    public function option_search(){
        $this->header();
        $field_name = $this->input->get('field_name');
        $data['option_list'] = $this->Options_table_model->option_search($field_name);
        $this->load->view('options_table/option_list', $data);
        $this->footer(); 
    }
    public function option_create(){
        $userdata=$this->input->post();
        $this->Options_table_model->option_create($userdata);
        // printf( $field_name.'-'.$field_value.'-'.$filed_decr);

    }
    public function option_update(){
        $field_name=$this->input->post('f_name');
        $field_value=$this->input->post('f_val');
        $filed_decr=$this->input->post('f_decr');
        $filed_status=$this->input->post('f_status');
        $f_id=$this->input->post('f_id');
        $this->Options_table_model->option_update($field_name,$field_value,$filed_decr,$filed_status,$f_id);
        // printf( $field_name.'-'.$field_value.'-'.$filed_decr.'-'.$filed_status);

    }
    public function options_table()
    {
        $this->header();
        $field_name = $this->input->get('field_name');
        $data['options_table'] = $this->Options_table_model->options_table($field_name);
        $this->load->view('options_table/options_table', $data);
        $this->footer(); 
    }


}
?>