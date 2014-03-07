<?php

// NEW SPECIES TEST
// this script looks to see if the user caught a new species

print "<br><br><b>------ newspeciestest.php -------</b><br>";

// if the user didn't catch any fish, don't run this
if ($fishcaught = 0 )
	{
		print "no fish caught- can't test for new species";
	}
else
	{
		print "some fish caught! starting the new species test";
	}
	
// figure out which fish this user caught
	// find something that isn't set?

// for testing purposes only:
	$species = 'musky';
	
// 
//Do your query and stuff here
$speciesquery = 'select * from species';
$speciesqueryresult = mysql_query($speciesquery);

while($row = mysql_fetch_array($speciesqueryresult))
	{
	print $row['species'];
	$species = $row['species'];
	print "<br>";


//
$newspeciesquery = "select tripid, musky, notes from trips where username = '$username' and $species > 0;";
$newspeciesresult = mysql_query($newspeciesquery);
$newspeciesresult_count = mysql_num_rows($newspeciesresult);

print "<br>the new species query is <pre>$newspeciesquery</pre> ";
print "<br>new species count is $newspeciesresult_count<br>";

if ( $newspeciesresult_count > 0 )
	{
		print "$username has caught this fish on $newspeciesresult_count trips before<br>";
	}
else {
		print "$username has never caught this fish!<br>";
	}

}
die;



if ($newwaterresult_count > 0 )
	{
	print "the user has fished there $newwaterresult_count times";
	}
else
	{
		print "this is new water!";
		$newwater = 1;
		print "<br> 5 points for new water!<br>";
		$newwaterpoints = 5;
	}
