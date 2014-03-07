<?php

// UPDATE TRIP POINTS
// this script gets a tripid
// and uses that to go get the trip information

include 'config.php';
include 'connect.php';

// print "starting updatetrip_points.sh \n";

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

// Things we want to get for each trip:
$fishpoints = $row['fishcaught'];
$adventure = $row['adventure'];
$scenic = $row['scenic'];
$ninja = $row['ninja'];
$newwater = $row['newwater'];

// Calculate the points		
include 'points.php';

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