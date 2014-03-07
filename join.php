<?php

// SIGN UP FOR AN ACCOUNT!

include 'config/config.php';
include 'config/connect.php';
include 'header.php';


?>
<link rel='stylesheet' href='css/style.css' type="text/css" />
<body>
<? print $header ?>
<div id='main'>
   
    <nav></nav>
    <aside>
    </aside>
    

<article>

<?
// check if there is a secret key submitted
if (!isset($_GET[key]))
	{
	print "<box>no key submitted!</box>";
	die;
	}
	
// check that the key matches a key in the the key table
	$key = $_GET[key];
	$keyquery = "SELECT * from signup_keys WHERE signup_key='$key'";
	print "<br>keyquery: $keyquery <br>";
	$keyresults = mysql_query($keyquery);
	
	$number_of_results = mysql_num_rows($keyresults);
	
	print "number of results: $number_of_results <br>";
	
	if ($number_of_results != 1 )
		{
		print "key not found";
		die;
		}
		
	
	
	// give us all the friends
	//print $friendsrow[0];
	
	?>
<box>
<h1>Sign up</h1>
<tr>
<form class="signupform" name="signupform" method="post" action="submitjoin.php">
<td>
<tr>
<td>Your name <input name="name" type="text" id="name" placeholder="your real name" required></td>
</tr>
<tr>
<td></td>
<br>

<td>Password <input name="mypassword" type="password" id="mypassword" placeholder="desired password" required></td>
</tr>
<br>
<td>Password again <input name="mypassword" type="password" id="mypassword2" placeholder="again!" required></td>
</tr>
<br>
<tr>
<td>Username <input name="myusername" type="text" id="myusername" placeholder="what should we call you?" required></td>
</tr><br>

<td>Avatar image <input name="avatarurl" type="text" id="avatarurl" placeholder="link to your picture" required></td>
</tr><br>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><br><input class="fancybutton" type="submit" name="Submit" value="sign me up!"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</box>
</article>

