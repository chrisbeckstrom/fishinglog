<?php

/* the SPOT page
(copied and pasted from water.php)

this will be like the PLACE page for a SPOT

map, info, etc

*/

?>
<?
include 'config/config.php';
include 'config/connect.php';
include 'header.php';
include 'footer.php';
print $header;

$placename = $_GET['name'];


// go get the info about the specific body of water ($name)

$result = mysql_query("
SELECT * 
FROM spots 
WHERE name = '$placename'
		");
		
// take the data and put it into an array
$row = mysql_fetch_array($result);

// get all the variables WE DON'T NEED THIS SINCE iT"S JUST ONE!!
//while($row = mysql_fetch_array($result))
	//{
	
// these are things we care about on water.php:
$watertype = $row['watertype'];
$waterbody = $row['waterbody'];
$lat = $row['lat'];
$lon = $row['lon'];
$city = $row['city'];
$county = $row['county'];
$state = $row['state'];
$notes = $row['notes'];
$owner = $row['owner'];
$private = $row['private'];

//}

// THEN MAYBE WE CAN GET information about trips
// that happened there

$resultoo = mysql_query("
SELECT * 
FROM trips 
WHERE waterbody = '$placename'
		");
		
$rowtoo = mysql_fetch_array($resultoo);
// while($rowtoo = mysql_fetch_array($resultoo))
// {
// $tripdate = $rowtoo['date'];
// $tripnotes = $rowtoo['notes'];
// 
// print "<h3> Tripdate is $tripdate<br>
// 		notes are $notes";
// 	}

// is edit=true at the end of the url? if so, tell us!
$edit = $_GET['edit'];

	if ($edit === 'true')
	{
	print "<div id='debug'>editing is ON!</div><br>";
	}
	else
	{
	//print "<div id='debug'>editing is off</div><br>";
	}

$funky = "James Brown";
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
        var map = new GMap2(
        document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.setCenter(
        new GLatLng(<?php echo "$lat, $lon" ?>), 13);
        
        
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
        
        /*
  Busse Lake               | 42.0250281 | -88.009514 |
| Deep Lake                | 42.4227984 | -88.066192 |
| Salt Creek               |            |            |
| Happy Acres              | 41.977     | -88.016    |
| Lake Cosman              | 42.011     | -88.011    |
| Wood Dale Grove          | 41.941     | -87.976    |
| Secret Neighborbood Pond | 41.982     | -88.011    |
| Seymores pond pit        | 41.979     | -88.021 

*/
      	
//     $lat = 42.422;
//     $lon = -88.066;
    
//    $name = "Deep Lake";
//    $notes = "some information about happy acres";
        
    // this array contains the lat/lon for the markers    
	$points = Array(
	1 => "$lat, $lon"
	);
	
	foreach ($points as $key => $point) 
	{
	?>
	var marker = createMarker(
	new GLatLng(<?php echo $point ?>),
	'<?php echo $placename ?>',
	'Example Title text <?php echo $key ?>');
	map.addOverlay(marker);
	<?php } ?>
	
   /// chris tries to understand ///
        
        
      }
    }
    
    //end
    </script>
    
  </head>
<!-- load the fancy schmancy google map -->
   <body onload="load()" onunload="GUnload()">
    <div id="map" style="width: 400; height: 400"></div>
    
     <?php
// IF edit = true,
// 			then replace all the info with pre-filled text fields
// IF edit != true,
//			just give it to us normal


		?>
    
    <div class='waterinfo'>
<?php 

// make things EDITABLE if editing is on
if ( $edit == true )	// editing ON
{
	print "<form class='not' action='updatewater.php' method='post'>";
	$wbtitle = "<input id='newplacename' name='newplacename' type='text' value='$placename'/>";
	
	$wbwatertype = "<input id='newwatertype' name='newwatertype' type='text' value='$watertype'/>";
	$wbcity = "<input id='newcity' name='newcity' type='text' value='$city'/>";
	$wbcounty = "$county, ";
	$wbstate = "$state <br><br>";
	$wbnotes = "<div id='notes'>
				<textarea id='newnotes' value='newnotes' rows='4' width='20'>$notes</textarea>
				</div><br>";
}
	else				// editing OFF
{
	$wbtitle = "<h2>$placename</h2>";
	$wbwatertype = "<i>on $waterbody ($watertype)</i><br>";
	$wbcity = "$city, ";
	$wbcounty = "$county, ";
	$wbstate = "$state <br><br>";
	$wbnotes = "<div id='notes'>
				$notes
				</div><br>";
}

	
// print out information about this body of water
print $wbtitle;
print $wbwatertype; 
print $wbcity;
print $wbcounty;
print $wbstate;
print $wbnotes;


// if EDITING IS TURNED ON create a SUBMIT button
	if ( $edit == true ) 	// editing on
	{
	print "<div class='submit'>	
	<input type='submit' value='update'>";		
	}

?>


<!--  ORIGINAL WATERBOX INFO STUFF
    <? print "<h2>$placename</h2>
    <input id='waterbodyname' name='waterbodyname' type='text' value='$placename'/>
    <i>$watertype</i><br>
    $city, $county $state <br><br>
    <div id='notes'>
    $notes</div> <br>
    $lat , $lon <br>
    $gunnel<br>"; ?>
 -->
    
</div>
    
  </body>
</html>