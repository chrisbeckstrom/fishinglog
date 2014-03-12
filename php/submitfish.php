<?php
print "<b>------------ submitfish.php -------------- </b><br>";
include 'config/config.php';
include 'config/connect.php';

// get the GET stuff from the form
$getarray = $_GET['fishbox'];
$getcountarray = $_GET['fishcount'];
$getweight = $_GET['fishweight'];
$getlength = $_GET['fishlength'];

$username = $_SESSION[myusername];

// add up all the values in the array
// from http://php.net/manual/en/function.array-sum.php		
print "fishcaught = array_sum($_GET[fishcount])";
$fishcaught = array_sum($_GET['fishcount']);
print "fishcount is $fishcount";
print "<br><b>total number of fish caught: $fishcaught</b><br>";

/////////////////
// for each fish caught, get the fishID from the database
foreach ($getarray as $key => $val)

{
		// from http://stackoverflow.com/questions/1685689/how-is-an-array-in-a-php-foreach-loop-read
		// $val is the name of the fish!
		// $key is the ordinal of that fish
	print "<hr> STARTING FOREACH<br>";
	$fishname = $val;	// i.e. smallmouth bass
	
	// don't search the DB for NULL
	if ( $fishname == '' )
		{
			continue;		// move on to the next
		}
		
	// how long was that fish?
	$fishlength = $getlength[$key];
	
	// how heavy was that fish?
	$fishweight = $getweight[$key];	
	
	// find out how many of that species were caught
	$numbercaught = $getcountarray[$key];

	
	// query the 'fish' table to get the fishID
	$fishnamequery = "SELECT fishID, fishbase_name FROM fish WHERE (fishbase_name LIKE '$fishname' OR name LIKE '$fishname')";
	// select fishID, fishbase_name FROM fish WHERE (fishbase_name LIKE 'creek chub')
	print "the query is: <pre>$fishnamequery</pre>";
	
	//Do your query and stuff here
	$fishnameresult = mysql_query($fishnamequery);
	$fishnamerow = mysql_fetch_array($fishnameresult);
	
	
	$fishid = $fishnamerow['fishID'];
	$fishbase_name = $fishnamerow['fishbase_name'];
	
	print "Fish name: $fishbase_name<br>
			Fish id: $fishid<br>
			Number caught: $numbercaught<br>
			<br>";
			
	// put that stuff in the database!
		// as many times as fish of that species were caught!
		$i=1;
		while($i<=$numbercaught)
		{
		$insertfishquery = "INSERT INTO fishcaught (fishID, username, tripnumber, weight, length) 
							VALUES ('$fishid', '$username', '$tripnumber', '$fishweight', '$fishlength')";
		print "this query is: <pre>$insertfishquery</pre>";
		$i++;
						
			// Tell us the results
			if (!mysql_query($insertfishquery,$con))
			  {
			  die('Error: ' . mysql_error());							// error message
				}
		}		
}
print "<hr>";



 
					
					




