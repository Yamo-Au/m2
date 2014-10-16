<?php

session_start();

define('DB_NAME', 'wamo_m2');
define('DB_USER', 'wamo_m2-user');
define('DB_PASS', '66<hb2{157C/Ghw');
define('DB_HOST', 'yamo.com.au');

define('MINIMUM_CONTRACT_TERM' , '24 months');

define('ORDER_NUM_LEN', 7);

define('FORM_DIR', 'forms/');
define('DD_FORM_FILE', 'yamo-dd.pdf');
define('AGREEMENT_FILE', 'agreement.pdf');
define('WAIVER_FILE', 'waiver.pdf');

define('SALES_EMAIL', 'sales@yamo.com.au');
define('SALES_FROM_NAME', 'Yamo Sales Team');

include_once('plugins/PHPMailer/PHPMailerAutoload.php');

?>
