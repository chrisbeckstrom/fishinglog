<?php

/* CB'S GET PAST WEATHER SCRIPT
access Wunderground's API and get weather information for a
particular time and place
*/

// input: $date (YYYY-MM-DD), $zip, $timeofday
// outputs: $temp, $hum, $wspdi, $wgusti, $wdir, $pressure, $conds, $metar

include 'config/config.php';
include 'config/connect.php';

$wunderground_key = "681a9b949662ace6";

// get the date (YYYY-MM-DD) and make it YYYYMMDD
$date = str_replace('-', '', $date);


print "<b> ----- getweather_new.php ---------</b><br>";

		$logthis = "\n -- starting getweather_new.php --";
		fwrite($fh, $logthis);
		
print "looking for weather<br>
	date: $date<br>
	zip: $zip<br>
	time of day: $timeofday";
	
		$logthis = "\n looking for weather \n
					date: $date \n
					zip: $zip \n
					time of day: $timeofday";
		fwrite($fh, $logthis);


// get 
switch ($timeofday)
{
case "morning":
  echo "time of day is mornin'";
  $ob = 1;
  break;
case "noon":
  echo "time of day is noontime";
  $ob = 15;
  break;
case "afternoon":
  echo "time of day is PM son!";
  $ob = 17;
  break;
case "evening":
  echo "time of day is EVENIN'";
  $ob = 21;
  break;
case "night":
  echo "time of day is the nighttime";
  $ob = 21;
  break;
default:
  echo "time of day didn't match anything, using noon";
  $ob = 15;
}


$weatherurl = "http://api.wunderground.com/api/$wunderground_key/history_$date/q/$zip.json";
print "<br>The URL we're using now is <br><pre>$weatherurl</pre><BR>";
		$logthis = "\n weather URL: $weatherurl";
		fwrite($fh, $logthis);

// load the json file from wunderground
$weather = file_get_contents($weatherurl);
$result = json_decode($weather);

// things we want to record (weather history)
$temp = $result->history->observations[$ob]->tempi;
$hum = $result->history->observations[$ob]->hum;
$wspdi = $result->history->observations[$ob]->wspdi;
$wgusti = $result->history->observations[$ob]->wgusti;
$wdir = $result->history->observations[$ob]->wdire;
$pressure = $result->history->observations[$ob]->pressurei;
$conds = $result->history->observations[$ob]->conds;
$metar = $result->history->observations[$ob]->metar;

if ( $wgusti == '-9999.0' )
	{
	$wgusti = 0;
	}

print "the temp was $temp degrees F<br>
	the humidity was $hum%<br>
	wind speed was $wspdi mph<br>
	wind gusts were $wgusti mph<br>
	wind direction was $wdir<br>
	pressure was $pressure<br>
	conditions were $conds<br>
	metar was $metar
	";
	
		$logthis = "\n here's what we found: \n
			temp: $temp degrees F \n
			humidity: $hum \n
			wind speed $wspdi \n
			wind gusts $wgusti \n
			wind direction: $wdir \n
			pressure: $pressure \n
			metar: $metar";
		fwrite($fh, $logthis);

		$logthis = "\n -- end of getweather_new.php --";
		fwrite($fh, $logthis);
?>