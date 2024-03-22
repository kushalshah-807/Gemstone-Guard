<?php
    include "db_connect.php";
    $obj=new Utility();
   	
	$cDate = isset($_POST['cDate'])?check_input($con,date('Ymd',strtotime($_POST['cDate']))):'';
    //echo $cDate;    

	$query = mysqli_query($con, "SELECT * FROM `".$certificateTbl."` ORDER BY `certificate_id` DESC LIMIT 1");
	$data =mysqli_fetch_array($query);

	if(isset($data['alpha_no']) && $data['alpha_no']!=''){
		if ($data['numeric_no']=="1000") {
			$alphaNo=$data['alpha_no']+1;
		} else{
			$alphaNo=$data['alpha_no'];
		}
	} else{
		$alphaNo=65;
	}

	if(isset($data['numeric_no']) && $data['numeric_no']!=''){
		if ($data['numeric_no']!="1000") {
			$numericNo=$data['numeric_no']+1;
		} else {
			$numericNo=1;
		}
	}	
	 else {
		$numericNo=1;
	}
	$numericNo=sprintf('%04d', $numericNo);

	$summaryNo=$cDate.chr($alphaNo).$numericNo;
?>
	
	<input type="hidden" name="alphaNo" id="alphaNo" value="<?php echo $alphaNo; ?>" />
	<input type="hidden" name="numericNo" id="numericNo" value="<?php echo $numericNo; ?>" />
	<input type="text" name="summaryNo" id="summaryNo" value="<?php echo $summaryNo; ?>" class="form-control" readonly />

<?php
    exit;
?>	