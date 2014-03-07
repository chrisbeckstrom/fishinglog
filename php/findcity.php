<?php

// Use the lat and lon information we just got to figure out the city, state, and zipcode

print "<br><b>------- findcity.php ------------</b><br>";
$geonamesusername='chrisbeckstrom';

// this is the URL we are using to access the Geonames API
// more info: http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
$url = "http://api.geonames.org/findNearbyPostalCodes?lat=$lat&lng=$lon&username=$geonamesusername&maxRows=1";
print "geonames URL: <pre>$url </pre><br>";

// we grab that url and put it into an object we can access
$geonames = new SimpleXMLElement(file_get_contents($url));

print "<br>";
print "tripdate is $date";
print "lat,lon is $lat,$lon <br>";
print "zip: " . $geonames->code->postalcode . "<br>";
$zip = $geonames->code->postalcode;
print "city: " . $geonames->code->name . "<br>";
$city = $geonames->code->name;
print "adminCode1: " . $geonames->code->adminCode1 . "<br>";
$state = $geonames->code->adminCode1;
print "adminName2: " . $geonames->code->adminName2 . "<br>";
$county = $geonames->code->adminName2;

?>