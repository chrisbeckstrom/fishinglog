<?php
//session_start();

// This script gets a USGS site ID and a date, and uses that information to go get
// information about the streamflow

// gets: $site_no, $date
// outputs: $sitecode, $discharge, $datetime, $gaugeheight

/*		WHAT HAPPENS:
		1) Fill out trip log (form.php) - sends results to submit.php
		2) submit.php finds the location based on lat/lon; outputs the $city
		3) $city and $waterbody are passed to findgauge.php; that outputs the $site_no
		4) this script gets the $site_no and $date, and goes and gets streamflow information
			and outputs $sitecode, $discharge, $datetime and $gaugeheight
		5) those can then be added into the TRIPS table along with all the other trip stuff
		
*/

$date = $tripdate;

print "getstreamflow: using $date as date, and $site_no as site number <br>";
print "getstreamflow.php site_no is<br>$site_no<br>";

// parameters: 00060 = discharge, 00065 = gauge height
$usgsurl = "http://waterservices.usgs.gov/nwis/iv/?format=json&sites=$site_no&startDT=$date&endDT=$date&parameterCd=00060,00065";
print "<b>----- getstreamflow.php ----</b><br>";
print "the url is <pre>$usgsurl</pre> <br>";

// sometimes spaces sneak into the url! fix'em- remove all whitespace from URL
$usgsurl = preg_replace('/\s+/', '', $usgsurl);

// load the json file from USGS
$usgs = file_get_contents($usgsurl);
$result = json_decode($usgs);

// GET STUFF from the json file
echo $result->value->queryInfo->creationTime;
print "<br>";
echo $result->value->timeSeries[0]->sourceInfo->siteName;

// SITE CODE
print "<br> site code: ";
$sitecode = $result->value->timeSeries[0]->sourceInfo->siteCode[0]->value;
echo $sitecode;

// THE FIRST VARIABLE
print "<br> variable name 1: ";
$varname1 = $result->value->timeSeries[0]->variable->variableName;
echo $varname1;

print "<br> var1: ";
$var1 = $result->value->timeSeries[0]->values[0]->value[0]->value;
echo $var1;

	// figure out what kind of data this is
	if (strpos($varname1,'Streamflow') !== false) 
		{
		echo "varname1 contains streamflow<br>";
		print "var1 must be the DISCHARGE!";
		$discharge = $var1;
		}
		
	if (strpos($varname1,'height') !== false) 
		{
		echo "varname1 contains height<br>";
		print "var1 must be the GAGE HEIGHT!";
		$gaugeheight = $var1;
		}


// THE SECOND VARIABLE
print "<br> variable name 2: ";
$varname2 = $result->value->timeSeries[1]->variable->variableName;
echo $varname2;

print "<br> var2: ";
$var2 = $result->value->timeSeries[1]->values[0]->value[0]->value;
echo $var2;

	// figure out what kind of data this is
	if (strpos($varname2,'Streamflow') !== false) 
		{
		echo "varname2 contains streamflow<br>";
		print "var2 must be the DISCHARGE!";
		$discharge = $var2;
		}
		
	if (strpos($varname2,'height') !== false) 
		{
		echo "varname2 contains height<br>";
		print "var2 must be the GAGE HEIGHT!";
		$gaugeheight = $var2;
		}

// DATETIME
print "<br> datetime ";
$datetime = $result->value->timeSeries[0]->values[0]->value[0]->dateTime;
echo $datetime;

// show what we found
print "<br> discharge is $discharge cfs <br> gaugeheight is $gaugeheight ft<br>";