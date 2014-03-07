<?php

// Recent trips

// this just spits out a list of the most recent trips by this user
// made to show up in little boxes

print "<h3>Your recent trips</h3>";
$limit = 10;
$query = "
SELECT * FROM trips WHERE username = '$username'
ORDER BY tripnumber DESC
LIMIT $limit
		";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	include 'tinytripinfo.php';	
				}
	
?>
			