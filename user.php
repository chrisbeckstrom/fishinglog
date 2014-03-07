<?php
session_start();
/* USER PAGE- PROFILE PAGE!

this page will show information about the currently
logged-in user

(stats!)
*/
?>
<link rel='stylesheet' href='css/style.css' type="text/css" />
<?php

include 'header.php';
// include 'footer.php';
include 'config/connect.php';

print $header;

?>
<div id='main'>
	    <nav>nav</nav>
    <aside>aside</aside>
    <article>
 <?

$username = $_GET['username'];
$myusername = $_SESSION['myusername'];

// GET BASIC USER INFORMATION
	$userquery = "SELECT * FROM users WHERE username = '$username'";
	//print "query is: <pre>$userquery</pre>";	
	$userresults = mysql_query($userquery);
	$userrow = mysql_fetch_array($userresults);

	// get info about this user
	$avatarurl = $userrow['useravatarurl'];
	$location = $userrow['location'];
	

print "<box>";
print "<img class='circularbigger' src='$avatarurl'>";
print "<h1>$username</h1>";
print "<small> " .$userrow[userrealname];
print "<br><br>" . $location . "<br><br>
		" . $userrow['bio'] . "</small><br>";

// find out if the current user is friends with this user

	// $username = THE PERSON WHOSE PROFILE YOU'RE LOOKING AT
	// $myusername = the person logged in
	
	// is the currently logged in user the same as this person?
		if ($myusername != $username )
			{
	
			// let's find out who this user's friends are
			$friendsquery = "SELECT friends FROM users WHERE username = '" . $username . "'";
			//print "query is: <pre>$friendsquery</pre>";	
			$friendsresults = mysql_query($friendsquery);
			$friendsrow = mysql_fetch_array($friendsresults);
			
			// give us all the friends
			//print $friendsrow[0];
			
			// search that string and find out if the current user is in that list!
			// the haystack as it were
			$string = $friendsrow[0];
			
			// the needle
			$find = $myusername;
			
			// perform the search
			$position = strpos($string, $find);
			
			// We use ===  below because the needle we are looking for may
			// start the haystack. In that case, the function would
			// return 0 as the position of the first occurrence, but the if
			// statement would treat that 0 as false if we used only ==
			
			if ($position === false)
				{
				//echo "Not found";
				print "<a href='friendrequest.php?friend=$username'><button>Add as friend</button></a>";
				}
				else
				{
				//echo "Match found at location $position";
				print "<button>Friends!</button>";
				}
			// END OF "are we friends" stuff
			}
			else
			{
			print "<button>This is you</button>";
			}
			
print "</box>";

print "<box>";
include 'userstats.php';
print "</box>";
print "<box>";
include 'php/watertypechart.php';
print "</box>";
