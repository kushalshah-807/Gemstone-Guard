<?php
   include "db_connect.php";
   	$obj=new Utility();
   	
   $cId = isset($_POST['get_option'])?check_input($con,base64_decode($_POST['get_option'])):'';

	$whereCondition = array('customer_id' => $cId);
    $fetchProduct=$obj->selectWhere($con,$customerTbl,$whereCondition);    
    foreach($fetchProduct as $data){
      $data[] = $data;
    }
?>

      <input type="hidden" name="companyName" id="companyName" value="<?php echo $data['company_name']; ?>" placeholder="Enter Company Name" class="form-control" />
      
                       <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">GST No. <span class="mandatory">*</span></label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="gstNo" id="gstNo" value="<?php echo $data['gst_no']; ?>" placeholder="Enter GST No." class="form-control" />
	                        </div>
	                     </div>
	                     </div>
	                     
	                    <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">Client Name</label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="fullName" id="fullName" value="<?php echo $data['name']; ?>" placeholder="Enter Name" class="form-control" />	                      		
	                        </div>
	                     </div></div>
	                     
	                     <div class="col-md-6">
	                     <div class="form-group">
                        	<label for="Keyword" class="col-sm-4 control-label">Address</label>
                           <div class="col-sm-8">
                           	<textarea name="address" id="address" class="form-control" rows="3"><?php echo $data['address']; ?></textarea>
                           </div>
                        </div></div>

<?php
    exit;
?>