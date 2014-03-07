<?php
/* Connection vars here for example only. Consider a more secure method. */
$dbhost = 'mysql.cbfishes.com';
$dbuser = 'cbfishescom';
$dbpass = 'supjha2510';
$dbname = 'fishingtrips';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);

$return_arr = array();

/* If connection to database, run sql statement. */
if ($conn)
{
	$fetch = mysql_query("SELECT * FROM waterbodies where name like '%" . mysql_real_escape_string($_GET['term']) . "%'"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$row_array['name'] = $row['name'];
		$row_array['watertype'] = $row['watertype'];
		$row_array['state'] = $row['state'];
		
        array_push($return_arr,$row_array);
    }
}

/* Free connection resources. */
mysql_close($conn);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

?>