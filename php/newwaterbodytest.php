<?php

// NEW WATERBODY TEST
// this script looks to see if this water is in the waterbody table or not
	// if it isn't, it adds it

print "<br><b>------ newwaterbodytest.php -------</b><br>";
	$logthis = "\n -- starting newwaterbodytest.php --";
	fwrite($fh, $logthis);

// search the DB
$newwaterbodyquery = "SELECT name FROM waterbodies WHERE name LIKE '%$waterbody%' AND state like '$state'";
	$logthis = "\n newwaterbodyquery: $newwaterbodyquery";
	fwrite($fh, $logthis);
	
$newwaterbodyresult = mysql_query($newwaterbodyquery);
$newwaterbodyresult_count = mysql_num_rows($newwaterbodyresult);

print "<br>the newwaterbody query is <pre>$newwaterbodyquery</pre> ";
	$logthis = "\n newwaterbodyresult_count: $newwaterbodyresult_count";
	fwrite($fh, $logthis);
	
print "<br>newwaterresult is $newwaterbodyresult_count<br>";

if ($newwaterbodyresult_count > 0 )
	{
	print "the waterbody $waterbody is in the DB! (this is not a new waterbody)<br>";
	$logthis = "\n the waterbody $waterbody is in the DB! (this is not a new waterbody)";
	fwrite($fh, $logthis);
	
	$isnewwaterbody = 0;
	}
else
	{
		print "this is a new waterbody! adding it to the waterbodies table...<br>";
		$logthis = "\n this is a new waterbody! adding it to the waterbodies table...";
		fwrite($fh, $logthis);
		
		$isnewwaterbody = 1;
		// add it to the DB
		$creator = $username;
		$insertwaterbodyquery = "INSERT INTO waterbodies (name, watertype, lat, lon, latlon, city, county, state, creator, zip) 
							VALUES ('$waterbody', '$watertype', '$lat', '$lon', '$latlon', '$city', '$county', '$state', '$creator', '$zip')";
		print "this query is: <pre>$insertwaterbodyquery</pre>";
		$logthis = "\n adding a new row to the waterbodies table: $inserwaterbodyquery";
		fwrite($fh, $logthis);
						
			// Tell us the results
			if (!mysql_query($insertwaterbodyquery,$con))
			  {
			  die('Error: ' . mysql_error());		
			  	$logthis = "\n SQL error: " . mysql_error();
				fwrite($fh, $logthis);					// error message
				}
	}
	
print "<br><b> this is at the end of newwaterbodytest.php</b>";
		$logthis = "\n -- end of newwaterbodytest.php";
		fwrite($fh, $logthis);
	
?>