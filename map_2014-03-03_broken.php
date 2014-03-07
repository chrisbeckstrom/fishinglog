<?php
session_start();
/* 
MAP!!
*/
error_reporting(0);

?>

<?
include 'config/config.php';
include 'config/connect.php';
include 'header.php';
print "<link rel='stylesheet' href='css/style.css' type='text/css' />";
print $header;

if(isset($_SESSION['myusername']))
	{
	print "";
	}
	else
	{
	print "<br><br><br>You gotta log in to see that!";
	header( 'Location: login.php?message=You gotta log in to do that!' );
	die;
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
  Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
  <?
      $lat = 42.422;
    $lon = -88.066;
    ?>
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
		
		var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(30,30)); // creates a new position
		
		var map = new GMap2(	// creates the map
			document.getElementById("map"));
			map.setMapType(G_PHYSICAL_MAP);
			map.addMapType(G_PHYSICAL_MAP);		// adds TERRAIN as an option 
			map.addControl(new GLargeMapControl());
			map.addControl(new GMapTypeControl(), bottomRight);
			map.setCenter(
			new GLatLng(<?php echo "42.864909,-85.628303" ?>), 10);

        // Create 'create marker' function
        function createMarker(point, text, title, icon) {
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
	SELECT tripid, latlon, date, notes 
	FROM trips
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
			$id = $row['tripid'];
			$idis = 'id is';
			$waterbody = $row['waterbody'];
			?>
	var url = "<a href='viewtrip.php?tripnumber=<? echo $id ?>'> <? echo $date ?> </a>";
	var id = "<? echo $id ?> ";
	var name = "<? echo $name ?>";
	var con = id.concat(id,name);
	var popuptext = url;
	var text = popuptext;	// text in the popup box
	var fishIcon = 'http://maps.google.com/mapfiles/kml/shapes/fishing.png';
	
	var marker = createMarker(
		new GLatLng(<?php echo $latlon ?>), // this is the POINT
								text,		// this is the TEXT
								'<? echo $latlon ?>');	// how the heck does this work?
	
	
	map.addOverlay(marker);
	<?php }} ?>

        
      }
    }
    
    //end
    </script>
    
  </head>
  
 
  
<!-- load the fancy schmancy google map -->
   <body onload="load()" onunload="GUnload()">


 <div id="map" 
    style="
    width: 100%; 
    height: 100%;
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