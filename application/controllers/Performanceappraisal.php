<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Performanceappraisal extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model('Performanceappraisalmodel');
    }

    public function verifylogin(){
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function performanceappraisal(){
        $this->verifylogin();
        $this->header();
        $data['depart'] = $this->Performanceappraisalmodel->departmentmaster();
        #$data['design'] = $this->Performanceappraisalmodel->designationmaster();
        $this->load->view('appraisal/performanceappraisal',$data);
        $this->footer();
    }

    public function fileterthedata(){
        $userdata = $this->input->post();
        $data['alldata'] = $this->Performanceappraisalmodel->getalluploadedfiles($userdata);
        $this->load->view('appraisal/performanceappraisalfilterdata',$data);
    }

    public function saveappraisal(){
        $userdata = $this->input->post();
        if (!is_uploaded_file($_FILES["fileupload"]["tmp_name"])) {
            echo '404'; exit;
        }
        $res = $this->Performanceappraisalmodel->saveappraisal($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }
    }
    
    public function deletefiles(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->deletefiles($userdata);
        if($res == 1){
            echo '200'; exit();
        }else{
            echo '500'; exit();
        }  
    }

    public function appraisal_questions(){
        $this->verifylogin();
        $this->header();
        $data['depart'] = $this->Performanceappraisalmodel->departmentmaster();
        $data['catg'] = array("1" => "KRA","2" => "KEY COMPENTENCIES",);
        $data['controller'] = $this;
        $this->load->view('appraisal/appraisalquestions',$data);
        $this->footer();   
    }

    public function savequestion(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savequestion($userdata);
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function filterappraisalquestion(){
        $userdata = $this->input->post();
        $controller = $this;
        $dd = $this->Performanceappraisalmodel->filterappraisalquestion($userdata);
        /*
        if($dd > 0){
            $sno = 1; foreach ($dd as $key => $value) {
                $id = $value['mxap_id'];
            $table = "<tr>";
            $table .= "<td style='width:40px;'>".$sno."</td>";
            $table .= "<td>".$value['mxap_question']."</td>";
            $table .= "<td  style='width: 64px;'><button type='button' class='btn btn-danger' onclick=deleteque($id)><i class='fa fa-trash-o'></i></button></td>";
            $table .= "</tr>";
            echo $table;
            $sno++; }
        }
        */
        if($dd > 0){
            $sno = 1;
            foreach ($dd as $key => $value) {

                $id = $value['mxap_id'];
                $question = htmlspecialchars($value['mxap_question']);
                $type = $value['mxap_type'] ?? '';
                $formulatype = $value['mxap_formula_type'] ?? '';

                $table = "<tr class='existing-row'>";

                $table .= "<td>".$sno."</td>";

                // Editable Question
                $table .= "<td>
                            <input type='text'
                                class='form-control form-control-lg'
                                name='question[]'
                                id='question_".$id."'
                                value='".$question."' placeholder='Enter Question'>
                        </td>";

                $table .= "<td>
                            <input type='text'
                                class='form-control form-control-sm'
                                name='kpi[]'
                                id='kpi_".$id."'
                                value='".$value['mxap_kpi']."' placeholder='Enter KPI'>
                        </td>";

                // Type Dropdown
                $table .= "<td>
                            <select class='form-control' name='type[]' id='type_".$id."'>
                                ".$controller->display_options('performance', $type)."
                            </select>
                        </td>";

                $table .= "<td>
                            <select class='form-control' name='formulatype[]' id='formulatype_".$id."'>
                                ".$controller->display_options('performanceformulas', $formulatype)."
                            </select>
                        </td>";

                // Delete Button
                $table .= "<td>
                            <button type='button'
                                    class='btn btn-danger'
                                    onclick='deleteque(".$id.")'>
                                <i class='fa fa-trash'></i>
                            </button>
                        </td>";

                $table .= "<td style='display:none;'>
                            <input type='hidden'
                                class='form-control'
                                name='id[]'
                                id='id_".$id."'
                                value='".$id."'>
                        </td>";

                $table .= "</tr>";

                echo $table;

                $sno++;
            }
        }
    }

    public function updateappraisalquestion(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->updateappraisalquestion($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function appraisal_questions_assign(){
        $this->verifylogin();
        $this->header();
        $data['depart'] = $this->Performanceappraisalmodel->departmentmaster();
        $data['catg'] = array("1" => "KRA","2" => "KEY COMPENTENCIES",);
        $this->load->view('appraisal/appraisalquestions_assign_to_employee',$data);
        $this->footer();   
    }

    public function filterappraisalquestion_details(){
        // $kc = array(
        //     "0" => "Select",
        //     "1" => "Excellent",
        //     "2" => "Very Good",
        //     "3" => "Good",
        //     "4" => "Need Improvement",
        //     "5" => "Unsatisfactory"
        // );
        $userdata = $this->input->post();
        $data['userdata'] = $userdata;
        // Questions List
        $data['questions'] = $this->Performanceappraisalmodel->filterappraisalquestion($userdata);
        // Already Assigned Data
        $data['assigneddata'] = $this->Performanceappraisalmodel->getassignquestionlist($userdata);
        /*
        // Convert Assigned Data Array
        $assignedarray = array();
        if(count($assigneddata) > 0){
            foreach($assigneddata as $vals){
                $questionid = $vals['mxap_assign_queid'];
                $yearmonth = str_replace("-", "_", $vals['mxap_assign_year_month']);
                $assignedarray[$questionid][$yearmonth] = $vals;
            }
        }
        // Financial Year
        $financialyear = $userdata['financialyear'];
        // Example:
        // 2026-04_2027-03
        $financial_year = explode('_', $financialyear);
        $startdate = $financial_year[0] . '-01';
        $enddate   = $financial_year[1] . '-01';
        if(count($questions) > 0){
            $sno = 1;
             $class = 'appraisal-row';
            foreach ($questions as $key => $value) {
                $id = $value['mxap_id'];
                // Existing Data
                $objective = '';
                $unitmeasure = '';
                $weightage = '';
                $show = 0;
                if(isset($assignedarray[$id])){
                    $firstdata = current($assignedarray[$id]);
                    $objective = $firstdata['mxap_assign_objective'];
                    $unitmeasure = $firstdata['mxap_assign_unitmeasure'];
                    $weightage = $firstdata['mxap_assign_weightage'];
                    $show = $firstdata['mxap_assign_que_show'];
                }
                $table = "<tr class='$class'>";
                $table .= "<input type='hidden' name='question_id[]' value='$id'>";
                $table .= "<td>".$sno."</td>";
                $table .= "<td>".$value['mxap_question']."</td>";
                $table .= "<td>
                            <input type='text'
                            name='question_objective[]'
                            class='form-control'
                            value='$objective'>
                          </td>";
                $table .= "<td>
                            <select name='question_assign[]' class='form-control'>
                                <option value='0' ".($show == 0 ? 'selected' : '').">NO</option>
                                <option value='1' ".($show == 1 ? 'selected' : '').">YES</option>
                            </select>
                          </td>";
                $table .= "<td>
                            <input type='text'
                            name='question_unit_measure[]'
                            class='form-control'
                            value='$unitmeasure'>
                          </td>";
                $table .= "<td>
                            <input type='text'
                            name='question_weightage_measure[]'
                            class='form-control'
                            value='$weightage'>
                          </td>";
                // Month Loop
                $month = strtotime($startdate);
                $end = strtotime('+1 month', strtotime($enddate));
                while($month < $end){
                    $yearmonth = date('Y_m', $month);
                    $assignym = $yearmonth.'[]';
                    // Existing Monthly Value
                    $monthvalue = '';
                    if(isset($assignedarray[$id][$yearmonth])){
                        $monthvalue = $assignedarray[$id][$yearmonth]['mxap_assign_monthlytarget'];
                    }
                    // KRA
                    if($userdata['quecategory'] == 1){
                        $table .= "<td>
                                    <input type='text'
                                    name='$assignym'
                                    class='form-control'
                                    value='$monthvalue'>
                                  </td>";
                    }
                    // KPA
                    else{
                        $table .= "<td>
                                    <select name='$assignym' class='form-control'>";
                        foreach($kc as $kckey => $kcval){
                            $selected = ($monthvalue == $kckey) ? 'selected' : '';
                            $table .= "<option value='$kckey' $selected>$kcval</option>";
                        }
                        $table .= "</select></td>";
                    }
                    $month = strtotime("+1 month", $month);
                }
                $table .= "</tr>";
                echo $table;
                $sno++;
            }
        }
            */
        // $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'0');
        // print_r($userdata['quecategory']);exit;
        if($userdata['quecategory'] == 1){
            $this->load->view('appraisal/assignemployeeKRA',$data);
        }else if($userdata['quecategory'] == 2){
            $this->load->view('appraisal/assignemployeeKC',$data);
        }else if($userdata['quecategory'] == 3){
            $data['allemployees'] = $this->Performanceappraisalmodel->getallemployeeslist();
            $data['allemployeesauthorizations'] = $this->Performanceappraisalmodel->getappraisalAuthorizations($userdata['employees']);
            $this->load->view('appraisal/assignemployeeauthorization',$data);
        }
    }

    public function saveappraisalAuthorizations(){
        $authorizationData = $this->input->post('authorizationData');
        if(empty($authorizationData)){
            echo json_encode([
                'status' => 0,
                'message' => 'No data found'
            ]);
            exit;
        }
        $result = $this->Performanceappraisalmodel->saveappraisalAuthorizations($authorizationData);
        echo json_encode($result);
    }

    public function deleteappraisalAuthorization(){
        $authorizationid = $this->input->post('authorizationid');
        $result = $this->Performanceappraisalmodel->deleteappraisalAuthorization($authorizationid);
        echo json_encode($result);
    }
/*
    public function filterappraisalquestion_details(){
        $kc = array("0"=>"Select","1" => "Excellent","2" => "Very Good","3" => "Good","4" => "Need Improvement", "5" => "Unsatisfactory");
        $userdata = $this->input->post();
        $dd = $this->Performanceappraisalmodel->filterappraisalquestion($userdata);
        $assigned = $this->Performanceappraisalmodel->getassignquestionlist($userdata);

        if(count($assigned) > 0){
            $checktable = "<tr>";
            $checktable .= "<td></td>";
            $checktable .= "<td>Data</td>";
            $checktable .= "<td>Already</td>";
            $checktable .= "<td>There</td>";
            foreach($assigned as $key => $vals){
            $mydate = str_replace("_","-",$vals);
                $checktable .= "<td>".$month = date("Y F",strtotime($mydate))."</td>";
            }
            $checktable .= "</tr>";
            echo $checktable;
            exit;
        }

        if($dd > 0){
            $sno = 1; foreach ($dd as $key => $value) {
            $id = $value['mxap_id'];
            $objective = $value['mxap_assign_objective'];
            $table = "<tr>";
            $table .= "<input type='hidden' name='question_id[]' class='form-control' value='$id'>";
            $table .= "<td>".$sno."</td>";
            $table .= "<td>".$value['mxap_question']."</td>";
            $table .= "<td><input type='text' name='question_objective[]' class='form-control' value='$objective'></td>";
            $table .= "<td><select name='question_assign[]' class='form-control'><option value='0'>NO</option><option value='1'>YES</option></select></td>";
            $table .= "<td><input type='text' name='question_unit_measure[]' class='form-control'></td>";
            $table .= "<td><input type='text' name='question_weightage_measure[]' class='form-control'></td>";
            $start = $month = strtotime(date('Y').'-04-01');
            $end = strtotime((date('Y')+1).'-04-01');
            while($month < $end){
                 //echo date('F Y', $month), PHP_EOL; echo '<br>';
                 $yearmonth = date('Y_m', $month);
                 $assignym = $yearmonth .'[]';
                 if($userdata['quecategory'] == 1){
                    $table .= "<td><input type='text' name='$assignym' class='form-control'></td>";
                 }else{
                    $table .= "<td><select name='$assignym' class='form-control'>";
                        foreach($kc as $kckey => $kcval){
                        $table .= "<option value='$kckey'>$kcval</option>";
                        }
                    $table .="</select></td>";
                 }
                 $month = strtotime("+1 month", $month);
            }
            
            // $table .= "<th><input type='text' name='question_accounts_target[]' class='form-control' value='$accounttarget' ></th>";
            // $table .= "<th><button type='button' class='btn btn-danger' onclick=deleteque($id)><i class='fa fa-trash-o'></i></button></th>";
            $table .= "</tr>";
            echo $table;
            $sno++; }
        }
    }
    */
    public function getappremployeeslist(){
        $userdata = $this->input->post();
        $employees = $this->Performanceappraisalmodel->getappremployeeslist($userdata); 
        $sel = "<option value=''>Select Employees</option>";
        if(count($employees) > 0){
            foreach($employees as $key => $emp){
            $sel .= "<option value='".$emp['mxemp_emp_id']."'>".$emp['mxemp_emp_id'].' ( '.$emp['mxemp_emp_fname']. ' ' .$emp['mxemp_emp_lname'].' )'."</option>";
            }
        }
        echo $sel;
    }

    public function saveassignedquestion(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->saveassignedquestion($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function edit_appraisal_questions_assigned(){
        $this->verifylogin();
        $this->header();
        $this;
        $data['depart'] = $this->Performanceappraisalmodel->departmentmaster();
        $data['catg'] = array("1" => "KRA","2" => "KEY COMPENTENCIES",);
        $this->load->view('appraisal/edit_appraisalquestions_assigned_to_employee',$data);
        $this->footer();   
    }


    public function editfilterappraisalquestion_details(){
        $kc = array("0"=>"Select","1" => "Unsatisfactory","2" => "Need Improvement","3" => "Good","4" => "Very Good", "5" => "Excellent");
        $userdata = $this->input->post();
        $assigned = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'0');
        if(count($assigned) > 0){
            $sno = 1; foreach ($assigned as $key => $value) {
            $id = $value['mxap_assign_id'];
            $unitmeasure = $value['mxap_assign_unitmeasure'];
            $weightmeasure = $value['mxap_assign_weightage'];
            $monthlytarget = $value['mxap_assign_monthlytarget'];
            $objective = $value['mxap_assign_objective'];

            $empnoofaccounts = $value['mxap_assign_emp_noofaccounts'];
            $empclientname = $value['mxap_assign_emp_client_name'];
            $empdesc = $value['mxap_assign_emp_description'];
            $empachivement = $value['mxap_assign_emp_achievement'];

            $managernoofaccounts = $value['mxap_assign_manager_noofaccounts'];
            $managerclientname = $value['mxap_assign_manager_client_name'];
            $managerdesc = $value['mxap_assign_manager_review'];
            $managerachivement = $value['mxap_assign_manager_actual_assesment'];

            $employees = $userdata['employees'];
            $quecategory = $userdata['quecategory'];
            $department = $userdata['department'];
            $year = $userdata['year'];
            $months = $userdata['month'];
            $assignornot = $value['mxap_assign_que_show'];
            
            $assignarray = array("0"=>"NO","1"=>"YES");
            $table = "<tr>";
            $table .= "<input type='hidden' name='question_id[]' class='form-control' value='$id'>";
            $table .= "<td>".$sno."</td>";
            $table .= "<td>".$value['mxap_question']."</td>";
            $table .= "<td><select name='question_assign[]' class='form-control'>";
            foreach($assignarray as $skey => $svals) { 
                if($assignornot == $skey){
                    $sel = 'selected';
                }else{
                    $sel = '';
                }
             $table .="<option value='$skey' $sel >$svals</option>";   
            }
            $table .= "</select></td>";
            $table .= "<td><input type='text' name='question_objective[]' class='form-control' value='$objective'></td>";
            $table .= "<td><input type='text' name='question_unit_measure[]' class='form-control' value='$unitmeasure'></td>";
            $table .= "<td><input type='text' name='question_weightage_measure[]' class='form-control' value='$weightmeasure'></td>";
            $start = $month = strtotime(date('Y').'-04-01');
            $end = strtotime((date('Y')+1).'-04-01');
                 if($userdata['quecategory'] == 1){
                    $table .= "<td><input type='text' name='mxap_assign_monthlytarget[]' class='form-control' value='$monthlytarget'></td>";
                 }else{
                    $table .= "<td><select name='mxap_assign_monthlytarget[]' class='form-control'>";
                        foreach($kc as $kckey => $kcval){
                            if($kckey == $monthlytarget){
                                $sel = "selected";
                            }else{
                                $sel = "";
                            }
                        $table .= "<option value='$kckey' $sel>$kcval</option>";
                        }
                    $table .="</select></td>";
                 }
            // $table .= "<td><input type='text' name='noofaccounts[]' class='form-control' value='$empnoofaccounts'></td>";
            // $table .= "<td><input type='text' name='clientname[]' class='form-control' value='$empclientname'></td>";
            // $table .= "<td><input type='text' name='desc[]' class='form-control' value='$empdesc'></td>";
            // $table .= "<td><input type='text' name='empachivement[]' class='form-control' value='$empachivement'></td>";
            // $table .= "<td><input type='text' name='managernoofaccounts[]' class='form-control' value='$managernoofaccounts'></td>";
            // $table .= "<td><input type='text' name='managerclientname[]' class='form-control' value='$managerclientname'></td>";
            // $table .= "<td><input type='text' name='managerdesc[]' class='form-control' value='$managerdesc'></td>";
            // $table .= "<td><input type='text' name='managerachivement[]' class='form-control' value='$managerachivement'></td>";
            // $table .= "<td><a href='#' onclick=getempprofile('$employees','$quecategory','$department','$year','$months') class='btn add-btn' data-toggle='modal' data-target='#add_appraisal'><i class='fa fa-plus'></i> View In Detailed</a></td>";
            // $table .= "<th><button type='button' class='btn btn-danger' onclick=deleteque($id)><i class='fa fa-trash-o'></i></button></th>";
            if($sno == 1){
            $table .= "<td><a href='#' onclick=getempprofile('$employees','$quecategory','$department','$year','$months') class='btn' data-toggle='modal' data-target='#add_appraisal'><i class='fa fa-eye'></i></a></td>";
            }else{
            $table .= "<th></th>";
            }
            $table .= "</tr>";
            echo $table;
            $sno++; }
        }
    }


    public function getassignedandunassignedquestion(){
        $this->header();
        $userdata = $this->input->get();
        $data['allqu'] = $this->Performanceappraisalmodel->getassignedandunassignedquestion($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/assignnewlyaddedquestions',$data);
        $this->footer();
    }

    public function savenewlyaddedquestion(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savenewlyaddedquestion($userdata);
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function getempfulldetails(){
        $userdata = $this->input->post();
        $data['empinfo'] = $this->Performanceappraisalmodel->getempfulldetails($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/fulldetailspopdisplay',$data);
    }


    public function getemployeekradata(){
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/employeekra',$data);
    }


    public function getemployeekpadata(){
        $data['kc'] = array("0"=>"Select","1" => "Unsatisfactory","2" => "Need Improvement","3" => "Good","4" => "Very Good", "5" => "Excellent");
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/employeekpa',$data);
    }


    public function editsaveassignedquestion(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->editsaveassignedquestion($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function saveemployeekra(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->saveemployeekra($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function saveemployeekpa(){
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->saveemployeekpa($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }
// check manager
    public function managerappraisaltoemp(){
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->post();
        $data['managerappraisaltoemp'] = $this->Performanceappraisalmodel->checkismanager($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/manager_appraisal',$data);
        $this->footer();
    }

    public function getmgempfulldetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['empinfo'] = $this->Performanceappraisalmodel->getempfulldetails($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/manager_fulldetailspopdisplay',$data);
    }

    public function getmgemployeekradata(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/manager_employeekra',$data);
    }

    public function getmgemployeekpadata(){
        $this->verifylogin();
        $data['kc'] = array("0"=>"Select","1" => "Unsatisfactory","2" => "Need Improvement","3" => "Good","4" => "Very Good", "5" => "Excellent");
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/manager_employeekpa',$data);
    }
    
    public function savemanagerapprovedkra(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savemanagerapprovedkra($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function savemanagerkpa(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savemanagerkpa($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }
// check manager
    // check hod
    public function hodappraisaltoemp(){
        $this->verifylogin();
        $this->header();
        $userdata = $this->input->post();
        $data['managerappraisaltoemp'] = $this->Performanceappraisalmodel->checkishod($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/hod_appraisal',$data);
        $this->footer();
        // print_r($res);

    }

    public function gethodempfulldetails(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['empinfo'] = $this->Performanceappraisalmodel->getempfulldetails($userdata);
        $data['userdata'] = $userdata;
        $this->load->view('appraisal/hod_fulldetailspopdisplay',$data);
    }

    public function gethodemployeekradata(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/hod_employeekra',$data);
    }

    public function gethodemployeekpadata(){
        $this->verifylogin();
        $data['kc'] = array("0"=>"Select","1" => "Unsatisfactory","2" => "Need Improvement","3" => "Good","4" => "Very Good", "5" => "Excellent");
        $userdata = $this->input->post();
        $data['assigned'] = $this->Performanceappraisalmodel->geteditassignquestionlist($userdata,'1');
        $data['userdata'] = $this->input->post();
        $this->load->view('appraisal/hod_employeekpa',$data);
    }
    
    public function savehodapprovedkra(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savehodapprovedkra($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }

    public function savehodkpa(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $res = $this->Performanceappraisalmodel->savehodkpa($userdata);   
        if($res == 1){
            echo '200';
        }else{
            echo '400';
        }
    }
// check hod
    public function createappraisaltables(){
        $this->Performanceappraisalmodel->createappraisaltables();   
    }

    public function allemployeesappraisallist(){
        $this->verifylogin();
        $this->header();
        $this;
        $data['depart'] = $this->Performanceappraisalmodel->departmentmaster();
        $data['catg'] = array("1" => "KRA","2" => "KEY COMPENTENCIES",);
        $data['appstatus'] = array("COMPLETED" => "Completed","PENDING" => "Pending");
        $data['appstatustype'] = array("1" => "Employee","2" => "Manager", "3" => "HOD", "4" => "HR", "5" => "Reviewer");
        $this->load->view('appraisal/allemployeesappraisallist',$data);
        $this->footer();   
    }

    public function getallemployeesappraisallistdata(){
        $userdata = $this->input->post();
        $data['userdata'] = $userdata;
        $data['alldata'] = $this->Performanceappraisalmodel->getallemployeesappraisallist($userdata);
        $this->load->view('appraisal/allemployeesappraisalltable',$data);
    }

    public function getEmployeeWorkflow(){
        $userdata=$this->input->post();
        $data['questions']=$this->Performanceappraisalmodel->getEmployeeWorkflow($userdata);
        $this->load->view("appraisal/employee_workflow",$data);
    }

    public function openappraisalpdf(){
        require 'mpdf/autoload.php';
        $this->verifylogin();
        $userdata = $this->input->get();
        $userdata['id'] = 18;
    
        $data['list'] = $this->Performanceappraisalmodel->getlettersdataforapprisaldata($userdata);
    // echo $data['list'][0]->pdfdata;exit;
        $replace_desc = rendertags($tags,$data['list'][0]->pdfdata,'');
        // echo $replace_desc;exit;
            $html = $replace_desc;
            $mpdf = new \Mpdf\Mpdf([
                'format'=>'A4',
                'margin_top'=>20,
                'margin_right'=>20,
                'margin_left'=>20,
                'margin_bottom'=>20,
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
    }

}
