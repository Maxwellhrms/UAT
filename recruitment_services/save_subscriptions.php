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
$email = $obj['email'];
$mobile = $obj['mobile'];
$type = $obj['type'];

$cksql = "select email from subscriptions where email = '$email' and mobile = '$mobile' and type ='$type' ";
$ckres = $conn->prepare($cksql);
$ckrow = $ckres->execute();
$ckcount = $ckres->rowCount();
if($ckcount > 0){
    echo 202; exit;
}
$columns = implode(", ",array_keys($obj));
$escaped_values = array_values($obj);
$values  = implode("', '", $escaped_values);

$sql = "INSERT INTO subscriptions ($columns) VALUES ('$values')";
$res = $conn->prepare($sql);
$row = $res->execute();

if($row == 1 ){
    echo 200; exit;
}else{
    echo 505 .' Failed To Send to LOGISTICS'; exit;
}
?>