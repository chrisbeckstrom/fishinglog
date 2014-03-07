<?php

// SPECIES COUNT
// this script takes a TRIPID and tries to figure out how many of each species were caught
include 'config.php';
include 'connect.php';

// FOR TESTING
	$username = 'cbfishes';
	$tripnumber = 406;

print "<br><br><b>------ speciescount.php -------</b><br>";



// if the user didn't catch any fish, don't run this
if ($fishcaught = 0 )
	{
		print "no fish caught- can't test for new species";
	}
else
	{
		print "some fish caught! starting the new species test<br>";
	}


// Get the info from that trip
$result = mysql_query("
SELECT *
FROM trips
WHERE tripnumber = $tripnumber
		");
	
	// take the data and put it into an array
	$row = mysql_fetch_array($result);
	
	// get stuff we want from the DB
	$fishcaught = $row['fishcaught'];
	
	// tell us something about the trip
	print "<b>caught $fishcaught fish</b> now let's see what they are...<br><br><br>";

	
// For each species/row in the SPECIES table
$speciesquery = 'select * from species';
$speciesqueryresult = mysql_query($speciesquery);

	while($row = mysql_fetch_array($speciesqueryresult))
		{
		$speciesname = $row['species'];
		print $speciesname;
		print "<br>";
	
		$speciescountquery = "select $speciesname from trips where username = '$username' and $speciesname > 0 and tripnumber = $tripnumber";
		print "The sql query is <pre>$speciescountquery</pre><br>";
		$speciescountresult = mysql_query($speciescountquery);
		
		$speciescountresult_count = mysql_num_rows($speciescountresult );
		$speciescountqueryarray = mysql_fetch_array($speciesqueryresult);
		print "speciescountqueryarray is " . $speciescountqueryarray['smallmouth'];
	
	print "speciescountresult (number of rows returned) is $speciescountresult_count <br>";
	
	if ( $speciescountresult_count > 0 )
		{
		print "$username caught $speciesname on trip $tripnumber <br>";
		
		print "fishycount is $fishycount<br>";
		
		
			if( !isset($speciescaught) )
				{
				// if this is the first species in the speciescaught list...
				print "SPECIESCAUGHT IS NOT SET!<br>";
				print "<b> SPECIESNAME is $speciesname <b>";
				
				$speciescaught = $species . " " . $speciesname;
				print "Speciescaught is $speciescaught<br>"; 
				}
			else
				{
				// if this is not the first species in the speciescaught list
				print "speciescaught is  set (it's $speciescaught)<br>";
				$speciescaught = $speciescaught . ", " . $speciescountresult_count . " " . $row['species'];
				print "<pre>speciescaught is now $speciescaught</pre><br>";
				}
		
		}
		else
		{
			print "$username did not catch any $speciesname on that trip<br>";
		}
	
	print "---------------------------<br>";


}