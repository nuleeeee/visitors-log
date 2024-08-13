<?php

include('library/php_qr_code/qrlib.php');
include "php/session.php";

$visitors_pass = $_POST['visitors_pass'];

$uid = $visitors_pass.'.png';
 
$errorCorrectionLevel = 'H';

$matrixPointSize = 10;

$frm_link = $visitors_pass;

// Generate and output the QR code image directly to the browser
QRcode::png($frm_link, $uid, $errorCorrectionLevel, $matrixPointSize, 2);

