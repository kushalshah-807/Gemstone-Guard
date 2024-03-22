<?php include_once 'header-top.php';

    $obj=new Utility();
    
    $rno = isset($_GET['rno'])?check_input($con,$_GET['rno']):'';
    $whereCondition = array('summary_no' => $rno);

    $fetchCertificate=$obj->selectWhere($con,$certificateTbl,$whereCondition);    
    foreach($fetchCertificate as $dataCertificate){ 
            $dataCertificate[] = $dataCertificate;
    }

    $svariations="";
    $fetchsVrt=$obj->reportVariation($con,"shape_id",$certishapeTbl,$variationtpTbl,$dataCertificate['certificate_id']);
    foreach($fetchsVrt as $datasVrt){ 
        $svariations.=$datasVrt['variation_type'].", ";
    }

    $cvariations="";
    $fetchcVrt=$obj->reportVariation($con,"color_id",$certicolorTbl,$variationtpTbl,$dataCertificate['certificate_id']);
    foreach($fetchcVrt as $datacVrt){ 
        $cvariations.=$datacVrt['variation_type'].", ";
    }

    $crvariations="";
    $fetchcrVrt=$obj->reportVariation($con,"clarity_id",$certiclarityTbl,$variationtpTbl,$dataCertificate['certificate_id']);
    foreach($fetchcrVrt as $datacrVrt){ 
        $crvariations.=$datacrVrt['variation_type'].", ";
    }    
?>

<title>Report | <?php echo $companyName; ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<?php include_once 'header-css.php'; ?>
<?php include_once 'header.php'; ?>
	

        <!-- Begin Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Report</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Report</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->
        <!-- Begin Login Register Area -->
        <div class="hiraola-login-register_area">
            <div class="container">
                <div class="row">

                    <?php if (isset($dataCertificate['pdf']) && $dataCertificate['pdf'] != '')  {
            $imgfileSource1 = $certiPdf . DIRECTORY_SEPARATOR . $dataCertificate['pdf'];
                if(file_exists($imgfileSource1)){ ?>
                    <div class="col-md-2 col-lg-2"></div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="login-form reportsummary-box">
                                <div class="pdf-certi">
                                    <canvas class="mx-auto d-flex" id="my_canvas"></canvas>
                                </div>

                                <div class="about-us-area">
                                <div class="overview-content mx-auto d-flex">
                                <div class="hiraola-about-us_btn-area mx-auto d-flex">
                                    <a class="about-us_btn" href="<?php echo $imgfileSource1; ?>" target="_blank">Download PDF</a>
                                </div>
                                </div>
                            </div>

                            </div>
                    </div>
                <?php } } else{ ?>
				
					<div class="col-md-3 col-lg-3"></div>
					
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    
                            <div class="login-form reportsummary-box">
                                <h4 class="login-title text-center">Diamond Report Summary</h4>
                                <div class="row">
								
                                <?php if(count($fetchCertificate) > 0){ ?>

                                    <?php if(isset($dataCertificate['company_name'])){ if($dataCertificate['company_name']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Party Name :</strong></p>
									</div>
									<div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['company_name']; ?></p>
									</div>
                                <?php } } ?>
									
                                    <?php if(isset($dataCertificate['summary_no'])){ if($dataCertificate['summary_no']!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Summary No :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['summary_no']; ?></p>
                                    </div>
                                    <?php } } ?>
									
                                    <?php if(isset($dataCertificate['description'])){ if($dataCertificate['description']!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Description :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">										<div class="rdtl">
											<?php echo html_entity_decode($dataCertificate['description']); ?>										</div>
                                    </div>
									<?php } } ?>
                                    
                                    <?php if(isset($svariations)){ if($svariations!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Shape/Cut :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">
										<div class="rdtl">
											<p><?php echo rtrim($svariations,", "); ?></p>
										</div>
                                    </div>
                                    <?php } } ?>
                                    
                                    <?php if(isset($dataCertificate['weight'])){ if($dataCertificate['weight']!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Total EST WT :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['weight']; ?></p>
                                    </div>
									<?php } } ?>

                                    <?php if(isset($cvariations)){ if($cvariations!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Colour :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">
										<div class="rdtl">
											<p><?php echo rtrim($cvariations,", "); ?></p>
										</div>
                                    </div>
                                    <?php } } ?>
									
                                    <?php if(isset($crvariations)){ if($crvariations!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Clarity :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">
										<div class="rdtl">
											<p><?php echo rtrim($crvariations,", "); ?></p>
										</div>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['refractive_index'])){ if($dataCertificate['refractive_index']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Refractive Index :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['refractive_index']; ?></p>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['specific_gravity'])){ if($dataCertificate['specific_gravity']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Specific Gravity :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['specific_gravity']; ?></p>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['hardness'])){ if($dataCertificate['hardness']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Hardness :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['hardness']; ?></p>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['origin'])){ if($dataCertificate['origin']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Origin :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['origin']; ?></p>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['measure'])){ if($dataCertificate['measure']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Measure :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <p><?php echo $dataCertificate['measure']; ?></p>
                                    </div>
                                    <?php } } ?>
									
                                    <?php if(isset($dataCertificate['comment'])){ if($dataCertificate['comment']!=''){ ?>
									<div class="col-md-4 col-6">
                                        <p><strong>Comments :</strong></p>
                                    </div>
									<div class="col-md-8 col-6">										<div class="rdtl">
											<?php echo html_entity_decode($dataCertificate['comment']); ?>										</div>
                                    </div>
                                    <?php } } ?>

                                    <?php if(isset($dataCertificate['identification'])){ if($dataCertificate['identification']!=''){ ?>
                                    <div class="col-md-4 col-6">
                                        <p><strong>Identification :</strong></p>
                                    </div>
                                    <div class="col-md-8 col-6">										<div class="rdtl">
											<?php echo html_entity_decode($dataCertificate['identification']); ?>										</div>
                                    </div>
                                    <?php } } ?>

                                <?php } else{ ?>
                                    <div class="col-md-12">
                                        <p class="text-center">Report not found.</p>
                                    </div>
                                <?php }   ?>
									
                                    </div>                                    
									
                                </div>                            

                            </div>
                            <?php } ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Login Register Area  End Here -->

<?php include_once 'footer.php'; ?>
<?php include_once 'footer-js.php'; ?>

<style>
    .pdf-certi #my_canvas{width: 100%;}
</style>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.3.200/pdf.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var cpdf='<?php echo $imgfileSource1; ?>';
    pdfjsLib.getDocument(cpdf).then(doc => {
        console.log(doc._pdfInfo.numPages)

        doc.getPage(1).then((page) => {
            var canvas = document.getElementById('my_canvas')
            var context = canvas.getContext('2d')
            var viewport = page.getViewport(3)
            canvas.width = viewport.width
            canvas.height = viewport.height

            page.render({
                canvasContext:context,
                viewport: viewport
            })
        })
    })   
</script>
<?php include_once 'footer-bottom.php'; ?>