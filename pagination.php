<?php 
// from http://www.phpjabbers.com/php--mysql-select-data-and-split-on-pages-php25.html

include 'config/config.php';
include 'config/connect.php';

if (isset($_GET["page"])) 
	{ 
	$page  = $_GET["page"]; 
	} 
	else 
	{ 
	$page=1; 
	}; 
	
$start_from = ($page-1) * 20; 

$sql = "SELECT * FROM trips ORDER BY date DESC LIMIT $start_from, 20"; 
print "query is: $sql <br>";

$rs_result = mysql_query ($sql, $connection); 
?> 

<table>
<tr><td>Name</td><td>Phone</td></tr>


<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
	<?php print "TEST <BR>"; ?>
            <tr>
            <td><? echo $row['username']; print "test" ;?></td>
            <td><? echo $row['waterbody']; ?></td>
            </tr>
<?php 
}; 
?> 
</table>