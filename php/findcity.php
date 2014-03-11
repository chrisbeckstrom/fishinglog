<?php

// Use the lat and lon information we just got to figure out the city, state, and zipcode

print "<br><b>------- findcity.php ------------</b><br>";
$geonamesusername='chrisbeckstrom';
	$logthis = "\n -- starting findcity.php --";
	fwrite($fh, $logthis);

// this is the URL we are using to access the Geonames API
// more info: http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
$url = "http://api.geonames.org/findNearbyPostalCodes?lat=$lat&lng=$lon&username=$geonamesusername&maxRows=1";
print "geonames URL: <pre>$url </pre><br>";
	$logthis = "\n geonames URL: $url";
	fwrite($fh, $logthis);

// we grab that url and put it into an object we can access
$geonames = new SimpleXMLElement(file_get_contents($url));

print "<br>";
print "tripdate is $date";
print "lat,lon is $lat,$lon <br>";
print "zip: " . $geonames->code->postalcode . "<br>";
$zip = $geonames->code->postalcode;
	$logthis = "\n zipcode: $zip";
	fwrite($fh, $logthis);
	
print "city: " . $geonames->code->name . "<br>";
$city = $geonames->code->name;
	$logthis = "\n city: $city";
	fwrite($fh, $logthis);
	
print "adminCode1: " . $geonames->code->adminCode1 . "<br>";
$state = $geonames->code->adminCode1;
	$logthis = "\n state: $state";
	fwrite($fh, $logthis);
	
print "adminName2: " . $geonames->code->adminName2 . "<br>";
$county = $geonames->code->adminName2;
	$logthis = "\n county: $county";
	fwrite($fh, $logthis);
	
	$logthis = "\n -- end of findcity.php --";
	fwrite($fh, $logthis);

?>