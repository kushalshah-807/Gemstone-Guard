<?php 
	include "db_connect.php";
	
	$obj=new Utility();

   include 'phpqrcode/qrlib.php';

   $create_time = date("Y-m-d H:i:s");
   
	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {

    $certificateDate = isset($_POST['certificateDate'])?check_input($con,date('Y-m-d',strtotime($_POST['certificateDate']))):'';
    $alphaNo = isset($_POST['alphaNo'])?check_input($con,$_POST['alphaNo']):'';
    $numericNo = isset($_POST['numericNo'])?check_input($con,$_POST['numericNo']):'';

		$summaryNo = isset($_POST['summaryNo'])?check_input($con,$_POST['summaryNo']):'';
		
		$whereCondition = array('summary_no' => $summaryNo,
		);
	$fetchCertificate=$obj->selectWhere($con,$certificateTbl,$whereCondition);
	if(count($fetchCertificate)!=0){
			echo '<script type="text/javascript">';
            echo 'alert("Summary No. already exist. Please Enter another Summary No.!!");';
            echo 'window.location.href = "add-certificate.php";';
            echo '</script>';
            exit;
	}
    
		$customerId = isset($_POST['customerId'])?check_input($con,base64_decode($_POST['customerId'])):'';
		$companyName = isset($_POST['companyName'])?check_input($con,$_POST['companyName']):'';
		$gstNo = isset($_POST['gstNo'])?check_input($con,$_POST['gstNo']):'';
		$fullName = isset($_POST['fullName'])?check_input($con,$_POST['fullName']):'';
		$address = isset($_POST['address'])?check_input($con,$_POST['address']):'';
		$estWt = isset($_POST['estWt'])?check_input($con,$_POST['estWt']):'';

		/* $prdShape = isset($_POST['prdShape'])?check_input($con,base64_decode($_POST['prdShape'])):'';    
    $prdcolor = isset($_POST['prdcolor'])?check_input($con,base64_decode($_POST['prdcolor'])):'';
    $prdClarity = isset($_POST['prdClarity'])?check_input($con,base64_decode($_POST['prdClarity'])):''; */
		
    $refractiveIndex = isset($_POST['refractiveIndex'])?check_input($con,$_POST['refractiveIndex']):'';
    $specificGravity = isset($_POST['specificGravity'])?check_input($con,$_POST['specificGravity']):'';
    $hardNess = isset($_POST['hardNess'])?check_input($con,$_POST['hardNess']):'';
    $origin = isset($_POST['origin'])?check_input($con,$_POST['origin']):'';
    $prdMeasure = isset($_POST['prdMeasure'])?check_input($con,$_POST['prdMeasure']):'';

		$mainDescription = isset($_POST['mainDescription'])?check_input($con,$_POST['mainDescription']):'';
		$prdComment = isset($_POST['prdComment'])?check_input($con,$_POST['prdComment']):'';
    $identification = isset($_POST['identification'])?check_input($con,$_POST['identification']):'';
		
		$insert_data = array('certificate_date'   => $certificateDate,      
      'alpha_no'   => $alphaNo,
      'numeric_no'   => $numericNo,
      'summary_no'   => $summaryNo,			
            'customer_id'    => $customerId,
            'company_name'    => $companyName,
            'gst_no'    => $gstNo,
            'name'    => $fullName,			        
            'address'    => $address,            
            'weight'    => $estWt,
      'refractive_index'    => $refractiveIndex,
      'specific_gravity'    => $specificGravity,
      'hardness'    => $hardNess,
      'origin'    => $origin,      
      'measure'    => $prdMeasure,      
			'description'    => $mainDescription,			
			'comment'    => $prdComment,
      'identification'    => $identification,
			'create_date_time' => $create_time
    );     $insert_stmt=$obj->dataInsert($con,$certificateTbl, $insert_data);
	$lastInsertId=mysqli_insert_id($con);


if(isset($_POST['prdShape']) && $_POST['prdShape']!=''){
    $prdShape=$_POST['prdShape'];

    foreach($prdShape as $sid){
    $sinsert_data = array('certificate_id'   => $lastInsertId,
      'shape_id'   => check_input($con,base64_decode($sid)),
      'create_date_time' => $create_time
        );
    $sinsert_stmt=$obj->dataInsert($con,$certishapeTbl, $sinsert_data);
      }

  }
if(isset($_POST['prdcolor']) && $_POST['prdcolor']!=''){
    $prdcolor=$_POST['prdcolor'];

    foreach($prdcolor as $cid){
    $cinsert_data = array('certificate_id'   => $lastInsertId,
      'color_id'   => check_input($con,base64_decode($cid)),
      'create_date_time' => $create_time
        );
    $cinsert_stmt=$obj->dataInsert($con,$certicolorTbl, $cinsert_data);
      }

  }
if(isset($_POST['prdClarity']) && $_POST['prdClarity']!=''){
    $prdClarity=$_POST['prdClarity'];

    foreach($prdClarity as $crsid){
    $crinsert_data = array('certificate_id'   => $lastInsertId,
      'clarity_id'   => check_input($con,base64_decode($crsid)),
      'create_date_time' => $create_time
        );
    $ceinsert_stmt=$obj->dataInsert($con,$certiclarityTbl, $crinsert_data);
      }

  }
      
		        
	$randomNo=random_generator(4);
	

      if(!file_exists(".." . DIRECTORY_SEPARATOR . $certiPdf) && !is_dir(".." . DIRECTORY_SEPARATOR . $certiPdf)) {
         mkdir(".." . DIRECTORY_SEPARATOR . $certiPdf);    
      }

      $NameFile1=$_FILES['fileUpload']['name'];

      if(isset($NameFile1) && !empty($NameFile1)) {
    
            $extension1 = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
    
        if($extension1 != "pdf") {    
         echo '<script type="text/javascript">';    
         echo 'alert("Only pdf file allowed");';    
         echo 'window.location.href = "add-certificate.php";';    
         echo '</script>';    
         exit();    
       }
              
       $fileName1 = $summaryNo.".".$extension1;
       $fpath1=$certiPdf . DIRECTORY_SEPARATOR . $fileName1;   
               
    
       if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $fpath1)) {    
         $update = array('pdf' => $fileName1);    
          $whereCondition = array('certificate_id' => $lastInsertId );    
          $pdf_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);

          //$query_img = mysqli_query($con, "UPDATE `gsh_invoice` SET `image`='".$fileName."' WHERE `invoice_id`='".$lastInsertId."'") or die(mysqli_error($con));
       }

      }


       $text = $currentDir."view-report.php?rno=".$summaryNo;
	   
       // $path variable store the location where to 
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = '../'.$qrcodeImg.'/';
$qrfileName = $lastInsertId."-".$randomNo."-qr.png";
$file = $path.$qrfileName;

// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;

// Generates QR Code and Stores it in directory given
QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);

		$update = array('qr_code' => $qrfileName);
        $whereCondition = array('certificate_id' => $lastInsertId );    
        $img_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);

      
		if($insert_stmt) {
         $_SESSION['msg'] = 'data_uploaded';
			header("Location:view-certificate.php");
		} else {
			header("location: add-certificate.php");exit;
      }
				
   }


	if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

    $id = isset($_POST['id'])?check_input($con,base64_decode($_POST['id'])):'';
    $id1 = isset($_POST['id'])?check_input($con,$_POST['id']):'';

    $certificateDate = isset($_POST['certificateDate'])?check_input($con,date('Y-m-d',strtotime($_POST['certificateDate']))):'';
    //$alphaNo = isset($_POST['alphaNo'])?check_input($con,$_POST['alphaNo']):'';
    //$numericNo = isset($_POST['numericNo'])?check_input($con,$_POST['numericNo']):'';

    $summaryNo = isset($_POST['summaryNo'])?check_input($con,$_POST['summaryNo']):'';

    $whereCondition = array('certificate_id' => $id);
    $fetchProduct=$obj->selectWhere($con,$certificateTbl,$whereCondition);    
    foreach($fetchProduct as $data){
      $presentSlug = $data['summary_no'];
      $qrCode = $data['qr_code'];
    }
    
    if($presentSlug!=$summaryNo) {
      $whereCondition = array('summary_no' => $summaryNo);
      $fetchProduct=$obj->selectWhere($con,$certificateTbl,$whereCondition);    
      
      if(count($fetchProduct)!=0) {
        echo '<script type="text/javascript">';
        echo 'alert("Summary No. already exist. Please Enter another Summary No.!!");';
         echo 'window.location.href = "view-certificate.php";';
        echo '</script>';
        exit();
      }
    }  
    
    $customerId = isset($_POST['customerId'])?check_input($con,base64_decode($_POST['customerId'])):'';
    $companyName = isset($_POST['companyName'])?check_input($con,$_POST['companyName']):'';
    $gstNo = isset($_POST['gstNo'])?check_input($con,$_POST['gstNo']):'';
    $fullName = isset($_POST['fullName'])?check_input($con,$_POST['fullName']):'';
    $address = isset($_POST['address'])?check_input($con,$_POST['address']):'';
    $estWt = isset($_POST['estWt'])?check_input($con,$_POST['estWt']):'';
    
    /* $prdShape = isset($_POST['prdShape'])?check_input($con,base64_decode($_POST['prdShape'])):'';    
    $prdcolor = isset($_POST['prdcolor'])?check_input($con,base64_decode($_POST['prdcolor'])):'';
    $prdClarity = isset($_POST['prdClarity'])?check_input($con,base64_decode($_POST['prdClarity'])):''; */
    
    $refractiveIndex = isset($_POST['refractiveIndex'])?check_input($con,$_POST['refractiveIndex']):'';
    $specificGravity = isset($_POST['specificGravity'])?check_input($con,$_POST['specificGravity']):'';
    $hardNess = isset($_POST['hardNess'])?check_input($con,$_POST['hardNess']):'';
    $origin = isset($_POST['origin'])?check_input($con,$_POST['origin']):'';
    $prdMeasure = isset($_POST['prdMeasure'])?check_input($con,$_POST['prdMeasure']):'';

    $mainDescription = isset($_POST['mainDescription'])?check_input($con,$_POST['mainDescription']):'';
    $prdComment = isset($_POST['prdComment'])?check_input($con,$_POST['prdComment']):'';
    $identification = isset($_POST['identification'])?check_input($con,$_POST['identification']):'';
    
    $update = array('customer_id'    => $customerId,
            'company_name'    => $companyName,
            'gst_no'    => $gstNo,
            'name'    => $fullName,             
            'address'    => $address,            
            'weight'    => $estWt,
            'refractive_index'    => $refractiveIndex,
      'specific_gravity'    => $specificGravity,
      'hardness'    => $hardNess,
      'origin'    => $origin,      
      'measure'    => $prdMeasure,
      'description'    => $mainDescription,     
      'comment'    => $prdComment,
      'identification'    => $identification,
      'update_date_time' => $create_time
    );
    $whereCondition = array('certificate_id' => $id );
    $update_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);

    //Shape Certi update
    if(isset($_POST['prdShape']) && $_POST['prdShape']!=''){
      $sIds=$_POST['prdShape'];
      if (!is_array($sIds)) {
        $sIds = array($sIds);
      }      

    $scertis=array();
    $whereCondition = array('certificate_id' => $id);
    $fetchRlpr=$obj->selectWhere($con,$certishapeTbl,$whereCondition);   
    foreach($fetchRlpr as $selectedRlpr){
      $scertis[]=base64_encode($selectedRlpr['shape_id']);
    }

        $newRlProduct = array_diff($sIds, $scertis);

        if ($newRlProduct != "" && $newRlProduct != null && is_array($newRlProduct)) {
          foreach ($newRlProduct as $nrpId) {
             $sinsert_data = array('certificate_id'   => $id,
      'shape_id'   => check_input($con,base64_decode($nrpId)),
      'create_date_time' => $create_time
        );
        $sinsert_stmt=$obj->dataInsert($con,$certishapeTbl, $sinsert_data);
        }

        }   

        $deleteRp = array_diff($scertis, $sIds);

       if ($deleteRp != "" && $deleteRp != null && is_array($deleteRp)) {
          foreach ($deleteRp as $drpId) {
            $whereCondition = array('certificate_id' => $id,
        'shape_id' => check_input($con,base64_decode($drpId))  );
        $dltrp_stmt=$obj->dataDelete($con,$certishapeTbl, $whereCondition);
      } 

        }

      } else {
      $whereCondition = array('certificate_id' => $id );            
            $adltrlpr_stmt=$obj->dataDelete($con,$certishapeTbl, $whereCondition);
    }


    //Color Certi update
    if(isset($_POST['prdcolor']) && $_POST['prdcolor']!=''){
      $cIds=$_POST['prdcolor'];
      if (!is_array($cIds)) {
        $cIds = array($cIds);
      }      

    $ccertis=array();
    $whereCondition = array('certificate_id' => $id);
    $fetchCcerti=$obj->selectWhere($con,$certicolorTbl,$whereCondition);   
    foreach($fetchCcerti as $dataCcerti){
      $ccertis[]=base64_encode($dataCcerti['color_id']);
    }

        $newRlProduct = array_diff($cIds, $ccertis);

        if ($newRlProduct != "" && $newRlProduct != null && is_array($newRlProduct)) {
          foreach ($newRlProduct as $nrpId) {
             $cinsert_data = array('certificate_id'   => $id,
      'color_id'   => check_input($con,base64_decode($nrpId)),
      'create_date_time' => $create_time
        );
        $cinsert_stmt=$obj->dataInsert($con,$certicolorTbl, $cinsert_data);
        }

        }   

        $deleteRp = array_diff($ccertis, $cIds);

       if ($deleteRp != "" && $deleteRp != null && is_array($deleteRp)) {
          foreach ($deleteRp as $drpId) {
            $whereCondition = array('certificate_id' => $id,
        'color_id' => check_input($con,base64_decode($drpId))  );
        $dltrp_stmt=$obj->dataDelete($con,$certicolorTbl, $whereCondition);
      } 

        }

      } else {
      $whereCondition = array('certificate_id' => $id );            
            $adltrlpr_stmt=$obj->dataDelete($con,$certicolorTbl, $whereCondition);
    }


    //Clarity Certi update
    if(isset($_POST['prdClarity']) && $_POST['prdClarity']!=''){
      $crIds=$_POST['prdClarity'];
      if (!is_array($crIds)) {
        $crIds = array($crIds);
      }      

    $crcertis=array();
    $whereCondition = array('certificate_id' => $id);
    $fetchCrcerti=$obj->selectWhere($con,$certiclarityTbl,$whereCondition);   
    foreach($fetchCrcerti as $dataCrcerti){
      $crcertis[]=base64_encode($dataCrcerti['clarity_id']);
    }

        $newRlProduct = array_diff($crIds, $crcertis);

        if ($newRlProduct != "" && $newRlProduct != null && is_array($newRlProduct)) {
          foreach ($newRlProduct as $nrpId) {
             $cinsert_data = array('certificate_id'   => $id,
      'clarity_id'   => check_input($con,base64_decode($nrpId)),
      'create_date_time' => $create_time
        );
        $cinsert_stmt=$obj->dataInsert($con,$certiclarityTbl, $cinsert_data);
        }

        }   

        $deleteRp = array_diff($crcertis, $crIds);

       if ($deleteRp != "" && $deleteRp != null && is_array($deleteRp)) {
          foreach ($deleteRp as $drpId) {
            $whereCondition = array('certificate_id' => $id,
        'clarity_id' => check_input($con,base64_decode($drpId))  );
        $dltrp_stmt=$obj->dataDelete($con,$certiclarityTbl, $whereCondition);
      } 

        }

      } else {
      $whereCondition = array('certificate_id' => $id );            
            $adltrlpr_stmt=$obj->dataDelete($con,$certiclarityTbl, $whereCondition);
    }


$randomNo=random_generator(4);

      //Unlink removed File
        if (isset($_POST['existImage2']) && $_POST['existImage2'] == '') {
                if(isset($_POST['removedImage2']) && $_POST['removedImage2'] != '') {
                 $rimg2="../".$certiPdf."/".$_POST['removedImage2'];
                 if (file_exists($rimg2)) { 
                       unlink($rimg2);
                       $update = array('pdf' => "");
                        $whereCondition = array('certificate_id' => $id );
                        $updf_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);
                 }
              }
        }
        
        $NameFile1=$_FILES['fileUpload']['name'];
          if(isset($NameFile1) && !empty($NameFile1)) {
             $extension1 = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
           if($extension1 != "pdf") {
             echo '<script type="text/javascript">';
             echo 'alert("Only doc, docx, pdf and pptx files are allowed");';
             echo 'window.location.href = "view-certificate.php";';
             echo '</script>';
             exit();
          }
   
          $fileName1 = $summaryNo.".".$extension1;
          $fpath1=".." . DIRECTORY_SEPARATOR . $certiPdf . DIRECTORY_SEPARATOR . $fileName1;
          
          if(!file_exists(".." . DIRECTORY_SEPARATOR . $certiPdf) && !is_dir(".." . DIRECTORY_SEPARATOR . $certiPdf)) {
               mkdir(".." . DIRECTORY_SEPARATOR . $certiPdf);
          }
          
          if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $fpath1)) {
            $update = array('pdf' => $fileName1);
            $whereCondition = array('certificate_id' => $id );
            $npdf_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);
          }
          
         }


/*
if($presentSlug!=$summaryNo) {

$rimg=$qrcodeImg."/".$qrCode;
if (file_exists($rimg)) { 
  unlink($rimg);
}  

    $randomNo=random_generator(4);
       $text = $currentDir."view-report.php?rno=".$summaryNo;
       // $path variable store the location where to 
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = $qrcodeImg.'/';
$qrfileName = $id."-".$randomNo."-qr.png";
$file = $path.$qrfileName;
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
  
// Generates QR Code and Stores it in directory given
QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);

      $update = array('qr_code' => $qrfileName);          
      $img_stmt=$obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);
}
*/
		
		if($update_stmt) {
         $_SESSION['msg'] = 'data_updated';
			header("Location:view-certificate.php");
		} else {
			header("location: view-certificate.php");exit;
      }
				
   }


  if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['action']) && $_POST['action']=='status'){

    $id = isset($_POST['id'])?check_input($con,base64_decode($_POST['id'])):'';
    
    $whereCondition = array('certificate_id' => $id);
    $fetchCategory=$obj->selectWhere($con,$certificateTbl,$whereCondition);
    foreach($fetchCategory as $data){ 
      $cstatus = $data['status'];
    }      

    if($data['status']=='1'){
      $update = array('status' => "0");      
      $stmt = $obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);
    }
  
    if($data['status']=='0'){
      $update = array('status' => "1");      
      $stmt = $obj->dataUpdate($con,$certificateTbl, $update, $whereCondition);      
    }    

    if($stmt) {
      $_SESSION['msg'] = 'status_changed';
      echo "1";
      exit;
      //header('location: view-certificate.php');exit;
    } else {
      echo "0";
      exit;
      //header("location: view-certificate.php");exit;
    }

  }
?>