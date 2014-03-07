<?php

/* this script checks the results of the
(originally named) main_login.php
	NOW CALLED login.php

*/
include 'config.php';
// include 'connect.php';

$host= $DBurl; // Host name
$username= $DBuser; // Mysql username
$password= $DBpass; // Mysql password
$db_name= $DBdb; // Database name

$tbl_name="users"; // users Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");


// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
// session_register("myusername");
// session_register("mypassword");

// RECORD THAT THIS USER LOGGED IN
//////////////////////////////////


session_start(); // if this isn't here, session variables don't get saved!

$_SESSION['myusername'] = $myusername;


header("location:index.php");
}
else {
echo "Wrong Username or Password";
}
?>