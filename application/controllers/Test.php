<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mastermodels');
    }

    public function getdivision(){
		$cmid = $this->input->post('companyid');
        $data = $this->Mastermodels->divisionmaster($cmid);
        $def = '<option value="">Select Division</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxd_id.">".$value->mxd_name."</option>";
        }
        echo $def;
    }

    public function getdepartment(){
        $cmid = $this->input->post('companyid');
        $data = $this->Mastermodels->departmentmaster($cmid);
        $def = '<option value="" data-is_hr ="" data-is_director ="">Select Departments</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxdpt_id."~".$value->mxdpt_is_hr."~".$value->mxdpt_is_director." data-dept_id = ".$value->mxdpt_id." data-is_hr =".$value->mxdpt_is_hr." data-is_director =".$value->mxdpt_is_director.">".$value->mxdpt_name."</option>";
        }
        echo $def;   
    }
    
    public function getgrade(){
        $cmid = $this->input->post('companyid');
        $data = $this->Mastermodels->grademaster($cmid);
        $def = '<option value="">Select Grades</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxgrd_id.">".$value->mxgrd_name."</option>";
        }
        echo $def;   
    }

    public function getbranch(){
        $divid = $this->input->post('divisionid');
        $data = $this->Mastermodels->branchmaster($divid);
        $def = '<option value="">Select Branch</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxb_id." >".$value->mxb_name."</option>";
        }
        echo $def;
    }

    public function getsubbranch(){
        $brid = $this->input->post('branchid');
        $data = $this->Mastermodels->subbranchmaster($brid);
        $def = '<option value="">Select SubBranch</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxsb_id." >".$value->mxsb_name."</option>";
        }
        echo $def;
    }

    public function getdesignations(){
        $grid = $this->input->post('gradeid');
        $data = $this->Mastermodels->designationmaster($grid);
        $def = '<option value="">Select Designations</option>';
        foreach ($data as $key => $value) {
            $def .= "<option value=".$value->mxdesg_id." >".$value->mxdesg_name."</option>";
        }
        echo $def;   
    }

    public function getemployeeid(){
        $empid = $this->input->post('employeetypeid');
        $data = $this->Mastermodels->employeemasterids($empid);
        echo $data[0]->mxemp_ty_short_name.$data[0]->mxemp_ty_empid;
    }

    public function gethrdepartment(){
        // $hrid = $this->input->post('hrid');
        $brid = $this->input->post('brname');
        $cmpname = $this->input->post('cmpname');
        $divname = $this->input->post('divname');
    }

    public function getbrrdepartment(){
        // $hrid = $this->input->post('hrid');
        $brid = $this->input->post('brname');
        $cmpid = $this->input->post('cmpname');
        $divid = $this->input->post('divname');
        $data = $this->Mastermodels->authorizationbranchmaster($cmpid,$divid,$brid);
    }
    
    public function gratuity(){
        $cmid = $this->input->post('companyid');
        $data= $this->Mastermodels->companygratuity($cmid);
        $def = '<option value="">Select Gratuity</option>';
        for ($i=0; $i<count($data); $i++) {
            $def .= "<option value=".$data[$i].">".$data[$i]."</option>";
        }
        echo $def;
    }

}
