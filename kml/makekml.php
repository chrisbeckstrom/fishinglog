<?php
// makekml.php
////////////////////////////////////////////////////

// // FOR USE AS COMMAND LINE
// if (isset($argv[1])) 		// if there is a command line argument
	// {
	// print "argv 1 is $argv[1]";
	// $tripid = $argv[1];
	// }
	// else
	// {
	// print "syntax: php makekml.php USERNAME \n";
	// exit;
	// }

//require('phpsqlajax_dbinfo.php');

include '../config.php';
include '../connect.php';

$username = $_GET["username"];
// print "Username is $username";

// TEMPORARY:
// $username = 'cbfishes';

// Selects all the rows in the markers table.
$query = 'SELECT * FROM trips WHERE username = "$username"';
$result = mysql_query($query);

if (!$result) 
{
  die('Invalid query: ' . mysql_error());
}

// Creates the Document.
$dom = new DOMDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
$restStyleNode = $dom->createElement('Style');
$restStyleNode->setAttribute('id', 'restaurantStyle');
$restIconstyleNode = $dom->createElement('IconStyle');
$restIconstyleNode->setAttribute('id', 'restaurantIcon');
$restIconNode = $dom->createElement('Icon');
$restHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/fishing.png');
$restIconNode->appendChild($restHref);
$restIconstyleNode->appendChild($restIconNode);
$restStyleNode->appendChild($restIconstyleNode);
$docNode->appendChild($restStyleNode);

$barStyleNode = $dom->createElement('Style');
$barStyleNode->setAttribute('id', 'barStyle');
$barIconstyleNode = $dom->createElement('IconStyle');
$barIconstyleNode->setAttribute('id', 'barIcon');
$barIconNode = $dom->createElement('Icon');
$barHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/fishing.png');
$barIconNode->appendChild($barHref);
$barIconstyleNode->appendChild($barIconNode);
$barStyleNode->appendChild($barIconstyleNode);
$docNode->appendChild($barStyleNode);

// Iterates through the MySQL results, creating one Placemark for each row.
while ($row = @mysql_fetch_assoc($result))
{
  // Creates a Placemark and append it to the Document.

  $node = $dom->createElement('Placemark');
  $placeNode = $docNode->appendChild($node);

  // Creates an id attribute and assign it the value of id column.
  $placeNode->setAttribute('id', 'placemark' . $row['tripid']);

	// setup a variable that can fill the bubbles with details about the trip
	$date = $row['date'];
	
	$time = strtotime($date);
	$newformat = date('F d, Y',$time);
	$date = $newformat;
	
	//$notes = addslashes($row['notes']);
	$tripid = $row['tripid'];
	$tripnumber = $row['tripnumber'];
	$url = 'http://cbfishes.com/log/viewtrip.php?tripnumber=' . $tripnumber ;
	$fishcaught = $row['fishcaught'];
	$username = $row['username'];
	
	$details = $date . $notes;

  // Create name, and description elements and assigns them the values of the name and address columns from the results.
  $nameNode = $dom->createElement('name',htmlentities($date));
  $placeNode->appendChild($nameNode);
  $descNode = $dom->createElement('description', "$url <p> tripid = $tripid <br> tripnumber = $tripnumber <br> fishcaught = $fishcaught");
  $placeNode->appendChild($descNode);
  $styleUrl = $dom->createElement('styleUrl', '#' . $row['type'] . 'Style');
  $placeNode->appendChild($styleUrl);

  // Creates a Point element.
  $pointNode = $dom->createElement('Point');
  $placeNode->appendChild($pointNode);

  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
  $coorStr = $row['lon'] . ','  . $row['lat'];
  $coorNode = $dom->createElement('coordinates', $coorStr);
  $pointNode->appendChild($coorNode);
}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;
?>