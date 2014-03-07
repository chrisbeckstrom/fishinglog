<link rel='stylesheet' href='style.css' type="text/css" />

<?php
$pagetitle = "Search";

include 'config/connect.php';

include 'header.php';
include 'php-form-builder-class/class.form.php';
//include 'config/config.php';

session_start();	// this needs to be here to prevent errors

print $header;

print "<div id='debug'>";

print "The variable \$_GET[booty] = $_GET[booty] <br>";

print "<a href='?booty=big'>big booty</a><br>";
print "<a href='?booty=small'>small booty</a><br>";

$today = date("Y-m-d");
$tomorrow = date("Y-m-d", strtotime("tomorrow"));
$yesterday = date("Y-m-d", strtotime("yesterday"));
$thirtydaysago = date("Y-m-d", strtotime("30 days ago"));
$ninetydaysago = date("Y-m-d", strtotime("90 days ago"));
$weekago = date("Y-m-d", strtotime("7 days ago"));

$timerange = $weekago;

print "Today is $today<br>
		Tomorrow is $tomorrow<br>
		Yesterday was $yesterday<br>
		30 days ago was $thirtydaysago<br>
		90 days ago was $ninetydaysago<br>
		A week ago was $weekago<br>";
print "</div>";

    
// / FORM STUFF ///////////////////////////////////
// $form = new form("googlemaps_0", 500);
// 
//  This sets the arrangement of boxes and whatnot
//  $form->setAttributes(array(
//      "map" => array(3, 1, 1, 2, 3)));
// 
// $form->setAttributes(array(
//     "jsincludesPath" => 'php-form-builder-class/includes'));
// 
// if(!empty($_GET["errormsg_0"]))
//     $form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);
//  
// $form->addHidden("cmd", "submit_0");
// 
// $form->addDate("Date", "searchdate", "", array("jqueryOptions" => array("dateFormat" => "yy-mm-dd")));
// 
// / SUBMIT THE FORM ///////////////////////////////
// $form->addButton("Search");
// $form->render();
// /////////////////////////////////////////////////
	
	

// this just selects the data you can manipulate further
	//$result = mysql_query("SELECT * FROM trips WHERE bluegill >= 1 ORDER BY tripdate");
// 	$result = mysql_query("SELECT trips.tripdate, trips.time, weather.maxtemp
// 							FROM trips
// 							INNER JOIN weather
// 							ON trips.tripdate=weather.date");

// 
//SELECT * FROM trips WHERE tripdate BETWEEN '2012-10-01' AND '2012-11-01' ORDER BY tripdate DESC'

	$result = mysql_query("SELECT * 
							FROM trips,weather 
							WHERE tripdate = '2012-05-10'
							AND weather.timeofday=trips.timeofday
							AND weather.weathercity='Itasca'

	
	
	ORDER BY tripdate DESC");

// take the data and put it into an array
	$row = mysql_fetch_array($result);
	
	print "<HR> array results <BR>";
	
	print $row['relhumidity'];
	
	print "<hr>";
	
	


print "<div id='wrap'>";

while($row = mysql_fetch_array($result))
	{
	print "<div id='tripbox'>";
	echo "<br>Trip date: " . $row['tripdate'];
	echo "<br>Trip date: " . $row{'weather'}->{'weather'};
	echo "<br>maxtemp: " . $row['maxtemp'];
	echo "<br>time: " . $row['time'] . " hours";
	echo "<br>fish caught: " . $row['fishcaught'] . " fish";
	echo "<br>";
	echo "<br>notes: " . $row['notes'];
	print "<br>";
	print "Relative humidity was " . $row['relhumidity'] . "<br>";
	print "Weather time of day was " . $row['50'] . "<br>";
	print "Trips time of day was " . $row['timeofday'] . "<br>";
	
	print "</div>";

	}

	print "</div>";
print "</div>";

print "<br>";


mysql_close($con);









?>