<?php

// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
	
// connect to the database server and select the appropriate database for use
$dblink = mysql_connect('mysql.cbfishes.com', 'cbfishescom', '6thZcnd!') or die( mysql_error() );
mysql_select_db('fishingtrips');

// query the database table for zip codes that match 'term'
//$rs = mysql_query('select zip, city, state from zipcode where zip like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by zip asc limit 0,10', $dblink);

$rs = mysql_query('select zip, city, state from zipcode where zip like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by zip asc limit 0,10', $dblink);

// loop through each zipcode returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['zip'] .', '. $row['city'] .' '. $row['state'] ,
			'value' => $row['zip']
		);
	}
}

// jQuery wants JSON data
echo json_encode($data);
flush();