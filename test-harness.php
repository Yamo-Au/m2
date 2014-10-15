<?php

require_once( 'includes/header.php' );

define('ORDER_NUM_LEN', 7);

function generate_order_number($orderId)
{
   for($i = 0; $i < ORDER_NUM_LEN; $i++)
   {
      $orderId = '0' . $orderId;
   }
   
   return $orderId;
}

$orderId = '1';

echo generate_order_number($orderId);


?>
