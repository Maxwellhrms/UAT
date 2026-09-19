<?php

function convert_date($date,$type) {
    /*
     * $type = d-m-y to y-m-d 
    */
     if($type == "d-m-y to y-m-d"){
         $f_ex = explode('-', $date);
         $f_mk = mktime(0, 0, 0, $f_ex[1], $f_ex[0], $f_ex[2]);
         $converted_date = date('Y-m-d', $f_mk);
     }
     return $converted_date;
   
}

function rounding_number($number,$flag = 4,$pf_flag = null){
	$number_format_data = number_format($number,2,'.', '');

	if($flag ==1){//---->ABOVE ie 10.1 ie 11
	
		$ex = explode(".",$number_format_data);
		$actual_number = $ex[0];
		$decimal_number = $ex[1];		
		if($decimal_number >= 10){
			$final_data = number_format(($actual_number+1),2,'.', '');
		}else{
			$final_data = $actual_number.'.00';
		}
	}else if($flag ==2){//-----IT WILL ROUND NEAREST NUMBER ROUNDING
// 		$final_data = number_format(round($number_format_data),2,'.', '');
        $ex = explode(".",$number_format_data);
		$actual_number = $ex[0];
		$decimal_number = $ex[1];		
		if($pf_flag == "pf"){
          if($decimal_number >= 50){//--from 50 next number
              $final_data = number_format(($actual_number+1),2,'.', '');
          }else{
              $final_data = $actual_number.'.00';
          }
        }else{
        	if($decimal_number > 50){//from 51 next number
                $final_data = number_format(($actual_number+1),2,'.', '');
            }else{
                $final_data = $actual_number.'.00';
            }
        }
	}else if($flag ==3){
		$ex = explode(".",$number_format_data);
		$actual_number = $ex[0];
		$decimal_number = $ex[1];		
		if($decimal_number > 0){
			$final_data = number_format(($actual_number),2,'.', '');
		}else{
			$final_data = $number_format_data;
		}
	}else if($flag ==4){
		$final_data = $number_format_data;
	}else if($flag == 5){//---NEW BY SHABABU(10-04-2022)---> .51 to next number and upto 50 below number rounding
// 	    $ex = explode(".",$number_format_data);
// 		$actual_number = $ex[0];
// 		$decimal_number = $ex[1];		
// 		if($decimal_number > 50){
// 			$final_data = number_format(($actual_number+1),2,'.', '');
// 		}else{
// 			$final_data = $actual_number.'.00';
// 		}
	}
// 	echo $final_data;exit;
	return $final_data;
}
function getsundays_in_month($month,$year){
	$total_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month, $year); //---->Get no of days in a month
	$wo_days = 0;
	 //----------DAYS LOOP
	 for ($day = 1; $day <= $total_days_of_month; $day++) {
		 $date = $year . "-" . $month . "-" . $day;
		 $day_type = date('N', strtotime($date)); //----mon = 1....sun =7
						
		 if ($day_type == 7) {
			  $wo_days = $wo_days + 1;          
		 } 
	 }
	 //--------END DAYS LOOP
	 return $wo_days;
}

function getsundays_in_month_for_specific_days($month,$year,$end_date){
    $total_days_of_month = $end_date; //---->Get no of days in a month
	$wo_days = 0;
	 //----------DAYS LOOP
	 for ($day = 1; $day <= $total_days_of_month; $day++) {
		 $date = $year . "-" . $month . "-" . $day;
		 $day_type = date('N', strtotime($date)); //----mon = 1....sun =7
						
		 if ($day_type == 7) {
			  $wo_days = $wo_days + 1;          
		 } 
	 }
	 //--------END DAYS LOOP
	 return $wo_days;
}
function getjsondata($status = 0,$message="",$arr_data=array()){
        $data['status'] = $status;
        $data['message'] = $message;
        $data['data'] = $arr_data;
        echo json_encode($data);
        exit;
    
}
function numberTowords($num)
{ 
    $ones = array( 
    1 => "one", 
    2 => "two", 
    3 => "three", 
    4 => "four", 
    5 => "five", 
    6 => "six", 
    7 => "seven", 
    8 => "eight", 
    9 => "nine", 
    10 => "ten", 
    11 => "eleven", 
    12 => "twelve", 
    13 => "thirteen", 
    14 => "fourteen", 
    15 => "fifteen", 
    16 => "sixteen", 
    17 => "seventeen", 
    18 => "eighteen", 
    19 => "nineteen" 
    ); 
    $tens = array( 
    1 => "ten",
    2 => "twenty", 
    3 => "thirty", 
    4 => "forty", 
    5 => "fifty", 
    6 => "sixty", 
    7 => "seventy", 
    8 => "eighty", 
    9 => "ninety" 
    ); 
    $hundreds = array( 
    "hundred", 
    "thousand", 
    "million", 
    "billion", 
    "trillion", 
    "quadrillion" 
    ); //limit t quadrillion 
    $num = number_format($num,2,".",","); 
    $num_arr = explode(".",$num); 
    $wholenum = $num_arr[0]; 
    $decnum = $num_arr[1]; 
    $whole_arr = array_reverse(explode(",",$wholenum)); 
    krsort($whole_arr); 
    $rettxt = ""; 
    foreach($whole_arr as $key => $i){ 
        if($i < 20){ 
            $rettxt .= $ones[$i]; 
        }elseif($i < 100){ 
            $rettxt .= $tens[substr($i,0,1)]; 
            $rettxt .= " ".$ones[substr($i,1,1)]; 
        }else{ 
            $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
            $rettxt .= " ".$tens[substr($i,1,1)]; 
            $rettxt .= " ".$ones[substr($i,2,1)]; 
        } 
        if($key > 0){ 
            $rettxt .= " ".$hundreds[$key]." "; 
        } 
    } 
    if($decnum > 0){ 
        $rettxt .= " and "; 
        if($decnum < 20){ 
            $rettxt .= $ones[$decnum]; 
        }elseif($decnum < 100){ 
            $rettxt .= $tens[substr($decnum,0,1)]; 
            $rettxt .= " ".$ones[substr($decnum,1,1)]; 
        } 
    } 
    return $rettxt; 
}

// Returns maximum in array
function getMax($string)
{
  $array = $string;
   $n = count($array);
   $max = $array[0];
   for ($i = 1; $i < $n; $i++)
       if ($max < $array[$i])
           $max = $array[$i];
    return $max;      
}
 
// Returns maximum in array
function getMin($string)
{
  $array = $string;
   $n = count($array);
   $min = $array[0];
   for ($i = 1; $i < $n; $i++)
       if ($min > $array[$i])
           $min = $array[$i];
    return $min;      
}

function config($columns){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select($columns);
    $ci->db->from('maxwell_config');
    $query = $ci->db->get();
    $qry = $query->result();
    return $qry;
}

function getreportscount($reportid,$roleid){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('count(*) as count');
    $ci->db->from('maxwell_submenu_user_wise_table');
    $ci->db->where('maxsubwise_menu_id',$reportid);
    $ci->db->where('maxsubwise_is_report', '1');
    $ci->db->where('maxsubwise_role_id',$roleid);
    $query = $ci->db->get();
    #echo $ci->db->last_query();
    $qry = $query->result();
    return $qry;
}

function getUserIP(){
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function create_notes($employeeid,$category,$notes,$createby){
    $empid = addslashes($employeeid);
    $ct = addslashes($category);
    $nt = addslashes($notes);
    $cr = addslashes($createby);
    $date = date('Y-m-d H:i:s');
    $user_ip = getUserIP();
    $inarray = array(
        "mxn_category" => $ct,
        "mxn_emplyeeid" => $empid,
        "mxn_desc" => $nt,
        "mxn_createdby" => $cr,
        "mxn_createdtime" => $date,
        "mxn_created_ip" => $user_ip,
        );
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->insert('maxwell_notes', $inarray);
}

function crons_log($employeeid='',$cronname='',$desc='',$query='',$status='',$createdby='',$processdate=''){
    if(empty($createdby)){ $createdby = 'AUTO';}
    $date = date('Y-m-d H:i:s');
    $user_ip = getUserIP();
    $inarray = array(
        "mx_cron" => addslashes($cronname),
        "mx_empcode" => addslashes($employeeid),
        "mx_desc" => addslashes($desc),
        "mx_query" => addslashes($query),
        "mx_status" => addslashes($status),
        "mx_run_date" => addslashes($processdate),
        "mx_createdby" => addslashes($createdby),
        "mx_createdtime" => $date,
        "mx_created_ip" => $user_ip,
        );
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->insert('maxwell_crons_log', $inarray);
}


function get_options_data($filedname){
    $op = array();
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('field_value,descr');
    $ci->db->from('options_table');
    $ci->db->where('field_name',$filedname);
    // $ci->db->where('options_status','1');
    $ci->db->Order_by('descr');
    $query = $ci->db->get();
    $qury = $query->result();
    foreach($qury as $key => $val){
        $op[$val->field_value] = $val->descr;
    }
    return $op;
}


//   --------------------------  added 24-10-2022  --------------------------


function getcommonquerydata($tablename,$column = array(), $where = array(),$join=array()){
    if(sizeof($join)>=4){
       $tablenamejoin = $join[0];
       $column1 = $join[1];
       $column2 = $join[2];
       $jointype = $join[3];
    }
    if(sizeof($join1)>=4){
        $tablenamejoin1 = $join1[0];
        $column11 = $join1[1];
        $column21 = $join1[2];
        $jointype1 = $join[3];
     }
    $ci=&  get_instance();
    $ci->load->database();
    $allcolumns =  implode(",",$column);
    $ci->db->select($allcolumns);
    $ci->db->from($tablename);
    if(sizeof($join)>=4){
        $ci->db->join($tablenamejoin,$column1.'='.$column2,$jointype);
    }
    foreach ($where as $key => $value) {
       $ci->db->where($key,$value);
    }
    // echo $ci->db->get_compiled_select();exit;
    $query = $ci->db->get();
    return $qury = $query->result();
}

function geteducationqualification($tablename,$column = array(), $where = array(),$order=array()){
    $ci=& get_instance();
    $ci->load->database();
    $allcolumns =  implode(",",$column);
    $ci->db->select($allcolumns);
    $ci->db->from($tablename);
    foreach ($where as $key => $value) {
        $ci->db->where($key,$value);
    }
    $ci->db->order_by($order[0],desc);
    $ci->db->limit(1);
        // echo $ci->db->get_compiled_select();exit;

    $query = $ci->db->get();
    return $qury = $query->result();
}

//   --------------------  end added 24-10-2022 -------------------------
    function getfileSizes($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
    function get_paysheet_generated_status($cmp_id,$year_month,$specific_emp_type = null){
        $ci=& get_instance();
        $ci->load->database();
        //-------------GET DISTINCT EMPLOYEE TYPE
        $ci->db->distinct();
        $ci->db->select("mxemp_emp_type,mxemp_emp_comp_code,mxemp_ty_name,mxemp_ty_table_name");
        $ci->db->from("maxwell_employees_info");
        $ci->db->join('maxwell_employee_type_master',"mxemp_ty_id = mxemp_emp_type","inner");
        $ci->db->where("mxemp_emp_status",1);
        $ci->db->where("mxemp_ty_cmpid",$cmp_id);
        if($specific_emp_type){
            $ci->db->where("mxemp_emp_type",$specific_emp_type);
        }
        $ci->db->order_by("mxemp_emp_type");
        $emp_type_qry = $ci->db->get();
        // echo $ci->db->last_query();exit;
        $emp_type_data = $emp_type_qry->result();
        // echo '<pre>';print_r($emp_type_data);exit;
        if(count($emp_type_data) > 0){
            
            //-------------------CHECK DATA ALREADY EXISTS OR NOT FOR ALL EMPLOYEEMENT SALARY TABLES        
            foreach($emp_type_data as $emp_type_data_1){
                // print_r($emp_type_data_1);exit;
                $table_name = $emp_type_data_1->mxemp_ty_table_name;
                $ci->db->select();
                $ci->db->from($table_name);
                $ci->db->where("mxsal_cmp_id",$cmp_id);
                $ci->db->where("mxsal_year_month",$year_month);
                $ci->db->where("mxsal_status",1);
                $qry2 = $ci->db->get();
                // echo $ci->db->last_query();exit;
                $res2 = $qry2->result();
                if(count($res2) > 0){
                    return 1;
                    die();
                }
            }
            
            return 0;
            die();
            //-------------------END CHECK DATA ALREADY EXISTS OR NOT FOR ALL EMPLOYEEMENT SALARY TABLES
        }
    }
    
    // Email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
    function sendmails($data){
    $configinfo = getemailconfig($data);
    if(count($configinfo) <= 0){
        echo 'please check the mail server';exit;
    }
    
    if(count($data['to']) > 0){
        $recipient_to = $data['to'];
    }

    if(count($data['cc']) > 0){
       $recipient_cc = $data['cc'];
    }

    if(count($data['bcc']) > 0){
        $recipient_bcc = $data['bcc'];
    }

    if(count($data['attachments']) > 0){
        $att = $data['attachments'];
    }


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
        // $mail->isSMTP();                                             //Send using SMTP
        // $mail->Host       = $configinfo[0]->smtp_hosturl;           //Set the SMTP server to send through
        // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // $mail->Username   = $configinfo[0]->smtp_hostusername;     //SMTP username
        // $mail->Password   = $configinfo[0]->smtp_hostpassword;     //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption for 465
        #$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        #$mail->SMTPSecure = false;
        #$mail->smtp_crypto = 'ssl'; // Change this to your preferred encryption type
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $configinfo[0]->smtp_hosturl;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $configinfo[0]->smtp_hostusername;                     //SMTP username
            $mail->Password   = $configinfo[0]->smtp_hostpassword;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $configinfo[0]->email_port;    

        $mail->Port       = $configinfo[0]->smtp_hostport;       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($configinfo[0]->smtp_hostusername,'Maxwell HRMS');
        #$mail->addAddress($recipient_to, $recipient_name);     // Add a recipient
        foreach ($recipient_to as $recptokey => $allrecipient) {
            if(!empty($allrecipient)){
            $mail->addAddress($allrecipient);   //Name is optional
            }
        }
        $mail->addReplyTo($configinfo[0]->smtp_hostusername,'Maxwell HRMS');

        foreach ($recipient_cc as $recpcckey => $ccrecipient) {
            if(!empty($ccrecipient)){
            $mail->addCC($ccrecipient);
            }
        }
        foreach ($recipient_bcc as $recpbcckey => $bccrecipient) {
            if(!empty($bccrecipient)){
            $mail->addBCC($bccrecipient);
            }
        }
        // print_r($mail);exit;
        //Attachments
        foreach ($att as $attkey => $attval) {
            if(!empty($attval)){
           $mail->addAttachment($attval);         //Add attachments
            }
        }
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['body'];
        $res = $mail->send();
        // print_r($res); exit;
        if($res == 1){
            mail_log($data,$res);
            echo json_encode(array('respone' => 200));
        }else{
            mail_log($data,$res);
            echo json_encode(array('respone' => 400));
        }
    } catch (Exception $e) {
        $res = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        mail_log($data,$res);
        echo json_encode(array('respone' => 400));
    }
    }
    
    function getemailconfig($data){
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('smtp_hosturl,smtp_hostport,smtp_hostusername,smtp_hostpassword');
        $ci->db->from('maxwell_config');
        $query = $ci->db->get(); 
        return $qry = $query->result();
    }

    function mail_log($data,$response){
        $ci=& get_instance();
        $ci->load->database();
        $date = date('Y-m-d H:i:s');
        $ip = get_client_ip();
        $inarray = array(
            'email_type' => $data['type'],
            'email_sent' => json_encode($data),
            'email_response' => $response,
            'createdby' =>  $data['createdby'],
            'createdtime' => $date,
            'createdempid' => $data['createdempcode'],
            'created_ip' => $ip
        );
        $ci->db->insert('maxwell_work_email_sent_log', $inarray);
    }
    // Email
    // json tags
    function custom_tags($employeeid='',$desc='',$tagsrender=false){
        $ci=& get_instance();
        $ci->load->database(); 

        // Employee Info
        $ci->db->select('mxemp_emp_autouniqueid,mxemp_emp_date_of_join,mxemp_emp_comp_code,mxemp_emp_division_code,mxemp_emp_branch_code,mxemp_emp_sub_branch_code,mxemp_emp_dept_code,mxemp_emp_grade_code,mxemp_emp_desg_code,mxemp_emp_state_code,mxemp_emp_type,mxemp_emp_type_name,mxemp_emp_id,mxemp_emp_fname,mxemp_emp_lname,mxemp_emp_img,mxemp_emp_gender,mxemp_emp_marital_status,mxemp_emp_bloodgroup,mxemp_emp_phone_no,mxemp_emp_alt_phn_no,mxemp_emp_email_id,mxemp_emp_company_email_id,mxemp_emp_date_of_birth,mxemp_emp_mother_tongue,mxemp_emp_caste,mxemp_emp_age,mxemp_emp_empguarantorsdetails,mxemp_emp_license,mxemp_emp_present_address1,mxemp_emp_present_address2,mxemp_emp_present_city,mxemp_emp_present_state,mxemp_emp_present_country,mxemp_emp_present_postalcode,mxemp_emp_fixed_address1,mxemp_emp_fixed_address2,mxemp_emp_fixed_city,mxemp_emp_fixed_state,mxemp_emp_fixed_country,mxemp_emp_fixed_postalcode,mxemp_emp_current_salary,mxemp_emp_bank_name,mxemp_emp_bank_branch_name,mxemp_emp_bank_acc_no,mxemp_emp_bank_ifsci_no,mxemp_emp_panno,mxemp_emp_esi_number,mxemp_emp_pf_number,mxemp_emp_uan_number,mxemp_emp_status,mxcp_name,mxdesg_name,mxdpt_name,mxd_name,mxb_name,mxgrd_name,mxemp_emp_having_vehicle,mxemp_emp_vehicle_type,mxemp_emp_resignation_status,mxemp_emp_resignation_reason,mxemp_emp_resignation_date,mxemp_emp_resignation_relieving_date,mxemp_emp_resignation_relieving_settlement_date,mxemp_emp_resignation_relieving_settlement_amount,mxemp_emp_resignation_relieving_esi_settlement_date,mxemp_emp_resignation_relieving_pf_settlement_date,mxemp_emp_panimage,mxemp_emp_aadhar,mxemp_emp_aadharimage,mxst_state,mxemp_ty_name,mxemp_emp_guarantors_letter,empmaritaldate,mxemp_emp_is_without_notice_period,mxemp_emp_unpay_sal_months,mxemp_emp_joiningorgination,mxemp_emp_joiningorginationofferpackage,mxemp_emp_joiningorginationdesignation,mxemp_emp_resignationletter,mxemp_emp_employee_lic_no,mxemp_emp_gratuity,mxemp_emp_esiimage,mxemp_emp_bankimage,mxemp_emp_nameasperbank,mxemp_emp_lic_info1,mxemp_emp_lic_info2,mxemp_emp_lic_info3,mxemp_emp_lic_info4,mxemp_emp_relation_name,mxemp_emp_relation');
        $ci->db->from('maxwell_employees_info');
        $ci->db->join('maxwell_company_master', 'mxcp_id = mxemp_emp_comp_code', 'INNER');
        $ci->db->join('maxwell_designation_master', 'mxdesg_id = mxemp_emp_desg_code', 'INNER');
        $ci->db->join('maxwell_department_master', 'mxdpt_id = mxemp_emp_dept_code', 'INNER');
        $ci->db->join('maxwell_division_master', 'mxd_id = mxemp_emp_division_code', 'INNER');
        $ci->db->join('maxwell_branch_master', 'mxb_id = mxemp_emp_branch_code', 'INNER');
        $ci->db->join('maxwell_grade_master', 'mxgrd_id = mxemp_emp_grade_code', 'INNER');
        $ci->db->join('maxwell_state_master', 'mxst_id = mxemp_emp_state_code', 'INNER');
        $ci->db->join('maxwell_employee_type_master', 'mxemp_ty_id = mxemp_emp_type', 'INNER');
        $ci->db->where('mxemp_emp_id', $employeeid);
        $query1 = $ci->db->get();
        $qry1 = $query1->result();
        $buildarray['employeeinfo'] = $qry1;
        // Employee Info
        $tags = array(
            "{currentdate}" => DBD,
            #employee personel info
            "{employee_name}" => ($buildarray['employeeinfo'][0]->mxemp_emp_fname.$buildarray['employeeinfo'][0]->mxemp_emp_lname),
            "{employee_email}" => $buildarray['employeeinfo'][0]->mxemp_emp_email_id,
            "{employee_mobile}" => $buildarray['employeeinfo'][0]->mxemp_emp_phone_no,
            "{pancard}" => $buildarray['employeeinfo'][0]->mxemp_emp_panno,
            #employee personel info
            #master
            "{employee_company}" => $buildarray['employeeinfo'][0]->mxcp_name,
            "{employee_division}" => $buildarray['employeeinfo'][0]->mxd_name,
            "{employee_state}" => $buildarray['employeeinfo'][0]->mxst_state,
            "{employee_branch}" => $buildarray['employeeinfo'][0]->mxb_name,
            "{employee_department}" => $buildarray['employeeinfo'][0]->mxdpt_name,
            "{employee_designation}" => $buildarray['employeeinfo'][0]->mxdesg_name,
            "{employee_grade}" => $buildarray['employeeinfo'][0]->mxgrd_name,
            "{employee_type}" => $buildarray['employeeinfo'][0]->mxemp_ty_name,
            "{employee_code}" => $buildarray['employeeinfo'][0]->mxemp_emp_id,
            #master
            #bank
            "{employee_date_of_join}" => $buildarray['employeeinfo'][0]->mxemp_emp_date_of_join,
            "{bank_name}" => $buildarray['employeeinfo'][0]->mxemp_emp_bank_name,
            "{bank_account_number}" => $buildarray['employeeinfo'][0]->mxemp_emp_bank_acc_no,
            "{bank_ifsc_code}" => $buildarray['employeeinfo'][0]->mxemp_emp_bank_ifsci_no,
            "{bank_branch}" => $buildarray['employeeinfo'][0]->mxemp_emp_bank_branch_name,
            "{bank_account_holder_name}" => $buildarray['employeeinfo'][0]->mxemp_emp_nameasperbank,
            #bank
            "{employee_esi_no}" => $buildarray['employeeinfo'][0]->mxemp_emp_esi_number,
            "{employee_pf_no}" => $buildarray['employeeinfo'][0]->mxemp_emp_pf_number,
            "{employee_uan_no}" => $buildarray['employeeinfo'][0]->mxemp_emp_uan_number,
            #salary
            "{current_salary}" => $buildarray['employeeinfo'][0]->mxemp_emp_current_salary,
            #salary
        );
        if(!empty($desc)){
            preg_match_all('/{.*?}/', $desc, $matches);
            if(count($matches[0]) > 0){
                $searchkeys = array_keys($tags);
                $replacevalues = array_values($tags);
                $replace_desc = str_replace($searchkeys,$replacevalues, $desc);
                return $replace_desc; die();
            }
        }
        if($tagsrender == false){
            return $tags;
        }
        return $tags;
    }
    // json tags
    // Dynamic Excel
    function dynamicexcel($db,$maildata,$fileinfo,$sendmail = false,$type = 'manual'){
        $ci=& get_instance();
        $ci->load->library('excel'); 
        $sheetname = $fileinfo['sheetname'];
        $filename = $sheetname.'.xls';
        $folder = $fileinfo['folderpath'];
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if($type == 'cron'){
            $pathtype = CRONROOTDOCUMENT;
        }else{
            $pathtype = ROOTDOCUMENT;
        }
        $path = $pathtype.$folder.$filename;

        #$this->load->library('excel');
        $ci->excel->setActiveSheetIndex(0);
        $ci->excel->getActiveSheet()->setTitle($sheetname);

        $values = $db;
        $header = array_keys($values[0]);

        $ci->excel->getActiveSheet()->fromArray($header);
        // $ci->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setSize(12);
        // $ci->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);
        // $ci->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $sheet = $ci->excel->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $ci->excel->getActiveSheet()->fromArray($values, null, 'A2');

        $objWriter = PHPExcel_IOFactory::createWriter($ci->excel, 'Excel5'); 
        $objWriter->save($path);
        
        #bulid mail formate
        $tos = array();
        $ccs = array();
        $bccs = array();
        $attachments = array();
        $to = explode(",", $maildata['to']);
        foreach ($to as $key => $tval) {
            array_push($tos, $tval);
        }

        $cc = explode(",", $maildata['cc']);
        foreach ($cc as $key => $cval) {
            array_push($ccs, $cval);
        }

        $bcc = explode(",", $maildata['bcc']);
        foreach ($bcc as $key => $bcval) {
            array_push($bccs, $bcval);
        }
        if(file_exists($path)){
        $attachments = array($path);
        }
        $senddata = array(
            "type" => 'CRON',
            "id" => $maildata['templates'],
            'to' => $tos,
            'cc' => $ccs,
            'bcc' => $bccs,
            'subject' => $maildata['subject'],
            'body' => $maildata['mdesc'],
            'attachments' => $attachments,
            'createdby' => 'CRON',
            'createdempcode' => '0',
        );
        // echo '<pre>';print_r($senddata);
        if($sendmail == true){
        sendmails($senddata);
        }
        #build mail fromate
    }
    // Dynamic Excel

    function rendertags($tags = array(),$userdesc = '',$templateid = ''){
        $tags["{currentdate}"] = DBD;
        if(!empty($templateid)){
            $ci=& get_instance();
            $ci->load->database();
            $ci->db->select('id,email_title,email_body,email_subject');
            $ci->db->from('maxwell_email_templates');
            $ci->db->where('email_status', '1');
            $ci->db->where('id', $templateid);
            $query = $ci->db->get(); 
            $letters = $query->result();
            $desc = $letters[0]->email_body;
            $subject = $letters[0]->email_subject;
        }

        if(!empty($userdesc)){
            $desc = $userdesc;
        }

        if(!empty($desc)){
            preg_match_all('/{.*?}/', $desc, $matches);
            if(count($matches[0]) > 0){
                $searchkeys = array_keys($tags);
                $replacevalues = array_values($tags);
                $replace_desc = str_replace($searchkeys,$replacevalues, $desc);
                return $replace_desc;
            }else{
            return $desc;    
            }
        }else{
            return $desc;
        }
    }
    function getallleavetypescompanywise($companyid = '',$type=''){
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('mxlt_leave_short_name');
        $ci->db->from('maxwell_leave_type_master');
        $ci->db->where('mxlt_comp_id',$companyid);
        if($type == 'attendance'){
        $ci->db->where('mxlt_showinattendance','1');
        $ci->db->Order_by('showinattendance_order');
        }
        $query = $ci->db->get(); 
        return $qry = $query->result();
    }
    
    function getemployeefirstandlastpunches($date='',$employeeid=''){
        $ci=& get_instance();
        $ci->load->database();
        if($date == ''){
            $year = date('Y');
            $attdt = date('Y-m-d');
        }else{
            $year = date('Y', strtotime($date));
            $attdt = $date;
        }
        
        $qle ="select MIN(attendance_time) AS first_punch, MAX(attendance_time) as last_punch from employee_punches_$year where DATE(attendance_date) = '$attdt' and employee_code='$employeeid'";
        $queryle = $ci->db->query($qle);
        return $queryle->result_array();
    }
    // returns the logged in user permission based branches,states,divisions
    function filterMasterDropdownsBasedonEmployeePermissions($companyid = '',$divisionid = '',$stateid = '',$branchid = ''){
        $ci=& get_instance();
        
    	if($ci->session->userdata('user_limiteddropdowns') == 1){
    
    		if(empty($companyid)){
    			$companyid = $ci->session->userdata('user_company');
    		}
    
    		if(empty($divisionid)){
    			$divisionid = $ci->session->userdata('user_division');
    		}
    
    		if(empty($stateid)){
    			$stateid = $ci->session->userdata('user_state');
    		}  
    
    		if(empty($branchid)){
    			$bruser = $ci->session->userdata('user_branch');
    	        $brselected = $ci->session->userdata('user_custom_branches');
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
    
    	        $branchid = implode(",", $bruser_assigned_br);
    		}      
            
        }
        
        return $array = array('filter_comp' => $companyid, 'filter_div' => $divisionid, 'filter_state' => $stateid, 'filter_branch' => $branchid);
    }
    
        function dynamicTable($result,$columns,$linkColumns = array(), $editColumns = array(), $dataMappingColumns = array(), $renameHeaderColumns = array(), $hideColumn = array(), $reportName = ''){

        // Define the JSON response structure
        $response = [
            'columns' => array_merge(['SNo'], $columns),  // Include SNo as the first column
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'data' => [],
            'reportName' => $reportName,
        ];
        $replacename = '';

         // Populate the "data" array with rows
        $sno = 1;  // Initialize Serial Number counter
        $jsonReject = 1;
        foreach ($result as $row) {
            $rowData = ['SNo' => $sno++];  // Add serial number for the row

            foreach ($columns as $col) {
                if (in_array($col, $hideColumn)) {
                    continue;
                }
                if (array_key_exists($col, $linkColumns)) {
                    // Make column a clickable link
                    if (array_key_exists($col, $dataMappingColumns['Translate'])) {
                        $masters = getmasternames($dataMappingColumns['Translate'][$col]);
                        if(isset($linkColumns[$col]['UrlLinkID'])){
                            $columUrl = $linkColumns[$col]['UrlLinkID']; 
                        }else{
                            $columUrl = $col;
                        }
      
                        if (strpos($row->$col, ',') !== false) {
                            $replace_desc = explode(',', $row->$col);
                            foreach ($replace_desc as $rekey => $reval) {
                                $replacename .= $masters[$dataMappingColumns['Translate'][$col]][$reval] ?? ''; // Use null coalescing for safety
                                $replacename .= ',';
                            }
                            $replacename = rtrim($replacename, ',');

                        } else {
                            // Handle cases where no comma is present
                            $replacename = $masters[$dataMappingColumns['Translate'][$col]][$row->$col] ?? 'No Translation Found';
                        }

                        $rowData[$col] = '<a href="'.$linkColumns[$col]['UrLLink'].$row->$columUrl.'" target="_blank">' . $replacename . '</a>';
                    }else{
                        if(isset($linkColumns[$col]['UrlLinkID'])){
                            $columUrl = $linkColumns[$col]['UrlLinkID']; 
                        }else{
                            $columUrl = $col;
                        }
                       $rowData[$col] = '<a href="'.$linkColumns[$col]['UrLLink'].$row->$columUrl.'" target="_blank">' . $row->$col . '</a>';
                    }
                } elseif (array_key_exists($col, $editColumns)) {
                    // Add an Edit Button for editable columns
                    $aDFunction = 'onclick="' . $editColumns[$col]['AddFunction'] . '(\'\', \'' . $editColumns[$col]['AddModelFunction'] . '\', \'' . $row->$col . '\', \'' . $jsonReject . '\')"';
                    $rowData[$col] = '<a href="#" data-bs-toggle="modal" data-bs-target="#' . $editColumns[$col]['CallID'] . '" ' . $aDFunction . '><i class="fas fa-pen"></i></a>';
                } else {
                    // Regular column data
                    $rowData[$col] = $col === 'CreatedDt' ? date('d-m-Y', strtotime($row->$col)) : $row->$col;
                    if (array_key_exists($col, $dataMappingColumns['Translate'])) {
                        $masters = getmasternames($dataMappingColumns['Translate'][$col]);
                            if (strpos($row->$col, ',') !== false) { 
                                $replace_desc = explode(',', $row->$col);
                                foreach ($replace_desc as $rekey => $reval) {
                                    $replacename .= $masters[$dataMappingColumns['Translate'][$col]][$reval] ?? ''; // Use null coalescing for safety
                                    $replacename .= ',';
                                }
                                $replacename = rtrim($replacename, ',');

                            } else {
                                // Handle cases where no comma is present
                                $replacename = $masters[$dataMappingColumns['Translate'][$col]][$row->$col] ?? 'No Translation Found';
                            }
                        $rowData[$col] = $replacename;
                    }
                }
            }


            $response['columns'] = array_map(function ($column) use ($renameHeaderColumns) {
                return $renameHeaderColumns[$column] ?? $column; // Replace if mapping exists, otherwise keep original
            }, $response['columns']);

            $response['columns'] = array_filter($response['columns'], function ($column) use ($hideColumn) {
                return !in_array($column, $hideColumn);
            });

            $renamedRow = array();
            foreach ($rowData as $key => $value) {
                if (in_array($key, $hideColumn)) {
                    continue; // Skip hidden columns
                }
                // Check if the key exists in the mapping, otherwise retain the original key
                $newKey = isset($renameHeaderColumns[$key]) ? $renameHeaderColumns[$key] : $key;
                $renamedRow[$newKey] = $value;
            }
           $response['data'][] = $renamedRow;
        }

        if (empty($response['data'])) {
            $response['columns'] = array_map(function ($column) use ($renameHeaderColumns) {
                return $renameHeaderColumns[$column] ?? $column; // Replace if mapping exists, otherwise keep original
            }, $response['columns']);

            $response['columns'] = array_filter($response['columns'], function ($column) use ($hideColumn) {
                return !in_array($column, $hideColumn);
            });

            $renamedRow = array();
            foreach ($rowData as $key => $value) {
                if (in_array($key, $hideColumn)) {
                    continue; // Skip hidden columns
                }
                // Check if the key exists in the mapping, otherwise retain the original key
                $newKey = isset($renameHeaderColumns[$key]) ? $renameHeaderColumns[$key] : $key;
                $renamedRow[$newKey] = $value;
            }
           $response['data'] = $renamedRow;
        }
        // Return JSON response
        return json_encode($response);
    }

     function getmasternames($filedname){
        $common = array();
        // switch ($filedname) {
        // case 'Originations':
        //     $OriginationData = $this->Common_model->options_data($filedname);
        //     foreach($OriginationData as $orkey => $orval){
        //         $common[$orval->field_value] = $orval->descr;
        //     }
        // break;
        // case 'Auditor':
        //     $AuditorData = $this->Common_model->options_data($filedname);
        //     foreach($AuditorData as $aukey => $auval){
        //         $common[$auval->field_value] = $auval->descr;
        //     }
        // break;
        // case 'Users';
        //     $UsersData = $this->Common_model->options_data($filedname);
        //     foreach($UsersData as $uskey => $usval){
        //         $common[$usval->field_value] = $usval->descr;
        //     }
        // break;
        // default:
        //     $CMData = $this->Common_model->options_data($filedname);
        //     foreach($CMData as $cskey => $csval){
        //         $common[$csval->field_value] = $csval->descr;
        //     }
        // break;
        // }
        // $master = array($filedname => $common);
        $master = array($filedname => $common);
        return $master;
    }
    
    function formatIndianCurrency($num) {
        $num = number_format($num, 2, '.', '');
        $parts = explode('.', $num);
    
        $last3 = substr($parts[0], -3);
        $rest = substr($parts[0], 0, -3);
    
        if ($rest != '') {
            $last3 = ',' . $last3;
        }
    
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
    
        return $rest . $last3 . '.' . $parts[1];
    }

    function checkSalaryExists($data){
        $companyid = $data['companyid'] ?? 0;
        $divisionid = $data['divisionid'] ?? 0;
        $stateid = $data['stateid'] ?? 0;
        $branchid = $data['branchid'] ?? 0;
        $employeeid = $data['employeeid'] ?? 0;
        $attendancemonthyear = $data['attendancedate'];
        $ci =& get_instance();
        $ci->load->database();

        $currentYearMonth = date('Ym', strtotime($attendancemonthyear));
        $fromYearMonth    = date('Ym', strtotime($attendancemonthyear));

        $tables = $ci->db->query("
            SELECT DISTINCT mxemp_ty_table_name
            FROM maxwell_employee_type_master
            WHERE mxemp_ty_table_name IS NOT NULL
            AND mxemp_ty_table_name != ''
        ")->result_array();

        foreach ($tables as $row) {

            $table = trim($row['mxemp_ty_table_name']);

            if (!$ci->db->table_exists($table)) {
                continue;
            }

            $ci->db->select('1');
            $ci->db->from($table . ' s');
            $ci->db->where('s.mxsal_year_month >=', $fromYearMonth);
            $ci->db->where('s.mxsal_year_month <=', $currentYearMonth);
            $ci->db->where('s.mxsal_status', 1);

            if (!empty($companyid) && $companyid != 0) {
                $ci->db->where('s.mxsal_cmp_id', $companyid);
            }

            if (!empty($divisionid) && $divisionid != 0) {
                $ci->db->where('s.mxsal_div_id', $divisionid);
            }

            if (!empty($stateid) && $stateid != 0) {
                $ci->db->where('s.mxsal_state_code', $stateid);
            }

            if (!empty($branchid) && $branchid != 0) {
                $ci->db->where('s.mxsal_branch_code', $branchid);
            }

            if (!empty($employeeid)) {
                $ci->db->where('s.mxsal_emp_code', $employeeid);
            }

            $ci->db->limit(1);
            // echo $ci->db->get_compiled_select();exit;
            $query = $ci->db->get();
            
            if ($query->num_rows() > 0) {
                return true;
            }
        }

        return false;
    }
?>