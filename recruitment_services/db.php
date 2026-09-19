<?php
date_default_timezone_set("Asia/Calcutta");
// $servername = "127.0.0.1";
// $username = "maxwelll_root";
// $password = "maxwell_hrms_123";

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=maxwelll_logistics_primary", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   //echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }

// newsite
$servername = "127.0.0.1";
$username = "maxwelll_root_si";
$password = "FPICEXm=X8.u";

try {
  $conn = new PDO("mysql:host=$servername;dbname=maxwelll_site", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>