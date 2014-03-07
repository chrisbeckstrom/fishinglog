<?php
////////////////////////// RESULTS //////////////////////////////////////

// Connect to the server
$con = mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!");
if (!$con)
  {
  die('Oops, could not connect: ' . mysql_error());	// error message
  }

// Choose the database
mysql_select_db("fishingtrips", $con);

// PUTTING THE STUFF INTO THE DATABASE

$largemouth = 5;
$smallmouth = 10;

mysql_query(
	"INSERT INTO trips(
	tripdate,
	skunked, 
	time, 
	timeofday, 
	waterbody, 
	watertype, 
	watercolor, 
	gear, 
	method,
	airtemp, 
	watertemp, 
	weather, 
	fishcaught,
	largemouth, 
	smallmouth, 
	greenie, 
	bluegill, 
	carp, 
	drum, 
	walleye, 
	pike, 
	musky, 
	bowfin, 
	shad,
	creekchub, 
	flatheadcatfish, 
	channelcatfish, 
	browntrout, 
	rainbowtrout, 
	brooktrout, 
	perch, 
	stripedbass, 
	whiteperch, 
	crappie, 
	bullhead, 
	redeyebass, 
	rockbass, 
	goby, 
	notes,
	lat, 
	longitude,
	lures
	) 
	VALUES(
	'$_POST[date]',
	'$_POST[skunked]',
	'$_POST[time]',
	'$_POST[timeofday]',
	'$_POST[waterbody]',
	'$_POST[watertype]',
	'$_POST[watercolor]',
	'$_POST[gear]',
	'$_POST[method]',
	'$_POST[airtemp]',
	'$_POST[watertemp]',
	'$_POST[weather]',
	'$fishcaught',
	'$largemouth',
	'$smallmouth',
	'$greenie',
	'$bluegill',
	'$carp',
	'$drum',
	'$walleye',
	'$pike',
	'$musky',
	'$bowfin',
	'$shad',
	'$creekchub',
	'$flatheadcatfish',
	'$channelcatfish',
	'$browntrout',
	'$rainbowtrout',
	'$brooktrout',
	'$perch',
	'$stripedbass',
	'$whiteperch',
	'$crappie',
	'$bullhead',
	'$redeyebass',
	'$rockbass',
	'$goby',
	'$_POST[notes]',
	'$lat',
	'$longitude',
	'$_POST[lures]'
	)")
	or die(mysql_error()); 

//Tell us the results
if (!mysql_query($sql,$con))
  {
  die('<br>Error: ' . mysql_error());							// error message
  }
print "<h1>Success!</h1>";
print "<br> Bluegill count was: $bluegill, largemouth bass count was $largemouth, and carp count was $carp!";

print "date was $_POST[date]";

mysql_close($con);
?>