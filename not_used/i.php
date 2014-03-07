<?php

include 'config/config.php';
include 'header.php';

print $header;

// I want to make an array like this:

$points = Array(
1 => "$lat, $lon",
2 => "41.979, -88.021"
);

//print_r($points);

include 'config/config.php';
include 'config/connect.php';


$result = mysql_query("
SELECT latlon
FROM spots
		");
		
		
$row = mysql_fetch_array($result);
print "<div class='bigwhitebox'>";
print "Here is the first line <BR>
Second line<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
tehakjhsd
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
vkjhkjhasdaskjhkfha askjhas
<BR>
<BR>
<BR>
<BR>
<BR>
ljkhalsjhdaks

<BR>
<BR>
<BR>
<BR>
<BR>
third line
Second line<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
tehakjhsd
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
vkjhkjhasdaskjhkfha askjhas
<BR>
<BR>
<BR>
<BR>
<BR>
ljkhalsjhdaks

<BR>
<BR>
<BR>
<BR>
<BR>
third lineSecond line<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
tehakjhsd
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
vkjhkjhasdaskjhkfha askjhas
<BR>
<BR>
<BR>
<BR>
<BR>
ljkhalsjhdaks

<BR>
<BR>
<BR>
<BR>
<BR>
third lineSecond line<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
tehakjhsd
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
<BR>
vkjhkjhasdaskjhkfha askjhas
<BR>
<BR>
<BR>
<BR>
<BR>
ljkhalsjhdaks

<BR>
<BR>
<BR>
<BR>
<BR>
third line
</div>";