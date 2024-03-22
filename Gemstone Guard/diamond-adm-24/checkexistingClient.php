<?php
include "db_connect.php";

$companyName = !empty($_GET['companyName'])?$_GET['companyName']:'';
$companyName=check_input($con,$companyName);
 	
$stmt = $con->prepare('SELECT `company_name` FROM `gsh_client` WHERE `company_name` = ? ');
$stmt->bind_param('s', $fullName);

  $result = $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows == 0) {
  	echo "true";exit;
  } else {
	  echo "false";exit;
  }
  
  $stmt->close();
?>