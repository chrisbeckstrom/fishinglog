<?

/* NICE LAT LON

This script goes through the
WATERBODIES table and grabs each water's lat
and lon, combines them (i.e. 78.98, -98.34)
and then adds that new value to the latlon column

*/


// connect to the database
include 'config.php';
include 'connect.php';

	$result = mysql_query("
	SELECT name, lat, lon
	FROM trips
			");
			
// get all the lats and lons
while($row = mysql_fetch_array($result))
	{

	// these are things we want
	$tripdate = $row['date'];
	
	$name = $row['name'];
	$lat = $row['lat'];
	$lon = $row['lon'];
	$latlon = $row['lat'] . ", " . $row['lon'];
	
	print "$name <BR>
			$lat, $lon <BR>";
			
	// combine those two values together		
	$latlon = $lat . ", " . $lon;
			
	print "<b> the LATLON is $latlon<br>";
	
	mysql_query("
	UPDATE waterbodies
	SET latlon='$latlon'
	WHERE lat='$lat'
	AND lon='$lon'
	");
	
	
	
	//
	
	// UPDATE waterbodies
	// SET latlon='$latlon'
	// WHERE lat='$lat'
	// AND lon='$lon'
	// 
	// 
	// UPDATE waters SET timeofday='noon' WHERE timeofday='

	}