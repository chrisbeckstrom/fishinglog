<?php
session_start();

include '../config/config.php';
include '../config/connect.php';

// receive GET information, approve or deny a friend request

// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}

$currentuser = $_SESSION['myusername'];
print "<h2> current user: $currentuser </h2>";

if (!isset($_GET['action']))
	{
	print "no action set!";
	die;
	}
	
if (!isset($_GET['id']))
	{
	print "no action set!";
	die;
	}
	
if (!isset($_GET['friend']))
	{
	print "no requestingfriend set!";
	die;
	}
	
$action = $_GET['action'];
$requestid = $_GET['id'];
$requestingfriend = $_GET['friend'];

print "FRIEND REQUEST: <br>
$requestingfriend wants to be friends with $currentuser<br>";
	
if ($action == 'deny')
	{
	print "$currentuser is not going to approve the friendship <br>";
	die;
	}

if ($action == 'approve')
	{
	print "$currentuser is going to approve the friendship! <br>";
	}
	
// update the row
// UPDATE table_name
// SET column1=value1,column2=value2,...
// WHERE some_column=some_value;

$sql="UPDATE friend_requests SET status='approved' WHERE id=$requestid";
print "<br> UPDATING the friend_requests table <br>";
print "<br> the query is: <pre> $sql </pre>";
	
// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

print "friend request updated!";


// let's find out who this user's friends are
	print "<br>FINDING OUT who $currentuser is friends with <br>";
	$friendsquery = "SELECT friends FROM users WHERE username = '" . $currentuser . "'";
	print "query is: <pre>$friendsquery</pre>";	
	$friendsresults = mysql_query($friendsquery);
	$friendsrow = mysql_fetch_array($friendsresults);

	
	// give us all the friends
	print "$currentuser current friends: <br>";
	print $friendsrow[0] . "<br>";
	
// add $requestingfriend to $currentuser's list of friends
print "adding $requestingfriend to $currentuser's list of friends <br>";
$friendsrow[0] = $friendsrow[0] . "," . $requestingfriend;

print "$current user new friend list: $friendsrow[0] <br>";
$friends = $friendsrow[0];
	
print "<br> Now we're going to add $requestingfriend to $currentuser's list of friends <br>";

$addfriendquery="UPDATE users SET friends='$friends' WHERE username='$currentuser'";
print "the addfriendquery is: <pre> $addfriendquery </pre>";	

// Tell us the results
if (!mysql_query($addfriendquery,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}
	
	
	

////////	
print "<br> Now we'll also update $requestingfriend's list of friends and add $currentuser <br>";
// also update the other user's friend list
	$friendsquery = "SELECT friends FROM users WHERE username = '" . $requestingfriend . "'";
	print "query is: <pre>$friendsquery</pre>";	
	$friendsresults = mysql_query($friendsquery);
	$friendsrow = mysql_fetch_array($friendsresults);

	
	// give us all the friends
	print "$requestingfriend current friends: ";
	print $friendsrow[0];
	
// add $requestingfriend to $currentuser's list of friends
print "adding $currentuser to $requestingfriend's list of friends <br>";
$friendsrow[0] = $friendsrow[0] . "," . $currentuser;

print "$current user new friend list: $friendsrow[0] <br>";
$friends = $friendsrow[0];
	

$sql="UPDATE users SET friends='$friends' WHERE username='$requestingfriend'";
print "the query is: <pre> $sql </pre>";	

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}
	

	
//mysql_close($con);
	
