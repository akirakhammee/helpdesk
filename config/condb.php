<?php

// Turn off all error reporting
//error_reporting(0);


$servername = "localhost";
$username = "root";
$password = "";

try {
  $condb = new PDO("mysql:host=$servername;dbname=project_helpdesk;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
?>