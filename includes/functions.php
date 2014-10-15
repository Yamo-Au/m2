<?php

function db_connect()
{
   $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
   
   if (mysqli_connect_errno())
   {
      die( "Failed to connect to MySQL: " . mysqli_connect_error() );
   }
   
   mysqli_select_db($con, DB_NAME);
   
   return $con;
}

function db_close($con)
{
   mysqli_close($con);
}

function add_customer($name, $street1, $street2, $city, $state, $postcode, $email, $phone)
{
   $con = db_connect();
   
   /*
   $name = mysqli_real_escape_string($name);
   $street1 = mysqli_real_escape_string($street1);
   $street2 = mysqli_real_escape_string($street2);
   $city = mysqli_real_escape_string($city);
   $state = mysqli_real_escape_string($state);
   $postcode = mysqli_real_escape_string($postcode);
   $email = mysqli_real_escape_string($email);
   $phone = mysqli_real_escape_string($phone);
   */
   
   $query = "INSERT INTO Customers(customerName, customerStreet1, customerStreet2, 
      customerCity, customerState, customerPostcode, customerEmail, customerPhone)
      VALUES ('$name', '$street1', '$street2', '$city', '$state', '$postcode', '$email', '$phone')";
   mysqli_query($con, $query);
   
   db_close($con);
}

function get_all_customers()
{
   $con = db_connect();
   
   $query = "SELECT * FROM Customers";
   
   $result = mysqli_query($con, $query);
   
   if (!$result)
      return $result;
      
   $customers = array();
   
   while ($row = mysqli_fetch_object($result))
   {
      $cust['id'] = $row->customerId;
      $cust['name'] = $row->customerName;
      $cust['street1'] = $row->customerStreet1;
      $cust['street2'] = $row->customerStreet2;
      $cust['suburb'] = $row->customerCity;
      $cust['state'] = $row->customerState;
      $cust['postcode'] = $row->customerPostcode;
      $cust['email'] = $row->customerEmail;
      $cust['phone'] = $row->customerPhone;
      
      array_push($customers, $cust);
   }
   
   return $customers;
}

function get_latest_customer_id()
{
   $customers = get_all_customers();
   $highest = 0;
   
   foreach ($customers as $customer)
   {
      $intId = intval($customer['id']);
      if ($intId > $highest)
         $highest == $intId;
   }
   
   return strval($intId);
}

function add_order($orderDate, $planId, $customerId, $telstraNumber)
{
   $con = db_connect();
   
   /*
   $orderDate = mysqli_real_escape_string($orderDate);
   $planId = mysqli_real_escape_string($planId);
   $customerId = mysqli_real_escape_string($customerId);
   $telstraNumber = mysqli_real_escape_string($telstraNumber);
   */
   
   $query = "INSERT INTO Orders(orderDate, planId, customerId, telstraNumber)
      VALUES ('$orderDate', $planId, $customerId, '$telstraNumber')";
   mysqli_query($con, $query);
   
   $query = "SELECT customerName, customerEmail FROM Customers 
      WHERE customerId = $customerId";
   $result = mysqli_query($con, $query);
   $customerRow = mysqli_fetch_object($result);
   
   $customerName  = $customerRow->customerName;
   $customerEmail = $customerRow->customerEmail;
   
   $query = "SELECT planType, planBandwidth, planData, planInstallationFee, planMonthlyFee 
      FROM Plans 
      WHERE planId = $planId";
   $result = mysqli_query($con, $query);
   $planRow = mysqli_fetch_object($result);
   
   $plan['type']         = $planRow->planType;
   $plan['bandwidth']    = $planRow->planBandwidth;
   $plan['data']         = $planRow->planData;
   $plan['installation'] = $planRow->planInstallationFee;
   $plan['monthly']      = $planRow->planMonthlyFee;
   
   $orderId = get_latest_order_id();
   $orderNumber = generate_order_number($orderId);
   
   email_customer($customerEmail, $customerName, $plan, $orderNumber);
   
   db_close($con);
}

function get_all_orders()
{
   $con = db_connect();
   
   $query = "SELECT * FROM Orders";
   
   $result = mysqli_query($con, $query);
   
   if (!$result)
      return $result;
      
   $orders = array();
   
   while ($row = mysqli_fetch_object($result))
   {
      $ord['id']         = $row->orderId;
      $ord['date']       = $row->orderDate;
      $ord['planId']     = $row->planId;
      $ord['customerId'] = $row->customerId;
      $ord['telstra']    = $row->telstraNumber;
      
      array_push($orders, $ord);
   }
   
   return $orders;
}

function get_latest_order_id()
{
   $orders = get_all_orders();
   $highest = 0;
   
   foreach ($orders as $order)
   {
      $intId = intval($order['id']);
      if ($intId > $highest)
         $highest == $intId;
   }
   
   return strval($intId);
}

function add_plan($planSupplier, $planType, $planProvider, $planBandwidth, $planData, $planInstallationFee, $planMonthlyFee)
{
   $con   = db_connect();
   
   $query = "INSERT INTO Plans(planSupplier, planType, planProvider, planBandwidth, planData, planInstallationFee, planMonthlyFee)
      VALUES ('$planSupplier', '$planType', '$planProvider', '$planBandwidth', '$planData', $planInstallationFee, $planMonthlyFee)";
   mysqli_query($con, $query);
   
   db_close($con);
}

function get_all_plans()
{
   $con = db_connect();
   
   $query = "SELECT * FROM Plans";
   $result = mysqli_query($con, $query);
   
   if (!$result) return $result;
   
   $plans = array();
   
   while ( $row = mysqli_fetch_object($result) )
   {
      $plan['id']           = $row->planId;
      $plan['supplier']     = $row->planSupplier;
      $plan['type']         = $row->planType;
      $plan['provider']     = $row->planProvider;
      $plan['bandwidth']    = $row->planBandwidth;
      $plan['data']         = $row->planData;
      $plan['installation'] = $row->planInstallationFee;
      $plan['monthly']      = $row->planMonthlyFee;
      
      array_push($plans, $plan);
   }   
   
   return $plans;
}

function get_plan($planId)
{
   $con    = db_connect();
   
   $query  = "SELECT * FROM Plans WHERE planId = $planId;";
   $result = mysqli_query($con, $query);
   
   if (!$result) return $result;
   
   $row    = mysqli_fetch_object($result);
   
   $plan['id']           = $planId;
   $plan['supplier']     = $row->planSupplier;
   $plan['type']         = $row->planType;
   $plan['provider']     = $row->planProvider;
   $plan['bandwidth']    = $row->planBandwidth;
   $plan['data']         = $row->planData;
   $plan['installation'] = $row->planInstallationFee;
   $plan['monthly']      = $row->planMonthlyFee;
   
   return $plan;
}

function find_plan_id($type, $bandwidth, $data)
{
   $plans = get_all_plans();
   $results = array();
   
   foreach ($plans as $plan)
   {
      if ( $plan['type'] == $type && $plan['bandwidth'] == $bandwidth && $plan['data'] == lcfirst($data) )
         return $plan['id'];
   }
}

function plan_types_to_dropdown()
{
   $planTypes = array();
   $plans = get_all_plans();
   
   foreach ($plans as $plan)
   {
      if (!in_array($plan['type'], $planTypes))
         array_push($planTypes, $plan['type']);
   }
   
   echo '<select name="type">';
   foreach ($planTypes as $planType)
   {
      echo '<option value="' . $planType . '">' . ucfirst($planType) . '</option>';
   }
   echo '</select>';
}

function load_plans_from_file($filename)
{
   $lines = file($filename);
   
   if (!$lines) die('Could not open file.');
   
   foreach($lines as $line)
   {
      $attrs = explode(',', $line);
      add_plan( $attrs[0], $attrs[1], $attrs[2], $attrs[3], $attrs[4], $attrs[5], $attrs[6] );
      foreach ($attrs as $a)
      {
         echo 'Added: ' . $a . '<br>';
      }
   }
}

function bandwidths_to_dropdown($planType)
{
   $bandwidths = array();
   
   $plans = get_all_plans();
   
   foreach ($plans as $plan)
   {
      if ($plan['type'] == $planType && !in_array($plan['bandwidth'], $bandwidths))
         array_push($bandwidths, $plan['bandwidth']);
   }
   
   echo '<select name="bandwidth">';
   foreach ($bandwidths as $bandwidth)
   {
      echo '<option value="' . $bandwidth . '">' . $bandwidth . ' mbps</option>';
   }
   echo '</select>';
}

function datas_to_dropdown($planType)
{
   $datas = array();
   
   $plans = get_all_plans();
   
   foreach ($plans as $plan)
   {
      if ($plan['type'] == $planType && !in_array($plan['data'], $datas))
         array_push($datas, $plan['data']);
   }
   
   echo '<select name="data">';
   foreach ($datas as $data)
   {
      if ($data == 'unlimited')
         $data = ucfirst($data);
      $outstring = '<option value="' . $data . '">' . $data;
      if ($data != 'Unlimited')
         $outstring .= ' GB';
      $outstring .= '</option>';
      echo $outstring;
   }
   echo '</select>';
}

function email_customer($email, $name, $planInfo, $orderNumber)
{
   $data = '';
   
   if ($planInfo['data'] != 'unlimited')
   {
      $data = $planInfo['data'] . ' GB per month';
   }
   else
   {
      $data = ucfirst( $planInfo['data'] );
   }
   
   $mail = new PHPMailer;
   
   $mail->ContentType = 'text/html';
   $mail->CharSet     = 'UTF-8';
   
   $mail->From        = SALES_EMAIL;
   $mail->FromName    = SALES_FROM_NAME;
   $mail->AddAddress($email, $name);
   
   $mail->isHTML(true);
   
   $mail->Subject = 'ACTION REQUIRED: Order ' . $orderNumber;
   $mail->Body    = "<html><body>
                     <h1>Almost there, $name!</h1>
                     <p>Before we can process your order, please print, complete, sign,
                     scan and email the attached direct debit form to 
                     <a href='mailto: sales@yamo.com.au'>sales@yamo.com.au</a>.
                     <br>Done this already? No problems. A member of our sales team will contact you shortly.</p>
                     <p>Please find below a summary of your order.</p>
                     <table>
                     <tr style='background-color:#eee;'><td style='font-weight:bold;'>Service type</td><td>" . $planInfo['type'] . "</td></tr>
                     <tr><td style='font-weight:bold;'>Download/upload speed</td><td>" . $planInfo['bandwidth'] . " mbps</td></tr>
                     <tr style='background-color:#eee;'><td style='font-weight:bold;'>Data allowance</td><td>" . $data . "</td></tr>
                     <tr><td style='font-weight:bold;'>Installation fee</td><td>$" . $planInfo['installation'] . "</td></tr>
                     <tr style='background-color:#eee;'><td style='font-weight:bold;'>Monthly fee</td><td>$" . $planInfo['monthly'] . " per month</td></tr>
                     <tr><td style='font-weight:bold;'>Minimum contract term</td><td>" . MINIMUM_CONTRACT_TERM . "</td></tr>
                     </table>
                     <p>For your convenience, a copy of the waiver and terms and conditions have been provided.
                     <br>Thank you for choosing Yamo, the specialists in IP telephony and cloud computing.</p>
                     <p>Kind regards,
                     <br>Yamo Sales Team</p>
                     </body></html>";
                     
   $mail->AddAttachment(FORM_DIR . DD_FORM_FILE);
   $mail->AddAttachment(FORM_DIR . AGREEMENT_FILE);
   $mail->AddAttachment(FORM_DIR . WAIVER_FILE);
                     
   $mail->Send();
}

function telstra_number_valid($number)
{
   $re = '/^0[2378](\s)?\d{4}(\s)?\d{4}$/';
   return preg_match($re, $number);
}

function customer_details_valid($details)
{
   foreach($details as $key=>$value)
   {
      if ($key != 'street2' && $key != 'button3' && $value == '')
         return false;
   }
   return true;
}

function print_summary($session_data)
{
   $planId = find_plan_id( $session_data['type'], $session_data['bandwidth'], $session_data['data'] );
   $plan = get_plan($planId);

   echo '<table>';
   
   echo '<tr><td>Service type</td><td>' . $session_data['type'] . '</td></tr>';
   echo '<tr><td>Download/upload speed</td><td>' . $session_data['bandwidth'] . ' mbps</td></tr>';
   if ( $session_data['type'] == 'ADSL2+' )
      echo '<tr><td>Telstra number</td><td>' . $session_data['telstra'] . '</td></tr>';
   echo '<tr><td>Data allowance</td><td>' . $session_data['data'] . ' GB/month</td></tr>';
   echo '<tr><td>Installation fee</td><td>$' . $plan['installation'] . '</td></tr>';
   echo '<tr><td>Monthly fee</td><td>$' . $plan['monthly'] . ' per month</td></tr>';
   echo '<tr><td>Minimum contract</td><td>' . MINIMUM_CONTRACT_TERM . '</td></tr>';
   echo '<tr><td>Name</td><td>' . $session_data['name'] . '</td></tr>';
   echo '<tr><td>Email</td><td>' . $session_data['email'] . '</td></tr>';
   echo '<tr><td>Phone</td><td>' . $session_data['phone'] . '</td></tr>';
   echo '<tr><td>Street line 1</td><td>' . $session_data['street1'] . '</td></tr>';
   if ($session_data['street2'] != '' )
      echo '<tr><td>Street line 2</td><td>' . $session_data['street2'] . '</td></tr>';
   echo '<tr><td>Suburb</td><td>' . $session_data['suburb'] . '</td></tr>';
   echo '<tr><td>State</td><td>' . $session_data['state'] . '</td></tr>';
   echo '<tr><td>Postcode</td><td>' . $session_data['postcode'] . '</td></tr>';
   
   echo '</table>';
}

function generate_order_number($orderId)
{
   for($i = 0; $i < ORDER_NUM_LEN; $i++)
   {
      $orderId = '0' . $orderId;
   }
   
   return $orderId;
}
   
?>
