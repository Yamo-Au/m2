<?php 

require_once('includes/header.php');
require_once('includes/functions.php');   

if ( !isset($_SESSION['finished']) )
{
   header('index.php');
}

?>

<!doctype html>
<html>
<head>
   <?php include_once('includes/links.php'); ?>
   <title>YAMO | Thankyou</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <div class="content">
            <div class="thankyou">
               <h1>Thank you, <?php echo $_SESSION['name']; ?>.</h1>
               <p><br><strong>Please note that action is required to complete your order.</strong><br>
               Before we can process your order, please print, complete, sign, scan and email the direct debit form to
                <a href='mailto: sales@yamo.com.au'>sales@yamo.com.au</a>.
               </p><br>
               <p>You can download a copy of the form <a target="_blank" href="<?php echo FORM_DIR . DD_FORM_FILE ?>" >here</a>.<br>
               An email has also been sent to you outlining the remaining steps.</p>
               <p><br>We look forward to hearing from you soon.</p>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
