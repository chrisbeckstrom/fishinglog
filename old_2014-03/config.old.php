<?php
// CB FISHING LOG CONFIGURATION FILE

// changing stuff here changes it everywhere this file is 'include'd and the variables
// are used

include 'connect.php';

// NUMBER OF RECORDS (trips) IN TABLE 'fishingtrips'
$result = mysql_query("SELECT * FROM trips", $link);
	$num_rows = mysql_num_rows($result);
	$totaltrips = $num_rows;

// HEADER / NAV
$header =
	"<div id='header'>
		<div id='nav'>
			<class='button-link'>CB's Fishing Log - $totaltrips trips and counting &nbsp; &nbsp; &nbsp;</class>  
			<a href='index.php' class='button-link'>log a trip</a>
			<a href='graphs.php' class='button-link'>graphs</a>
			<a href='http://mysql.cbfishes.com' target='new' class='button-link'>database</a>
			<a href='stats.php' class='button-link'>this year's stats</a>
			<a href='stats2012.php' class='button-link'>2012</a>
			<a href='search.php' class='button-link'>search</a>
		</div>
	</div>";

// FOOTER
$footer = 
	"<div id='footer'>
	<i>created by Chris Beckstrom - while he tries to learn how to use MySQL, PHP, JSON, and CSS</i> 
	- <a href='http://cbfishes.com'>cbfishes.com</a>
	</div>";


// PERCENT function
// borrowed it from http://asadream.wordpress.com/tutorials/tutorial-php-calculating-a-percentage/
	function percent($num_amount, $num_total) {
	$count1 = $num_amount / $num_total;
	$count2 = $count1 * 100;
	$count = number_format($count2, 0);
	echo $count;
	}


?>