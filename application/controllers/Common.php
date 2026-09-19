<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel');
        $this->load->model('Common_model');
    }

    public function header(){
        $userrole = $this->session->userdata('user_role');
        $data['groups'] = $this->Common_model->groupmenu($userrole);
        $data['pages'] = $this->Common_model->pagesubmenu($userrole);
        $data['ntf'] = $this->Common_model->getlegalnotifications();
        //echo "<pre>";print_r($data);die;
	    $this->load->view('common/header',$data);
    }

    public function footer(){
    	$this->load->view('common/footer');
    }
    
    public function processloginhistory($type,$fullURL){
        $this->Common_model->loginhistory($type,$fullURL);
    }
    
    public function getfullurl(){
        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        return $fullURL = $currentURL . '?' . $params; 
    }
    
    public function getcurrentfunctionname(){
        return $this->router->fetch_method();
    }

    public function display_options($filedname,$selected = ''){
        $data = $this->Common_model->options_data($filedname);
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
    
    public function mastersfilter(){  
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
		$this->load->view('common/masterfilters',$data);	
	}
	
	public function passwordvalidation(){
	    $pass = $this->input->post('checkpass');
	    $resp = $this->Common_model->passwordvalidation($pass);
	    if($resp == 1){
	        echo '200'; exit;
	    }else{
	        echo '500'; exit;
	    }
	}
	
	public function commonFilters($data = array()){
        $data['selectedFilter'] = $data;
        $data['companyFilter'] = $this->Common_model->getCompanyfilter();
        $this->load->view('common/commonfilters',$data);
    }
	
	public function mastersfilter1($ym,$cmd,$div,$stateid,$branch,$emplid,$grade,$empjoin,$categ,$day,$from ='N',$to ='N',$emp_type='N'){  
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $data['cmd'] = $cmd;
        $data['ym'] = $ym;
        $data['div'] = $div;
        $data['stateid'] = $stateid;
        $data['branch'] = $branch;
        $data['emplid'] = $emplid;
        $data['grade'] = $grade;
        $data['empjoin']=$empjoin;
        $data['categ'] = $categ;
        $data['day'] = $day;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['emp_type'] = $emp_type;//---->NEW BY SHABABU(31-07-2022)
		$this->load->view('reports/excelreports/masterfilters',$data);	
	}
	public function mastersfilters_paystructure($ym,$cmd,$div,$stateid,$branch,$emplid,$grade,$empjoin,$categ,$day,$from ='N',$to ='N',$emp_type='N',$is_quaterly='N',$emp_status='N',$is_consolidated='N'){
        $data['cmpmaster'] = $this->Adminmodel->getcompany_master();
        $data['cmd'] = $cmd;
        $data['ym'] = $ym;
        $data['div'] = $div;
        $data['stateid'] = $stateid;
        $data['branch'] = $branch;
        $data['emplid'] = $emplid;
        $data['grade'] = $grade;
        $data['empjoin']=$empjoin;
        $data['categ'] = $categ;
        $data['day'] = $day;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['emp_type'] = $emp_type;//---->NEW BY SHABABU(31-07-2022)
        $data['is_quaterly'] = $is_quaterly;//---->NEW BY SHABABU(24-12-2024)
        $data['emp_status'] = $emp_status; //---->NEW BY Varaprasad(07-01-2026)
        $data['is_consolidated'] = $is_consolidated;//---->NEW BY VARAPRASAD(15-04-2026)
		$this->load->view('reports/excelreports/mastersfilters_paystructure',$data);	
	}

    public function curl($data,$url){
      $params = json_encode($data);
      $apendurl = 'https://maxwellhrms.in/maxwell_services/'.$url;             
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL,$apendurl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLINFO_HEADER_OUT, true);
      $headers = array(
           "Cache-Control: no-cache",
           "Content-Type: application/json",
           "Accesstype:web"//---->NEW BY SHABABU(13-02-2022)-->IT WILL STOP TOKEN VALIDATION FOR APIS
       );
     
      curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
      curl_setopt($ch, CURLOPT_POST, true);
      if(!empty($params)){
          curl_setopt( $ch, CURLOPT_POSTFIELDS,$params);
      }
      curl_setopt($ch, CURLOPT_VERBOSE,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      curl_close($ch);
      if(!empty($response)){
          $res = json_decode($response,true);
      }else{
          $res=[];
      }
      return $res;
    }
}
