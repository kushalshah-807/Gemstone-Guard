<?php
   include "db_connect.php";
   $create_time = date("Y-m-d H:i:s");
   
   $obj=new Utility();
   
if(isset($_POST['submit']) && $_POST['submit']=='Submit') {

   $variationName = !empty($_POST['variationName'])?$_POST['variationName']:'';
   $variationName=check_input($con,$variationName);
   
   $insert_stmt = $con->prepare("INSERT INTO `".$variationTbl."` SET `variation` = ?, `create_date_time` = ?");
   $insert_stmt->bind_param("ss",$variationName,$create_time);
   $insert_stmt->execute();
   $lastInsertId=mysqli_insert_id($con);
                   	
	if(isset($_POST['availableTypes'])){
            $n=sizeof($_POST['availableTypes']);
            for($i=0;$i<$n;$i++){
                if(trim($_POST['availableTypes'][$i])!=""){
                 
                   $insertVT = $con->prepare("INSERT INTO `".$variationtpTbl."` SET `variation_id` = ?, `variation_type` = ?, `create_date_time`= ? ");
                   $insertVT->bind_param("sss",$lastInsertId,check_input($con,$_POST['availableTypes'][$i]),$create_time);

                   $insertVT->execute();
                   $insertVT->close();
                }
            }
            
        }
        
      if($insert_stmt) {
         echo '<script type="text/javascript">';
         echo 'alert("Variation Added Successfully!!");';
         echo 'window.location.href = "view-variation.php";';
         echo '</script>';
         exit;
      }        
}


if(isset($_POST['submit']) && $_POST['submit']=='Update'){

	$id = isset($_POST['variationId'])?check_input($con,base64_decode($_POST['variationId'])):'';
	$id1 = isset($_POST['variationId'])?check_input($con,$_POST['variationId']):'';

	$variationType = isset($_POST['variationType'])?check_input($con,$_POST['variationType']):'';
	
	$whereCondition = array('variation_id' => $id);
	$fetchVariation=$obj->selectWhere($con,$variationTbl,$whereCondition);		
	foreach($fetchVariation as $data){
		$presentSlug = $data['variation'];
	}
		/* 
	if($presentSlug!=$variationType) {
		$whereCondition = array('variation' => $variationType);
		$fetchVariation=$obj->selectWhere($con,$variationTbl,$whereCondition);		
		
		if($fetchVariation!=0) {
         echo '<script type="text/javascript">';
			echo 'alert("Variation Type already Present. Please enter another Variation Type");';
			echo 'window.location.href = "view-variation.php";';
			echo '</script>';
         exit();
		}
		else {
			$update = array('variation' => $variationType );
			$whereCondition = array('variation_id' => $id);            
            $update_stmt=$obj->dataUpdate($con,$variationTbl, $update, $whereCondition);
		}
   } */
  
  
   //Variation Type
   $deletevTypeId = explode(',', $_POST['deletevTypeId'][0]);
   if(isset($_POST['deletevTypeId'][0]) && $_POST['deletevTypeId'][0]!=''){
      $countdeletevTypeId = count($deletevTypeId);
      for ($k = 0; $k < $countdeletevTypeId; $k++) {
		  $whereCondition = array('variation_type_id' => check_input($con,$deletevTypeId[$k]),
			'variation_id' => $id	);            
            $delteVTId=$obj->dataDelete($con,$variationtpTbl, $whereCondition);
		}
   }
  
  $avtCount = count($_POST['availableTypes']);
  for ($i = 0; $i < $avtCount; $i++) {
    if ($_POST['availableTypes'][$i] != '') {
       if (isset($_POST['oldVtypeId'][$i]) && $_POST['oldVtypeId'][$i] != '') {
			$update = array('variation_type' => check_input($con,$_POST['availableTypes'][$i]) );
			$whereCondition = array('variation_type_id' => check_input($con,$_POST['oldVtypeId'][$i]));            
            $updateVType=$obj->dataUpdate($con,$variationtpTbl, $update, $whereCondition);
       }
       else {
		   $insert_data = array('variation_id'   => $id,
			'variation_type'   => check_input($con,$_POST['availableTypes'][$i]),            
			'create_date_time' => $create_time
        );     $queryVType=$obj->dataInsert($con,$variationtpTbl, $insert_data);            
		//$lastInsertId=mysqli_insert_id($con);
		}
    }
  }
  //exit;  
  
if($update_stmt || $delteVTId || $updateVType || $queryVType) {
			$_SESSION['msg'] = 'data_updated';
			header("location: view-variation.php");
	} else {
			header("location: view-variation.php");exit;
	}
	
}
	
	
if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
   
   $id=check_input($con,base64_decode($_REQUEST['id']));
	
	$whereCondition = array('variation_id' => $id);
	$fetchVariation=$obj->selectWhere($con,$variationTbl,$whereCondition);
	foreach($fetchVariation as $data){ 
		$cstatus = $data['status'];
	}
		 
	if($data['status']=='1'){
		$update = array('status' => "0");
		$whereCondition = array('variation_id' => $id);		
		$stmt = $obj->dataUpdate($con,$variationTbl, $update, $whereCondition);
   }
		
	if($data['status']=='0'){
		$update = array('status' => "1");
		$whereCondition = array('variation_id' => $id);		
		$stmt = $obj->dataUpdate($con,$variationTbl, $update, $whereCondition);    
   }
		
   if($stmt) {
      $_SESSION['msg'] = 'status_changed';
		header('location: view-variation.php');exit;
	} else {
		header("location: view-variation.php");exit;
	}

}

?>