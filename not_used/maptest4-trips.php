<?php
session_start();
/* 

*/

?>
<?
include 'config/config.php';
include 'config/connect.php';
// include 'header.php';
// include 'footer.php';
print "<link rel='stylesheet' href='$stylesheet' type='text/css' />";
//print $header;

// include 'php/security.php';

// who is this?
$username = $_SESSION['myusername'];

// get the current user's "home" GPS (GPS row in "users")
		$result = mysql_query("
			SELECT GPS FROM users WHERE username = '$username'");
		$row = mysql_fetch_array($result);
		$gps = $row['GPS'];
		$latandlon = explode(",", $gps);
		$lat = $latandlon[0];
		$lon = $latandlon[1];
print "the GPS for $username is $gps, and lat = $lat and lon = $lon";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
  Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
  <?
      //$lat = 42.422;
    //$lon = -88.066;
    ?>
    <meta http-equiv="content-type" content="text/html;
    charset=utf-8"/>
    
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=false"
      type="text/javascript"></script>
      
    <script type="text/javascript">
    //41.977     -88.016
    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
		var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(30,30)); // creates a new position
		var map = new GMap2(	// creates the map
		document.getElementById("map"));
		map.setMapType(G_PHYSICAL_MAP);
		map.addMapType(G_PHYSICAL_MAP);		// adds TERRAIN as an option 
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl(), bottomRight);
		map.setCenter(
		new GLatLng(<?php echo "35,42" ?>), 10);
		
        
        
        // Create 'create marker' function
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
// grab info from the DB
$result = mysql_query("
	SELECT latlon
	FROM waterbodies
	WHERE latlon != ''
	 ;
			");
			
// get all the lats and lons
$row = mysql_fetch_array($result);

// URL for a trip syntax:
// http://cbfishes.com/log/viewtrip.php?trip_id=200




while($row = mysql_fetch_array($result))
	{
	
	
		foreach ($row as $key => $point) 
			{
			$latlon = $row['latlon'];
			$name = $row['name'];
			$notes = $row['notes'];
			$date = $row['date'];
			$nameplus = str_replace(" ","+",$name);
			$url = "<a href='water.php?name=$nameplus'>$name</a>";
			$google = '<a href="http.google.com">"$name"</a>';
			$id = $row['tripnumber'];
			$idis = 'id is';
			$waterbody = $row['waterbody'];
			?>
	var url = "<a href='viewtrip.php?tripnumber=<? echo $id ?>'> <? echo $date ?> </a>";
	var id = "<? echo $id ?> ";
	var name = "<? echo $name ?>";
	var con = id.concat(id,name);
	var popuptext = url;
	var text = popuptext;	// text in the popup box
	var marker = createMarker(
	new GLatLng(<?php echo $latlon ?>), // this is the POINT
				
	text,		// this is the TEXT
	'<? echo $latlon ?>');
	
	
	map.addOverlay(marker);
	<?php }} ?>

        
      }
    }
    
    //end
    </script>
    
  </head>
  
 
  
<!-- load the fancy schmancy google map -->
   <body onload="load()" onunload="GUnload()">

   
    
     <?php

		?>
<?php 


?>
 <div id="map" 
    style="
    
    width: 200px; 
    height: 200px;
    position:fixed;
    margin: 10px;
    
    
    "></div>
    



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