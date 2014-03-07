<link rel='stylesheet' href='style.css' type="text/css" />

<?php
/* ADD A WATERBODY

the purpose of this is to use google maps to locate a
waterbody (and the lat/long for that place)
and save it as a new waterbody in the waterbody table

*/

$pagetitle = "Add a waterbody";

include 'header.php';
include 'php-form-builder-class/class.form.php';

print $header;

session_start();	// this needs to be here to prevent errors

print "<div id='wrap'>";
print "<div id='centered'>";

// if the MYUSERNAME is not set, redirect to the login page
	if(isset($_SESSION['myusername']))
		{
		print "";
		}
		else
		{
		print "You gotta log in to do that!<br>";
		header( 'Location: login.php?message=You gotta log in to do that!' );
		}
	
$username = $_SESSION['myusername'];

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

	// MAP - lat and long - google map lat/lon chooser
	$form->addLatLng("Map", "lat_plus_long", array(41.983, -88.013), array( "style" => "width: 800px;", "height" => 500, "width" => 700, "zoom" => 15));
	
	// NAME
	$form->addTextbox("Name", "name");
	
	// WATER TYPE
	$form->addSelect("Water type", "watertype", "", array("river", "lake", "pond", "harbor", "ocean"));
	 
	// CITY
	$form->addTextbox("City", "city");
	
	// STATE
	$form->addTextbox("State", "state");
	
	// NOTES - PFBC notes - textarea - ** could replace with fancier textbox!
	$form->addTextarea("Notes <i>(no apostrophes.. yet)</i>", "notes");
	
	// OWNER - the user who created the spot- can make it private or public
	$owner = $username;
	
	// PRIVATE? if it's private, only the user who created it can see it
	$form->addCheckbox("Info about checkbox", "private", "", array("private"));


///////////////////////// CLEANING /////////////////////////////////////
// CLEAN LATITUDE AND LONGITUDE
	$dirty = "$_POST[lat_plus_long]";
	$badwords = array("Latitude: ", "Longitude: "); 
	$clean = str_replace($badwords, "", $dirty );
	
	$data = $clean;
	list($lat, $lon) = explode(", ", $data);
	print "</div>";

// CLEAN NOTES (remove ')
	function clean_up( $text ) {
		$unwanted = array("'"); // add any unwanted char to this array
		return str_ireplace( $unwanted, '', $text );
		}
	
	$notes = clean_up( $_POST[notes] );;
	echo $notes; // outputs: I dont need apostrophes.

// fix the 'private' checkbox
	if  ($_POST['private'] == "private")
		{
		$private = 1;		// if it's checked, private = 1
		}
		else
		{
		$private = 0;		// if unchecked, private = 0
		}
	
///////////////////////// SUBMIT THE FORM ///////////////////////////////
	$form->addButton("Add the waterbodyh");
	$form->render();

////////// TAKE LAT/LON FIND OUT CITY/COUNTY/STATE //////////////
	// get $lat and $lon
	include 'getlocationinfo.php';
	// output $city $county $state
	


// if nothing submitted, don't connect to DB
if ($_POST[name] == "")
	{
	print "name = nothing, so not connecting to the DB";
	}
	else
	{
	print "Connecting to the DB...<br>";
	
/////////////////// Does this waterbody exist already? ///////////////
include 'checkwaterbody.php';

// PUT THE STUFF INTO THE DATABASE
mysql_query(
"INSERT INTO waterbodies(
	name,
	watertype,
	lat,
	lon,
	city,
	county,
	state,
	notes,
	owner,
	private
	) 
	VALUES(
	'$_POST[name]',
	'$_POST[watertype]',
	'$lat',
	'$lon',
	'$city',
	'$county',
	'$state',
	'$notes',
	'$owner',
	'$private'
	)")
	or die(mysql_error()); 
	
	?>
		<script>
		alert("Waterbody submitted!");
		</script>
	<?

// ADD TO THE FEED TABLE

$waterbodyname = $_POST[name];

// create the ADD TO FEED FUNCTION
function addtofeed($username, $activity, $url, $title)
{
	print "Running the 'add to feed' function";
	mysql_query(
	"INSERT INTO feed (username, activity, title, link, private) 
	VALUES ('$username', '$activity', '$title', '$url', '$private')") or die(mysql_error());
}

$waterbodyname = $_POST['name'];
$url = "water.php?name=" . $waterbodyname;

// call the ADD TO FEED FUNCTION
addtofeed($username, 'waterbody_add', $url, $waterbodyname);


} // end of long if/then

?>