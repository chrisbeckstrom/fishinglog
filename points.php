<?php

// POINTS CALCULATOR
// this script just adds up points to get the total points for a trip

print "<b><br>---------------- points.php ---------------</b><br>";

// going fishing = 5 points automatically
// caught 1 fish = 1 point
// new water = 5 points
// new species = 20 points
// personal best = 20 points

//include 'newwatertest.php';

if ( $newwater == '1')
	{
		print "new water = 1!!";
		$newwaterpoints = 5;
	}
else
	{
		$newwaterpoints = 0;
	}

$points = 5 +
		$fishpoints + 
		$newwaterpoints + 
		$adventure + 
		$scenic + 
		$ninja +
		$pbpoints;
		
print "---------------<br>
	fish points: $fishpoints <br>
	new water points: $newwaterpoints <br>
	adventure points: $adventure <br>
	scenic points: $scenic <br>
	ninja points: $ninja <br>";
print "---------------<br> total points: $points";

?>