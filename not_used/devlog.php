<?php

/* DEVELOPMENT LOG */


include 'config/config.php';
include 'config/connect.php';
include 'header.php';

$pagetitle = "Development Log";
print $header;

print "<div id = 'wrap'>";
print "<div id = 'tripbox'>";

print "<h1>$pagetitle</h1>";

if ( $_SESSION['myusername'] === 'cbfishes' )
{
//print "you are $username";
}
else
{
print "UNDER CONSTRUCTION";
die;
}

// query MYSQL
$result = mysql_query("
SELECT *
FROM devlog
ORDER BY id DESC
LIMIT 100
		");

// take the data and put it into an array
//$row = mysql_fetch_array($result);

// get all the variables
print "<div class = 'devlogbox'>";
while($row = mysql_fetch_array($result))
	{

// grab stuff from the array and make it into variables we can use
$devtimestamp = $row['timestamp'];
$user = $row['user'];
$id = $row['id'];
$type = $row['type'];
$notes = $row['notes'];

print "$devtimestamp - <b>$user</b> - dev_id: $id - $type <BR><br>
	$notes<BR><hr>";

}
print "</div>";
// end of debug box

