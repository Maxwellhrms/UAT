<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Recruitmentmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    function cleanInput($val){
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
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

    public function saverecruitmentmodel($data){
        $division = $this->cleanInput($data['division']);
        $jobtitle = $this->cleanInput($data['jobtitle']);
        $department = $this->cleanInput($data['department']);
        $joblocation = $this->cleanInput($data['joblocation']);
        $noofvacancies = $this->cleanInput($data['noofvacancies']);
        $experience = $this->cleanInput($data['experience']);
        $age = $this->cleanInput($data['age']);
        $salaryfrom = $this->cleanInput($data['salaryfrom']);
        $salaryto = $this->cleanInput($data['salaryto']);
        $jobtype = $this->cleanInput($data['jobtype']);
        $status = $this->cleanInput($data['status']);
        $startdate = $this->cleanInput($data['startdate']);
        $expdate = $this->cleanInput($data['expdate']);
        $desc = $data['desc'];
        $templateid = $data['templateid'];
        $ip = $this->get_client_ip();
        $date = date('Y-m-d H:i:s');
        
        $this->db->trans_begin();

            $this->db->select_max('mxrc_type_id');
            $this->db->from('maxwell_recruitment');
            $pt_id_query = $this->db->get();
            $id_res = $pt_id_query->result();
            if ($id_res[0]->mxrc_type_id == "") {
                $max_type_id = 10001;
            } else {
                $max_type_id = $id_res[0]->mxrc_type_id + 1;
            }

        $inarray = array(
            "mxrc_type_id" => $max_type_id,
            "mxrc_division_type" => $division,
            "mxrc_job_title" => $jobtitle,
            "mxrc_department" => $department,
            "mxrc_job_location" => $joblocation,
            "mxrc_job_vacancies" => $noofvacancies,
            "mxrc_job_experience" => $experience,
            "mxrc_age" => $age,
            "mxrc_salary_from" => $salaryfrom,
            "mxrc_salary_to" => $salaryto,
            "mxrc_job_type" => $jobtype,
            "mxrc_job_status" => $status,
            "mxrc_job_start_date" => date('Y-m-d',strtotime($startdate)),
            "mxrc_job_end_date" => date('Y-m-d',strtotime($expdate)),
            "mxrc_templateid" => $templateid,
            "mxrc_job_description" => $desc,
            "mxrc_created_ip" => $ip,
            "mxrc_createdtime" => $date,
            "mxrc_createdby" => $this->session->userdata('user_id'),
        );
        
        $data_string = json_encode($inarray);                                                                             
                                                                                                   
        if($division == 1){                                                                                                                     
        $ch = curl_init('https://maxwelllogistics.net/recruitment_services/saver_recruitment.php');
        }elseif($division == 2){
        $ch = curl_init('https://maxwellrelocations.com/recruitment_services/saver_recruitment.php');    
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                                   
        $response = curl_exec($ch);
        curl_close($ch);
        if($response != 200){
            $this->db->trans_rollback();
            return 2; exit();
        }
        
        $this->db->insert('maxwell_recruitment', $inarray);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 2;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    public function getaddedjobs($id){
        $this->db->select('mxrc_id,mxrc_type_id,mxrc_division_type,mxrc_department,mxrc_job_title,mxrc_job_location,mxrc_job_vacancies,mxrc_job_experience,
          mxrc_age,mxrc_salary_from,mxrc_salary_to,mxrc_job_type,mxrc_job_status,mxrc_job_start_date,mxrc_job_end_date,
          mxrc_job_description, (select count(*) from maxwell_recruitment_applied_candidates where mxrc_type_id = mxrap_job_id) as applied_count, mxrc_templateid');
        $this->db->from('maxwell_recruitment');
        $this->db->order_by('mxrc_job_end_date', 'desc');
        $this->db->order_by('mxrc_createdtime', 'desc');
        if(!empty($id)){
            $this->db->where('mxrc_id', $id);
        }
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }


public function getappliedcandidateslist($id){
        $this->db->select('mxrap_id,mxrap_received_from,mxrap_job_id,mxrap_name,mxrap_mobile,mxrap_email,mxrap_resume,
        mxrap_status,mxrap_app_status,mxrap_app_id,mxrap_createdtime,mxrap_revalent_status,mxrap_application_view, (select mx_rec_process_status FROM maxwell_recruitment_info WHERE mx_rec_jobunique_id = mxrap_id and mx_rec_jobid = mxrap_job_id) as processstatus, (select mx_rec_application FROM maxwell_recruitment_info WHERE mx_rec_jobunique_id = mxrap_id and mx_rec_jobid = mxrap_job_id) as mx_rec_application');
        $this->db->from('maxwell_recruitment_applied_candidates');
        $this->db->where('mxrap_status', '1');
        $this->db->where('mxrap_job_id', $id);
        $this->db->order_by('mxrap_application_view', 'desc');
        $this->db->order_by('mxrap_createdtime', 'desc');
// echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
}

public function todaysappliedcount(){
    $fromdate = date('Y-m-d') . ' 00:00:00';
    $todate = date('Y-m-d') . ' 23:59:59';
    $sql = "select mxrap_job_id,count(*) as todayapplied from maxwell_recruitment_applied_candidates where mxrap_createdtime BETWEEN '$fromdate' and '$todate' group by mxrap_job_id";
    $query = $this->db->query($sql);
    $qury = $query->result_array();
    return $qury;
}

public function updaterevalentstatus($data){
    $revstatus = $data['revstatus'];
    $id = $data['id'];
    $jobid = $data['jobid'];
    
    $uparray = array('mxrap_revalent_status' => $revstatus);
    $this->db->where('mxrap_id', $id);
    $this->db->where('mxrap_job_id', $jobid);
    return $this->db->update('maxwell_recruitment_applied_candidates', $uparray);
}

public function deleteappliedjobstatus($data){
    $id = $data['id'];
    $jobid = $data['jobid'];
    
    $uparray = array('mxrap_status' => '0');
    $this->db->where('mxrap_id', $id);
    $this->db->where('mxrap_job_id', $jobid);
    return $this->db->update('maxwell_recruitment_applied_candidates', $uparray);
}

public function appliedjobsreviewed($data){
    $id = $data['id'];
    $jobid = $data['jobid'];
    
    $uparray = array('mxrap_application_view' => '0');
    $this->db->where('mxrap_id', $id);
    $this->db->where('mxrap_job_id', $jobid);
    return $this->db->update('maxwell_recruitment_applied_candidates', $uparray);
}

// --------------------------------------------------





public function saveaddrecruimentdata($data)
{
    // Company info
    $cmpname = $this->cleanInput($data['cmpname']);
    $divname = $this->cleanInput($data['divname']);
    $cmpstate = $this->cleanInput($data['cmpstate']);
    $inoutradioid = $this->cleanInput($data['inoutid']);
    if($inoutradioid == 1){
        $brname = $this->cleanInput(implode(',',$data['brname']));
    }else{
        $brname = 0;
    }

    if($inoutradioid == 2){  
        $outbranchname = $this->cleanInput($data['altbranch']);
    }else{
        $outbranchname = '';

    }
    $designationname = $this->cleanInput($data['designationname']);
    $ex_dept = explode("~", $this->cleanInput($data['departmentname']));
    $departmentname = $ex_dept[0];
    // Company info


    // PERSONAL INFORMATION
    $empfname = $this->cleanInput($data['empfname']);
    $empemail = $this->cleanInput($data['empemail']);
    $empmobile = $this->cleanInput($data['empmobile']);
    $empaltmobile = $this->cleanInput($data['empaltmobile']);
    $empgender = $this->cleanInput($data['empgender']);
    $empmtongue = $this->cleanInput($data['empmtongue']);
    $empdob = date('Y-m-d', strtotime($this->cleanInput($data['empdob'])));
    $empage = $this->cleanInput($data['empage']);
    $empmarital = $this->cleanInput($data['empmarital']);
    $empnative = $this->cleanInput($data['empnative']);
    $empsalary = $this->cleanInput($data['empsalary']);
    $empresumedate = date('Y-m-d', strtotime($this->cleanInput($data['empresumedate'])));
    $keywords = $this->cleanInput($data['keywords']);
    $totalexperience = $this->cleanInput($data['totalexperience']);
    $candidatecurrentlocation = $this->cleanInput($data['candidatecurrentlocation']);
    $recruitmenttype = $this->cleanInput($data['recruitmenttype']);
    
    // File Resume
    $candidateresume = $this->cleanInput($data['candidateresume']);
    // File Resume

    // Languages
    /*
    $Languages1 = $this->cleanInput($data['emplanguage_1']);
    if(!empty($data['empspeak_speak_1'])){
        $speak1 = $data['empspeak_speak_1'];
    }else{
        $speak1 = 0;
    }
    if(!empty($data['empread_read_1'])){
        $read1 = $data['empread_read_1'];
    }else{
        $read1 = 0;
    }
    if(!empty($data['empwrite_write_1'])){
        $write1 = $data['empwrite_write_1'];
    }else{
        $write1 = 0;
    }
    $Languages2 = $this->cleanInput($data['emplanguage_2']);
    if(!empty($data['empspeak_speak_2'])){
        $speak2 = $data['empspeak_speak_2'];
    }else{
        $speak2 = 0;
    }
    if(!empty($data['empread_read_2'])){
        $read2 = $data['empread_read_2'];
    }else{
        $read2 = 0;
    }
    if(!empty($data['empwrite_write_2'])){
        $write2 = $data['empwrite_write_2'];
    }else{
        $write2 = 0;
    }
    */
    $Languages1 = '';
    $speak1 = 0;
    $read1 = 0;
    $write1 = 0;
    $Languages2 = '';
    $speak2 = 0;
    $read2 = 0;
    $write2 = 0;
    // Languages

    // Refrence
    $refrencecmptype = $this->cleanInput($data['refrencecmptype']);
    if($refrencecmptype == 'NAUKRI' || $refrencecmptype == 'LINKEDIN'){
    $refrencename = $this->cleanInput($data['refrencename_website']);
    }elseif($refrencecmptype == 'MAXWELL'){
        $ref = $this->cleanInput($data['refrencename_maxwell']);
        if(!empty($ref)){
        $interviewer = str_replace("_", " ", $ref);
        $extract = explode("~@~", $interviewer);
        $employeeid = $this->cleanInput($extract[0]);
        $refrencename = $this->cleanInput($extract[1]);
        }else{
        $employeeid = '';
        $refrencename = '';
        }
    }else{
    $refrencename = $this->cleanInput($data['refrencename']);
    }
    $refrencenwcnd = $this->cleanInput($data['refrencenwcnd']);
    $refrencemobile = $this->cleanInput($data['refrencemobile']);
    $refrencebranch = $this->cleanInput($data['refrencebranch']);
    $refrencewebsite_type = $this->cleanInput($data['refrencewebsite_type']);
    // Refrence

    // PERSONAL INFORMATION

    // Address
    /*
    $emppreaddress1 = $this->cleanInput($data['emppreaddress1']);
    $emppreaddress2 = $this->cleanInput($data['emppreaddress2']);
    $empprecity = $this->cleanInput($data['empprecity']);
    $empprestate = $this->cleanInput($data['empprestate']);
    $empprecountry = $this->cleanInput($data['empprecountry']);
    $empprepostalcode = $this->cleanInput($data['empprepostalcode']);
    $emppresince = $this->cleanInput($data['emppresince']);
    $empfixedaddress1 = $this->cleanInput($data['empfixedaddress1']);
    $empfixedaddress2 = $this->cleanInput($data['empfixedaddress2']);
    $empfixedcity = $this->cleanInput($data['empfixedcity']);
    $empfixedstate = $this->cleanInput($data['empfixedstate']);
    $empfixedcountry = $this->cleanInput($data['empfixedcountry']);
    $empfixedpostalcode = $this->cleanInput($data['empfixedpostalcode']);
    $empfixedpresince = $this->cleanInput($data['empfixedpresince']);
    */
    $emppreaddress1 = '';
    $emppreaddress2 = '';
    $empprecity = '';
    $empprestate = '';
    $empprecountry = '';
    $empprepostalcode = '';
    $emppresince = '';
    $empfixedaddress1 = '';
    $empfixedaddress2 = '';
    $empfixedcity = '';
    $empfixedstate = '';
    $empfixedcountry = '';
    $empfixedpostalcode = '';
    $empfixedpresince = '';
    // Address            
   
   // applied cadidates ids
   $mx_rec_jobid = $this->cleanInput($data['mx_rec_jobid']);
   $mx_rec_jobunique_id = $this->cleanInput($data['mx_rec_jobunique_id']);
   // applied cadidates ids
   
    // Creating application id
     $this->db->trans_begin();

        $this->db->select('max(mx_rec_application_id) as maxid');
        $this->db->from('maxwell_recruitment_info');
        $getquery = $this->db->get();
        $appqry = $getquery->result();
        $appid = $appqry[0]->maxid;
        $appname = 'REC';
        if($appid == ''){
            $appid = '1111';
            $applicationid = $appname . $appid;
        }else{
            $appid = ($appid + 1);
            $applicationid = $appname . $appid;
        }
    // Creating application id
        if (is_uploaded_file($_FILES["candidateresume"]["tmp_name"])) {
            $targetfolder = "uploads/recruitment/";
            $targetfolder1 = basename($_FILES['candidateresume']['name']);
            $fileext = pathinfo($_FILES['candidateresume']['name'], PATHINFO_EXTENSION);
            $resumelink = $targetfolder . $applicationid . "." . $fileext;
            move_uploaded_file($_FILES['candidateresume']['tmp_name'], $resumelink);
        } else {
            $resumelink = $this->cleanInput($data['resume_site']);
        }
        // Creating application id

    $preferedlocation = $this->cleanInput($data['candidatepreferedlocation']);

    // Table1 Data Store
    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $inarray = array (
      'mx_rec_application_id' => $appid,
      'mx_rec_application' => $applicationid,
      'mx_rec_comp_code' => $cmpname,
      'mx_rec_division_code' => $divname,
      'mx_rec_state_code' => $cmpstate,
      'mx_rec_branch_or_not' => $inoutradioid,
      'mx_rec_branch_code' => $brname,
      'mx_rec_dept_code' => $departmentname,
      'mx_rec_desg_code' => $designationname,
      'mx_rec_manual_branch' => $outbranchname,
      'mx_rec_name' => $empfname,
      'mx_rec_email' => $empemail,
      'mx_rec_phone_no' => $empmobile,
      'mx_rec_alt_phn_no' => $empaltmobile,
      'mx_rec_gender' => $empgender,
      'mx_rec_mother_tongue' => $empmtongue,
      'mx_rec_date_of_birth' => $empdob,
      'mx_rec_age' => $empage,
      'mx_rec_marital_status' => $empmarital,
      'mx_rec_native' => $empnative,
      'mx_rec_expected_salary' => $empsalary,
      'mx_rec_resume_received_date' => $empresumedate,
      'mx_rec_resume_link' => $resumelink,
      'mx_rec_language_1' => $Languages1,
      'mx_rec_speak_1' => $speak1,
      'mx_rec_read_1' => $read1,
      'mx_rec_write_1' => $write1,
      'mx_rec_language_2' => $Languages2,
      'mx_rec_speak_2' => $speak2,
      'mx_rec_read_2' => $read2,
      'mx_rec_write_2' => $write2,
      'mx_rec_refrence_type' => $refrencecmptype,
      'mx_rec_refrence_name' => $refrencename,
      'mx_rec_refrence_relation' => $refrencenwcnd,
      'mx_rec_refrence_mobile' => $refrencemobile,
      'mx_rec_present_address1' => $emppreaddress1,
      'mx_rec_present_address2' => $emppreaddress2,
      'mx_rec_present_city' => $empprecity,
      'mx_rec_present_state' => $empprestate,
      'mx_rec_present_country' => $empprecountry,
      'mx_rec_present_postalcode' => $empprepostalcode,
      'mx_rec_present_since' => $emppresince,
      'mx_rec_fixed_address1' => $empfixedaddress1,
      'mx_rec_fixed_address2' => $empfixedaddress2,
      'mx_rec_fixed_city' => $empfixedcity,
      'mx_rec_fixed_state' => $empfixedstate,
      'mx_rec_fixed_country' => $empfixedcountry,
      'mx_rec_fixed_postalcode' => $empfixedpostalcode,
      'mx_rec_fixed_present_since' => $empfixedpresince,
      'mx_rec_keywords' => $keywords,
      'mx_rec_status' => '1',
      'mx_rec_process_status' => '1',
      'mx_createdby' => $this->session->userdata('user_id'),
      'mx_createdtime' => $date,
      'mx_created_ip' => $ip,
      'mx_rec_jobunique_id' => $mx_rec_jobunique_id,
      'mx_rec_jobid' => $mx_rec_jobid,
      'mx_rec_prefered_location' => $preferedlocation,
      'refrencebranch' => $refrencebranch,
      'refrencewebsite_type' => $refrencewebsite_type,
      'refrence_employee_code' => $employeeid,
      'totalexperience' => $totalexperience,
      'candidatecurrentlocation' => $candidatecurrentlocation,
      'recruitmenttype' => $recruitmenttype,
    );
    $this->db->insert('maxwell_recruitment_info', $inarray);

    // Academic Records
    /*
    if (count($data['empacrtype']) > 0 && !empty($data['empacrtype'])) {
        $acr = 1;
        for ($i = 0; $i < count($data['empacrtype']); $i++) {
            $empacryop = $this->cleanInput($data['empacryop'][$i]);
            $empacrinstitution = $this->cleanInput($data['empacrinstitution'][$i]);
            $empacrsubject = $this->cleanInput($data['empacrsubject'][$i]);
            $empacruniversity = $this->cleanInput($data['empacruniversity'][$i]);
            $empacrmarks = $this->cleanInput($data['empacrmarks'][$i]);
                
            $acrimage = "";

            $inarrayacr = array(
                "mx_rec_acr_application_id" => $applicationid,
                "mx_rec_acr_type" => $data['empacrtype'][$i],
                "mx_rec_acr_yop" => $empacryop,
                "mx_rec_acr_institution" => $empacrinstitution,
                "mx_rec_acr_subject" => $empacrsubject,
                "mx_rec_acr_university" => $empacruniversity,
                "mx_rec_acr_marks" => $empacrmarks,
                "mx_rec_acr_files" => $acrimage,
                "mx_rec_acr_createdby" => '',
                "mx_rec_acr_createdtime" => $date,
                "mx_rec_acr_created_ip" => $ip,
            );
            $this->db->insert('maxwell_recruitment_academic_records', $inarrayacr);

            $acr++;
        }
    }
    */
    // Academic Records

    // Family Information   
    /*
    if (count($data['empfmrelation']) > 0 && !empty($data['empfmrelation'])) {
        for ($i = 0; $i < count($data['empfmrelation']); $i++) {
            $empfmrelation = $this->cleanInput($data['empfmrelation'][$i]);
            $empfmname = $this->cleanInput($data['empfmname'][$i]);
            $empfmage = $this->cleanInput($data['empfmage'][$i]);
            $empfmoccupation = $this->cleanInput($data['empfmoccupation'][$i]);
            $inarrayfm = array(
                "mx_rec_fm_application_id" => $applicationid,
                "mx_rec_fm_relation" => $empfmrelation,
                "mx_rec_fm_name" => $empfmname,
                "mx_rec_fm_age" => $empfmage,
                "mx_rec_fm_occupation" => $empfmoccupation,
                "mx_rec_fm_createdby" => '',
                "mx_rec_fm_createdtime" => $date,
                "mx_rec_fm_created_ip" => $ip,
            );
            
            $this->db->insert('maxwell_recruitment_family', $inarrayfm);
        }
    }
    */
    // Family Information

    // Previous Employment
    if (count($data['emppreviousprediofromto']) > 0 && !empty($data['emppreviousprediofromto'])) {
        for ($i = 0; $i < count($data['emppreviousprediofromto']); $i++) {
            $emppreviousprediofromto = $this->cleanInput($data['emppreviousprediofromto'][$i]);
            $emppreviousorgnation = $this->cleanInput($data['emppreviousorgnation'][$i]);
            $emppreviousdesgjointime = $this->cleanInput($data['emppreviousdesgjointime'][$i]);
            $emppreviousleavingtime = $this->cleanInput($data['emppreviousleavingtime'][$i]);
            $emppreviousreportedto = $this->cleanInput($data['emppreviousreportedto'][$i]);
            $empprevioussalarypermonth = $this->cleanInput($data['empprevioussalarypermonth'][$i]);
            $emppreviousotherbenfits = $this->cleanInput($data['emppreviousotherbenfits'][$i]);
            $emppreviousreasonchange = $this->cleanInput($data['emppreviousreasonchange'][$i]);
            $inarraype = array(
                "mx_rec_pe_application_id" => $applicationid,
                "mx_rec_pe_periodfromto" => $emppreviousprediofromto,
                "mx_rec_pe_nameandorg" => $emppreviousorgnation,
                "mx_rec_pe_desgjointime" => $emppreviousdesgjointime,
                "mx_rec_pe_desgleavingtime" => $emppreviousleavingtime,
                "mx_rec_pe_desgreportedto" => $emppreviousreportedto,
                "mx_rec_pe_monthlysalary" => $empprevioussalarypermonth,
                "mx_rec_pe_otherbenfits" => $emppreviousotherbenfits,
                "mx_rec_pe_reasonforchange" => $emppreviousreasonchange,
                "mx_rec_pe_createdby" => $this->session->userdata('user_id'),
                "mx_rec_pe_createdtime" => $date,
                "mx_rec_pe_created_ip" => $ip,
            );
            $this->db->insert('maxwell_recruitment_previous_employments', $inarraype);
        }
    }
    // Previous Employment
    
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
    
}

public function getrecurimentsavedinfo($data){
    if($data['filterdata'] != ALL){
    $fromdate = date('Y-m-d',strtotime($data['fromdate'])) . ' 00:00:00';
    $todate = date('Y-m-d',strtotime($data['todate'])) . ' 23:59:59';        
    }

    $sql = "select a.mx_rec_autouniqueid,a.mx_rec_application,cmp.mxcp_name,divi.mxd_name,state.mxst_state,dept.mxdpt_name,desg.mxdesg_name,a.mx_rec_branch_or_not,
    a.mx_rec_branch_code,a.mx_rec_manual_branch,a.mx_rec_name,a.mx_rec_email,a.mx_rec_phone_no,
    a.mx_rec_alt_phn_no,a.mx_rec_gender,a.mx_rec_mother_tongue,a.mx_rec_date_of_birth,a.mx_rec_age,a.mx_rec_marital_status,
    a.mx_rec_native,a.mx_rec_expected_salary,a.mx_rec_resume_received_date,a.mx_rec_resume_link,a.mx_rec_language_1,
    a.mx_rec_speak_1,a.mx_rec_read_1,a.mx_rec_write_1,a.mx_rec_language_2,a.mx_rec_speak_2,a.mx_rec_read_2,a.mx_rec_write_2,
    a.mx_rec_refrence_type,a.mx_rec_refrence_name,a.mx_rec_refrence_relation,a.mx_rec_refrence_mobile,a.mx_rec_present_address1,
    a.mx_rec_present_address2,a.mx_rec_present_city,a.mx_rec_present_state,a.mx_rec_present_country,a.mx_rec_present_postalcode,
    a.mx_rec_present_since,a.mx_rec_fixed_address1,a.mx_rec_fixed_address2,a.mx_rec_fixed_city,a.mx_rec_fixed_state,
    a.mx_rec_fixed_country,a.mx_rec_fixed_postalcode,a.mx_rec_fixed_present_since,a.mx_rec_status,a.mx_rec_process_status,a.mx_createdtime,a.mx_rec_keywords,a.mx_rec_refrence_type,a.mx_rec_refrence_name,a.refrencebranch,a.refrencewebsite_type,a.refrence_employee_code,a.refrence_employee_name,a.mx_rec_refrence_relation,a.mx_rec_refrence_mobile,pre.previous_employments
from maxwell_recruitment_info as a

left join(
    select mx_rec_fm_application_id,group_concat(concat(mx_rec_fm_relation,'-',mx_rec_fm_name,'-',mx_rec_fm_age,'-',mx_rec_fm_occupation)) as family_details 
    from maxwell_recruitment_family group by mx_rec_fm_application_id
) as c on c.mx_rec_fm_application_id = a.mx_rec_application
left join(
    select mx_rec_pe_application_id,group_concat(concat(mx_rec_pe_periodfromto,'-',mx_rec_pe_nameandorg,'-',mx_rec_pe_desgjointime,'-',mx_rec_pe_desgleavingtime,'-',mx_rec_pe_desgreportedto,'-',mx_rec_pe_monthlysalary,'-',mx_rec_pe_otherbenfits,'-',mx_rec_pe_reasonforchange)) as previous_employments 
    from maxwell_recruitment_previous_employments group by mx_rec_pe_application_id
) as pre 
 on pre.mx_rec_pe_application_id = a.mx_rec_application
  inner join maxwell_company_master as cmp on cmp.mxcp_id = a.mx_rec_comp_code
 inner join maxwell_division_master as divi on divi.mxd_id = a.mx_rec_division_code
 inner join maxwell_state_master as state on state.mxst_id = a.mx_rec_state_code
 inner join maxwell_department_master as dept on dept.mxdpt_id = a.mx_rec_dept_code
 inner join maxwell_designation_master as desg on desg.mxdesg_id = a.mx_rec_desg_code
 where mx_rec_status = '1' ";
 if($data['filterdata'] != ALL){
 $sql .=" and mx_createdtime between '$fromdate' and '$todate' ";
 }
 $processstatus = $data['processstatus'];
 if(!empty($processstatus)){
     $sql .=" and mx_rec_process_status = '$processstatus' ";
 }
 $recruitmenttype = $data['recruitmenttype'];
 if(!empty($recruitmenttype)){
    $sql .=" and recruitmenttype = '$recruitmenttype' ";
 }
// $sql .=" group by mx_rec_acr_application_id order by mx_createdtime desc";
$sql .=" order by mx_createdtime desc";
    $query = $this->db->query($sql);
    $qury = $query->result();
    return $qury;
}

// public function getrecurimentsavedinfo($data){
//     if($data['filterdata'] != ALL){
//     $fromdate = date('Y-m-d',strtotime($data['fromdate'])) . ' 00:00:00';
//     $todate = date('Y-m-d',strtotime($data['todate'])) . ' 23:59:59';        
//     }

//     $sql = "select a.mx_rec_autouniqueid,a.mx_rec_application,cmp.mxcp_name,divi.mxd_name,state.mxst_state,dept.mxdpt_name,desg.mxdesg_name,a.mx_rec_branch_or_not,
//     a.mx_rec_branch_code,a.mx_rec_manual_branch,a.mx_rec_name,a.mx_rec_email,a.mx_rec_phone_no,
//     a.mx_rec_alt_phn_no,a.mx_rec_gender,a.mx_rec_mother_tongue,a.mx_rec_date_of_birth,a.mx_rec_age,a.mx_rec_marital_status,
//     a.mx_rec_native,a.mx_rec_expected_salary,a.mx_rec_resume_received_date,a.mx_rec_resume_link,a.mx_rec_language_1,
//     a.mx_rec_speak_1,a.mx_rec_read_1,a.mx_rec_write_1,a.mx_rec_language_2,a.mx_rec_speak_2,a.mx_rec_read_2,a.mx_rec_write_2,
//     a.mx_rec_refrence_type,a.mx_rec_refrence_name,a.mx_rec_refrence_relation,a.mx_rec_refrence_mobile,a.mx_rec_present_address1,
//     a.mx_rec_present_address2,a.mx_rec_present_city,a.mx_rec_present_state,a.mx_rec_present_country,a.mx_rec_present_postalcode,
//     a.mx_rec_present_since,a.mx_rec_fixed_address1,a.mx_rec_fixed_address2,a.mx_rec_fixed_city,a.mx_rec_fixed_state,
//     a.mx_rec_fixed_country,a.mx_rec_fixed_postalcode,a.mx_rec_fixed_present_since,a.mx_rec_status,a.mx_rec_process_status,a.mx_createdtime,a.mx_rec_keywords,
// group_concat(concat(mx_rec_acr_type,'-',mx_rec_acr_yop,'-',mx_rec_acr_institution,'-',mx_rec_acr_subject,'-',mx_rec_acr_university,'-',mx_rec_acr_marks)) as academic_records,
// c.family_details,pre.previous_employments
// from maxwell_recruitment_info as a
// left join maxwell_recruitment_academic_records as b on b.mx_rec_acr_application_id=a.mx_rec_application
// left join(
//     select mx_rec_fm_application_id,group_concat(concat(mx_rec_fm_relation,'-',mx_rec_fm_name,'-',mx_rec_fm_age,'-',mx_rec_fm_occupation)) as family_details 
//     from maxwell_recruitment_family group by mx_rec_fm_application_id
// ) as c on c.mx_rec_fm_application_id = a.mx_rec_application
// left join(
//     select mx_rec_pe_application_id,group_concat(concat(mx_rec_pe_periodfromto,'-',mx_rec_pe_nameandorg,'-',mx_rec_pe_desgjointime,'-',mx_rec_pe_desgleavingtime,'-',mx_rec_pe_desgreportedto,'-',mx_rec_pe_monthlysalary,'-',mx_rec_pe_otherbenfits,'-',mx_rec_pe_reasonforchange)) as previous_employments 
//     from maxwell_recruitment_previous_employments group by mx_rec_pe_application_id
// ) as pre 
//  on pre.mx_rec_pe_application_id = a.mx_rec_application
//   inner join maxwell_company_master as cmp on cmp.mxcp_id = a.mx_rec_comp_code
//  inner join maxwell_division_master as divi on divi.mxd_id = a.mx_rec_division_code
//  inner join maxwell_state_master as state on state.mxst_id = a.mx_rec_state_code
//  inner join maxwell_department_master as dept on dept.mxdpt_id = a.mx_rec_dept_code
//  inner join maxwell_designation_master as desg on desg.mxdesg_id = a.mx_rec_desg_code
//  where mx_rec_status = '1' ";
//  if($data['filterdata'] != ALL){
//  $sql .=" and mx_createdtime between '$fromdate' and '$todate' ";
//  }
// $sql .=" group by mx_rec_acr_application_id order by mx_createdtime desc";
//     $query = $this->db->query($sql);
//     $qury = $query->result();
//     return $qury;
// }


public function portalscount($data){
    if($data['filterdata'] != ALL){
    $fromdate = date('Y-m-d',strtotime($data['fromdate'])) . ' 00:00:00';
    $todate = date('Y-m-d',strtotime($data['todate'])) . ' 23:59:59';
    }
    $sql = "select mx_rec_refrence_type,count(mx_rec_refrence_type) as count from maxwell_recruitment_info where mx_rec_status = '1' ";
    if($data['filterdata'] != ALL){
    $sql .=" and mx_createdtime between '$fromdate' and '$todate' ";
    }
    $sql .=" group by mx_rec_refrence_type";
        $query = $this->db->query($sql);
    $qury = $query->result();
    return $qury;
}


public function recruitmentprocess($data){
    $this->db->select('mx_rec_comp_code,mx_rec_division_code,mx_rec_state_code,mx_rec_branch_or_not,mx_rec_branch_code,mx_rec_dept_code,mx_rec_manual_branch,mx_rec_application,mx_rec_name,mx_rec_email,mx_rec_phone_no,mx_rec_alt_phn_no,mx_rec_process_status');
    $this->db->from('maxwell_recruitment_info');
    $this->db->where('mx_rec_application', $data);
    $query = $this->db->get();
    $qry = $query->result();
    return $qry;
}

public function recruitmentprocessdetails($userdata, $data){
    $this->db->select('mx_rec_process_id,mx_rec_process_application_id,mx_rec_process_scheduleddate,mx_rec_process_interviewdate,mx_rec_process_interviewer_employee_code,mx_rec_process_interviewer_name,mx_rec_process_reccompanyid,
  mx_rec_process_divison,mx_rec_process_branch,mx_rec_process_interviewetype,mx_rec_process_recname,mx_rec_process_recemail,
  mx_rec_process_recphone,mx_rec_process_recaltphone,mx_rec_process_rec_info_table_processstatus,mx_rec_process_interviewe_status,
  mx_rec_process_review_education_training,mx_rec_process_review_workexperince,mx_rec_process_review_skills,mx_rec_process_review_communication,mx_rec_process_review_candidate_intrest,mx_rec_process_review_interviewer_satisifaction,mx_rec_process_review_interviewer_comments,
  mx_rec_process_status,mxcp_name,mxd_name,mxb_name,mx_rec_process_createdby,mx_rec_intreview_stages');

    $this->db->from('maxwell_recruitment_process');
        $this->db->join('maxwell_division_master', 'mxd_id = mx_rec_process_divison', 'INNER');
        $this->db->join('maxwell_branch_master', 'mxb_id = mx_rec_process_branch', 'INNER');
        $this->db->join('maxwell_company_master', 'mxcp_id = mx_rec_process_reccompanyid', 'INNER');
    if(!empty($data)){
    $this->db->where('mx_rec_process_application_id', $data);
    }
    if(!empty($userdata['applicationid'])){
        $appid = $userdata['applicationid'];
        $this->db->where('mx_rec_process_application_id', $appid);
    }
    if(!empty($userdata['uniqueid'])){
        $id = $userdata['uniqueid'];
        $this->db->where('mx_rec_process_id', $id);
    }
    $this->db->order_by("mx_rec_process_createdtime", "desc");
    $query = $this->db->get();
    $qry = $query->result();
    return $qry;
}

 public function divisionmaster($id){
        $this->db->select('mxd_id,mxd_name');
        $this->db->from('maxwell_division_master');
        $this->db->where('mxd_status = 1');
        $this->db->where('mxd_comp_id',$id);
        $query = $this->db->get();
//echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }

    public function branchmaster($id){
        $this->db->select('mxb_id,mxb_name');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        $this->db->where('mxb_div_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

public function getrecemployees($data){
    $divisionid = $data['divisionid'];
    $branchid = $data['branchid'];
    $companyid = $data['companyid'];
        $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname');
        $this->db->from('maxwell_employees_info');
        $this->db->where('mxemp_emp_comp_code', $companyid);
        $this->db->where('mxemp_emp_division_code', $divisionid);
        $this->db->where('mxemp_emp_branch_code', $branchid);
        $this->db->where('mxemp_emp_status', 1);
        $this->db->where('mxemp_emp_resignation_status', 0);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
}

public function getallemployeesinemployeetable(){
    // $divisionid = $data['divisionid'];
    // $branchid = $data['branchid'];
    // $companyid = $data['companyid'];
        $this->db->select('mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname');
        $this->db->from('maxwell_employees_info');
        // $this->db->where('mxemp_emp_comp_code', $companyid);
        // $this->db->where('mxemp_emp_division_code', $divisionid);
        // $this->db->where('mxemp_emp_branch_code', $branchid);
        // $this->db->where('mxemp_emp_status', 1);
        // $this->db->where('mxemp_emp_resignation_status', 0);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
}

public function saverecruitmentprocess($data){
    $scheduleddate = date('Y-m-d',strtotime($this->cleanInput($data['scheduleddate'])));
    $interviewdate = date('Y-m-d',strtotime($this->cleanInput($data['interviewdate'])));
    $interviewer = str_replace("_", " ", $data['interviewer']);
    $extract = explode("~@~", $interviewer);
    $employeeid = $this->cleanInput($extract[0]);
    $employeename = $this->cleanInput($extract[1]);
    $interviewetype = $this->cleanInput($data['interviewetype']);
    $divison = $this->cleanInput($data['divison']);
    $branch = $this->cleanInput($data['branch']);
    $companyid = $this->cleanInput($data['reccompanyid']);
    $applicationid = $this->cleanInput($data['recapplicationid']);
    $recname = $this->cleanInput($data['recname']);
    $recemail = $this->cleanInput($data['recemail']);
    $recphone = $this->cleanInput($data['recphone']);
    $recaltphone = $this->cleanInput($data['recaltphone']);
    $recprocessstatus = $this->cleanInput($data['recprocessstatus']);
    $stages = $this->cleanInput($data['interviewstage']);

    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $this->db->trans_begin();
    $inarray = array(
        "mx_rec_intreview_stages" => $stages,
        "mx_rec_process_scheduleddate" => $scheduleddate,
        "mx_rec_process_interviewdate" => $interviewdate,
        "mx_rec_process_interviewer_employee_code" => $employeeid,
        "mx_rec_process_interviewer_name" => $employeename,
        "mx_rec_process_interviewetype" => $interviewetype,
        "mx_rec_process_reccompanyid" => $companyid,
        "mx_rec_process_divison" => $divison,
        "mx_rec_process_branch" => $branch,
        "mx_rec_process_application_id" => $applicationid,
        "mx_rec_process_recname" => $recname,
        "mx_rec_process_recemail" => $recemail,
        "mx_rec_process_recphone" => $recphone,
        "mx_rec_process_recaltphone" => $recaltphone,
        "mx_rec_process_rec_info_table_processstatus" => $recprocessstatus,
        "mx_rec_process_interviewe_status" => "7",
        "mx_rec_process_createdtime" => $date,
        "mx_rec_process_created_ip" => $ip,
        "mx_rec_process_createdby" => $this->session->userdata('user_id'),
    );

    $this->db->insert('maxwell_recruitment_process', $inarray);

        $uparray = array('mx_rec_process_status' => 7);
        $this->db->where('mx_rec_application', $applicationid);
        $this->db->update('maxwell_recruitment_info', $uparray);

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }

}


public function updaterecruitmentreview($data){

$processstatus = $this->cleanInput($data['processstatus']);
$edtr = $this->cleanInput($data['edtr']);
$workexperience = $this->cleanInput($data['workexperience']);
$skills = $this->cleanInput($data['skills']);
$verbalcommunication = $this->cleanInput($data['verbalcommunication']);
$candidateenthusiasm = $this->cleanInput($data['candidateenthusiasm']);
$interviewerreview = $this->cleanInput($data['interviewerreview']);
$comments = $this->cleanInput($data['comments']);
$reviewuniqid = $this->cleanInput($data['reviewuniqid']);
$reviwapplicationid = $this->cleanInput($data['reviwapplicationid']);

    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $this->db->trans_begin();
    $uparray = array(
        "mx_rec_process_interviewe_status" => $processstatus,
        "mx_rec_process_review_education_training" => $edtr,
        "mx_rec_process_review_workexperince" => $workexperience,
        "mx_rec_process_review_skills" => $skills,
        "mx_rec_process_review_communication" => $verbalcommunication,
        "mx_rec_process_review_candidate_intrest" => $candidateenthusiasm,
        "mx_rec_process_review_interviewer_satisifaction" => $interviewerreview,
        "mx_rec_process_review_interviewer_comments" => $comments,
        "mx_rec_process_modifyby" => '',
        "mx_rec_process_modifiedtime" => $date,
        "mx_rec_process_modified_ip" => $ip,
    );

        $this->db->where('mx_rec_process_id', $reviewuniqid);
        $this->db->where('mx_rec_process_application_id', $reviwapplicationid);
        $this->db->update('maxwell_recruitment_process', $uparray);

        $uparraymaintable = array('mx_rec_process_status' => $processstatus);
        $this->db->where('mx_rec_application', $reviwapplicationid);
        $this->db->update('maxwell_recruitment_info', $uparraymaintable);

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }

}


// ----------------------  added 05-7-2021 -----------

public function  editjobmangedetails($data){
    $divisionid = $this->cleanInput($data['divisionid']);
    $mxrc_type_id = $this->cleanInput($data['mxrc_type_id']);
    $jobid = $this->cleanInput($data['jobid']);
    $jobtitle = $this->cleanInput($data['jobtitle']);
    $department = $this->cleanInput($data['department']);
    $joblocation = $this->cleanInput($data['joblocation']);
    $noofvacancies = $this->cleanInput($data['novacancies']);
    $experience = $this->cleanInput($data['experience']);
    $age = $this->cleanInput($data['age']);
    $salaryfrom = $this->cleanInput($data['salaryfrom']);
    $salaryto = $this->cleanInput($data['salaryto']);
    $jobtype = $this->cleanInput($data['jobtype']);
    $status = $this->cleanInput($data['status']);
    $startdate = $this->cleanInput($data['stdate']);
    $expdate = $this->cleanInput($data['expdate']);
    $desc = $data['description'];
    $templateid = $data['templateid'];
    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $this->db->trans_begin();
    $inarray = array(
        "mxrc_job_title" => $jobtitle,
        "mxrc_department" => $department,
        "mxrc_job_location" => $joblocation,
        "mxrc_job_vacancies" => $noofvacancies,
        "mxrc_job_experience" => $experience,
        "mxrc_age" => $age,
        "mxrc_salary_from" => $salaryfrom,
        "mxrc_salary_to" => $salaryto,
        "mxrc_job_type" => $jobtype,
        "mxrc_job_status" => $status,
        "mxrc_job_start_date" => date('Y-m-d',strtotime($startdate)),
        "mxrc_job_end_date" => date('Y-m-d',strtotime($expdate)),
        "mxrc_job_description" => $desc,
        "mxrc_templateid" => $templateid,
        "mxrc_modified_ip" => $ip,
        "mxrc_modifiedtime" => $date,
        "mxrc_modifyby" => $this->session->userdata('user_id'),
    );
    
    // Cron
        $data_string = json_encode($inarray); 
        $processdata_string = json_decode($data_string,true); 
        $processdata_string['mxrc_type_id'] = $mxrc_type_id;
        $crosssitedata = json_encode($processdata_string);
        
        if($divisionid == 1){                                                                                                                     
        $ch = curl_init('https://maxwelllogistics.net/recruitment_services/update_recruitment.php');
        }elseif($divisionid == 2){
        $ch = curl_init('https://maxwellrelocations.com/recruitment_services/update_recruitment.php');    
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $crosssitedata);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($crosssitedata))                                                                       
        );                                                                                                                   
        $response = curl_exec($ch);
        curl_close($ch);
        if($response != 200){
            $this->db->trans_rollback();
            return 2; exit();
        }
    // End Cron
    $this->db->where('mxrc_id', $jobid);
    $this->db->where('mxrc_type_id', $mxrc_type_id);
    $this->db->update('maxwell_recruitment', $inarray);
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
    }
    
public function getemployeecompletedetails($id)
{
    // Employee Info
    $this->db->select('mx_rec_prefered_location,mx_rec_autouniqueid,mx_rec_application_id,mx_rec_application,mx_rec_comp_code,mx_rec_division_code,mx_rec_branch_code,mx_rec_branch_or_not,mx_rec_dept_code,
    mx_rec_desg_code,mx_rec_state_code,mx_rec_manual_branch,mx_rec_keywords,mx_rec_name,mx_rec_email,mx_rec_phone_no,mx_rec_alt_phn_no,mx_rec_gender,mx_rec_mother_tongue,
    mx_rec_date_of_birth,mx_rec_age,mx_rec_marital_status,mx_rec_native,mx_rec_expected_salary,mx_rec_resume_received_date,mx_rec_resume_link,
    mx_rec_language_1,mx_rec_speak_1,mx_rec_read_1,mx_rec_write_1,mx_rec_language_2,mx_rec_speak_2,mx_rec_read_2,mx_rec_write_2,mx_rec_refrence_type,mx_rec_refrence_name,mx_rec_refrence_relation,
    mx_rec_refrence_mobile,mx_rec_present_address1,mx_rec_present_address2,mx_rec_present_city,mx_rec_present_state,mx_rec_present_country,mx_rec_present_postalcode,mx_rec_present_since,
    mx_rec_fixed_address1,mx_rec_fixed_address2,mx_rec_fixed_city,mx_rec_fixed_state,mx_rec_fixed_country,mx_rec_fixed_postalcode,mx_rec_fixed_present_since,mxcp_name,mxdesg_name,
    mxdpt_name,mxd_name,mxb_name,mxst_id,mxst_state,refrence_employee_code,refrencebranch,refrencewebsite_type,recruitmenttype,candidatecurrentlocation,totalexperience,"maxwell_recruitment_info" as tblname');
    $this->db->from('maxwell_recruitment_info');
    $this->db->join('maxwell_company_master', 'mxcp_id = mx_rec_comp_code', 'INNER');
    $this->db->join('maxwell_designation_master', 'mxdesg_id = mx_rec_desg_code', 'INNER');
    $this->db->join('maxwell_department_master', 'mxdpt_id = mx_rec_dept_code', 'INNER');
    $this->db->join('maxwell_division_master', 'mxd_id = mx_rec_division_code', 'INNER');
    $this->db->join('maxwell_branch_master', 'mxb_id = mx_rec_branch_code', 'LEFT'); 
    $this->db->join('maxwell_state_master', 'mxst_id = mx_rec_state_code', 'INNER');
    $this->db->where('mx_rec_autouniqueid', $id);
    $this->db->where('mx_rec_status', 1);
    $query1 = $this->db->get();
    $qry1 = $query1->result();
    $returnarray['recinfo'] = $qry1;
    // Employee Info

    // Academic Records
    $this->db->select('mx_rec_acr_id,mx_rec_acr_application_id,mx_rec_acr_type,mx_rec_acr_yop,mx_rec_acr_institution,mx_rec_acr_subject,mx_rec_acr_university,
                       mx_rec_acr_marks, mx_rec_acr_files,"maxwell_recruitment_academic_records" as tblname');
    $this->db->from('maxwell_recruitment_academic_records');
    $this->db->where('mx_rec_acr_application_id', $qry1[0]->mx_rec_application);
    $query2 = $this->db->get();
    $returnarray['recacr'] = $query2->result();
    // Academic Records

    // Family
    $this->db->select('mx_rec_fm_id,mx_rec_fm_application_id,mx_rec_fm_relation,mx_rec_fm_name,mx_rec_fm_age,mx_rec_fm_occupation,"maxwell_recruitment_family" as tblname');
    $this->db->from('maxwell_recruitment_family');
    $this->db->where('mx_rec_fm_application_id', $qry1[0]->mx_rec_application);
    $query4 = $this->db->get();
    $returnarray['recfm'] = $query4->result();
    // Family
   
    // Previous Employments
    $this->db->select('mx_rec_pe_id,mx_rec_pe_application_id,mx_rec_pe_periodfromto,mx_rec_pe_nameandorg,mx_rec_pe_desgjointime,mx_rec_pe_desgleavingtime,
                       mx_rec_pe_desgreportedto,mx_rec_pe_monthlysalary,mx_rec_pe_otherbenfits,mx_rec_pe_reasonforchange');
    $this->db->from('maxwell_recruitment_previous_employments');
    $this->db->where('mx_rec_pe_application_id', $qry1[0]->mx_rec_application);
    $query5 = $this->db->get();
    $returnarray['recpe'] = $query5->result();
    // Previous Employments
    return $returnarray;
}

public function updatepersonaldeatils($data){
    // PERSONAL INFORMATION
    $empfname = $this->cleanInput($data['empfname']);
    $empgender = $this->cleanInput($data['empgender']);
    $empmobile = $this->cleanInput($data['empmobile']);
    $empaltmobile = $this->cleanInput($data['empaltmobile']);
    $empmtongue = $this->cleanInput($data['empmtongue']);
    $empage = $this->cleanInput($data['empage']);
    $empemail = $this->cleanInput($data['empemail']);
    $empdob = date('Y-m-d', strtotime($this->cleanInput($data['empdob'])));
    $empmarital = $this->cleanInput($data['empmarital']);
    $empsalary = $this->cleanInput($data['empsalary']);
    $employeeid = $this->cleanInput($data['perrecid']);
    $uniqueid = $this->cleanInput($data['uniqueid']);
    $empnative = $this->cleanInput($data['empnative']);
    $empresumedate =  date('Y-m-d', strtotime($this->cleanInput($data['empresumedate'])));
    
    // $emplanguage_1 = $this->cleanInput(isset($data['emplanguage_1']) ? $data['emplanguage_1'] : 0 );
    // $empspeak_speak_1 = $this->cleanInput(isset($data['empspeak_speak_1']) ? $data['empspeak_speak_1'] : 0);
    // $empread_read_1 = $this->cleanInput(isset($data['empread_read_1']) ? $data['empread_read_1'] : 0 );
    // $empwrite_write_1 = $this->cleanInput(isset($data['empwrite_write_1']) ? $data['empwrite_write_1'] : 0);
    // $emplanguage_2 = $this->cleanInput(isset($data['emplanguage_2']) ? $data['emplanguage_2'] : 0 );
    // $empspeak_speak_2 = $this->cleanInput(isset($data['empspeak_speak_2']) ? $data['empspeak_speak_2'] : 0);
    // $empread_read_2 = $this->cleanInput(isset($data['empread_read_2']) ? $data['empread_read_2']:0);
    // $empwrite_write_2 = $this->cleanInput(isset($data['empwrite_write_2']) ? $data['empwrite_write_2'] : 0);
    
    $emplanguage_1 = '0';
    $empspeak_speak_1 = '0';
    $empread_read_1 = '0';
    $empwrite_write_1 = '0';
    $emplanguage_2 = '0';
    $empspeak_speak_2 = '0';
    $empread_read_2 = '0';
    $empwrite_write_2 = '0';
    
    $preferedlocation = $this->cleanInput($data['candidatepreferedlocation']);
    $totalexperience = $this->cleanInput($data['totalexperience']);
    $candidatecurrentlocation = $this->cleanInput($data['candidatecurrentlocation']);
    $recruitmenttype = $this->cleanInput($data['recruitmenttype']);
    // PERSONAL INFORMATION

    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $uparray = array(
        "mx_rec_name" => $empfname,
        "mx_rec_email" => $empemail,
        "mx_rec_phone_no" => $empmobile,
        "mx_rec_alt_phn_no" => $empaltmobile,
        "mx_rec_gender" => $empgender,
        "mx_rec_mother_tongue" => $empmtongue,
        "mx_rec_date_of_birth" => $empdob,
        "mx_rec_age" => $empage,      
        "mx_rec_marital_status" => $empmarital,
        "mx_rec_native" => $empnative,
        "mx_rec_expected_salary" => $empsalary,
        "mx_rec_resume_received_date" => $empresumedate,
        "mx_rec_language_1" => $emplanguage_1,
        "mx_rec_speak_1" => $empspeak_speak_1,
        "mx_rec_read_1"  => $empread_read_1,
        "mx_rec_write_1" => $empwrite_write_1,
        "mx_rec_language_2" => $emplanguage_2,
        "mx_rec_speak_2" => $empspeak_speak_2,
        "mx_rec_read_2"  => $empread_read_2,
        "mx_rec_write_2" => $empwrite_write_2,
        "mx_modifyby" => $this->session->userdata('user_id'),
        "mx_modifiedtime" => $date,
        "mx_modified_ip" => $ip,
        "mx_rec_prefered_location" => $preferedlocation,
        "totalexperience" => $totalexperience,
        "candidatecurrentlocation" => $candidatecurrentlocation,
        "recruitmenttype" => $recruitmenttype,
    );
    if (is_uploaded_file($_FILES["candidateresume"]["tmp_name"])) {
        $targetfolder = "uploads/recruitment/";
        $targetfolder1 = basename($_FILES['candidateresume']['name']);
        $fileext = pathinfo($_FILES['candidateresume']['name'], PATHINFO_EXTENSION);
        $resumelink = $targetfolder . $employeeid . "." . $fileext;
        move_uploaded_file($_FILES['candidateresume']['tmp_name'], $resumelink);
        $uparray["mx_rec_resume_link"] = $resumelink;
    }
    $this->db->where('mx_rec_autouniqueid', $uniqueid);
    $this->db->where('mx_rec_application', $employeeid);
    return $this->db->update('maxwell_recruitment_info', $uparray);
}

public function updaterecruitmentacademicdetails($data){
    $this->db->trans_begin();
    // Academic Records
    if (count($data['empacrtype']) > 0 && !empty($data['empacrtype'])) {
        $acr = 1;
        for ($i = 0; $i < count($data['empacrtype']); $i++) {
            $empacryop = $this->cleanInput($data['empacryop'][$i]);
            $empacrinstitution = $this->cleanInput($data['empacrinstitution'][$i]);
            $empacrsubject = $this->cleanInput($data['empacrsubject'][$i]);
            $empacruniversity = $this->cleanInput($data['empacruniversity'][$i]);
            $empacrmarks = $this->cleanInput($data['empacrmarks'][$i]);
            $newemployeeid = $this->cleanInput($data['empacremployeeid'][$i]);
            $empacruniqid = $this->cleanInput($data['empacruniqid'][$i]);
                $ip = $this->get_client_ip();
                $date = date('Y-m-d H:i:s');
            $uparrayacr = array(
                "mx_rec_acr_type" => $data['empacrtype'][$i],
                "mx_rec_acr_yop" => $empacryop,
                "mx_rec_acr_institution" => $empacrinstitution,
                "mx_rec_acr_subject" => $empacrsubject,
                "mx_rec_acr_university" => $empacruniversity,
                "mx_rec_acr_marks" => $empacrmarks,
                "mx_rec_acr_modifyby" => $this->session->userdata('user_id'),
                "mx_rec_acr_modifiedtime" => $date,
                "mx_rec_acr_modified_ip" => $ip,
            );
                $this->db->where('mx_rec_acr_id', $empacruniqid);
                $this->db->where('mx_rec_acr_application_id', $newemployeeid);
                $this->db->update('maxwell_recruitment_academic_records', $uparrayacr);
            $acr++;
        }
    }
    // Academic Records
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
}

public function updaterecruitmentfamily($data){
// Family Information     
$this->db->trans_begin();   
    if (count($data['empfmrelation']) > 0 && !empty($data['empfmrelation'])) {
        for ($i = 0; $i < count($data['empfmrelation']); $i++) {
            $empfmrelation = $this->cleanInput($data['empfmrelation'][$i]);
            $empfmname = $this->cleanInput($data['empfmname'][$i]);
            $empfmage = $this->cleanInput($data['empfmage'][$i]);
            $empfmoccupation = $this->cleanInput($data['empfmoccupation'][$i]);
            $newemployeeid = $this->cleanInput($data['empafmemployeeid'][$i]);
            $empafmuniqid = $this->cleanInput($data['empafmuniqid'][$i]);
            $ip = $this->get_client_ip();
            $date = date('Y-m-d H:i:s');
            $uparrayfm = array(
                "mx_rec_fm_relation" => $empfmrelation,
                "mx_rec_fm_name" => $empfmname,
                "mx_rec_fm_age" => $empfmage,
                "mx_rec_fm_occupation" => $empfmoccupation,
                "mx_rec_fm_modifyby" => $this->session->userdata('user_id'),
                "mx_rec_fm_modifiedtime" => $date,
                "mx_rec_fm_modified_ip" => $ip,
            );
                $this->db->where('mx_rec_fm_id', $empafmuniqid);
                $this->db->where('mx_rec_fm_application_id', $newemployeeid);
                $this->db->update('maxwell_recruitment_family', $uparrayfm);
        }
    }
    // Family Information
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
}

public function updatepreviousrecruitment($data){
$this->db->trans_begin();
// Previous Employment
    if (count($data['emppreviousprediofromto']) > 0 && !empty($data['emppreviousprediofromto'])) {
        for ($i = 0; $i < count($data['emppreviousprediofromto']); $i++) {
            $emppreviousprediofromto = $this->cleanInput($data['emppreviousprediofromto'][$i]);
            $emppreviousorgnation = $this->cleanInput($data['emppreviousorgnation'][$i]);
            $emppreviousdesgjointime = $this->cleanInput($data['emppreviousdesgjointime'][$i]);
            $emppreviousleavingtime = $this->cleanInput($data['emppreviousleavingtime'][$i]);
            $emppreviousreportedto = $this->cleanInput($data['emppreviousreportedto'][$i]);
            $empprevioussalarypermonth = $this->cleanInput($data['empprevioussalarypermonth'][$i]);
            $emppreviousotherbenfits = $this->cleanInput($data['emppreviousotherbenfits'][$i]);
            $emppreviousreasonchange = $this->cleanInput($data['emppreviousreasonchange'][$i]);
            $newemployeeid = $this->cleanInput($data['empapreemployeeid'][$i]);
            $empapeuniqid = $this->cleanInput($data['emppreuniqid'][$i]);
            $ip = $this->get_client_ip();
            $date = date('Y-m-d H:i:s');
            $uparraype = array(
                "mx_rec_pe_periodfromto" => $emppreviousprediofromto,
                "mx_rec_pe_nameandorg" => $emppreviousorgnation,
                "mx_rec_pe_desgjointime" => $emppreviousdesgjointime,
                "mx_rec_pe_desgleavingtime" => $emppreviousleavingtime,
                "mx_rec_pe_desgreportedto" => $emppreviousreportedto,
                "mx_rec_pe_monthlysalary" => $empprevioussalarypermonth,
                "mx_rec_pe_otherbenfits" => $emppreviousotherbenfits,
                "mx_rec_pe_reasonforchange" => $emppreviousreasonchange,
                "mx_rec_pe_modifyby" => $this->session->userdata('user_id'),
                "mx_rec_pe_modifiedtime" => $date,
                "mx_rec_pe_modified_ip" => $ip,
            );
                $this->db->where('mx_rec_pe_id', $empapeuniqid);
                $this->db->where('mx_rec_pe_application_id', $newemployeeid);
                $this->db->update('maxwell_recruitment_previous_employments', $uparraype);
        }
    }

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
}

public function updaterefrences($data){
$this->db->trans_begin();
// Employee Refrence
            $refrencecmptype = $this->cleanInput($data['refrencecmptype']);
            if($refrencecmptype == 'NAUKRI' || $refrencecmptype == 'LINKEDIN'){
            $refrencename = $this->cleanInput($data['refrencename_website']);
            }elseif($refrencecmptype == 'MAXWELL'){
                $ref = $this->cleanInput($data['refrencename_maxwell']);
                if(!empty($ref)){
                $interviewer = str_replace("_", " ", $ref);
                $extract = explode("~@~", $interviewer);
                $employeeid = $this->cleanInput($extract[0]);
                $refrencename = $this->cleanInput($extract[1]);
                }else{
                $employeeid = '';
                $refrencename = '';
                }
            }else{
            $refrencename = $this->cleanInput($data['refrencename']);
            }

            $refrencenwcnd = $this->cleanInput($data['refrencenwcnd']);
            $refrencemobile = $this->cleanInput($data['refrencemobile']);
            $newemployeeid = $this->cleanInput($data['emprfemployeeid']);
            $emprfuniqid = $this->cleanInput($data['emprfuniqid']);
            $refrencebranch = $this->cleanInput($data['refrencebranch']);
            $refrencewebsite_type = $this->cleanInput($data['refrencewebsite_type']);
            $ip = $this->get_client_ip();
            $date = date('Y-m-d H:i:s');
            $uparrayrf = array(
                "mx_rec_refrence_type" => $refrencecmptype,
                "mx_rec_refrence_name" => $refrencename,
                "mx_rec_refrence_relation" => $refrencenwcnd,
                "mx_rec_refrence_mobile" => $refrencemobile,
                "refrencebranch" => $refrencebranch,
                "refrencewebsite_type" => $refrencewebsite_type,
                "refrence_employee_code" => $employeeid,
                "mx_modifyby" => $this->session->userdata('user_id'),
                "mx_modifiedtime" => $date,
                "mx_modified_ip" => $ip,
            );
                $this->db->where('mx_rec_autouniqueid', $emprfuniqid);
                $this->db->where('mx_rec_application', $newemployeeid);
                $this->db->update('maxwell_recruitment_info', $uparrayrf);
    // Employee Refrence
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
}


public function updateaddress($data){
    // print_r($data); die;
    $newemployeeid = $this->cleanInput($data['employeeidaddress']);
    $uniqueidaddress = $this->cleanInput($data['uniqueidaddress']);
    // Address
    $emppreaddress1 = $this->cleanInput($data['emppreaddress1']);
    $emppreaddress2 = $this->cleanInput($data['emppreaddress2']);
    $empprecity = $this->cleanInput($data['empprecity']);
    $empprestate = $this->cleanInput($data['empprestate']);
    $empprecountry = $this->cleanInput($data['empprecountry']);
    $empprepostalcode = $this->cleanInput($data['empprepostalcode']);
    $emppresince = $this->cleanInput($data['emppresince']);
    $empfixedaddress1 = $this->cleanInput($data['empfixedaddress1']);
    $empfixedaddress2 = $this->cleanInput($data['empfixedaddress2']);
    $empfixedcity = $this->cleanInput($data['empfixedcity']);
    $empfixedstate = $this->cleanInput($data['empfixedstate']);
    $empfixedcountry = $this->cleanInput($data['empfixedcountry']);
    $empfixedpostalcode = $this->cleanInput($data['empfixedpostalcode']);
    $empfixedpresince = $this->cleanInput($data['empfixedpresince']);
    // Address    
    $ip = $this->get_client_ip();
    $date = date('Y-m-d H:i:s');
    $uparray = array(
        "mx_rec_present_address1" => $emppreaddress1,
        "mx_rec_present_address2" => $emppreaddress2,
        "mx_rec_present_city" => $empprecity,
        "mx_rec_present_state" => $empprestate,
        "mx_rec_present_country" => $empprecountry,
        "mx_rec_present_postalcode" => $empprepostalcode,
        "mx_rec_present_since" => $emppresince,
        "mx_rec_fixed_address1" => $empfixedaddress1,
        "mx_rec_fixed_address2" => $empfixedaddress2,
        "mx_rec_fixed_city" => $empfixedcity,
        "mx_rec_fixed_state" => $empfixedstate,
        "mx_rec_fixed_country" => $empfixedcountry,
        "mx_rec_fixed_postalcode" => $empfixedpostalcode,
        "mx_rec_fixed_present_since" => $empfixedpresince,
        "mx_modifyby" => $this->session->userdata('user_id'),
        "mx_modifiedtime" => $date,
        "mx_modified_ip" => $ip,
    );
    $this->db->where('mx_rec_autouniqueid', $uniqueidaddress);
    $this->db->where('mx_rec_application', $newemployeeid);
    $this->db->update('maxwell_recruitment_info', $uparray);
    // echo $this->db->last_query(); die;

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 2;
    } else {
        $this->db->trans_commit();
        return 1;
    }
}

public function getdepartmentdetails()
{
    $this->db->select('mxdpt_id,mxdpt_name');
    $this->db->from('maxwell_department_master');
    $this->db->where('mxdpt_status = 1');
    $query = $this->db->get();
    $qry = $query->result();
    return $qry;
}

//--------------------------- end added 5-07-2021 ------------

    public function createlettersdata($userdata = array()){
        $this->db->select('*');
        $this->db->from('maxwell_letters');
        if(!empty($userdata['fromdatefilter']) && !empty($userdata['todatefilter'])){
            $fromdate = date('Y-m-d',strtotime($userdata['fromdatefilter']));
            $todate = date('Y-m-d',strtotime($userdata['todatefilter']));
            $this->db->where('createdtime >=',$fromdate.' 00:00:00');
            $this->db->where('createdtime <=',$todate.' 23:59:59');
        }
        if(!empty($userdata['typeofletterfilter'])){
            $this->db->where('typeofletter',$userdata['typeofletterfilter']);
        }
        if(!empty($userdata['letter_statusfilter'])){
            $this->db->where('letter_status',$userdata['letter_statusfilter']);
        }
        $query2 = $this->db->get();
        $qry['emailstemplates'] = $query2->result();
        return $qry;
    }

    public function getdesignationdetails(){
        $this->db->select('mxdesg_name');
        $this->db->from('maxwell_designation_master');
        $this->db->where('mxdesg_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }
    
    public function getbranchdetails($data = array()){
        $this->db->select('mxb_name,mxb_address');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        if(!empty($data['branchname'])){
          $this->db->where('mxb_name',$data['branchname']);  
        }
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

    public function getlettersdata($data){
        $id = $data['id'];
        $this->db->select('*');
        $this->db->from('maxwell_letters');
        $this->db->where('id',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $qry = $query->result();
    }
    
    public function getassignedtemplates(){
        $this->db->select('*');
        $this->db->from('maxwell_email_templates');
        $this->db->where('showinletters = 1');
        $this->db->where('email_status = 1');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $qry = $query->result();
    }
    
    

    public function saveletters($data){
        // print_r($data);exit;
        $id = $data['id'];
        $inarray = array(
            "letter_status" => $this->cleanInput($data['letter_status']),
            "typeofletter" => $this->cleanInput($data['typeofletter']),
            "personname" => $this->cleanInput($data['personname']),
            "address" => $data['desc'],
            "letterno" => $this->cleanInput($data['letterno']),
            "appdate" => $this->cleanInput($data['appdate']),
            "effectivedate" => $this->cleanInput($data['effectivedate']),
            "designation" => $this->cleanInput($data['designation']),
            "placeofposting" => $this->cleanInput($data['placeofposting']),
            "salary" => $this->cleanInput($data['salary']),
            "basic" => $this->cleanInput($data['basic']),
            "hra" => $this->cleanInput($data['hra']),
            "pdfdata" => $data['pdfdata'],
            "templateid" => $this->cleanInput($data['templateid']),
            "employeecode" => $this->cleanInput($data['employeecode']),
            "interviewdate" => $this->cleanInput($data['interviewdate']),
            "branch" => $this->cleanInput($data['branch']),
            "department" => $this->cleanInput($data['department']),
            "reportingto" => $this->cleanInput($data['reportingto']),
            "branchaddress" =>$data['bdesc'],
        );
        if(empty($id)){
            $inarray["createdby"] = $this->session->userdata('user_name');
            $inarray["createdtime"] = DBDT;
            $inarray["created_ip"] = IP;
            $this->db->insert('maxwell_letters', $inarray);
            echo json_encode(array('respone' => 200)); die();
        }else{
            $inarray["modifyby"] = $this->session->userdata('user_name');
            $inarray["modifiedtime"] = DBDT;
            $inarray["modified_ip"] = IP;
            $this->db->where('id', $id);
            $this->db->update('maxwell_letters', $inarray);
            echo json_encode(array('respone' => 200)); die();
        }
        echo json_encode(array('respone' => 400)); die();
    }

    public function deletelettersinfobyid($data){
        $id = $data['id'];
        $status = $data['status'];
        if($status == 'Activate'){
            $acstatus = 1;
        }else{
            $acstatus = 0;
        }
        $uparray = array("lt_status" => $acstatus);
        $this->db->where('id', $id);
        $res = $this->db->update('maxwell_letters', $uparray);
        if($res == 1){
            echo json_encode(array('respone' => 200)); die();
        }else{
            echo json_encode(array('respone' => 400)); die();
        }
    }

    public function getsubscriptiondetails_list($data){
        $type = $data['type'];
        $currentlocation = trim($data['currentlocation']);
        $preferredlocation = trim($data['preferredlocation']);
        $this->db->select('*');
        $this->db->from('subscriptions');
        if($type !='All'){
        $this->db->where('type',$type);
        }
        if(!empty($currentlocation)){
        $this->db->where('currentlocation',$currentlocation);
        }
        if(!empty($preferredlocation)){
        $this->db->where('preferredlocation',$preferredlocation);
        }
        $this->db->where('email !=""');
        $this->db->where('mobile !=""');
        $this->db->order_by('createddate', 'desc');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $qry = $query->result();
    }

    public function delete_subscription_details($data){
        $id = $data['id'];
        $this->db->where('id', $id);
        return $this->db->delete('subscriptions');
    }
    
    public function getsubscriptiondetails($data){
        $type = $data['type'];
        $templateid = $data['templateid'];
        $currentlocation = trim($data['currentlocation']);
        $preferredlocation = trim($data['preferredlocation']);
        $this->db->select('id,email_title,email_subject,email_body');
        $this->db->from('maxwell_email_templates');
        $this->db->where('email_status', '1');
        $this->db->where('id', $templateid);
        $query = $this->db->get(); 
        $qry['template'] = $query->result();
        
        $this->db->select('type,email,mobile,name,currentlocation,preferredlocation,currentcompany');
        $this->db->from('subscriptions');
        $this->db->where('type',$type);
        if(!empty($currentlocation)){
        $this->db->where('currentlocation',$currentlocation);
        }
        if(!empty($preferredlocation)){
        $this->db->where('preferredlocation',$preferredlocation);
        }
        $this->db->where("email !=''");
        $this->db->where("mobile !=''");
        $this->db->order_by('createddate', 'desc');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry['mails'] = $query->result();
        
        
        $this->db->select('currentlocation');
        $this->db->from('subscriptions');
        $this->db->where('type',$type);
        $this->db->where('email !=""');
        $this->db->where('mobile !=""');
        $this->db->where('currentlocation !=""');
        $query = $this->db->get();
        $qry['currentlocation'] = $query->result();
        
        $this->db->select('preferredlocation');
        $this->db->from('subscriptions');
        $this->db->where('type',$type);
        $this->db->where('email !=""');
        $this->db->where('mobile !=""');
        $this->db->where('preferredlocation !=""');
        $query = $this->db->get();
        $qry['preferredlocation'] = $query->result();
        
        return $qry;
    }
    
    public function gettemplateid($data){
        $templateid = $data['templateid'];
        $this->db->select('id,email_title,email_subject,email_body');
        $this->db->from('maxwell_email_templates');
        $this->db->where('email_status', '1');
        $this->db->where('id', $templateid);
        $query = $this->db->get();
       return $qry['template'] = $query->result();
    }
    
    public function getsubscurrentlocation($data){
        $type = $data['type'];
        $this->db->select('currentlocation');
        $this->db->from('subscriptions');
        $this->db->where('type',$type);
        $this->db->where('email !=""');
        $this->db->where('mobile !=""');
        $this->db->where('currentlocation !=""');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getsubspreferredlocation($data){
        $type = $data['type'];
        $this->db->select('preferredlocation');
        $this->db->from('subscriptions');
        $this->db->where('type',$type);
        $this->db->where('email !=""');
        $this->db->where('mobile !=""');
        $this->db->where('preferredlocation !=""');
        $query = $this->db->get();
        return $query->result();
    }

}