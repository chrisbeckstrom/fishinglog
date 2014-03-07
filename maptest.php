<?php
/* MAPTEST
learning how to use Google Maps API
I believe this one uses v2

got info from here:
http://minimizr.com/blog/2006/10/minimal-how-to-use-google-maps-api-with-php/

*/

include 'config.php';
include 'connect.php';
include 'header.php';
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


    //<![CDATA[
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(
        document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.setCenter(
        new GLatLng(41.977, -88.016), 13);
        
        
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
        
        
        
    
     	
    $lat = 41.977;
    $lon = -88.016;
    $name = "Happy Acres";
    $notes = "some information about happy acres";
    
    $row = mysql_fetch_array($result);
	$result = mysql_query("
	SELECT latlon
	FROM spots
			");
			
    // this array contains the lat/lon for the markers    
	$points = Array(
	1 => "$lat, $lon",
	2 => "41.979, -88.021",
	3 => "41.945, -88.028",
	4 => "42.051422, -87.877044",
	5 => "41.926574, -88.058662"
		);
		
	// KEY = ['thisthing']
	// VALUE is = 'this thing'
	
$points = Array(1 => "37.4389, -122.1389",
2 => "37.4419, -122.1419",
3 => "37.4449, -122.1449");
foreach ($points as $key => $point) {
?>
var marker = createMarker(
new GLatLng(<?php echo $point ?>),
'Marker text <?php echo $key ?>',
'Example Title text <?php echo $key ?>');
map.addOverlay(marker);
<?php } ?>
		

        
        
      
    }
    
    //end
    </script>
    
  </head>
  
<? print $header; ?>  
  
  <body onload="load()" onunload="GUnload()">
    <div id="map"
    style="width: 100%; height: 750"></div>
  </body>
</html>