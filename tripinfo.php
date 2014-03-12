<?php
// TRIPINFO
// -- stuff to show about each trip
// -- this goes in viewtrip.php (view a single trip)

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
// 				
	
	
	$timefished = $row['time'];
	$lastupdate = $row['timestamp'];

	$adventure = $row['adventure'];
	$scenic = $row['scenery'];
	$ninja = $row['ninja'];
	$points = $row['points'];
	$tripid = $row['tripid'];
	$lastupdate = $row['lastupdate'];
	$watertype = $row['watertype'];
	$waterbody = $row['waterbody'];
	$notes = $row['notes'];
	$newwater = $row['newwater'];
	$fishingmethod = $row['method'];
	$gear = $row['gear'];
	$timeofday = $row['timeofday'];
	$lure = $row['lures'];
	$lureimage = $row['lureimage'];
	
	// WEATHER
	$temp = $row['temp'];
	$hum = $row['hum'];
	$wspdi = $row['wspdi'];
	$wdir = $row['wdir'];
	$pressure = $row['pressure'];
	$conds = $row['conds'];
	
	$watercolor = $row['watercolor'];
	
	// USGS GAUGE INFO
	$gaugeheight = $row['gaugeheight'];
	$discharge = $row['discharge'];
	$sitecode = $row['sitecode'];
	
	// LOCATION
	$lat = $row['lat'];
	$lon = $row['lon'];
	$city = $row['city'];
	$state = $row['state'];
	
	$private = $row['private'];



////////// CHANGE THINGS DEPENDING ON OTHER THINGS ///////////////
// if we don't have adventure/scenery/ninja scores, don't show any
	if ( $adventure == '0' )
		{
		$scores = "";
		}
		else
		{
		$scores = "adventure: $adventure<br>
		scenic: $scenic<br>
		ninja: $ninja";
		}

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
	if ( $fishcaught == 0 )
		{
		$results = "skunked";
		}
		else
		{
		$results = "fish caught: $fishcaught";
		}


// HIDE NOTES?
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

// Wunderground historical link
//$wunderground_url = 'http://www.wunderground.com/history/airport/KGRR/2013/6/1/DailyHistory.html?req_city=Grand+Rapids&req_state=MI&req_statename=Michigan'


// USGS historical link
$usgs_url = "http://waterdata.usgs.gov/nwis/uv?cb_00060=on&cb_00065=on&format=gif_default&period=&begin_date=$tripdate&end_date=$tripdate&site_no=$sitecode";


// if we have lure information, show it
	if ($lure == '')
		{
		$bestlure = '';
		}
		else
		{
		$bestlure = "<h2>Best lure: $lure </h2>";
		}



// <img src='http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=200x200&sensor=false'></a>

// TRIPBOX


print "<box>
<img class='circular' src='$useravatar'>
<h2><a href='user.php?username=$username'>$username</a> @";

// HIDE THE WATERBODY?
	if ( $hidethings == 1 )
		{
		$waterbody = disguise($waterbody);
			print " " . $waterbody . "</h2>";
		}
		else {
			$waterbody = $waterbody;
			print " <a href='water.php?name=$waterbody'>$waterbody</h2></a>";
		}


// if it's new water, make $isnewwater something
	if ( $newwater == '1' )
			{
				$isnewwater = "NEW WATER!";
				print "<otherbox style='align=right;'><h2><i>New water!</i></h2></otherbox>";
			}
		else
			{	$isnewwater = "";
			}

// <img height='40px' src='images/$watertype.png'>
print "<br>
<otherbox>
	<small>$watertype in $city, $state <br>
	$date ($timeofday)

	<br><a href='viewtrip.php?tripnumber=$tripnumber'>#$tripnumber</a>
	 privacy: $private
	</small>";
	
			// if the current user is the same as the tripuser... give the option to edit the trip
		$myusername = $_SESSION['myusername'];
		if ($username == $myusername )
			{
			print "<br><a href='form.php?edit=1&tripnumber=$tripnumber'><small>edit trip</small></a>";
			}
print "</otherbox>
	
	<br>";
	
	

print "<otherbox>";
	// HOW MANY FISH WERE CAUGHT?
			//print "FISH CAUGHT INFO!<br>";
			// $tripnumber = $row['tripnumber'];	
			$catchquery = "SELECT * FROM fishcaught WHERE tripnumber = '$tripnumber'";
			//print "catchquery is <pre>$catchquery</pre><br>";	
							
			$catchresults = mysql_query($catchquery);
			$number_of_fish_rows = mysql_num_rows($catchresults);
			//print "total fish caught: $number_of_fish_rows<br>";
			
			if ( $number_of_fish_rows == 0 )
				{
				print "<h1>Skunked!</h1><br>";
				}
				else
				{
				print "<h1>caught $number_of_fish_rows fish</h1><br>";
				}
			
				
			$fishcaught = $number_of_fish_rows;
			while($catchresultsarray = mysql_fetch_array($catchresults))
				{
				$fishID = $catchresultsarray['fishID'];
				print "fishID = $fishID<br>";
				}	
	///// end of figuring out how many fish were caught
	
	// A FISH SPRITE FOR EACH FISH CAUGHT
	$i=1;
	while($i<=$fishcaught)
	  {
	  print "<img src='images/fish.gif'>";
	  $i++;
	  }
	  
	print "<br>gear: $gear <br>";
	  
	// LURE IMAGE: if there isn't one, don't show anything
	if ($lureimage == '')
		{
		$lurepic = '';
		}
		else
		{
		$lurepic = "<a href='$lureimage' target='_blank'><img src='$lureimage' height='90' width='90'></a>";;
		}
		
	print "<br>$bestlure<br>";
	print "<otherbox>$lurepic</otherbox>";
	print "</otherbox>";	
	
	print "<otherbox>
	<h3>Points</h3>
	$scores <br>
	total: $points<br>
	</otherbox>";

	

	// if we have weather information, show it
	if ( $hum != '')
{
		print "
		<otherbox>
		<h3>Weather</h3>";
		print "Conditions: $temp &deg;F, $conds <br>
		Pressure: $pressure\"<br>
		Humidity: $hum% <br>
		Winds: $wspdi mph from the $wdir<br><br>
		</otherbox>";
	
}

	print "
	<otherbox>
	<h3>Water</h3>
	Water color: $watercolor<br>";

	// if we have streamflow information, show it
	if ( $gaugeheight != '')
		{
		print "<h3>Streamflow</h3>";
		print "<a href='$usgs_url' target='_blank'>Gauge height: $gaugeheight feet</a><br>";
		}

	// if we have discharge info, show it
	if ( $discharge != '' )
		{
		print "<a href='$usgs_url' target='_blank'>Discharge: $discharge cfs</a><br>";
		}
		
	print "</otherbox>";
	
// 	print "</div>"; // end of textbox div


			
	print "</box>

	<box>
	<h3>Notes</h3>
	$notes
	

	</box>
	
";

// SMALL INFO AT THE BOTTOM
// print "
// 		<h3>INFO</h3>
// 		user: <a href='user.php?username=$username'>$username</a>
// 		/ tripnumber: $tripnumber 
// 		/ tripid: $tripid
// 		/ last updated: $lastupdate
// 		/ <a href='log2.php?tripnumber=$tripnumber'>add another spot</a>
// 		/ <a href='deletetrip.php?tripid=$tripid'>delete</a>
// 		/ <a href='isnewwater.php?tripid=$tripid'>designate new water</a>
// 		END OF
// 	   ";

if ($private == '1')
	{
	print " (private)";
	}



?>