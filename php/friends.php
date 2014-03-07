<?php
session_start();
/* USER PAGE- PROFILE PAGE!

this page will show information about the currently
logged-in user

(stats!)
*/
?>
<link rel='stylesheet' href='../css/style.css' type="text/css" />
<?php

include '../header.php';
// include 'footer.php';
include '../config/connect.php';

print $header;

?>
<div id='main'>
	    <nav>nav</nav>
    <aside>aside</aside>
    <article>
 <?

$username = $_GET['username'];

// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}
	
$myusername = $_SESSION['myusername'];
		
	
	
	// by default, look at YOUR friends
	// if a username is passed via GET, show us THEIR friends
	if(isset($_GET['username']))
		{
		$ausername = $_GET['username'];
		print "<box>
		<h1>$ausername's fishin' friends</h1>
		</box>";
		}
		else
		{
		$ausername = $myusername;
		print "<box>
		<h1>Your fishin' friends</h1>
		</box>";
		}
		
	
// let's find out who this user's friends are
	$friendsquery = "SELECT friends FROM users WHERE username = '" . $ausername . "'";
	//print "query is: <pre>$friendsquery</pre>";	
	$friendsresults = mysql_query($friendsquery);
	$friendsrow = mysql_fetch_array($friendsresults);
	
	// give us all the friends
	//print $friendsrow[0];
	
	// put into an array
	$array = explode(',', $friendsrow[0]); //split string into array separated by ','
	
	// for each friend...
	foreach($array as $value) //loop over values
	{
   	 // get info about each friend VALUE=username
   	 $friendquery = "SELECT * FROM users WHERE username = '" . $value . "'";
   	 //print "$friendquery is: <pre>$friendquery</pre>";
   	 $friendresults = mysql_query($friendquery);
   	 while($friendrow = mysql_fetch_array($friendresults))
   	 {
   	 	$avatarurl = $friendrow[useravatarurl];
   	 	print "<box>";
   	 	print "<img class='circular' height='40px' src='$avatarurl'></class>";
   	 	print "<a href='user.php?username=$friendrow[username]'><h2>$friendrow[username]</h2></a>";
		print "</box>";
   	 }
   	 
	}
	
?>