<?php

// delete a trip

// get the trip_id from GET.. otherwise...
$tripid = $_GET["tripid"];

?>
<link rel='stylesheet' href='style.css' type="text/css" />
<?

$pagetitle = "All trips";
$url = 'trips.php';
$username = $_SESSION['myusername'];

include 'config.php';
include 'header.php';
//include 'footer.php';
include 'connect.php';

print $header;
include 'security.php';

print "<div id = 'wrap'>";
print "Deleting tripid $tripid";

$con=mysqli_connect($DBurl,$DBuser,$DBpass,$DBdb);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"DELETE FROM trips WHERE tripid = $tripid");