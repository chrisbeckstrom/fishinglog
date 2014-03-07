<link rel='stylesheet' href='style.css' type="text/css" />

<?php
/* ADD A SPOT

copied and pasted from ADD A WATERBODY

**** A form to add a new fishing spot
		adds it to the SPOTS table
		
	if the waterbody doesn't exist in the waterbodies table,
		adds the waterbody to the WATERBODIES table as well!

*/

$pagetitle = "Add a spot";

include 'config.php';
include 'connect.php';
include 'header.php';
include 'php-form-builder-class/class.form.php';
include 'checkifrowexists.php';

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

//print "<h3> You are creating this as $username</h3>";

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

// SPOT NAME
$form->addTextbox("Name", "name");

// WATERBODY NAME
$form->addTextbox("Waterbody name", "waterbodyname");

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
$form->addButton("Add the spot!");
$form->render();

// if nothing submitted, don't connect to DB
if ($_POST[waterbodyname] == "")
	{
	print "name = nothing, so not connecting to the DB";
	}
	else
	{
	print "Connecting to the DB...<br>";


// PUT THE STUFF INTO THE DATABASE
mysql_query(
"INSERT INTO spots(
	name,
	waterbody,
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
	'$_POST[waterbodyname]',
	'$_POST[watertype]',
	'$lat',
	'$lon',
	'$_POST[city]',
	'$county',
	'$_POST[state]',
	'$notes',
	'$owner',
	'$private'
	)")
	or die(mysql_error()); 

	
// ADD TO THE FEED TABLE

$waterbodyname = $_POST[name];

// create the ADD TO FEED FUNCTION
function addtofeed($username, $activity, $title, $url, $private)
{
	print "Running the 'add to feed' function";
	mysql_query(
	"INSERT INTO feed (username, activity, title, link, private) 
	VALUES ('$username', '$activity', '$title', '$url', '$private')") or die(mysql_error());
}

$newspotname = $_POST['name'];
$url = "spot.php?name=" . $newspotname;

// call the ADD TO FEED FUNCTION
addtofeed($username, 'spot_add', $newspotname, $url, $private);



// If the waterbody DOES NOT EXIST in the DB, add it!
// 	and use these coordinates as the point of that waterbody

$waterbodyname = $_POST[waterbodyname];

// call the "check..exists" function, passing the waterbody name as a param
checkifwaterbodyexists($waterbodyname);

if ( $exists == 0 )
		{
		print "It doesn't exist!- adding it to the waterbodies table<BR>";
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
			owner,
			private
			) 
			VALUES(
			'$waterbodyname',
			'$_POST[watertype]',
			'$lat',
			'$lon',
			'$_POST[city]',
			'$county',
			'$_POST[state]',
			'$owner',
			'$private'
			)")
			or die(mysql_error()); 
		
			
		// ADD TO THE FEED TABLE
		$waterbodyname = $_POST['name'];
		$url = "water.php?name=" . $waterbodyname;
		
		// call the ADD TO FEED FUNCTION
		addtofeed($username, 'waterbody_add', $url, $waterbodyname, $private);
				
				
		}
		else
		{
		print "Waterbody found in the database. No need to add it again. <BR>";
		}


} // end of long if/then

?>