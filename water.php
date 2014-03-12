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

$waterbodyquery = "SELECT * 
FROM waterbodies 
WHERE name = '$waterbodyname'";

print "query is $waterbodyquery";

$waterbodyresult = mysql_query("
$waterbodyquery
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
	$waterbody = $waterbodyrow['name'];
	
	print "watertype is $waterbodyrow[watertype]<br>";

?>

<head>
<title><?php print "$waterbodyname | $sitename"; ?> </title>
</head>

<div id='main'>
		   <nav>nav</nav>
    <aside>

	<box>
<? 	//////////// WHO'S FISHED HERE box /////////////////////
	print "<h3>Who's fished here?</h3>";
	// get information about trips
	// that happened there
	$whofishedherequery = 
	"SELECT DISTINCT username
	FROM trips 
	WHERE waterbody like '%$waterbodyname%'
	AND watertype = '$watertype'
	AND state = '$state'";
	
	//print "looking for <pre>$whofishedherequery</pre>";
	
	$whofishedresults = mysql_query($whofishedherequery);

	$number_of_results = mysql_num_rows($whofishedresults);
	
	//print "results: $number_of_results<br> people have fished here <br><br>";


	print_r($whofishedthere);
	
			while($whofishedthere = mysql_fetch_array($whofishedresults))
			{
			$username = $whofishedthere['username'];
			//print "<a href='user.php?username=$username'>$username</a>" . " ";
			
				// get info about each friend VALUE=username
				$friendquery = "SELECT * FROM users WHERE username = '" . $username . "'";
				//print "$friendquery is: <pre>$friendquery</pre>";
				$friendresults = mysql_query($friendquery);
				
				while($friendrow = mysql_fetch_array($friendresults))
				{
					$avatarurl = $friendrow[useravatarurl];
					print "<a href='user.php?username=$friendrow[username]'><img title='$username' class='circular' height='40px' src='$avatarurl'></class></a>";
					//print "<a href='user.php?username=$friendrow[username]'>$friendrow[username]</a>";
				}
			
				}
		
				?>
	</box>
	
	<?php include 'sidebar.php'; ?>
	
	
	
	
	</aside>
		
    <article>
    	
<box>
  <?

// if no name sent as part of the URL, don't show anything
if (!isset($_GET['name']))
	{
		print "no waterbody selected";
		die;
	}
else
	{
	print "<h1>$waterbodyname</h1>";
	?>
	<?
	}

?>


<!-- THE SUBHEADING - waterbody basic info -->

	<? 
	print "<small>$watertype in $city, $state</small><br>";
	?>	
</box>


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
        height: 300px;
      }
    </style>

<?php 
$currentuser = $_SESSION['myusername'];

///// FIGURE OUT IF THERE IS A KML FILE TO USE ?????
// kml file= waterID_userID.kml
	// 	$kmlfile = $id . "_" . $currentuser . "." . "kml";
	// 	print "kml file: $kmlfile";
	// 	$kmlurl = "http://cb.hopto.org/log/kml/waterbodies/" . $kmlfile;
	// 	print "kml URL: $kmlurl";

?>    
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
    
  
var map;
function initialize() {
  var chicago = new google.maps.LatLng(41.875,-87.624)
    // the LAT and LON of this particular waterbody
   var waterbodyLatLng = new google.maps.LatLng(<?php echo $lat ?>,<?php echo $lon ?>)
  var mapOptions = {
    zoom: 13,
    center: waterbodyLatLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
      
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922)
 
   
  // the marker for the particular LAT and LON of this waterbody
   var marker = new google.maps.Marker({
      position: waterbodyLatLng,
      map: map,
      title: 'Hello World!'
   });
   
   // create a marker for each spot!
   
   <?php // some php 
   $spotsquery = 
	"SELECT *
	FROM spots 
	WHERE waterbody_id = '$waterbodyid'
	";
	
	$spotsresults = mysql_query($spotsquery);
	$num_rows = mysql_num_rows($spotsresults);
	
	if ( $num_rows == 0 )	// if there are no user maps...
	{
		print "";
	}
	else {	// if there ARE user maps...
			
	while($spots = mysql_fetch_array($spotsresults))
	{
	$spotusername = $spots['username'];
	$spotname = $spots['name'];
	$spotlat = $spots['lat'];
	$spotlon = $spots['lon'];
	$spoticon = $spots['icon_url'];


    ?>
   
	var markerLatLon = new google.maps.LatLng(<?php echo $spotlat ?>,<?php echo $spotlon ?>)   
      
      var marker = new google.maps.Marker({
      position: markerLatLon,
      animation: google.maps.Animation.DROP,
      map: map,
      title: 'Hello World!';
     
   });

   
   <?
   
   	}
	}
	
	?>

    
  var mapLayer = new google.maps.KmlLayer({
    url: '<?php echo $mapurl; ?>'	
    // apparently this has to be a full URL, not a filepath
  });
  
  mapLayer.setMap(map);
  
  
      
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<div id="map-canvas"></div>

</box>




<?
////////////////////////////////////////////////////////////////////////
/////////// SPECIES OF FISH HERE //////////
print "<box>";
print "<h3>Resident species</h3>";
	// IT WOULD BE COOL to search past trips and see what
	// fish were ACTUALLY caught there (i.e. "confirmed" species?)
	
	// this query goes and gets each distinct fishID of fish caught on trips at this water
	
	$fishcaughtquery = 
	"SELECT DISTINCT(fishcaught.fishID) 
	FROM fishcaught JOIN trips 
	ON trips.tripnumber=fishcaught.tripnumber 
	WHERE trips.waterbody = '$waterbody' AND trips.state = '$state'";

	$fishcaughtthereresults = mysql_query($fishcaughtquery);
	
	//print "<br>looking for <pre>$fishcaughtquery</pre>";
			
	//$fishcaughtthere = mysql_fetch_array($fishcaughtthereresults);
	
	$number_fish_caught = mysql_num_rows($fishcaughtresults);
	
	while($fishcaughtthere = mysql_fetch_array($fishcaughtthereresults))
	{
		//print "row: $fishcaughtthere[fishID] <br>";
		// get that fishID and convert it into a nice name
		$fishnamequery = "SELECT fishbase_name FROM fish WHERE fishID = '$fishcaughtthere[fishID]'";
		//print "fishnamequery is : $fishnamequery <br>";
		$fishnameresults = mysql_query($fishnamequery);
		while($fishname = mysql_fetch_array($fishnameresults))
			{
			// PRINT THE NAME OF THE FISH
			print "$fishname[fishbase_name]<br>";
			}
	
		}
print "</box>";
		
/////////// WATERBODY NOTES ////////////////
// 	print "<box>";
// 	print "<h3>Notes</h3>";
print "<box>";
print "<h3>Notes</h3>";
include 'disqus.php';
print "</box>";



?>
	</box>


</box>
</article>




