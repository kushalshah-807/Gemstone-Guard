<?php include_once 'header-top.php'; ?>

<title>Contact Us | <?php echo $companyName; ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<?php include_once 'header-css.php'; ?>
<?php include_once 'header.php'; ?>

        <!-- Begin Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <label>Contact Us</label>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->

        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.7887024693255!2d72.83216581540398!3d21.20055118726629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f1155f275ad%3A0xedda7b5ca5e1af1d!2sTAKSH%20JEWELLERS!5e0!3m2!1sen!2sin!4v1662985077481!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">Contact Us</h3>
                          
                            <div class="single-contact-block">
                                <h4><i class="ion-ios-location"></i> Address</h4>
                                <p>6/860, Chhaparia Sheri, Mahidharpura,<br /> SURAT-3. (INDIA)</p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="ion-ios-location"></i> US Address</h4>
                                <p>578 Ridge Road, North Arlington NJ 07031<br /> United States</p>
                            </div>                            
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone fa-rotate-90"></i> Phone</h4>
                                <p>Mobile: +91 9313385613</p>                                
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope"></i> Email</h4>
                                <p>idglinternationallab@gmail.com</p>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content">
                            <h3 class="contact-page-title">Tell Us Your Message</h3>
                            <div class="contact-form">
                                <form name="inquiryForm" id="inquiryForm" action="#" autocomplete="off">
                                    <div class="form-group">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input type="text" name="fullName" id="fullName" />
                                        <span class="field_error" id="fullname_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email <span class="required">*</span></label>
                                        <input type="email" name="emailId" id="emailId" />
                                        <span class="field_error" id="email_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone No. <span class="required">*</span></label>
                                        <input type="text" name="phoneNo" id="phoneNo" />
                                        <span class="field_error" id="mobile_error"></span>
                                    </div>
                                    <div class="form-group form-group-2">
                                        <label>Your Message</label>
                                        <textarea name="mesSage" id="mesSage" placeholder="Enter Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" name="submit" id="form-fill-btn" value="submit" class="hiraola-contact-form_btn">Submit</button>
                                        <span id="formspinner" class="d-none"><span class="spinner-border spinner-border-sm"></span> Loading...</span>
                                    </div>
                                </form>
                                <div class="form-message mt-3 mb-0">
                                    <div class="form-output inquiry_msg"><p class="form-messege"></p></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->

<?php include_once 'footer.php'; ?>
<?php include_once 'footer-js.php'; ?>
<script type="text/javascript">
     $('#form-fill-btn').click(function(){

      var creg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    
        jQuery('.field_error').html('');
        var fullName = jQuery("#fullName").val();
        var emailId = jQuery("#emailId").val();
        var phoneNo = jQuery("#phoneNo").val();
        var pnLength = jQuery("#phoneNo").val().length;
        //var mesSage = jQuery("#mesSage").val();
      

    var is_error = '';

        if (fullName == "") {
            jQuery('#fullname_error').html('Please enter name');
      $("#fullName").addClass('is-invalid');
      $("#fullName").focus();
            is_error = 'yes';
        } else{
      $("#fullName").removeClass('is-invalid');
      $("#fullName").addClass('is-valid');     
    }

    if (emailId == "") {
            jQuery('#email_error').html('Please enter email id');
      $("#emailId").addClass('is-invalid');
      $("#emailId").focus();
            is_error = 'yes';
        } else if(emailId!=''){
    if(creg.test(emailId) == false){
      jQuery('#email_error').html('Please enter valid email id');
      $("#emailId").addClass('is-invalid');
      $("#emailId").focus();
      is_error = 'yes';
    }
          else{
      $("#emailId").removeClass('is-invalid');
      $("#emailId").addClass('is-valid');     
    }
      }     
    

if (phoneNo == "") {
            jQuery('#mobile_error').html('Please enter mobile');
      $("#phoneNo").addClass('is-invalid');

      $("#phoneNo").focus();
            is_error = 'yes';
        } else if(pnLength < 5){
        jQuery('#mobile_error').html('Length is short, minimum 5 digit required.');
        $("#phoneNo").addClass('is-invalid');
        $("#phoneNo").focus();
        is_error = 'yes';       
    } else{
      $("#phoneNo").removeClass('is-invalid');
      $("#phoneNo").addClass('is-valid');     
    }

    /* if (mesSage == "") {
            jQuery('#usrmsg_error').html('Please enter your requirement');
      $("#mesSage").addClass('is-invalid');
      $("#mesSage").focus();
            is_error = 'yes';
        } else{
      $("#mesSage").removeClass('is-invalid');
      $("#mesSage").addClass('is-valid');     
    } */

        if (is_error == '') {
            jQuery.ajax({
        type: 'post',
                url: 'inquiry-process.php',
                data: $('#inquiryForm').serialize(),

        beforeSend: function(){
          $("#form-fill-btn").addClass('d-none');
          $("#formspinner").removeClass('d-none');
     //$("#formspinner").show();
   },

   complete: function(){
     $("#form-fill-btn").removeClass('d-none');
     $("#formspinner").addClass('d-none');
     //$("#formspinner").hide();
   },
   

        success: function (response) {
          //console.log(response);

                    if (response == 'success') {
                        $(".inquiry_msg p").removeClass('field_error');
                        $(".inquiry_msg p").addClass('success-msg');

                        jQuery('.inquiry_msg p').html('Thank you for contacting us. IDGL Team will get in touch soon.');
                    
                        /* $("#fullName").removeClass('is-valid'); */
                        $("#mesSage").removeClass('is-valid');
                        $('#inquiryForm input').removeClass('is-valid');
                        $('#inquiryForm').trigger("reset");
                    }
                    else{
                      $(".inquiry_msg p").addClass('field_error');
                      jQuery('.inquiry_msg p').html('Somthing Wrong..!!!, Please try again.');
                      //window.location.href = window.location.href;

                    }

                }

            });

        }
                                

});

</script>
<?php include_once 'footer-bottom.php'; ?>