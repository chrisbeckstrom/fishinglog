<?php
session_start();
/* FRIEND REQUEST PAGE */
?>
<link rel='stylesheet' href='css/style.css' type="text/css" />
<?
include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print $header;

// receive GET information and connect to the DB

// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}

$requesting_username = $_SESSION['myusername'];

if (!isset($_GET['friend']))
	{
	print "no friend set!";
	die;
	}
	
$friend = $_GET['friend'];

// build the page
?>
<div id='main'>
	<nav></nav>
	<aside>aside</aside>
	<article>
	<?


print "<box>";
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

print "</box>";
print "<box>friend request submitted!</box>";