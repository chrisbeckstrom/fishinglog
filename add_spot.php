<?php
session_start();
?>
<link rel="stylesheet" type="css/text/css" href="css/style.css"/>
<?php

// include 'footer.php';
include 'config/config.php';
include 'config/connect.php';
include 'header.php';

$username = $_SESSION['myusername'];
$waterbodyid = $_GET['waterbodyid'];

	// if you're adding another spot to a trip
	$newtripnumber = $_GET['tripnumber'];


// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}

		
// SET THE STARTING MAP LOCATION BASED ON THE USER'S GPS
	$waterbodyquery = "
	SELECT * FROM waterbodies WHERE id = '$waterbodyid';
		";
	$waterbodyresults = mysql_query($waterbodyquery);
	// put into an array	
	$waterbodyarray = mysql_fetch_array($waterbodyresults);
	
	// save that into a variable
	$lat = $waterbodyarray['lat'];
	$lon = $waterbodyarray['lon'];
	$waterbodyname = $waterbodyarray['name'];
	
	//print "user home is $userhome";
	// $userlatlon = explode(",", $userhome);
	
	// print "waterbody lat and lon: $lat $lon<br>";
	// print "query is <pre>$waterbodyquery</pre><br>";

?>

<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<!-- Google map stuff -->
	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=false">
	</script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="css/jquery-gmaps-latlon-picker.css"/>
	<script src="js/jquery-gmaps-latlon-picker.js"></script>
	
	<!-- Show and hide things - function - CB -->
	<script type="text/javascript">
	function toggle(element) {
		document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
	}
	</script>
	
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />



<!----------------------------------------- BUILDING THE ACTUAL FORM -->
</head>

<body>
<? print $header ?>
<div id='main'>
    <nav>nav</nav>
    <aside>
    <box>	
		<? include 'php/recenttrips.php'; ?>
	</box>
	
	<box>
		<? include 'php/userphp/stats.php'; ?>
	</box>
	
	<box>
		<? include 'php/trips-ayearago.php'; ?>
	</box>
	
	</aside>
<article>
    	
<!-- this decides what happens when you submit the form -->
<form action="php/submit-newspot.php" method="get" target="_blank">
<br><br>

<box>
<h1><?php echo $waterbodyname ?></h1>	
	
</box>

<box>
	<h2>Add a spot</h2>
</box>
<box>
	
<!-- THE WATERBDOY ID -->
<input type="hidden" value="<?php echo $waterbodyid ?>" name="waterbodyid">
<h3>Spot name</h3>
<input type="text" class="input" name="name">

<!--
///////////////////////////////////////////////////////////////////////
//	GOOGLE MAP LAT/LON PICKER
///////////////////////////////////////////////////////////////////////
 MAP -->
	<fieldset class="gllpLatlonPicker">
		<!-- 
		<input type="text" class="gllpSearchField">
		<input type="button" class="gllpSearchButton" value="search for a place"> -->
		
		<div class="gllpMap" style="width: 100%; height: 50%">Google Maps</div>
		<br/>
		lat/lon:
			<input type="text" class="gllpLatitude" value="<?php print $lat ?>" name="lat"/>
			<input type="text" class="gllpLongitude" value="<?php print $lon ?>" name="lon"/>
		<!-- zoom: <input type="text" class="gllpZoom" value="3"/> -->
		<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
		<br/>
	</fieldset>
	<p>

<!--
///////////////////////////////////////////////////////////////////////
//	NOTES
///////////////////////////////////////////////////////////////////////
-->
<h2>Notes</h2>
	<!-- 
	<textarea style="width: 85%; height: 80px" name="notes" value="notes">
	</textarea>
	<p>
	 -->

<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
// TINY MCE editor
tinymce.init({
    selector: "textarea"
 });
</script>

<span class='smallinfo'>put your secret stuff in brackets</span>
<textarea style="width: 55%; height: 100px" name="notes" value="notes"></textarea>

<!-- ICON -->
<h2>Icon</h2>
		
<table class='table'>
    <tr>
    	<td><center><img src='http://maps.google.com/mapfiles/kml/paddle/red-stars.png'></center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/shapes/fishing.png'></center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/shapes/marina.png'></center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/shapes/sailing.png'></center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/paddle/ylw-stars-lv.png'></center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/shapes/cabs.png'</center></td>
        <td><center><img src='http://maps.google.com/mapfiles/kml/shapes/water.png'</center></td>
    </tr>
    <tr>
    	<td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/paddle/red-stars.png">Red</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/shapes/fishing.png">Fish</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/shapes/marina.png">Anchor</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/shapes/sailing.png">Sailboat</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/paddle/ylw-stars-lv.png">Yellow star</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/shapes/cabs.png">Car</td>
        <td><input class='checkbox' type="radio" name="icon" value="http://maps.google.com/mapfiles/kml/shapes/water.png">Water</td>
    </tr>
</table>

	
<!-- PRIVACY -->
<h2>Privacy</h2>
		<span class='smallinfo'>who can see this trip?</span><br>
		<!-- Privacy -->
		<select class='input' name="privacy">
		<option value="0" selected>0 - Public</option>
		<option value="1">1 - Users only</option>
		<option value="2" >2 - Friends only</option>
		<option value="3">3 - Private</option>
		</select>
		</formitem>
	

<!-- SUBMIT BUTTON -->
<center>

<input class="fancybutton" type="submit" value="add the spot" name="submit">
</box>
</center>
</form>

<?

?>
	
</body>
</html>
