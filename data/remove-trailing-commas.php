<?php

$infile = 'm2-plans - Sheet1.csv';

$lines = file($infile);

$outlines = array();

$search = '$';

foreach ($lines as $line)
{
   $line = str_replace($search, '', $line);
   $line = substr($line, 0, -2);
   array_push($outlines, $line);
}

foreach ($outlines as $line) {
   echo $line;
   file_put_contents('foo.txt', $line . "\n", FILE_APPEND);
}

echo 'yay!';

?>
