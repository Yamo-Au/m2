<?php

include_once('includes/header.php');
include_once('includes/functions.php');

if ( !isset($_POST['button4']) )
{
   header('Location: index.php');
}

?>

<!doctype html>
<html>
<head>
   <?php include_once('includes/links.php'); ?>
   <title>YAMO | Terms and Conditions</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="operations.php">
            <h1>Terms and conditions
               <span>Review the terms and conditions below..</span>
            </h1>
            <?php include_once('includes/terms.php'); ?>
            <div class="button-container">
               <div><span>I accept the terms and conditions</span>
               <input type="checkbox" name="accept" /></div>
               <button name="button5" class="button">Continue</button>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
