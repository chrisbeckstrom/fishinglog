<?php

// UPDATE TRIP WEATHER
// this script gets a trip number
// and uses that to go get the weather information

include 'config/config.php';
include 'config/connect.php';


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


// connect to DB and go get all the trips that have ZIPCODES and DATES
$query = "select tripid,date from trips where zip != '' AND date != ''";


// go to the DB and get info about that tripnumber
$result = mysql_query("
SELECT *
FROM trips
WHERE tripid = $tripid
		");
//	}
	
// take the data and put it into an array
$row = mysql_fetch_array($result);

// Things we want to show for each trip:
$date = $row['date'];
$zip = $row['zip'];
$timeofday = $row['timeofday'];
$lat = $row['lat'];

if ( $lat == '' )
	{
	print "no coordinates found! stopping script";
	exit;
	}
	


// tell us what we're working with
print "tripid = $tripid <br>
		date = $date <br>
		zip = $zip <br>
		timeofday = $timeofday";

		
include 'php/getweather_new.php';

// PUT THE STUFF INTO THE DATABASE
	$query = "
	UPDATE trips
	SET temp = '$temp',
		hum = '$hum',
		wspdi = '$wspdi',
		wgusti = '$wgusti',
		wdir = '$wdir',
		pressure = $pressure,
		conds = '$conds',
		metar = '$metar'
		WHERE tripid = $tripid
		";
		
print "the query is: <pre>$query</pre>";
mysql_query($query)

	or die(mysql_error()); 
