<?php
// This php script is never viewed- it is used by the "log a trip form" to auto-complete waterbodies
 
// if the 'term' variable is not sent with the request, exit
if ( !isset($_REQUEST['term']) )
	exit;
	
include 'config/config.php';

// connect to the database server and select the appropriate database for use
$dblink = mysql_connect($DBurl, $DBuser, $DBpass) or die( mysql_error() );
mysql_select_db($DBdb);
 
// query the database table for waterbodies that match 'term'
$rs = mysql_query('SELECT DISTINCT waterbody, watertype FROM trips WHERE waterbody LIKE "'. mysql_real_escape_string($_REQUEST['term']) .'%" ORDER BY waterbody asc limit 0,10', $dblink);
 
// loop through each result returned and format the response for jQuery
$data = array();
if ( $rs && mysql_num_rows($rs) )
{
	while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
	{
		$data[] = array(
			'label' => $row['waterbody'] .', '. $row['watertype'] ,
			'value' => $row['waterbody']
		);
	}
}
 
// jQuery wants JSON data
echo json_encode($data);
flush();