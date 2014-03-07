
<?php
// $waterbodyid = 70;

include '../config/config.php';
include '../config/connect.php';

$mapsquery = 
	"SELECT *
	FROM uploads 
	WHERE uploadtype = 'waterbody'
	AND waterbody_id = $waterbodyid
	";
	
	$mapsresults = mysql_query($mapsquery);
	$num_rows = mysql_num_rows($mapsresults);
	
	if ( $num_rows == 0 )	// if there are no user maps...
	{
		print "";
	}
	else {	// if there ARE user maps...
	print "<box><h2>User Maps</h2>";
			
	while($maps = mysql_fetch_array($mapsresults))
	{
	$mapusername = $maps['username'];
	$mapfilename = $maps['filename'];
	$mappath = $maps['uploaded_to'];
	
	//print "username: $username / path: $path - filename: $filename<br>";
	$kml_url = 'http://cb.hopto.org/log/uploads/' . $mapfilename;
	//print "kml url: $kml_url <br>";
	
	print "<a href='water.php?name=$waterbodyname&map=$kml_url'>$mapusername</a><br>";
	
	}
	print "</box>";
	}

?>