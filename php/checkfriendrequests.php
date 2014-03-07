<?php
session_start();

include '../config/config.php';
include '../config/connect.php';


// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}

print "<h2>Friend requests</h2>";

$currentuser = $_SESSION['myusername'];
print "<h2> current user: $currentuser </h2>";

// check the friend_requests table
$pendingrequestsquery = "SELECT * from friend_requests WHERE status = 'pending' AND username = '$currentuser'";

print "the query is <pre> $pendingrequestsquery </pre>";

$pendingfriendrequestresult = mysql_query($pendingrequestsquery);
$number_of_results = mysql_num_rows($pendingfriendrequestresult);

print "number of currently pending friend requests: $number_of_results <br>";

while($friendrequestrow = mysql_fetch_array($pendingfriendrequestresult))
	{
	$requestid = $friendrequestrow['id'];
	$requestingfriend = $friendrequestrow['requesting_username'];
	print $requestingfriend . " id: " . $requestid . "<br>";
	print "<a href='friendrequestresult.php?id=$requestid&friend=$requestingfriend&action=approve'>approve</a>
			<a href='friendrequestresult.php?id=$requestid&friend=$requestingfriend&action=deny'>deny</a>";
		
	
	print "<br>";
	}