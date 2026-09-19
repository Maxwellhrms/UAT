<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel.php';
require_once(APPPATH . 'libraries/dompdf/vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Salaries_controller extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel');  
        $this->load->model('Salaries_model'); 
		
    }
    public function verifylogin(){
		if(empty($this->session->userdata('user_id'))){
			redirect(base_url() . 'admin/logout');die();
		}
	}
    public function assign_sal(){
        $this->verifylogin();
        $this->header();	
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $this->load->view('Salaries/salary_assign',$data);
        $this->footer();	
        
    }
    public function getEmpType(){
        if(isset($_REQUEST['emptype_id'])){
            $emp_type_id = $_REQUEST['emptype_id'];
        }else{
            $emp_type_id = "";
        }
        if(isset($_REQUEST['cmp_id'])){
            $cmp_id = $_REQUEST['cmp_id'];
        }else{
            $cmp_id = "";
        }
        $emp_type = $this->Adminmodel->getemployeetypemasterdetails($emp_type_id, $cmp_id);
        echo json_encode($emp_type);exit;
    }
    public function generate_salaries(){
        $data = $this->input->post();        
        $this->Salaries_model->generate_salaries_new($data);
    }
    public function paysheet(){
        $this->verifylogin();
		$this->header();
		$data['cmpmaster'] = $this->Adminmodel->getcompany_master();
		// $data['emptypedetails'] = $this->Adminmodel->getemployeetypemasterdetails($id = '');
		$this->load->view('Salaries/paysheet',$data);
		$this->footer();	
	}
	

 public function convertNumberToWords($number) {
    $words = array(
        '0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five',
        '6' => 'Six', '7' => 'Seven', '8' => 'Eight',
        '9' => 'Nine', '10' => 'Ten', '11' => 'Eleven',
        '12' => 'Twelve', '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy', '80' => 'Eighty',
        '90' => 'Ninety'
    );

    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    $no = floor($number);
    $str = array();
    $i = 0;

    while ($no > 0) {
        $divider = ($i == 2) ? 10 : 100;
        $number_part = $no % $divider;
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;

        if ($number_part) {
            $plural = (($counter = count($str)) && $number_part > 9) ? '' : null;
            $hundred = ($counter == 1 && !empty($str[0])) ? 'And ' : '';
            if ($number_part < 21) {
                $str[] = $words[$number_part] . " " . $digits[$counter] . " " . $hundred;
            } else {
                $str[] = $words[floor($number_part / 10) * 10] . " " . $words[$number_part % 10] . " " . $digits[$counter] . " " . $hundred;
            }
        } else {
            $str[] = null;
        }
    }

    $str = array_reverse($str);
    $result = implode('', $str);

    return trim(preg_replace('/\s+/', ' ', $result)) . "  Rupees";
}




 public function getfandf1()
	{
		$emp_code = $this->input->get("emp_code");
        $resign_status = $this->input->get("resign_status");	           	
					 
                     $html_data = "<table class=\"datatable table table-stripped mb-0\" style='font-size:12px; width:100%; text-align:center;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";
						
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>";
						$html_data .= "<img src='https://maxwellhrms.in/assets/img/logo.png' alt='Company Logo' style='height:50px;width:100px; display:block; margin:0 auto;'><br>";
						$html_data .= "MAXWELL LOGISTICS PVT.LTD";
						$html_data .= "</th>";
						$html_data .= "</tr>";

						// Second row - address line 1
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SURYA TOWERS. 7TH FLOOR, 105, S.P ROAD,</th>";
						$html_data .= "</tr>";

						// Third row - address line 2
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SECUNDERABAD-500003</th>";
						$html_data .= "</tr>";

						// Fourth row - contact info
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>PH: 040-30622432, E-MAIL : HRD@MAXWELLPACKERS.COM</th>";
						$html_data .= "</tr>";

						$html_data .= "</thead>";
						$html_data .= "</table>";                    
					 
					 $html_data .= "<hr>";
					 $html_data .= "<table style='padding:0px;font-size:12px;' width='100%' class=\"datatable table  table-stripped mb-0\" border='0' id=\"dataTables-example\">";                       
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' colspan='6' style='text-align:center;' > FULL AND FINAL  SETTLEMENT DETAILS</td>";
						$html_data .= "</tr>";
$curr_month=date('F');
$curr_year=date('Y');
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' colspan='6' style='text-align:center;' > F&F Month:$curr_month , $curr_year</td>";
						$html_data .= "</tr>";						
											
						$html_data .= "</table>";
												
						
						 $html_data .= "<hr>";
					 $html_data .= "<table style='padding:0px;font-size:12px;' width='100%' class=\"datatable table  table-stripped mb-0\" border='0' id=\"dataTables-example\">";                       
						
						
////////////////////////////////////////////////

		//$this->verifylogin();
        //$this->header();
        $emp_code = $emp_code;
        $resign_status = $resign_status;
        $final_data1['emp_id'] = $emp_code;
        $final_data1['resign_status'] = $resign_status;
		$data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees_status_N($final_data1);
		$data['fandf_emp_data'] = $this->Adminmodel->get_fandf_left_employees($final_data1);
        //echo "<pre>";print_r($data['emp_data']);die;
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
		$data['leave_bal'] = $this->Adminmodel->editgetcurrentleaves($emp_code,$final_date_y_m);
        $salary_structure = $this->Salaries_model->generate_fandf_data($emp_code,$final_date,$cmp_id);
        $data['salary_structure'] = $salary_structure;
        $column_names_array = $this->Adminmodel->get_income_types($income_id = null, $cmp_id, $emp_type_id);
        $data['column_names_array'] = $column_names_array;
        $loan_details = $this->Loan_model->getloandetails($cmp_id,$div_id = null,$state_id = null, $branch_id = null,$emp_code,$emi_month_year = null);
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
        
////////////////////////////////////////////////



 
		
		//echo "<pre>";print_r($data['salary_structure']['mxsal_gross_sal']);die;
		$salary = $data['salary_structure']['mxsal_gross_sal'];
						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Name  </td>";
					$html_data .= "<td width='45%' >: ".$data['emp_data'][0]->mxemp_emp_fname." ".$data['emp_data'][0]->mxemp_emp_lname."</td>";
						$html_data .= "<td width='15%' > UAN NO  </td>";
						$html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_uan_number." </td>";
						$html_data .= "</tr>";		


						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Employee ID  </td>";
						$html_data .= "<td width='45%' >: ".$data['emp_data'][0]->mxemp_emp_id." </td>";
						$html_data .= "<td width='15%' >PF NO  </td>";
						$html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_pf_number." </td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='15%' >Designation</td>";
                        $html_data .= "<td width='45%' >:  ".$data['emp_data'][0]->mxdesg_name."  </td>";                       
						$html_data .= "<td width='15%' >PAN</td>";
                        $html_data .= "<td width='35%' >:".$data['emp_data'][0]->mxemp_emp_panno."  </td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Department </td>";
						$html_data .= "<td width='45%' > :".$data['emp_data'][0]->mxdpt_name."</td>";
						$html_data .= "<td width='15%' >EL ACCRUALS </td>";
						$html_data .= "<td width='35%'>:".$data['leave_bal'][0]->CurrentEL."</td>";
						$html_data .= "</tr>";

						$html_data .= "<tr>";						
						$html_data .= "<td width='15%' >Branch</td>";
                        $html_data .= "<td width='45%' > :".$data['emp_data'][0]->mxb_name." </td>";
						$html_data .= "<td width='15%' > Loan Balance</td>";						
                        $html_data .= "<td width='35%'>:".$data['salary_structure']['mxsal_loan_amount']."</td>";
						$html_data .= "</tr>";	

						$html_data .= "<tr>";     
						$html_data .= "<td width='15%' >Joining Date</td>";
                        //$html_data .= "<td width='45%' >:  ".$data['emp_data'][0]->mxemp_emp_resignation_date."  </td>";
$html_data .= "<td width='45%'>:  " . date('Y-m-d', strtotime($data['emp_data'][0]->mxemp_emp_date_of_join)) . "  </td>";
						
						$html_data .= "<td width='15%' >Releving Date  </td>";
						//$html_data .= "<td width='35%' >: ".$data['emp_data'][0]->mxemp_emp_resignation_relieving_date." </td>";
	$html_data .= "<td width='45%'>:  " . date('Y-m-d', strtotime($data['emp_data'][0]->mxemp_emp_resignation_relieving_date)) . "  </td>";

						$html_data .= "</tr>";	

						$html_data .= "<tr>";                        
						$html_data .= "<td width='15%' > Grade</td>";
                        $html_data .= "<td width='45%' >:".$data['emp_data'][0]->mxdesg_grade_name."  </td>";
						
						 if($salary >= 21000){}else{
							$mxemp_emp_esi_number = $data['emp_data'][0]->mxemp_emp_esi_number ; 							 
						 if($mxemp_emp_esi_number){
						$html_data .= "<td width='15%' >ESI NO </td>";
                        $html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_esi_number." </td>";
						    }
                         } 				
						$html_data .= "</tr>";


						$html_data .= "<tr>";                        
						$html_data .= "<td width='15%' > Salary </td>";
                        $html_data .= "<td width='45%' >:".$salary."  </td>";	
						$html_data .= "<td width='15%' > </td>";
                        $html_data .= "<td width='35%' > </td>";
						    				
						$html_data .= "</tr>";						
						
											
											
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='60%' colspan='3' style='text-align-last: center;' ><u>Earning Details	</u></td>";
                        $html_data .= "<td width='40%' colspan='2' ><u>Deductions Details</u></td>";
						
						$html_data .= "</tr>";						
						$html_data .= "</thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='40%' ><u>Description</u></td>";
                        $html_data .= "<td width='10%'></td>";
						$html_data .= "<td width='10%'><u>Amount</u></td>";						
						$html_data .= "<td width='30%' ><u>Description</u></td>";
						$html_data .= "<td width='10%'><u>Amount</u></td>";
						$html_data .= "</tr>";
						//echo "<pre>";print_r($data);die;
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='40%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_1."</td>";
                        $html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_1."</td>";
						$html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_1."</td>";
						$html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_1."</td>";
						$html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_1."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_2."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_2."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_3."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_3."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_4."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_4."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_5."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_5."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_6."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_6."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_7."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_7."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_8."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_8."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_9."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_9."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_10."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_10."</td>";
						$html_data .= "</tr>";
						
						
						
						
						
						
		$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
												
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                       $html_data .= "<td width='50%' colspan='' style='text-align-last: center;' ><u>Total Earning </u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_earnings."</td>";
				$html_data .= "<td width='50%' colspan='' style='text-align-last: center;' ><u>Total Deduction </u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_deductions."</td>";
                        $html_data .= "<td width='30%' ><u>Net Payable</u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_net_pay."</td>";
						$html_data .= "<td width='30%'></td>";
						
						$mxfandf_left_total_net_pay = $data['fandf_emp_data'][0]->mxfandf_left_total_net_pay ;
						
						if($mxfandf_left_total_net_pay > 0)
						{
							$html_data .= "<td width='30%' style='color :red;' >Net Payable</td>";	
						}else{
						
							$html_data .= "<td width='30%' style='color :red;' >Recoverable</td>";							
						}
											
						
						$html_data .= "</tr>";
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
					
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >&nbsp;</td>";
                        $html_data .= "<td width='30%'  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >&nbsp;</td>";
                        $html_data .= "<td width='30%'  >&nbsp;</td>";						
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >Prepared by	</td>";
                        $html_data .= "<td width='30%'  > Checked by</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  ><u>Payment details<u></td>";
                        $html_data .= "<td width='30%'  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >Payment Mode</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_mode."</td>";
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Payment Date</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_date."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Payment Amount</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_amount."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Cheque No.</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_no."</td>";	
						$html_data .= "</tr>";
						
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						
						
						$mxfandf_left_total_net_pay = $data['fandf_emp_data'][0]->mxfandf_left_total_net_pay ;
						$test_words = $this->convertNumberToWords($mxfandf_left_total_net_pay);
						$html_data .= "<tr>";
                        $html_data .= "<td width=''  >I, ".$data['emp_data'][0]->mxemp_emp_fname." agree and accept the above amount of ".$data['fandf_emp_data'][0]->mxfandf_left_total_net_pay." (".$test_words.") in FINAL SETTLEMENT PAYSLIP settlement of my employment due to my retirement/resignation on own accord from the position of  ".$data['emp_data'][0]->mxdesg_name." - ".$data['emp_data'][0]->mxdpt_name."   and I have no further money due, demands or claims whatsoever including all legal dues in respect of my employment jointly and/or severally from MAXWELL LOGISTICS PVT.LTD, its employees, its holding, subsidiaries and affiliated companies.</td>";
                        $html_data .= "<td width=''  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''  ></td>";
                        $html_data .= "<td width=''  >&nbsp;</td>";						
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	&nbsp;</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	&nbsp;</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	signature of emp</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >For MAXWELL LOGISTICS PVT.LTD</td>";
                        $html_data .= "<td width='30%'  > </td>";						
						$html_data .= "</tr>";
						
						

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >&nbsp;	</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	&nbsp;</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >&nbsp;	</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >Authorised Signatory</td>";
                        $html_data .= "<td width='30%'  >&nbsp;</td>";						
						$html_data .= "</tr>";
												
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
						
						

						
						
                     
                     //echo $html_data;
                     
					 //die;

/*$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_data);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$customFileName = $month.'-' .$year.'-' . $paysheet_data->mxsal_emp_code . '.pdf'; // example: custom_salary_report_20250420_153000.pdf
$savePath = 'uploads/payslips/' . $customFileName;
file_put_contents($savePath, $dompdf->output());
echo "<br>PDF saved successfully to: $savePath";*/
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_data);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Display in browser instead of saving
$dompdf->stream($emp_code."fandfslip.pdf", array("Attachment" => false));
		
	}
	
	
	
	

    public function getfandf()
	{
		$emp_code = $this->input->get("emp_code");
        $resign_status = $this->input->get("resign_status");	           	
					 
                     $html_data = "<table class=\"datatable table table-stripped mb-0\" style='font-size:12px; width:100%; text-align:center;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";
						
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>";
						$html_data .= "<img src='https://maxwellhrms.in/assets/img/logo.png' alt='Company Logo' style='height:50px;width:100px; display:block; margin:0 auto;'><br>";
						$html_data .= "MAXWELL LOGISTICS PVT.LTD";
						$html_data .= "</th>";
						$html_data .= "</tr>";

						// Second row - address line 1
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SURYA TOWERS. 7TH FLOOR, 105, S.P ROAD,</th>";
						$html_data .= "</tr>";

						// Third row - address line 2
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SECUNDERABAD-500003</th>";
						$html_data .= "</tr>";

						// Fourth row - contact info
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>PH: 040-30622432, E-MAIL : HRD@MAXWELLPACKERS.COM</th>";
						$html_data .= "</tr>";

						$html_data .= "</thead>";
						$html_data .= "</table>";                    
					 
					 $html_data .= "<hr>";
					 $html_data .= "<table style='padding:0px;font-size:12px;' width='100%' class=\"datatable table  table-stripped mb-0\" border='0' id=\"dataTables-example\">";                       
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' colspan='6' style='text-align:center;' > FULL AND FINAL  SETTLEMENT DETAILS</td>";
						$html_data .= "</tr>";
$curr_month=date('F');
$curr_year=date('Y');
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' colspan='6' style='text-align:center;' > F&F Month:$curr_month , $curr_year</td>";
						$html_data .= "</tr>";						
											
						$html_data .= "</table>";
												
						
						 $html_data .= "<hr>";
					 $html_data .= "<table style='padding:0px;font-size:12px;' width='100%' class=\"datatable table  table-stripped mb-0\" border='0' id=\"dataTables-example\">";                       
						
						




 $final_data1['emp_id'] = $emp_code;
        $final_data1['resign_status'] = $resign_status;       
        $data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees($final_data1);
        $data['fandf_emp_data'] = $this->Adminmodel->get_fandf_left_employees($final_data1);
        $cmp_id = $data['emp_data'][0]->mxemp_emp_comp_code;
        $emp_type_id = $data['emp_data'][0]->mxemp_emp_type;
        $relive_date = $data['emp_data'][0]->mxemp_emp_resignation_relieving_date;        
        $final_date = date('Y-m-d',strtotime($relive_date)); 
        $final_date_y_m = date('Y_m',strtotime($relive_date)); 
        $data['leave_bal'] = $this->Adminmodel->editgetcurrentleaves($emp_code,$final_date_y_m);
        $salary_structure = $this->Salaries_model->generate_fandf_data($emp_code,$final_date,$cmp_id);
        $data['salary_structure'] = $salary_structure;
		$column_names_array = $this->Adminmodel->get_income_types($income_id = null, $cmp_id, $emp_type_id);
        $data['column_names_array'] = $column_names_array;
   $loan_details = $this->Loan_model->getloandetails($cmp_id,$div_id = null,$state_id = null, $branch_id = null,$emp_code,$emi_month_year = null);
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
		
		//echo "<pre>";print_r($data['salary_structure']['mxsal_gross_sal']);die;
		$salary = $data['salary_structure']['mxsal_gross_sal'];
						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Name  </td>";
					$html_data .= "<td width='45%' >: ".$data['emp_data'][0]->mxemp_emp_fname." ".$data['emp_data'][0]->mxemp_emp_lname."</td>";
						$html_data .= "<td width='15%' > UAN NO  </td>";
						$html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_uan_number." </td>";
						$html_data .= "</tr>";		


						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Employee ID  </td>";
						$html_data .= "<td width='45%' >: ".$data['emp_data'][0]->mxemp_emp_id." </td>";
						$html_data .= "<td width='15%' >PF NO  </td>";
						$html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_pf_number." </td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='15%' >Designation</td>";
                        $html_data .= "<td width='45%' >:  ".$data['emp_data'][0]->mxdesg_name."  </td>";                       
						$html_data .= "<td width='15%' >PAN</td>";
                        $html_data .= "<td width='35%' >:".$data['emp_data'][0]->mxemp_emp_panno."  </td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='15%' >Department </td>";
						$html_data .= "<td width='45%' > :".$data['emp_data'][0]->mxdpt_name."</td>";
						$html_data .= "<td width='15%' >EL ACCRUALS </td>";
						$html_data .= "<td width='35%'>:".$data['leave_bal'][0]->CurrentEL."</td>";
						$html_data .= "</tr>";

						$html_data .= "<tr>";						
						$html_data .= "<td width='15%' >Branch</td>";
                        $html_data .= "<td width='45%' > :".$data['emp_data'][0]->mxb_name." </td>";
						$html_data .= "<td width='15%' > Loan Balance</td>";						
                        $html_data .= "<td width='35%'>:".$data['salary_structure']['mxsal_loan_amount']."</td>";
						$html_data .= "</tr>";	

						$html_data .= "<tr>";     
						$html_data .= "<td width='15%' >Joining Date</td>";
                        //$html_data .= "<td width='45%' >:  ".$data['emp_data'][0]->mxemp_emp_resignation_date."  </td>";
$html_data .= "<td width='45%'>:  " . date('Y-m-d', strtotime($data['emp_data'][0]->mxemp_emp_date_of_join)) . "  </td>";
						
						$html_data .= "<td width='15%' >Releving Date  </td>";
						//$html_data .= "<td width='35%' >: ".$data['emp_data'][0]->mxemp_emp_resignation_relieving_date." </td>";
	$html_data .= "<td width='45%'>:  " . date('Y-m-d', strtotime($data['emp_data'][0]->mxemp_emp_resignation_relieving_date)) . "  </td>";

						$html_data .= "</tr>";	

						$html_data .= "<tr>";                        
						$html_data .= "<td width='15%' > Grade</td>";
                        $html_data .= "<td width='45%' >:".$data['emp_data'][0]->mxdesg_grade_name."  </td>";
						
						 if($salary >= 21000){}else{
							$mxemp_emp_esi_number = $data['emp_data'][0]->mxemp_emp_esi_number ; 							 
						 if($mxemp_emp_esi_number){
						$html_data .= "<td width='15%' >ESI NO </td>";
                        $html_data .= "<td width='35%' > :".$data['emp_data'][0]->mxemp_emp_esi_number." </td>";
						    }
                         } 				
						$html_data .= "</tr>";


						$html_data .= "<tr>";                        
						$html_data .= "<td width='15%' > Salary </td>";
                        $html_data .= "<td width='45%' >:".$salary."  </td>";	
						$html_data .= "<td width='15%' > </td>";
                        $html_data .= "<td width='35%' > </td>";
						    				
						$html_data .= "</tr>";						
						
											
											
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='60%' colspan='3' style='text-align-last: center;' ><u>Earning Details	</u></td>";
                        $html_data .= "<td width='40%' colspan='2' ><u>Deductions Details</u></td>";
						
						$html_data .= "</tr>";						
						$html_data .= "</thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='40%' ><u>Description</u></td>";
                        $html_data .= "<td width='10%'><u>CBS Date</u></td>";
						$html_data .= "<td width='10%'><u>Amount</u></td>";						
						$html_data .= "<td width='30%' ><u>Description</u></td>";
						$html_data .= "<td width='10%'><u>Amount</u></td>";
						$html_data .= "</tr>";
						//echo "<pre>";print_r($data);die;
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='40%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_1."</td>";
                        $html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_1."</td>";
						$html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_1."</td>";
						$html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_1."</td>";
						$html_data .= "<td width='10%'>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_1."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_2."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_2."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_2."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_3."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_3."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_3."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_4."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_4."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_4."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_5."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_5."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_5."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_6."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_6."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_6."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_7."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_7."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_7."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_8."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_8."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_8."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_9."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_9."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_9."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_details_10."</td>";
                        $html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_cbs_date_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_earnings_amount_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_details_10."</td>";
						$html_data .= "<td width=''>".$data['fandf_emp_data'][0]->mxfandf_left_deduction_amount_10."</td>";
						$html_data .= "</tr>";
						
						
						
						
						
						
		$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
												
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                       $html_data .= "<td width='50%' colspan='' style='text-align-last: center;' ><u>Total Earning </u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_earnings."</td>";
				$html_data .= "<td width='50%' colspan='' style='text-align-last: center;' ><u>Total Deduction </u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_deductions."</td>";
                        $html_data .= "<td width='30%' ><u>Net Payable</u></td>";
                        $html_data .= "<td width='30%'>".$data['fandf_emp_data'][0]->mxfandf_left_total_net_pay."</td>";
						$html_data .= "<td width='30%'></td>";
						
						$mxfandf_left_total_net_pay = $data['fandf_emp_data'][0]->mxfandf_left_total_net_pay ;
						
						if($mxfandf_left_total_net_pay > 0)
						{
							$html_data .= "<td width='30%' style='color :red;' >Net Payable</td>";	
						}else{
						
							$html_data .= "<td width='30%' style='color :red;' >Recoverable</td>";							
						}
											
						
						$html_data .= "</tr>";
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
					
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >&nbsp;</td>";
                        $html_data .= "<td width='30%'  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >&nbsp;</td>";
                        $html_data .= "<td width='30%'  >&nbsp;</td>";						
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >Prepared by	</td>";
                        $html_data .= "<td width='30%'  > Checked by</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  ><u>Payment details<u></td>";
                        $html_data .= "<td width='30%'  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >Payment Mode</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_mode."</td>";
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Payment Date</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_date."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Payment Amount</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_amount."</td>";
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	Cheque No.</td>";
                        $html_data .= "<td width='30%'  >:".$data['fandf_emp_data'][0]->payment_no."</td>";	
						$html_data .= "</tr>";
						
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						
						
						$mxfandf_left_total_net_pay = $data['fandf_emp_data'][0]->mxfandf_left_total_net_pay ;
						$test_words = $this->convertNumberToWords($mxfandf_left_total_net_pay);
						$html_data .= "<tr>";
                        $html_data .= "<td width=''  >I, ".$data['emp_data'][0]->mxemp_emp_fname." agree and accept the above amount of ".$data['fandf_emp_data'][0]->mxfandf_left_total_net_pay." (".$test_words.") in FINAL SETTLEMENT PAYSLIP settlement of my employment due to my retirement/resignation on own accord from the position of  ".$data['emp_data'][0]->mxdesg_name." - ".$data['emp_data'][0]->mxdpt_name."   and I have no further money due, demands or claims whatsoever including all legal dues in respect of my employment jointly and/or severally from MAXWELL LOGISTICS PVT.LTD, its employees, its holding, subsidiaries and affiliated companies.</td>";
                        $html_data .= "<td width=''  > &nbsp;</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width=''  ></td>";
                        $html_data .= "<td width=''  >&nbsp;</td>";						
						$html_data .= "</tr>";

						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	&nbsp;</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	&nbsp;</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width=''  >	signature of emp</td>";
                        $html_data .= "<td width=''  ></td>";						
						$html_data .= "</tr>";
						
						
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >For MAXWELL LOGISTICS PVT.LTD</td>";
                        $html_data .= "<td width='30%'  > </td>";						
						$html_data .= "</tr>";
						
						

						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >&nbsp;	</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >	&nbsp;</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
						$html_data .= "<td width='50%'  >&nbsp;	</td>";
                        $html_data .= "<td width='30%'  ></td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%'  >Authorised Signatory</td>";
                        $html_data .= "<td width='30%'  >&nbsp;</td>";						
						$html_data .= "</tr>";
												
						$html_data .= "</table>";
												
						$html_data .= "<hr>";
						
						
						
						
						
						
						

						
						
                     
                     //echo $html_data;
                     
					 //die;

/*$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_data);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$customFileName = $month.'-' .$year.'-' . $paysheet_data->mxsal_emp_code . '.pdf'; // example: custom_salary_report_20250420_153000.pdf
$savePath = 'uploads/payslips/' . $customFileName;
file_put_contents($savePath, $dompdf->output());
echo "<br>PDF saved successfully to: $savePath";*/
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_data);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Display in browser instead of saving
$dompdf->stream($emp_code."fandfslip.pdf", array("Attachment" => false));
		
	}
	
	
	
	
	
    public function getPaysheet(){
        // print_r($_REQUEST);exit;
    
        $date = $this->input->post("date");
        $ex = explode("-",$date);
        $month = $ex[0];
        $year = $ex[1];
        $company = $this->input->post("company");
        $divison = $this->input->post("divison");
        $state = $this->input->post("state");
        $branch = $this->input->post("branch");
        $emptype = $this->input->post("emptype");
        $saltype = $this->input->post("saltype");
        $emp_code = ($this->input->post("emp_code") != null)?$this->input->post("emp_code"):"";
        // echo "comp =".$company.", divi =".$divison.", state = ".$state.", branch =".$branch.", emptype =".$emptype;exit;


        //------PAYSLIP
		if(isset($_REQUEST['paysheet']) && $_REQUEST['paysheet'] == "payslip"){ 
            $paysheet_array = $this->Salaries_model->getPaysheet($date,$company,$divison,$state,$branch,$emptype,$saltype,$emp_code);
        
		if(count($paysheet_array) > 0){
            $emp_type_data = $this->Adminmodel->getemployeetypemasterdetails($emptype, $company);
            
            if(count($emp_type_data) > 0){
                $directors_flag = $emp_type_data[0]->mxemp_ty_is_director;
                $professionals_flag = $emp_type_data[0]->mxemp_ty_is_professionals;
                $trainees_flag = $emp_type_data[0]->mxemp_ty_is_trainees;                
                $emp_type_name = $emp_type_data[0]->mxemp_ty_name;
                                          
                     $sno = 1;
                    foreach($paysheet_array as $paysheet_data){
						
						
						//if($paysheet_data->mxsal_emp_code=='M0009')
						//{
						//echo"<pre>";
						//print_r($paysheet_data);die;
						//}
						//if($paysheet_data->mxsal_paid_status_flag == 1){$paid_status = 'PAID';}else{$paid_status = 'UNPAID';}
						
					//	if($paid_status == 'UNPAID')
					//	{
					//	}
					//else{ 
						
						
						
						
                     	
					 //$html_data = "<div class=\"table-responsive\">";
                     $html_data = "<table class=\"datatable table table-stripped mb-0\" style='font-size:12px; width:100%; text-align:center;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";

						// First row with logo and company name
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>";
						$html_data .= "<img src='https://maxwellhrms.in/assets/img/logo.png' alt='Company Logo' style='height:50px;width:100px; display:block; margin:0 auto;'><br>";
						$html_data .= "MAXWELL LOGISTICS PVT.LTD";
						$html_data .= "</th>";
						$html_data .= "</tr>";

						// Second row - address line 1
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SURYA TOWERS. 7TH FLOOR, 105, S.P ROAD,</th>";
						$html_data .= "</tr>";

						// Third row - address line 2
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>SECUNDERABAD-500003</th>";
						$html_data .= "</tr>";

						// Fourth row - contact info
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>PH: 040-30622432, E-MAIL : HRD@MAXWELLPACKERS.COM</th>";
						$html_data .= "</tr>";

						// Fifth row - pay slip title
						$monthNum = $month;
						$monthName = date("F", mktime(0, 0, 0, (int)$monthNum, 10));
						$monthName=strtoupper($monthName);
						$html_data .= "<tr>";
						$html_data .= "<th colspan='6' style='text-align:center;'>PAY SLIP FOR : $monthName-$year</th>";
						$html_data .= "</tr>";

						$html_data .= "</thead>";
						$html_data .= "</table>";

                     
					 
					 $html_data .= "<hr>";
					 
					   


					    $html_data .= "<table style='padding:0px;font-size:12px;' width='100%' class=\"datatable table  table-stripped mb-0\" border='0' id=\"dataTables-example\">";
                        
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >EMP CODE </td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxsal_emp_code</td>";							
						$html_data .= "<td width='20%' >PAN</td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxemp_emp_panno</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >EMP NAME</td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
							
						$html_data .= "<td width='20%' >UAN NO</td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxemp_emp_uan_number</td>";										
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >BRANCH </td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxb_name</td>";
						
						$html_data .= "<td width='20%' >PF NO.</td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxemp_emp_pf_number</td>";							
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >DESIGNATION </td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxdesg_name</td>";
						
						if($paysheet_data->mxemp_emp_esi_number==0){ $esi_no='NOT APPLICABLE';}else{$esi_no=$paysheet_data->mxemp_emp_esi_number;}
						$html_data .= "<td width='20%' >ESI NO.</td>";
                        $html_data .= "<td width='30%' >: $esi_no</td>";						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >DEPARTMENT </td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxdpt_name</td>";
							
						$html_data .= "<td width='20%' >GRADE</td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxdesg_grade_name</td>";						
						$html_data .= "</tr>";
						$status_working=$paysheet_data->mxemp_emp_resignation_status;
						if($status_working)
						{
							$status_working='Working';
						}
						$html_data .= "<tr>";
                        $html_data .= "<td width='20%' >DOJ </td>";
                        $html_data .= "<td width='30%' >: $paysheet_data->mxemp_emp_date_of_join</td>";
												
						$html_data .= "<td width='20%' > </td>";
                        $html_data .= "<td width='30%' ></td>";						
						$html_data .= "</tr>";
						
						
						
						
											
						$html_data .= "</table>";
						
						
						$html_data .= "<hr>";
						
						
						
   


						$html_data .= "<table class=\"datatable table table-stripped mb-0\" width='100%' style='font-size:12px;' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='50%' colspan='2' style='text-align-last: center;' ><u>ATTENDANCE DETAILS	</u></td>";
                        $html_data .= "<td width='30%' ><u>LEAVE DETAILS</u></td>";
						$html_data .= "<td width='10%' ><u>AVAILED</u></td>";
						$html_data .= "<td width='10%' ><u>BALANCE</u></td>";
						$html_data .= "</tr>";						
						$html_data .= "</thead>";
						
						//echo"<pre>";
						$leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
						//print_r($leaves_data);
						//die;
						$EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
$CurrentEL=$leaves_data[0]->CurrentEL;						
						$html_data .= "<tr>";
                        $html_data .= "<td width='30%' >DAYS IN A MONTH 	</td>";
                        $html_data .= "<td width='20%'>$paysheet_data->mxsal_emp_days_in_month</td>";
						$html_data .= "<td width='30%'>EARNED LEAVE</td>";						
						$html_data .= "<td width='20%' >$EL</td>";
						$html_data .= "<td width='20%'>$CurrentEL</td>";
						$html_data .= "</tr>";
						
					$present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                       
						$CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
						$CurrentCL=$leaves_data[0]->CurrentCL;
						$html_data .= "<tr>";
                        $html_data .= "<td  >PRESENT DAYS 	</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_present_days_from_attendance</td>";
						$html_data .= "<td>CASUAL LEAVE</td>";						
						$html_data .= "<td>$CL</td>";
						$html_data .= "<td>$CurrentCL</td>";
						$html_data .= "</tr>";
						
						$wo = $leaves_data[0]->Week_Off;
						$PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                       $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                       $public_holiday = $PH +$wo;
                         
						$SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
						$CurrentSL=$leaves_data[0]->CurrentSL;
						$html_data .= "<tr>";
                        $html_data .= "<td  >SUNDAYS+PH	</td>";
                        $html_data .= "<td>".$public_holiday."</td>";
						$html_data .= "<td>SICK LEAVE </td>";
						$html_data .= "<td>$SL</td>";
						$html_data .= "<td>$CurrentSL</td>";
						$html_data .= "</tr>";
						
						$adjust=$EL+$CL+$SL;
						$CurrentOH=$leaves_data[0]->CurrentOH;
						
						$html_data .= "<tr>";
                        $html_data .= "<td  >LEAVE AJUSTED	</td>";
                        $html_data .= "<td>$adjust</td>";
						$html_data .= "<td>OPTIONAL HOLIDAY</td>";						
						$html_data .= "<td>$OH</td>";
						$html_data .= "<td>$CurrentOH</td>";
						$html_data .= "</tr>";
						
						$total_days = $present_days + $wo +$SL;
						//DAYS PAID
						 //[mxsal_present_days] => 28.00--used
    //[mxsal_emp_days_in_month] => 28.00
	 //[mxsal_total_days_from_attendance] => 28.00
	 
	 
    
						
						$html_data .= "<tr>";
                        $html_data .= "<td  >DAYS PAID</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_present_days</td>";
						$html_data .= "<td>TOTAL LOPS</td>";						
						$html_data .= "<td>0</td>";
						$html_data .= "<td>0</td>";
						$html_data .= "</tr>";
						
						$LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
						
						//LOAN BALANCE
						$loan_details=$this->Loan_model->getloandetails_payslip($paysheet_data->mxsal_emp_code);
						//print_r($loan_details);die;
						/*if($paysheet_data->mxsal_emp_code=='M1107')
						{
						echo"<pre>";
						print_r($loan_details);die;
						print_r($loan_details[0]->mxemploan_emp_loan_outstanding_amt);die;
						}*/
						$sum_loan_amt=$loan_details[0]->mxemploan_emp_loan_outstanding_amt;
						$html_data .= "<tr>";
                        $html_data .= "<td  >LOP DAYS</td>";
                        $html_data .= "<td>$LOP</td>";
						$html_data .= "<td>LOAN BALANCE </td>";	
						$html_data .= "<td>0</td>";						
						$html_data .= "<td>$sum_loan_amt</td>";
						
						$html_data .= "</tr>";
						$html_data .= "</table>";
						
						
						$html_data .= "<hr>";
						
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" style='font-size:12px;' width='100%' border='0' id=\"dataTables-example\">";
						$html_data .= "<thead>";						
						$html_data .= "<tr>";
                        $html_data .= "<td   width='48%' colspan='3' style='text-align-last: center;'><u> EARNINGS</u> </td>";
						$html_data .= "<td width='4%'  ></td>";
                        $html_data .= "<td  width='48%' colspan='2' style='text-align-last: center;' ><u>DEDUCTIONS</u> </td>";				
						$html_data .= "</tr>";
						$html_data .= "</thead>";
						
						
						//$html_data .= "<thead>";
						$html_data .= "<tr>";
                        $html_data .= "<td width='28%' >COMPONENTS</td>";
                        $html_data .= "<td width='10%' >SCALE&nbsp;&nbsp;&nbsp;</td>";
						$html_data .= "<td width='10%' >ACTUALS	 </td>";
						$html_data .= "<td width='4%'  ></td>";
						$html_data .= "<td width='30%' style='text-align-last: center;' >COMPONENTS</td>";
						$html_data .= "<td width='18%' >AMOUNT	</td>";						
						$html_data .= "</tr>";
						$html_data .= "</thead>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='28%' >BASIC</td>";
                        $html_data .= "<td width='10%' >$paysheet_data->mxsal_basic&nbsp;&nbsp;&nbsp;</td>";
                        $html_data .= "<td width='10%' >$paysheet_data->mxsal_actual_basic</td>";
						$html_data .= "<td width='4%'  ></td>";						
						$html_data .= "<td width='40%' >PROVIDENT FUND </td>";
						$html_data .= "<td width='18%' >$paysheet_data->mxsal_pf_emp_cont</td>";					
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td width='28%' >HRA</td>";
                        $html_data .= "<td width='10%' >$paysheet_data->mxsal_hra&nbsp;&nbsp;&nbsp;</td>";
                        $html_data .= "<td width='10%' >$paysheet_data->mxsal_actual_hra</td>";	
						$html_data .= "<td width='4%'  ></td>";						
						$html_data .= "<td width='40%' >ESI </td>";
						$html_data .= "<td width='18%' >$paysheet_data->mxsal_esi_emp_cont</td>";				
						$html_data .= "</tr>";
						
						////profission TAX
						$html_data .= "<tr>";
                        $html_data .= "<td  >MISC INCOME</td>";
                        $html_data .= "<td>0</td>";
                        //$html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";
						$html_data .= "<td>$paysheet_data->mxsal_incentive_amount</td>";
						$html_data .= "<td width='4%'  ></td>";						
						$html_data .= "<td  > PROFESSIONAL TAX </td>";
						$html_data .= "<td>".(int)$paysheet_data->mxsal_pt."</td>"; 				
						$html_data .= "</tr>";
						
						
						$html_data .= "<tr>";
                        $html_data .= "<td  >OTHERS</td>";
                        $html_data .= "<td>0</td>";
                        $html_data .= "<td>0</td>";
$html_data .= "<td width='4%'  ></td>";
if($paysheet_data->mxsal_loan_amount>=1){						
						$html_data .= "<td  >STAFF ADVANCE </td>";
						$html_data .= "<td>$paysheet_data->mxsal_loan_amount</td>";	
}						
						$html_data .= "</tr>";
						
						
						
						//income tax->tds
						$html_data .= "<tr>";
                        $html_data .= "<td  ></td>";
                        $html_data .= "<td></td>";
                        $html_data .= "<td></td>";	
$html_data .= "<td width='4%'  ></td>";	
if($paysheet_data->mxsal_tds_amount>=1){					
						$html_data .= "<td  >INCOME TAX</td>";
						$html_data .= "<td>".(int)$paysheet_data->mxsal_tds_amount."</td>"; 
}						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td  ></td>";
                        $html_data .= "<td></td>";
                        $html_data .= "<td></td>";
$html_data .= "<td width='4%'  ></td>";	
if($paysheet_data->mxsal_lwf_emp_cont>=1){					
						$html_data .= "<td  >LWF </td>";
						$html_data .= "<td>$paysheet_data->mxsal_lwf_emp_cont</td>";
}						
						$html_data .= "</tr>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td  ></td>";
                        $html_data .= "<td></td>";
                        $html_data .= "<td></td>";
$html_data .= "<td width='4%'  ></td>";
if($paysheet_data->mxsal_miscelleneous_amount>=1)
{	
						$html_data .= "<td  > MISC EXPESNES </td>";
						$html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";
}						
						$html_data .= "</tr>";
						$html_data .= "</table>";
                     
					 
					 $html_data .= "<hr>";
					 
						$html_data .= "<table class=\"datatable table table-stripped mb-0\" style='font-size:12px;'  width='100%' border='0' id=\"dataTables-example\">";
						$html_data .= "<tr>";
                        $html_data .= "<td  >TOTAL EARNINGS</td>";
                        $html_data .= "<td> </td>";
                         $html_data .= "<td>Rs.".(int)$paysheet_data->mxsal_actual_gross."</td>";
$html_data .= "<td width='4%'  ></td>";						 
						$html_data .= "<td  >TOTAL DEDUCTIONS</td>";
						$html_data .= "<td>Rs.$paysheet_data->mxsal_total_ded</td>";				
						$html_data .= "</tr>";
						$html_data .= "<br>";
						$html_data .= "<tr>";
                        $html_data .= "<td  >NET PAY</td>";                        
                        $html_data .= "<td>Rs.$paysheet_data->mxsal_net_sal</td>";
						$html_data .= "<td></td>";						 
						$html_data .= "<td  ></td>";
						$html_data .= "<td></td>";				
						$html_data .= "</tr>";
						$html_data .= "<br>";
						 $to_convert_number=$paysheet_data->mxsal_net_sal;
						 //$to_convert_number="102369.00";
						
						
						$html_data .= "<tr>";
                     $html_data .= "<td  colspan='6' > ". convertToIndianCurrencyWords($to_convert_number)." </td>"; 
						$html_data .= "</tr>";
						
						$html_data .= "<br>";
						
						$html_data .= "<tr>";
                        $html_data .= "<td colspan='6' >Note : This is system gernerated payslip and dose not require any stamp and signature </td>"; 
						$html_data .= "</tr>";
						$html_data .= "<br>";
						$html_data .= "<tr>";
                        $html_data .= "<td  ></td>";                        
                        $html_data .= "<td></td>";
						$html_data .= "<td></td>";						 
						$html_data .= "<td  ></td>";									
						$html_data .= "<td colspan='2' >".date('Y-m-d')."</td>";				
						$html_data .= "</tr>";
						
						
						
						  
                     $html_data .= "</table>";
                     //$html_data .= "</div>";
                    //  echo $html_data;
                     
					 //die;

$options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

$dompdf->loadHtml($html_data);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$customFileName = $month.'-' .$year.'-' . $paysheet_data->mxsal_emp_code . '.pdf'; // example: custom_salary_report_20250420_153000.pdf
$savePath = 'uploads/payslips/' . $customFileName;


/*if (!file_exists('uploads/payslips/')) {
    mkdir('uploads/payslips/', 0777, true);
}*/

        file_put_contents($savePath, $dompdf->output());

    echo "<br>PDF saved successfully to: $savePath";
                    //}
             
			}
                    
                
				
				
				
			}
            
		}
		
      }

        //------PAYSHEET
        if(isset($_REQUEST['paysheet']) && $_REQUEST['paysheet'] == "supplementary_paysheet"){
            $paysheet_array = $this->Salaries_model->get_Supplementary_Paysheet($date,$company,$divison,$state,$branch,$emptype,$emp_code);
            // print_r($paysheet_array);exit;
            if(count($paysheet_array) > 0){
            $emp_type_data = $this->Adminmodel->getemployeetypemasterdetails($emptype, $company);
            // print_r($emp_type_data);exit;
            
            if(count($emp_type_data) > 0){
                $directors_flag = $emp_type_data[0]->mxemp_ty_is_director;
                $professionals_flag = $emp_type_data[0]->mxemp_ty_is_professionals;
                $trainees_flag = $emp_type_data[0]->mxemp_ty_is_trainees;
                
                $emp_type_name = $emp_type_data[0]->mxemp_ty_name;
                // echo $professionals_flag." - ". $directors_flag." - ".$trainees_flag;exit;
                if($trainees_flag == 1){
                     $html_data = "<div class=\"table-responsive\">";
                     $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                     $html_data .= "<thead>";
                     $html_data .= "<tr>";
                     $html_data .= "<th>Sno</th>";
                     $html_data .= "<th>Month</th>"; 
                    //  $html_data .= "<th>Company Name</th>";
                     $html_data .= "<th>Division</th>";
                     $html_data .= "<th>Branch</th>";
                     $html_data .= "<th>State</th>"; 
                     $html_data .= "<th>Emp Id</th>";
                     $html_data .= "<th>Name</th>";
                     $html_data .= "<th>Department</th>"; 
                     $html_data .= "<th>Designation</th>";
                     $html_data .= "<th>UAN No</th>";
                     $html_data .= "<th>PF No</th>";
                     $html_data .= "<th>ESI No</th>";
                    //  $html_data .= "<th>Gratuity No</th>";
                     $html_data .= "<th>Type of Employement</th>";
                     $html_data .= "<th>Days in Month</th>"; 
                     $html_data .= "<th>Present Days</th>"; 
                     $html_data .= "<th>Sundays</th>";
                     $html_data .= "<th>Public/Optional Holidays</th>";
                     $html_data .= "<th>SL With Pay</th>";
                    $html_data .= "<th>LOP</th>";
                    $html_data .= "<th>Total Days</th>";
                    $html_data .= "<th>STIPEND PER MONTH</th>";
            
                    //--------------NET INCOME HEADS
                    $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                    foreach($incm_heads as $inc_data){
                        //   print_r($inc_data);exit;
                        $html_data .= "<th>$inc_data->mxincm_name</th>";                
                    }
                    //--------------END NET INCOME HEADS
                     $html_data .= "<th>ESI</th>";
                     $html_data .= "<th>NET PAY</th>";
                     $html_data .= "<th>PAID STATUS</th>";
                     $html_data .= "<th>Date Created</th>";
                     $html_data .= "</tr>";
                     $html_data .= "</thead>";
                     $html_data .= "<tbody>";
                     
                     $sno = 1;
                    foreach($paysheet_array as $paysheet_data){
                        //  print_r($paysheet_data);exit;
                        $html_data .= "<tr>";
                        $html_data .= "<td>$sno</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                        // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                        $html_data .= "<td>$paysheet_data->mxd_name</td>";
                        $html_data .= "<td>$paysheet_data->mxb_name</td>";
                        $html_data .= "<td>$paysheet_data->mxst_state</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                        $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                        $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                        $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                        $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                        $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                        $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                        // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                        $html_data .= "<td>$emp_type_name</td>";
                        $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                        // print_r($leaves_data);exit;
                        $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                        /*$present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;*/

                        $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present +
                            $leaves_data[0]->regulation_full_day + $leaves_data[0]->First_Half_regulation + $leaves_data[0]->Second_Half_regulation +
                            $leaves_data[0]->First_Half_Shortleave + $leaves_data[0]->Second_Half_Shortleave +
                            $leaves_data[0]->ot_full_day + $leaves_data[0]->First_Half_ot + $leaves_data[0]->Second_Half_ot;

                        $html_data .= "<td>$present_days</td>";

                        $wo = $leaves_data[0]->Week_Off;
                        $html_data .= "<td>".$wo."</td>";
    
                        $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                        $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                        // $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
                        $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
                        // $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave; 
                        //----------NEW BY SHABABU(12-06-2022)
                        $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave; 
                        //----------NEW BY SHABABU(12-06-2022)
                        $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent; 
                        $public_holiday = $PH + $OH;
                        $html_data .= "<td>".$public_holiday."</td>";
                        $html_data .= "<td>$SL</td>";//---->SL WITH PAY
                       
    
                        // $html_data .= "<td>$CL</td>";//-->cl
                        // $html_data .= "<td>$SL</td>";//--->sl
                        // $html_data .= "<td>$EL</td>";//-->EL
                        $html_data .= "<td>$LOP</td>";//--->LOP                 
                        $total_days = $present_days + $wo + $public_holiday+$SL;
                        $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                        $html_data .= "<td>".(int)$paysheet_data->mxsal_gross_sal."</td>";
                        // //--------------------------NET INCOME HEADS
                        // foreach($incm_heads as $inc_data){
                        //     //   print_r($inc_data);exit;
                        //     $col_name = $inc_data->mxincm_emp_col_name;
                        //     $html_data .= "<td>".$paysheet_data->$col_name."</td>";                
                        // }
                            $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";                
                        // //--------------------------END NET INCOME HEADS
                           
                        $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                        if($paysheet_data->mxsal_paid_status_flag == 1){$paid_status = 'PAID';}else{$paid_status = 'UNPAID';}
                        if(isset($paysheet_data->mxsal_createdtime) && !empty($paysheet_data->mxsal_createdtime))
                        {$createdDt = $paysheet_data->mxsal_createdtime;}else{$createdDt = '-';}
                            $html_data .= "<td>$paid_status</td>";
                            $html_data .= "<td>$createdDt</td>";
                        // $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";
    
                        $html_data .= "</tr>";
                        $sno = $sno + 1;
                    }
             
                     $html_data .= "</tbody>";
                     $html_data .= "</table>";
                     $html_data .= "</div>";
                     echo $html_data;exit;
                }
                else if($professionals_flag == 1){
                     $html_data = "<div class=\"table-responsive\">";
                     $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                     $html_data .= "<thead>";
                     $html_data .= "<tr>";
                     $html_data .= "<th>Sno</th>";
                     $html_data .= "<th>Month</th>"; 
                    //  $html_data .= "<th>Company Name</th>";
                     $html_data .= "<th>Division</th>";
                     $html_data .= "<th>Branch</th>";
                     $html_data .= "<th>State</th>"; 
                     $html_data .= "<th>Emp Id</th>";
                     $html_data .= "<th>Name</th>";
                     $html_data .= "<th>Department</th>"; 
                     $html_data .= "<th>Designation</th>";
                    //  $html_data .= "<th>UAN No</th>";
                    //  $html_data .= "<th>PF No</th>";
                    //  $html_data .= "<th>ESI No</th>";
                    //  $html_data .= "<th>Gratuity No</th>";
                     $html_data .= "<th>Type of Employement</th>";
                     $html_data .= "<th>Days in Month</th>"; 
                     $html_data .= "<th>Present Days</th>"; 
                     $html_data .= "<th>Sundays</th>";
                     $html_data .= "<th>Public/Optional Holidays</th>";
                     $html_data .= "<th>CL Adjustment</th>";
                     $html_data .= "<th>LOP</th>";
                    $html_data .= "<th>Total Days</th>";
                    $html_data .= "<th>RATE OF CONSULTANCY CHARGES PER MONTH</th>";
            
                    //--------------NET INCOME HEADS
                    $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                    foreach($incm_heads as $inc_data){
                        //   print_r($inc_data);exit;
                        $html_data .= "<th>$inc_data->mxincm_name</th>";                
                    }
                    //--------------END NET INCOME HEADS
                     $html_data .= "<th>TDS</th>";
                     $html_data .= "<th>NET AMOUNT</th>";
                     $html_data .= "</tr>";
                     $html_data .= "</thead>";
                     $html_data .= "<tbody>";
                     
                     $sno = 1;
                    foreach($paysheet_array as $paysheet_data){
                        //  print_r($paysheet_data);exit;
                        $html_data .= "<tr>";
                        $html_data .= "<td>$sno</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                        // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                        $html_data .= "<td>$paysheet_data->mxd_name</td>";
                        $html_data .= "<td>$paysheet_data->mxb_name</td>";
                        $html_data .= "<td>$paysheet_data->mxst_state</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                        $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                        $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                        $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                        // $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                        // $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                        // $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                        // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                        $html_data .= "<td>$emp_type_name</td>";
                        $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                        // print_r($leaves_data);exit;
                        $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                        $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                        $html_data .= "<td>$present_days</td>";
                        
                        $wo = $leaves_data[0]->Week_Off;
                        $html_data .= "<td>".$wo."</td>";
    
                        $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                        $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                        $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
                        // $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
                        // $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave; 
                        $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent; 
                        $public_holiday = $PH + $OH;
                        $html_data .= "<td>".$public_holiday."</td>";
                        // $html_data .= "<td>$SL</td>";//---->SL WITH PAY
                       
    
                        $html_data .= "<td>$CL</td>";//-->cl
                        // $html_data .= "<td>$SL</td>";//--->sl
                        // $html_data .= "<td>$EL</td>";//-->EL
                        $html_data .= "<td>$LOP</td>";//--->LOP                 
                        $total_days = $present_days + $wo + $public_holiday+$CL;
                        $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                        $html_data .= "<td>".(int)$paysheet_data->mxsal_gross_sal."</td>";
                        // //--------------------------NET INCOME HEADS
                        // foreach($incm_heads as $inc_data){
                        //     //   print_r($inc_data);exit;
                        //     $col_name = $inc_data->mxincm_emp_col_name;
                        //     $html_data .= "<td>".$paysheet_data->$col_name."</td>";                
                        // }
                        $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_prof_charges."</td>";                
                        // //--------------------------END NET INCOME HEADS
                           
                        $html_data .= "<td>".(int)$paysheet_data->mxsal_tds_amount."</td>";
                        $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                        // $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";
    
                        $html_data .= "</tr>";
                        $sno = $sno + 1;
                    }
             
                     $html_data .= "</tbody>";
                     $html_data .= "</table>";
                     $html_data .= "</div>";
                     echo $html_data;exit;
                }
                else if($directors_flag == 1){
                     $html_data = "<div class=\"table-responsive\">";
                     $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                     $html_data .= "<thead>";
                     $html_data .= "<tr>";
                     $html_data .= "<th>Sno</th>";
                     $html_data .= "<th>Month</th>"; 
                    //  $html_data .= "<th>Company Name</th>";
                     $html_data .= "<th>Division</th>";
                     $html_data .= "<th>Branch</th>";
                     $html_data .= "<th>State</th>"; 
                     $html_data .= "<th>Emp Id</th>";
                     $html_data .= "<th>Name</th>";
                     $html_data .= "<th>Department</th>"; 
                     $html_data .= "<th>Designation</th>";
                     $html_data .= "<th>UAN No</th>";
                     $html_data .= "<th>PF No</th>";
                     $html_data .= "<th>ESI No</th>";
                    //  $html_data .= "<th>Gratuity No</th>";
                     $html_data .= "<th>Days in Month</th>"; 
                     $html_data .= "<th>Present Days</th>"; 
                     $html_data .= "<th>Sundays</th>";
                     $html_data .= "<th>Public/Optional Holidays</th>";
                     $html_data .= "<th>Others</th>";
                     $html_data .= "<th>CL</th>";
                     $html_data .= "<th>SL</th>";
                     $html_data .= "<th>EL</th>";                                            
                     $html_data .= "<th>LOP</th>";
                     $html_data .= "<th>Total Days</th>";
                    //  $html_data .= "<th>BASIC</th>";
                    //  $html_data .= "<th>HRA</th>";
                    //--------------NET INCOME HEADS
                    $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                    foreach($incm_heads as $inc_data){
                        //   print_r($inc_data);exit;
                        $html_data .= "<th>$inc_data->mxincm_name</th>";                
                    }
                    //--------------END NET INCOME HEADS
        
                    
        
                    //  $html_data .= "<th>OA</th>";
                    //------------------------ACTUAL INCOME HEADS
                    $html_data .= "<th>BASIC</th>";
                    // $html_data .= "<th>HRA</th>";
                    //------------------------END ACTUAL INCOME HEADS
                    //---------------VARIABLE PAYS
                    $variable_heads_array = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = 1);
                    $year_month = date("Ym",strtotime("01-".$date));
                    $filtered_variable_heads_array = $this->Salaries_model->get_variable_heads_data_from_sal_table($variable_heads_array,$year_month,$emptype);
                   //  print_r($variable_heads);exit;
                   foreach($filtered_variable_heads_array as $filtered_variable_data){
                    //   $html_data .= "<th>$filtered_variable_data->mxincm_name</th>";//---->commeneted By Shababu(30-07-2022)(because variable pay and misc income both showing)
                       
                   }
                    //---------------END VARIABLE PAYS
        
        
                    //  $html_data .= "<th>OA</th>";                                        
                     $html_data .= "<th>TOTAL REMUNERATION</th>";//---->GROSS
                     $html_data .= "<th>PF</th>";
                    //  $html_data .= "<th>ESI</th>";
                    //  $html_data .= "<th>PT</th>";
                    //  $html_data .= "<th>LWF</th>";
                    //  $html_data .= "<th>LOAN</th>";
                    //  $html_data .= "<th>ADVANCE</th>";
                     $html_data .= "<th>TDS</th>";
                    //  $html_data .= "<th>MISC DED</th>";
                    //  $html_data .= "<th>TOTAL DEDUCTION</th>";
                     $html_data .= "<th>NET PAY</th>";
                     $html_data .= "<th>PF WAGE</th>";
                     $html_data .= "<th>EPS WAGE</th>";
                     $html_data .= "<th>EDLI WAGE</th>";
                     $html_data .= "<th>PF CON</th>";
                     $html_data .= "<th>EPS</th>";
                     $html_data .= "<th>EDLI</th>";
                     $html_data .= "<th>PF Admin</th>";
                    //  $html_data .= "<th>Esi Wages</th>";
                    //  $html_data .= "<th>Esi Company</th>";
                    //  $html_data .= "<th>Bonus</th>";
                     $html_data .= "<th>Gratuity</th>";
                    
                     $html_data .= "<th>LTA</th>";
                     $html_data .= "<th>MEDICLAIM</th>";
                     $html_data .= "<th>CTC</th>";
                     $html_data .= "<th>PAID STATUS</th>";
                     $html_data .= "</tr>";
                     $html_data .= "</thead>";
                     $html_data .= "<tbody>";
                     $sno = 1;
                     foreach($paysheet_array as $paysheet_data){
                        //  print_r($paysheet_data);exit;
                            $html_data .= "<tr>";
                            $html_data .= "<td>$sno</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                            $html_data .= "<td>$paysheet_data->mxd_name</td>";
                            $html_data .= "<td>$paysheet_data->mxb_name</td>";
                            $html_data .= "<td>$paysheet_data->mxst_state</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                            $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                            $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                            $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                            // print_r($leaves_data);exit;
                            $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                            $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                            $html_data .= "<td>$present_days</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_present_days</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_emp_weak_offs</td>";
                            $wo = $leaves_data[0]->Week_Off;
                            $html_data .= "<td>".$wo."</td>";
        
                            $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                            $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                            $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
                            $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
                            $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave; 
                            //----------NEW BY SHABABU(12-06-2022)
                            $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave; 
                            //----------NEW BY SHABABU(12-06-2022)
                            $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent; 
                            $public_holiday = $PH + $OH;
                            $html_data .= "<td>".$public_holiday."</td>";
                            // $html_data .= "<td>0</td>";//---->others Not using now
                            $html_data .= "<td>$ML</td>";//---->others Not using now
                           
        
                            $html_data .= "<td>$CL</td>";//-->cl
                            $html_data .= "<td>$SL</td>";//--->sl
                            $html_data .= "<td>$EL</td>";//-->EL
                            $html_data .= "<td>$LOP</td>";//--->LOP                 
                            $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL + $ML;
                            $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                            //--------------------------NET INCOME HEADS
                            foreach($incm_heads as $inc_data){
                                //   print_r($inc_data);exit;
                                $col_name = $inc_data->mxincm_emp_col_name;
                                $html_data .= "<th>".$paysheet_data->$col_name."</th>";                
                            }
                            //--------------------------END NET INCOME HEADS
        
                    
        
                            // $html_data .= "<td>$paysheet_data->mxsal_basic</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_hra</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_other_allowances</td>";
                            //--------------------------ACTUAL INCOME HEADS                    
                            $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_actual_hra</td>";
                            //--------------------------END ACTUAL INCOME HEADS
        
        
                            //--------------------------VARIABLE PAYS
                            foreach($filtered_variable_heads_array as $filtered_variable_data){
                                $variable_pay_col_name = $filtered_variable_data->mxincm_emp_col_name;
                                // $html_data .= "<th>".$paysheet_data->$variable_pay_col_name."</th>"; //----->commented By shababu(30-07-2022)                       
                            }
                            //--------------------------END VARIABLE PAYS        
                            // $html_data .= "<td></td>";//--->ACTUAL OA
                            $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_pf_emp_cont</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_pt</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_lwf_emp_cont</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_loan_amount</td>";
                            // $html_data .= "<td></td>";//--->ADVANCE
                            $html_data .= "<td>$paysheet_data->mxsal_tds_amount</td>";//--->TDS
                            // $html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";//--->MISC DED
                            // $html_data .= "<td>$paysheet_data->mxsal_total_ded</td>";//--->TOTAL DEDUCTIONS
                            $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";//---->PF WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_eps_wages</td>";//---->EPS WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_edli_wages</td>";//---->EDLI WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_pf_comp_cont</td>";//--->comp cont pf
                            $html_data .= "<td>$paysheet_data->mxsal_pf_pension_cont</td>";//--->PF pension cont
                            $html_data .= "<td>$paysheet_data->mxsal_pf_edli</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_pf_admin</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_gross_sal</td>";//--->ESI WAGES AS GROSS
                            // $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";//--->ESI WAGES AS ACTUAL GROSS
                            // $html_data .= "<td>$paysheet_data->mxsal_esi_wages</td>";//--->ESI WAGES AS ACTUAL GROSS
                            // $html_data .= "<td>$paysheet_data->mxsal_esi_comp_cont</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_bonus</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_gratuity_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_lta_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_mediclaim_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_ctc</td>";
                            if($paysheet_data->mxsal_paid_status_flag == 1){$paid_status = 'PAID';}else{$paid_status = 'UNPAID';}
                            $html_data .= "<td>$paid_status</td>";
                            $html_data .= "</tr>";
                            $sno = $sno + 1;
                     }
                     
                     $html_data .= "</tbody>";
                     $html_data .= "</table>";
                     $html_data .= "</div>";
                     echo $html_data;exit;
                }
                else{
                     $html_data = "<div class=\"table-responsive\">";
                     $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                     $html_data .= "<thead>";
                     $html_data .= "<tr>";
                     $html_data .= "<th>Sno</th>";
                     $html_data .= "<th>Month</th>"; 
                    //  $html_data .= "<th>Company Name</th>";
                     $html_data .= "<th>Division</th>";
                     $html_data .= "<th>Branch</th>";
                     $html_data .= "<th>State</th>"; 
                     $html_data .= "<th>Emp Id</th>";
                     $html_data .= "<th>Name</th>";
                     $html_data .= "<th>Department</th>"; 
                     $html_data .= "<th>Designation</th>";
                     $html_data .= "<th>UAN No</th>";
                     $html_data .= "<th>PF No</th>";
                     $html_data .= "<th>ESI No</th>";
                    //  $html_data .= "<th>Gratuity No</th>";
                     $html_data .= "<th>Days in Month</th>"; 
                     $html_data .= "<th>Present Days</th>"; 
                     $html_data .= "<th>Sundays</th>";
                     $html_data .= "<th>Public/Optional Holidays</th>";
                     $html_data .= "<th>Others</th>";
                     $html_data .= "<th>CL</th>";
                     $html_data .= "<th>SL</th>";
                     $html_data .= "<th>EL</th>";                                            
                     $html_data .= "<th>LOP</th>";
                     $html_data .= "<th>Total Days</th>";
                    //  $html_data .= "<th>BASIC</th>";
                    //  $html_data .= "<th>HRA</th>";
                    //--------------NET INCOME HEADS
                    $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                    foreach($incm_heads as $inc_data){
                        //   print_r($inc_data);exit;
                        $html_data .= "<th>$inc_data->mxincm_name</th>";                
                    }
                    //--------------END NET INCOME HEADS
        
                    
        
                    //  $html_data .= "<th>OA</th>";
                    //------------------------ACTUAL INCOME HEADS
                    $html_data .= "<th>BASIC</th>";
                    $html_data .= "<th>HRA</th>";
                    // $html_data .= "<th>MISC INC</th>";
                    //------------------------END ACTUAL INCOME HEADS
                    //---------------VARIABLE PAYS
                    $variable_heads_array = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = 1);
                    $year_month = date("Ym",strtotime("01-".$date));
                    $filtered_variable_heads_array = $this->Salaries_model->get_variable_heads_data_from_sal_table($variable_heads_array,$year_month,$emptype);
                   //  print_r($variable_heads);exit;
                   foreach($filtered_variable_heads_array as $filtered_variable_data){
                    //   $html_data .= "<th>$filtered_variable_data->mxincm_name</th>";//-------------->commeneted By Shababu(30-07-2022)
                       
                   }
                    //---------------END VARIABLE PAYS
        
        
                    //  $html_data .= "<th>OA</th>";                                        
                     $html_data .= "<th>MISC.INCOME</th>";//---->NEW BY SHABABU(20-07-2022)
                     $html_data .= "<th>GROSS</th>";
                     $html_data .= "<th>PF</th>";
                     $html_data .= "<th>ESI</th>";
                     $html_data .= "<th>PT</th>";
                     $html_data .= "<th>LWF EMP</th>";
                     $html_data .= "<th>LOAN</th>";
                     $html_data .= "<th>ADVANCE</th>";
                     $html_data .= "<th>TDS</th>";
                     $html_data .= "<th>MISC DED</th>";
                     $html_data .= "<th>TOTAL DEDUCTION</th>";
                     $html_data .= "<th>NET PAY</th>";
                     $html_data .= "<th>PF WAGE</th>";
                     $html_data .= "<th>EPS WAGE</th>";
                     $html_data .= "<th>EDLI WAGE</th>";
                     $html_data .= "<th>PF CON</th>";
                     $html_data .= "<th>EPS</th>";
                     $html_data .= "<th>EDLI</th>";
                     $html_data .= "<th>PF Admin</th>";
                     $html_data .= "<th>Esi Wages</th>";
                     $html_data .= "<th>Esi Company</th>";
                     $html_data .= "<th>Bonus</th>";
                     $html_data .= "<th>Bonus Payable</th>";
                     
                     $html_data .= "<th>LWF COMP</th>";
                     $html_data .= "<th>Gratuity</th>";
                    
                     $html_data .= "<th>LTA</th>";
                     $html_data .= "<th>MEDICLAIM</th>";
                     $html_data .= "<th>CTC</th>";
                     $html_data .= "<th>PAID STATUS</th>";
                     $html_data .= "</tr>";
                     $html_data .= "</thead>";
                     $html_data .= "<tbody>";
                     $sno = 1;
                     foreach($paysheet_array as $paysheet_data){
                        //  print_r($paysheet_data);exit;
                            $html_data .= "<tr>";
                            $html_data .= "<td>$sno</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                            $html_data .= "<td>$paysheet_data->mxd_name</td>";
                            $html_data .= "<td>$paysheet_data->mxb_name</td>";
                            $html_data .= "<td>$paysheet_data->mxst_state</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                            $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                            $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                            $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                            // if($paysheet_data->mxsal_emp_code == 'M0009'){
                            //     print_r($leaves_data);exit;
                            // }
                            $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                            /*$present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;*/

                             $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present +
                             $leaves_data[0]->regulation_full_day + $leaves_data[0]->First_Half_regulation + $leaves_data[0]->Second_Half_regulation +
                             $leaves_data[0]->First_Half_Shortleave + $leaves_data[0]->Second_Half_Shortleave +
                             $leaves_data[0]->ot_full_day + $leaves_data[0]->First_Half_ot + $leaves_data[0]->Second_Half_ot;
                            $html_data .= "<td>$present_days</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_present_days</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_emp_weak_offs</td>";
                            $wo = $leaves_data[0]->Week_Off;
                            $html_data .= "<td>".$wo."</td>";
        
                            $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                            $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                            $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
                            $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
                            $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave; 
                            //----------NEW BY SHABABU(12-06-2022)
                            $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave; 
                            //----------NEW BY SHABABU(12-06-2022)
                            $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent; 
                            $public_holiday = $PH + $OH;
                            $html_data .= "<td>".$public_holiday."</td>";
                            $html_data .= "<td>0</td>";//---->others Not using now
                           
        
                            $html_data .= "<td>$CL</td>";//-->cl
                            $html_data .= "<td>$SL</td>";//--->sl
                            $html_data .= "<td>$EL</td>";//-->EL
                            $html_data .= "<td>$LOP</td>";//--->LOP                 
                            $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL + $ML;
                            
                            $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                            //--------------------------NET INCOME HEADS
                            foreach($incm_heads as $inc_data){
                                //   print_r($inc_data);exit;
                                $col_name = $inc_data->mxincm_emp_col_name;
                                $html_data .= "<th>".$paysheet_data->$col_name."</th>";                
                            }
                            //--------------------------END NET INCOME HEADS
        
                    
        
                            // $html_data .= "<td>$paysheet_data->mxsal_basic</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_hra</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_other_allowances</td>";
                            //--------------------------ACTUAL INCOME HEADS                    
                            $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_actual_hra</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_actual_hra</td>";
                            //--------------------------END ACTUAL INCOME HEADS
        
        
                            //--------------------------VARIABLE PAYS
                            foreach($filtered_variable_heads_array as $filtered_variable_data){
                                $variable_pay_col_name = $filtered_variable_data->mxincm_emp_col_name;
                                // $html_data .= "<th>".$paysheet_data->$variable_pay_col_name."</th>"; //------------>commeneted By Shababu(30-07-2022)                       
                            }
                            //--------------------------END VARIABLE PAYS        
                            // $html_data .= "<td></td>";//--->ACTUAL OA
                            $html_data .= "<td>$paysheet_data->mxsal_incentive_amount</td>";// MISC.INCOME---------->NEW BY SHABABU(20-06-2022)
                            $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_pf_emp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_pt</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_lwf_emp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_loan_amount</td>";
                            $html_data .= "<td></td>";//--->ADVANCE
                            $html_data .= "<td>$paysheet_data->mxsal_tds_amount</td>";//--->TDS
                            $html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";//--->MISC DED
                            $html_data .= "<td>$paysheet_data->mxsal_total_ded</td>";//--->TOTAL DEDUCTIONS
                            $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";//---->PF WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_eps_wages</td>";//---->EPS WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_edli_wages</td>";//---->EDLI WAGE
                            $html_data .= "<td>$paysheet_data->mxsal_pf_comp_cont</td>";//--->comp cont pf
                            $html_data .= "<td>$paysheet_data->mxsal_pf_pension_cont</td>";//--->PF pension cont
                            $html_data .= "<td>$paysheet_data->mxsal_pf_edli</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_pf_admin</td>";
                            // $html_data .= "<td>$paysheet_data->mxsal_gross_sal</td>";//--->ESI WAGES AS GROSS
                            // $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";//--->ESI WAGES AS ACTUAL GROSS
                            $html_data .= "<td>$paysheet_data->mxsal_esi_wages</td>";//--->ESI WAGES AS ACTUAL GROSS
                            $html_data .= "<td>$paysheet_data->mxsal_esi_comp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_bonus</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_bonus_percentage_amount</td>";//---BONUS PAYABLE//--->NEW BY SHABABU(20-06-2022)
                            
                            $html_data .= "<td>$paysheet_data->mxsal_lwf_comp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_gratuity_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_lta_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_mediclaim_amount</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_ctc</td>";
                            if($paysheet_data->mxsal_paid_status_flag == 1){$paid_status = 'PAID';}else{$paid_status = 'UNPAID';}
                            $html_data .= "<td>$paid_status</td>";
                            $html_data .= "</tr>";
                            $sno = $sno + 1;
                     }
                     
                     $html_data .= "</tbody>";
                     $html_data .= "</table>";
                     $html_data .= "</div>";
                     echo $html_data;exit;
            }
            }
            // echo "bye";exit;
        }else{echo 402;exit;}
        }
        else{ //---->NORAML PAYSHEET
            $paysheet_array = $this->Salaries_model->getPaysheet($date,$company,$divison,$state,$branch,$emptype,$saltype,$emp_code);
            // print_r($paysheet_array);exit;
            if(count($paysheet_array) > 0){
            $emp_type_data = $this->Adminmodel->getemployeetypemasterdetails($emptype, $company);
            // print_r($emp_type_data);exit;
            
                if(count($emp_type_data) > 0){
                    $directors_flag = $emp_type_data[0]->mxemp_ty_is_director;
                    $professionals_flag = $emp_type_data[0]->mxemp_ty_is_professionals;
                    $trainees_flag = $emp_type_data[0]->mxemp_ty_is_trainees;

                    $emp_type_name = $emp_type_data[0]->mxemp_ty_name;
                    // echo $professionals_flag;exit;
                    if($trainees_flag == 1){ //---------TRAINEE
                         $html_data = "<div class=\"table-responsive\">";
                         $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                         $html_data .= "<thead>";
                         $html_data .= "<tr>";
                         $html_data .= "<th>Sno</th>";
                         $html_data .= "<th>Month</th>";
                        //  $html_data .= "<th>Company Name</th>";
                         $html_data .= "<th>Division</th>";
                         $html_data .= "<th>Branch</th>";
                         $html_data .= "<th>State</th>";
                         $html_data .= "<th>Emp Id</th>";
                         $html_data .= "<th>Name</th>";
                         $html_data .= "<th>Department</th>";
                         $html_data .= "<th>Designation</th>";
                         $html_data .= "<th>UAN No</th>";
                         $html_data .= "<th>PF No</th>";
                         $html_data .= "<th>ESI No</th>";
                         $html_data .= "<th>BANK Name</th>";
                         $html_data .= "<th>A/C NO</th>";
                         $html_data .= "<th>Branch Name</th>";
                         $html_data .= "<th>IFSC Code</th>";
                         $html_data .= "<th>Email Id</th>";
                        //  $html_data .= "<th>Gratuity No</th>";
                         $html_data .= "<th>Type of Employement</th>";
                         $html_data .= "<th>Days in Month</th>";
                         $html_data .= "<th>Present Days</th>";
                         $html_data .= "<th>Sundays</th>";
                         $html_data .= "<th>Public/Optional Holidays</th>";
                         $html_data .= "<th>SL With Pay</th>";
                        $html_data .= "<th>LOP</th>";
                        $html_data .= "<th>Total Days</th>";
                        $html_data .= "<th>STIPEND PER MONTH</th>";

                        //--------------NET INCOME HEADS
                        $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                        foreach($incm_heads as $inc_data){
                            //   print_r($inc_data);exit;
                            $html_data .= "<th>$inc_data->mxincm_name</th>";
                        }
                        //--------------END NET INCOME HEADS
                         $html_data .= "<th>ESI</th>";
                         $html_data .= "<th>NET PAY</th>";
                         $html_data .= "<th>PAID STATUS</th>";
                         $html_data .= "</tr>";
                         $html_data .= "</thead>";
                         $html_data .= "<tbody>";

                         $sno = 1;
                        foreach($paysheet_array as $paysheet_data){
                            //  print_r($paysheet_data);exit;
                            $html_data .= "<tr>";
                            $html_data .= "<td>$sno</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                            $html_data .= "<td>$paysheet_data->mxd_name</td>";
                            $html_data .= "<td>$paysheet_data->mxb_name</td>";
                            $html_data .= "<td>$paysheet_data->mxst_state</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                            $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                            $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_acc_no</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_branch_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_ifsci_no</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_email_id</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                            $html_data .= "<td>$emp_type_name</td>";
                            $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                            // print_r($leaves_data);exit;
                            $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                            $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                            $html_data .= "<td>$present_days</td>";

                            $wo = $leaves_data[0]->Week_Off;
                            $html_data .= "<td>".$wo."</td>";

                            $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                            $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                            // $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                            $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                            // $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                            //----------NEW BY SHABABU(12-06-2022)
                            // $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                            //----------NEW BY SHABABU(12-06-2022)
                            $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                            $public_holiday = $PH + $OH;
                            $html_data .= "<td>".$public_holiday."</td>";
                            $html_data .= "<td>$SL</td>";//---->SL WITH PAY


                            // $html_data .= "<td>$CL</td>";//-->cl
                            // $html_data .= "<td>$SL</td>";//--->sl
                            // $html_data .= "<td>$EL</td>";//-->EL
                            $html_data .= "<td>$LOP</td>";//--->LOP
                            $total_days = $present_days + $wo + $public_holiday+$SL;
                            $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                            $html_data .= "<td>".(int)$paysheet_data->mxsal_gross_sal."</td>";
                            // //--------------------------NET INCOME HEADS
                            // foreach($incm_heads as $inc_data){
                            //     //   print_r($inc_data);exit;
                            //     $col_name = $inc_data->mxincm_emp_col_name;
                            //     $html_data .= "<td>".$paysheet_data->$col_name."</td>";
                            // }
                                $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";
                            // //--------------------------END NET INCOME HEADS

                            $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                            // $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";

                            if($paysheet_data->mxsal_paid_status_flag == 1){
                                $status_label = '<span class="badge badge-success">PAID</span>';
                            } else {
                                $status_label = '<span class="badge badge-danger">UNPAID</span>';
                            }


                            $status_container = "<div id='status_container_".$paysheet_data->mxsal_id."'>";
                            $status_container .= $status_label;
                            $status_container .= " <a href='javascript:void(0)' class='edit-pay-status ml-1' 
                                                    data-id='".$paysheet_data->mxsal_id."' 
                                                    data-emptype='".$emptype."' 
                                                    data-name='".$paysheet_data->mxemp_emp_fname." ".$paysheet_data->mxemp_emp_lname."' 
                                                    data-code='".$paysheet_data->mxsal_emp_code."' 
                                                    data-current='".$paysheet_data->mxsal_paid_status_flag."'>
                                                    <i class='fa fa-edit text-primary'></i>
                                                  </a>";
                            $status_container .= "</div>";

                            $html_data .= "<td>$status_container</td>";

                            $html_data .= "</tr>";
                            $sno = $sno + 1;
                        }

                         $html_data .= "</tbody>";
                         $html_data .= "</table>";
                         $html_data .= "</div>";
                         echo $html_data;exit;
                    }
                    else if($professionals_flag == 1){
                         $html_data = "<div class=\"table-responsive\">";
                         $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                         $html_data .= "<thead>";
                         $html_data .= "<tr>";
                         $html_data .= "<th>Sno</th>";
                         $html_data .= "<th>Month</th>";
                        //  $html_data .= "<th>Company Name</th>";
                         $html_data .= "<th>Division</th>";
                         $html_data .= "<th>Branch</th>";
                         $html_data .= "<th>State</th>";
                         $html_data .= "<th>Emp Id</th>";
                         $html_data .= "<th>Name</th>";
                         $html_data .= "<th>Department</th>";
                         $html_data .= "<th>Designation</th>";
                         $html_data .= "<th>BANK Name</th>";
                         $html_data .= "<th>A/C NO</th>";
                         $html_data .= "<th>Branch Name</th>";
                         $html_data .= "<th>IFSC Code</th>";
                         $html_data .= "<th>Email Id</th>";
                        //  $html_data .= "<th>UAN No</th>";
                        //  $html_data .= "<th>PF No</th>";
                        //  $html_data .= "<th>ESI No</th>";
                        //  $html_data .= "<th>Gratuity No</th>";
                         $html_data .= "<th>Type of Employement</th>";
                         $html_data .= "<th>Days in Month</th>";
                         $html_data .= "<th>Present Days</th>";
                         $html_data .= "<th>Sundays</th>";
                         $html_data .= "<th>Public/Optional Holidays</th>";
                         $html_data .= "<th>CL Adjustment</th>";
                         $html_data .= "<th>LOP</th>";
                        $html_data .= "<th>Total Days</th>";
                        $html_data .= "<th>RATE OF CONSULTANCY CHARGES PER MONTH</th>";

                        //--------------NET INCOME HEADS
                        $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                        foreach($incm_heads as $inc_data){
                            //   print_r($inc_data);exit;
                            $html_data .= "<th>$inc_data->mxincm_name</th>";
                        }
                        //--------------END NET INCOME HEADS
                         $html_data .= "<th>TDS</th>";
                         $html_data .= "<th>NET AMOUNT</th>";
                         $html_data .= "</tr>";
                         $html_data .= "</thead>";
                         $html_data .= "<tbody>";

                         $sno = 1;
                        foreach($paysheet_array as $paysheet_data){
                            //  print_r($paysheet_data);exit;
                            $html_data .= "<tr>";
                            $html_data .= "<td>$sno</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                            $html_data .= "<td>$paysheet_data->mxd_name</td>";
                            $html_data .= "<td>$paysheet_data->mxb_name</td>";
                            $html_data .= "<td>$paysheet_data->mxst_state</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                            $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                            $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_acc_no</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_branch_name</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_bank_ifsci_no</td>";
                            $html_data .= "<td>$paysheet_data->mxemp_emp_email_id</td>";
                            // $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                            // $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                            // $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                            // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                            $html_data .= "<td>$emp_type_name</td>";
                            $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                            // print_r($leaves_data);exit;
                            $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                            $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                            $html_data .= "<td>$present_days</td>";

                            $wo = $leaves_data[0]->Week_Off;
                            $html_data .= "<td>".$wo."</td>";

                            $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                            $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                            $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                            // $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                            // $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                            //----------NEW BY SHABABU(12-06-2022)
                            // $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                            //----------NEW BY SHABABU(12-06-2022)
                            $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                            $public_holiday = $PH + $OH;
                            $html_data .= "<td>".$public_holiday."</td>";
                            // $html_data .= "<td>$SL</td>";//---->SL WITH PAY


                            $html_data .= "<td>$CL</td>";//-->cl
                            // $html_data .= "<td>$SL</td>";//--->sl
                            // $html_data .= "<td>$EL</td>";//-->EL
                            $html_data .= "<td>$LOP</td>";//--->LOP
                            $total_days = $present_days + $wo + $public_holiday+$CL;
                            // if($paysheet_data->mxsal_emp_code == 'MC0007'){
                            //     echo $total_days;exit;
                            // }
                            $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                            $html_data .= "<td>".(int)$paysheet_data->mxsal_gross_sal."</td>";
                            // //--------------------------NET INCOME HEADS
                            // foreach($incm_heads as $inc_data){
                            //     //   print_r($inc_data);exit;
                            //     $col_name = $inc_data->mxincm_emp_col_name;
                            //     $html_data .= "<td>".$paysheet_data->$col_name."</td>";
                            // }
                            $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_prof_charges."</td>";
                            // //--------------------------END NET INCOME HEADS

                            $html_data .= "<td>".(int)$paysheet_data->mxsal_tds_amount."</td>";
                            $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                            // $html_data .= "<td>".(int)$paysheet_data->mxsal_actual_tsp."</td>";

                            $html_data .= "</tr>";
                            $sno = $sno + 1;
                        }

                         $html_data .= "</tbody>";
                         $html_data .= "</table>";
                         $html_data .= "</div>";
                         echo $html_data;exit;
                    }
                    else if($directors_flag == 1){
                         $html_data = "<div class=\"table-responsive\">";
                         $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                         $html_data .= "<thead>";
                         $html_data .= "<tr>";
                         $html_data .= "<th>Sno</th>";
                         $html_data .= "<th>Month</th>";
                        //  $html_data .= "<th>Company Name</th>";
                         $html_data .= "<th>Division</th>";
                         $html_data .= "<th>Branch</th>";
                         $html_data .= "<th>State</th>";
                         $html_data .= "<th>Emp Id</th>";
                         $html_data .= "<th>Name</th>";
                         $html_data .= "<th>Department</th>";
                         $html_data .= "<th>Designation</th>";
                         $html_data .= "<th>UAN No</th>";
                         $html_data .= "<th>PF No</th>";
                         $html_data .= "<th>ESI No</th>";
                         $html_data .= "<th>BANK Name</th>";
                         $html_data .= "<th>A/C NO</th>";
                         $html_data .= "<th>Branch Name</th>";
                         $html_data .= "<th>IFSC Code</th>";
                         $html_data .= "<th>Email Id</th>";
                        //  $html_data .= "<th>Gratuity No</th>";
                         $html_data .= "<th>Days in Month</th>";
                         $html_data .= "<th>Present Days</th>";
                         $html_data .= "<th>Sundays</th>";
                         $html_data .= "<th>Public/Optional Holidays</th>";
                         $html_data .= "<th>Others</th>";
                         $html_data .= "<th>CL</th>";
                         $html_data .= "<th>SL</th>";
                         $html_data .= "<th>EL</th>";
                         $html_data .= "<th>LOP</th>";
                         $html_data .= "<th>Total Days</th>";
                        //  $html_data .= "<th>BASIC</th>";
                        //  $html_data .= "<th>HRA</th>";
                        //--------------NET INCOME HEADS
                        $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                        foreach($incm_heads as $inc_data){
                            //   print_r($inc_data);exit;
                            $html_data .= "<th>$inc_data->mxincm_name</th>";
                        }
                        //--------------END NET INCOME HEADS



                        //  $html_data .= "<th>OA</th>";
                        //------------------------ACTUAL INCOME HEADS
                        $html_data .= "<th>BASIC</th>";
                        // $html_data .= "<th>HRA</th>";
                        //------------------------END ACTUAL INCOME HEADS
                        //---------------VARIABLE PAYS
                        $variable_heads_array = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = 1);
                        $year_month = date("Ym",strtotime("01-".$date));
                        $filtered_variable_heads_array = $this->Salaries_model->get_variable_heads_data_from_sal_table($variable_heads_array,$year_month,$emptype);
                       //  print_r($variable_heads);exit;
                       foreach($filtered_variable_heads_array as $filtered_variable_data){
                        //   $html_data .= "<th>$filtered_variable_data->mxincm_name</th>";//--------->commeneted By Shababu(30-07-2022)

                       }
                        //---------------END VARIABLE PAYS


                        //  $html_data .= "<th>OA</th>";
                         $html_data .= "<th>TOTAL REMUNERATION</th>";//---->GROSS
                         $html_data .= "<th>PF</th>";
                        //  $html_data .= "<th>ESI</th>";
                        //  $html_data .= "<th>PT</th>";
                        //  $html_data .= "<th>LWF</th>";
                        //  $html_data .= "<th>LOAN</th>";
                        //  $html_data .= "<th>ADVANCE</th>";
                         $html_data .= "<th>TDS</th>";
                        //  $html_data .= "<th>MISC DED</th>";
                        //  $html_data .= "<th>TOTAL DEDUCTION</th>";
                         $html_data .= "<th>NET PAY</th>";
                         $html_data .= "<th>PF WAGE</th>";
                         $html_data .= "<th>EPS WAGE</th>";
                         $html_data .= "<th>EDLI WAGE</th>";
                         $html_data .= "<th>PF CON</th>";
                         $html_data .= "<th>EPS</th>";
                         $html_data .= "<th>EDLI</th>";
                         $html_data .= "<th>PF Admin</th>";
                        //  $html_data .= "<th>Esi Wages</th>";
                        //  $html_data .= "<th>Esi Company</th>";
                        //  $html_data .= "<th>Bonus</th>";
                         $html_data .= "<th>Gratuity</th>";

                         $html_data .= "<th>LTA</th>";
                         $html_data .= "<th>MEDICLAIM</th>";
                         $html_data .= "<th>CTC</th>";
                         $html_data .= "<th>PAID STATUS</th>";
                         $html_data .= "</tr>";
                         $html_data .= "</thead>";
                         $html_data .= "<tbody>";
                         $sno = 1;
                         foreach($paysheet_array as $paysheet_data){
                            //  print_r($paysheet_data);exit;
                                $html_data .= "<tr>";
                                $html_data .= "<td>$sno</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                                // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                                $html_data .= "<td>$paysheet_data->mxd_name</td>";
                                $html_data .= "<td>$paysheet_data->mxb_name</td>";
                                $html_data .= "<td>$paysheet_data->mxst_state</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                                $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                                $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_acc_no</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_branch_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_ifsci_no</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_email_id</td>";
                                // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                                $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                                // print_r($leaves_data);exit;
                                $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                                $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                                $html_data .= "<td>$present_days</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_present_days</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_emp_weak_offs</td>";
                                $wo = $leaves_data[0]->Week_Off;
                                $html_data .= "<td>".$wo."</td>";

                                $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                                $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                                $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                                $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                                $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                                //----------NEW BY SHABABU(12-06-2022)
                                // $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                                //----------NEW BY SHABABU(12-06-2022)
                                $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                                $public_holiday = $PH + $OH;
                                $html_data .= "<td>".$public_holiday."</td>";
                                $html_data .= "<td>0</td>";//---->others Not using now


                                $html_data .= "<td>$CL</td>";//-->cl
                                $html_data .= "<td>$SL</td>";//--->sl
                                $html_data .= "<td>$EL</td>";//-->EL
                                $html_data .= "<td>$LOP</td>";//--->LOP
                                $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL;
                                $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                                //--------------------------NET INCOME HEADS
                                foreach($incm_heads as $inc_data){
                                    //   print_r($inc_data);exit;
                                    $col_name = $inc_data->mxincm_emp_col_name;
                                    $html_data .= "<th>".$paysheet_data->$col_name."</th>";
                                }
                                //--------------------------END NET INCOME HEADS



                                // $html_data .= "<td>$paysheet_data->mxsal_basic</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_hra</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_other_allowances</td>";
                                //--------------------------ACTUAL INCOME HEADS
                                $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_actual_hra</td>";
                                //--------------------------END ACTUAL INCOME HEADS


                                //--------------------------VARIABLE PAYS
                                foreach($filtered_variable_heads_array as $filtered_variable_data){
                                    $variable_pay_col_name = $filtered_variable_data->mxincm_emp_col_name;
                                    // $html_data .= "<th>".$paysheet_data->$variable_pay_col_name."</th>";//--------->commeneted By Shababu(30-07-2022)
                                }
                                //--------------------------END VARIABLE PAYS
                                // $html_data .= "<td></td>";//--->ACTUAL OA
                                $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_pf_emp_cont</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_pt</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_lwf_emp_cont</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_loan_amount</td>";
                                // $html_data .= "<td></td>";//--->ADVANCE
                                $html_data .= "<td>$paysheet_data->mxsal_tds_amount</td>";//--->TDS
                                // $html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";//--->MISC DED
                                // $html_data .= "<td>$paysheet_data->mxsal_total_ded</td>";//--->TOTAL DEDUCTIONS
                                $html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";//---->PF WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_eps_wages</td>";//---->EPS WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_edli_wages</td>";//---->EDLI WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_pf_comp_cont</td>";//--->comp cont pf
                                $html_data .= "<td>$paysheet_data->mxsal_pf_pension_cont</td>";//--->PF pension cont
                                $html_data .= "<td>$paysheet_data->mxsal_pf_edli</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_pf_admin</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_gross_sal</td>";//--->ESI WAGES AS GROSS
                                // $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";//--->ESI WAGES AS ACTUAL GROSS
                                // $html_data .= "<td>$paysheet_data->mxsal_esi_wages</td>";//--->ESI WAGES AS ACTUAL GROSS
                                // $html_data .= "<td>$paysheet_data->mxsal_esi_comp_cont</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_bonus</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_gratuity_amount</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_lta_amount</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_mediclaim_amount</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_ctc</td>";
                             if($paysheet_data->mxsal_paid_status_flag == 1){
                                 $status_label = '<span class="badge badge-success">PAID</span>';
                             } else {
                                 $status_label = '<span class="badge badge-danger">UNPAID</span>';
                             }

// Wrapper for live DOM update, passing the current $emptype for Directors
                             $status_container = "<div id='status_container_".$paysheet_data->mxsal_id."'>";
                             $status_container .= $status_label;
                             $status_container .= " <a href='javascript:void(0)' class='edit-pay-status ml-1' 
                                                    data-id='".$paysheet_data->mxsal_id."' 
                                                    data-emptype='".$emptype."' 
                                                    data-name='".$paysheet_data->mxemp_emp_fname." ".$paysheet_data->mxemp_emp_lname."' 
                                                    data-code='".$paysheet_data->mxsal_emp_code."' 
                                                    data-current='".$paysheet_data->mxsal_paid_status_flag."'>
                                                    <i class='fa fa-edit text-primary'></i>
                                                  </a>";
                             $status_container .= "</div>";

                             $html_data .= "<td>$status_container</td>";
                                $html_data .= "</tr>";
                                $sno = $sno + 1;
                         }

                         $html_data .= "</tbody>";
                         $html_data .= "</table>";
                         $html_data .= "</div>";
                         echo $html_data;exit;
                    }
                    else{ // For Employee
                         $html_data = "<div class=\"table-responsive\">";
                         $html_data .= "<table class=\"datatable table table-stripped mb-0\" id=\"dataTables-example\">";
                         $html_data .= "<thead>";
                         $html_data .= "<tr>";
                         $html_data .= "<th>Sno</th>";
                         $html_data .= "<th>Month</th>";
                        //  $html_data .= "<th>Company Name</th>";
                         $html_data .= "<th>Division</th>";
                         $html_data .= "<th>Branch</th>";
                         $html_data .= "<th>State</th>";
                         $html_data .= "<th>Emp Id</th>";
                         $html_data .= "<th>Name</th>";
                         $html_data .= "<th>Department</th>";
                         $html_data .= "<th>Designation</th>";
                         $html_data .= "<th>UAN No</th>";
                         $html_data .= "<th>PF No</th>";
                         $html_data .= "<th>ESI No</th>";
                         $html_data .= "<th>BANK Name</th>";
                         $html_data .= "<th>A/C NO</th>";
                         $html_data .= "<th>Branch Name</th>";
                         $html_data .= "<th>IFSC Code</th>";
                         $html_data .= "<th>Email Id</th>";
                        //  $html_data .= "<th>Gratuity No</th>";
                         $html_data .= "<th>Days in Month</th>";
                         $html_data .= "<th>Present Days</th>";
                         $html_data .= "<th>Sundays</th>";
                         $html_data .= "<th>Public/Optional Holidays</th>";
                         $html_data .= "<th>Others</th>";
                         $html_data .= "<th>CL</th>";
                         $html_data .= "<th>SL</th>";
                         $html_data .= "<th>EL</th>";
                         $html_data .= "<th>ML</th>";
                         $html_data .= "<th>LOP</th>";
                         $html_data .= "<th>Total Days</th>";
                        //  $html_data .= "<th>BASIC</th>";
                        //  $html_data .= "<th>HRA</th>";
                        //--------------NET INCOME HEADS
                        $incm_heads = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = null);
                        foreach($incm_heads as $inc_data){
                            //   print_r($inc_data);exit;
                            $html_data .= "<th>$inc_data->mxincm_name</th>";
                        }
                        //--------------END NET INCOME HEADS



                        //  $html_data .= "<th>OA</th>";
                        //------------------------ACTUAL INCOME HEADS
                        $html_data .= "<th>BASIC</th>";
                        $html_data .= "<th>HRA</th>";
                        //------------------------END ACTUAL INCOME HEADS
                        //---------------VARIABLE PAYS
                        $variable_heads_array = $this->Adminmodel->get_income_types($income_id = null, $company, $emptype,$is_variablepay = 1);
                        $year_month = date("Ym",strtotime("01-".$date));
                        $filtered_variable_heads_array = $this->Salaries_model->get_variable_heads_data_from_sal_table($variable_heads_array,$year_month,$emptype);
                       //  print_r($variable_heads);exit;
                       foreach($filtered_variable_heads_array as $filtered_variable_data){
                        //   $html_data .= "<th>$filtered_variable_data->mxincm_name</th>";//--------->commeneted By Shababu(30-07-2022)

                       }
                        //---------------END VARIABLE PAYS


                        //  $html_data .= "<th>OA</th>";
                        $html_data .= "<th>MISC.INCOME</th>";//---->NEW BY SHABABU(20-07-2022)
                         $html_data .= "<th>GROSS</th>";
                         $html_data .= "<th>PF</th>";
                         $html_data .= "<th>ESI</th>";
                         $html_data .= "<th>PT</th>";
                         $html_data .= "<th>LWF EMP</th>";
                         $html_data .= "<th>LOAN</th>";
                         $html_data .= "<th>ADVANCE</th>";
                         $html_data .= "<th>TDS</th>";
                         $html_data .= "<th>MISC DED</th>";
                         $html_data .= "<th>TOTAL DEDUCTION</th>";
                         $html_data .= "<th>NET PAY</th>";
                         $html_data .= "<th>PF WAGE</th>";
                         $html_data .= "<th>EPS WAGE</th>";
                         $html_data .= "<th>EDLI WAGE</th>";
                         $html_data .= "<th>PF CON</th>";
                         $html_data .= "<th>EPS</th>";
                         $html_data .= "<th>EDLI</th>";
                         $html_data .= "<th>PF Admin</th>";
                         $html_data .= "<th>Esi Wages</th>";
                         $html_data .= "<th>Esi Company</th>";
                         $html_data .= "<th>Bonus</th>";
                         $html_data .= "<th>Bonus Payable</th>";

                         $html_data .= "<th>LWF COMP</th>";
                         $html_data .= "<th>Gratuity</th>";


                         $html_data .= "<th>LTA</th>";
                         $html_data .= "<th>MEDICLAIM</th>";
                         $html_data .= "<th>CTC</th>";
                         $html_data .= "<th>PAID STATUS</th>";
                         $html_data .= "<th>attachment </th>";
                         $html_data .= "<th>Date Created </th>";
                         $html_data .= "</tr>";
                         $html_data .= "</thead>";
                         $html_data .= "<tbody>";
                         $sno = 1;
                         foreach($paysheet_array as $paysheet_data){
                            //  print_r($paysheet_data);exit;
                                $html_data .= "<tr>";
                                $html_data .= "<td>$sno</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_year_month</td>";
                                // $html_data .= "<td>$paysheet_data->mxcp_name</td>";
                                $html_data .= "<td>$paysheet_data->mxd_name</td>";
                                $html_data .= "<td>$paysheet_data->mxb_name</td>";
                                $html_data .= "<td>$paysheet_data->mxst_state</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_emp_code</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_fname $paysheet_data->mxemp_emp_lname</td>";
                                $html_data .= "<td>$paysheet_data->mxdpt_name</td>";
                                $html_data .= "<td>$paysheet_data->mxdesg_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_uan_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_pf_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_esi_number</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_acc_no</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_branch_name</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_bank_ifsci_no</td>";
                                $html_data .= "<td>$paysheet_data->mxemp_emp_email_id</td>";
                                // $html_data .= "<td>$paysheet_data->mxcp_gratuity_reg_no</td>";
                                // $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheet_data->mxsal_emp_code,$year."_".$month);
                                // print_r($leaves_data);exit;
                                $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                                // $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                                // $html_data .= "<td>$present_days</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_present_days_from_attendance</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_present_days</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_emp_weak_offs</td>";
                                // $wo = $leaves_data[0]->Week_Off;
                                // $html_data .= "<td>".$wo."</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_sundays_from_attendance</td>";

                                // $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                                // $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                                // $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                                // $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                                // $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                                // //----------NEW BY SHABABU(12-06-2022)
                                // $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                                // //----------NEW BY SHABABU(12-06-2022)
                                // $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                                // $public_holiday = $PH + $OH;
                                // $html_data .= "<td>".$public_holiday."</td>";
                                $public_holiday = $paysheet_data->mxsal_public_holidays_from_attendance + $paysheet_data->mxsal_optional_holidays_from_attendance;
                                $html_data .= "<td>".$public_holiday."</td>";
                                $html_data .= "<td>0</td>";//---->others Not using now


                                // $html_data .= "<td>$CL</td>";//-->cl
                                // $html_data .= "<td>$SL</td>";//--->sl
                                // $html_data .= "<td>$EL</td>";//-->EL
                                // $html_data .= "<td>$ML</td>";//---->ML
                                // $html_data .= "<td>$LOP</td>";//--->LOP
                                $html_data .= "<td>$paysheet_data->mxsal_cl_from_attendance</td>";//-->cl
                                $html_data .= "<td>$paysheet_data->mxsal_sl_from_attendance</td>";//--->sl
                                $html_data .= "<td>$paysheet_data->mxsal_el_from_attendance</td>";//-->EL
                                $html_data .= "<td>$paysheet_data->mxsal_ml_from_attendance</td>";//---->ML
                                $html_data .= "<td>$paysheet_data->mxsal_lop_from_attendance</td>";//--->LOP



                                // $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL + $ML;
                                // $html_data .= "<td>$total_days</td>";//--->TOTAL DAYS
                                $html_data .= "<td>$paysheet_data->mxsal_total_days_from_attendance</td>";//--->TOTAL DAYS
                                //--------------------------NET INCOME HEADS
                                foreach($incm_heads as $inc_data){
                                    //   print_r($inc_data);exit;
                                    $col_name = $inc_data->mxincm_emp_col_name;
                                    $html_data .= "<th>".$paysheet_data->$col_name."</th>";
                                }
                                //--------------------------END NET INCOME HEADS



                                // $html_data .= "<td>$paysheet_data->mxsal_basic</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_hra</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_other_allowances</td>";
                                //--------------------------ACTUAL INCOME HEADS
                                $html_data .= "<td>$paysheet_data->mxsal_actual_basic</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_actual_hra</td>";
                                //--------------------------END ACTUAL INCOME HEADS


                                //--------------------------VARIABLE PAYS
                                foreach($filtered_variable_heads_array as $filtered_variable_data){
                                    $variable_pay_col_name = $filtered_variable_data->mxincm_emp_col_name;
                                    // $html_data .= "<th>".$paysheet_data->$variable_pay_col_name."</th>";//--------->commeneted By Shababu(30-07-2022)
                                }
                                //--------------------------END VARIABLE PAYS
                                // $html_data .= "<td></td>";//--->ACTUAL OA
                                $html_data .= "<td>$paysheet_data->mxsal_incentive_amount</td>";// MISC.INCOME---------->NEW BY SHABABU(20-06-2022)
                                $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_pf_emp_cont</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_esi_emp_cont</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_pt</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_lwf_emp_cont</td>";

                                $emp_code=$paysheet_data->mxsal_emp_code;
                                $tot_loan_amt='';
                                $sql5 = " SELECT sum(mxemploan_emp_loan_debited_amt) as tot_loan_amt FROM `maxwell_emp_loan_master` WHERE `mxemploan_empcode` LIKE '$emp_code' and mxemploan_emp_loan_outstanding_amt > 0 AND mxemploan_status = 1 ";
     $result5 = $this->db->query($sql5);
      $lastrowofareq5=$result5->result_array();
      $oldLead_id5=$result5->num_rows() ;
      if($oldLead_id5>0 && $lastrowofareq5['0']['tot_loan_amt'] > 0){
        $tot_loan_amt=$lastrowofareq5['0']['tot_loan_amt'];
      }

     $mxsal_actual_gross= $paysheet_data->mxsal_actual_gross;
     if($mxsal_actual_gross==0)
     {
         $tot_loan_amt=0;
     }
                                $html_data .= "<td>$paysheet_data->mxsal_loan_amount</td>";
                                // $html_data .= "<td>$tot_loan_amt</td>";
                                $html_data .= "<td></td>";//--->ADVANCE
                                $html_data .= "<td>$paysheet_data->mxsal_tds_amount</td>";//--->TDS
                                $html_data .= "<td>$paysheet_data->mxsal_miscelleneous_amount</td>";//--->MISC DED

                                $mxsal_total_ded=round($paysheet_data->mxsal_total_ded);

                                /*if($oldLead_id5>0 && $lastrowofareq5['0']['tot_loan_amt'] > 0){
                                    $mxsal_loan_amount = $paysheet_data->mxsal_loan_amount;
                                    $mxsal_total_ded = $mxsal_total_ded - $mxsal_loan_amount;
                                    $mxsal_total_ded = $mxsal_total_ded + $tot_loan_amt;
                                }*/

                                //$html_data .= "<td>$paysheet_data->mxsal_total_ded</td>";//--->TOTAL DEDUCTIONS
                                $html_data .= "<td>$mxsal_total_ded</td>";//--->TOTAL DEDUCTIONS
                                $mxsal_actual_gross=$paysheet_data->mxsal_actual_gross;
                                $mxsal_net_sal=$mxsal_actual_gross-$mxsal_total_ded;
                                $mxsal_net_sal=round($mxsal_net_sal);
                                //$html_data .= "<td>$paysheet_data->mxsal_net_sal</td>";

                                $maxsal_epf_wages = (!empty($paysheet_data->mxsal_epf_wages) && is_numeric($paysheet_data->mxsal_epf_wages) && $paysheet_data->mxsal_epf_wages > 0) ? $paysheet_data->mxsal_epf_wages : $paysheet_data->mxsal_actual_basic;
                                $html_data .= "<td>$mxsal_net_sal</td>";
                                $html_data .= "<td>$maxsal_epf_wages</td>";//---->PF WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_eps_wages</td>";//---->EPS WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_edli_wages</td>";//---->EDLI WAGE
                                $html_data .= "<td>$paysheet_data->mxsal_pf_comp_cont</td>";//--->comp cont pf
                                $html_data .= "<td>$paysheet_data->mxsal_pf_pension_cont</td>";//--->PF pension cont
                                $html_data .= "<td>$paysheet_data->mxsal_pf_edli</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_pf_admin</td>";
                                // $html_data .= "<td>$paysheet_data->mxsal_gross_sal</td>";//--->ESI WAGES AS GROSS
                                // $html_data .= "<td>$paysheet_data->mxsal_actual_gross</td>";//--->ESI WAGES AS ACTUAL GROSS
                                $html_data .= "<td>$paysheet_data->mxsal_esi_wages</td>";//--->ESI WAGES AS ACTUAL GROSS
                                $html_data .= "<td>$paysheet_data->mxsal_esi_comp_cont</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_bonus</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_bonus_percentage_amount</td>";//---BONUS PAYABLE//--->NEW BY SHABABU(20-06-2022)
                                $html_data .= "<td>$paysheet_data->mxsal_lwf_comp_cont</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_gratuity_amount</td>";

                                $html_data .= "<td>$paysheet_data->mxsal_lta_amount</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_mediclaim_amount</td>";
                                $html_data .= "<td>$paysheet_data->mxsal_ctc</td>";
                                //if($paysheet_data->mxsal_paid_status_flag == 1){$paid_status = 'PAID';}else{$paid_status = 'UNPAID';}

                                 // Paid Status UPDATE STATUS
                                 if($paysheet_data->mxsal_paid_status_flag == 1){
                                     $status_label = '<span class="badge badge-success">PAID</span>';
                                 } else {
                                     $status_label = '<span class="badge badge-danger">UNPAID</span>';
                                 }

    // Wrapper with unique ID for live DOM update
                                 $status_html = "<div id='status_container_".$paysheet_data->mxsal_id."'>";
                                 $status_html .= $status_label;
                                 $status_html .= " <a href='javascript:void(0)' class='edit-pay-status ml-1' 
                                                    data-id='".$paysheet_data->mxsal_id."' 
                                                    data-emptype='".$emptype."' 
                                                    data-name='".$paysheet_data->mxemp_emp_fname." ".$paysheet_data->mxemp_emp_lname."' 
                                                    data-code='".$paysheet_data->mxsal_emp_code."' 
                                                    data-current='".$paysheet_data->mxsal_paid_status_flag."'>
                                                    <i class='fa fa-edit text-primary'></i>
                                                  </a>";
                                 $status_html .= "</div>";

                                 $html_data .= "<td>$status_html</td>";
                                $file_name_pdf = base_url() . "uploads/payslips/".$month."-".$year."-".$paysheet_data->mxsal_emp_code.".pdf";
                                $html_data .= "<td><a href='$file_name_pdf' target='_blank'>payslip</a></td>";
                                $html_data .= "<td>$paysheet_data->mxsal_createdtime</td>";
                                $html_data .= "</tr>";
                                $sno = $sno + 1;
                         }

                         $html_data .= "</tbody>";
                         $html_data .= "</table>";
                         $html_data .= "</div>";
                         echo $html_data;exit;
                }
                }
                // echo "bye";exit;
            }else{echo 402;exit;}
        }
        //------END PAYSHEET
        

    }

    public function update_paysheet_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $emp_type_id = $this->input->post('emptype'); // passing the type ID

        if (!empty($id) && !empty($emp_type_id)) {
            // 1. Get the specific table name for this employee type
            $emp_type_data = $this->db->get_where('maxwell_employee_type_master', array('mxemp_ty_id' => $emp_type_id))->row();
            $table_name = $emp_type_data->mxemp_ty_table_name; // e.g., 'mxsal_m'

            if($table_name) {
                // 2. Update the status in the specific table
                $this->db->where('mxsal_id', $id);
                $this->db->update($table_name, array('mxsal_paid_status_flag' => $status));

                // 3. Get info for UI refresh (assuming standard column names across these tables)
                $query = $this->db->select('mxsal_emp_code, mxemp_emp_fname, mxemp_emp_lname')
                    ->from($table_name)
                    ->join('maxwell_employees_info', 'mxemp_emp_comp_code = mxsal_cmp_id and mxemp_emp_type = mxsal_emp_type and mxemp_emp_id = mxsal_emp_code')
                    ->where('mxsal_id', $id)->get()->row();

                echo json_encode(array(
                    'status' => 'success',
                    'emp_name' => $query->mxemp_emp_fname . ' ' . $query->mxemp_emp_lname,
                    'emp_code' => $query->mxsal_emp_code
                ));
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
        }
        exit;
    }


    public function save_fandf_data(){
        $this->verifylogin();
        $final_data = $this->input->post();  
        // $this->load->model('Salaries_model');
        // print_r($data);
        // exit;
        $emp_code = $final_data['emp_code'];
        $array = array();
        $array['emp_id'] = $emp_code;
        $data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees($array);
        // echo '<pre>';
        // print_r($data['emp_data'][0]);exit;
        
        $cmp_id = $data['emp_data'][0]->mxemp_emp_comp_code;
        $emp_type_id = $data['emp_data'][0]->mxemp_emp_type;
        $relive_date = $data['emp_data'][0]->mxemp_emp_resignation_relieving_date;
        if(date('Y-m-d') < date('Y-m-d',strtotime($relive_date))){
            $final_date = date('Y-m-d');
            // $final_date_y_m = date('Y_m');
        }else{
            $final_date = date('Y-m-d',strtotime($relive_date)); 
            // $final_date_y_m = date('Y_m',strtotime($relive_date)); 
        }
        $final_data['month_year'] = $final_date;
        $final_data['cmp_id'] = $cmp_id;
        // print_r($final_data);exit;
        $data = $this->Salaries_model->save_fandf_data($final_data);
        // echo $data;exit;
        if($data){
            echo 200;
        }else{
            echo 500;
        }
    }
    
    public function update_fandf_bank_status()
    {
        $this->verifylogin();
        $data = $this->input->post();  
        // print_r($data);exit;
        $res = $this->Salaries_model->update_fandf_bank_status($data);
        echo $res;exit;
    }
    
    
    public function save_fandf_left_data(){
        $this->verifylogin();
        $final_data = $this->input->post();  
        // $this->load->model('Salaries_model');
        // print_r($final_data);
        // exit;
        $emp_code = $final_data['emp_code'];
        $array = array();
        $array['emp_id'] = $emp_code;
        $data['emp_data'] = $this->Adminmodel->get_notice_peiod_employees($array);
        
         //echo '<pre>';
        //print_r($data);exit;
        
        $cmp_id = $data['emp_data'][0]->mxemp_emp_comp_code;
        $emp_type_id = $data['emp_data'][0]->mxemp_emp_type;
        $relive_date = $data['emp_data'][0]->mxemp_emp_resignation_relieving_date;
        // echo $relive_date;exit;
        // echo date('Y-m-d',strtotime($relive_date));exit;
        // if(date('Y-m-d') < date('Y-m-d',strtotime($relive_date))){
        //     $final_date = date('Y-m-d');
        //     // $final_date_y_m = date('Y_m');
        // }else{
            $final_date = date('Y-m-d',strtotime($relive_date)); 
            // $final_date_y_m = date('Y_m',strtotime($relive_date)); 
        // }
        $final_data['month_year'] = $final_date;
        $final_data['cmp_id'] = $cmp_id;
        // print_r($final_data);exit;
        $data = $this->Salaries_model->save_fandf_left_data($final_data);
         //echo '<pre>';
        //print_r($data);exit;
        return $data;
    }
     public function assign_single_emp_sal(){
        $this->verifylogin();
        $this->header(); 
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $data['divisiondetails'] = $this->Adminmodel->getdivisiondetails($id = '');
        $this->load->view("Salaries/salary_assign_single_employee",$data);
        $this->footer();
    }
    
    public function generate_single_emp_salarie(){
        $emp_data = $this->input->post();

        if(!isset($emp_data['yearmonth']) || empty($emp_data['yearmonth'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Month and Year Selection"));exit();
        }

        if(!isset($emp_data['emptype']) || empty($emp_data['emptype'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Employement Type"));exit();
        }

        if(!isset($emp_data['emp_code']) || empty($emp_data['emp_code'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Employee Id"));exit();
        }

        $emp_data['sal_month_year'] = $emp_data['yearmonth'];
        // print_r($emp_data);exit;
        $res =  $this->Salaries_model->generate_single_emp_salarie_new($emp_data);
    }
    
    // UNHOLD SALARY
    public function unhold_salary(){
        $this->verifylogin();
		$this->header();
		$data['cmpmaster'] = $this->Adminmodel->getcompany_master();
		// $data['emptypedetails'] = $this->Adminmodel->getemployeetypemasterdetails($id = '');
		$this->load->view('Salaries/unhold_salary',$data);
		$this->footer();	
	}
	public function getUnholdSalary(){
        $company = $this->input->post("company");
        $divison = $this->input->post("divison");
        $state = $this->input->post("state");
        $branch = $this->input->post("branch");
        $emptype = $this->input->post("emptype");
        $emp_code = ($this->input->post("emp_code") != null)?$this->input->post("emp_code"):"";
        $data['unhold_sal_data'] = $this->Salaries_model->getPaysheet(null,$company,$divison,$state,$branch,$emptype,0,$emp_code);
        $data['emptype'] = $emptype;
        $this->load->view('Salaries/unhold_salary_table',$data);
        // print_r($paysheet_array);exit;
	}
    public function unhold_specific_data(){
        $unhold_data = $this->input->post('id');
        $ex = explode('~',$unhold_data);
        $sal_id = $ex[0];
        $emp_type = $ex[1];
		$final_data = $this->Salaries_model->unhold_specific_data($sal_id,$emp_type);
		if($final_data){
		    echo "200";exit;
		}
	}
    // END UNHOLD SALARY

    public function assign_single_emp_sal_resign(){
        $this->verifylogin();
        $this->header();
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $data['divisiondetails'] = $this->Adminmodel->getdivisiondetails($id = '');
        $this->load->view("Salaries/salary_assign_single_employee_resign",$data);
        $this->footer();
    }

    public function generate_single_emp_salarie_resign(){
        $emp_data = $this->input->post();

        if(!isset($emp_data['yearmonth']) || empty($emp_data['yearmonth'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Month and Year Selection"));exit();
        }

        if(!isset($emp_data['emptype']) || empty($emp_data['emptype'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Employement Type"));exit();
        }

        if(!isset($emp_data['emp_code']) || empty($emp_data['emp_code'])){
            echo json_encode(array("status" => 0, "message" => "Invalid Employee Id"));exit();
        }

        $emp_data['sal_month_year'] = $emp_data['yearmonth'];
        /// echo "<pre>";print_r($emp_data);exit;
        $res =  $this->Salaries_model->generate_single_emp_salarie_resigned($emp_data);
    }
}
 function convertToIndianCurrencyWords($number) {
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three',
        '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen',
        '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen',
        '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty',
        '40' => 'forty', '50' => 'fifty', '60' => 'sixty',
        '70' => 'seventy', '80' => 'eighty', '90' => 'ninety'
    );

    // Split into rupees and paise
    $number = number_format((float)$number, 2, '.', '');
    list($rupees, $paise) = explode('.', $number);

    $result = '';
    $rupees_in_words = convertToIndianWords((int)$rupees, $words);

    if ($rupees_in_words != '') {
        $result .= $rupees_in_words . ' rupees';
    }

    if ((int)$paise > 0) {
        $paise_in_words = convertToIndianWords((int)$paise, $words);
        $result .= ' and ' . $paise_in_words . ' paise';
    }

    return 'IN WORDS: ' . strtoupper(trim($result)) . ' ONLY';
}

  function convertToIndianWords($number, $words) {
    if ($number == 0) return 'zero';

    $number_str = str_pad($number, 9, '0', STR_PAD_LEFT);
    $crore    = (int)substr($number_str, 0, 2);
    $lakh     = (int)substr($number_str, 2, 2);
    $thousand = (int)substr($number_str, 4, 2);
    $hundred  = (int)substr($number_str, 6, 1);
    $rest     = (int)substr($number_str, 7, 2);

    $str = '';

    if ($crore)    $str .= convertTwoDigit($crore, $words) . ' crore ';
    if ($lakh)     $str .= convertTwoDigit($lakh, $words) . ' lakh ';
    if ($thousand) $str .= convertTwoDigit($thousand, $words) . ' thousand ';
    if ($hundred)  $str .= $words[$hundred] . ' hundred ';
    if ($rest) {
        if ($str != '') $str .= 'and ';
        $str .= convertTwoDigit($rest, $words) . ' ';
    }

    return trim($str);
}

 function convertTwoDigit($num, $words) {
    if ($num == 0) return '';
    if ($num < 21) return $words[$num];
    $tens = intval($num / 10) * 10;
    $unit = $num % 10;
    return trim($words[$tens] . ' ' . $words[$unit]);
}

