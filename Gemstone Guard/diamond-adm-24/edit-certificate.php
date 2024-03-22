<?php
include "header.php";
include "sidebar.php";

	$id = isset($_REQUEST['id'])?check_input($con,base64_decode($_REQUEST['id'])):'';
	$id1 = isset($_REQUEST['id'])?check_input($con,$_REQUEST['id']):'';	
	
	$obj=new Utility();
	$whereCondition = array('certificate_id' => $id);
    $fetchProduct=$obj->selectWhere($con,$certificateTbl,$whereCondition);
    foreach($fetchProduct as $data){ 
		$data[] = $data;
    }

	//Shape Certi
	$scertis=array();
	$fetchPrRpr=$obj->selectWhere($con,$certishapeTbl,$whereCondition);
    foreach($fetchPrRpr as $selectedPrRpr){ 
		$scertis[]=$selectedPrRpr['shape_id'];
    }

	//Color Certi
	$ccertis=array();
	$fetchCcerti=$obj->selectWhere($con,$certicolorTbl,$whereCondition);
    foreach($fetchCcerti as $dataCcerti){ 
		$ccertis[]=$dataCcerti['color_id'];
    }

	//Clarity Certi
	$crcertis=array();
	$fetchCrcerti=$obj->selectWhere($con,$certiclarityTbl,$whereCondition);
    foreach($fetchCrcerti as $dataCrcerti){ 
		$crcertis[]=$dataCrcerti['clarity_id'];
    }        
?>
 
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
 <link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
      
       
<script type="text/javascript">
$(document).ready(function() {
	$("#certificateForm").validate({
		rules: {
		summaryNo: {
				required: true,
			},
			certificateDate: {
				required: true,
			},
			customerId: {
				required: true,
			}
		},
		messages: {
		    summaryNo: {
				required: "This field cannot be blank.",
			},
			certificateDate: {
				required: "This field cannot be blank.",
			},
			customerId: {
				required: "This field cannot be blank.",
			}
		}
	});
});
</script>

<script>
	function fetchSummaryno(val){
	   $.ajax({
	     type: 'post',
	     url: 'fetch-summaryno.php',
	     data: {
	       cDate:val
	     },
	     success: function (response) {
	       document.getElementById("summaryno-area").innerHTML=response; 
	     }
	   });
	}	
	function fetchClientDetail(val){
	   $.ajax({
	     type: 'post',
	     url: 'fetch-client-detail.php',
	     data: {
	       get_option:val
	     },
	     success: function (response) {
	       document.getElementById("client-dtl").innerHTML=response; 
	     }
	   });
	}			
</script>

<script language="javascript" type="text/javascript">
        window.onload = function () {

            var fileUpload = document.getElementById("fileUpload");          

           fileUpload.onchange = function () {

                if (typeof (FileReader) != "undefined") {

                    var dvPreview = document.getElementById("dvPreview");
                    dvPreview.innerHTML = "";

                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;

                    for (var i = 0; i < fileUpload.files.length; i++) {

                        var file = fileUpload.files[i];
                        var size=fileUpload.files[i].size;

                        if(size > 1024000)
                        {
									alert("Exceed the Maximum PDF Size");
									$(fileUpload).val("");
		        		}
						
                    }

                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }

            }

}
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Edit Certificate
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Certificate</li>
	  </ol>
	</section>
	
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Enter Certificate Details</h3>
	                </div><!-- /.box-header -->
	                
	                <!-- form start -->
	                <form class="form-horizontal" name="certificateForm" id="certificateForm" enctype="multipart/form-data"  method="post" action="certificate-process.php" enctype="multipart/form-data" autocomplete="off">
	                  <div class="box-body">
	                  
                     <div class="row">
                     	<div class="col-md-6">
						  <div class="form-group">
						  <label class="col-sm-4 control-label">Date<span class="mandatory">*</span></label>
	                     <div class="col-sm-8">
	                      	 <input type="text" name="certificateDate" id="certificateDate" value="<?php if(isset($data['certificate_date'])){ if($data['certificate_date']!=''){ echo date('d-m-Y',strtotime($data['certificate_date'])); } } ?>" class="form-control" readonly /> 
						</div>
                          </div>
	                    </div>

                     <div class="col-md-6">
	                    <div class="form-group">	                    	
                              <label for="summaryNo" class="col-sm-4 control-label">Summary No.<span class="mandatory">*</span></label>
	                      <div id="summaryno-area" class="col-sm-8">
	                      	<!--
	                      	<input type="hidden" name="alphaNo" id="alphaNo" value="<?php //echo $data['alpha_no']; ?>" />
							<input type="hidden" name="numericNo" id="numericNo" value="<?php //echo $data['numeric_no']; ?>" /> -->
	                        <input type="text" name="summaryNo" id="summaryNo" value="<?php if(isset($data['summary_no'])){ if($data['summary_no']!=''){ echo $data['summary_no']; } } ?>" class="form-control" readonly />
	                      </div>
						  </div>
						  </div>						  
                     </div>
                                         
                    <div class="row"> 
                     <div class="col-md-6">
	                    <div class="form-group">  
							
						  <label for="customerId" class="col-sm-4 control-label">Company Name<span class="mandatory">*</span></label>
							<div class="col-sm-8">
                         <select name="customerId" id="customerId" class="select2" onChange="fetchClientDetail(this.value);" required="" style="width:100%;">
	                      	<option value="">-- Select Client --</option>
							<?php   $fetchClient=$obj->fetchData($con,$customerTbl,"customer_id","DESC");   
							if(count($fetchClient) > 0){
							foreach($fetchClient as $dataClient){ ?>								
	                      			<option value="<?php echo base64_encode($dataClient['customer_id']);?>" <?php if($dataClient['customer_id']==$data['customer_id']) { echo "selected"; } ?> ><?php echo $dataClient['company_name'];?></option>
							<?php	  } } ?>
	                      </select>
							</div>
					            
						</div>
						</div>
						
						<div id="client-dtl">
						   
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
                        
						</div>
						
					</div>
					
					
					<div class="row">						
					<div class="col-md-6">
						<div class="form-group"> 
						<label class="col-sm-4 control-label">Upload File</label>
								<div class="col-sm-8">
								
								<div class="fileinput fileinput-new fileinputCat2" data-provides="fileinput">
                                    
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           
                                            <?php  if (isset($data['pdf']) && $data['pdf'] != '')  { ?>
                                               <a href="../<?php echo $certiPdf."/".$data['pdf']; ?>" target="_blank"> <img src="dist/img/glyphicons/document-icon.png"/></a>
                                            <?php } else {
                                                ?>
                                                <img src="http://www.placehold.it/200x150/3c8dbc/fff&text=PDF"/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Browse PDF</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="fileUpload" id="fileUpload" onclick="getImage2();" accept=".pdf"></span>
                                            <?php  if (isset($data['pdf']) && $data['pdf'] != '')  { ?>
                                              <a href="javascript:void(0);" class="btn btn-default" data-dismiss="fileupload" id="oldImage2" onclick="clearImage2()">Clear</a>
                                              <a href="../<?php echo $certiPdf."/".$data['pdf']; ?>" target="_blank" class="btn btn-primary">View PDF</a>
                                            <?php } ?>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        <?php if (isset($data['pdf']) && $data['pdf'] != '') { ?>
                                            <input type="hidden" name="existImage2" id="existImage2" value="<?php echo $data['pdf']; ?>"/>
                                            <input type="hidden" name="removedImage2" id="removedImage2" value="<?php echo $data['pdf']; ?>"/>
                                        <?php } ?>
                                </div>
                           </div>
                        </div>
					</div>
					</div>


					<div class="row">
                     
                     <div class="col-md-6">
                      <div class="form-group">
                     <label for="prdShape" class="col-lg-4 control-label">Shape/Cut</label>
                     <div class="col-lg-8">
                     	<select id="prdShape" name="prdShape[]" multiple="multiple" class="select2" title="Please choose" style="width:100%;">
                     		<option value="">--Select--</option>
                            <?php $whereCondition = array('variation_id' => "1");
								$fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
								if($fetchVtype > 0){
									foreach($fetchVtype as $dataVtype){ ?>
                                    	<option value="<?php echo base64_encode($dataVtype['variation_type_id']); ?>" <?php if(in_array($dataVtype['variation_type_id'],$scertis)) { echo "selected"; } ?> ><?php echo $dataVtype['variation_type']; ?></option>
							<?php }	} ?>
                        </select>
                     </div>
                    </div>
                     </div>
					 
					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Total EST WT</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="estWt" name="estWt" value="<?php echo $data['weight']; ?>" />
                     </div>
                    </div>
                     </div>
					 
					</div>
					
					<div class="row">
                     
                     <div class="col-md-6">
                      <div class="form-group">
                     <label for="prdcolor" class="col-lg-4 control-label">Colour</label>
                     <div class="col-lg-8">
                     	<select id="prdcolor" name="prdcolor[]" multiple="multiple" class="select2" title="Please choose" style="width:100%;">
                     		<option value="">--Select--</option>
                            <?php $whereCondition = array('variation_id' => "2");
								$fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
								if($fetchVtype > 0){
									foreach($fetchVtype as $dataVtype){ ?>
                                    	<option value="<?php echo base64_encode($dataVtype['variation_type_id']); ?>" <?php if(in_array($dataVtype['variation_type_id'],$ccertis)) { echo "selected"; } ?> ><?php echo $dataVtype['variation_type']; ?></option>
							<?php }	} ?>
                        </select>
                     </div>
                    </div>
                     </div>
					 
					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Clarity</label>
                     <div class="col-lg-8">
                     	<select id="prdClarity" name="prdClarity[]" multiple="multiple" class="select2" title="Please choose" style="width:100%;">
                     		<option value="">--Select--</option>
                            <?php $whereCondition = array('variation_id' => "3");
								$fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
								if($fetchVtype > 0){
									foreach($fetchVtype as $dataVtype){ ?>
                                    	<option value="<?php echo base64_encode($dataVtype['variation_type_id']); ?>" <?php if(in_array($dataVtype['variation_type_id'],$crcertis)) { echo "selected"; } ?> ><?php echo $dataVtype['variation_type']; ?></option>
							<?php }	} ?>
                        </select>                      
                     </div>
                    </div>
                     </div>
					 
					</div>

					<div class="row">                     
					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Refractive Index</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="refractiveIndex" name="refractiveIndex" value="<?php echo $data['refractive_index']; ?>" />
                     </div>
                    </div>
                     </div>

					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Specific Gravity</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="specificGravity" name="specificGravity" value="<?php echo $data['specific_gravity']; ?>" />
                     </div>
                    </div>
                     </div>
					 
					</div>

					<div class="row">                     
					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Hardness</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="hardNess" name="hardNess" value="<?php echo $data['hardness']; ?>" />
                     </div>
                    </div>
                     </div>

					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="estWt" class="col-lg-4 control-label">Origin</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="origin" name="origin" value="<?php echo $data['origin']; ?>" />
                     </div>
                    </div>
                     </div>
					 
					</div>

					<div class="row">
					 <div class="col-md-6">
                      <div class="form-group">
                     <label for="prdMeasure" class="col-lg-4 control-label">Measure</label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="prdMeasure" name="prdMeasure" value="<?php echo $data['measure']; ?>" />
                     </div>
                    </div>
                     </div>
                    </div>
										
					
					<div class="row">

                    <div class="col-md-12">

                     <div class="form-group">

                        <label for="mainDescription" class="col-lg-2 control-label">Description</label>

                        <div class="col-lg-10">

                            <textarea class="input-xlarge isRequired discriptiontextarea" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"><?php echo $data['description']; ?></textarea>

                        </div>

                     </div>

                     </div>

                    </div>
					
					<div class="row">

                    <div class="col-md-12">

                     <div class="form-group">

                        <label for="prdComment" class="col-lg-2 control-label">Comments</label>

                        <div class="col-lg-10">

                            <textarea class="input-xlarge isRequired discriptiontextarea" id="prdComment" name="prdComment" rows="3" title="Please enter Comments"><?php echo $data['comment']; ?></textarea>

                        </div>

                     </div>

                     </div>

                    </div>
                    
                    <div class="row">

                    <div class="col-md-12">

                     <div class="form-group">

                        <label for="prdComment" class="col-lg-2 control-label">Identification</label>

                        <div class="col-lg-10">

                            <textarea class="input-xlarge isRequired discriptiontextarea" id="identification" name="identification" rows="3" title="Please enter Identification"><?php echo $data['identification']; ?></textarea>

                        </div>

                     </div>

                     </div>

                    </div>
					
					<input type="hidden" name="id" id="id" value="<?php echo $id1; ?>"/>
                     
					<div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Save Changes">
						&ensp;&ensp;
                        <input type="reset" name="reset" class="btn bg-primary" value="Reset">
                    </div>

					</div>
				</form>
				
			</div>
			</div>
		</div>
	</section>
	
</div>

<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>

<script>
	/*
$("#certificateDate").datepicker( {
	dateFormat:"dd-mm-yy",
}); */
</script>

<script type="text/javascript" >
  $(function () {
    $(".select2").select2();
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  });

  $(function () {

// Replace the <textarea id="editor1"> with a CKEditor

// instance, using default configuration.

CKEDITOR.replace('mainDescription');
CKEDITOR.replace('prdComment');
CKEDITOR.replace('identification');

//bootstrap WYSIHTML5 - text editor

$(".textarea").wysihtml5();

});

    function clearImage2() {
        $('.fileinputCat2').fileinput('clear');
        $("#oldImage2").addClass("hide");
        $('#existImage2').val('');
    }
    
    function getImage2() {
        $('.fileinputCat2').fileinput('clear');
        $("#oldImage2").addClass("hide");
        $('#existImage2').val('');
    }  
</script>

<?php	include "footer.php";	?>