<?php

// Get the total number of fish caught by adding up all the numbers
print "<br><b> ------------ addupfish.php ---------</b><br>";

	// syntax
	//	$_POST[input_from_html_form]
$total = 
	$_GET[smallmouth] + 
	$_GET[largemouth] +
	$_GET[greenie] +
	$_GET[bluegill] +
	$_GET[carp] +
	$_GET[drum] +
	$_GET[walleye] +
	$_GET[pike] +
	$_GET[musky] +
	$_GET[bowfin] +
	$_GET[shad] +
	$_GET[creekchub] +
	$_GET[flatheadcatfish] +
	$_GET[channelcatfish] +
	$_GET[browntrout] +
	$_GET[rainbowtrout] +
	$_GET[brooktrout] +
	$_GET[perch] +
	$_GET[stripedbass] +
	$_GET[whiteperch] +
	$_GET[crappie] +
	$_GET[bullhead] +
	$_GET[redeyebass] +
	$_GET[rockbass] +
	$_GET[goby]
	;

print "total fish caught is $total";
// calculate fish points
$fishpoints = $total;
print "<br> $fishpoints points for fish!<br>";

// firgure out if user was SKUNKED
if ( $total == 0 )
	{
	$skunked = 1;
	print "you were skunked! skunked = $skunked";
	}
	else
	{
	$skunked = 0;
	print "you were NOT skunked! skunked = $skunked";
	}
	
?>