<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

@session_start();
ob_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u736653896_hmntshh');
define('DB_PASSWORD', 'uRNf3gV#7');
define('DB_DATABASE', 'u736653896_diamondgem');
$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
//$con = mysqli_connect("localhost", "root", "", "idgl_diamond");


function check_input($con, $data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  $data = mysqli_real_escape_string($con, $data);
  return $data;
}

function check_textinput($con, $data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($con, $data);
  return $data;
}

function random_generator($length) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function random_generator1($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}


function my_simple_crypt( $string, $action = 'e' ){
    // you may change these values to your own
    $secret_key = '2000';
    $secret_iv = '9876';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}


function getRealIpAddr(){
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
$ip=getRealIpAddr();

function getCurrentURL(){
    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentURL .= $_SERVER["SERVER_NAME"];
 
    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
    {
        $currentURL .= ":".$_SERVER["SERVER_PORT"];
    } 
 
    $currentURL .= $_SERVER["REQUEST_URI"];
    return $currentURL;
}

$crtUrl=getCurrentURL();


$companyName="International D&G Lab.";
$cmpsortName="IDGL";

$smEmailid="idglinternationallab@gmail.com";
$smName="IDGL";


$currentDir    = 'https://idgllabs.com/';
//currentDir    = 'https://beauxart.in/IDGL-2/';


$qrcodeImg="qr-img";
$certiPdf="certi-pdf";
$uploads="uploads";

$navlImg="img/image-not-available.png";


$prefixTbl="dgl_";
$admsptTbl=$prefixTbl."adm_support";

$certificateTbl=$prefixTbl."certificate";
$variationTbl=$prefixTbl."variation";
$variationtpTbl=$prefixTbl."variation_type";

$certishapeTbl=$prefixTbl."certi_shape";
$certicolorTbl=$prefixTbl."certi_color";
$certiclarityTbl=$prefixTbl."certi_clarity";

$customerTbl=$prefixTbl."customer";
$cntusTbl=$prefixTbl."contact_us";


date_default_timezone_set("Asia/Kolkata");

include_once "functions.php";
?>