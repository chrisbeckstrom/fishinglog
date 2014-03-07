<?
/*
http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=false
*/

$json_url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=false";

// get the JSON file from Google	
$json_string = file_get_contents($json_url);

// parse the JSON file
$parsed_json = json_decode($json_string); 
	
//print_r($parsed_json);
// grab info from the parsed json file, create variables
// $city = $parsed_json->{'location'}->{'city'}; 
// $lat = $parsed_json->{'location'}->{'lat'};
// $lon = $parsed_json->{'location'}->{'lon'};

//grab info, create variables

$b = array (
    'm' => 'monkey', 
    'foo' => 'bar', 
    'x' => array ('x', 'y', 'z'));

$results = print_r($b, true); // $results now contains output from print_r
file_put_contents('googlemaps_json.txt', print_r($parsed_json));