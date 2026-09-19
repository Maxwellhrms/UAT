<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class DynamicReportsModel extends CI_Model {
 
        public function __construct()
        {
            $this->load->database();
        }
        
        public function employeelatereporting($data){
            // print_r($data);
            $company = $data['esi_company_id'];
            $division = $data['esi_div_id'];
            $state = $data['esi_state_id'];
            $branch = $data['esi_branch_id'];
            $employeecode = $data['employeecode'];
            $my = explode('-',$data['monthyear']);
            $year = $my[1];
            $month = $my[0];
            $yearm = $year.'_'.$month;
                        // AND MONTH(attendance_date) = MONTH(CURRENT_DATE) 
                        // AND YEAR(attendance_date) = YEAR(CURRENT_DATE)
            $qlo = "SELECT 
                        employee_code, 
                        mxemp_emp_fname, mxd_name, mxst_state,mxb_name, 
                        COUNT(*) AS late_count,
                        GROUP_CONCAT(attendance_date ORDER BY attendance_date SEPARATOR ', ') AS late_dates,
                        (FLOOR(COUNT(*) / 3) * 0.5) AS penalty
                    FROM 
                        employee_punches_$year
                        inner join maxwell_employees_info on employee_code = mxemp_emp_id 
                        inner join maxwell_branch_master on mxb_id = mxemp_emp_branch_code
                        inner join maxwell_state_master on mxst_id = mxemp_emp_state_code
                        inner join maxwell_division_master on mxd_id = mxemp_emp_division_code
                    WHERE 
                        attendance_time BETWEEN '09:40:00' AND '10:00:00'
                        AND MONTH(attendance_date) = '$month'
                        AND YEAR(attendance_date) = '$year'

                        AND islocation = 'YES' ";
                        if(!empty($company)){
                           $qlo .=" and company = '$company'"; 
                        }
                        if(!empty($division)){
                           $qlo .=" and division = '$division'"; 
                        }
                        
                        if(!empty($state)){
                           $qlo .=" and state = '$state'"; 
                        }
                        
                        if(!empty($branch)){
                           $qlo .=" and branch = '$branch'"; 
                        }
                        if(!empty($employeecode)){
                           $qlo .=" and employee_code = '$employeecode'"; 
                        }
                    $qlo .= " GROUP BY 
                        employee_code
                    HAVING 
                        late_count >= 3
                    ORDER BY 
                        late_count DESC;
                    ";
            $querylo = $this->db->query($qlo);
            $result = $querylo->result();
        
            $columns = [
                'employee_code',
                'mxemp_emp_fname',
                'mxd_name',
                'mxst_state',
                'mxb_name',
                'late_count', 
                'late_dates',
                'penalty'
            ]; 
    
            $renameHeaderColumns = [
                'employee_code' => 'Employee Code',
                'mxemp_emp_fname' => 'Employee Name',
                'mxd_name' => 'Division', 
                'mxst_state' => 'State',
                'mxb_name' => 'Branch',
                'late_count' => 'No of Days Late', 
                'late_dates' => 'Attendance Dates',
                'penalty' => 'Deduction Days',
            ]; 
    
            // Mapping id and replace with name form masters
            $dataMappingColumns = array(
                'Translate' => array(),
            );
    
            // Define columns for links and edit actions
            $urllink = '';
            $linkColumns = array(); // Columns where links will be provided
            $editColumns = array(); // Columns with edit options
            $hideColumn = array();
            $reportName = 'Employee Late Comings';
    // print_r((object)$retrunarray);exit;
            echo dynamicTable($result,$columns,$linkColumns, $editColumns, $dataMappingColumns, $renameHeaderColumns, $hideColumn, $reportName);
        }
    }