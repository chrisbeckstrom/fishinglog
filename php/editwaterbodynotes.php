<?php
session_start();
// EDIT WATERBODY NOTES
//	this script takes the output of the edit box on waternew.php
//	and updates the DB based on the 'notes'

// whoa I didn't know you could edit code right on GitHub!!

?>
<link rel="stylesheet" type="text/css" href="style.css"/>
<?

include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print $header;
///////////////////// RESULTS //////////////////////
print "<br><br><br><br>";
// get the current time (for "last updated" field in DB)
$now = date("Y-m-d H:i:s");		// set the $now in UTC (for "last update" column)


////////////// GET STUFF ////////////////
$notes = $_GET['notes'];
$waterbodyid = $_GET['waterbodyid'];

//////////////////// FIX APOSTROPHES /////////////////////////////////////////
// make it so apostrophes work
$notes = mysql_real_escape_string($_GET[notes]);
$waterbodyname = mysql_real_escape_string($_GET[waterbodyname]);

print "the new notes are $notes<br>";

	
//////////////////// SEND TO THE DATABASE! whoohoooo //////////////////////
$sql="UPDATE waterbodies  SET notes = '$notes' WHERE id = $waterbodyid";

// show us the query
print "<br> -------- THE SQL QUERY --------- <br><pre>$sql</pre>";

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);
print "THIS IS AFTER THE CONNECTION CLOSES";
?>
	



