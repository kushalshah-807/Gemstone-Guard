<?php 
	include "db_connect.php";

   include 'phpqrcode/qrlib.php';

    $url="Knowband.com";
   $data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
//echo $data;

   $text = "URL:http://beauxart.in/Diamond/certificate.pdf";
   QRcode::png($text);
       // $path variable store the location where to 
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = $qrcodeImg.'/';
$qrfileName = $lastInsertId."-".$randomNo."-qr.png";
$file = $path.$qrfileName;
  
// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
  
// Generates QR Code and Stores it in directory given
//QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);
?>