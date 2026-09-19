<?php
include 'db.php';
header('Content-type: application/json');
$json   = file_get_contents('php://input');
$obj    = json_decode($json, true);


$id = $obj["mxrc_type_id"];
unset($obj["mxrc_type_id"]);

$valueSets = array();
foreach($obj as $key => $value) {
   $valueSets[] = $key . " = '" . $value . "'";
}

$sql = "UPDATE maxwell_recruitment SET ". join(",",$valueSets) . " WHERE mxrc_type_id = $id";
$res = $conn->prepare($sql);
$row = $res->execute();

if($row == 1 ){
    echo 200; exit;
}else{
    echo 505 .' Failed To Send to LOGISTICS'; exit;
}
?>