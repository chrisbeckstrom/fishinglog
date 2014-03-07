<?php

// This has some nice stuff to manipulate time //

////////////////////////////////////////////////////////
// make the long date (January 15, 2013)
$datestamp = strtotime($tripdate);			// convert to timestamp
$fulldate = date("F j, Y", $datestamp);		// convert to long format

// make the short date (1/15/13)
$shortdate = date("n/j/y", $datestamp);

////////////////////////////////////////////////////////