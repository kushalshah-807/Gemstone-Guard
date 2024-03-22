<?php

	include("db_connect.php");

	//if(isset($_POST['log-in']) && $_POST['log-in']=='Log me in') {
	 
      $userName = isset($_POST['userName'])?check_input($con,$_POST['userName']):'';

      $passWord = isset($_POST['passWord'])?check_input($con,$_POST['passWord']):'';      
      $passWord =md5($passWord);
 	

      $stmt = $con->prepare('SELECT `adm_login_id` FROM `'.$admsptTbl.'` WHERE `adm_username` = ? AND `adm_password` = ?');
      $stmt->bind_param('ss', $userName, $passWord); // 's' specifies the variable type => 'string'

      $result = $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($id);
 

      if ($stmt->num_rows == 1) {
         $stmt->fetch();   

         $_SESSION['userid']=$id;
			$_SESSION['username']=$userName;
         echo "True";
         exit();
      }
      else {
         echo "False";
         exit();
      }

   //}			 

?>