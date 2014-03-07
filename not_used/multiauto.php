<?php
session_start();
/* This is the LOG A TRIP form! */
?>
<link rel="stylesheet" type="text/css" href="style.css"/>
<?php

include 'header.php';
include 'footer.php';
include 'config/connect.php';

// if the MYUSERNAME is not set, redirect to the login page
	// if(isset($_SESSION['myusername']))
		// {
		// print "";
		// }
		// else
		// {
		// print "You gotta log in to do that!<br>";
		// header( 'Location: login.php?message=You gotta log in to do that!' );
		// exit;
		// }
	
$username = $_SESSION['myusername'];
$newtripnumber = $_GET['tripnumber'];


// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}


////// ABOUT THE TRIPNUMBER
//		If you're just logging one trip, i.e. going to log.php with no arguments, this script will
//		connect to the DB and figure out the number of this new trip
//		If you're adding another spot to AN EXISTING TRIP (i.e. log.php?tripnumber=9023) then the script
//		will use THAT as the tripnumber.
//		Each tripid is unique, but a any number of trips can have the same tripnumber
//		(you can fish more than one spot in a given trip)
////////////////////////////


// check if the TRIPNUMBER is set
	if(isset($_GET['tripnumber']))
		{
		// if the tripnumber is set via a URL argument, tell us what it is
		//print "<br><b>Adding another spot to tripnumber $tripnumber <br>";
		//print "<a href='viewtrip.php?tripnumber=$tripnumber' target='_blank'>view the trip</a>";

		// get info to populate the fields
		
			$result = mysql_query("
			SELECT *
			FROM trips
			WHERE tripnumber = $tripnumber
			");
			
			// take the data and put it into an array
			$row = mysql_fetch_array($result);
			$tripdate = $row['date'];
				// convert tripdate into MM/DD/YYYY and auto-populate the date form
				$time = strtotime($tripdate);
				$newformat = date('m/d/Y',$time);
				$tripdate = $newformat;
				$date = $row['date'];

						
			$newtripnumber = $row['tripnumber'];
			$tripid = $row['tripid'];
		}
		else
		{
		// if the tripnumber is NOT set already.. tell us
		//print "<br>Creating a new trip (no tripnumber set)";
		// connect to the DB and figure out what the next tripnumber should be
		
		$result = mysql_query("				
		SELECT MAX(tripnumber) AS tripnumber FROM trips;
				");
		$row = mysql_fetch_array($result);
		$highesttripnumber = $row['tripnumber'];
		$newtripnumber = $highesttripnumber + 1;
		
		//print "this new tripnumber will be $tripnumber";
		
		}
		
// SET THE STARTING LOCATION BASED ON THE USER'S GPS
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
	

?>

<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<!-- 
<title>Google Maps Latitude and Longitude Picker jQuery plugin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 -->
	
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
	
<!-- FOR THE AUTOCOMPLETE WATERS -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
jQuery(document).ready(function($){
	$('#waterbody').autocomplete({source:'autocompletewaters.php', minLength:2});
});
</script>
<!-- END THE AUTOCOMPLETE WATERS STUFF -->

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
    	
    	
<!-- THE FORM -->
<!-- this decides what happens when you submit the form -->
<form action="submit.php" method="get" target="_blank">
<br><br>

<!-- DATE -->
<box>
	<h3>Log a trip</h3>
			<!-- from http://jqueryui.com/datepicker/ -->
		  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css" />
		  
		  <script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		  </script>
		 
		<formitem>date <input class='input' type="text" id="datepicker" name="date" />
		</formitem>
		
		<!-- time of day -->
		<formitem>Time of day
		<select class='input' name="timeofday">
		<option value="morning" selected>morning</option>
		<option value="noon">noon</option>
		<option value="afternoon" >afternoon</option>
		<option value="evening" >evening</option>
		<option value="night" >night</option>
		</select>
		<br>
		
		<!-- time fished (hours) -->
		<formitem>Time fished
		<input class='shortinput' type="text" class='input' name="time">
		</formitem>
		
		<!-- Tripnumber -->
		<formitem>Trip number
		<input class='seethrough' type="text" class='input' name="tripnumber" value="<? echo $newtripnumber ?>" readonly>
		</formitem>
		<br>
		
		<!-- 
		///////////////////////////////////////////////////////////////////////
		//	WATERBODY AUTOCOMPLETE
		///////////////////////////////////////////////////////////////////////
		 -->
		<formitem>Waterbody
			<input class='input' type="text" id="waterbody" name="waterbody"/>
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
			<input type="text" class="gllpLatitude" value="<?php print $userlatlon[0] ?>" name="lat"/>
			<input type="text" class="gllpLongitude" value="<?php print $userlatlon[1] ?>" name="lon"/>
		<!-- zoom: <input type="text" class="gllpZoom" value="3"/> -->
		<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
		<br/>
	</fieldset>
	<p>
	
<!--
///////////////////////////////////////////////////////////////////////
//	THE REST OF THE FORM
///////////////////////////////////////////////////////////////////////
 -->

		
		
		<formitem>Water type
		<select class='input' name="watertype">
		<option value="river" selected>river</option>
		<option value="creek">creek</option>
		<option value="pond" >pond</option>
		<option value="lake">lake</option>
		</select>
		</formitem>
		
		<!-- Water clarity (dropdown) -->
		<formitem>Water clarity
		<select class='input' name="watercolor">
		<option value="clear" selected>clear</option>
		<option value="stained">stained</option>
		<option value="muddy" >muddy</option>
		</select>
		</formitem>
		<br>
		
		<!-- Gear (fly/spin/both) radio buttons -->
		<formitem>Gear
		<input class='checkbox' type="radio" name="gear" value="fly">Fly
		<input class='checkbox' type="radio" name="gear" value="spin">Spin
		<input class='checkbox' type="radio" name="gear" value="both">Both<br>
		</formitem>
		
		<!-- Method (dropdown) -->
		<formitem>Method
		<select class='input' name="method">
		<option value="shore" selected>shore</option>
		<option value="wading">wading</option>
		<option value="boat" >boat</option>
		</select>
		</formitem>
		<br>
		
		
		<!-- Adventure -->
		<formitem>Adventure score
		<select class='shortinput' name="adventure">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
		</formitem>
		
			
		<!-- Scenic -->
		<formitem>Scenic score
		<select class='shortinput' name="scenic">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
		</formitem>
		
			
		<!-- Ninja -->
		<formitem>Ninja score
		<select class='shortinput' name="ninja">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
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

<textarea style="width: 55%; height: 100px" name="notes" value="notes"></textarea>


		<!-- Best lures -->
		<formitem>Best lures
		<input class='input' type="text" name="lures" size="90">
		</formitem>
		<br>
		
			
		<!-- Lure image link-->
		<formitem>best lure image (URL)
		<input class='input' type="text" name="lureimage" size="90">
		<br>
		</formitem>
		<br>



<!--///////////////////////////////////////////////////////////////////////
//	FISH BOXES (start hidden)
///////////////////////////////////////////////////////////////////////
	 Click to get the fish boxes -->

	<!-- SUNFISH FAMILY -->
	<a href="javascript:toggle('sunfish')">sunfish family</a>
	<div id="sunfish" style="display: none;">
 
 	<!-- go to DB and get all the species -->
 	<?
 	//Do your query and stuff here
 	$query = "select * from species where family = 'sunfish'";
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
	{
	$species = $row['species'];
	print "<formitem>$species: <input class='input' type='number' name='$species'></formitem><br>";
	}
 	?>
 	
 	<!-- largemouth bass
	<input class='input' type="number" name="largemouth">
	
	smallmouth bass
	<input type="number" name="smallmouth">
	
	striped bass
	<input type="number" name="stripedbass">
	
	spotted bass
	<input type="number" name="largemouth">
	
	redeye bass
	<input type="number" name="redeye">
	
	bluegill
	<input type="number" name="bluegill">
	
	pumpkinseed
	<input type="number" name="pumpkinseed">
	
	green sunfish
	<input type="number" name="greenie">
	
	crappie
	<input type="number" name="crappie">
	
	rock bass
	<input type="number" name="rockbass"> -->
	
	</div><p>
	
	<!-- TROUT/CHAR -->
	<a href="javascript:toggle('trout')">trout family</a>
	<div id="trout" style="display: none;">
 
 	rainbow trout
	<input type="number" name="rainbowtrout">
	
	brown trout
	<input type="number" name="browntrout">
	
	brook trout
	<input type="number" name="brooktrout">
	
	cutthroat trout
	<input type="number" name="cutthroattrout">
	
	golden trout
	<input type="number" name="goldentrout">
	
	</div><p>
	
	<!-- MINNOWS -->
	<a href="javascript:toggle('minnow')">minnow family</a>
	<div id="minnow" style="display: none;">
 
 	common carp
	<input type="number" name="carp">
	
	grass carp
	<input type="number" name="grasscarp">
	
	mirror carp
	<input type="number" name="mirrorcarp">
	
	bighead carp
	<input type="number" name="bighead carp">
	
	shiner
	<input type="number" name="shiner">
	
	creek chub
	<input type="number" name="creekchub">
	
	shad
	<input type="number" name="shad">
	
	</div><p>
	
	<!-- PIKES -->
	<a href="javascript:toggle('pike')">pike family</a>
	<div id="pike" style="display: none;">
 
 	northern pike
	<input type="number" name="pike">
	
	muskellunge
	<input type="number" name="musky">
	
	pickerel
	<input type="number" name="pickerel">
	
	tiger musky
	<input type="number" name="tigermusky">
	
	</div><p>
	
	<!-- PERCH -->
	<a href="javascript:toggle('perch')">perch family</a>
	<div id="perch" style="display: none;">
 
 	yellow perch
	<input type="number" name="perch">
	
 	white perch
	<input type="number" name="whiteperch">
	
	walleye
	<input type="number" name="walleye">

	</div><p>
	
	<!-- CATFISH -->
	<a href="javascript:toggle('catfish')">catfish family</a>
	<div id="catfish" style="display: none;">
 
 	channel catfish
	<input type="number" name="channelcatfish">
	
	flathead catfish
	<input type="number" name="flatheadcatfish">
	
	blue catfish
	<input type="number" name="bluecatfish">
	
	bullhead
	<input type="number" name="bullhead">
	
	</div><p>
	
	<!-- SALTWATER -->
	<a href="javascript:toggle('saltwater')">saltwater</a>
	<div id="saltwater" style="display: none;">
 
 	channel catfish
	<input type="number" name="channelcatfish">
	
	flathead catfish
	<input type="number" name="flatheadcatfish">
	
	blue catfish
	<input type="number" name="bluecatfish">
	
	bullhead
	<input type="number" name="bullhead">
	
	</div><p>
	
	<!-- OTHERS -->
	<a href="javascript:toggle('others')">others</a>
	<div id="others" style="display: none;">
 
 	bowfin
	<input type="number" name="bowfin">
	
	goby
	<input type="number" name="goby">
	
	gar
	<input type="number" name="gar">
	
	freshwater drum
	<input type="number" name="drum">
	
	</div>
	
<!-- PRIVACY -->
		<!-- Privacy -->
		Private?
		<input class='input' type="checkbox" name="private">

<!-- SUBMIT BUTTON -->
<center>

<input type="submit" value="log a trip!" name="submit">
</box>
</center>
</form>




<?

?>
	
</body>
</html>
