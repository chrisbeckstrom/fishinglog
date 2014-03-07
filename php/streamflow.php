<?php


// Use the USGS Streamflow API to get streamflow information

// $site=


// this is the URL we are using to access the Geonames API
// more info: http://www.geonames.org/export/web-services.html#findNearbyPostalCodes
$url = "http://waterservices.usgs.gov/nwis/iv/?sites=04118500&period=P1D&format=waterml";

// we grab that url and put it into an object we can access
$streamflow = new SimpleXMLElement(file_get_contents($url));

asXML($streamflow);


// insert the city, state, and zip we found

// mysqli_query($con,"INSERT INTO Persons (FirstName, LastName, Age)
// VALUES ('Peter', 'Griffin',35)");

// UPDATE table_name
// SET column1=value, column2=value2,...
// WHERE some_column=some_value

print "zip: " . $geonames->code->postalcode . "<br>";
$zip = $geonames->code->postalcode;
print "name: " . $geonames->code->name . "<br>";
$city = $geonames->code->name;
print "adminCode1: " . $geonames->code->adminCode1 . "<br>";
$state = $geonames->code->adminCode1;

