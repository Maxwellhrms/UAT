<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(0);
 require 'Common.php';
class Export extends Common {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Export_model', 'export');
        $this->load->model('Adminmodel');
        $this->load->model('Common_model');
        $titlehead = 'MAXWELL LOGISTICS PRIVATE LIMITED';
    }    
 
   public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function cellColor($cells,$color){
        $this->load->library('excel');
        $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                 'rgb' => $color
            )
        ));
        //    $this->cellColor('A1:B4','#87CEEB');
    }

 
    public function index() {
        $data['export_list'] = $this->export->exportList();
    }
     public function esi_return_report_list2()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'ESI';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "IP Number",
                                "IP Name",
                                "No of Days for which wages paid/payable during the month",
                                "Total Monthly Wages",
                                "Reason Code for Zero workings days",
                                "Last Working Day",
								"Division",
								"State",
								"esi",
									"esi company",
									"emp_code"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_total_days_from_attendance) as no_of_days",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "mxesi_rsn_code as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            // $data['orignal_column_names'] = array(
            //                         "mxsal_emp_code",
            //                         "esi_no",
            //                         "name",
            //                         "no_of_days",
            //                         "sum(gross_wages) as gross_wages",
            //                         "reason",
            //                         "relieve_date as relieve_date"
                                    
            //                     );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_total_days_from_attendance as no_of_days",
                                    "mxsal_actual_gross as gross_wages",
                                    "mxesi_rsn_code as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date",
									"mxd_name as division",
									"mxst_state as state",
									"mxsal_esi_emp_cont as esi",
									"mxsal_esi_comp_cont as esi_company",
									"mxsal_emp_code as mxsal_emp_code",
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_esi_2($data);                        
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        ""
                                    );
            }
        }
        // echo"<pre>";print_r($data);exit;
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
   
   
    
    // -------------- added on 02-07-2023 ---------------

    public function daily_attendance_report()
    {
        $this->header();
        $data['title']= "Daily Attendance Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= " Employee Daily Attendance Report";
        $data['check']=array("attendance_regulation");
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/Daily_Attendance_report',$data);
        $this->footer();
    }
    public function pf_report1()
    {
        $this->header();
        $data['title']= "PF Form 3A";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Form 3A";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report1',$data); 
        $this->footer();
    }
    
        public function pf_report_list1()
    {
        $userdata = $this->input->post();     
        // echo '<pre>';print_r($userdata);exit;
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "EMP CODE",                                
                                "UAN",
                                "MEMBER NAME",
                                "GROSS WAGES",
                                "EPF WAGES",
                                "EPS WAGES",
                                "EDLI WAGES",
                                "EPF CONTRI REMITTED",
                                "EPS CONTRI REMITTED",
                                "EPF EPS DIFF REMITTED",
                                "NCP DAYS",
                                "REFUND OF ADVANCES"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_id as emp_code",
                                    //"mxsal_emp_code",
                                    "mxemp_emp_uan_number as uan",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "sum(mxsal_actual_basic) as epf_wages",
                                    "sum(mxsal_eps_wages) as eps_wages",
                                    "sum(mxsal_edli_wages) as edli_wages",
                                    "sum(mxsal_pf_emp_cont) as epf_cont_remit",
                                    "sum(mxsal_pf_pension_cont) as epf_eps_diff_remit",
                                    "sum(mxsal_pf_comp_cont) as eps_cont_remit",
                                    "sum(mxsal_lop_from_attendance) as ncp_days",
                                    " '' as refund_adv",
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data61($data);
           //$data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
												"serial_number",
                                                "emp_code",
                                                
                                                "uan",
                                                "name",	
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
												""
                                             );
											 
            
            }
			$this->load->view('reports/excelreports/dynamic_paysheet_excellist1_61',$data);
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    
                                    "mxemp_emp_id as emp_code",
									"mxemp_emp_uan_number as uan1",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_actual_gross as gross_wages",
                                    "mxsal_actual_basic as epf_wages",
                                    "mxsal_eps_wages as eps_wages",
                                    "mxsal_edli_wages as edli_wages",
                                    "mxsal_pf_emp_cont as epf_cont_remit",
                                    "mxsal_pf_comp_cont as eps_cont_remit",
                                    "mxsal_pf_pension_cont as epf_eps_diff_remit",
                                    "concat(Absent + First_Half_Absent + Second_Half_Absent) as ncp_days",
                                    " '' as refund_adv",
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data1($data);                        
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                "",
                                                "",
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                ""
                                             );
            }
			$this->load->view('reports/excelreports/dynamic_paysheet_excellist1',$data);
        }
        
        
        
        
    }
   
    
    public function pf_report5()
    {
        $this->header();
        $data['title']= "PF Monthly ECR Attacment";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Monthly ECR Attacment";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report5',$data); 
        $this->footer();
    }
     public function pf_report_list5()
    {
        $userdata = $this->input->post();     
        // echo '<pre>';print_r($userdata);exit;
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",                                
                                "MONTH & YEAR",
                                "GROSS WAGES",
                                "EPF WAGES",
                                "EPS WAGES",
                                "EDLI WAGES",
                                "EPF CONTRI REMITTED",
                                "EPS CONTRI REMITTED",
                                "EPF EPS DIFF REMITTED",
                                "NCP DAYS",
                                "REFUND OF ADVANCES",
                                "last date of payment",
                                "paid date",
                                "attachement",
                                "view"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_emp_code",
                                    "mxemp_emp_uan_number as uan",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "sum(mxsal_actual_basic) as epf_wages",
                                    "sum(mxsal_eps_wages) as eps_wages",
                                    "sum(mxsal_edli_wages) as edli_wages",
                                    "sum(mxsal_pf_emp_cont) as epf_cont_remit",
                                    "sum(mxsal_pf_comp_cont) as eps_cont_remit",
                                    "sum(mxsal_pf_pension_cont) as epf_eps_diff_remit",
                                    "sum(mxsal_lop_from_attendance) as ncp_days",
                                    
									" '' as last date of payment",
									" '' as attachment",
									" '' as view",
                                );
            
            
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data_financial_yearattach($data);
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                
												"",
												"",
												""
                                             );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_uan_number as uan",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_actual_gross as gross_wages",
                                    "mxsal_actual_basic as epf_wages",
                                    "mxsal_eps_wages as eps_wages",
                                    "mxsal_edli_wages as edli_wages",
                                    "mxsal_pf_emp_cont as epf_cont_remit",
                                    "mxsal_pf_comp_cont as eps_cont_remit",
                                    "mxsal_pf_pension_cont as epf_eps_diff_remit",
                                    "concat(Absent + First_Half_Absent + Second_Half_Absent) as ncp_days",
                                    
									" '' as last_date_of_payment",
									" '' as paid_date",
									" '' as attachment",
									" '' as view"
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data($data);                        
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                "",												
                                                "",												
												"",
												"",
												""
                                             );
            }
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist5',$data);
        
    }
   
   public function do_upload()
	{
		
		
		 //ini_set('max_execution_time', 300); // 5 minutes
    //ini_set('max_input_time', 300);
    //ini_set('memory_limit', '256M');
	
	ini_set('max_execution_time', 600); // 10 minutes
ini_set('max_input_time', 600);     // 10 minutes input time
ini_set('memory_limit', '256M');    // or more, if needed

    $config['upload_path']   = './uploads/pf_ecr/';
    $config['allowed_types'] = 'jpg|png|pdf|doc|docx';
    //$config['max_size']      = 2048;//2mb
    $config['max_size']      = 10240;//10mb
$attndyear = $this->input->post('attndyear');
$paiddate = $this->input->post('paiddate');
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('ecr_upload')) {
        $error = $this->upload->display_errors();
        echo "Error: " . $error;
    } else {
        $upload_data = $this->upload->data(); // Contains file info
		$file_name = $upload_data['file_name'];
//$file_path = base_url('uploads/pf_ecr/' . $file_name);
$file_path = base_url() . 'uploads/pf_ecr/'. $file_name;

        // Prepare data for database
        $data = array(
            'file_name' => $upload_data['file_name'],
            'file_type' => $upload_data['file_type'],
            'file_size' => $upload_data['file_size'],
            'uploaded_at' => date('Y-m-d H:i:s') // current timestamp
        );


		$cldata = array(
            'attndyear'=> $attndyear,
            'paiddate'=> $paiddate,
            'file_path' =>$file_path,
            'uploaded_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('ecr_attachments',$cldata);
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            //return 2;
        } else {
            $this->db->trans_commit();
            //return 1;
        }
		
        // Load model and insert
        //$this->load->model('Upload_model');
       // $this->Upload_model->insert_file($data);
	   //insert qurey need to write

        echo "Upload and insert successful: " . $upload_data['file_name'];
    }

	}
	
	
	public function esi_return_report2()
    {
		
        $this->header();
        $data['title']= "Month wise ESI RETURN REPORT";
        $data['titlehead']= " Month wise ESI RETURN REPORT";
        $data['excelheading']= "Month wise ESI RETURN REPORT";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/esi_return_report2',$data); 
        $this->footer();
    }
    
    public function pf_report3()
    {
        $this->header();
        $data['title']= "PF Form 10";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Form 10";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report3',$data); 
        $this->footer();
    }
    public function pf_report_list3()
    {	
        $userdata = $this->input->post();     
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(                          
                                "emp_code",
                                "UAN",
                                "PF",
                                "MEMBER NAME",
                                "Nominee",
                                "DOL",
                                "Reason"
                             );
         $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
$data['common'] = $this->Adminmodel->getemployeedetailstosetsession3($data);
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
   }
     public function bonus()
    {
        $this->header();
        $data['title']= "Bonus Register";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Bonus Register";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/bonus_report5',$data); 
        $this->footer();
    }
	
	public function update_bonus_status() {
    $emp_codes = $this->input->post('emp_codes');
    $status = $this->input->post('status');
    $remarks = $this->input->post('remarks');
    $finacial_month_year = $this->input->post('finacial_month_year');
    $password_user = $this->input->post('password_user');
	
	
	$user_id=$this->session->userdata('user_id');
	
	$sql5 = " SELECT * FROM maxwell_employees_login where mxemp_emp_lg_employee_id = '$user_id' and mxemp_emp_lg_password='$password_user' ";
 $result5 = $this->db->query($sql5);
  $lastrowofareq5=$result5->result_array();
  $oldLead_id5=$result5->num_rows() ;
  if($oldLead_id5>0)
  { 
	
  
  
  
	

    if (!empty($emp_codes)) {
        foreach ($emp_codes as $emp_code) {
            $data = [
                'bonus_status' => $status,
                'finacial_month_year' => $finacial_month_year,
                'remarks' => $remarks
            ];
            
			
			$sql5 = " SELECT * FROM update_bonus_status where emp_code = '$emp_code' and finacial_month_year= '$finacial_month_year' ";
 $result5 = $this->db->query($sql5);
  $lastrowofareq5=$result5->result_array();
  $oldLead_id5=$result5->num_rows() ;
  if($oldLead_id5>0){ 
	//$stafftblid_cross_check=$lastrowofareq5['0']['id'];
      $dateTime = date('Y-m-d H:i:s');
	$data=$this->db->query("UPDATE update_bonus_status SET  bonus_status='$status',remarks='$remarks', updated_by='$user_id',updated_at='$dateTime' WHERE  emp_code = '$emp_code' and finacial_month_year= '$finacial_month_year'  ");
  }
  else{
      $dateTime = date('Y-m-d H:i:s');
 $data=$this->db->query("INSERT INTO update_bonus_status (emp_code, bonus_status, finacial_month_year,remarks,created_by,created_at)VALUES ('$emp_code', '$status', '$finacial_month_year', '$remarks','$user_id','$dateTime');");
  }

        }
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No emp_codes received']);
    }
	
	
	
	
	}else{
		echo json_encode(['status' => 'error', 'message' => 'password incorect']);
	}
}



    public function pf_report4()
    {
        $this->header();
        $data['title']= "PF Register";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Register";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report4',$data); 
        $this->footer();
    }
    public function pf_report_list4()
    {
        $userdata = $this->input->post();     
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(                          
                                "emp_code",
                                "UAN",
                                "PF",
                                "MEMBER NAME",
                                "Nominee",
                                "DOB",
                                "Gender",
                                "DOJ",
                                "DOJ in PF",
                                "DOJ in PENSION",
                                "DOL",
                                "NO OF Service"
                             );
         $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
$data['common'] = $this->Adminmodel->getemployeedetailstosetsession4($data);
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist4',$data);
   }
 

 public function bonus_report_list5()
    {
        $userdata = $this->input->post();     
        $data['statutory_type'] = 'Bonus';
        $data['userdata']  = $userdata;
        $data['headings']  = array(                          
                                "finace year",                                
                                "status",                                
                                "DOL",                                
                                "bonus paid on",                                
                                "manuall status",                                
                                "emp_code",                                
                                "PF",
                                "UAN",
                                "MEMBER NAME",
                                "Dept",
                                "Design",
                                "Gender",
                                "DOJ",
                                "SAL",
                                "Bonus in %",
                                "Bonus in Amount",
                                "remarks"
                             );
         $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
$data['common'] = $this->Adminmodel->getemployeedetailstosetsession_bonus5($data);

        $this->load->view('reports/excelreports/dynamic_bonus_excellist6',$data);
   }
 

 
   public function esi_return_report6()
    {
		
        $this->header();
        $data['title']= "6Months ESI RETURN REPORT";
        $data['titlehead']= " 6Months ESI RETURN REPORT";
        $data['excelheading']= "6Months ESI RETURN REPORT";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/esi_return_report6',$data); 
        $this->footer();
    }
    
     public function esi_return_report_list_6()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'ESI';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "IP Number",
                                "IP Name",
                                "No of Days for which wages paid/payable during the month",
                                "Total Monthly Wages",
                                "Reason Code for Zero workings days",
                                "Last Working Day"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_total_days_from_attendance) as no_of_days",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "mxesi_rsn_code as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
           
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data6_year($data);
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_total_days_from_attendance as no_of_days",
                                    "mxsal_actual_gross as gross_wages",
                                    "'' as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data6($data);                        
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }
        // echo"<pre>";print_r($data);exit;
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist1_6',$data);
        
    }
    
    public function emp_wise_pt_report_m()
    {
        $this->header();
        $data['title']= "Employee Wise PT Report Monthly";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PROFESSIONAL TAX EMP WISE MONTHLY";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/emp_wise_pt_report_m',$data); 
        $this->footer();
    }
	public function emp_wise_pt_report_list_m()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'PT';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "PT NO.",
                                "MONTH / HALF YEAR / YEARLY",
                                "STATE",
                                "DIVISION",
                                "BRANCH",
                                "EMP CODE",
                                "EMP NAME",
                                "AMOUNT"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "group_concat(mxsal_pt_no SEPARATOR ' ') as ptno",
                                    "'YEARLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_pt as pt_amount"
                                );
            
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year_pt_m_h_y($data);
           
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        $total_pt_amount
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_pt_no as ptno",
                                    "'MONTHLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_pt as pt_amount"
                                );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data);                        
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        $total_pt_amount
                                    );
            }
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
	
    public function pf_report2()
    {
        $this->header();
        $data['title']= "PF Form 5";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Form 5";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report2',$data); 
        $this->footer();
    }
    public function pf_report_list2()
    {
        $userdata = $this->input->post();         
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(                               
                                "emp_code",
                                "UAN",
                                "PF",
                                "MEMBER NAME",
                                "Nominee",
                                "DOB",
                                "Gender",
                                "DOJ"
                             );        
            $data['column_names'] = array(
                                    "mxemp_code",
                                    "mxemp_emp_uan_number as uan",
                                    "mxemp_emp_pf_number as pf",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxnominee",
                                    "mxdob",
                                    "mxgender",
                                    "mxdoj"                                    
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            //$data['common'] = $this->export->get_paysheet_data($data); 
$data['common'] = $this->Adminmodel->getemployeedetailstosetsession2($data);			        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
    }
    
    

    public function daily_attendance_report_list(){
        $userdata = $this->input->post();   
        $data['daily_attendance']= $this->export->daily_attendance_details($userdata);
        $this->load->view('reports/excelreports/Daily_Attendance_report_list',$data);
    }

    //  ------------  end added 02-07-2023 ---------
    
    
    // ----------------------- added on 29-11-2022 ------------
    
        
    public function relocation(){
        $relocation= '{"customername":"Raju ","telno":"7893025695","emailid":"gogula.raju13@gmail.com","cp":"Corporate","cpname":"Amazon","originaddress":"Hyderabad, Neredmet, h.no 948 , Vinayak Nagar, 500056","originfloor":"2nd Floor","isliftinorigin":"yes","isshuttleservicerequiredinorigin":"no","destinationaddress":"Delhi, Rangapuri, 201334","destinationfloor":"3rd floor","isliftindestination":"yes","isshuttleservicerequiredindestination":"no","specialinstructions":"yes","packingdt":"10-12-2022","movingdt":"10-12-2022","deliverydt":"14-12-2022","living_sofaseater_qty":"5","living_sofaseater_insu":"20000","living_sofaseater_desc":"3+1+1","living_sofaseater_remarks":"Good Condiation","living_centretable_qty":"1","living_centretable_insu":"2344","living_centretable_desc":"wood","living_centretable_remarks":"Good Condiation","living_bookrack_qty":"1","living_bookrack_insu":"5000","living_bookrack_desc":"wood","living_bookrack_remarks":"good condiation","living_shoerack_qty":"1","living_shoerack_insu":"5000","living_shoerack_desc":"wood","living_shoerack_remarks":"good condiation","living_sideboard_qty":"0","living_sideboard_insu":"0","living_sideboard_desc":"wood","living_sideboard_remarks":"good condiation","living_tvinches_qty":"55","living_tvinches_insu":"60000","living_tvinches_desc":"samsung","living_tvinches_remarks":"good condiation","living_tvcabinet_qty":"1","living_tvcabinet_insu":"20000","living_tvcabinet_desc":"wood","living_tvcabinet_remarks":"good condiation","living_cooler_qty":"1","living_cooler_insu":"10000","living_cooler_desc":"samsung","living_cooler_remarks":"good condaition","living_mirrors_qty":"1","living_mirrors_insu":"1000","living_mirrors_desc":"acd","living_mirrors_remarks":"good ","living_carpet_qty":"2","living_carpet_insu":"2000","living_carpet_desc":"big+small","living_carpet_remarks":"good","living_books_no_of_box_qty":"0","living_books_no_of_box_insu":"0","living_books_no_of_box_desc":"0","living_books_no_of_box_remarks":"0","hall_diningtable_qty":"1","hall_diningtable_insu":"10000","hall_diningtable_desc":"wood","hall_diningtable_remarks":"good condiation","hall_dinningchair_qty":"6","hall_dinningchair_insu":"10000","hall_dinningchair_desc":"wood","hall_dinningchair_remarks":"good","hall_sidetable_qty":"2","hall_sidetable_insu":"10000","hall_sidetable_desc":"wood","hall_sidetable_remarks":"good","hall_table_qty":"1","hall_table_insu":"1000","hall_table_desc":"wood","hall_table_remarks":"good","hall_deewan_qty":"1","hall_deewan_insu":"20000","hall_deewan_desc":"wood","hall_deewan_remarks":"good","hall_chestofdraw_qty":"1","hall_chestofdraw_insu":"2000","hall_chestofdraw_desc":"wood","hall_chestofdraw_remarks":"good","hall_woodenchest_qty":"1","hall_woodenchest_insu":"2000","hall_woodenchest_desc":"wood","hall_woodenchest_remarks":"good","hall_fridgeregular_qty":"1","hall_fridgeregular_insu":"20000","hall_fridgeregular_desc":"samsung","hall_fridgeregular_remarks":"good","hall_fridgelarge_qty":"1","hall_fridgelarge_insu":"40000","hall_fridgelarge_desc":"samsung","hall_fridgelarge_remarks":"good","hall_musicsystem_qty":"1","hall_musicsystem_insu":"30000","hall_musicsystem_desc":"samsung","hall_musicsystem_remarks":"good","hall_hometheatre_qty":"1","hall_hometheatre_insu":"40000","hall_hometheatre_desc":"samsung","hall_hometheatre_remarks":"good","hall_vcr_vcd_dvd_qty":"0","hall_vcr_vcd_dvd_insu":"0","hall_vcr_vcd_dvd_desc":"0","hall_vcr_vcd_dvd_remarks":"0","hall_computer_qty":"1","hall_computer_insu":"40000","hall_computer_desc":"laptop dell","hall_computer_remarks":"0","hall_wallframes_qty":"0","hall_wallframes_insu":"0","hall_wallframes_desc":"0","hall_wallframes_remarks":"0","hall_paintings_qty":"5","hall_paintings_insu":"60000","hall_paintings_desc":"new","hall_paintings_remarks":"good","hall_ironboard_qty":"0","hall_ironboard_insu":"0","hall_ironboard_desc":"0","hall_ironboard_remarks":"0","hall_treadmill_qty":"1","hall_treadmill_insu":"20000","hall_treadmill_desc":"new","hall_treadmill_remarks":"good","hall_cycle_qty":"2","hall_cycle_insu":"20000","hall_cycle_desc":"hero","hall_cycle_remarks":"good","hall_fishtank_qty":"1","hall_fishtank_insu":"5000","hall_fishtank_desc":"new","hall_fishtank_remarks":"good","kitchenroom_microwave_qty":"1","kitchenroom_microwave_insu":"10000","kitchenroom_microwave_desc":"prestage","kitchenroom_microwave_remarks":"no","kitchenroom_otg_qty":"1","kitchenroom_otg_insu":"2000","kitchenroom_otg_desc":"prestage","kitchenroom_otg_remarks":"no","kitchenroom_cookingrange_qty":"2","kitchenroom_cookingrange_insu":"333","kitchenroom_cookingrange_desc":"prestage","kitchenroom_cookingrange_remarks":"no","kitchenroom_gasstove_qty":"2","kitchenroom_gasstove_insu":"5000","kitchenroom_gasstove_desc":"prestage","kitchenroom_gasstove_remarks":"no","kitchenroom_cylinder_qty":"2","kitchenroom_cylinder_insu":"2","kitchenroom_cylinder_desc":"preage","kitchenroom_cylinder_remarks":"NO","kitchenroom_grinder_qty":"1","kitchenroom_grinder_insu":"3000","kitchenroom_grinder_desc":"PRESTAGEQ","kitchenroom_grinder_remarks":"NO","kitchenroom_mixer_qty":"1","kitchenroom_mixer_insu":"4000","kitchenroom_mixer_desc":"PRESATGE","kitchenroom_mixer_remarks":"NO","kitchenroom_waterfilter_qty":"1","kitchenroom_waterfilter_insu":"30000","kitchenroom_waterfilter_desc":"presa","kitchenroom_waterfilter_remarks":"no","kitchenroom_quilt_qty":"0","kitchenroom_quilt_insu":"0","kitchenroom_quilt_desc":"0","kitchenroom_quilt_remarks":"0","kitchenroom_barbeque_qty":"0","kitchenroom_barbeque_insu":"0","kitchenroom_barbeque_desc":"0","kitchenroom_barbeque_remarks":"0","kitchenroom_utensiles_no_of_box_qty":"10","kitchenroom_utensiles_no_of_box_insu":"5000","kitchenroom_utensiles_no_of_box_desc":"GOOD","kitchenroom_utensiles_no_of_box_remarks":"0","kitchenroom_plastic_no_of_box_qty":"5","kitchenroom_plastic_no_of_box_insu":"3000","kitchenroom_plastic_no_of_box_desc":"GOOD","kitchenroom_plastic_no_of_box_remarks":"0","kitchenroom_kitchen_wear_no_of_box_qty":"4","kitchenroom_kitchen_wear_no_of_box_insu":"5000","kitchenroom_kitchen_wear_no_of_box_desc":"GOOD","kitchenroom_kitchen_wear_no_of_box_remarks":"0","masterbedroom_singlecot_qty":"1","masterbedroom_singlecot_insu":"20000","masterbedroom_singlecot_desc":"WOOD","masterbedroom_singlecot_remarks":"NO","masterbedroom_singlemattress_qty":"1","masterbedroom_singlemattress_insu":"10000","masterbedroom_singlemattress_desc":"SLEEPWELL","masterbedroom_singlemattress_remarks":"NO","masterbedroom_doublecot_qty":"1","masterbedroom_doublecot_insu":"20000","masterbedroom_doublecot_desc":"WOOD","masterbedroom_doublecot_remarks":"NO","masterbedroom_doublemattress_qty":"1","masterbedroom_doublemattress_insu":"10000","masterbedroom_doublemattress_desc":"SLEEPWELL","masterbedroom_doublemattress_remarks":"NO","masterbedroom_dressingtable_qty":"1","masterbedroom_dressingtable_insu":"10000","masterbedroom_dressingtable_desc":"WOOD WITH GLASS","masterbedroom_dressingtable_remarks":"NO","masterbedroom_cupboard_qty":"1","masterbedroom_cupboard_insu":"20000","masterbedroom_cupboard_desc":"WOOD","masterbedroom_cupboard_remarks":"NO","masterbedroom_steelalmera_qty":"0","masterbedroom_steelalmera_insu":"0","masterbedroom_steelalmera_desc":"0","masterbedroom_steelalmera_remarks":"0","masterbedroom_windowac_qty":"1","masterbedroom_windowac_insu":"20000","masterbedroom_windowac_desc":"SAMSUNG","masterbedroom_windowac_remarks":"0","masterbedroom_splitac_qty":"1","masterbedroom_splitac_insu":"20000","masterbedroom_splitac_desc":"SASUNG","masterbedroom_splitac_remarks":"0","masterbedroom_suitcases_qty":"1","masterbedroom_suitcases_insu":"2000","masterbedroom_suitcases_desc":"NEW","masterbedroom_suitcases_remarks":"0","masterbedroom_clothes_no_of_box_qty":"10","masterbedroom_clothes_no_of_box_insu":"20000","masterbedroom_clothes_no_of_box_desc":"NEW","masterbedroom_clothes_no_of_box_remarks":"0","masterbedroom_trunks_qty":"1","masterbedroom_trunks_insu":"2000","masterbedroom_trunks_desc":"NEW","masterbedroom_trunks_remarks":"0","masterbedroom_mirrors_qty":"1","masterbedroom_mirrors_insu":"2000","masterbedroom_mirrors_desc":"NEQW","masterbedroom_mirrors_remarks":"GOOD","kidsbedroom_windowac_kids_qty":"0","kidsbedroom_windowac_kids_insu":"0","kidsbedroom_windowac_kids_desc":"0","kidsbedroom_windowac_kids_remarks":"0","kidsbedroom_splitac_kids_qty":"0","kidsbedroom_splitac_kids_insu":"0","kidsbedroom_splitac_kids_desc":"0","kidsbedroom_splitac_kids_remarks":"0","kidsbedroom_baby_carandcycle_qty":"2","kidsbedroom_baby_carandcycle_insu":"10000","kidsbedroom_baby_carandcycle_desc":"HERO","kidsbedroom_baby_carandcycle_remarks":"GOOD","kidsbedroom_kids_clothes_no_of_box_qty":"5","kidsbedroom_kids_clothes_no_of_box_insu":"10000","kidsbedroom_kids_clothes_no_of_box_desc":"GOOD","kidsbedroom_kids_clothes_no_of_box_remarks":"GOOD","kidsbedroom_kids_books_no_of_box_qty":"3","kidsbedroom_kids_books_no_of_box_insu":"1000","kidsbedroom_kids_books_no_of_box_desc":"GOOD","kidsbedroom_kids_books_no_of_box_remarks":"GOOD","kidsbedroom_kids_singlecot_qty":"0","kidsbedroom_kids_singlecot_insu":"0","kidsbedroom_kids_singlecot_desc":"0","kidsbedroom_kids_singlecot_remarks":"00","kidsbedroom_kids_singlemattress_qty":"0","kidsbedroom_kids_singlemattress_insu":"0","kidsbedroom_kids_singlemattress_desc":"0","kidsbedroom_kids_singlemattress_remarks":"0","kidsbedroom_kids_doublecot_qty":"0","kidsbedroom_kids_doublecot_insu":"0","kidsbedroom_kids_doublecot_desc":"0","kidsbedroom_kids_doublecot_remarks":"0","kidsbedroom_doublemattress_qty":"0","kidsbedroom_doublemattress_insu":"0","kidsbedroom_doublemattress_desc":"0","kidsbedroom_doublemattress_remarks":"0","kidsbedroom_kids_pram_qty":"0","kidsbedroom_kids_pram_insu":"0","kidsbedroom_kids_pram_desc":"0","kidsbedroom_kids_pram_remarks":"0","kidsbedroom_kids_mirrors_qty":"0","kidsbedroom_kids_mirrors_insu":"0","kidsbedroom_kids_mirrors_desc":"0","kidsbedroom_kids_mirrors_remarks":"0","common_washingmc_qty":"1","common_washingmc_insu":"40000","common_washingmc_desc":"IFB","common_washingmc_remarks":"NEW","common_dishwasher_qty":"1","common_dishwasher_insu":"20000","common_dishwasher_desc":"IFB","common_dishwasher_remarks":"NEW","common_ex_cycle_qty":"0","common_ex_cycle_insu":"0","common_ex_cycle_desc":"0","common_ex_cycle_remarks":"0","common_ladder_qty":"0","common_ladder_insu":"0","common_ladder_desc":"0","common_ladder_remarks":"00","common_inverter_qty":"1","common_inverter_insu":"20000","common_inverter_desc":"20 LTR","common_inverter_remarks":"GOOD","common_battery_qty":"1","common_battery_insu":"20000","common_battery_desc":"1000 MG WAT","common_battery_remarks":"NEW","others_carton_for_clothes_qty":"10","others_carton_for_clothes_insu":"400000","others_item1_name":"0","others_item1_qty":"0","others_item1_insu":"0","others_item2_name":"0","others_item2_qty":"0","others_item2_insu":"0","others_item1_row_remarks":"0","others_Dish_Antena_qty":"1","others_Dish_Antena_insu":"3000","others_item3_name":"0","others_item3_qty":"0","others_item3_insu":"0","others_item4_name":"0","others_item4_qty":"0","others_item4_insu":"0","others_item2_row_remarks":"","others_Miscellaneous_Box_qty":"10","others_Miscellaneous_Box_insu":"10000","others_item5_name":"0","others_item5_qty":"0","others_item5_insu":"0","others_item6_name":"0","others_item6_qty":"0","others_item6_insu":"0","others_item3_row_remarks":"0","others_Cylinder_qty":"2","others_Cylinder_insu":"7000","others_item7_name":"0","others_item7_qty":"0","others_item7_insu":"0","others_item8_name":"0","others_item8_qty":"0","others_item8_insu":"0","others_item4_row_remarks":"0","others_Geyser_qty":"1","others_Geyser_insu":"8000","others_item9_name":"0","others_item9_qty":"","others_item9_insu":"0","others_item10_name":"0","others_item10_qty":"0","others_item10_insu":"0","others_item5_row_remarks":"0","others_Cloth_Stand_qty":"2","others_Cloth_Stand_insu":"10000","others_item11_name":"0","others_item11_qty":"0","others_item11_insu":"0","others_item12_name":"0","others_item12_qty":"0","others_item12_insu":"0","others_item6_row_remarks":"0","vehicles_Motor_Bike_Scooter_Make_Model_qty":"1","vehicles_Motor_Bike_Scooter_Make_Model_insu":"10000","vehicles_Motor_Bike_Scooter_Make_Model_remarks":"activa","vehicles_CAR_MakeandModel_qty":"i20 ","vehicles_CAR_MakeandModel_insu":"12000","vehicles_CAR_MakeandModel_remarks":"hundai sports","impinfo_Society_Permission_By_Client_Only":"yes","impinfo_Society_Permission_By_Client_Only_remarks":"no","impinfo_Is_there_easy_access_for_loading_and_unloading_at_origin_and_destination":"yes","impinfo_Is_there_easy_access_for_loading_and_unloading_at_origin_and_destination_remarks":"no","impinfo_Are_there_any_time_restrictions_for_loading_unloading_at_origin_or_destination":"yes","impinfo_Are_there_any_time_restrictions_for_loading_unloading_at_origin_or_destination_remarks":"no","impinfo_Distance_from_Lift_to_Vechicle_long":"100 mm","impinfo_Distance_from_Lift_to_Vechicle_long_remarks":"no","impinfo_Are_there_any_items_which_are_difficult_to_handle":"glass","impinfo_Are_there_any_items_which_are_difficult_to_handle_remarks":"no","impinfo_Are_there_any_items_which_are_already_damaged":"no","impinfo_Are_there_any_items_which_are_already_damaged_remarks":"no","impinfo_Should_goods_be_collected_from_more_than_one_location":"yes","impinfo_Should_goods_be_collected_from_more_than_one_location_remarks":"no","impinfo_Should_goods_be_delivered_to_more_than_one_location":"yes","impinfo_Should_goods_be_delivered_to_more_than_one_location_remarks":"no","impinfo_Do_you_require_Storage":"yes","impinfo_Do_you_require_Storage_remarks":"yes ","concerns":"Hi all , ","orderno":"MXREC-29112022172807"}';
        $reloc=json_decode($relocation,true);
        // print_r($reloc['orderno']); exit;
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($reloc['orderno']); // user sheet title name
        $textaligntop = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
            )
         );
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $lstyle = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
        $Rstyle = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        $BStyle = array(
            'borders' => array(
              'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            )
          ); 

        $bottomcolor =  array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '')
                )
            )
        );
        $background_color=array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '#dff0d8')
            )
            );

        $applycolur = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '#dff0d8'),
                  //6F0F6F
                'size'  => 15,
                )
            );

        $font_heading = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 15,
                )
            );
        $highlite = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 12,
                )
            );
            

        //------------------- size declaration of excel columns ------------
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        // $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
        // ------------------- a1  heading of excel first line -----------
        $this->excel->getActiveSheet()->getRowDimension ('1') -> setRowHeight(20);
        $this->excel->getActiveSheet()->getColumnDimension(100)->setWidth(25);

        $this->excel->getActiveSheet()->mergeCells('A1:O1');
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A1','Relocations Request Form');

        //   -------------------------- A2------------------------
        $a1=1;
        $a2=$a1+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a2)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a2.':H'.$a2);
        $this->excel->getActiveSheet()->setCellValue('A'.$a2,'Customer Name ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a2.':O'.$a2);
        $this->excel->getActiveSheet()->setCellValue('I'.$a2,$reloc['customername']);

        //   -------------------------- A3------------------------
        $a3=$a2+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a3)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a3.':H'.$a3);
        $this->excel->getActiveSheet()->setCellValue('A'.$a3,'Phone No');
        $this->excel->getActiveSheet()->getStyle('I'.$a3)->applyFromArray($Rstyle);
        $this->excel->getActiveSheet()->mergeCells('I'.$a3.':O'.$a3);
        $this->excel->getActiveSheet()->setCellValue('I'.$a3,$reloc['telno']);

        //   -------------------------- A4------------------------
        $a4=$a3+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a4)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a4.':H'.$a4);
        $this->excel->getActiveSheet()->setCellValue('A'.$a4,'Email ID ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a4.':O'.$a4);
        $this->excel->getActiveSheet()->setCellValue('I'.$a4,$reloc['emailid']);

        //   -------------------------- A5------------------------
        $a5=$a4+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a5)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a5.':H'.$a5);
        $this->excel->getActiveSheet()->setCellValue('A'.$a5,'Corporate/Private ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a5.':O'.$a5);
        $this->excel->getActiveSheet()->setCellValue('I'.$a5,$reloc['cp']);
        
        //   ------------------ condition based dropdown -----------
        if($reloc['cp'] == 'Corporate'){
            $seldp=$a5+1;
            $a6=$a5+1;
            $this->excel->getActiveSheet()->getStyle('A'.$seldp)->applyFromArray($highlite);
            $this->excel->getActiveSheet()->mergeCells('A'.$seldp.':C'.$seldp);
            $this->excel->getActiveSheet()->setCellValue('A'.$seldp,'Corporate Name	 ');
            $this->excel->getActiveSheet()->mergeCells('D'.$seldp.':O'.$seldp);
            $this->excel->getActiveSheet()->setCellValue('D'.$seldp,$reloc['cpname']);
        }else{
            $a6=$a5+1;
        }
        //   ------------------ end condition based dropdown -----------

        //   -------------------------- A6------------------------
        $aorigin6=$a6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$aorigin6.':H'.$aorigin6);
        $this->excel->getActiveSheet()->getStyle('A'.$aorigin6)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->setCellValue('A'.$aorigin6,'Origin Address ');
        $this->excel->getActiveSheet()->mergeCells('I'.$aorigin6.':O'.$aorigin6);
        $this->excel->getActiveSheet()->setCellValue('I'.$aorigin6,$reloc['originaddress']);

        //   -------------------------- A7------------------------
        $a7=$aorigin6+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a7)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a7.':H'.$a7);
        $this->excel->getActiveSheet()->setCellValue('A'.$a7,'Origin Floor ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a7.':O'.$a7);
        $this->excel->getActiveSheet()->setCellValue('I'.$a7,$reloc['originfloor']);

        //   -------------------------- A8------------------------
        $a8=$a7+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a8)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a8.':H'.$a8);
        $this->excel->getActiveSheet()->setCellValue('A'.$a8,'Is Lift Available at Origin');
        $this->excel->getActiveSheet()->mergeCells('I'.$a8.':O'.$a8);
        $this->excel->getActiveSheet()->setCellValue('I'.$a8,$reloc['isliftinorigin']);

        //   -------------------------- A9------------------------
        $a9=$a8+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a9)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a9.':H'.$a9);
        $this->excel->getActiveSheet()->setCellValue('A'.$a9,'Is Shuttle Service is required at Origin	');
        $this->excel->getActiveSheet()->mergeCells('I'.$a9.':O'.$a9);
        $this->excel->getActiveSheet()->setCellValue('I'.$a9,$reloc['isshuttleservicerequiredinorigin']);

        //   -------------------------- A10------------------------
        $a10=$a9+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a10)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a10.':H'.$a10);
        $this->excel->getActiveSheet()->setCellValue('A'.$a10,'Destination Address');
        $this->excel->getActiveSheet()->mergeCells('I'.$a10.':O'.$a10);
        $this->excel->getActiveSheet()->setCellValue('I'.$a10,$reloc['destinationaddress']);

        //   -------------------------- A11------------------------
        $a11=$a10+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a11)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a11.':H'.$a11);
        $this->excel->getActiveSheet()->setCellValue('A'.$a11,'Destination Floor ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a11.':O'.$a11);
        $this->excel->getActiveSheet()->setCellValue('I'.$a11,$reloc['destinationfloor']);

        //   -------------------------- A12 ------------------------
        $a12=$a11+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a12)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a12.':H'.$a12);
        $this->excel->getActiveSheet()->setCellValue('A'.$a12,'Is Lift Available at Destination ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a12.':O'.$a12);
        $this->excel->getActiveSheet()->setCellValue('I'.$a12,$reloc['isliftindestination']);

        //   -------------------------- A13 ------------------------
        $a13=$a12+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a13)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a13.':H'.$a13);
        $this->excel->getActiveSheet()->setCellValue('A'.$a13,'Is Shuttle Service is required at Destination ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a13.':O'.$a13);
        $this->excel->getActiveSheet()->setCellValue('I'.$a13,$reloc['isshuttleservicerequiredindestination']);

        //   -------------------------- A14 ------------------------
        $a14=$a13+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a14)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a14.':H'.$a14);
        $this->excel->getActiveSheet()->setCellValue('A'.$a14,'Special Instructions for Handy Men Services ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a14.':O'.$a14);
        $this->excel->getActiveSheet()->setCellValue('I'.$a14,$reloc['specialinstructions']);

        //   -------------------------- A15 ------------------------
        $a15=$a14+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a15)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a15.':H'.$a15);
        $this->excel->getActiveSheet()->setCellValue('A'.$a15,'Preferred Date of Packing  ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a15.':O'.$a15);
        $this->excel->getActiveSheet()->setCellValue('I'.$a15,$reloc['packingdt']);

        //   -------------------------- A16 ------------------------
        $a16=$a15+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a16)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a16.':H'.$a16);
        $this->excel->getActiveSheet()->setCellValue('A'.$a16,'Preferred Date of Moving ');
        $this->excel->getActiveSheet()->mergeCells('I'.$a16.':O'.$a16);
        $this->excel->getActiveSheet()->setCellValue('I'.$a16,$reloc['movingdt']);

        //   -------------------------- A17 ------------------------
        $a17=$a16+1;
        $this->excel->getActiveSheet()->getStyle('A'.$a17)->applyFromArray($highlite);
        $this->excel->getActiveSheet()->mergeCells('A'.$a17.':H'.$a17);
        $this->excel->getActiveSheet()->setCellValue('A'.$a17,'Preferred Date of Delivery	');
        $this->excel->getActiveSheet()->mergeCells('I'.$a17.':O'.$a17);
        $this->excel->getActiveSheet()->setCellValue('I'.$a17,$reloc['deliverydt']); 

        // -------------------  Living Room ----------------------
        $l1=$a17+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$l1.':O'.$l1);
        $this->excel->getActiveSheet()->getStyle('A'.$l1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$l1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$l1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$l1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$l1,'Living Room Articles to be Moved  ');

        // -------------------------  $l2 --------------------
        $l2=$l1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$l2.':C'.$l2);
        $this->excel->getActiveSheet()->getStyle('A'.$l2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$l2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$l2.':F'.$l2);
        $this->excel->getActiveSheet()->getStyle('D'.$l2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$l2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$l2.':I'.$l2);
        $this->excel->getActiveSheet()->getStyle('G'.$l2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$l2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$l2.':L'.$l2);
        $this->excel->getActiveSheet()->getStyle('J'.$l2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$l2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$l2.':O'.$l2);
        $this->excel->getActiveSheet()->getStyle('M'.$l2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$l2, 'Remark (damage if any)');

        // -------------------------  $l3 --------------------
        $l3=$l2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l3.':C'.$l3);
        $this->excel->getActiveSheet()->setCellValue('A'.$l3, 'Sofa: Seater	');
        $this->excel->getActiveSheet()->mergeCells('D'.$l3.':F'.$l3);
        $this->excel->getActiveSheet()->setCellValue('D'.$l3, $reloc['living_sofaseater_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l3.':I'.$l3);
        $this->excel->getActiveSheet()->setCellValue('G'.$l3, $reloc['living_sofaseater_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l3.':L'.$l3);
        $this->excel->getActiveSheet()->setCellValue('J'.$l3, $reloc['living_sofaseater_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l3.':O'.$l3);
        $this->excel->getActiveSheet()->setCellValue('M'.$l3, $reloc['living_sofaseater_remarks']);

        // -------------------------  $l4 --------------------
        $l4=$l3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l4.':C'.$l4);
        $this->excel->getActiveSheet()->setCellValue('A'.$l4, 'Centre Table	');
        $this->excel->getActiveSheet()->mergeCells('D'.$l4.':F'.$l4);
        $this->excel->getActiveSheet()->setCellValue('D'.$l4, $reloc['living_centretable_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l4.':I'.$l4);
        $this->excel->getActiveSheet()->setCellValue('G'.$l4, $reloc['living_centretable_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l4.':L'.$l4);
        $this->excel->getActiveSheet()->setCellValue('J'.$l4, $reloc['living_centretable_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l4.':O'.$l4);
        $this->excel->getActiveSheet()->setCellValue('M'.$l4, $reloc['living_centretable_remarks']);

        // -------------------------  $l5 --------------------
        $l5=$l4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l5.':C'.$l5);
        $this->excel->getActiveSheet()->setCellValue('A'.$l5, 'Book Rack ');
        $this->excel->getActiveSheet()->mergeCells('D'.$l5.':F'.$l5);
        $this->excel->getActiveSheet()->setCellValue('D'.$l5, $reloc['living_bookrack_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l5.':I'.$l5);
        $this->excel->getActiveSheet()->setCellValue('G'.$l5, $reloc['living_bookrack_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l5.':L'.$l5);
        $this->excel->getActiveSheet()->setCellValue('J'.$l5, $reloc['living_bookrack_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l5.':O'.$l5);
        $this->excel->getActiveSheet()->setCellValue('M'.$l5, $reloc['living_bookrack_remarks']);

        // -------------------------  $l6 --------------------
        $l6=$l5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l6.':C'.$l6);
        $this->excel->getActiveSheet()->setCellValue('A'.$l6, 'Shoe Rack');
        $this->excel->getActiveSheet()->mergeCells('D'.$l6.':F'.$l6);
        $this->excel->getActiveSheet()->setCellValue('D'.$l6, $reloc['living_shoerack_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l6.':I'.$l6);
        $this->excel->getActiveSheet()->setCellValue('G'.$l6, $reloc['living_shoerack_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l6.':L'.$l6);
        $this->excel->getActiveSheet()->setCellValue('J'.$l6, $reloc['living_shoerack_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l6.':O'.$l6);
        $this->excel->getActiveSheet()->setCellValue('M'.$l6, $reloc['living_shoerack_remarks']);

        // -------------------------  $l7 --------------------
        $l7=$l6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l7.':C'.$l7);
        $this->excel->getActiveSheet()->setCellValue('A'.$l7, 'Side Board ');
        $this->excel->getActiveSheet()->mergeCells('D'.$l7.':F'.$l7);
        $this->excel->getActiveSheet()->setCellValue('D'.$l7, $reloc['living_sideboard_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l7.':I'.$l7);
        $this->excel->getActiveSheet()->setCellValue('G'.$l7, $reloc['living_sideboard_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l7.':L'.$l7);
        $this->excel->getActiveSheet()->setCellValue('J'.$l7, $reloc['living_sideboard_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l7.':O'.$l7);
        $this->excel->getActiveSheet()->setCellValue('M'.$l7, $reloc['living_sideboard_remarks']);

        // -------------------------  $l8 --------------------

        $l8=$l7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l8.':C'.$l8);
        $this->excel->getActiveSheet()->setCellValue('A'.$l8, 'Tv(Inches 24",32"48"...)');
        $this->excel->getActiveSheet()->mergeCells('D'.$l8.':F'.$l8);
        $this->excel->getActiveSheet()->setCellValue('D'.$l8, $reloc['living_tvinches_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l8.':I'.$l8);
        $this->excel->getActiveSheet()->setCellValue('G'.$l8, $reloc['living_tvinches_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l8.':L'.$l8);
        $this->excel->getActiveSheet()->setCellValue('J'.$l8, $reloc['living_tvinches_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l8.':O'.$l8);
        $this->excel->getActiveSheet()->setCellValue('M'.$l8, $reloc['living_tvinches_remarks']);
        
        // -------------------------  $l9 --------------------
        $l9=$l8+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l9.':C'.$l9);
        $this->excel->getActiveSheet()->setCellValue('A'.$l9, 'TV Cabinet');
        $this->excel->getActiveSheet()->mergeCells('D'.$l9.':F'.$l9);
        $this->excel->getActiveSheet()->setCellValue('D'.$l9, $reloc['living_tvcabinet_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l9.':I'.$l9);
        $this->excel->getActiveSheet()->setCellValue('G'.$l9, $reloc['living_tvcabinet_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l9.':L'.$l9);
        $this->excel->getActiveSheet()->setCellValue('J'.$l9, $reloc['living_tvcabinet_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l9.':O'.$l9);
        $this->excel->getActiveSheet()->setCellValue('M'.$l9, $reloc['living_tvcabinet_remarks']);
        
        // -------------------------  $l20 --------------------
        $l20=$l9+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l20.':C'.$l20);
        $this->excel->getActiveSheet()->setCellValue('A'.$l20, 'Cooler');
        $this->excel->getActiveSheet()->mergeCells('D'.$l20.':F'.$l20);
        $this->excel->getActiveSheet()->setCellValue('D'.$l20, $reloc['living_cooler_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l20.':I'.$l20);
        $this->excel->getActiveSheet()->setCellValue('G'.$l20, $reloc['living_cooler_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l20.':L'.$l20);
        $this->excel->getActiveSheet()->setCellValue('J'.$l20, $reloc['living_cooler_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l20.':O'.$l20);
        $this->excel->getActiveSheet()->setCellValue('M'.$l20, $reloc['living_cooler_remarks']);
   
        // -------------------------  $l21 --------------------
        $l21=$l20+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l21.':C'.$l21);
        $this->excel->getActiveSheet()->setCellValue('A'.$l21, 'Mirrors');
        $this->excel->getActiveSheet()->mergeCells('D'.$l21.':F'.$l21);
        $this->excel->getActiveSheet()->setCellValue('D'.$l21, $reloc['living_mirrors_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l21.':I'.$l21);
        $this->excel->getActiveSheet()->setCellValue('G'.$l21, $reloc['living_mirrors_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l21.':L'.$l21);
        $this->excel->getActiveSheet()->setCellValue('J'.$l21, $reloc['living_mirrors_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l21.':O'.$l21);
        $this->excel->getActiveSheet()->setCellValue('M'.$l21, $reloc['living_mirrors_remarks']);
        
        // -------------------------  $l22 --------------------
        $l22=$l21+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l22.':C'.$l22);
        $this->excel->getActiveSheet()->setCellValue('A'.$l22, 'Carpet');
        $this->excel->getActiveSheet()->mergeCells('D'.$l22.':F'.$l22);
        $this->excel->getActiveSheet()->setCellValue('D'.$l22, $reloc['living_carpet_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l22.':I'.$l22);
        $this->excel->getActiveSheet()->setCellValue('G'.$l22, $reloc['living_carpet_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l22.':L'.$l22);
        $this->excel->getActiveSheet()->setCellValue('J'.$l22, $reloc['living_carpet_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l22.':O'.$l22);
        $this->excel->getActiveSheet()->setCellValue('M'.$l22, $reloc['living_carpet_remarks']);

        // -------------------------  $l23 --------------------
        $l23=$l22+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$l23.':C'.$l23);
        $this->excel->getActiveSheet()->setCellValue('A'.$l23, 'Books (No Of Boxes)	');
        $this->excel->getActiveSheet()->mergeCells('D'.$l23.':F'.$l23);
        $this->excel->getActiveSheet()->setCellValue('D'.$l23, $reloc['living_books_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$l23.':I'.$l23);
        $this->excel->getActiveSheet()->setCellValue('G'.$l23, $reloc['living_books_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$l23.':L'.$l23);
        $this->excel->getActiveSheet()->setCellValue('J'.$l23, $reloc['living_books_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$l23.':O'.$l23);
        $this->excel->getActiveSheet()->setCellValue('M'.$l23, $reloc['living_books_no_of_box_remarks']);
        
        // -------------------- Hall Articles to be Moved -------------------

        $h1=$l23+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$h1.':O'.$h1);
        $this->excel->getActiveSheet()->getStyle('A'.$h1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$h1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$h1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$h1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$h1,'Hall Articles to be Moved ');

        // -------------------------  $h2 --------------------
        $h2=$h1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$h2.':C'.$h2);
        $this->excel->getActiveSheet()->getStyle('A'.$h2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$h2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$h2.':F'.$h2);
        $this->excel->getActiveSheet()->getStyle('D'.$h2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$h2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$h2.':I'.$h2);
        $this->excel->getActiveSheet()->getStyle('G'.$h2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$h2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$h2.':L'.$h2);
        $this->excel->getActiveSheet()->getStyle('J'.$h2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$h2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$h2.':O'.$h2);
        $this->excel->getActiveSheet()->getStyle('M'.$h2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$h2, 'Remark (damage if any)');

        // -------------------------  $h3 --------------------
        $h3=$h2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$h3.':C'.$h3);
        $this->excel->getActiveSheet()->setCellValue('A'.$h3, 'Dining Table	');
        $this->excel->getActiveSheet()->mergeCells('D'.$h3.':F'.$h3);
        $this->excel->getActiveSheet()->setCellValue('D'.$h3, $reloc['hall_diningtable_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$h3.':I'.$h3);
        $this->excel->getActiveSheet()->setCellValue('G'.$h3, $reloc['hall_diningtable_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$h3.':L'.$h3);
        $this->excel->getActiveSheet()->setCellValue('J'.$h3, $reloc['hall_diningtable_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$h3.':O'.$h3);
        $this->excel->getActiveSheet()->setCellValue('M'.$h3, $reloc['hall_diningtable_remarks']);

        // --------------------------- h4 -----------------------
        $h4=$h3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$h4.':C'.$h4);
        $this->excel->getActiveSheet()->setCellValue('A'.$h4, 'Dinning Chair');
        $this->excel->getActiveSheet()->mergeCells('D'.$h4.':F'.$h4);
        $this->excel->getActiveSheet()->setCellValue('D'.$h4, $reloc['hall_dinningchair_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$h4.':I'.$h4);
        $this->excel->getActiveSheet()->setCellValue('G'.$h4, $reloc['hall_dinningchair_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$h4.':L'.$h4);
        $this->excel->getActiveSheet()->setCellValue('J'.$h4, $reloc['hall_dinningchair_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$h4.':O'.$h4);
        $this->excel->getActiveSheet()->setCellValue('M'.$h4, $reloc['hall_dinningchair_remarks']);

        // --------------------------- h5 -----------------------
        $h5=$h4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$h5.':C'.$h5);
        $this->excel->getActiveSheet()->setCellValue('A'.$h5, 'Side Table');
        $this->excel->getActiveSheet()->mergeCells('D'.$h5.':F'.$h5);
        $this->excel->getActiveSheet()->setCellValue('D'.$h5, $reloc['hall_sidetable_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$h5.':I'.$h5);
        $this->excel->getActiveSheet()->setCellValue('G'.$h5, $reloc['hall_sidetable_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$h5.':L'.$h5);
        $this->excel->getActiveSheet()->setCellValue('J'.$h5, $reloc['hall_sidetable_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$h5.':O'.$h5);
        $this->excel->getActiveSheet()->setCellValue('M'.$h5, $reloc['hall_sidetable_remarks']);

        // --------------------------- h6 ------------------------
        $h6=$h5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$h6.':C'.$h6);
        $this->excel->getActiveSheet()->setCellValue('A'.$h6, 'Table');
        $this->excel->getActiveSheet()->mergeCells('D'.$h6.':F'.$h6);
        $this->excel->getActiveSheet()->setCellValue('D'.$h6, $reloc['hall_table_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$h6.':I'.$h6);
        $this->excel->getActiveSheet()->setCellValue('G'.$h6, $reloc['hall_table_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$h6.':L'.$h6);
        $this->excel->getActiveSheet()->setCellValue('J'.$h6, $reloc['hall_table_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$h6.':O'.$h6);
        $this->excel->getActiveSheet()->setCellValue('M'.$h6, $reloc['hall_table_remarks']);

        // --------------------------- h7 ------------------------
        $h7=$h6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$h7.':C'.$h7);
        $this->excel->getActiveSheet()->setCellValue('A'.$h7, 'Deewan');
        $this->excel->getActiveSheet()->mergeCells('D'.$h7.':F'.$h7);
        $this->excel->getActiveSheet()->setCellValue('D'.$h7, $reloc['hall_deewan_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$h7.':I'.$h7);
        $this->excel->getActiveSheet()->setCellValue('G'.$h7, $reloc['hall_deewan_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$h7.':L'.$h7);
        $this->excel->getActiveSheet()->setCellValue('J'.$h7, $reloc['hall_deewan_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$h7.':O'.$h7);
        $this->excel->getActiveSheet()->setCellValue('M'.$h7, $reloc['hall_deewan_remarks']);
        
       // --------------------------- h8 ------------------------
       $h8=$h7+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h8.':C'.$h8);
       $this->excel->getActiveSheet()->setCellValue('A'.$h8, 'Chest of Draw	');
       $this->excel->getActiveSheet()->mergeCells('D'.$h8.':F'.$h8);
       $this->excel->getActiveSheet()->setCellValue('D'.$h8, $reloc['hall_chestofdraw_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h8.':I'.$h8);
       $this->excel->getActiveSheet()->setCellValue('G'.$h8, $reloc['hall_chestofdraw_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h8.':L'.$h8);
       $this->excel->getActiveSheet()->setCellValue('J'.$h8, $reloc['hall_chestofdraw_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h8.':O'.$h8);
       $this->excel->getActiveSheet()->setCellValue('M'.$h8, $reloc['hall_deewan_remarks']);
       
       // --------------------------- h9 ------------------------
       $h9=$h8+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h9.':C'.$h9);
       $this->excel->getActiveSheet()->setCellValue('A'.$h9, 'Wooden Chest ');
       $this->excel->getActiveSheet()->mergeCells('D'.$h9.':F'.$h9);
       $this->excel->getActiveSheet()->setCellValue('D'.$h9, $reloc['hall_woodenchest_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h9.':I'.$h9);
       $this->excel->getActiveSheet()->setCellValue('G'.$h9, $reloc['hall_woodenchest_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h9.':L'.$h9);
       $this->excel->getActiveSheet()->setCellValue('J'.$h9, $reloc['hall_woodenchest_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h9.':O'.$h9);
       $this->excel->getActiveSheet()->setCellValue('M'.$h9, $reloc['hall_woodenchest_remarks']);
       
       // --------------------------- h10 ------------------------
       $h10=$h9+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h10.':C'.$h10);
       $this->excel->getActiveSheet()->setCellValue('A'.$h10, 'Fridge - Regular ');
       $this->excel->getActiveSheet()->mergeCells('D'.$h10.':F'.$h10);
       $this->excel->getActiveSheet()->setCellValue('D'.$h10, $reloc['hall_fridgeregular_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h10.':I'.$h10);
       $this->excel->getActiveSheet()->setCellValue('G'.$h10, $reloc['hall_fridgeregular_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h10.':L'.$h10);
       $this->excel->getActiveSheet()->setCellValue('J'.$h10, $reloc['hall_fridgeregular_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h10.':O'.$h10);
       $this->excel->getActiveSheet()->setCellValue('M'.$h10, $reloc['hall_fridgeregular_remarks']);
       
       // --------------------------- h11 ------------------------
       $h11=$h10+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h11.':C'.$h11);
       $this->excel->getActiveSheet()->setCellValue('A'.$h11, 'Fridge - Large');
       $this->excel->getActiveSheet()->mergeCells('D'.$h11.':F'.$h11);
       $this->excel->getActiveSheet()->setCellValue('D'.$h11, $reloc['hall_fridgelarge_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h11.':I'.$h11);
       $this->excel->getActiveSheet()->setCellValue('G'.$h11, $reloc['hall_fridgelarge_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h11.':L'.$h11);
       $this->excel->getActiveSheet()->setCellValue('J'.$h11, $reloc['hall_fridgelarge_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h11.':O'.$h11);
       $this->excel->getActiveSheet()->setCellValue('M'.$h11, $reloc['hall_fridgelarge_remarks']);
       
       // --------------------------- h12 ------------------------
       $h12=$h11+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h12.':C'.$h12);
       $this->excel->getActiveSheet()->setCellValue('A'.$h12, 'Music System');
       $this->excel->getActiveSheet()->mergeCells('D'.$h12.':F'.$h12);
       $this->excel->getActiveSheet()->setCellValue('D'.$h12, $reloc['hall_musicsystem_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h12.':I'.$h12);
       $this->excel->getActiveSheet()->setCellValue('G'.$h12, $reloc['hall_musicsystem_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h12.':L'.$h12);
       $this->excel->getActiveSheet()->setCellValue('J'.$h12, $reloc['hall_musicsystem_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h12.':O'.$h12);
       $this->excel->getActiveSheet()->setCellValue('M'.$h12, $reloc['hall_musicsystem_remarks']);

       // --------------------------- h13 ------------------------
       $h13=$h12+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h13.':C'.$h13);
       $this->excel->getActiveSheet()->setCellValue('A'.$h13, 'Home Theatre');
       $this->excel->getActiveSheet()->mergeCells('D'.$h13.':F'.$h13);
       $this->excel->getActiveSheet()->setCellValue('D'.$h13, $reloc['hall_hometheatre_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h13.':I'.$h13);
       $this->excel->getActiveSheet()->setCellValue('G'.$h13, $reloc['hall_hometheatre_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h13.':L'.$h13);
       $this->excel->getActiveSheet()->setCellValue('J'.$h13, $reloc['hall_hometheatre_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h13.':O'.$h13);
       $this->excel->getActiveSheet()->setCellValue('M'.$h13, $reloc['hall_hometheatre_remarks']);

       // --------------------------- h14 ------------------------
       $h14=$h13+1;
       $this->excel->getActiveSheet()->mergeCells('A'.$h14.':C'.$h14);
       $this->excel->getActiveSheet()->setCellValue('A'.$h14, 'VCR/VCD/DVD	');
       $this->excel->getActiveSheet()->mergeCells('D'.$h14.':F'.$h14);
       $this->excel->getActiveSheet()->setCellValue('D'.$h14, $reloc['hall_vcr_vcd_dvd_qty']);
       $this->excel->getActiveSheet()->mergeCells('G'.$h14.':I'.$h14);
       $this->excel->getActiveSheet()->setCellValue('G'.$h14, $reloc['hall_vcr_vcd_dvd_insu']);
       $this->excel->getActiveSheet()->mergeCells('J'.$h14.':L'.$h14);
       $this->excel->getActiveSheet()->setCellValue('J'.$h14, $reloc['hall_vcr_vcd_dvd_desc']);
       $this->excel->getActiveSheet()->mergeCells('M'.$h14.':O'.$h14);
       $this->excel->getActiveSheet()->setCellValue('M'.$h14, $reloc['hall_vcr_vcd_dvd_remarks']);
       
      // --------------------------- h15 ------------------------
      $h15=$h14+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h15.':C'.$h15);
      $this->excel->getActiveSheet()->setCellValue('A'.$h15, 'Computer');
      $this->excel->getActiveSheet()->mergeCells('D'.$h15.':F'.$h15);
      $this->excel->getActiveSheet()->setCellValue('D'.$h15, $reloc['hall_computer_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h15.':I'.$h15);
      $this->excel->getActiveSheet()->setCellValue('G'.$h15, $reloc['hall_computer_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h15.':L'.$h15);
      $this->excel->getActiveSheet()->setCellValue('J'.$h15, $reloc['hall_computer_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h15.':O'.$h15);
      $this->excel->getActiveSheet()->setCellValue('M'.$h15, $reloc['hall_computer_remarks']);
      
      // --------------------------- h16 ------------------------
      $h16=$h15+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h16.':C'.$h16);
      $this->excel->getActiveSheet()->setCellValue('A'.$h16, 'Wall frames	');
      $this->excel->getActiveSheet()->mergeCells('D'.$h16.':F'.$h16);
      $this->excel->getActiveSheet()->setCellValue('D'.$h16, $reloc['hall_wallframes_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h16.':I'.$h16);
      $this->excel->getActiveSheet()->setCellValue('G'.$h16, $reloc['hall_wallframes_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h16.':L'.$h16);
      $this->excel->getActiveSheet()->setCellValue('J'.$h16, $reloc['hall_wallframes_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h16.':O'.$h16);
      $this->excel->getActiveSheet()->setCellValue('M'.$h16, $reloc['hall_wallframes_remarks']);
     
      // --------------------------- h17 ------------------------
      $h17=$h16+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h17.':C'.$h17);
      $this->excel->getActiveSheet()->setCellValue('A'.$h17, 'Paintings');
      $this->excel->getActiveSheet()->mergeCells('D'.$h17.':F'.$h17);
      $this->excel->getActiveSheet()->setCellValue('D'.$h17, $reloc['hall_paintings_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h17.':I'.$h17);
      $this->excel->getActiveSheet()->setCellValue('G'.$h17, $reloc['hall_paintings_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h17.':L'.$h17);
      $this->excel->getActiveSheet()->setCellValue('J'.$h17, $reloc['hall_paintings_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h17.':O'.$h17);
      $this->excel->getActiveSheet()->setCellValue('M'.$h17, $reloc['hall_paintings_remarks']);
      
      // --------------------------- h18 ------------------------
      $h18=$h17+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h18.':C'.$h18);
      $this->excel->getActiveSheet()->setCellValue('A'.$h18, 'Iron Board');
      $this->excel->getActiveSheet()->mergeCells('D'.$h18.':F'.$h18);
      $this->excel->getActiveSheet()->setCellValue('D'.$h18, $reloc['hall_ironboard_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h18.':I'.$h18);
      $this->excel->getActiveSheet()->setCellValue('G'.$h18, $reloc['hall_ironboard_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h18.':L'.$h18);
      $this->excel->getActiveSheet()->setCellValue('J'.$h18, $reloc['hall_ironboard_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h18.':O'.$h18);
      $this->excel->getActiveSheet()->setCellValue('M'.$h18, $reloc['hall_ironboard_remarks']);
      
      // --------------------------- h19 ------------------------
      $h19=$h18+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h19.':C'.$h19);
      $this->excel->getActiveSheet()->setCellValue('A'.$h19, 'Tread Mill');
      $this->excel->getActiveSheet()->mergeCells('D'.$h19.':F'.$h19);
      $this->excel->getActiveSheet()->setCellValue('D'.$h19, $reloc['hall_treadmill_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h19.':I'.$h19);
      $this->excel->getActiveSheet()->setCellValue('G'.$h19, $reloc['hall_treadmill_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h19.':L'.$h19);
      $this->excel->getActiveSheet()->setCellValue('J'.$h19, $reloc['hall_treadmill_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h19.':O'.$h19);
      $this->excel->getActiveSheet()->setCellValue('M'.$h19, $reloc['hall_treadmill_remarks']);
      
      // --------------------------- h20 ------------------------
      $h20=$h19+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h20.':C'.$h20);
      $this->excel->getActiveSheet()->setCellValue('A'.$h20, 'Cycle');
      $this->excel->getActiveSheet()->mergeCells('D'.$h20.':F'.$h20);
      $this->excel->getActiveSheet()->setCellValue('D'.$h20, $reloc['hall_cycle_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h20.':I'.$h20);
      $this->excel->getActiveSheet()->setCellValue('G'.$h20, $reloc['hall_cycle_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h20.':L'.$h20);
      $this->excel->getActiveSheet()->setCellValue('J'.$h20, $reloc['hall_cycle_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h20.':O'.$h20);
      $this->excel->getActiveSheet()->setCellValue('M'.$h20, $reloc['hall_cycle_remarks']);
      
      // --------------------------- h21 ------------------------
      $h21=$h20+1;
      $this->excel->getActiveSheet()->mergeCells('A'.$h21.':C'.$h21);
      $this->excel->getActiveSheet()->setCellValue('A'.$h21, 'Fish Tank	');
      $this->excel->getActiveSheet()->mergeCells('D'.$h21.':F'.$h21);
      $this->excel->getActiveSheet()->setCellValue('D'.$h21, $reloc['hall_fishtank_qty']);
      $this->excel->getActiveSheet()->mergeCells('G'.$h21.':I'.$h21);
      $this->excel->getActiveSheet()->setCellValue('G'.$h21, $reloc['hall_fishtank_insu']);
      $this->excel->getActiveSheet()->mergeCells('J'.$h21.':L'.$h21);
      $this->excel->getActiveSheet()->setCellValue('J'.$h21, $reloc['hall_fishtank_desc']);
      $this->excel->getActiveSheet()->mergeCells('M'.$h21.':O'.$h21);
      $this->excel->getActiveSheet()->setCellValue('M'.$h21, $reloc['hall_fishtank_remarks']);
      
        // -------------------- Kitchen Articles to be Moved -------------------

        $k1=$h21+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$k1.':O'.$k1);
        $this->excel->getActiveSheet()->getStyle('A'.$k1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$k1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$k1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$k1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$k1,'Kitchen Articles to be Moved ');

        // -------------------------  $k2 --------------------
        $k2=$k1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$k2.':C'.$k2);
        $this->excel->getActiveSheet()->getStyle('A'.$k2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$k2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$k2.':F'.$k2);
        $this->excel->getActiveSheet()->getStyle('D'.$k2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$k2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$k2.':I'.$k2);
        $this->excel->getActiveSheet()->getStyle('G'.$k2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$k2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$k2.':L'.$k2);
        $this->excel->getActiveSheet()->getStyle('J'.$k2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$k2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$k2.':O'.$k2);
        $this->excel->getActiveSheet()->getStyle('M'.$k2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$k2, 'Remark (damage if any)');

        // -------------------------  $k3 --------------------
        $k3=$k2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k3.':C'.$k3);
        $this->excel->getActiveSheet()->setCellValue('A'.$k3, 'Microwave');
        $this->excel->getActiveSheet()->mergeCells('D'.$k3.':F'.$k3);
        $this->excel->getActiveSheet()->setCellValue('D'.$k3, $reloc['kitchenroom_microwave_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k3.':I'.$k3);
        $this->excel->getActiveSheet()->setCellValue('G'.$k3, $reloc['kitchenroom_microwave_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k3.':L'.$k3);
        $this->excel->getActiveSheet()->setCellValue('J'.$k3, $reloc['kitchenroom_microwave_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k3.':O'.$k3);
        $this->excel->getActiveSheet()->setCellValue('M'.$k3, $reloc['kitchenroom_microwave_remarks']);
        
        // -------------------------  $k4 --------------------
        $k4=$k3+1;
        
        $this->excel->getActiveSheet()->mergeCells('A'.$k4.':C'.$k4);
        $this->excel->getActiveSheet()->setCellValue('A'.$k4, 'OTG');
        $this->excel->getActiveSheet()->mergeCells('D'.$k4.':F'.$k4);
        $this->excel->getActiveSheet()->setCellValue('D'.$k4, $reloc['kitchenroom_otg_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k4.':I'.$k4);
        $this->excel->getActiveSheet()->setCellValue('G'.$k4, $reloc['kitchenroom_otg_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k4.':L'.$k4);
        $this->excel->getActiveSheet()->setCellValue('J'.$k4, $reloc['kitchenroom_otg_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k4.':O'.$k4);
        $this->excel->getActiveSheet()->setCellValue('M'.$k4, $reloc['kitchenroom_otg_remarks']);
        
        // -------------------------  $k5 --------------------
        $k5=$k4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k5.':C'.$k5);
        $this->excel->getActiveSheet()->setCellValue('A'.$k5, 'Cooking Range');
        $this->excel->getActiveSheet()->mergeCells('D'.$k5.':F'.$k5);
        $this->excel->getActiveSheet()->setCellValue('D'.$k5, $reloc['kitchenroom_cookingrange_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k5.':I'.$k5);
        $this->excel->getActiveSheet()->setCellValue('G'.$k5, $reloc['kitchenroom_cookingrange_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k5.':L'.$k5);
        $this->excel->getActiveSheet()->setCellValue('J'.$k5, $reloc['kitchenroom_cookingrange_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k5.':O'.$k5);
        $this->excel->getActiveSheet()->setCellValue('M'.$k5, $reloc['kitchenroom_cookingrange_remarks']);
            
        // -------------------------  $k6 --------------------
        $k6=$k5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k6.':C'.$k6);
        $this->excel->getActiveSheet()->setCellValue('A'.$k6, 'Gas Stove');
        $this->excel->getActiveSheet()->mergeCells('D'.$k6.':F'.$k6);
        $this->excel->getActiveSheet()->setCellValue('D'.$k6, $reloc['kitchenroom_gasstove_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k6.':I'.$k6);
        $this->excel->getActiveSheet()->setCellValue('G'.$k6, $reloc['kitchenroom_gasstove_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k6.':L'.$k6);
        $this->excel->getActiveSheet()->setCellValue('J'.$k6, $reloc['kitchenroom_gasstove_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k6.':O'.$k6);
        $this->excel->getActiveSheet()->setCellValue('M'.$k6, $reloc['kitchenroom_gasstove_remarks']);
        
        // -------------------------  $k7 --------------------
        $k7=$k6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k7.':C'.$k7);
        $this->excel->getActiveSheet()->setCellValue('A'.$k7, 'Cylinder');
        $this->excel->getActiveSheet()->mergeCells('D'.$k7.':F'.$k7);
        $this->excel->getActiveSheet()->setCellValue('D'.$k7, $reloc['kitchenroom_cylinder_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k7.':I'.$k7);
        $this->excel->getActiveSheet()->setCellValue('G'.$k7, $reloc['kitchenroom_cylinder_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k7.':L'.$k7);
        $this->excel->getActiveSheet()->setCellValue('J'.$k7, $reloc['kitchenroom_cylinder_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k7.':O'.$k7);
        $this->excel->getActiveSheet()->setCellValue('M'.$k7, $reloc['kitchenroom_cylinder_remarks']);
        
        // -------------------------  $k8 --------------------
        $k8=$k7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k8.':C'.$k8);
        $this->excel->getActiveSheet()->setCellValue('A'.$k8, 'Grinder');
        $this->excel->getActiveSheet()->mergeCells('D'.$k8.':F'.$k8);
        $this->excel->getActiveSheet()->setCellValue('D'.$k8, $reloc['kitchenroom_grinder_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k8.':I'.$k8);
        $this->excel->getActiveSheet()->setCellValue('G'.$k8, $reloc['kitchenroom_grinder_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k8.':L'.$k8);
        $this->excel->getActiveSheet()->setCellValue('J'.$k8, $reloc['kitchenroom_grinder_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k8.':O'.$k8);
        $this->excel->getActiveSheet()->setCellValue('M'.$k8, $reloc['kitchenroom_grinder_remarks']);
        
        // -------------------------  $k9 --------------------
        $k9=$k8+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k9.':C'.$k9);
        $this->excel->getActiveSheet()->setCellValue('A'.$k9, 'Mixer');
        $this->excel->getActiveSheet()->mergeCells('D'.$k9.':F'.$k9);
        $this->excel->getActiveSheet()->setCellValue('D'.$k9, $reloc['kitchenroom_mixer_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k9.':I'.$k9);
        $this->excel->getActiveSheet()->setCellValue('G'.$k9, $reloc['kitchenroom_mixer_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k9.':L'.$k9);
        $this->excel->getActiveSheet()->setCellValue('J'.$k9, $reloc['kitchenroom_mixer_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k9.':O'.$k9);
        $this->excel->getActiveSheet()->setCellValue('M'.$k9, $reloc['kitchenroom_mixer_remarks']);
        
        // -------------------------  $k10 --------------------
        $k10=$k9+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k10.':C'.$k10);
        $this->excel->getActiveSheet()->setCellValue('A'.$k10, 'Water Filter');
        $this->excel->getActiveSheet()->mergeCells('D'.$k10.':F'.$k10);
        $this->excel->getActiveSheet()->setCellValue('D'.$k10, $reloc['kitchenroom_waterfilter_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k10.':I'.$k10);
        $this->excel->getActiveSheet()->setCellValue('G'.$k10, $reloc['kitchenroom_waterfilter_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k10.':L'.$k10);
        $this->excel->getActiveSheet()->setCellValue('J'.$k10, $reloc['kitchenroom_waterfilter_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k10.':O'.$k10);
        $this->excel->getActiveSheet()->setCellValue('M'.$k10, $reloc['kitchenroom_waterfilter_remarks']);
        
        // -------------------------  $k11 --------------------
        $k11=$k10+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k11.':C'.$k11);
        $this->excel->getActiveSheet()->setCellValue('A'.$k11, 'Quilt');
        $this->excel->getActiveSheet()->mergeCells('D'.$k11.':F'.$k11);
        $this->excel->getActiveSheet()->setCellValue('D'.$k11, $reloc['kitchenroom_quilt_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k11.':I'.$k11);
        $this->excel->getActiveSheet()->setCellValue('G'.$k11, $reloc['kitchenroom_quilt_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k11.':L'.$k11);
        $this->excel->getActiveSheet()->setCellValue('J'.$k11, $reloc['kitchenroom_quilt_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k11.':O'.$k11);
        $this->excel->getActiveSheet()->setCellValue('M'.$k11, $reloc['kitchenroom_quilt_remarks']);
        
        // -------------------------  $k12 --------------------
        $k12=$k11+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k12.':C'.$k12);
        $this->excel->getActiveSheet()->setCellValue('A'.$k12, 'Barbeque');
        $this->excel->getActiveSheet()->mergeCells('D'.$k12.':F'.$k12);
        $this->excel->getActiveSheet()->setCellValue('D'.$k12, $reloc['kitchenroom_barbeque_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k12.':I'.$k12);
        $this->excel->getActiveSheet()->setCellValue('G'.$k12, $reloc['kitchenroom_barbeque_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k12.':L'.$k12);
        $this->excel->getActiveSheet()->setCellValue('J'.$k12, $reloc['kitchenroom_barbeque_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k12.':O'.$k12);
        $this->excel->getActiveSheet()->setCellValue('M'.$k12, $reloc['kitchenroom_barbeque_remarks']);

        // -------------------------  $k13 --------------------
        $k13=$k12+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k13.':C'.$k13);
        $this->excel->getActiveSheet()->setCellValue('A'.$k13, 'Utensiles (No Of Boxes)	');
        $this->excel->getActiveSheet()->mergeCells('D'.$k13.':F'.$k13);
        $this->excel->getActiveSheet()->setCellValue('D'.$k13, $reloc['kitchenroom_utensiles_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k13.':I'.$k13);
        $this->excel->getActiveSheet()->setCellValue('G'.$k13, $reloc['kitchenroom_utensiles_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k13.':L'.$k13);
        $this->excel->getActiveSheet()->setCellValue('J'.$k13, $reloc['kitchenroom_utensiles_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k13.':O'.$k13);
        $this->excel->getActiveSheet()->setCellValue('M'.$k13, $reloc['kitchenroom_utensiles_no_of_box_remarks']);
    
        // -------------------------  $k14 --------------------
        $k14=$k13+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k14.':C'.$k14);
        $this->excel->getActiveSheet()->setCellValue('A'.$k14, 'Plastic (No Of Boxes)');
        $this->excel->getActiveSheet()->mergeCells('D'.$k14.':F'.$k14);
        $this->excel->getActiveSheet()->setCellValue('D'.$k14, $reloc['kitchenroom_plastic_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k14.':I'.$k14);
        $this->excel->getActiveSheet()->setCellValue('G'.$k14, $reloc['kitchenroom_plastic_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k14.':L'.$k14);
        $this->excel->getActiveSheet()->setCellValue('J'.$k14, $reloc['kitchenroom_plastic_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k14.':O'.$k14);
        $this->excel->getActiveSheet()->setCellValue('M'.$k14, $reloc['kitchenroom_plastic_no_of_box_remarks']);
        
        // -------------------------  $k15 --------------------
        $k15=$k14+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$k15.':C'.$k15);
        $this->excel->getActiveSheet()->setCellValue('A'.$k15, 'Kitchen wear (No Of Boxes)');
        $this->excel->getActiveSheet()->mergeCells('D'.$k15.':F'.$k15);
        $this->excel->getActiveSheet()->setCellValue('D'.$k15, $reloc['kitchenroom_kitchen_wear_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$k15.':I'.$k15);
        $this->excel->getActiveSheet()->setCellValue('G'.$k15, $reloc['kitchenroom_kitchen_wear_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$k15.':L'.$k15);
        $this->excel->getActiveSheet()->setCellValue('J'.$k15, $reloc['kitchenroom_kitchen_wear_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$k15.':O'.$k15);
        $this->excel->getActiveSheet()->setCellValue('M'.$k15, $reloc['kitchenroom_kitchen_wear_no_of_box_remarks']);
        
        // -------------------- Bedroom Articles to be Moved -------------------

        $b1=$k15+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$b1.':O'.$b1);
        $this->excel->getActiveSheet()->getStyle('A'.$b1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$b1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$b1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$b1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$b1,'Master Bedroom Articles to be Moved ');

        // -------------------------  $k2 --------------------
        $b2=$b1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$b2.':C'.$b2);
        $this->excel->getActiveSheet()->getStyle('A'.$b2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$b2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$b2.':F'.$b2);
        $this->excel->getActiveSheet()->getStyle('D'.$b2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$b2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$b2.':I'.$b2);
        $this->excel->getActiveSheet()->getStyle('G'.$b2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$b2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$b2.':L'.$b2);
        $this->excel->getActiveSheet()->getStyle('J'.$b2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$b2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$b2.':O'.$b2);
        $this->excel->getActiveSheet()->getStyle('M'.$b2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$b2, 'Remark (damage if any)');

        // -------------------------  $b3 --------------------
        $b3=$b2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b3.':C'.$b3);
        $this->excel->getActiveSheet()->setCellValue('A'.$b3, 'Single Cot');
        $this->excel->getActiveSheet()->mergeCells('D'.$b3.':F'.$b3);
        $this->excel->getActiveSheet()->setCellValue('D'.$b3, $reloc['masterbedroom_singlecot_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b3.':I'.$b3);
        $this->excel->getActiveSheet()->setCellValue('G'.$b3, $reloc['masterbedroom_singlecot_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b3.':L'.$b3);
        $this->excel->getActiveSheet()->setCellValue('J'.$b3, $reloc['masterbedroom_singlecot_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b3.':O'.$b3);
        $this->excel->getActiveSheet()->setCellValue('M'.$b3, $reloc['masterbedroom_singlecot_remarks']);
        
        // -------------------------  $b4 --------------------
        $b4=$b3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b4.':C'.$b4);
        $this->excel->getActiveSheet()->setCellValue('A'.$b4, 'Single Mattress	');
        $this->excel->getActiveSheet()->mergeCells('D'.$b4.':F'.$b4);
        $this->excel->getActiveSheet()->setCellValue('D'.$b4, $reloc['masterbedroom_singlemattress_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b4.':I'.$b4);
        $this->excel->getActiveSheet()->setCellValue('G'.$b4, $reloc['masterbedroom_singlemattress_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b4.':L'.$b4);
        $this->excel->getActiveSheet()->setCellValue('J'.$b4, $reloc['masterbedroom_singlemattress_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b4.':O'.$b4);
        $this->excel->getActiveSheet()->setCellValue('M'.$b4, $reloc['masterbedroom_singlemattress_remarks']);
        
        // -------------------------  $b5 --------------------
        $b5=$b4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b5.':C'.$b5);
        $this->excel->getActiveSheet()->setCellValue('A'.$b5, '1. Double Cot(box type with storage 2. normal)	');
        $this->excel->getActiveSheet()->mergeCells('D'.$b5.':F'.$b5);
        $this->excel->getActiveSheet()->setCellValue('D'.$b5, $reloc['masterbedroom_doublecot_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b5.':I'.$b5);
        $this->excel->getActiveSheet()->setCellValue('G'.$b5, $reloc['masterbedroom_doublecot_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b5.':L'.$b5);
        $this->excel->getActiveSheet()->setCellValue('J'.$b5, $reloc['masterbedroom_doublecot_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b5.':O'.$b5);
        $this->excel->getActiveSheet()->setCellValue('M'.$b5, $reloc['masterbedroom_doublecot_remarks']);
        
        // -------------------------  $b6 --------------------
        $b6=$b5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b6.':C'.$b6);
        $this->excel->getActiveSheet()->setCellValue('A'.$b6, 'Double Mattress	');
        $this->excel->getActiveSheet()->mergeCells('D'.$b6.':F'.$b6);
        $this->excel->getActiveSheet()->setCellValue('D'.$b6, $reloc['masterbedroom_doublemattress_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b6.':I'.$b6);
        $this->excel->getActiveSheet()->setCellValue('G'.$b6, $reloc['masterbedroom_doublemattress_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b6.':L'.$b6);
        $this->excel->getActiveSheet()->setCellValue('J'.$b6, $reloc['masterbedroom_doublemattress_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b6.':O'.$b6);
        $this->excel->getActiveSheet()->setCellValue('M'.$b6, $reloc['masterbedroom_doublemattress_remarks']);
        
        // -------------------------  $b7 --------------------
        $b7=$b6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b7.':C'.$b7);
        $this->excel->getActiveSheet()->setCellValue('A'.$b7, 'Dressing Table');
        $this->excel->getActiveSheet()->mergeCells('D'.$b7.':F'.$b7);
        $this->excel->getActiveSheet()->setCellValue('D'.$b7, $reloc['masterbedroom_dressingtable_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b7.':I'.$b7);
        $this->excel->getActiveSheet()->setCellValue('G'.$b7, $reloc['masterbedroom_dressingtable_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b7.':L'.$b7);
        $this->excel->getActiveSheet()->setCellValue('J'.$b7, $reloc['masterbedroom_dressingtable_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b7.':O'.$b7);
        $this->excel->getActiveSheet()->setCellValue('M'.$b7, $reloc['masterbedroom_dressingtable_remarks']);
        
        // -------------------------  $b8 --------------------
        $b8=$b7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b8.':C'.$b8);
        $this->excel->getActiveSheet()->setCellValue('A'.$b8, 'Cupboard');
        $this->excel->getActiveSheet()->mergeCells('D'.$b8.':F'.$b8);
        $this->excel->getActiveSheet()->setCellValue('D'.$b8, $reloc['masterbedroom_cupboard_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b8.':I'.$b8);
        $this->excel->getActiveSheet()->setCellValue('G'.$b8, $reloc['masterbedroom_cupboard_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b8.':L'.$b8);
        $this->excel->getActiveSheet()->setCellValue('J'.$b8, $reloc['masterbedroom_cupboard_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b8.':O'.$b8);
        $this->excel->getActiveSheet()->setCellValue('M'.$b8, $reloc['masterbedroom_cupboard_remarks']);
        
        // -------------------------  $b9 --------------------
        $b9=$b8+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b9.':C'.$b9);
        $this->excel->getActiveSheet()->setCellValue('A'.$b9, 'Steel Almera	');
        $this->excel->getActiveSheet()->mergeCells('D'.$b9.':F'.$b9);
        $this->excel->getActiveSheet()->setCellValue('D'.$b9, $reloc['masterbedroom_steelalmera_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b9.':I'.$b9);
        $this->excel->getActiveSheet()->setCellValue('G'.$b9, $reloc['masterbedroom_steelalmera_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b9.':L'.$b9);
        $this->excel->getActiveSheet()->setCellValue('J'.$b9, $reloc['masterbedroom_steelalmera_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b9.':O'.$b9);
        $this->excel->getActiveSheet()->setCellValue('M'.$b9, $reloc['masterbedroom_steelalmera_remarks']);
        
        // -------------------------  $b10 --------------------
        $b10=$b9+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b10.':C'.$b10);
        $this->excel->getActiveSheet()->setCellValue('A'.$b10, 'Window AC');
        $this->excel->getActiveSheet()->mergeCells('D'.$b10.':F'.$b10);
        $this->excel->getActiveSheet()->setCellValue('D'.$b10, $reloc['masterbedroom_windowac_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b10.':I'.$b10);
        $this->excel->getActiveSheet()->setCellValue('G'.$b10, $reloc['masterbedroom_windowac_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b10.':L'.$b10);
        $this->excel->getActiveSheet()->setCellValue('J'.$b10, $reloc['masterbedroom_windowac_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b10.':O'.$b10);
        $this->excel->getActiveSheet()->setCellValue('M'.$b10, $reloc['masterbedroom_windowac_remarks']);
        
        // -------------------------  $b11 --------------------
        $b11=$b10+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b11.':C'.$b11);
        $this->excel->getActiveSheet()->setCellValue('A'.$b11, 'Split AC');
        $this->excel->getActiveSheet()->mergeCells('D'.$b11.':F'.$b11);
        $this->excel->getActiveSheet()->setCellValue('D'.$b11, $reloc['masterbedroom_splitac_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b11.':I'.$b11);
        $this->excel->getActiveSheet()->setCellValue('G'.$b11, $reloc['masterbedroom_splitac_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b11.':L'.$b11);
        $this->excel->getActiveSheet()->setCellValue('J'.$b11, $reloc['masterbedroom_splitac_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b11.':O'.$b11);
        $this->excel->getActiveSheet()->setCellValue('M'.$b11, $reloc['masterbedroom_splitac_remarks']);
        
        // -------------------------  $b12 --------------------
        $b12=$b11+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$b12.':C'.$b12);
        $this->excel->getActiveSheet()->setCellValue('A'.$b12, 'Suitcases');
        $this->excel->getActiveSheet()->mergeCells('D'.$b12.':F'.$b12);
        $this->excel->getActiveSheet()->setCellValue('D'.$b12, $reloc['masterbedroom_suitcases_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b12.':I'.$b12);
        $this->excel->getActiveSheet()->setCellValue('G'.$b12, $reloc['masterbedroom_suitcases_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b12.':L'.$b12);
        $this->excel->getActiveSheet()->setCellValue('J'.$b12, $reloc['masterbedroom_suitcases_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b12.':O'.$b12);
        $this->excel->getActiveSheet()->setCellValue('M'.$b12, $reloc['masterbedroom_suitcases_remarks']);
        
        // -------------------------  $b13 --------------------
        $b13=$b12+1;   
        $this->excel->getActiveSheet()->mergeCells('A'.$b13.':C'.$b13);
        $this->excel->getActiveSheet()->setCellValue('A'.$b13, 'Clothes (No Of Boxes)	');
        $this->excel->getActiveSheet()->mergeCells('D'.$b13.':F'.$b13);
        $this->excel->getActiveSheet()->setCellValue('D'.$b13, $reloc['masterbedroom_clothes_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b13.':I'.$b13);
        $this->excel->getActiveSheet()->setCellValue('G'.$b13, $reloc['masterbedroom_clothes_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b13.':L'.$b13);
        $this->excel->getActiveSheet()->setCellValue('J'.$b13, $reloc['masterbedroom_clothes_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b13.':O'.$b13);
        $this->excel->getActiveSheet()->setCellValue('M'.$b13, $reloc['masterbedroom_clothes_no_of_box_remarks']);
        
        // -------------------------  $b14 --------------------
        $b14=$b13+1;   
        $this->excel->getActiveSheet()->mergeCells('A'.$b14.':C'.$b14);
        $this->excel->getActiveSheet()->setCellValue('A'.$b14, 'Trunks');
        $this->excel->getActiveSheet()->mergeCells('D'.$b14.':F'.$b14);
        $this->excel->getActiveSheet()->setCellValue('D'.$b14, $reloc['masterbedroom_trunks_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b14.':I'.$b14);
        $this->excel->getActiveSheet()->setCellValue('G'.$b14, $reloc['masterbedroom_trunks_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b14.':L'.$b14);
        $this->excel->getActiveSheet()->setCellValue('J'.$b14, $reloc['masterbedroom_trunks_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b14.':O'.$b14);
        $this->excel->getActiveSheet()->setCellValue('M'.$b14, $reloc['masterbedroom_trunks_remarks']);
        
        // -------------------------  $b15 --------------------
        $b15=$b14+1;   
        $this->excel->getActiveSheet()->mergeCells('A'.$b15.':C'.$b15);
        $this->excel->getActiveSheet()->setCellValue('A'.$b15, 'Mirrors');
        $this->excel->getActiveSheet()->mergeCells('D'.$b15.':F'.$b15);
        $this->excel->getActiveSheet()->setCellValue('D'.$b15, $reloc['masterbedroom_mirrors_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$b15.':I'.$b15);
        $this->excel->getActiveSheet()->setCellValue('G'.$b15, $reloc['masterbedroom_mirrors_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$b15.':L'.$b15);
        $this->excel->getActiveSheet()->setCellValue('J'.$b15, $reloc['masterbedroom_mirrors_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$b15.':O'.$b15);
        $this->excel->getActiveSheet()->setCellValue('M'.$b15, $reloc['masterbedroom_mirrors_remarks']);
        
        // -------------------- Kids Bedroom Articles to be Moved -------------------

        $kb1=$b15+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb1.':O'.$kb1);
        $this->excel->getActiveSheet()->getStyle('A'.$kb1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$kb1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$kb1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$kb1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb1,'Kids Bedroom Articles to be Moved ');

        // -------------------------  $k2 --------------------
        $kb2=$kb1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$kb2.':C'.$kb2);
        $this->excel->getActiveSheet()->getStyle('A'.$kb2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb2.':F'.$kb2);
        $this->excel->getActiveSheet()->getStyle('D'.$kb2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$kb2.':I'.$kb2);
        $this->excel->getActiveSheet()->getStyle('G'.$kb2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$kb2.':L'.$kb2);
        $this->excel->getActiveSheet()->getStyle('J'.$kb2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$kb2.':O'.$kb2);
        $this->excel->getActiveSheet()->getStyle('M'.$kb2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb2, 'Remark (damage if any)');

        // -------------------------  $kb3 --------------------
        $kb3=$kb2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb3.':C'.$kb3);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb3, 'Window AC ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb3.':F'.$kb3);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb3, $reloc['kidsbedroom_windowac_kids_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb3.':I'.$kb3);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb3, $reloc['kidsbedroom_windowac_kids_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb3.':L'.$kb3);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb3, $reloc['kidsbedroom_windowac_kids_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb3.':O'.$kb3);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb3, $reloc['kidsbedroom_windowac_kids_remarks']);
       
        // -------------------------  $kb4 --------------------
        $kb4=$kb3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb4.':C'.$kb4);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb4, 'Split AC ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb4.':F'.$kb4);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb4, $reloc['kidsbedroom_splitac_kids_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb4.':I'.$kb4);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb4, $reloc['kidsbedroom_splitac_kids_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb4.':L'.$kb4);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb4, $reloc['kidsbedroom_splitac_kids_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb4.':O'.$kb4);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb4, $reloc['kidsbedroom_splitac_kids_remarks']);

        // -------------------------  $kb5--------------------
        $kb5=$kb4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb5.':C'.$kb5);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb5, 'Baby Car and cycle  ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb5.':F'.$kb5);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb5, $reloc['kidsbedroom_baby_carandcycle_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb5.':I'.$kb5);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb5, $reloc['kidsbedroom_baby_carandcycle_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb5.':L'.$kb5);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb5, $reloc['kidsbedroom_baby_carandcycle_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb5.':O'.$kb5);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb5, $reloc['kidsbedroom_baby_carandcycle_remarks']);
       
        // -------------------------  $kb6--------------------
        $kb6=$kb5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb6.':C'.$kb6);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb6, 'Clothes (No Of Boxes)  ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb6.':F'.$kb6);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb6, $reloc['kidsbedroom_kids_clothes_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb6.':I'.$kb6);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb6, $reloc['kidsbedroom_kids_clothes_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb6.':L'.$kb6);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb6, $reloc['kidsbedroom_kids_clothes_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb6.':O'.$kb6);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb6, $reloc['kidsbedroom_kids_clothes_no_of_box_remarks']);
       
        // -------------------------  $kb7--------------------
        $kb7=$kb6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb7.':C'.$kb7);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb7, 'Books (No Of Boxes)');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb7.':F'.$kb7);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb7, $reloc['kidsbedroom_kids_books_no_of_box_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb7.':I'.$kb7);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb7, $reloc['kidsbedroom_kids_books_no_of_box_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb7.':L'.$kb7);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb7, $reloc['kidsbedroom_kids_books_no_of_box_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb7.':O'.$kb7);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb7, $reloc['kidsbedroom_kids_books_no_of_box_remarks']);

        // -------------------------  $kb8--------------------
        $kb8=$kb7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb8.':C'.$kb8);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb8, 'Single Cot');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb8.':F'.$kb8);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb8, $reloc['kidsbedroom_kids_singlecot_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb8.':I'.$kb8);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb8, $reloc['kidsbedroom_kids_singlecot_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb8.':L'.$kb8);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb8, $reloc['kidsbedroom_kids_singlecot_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb8.':O'.$kb8);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb8, $reloc['kidsbedroom_kids_singlecot_remarks']);
               
        // -------------------------  $kb9--------------------
        $kb9=$kb8+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb9.':C'.$kb9);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb9, 'Single Mattress');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb9.':F'.$kb9);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb9, $reloc['kidsbedroom_kids_singlemattress_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb9.':I'.$kb9);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb9, $reloc['kidsbedroom_kids_singlemattress_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb9.':L'.$kb9);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb9, $reloc['kidsbedroom_kids_singlemattress_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb9.':O'.$kb9);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb9, $reloc['kidsbedroom_kids_singlemattress_remarks']);
       
        // -------------------------  $kb10--------------------
        $kb10=$kb9+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb10.':C'.$kb10);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb10, '1. Double Cot(box type with storage 2. normal) ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb10.':F'.$kb10);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb10, $reloc['kidsbedroom_kids_doublecot_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb10.':I'.$kb10);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb10, $reloc['kidsbedroom_kids_doublecot_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb10.':L'.$kb10);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb10, $reloc['kidsbedroom_kids_doublecot_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb10.':O'.$kb10);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb10, $reloc['kidsbedroom_kids_doublecot_remarks']);
       

        // -------------------------  $kb11--------------------
        $kb11=$kb10+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb11.':C'.$kb11);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb11, 'Double Mattress ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb11.':F'.$kb11);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb11, $reloc['kidsbedroom_doublemattress_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb11.':I'.$kb11);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb11, $reloc['kidsbedroom_doublemattress_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb11.':L'.$kb11);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb11, $reloc['kidsbedroom_doublemattress_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb11.':O'.$kb11);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb11, $reloc['kidsbedroom_doublemattress_remarks']);
       

        // -------------------------  $kb12--------------------
        $kb12=$kb11+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb12.':C'.$kb12);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb12, 'Pram ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb12.':F'.$kb12);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb12, $reloc['kidsbedroom_kids_pram_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb12.':I'.$kb12);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb12, $reloc['kidsbedroom_kids_pram_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb12.':L'.$kb12);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb12, $reloc['kidsbedroom_kids_pram_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb12.':O'.$kb12);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb12, $reloc['kidsbedroom_kids_pram_remarks']);
       

        // -------------------------  $kb13--------------------
        $kb13=$kb12+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$kb13.':C'.$kb13);
        $this->excel->getActiveSheet()->setCellValue('A'.$kb13, 'Mirrors ');
        $this->excel->getActiveSheet()->mergeCells('D'.$kb13.':F'.$kb13);
        $this->excel->getActiveSheet()->setCellValue('D'.$kb13, $reloc['kidsbedroom_kids_mirrors_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$kb13.':I'.$kb13);
        $this->excel->getActiveSheet()->setCellValue('G'.$kb13, $reloc['kidsbedroom_kids_mirrors_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$kb13.':L'.$kb13);
        $this->excel->getActiveSheet()->setCellValue('J'.$kb13, $reloc['kidsbedroom_kids_mirrors_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$kb13.':O'.$kb13);
        $this->excel->getActiveSheet()->setCellValue('M'.$kb13, $reloc['kidsbedroom_kids_mirrors_remarks']);
       
        //   ------------------ Commam Area--------------------
        $ca1=$kb13+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca1.':O'.$ca1);
        $this->excel->getActiveSheet()->getStyle('A'.$ca1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$ca1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$ca1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$ca1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca1,'Commam Area Articles to be Moved ');

        // -------------------------  $ca2 --------------------
        $ca2=$ca1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$ca2.':C'.$ca2);
        $this->excel->getActiveSheet()->getStyle('A'.$ca2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca2.':F'.$ca2);
        $this->excel->getActiveSheet()->getStyle('D'.$ca2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca2, 'Qty');
        $this->excel->getActiveSheet()->mergeCells('G'.$ca2.':I'.$ca2);
        $this->excel->getActiveSheet()->getStyle('G'.$ca2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca2, 'Insurance Value');
        $this->excel->getActiveSheet()->mergeCells('J'.$ca2.':L'.$ca2);
        $this->excel->getActiveSheet()->getStyle('J'.$ca2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca2, 'Desc');
        $this->excel->getActiveSheet()->mergeCells('M'.$ca2.':O'.$ca2);
        $this->excel->getActiveSheet()->getStyle('M'.$ca2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca2, 'Remark (damage if any)');

        // -------------------------  $ca3 --------------------
        $ca3=$ca2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca3.':C'.$ca3);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca3, 'Washing M/c ');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca3.':F'.$ca3);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca3, $reloc['common_washingmc_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca3.':I'.$ca3);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca3, $reloc['common_washingmc_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca3.':L'.$ca3);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca3, $reloc['common_washingmc_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca3.':O'.$ca3);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca3, $reloc['common_washingmc_remarks']);      

        // -------------------------  $ca4 --------------------
        $ca4=$ca3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca4.':C'.$ca4);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca4, 'Dishwasher');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca4.':F'.$ca4);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca4, $reloc['common_dishwasher_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca4.':I'.$ca4);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca4, $reloc['common_dishwasher_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca4.':L'.$ca4);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca4, $reloc['common_dishwasher_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca4.':O'.$ca4);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca4, $reloc['common_dishwasher_remarks']);
       
        // -------------------------  $ca5 --------------------
        $ca5=$ca4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca5.':C'.$ca5);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca5, 'Ex- Cycle ');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca5.':F'.$ca5);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca5, $reloc['common_ex_cycle_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca5.':I'.$ca5);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca5, $reloc['common_ex_cycle_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca5.':L'.$ca5);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca5, $reloc['common_ex_cycle_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca5.':O'.$ca5);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca5, $reloc['common_ex_cycle_remarks']);
       
        // -------------------------  $ca5 --------------------
        $ca6=$ca5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca6.':C'.$ca6);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca6, 'Ladder');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca6.':F'.$ca6);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca6, $reloc['common_ladder_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca6.':I'.$ca6);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca6, $reloc['common_ladder_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca6.':L'.$ca6);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca6, $reloc['common_ladder_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca6.':O'.$ca6);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca6, $reloc['common_ladder_remarks']);
         // -------------------------  $ca5 --------------------
        $ca7=$ca6+1;          
        $this->excel->getActiveSheet()->mergeCells('A'.$ca7.':C'.$ca7);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca7, 'Inverter');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca7.':F'.$ca7);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca7, $reloc['common_inverter_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca7.':I'.$ca7);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca7, $reloc['common_inverter_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca7.':L'.$ca7);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca7, $reloc['common_inverter_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca7.':O'.$ca7);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca7, $reloc['common_inverter_remarks']);
               

         // -------------------------  $ca5 --------------------
        $ca8=$ca7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$ca8.':C'.$ca8);
        $this->excel->getActiveSheet()->setCellValue('A'.$ca8, 'Battery');
        $this->excel->getActiveSheet()->mergeCells('D'.$ca8.':F'.$ca8);
        $this->excel->getActiveSheet()->setCellValue('D'.$ca8, $reloc['common_battery_qty']);
        $this->excel->getActiveSheet()->mergeCells('G'.$ca8.':I'.$ca8);
        $this->excel->getActiveSheet()->setCellValue('G'.$ca8, $reloc['common_battery_insu']);
        $this->excel->getActiveSheet()->mergeCells('J'.$ca8.':L'.$ca8);
        $this->excel->getActiveSheet()->setCellValue('J'.$ca8, $reloc['common_battery_desc']);
        $this->excel->getActiveSheet()->mergeCells('M'.$ca8.':O'.$ca8);
        $this->excel->getActiveSheet()->setCellValue('M'.$ca8, $reloc['common_battery_remarks']);
       
        //   -------------------  Other Articles to be Moved Part  ---------------------
        $b=$ca8+2;

        $this->excel->getActiveSheet()->mergeCells('A'.$b.':O'.$b);
        $this->excel->getActiveSheet()->getStyle('A'.$b)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$b)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$b)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$b)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$b,'Other Articles to be Moved');

        // -----------------------  $c --------------------
        $c=$b+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->getStyle('A'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$c, 'Item');
        $this->excel->getActiveSheet()->getStyle('B'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('B'.$c, 'Qty');
        $this->excel->getActiveSheet()->getStyle('C'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('C'.$c, 'Insurance Value');
        $this->excel->getActiveSheet()->getStyle('D'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('D'.$c, 'Desc');
        $this->excel->getActiveSheet()->getStyle('E'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('E'.$c, 'Remark (damage if any)');
        $this->excel->getActiveSheet()->getStyle('F'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('F'.$c, 'Item');
        $this->excel->getActiveSheet()->getStyle('G'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('G'.$c, 'Qty');
        $this->excel->getActiveSheet()->getStyle('H'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('H'.$c, 'Insurance Value');
        $this->excel->getActiveSheet()->getStyle('I'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('I'.$c, 'Desc');
        $this->excel->getActiveSheet()->getStyle('J'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('J'.$c, 'Remark (damage if any)');
        $this->excel->getActiveSheet()->getStyle('K'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('K'.$c, 'Item');
        $this->excel->getActiveSheet()->getStyle('L'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('L'.$c, 'Qty');
        $this->excel->getActiveSheet()->getStyle('M'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('M'.$c, 'Insurance Value');
        $this->excel->getActiveSheet()->getStyle('N'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('N'.$c, 'Desc');
        $this->excel->getActiveSheet()->getStyle('O'.$c)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('O'.$c, 'Remark (damage if any)');

        //  ----------------- $d ------------
        $d=$c+1;
        $this->excel->getActiveSheet()->getStyle('A'.$d)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('A'.$d, 'Carton for Clothes');
        $this->excel->getActiveSheet()->setCellValue('B'.$d, $reloc['others_carton_for_clothes_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$d, $reloc['others_carton_for_clothes_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$d, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$d, $reloc['others_item1_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$d, $reloc['others_item1_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$d, $reloc['others_item1_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$d, $reloc['others_item1_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$d, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$d, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$d, $reloc['others_item2_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$d, $reloc['others_item2_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$d, $reloc['others_item2_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$d, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$d, '');

        //  ----------------- $e ------------
        $e=$d+1;
        $this->excel->getActiveSheet()->getStyle('A'.$e)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('A'.$e,'Dish Antena');
        $this->excel->getActiveSheet()->setCellValue('B'.$e, $reloc['others_Dish_Antena_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$e, $reloc['others_Dish_Antena_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$e, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$e, $reloc['others_item2_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$e, $reloc['others_item3_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$e, $reloc['others_item3_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$e, $reloc['others_item3_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$e, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$e, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$e, $reloc['others_item4_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$e, $reloc['others_item4_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$e, $reloc['others_item4_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$e, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$e, '');

        //  ----------------- $f ------------
        $f=$e+1;
        $this->excel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('A'.$f, 'Miscellaneous Box	');
        $this->excel->getActiveSheet()->setCellValue('B'.$f, $reloc['others_Miscellaneous_Box_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$f, $reloc['others_Miscellaneous_Box_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$f, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$f, $reloc['others_item3_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$f, $reloc['others_item5_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$f, $reloc['others_item5_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$f, $reloc['others_item5_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$f, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$f, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$f, $reloc['others_item6_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$f, $reloc['others_item6_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$f, $reloc['others_item6_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$f, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$f, '');

        //  ----------------- $d ------------
        $g=$f+1;
        $this->excel->getActiveSheet()->setCellValue('A'.$g, 'Cylinder');
        $this->excel->getActiveSheet()->setCellValue('B'.$g, $reloc['others_Cylinder_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$g, $reloc['others_Cylinder_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$g, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$g, $reloc['others_item4_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$g, $reloc['others_item7_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$g, $reloc['others_item7_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$g, $reloc['others_item7_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$g, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$g, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$g, $reloc['others_item8_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$g, $reloc['others_item8_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$g, $reloc['others_item8_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$g, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$g, '');
        //  ----------------- $h ------------
        $h=$g+1;
        $this->excel->getActiveSheet()->setCellValue('A'.$h, 'Geyser');
        $this->excel->getActiveSheet()->setCellValue('B'.$h, $reloc['others_Geyser_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$h, $reloc['others_Geyser_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$h, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$h, $reloc['others_item5_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$h, $reloc['others_item9_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$h, $reloc['others_item9_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$h, $reloc['others_item9_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$h, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$h, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$h, $reloc['others_item10_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$h, $reloc['others_item10_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$h, $reloc['others_item10_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$h, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$h, '');

        //  ----------------- $ics ------------
        $ics=$h+1;
        $this->excel->getActiveSheet()->setCellValue('A'.$ics, 'Cloth Stand	');
        $this->excel->getActiveSheet()->setCellValue('B'.$ics, $reloc['others_Cloth_Stand_qty']);
        $this->excel->getActiveSheet()->setCellValue('C'.$ics, $reloc['others_Cloth_Stand_insu']);
        $this->excel->getActiveSheet()->setCellValue('D'.$ics, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$ics, $reloc['others_item6_row_remarks']);
        $this->excel->getActiveSheet()->setCellValue('F'.$ics, $reloc['others_item11_name']);
        $this->excel->getActiveSheet()->setCellValue('G'.$ics, $reloc['others_item11_qty']);
        $this->excel->getActiveSheet()->setCellValue('H'.$ics, $reloc['others_item11_insu']);
        $this->excel->getActiveSheet()->setCellValue('I'.$ics, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$ics, '');
        $this->excel->getActiveSheet()->setCellValue('K'.$ics, $reloc['others_item12_name']);
        $this->excel->getActiveSheet()->setCellValue('L'.$ics, $reloc['others_item12_qty']);
        $this->excel->getActiveSheet()->setCellValue('M'.$ics, $reloc['others_item12_insu']);
        $this->excel->getActiveSheet()->setCellValue('N'.$ics, '');
        $this->excel->getActiveSheet()->setCellValue('O'.$ics, '');

          
        // -------------------- Vehicles -------------------
        
        /*
        // -------------------- V1 -------------------

        $v1=$h+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$v1.':O'.$v1);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$v1,'Vehicles');
       
        // -------------------- V2 -------------------
        $v2=$v1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$v2.':K'.$v2);
        $this->excel->getActiveSheet()->getStyle('A'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$v2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('L'.$v2.':O'.$v2);
        $this->excel->getActiveSheet()->getStyle('L'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('L'.$v2, 'Remark (damage if any)');

        // -------------------- V3 -------------------
        $v3=$v2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v3.':F'.$v3);
        $this->excel->getActiveSheet()->setCellValue('A'.$v3, 'Motor Bike / Scooter Make & Model');
        $this->excel->getActiveSheet()->mergeCells('G'.$v3.':K'.$v3);
        $this->excel->getActiveSheet()->setCellValue('G'.$v3, $reloc['vehicles_Motor_Bike_Scooter_Make_Model']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v3.':O'.$v3);
        $this->excel->getActiveSheet()->setCellValue('L'.$v3, $reloc['vehicles_Motor_Bike_Scooter_Make_Model_remarks']);

        // -------------------- V4 -------------------
        $v4=$v3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v4.':F'.$v4);
        $this->excel->getActiveSheet()->setCellValue('A'.$v4, 'CAR Make & Model	');
        $this->excel->getActiveSheet()->mergeCells('G'.$v4.':K'.$v4);
        $this->excel->getActiveSheet()->setCellValue('G'.$v4, $reloc['vehicles_CAR_MakeandModel']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v4.':O'.$v4);
        $this->excel->getActiveSheet()->setCellValue('L'.$v4, $reloc['vehicles_CAR_MakeandModel_remarks']);

        // -------------------- V5 -------------------
        $v5=$v4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v5.':F'.$v5);
        $this->excel->getActiveSheet()->setCellValue('A'.$v5, 'Make1');
        $this->excel->getActiveSheet()->mergeCells('G'.$v5.':K'.$v5);
        $this->excel->getActiveSheet()->setCellValue('G'.$v5, $reloc['vehicles_Make1']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v5.':O'.$v5);
        $this->excel->getActiveSheet()->setCellValue('L'.$v5, $reloc['vehicles_Make1_remarks']);

        // -------------------- V6 -------------------
        $v6=$v5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v6.':F'.$v6);
        $this->excel->getActiveSheet()->setCellValue('A'.$v6, 'Make2');
        $this->excel->getActiveSheet()->mergeCells('G'.$v6.':K'.$v6);
        $this->excel->getActiveSheet()->setCellValue('G'.$v6, $reloc['vehicles_Make2']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v6.':O'.$v6);
        $this->excel->getActiveSheet()->setCellValue('L'.$v6, $reloc['vehicles_Make2_remarks']);
        
        */
        
        // -------------------- V1 -------------------

        $v1=$ics+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$v1.':O'.$v1);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$v1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$v1,'Vehicles');
       
        
        // -------------------- V2 -------------------
        $v2=$v1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$v2.':E'.$v2);
        $this->excel->getActiveSheet()->getStyle('A'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$v2, 'Item');

        $this->excel->getActiveSheet()->mergeCells('F'.$v2.':H'.$v2);
        $this->excel->getActiveSheet()->getStyle('F'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('F'.$v2, 'Qty');

        $this->excel->getActiveSheet()->mergeCells('I'.$v2.':K'.$v2);
        $this->excel->getActiveSheet()->getStyle('I'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('I'.$v2, 'Insurance Value');
        
        $this->excel->getActiveSheet()->mergeCells('L'.$v2.':O'.$v2);
        $this->excel->getActiveSheet()->getStyle('L'.$v2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('L'.$v2, 'Remark (damage if any)');

        // -------------------- V3 -------------------
        $v3=$v2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v3.':E'.$v3);
        $this->excel->getActiveSheet()->setCellValue('A'.$v3, 'Motor Bike / Scooter Make & Model');
        $this->excel->getActiveSheet()->mergeCells('F'.$v3.':H'.$v3);
        $this->excel->getActiveSheet()->setCellValue('F'.$v3, $reloc['vehicles_Motor_Bike_Scooter_Make_Model_qty']);
        $this->excel->getActiveSheet()->mergeCells('I'.$v3.':K'.$v3);
        $this->excel->getActiveSheet()->setCellValue('I'.$v3, $reloc['vehicles_Motor_Bike_Scooter_Make_Model_insu']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v3.':O'.$v3);
        $this->excel->getActiveSheet()->setCellValue('L'.$v3, $reloc['vehicles_Motor_Bike_Scooter_Make_Model_remarks']);
        // -------------------- V4 -------------------
        $v4=$v3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$v4.':E'.$v4);
        $this->excel->getActiveSheet()->setCellValue('A'.$v4, 'CAR Make & Model	');
        $this->excel->getActiveSheet()->mergeCells('F'.$v4.':H'.$v4);
        $this->excel->getActiveSheet()->setCellValue('F'.$v4, $reloc['vehicles_CAR_MakeandModel_qty']);
        $this->excel->getActiveSheet()->mergeCells('I'.$v4.':K'.$v4);
        $this->excel->getActiveSheet()->setCellValue('I'.$v4, $reloc['vehicles_CAR_MakeandModel_insu']);
        $this->excel->getActiveSheet()->mergeCells('L'.$v4.':O'.$v4);
        $this->excel->getActiveSheet()->setCellValue('L'.$v4, $reloc['vehicles_CAR_MakeandModel_remarks']);
        
        
        // -------------------- Important Information -------------------
        // -------------------- im1 -------------------
        $im1=$v4+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$im1.':O'.$im1);
        $this->excel->getActiveSheet()->getStyle('A'.$im1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$im1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$im1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$im1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$im1,'Important Information');
       
        // -------------------- im2 -------------------
        $im2=$im1+1;
        $fill_colr=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '#fcf8e')));
        $this->excel->getActiveSheet()->mergeCells('A'.$im2.':K'.$im2);
        $this->excel->getActiveSheet()->getStyle('A'.$im2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('A'.$im2, 'Item');
        $this->excel->getActiveSheet()->mergeCells('L'.$im2.':O'.$im2);
        $this->excel->getActiveSheet()->getStyle('L'.$im2)->applyFromArray($fill_colr);
        $this->excel->getActiveSheet()->setCellValue('L'.$im2, 'Remark (damage if any)');


        // -------------------- im3 -------------------
        $im3=$im2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im3.':G'.$im3);
        $this->excel->getActiveSheet()->setCellValue('A'.$im3, 'Society Permission - By Client Only	');
        $this->excel->getActiveSheet()->mergeCells('H'.$im3.':K'.$im3);
        $this->excel->getActiveSheet()->setCellValue('H'.$im3, $reloc['impinfo_Society_Permission_By_Client_Only']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im3.':O'.$im3);
        $this->excel->getActiveSheet()->setCellValue('L'.$im3, $reloc['impinfo_Society_Permission_By_Client_Only_remarks']);

        // -------------------- im4 -------------------
        $im4=$im3+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im4.':G'.$im4);
        $this->excel->getActiveSheet()->setCellValue('A'.$im4, 'Is there easy access for loading and unloading at origin and destination');
        $this->excel->getActiveSheet()->mergeCells('H'.$im4.':K'.$im4);
        $this->excel->getActiveSheet()->setCellValue('H'.$im4, $reloc['impinfo_Is_there_easy_access_for_loading_and_unloading_at_origin_and_destination']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im4.':O'.$im4);
        $this->excel->getActiveSheet()->setCellValue('L'.$im4, $reloc['impinfo_Is_there_easy_access_for_loading_and_unloading_at_origin_and_destination_remarks']);

        // -------------------- im5 -------------------
        $im5=$im4+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im5.':G'.$im5);
        $this->excel->getActiveSheet()->setCellValue('A'.$im5, 'Are there any time restrictions for loading / unloading at origin or destination');
        $this->excel->getActiveSheet()->mergeCells('H'.$im5.':K'.$im5);
        $this->excel->getActiveSheet()->setCellValue('H'.$im5, $reloc['impinfo_Are_there_any_time_restrictions_for_loading_unloading_at_origin_or_destination']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im5.':O'.$im5);
        $this->excel->getActiveSheet()->setCellValue('L'.$im5, $reloc['impinfo_Are_there_any_time_restrictions_for_loading_unloading_at_origin_or_destination_remarks']);
        // -------------------- im6 -------------------
        $im6=$im5+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im6.':G'.$im6);
        $this->excel->getActiveSheet()->setCellValue('A'.$im6, 'Distance from Lift to Vechicle ( long carry)');
        $this->excel->getActiveSheet()->mergeCells('H'.$im6.':K'.$im6);
        $this->excel->getActiveSheet()->setCellValue('H'.$im6, $reloc['impinfo_Distance_from_Lift_to_Vechicle_long']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im6.':O'.$im6);
        $this->excel->getActiveSheet()->setCellValue('L'.$im6, $reloc['impinfo_Distance_from_Lift_to_Vechicle_long_remarks']);
        // -------------------- im7 -------------------
        $im7=$im6+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im7.':G'.$im7);
        $this->excel->getActiveSheet()->setCellValue('A'.$im7, 'Are there any items which are difficult to handle');
        $this->excel->getActiveSheet()->mergeCells('H'.$im7.':K'.$im7);
        $this->excel->getActiveSheet()->setCellValue('H'.$im7, $reloc['impinfo_Are_there_any_items_which_are_difficult_to_handle']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im7.':O'.$im7);
        $this->excel->getActiveSheet()->setCellValue('L'.$im7, $reloc['impinfo_Are_there_any_items_which_are_difficult_to_handle_remarks']);
        // -------------------- im8 -------------------
        $im8=$im7+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im8.':G'.$im8);
        $this->excel->getActiveSheet()->setCellValue('A'.$im8, 'Are there any items which are already damaged');
        $this->excel->getActiveSheet()->mergeCells('H'.$im8.':K'.$im8);
        $this->excel->getActiveSheet()->setCellValue('H'.$im8, $reloc['impinfo_Are_there_any_items_which_are_already_damaged']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im8.':O'.$im8);
        $this->excel->getActiveSheet()->setCellValue('L'.$im8, $reloc['impinfo_Are_there_any_items_which_are_already_damaged_remarks']);
        // -------------------- im9 -------------------
        $im9=$im8+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im9.':G'.$im9);
        $this->excel->getActiveSheet()->setCellValue('A'.$im9, 'Should goods be collected from more than 1 location');
        $this->excel->getActiveSheet()->mergeCells('H'.$im9.':K'.$im9);
        $this->excel->getActiveSheet()->setCellValue('H'.$im9, $reloc['impinfo_Should_goods_be_collected_from_more_than_one_location']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im9.':O'.$im9);
        $this->excel->getActiveSheet()->setCellValue('L'.$im9, $reloc['impinfo_Should_goods_be_collected_from_more_than_one_location_remarks']);
        // -------------------- im10 -------------------
        $im10=$im9+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im10.':G'.$im10);
        $this->excel->getActiveSheet()->setCellValue('A'.$im10, 'Should goods be delivered to more than 1 location');
        $this->excel->getActiveSheet()->mergeCells('H'.$im10.':K'.$im10);
        $this->excel->getActiveSheet()->setCellValue('H'.$im10, $reloc['impinfo_Should_goods_be_delivered_to_more_than_one_location']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im10.':O'.$im10);
        $this->excel->getActiveSheet()->setCellValue('L'.$im10, $reloc['impinfo_Should_goods_be_delivered_to_more_than_one_location_remarks']);
        // -------------------- im11 -------------------
        $im11=$im10+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$im11.':G'.$im11);
        $this->excel->getActiveSheet()->setCellValue('A'.$im11, 'Do you require Storage	');
        $this->excel->getActiveSheet()->mergeCells('H'.$im11.':K'.$im11);
        $this->excel->getActiveSheet()->setCellValue('H'.$im11, $reloc['impinfo_Do_you_require_Storage']);
        $this->excel->getActiveSheet()->mergeCells('L'.$im11.':O'.$im11);
        $this->excel->getActiveSheet()->setCellValue('L'.$im11, $reloc['impinfo_Do_you_require_Storage_remarks']);
        
        // ----------------------  Does you have any special needs or concerns ------------------
        $nd1=$im11+2;
        $this->excel->getActiveSheet()->mergeCells('A'.$nd1.':O'.$nd1);
        $this->excel->getActiveSheet()->getStyle('A'.$nd1)->applyFromArray($background_color);
        $this->excel->getActiveSheet()->getStyle('A'.$nd1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$nd1)->applyFromArray($font_heading);
        $this->excel->getActiveSheet()->getStyle('A'.$nd1)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('A'.$nd1,' Does you have any special needs or concerns ');

        // ------------------------ nd2 ------------------------------
        $nd2=$nd1+1;
        $nd22=$nd1+6;
        $this->excel->getActiveSheet()->mergeCells('A'.$nd2.':O'.$nd22);
       

        
        //  --------------------  End Download excel ------------------

        $filename=$reloc['orderno'].'.xls'; //save our workbook as this file name for live
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
        $objWriter->save('php://output');

    }
    
    //  ------------------- end added on 29-11-2022 ----------
    
    public function viewallreports(){
        $this->header();
        $userrole = $this->session->userdata('user_role');
        $data['groups'] = $this->Common_model->groupmenu_report($userrole);
        $data['pages'] = $this->Common_model->pagesubmenu_report($userrole);
        $data['reoptscnt'] = $this->Common_model->totalreportscount();
        // echo "<PRE>";print_r($data);exit();
        $this->load->view('reports/viewallreports',$data);
        $this->footer();  
    }
    
/*    
    public function getallemployeeagefiftyeight(){
        // $this->header();
        $data['qualified'] = $this->export->agegreaterthanfiftyseven();
        print_r($data);
        // $this->load->view('reports/viewallreports',$data);
        // $this->footer();    
    }
    
*/

    
    public function getallemployeeagefiftyeight(){
        $this->header();
        $data['title']= "Employee Age Greater Than 57";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Age Greater Than 57 and months Greater than 6";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/employeeagemonth',$data);
        $this->footer();    
    }

    public function getallemployeeagefiftyeight_list(){
        $userdata = $this->input->post();
        $data['qualified'] = $this->export->agegreaterthanfiftyseven($userdata);
        $newarr['common'] =$data['qualified'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
        $this->footer();    
    }
    
    public function employeeservicehistory(){
        $this->header();
        $data['title']= "Employee Service History";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Service History";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/empservicehist',$data);
        $this->footer();    
    }

    public function employeeservicehistory_list(){
        $userdata = $this->input->post();
        $data['qualified'] = $this->export->employeeservicehistory($userdata);
        $newarr['common'] =$data['qualified'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
        $this->footer();    
    }
    
     public function employeeage(){
        $this->header();
        $data['title']= "Employee AGE Details";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee AGE Details";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/employeeage',$data);
        $this->footer();    
    }

    public function employeeage_list(){
        $userdata = $this->input->post();
        $data['qualified'] = $this->export->employeeage($userdata);
        $newarr['common'] =$data['qualified'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
        $this->footer();    
    }
    
    
    // ------------ added 31-01-2022 -----------------
    
        public function attendancereport(){
        $this->header();
        $data['title']= "Attendance Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Attendance Month Wise Report";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/attendancereport',$data);
        $this->footer();
	}
 
    public function attendancereportlist(){
        $userdata = $this->input->post();     
        $url="Reports_service/api_employee_attendance_punch_report";
        $res['authresult'] = $this->curl($userdata,$url);
        if( $res['authresult']['status'] !=200){
            //  echo $data = "<b> No Data Found </b>"; die;
             echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }


    public function employee_attendance_punch_details()
    {
        $this->header();
        $data['title']= "Detailed Attendance Punches";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Attendance Punch Details";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/employeeattendancedaywisepunches',$data);
        $this->footer();
    }

    public function employee_attendance_punch_details_list()
    {
        $userdata = $this->input->post();    
        $url="Reports_service/api_employee_attendance_punch_details";
        $res['authresult'] = $this->curl($userdata,$url);
        // echo '<pre>';
        // print_r($res['authresult']['employee_attendance_history']);exit;
        if($res['authresult'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
            // echo $res['authresult']['description']; exit;
        }
        
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $newarr['function_popup'] = 'Y';
        $newarr['function_column'] = 'employee_id';
        $newarr['function_name'] = 'getpopupinfo';
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }
    
    public function getpopupinfo(){
        $userdata = $this->input->post(); 
        $data['info'] = $this->export->getpopupinfo($userdata);
         $this->load->view('reports/excelreports/popupdetails',$data);
    }

    public function employee_attendance_history()
    {
        $this->header();
        $data['title']= "Attendance Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Attendance Report";
        $data['check']=array("attendance_type");
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/employeeattendancereport',$data);
        $this->footer();
    }

    public function employee_attendance_history_list()
    {
        $userdata = $this->input->post();    
        $url="Reports_service/api_employee_attendance_history";
        $res['authresult'] = $this->curl($userdata,$url);
        if($res['authresult'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
            echo $res['authresult']['description']; exit;
        }
        print_r($res);exit;
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }

    public function attendance_absent_report()
    {
        $this->header();
        $data['title']= "Attendance Absent Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Attendance Absent Report";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/Attendance_absentreport',$data);
        $this->footer();
    }

    public function attendance_absent_report_list()
    {
        $userdata = $this->input->post();
        
        // BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $companyId = ($userdata['companyid']) ? $userdata['companyid'] : '';
            $divisionId = ($userdata['divisonid']) ? $userdata['divisonid'] : '';
            $stateId = ($userdata['stateid']) ? $userdata['stateid'] : '';
            $branchId = ($userdata['branchid']) ? $userdata['branchid'] : '';
            
            $permissionsdata = filterMasterDropdownsBasedonEmployeePermissions($companyId, $divisionId, $stateId, $branchId);
            $userdata['companyid'] = $permissionsdata['filter_comp'];
            $userdata['divisonid'] = $permissionsdata['filter_div'];
            $userdata['stateid']   = $permissionsdata['filter_state'];
            $userdata['branchid']  = $permissionsdata['filter_branch'];
        }
        // END BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        $url="Reports_service/api_employee_attendance_absent_report";
        $res['authresult'] = $this->curl($userdata,$url);
        if( $res['authresult']['status'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
            echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }

    public function attendance_present_report()
    {
        $this->header();
        $data['title']= "Attendance Present Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Attendance Present Report";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/Attendance_presentreport',$data);
        $this->footer();
    }

    public function attendance_present_report_list()
    {
        $userdata = $this->input->post();     
        $url="Reports_service/api_employee_attendance_present_report";
        $res['authresult'] = $this->curl($userdata,$url);
        if($res['authresult']['status'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
               echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }

    public function attendance_regulation_report()
    {
        $this->header();
        $data['title']= "Attendance Regulation Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= " Employee Attendance Regulation Report";
        $data['check']=array("attendance_regulation");
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/Attendance_regulationreport',$data);
        $this->footer();
    }

    public function attendance_regulation_report_list()
    {
        $userdata = $this->input->post();   
        // BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $companyId = ($userdata['companyid']) ? $userdata['companyid'] : '';
            $divisionId = ($userdata['divisonid']) ? $userdata['divisonid'] : '';
            $stateId = ($userdata['stateid']) ? $userdata['stateid'] : '';
            $branchId = ($userdata['branchid']) ? $userdata['branchid'] : '';
            
            $permissionsdata = filterMasterDropdownsBasedonEmployeePermissions($companyId, $divisionId, $stateId, $branchId);
            $userdata['companyid'] = $permissionsdata['filter_comp'];
            $userdata['divisonid'] = $permissionsdata['filter_div'];
            $userdata['stateid']   = $permissionsdata['filter_state'];
            $userdata['branchid']  = $permissionsdata['filter_branch'];
        }
        // END BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        $url="Reports_service/api_employee_attendance_regulation_report";
        $res['authresult'] = $this->curl($userdata,$url);
        if( $res['authresult']['status'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
            echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }


    public function attendance_latecomming_report()
    {
        $this->header();
        $data['title']= "Attendance Late Comming Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Attendance Late Comming Report";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/Attendance_latecommingreport',$data);
        $this->footer();
    }

    public function attendance_latecomming_report_list()
    {
        $userdata = $this->input->post();
        // BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $companyId = ($userdata['companyid']) ? $userdata['companyid'] : '';
            $divisionId = ($userdata['divisonid']) ? $userdata['divisonid'] : '';
            $stateId = ($userdata['stateid']) ? $userdata['stateid'] : '';
            $branchId = ($userdata['branchid']) ? $userdata['branchid'] : '';
            
            $permissionsdata = filterMasterDropdownsBasedonEmployeePermissions($companyId, $divisionId, $stateId, $branchId);
            $userdata['companyid'] = $permissionsdata['filter_comp'];
            $userdata['divisonid'] = $permissionsdata['filter_div'];
            $userdata['stateid']   = $permissionsdata['filter_state'];
            $userdata['branchid']  = $permissionsdata['filter_branch'];
        }
        // END BASED ON BRAH PERMISSIONS IT WILL GET THE DATA
        
        $url="Reports_service/api_employee_attendance_latecomming_report";
        $res['authresult'] = $this->curl($userdata,$url);
        if($res['authresult']['status'] !=200){
            // echo $data = "<b> No Data Found </b>"; die;
               echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }

    public function joiningleaving(){
        $this->header();
        $data['title']="Joining and Leaving";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employees Joining and Leaving";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/joiningleaving',$data);
        $this->footer();
	}
 
    public function joiningleavinglist(){
        $userdata = $this->input->post();    
        $url="Reports_service/api_joiningandleaving";
        $res['authresult'] = $this->curl($userdata,$url);
        if($res['authresult']['status'] !=200){
            //  echo $data = "<b> No Data Found </b>"; die;
            echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['employee_attendance_history'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }

    // ----------- end added 31-01-2022 -------------
    
    public function paysheetforonrollemployee(){

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Users list'); // user sheet title name
        $textaligntop = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
            )
         );
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $lstyle = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
        $Rstyle = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        $BStyle = array(
            'borders' => array(
              'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            )
          ); 

        $bottomcolor =  array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '')
                )
            )
        );

        $applycolur = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '#87CEEB'),
                  //6F0F6F
                'size'  => 15,
                )
            );

        //------------------- size declaration of excel columns ------------

        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(11);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(6);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(6);
        // ------------------- a1  heading of excel first line -----------
        
        $logo ='assets/img/logo.png'; // Provide path to your logo file
        $this->excel->getActiveSheet()->mergeCells('B1:B3');

        $this->excel->getActiveSheet()->setCellValue('B1','MAXWELL');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($applycolur);
        $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($style);
        $this->excel->getActiveSheet()->mergeCells('C1:J1');
        $this->excel->getActiveSheet()->getStyle('C1:J1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1:J1')->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('C1', 'PAYROLL SHEET FOR ONROLL EMPLOYEE ');
        $this->excel->getActiveSheet()->mergeCells('K1:N1');
        $this->excel->getActiveSheet()->setCellValue('K1','');

        // ----------------- a2  ----------
        
        $a2= 2;
        $this->excel->getActiveSheet()->setCellValue('A'.$a2, '');
        $this->excel->getActiveSheet()->setCellValue('B'.$a2, '');
        $this->excel->getActiveSheet()->mergeCells('C'.$a2.':J'.$a2);
        $this->excel->getActiveSheet()->getStyle('C'.$a2.':J'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C'.$a2.':J'.$a2)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('C'.$a2, 'MAXWELL LOGISTICS PRIVATE LIMITED');
        $this->excel->getActiveSheet()->setCellValue('k'.$a2, '');
        $this->excel->getActiveSheet()->setCellValue('L'.$a2, 'BRANCH');
        $this->excel->getActiveSheet()->mergeCells('M'.$a2.':N'.$a2);
        $this->excel->getActiveSheet()->getStyle('M'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('M'.$a2,'AHMEDABAD');
        $this->excel->getActiveSheet()->getStyle('M'.$a2)->getAlignment()->setWrapText(true); 
        //$this->excel->getActiveSheet()->getStyle('M'.$a2.':N'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M'.$a2.':N'.$a2)->applyFromArray($Rstyle);

        //-------------------- A3 ---------------------

        $a2= 3;
        $this->excel->getActiveSheet()->setCellValue('A'.$a2, '');
        $this->excel->getActiveSheet()->setCellValue('B'.$a2, '');
        $this->excel->getActiveSheet()->mergeCells('C'.$a2.':J'.$a2);
        $this->excel->getActiveSheet()->getStyle('C'.$a2.':J'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C'.$a2.':J'.$a2)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('C'.$a2, '7TH FLOOR, SURYA TOWERS, S.P.ROAD, SECUNDERABAD -500015');
        $this->excel->getActiveSheet()->setCellValue('k'.$a2, '');
        $this->excel->getActiveSheet()->setCellValue('L'.$a2, 'BR CODE');
        $this->excel->getActiveSheet()->mergeCells('M'.$a2.':N'.$a2);
        //$this->excel->getActiveSheet()->getStyle('M'.$a2.':N'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M'.$a2.':N'.$a2)->applyFromArray($Rstyle);
        $this->excel->getActiveSheet()->setCellValue('M'.$a2,'AHMD');

        // -------------------  A4 ------------------------


        // -------------------- A5 --------------------

        $a2=5;
        $this->excel->getActiveSheet()->setCellValue('B'.$a2, 'PAYSHEET FOR MONTH');
        $this->excel->getActiveSheet()->getStyle('B'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B'.$a2)->applyFromArray($lstyle);
        $this->excel->getActiveSheet()->setCellValue('C'.$a2, 'oct-21');
        $this->excel->getActiveSheet()->getStyle('C'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C'.$a2)->applyFromArray($lstyle);
        
        // ------------------- A6 --------------------

        $a2=6;
        $m1 = $a2+1;
        $this->excel->getActiveSheet()->mergeCells('A'.$a2.':A'.$m1);
        $this->excel->getActiveSheet()->setCellValue('A'.$a2,'Sl.no');
        $this->excel->getActiveSheet()->mergeCells('B'.$a2.':B'.$m1);
        $this->excel->getActiveSheet()->setCellValue('B'.$a2,'EMPLOYEE CODE,NAME DESIGNATION');
        $this->excel->getActiveSheet()->getStyle('B'.$a2)->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->mergeCells('C'.$a2.':C'.$m1);
        $this->excel->getActiveSheet()->setCellValue('C'.$a2,'WORKING DETAILS OF EMPLOYEE');
        $this->excel->getActiveSheet()->getStyle('C'.$a2)->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->mergeCells('D'.$a2.':D'.$m1);
        $this->excel->getActiveSheet()->setCellValue('D'.$a2,'LEAVE AVAILED');
        $this->excel->getActiveSheet()->getStyle('D'.$a2)->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->mergeCells('E'.$a2.':G'.$a2);
        $this->excel->getActiveSheet()->setCellValue('E'.$a2, 'INCOME DETAILS');
        $this->excel->getActiveSheet()->mergeCells('H'.$a2.':I'.$a2);
        $this->excel->getActiveSheet()->setCellValue('H'.$a2, 'DEDUCTION');
        $this->excel->getActiveSheet()->setCellValue('J'.$a2, '');
        $this->excel->getActiveSheet()->mergeCells('K'.$a2.':N'.$a2);
        $this->excel->getActiveSheet()->setCellValue('K'.$a2, 'BALANCE');
        $this->excel->getActiveSheet()->getStyle('A'.$a2.':N'.$m1)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$a2.':N'.$m1)->applyFromArray($style);

        // ----------------------- A7 ------------------

        $a2=7;
        $this->excel->getActiveSheet()->setCellValue('E'.$a2, 'HEAD OF INCOME');
        $this->excel->getActiveSheet()->getStyle('E'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('F'.$a2, 'RATE OF SALAY AMOUNT');
        $this->excel->getActiveSheet()->getStyle('F'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('G'.$a2, 'EARNIGS PAYABLE');
        $this->excel->getActiveSheet()->getStyle('G'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('H'.$a2, 'HEADS');
        $this->excel->getActiveSheet()->setCellValue('I'.$a2, 'AMOUNT');
        $this->excel->getActiveSheet()->setCellValue('J'.$a2, 'NET SALARY PAYABLE');
        $this->excel->getActiveSheet()->getStyle('J'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('K'.$a2, 'STAFF ADV');
        $this->excel->getActiveSheet()->getStyle('K'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('L'.$a2, 'EL');
        $this->excel->getActiveSheet()->setCellValue('M'.$a2, 'CL');
        $this->excel->getActiveSheet()->setCellValue('N'.$a2, 'SL');
        $this->excel->getActiveSheet()->getStyle('A'.$a2.':N'.$a2)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A'.$a2.':N'.$a2)->applyFromArray($style);

        // ----------------------  A8 -----------------

        $a2=8;
        $a3=9;
        $a4=10;
        $a5=11;
        $firstrow = $a2+1;
        $secondrow = $a2+1;
        $thirdrow = $a3+1;
        $this->excel->getActiveSheet()->setCellValue('A'.$a2, '1');
        $this->excel->getActiveSheet()->setCellValue('B'.$a2, '1002  RAJESH NATWARLAL SR.BRANCH MANAGER');
        $this->excel->getActiveSheet()->getStyle('B'.$a2)->applyFromArray($style);
        $this->excel->getActiveSheet()->getStyle('B'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('C'.$a2, 'p:    20.00           S:    4.00                AB:6.00');
        $this->excel->getActiveSheet()->getStyle('C'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('D'.$a2, 'CL-1.00                SL-2 .00                EL -3 .00     ');
        $this->excel->getActiveSheet()->getStyle('D'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('E'.$a2, 'BASIC                                HRA                                  ');
        $this->excel->getActiveSheet()->getStyle('E'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('F'.$a2, '50000.00 40000.00');
        $this->excel->getActiveSheet()->getStyle('F'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('G'.$a2, '50000.00 40000.00');
        $this->excel->getActiveSheet()->getStyle('G'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('H'.$a2, 'PF                          ESI                 PT              TDS        STAFF ADV        MTW        ');
        $this->excel->getActiveSheet()->getStyle('H'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('I'.$a2, '780 .00               88 .00         200.00         00               1500                 00        ');
        $this->excel->getActiveSheet()->getStyle('I'.$a2)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('J'.$a2, '813200.00');
        $this->excel->getActiveSheet()->setCellValue('K'.$a2, '13500.00');
        $this->excel->getActiveSheet()->setCellValue('L'.$a2, '33.5');
        $this->excel->getActiveSheet()->setCellValue('M'.$a2, '1.5');
        $this->excel->getActiveSheet()->setCellValue('N'.$a2, '0.5');
    
        // -------------------- A9 -------------------------
        
        $a2=9;
        $this->excel->getActiveSheet()->setCellValue('A'.$a3, '');
        $this->excel->getActiveSheet()->mergeCells('B'.$a3.':B'.$a4);
        $this->excel->getActiveSheet()->setCellValue('B'.$a3, 'SIGNATURE'); //bottomcolor
        $this->excel->getActiveSheet()->setCellValue('C'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('D'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('F'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('H'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('I'.$a3, '');
        $this->excel->getActiveSheet()->setCellValue('J'.$a3, '');
        $this->excel->getActiveSheet()->mergeCells('K'.$a3.':N'.$a3);
        $this->excel->getActiveSheet()->setCellValue('K'.$a3, 'Bank Details  -Ceque / NEFT');

        // -------------------- A10 ---------------------
     
        $a2=10;
        $this->excel->getActiveSheet()->setCellValue('A'.$a4, '');
        $this->excel->getActiveSheet()->setCellValue('B'.$a4, '');
        $this->excel->getActiveSheet()->setCellValue('C'.$a4, '');
        $this->excel->getActiveSheet()->setCellValue('D'.$a4, '');
        $this->excel->getActiveSheet()->setCellValue('E'.$a4, 'GROSS SALARY'); 
        $this->excel->getActiveSheet()->getStyle('E'.$a4)->getAlignment()->setWrapText(true);  
        $this->excel->getActiveSheet()->setCellValue('F'.$a4, '90000.00');
        $this->excel->getActiveSheet()->setCellValue('G'.$a4, '90000.00');
        $this->excel->getActiveSheet()->setCellValue('H'.$a4, 'DEDUCTION');
        $this->excel->getActiveSheet()->setCellValue('I'.$a4, '80000.00');
        $this->excel->getActiveSheet()->setCellValue('J'.$a4, '81320.00');
        $this->excel->getActiveSheet()->mergeCells('K'.$a4.':N'.$a4);
        $this->excel->getActiveSheet()->setCellValue('K'.$a4, '');
        $this->excel->getActiveSheet()->getStyle('E'.$a4.':J'.$a4)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E'.$a4.':J'.$a4)->applyFromArray($Rstyle);

        $basictot = 140000;
        $hratot = 20000;
        // $a1111 = $basictot . $hratot;
        $pftot = 40000;
        $esitot = 30000;
        $pttot = 50000;
        $tdstot = 60000;
        $staffadv = 70000;
        $mtw = 90000;
        $netsalpayable=12345678;

//   -------------------------- A11 ------------------------
     $a11=11;
        $this->excel->getActiveSheet()->mergeCells('A'.$a11.':D'.$a11);
        $this->excel->getActiveSheet()->setCellValue('A'.$a11, 'GRAND TOTAL');
        $this->excel->getActiveSheet()->getStyle('A'.$a11)->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('E'.$a11, 'BASIC                                HRA                                  ');
        $this->excel->getActiveSheet()->getStyle('E'.$a11)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('F'.$a11, ($basictot .'  '. $hratot) );
        $this->excel->getActiveSheet()->getStyle('F'.$a11)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('G'.$a11, ($basictot .'  '. $hratot) );
        $this->excel->getActiveSheet()->getStyle('G'.$a11)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('H'.$a11, 'PF'.'                '.'ESI'.'                 '.'PT'.'             '.'TDS'.'             '.'STAFF ADV'.'           '.'MTW');
        $this->excel->getActiveSheet()->getStyle('H'.$a11)->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->setCellValue('I'.$a11, ($pftot .'  '. $esitot .'  '. $pttot .'  '. $tdstot .'  '. $staffadv .'  '.$mtw ) );
        $this->excel->getActiveSheet()->getStyle('I'.$a11)->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->setCellValue('J'.$a11, $netsalpayable);
        $this->excel->getActiveSheet()->mergeCells('K'.$a11.':N'.$a11);
        $this->excel->getActiveSheet()->setCellValue('K'.$a11, 'Bank Details -' .'                             '. 'CHEQUE TOTAL ' .'                         '.'NEFT  TOTAL'.'                                 '.  'GRAND TOTAL' ); 
        $this->excel->getActiveSheet()->getStyle('K'.$a11)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K'.$a11)->getAlignment()->setWrapText(true);  

        // ------------- excel ---------------

        $filename='paysheetonrollemployee.xls'; //save our workbook as this file name for live
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
        $objWriter->save('php://output');
    }
    
    
    // --------------------------- added 24-12-2021 ---------
    
public function AttendRegistForMonth(){
    $this->verifylogin();
    $this->header();
    $data['titlehead']=" Attendance Register For MonthWise ";
    $data['controller'] = $this;
    // $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
    $this->load->view('reports/excelreports/AttendRegistForMonth',$data);
    $this->footer();	
}

public function attendancesumarryofmonth(){

    $data = $this->input->get();
    #print_r($data);
    $mnth = $data['attndmonth'];
    $year = $data['attndyear'];
    if(strlen($mnth) == 1){
        $mnth = '0'.$mnth;
    }
    $ym = $year.'_'.$mnth;
    $response = $this->export->getalldetailaddress($data);
    $company = trim($response['cp'][0]->mxcp_name);
    $divsion = trim($response['dv'][0]->mxd_name);
    $state = trim($response['st'][0]->mxst_state);
    $branch = trim($response['br'][0]->mxb_name);
    $address = trim($response['br'][0]->mxb_address);
    $title_data = $divsion.' - '.$state.' - '.$branch;    
    $cleanaddress = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $address);
    
    $attnd = $this->export->monthattendance($data);

    $dateObj   = DateTime::createFromFormat('!m', $mnth);
    $monthName = $dateObj->format('F'); // March
    $d = cal_days_in_month(CAL_GREGORIAN,$mnth,$year);
    $this->load->library('excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Users list'); // user sheet title name
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $lstyle = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
    );
    $BStyle = array(
        'borders' => array(
          'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      ); 

    $Rstyle = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );
   

// ----------------------- added 17-12-2021 ---------------------

    $applycolur = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '#87CEEB'),
            //6F0F6F
            'size'  => 15,
            )
        );

    
    $fontsize = array(
        'font'  => array(
            'size'  => 12,
            )
    );

// ---------------------end added 17-12-2021 --------------------

// ----------------------- For alignment and wraptext --------------
  
    $dtsize = 9;

    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('J')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('M')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('N')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('O')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('P')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('Q')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('R')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('S')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('T')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('U')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('V')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('W')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('X')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('Y')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('Z')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AA')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AB')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AC')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AD')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AE')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AF')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AG')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getColumnDimension('AH')->setWidth($dtsize);
    // $this->excel->getActiveSheet()->getStyle('B')->applyFromArray($style);  
    $this->excel->getActiveSheet()->getStyle('AH')->getAlignment()->setWrapText(true); 

    $this->excel->getActiveSheet()->getStyle('C:AH')->applyFromArray($style);

// ---------------------------- A1 -------------------------------
   
    $this->excel->getActiveSheet()->setCellValue('A1','MAXWELL');
    $this->excel->getActiveSheet()->mergeCells('A1:B4');

    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($applycolur);
    $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($style);
    
    $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($applycolur);
    $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($style);
    $this->excel->getActiveSheet()->setCellValue('C1', $company);
    $this->excel->getActiveSheet()->mergeCells('C1:O1');
    $this->excel->getActiveSheet()->getStyle('C1:O1')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C1:O1')->applyFromArray($style);

//------------------------------------- A2 --------------------------

    $this->excel->getActiveSheet()->setCellValue('A2', '');
    $this->excel->getActiveSheet()->mergeCells('A2:B2');
    $this->excel->getActiveSheet()->setCellValue('C2', $title_data);
    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
    $this->excel->getActiveSheet()->mergeCells('C2:O2');
    $this->excel->getActiveSheet()->getStyle('C2:O2')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C2:O2')->applyFromArray($style);

//------------------------------------- A3 --------------------------

    $this->excel->getActiveSheet()->setCellValue('A3', '');
    $this->excel->getActiveSheet()->mergeCells('A3:B3');
    $this->excel->getActiveSheet()->setCellValue('C3', $cleanaddress );
    $this->excel->getActiveSheet()->mergeCells('C3:O3');
    $this->excel->getActiveSheet()->getStyle('C3:O3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C3:O3')->applyFromArray($style);

// ------------------------------------ A4 -------------------------

    $this->excel->getActiveSheet()->setCellValue('A4', '');
    $this->excel->getActiveSheet()->mergeCells('A4:B4');
    $this->excel->getActiveSheet()->setCellValue('C4', 'ATTENDANCE SUMMARY FOR THE MONTH   '.strtoupper($monthName).' - '.$year .'   AS  ON'. '  '. date('d-m-Y') );
    $this->excel->getActiveSheet()->mergeCells('C4:O4');
    $this->excel->getActiveSheet()->getStyle('C4:O4')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C4:O4')->applyFromArray($style);
    $this->excel->getActiveSheet()->mergeCells('P4:Q4');
    $this->excel->getActiveSheet()->setCellValue('P4', 'Total Days : '.$d );
    $this->excel->getActiveSheet()->getStyle('P4')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('P4:Q4')->applyFromArray($lstyle);

// ------------------------------------ A5 -----------------------

    $row = 5; // 1-based index
    $i = 0;
    $j=3;
    $this->excel->getActiveSheet()->getDefaultColumnDimension('A'.$row.':ZZ'.$row)->setWidth(10);
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, 'Sl No');
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, 'Employee Code,Name,  Designation & Department');
    for ($i=1; $i <= $d; $i++) {  
                $datesm = $i .'-'. $mnth .'-'. $year; 
                $dd = date("d-D", strtotime($datesm) );
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i+1, $row, $dd);
                $h =$i;
    } 
    $h=$i+1;

// ----------------------------------end A5 -----------------------

    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($h, $row, 'Summary of Working and Leaves');

// ------------------------------ A6 -----------------------------


$row = $row+1;
foreach ($attnd as $key => $values) { 
    $dates = explode('~*~',$values->dates); 
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $key+1);
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $values->empid. '                                      '. $values->fullname.'                                               '. $values->designame .'                                          '. $values->deptname);
    $this->excel->getActiveSheet()->getStyle(1,$row)->applyFromArray($Rstyle);  
    $x=0;
        foreach($dates as $key2 => $value1){
            $dd = explode('~',$value1); 
            $pr = explode('-',str_replace("'","",$dd[0]));
            $pr0 = str_replace(",", "", $pr[0]);
            $pr1 = str_replace(",", "", $pr[1]);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($key2+2, $row, $pr0 .'                  '. $pr1 );
            $x++;
        }
        $ph = $values->Public_Holiday;
        $oh = $values->Optional_Holiday;
        $totalsundays = $values->Week_Off;
        $Totalabsent = $values->Absent + $values->First_Half_Absent + $values->Second_Half_Absent;
        $Cl = $values->Casualleave + $values->First_Half_Casualleave + $values->Second_Half_Casualleave;
        $El = $values->Earnedleave + $values->First_Half_Earnedleave + $values->Second_Half_Earnedleave;
        $Sl = $values->Sickleave + $values->First_Half_Sickleave + $values->Second_Half_Sickleave; 
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($x+1, $row, 'WO : '.$totalsundays.'        '.'CL : ' .$Cl .'           '.'EL : '. $El .'             '.'SL : '.$Sl. '              '.'AB : '.$Totalabsent .'           '.'PH : '. $ph .'        '.'OH : '. $oh );
        $row++;
}
    $filename='Attandance_Register.xls'; //save our workbook as this file name for live
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); // no cache
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
    $objWriter->save('php://output');

    }
  
  
  
    public function AttendSummForMonth(){
        $this->verifylogin();
        $this->header();
        $data['titlehead']="Attendance and Leave Summary count for month";
        // $data['cmpmaster'] = $this->Adminmodel->getcompany_master()
        $data['controller'] = $this;
        $this->load->view('reports/excelreports/AttendSummForMonth',$data);
        $this->footer();	
    }



 public function attendance_sumarry(){

        $data = $this->input->get();
        $mnth = $data['attndmonth'];
        $year = $data['attndyear'];
        if(strlen($mnth) == 1){
            $mnth = '0'.$mnth;
        }
        $ym = $year.'_'.$mnth;
        $wo_days = 0;
        $a=[];
        $total_days_of_month = cal_days_in_month(CAL_GREGORIAN,$mnth,$year);
        //----------DAYS LOOP
        for ($day = 1; $day <= $total_days_of_month; $day++) {
            if(strlen($day) == 1){
                $day = '0'.$day;
            }
            $date = $year . "-" . $mnth . "-" . $day;
            $day_type = date('N', strtotime($date)); //----mon = 1....sun =7
            if ($day_type == 7) {
                $a[]="'$date'";
                $wo_days = $wo_days + 1;          
            } 
        }
        $sundaydates =    implode(',', $a );
        $weekdayssundays = $wo_days;

        $response = $this->export->getalldetailaddress($data);
        $company = trim($response['cp'][0]->mxcp_name);
        $divsion = trim($response['dv'][0]->mxd_name);
        $state = trim($response['st'][0]->mxst_state);
        $branch = trim($response['br'][0]->mxb_name);
        $address = trim($response['br'][0]->mxb_address);
        $title_data = $divsion.' - '.$state.' - '.$branch;    
        $cleanaddress = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $address);
        $attnd = $this->export->monthattendance($data , $sundaydates);
        $dateObj   = DateTime::createFromFormat('!m', $mnth);
        $monthName = $dateObj->format('F'); // March
        $d = cal_days_in_month(CAL_GREGORIAN,$mnth,$year);
         
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Users list'); // user sheet title name
        // get all users in array formate
        // $users = $this->export->exportList();
        $listInfo = $this->export->exportList();
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $lstyle = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
         $BStyle = array(
            'borders' => array(
              'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            )
          ); 

// ----------------------- added 17-12-2021 ---------------------

$textaligntop = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
        )
    );
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $lstyle = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
    );
    $Rstyle = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );
    $BStyle = array(
        'borders' => array(
          'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      ); 

    $bottomcolor =  array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '')
            )
        )
    );

    $applycolur = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '#87CEEB'),
              //6F0F6F
            'size'  => 15,
            )
        );

// ---------------------end added 17-12-2021 --------------------

        $width =9;
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
        $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth($width);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth($width+1);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth($width);

        $this->excel->getActiveSheet()->getStyle('A:ZZ')->getAlignment()->setWrapText(true); 


// ------------------------------- A1 ----------------------------
        
        $this->excel->getActiveSheet()->setCellValue('A1','MAXWELL');
        $this->excel->getActiveSheet()->mergeCells('A1:B4');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($applycolur);
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($style);
        $this->excel->getActiveSheet()->setCellValue('C1', $company);
        $this->excel->getActiveSheet()->mergeCells('C1:P1');
        $this->excel->getActiveSheet()->getStyle('C1:P1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1:P1')->applyFromArray($style);

//------------------------------------- A2 --------------------------

        $this->excel->getActiveSheet()->setCellValue('C2', $title_data);
        $this->excel->getActiveSheet()->mergeCells('C2:P2');
        $this->excel->getActiveSheet()->getStyle('C2:P2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C2:P2')->applyFromArray($style);

//------------------------------------- A3 --------------------------

        $this->excel->getActiveSheet()->setCellValue('C3', $cleanaddress);
        $this->excel->getActiveSheet()->mergeCells('C3:P3');
        $this->excel->getActiveSheet()->getStyle('C3:P3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C3:P3')->applyFromArray($style);

// ------------------------------------ A4 -------------------------

        $this->excel->getActiveSheet()->setCellValue('C4', 'LEAVE SUMMARY FOR THE MONTH '.$monthName.' - '.$year .'  AS ON '.'  '. date('d-m-Y'));
        $this->excel->getActiveSheet()->mergeCells('C4:L4');
        $this->excel->getActiveSheet()->getStyle('C4:O4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C4:O4')->applyFromArray($style);
        $this->excel->getActiveSheet()->mergeCells('M4:N4');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Total Days : '.$d);
        $this->excel->getActiveSheet()->getStyle('M4:P4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M4:P4')->applyFromArray($lstyle);

// ------------------------------------ A5 -------------------------
        
        $this->excel->getActiveSheet()->SetCellValue('A5', 'Sl.No');
        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->SetCellValue('B5', 'Employee Code. '.'            '.' Name Designation & Department');
        $this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->SetCellValue('C5', 'Days Present');
        $this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->SetCellValue('D5', 'C.L Acumilate');
        $this->excel->getActiveSheet()->SetCellValue('E5', 'E.L Acumilate');     
        $this->excel->getActiveSheet()->SetCellValue('F5', 'S.L Acumilate');     
        $this->excel->getActiveSheet()->SetCellValue('G5', 'C.L Applied');     
        $this->excel->getActiveSheet()->SetCellValue('H5', 'E.L Applied');     
        $this->excel->getActiveSheet()->SetCellValue('I5', 'S.L Applied');     
        $this->excel->getActiveSheet()->SetCellValue('J5', 'M.L Applied');   
        $this->excel->getActiveSheet()->SetCellValue('K5', 'Absent');      
        $this->excel->getActiveSheet()->SetCellValue('L5', 'WO');      
        $this->excel->getActiveSheet()->SetCellValue('M5', 'Total WO');      
        $this->excel->getActiveSheet()->SetCellValue('N5', 'Total Leaves Used'); 
        $this->excel->getActiveSheet()->getStyle('N5')->getAlignment()->setWrapText(true);    
        $this->excel->getActiveSheet()->SetCellValue('O5', 'Total Leaves Acumilated'); 
        $this->excel->getActiveSheet()->getStyle('O5')->getAlignment()->setWrapText(true);    
        $this->excel->getActiveSheet()->SetCellValue('P5', 'Total Payable Days');    
        $this->excel->getActiveSheet()->getStyle('P5')->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getStyle('A5:P5')->applyFromArray($style);

//   --------------------  A6 ------------------------------------

        $rowCount = 6;
        $i=0;

// ----------------------------------------loop for employees--------------------

        foreach ($attnd as $values) {
            $ph = $values->Public_Holiday;
            $oh = $values->Optional_Holiday;
            $totalsundays = $values->Week_Off;
            $Totalabsent = $values->Absent + $values->First_Half_Absent + $values->Second_Half_Absent;
            $od = '';
            $totpresent = $values->Present + $values->First_Half_Present + $values->Second_Half_Present + $values->First_Half_Present_Cl_Applied + $values->Second_Half_Present_Cl_Applied + $values->First_Half_Present_Sl_Applied + $values->Second_Half_Present_Sl_Applied + $values->First_Half_Present_El_Applied + $values->Second_Half_Present_El_Applied;
            $Cl = $values->Casualleave + $values->First_Half_Casualleave + $values->Second_Half_Casualleave;
            $El = $values->Earnedleave + $values->First_Half_Earnedleave + $values->Second_Half_Earnedleave;
            $Sl = $values->Sickleave + $values->First_Half_Sickleave + $values->Second_Half_Sickleave;
            $coltot = $Cl + $El + $Sl + $Totalabsent + $Ml;
            $coltotpr = $totpresent + $od ;
            $totacum = $values->AcumilatedCL + $values->AcumilatedEL + $values->AcumilatedSL;
            $Ml = $values->CurrentML + $values->First_Half_Matleave + $values->Second_Half_Matleave;
            $totWOdays = $values->WOAbsent + $values->WOfirsthalfAbsent + $values->WOsecondhalfAbsent;
            $i++;
            $totalleaves = 1;
            $totalpayable = 1;
             $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $i );
             $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $values->empid .'                                         '. $values->fullname . '                                              '  .  $values->designame .'                             '.  $values->deptname );
             $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $totpresent);
             $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $values->AcumilatedCL);
             $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $values->AcumilatedEL);
             $this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $values->AcumilatedSL);
             $this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, $Cl);
             $this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, $El);
             $this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, $Sl);
             $this->excel->getActiveSheet()->SetCellValue('J' . $rowCount, $Ml );
             $this->excel->getActiveSheet()->SetCellValue('K' . $rowCount, $Totalabsent);
             $this->excel->getActiveSheet()->SetCellValue('L' . $rowCount, $weekdayssundays );
             $this->excel->getActiveSheet()->SetCellValue('M' . $rowCount, $totWOdays);
             $this->excel->getActiveSheet()->SetCellValue('N' . $rowCount, $coltot );
             $this->excel->getActiveSheet()->SetCellValue('O' . $rowCount, $totacum);
             $this->excel->getActiveSheet()->SetCellValue('P' . $rowCount, $coltotpr );
            $rowCount++;
        }  

         $filename='attendance_summary.xls'; //save our workbook as this file name for live
         header('Content-Type: application/vnd.ms-excel'); //mime type
         header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
         header('Cache-Control: max-age=0'); //no cache
         $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
         $objWriter->save('php://output');
    }
    //-------------------NEW BY SHABABU(30-07-2022)
    public function pf_report()
    {
        $this->header();
        $data['title']= "PF Monthly ECR";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PF Monthly ECR";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/provisional_fund_report',$data); 
        $this->footer();
    }
    public function pf_report_list()
    {
        $userdata = $this->input->post();     
        // echo '<pre>';print_r($userdata);exit;
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "UAN",
                                "MEMBER NAME",
                                "GROSS WAGES",
                                "EPF WAGES",
                                "EPS WAGES",
                                "EDLI WAGES",
                                "EPF CONTRI REMITTED",
                                "EPS CONTRI REMITTED",
                                "EPF EPS DIFF REMITTED",
                                "NCP DAYS",
                                "REFUND OF ADVANCES"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_emp_code",
                                    "mxemp_emp_uan_number as uan",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "sum(mxsal_actual_basic) as epf_wages",
                                    "sum(mxsal_eps_wages) as eps_wages",
                                    "sum(mxsal_edli_wages) as edli_wages",
                                    "sum(mxsal_pf_emp_cont) as epf_cont_remit",
                                    "sum(mxsal_pf_pension_cont) as eps_cont_remit",
                                    "sum(mxsal_pf_comp_cont) as epf_eps_diff_remit",
                                    "sum(mxsal_lop_from_attendance) as ncp_days",
                                    " '' as refund_adv",
                                );
            // $data['orignal_column_names'] = array(
            //                         "uan",
            //                         "name",
            //                         "sum(gross_wages) as gross_wages",
            //                         "sum(epf_wages) as epf_wages",
            //                         "sum(eps_wages) as eps_wages",
            //                         "sum(edli_wages) as edli_wages",
            //                         "sum(epf_cont_remit) as epf_cont_remit",
            //                         "sum(eps_cont_remit) as eps_cont_remit",
            //                         "sum(epf_eps_diff_remit) as epf_eps_diff_remit",
            //                         "sum(ncp_days) as ncp_days",
            //                         "refund_adv",
            //                     );
            // $data['column_names'] = array(
            //                         "mxsal_emp_code",
            //                         "mxemp_emp_uan_number as uan",
            //                         "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
            //                         "mxsal_actual_gross as gross_wages",
            //                         "mxsal_actual_basic as epf_wages",
            //                         "mxsal_eps_wages as eps_wages",
            //                         "mxsal_edli_wages as edli_wages",
            //                         "mxsal_pf_emp_cont as epf_cont_remit",
            //                         "mxsal_pf_comp_cont as eps_cont_remit",
            //                         "mxsal_pf_pension_cont as epf_eps_diff_remit",
            //                         "concat(Absent + First_Half_Absent + Second_Half_Absent) as ncp_days",
            //                         " '' as refund_adv",
            //                     );
            // $data['orignal_column_names'] = array(
            //                         "uan",
            //                         "name",
            //                         "sum(gross_wages) as gross_wages",
            //                         "sum(epf_wages) as epf_wages",
            //                         "sum(eps_wages) as eps_wages",
            //                         "sum(edli_wages) as edli_wages",
            //                         "sum(epf_cont_remit) as epf_cont_remit",
            //                         "sum(eps_cont_remit) as eps_cont_remit",
            //                         "sum(epf_eps_diff_remit) as epf_eps_diff_remit",
            //                         "sum(ncp_days) as ncp_days",
            //                         "refund_adv",
            //                     );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                "",
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                ""
                                             );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_uan_number as uan",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_actual_gross as gross_wages",
                                    "mxsal_actual_basic as epf_wages",
                                    "mxsal_eps_wages as eps_wages",
                                    "mxsal_edli_wages as edli_wages",
                                    "mxsal_pf_emp_cont as epf_cont_remit",
                                    "mxsal_pf_pension_cont as eps_cont_remit",
                                    "mxsal_pf_comp_cont as epf_eps_diff_remit",
                                    "concat(Absent + First_Half_Absent + Second_Half_Absent) as ncp_days",
                                    " '' as refund_adv",
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data($data);
            // echo "<pre> COMMON :";print_r($data['common']);exit();
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                "",
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                ""
                                             );
            }
        }
        // echo '<pre>';print_r($data);exit;
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
        // getjsondata(1,'',$this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data));
        // $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
        // $data['table_data'];
        // $url="Reports_service/api_employee_attendance_absent_report";
        // $res['authresult'] = $this->curl($userdata,$url);
        // if( $res['authresult']['status'] !=200){
        //     // echo $data = "<b> No Data Found </b>"; die;
        //     echo $res['authresult']['description']; exit;
        // }
        // $newarr['common'] = $res['authresult']['employee_attendance_history'];
        // $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }
    public function emp_wise_pt_report()
    {
        $this->header();
        $data['title']= "Employee Wise PT Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PROFESSIONAL TAX EMP WISE";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/emp_wise_pt_report',$data); 
        $this->footer();
    }
    public function emp_wise_pt_report_list()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'PT';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "PT NO.",
                                "MONTH / HALF YEAR / YEARLY",
                                "STATE",
                                "DIVISION",
                                "BRANCH",
                                "EMP CODE",
                                "EMP NAME",
                                "AMOUNT"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "group_concat(mxsal_pt_no SEPARATOR ' ') as ptno",
                                    "'YEARLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_pt as pt_amount"
                                );
            // $data['orignal_column_names'] = array(
            //                         "ptno",
            //                         "status",
            //                         "state",
            //                         "division",
            //                         "branch",
            //                         "mxsal_emp_code",
            //                         "name",
            //                         "sum(pt_amount) as pt_amount"
            //                     );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            // echo "<pre>";print_r($data['common']);exit;
            // echo "<pre>";print_r(array_column($data['common'],'pt_amount'));exit;
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        $total_pt_amount
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_pt_no as ptno",
                                    "'MONTHLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_pt as pt_amount"
                                );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data);                        
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        $total_pt_amount
                                    );
            }
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
    public function summery_of_pt_report()
    {
        $this->header();
        $data['title']= "PROFFESIONAL TAX PAYMETS STATE WISE";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "PROFFESIONAL TAX PAYMETS STATE WISE";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/summery_of_pt_report',$data); 
        $this->footer();
    }
    public function summery_of_pt_report_list()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'PT';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "PT NO.",
                                "MONTH / HALF YEAR / YEARLY",
                                "STATE",
                                "DIVISION",
                                "BRANCH",
                                "TOTAL AMOUNT",
                                "DUE DATE OF PAYMENTS",
                                "DATE OF PAYMENTS"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "group_concat(mxsal_pt_no SEPARATOR ' ') as ptno",
                                    "'YEARLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_pt as pt_amount",
                                    "'' as due_date_of_pay",
                                    "'' as date_of_pay"
                                );
            // $data['orignal_column_names'] = array(
            //                         "ptno",
            //                         "status",
            //                         "state",
            //                         "division",
            //                         "branch",
            //                         "sum(pt_amount) as pt_amount",
            //                         "due_date_of_pay",
            //                         "date_of_pay",
            //                     );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "$total_pt_amount",
                                        "",
                                        ""
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_pt_no as ptno",
                                    "'YEARLY' as status",
                                    "mxst_state as state",
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxsal_pt as pt_amount",
                                    "'' as due_date_of_pay",
                                    "'' as date_of_pay"
                                );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data); 
            if(count($data['common']) > 0){
                $total_pt_amount = array_sum(array_column($data['common'],'pt_amount'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "",
                                        "$total_pt_amount",
                                        "",
                                        ""
                                    );
            }
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
    public function emp_esi_numbers_report()
    {
        $this->header();
        $data['title']= "EMP ESI NUMBERS REPORT";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "EMP ESI NUMBERS REPORT";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/emp_esi_numbers_report',$data); 
        $this->footer();
    }
    public function emp_esi_numbers_report_list()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'ESI';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "DIVISION",
                                "BRANCH",
                                "STATE",
                                "EMP NAME",
                                "ESI NUMBER",
                                "DOJ",
                                "DOE"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxst_state as state",
                                    "mxsal_emp_code as emp_code",
                                    "mxemp_emp_esi_number as esi_no",
                                    "date_format(mxemp_emp_date_of_join, '%d/%m/%Y') as doj",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as doe"
                                );
            // $data['orignal_column_names'] = array(
            //                         "division",
            //                         "branch",
            //                         "state",
            //                         "mxsal_emp_code",
            //                         "esi_no",
            //                         "doj",
            //                         "doe"
                                    
            //                     );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxd_name as division",
                                    "mxb_name as branch",
                                    "mxst_state as state",
                                    "mxsal_emp_code as emp_code",
                                    "mxemp_emp_esi_number as esi_no",
                                    "date_format(mxemp_emp_date_of_join, '%d/%m/%Y') as doj",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as doe"
                                );
            $data['is_attendance'] = 0;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data);                        
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
    public function esi_return_report()
    {
        $this->header();
        $data['title']= "ESI RETURN REPORT";
        $data['titlehead']= "ESI RETURN REPORT";
        $data['excelheading']= "ESI RETURN REPORT";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/esi_return_report',$data); 
        $this->footer();
    }
    public function esi_return_report_list()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'ESI';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "IP Number",
                                "IP Name",
                                "No of Days for which wages paid/payable during the month",
                                "Total Monthly Wages",
                                "Reason Code for Zero workings days",
                                "Last Working Day"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_total_days_from_attendance) as no_of_days",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "mxesi_rsn_code as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            // $data['orignal_column_names'] = array(
            //                         "mxsal_emp_code",
            //                         "esi_no",
            //                         "name",
            //                         "no_of_days",
            //                         "sum(gross_wages) as gross_wages",
            //                         "reason",
            //                         "relieve_date as relieve_date"
                                    
            //                     );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_total_days_from_attendance as no_of_days",
                                    "mxsal_actual_gross as gross_wages",
                                    "mxesi_rsn_code as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data);                        
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }
        // echo"<pre>";print_r($data);exit;
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
    public function bonus_consolidated_report()
    {
        $this->header();
        $data['title']= "BONUS CONSOLITATED REPORT";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "BONUS CONSOLITATED REPORT";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/bonus_consolidated_report',$data); 
        $this->footer();
    }
    public function bonus_consolidated_report_list()
    {
        $userdata = $this->input->post(); 
        $data['statutory_type'] = 'ESI';
        // echo '<pre>';print_r($userdata);exit;
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "IP Number",
                                "IP Name",
                                "No of Days for which wages paid/payable during the month",
                                "Total Monthly Wages",
                                "Reason Code for Zero workings days",
                                "Last Working Day"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "sum(mxsal_total_days_from_attendance) as no_of_days",
                                    "sum(mxsal_actual_gross) as gross_wages",
                                    "0 as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            // $data['orignal_column_names'] = array(
            //                         "mxsal_emp_code",
            //                         "esi_no",
            //                         "name",
            //                         "no_of_days",
            //                         "sum(gross_wages) as gross_wages",
            //                         "reason",
            //                         "relieve_date as relieve_date"
                                    
            //                     );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxemp_emp_esi_number as esi_no",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxsal_total_days_from_attendance as no_of_days",
                                    "mxsal_actual_gross as gross_wages",
                                    "0 as reason",
                                    "date_format(mxemp_emp_resignation_relieving_date, '%d/%m/%Y') as relieve_date"
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            
            $data['common'] = $this->export->get_paysheet_data($data);   
            if(count($data['common']) > 0){
                $total_no_of_days = array_sum(array_column($data['common'],'no_of_days'));
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $data['footer_column_names'] = array(
                                        "",
                                        "",
                                        "",
                                        "$total_no_of_days",
                                        "$total_gross_amount",
                                        "",
                                        ""
                                    );
            }
        }
        
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
    }
    
    //-------------------END NEW BY SHABABU(30-07-2022)


    // --------------------- Added on 09-10-2022 ----------------

    
    public function yearlyleave(){
        $this->verifylogin();
        $this->header();
        $data['title']="Leave Encashment For The Year";
        $data['titlehead']= "Leave Encashment For The Year";
        $data['excelheading']= "Yearly Leave Encashment";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/yearlyleave_record',$data);
        $this->footer();
    }

    public function yearlyleave_list(){
        $userdata = $this->input->post();
        $res['authresult']=$this->export->yearlyleave_list($userdata);
        if( $res['authresult']['status'] != 200){
            echo $res['authresult']['description']; exit;
        }
        $newarr['common'] = $res['authresult']['leave_encashment'];
        $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }
    
    
    // --------------------  End Added on 09-10-2022 ------------
    
    
    // -----------  added 24-10-2022 ----------
    
    
    public function stafflist(){
        $this->verifylogin();
        $this->header();
        $data['title']="STAFF LIST  FOR  MAXWELL LOGISTICS PVT. LTD., ";
        $data['titlehead']= "STAFF LIST  FOR  MAXWELL LOGISTICS PVT. LTD., ";
        $data['excelheading']= "STAFF LIST  FOR  MAXWELL LOGISTICS PVT. LTD., ";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/stafflist',$data);
        $this->footer();
    }

    public function staff_record_list(){
        $join=[];
        $userdata = $this->input->get(); 
        // Array ( [attndyear] => 10-2022 [finacial_month_year] => [esi_company_id] => 1 [esi_div_id] => 1 [esi_state_id] => 0 [esi_branch_id] => 0 )
        $divid = $userdata['esi_div_id'];
        $stateid = $userdata['esi_state_id'];
        if($divid != 0){
            $divname = $this->export->divisionname($divid);
        }else{
            $divname ='';
        }
        if($stateid != 0){
             $statename = $this->export->statename($stateid);
        }else{
            $statename = '';
        }
        $staff_list=$this->export->staff($userdata);
        
        $tablename='maxwell_employees_info';
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('STAFF LIST '); // user sheet title name
        
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
    
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);

        // -----------------------  A1  ---------------------

        $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style);
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->setCellValue('A1','STAFF LIST  FOR  MAXWELL LOGISTICS PVT. LTD., ');
        $this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

        //  ---------------------  A2  -------------------

        //  ---------------------  A3  -------------------

        $a3=3;
        $this->excel->getActiveSheet()->setCellValue('B'.$a3,'DIVISION :');
        $this->excel->getActiveSheet()->setCellValue('C'.$a3, $divname);
                $this->excel->getActiveSheet()->getStyle('C'.$a3)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('E'.$a3.':F'.$a3);
        $this->excel->getActiveSheet()->setCellValue('E'.$a3,'STATE :');
        $this->excel->getActiveSheet()->setCellValue('G'.$a3, $statename);
                $this->excel->getActiveSheet()->getStyle('G'.$a3)->getFont()->setBold(true);

        // $this->excel->getActiveSheet()->setCellValue('I'.$a3,'BRANCH');

        //  ---------------------  A4  -------------------

        //  ---------------------  A5  -------------------
        // $a5=5;
        // $this->excel->getActiveSheet()->mergeCells('B'.$a5.':C'.$a5);
        // $this->excel->getActiveSheet()->setCellValue('B'.$a5,'TYPE OF EMP');

        // $this->excel->getActiveSheet()->mergeCells('H'.$a5.':I'.$a5);
        // $this->excel->getActiveSheet()->setCellValue('H'.$a5,'AS ON : 31.03.2022');

        //  ---------------------  A6  -------------------
        $a6=6;

        $this->excel->getActiveSheet()->setCellValue('A'.$a6,'S.NO.');
        $this->excel->getActiveSheet()->setCellValue('B'.$a6,'EMP.CODE');
        $this->excel->getActiveSheet()->setCellValue('C'.$a6,'BRANCH/STAFF NAME');
        $this->excel->getActiveSheet()->setCellValue('D'.$a6,'QUALIFICATION');
        $this->excel->getActiveSheet()->setCellValue('E'.$a6,'AGE');
        $this->excel->getActiveSheet()->setCellValue('F'.$a6,'APPT-DATE');
        $this->excel->getActiveSheet()->setCellValue('G'.$a6,'TOTAL EXP.');
        $this->excel->getActiveSheet()->setCellValue('H'.$a6,'DESIGNATION');
        $this->excel->getActiveSheet()->setCellValue('I'.$a6,'BASIC');
        $this->excel->getActiveSheet()->setCellValue('J'.$a6,'HRA & OA');
        $this->excel->getActiveSheet()->setCellValue('K'.$a6,'TOTAL');
        $this->excel->getActiveSheet()->getStyle('A'.$a6.':K'.$a6)->getFont()->setBold(true);
        $a11=7;
        foreach($staff_list as $key1=>$val1){
            $total = '';
            $genempcount= 0;
            $traempcount=0;
            $totsal=0;
            $emptotsal =0;
            $trtotsal =0;
            $generalemp='';
            $tranieedata='';  
            $alltotsal=0;
            $join = array('maxwell_designation_master','mxdesg_id','mxemp_emp_desg_code','INNER');
            $column=array('mxemp_emp_id','mxemp_emp_fname','mxemp_emp_lname','mxemp_emp_date_of_join','mxemp_emp_desg_code','mxemp_emp_current_salary');
            $where = array('mxemp_emp_resignation_status'=>'W','mxemp_emp_branch_code'=>$val1->mxemp_emp_branch_code);
            $traniee = array('mxemp_emp_resignation_status'=>'W','mxemp_emp_type'=>5,'mxemp_emp_branch_code'=>$val1->mxemp_emp_branch_code);
            if(sizeof($join)>=4){
                $column[]='mxdesg_name';
            }

            if($userdata['esi_div_id'] !=0){
                $where['mxemp_emp_division_code']=$userdata['esi_div_id']; 
            }
    
            if($userdata['esi_branch_id'] !=0){
                $where['mxemp_emp_branch_code']=$userdata['esi_branch_id'];
            }
    
            if($userdata['esi_state_id'] !=0){
                $where['mxemp_emp_state_code']=$userdata['esi_state_id'];
            }

            if($userdata['esi_div_id'] !=0){ //divisonid
                $traniee['mxemp_emp_division_code']=$userdata['esi_div_id']; 
            }
    
            if($userdata['esi_branch_id'] !=0){  //branchid
                $traniee['mxemp_emp_branch_code']=$userdata['esi_branch_id'];
            }
    
            if($userdata['esi_state_id'] !=0){  //stateid
                $traniee['mxemp_emp_state_code']=$userdata['esi_state_id'];
            }
           
                $generalemp=getcommonquerydata($tablename,$column, $where,$join); 
                //  ----------------------- A7 ------------------
                $a7=$a11;
                if(!empty($generalemp)){
                    $a7=$a11+1;
                    $this->excel->getActiveSheet()->mergeCells('A'.$a7.':K'.$a7);
                    $this->excel->getActiveSheet()->setCellValue('A'.$a7,strtoupper($val1->mxb_name).' '.'BRANCH'); // ---- branchname
                    $this->excel->getActiveSheet()->getStyle('A'.$a7.':K'.$a7)->getFont()->setBold(true);
                }

                // -----------------------  A8 -----------------
                $a8= $a7+1; 
                if(!empty($generalemp)){
                    $genempcount= count($generalemp);
                    foreach($generalemp as $genkey=>$gval){
                        $column=array('mxemp_emp_id','mxemp_emp_fname','mxemp_emp_lname','mxemp_emp_date_of_join','mxemp_emp_desg_code','mxemp_emp_current_salary');
                        $where = array('mxemp_emp_resignation_status'=>'W','mxemp_emp_branch_code'=>$val1->mxemp_emp_branch_code);
            
                        // $empedu = geteducationqualification('maxwell_employees_academic_records',array('mxemp_emp_acr_type','mxemp_emp_acr_employee_id','mxemp_emp_acr_id','mxemp_emp_acr_type','mxemp_emp_acr_subject'),array('mxemp_emp_acr_employee_id'=>$gval->mxemp_emp_id),array('mxemp_emp_acr_id'));

                        $basic = intval(round($gval->mxemp_emp_current_salary/2));
                        $hra = intval(round($gval->mxemp_emp_current_salary/2));
                        $this->excel->getActiveSheet()->setCellValue('A'.$a8,$genkey+1);                         
                        $this->excel->getActiveSheet()->setCellValue('B'.$a8,$gval->mxemp_emp_id);
                        $this->excel->getActiveSheet()->setCellValue('C'.$a8,$gval->mxemp_emp_fname. ' '.$gval->mxemp_emp_lname);
                        // if(!empty($empedu)){
                        //     $this->excel->getActiveSheet()->setCellValue('D'.$a8,$empedu[0]->mxemp_emp_acr_type.'  ('.$empedu[0]->mxemp_emp_acr_subject .')');
                        // }else{
                            $this->excel->getActiveSheet()->setCellValue('D'.$a8,''); 
                        // }
                        $this->excel->getActiveSheet()->setCellValue('E'.$a8,'');
                        $this->excel->getActiveSheet()->setCellValue('F'.$a8,$gval->mxemp_emp_date_of_join);
                        $this->excel->getActiveSheet()->setCellValue('G'.$a8,'');
                        $this->excel->getActiveSheet()->setCellValue('H'.$a8,$gval->mxdesg_name);
                        $this->excel->getActiveSheet()->setCellValue('I'.$a8,$basic);
                        $this->excel->getActiveSheet()->setCellValue('J'.$a8,$hra);
                        $this->excel->getActiveSheet()->setCellValue('K'.$a8,$gval->mxemp_emp_current_salary);
                        $emptotsal += $gval->mxemp_emp_current_salary;
                        $a8++;
                    }
                } 

                // ----------------- $a9----------
                $tranieedata = getcommonquerydata($tablename,$column, $traniee,$join);
                $a10=$a8;
                if(sizeof($tranieedata)>0){
                    $a10=$a8+1;
                    $this->excel->getActiveSheet()->mergeCells('A'.$a10.':K'.$a10);
                    $this->excel->getActiveSheet()->setCellValue('A'.$a10,'TRAINEES   ');
                    $this->excel->getActiveSheet()->getStyle('A'.$a10.':K'.$a10)->getFont()->setBold(true);
                }
                $a9= $a10;
                if(sizeof($tranieedata)>0){
                    $a9= $a10+1;
                    $traempcount=count($tranieedata);
                    foreach($tranieedata as $tkey=>$tval){
                        // $tredu = geteducationqualification('maxwell_employees_academic_records',array('mxemp_emp_acr_type','mxemp_emp_acr_employee_id','mxemp_emp_acr_id','mxemp_emp_acr_type','mxemp_emp_acr_subject'),array('mxemp_emp_acr_employee_id'=>$tval->mxemp_emp_id),array('mxemp_emp_acr_id'));

                        $tbasic = intval(round($tval->mxemp_emp_current_salary/2));
                        $thra = intval(round($tval->mxemp_emp_current_salary/2));
                        
                        $this->excel->getActiveSheet()->setCellValue('A'.$a9,$tkey+1);
                        $this->excel->getActiveSheet()->setCellValue('B'.$a9,$tval->mxemp_emp_id);
                        $this->excel->getActiveSheet()->setCellValue('C'.$a9,$tval->mxemp_emp_fname. ' '.$tval->mxemp_emp_lname);
                        // if(!empty($tredu)){
                        //     $this->excel->getActiveSheet()->setCellValue('D'.$a9,$tredu[0]->mxemp_emp_acr_type.'  ('.$tredu[0]->mxemp_emp_acr_subject .')');
                        // }else{
                            $this->excel->getActiveSheet()->setCellValue('D'.$a9,''); 
                        // }
                        $this->excel->getActiveSheet()->setCellValue('D'.$a9,'');
                        $this->excel->getActiveSheet()->setCellValue('E'.$a9,'');
                        $this->excel->getActiveSheet()->setCellValue('F'.$a9,$tval->mxemp_emp_date_of_join);
                        $this->excel->getActiveSheet()->setCellValue('G'.$a9,'');
                        $this->excel->getActiveSheet()->setCellValue('H'.$a9,$tval->mxdesg_name);
                        $this->excel->getActiveSheet()->setCellValue('I'.$a9,$tbasic);
                        $this->excel->getActiveSheet()->setCellValue('J'.$a9,$thra);
                        $this->excel->getActiveSheet()->setCellValue('K'.$a9,$tval->mxemp_emp_current_salary);
                        $trtotsal += $tval->mxemp_emp_current_salary;
                    $a9++;
                    }
                }

                // ----------------- $a11----------
                $total = $genempcount + $traempcount;
                $alltotsal = $emptotsal + $trtotsal;
                $a11=$a9;
                if($total !=0){
                    $a11=$a9+1;
                    $this->excel->getActiveSheet()->mergeCells('A'.$a11.':C'.$a11);
                    $this->excel->getActiveSheet()->setCellValue('A'.$a11,'    TOTAL OF EMPLOYEES  :  '.$total);
                    if($genempcount != 0){
                        $this->excel->getActiveSheet()->mergeCells('D'.$a11.':F'.$a11);
                        $this->excel->getActiveSheet()->setCellValue('D'.$a11,'    TOTAL ON Roll  :  '.$genempcount);
                    }
                    if($traempcount != 0){
                        $this->excel->getActiveSheet()->mergeCells('G'.$a11.':H'.$a11);
                        $this->excel->getActiveSheet()->setCellValue('G'.$a11,'    TOTAL OF TRAINEE  :  '.$traempcount);
                    }
                    if($alltotsal != 0){
                        $this->excel->getActiveSheet()->mergeCells('I'.$a11.':J'.$a11);
                        $this->excel->getActiveSheet()->setCellValue('I'.$a11,'   TOTAL SALARY   :  '); 
                        $this->excel->getActiveSheet()->setCellValue('k'.$a11,$alltotsal); 
                    }
                    $this->excel->getActiveSheet()->getStyle('A'.$a11.':K'.$a11)->getFont()->setBold(true);
                }
                $a11 = $a11+2;
           
        }  
      
        $filename='Staff_List.xls'; //save our workbook as this file name for live
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
        $objWriter->save('php://output');
    
    }
    
    //  --------- end added 24-10-2022 --------
    
    public function tds_report()
    {
        $this->header();
        $data['title']= "TDS Report";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "TDS SALARY WISE";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/tds_salary_format',$data); 
        $this->footer();
    }
    
    public function tds_report_list_bkp()
    {
        $userdata = $this->input->post();     
        // echo '<pre>';print_r($userdata);exit;
        $data['statutory_type'] = 'PF';
        $data['userdata']  = $userdata;
        $data['headings']  = array(
                                "SNO",
                                "Month",
                                "Employee code",
                                "Name as per adhar",
                                "PAN",
                                "UAN  NO.",
                                "Designation",
                                "DOB",
                                "DOJ",
                                "DOL",
                                "Basic",
                                "HRA",
                                "MISC INCOME",
                                "Incentive",
                                "Others 1",
                                "Others 2",
                                "Total Salary",
                                "PF",
                                "ESI",
                                "PT",
                                "TDS",
                                "Staff Advance",
                                "MTW",
                                "Others 1",
                                "Total Deductions",
                                "Net Salary",
                                "LTA",
                                "Mediclaim",
                                "Bonus",
                                "Grand Total"
                             );
        if($userdata['is_finanical']){//--->FOR FINANCIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_year_month as yearmonth",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxemp_emp_panno as pan",
                                    "mxemp_emp_uan_number as uan",
                                    "mxdesg_name as desg_name",
                                    "mxemp_emp_date_of_birth as dob",
                                    "mxemp_emp_date_of_join as doj",
                                    "mxemp_emp_resignation_relieving_date as dol",
                                    "mxsal_actual_basic as basic",
                                    "mxsal_actual_hra as hra",
                                    "mxsal_incentive_amount as misc_income",
                                    "'' as incenti_amount",
                                    "'' as others_1",
                                    "'' as others_2",
                                    "mxsal_actual_gross as total_sal",
                                    "mxsal_pf_emp_cont as pf",
                                    "mxsal_esi_emp_cont as esi",
                                    "mxsal_pt as pt",
                                    "mxsal_tds_amount as tds",
                                    "mxsal_loan_amount as staff_advance",
                                    "'' as mtw",
                                    "'' as otherss_1",
                                    "mxsal_total_ded as total_deduction",
                                    "mxsal_net_sal as net_sal",
                                    "mxsal_lta_amount as lta_amount",
                                    "mxsal_mediclaim_amount as mediclaim_amount",
                                    "mxsal_bonus_percentage_amount as bonus",
                                    "mxsal_ctc as grand_total"
                                );
            
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data_financial_year($data);
            if(count($data['common']) > 0){
                $data['footer_column_names'] = array();
            }
        }else if($userdata['is_quaterly']){
             $data['column_names'] = array(
                                        "mxsal_year_month as yearmonth",
                                        "mxsal_emp_code as emp_code",
                                        "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                        "mxemp_emp_panno as pan",
                                        "mxemp_emp_uan_number as uan",
                                        "mxdesg_name as desg_name",
                                        "mxemp_emp_date_of_birth as dob",
                                        "mxemp_emp_date_of_join as doj",
                                        "mxemp_emp_resignation_relieving_date as dol",
                                        "mxsal_actual_basic as basic",
                                        "mxsal_actual_hra as hra",
                                        "mxsal_incentive_amount as misc_income",
                                        "'' as incenti_amount",
                                        "'' as others_1",
                                        "'' as others_2",
                                        "mxsal_actual_gross as total_sal",
                                        "mxsal_pf_emp_cont as pf",
                                        "mxsal_esi_emp_cont as esi",
                                        "mxsal_pt as pt",
                                        "mxsal_tds_amount as tds",
                                        "mxsal_loan_amount as staff_advance",
                                        "'' as mtw",
                                        "'' as otherss_1",
                                        "mxsal_total_ded as total_deduction",
                                        "mxsal_net_sal as net_sal",
                                        "mxsal_lta_amount as lta_amount",
                                        "mxsal_mediclaim_amount as mediclaim_amount",
                                        "mxsal_bonus_percentage_amount as bonus",
                                        "mxsal_ctc as grand_total"
                                    );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data_quaterly($data);
            if(count($data['common']) > 0){
                $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array(
                                                "",
                                                "",
                                                "",
                                                "$total_gross_amount",
                                                "$total_epf_wages",
                                                "$total_eps_wages",
                                                "$total_edli_wages",
                                                "$total_epf_cont",
                                                "$total_eps_cont",
                                                "$total_epf_eps_diff",
                                                "$total_ncp_days",
                                                ""
                                             );
            }
        }else{//----->NON FINACIAL YEAR
            $data['column_names'] = array(
                                    "mxsal_year_month as yearmonth",
                                    "mxsal_emp_code as emp_code",
                                    "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                                    "mxemp_emp_panno as pan",
                                    "mxemp_emp_uan_number as uan",
                                    "mxdesg_name as desg_name",
                                    "mxemp_emp_date_of_birth as dob",
                                    "mxemp_emp_date_of_join as doj",
                                    "mxemp_emp_resignation_relieving_date as dol",
                                    "mxsal_actual_basic as basic",
                                    "mxsal_actual_hra as hra",
                                    "mxsal_incentive_amount as misc_income",
                                    "'' as incenti_amount",
                                    "'' as others_1",
                                    "'' as others_2",
                                    "mxsal_actual_gross as total_sal",
                                    "mxsal_pf_emp_cont as pf",
                                    "mxsal_esi_emp_cont as esi",
                                    "mxsal_pt as pt",
                                    "mxsal_tds_amount as tds",
                                    "mxsal_loan_amount as staff_advance",
                                    "'' as mtw",
                                    "'' as otherss_1",
                                    "mxsal_total_ded as total_deduction",
                                    "mxsal_net_sal as net_sal",
                                    "mxsal_lta_amount as lta_amount",
                                    "mxsal_mediclaim_amount as mediclaim_amount",
                                    "mxsal_bonus_percentage_amount as bonus",
                                    "mxsal_ctc as grand_total"
                                );
            $data['is_attendance'] = 1;//----->FOR GETTING ATTENDANCE TABLE DATA IN PAYSHEET
            $data['common'] = $this->export->get_paysheet_data($data);                        
            if(count($data['common']) > 0){
                // $total_gross_amount = array_sum(array_column($data['common'],'gross_wages'));
                // $total_epf_wages = array_sum(array_column($data['common'],'epf_wages'));
                // $total_eps_wages = array_sum(array_column($data['common'],'eps_wages'));
                // $total_edli_wages = array_sum(array_column($data['common'],'edli_wages'));
                // $total_epf_cont = array_sum(array_column($data['common'],'epf_cont_remit'));
                // $total_eps_cont = array_sum(array_column($data['common'],'eps_cont_remit'));
                // $total_epf_eps_diff = array_sum(array_column($data['common'],'epf_eps_diff_remit'));
                // $total_ncp_days = array_sum(array_column($data['common'],'ncp_days'));
                $data['footer_column_names'] = array();
            }
        }
        // echo "<pre>";print_r($data);exit;
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
        // getjsondata(1,'',$this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data));
        // $this->load->view('reports/excelreports/dynamic_paysheet_excellist',$data);
        
        // $data['table_data'];
        // $url="Reports_service/api_employee_attendance_absent_report";
        // $res['authresult'] = $this->curl($userdata,$url);
        // if( $res['authresult']['status'] !=200){
        //     // echo $data = "<b> No Data Found </b>"; die;
        //     echo $res['authresult']['description']; exit;
        // }
        // $newarr['common'] = $res['authresult']['employee_attendance_history'];
        // $this->load->view('reports/excelreports/dynamicexcellist',$newarr);
    }


    /* NEW TDS REPORT based on Requirements *
     * Developer : Varaprasad
     * Developed on: 14-Mar-2026
    */

    public function tds_report_list()
    {
        $userdata = $this->input->post();
        $data['userdata'] = $userdata;

        $selected_type = isset($userdata['statutory_type']) ? $userdata['statutory_type'] : '';
        $data['statutory_type'] = $selected_type;

        $data['is_consolidated'] = isset($userdata['is_consolidated']) ? $userdata['is_consolidated'] : 0;
        $data['is_finanical'] = isset($userdata['is_finanical']) ? $userdata['is_finanical'] : 0;
        $data['is_attendance'] = 1;

        $is_professional = (strpos($selected_type, ',') === false && $selected_type != "") ? true : false;

        if ($is_professional) {
            $data['headings'] = array(
                "SNO", "Month", "Division", "Branch", "State",
                "Professional Code", "Name", "Department", "Designation", 'PAN',
                "Email Id", "RATE OF CONSULTANCY CHARGES PER MONTH", "PROFESSIONAL CHARGES", "TDS", "NET AMOUNT"
            );

            $is_cons = ($data['is_consolidated'] == 1);

            $data['column_names'] = array(
                ($is_cons ? "'Consolidated' as yearmonth" : "mxsal_year_month as yearmonth"),
                "mxd_name as division",
                "mxb_name as branch",
                "mxst_state as state",
                "mxsal_emp_code as emp_id",
                "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                "mxdpt_name as dept",
                "mxdesg_name as desg",
                "mxemp_emp_panno as pan",
                "mxemp_emp_email_id as email",

                ($is_cons ? "SUM(mxsal_gross_sal)" : "mxsal_gross_sal") . " as rate_per_month",
                ($is_cons ? "SUM(mxsal_actual_prof_charges)" : "mxsal_actual_prof_charges") . " as prof_charges",
                ($is_cons ? "SUM(mxsal_tds_amount)" : "mxsal_tds_amount") . " as tds",
                ($is_cons ? "SUM(mxsal_net_sal)" : "mxsal_net_sal") . " as net"
            );
        } else {
            $data['headings'] = array(
                "SNO", "Month", "Employee code", "Name as per adhar", "PAN",
                "UAN NO.", "Designation", "DOB", "DOJ", "DOL",
                "Basic", "HRA", "MISC INCOME", "Incentive", "Others 1",
                "Others 2", "Total Salary", "PF", "ESI", "PT",
                "TDS", "Staff Advance", "MTW", "Others 1", "Total Deductions",
                "Net Salary", "LTA", "Mediclaim", "Bonus", "Grand Total"
            );

            $is_cons = ($data['is_consolidated'] == 1);

            $data['column_names'] = array(
                ($is_cons ? "'Consolidated' as yearmonth" : "mxsal_year_month as yearmonth"),
                "mxsal_emp_code as emp_code",
                "concat(mxemp_emp_fname,' ',mxemp_emp_lname) as name",
                "mxemp_emp_panno as pan",
                "mxemp_emp_uan_number as uan",
                "mxdesg_name as desg_name",
                "mxemp_emp_date_of_birth as dob",
                "mxemp_emp_date_of_join as doj",
                "mxemp_emp_resignation_relieving_date as dol",

                ($is_cons ? "SUM(mxsal_actual_basic)" : "mxsal_actual_basic") . " as basic",
                ($is_cons ? "SUM(mxsal_actual_hra)" : "mxsal_actual_hra") . " as hra",
                ($is_cons ? "SUM(mxsal_incentive_amount)" : "mxsal_incentive_amount") . " as misc_income",
                "'' as incenti_amount", "'' as others_1", "'' as others_2",
                ($is_cons ? "SUM(mxsal_actual_gross)" : "mxsal_actual_gross") . " as total_sal",
                ($is_cons ? "SUM(mxsal_pf_emp_cont)" : "mxsal_pf_emp_cont") . " as pf",
                ($is_cons ? "SUM(mxsal_esi_emp_cont)" : "mxsal_esi_emp_cont") . " as esi",
                ($is_cons ? "SUM(mxsal_pt)" : "mxsal_pt") . " as pt",
                ($is_cons ? "SUM(mxsal_tds_amount)" : "mxsal_tds_amount") . " as tds",
                ($is_cons ? "SUM(mxsal_loan_amount)" : "mxsal_loan_amount") . " as staff_advance",
                "'' as mtw", "'' as otherss_1",
                ($is_cons ? "SUM(mxsal_total_ded)" : "mxsal_total_ded") . " as total_deduction",
                ($is_cons ? "SUM(mxsal_net_sal)" : "mxsal_net_sal") . " as net_sal",
                ($is_cons ? "SUM(mxsal_lta_amount)" : "mxsal_lta_amount") . " as lta_amount",
                ($is_cons ? "SUM(mxsal_mediclaim_amount)" : "mxsal_mediclaim_amount") . " as mediclaim_amount",
                ($is_cons ? "SUM(mxsal_bonus_percentage_amount)" : "mxsal_bonus_percentage_amount") . " as bonus",
                ($is_cons ? "SUM(mxsal_ctc)" : "mxsal_ctc") . " as grand_total"
            );
        }


        if($data['is_consolidated'] == 1) {
            $data['filename'] = ($is_professional ? "Prof_" : "") . "Consolidated_TDS_Report_" . date('Y_m_d') . ".xlsx";
            $data['excelheading'] = ($is_professional ? "Professional " : "") . "Consolidated TDS Report";
            $data['common'] = $this->export->get_tds_consolidated_main_only($data);
        } else if($data['is_finanical'] == 1) {
            $data['filename'] = ($is_professional ? "Prof_" : "") . "Financial_Year_TDS_Report_" . date('Y_m_d') . ".xlsx";
            $data['excelheading'] = ($is_professional ? "Professional " : "") . "Financial Year TDS Report";
            $data['common'] = $this->export->get_paysheet_data_financial_year_tds($data);
        } else {
            $data['filename'] = "Monthly_TDS_Report_" . date('Y_m_d') . ".xlsx";
            $data['excelheading'] = "Monthly TDS Report";
            $data['common'] = $this->export->get_paysheet_data($data);
        }

        $data['titlehead'] = $data['excelheading'];
        $data['footer_column_names'] = array();
        $this->load->view('reports/excelreports/dynamic_paysheet_excellist', $data);
    }
    
    // NEW BY SHABABU(23-03-2025)
     public function paysheet_report(){
        $this->verifylogin();
		$this->header();
		$data['cmpmaster'] = $this->Adminmodel->getcompany_master();
		// $data['emptypedetails'] = $this->Adminmodel->getemployeetypemasterdetails($id = '');
		$this->load->view('Salaries/paysheet_report',$data);
		$this->footer();	
	}
    // END NEW BY SHABABU(23-03-2025)


    /** Employees Leave Report
     * DEVELOPED BY : VARAPRASAD
     * ON : 08022026
     **/

    public function employeesleavereport(){
        $this->verifylogin();
        $this->header();
        $data['title']="Employees Leave Report";
        $data['titlehead']= "Employees Leave Report";
        $data['excelheading']= "Employees Leave Report";
        $data['check']="";
        $data['controller1'] = $this;
        $this->load->view('reports/excelreports/employees_leave_report',$data);
        $this->footer();
    }

    /** Employees Leave Report
     * DEVELOPED BY : VARAPRASAD
     * ON : 08022026
     **/
    public function employeesleavereport_ajax() {
        $userdata = $this->input->post();
        $res = $this->export->get_employee_leaves_data($userdata);

        if ($res['status'] != 200) {
            echo '<div class="alert alert-danger">'.$res['description'].'</div>';
            exit;
        }

        $raw_data = $res['data'];
        $isSingle = !empty($userdata['employeeid']);

        $currentMonth = date('m');
        $currentYear = date('Y');

        $raw_data = array_filter($raw_data, function($row) use ($currentMonth, $currentYear) {
            return !($row['MonthNumber'] == $currentMonth && $row['YearName'] == $currentYear);
        });

        $prev_year_el = 0;
        if (!empty($userdata['employeeid'])) {
            $first_year = (int)$res['data'][0]['YearName'];
            $prev_year_el = $this->export->get_specific_year_el($userdata['employeeid'], ($first_year));
        }

          // echo "<pre>".$prev_year_el;print_r($res['data']);exit();

        // 1. NEAT HEADER INFO
        $header_info = [];
        if (count($raw_data) > 0) {
            $header_info = [
                'employee_name' => $raw_data[0]['EmployeeName'],
                'employee_code' => $raw_data[0]['EmployeeID'],
                'designation'   => $raw_data[0]['Designation'] ?? '--',
                'doj'           => $raw_data[0]['DOJ'] ?? '--',
                'dob'           => $raw_data[0]['DOB'] ?? '--',
                'branch'        => $raw_data[0]['Branch'] ?? 'ALL BRANCHES',
                'report_title'  => "LEAVE REGISTER"
            ];
        }

        // 2. PROCESS BUSINESS LOGIC
        $processed_rows = [];

        // Load Loan Details for the specific employee if single
        $loan_bal = 0;
        if ($isSingle) {
            $this->load->model('Loan_model');
            $loan = $this->Loan_model->getloandetails_payslip($userdata['employeeid']);
            $loan_bal = isset($loan[0]) ? (float)$loan[0]->mxemploan_emp_loan_outstanding_amt : 0;
        }

        // echo "<pre>";print_r($raw_data);exit();

        $lastEL = 0;
        foreach ($raw_data as $row) {
            $lv = (object)$row;

            $availEL = (!empty($lv->HistoricalEL)) ? (float)$lv->HistoricalEL : (float)($lv->CurrentEL ?? 0);
            $availCL = (!empty($lv->HistoricalCL)) ? (float)$lv->HistoricalCL : (float)($lv->CurrentCL ?? 0);
            $availSL = (!empty($lv->HistoricalSL)) ? (float)$lv->HistoricalSL : (float)($lv->CurrentSL ?? 0);
            $lastEL = $availEL;

            // Ensure MonthNumber is available for calculation
            $mNum = (!empty($lv->MonthNumber)) ? $lv->MonthNumber : date('m', strtotime($lv->MonthName));

            // Use the total days from the query (more accurate for specific join dates)
            $totalDaysInMonth = $lv->Totaldays;

            // REAL INTELLIGENCE: Calculate Present Days ($present)
            $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present +
                $lv->regulation_full_day + $lv->First_Half_regulation + $lv->Second_Half_regulation +
                $lv->First_Half_Shortleave + $lv->Second_Half_Shortleave +
                $lv->ot_full_day + $lv->First_Half_ot + $lv->Second_Half_ot;

            // Calculate Holidays ($ph_oh) including Occasional
            $computed_ph_oh = $lv->Public_Holiday + $lv->First_Half_Public_Holiday + $lv->Second_Half_Public_Holiday +
                $lv->Optional_Holiday + $lv->First_Half_Optional_Holiday + $lv->Second_Half_Optional_Holiday +
                $lv->occasional_full_day + $lv->First_Half_occasional + $lv->Second_Half_occasional;

            // Calculate Leaves Used (CL, SL, EL, ML)
            $CL_Used = $lv->Casualleave + $lv->First_Half_Casualleave + $lv->Second_Half_Casualleave;
            $SL_Used = $lv->Sickleave + $lv->First_Half_Sickleave + $lv->Second_Half_Sickleave;
            $EL_Used = $lv->Earnedleave + $lv->First_Half_Earnedleave + $lv->Second_Half_Earnedleave;
            $ML_Used = $lv->Meternityleave + $lv->First_Half_Meternityleave + $lv->Second_Half_Meternityleave;

            // Total Paid Days formula
            $pay_days = $present + $lv->Week_Off + $computed_ph_oh + $CL_Used + $SL_Used + $EL_Used + $ML_Used;

            // LOP calculation (Days in Month - Paid Days)
            $lop = $totalDaysInMonth - $pay_days;

            // Mixed-Half Handling for Absent and Short Leave
            $total_absent = $lv->Absent + $lv->First_Half_Absent + $lv->Second_Half_Absent;
            $total_short  = $lv->Shortleave + $lv->First_Half_Shortleave + $lv->Second_Half_Shortleave;

            $final_row = [
                'Year'          => $lv->YearName,
                'Month'         => $lv->MonthName,
                'Present'       => $present,
                'W.Off'         => $lv->Week_Off,
                'Holidays'      => $computed_ph_oh,
                'CL_Avail'      => $availCL,
                'CL_Used'       => $CL_Used,
                'PL_Avail'      => $availEL,
                'PL_Used'       => $EL_Used,
                'SL_Avail'      => $availSL,
                'SL_Used'       => $SL_Used,
                'Matr'          => $ML_Used,
                'LOP'           => $lop,
                'Abst'          => $total_absent,
                'Shrt'          => $total_short,
                'Total_Paid'    => $pay_days,
                'lastEL'  => $lastEL
            ];

            $processed_rows[] = $final_row;
        }

        $encashment_data = null;
        if ($isSingle && !empty($raw_data)) {
            $reportYear = $raw_data[0]['YearName'];
            // Fetch the financial data
            $encashment_data = $this->export->get_encashment_summary($userdata['employeeid'], $reportYear);
        }

        $lastEL = $lastEL;

        //echo "<pre>".$reportYear;print_r($encashment_data);exit();

        $newarr['header'] = $header_info;
        $newarr['common'] = $processed_rows;
        $newarr['prev_year_el'] = $prev_year_el;
        $newarr['encashment'] = $encashment_data;
        $newarr['lastEL'] = $lastEL;
        // echo "<pre>";print_r($newarr);exit();

        $this->load->view('reports/excelreports/dynamic_leave_report_excellist', $newarr);
    }

    /** Employees Leave Report Export to Excel
     * DEVELOPED BY : VARAPRASAD
     * ON : 08022026
     **/

    public function employeesleavereport_excel() {
        $userdata = $this->input->post();
        $res = $this->export->get_employee_leaves_data($userdata);
        $raw_data = $res['data'];

        if (empty($raw_data)) {
            die("No data available for export.");
        }

        $currentMonth = date('m');
        $currentYear = date('Y');
        $filtered_data = array_filter($raw_data, function($row) use ($currentMonth, $currentYear) {
            return !($row['MonthNumber'] == $currentMonth && $row['YearName'] == $currentYear);
        });

        $encashment_data = null;
        if (!empty($userdata['employeeid']) && !empty($raw_data)) {
            $encashment_data = $this->export->get_encashment_summary($userdata['employeeid'], $raw_data[0]['YearName']);
        }

        $prev_year_el = 0;
        if (!empty($userdata['employeeid'])) {
            $first_year = (int)$raw_data[0]['YearName'];
            $prev_year_el = $this->export->get_specific_year_el($userdata['employeeid'], ($first_year));
        }

        // SYNC BALANCE B/F LOGIC WITH AJAX
        $prevYearBF = isset($encashment_data['el_balance_cf']) && ($prev_year_el > $encashment_data['el_balance_cf']) ? 30 : $prev_year_el;

        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

        // --- STYLING (Preserved) ---
        $styleBoldHeader = [
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
        ];
        $styleTableHead = [
            'font' => ['bold' => true, 'size' => 10],
            'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]],
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false]
        ];
        $styleBorder = [
            'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]],
            'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
            'font' => ['size' => 10]
        ];

        // --- SET MANUAL WIDTHS ---
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);
        foreach(range('C', 'P') as $col) { $sheet->getColumnDimension($col)->setWidth(9); }
        $sheet->getColumnDimension('Q')->setWidth(45);

        // --- HEADINGS ---
        $sheet->mergeCells('A1:Q1'); $sheet->setCellValue('A1', 'MAXWELL LOGISTICS PVT.LIMITED');
        $sheet->getStyle('A1')->applyFromArray($styleBoldHeader);
        $sheet->mergeCells('A2:Q2'); $sheet->setCellValue('A2', 'LEAVE REGISTER');
        $sheet->getStyle('A2')->applyFromArray($styleBoldHeader);

        // --- EMPLOYEE DETAILS ---
        $sheet->getStyle('A3:Q4')->getFont()->setBold(true);
        $sheet->setCellValue('A3', 'Name of Employee :'); $sheet->mergeCells('C3:F3'); $sheet->setCellValue('C3', $raw_data[0]['EmployeeName']);
        $sheet->setCellValue('G3', 'Designation:'); $sheet->mergeCells('I3:L3'); $sheet->setCellValue('I3', $raw_data[0]['Designation']);
        $sheet->setCellValue('M3', 'Employee Code :'); $sheet->mergeCells('O3:Q3'); $sheet->setCellValue('O3', $raw_data[0]['EmployeeID']);
        $sheet->setCellValue('A4', 'Date of Joining :'); $sheet->setCellValue('C4', $raw_data[0]['DOJ']);
        $sheet->setCellValue('G4', 'Date of Birth :'); $sheet->setCellValue('I4', $raw_data[0]['DOB']);
        $sheet->setCellValue('M4', 'BRANCH:'); $sheet->mergeCells('O4:Q4'); $sheet->setCellValue('O4', $raw_data[0]['Branch']);

        // --- TABLE HEADERS ---
        $sheet->mergeCells('A5:A6'); $sheet->setCellValue('A5', 'YEAR');
        $sheet->mergeCells('B5:B6'); $sheet->setCellValue('B5', 'MONTH');
        $sheet->mergeCells('C5:E5'); $sheet->setCellValue('C5', 'ATTENDANCE');
        $sheet->mergeCells('F5:G5'); $sheet->setCellValue('F5', 'C.L.');
        $sheet->mergeCells('H5:I5'); $sheet->setCellValue('H5', 'P.L. (EL)');
        $sheet->mergeCells('J5:K5'); $sheet->setCellValue('J5', 'S.L.');
        $sheet->mergeCells('L5:L6'); $sheet->setCellValue('L5', 'MATR.');
        $sheet->mergeCells('M5:M6'); $sheet->setCellValue('M5', 'LOP'); // Renamed LWP to LOP
        $sheet->mergeCells('N5:N6'); $sheet->setCellValue('N5', 'ABST.');
        $sheet->mergeCells('O5:O6'); $sheet->setCellValue('O5', 'SHRT.');
        $sheet->mergeCells('P5:P6'); $sheet->setCellValue('P5', "TOTAL PAID");
        $sheet->mergeCells('Q5:Q6'); $sheet->setCellValue('Q5', 'Remarks');

        $sheet->setCellValue('C6', 'PRST'); $sheet->setCellValue('D6', 'W.OFF'); $sheet->setCellValue('E6', 'PH');
        $sheet->setCellValue('F6', 'USED'); $sheet->setCellValue('G6', 'AVAIL');
        $sheet->setCellValue('H6', 'USED'); $sheet->setCellValue('I6', 'AVAIL');
        $sheet->setCellValue('J6', 'USED'); $sheet->setCellValue('K6', 'AVAIL');
        $sheet->getStyle('A5:Q6')->applyFromArray($styleTableHead);

        // --- PINK BALANCE B/F ROW ---
        $sheet->setCellValue('B7', 'Balance B/F.');
        $sheet->setCellValue('I7', $prevYearBF);
        $sheet->getStyle('A7:Q7')->applyFromArray($styleBorder);
        $sheet->getStyle('A7:Q7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FCE4EC');
        $sheet->getStyle('A7:Q7')->getFont()->getColor()->setRGB('FF0000');
        $sheet->getStyle('A7:Q7')->getFont()->setBold(true);

        // --- DATA LOOP INITIALIZATION ---
        $rowNum = 8;
        $years = [];
        $lastEL = 0;

        // Totals Accumulators
        $t_prst = 0; $t_woff = 0; $t_ph = 0;
        $t_cl_u = 0; $t_el_u = 0; $t_sl_u = 0;
        $t_matr = 0; $t_lop = 0; $t_abst = 0; $t_shrt = 0; $t_paid = 0;

        foreach ($filtered_data as $row) {
            $lv = (object)$row;
            $years[] = $lv->YearName;
            $availEL = (!empty($lv->HistoricalEL)) ? (float)$lv->HistoricalEL : (float)($lv->CurrentEL ?? 0);
            $availCL = (!empty($lv->HistoricalCL)) ? (float)$lv->HistoricalCL : (float)($lv->CurrentCL ?? 0);
            $availSL = (!empty($lv->HistoricalSL)) ? (float)$lv->HistoricalSL : (float)($lv->CurrentSL ?? 0);
            $lastEL = $availEL;

            $present = (float)$lv->Present + (float)$lv->First_Half_Present + (float)$lv->Second_Half_Present + (float)$lv->regulation_full_day + (float)$lv->First_Half_regulation + (float)$lv->Second_Half_regulation + (float)$lv->First_Half_Shortleave + (float)$lv->Second_Half_Shortleave + (float)$lv->ot_full_day + (float)$lv->First_Half_ot + (float)$lv->Second_Half_ot;
            $ph_oh = (float)$lv->Public_Holiday + (float)$lv->First_Half_Public_Holiday + (float)$lv->Second_Half_Public_Holiday + (float)$lv->Optional_Holiday + (float)$lv->First_Half_Optional_Holiday + (float)$lv->Second_Half_Optional_Holiday + (float)$lv->occasional_full_day + (float)$lv->First_Half_occasional + (float)$lv->Second_Half_occasional;
            $cl_used = (float)$lv->Casualleave + (float)$lv->First_Half_Casualleave + (float)$lv->Second_Half_Casualleave;
            $sl_used = (float)$lv->Sickleave + (float)$lv->First_Half_Sickleave + (float)$lv->Second_Half_Sickleave;
            $el_used = (float)$lv->Earnedleave + (float)$lv->First_Half_Earnedleave + (float)$lv->Second_Half_Earnedleave;
            $ml_used = (float)$lv->Meternityleave + (float)$lv->First_Half_Meternityleave + (float)$lv->Second_Half_Meternityleave;

            $lop = (float)($lv->Totaldays) - ($present + (float)$lv->Week_Off + $ph_oh + $cl_used + $sl_used + $el_used + $ml_used);
            $abst = (float)$lv->Absent + (float)$lv->First_Half_Absent + (float)$lv->Second_Half_Absent;
            $shrt = (float)$lv->Shortleave + (float)$lv->First_Half_Shortleave + (float)$lv->Second_Half_Shortleave;
            $totalPaid = $present + (float)$lv->Week_Off + $ph_oh + $cl_used + $sl_used + $el_used + $ml_used;

            // Accumulate totals
            $t_prst += $present; $t_woff += (float)$lv->Week_Off; $t_ph += $ph_oh;
            $t_cl_u += $cl_used; $t_el_u += $el_used; $t_sl_u += $sl_used;
            $t_matr += $ml_used; $t_lop += $lop; $t_abst += $abst; $t_shrt += $shrt; $t_paid += $totalPaid;

            $sheet->setCellValue('B'.$rowNum, $lv->MonthName);
            $sheet->setCellValue('C'.$rowNum, $present);
            $sheet->setCellValue('D'.$rowNum, $lv->Week_Off);
            $sheet->setCellValue('E'.$rowNum, $ph_oh);
            $sheet->setCellValue('F'.$rowNum, $cl_used ?: 0);
            $sheet->setCellValue('G'.$rowNum, $availCL);
            $sheet->setCellValue('H'.$rowNum, $el_used ?: 0);
            $sheet->setCellValue('I'.$rowNum, $availEL);
            $sheet->setCellValue('J'.$rowNum, $sl_used ?: 0);
            $sheet->setCellValue('K'.$rowNum, $availSL);
            $sheet->setCellValue('L'.$rowNum, $ml_used ?: 0);
            $sheet->setCellValue('M'.$rowNum, $lop);
            $sheet->setCellValue('N'.$rowNum, $abst);
            $sheet->setCellValue('O'.$rowNum, $shrt);
            $sheet->setCellValue('P'.$rowNum, $totalPaid);

            // Remarks logic (Consistent with AJAX View)
            $index = $rowNum - 7;
            if ($index == 2) {
                $sheet->setCellValue('Q'.$rowNum, 'Balance B/F: ' . $prevYearBF);
                $sheet->getStyle('Q'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FCE4EC');
            } elseif ($index == 6) {
                $cf_val = isset($encashment_data['el_balance_cf']) && ($lastEL > $encashment_data['el_balance_cf']) ? 30 : $lastEL;
                $sheet->setCellValue('Q'.$rowNum, 'Balance C/F: ' . $cf_val);
                $sheet->getStyle('Q'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFF9C4');
            } elseif ($index == 9) {
                $sheet->setCellValue('Q'.$rowNum, 'Leave Encashed On:');
            } elseif ($index == 10) {
                $amt = isset($encashment_data['leave_encashment_amount']) ? number_format($encashment_data['leave_encashment_amount'], 0) : "0";
                $sheet->setCellValue('Q'.$rowNum, 'Amount Paid Rs.: ' . $amt);
            } elseif ($index == 11) {
                $cf_amt = isset($encashment_data['leave_amount_carry_forward']) ? number_format($encashment_data['leave_amount_carry_forward'], 0) : "0";
                $sheet->setCellValue('Q'.$rowNum, 'Leave Amount Carry Forward: ' . $cf_amt);
            }

            $sheet->getStyle('A'.$rowNum.':Q'.$rowNum)->applyFromArray($styleBorder);
            $rowNum++;
        }

        // --- YEAR VERTICAL LABEL & FOOTER ---
        if(!empty($years)) {
            $sheet->mergeCells('A8:A'.($rowNum-1));
            $sheet->setCellValue('A8', implode(' & ', array_unique($years)));
            $sheet->getStyle('A8')->applyFromArray($styleBoldHeader)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setTextRotation(90);
        }

        $cf_val = $lastEL;
        $sheet->setCellValue('Q13', 'Balance C/F: ' . $cf_val);
        $sheet->getStyle('Q13')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFF9C4');

        // FOOTER TOTALS
        $sheet->mergeCells('A'.$rowNum.':B'.$rowNum);
        $sheet->setCellValue('A'.$rowNum, 'Total >>>>>>>>>>');
        $sheet->setCellValue('C'.$rowNum, $t_prst);
        $sheet->setCellValue('D'.$rowNum, $t_woff);
        $sheet->setCellValue('E'.$rowNum, $t_ph);
        $sheet->setCellValue('F'.$rowNum, $t_cl_u);
        $sheet->setCellValue('H'.$rowNum, $t_el_u);
        $sheet->setCellValue('I'.$rowNum, $lastEL); // P.L. Avail Total is the last EL
        $sheet->getStyle('I'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFF9C4');
        $sheet->setCellValue('J'.$rowNum, $t_sl_u);
        $sheet->setCellValue('L'.$rowNum, $t_matr);
        $sheet->setCellValue('M'.$rowNum, $t_lop);
        $sheet->setCellValue('N'.$rowNum, $t_abst);
        $sheet->setCellValue('O'.$rowNum, $t_shrt);
        $sheet->setCellValue('P'.$rowNum, $t_paid);

        $sheet->getStyle('A'.$rowNum.':Q'.$rowNum)->applyFromArray($styleBorder)->getFont()->setBold(true);

        // --- OUTPUT ---
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Leave_Register_'.($userdata['employeeid']??'Report').'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /** Employees Leave Report Export to PDF
     * DEVELOPED BY : VARAPRASAD
     * ON : 08022026
     **/

    public function employeesleavereport_pdf() {
        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');

        $userdata = $this->input->post();
        $res = $this->export->get_employee_leaves_data($userdata);
        $raw_data = $res['data'];

        if (empty($raw_data)) {
            die("No data available for export.");
        }

        $currentMonth = date('m');
        $currentYear = date('Y');
        $filtered_data = array_filter($raw_data, function($row) use ($currentMonth, $currentYear) {
            return !($row['MonthNumber'] == $currentMonth && $row['YearName'] == $currentYear);
        });

         // echo "<pre>".count($filtered_data);print_r($filtered_data);exit();

        $encashment_data = null;
        if (!empty($userdata['employeeid']) && !empty($raw_data)) {
            $encashment_data = $this->export->get_encashment_summary($userdata['employeeid'], $raw_data[0]['YearName']);
        }

        $prev_year_el = 0;
        if (!empty($userdata['employeeid'])) {
            $first_year = (int)$raw_data[0]['YearName'];
            $prev_year_el = $this->export->get_specific_year_el($userdata['employeeid'], ($first_year));
        }

        $prevYearBF = isset($encashment_data['el_balance_cf']) && ($prev_year_el > $encashment_data['el_balance_cf']) ? 30 : $prev_year_el;

        $pdf = new TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();

        $lastEL = 0;
        $t_prst = 0; $t_woff = 0; $t_ph = 0;
        $t_cl_u = 0; $t_el_u = 0; $t_sl_u = 0;
        $t_matr = 0; $t_lop = 0; $t_abst = 0; $t_shrt = 0; $t_paid = 0;

        $html = '
<style>
    table { width: 100%; border-collapse: collapse; border: 0.5pt solid black; }
    th { border: 0.5pt solid black; font-size: 8pt; font-weight: bold; text-align: center; background-color: #f2f2f2; vertical-align: middle; line-height: 1.5; }
    td { border: 0.5pt solid black; font-size: 8pt; text-align: center; vertical-align: middle; line-height: 1.8; }
    .bg-pink { background-color: #FCE4EC; color: #FF0000; font-weight: bold; }
    .bg-green { background-color: #C8E6C9; color: #000000; }
    .bg-yellow { background-color: #FFF9C4; }
    .text-left { text-align: left; padding-left: 3px; }
</style>

<table cellpadding="2">
    <tr><td colspan="17" style="font-weight:bold; text-align:center; border:none; line-height: 1;"><h2>MAXWELL LOGISTICS PVT.LIMITED</h2></td></tr>
    <tr><td colspan="17" style="font-weight:bold; text-align:center; border:none; line-height: 1;"><h3>LEAVE REGISTER</h3></td></tr>
    <tr>
        <td colspan="6" class="text-left" style="font-weight:bold;">Name of Employee : ' . $raw_data[0]['EmployeeName'] . '</td>
        <td colspan="6" class="text-left" style="font-weight:bold;">Designation: ' . $raw_data[0]['Designation'] . '</td>
        <td colspan="5" class="text-left" style="font-weight:bold;">Employee Code : ' . $raw_data[0]['EmployeeID'] . '</td>
    </tr>
    <tr>
        <td colspan="6" class="text-left" style="font-weight:bold;">Date of Joining : ' . $raw_data[0]['DOJ'] . '</td>
        <td colspan="6" class="text-left" style="font-weight:bold;">Date of Birth : ' . $raw_data[0]['DOB'] . '</td>
        <td colspan="5" class="text-left" style="font-weight:bold;">BRANCH: ' . $raw_data[0]['Branch'] . '</td>
    </tr>
    <thead>
        <tr>
            <th rowspan="2" width="5%">YEAR</th>
            <th rowspan="2" width="7%">MONTH</th>
            <th colspan="3" width="12%">ATTENDANCE</th>
            <th colspan="2" width="8%">C.L.</th>
            <th colspan="2" width="8%">P.L. (EL)</th>
            <th colspan="2" width="8%">S.L.</th>
            <th rowspan="2" width="4%">MATR.</th>
            <th rowspan="2" width="4%">LOP</th>
            <th rowspan="2" width="4%">ABST.</th>
            <th rowspan="2" width="4%">SHRT.</th>
            <th rowspan="2" width="6%">TOTAL PAID</th>
            <th rowspan="2" width="30%">Remarks</th>
        </tr>
        <tr>
            <th width="4%">PRST</th><th width="4%">W.OFF</th><th width="4%">PH</th>
            <th width="4%">USED</th><th width="4%">AVAIL</th>
            <th width="4%">USED</th><th width="4%">AVAIL</th>
            <th width="4%">USED</th><th width="4%">AVAIL</th>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-pink">
            <td width="5%"></td>
            <td width="7%" class="text-left">Balance B/F.</td>
            <td width="4%"></td><td width="4%"></td><td width="4%"></td>
            <td width="4%"></td><td width="4%"></td>
            <td width="4%"></td><td width="4%">' . $prevYearBF . '</td> 
            <td width="4%"></td><td width="4%"></td>
            <td width="4%"></td><td width="4%"></td><td width="4%"></td><td width="4%"></td>
            <td width="6%"></td>
            <td width="30%"></td>
        </tr>';

        $i = 0;
        $row_count = count($filtered_data);
        $uniqueYears = array_unique(array_column($filtered_data, 'YearName'));
        sort($uniqueYears);

        foreach ($filtered_data as $row) {
            $i++;
            $present = (float)$row['Present'] + (float)$row['First_Half_Present'] + (float)$row['Second_Half_Present'] + (float)$row['regulation_full_day'] + (float)$row['First_Half_regulation'] + (float)$row['Second_Half_regulation'] + (float)$row['First_Half_Shortleave'] + (float)$row['Second_Half_Shortleave'] + (float)$row['ot_full_day'] + (float)$row['First_Half_ot'] + (float)$row['Second_Half_ot'];
            $ph_oh = (float)$row['Public_Holiday'] + (float)$row['First_Half_Public_Holiday'] + (float)$row['Second_Half_Public_Holiday'] + (float)$row['Optional_Holiday'] + (float)$row['First_Half_Optional_Holiday'] + (float)$row['Second_Half_Optional_Holiday'] + (float)$row['occasional_full_day'] + (float)$row['First_Half_occasional'] + (float)$row['Second_Half_occasional'];
            $cl_used = (float)$row['Casualleave'] + (float)$row['First_Half_Casualleave'] + (float)$row['Second_Half_Casualleave'];
            $sl_used = (float)$row['Sickleave'] + (float)$row['First_Half_Sickleave'] + (float)$row['Second_Half_Sickleave'];
            $el_used = (float)$row['Earnedleave'] + (float)$row['First_Half_Earnedleave'] + (float)$row['Second_Half_Earnedleave'];
            $ml_used = (float)$row['Meternityleave'] + (float)$row['First_Half_Meternityleave'] + (float)$row['Second_Half_Meternityleave'];

            $availEL = (!empty($row['HistoricalEL'])) ? (float)$row['HistoricalEL'] : (float)($row['CurrentEL'] ?? 0);
            $availCL = (!empty($row['HistoricalCL'])) ? (float)$row['HistoricalCL'] : (float)($row['CurrentCL'] ?? 0);
            $availSL = (!empty($row['HistoricalSL'])) ? (float)$row['HistoricalSL'] : (float)($row['CurrentSL'] ?? 0);
            $lastEL = $availEL;
            $totalPaid = $present + (float)$row['Week_Off'] + $ph_oh + $cl_used + $sl_used + $el_used + $ml_used;
            $lop = (float)($row['Totaldays']) - $totalPaid;
            $abst = (float)$row['Absent'] + (float)$row['First_Half_Absent'] + (float)$row['Second_Half_Absent'];
            $shrt = (float)$row['Shortleave'] + (float)$row['First_Half_Shortleave'] + (float)$row['Second_Half_Shortleave'];

            $t_prst += $present; $t_woff += (float)$row['Week_Off']; $t_ph += $ph_oh;
            $t_cl_u += $cl_used; $t_el_u += $el_used; $t_sl_u += $sl_used;
            $t_matr += $ml_used; $t_lop += $lop; $t_abst += $abst; $t_shrt += $shrt; $t_paid += $totalPaid;

            $html .= '<tr>';
            if ($i == 1) {
                $html .= '<td width="5%" rowspan="' . $row_count . '" style="vertical-align:middle;">' . implode('<br>&<br>', $uniqueYears) . '</td>';
            }

            $html .= '
            <td width="7%">' . $row['MonthName'] . '</td>
            <td width="4%">' . number_format($present, 1) . '</td>
            <td width="4%">' . $row['Week_Off'] . '</td>
            <td width="4%">' . $ph_oh . '</td>
            <td width="4%">' . ($cl_used ?: 0) . '</td>
            <td width="4%">' . ($availCL) . '</td>
            <td width="4%">' . ($el_used ?: 0) . '</td>
            <td width="4%">' . $availEL . '</td>
            <td width="4%">' . ($sl_used ?: 0) . '</td>
            <td width="4%">' . ($availSL) . '</td>
            <td width="4%">' . ($ml_used ?: 0) . '</td>
            <td width="4%">' . $lop . '</td>
            <td width="4%">' . $abst . '</td>
            <td width="4%">' . $shrt . '</td>
            <td width="6%" style="font-weight:bold;">' . $totalPaid . '</td>';

            $remark_text = '';
            $remark_class = '';
            if ($i == 2) {
                $remark_class = ' class="bg-green text-left"';
                $remark_text = 'Balance B/F: ' . $prevYearBF;
            } elseif ($i == 6) {
                $cf_val = $filtered_data[$row_count-1]['HistoricalEL'];
                $remark_class = ' class="bg-yellow text-left"';
                $remark_text = 'Balance C/F: ' . $cf_val;
            } elseif ($i == 9) {
                $remark_class = ' class="text-left"';
                $remark_text = 'Leave Encashed On: ';
            } elseif ($i == 10) {
                $amt = isset($encashment_data['leave_encashment_amount']) ? number_format($encashment_data['leave_encashment_amount'], 0) : "0";
                $remark_class = ' class="text-left"';
                $remark_text = 'Amount Paid Rs.: ' . $amt;
            } elseif ($i == 11) {
                $cf_amt = isset($encashment_data['leave_amount_carry_forward']) ? number_format($encashment_data['leave_amount_carry_forward'], 0) : "0";
                $remark_class = ' class="text-left"';
                $remark_text = 'Leave Amount Carry Forward: ' . $cf_amt;
            }

            $html .= '<td width="30%"' . $remark_class . '>' . $remark_text . '</td>';
            $html .= '</tr>';
        }

        $html .= '
        <tr style="font-weight:bold;">
            <td colspan="2" style="text-align:right;">Total >>>>>>>>>> </td>
            <td width="4%">' . number_format($t_prst, 1) . '</td>
            <td width="4%">' . $t_woff . '</td>
            <td width="4%">' . $t_ph . '</td>
            <td width="4%">' . $t_cl_u . '</td>
            <td width="4%"></td>
            <td width="4%">' . $t_el_u . '</td>
            <td width="4%" class="bg-yellow">' . $lastEL . '</td>
            <td width="4%">' . $t_sl_u . '</td>
            <td width="4%"></td>
            <td width="4%">' . $t_matr . '</td>
            <td width="4%">' . $t_lop . '</td>
            <td width="4%">' . $t_abst . '</td>
            <td width="4%">' . $t_shrt . '</td>
            <td width="6%">' . $t_paid . '</td>
            <td width="30%"></td>
        </tr>
    </tbody>
</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Leave_Register_' . ($userdata['employeeid'] ?? 'Report') . '.pdf', 'D');
    }
    /*

    public function harishdb(){
        //load our new PHPExcel library
         $this->load->library('excel');
         //activate worksheet number 1
         $this->excel->setActiveSheetIndex(0);
         //name the worksheet
         $this->excel->getActiveSheet()->setTitle('Users list'); // user sheet title name
         
         // get all users in array formate
         // $users = $this->export->exportList();

        $listInfo = $this->export->exportList();
        $this->excel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $this->excel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $this->excel->getActiveSheet()->SetCellValue('C1', 'Email');
        $this->excel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $this->excel->getActiveSheet()->SetCellValue('E1', 'Contact_No');          
         // read data to active sheet

        // styles added by harish
        $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => 'FF0000'),
            'size'  => 15,
            'name'  => 'Verdana'
        ));
        $from = "A1";
        $to = "E1";
        $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
        $this->excel->getActiveSheet()->getStyle("$from:$to")->getFont()->setSize(10);
        // $this->excel->getActiveSheet()->getColumnDimension("$from:$to")->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

          $this->excel->getActiveSheet()->getStyle("$from:$to")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000'); // solid filling back ground color
        // styles added by harish

                $rowCount = 2;
        foreach ($listInfo as $list) {
            $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['first_name']);
            // $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
            $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['last_name']);
            $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['email']);
            $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['dob']);
            $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['contact_no']);
            $rowCount++;
        }

         // $this->excel->getActiveSheet()->fromArray($users);
         
         //$filename='harishtest.xlsx'; //save our workbook as this file name for local
         $filename='harishtest.xls'; //save our workbook as this file name for live
         
         header('Content-Type: application/vnd.ms-excel'); //mime type
         
         header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
         
         header('Cache-Control: max-age=0'); //no cache
                     
         //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
         //if you want to save it as.XLSX Excel 2007 format
         
        //  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007'); // local
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
         
         //force user to download the Excel file without writing it to server's HD
         $objWriter->save('php://output');
    }

    public function harishdefine(){
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'test');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         
        $filename='harishdefined.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }   

    public function harishcheckreadexcel(){
        $file = './files/test.xlsx';
         
        //load the excel library
        $this->load->library('excel');
         
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
         
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
         
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
         
            //The header will/should be in row 1 only. of course, this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
         
        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;
    }  
    */

    public function employeesslhistory(){
        $this->header();
        $data['title']= "Employee Essl Punch History";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Employee Essl Punch History";
        $data['check']="";
        $data['controller'] = $this;
        $this->load->view('essl/employeesslhistory',$data);
        $this->footer();    
    }

    public function employeeesslhistory_list(){
        $userdata = $this->input->post();
        echo $this->export->employeeeslhistory($userdata);
    }
    
    public function cronslist(){
        $this->header();
        $data['title']= "Daily Cron History";
        $data['titlehead']= "MAXWELL LOGISTICS PRIVATE LIMITED";
        $data['excelheading']= "Daily Cron History";
        $data['check']="";
        $data['controller'] = $this;
        $this->load->view('cron/cronslist',$data);
        $this->footer();    
    }
    
    public function dailycronshistory_list(){
        $userdata = $this->input->post();
        echo $this->export->dailycronshistory($userdata);
    }
}
?>