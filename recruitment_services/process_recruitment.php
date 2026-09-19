<?php

date_default_timezone_set("Asia/Calcutta");
$servername = "localhost";
$username = "maxwellhrms_root";
$password = "sairam-143";

try {
  $conn = new PDO("mysql:host=$servername;dbname=maxwellhrms_hr", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

header('Content-type: application/json');
$json   = file_get_contents('php://input');
$obj    = json_decode($json, true);
$jobid = $obj['mxrap_job_id'];
$mbno = $obj['mxrap_mobile'];

$cksql = "select mxrap_mobile from maxwell_recruitment_applied_candidates where mxrap_mobile = '$mbno' and mxrap_job_id = '$jobid' ";
$ckres = $conn->prepare($cksql);
$ckrow = $ckres->execute();
$ckcount = $ckres->rowCount();
if($ckcount > 0){
    echo 202; exit;
}
$columns = implode(", ",array_keys($obj));
$escaped_values = array_values($obj);
$values  = implode("', '", $escaped_values);

$sql = "INSERT INTO maxwell_recruitment_applied_candidates ($columns) VALUES ('$values')";
$res = $conn->prepare($sql);
$row = $res->execute();

if($row == 1 ){
    echo 200; exit;
}else{
    echo 505 .' Failed To Send to LOGISTICS'; exit;
}
?>