<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Cron extends Common {
	protected $imglink = 'uploads/';
    public function __construct() {
        parent::__construct();
        $this->load->model('Cronmodel');
        $this->load->library('email');
    }
    
public function verifylogin(){
	if(empty($this->session->userdata('user_id'))){
		redirect(base_url() . 'admin/logout');die();
	}
}


//  =================== cron manual update previous balance into minus balance ==============

public function cronleaveadjuest(){
    $res = $this->Cronmodel->cronleaveadjuest();
    if($res == 200){
        echo '200';die();
    }else{
        echo '500';die();
    }

}
//  =================== cron manual update previous balance into minus balance ==============


public function manualleavescronrunning(){
        $this->verifylogin();
        $this->header();
        $this->load->view('cron/cronleaves');
        $this->footer();
}

    public function manual_leaves_cron(){
        $this->verifylogin();
        $this->header();
        $this->load->view('cron/attendance_punch');
        $this->footer();
    }


public function Clcronmodel(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $userdata = 0;
    // print_r($printable); exit;
    $res = $this->Cronmodel->clcronmodel(2,$userdata,$printable);
    echo json_encode($res);
}

public function Elcronmodel(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $userdata=0;
    $res=$this->Cronmodel->clcronmodel(1,$userdata,$printable);
    echo json_encode($res);
}

public function Slcronmodel(){ 
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $userdata=0;
    $res=$this->Cronmodel->clcronmodel(3,$userdata,$printable);
    echo json_encode($res);
}

public function ohcronmodel(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $userdata=0;
    $res=$this->Cronmodel->ohcronmodel(4,$userdata,$printable);
    echo json_encode($res);
}

public function ochcronmodel(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $userdata=0;
    $res=$this->Cronmodel->ohcronmodel(12,$userdata,$printable);
    echo json_encode($res);
}

// --------------------  added C 03-12-2021 ------------

public function manualyearcron(){
    $this->verifylogin();
       $this->header();
       $date1 = date('Y-m');
       $dateexp = explode('-',$date1);
      if($dateexp[1]==01){
        $month=12;
        $year =$dateexp[0]-1;
        $date= $year.'-'.$month;
       }else{
        $month=$dateexp[1]-1;
        $year =$dateexp[0];
        $date= $year.'-'.$month;
       }
      // $data['yearcrondate']=  date("Y-m-t", strtotime($date));
       $data['yearcrondate']= $date;
       $this->load->view('cron/monthyearcron',$data);
       $this->footer();
}

public function yearmonthdate(){
    $date1 = date('Y-m');
    $dateexp = explode('-',$date1);
   if($dateexp[1]==01){
     $month=12;
     $year =$dateexp[0]-1;
     $date= $year.'-'.$month;
    }else{
     $month=$dateexp[1]-1;
     $year =$dateexp[0];
     $date= $year.'-'.$month;
    }
   $ymdate=  date("Y-m-t", strtotime($date));
   return $ymdate;
}

public function Clcronmodeldatewise(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $ymdate=$this->yearmonthdate();
    $res = $this->Cronmodel->clcronmodeldatewise(2,$ymdate,$printable);
    echo json_encode($res);
}

public function Elcronmodeldatewise(){
    $printable = $this->input->post('printable');
    if(empty($printable)){
            $printable = 'N';
    }
    $ymdate=$this->yearmonthdate();
    $res=$this->Cronmodel->clcronmodeldatewise(1,$ymdate,$printable);
    echo json_encode($res);
}

public function Slcronmodeldatewise(){
    
    $printable = $this->input->post('printable');
    if(empty($printable)){
        $printable = 'N';
    }
    $ymdate=$this->yearmonthdate();
    $res=$this->Cronmodel->clcronmodeldatewise(3,$ymdate,$printable);
    echo json_encode($res);
}

// --------------  end added C 03-12-2021 ------------




//public function Shrtlcronmodel(){
  //  $this->verifylogin();
    //$this->Cronmodel->clcronmodel(10);
//}
//----------------NEW BY SHABABU(06-06-2021)
public function sat_sun_mon_cron(){
    if($this->input->post('cron_month_year')){
        $data['cron_month_year'] = $this->input->post('cron_month_year');
        $data['cmp_id'] = $this->input->post('cmp_id');
        $data['cron_status'] = "manual";
    }else{
        $data['cron_month_year'] = null;
        $data['cmp_id'] = null;
        $data['cron_status'] = "auto";
    }
    // print_r($data);exit;
    $res = $this->Cronmodel->sat_sun_mon_cron_model($data);
}

//----------------END NEW BY SHABABU(06-06-2021)
//----------------NEW BY SHABABU(12-06-2022)
public function public_holiday_absent_cron(){
    /*
    Author : SHABABU(12-06-2022)
    Descr  : IT RUNS EVERY MONTH end night at 11oclock like that
    eg : AB PH AB then make it as AB AB AB
    */
    if($this->input->post('cron_month_year')){
        $data['cron_month_year'] = $this->input->post('cron_month_year');
        $data['cmp_id'] = $this->input->post('cmp_id');
        $data['cron_status'] = "manual";
    }else{
        $data['cron_month_year'] = null;
        $data['cmp_id'] = null;
        $data['cron_status'] = "auto";
    }
    // print_r($data);exit;
    $res = $this->Cronmodel->public_holiday_absent_cron($data);
}

//----------------END NEW BY SHABABU(12-06-2022)

public function transfer_cron(){
    if($this->input->post('cron_month_year')){
        $data['cron_month_year'] = $this->input->post('cron_month_year');
        $data['cmp_id'] = $this->input->post('cmp_id');
        $data['cron_status'] = "manual";
    }else{
        $data['cron_month_year'] = null;
        $data['cmp_id'] = null;
        $data['cron_status'] = "auto";
    }
    $res = $this->Cronmodel->transfer_cron($data);
    echo json_encode($res);
}
public function increments_cron(){
    if($this->input->post('cron_month_year')){
        $data['cron_month_year'] = $this->input->post('cron_month_year');
        $data['cmp_id'] = $this->input->post('cmp_id');
        $data['cron_status'] = "manual";
    }else{
        $data['cron_month_year'] = null;
        $data['cmp_id'] = null;
        $data['cron_status'] = "auto";
    }
    $res = $this->Cronmodel->increments_cron($data);
}

// ----------------------added 13-08-2021--------------



public function  year_end_corn(){
    $this->verifylogin();
    $this->header();
    $this->load->view('cron/cronyearendleaves');
    $this->footer();
}

public function yearendcorn(){
    $year = $this->input->post('cronyeard');
    if(empty($year)){
        $year = date('Y');
    }
    $printable = $this->input->post('printable');
    if(empty($printable)){
        $printable = 'N';
    }
   
    $res = $this->Cronmodel->year_end_corn($year,$printable);
    echo json_encode($res);
}

public function cronyearlist(){
    // $year = '2020';
    $year = $this->input->post('cronyear');
    $res['cnlist'] = $this->Cronmodel->cronyearlist($year);
    $countarr = sizeof($res['cnlist']);
    if($countarr > 0){
        $this->load->view('cron/cronyearend',$res);
    }else{
       echo '800'; die;
    }
}

// ----------------------end added 13-08-2021--------------

    public function process_attendance_accumulation(){
        $this->verifylogin();
        $this->header();
        $this->load->view('cron/attendance_punch');
        $this->footer();
    }

    public function attendance_cron(){
//         ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
        $companyid = 1;

        $attendancedate = $this->input->post('attendance');
        if(!empty($attendancedate)){
            $attendancedate = date('Y-m-d', strtotime($this->input->post('attendance')));
        }else{
            //$attendancedate = date('Y-m-d');
            $attendancedate = date('Y-m-d', strtotime(' - 1 days'));
        }

        $employeeid = $this->input->post('employeeid');
        if(empty($employeeid)){
            $employeeid = '';
        }
        
        $printable = $this->input->post('printable');
        if(empty($printable)){
            $printable = 'N';
        }

        $data['resp'] = $this->Cronmodel->attendance_cron($companyid,$attendancedate,$employeeid,$printable);
        echo json_encode( $data['resp']);
        // $data['attendancedate'] = $attendancedate;
        // $data['titlehead'] = 'Attendancedate Accumulation';
        // $data['excelheading'] = 'Attendancedate Accumulation';
        // $this->load->view('cron/attendance_punch_process_list',$data);
    }
    
    public function test_cron(){
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST']; 
        // $url.= $_SERVER['REQUEST_URI'];    

        // the message
        $msg = "First line of text\nSecond line of text";
                $array = array('name'=>'dummy','Url'=>$url);
        $res = $this->db->insert('cron_log',$array);
        if($res){
            echo "success";
        }else{
            echo "failed";
        }
        // use wordwrap() if lines are longer than 70 characters
        // $msg = wordwrap($msg,70);
        
        // send email
        // if(mail("developershababu@gmail.com","My subject",$msg)){
        //     echo "sucess";
        // }else{
        //     echo "failed";
        // }exit;
        // $this->email->from('shababu550@gmail.com', 'Shababu');
        // $this->email->to('shashavali739@gmail.com');
         
        // $this->email->subject('Email Test');
        // $this->email->message('Testing the email class.');
        // // $this->email->send();
        // if ( ! $this->email->send())
        // {
        //         echo "NOT SUCCESS";
        // }else{
        //         echo "SUCCESS";
        // }

        // echo phpinfo();exit;
            
        // $to = "shashavali739@gmail.com";
        // $subject = "My subject";
        // $txt = "Hello world!";
        // $headers = "From: shababu550@gmail.com" . "\r\n" .
        // "CC: krandhirjeevan@gmail.com";
        
        // if(mail($to,$subject,$txt,$headers)){
        //     echo "success";
        // }else{
        //     echo "failed";
        //     $errorMessage = error_get_last()['message'];
        // }

    }
    
    public function notification_datesupdate(){
      $data['resp'] = $this->Cronmodel->notification_datesupdate(); 
       echo json_encode($data['resp']);
    }

    public function SHRTcronmodel(){
        $printable = $this->input->post('printable');
        if(empty($printable)){
                $printable = 'N';
        }
        $userdata=0;
        $res=$this->Cronmodel->SHRTcronmodel(11,$userdata,$printable);
        echo json_encode($res);
    }
    
    // -------------------added 02-02-2023----------------
    
    
    public function manual_relieving_cron(){
        $this->verifylogin();
        $this->header();
        $this->load->view('cron/manual_relieving_cron');
        $this->footer();
    }
    
    /*
    public function resignattendance(){
        // print_r($_POST); exit;
        $printable = $this->input->post('printable');
        if(empty($printable)){
                $printable = 'N';
        }
        $cntdt = $this->input->post('crondate');
        if(empty($cntdt)){
            $cntdt=date('Y-m-d');
        }
        $empid = $this->input->post('empid');
        if(empty($empid)){
            $empid = '';
        }
        $res=$this->Cronmodel->resignattendance($cntdt,$empid,$printable);
        echo $res;  exit;
    }
    */
    
    //  ----------  added 21-01-2024 -----------
    
    public function resignattendance(){
        $printable = $this->input->post('printable');
        if(empty($printable)){
                $printable = 'N';
        }
        $cntdt = $this->input->post('date');
        $empid = $this->input->post('empid');
        if(empty($empid)){
            $empid = '';
        }   
        $res=$this->Cronmodel->resignattendance($cntdt,$empid,$printable);
        echo $res;  exit;        
    }

    public function cron_resignattendance(){
        $printable = $this->input->post('printable');
        if(empty($printable)){
                $printable = 'N';
        }
        $res=$this->Cronmodel->resignattendance($cntdt='',$empid='',$printable);
        echo json_encode($res);      
    }
     
     //  ----------- end added 21-01-2024 ----------
    
    //  ----------------- end added 02-02-2023 ------------
    public function latecommingreport(){
        // echo 'hi';exit;
        $db = $this->Cronmodel->latecomming_details();
    }
    
    public function leave_cron_accept(){
        $db = $this->Cronmodel->leave_cron_accept();
        // echo $res;  exit;
    }
    
    // IT UPDATE THE RESIGN STATUS FOR THAT MONTH
    public function update_resign_status(){
        
        $currentDate = date('Y-m-d');
        $currentMonth = date('m');
        $currentYear = date('Y');
        if($this->input->post('cron_month_year')){// MANUAL CRON
            $passedMonthYear =  $this->input->post('cron_month_year');
            $passedDate = date('Y-m-d',strtotime('01-'.$passedMonthYear));
            $passedMonth = date('m',strtotime($passedDate));
            $passedYear = date('Y',strtotime($passedDate));
            
            $data['fromDate'] = $passedDate;
            if($currentMonth == $passedMonth){// If Current month and passed month are same then pass the current date
                $data['toDate'] = $currentDate;
            }else if($passedMonth > $currentMonth){
                $message = "You cant Select future months";
                getjsondata(0,$message);
            }else{// if current month and passed month not same then pass the last day of the month
                // Get the number of days in the given month and year
                $lastDay = cal_days_in_month(CAL_GREGORIAN, $passedMonth, $passedYear);
                $data['toDate'] = date('Y-m-d',strtotime($lastDay.'-'.$passedMonthYear));
            }
        }else{// AUTOMATION CRON
            $data['fromDate'] = $currentYear.'-'.$currentMonth.'-01';
            $data['toDate']   = $currentDate;
        }
        // print_r($data);exit;
        $res = $this->Cronmodel->update_resign_status($data);
        echo json_encode($res);
    }
    
    public function monthlyleavessummary(){
        $db = $this->Cronmodel->lastmonthleavesappiledsummary();
    }
    
    public function monthlyregulationssummary(){
        $db = $this->Cronmodel->lastmonthregulationsappiledsummary();
    }
    
    public function get_essl_attendance_cron(){
        $url = "http://www.esslcloud.com/MLPL/webapiservice.asmx";
        $punchType = "ESSL";
        $deviceId = 'QJT3252300375';
        $username = 'API';
        $password = 'Api@12345';

        $attendancedate = $this->input->post('attendance');
        
        $currentDate = date('Y-m-d');
        $currentHour = date('H');
        
        if(!empty($attendancedate)){
            $attendancedate = date('Y-m-d', strtotime($this->input->post('attendance')));
            $fromDateTime = $attendancedate . " 00:00:00";
            $toDateTime   = $attendancedate . " 23:59:59";
        }else{
            
            if ($currentHour == '01') {
                $fromDateTime = date('Y-m-d 00:00:00', strtotime('-1 day'));
                $toDateTime   = date('Y-m-d 23:59:59', strtotime('-1 day'));
            } else {
                #$currentDate = date('Y-m-d',strtotime('-1 day'));#testing 
                $fromDateTime = $currentDate . " 00:00:00";
                $toDateTime   = $currentDate . " 23:59:59";
            }
        }
        
        $printable = $this->input->post('printable');
        if(empty($printable)){
            $printable = 'N';
        }
        
        header('Content-Type: application/json');

        $body = '
        <GetTransactionsLog xmlns="http://tempuri.org/">
        <FromDateTime>'.$fromDateTime.'</FromDateTime>
        <ToDateTime>'.$toDateTime.'</ToDateTime>
        <SerialNumber>'.$deviceId.'</SerialNumber>
        <UserName>'.$username.'</UserName>
        <UserPassword>'.$password.'</UserPassword>
        <strDataList></strDataList>
        </GetTransactionsLog>
        ';
        
        $response = $this->callSoapAPI($url,"GetTransactionsLog",$body);
        
        if(!$response['status']){
            echo $response['error'];
            exit;
        }
        
        $xmlString = $response['response']; // SOAP response
        $xml = simplexml_load_string($xmlString);
        $xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $body = $xml->xpath('//soap:Body')[0];
        $responseNode = $body->children('http://tempuri.org/')->GetTransactionsLogResponse;
        $result = (string) $responseNode->GetTransactionsLogResult;
        $dataList = (string) $responseNode->strDataList;
        $rows = preg_split("/\r\n|\n|\r/", trim($dataList));
        
        $logs = [];
        
        foreach ($rows as $row) {

            $cols = preg_split('/\s+/', trim($row));
        
            if(count($cols) < 3) {
                continue;
            }
        
            $logs[] = [
                "employee_code" => $cols[0],
                "punchdatetime" => $cols[1]." ".$cols[2],
                "punch" => $cols[3]
            ];
        }
        
        $final = [
            "GetTransactionsLogResult" => $result,
            "strDataList" => $logs
        ];
        
        // echo "<pre>";
        // print_r($final);
        $data['resp'] = $this->Cronmodel->get_essl_attendance_cron($final,$deviceId,$punchType,$fromDateTime);
        echo json_encode( $data['resp']);
        
    }
    
    public function essl_attendance_cron(){
        $attendancedate = $this->input->post('attendance');
        if(!empty($attendancedate)){
            $attendancedate = date('Y-m-d', strtotime($this->input->post('attendance')));
        }else{
            $currentHour = date('H');
            if ($currentHour == '01') {
                $attendancedate = date('Y-m-d', strtotime('-1 day'));
            } else {
                $attendancedate = date('Y-m-d');
            }
        }
    
        $employeeid = $this->input->post('employeeid');
        if(empty($employeeid)){
            $employeeid = '';
        }
        
        $printable = $this->input->post('printable');
        if(empty($printable)){
            $printable = 'N';
        }
        // $attendancedate = date('Y-m-d', strtotime('-1 day'));
        $data['resp'] = $this->Cronmodel->essl_attendance_cron($attendancedate,$employeeid);
        echo json_encode( $data['resp']);
    }

    public function callSoapAPI($url, $action, $bodyContent)
    {
    
        $soapBody = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:xsd="http://www.w3.org/2001/XMLSchema"
        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                '.$bodyContent.'
            </soap:Body>
        </soap:Envelope>';
    
        $headers = [
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: \"http://tempuri.org/".$action."\"",
            "Content-Length: ".strlen($soapBody)
        ];
    
        $ch = curl_init();
    
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $soapBody,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
    
        $response = curl_exec($ch);
    
        if(curl_errno($ch)){
            return [
                "status"=>false,
                "error"=>curl_error($ch)
            ];
        }
    
        curl_close($ch);
    
        return [
            "status"=>true,
            "response"=>$response
        ];
    }

    public function cron_get_attendance_before_grace_time(){
        $attendance_date = date('Y-m-d');
        $data['resp'] = $this->Cronmodel->get_attendance_before_grace_time($attendance_date);
        echo json_encode( $data['resp']);
    }

} ?>