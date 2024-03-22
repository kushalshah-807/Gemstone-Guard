<?php
include "db_connect.php";

$oldPassword = !empty($_GET['oldPassword'])?$_GET['oldPassword']:'';
$oldPassword=check_input($con,$oldPassword);
$oldPassword =md5($oldPassword);
 	
$stmt = $con->prepare('SELECT `adm_password` FROM `'.$admsptTbl.'` WHERE `adm_password` = ? AND `adm_login_id` = ? ');
$stmt->bind_param('ss', $oldPassword, $_SESSION['userid']);

  $result = $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows == 1) {
  	echo "true";exit;
  } else {
	  echo "false";exit;
  }
  
  $stmt->close();
?>