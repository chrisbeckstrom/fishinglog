<link rel="stylesheet" type="text/css" href="css/style.css">

<?php
error_reporting(0);
$pagetitle = "Stats";

include 'connect.php';		// connect to the db
include 'config.php';
include 'header.php';

// FISHING TRIP STATS FOR THE CURRENT YEAR: 2013

// PERCENT FUNCTION
include 'percent.php';

//// WHAT YEAR should these stats be for?
	$year = "2014";			// *** THIS IS SUPER IMPORTANT! This sets the year variable for everything
	$nextyear = $year + 1;
////

// BUILD THE PAGE
	print $header;
?>
<div id='main'>
<nav></nav>
<aside>
    	<box>
    	<h3>Your score</h3>
    	8928837 points
    	</box>
    	<box>
		<?php include 'recenttrips.php'; ?>
		</box>
	</aside>
		
	<article>
	 <?

// Populate a title, subtitle, links,  etc.
//print "<h2>$year</h2>";


// DO STUFF

// Count how many rows there are for this year
	print "<box>";
	$result = mysql_query("SELECT * FROM trips WHERE `date` > '$year'", $con);
	$num_rows = mysql_num_rows($result);
	$trips = $num_rows;
	print "<h2>Trips in $year: ";
	
	if ($trips=="0")			// if no trips, say no trips! otherwise print the # of trips
	  {
	  echo "No trips yet!<br>";
	  }
	else
	  {
	echo "$trips</h2>";		// print trips: #
	  }

	print "Fish per day in $year: ";
	print $trips / 365;

// OTHER TOTALS

// this works: SELECT SUM(fishcaught) as sum FROM trips WHERE tripdate > 2013-01-01
// returns the sum of fish caught in 2012

// HOURS FISHED
	$query = mysql_query("SELECT COUNT(time) as sum FROM trips WHERE date >= '2013-1-1'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "Hours fished</b>: ";
	$time = $row['sum'];
	
	print "$time <br>";		// print Skunks: #


// SKUNKS
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'yes' AND date >= '2013-1-1'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "<b>Total skunks</b>: ";
	$skunked = $row['sum'];
	
	if ($skunked=="0")				// if no skunks, say no skunks! otherwise print the # of skunks
		  {
		  echo "No skunks!<br>";
		  }
		else
		  {
		echo "$skunked <br>";		// print Skunks: #
		  }

	print "<i>";
	print "skunked ";
	percent($skunked,$num_rows);
	print "% of the time";
	print "</i><br>";			// print #% of the time
	
	
// Trips with the FLY ROD
	$query = mysql_query("SELECT COUNT(gear) as sum FROM trips WHERE gear = 'fly' AND date >= '2013-1-1'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "trips with the <b>fly rod</b>: ";
	$fly = $row['sum'];
	echo "$fly";			// print trips with fly gear
	
	// Try to get the # of times skunked on the fly	
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'yes' AND gear = 'fly' AND date >= '$2013-1-1'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "Skunks on the fly: ";
	$skunked = $row['sum'];

	echo "$skunked <br>";		// print Skunks: #

	print "<i>";
	print "skunked ";
	percent($skunked,$fly);
	print "% of the time on the fly";
	print "</i><br>";			// print #% of the time
	
// Trips with SPINNING gear
	$query = mysql_query("SELECT COUNT(gear) as sum FROM trips WHERE gear = 'spin' AND date > '$year'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "trips with <b>spinning gear</b>: ";
	$spin = $row['sum'];
	echo "$spin";			// print trips with spinning gear
	
	
	// Try to get the # of times skunked on spinning gear	
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'skunked' AND gear = 'spin' AND date > '$year'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "Skunks on spinning gear: ";
	$skunked = $row['sum'];
	echo "$skunked <br>";		// print Skunks: #

	print "<i>";
	
	if ($skunked=="0")				// if no skunks, say no skunks! otherwise print the # of skunks
		  {
		  echo "No skunks!<br>";
		  }
		else
		  {
	print "skunked ";
	//percent($skunked,$spin);
	print "% of the time on spinning gear";
	print "</i><br>";			// print #% of the time
		  }

	
	
// TRIP COUNTS by TYPE OF WATER
	print "<div id='waters'>";
	print "<h2>Trips by type of water</h2>";	// print title
	
	print "<b>Total trips: $trips</b>";
	
$water = "creek";
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water' AND date = '$year'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$water: ";
	$count = $row['sum'];
	echo "$count";
	
	print "<i> (";
	percent($count,$trips);
	print "%) ";
	print "</i>";			// print % of creek trips

$water = "river";
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water' AND date > '$year'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$water: ";
	$count = $row['sum'];
	echo "$count";
	
	print "<i> (";
	percent($count,$trips);
	print "%) ";
	print "</i>";			// print % of river trips
	
$water = "lake";
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water' AND date > '$year'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$water: ";
	$count = $row['sum'];
	echo "$count";
	
	print "<i> (";
	percent($count,$trips);
	print "%) ";
	print "</i>";			// print % of lake trips
	
$water = "harbor";
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water' AND date > '$year'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$water: ";
	$count = $row['sum'];
	echo "$count";
	
	print "<i> (";
	percent($count,$trips);
	print "%) ";
	print "</i><br>";			// print % of harbor trips
	
	print "</div>";
	
	print "</div></i>"; // end of left column


	print "<div id='rightcolumn'>";	// top of right column
	
// Total fish caught
	$query = mysql_query("SELECT SUM(fishcaught) as sum FROM trips WHERE date > $nextyear AND date > '$year'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<h2>";
	print "Fish caught: ";
	$fishcaught = $row['sum'];
	echo "$fishcaught</h2>";


// FISH TOTALS by SPECIES
$fish = "bluegill";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "largemouth";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "smallmouth";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "bowfin";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "carp";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "creekchub";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "greenie";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "drum";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "walleye";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "pike";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";

$fish = "browntrout";
	$q = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($q);
	print "<br>";
	print "$fish: ";
	//echo $row['sum'];
	
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "rainbowtrout";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "musky";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "shad";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "flatheadcatfish";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "channelcatfish";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "perch";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "crappie";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";

$fish = "bullhead";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "redeyebass";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "rockbass";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "goby";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `date` > '$year' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	

	
	print "</article>";
// FOOTER
	print "$footer";
?>
</div>