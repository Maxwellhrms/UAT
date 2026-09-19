<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Fullandfinalsettlement extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model('Performanceappraisalmodel');
        $this->load->model('Adminmodel');
        $this->load->model('Salaries_model');
        $this->load->model('Loan_model');
    }

    public function verifylogin(){
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function resignedlist(){
        $this->verifylogin();
        $this->header();
        $data['notice_period_employees'] = $this->Adminmodel->get_notice_peiod_employees($data = array('resign_status'=>'N'));
        // echo "<pre>";
        // print_r($data['notice_period_employees']);
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $this->load->view('FandF/fandflist',$data);
        $this->footer();
    }

    public function fandfdetails(){
        $this->verifylogin();
        $this->header();
        $emp_code = $this->uri->segment(3);
        $resign_status = $this->uri->segment(4);
        $final_data1['emp_id'] = $emp_code;
        $final_data1['resign_status'] = $resign_status;
		//f &f com pleted or no
        $data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees($final_data1);
		 $data['fandf_emp_data'] = $this->Adminmodel->get_fandf_left_employees($final_data1);
         //echo '<pre>';
         //print_r($data);exit;
        
        $cmp_id = $data['emp_data'][0]->mxemp_emp_comp_code;
        $emp_type_id = $data['emp_data'][0]->mxemp_emp_type;
        $relive_date = $data['emp_data'][0]->mxemp_emp_resignation_relieving_date;
        if(date('Y-m-d') < date('Y-m-d',strtotime($relive_date))){
            $final_date = date('Y-m-d');
            $final_date_y_m = date('Y_m');
        }else{
            $final_date = date('Y-m-d',strtotime($relive_date)); 
            $final_date_y_m = date('Y_m',strtotime($relive_date)); 
        }
		//echo $final_date_y_m;die;
        $data['leave_bal'] = $this->Adminmodel->editgetcurrentleaves($emp_code,$final_date_y_m);
         //echo '<pre>';
         //print_r($data['leave_bal']);exit;
         //echo $relive_date;exit;
        $salary_structure = $this->Salaries_model->generate_fandf_data($emp_code,$final_date,$cmp_id);
        $data['salary_structure'] = $salary_structure;

        // calculate the Previous Year Bonus based on Resignation date
        $resignationDate = $data['emp_data'][0]->mxemp_emp_resignation_date;
        $resignDate = date('Y-m', strtotime($resignationDate));
        //echo $resignDate." --- ".$emp_code;exit();
        $data['salary_structure']['previousYearBonus'] = 0;
        if($data['emp_data'][0]->mxemp_emp_is_fandf_completed == 0) {
            $data['salary_structure']['previousYearBonus'] = $this->Adminmodel->calculatePreviousYearBonus($emp_code, $resignDate);
        }
		
		$loan_details=$this->Loan_model->getloandetails_payslip($emp_code);
		$sum_loan_amt=$loan_details[0]->mxemploan_emp_loan_outstanding_amt;
		$data['salary_structure']['mxsal_loan_amount']=$sum_loan_amt;

        //echo '<pre>'; 
        //print_r($data['salary_structure']['mxsal_loan_amount']);exit;
		$salary_structure_fandf = $this->Adminmodel->getemployeedetailstosetsession_bonus5_fandf($emp_code,$final_date,$cmp_id);
        $data['salary_structure_fandf'] = $salary_structure_fandf;

        $column_names_array = $this->Adminmodel->get_income_types($income_id = null, $cmp_id, $emp_type_id);
        $data['column_names_array'] = $column_names_array;
        //------------------LOAN
        $loan_details = $this->Loan_model->getloandetails($cmp_id,$div_id = null,$state_id = null, $branch_id = null,$emp_code,$emi_month_year = null);
        // print_r($loan_details);exit;
        if(count($loan_details) > 0){
            $approved_amnt = $loan_details[0]->mxemploan_emp_loan_amt_approved;
            $emi_amnt = $loan_details[0]->mxemploan_emp_loan_monthly_emi_amt;
            $outstanding_amnt = $loan_details[0]->mxemploan_emp_loan_outstanding_amt;
            $tenure_months = $loan_details[0]->mxemploan_emp_loan_tenure_months;
            if($outstanding_amnt > 0){
                $remaining_tenure_months = $outstanding_amnt/$emi_amnt;
                $completed_tenure_months = $tenure_months - $remaining_tenure_months;
                $loan_data['loan_approved'] = $approved_amnt;
                $loan_data['emi_amount'] = $emi_amnt;
                $loan_data['outstanding_amount'] = $outstanding_amnt;
                $loan_data['total_tenure_months'] = $tenure_months;
                $loan_data['completed_tenure_months'] = $completed_tenure_months;
                $loan_data['remaining_tenure_months'] = $remaining_tenure_months;
            }else{
                $loan_data['loan_approved'] = 0;
                $loan_data['emi_amount'] = 0;
                $loan_data['outstanding_amount'] = 0;
                $loan_data['total_tenure_months'] = 0;
                $loan_data['completed_tenure_months'] = 0;
                $loan_data['remaining_tenure_months'] = 0;
            }
        }else{
                $loan_data['loan_approved'] = 0;
                $loan_data['emi_amount'] = 0;
                $loan_data['outstanding_amount'] = 0;
                $loan_data['total_tenure_months'] = 0;
                $loan_data['completed_tenure_months'] = 0;
                $loan_data['remaining_tenure_months'] = 0;
        }
        
        $data['loan_array'] = $loan_data;
        //------------------LOAN
        
        //-----------EL
        // $rate_basic = $salary_structure['mxsal_basic'];
        // $EL_balance = $data['leave_bal'][0]->CurrentEL;
        // $EL_amount = ($rate_basic/30) * $EL_balance;
        // $data['EL_amount'] = $EL_amount;
        // print_r($data['EL_amount']);exit;
        // echo $EL_amount;exit;
        //-----------EL
        
        
        
        // $ffdata = json_decode($salary_structure);
        
        // $data['fandf_data'] = 
        // echo"<pre>";
        // print_r($data['loan_array']);exit;
        $this->load->view('FandF/fandfdetails',$data);
        $this->footer();   
    }
    public function fandfdetails_left(){
        $this->verifylogin();
        $this->header();
        $emp_code = $this->uri->segment(3);
        $resign_status = $this->uri->segment(4);
        $final_data1['emp_id'] = $emp_code;
        $final_data1['resign_status'] = $resign_status;
        // echo '<pre>';
        // print_r($final_data1);exit;
        $data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees($final_data1);
        $data['fandf_emp_data'] = $this->Adminmodel->get_fandf_left_employees($final_data1);
        // echo '<pre>';
        // print_r($data['emp_data']);exit;
        // print_r($data['fandf_emp_data']);exit;
        
        $cmp_id = $data['emp_data'][0]->mxemp_emp_comp_code;
        $emp_type_id = $data['emp_data'][0]->mxemp_emp_type;
        $relive_date = $data['emp_data'][0]->mxemp_emp_resignation_relieving_date;
        
        $final_date = date('Y-m-d',strtotime($relive_date)); 
        $final_date_y_m = date('Y_m',strtotime($relive_date)); 
        
        // echo $final_date_y_m;exit;
        $data['leave_bal'] = $this->Adminmodel->editgetcurrentleaves($emp_code,$final_date_y_m);
        // echo '<pre>';
        // print_r($data['leave_bal']);exit;
        // echo $relive_date;exit;
        $salary_structure = $this->Salaries_model->generate_fandf_data($emp_code,$final_date,$cmp_id);
        $data['salary_structure'] = $salary_structure;

        // calculate the Previous Year Bonus based on Resignation date
        $resignationDate = $data['emp_data'][0]->mxemp_emp_resignation_date;
        $resignDate = date('Y-m', strtotime($resignationDate));
        //echo $resignDate." --- ".$emp_code;exit();
        $data['salary_structure']['previousYearBonus'] = 0;
        if($data['emp_data'][0]->mxemp_emp_is_fandf_completed == 0) {
            $data['salary_structure']['previousYearBonus'] = $this->Adminmodel->calculatePreviousYearBonus($emp_code, $resignDate);
        }
		
		$salary_structure_fandf = $this->Adminmodel->getemployeedetailstosetsession_bonus5_fandf($emp_code,$final_date,$cmp_id);
        $data['salary_structure_fandf'] = $salary_structure_fandf;
		
         //echo '<pre>';
         //print_r($data['salary_structure_fandf']);exit;
        $column_names_array = $this->Adminmodel->get_income_types($income_id = null, $cmp_id, $emp_type_id);
        $data['column_names_array'] = $column_names_array;
        //------------------LOAN
        $loan_details = $this->Loan_model->getloandetails($cmp_id,$div_id = null,$state_id = null, $branch_id = null,$emp_code,$emi_month_year = null);
        // print_r($loan_details);exit;
        if(count($loan_details) > 0){
            $approved_amnt = $loan_details[0]->mxemploan_emp_loan_amt_approved;
            $emi_amnt = $loan_details[0]->mxemploan_emp_loan_monthly_emi_amt;
            $outstanding_amnt = $loan_details[0]->mxemploan_emp_loan_outstanding_amt;
            $tenure_months = $loan_details[0]->mxemploan_emp_loan_tenure_months;
            if($outstanding_amnt > 0){
                $remaining_tenure_months = $outstanding_amnt/$emi_amnt;
                $completed_tenure_months = $tenure_months - $remaining_tenure_months;
                $loan_data['loan_approved'] = $approved_amnt;
                $loan_data['emi_amount'] = $emi_amnt;
                $loan_data['outstanding_amount'] = $outstanding_amnt;
                $loan_data['total_tenure_months'] = $tenure_months;
                $loan_data['completed_tenure_months'] = $completed_tenure_months;
                $loan_data['remaining_tenure_months'] = $remaining_tenure_months;
            }else{
                $loan_data['loan_approved'] = 0;
                $loan_data['emi_amount'] = 0;
                $loan_data['outstanding_amount'] = 0;
                $loan_data['total_tenure_months'] = 0;
                $loan_data['completed_tenure_months'] = 0;
                $loan_data['remaining_tenure_months'] = 0;
            }
        }else{
                $loan_data['loan_approved'] = 0;
                $loan_data['emi_amount'] = 0;
                $loan_data['outstanding_amount'] = 0;
                $loan_data['total_tenure_months'] = 0;
                $loan_data['completed_tenure_months'] = 0;
                $loan_data['remaining_tenure_months'] = 0;
        }
        
        $data['loan_array'] = $loan_data;
        //------------------LOAN
        
        //-----------EL
        // $rate_basic = $salary_structure['mxsal_basic'];
        // $EL_balance = $data['leave_bal'][0]->CurrentEL;
        // $EL_amount = ($rate_basic/30) * $EL_balance;
        // $data['EL_amount'] = $EL_amount;
        // print_r($data['EL_amount']);exit;
        // echo $EL_amount;exit;
        //-----------EL
        
        
        
        // $ffdata = json_decode($salary_structure);
        
        // $data['fandf_data'] = 
        // echo"<pre>";
        // print_r($data['loan_array']);exit;
        $this->load->view('FandF/fandf_last_employee',$data);
        $this->footer();   
    }
}
