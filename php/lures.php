<?php
session_start();

include 'config/config.php';
include 'config/connect.php';
include 'header.php';

?>
<link rel="stylesheet" type="text/css" href="style.css"/>
<?
print $header;


	$result = mysql_query("
	SELECT DISTINCT lures, tripnumber FROM trips
			");
			
			
// get all the variables
while($row = mysql_fetch_array($result))
	{

// these are things we care about on trips.php:
$lures = $row['lures'];
print "lures is $lures <br>";
$tripnumber = $row['tripnumber'];
print "tripnumber is $tripnumber<br>";
	}

?>

