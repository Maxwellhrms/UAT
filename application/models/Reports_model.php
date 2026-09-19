<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Reports_model extends Adminmodel
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

    public function createemailtemplate(){
        $this->db->select('*');
        $this->db->from('maxwell_email_templates');
        $query2 = $this->db->get();
        $qry['emailstemplates'] = $query2->result();
        return $qry;
    }

    public function getemailtemplate($data){
        $id = $data['id'];
        $this->db->select('*');
        $this->db->from('maxwell_email_templates');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $qry = $query->result();
    }

    public function saveemailtemplate($data){
        // print_r($data);exit;
        $id = $data['id'];
        $inarray = array(
            "email_division" => $this->cleanInput($data['division']),
            "email_title" => $this->cleanInput($data['title']),
            "email_subject" => $this->cleanInput($data['subject']),
            "email_body" => $data['desc'],
            "email_to" => $this->cleanInput($data['to']),
            "email_cc" => $this->cleanInput($data['cc']),
            "email_bc" => $this->cleanInput($data['bcc']),
            "showinletters" => $this->cleanInput($data['showinletters']),
        );
        if(empty($id)){
            $inarray["createdby"] = $this->session->userdata('user_name');
            $inarray["createdtime"] = DBDT;
            $inarray["created_ip"] = IP;
            $this->db->insert('maxwell_email_templates', $inarray);
            echo json_encode(array('respone' => 200)); die();
        }else{
            $inarray["modifyby"] = $this->session->userdata('user_name');
            $inarray["modifiedtime"] = DBDT;
            $inarray["modified_ip"] = IP;
            $this->db->where('id', $id);
            $this->db->update('maxwell_email_templates', $inarray);
            echo json_encode(array('respone' => 200)); die();
        }
        echo json_encode(array('respone' => 400)); die();
    }

    public function deleteemailtemplateinfobyid($data){
        $id = $data['id'];
        $status = $data['status'];
        if($status == 'Activate'){
            $acstatus = 1;
        }else{
            $acstatus = 0;
        }
        $uparray = array("email_status" => $acstatus);
        $this->db->where('id', $id);
        $res = $this->db->update('maxwell_email_templates', $uparray);
        if($res == 1){
            echo json_encode(array('respone' => 200)); die();
        }else{
            echo json_encode(array('respone' => 400)); die();
        }
    }

    public function getallemailtemplate(){
        $id = $data['id'];
        $this->db->select('id,email_title');
        $this->db->from('maxwell_email_templates');
        $this->db->where('email_status', '1');
        $query = $this->db->get();
        return $qry = $query->result();
    }
    
    public function getemailtemplatebyid($data){
        $id = $data['id'];
        $this->db->select('*');
        $this->db->from('maxwell_email_templates');
        $this->db->where('email_status', '1');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $qry = $query->result();
    }
    
    public function viewbyid($data){
        $id=$data['templates'];
        $this->db->select('*');
        $this->db->from('maxwell_email_templates');
        $this->db->where('email_status', '1');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $qry = $query->result();
    }
    

    
}