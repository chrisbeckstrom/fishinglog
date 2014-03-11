<?php
session_start();

include 'config/config.php';
include 'config/connect.php';

// receive GET information and connect to the DB

// if there is no user logged in, redirect to login.php
// if(!isset($_SESSION['myusername']))
// 	{
// 	print "You gotta log in to do that!";
// 	header( 'Location: login.php' );
// 	}

	
$friend = $_GET['friend'];

print "$requesting_username wants to be friends with $friend <br>";

// add a new row to friend_requests table
$sql="INSERT INTO friend_requests (
	requesting_username, username, status
	)
	VALUES (
	'$requesting_username', '$friend', 'pending'
	)";
	
	
print "the query is: <pre> $sql </pre>";
	
// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);

print "friend request submitted!";