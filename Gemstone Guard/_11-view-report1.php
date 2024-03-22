<?php include_once 'header-top.php'; ?>

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
                
                    <div class="col-md-1 col-lg-1"></div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        
                            <div class="login-form reportsummary-box">
                                <div class="pdf-certi">
                                    <canvas class="mx-auto d-flex" id="my_canvas"></canvas>
                                </div>

                                <div class="about-us-area">
                                <div class="overview-content mx-auto d-flex">
                                <div class="hiraola-about-us_btn-area mx-auto d-flex">
                                    <a class="about-us_btn" href="certi-pdf/abc-123.pdf" target="_blank">Download PDF</a>
                                </div>
                                </div>
                            </div>

                            </div>
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
    pdfjsLib.getDocument('certi-pdf/PERSNL.pdf').then(doc => {
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