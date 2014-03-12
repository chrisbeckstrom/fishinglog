<?php
session_start();
?>
<head>
<link rel="image_src" 
      type="image/jpeg" 
      href="http://upload.wikimedia.org/wikipedia/commons/c/c9/Hudson_river_from_bear_mountain_bridge.jpg" />
      </head>
<!-- FACEBOOK BUTTON CODE -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=476877392396581";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- TUMBLR BUTTON CODE -->
<script src="http://platform.tumblr.com/v1/share.js"></script>

<?
/* VIEW A TRIP
the idea with this page is it shows all the information
for a particular trip

>> just ONE trip <<

the content will be dynamically grabbed from the DB based on
the criteria submitted
for now we'll emulate that by setting the variables here
*/

//include 'php/security.php';

///// SETUP THE PAGE /////////
print "<link rel='stylesheet' href='css/style.css' type='text/css' />";

$tripnumber = $_GET["tripnumber"];

include 'header.php';
 // include 'footer.php';
include 'config/connect.php';
include 'php/disguise.php';

print $header;

if ($tripnumber == "" )	// tell us if there's no ID loaded
	{
	print "<debug='debug'>the \$tripnumber variable is null!</debug><br>";
	}
	
	
//////////// GET INFO FROM THE DB ABOUT THIS PARTICULAR TRIP(number)
	$result = mysql_query("
	SELECT *
	FROM trips
	WHERE tripnumber = $tripnumber
			");
	
// take the data and put it into an array
	$row = mysql_fetch_array($result);

// Things we want to show for each trip:
	$tripusername = $row['username'];

// figure out who is viewing	
	$currentuser = $_SESSION['myusername'];
	
// hide things that should be hidden depending on who is viewing
// 	if ( $currentuser == $tripusername )
// 		{	// if the user is viewing their own trip, show everything
// 			$hidethings = 0;
// 			$hidespots = 0;
// 		}
// 	else {	// if the user is viewing other people's trips, hide stuff
// 			$hidethings = 1;
// 			$hidespots = 1;
// 	}
	
	
// MAKE EVERYTHING INTO NICER VARIABLES
// ****** this isn't necessary because tripinfo.php does it ********//
	// 	$tripdate = $row['date'];
	// 	$tripnumber = $row['tripnumber'];
	// 	$tripid = $row['tripid'];
	// 	$public = $row['public'];
	// 	$username = $row['username'];
	// 	$userid = $row['userid'];
	// 	$userrealname = 'Chris Beckstrom';
	// 	$timefished = $row['time'];
	// 	$lastupdate = $row['timestamp'];
	// 	$city = $row['city'];
	// 	$waterbody = $row['waterbody'];
	// 	$notes = $row['notes'];
	// 	$fishingmethod = $row['method'];
	// 	$timeofday = $row['timeofday'];
	// 	$weather = $row['weather'];
	// 	$temp_f = $row['temp_f'];
	// 	$wind_mph = $row['wind_mph'];
	// 	$gaugeheight = $row['gaugeheight'];
	// 	$discharge = $row['discharge'];
	// 	$watercolor = $row['watercolor'];
	// 	$latlon = $row['latlon'];
	// 	$lat = $row['lat'];
	// 	$lon = $row['lon'];
	
	
//// should we obscure things? ($hidethings = 1)	
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

$next = $tripnumber + 1;
$previous = $tripnumber - 1;

// generate some nicer times to work with
	include 'php/time.php';		

////////////////////// BUILD THE ACTUAL PAGE (info about the trip) /////////////////////////////////
?>

<div id='main'>
   	<article>
    	
<?
include 'php/privacy.php';
	//////////////////// THIS IS WHERE EVERYTHING BUT THE MAP COMES FROM //
	include 'tripinfo.php';
	// includes info, fish caught, weather, streamflow information, notes


// END THE TRIP BOX ////////////////////////////////////////////////////////////////

?>

<title>
<?php 

if ( $hidethings == 1 )
	{
	$waterbody = '[redacted]';
	}
print "$username @ $waterbody | $sitename"; ?>
</title>
<!-- ////////////////////////////////  LOAD THE FANCY GOOGLE MAP -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
  Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html;
    charset=utf-8"/>
    
    <!-- <title>Google Maps JavaScript API Example</title> -->
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
        map.setCenter(
        new GLatLng(<?php echo "$lat, $lon" ?>), 15);
        
        
        
        
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
	<?php } ?>
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
 
   	<box>
   		<center>
    <div id="map" style="width: 95%; height: 400"></div>
    	</center>
    </box>
    
    <?php } 


print "<box>";
include 'disqus.php';
print "</box>";


    ?>
    

  
  </article>
  
      <!-- <nav>
    </nav> -->
    
    <aside>    	
		<?php include 'sidebar.php'; ?>
		
		<box>
			<h3>Share this</h3>
			
			<? $tweettext = $username . ' logged a fishing trip!';
				$shareurl = 'http://cb.hopto.org/log/viewtrip.php?tripnumber=' . $tripnumber; ?>
				
			<!-- FACEBOOK SHARE -->
			<div class="fb-share-button" data-href="<?php echo $shareurl ?>" data-type="button_count"></div>

			<!-- TWITTER SHARE -->
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $shareurl ?>" data-text="<?php echo $tweettext ?>" data-via="cbfishes">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>   
	   
   			<!-- TUMBLR SHARE -->
			<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode($shareurl) ?>&name=<?php echo urlencode($tweettext) ?>&description=<?php echo urlencode() ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url('http://platform.tumblr.com/v1/share_2.png') top left no-repeat transparent;">Share on Tumblr</a>
			
	</aside>

<?
//////////// end of map
print "</div>
<footer>here's the footer</footer>";

?>



