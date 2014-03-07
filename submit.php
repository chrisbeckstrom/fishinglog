<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?
// This is the PHP script that receives $_POST output from 'form.php'
// for logging a trip

	// it logs all the info from the form
	// it also uses a bunch of other scripts to get info and/or calculate things

include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print $header;

///////////////////// RESULTS //////////////////////
print "<br><br><br><br>";
// get the current time (for "last updated" field in DB)
$now = date("Y-m-d H:i:s");		// set the $now in UTC (for "last update" column)

$notes = $_GET[notes];
print "Notes is $notes <br>";

///////////////////// FIX THE DATE //////////////////////
print "date is is $_GET[date]";
$unixdate = strtotime("$_GET[date]");
print "unix date is $unixdate";
$tripdate = date("Y-m-d", $unixdate);
print "tripdate is $tripdate";

///////////////////// SHOW US WHAT WE GOT //////////////////////
$tripnumber = $_POST[tripnumber];
$url = 'viewtrip.php?tripnumber=$tripnumber';
print "the trip page for this trip is $url";

$lat = $_GET['lat'];
$lon = $_GET['lon'];
$latlon = $lat . "," . $lon;
print "lat is $lat<br>";
print "lon is $lon<br>";
print "latlon is $latlon<br>";
$tripnumber = $_GET[tripnumber];
print "the tripnumber is $tripnumber<br>";
$timeofday = $_GET[timeofday];
$waterbody = $_GET[waterbody];
$watertype = $_GET[watertype];
$adventure = $_GET[adventure];
$scenic = $_GET[scenic];
$ninja = $_GET[ninja];

$privacy = $_GET[privacy];
	print "<h1>private = $privacy </h1>";
	print "<b> 0 = public, 1 = users, 2 = friends, 3 = private <br></b>";

	// get info about the fish caught
$getarray = $_GET['fishbox'];
$getcountarray = $_GET['fishcount'];
$getweight = $_GET['fishweight'];
$getlength = $_GET['fishlength'];

///////////////////// GET THE CITY/STATE/ZIP //////////////////////
print "<hr>";
include 'php/findcity.php';

///////////////////// FIGURE OUT IF THAT WATERBODY IS IN THE DB ////////
print "<hr>";
include 'php/newwaterbodytest.php';

//////////////////// FIND THE NEAREST STREAMFLOW GAUGE //////////////////////
print "<hr>";
include 'php/findgauge.php';

//////////////////// GET THE STREAMFLOW FOR THAT GAUGE, PLACE, RIVER, and DATE
print "<hr>";
include 'php/getphp/streamflow.php';

//////////////////// GET THE WEATHER /////////////////////////////////////////
print "<hr>";
include 'php/getweather_new.php';

//////////////////// FIX APOSTROPHES /////////////////////////////////////////
// make it so apostrophes work
$notes = mysql_real_escape_string($_GET[notes]);
$waterbody = mysql_real_escape_string($_GET[waterbody]);
$lures = mysql_real_escape_string($_GET[lures]);

print "the notes are $notes<br>";

//////////////////// FIGURE OUT WHAT FISH WERE CAUGHT etc ///////////////////
include 'php/submitfish.php';

//////////////////// ADD UP THE FISH /////////////////////////////////////////
	//include 'addupfish.php';

//////////////////// TEST FOR NEW SPECIES /////////////////////////////////////////
	//include 'php/newspeciestest.php';
	
//////////////////// TEST FOR NEW WATER /////////////////////////////////////////
print "<hr>";
include 'php/newwatertest.php';
	
//////////////////// ADD UP THE POINTS /////////////////////////////////////////
	//include 'php/points.php';
	
//////////////////// SEND EVERYTHING TO THE DB /////////////////////////////////////////
print "<br>SENDING STUFF TO THE DB<br>";
$sql="INSERT INTO trips (
	private,
	lat,
	lon,
	latlon,
	lastupdate,
	date, 
	skunked, 
	time, 
	timeofday,
	adventure,
	scenery,
	ninja,
	waterbody,
	watertype,
	watercolor,
	sitecode,
	gaugeheight,
	discharge,
	temp,
	hum,
	wspdi,
	wgusti,
	wdir,
	pressure,
	conds,
	metar,
	gear,
	method,
	watertemp,
	notes,
	lures,
	lureimage,
	username,
	tripnumber,
	city,
	state,
	zip,
	newwater,
	points,
	fishcaught
	)
VALUES ('$privacy',
	'$lat',
	'$lon',
	'$latlon',
	'$now',
	'$tripdate',
	'$_GET[skunked]',
	'$_GET[time]',
	'$timeofday',
	'$adventure',
	'$scenic',
	'$ninja',
	'$waterbody',
	'$_GET[watertype]',
	'$_GET[watercolor]',
	'$sitecode',
	'$gaugeheight',
	'$discharge',
	'$temp',
	'$hum',
	'$wspdi',
	'$wgusti',
	'$wdir',
	'$pressure',
	'$conds',
	'$metar',
	'$_GET[gear]',
	'$_GET[method]',
	'$_GET[watertemp]',
	'$notes',
	'$lures',
	'$_GET[lureimage]',
	'$_SESSION[myusername]',
	'$tripnumber',
	'$city',
	'$state',
	'$zip',
	'$newwater',
	'$points',
	'$fishcaught'
	)";
	
// show us the query
print "<br> -------- THE SQL QUERY --------- <br><pre> $sql </pre>";

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);


//////////////// NEW WATERBODY? ////////////////////
if ( $isnewwaterbody == 1)
{
	?>
	<box>
		<h2>New waterbody</h2>
		It looks like you're the first to fish this water!<br>
	<? print "waterbody name is $waterbody<br>"; 
	print "<a href='waterbody-addnew.php?name=$waterbody&watertype=$watertype&lat=$lat&lon=$lon&city=$city&state=$state&$county=$county' target='_blank'>Tell us more about this waterbody</a>";
?>	</box>
	<?
}

