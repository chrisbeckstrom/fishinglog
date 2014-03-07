<?php

/*
This is the SPOTS page
copied and pasted from WATERBODIES page

*/

// get the trip_id from GET.. otherwise...


$pagetitle = "Spots";

include 'header.php';
include 'footer.php';
include 'config/connect.php';

print $header;

print "<div id = 'wrap'>";

// go get the distinct waterbodies

	
		
$username = $_SESSION['myusername'];

// 2 variations of search depending on who's logged in			
// if the MYUSERNAME is not set, redirect to the login page
if(isset($_SESSION['myusername']))
	{
	// USER LOGGED IN: only show private spots where user=owner
	print "USER LOGGED IN! it's $username";
	$result = mysql_query("
	SELECT * 
	FROM spots
	WHERE (private = 1 AND owner = '$username') OR (private = 0)
	ORDER BY name ASC
			");
	}
	else
	{
	// NOBODY LOGGED IN: don't show any private spots
	//print "NOBODY LOGGED IN! hiding private waters";
	$result = mysql_query("
	SELECT * 
	FROM spots 
	WHERE private = 0 
	ORDER BY name ASC
			");
	}
		
		
		
// IF NO USER LOGGED IN: don't show ANY private spots
		
// take the data and put it into an array
$row = mysql_fetch_array($result);

// get all the variables
while($row = mysql_fetch_array($result))
	{

// these are things we care about on trips.php:

$name = $row['name'];
$watertype = $row['watertype'];
$lat = $row['lat'];
$lon = $row['lon'];
$city = $row['city'];
$county = $row['county'];
$state = $row['state'];
$notes = $row['notes'];
$owner = $row['owner'];
$private = $row['private'];


print "<div id='tripbox'>";
print "<b><a href='spot.php?name=$name'>$name</a></b> <p>
	$city $county $state<p>


"

;

if ($private == '1')
	{
	print " (private)";
	}

print "</div><BR><BR>";



	}
	
print "</div>";
print $footer;