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
   <title>YAMO | Customer Details</title>
</head>
<body>
   <div class="wrapper">
      <?php include_once('includes/top.php'); ?>
      <div id="mid">
         <form class="basic-grey" method="post" action="summary.php">
            <h1>Your Information
               <span>Please complete the fields below.</span>
            </h1>
            <label>
               <span>Name</span>
               <input type="text" name="name" placeholder="Your full name" />
            </label>
            <label>
               <span>Email</span>
               <input type="text" name="email" placeholder="Email address" />
            </label>
            <label>
               <span>Contact number</span>
               <input type="text" name="phone" placeholder="Contact phone number" />
            </label>
            <label>
               <span>Address</span>
               <input type="text" name="street1" placeholder="Street line 1" />
            </label>
            <label>
               <span>&nbsp;</span>
               <input type="text" name="street2" placeholder="Street line 2" />
            </label>
            <label>
               <span>&nbsp;</span>
               <input type="text" name="suburb" placeholder="Suburb" />
            </label>
            <label>
               <span>&nbsp;</span>
               <select name="state">
                  <option value="NSW">NSW</option>
                  <option value="ACT">ACT</option>
                  <option value="QLD">QLD</option>
                  <option value="NT">NT</option>
                  <option value="TAS">TAS</option>
                  <option value="WA">WA</option>
                  <option value="VIC">VIC</option>
                  <option value="SA">SA</option>
               </select>
            </label>
            <label>
               <span>&nbsp;</span>
               <input type="text" name="postcode" placeholder="Postcode" />
            </label>
            <div class="button-container">
               <button name="button3" class="button">Continue</button>
            </div>
         </div>
      </div>
      <?php include_once('includes/bottom.php'); ?>
   </div>
</body>
</html>
