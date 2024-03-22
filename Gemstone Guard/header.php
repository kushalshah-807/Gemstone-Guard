<script>
       function validatehSearchNow(){
        
        var rno = document.getElementById('rno').value
        if(rno==''){
            document.getElementById("srhRno_error").innerHTML = "Please enter Report No.";            
            document.getElementById("rno").focus();
            return false;
        }
    
      document.getElementById('hsearchForm').submit();      
    }
</script>
</head>

<body class="template-color-3">

    <div class="main-wrapper">

        <!-- Begin Header Main Area Three -->
        <header class="header-main_area header-main_area-3">

            <div class="header-bottom_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 d-block">
                            <div class="header-logo">
                                <a href="index.php">
                                    <img src="img/logo.png" alt="Logo" />
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
										<li><a href="about-us.php">About Us</a></li>
                                        <li><a href="our-services.php">Our Services</a></li>
                                        <li><a href="contact-us.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-lg-3 d-none d-lg-flex justify-content-center position-static">
                            <div class="header-right_area pt-20">
                                    <ul>                                        
                                        <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn hvreport-link">
                                               <i class="fa fa-qrcode"></i>&nbsp; Verify your Report
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
                                                <i class="ion-navicon"></i>
                                            </a>
                                        </li>                                        
                                    </ul>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="header-bottom_area header-bottom_area-2 header-sticky stick white--color">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4">
                            <div class="header-logo">
                                <a href="index.php">
                                    <img src="img/logo.png" alt="Logo" />
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about-us.php">About Us</a></li>
                                        <li><a href="our-services.php">Our Services</a></li>
                                        <li><a href="contact-us.php">Contact Us</a></li>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-8">
                            <div class="header-right_area">
                                <ul>                                    
                                    <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn hvreport-link">
                                               <i class="fa fa-qrcode"></i>&nbsp; Verify your Report
                                            </a>
                                    </li>
                                    <li>
                                        <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
                                            <i class="ion-navicon"></i>
                                        </a>
                                    </li>                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offcanvas-search_wrapper" id="searchBar">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <!-- Begin Offcanvas Search Area -->
                        <div class="offcanvas-search">
                            <form name="hsearchForm" id="hsearchForm" method="get" action="view-report.php" autocomplete="off" class="hm-searchbox">
                                <input type="text" name="rno" id="rno" placeholder="Enter Report No." />
                                <span class="field_error" id="srhRno_error"></span>
                                <button type="button" name="button" id="hsearch-form-fill-btn" class="search_btn" onclick="validatehSearchNow();
                            return false;"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <!-- Offcanvas Search Area End Here -->
                    </div>
                </div>
            </div>

            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                                <li><a href="index.php"><span class="mm-text">Home</span></a></li>
                                <li><a href="about-us.php"><span class="mm-text">About Us</span></a></li>
                                <li><a href="our-services.php"><span class="mm-text">Our Services</span></a></li>
                                <li><a href="contact-us.php"><span class="mm-text">Contact Us</span></a></li>                                
                            </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>

        </header>
        <!-- Header Main Area Three End Here -->