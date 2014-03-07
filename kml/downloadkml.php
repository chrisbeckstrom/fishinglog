<?php
session_start();

include '../config.php';
include '../connect.php';




// User navigates here to download their KML file


// use their username
$username = $_SESSION['myusername'];

print "Hello $username";
