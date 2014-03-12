<?php

// SIGN UP FOR AN ACCOUNT!

include 'config/config.php';
include 'config/connect.php';
include 'header.php';


?>
<link rel='stylesheet' href='css/style.css' type="text/css" />
<head>
<!-- Google map stuff -->
	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=false">
	</script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="css/jquery-gmaps-latlon-picker.css"/>
	<script src="js/jquery-gmaps-latlon-picker.js"></script>
	
</head>
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
	$keyquery = "SELECT * from signup_keys WHERE signup_key='$key' AND used != '1'";
	//print "<br>keyquery: $keyquery <br>";
	$keyresults = mysql_query($keyquery);
	
	$number_of_results = mysql_num_rows($keyresults);
	
	//print "number of results: $number_of_results <br>";
	
	if ($number_of_results != 1 )
		{
		print "<box>either the key wasn't found or it's already been used by somebody else
		<a href='mailto:chrisbeckstrom@gmail.com'>(email chris)</a></box>";
		die;
		}
		
	
	
	// give us all the friends
	//print $friendsrow[0];
	
	?>
<box>
<h1>Sign up</h1><br>
<box>
<small>Although things mostly work, this site is firmly in <b>beta</b>. We'll do our
very best to keep things secure and avoid losing your data.. But it's <b>beta</b>, so
anything can happen. <br>That said, don't worry too much!<br>
Questions? Comments? Bugs? <a href='mailto:chrisbeckstrom@gmail.com'>Email Chris</a></small></box><br>
<tr>
<form class="signupform" name="signupform" method="get" action="submitjoin.php">
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

<br>
<tr>
<td>Username <input name="newusername" type="text" id="newusername" placeholder="what should we call you?" required></td>
</tr><br>

<td>Avatar image <input name="avatarurl" type="text" id="avatarurl" placeholder="link to your picture"></td>
</tr><br>

<td>Email address <input name="email" type="text" id="email" placeholder="we won't spam you" required></td>
</tr><br>


<td>Location <input name="location" type="text" id="location" placeholder="Fishyville, MO"></td>
</tr><br>
<!-- ///////////////////////////////////////////////////////////////////////
//	GOOGLE MAP LAT/LON PICKER
///////////////////////////////////////////////////////////////////////
 MAP -->
<h2>Pick your starting location</h2><br>
<small>this is where your maps will be centered</small>
	<fieldset class="gllpLatlonPicker">
		<!-- 
		<input type="text" class="gllpSearchField">
		<input type="button" class="gllpSearchButton" value="search for a place"> -->
		
		<div class="gllpMap" style="width: auto; height: 500px">Google Maps</div>
		<br/>
		lat/lon:
			<input type="text" class="gllpLatitude" value="45" name="lat" required/>
			<input type="text" class="gllpLongitude" value="-85" name="lon" required/>
		<input type="text" class="gllpZoom" value="3"/>
		<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
		<br/>
	</fieldset>

<?php $signupkey = $_GET['key']; ?>
<formitem>
<input class='seethrough' type="hidden" class='input' name="signupkey" value="<?php echo $signupkey ?>" readonly>
</formitem>

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

