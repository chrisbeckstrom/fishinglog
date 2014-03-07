<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id='header'>
<?php
// CB's insert-to-mysql php script
//		 originally from
// http://www.w3schools.com/php/php_mysql_insert.asp
//		but heavily, heavily modified by CB

///// ABOUT THE VARIABLES FROM THE HTML FORM
//// The variable $_POST[something] stands for the "something" field
//// that was entered in by the user and submitted in the HTML form
//// (originally that html file is trips.html)

// Set some variables

include 'config/config.php';
include 'config/connect.php';


// $date = date("l");				// set the $date variable as the day of week
$now = date("Y-m-d H:i:s");		// set the $now in UTC (for "last update" column)

// Clean up the "notes" for import into MySQL

	// function clean_up( $text ) {
//     $unwanted = array("'"); // add any unwanted char to this array
//     return str_ireplace( $unwanted, '', $text );
// 	}
// 	
// 	$dirty_title = $_POST[notes];
// 	$clean_title = clean_up( $dirty_title );;
// 	// echo $clean_title
// 	$_POST[notes] = $clean_title;		//puts the cleaned up text back into the same variable
// 

// CONVERT MM/DD/YYYY from datepicker to YYYY/MM/DD for mysql

//print "Datepicker is $_POST[date]";
$unixdate = strtotime("$_POST[date]");
//print "unix date is $unixdate";
$tripdate = date("Y-m-d", $unixdate);
//print "tripdate is $tripdate";


// ADD UP THE FISH
// Get the total number of fish caught by adding up all the numbers

// syntax
//	$_POST[input_from_html_form]
$total = 
	$_POST[smallmouth] + 
	$_POST[largemouth] +
	$_POST[greenie] +
	$_POST[bluegill] +
	$_POST[carp] +
	$_POST[drum] +
	$_POST[walleye] +
	$_POST[pike] +
	$_POST[musky] +
	$_POST[bowfin] +
	$_POST[shad] +
	$_POST[creekchub] +
	$_POST[flatheadcatfish] +
	$_POST[channelcatfish] +
	$_POST[browntrout] +
	$_POST[rainbowtrout] +
	$_POST[brooktrout] +
	$_POST[perch] +
	$_POST[stripedbass] +
	$_POST[whiteperch] +
	$_POST[crappie] +
	$_POST[bullhead] +
	$_POST[redeyebass] +
	$_POST[rockbass] +
	$_POST[goby]
	;


// Insert the stuff you got from the HTML form
$sql="INSERT INTO trips (
	lastupdate,
	date, 
	skunked, 
	time, 
	timeofday,
	waterbody,
	watertype,
	watercolor,
	gear,
	method,
	airtemp,
	watertemp,
	weather,
	fishcaught,
	largemouth,
	smallmouth,
	greenie,
	bluegill,
	carp,
	drum,
	walleye,
	pike,
	musky,
	bowfin,
	shad,
	creekchub,
	flatheadcatfish,
	channelcatfish,
	browntrout,
	rainbowtrout,
	brooktrout,
	perch,
	stripedbass,
	whiteperch,
	crappie,
	bullhead,
	redeyebass,
	rockbass,
	goby,
	notes,
	lures,
	username
	)
VALUES (''
	'$now',
	'$tripdate',
	'$_POST[skunked]',
	'$_POST[time]',
	'$_POST[timeofday]',
	'$_POST[watersField]',
	'$_POST[watertype]',
	'$_POST[watercolor]',
	'$_POST[gear]',
	'$_POST[method]',
	'$_POST[airtemp]',
	'$_POST[watertemp]',
	'$_POST[weather]',
	'$total',
	'$_POST[largemouth]',
	'$_POST[smallmouth]',
	'$_POST[greenie]',
	'$_POST[bluegill]',
	'$_POST[carp]',
	'$_POST[drum]',
	'$_POST[walleye]',
	'$_POST[pike]',
	'$_POST[musky]',
	'$_POST[bowfin]',
	'$_POST[shad]',
	'$_POST[creekchub]',
	'$_POST[flatheadcatfish]',
	'$_POST[channelcatfish]',
	'$_POST[browntrout]',
	'$_POST[rainbowtrout]',
	'$_POST[brooktrout]',
	'$_POST[perch]',
	'$_POST[stripedbass]',
	'$_POST[whiteperch]',
	'$_POST[crappie]',
	'$_POST[bullhead]',
	'$_POST[redeyebass]',
	'$_POST[rockbass]',
	'$_POST[goby]',
	'$_POST[notes]',
	'$_POST[lures]',
	'$_SESSION[myusername]'
	)";


// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
  }
print $header;
print "<div id='centered'>";
echo "<h3><center>One trip added to the log!</h3>";		
print "date logged= $now<BR>
		date of trip = $tripdate <BR>
		waterbody = $_POST[watersField]<br>
		time = $_POST[time] hours<br>
		method = $_POST[method]<br>
		notes = $_POST[notes]<br>";				// success message
print "<center>$total fish added to the database livewell";
print "</div>";
#print "<meta http-equiv='REFRESH' content='2;url=php/stats.php'>";			//html redirect, seemed easier than php
print "<a href='php/stats.php'>click here to see your stats</a>";
mysql_close($con);
?>