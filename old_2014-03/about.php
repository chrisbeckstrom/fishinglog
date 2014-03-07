<?php

/* the ABOUT page
stuff about the site */

include 'config/config.php';
include 'config/connect.php';
include 'header.php';

$pagetitle = "About $sitename";
print $header;

print "<div id='wrap'>";
print "<div id='tripbox'>";

?>

<h4>This site uses bits and pieces from:</h4>
* Google Maps API <br>
* Wunderground Weather API <br>
* USGS Streamflow API <br>

and