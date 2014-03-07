<?php

// CONNECT TO THE SERVER
$link = mysql_connect("mysql.cbfishes.com","cbfishescom","6thZcnd!");
if (!$link)
  {
  die('Oops, could not connect: ' . mysql_error());	// error message
  }
  
// Choose the database
	mysql_select_db("fishingtrips", $link);

// Construct our join query
/*
$query = "
SELECT column_name(s)
FROM table_name1
INNER JOIN table_name2
ON table_name1.column_name=table_name2.column_name
"

SELECT days.date
FROM days
INNER JOIN trips
ON days.date=trips.tripdate
ORDER BY days.date
	
*/
/*	 

table1 = trips
column1 = date
table2 = days
column2 = tripdate

*/
	 
$query = "SELECT days.date".
"FROM days".
"INNER JOIN trips".
"ON days.date=trips.tripdate".
ORDER BY days.date;	
	
$result = mysql_query($query) or die(mysql_error());


// Print out the contents of each row into a table 
while($row = mysql_fetch_array($result)){
	echo $row['Position']. " - ". $row['Meal'];
	echo "<br />";
}


?>
