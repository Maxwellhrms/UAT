<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Employee extends Common {

    public function __construct(){
        parent::__construct();
        $this->load->model('EmployeeModel');
    }

    public function checkloginaccess(){
        $userdata = $this->input->post();
        $res = $this->EmployeeModel->checkloginaccess($userdata); 
    }
    
	public function index()
	{
        if (!empty($this->session->userdata('is_session_active'))) {
            redirect(base_url().'Employee/employeedashboard');
            exit();
        }
		$this->load->view('index');
	}
    # Start Dash Board
    public function employeedashboard()
    {
        $this->checkissession();
        $emp_id = $this->session->userdata('session_loginperson_id');
        $pending = $this->EmployeeModel->pendingPolicies($emp_id);
        if ($pending > 0) {
            // redirect to policy page if not completed
            redirect(base_url() . 'Employee/userpolicies');
            exit();
        }
        $data['dashboard'] = $this->EmployeeModel->employeeDashboard();
        #echo '<pre>'; print_r($data['dashboard']['avgattendance']);exit;
        $this->header();
        $this->load->view('dashboard/employeeDashboard',$data);
        $this->footer();
    }
    public function managerdashboard(){
        $this->checkissession();
        $emp_id = $this->session->userdata('session_loginperson_id');
        $pending = $this->EmployeeModel->pendingPolicies($emp_id);
        if ($pending > 0) {
            // redirect to policy page if not completed
            redirect(base_url() . 'Employee/userpolicies');
            exit();
        }
        // $data['assignedemployees'] = $this->EmployeeModel->getemployeeidsassignedtomanagers();
        // print_r($data['assignedemployees']); exit;
        $data['controller'] = $this;
        $this->header();
        $this->load->view('dashboard/managerDashboard',$data);
        $this->footer();
    }

    public function getassignedemployeesassignedtomanagerattendanceList(){
        $this->checkissession();
        $userdata = $this->input->post();
        // print_r($userdata);exit;
        $data['dashboard'] = $this->EmployeeModel->managersAssignedEmployees($userdata);
        // print_r($dashboard); exit;
        $this->load->view('dashboard/employeesassignedtomanagers',$data);
    }

    public function getRegulationsLeavesList(){
        $this->checkissession();
        $userdata = $this->input->post();
        $data['dashboardLeavesRegulations'] = $this->EmployeeModel->managersAssignedEmployeesRegulationsLeaves($userdata);
        $this->load->view('dashboard/leavesregulationsList',$data);
    }

    public function employeedeatiledsummary(){
        $this->checkissession();
        $data['controller'] = $this;
        $this->header();
        $this->load->view('dashboard/employeedeatiledsummary',$data);
        $this->footer();
    }

    public function employeedeatiledsummaryList(){
        $this->checkissession();
        $userdata = $this->input->post();
        $data['incrementData'] = $this->EmployeeModel->getEmployeeIncrementChartData($userdata);
        $data['dashboarddetails'] = $this->EmployeeModel->allemployeesattendancesummary($userdata);
        $data['joinResign'] = $this->EmployeeModel->joinResignSummary($userdata);
        //  echo '<pre>'; print_r($data['joinResign']); exit;
        $data['branchwisesalary'] = $this->EmployeeModel->getBranchWiseSalarySummary($userdata);
        $data['servicesummary'] = $this->EmployeeModel->getServiceCategorySummary($userdata);
        // echo '<pre>';
        // print_r($data['servicesummary']); exit;
        $data['userfilters'] = $userdata;
        $this->load->view('dashboard/employeedeatiledsummaryList',$data);
    }

    public function getAllEmployeesAttendance(){
        $this->checkissession();
        $userdata = $this->input->post();
        // print_r($userdata);exit;
        if($userdata['type'] == 'INCREMENT'){
            $data['popupdetails'] = $this->EmployeeModel->getAllEmployeesIncrements($userdata);
        }elseif ($userdata['categories'] == 'PENDING') {
            $data['popupdetails'] = $this->EmployeeModel->getAllEmployeesleaveesrequest($userdata);
        }elseif($userdata['type'] == 'JoinResign'){
            $data['popupdetails'] = $this->EmployeeModel->getAllemployeesJoinResignsummaryList($userdata);
        }elseif($userdata['categories'] == 'ServiceSummary'){
            $data['popupdetails'] = $this->EmployeeModel->getServiceCategorySummaryList($userdata);
        }else{
            $data['popupdetails'] = $this->EmployeeModel->getAllEmployeesAttendance($userdata);
        }
        $this->load->view('dashboard/attendancepopupList',$data);
    }
    # End Dash Board
    # Start Policy Info
    public function UserPolicies(){
        $this->checkissession();

        $emp_id = $this->session->userdata('session_loginperson_id');

        $pending = $this->EmployeeModel->pendingPolicies($emp_id);
        if ($pending === 0) {
            redirect(base_url().'Employee/employeedashboard');
            return;
        }

        $data['UsersData']   = $this->EmployeeModel->get_all_policies();
        $data['acknowledged'] = $this->EmployeeModel->get_acknowledged_policy_ids($emp_id);
        $data['acknowledged'] = array_column(
            $data['acknowledged'],
            'policy_id_fk'
        );

        $this->header(array('is_policy' => $pending));
        $this->load->view('policy/policy', $data);
        $this->footer();
    }

    public function policies(){
        $this->checkissession();

        /*  EMPLOYEE CHECK */
        $emp_id = $this->session->userdata('session_loginperson_id');


        $data['UsersData'] = $this->EmployeeModel->get_all_policies();
        $data['acknowledged'] = $this->EmployeeModel->get_acknowledged_policy_ids($emp_id);
        //echo "<pre>";print_r($data['acknowledged']);exit();

        $data['acknowledged'] = array_column(
            $data['acknowledged'],
            'policy_id_fk'
        );

        $pending = $this->EmployeeModel->pendingPolicies($emp_id);

        if ($pending > 0) {
            redirect(base_url() . 'Employee/userpolicies');
            return;
        }

        $this->header();
        $this->load->view('policy/user_policy', $data);

        $this->footer();
    }

    public function acknowledge(){
        $this->checkissession();
        if (!$this->input->is_ajax_request()) {
            show_error('No direct script access allowed', 403);
        }

        $emp_id   = $this->session->userdata('session_loginperson_id');
        $policy_id = $this->input->post('policy_id');

        if (!$emp_id || !$policy_id) {
            echo json_encode(array('status'=>'error'));
            return;
        }

        if ($this->EmployeeModel->is_already_acknowledged($emp_id, $policy_id)) {
            echo json_encode(array(
                'status' => 'already_acknowledged'
            ));
            return;
        }

        $this->EmployeeModel->save_acknowledgment(array(
            'mx_emp_id_fk' => $emp_id,
            'policy_id_fk' => $policy_id,
            'created' => date('Y-m-d H:i:s')
        ));

        echo json_encode(array(
            'status' => 'success'
        ));
    }
    # End Policy Info

    # Start Attendance
    public function employeeattendancepunch(){
        $this->checkissession();
        $this->header();
        $data['title']= "Employee Attendance Punch History";
        $data['controller'] = $this;
        $data['punchhistory'] = $this->EmployeeModel->punch_history();
        $data['statistics'] = $this->EmployeeModel->getAttendanceDashboard();
        $data['presentAttendance'] = $this->EmployeeModel->getPresentAttendance();
        // echo '<pre>'; print_r($data['statistics']);exit;
        $this->load->view('attendance/attendanceemployee', $data);
        $this->footer();
    }

    public function employeepunchhistoryList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->currentattendanceList($userdata);
    }
    # End Attendance

    public function employeepayslips(){
        $this->checkissession();
        $this->header();
        $data['title']= "Employee Yearly Payslips";
        $data['controller'] = $this;
        $this->load->view('payslips/employeepayslips', $data);
        $this->footer();
    }

    public function employeespayslipsList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->employeespayslipsList($userdata);
    }

    public function downloadPayslip() {
        $this->load->helper('download');

        $file = basename($this->input->get('file')); // prevent path traversal
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/payslips/' . $file;

        if (!file_exists($path)) {
            show_404();
        }

        force_download($path, NULL);
    }

    # Start Password
    public function changepassword(){
        $this->checkissession();
        $this->header();
        $data['title']= "Change Employee Login Password ";
        $this->load->view('common/changepassword',$data);
        $this->footer();
    }

    public function UpdatePassword(){
        $this->checkissession();
        $data = $this->input->post();
        $oldpswd = trim($data['oldpassword'] ?? '');
        $newpswd = trim($data['newpassword'] ?? '');
        $cnfpswd = trim($data['confirmpassword'] ?? '');
        if (empty($oldpswd)) {
            echo json_encode([
                'statusCode' => 400,
                'type' => 'error',
                'message' => 'Old password is required'
            ]);
            return;
        }

        if (empty($newpswd)) {
            echo json_encode([
                'statusCode' => 400,
                'type' => 'error',
                'message' => 'New password is required'
            ]);
            return;
        }

        if (empty($cnfpswd)) {
            echo json_encode([
                'statusCode' => 400,
                'type' => 'error',
                'message' => 'Confirm password is required'
            ]);
            return;
        }
        $resp = $this->EmployeeModel->UpdatePassword($data);
    }
    # End Password

    # Start Employee Profile
    public function employeesprofile(){
        $this->checkissession();
        $this->header();
        $data['emp'] = $this->EmployeeModel->getemployeecompletedetails();
        
        // echo '<pre>';
        // print_r($data);
        // exit();
        $this->load->view('employee/employeesprofile', $data);
        $this->footer();
    }

    public function employeemodalpopup(){
        $this->checkissession();
        $data['relation'] = array( 'Father'=>'Father', 'Mother'=>'Mother', 'Brother'=>'Brother' ,'Sister'=>'Sister','Husband'=>'Husband','Wife'=>'Wife','Children'=>'Children' );
        $data['controller'] = $this;
        $userdata = $this->input->post();
        $page       = $this->input->post('page');
        $familyid   = $this->input->post('familyid');
        $employeeid = $this->input->post('employeeid');
        $data['details'] = $this->EmployeeModel->family($employeeid,$familyid);
        $data['pageTitleName'] = $page;
        if($page == 'familyinfo'){
            $this->load->view('employee/modalpops/familymodalpopups', $data);
        }
    }

    public function updateemployeeinfo(){
        $this->checkissession();
        $userdata = $this->input->post();
        $this->EmployeeModel->updateemployeeinfo($userdata);
    }
    # End Employee Profile

    # Holidays
    public function holidayslist(){
        $this->checkissession();
        $this->header();
        $data['title'] = "Holidays List";
        $data['holidayslist'] = $this->EmployeeModel->getHolidaysList();
        $this->load->view('common/holidays', $data);
        $this->footer();
    }
    # Holidays


    # Leaves Start
    public function employeesleaves(){
        $this->checkissession();
        $this->header();
        $data['controller'] = $this;
        $data['title']= 'Employee Self Leaves';       
        $data['leavesummary'] = $this->EmployeeModel->getLeaveSummary();
        // print_r($data['leavesummary']); exit;
        $this->load->view('leaves/selfemployeeleaves', $data);
        $this->footer();
    }

    public function employeesleaveshistoryList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->employeesleaveshistoryList($userdata);
    }  

    # Manger level leaves 
    public function managerApprovalLeaves(){
        $this->checkissession();
        $this->header();
        $data['controller'] = $this;
        $data['title']= 'Manager Employee Leaves';       
        // $data['managerleaveemployeesummary'] = $this->EmployeeModel->manageremployeesleavesList($data);
        $this->load->view('leaves/manageremployeeleaves', $data);
        $this->footer();
    }

    public function manageremployeesleaveshistoryList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->manageremployeesleavesList($userdata);
    } 

    # End Leaves

    # Regulations
     public function employeesRegulations(){
        $this->checkissession();
        $this->header();
        $data['controller'] = $this;
        $data['title']= 'Employee Self Regulations';       
        $data['regulationsummary'] = $this->EmployeeModel->getRegulationSummary();
        // print_r($data['regulationsummary']); exit;
        $this->load->view('regulations/selfemployeeregulations', $data);
        $this->footer();
    }

    public function employeesRegulationsList(){
        $this->checkissession();
        $userdata = $this->input->post();
        // echo $this->EmployeeModel->employeesleaveshistoryList($userdata);
        echo $this->EmployeeModel->employeesRegulationsList($userdata);
    }  
    
    public function managerApprovalRegulations(){
        $this->checkissession();
        $this->header();        
        $data['controller'] = $this;
        $data['title']= 'Manager Employee Regulations';       
        $this->load->view('regulations/manageremployeeregulations', $data);
        $this->footer();
    }

    public function manageremployeesregulationhistoryList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->manageremployeesregulationList($userdata);
    }
    # End Regulations
    # Employee Loans
    public function employeeLoanslist(){
        $this->checkissession();
        $this->header();
        $data['title'] = "Employee Loans List";
        $this->load->view('loans/loancards', $data);
        $this->footer();
    }

    public function getEmployeesLoansList(){
        $this->checkissession();
        $userdata = $this->input->post();
        $data['loanslist'] = $this->EmployeeModel->getEmployeesLoansList($userdata);
        $this->load->view('loans/loancardslist', $data);
    }
    # End Employee Loans
    # Manager Team Members
    public function managerTeamMembers(){
        $this->checkissession();
        $this->header();
        $data['title']= "Your Team Members";
        $data['controller'] = $this;
        $this->load->view('manager/managerteammembers', $data);
        $this->footer();
    }

    public function managerteammembersList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->managerteammembersList($userdata);
    }
    # End Manager Team Members

    # Employee Geo Locations
    public function managerTeamMembersGeoLocationAttendance(){
        $this->checkissession();
        $this->header();
        $data['title']= "Your Team Members Geo Location Attendance";
        $data['controller'] = $this;
        $this->load->view('attendance/managerteammembersgeolocationattendance', $data);
        $this->footer();
    }

    public function managerTeamMembersGeoLocationAttendanceList(){
        $this->checkissession();
        $userdata = $this->input->post();
        echo $this->EmployeeModel->managerTeamMembersGeoLocationAttendanceList($userdata);
    }

    public function TeamMembersGeoLocationAttendance(){
        $this->checkissession();
        $this->header();
        $data['title']= "Geo Location Attendance";
        $data['controller'] = $this;
        $employeeid = $this->input->get('employeeid');
        $date = $this->input->get('date');
        $data['locations'] = $this->EmployeeModel->googlemap($employeeid,$date);
        // echo '<pre>'; print_r( $data['locations']);exit;
        $this->load->view('attendance/geolocationattendance', $data);
        $this->footer();
    }
    # End Employee Geo Locations

    #Appraisal
    public function Appraisal(){
        $this->checkissession();
        $this->header(); 
        $data['title']= "Slelf Appraisals";
        $data['controller'] = $this;
        $data['employeerole'] = $this->EmployeeModel->checkismanagerorhodoremployee();
        // print_r($data['employeerole']);exit;
        $this->load->view('appraisal/employeeappraisals', $data);
        $this->footer();
    }

    public function AppraisalQuestionsList(){
        $this->checkissession();
        $data['controller'] = $this;
        $userdata = $this->input->post();

    // Validation
    if (!empty($userdata['monthyear'])) {

        $selectedMonth = DateTime::createFromFormat('!m-Y', $userdata['monthyear']);

        $currentMonth = new DateTime(date('Y-m-01'));

        if ($selectedMonth >= $currentMonth) {

            echo '<div class="alert alert-danger text-center mt-3">
                    <strong>Previous month appraisal only.</strong><br>
                    You cannot apply appraisal for the current or future month.
                  </div>';

            return;
        }
    }

        if(!isset($userdata['appraisaltype'])){
            $userdata['appraisaltype'] = 1;
        }
        // print_r($userdata); exit;
        $data['userdata'] = $userdata;
        $data['assigned'] = $this->EmployeeModel->getassignquestionlist($userdata,'1');
    //    echo '<pre>'; print_r($data['assigned']);exit;
        // if($userdata['appraisaltype'] == 2){
        // $data['viewerstatus'] = $this->EmployeeModel->getAssignedAppraisalEmployees($userdata['appraisalemployees']);
        // }
        // print_r($data['viewerstatus']);
        // $data['employeerole'] = $this->EmployeeModel->checkismanagerorhodoremployee();
        // print_r($data['employeerole']); exit;
        $data['kc'] = array("0"=>"Select","1" => "Unsatisfactory","2" => "Need Improvement","3" => "Good","4" => "Very Good", "5" => "Excellent");
        // if($userdata['appraisalcategory'] == '2'){
            // $this->load->view('appraisal/EmployeeAppraisalQuestionsListKC', $data);
        // }else{
            $this->load->view('appraisal/EmployeeAppraisalQuestionsList', $data);
        // }
        
    }

    public function saveemployeekra(){
        $this->checkissession();
        $data = $this->input->post();
        $filterdata = json_decode($this->input->post('filterdata'), true);
        $data['filterdata'] = $filterdata;
        $result = $this->EmployeeModel->saveemployeekra($data);
        echo json_encode(array('status'  => $result,'message' => ($result == 1)? 'Appraisal saved successfully.': 'Unable to save appraisal.')); exit;
    }

    public function saveemployeekc(){
        $this->checkissession();
        $data = $this->input->post();
        $result = $this->EmployeeModel->saveEmployeeKeyCompetencies($data);
        echo json_encode(array('status'  => $result,'message' => ($result == 1)? 'Key Competencies saved successfully.': 'Unable to save Key Competencies.')); exit;
    }

    public function saveClientDetails(){
        $this->checkissession();
        $data = $this->input->post();
        // print_r($data);exit;
        $result = $this->EmployeeModel->saveClientDetails($data);
        // echo json_encode(array('status'  => $result ? 1 : 0,'message' => $result ? 'Details saved successfully.' : 'Unable to save details.'));
        if($result['status']){
            echo json_encode(array(
                'status' => 1,
                'message' => 'Details saved successfully.',
                'assignid' => $result['assignid'],
                'employeecount' => $result['employeecount'],
                'managercount' => $result['managercount'],
                'hodcount' => $result['hodcount'],
                'hrcount' => $result['hrcount'],
                'reviewercount' => $result['reviewercount']
            ));

        }else{
            echo json_encode(array(
                'status' => 0,
                'message' => 'Unable to save details.'
            ));
        }
    }

    public function getClientDetails(){
        $assignid = $this->input->post('assignid');
        $empcode  = $this->input->post('empcode');
        $data = $this->EmployeeModel->getClientDetails($assignid,$empcode);
        // print_r($data);exit;
        if(!empty($data)){
            echo json_encode(array(
                'status' => 1,
                'data'   => $data
            ));
        }else{
            echo json_encode(array(
                'status' => 0
            ));

        }
    }

    public function deleteClientDetail(){
        $detailid = $this->input->post('detailid');
        $result = $this->EmployeeModel->deleteClientDetails($detailid);
        echo json_encode($result);
    }
    #Appraisal

    #Common Export to excel
    public function exporttoexcel()
    {
        $this->checkissession();

        $userdata = $this->input->get();

        $name = isset($userdata['name'])
            ? $userdata['name']
            : 'Export';

        $callmodel = isset($userdata['callmodel'])
            ? $userdata['callmodel']
            : 1;

        if ($callmodel == 0) {

            // Excel array coming from View
            $excelarraydata = isset($userdata['excelarraydata'])
                ? $userdata['excelarraydata']
                : '';

            // Convert JSON string to PHP array
            $data = json_decode($excelarraydata, true);

            // Validate JSON
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo 'JSON Error: ' . json_last_error_msg();
                exit;
            }

            // Make sure data is an array
            if (!is_array($data)) {
                echo 'Excel data is not a valid array.';
                exit;
            }

        } else {

            $mdfn = isset($userdata['mdfn'])
                ? $userdata['mdfn']
                : '';

            if (!empty($mdfn)) {
                $data = $this->EmployeeModel->$mdfn($userdata);
            } else {
                $data = array();
            }
        }

        $this->excel_generate($data, $name);
    }

    public function excel_generate($data, $name)
    {
        if (!is_array($data)) {
            echo 'Excel data must be an array.';
            exit;
        }

        array_walk($data, function (&$row) {
            if (isset($row['image'])) {
                unset($row['image']);
            }
        });

        $list = $data;

        if (empty($list)) {
            echo 'No data available for Excel export.';
            exit;
        }

        $this->load->library('excel');

        $this->excel->setActiveSheetIndex(0);

        $this->excel->getActiveSheet()->setTitle(
            'Maxwell_HRMS_' . substr($name, 0, 11)
        );

        $cou = 1;
        $cou_1 = 2;

        $apl_arr = array();
        $apl_arr1 = array();

        for ($i = 'a'; $i <= 'zz'; $i++) {

            $apl_arr1[$cou] = $i . $cou_1;
            $apl_arr[$cou] = $i;

            $cou++;
        }

        /*
        * Get Excel column headers
        */
        $array_keys1 = array_keys($list[0]);

        $array_keys = array();

        foreach ($array_keys1 as $key) {

            $t = str_replace('_1_', '(', $key);
            $t = str_replace('_2_', ')', $t);
            $t = str_replace('_3_', '/', $t);
            $t = str_replace('_4_', '#', $t);
            $t = str_replace('_', ' ', $t);
            $t = str_replace('$', '', $t);

            $array_keys[] = trim($t);
        }

        /*
        * Company name
        */
        $this->excel->getActiveSheet()->mergeCells('A1:AZ1');

        $this->excel->getActiveSheet()->setCellValue(
            'A1',
            ' MAXWELL LOGISTICS PRIVATE LIMITED '
        );

        /*
        * Headers
        */
        for ($i = 0; $i < count($array_keys); $i++) {

            $this->excel->getActiveSheet()
                ->getColumnDimension($apl_arr[$i + 1])
                ->setWidth(25);

            $this->excel->getActiveSheet()->setCellValue(
                $apl_arr1[$i + 1],
                strtoupper($array_keys[$i])
            );
        }

        $this->excel->getActiveSheet()
            ->getRowDimension('1')
            ->setRowHeight(22);

        /*
        * Data
        */
        $this->excel->getActiveSheet()->fromArray(
            $list,
            null,
            'A3'
        );

        /*
        * Download
        */
        $filename = $name . time() . '.xls';

        header('Content-Type: application/vnd.ms-excel');

        header(
            'Content-Disposition: attachment;filename="' . $filename . '"'
        );

        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter(
            $this->excel,
            'Excel5'
        );

        $objWriter->save('php://output');

        exit;
    }
    #Common Export to excel
}
