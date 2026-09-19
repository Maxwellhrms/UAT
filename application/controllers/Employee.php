<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Employee extends Common {
	protected $imglink = 'uploads/';
    public function __construct() {
        parent::__construct();
        $this->load->model('Employeemodel');
    }

    public function verifylogin(){
		if(empty($this->session->userdata('user_id'))){
			redirect(base_url() . 'admin/logout');die();
		}
	}

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin/index');
    }

    public function employeeslists(){
		$this->verifylogin();
		$this->header();
		$data['states'] = $this->Employeemodel->getstates_master();
		$data['emptype'] = $this->Employeemodel->getemployeetypemaster();
		$data['cmpmaster'] = $this->Employeemodel->getcompany_master();
		$this->load->view('employee/employeeslist',$data);
		$this->footer();		
	}

    public function employeefliterdata(){
		$this->verifylogin();
		$userdata = $this->input->post();
		$data['employeelist'] = $this->Employeemodel->getemployeeslist($userdata);
		$this->load->view('employee/employeefilterlist',$data);
	}


	public function editemployeesprofile(){
		$this->verifylogin();
		$this->header();
		$id = $this->uri->segment(3);
		$data['emp'] = $this->Employeemodel->getemployeecompletedetails($id);
		$emp_id = $data['emp']['employeeinfo'][0]->mxemp_emp_id;
		$data['language'] = $this->Adminmodel->getlanguage_master();
		$data['states'] = $this->Adminmodel->getstates_master();
		$data['countries'] = $this->Adminmodel->getcountries_master();
		$data['relation'] = array( 'Father'=>'Father', 'Mother'=>'Mother', 'Brother'=>'Brother' ,'Sister'=>'Sister','Husband'=>'Husband','Wife'=>'Wife','Children'=>'Children' );
		$data['cmptypeval'] = array('MAXWELL'=>'MAXWELL','ARC'=>'ARC','WEBSITES'=>'WEBSITES','NAUKRI'=>'NAUKRI','WALKIN'=>'WALKIN','JOBPORTAL'=>'JOB PORTAL','LINKEDIN'=>'LINKEDIN','OTHERS'=>'OTHERS');
		$data['authtypeval'] = array(1=>'Branch',2=>'Head Office',3=>'Hr',4=>'Director');
		$data['authtypedata'] = $this->Adminmodel->get_Authorisations($emp_id);
        // echo "<pre>";print_r($data['authtypedata']);exit;
		$data['nomineetyp'] = array('ESI'=>'ESI','PF'=>'PF','GRATUITY'=>'GRATUITY');
		$data['nomineerel'] = array('Father'=>'Father','Mother'=>'Mother','Brother'=>'Brother','Sister'=>'Sister','Husband'=>'Husband','Wife'=>'Wife','Children'=>'Children');
		$data['academy'] = array('General' => 'General','Professional' => 'Professional','NON Mertic' => 'NON Mertic','Mertic' => 'Mertic','SSC' => 'SSC','Inter' => 'Inter','Degree' => 'Degree','Diploma' => 'Diploma','PHD' => 'PHD','Senior Secondary' => 'Senior Secondary');
		$data['bloodgp'] = array('A+'=>'A+','B+'=>'B+','AB+'=>'AB+','O+'=>'O+','A-'=>'A-','B-'=>'B-','AB-'=>'AB-','O-'=>'O-' );
		$data['grautitynos'] = $this->Employeemodel->companygratuity('1');
		$data['documenttype'] = array('1' => 'Appointment','2' => 'Manager Appointment','3' => 'Offer Letter','4' => 'Confirmation Letter','5' => 'BGV','6' => 'Relieving Letter');
		$data['controller'] = $this;
		$this->load->view('employee/editemployeeprofile',$data);
		$this->footer();	
	}

	public function updateemployeedetails(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeedetails($userdata);
		echo $this->responsemsg($res);
	}

	public function updateemployeeacademicdetails(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeeacademicdetails($userdata);
		echo $this->responsemsg($res);
	}

	public function updateemployeetraining(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeetraining($userdata);	
		echo $this->responsemsg($res);
	}

	public function addemployeedocument(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addemployeedocument($userdata);
		echo $this->responsemsg($res);
	}

	public function updateemployeedocuments(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeedocuments($userdata);
		echo $this->responsemsg($res);
	}
	public function updateemployeefamily(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeefamily($userdata);	
		echo $this->responsemsg($res);
	}

	public function updatepreviousemp(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updatepreviousemp($userdata);	
		echo $this->responsemsg($res);
	}

	public function updaterefrences(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updaterefrences($userdata);	
		echo $this->responsemsg($res);
	}

	public function updatenominee(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updatenominee($userdata);	
		echo $this->responsemsg($res);
	}
	
	public function updatelanguage(){
	 	$userdata = $this->input->post();
		$res = $this->Employeemodel->updatelanguage($userdata);	
		echo $this->responsemsg($res);   
	}
	
	public function updatebank(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updatebank($userdata);	
		echo $this->responsemsg($res);
	}

	public function updateaddress(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateaddress($userdata);	
		echo $this->responsemsg($res);

	}

	public function updateemployeeresignationdetails(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeeresignationdetails($userdata);	
		echo $this->responsemsg($res);
	}

    public function changeemployeepassword(){
		$this->verifylogin();
		$this->header();
		$this->load->view('employee/changepassword');
		$this->footer();		
	}

	public function updateemployeepassword(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->updateemployeepassword($userdata);	
		if($res == 1){
			echo '200'; exit();
		}elseif($res == 800){
			echo '2'; exit();
		}else{
			echo '500'; exit();
		}	
	}

	public function responsemsg($res){
		if($res == 1){
			return '200';
		}else{
			return '500';
		}
	}
	
	public function addnewfamily(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addnewfamily($userdata);	
		echo $this->responsemsg($res);	    
	}
	
	public function addnew_refr(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addnew_refr($userdata);	
		echo $this->responsemsg($res);	    
	}
	
	public function addnew_academic(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addnew_academic($userdata);	
		echo $this->responsemsg($res);	    
	}
	
	public function addnew_training(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addnew_training($userdata);	
		echo $this->responsemsg($res);	    
	}
	
	public function addnew_previous_employment(){
		$userdata = $this->input->post();
		$res = $this->Employeemodel->addnew_previous_employment($userdata);	
		echo $this->responsemsg($res);	    
	}
	
	

    public function employeecard(){ 
        $this->verifylogin();
        $this->header();
        $id = $this->uri->segment(3);
        $data['emp'] = $this->Employeemodel->getemployeecard($id);
        $this->saveqrcode($data['emp']['employeeinfo'][0]->mxemp_emp_id);
        $this->load->view('employee/employeecard',$data);
        $this->footer();
    }

    public function saveqrcode($emp){
   	include('phpqrcode/qrlib.php');
    $tempDir = $_SERVER["DOCUMENT_ROOT"].'/maxwellhrms/uploads/qrfiles/';
    $codeContents = 'Some URL HERE';
    
    $fileName = $emp.'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    } else {
        // echo 'File already generated! We can use this cached file to speed up site on common codes!';
        // echo '<hr />';
    }

    }
    
    public function vccard(){
        $this->load->helper('pdf_helper');
        $id = 12;
        // $data['vcard'] = $this->Adminmodel->payslippdf($empid);
        $data['emp'] = $this->Employeemodel->getemployeecard($id);
        $this->load->view('employee/vccard');
    }


    /* Purpose : Authenticate Super Admin login to uncheck the EPS non-contribution in Edit Employee
     * Develoeped By; Varaprasad
     * Developed  on : 28/04/2026
     */

    public function verify_super_admin_access() {
        $password = $this->input->post('password');

        if (!$password) {
            echo json_encode(array('status' => 500, 'message' => 'Password required'));
            exit;
        }

        // Call model to verify if this password belongs to ANY Super Admin
        $isValid = $this->Employeemodel->check_super_admin_password($password);

        if ($isValid) {
            echo json_encode(array('status' => 200));
        } else {
            echo json_encode(array('status' => 401, 'message' => 'Invalid Super Admin Password'));
        }
        exit;
    }

    public function employeessllogins(){
        $this->header();
        $data['title']= "Employee Last Login";
        $data['controller'] = $this;
        $this->load->view('employee/employeeslogin',$data);
        $this->footer();    
    }

    public function employeesslloginslist(){
        $userdata = $this->input->post();
        echo $this->Employeemodel->employeesslloginslist($userdata);
    }

    public function employeesinfoRequest(){
        $this->header();
        $data['title']= "Employee Requests";
        $data['controller'] = $this;
        $this->load->view('employee/employeesinfoRequest',$data);
        $this->footer();    
    }

    public function employeesinfoRequestlist(){
        $userdata = $this->input->post();
        echo $this->Employeemodel->employeesinfoRequestlist($userdata);
    }

    public function employeesinfoRequestinfosave(){
    	$this->verifylogin();
        $userdata = $this->input->post();
        echo $this->Employeemodel->employeesinfoRequestinfosave($userdata);
    }
    
    public function getEmployeeRequestDetails(){
	    $id = $this->input->post('id');
	    $employee_id = $this->input->post('employee_id');
	    $data['details'] = $this->Employeemodel->getEmployeeRequestDetails($id,$employee_id);
	    $this->load->view('employee/employeerequestmodal',$data);
	}
}