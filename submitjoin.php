<?php
// ADD A NEW USER TO THE USER TABLE!
//		from join.php (using signup keys)
session_start();

include 'config/config.php';
include 'config/connect.php';

// OPEN UP A LOG FILE TO WRITE STUFF
$logfile = "join.log";
$fh = fopen($logfile, 'a') or die("can't open file");

// write to log: basic info
	$logthis = "\n *************** NEW join.php submitted **********************";
	fwrite($fh, $logthis);

// GET STUFF FROM THE join.php FORM

$realname = $_GET['name'];
$password = $_GET['mypassword'];
$newusername = $_GET['newusername'];
$avatarurl = $_GET['avatarurl'];
$email = $_GET['email'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$gps = $lat . "," . $lon;
$key = $_GET['signupkey'];
$location = $_GET['location'];

	$logthis = "\n realname: $realname \n
				username: $newusername \n
				avatarurl: $avatarurl \n
				email: $email \n
				gps = $gps \n
				key = $key \n
				location = $location";
	fwrite($fh, $logthis);



// add a new row to friend_requests table
$sql="INSERT INTO users 
	(username, userrealname, password, email, useravatarurl, location, GPS)
	VALUES 
	('$newusername','$realname','$password', '$email', '$avatarurl', '$location', '$gps')";
	
	
print "the new user query is: <pre> $sql </pre>";

	$logthis = "\n query: $sql";
	fwrite($fh, $logthis);
	
// Tell us the results
if (!mysql_query($sql,$con))
  {
  $message='User creation failed :-(';
  die('Error: ' . mysql_error());							// error message
  	$logthis = "\n SQL error: " . mysql_error();
	fwrite($fh, $logthis);
	}
	else
	{

	print "new user created!";
		$message= 'User account created! :-)';
	
	// mark this signup key as USED
	$sql="UPDATE signup_keys SET used = '1' WHERE signup_key = '$key'";
	
	print "the signup key query is: <pre> $sql </pre>";
		$logthis = "\n signup key query is: $sql \n";
		fwrite($fh, $logthis);
		
	// Tell us the results
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());							// error message
			$logthis = "\n SQL error: " . mysql_error();
			fwrite($fh, $logthis);
	}
	
	}



mysql_close($con);

// take the user to the login page
header("location:login.php?message=$message");