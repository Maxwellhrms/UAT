<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Loan_model extends CI_Model
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

    function get_client_ip()
    {
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
    
    //---------------------------LOAN MASTER
    
    public function getloandetails($cmp_id = null,$div_id = null,$state_id = null, $branch_id = null,$emp_code = null,$emi_month_year = null)
    {
        $this->db->select("mxemploan_load_id,mxemploan_empcode,mxemploan_emp_loan_tenure_months,mxemploan_emp_loan_outstanding_amt,mxemploan_emp_loan_amt_approved,mxemploan_emp_loan_monthly_emi_amt,mxemploan_pri_id,mxemploan_status,CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxcp_name,mxb_name,mxd_name,mxst_state,mxemploan_emi_startdate,mxemploan_emi_enddate");
        $this->db->from('maxwell_emp_loan_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemploan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemploan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemploan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemploan_state_id', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxemploan_empcode', 'INNER');
         //$this->db->where('mxemploan_status',1);
        if($cmp_id !=null){
            $this->db->where("mxemploan_comp_id",$cmp_id);
        }
        if($div_id !=null){
            $this->db->where("mxemploan_div_id",$div_id);
        }
        if($state_id !=null){
            $this->db->where("mxemploan_state_id",$state_id);
        }
        if($branch_id !=null){
            $this->db->where("mxemploan_branch_id",$branch_id);
        }
        if($emp_code !=null){
            $this->db->where("mxemploan_empcode",$emp_code);
        }
        if($emi_month_year !=null){
            $this->db->where("mxemploan_emi_startdate <= $emi_month_year and mxemploan_emi_enddate >= $emi_month_year");
        }
        $this->db->order_by('mxemploan_createdtime', 'DESC');
        // $this->db->order_by('mxemploan_status', 'asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
	
	
	public function getloandetails_sals($cmp_id = null,$div_id = null,$state_id = null, $branch_id = null,$emp_code = null,$emi_month_year = null)
    {
        $this->db->select("mxemploan_load_id,mxemploan_empcode,mxemploan_emp_loan_tenure_months,mxemploan_emp_loan_outstanding_amt,mxemploan_emp_loan_amt_approved,mxemploan_emp_loan_monthly_emi_amt,mxemploan_pri_id,mxemploan_status,CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxcp_name,mxb_name,mxd_name,mxst_state,mxemploan_emi_startdate,mxemploan_emi_enddate");
        $this->db->from('maxwell_emp_loan_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemploan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemploan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemploan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemploan_state_id', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxemploan_empcode', 'INNER');
        //$this->db->where('mxemploan_status',1);
        if($cmp_id !=null){
            $this->db->where("mxemploan_comp_id",$cmp_id);
        }
        if($div_id !=null){
            $this->db->where("mxemploan_div_id",$div_id);
        }
        if($state_id !=null){
            $this->db->where("mxemploan_state_id",$state_id);
        }
        if($branch_id !=null){
            $this->db->where("mxemploan_branch_id",$branch_id);
        }
        if($emp_code !=null){
            $this->db->where("mxemploan_empcode",$emp_code);
        }
        if($emi_month_year !=null){
            $this->db->where("mxemploan_emi_startdate <= $emi_month_year and mxemploan_emi_enddate >= $emi_month_year");
        }
        $this->db->order_by('mxemploan_createdtime', 'DESC');
        // $this->db->order_by('mxemploan_status', 'asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
	
    
    
    public function getloandetails_payslip($emp_code = null)
    {
        $this->db->select("sum(mxemploan_emp_loan_outstanding_amt) as mxemploan_emp_loan_outstanding_amt");
        $this->db->from('maxwell_emp_loan_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemploan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemploan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemploan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemploan_state_id', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mxemploan_empcode', 'INNER');
        $this->db->where('mxemploan_status',1);
        if($cmp_id !=null){
            $this->db->where("mxemploan_comp_id",$cmp_id);
        }
        if($div_id !=null){
            $this->db->where("mxemploan_div_id",$div_id);
        }
        if($state_id !=null){
            $this->db->where("mxemploan_state_id",$state_id);
        }
        if($branch_id !=null){
            $this->db->where("mxemploan_branch_id",$branch_id);
        }
        if($emp_code !=null){
            $this->db->where("mxemploan_empcode",$emp_code);
        }
        if($emi_month_year !=null){
            $this->db->where("mxemploan_emi_startdate <= $emi_month_year and mxemploan_emi_enddate >= $emi_month_year");
        }
        $this->db->order_by('mxemploan_createdtime', 'DESC');
        // $this->db->order_by('mxemploan_status', 'asc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
    
    public function saveemployeeloandetails($data)
    {
        $company = $this->cleanInput($data['esi_company_id']);
        $division = $this->cleanInput($data['esi_div_id']);
        $state = $this->cleanInput($data['esi_state_id']);
        $branch = $this->cleanInput($data['esi_branch_id']);
        $employeeid = $this->cleanInput($data['employeeid']);
        $loantype = $this->cleanInput($data['loantype']);
        $loanappliedamt = $this->cleanInput($data['emploanamountapplied']);
        $loanapprovedamt = $this->cleanInput($data['loanamountapproved']);
        $emistartdate_ymd = $this->cleanInput(date('Y-m-d', strtotime('01-'.$data['emiloanamount'])));
        $emistartdate_ym = $this->cleanInput(date('Ym', strtotime('01-'.$data['emiloanamount'])));
        $tenuremnts = $this->cleanInput($data['tenuremnts']);
        $emienddate = date('Ym', strtotime("+" . ($tenuremnts - 1) . "months", strtotime($emistartdate_ymd)));
        // echo $emienddate;exit;
        
        $loanapprovedby = $this->cleanInput($data['loanamountapprovedby']);
        $reasonforloan = $this->cleanInput($data['rsloanamount']);
        $loanapplieddate = $this->cleanInput(date('Y-m-d', strtotime($data['loanamountapplied'])));
        $loanapproveddate = $this->cleanInput(date('Y-m-d', strtotime($data['loanamountappdate'])));
        $loandocument = $this->cleanInput($data['loandoc']);

        //--------CHECKING EMI START DATE SHOULD GREATER THAN JOINING DATE
        $this->db->select("mxemp_emp_date_of_join,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_branch_code,mxemp_emp_dept_code,mxemp_emp_state_code,mxemp_emp_type,mxemp_emp_id");
        $this->db->from("maxwell_employees_info");
        $this->db->where("date(mxemp_emp_date_of_join) > '$emistartdate_ymd'");
        $this->db->where("mxemp_emp_comp_code",$company);
        $this->db->where("mxemp_emp_division_code",$division);
        $this->db->where("mxemp_emp_state_code",$state);
        $this->db->where("mxemp_emp_branch_code",$branch);
        $this->db->where("mxemp_emp_id",$employeeid);
        $query = $this->db->get();
        $res = $query->result();
        if(count($res) > 0){
            echo "444";
            exit;
        }
        
        //--------END CHECKING EMI START DATE SHOULD GREATER THAN JOINING DATE
        

        $monthlyemiamt = ($loanapprovedamt / $tenuremnts);
        $this->db->trans_begin();
        $ip = $this->get_client_ip();
        $date = date('Y-m-d H:i:s');
        $uniqdate = date_create();
        $unixtime = date_timestamp_get($uniqdate);
        $uniloanid = $unixtime . "-" . "MAXWELL" . "-" . date("dmY") . "-" . $employeeid;

        $inarray = array(
            "mxemploan_load_id" => $uniloanid,
            "mxemploan_comp_id" => $company,
            "mxemploan_div_id" => $division,
            "mxemploan_state_id" => $state,
            "mxemploan_branch_id" => $branch,
            "mxemploan_empcode" => $employeeid,
            "mxemploan_emp_loan_type" => $loantype,
            "mxemploan_emp_loan_amt_appliedby_employee" => $loanappliedamt,
            "mxemploan_emp_loan_amt_approved" => $loanapprovedamt,
            "mxemploan_emp_loan_outstanding_amt" => $loanapprovedamt,
            "mxemploan_emp_loan_tenure_months" => $tenuremnts,
            "mxemploan_emp_loan_approvedby" => $loanapprovedby,
            "mxemploan_emp_reasonfor_loan" => $reasonforloan,
            "mxemploan_applied_date" => $loanapplieddate,
            "mxemploan_approved_date" => $loanapproveddate,
            "mxemploan_emp_attachements" => $loandocument,
            "mxemploan_emi_startdate" => $emistartdate_ym,
            "mxemploan_emi_enddate" => $emienddate,
            "mxemploan_emp_loan_monthly_emi_amt" => $monthlyemiamt,
            "mxemploan_emp_information" => 'OPEN',
            "mxemploan_createdby" => $this->session->userdata('user_id'),
            "mxemploan_createdtime" => $date,
            "mxemploan_created_ip" => $ip,
        );
        $res = $this->db->insert('maxwell_emp_loan_master', $inarray);

        $transactioninarray = array(
            "mxemploan_emp_loan_process" => "NEW RECORD",
            "mxemploan_load_id" => $uniloanid,
            "mxemploan_comp_id" => $company,
            "mxemploan_div_id" => $division,
            "mxemploan_state_id" => $state,
            "mxemploan_branch_id" => $branch,
            "mxemploan_empcode" => $employeeid,
            "mxemploan_emp_loan_type" => $loantype,
            "mxemploan_emp_loan_amt_appliedby_employee" => $loanappliedamt,
            "mxemploan_emp_loan_amt_approved" => $loanapprovedamt,
            "mxemploan_emp_loan_outstanding_amt" => $loanapprovedamt,
            "mxemploan_emp_loan_tenure_months" => $tenuremnts,
            "mxemploan_emp_loan_approvedby" => $loanapprovedby,
            "mxemploan_emp_reasonfor_loan" => $reasonforloan,
            "mxemploan_applied_date" => $loanapplieddate,
            "mxemploan_approved_date" => $loanapproveddate,
            "mxemploan_emp_attachements" => $loandocument,
            "mxemploan_emi_startdate" => $emistartdate_ym,
            "mxemploan_emi_enddate" => $emienddate,
            "mxemploan_emp_loan_monthly_emi_amt" => $monthlyemiamt,
            "mxemploan_emp_information" => 'OPEN',
            "mxemploan_createdby" => $this->session->userdata('user_id'),
            "mxemploan_createdtime" => $date,
            "mxemploan_created_ip" => $ip,
        );
        $res = $this->db->insert('maxwell_emp_loan_master_transaction', $transactioninarray);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }
    public function saveadvanceemployeeloandetails($data){
        $newamt = $this->cleanInput($data['newamt']);
        $newpytm = $this->cleanInput($data['newpytm']);
        $newtrdetails = $this->cleanInput($data['newtrdetails']);
        $primaryid = $this->cleanInput($data['primaryid']);
        $loanempid = $this->cleanInput($data['loanempid']);

        $this->db->select('mxemploan_comp_id,mxemploan_div_id,mxemploan_state_id,mxemploan_branch_id,mxemploan_load_id,mxemploan_empcode,mxemploan_emp_loan_type,mxemploan_emp_loan_approvedby,mxemploan_emp_reasonfor_loan,mxemploan_emp_loan_amt_appliedby_employee,mxemploan_emp_loan_amt_approved,mxemploan_emp_loan_outstanding_amt,mxemploan_emp_loan_debited_amt,mxemploan_emp_loan_current_paid_amt,mxemploan_emp_loan_advance_pay_amt,mxemploan_emp_loan_forecloser_pay_amt,mxemploan_emp_loan_tenure_months,mxemploan_emp_loan_monthly_emi_amt,mxemploan_emp_attachements,mxemploan_emi_startdate,mxemploan_emi_enddate,mxemploan_applied_date,mxemploan_approved_date,mxemploan_emp_information');
        $this->db->from('maxwell_emp_loan_master');
        $this->db->where('mxemploan_pri_id', $primaryid);
        $this->db->where('mxemploan_empcode', $loanempid);
        $query = $this->db->get();
        $result = $query->result();

        $this->db->trans_begin();
        $currentoutstandingamt = ($result[0]->mxemploan_emp_loan_outstanding_amt - $newamt);
        $ip = $this->get_client_ip();
        $date = date('Y-m-d H:i:s');
        $uparray = array(
            "mxemploan_emp_payment_type" => $newpytm,
            "mxemploan_emp_modeofpayment" => $newtrdetails,
            "mxemploan_emp_loan_debited_amt" => $newamt,
            "mxemploan_emp_loan_current_paid_amt" => $newamt,
            "mxemploan_modifyby" => $this->session->userdata('user_id'),
            "mxemploan_modifiedtime" => $date,
            "mxemploan_modified_ip" => $ip,
        );

        $transactioninarray = array(
            "mxemploan_emp_loan_process" => "UPDATED",
            "mxemploan_load_id" => $result[0]->mxemploan_load_id,
            "mxemploan_comp_id" => $result[0]->mxemploan_comp_id,
            "mxemploan_div_id" => $result[0]->mxemploan_div_id,
            "mxemploan_state_id" => $result[0]->mxemploan_state_id,
            "mxemploan_branch_id" => $result[0]->mxemploan_branch_id,
            "mxemploan_empcode" => $result[0]->mxemploan_empcode,
            "mxemploan_emp_loan_type" => $result[0]->mxemploan_emp_loan_type,
            "mxemploan_emp_loan_amt_appliedby_employee" => $result[0]->mxemploan_emp_loan_amt_appliedby_employee,
            "mxemploan_emp_loan_amt_approved" => $result[0]->mxemploan_emp_loan_amt_approved,
            "mxemploan_emp_loan_tenure_months" => $result[0]->mxemploan_emp_loan_tenure_months,
            "mxemploan_emp_loan_approvedby" => $result[0]->mxemploan_emp_loan_approvedby,
            "mxemploan_emp_reasonfor_loan" => $result[0]->mxemploan_emp_reasonfor_loan,
            "mxemploan_applied_date" => $result[0]->mxemploan_applied_date,
            "mxemploan_approved_date" => $result[0]->mxemploan_approved_date,
            "mxemploan_emp_attachements" => $result[0]->mxemploan_emp_attachements,
            "mxemploan_emi_startdate" => $result[0]->mxemploan_emi_startdate,
            "mxemploan_emi_enddate" => $result[0]->mxemploan_emi_enddate,
            "mxemploan_emp_loan_monthly_emi_amt" => $result[0]->mxemploan_emp_loan_monthly_emi_amt,
            "mxemploan_emp_information" => 'IN PROCESS',
            "mxemploan_modifyby" => $this->session->userdata('user_id'),
            "mxemploan_modifiedtime" => $date,
            "mxemploan_modified_ip" => $ip,
            "mxemploan_emp_payment_type" => $newpytm,
            "mxemploan_emp_modeofpayment" => $newtrdetails,
            "mxemploan_emp_loan_debited_amt" => $newamt,
            "mxemploan_emp_loan_current_paid_amt" => $newamt,
        );

        if($newpytm == 'AD1'){
            $uparray['mxemploan_emp_loan_outstanding_amt'] = $currentoutstandingamt;
            $transactioninarray['mxemploan_emp_loan_outstanding_amt'] = $currentoutstandingamt;
            $uparray['mxemploan_emp_loan_advance_pay_amt'] = $newamt;
            $transactioninarray['mxemploan_emp_loan_advance_pay_amt'] = $newamt;
        }elseif($newpytm == 'FC1'){
            $uparray['mxemploan_emp_loan_outstanding_amt'] = $currentoutstandingamt;
            $transactioninarray['mxemploan_emp_loan_outstanding_amt'] = $currentoutstandingamt;
            $uparray['mxemploan_emp_loan_advance_pay_amt'] = 0;
            $transactioninarray['mxemploan_emp_loan_advance_pay_amt'] = 0;

            $uparray['mxemploan_emp_information'] = 'CLOSED';
            $uparray['mxemploan_status'] = 0;
            $uparray['mxemploan_emp_loan_forecloser_pay_amt'] = $newamt;

            $transactioninarray['mxemploan_emp_information'] = 'CLOSED';
            $transactioninarray['mxemploan_status'] = 0;
            $transactioninarray['mxemploan_emp_loan_forecloser_pay_amt'] = $newamt;
        }

        $this->db->where('mxemploan_pri_id', $primaryid);
        $this->db->where('mxemploan_empcode', $loanempid);
        $this->db->update('maxwell_emp_loan_master', $uparray);

        $res = $this->db->insert('maxwell_emp_loan_master_transaction', $transactioninarray);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }

    }
    public function getforcecloserinfoloan($data){
        $id = $data['id'];
        $empid = $data['empid'];

        $this->db->select('mxemploan_emp_loan_outstanding_amt');
        $this->db->from('maxwell_emp_loan_master');
        $this->db->where('mxemploan_pri_id', $id);
        $this->db->where('mxemploan_empcode', $empid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getdetailedloanhistory($data){
        $id = $data['id'];
        $empid = $data['empid'];
        $loanid = $data['loanid'];
        $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxemp_emp_gender,mxemp_emp_phone_no,mxemp_emp_alt_phn_no,mxemp_emp_age,mxemp_emp_current_salary,mxemp_emp_date_of_join');
        $this->db->from('maxwell_employees_info');
        $this->db->where('mxemp_emp_id', $empid);
        $query = $this->db->get();
        $result['employeeinfo'] = $query->result();

        $this->db->select('mxemploan_load_id,mxemploan_emp_loan_type,mxemploan_emp_loan_approvedby,mxemploan_emp_reasonfor_loan,mxemploan_emp_loan_amt_appliedby_employee,mxemploan_emp_loan_amt_approved,mxemploan_emp_loan_tenure_months,mxemploan_emp_loan_monthly_emi_amt,mxemploan_emp_attachements,mxemploan_emi_startdate,mxemploan_emi_enddate,mxemploan_applied_date,mxemploan_approved_date,mxcp_name,mxb_name,mxd_name,mxst_state,mxemploan_createdtime');
        $this->db->from('maxwell_emp_loan_master');
        $this->db->join('maxwell_company_master', 'mxcp_id = mxemploan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mxemploan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mxemploan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mxemploan_state_id', 'INNER');
        $this->db->where('mxemploan_pri_id', $id);
        $this->db->where('mxemploan_empcode', $empid);
        $this->db->where('mxemploan_load_id', $loanid);
        $query1 = $this->db->get();
        $result['loandetails'] = $query1->result();

        $this->db->select('mxemploan_load_id,mxemploan_modifiedtime,mxemploan_emp_loan_current_paid_amt,mxemploan_emp_loan_debited_amt,mxemploan_emp_loan_advance_pay_amt,mxemploan_emp_loan_forecloser_pay_amt,mxemploan_emp_loan_outstanding_amt,mxemploan_emp_information,mxemploan_emp_loan_amt_approved,mxemploan_emp_modeofpayment,mxemploan_emp_payment_type,mxemploan_pri_id');
        $this->db->from('maxwell_emp_loan_master_transaction');
        $this->db->where('mxemploan_load_id', $loanid);
        $this->db->where('mxemploan_status', 1);
        $query2 = $this->db->get();
		//echo $this->db->last_query();exit;
        $result['loanhistorytransactions'] = $query2->result();
		//echo "<pre>";print_r($result['loanhistorytransactions']);die;
        return $result;
    }
    //---------------------------END LOAN MASTER

public function getemployeeslist($data)
    {
        $this->db->select('mxemp_emp_autouniqueid,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxdesg_name,mxemp_emp_resignation_status,mxemp_emp_date_of_join,mxemp_emp_is_without_notice_period');
        $this->db->from('maxwell_employees_info');
        $this->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        if (!empty($data['cmpname'])) {
            $this->db->where('mxemp_emp_comp_code', $data['cmpname']);
        }
        if (!empty($data['divname'])) {
            $this->db->where('mxemp_emp_division_code', $data['divname']);
        }
        if (!empty($data['brname'])) {
            $this->db->where('mxemp_emp_branch_code', $data['brname']);
        }
        if (!empty($data['emptype'])) {
            $this->db->where('mxemp_emp_type', $data['emptype']);
        }
        if (!empty($data['cmpstate'])) {
            $this->db->where('mxemp_emp_state_code', $data['cmpstate']);
        }
        if (!empty($data['empgender'])) {
            $this->db->where('mxemp_emp_gender', $data['empgender']);
        }
        $this->db->where('mxemp_emp_is_without_notice_period', 0); 
        $this->db->where('mxemp_emp_status', 1);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

    public function getloandetailsmobilepp($cmp_id = '',$div_id = '',$state_id = '', $branch_id = '',$emp_code = '',$category = '',$uniqueid = '', $status = '', $applieddt = '')
    {
        $this->db->select("CONCAT(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxcp_name,mxb_name,mxd_name,mxst_state,mx_loan_pri_id,mx_loan_id,mx_loan_empcode,mx_loan_comp_id,mx_loan_div_id,mx_loan_state_id,mx_loan_branch_id,mx_loan_emp_loan_type,mx_loan_tenure_months,mx_loan_amount_appliedby_employee,mx_loan_reasonfor_loan,mx_loan_attachement_employee,mx_loan_applied_date,mx_loan_approvedby,mx_loan_amt_approved,mx_loan_approved_date,mx_loan_status,mx_loan_createdby,mx_loan_createdtime,mxemploan_emp_start_from,mx_loan_category");
        $this->db->from('maxwell_emp_loan_applied');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_loan_comp_id', 'INNER');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_loan_div_id', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_loan_branch_id', 'INNER');
        $this->db->join('maxwell_state_master', 'mxst_id = mx_loan_state_id', 'INNER');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_loan_empcode', 'INNER');
        // $this->db->where('mx_loan_status',1);
        if($cmp_id != ''){
            $this->db->where("mx_loan_comp_id",$cmp_id);
        }
        if(!empty($div_id)){
            $this->db->where("mx_loan_div_id",$div_id);
        }
        if(!empty($state_id)){
            $this->db->where("mx_loan_state_id",$state_id);
        }
        if(!empty($branch_id)){
            $this->db->where("mx_loan_branch_id",$branch_id);
        }
        if(!empty($emp_code)){
            $this->db->where("mx_loan_empcode",$emp_code);
        }
        if(!empty($uniqueid)){
            $this->db->where("mx_loan_pri_id",$uniqueid);
        }
        if(!empty($status)){
            $this->db->where("mx_loan_status", $status);
        }

        if(!empty($applieddt)){
            $applied = date('Y-m-d', strtotime($applieddt));
            $this->db->where("date(mx_loan_applied_date)", $applied);
        }
        $this->db->order_by('mx_loan_createdtime', 'DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }

    public function save_approveemployeeloandetails($data){
        $company = $this->cleanInput($data['esi_company_id']);
        $division = $this->cleanInput($data['esi_div_id']);
        $state = $this->cleanInput($data['esi_state_id']);
        $branch = $this->cleanInput($data['esi_branch_id']);
        $employeeid = $this->cleanInput($data['employeeid']);
        $loantype = $this->cleanInput($data['loantype']);
        $loanappliedamt = $this->cleanInput($data['emploanamountapplied']);
        $loanapprovedamt = $this->cleanInput($data['loanamountapproved']);
        $emistartdate_ymd = $this->cleanInput(date('Y-m-d', strtotime('01-'.$data['emiloanamount'])));
        $emistartdate_ym = $this->cleanInput(date('Ym', strtotime('01-'.$data['emiloanamount'])));
        $tenuremnts = $this->cleanInput($data['tenuremnts']);
        $emienddate = date('Ym', strtotime("+" . ($tenuremnts - 1) . "months", strtotime($emistartdate_ymd)));

        $uniqueid = $this->cleanInput($data['uniqueid']);
        $attachements_byemployee = $this->cleanInput($data['attachements_byemployee']); 
        $loancategory = $this->cleanInput($data['loancategory']);
        $loanstatus = $this->cleanInput($data['loanstatus']);
        $emistartform = $this->cleanInput($data['emiloanamount']);
        // echo $emienddate;exit;

        $loanapprovedby = $this->cleanInput($data['loanamountapprovedby']);
        $reasonforloan = $this->cleanInput($data['rsloanamount']);
        $loanapplieddate = $this->cleanInput(date('Y-m-d', strtotime($data['loanamountapplied'])));
        $loanapproveddate = $this->cleanInput(date('Y-m-d', strtotime($data['loanamountappdate'])));
        $loandocument = $this->cleanInput($data['loandoc']);

        $this->db->select("mxemploan_emp_applied_uniqueid");
        $this->db->from("maxwell_emp_loan_master");
        $this->db->where("mxemploan_emp_applied_uniqueid" , $uniqueid);
        $query = $this->db->get();
        $res = $query->result();
        if(count($res) > 0){
        if($res[0]->mxemploan_emp_applied_uniqueid == $uniqueid){
            echo "Already Loan Approved";
            exit;
        }
        }

        //--------CHECKING EMI START DATE SHOULD GREATER THAN JOINING DATE
        $this->db->select("mxemp_emp_date_of_join,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_branch_code,mxemp_emp_dept_code,mxemp_emp_state_code,mxemp_emp_type,mxemp_emp_id");
        $this->db->from("maxwell_employees_info");
        $this->db->where("date(mxemp_emp_date_of_join) > '$emistartdate_ymd'");
        $this->db->where("mxemp_emp_comp_code",$company);
        $this->db->where("mxemp_emp_division_code",$division);
        $this->db->where("mxemp_emp_state_code",$state);
        $this->db->where("mxemp_emp_branch_code",$branch);
        $this->db->where("mxemp_emp_id",$employeeid);
        $query = $this->db->get();
        $res = $query->result();
        if(count($res) > 0){
            echo "444";
            exit;
        }
        
        //--------END CHECKING EMI START DATE SHOULD GREATER THAN JOINING DATE
        

        $monthlyemiamt = ($loanapprovedamt / $tenuremnts);
        $this->db->trans_begin();
        $ip = $this->get_client_ip();
        $date = date('Y-m-d H:i:s');
        $uniqdate = date_create();
        $unixtime = date_timestamp_get($uniqdate);
        $uniloanid = $unixtime . "-" . "MAXWELL" . "-" . date("dmY") . "-" . $employeeid;

        $inarray = array(
            "mxemploan_load_id" => $uniloanid,
            "mxemploan_comp_id" => $company,
            "mxemploan_div_id" => $division,
            "mxemploan_state_id" => $state,
            "mxemploan_branch_id" => $branch,
            "mxemploan_empcode" => $employeeid,
            "mxemploan_emp_loan_type" => $loantype,
            "mxemploan_emp_loan_amt_appliedby_employee" => $loanappliedamt,
            "mxemploan_emp_loan_amt_approved" => $loanapprovedamt,
            "mxemploan_emp_loan_outstanding_amt" => $loanapprovedamt,
            "mxemploan_emp_loan_tenure_months" => $tenuremnts,
            "mxemploan_emp_loan_approvedby" => $loanapprovedby,
            "mxemploan_emp_reasonfor_loan" => $reasonforloan,
            "mxemploan_applied_date" => $loanapplieddate,
            "mxemploan_approved_date" => $loanapproveddate,
            "mxemploan_emp_attachements" => $loandocument,
            "mxemploan_emi_startdate" => $emistartdate_ym,
            "mxemploan_emi_enddate" => $emienddate,
            "mxemploan_emp_loan_monthly_emi_amt" => $monthlyemiamt,
            "mxemploan_emp_information" => 'OPEN',
            "mxemploan_createdby" => $this->session->userdata('user_id'),
            "mxemploan_createdtime" => $date,
            "mxemploan_created_ip" => $ip,
            "mxemploan_emp_attachements_byemployee" => $attachements_byemployee,
            "mxemploan_emp_applied_uniqueid" => $uniqueid,
            "mxemploan_emp_loancategory" => $loancategory,
        );

        $res = $this->db->insert('maxwell_emp_loan_master', $inarray);

        $transactioninarray = array(
            "mxemploan_emp_loan_process" => "NEW RECORD",
            "mxemploan_load_id" => $uniloanid,
            "mxemploan_comp_id" => $company,
            "mxemploan_div_id" => $division,
            "mxemploan_state_id" => $state,
            "mxemploan_branch_id" => $branch,
            "mxemploan_empcode" => $employeeid,
            "mxemploan_emp_loan_type" => $loantype,
            "mxemploan_emp_loan_amt_appliedby_employee" => $loanappliedamt,
            "mxemploan_emp_loan_amt_approved" => $loanapprovedamt,
            "mxemploan_emp_loan_outstanding_amt" => $loanapprovedamt,
            "mxemploan_emp_loan_tenure_months" => $tenuremnts,
            "mxemploan_emp_loan_approvedby" => $loanapprovedby,
            "mxemploan_emp_reasonfor_loan" => $reasonforloan,
            "mxemploan_applied_date" => $loanapplieddate,
            "mxemploan_approved_date" => $loanapproveddate,
            "mxemploan_emp_attachements" => $loandocument,
            "mxemploan_emi_startdate" => $emistartdate_ym,
            "mxemploan_emi_enddate" => $emienddate,
            "mxemploan_emp_loan_monthly_emi_amt" => $monthlyemiamt,
            "mxemploan_emp_information" => 'OPEN',
            "mxemploan_createdby" => $this->session->userdata('user_id'),
            "mxemploan_createdtime" => $date,
            "mxemploan_created_ip" => $ip,
        );
       
        $res = $this->db->insert('maxwell_emp_loan_master_transaction', $transactioninarray);


        $uparray = array(
            "mx_loan_approvedby" => $loanapprovedby,
            "mx_loan_amt_approved" => $loanapprovedamt,
            "mx_loan_approved_date" => $loanapproveddate,
            "mx_loan_processedby" => $this->session->userdata('user_id'),
            "mx_loan_processed_ip" => $ip,
            "mx_loan_status" => $loanstatus,
            "mx_loan_id" => $uniloanid,
            "mx_loan_processedtime" => $date,
            "mxemploan_emp_start_from" => $emistartform,
        );

        $this->db->where('mx_loan_pri_id', $uniqueid);
        $this->db->where('mx_loan_empcode', $employeeid );
        $this->db->update('maxwell_emp_loan_applied', $uparray);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    public function update_loandetailsbystatus($data){
        $this->db->trans_begin();
        $uniqueid = $this->cleanInput($data['uniqueid']);
        $employeeid = $this->cleanInput($data['employeeid']);
        $loanstatus = $this->cleanInput($data['loanstatus']);

        $uparray = array(
            "mx_loan_status" => $loanstatus
        );

        $this->db->where('mx_loan_pri_id', $uniqueid);
        $this->db->where('mx_loan_empcode', $employeeid );
        $this->db->update('maxwell_emp_loan_applied', $uparray);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }
    
    public function deleteloandetails($data){
        $uniqueid = $this->cleanInput(trim($data['id']));
        $employeeid = $this->cleanInput(trim($data['empid']));
        $loanid = $this->cleanInput(trim($data['loanid']));
        if($this->session->userdata('user_id') != '888666'){
            $this->db->select("count(*) as loanscount");
            $this->db->from("maxwell_emp_loan_master_transaction");
            $this->db->where("mxemploan_load_id",$loanid);
            $this->db->where("mxemploan_emp_loan_process != 'NEW RECORD' ");
            $this->db->where("mxemploan_empcode",$employeeid);
            $query = $this->db->get();
            $res = $query->result();
            if($res[0]->loanscount != 0){
                    return 3;
            }
        }
        $this->db->trans_begin();
        $this->db->where("mxemploan_load_id",$loanid);
        $this->db->where("mxemploan_empcode",$employeeid);
        $this->db->delete('maxwell_emp_loan_master_transaction');
        
        $this->db->where("mxemploan_load_id",$loanid);
        $this->db->where("mxemploan_empcode",$employeeid);
        $this->db->where("mxemploan_pri_id",$uniqueid);
        $this->db->delete('maxwell_emp_loan_master');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    public function getEmployeeLoanOutstandingAfterDeduction($empCode, $salaryMonth)
    {
        $subQuery = $this->db
            ->select('DISTINCT mx_loan_transaction_id', FALSE)
            ->from('maxwell_loan_sal_log')
            ->where('mx_loan_emp_id', $empCode)
            ->where('mx_loan_month', $salaryMonth)
            ->where('mx_loan_status', '1')
            ->get_compiled_select();

        $this->db->select('SUM(mxemploan_emp_loan_outstanding_amt) AS mxemploan_emp_loan_outstanding_amt');
        $this->db->from('maxwell_emp_loan_master_transaction');
        $this->db->where('mxemploan_empcode', $empCode);
        $this->db->where('mxemploan_status', 1);
        $this->db->where("mxemploan_pri_id IN ($subQuery)", NULL, FALSE);

        $query = $this->db->get();

        return ($query->num_rows() > 0)
            ? $query->row()->mxemploan_emp_loan_outstanding_amt
            : 0;
    }

}
