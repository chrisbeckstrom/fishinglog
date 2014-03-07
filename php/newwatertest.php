<?php

// NEW WATER TEST
// this script looks to see if this is new water or not

print "<br><b>------ newwatertest.php -------</b><br>";

// search the DB
$newwaterquery = "SELECT waterbody FROM trips WHERE waterbody LIKE '%$waterbody%'";
$newwaterresult = mysql_query($newwaterquery);
$newwaterresult_count = mysql_num_rows($newwaterresult);

print "<br>the newwater query is <pre>$newwaterquery</pre> ";
print "<br>newwaterresult is $newwaterresult_count<br>";

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

?>
