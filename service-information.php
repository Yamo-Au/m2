<?php

include_once('includes/header.php');
include_once('includes/functions.php');

if ( isset($_POST['button1']) )
{
   $_SESSION['type'] = $_POST['type'];
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
   <title>YAMO | Service Information</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="customer-details.php">
            <h1>Service Information
               <span>Please complete the fields below.</span>
            </h1>
            <label>
               <span>Bandwidth</span>
               <?php bandwidths_to_dropdown( $_SESSION['type'] ); ?>
            </label>
            <?php if ( $_SESSION['type'] == 'ADSL2+' ) { ?>
               <label>
                  <span>Telstra number</span>
                  <input name="telstra" type="text" placeholder="Active Telstra number" />
               </label>
            <?php } ?>
            <label>
               <span>Data allowance</span>
               <?php datas_to_dropdown( $_SESSION['type'] ) ?>
            </label>
            <div class="button-container">
               <button name="button2" class="button">Continue</button>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
