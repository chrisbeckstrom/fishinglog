<?php
session_start();
/* the index page
the FRONT DOOR of the site */
include 'config/config.php';
include 'config/connect.php';
include 'header.php';

print "<link rel='stylesheet' href='css/style.css' type='text/css'/>";

print $header;

?>
<div id='main'>
    <article>
    	
    	<?
//print "your username is " . $_SESSION['myusername'];
print "
<br><br>

	<center>
		<h1>CB's Fishing Log</h1>
			
			<br><br>
			This is a fishing web site being built by <a href='http://cbfishes.com'>this guy<br><br>
			<img src='https://en.gravatar.com/userimage/38567694/a1875b8ab27199899d7e8142cc5f608c.jpg'></a><br><br>
			<a target='_blank' href='http://cbfishes.com/2013/07/26/building-a-fishing-app/'><i>Read about it...</i></a>

	</box>";
	
	// include 'php/loginbox.php';
	print "<box>";
	include 'php/interestbox.php';
	print "</box>";
	
	print "</article></div>";
	

// FOOTER
// include 'footer.php';
