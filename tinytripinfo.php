<?php

// TINY TRIP INFO
// just a line or two about a trip

	$date = $row['date'];
	
	$tripnumber = $row['tripnumber'];
	$state = $row['state'];
	
	// HIDE THE WATERBODY?
	$watertype = $row['watertype'];
	$tripwaterbody = $row['waterbody'];
	if ( $hidethings == 1 )
		{
		$tripwaterbody = disguise($tripwaterbody);
		}
		else {
			$tripwaterbody = $tripwaterbody;
		}
	
	$newwater = $row['newwater'];
	// HIDE NOTES?
	$notes = $row['notes'];
	if ( $hidethings == 1 )
		{
		// disuise anything in brackets
		$notes = disguiseBrackets($notes);
		}
	else {
		// remove the brackets from notes
	$notes = str_replace("[","",$notes);
	$notes = str_replace("]","",$notes);
	}
	
	
	
	$notesbetter = str_replace("'", "\'",$notes);
	$metar = $row['metar'];
	?>
	<small>
	<? print $date ?> / <a onmouseover="nhpup.popup('<? print $notesbetter ?>');"
	href='viewtrip.php?tripnumber=<? print $tripnumber ?>'>
		<b><nobr><? print $tripwaterbody ?></b></a>, 
		<? print $state ?> </nobr><br></small>
		

