<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Common.php';
class Loan_controller extends Common
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Adminmodel');
        $this->load->model('Loan_model');
    }
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }
    //---------------------LOAN MASTER
    public function getemployeelistforloans(){
        $userdata = $this->input->post();
        $resemptypes = $this->Loan_model->getemployeeslist($userdata);
        if(count($resemptypes) > 0){
            foreach ($resemptypes as $key1 => $value) {
				echo "<option value=".$value->mxemp_emp_id.">".$value->mxemp_emp_id."~".$value->mxemp_emp_fname." ".$value->mxemp_emp_lname."</option>";
			}
        }else{
            echo '<option value="">No Data Found</option>';
        }        
    }
    public function employeeloanmaster(){
		$this->verifylogin();
		$this->header();
		$data['cmpmaster'] = $this->Adminmodel->getcompany_master();        
		$data['loandata'] = $this->Loan_model->getloandetails();   
// 		echo '<pre>'; print_r($data['loandata']); exit;
		$this->load->view('loan/loanmaster',$data);
		$this->footer();	
    }
    public function saveemployeeloandetails(){
    	$userdata = $this->input->post();
    	$fileType = pathinfo(basename($_FILES["loandoc"]["name"]),PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        $wh = getimagesize($_FILES["loandoc"]["tmp_name"]);
        $imagesize = filesize($_FILES["loandoc"]["tmp_name"]);
        if(is_uploaded_file($_FILES["loandoc"]["tmp_name"])){
            if(in_array($fileType, $allowTypes)){
                // if($wh[0] <= 160 && $wh[1] <= 160){ 
                    if($imagesize < 1000000){
                        $targetfolder = $this->imglink . "emploanfiles/";
                        $targetfolder1 = basename($_FILES['loandoc']['name']);
                        $fileext = pathinfo($_FILES['loandoc']['name'], PATHINFO_EXTENSION);
                        $destination = $targetfolder . "loandoc-". $userdata['employeeid'] . rand() . "." . $fileext;
                        move_uploaded_file($_FILES['loandoc']['tmp_name'], $destination);
                        $userdata['loandoc'] = $destination;
                    }else{
                        echo 'Image Size Should Be Lessthan 1Mb';die();
                    }
                // }else{
                //     echo 'Height and width Should Lessthan or equal to 160px';die();
                // }
            }else{
            echo 'Image Formate Should be jpg/jpeg/png/gif/pdf';die();
            }
        }else{
        	$userdata['loandoc'] = '';
        }
        $resp = $this->Loan_model->saveemployeeloandetails($userdata);
    	if($resp == 1){
    		echo '200';exit();
    	}else{
    		echo '400';exit();
    	}
    }
    public function saveadvanceemployeeloandetails(){
    	$userdata = $this->input->post();
    	$resp = $this->Loan_model->saveadvanceemployeeloandetails($userdata);
    	if($resp == 1){
    		echo '200';exit();
    	}else{
    		echo '400';exit();
    	}
    }
    public function getforcecloserinfo(){
    	$userdata = $this->input->post();
    	$resp = $this->Loan_model->getforcecloserinfoloan($userdata);
    	echo trim($resp[0]->mxemploan_emp_loan_outstanding_amt);
    }
    public function getdetailedloanhistory(){
    	$userdata = $this->input->post();
    	$data['loanhistory'] = $this->Loan_model->getdetailedloanhistory($userdata);
    	$this->load->view('loan/loanhistory',$data);
    }

    public function mobileappliedloans(){
		$this->verifylogin();
		$this->header();
		$data['cmpmaster'] = $this->Adminmodel->getcompany_master();        
		//$data['loandata'] = $this->Loan_model->getloandetailsmobilepp();
        $data['controller'] = $this;        
		$this->load->view('loan/loanappliedbymobile',$data);
		$this->footer();
    }
    
    public function editemployeeloandetails(){
        $userdata = $this->input->get();
        $this->verifylogin();
		$this->header();
		$emp_code = $userdata['emp'];
		$uniqueid = $userdata['id'];
		$data['loandata'] = $this->Loan_model->getloandetailsmobilepp($cmp_id = null,$div_id = null,$state_id = null, $branch_id = null,$emp_code,$emi_month_year = null, $uniqueid, $status = null, $applieddt = null);
		$data['userdata'] = $userdata;
        $data['controller'] = $this;
		$this->load->view('loan/editappliedloans',$data);
		$this->footer();
    }

    public function save_approveemployeeloandetails(){
        $userdata = $this->input->post();
        $fileType = pathinfo(basename($_FILES["loandoc"]["name"]),PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');
        $wh = getimagesize($_FILES["loandoc"]["tmp_name"]);
        $imagesize = filesize($_FILES["loandoc"]["tmp_name"]);
        if(is_uploaded_file($_FILES["loandoc"]["tmp_name"])){
            if(in_array($fileType, $allowTypes)){
                // if($wh[0] <= 160 && $wh[1] <= 160){ 
                    if($imagesize < 1000000){
                        $targetfolder = $this->imglink . "emploanfiles/";
                        $targetfolder1 = basename($_FILES['loandoc']['name']);
                        $fileext = pathinfo($_FILES['loandoc']['name'], PATHINFO_EXTENSION);
                        $destination = $targetfolder . "loandoc-". $userdata['employeeid'] . rand() . "." . $fileext;
                        move_uploaded_file($_FILES['loandoc']['tmp_name'], $destination);
                        $userdata['loandoc'] = $destination;
                    }else{
                        echo 'Image Size Should Be Lessthan 1Mb';die();
                    }
                // }else{
                //     echo 'Height and width Should Lessthan or equal to 160px';die();
                // }
            }else{
            echo 'Image Formate Should be jpg/jpeg/png/gif';die();
            }
        }else{
            $userdata['loandoc'] = '';
        }
        $resp = $this->Loan_model->save_approveemployeeloandetails($userdata);
        if($resp == 1){
            echo '200';exit();
        }else{
            echo '400';exit();
        }
    }

    public function update_loandetailsbystatus(){
        $userdata = $this->input->post();
        $resp = $this->Loan_model->update_loandetailsbystatus($userdata);
        if($resp == 1){
            echo '200';exit();
        }else{
            echo '400';exit();
        }
    }

    public function filteremployeeappliedloandetails(){
        $emp_code = $this->input->post('employeecode');
        $cmp_id = $this->input->post('company');
        $div_id = $this->input->post('divison');
        $state_id = $this->input->post('state');
        $branch_id = $this->input->post('branch');
        $category = $this->input->post('category');
        $status = $this->input->post('status');
        $applieddt = $this->input->post('applieddt');

        $data['loandata'] = $this->Loan_model->getloandetailsmobilepp($cmp_id,$div_id,$state_id, $branch_id,$emp_code,$category, $uniqueid = null, $status,$applieddt);
        $this->load->view('loan/filterloandetails',$data);
    }
    
    public function deleteloandetails(){
        $userdata = $this->input->post();
        $resp = $this->Loan_model->deleteloandetails($userdata);
        if($resp == 1){
            echo '200';exit();
        }else if($resp == 3){
            echo '300'; exit;
        }else{
            echo '400';exit();
        }  
    }
}