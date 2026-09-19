<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Common_model extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    function get_client_ip(){
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

    public function groupmenu($roleid){
        $this->db->select('maxper_menuid,maxper_menuname,maxper_menuicon');
        $this->db->from('maxwell_menu_user_wise_table');
        $this->db->where('maxper_menustatus',1);
        $this->db->where('maxper_roleid',$roleid);
        $this->db->where('maxper_is_report != 1');
        $this->db->Order_by('maxper_menuname');
        $query = $this->db->get();
        // echo $this->db->last_query();
        $qury = $query->result();
        return $qury;
    }
    
    public function pagesubmenu($roleid){
        $this->db->select('maxsubwise_menu_id,maxsubwise_submenu_id,maxsubwise_name,maxsubwise_link');
        $this->db->from('maxwell_submenu_user_wise_table');
        $this->db->where('maxsubwise_status',1);
        $this->db->where('maxsubwise_role_id',$roleid);
        $this->db->where('maxsubwise_is_report != 1');
        $this->db->Order_by('maxsubwise_name');
        $query = $this->db->get();
        // echo $this->db->last_query();
        $qury = $query->result();
        return $qury;
    }
    
    public function groupmenu_report($roleid){
        $this->db->select('maxper_menuid,maxper_menuname,maxper_menuicon');
        $this->db->from('maxwell_menu_user_wise_table');
        $this->db->where('maxper_menustatus',1);
        $this->db->where('maxper_roleid',$roleid);
        $this->db->where('maxper_is_report = 1');
        $this->db->Order_by('maxper_menuname');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }
    
    public function pagesubmenu_report($roleid){
        $this->db->select('maxsubwise_menu_id,maxsubwise_submenu_id,maxsubwise_name,maxsubwise_link');
        $this->db->from('maxwell_submenu_user_wise_table');
        $this->db->where('maxsubwise_status',1);
        $this->db->where('maxsubwise_role_id',$roleid);
        $this->db->where('maxsubwise_is_report = 1');
        $this->db->Order_by('maxsubwise_menu_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }
    
    public function totalreportscount(){
        $roleid = $this->session->userdata('user_role');
        $this->db->select('maxper_menuname,maxper_menuid,count(maxper_menuid) as reportcount');
        $this->db->from('maxwell_menu_user_wise_table');
        $this->db->join('maxwell_submenu_user_wise_table', 'maxper_menuid = maxsubwise_menu_id', 'INNER');
        $this->db->where('maxper_is_report','1');
        $this->db->where('maxsubwise_is_report','1');
        $this->db->where('maxsubwise_role_id', $roleid);
        $this->db->group_by('maxper_menuid'); 
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qury = $query->result();
        return $qury;
    }

    public function loginhistory($type,$link){
        $date = date("Y-m-d H:i:s");
        $ip = $this->get_client_ip();
        
        $inarray = array(
          "mxlg_emp_id" => $this->session->userdata('user_id'),
          "mxlg_name" => $this->session->userdata('user_name'),
          "mxlg_role" => $this->session->userdata('user_role'),
          "mxlg_type" => $type,
          "mxlg_link" => $link,
          "mxlg_createdby" => $this->session->userdata('user_name'),
          "mxlg_createdtime" => $date,
          "mxlg_created_ip" => $ip
        );
        $this->db->insert("maxwell_hrms_emp_login_history",$inarray);
    }

    public function passwordvalidation($pass){
        $this->db->select('1');
        $this->db->from('maxwell_employees_login');
        $this->db->where('mxemp_emp_lg_password',$pass);
        $this->db->where('mxemp_emp_lg_employee_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }

    public function options_data($filedname){
        switch ($filedname) {
            case "esiReasons":
                $this->db->select('mxesi_rsn_id as field_value, CONCAT(mxesi_rsn_name, " - ", mxesi_rsn_code) as descr');
                $this->db->from('maxwell_esi_reasons');
                $this->db->where('mxesi_rsn_status','1');
                $this->db->Order_by('descr');
                $query = $this->db->get();
                $qury = $query->result();
                break;

            default:
                $this->db->select('field_value,descr');
                $this->db->from('options_table');
                $this->db->where('field_name',$filedname);
                $this->db->where('options_status','1');
                $this->db->Order_by('descr');
                $query = $this->db->get();
                $qury = $query->result();

        }
        
        return $qury;
    }
    
    public function getlegalnotifications(){
        $userid = $this->session->userdata('user_id');
        $reminder = config('notification_reminder');
        //print_r($reminder[0]->notification_reminder); exit;
        $this->db->select('mx_ntf_id,mx_ntf_appid,mxcp_name,mxd_name,mxst_state,mxb_name,mx_ntf_appid,mx_ntf_category,mx_ntf_filedby,mx_ntf_filedto,mx_ntf_hearing_date,mx_ntf_followup_date,mx_ntf_refrencce,mx_ntf_description,mx_ntf_notification,mx_ntf_status');
        $this->db->from('maxwell_legal_notifications');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_ntf_company', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_ntf_div', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_ntf_state', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_ntf_branch', 'INNER');
        $this->db->where('mx_ntf_status', 1);
        $this->db->where('mx_ntf_notification', 1);
        if($userid != '888666'){
            $this->db->where('mx_ntf_createdby',$userid);
        }
        // $this->db->where('mx_ntf_ym', '0');
        $cdate = date('Y-m-d');
        $date = date('Y-m-d', strtotime($cdate. ' +'.$reminder[0]->notification_reminder.'days'));
        $where = '(mx_ntf_hearing_date ="'.$date.'" or mx_ntf_followup_date = "'.$date.'")';
        $this->db->where($where);
        $this->db->order_by('mx_ntf_createdtime', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry['data'] = $query->result();
        $qry['cnt'] = $query->num_rows();
        return $qry;
    }
    
    public function getCompanyfilter(){
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_id','1');
        $query = $this->db->get();
        return $qury = $query->result();
    }
}