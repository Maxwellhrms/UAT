<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Import extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Import_model');       
    }
	
    public function verifylogin(){
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function uploadfiles(){   
        $this->verifylogin();
        $this->header();
        $data['tables'] = $this->Import_model->gettables();
        $this->load->view('import/fileuploads',$data);
        $this->footer();
    }

    public function saveuploadfile(){
        $this->verifylogin();
        if (!is_uploaded_file($_FILES["uploadFile"]["tmp_name"])) {
            echo 'Please Upload A File To Process'; exit;
        }
        $tablename = $this->input->post('tablename');
        $path = 'uploads/exceluploads/';
        $this->load->library('PHPExcel-1.8/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }

            $inputFileName = $path . $import_xls_file;


            try {
                echo phpversion();
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                //print_r($inputFileName);exit;
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                
                $flag = true;
                $i=0;
                $filednames = array();
                //print_r($filednames);exit; 
                 
                foreach ($allDataInSheet as $value){
                  if($flag){
                    $flag =false;
                    array_push($filednames,$value);
                    continue;
                  }
                  foreach($value as $key => $val){
                    $inserdata[$i][$filednames[0][$key]] = $this->Import_model->cleanInput($val);
                  }
                  $i++;
                }  
           
                $tablecolumn = array();
                $tbcolumn = $this->Import_model->getcolumns($tablename);
                foreach ($tbcolumn as $tbkey => $tbvalue) {
                    array_push($tablecolumn,$tbvalue['COLUMN_NAME']);
                }

                $excelcolumns = array_values($filednames[0]);
                $doesnothavecolumns = array();
                foreach ($excelcolumns as $exkey => $exvalue) {
                    if(!in_array($exvalue,$tablecolumn)){
                        array_push($doesnothavecolumns,$exvalue);
                    }
                }

                
                if(count($doesnothavecolumns) > 0){
                    echo 'These ' . implode(",",$doesnothavecolumns) .' Columns Does Not Have in the ' . $tablename . ' Remove Columns from File or Create and then Process'; exit;
                }else{
                    $result = $this->Import_model->importdata($inserdata,$tablename);   
                    if($result){
                      echo "200"; exit;
                    }else{
                      echo "ERROR !"; exit;
                    }
                }             

            } catch (Exception $e) {
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
              echo $error['error']; exit;
        }         
    }

    public function createtableandcolumns(){   
        $this->verifylogin();
        $this->header();
        $data['tables'] = $this->Import_model->gettables();
        $this->load->view('import/createtableandcolumns',$data);
        $this->footer();
    }

    public function savecreatetable(){
        $userdata = $this->input->post();
        $res = $this->Import_model->savecreatetable($userdata);
        if($res == 1){
            echo '200'; exit;
        }else{
            echo $res; exit;
        }
    }

    public function savecreatecolumns(){
        $userdata = $this->input->post();
        $res = $this->Import_model->savecreatecolumns($userdata);
        if($res == 1){
            echo '200'; exit;
        }else{
            echo $res; exit;
        }
    }

    public function userselfcreatedlistview(){   
        $this->verifylogin();
        $this->header();
        $data['tables'] = $this->Import_model->gettables();
        $this->load->view('import/userselfcreatedlistview',$data);
        $this->footer();
    }

    public function filterlist(){
        $this->verifylogin();
        $userdata = $this->input->post('tablename');
        $data['tables'] = $this->Import_model->filterlist($userdata);
        $data['columns'] = $this->Import_model->getcolumns($userdata);
        $this->load->view('import/userselfcreatedlistfilter',$data);
    }
    
    public function savbulkTds(){
        $this->verifylogin();
        if (!is_uploaded_file($_FILES["uploadFile"]["tmp_name"])) {
            echo 'Please Upload A File To Process'; exit;
        }
        $tablename = $this->input->post('tablename');
        $path = 'uploads/tdsbulk/';
        $this->load->library('PHPExcel/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);            
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }

            $inputFileName = $path . $import_xls_file;


            try {
                // echo phpversion();
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                //print_r($inputFileName);exit;
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                // echo"<pre>";print_r($allDataInSheet);exit;
                
                // Filter subarrays where at least one value is non-empty
                $filteredData = array_filter($allDataInSheet, function($subArray) {
                    return !empty(array_filter($subArray, function($value) {
                        return $value !== null && $value !== "";
                    }));
                });
                $filteredData = array_values($filteredData);
                // echo"<pre>";print_r($filteredData);exit;
                #check Empty File
               
                if (empty($filteredData)) {
                     echo 'Empty File not allowed'; exit;
                }
                #End check Empty File
                
                $empinfo = $this->Adminmodel->getemployeesinfo($withresigned['withResigned'] = 1);
                // Convert objects to arrays
                $empinfo = array_map(function ($obj) {
                    return (array) $obj;
                }, $empinfo);
                $empArray = array_column($empinfo,'mxemp_emp_id');
               
                //   echo"<pre>";print_r($empArray);exit;
                $inarray = array();
                $ip = $this->Import_model->get_client_ip();
                $date = date('Y-m-d H:i:s');
                foreach ($filteredData as $value){
                //   echo"<pre>";print_r($value);exit;
                    if(!isset($value['A']) || empty($value['A'])){
                        echo "empcode Should not be empty";exit; 
                    }else if(!in_array(trim($value['A']), $empArray)){
                        echo "Please check empcode not exist(". $value['A'].")";exit; 
                    }else if(!isset($value['B']) || empty($value['B']) || !is_numeric($value['B'])){
                        echo "Month & Year contains empty or non numeric value(".$value['B'].")";exit;
                    }else if(strlen($value['B']) != 6){
                        echo "Incorrect Month & Year value(".$value['B'].")";exit;
                    }else if(!isset($value['C']) || empty($value['C']) || !is_numeric($value['C'])){
                        echo "TDS amount contains empty or non numeric value(".$value['C'].")";exit;
                    }else if(strlen($value['C']) <= 0){
                        echo "TDS amount should not be zero(".$value['C'].")";exit;
                    }
                    
                    $empId = $this->Import_model->cleanInput($value['A']);
                    $yearMonth = $this->Import_model->cleanInput($value['B']);
                    $tds_amount = $this->Import_model->cleanInput($value['C']);
                    
                    #check Paysheet Status
                    $paysheetSatus = $this->Adminmodel->get_paysheet_generated_status($cmp_id =null, $yearMonth, $empId);
                    if(!$paysheetSatus){
                        echo "paysheet already generated for the year month($yearMonth) and emp id($empId)";exit;
                    }
                    
                    
                    #check TDS exist for that emp and month
                    $this->db->select();
                    $this->db->from("maxwell_misc_income");
                    $this->db->where("mxemp_misc_inc_empcode",$empId);
                    $this->db->where("mxemp_misc_inc_month_year",$yearMonth);
                    $this->db->where("mxemp_misc_inc_status",1);
                    $qry = $this->db->get();
                    // echo $this->db->last_query();exit;
                    $res = $qry->result();
                    if(count($res) > 0){
                        echo "Data already Exist for Empcode = $empId & month_year = $yearMonth";exit;
                    }
                    $data['emp_id'] = $empId;
                    $empData = $this->Adminmodel->getemployeesinfo($data);
                    // echo"<pre>";print_r($empData);exit;
                    $inarray[] = array(
                                "mxemp_misc_inc_comp_id" => $empData[0]->mxemp_emp_comp_code,
                                "mxemp_misc_inc_div_id" => $empData[0]->mxemp_emp_division_code,
                                "mxemp_misc_inc_state_id" => $empData[0]->mxemp_emp_state_code,
                                "mxemp_misc_inc_branch_id" => $empData[0]->mxemp_emp_branch_code,
                                "mxemp_misc_inc_emp_type" => $empData[0]->mxemp_emp_type,
                                "mxemp_misc_inc_empcode" => $empId,
                                "mxemp_misc_inc_tds_amt" => $tds_amount,
                                "mxemp_misc_inc_month_year" => $yearMonth,
                                
                                "mxemp_misc_inc_createdby" => $this->session->userdata('user_id'),
                                "mxemp_misc_inc_createdtime" => $date,
                                "mxemp_misc_inc_created_ip" => $ip,
                            );
                   
                }  
           
                // Perform bulk insert
                $result = $this->db->insert_batch('maxwell_misc_income', $inarray);
                if($result){
                  echo "200"; exit;
                }else{
                  echo "ERROR !"; exit;
                }
                           

            } catch (Exception $e) {
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
        }else{
              echo $error['error']; exit;
        }         
    }

}