<?php
include "header.php";
include "sidebar.php";
?>

<style> 	
    .subContainer{
      float:left;
      width:100%;
      margin-left:4%;
    }
    .sectionContainer{
        float:left;
        width:100%;
        text-align:left;
        font-size:20px;
        font-weight:500;
        height:40px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
           <div class="row">
            <div class="col-xs-12">
                <div class="box-body">
                   <div class="subContainer">
                <img src="dist/img/logo.png" alt="<?php echo $companyName; ?>" title="<?php echo $companyName; ?>" style="border:2px solid #000; padding:20px; width:350px;" />
                	</div>
                </div>
            </div>
        </div>
                                 
    
	<div class="row">
            <div class="col-xs-12">
                <div class="box-body">
                    <div class="subContainer">
                        <div class="sectionContainer">Manage</div>
                           <!--
                           <a href="view-variation.php" class="btn btn-default btn-lg" style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/variation.png" style="width:48px; height:48px;" /><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Variation</span></a>
                        	<a href="view-category.php" class="btn btn-default btn-lg" style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/About-Pages.png"/><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Category</span></a>
                        	-->                        	
                        	<a href="view-certificate.php" class="btn btn-default btn-lg" style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/Programme-Details.png"/><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Certificate</span></a>
                        	<a href="view-client.php" class="btn btn-default btn-lg " style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/Manage-Programmes.png"/><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Customer</span></a>
                        	
                        	<a href="change-password.php" class="btn btn-default btn-lg" style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/password.png"/><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Change Password</span></a>
                           <a href="logout.php" class="btn btn-default btn-lg" style="margin-right:2px;width:200px;margin-bottom:10px;"><img src="dist/img/glyphicons/signout.png"/><br/> <span style="font-size:16px; font-weight: 600;color: #084e81;">Signout</span></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Header (Page header) -->
  
</div>	
          
<?php include "footer.php";?>      