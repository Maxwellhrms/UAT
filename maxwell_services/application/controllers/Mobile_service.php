<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Mobile_service extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('Mobile_model');
    }

	public function index(){
		echo IP;
	}

	public function api_company()
    {
        $obj = $this->api_decode();
        $data = $this->Mobile_model->api_getcompany_master();
        echo $this->api_encodecheck($data);
    }

    public function api_getdivision(){
        $obj = $this->api_decode();
        $cmid = $this->cleanInput($obj->{'companyid'});
        $data = $this->Mobile_model->api_divisionmaster($cmid);
        echo $this->api_encodecheck($data);
    }

    public function api_getstates_based_on_branch_master(){ 
        $obj = $this->api_decode();
        $comp_id = $this->cleanInput($obj->{'companyid'});
        $div_id = $this->cleanInput($obj->{'divisionid'}); 
        $data= $this->Mobile_model->api_getstates_based_on_branch_master($comp_id, $div_id,$type = null);
        echo $this->api_encodecheck($data,$desc);

    }

    public function api_getbranch(){
        $obj = $this->api_decode();
        $divid = $this->cleanInput($obj->{'divisionid'}); 
        $stid = $this->cleanInput($obj->{'stateid'});
        $data = $this->Mobile_model->api_branchmaster($divid,$stid);
        echo $this->api_encodecheck($data,$desc);
    }

    public function api_getdepartment(){
        $obj = $this->api_decode();
        $cmid = $this->cleanInput($obj->{'companyid'}); 
        $data = $this->Mobile_model->api_departmentmaster($cmid);
        echo $this->api_encodecheck($data);
    }

    public function api_getgrade(){
        $obj = $this->api_decode();
        $cmid = $this->cleanInput($obj->{'companyid'}); 
        $data = $this->Mobile_model->api_grademaster($cmid);
        echo $this->api_encodecheck($data);
    }

    public function api_getdesignations(){
        $obj = $this->api_decode();
        $grid = $this->cleanInput($obj->{'gradeid'}); 
        $data = $this->Mobile_model->api_designationmaster($grid);
        echo $this->api_encodecheck($data);
    }
    
  /*  public function api_logincheck(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $userpassword = $this->cleanInput($obj->{'userpassword'}); 
        $user['employee_login'] = $this->Mobile_model->api_checkvaliduser($employeeid,  $userpassword);
        if ($user['employee_login'] =="premission_denied"){
            $desc="Sorry you dont have permission.Please Contact Admin";
            $user['employee_login']=[];
        }elseif($user['employee_login'] =="invalid_pass"){
            $desc="Invalid Password";
            $user['employee_login']=[];
        }elseif($user['employee_login'] =="invalid_emp"){
            $desc="Invalid Employee ID";
            $user['employee_login']=[];
        }else{
            $desc=""; 
        }
        echo $this->api_encode1($user,$desc);
        
    }   */
    
    public function api_logincheck(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $userpassword = $this->cleanInput($obj->{'userpassword'});
        $deviceid = $this->cleanInput($obj->{'deviceid'});
        $fcmid = $this->cleanInput($obj->{'fcmid'});
        $user = $this->Mobile_model->api_checkvaliduser($employeeid,  $userpassword, $deviceid, $fcmid);
        echo $this->api_encodecheck($user);
    }
    
    public function api_custom_permissions(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $user = $this->Mobile_model->api_custom_permissions($employeeid);
        echo $this->api_encodecheck($user);   
    }
    
    public function api_employeeconfig(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $user = $this->Mobile_model->api_employeeconfig($employeeid);
        echo $this->api_encodecheck($user);
    }
    
    public function api_facial_scan(){
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $user = $this->Mobile_model->api_facial_scan($employeeid);
        echo $this->api_encodecheck($user);   
    }

    public function api_sidemenu(){
        $usermenus = array();
        $obj = $this->api_decode();
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        if(empty($obj->{'employeeid'})){
            $employeeid = $this->input->get('employeeid');
        }
        $roleid = $this->cleanInput($obj->{'roleid'});
        if(empty($obj->{'roleid'})){
            $roleid = $this->input->get('roleid');
        }       
        $side_menu = $this->Mobile_model->api_sidemenu($employeeid, $roleid);
        //print_r($side_menu);
        foreach ($side_menu['menus'] as $key => $menuval) {
            if($menuval->title != 'dashboard'){
               $usermenus[$key]['icon-alt'] = $menuval->icon; 
            }
                 
                $usermenus[$key]['icon'] = $menuval->icon;
                $usermenus[$key]['title'] = $menuval->title;
                
                if($menuval->title == 'dashboard'){
                    $usermenus[$key]['state'] = '/';
                }else{
                    $usermenus[$key]['state'] = '/'.$menuval->title;
                }
                $submenu = $this->Mobile_model->api_submenus($menuval->menuid, $menuval->menuroleid);
                if($menuval->title != 'dashboard'){
                    $usermenus[$key]['children'] = $submenu;
                }
                
        }
        // if($side_menu == "menu_premission_denied"){
        //     $desc="No Menu Assign For This Employee";
        //     $usermenus=array('employee_menu'=>[]);
        // }else{
        //     $desc=""; 
        //     $usermenus=array('employee_menu'=>$usermenus);
        // }
        echo $this->api_encodecheck($usermenus,$desc);
    }
    
    public function api_holiday(){
        $obj = $this->api_decode();
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $companyid = $this->cleanInput($obj->{'companyid'});
        $options = $this->options_master('adm_holiday_types');
        $div_id = $this->cleanInput($obj->{'divisionid'});
        $data = $this->Mobile_model->api_holiday($stateid, $branchid, $companyid,$options,$div_id);
        echo $this->api_encodecheck($data);   
    }
    
    public function api_custom_dropdowns(){
        $obj = $this->api_decode();
        $commondropdown = $this->cleanInput($obj->{'commondropdown'});
        // $message="Success";
        // $statuscode="200";
        // $data1['status']=$statuscode;
        // $data1['msg']=$message;
        // $data1['description']='';
        $data = $this->options_dropdown($commondropdown);
        // if(count($data)>0){
        //     $data1['dropdown'] = $data;
        // }else{
        //     $data1['description']='No Data';
        // }
        echo $this->api_encodecheck($data); 
    }
    
}
