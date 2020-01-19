<?php
  $host_name = 'localhost:3306';
  $database = 'mohammed_uta_mac_reservation';
  $user_name = 'mohammed_se1proj';
  $password = 'Maverick@1234';
  $dbh = null;

  
  // include 'email.php';
  $con = new mysqli($host_name, $user_name,$password,$database);
  if ($con->connect_error) {
    printf("Connect failed: %s\n", $con->connect_error);
    exit();
  }
?>

    