<?php

/* GET PAST WEATHER SCRIPT - XML

after having problems parsing JSON into an array
that I can navigate, here goes parsing XML from
the Wunderground API

*/

$apikey = "681a9b949662ace6";


$url = "http://api.wunderground.com/api/681a9b949662ace6/history_20121009/q/IL/Itasca.xml";

//$cities=array( "Itasca"=>"http://api.wunderground.com/api/$apikey/history_20121009/q/IL/Itasca.json");

// get the XML file from Wunderground

$xml = new SimpleXMLElement(file_get_contents($url));



//print_r($xml);

//file_put_contents('parsedXMLweather.txt', print_r($xml, true));

//$xml = file_get_contents('parsedXMLweather.txt');


//$testing = $xml->version;	// works
//$testing = $xml->termsofService; // works
//$testing = $xml->history; // NOTHING
//$testing = $xml->history->date->pretty; // WORKS
//$testing = $xml->{'history'}->{'date'}->{'pretty'}; // WORKS
//$testing = $xml->{'tempm'}; // NOTHING
//$testing = $xml->history->observations->observation->0->'date'->pretty;
//$testing = $xml->{'history'}->{'utcdate'}->{'hour'}; // WORKS
//$testing = $xml->{'history'}->{'observation'}->{'0'}; // NOTHING DISPLAYED
//$testing = $xml->{'history'}->{'observation'}->{'0'}->{'date'}->{'pretty'}; // NOTHING DISPLAYED
//$testing = $xml[0]; // nothing
//$testing = $xml->{'history'}->{'observation'}->{'date'}->{'pretty'}; // nothing

//$testing = $xml->{'history'}->{'observation'}->{0}->{'date'}->{'pretty'};

//print $testing = $xml->history->observations->observation[0]->tempm;

//$testing = $xml->version;
//print $testing;

//echo $xml{'version'};


// $lat = $xml->code->lat;
// $lng = $xml->code->lng;
// echo "Lat: $lat<br/>Lng: $lng";


?>