<?php
include "header.php";
include "sidebar.php";
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#userform").validate({
		rules: {
		   companyName: {
				required: true,
				/* remote: "checkexistingClient.php", */
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
				/* remote: "Client already exist.", */
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
	    Add Client
	    <!--<small>...</small>-->
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Add Client</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header">
                     <h3 class="box-title">Add Client</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
                  </div><!-- /.box-header -->
	                <!-- form start -->
	                <form name="userform" id="userform" method="post" action="client-process.php" class="form-horizontal" autocomplete="off">
	                  <div class="box-body">
                        
                        <div class="row">
	                    <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">Company Name <span class="mandatory">*</span></label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="companyName" id="companyName" placeholder="Enter Company Name" class="form-control" />
	                        </div>
	                     </div>
	                     </div>
	                     
	                     <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">GST No.</label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="gstNo" id="gstNo" placeholder="Enter GST No." class="form-control" />
	                        </div>
	                     </div>
	                     </div>
	                    </div>
	                    	                    
	                    <div class="row">
	                    <div class="col-md-6">
  								<div class="form-group">
	                    		<label for="first_name" class="col-sm-4 control-label">Client Name <span class="mandatory">*</span></label>
	                      	<div class="col-sm-8">
	                      		<input type="text" name="fullName" id="fullName" placeholder="Enter Name" class="form-control" />
	                        </div>
	                     </div>
	                     </div>	                     
	                     
	                    <div class="col-md-6"> 
	                    <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Contact Number </label>
                           <div class="col-sm-8">
                           	<input type="text" name="contactNumber" id="contactNumber" placeholder="Enter Phone Number" class="form-control" />
                           </div>
                        </div></div>                        
                        </div>
                        
                       <div class="row">
                       <div class="col-md-6"> 
	                    <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Mobile No.</label>
                           <div class="col-sm-8">
                           	<input type="text" name="mobileNo" id="mobileNo" placeholder="Enter Mobile Number" class="form-control" />
                           </div>
                        </div></div>
                        
                       <div class="col-md-6">
                        <div class="form-group">
                        	<label for="categorySlug" class="col-sm-4 control-label">Email</label>
                           <div class="col-sm-8">
                           	<input type="text" name="userEmail" id="userEmail" placeholder="Enter Email Id" class="form-control"  />
                           </div>
                        </div>
                        </div>                        
                        </div>
                        
                        <div class="row">
	                       <div class="col-md-6">
	                     <div class="form-group">
                        	<label for="Keyword" class="col-sm-4 control-label">Address</label>
                           <div class="col-sm-8">
                           	<textarea name="address" id="address" class="form-control" rows="3"></textarea>
                           </div>
                        </div>
                        </div>
                                                
	                    </div>
                        
                        
			 			   </div><!-- /.box-body -->
			 			   
                     <div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
                        <input type="reset" name="reset" class="btn bg-primary" value="Reset">
                     </div>
                    
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