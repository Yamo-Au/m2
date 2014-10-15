<?php

require_once('includes/header.php');
require_once('includes/functions.php');

if ( isset($_POST['submit']) )
{
   load_plans_from_file( $_POST['filename'] );
}

?>

<!doctype html>
<html>
<head>
</head>
<body>
   <h1>Load DB From File</h1>
   <form method="post">
      <label>Filename
         <input name="filename" type="text" />
      </label>
      <input type="submit" value="LOAD" name="submit" />
   </form>
</body>
</html>
