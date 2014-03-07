<?php
session_start();

// Waterbody page (take 2)
// this is like a "place page" for a body of water
// depending on permissions, you may only be able to see the name of the waterbody

?>
<link rel='stylesheet' href='css/style.css' type="text/css" />

<script>
// CHANGEHTML function
// go find an HTML element with the id "id" and change it to "newtext"

function changeHTML(id,newtext)
{
	document.getElementById(id).innerHTML=newtext
}		
</script>

<?
include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print "$header";

$waterbodyname = $_GET['name'];
$edit = $_GET['edit'];

// if there is a map URL in the GET...
if (isset($_GET['map']))
	{
		$mapurl = $_GET['map'];
	}


// go get the info about the specific body of water ($waterbodyname)

$waterbodyresult = mysql_query("
SELECT * 
FROM waterbodies 
WHERE name = '$waterbodyname'
		");
		
// take the data and put it into an array
$waterbodyrow = mysql_fetch_array($waterbodyresult);

// get all the variables WE DON'T NEED THIS SINCE iT"S JUST ONE!!
//while($row = mysql_fetch_array($result))
	//{
	
// these are things we care about on water.php:
$watertype = $waterbodyrow['watertype'];
$lat = $waterbodyrow['lat'];
$lon = $waterbodyrow['lon'];
$city = $waterbodyrow['city'];
$county = $waterbodyrow['county'];
$state = $waterbodyrow['state'];
$notes = $waterbodyrow['notes'];
$owner = $waterbodyrow['owner'];
$species = $waterbodyrow['species'];
$privacy = $waterbodyrow['privacy'];
$creator = $waterbodyrow['creator'];
$id = $waterbodyrow['id'];
	$waterbodyid = $id;



?>
 
<!-- MAP -->
	<!-- GOOGLE MAPS API map -->
<script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4"
      type="text/javascript"></script>
<box>      
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>

<?php 
$currentuser = $_SESSION['myusername'];
// kml file= waterID_userID.kml
$kmlfile = $id . "_" . $currentuser . "." . "kml";
print "kml file: $kmlfile";
$kmlurl = "http://cb.hopto.org/log/kml/waterbodies/" . $kmlfile;
print "kml URL: $kmlurl";

?>    


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
    
  
var map;
function initialize() {
  var chicago = new google.maps.LatLng(41.875,-87.624)
    // the LAT and LON of this particular waterbody
   var waterbodyLatLng = new google.maps.LatLng(chicago)
  var mapOptions = {
    zoom: 8,
    center: chicago,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
      
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922)
 
   
  // the marker for the particular LAT and LON of this waterbody
   var marker = new google.maps.Marker({
				      position: <?php echo "new google.maps.LatLng(42.875,-87.624)" ?>,
				      map: map,
				      title: 'Hello World!',
				      icon: 'http://maps.google.com/mapfiles/kml/shapes/fishing.png',
					   });
					   
	   var newMarker = new google.maps.Marker({
				      position: <?php echo "new google.maps.LatLng(41.875,-87.624)" ?>,
				      map: map,
				      title: 'Hello World!',
				      icon: 'http://maps.google.com/mapfiles/kml/shapes/fishing.png',
					   });	
					   
	function newMarker(latlng,title,icon) {
		var aNewMarker = new google.maps.Marker(
			{
			position: new googlemaps.LatLng(latlng),
			map: map,
			title: title,
			icon: icon
			}
			);
			
			return aNewMarker
		}
		
	newMarker('41.875,-87.724','newest','http://maps.google.com/mapfiles/kml/shapes/fishing.png')
	console.log('newMarker has run')
			  
   



      
  
}
console.log('initializing the window')
google.maps.event.addDomListener(window, 'load', initialize);



    </script>

    
    

<div id="map-canvas" style="width: 100%; height: 100%; position:fixed; margin: 10px;"></div>





