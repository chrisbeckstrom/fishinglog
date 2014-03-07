<?php

/* CHECK WATERBODY

Takes input (waterbody name) and looks in the DB
to see if there is already a waterbody with that
name.		

*/

include 'config/config.php';
include 'config/connect.php';

// fake user input
$name = 'lake';

print "<BR> <b> Checking if that waterbody already exists in the DB...</b><BR>";

$result = mysql_query("
	SELECT name, city, state
	FROM waterbodies
	WHERE name
	LIKE '%$name%'
	");
	
if(mysql_num_rows($result)==0)
	{
	// if there are no results
	print "No results found<br>";
	}
	else
	{
	// if there ARE results
	print "Found results for <i>$name!</i><BR>
			";
	

// show us the results
	while($row = mysql_fetch_array($result))
		{
		print $row['name'] . " in " . $row['city'] . ", " . $row['state'] . "<br>";
		}
	
	
	
	
	
	}

