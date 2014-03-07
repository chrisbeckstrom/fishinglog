<?php
session_start();
// Add a new waterbody (july 2013)
//	this form adds a new waterbody to the waterbody database

?>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?
include 'config/config.php';
include 'config/connect.php';
include 'header.php';

// FIGURE OUT WHO IS VIEWING THIS
$username = $_SESSION['myusername'];
// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to add a new water body!";
	header( 'Location: login.php' );
	}

// DO WE WANT TO PRE-FILL OUT SOME OF THE FIELDS?
	// if the waterbody name is being passed as a URL argument...
if (isset($_GET['name']))
{
	$prefill = 1;	
	$name = $_GET['name'];
	$watertype = $_GET['watertype'];
	$waterlat = $_GET['lat'];
	$waterlon = $_GET['lon'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$county = $_GET['county'];
}
else
	{
	// otherwise, don't worry about it
	$prefill = 0;
	}

// SET THE STARTING LOCATION BASED ON THE USER'S GPS
if ( $prefill == 1 )
	{
	// set the map starting point based on the waterbody latlon
	$userlatlon = $lat . "," . $lon;
	}
else 
	{
	// set the map starting point based on the USER'S home location
	$userhomequery = mysql_query("
	SELECT gps FROM users WHERE USERNAME = '$username';
		");
	// put into an array	
	$userhomearray = mysql_fetch_array($userhomequery);
	
	// save that into a variable
	$userhome = $userhomearray['gps'];
	
	//print "user home is $userhome";
	$userlatlon = explode(",", $userhome);
	//print " user lat is $userlatlon[0] and user lon is $userlatlon[1]";
	}
?>

<!-- FOR THE GOOGLE EARTH LOCATION PICKER -->
<head>	
	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=false">
	</script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="css/jquery-gmaps-latlon-picker.css"/>
	<script src="js/jquery-gmaps-latlon-picker.js"></script>
	
	<!-- Show and hide things - function - ? -->
	<script type="text/javascript">
	function toggle(element) {
		document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
	}
	</script>

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
    	
<!-- THE FORM -->
<!-- this decides what happens when you submit the form -->
<? if ( $prefill == 1 )
	{
		// if the waterbody was already created when the user logged the trip..
		// there will already be a row in the waterbodies table.. so use
		// a different .php to UPDATE
		?>
		<form action="php/update-waterbody.php" method="get" target="_blank">
		<?
	}
else
	{
		// if the waterbody isn't created yet at all, we'll want to create it
		?>
		<form action="php/submit-newwaterbody.php" method="get" target="_blank">
		<?
	}

//print "prefill = $prefill<br>"; ?>
<formitem>
  <label for="waterbodyname">Waterbody name </label>
  <? if ( $prefill == 1 )
  {
  	$waterbodyvalue = $name;
	$lat = $waterlat;
	$lon = $waterlon;
  }
else
	{
	$lat = $userlatlon[0];
	$lon = $userlatlon[1];
	}
?>	
  <input class='longinput' id='waterbodyname' name='waterbodyname' value='<?php print $waterbodyvalue ?>'/>
</formitem>
		

<!--
///////////////////////////////////////////////////////////////////////
//	GOOGLE MAP LAT/LON PICKER
///////////////////////////////////////////////////////////////////////
 MAP -->
 
 
	<fieldset class="gllpLatlonPicker">
		<!-- 
<input type="text" class="gllpSearchField">
		<input type="button" class="gllpSearchButton" value="search for a place">
 -->
		<br/><br/>
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
	
<formitem>Water type
		<select class='input' name="watertype">
		<option value="river" selected>river</option>
		<option value="creek">creek</option>
		<option value="pond" >pond</option>
		<option value="lake">lake</option>
		</select>
		</formitem>
		<br>
		
					<formitem>
		  <label for="longinput">Species </label>
		  <input class='longinput' id="species" name="species"/>
		</formitem>
		<br>
		
			<formitem>
		  <label for="lures">Lures </label>
		  <input class='longinput' id="lures" name="lures"/>
		</formitem>
		<br>
	
		
<!--
///////////////////////////////////////////////////////////////////////
//	NOTES
///////////////////////////////////////////////////////////////////////
-->
Notes
<!-- 
<textarea style="width: 85%; height: 80px" name="notes" value="notes">
</textarea>
<p>
 -->

 <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>

<span class='smallinfo'>put your secret stuff in brackets</span>
<textarea style="width: 55%; height: 100px" name="notes" value="notes"></textarea>

<formitem>Privacy level
		<select class='input' name="privacy">
		<option value="0" selected>0 - public</option>
		<option value="1">1 - site only</option>
		<option value="3" >3 - friends only</option>
		<option value="4">4 - private</option>
		</select>
		</formitem>
		<br>

<!-- SUBMIT BUTTON -->
<center>

<input class="fancybutton" type="submit" value="submit" name="submit">
</box>
</center>
</form>

