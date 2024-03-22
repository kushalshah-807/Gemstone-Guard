<?php
include "header.php";
include "sidebar.php";

	$id = isset($_REQUEST['id'])?check_input($con,base64_decode($_REQUEST['id'])):'';
	$id1 = isset($_REQUEST['id'])?check_input($con,$_REQUEST['id']):'';	
	
	$obj=new Utility();
	$whereCondition = array('customer_id' => $id);
    $fetchProduct=$obj->selectWhere($con,$customerTbl,$whereCondition);
    foreach($fetchProduct as $data){ 
		$data[] = $data;
    }

?>
<script type="text/javascript">
$(document).ready(function() {
	$("#userform").validate({
		rules: {
		   companyName: {
				required: true,
			},
			fullName: {
				required: true,
			},		   		
		contactNumber: {
				number:true,
			},
		
		},
		messages: {
		   companyName: {
				required: "This field cannot be blank.",
			},
			fullName: {
				required: "This field cannot be blank.",
			},			
			contactNumber: {
				number:"Only numerical value allowed",				
			},
			
		}
	});
});
</script>


 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Edit Client
	    <!--<small>...</small>-->
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Edit Client</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header">
                     <h3 class="box-title">Edit Client</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
                  </div><!-- /.box-header -->
	                
	                <!-- form start -->
	                <form name="userform" id="userform" method="post" action="client-process.php" class="form-horizontal" autocomplete="off">
	                  <div class="box-body">	                    

                        <div class="row">
	                    <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">Company Name <span class="mandatory">*</span></label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="companyName" id="companyName" value="<?php echo $data['company_name']; ?>" placeholder="Enter Company Name" class="form-control" />
	                        </div>
	                     </div>
	                     </div>
	                     
	                     <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">GST No.</label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="gstNo" id="gstNo" value="<?php echo $data['gst_no']; ?>" placeholder="Enter GST No." class="form-control" />
	                        </div>
	                     </div>
	                     </div>
	                    </div>
	                                           
	                    <div class="row">
	                    <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">Client Name <span class="mandatory">*</span></label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="fullName" id="fullName" value="<?php echo $data['name']; ?>" placeholder="Enter Name" class="form-control" />	                      		
	                        </div>
	                     </div></div>
	                    <div class="col-md-6"> 
	                    <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Contact Number</label>
                           <div class="col-sm-8">
                           	<input type="text" name="contactNumber" id="contactNumber" value="<?php echo $data['phone_no']; ?>" placeholder="Enter Phone Number" class="form-control" />
                           </div>
                        </div></div>
                        
                        </div>
                        
                       <div class="row">
                       <div class="col-md-6"> 
	                    <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Mobile No.</label>
                           <div class="col-sm-8">
                           	<input type="text" name="mobileNo" id="mobileNo" value="<?php echo $data['mobile_no']; ?>" placeholder="Enter Mobile Number" class="form-control" />
                           </div>
                        </div></div>
                        
                       <div class="col-md-6">
                        <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Email</label>
                           <div class="col-sm-8">
                           	<input type="text" name="userEmail" id="userEmail" value="<?php echo $data['email_id']; ?>" placeholder="Enter Email Id" class="form-control" />
                           </div>
                        </div></div>
                        
                        </div>
                        
                        <div class="row">
                        <div class="col-md-6">
	                     <div class="form-group">
                        	<label for="Keyword" class="col-sm-4 control-label">Address</label>
                           <div class="col-sm-8">
                           	<textarea name="address" id="address" class="form-control" rows="3"><?php echo $data['address']; ?></textarea>
                           </div>
                        </div></div>
                                                
                        </div>                                            
	                     
			 			   </div><!-- /.box-body -->
			 			   
			 			   <input type="hidden" name="id" id="id" value="<?php echo $id1; ?>"/>
			 			   
	                  <div class="box-footer">	                    
	                    	<input type="submit" name="submit" class="btn btn-info" value="Save Changes">
	                    	<input type="reset" name="reset" class="btn bg-primary" value="Reset">	                    
	                  </div><!-- /.box-footer -->
	                </form>
	                
	              </div>
			</div>
		</div>             
	</section>
	
</div>

<script type="text/javascript">
   $("#dateBirth").datepicker( {
	dateFormat:"dd-mm-yy",
});
</script>
	
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
    
<?php
include "footer.php";
?>