<?php
include 'config.php';
include 'connect.php';

$query = "
	DESCRIBE fish
			";
}

if ( $show_query == 'on' )
	{
print "<br> <pre>$query</pre><br>";
	}

$starttime = microtime(true);

//Do your query and stuff here
$result = mysql_query($query);

$endtime = microtime(true);
$duration = $endtime - $starttime; //calculates total time taken
$rest = substr($duration, 0, -12);  // returns "abcde"


$number_of_results = mysql_num_rows($result);


print "<i>found $number_of_results results (in $rest seconds):</i><br><br>";
print "</span>";
		
// take the data and put it into an array
//$row = mysql_fetch_array($result);

// get all the variables
while($row = mysql_fetch_array($result))
	{
	include 'tripinfo-short.php';
	}
	
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}