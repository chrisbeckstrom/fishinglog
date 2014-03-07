<?php
// CB FISHING LOG CONFIGURATION FILE
// this should be the FIRST thing on every page
// hopefully it doesn't find its way to git...
// edited on mac pro

// SITE INFORMATION
$sitename = "CB's Fishing Log";		// this is the <title> in the header

// DB information
$DBurl 		= 'mysql.cbfishes.com';
$DBuser 	= 'cbfishescom';
$DBpass		= 'supjha2510';
$DBdb 		= 'fishingtrips';

// Google Maps API (v3)
$mapsAPIkey = "AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4";

// Wunderground API
$wunderground_key = "681a9b949662ace6";

// Geonames username
$geonames_key = "chrisbeckstrom";

// Navionics API key
$navionics_key = 'Navionics_webapi_00250';

// get the style sheet, add it to each page's html
$stylesheet = 'style.css';


// google analytics
include_once("analyticstracking.php");

?>
