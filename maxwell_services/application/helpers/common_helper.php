<?php
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

/*
function leave_check_current_date($employeeid){
    $cut_date=date('Y-m-d');
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select('mxar_appliedby_emp_code');
    $ci->db->from('attendance_user_leaveadjust');
    // $ci->db->where("mxar_from BETWEEN '$cut_date' AND '$cut_date' ");
    // $ci->db->where("mxar_to BETWEEN '$cut_date' AND '$cut_date' ");
    $ci->db->where('mxar_from ',$cut_date);
    $ci->db->where('mxar_to ',$cut_date);
    $ci->db->where('mxar_appliedby_emp_code',$employeeid);
    $ci->db->where('mxar_status',1);
    $query = $ci->db->get();
    $qry = $query->result();
    if(count($qry)>0){
        return true;
    }else{
        return false;
    }
}
*/






?>