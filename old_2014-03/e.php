<link rel='stylesheet' href='style.css' type="text/css" />

<?php
include 'config.php';

// CONNECT TO THE SERVER
$con = mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!");
if (!$con)
  {
  die('Oops, could not connect: ' . mysql_error());	// error message
  }
  
// Choose the database
	mysql_select_db("fishingtrips", $con);	

$result = mysql_query("		
SELECT weather.weathercity, weather.pressure_in, weather.weatherdate, weather.wind, weather.wind_gust_mph, weather.windchill, weather.wind_mph, weather.weatherhms, weather.temp_f, weather.weather, weather.pressuretrend,
waters.sitename, waters.gaugeheight
FROM weather, waters
WHERE weather.weathercity = 'Itasca'
AND waters.stationid = '05531175'
ORDER BY weather.weather_id DESC # sort descending by weather_id, showing us the most recent one
LIMIT 1");
							
	// take the data and put it into an array
	$row = mysql_fetch_array($result);
		
	
//print_r($row);

print $header;


print "<br>";
print "<div id='wrap'>";
print "<div id='tripbox'>";
print "<h1> Current conditions for " . $row['weathercity'] . "</h2><br>";
print "Date: " . $row['weatherdate'] . "<br>";
print "<i>last updated: " . $row['weatherhms'] . "</i><br>";
print "Temp: " . $row['temp_f'] . "&#176;F<br>";
print "Windchill: " . $row['windchill'] . "&#176;F<br>";
print "Wind: " . $row['wind'] . " " . $row['wind_mph'] . " mph<br>";
print "Wind gust: " . $row['wind_gust_mph'] . " mph<br>";
print "Pressure: " . $row['pressure_in'] . " in<br>";
print "Pressure trend: " . $row['pressuretrend'] . "<BR>";
print "Conditions: " . $row['weather'] . "<br><br>";
print "<div id='debug'><i> this data originally from wunderground.com and http://waterservices.usgs.gov/,<br>
but loaded from mysql.cbfishes.com</i></div><br><br>";
print "<div id='waterbox'>";
print "<b><center><a href='http://waterdata.usgs.gov/usa/nwis/uv?05531175'>Salt Creek @ Irving Park Road</a></b><br>";
print "Gauge height: " . $row['gaugeheight'] . " feet<br><br>";
print "<img src='http://il.water.usgs.gov/data/webcams/05531175/05531175.jpg'> <br>
	<i>testing: the time on this image originally said 8:39:48.. will it update?<br><br></i>"; 
	
print "<img src='http://137.227.232.137/nwisweb/data/img/USGS.05531175.02.00065..20130110.20130117..0..gif'><br>
	<i>not sure if this image will update...</i></div></div></div></center>"; 
	// other images:
	// 			 http://137.227.241.67 /nwisweb/data/img/USGS.05531175.02.00065..20130110.20130117..0..gif



print $footer;






















?>