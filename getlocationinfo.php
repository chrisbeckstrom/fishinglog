<?php

/* GET LOCATION INFO (to be inserted)

input: $lat, $lon
output: city, county, state
(as variables: $city $county $state)_

GEONAMES.ORG
http://www.geonames.org/about.html

username: chrisbeckstrom

	Find nearby populated place / reverse geocoding
	Webservice Type : REST
	Url : api.geonames.org/findNearbyPlaceName?
	Parameters : lat,lng,
	lang: language of returned 'name' element (the pseudo language code 'local' will return it in local language),
	radius: radius in km (optional), maxRows: max number of rows (default 10)
	style: SHORT,MEDIUM,LONG,FULL (default = MEDIUM), verbosity of returned xml document
	localCountry: in border areas this parameter will restrict the search on the local country, value=true
	Result : returns the closest populated place (feature class=P) for the lat/lng query as xml document. The unit of the distance element is 'km'.
	Example:
	http://api.geonames.org/findNearbyPlaceName?lat=47.3&lng=9&username=demo
	
	This service is also available in JSON format :
	http://api.geonames.org/findNearbyPlaceNameJSON?lat=47.3&lng=9&username=demo 


*/
// $lat = 41.988933;
// $lon = -88.022141;
// // http://api.geonames.org/extendedFindNearby?lat=41.988933&lng=-88.022141&username=chrisbeckstrom
$xmlstr = "http://api.geonames.org/extendedFindNearby?lat=$lat&lng=$lon&username=chrisbeckstrom";

print "The url is <a href=$xmlstr>$xmlstr</a>";

// go get the XML
$xml = simplexml_load_file($xmlstr);
// genname[3] = state
// geoname[4] = county
// geoname[5] = city

// it appears more digits in the lat lon will cause a different XML to be returned
$state = $xml->address->adminName1;
$county = $xml->address->adminName2;
$city = $xml->address->placename;

print "<hr><BR>
state: $state <BR>
county: $county <BR>
city: $city <BR>";