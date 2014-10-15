<?php

include_once('includes/header.php');
include_once('includes/functions.php');

if ( isset($_POST['button3']) )
{
   if (!customer_details_valid($_POST))
      header('Location: something-wrong.php');
   else
   {
      $_SESSION['name']     = $_POST['name'];
      $_SESSION['email']    = $_POST['email'];
      $_SESSION['phone']    = $_POST['phone'];
      $_SESSION['street1']  = $_POST['street1'];
      $_SESSION['street2']  = $_POST['street2'];
      $_SESSION['suburb']   = $_POST['suburb'];
      $_SESSION['state']    = $_POST['state'];
      $_SESSION['postcode'] = $_POST['postcode'];
      
      $_SESSION['planId']   = find_plan_id(
                                 $_SESSION['type'], 
                                 $_SESSION['bandwidth'], 
                                 $_SESSION['data']
                              );
   }
}
else
{
   header('Location: index.php');
}

?>

<!doctype html>
<html>
<head>
   <?php include_once('includes/links.php'); ?>
   <title>YAMO | Summary</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="terms-and-conditions.php">
            <h1>Quote summary
               <span>Pleas find below the pricing of your service.</span>
            </h1>
            <?php print_summary($_SESSION); ?>
            <div class="button-container">
               <button name="button4" class="button">Continue</button>
               <p>Something not right? <a href="index.php">Click here</a> to start over.</p>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
