<?php
session_start();
// UPDATE ZIP/CITY/STATE SCRIPT
// this script queries the trips table, looks for every trip that has a lat and lon,
// and uses the Geonames API to figure out the city, state, and zip for those locations.
// 
// Then it connects to the DB again to update those trips with the city/state/zip information it found.
//


include 'config/config.php';
include 'config/connect.php';

	$result = mysql_query("
	SELECT * 
	FROM trips 
	WHERE lat != ''
	AND lon != ''
	
			");

while($row = mysql_fetch_array($result))
	{

// these are things we care about on trips.php:
$tripdate = $row['date'];
$waterbody = $row['waterbody'];
$lat = $row['lat'];
$lon = $row['lon'];
$date = $row['date'];
$tripid = $row['tripid'];
			

// Go through the trips database and add location information to each trip
// using GEONAMES API

// $lat = 43.108174;
// $lon = -85.570646;
$geonamesusername='chrisbeckstrom';

// http://api.geonames.org/findNearbyPostalCodes?lat=42.862674997978154&lng=-85.62546896029664&username=chrisbeckstrom&maxRows=1
// http://api.geonames.org/findNearbyPostalCodes?lat=$lat&lng=$lon&username=$geonamesusername&maxRows=1

// this is the URL we are using to access the Geonames API
// more info: http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
$url = "http://api.geonames.org/findNearbyPostalCodes?lat=$lat&lng=$lon&username=$geonamesusername&maxRows=1";

// we grab that url and put it into an object we can access
$geonames = new SimpleXMLElement(file_get_contents($url));

print "<br>";
print "tripdate is $date";
print "lat,lon is $lat,$lon <br>";
print "zip: " . $geonames->code->postalcode . "<br>";
$zip = $geonames->code->postalcode;
print "name: " . $geonames->code->name . "<br>";
$city = $geonames->code->name;
print "adminCode1: " . $geonames->code->adminCode1 . "<br>";
$state = $geonames->code->adminCode1;

// insert the city, state, and zip we found

// mysqli_query($con,"INSERT INTO Persons (FirstName, LastName, Age)
// VALUES ('Peter', 'Griffin',35)");

// UPDATE table_name
// SET column1=value, column2=value2,...
// WHERE some_column=some_value

print "going to edit tripid $tripid and make the city into $city<br>";

	// update the CITIES
	$sql = "UPDATE trips
			SET city='$city'
			WHERE tripid = '$tripid'
	";
	
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());							// error message
		}

	// update the ZIPCODES
	$sql = "UPDATE trips
			SET zip='$zip'
			WHERE tripid = '$tripid'
	";
	
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());							// error message
		}
		
	// update the STATES
	$sql = "UPDATE trips
			SET state='$state'
			WHERE tripid = '$tripid'
	";
	
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());							// error message
		}

}



?>