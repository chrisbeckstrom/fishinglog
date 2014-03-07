<?php

// Add a fish (species)

// this script adds a new fish to the SPECIES table

include 'config.php';
include 'connect.php';

$speciesname = 'musky';
$speciesfamily = 'esox';
$latin_name = 'who knows';

$addspeciesquery = "INSERT INTO  `fishingtrips`.`species` (
`species` ,
`family` ,
`latin_name`
)
VALUES (
'$speciesname',  '$speciesfamily',  '$latin_name'
);";

print "the query is <br><pre>$addspeciesquery</pre>";

mysql_query($addspeciesquery)
	or die(mysql_error()); 
	
mysql_close($con);
