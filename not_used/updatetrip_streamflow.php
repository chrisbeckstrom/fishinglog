<?php

// UPDATE TRIP STREAMFLOW
// this script gets a trip number
// and uses that to go get the streamflow information

include 'config/config.php';
include 'config/connect.php';

print "starting updatetrip_points.sh \n";


print "looking for an argument to use as a tripid \n";

// FOR USE AS COMMAND LINE
if (isset($argv[1])) 		// if there is a command line argument
	{
	print "argv 1 is $argv[1]";
	$tripid = $argv[1];
	}
	else
	{
	print "give us a tripid as an argument! quitting";
	}

print "going to the DB to get info about that tripid \n";

// go to the DB and get info about that tripnumber
$result = mysql_query("
SELECT *
FROM trips
WHERE tripid = $tripid
		");
//	}
	
// take the data and put it into an array
$row = mysql_fetch_array($result);

print "getting info from the query \n";

// Things we want to show for each trip:
$date = $row['date'];
$city = $row['city'];
$waterbody = $row['waterbody'];
$lat = $row['lat'];
$lon = $row['lon'];
$latlon = $row['latlon'];
$zip = $row['zip'];
$waterbody = $row['waterbody'];
$tripdate = $date;

// Calculate the points
include 'php/points.php';



print "putting the stuff we found into the DB \n";
// ADD THE POINTS TO THE DB
	$query = "
	UPDATE trips
	SET points = $points
		WHERE tripid = $tripid
	";


print "the query is: <pre>$query</pre>";
mysql_query($query)

	or die(mysql_error()); 