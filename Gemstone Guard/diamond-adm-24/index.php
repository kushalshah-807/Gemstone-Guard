<?php include_once "db_connect.php";   ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $companyName; ?> - Admin</title>
    <link rel="shortcut icon" href="dist/img/logo.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script type="text/javascript" src="plugins/jQueryValidate/jquery.validate.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
    $("#supportLoginInformation").validate({
      rules: {
        userName: {
          required: true,
        },
        passWord: {
          required: true,
        }
      },
      messages: {
        userName: {
          required: "Please enter your username.",
        },
        passWord: {
          required: "Please enter your password.",
        }
      }
    });
 }); 
</script>
<style type="text/css">
 label.error{
  color:#cc0000;
 } 
</style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
      
        <a href="index.php"><img src="dist/img/logo.png" alt="<?php echo $companyName; ?>" title="<?php echo $companyName; ?>" style="width:350px" /></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form name="supportLoginInformation" id="supportLoginInformation" method="post" action="#" autocomplete="off">
         
          <div class="form-group has-feedback">
            <input type="text" name="userName" id="userName" class="form-control" placeholder="Username" title="Username" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="passWord" id="passWord" class="form-control" placeholder="Password" title="Password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8"></div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" name="log-in" id="submit" class="btn btn-primary btn-block btn-flat" value="Log me in" />
            </div><!-- /.col -->
          </div>
		  
		  <div id="output_msg" class="form-output">
                <p class="form-messege field_error"></p>
            </div>
        </form>
         
         <!--<a href="#">I forgot my password</a>-->
         
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });


 $(function () {

   $('#supportLoginInformation').on('submit', function (e) {

      e.preventDefault();

      var userName = document.getElementById('userName').value
      var passWord = document.getElementById('passWord').value      
      if(userName!='' && passWord!=''){
			//var button_content = $(this).find('button[type=submit]');
		//button_content.html('Adding...'); 
        $("#submit").attr({
            disabled: "true",
            value: "Loading..."
        });
        
		$.ajax({
            type: 'post',
            url: 'login-process.php',
            data: $('#supportLoginInformation').serialize(),
            success: function (response) {
               //console.log(response);			   
               if(response=="True")	{
                  //alert("LOGIN SUCCESSFULLY.");
                  window.location='dashboard.php';
               } else if(response=="False")	{
				   jQuery('#output_msg p').html('You Have Entered Wrong Combination.');                  
                  window.location='index.php';               	
               }
              
            },
            complete: function (data) {
               $("#submit").attr({
                  disabled: "false",
                  value: "Log me in"
               });
               
            }
                        
          });
      }
		
   });

});          
</script>	  
 
  </body>
</html>