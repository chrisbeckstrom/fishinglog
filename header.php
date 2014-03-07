<?php
error_reporting(0);
// these should be here so the header can load the username and avatar
include 'config/config.php';
include 'config/connect.php';

?>
<!-- <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'> -->
<?
print "<head>
<title>$sitename</title>
</head>";

$username = $_SESSION['myusername'];

// get some user info about the logged-in user from MySQL
$userquery = mysql_query("
	SELECT useravatarurl FROM users WHERE username = '$username'
		");
	// put into array
	$userqueryarray = mysql_fetch_array($userquery);
	// get the avatarurl
	$useravatarurl = $userqueryarray['useravatarurl'];

// if you're logged in, show the user and logout link
if(isset($_SESSION['myusername']))
	{			// logged in
	
		// check the friend_requests table
		$pendingrequestsquery = "SELECT * from friend_requests WHERE status = 'pending' AND username = '$username'";
		$pendingfriendrequestresult = mysql_query($pendingrequestsquery);
		$number_of_results = mysql_num_rows($pendingfriendrequestresult);
		
		if ($number_of_results != 0)
			{
			$requests = "<a href='php/checkfriendrequests.php'>($number_of_results)</a>";
			}
			
		$userinfo = "
			<userinfo class='alignright'>
			<!-- <img class='circular' src='$useravatarurl'  height='30' width='30'> -->
			<a href='user.php?username=$username' class='headerlink'>$username</a> 
			$requests | 
			<a href='php/logout.php' class='headerlink'>logout</a>
			</userinfo>
			";
	}
	else		// not logged in
	{
	$userinfo = " 
			 <a href='login.php?returnto=$url' class='headerlink'>login</a>";
	}

if(isset($_SESSION['myusername']))
	{
	$secret_stuff = 
	"<a href='kml/fishingtrips.kml' class='headerlink'>kml</a> |
	<a href='rss.php' class='headerlink'>rss</a> |" ;
	}

$header =
	"<header-wrap>
		<p class='alignleft' style='a:link:#fff'>
			<a href='index.php' class='headerlink'>CB's Fishing Log</a> | 
			<a href='map.php' class='headerlink'>map</a> | 
			<a href='form.php' class='headerlink'>log a trip</a> | 
			<a href='trips.php' class='headerlink'>trips</a> | 
			<a href='php/updatetrip.php' class='headerlink'>update</a> | 
			<a href='waterbodies.php' class='headerlink'>waters</a> |
			
			$secret_stuff
			</p>
			
			<p class='alignright'>
			$userinfo
			</p>
			<div style='clear: both;'></div>
		</header-wrap>
	</div>";	
?>