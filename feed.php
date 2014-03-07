<?php

/* facebook-like newsfeed of everything that happens */


include 'config/config.php';
include 'config/connect.php';
include 'header.php';

$pagetitle = "Feed";
print $header;

print "<div id = 'wrap'>";
print "<div id = 'tripbox'>";
print "<h1>$pagetitle</h1>";


if ( $_SESSION['myusername'] === 'cbfishes' )
{
print "<i> viewing the feed as $username </i><br>";
}
else
{
print "UNDER CONSTRUCTION";
die;
}


// show all the recent feed items- hide private ones that don't belong to current user

// Figure out what to show based on who is viewing
if(isset($_SESSION['myusername']))
	{
	// USER LOGGED IN: only show private stuff where user=owner
	$result = mysql_query("
	SELECT *
	FROM feed
	WHERE (private = 1 AND username = '$username') OR (private = 0)
	ORDER BY timestamp DESC
	LIMIT 100
			");
	}
	else
	{
	// NOBODY LOGGED IN: don't show any private stuff
	//print "NOBODY LOGGED IN! hiding private waters";
	$result = mysql_query("
	SELECT *
	FROM feed
	WHERE private = 0
	ORDER BY timestamp DESC
	LIMIT 100
			");
	}


/*
SELECT *
FROM feed
WHERE (private = 1 AND username = '$username') OR (private = 0)
LIMIT 100
*/

// take the data and put it into an array
//$row = mysql_fetch_array($result);

// get all the variables
while($row = mysql_fetch_array($result))
	{


// grab stuff from the array and make it into variables we can use
$timestamp = $row['timestamp'];
$private = $row['private'];
$activity = $row['activity'];
$title = $row['title'];
$url = $row['link'];
$feeduser = $row['username'];


// the format of each feed item is
// SOMEUSER DIDSOMETHING(link)
if ( $activity === "waterbody_add" )
{
$activity_string = "added <a href='$url'>$title</a> to <a href='waterbodies.php'>waterbodies</a>";
}

if ( $activity === "trip_add" )
{
$activity_string = "logged a trip: <a href='$url'>'$title'</a> to <a href='waterbodies.php'>waterbodies</a>";
}


$itemdate = date("m-d-Y", strtotime($timestamp));
$today = date("m-d-Y");
$yesterday = date("m-d-Y", strtotime("yesterday"));

// print "<br> Today is $today";
// print "<br> Yesterday was $yesterday";
// print "<br> The item's date is $itemdate";

if ( $itemdate === $today )
{
	$when = 'today';
}

if ( $itemdate === $yesterday )
{
	$when = 'yesterday';
}



print "<div class = 'feedbox'>
		<a href='user.php?username=$feeduser'>$feeduser</a> $activity_string <i>($when)</i><p>
				time: $timestamp <br>
				private: $private <br>
		activity: $activity <BR>
		<hr>
		
";

if ($private == '1')
	{
	print " (private)";
	}
	
print "</div>";




	}