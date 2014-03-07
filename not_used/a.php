<?php

/*

morning 4am - 9am
	040000 until 090000

late morning 9:01am - 11:59am
	090100 until 115900


noon 12pm-2pm
	120000 until 140000

afternoon 2:01pm - 6:00pm
	140100 until 180000

evening 6:01pm - 8pm
	180100 until 

night 8:01pm - 3:59am

*/
	
//$unixtime = strtotime("4:59am");
//print "<br>\$numbertime is $numbertime<BR>";	


// get the unixtime (from the API)	
$unixtime = 1358312947;

// convert that into hour:minute:second
$hms = date("H:i:s", $unixtime);

// make that into an integer
$hour = (int)$hms;

print "The hour is $hour<BR>";

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

print "<BR> the time of day is $timeofday";

print "<br>Nicedate is: $timeofday<br>";

$nicedatemore = $nicedate + 60;

print "<BR>nicedate more is $nicedatemore";

print "TIME TESTING<BR>";

$weatherdate = date("Y-m-d", $weathertime);
print "Weatherdate is $weatherdate<BR>";

$weatherhms = date("H:i:s", $weathertime);
print "Weather HMS is $weatherhms<BR>";

print "Time is $nicedate<br><br>";

print "<BR>";

echo strtotime("+1 week"), "\n";


$i = 2;
switch ($i) {
    case $i >= 5:
        echo "i greater or equal to 5";
        //print "morning";
        break;
    case $i < 5:
        echo "i less than 5";
        break;
    case $i < 0:
        echo "i is less than 0";
        break;
}

print "<br>";

$i = $weatherhms;
switch ($i) {
    case $i <= "06:00:00":
        echo "i equals 06:00:00 - MORNING";
        break;
    case $i > "15:00:00":
        echo "i is more than 2pm";
        break;
    case $i < 0:
        echo "i is less than 0";
        break;
}


	


?>
