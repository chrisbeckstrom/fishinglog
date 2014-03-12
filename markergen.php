<?php
session_start();
// from https://developers.google.com/maps/articles/phpsqlajax_v3
$username="root";
$password="supjha2510";
$database="fishingtrips";

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

	$query = "SELECT * FROM trips WHERE lat != 0";

	
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $lat = $row['lat'];
  $lon = $row['lon'];
  $tripuser = $row['username'];
  $tripwaterbody = $row['waterbody'];
  $tripnumber = $row['tripnumber'];
  $tripdate = $row['date'];
  echo '<marker ';
  	// marker popup title
	echo 'name="' . parseToXML("$tripuser @ $tripwaterbody") . '" ';
	// marker popup smaller text
	echo 'address="' . parseToXML("sjhkahskhd") . '" ';
	echo 'tripnumber="' . parseToXML("$tripnumber") . '" ';
	echo 'tripdate="' . parseToXML("$tripdate") . '" ';
  echo 'lat="' . $lat . '" ';
  echo 'lng="' . $lon . '" ';
echo 'type="' . "SOMETHING" . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
