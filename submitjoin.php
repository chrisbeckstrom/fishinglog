<?php
// ADD A NEW USER TO THE USER TABLE!
//		from join.php (using signup keys)
session_start();

include 'config/config.php';
include 'config/connect.php';

// GET STUFF FROM THE join.php FORM

$realname = $_GET['name'];
$password = $_GET['mypassword'];
$newusername = $_GET['myusername'];
$avatarurl = $_GET['avatarurl'];
$email = $_GET['email'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$gps = $lat . "," . $lon;
$key = $_GET['signupkey'];
$location = $_GET['location'];



// add a new row to friend_requests table
$sql="INSERT INTO users 
	(username, userrealname, password, email, useravatarurl, location, GPS)
	VALUES 
	('$newusername','$realname','$password', '$email', '$avatarurl', '$location', '$gps')";
	
	
print "the new user query is: <pre> $sql </pre>";
	
// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}
	else
	{

print "new user created!";

// mark this signup key as USED
$sql="UPDATE signup_keys SET used = '1' WHERE signup_key = '$key'";

print "the signup key query is: <pre> $sql </pre>";
	
// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}
	
	}





mysql_close($con);