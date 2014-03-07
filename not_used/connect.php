<?php
#session_start(); 
#include 'config/config.php';	// we don't need this because 'config.php' is already in every file

// CONNECT TO THE SERVER
$con = mysql_connect($DBurl,$DBuser,$DBpass);
if (!$con)
  {
  die("<div id = 'debug'>Oops, could not connect:"  . mysql_error()) . "</div>";	// error message
  }
  
// Choose the database
	mysql_select_db($DBdb, $con);
?>