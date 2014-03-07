<?php

$link = mysql_connect('mysql.cbfishes.com', 'cbfishescom', '6thZcnd!');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db("fishingtrips")) {
   echo "Unable to select mydbname: " . mysql_error();
   exit;
}

// $result = mysql_query("SELECT name FROM  sks_waterbody");
// while ($row = mysql_fetch_assoc($result)) {
//    		$waterbodys[]=$row['name'];
// }


$result = mysql_query("SELECT city FROM  trips");
while ($row = mysql_fetch_assoc($result)) {
   		$waterbodys[]=$row['name'];
}
mysql_free_result($result);
mysql_close($link);

// check the parameter
if(isset($_GET['part']) and $_GET['part'] != '')
{
	// initialize the results array
	$results = array();

	// search waterbodys
	foreach($waterbodys as $waterbody)
	{
		// if it starts with 'part' add to results
		if( strpos($waterbody, $_GET['part']) === 0 ){
			$results[] = $waterbody;
		}
	}

	// return the array as json with PHP 5.2
	echo json_encode($results);
}