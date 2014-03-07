<?php

/* UPDATE WATERS SCRIPT

this script looks at the SITENAME in the WATERS
table and adds CITY and WATERBODY

this is a FIX for not adding this information when
the data originally goes into the database
... we should fix it when it goes in!

*/

include 'config/config.php';
include 'config/connect.php';


// SET CITY and WATERBODY
$updates = ("
UPDATE waters SET city='Des Plaines, IL', waterbody='Des Plaines River' WHERE sitename LIKE '%des plaines%';
UPDATE waters SET city='Belvidere, IL', waterbody='Kishwaukee River' WHERE sitename LIKE '%kishwaukee%';
UPDATE waters SET city='Wellston, MI', waterbody='Manistee River' WHERE sitename LIKE '%manistee%';
UPDATE waters SET city='South Elgin, IL', waterbody='Fox River' WHERE sitename LIKE '%south elgin%';
UPDATE waters SET city='Wood Dale, IL', waterbody='Salt Creek' WHERE sitename LIKE '%Wood Dale%';
UPDATE waters SET city='Montgomery, IL', waterbody='Fox River' WHERE sitename LIKE '%Montgomery%';
UPDATE waters SET city='Caledonia, MI', waterbody='Thornapple River' WHERE sitename LIKE '%Caledonia%';
UPDATE waters SET city='Rockford, MI', waterbody='Rogue River' WHERE sitename LIKE '%Rockford%';
	");


$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

?>