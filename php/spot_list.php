
<?php
print "SPOT LIST<BR>";
// MAP LIST
$waterbodyid = 70;

include '../config/config.php';
include '../config/connect.php';

$spotsquery = 
	"SELECT *
	FROM spots 
	WHERE waterbody_id = '$waterbodyid'
	";
	
	print "query is: $spotsquery";
	
	$spotsresults = mysql_query($spotsquery);
	$num_rows = mysql_num_rows($spotsresults);
	
	if ( $num_rows == 0 )	// if there are no user maps...
	{
		print "";
	}
	else {	// if there ARE user maps...
	print "<box><h2>Spots</h2>";
			
	while($spots = mysql_fetch_array($spotsresults))
	{
	$spotusername = $spots['username'];
	$spotname = $spots['name'];
	$spotlat = $spots['lat'];
	$spotlon = $spots['lon'];
	$spoticon = $spots['icon_url'];
	
	print $spotname . "<br>";

	
	}
	print "</box>";
	}

?>