<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Options_table_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    public function option_search($field_name){
        $this->db->select('*');
        $this->db->from('options_table');
        $this->db->where('field_name', $field_name);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function option_create($userdata){ 
        $field_name= $userdata['f_name'];
        $trimedvalue = trim($userdata['f_val']);
        $field_value= str_replace(" ","_",$trimedvalue);
        $descr= $userdata['f_decr'];
        if ($field_name != '') {
            $this->db->select('*');
            $this->db->from('options_table');
            $this->db->where('field_name', $field_name);
            $this->db->where('field_value', $field_value);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count > 0) {
                echo 'already exist';
            } else {
                $this->db->set('field_name', $field_name);
                $this->db->set('field_value', $field_value);
                $this->db->set('descr', $descr);
                $this->db->set('options_status', 1);
                $this->db->set(
                    'row_insert_oprid',
                    $this->session->userdata('user_id')
                );
                $this->db->set('row_insert_dt', date('Y-m-d H:i:s'));
                $this->db->insert('options_table');
                echo 'created successfully';
            }
        }
    }
    public function option_update($field_name,$field_value,$descr,$filed_status,$f_id) {

        if (($field_name != '' && $field_value != '') || $field_value != 0) {
            $this->db->set('descr', $descr);
            $this->db->set('options_status', $filed_status);
            $this->db->set('row_update_oprid',$this->session->userdata('user_id'));
            $this->db->set('row_update_dt', date('Y-m-d H:i:s'));
            $this->db->where('id', $f_id);
            $this->db->update('options_table');
            echo 'created successfully';
        }
    
    }
    
    public function options_table(){
        $this->db->select('*');
        $this->db->from('options_table');
        $this->db->group_by('field_name'); 
        $query = $this->db->get();
        return $query->result();  
    }
}
