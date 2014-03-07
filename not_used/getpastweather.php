<?php

/* CB'S GET PAST WEATHER SCRIPT
access Wunderground's API and get weather information for a
particular time and place

*/

// this is the original wunderground api key
// chrisbeckstrom@gmail.com

include 'config/config.php';
include 'config/connect.php';

$apikey = "681a9b949662ace6";

// http://api.wunderground.com/api/681a9b949662ace6/history_20121009/q/IL/Itasca.json

$cities=array(
"Itasca"=>"http://api.wunderground.com/api/681a9b949662ace6/history_20121009/q/IL/Itasca.json");
				
foreach($cities as $val) 
{
	$json_url = $val;
	print "<h1>The URL we're using now is $val</h1><BR>";

// get the JSON file from Wunderground	
$json_string = file_get_contents($json_url);

// parse the JSON file
$parsed_json = json_decode($json_string, $assoc = FALSE, $depth = 3); 

//$results = print_r($parsed_json);
file_put_contents('parsed_json_weather3.txt', print_r($parsed_json, true));


// we don't need the date, because that's how we're looking it up!
//$test = $parsed_json->{'history'}->{'date'}->{'pretty'}; 

// times of day to look up:
// 	12am, 2am, 5am, 8am, 12pm, 2pm, 7pm, 9pm


$test = $parsed_json->{'history'}->{'observations'}->{'0'}->{'tempm'}; 


print "<br><br>
	the test is: $test <br>
	";
	
// grab info from the parsed json file, create variables
$city = $parsed_json->{'location'}->{'city'}; 
$lat = $parsed_json->{'location'}->{'lat'};
$lon = $parsed_json->{'location'}->{'lon'};
$zip = $parsed_json->{'location'}->{'zip'};
$state = $parsed_json->{'location'}->{'state'};
$time = $parsed_json->{'current_observation'}->{'local_epoch'};
$temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
$windchill = $parsed_json->{'current_observation'}->{'windchill_f'}; 
$heatindex = $parsed_json->{'current_observation'}->{'heat_index_f '};
$feelslike = $parsed_json->{'current_observation'}->{'feelslike_f'};
$pressure_in = $parsed_json->{'current_observation'}->{'pressure_in'}; 
$pressuretrend = $parsed_json->{'current_observation'}->{'pressure_trend'}; 
$weather = $parsed_json->{'current_observation'}->{'weather'};
$relhumidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
$visibility = $parsed_json->{'current_observation'}->{'visibility_mi'};
$precip_today = $parsed_json->{'current_observation'}->{'precip_today_in'};
$wind = $parsed_json->{'current_observation'}->{'wind_string'};
$wind_dir = $parsed_json->{'current_observation'}->{'wind_dir'};
$wind_degrees = $parsed_json->{'current_observation'}->{'wind_degrees'};
$wind_mph = $parsed_json->{'current_observation'}->{'wind_mph'};
$wind_gust_mph = $parsed_json->{'current_observation'}->{'wind_gust_mph'};







}

?>