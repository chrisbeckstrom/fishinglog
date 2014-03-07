<?php

// USER STATS
// a quick way to get a user's stats and stick it anywhere (like a box)
print "<h2>Stats</h2>";
$username = $_GET['username'];

// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	//print "no user logged in";
	}
	
// get the total # of trips in the DB by that user
	$countquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username';
		");
	// put into an array	
	$tripcountarray = mysql_fetch_array($countquery);
	
	// save that into a variable
	$tripcount = $tripcountarray['COUNT(*)'];
	
// get the number of TRIPS this year
	$tripsthisyearquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username' AND date >= '2014-01-01';
		");
	// put into an array	
	$tripsthisyeararray = mysql_fetch_array($tripsthisyearquery);
	
	// save that into a variable
	$tripsthisyear = $tripsthisyeararray['COUNT(*)'];
	
	
// get the number of FISH CAUGHT this year
	$fishcaughtquery = mysql_query("
	SELECT SUM(fishcaught) FROM trips WHERE USERNAME = '$username' AND date >= '2014-01-01';
		");
	// put into an array	
	$fishcaughtarray = mysql_fetch_array($fishcaughtquery);
	
	// save that into a variable
	$fishcaught = $fishcaughtarray['SUM(fishcaught)'];
	
// get the number of FLY TRIPS this year
	$flytripsthisyearquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username' AND date >= '2014-01-01' AND GEAR = 'fly';
		");
	// put into an array	
	$flytripsthisyeararray = mysql_fetch_array($flytripsthisyearquery);
	
	// save that into a variable
	$flytripsthisyear = $flytripsthisyeararray['COUNT(*)'];
	
// get the number of spin trips this year
	$spintripsthisyearquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username' AND date >= '2014-01-01' AND GEAR = 'spin';
		");
	// put into an array	
	$spintripsthisyeararray = mysql_fetch_array($spintripsthisyearquery);
	
	// save that into a variable
	$spintripsthisyear = $spintripsthisyeararray['COUNT(*)'];
	
// get the number of fly/spin trips this year
	$bothtripsthisyearquery = mysql_query("
	SELECT COUNT(*) FROM trips WHERE USERNAME = '$username' AND date >= '2014-01-01' AND GEAR = 'fly and spin' OR GEAR = 'both';
		");
	// put into an array	
	$bothtripsthisyeararray = mysql_fetch_array($bothtripsthisyearquery);
	
	// save that into a variable
	$bothtripsthisyear = $bothtripsthisyeararray['COUNT(*)'];

// get the total # of hours (trips.time) fished by that user THIS YEAR
// *** SHOULD CHANGE THE YEAR TO AUTO-UPDATE BASED ON THE YEAR ***
	$thisyeartimequery = mysql_query("
	SELECT SUM(time) 
	FROM trips 
	WHERE username = '$username'
	AND date >= '2014-01-01';
		");
	$thisyeartimearray = mysql_fetch_array($thisyeartimequery);	
	$thisyeartimefished = $thisyeartimearray['SUM(time)'];

// get info about TRIPS
	$tripsquery = mysql_query("
	SELECT * 
	FROM trips 
	WHERE USERNAME = '$username'
	ORDER BY date DESC
		");	

	$triparray = mysql_fetch_array($tripsquery);

// get info about the USER
	$userquery = mysql_query("
	SELECT *
	FROM users
	WHERE USERNAME = '$username'
		");
		
	$userarray = mysql_fetch_array($userquery);

// these are things we take from the DB

$tripdate = $triparray['date'];
$tripid = $triparray['tripid'];
$public = $row['public'];
$userid = $row['userid'];
$userrealname = $row['userrealname'];

$lastupdate = $row['timestamp'];
$useravatarurl = $userarray['useravatarurl'];

print "
		<h4>This year</h4>
		trips:  $tripsthisyear  ($thisyeartimefished hours)<BR>
		fish caught: $fishcaught <br>
		fly trips: $flytripsthisyear <br>
		spin trips: $spintripsthisyear <br>
		fly+spin trips: $bothtripsthisyear";
		
print "<h4> All time </h4>
		Total trips: $tripcount ($timefished hours)";


