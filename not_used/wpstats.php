<?php

// DB information
$DBurl 		= 'mysql.cbfishes.com';
$DBuser 	= 'cbfishescom';
$DBpass		= '6thZcnd!';
$DBdb 		= 'fishingtrips';
$username 	= 'cbfishes';

// CONNECT TO THE SERVER
$con = mysql_connect($DBurl,$DBuser,$DBpass);
if (!$con)
  {
  die("<div id = 'debug'>Oops, could not connect:"  . mysql_error()) . "</div>";	// error message
  }
  
// Choose the database
	mysql_select_db($DBdb, $con);

// get the number of TRIPS this year
	$tripsthisyearquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username' AND date >= '2013-01-01';
		");
	// put into an array	
	$tripsthisyeararray = mysql_fetch_array($tripsthisyearquery);
	
	// save that into a variable
	$tripsthisyear = $tripsthisyeararray['COUNT(*)'];
	
// get the number of FISH CAUGHT this year
	$fishcaughtquery = mysql_query("
	SELECT SUM(fishcaught) FROM trips WHERE USERNAME = '$username' AND date >= '2013-01-01';
		");
	// put into an array	
	$fishcaughtarray = mysql_fetch_array($fishcaughtquery);
	
	// save that into a variable
	$fishcaught = $fishcaughtarray['SUM(fishcaught)'];

echo "fish caught: $fishcaught<br>";
echo "trips: $tripsthisyear<br>";

?>