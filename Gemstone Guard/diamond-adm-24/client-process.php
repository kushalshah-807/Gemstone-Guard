<?php
	include_once "db_connect.php";

    $obj=new Utility();
   
   $create_time = date("Y-m-d H:i:s");

   $action = !empty($_REQUEST['action'])?$_REQUEST['action']:'';
   $action=check_input($con,$action);   
      
	if(isset($_POST['submit']) && $_POST['submit']=='Submit'){
	   
     $companyName = isset($_POST['companyName'])?check_input($con,$_POST['companyName']):'';
     $whereCondition = array('company_name' => $companyName,
    );
  $fetchCertificate=$obj->selectWhere($con,$customerTbl,$whereCondition);
  if(count($fetchCertificate)!=0){
      echo '<script type="text/javascript">';
            echo 'alert("Company Name already exist. Please Enter another Company Name!!");';
            echo 'window.location.href = "add-client.php";';
            echo '</script>';
            exit;
  }

     $gstNo = isset($_POST['gstNo'])?check_input($con,$_POST['gstNo']):'';
     $fullName = isset($_POST['fullName'])?check_input($con,$_POST['fullName']):'';
     $contactNumber = isset($_POST['contactNumber'])?check_input($con,$_POST['contactNumber']):'';
     $mobileNo = isset($_POST['mobileNo'])?check_input($con,$_POST['mobileNo']):'';
     $userEmail = isset($_POST['userEmail'])?check_input($con,$_POST['userEmail']):'';
     $address = isset($_POST['address'])?check_input($con,$_POST['address']):'';

     $insert_data = array('company_name'   => $companyName,      
      'gst_no'   => $gstNo,      
      'name'   => $fullName,     
            'phone_no'    => $contactNumber,
            'mobile_no'    => $mobileNo,
            'email_id'    => $userEmail,
            'address'    => $address,
            'entry_by'    => $_SESSION['userid'],                        
      'create_date_time' => $create_time
    );     $insert_stmt=$obj->dataInsert($con,$customerTbl, $insert_data);
  $lastInsertId=mysqli_insert_id($con);
    
		    
		if($insert_stmt) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-client.php");
		} else {
			header("location: view-client.php");exit;
		}
		
}	

	
   if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {
	
		  $id = isset($_POST['id'])?check_input($con,base64_decode($_POST['id'])):'';
      $id1 = isset($_POST['id'])?check_input($con,$_POST['id']):'';

      $companyName = isset($_POST['companyName'])?check_input($con,$_POST['companyName']):'';
    $whereCondition = array('customer_id' => $id);
    $fetchProduct=$obj->selectWhere($con,$customerTbl,$whereCondition);    
    foreach($fetchProduct as $data){
      $presentSlug = $data['company_name'];      
    }
    
    if($presentSlug!=$companyName) {
      $whereCondition = array('company_name' => $companyName);
      $fetchProduct=$obj->selectWhere($con,$customerTbl,$whereCondition);    
      
      if(count($fetchProduct)!=0) {
        echo '<script type="text/javascript">';
       echo 'alert("Client already exist. Please Enter another Client.!!");';
                echo 'window.location.href = "view-client.php";';
        echo '</script>';
        exit();
      }
    }

      $gstNo = isset($_POST['gstNo'])?check_input($con,$_POST['gstNo']):'';
     $fullName = isset($_POST['fullName'])?check_input($con,$_POST['fullName']):'';
     $contactNumber = isset($_POST['contactNumber'])?check_input($con,$_POST['contactNumber']):'';
     $mobileNo = isset($_POST['mobileNo'])?check_input($con,$_POST['mobileNo']):'';
     $userEmail = isset($_POST['userEmail'])?check_input($con,$_POST['userEmail']):'';
     $address = isset($_POST['address'])?check_input($con,$_POST['address']):'';

     $update = array('company_name'   => $companyName,      
      'gst_no'   => $gstNo,      
      'name'   => $fullName,     
            'phone_no'    => $contactNumber,
            'mobile_no'    => $mobileNo,
            'email_id'    => $userEmail,
            'address'    => $address,
            'edit_by'    => $_SESSION['userid'],
            'update_date_time'    => $create_time
    );
     $whereCondition = array('customer_id' => $id );
    $update_stmt=$obj->dataUpdate($con,$customerTbl, $update, $whereCondition);
    
		if($update_stmt) {
			$_SESSION['msg'] = 'data_updated';
			header("location: view-client.php");
		} else {
			header("location: view-client.php");exit;
		}
		
	}


		if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
      $id = isset($_GET['id'])?check_input($con,base64_decode($_GET['id'])):'';

      $delete_stmt = $con->prepare("DELETE FROM `".$customerTbl."` WHERE `customer_id` = ? ");
      $delete_stmt->bind_param('s', $id);
      $delete_stmt->execute();

		if($delete_stmt) {
			$_SESSION['msg'] = 'delete_data';
			header('location: view-client.php');exit;
		} else {
			header("location: view-client.php");exit;
		}

	}
		 	
?>