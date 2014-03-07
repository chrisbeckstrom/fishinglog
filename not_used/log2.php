<?php
session_start();
?>

<link rel='stylesheet' href='style.css' type="text/css" />

<?php
/* log a trip



*/

$pagetitle = "Log a trip (2)";

include 'header.php';
include 'php-form-builder-class/class.form.php';

print $header;

print "<div id='wrap'>";
print "<div id='centered'>";

/// if a trip was just submitted, then tell us about it (otherwise, DON'T!)
	if(isset($_POST['date']))
	{
print "<div id='centered'>";
echo "<h3><center>One trip added to the log!</h3>";		
print "date logged= $now<BR>
		date of trip = $tripdate <BR>
		waterbody = $_POST[watersField]<br>
		time = $_POST[time] hours<br>
		method = $_POST[method]<br>
		notes = $_POST[notes]<br>";				// success message
print "<center>$total fish added to the database livewell<br></div>";
print "<a href='log2.php?tripnumber=$tripnumber>Add another spot to this trip</a>";

print "</div>";
#print "<meta http-equiv='REFRESH' content='2;url=php/stats.php'>";			//html redirect, seemed easier than php
print "<a href='php/stats.php'>click here to see your stats</a>";
	}
	

/////

// if the MYUSERNAME is not set, redirect to the login page
	if(isset($_SESSION['myusername']))
		{
		print "";
		}
		else
		{
		print "You gotta log in to do that!<br>";
		header( 'Location: login.php?message=You gotta log in to do that!' );
		exit;
		}
	
$username = $_SESSION['myusername'];
$tripnumber = $_GET['tripnumber'];

print "<h1> Log a trip </h1>";


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
		print "<br><b>Adding another spot to tripnumber $tripnumber <br>";
		print "<a href='viewtrip.php?tripnumber=$tripnumber' target='_blank'>view the trip</a>";

		// get info to populate the fields
		
			$result = mysql_query("
			SELECT *
			FROM trips
			WHERE tripnumber = $tripnumber
			");
			
			// take the data and put it into an array
			$row = mysql_fetch_array($result);
			
			// Things we want to show for each trip:
			$tripdate = $row['date'];
				// convert tripdate into MM/DD/YYYY and auto-populate the date form
				$time = strtotime($tripdate);
				$newformat = date('m/d/Y',$time);
				$tripdate = $newformat;
				$date = $row['date'];

						
			$tripnumber = $row['tripnumber'];
			$tripid = $row['tripid'];
		}
		else
		{
		// if the tripnumber is NOT set already.. tell us
		print "<br>Creating a new trip (no tripnumber set)";
		// connect to the DB and figure out what the next tripnumber should be
		
		$result = mysql_query("				
		SELECT MAX(tripnumber) AS tripnumber FROM trips;
				");
		$row = mysql_fetch_array($result);
		$highesttripnumber = $row['tripnumber'];
		$tripnumber = $highesttripnumber + 1;
		
		print "this new tripnumber will be $tripnumber";
		
		}

///////////////////////// FORM STUFF ///////////////////////////////////
$form = new form("googlemaps_0", 500);
	
	// This sets the arrangement of boxes and whatnot
	// $form->setAttributes(array(
	//     "map" => array(3, 1, 1, 2, 3)));
	
	$form->setAttributes(array(
		"jsincludesPath" => 'php-form-builder-class/includes'));
	
	if(!empty($_GET["errormsg_0"]))
		$form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);
	 
	$form->addHidden("cmd", "submit_0");

////////////////////////// FORM ///////////////////////////////////////

	// ITASCA lat/long: 41.983, -88.013
	// KENTWOOD lat/long: 42.864909,-85.628303

	// MAP - lat and long - google map lat/lon chooser
		// get the current user's "home" GPS (GPS row in "users")
		$result = mysql_query("
			SELECT GPS FROM users WHERE username = '$username'");
		$row = mysql_fetch_array($result);
		$gps = $row['GPS'];
		$latandlon = explode(",", $gps);		
	$form->addLatLng("", "lat_plus_long", array($latandlon[0],$latandlon[1]), array( "style" => "width: 100%", "height" => 500, "width" => 700, "zoom" => 10));
	
	
	// DATE
	$form->addTextbox("Date (mm/dd/yyyy)", "date", "$tripdate");
	
	$form->addTextbox("Tripnumber", "tripnumber", "$tripnumber");
	
	// WATERBODY
	$form->addTextbox("Waterbody", "waterbody");
		
	// WATER TYPE
	$form->addSelect("Water type", "watertype", "", array("river", "creek", "lake", "pond", "harbor", "flats", "ocean"));

	// TIME OF DAY
	$form->addSelect("Time of day", "timeofday", "", array("morning", "noon", "afternoon", "evening", "night"));
	
	// TIME FISHED (hours)
	$form->addTextbox("Time fished (hours)", "time");
	
	// WATER CLARITY
	$form->addSelect("Water clarity", "watercolor", "", array("clear", "stained", "muddy"));
	
	// GEAR (fly, spin etc)
	$form->addSelect("Gear", "gear", "", array("fly", "spin", "fly and spin"));

	// METHOD (shore, kayak)
	$form->addSelect("Method", "method", "", array("shore", "wading", "kayak", "boat"));
	
	// NOTES - PFBC notes - textarea - ** could replace with fancier textbox!
	$form->addTextarea("Notes <i>(no apostrophes.. yet)</i>", "notes");
	
	// BEST LURES
	$form->addTextbox("Best lures", "lures");
	
	
	// FISH CAUGHT
	$form->addTextbox("Smallmouth", "smallmouth");
	$form->addTextbox("Largemouth", "largemouth");
	$form->addTextbox("Green sunfish", "greenie");
	$form->addTextbox("Bluegill", "bluegill");
	$form->addTextbox("Carp", "carp");
	$form->addTextbox("Drum", "drum");
	$form->addTextbox("Walleye", "walleye");
	$form->addTextbox("Pike", "pike");
	$form->addTextbox("Musky", "musky");
	$form->addTextbox("Bowfin", "bowfin");
	$form->addTextbox("Shad", "shad");
	$form->addTextbox("Creek chub", "creekchub");
	$form->addTextbox("Flathead catfish", "flathead catfish");
	$form->addTextbox("Channel catfish", "channelcatfish");
	$form->addTextbox("Brown trout", "browntrout");
	$form->addTextbox("Rainbow trout", "rainbowtrout");
	$form->addTextbox("Brook trout", "brooktrout");
	$form->addTextbox("Perch", "perch");
	$form->addTextbox("Striped bass", "striped bass");
	$form->addTextbox("White perch", "whiteperch");
	$form->addTextbox("Crappie", "crappie");
	$form->addTextbox("Bullhead", "bullhead");
	$form->addTextbox("Redeye bass", "redeyebass");
	$form->addTextbox("Rock bass", "rockbass");
	$form->addTextbox("Goby", "goby");
	

///////////////////////// CLEANING /////////////////////////////////////
// CLEAN LATITUDE AND LONGITUDE
	$dirty = "$_POST[lat_plus_long]";
	$badwords = array("Latitude: ", "Longitude: "); 
	$clean = str_replace($badwords, "", $dirty );
	
	$data = $clean;
	list($lat, $lon) = explode(", ", $data);
	print "</div>";
	
	// also keep the latlon
	$latlon = $lat . "," . $lon;
	//print "latlon is $latlon";

// make it so apostrophes work
$notes = mysql_real_escape_string($_POST[notes]);
$waterbody = mysql_real_escape_string($_POST[waterbody]);
$lures = mysql_real_escape_string($_POST[lures]);

// fix the 'private' checkbox
	if  ($_POST['private'] == "private")
		{
		$private = 1;		// if it's checked, private = 1
		}
		else
		{
		$private = 0;		// if unchecked, private = 0
		}
		

// GET THE TRIPNUMBER FROM THE SUBMITTED FORM
	$tripnumber = $_POST['tripnumber'];
	echo "POST tripnumber is $tripnumber";
		
	
///////////////////////// SUBMIT THE FORM ///////////////////////////////
	$form->addButton("Submit");
	$form->render();
	
// if nothing submitted, don't connect to DB
if ($_POST[date] == "")
	{
	print "date = nothing, so not connecting to the DB";
	exit;
	}
	else
	{
	print "Connecting to the DB...<br>";
	}
	
// SHOW US WHAT WE SUBMITTED
	$testname = $_POST['name'];
	echo "testname is $testname";
	
	$watertype = $_POST['watertype'];
	echo "    watertype is $watertype";
	
	echo "<BR>
		lat lon = $dirty <BR>
		lat = $lat <BR>
		lon = $lon <BR>";

/////////////// GET THE INFO, CLEAN IT ///////////////////////
//////////////////////////////////////////////////////////////
	
// $date = date("l");				// set the $date variable as the day of week
$now = date("Y-m-d H:i:s");		// set the $now in UTC (for "last update" column)

// Clean up the "notes" for import into MySQL

	// function clean_up( $text ) {
//     $unwanted = array("'"); // add any unwanted char to this array
//     return str_ireplace( $unwanted, '', $text );
// 	}
// 	
// 	$dirty_title = $_POST[notes];
// 	$clean_title = clean_up( $dirty_title );;
// 	// echo $clean_title
// 	$_POST[notes] = $clean_title;		//puts the cleaned up text back into the same variable
// 

// CONVERT MM/DD/YYYY from datepicker to YYYY/MM/DD for mysql

//print "Datepicker is $_POST[date]";
$unixdate = strtotime("$_POST[date]");
//print "unix date is $unixdate";
$tripdate = date("Y-m-d", $unixdate);
//print "tripdate is $tripdate";


// ADD UP THE FISH
// Get the total number of fish caught by adding up all the numbers

// syntax
//	$_POST[input_from_html_form]
$total = 
	$_POST[smallmouth] + 
	$_POST[largemouth] +
	$_POST[greenie] +
	$_POST[bluegill] +
	$_POST[carp] +
	$_POST[drum] +
	$_POST[walleye] +
	$_POST[pike] +
	$_POST[musky] +
	$_POST[bowfin] +
	$_POST[shad] +
	$_POST[creekchub] +
	$_POST[flatheadcatfish] +
	$_POST[channelcatfish] +
	$_POST[browntrout] +
	$_POST[rainbowtrout] +
	$_POST[brooktrout] +
	$_POST[perch] +
	$_POST[stripedbass] +
	$_POST[whiteperch] +
	$_POST[crappie] +
	$_POST[bullhead] +
	$_POST[redeyebass] +
	$_POST[rockbass] +
	$_POST[goby]
	;

// Connect to the server
$con = mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!");
if (!$con)
  {
  die('Oops, could not connect: ' . mysql_error());	// error message
  }

// Choose the database
mysql_select_db("fishingtrips", $con);

// Insert the stuff you got from the HTML form
$sql="INSERT INTO trips (
	lat,
	lon,
	latlon,
	lastupdate,
	date, 
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
	lures,
	username,
	tripnumber
	)
VALUES (''
	'$lat',
	'$lon',
	'$latlon',
	'$now',
	'$tripdate',
	'$_POST[skunked]',
	'$_POST[time]',
	'$_POST[timeofday]',
	'$waterbody',
	'$_POST[watertype]',
	'$_POST[watercolor]',
	'$_POST[gear]',
	'$_POST[method]',
	'$_POST[airtemp]',
	'$_POST[watertemp]',
	'$_POST[weather]',
	'$total',
	'$_POST[largemouth]',
	'$_POST[smallmouth]',
	'$_POST[greenie]',
	'$_POST[bluegill]',
	'$_POST[carp]',
	'$_POST[drum]',
	'$_POST[walleye]',
	'$_POST[pike]',
	'$_POST[musky]',
	'$_POST[bowfin]',
	'$_POST[shad]',
	'$_POST[creekchub]',
	'$_POST[flatheadcatfish]',
	'$_POST[channelcatfish]',
	'$_POST[browntrout]',
	'$_POST[rainbowtrout]',
	'$_POST[brooktrout]',
	'$_POST[perch]',
	'$_POST[stripedbass]',
	'$_POST[whiteperch]',
	'$_POST[crappie]',
	'$_POST[bullhead]',
	'$_POST[redeyebass]',
	'$_POST[rockbass]',
	'$_POST[goby]',
	'$notes',
	'$lures',
	'$_SESSION[myusername]',
	'$tripnumber'
	)";

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
  }
// 			print $header;
// 			print "<div id='centered'>";
// 			echo "<h3><center>One trip added to the log!</h3>";		
// 			print "date logged= $now<BR>
// 					date of trip = $tripdate <BR>
// 					waterbody = $_POST[watersField]<br>
// 					time = $_POST[time] hours<br>
// 					method = $_POST[method]<br>
// 					notes = $_POST[notes]<br>";				// success message
// 			print "<center>$total fish added to the database livewell";
// 			print "</div>";
// 			#print "<meta http-equiv='REFRESH' content='2;url=php/stats.php'>";			//html redirect, seemed easier than php
// 			print "<a href='php/stats.php'>click here to see your stats</a>";
mysql_close($con);

?>