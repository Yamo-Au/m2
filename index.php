<?php

include_once('includes/header.php');
include_once('includes/functions.php');

?>

<!doctype html>
<html>
<head>
   <?php include_once('includes/links.php'); ?>
   <title>YAMO | Service Type</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="service-information.php">
            <h1>Service
               <span>Please select the type of service that you desire.</span>
            </h1>
            <label>
               <span>Service</span>
               <?php plan_types_to_dropdown(); ?>
            </label>
            <div class="button-container">
               <button name="button1" class="button">Continue</button>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
