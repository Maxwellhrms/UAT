<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Permissionsmodel extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct(){
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

    public function getallmenus(){
        $this->db->select('maxgp_id,maxgp_name');
        $this->db->from('maxwell_menu_group');
        $this->db->where('maxgp_status',1);
        $this->db->Order_by('maxgp_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function getallsubmenus(){
        $this->db->select('maxpg_id,maxpg_name,maxpg_gp_id');
        $this->db->from('maxwell_submenu_page');
        $this->db->where('maxpg_status',1);
        // $this->db->where('maxpg_gp_id',$menuid);
        $this->db->Order_by('maxpg_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function saverolespermissions($data){
        $this->db->trans_begin();
        $role = $data['roles'];

        if(count($data['menu']) > 0){
            $this->db->where('maxper_roleid', $role);
            $this->db->delete('maxwell_menu_user_wise_table');
            $this->db->where('maxsubwise_role_id', $role);
            $this->db->delete('maxwell_submenu_user_wise_table');
            for ($i=0; $i<count($data['menu']); $i++){
                $menuid = $data['menu'][$i];
                if(count($data['submenu_'.$menuid]) > 0){
                $mainmenuresp = $this->get_menus_data($menuid);

                $main = array(
                    "maxper_roleid" => $role,
                    "maxper_menuid" => $menuid,
                    "maxper_menuname" => $mainmenuresp[0]->maxgp_name,
                    "maxper_menuicon" => $mainmenuresp[0]->maxgp_icon,
                    "maxper_menustatus" => '1',
                    "maxper_createdby" => '',
                    "maxper_order" => '0',
                    "maxper_is_report" => $mainmenuresp[0]->maxgp_is_report,
                );
                $this->db->insert('maxwell_menu_user_wise_table',$main);
                }
                if(count($data['submenu_'.$menuid]) > 0){
                    for ($j=0; $j < count($data['submenu_'.$menuid]); $j++) { 
                        $submenu_id = $data['submenu_'.$menuid][$j];
                        $subresp = $this->getallsubmenusdata($submenu_id,$menuid);
                        $submain = array(
                          "maxsubwise_role_id" => $role,
                          "maxsubwise_menu_id" => $menuid,
                          "maxsubwise_submenu_id" => $submenu_id,
                          "maxsubwise_name" => $subresp[0]->maxpg_name,
                          "maxsubwise_link" => $subresp[0]->maxpg_link,
                          "maxsubwise_icon" => $subresp[0]->maxpg_icon,
                          "maxsubwise_read" => "0",
                          "maxsubwise_write" => "0",
                          "maxsubwise_delete" => "0",
                          "maxsubwise_edit" => "0",
                          "maxsubwise_status" => "1",
                          "maxsubwise_createdby" => "",
                          "maxsubwise_order" => '0',
                          "maxsubwise_is_report" => $subresp[0]->maxpg_is_report,
                        );
                         $this->db->insert('maxwell_submenu_user_wise_table',$submain);
                    }
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 401;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }
    public function get_menus_data($menu_id = null){
        $this->db->select('maxgp_id,maxgp_name,maxgp_icon,maxgp_is_report');
        $this->db->from('maxwell_menu_group');
        $this->db->where('maxgp_status',1);
        if(!empty($menu_id) && $menu_id !=null){
        $this->db->where('maxgp_id',$menu_id);
        }
        $this->db->Order_by('maxgp_id');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        $qury = $query->result();
        return $qury;
    }

    public function getallsubmenusdata($submenu_id = null, $menu_id = null){
        $this->db->select('maxpg_id,maxpg_name,maxpg_gp_id,maxpg_link,maxpg_icon,maxpg_is_report');
        $this->db->from('maxwell_submenu_page');
        $this->db->where('maxpg_status',1);
        if(!empty($submenu_id) && $submenu_id !=null){
        $this->db->where('maxpg_id',$submenu_id);
        }
        if(!empty($menu_id) && $menu_id !=null){
        $this->db->where('maxpg_gp_id',$menu_id);
        }
        $this->db->Order_by('maxpg_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function getallmenusassigedtorole($data){
        $roleid = $data['roleid'];
        $this->db->select('maxper_menuid');
        $this->db->from('maxwell_menu_user_wise_table');
        $this->db->where('maxper_menustatus',1);
        $this->db->where('maxper_roleid',$roleid);
        $this->db->Order_by('maxper_order');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        $qury = $query->result();
        return $qury;
    }

    public function getallsubmenusassigedtorole($data){
        $roleid = $data['roleid'];
        $this->db->select('maxsubwise_submenu_id');
        $this->db->from('maxwell_submenu_user_wise_table');
        $this->db->where('maxsubwise_status',1);
        $this->db->where('maxsubwise_role_id',$roleid);
        $this->db->Order_by('maxsubwise_order');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        $qury = $query->result();
        return $qury;
    }

    public function addmenuroles($data){
        $rolename = $data['rolename'];
        $rolecreate = $data['rolecreate'];
        $roleupdate = $data['roleupdate'];
        $roledelete = $data['roledelete'];
        $date = date('Y-m-d H:i:s');
        $inarray = array(
            "maxuser_roles_name" => $rolename,
            "maxuser_roles_add" => $rolecreate,
            "maxuser_roles_edit" => $roleupdate,
            "maxuser_roles_delete" => $roledelete,
            "maxuser_roles_status" => "1",
            "maxuser_roles_created_date" => $date,
            "maxuser_roles_createdby" => $this->session->userdata('user_id'),
        );
        return $this->db->insert('maxwell_user_roles', $inarray);
    }

    public function updatecreatecheck($data){
        $rolecreate = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_add" => $rolecreate,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles', $uparray);
    }

    public function updateeditcheck($data){
        $roleedit = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_edit" => $roleedit,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles', $uparray);
    }

    public function updatedeletecheck($data){
        $roleedit = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_delete" => $roleedit,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles', $uparray);
    }

    public function getallroles(){
        $this->db->select('maxuser_roles_id,maxuser_roles_name,maxuser_roles_add,maxuser_roles_edit,maxuser_roles_delete');
        $this->db->from('maxwell_user_roles');
        $this->db->where('maxuser_roles_status',1);
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function searchemployeelgdetails($data){
        $employeecode = $data['employeeid'];
        $this->db->select('mxemp_emp_lg_employee_id,mxemp_emp_lg_fullname,mxemp_emp_lg_password,mxemp_emp_lg_role,mxemp_emp_lg_desktop_permissions,mxemp_emp_lg_id,mxemp_emp_google_map,mxemp_emp_inbranch,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_branch_code,mxemp_emp_dept_code,mxemp_emp_grade_code,mxemp_emp_desg_code,mxemp_emp_state_code,mxemp_emp_custom_branch,mxemp_is_hr');
        if($employeecode != '888666'){
            $this->db->join('maxwell_employees_info', 'mxemp_emp_lg_employee_id = mxemp_emp_id', 'INNER');
        }
        $this->db->from('maxwell_employees_login');
        $this->db->where('mxemp_emp_lg_employee_id',$employeecode);
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function updateemployeelgdetails($data){
        $employeeid = $data['employeeid'];
        $employeepassword = $data['employeepassword'];
        $employeerole = $data['employeerole'];
        $employeeloginstatus = $data['employeeloginstatus'];
        $google_map_locations = $data['google_map_locations'];
        $mxemp_emp_inbranch = $data['mxemp_emp_inbranch'];
        $custom_branch = implode(",",$data['custom_branch']);
        $mxemp_is_hr = $data['mxemp_is_hr'];
        $id = $data['empid'];
        $date = date('Y-m-d H:i:s');
        $uparray = array(
            "mxemp_emp_lg_password" => $employeepassword,
            "mxemp_emp_lg_role" => $employeerole,
            "mxemp_emp_lg_desktop_permissions" => $employeeloginstatus,
            "mxemp_emp_lg_modifyby" => $this->session->userdata('user_id'),
            "mxemp_emp_lg_modifiedtime" => $date,
            "mxemp_emp_google_map" => $google_map_locations,
            "mxemp_emp_inbranch" => $mxemp_emp_inbranch, 
            "mxemp_emp_custom_branch" => $custom_branch,
            "mxemp_is_hr" => $mxemp_is_hr,
        );
        $this->db->where('mxemp_emp_lg_id', $id);
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        return $this->db->update('maxwell_employees_login', $uparray);
    }

    public function employeeloginlist(){
        $this->db->select('mxemp_emp_lg_employee_id,mxemp_emp_lg_fullname,mxemp_emp_lg_password,mxemp_emp_lg_role,mxemp_emp_lg_desktop_permissions,mxemp_emp_google_map,mxemp_emp_inbranch,mxemp_emp_custom_branch');
        $this->db->from('maxwell_employees_login');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }
    
    public function getallbrancheslist($data){
        $company = $data[0]->mxemp_emp_comp_code;
        $division = $data[0]->mxemp_emp_division_code;
        $state = $data[0]->mxemp_emp_state_code;
        $this->db->select('mxb_id,mxb_name');
        $this->db->from('maxwell_branch_master');
        if(!empty($company)){
           $this->db->where('mxb_comp_id', $company); 
        }
        if(!empty($division)){
            $this->db->where('mxb_div_id', $division);
        }
        if(!empty($state)){
            $this->db->where('mxb_state_id', $state);
        }
        $this->db->where('mxb_status',1);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qury = $query->result();
        return $qury;
    }

}
?>