<?php

include_once('includes/header.php');
include_once('includes/functions.php');

if ( !isset($_POST['button5']) )
{
   header('Location: index.php');
}

if ( !isset($_POST['accept']) )
   header('Location: something-wrong.php');
else
{
   add_customer
   (
      $_SESSION['name'], 
      $_SESSION['street1'], 
      $_SESSION['street2'], 
      $_SESSION['suburb'], 
      $_SESSION['state'], 
      $_SESSION['postcode'],
      $_SESSION['email'], 
      $_SESSION['phone']
   );
   add_order
   (
      date('Y-m-d'),
      $_SESSION['planId'],
      get_latest_customer_id(),
      $_SESSION['telstra']
   );
   
   $_SESSION['finished'] = 1;
   header('Location: thankyou.php');
}

?>
