<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Paystructure_model extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    function cleanInput($val)
    {
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function getpaystructure_master($date = null,$emp_type = null){        
        $this->db->select("mxps_id");
        $this->db->from("maxwell_pay_structure_master");
        if($emp_type != null){
            $this->db->where("mxps_emptype_id",$emp_type);
        }
        if($date != null){
            $this->db->where("date(mxps_affect_from) <= '".$date."' and date(mxps_affect_to) >= '".$date."'");
        }
        $this->db->order_by("mxps_affect_from");
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        return $query->result();
    }
    public function getpaystructure_child($id = null,$type = null){
        $this->db->select("mxpsc_id,mxpsc_parent_id,mxpsc_affect_from,mxpsc_comp_id,mxpsc_emptype_id,mxpsc_inc_head_id,mxincm_name,mxpsc_percentage,mxpsc_type,mxpsc_isvariable_head,mxpsc_ispf,mxpsc_isesi,mxpsc_ispt,mxpsc_isbns,mxpsc_islwf,mxpsc_isgratuity");
        $this->db->from("maxwell_pay_structure_child");
        $this->db->join("maxwell_income_heads_master","mxincm_id = mxpsc_inc_head_id","inner");
        if($id != null){
            $this->db->where("mxpsc_parent_id",$id);
        }        
        if($type != null){
            $this->db->where("mxpsc_type",$type);
        }        
        $this->db->where("mxpsc_status",1);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        return $query->result();
    }
}