<?php
session_start();
include 'config/config.php';
#include 'config/config.php'; # don't send config twice!
include 'config/connect.php';
include 'header.php';
print "<link rel='stylesheet' href='$stylesheet' type='text/css' />";

$pagetitle = 'Log a trip';

print $header;

// *** THIS ISN'T WORKING ****
// if the MYUSERNAME is not set, redirect to the login page
if(isset($_SESSION['myusername']))
	{
	print "";
	}
	else
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php?message=You gotta log in to do that!' );
	}
	
	?>


<html>
<head>
<!-- 
<title>Ajax autocomplete using PHP &amp; MySQL</title>


<link rel="stylesheet" href="autocomplete.css" type="text/css" media="screen">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="dimensions.js" type="text/javascript"></script>
<script src="autocomplete.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function(){
	    setAutoComplete("watersField", "results", "autocompletewaters.php?part=");
	});
</script>

<script type="text/javascript">
	$(function(){
	    setAutoComplete2("cityField", "results", "autocompletecities.php?part=");
	});
</script>
 -->

</head>

<body>
	
<div id='main'>
	    <nav>nav</nav>
    <aside>aside</aside>
    <article>

<!-- 
<form name="log a trip" action="submittrip.php" method="get">
 -->
<form action="insert.php" method="post">

<div id='pagetitle'>
Log a trip
</div>

<!-- OLD DATE WORKS FINE
<label>Date: </label>
<input id="date" name="date" type="text" autofocus/>
 -->

<br>
	<!-- FANCY JQUERY POPUP DATE PICKER --!>
	<!-- from http://jqueryui.com/datepicker/ --!>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
 
<p>Fancy date: <input type="text" id="datepicker" name="date" /></p>


<label>Waterbody: </label>
<input id="watersField" name="watersField" type="text" />
<br>

<div class="styled-select">

<label>Water type:</label>
<select name="watertype">
  <option value="pond">pond</option>
  <option value="creek">creek</option>
  <option value="river">river</option>
  <option value="lake">lake</option>
  <option value="ocean">ocean</option>
  <option value="flats">flats</option>
</select> 
<br>

<label>Time of day:</label>
<select name="timeofday">
  <option value="morning">morning</option>
  <option value="late morning">late morning</option>
  <option value="noon">noon</option>
  <option value="afternoon">afternoon</option>
  <option value="evening">evening</option>
  <option value="afternoon">night</option>
</select> 
<br>
Time fished:<input id="time" name="time" type="text" />hours<br>

<br>
Water clarity
<select name="watercolor">
<option value="clear">clear</option>
<option value="stained">stained</option>
<option value="muddy" selected>muddy</option>
<option value="chocolate milk">chocolate milk</option>
</select><br>

<label>Gear: </label>
<select name="gear">
  <option value="fly">fly</option>
  <option value="spin">spin</option>
  <option value="baitcasting">baitcasting</option>
</select>


<label>Method: </label>
<select name="method">
  <option value="shore">shore</option>
  <option value="wading">wading</option>
  <option value="kayaking">kayaking</option>
  <option value="boat">boat</option>
</select><br>

<br>
<!-- 
<label>Notes:</label>
<textarea id="notes" value="notes" rows="4" cols="50">
</textarea>
 -->

<label>Notes - NO APOSTROPHES </label>
<input id="notes" name="notes" type="text" rows="4" cols="50"/>

<br>
<label>Best lures: </label>
<input id="lures" name="lures" type="text" />
</div>
<br>
<!-- <div class='inputshort'> -->
Fish caught<p>
Largemouth bass
<input class="input" type="number" name="largemouth" size="3">
Smallmouth bass
<input type="number" name="smallmouth" size="3">
Green sunfish
<input type="number" name="greenie" size="3">
Bluegill
<input type="number" name="bluegill" size="3">
Carp
<input type="number" name="carp" size="3">
Drum
<input type="number" name="drum" size="3">
Walleye
<input type="number" name="walleye" size="3">
Pike
<input type="number" name="pike" size="3">
Musky
<input type="number" name="musky" size="3">
Bowfin
<input type="number" name="bowfin" size="3">
Shad
<input type="number" name="shad" size="3">
Creek chub
<input type="number" name="creekchub" size="3">
Flathead catfish
<input type="number" name="flatheadcatfish" size="3">
Channel catfish
<input type="number" name="channelcatfish" size="3">
Brown trout
<input type="number" name="browntrout" size="3">
Rainbow trout
<input type="number" name="rainbowtrout" size="3">
Brook trout
<input type="number" name="brooktrout" size="3">
Perch
<input type="number" name="perch" size="3">
Striped bass
<input type="number" name="stripedbass" size="3">
White perch
<input type="number" name="whiteperch" size="3">
Crappie
<input type="number" name="crappie" size="3">
Bullhead
<input type="number" name="bullhead" size="3">
Red-eye bass
<input type="number" name="redeyebass" size="3">
Rock bass
<input type="number" name="rockbass" size="3">
Goby
<input type="number" name="goby" size="3">

<!-- </div> -->

<br>

<div class='submit'>	
<input type="submit" value="Log the trip">	

</div>	
	</form>
	
	
	</div></div></div></div>
	
	</div></div></div>

</div> <!-- end of div WRAP -->





	
	
	
	
	</div>

	</p>	
	
</body>

</html>