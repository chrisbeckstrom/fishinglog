<?php  

include 'config/connect.php';

$result = mysql_query("SELECT * 
							FROM trips,weather 
							WHERE tripdate = '2012-05-10'
							AND weather.timeofday=trips.timeofday
							AND weather.weathercity='Itasca'

	
	
	ORDER BY tripdate DESC");
	
// take the data and put it into an array
	$row = mysql_fetch_array($result);
	
	print "<HR> array results <BR>";
	
	print $row['relhumidity'];
	
	print "<hr>";
    
    
    
?>