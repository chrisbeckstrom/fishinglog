<?php

include 'config/config.php';
include 'header.php;';
print $header;
?>
<html>
<head>
<link rel='stylesheet' href='style.css' type="text/css" />
<!-- 
<link rel='stylesheet' media="only Screen and (min-device-width: 900px)" href='style.css' type="text/css" />
<link rel='stylesheet' href='iphone.css' type="text/css" />
 -->
<title>CB's Fishing Log</title>
</head>
<body>
<!-- 
<script type="text/javascript">
// THIS LITTLE SCRIPT REDIRECTS IF THE SCREEN IS SMALL
<!~~
if (screen.width <= 699) {
document.location = "mobile.html";
}
//~~>
</script>
 -->

<!-- CB'S FISHING LOG FORM
This is the actual HTML page that asks the user for input
(in the form of information about a fishing trip)

The results are sent over to [secret].php, which then adds them
to the mysql database

It doesn't cause problems if there are fields here that aren't
sent to the php file, but if there are fields in the php file
that don't match THESE variables (or column names in the db)
there WILL be problems. -->

<!-- Whadaya know- I got the stylesheet to work on the first try! -->
<!-- 
<link rel="stylesheet" type="text/css" href="style.css">
 -->
 
 <!-- iPhone browser width is 320px --!>
<!-- 
<link rel="stylesheet" media="only screen and (max-device-width: 699px)" href="iphone.css" type="text/css" />
 -->

<!-- <div id="wrap"> -->		<!-- start the WRAP div -->

<?php
	include 'config/config.php';
	print $header;
	?>


<!-- Beginning of form -->
<div id='leftcolumn'>

<form action="insert.php" method="post">

<h2> Trip info </h2><p>
<!-- DATE goes to tripdate column -->
Date of trip <i>(yyyy-m-d)</i>

	<br>
<input type="text" name="tripdate" size="10">

<!-- script that gets the date and populates the date textbox -->
<script type="text/javascript">
<!--//
var currentTime = new Date();
var month = currentTime.getMonth() + 1;
var day = currentTime.getDate();
var year = currentTime.getFullYear();

document.forms[0].tripdate.value = year + "-" + month + "-" + day;
//-->
</script>
<br>

<!-- TIME OF DAY goes to timeofday column -->
Time of day <i>(morning, etc)</i><br>
<input type="text" name="timeofday" size="10">
<br>

<!-- TIME goes to time column -->
Time fished <i>(how long)</i><br>
<input type="text" name="time" size="4"> hours
<br>

<!-- SKUNKED goes to skunked column -->
Skunked?
<input type="radio" name="skunked" value="no" checked>no
<input type="radio" name="skunked" value="yes">yes
<br>
<br>

<!-- BODY OF WATER goes to waterbody column -->
Body of water
<input type="text" name="waterbody" size="30">
<br>

<!-- TYPE OF WATER goes to watertype column -->
Water type
<select name="watertype">
<option value="river" selected>river</option>
<option value="pond">pond</option>
<option value="lake">lake</option>
<option value="ocean">ocean</option>
</select>
<br>

<!-- WATER COLOR goes to watercolor column -->
Water clarity
<select name="watercolor">
<option value="clear">clear</option>
<option value="stained">stained</option>
<option value="muddy" selected>muddy</option>
<option value="chocolate milk">chocolate milk</option>
</select>
<br>

<!-- AIR TEMPERATURE goes to airtemp column -->
Air temp
<input type="text" name="airtemp" size="4"> <i>f</i><br>

<!-- WATER TEMPERATURE goes to watertemp column -->
Water temp
<input type="text" name="watertemp" size="4" value="?"><br>

<!-- WEATHER goes to weather column -->
Weather
<input type="text" name="weather" value="sunny">
<br>
<br>

<!-- TYPE OF FISHING goes to gear column -->
Type of fishing<br>
<input type="radio" name="gear" value="fly" checked>Fly
<input type="radio" name="gear" value="spinning">Spinning
<input type="radio" name="gear" value="both">Both
<br><br>

<!-- METHOD of fishing goes to method column -->
Method
<select name="method">
<option value="shore" selected>shore</option>
<option value="wading">wading</option>
<option value="kayak">kayak</option>
<option value="boat">boat</option>
</select>
<br>


<!-- NOTES goes to notes column -->
<br>notes<br>
<!-- <input type="text" name="notes" size="50"><br> -->

<textarea name="notes" id="notes" cols="45" rows="4"></textarea>
	

<!-- LURES goes to lures column -->
<br>successful lures/flies <i>(no apostrophes)</i><br>
<input type="text" name="lures" size="50"><br>

</div> <!-- end of left column -->

<div id='rightcolumn'> <!-- start of right column -->

<!-- FISH COUNTER
Each species has its own column, the number is added -->

<h2>Fish Caught</h2><p>
Largemouth bass
<input type="number" name="largemouth" size="3"><br>
Smallmouth bass
<input type="number" name="smallmouth" size="3"><br>
Green sunfish
<input type="number" name="greenie" size="3"><br>
Bluegill
<input type="number" name="bluegill" size="3"><br>
Carp
<input type="number" name="carp" size="3"><br>
Drum
<input type="number" name="drum" size="3"><br>
Walleye
<input type="number" name="walleye" size="3"><br>
Pike
<input type="number" name="pike" size="3"><br>
Musky
<input type="number" name="musky" size="3"><br>
Bowfin
<input type="number" name="bowfin" size="3"><br>
Shad
<input type="number" name="shad" size="3"><br>
Creek chub
<input type="number" name="creekchub" size="3"><br>
Flathead catfish
<input type="number" name="flatheadcatfish" size="3"><br>
Channel catfish
<input type="number" name="channelcatfish" size="3"><br>
Brown trout
<input type="number" name="browntrout" size="3"><br>
Rainbow trout
<input type="number" name="rainbowtrout" size="3"><br>
Brook trout
<input type="number" name="brooktrout" size="3"><br>
Perch
<input type="number" name="perch" size="3"><br>
Striped bass
<input type="number" name="stripedbass" size="3"><br>
White perch
<input type="number" name="whiteperch" size="3"><br>
Crappie
<input type="number" name="crappie" size="3"><br>
Bullhead
<input type="number" name="bullhead" size="3"><br>
Red-eye bass
<input type="number" name="redeyebass" size="3"><br>
Rock bass
<input type="number" name="rockbass" size="3"><br>
Goby
<input type="number" name="goby" size="3"><br>


<br>
<!-- You can change the name of the button by changing the value -->
<input type="submit" value="Log it!">
</form>
</div>

<!-- FOOTER -->
<?php
	print $footer;
	?>
	
</body>
</html> 