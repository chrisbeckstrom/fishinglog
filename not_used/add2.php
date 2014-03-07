<?php
////////////////////////// RESULTS //////////////////////////////////////
$largemouth = 5;
$smallmouth = 10;
$tripdate = "2013-01-01";

// Connect to the server
mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!") or die(mysql_error());
print "<BR>Connected to mysql";


// Choose the database
mysql_select_db("fishingtrips") or die(mysql_error());
print "<BR>Connected to Database";

// PUTTING THE STUFF INTO THE DATABASE

mysql_query(
	"INSERT INTO trips
	(tripdate
	) 
	VALUES
	('$tripdate')")
	or die(mysql_error()); 

//Tell us the results

?>