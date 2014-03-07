<?php
/* the URLs of the USGS information
salt creek = "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05531175&parameterCd=00060,00065";
fox river montgomery = "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05551540&parameterCd=00060,00065";
rogue rockford = "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118500&parameterCd=00060,00065";

*/
include 'config.php';

// Make an array of the various bodies of water and their URLs
$waters=array(
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05531175&parameterCd=00060,00065", // salt creek wood dale
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05551540&parameterCd=00060,00065", // fox river montgomery
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118500&parameterCd=00060,00065",	// rogue rockford
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118000&parameterCd=00060,00065", // thornapple river caledonia
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05551000&parameterCd=00060,00065",  // fox @ south elgin
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04125550&parameterCd=00060,00065",	// manistee, wellston, MI
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05438500&parameterCd=00060,00065",	// kish, belvidere, IL
	"http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=05529000&parameterCd=00060,00065"	// desplaines river, desplaines IL
	);

foreach($waters as $val) 
{
	$usgsurl = $val;
	print "<h1>The URL we're using now is $val</h1><BR>";
	
	$tzabr = "CST";	// need to change this based on location
	
	if ($usgsurl == "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118500&parameterCd=00060,00065")
		{
		print "<h1> IT'S THE ROGUE!!</h1>";
		$tzabr = "EST";
		}
		
	if ($usgsurl == "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118000&parameterCd=00060,00065")
		{
		print "<h1> IT'S THE THORNAPPLE!!</h1>";
		$tzabr = "EST";
		}

	if ($usgsurl == "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04125550&parameterCd=00060,00065")
		{
		print "<h1> IT'S THE MANISTEE!!</h1>";
		$tzabr = "EST";
		}

print "The URL is : $usgsurl";

// set the timezone
// 
// if ($tzabr == "EST")
// 	{
// 	date_default_timezone_set("America/NewYork");
// 	}
// 
// if ($tzabr == "CST")
// 	{
// 	date_default_timezone_set("America/Chicago");
// 	}



// go get the text and make it into a string
$usgs_text = file_get_contents($usgsurl);
echo $usgs_text;
print "<BR><HR>";
	
	// The rogue river text contains 2 mentions of EST - confuses us!
	if ($tzabr == "EST")
		{
		// find the first EST
		$searching = strstr($usgs_text ,"EST");
// 		print "<BR> this is from EST to the end<BR>";
// 		print $searching;
// 		print "<BR><HR>";
		
		$noest = substr($searching, 3);
// 		print "<BR>Got rid of the first EST: <BR>
// 				$noest <HR>";
				
		$usgs_text = $noest;
		}
		
// DATE
// make the observation time nice
$waterdate = date("Y-m-d");
$watertime = date("H:i:s");

$hms = date("H:i:s");
print "The hms time is $hms<BR>";

// make that into an integer
$hour = (int)$hms;
print "the integer time is $hour<BR>";

// tell us the result
print "The hour is $hour<BR>";

// convert that to time of day, set the $timeofday variable
$t = $hour;
switch ($t) {
    case $t >= 4 && $t < 8:		// between 4am and 8am 
        $timeofday = "morning";			// it's MORNING
        break;
    case $t >= 8 && $t < 12:		// between 8am and 12pm
       $timeofday = "late morning";	// it's LATE MORNING
        break;
    case $t >= 12 && $t < 14:	// between noon and 2pm
       $timeofday = "noon";			// it's LNOON
        break;
    case $t >= 14 && $t < 18:		// between 2 and 6pm
        $timeofday = "afternoon";			// afternoon
        break;
    case $t >= 18 && $t < 20:		// between 6 and 8pm
        $timeofday = "evening";			// evening
        break;
    case $t >= 20 && $t < 25:		// between 10pm and 12am
        $timeofday = "night";			// night
        break;
    case $t >= 0 && $t < 4:		// between 10pm and 12am
        $timeofday = "night";			// night
        break;
	}

// run the weather getter at
//	12am, 2am, 5am, 8am, 12pm, 2pm, 7pm, 9pm

// Extract the water gauge level
	// look for "CST" and display the rest of the string from there
	$searching = strstr($usgs_text ,$tzabr);
// 	print "<BR> this is from CST to the end<BR>";
// 	print $searching;
// 	print "<BR><HR>";
	
	 	
	// remove all letters from the string (to get the number)
	$val=$searching;
	$pattern='/([A-Z])/'; 
	$gauge=preg_replace($pattern,"",$val);
// 	echo "This is the gauge height and discharge without letters"; //1235
// 	print $gauge;
	
	// take those numbers and explode them
	// explode(separator,string,limit) 
	$waterarray = explode("	", $gauge);
// 	print "<BR> the first one is $waterarray[3] <BR>
// 	and the second one is $waterarray[1]";
	
	
	// the Rogue really messes us up.. fix it here:
	if ($usgsurl == "http://waterservices.usgs.gov/nwis/iv/?format=rdb,1.0&sites=04118500&parameterCd=00060,00065")
		{
		$discharge = $waterarray[1];
		$gaugeheight = $waterarray[3];
		}
		else
		{
		$discharge = $waterarray[3];
		$gaugeheight = $waterarray[1];
		}
	

// Extract the USGS site number from the URL
	// look for "&parameter" and delete from there
	$todelete = strstr($usgsurl ,"&parameter");
// 	print "<BR> found this in the URL:<br>";
// 	print $todelete;
// 	print "<BR><HR>";
	
	// cut that shit out
	$betterurl = str_replace($todelete, "", $usgsurl);
// 	print "<BR> here's the URL now:<br>";
// 	print $betterurl;
	
	// look for "&sites" and display the rest of the string from there
	$almostthere = strstr($betterurl ,"&sites=");
// 	print $almostthere;
// 	print "<BR><HR>";
	
	// remove all letters from the string (to get the number)
	$stationID = str_replace("&sites=", "", $almostthere);
// 	echo "<br>The station ID is: $stationID"; //1235
	
// Extract the site name from the text
	// cut out everything before "USGS"
	$searching = strstr($usgs_text ,"USGS");
// 	print $searching;
// 	print "<BR><HR>";
	
	// find everything after #
	$after = strstr($searching ,"#");
// 	print $after;
// 	print "<BR><HR>";
	
	// remove the stuff after the site name
	$almost = str_replace($after, "", $searching);
// 	print "Now we have this: <BR> $almost";
	
	// remove USGS
	$almostthere = str_replace("USGS", "", $almost);
// 	print "<BR>Now we have this: <BR> $almostthere";
	
	// remove numbers
	$sitename = preg_replace("#[^\\/\-a-z\s]#i", "", $almostthere);
// 	print "<BR> Now this: $sitename";
	
// Tell us what we found
	print "<BR> 
				The sitename is <h2>$sitename</h2><BR>
				The station id is $stationID<BR>
				The gauge height is $gaugeheight <BR>
				The discharge is $discharge <BR>";



/* THINGS TO DOCUMENT
waterdate
watertime
sitename
stationid
gaugeheight
discharge
*/

// put this stuff in the DATABASE

// Connect to the server
include 'connect.php';

print "<BR><div id='debug'>Connected to mysql </div>";


// PUT THE STUFF INTO THE DATABASE
mysql_query(
"INSERT INTO waters(
	waterdate,
	watertime,
	timeofday,
	sitename,
	stationid,
	gaugeheight,
	discharge) 
	VALUES
	('$date',
	'$time',
	'$timeofday',
	'$sitename',
	'$stationID',
	'$gaugeheight',
	'$discharge'
	)")
	or die(mysql_error()); 
}

?>