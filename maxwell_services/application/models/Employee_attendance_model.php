<?php
error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');
class Employee_attendance_model extends Common_model
{
    public $sucessmsg='success have great day';
    protected $imglink = 'uploads/';
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }

    public function api_employee_attendance_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$date=""){
        $currentdate = DBD;
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }

        $this->db->select('mx_attendance_id as attendance_uniqid, mx_attendance_emp_code as employeeid, mx_attendance_date as attendancedate, CONCAT(mxemp_emp_fname," ", mxemp_emp_lname) as fullname, mx_attendance_first_half as firsthalf, mx_attendance_second_half as secondhalf, mx_attendance_cmp_id as companyid, mx_attendance_division_id as divisionid, mx_attendance_state_id as stateid, mx_attendance_branch_id as branchid,mx_attendance_first_half_punch as first_half_punch,mx_attendance_second_half_punch as second_half_punch');
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->where('mx_attendance_emp_code', $employeeid);
        if (!empty($company)) {
            $this->db->where('mx_attendance_cmp_id', $company);
        }
        if (!empty($division)) {
            $this->db->where('mx_attendance_division_id', $division);
        }
        if (!empty($state)) {
            $this->db->where('mx_attendance_state_id', $state);
        }
        if (!empty($branch)) {
            $this->db->where('mx_attendance_branch_id', $branch);
        }
        $this->db->where('mx_attendance_date <=', $currentdate);
        $this->db->order_by('mx_attendance_date','DESC');
        $query = $this->db->get();
        $qry1 = $query->result_array(); 
        // print_r($qry1);exit;
        if(count($qry1)>0){
            // $message="Success";
            // $statuscode="200";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']='';
            for($i=0; $i<count($qry1); $i++){
                $first_half_punch = $qry1[$i]['first_half_punch'];
                $second_half_punch = $qry1[$i]['second_half_punch'];
                if(!empty($first_half_punch) && !empty($second_half_punch)){
                    //---------FIRST HALF PUNCH
                    $first_ex = explode(',',$first_half_punch);
                // print_r($first_ex);exit;
                    if(count($first_ex) > 0){
                        $final_first_half_punch = $first_ex[0];
                    }else{
                        $final_first_half_punch = $first_half_punch;
                    }
                    //---------END FIRST HALF PUNCH
                    //---------SECOND HALF PUNCH
                    $second_ex = explode(',',$second_half_punch);
                    if(count($second_ex) > 0){
                        $final_second_half_punch = $second_ex[count($second_ex)-1];
                    }else{
                        $final_second_half_punch = $second_half_punch;
                    }
                    //---------END SECOND HALF PUNCH
                    $qry1[$i]['first_half_punch'] = $final_first_half_punch;
                    $qry1[$i]['second_half_punch'] = $final_second_half_punch;
                
                }else if(empty($first_half_punch) && !empty($second_half_punch)){//-----FIRST HALF EMPTY SECOND HALF NON EMPTY
                    
                    //---------SECOND HALF PUNCH
                    $second_ex = explode(',',$second_half_punch);
                    if(count($second_ex) > 1){ //--->if contains more than one then take second half first one and last one
                        $final_first_half_punch = $second_ex[0];
                        $final_second_half_punch = $second_ex[count($second_ex)-1];
                    }else{
                        $final_first_half_punch = $second_ex[0];
                        $final_second_half_punch = '';
                    }
                    //---------END SECOND HALF PUNCH
                    $qry1[$i]['first_half_punch'] = $final_first_half_punch;
                    $qry1[$i]['second_half_punch'] = $final_second_half_punch;
                }else if(!empty($first_half_punch) && empty($second_half_punch)){//-----FIRST HALF EMPTY SECOND HALF NON EMPTY
                    
                    //---------FIRST HALF PUNCH
                    $first_ex = explode(',',$first_half_punch);
                    if(count($first_ex) > 1){ //--->if contains more than one then take second half first one and last one
                        $final_first_half_punch = $first_ex[0];
                        $final_second_half_punch = $first_ex[count($first_ex)-1];
                    }else{
                        $final_first_half_punch = $first_ex[0];
                        $final_second_half_punch = '';
                    }
                    //---------END FIRST HALF PUNCH
                    $qry1[$i]['first_half_punch'] = $final_first_half_punch;
                    $qry1[$i]['second_half_punch'] = $final_second_half_punch;
                }
            }
            $data1=$qry1;
            return $data1;
        }else{
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
            $data1=$qry1;
            return $data1;
        }
    }
    //-----------NEW BY SHABABU(11-05-2022)
    public function api_employee_attendance_list_date($employeeid,$companyid,$divisionid,$stateid,$branchid,$month,$year,$final_date){ // print_r($final_date); exit;
        $currentdate = DBD;
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }

        $this->db->select('mx_attendance_id as attendance_uniqid, mx_attendance_emp_code as employeeid, mx_attendance_date as attendancedate, CONCAT(mxemp_emp_fname," ", mxemp_emp_lname) as fullname, mx_attendance_first_half as firsthalf, mx_attendance_second_half as secondhalf, mx_attendance_cmp_id as companyid, mx_attendance_division_id as divisionid, mx_attendance_state_id as stateid, mx_attendance_branch_id as branchid,mx_attendance_first_half_punch as first_half_punch,mx_attendance_second_half_punch as second_half_punch');
        $this->db->from('maxwell_attendance_' . $year . '_' . $month . '');
        $this->db->join('maxwell_employees_info', 'mxemp_emp_id = mx_attendance_emp_code', 'inner');
        $this->db->where('mx_attendance_emp_code', $employeeid);
        if (!empty($company)) {
            $this->db->where('mx_attendance_cmp_id', $company);
        }
        if (!empty($division)) {
            $this->db->where('mx_attendance_division_id', $division);
        }
        if (!empty($state)) {
            $this->db->where('mx_attendance_state_id', $state);
        }
        if (!empty($branch)) {
            $this->db->where('mx_attendance_branch_id', $branch);
        }
        $this->db->where('mx_attendance_date', $final_date);
        //$this->db->where('mx_attendance_date', $date);
        $this->db->order_by('mx_attendance_date','DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $qry1 = $query->result_array(); 
        if(count($qry1)>0){

            $first_half_punch = $qry1[0]['first_half_punch'];
            $second_half_punch = $qry1[0]['second_half_punch'];
            if(!empty($first_half_punch) && !empty($second_half_punch)){
                //---------FIRST HALF PUNCH
                $first_ex = explode(',',$first_half_punch);
            // print_r($first_ex);exit;
                if(count($first_ex) > 0){
                    $final_first_half_punch = $first_ex[0];
                }else{
                    $final_first_half_punch = $first_half_punch;
                }
                //---------END FIRST HALF PUNCH
                //---------SECOND HALF PUNCH
                $second_ex = explode(',',$second_half_punch);
                if(count($second_ex) > 0){
                    $final_second_half_punch = $second_ex[count($second_ex)-1];
                }else{
                    $final_second_half_punch = $second_half_punch;
                }
                //---------END SECOND HALF PUNCH
                $qry1[0]['first_half_punch'] = $final_first_half_punch;
                $qry1[0]['second_half_punch'] = $final_second_half_punch;
            }else if(empty($first_half_punch) && !empty($second_half_punch)){//-----FIRST HALF EMPTY SECOND HALF NON EMPTY
                
                //---------SECOND HALF PUNCH
                $second_ex = explode(',',$second_half_punch);
                if(count($second_ex) > 1){ //--->if contains more than one then take second half first one and last one
                    $final_first_half_punch = $second_ex[0];
                    $final_second_half_punch = $second_ex[count($second_ex)-1];
                }else{
                    $final_first_half_punch = $second_ex[0];
                    $final_second_half_punch = '';
                }
                //---------END SECOND HALF PUNCH
                $qry1[0]['first_half_punch'] = $final_first_half_punch;
                $qry1[0]['second_half_punch'] = $final_second_half_punch;
            }else if(!empty($first_half_punch) && empty($second_half_punch)){//-----FIRST HALF EMPTY SECOND HALF NON EMPTY
                
                //---------FIRST HALF PUNCH
                $first_ex = explode(',',$first_half_punch);
                if(count($first_ex) > 1){ //--->if contains more than one then take second half first one and last one
                    $final_first_half_punch = $first_ex[0];
                    $final_second_half_punch = $first_ex[count($first_ex)-1];
                }else{
                    $final_first_half_punch = $first_ex[0];
                    $final_second_half_punch = '';
                }
                //---------END FIRST HALF PUNCH
                $qry1[0]['first_half_punch'] = $final_first_half_punch;
                $qry1[0]['second_half_punch'] = $final_second_half_punch;
            }
            
            
            $data1=$qry1;
            return $data1;
        }else{
            $data1=$qry1;
            return $data1;
        }
    }
    //-----------NEW BY SHABABU(11-05-2022)


    public function api_employee_manual_attendance($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid,$entrytype,$difference,$latitudes,$longitudes,$locations,$qrresult,$radius,$islocation){
        $etypr = $entrytype;
        $elc = $locations;
        $elt = $latitudes;
        $elg = $longitudes;
        $er = $radius;
        if(count($difference)>0){
            $desc = implode(',', $difference) . ' Key/Keys Missing Please Check';
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        if($attendancedate != DBD){
            $desc = 'Please Send Current Date Only';
            create_notes($employeeid,'2',$desc.' Actual- '.DBD.' Recevied- '.$attendancedate.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        #QRcode Validation check only for branch
        if($entrytype == 'QRCODE'){
            if(strlen($qrresult) > 10){
                // $desc = $qrresult;
                //     $message="Failed";
                //     $statuscode="500";
                //     $data1['status']=$statuscode;
                //     $data1['msg']=$message;
                //     $data1['description']=$desc;
                    // return $data1;exit;
                $qrre = base64_decode($qrresult);
                $qrjson = json_decode($qrre,false);
                if($qrjson->companyid != $companyid){
                    $desc = 'Your Not Belongs to this Company Please Contact Admin';
                    create_notes($employeeid,'2',$desc.' Actual- '.$companyid.' Recevied- '.$qrjson->companyid.' Type- '.$entrytype ,$employeeid);
                    $message="Failed";
                    $statuscode="500";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
                if($qrjson->divisionid != $divisionid){
                    $desc = 'Your Not Belongs to this Division Please Contact Admin';
                    create_notes($employeeid,'2',$desc.' Actual- '.$divisionid.' Recevied- '.$qrjson->divisionid.' Type- '.$entrytype ,$employeeid);
                    $message="Failed";
                    $statuscode="500";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
                if($qrjson->stateid != $stateid){
                    $desc = 'Your Not Belongs to this State Please Contact Admin';
                   create_notes($employeeid,'2',$desc.' Actual- '.$stateid.' Recevied- '.$qrjson->stateid.' Type- '.$entrytype ,$employeeid);
                    $message="Failed";
                    $statuscode="500";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
                if($qrjson->branchid != $branchid){
                    $desc = 'Your Not Belongs to this Branch Please Contact Admin';
                    create_notes($employeeid,'2',$desc.' Actual- '.$branchid.' Recevied- '.$qrjson->branchid.' Type- '.$entrytype ,$employeeid);
                    $message="Failed";
                    $statuscode="500";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
            }

        }
        #QRcode Validation check only for branch
        $this->db->trans_begin();
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime,mxcp_firsthalf_gracetime,mxcp_secondhalf_gracetime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();
        // rolback
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
        $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
        
        // $firsthalf_gracetime = '05';
        // $secondhalf_gracetime = '05';
        // echo $secondhalf;
        // echo $secondhalftime;
        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
          
        $this->db->select('mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type,mx_attendance_latitude,mx_attendance_longitude,mx_attendance_location');
        $this->db->from($tablename);
        $this->db->where('mx_attendance_cmp_id', $companyid);
        $this->db->where('mx_attendance_division_id', $divisionid);
        $this->db->where('mx_attendance_state_id', $stateid);
        $this->db->where('mx_attendance_branch_id', $branchid);
        $this->db->where('mx_attendance_emp_code', $employeeid);
        $this->db->where('mx_attendance_date', $attendancedate);
        $this->db->where('mx_attendance_id', $attendance_uniqid);
        $query1 = $this->db->get();
        //echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();
         if($num ==1){
            if(empty($qry1[0]->mx_attendance_latitude)){
                $latitude = $latitudes;
            }else{
                $latitude = $qry1[0]->mx_attendance_latitude .','. $latitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_longitude)){
                $longitude = $longitudes;
            }else{
                $longitude = $qry1[0]->mx_attendance_longitude .','. $longitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_location)){
                $location = $locations;
            }else{
                $location = $qry1[0]->mx_attendance_location .'*+*+*'. $locations;
            }
            
            $currenttime = CURRENTTIME;
            // First Half Punches
            if(strtotime($currenttime) <= strtotime($qry[0]->mxcp_firsthalf_time) || strtotime($currenttime) <= strtotime($qry[0]->mxcp_secondbreak_time)){
                if(empty($qry1[0]->mx_attendance_first_half_punch)){
                    $punchtime = CURRENTTIMESECONDS;
                    $type = $entrytype;
                }else{
                    $punchtime = $qry1[0]->mx_attendance_first_half_punch .','. CURRENTTIMESECONDS;
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type . $type .'-'. CURRENTTIMESECONDS;
                $uparray = array("mx_attendance_first_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracefirst = $this->add_grace_calculator($firsthalf_gracetime,$qry[0]->mxcp_firsthalf_time);
                // if(strtotime($currenttime) <= strtotime($gracefirst)){
                //     $uparray["mx_attendance_first_half"] = "PR"; 
                // }

                // Skip if Sunday
                if (date('w', strtotime($attendancedate)) == 0) {
                    // Sunday, do nothing
                } else {
                    if (strtotime($currenttime) <= strtotime($gracefirst)) {
                        $uparray["mx_attendance_first_half"] = "PR";
                    }
                }
                
                // if($entrytype == 'GEOTAG' && $islocation == 'NO'){
                if($islocation == 'NO'){
                   $uparray["mx_attendance_first_half"] = "OD";
                   create_notes($employeeid,'1','Punch Has Been Registered For First Half Type- '.$entrytype.' Punch Time- '.$currenttime.' FOR ONDUTY' ,$employeeid);
                }

                // if($entrytype == 'QRCODE' && $islocation == 'NO'){
                if($islocation == 'NO'){
                   $uparray["mx_attendance_first_half"] = "OD";
                   create_notes($employeeid,'1','Punch Has Been Registered For First Half Type- '.$entrytype.' Punch Time- '.$currenttime.' FOR ONDUTY' ,$employeeid);
                }
                if ($islocation == 'YES' && $currenttime >= '09:40' && $currenttime <= '10:00') {
                    $uparray["mx_attendance_first_half"] = "LTD";
                    create_notes($employeeid,'1','Punch Has Been Registered For First Half Type- '.$entrytype.' Punch Time- '.$currenttime.' FOR ONDUTY' ,$employeeid);
                }
                $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $uparray);
                
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                  'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => CURRENTTIMESECONDS,
                  'company' => $companyid,
                  'division' => $divisionid,
                  'state' => $stateid,
                  'branch' => $branchid,
                  'entry_type' => $etypr,
                  'location' => $elc,
                  'latitudes' => $elt,
                  'longitudes' => $elg,
                  'radius' => $er,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                  'islocation' => $islocation,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
                /*if($res == 1){
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['employee_attendance_history']="Punch Has Been Registered";
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "data_rollback";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }*/
                //echo $this->db->last_query();
            }
            // End Of First Half Punches
            // Second Half Punches
            if(strtotime($currenttime) > strtotime($qry[0]->mxcp_secondbreak_time) || strtotime($currenttime) >= strtotime($qry[0]->mxcp_secondhalf_time)){
                if(empty($qry1[0]->mx_attendance_second_half_punch)){
                    $punchtime = CURRENTTIMESECONDS;
                    if(empty($qry1[0]->mx_attendance_entry_type)){
                        $type = $entrytype;
                    }else{
                        $type = ','. $entrytype;
                    }
                }else{
                    $punchtime = $qry1[0]->mx_attendance_second_half_punch .','. CURRENTTIMESECONDS;
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type .$type.'-'. CURRENTTIMESECONDS;
                $fparray = array("mx_attendance_second_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracesecond = $this->add_grace_calculator($secondhalf_gracetime,$qry[0]->mxcp_secondhalf_time);
                if(strtotime($currenttime) <= strtotime($gracesecond)){
                    $fparray["mx_attendance_second_half"] = "PR"; 
                }
                
                // if($entrytype == 'GEOTAG' && $islocation == 'NO'){
                if($islocation == 'NO'){
                   $fparray["mx_attendance_second_half"] = "OD"; 
                   create_notes($employeeid,'1','Punch Has Been Registered For Second Half Type- '.$entrytype.' Punch Time- '.$currenttime.' FOR ONDUTY' ,$employeeid);
                }
                
                // if($entrytype == 'QRCODE' && $islocation == 'NO'){
                if($islocation == 'NO'){
                   $fparray["mx_attendance_second_half"] = "OD";
                   create_notes($employeeid,'1','Punch Has Been Registered For First Half Type- '.$entrytype.' Punch Time- '.$currenttime.' FOR ONDUTY' ,$employeeid);
                }
                
                
                
                $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $fparray);
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                  'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => CURRENTTIMESECONDS,
                  'company' => $companyid,
                  'division' => $divisionid,
                  'state' => $stateid,
                  'branch' => $branchid,
                  'entry_type' => $etypr,
                  'location' => $elc,
                  'latitudes' => $elt,
                  'longitudes' => $elg,
                  'radius' => $er,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                  'islocation' => $islocation,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
                /*if($res == 1){
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['employee_attendance_history']="Punch Has Been Registered";
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "data_rollback";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }*/
                //echo $this->db->last_query();
            }
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist And Please Check Employee";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $data1;
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message="Failed";
            $statuscode="500";
            $desc = "data_rollback";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
             create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $data1;
        } else {
            $this->db->trans_commit();
            // $customdesc='';
            // $leavecheck= leave_check_current_date($employeeid);
            // if($leavecheck){
            //     $customdesc='You have been already applied leave on this day';
            // }else{
            //     $customdesc='';
            // }
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;//.' '.$customdesc;
            $data1['description']='';
            $data1['employee_attendance_history']="Punch Has Been Registered";
             create_notes($employeeid,'1','Punch Has Been Registered Type- '.$entrytype.' Punch Time- '.$currenttime ,$employeeid);
            return $data1;
        }

    }


    public function api_pomtop_attendance($employeeid,$attendancedate,$entrytype,$difference,$companyid){
        $etypr = $entrytype;
        if(count($difference)>0){
            $desc = implode(',', $difference) . ' Key/Keys Missing Please Check';
             create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        if($attendancedate != DBD){
            $desc = 'Please Send Current Date Only';
            create_notes($employeeid,'2',$desc.' Actual- '.DBD.' Recevied- '.$attendancedate.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        $this->db->trans_begin();
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime,mxcp_firsthalf_gracetime,mxcp_secondhalf_gracetime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();
        // rolback
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
        $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
        // $firsthalf_gracetime = '05';
        // $secondhalf_gracetime = '05';
        // echo $secondhalf;
        // echo $secondhalftime;
        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
          
        $this->db->select('mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type,mx_attendance_latitude,mx_attendance_longitude,mx_attendance_location');
        $this->db->from($tablename);
        // $this->db->where('mx_attendance_cmp_id', $companyid);
        // $this->db->where('mx_attendance_division_id', $divisionid);
        // $this->db->where('mx_attendance_state_id', $stateid);
        // $this->db->where('mx_attendance_branch_id', $branchid);
        $this->db->where('mx_attendance_emp_code', $employeeid);
        $this->db->where('mx_attendance_date', $attendancedate);
        // $this->db->where('mx_attendance_id', $attendance_uniqid);
        $query1 = $this->db->get();
        //echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();
         if($num ==1){
            if(empty($qry1[0]->mx_attendance_latitude)){
                $latitude = $latitudes;
            }else{
                $latitude = $qry1[0]->mx_attendance_latitude .','. $latitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_longitude)){
                $longitude = $longitudes;
            }else{
                $longitude = $qry1[0]->mx_attendance_longitude .','. $longitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_location)){
                $location = $locations;
            }else{
                $location = $qry1[0]->mx_attendance_location .'*+*+*'. $locations;
            }
            
            $currenttime = CURRENTTIME;
            // First Half Punches
            if(strtotime($currenttime) <= strtotime($qry[0]->mxcp_firsthalf_time) || strtotime($currenttime) <= strtotime($qry[0]->mxcp_secondbreak_time)){
                if(empty($qry1[0]->mx_attendance_first_half_punch)){
                    $punchtime = CURRENTTIMESECONDS;
                    $type = $entrytype;
                }else{
                    $punchtime = $qry1[0]->mx_attendance_first_half_punch .','. CURRENTTIMESECONDS;
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type . $type .'-'. CURRENTTIMESECONDS;
                $uparray = array("mx_attendance_first_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracefirst = $this->add_grace_calculator($firsthalf_gracetime,$qry[0]->mxcp_firsthalf_time);
                // if(strtotime($currenttime) <= strtotime($gracefirst)){
                //     $uparray["mx_attendance_first_half"] = "PR"; 
                // }
                // Skip if Sunday
                if (date('w', strtotime($attendancedate)) == 0) {
                    // Sunday, do nothing
                } else {
                    if (strtotime($currenttime) <= strtotime($gracefirst)) {
                        $uparray["mx_attendance_first_half"] = "PR";
                    }
                }
                // $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $uparray);
                
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                //   'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => CURRENTTIMESECONDS,
                  'company' => $companyid,
                //   'division' => $divisionid,
                //   'state' => $stateid,
                //   'branch' => $branchid,
                  'entry_type' => $etypr,
                //   'location' => $elc,
                //   'latitudes' => $elt,
                //   'longitudes' => $elg,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
                
                /*if($res == 1){
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['employee_attendance_history']="Punch Has Been Registered";
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "data_rollback";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }*/
                //echo $this->db->last_query();
            }
            // End Of First Half Punches
            // Second Half Punches
            if(strtotime($currenttime) > strtotime($qry[0]->mxcp_secondbreak_time) || strtotime($currenttime) >= strtotime($qry[0]->mxcp_secondhalf_time)){
                if(empty($qry1[0]->mx_attendance_second_half_punch)){
                    $punchtime = CURRENTTIMESECONDS;
                    if(empty($qry1[0]->mx_attendance_entry_type)){
                        $type = $entrytype;
                    }else{
                        $type = ','. $entrytype;
                    }
                }else{
                    $punchtime = $qry1[0]->mx_attendance_second_half_punch .','. CURRENTTIMESECONDS;
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type .$type.'-'. CURRENTTIMESECONDS;
                $fparray = array("mx_attendance_second_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracesecond = $this->add_grace_calculator($secondhalf_gracetime,$qry[0]->mxcp_secondhalf_time);
                if(strtotime($currenttime) <= strtotime($gracesecond)){
                    $fparray["mx_attendance_second_half"] = "PR"; 
                }
                // $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $fparray);
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                //   'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => CURRENTTIMESECONDS,
                  'company' => $companyid,
                //   'division' => $divisionid,
                //   'state' => $stateid,
                //   'branch' => $branchid,
                  'entry_type' => $etypr,
                //   'location' => $elc,
                //   'latitudes' => $elt,
                //   'longitudes' => $elg,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
                /*if($res == 1){
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['employee_attendance_history']="Punch Has Been Registered";
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "data_rollback";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }*/
                //echo $this->db->last_query();
            }
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist And Please Check Employee";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $data1;
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message="Failed";
            $statuscode="500";
            $desc = "data_rollback";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $data1;
        } else {
            $this->db->trans_commit();
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']="Punch Has Been Registered";
            create_notes($employeeid,'1','Punch Has Been Registered Type- '.$entrytype.' Punch Time- '.$currenttime ,$employeeid);
            return $data1;
        }

    }

    public function api_employee_sync_attendance($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid,$entrytype,$difference,$latitudes,$longitudes,$locations,$qrresult,$timestamp,$radius,$islocation){
        $etypr = $entrytype;
        $elc = $locations;
        $elt = $latitudes;
        $elg = $longitudes;
        if(count($difference)>0){
            $desc = implode(',', $difference) . ' Key/Keys Missing Please Check';
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        if($attendancedate != DBD){
            $desc = 'Please Send Current Date Only';
            create_notes($employeeid,'2',$desc.' Actual- '.DBD.' Recevied- '.$attendancedate.' Type- '.$entrytype ,$employeeid);
            $message="Failed";
            $statuscode="500";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        $this->db->trans_begin();
        $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime,mxcp_firsthalf_gracetime,mxcp_secondhalf_gracetime');
        $this->db->from('maxwell_company_master');
        $this->db->where('mxcp_status = 1');
        $this->db->where('mxcp_id',$companyid);
        $query = $this->db->get();
        $qry = $query->result();
        // rolback
        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
        $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
        // $firsthalf_gracetime = '05';
        // $secondhalf_gracetime = '05';
        // echo $secondhalf;
        // echo $secondhalftime;
        $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
          
        $this->db->select('mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type,mx_attendance_latitude,mx_attendance_longitude,mx_attendance_location');
        $this->db->from($tablename);
        $this->db->where('mx_attendance_cmp_id', $companyid);
        $this->db->where('mx_attendance_division_id', $divisionid);
        $this->db->where('mx_attendance_state_id', $stateid);
        $this->db->where('mx_attendance_branch_id', $branchid);
        $this->db->where('mx_attendance_emp_code', $employeeid);
        $this->db->where('mx_attendance_date', $attendancedate);
        $this->db->where('mx_attendance_id', $attendance_uniqid);
        $query1 = $this->db->get();
        //echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();
         if($num ==1){
            if(empty($qry1[0]->mx_attendance_latitude)){
                $latitude = $latitudes;
            }else{
                $latitude = $qry1[0]->mx_attendance_latitude .','. $latitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_longitude)){
                $longitude = $longitudes;
            }else{
                $longitude = $qry1[0]->mx_attendance_longitude .','. $longitudes;
            }
            
            if(empty($qry1[0]->mx_attendance_location)){
                $location = $locations;
            }else{
                $location = $qry1[0]->mx_attendance_location .'*+*+*'. $locations;
            }
            
            $currenttime = date('H:i',strtotime($timestamp));
            // First Half Punches
            if(strtotime($currenttime) <= strtotime($qry[0]->mxcp_secondbreak_time)){
                if(empty($qry1[0]->mx_attendance_first_half_punch)){
                    $punchtime = date('H:i:s',strtotime($timestamp));
                    if(empty($qry1[0]->mx_attendance_entry_type)){
                        $type = $entrytype;
                    }else{
                        $type = ','. $entrytype;
                    }
                }else{
                    $punchtime = $qry1[0]->mx_attendance_first_half_punch .','. date('H:i:s',strtotime($timestamp));
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type . $type .'-'. date('H:i:s',strtotime($timestamp));
                $uparray = array("mx_attendance_first_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracefirst = $this->add_grace_calculator($firsthalf_gracetime,$qry[0]->mxcp_firsthalf_time);
                // if(strtotime($currenttime) <= strtotime($gracefirst)){
                //     $uparray["mx_attendance_first_half"] = "PR"; 
                // }
                // Skip if Sunday
                if (date('w', strtotime($attendancedate)) == 0) {
                    // Sunday, do nothing
                } else {
                    if (strtotime($currenttime) <= strtotime($gracefirst)) {
                        $uparray["mx_attendance_first_half"] = "PR";
                    }
                }
                $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $uparray);
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                  'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => $timestamp,
                  'company' => $companyid,
                  'division' => $divisionid,
                  'state' => $stateid,
                  'branch' => $branchid,
                  'entry_type' => $etypr,
                  'location' => $elc,
                  'latitudes' => $elt,
                  'longitudes' => $elg,
                  'radius' => $radius,
                  'islocation' => $islocation,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
            }
            // End Of First Half Punches
            // Second Half Punches
            if(strtotime($currenttime) > strtotime($qry[0]->mxcp_secondbreak_time)){
                if(empty($qry1[0]->mx_attendance_second_half_punch)){
                    $punchtime = date('H:i:s',strtotime($timestamp));
                    if(empty($qry1[0]->mx_attendance_entry_type)){
                        $type = $entrytype;
                    }else{
                        $type = ','. $entrytype;
                    }
                }else{
                    $punchtime = $qry1[0]->mx_attendance_second_half_punch .','. date('H:i:s',strtotime($timestamp));
                    $type = ','. $entrytype;
                }
                $entry_type = $qry1[0]->mx_attendance_entry_type .$type.'-'. date('H:i:s',strtotime($timestamp));
                $fparray = array("mx_attendance_second_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
                $gracesecond = $this->add_grace_calculator($secondhalf_gracetime,$qry[0]->mxcp_secondhalf_time);
                if(strtotime($currenttime) <= strtotime($gracesecond)){
                    $fparray["mx_attendance_second_half"] = "PR"; 
                }
                $this->db->where("mx_attendance_id", $attendance_uniqid);
                $this->db->where("mx_attendance_emp_code", $employeeid);
                $this->db->where("mx_attendance_date", $attendancedate);
                $res = $this->db->update($tablename, $fparray);
                // punches tracking
                $takeyear = date('Y',strtotime($attendancedate));
                $log = array(
                  'employee_code' => $employeeid,
                  'attendance_date' => $attendancedate,
                  'attendance_uniqid' => $attendance_uniqid,
                  'attendance_time' => $timestamp,
                  'company' => $companyid,
                  'division' => $divisionid,
                  'state' => $stateid,
                  'branch' => $branchid,
                  'entry_type' => $etypr,
                  'location' => $elc,
                  'latitudes' => $elt,
                  'longitudes' => $elg,
                  'radius' => $radius,
                  'islocation' => $islocation,
                  'createdby' => 'AUTO',
                  'createdtime' => DBDT,
                );
                
                $punclogtable = 'employee_punches_'. $takeyear . '';
                $this->db->insert($punclogtable, $log);
                // punches tracking
            }
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist And Please Check Employee";
            create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
            return $data1;
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message="Failed";
            $statuscode="500";
            $desc = "data_rollback";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']=$desc;
             create_notes($employeeid,'2',$desc.' Type- '.$entrytype ,$employeeid);
            return $data1;
        } else {
            $this->db->trans_commit();
            $message="Success";
            $statuscode="200";
            $data1['status']=$statuscode;
            $data1['msg']=$message;
            $data1['description']='';
            $data1['employee_attendance_history']="Sync Has Been Registered";
            create_notes($employeeid,'1','Sync Has Been Registered Type- '.$entrytype.' Punch Time- '.$currenttime ,$employeeid);
            return $data1;
        }

    }
    
    public function api_employee_daywise_punches($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid){

        $month = date('m',strtotime($attendancedate));
        $year = date('Y',strtotime($attendancedate));
        if (strlen($month) == 1) {
            $month = '0' . $this->cleanInput($data['month']);
        }
        $tablename = 'employee_punches_' . $year;
          
        $this->db->select('attendance_time,entry_type');
        $this->db->from($tablename);
        $this->db->where('company', $companyid);
        $this->db->where('division', $divisionid);
        $this->db->where('state', $stateid);
        $this->db->where('branch', $branchid);
        $this->db->where('employee_code', $employeeid);
        $this->db->where('attendance_date', $attendancedate);
        $this->db->where('attendance_uniqid', $attendance_uniqid);
        $arn = array('CRON');
        $this->db->where_not_in('entry_type', $arn);
        $this->db->order_by('attendance_time');
        $query1 = $this->db->get();
        // echo $this->db->last_query();exit;
        // rolback
        $qry1 = $query1->result();
        $num = $query1->num_rows();
        $display_punches = array();
         if($num >= 1){
             foreach ($qry1 as $key => $val){
                  $x = array('time' => ($val->attendance_time .' '.$val->entry_type),'type' => $val->entry_type);
                array_push($display_punches, $x);
             }
            //  if(!empty($qry1[0]->mx_attendance_first_half_punch) && !empty($qry1[0]->mx_attendance_second_half_punch)){
            //      $punchtime = $qry1[0]->mx_attendance_first_half_punch .','.$qry1[0]->mx_attendance_second_half_punch;
            //      $all = explode(",",$punchtime);
            //      if(count($all) > 1){
            //          foreach($all as $key => $val){
            //              $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }else{
            //          $all = array($punchtime);
            //         foreach($all as $key => $val){
            //             $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }
            //  }elseif(!empty($qry1[0]->mx_attendance_first_half_punch) && empty($qry1[0]->mx_attendance_second_half_punch)){
            //      $punchtime = $qry1[0]->mx_attendance_first_half_punch;
            //      $all = explode(",",$punchtime);
            //      if(count($all) > 1){
            //         foreach($all as $key => $val){
            //             $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }else{
            //          $all = array($punchtime);
            //         foreach($all as $key => $val){
            //             $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }
            //  }elseif(empty($qry1[0]->mx_attendance_first_half_punch) && !empty($qry1[0]->mx_attendance_second_half_punch)){
            //      $punchtime = $qry1[0]->mx_attendance_second_half_punch;
            //      $all = explode(",",$punchtime);
            //      if(count($all) > 1){
            //         foreach($all as $key){
            //             $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }else{
            //          $all = array($punchtime);
            //         foreach($all as $key => $val){
            //             $x = array('time' => $val);
            //              array_push($display_punches, $x);
            //          }
            //      }
            //  }
             
            //  print_r($all);
            
            // $message="Success";
            // $statuscode="200";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']='';
            // $data1['employee_attendance_punches']="Sync Has Been Registered";
            $data1 = $display_punches;
            return $data1;
        }else{
            // $message="Failed";
            // $statuscode="500";
            // $desc = "No Data Exist And Please Check Employee";
            // $data1['status']=$statuscode;
            // $data1['msg']=$message;
            // $data1['description']=$desc;
            $data1 = $display_punches;
            return $data1;
        }
        

        

    }
    // public function api_employee_manual_attendance($employeeid,$attendance_uniqid,$attendancedate,$companyid,$divisionid,$stateid,$branchid,$entrytype,$difference,$latitudes,$longitudes,$locations,$qrresult){
    //     if(count($difference)>0){
    //         $desc = implode(',', $difference) . ' Key/Keys Missing Please Check';
    //         $message="Failed";
    //         $statuscode="500";
    //         $data1['status']=$statuscode;
    //         $data1['msg']=$message;
    //         $data1['description']=$desc;
    //         return $data1;
    //     }
    //     if($attendancedate != DBD){
    //         $desc = 'Please Send Current Date Only';
    //         $message="Failed";
    //         $statuscode="500";
    //         $data1['status']=$statuscode;
    //         $data1['msg']=$message;
    //         $data1['description']=$desc;
    //         return $data1;
    //     }
    //     $this->db->trans_begin();
    //     $this->db->select('mxcp_firsthalf_time,mxcp_secondhalf_time,mxcp_logoff_time,mxcp_secondbreak_time,mxcp_secondbreak_endtime');
    //     $this->db->from('maxwell_company_master');
    //     $this->db->where('mxcp_status = 1');
    //     $this->db->where('mxcp_id',$companyid);
    //     $query = $this->db->get();
    //     $qry = $query->result();
    //     // rolback
    //     $month = date('m',strtotime($attendancedate));
    //     $year = date('Y',strtotime($attendancedate));
    //     if (strlen($month) == 1) {
    //         $month = '0' . $this->cleanInput($data['month']);
    //     }
    //     // $firsthalf_gracetime = $qry[0]->mxcp_firsthalf_gracetime;
    //     // $secondhalf_gracetime = $qry[0]->mxcp_secondhalf_gracetime;
    //     $firsthalf_gracetime = '05';
    //     $secondhalf_gracetime = '05';
    //     // echo $secondhalf;
    //     // echo $secondhalftime;
    //     $tablename = 'maxwell_attendance_' . $year . '_' . $month . '';
          
    //     $this->db->select('mx_attendance_emp_code,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_entry_type,mx_attendance_latitude,mx_attendance_longitude,mx_attendance_location');
    //     $this->db->from($tablename);
    //     $this->db->where('mx_attendance_cmp_id', $companyid);
    //     $this->db->where('mx_attendance_division_id', $divisionid);
    //     $this->db->where('mx_attendance_state_id', $stateid);
    //     $this->db->where('mx_attendance_branch_id', $branchid);
    //     $this->db->where('mx_attendance_emp_code', $employeeid);
    //     $this->db->where('mx_attendance_date', $attendancedate);
    //     $this->db->where('mx_attendance_id', $attendance_uniqid);
    //     $query1 = $this->db->get();
    //     // rolback
    //     $qry1 = $query1->result();
    //     if($qry1[0]->mx_attendance_emp_code == $employeeid){
            
    //         if(empty($qry1[0]->mx_attendance_latitude)){
    //             $latitude = $latitudes;
    //         }else{
    //             $latitude = $qry1[0]->mx_attendance_latitude .','. $latitudes;
    //         }
            
    //         if(empty($qry1[0]->mx_attendance_longitude)){
    //             $longitude = $longitudes;
    //         }else{
    //             $longitude = $qry1[0]->mx_attendance_longitude .','. $longitudes;
    //         }
            
    //         if(empty($qry1[0]->mx_attendance_location)){
    //             $location = $locations;
    //         }else{
    //             $location = $qry1[0]->mx_attendance_location .'*+*+*'. $locations;
    //         }
            
    //         $currenttime = CURRENTTIME;
    //         // First Half Punches
    //         if(strtotime($currenttime) <= strtotime($qry[0]->mxcp_firsthalf_time) || strtotime($currenttime) <= strtotime($qry[0]->mxcp_secondbreak_time)){
    //             if(empty($qry1[0]->mx_attendance_first_half_punch)){
    //                 $punchtime = CURRENTTIMESECONDS;
    //                 $type = $entrytype;
    //             }else{
    //                 $punchtime = $qry1[0]->mx_attendance_first_half_punch .','. CURRENTTIMESECONDS;
    //                 $type = ','. $entrytype;
    //             }
    //             $entry_type = $qry1[0]->mx_attendance_entry_type . $type .'-'. CURRENTTIMESECONDS;
    //             $uparray = array("mx_attendance_first_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
    //             $this->db->where("mx_attendance_id", $attendance_uniqid);
    //             $this->db->where("mx_attendance_emp_code", $employeeid);
    //             $this->db->where("mx_attendance_date", $attendancedate);
    //             $res = $this->db->update($tablename, $uparray);
    //             // rolback
    //             if($res == 1){
    //                 $this->db->select('mx_attendance_first_half_punch,mx_attendance_second_half_punch');
    //                 $this->db->from($tablename);
    //                 $this->db->where('mx_attendance_cmp_id', $companyid);
    //                 $this->db->where('mx_attendance_division_id', $divisionid);
    //                 $this->db->where('mx_attendance_state_id', $stateid);
    //                 $this->db->where('mx_attendance_branch_id', $branchid);
    //                 $this->db->where('mx_attendance_emp_code', $employeeid);
    //                 $this->db->where('mx_attendance_date', $attendancedate);
    //                 $this->db->where('mx_attendance_id', $attendance_uniqid);
    //                 $query2 = $this->db->get();
    //                 // rolback
    //                 $qry2 = $query2->result();
    //                 if(!empty($qry2[0]->mx_attendance_first_half_punch)){
    //                     $punchtime = $qry2[0]->mx_attendance_first_half_punch;
    //                     $getallpunches = explode(',', $punchtime);
    //                     if(count($getallpunches) > 1){
    //                         $userfirstpunch = strtotime($getallpunches[0]);
    //                         $officetime = $qry[0]->mxcp_firsthalf_time.':00';
    //                         $officestarttime = strtotime($officetime);
    //                         if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
    //                             $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
    //                         }else{ // Employee late time take first punch
    //                             $userfirstpunch = $getallpunches[0];
    //                         }
    //                         $userlastpunch = $getallpunches[count($getallpunches) - 1];
    //                         $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
    //                         if($totalhours >= 4){
    //                             $firsthalf = 'PR';
    //                         }else{
    //                             $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
    //                             $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
    //                             if($totalhoursgr >= 4){
    //                                 $firsthalf = 'PR';
    //                                 $farray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
    //                             }else{
    //                                 $firsthalf = 'AB';
    //                             }
    //                         }
    //                         $farray['mx_attendance_first_half'] = $firsthalf;
    //                         $this->db->where("mx_attendance_id", $attendance_uniqid);
    //                         $this->db->where("mx_attendance_emp_code", $employeeid);
    //                         $this->db->where("mx_attendance_date", $attendancedate);
    //                         $resf = $this->db->update($tablename, $farray);
    //                         // rolback
    //                     }
    //                 }
    //             }
    //         }
    //         // End Of First Half Punches
    //         // Second Half Punches
    //         if(strtotime($currenttime) > strtotime($qry[0]->mxcp_secondbreak_time) || strtotime($currenttime) >= strtotime($qry[0]->mxcp_secondhalf_time)){
    //             if(empty($qry1[0]->mx_attendance_second_half_punch)){
    //                 $punchtime = CURRENTTIMESECONDS;
    //                 if(empty($qry1[0]->mx_attendance_entry_type)){
    //                     $type = $entrytype;
    //                 }else{
    //                     $type = ','. $entrytype;
    //                 }
    //             }else{
    //                 $punchtime = $qry1[0]->mx_attendance_second_half_punch .','. CURRENTTIMESECONDS;
    //                 $type = ','. $entrytype;
    //             }
    //             $entry_type = $qry1[0]->mx_attendance_entry_type .$type.'-'. CURRENTTIMESECONDS;
    //             $uparray = array("mx_attendance_second_half_punch"=>$punchtime,"mx_attendance_entry_type"=>$entry_type,"mx_attendance_latitude" => $latitude, "mx_attendance_longitude" => $longitude, "mx_attendance_location" => $location);
    //             $this->db->where("mx_attendance_id", $attendance_uniqid);
    //             $this->db->where("mx_attendance_emp_code", $employeeid);
    //             $this->db->where("mx_attendance_date", $attendancedate);
    //             $res = $this->db->update($tablename, $uparray);
    //             // rolback
    //             if($res == 1){
    //                 $this->db->select('mx_attendance_first_half_punch,mx_attendance_second_half_punch');
    //                 $this->db->from($tablename);
    //                 $this->db->where('mx_attendance_cmp_id', $companyid);
    //                 $this->db->where('mx_attendance_division_id', $divisionid);
    //                 $this->db->where('mx_attendance_state_id', $stateid);
    //                 $this->db->where('mx_attendance_branch_id', $branchid);
    //                 $this->db->where('mx_attendance_emp_code', $employeeid);
    //                 $this->db->where('mx_attendance_date', $attendancedate);
    //                 $this->db->where('mx_attendance_id', $attendance_uniqid);
    //                 $query2 = $this->db->get();
    //                 $qry2 = $query2->result();
    //                 // rolback
    //                 // START Employee Having Two Punches In First Half and Second Half Also
    //                 // checking for the first half punches are there are not. if there, go to if and combine first and second half punches
    //                 if(!empty($qry2[0]->mx_attendance_first_half_punch) && !empty($qry2[0]->mx_attendance_second_half_punch)){
    //                     $punchtime = $qry2[0]->mx_attendance_first_half_punch .','.$qry2[0]->mx_attendance_second_half_punch;
    //                     $getallpunches = explode(',', $punchtime);
    //                     $userfirstpunch = strtotime($getallpunches[0]);
    //                     $officetime = $qry[0]->mxcp_firsthalf_time.':00';
    //                     $officestarttime = strtotime($officetime);
    //                     if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
    //                         $userfirstpunch = $qry[0]->mxcp_firsthalf_time;
    //                     }else{ // Employee late time take first punch
    //                         $userfirstpunch = $getallpunches[0];
    //                     }
    //                     $userlastpunch = strtotime($getallpunches[count($getallpunches) - 1]);
    //                     $officeend = $qry[0]->mxcp_logoff_time.':00';
    //                     $officeendtime = strtotime($officeend);
    //                     if($officeendtime <= $userlastpunch){ // Checking The Employee Last Punch Ontime Or Overtime
    //                         // Check For First Half Punch
    //                         $breakstarttime = $qry[0]->mxcp_secondbreak_time.':00';
    //                         $officestarttime = $qry[0]->mxcp_firsthalf_time.':00';
    //                         if (strtotime($userfirstpunch) <= strtotime($breakstarttime) && strtotime($userfirstpunch) >= strtotime($officestarttime)){ // Checking The First Punch Should Be In First Half Or Not
    //                             $userlastpunch = $breakstarttime;
    //                             $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
    //                             if($totalhours >= 4){
    //                                 $firsthalf = 'PR';
    //                             }else{
    //                                 // $firsthalf = 'AB';
    //                                 $getgrace = $this->grace_calculator($firsthalf_gracetime,$userfirstpunch);
    //                                 $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
    //                                 if($totalhoursgr >= 4){
    //                                     $firsthalf = 'PR';
    //                                     $parray['mx_attendance_first_half_grace_time'] = $firsthalf_gracetime;
    //                                 }else{
    //                                     $firsthalf = 'AB';
    //                                 }
    //                             }
    //                         }
    //                         // Check For First Half Punch
    //                         // Check For The Second Half Punch 
    //                         $breakendtime = $qry[0]->mxcp_secondbreak_endtime;
    //                         $userlastpunch = $getallpunches[count($getallpunches) - 1];
    //                         if(strtotime($userfirstpunch) <= strtotime($breakendtime) && strtotime($userlastpunch) >= $officeendtime){
    //                             // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
    //                             if($officeendtime < strtotime($userlastpunch)){ 
    //                                 $userlastpunch = $qry[0]->mxcp_logoff_time.':00';
    //                                 $userfirstpunch = $qry[0]->mxcp_secondhalf_time.':00';
    //                                 $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
    //                                 if($totalhours >= 4){
    //                                     $secondhalf = 'PR';
    //                                 }else{
    //                                     // $secondhalf = 'AB';
    //                                     $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
    //                                     $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
    //                                     if($totalhoursgr >= 4){
    //                                         $secondhalf = 'PR';
    //                                         $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
    //                                     }else{
    //                                         $secondhalf = 'AB';
    //                                     }
    //                                 }
    //                             }
    //                             // Employee Logofftime Is Greater Than The Office Time Then Take Office Logoff Time As Employee Last Punch Time
    //                         }
    //                         // Check For The Second Half Punch
    //                         if($firsthalf == 'AB' || $firsthalf == 'PR'){
    //                             $parray['mx_attendance_first_half'] = $firsthalf;
    //                         }
    //                         if($secondhalf == 'AB' || $secondhalf == 'PR'){
    //                             $parray['mx_attendance_second_half'] = $secondhalf;
    //                         }
    //                         $this->db->where("mx_attendance_id", $attendance_uniqid);
    //                         $this->db->where("mx_attendance_emp_code", $employeeid);
    //                         $this->db->where("mx_attendance_date", $attendancedate);
    //                         $ress = $this->db->update($tablename, $parray);
    //                         // rolback
    //                         // print_r($parray);
    //                     }else{
    //                       // Need to add first half present in this case if employee want to leave after the office grean than the breakend time
    //                         $punchtime = $qry2[0]->mx_attendance_first_half_punch;
    //                         $getallpunches = explode(',', $punchtime);
    //                         $userfirstpunch = $getallpunches[0];

    //                         $punchtime2 = $qry2[0]->mx_attendance_second_half_punch;
    //                         $getallpunches2 = explode(',', $punchtime2);
    //                         $userlastpunch = $getallpunches2[count($getallpunches2) - 1];

    //                         $officetime = $qry[0]->mxcp_firsthalf_time.':00';
    //                         $gracetime = "+".$firsthalf_gracetime." minutes";
    //                         $officesttime = strtotime($officetime);
    //                         $officestarttime = date("H:i:s", strtotime($gracetime, $officesttime));
    //                         $officeopentime = strtotime($officestarttime);
    //                         if(strtotime($officeopentime) >= strtotime($userfirstpunch)){
    //                             $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
    //                             if($totalhours >= 4){
    //                                 $firsthalf = 'PR';
    //                                 $pfsarray['mx_attendance_first_half'] = $firsthalf; 
    //                                 $this->db->where("mx_attendance_id", $attendance_uniqid);
    //                                 $this->db->where("mx_attendance_emp_code", $employeeid);
    //                                 $this->db->where("mx_attendance_date", $attendancedate);
    //                                 $ress = $this->db->update($tablename, $pfsarray);     
    //                             }    
    //                         }
    //                     }
    //                 }
    //                 // END Employee Having Two Punches In First Half and Second Also

    //                 // START Employee SecondHalf Punches Only
    //                 if(!empty($qry2[0]->mx_attendance_second_half_punch) && empty($qry2[0]->mx_attendance_first_half_punch)){
    //                     $punchtime = $qry2[0]->mx_attendance_second_half_punch;
    //                     $getallpunches = explode(',', $punchtime);
    //                     if(count($getallpunches) > 1){
    //                         $userfirstpunch = strtotime($getallpunches[0]);
    //                         $officetime = $qry[0]->mxcp_secondhalf_time.':00';
    //                         $officestarttime = strtotime($officetime);
    //                         if($userfirstpunch <= $officestarttime){ // Employee on time take office starting hour
    //                             $userfirstpunch = $qry[0]->mxcp_secondhalf_time;
    //                         }else{ // Employee late time take first punch
    //                             $userfirstpunch = $getallpunches[0];
    //                         }
    //                         $userlastpunch = $getallpunches[count($getallpunches) - 1];
    //                         $totalhours = $this->calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate);
    //                         if($totalhours >= 4){
    //                             $secondhalf = 'PR';
    //                             $psarray['mx_attendance_second_half'] = $secondhalf;
    //                         }else{
    //                             // $secondhalf = 'AB';
    //                                 $getgrace = $this->grace_calculator($secondhalf_gracetime,$userfirstpunch);
    //                                 $totalhoursgr = $this->calculatetotalworkinghours($getgrace,$userlastpunch,$attendancedate);
    //                                 if($totalhoursgr >= 4){
    //                                     $secondhalf = 'PR';
    //                                     $parray['mx_attendance_second_half_grace_time'] = $secondhalf_gracetime;
    //                                 }else{
    //                                     $secondhalf = 'AB';
    //                                 }
    //                             $psarray['mx_attendance_second_half'] = $secondhalf;
    //                         }
    //                         // echo $firsthalf;
    //                         $this->db->where("mx_attendance_id", $attendance_uniqid);
    //                         $this->db->where("mx_attendance_emp_code", $employeeid);
    //                         $this->db->where("mx_attendance_date", $attendancedate);
    //                         $reps = $this->db->update($tablename, $psarray);
    //                         // rolback
    //                     }
    //                 }
    //                 // END Employee SecondHalf Punches Only

    //         }
    //     }
    // }else{
    //     $message="Failed";
    //     $statuscode="500";
    //     $desc = "No Data Exist";
    //     $data1['status']=$statuscode;
    //     $data1['msg']=$message;
    //     $data1['description']=$desc;
    //     return $data1;
    // }
    // if ($this->db->trans_status() === FALSE) {
    //     $this->db->trans_rollback();
    //     $message="Failed";
    //     $statuscode="500";
    //     $desc = "data_rollback";
    //     $data1['status']=$statuscode;
    //     $data1['msg']=$message;
    //     $data1['description']=$desc;
    //     return $data1;
    // } else {
    //     $this->db->trans_commit();
    //     $message="Success";
    //     $statuscode="200";
    //     $data1['status']=$statuscode;
    //     $data1['msg']=$message;
    //     $data1['description']='';
    //     $data1['employee_attendance_history']="Punch Has Been Registered";
    //     return $data1;
    // }

    // }

    public function calculatetotalworkinghours($userfirstpunch,$userlastpunch,$attendancedate){
        $firstpunch = $attendancedate.' '.$userfirstpunch;
        $lastpunch = $attendancedate.' '.$userlastpunch;
        // $d1 = strtotime($firstpunch);
        // $d2 = strtotime($lastpunch);
        // $totalSecondsDiff = abs($d1-$d2); //42600225
        // $totalMinutesDiff = $totalSecondsDiff/60; //710003.75
        // $totalHoursDiff   = $totalSecondsDiff/60/60;//11833.39
        // $totalDaysDiff    = $totalSecondsDiff/60/60/24; //493.05
        // $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30; //16.43
        // $totalYearsDiff   = $totalSecondsDiff/60/60/24/365; //1.35  
        // return abs($totalHoursDiff);
        $d1 = new DateTime($firstpunch);
        $d2 = new DateTime($lastpunch);
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1
        return $diffInHours;
    }
    
    public function add_grace_calculator($gracetime,$officetime){
        $grace=$gracetime;
         $gracetime = "+".$grace." minutes";
         $officetime = strtotime($officetime);
        return $finaltime= date("H:i:s", strtotime($gracetime, $officetime));
    } 
    
    public function grace_calculator($gracetime,$userfirstpunch){
        $grace=$gracetime;
         $gracetime = "-".$grace." minutes";
         $userfirstpunch = strtotime($userfirstpunch);
        return $finaltime= date("H:i:s", strtotime($gracetime, $userfirstpunch));
    } 
    
    public function attendance_regulation_checker($employeeid,$from,$to,$companyid,$divisionid,$stateid,$branchid,$type,$category_type)
    {
        $this->db->select('mxar_appliedby_emp_code as employeeid');
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_appliedby_emp_code',$employeeid);
        $this->db->where("mxar_from BETWEEN '$from' AND '$to' ");
        $this->db->where("mxar_to BETWEEN '$from' AND '$to' ");
        $this->db->where('mxar_status','1');
        $this->db->where('mxar_category_type',$category_type);
        // $this->db->where('mxar_type',$type);
        $this->db->where('mxar_category_type !=',3);
        $query= $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    //-----------NEW BY SHABABU(16-04-2022)
    public function validate_doj($from,$emp_id){
        $this->db->select('mxemp_emp_id,mxemp_emp_date_of_join');
        $this->db->from('maxwell_employees_info');
        $this->db->where('mxemp_emp_id',$emp_id);
        $this->db->where('mxemp_emp_date_of_join <=',$from);
        $this->db->where('mxemp_emp_status','1');
        $query= $this->db->get();
        $result = $query->result();
        // echo $this->db->last_query(); die;
        if(count($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }
    //-----------END NEW BY SHABABU(16-04-2022)
    
   /* public function attendance_regulation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc){
       
        $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
        $this->db->where('mxauth_emp_code',$employeeid);
        // $this->db->where('mxauth_auth_type !=',3);
        $this->db->where('mxauth_status',1);
        // $this->db->orderby('mxauth_auth_type','asc');
        $query= $this->db->get();
        $result = $query->result_array();
        
        $data = array(
            'mxar_comp_id'=>$companyid,
            'mxar_div_id'=>$divisionid,
            'mxar_state_id'=>$stateid,
            'mxar_branch_id'=>$branchid,
            'mxar_category_type'=>$category_type,
            'mxar_appliedby_emp_code'=>$employeeid,
            'mxar_intime'=>$intime,
            'mxar_outtime'=>$outtime,
            'mxar_from'=>$from,
            'mxar_to'=>$to,
            'mxar_attend_countdays'=>$noofdays,
            'mxar_reason'=>$reason,
            'mxar_desc'=>$emp_desc,
            'mxar_device_status'=>$device_status,
        );

        foreach($result as $key =>$authval){
            if($key == 0){  
                if($authval['mxauth_auth_type'] == 3){
                    $data['mxar_authfinal_empcode']=$authval['employeeid'];
                    $data['mxar_authfinal_empname']=$authval['employeename'];
            }else{
                $data['mxar_auth1_empcode'] = $authval['employeeid'];
                $data['mxar_auth1_empname'] = $authval['employeename'];
            }
            }elseif($key ==1 ){
                if($authval['mxauth_auth_type'] == 3){
                    $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                    $data['mxar_authfinal_empname'] = $authval['employeename'];
                }else{
                    $data['mxar_auth2_empcode'] = $authval['employeeid'];
                    $data['mxar_auth2_empname'] = $authval['employeename'];
                }
            }elseif($key == 2){
                if($authval['mxauth_auth_type'] == 3){
                    $data['mxar_authfinal_empcode']=$authval['employeeid'];
                    $data['mxar_authfinal_empname']=$authval['employeename'];
                }else{
                $data['mxar_auth3_empcode'] = $authval['employeeid'];
                $data['mxar_auth3_empname'] = $authval['employeename'];
                }
            }elseif($key == 3){
                if($authval['mxauth_auth_type'] == 3){
                    $data['mxar_authfinal_empcode']=$authval['employeeid'];
                    $data['mxar_authfinal_empname']=$authval['employeename'];
                }else{
                    $data['mxar_auth4_empcode'] = $authval['employeeid'];
                    $data['mxar_auth4_empname'] = $authval['employeename'];
                }
            }
        }
        $this->db->insert('attendance_regulation',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
        //  echo $this->db->last_query(); die;
    } */
    
    public function attendance_regulation($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$type,$div_ot,$state_ot,$branch_ot,$cl_company,$cl_contact_person,$cl_contact_number,$cl_contact_email,$cl_description){
        $qry=[]; 
        
        $date_test = $this->validation_check_days($from,$to,'regularize_day','AR');
        // print_r($date_test); exit;
        if($date_test == 0){
            $message="Failed";
            $statuscode="500";
            $desc='Attendance closed from the date '.$from; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }

        $cym_attend=date('Y_m',strtotime($from));
        $cym_attend_date=date('Y-m-d',strtotime($from));
        
        if (in_array($type, ['AR', 'OT'], true)) {

            $this->db->select('mx_attendance_first_half,mx_attendance_second_half');  
            $this->db->from('maxwell_attendance_'.$cym_attend);              
            $this->db->where('mx_attendance_status', 1);
            $this->db->where('mx_attendance_emp_code', $employeeid);
            $this->db->where('mx_attendance_date', $cym_attend_date);
        
            $query = $this->db->get();
            $att_dt_validate = $query->result_array();
        
            $validationarray = ['WO', 'PH'];
        
            if (count($att_dt_validate) > 0) {
        
                foreach ($att_dt_validate as $row) {
        
                    if (
                        in_array($row['mx_attendance_first_half'], $validationarray, true) ||
                        in_array($row['mx_attendance_second_half'], $validationarray, true)
                    ) {
        
                        $message = "Failed";
                        $statuscode = "500";
                        $desc = 'Regulation cannot be applied on public holidays or weekly offs';
        
                        $data['status'] = $statuscode;
                        $data['msg'] = $message;
                        $data['description'] = $desc;
        
                        return $data;
                    }
                }
            }
        }
        
        if($type == 'AR'){
            $this->db->select('mx_attendance_id as uniqid,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_emp_code,mx_attendance_date');  
            $this->db->from('maxwell_attendance_'.$cym_attend);              
            $this->db->where('mx_attendance_status',1);
            $this->db->where('mx_attendance_emp_code', $employeeid);
            $this->db->where('mx_attendance_date',$cym_attend_date);
            $query = $this->db->get();
            $att_dt_validate = $query->result_array();
    
            if(($att_dt_validate[0]['mx_attendance_first_half_punch'] == '') && ($att_dt_validate[0]['mx_attendance_second_half_punch'] == '')){
                $message="Failed";
                $statuscode="500";
                $desc='SELECT Minimum one punch is required to regularise, Plz contact HR dept through mail.'; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
        } 
        
        
        if($reason == 'LATE COMING TO OFFICE'){
            date_default_timezone_set('Asia/Kolkata');
            $currenttime = date('hi');
            // print_r($currenttime); exit;
            $blocktime = 1001;  
            $afterblocktime = 1301;
            if($blocktime < $currenttime && $afterblocktime > $currenttime && $reason == 'LATE COMING TO OFFICE'){
                $message="Failed";
                $statuscode="500";
                $desc='Late comming to office should be applied before 10:00 AM'; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
        }
        
        if( (date('m',strtotime($from))) != (date('m',strtotime($to))) ){
            $message="Failed";
            $statuscode="500";
            $desc='To different months cannot be applied'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        if ($from > $to) {
            $message="Failed";
            $statuscode="500";
            $desc='Please check from date to date correct'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
         }
        //  1 ->First Half  2 ->Secondhalf  3 -> fullday
        if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
            $message="Failed";
            $statuscode="500";
            $desc='We are unable to apply half day with two dates different dates';
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        
        
        $err_dates=array();
        $attendance_check_count=0;
        $attendance_regulation_checker_count=0;
            $attendance_regulation_checker = $this->attendance_regulation_checker($employeeid,$from,$to,$companyid,$divisionid,$stateid,$branchid,$type,$category_type);
            if(count($attendance_regulation_checker) > 0){
                $message="Failed";
                $statuscode="500";
                $desc='Already applied onduty for those days'; 
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']=$desc;
                return $data1;
            }else{
                $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
                $this->db->from('maxwell_emp_authorsations');
                $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
                $this->db->where('mxauth_emp_code',$employeeid);
                // $this->db->where('mxauth_auth_type !=',3);
                $this->db->where('mxauth_status',1);
                // $this->db->orderby('mxauth_auth_type','asc');
                $query= $this->db->get();
                $result = $query->result_array();
                // echo $this->db->last_query(); exit;
                $data = array(
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=>$from,
                    'mxar_to'=>$to,
                    'mxar_attend_countdays'=>$noofdays,
                    'mxar_reason'=>$reason,
                    'mxar_desc'=>$emp_desc,
                    'mxar_device_status'=>$device_status,
                    'mxar_createdby' =>$employeeid,
                    'mxar_createdtime' =>DBDT,
                    'mxar_created_ip' => '',
                    'mxar_type'=>$type,
                    'mxar_ot_div_id'=>$div_ot,
                    'mxar_ot_state_id'=>$state_ot,
                    'mxar_ot_branch_id'=>$branch_ot,
                    'mxar_client_company'=>$cl_company,
                    'mxar_client_contact_person'=>$cl_contact_person,
                    'mxar_client_contact_no'=>$cl_contact_number,
                    'mxar_client_contact_email'=>$cl_contact_email,
                    'mxar_client_desc'=>$cl_description
                );

                /*
                $x=0;
                foreach($result as $key =>$authval){
                    if($x == 0){  
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                    }else{
                        $data['mxar_auth1_empcode'] = $authval['employeeid'];
                        $data['mxar_auth1_empname'] = $authval['employeename'];
                        $x++;
                    }
                    }elseif($x ==1 ){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                            $data['mxar_authfinal_empname'] = $authval['employeename'];
                        }else{
                            $data['mxar_auth2_empcode'] = $authval['employeeid'];
                            $data['mxar_auth2_empname'] = $authval['employeename'];
                            $x++;
                        }
                    }elseif($x == 2){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                        $data['mxar_auth3_empcode'] = $authval['employeeid'];
                        $data['mxar_auth3_empname'] = $authval['employeename'];
                        $x++;
                        }
                    }elseif($x == 3){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth4_empcode'] = $authval['employeeid'];
                            $data['mxar_auth4_empname'] = $authval['employeename'];
                            $x++;
                        }
                    }
                }
                */
                $x = 1;
                foreach ($result as $authval) {
                    if ($authval['mxauth_auth_type'] == 3) {
                        $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                        $data['mxar_authfinal_empname'] = $authval['employeename'];
                    } else {
                        $data['mxar_auth'.$x.'_empcode'] = $authval['employeeid'];
                        $data['mxar_auth'.$x.'_empname'] = $authval['employeename'];
                        $x++;
                    }
                }
                $this->db->insert('attendance_regulation',$data);
                $res = ($this->db->affected_rows() != 1) ? false : true;
                if($res == 1){
                    $qry[]=array('statusmsg'=>'success have great day');
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    // $data1['msg']= $sucessmsg;
                    $data1['description']='';
                    $data1['attendance_regulation']=$qry;
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "Please check onceagain";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
        
            }
    }

    
    public function editattendance_regulation($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$type,$div_ot,$state_ot,$branch_ot,$cl_company,$cl_contact_person,$cl_contact_number,$cl_contact_email,$cl_description)
    {
        $cym_attend=date('Y_m',strtotime($from));
        $cym_attend_date=date('Y-m-d',strtotime($from));
       /*
        if($type == 'AR'){
            $this->db->select('mx_attendance_id as uniqid,mx_attendance_first_half_punch,mx_attendance_second_half_punch,mx_attendance_emp_code,mx_attendance_date');  
            $this->db->from('maxwell_attendance_'.$cym_attend);              
            $this->db->where('mx_attendance_status',1);
            $this->db->where('mx_attendance_emp_code', $employeeid);
            $this->db->where('mx_attendance_date',$cym_attend_date);
            $query = $this->db->get();
            $att_dt_validate = $query->result_array();
    
            if(($att_dt_validate[0]['mx_attendance_first_half_punch'] == '') || ($att_dt_validate[0]['mx_attendance_second_half_punch'] == '')){
                $message="Failed";
                $statuscode="500";
                $desc='Minimum one punch is required to regularise, Plz contact HR dept through mail.'; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
        }
        */
        
        if($reason == 'LATE COMING TO OFFICE'){
            date_default_timezone_set('Asia/Kolkata');
            $currenttime = date('hi');
            $blocktime = 1001;  
            $afterblocktime = 1301;
            if($blocktime < $currenttime && $afterblocktime > $currenttime && $reason == 'LATE COMING TO OFFICE'){
                $message="Failed";
                $statuscode="500";
                $desc='Late comming to office should be applied before 10:00 AM'; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
        }    
        
        if( (date('m',strtotime($from))) != (date('m',strtotime($to))) ){
            $message="Failed";
            $statuscode="500";
            $desc='To different months cannot be applied'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        if ($from > $to) {
            $message="Failed";
            $statuscode="500";
            $desc='Please check from date to date correct'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
         }
        //  1 ->First Half  2 ->Secondhalf  3 -> fullday
        if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
            $message="Failed";
            $statuscode="500";
            $desc='We are unable to apply half day with two dates different dates';
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        
        $this->db->select("mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                            mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                            mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,
                            mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
                            mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            mxar_status as status , mxar_intime as intime , mxar_outtime as outtime");
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $attend_regu_uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        if( ($result[0]['auth1'] != 0) || ($result[0]['auth2']!= 0) || ($result[0]['auth3']!= 0) || ($result[0]['auth4']!= 0) || ($result[0]['authfinal']!= 9) ){
            if($result[0]['auth1']!= 0){ $naval = $result[0]['authempname1'];}
            if($result[0]['auth2']!= 0){ $naval .= $result[0]['authempname2'];}
            if($result[0]['auth3']!= 0){ $naval .= $result[0]['authempname3'];}
            if($result[0]['auth4']!= 0){ $naval .= $result[0]['authempname4'];}
            if($result[0]['authfinal']!= 0){ $naval .= $result[0]['authfinalempname'];}
            
            $message="Failed";
            $statuscode="500";
            $desc="Already accepted or rejected by " .$naval; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
    
        $this->db->select('mxar_appliedby_emp_code');
            $this->db->from('attendance_regulation');
            $this->db->where('mxar_appliedby_emp_code',$employeeid);
            $this->db->where("mxar_from BETWEEN '$from' AND '$to' ");
            $this->db->where("mxar_to BETWEEN '$from' AND '$to' ");
            $this->db->where_not_in('mxar_id ',$attend_regu_uniqid);
            $this->db->where('mxar_status','1');
            $this->db->where('mxar_type',$type);
            $query= $this->db->get();
            $result = $query->result();    
            if(count($result) >0){
                $message="Failed";
                $statuscode="500";
                $desc="Already with this days on-duty is applied"; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }   
            $daysrange = $this->date_rangewith_days($from,$to);
            $noofdays=$daysrange['noofday'];
            if((date('m',strtotime($from))) != (date('m',strtotime($to) ) )){
                $message="Failed";
                $statuscode="500";
                $desc="To different months cannot be applied"; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
           $data1 = array(
                'mxar_comp_id'=>$companyid,
                'mxar_div_id'=>$divisionid,
                'mxar_state_id'=>$stateid,
                'mxar_branch_id'=>$branchid,
                'mxar_category_type'=>$category_type,
                'mxar_appliedby_emp_code'=>$employeeid,
                'mxar_intime'=>$intime,
                'mxar_outtime'=>$outtime,
                'mxar_from'=>$from,
                'mxar_to'=>$to,
                'mxar_attend_countdays'=>$noofdays,
                'mxar_reason'=>$reason,
                'mxar_desc'=>$emp_desc,
                'mxar_device_status'=>$device_status,
                'mxar_emp_modifyby' => $employeeid,
                'mxar_emp_modifiedtime' => DBDT,
                'mxar_emp_modified_ip' => '',
                'mxar_type' => $type,
                'mxar_ot_div_id'=>$div_ot,
                'mxar_ot_state_id'=>$state_ot,
                'mxar_ot_branch_id'=>$branch_ot,
                'mxar_client_company'=>$cl_company,
                'mxar_client_contact_person'=>$cl_contact_person,
                'mxar_client_contact_no'=>$cl_contact_number,
                'mxar_client_contact_email'=>$cl_contact_email,
                'mxar_client_desc'=>$cl_description
            );
            $this->db->where('mxar_id', $attend_regu_uniqid);
            $res = $this->db->update('attendance_regulation',$data1);
            if($res == 1){
                    $data['status']=200;
                    $data['msg']='Success';
                    $data['description']='';
                    // $data['attendance_regulation']='Sucessfully Updated';
                    // $qry1 = array('statusmsg'=>'editattendance_regulation');
                      $qry1 = array('statusmsg'=>'success have great day');
                    $data['authapproval']=$qry1;
                return $data;
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='Something went wrong';
                return $data;
            }
    }

    function date_rangewith_days($fromdate,$todate){
        $begin = new DateTime( $fromdate );
        $end   = new DateTime( $todate );
        $dayscount=0;
        $result=array();
        $dates = array();
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            array_push($result,$i->format("Y-m-d"));
            $dayscount+=1;
        }
        $dates['noofday'] = $dayscount;
        $dates['attnddates'] = $result;
        return $dates;
    }
    
    public function deleteattendance_regulation($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid)
    {
        $naval = '';
        $this->db->select("mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
        mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
        mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,
        mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
        mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
        concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
        concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
        concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
        mxar_status as status , mxar_intime as intime , mxar_outtime as outtime");
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $attend_regu_uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        if(($result[0]['auth1'] !=0) || ($result[0]['auth2'] != 0) || ($result[0]['auth3'] != 0 ) || ($result[0]['auth4'] != 0 ) || ($result[0]['authfinal'] != 0) ){
            if($result[0]['auth1'] != 0 ){ $naval = $result[0]['authempname1'];}
            if($result[0]['auth2'] != 0 ){ $naval .=' '.$result[0]['authempname2'];}
            if($result[0]['auth3'] != 0 ){ $naval .=' '.$result[0]['authempname3'];}
            if($result[0]['auth4'] != 0){ $naval .=' '.$result[0]['authempname4'];}
            if($result[0]['authfinal'] != 0){ $naval .=' '. $result[0]['authfinalempname'];}
            $data['status']=500;
            $data['msg']='Failed';
            $data['description']="Already accepted by " .$naval . " so that unable to delete " ;
            return $data;
        } else{
            $data1 = array(
                'mxar_status'=>0,
                'mxar_emp_modifyby'=> $employeeid,
                'mxar_emp_modifiedtime'=> DBDT
                // 'mxar_emp_modified_ip'=>      
            );
            $this->db->where('mxar_id', $attend_regu_uniqid);
            $this->db->where('mxar_appliedby_emp_code', $employeeid);
            $res = $this->db->update('attendance_regulation',$data1);
            if($res==1){
                    $qry=array('statusmsg'=> 'Sucessfully Updated');
                    // $qry1['statusmsg']='Sucessfully Updated';
                    $data['status']=200;
                    $data['msg']='Success';
                    $data['description']='';
                    // $qry=$qry1;
                    $data['deleteattendance_regulation']=$qry;
                return $data;
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='Something went wrong';
                return $data;
            }
        }
    }

    public function allattendancelist($employeeid,$companyid,$divisionid,$stateid,$branchid,$filter,$monthyear,$filteremployeeid,$type,$status_type)
    {
        // if($type=='OT'){
        //     https://maxwelllogistics.net/maxwell_services/Mobile_service/api_getbranch
        // }
        
        if($status_type =='Approved'){
            $status_type = 1;
        }elseif($status_type =='Rejected'){
            $status_type = 2;
        }elseif($status_type =='Pending'){
            $status_type = 0;
        }else{
            $status_type = '';
        }
        
        if($monthyear == ''){
            $monthyear=date('Y-m');
        }else{
            $monthyear= date('Y-m',strtotime($monthyear));
        }
        
        $this->db->distinct();
        $this->db->select('mxauth_emp_code as empid'); 
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        $a=[];
        $employeeidval = $employeeid;
        if(count($cnt) > 0){
            array_push($a,$employeeid);
            foreach($cnt as $key=>$val1){  
                array_push($a,$val1['empid']);
            }
            $employeeid = array_values($a);
        }else{
              $employeeid = $employeeid;
        }   
        
        // $tblappdate=date('Y_m',strtotime())
        $pyear=date('Y');
        $this->db->select("(select min(attendance_time) as maxtime from employee_punches_$pyear where attendance_date= mxar_from and employee_code = mxar_appliedby_emp_code limit 1 ) as orgifirstpunchin,");
        $this->db->select("(select max(attendance_time) as maxtime from employee_punches_$pyear where attendance_date= mxar_from and employee_code = mxar_appliedby_emp_code limit 1 ) as orgilastpunchout,");
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_reason as reason,mxar_desc as emp_description,  
                            mxar_intime as intime , mxar_outtime as outtime,mxar_status as status ,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',if(mxar_hrfinal_acceptname IS NULL ,' ',mxar_hrfinal_acceptname)) as hrfinalempname ,mxar_hrfinal_accept as finalhracceptid,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,
                            if(mxar_authfinal_remarks IS NULL,'',mxar_authfinal_remarks) as authfinaldesc,
                            mxb_name as branchname, mxd_name as otdivname, '' as  otbranchname, mxst_state as otstatename, mxar_ot_branch_id
                            ,'' as first_half_punch,'' as second_half_punch,mxar_type as regulation_type,
                            mxar_client_company as cl_company,
                            mxar_client_contact_person as cl_contact_person,
                            mxar_client_contact_no as cl_contact_number,
                            mxar_client_contact_email as cl_contact_email,
                            mxar_client_desc as cl_description
                            ,mxar_ot_div_id as divisonid_ot,mxar_ot_state_id as stateid_ot,mxar_ot_branch_id as branchid_ot");
                            $this->db->from('attendance_regulation');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_division_master','mxd_id=mxar_ot_div_id','Left');
                            $this->db->join('maxwell_state_master','mxst_id=mxar_ot_state_id','Left');
                            $this->db->join('maxwell_branch_master','mxb_id=mxar_branch_id','Left');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)&& ($filter==1) ){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid)&& ($filter==1) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid)&& ($filter==1) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            // if(!empty($monthyear)&& ($filter==1) ){
                            if(!empty($monthyear)){
                                // $my = explode('-',$monthyear);
                                // $len = strlen($my[1]);
                                // if($len == 1){
                                //     $monthyear = $my[0].'-'.'0'.$my[1];
                                // }else{
                                //     // $monthyear =$monthyear;
                                //     $monthyear = date('Y-m', strtotime($monthyear));
                                // }
                                $this->db->where("DATE_FORMAT(mxar_createdtime,'%Y-%m')", $monthyear);
                                // $this->db->where("DATE_FORMAT(mxar_from,'%Y-%m')", $monthyear);
                            }
                            if($employeeid !=''){
                                 $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            if($filteremployeeid !=''){
                               $this->db->where('mxar_appliedby_emp_code', $filteremployeeid);
                            }
                            if($type != ''){
                                 $this->db->where('mxar_type', $type);
                            }
                            // if($status_type !=''){
                            //     $this->db->where('mxar_authfinal_status', $status_type);
                            // }
                            if($status_type !== ''){
                                $this->db->where("
                                    (
                                    CASE 
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 0 THEN '0'
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 1 THEN '1'
                                    WHEN mxar_auth1_empcode = '$employeeidval' and mxar_auth1_status = 2 THEN '2'

                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 0 THEN '0'
                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 1 THEN '1'
                                    WHEN mxar_auth2_empcode = '$employeeidval' and mxar_auth2_status = 2 THEN '2'

                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 0 THEN '0'
                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 1 THEN '1'
                                    WHEN mxar_auth3_empcode = '$employeeidval' and mxar_auth3_status = 2 THEN '2'

                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 0 THEN '0'
                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 1 THEN '1'
                                    WHEN mxar_auth4_empcode = '$employeeidval' and mxar_auth4_status = 2 THEN '2'

                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_authfinal_status = 9 THEN '0'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_authfinal_status = 3 THEN '3'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_authfinal_status = 1 THEN '1'
                                    WHEN mxar_authfinal_empcode = '$employeeidval' and mxar_authfinal_status = 2 THEN '2'

                                    when mxar_appliedby_emp_code = '$employeeidval' then 
                                    (
                                        CASE 
                                            WHEN mxar_authfinal_status = 9 THEN '0'
                                            WHEN mxar_authfinal_status = 3 THEN '3'
                                            WHEN mxar_authfinal_status = 1 THEN '1'
                                            WHEN mxar_authfinal_status = 2 THEN '2'
                                            ELSE ''
                                        END
                                    )
                
                                    ELSE ''
                                    END
                                    ) = '".$status_type."'
                                    ");
                            }
                            // $this->db->group_by('attend_unid,attenddate');
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                            if(count($result) > 0){
                                $naval = 0;
                                $editbtn = 0;
                                $authempidstatus = '0';
                                $authempiddesc = '';
                                foreach($result as $key=>$val)
                                {
                                    if($val['category_type']==1){
                                        $result[$key]['category_Name']='First Half';
                                    }elseif($val['category_type']==2){
                                        $result[$key]['category_Name']='Second Half';
                                    }elseif($val['category_type']==3){
                                        $result[$key]['category_Name']='Full Day';
                                    }
                                    
                                    $det= $this->punchdetails($val['from'],$val['employeeid']);
                                    if(($det[0]->second_half_punch != '') || ($det[0]->first_half_punch !='') ){
                                        $result[$key]['second_half_punch']=$det[0]->second_half_punch;
                                        $result[$key]['first_half_punch']=$det[0]->first_half_punch;
                                    }else{
                                        $result[$key]['second_half_punch']='';
                                        $result[$key]['first_half_punch']='';
                                    }
                                    if($type =='OT' && !empty($val['mxar_ot_branch_id'])){
                                        $otval = $val['mxar_ot_branch_id'];
                                        $qry= " select GROUP_CONCAT(mxb_name) as otbranchname from maxwell_branch_master where mxb_id in ($otval) ";
                                         $query = $this->db->query($qry);
                                        $count= count($query->row());
                                        $qry = $query->result_array(); 
                                        $result[$key]['otbranchname']=$qry[0]['otbranchname'];
                                    }
                                        // 1 enable  2 disable 
                                        if($val['finalhracceptid'] != $val['authfinal'] ){
                                            $hrfinalnane =$val['hrfinalempname'];
                                        }else{
                                            $hrfinalnane ='';
                                        }
                                        if($val['auth1status']== 1){
                                            $result[$key]['authemp1'] =$val['authempname1'].'(Approved)';
                                            if($val['auth1'] == $employeeidval ){
                                                $editbtn =  2;
                                                $naval=2;
                                                $authempidstatus =$val['auth1status'];
                                                $authempiddesc = $val['auth1desc'];
                                                
                                            }
                                        }elseif($val['auth1status']== 2){
                                            $result[$key]['authemp1'] =$val['authempname1'].'(Rejected)';
                                            if($val['auth1']== $employeeidval ){
                                                $editbtn =1;
                                                $naval=2;
                                                $authempidstatus =$val['auth1status'];
                                                $authempiddesc = $val['auth1desc'];
                                            }
                                        }else{
                                            if(!empty($result[$key]['auth1'])){
                                                $result[$key]['authemp1'] = $val['authempname1'].'(Wating for approval)';
                                                if($val['auth1']== $employeeidval ){
                                                    $editbtn = 1;
                                                    $naval=2;
                                                    $authempidstatus =$val['auth1status'];
                                                    $authempiddesc = $val['auth1desc'];
                                                }
                                            }else{
                                                $result[$key]['authemp1'] = '';
                                            }
                                        }
                                        
                                        if($val['auth2status']== 1){
                                            $result[$key]['authemp2']= $val['authempname2'].'(Approved)';
                                            if($val['auth2']== $employeeidval ){
                                                $editbtn = 2;
                                                $naval=2;
                                                $authempidstatus =$val['auth2status'];
                                                $authempiddesc = $val['auth2desc'];
                                            }
                                        }elseif($val['auth2status']== 2){
                                            $result[$key]['authemp2']=$val['authempname2'].'(Rejected)';
                                            if($val['auth2']== $employeeidval ){
                                                $editbtn = 1;
                                                $naval=2;
                                                $authempidstatus =$val['auth2status'];
                                                $authempiddesc = $val['auth2desc'];
                                            }
                                        }else{
                                            if(!empty($result[$key]['auth2'])){
                                                $result[$key]['authemp2'] =$val['authempname2'].'(Wating for approval)';
                                                if($val['auth2']== $employeeidval ){
                                                    $editbtn =1;
                                                    $naval=2;
                                                    $authempidstatus =$val['auth2status'];
                                                    $authempiddesc = $val['auth2desc'];
                                                }
                                            }else{
                                                $result[$key]['authemp2'] = '';
                                            }                }
                                        if($val['auth3status']== 1){ 
                                            $result[$key]['authemp3']=$val['authempname3'].'(Approved)';
                                            if($val['auth3']== $employeeidval ){
                                                $editbtn =2;
                                                $naval=2;
                                                $authempidstatus =$val['auth3status'];
                                                $authempiddesc = $val['auth3desc'];
                                            }
                                        }elseif($val['auth3status']== 2){
                                            $result[$key]['authemp3'] =$val['authempname3'].'(Rejected)';
                                            if($val['auth3']== $employeeidval ){
                                                $editbtn = 1;
                                                $naval=2;
                                                $authempidstatus =$val['auth3status'];
                                                $authempiddesc = $val['auth3desc'];
                                            }
                                        }else{
                                            if(!empty($result[$key]['auth3'])){
                                                $result[$key]['authemp3'] =$val['authempname3'].'(Wating for approval)';
                                                if($val['auth3']== $employeeidval ){
                                                    $editbtn = 1;
                                                    $naval=2;
                                                    $authempidstatus =$val['auth3status'];
                                                    $authempiddesc = $val['auth3desc'];
                                                }
                                            }else{
                                                $result[$key]['authemp3'] = '';
                                            }
                                        }
                                        if($val['auth4status']== 1){
                                            $result[$key]['authdirector']= $val['authempname4'].'(Approved)';
                                            if($val['auth4']== $employeeidval ){
                                                $editbtn = 2;
                                                $naval=2;
                                                $authempidstatus =$val['auth4status'];
                                                $authempiddesc = $val['auth4desc'];
                                            }
                                        }elseif($val['auth4status']== 2){
                                            $result[$key]['authdirector'] =$val['authempname4'].'(Rejected)';
                                            if($val['auth4']== $employeeidval ){
                                                $editbtn = 1;
                                                $naval=2;
                                                $authempidstatus =$val['auth4status'];
                                                $authempiddesc = $val['auth4desc'];
                                            }
                                        }else{
                                            if(!empty($result[$key]['auth4'])){
                                                $result[$key]['authdirector'] =$val['authempname4'].'(Wating for approval)';
                                                if($val['auth4']== $employeeidval ){
                                                    $editbtn = 1;
                                                    $naval=2;
                                                    $authempidstatus =$val['auth4status'];
                                                    $authempiddesc = $val['auth4desc'];
                                                }
                                            }else{
                                                $result[$key]['authdirector'] = '';
                                            }              
                                        }
                                        if($val['authfinalstatus']== 1){
                                            $result[$key]['authfinalhr'] =$val['authfinalempname'].' '.$hrfinalnane.'(Approved)';
                                            if($val['authfinal']== $employeeidval ){
                                                $editbtn = 2;
                                                $naval=2;
                                                $authempidstatus =$val['authfinalstatus'];
                                                $authempiddesc = $val['auth1desc'];
                                            }
                                        }elseif($val['authfinalstatus']== 2){
                                            $result[$key]['authfinalhr']=$val['authfinalempname'].' '.$hrfinalnane.'(Rejected)';
                                            if($val['authfinal']== $employeeidval ){
                                                $editbtn = 1;
                                                $naval=2;
                                                $authempidstatus =$val['authfinalstatus'];
                                                $authempiddesc = $val['auth1desc'];
                                            }
                                        }else{
                                            if(!empty($result[$key]['authfinal'])){
                                                $result[$key]['authfinalhr'] = $val['authfinalempname'].' '.$hrfinalnane.'(Wating for approval)';
                                                if($val['authfinal']== $employeeidval ){
                                                    $editbtn = 1;
                                                    $naval=2;
                                                    $authempidstatus =$val['authfinal'];
                                                    $authempiddesc = $val['authfinaldesc'];
                                                }
                                            }else{
                                                $result[$key]['authfinalhr'] ='';
                                            }
                                        }
                                        
                                        if( ($val['employeeid'] == $employeeidval) && ($val['status'] == 1) && ( ($val['auth1status'] == 0) && ($val['auth2status'] == 0) && ($val['auth3status'] ==0 ) && ($val['aauth4status'] ==0) && ($val['authfinalstatus'] ==9) ) ){
                                            $editbtn = 1;
                                            $naval =1;
                                        }else if(($val['employeeid'] == $employeeidval) && ($val['status'] == 0)  && (($val['auth1status'] == 0)&&($val['auth2status'] == 0) && ($val['auth3status'] ==0 )&&($val['aauth4status'] ==0)&&($val['authfinalstatus'] ==9))){
                                            $editbtn = 2;
                                            $naval = 1;
                                        }else{
                                            $editbtn=$editbtn;
                                            $naval =$naval;
                                        }
                        
                                        // $result[$key]['status1']='Approval';
                                        $result[$key]['status2']=  $naval; 
                                        $result[$key]['editstatusval']=$editbtn;
                                        $result[$key]['authempidstatus']=$authempidstatus;
                                        $result[$key]['authempiddesc']=$authempiddesc;
                        
                                       
                                        unset($result[$key]['authempname1']);
                                        unset($result[$key]['authempname2']);
                                        unset($result[$key]['authempname3']);
                                        unset($result[$key]['authempname4']);
                                        unset($result[$key]['authfinalempname']);
                                        unset($result[$key]['authfinalname']);
                                        unset($result[$key]['finalhracceptid']);
                                     // unset($result[$key]['finalhracceptname']);
                                        unset($result[$key]['hrfinalempname']);
                                        unset($result[$key]['auth1status']);
                                        unset($result[$key]['auth2status']);
                                        unset($result[$key]['auth3status']);
                                        unset($result[$key]['auth4status']);
                                        unset($result[$key]['authfinalstatus']);
                                        unset($result[$key]['auth1']);
                                        unset($result[$key]['auth2']);
                                        unset($result[$key]['auth3']);
                                        unset($result[$key]['auth4']);
                                        unset($result[$key]['authfinal']);
                                        unset($result[$key]['status']);
                                        
                                }
                                    $x=array();
                                    if(($filteremployeeid !=0) || ($filteremployeeid !='')){
                                        foreach($result as $rkey=>$rval){
                                            if($rval['employeeid']==$filteremployeeid){
                                                array_push($x,$result[$rkey]);
                                            }else{
                                                continue;
                                            }
                                        }
                                       $res19= $x;
                                    }else{
                                        $res19=$result;
                                    }
                                    return $res19;
                            }else{
                                $data1='';
                                return $data1;
                            }
    }
    
    public function punchdetails($from,$empid){
        // $tblappdate = date('Y',strtotime($from)); 
        
        $tblappdate = date('Y_m',strtotime($from)); 
        $attdate=date('Y-m-d',strtotime($from));
        
        // $query = "select max(attendance_time)as second_punch,min(attendance_time) as first_punch from employee_punches_$tblappdate where employee_code='$empid' and attendance_date='$attdate'";
        
        $query = "select mx_attendance_first_half as first_half_punch, mx_attendance_second_half as second_half_punch from maxwell_attendance_$tblappdate where mx_attendance_emp_code='$empid' and mx_attendance_date='$attdate'";

        $puncharr = $this->db->query($query)->result();
        // print_r($puncharr); exit;
        // echo $this->db->last_query();
    return $puncharr;
    }
    

    public function attendancelist($employeeid,$companyid,$divisionid,$stateid,$branchid)
    {
        // concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename
        $this->db->select(" mxemp_emp_fname as employee_firstname,mxemp_emp_lname as employee_lastname,mxar_id as mxid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_reason as reason,mxar_desc as desc,mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,
                            mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal, mxar_status as status , 
                            mxar_intime as intime , mxar_outtime as outtime");
                            $this->db->from('attendance_regulation');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            // $this->db->where('mxar_comp_id', $companyid);
                            // $this->db->where('mxar_div_id', $divisionid);
                            // $this->db->where('mxar_state_id', $stateid);
                            // $this->db->where('mxar_branch_id', $branchid);
                            $this->db->where('mxar_appliedby_emp_code', $employeeid);
                            $query= $this->db->get();
                            $result = $query->result_array();
                            // print_r($result);
        $naval='';
        $a=1;
        foreach($result as $key=>$val)
        {
            if(!empty($val['authfinal'])){
                $result[$key]['status1']= 'Accepted';
                $result[$key]['status2'] = "Accepted By " .$val['authfinal'] ;
                $result[$key]['editbutton'] = "Disable";
            }elseif(!empty($val['auth1']) || !empty($val['auth2']) || !empty($val['auth3']) || !empty($val['auth4']) ){            
                if(!empty($val['auth1'])){ $naval = $val['auth1'];}
                if(!empty($val['auth2'])){ $naval .= ','.$val['auth2'];}
                if(!empty($val['auth3'])){ $naval .= ','.$val['auth3'];}
                if(!empty($val['auth4'])){ $naval .= ','. $val['auth4'];}
                if(!empty($val['authfinal'])){ $naval .= $val['authfinal'];}
                
                $result[$key]['status1']='Approval';
                $result[$key]['status2']= "Approval by " . $naval; 
                $result[$key]['editbutton'] = "Disable";
            }else{
                $result[$key]['status1']='Waiting For Approval';
                $result[$key]['status2'] ='';
                $result[$key]['editbutton'] = '';
            }
        }
        return $result;
    }

    public function authattendance_accept($employeeid,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid){
        //  1 -- accept ,   2  -- reject
        $this->db->distinct();
        $this->db->select("mxauth_emp_code as empid , mxauth_auth_type as authtype,concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ");  //mxauth_reporting_head_emp_code
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        // echo $this->db->last_query();exit;
        if(count($cnt) > 0){
            $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                               mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                               mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,mxar_auth1_empcode as auth1,
                               mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                               mxar_status as status , mxar_intime as intime , mxar_outtime as outtime,mxar_type as type');
            $this->db->from('attendance_regulation');
            $this->db->where('mxar_status',1);
            $this->db->where('mxar_id', $uniqid);
            $query = $this->db->get();
            $res = $query->result_array();
            // print_r($res); exit;

            foreach($cnt as $key=>$val){
                // print_r($val);
            if($val['empid'] == $res[0]['employeeid']){
                $authtype = $val['authtype'];
            }else{
                continue;
            }
             }
            // if($cnt[0]['authtype'] == 3){ 
            if($authtype == 3){ 
                $applieddate = $res[0]['from'];
                $tblappdate = date('Y_m',strtotime($applieddate));      
            if($res[0]['noofdays'] == 1){
                    if($approve == 1){
                        if($res[0]['category_type'] == 1){ //firstHalf
                            $attendarray = array('mx_attendance_first_half'=>$res[0]['type'],
                                                 'mx_attendance_modifyby' =>$employeeid,
                                                 'mx_attendance_modifiedtime' =>DBDT,
                                                 'mx_attendance_modified_ip' =>''
                                                );                       
                        }elseif($res[0]['category_type'] == 2){   //secondhalf
                            $attendarray = array('mx_attendance_second_half'=>$res[0]['type'],
                                                 'mx_attendance_modifyby' =>$employeeid,
                                                 'mx_attendance_modifiedtime' =>DBDT,
                                                 'mx_attendance_modified_ip' =>''
                                                 );
                        }else{   //fullday                        
                            $attendarray = array('mx_attendance_first_half'=>$res[0]['type'],
                                                'mx_attendance_second_half'=>$res[0]['type'],
                                                 'mx_attendance_modifyby' =>$employeeid,
                                                 'mx_attendance_modifiedtime' =>DBDT,
                                                 'mx_attendance_modified_ip' =>''                    
                                                );
                        }
                            $this->db->select('mx_attendance_id as uniqid');  
                            $this->db->from('maxwell_attendance_'.$tblappdate);              
                            $this->db->where('mx_attendance_status',1);
                            $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                            $this->db->where('mx_attendance_date',$applieddate);
                            $query = $this->db->get();
                            $attunid = $query->result_array();
                            if(count($attunid)>0){
                                $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                                $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                            }
                    }
                    $autharry= array(
                        // "mxar_authfinal_empcode"=>$employeeid,
                        // "mxar_authfinal_empname"=>$cnt[0]['employeename'],
                        "mxar_hrfinal_accept"=>$employeeid,
                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                        "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                        "mxar_hrfinal_acceptname"=>$cnt[0]['employeename'],
                        "mxar_authfinal_remarks"=>$remarks,
                        "mxar_authfinal_status"=>$approve,
                        "mxar_authfinal_deviceid"=>$deviceid,
                        'mxar_emp_modifyby' => $employeeid,
                        'mxar_emp_modifiedtime' => DBDT,
                        'mxar_emp_modified_ip' => ''
                        // "mxar_authfinal_createdby"=>$employeeid,
                        // "mxar_authfinal_createdtime"=>DBDT,
                    );
                    // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_authfinal_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_authfinal_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_regulation',$autharry);
                    if($res==1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
                }elseif($res[0]['noofdays'] > 1){
                    if($approve == 1){
                        for($i=0 ; $i< $res[0]['noofdays'] ; $i++){
                            if($i==0){
                                $new_date = $applieddate;
                            }else{
                                $applieddate = strtotime("1 day", strtotime($new_date));
                                $new_date = date("Y-m-d", $applieddate);
                            }
                            // $attdt =date("Y-m-d", strtotime($applieddate . ' + ' . $i));
                            $attendarray = array('mx_attendance_first_half'=>$res[0]['type'],
                                                 'mx_attendance_second_half'=>$res[0]['type'],  
                                                 'mx_attendance_modifyby' =>$employeeid,
                                                 'mx_attendance_modifiedtime' =>DBDT,
                                                 'mx_attendance_modified_ip' =>''

                                                );
                            $this->db->select('mx_attendance_id as uniqid');  
                            $this->db->from('maxwell_attendance_'.$tblappdate);              
                            $this->db->where('mx_attendance_status',1);
                            $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                            $this->db->where('mx_attendance_date',$new_date);
                            $query = $this->db->get();
                            $attunid = $query->result_array();
                            
                            $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                            $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                        }
                    }
                    $autharry= array(
                        // "mxar_authfinal_empcode"=>$employeeid,
                        // "mxar_authfinal_empname"=>$cnt[0]['employeename'],
                        "mxar_hrfinal_accept"=>$employeeid,
                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                        "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                        "mxar_hrfinal_acceptname"=>$cnt[0]['employeename'],
                        " mxar_authfinal_remarks"=>$remarks,
                        "mxar_authfinal_status"=>$approve,
                        "mxar_authfinal_deviceid"=>$deviceid,
                        'mxar_emp_modifyby' => $employeeid,
                        'mxar_emp_modifiedtime' => DBDT,
                        'mxar_emp_modified_ip' => ''
                        // "mxar_authfinal_createdby"=>$employeeid,
                        // "mxar_authfinal_createdtime"=>DBDT,
                        );
                    // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_authfinal_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_authfinal_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_regulation',$autharry);
                    if($res==1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
                }
            }elseif(!empty($authtype)){
                if($res[0]['auth1'] == $employeeid ){ 
                    $autharry= array(
                        "mxar_auth1_remarks"=>$remarks,
                        "mxar_auth1_createdby"=>$employeeid,
                        "mxar_auth1_status"=>$approve,
                        "mxar_auth1_createdtime"=>DBDT,
                        "mxar_auth1_deviceid"=>$deviceid
                    );
                    // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_auth1_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_auth1_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                }elseif($res[0]['auth2'] == $employeeid){ 
                    $autharry= array(
                        "mxar_auth2_remarks"=>$remarks,
                        "mxar_auth2_createdby"=>$employeeid,
                        "mxar_auth2_status"=>$approve,
                        "mxar_auth2_createdtime"=>DBDT,
                        "mxar_auth2_deviceid"=>$deviceid
                    );
                    // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_auth2_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_auth2_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                }elseif($res[0]['auth3'] == $employeeid){ 
                    $autharry= array(
                        "mxar_auth3_remarks"=>$remarks,
                        "mxar_auth3_createdby"=>$employeeid,
                        "mxar_auth3_status"=>$approve,
                        "mxar_auth3_createdtime"=>DBDT,
                        "mxar_auth3_deviceid"=>$deviceid
                    );
                     // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_auth3_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_auth3_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                }elseif($res[0]['auth4'] == $employeeid){ 
                    $autharry= array(
                        "mxar_auth4_remarks"=>$remarks,
                        "mxar_auth4_createdby"=>$employeeid,
                        "mxar_auth4_status"=>$approve,
                        "mxar_auth4_createdtime"=>DBDT,
                        "mxar_auth4_deviceid"=>$deviceid
                    );
                     // ========================  added on 24-08-2024 ===================
                    if($approve == 1){
                        $autharry['mxar_auth4_approve_date']=DBDT;
                    }elseif($approve==2){
                        $autharry['mxar_auth4_reject_date']=DBDT;
                    }
                    // ========================  end on 24-08-2024 =====================
                }
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_regulation',$autharry);
                if($res == 1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='You not an authorized person';
                return $data;
            }
        }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='No Data Exist';
                return $data;
        }
    }
    
    
    public function adminallattendancelist($companyid,$divisionid,$stateid,$branchid,$monthyear,$approvstatus,$employeeid,$deviceid,$type)
    {
        // $employeeidval = $employeeid;
        // $notemployee = array('M0017','MD0005');
        $notemployee = array();
        
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_reason as reason,mxar_desc as emp_description,  
                            mxar_intime as intime , mxar_outtime as outtime,mxar_status as status ,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',if(mxar_hrfinal_acceptname IS NULL ,' ',mxar_hrfinal_acceptname)) as hrfinalempname , mxar_hrfinal_accept as finalhracceptid, 
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc,mxar_createdtime as createdtime,mxb_name as branchname");
                            $this->db->from('attendance_regulation');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->join('maxwell_branch_master','mxb_id=mxemp_emp_branch_code','Left');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            if($approvstatus != ''){
                                $this->db->where('mxar_authfinal_status', $approvstatus);
                            }
                            if($type != ''){
                                $this->db->where('mxar_type', $type);
                            }
                            if(!empty($monthyear) && ($filter==1) ){
                                $my = explode('-',$monthyear);
                                $len = strlen($my[1]);
                                if($len == 1){
                                    $monthyear = $my[0].'-'.'0'.$my[1];
                                }else{
                                    $monthyear =$monthyear;
                                }
                                $this->db->where("DATE_FORMAT(mxar_from,'%Y-%m')", $monthyear);
                            }
                            if(!empty($employeeid)){
                                 $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                    // echo $this->db->last_query(); die;
                if(count($result) > 0){
                    $message="Success";
                    $statuscode="200";
                    $desc = "";
                
        $naval = 0;
        $editbtn = 0;
        foreach($result as $key=>$val)
        {
                // 1 enable  2 disable 
                if($val['finalhracceptid'] != $val['authfinal'] ){
                    $hrfinalnane =$val['hrfinalempname'];
                }else{
                    $hrfinalnane ='';
                }
                if($val['auth1status']== 1){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Approved)';
                }elseif($val['auth1status']== 2){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Rejected)';
                    }else{
                    if(!empty($result[$key]['auth1'])){
                        $result[$key]['authemp1'] = $val['authempname1'].'(Wating for approval)';
                        }else{
                        $result[$key]['authemp1'] = '';
                    }
                }
                if($val['auth2status']== 1){
                    $result[$key]['authemp2']= $val['authempname2'].'(Approved)';
                }elseif($val['auth2status']== 2){
                    $result[$key]['authemp2']=$val['authempname2'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth2'])){
                        $result[$key]['authemp2'] =$val['authempname2'].'(Wating for approval)';
                    }else{
                        $result[$key]['authemp2'] = '';
                    }          
                }
                if($val['auth3status']== 1){ 
                    $result[$key]['authemp3']=$val['authempname3'].'(Approved)';
                }elseif($val['auth3status']== 2){
                    $result[$key]['authemp3'] =$val['authempname3'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth3'])){
                        $result[$key]['authemp3'] =$val['authempname3'].'(Wating for approval)';
                    }else{
                        $result[$key]['authemp3'] = '';
                    }
                }
                if($val['auth4status']== 1){
                    $result[$key]['authdirector']= $val['authempname4'].'(Approved)';
                }elseif($val['auth4status']== 2){
                    $result[$key]['authdirector'] =$val['authempname4'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth4'])){
                        $result[$key]['authdirector'] =$val['authempname4'].'(Wating for approval)';
                    }else{
                        $result[$key]['authdirector'] = '';
                    }           
                }
                if($val['authfinalstatus']== 1){
                    $result[$key]['authfinalhr'] =$val['authfinalempname'].'  '.$hrfinalnane.'(Approved)';
                }elseif($val['authfinalstatus']== 2){
                    $result[$key]['authfinalhr']=$val['authfinalempname'].'  '.$hrfinalnane.'(Rejected)';
                }else{
                    if(!empty($result[$key]['authfinal'])){
                        $result[$key]['authfinalhr'] = $val['authfinalempname'].'  '.$hrfinalnane.'(Wating for approval)';
                    }else{
                        $result[$key]['authfinalhr'] ='';
                    }
                }
                    if(!in_array($employeeid,$notemployee)) {
                        if($val['authfinalstatus'] != 1){
                            $editbtn = 1 ;  // enable save button
                            $naval = 2;  // show approve button 
                            $authempidstatus = $val['authfinalstatus'];
                            $authempiddesc = $val['authfinaldesc'];
                        }else{
                            $editbtn = 2;  // disable save button
                            $naval = 2;   // show approve button
                            $authempidstatus = $val['authfinalstatus'];
                            $authempiddesc = $val['authfinaldesc'];
                        }
                    }else{
                        $editbtn = 0;
                        $naval = 0;
                    }
                
                // $result[$key]['status1']='Approval';
                $result[$key]['status2']=  $naval; 
                $result[$key]['editstatusval']=$editbtn;
                $result[$key]['authempidstatus']=$authempidstatus;
                $result[$key]['authempiddesc']=$authempiddesc;

                
                unset($result[$key]['authempname1']);
                unset($result[$key]['authempname2']);
                unset($result[$key]['authempname3']);
                unset($result[$key]['authempname4']);
                unset($result[$key]['authfinalempname']);
                unset($result[$key]['authfinalname']);
                unset($result[$key]['finalhracceptid']);
             // unset($result[$key]['finalhracceptname']);
                unset($result[$key]['hrfinalempname']);
                unset($result[$key]['auth1status']);
                unset($result[$key]['auth2status']);
                unset($result[$key]['auth3status']);
                unset($result[$key]['auth4status']);
                unset($result[$key]['authfinalstatus']);
                unset($result[$key]['auth1']);
                unset($result[$key]['auth2']);
                unset($result[$key]['auth3']);
                unset($result[$key]['auth4']);
                unset($result[$key]['authfinal']);
                unset($result[$key]['status']);
                
        }
        return $result;
        
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
        return $data;
        }
    }
    
    public function admin_regulation_hraccept_approval($employeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid){
        // $uniqid = $data['uniqid'];
        // $approve = $data['approve'];
        // $remarks = $data['remarks'];
        // $employeeid
        // $employeename
        
        
        $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                           mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                           mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,mxar_auth1_empcode as auth1,
                           mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                           mxar_status as status , mxar_intime as intime , mxar_outtime as outtime,mxar_type as type');
        $this->db->from('attendance_regulation');
        $this->db->where('mxar_status',1);
        $this->db->where('mxar_id', $uniqid);
        $query = $this->db->get();
        $res = $query->result_array();
        $applieddate = $res[0]['from'];
        $tblappdate = date('Y_m',strtotime($applieddate));      
        if($res[0]['noofdays'] == 1){
                if($approve == 1){
                    if($res[0]['category_type'] == 1){ // firstHalf
                        $attendarray = array('mx_attendance_first_half'=>$res[0]['type'],
                                                 'mx_attendance_modifyby' =>$employeeid,
                                                 'mx_attendance_modifiedtime' =>DBDT,
                                                 'mx_attendance_modified_ip' =>''
                                                 );                       
                    }elseif($res[0]['category_type'] == 2){   // secondhalf
                        $attendarray = array('mx_attendance_second_half'=>$res[0]['type'],
                                                'mx_attendance_modifyby' =>$employeeid,
                                                'mx_attendance_modifiedtime' =>DBDT,
                                                'mx_attendance_modified_ip' =>'');
                    }else{   //fullday                        
                        $attendarray = array('mx_attendance_first_half'  =>$res[0]['type'],
                                            'mx_attendance_second_half'=>$res[0]['type'],
                                            'mx_attendance_modifyby' =>$employeeid,
                                            'mx_attendance_modifiedtime' =>DBDT,
                                            'mx_attendance_modified_ip' =>''
                                            );
                    }
                        $this->db->select('mx_attendance_id as uniqid');  
                        $this->db->from('maxwell_attendance_'.$tblappdate);              
                        $this->db->where('mx_attendance_status',1);
                        $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                        $this->db->where('mx_attendance_date',$applieddate);
                        $query = $this->db->get();
                        $attunid = $query->result_array();
                        // echo $this->db->last_query();
                        if(count($attunid)>0){
                            $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                            $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                            // echo $this->db->last_query();
                        }
                }
                $autharry= array(
                    "mxar_hrfinal_accept"=>$employeeid,
                    "mxar_hrfinal_acceptdate"=>DBDT,
                    "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                    "mxar_hrfinal_acceptname"=>$employeename,
                    "mxar_authfinal_remarks"=>$remarks,
                    "mxar_authfinal_status"=>$approve,
                    "mxar_authfinal_deviceid"=>'Admin',
                    'mxar_emp_modifyby' => $employeeid,
                    'mxar_emp_modifiedtime' => DBDT,
                    'mxar_emp_modified_ip' => ''
                );
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_regulation',$autharry);
                    if($res==1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['adminauthapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
            }elseif($res[0]['noofdays'] > 1){
                if($approve == 1){
                    for($i=0 ; $i< $res[0]['noofdays'] ; $i++){
                        if($i==0){
                            $new_date = $applieddate;
                        }else{
                            $applieddate = strtotime("1 day", strtotime($new_date));
                            $new_date = date("Y-m-d", $applieddate);
                        }
                        // $attdt =date("Y-m-d", strtotime($applieddate . ' + ' . $i));
                        $attendarray = array('mx_attendance_first_half'=>$res[0]['type'],
                                            'mx_attendance_second_half'=>$res[0]['type'],
                                            'mx_attendance_modifyby' =>$employeeid,
                                            'mx_attendance_modifiedtime' =>DBDT,
                                            'mx_attendance_modified_ip' =>''
                                            );
                        $this->db->select('mx_attendance_id as uniqid');  
                        $this->db->from('maxwell_attendance_'.$tblappdate);              
                        $this->db->where('mx_attendance_status',1);
                        $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                        $this->db->where('mx_attendance_date',$new_date);
                        $query = $this->db->get();
                        $attunid = $query->result_array();
                        
                        $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                        $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                    }
                }
                $autharry= array(
                    "mxar_hrfinal_accept"=>$employeeid,
                    "mxar_hrfinal_acceptdate"=>DBDT,
                    "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                    "mxar_hrfinal_acceptname"=>$employeename,
                    "mxar_authfinal_remarks"=>$remarks,
                    "mxar_authfinal_status"=>$approve,
                    "mxar_authfinal_deviceid"=>'mobile',
                    'mxar_emp_modifyby' => $employeeid,
                    'mxar_emp_modifiedtime' => DBDT,
                    'mxar_emp_modified_ip' => ''
                    );
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_regulation',$autharry);
                
                if(($res1==1) && ($res==1) ){
                        $data['status']=200;
                        $data['msg']='Success';
                        $data['description']='';
                        // $data['authapproval']='Sucessfully Updated';
                        $qry1 = array('statusmsg'=>'Sucessfully Updated');
                        $data['adminauthapproval']=$qry1;
                    return $data;
                }else{
                        $data['status']=500;
                        $data['msg']='Failed';
                        $data['description']='Something went wrong';
                    return $data;
                }
            }
        }
        
        
    //    -------------------------  start onduty 28-07-2022 onduty apis -----------------------
    
public function onduty_apply_checker($employeeid,$from,$to,$companyid,$divisionid,$stateid,$branchid)
    {
        $this->db->select('mxar_appliedby_emp_code as employeeid');
        $this->db->from('attendance_onduty');
        $this->db->where('mxar_appliedby_emp_code',$employeeid);
        $this->db->where("mxar_from BETWEEN '$from' AND '$to' ");
        $this->db->where("mxar_to BETWEEN '$from' AND '$to' ");
        $this->db->where('mxar_status','1');
        $query= $this->db->get();
        $result = $query->result();
        // echo $this->db->last_query(); die;
        return $result;
    }

    public function onduty_apply($employeeid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc,$odcompanyid,$oddivisonid,$odstateid,$odbranchid){
        $qry=[]; 
        if( (date('m',strtotime($from))) != (date('m',strtotime($to))) ){
            $message="Failed";
            $statuscode="500";
            $desc='To different months cannot be applied'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        if ($from > $to) {
            $message="Failed";
            $statuscode="500";
            $desc='Please check from date to date correct'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
            }
        //  1 ->First Half  2 ->Secondhalf  3 -> fullday
        if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
            $message="Failed";
            $statuscode="500";
            $desc='We are unable to apply half day with two dates different dates';
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        
        $err_dates=array();
        $attendance_check_count=0;
        $onduty_apply_checker_count=0;
            $onduty_apply_checker = $this->onduty_apply_checker($employeeid,$from,$to,$companyid,$divisionid,$stateid,$branchid);
            if(count($onduty_apply_checker) > 0){
                $message="Failed";
                $statuscode="500";
                $desc='Already applied onduty for those days'; 
                $data1['status']=$statuscode;
                $data1['msg']=$message;
                $data1['description']=$desc;
                return $data1;
            }else{
                $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
                $this->db->from('maxwell_emp_authorsations');
                $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
                $this->db->where('mxauth_emp_code',$employeeid);
                $this->db->where('mxauth_status',1);
                $query= $this->db->get();
                $result = $query->result_array();
                // ,$odcompanyid,$oddivisonid,$odstateid,$odbranchid
                $data = array(
                    'mxar_comp_id'=>$companyid,
                    'mxar_div_id'=>$divisionid,
                    'mxar_state_id'=>$stateid,
                    'mxar_branch_id'=>$branchid,
                    'mxar_category_type'=>$category_type,
                    'mxar_appliedby_emp_code'=>$employeeid,
                    'mxar_intime'=>$intime,
                    'mxar_outtime'=>$outtime,
                    'mxar_from'=>$from,
                    'mxar_to'=>$to,
                    'mxar_attend_countdays'=>$noofdays,
                    'mxar_reason'=>$reason,
                    'mxar_desc'=>$emp_desc,
                    'mxar_device_status'=>$device_status,
                    'mxar_createdby' =>$employeeid,
                    'mxar_createdtime' =>DBDT,
                    'mxar_created_ip' => '',
                    'mxar_odcomp_id'=>$odcompanyid,
                    'mxar_oddiv_id'=>$oddivisonid,
                    'mxar_odstate_id'=>$odstateid,
                    'mxar_odbranch_id'=>$odbranchid
                        
                );
                $x=0;
                foreach($result as $key =>$authval){
                    if($x == 0){  
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                    }else{
                        $data['mxar_auth1_empcode'] = $authval['employeeid'];
                        $data['mxar_auth1_empname'] = $authval['employeename'];
                        $x++;
                    }
                    }elseif($x ==1 ){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode'] = $authval['employeeid'];
                            $data['mxar_authfinal_empname'] = $authval['employeename'];
                        }else{
                            $data['mxar_auth2_empcode'] = $authval['employeeid'];
                            $data['mxar_auth2_empname'] = $authval['employeename'];
                            $x++;
                        }
                    }elseif($x == 2){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                        $data['mxar_auth3_empcode'] = $authval['employeeid'];
                        $data['mxar_auth3_empname'] = $authval['employeename'];
                        $x++;
                        }
                    }elseif($x == 3){
                        if($authval['mxauth_auth_type'] == 3){
                            $data['mxar_authfinal_empcode']=$authval['employeeid'];
                            $data['mxar_authfinal_empname']=$authval['employeename'];
                        }else{
                            $data['mxar_auth4_empcode'] = $authval['employeeid'];
                            $data['mxar_auth4_empname'] = $authval['employeename'];
                            $x++;
                        }
                    }
                }
                $this->db->insert('attendance_onduty',$data);
                $res = ($this->db->affected_rows() != 1) ? false : true;
                if($res == 1){
                    $qry[]=array('statusmsg'=>'Sucessfully applied onduty');
                    $message="Success";
                    $statuscode="200";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']='';
                    $data1['attendance_regulation']=$qry;
                    return $data1;
                }else{
                    $message="Failed";
                    $statuscode="500";
                    $desc = "Please check onceagain";
                    $data1['status']=$statuscode;
                    $data1['msg']=$message;
                    $data1['description']=$desc;
                    return $data1;
                }
            }
    }

    public function edit_onduty($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid,$category_type,$intime,$outtime,$from,$to,$noofdays,$reason,$device_status,$emp_desc){
        if( (date('m',strtotime($from))) != (date('m',strtotime($to))) ){
            $message="Failed";
            $statuscode="500";
            $desc='To different months cannot be applied'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        if ($from > $to) {
            $message="Failed";
            $statuscode="500";
            $desc='Please check from date to date correct'; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
            }
        //  1 ->First Half  2 ->Secondhalf  3 -> fullday
        if(($category_type == 1 || $category_type ==2) && ($noofdays > 1)){
            $message="Failed";
            $statuscode="500";
            $desc='We are unable to apply half day with two dates different dates';
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }
        
        $this->db->select("mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                            mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                            mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,
                            mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
                            mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            mxar_status as status , mxar_intime as intime , mxar_outtime as outtime");
        $this->db->from('attendance_onduty');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $attend_regu_uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        if( ($result[0]['auth1'] != 0) || ($result[0]['auth2']!= 0) || ($result[0]['auth3']!= 0) || ($result[0]['auth4']!= 0) || ($result[0]['authfinal']!= 0) ){
            if($result[0]['auth1']!= 0){ $naval = $result[0]['authempname1'];}
            if($result[0]['auth2']!= 0){ $naval .= $result[0]['authempname2'];}
            if($result[0]['auth3']!= 0){ $naval .= $result[0]['authempname3'];}
            if($result[0]['auth4']!= 0){ $naval .= $result[0]['authempname4'];}
            if($result[0]['authfinal']!= 0){ $naval .= $result[0]['authfinalempname'];}
            
            $message="Failed";
            $statuscode="500";
            $desc="Already accepted or rejected by " .$naval; 
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
            return $data;
        }

        $this->db->select('mxar_appliedby_emp_code');
            $this->db->from('attendance_onduty');
            $this->db->where('mxar_appliedby_emp_code',$employeeid);
            $this->db->where("mxar_from BETWEEN '$from' AND '$to' ");
            $this->db->where("mxar_to BETWEEN '$from' AND '$to' ");
            $this->db->where_not_in('mxar_id ',$attend_regu_uniqid);
            $this->db->where('mxar_status','1');
            $query= $this->db->get();
            $result = $query->result();    
            if(count($result) >0){
                $message="Failed";
                $statuscode="500";
                $desc="Already with this days on-duty is applied"; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }   
            $daysrange = $this->date_rangewith_days($from,$to);
            $noofdays=$daysrange['noofday'];
            if((date('m',strtotime($from))) != (date('m',strtotime($to) ) )){
                $message="Failed";
                $statuscode="500";
                $desc="To different months cannot be applied"; 
                $data['status']=$statuscode;
                $data['msg']=$message;
                $data['description']=$desc;
                return $data;
            }
            $data1 = array(
                'mxar_comp_id'=>$companyid,
                'mxar_div_id'=>$divisionid,
                'mxar_state_id'=>$stateid,
                'mxar_branch_id'=>$branchid,
                'mxar_category_type'=>$category_type,
                'mxar_appliedby_emp_code'=>$employeeid,
                'mxar_intime'=>$intime,
                'mxar_outtime'=>$outtime,
                'mxar_from'=>$from,
                'mxar_to'=>$to,
                'mxar_attend_countdays'=>$noofdays,
                'mxar_reason'=>$reason,
                'mxar_desc'=>$emp_desc,
                'mxar_device_status'=>$device_status,
                'mxar_emp_modifyby' => $employeeid,
                'mxar_emp_modifiedtime' => DBDT,
                'mxar_emp_modified_ip' => ''
            );
            $this->db->where('mxar_id', $attend_regu_uniqid);
            $res = $this->db->update('attendance_onduty',$data1);
            if($res == 1){
                    $data['status']=200;
                    $data['msg']='Success';
                    $data['description']='';
                    $qry1 = array('statusmsg'=>'Sucessfully Updated');
                    $data['authapproval']=$qry1;
                return $data;
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='Something went wrong';
                return $data;
            }
    }

    public function delete_onduty($employeeid,$attend_regu_uniqid,$companyid,$divisionid,$stateid,$branchid)
    {
        $naval = '';
        $this->db->select("mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
        mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
        mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,
        mxar_auth1_status as auth1,mxar_auth2_status as auth2,mxar_auth3_status as auth3,
        mxar_auth4_status as auth4,mxar_authfinal_status as authfinal,
        concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
        concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
        concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
        mxar_status as status , mxar_intime as intime , mxar_outtime as outtime");
        $this->db->from('attendance_onduty');
        $this->db->where('mxar_appliedby_emp_code', $employeeid);
        $this->db->where('mxar_id', $attend_regu_uniqid);
        $query= $this->db->get();
        $result = $query->result_array();
        if(($result[0]['auth1'] !=0) || ($result[0]['auth2'] != 0) || ($result[0]['auth3'] != 0 ) || ($result[0]['auth4'] != 0 ) || ($result[0]['authfinal'] != 0) ){
            if($result[0]['auth1'] != 0 ){ $naval = $result[0]['authempname1'];}
            if($result[0]['auth2'] != 0 ){ $naval .=' '.$result[0]['authempname2'];}
            if($result[0]['auth3'] != 0 ){ $naval .=' '.$result[0]['authempname3'];}
            if($result[0]['auth4'] != 0){ $naval .=' '.$result[0]['authempname4'];}
            if($result[0]['authfinal'] != 0){ $naval .=' '. $result[0]['authfinalempname'];}
            $data['status']=500;
            $data['msg']='Failed';
            $data['description']="Already accepted by " .$naval . " so that unable to delete " ;
            return $data;
        } else{
            $data1 = array(
                'mxar_status'=>0,
                'mxar_emp_modifyby'=> $employeeid,
                'mxar_emp_modifiedtime'=> DBDT
                // 'mxar_emp_modified_ip'=>      
            );
            $this->db->where('mxar_id', $attend_regu_uniqid);
            $this->db->where('mxar_appliedby_emp_code', $employeeid);
            $res = $this->db->update('attendance_onduty',$data1);
            if($res==1){
                    $qry=array('statusmsg'=> 'Sucessfully Updated');
                    // $qry1['statusmsg']='Sucessfully Updated';
                    $data['status']=200;
                    $data['msg']='Success';
                    $data['description']='';
                    // $qry=$qry1;
                    $data['attendance_onduty']=$qry;
                return $data;
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='Something went wrong';
                return $data;
            }
        }
    }

    public function all_onduty_list($employeeid,$companyid,$divisionid,$stateid,$branchid,$filter,$monthyear)
    {
        $this->db->distinct();
        $this->db->select('mxauth_emp_code as empid'); 
        $this->db->from('maxwell_emp_authorsations');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        // echo $this->db->last_query(); die;
        $a=[];
        $employeeidval = $employeeid;
        if(count($cnt) > 0){
            array_push($a,$employeeid);
            foreach($cnt as $key=>$val1){  
                array_push($a,$val1['empid']);
            }
            $employeeid = array_values($a);
        }else{
                $employeeid = $employeeid;
        }           
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_reason as reason,mxar_desc as emp_description,  
                            mxar_intime as intime , mxar_outtime as outtime,mxar_status as status ,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname ,mxar_hrfinal_accept as finalhracceptid,
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc ");
                            $this->db->from('attendance_onduty');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)&& ($filter==1) ){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid)&& ($filter==1) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid)&& ($filter==1) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            if(!empty($monthyear)&& ($filter==1) ){
                                $my = explode('-',$monthyear);
                                $len = strlen($my[1]);
                                if($len == 1){
                                    $monthyear = $my[0].'-'.'0'.$my[1];
                                }else{
                                    $monthyear =$monthyear;
                                }
                                $this->db->where("DATE_FORMAT(mxar_from,'%Y-%m')", $monthyear);
                            }
                            if($employeeid !=''){
                                    $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                            // echo $this->db->last_query(); die;
                if(count($result) > 0){
                $naval = 0;
        $editbtn = 0;
        $authempidstatus = '0';
        $authempiddesc = '';
        foreach($result as $key=>$val)
        {
                // 1 enable  2 disable 
                if($val['finalhracceptid'] != $val['authfinal'] ){
                    $hrfinalnane =$val['hrfinalempname'];
                }else{
                    $hrfinalnane ='';
                }
                if($val['auth1status']== 1){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Approved)';
                    if($val['auth1'] == $employeeidval ){
                        $editbtn =  2;
                        $naval=2;
                        $authempidstatus =$val['auth1status'];
                        $authempiddesc = $val['auth1desc'];
                        
                    }
                }elseif($val['auth1status']== 2){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Rejected)';
                    if($val['auth1']== $employeeidval ){
                        $editbtn =1;
                        $naval=2;
                        $authempidstatus =$val['auth1status'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth1'])){
                        $result[$key]['authemp1'] = $val['authempname1'].'(Wating for approval)';
                        if($val['auth1']== $employeeidval ){
                            $editbtn = 1;
                            $naval=2;
                            $authempidstatus =$val['auth1status'];
                            $authempiddesc = $val['auth1desc'];
                        }
                    }else{
                        $result[$key]['authemp1'] = '';
                    }
                }
                if($val['auth2status']== 1){
                    $result[$key]['authemp2']= $val['authempname2'].'(Approved)';
                    if($val['auth2']== $employeeidval ){
                        $editbtn = 2;
                        $naval=2;
                        $authempidstatus =$val['auth2status'];
                        $authempiddesc = $val['auth2desc'];
                    }
                }elseif($val['auth2status']== 2){
                    $result[$key]['authemp2']=$val['authempname2'].'(Rejected)';
                    if($val['auth2']== $employeeidval ){
                        $editbtn = 1;
                        $naval=2;
                        $authempidstatus =$val['auth2status'];
                        $authempiddesc = $val['auth2desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth2'])){
                        $result[$key]['authemp2'] =$val['authempname2'].'(Wating for approval)';
                        if($val['auth2']== $employeeidval ){
                            $editbtn =1;
                            $naval=2;
                            $authempidstatus =$val['auth2status'];
                            $authempiddesc = $val['auth2desc'];
                        }
                    }else{
                        $result[$key]['authemp2'] = '';
                    }                }
                if($val['auth3status']== 1){ 
                    $result[$key]['authemp3']=$val['authempname3'].'(Approved)';
                    if($val['auth3']== $employeeidval ){
                        $editbtn =2;
                        $naval=2;
                        $authempidstatus =$val['auth3status'];
                        $authempiddesc = $val['auth3desc'];
                    }
                }elseif($val['auth3status']== 2){
                    $result[$key]['authemp3'] =$val['authempname3'].'(Rejected)';
                    if($val['auth3']== $employeeidval ){
                        $editbtn = 1;
                        $naval=2;
                        $authempidstatus =$val['auth3status'];
                        $authempiddesc = $val['auth3desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth3'])){
                        $result[$key]['authemp3'] =$val['authempname3'].'(Wating for approval)';
                        if($val['auth3']== $employeeidval ){
                            $editbtn = 1;
                            $naval=2;
                            $authempidstatus =$val['auth3status'];
                            $authempiddesc = $val['auth3desc'];
                        }
                    }else{
                        $result[$key]['authemp3'] = '';
                    }
                }
                if($val['auth4status']== 1){
                    $result[$key]['authdirector']= $val['authempname4'].'(Approved)';
                    if($val['auth4']== $employeeidval ){
                        $editbtn = 2;
                        $naval=2;
                        $authempidstatus =$val['auth4status'];
                        $authempiddesc = $val['auth4desc'];
                    }
                }elseif($val['auth4status']== 2){
                    $result[$key]['authdirector'] =$val['authempname4'].'(Rejected)';
                    if($val['auth4']== $employeeidval ){
                        $editbtn = 1;
                        $naval=2;
                        $authempidstatus =$val['auth4status'];
                        $authempiddesc = $val['auth4desc'];
                    }
                }else{
                    if(!empty($result[$key]['auth4'])){
                        $result[$key]['authdirector'] =$val['authempname4'].'(Wating for approval)';
                        if($val['auth4']== $employeeidval ){
                            $editbtn = 1;
                            $naval=2;
                            $authempidstatus =$val['auth4status'];
                            $authempiddesc = $val['auth4desc'];
                        }
                    }else{
                        $result[$key]['authdirector'] = '';
                    }              
                }
                if($val['authfinalstatus']== 1){
                    $result[$key]['authfinalhr'] =$val['authfinalempname'].' '.$hrfinalnane.'(Approved)';
                    if($val['authfinal']== $employeeidval ){
                        $editbtn = 2;
                        $naval=2;
                        $authempidstatus =$val['authfinalstatus'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }elseif($val['authfinalstatus']== 2){
                    $result[$key]['authfinalhr']=$val['authfinalempname'].' '.$hrfinalnane.'(Rejected)';
                    if($val['authfinal']== $employeeidval ){
                        $editbtn = 1;
                        $naval=2;
                        $authempidstatus =$val['authfinalstatus'];
                        $authempiddesc = $val['auth1desc'];
                    }
                }else{
                    if(!empty($result[$key]['authfinal'])){
                        $result[$key]['authfinal'] = $val['authfinalempname'].' '.$hrfinalnane.'(Wating for approval)';
                        if($val['authfinal']== $employeeidval ){
                            $editbtn = 1;
                            $naval=2;
                            $authempidstatus =$val['authfinal'];
                            $authempiddesc = $val['authfinaldesc'];
                        }
                    }else{
                        $result[$key]['authfinal'] ='';
                    }
                }
                
                // print_r($val['employeeid'].'/'. $employeeidval.'--');
                
                
                if( ($val['employeeid'] == $employeeidval) && ($val['status'] == 1) ){
                    $editbtn = 1;
                    //$naval = 'Edit';
                    $naval =1;
                }else if(($val['employeeid'] == $employeeidval) && ($val['status'] == 0)){
                    $editbtn = 2;
                    $naval = 1;
                }else{
                    $editbtn=$editbtn;
                    $naval =$naval;
                }

                // $result[$key]['status1']='Approval';
                $result[$key]['status2']=  $naval; 
                $result[$key]['editstatusval']=$editbtn;
                $result[$key]['authempidstatus']=$authempidstatus;
                $result[$key]['authempiddesc']=$authempiddesc;

                
                unset($result[$key]['authempname1']);
                unset($result[$key]['authempname2']);
                unset($result[$key]['authempname3']);
                unset($result[$key]['authempname4']);
                unset($result[$key]['authfinalempname']);
                unset($result[$key]['authfinalname']);
                unset($result[$key]['finalhracceptid']);
                // unset($result[$key]['finalhracceptname']);
                unset($result[$key]['hrfinalempname']);
                unset($result[$key]['auth1status']);
                unset($result[$key]['auth2status']);
                unset($result[$key]['auth3status']);
                unset($result[$key]['auth4status']);
                unset($result[$key]['authfinalstatus']);
                unset($result[$key]['auth1']);
                unset($result[$key]['auth2']);
                unset($result[$key]['auth3']);
                unset($result[$key]['auth4']);
                unset($result[$key]['authfinal']);
                unset($result[$key]['status']);
                
        }
        return $result;
        }else{
            $data1='';
            return $data1;
        }
    }

    public function auth_onduty_accept($employeeid,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid){
        //  1 -- accept ,   2  -- reject
        $this->db->distinct();
        $this->db->select("mxauth_emp_code as empid , mxauth_auth_type as authtype,concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ");  //mxauth_reporting_head_emp_code
        $this->db->from('maxwell_emp_authorsations');
        $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
        $this->db->where('mxauth_reporting_head_emp_code', $employeeid);
        $this->db->where('mxauth_status = 1');
        $query = $this->db->get();
        $cnt = $query->result_array(); 
        // echo $this->db->last_query();exit;
        if(count($cnt) > 0){
            $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                                mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                                mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,mxar_auth1_empcode as auth1,
                                mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                                mxar_status as status , mxar_intime as intime , mxar_outtime as outtime');
            $this->db->from('attendance_onduty');
            $this->db->where('mxar_status',1);
            $this->db->where('mxar_id', $uniqid);
            $query = $this->db->get();
            $res = $query->result_array();
            foreach($cnt as $key=>$val){
            if($val['empid'] == $res[0]['employeeid']){
                $authtype = $val['authtype'];
            }else{
                continue;
            }
                }
            // if($cnt[0]['authtype'] == 3){ 
            if($authtype == 3){ 
                $applieddate = $res[0]['from'];
                $tblappdate = date('Y_m',strtotime($applieddate));      
                if($res[0]['noofdays'] == 1){
                    /*if($approve == 1){
                        if($res[0]['category_type'] == 1){ //firstHalf
                            $attendarray = array('mx_attendance_first_half'=>'AR',
                                                    'mx_attendance_modifyby' =>$employeeid,
                                                    'mx_attendance_modifiedtime' =>DBDT,
                                                    'mx_attendance_modified_ip' =>''
                                                );                       
                        }elseif($res[0]['category_type'] == 2){   //secondhalf
                            $attendarray = array('mx_attendance_second_half'=>'AR',
                                                    'mx_attendance_modifyby' =>$employeeid,
                                                    'mx_attendance_modifiedtime' =>DBDT,
                                                    'mx_attendance_modified_ip' =>''
                                                    );
                        }else{   //fullday                        
                            $attendarray = array('mx_attendance_first_half'=>'AR',
                                                'mx_attendance_second_half'=>'AR',
                                                    'mx_attendance_modifyby' =>$employeeid,
                                                    'mx_attendance_modifiedtime' =>DBDT,
                                                    'mx_attendance_modified_ip' =>''                    
                                                );
                        }
                            $this->db->select('mx_attendance_id as uniqid');  
                            $this->db->from('maxwell_attendance_'.$tblappdate);              
                            $this->db->where('mx_attendance_status',1);
                            $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                            $this->db->where('mx_attendance_date',$applieddate);
                            $query = $this->db->get();
                            $attunid = $query->result_array();
                            if(count($attunid)>0){
                                $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                                $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                            }
                    }*/
                    $autharry= array(
                        // "mxar_authfinal_empcode"=>$employeeid,
                        // "mxar_authfinal_empname"=>$cnt[0]['employeename'],
                        "mxar_hrfinal_accept"=>$employeeid,
                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                        "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                        "mxar_hrfinal_acceptname"=>$cnt[0]['employeename'],
                        "mxar_authfinal_remarks"=>$remarks,
                        "mxar_authfinal_status"=>$approve,
                        "mxar_authfinal_deviceid"=>$deviceid,
                        'mxar_emp_modifyby' => $employeeid,
                        'mxar_emp_modifiedtime' => DBDT,
                        'mxar_emp_modified_ip' => ''
                        // "mxar_authfinal_createdby"=>$employeeid,
                        // "mxar_authfinal_createdtime"=>DBDT,
                    );
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_onduty',$autharry);
                    if($res==1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
                }elseif($res[0]['noofdays'] > 1){
                    /* if($approve == 1){
                        for($i=0 ; $i< $res[0]['noofdays'] ; $i++){
                            $attdt =date("Y-m-d", strtotime($applieddate . ' + ' . $i));
                            $attendarray = array('mx_attendance_first_half'=>'AR',
                                                    'mx_attendance_second_half'=>'AR',  
                                                    'mx_attendance_modifyby' =>$employeeid,
                                                    'mx_attendance_modifiedtime' =>DBDT,
                                                    'mx_attendance_modified_ip' =>''

                                                );
                            $this->db->select('mx_attendance_id as uniqid');  
                            $this->db->from('maxwell_attendance_'.$tblappdate);              
                            $this->db->where('mx_attendance_status',1);
                            $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                            $this->db->where('mx_attendance_date',$applieddate);
                            $query = $this->db->get();
                            $attunid = $query->result_array();
                            
                            $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                            $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                        }
                    }*/
                    $autharry= array(
                        "mxar_hrfinal_accept"=>$employeeid,
                        "mxar_hrfinal_acceptdate"=>date('Y-m-d H:i:s'),
                        "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                        "mxar_hrfinal_acceptname"=>$cnt[0]['employeename'],
                        " mxar_authfinal_remarks"=>$remarks,
                        "mxar_authfinal_status"=>$approve,
                        "mxar_authfinal_deviceid"=>$deviceid,
                        'mxar_emp_modifyby' => $employeeid,
                        'mxar_emp_modifiedtime' => DBDT,
                        'mxar_emp_modified_ip' => ''
                        );
                    $this->db->where('mxar_id', $uniqid);
                    $res = $this->db->update('attendance_onduty',$autharry);
                    if(($res1==1) && ($res==1) ){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
                }
            }elseif(!empty($authtype)){
                if($res[0]['auth1'] == $employeeid ){ 
                    $autharry= array(
                        // "mxar_auth1_empcode"=>$employeeid,
                        // "mxar_auth1_empname"=>$cnt[0]['employeename'],
                        "mxar_auth1_remarks"=>$remarks,
                        "mxar_auth1_createdby"=>$employeeid,
                        "mxar_auth1_status"=>$approve,
                        "mxar_auth1_createdtime"=>DBDT,
                        "mxar_auth1_deviceid"=>$deviceid
                    );
                }elseif($res[0]['auth2'] == $employeeid){ 
                    $autharry= array(
                        // "mxar_auth2_empcode"=>$employeeid,
                        // "mxar_auth2_empname"=>$cnt[0]['employeename'],
                        "mxar_auth2_remarks"=>$remarks,
                        "mxar_auth2_createdby"=>$employeeid,
                        "mxar_auth2_status"=>$approve,
                        "mxar_auth2_createdtime"=>DBDT,
                        "mxar_auth2_deviceid"=>$deviceid
                    );
                }elseif($res[0]['auth3'] == $employeeid){ 
                    $autharry= array(
                        // "mxar_auth3_empcode"=>$employeeid,
                        // "mxar_auth3_empname"=>$cnt[0]['employeename'],
                        "mxar_auth3_remarks"=>$remarks,
                        "mxar_auth3_createdby"=>$employeeid,
                        "mxar_auth3_status"=>$approve,
                        "mxar_auth3_createdtime"=>DBDT,
                        "mxar_auth3_deviceid"=>$deviceid
                    );
                }elseif($res[0]['auth4'] == $employeeid){ 
                    $autharry= array(
                        // "mxar_auth4_empcode"=>$employeeid,
                        // "mxar_auth4_empname"=>$cnt[0]['employeename'],
                        "mxar_auth4_remarks"=>$remarks,
                        "mxar_auth4_createdby"=>$employeeid,
                        "mxar_auth4_status"=>$approve,
                        "mxar_auth4_createdtime"=>DBDT,
                        "mxar_auth4_deviceid"=>$deviceid
                    );
                }
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_onduty',$autharry);
                if($res == 1){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['authapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
            }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='You not an authorized person';
                return $data;
            }
        }else{
                    $data['status']=500;
                    $data['msg']='Failed';
                    $data['description']='No Data Exist';
                return $data;
        }
    }

    public function adminall_onduty_list($companyid,$divisionid,$stateid,$branchid,$monthyear,$approvstatus,$employeeid,$deviceid)
    {
        $notemployee = array(); 
        $this->db->select(" concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename,mxar_id as uniqid,
                            mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,mxar_from as from,
                            mxar_to as to,mxar_reason as reason,mxar_desc as emp_description,  
                            mxar_intime as intime , mxar_outtime as outtime,mxar_status as status ,
                            mxar_auth1_status as auth1status,mxar_auth2_status as auth2status,mxar_auth3_status as auth3status,
                            mxar_auth4_status as auth4status, mxar_authfinal_status as authfinalstatus,
                            mxar_auth1_empcode as auth1,mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,
                            mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            concat(mxar_auth1_empcode,' ',mxar_auth1_empname) as authempname1,concat(mxar_auth2_empcode,' ',mxar_auth2_empname) as authempname2,
                            concat(mxar_auth3_empcode,' ',mxar_auth3_empname) as authempname3,concat(mxar_auth4_empcode,' ',mxar_auth4_empname) as authempname4,
                            concat(mxar_authfinal_empcode,' ',mxar_authfinal_empname) as authfinalempname ,
                            concat(mxar_hrfinal_accept,' ',mxar_hrfinal_acceptname) as hrfinalempname , mxar_hrfinal_accept as finalhracceptid, 
                            mxar_auth1_remarks as auth1desc,mxar_auth2_remarks as auth2desc,mxar_auth3_remarks as auth3desc,
                            mxar_auth4_remarks as auth4desc ,mxar_authfinal_remarks as authfinaldesc,mxar_createdtime as createdtime");
                            $this->db->from('attendance_onduty');
                            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxar_appliedby_emp_code','Inner');
                            $this->db->where('mxar_status','1');
                            if(!empty($companyid)){
                                $this->db->where('mxar_comp_id', $companyid);
                            }
                            if(!empty($divisionid) && ($divisionid !=0) ){
                                $this->db->where('mxar_div_id', $divisionid);
                            }
                            if(!empty($stateid) && ($stateid !=0) ){
                                $this->db->where('mxar_state_id', $stateid);
                            }
                            if(!empty($branchid) && ($filter==1) && ($branchid !=0) ){
                                $this->db->where('mxar_branch_id', $branchid);
                            }
                            if($approvstatus != ''){
                                $this->db->where('mxar_authfinal_status', $approvstatus);
                            }
                            if(!empty($monthyear) ){
                                $my = explode('-',$monthyear);
                                $len = strlen($my[1]);
                                if($len == 1){
                                    $monthyear = $my[0].'-'.'0'.$my[1];
                                }else{
                                    $monthyear =$monthyear;
                                }
                                $this->db->where("DATE_FORMAT(mxar_from,'%Y-%m')", $monthyear);
                            }
                            if(!empty($employeeid)){
                                    $this->db->where_in('mxar_appliedby_emp_code', $employeeid);
                            }
                            $this->db->order_by("mxar_createdtime", "desc");
                            $query= $this->db->get();
                            $result = $query->result_array();
                    // echo $this->db->last_query(); die;
                if(count($result) > 0){
                    $message="Success";
                    $statuscode="200";
                    $desc = "";
                
        $naval = 0;
        $editbtn = 0;
        foreach($result as $key=>$val)
        {
                // 1 enable  2 disable 
                if($val['finalhracceptid'] != $val['authfinal'] ){
                    $hrfinalnane =$val['hrfinalempname'];
                }else{
                    $hrfinalnane ='';
                }
                if($val['auth1status']== 1){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Approved)';
                }elseif($val['auth1status']== 2){
                    $result[$key]['authemp1'] =$val['authempname1'].'(Rejected)';
                    }else{
                    if(!empty($result[$key]['auth1'])){
                        $result[$key]['authemp1'] = $val['authempname1'].'(Wating for approval)';
                        }else{
                        $result[$key]['authemp1'] = '';
                    }
                }
                if($val['auth2status']== 1){
                    $result[$key]['authemp2']= $val['authempname2'].'(Approved)';
                }elseif($val['auth2status']== 2){
                    $result[$key]['authemp2']=$val['authempname2'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth2'])){
                        $result[$key]['authemp2'] =$val['authempname2'].'(Wating for approval)';
                    }else{
                        $result[$key]['authemp2'] = '';
                    }          
                }
                if($val['auth3status']== 1){ 
                    $result[$key]['authemp3']=$val['authempname3'].'(Approved)';
                }elseif($val['auth3status']== 2){
                    $result[$key]['authemp3'] =$val['authempname3'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth3'])){
                        $result[$key]['authemp3'] =$val['authempname3'].'(Wating for approval)';
                    }else{
                        $result[$key]['authemp3'] = '';
                    }
                }
                if($val['auth4status']== 1){
                    $result[$key]['authdirector']= $val['authempname4'].'(Approved)';
                }elseif($val['auth4status']== 2){
                    $result[$key]['authdirector'] =$val['authempname4'].'(Rejected)';
                }else{
                    if(!empty($result[$key]['auth4'])){
                        $result[$key]['authdirector'] =$val['authempname4'].'(Wating for approval)';
                    }else{
                        $result[$key]['authdirector'] = '';
                    }           
                }
                if($val['authfinalstatus']== 1){
                    $result[$key]['authfinalhr'] =$val['authfinalempname'].'  '.$hrfinalnane.'(Approved)';
                }elseif($val['authfinalstatus']== 2){
                    $result[$key]['authfinalhr']=$val['authfinalempname'].'  '.$hrfinalnane.'(Rejected)';
                }else{
                    if(!empty($result[$key]['authfinal'])){
                        $result[$key]['authfinalhr'] = $val['authfinalempname'].'  '.$hrfinalnane.'(Wating for approval)';
                    }else{
                        $result[$key]['authfinalhr'] ='';
                    }
                }
                    if(!in_array($employeeid,$notemployee)) {
                        if($val['authfinalstatus'] != 1){
                            $editbtn = 1 ;  // enable save button
                            $naval = 2;  // show approve button 
                            $authempidstatus = $val['authfinalstatus'];
                            $authempiddesc = $val['authfinaldesc'];
                        }else{
                            $editbtn = 2;  // disable save button
                            $naval = 2;   // show approve button
                            $authempidstatus = $val['authfinalstatus'];
                            $authempiddesc = $val['authfinaldesc'];
                        }
                    }else{
                        $editbtn = 0;
                        $naval = 0;
                    }
                
                // $result[$key]['status1']='Approval';
                $result[$key]['status2']=  $naval; 
                $result[$key]['editstatusval']=$editbtn;
                $result[$key]['authempidstatus']=$authempidstatus;
                $result[$key]['authempiddesc']=$authempiddesc;

                
                unset($result[$key]['authempname1']);
                unset($result[$key]['authempname2']);
                unset($result[$key]['authempname3']);
                unset($result[$key]['authempname4']);
                unset($result[$key]['authfinalempname']);
                unset($result[$key]['authfinalname']);
                unset($result[$key]['finalhracceptid']);
                unset($result[$key]['hrfinalempname']);
                unset($result[$key]['auth1status']);
                unset($result[$key]['auth2status']);
                unset($result[$key]['auth3status']);
                unset($result[$key]['auth4status']);
                unset($result[$key]['authfinalstatus']);
                unset($result[$key]['auth1']);
                unset($result[$key]['auth2']);
                unset($result[$key]['auth3']);
                unset($result[$key]['auth4']);
                unset($result[$key]['authfinal']);
                unset($result[$key]['status']);                    
        }
        return $result;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc = "No Data Exist";
            $data['status']=$statuscode;
            $data['msg']=$message;
            $data['description']=$desc;
        return $data;
        }
    }

    public function admin_onduty_hraccept_approval($employeeid,$employeename,$uniqid,$remarks,$approve,$deviceid,$companyid,$divisionid,$stateid,$branchid)
    {
        
        $this->db->select('mxar_id as mxid,mxar_category_type as category_type,mxar_appliedby_emp_code as employeeid,
                            mxar_intime as intime ,mxar_outtime as outtime,mxar_attend_countdays as noofdays,
                            mxar_from as from,mxar_to as to,mxar_reason as reason,mxar_desc as desc,mxar_auth1_empcode as auth1,
                            mxar_auth2_empcode as auth2,mxar_auth3_empcode as auth3,mxar_auth4_empcode as auth4,mxar_authfinal_empcode as authfinal,
                            mxar_status as status , mxar_intime as intime , mxar_outtime as outtime');
        $this->db->from('attendance_onduty');
        $this->db->where('mxar_status',1);
        $this->db->where('mxar_id', $uniqid);
        $query = $this->db->get();
        $res = $query->result_array();
        // echo $this->db->last_query();
        $applieddate = $res[0]['from'];
        $tblappdate = date('Y_m',strtotime($applieddate));      
        if($res[0]['noofdays'] == 1){
                /*if($approve == 1){
                    if($res[0]['category_type'] == 1){ //firstHalf
                        $attendarray = array('mx_attendance_first_half'=>'AR',
                                                    'mx_attendance_modifyby' =>$employeeid,
                                                    'mx_attendance_modifiedtime' =>DBDT,
                                                    'mx_attendance_modified_ip' =>''
                                                    );                       
                    }elseif($res[0]['category_type'] == 2){   //secondhalf
                        $attendarray = array('mx_attendance_second_half'=>'AR',
                                                'mx_attendance_modifyby' =>$employeeid,
                                                'mx_attendance_modifiedtime' =>DBDT,
                                                'mx_attendance_modified_ip' =>'');
                    }else{   //fullday                        
                        $attendarray = array('mx_attendance_first_half'=>'AR',
                                            'mx_attendance_second_half'=>'AR',
                                            'mx_attendance_modifyby' =>$employeeid,
                                            'mx_attendance_modifiedtime' =>DBDT,
                                            'mx_attendance_modified_ip' =>''
                                            );
                    }
                        $this->db->select('mx_attendance_id as uniqid');  
                        $this->db->from('maxwell_attendance_'.$tblappdate);              
                        $this->db->where('mx_attendance_status',1);
                        $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                        $this->db->where('mx_attendance_date',$applieddate);
                        $query = $this->db->get();
                        $attunid = $query->result_array();
                        // echo $this->db->last_query();
                        if(count($attunid)>0){
                            $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                            $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                            // echo $this->db->last_query();
                        }
                }*/
                $autharry= array(
                    "mxar_hrfinal_accept"=>$employeeid,
                    "mxar_hrfinal_acceptdate"=>DBDT,
                    "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                    "mxar_hrfinal_acceptname"=>$employeename,
                    "mxar_authfinal_remarks"=>$remarks,
                    "mxar_authfinal_status"=>$approve,
                    // "mxar_authfinal_createdby"=>$employeeid,
                    // "mxar_authfinal_createdtime"=>date('Y-m-d H:i:s'),
                    "mxar_authfinal_deviceid"=>'Admin',
                    'mxar_emp_modifyby' => $employeeid,
                    'mxar_emp_modifiedtime' => DBDT,
                    'mxar_emp_modified_ip' => ''
                );
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_regulation',$autharry);
                    if(($res1==1) && ($res==1) ){
                            $data['status']=200;
                            $data['msg']='Success';
                            $data['description']='';
                            // $data['authapproval']='Sucessfully Updated';
                            $qry1 = array('statusmsg'=>'Sucessfully Updated');
                            $data['adminauthapproval']=$qry1;
                        return $data;
                    }else{
                            $data['status']=500;
                            $data['msg']='Failed';
                            $data['description']='Something went wrong';
                        return $data;
                    }
            }elseif($res[0]['noofdays'] > 1){
                /*if($approve == 1){
                    for($i=0 ; $i< $res[0]['noofdays'] ; $i++){
                        $attdt =date("Y-m-d", strtotime($applieddate . ' + ' . $i));
                        $attendarray = array('mx_attendance_first_half'=>'AR',
                                            'mx_attendance_second_half'=>'AR',
                                            'mx_attendance_modifyby' =>$employeeid,
                                            'mx_attendance_modifiedtime' =>DBDT,
                                            'mx_attendance_modified_ip' =>''
                                            );
                        $this->db->select('mx_attendance_id as uniqid');  
                        $this->db->from('maxwell_attendance_'.$tblappdate);              
                        $this->db->where('mx_attendance_status',1);
                        $this->db->where('mx_attendance_emp_code', $res[0]['employeeid']);
                        $this->db->where('mx_attendance_date',$applieddate);
                        $query = $this->db->get();
                        $attunid = $query->result_array();
                        
                        $this->db->where('mx_attendance_id',$attunid[0]['uniqid']);
                        $res1 = $this->db->update('maxwell_attendance_'.$tblappdate , $attendarray);
                        // echo $this->db->last_query();
                    }
                }*/
                $autharry= array(
                    "mxar_hrfinal_accept"=>$employeeid,
                    "mxar_hrfinal_acceptdate"=>DBDT,
                    "mxar_hrfinal_acceptcreatedby"=>$employeeid,
                    "mxar_hrfinal_acceptname"=>$employeename,
                    "mxar_authfinal_remarks"=>$remarks,
                    "mxar_authfinal_status"=>$approve,
                    // "mxar_authfinal_createdby"=>$employeeid,
                    // "mxar_authfinal_createdtime"=>date('Y-m-d H:i:s'),
                    "mxar_authfinal_deviceid"=>'mobile',
                    'mxar_emp_modifyby' => $employeeid,
                    'mxar_emp_modifiedtime' => DBDT,
                    'mxar_emp_modified_ip' => ''
                    );
                $this->db->where('mxar_id', $uniqid);
                $res = $this->db->update('attendance_regulation',$autharry);
                if(($res1==1) && ($res==1) ){
                        $data['status']=200;
                        $data['msg']='Success';
                        $data['description']='';
                        $qry1 = array('statusmsg'=>'Sucessfully Updated');
                        $data['adminauthapproval']=$qry1;
                    return $data;
                }else{
                        $data['status']=500;
                        $data['msg']='Failed';
                        $data['description']='Something went wrong';
                    return $data;
                }
            }
    }    

    
    //    -------------------------   end onduty 28-07-2022 onduty apis ---------------------
}

// 9:30 1:30 - first half full 
// 1:30 6:00 second half full
// 9:30 : 6:00 full presnt full
