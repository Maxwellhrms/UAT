<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies_model extends CI_Model {

    private $table = "maxwell_employees_policies";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    public function getAll()
    {
        return $this->db->order_by("id", "DESC")->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->where("id", $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateData($id, $data)
    {
        return $this->db->where("id", $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where("id", $id)->delete($this->table);
    }

    public function get_total_active_policies()
    {
        return $this->db->where('status', 1)->count_all_results('maxwell_employees_policies');
    }

    public function get_acknowledgment_report()
    {
        $total_policies = $this->get_total_active_policies();

        $this->db->select('
        u.mxemp_emp_id, u.mxemp_emp_fname, u.mxemp_emp_lname,
        u.mxemp_emp_email_id, u.mxemp_emp_phone_no,
        u.mxemp_emp_resignation_status,             
        u.mxemp_emp_is_without_notice_period,       
        COUNT(DISTINCT a.policy_id_fk) as ack_count,
        MAX(a.created) as last_ack_date
    ');
        $this->db->from('maxwell_employees_info u');
        $this->db->join('maxwell_employees_policy_activity a', 'u.mxemp_emp_id = a.mx_emp_id_fk', 'left');
        $this->db->group_by('u.mxemp_emp_id');

        $query = $this->db->get();
        $result = $query->result();

        foreach ($result as $row) {
            $row->total_policies = $total_policies;
            $row->pending_count  = max(0, $total_policies - $row->ack_count);

            // Status Labels
            if ($row->total_policies > 0 && $row->ack_count >= $row->total_policies) {
                $row->status_label = 'Completed';
            } elseif ($row->ack_count == 0 && $row->total_policies > 0) {
                $row->status_label = 'Not Started';
            } else {
                $row->status_label = 'Pending';
            }
        }
        return $result;
    }

    /**
     * Fetches the status of all active policies for a specific employee.
     */
    public function get_employee_policy_breakdown($emp_id)
    {
        $active_policies_table = 'maxwell_employees_policies';
        $activity_table = 'maxwell_employees_policy_activity';

        // 1. Get all active policies (Master List)
        $this->db->select('id, title');
        $this->db->where('status', 1);
        $master_policies = $this->db->get($active_policies_table)->result_array();

        // 2. Get all policies acknowledged by the employee
        $this->db->select('policy_id_fk');
        $this->db->where('mx_emp_id_fk', $emp_id);
        $acknowledged_ids = $this->db->get($activity_table)->result_array();

        // Convert array of objects to a simpler array for quick lookup
        $acknowledged_set = array_column($acknowledged_ids, 'policy_id_fk');

        $report = [];
        foreach ($master_policies as $policy) {
            $policy_id = $policy['id'];
            $is_acknowledged = in_array($policy_id, $acknowledged_set);

            $report[] = array(
                'policy_name' => $policy['title'],
                'status'      => $is_acknowledged ? 'Acknowledged' : 'Pending',
                'status_class' => $is_acknowledged ? 'text-success' : 'text-danger'
            );
        }

        return $report;
    }
}
