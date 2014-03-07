<link rel="stylesheet" type="text/css" href="style.css"/>
<?php


/* this script takes an EMAIL address and adds it to the email_list database

*/
include '../config/config.php';
include '../config/connect.php';

$host= $DBurl; // Host name
$username= $DBuser; // Mysql username
$password= $DBpass; // Mysql password
$db_name= $DBdb; // Database name

$tbl_name="email_list"; // users Table name

include 'getip.php';

include '../header.php';
?>
<link rel="stylesheet" type="css/text/css" href="../css/style.css"/>
<?
print $header;

print "<box>";

//print "<span class='whiteonwhite'>I grabbed your IP because I'm curious to see who signs up! It's ";
$ipaddress = print get_client_ip();
print "</span>";

print "</box>";

// Connect to server and select databse.
// mysql_connect("$host", "$username", "$password")or die("cannot connect");
// mysql_select_db("$db_name")or die("cannot select DB");

//print "email submitted is: " . $_POST['email'];

// username and password sent from form
$email=$_POST['email'];

// To protect MySQL injection (more detail about MySQL injection)
$email = mysql_real_escape_string($email);

$sql="INSERT INTO email_list (email, ip) VALUES ('$email','$ipaddress')";

// INSERT INTO email_list (email) VALUES ('testemail@gmail.com')

// show us the query
// print "<br> -------- THE SQL QUERY --------- <br><pre> $sql </pre>";

// Tell us the results
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());							// error message
	}

mysql_close($con);
?>
<center>
<box>Success! We'll shoot an email to <b><?php print $email ?> </b>when the site is ready for testing.<br>
	<!-- <smallinfo>
		If you're looking here, maybe you're interested that I recorded your IP address.
		I'm just curious to see who signs up!
		<?php $ipaddress = print get_client_ip(); ?>
		</smallinfo> -->
</box>
</center>