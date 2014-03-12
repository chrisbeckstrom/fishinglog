<!-- JAVASCRIPT FOR POPUPS -->
<script src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/nhpup_1.1.js"></script>

<?php
// TRIPINFO - short-
// this is what shows up on the "all trips" page/search
// this PHP is used for each trip
// in other words, this happens a BUNCH of times on the trips.php page


	// figure out who is viewing	
	$currentuser = $_SESSION['myusername'];	

	// who's trip is this?
	$tripusername = $row['username'];
	

// hide or show things based on privacy	
	include 'php/privacy.php';
	
	



// 	else {	// if the user is viewing other people's trips, hide stuff
// 			$hidethings = 1;
// 			$hidespots = 1;
// 	}
	
	
	
	
	
	
	
	
/////////// end of figuring out what things to hide ///////
	

// these are things we care about on trips.php:
$tripdate = $row['date'];		// YYYY-MM-DD
	
$time = strtotime($tripdate);
$newformat = date('F d, Y',$time);
$date = $newformat;			// Month DD, YYYY

$tripnumber = $row['tripnumber'];
$public = $row['public'];
$username = $row['username'];
$userid = $row['userid'];
$userrealname = $row['userrealname'];
$timefished = $row['time'];
$lastupdate = $row['timestamp'];
$fishcaught = $row['fishcaught'];
$gaugeheight = $row['gaugeheight'];
$discharge = $row['discharge'];
$adventure = $row['adventure'];
$scenic = $row['scenery'];
$ninja = $row['ninja'];
$points = $row['points'];
$city = $row['city'];
$state = $row['state'];

				// go get that user's avatar
				$avatarquery = "
				SELECT useravatarurl FROM users WHERE username = '$username'";	
				
				//print "avatarquery is: $avatarquery<br>";
			
				//Do your query and stuff here
				$avatarresult = mysql_query($avatarquery);
						
				// take the data and put it into an array
				//$avatarrow = mysql_fetch_array($avatarresult);
			
				// get the variable(s)
				$avatarrow = mysql_fetch_array($avatarresult);
 				$useravatar = $avatarrow['useravatarurl'];
 				//print "useravatar = $useravatar <br>";

// if we don't have adventure/scenery/ninja scores, don't show any
if ( $adventure == '0' )
	{
	$scores = "";
	}
	else
	{
	$scores = "adventure score: $adventure / scenic score: $scenic / ninja score: $ninja";
	}

// USGS sitecode
$sitecode = $row['sitecode'];

// if the sitecode isn't 8 characters long, add a '0' to the beginning
if ( strlen($sitecode) == 7 )
	{
	$sitecode = '0' . $sitecode;
	}

if ( strlen($sitecode) == 6 )
	{
	$sitecode = '00' . $sitecode;
	}

// if you didn't catch fish, say "SKUNKED" instead of "0"
if ( $number_of_fish_rows == 0 )
	{
	$results = "skunked!";
	}
	else
	{
	$results = "caught $number_of_fish_rows fish";
	}
	
$tripid = $row['tripid'];
$lastupdate = $row['lastupdate'];

// HIDE THE WATERBODY?
$watertype = $row['watertype'];
$waterbody = $row['waterbody'];
if ( $hidethings == 1 )
	{
	$waterbody = disguise($waterbody);
	}
	else {
		$waterbody = $waterbody;
	}

$newwater = $row['newwater'];
// HIDE NOTES?
$notes = $row['notes'];

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


$fishingmethod = $row['method'];
$gear = $row['gear'];
$timeofday = $row['timeofday'];
$lure = $row['lures'];
$lureimage = $row['lureimage'];

// Wunderground historical link
//$wunderground_url = 'http://www.wunderground.com/history/airport/KGRR/2013/6/1/DailyHistory.html?req_city=Grand+Rapids&req_state=MI&req_statename=Michigan'

$temp = $row['temp'];
$hum = $row['hum'];
$wspdi = $row['wspdi'];
$wdir = $row['wdir'];
$pressure = $row['pressure'];
$conds = $row['conds'];
$lat = $row['lat'];
$lon = $row['lon'];

$private = $row['private'];

// USGS historical link
$usgs_url = "http://waterdata.usgs.gov/nwis/uv?cb_00060=on&cb_00065=on&format=gif_default&period=&begin_date=$tripdate&end_date=$tripdate&site_no=$sitecode";

$gaugeheight = $row['gaugeheight'];
$discharge = $row['discharge'];
$watercolor = $row['watercolor'];

// if we have lure information, show it
if ($lure == '')
	{
	$bestlure = '';
	}
	else
	{
	$bestlure = "best lure: $lure";
	}

// if it's new water, make $isnewwater something
if ( $newwater == '1' )
		{
			$isnewwater = "NEW WATER!";
		}
	else
		{	$isnewwater = "";
		}


// <img src='http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=200x200&sensor=false'></a>

// TRIPBOX

print "
	<a href='user.php?username=$username'><img class='circular' src='$useravatar'></a>
	<small>$date ($timeofday)</small><br>
	<h3><a href='user.php?username=$username'>$username</a> @ <a href='viewtrip.php?tripnumber=$tripnumber'><b>$waterbody</b></a>";
print "<small class='alignright'><a href='viewtrip.php?tripnumber=$tripnumber'>trip #$tripnumber</a></small>";

print "<small><br>$watertype in $city, $state<br></small></h3>
	";
	
		// A FISH SPRITE FOR EACH FISH CAUGHT
	$i=1;
	while($i<=$number_of_fish_rows)
	  {
	  print "<img src='images/fish.gif' height='20' width='20'>";
	  $i++;
	  }
    print "<br> 
	$results ($gear, $fishingmethod)
";

	
	  
	
	// // LURE IMAGE: if there isn't one, don't show anything
	// if ($lureimage == '')
		// {
		// $lurepic = '';
		// }
		// else
		// {
		// $lurepic = "<a href='$lureimage' target='_blank'><img src='$lureimage' height='90' width='90'></a>";;
		// }
		
	// print "<br>$bestlure <br><br>";
	// print "$lurepic<br>";
// 	
	 // print "";
// 
	// // if we have weather information, show it
	// if ( $hum != '')
		// {
		// print "
		// <h3>WEATHER</h3>";
		// print "<img src='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTQI2OTR3C07fpb-wJrTgJtka7c1kVDuRNAC8P2YgPnHDZpycgyhw'>";
		// print "$conds - $temp &deg;F <br>
		// $hum% humidity - winds at $wspdi mph from the $wdir<br><br>";
// 	
		// }
// 
	// print "water color: $watercolor<br>";
// 
	// // if we have streamflow information, show it
	// if ( $gaugeheight != '')
		// {
		// print "<h3>STREAMFLOW</h3>";
		// print "<a href='$usgs_url' target='_blank'>gauge height: $gaugeheight feet</a><br>";
		// }
// 
	// // if we have discharge info, show it
	// if ( $discharge != '' )
		// {
		// print "<a href='$usgs_url' target='_blank'>discharge: $discharge cfs</a><br>";
		// }
// 	
	// print "</box>

	print "<br><smallnotes>$notes</smallnotes>";


// SMALL INFO AT THE BOTTOM
if ( $hidethings == '1' )
	{
print "<br><span class='smallinfo'>
		user: <a href='user.php?username=$username'>$username</a> 
		/ tripnumber: $tripnumber 
		/ tripid: $tripid
		/ last updated: $lastupdate
		/ <a href='log2.php?tripnumber=$tripnumber'>add another spot</a>
		/ <a href='php/deletetrip.php?tripid=$tripid'>delete</a>
	   </span>";
	}
else
	{
print "";
	}
	

	   
$privacy = $private;

print "<small>";
if ($privacy == '0')
	{
	print "privacy: public";
	}
if ($privacy == '1')
	{
	print "privacy: users";
	}
if ($privacy == '2')
	{
	print "privacy: friends";
	}
if ($privacy == '3')
	{
	print "privacy: private";
	}
print "</small>";

// trip stuff
if ($_SESSION['myusername'] == $username)
	{
print "<br><small><a href='form.php?edit=1&tripnumber=$tripnumber'>edit trip</a> - 
	<a href='php/deletetrip.php?tripid=$tripid'>delete</a></small>";
	}

// print "</box>";
