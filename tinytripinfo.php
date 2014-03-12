<?php

// TINY TRIP INFO
// just a line or two about a trip

	$ttdate = $row['date'];
	
	$tttripnumber = $row['tripnumber'];
	$ttstate = $row['state'];
	
	// HIDE THE WATERBODY?
	$ttwatertype = $row['watertype'];
	$tttripwaterbody = $row['waterbody'];
	if ( $hidethings == 1 )
		{
		$tttripwaterbody = disguise($tttripwaterbody);
		}
		else {
			$tttripwaterbody = $tttripwaterbody;
		}
	
	$ttnewwater = $row['newwater'];
	// HIDE NOTES?
	$ttnotes = $row['notes'];
	if ( $hidethings == 1 )
		{
		// disuise anything in brackets
		$ttnotes = disguiseBrackets($ttnotes);
		}
	else {
		// remove the brackets from notes
	$ttnotes = str_replace("[","",$ttnotes);
	$ttnotes = str_replace("]","",$ttnotes);
	}
	
	
	
	$ttnotesbetter = str_replace("'", "\'",$ttnotes);
	$ttmetar = $row['metar'];
	?>
	<small>
	<? print $ttdate ?> / <a onmouseover="nhpup.popup('<? print $ttnotesbetter ?>');"
	href='viewtrip.php?tripnumber=<? print $tttripnumber ?>'>
		<b><nobr><? print $tttripwaterbody ?></b></a>, 
		<? print $ttstate ?> </nobr><br></small>
		

