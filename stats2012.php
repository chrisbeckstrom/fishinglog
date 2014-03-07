<link rel="stylesheet" type="text/css" href="style.css">

<?php
include 'config.php';		// header, footer, etc.
include 'connect.php';		// connect to the database



//// WHAT YEAR should these stats be for?
	$year = "2012";			// *** THIS IS SUPER IMPORTANT! This sets the year variable for everything
	$nextyear = $year + 1;
////

// HEADER / NAV
	print "$header";

// DO STUFF

	print "<div id='leftcolumn'>";	// begin left column

// Count how many rows there are for this year
	$result = mysql_query("SELECT * FROM trips WHERE `tripdate` > $nextyear", $link);
	$num_rows = mysql_num_rows($result);
	$trips = $num_rows;

	print "<h2>Trips in $year: $num_rows</h2>";
	print "Fish per day in $year: ";
	print 365 / $trips;

// OTHER TOTALS

// this works: SELECT SUM(fishcaught) as sum FROM trips WHERE tripdate > 2013-01-01
// returns the sum of fish caught in 2012


// SKUNKS
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'skunked'") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "<b>Total skunks</b>: ";
	$skunked = $row['sum'];
	echo "$skunked <br>";		// print Skunks: #

	print "<i>";
	print "skunked ";
	percent($skunked,$num_rows);
	print "% of the time";
	print "</i><br>";			// print #% of the time
	
	
// Trips with the FLY ROD
	$query = mysql_query("SELECT COUNT(gear) as sum FROM trips WHERE gear = 'fly'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "trips with the <b>fly rod</b>: ";
	$fly = $row['sum'];
	echo "$fly";			// print trips with fly gear
	
	// Try to get the # of times skunked on the fly	
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'skunked' AND gear = 'fly'") 
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
	$query = mysql_query("SELECT COUNT(gear) as sum FROM trips WHERE gear = 'spin'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "trips with <b>spinning gear</b>: ";
	$spin = $row['sum'];
	echo "$spin";			// print trips with spinning gear
	
	
	// Try to get the # of times skunked on spinning gear	
	$query = mysql_query("SELECT COUNT(skunked) as sum FROM trips WHERE skunked = 'skunked' AND gear = 'spin'") 
	or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "Skunks on spinning gear: ";
	$skunked = $row['sum'];
	echo "$skunked <br>";		// print Skunks: #

	print "<i>";
	print "skunked ";
	percent($skunked,$spin);
	print "% of the time on spinning gear";
	print "</i><br>";			// print #% of the time
	

// TRIP COUNTS by TYPE OF WATER
	print "<h2>Trips by type of water</h2>";	// print title
	
	print "<b>Total trips: $trips</b>";
	
$water = "creek";
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water'") 
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
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water'") 
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
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water'") 
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
	$query = mysql_query("SELECT COUNT(watertype) as sum FROM trips WHERE watertype = '$water'") 
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
	
	print "</div>";		// end of left column
	
	print "<div id='rightcolumn'>";

// Total fish caught
	$query = mysql_query("SELECT SUM(fishcaught) as sum FROM trips WHERE tripdate > $nextyear") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<h2>";
	print "Fish caught: ";
	$fishcaught = $row['sum'];
	echo "$fishcaught</h2>";
	
// FISH TOTALS by SPECIES

$fish = "bluegill";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "largemouth";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "smallmouth";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "bowfin";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "carp";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "creekchub";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "greenie";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "drum";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "walleye";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "pike";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";

$fish = "browntrout";
	$q = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE $fish > 0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($q);
	print "<br>";
	print "$fish: ";
	//echo $row['sum'];
	
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "rainbowtrout";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "musky";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "shad";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "flatheadcatfish";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "channelcatfish";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "perch";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "crappie";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";

$fish = "bullhead";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "redeyebass";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "rockbass";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	
$fish = "goby";	
	$query = mysql_query("SELECT SUM($fish) as sum FROM trips WHERE `tripdate` < '$nextyear' AND $fish >0") 
		or die(mysql_error());
	
	$row = mysql_fetch_assoc($query);
	print "<br>";
	print "$fish: ";
	$fishcount = $row['sum'];
	echo "$fishcount";
	print "</div>";	// end of right column
	
// FOOTER
	print "$footer";

?>