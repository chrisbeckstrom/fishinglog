<?php
session_start();

/*
UPDATE TRIP PAGE

Look at old trips and update them
* no lat/lon? add it
etc.

*/

 ?>
<link rel='stylesheet' href='css/style.css' type="text/css" /> 
	
<?

// get the trip_id from GET.. otherwise...
$tripid = $_POST["tripid"];

if (!isset($tripid))
	{
	//print "Tripid not set! Type one in the URL";
	$tripid = $_GET["tripid"];
	}

//print "Trip ID is $tripid";

// if (!isset($tripid))
// 	{
// 	print "No trip id. Nothing to see here.";
// 	}
// 	else
// 	{

$username = $_SESSION['myusername'];
include 'security.php';

include 'header.php';
include 'footer.php';
include 'connect.php';

print $header;?>
<div style="
margin-top:100px;
margin-left:100px;">

<?


// Figure out what to show based on who is viewing
if(isset($_SESSION['myusername']))
	{
	// USER LOGGED IN: only show private trips where user=owner
	//print "USER LOGGED IN! it's $username";
	$result = mysql_query("
SELECT *
FROM trips
WHERE username = '$username'
AND tripid = $tripid
			");
	}
	else
	{
	// NOBODY LOGGED IN: don't show any private trips
	//print "NOBODY LOGGED IN! hiding private waters";
	print "Sorry, you gotta be logged in to do that, yo.";
	}
	
// take the data and put it into an array
$row = mysql_fetch_array($result);

// get all the variables
//while($row = mysql_fetch_array($result))
//	{

// these are things we care about on trips.php:
$tripdate = $row['date'];
$private = $row['private'];
$notes = $row['notes'];
$waterbody = $row['waterbody'];
$tripuser = $row['username'];
$currentlatlon = "lat: " . $row['lat'] . "Lon: " . $row['lon'];

$next = ($tripid + 1);
$previous = ($tripid -1);

print "<BR>
<a href='updatetrip.php?tripid=$previous'>PREVIOUS: trip id $previous</a> -
<a href='updatetrip.php?tripid=$next'>NEXT: trip id $next</a>

<br> Here's what we found: User: $myusername <BR>
Tripdate: $tripdate tripid: $tripid private?: $private <BR>
notes: $notes
<br>
waterbody: $waterbody <BR>
<br>current lat lon info in DB: $currentlatlon";

print "<HR> <h1>Add lat and long! </h1><br>";

include 'php-form-builder-class/class.form.php';
session_start();	// this needs to be here to prevent errors

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
	$form->addLatLng("", "lat_plus_long", array(41.983, -88.013), array( "style" => "width: 100%", "height" => 500, "width" => 999, "zoom" => 15));
	
	// TRIPID
	$form->addTextbox("tripid", "tripid", "$tripid");
	

///////////////////////// CLEANING /////////////////////////////////////
// CLEAN LATITUDE AND LONGITUDE
	$dirty = "$_POST[lat_plus_long]";
	$badwords = array("Latitude: ", "Longitude: "); 
	$clean = str_replace($badwords, "", $dirty );
	
	$data = $clean;
	list($lat, $lon) = explode(", ", $data);
	print "</div>";

///////////////////////// SUBMIT THE FORM ///////////////////////////////
	$form->addButton("submit");
	$form->render();
	
	


// if nothing submitted, don't connect to DB
if ($lat == "")
	{
	print "lat = nothing, so not connecting to the DB";
	}
	else
	{
	print "Connecting to the DB...<br>";
	
/////////////////// Does this waterbody exist already? ///////////////
//include 'checkwaterbody.php';

$tripid = $_POST['tripid'];

// latlon

// combine those two values together		
$latlon = "$lat, $lon";

	
////////// TAKE LAT/LON FIND OUT CITY/COUNTY/STATE //////////////
$xmlstr = "http://api.geonames.org/extendedFindNearby?lat=$lat&lng=$lon&username=chrisbeckstrom";

print "The url is <a href=$xmlstr>$xmlstr</a>";

// go get the XML
$xml = simplexml_load_file($xmlstr);
// genname[3] = state
// geoname[4] = county
// geoname[5] = city

// $state = $xml->geoname[3]->name;
// $county = $xml->geoname[4]->name;
// $city = $xml->geoname[5]->name;


// it appears more digits in the lat lon will cause a different XML to be returned
$state = $xml->address->adminName1;
$county = $xml->address->adminName2;
$city = $xml->address->placename;

print "<hr><BR>
state: $state <BR>
county: $county <BR>
city: $city <BR>";

////

print "<br> Tried to get lat and lon<br>
we found: lat: $lat and lon: $lon <br>
<b> and the trip id is: $tripid </b>";

// PUT THE STUFF INTO THE DATABASE
mysql_query("
UPDATE trips
SET lat = $lat,
	lon = $lon,
	latlon = '$latlon'
	WHERE tripid = '$tripid'
")

	or die(mysql_error()); 
	
	?>
		<script>
		alert("Trip updated!");
		</script>
	<?

// ADD TO THE FEED TABLE
// 
// $waterbodyname = $_POST[name];
// 
// // create the ADD TO FEED FUNCTION
// function addtofeed($username, $activity, $url, $title)
// {
// 	print "Running the 'add to feed' function";
// 	mysql_query(
// 	"INSERT INTO feed (username, activity, title, link, private) 
// 	VALUES ('$username', '$activity', '$title', '$url', '$private')") or die(mysql_error());
// }
// 
// $waterbodyname = $_POST['name'];
// $url = "water.php?name=" . $waterbodyname;
// 
// // call the ADD TO FEED FUNCTION
// addtofeed($username, 'waterbody_add', $url, $waterbodyname);
// 

} // end of long if/then

?>
