<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Qrcode_generator_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }
    public function qrcode_getcompany_master()
    {
        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }
    public function qrcode_getemployeetypemasterdetails($id = null, $cmp_id = null)
    {
        // print_r($cmp_id);exit;
        $this->db->select('mxemp_ty_id,mxemp_ty_cmpid,mxcp_name,mxemp_ty_name,mxemp_ty_short_name,mxemp_ty_table_name,mxemp_ty_is_director,mxemp_ty_is_professionals,mxemp_ty_is_trainees,mxemp_ty_supplementry_table_name');
        $this->db->from('maxwell_employee_type_master');
        $this->db->join('maxwell_company_master', 'mxcp_id=mxemp_ty_cmpid');
        $this->db->where('mxemp_ty_status = 1');
        if ($id != null) {
            $this->db->where('mxemp_ty_id', $id);
        }
        if ($cmp_id != null) {
            $this->db->where('mxemp_ty_cmpid', $cmp_id);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry = $query->result();
        return $qry;
    }
    public function qrcode_getdivisions_based_on_branch_master($cmp_id = null, $type = null)
    {
        //--------------SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('distinct(mxb_div_id)');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }


        if ($type != null) {
            if ($type == "ESI") {
                $this->db->where('mxb_esi_eligibility', 1);
            } else if ($type == "LWF") {
                $this->db->where('mxb_lwf_eligibility', 1);
            } else if ($type == "PT") {
                $this->db->where('mxb_pt_eligibility', 1);
            }
        }

        $this->db->order_by('mxb_div_id');
        $sub_query = $this->db->get_compiled_select();

        //--------------END SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('mxd_id,mxd_name')->from('maxwell_division_master');
        $this->db->where("mxd_id in($sub_query)");
        $this->db->order_by('mxd_id');
        $query = $this->db->get();
        //        echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
    public function qrcode_getstates_based_on_branch_master($cmp_id = null, $div_id = null, $type = null)
    {
        //--------------SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('distinct(mxb_state_id)');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }
        if ($div_id != null) {
            $this->db->where('mxb_div_id', $div_id);
        }

        if ($type != null) {
            if ($type == "ESI") {
                $this->db->where('mxb_esi_eligibility', 1);
            } else if ($type == "LWF") {
                $this->db->where('mxb_lwf_eligibility', 1);
            } else if ($type == "PT") {
                $this->db->where('mxb_pt_eligibility', 1);
            }
        }

        $this->db->order_by('mxb_state_id');
        $sub_query = $this->db->get_compiled_select();

        //--------------END SUB QUERY GETTING DISTINCT STATES FROM BRANCH MASTER
        $this->db->select('mxst_id,mxst_state')->from('maxwell_state_master');
        $this->db->where("mxst_id in($sub_query)");
        $this->db->order_by('mxst_id');
        $query = $this->db->get();
        //        echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }
    public function qrcode_getbranches_based_on_eligibility_state_wise($cmp_id = null, $div_id = null, $state_id = null, $type = null, $is_headoffice = null)
    {

        $this->db->select('mxb_id,mxb_name,mxb_is_head_office');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status', 1);
        if ($type == "ESI") {
            $this->db->where('mxb_esi_eligibility', 1);
        } else if ($type == "LWF") {
            $this->db->where('mxb_lwf_eligibility', 1);
        } else if ($type == 'PT') {
            $this->db->where('mxb_pt_eligibility', 1);
        }
        if ($cmp_id != null) {
            $this->db->where('mxb_comp_id', $cmp_id);
        }
        if ($div_id != null) {
            $this->db->where('mxb_div_id', $div_id);
        }
        if ($state_id != null) {
            $this->db->where('mxb_state_id', $state_id);
        }
        if ($is_headoffice != null) {
            $this->db->where('mxb_is_head_office', 1);
        }
        $this->db->order_by('mxb_id');
        $query = $this->db->get();
                // echo $this->db->last_query();exit;
        $result = $query->result();
        return $result;
    }

    public function processqrcode($data){
        // print_r($data);

        $company =  $data['company'];
        $division = $data['divison'];
        $state = $data['state'];
        $branch = $data['branch'];

        $this->db->select('mxcp_id,mxcp_name');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id', $company);
        $query = $this->db->get();
        $qry['cp'] = $query->result();

        $this->db->select('mxd_id,mxd_name');
        $this->db->from('maxwell_division_master');
        $this->db->where('mxd_status = 1');
        $this->db->where('mxd_comp_id', $company);
        $this->db->where('mxd_id', $division);
        $query = $this->db->get();
        $qry['dv'] = $query->result();

        $this->db->select('mxst_id,mxst_state');
        $this->db->from('maxwell_state_master');
        $this->db->where('mxst_id', $state);
        $query = $this->db->get();
        $qry['st'] = $query->result();

        $this->db->select('mxb_id,mxb_name,mxb_address');
        $this->db->from('maxwell_branch_master');
        $this->db->where('mxb_status = 1');
        $this->db->where('mxb_state_id', $state);
        $this->db->where('mxb_div_id', $division);
        $this->db->where('mxb_comp_id', $company);
        $this->db->where_in('mxb_id', $branch);
        $query = $this->db->get();
        $qry['br'] = $query->result();
        return $qry;
    }
}
?>    