<?php
// This little script gets a CITY and WATERBODY, and uses that to search
// the STREAMFLOW table to find the sitename and site ID of a USGS gauge station

// gets: $waterbody, $city
// outputs: $site_no

// session_start();

include 'config/config.php';
include 'config/connect.php';

print "<b>----- findgauge.php ----</b><br>";
		$logthis = "\n -- starting findgauge.php --";
		fwrite($fh, $logthis);

// Input: City, state, zip(?)
// returns: streamflow gauge ID and sitename

// $city = 'Alaska';
// $waterbody = 'Thornapple River';

// the FIRST query (including CITY)
print "<br> looking for $waterbody near $city<br>";
		$logthis = "\n looking for $waterbody near $city";
		fwrite($fh, $logthis);

$query = "SELECT site_no, station_nm
FROM streamflow
WHERE station_nm
LIKE '%$waterbody%'
AND station_nm
LIKE '%$city%'";

print "the query is <pre>$query</pre>";
		$logthis = "\n the query is $query";
		fwrite($fh, $logthis);
		
$result = mysql_query($query);
$count = mysql_num_rows($result);
print "<br> result count: $count<br>";
		$logthis = "\n result count: $count";
		fwrite($fh, $logthis);

// if we don't get any results, do another query without a city!
if ( $count == '0' )
	{
	print "<br> count is ZERO! <br>";
			$logthis = "\n count is ZERO! trying a new query...";
			fwrite($fh, $logthis);
			
	// the SECOND query (no city)
	$newquery = "SELECT site_no, station_nm
				FROM streamflow
				WHERE station_nm
				LIKE '%$waterbody%'";
				
				print "the NEWquery is <pre>$newquery</pre>";
						$logthis = "\n the new query is $newquery";
						fwrite($fh, $logthis);
				
				$result = mysql_query($newquery);
				$count = mysql_num_rows($result);
				print "<br> newqueryresult count: $count<br>";
						$logthis = "\n the newqueryresult count is: $count";
						fwrite($fh, $logthis);
	}
	
// take the data and put it into an array
$row = mysql_fetch_array($result);

// Things we want to show for each trip:
$station_nm = $row['station_nm'];
$site_no = $row['site_no'];

print "old site no is $oldsite_no";
		$logthis = "\n old site number is: $oldsite_no";
		fwrite($fh, $logthis);
		
// $better_site_no = "0" . $oldsite_no;
// $site_no = preg_replace('/\s+/', '', $better_site_no);

print "
Site number: $site_no <br>
Station name: $station_nm";

		$logthis = "\n site number: $site_no station name: $station_nm";
		fwrite($fh, $logthis);
		
		
// 	}

$logthis = "\n -- end of findgauge.php --";
fwrite($fh, $logthis);

?>

