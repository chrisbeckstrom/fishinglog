<?php

// POINTS CALCULATOR
// this script just adds up points to get the total points for a trip

print "<b><br>---------------- points.php ---------------</b><br>";
	$logthis = "\n -- starting points.php --";
	fwrite($fh, $logthis);

// going fishing = 5 points automatically
// caught 1 fish = 1 point
// new water = 5 points
// new species = 20 points
// personal best = 20 points

//include 'php/newwatertest.php';

if ( $newwater == '1')
	{
		print "new water = 1!!";
			$logthis = "\n new water: 1 -> 5 points! whoohooo!";
			fwrite($fh, $logthis);
		$newwaterpoints = 5;
	}
else
	{
		$newwaterpoints = 0;
			$logthis = "\n not new water";
			fwrite($fh, $logthis);
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
	
	
	$logthis = "\n 5 points for fishing because fishing is awesome
				fish points: $fishpoints \n
				new water points: $newwaterpoints \n
				adventure points: $adventure \n
				scenic points: $scenic \n
				ninja points: $ninja";
	fwrite($fh, $logthis);
	
print "---------------<br> total points: $points";
	$logthis = "\n total points: $points";
	fwrite($fh, $logthis);
	
	$logthis = "\n -- end of points.php --";
	fwrite($fh, $logthis);

?>