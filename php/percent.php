<?php

// PERCENT function
// borrowed it from http://asadream.wordpress.com/tutorials/tutorial-php-calculating-a-percentage/
	function percent($num_amount, $num_total) {
	$count1 = $num_amount / $num_total;
	$count2 = $count1 * 100;
	$count = number_format($count2, 0);
	echo $count;
	}
	
	?>