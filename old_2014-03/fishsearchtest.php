<?php

include 'config.php';
include 'connect.php';
include 'header.php'

?>
<link rel='stylesheet' href='style.css' type="text/css" />
<center>
<box>
Find a fish<br>
<form action="fishsearchtest.php" method="get">
<input class='input' type="text" name="q">

<input class='fancybutton' type="submit" value="search" name="submit">
</form></box>
<?

$lookingfor = $_GET['q'];
if(!isset($_GET['q']))
{
	die;
}

print "<pre>results for $lookingfor</pre>";

// Retrieve all the data from the "example" table
$result = mysql_query("select * from fish where (fishbase_name like '%$lookingfor%' 
												or species like '%$lookingfor%'
												or name like '%$lookingfor%')")
or die(mysql_error());  

?>
<tr>
	<table width:"1600">
<th>Family</th>

<th>Species</th>

<th>Name</th>

</tr>
<?

// store the record of the "example" table into $row
while($row = mysql_fetch_array( $result ))
	{
		$fishbaselink = $row['url'];
		$species = $row['species'];
		$name = $row['fishbase_name'];
		$family = $row['family'];
		?>
		<tr>
		<td><a target='_blank' href='<? print $fishbaselink ?>'> <? print $family ?> </a></td>
		<td><a target='_blank' href='<? print $fishbaselink ?>'> <? print $species ?> </a></td>
		<td><a target='_blank' href='<? print $fishbaselink ?>'> <? print $name ?> </a></td>
		</tr>
		<?
		
	}
?>	
</table>	
<?

print "<br><span class='smallinfo'>from <a href='http://fishbase.org'>fishbase.org</a></span>";


