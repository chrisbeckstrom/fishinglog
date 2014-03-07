<link rel='stylesheet' href='style.css' type="text/css" />

<?php
$pagetitle = "Form";


include 'header.php';
include 'php-form-builder-class/class.form.php';

print $header;

	session_start();	// this needs to be here to prevent errors
print "<div id='wrap'>";
print "<div id='centered'>";

///////////////////////// FORM STUFF ///////////////////////////////////
$form = new form("googlemaps_0", 10);

// This sets the arrangement of boxes and whatnot
// $form->setAttributes(array(
//     "map" => array(3, 1, 1, 2, 3)));

$form->setAttributes(array(
    "jsincludesPath" => 'php-form-builder-class/includes'));

if(!empty($_GET["errormsg_0"]))
    $form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);
 
$form->addHidden("cmd", "submit_0");

////////////////////////// FORM ///////////////////////////////////////


// DATE - date chooser
$form->addDate("Date", "date", "", array("jqueryOptions" => array("dateFormat" => "yy-mm-dd")));
?>
<form>
First name: <input type="text" name="firstname"><br>
Last name: <input type="text" name="lastname">
</form>
<?php

// $form->addTextbox("Time fished", "time");
// $form->addSelect("Time of day", "timeofday", "", array("morning", "late morning", "noon", "afternoon", "evening", "night"));
// $form->addSelect("Skunked", "skunked", "", array("no", "yes"));
// 
// $form->addTextbox("Body of water", "waterbody");
// $form->addSelect("Water type", "watertype", "", array("river", "pond", "lake", "ocean"));
// $form->addSelect("Water clarity", "watercolor", "", array("clear", "stained", "muddy", "chocolate milk"));
// $form->addTextbox("Air temp", "airtemp");
// $form->addTextbox("Water temp", "watertemp");
// $form->addTextbox("Weather", "weather");

// MAP - google map lat/lon chooser
$form->addLatLng("Map", "lat_plus_long", array(41.983, -88.013), array( "style" => "width: 800px;", "height" => 500, "width" => 700, "zoom" => 15));




// 
// $form->addSelect("Gear", "gear", "", array("fly", "spinning", "baitcasting", "hand-lining"));
// $form->addSelect("Method", "method", "", array("shore", "wading", "kayaking", "boat", "trolling"));
// 


// NOTES - PFBC notes - textarea - ** could replace with fancier textbox!
$form->addTextarea("Notes <i>(no apostrophes.. yet)</i>", "notes");


// 
// //FISHCAUGHT
// $form->addTextarea("Fish caught <i>(8 bluegills, 2 carp, etc)</i>", "fishcaughtraw");

///////////////////////// CLEANING /////////////////////////////////////
// CLEAN LATITUDE AND LONGITUDE
$dirty = "$_POST[lat_plus_long]";
$badwords = array("Latitude: ", "Longitude: "); 
$clean = str_replace($badwords, "", $dirty );

$data = $clean;
list($lat, $lon) = explode(", ", $data);
print "<br>$lat <br>";
print "$lon <br>";

print "</div>";

// CLEAN NOTES (remove ')
function clean_up( $text ) {
    $unwanted = array("'"); // add any unwanted char to this array
    return str_ireplace( $unwanted, '', $text );
	}

$notes = clean_up( $_POST[notes] );;
echo $notes; // outputs: I dont need apostrophes.

print "<br> the clean notes are: <br> $clean_title";

///////////////////////// SUBMIT THE FORM ///////////////////////////////
$form->addButton("Log the trip!");
$form->render();

/////////////////////// FIND OUT HOW MANY FISH //////////////////////////

if ($notes == "")	// start of long if..else
	{
	die;		// quit because no user input yet
	}
else
	{
	print "You said you caught $_POST[fishcaughtraw]<br>";

// Get the user string of fish caught and make it into an array
$exploded = explode(", ", $_POST[fishcaughtraw]);

// run the "findfish" function
include  'findfish.php';
findfish($exploded);

// add everything up
$fishcaught = 
	$bluegill +
	$largemouth +
	$smallmouth +
	$greenie +
	$bluegill +
	$carp +
	$drum +
	$walleye +
	$pike +
	$musky +
	$bowfin +
	$shad +
	$creekchub +
	$flatheadcatfish +
	$channelcatfish +
	$browntrout +
	$rainbowtrout +
	$brooktrout +
	$perch +
	$stripedbass +
	$whiteperch +
	$crappie +
	$bullhead +
	$redeyebass +
	$rockbass +
	$goby
	;
	


//// PRINT TOTALS ////

print "Bluegill: $bluegill<br>";
print "Largemouth: $largemouth<br>";
print "Drum: $drum<br>";
print "<br> fish caught is <br> $fishcaught<br>";



////////////////////////// RESULTS //////////////////////////////////////


if ($notes == "")
	{
	print "<br> the variable \$notes is DOES NOT EXIST!";
	}
	else
	{
	print "<br> the variable \$notes contains stuff. good work!";
	}


// Connect to the server
mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!") or die(mysql_error());
print "<BR>Connected to mysql";

}

// Choose the database
mysql_select_db("fishingtrips") or die(mysql_error());
print "<BR>Connected to Database";

// PUT THE STUFF INTO THE DATABASE
mysql_query(
"INSERT INTO trips(
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
	lat, 
	lon,
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
	'$notes',
	'$lat',
	'$lon',
	'$_POST[lures]'
	)")
	or die(mysql_error()); 
// 	} // end of long if..else
//print "<h1>Success!</h1>";
//print "<br> Bluegill count was: $bluegill, largemouth bass count was $largemouth, and carp count was $carp!";
//print "date was $_POST[tripdate]";
///
//print "<HR>\$fishcaughtraw = $fishcaughtraw<br>"
		
?>