<?php

print "<h1>CB learns PHP </h1>";

print "--------";

print strtotime("September 10, 2012");

// comment //

/* longer
comments
like this
*/

// setting variables

// STRING VARIABLES are values that contain characters
// must be in quotes
$mycar = "Volvo";

// numbers don't have to be in quotes
$number = 345;


print "My car is a $mycar<br>";
print "A number is $number";

// doing math
$result = $number + 2;

print "<br>";

print "The answer is $result";

print "<br>";

// Here is a function with 2 parameters
// function myTest ($parameter1, $parameter2)

// strlen() function
//		can find the length of a string

$length = strlen("popsiclkjkd hsakj hkjhsdes");
print $length;
print "<br>";

// CONCATENATION
// putting strings together
$txt1 = "hello world";
$txt2 = "what a nice day";
echo $txt1 . " " . $txt2;
echo "$txt1 $txt2";
	// same results


// strpos() function
//		searches for characters/text in a string
//	starts counting at 0!
print strpos("abc", "b");
print "<br>";


// result would be 1

// strrev() (prints the string backwards)
print strrev("Chris Beckstrom is cool");
print "<br>";


// bin2hex() 
// converts a 
print bin2hex("Hello!");

/* CONDITIONAL STATEMENTS
if statement - 
use this statement to execute some code only if a specified condition is true
if...else statement - 
use this statement to execute some code if a condition is true and 
another code if the condition is false
if...elseif....else statement - 
use this statement to select one of several blocks of code to be executed
switch statement - 
use this statement to select one of many blocks of code to be executed
*/

print date("Y");

// If, else
$d = date("D");
if ($d=="Fri") 
	{
	echo "Have a nice weekend!";
	}
	else
	{
	echo "Today is not friday";
	}


print "<br>";



// If, elseif, else
// use this to select one of several blocks of code to be executed
if ($d=="Fri")
	{
	echo "today is friday!";
	}
	elseif ($d=="Wed")
	{
	echo "today is wednesday!";
	}
	else ($d=="Mon");
	{
	echo "hey it's monday";
	}
	
	
// wunderground api testing
// wunderground api key: 681a9b949662ace6

$json_string = file_get_contents("http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Itasca.json"); 
$parsed_json = json_decode($json_string); 
print "<br>";
/* SYNTAX
$new_variable = $parsed_json->{'category'}->{'thing in the category'};
*/

$version = $parsed_json->{'response'}->{'version'}; 
$location = $parsed_json->{'location'}->{'city'}; 
$temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
$lat = $parsed_json->{'current_observation'}->{'display_location'}->{'latitude'};
$long = $parsed_json->{'current_observation'}->{'longitude'};
$wind = $parsed_json->{'current_observation'}->{'wind_string'};
$time = $parsed_json->{'current_observation'}->{'observation_time'}; 
print "<br>";
echo "Current temperature in ${location} is: ${temp_f}\n";
print "<br>";
print "Current wind is $wind";
print "<br>";
print "$time";
print "<br>VERSION:";
print "$version";
print "<br>lat and long <br>";
print $lat;
// 

// HISTORY
$json_string = file_get_contents("http://api.wunderground.com/api/681a9b949662ace6/history_YYYYMMDD/q/CA/San_Francisco.json"); 
$parsed_json = json_decode($json_string); 

$ver = $parsed_json->{'response'}->{'version'};
print "<h1>Historical data</h1> <br>";
print "$ver <br>";

$date = $parsed_json->{'history'}->{'date'}->{'pretty'};
print $date;
print "<br>";

$timezone = $parsed_json->{'history'}->{'date'}->{'tzname'};
print "Timezone: $timezone <br>";

$utcdate = $parsed_json->{'history'}->{'utcdate'}->{'tzname'};
print "Timezone: $utcdate <br>";

$utcdate = $parsed_json->{'history'}->{'utcdate'}->{'tzname'};
print "UTCdate: $utcdate <br>";

$time = $parsed_json->{'history'}->{'observations'}->{'date'}->{'pretty'};
print "humidity: $time <br>";






?>
