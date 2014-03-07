<?php
// TRIPINFO
// -- stuff to show about each trip
// -- this goes in trips.php (all trips) and viewtrip.php (view a single trip)

// these are things we care about on trips.php:
$tripdate = $row['date'];		// YYYY-MM-DD
	
	$time = strtotime($tripdate);
	$newformat = date('F d, Y',$time);
	$date = $newformat;			// Month DD, YYYY

$tripnumber = $row['tripnumber'];
$public = $row['public'];
$username = $row['username'];
$userid = $row['userid'];
$userrealname = $row['userrealname'];
$timefished = $row['time'];
$lastupdate = $row['timestamp'];
$fishcaught = $row['fishcaught'];
$gaugeheight = $row['gaugeheight'];
$discharge = $row['discharge'];
$adventure = $row['adventure'];
$scenic = $row['scenery'];
$ninja = $row['ninja'];
$points = $row['points'];
$city = $row['city'];
$state = $row['state'];

// if we don't have adventure/scenery/ninja scores, don't show any
if ( $adventure == '0' )
	{
	$scores = "";
	}
	else
	{
	$scores = "adventure score: $adventure / scenic score: $scenic / ninja score: $ninja";
	}

// USGS sitecode
$sitecode = $row['sitecode'];

// if the sitecode isn't 8 characters long, add a '0' to the beginning
if ( strlen($sitecode) == 7 )
	{
	$sitecode = '0' . $sitecode;
	}

if ( strlen($sitecode) == 6 )
	{
	$sitecode = '00' . $sitecode;
	}

// if you didn't catch fish, say "SKUNKED" instead of "0"
if ( $fishcaught == 0 )
	{
	$results = "skunked";
	}
	else
	{
	$results = "fish caught: $fishcaught";
	}
	
$tripid = $row['tripid'];
$lastupdate = $row['lastupdate'];

// HIDE THE WATERBODY?
$watertype = $row['watertype'];
$waterbody = $row['waterbody'];
if ( $hidethings == 1 )
	{
	$waterbody = disguise($waterbody);
	}
	else {
		$waterbody = $waterbody;
	}

// HIDE NOTES?
$notes = $row['notes'];
if ( $hidethings == 1 )
	{
	// disuise anything in brackets
	$notes = disguiseBrackets($notes);
	}
else {
	// remove the brackets from notes
	$notes = str_replace("[","",$notes);
	$notes = str_replace("]","",$notes);
}

$newwater = $row['newwater'];
$fishingmethod = $row['method'];
$gear = $row['gear'];
$timeofday = $row['timeofday'];
$lure = $row['lures'];
$lureimage = $row['lureimage'];

// Wunderground historical link
//$wunderground_url = 'http://www.wunderground.com/history/airport/KGRR/2013/6/1/DailyHistory.html?req_city=Grand+Rapids&req_state=MI&req_statename=Michigan'

$temp = $row['temp'];
$hum = $row['hum'];
$wspdi = $row['wspdi'];
$wdir = $row['wdir'];
$pressure = $row['pressure'];
$conds = $row['conds'];
$lat = $row['lat'];
$lon = $row['lon'];

$private = $row['private'];

// USGS historical link
$usgs_url = "http://waterdata.usgs.gov/nwis/uv?cb_00060=on&cb_00065=on&format=gif_default&period=&begin_date=$tripdate&end_date=$tripdate&site_no=$sitecode";

$gaugeheight = $row['gaugeheight'];
$discharge = $row['discharge'];
$watercolor = $row['watercolor'];

// if we have lure information, show it
if ($lure == '')
	{
	$bestlure = '';
	}
	else
	{
	$bestlure = "best lure: $lure";
	}

// if it's new water, make $isnewwater something
if ( $newwater == '1' )
		{
			$isnewwater = "NEW WATER!";
		}
	else
		{	$isnewwater = "";
		}


// <img src='http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=200x200&sensor=false'></a>

// TRIPBOX

print "$date / 
$timeofday / 
user: <a href='user.php?username=$username'>$username</a>
<br><a href='viewtrip.php?tripnumber=$tripnumber'>

	<a href='viewtrip.php?tripnumber=$tripnumber'><h2>$waterbody</h2></a>
	$city, $state <br>
	
<box>
	<h3>INFO</h3>
	$scores <br>
	gear: $gear <br>
	points: $points<br>
	$isnewwater<br>
	";

	print "<h3>FISH</h3>
	$results";
	// A FISH SPRITE FOR EACH FISH CAUGHT
	$i=1;
	while($i<=$fishcaught)
	  {
	  print "<img src='images/fish.gif'>";
	  $i++;
	  }
	  
	
	
	
	// LURE IMAGE: if there isn't one, don't show anything
	if ($lureimage == '')
		{
		$lurepic = '';
		}
		else
		{
		$lurepic = "<a href='$lureimage' target='_blank'><img src='$lureimage' height='90' width='90'></a>";;
		}
		
	print "<br>$bestlure <br><br>";
	print "$lurepic<br>";
	
	 print "";

	// if we have weather information, show it
	if ( $hum != '')
		{
		print "
		<h3>WEATHER</h3>";
		print "<img src='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTQI2OTR3C07fpb-wJrTgJtka7c1kVDuRNAC8P2YgPnHDZpycgyhw'>";
		print "$conds - $temp &deg;F <br>
		$hum% humidity - winds at $wspdi mph from the $wdir<br><br>";
	
		}

	print "water color: $watercolor<br>";

	// if we have streamflow information, show it
	if ( $gaugeheight != '')
		{
		print "<h3>STREAMFLOW</h3>";
		print "<a href='$usgs_url' target='_blank'>gauge height: $gaugeheight feet</a><br>";
		}

	// if we have discharge info, show it
	if ( $discharge != '' )
		{
		print "<a href='$usgs_url' target='_blank'>discharge: $discharge cfs</a><br>";
		}
	
	print "</box>

	<box>
	<h3>NOTES</h3>
	$notes
	</box>
";

// SMALL INFO AT THE BOTTOM
print "<box>
		<h3>INFO</h3>
		user: <a href='user.php?username=$username'>$username</a> 
		/ tripnumber: $tripnumber 
		/ tripid: $tripid
		/ last updated: $lastupdate
		/ <a href='log2.php?tripnumber=$tripnumber'>add another spot</a>
		/ <a href='php/deletetrip.php?tripid=$tripid'>delete</a>
		/ <a href='php/isnewwater.php?tripid=$tripid'>designate new water</a>
	   </box>";

if ($private == '1')
	{
	print " (private)";
	}
