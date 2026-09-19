<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Developertools extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model('Developertoolsmodels');
    }

    public function verifylogin(){
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function createmenu(){
        $this->verifylogin();
        $this->header();
        $this->load->view('developertools/create_menus',$data);
        $this->footer();
    }

    public function getmenuslist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['displaymenulist'] = $this->Developertoolsmodels->getmenus($userdata);
        $menuname=$userdata['menuname'];
        if($userdata['submenu'] == 'Yes'){
            $def = '<option value="">Select Menu</option>';
            foreach ($data['displaymenulist'] as $key => $value) {
                if($menuname == $value->maxgp_id){
                    $def .= "<option value=".$value->maxgp_id." selected>".$value->maxgp_name."</option>";
                }else{

                    $def .= "<option value=".$value->maxgp_id.">".$value->maxgp_name."</option>";
                }
            }
            echo $def;
        }else{
            $data['userdata'] = $userdata;
            $this->load->view('developertools/menulist',$data);
        }
    }

    public function savemenudetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Developertoolsmodels->savemenudetails($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }
    }

    public function editsavemenudetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Developertoolsmodels->editsavemenudetails($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }       
    }

    public function createsubmenu(){
        $this->verifylogin();
        $this->header();
        $this->load->view('developertools/create_submenus',$data);
        $this->footer();
    }

    public function getsubmenuslist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['menutype'] = $userdata['menutype'];
        $data['menuname'] = $userdata['menuname'];
        $data['displaymenulist'] = $this->Developertoolsmodels->getsubmenus($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('developertools/submenulist',$data);
    }

    public function savesubmenudetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Developertoolsmodels->savesubmenudetails($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }
    }

    public function editsavesubmenudetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Developertoolsmodels->editsavesubmenudetails($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }           
    }
    
    public function employeedetailinfo(){
        $this->verifylogin();
        $this->header();
        $this->load->view('developertools/employeedetailinfo',$data);
        $this->footer();
      
    }
    
    public function employeedetails_list(){
        $userdata = $this->input->post();
        $employeeid = $userdata['empid'];
        $year = $userdata['selyear'];
        $data['respdata'] = $this->Developertoolsmodels->employeedetails_list($employeeid,$year);
        $data['alluserroles'] = $this->Developertoolsmodels->getallroles();
        $data['mobilealluserroles'] = $this->Developertoolsmodels->mobile_getallroles();
        $this->load->view('developertools/employeedetails_list',$data);
    }
    
    public function csvupload(){
        $this->verifylogin();
        $this->header();
        $data['respdata'] = $this->Developertoolsmodels->getprocesscsvupload();
        $this->load->view('developertools/csvupload',$data);
        $this->footer();
    }

    public function processcsvupload(){
        $csv = $_FILES['file']['tmp_name'];
        $handle = fopen($csv,"r");
        $csvdata = array();
        while (($row = fgetcsv($handle, 10000, ",")) != FALSE){
            if(count($row) > 1){ $csvdata[] = $row; }
        }
        fclose($handle);
        array_shift($csvdata);
        $res = $this->Developertoolsmodels->processcsvupload($csvdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }  
    }
    
    public function deletecsvdata(){
        $userdata = $this->input->post();
        $res = $this->Developertoolsmodels->deletecsvdata($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        } 
    }
    
    public function config(){
        $this->verifylogin();
        $this->header();
        $data['cnf'] = $this->Developertoolsmodels->config_details();
        $this->load->view('developertools/mx_config',$data);
        $this->footer();
    }
    
    public function updateconfig(){
       $this->verifylogin();
       $userdata = $this->input->post();
       $res = $this->Developertoolsmodels->updateconfig($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        } 
    }
    
    public function jsontags(){
        $this->verifylogin();
        $this->header();
        $data['empcode'] = $this->Developertoolsmodels->json_employees_code();
        $this->load->view('developertools/json_tags',$data);
        $this->footer();
    }
    
    public function employee_json_list(){
        $userdata = $this->input->post();
        $data[tags_list] = custom_tags($userdata['empcode'],$desc='',$tagsrender=false);
        $this->load->view('developertools/json_tags_list',$data);
    }
    
    public function cronlogs(){
        $this->verifylogin();
        $this->header();
        $data['filtertype'] = $this->Developertoolsmodels->getdistinctofcrontypes();
        $this->load->view('developertools/cron_log_filters',$data);
        $this->footer();
    }
    
    public function getcronlogslist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['displaymenulist'] = $this->Developertoolsmodels->getcronslogs($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('developertools/cron_log_lists',$data);
    }
    
    public function getemaillogs(){
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->post();
        $data['showlist'] = $this->Developertoolsmodels->getemaillogs($userdata);
        $data['type'] = $this->Developertoolsmodels->getdistinctemailtypes($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('developertools/email_logs_list',$data);
        $this->footer();
    }
    
    public function getdetailedemaillogs(){
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->get();
        $data['showlist'] = $this->Developertoolsmodels->getemaillogs($userdata);
        $this->load->view('developertools/email_logs_details',$data);
        $this->footer();
    }
    
    public function mobilelogs(){
        $this->verifylogin();
        $this->header();
        $data['controller'] = $this;
        $this->load->view('developertools/cron_mobile_logs',$data);
        $this->footer();
    }
    
    public function getmobilenoteslist(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['notes'] = $this->Developertoolsmodels->getmobilenoteslist($userdata);
        $data['getoptions'] = get_options_data('notes');
        $this->load->view('developertools/cron_mobile_logs_list',$data);
    }

    public function dailybackups(){
        $this->header();
        $data['title']= "Daily Backups";
        $data['titlehead']= "Daily Backups report";
        $data['check']="";
        $data['controller'] = $this;
        $this->load->view('dailybackups/dbbackups',$data);
        $this->footer();    
    }
    
    public function dailybackupslist(){
        $userdata = $this->input->post();
        echo $this->Developertoolsmodels->dailybackupslist($userdata);
    }

    public function downloadBackup() {
        $this->load->helper('download');

        $file = basename($this->input->get('file')); // prevent path traversal
        $path = $_SERVER['DOCUMENT_ROOT'] . '/backups/' . $file;

        if (!file_exists($path)) {
            show_404();
        }

        force_download($path, NULL);
    }

    public function getAllCronlist(){
        $this->verifylogin();
        $data['cronslist'] = $this->Developertoolsmodels->get_cron_jobs();
        $this->header();
        $this->load->view('developertools/cronslist',$data);
        $this->footer(); 
    }

    public function companyvalidations(){
        $this->verifylogin();
        $data['leavedetails'] = $this->Developertoolsmodels->getLeaveValidationRules();
        // echo '<pre>'; print_r($data['leavedetails']);exit;
        $this->header();
        $this->load->view('developertools/companyvalidations',$data);
        $this->footer(); 
    }

    public function saveLeaveValidationRules()
{

    $leaveTypes        = $this->input->post('leave_type');
    $fromDays          = $this->input->post('from_days');
    $toDays            = $this->input->post('to_days');
    $allowCombination  = $this->input->post('allow_combination');

    if(empty($leaveTypes)){

        echo json_encode([
            'status'  => false,
            'message' => 'No data received'
        ]);
        exit;
    }

    foreach($leaveTypes as $key => $leaveType){

        $combinationTypes = $this->input->post(
            'allow_combination_type_'.$leaveType
        );

        $data = [

            'leave_type' => $leaveType,

            'from_days' => isset($fromDays[$key])
                ? $fromDays[$key]
                : 0,

            'to_days' => isset($toDays[$key])
                ? $toDays[$key]
                : 0,

            'allow_combination' => isset($allowCombination[$key])
                ? $allowCombination[$key]
                : 0,

            'allow_combination_type' =>
                !empty($combinationTypes)
                ? implode(',', $combinationTypes)
                : NULL,

            'status' => 1

        ];

        $this->Developertoolsmodels->saveLeaveValidationRule($data);

    }

    echo json_encode([
        'status'  => true,
        'message' => 'Leave validation rules saved successfully'
    ]);

}
    
}
