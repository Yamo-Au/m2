<?php

include_once('includes/header.php');
include_once('includes/functions.php');

if ( isset($_POST['button2']) )
{
   $_SESSION['bandwidth'] = $_POST['bandwidth'];
   if ( isset($_POST['telstra']) )
      $_SESSION['telstra'] = $_POST['telstra'];
   else
      $_SESSION['telstra'] = null;
   $_SESSION['data'] = $_POST['data'];
   
   if ( $_SESSION['type'] == 'ADSL2+' )
   {
      if ( $_SESSION['telstra'] == null || !telstra_number_valid( $_SESSION['telstra'] ) )
         header('Location: something-wrong.php');
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
   <title>YAMO | Contention</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="">
            <h1>Your Information
               <span>Please complete the fields below.</span>
            </h1>
            <label>
               <span>Name</span>
               <input type="text" name="name" placeholder="Your full name" />
            </label>
            
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
