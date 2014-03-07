<?php

// RECORD THAT THIS USER LOGGED IN
print "<br>RECORDLOGIN.PHP</br>";
include '../config/config.php';
include '../config/connect.php';


$loginquery="INSERT INTO logins (username) VALUES ('$myusername')";
// show us the query
print "<br> -------- THE SQL QUERY --------- <br><pre> $loginquery </pre>";

// Tell us the results
if (!mysql_query($loginquery,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);

print "<BR>END OF RECORDLOGIN.PHP</BR>";
//////////////////////////////////
?>