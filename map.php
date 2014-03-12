<?php
session_start();
error_reporting(0);

/* the idea with this page is it shows all the information
for a particular trip

>> just ONE trip <<

the content will be dynamically grabbed from the DB based on
the criteria submitted
for now we'll emulate that by setting the variables here
*/

//include 'php/security.php';

$tripnumber = $_GET["tripnumber"];

include 'header.php';
 // include 'footer.php';
include 'config/connect.php';
include 'php/disguise.php';

print "<link rel='stylesheet' href='css/style.css' type='text/css' />";

//print $header;

// if ($tripnumber == "" )	// tell us if there's no ID loaded
// 	{
// 	print "<debug='debug'>the \$tripnumber variable is null!</debug><br>";
// 	}
	
$mapquery = ("SELECT * FROM trips");
print "mapquery is : $mapquery<br>";

$result = mysql_query($mapquery);
		$num_rows = mysql_num_rows($result);
		print "results : $num_rows<br>";

	
	// take the data and put it into an array
	$row = mysql_fetch_array($result);
	
	// Things we want to show for each trip:
	$tripusername = $row['username'];
	
		// figure out who is viewing	
		$currentuser = $_SESSION['myusername'];
		
		if ( $currentuser == $tripusername )
			{	// if the user is viewing their own trip, show everything
				$hidethings = 0;
				$hidespots = 0;
			}
		else {	// if the user is viewing other people's trips, hide stuff
				$hidethings = 1;
				$hidespots = 1;
		}
	
	$tripdate = $row['date'];
	$tripnumber = $row['tripnumber'];
	$tripid = $row['tripid'];
	$public = $row['public'];
	$username = $row['username'];
	$userid = $row['userid'];
	$userrealname = 'Chris Beckstrom';
	$timefished = $row['time'];
	$lastupdate = $row['timestamp'];
	$city = $row['city'];
	
	$waterbody = $row['waterbody'];
	$notes = $row['notes'];
	if ( $hidethings == 1 )
		{
		// disuise anything in brackets
		$notes = disguiseBrackets($notes);
		}
	else {
		// remove the brackets from notes
		$notes = str_replace("[","",$notes);
		$notes = str_replace("]","",$notes);
	}
	$fishingmethod = $row['method'];
	$timeofday = $row['timeofday'];
	
	$weather = $row['weather'];
	$temp_f = $row['temp_f'];
	$wind_mph = $row['wind_mph'];
	
	$gaugeheight = $row['gaugeheight'];
	$discharge = $row['discharge'];
	$watercolor = $row['watercolor'];
	
	$latlon = $row['latlon'];
	$lat = $row['lat'];
	$lon = $row['lon'];
	
	///
	$next = $tripnumber + 1;
	$previous = $tripnumber - 1;
	///




include 'php/time.php';		// generate some nicer times to work with
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
  Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html;
    charset=utf-8"/>
    
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4"
      type="text/javascript"></script>
      
    <script type="text/javascript">
    //41.977     -88.016
    //<![CDATA[
    
    
    function load() {
      if (GBrowserIsCompatible()) {
      	var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(30,30));
        var map = new GMap2(
        document.getElementById("map"));
		map.setMapType(G_PHYSICAL_MAP);
		map.addMapType(G_PHYSICAL_MAP);
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl(), bottomRight);
        
        // SET THE MAP'S CENTER
        map.setCenter(new GLatLng(<?php echo "$lat, $lon" ?>), 15);
        
        // Create marker function
        function createMarker(point, text, title) {
          var marker =
          new GMarker(point,{title:title});
          GEvent.addListener(
          marker, "click", function() {
            marker.openInfoWindowHtml(text);
          });
          return marker;
       	 }
       	// end of marker function
        
        <?php
//     $lat = 42.422;
//     $lon = -88.066;
        
    // this array contains the lat/lon for the markers    
	$points = Array(
	1 => "$lat, $lon"
	);
	
	foreach ($points as $key => $point) 
	{
	?>
	var marker = createMarker(
	new GLatLng(<?php echo $point ?>),
	'<?php echo $lat . ", " . $lon ?>',
	'Example Title text <?php echo $key ?>');
	map.addOverlay(marker);
	<?php 
	} 
	?>
	// chris doesn't understand how this works
      }
    }
    
    //end
    </script>
    
    
    
    
  </head>
  
  
  
  
  
<!-- load the fancy schmancy google map -->
   <?
   if ( $hidespots == 0 )
{	?>

   <body onload="load()" onunload="GUnload()">
 

    <div id="map" style="width: 100%%; height: 100%; margin-top: 40px;"></div>

    
    <? } ?>
  
  </article>
  
      <!-- <nav>
    </nav> -->

<?
//////////// end of map

?>
