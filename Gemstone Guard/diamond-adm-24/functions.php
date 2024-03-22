<?php   
   
class Utility{
   
   public function dataInsert($con,$tableName,$data){      
      $query = "INSERT INTO `".$tableName."` (";                  $query .= implode(",", array_keys($data)) . ') VALUES (';                  $query .= "'" . implode("','", array_values($data)) . "')";      
	  //echo $query;
	  //exit;
      if(mysqli_query($con,$query)){           return true;      }  else{           echo mysqli_error($con);        }   }


   public function dataUpdate($con,$tableName, $fields, $whereCondition){      $query = '';      $condition = '';        foreach($fields as $key => $value){           $query .= "`".$key."`='".$value."', ";      }                $query = substr($query, 0, -2);      foreach($whereCondition as $key => $value){           $condition .= "`".$key."`='".$value."' AND ";        }        $condition = substr($condition, 0, -5);      
   $query = "UPDATE `".$tableName."` SET ".$query." WHERE ".$condition; 
	if(mysqli_query($con,$query)) {		            return true;        }     }
      
   public function fetchData($con,$tableName,$cName,$dseq){
      $data=array();
    $query="SELECT * FROM `".$tableName."` ORDER BY `".$cName."` ".$dseq;    
    $result=mysqli_query($con,$query);      
    while($row = mysqli_fetch_assoc($result)){         $data[] = $row;      }      
    return $data;
  }   

   public function selectWhere($con,$tableName, $whereCondition){
      $array = array();      
   $condition = '';         		
   foreach($whereCondition as $key => $value){         $condition .= $key . " = '".$value."' AND ";      }        $condition = substr($condition, 0, -5);      $query = "SELECT * FROM `".$tableName."` WHERE " . $condition;
   $result = mysqli_query($con,$query);        
   while($row = mysqli_fetch_array($result)){           $array[] = $row;        }      
   return $array;   }
      
  public function selectWhereDataOrd($con,$tableName,$whereCondition,$cName,$dseq){
	$array = array();      
	$condition = '';              
	foreach($whereCondition as $key => $value){         
		$condition .= $key . " = '".$value."' AND ";      
	}        
	$condition = substr($condition, 0, -5);      
	$query = "SELECT * FROM `".$tableName."` WHERE " . $condition ." ORDER BY `".$cName."` ".$dseq;
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result)){           
		$array[] = $row;        
	}      
	return $array;     
  }

   public function dataDelete($con,$tableName, $whereCondition){      
   $query = '';      $condition = '';
   foreach($whereCondition as $key => $value){           
   $condition .= "`".$key."` ='".$value."' AND ";        }        
   $condition = substr($condition, 0, -5);		         
   $query = "DELETE FROM `".$tableName."` WHERE ".$condition;   
      if(mysqli_query($con,$query))  {		            return true;        }     
	}     
  
  public function countrylist($con,$tblName){
   $fetchcountries=mysqli_query($con,"SELECT `country_id`,`name` FROM `".$tblName."` ORDER BY `name` ASC ")or die(mysqli_error($con));
   while($countryResult=mysqli_fetch_assoc($fetchcountries)){
      $countrymainResult[]=$countryResult;
   }
   return $countrymainResult;
}

   public function statelist($con,$tblName,$countryid){
   $fetchstates=mysqli_query($con,"SELECT `state_id`,`name` FROM `".$tblName."` WHERE `country_id`='".$countryid."' ORDER BY `name` ASC") or die(mysqli_error($con));
   while($stateResult=mysqli_fetch_assoc($fetchstates)){
      $statemainResult[]=$stateResult;
   }
   return $statemainResult;   
   }

/*
   public function reportDetail($con,$tblName,$tblName2,$rno){
      $rprd_result=array();
      $fetchRProduct=mysqli_query($con,"SELECT `rpt`.*,`vts`.`variation_type` AS `vshape`,`vtcl`.`variation_type` AS `vcolor`,`vtscr`.`variation_type` AS `vclarity` FROM `".$tblName."` AS `rpt` LEFT JOIN `".$tblName2."` AS `vts` ON `rpt`.`shape`=`vts`.`variation_type_id` LEFT JOIN `".$tblName2."` AS `vtcl` ON `rpt`.`color`=`vtcl`.`variation_type_id` LEFT JOIN `".$tblName2."` AS `vtscr` ON `rpt`.`clarity`=`vtscr`.`variation_type_id` WHERE `rpt`.`status`='1' AND `rpt`.`summary_no`='".$rno."' ") or die(mysqli_error($con));
      while($dataRProduct=mysqli_fetch_array($fetchRProduct)){
         $rprd_result[]=$dataRProduct;
      }
      return $rprd_result;
   } */

   public function reportVariation($con,$cName,$tblName,$tblName2,$cid){
      $cvrt_result=array();
	  $adColumn="certi_".$cName;
      $fetchcVariation=mysqli_query($con,"SELECT `ctv`.`".$cName."`,`vts`.`variation_type` FROM `".$tblName."` AS `ctv` LEFT JOIN `".$tblName2."` AS `vts` ON `ctv`.`".$cName."`=`vts`.`variation_type_id` WHERE `ctv`.`certificate_id`='".$cid."' ORDER BY `ctv`.`".$adColumn."` ASC ") or die(mysqli_error($con));
      while($datacVariation=mysqli_fetch_array($fetchcVariation)){
        $cvrt_result[]=$datacVariation;        
      }
      return $cvrt_result;
   }
	
}


/*
class Productvrtn{
  
	public function productvariation($con,$tblName,$tblName2,$productid){
	$prdvtn_result=array();
   
   $fetch_prdvtn=mysqli_query($con,"SELECT `pclr`.*,`clr`.`variation_type` FROM `".$tblName."` AS `pclr` LEFT JOIN `".$tblName2."` AS `clr` ON `pclr`.`color_id`=`clr`.`variation_type_id` WHERE `pclr`.`product_id`='".$productid."' ORDER BY `default_map_id` DESC ")or die(mysqli_error($con));
   while($prdvtns=mysqli_fetch_array($fetch_prdvtn)){
   	$prdvtn_result[]=$prdvtns;
   }
   return $prdvtn_result;
	}
}	*/


function clientlist($con){
   $fetchClients=mysqli_query($con,"SELECT * FROM `gsh_client` ORDER BY `client_id` DESC ")or die(mysqli_error($con));
   while($resultClients=mysqli_fetch_array($fetchClients)){
      $mainResultClient[]=array("client_id" => $resultClients['client_id'],
      "company_name" => $resultClients['company_name'],
      "name" => $resultClients['name'],
      "phone_no" => $resultClients['phone_no'],
      );
   }
   return $mainResultClient;
}

?>