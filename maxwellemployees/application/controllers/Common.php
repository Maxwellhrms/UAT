<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once APPPATH. 'libraries/PHPMailer/src/Exception.php';
require_once APPPATH. 'libraries/PHPMailer/src/PHPMailer.php';
require_once APPPATH. 'libraries/PHPMailer/src/SMTP.php';

class Common extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CommonModel');
    }

    public function checkissession(){
        if (empty($this->session->userdata('is_session_active'))){
            redirect(base_url() . 'Common/logout');die();
        }
    }

    public function verifylogin(){
        if (empty($this->session->userdata('is_session_active'))){
            redirect(base_url() . 'Common/logout');die();
        }else{
            $user_id = $this->session->userdata('session_loginperson_id');
            redirect(base_url().'Employee/employeedashboard');exit(); 
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());die();
    }

    public function header($data = array()){
        $this->load->view('common/header',$data);
        if($data['is_policy'] <= 0){
            $this->sidemenu();
        }
        
    }

    public function footer($data = array()){
        $data['data'] = $page;
        $this->load->view('common/footer',$data);
    }

    public function sidemenu($data = array()){
         $this->load->view('common/sidemenu',$data);
    }
    # Start filter dropdown

    public function commonFiltersForm($data = array()){
        $data['selectedFilter'] = $data;
        $data['companyFilter'] = $this->CommonModel->getCompanyfilter();
        if($data['customvalue']!= ''){
            $data['customOptions'] = $this->CommonModel->displayOptions($data);
        }
        $this->load->view('common/commonfiltersform',$data);
    }

    public function commonFiltersWithoutForm($data = array()){
        $data['selectedFilter'] = $data;
        $data['companyFilter'] = $this->CommonModel->getCompanyfilter();
        $data['assignedemployees'] = $this->CommonModel->getEmployeesWhoAreAssignToAuthorsations($reporting_head_emp_code = '');
        $data['appraisalemployees'] = $this->CommonModel->getAssignedAppraisalEmployees($employeeid = '');
        if($data['customvalue']!= ''){
            $data['customOptions'] = $this->CommonModel->displayOptions($data);
        }
        $this->load->view('common/commonfilterswithoutform',$data);
    }

    public function display_options($filedname,$selected = ''){
        $data = $this->CommonModel->displayOptions($filedname);
        $def = '<option value="">Select</option>';
        foreach ($data as $key => $value) {
            if($selected == $value->field_value){
                $sel = 'selected';
            }else{
                $sel = '';
            }
            $def .= "<option value=".$value->field_value."  ".$sel.">".$value->descr."</option>";
        }
        return $def;
    }


    public function getgrade(){
        $cmid = $this->input->post('companyid');
        $data = $this->CommonModel->grademaster($cmid);
        $def = '<option value="">Select Grades</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxgrd_id.">".$value->mxgrd_name."</option>";
        }
        echo $def;   
    }

    public function getdivisions_based_on_branch_master(){
        //            print_r($_REQUEST);exit;
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }

        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        //            echo $div_id;exit;
        $data = $this->CommonModel->getdivisions_based_on_branch_master($comp_id, $type);
        if (isset($_REQUEST['comp_id'])) {
            echo json_encode($data);
        } else {
            return $data;
        }
        //            print_r($data);
        //            exit;
    }

    public function getemployeetypemasterdetails(){
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        } else {
            $id = null;
        }
        if (isset($_REQUEST['cmp_id'])) {
            $cmp_id = $_REQUEST['cmp_id'];
        } else {
            $cmp_id = null;
        }
        $emp_type_data = $this->CommonModel->getemployeetypemasterdetails($id, $cmp_id);
        echo json_encode($emp_type_data);
    }

    public function getstates_based_on_branch_master(){
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }
        if (isset($_REQUEST['div_id'])) {
            $div_id = $_REQUEST['div_id'];
        } else {
            $div_id = null;
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        //            echo $type;exit;
        $data = $this->CommonModel->getstates_based_on_branch_master($comp_id, $div_id, $type);
        if (isset($_REQUEST['comp_id'])) {
            echo json_encode($data);
        } else {
            return $data;
        }
        //            print_r($data);
        //            exit;
    }

    public function getbranches_based_on_eligibility_state_wise(){
        //print_r($_REQUEST);
        if (isset($_REQUEST['comp_id'])) {
            $comp_id = $_REQUEST['comp_id'];
        } else {
            $comp_id = null;
        }
        if (isset($_REQUEST['div_id'])) {
            $div_id = $_REQUEST['div_id'];
        } else {
            $div_id = null;
        }
        if (isset($_REQUEST['state_id'])) {
            $state_id = $_REQUEST['state_id'];
        } else {
            $state_id = null;
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }
        if (isset($_REQUEST['is_headoffice'])) {
            $is_headoffice = $_REQUEST['is_headoffice'];
        } else {
            $is_headoffice = null;
        }
        //            echo $state_id.$type;exit;
        $data = $this->CommonModel->getbranches_based_on_eligibility_state_wise($comp_id, $div_id, $state_id, $type, $is_headoffice);
        // if (isset($_REQUEST['state_id'])) {
        echo json_encode($data);
        // } else {
        //      return $data;
        // }
    }
    # End filter dropdown

    public function sendmails($data){
        $configinfo = $this->CommonModel->getemailconfig($data);
        if(count($configinfo) <= 0){
            echo 'please check the mail server';exit;
        }
        
        if(count($data['to']) <= 0){
            $recipient_to = array(); 
        }else{
            $recipient_to = $data['to'];
        }

        if(count($data['cc']) <= 0){
           $recipient_cc = array();
        }else{
            $recipient_cc = $data['cc'];
        }

        if(count($data['bcc']) <= 0){
            $recipient_bcc = array();
        }else{
            $recipient_bcc = $data['bcc'];
        }

        if(count($data['attachments']) <= 0){
            $att = array(); 
        }else{
            $att = $data['attachments'];
        }
        // $recipient_bcc[] = 'developerhkumar@gmail.com';
        // print_r($recipient_bcc);
        // exit;
        #$recipient_name = array('Harish Kumar');

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $configinfo[0]->email_host_url;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $configinfo[0]->email_username;                     //SMTP username
            $mail->Password   = $configinfo[0]->email_password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $configinfo[0]->email_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('developerhkumar@gmail.com', 'Workboard');
            #$mail->addAddress($recipient_to, $recipient_name);     //Add a recipient
            foreach ($recipient_to as $recptokey => $allrecipient) {
                if(!empty($allrecipient)){
                $mail->addAddress($allrecipient);               //Name is optional
                }
            }
            $mail->addReplyTo('developerhkumar@gmail.com', 'Workboard');

            foreach ($recipient_cc as $recpcckey => $ccrecipient) {
                if(!empty($ccrecipient)){
                $mail->addCC($ccrecipient);
                }
            }
            foreach ($recipient_bcc as $recpbcckey => $bccrecipient) {
                if(!empty($bccrecipient)){
                $mail->addBCC($bccrecipient);
                }
            }
            // print_r($mail);exit;
            //Attachments
            foreach ($att as $attkey => $attval) {
               $mail->addAttachment($attval);         //Add attachments
            }
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['body'];

            $res = $mail->send();
            if($res == 1){
                $this->CommonModel->mail_log($data,$res);
                echo json_encode(array('respone' => 200)); die();
            }else{
                $this->CommonModel->mail_log($data,$res);
                echo json_encode(array('respone' => 400)); die();
            }
        } catch (Exception $e) {
            $res = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $this->CommonModel->mail_log($data,$res);
            echo json_encode(array('respone' => 400)); die();
        }
    }

}
