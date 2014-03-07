<link rel='stylesheet' href='style.css' type="text/css" />
<?php 

/* CB'S GET THE WEATHER SCRIPT 
This script accesses the Wunderground API to get current weather conditions in
various places and document those in the fishingtrips.weather table

The intention is to later combine this information with the fishing trip information
to enhance both.

NOTE: The Wunderground API only allows 10 calls per minute-
	each item in the $cities array below counts as one call!
	BE CAREFUL!

THIS FILE is setup as a cron job on Dreamhost-
	this script will run (as of 1-16-2013) every hour, on the hour
	and collect weather information from these cities
	
	it is set to run at these times:
	12am, 2am, 5am, 8am, 12pm, 2pm, 7pm, 9pm

*/
$cities=array(
"Itasca"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Itasca.json",
"Batavia"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Batavia.json",
"Kalamazoo"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Kalamazoo.json",
"RockfordMI"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Rockford.json",
"Kentwood"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Kentwood.json",
"Flint"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Flint.json",
"Charleston"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/SC/Charleston.json"
	);
				
foreach($cities as $val) 
{
	$json_url = $val;
	print "<h1>The URL we're using now is $val</h1><BR>";

// get the JSON file from Wunderground	
$json_string = file_get_contents($json_url);

// parse the JSON file
$parsed_json = json_decode($json_string); 
	
// get the timezone
$weathertimezone = $parsed_json->{'location'}->{'tz_long'}; 

// set the timezone
date_default_timezone_set($weathertimezone);

// grab info from the parsed json file, create variables
$weathercity = $parsed_json->{'location'}->{'city'}; 
$weatherlat = $parsed_json->{'location'}->{'lat'};
$weatherlon = $parsed_json->{'location'}->{'lon'};
$weatherzip = $parsed_json->{'location'}->{'zip'};
$weatherstate = $parsed_json->{'location'}->{'state'};
$weathertime = $parsed_json->{'current_observation'}->{'local_epoch'};
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

// make the observation time nice
$nicedate = date("Y-m-d", $weathertime);

$weatherdate = date("Y-m-d");
print "Weatherdate is $weatherdate<BR>";

$weatherhms = date("H:i:s");
print "Weather HMS is $weatherhms<BR>";

// get the unixtime (from the API)	
print "The unix time \$weathertime from the API is $weathertime<BR>";

// convert that into hour:minute:second
$hms = date("H:i:s", $weathertime);
print "The hms time is $hms<BR>";

// make that into an integer
$hour = (int)$hms;
print "the integer time is $hour<BR>";

// tell us the result
print "The hour is $hour<BR>";

// convert that to time of day, set the $timeofday variable
$t = $hour;
switch ($t) {
    case $t >= 4 && $t < 8:		// between 4am and 8am 
        $timeofday = "morning";			// it's MORNING
        break;
    case $t >= 8 && $t < 12:		// between 8am and 12pm
       $timeofday = "late morning";	// it's LATE MORNING
        break;
    case $t >= 12 && $t < 14:	// between noon and 2pm
       $timeofday = "noon";			// it's LNOON
        break;
    case $t >= 14 && $t < 18:		// between 2 and 6pm
        $timeofday = "afternoon";			// afternoon
        break;
    case $t >= 18 && $t < 20:		// between 6 and 8pm
        $timeofday = "evening";			// evening
        break;
    case $t >= 20 && $t < 25:		// between 10pm and 12am
        $timeofday = "night";			// night
        break;
    case $t >= 0 && $t < 4:		// between 10pm and 12am
        $timeofday = "night";			// night
        break;
	}

// run the weather getter at
//	12am, 2am, 5am, 8am, 12pm, 2pm, 7pm, 9pm

// tell us a bunch of results
print "Time is $nicedate<br><br>";
print "Time of day is is $timeofday<br><br>";

print "<BR> City : $weathercity, $weatherstate <br>
			zip : $weatherzip <br>
			lat/long : $weatherlat, $weatherlon<BR>
			Timezone is: $weathertimezone <BR><BR>
			
			Temp : $temp_f °F <BR>
			Windchill : $windchill °F<BR>
			Heat index : $heatindex <BR>
			Pressure (in) : $pressure_in <BR>
			Pressure trend : $pressuretrend <br>
			Weather: $weather<BR>
			Relative humidity: $relhumidity <BR>
			Feels like : $feelslike °F<BR>
			Visibility : $visibility miles<BR>
			Precipitation today : $precip_today inches<BR>
			Wind : $wind <br>
			Wind direction : $wind_dir <BR>
			Wind speed : $wind_mph <BR>
			wind gust : $wind_gust_mph <BR>
			
			<br>
			<i>$weathertime<BR></i>
			
			";
			
// put this stuff in the DATABASE

// Connect to the server
mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!") or die(mysql_error());

print "<BR><div id='debug'>Connected to mysql </div>";

// Choose the database
mysql_select_db("fishingtrips") or die(mysql_error());
print "<BR><div id='debug'>Connected to Database</div>";

// PUT THE STUFF INTO THE DATABASE
mysql_query(
"INSERT INTO weather(
	weathercity,
	weatherlat,
	weatherlon,
	weatherzip,
	weatherstate,
	weatherdate,
	weatherhms,
	timeofday,
	temp_f,
	windchill,
	heatindex,
	feelslike,
	pressure_in,
	pressuretrend,
	weather,
	relhumidity,
	visibility,
	precip_today,
	wind,
	wind_dir,
	wind_degrees,
	wind_mph,
	wind_gust_mph) 
	VALUES
	('$weathercity',
	'$weatherlat',
	'$weatherlon',
	'$weatherzip',
	'$weatherstate',
	'$weatherdate',
	'$weatherhms',
	'$timeofday',
	'$temp_f',
	'$windchill',
	'$heatindex',
	'$feelslike',
	'$pressure_in',
	'$pressuretrend',
	'$weather',
	'$relhumidity',
	'$visibility',
	'$precip_today',
	'$wind',
	'$wind_dir',
	'$wind_degrees',
	'$wind_mph',
	'$wind_gust_mph'
	)")
	or die(mysql_error()); 

// THIS FUNCTION helped figure out what was actually in the json file
// print "<hr><hr>";
// print "contents of the json <br>";
// 
// 
// function jsonextract($inputjson)
// {
// 	$jsonIterator = new RecursiveIteratorIterator(
// 		new RecursiveArrayIterator(json_decode($inputjson, TRUE)),
// 		RecursiveIteratorIterator::SELF_FIRST);
// 	
// 	foreach ($jsonIterator as $key => $val) {
// 		if(is_array($val)) {
// 			echo "$key:\n <br>";
// 		} else {
// 			echo "$key => $val\n <br>";
// 		}
// 	}
// }

}

include "getwater.php";

?>