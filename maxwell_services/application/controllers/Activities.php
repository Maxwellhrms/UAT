<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Activities extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('Activities_model');
    }

	public function index(){
		echo IP;
	}

    public function api_circular(){
        $obj = $this->api_decode();
        // print_r($obj);exit;
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $departmentid = $this->cleanInput($obj->{'departmentid'});
        $filter = $this->cleanInput($obj->{'filter'});
        $data= $this->Activities_model->getcircularmaster($companyid,$divisionid,$stateid,$branchid,$employeeid,$departmentid,$filter);
        echo $this->api_encodecheck($data);
        
    }

    public function api_notification(){
        $obj = $this->api_decode();
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $departmentid = $this->cleanInput($obj->{'departmentid'});
        $filter = $this->cleanInput($obj->{'filter'});
        $data = $this->Activities_model->getnotificationmaster($companyid,$divisionid,$stateid,$branchid,$employeeid,$departmentid,$filter);
        echo $this->api_encodecheck($data);
        
    }
    
    
    public function api_emprequest(){
        $obj = $this->api_decode();
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $requesttype = $this->cleanInput($obj->{'requesttype'});
        $description = $this->cleanInput($obj->{'description'});
        $parcel_type = $this->cleanInput($obj->{'parcel_type'});
        $parcel_companyid = $this->cleanInput($obj->{'parcel_companyid'});
        $parcel_divisionid = $this->cleanInput($obj->{'parcel_divisionid'});
        $parcel_stateid = $this->cleanInput($obj->{'parcel_stateid'});
        $parcel_branchid = $this->cleanInput($obj->{'parcel_branchid'});
        $parcel_company_name_info = $this->cleanInput($obj->{'parcel_company_name_info'});
        $parcel_contact_person_info = $this->cleanInput($obj->{'parcel_contact_person_info'});
        $parcel_mobile_info = $this->cleanInput($obj->{'parcel_mobile_info'});
        $parcel_emailid_info = $this->cleanInput($obj->{'parcel_emailid_info'});
        $parcel_address_info = $this->cleanInput($obj->{'parcel_address_info'});
        $parcel_pincode_info = $this->cleanInput($obj->{'parcel_pincode_info'});
        $parcel_material_type = $this->cleanInput($obj->{'parcel_material_type'});
        $parcel_current_transpoter_info = $this->cleanInput($obj->{'parcel_current_transpoter_info'});
        $data = $this->Activities_model->insertemprequesttype($companyid,$divisionid,$stateid,$branchid,$employeeid,$requesttype,$description,$parcel_type,$parcel_companyid,$parcel_divisionid,$parcel_stateid,$parcel_branchid,$parcel_company_name_info,$parcel_contact_person_info,$parcel_mobile_info,$parcel_emailid_info,$parcel_address_info,$parcel_pincode_info,$parcel_material_type,$parcel_current_transpoter_info);
        echo $this->api_encodecheck($data);
    }
    
    public function api_emprequestlist(){
        $obj = $this->api_decode();
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $requesttype = $this->cleanInput($obj->{'requesttype'});
        $description = $this->cleanInput($obj->{'description'});
        $data= $this->Activities_model->emprequestlist($companyid,$divisionid,$stateid,$branchid,$employeeid);
        echo $this->api_encodecheck($data);
    }

    public function api_deartmentsdropdown(){
        $obj = $this->api_decode();
        $data= $this->Activities_model->distinctofdepartmentntf();
        echo $this->api_encodecheck($data);
    }
    
    public function api_deartmentsdropdown_circulars(){
        $obj = $this->api_decode();
        $data= $this->Activities_model->distinctofdepartment_circulars();
        echo $this->api_encodecheck($data);
    }
    
    public function api_documentslist(){
        $obj = $this->api_decode();
        $companyid = $this->cleanInput($obj->{'companyid'});
        $divisionid = $this->cleanInput($obj->{'divisionid'});
        $stateid = $this->cleanInput($obj->{'stateid'});
        $branchid = $this->cleanInput($obj->{'branchid'});
        $employeeid = $this->cleanInput($obj->{'employeeid'});
        $documenttype = $this->cleanInput($obj->{'documenttype'});
        $year = $this->cleanInput($obj->{'year'});
        $month = $this->cleanInput($obj->{'month'});
        $data= $this->Activities_model->documentslist($companyid,$divisionid,$stateid,$branchid,$employeeid,$documenttype,$year,$month);
        echo $this->api_encodecheck($data);
    }

}
