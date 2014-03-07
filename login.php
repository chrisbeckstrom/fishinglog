<?php
session_start();

include 'config/config.php';
include 'config/connect.php';
include 'header.php';
// include 'footer.php';
print "<link rel='stylesheet' href='css/style.css' type='text/css' />";

print $header;
$message = $_GET['message'];

include 'php/loginbox.php';
