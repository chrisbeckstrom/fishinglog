<!-- JAVASCRIPT FOR POPUPS -->
<script src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/nhpup_1.1.js"></script>

<link rel="stylesheet" type="css/text/css" href="css/style.css"/>

<?php
include 'config/config.php';
include 'config/connect.php';

$username = $_SESSION['myusername'];

// Trips a year ago

// this finds some trips from about a year ago

// for testing:
	// $username = 'cbfishes';

// figure out what the date was a year ago
	// today: 
	$today = date('Y-m-d');
	
	// 1 year ago
	$lastyearraw = strtotime("-1 year", strtotime($today));
	$lastyear = date("Y-m-d", $lastyearraw);
	
	// 1 year ago MINUS 2 weeks
	$lastyeartwoweeksraw = strtotime("-2 weeks", $lastyearraw);
	$lastyearminustwoweeks = date("Y-m-d", $lastyeartwoweeksraw);
	
	// 1 year ago PLUS 2 weeks
	$lastyearplustwoweeksraw = strtotime("+2 weeks", $lastyearraw);
	$lastyearplustwoweeks = date("Y-m-d", $lastyearplustwoweeksraw);

print "<h3>A year ago</h3>";
$oldlimit = 10;
		

//Do your query and stuff here
$yearagoquery = "SELECT * FROM trips 
WHERE username = '$username' 
AND date < '$lastyearplustwoweeks' 
AND date > '$lastyearminustwoweeks' 
ORDER BY tripnumber 
DESC LIMIT $oldlimit";

$yearagoresult = mysql_query($yearagoquery);

// get all the variables
while($row = mysql_fetch_array($yearagoresult))
	{
	include 'tinytripinfo.php';							
	}
	


mysql_close($con);
	
?>
		