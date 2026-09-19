<?php
include 'db.php';
header('Content-type: application/json');
$json   = file_get_contents('php://input');
$obj    = json_decode($json, true);

$columns = implode(", ",array_keys($obj));
$escaped_values = array_values($obj);
$values  = implode("', '", $escaped_values);

$sql = "INSERT INTO maxwell_recruitment($columns) VALUES ('$values')";
$res = $conn->prepare($sql);
$row = $res->execute();

if($row == 1 ){
    echo 200; exit;
}else{
    echo 505 .' Failed To Send to LOGISTICS'; exit;
}
?>