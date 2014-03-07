<?php

// NEW WATERBODY TEST
// this script looks to see if this water is in the waterbody table or not
	// if it isn't, it adds it

print "<br><b>------ newwaterbodytest.php -------</b><br>";

// search the DB
$newwaterbodyquery = "SELECT name FROM waterbodies WHERE name LIKE '%$waterbody%' AND state like '$state'";
$newwaterbodyresult = mysql_query($newwaterbodyquery);
$newwaterbodyresult_count = mysql_num_rows($newwaterbodyresult);

print "<br>the newwaterbody query is <pre>$newwaterbodyquery</pre> ";
print "<br>newwaterresult is $newwaterbodyresult_count<br>";

if ($newwaterbodyresult_count > 0 )
	{
	print "the waterbody $waterbody is in the DB! (this is not a new waterbody)<br>";
	$isnewwaterbody = 0;
	}
else
	{
		print "this is a new waterbody! adding it to the waterbodies table...<br>";
		$isnewwaterbody = 1;
		// add it to the DB
		$creator = $username;
		$insertwaterbodyquery = "INSERT INTO waterbodies (name, watertype, lat, lon, latlon, city, county, state, creator, zip) 
							VALUES ('$waterbody', '$watertype', '$lat', '$lon', '$latlon', '$city', '$county', '$state', '$creator', '$zip')";
		print "this query is: <pre>$insertwaterbodyquery</pre>";
						
			// Tell us the results
			if (!mysql_query($insertwaterbodyquery,$con))
			  {
			  die('Error: ' . mysql_error());							// error message
				}
	}
	
print "<br><b> this is at the end of newwaterbodytest.php</b>";
	
?>