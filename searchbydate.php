<?php

include 'php-form-builder-class/class.form.php';
session_start();	// this needs to be here to prevent errors

    
///////////////////////// FORM STUFF ///////////////////////////////////
$form = new form("googlemaps_0", 500);

// This sets the arrangement of boxes and whatnot
// $form->setAttributes(array(
//     "map" => array(3, 1, 1, 2, 3)));

$form->setAttributes(array(
    "jsincludesPath" => 'php-form-builder-class/includes'));

if(!empty($_GET["errormsg_0"]))
    $form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);
 
$form->addHidden("cmd", "submit_0");

$form->addDate("Date", "searchdate", "", array("jqueryOptions" => array("dateFormat" => "yy-mm-dd")));

///////////////////////// SUBMIT THE FORM ///////////////////////////////
$form->addButton("Search");
$form->render();
/////////////////////////////////////////////////////////////////////////


print "<br> this is the date you submitted:<br>" . $_POST[searchdate];

// CONNECT TO THE SERVER
$con = mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!");
if (!$con)
  {
  die('Oops, could not connect: ' . mysql_error());	// error message
  }
  
// Choose the database
	mysql_select_db("fishingtrips", $con);	
	

// this just selects the data you can manipulate further
	//$result = mysql_query("SELECT * FROM trips WHERE bluegill >= 1 ORDER BY tripdate");
	$result = mysql_query("SELECT tripdate,notes FROM trips WHERE tripdate = '$_POST[searchdate]'");


// take the data and put it into an array
	$row = mysql_fetch_array($result);

//print $row['tripdate'];
print "<br>";
print "<br>Trying to show you stuff.." . "<br>Date = " . $searchdate . "<br>";

	echo "<br>Trip date: " . $row['tripdate'];
	echo "<br>Notes: " . $row['notes'];

while($row = mysql_fetch_array($result))
	{
	echo $row['tripdate'] . " " . $row['notes'];
	echo "<br>";
	}


print "<br>";


mysql_close($con);









?>