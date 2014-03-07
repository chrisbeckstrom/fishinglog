<?php
session_start();
/*
This is the WATERBODIES page

*/

// get the trip_id from GET.. otherwise...
?>
<link rel='stylesheet' href='css/style.css' type="text/css" />
<?php


$pagetitle = "Waterbodies";

include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print $header;

?>
<div id='main'>
		   <nav>nav</nav>
    <aside>
	<?php include 'sidebar.php'; ?>
	
	</aside>
		
    <article>
    	<box>
    	<h1>Waters</h1>
    	</box>
    	
    	<box>
    	<?

// go get the distinct waterbodies

		
$username = $_SESSION['myusername'];

// 2 variations of search depending on who's logged in			
// if the MYUSERNAME is not set, redirect to the login page
if(isset($_SESSION['myusername']))
	{
	// USER LOGGED IN: only show private waters where user=owner
	//print "USER LOGGED IN! it's $username<br>";
	$result = mysql_query("
	SELECT * 
	FROM waterbodies
	ORDER BY name ASC
			");
	}
	else
	{
	// NOBODY LOGGED IN: don't show any private waters
	//print "NOBODY LOGGED IN! hiding private waters";
	$result = mysql_query("
	SELECT * 
	FROM waterbodies 
	WHERE private = 0 
	ORDER BY name ASC
			");
	}
		
		
		
// IF NO USER LOGGED IN: don't show ANY private waterbodies
		
// take the data and put it into an array
$row = mysql_fetch_array($result);


// get all the variables
while($row = mysql_fetch_array($result))
	{
		
$name = $row['name'];
$watertype = $row['watertype'];
$lat = $row['lat'];
$lon = $row['lon'];
$city = $row['city'];
$county = $row['county'];
$state = $row['state'];
$notes = $row['notes'];
$owner = $row['owner'];
$private = $row['private'];
$id = $row['id'];


print "<b><a href='water.php?name=$name'>$name</a></b> - $city $county $state<p>";


if ($private == '1')
	{
	print " (private)";
	}


}
	?>
	</box>