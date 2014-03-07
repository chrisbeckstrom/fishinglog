<?php

// designate a trip as NEW WATER

// get the trip_id from GET.. otherwise...
$tripid = $_GET["tripid"];

?>
<link rel='stylesheet' href='style.css' type="text/css" />
<?

$username = $_SESSION['myusername'];

include 'config/config.php';
include 'header.php';
//include 'footer.php';
include 'config/connect.php';

print $header;
include 'php/security.php';

print "<div id = 'wrap'>";
print "setting tripid $tripid as a new water";

$con=mysqli_connect($DBurl,$DBuser,$DBpass,$DBdb);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"UPDATE trips SET newwater = 1 WHERE tripid = $tripid");
