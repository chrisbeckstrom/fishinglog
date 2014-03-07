<?php
session_start();
// SUBMIT A NEW SPOT
// 	this script takes input from add_spot.php
//	and adds it to the DB

?>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<?

include '../config/config.php';
include '../config/connect.php';
include '../header.php';

print $header;
///////////////////// RESULTS //////////////////////
print "<br><br><br><br>";
// get the current time (for "last updated" field in DB)
$now = date("Y-m-d H:i:s");		// set the $now in UTC (for "last update" column)


///////////////////// GET THE CURRENT DATETIME //////////////////////
$now = date("Y-m-d");
print "now is $now<br>";

////////////// GET STUFF ////////////////
$waterbodyid = $_GET['waterbodyid'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$username = $_SESSION['myusername'];
$privacy = $_GET['privacy'];
$icon = $_GET['icon'];
$name = $_GET['name'];

//////////////////// FIX APOSTROPHES /////////////////////////////////////////
// make it so apostrophes work
$notes = mysql_real_escape_string($_GET[notes]);

print "the notes are $notes<br>";
	
//////////////////// SEND TO THE DATABASE! whoohoooo //////////////////////
$sql="INSERT INTO spots (
	waterbody_id, name, username, privacy, icon_url, notes, lat, lon
	)
VALUES (''
	'$waterbodyid','$name','$username','$privacy','$icon', '$notes', '$lat', '$lon'
	)";
	
// show us the query
print "<br> -------- THE SQL QUERY --------- <br><pre> $sql </pre>";

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);
print "THIS IS AFTER THE CONNECTION CLOSES";
?>
	



