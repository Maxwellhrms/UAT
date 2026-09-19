<?php

    function formatLastLogin($employeeid)
    {
        $ci =& get_instance();
        $ci->load->database();

        $ci->db->select('curent_timestamp');
        $ci->db->from('login_attempts');
        $ci->db->where('emp_id', $employeeid);
        $ci->db->order_by('curent_timestamp', 'DESC');
        $ci->db->limit(2); // get latest 2 records

        $query = $ci->db->get();
        $results = $query->result();

        if (empty($results)) {
            return 'N/A';
        }

        // If only 1 record → use that
        if (count($results) == 1) {
            $datetime = $results[0]->curent_timestamp;
        } else {
            // If multiple → pick second latest (last but one)
            $datetime = $results[1]->curent_timestamp;
        }

        $timestamp = strtotime($datetime);
        return date('d F y h:i a', $timestamp);
    }
    
    function cleanInput($val){
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }

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

function getIndianCurrency(float $number){
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function gettotalworkinghours($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}

function datesOfNextWeek(){
  $dates = array();
  $date = time();                                 // get current date.
  while (date('w', $date += 86400) != 1);         // find the next Monday.
  for ($i = 0; $i < 7; $i++) {                    // get the 7 dates from it. 
    $dates[] = date('Y-m-d', $date + $i * 86400);
  }
  return $dates;
}

function get_employeesassigned($projectid){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('ws.employee_img,aspr.project_user_role_id,ws.employee_name');
    $ci->db->join('work_users as ws', 'ws.id = aspr.project_employee_id', 'INNER');
    $ci->db->from('assigned_projects as aspr');
    $ci->db->where('aspr.project_id',$projectid);
    $ci->db->Order_by('ws.employee_name');
    $query = $ci->db->get();
    $qury = $query->result();
    return $qury;
}

function getcounts($tablename,$column = array()){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('count(*) as count');
    $ci->db->from($tablename);
    foreach ($column as $key => $value) {
       $ci->db->where($key,$value); 
    }
    $query = $ci->db->get();
    $qury = $query->result();
    $count = $qury[0]->count;
    return $count;
}

function getemployeebyusingid($employeeid){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('employee_name,employee_email,employee_mobile,employee_img');
    $ci->db->from('work_users');
    $ci->db->where('id',$employeeid); 
    $query = $ci->db->get();
    $qury = $query->result();
    return $qury;
}

function getcommonquerydata($tablename,$column = array(), $where = array()){
    $ci=& get_instance();
    $ci->load->database(); 
    $allcolumns =  implode(",",$column);
    $ci->db->select($allcolumns);
    $ci->db->from($tablename);
    foreach ($where as $key => $value) {
       $ci->db->where($key,$value); 
    }
    // echo $ci->db->get_compiled_select();exit;
    $query = $ci->db->get();
    return $qury = $query->result();
}

function getemployeesadmindashboard($employeeid,$company_id,$projectid){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('wcwd.dash_processid,count(wt.work_current_status) as ticketscount');
    $ci->db->join('work_tickets as wt', 'wt.work_current_status = wcwd.dash_processid', 'INNER');
    $ci->db->from('work_company_wise_dashboard as wcwd');
    $ci->db->where('wcwd.dash_company_id',$company_id);
    $ci->db->where('wcwd.dash_project_id',$projectid);
    $ci->db->where('wt.work_employeeid', $employeeid);
    $ci->db->group_by('wt.work_current_status');
    $query1 = $ci->db->get();
    return $qry1 = $query1->result(); 
}

function custom_tags($employeeid='',$companyid='',$projectid='',$ticketid='',$desc=''){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('employee_name,employee_email,employee_mobile');
    $ci->db->from('work_users');
    $ci->db->where('id',$employeeid); 
    $query = $ci->db->get();
    $emp = $query->result();

    $ci->db->select('project_name');
    $ci->db->from('projects');
    $ci->db->where('id',$projectid); 
    $query = $ci->db->get();
    $project = $query->result();

    $ci->db->select('company_reg_name,company_reg_email,company_reg_mobile,company_reg_address');
    $ci->db->from('work_company');
    $ci->db->where('comapny_reg_id',$companyid); 
    $query = $ci->db->get();
    $company = $query->result();

    if(!empty($company[0]->company_reg_address)){
        $companyaddress = '';
        $cpad = explode(',',$company[0]->company_reg_address);
        if(count($cpad) > 0){
            $i= 1; foreach ($cpad as $key => $value) {
                if(count($cpad) == $i){$br = "";}else{$br = ',<br>';}
                $companyaddress .= $value.$br;
           $i++; }
        }else{
            $companyaddress = $company[0]->company_reg_address;
        }
    }else{
        $companyaddress = '';
    }


    $ci->db->select('Ticketid,work_price,work_isdashboard');
    $ci->db->from('work_tickets');
    $ci->db->where('Ticketid',$ticketid); 
    $query = $ci->db->get();
    $ticketinfo = $query->result();
    if(empty($ticketinfo[0]->work_price)){
        $ticketamount = 0;
    }else{
        $ticketamount = $ticketinfo[0]->work_price;
    }

    $ci->db->select('bankname,bankaccountholdername,bankaccountno,bankifsc,bankbranch,pancard');
    $ci->db->from('bank_info');
    $ci->db->where('status = 1');
    $ci->db->where('company_id',$companyid);
    $ci->db->where('project_id',$projectid);
    $ci->db->where('empid',$employeeid);
    $querybnk = $ci->db->get();
    $empbnk = $querybnk->result();

    $tags = array(
        "{currentdate}" => DBD,
        "{employee_name}" => $emp[0]->employee_name,
        "{employee_email}" => $emp[0]->employee_email,
        "{employee_mobile}" => $emp[0]->employee_mobile,
        "{bank_name}" => $empbnk[0]->bankname,
        "{bank_account_number}" => $empbnk[0]->bankaccountno,
        "{bank_ifsc_code}" => $empbnk[0]->bankifsc,
        "{bank_branch}" => $empbnk[0]->bankbranch,
        "{bank_account_holder_name}" => $empbnk[0]->bankaccountholdername,
        "{pancard}" => $empbnk[0]->pancard,
        "{company}" => $company[0]->company_reg_name,
        "{company_address}" => $companyaddress,
        "{project}" => $project[0]->project_name,
        "{ticket_amount}" => $ticketinfo[0]->work_price,
        "{ticket_words}" => getIndianCurrency($ticketamount),
        "{ticketid}" => $ticketid,
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
    return $tags;
}

// Email Start
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once APPPATH.'libraries/PHPMailer/src/Exception.php';
    require_once APPPATH.'libraries/PHPMailer/src/PHPMailer.php';
    require_once APPPATH.'libraries/PHPMailer/src/SMTP.php';
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
        $mail->setFrom($configinfo[0]->smtp_hostusername,$configinfo[0]->EmailFromName);
        #$mail->addAddress($recipient_to, $recipient_name);     // Add a recipient
        foreach ($recipient_to as $recptokey => $allrecipient) {
            if(!empty($allrecipient)){
            $mail->addAddress($allrecipient);   //Name is optional
            }
        }
        $mail->addReplyTo($configinfo[0]->smtp_hostusername,$configinfo[0]->EmailFromName);

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
            // mail_log($data,$res);
            if(empty($data['hidejosn']) || !isset($data['hidejosn'])){
            echo json_encode(array('respone' => 200));
            }
        }else{
            // mail_log($data,$res);
            if(empty($data['hidejosn']) || !isset($data['hidejosn'])){
            echo json_encode(array('respone' => 400));
            }
        }
    } catch (Exception $e) {
        $res = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // mail_log($data,$res);
        echo json_encode(array('respone' => 400));
    }
    }
    
    function getemailconfig($data){
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('SmtpAuthenticationDomain as smtp_hosturl,SmtpPort as smtp_hostport,SmtpUser as smtp_hostusername,SmtpPassword as smtp_hostpassword');
        $ci->db->from('MailSettings');
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
    // Email End

    function generateHexCode($length) {
        $characters = '0123456789ABCDEF';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

    function dynamicTable($data){
        $result = $data['retrunarray'];
        $columns = $data['columns'];
        $linkColumns = $data['linkColumns'];
        $editColumns  = $data['editColumns'];
        $dataMappingColumns = $data['dataMappingColumns'];
        $renameHeaderColumns = $data['renameHeaderColumns'];
        $hideColumn = $data['hideColumn'];
        $reportName = $data['reportName'];
        $hideInExport = $data['hideInExport'];
        // Define the JSON response structure
        $response = [
            'columns' => array_merge(['SNo'], $columns),  // Include SNo as the first column
            'linkColumns' => $linkColumns,
            'editColumns' => $editColumns,
            'data' => [],
            'reportName' => $reportName,
            'hideInExport' => $hideInExport,
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
                    // echo '<pre>'; print_r($col);
                    // echo 'hi'; exit;
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
    
    function maskNumber($data = ''){
        if(empty($data)){
            return '';
        }

        // Convert to string
        $data = (string) $data;

        // If length <= 4 return original
        if(strlen($data) <= 4){
            return $data;
        }

        // Mask except last 4 digits
        return str_repeat('*', strlen($data) - 4) . substr($data, -4);
    }
?>