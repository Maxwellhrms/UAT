<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Mobile_Permissionsmodel extends CI_Model
{
    protected $imglink = 'uploads/';
    public function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }
    function mobile_get_client_ip(){
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

    public function mobile_getallmenus(){
        $this->db->select('maxgp_id,maxgp_name');
        $this->db->from('maxwell_menu_group_mobile');
        $this->db->where('maxgp_status',1);
        $this->db->Order_by('maxgp_order','ASC');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function mobile_getallsubmenus(){
        $this->db->select('maxpg_id,maxpg_name,maxpg_gp_id');
        $this->db->from('maxwell_submenu_page_mobile');
        $this->db->where('maxpg_status',1);
        // $this->db->where('maxpg_gp_id',$menuid);
        $this->db->Order_by('maxpg_id');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function mobile_saverolespermissions($data){
        $this->db->trans_begin();
        $role = $data['roles'];

        if(count($data['menu']) > 0){
            $this->db->where('maxper_roleid', $role);
            $this->db->delete('maxwell_menu_user_wise_table_mobile');
            $this->db->where('maxsubwise_role_id', $role);
            $this->db->delete('maxwell_submenu_user_wise_table_mobile');
            for ($i=0; $i<count($data['menu']); $i++){
                $menuid = $data['menu'][$i];
                if(count($data['submenu_'.$menuid]) > 0){
                $mainmenuresp = $this->mobile_get_menus_data($menuid);

                $main = array(
                    "maxper_roleid" => $role,
                    "maxper_menuid" => $menuid,
                    "maxper_menuname" => $mainmenuresp[0]->maxgp_name,
                    "maxper_menuicon" => $mainmenuresp[0]->maxgp_icon,
                    "maxper_order" => $mainmenuresp[0]->maxgp_order,
                    "maxper_menustatus" => '1',
                    "maxper_createdby" => '',
                );
                $this->db->insert('maxwell_menu_user_wise_table_mobile',$main);
                }
                if(count($data['submenu_'.$menuid]) > 0){
                    for ($j=0; $j < count($data['submenu_'.$menuid]); $j++) { 
                        $submenu_id = $data['submenu_'.$menuid][$j];
                        $subresp = $this->mobile_getallsubmenusdata($submenu_id,$menuid);
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
                          "maxsubwise_order" => '0'
                        );
                         $this->db->insert('maxwell_submenu_user_wise_table_mobile',$submain);
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
    public function mobile_get_menus_data($menu_id = null){
        $this->db->select('maxgp_id,maxgp_name,maxgp_icon,maxgp_order');
        $this->db->from('maxwell_menu_group_mobile');
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

    public function mobile_getallsubmenusdata($submenu_id = null, $menu_id = null){
        $this->db->select('maxpg_id,maxpg_name,maxpg_gp_id,maxpg_link,maxpg_icon');
        $this->db->from('maxwell_submenu_page_mobile');
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

    public function mobile_getallmenusassigedtorole($data){
        $roleid = $data['roleid'];
        $this->db->select('maxper_menuid');
        $this->db->from('maxwell_menu_user_wise_table_mobile');
        $this->db->where('maxper_menustatus',1);
        $this->db->where('maxper_roleid',$roleid);
        $this->db->Order_by('maxper_order', 'ASC');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        $qury = $query->result();
        return $qury;
    }

    public function mobile_getallsubmenusassigedtorole($data){
        $roleid = $data['roleid'];
        $this->db->select('maxsubwise_submenu_id');
        $this->db->from('maxwell_submenu_user_wise_table_mobile');
        $this->db->where('maxsubwise_status',1);
        $this->db->where('maxsubwise_role_id',$roleid);
        $this->db->Order_by('maxsubwise_order', 'ASC');
        $query = $this->db->get();
       // echo $this->db->last_query(); die;
        $qury = $query->result();
        return $qury;
    }

    public function mobile_addmenuroles($data){
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
        return $this->db->insert('maxwell_user_roles_mobile', $inarray);
    }

    public function mobile_updatecreatecheck($data){
        $rolecreate = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_add" => $rolecreate,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles_mobile', $uparray);
    }

    public function mobile_updateeditcheck($data){
        $roleedit = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_edit" => $roleedit,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles_mobile', $uparray);
    }

    public function mobile_updatedeletecheck($data){
        $roleedit = $data['role'];
        $roleid = $data['roleid'];

        $uparray = array(
            "maxuser_roles_delete" => $roleedit,
        );
        $this->db->where('maxuser_roles_id', $roleid);
        return $this->db->update('maxwell_user_roles_mobile', $uparray);
    }

    public function mobile_getallroles(){
        $this->db->select('maxuser_roles_id,maxuser_roles_name,maxuser_roles_add,maxuser_roles_edit,maxuser_roles_delete');
        $this->db->from('maxwell_user_roles_mobile');
        $this->db->where('maxuser_roles_status',1);
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function mobile_searchemployeelgdetails($data){
        $employeecode = $data['employeeid'];
        $this->db->select('mxemp_emp_lg_employee_id,mxemp_emp_lg_fullname,mxemp_emp_lg_password,mxemp_emp_lg_role,mxemp_emp_lg_app_permissions,mxemp_emp_lg_id,mxemp_emp_lg_app_role,mxemp_emp_lg_mobile_type,mxemp_emp_lg_mobile_no,mxemp_emp_lg_email,mxemp_emp_lg_app_permission_regulations,mxemp_emp_lg_app_permission_leaves,mxemp_emp_lg_app_facialscan,mxemp_emp_lg_app_sync_punches,mxemp_emp_lg_app_is_logout,mxemp_emp_lg_device_id,mxemp_emp_lg_fcm_id,mxemp_emp_lg_app_is_resigned,mxemp_emp_comp_code,mxemp_leavetypes');
        $this->db->from('maxwell_employees_login');
        $this->db->join('maxwell_employees_info',"mxemp_emp_id = mxemp_emp_lg_employee_id","inner");
        $this->db->where('mxemp_emp_lg_employee_id',$employeecode);
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

    public function mobile_updateemployeelgdetails($data){
        $employeeid = $data['employeeid'];
        $employeepassword = $data['employeepassword'];
        $employeerole = $data['employeerole'];
        $employeeloginstatus = $data['employeeloginstatus'];
        $id = $data['empid'];
        
        // $reglist = $data['reglist'];
        // $leavelist = $data['leavelist'];
        
        $mobiletype = $data['mobiletype'];
        $mobileno = $data['mobileno'];
        $email = $data['email'];
        $facialscan = $data['facial_scan'];
        $syncpunches =$data['syncpunches'];
        $logoutoption = $data['display_logout'];
        $deviceid = trim($data['deviceid']);
        $fcmid = trim($data['fcmid']);
        $resigned = trim($data['resigned']);
        $leavetypes = implode(",",$data['leave_types']);
        $date = date('Y-m-d H:i:s');
        $uparray = array(
            "mxemp_emp_lg_password" => $employeepassword,
            "mxemp_emp_lg_app_role" => $employeerole,
            "mxemp_emp_lg_app_permissions" => $employeeloginstatus,
            "mxemp_emp_lg_modifyby" => $this->session->userdata('user_id'),
            "mxemp_emp_lg_modifiedtime" => $date,
            "mxemp_emp_lg_mobile_type" => $mobiletype,
            "mxemp_emp_lg_mobile_no" => $mobileno,
            "mxemp_emp_lg_email" => $email,
            // "mxemp_emp_lg_app_permission_regulations" => $reglist,
            // "mxemp_emp_lg_app_permission_leaves" => $leavelist,
            "mxemp_emp_lg_app_facialscan" => $facialscan,
            "mxemp_emp_lg_app_sync_punches" => $syncpunches,
            "mxemp_emp_lg_app_is_logout" => $logoutoption,
            "mxemp_emp_lg_device_id" => $deviceid,
            "mxemp_emp_lg_fcm_id" => $fcmid,
            "mxemp_emp_lg_app_is_resigned" => $resigned,
            "mxemp_leavetypes" => $leavetypes,
        );
        $this->db->where('mxemp_emp_lg_id', $id);
        $this->db->where('mxemp_emp_lg_employee_id', $employeeid);
        return $this->db->update('maxwell_employees_login', $uparray);
    }

    public function mobile_employeeloginlist(){
        $this->db->select('mxemp_emp_lg_employee_id,mxemp_emp_lg_fullname,mxemp_emp_lg_password,mxemp_emp_lg_app_role,mxemp_emp_lg_app_permissions,mxemp_emp_lg_mobile_type,mxemp_emp_lg_mobile_no,mxemp_emp_lg_email,mxemp_emp_lg_app_facialscan,mxemp_emp_lg_app_sync_punches,mxemp_emp_lg_app_is_logout,mxemp_emp_lg_device_id,mxemp_emp_lg_fcm_id,mxemp_emp_lg_app_is_resigned');
        $this->db->from('maxwell_employees_login');
        $query = $this->db->get();
        $qury = $query->result();
        return $qury;
    }

}
?>