<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';

class Reports extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel'); 
        $this->load->model('Reports_model'); 
    }
	
    public function index(){
	
    }
    
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

public function appoinment(){

    $this->load->helper('pdf_helper');
    //$data['payslippdf'] = $this->Adminmodel->payslippdf($empid);
    //$this->load->view('pdfreport', $data);
    $this->load->view('reports/pdfreport');

}

public function offerletter(){
    $this->load->helper('pdf_helper');
    //$data['payslippdf'] = $this->Adminmodel->payslippdf($empid);
    //$this->load->view('pdfreport', $data);
    $this->load->view('reports/offerpdfreport');

}

public function appointmentletter(){
    $this->load->helper('pdf_helper');
    //$data['payslippdf'] = $this->Adminmodel->payslippdf($empid);
    //$this->load->view('pdfreport', $data);
    $this->load->view('reports/appointmentpdf');

}

public function viewqrcode(){
    ob_start();
    $this->load->helper('pdf_helper');
    $userdata = $this->input->get();
    $data['response'] = $this->Adminmodel->processqrcode($userdata);
    $this->load->view('qrcode_generator/qrcode_pdf',$data);

}



// ------------------ added 26-02-2023------------------

public function createmailtemplate(){
    $this->verifylogin();
    $this->header();
    $data['list'] = $this->Reports_model->createemailtemplate();
    $data['divisionjob'] = array("1" => "LOGISTICS", "2" => "RELOCATION");
    $this->load->view('cms/create_email_template',$data);
    $this->footer();
}

public function getemailtemplate(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $data['list'] = $this->Reports_model->getemailtemplate($userdata);
    $data['divisionjob'] = array("1" => "LOGISTICS", "2" => "RELOCATION");
    $this->load->view('cms/emailtemplatepopup',$data);
}

public function saveemailtemplate(){
    $this->verifylogin();
    $this->header();
    $userdata = $this->input->post();
    $res = $this->Reports_model->saveemailtemplate($userdata);
}

public function deleteemailtemplateinfobyid(){
    $this->verifylogin();
    $this->header();
    $userdata = $this->input->post();
    $res = $this->Reports_model->deleteemailtemplateinfobyid($userdata);
}

public function sendemailstoclients(){
    $this->verifylogin();
    $this->header();
    $data['list'] = $this->Reports_model->getallemailtemplate();
    $this->load->view('cms/sendemailstoclients',$data);
    $this->footer();
}


public function getemailtemplatesbyid(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Reports_model->getemailtemplatebyid($userdata);
    if($res !=''){
        echo json_encode($res);
    }
}


public function sendcustomemailswithpdf(){
    $this->verifylogin();
    $userdata = $this->input->post();
        $data['userinfo'] = $userdata;
        $this->load->helper('pdf_helper');
        $folder = "uploads/sentdocmails/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $filename = rand();
        $ave = ROOTDOCUMENT.$folder.$filename.'.pdf';
        $data['ave'] = $ave;
        $data['viewlist'] = $this->Reports_model->viewbyid($userdata);
        $this->load->view('cms/savepdf',$data);
        
    #bulid mail formate
    $tos = array();
    $ccs = array();
    $bccs = array();
    $attachments = array();
    $to = explode(",", $userdata['to']);
    foreach ($to as $key => $tval) {
        array_push($tos, $tval);
    }

    $cc = explode(",", $userdata['cc']);
    foreach ($cc as $key => $cval) {
        array_push($ccs, $cval);
    }

    $bcc = explode(",", $userdata['bcc']);
    foreach ($bcc as $key => $bcval) {
        array_push($bccs, $bcval);
    }
    if(file_exists($ave)){
    $attachments = array($ave);
    }
    $senddata = array(
        "type" => 'Mails',
        // "id" => $userdata['templates'],
        "templates" => $userdata['templates'],
        'to' => $tos,
        'cc' => $ccs,
        'bcc' => $bccs,
        'subject' => $userdata['subject'],
        'body' => $userdata['mdesc'],
        'attachments' => $attachments,
        'createdby' => $this->session->userdata('user_name'),
        'createdempcode' => $this->session->userdata('user_id'),
    );
    sendmails($senddata);
    #build mail fromate
}

public function viewpdf(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $data['userinfo'] = $userdata;
    $this->load->helper('pdf_helper');
    $this->load->view('cms/viewpdf',$data);
}


}
