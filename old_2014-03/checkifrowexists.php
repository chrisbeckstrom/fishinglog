<?php

include 'config.php';
include 'connect.php';
include 'header.php';
include 'footer.php';

// name to check
$name = 'Happy';

function checkifwaterbodyexists($name)
{
$result = mysql_query("
SELECT name 
FROM waterbodies 
WHERE name 
LIKE '%$name%'
LIMIT 1
");

$num_rows = mysql_num_rows($result);

	if ($num_rows > 0) 
	{
	  print "Found at least one $name in the DB!<br>";
	  $exists = 1;
	}
	else {
	  print "Didn't find any $name. good to go!<br>";
	  $exists = 0;
	}
	
	return $exists;
	
	}
