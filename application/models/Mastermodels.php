<?php
error_reporting(0);
defined('BASEPATH') OR EXIT('No Direct Script Acesses Allowed');

class Mastermodels extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

    }

    public function divisionmaster($id){
        $this->db->select('mxd_id,mxd_name');
        $this->db->from('maxwell_division_master');
        $this->db->where('mxd_status = 1');
        $this->db->where('mxd_comp_id',$id);
        if($this->session->userdata('user_limiteddropdowns') == 1){
            $this->db->where('mxd_id',$this->session->userdata('user_division'));
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }

    public function branchmaster($id){
        $this->db->select('mxb_id,mxb_name');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        $this->db->where('mxb_div_id',$id);
        if($this->session->userdata('user_limiteddropdowns') == 1){
            // $this->db->where('mxb_id',$this->session->userdata('user_branch'));
            $bruser = $this->session->userdata('user_branch');
            $brselected = $this->session->userdata('user_custom_branches');
            if(isset($brselected) && !empty($brselected)){
                $br = explode(',',$brselected);
                if(count($br)>0){
                    $bruser_assigned_br = $br;
                }else{
                    $bruser_assigned_br = array($brselected);
                }
            }else{
                $bruser_assigned_br = array($bruser);
            }
            $this->db->where_in('mxb_id',$bruser_assigned_br);
        }
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

    public function subbranchmaster($id){
        $this->db->select('mxsb_id,mxsb_name');
        $this->db->from('maxwell_subbranch_master');
        $this->db->where('mxsb_status = 1');
        $this->db->where('mxsb_main_branch_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    } 

    public function grademaster($id){
        $this->db->select('mxgrd_id,mxgrd_name');
        $this->db->from('maxwell_grade_master');
        $this->db->where('mxgrd_status = 1');
        $this->db->where('mxgrd_comp_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }    

    public function departmentmaster($id){
        $this->db->select('mxdpt_id,mxdpt_name,mxdpt_is_hr,mxdpt_is_director');
        $this->db->from('maxwell_department_master');
        $this->db->where('mxdpt_status = 1');
        $this->db->where('mxdpt_comp_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

    public function designationmaster($id){
        $this->db->select('mxdesg_id,mxdesg_name');
        $this->db->from('maxwell_designation_master');
        $this->db->where('mxdesg_status = 1');
        $this->db->where('mxdesg_grade_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }

    public function employeemasterids($id){
        $this->db->select('mxemp_ty_empid,mxemp_ty_name,mxemp_ty_short_name');
        $this->db->from('maxwell_employee_type_master');
        $this->db->where('mxemp_ty_status = 1');
        $this->db->where('mxemp_ty_id',$id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }
    public function companygratuity($id){
        $this->db->select('mxcp_id,mxcp_gratuity_reg_no');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$id);
        $query = $this->db->get();
        $compcnt = $query->num_rows();
        $qry = $query->result();
        if( $compcnt > 0 ){
            $graduity = $qry[0]->mxcp_gratuity_reg_no;
            $gracnt = substr_count($graduity ,',');
            if($gracnt > 0 ){
               $cmpgratuity = explode(',' , $qry[0]->mxcp_gratuity_reg_no );
               return $cmpgratuity ;         
            }else{
                $cmpgratuity= array(0 => $qry[0]->mxcp_gratuity_reg_no );
                return $cmpgratuity; 
            }
        }else{
            return $cmpgratuity;
        }
       
    }
}
?>
