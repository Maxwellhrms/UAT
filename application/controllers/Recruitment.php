<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Recruitment extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Recruitmentmodel');
        $this->load->model('Adminmodel');      
    }
    
        public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function index(){
        $this->verifylogin();
		$this->header();
        $data['jobsdata'] = $this->Recruitmentmodel->getaddedjobs($id ="");
         //--------------- added c 5-7-2021 --------------
        $data['deprtjob'] = $this->Recruitmentmodel->getdepartmentdetails();
        $data['jobtp'] = array('Full Time'=>'Full Time','Part Time'=>'Part Time','Internship'=>'Internship','Temporary'=>'Temporary','Remote'=>'Remote','Others'=>'Others');
        //$data['deprtjob'] = array( 'Web Development'=>'Web Development', 'Application Development'=>'Application Development', 'IT Management'=>'IT Management' ,'Accounts Management'=>'Accounts Management','Support Management'=>'Support Management','Marketing'=>'Marketing');
        $data['status'] = array( 'Open'=>'Open','Closed'=>'Closed', 'Cancelled'=>'Cancelled');
        $data['divisionjob'] = array("1" => "LOGISTICS", "2" => "RELOCATION");
       //--------------- added c 5-7-2021 --------------
        $data['todaysdata'] = $this->Recruitmentmodel->todaysappliedcount();
		$this->load->view('recruitment/managejobs',$data);
		$this->footer();
    }

    public function saverecruitmentmanage(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->saverecruitmentmodel($userdata);
        if($res == 1){
            echo 200; exit;
        }else{
            echo 500; exit;
        }
    }

    public function viewjobdetails(){
        $this->verifylogin();
        $this->header();
        $id = $this->uri->segment(3);
        $data['jobsdata'] = $this->Recruitmentmodel->getaddedjobs($id);
        //--------------- added c 5-7-2021 --------------
        $data['deprtjob'] = $this->Recruitmentmodel->getdepartmentdetails();
        $data['jobtp'] = array('Full Time'=>'Full Time','Part Time'=>'Part Time','Internship'=>'Internship','Temporary'=>'Temporary','Remote'=>'Remote','Others'=>'Others');
        //$data['deprtjob'] = array( 'Web Development'=>'Web Development', 'Application Development'=>'Application Development', 'IT Management'=>'IT Management' ,'Accounts Management'=>'Accounts Management','Support Management'=>'Support Management','Marketing'=>'Marketing');
        $data['status'] = array( 'Open'=>'Open','Closed'=>'Closed', 'Cancelled'=>'Cancelled');
        $data['divisionjob'] = array("1" => "LOGISTICS", "2" => "RELOCATION");
       //--------------- added c 5-7-2021 --------------
       
        $this->load->view('recruitment/jobdetails',$data);
        $this->footer();
    }

    public function updaterevalentstatus(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->updaterevalentstatus($userdata);
        if($res == 1){
            echo '200'; exit;
        }else{
            echo '500'; exit;
        }
    }
    
    public function deleteappliedjobstatus(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->deleteappliedjobstatus($userdata);
        if($res == 1){
            echo '200'; exit;
        }else{
            echo '500'; exit;
        }
    }

    public function appliedjobsreviewed(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->appliedjobsreviewed($userdata);
        if($res == 1){
            echo '200'; exit;
        }else{
            echo '500'; exit;
        }
    }


    public function editjobmangedetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->editjobmangedetails($userdata);
        if($res == 1){
            echo 200; exit;
        }else{
            echo 500; exit;
        }

    }


    public function appliedcanditates(){
        $this->verifylogin();
		$this->header();
		$id = $this->uri->segment(3);
        $data['applied'] = $this->Recruitmentmodel->getappliedcandidateslist($id);
		$this->load->view('recruitment/jobsapplied',$data);
		$this->footer();
    }


// -----------------------------------

public function addrecruitmentdetails(){
    $this->verifylogin();
    $this->header();
    $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
    $data['states'] = $this->Adminmodel->getstates_master();
    $data['countrymaster'] = $this->Adminmodel->getcountry_master();
    $data['language'] = $this->Adminmodel->getlanguage_master();
    $data['emptype'] = $this->Adminmodel->getemployeetypemaster();
    $data['designationdetails'] = $this->Adminmodel->getdesignationdetails($id = '');
    $data['allemployeedetails'] = $this->Recruitmentmodel->getallemployeesinemployeetable();
    $data['controller'] = $this;
    $this->load->view('recruitment/addrecruitmentdetails',$data);
    $this->footer();
}

public function saveaddrecruitmentdetails(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->saveaddrecruimentdata($userdata);
    if($res == 1){
        echo '200'; exit;
    }else{
        echo '500'; exit;
    }
}


public function viewrecruitmentdetails(){
    $this->verifylogin();
    $this->header();
    $userdata = $this->input->post(); 
    if(!empty($userdata)){
        $userdata = $this->input->post(); 
    }else{
        $date = date('Y-m-d');
        $userdata = array('fromdate'=> $date,'todate'=> $date);
    }
    $data['info'] = $this->Recruitmentmodel->getrecurimentsavedinfo($userdata);
    $data['portalscount'] = $this->Recruitmentmodel->portalscount($userdata);
    $data['userinfo'] = $userdata;
    $data['controller'] = $this;
    $this->load->view('recruitment/viewrecruitmentdetails',$data);
    $this->footer();	
}

public function recruitmentprocess(){
    $this->verifylogin();
    $this->header();
    $id = $this->uri->segment(3);
    $data['rcinfo'] = $this->Recruitmentmodel->recruitmentprocess($id);
    $data['resumedetails'] = $this->Recruitmentmodel->recruitmentprocessdetails($userdata = '', $id);
    $data['divisions'] = $this->getdivision($data['rcinfo'][0]->mx_rec_comp_code);
    $data['allemployeedetails'] = $this->Recruitmentmodel->getallemployeesinemployeetable();
    $data['controller'] = $this;
    $this->load->view('recruitment/recruitmentprocess', $data);
    $this->footer();       
}


public function getintreviewprocessdetails(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $data['review'] = $this->Recruitmentmodel->recruitmentprocessdetails($userdata, $id = '');
    $this->load->view('recruitment/viewrecruitmentreviewscreen',$data);
}

public function saverecruitmentprocess(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->saverecruitmentprocess($userdata);
    if($res == '1'){
        echo '200';
    }else{
        echo '500';
    }
}

public function updaterecruitmentreview(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updaterecruitmentreview($userdata);
    if($res == '1'){
        echo '200';
    }else{
        echo '500';
    }
}

public function getdivision($cmp = ''){
    $this->verifylogin();
    if(empty($cmp)){
        $cmid = $this->input->post('companyid');
    }else{
        $cmid = $cmp;
    }
    return $data = $this->Recruitmentmodel->divisionmaster($cmid);
}

public function getbranch(){
    $this->verifylogin();
    $divid = $this->input->post('divisionid');
    $data = $this->Recruitmentmodel->branchmaster($divid);
    $def = '<option value="">Select Branch</option>';
    foreach ($data as $key => $value) {
        $def .= "<option value=".$value->mxb_id." >".$value->mxb_name."</option>";
    }
    echo $def;
}

public function getrecemployees(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $data = $this->Recruitmentmodel->getrecemployees($userdata);
    $def = '<option value="">Select Employee</option>';
    foreach ($data as $key => $value) {
        $name = $value->mxemp_emp_fname .' '. $value->mxemp_emp_lname;
        $def .= "<option value=".$value->mxemp_emp_id. '~@~' . str_replace(" ", "_", $name)." >".$name.' ('.$value->mxemp_emp_id.')'."</option>";
    }
    echo $def;
}

// --------------------- 5-7-2021 -------------------

public function editrecruitmentdetails(){
    $this->verifylogin();
    $this->header();
    $id = $this->uri->segment(3);
    $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
    $data['states'] = $this->Adminmodel->getstates_master();
    $data['countrymaster'] = $this->Adminmodel->getcountry_master();
    $data['language'] = $this->Adminmodel->getlanguage_master();
    $data['emptype'] = $this->Adminmodel->getemployeetypemaster();
    $data['branchid'] = $this->Adminmodel->getbranch_master();
    $data['rec'] = $this->Recruitmentmodel->getemployeecompletedetails($id);
    $data['relation'] = array( 'Father'=>'Father', 'Mother'=>'Mother', 'Brother'=>'Brother' ,'Sister'=>'Sister','Husband'=>'Husband','Wife'=>'Wife','Children'=>'Children' );
    $data['cmptypeval'] = array('MAXWELL'=>'MAXWELL','ARC'=>'ARC','OTHERS'=>'OTHERS');
    $data['academy'] = array('General' => 'General','Professional' => 'Professional','NON Mertic' => 'NON Mertic','Mertic' => 'Mertic','SSC' => 'SSC','Inter' => 'Inter','Degree' => 'Degree','Diploma' => 'Diploma','PHD' => 'PHD','Senior Secondary' => 'Senior Secondary');
    $data['reftyp'] = array('MAXWELL'=>'MAXWELL','ARC'=>'ARC','WEBSITES'=>'WEBSITES','NAUKRI'=>'NAUKRI','WALKIN'=>'WALKIN','JOBPORTAL'=>'JOB PORTAL','OTHERS'=>'OTHERS');
    $data['allemployeedetails'] = $this->Recruitmentmodel->getallemployeesinemployeetable();
    $data['controller'] = $this;
    $this->load->view('recruitment/editrecruitmentdetails',$data);
    $this->footer();	
}

public function responsemsg($res){
    if($res == 1){
        return '200';
    }else{
        return '500';
    }
}

public function updatepersonaldeatils(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updatepersonaldeatils($userdata);
    echo $this->responsemsg($res);
}

public function updaterecruitmentacademicdetails(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updaterecruitmentacademicdetails($userdata);
    echo $this->responsemsg($res);
}

public function updaterecruitmentfamily(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updaterecruitmentfamily($userdata);	
    echo $this->responsemsg($res);
}

public function updatepreviousrecruitment(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updatepreviousrecruitment($userdata);	
    echo $this->responsemsg($res);
}

public function updaterefrences(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updaterefrences($userdata);	
    echo $this->responsemsg($res);
}

public function updateaddress(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->updateaddress($userdata);	
    echo $this->responsemsg($res);

}

//-------------------5-7-2021 ---------------------

public function creatletters(){
    $this->verifylogin();
    $this->header();
    $type = array('1'=>'Appoinment','2'=>'Manager Appoinment','3'=>'Offer Letter','4'=>'Confirmation Letter');
    $app_status = array('1'=>'Issued','2'=>'Joined','3'=>'Rejected','4'=>'Confirmed');
    $data['type'] = $type;
    $data['app_status'] = $app_status;
    $data['des'] = $this->Recruitmentmodel->getdesignationdetails();
    $data['branch'] = $this->Recruitmentmodel->getbranchdetails();
    $data['dep'] = $this->Recruitmentmodel->getdepartmentdetails();
    // $data['list'] = $this->Recruitmentmodel->createlettersdata();
    $this->load->view('letters/commonlettersfmlst',$data);
    $this->footer();
}

public function letterlists(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $type = array('1'=>'Appoinment','2'=>'Manager Appoinment','3'=>'Offer Letter','4'=>'Confirmation Letter');
    $app_status = array('1'=>'Issued','2'=>'Joined','3'=>'Rejected','4'=>'Confirmed');
    $data['type'] = $type;
    $data['app_status'] = $app_status;
    $data['des'] = $this->Recruitmentmodel->getdesignationdetails();
    $data['branch'] = $this->Recruitmentmodel->getbranchdetails();
    $data['dep'] = $this->Recruitmentmodel->getdepartmentdetails();
    $data['list'] = $this->Recruitmentmodel->createlettersdata($userdata);
    $this->load->view('letters/commonletterlist',$data);
}

public function letterform(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $type = array('1'=>'Appoinment','2'=>'Manager Appoinment','3'=>'Offer Letter','4'=>'Confirmation Letter');
    $app_status = array('1'=>'Issued','2'=>'Joined','3'=>'Rejected','4'=>'Confirmed');
    $data['type'] = $type;
    $data['app_status'] = $app_status;
    $data['des'] = $this->Recruitmentmodel->getdesignationdetails();
    $data['branch'] = $this->Recruitmentmodel->getbranchdetails();
    $data['dep'] = $this->Recruitmentmodel->getdepartmentdetails();
    $data['templates'] = $this->Recruitmentmodel->getassignedtemplates();
    $data['list'] = $this->Recruitmentmodel->getlettersdata($userdata);
    foreach ($data['list'] as $ltkey => $ltval) {
        foreach ($ltval as $xkey => $xval) {
           $tags['{'.$xkey.'}'] = $xval;
        }
    }
    if(!empty($data['list'][0]->templateid) && empty($data['list'][0]->pdfdata)){
        $data['list'][0]->pdfdata = rendertags($tags,'',$data['list'][0]->templateid);
    }else{
        $data['list'][0]->pdfdata = rendertags($tags,$data['list'][0]->pdfdata,'');
    }
    $this->load->view('letters/commontemplatepopup',$data);
}

public function saveletters(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->saveletters($userdata);
}

public function getbranchaddress(){
    $this->verifylogin();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->getbranchdetails($userdata);
    echo $res[0]->mxb_address;
}

public function deletelettersinfobyid(){
    $this->verifylogin();
    $this->header();
    $userdata = $this->input->post();
    $res = $this->Recruitmentmodel->deletelettersinfobyid($userdata);
}

public function openletterpdf(){
    require 'mpdf/autoload.php';
    $this->verifylogin();
    $userdata = $this->input->get();
 
    $data['list'] = $this->Recruitmentmodel->getlettersdata($userdata);
// echo $data['list'][0]->pdfdata;exit;
    $replace_desc = rendertags($tags,$data['list'][0]->pdfdata,'');
    // echo $replace_desc;exit;
        $html = $replace_desc;
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>20,
            'margin_right'=>20,
            'margin_left'=>20,
            'margin_bottom'=>20,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
}

    public function subscriptiondetails(){
        $this->verifylogin();
        $this->header();
        $this->load->view('recruitment/subscription');
        $this->footer();
    }
    
    public function getsubscurrentlocation(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data = $this->Recruitmentmodel->getsubscurrentlocation($userdata);
        $def = '<option value="">ALL</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->currentlocation.">".$value->currentlocation."</option>";
        }
        echo $def;
    }
    public function getsubspreferredlocation(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data = $this->Recruitmentmodel->getsubspreferredlocation($userdata);
        $def = '<option value="">ALL</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->preferredlocation.">".$value->preferredlocation."</option>";
        }
        echo $def;
    }
    
    public function subscriptiondetails_list(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data[sub_list] = $this->Recruitmentmodel->getsubscriptiondetails_list($userdata);
        $this->load->view('recruitment/subscription_list',$data);
    }
    
    public function deletesubscriptiondetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Recruitmentmodel->delete_subscription_details($userdata);
        if ($res == 1) {
            echo 200;
            die();
        } else {
            echo 500;
            die();
        }
    }
    
    public function sendmailpreview(){
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->get();
        $data['userinfo'] = $this->Recruitmentmodel->getsubscriptiondetails($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('recruitment/send_mails_preview',$data);
        $this->footer();
    }

    public function savesendmail(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $userinfo = $this->Recruitmentmodel->gettemplateid($userdata);
        #bulid mail formate
        $to = $userdata['sendmails'];
        foreach ($to as $key => $tval) {
            $ex = explode('[~-~]',$tval);
            $name = $ex[1];
            $email = $ex[0];
            $mobile = $ex[2];
            $currentlc = $ex[3];
            $prefredlc = $ex[4];
            $currentcmp = $ex[5];
            $tags['{name}'] = $name;
            $tags['{email}'] = $email;
            $tags['{mobile}'] = $mobile;
            $tags['{currentlocation}'] = $currentlc;
            $tags['{preferredlocation}'] = $prefredlc;
            $tags['{currentcompany}'] = $currentcmp;
            $body = rendertags($tags,$userinfo[0]->email_body,$userinfo[0]->id);

            $senddata = array(
                "type" => 'JOB NOTIFICATIONS',
                "id" => $userinfo[0]->id,
                'to' => array($email),
                'cc' => array(),
                'bcc' => array(),
                'subject' => $userinfo[0]->email_subject,
                'body' => $body,
                'attachments' => $attachments,
                'createdby' => $this->session->userdata('user_name'),
                'createdempcode' => $this->session->userdata('user_id'),
            );
            $tags = array();
            // print_r($senddata);
            sendmails($senddata);
        }
        #build mail fromate
    }

}
?>