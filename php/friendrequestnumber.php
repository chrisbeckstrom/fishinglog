<?php
session_start();

include '../config/config.php';
include '../config/connect.php';


// if there is no user logged in, redirect to login.php
// if(!isset($_SESSION['myusername']))
// 	{
// 	print "You gotta log in to do that!";
// 	header( 'Location: login.php' );
// 	}

$currentuser = $_SESSION['myusername'];

// check the friend_requests table
$pendingrequestsquery = "SELECT * from friend_requests WHERE status = 'pending' AND username = '$currentuser'";
$pendingfriendrequestresult = mysql_query($pendingrequestsquery);
$number_of_results = mysql_num_rows($pendingfriendrequestresult);

print "<a href='requests.php'>$number_of_results</a>";
